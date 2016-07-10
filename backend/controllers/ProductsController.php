<?php

namespace backend\controllers;

use Yii;
use common\models\Products;
use backend\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\Tag;
use common\models\RelationTag;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
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
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
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
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        $tag = Tag::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            // var_dump($model->tag_id); die();
            // var_dump($model->save(), $model->validate(), $model->errors);

            $model->logo = UploadedFile::getInstance($model, 'logo');
            if ($model->logo){
                $model->logo->saveAs(Yii::getAlias('@frontend/web/images/') . md5($model->id) . '.' . $model->logo->extension);
                $model->logo = "frontend/web/images/" . md5($model->id) . '.' . $model->logo->extension;
            }
            $model->save();

            foreach ($model->tag_id as $item) {
                $addTag = new RelationTag();
                $addTag->tag_id = $item;
                $addTag->product_id = $model->id;
                $addTag->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'tag' => $tag,
            ]);
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tag = Tag::find()->all();

        // var_dump($model); die();

        if ($model->load(Yii::$app->request->post())) {

            // var_dump($model->tag(), $model->validate(), $model->errors);

            $model->logo = UploadedFile::getInstance($model, 'logo');
            if ($model->logo){
                $model->logo->saveAs(Yii::getAlias('@frontend/web/images/') . md5($model->id) . '.' . $model->logo->extension);
                $model->logo = "frontend/web/images/" . md5($model->id) . '.' . $model->logo->extension;
            }

            $model->save();

            foreach ($model->tag_id as $item) {
                $addTag = new RelationTag();
                $addTag->tag_id = $item;
                $addTag->product_id = $model->id;
                $addTag->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tag' => $tag,
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
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
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
