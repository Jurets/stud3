		    	<h5 class="widget-name"><i class="icon-th"></i>Арбитраж</h5>

                <!-- Media datatable -->
                <div class="widget">
                	<div class="navbar">
                    	<div class="navbar-inner">
                        	<h6><strong><?=$model->arbitration->userdata->username?> подал жалобу в арбитраж</strong></h6>
                        </div>
                    </div>
                    <div class="table-overflow">

<? foreach($model->letters as $row): ?>
<div class="answer" id="comment<?=$row->id?>">

<div class="com-title">
Добавил <a rel="nofollow" href="/users/<?=$row->userdata->username?>"><?=$row->userdata->username?></a> <?=Date_helper::date_smart($row->date)?>
</div>
<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$row->userdata->userpic?>" alt="<?=$row->userdata->username?>" class="userpic" />

<div class="com-text">
<?=nl2br($row->text)?>
</div>

</div>
<? endforeach; ?>


<?php $form = $this->beginWidget('CActiveForm', array(
'action' => '/administrator/default/arbitration/?id='.$model->id,
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert alert-error',
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnChange'=>true,
	),
)); 
?>

<?php echo CHtml::hiddenField('sbs_id', $model->id);?>

<div class="comments-form">
<h4>Добавить комментарий</h4>

<div>
<?php echo $form->textArea($comment,'text', array('rows' => 7, 'cols' => 60)); ?>
<?php echo $form->error($comment, 'text'); ?>
</div>
<div class="comments-send">


<div class="form-actions">
<button type="submit" class="btn">Добавить</button>
</div>
</div>
</div>
<?php $this->endWidget(); ?>

                    </div>
                </div>
                <!-- /media datatable -->