<!-- This contains the hidden content for inline calls -->
<div class="body2">
	<div id="inline_content">
		<div class="modal_top">
        	<div class="modal_bottom">
            	<div class="modalbox">
                	<a href="#" title="Закрыть" id="close" onclick="portfolio.close(<?=$data->id?>); return false;">Закрыть</a>
					<div class="for_img"><img src="<?=Yii::app()->getModule('portfolio')->portfolioDir?><?=$data->preview?>" /></div><!-- end_image -->
                    <div class="info">
                    	<div class="title"><h2><?=$data->title?></h2></div>
                    	<div class="sender">Отправитель: <a href="/users/<?=$data->userdata->username?>"><?=$data->userdata->username?></a></div>
                    	
<ul class="opt">
<li><a class="like<? if( $data->checkLike() ): ?> active<? endif; ?>" href="#" title="Нравится" onclick="portfolio.like(<?=$data->id?>, this); return false;"><?=$data->like?></a></li>
</ul>

                    </div><!-- end_info -->
<? if( Yii::app()->user->isAuthenticated() ): ?>
                    <div class="comments_box">
                    	<form action="" method="post" id="bid_<?=$data->id?>">
                        	<fieldset>
                            	<div class="clearbox">
                            		<label>Комментарий:</label>
                                	<textarea name="text" cols="4" rows="4"></textarea>
                                </div><!-- end_clear -->
                                <div class="button_b">
                                	<div>
                                    	<input type="button" value="Публиковать" onclick="portfolio.send(<?=$data->id?>, this); return false;" />
                                        <span></span>
                                    </div>
                                </div><!-- end_button -->
                            </fieldset>
                        </form>
                    </div><!-- end_comments_box -->
<? endif; ?>
                    <ul id="bids_<?=$data->id?>" class="answers">
<? foreach($comments as $row): ?>
                    	<li>
                        	<div class="text">
                            	<div class="line">
                                	<a href="#" title="<?=$row->userdata->username?>"><?=$row->userdata->username?></a>
                                	<span class="date"><?=$row->date?></span>
                                </div><!-- end_line -->
                                <p><?=$row->text?></p>
                            </div><!-- end_text -->
                        </li>
<? endforeach; ?>
                	</ul><!-- end_answers -->
                </div><!-- end_modal -->
            </div><!-- end_modal_bottom -->
        </div><!-- end_modal_top -->
	</div><!-- end_inline_content -->
</div>
<!-- This contains the hidden content for inline calls -->