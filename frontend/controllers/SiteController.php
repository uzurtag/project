<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;


use common\models\News;
use common\models\Products;
use common\models\Tag;
use common\models\RelationTag;
use common\models\Comment;
use common\models\Image;
use yii\data\Pagination;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        // $q = Tag::find()->where(['id' => 3])->one();
        // var_dump($q->products); die();
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays news page.
     *
     * @return mixed
     */
    public function actionNews()
    {
        $model = new News();
        // $news = $model->find()->orderBy(['id' => SORT_DESC])->all();

        // var_dump($news); die();

        $query = $model->find()->count();
        
        $pages = new Pagination(['totalCount' => $query, 'defaultPageSize' => 3]);

        $models = $model->find()->offset($pages->offset)->limit($pages->limit)->orderBy(['id' => SORT_DESC])->all();

        return $this->render('news', ['news' => $news, 
            'models' => $models, 
            'pages' => $pages,
        ]);
    }

    public function actionDetailNews($id)
    {
        $news = News::find()->where(['id' => $id])->one();

        return $this->render('detailNews', ['news' => $news]);
    }

    /**
     * Displays product page.
     *
     * @return mixed
     */
    public function actionProducts()
    {
        $model = new Products();
        $products = $model->find()->orderBy(['id' => SORT_DESC])->all();

        $tags = Tag::find()->all();

        // var_dump($tags); die();

        return $this->render('products', ['products' => $products, 'tags' => $tags]);
    }

    public function actionDetailProducts($id)
    {
        $products = Products::find()->where(['id' => $id])->one();

        $comment = new Comment();

        $images = Image::find()->where(['product_id' => $id])->all();

        if ($comment->load(Yii::$app->request->post())) {
            $comment->product_id = $id;
            if (!Yii::$app->user->isGuest) {
                $comment->user_id = Yii::$app->user->id;
            }
        }

        $comment->save();

        unset($comment->comment);

        // var_dump($comment->save(), $comment->validate(), $comment->errors); die();

        $viewComments = $comment->find()
                    ->where(['product_id' => $id, 'parrent_id' => 0])
                    ->all();

        // $query = ("SELECT * FROM `comment` WHERE 'product_id' = {$id} AND 'parrent_id' = 0")
        
        // $viewComments = $comment->find()->getUser->all();

        return $this->render('detailProducts', [
            'products' => $products,
            'images' => $images,
            'comment' => $comment,
            'viewComments' => $viewComments,

        ]);
    }

    public function actionAddProduct($id) 
    {
        $session = Yii::$app->session;

        $session->open();

        if($session->has('add')){
            $session->set('add', [$id]);
        } else {
            $session->set('add', [$id]);
        }
        var_dump($session->get('add')); die();
        return $this->redirect('index.php?r=site%2Fproducts');

    }

    public function actionDetailtag($id)
    {
        $productTags = Tag::find()->where(['id' => $id])->one();

            return $this->render('detailTags', [
                'productTags' => $productTags,
            ]);
    }


    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
