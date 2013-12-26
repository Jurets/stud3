<?php
class Comments {

	/**
	 * Model with ETaggableBehavior attached
	 */
	public $model;

	public $id;
	public $level;
	private $lap = 0;

    public function init()
    {
        // this method is called by CController::beginWidget()
    }

    public function run()
    {
		$this->level = 3;
		echo $this->getComments();
    }

	function __construct( )
	{
		$assets = dirname(__FILE__).'/assets';
		$baseUrl = Yii::app()->assetManager->publish($assets);

		Yii::app()->clientScript->registerScriptFile($baseUrl . '/comment-reply.js', CClientScript::POS_HEAD);

		Yii::app()->clientScript->registerCssFile($baseUrl . '/comments.css');

		$this->id = (isset($post_id)) ? $post_id : "0";
		$this->level = (isset($level)) ? $level : "-1";
		
	}
	
	public function getComments()
	{
		$htmlComments = "";

    	$listcomments = Yii::app()->db->createCommand()
			->select('{{blogs_comments}}.*, username, userpic')
			->join('{{users}}', '{{users}}.id = {{blogs_comments}}.user_id')
			->from('{{blogs_comments}}')
			->where('blog_id = :id and parent_id = :parent_id', array(':id' => $this->id, ':parent_id' => 0))
			->queryAll();

		if( $listcomments )
		{
			foreach($listcomments as $row)
			{
				$htmlComments .= $this->hierarchy(0,$row,$this->lap);
			}
		}

		return '
		<div class="comments block">
			<div class="comments">'
			.$htmlComments.
			'</div>
		</div>
		'.$this->form($this->id, (isset($_GET['replytocom'])) ? $_GET['replytocom'] : "");
	}
	
	private function hierarchy( $hl, $row, $laps )
	{
if( Yii::app()->user->id == $row['user_id'] )
{
$text =  '<span class="editablecomment" data-pk="'.$row['id'].'" data-toggle="#comment'.$row['id'].'">'.nl2br($row['text']).'</span>
<br />
<a href="#" class="fr" id="comment'.$row['id'].'"><i class="icon-pencil"></i></a>';
}
else
{
$text =  nl2br($row['text']);
}
	
		$htmlComments = '
		<div class="comment '.(($hl == 0) ? 'item' : 'reply').'" id="comment-'.$row['id'].'">
			<div class="avatar">
				<img src="'.Yii::app()->getModule('user')->userpicsDir.$row['userpic'].'" class="avatar" height="65" width="65" />
				<div class="border">
					&nbsp;
				</div>
				'.(($hl == 0) ? '' : '<div class="line"></div>').'
			</div>
			<div class="info">
				<strong><a href="#" class="url">'.$row['username'].'</a></strong><em>'.Date_helper::date_smart($row['date']).'</em>
				'.(($this->level != $laps) ? '<a class="comment-reply" href="?replytocom='.$row['id'].'#respond" onclick=\'return addComment.moveForm("comment-'.$row['id'].'", "'.$row['id'].'", "respond", "'.$this->id.'")\'>Ответить</a>' : '').'
			</div>
			<div class="text">
				<div class="r">
					<div class="tl">
						<div class="tr">
							<div class="bl">
								<div class="br">
									<p>
										'.$text.'
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			';
		
		$laps++;

    	$listcomments = Yii::app()->db->createCommand()
			->select('{{blogs_comments}}.*, username, userpic')
			->join('{{users}}', '{{users}}.id = {{blogs_comments}}.user_id')
			->from('{{blogs_comments}}')
			->where('blog_id = :id and parent_id = :parent_id', array(':id' => $this->id, ':parent_id' => $row['id']))
			->queryAll();

		if( $listcomments )
		{
			if( $hl == 0 )
			{
				$htmlComments .= '<div class="children">';
			}
			else
			{
				$htmlComments .= '<div class="grandchildren">';
			}

			foreach($listcomments as $row)
			{
				if( $hl == 0 )
				{
					$htmlComments .= $this->hierarchy(1,$row,$laps);
				}
				else
				{
					$htmlComments .= $this->hierarchy(2,$row,$laps).((($hl == 2) and ($laps < 3)) ? '</div>' : '');
				}
			}

			if( ($hl == 2) and ($laps >= 3) )
			{
				$htmlComments .=  "</div>";
			}

			if( $hl != 2 )
			{
				$htmlComments .=  "</div>";
			}
		}

		$htmlComments .=  "</div>";

		return $htmlComments;
		
	}


	public function form( $id, $replytocom = NULL )
	{
		if( !Yii::app()->user->id )
		{
			return FALSE;
		}

		return '		
			<div id="respond">   
				<h2>Комментировать<a name="add"></a></h2>
				<form action="/blogs/default/AddComment" method="post"> 
					<fieldset>
						<p>
						<input type="hidden" name="csrf" value="'.Yii::app()->request->csrfToken.'" />
							<textarea name="text" id="comment" rows="8" cols="10" tabindex="4" class="textarea"></textarea> 
						</p>
						<br class="clear" />
						<div id="cancel-comment-reply"><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">Закрыть</a></div>
						<input name="submit" type="submit" id="submit" tabindex="5" value="Комментировать" />
						<input type="hidden" name="blog_id" value="'.$id.'" id="comment_post_ID" />
						<input type="hidden" name="parent_id" id="comment_parent" value="'.$replytocom.'" />
					</fieldset> 
				</form> 
			</div>
		';
	}
}
?>