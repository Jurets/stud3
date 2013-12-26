<div id='<?php echo $this->divId;?>' class='flash'>

    <?php if (Yii::app()->user->hasFlash($this->success)): ?>
    <div class='alert alert-success'>
    <a class="close" data-dismiss="alert">&times;</a>
        <b><?php echo Yii::app()->user->getFlash($this->success);?></b>
    </div>
    <?php endif;?>

    <?php if (Yii::app()->user->hasFlash($this->error)): ?>
    <div class='alert alert-error'>
    <a class="close" data-dismiss="alert">&times;</a>
        <b><?php echo Yii::app()->user->getFlash($this->error);?></b>
    </div>
    <?php endif;?>

    <?php if (Yii::app()->user->hasFlash($this->info)): ?>
    <div class='alert alert-info'>
    <a class="close" data-dismiss="alert">&times;</a>
        <b><?php echo Yii::app()->user->getFlash($this->info);?></b>
    </div>
    <?php endif;?>

    <?php if (Yii::app()->user->hasFlash($this->warning)): ?>
    <div class='alert alert-block'>
    <a class="close" data-dismiss="alert">&times;</a> 
        <b><?php echo Yii::app()->user->getFlash($this->warning);?></b>
    </div>
    <?php endif;?>

</div>  

