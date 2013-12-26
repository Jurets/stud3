		<div id="container">
			<div id="content">

				<div class="prep">
                	<div class="simple_proj">
                    	<table>
							<tr>
								<td colspan="2">
								<h1><?=$model->title?></h1>
								</td>
							</tr>
                            <tr>
                                <td>
									<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$model->userdata->userpic?>" alt="" width="94" height="94" />
								</td>
                                <td>
									<b>Автор проекта:</b> <a href="/users/<?=$model->userdata->username?>"><?=$model->userdata->name?> <?=$model->userdata->surname?></a>	<br>						
									<b>Дата публикации:</b> <?=$model->date()?><br><br>
									<div class="tbl_01">
									<div class="cell"><p><b>Тип работы:</b> <?=$model->category()?></p></div>
									<div class="cell"><p><b>Специализация:</b> </p></div>
									<div class="cell"><p><b>Бюджет:</b> <?=$model->budget?> руб.</p></div> 
<? if( $model->day ): ?>
									<div class="cell"><p><b>Дата сдачи:</b> <?=$model->day?></p></div>
<? endif; ?>
									</div>
                                    <b>Описание:</b> <?=nl2br($model->text)?></p>
                                </td>
                            </tr>
							
                        </table>
                    </div>
				</div>
				<div class="cabinet">

<? if( $accept = $model->checkABid() ): ?>
<br />
<div class="alert alert-block">
  <h4>Исполнитель определен</h4>
<font class="frlname11"><a href="/users/<?=$accept->userdata->username?>"><?=$accept->userdata->username?></a></font>
</div>
<? endif; ?>


<? if( $bid ): ?>

<h2 class="offers-title"><?=($bid->isNewRecord) ? 'Добавить заявку' : 'Редактировать заявку'?></h2>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'bid', 
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
		'validateOnType' => false,
	),
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); 
?>
					<table border="0">
					<tr>
                        <th width="25%">Описание предложения:</th>
						<th width="25%">&nbsp;</th>
						<th width="50%">&nbsp;</th>
                    </tr>
                    <tr>
                        <td colspan="3">
<?php echo $form->textArea($bid,'text', array('class' => 'area')); ?>
<?php echo $form->error($bid,'text'); ?>
                        </td>
                    </tr>
					<tr>
                        <th>Стоимость:</th>
                    </tr>
					<tr>
						<td>
<?php echo $form->textField($bid,'budget_end', array('class' => 'inp_text')); ?> 
<?php echo $form->error($bid,'budget_end'); ?>
						</td>
						<td>
						<input type="submit" class="inp_sub" value="<?=($bid->isNewRecord) ? 'Добавить' : 'Сохранить'?>" />
						</td>
					</tr>
					</table>
<?php $this->endWidget(); ?>


<? endif; ?>


					</div>
				<div class="prep">
					<div class="simple_prep">


    <table class="offers-list">
<? if( !empty($model->bidslist) ): ?>

<? foreach($model->bidslist as $row): ?>
                            <tr>
                                <td>
									<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$row->userdata->userpic?>" alt="" width="94" height="94" />
								</td>
                                <td>
									<b>Специалист:</b> <a href="/users/<?=$row->userdata->username?>"><?=$row->userdata->username?></a>	<br>						
									<b>Дата сообщения:</b> <?=$row->date()?><br><br>
									
									<p><b>Описание:</b> <?=$row->text?></p>
                                    <p><b>Стоимость:</b> <?=$row->budget()?></p>


<? if( Yii::app()->user->id == $row->user_id && $row->status == Bids::STATUS_ACTIVE  ): ?>
<i class="icon-pencil"></i> <a href="/tenders/<?=$row->project_id?>.html?action=edit#bid">Редактировать</a> 
<i class="icon-remove"></i> <a href="/tenders/bidmanagement?id=<?=$row->id?>&action=reject" class="red">Отказать от проекта</a>
<? endif; ?>

<? if( Yii::app()->user->id == $model->user_id && $row->status == Bids::STATUS_ACTIVE ): ?>
<div class="payd-link">
<a href="/tenders/bidmanagement?id=<?=$row->id?>&action=decline" class="btn btn-mini">Отклонить</a> 
<a href="/tenders/bidmanagement?id=<?=$row->id?>&action=accept" class="btn btn-mini" id="all">Выбрать исполнителем</a> 
</div>
<? endif; ?>
                                </td>
                            </tr>
                            
                            

<? endforeach; ?>
<? else: ?>
<tr>
<td><strong>Заявки отсутствуют.</strong></td>
</tr>
<? endif; ?>
</table>

                    </div>
                   
                </div>
				

			</div><!-- #content-->
		</div><!-- #container-->

		<div class="sidebar" id="sideLeft">

<? $this->widget('MenuWidget') ?>
            
		</div><!-- .sidebar#sideLeft -->