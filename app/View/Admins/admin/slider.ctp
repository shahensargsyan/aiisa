<h3 class="text-center"><?php echo $this->Html->link('Add Slide', array('controller' => 'admins', 'action' => 'addSlider'), array('class' => 'btn')); ?></h3>
<?php
if(isset($slider)){
    ?>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Title</th>              
            <th>Slide number</th>    
            <th>Created</th>
            <th>Modified</th>
            <!--<th>View</th>-->
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        foreach($slider as $key => $value){
            ?>
            <tr deleteId="<?php echo $value['SiteImage']['id']; ?>">
                <td><?php echo $value['SiteImage']['title1']; ?></td>
                <td> <?php
                    echo $value['SiteImage']['order'];
                    ?>
                </td> 
                <td><?php echo $value['SiteImage']['created']; ?></td>
                <td><?php echo $value['SiteImage']['modified']; ?></td>  
                <!--<td><?php // echo $this->Html->link('view', array('controller' => 'admins', 'action' => 'viewSlider', $value['SiteImage']['id']), array('class' => 'btn'));  ?></td>-->
                <td><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'editSlider', $value['SiteImage']['id']), array('class' => 'btn btn-primary')); ?></td>
                <td><a href="#" class="btn btn-danger deleteSlider">Delete</a></td>

            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}else{
    ?>
    You have no slider
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

        $(document).on('click', '.deleteSlider', function(){
            if(confirm('Are you sure you want to remove this post with its comments?')){
                var deleteId = $(this).parent().parent().attr('deleteId');
                var deleteh = $(this).parent().parent();
                $.ajax({
                    url: '/admins/deleteSlider',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        deleteId: deleteId,
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