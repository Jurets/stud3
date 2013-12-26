<!-- sample modal content -->
          <div id="myModal" class="modal">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" onclick="crop.close()">&times;</button>
              <h3 style="text-align:left">Редактирование уменьшенной копии</h3>
            </div>
            <div class="modal-body">
    <table>
      <tr>
        <td>
          <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$user->userpic_f?>" id="target" />
        </td>
        <td valign="top">
          <div style="width:100px;height:100px;overflow:hidden;">
            <img src="<?=Yii::app()->getModule('user')->userpicsDir?><?=$user->userpic_f?>" id="preview" alt="Preview" class="jcrop-preview" />
          </div>
        </td>
      </tr>
    </table>
<input type="hidden" id="crop_x" name="crop_x" />
<input type="hidden" id="crop_y" name="crop_y" />
<input type="hidden" id="crop_w" name="crop_w" />
<input type="hidden" id="crop_h" name="crop_h" />
           </div>
            <div class="modal-footer">
              <a class="btn" data-dismiss="modal" onclick="crop.close()">Отмена</a>
              <a class="btn btn-primary" onclick="crop.ajax('crop')">Сохранить</a>
            </div>
          </div>