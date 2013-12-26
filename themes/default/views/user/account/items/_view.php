<tr>


<td class="thumb" rowspan="3" style="width:120px;">
<a href="/items/<?=$data->id?>.html"><img src="<?=Yii::app()->getModule('items')->itemsDir?><?=$data->thumbnail?>" title="<?=$row['title']?>" /></a>

</td>

<td class="info">
<h4><a href="/items/<?=$data->id?>.html"><?=$data->title?></a></h4>
</td>

</tr>

<tr>
<td>
<p><?=$data->text?></p>
</td>
</tr>




<tr>
<td><?=Date_helper::date_smart($data->date)?></td>
</tr>




<tr>

<td class="options" colspan="2">

<? if( $data->status == Items::STATUS_CLOSE ): ?>
<i class="icon-remove icon-white"></i>
<? elseif( $data->status == Items::STATUS_OPEN ): ?>
<i class="icon-ok icon-white"></i>
<? elseif( $data->status == Items::STATUS_MODERATION ): ?>
<i class="icon-time icon-white"></i>
<? endif; ?>

<?=$data->getStatus()?>

<span class="fr">
<a href="/items/publication?id=<?=$data->id?>">Редактировать</a>
<? if( $data->status == Items::STATUS_CLOSE ): ?>
 | <a href="/items/management?id=<?=$data->id?>&action=open">Открыть</a>
<? endif; ?>

<? if( $data->status == Items::STATUS_OPEN ): ?>
 | <a href="/items/management?id=<?=$data->id?>&action=close">Закрыть</a>
<? endif; ?>
</span>
</td>
</tr>