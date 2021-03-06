<div class="titleBox">
    <?php echo $this->Html->link('Add Sub Category', array('controller' => 'admins', 'action' => 'addSubcategory'), array('class' => 'btn pull-right')); ?>
</div>
<?php
if(!empty($data)){
    ?>
    <table class="top20 table table-bordered table-striped">
        <tr>
            <th>Subcategory</th>                
            <th>Created</th>
            <th>Modified</th>
            <th>Active</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        foreach($data as $key => $value){
            ?>
            <tr deleteId="<?php echo $value['Category']['id']; ?>">
                <td> <?php
                    echo $value['Category']['name'];
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
                <td><?php echo $value['Category']['created']; ?></td>
                <td><?php echo $value['Category']['modified']; ?></td>  
                <td>
                    <?php
                    if($value['Category']['active'] == 1){
                        echo '<img src="/img/tick.png" />';
                    }else
                        echo '<img src="/img/cross.png" />';
                    ?>
                </td>
                <td><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'editSubcategory', $value['Category']['id']), array('class' => 'btn btn-success')); ?></td>
                <td><a href="#" class="btn btn-danger deleteSubcategory">Delete</a></td>

            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}else{
    ?>
    You have no subcategory
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
<script type="text/javascript">
    var deleteId, deleteh;
    $(document).ready(function(){

        $(document).on('click', '.deleteSubcategory', function(){
            if(confirm('Are you sure you want to delete this subcategory?')){
                var deleteId = $(this).parent().parent().attr('deleteId');
                var deleteh = $(this).parent().parent();
                $.ajax({
                    url: '/admins/delete',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: deleteId,
                        model: 'Category'
                    },
                    success: function(data){
                        if(data.status){
                            deleteh.remove();
                        }else{
                            alert('error');
                        }
                    }
                });
            }
            return false;
        });
    });
</script>