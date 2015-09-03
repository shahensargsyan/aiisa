<script>
$(document).ready(function(){
$('.message-follow_<?php echo $medId;?>').slideDown(1000);
$('.message-follow_<?php echo $medId;?>').fadeOut(3000);
});
</script>
<div class="innerFollow">
<?php   echo $this->Form->create('UsersNetworks');
		echo $this->Form->input('personToFollow',array('label'=> false,'type'=>'hidden','value'=>$userId));
		echo $this->Form->input('meditationId',array('label'=> false,'type'=>'hidden','value'=>$medId));
		echo $this->Js->submit('Follow',array('id'   	 => 'followButton_'.$medId,
											  'update'    => '#followSection_'.$medId,
											// 'complete'	  => 'commentSubmit();',	
											//  'success' => $this->Js->get('#commentSectionNear_'.$list['Meditation']['id'])->effect('show', array('buffer' => false)),
											  'class' 	  => 'button',
											  'url'       => array('controller'=>'UsersNetworks', 'action' => 'followUser')
							  ));
		echo $this->Form->end();
		echo $this->Js->writeBuffer();
	
?> 
</div>
<div class="messageFollow message-follow_<?php echo $medId;?>"><? echo $message;?></div>
