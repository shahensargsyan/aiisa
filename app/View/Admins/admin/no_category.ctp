<h3 class="text-center"><?php // echo $this->Html->link('Add category to postcard', array('controller' => 'admins', 'action' => 'addCategory'), array('class' => 'btn')); ?></h3>
<?php
if(isset($data)){
    ?>
    <table class="top20 table table-bordered table-striped">
        <tr>
            <th>Number</th>          
            <th>Postcard name</th>          
            <th>Created</th>
            <th>Modified</th>
            <th>Active</th>
            <!--<th>View</th>-->
            <th>Add</th>
        </tr>
        <?php
        foreach($data as $key => $value){
            ?>
            <?php // if($value['PostcardCategory']['postcard_id'] == NULL){?>
            <tr deleteId="<?php echo $value['Postcard']['id']; ?>">  
                <td><?php echo $value['Postcard']['id']; ?></td>
                <td> <?php
                    echo $value['Postcard']['name'];
//                    echo $this->Html->link(
//                            $value['Blogs']['title'], array(
//                        //'action' => 'editTitle', 
//                        $value['Blogs']['id']), array(
//                        'class' => 'titleEdit',
//                        'data-toggle' => "modal"
//                            )
//                    );
                    ?>
                </td> 
                <td><?php echo $value['Postcard']['created']; ?></td>
                <td><?php echo $value['Postcard']['modified']; ?></td>  
                <td>
                    <?php
                    if($value['Postcard']['active'] == 1){
                        echo '<img src="/img/tick.png" />';
                    }
                    else echo '<img src="/img/cross.png" />';
                    ?>
                </td>
                <!--<td><?php // echo $this->Html->link('view', array('controller' => 'admins', 'action' => 'viewPostcard', $value['Postcard']['id']), array('class' => 'btn'));  ?></td>-->
                <!--<td><?php // echo $this->Html->link('View Postcard', array('controller' => 'postcards', 'action' => 'invitations', $value['Postcard']['id']), array('class' => 'btn btn-primary')); ?></td>-->
                <td><?php echo $this->Html->link('Add', array('controller' => 'admins', 'action' => 'addPostcardCategory', $value['Postcard']['id'], $value['Postcard']['name']), array('class' => 'btn btn-primary')); ?></td>
            </tr>
            <?php
//            }
        }
        ?>
    </table>
    <?php
}else{
    ?>
    You have no category according to postcard
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
<?php } ?>