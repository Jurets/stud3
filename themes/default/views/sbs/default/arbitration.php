<h3 class="title"><?=$model->project->title?></h3>
<?php $this->widget('FlashMessages'); ?>

<div class="yui-g">

    <div class="desc">Создан <?=Date_helper::date_smart($model->date)?></div>

    <div class="desc">
        Заказчик <?=$model->customer->_online?> 
        <font class="frlname11"><a href="/users/<?=$model->customer->username?>" class="frlname11"><?=$model->customer->name?> <?=$model->customer->surname?></a> [<a href="/users/<?=$model->customer->username?>" class="frlname11"><?=$model->customer->username?></a>]</font>
    </div>

    <div class="desc">
        Исполнитель <?=$model->performer->_online?> 
        <font class="frlname11"><a href="/users/<?=$model->performer->username?>" class="frlname11"><?=$model->performer->name?> <?=$model->performer->surname?></a> [<a href="/users/<?=$model->performer->username?>" class="frlname11"><?=$model->performer->username?></a>]</font> 
    </div>

    <div class="subtitle"></div>

</div>


<div id="yui-main">
    <div class="clearfix">

        <?php $form = $this->beginWidget('CActiveForm', array(
                'enableClientValidation'=>true,
                'errorMessageCssClass'=>'alert alert-error',
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                    'validateOnChange'=>true,
                ),
            )); 
        ?>

        <?php echo $form->textArea($arbitration,'text', array('class' => 'area', 'rows' => '4', 'cols' => '58', 'style' => 'width: 758px;')); ?>
        <?php echo $form->error($arbitration,'text'); ?>

        <div class="form-actions">
            <button type="submit" class="btn">Отправить</button>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
