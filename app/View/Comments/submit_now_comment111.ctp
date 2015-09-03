<script type="text/javascript">
$(document).ready(function(){
	$("#submitCommentButton_<?php echo $meditationId;?>").attr("disabled", "disabled");
	$("#submitCommentButton_<?php echo $meditationId;?>").css('opacity',0.6);
	$("#showCommentNow-<?php echo $meditationId;?>").click(function(){
		htm = $(this).text().trim();
		$(this).text(htm == "Show Comments"? "Hide Comments": "Show Comments"); 
		$("#hide-show-commentNow_<?php echo $meditationId;?>").slideToggle();
	});
	$("#makeComment_<?php echo $meditationId;?>").keyup(function(){
		if($(this).val().length == 0){
			$("#submitCommentButton_<?php echo $meditationId;?>").attr("disabled", "disabled");
			$("#submitCommentButton_<?php echo $meditationId;?>").css('opacity',0.6);
		}	
		else{
			$("#submitCommentButton_<?php echo $meditationId;?>").removeAttr("disabled");
			$("#submitCommentButton_<?php echo $meditationId;?>").css('opacity',1);
		}
	});
})
</script>
<!-- comment box-->
<div id="showCommentNow-<?php echo $meditationId;?>" class="showCommnt">Hide Comments</div>
<div class = "userComments" id="hide-show-commentNow_<?php echo $meditationId;?>" style="height:auto;width:100%;float:left;">						
<?php foreach($usersComment as $comment): ?>
<div class="commentBox" style="width:98%;">
<div style="float:left;">
<div id="img">
<?php 
$profile_picture 	= ($comment['User']['profile_picture']!='')?'../profileimg/'.$comment['User']['profile_picture']:'guest_avatar.jpg';
echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;margin: 7px 0 0 1px;','width'=>'33','height'=>'28')); ?>
</div>
<div id="personCommented"><?php echo $comment['User']['first_name']." ".$comment['User']['last_name'];?></div>
<div class="comment"><?php echo $comment['Comment']['comment'];?></div>
</div>
</div>
<?php endforeach;?>
</div>	<!--Hide Show Comment Section end here-->
	