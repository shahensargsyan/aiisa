<div class="span10 margauto">
    <div class="titleBox">
        <div class="pull-left">
            <?php 
                echo $this->Form->create('export',array(
                    'url' => array('controller' => 'admins','action' =>'export_file' )
                ));
                echo $this->Form->input('model',array('type'=>'hidden','name'=>'BlockedIp','value'=>'blockedIp'));//name = Model value action
                echo $this->Form->submit('Export to csv', array('div' => false, 'class' => 'btn btn-success right5 pull-left'));
                echo $this->Form->submit('Delete',array('name' => 'delete','value'=>'delete', 'div' => false, 'class' => 'btn btn-danger'));
            ?>
        </div>
        <?php echo $this->Html->link('Add New IP', array('controller' => 'admins', 'action' => 'blocked'), array('class' => 'btn pull-right')); ?>
    </div>
<?php
if(!empty($data)){
    ?>
    <table class="table table-bordered table-striped allContractsTbl">
        <thead>
            <tr>
                <th style="width: 5%;"><input id="select" type="checkbox" style="width:20px;height:20px;"></th>
                <th style="width: 25%;">IP</th>
                <th style="width: 40%;">Reason</th>
                <th style="width: 20%;">Created</th>
            </tr>
        </thead>
        <tbody>
        <?php
        
        foreach($data as $key => $value){
            $class = '';
            if($value['BlockedIp']['reason'] == 'Wrong email/password specified'){
                $class = 'loginBlocked';
            }
            ?>
            <tr deleteId="<?php echo $value['BlockedIp']['id']; ?>" class="<?php echo $class ?>">
               <td class="text-center selectAll">
                    <?php
                       echo $this->Form->input('id', array('type' => 'checkbox','name' => $value['BlockedIp']['id'],'value'=>$value['BlockedIp']['id'],'label' => false,'class'=>'chekbox'));
                    ?>
               </td>                
                <td> <?php
                    echo $value['BlockedIp']['ip_address'];
                    ?>
                </td>
                <td class="text-center"><?php echo $value['BlockedIp']['reason']; ?></td>
                <td class="text-center"><?php echo $value['BlockedIp']['created']; ?></td>
                <!--<td class="text-center"><a href="#" class="btn btn-danger deleteCategory">Delete</a></td>-->
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}else{
    ?>
   <p> You do not have Blocked IP </p>
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
            if(confirm('Are you sure you want to delete this ip from blocked list?')){
                var deleteId = $(this).parent().parent().attr('deleteId');
                var deleteh = $(this).parent().parent();
                $.ajax({
                    url: '/admins/delete',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: deleteId,
                        model: 'BlockedIp'
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
        });
    });   
</script>