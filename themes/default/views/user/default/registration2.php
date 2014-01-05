<style type="text/css">
    .spec-header {
        margin-top: 10px;
        text-transform: uppercase;
        text-decoration: underline;
    }
    .spec-subheader {
        margin-top: 10px;
    }
</style>

<div id="container">
	<div id="content">
		<div class="page_title"><h1>Просим Вас выбрать специализацию вашей работы</h1></div>
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
                echo $form->hiddenField($model, 'step'); 
                
                $specializations = Yii::app()->db->createCommand('select * from ci_specialization')->queryAll();
                ?>
                <? foreach ($specializations as $key => $item) { ?>
                    <div class="catline" style="margin-left: <?=24*($item['level']-1)?>px;">
                        <? if ($item['ischeck']) { ?>
                            <input style="float: left; margin-right: 10px;" id="category_<?=$item['id']?>" class="checkbox" name="PerformerRegForm[specializations][]" value="<?=$item['id']?>" type="checkbox" <? if (in_array($item['id'], $model->specializations)) { ?> checked="checked"<? } ?>>
                            <label style="font-weight: normal; text-decoration: none; text-transform: none; overflow: hidden;" for="category_<?=$item['id']?>"><?=$item['name']?></label>
                        <? } else if ($item['level'] == 1) {?>
                            <p class="spec-header"><?=$item['name']?></p>
                        <? } else {?>
                            <p class="spec-subheader"><?=$item['name']?></p>
                        <? }?>
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