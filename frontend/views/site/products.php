<!-- test products -->

<h1>Products</h1>



<?php foreach ($products as $item): ?>
	<div class="product">
		<img src="/frontend/web/images/xiaomi_mi5_1638652733.jpg" style="width: 200px;">
		<a href="index.php?r=site%2Fdetail-products&id=<?=$item->id?>"><h2> <?=$item->title_ru?> </h2></a>
		<span><?=$item->price?> $</span>
		<button type="button" class="btn btn-success">В корзину</button>
	</div>
<?php endforeach; ?>



