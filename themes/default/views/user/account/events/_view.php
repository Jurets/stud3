<tr>
<td class="owner txt">
<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$data->objectdata->userpic?>" alt="<?=$data->objectdata->username?>" class="userpic" />


<strong><?=$data->title?></strong>

<? if( $data->status == Events::STATUS_OPEN and $data->location ): ?>
<div class="grey">
<a href="/account/event/?id=<?=$data->id?>">Перейти</a>
</div>
<? endif; ?>
</td>
<td class="owner txtc"><?=Date_helper::date_smart($data->date)?></td>
</tr>