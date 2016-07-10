<?php

namespace backend\controllers;

use Yii;
use common\models\Image;
use backend\models\ImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Image models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Image model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Image model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Image();

        $image = $model->find()->where(['product_id' => $id])->all();

        if ($model->load(Yii::$app->request->post()) /*&& $model->save()*/) {

            /*$id=$_GET['id']
            $img->img=путь к имеджу
            $img->prod_id=id
            $img->save();


    public function actionCreate()
    {
        $id = $_GET['id']; //получение id продукта, отправленного с бэкенд/продакт/индекс
        $images = Image::find()->where(['product_id' => $id])->all();
        $model = new Image();
        //$model->image = "i"; //присваиваем любое значение антрибуту, иначе не сохраняется в бд. а данные знсим в БД перед сохранением файла, чтобы получить id in table img

        if ($model->load(Yii::$app->request->post()) ) {
                $model->product_id = $id;
                $model->save();
                $model->file = UploadedFile::getInstance($model, 'file');
                if($model->file){
                    $model->file->saveAs(Yii::getAlias('@frontend/web/images/') . md5($model->id) . '.' . $model->file->extension);
                    $model->image = '/frontend/web/images/' . md5($model->id) . '.' . $model->file->extension;
                }
        $model->save(false); //что-бы повторно не валидировалось, иначе присваивается $model->image = "i"

        return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'images' => $images
            ]);
        }
    }


        */
            return $this->redirect(['create', 'id' => $id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'image' => $image,
            ]);
        }
    }

    /**
     * Updates an existing Image model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Image model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Image::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
