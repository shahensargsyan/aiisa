<h2 style="background:none !important;color:#256C89 !important;border-radius:0px !important;">Welcome To DashBoard</h2><hr width=625 style="margin-bottom:13px">
<div id= "status-message"></div>
<h2>Set Title</h2> 
 <div class="form">
 	<fieldset>
	
			<?php echo $this->Form->create('Settings',array('style' => 'margin: 0 0 0 13px;text-align: left;'));?>
			<div class="form-elements" style="padding: 23px 0 0;">
				<label for="title" class="setting-index">Title</label>
			<?php 
				echo $this->Form->input('Logo',array('label' => false,'id' => 'title','size' => 61, 'value' => $siteDetails['Setting']['logo'],
													 'style' => 'margin:0 33px  20px 0;height:25px; border-radius: 4px;float:left;'));
				echo '<div>'.$this->Form->input('Use Default',array('type' => 'checkbox', 'id' => 'titleCheckbox',
				  													'checked'=>true,'style' => 'margin:12px 0px 0px 0px;')).'</div>';	?>
		 	<label for="title" class="setting-index">Heading</label>
			<?php 
				echo $this->Form->input('Headings',array('label' => false,'id' => 'heading','size' => 61, 'value' => $siteDetails['Setting']['heading'],
														 'style' => 'margin:0 53px  20px 0;height:25px; border-radius: 4px;float:left;'));?>
			<label for="title" class="setting-index">Welcome Message</label>
			<?php 	 
			    echo $this->Form->input('WelcomMsg',array('type' =>'textarea','rows' => '5', 'cols' => '54','id'=>'welcome','disabled'=>'disabled',
														  'label'=>false,'value' => $siteDetails['Setting']['welcome_msg'],
														  'style' => 'margin:0 33px  20px 0;border-radius: 4px;float:left;')); 
			?>
			</div>	
			      <? echo $this->Js->submit('Update',array(
															'before' =>'return titleValidate();',
															'update' => '#status-message',
															'success'=> 'titleSaveSuccess();',
															'class'  => 'button-action-active updateTitle',
															'style'  => 'float:left;border-radius:5px;border:1px solid #57767E !important;box-shadow:4px 1px;margin-left:221px;', 
															'url'=>array('controller' => 'settings','action' => 'changeTitle')));
				  	 echo $this->Js->writeBuffer();
			?>	 		
	</fieldset>  
				<?php echo $this->Form->end();?>
</div>

<!--Default Session Section-->
<h2 style="float:left;margin:10px 0px 0px 0px !important;width:98%;">Default Meditation Session</h2> 
 <div class="form" style="position:relative;left:-24px;margin:15px 0px 0px 0px;">
 	<fieldset>
	
			<?php echo $this->Form->create('Settings',array('style' => 'text-align:center;'));?>
			<div class="form-elements" style="width:98%;">
			<?php $userSession = explode(',',str_replace('{','',str_replace('}','',$siteDetails['Setting']['sessions']))); 
									$totalUserSession = count($userSession);
									if($totalUserSession >=1){
									$count = 1;
									for($i=0;$i<$totalUserSession;$i++){
									$explode_session = explode(':',str_replace("'",'',$userSession[$i]));
										$userSessionValue =$explode_session[1].':'.$explode_session[2].':'.$explode_session[3];?>
										<div class="innerSession" style="box-shadow:3px 3px #999999; float:left;width:10%;padding: 0 7px 6px 5px;border: 1px solid;border-radius:10px;margin:0px 8px 0px 0px;"><span><?php echo "Session ".$count;?></span>
										<span>
										<? echo $this->Form->input('Session'.$i,array('class'=>'setSession','label'=>false,'size'=>'6',
																   'style'=>'border-radius:4px;padding:0px 0px 0px 0px;','disabled'=>true,'value'=>$userSessionValue));
										$count++;	
										?><span></div>
									 <?php }
									 }?>
								
			    <?php  
				  echo $this->Form->button("Edit",array('type' => 'button','class'  => 'button-action-active','id'=>'editSessionButton',
				  										'style'  => 'border-radius:5px;border:1px solid #57767E !important;float:left; margin: 20px 107px 0 136px;box-shadow:4px 1px ;'));
				  echo $this->Js->submit('Update',array(		  	
														'before' =>	'submitSessionValidate();',
														'update' => '#status-message',
														'success'=> 'successSubmission();',
														'class'  => 'button-action-active updateSession',
														'style'  => 'box-shadow:4px 1px ;border-radius:5px;border:1px solid #57767E !important;float:left; margin: 20px 0 0;', 
														'url'=>array('controller' => 'settings','action' => 'updateSession')));
				  echo $this->Js->writeBuffer();
			?>	 		
	</fieldset>  
	<?php echo $this->Form->end();?>
</div>		
							