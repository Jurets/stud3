			<div class="aside f" id="topwidget">
				<h2 style="margin-bottom:5px;"><?=$title?></h2>
<span class="navusers">
<a href="#" class="label<? if( $this->specialization == User::SPECIALIZATION_DESIGNER): ?> label-info<? endif; ?>" onclick="topwidget(<?=User::SPECIALIZATION_DESIGNER?>);">Дизайнеры</a>
<a href="#"  class="label<? if( $this->specialization == User::SPECIALIZATION_DEVELOPER): ?> label-info<? endif; ?>" onclick="topwidget(<?=User::SPECIALIZATION_DEVELOPER?>);">Разработчики</a>
<br /><br />
<a href="#"  class="label<? if( $this->specialization == User::SPECIALIZATION_COPYWRITER): ?> label-info<? endif; ?>" onclick="topwidget(<?=User::SPECIALIZATION_COPYWRITER?>);">Копирайтеры</a>
<br /><br />
<a href="#"  class="label<? if( $this->specialization == User::SPECIALIZATION_SYSTEM): ?> label-info<? endif; ?>" onclick="topwidget(<?=User::SPECIALIZATION_SYSTEM?>);">Системные администраторы</a>
<br />
<br />
</span>

<? if( $users ): ?>
<ul class="withimages">

<? foreach($users as $row): ?>
        <li>
<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$row['userpic']?>" alt="" class="avatar" width="60" />
<font class="frlname11"><a href="/users/<?=$row['username']?>" class="frlname11"><?=$row['name']?> <?=$row['surname']?></a> [<a href="/users/<?=$row['username']?>" class="frlname11"><?=$row['username']?></a>]</font>  

<? if( $row['id'] != Yii::app()->user->id ): ?>
<ul class="nav nav-list txt-small">
<li><a href="/users/invite/<?=$row['username']?>"><i class="icon-plus"></i> <strong>Добавить в контакты</strong></a></li>
</ul>
<? endif; ?>
        </li>
        
<? endforeach; ?>
</ul>
<? else: ?>
<strong>Ничего не найдено</strong>
<? endif; ?>
			</div>