<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;


use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_ru')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_en')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <?= $form->field($model, 'date_update')->textInput() ?>

    <?php /*$form->field($model, 'logo')->textInput(['maxlength' => true])*/ ?>

    <?= $form->field($model, 'logo')->fileInput() ?>
    
    <?php/* var_dump(ArrayHelper::map($tag, 'id', 'name'))*/?>

    <?= $form->field($model, 'tag_id')->widget(Select2::classname(), [
        'name' => 'state_10',
        'options' => [
                    'placeholder' => 'Выбрать команду ...',
                    'multiple' => true
                ],
        'data' => ArrayHelper::map($tag, 'id', 'name'), // data as array
    ]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
