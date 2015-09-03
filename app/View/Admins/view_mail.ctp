<div id="success"></div>
  <h2>Message</h2>

  <?php
  echo $this->Session->flash();?>
  <div class="messageBox">
	<div class="nameSection registerUser">
		<div class="leftSide">From</div>
		<div class="rightSide">
			<?php echo $message['Contactus']['name'];?></div>	  
	</div>	
	<div class="messageSection registerUser">
		<div class="leftSide">Message</div>
		<div class="rightSide" style="width:320px !important;">
			<?php echo $message['Contactus']['message'];?></div>	  
   </div>
   	<div class="replySection rightSide">
		<?php echo $this->Html->link('Reply',"javascript:void(0);",array('id'=>'replyButton','class' => 'button-action-active updateManager','style' => 'text-decoration:none;margin: 20px 107px 0 181px; !important;width:85px !important;'));?>	
	</div>
   <div  class="submit_form" style="display:none;">
   <div>
   		<?php echo $this->Form->create('Reply');
			  echo $this->Form->input('id',array('type' => 'hidden','value' => $message['Contactus']['id']));?>
   		<div class="toSection registerUser">
			<div class="leftSide">To</div>
			<div class="rightSide" style="width:320px !important;">
			<?php echo $this->Form->input('to',array('label' => false,'size' => 54,'value' => $message['Contactus']['emailId']));?>
			</div>	  
  		 </div>
		<div class="subjectSection registerUser">
			<div class="leftSide">Subject</div>
			<div class="rightSide" style="width:320px !important;">
			<?php echo $this->Form->input('subject',array('label' => false,'size' => 54,'id' =>'subject'));?>
			</div>	  
  		 </div> 
		<div class="messageSection registerUser">
			<div class="leftSide">Message</div>
			<div class="rightSide" style="width:320px !important;">
			<?php echo $this->Form->textarea('message',array('label' => false,'style' => 'width:345px;height:178px;','id' => 'message'));?>
			</div>	  
		 </div> 
		 <div class="submit rightSide" style="width:38%;">	
		   <?php
		   
			echo $this->Js->submit('Send',array(
												'before' =>'return replyValidate();',
												'update' => '#display-message',
												'id'	 => 'sendMail',
												'success'=> 'redirect();',
												'class'	 =>	'button-action-active updateManager',
												'style'	 => 'margin: 20px 107px 0 181px;width:89px !important;',
												'url'=>array('controller' => 'admins','action' => 'replyMail')));
			echo $this->Js->writeBuffer();	
			echo $this->Form->end();
		  ?></div>
		<div id="sending" style="display:none;">Sending........</div>
  </div>
  </div>
  </div>
   <div id="sending" style="display: none; background-color: lightgreen;">Sending...</div>