<div id="poll-block">
  <h3>Опрос</h3>
  <div class="poll">
    <div class="vote-form">
      <div class="choices">
          <div class="title"><?=$data->question?></div>



        <div class="form-radios">

<? foreach($data->options as $option): ?>
<div class="form-item">
<label class="option" for="edit-choice-<?=$option->id?>"><input type="radio" id="edit-choice-<?=$option->id?>" name="poll_vote" value="<?=$option->id?>" class="form-radio" /> <?=$option->option?></label>
</div>
<? endforeach; ?>


</div>      </div>
<button type="submit" class="btn btn-mini fl" onclick="vote(<?=$row['id']?>)">Голосовать</button> 

 

      <div class="votes">голосовало: <?=$data->count?></div>
    </div>
  </div>
  <div class="enddiv"></div>

</div>