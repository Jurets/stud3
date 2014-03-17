<h3>Создать новую сделку для проекта "<?=$tender->title?>"</h3>
<?php $this->widget('FlashMessages'); ?>

<?php $form = $this->beginWidget('CActiveForm', array(
        'enableClientValidation'=>true,
        'errorMessageCssClass'=>'alert alert-error',
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>true,
        ),
    )); 
?>
<div class="rnd">
    <table class="order-form">
        <?php if (!empty($userid) && $user = User::model()->findByPk($userid)) { ?>
            <tr>
                <td>Исполнитель: <a rel="performer" title="Исполнитель" href="/users/<?=$user->username?>"><?=$user->username?></a></td>
            </tr>
            <tr><td>&nbsp;</td></tr> 
        <?php }?>
        
        <tr<?php if (!empty($userid)) echo ' style="display: none;"' ?>>
            <td class="caption">Выберите исполнителя</td>
            <td>
                <? if (!empty($tender->bidslist)) { ?>
                    <table>
                        <tr>
                            <td style="width:25px;"></td>
                            <td></td>
                        </tr>
                        <? foreach($tender->bidslist as $row) { 
                            $htmlOptions = array('value'=>$row->user_id,'uncheckValue'=>null);
                            if ($row->user_id == $userid) {
                                $htmlOptions['checked'] = 'checked';
                            }
                        ?>
                            <tr>
                                <td class="owner txtc"><?php echo $form->radioButton($model,'performer_id', $htmlOptions /*array('value'=>$row->user_id,'uncheckValue'=>null)*/); ?></td>
                                <td>
                                    <ul class="ocard">
                                        <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$row->userdata->userpic?>" alt="" class="avatar" width="60" />
                                        <li class="black">
                                            <?=$row->userdata->_tariff?> 
                                            <?=$row->userdata->_online?> 
                                            <font class="frlname11"><a href="/users/<?=$row->userdata->username?>" class="frlname11"><?=$row->userdata->name?> <?=$row->userdata->surname?></a> [<a href="/users/<?=$row->userdata->username?>" class="frlname11"><?=$row->userdata->username?></a>]</font>
                                        </li>
                                        <li>
                                            Отзывы 
                                            <a class="rev-positive" href="/users/reviews/<?=$row->userdata->username?>/?review=positive"><?=$row->userdata->static->reviews_positive?></a>
                                            <? if( $row->userdata->static->reviews_negative ): ?>
                                                <a class="rev-negative" href="/users/reviews/<?=$row->userdata->username?>/?review=negative"><?=$row->userdata->static->reviews_negative?></a>
                                            <? endif; ?>
                                        </li>
                                        <li><a href="/contacts/send/<?=$row->userdata->username?>">Личное сообщение</a></li>
                                    </ul>
                                </td>
                            </tr>
                        <? } ?>
                    </table>
                <? } else { ?>
                    <div class="alert alert-error">
                        Вы не можете начать сбс пока никто не оставил заявку в проект.
                    </div>
                <? } ?>

                <?php echo $form->error($model,'performer_id'); ?>
            </td>
        </tr>

        <tr>
            <td class="caption">Сроки</td>
            <td>
                <?php echo $form->textField($model, 'period', array('value' => '', 'size' => 7)); ?> дней
                <?php echo $form->error($model,'period'); ?>
            </td>
        </tr>

        <tr>
            <td class="caption">Сумма сделки</td>
            <td>
                <?php echo $form->textField($model, 'amount', array('value' => '', 'size' => 7)); ?> рублей
                <?php echo $form->error($model,'amount'); ?>
            </td>
        </tr>


    </table>

    <div class="form-actions">
        <? if (!empty($tender->bidslist)) { ?>
            <button type="submit" class="btn">Предложить сделку</button>
        <? } else { ?>
            <a href="/account/tenders" class="btn">Назад</a>
        <? } ?>
    </div>

</div>
<?php $this->endWidget(); ?>
