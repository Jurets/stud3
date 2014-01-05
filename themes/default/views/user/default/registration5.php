<div id="container">
	<div id="content">
		<div class="page_title"><h1>Выберите типы выполняемых работ</h1></div>
		<div class="cabinet">
            <?php $form = $this->beginWidget('CActiveForm', array(
	            'id'=>'registration-form',
	            'enableClientValidation' => false,
	            'enableAjaxValidation' => false,
	            'focus'=>array($model,'username'),
	            'errorMessageCssClass'=>'alert alert-error',
	            'clientOptions' => array(
		            'validateOnSubmit' => true,
		            'validateOnChange' => true,
		            'validateOnType' => false,
	            ),
            ));  
                $categories = Yii::app()->db->createCommand('select * from ci_categories')->queryAll();
                ?>
                <? foreach ($categories as $key => $item) { ?>
                    <div class="catline" style="margin-left: <?=24*($item['level']-1)?>px;">
                        <input style="float: left; margin-right: 10px;" id="category_<?=$item['id']?>" class="checkbox" name="PerformerRegForm[categories][]" value="<?=$item['id']?>" type="checkbox">
                        <label style="font-weight: normal; text-decoration: none; text-transform: none; overflow: hidden;" for="category_<?=$item['id']?>"><?=$item['name']?></label>
                    </div>
                <? } ?>

	            <table>
		            <tr>
			            <td><input type="submit" class="inp_sub" value="ПРОДОЛЖИТЬ" /></td>
		            </tr>
                </table>
                
            <?php $this->endWidget(); ?>
        </div>
    </div><!-- #content-->
</div><!-- #container-->

<div class="sidebar" id="sideLeft">
    <? $this->widget('MenuWidget') ?>
</div><!-- .sidebar#sideLeft -->