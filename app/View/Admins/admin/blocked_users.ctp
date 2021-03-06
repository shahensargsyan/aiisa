<div class="container">
<h3 class="text-center">Block a User</h3>
<?php
if(!empty($data)){
    ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>First name</th>                
                <th>Last name</th>                
                <th>E-mail</th>                
                <th>Created</th>
                <th>Modified</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($data as $key => $value){
            ?>
            <tr>
                <td> <?php echo$value['User']['first_name']; ?> </td>                          
                <td><?php echo $value['User']['last_name']; ?></td>
                <td><?php echo $value['User']['email']; ?></td>
                <td><?php echo $value['User']['created']; ?></td>
                <td><?php echo $value['User']['modified']; ?></td>
                <td><?php echo $this->Html->link('Unblock',
                            array('controller'=>'admins','action'=>'blockedUsers',$value['User']['id']),
                            array('class'=>"btn btn-inverse deleteUser"));
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}else{
    ?>
    <p class="text-center">There is no User</p>
    <?php
}
?>    
<?php
$count = $this->Paginator->params();
if($count['pageCount'] > '1'){
    ?>
    <div class="pagination">
        <ul>
            <li class="disabled"><?php echo $this->Paginator->prev('Prev', null, null); ?></li>
            <li><?php echo $this->Paginator->numbers(array("separator" => false)); ?></li>
            <li ><?php echo $this->Paginator->next('Next', null, null); ?></li>

        </ul>
    </div>  
<?php } ?>  
</div>
