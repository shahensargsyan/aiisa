<?php echo $this->Html->link('Add',array('controller'=>'admins','action'=>'add_url'),array('class'=>'btn btn-success'));?>
<div class="titleBox">
    <h4>Dynamic Urls</h4>
</div>
<?php if(!empty($siteMap)){?>
<table class="table table-bordered table-striped allContractsTbl">
        <tr>
            <th>URL</th>                
            <th>Created</th>                
            <th>Modified</th>
            <th>Edit</th>                
            <th>Delete</th>
        </tr>
        <?php foreach($siteMap as $key => $value){?>
            <tr>
                <td><?php echo $value["SiteMap"]['url']; ?> </td>                          
                <td><?php echo $value["SiteMap"]['created']; ?></td>
                <td><?php echo $value["SiteMap"]['modified']; ?></td>
                <td class="text-center"><?php echo $this->Html->link('Edit',array('controller'=>'admins','action'=>'edit_url',$value["SiteMap"]['id']),array('class'=>'btn btn-success'));?></td>
                <td class="text-center"><?php echo $this->Html->link('Delete',array('controller'=>'admins','action'=>'delete_url',$value["SiteMap"]['id']),array('class'=>'btn btn-success'));?></td>
            </tr>
            <?php 
            }
            ?>
    </table>
<?php }else{?>
 <p class="text-center">There is no data</p>
<?php }?>
<?php echo $this->Paginator->numbers(array('first' => 1, 'last' => 1));?>