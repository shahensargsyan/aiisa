<div class="container">
    <div class="titleBox">
<!--        <div class="pull-left">
        <?php 
            echo $this->Form->create('export',array(
                'url' => array('controller' => 'admins','action' =>'export_file' )
            ));
            echo $this->Form->input('model',array('type'=>'hidden','name'=>'User','value'=>'users'));//name model value action
            echo $this->Form->submit('Export to csv', array('div' => false, 'class' => 'btn btn-success pull-left right5'));
            echo $this->Form->submit('Delete',array('name' => 'delete','value'=>'delete', 'div' => false, 'class' => 'btn btn-danger'));
        ?>
        </div>-->

        <?php echo $this->Html->link('Add User', 
                array(
                    'controller' => 'admins',
                    'action' => 'add_user'
                ), 
                array('class' => 'btn pull-right')); 
        ?>
    </div>
<?php
if(!empty($data)){
    ?>
    <table class="table table-bordered table-striped allContractsTbl">
        <thead>
            <tr>
                <th style="width: 3%;"><input id="select" type="checkbox" style="width:20px;height:20px;"></th>
                <th style="width: 11%;">First name</th>                
                <th style="width: 10%;">Last name</th>                
                <th style="width: 14%;">E-mail</th>
                <th style="width: 14%;">IP Address</th> 
                <th style="width: 12%;">Created</th>
                <th style="width: 12%;">Modified</th>
                <th style="width: 10%;">Active</th>
                <th style="width: 7%;"></th>
                <th style="width: 7%;"></th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($data as $key => $value){
            ?>
           <tr deleteId="<?php echo $value['User']['id']; ?>"> <!--checked-->
               <td class="text-center selectAll">
                    <?php
                       echo $this->Form->input('id', array('type' => 'checkbox','name' => $value['User']['id'],'value'=>$value['User']['id'],'label' => false,'class'=>'chekbox'));
                    ?>
               </td>
                <td><?php echo $value['User']['first_name']; ?> </td>                          
                <td><?php echo $value['User']['last_name']; ?></td>
                <td><?php echo $value['User']['email']; ?></td>
                <td><?php echo $value['User']['ip_address']; ?></td>
                <td><?php echo $value['User']['created']; ?></td>
                <td><?php echo $value['User']['modified']; ?></td>  
                <td class="text-center">
                    <?php
                    if($value['User']['active'] == 1){
                        echo '<img src="/img/tick.png" />';
                    }
                    else echo '<img src="/img/cross.png" />';
                    ?>
                </td>
                <td class="text-center"><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'editUser', $value['User']['id']), array('class' => 'btn btn-success')); ?></td>
                <td class="text-center"><a href="#" class="btn btn-danger deleteUser">Delete</a></td>
            </tr>
            <?php
        }
        echo $this->Form->end();
        ?>
        </form>
    </table>
    <?php
}else{
    ?>
    There is no User
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

        $(document).on('click', '.deleteUser', function(){
            if(confirm('Are you sure you want to remove this user?')){
                var deleteId = $(this).parent().parent().attr('deleteId');
                var deleteh = $(this).parent().parent();
                $.ajax({
                    url: '/admins/delete',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: deleteId,
                        model: 'User'
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
          //$('.chekbox').click();  
        })
    })    
</script>