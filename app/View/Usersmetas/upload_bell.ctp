<div id="newSound" style="margin:0px 54px 16px 0px;float:left;width:100%;">Set New Bell Sound:</div>
<div id="newSound">
<?php echo $this->Form->create('UsersMeta', array('url'=>array('controller' => 'usersMetas','action' => 'uploadBell'), 'type' => 'file'));
  echo $this->Form->file('File',array('id' => 'upload'));
  echo $this->Form->submit('Upload');
  echo $this->Form->error('upload');
  echo $this->Form->end();
  ?>
  </div>
<?php 
if(isset($error))
{?>
<div id="uploadError">Your Bell Sound has not been uploaded</div>
<?php }?>
</div>	