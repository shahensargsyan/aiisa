<div class="container">
    <div class="titleBox">
        <?php echo $this->Html->link('Add Library', 
                array(
                    'controller' => 'admins',
                    'action' => 'addLibrary'
                ), 
                array('class' => 'btn pull-right')); 
        ?>
    </div>
<?php
if(!empty($libraries)){
    ?>
    <table class="table table-bordered table-striped allContractsTbl">
        <thead>
            <tr>
                <th style="width: 3%;"><input id="select" type="checkbox" style="width:20px;height:20px;"></th>
                <th style="width: 11%;">PDF</th>                
                <th style="width: 7%;"></th>
                <th style="width: 7%;"></th>
            </tr>
        </thead>
        <?php
        foreach($libraries as $key => $value){
            ?>
           <tr deleteId="<?php echo $value['Library']['id']; ?>"> <!--checked-->
               <td class="text-center selectAll">
                    <?php
                       echo $this->Form->input('id', array('type' => 'checkbox','name' => $value['Library']['id'],'value'=>$value['Library']['id'],'label' => false,'class'=>'chekbox'));
                    ?>
               </td>
               <td><a href="/system/libraries/<?php echo $value['Library']['filename']; ?>"><?php echo $value['Library']['title']; ?></a></td>                          
                <td class="text-center"><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'editLibrary', $value['Library']['id']), array('class' => 'btn btn-success')); ?></td>
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
    There is no libraries
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
            if(confirm('Are you sure you want to remove this slider?')){
                var deleteId = $(this).parent().parent().attr('deleteId');
                var deleteh = $(this).parent().parent();
                $.ajax({
                    url: '/admins/delete',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: deleteId,
                        model: 'Library'
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