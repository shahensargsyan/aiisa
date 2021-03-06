<?php if(!isset($user_data)){?>
<div class="span5 margauto">
    <div class="titleBox">
        <h3>
            <?php if($model == 'Order'){
                echo 'Contract';
            }else echo $model;?>
        </h3>
    </div>
    <table class="table table-bordered summaryTbl">
        <thead>
            <tr>
                <?php if($model == 'User'){?>             
                <th style="width: 30%">First Name</th>
                <th style="width: 30%">Last Name</th>
                <th style="width: 40%">Email</th>  
                <?php } if($model == 'EmailSubscription'){?>
                <th style="width: 40%">Email</th>    
                <?php } if($model == 'Order'){ $model = 'User';?>
                <th style="width: 20%">First Name</th>
                <th style="width: 20%">Last Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 20%">Contrct Title</th>
                <?php }?>
                
            </tr>
        </thead>
        <tbody>
        <?php foreach($data_model as $data){?>
            <tr>
                 <?php foreach($data[$model] as $data_field){?>
                    <td>
                        <?php echo $data_field;?>
                    </td>
                <?php } if(isset($data['Contract'])){?>
                    <td>
                        <?php echo $data['Contract']['name'];?>
                    </td>
                <?php }?>
            </tr>
        <?php }?>
        </tbody>
    </table>
    </div>
<?php }else{?>
<div class="span5 margauto">
<div class="titleBox">
    <h3>Summary Page</h3>
</div>
<table class="table table-bordered summaryTbl">
<!--    <thead>
        <tr>
            <th class="text-center">New sign-ups today</th>
            <th class="text-center">New Sign-ups this month</th>
            <th class="text-center">New Email Subscriptions today</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center"><?php echo $this->Html->link($data_count,array('controller' => 'admins','action' => 'SummaryPage','User',$data_todey)); ?></td>
            <td class="text-center"><?php echo $this->Html->link(count($user_data),array('controller' => 'admins','action' => 'SummaryPage','User',$data_month)); ?></td>
            <td class="text-center"><?php echo $this->Html->link(count($email_subscription),array('controller' => 'admins','action' => 'SummaryPage','EmailSubscription',$data_todey)); ?></td>
                                    <?php echo $this->Html->link(count($contract_data),array('controller' => 'admins','action' => 'SummaryPage','Order',$data_todey)); ?></td>
        </tr>   
    </tbody>-->
    <tr>
         <td class="span8">New sign-ups today</td>
         <td class="span4">
             <?php echo $this->Html->link($data_count,array('controller' => 'admins','action' => 'SummaryPage','User',$data_todey)); ?>
         </td>
    </tr>
    <tr>
          <td>New Sign-ups this month</td>
          <td>
              <?php echo $this->Html->link(count($user_data),array('controller' => 'admins','action' => 'SummaryPage','User',$data_month)); ?>
          </td>
    </tr>
    <tr>
         <td>New Email Subscriptions today</td>
         <td>
             <?php echo $this->Html->link(count($email_subscription),array('controller' => 'admins','action' => 'SummaryPage','EmailSubscription',$data_todey)); ?>
         </td>
    </tr>
    <tr>
         <td>New Customized Contracts today</td>
         <td>
             <?php echo $this->Html->link(count($contract_data),array('controller' => 'admins','action' => 'SummaryPage','Order',$data_todey)); ?>
         </td>
    </tr>
</table>
</div>
<?php }?>
<?php
$count = $this->Paginator->params();
if ($count['pageCount'] > '1') {
    ?>
    <div class="pagination">
        <ul>
            <li class="disabled"><?php echo $this->Paginator->prev('Prev', null, null); ?></li>
            <li><?php echo $this->Paginator->numbers(array("separator" => false)); ?></li>
            <li ><?php echo $this->Paginator->next('Next', null, null); ?></li>
        </ul>
    </div>  
<?php } ?>  