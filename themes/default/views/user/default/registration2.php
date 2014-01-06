<style type="text/css">
    .spec-header {
        margin-top: 10px;
        text-transform: uppercase;
        text-decoration: underline;
        cursor: pointer;
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
                //echo $form->hiddenField($model, 'step'); 
                echo $form->error($model, 'specializations');
                
                $specializations = Yii::app()->db->createCommand('select * from ci_specialization')->queryAll();
                $is_subtree = false;
                foreach ($specializations as $key => $item) { 
                    if ($item['level'] == 1) { 
                        $is_subtree = true; 
                        if ($is_subtree) { 
                            $is_subtree = false; ?>
                            </div>
                        <? } ?>
                        <div class="tree-header" style="margin-left: <?=24*($item['level']-1)?>px;">
                            <p class="spec-header"><?=$item['name']?></p>
                        </div>
                        <div id="subtree_<?=$item['id']?>" style=" display: none;">
                    <? } else { ?>
                        <div class="catline" style="margin-left: <?=24*($item['level']-1)?>px;">
                            <? if ($item['ischeck']) { ?>
                                <input style="float: left; margin-right: 10px;" id="category_<?=$item['id']?>" class="checkbox" name="PerformerRegForm[specializations][]" value="<?=$item['id']?>" type="checkbox" <? if (in_array($item['id'], $model->specializations)) { ?> checked="checked"<? } ?>>
                                <label style="font-weight: normal; text-decoration: none; text-transform: none; overflow: hidden;" for="category_<?=$item['id']?>"><?=$item['name']?></label>
                            <? } else {?>
                                <p class="spec-subheader"><?=$item['name']?></p>
                            <? } ?>
                        </div>
                        <? } ?>
                <? } ?>
                </div>
                
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

<?
$str = <<<BLOCK
$('.tree-header')
    .on('click', function() {
        elem = $(this).next();
//        list = elem.children();
//        list.each(
//            function(indx, element) {
//                if ($(element).css('display') == 'none') {
//                    $(element).slideDown();
//                } else {
//                    input = $(element).children('input');
//                    if (!input.checked) {
//                        $(element).slideUp();
//                    }
//                }
//            }
//        );
        
        if (elem.css('display') == 'none')
            elem.slideDown();
        else
            elem.slideUp();
    });
BLOCK;
    Yii::app()->clientScript->registerScript('tree-slide', $str, CClientScript::POS_READY);
?>