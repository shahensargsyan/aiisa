<h2>Compose</h2> <?php //echo '<pre>';print_r($mailList);exit;?>
<div  class="submit_form">
   <div>
   		<?php echo $this->Form->create('Admin');?>
   		<div class="toSection registerUser">
			<div class="leftSide">To</div>
			<div class="rightSide" style="width:320px !important;">
			<?php echo $this->Form->input('email',array('label' => false,'size' => 54));?>
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
		    echo $this->Form->submit('Send',array('class'	 =>	'button-action-active updateManager','style' => "width:95px !important;margin: 20px 107px 0 193px !important;"));
		  ?></div>
		<div id="sending" style="display:none;">Sending........</div>
  </div>
  </div>