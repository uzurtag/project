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

<div class="tags">
	<?php foreach ($products->tag as $item) :?>
		<span class="badge">
	    	<a href="index.php?r=site/detailtag&id=<?=$item->id?>"><?=$item->name?></a>   
		</span>
	<?php endforeach ;?>
</div>




<div class="row"> 
	
  <div class="col-md-3 col-sm-4 col-xs-6">
  </div>
  <div class="col-md-3 col-sm-4 col-xs-6">
  </div>
  <div class="col-md-3 col-sm-4 col-xs-6">
  </div>
  ...
</div>
