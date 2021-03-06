<div class="span10 margauto">
<div class="titleBox">
    <div class="pull-left">
        <?php 
            echo $this->Form->create('export',array(
                'url' => array('controller' => 'admins','action' =>'export_file' )
            ));
            echo $this->Form->input('model',array('type'=>'hidden','name'=>'BlockedEmail','value'=>'blockedEmails'));//name = model value = action
            echo $this->Form->submit('Export to csv', array('div' => false, 'class' => 'btn btn-success right5 pull-left'));
            echo $this->Form->submit('Delete',array('name' => 'delete','value'=>'delete', 'div' => false, 'class' => 'btn btn-danger'));
        ?>
    </div>
    <?php echo $this->Html->link('Add New Email', array('controller' => 'admins', 'action' => 'blocked'), array('class' => 'btn pull-right')); ?>
</div>
<?php
if(!empty($data)){
    ?>
    <table class="table table-bordered table-striped allContractsTbl">
        <tr>
            <th style="width: 5%;"><input id="select" type="checkbox" style="width:20px;height:20px;"></th>
            <th style="width: 30%;">Email</th>
            <th style="width: 30%;">Reason</th>
            <th style="width: 20%;">Created</th>
            <th style="width: 15%;"></th>
        </tr>
        <?php
        foreach($data as $key => $value){
            ?>
            <tr deleteId="<?php echo $value['BlockedEmail']['id']; ?>">
               <td class="text-center selectAll">
                    <?php
                       echo $this->Form->input('id', array('type' => 'checkbox','name' => $value['BlockedEmail']['id'],'value'=>$value['BlockedEmail']['id'],'label' => false,'class'=>'chekbox'));
                    ?>
               </td>                  
                <td> <?php
                    echo $value['BlockedEmail']['email_address'];
                    ?>
                </td>
                <td class="text-center"><?php echo $value['BlockedEmail']['reason']; ?></td>
                <td class="text-center"><?php echo $value['BlockedEmail']['created']; ?></td>
                <td class="text-center"><a href="#" class="btn btn-danger deleteCategory">Delete</a></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}else{
    ?>
    <p>You do not have blocked email</p>
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
<script type="text/javascript">
    var deleteId, deleteh;
    $(document).ready(function(){

        $(document).on('click', '.deleteCategory', function(){
            if(confirm('Are you sure you want to delete this email from blocked list?')){
                var deleteId = $(this).parent().parent().attr('deleteId');
                var deleteh = $(this).parent().parent();
                $.ajax({
                    url: '/admins/delete',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: deleteId,
                        model: 'BlockedEmail'
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
    $(function(){
        $('.chekbox').on('click',function(){
            $(this).parent().parent().parent().toggleClass('blockedIPRow');
        });
        $('#select').on('click',function(){
            $('#select').toggleClass('toggle');
            if($('#select').hasClass('toggle')){
                $('.chekbox').parent().parent().parent().addClass('blockedIPRow');
                $( ".chekbox" ).prop('checked',true);
            }else{
                $('.chekbox').parent().parent().parent().removeClass('blockedIPRow');
                $( ".chekbox" ).prop('checked',false);
            }
        })
    })    
</script>