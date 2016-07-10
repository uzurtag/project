<b>Name product</b> <?=$products->title_ru?><br><br><br>

<b>Logo</b> <?=$products->logo?><br><br><br>

<b>Price</b> <?=$products->price?>   $<br><br><br>

<b>Description</b><br> <?=$products->description_ru?><br>

<b>Date Create</b> <?=$products->date_create?><br><br><br>

<b>Date Update</b> <?=$products->date_update?><br><br><br>



<?php foreach ($products->tag as $item) :?>

                           <a href="index.php?r=site/detailtag&id=<?=$item->id?>"><?=$item->name?>&nbsp&nbsp</a>   

<?php endforeach ;?>
