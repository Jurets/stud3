<tr>
<td class="owner txtc"><?=Date_helper::date_smart($data->date)?></td>
<td class="budget txtc<? if( $data->amount < 0 ): ?> red<? else: ?> green<? endif; ?>"><strong><?=$data->amount?></strong> рублей</td>
<td class="owner txtc"><?=$data->descr?></td>
</tr>