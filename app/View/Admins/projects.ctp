<div class="titleBox">
    <?php echo $this->Html->link('Add Project', array('controller' => 'admins', 'action' => 'addProject'), array('class' => 'btn pull-right')); ?>
</div>

<?php
if(!empty($data)){
    ?>
    <table class="table table-bordered table-striped  allContractsTbl">
        <thead>
            <tr>
                <th style="width: 30%;">Name</th>                
                <th style="width: 20%;">Description</th>
                <th style="width: 20%;">Created</th>
                <th style="width: 20%;">Modified</th>
                <th style="width: 10%;">Active</th>
                <th style="width: 10%;"></th>
                <th style="width: 10%;"></th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($data as $key => $value){
            ?>
            <tr deleteId="<?php echo $value['Project']['id']; ?>">
                <td> <?php
                    echo $value['Project']['name'];
                    ?>
                </td>                          
                <td class="text-center"><?php echo $value['Project']['description']; ?></td>
                <td class="text-center"><?php echo $value['Project']['created']; ?></td>
                <td class="text-center"><?php echo $value['Project']['modified']; ?></td>  
                <td  class="text-center">
                    <?php
                    if($value['Project']['active'] == 1){
                        echo '<img src="/img/tick.png" />';
                    }
                    else echo '<img src="/img/cross.png" />';
                    ?>
                </td>
                <td class="text-center"><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'editProject', $value['Project']['id']), array('class' => 'btn btn-success')); ?></td>
                <td class="text-center"><a href="#" class="btn btn-danger deleteProject">Delete</a></td>

            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}else{
    ?>
    You have no Project Types
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

        $(document).on('click', '.deleteProject', function(){
            if(confirm('Are you sure you want to delete this category?')){
                var deleteId = $(this).parent().parent().attr('deleteId');
                var deleteh = $(this).parent().parent();
                $.ajax({
                    url: '/admins/delete',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: deleteId,
                        model: 'Project'
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