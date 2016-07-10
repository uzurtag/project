'Смартфоны и телефоны'


                
<div class="row">

    <div class="col-md-4 col-lg-4">
        <?php foreach ($productTags->products as $item) :?>
            <a href="index.php?r=site/detail&id=<?=$item->id ?>"><b><h3><center><?=$item->title_ru?>
            </center></h3></b></a>
            <em> <?=$item->description_ru ?></em><br>
            <b>Модель: <span style="color:blue"><?=$item->logo ?></span></b><br>
            Цена: <?=$item->price ?> грн. <br><br>
            <hr>
        <?php endforeach ;?>
    </div>
</div>