<div class="message" style="float:left;padding:10px 50px;"><?php echo $message?></div>
<?php 
	$userSession = explode(',',str_replace('{','',str_replace('}','',$session_data['usermeta']['setsessions'])));
	$totalUserSession = count($userSession);
	if($totalUserSession<7) {	//If Sessions listing is less than '7', Display form to submit session ?>		
		
		<!--<div class="setSessionDiv_1 myMed">-->
          <div class="titleLine packet_combo">
		  	<div class="section-head">Set Your Meditation Session<span class="note-white" style="margin-left: 6px;">(HH:MM:SS)</span>
			</div>
		  </div> 
		  <div class="packet_combo">
           <?php echo $this->Form->create('Usersmetas');?>
		  <div class="setSessionFrom packet_left">
           
          
			<?echo $this->Form->input('hours',array('type'=>'select','options'=>$hours, 'label'=>false, 'id' => 'hours', 'class'=>'dropdown'));?>
            <div class="sel_sep">:</div>
          
            
			<? echo $this->Form->input('minutes',array('type'=>'select','options'=>$minutes,'label'=>false,'id' => 'minutes', 'class'=>'dropdown')); ?>
            <div class="sel_sep">:</div>
           
			<?echo $this->Form->input('seconds',array('type'=>'select','options'=>$seconds,'label'=>false,'id' => 'seconds', 'class'=>'dropdown')); ?>
			</div>
			
		  <div class="packet_right submit">
			<?php echo $this->Js->submit( 'Save', array(
										'before'	=> 'return  submitSessionValidate();',
										//'success' 	=> 'submitSessionSuccess();',
										'complete'  => 'submitCompleteSession();',
										'async'     => false,													
										'update'    => '#updateSession',
										'id'		=> 'submitSession',
										'class' 	=> 'green_btn',
										'url'       => array('controller'=>'usersmetas', 'action' => 'submitsession')
						));
						echo $this->Js->writeBuffer();
						
				     ?>
		     </div>	
		  <?php echo $this->Form->end(); ?>	 
			 		 
         
		  </div>
        <!--</div>-->
		<?php 
	} ?>
	
<div class="section-head">Your Preset Meditation Session<span class="note-white" style="margin-left: 6px;">(HH:MM:SS)</span></div>
	<?php 
	$count=1;
	
	if(!empty($totalUserSession)){ ?>
      
          <?php	
		// Print the User sessions
			$userSession = explode(',',str_replace('{','',str_replace('}','',$session_data['usermeta']['setsessions'])));
			//echo '<pre>'; print_r($userSession);
			$totalUserSession = count($userSession);
			if($totalUserSession >=1){
				for($i=0;$i<$totalUserSession;$i++){
					$explode_session = explode(':',str_replace("'",'',$userSession[$i]));
		
					echo $this->Form->create('Usersmetas', array('url' => array('controller' => 'usersmetas'),'id'=>'UserMetaSessionForm'.'_'.$explode_session[0]));
					echo '<div class="packet_combo">';
					echo'<div class="packet_left">';
					echo '<div id="usersessions" class="sess" style="width:51%; float:left;color:#ffffff;">Session '.$count.':&nbsp;&nbsp;&nbsp;&nbsp;'.$explode_session[1].':'.$explode_session[2].':'.$explode_session[3].'</div>';    
					echo'</div>';
					echo'<div class="packet_right">';              
					echo '<div style="float:left;">';
					
					echo $this->Html->link("Edit",array('controller' => 'usersmetas', 'action' => 'editsession',$explode_session[0],$explode_session[1],$explode_session[2],$explode_session[3]),array('style' =>'float:left;', 'class' => 'editSession my_med_btn button')).'&nbsp;&nbsp;';
					echo $this->Form->hidden('Usersmetas.delsession', array('value'=> $explode_session[0]));
					echo '</div>';
					//echo $this->Form->input('setSession', array('label' => false,'maxlength' => '200', 'div' => false, 'id' => 'setSession', 'type' => 'hidden')); 
					// echo $this->Form->error('setSession');
					echo $this->Js->submit( 'Delete', array(
					'before'	=> 'return showConfirm();',
					'update'    => '#updateSession',
					'complete'  =>  'completeSession();',
					'id'		=>  $explode_session[0],
					'class'     => 'deleteSession my_med_btn button',
					'url'       => array('controller'=>'usersmetas','action' => 'deletesession'),
					array('confirm' => 'Are you sure?'),
					));
					echo $this->Js->writeBuffer();
					echo $this->Form->end();									 	
					$count++;
					echo'</div>';
					echo'</div>';
				}
			}?>
       
        <?php } else {
		echo '<div class="myMed">Please Set your Session&nbsp;<em>(You can save upto 7 sessions.)</em></div>';
	}
?>

	  
<div class="markline">
	<div class="staticcontrol"><div class="hrcenter-white"></div></div>
</div>
	  