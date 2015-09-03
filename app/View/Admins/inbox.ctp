<div class="hidden" id="baseUrl"><?php echo Router::url('/',true);?></div>
<h2>Inbox<div style="float:right;margin-right:30px"><?php echo $this->Html->image('admin/images/trash.png',array('alt' => 'delete','id' => 'delButton','value' => 'deleteInbox'));?></div></h2>
 <?php //echo '<pre>';print_r($mailList);exit;?>
<table id="rounded-corner" summary="2007 Major IT Companies' Profit" style="margin-top:10px;">
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company"><?php echo $this->Form->input("SelectAll",array('label' => false,'type' => 'checkbox','id' => 'selectAll','style' => 'margin:0px 0px 0px 2px'));?></th>
            <th scope="col" class="rounded">From</th>
            <th scope="col" class="rounded">Message</th>
            <th scope="col" class="rounded-q4">Date</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="3" class="rounded-foot-left"><em>Mails Received</em></td>
        	<td class="rounded-foot-right"><? echo $this->Paginator->numbers();?></td>
        </tr>
    </tfoot>
    <tbody>
	<?php if(!empty($mailList)):
		  foreach($mailList as $mail):
			$date = explode(" ",$mail['Contactus']['submitdate']);
			$date = explode("-",$date[0]);
			$receiveDate = $date[2]."/".$date[1]."/".$date[0];
			$class = ($mail['Contactus']['status'] == 0)?'setBold':'';?>
		<tr>
        	<td style="vertical-align:top;"><?php echo $this->Form->input("Select_".$mail['Contactus']['id'],array('label' => false,'type' => 'checkbox','class' => 'check','value' => $mail['Contactus']['id']));?></td>
            <td style="vertical-align:top;" class=<?php echo $class;?>><?php echo $this->Html->link($mail['Contactus']['name'],'viewMail/'.$mail['Contactus']['id'].'',array('style' => 'text-decoration:none;'));?></td>
            <td><?php echo $this->Html->link($mail['Contactus']['message'],'viewMail/'.$mail['Contactus']['id'].'',array('style' => 'text-decoration:none;'));?></td>
            <td style="vertical-align:top;" ><?=$receiveDate?></td>
        </tr>
        <?php endforeach;
		else:
			echo '<tr><td></td><td></td><td>Inbox is empty</td><td></td></tr>';
		endif;
		?> 
    </tbody>
</table>
							
     
        
     
        
      
     