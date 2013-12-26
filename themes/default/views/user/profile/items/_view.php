<tr>


<td class="thumb" rowspan="2" style="width:120px;">
<a href="/items/<?=$data->id?>.html"><img src="<?=Yii::app()->getModule('items')->itemsDir?><?=$data->thumbnail?>" title="<?=$row['title']?>" /></a>

</td>

<td class="info">
<h4><a href="/items/<?=$data->id?>.html"><?=$data->title?></a></h4>
</td>

</tr>





<tr>
<td><?=Date_helper::date_smart($data->date)?></td>
</tr>

<tr>

<td colspan="2">

<? if( $data->status == Items::STATUS_CLOSE ): ?>
<i class="icon-remove"></i>
<? elseif( $data->status == Items::STATUS_OPEN ): ?>
<i class="icon-ok"></i>
<? endif; ?>

<?=$data->getStatus()?>
</td>
</tr>




