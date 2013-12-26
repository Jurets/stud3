		<div id="container">
			<div id="content">
            
<style>
#tender {
	display:none;
}
#vacancy {
	display:none;
}
</style>
<div id="yui-main">
<div class="yui-b clearfix"> 

<h1 class="title">Опубликовать проект</h1>


<?php $form = $this->beginWidget('CActiveForm', array(
	'enableClientValidation' => true,
	'enableAjaxValidation' => true,
	'errorMessageCssClass'=>'none',
	'clientOptions' => array(
		'validateOnSubmit' => true,
		'validateOnChange' => true,
		'validateOnType' => false,
		'afterValidate' => 'js:function(form, data, hasError){
			string = "";
			$.each(data, function(index, value)
			{ 
				if(index != "__proto")
				{
					var temp = data[index][0];
					string += "<li>"+temp+"</li>";
				}
			});
			if(hasError) messages(\'error\', string);  
			if(!hasError) return true;    
		}'
	),
)); 
?>
<span class="none">
<?php echo $form->error($model,'category'); ?>
<?php echo $form->error($model, 'title'); ?>
<?php echo $form->error($model, 'text'); ?>
<?php echo $form->error($model, 'budget'); ?>
<?php echo $form->error($rmodel, 'username'); ?>
<?php echo $form->error($rmodel, 'email'); ?>
</span>
                	<table border="0">
                    	<tr>
							<th width="50%">Тип работы:</th>
							<th width="25%">Кол-во страниц:</th>
							<th width="25%">Размер шрифра::</th>
                        </tr>
                        <tr>
                            <td>
                            	<div class="select">
<?php echo $form->dropDownList($model, 'category', CHtml::listData($categories, 'id', 'name'), array('empty' => 'Выберите тип')); ?>

                                    <div class="errow"></div>
                                </div>
                            </td>
                            <td>
<?php echo $form->textField($model, 'pages', array('class' => 'inp_text')); ?>

                            </td>
							<td>

<?php echo $form->textField($model, 'font', array('class' => 'inp_text')); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Специализация:</th>
							<th>Дата выполнения работы:</th>
							<th>Бюджет:</th>
                        </tr>
                        <tr>
                            <td>
                            	<div class="select">
                                    <select>
                                        <option>Экономика</option>
                                        <option>Математика</option>
                                        
                                    </select>
                                    <div class="errow"></div>
                                </div>
                            </td>
                            <td>
                            	<div style="width: 60px;">
<?php echo $form->textField($model, 'day', array('class' => 'inp_text', 'size' => 2)); ?>

                                    <div class="errow"></div>
                                </div>
                                <strong></strong>
                                <div class="select" style="width: 105px;">
<?php echo $form->dropDownList($model, 'currency', 
array(
'1' => 'Января', 
'2' => 'Февраля', 
'3' => 'Марта', 
'4' => 'Апреля', 
'5' => 'Мая', 
'6' => 'Июня', 
'7' => 'Июля', 
'8' => 'Августа', 
'9' => 'Сентября', 
'10' => 'Октября', 
'11' => 'Ноября', 
'12' => 'Декабря', 
)); ?>
                                    <div class="errow"></div>
                                </div>                
                            </td>
							 <td colspan="2">
<?php echo $form->textField($model, 'budget', array('class' => 'inp_text')); ?>

							</td>
                        </tr>
						<tr>
                            <th colspan="3">Тема работы:</th>
                        </tr>
                        <tr>
                            <td colspan="3">
<?php echo $form->textField($model, 'title', array('class' => 'inp_text')); ?>
</td>
                        </tr>
                        <tr>
                            <th colspan="3">Описание заказа:</th>
                        </tr>
                        <tr>
<td colspan="3">
<?php echo $form->textArea($model, 'text', array('class' => 'area')); ?>
</td>
                        </tr>

						<tr>
                            <th colspan="3">Добавление файлов:</th>
                        </tr>
                        <tr>
                            <td colspan="3">
<? $this->widget('ext.EAjaxUpload.EAjaxUpload',
array(
	'id'=>'uploadFiles',
	'config' => array(
		'action' => '/main/upload',
		'allowedExtensions' => array("jpg", "jpeg", "gif", "png"),
		'sizeLimit' => 10*1024*1024,// maximum file size in bytes
		'onComplete' => "js:function(id, fileName, responseJSON){ addUploadFile(responseJSON); }",
		'messages' => array(
			'typeError' => "Файл {file} имеет недопустимое расширение. Расширения доступные к загрузке: {extensions}.",
		),
	)
));
?>
                            </td>
                        </tr>


                    </table>
<? if( !Yii::app()->user->isAuthenticated() ): ?>
					<table>
						<tr>
                            <th width="33%">Логин:</th>
							<th width="33%">Email:</th>
							<th width="33%"></th>	
							<th width="33%"></th>	
                        </tr>
						<tr>
						<td><?php echo $form->textField($rmodel, 'username', array('class' => 'inp_text')); ?></td>
						<td><?php echo $form->textField($rmodel, 'email', array('class' => 'inp_text')); ?></td>
						</tr>
                    </table>

<? endif; ?>
<input type="submit" class="inp_sub" value="СДЕЛАТЬ ЗАКАЗ" />
<?php $this->endWidget(); ?>    
</div>
</div>

    

<script type="text/javascript">


var type = $('input:radio:checked[name=Tenders[type]]').val();
		if( type == '2' )// конкурс
		{
			$('#tender').show();
		}

		if( type == '3' )// вакансия
		{
			$('#vacancy').show();
		}
	$("#Tenders_type").change(function() {

		var type = $('input:radio:checked[name=Tenders[type]]').val();

		$('#tender').hide();

		$('#vacancy').hide();

		if( type == '2' )// конкурс
		{
			$('#tender').show();
		}

		if( type == '3' )// вакансия
		{
			$('#vacancy').show();
		}
	});



						$('#reportrange').daterangepicker(
							{
								ranges: {
									'Один день': ['today', Date.today().add({ days: +1 })],
									'Два дня': ['today', Date.today().add({ days: +2 })],
									'Три дня': ['today', Date.today().add({ days: +3 })],
									'Неделя': ['today', Date.today().add({ days: +7 })],
									'Две недели': ['today', Date.today().add({ days: +14 })],
									'Месяц': ['today', Date.today().add({ days: +30 })],
								},
								opens: 'left',
								format: 'MM/dd/yyyy',
								startDate: Date.today(),
								endDate: Date.today().add({ days: +29 }),
								//minDate: '<?=date('d')?>/<?=date('m')?>/<?=date('Y')?>',
								maxDate: '12/31/2013',
						        	locale: {
						            		applyLabel: 'Принять',
						            		fromLabel: 'От',
						            		toLabel: 'До',
						            		customRangeLabel: 'Указать',
						            		daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
						            		monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
						            		firstDay: 1
						        	}
							}, 
							function(start, end) {
								$('#reportrange span').html(start.toString('MMMM d, yyyy') + ' - ' + end.toString('MMMM d, yyyy'));
							}
						);

						//Set the initial state of the picker label
						$('#reportrange span').html(Date.today().add({ days: -29 }).toString('MMMM d, yyyy') + ' - ' + Date.today().toString('MMMM d, yyyy'));


</script>



			</div><!-- #content-->
		</div><!-- #container-->
