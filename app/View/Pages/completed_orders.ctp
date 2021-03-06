<div class="steps-area col-md-12 margauto">
<h1>Completed Orders</h1>
<?php
if(!empty($data)){
    ?>
<table class="table table-striped compOrdTbl"><!--class="table table-striped compOrdTbl">-->
        <thead>
            <tr>
                <th class="col-md-3">Name</th>
                <th class="col-md-3">Created</th>
                <th class="col-md-3">Modified</th>
                <th class="col-md-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($data as $key => $value){
            ?>
            <tr>
                <td> 
                    <a href="/<?php echo preg_replace('/\s+/', '_', strtolower($value['Contract']['name'])); ?>" target="_blank"> <?php echo __($value['Contract']['name']); ?></a>
                </td>
                <td><?php echo $value['Order']['created'] ?></td>
                <td><?php echo $value['Order']['modified'] ?></td>
                <td>   
                    <div>
                    <?php echo $this->Html->link('Print',array('controller' => 'contracts','action'=>'download',$value['Order']['id'],true));?>                    
                    <?php echo $this->Html->link('Contract',array('controller' => 'contracts','action'=>'download',$value['Order']['id']));?>                    
                    <?php echo $this->Html->link('Share',array('controller' => 'pages','action'=>'#'));?> 
                    <?php echo $this->Html->link('Invoices',array('controller' => 'contracts','action'=>'downloadInvoice',$value['Order']['id']),array('target'=>'_blank'));?>
                    <a type="button" class="" data-toggle="modal" data-target=".bs-example-modal-sm-<?php echo $key; ?>">Send</a>
                    </div>  
                </td>
            </tr>
             <!-- Small modal -->
                

            <div class="modal fade bs-example-modal-sm-<?php echo $key; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <h1><?php echo __('Send To'); ?></h1>          
                    <?php
                    echo $this->Form->create(
                        'Contract', array(
                            //'controller' => 'contracts',
                            'action'=>'sendtomail',
                            'inputDefaults' => array(
                                'label' => false,
                                'disv' => false
                            ),
                            'class' => 'recPassForm contactUs'
                        )
                    );
                    ?>
                    <?php
                        echo $this->Form->input(
                            'order_id', array(
                                'type' => 'hidden',
                                'value' => $value['Order']['id'],
                                'div' => false,
                                'error' => false,
                                'label' => __('Email') . '*',
                                'class' => 'form-control'
                            )
                        );
                        ?>
                    <div class="form-group"> 
                        <?php
                        echo $this->Form->input(
                            'email', array(
                                'type' => 'text',
                                'id' => "inputEmail",
                                'div' => false,
                                'error' => false,
                                'label' => __('Email') . '*',
                                'class' => 'form-control'
                            )
                        );
                        ?> 
                    </div>

                    <?php
                    echo $this->Form->input(
                        __('Send'), array(
                            'type' => 'submit',
                            'label' => false,
                            'div' => false,
                            'class' => 'btn'
                        )
                    );
                    echo $this->Form->end();
                    ?>    
                </div>
              </div>
            </div>
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
                    <span>Name</span>
                    <a class="contactName" href="/<?php echo preg_replace('/\s+/', '_', strtolower($value['Contract']['name'])); ?>"> <?php echo __($value['Contract']['name']); ?></a>
                </div>
                <div class="orderRow">
                    <span>Created</span>
                    <div><?php echo $value['Order']['created'] ?></div>
                </div>
                <div class="orderRow">
                    <span>Modified</span>
                    <div><?php echo $value['Order']['modified'] ?></div>
                </div>
                <div class="orderRow">
                    <span>Actions</span>
                    <div class="compOrderActions">
                        <?php echo $this->Html->link('Print',array('controller' => 'contracts','action'=>'download',$value['Order']['id'],true));?>                    
                        <?php echo $this->Html->link('Contract',array('controller' => 'contracts','action'=>'download',$value['Order']['id']));?>                    
                        <?php echo $this->Html->link('Share',array('controller' => 'pages','action'=>'#'));?> 
                        <?php echo $this->Html->link('Invoices',array('controller' => 'contracts','action'=>'downloadInvoice',$value['Order']['id']));?>
                        <?php echo $this->Html->link('Send',array('controller' => 'pages','action'=>'#'));?>                    
                    </div>
                </div>
            </li>
        <?php }
        ?>
    </ul>
    <?php
}else{
    ?>
    <p><?php echo __('You have not bought contract yet.'); ?></p>
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
<?php } ?>
</div>