<?php if(isset($message)):?>
	<div id="valid-box">
	<?php echo $message;?>
	</div>
<? endif;?>
<?php if(isset($error)):?>
	<div id="error-box">
	<?php echo $error;?>
	</div>
<? endif;?>	
<h2 style="background:none !important;color:#256C89 !important;border-radius:0px !important;">Registered User List</h2>  
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
            <th scope="col" class="rounded">Detail</th>
			<th scope="col" class="rounded">Edit</th>
			<th scope="col" class="rounded-q4">Delete</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="5" class="rounded-foot-left"><em>Total Users.<?php echo $totalUser;?></em></td>
        	<td colspan="3" style="text-align:left;" class="rounded-foot-right"><? echo $this->Paginator->numbers();?></td>
        </tr>
    </tfoot>
    <tbody>
	<?php 
	$currentPage =$this->Paginator->current($model = null);
	$counter =  $currentPage;
	$counter =$counter - 1;
	$counter =($counter*9) + $currentPage;
	foreach($userList as $value){?>
    	<tr>
        	<!--<td><input type="checkbox" name="" /></td>-->
            <td><?php echo $counter;?></td>
            <td><?php echo $value['User']['username'];?></td>
            <td><?php echo $value['User']['first_name'];?></td>
            <td><?php echo $value['User']['last_name'];?></td>
			<td><?php echo $value['User']['email'];?></td>
			<td><?php echo $this->Html->image('admin/img/view-image.png',array('url'=>array('controller' =>'admins','action' => 'viewDetail',$value['User']['id'])));?>
			</td>
			<td><?php echo $this->Html->image('admin/images/user_edit.png',array('url'=>array('controller' =>'admins','action' => 'editUserProfile',$value['User']['id'])));?>
			</td>
            <td><?php echo $this->Html->image('admin/images/trash.png',array('alt' => 'delete','class'=>'ask','id' => 'delImage','value' => $value['User']['id']));?></td>
	    </tr>
      <?php $counter++;}?>  
        
    </tbody>
</table>
