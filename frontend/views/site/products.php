<!-- test products -->
<?php foreach ($tags as $item) :?>
                           <a href="index.php?r=site/detailtag&id=<?=$item->id?>"><?=$item->name?>&nbsp&nbsp</a>   
<?php endforeach ;?>

<h1>Products</h1>
    
<?php foreach ($products as $item): ?>
	<div class="col-md-3 col-sm-6 hero-feature">
		<div class="thumbnail">
			<img src="/<?=$item->logo?>" alt="">
			<div class="caption">
				<h3><?=$item->title_ru?></h3>
				<p>Price: <?=$item->price?> $</p>
				<p>
					<a href="index.php?r=site/add-product&id=<?=$item->id?>" class="btn btn-primary">Buy Now!</a> <a href="index.php?r=site%2Fdetail-products&id=<?=$item->id?>" class="btn btn-default">More Info</a>
				</p>
			</div>
		</div>	
	</div>
<?php endforeach; ?>


