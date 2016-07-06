test news

<h1>News</h1>

<?php foreach ($news as $item): ?>
	<div class="pre-news">
		<a href="index.php?r=site%2Fdetail-news&id=<?=$item->id?>"><h2> <?=$item->title_ru?> </h2></a>
	</div>
<?php endforeach; ?>




