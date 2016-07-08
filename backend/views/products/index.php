<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title_ru',
            'title_en',
            // 'description_ru:ntext',
            // 'description_en:ntext',
            // 'logo',
            // 'status',
            // 'price',
            // 'count',
            // 'date_create',
            // 'date_update',
            // 'tag_id',

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{image}&nbsp;{delete}',
             'buttons' =>
                 [
                     'image' => function ($url, $model) {
                         return Html::a('<span class="glyphicon glyphicon-picture"></span>', Url::to(['/image/create', 'id' => $model->id]), [
                             'title' => Yii::t('yii', 'Назначить роль')
                         ]); },
                 ]
            ],
        ],
    ]); ?>
</div>
