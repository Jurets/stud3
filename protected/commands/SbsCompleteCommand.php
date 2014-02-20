<?php
/**
* 
*/
class SbsCompleteCommand extends CConsoleCommand
{
    private $sourcefile = null;
    private $connection;
    private $message;
    
    private $countComplete;
    private $countDelay;
    
    public function init() {
        $this->countComplete = 0;  //кол-во успешно завершённых сделок
        $this->countDelay = 0;     //кол-во просроченных сделок
        //$this->connection = Yii::app()->db;
    }
    
    public function actionIndex() {
        echo "================================================================================\n\r";
        echo "FREE-STUD console command: SBS Auto completion (20 days after work done by performer) \n\r";
        echo "================================================================================\n\r";
        DebugBreak();
        //все сделки
        //$sbs_array = Sbs::model()->findAll('status <> :status', array(':status'=>Sbs::STATUS_COMPLETE));
        $criteria = new CDbCriteria(); 
        $criteria->addInCondition('status', array(Sbs::STATUS_ACTIVE, Sbs::STATUS_DONE)); 
        //$sbs_array = Sbs::model()->findAll('status in :status', array(':status'=>Sbs::STATUS_COMPLETE));
        $sbs_array = Sbs::model()->findAll($criteria);
        foreach ($sbs_array as $sbs) {
            $isDeliver = $sbs->isDeliver();  //флаг - была ли сдача работы
            $isExpire = $sbs->getIsExpire(); //признак невыполнения работы в указанные сроки (просрочка)
            
            if ($sbs->status == Sbs::STATUS_ACTIVE && $isExpire) { //если работа не сдана и есть просрочка
                if ($success = $sbs->delay()) { //поставить для сделки статус "просрочена"
                    $this->countDelay++;
                } else {
                    Yii::log('--Ошибка при смене статуса сделки (ИД='.$sbs->id.')'/*.$sbs->errors*/, CLogger::LEVEL_ERROR, 'sbs.autocomplete');
                }
            } else {
                $daysDeliver = $sbs->daysEtaComplete(); //кол-во дней оставшихся до конца 20-ти дневного срока
                
                if ($days == 0) { 
                    if ($isDeliver) {            //если была сдача работы
                        $isDemand = $sbs->isDemand(); //флаг - есть ли текущее требование от заказчика внести правки (исполнитель не выслал правки)
                        $isArbitration = isset($sbs->arbitration);  //определяем - есть ли арбитраж
                        if (!$isDemand && !$isArbitration) { //если нет требований правок и нет арбитража
                            if ($success = $sbs->complete()) { //завершить сделку
                                $this->countComplete++;
                            }
                        }
                    } else {                     //если НЕ было сдачи работы
                    }
                    
                }
            }
        
            /*if ($days == 0) { 
                if ($isDeliver) {            //если была сдача работы
                    $isDemand = $sbs->isDemand(); //флаг - есть ли текущее требование от заказчика внести правки (исполнитель не выслал правки)
                    $isArbitration = isset($sbs->arbitration);  //определяем - есть ли арбитраж
                    if (!$isDemand && !$isArbitration) { //если нет требований правок и нет арбитража
                        if ($success = $sbs->complete()) { //завершить сделку
                            $this->countComplete++;
                        }
                    }
                } else {                     //если НЕ было сдачи работы
                    if ($success = $sbs->delay()) { //поставить для сделки статус "просрочена"
                            $this->countDelay++;
                        }
                }
                
            } */
        
        }
        $str = 'Авто завершение сделок. Успешно завершено: ' . $this->countComplete . "\n\r";
        Yii::log($str, CLogger::LEVEL_INFO, 'sbs.autocomplete');
        echo $str;
        return true;
    }
    
}  
?>
