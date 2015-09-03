<script type="text/javascript">
$(document).ready(function(){

   $('.left_content').hide();
});

</script>
<h2 style="background:none !important;color:#256C89 !important;border-radius:0px !important;">
<?php if($total_notification!=0):
echo "List Of Offline Hour Added";
else:
echo "No Notification Found";
endif;
?>

</h2>  
<div class="hidden" id="baseurl" style="display:none;"><?php echo Router::url('/', true); ?></div>   
<div class="notification_count" style="display:none;"><?php echo $total_notification;?></div>  
<?php if($total_notification!=0):?>           
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<!--<th scope="col" class="rounded-company"></th>-->
            <th scope="col" class="rounded">S.No.</th>
            <th scope="col" class="rounded">Username</th>
            <th scope="col" class="rounded">Full Name</th>
            <th scope="col" class="rounded">Email</th>
          
            <th scope="col" class="rounded">Hours Added</th>
			<th scope="col" class="rounded">Date</th>
			<th scope="col" class="rounded">Time</th>
			<th scope="col" class="rounded">Action</th>
        </tr>
    </thead>
        <tfoot>
    	   <?php 
		   
		   $count=1; 
		   foreach ($totalOfflineMeditationHour as $result):?>
		   			<tr class="record"> 
					<td> <?php echo $count; ?></td>
					<td> <?php echo $result['User']['username']; ?></td>
					<td> <?php echo $result['User']['first_name']; ?><?php echo " ";echo $result['User']['last_name']; ?> </td>
					<td> <?php echo $result['User']['email']; ?> </td>
					<td> <?php echo $result['Meditation']['session_time']; ?> </td>
					<td> <?php echo $result['Meditation']['ondate']; ?> </td>
					<td> <?php echo $result['Meditation']['starttime']; ?> </td>
					
					<td><a href="#" id="<?php echo $result['Meditation']['id']; ?>" class="approve">Approve</a> </td>
					</tr>
		   <?php 
		   $count++;
		   endforeach; ?>
		   
       </tfoot>
    <tbody>
	
        
    </tbody>
</table>
<?php endif;?>