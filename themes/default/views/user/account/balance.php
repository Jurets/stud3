<?php echo $this->renderPartial('head'); ?>

<div id="yui-main">
<div class="yui-b">

<h1>Баланс</h1>

<div id="msearch">
<form id="pay" name="pay" method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp"> 
<input type="hidden" name="LMI_PAYEE_PURSE" value="<? echo $purse ?>">
<input type="hidden" name="user_id" value="<? echo Yii::app()->user->id ?>">

<div>Сумма: <input name="LMI_PAYMENT_AMOUNT" type="text" maxlength="6"></div>

<div class="form-actions">
<button type="submit" class="btn">Пополнить</button>
</div>

</form>
</div>


</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>