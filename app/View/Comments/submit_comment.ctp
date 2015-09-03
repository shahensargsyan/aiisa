<script type="text/javascript">
		$(document).ready(function(){
		$("#showCommentFinish-<?php echo $meditationId;?>").text("Hide Comments");
		//$("#hide-show-commentFinish_<?php echo $meditationId;?>").show();
		
			/*$("#submitCommentButtonFinish_<?php// echo $meditationId;?>").attr("disabled", "disabled");
			$("#submitCommentButtonFinish_<?php //echo $meditationId;?>").css('opacity',0.6);
			$("#showCommentFinish-<?php //echo $meditationId;?>").click(function(){
				htm = $(this).text().trim();
				$(this).text(htm == "Show Comments"? "Hide Comments": "Show Comments"); 
				$("#hide-show-commentFinish_<?php //echo $meditationId;?>").slideToggle();
			});
			$("#makeCommentFinish_<?php //echo $meditationId;?>").keyup(function(){
				if($(this).val().length == 0){
					$("#submitCommentButtonFinish_<?php// echo $meditationId;?>").attr("disabled", "disabled");
					$("#submitCommentButtonFinish_<?php// echo $meditationId;?>").css('opacity',0.6);
				}	
				else{
					$("#submitCommentButtonFinish_<?php //echo $meditationId;?>").removeAttr("disabled");
					$("#submitCommentButtonFinish_<?php //echo $meditationId;?>").css('opacity',1);
				}
			});*/
		})
</script><noscript>
<style>

/**
* Reinstate scrolling for non-JS clients
* 
* You coud do this in a regular stylesheet, but be aware that
* even in JS-enabled clients the browser scrollbars may be visible
* briefly until JS kicks in. This is especially noticeable in IE.
* Wrapping these rules in a noscript tag ensures that never happens.
*/
.tse-scrollable {
overflow-y: scroll;
}
.tse-scrollable.horizontal {
overflow-x: scroll;
overflow-y: hidden;
}
</style>
</noscript>
<!-- comment box-->
<!--<div id="showCommentFinish-<?php// echo $meditationId;?>" class="showCommnt button">Hide Comments</div>-->

<div class = "userComments" id="hide-show-commentFinish_<?php echo $meditationId;?>">
 <div class="tse-scrollable demo2">
		<div class="tse-content">						
			<?php foreach($usersComment as $comment):?>	
			<div class="commentBox">
			<div id="img">
			<?php 
			$profile_picture 	= ($comment['User']['profile_picture']!='')?'../profileimg/'.$comment['User']['profile_picture']:'guest_avatar.jpg';
			echo $this->Html->image($profile_picture, array('style' => 'border:none;float:left;margin: 7px 0 0 1px;','width'=>'33','height'=>'28')); ?>
			</div>
			<div id="personCommented"><?php echo $comment['User']['first_name']." ".$comment['User']['last_name'];?></div>
			<div class="comment"><?php echo $comment['Comment']['comment'];?></div>
			<div class="clear"></div>
			</div>
			<?php endforeach;?>
		</div>
 </div>		
</div>	<!--Hide Show Comment Section end here-->
