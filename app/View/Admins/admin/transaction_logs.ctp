<div class="container">
<div class="titleBox">
    <h3 class="pull-left">Transaction Logs</h3>
    <div class="pull-right">
        <?php
            echo $this->Form->create('export',array(
                'url' => array('controller' => 'admins','action' =>'export_file' )
            ));
            echo $this->Form->input('model',array('type'=>'hidden','name'=>'Transaction','value'=>'TransactionLogs'));//name = Model value action
            echo $this->Form->submit('Export to csv', array('div' => false, 'class' => 'btn btn-success right5 pull-left'));
            echo $this->Form->submit('Delete',array('name' => 'delete','value'=>'delete', 'div' => false, 'class' => 'btn btn-danger'));
        ?>
    </div>
</div>
<?php
if(!empty($data)){
    ?>
    <table class="table table-bordered table-striped allContractsTbl logsTbl">
        <thead>
            <tr>
                <th style="width: 5%;"><input id="select" type="checkbox" style="width:20px;height:20px;"></th>
                <th style="width: 18%;"><a href="#">E-mail</a></th>                
                <th style="width: 22%;"><a href="#">Contract Title</a></th>                
                <th style="width: 20%;"><a href="#">Transaction Id</a></th>
                <th style="width: 10%;"><a href="#">Type</a></th> 
                <th style="width: 12%;"><a href="#">Payment Status</a></th>
                <th style="width: 13%;"><a href="#">Transaction Date</a></th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($data as $key => $value){
            ?>
            <tr>
                <td class="text-center selectAll">
                    <?php
                        echo $this->Form->input('id', array('type' => 'checkbox','name' => $value['Transaction']['id'],'value'=>$value['Transaction']['id'],'label' => false,'class'=>'chekbox'));
                    ?>
                </td>    
                <td><?php echo $value['User']['email']; ?> </td>                          
                <td><?php echo $value['Contract']['name']; ?></td>
                <td><?php echo $value['Transaction']['transactionId']; ?></td>
                <td><?php echo $value['Transaction']['type']; ?></td>
                <td><?php echo $value['Transaction']['paymentstatus']; ?></td>
                <td><?php echo $value['Transaction']['created']; ?></td>  
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}else{ ?>
    There is no Transaction
    <?php }?>
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
<script>
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
