<div id="container">
    <div id="content">

        <div class="prep">
            <div class="simple_cont">
                <?php $this->widget('FlashMessages'); ?>
                <?php $form = $this->beginWidget('CActiveForm', array(
                        'id'=>'registration-form',
                        'enableClientValidation'=>true,
                        'errorMessageCssClass'=>'alert alert-error',
                        'clientOptions'=>array(
                            'validateOnSubmit'=>true,
                            //'validateOnChange'=>true,
                            //'validateOnType'=>false,
                        ),
                    )); 
                ?>
                <table>
                    <tr>
                        <td colspan="2">
                            <h1>Восстановление пароля</h1>
                            <h3>Чтобы восстановить пароль, выполните нижеследуюшее предписание</h3>
                            <p>&nbsp;</p>
                            <p>1. Введите ваш email</p>
                            <p>2. Вы получите сообщение на ваш email адрес с ссылкой в теле письма. Кликните на нее, чтобы войти</p>
                            <p>3. Затем, войдите в ваш профиль и установите новый пароль</p>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">
                            <?php echo $form->labelEx($model, 'email'); ?>
                            <?php echo $form->textField($model, 'email', array('class' => 'inp_text')); ?>
                            <?php echo $form->error($model,'email'); ?>
                        </td><td width="70%"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" class="inp_sub" value="ОТПРАВИТЬ" /></td><td width="70%"></td>
                    </tr>
                </table>
                <?php $this->endWidget(); ?>
            </div>


        </div>


    </div><!-- #content-->
</div><!-- #container-->