<h3><?=$this->pageTitle?></h3>
<?php $this->widget('FlashMessages'); ?>

<!--<p class="caption">Исполнителю <strong><?=$sbs->performer->nickName?></strong> отправлена информация о предложенной Вами сделке. Ожидайте подтверждения в ближайшее время</p>-->
<p class="caption"><?=$message?></p>

<div class="rnd">
    <table class="order-form">

        <tr>
            <td class="caption">Название проекта</td>
            <td><?=$sbs->project->title?></td>
        </tr>

        <tr>
            <td class="caption">Сроки (дней)</td>
            <td><?=$sbs->period?></td>
        </tr>

        <tr>
            <td class="caption">Сумма сделки</td>
            <td><?=$sbs->amount?></td>
        </tr>


    </table>

    <?  if (isset($url) && !empty($url)) {?>
        <a href="<?=$url?>">Перейти на страницу сделки</a>
    <?  }?>
    
</div>
