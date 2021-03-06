<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model common\models\Products */

$this->title = 'Update Products: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tag' => $tag,
    ]) ?>

</div>
