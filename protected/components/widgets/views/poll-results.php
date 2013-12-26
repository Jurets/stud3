<div id="poll-block">

  <h3>Опрос</h3>
  <div class="poll">
    <div class="title"><?=$data->question?></div>

<? foreach($data->options as $option): ?>
<div class="text"><?=$option->option?></div>
<div class="bar">
  <div style="width: <?=$option->percent?>%;" class="foreground"></div>
</div>
<div class="percent">
  <?=$option->percent?>%
</div>
<? endforeach; ?>

    <div class="total">
      <div class="votes">голосовало: <?=$data->count?></div>
    </div>
  </div>
  <div class="enddiv"></div>

</div>