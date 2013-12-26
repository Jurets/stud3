<script type="text/javascript">

    jQuery(function($){

      // Create variables (in this scope) to hold the API and image size
      var jcrop_api, boundx, boundy;
      
      $('#target').Jcrop({

        onChange: updatePreview,
        onSelect: updatePreview,
        aspectRatio: 1,

		minSize: [100, 100]
		
      },function(){
        // Use the API to get the real image size
        var bounds = this.getBounds();
        boundx = bounds[0];
        boundy = bounds[1];
        // Store the API in the jcrop_api variable
        jcrop_api = this;
				jcrop_api.animateTo([0,0,100,100]);
		api.setOptions({ bgFade: true});
      });

			function updateCoords(c)
			{
				//alert(c);
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};

			function checkCoords()
			{
				if (parseInt($('#w').val())) return true;
				alert('Please select a crop region then press submit.');
				return false;
			};

      function updatePreview(c)
      {				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
        if (parseInt(c.w) > 0)
        {
          var rx = 100 / c.w;
          var ry = 100 / c.h;

          $('#preview').css({
            width: Math.round(rx * boundx) + 'px',
            height: Math.round(ry * boundy) + 'px',
            marginLeft: '-' + Math.round(rx * c.x) + 'px',
            marginTop: '-' + Math.round(ry * c.y) + 'px'
          });
        }
      };

    });

  </script>
  
<div id="yui-main">
<div class="yui-b">

<h1>Юзерпик</h1>

<?php $this->widget('FlashMessages'); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action' => '/user/account/crop',
	'errorMessageCssClass' => 'alert alert-error',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'onsubmit' => 'return checkCoords();'),
)); ?>

<table class="images">
<tr>
<td>
<img src="<?=Yii::app()->getModule('user')->userpicsDir?>/contacts/<?=$model->userpic?>" alt="" >
<img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$model->userpic?>" alt="" id="target"><br>
</td>
</tr>         
</table>

<input type="hidden" id="crop_x" name="crop_x" />
<input type="hidden" id="crop_y" name="crop_y" />
<input type="hidden" id="crop_w" name="crop_w" />
<input type="hidden" id="crop_h" name="crop_h" />

<br>
<div class="form-actions">
<button type="submit" class="btn btn-info">Сохранить</button>
</div>


          
<?php $this->endWidget(); ?>
        
          <div style="width:100px;height:100px;overflow:hidden;">
            <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$model->userpic?>" id="preview" alt="Preview" class="jcrop-preview" />
          </div>

</div>
</div>
<!--/yui-main-->

<?php echo $this->renderPartial('block'); ?>