<? if(isset($message)):?>
	<div class="valid_box">
		<? echo $message;?>
	</div>
<?	echo '<script>
			$(".valid_box").fadeOut(4000);
			</script>';
	 endif;
 if(isset($error)):?>
	<div class="warning_box">
		<? echo $error;
			echo '<script>
			$(".warning_box").fadeOut(4000);
			</script>';?>
	</div>
<? endif;?>		
<h2 style="background:none !important;color:#256C89 !important;border-radius:0px !important;">Manager User List</h2>  
<div class="hidden" id="baseurl" style="display:none;"><?php echo Router::url('/', true); ?></div>                
<table id="rounded-corner" summary="2007 Major IT Companies' Profit">
    <thead>
    	<tr>
        	<!--<th scope="col" class="rounded-company"></th>-->
            <th scope="col" class="rounded">S.No.</th>
            <th scope="col" class="rounded">Username</th>
            <th scope="col" class="rounded">First Name</th>
            <th scope="col" class="rounded">Last Name</th>
            <th scope="col" class="rounded">Email</th>
            <th scope="col" class="rounded">Previliges</th>
			<th scope="col" class="rounded">Edit</th>
			<th scope="col" class="rounded-q4">Delete</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="7" class="rounded-foot-left"><em>Total Users.<?php echo $totalUser;?></em></td>
        	<td class="rounded-foot-right"><? echo $this->Paginator->numbers();?></td>
        </tr>
    </tfoot>
    <tbody>
	<?php 
	$count = 1;
	$currentPage =$this->Paginator->current($model = null);
	$counter =  $currentPage;
	$counter =$counter - 1;
	$counter =($counter*9) + $currentPage;
	foreach($managerUser as $value){?>
    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->
            <td><?php echo $counter;?></td>
            <td><?php echo $value['Admin']['username'];?></td>
            <td><?php echo $value['Admin']['firstName'];?></td>
            <td><?php echo $value['Admin']['lastName'];?></td>
			<td><?php echo $value['Admin']['email'];?></td>
			<td><?php echo $value['Admin']['previleges'];?></td>
			<td><?php echo $this->Html->image('admin/images/user_edit.png',array('url'=>array('controller' =>'admins','action' => 'editManagerUser',$value['Admin']['id'])));?>
			</td>
            <td><?php echo $this->Html->image('admin/images/trash.png',array('alt' => 'delete','class'=>'ask','id' => 'delImage','value' => $value['Admin']['id']));?></td>
	    </tr>
      <?php $counter++;}?>  
        
    </tbody>
</table>

