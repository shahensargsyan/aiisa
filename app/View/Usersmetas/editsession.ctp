<?php 
$sessionId=$this->Session->read('userId');
//for creating select box 
$hours 		= array();
$minutes 	= array();
$seconds 	= array();

$hours['HH'] 	= '-- HH --';
$minutes['MM'] 	= '-- MM --';
$seconds['SS'] 	= '-- SS --';

for($i=0;$i<=23;$i++){
	if(strlen($i) == 1):
		$hours[] = "0".$i;
	else:
		$hours[]= $i;
	endif;
}

for($i=0;$i<=59;$i++){ 
	if(strlen($i) == 1):
		$minutes[] = "0".$i;
	else:
		$minutes[]= $i;
	endif;
}

for($i=0;$i<=59;$i++){
	if(strlen($i) == 1):
		$seconds[] = "0".$i;
	else:
		$seconds[] = $i;
	endif;
}
// fetching the value of edited session
$para=$this->request->params['pass'][0];
$hour=$this->request->params['pass'][1];
$minute=$this->request->params['pass'][2];
$second=$this->request->params['pass'][3];
$passSession = $hour.":".$minute.":".$second;
// creating the editing form
echo $this->Form->create('UsersMetas');
?>		
<div class="page_heading"><h1>Edit Session</h1></div>
<div class="page_container">
	<div id="edit-session-box" style="width:40% float:left;margin:18px 0px 15px 14px;">
    	<div>
			<?php echo $this->Form->input('hours',array('type'=>'select','options'=>$hours,'class'=>"dropdown",'label'=>false,'style'=>'float:left;','id' => 'hours','default' => $hour)); ?>
			<div class='sel_sep'>:</div>
		</div>
		<div>
			<?php echo $this->Form->input('minutes',array('type'=>'select','options'=>$minutes,'class'=>"dropdown",'label'=>false,'style'=>'float:left;','id' => 'minutes','default' => $minute)); ?> 
			<div class='sel_sep'>:</div>
		</div>
		<?php
		echo $this->Form->input('seconds',array('type'=>'select','options'=>$seconds,'class'=>"dropdown",'label'=>false,'style'=>'float:left;','id' => 'seconds','default' => $second)); 
		echo $this->Form->hidden('UsersMetas.indexValue', array('value'=> $para));
		echo $this->Form->hidden('UsersMetas.passSession', array('value'=> $passSession));
		echo $this->Form->submit('Submit', array('id'		=> 'editSession',
												 'div'  	=> false,
												 'class' 	=> 'my_med_btn button',
												 'style'	=> 'margin-left: 90px',
												 'url'      => array('controller'=>'UsersMetas','action' => 'editSession')
								));
  		//end
		echo $this->Form->end(); 
  		?>
		<div id="editError" style="margin-top:10px;"><em>(Please Select the valid Session.)</em></div>
	</div>
</div>