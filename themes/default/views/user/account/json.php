[<?php if($tags){
$total = count($tags) - 1;
foreach ($tags as $i =>$tag){
    echo '{';
    echo '"id": "'.$tag->id.'",';
    echo '"label": "'.$tag->name.'",';
    echo '"value": "'.$tag->name.'"';
    echo '}';
    if($total !== $i){
        echo ',';
    }
}
}?>]