<div class="titleBox">
    <?php echo $this->Html->link('Add Video', array('controller' => 'admins', 'action' => 'addVideo'), array('class' => 'btn pull-right')); ?>
</div>

<?php
if(!empty($data)){
    ?>
    <table class="table table-bordered table-striped  allContractsTbl">
        <thead>
            <tr>
                <th style="width: 30%;">Title</th>                
                <th style="width: 20%;">Content</th>
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
            <tr deleteId="<?php echo $value['Video']['id']; ?>">                          
                <td class="text-center"><a href="<?php echo $value['Video']['link']; ?>"><?php echo $value['Video']['link']; ?></a></td>
                <td class="text-center"><?php echo $value['Video']['content']; ?></td>
                <td class="text-center"><?php echo $value['Video']['created']; ?></td>
                <td class="text-center"><?php echo $value['Video']['modified']; ?></td>  
                <td  class="text-center">
                    <?php
                    if($value['Video']['active'] == 1){
                        echo '<img src="/img/tick.png" />';
                    }
                    else echo '<img src="/img/cross.png" />';
                    ?>
                </td>
                <td class="text-center"><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'editVideo', $value['Video']['id']), array('class' => 'btn btn-success')); ?></td>
                <td class="text-center"><a href="#" class="btn btn-danger deleteVideo">Delete</a></td>

            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}else{
    ?>
    You have no category
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

        $(document).on('click', '.deleteVideo', function(){
            if(confirm('Are you sure you want to delete this category?')){
                var deleteId = $(this).parent().parent().attr('deleteId');
                var deleteh = $(this).parent().parent();
                $.ajax({
                    url: '/admins/delete',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: deleteId,
                        model: 'Video'
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