test products

<h1>Products</h1>

<?php foreach ($products as $item): ?>
	<div class="pre-news">
		<a href="index.php?r=site%2Fdetail-products&id=<?=$item->id?>"><h2> <?=$item->title_ru?> </h2></a>
	</div>
<?php endforeach; ?>



