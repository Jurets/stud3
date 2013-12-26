<?php
class FlashMessages extends CWidget
{
    const ERROR = 'error';// ошибка
	
    const INFO = 'info';

    const WARNING = 'warning';// предупреждение

    const SUCCESS = 'success';// готово


    public $error = 'error';

    public $warning = 'warning';

    public $info = 'info';

    public $success = 'success';


    public $autoHide = false;

    public $autoHideSeconds = 3600;

    public $divId = 'flash';

    public $customJsCode;

    public function run()
    {
        if (count(Yii::app()->user->getFlashes(false)))
        {
					
            if ($this->autoHide)
            {
                $this->autoHideSeconds = (int)$this->autoHideSeconds;
                $this->error = CHtml::encode($this->error);
                $this->warning = CHtml::encode($this->warning);
                $this->notice = CHtml::encode($this->notice);
                Yii::app()->getClientScript()->registerCoreScript('jquery');
                Yii::app()->getClientScript()->registerScript(md5($this->id), "
                        $('#{$this->divId}').fadeOut({$this->autoHideSeconds});                        
                ", CClientScript::POS_END);
            }
            elseif ($this->customJsCode)
            {
                Yii::app()->getClientScript()->registerCoreScript('jquery');
                Yii::app()->getClientScript()->registerScript(md5($this->customJsCode), $this->customJsCode, CClientScript::POS_END);
            }

            $this->render('flashmessages');
        }
    }
}