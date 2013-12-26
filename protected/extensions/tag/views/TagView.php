<?php
Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
$tag_it=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.extensions.tag').'/tag-it.js');
$tag_it_css=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.extensions.tag').'/tag-it.css');
$cs=Yii::app()->clientScript;
$cs->registerScriptFile($jui);
$cs->registerScriptFile($tag_it);
$cs->registerCssFile($tag_it_css);

$cs->registerScript($id,'
    $("#'.$id.'").tagit({
        tags: '.$tags.',
        url: "'.$url.'"
    });
', CClientScript::POS_READY);

?>


<ul id="<?php echo CHtml::encode($id);?>">
    <li class="tagit-new">
        <input class="tagit-input" type="text" />
    </li>
</ul>