<div class="steps-area col-md-12 margauto">
<h1>Orders</h1>
<?php
if(!empty($data)){
    ?>
    <table class="table table-striped ordersTbl">
        <thead>
            <tr>
                <th class="col-md-3 col-xs-3 col-sm-3 col-lg-3">Name</th>
                <th class="col-md-3 col-xs-3 col-sm-3 col-lg-3 col-xs-3 col-sm-3 col-lg-3">Created</th>
                <th class="col-md-3 col-xs-3 col-sm-3 col-lg-3">Modified</th>
                <th class="col-md-3 col-xs-3 col-sm-3 col-lg-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($data as $key => $value){ ?>
            <tr>
                <td> 
                    <a href="/<?php echo preg_replace('/\s+/', '_', strtolower($value['Contract']['name'])); ?>" target="_blank"> <?php echo __($value['Contract']['name']); ?></a>
                </td>
                <td>
                    <?php echo __($value['Membership']['created']);?>
                </td>
                <td>
                    <?php echo __($value['Membership']['modified']);?>
                </td>
                <td>
                    <div class="openorderActions">
                       <?php if($value['Order']['paid']){?>
                       <?php echo $this->Html->link('Modify',array('controller' => 'contracts','action'=>'choose_license',$value['Order']['contract_id'],$value['Order']['id']));?>
                       <?php }else{ ?>
                       <?php echo $this->Html->link('Modify',array('controller' => 'contracts','action'=>'fill_information',preg_replace('/\s+/', '_', strtolower($value['Contract']['name'])),$value['Order']['id']));?>
                       <?php } ?>
                       <?php if($value['Order']['paid']){?>
                       <?php echo $this->Html->link('Finalize',array('controller' => 'contracts','action'=>'choose_license',$value['Order']['contract_id'],$value['Order']['id']));?>
                       <?php }else{ ?>
                       <?php echo $this->Html->link('Finalize',array('controller' => 'contracts','action'=>'fill_information',preg_replace('/\s+/', '_', strtolower($value['Contract']['name'])),$value['Order']['id']));?>
                       <?php } ?>
                       <?php //echo $this->Html->link('Finalize',array('controller' => 'contracts','action'=>'fill_information',$value['Order']['id']));?>
                       <!--<a href="#">Invoices</a>-->
                       <?php echo $this->Html->link('Invoices',array('controller' => 'contracts','action'=>'downloadInvoice',$value['Order']['id']));?>
                       <?php echo $this->Html->link('Delete',array('controller' => 'contracts','action'=>'deleteOrder',$value['Order']['id']),array('class' => 'delete'));?>
                       <!--<a href="/contracts/deleteOrder/">Delete</a>-->
                    </div>
                </td>
                   <div class="modal fade orderPopup" id="viewImg<?php echo $key;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                       <div class="modal-dialog">
                         <div class="modal-content">
                           <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal"></button>
                             <h4 class="modal-title" id="myModalLabel">Contract's First Page</h4>
                           </div>
                           <div class="modal-body">
                             <img src="/system/contracts/<?php echo $value['Contract']['contract_image']?>" />
                           </div>      
                         </div>
                       </div>
                   </div>                
            </tr>
               <?php
        }
        ?>
            </tbody>
    </table>

    <ul class="ordersList">
        <?php
        foreach($data as $key => $value){ ?>    
        <li>
            <div class="orderRow">
                <!--padLeft0 col-md-3--><span>Name</span>
                <!--padRight0 col-md-9--><a class="contactName" href="/<?php echo preg_replace('/\s+/', '_', strtolower($value['Contract']['name'])); ?>"> <?php echo __($value['Contract']['name']); ?></a>
            </div>
            <div class="orderRow">
                <span>Created</span>
                <div><?php echo __($value['Membership']['created']);?></div>
            </div>
            <div class="orderRow">
                <span>Modified</span>
                <div><?php echo __($value['Membership']['modified']);?></div>            
            </div>
            <div class="orderRow">
                <span>Actions</span>
                <div class="orderActions">
                    <?php if($value['Order']['paid']){?>
                    <?php echo $this->Html->link('Modify',array('controller' => 'contracts','action'=>'choose_license',$value['Order']['contract_id'],$value['Order']['id']));?>
                    <?php }else{ ?>
                    <?php echo $this->Html->link('Modify',array('controller' => 'contracts','action'=>'fill_information',preg_replace('/\s+/', '_', strtolower($value['Contract']['name'])),$value['Order']['id']));?>
                    <?php } ?>
                    <?php echo $this->Html->link('Finalize',array('controller' => 'contracts','action'=>'download_pdf',$value['Order']['id']));?>
                    <!--<a href="#">Invoices</a>-->
                    <?php echo $this->Html->link('Invoices',array('controller' => 'contracts','action'=>'downloadInvoice',$value['Order']['id']));?>
                    <?php echo $this->Html->link('Delete',array('controller' => 'contracts','action'=>'deleteOrder',$value['Order']['id']),array('class' => 'delete'));?>
                    <!--<a href="/contracts/deleteOrder/">Delete</a>-->
                 </div>
            </div>
        </li>
        <?php  }
        ?>
    </ul>

    <?php
}else{
    ?>
    <p><i><?php echo __('You do not have order yet.'); ?></i></p>
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
    </div>
<?php } ?>
</div>

<script type="text/javascript">
    (function($){
        $('.delete').click(function(){
            var result = confirm("Do you want to delete order?");
            if (result != true) {
                return false;
            }
        });
        
    })( jQuery );
</script>