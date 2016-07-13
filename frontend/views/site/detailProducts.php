<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>




<div class="media">
  <div class="media-left media-top">
    <a href="#">
      <img class="media-object" src="/<?=$products->logo?>" alt="...">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?=$products->title_ru?></h4>
    <p><?=$products->description_ru?></p>
    <p>Price: <?=$products->price?> </p>
  </div>
</div>
<div class="row">
<div class="tags">
  <?php foreach ($products->tag as $item) :?>
    <span class="badge">
        <a href="index.php?r=site/detailtag&id=<?=$item->id?>"><?=$item->name?></a>   
    </span>
  <?php endforeach ;?>
</div>
</div>

<hr>




<div class="row"> 
	<?php foreach ($images as $item) :?>
    <div class="col-md-3 col-sm-4 col-xs-6 thumb">

      <a class="fancyimage" data-fancybox-group="group" href="<?=$item->image?>"> 
        <img class="img-responsive" src="<?=$item->image?>" /> 
      </a> 

    </div>
  <?php endforeach ;?>
 

  







  <div class="col-md-3 col-sm-4 col-xs-6">
  </div>
  <div class="col-md-3 col-sm-4 col-xs-6">
  </div>
  <div class="col-md-3 col-sm-4 col-xs-6">
  </div>
  ...
</div>







<hr>


<div class="">
  <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($comment, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($comment->isNewRecord ? 'Create' : 'Update', ['class' => $comment->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


<hr>


<?php foreach ($viewComments as $comment) :?>
  <div class="media">
    <div class="media-body">
        <h4 class="media-heading"><?=$comment['username']?></h4>
        <p><?=$comment['comment']?></p>
        <p><?=$comment['date']?></p>
        <a href="#">Ответить</a>
    </div>
  </div>
<?php endforeach ;?>
