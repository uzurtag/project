<h1>News</h1>

<?php foreach ($models as $item): ?>
	<div class="col-sm-4 col-lg-4 col-md-4">
		<div class="thumbnail">
		    <img src="http://placehold.it/320x150" alt="">
		    <div class="caption">
		        <h4 class="pull-right"></h4>
		        <h4><a href="index.php?r=site%2Fdetail-news&id=<?=$item->id?>"><?=$item->title_ru?></a>
		        </h4>
		        <p>See more news like this item at</p>
		    </div>
		    <div class="ratings">
		        <p class="pull-right">15 reviews</p>
		        <p>
		            <span class="glyphicon glyphicon-star"></span>
		            <span class="glyphicon glyphicon-star"></span>
		            <span class="glyphicon glyphicon-star"></span>
		            <span class="glyphicon glyphicon-star"></span>
		            <span class="glyphicon glyphicon-star"></span>
		        </p>
		    </div>
		</div>
	</div>
<?php endforeach; ?>

<div class="center-block">
    
<?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
  </div>

