<?php foreach ($productTags->products as $item): ?>
    <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="/<?=$item->logo?>" alt="">
            <div class="caption">
                <h3><?=$item->title_ru?></h3>
                <p>Price: <?=$item->price?> $</p>
                <p>
                    <a href="#" class="btn btn-primary">Buy Now!</a> <a href="index.php?r=site%2Fdetail-products&id=<?=$item->id?>" class="btn btn-default">More Info</a>
                </p>
            </div>
        </div>  
    </div>
<?php endforeach; ?>


