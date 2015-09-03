<script>
$(document).ready(function(){
	$("#messageButton").css('opacity',0.6);		
	$("#messageButton").attr("disabled", "disabled");
	$('#enterMessage').keyup(function(){	  
		if($(this).val().length == 0 || $(this).val().trim() == ''){
			$("#messageButton").attr("disabled", "disabled");
			$("#messageButton").css('opacity',0.6);
		}	
		else{
			$("#messageButton").removeAttr("disabled", "disabled");
			$("#messageButton").css('opacity',1);
		}
	});
});	
function blankText(){
	$('#enterMessage').empty();
}
</script>
<div class="profileInner">
<?php 
echo $this->Form->create('User',array('class' => 'maMyAccoutForm'));
echo $this->Form->textarea('Message',array('label' => false,'class'=>'mInput mTextarea ta maMessage','id'=>'enterMessage','placeholder' => 'Enter Profile Message'));
echo $this->Js->submit('Submit',array(
    'id'   	 => 'messageButton',
    'update'    => '#profileBox',
  // 'complete'	  => 'commentSubmit();',	
    'complete'	  =>  'blankText();',
    'class' 	  => 'dButton fr',
    'url'       => array('controller'=>'users', 'action' => 'profileMessage')
));
echo $this->Form->end();
echo $this->Js->writeBuffer();
?>		
<div style="none repeat scroll 0 0 #000;float:left;color: #fa8d91;float: left;margin: 12px 0 0 0px;padding:5px;"><?php echo $message;?></div>
</div>
<div class="clear"></div>