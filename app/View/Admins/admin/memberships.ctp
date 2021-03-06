<div class="titleBox">
    <?php echo $this->Html->link('Add New Membership', array('controller' => 'admins', 'action' => 'addMembership'), array('class' => 'btn pull-right')); ?>
</div>

<?php
if (!empty($data)) {
    ?>
    <table class="table table-bordered table-striped allContractsTbl">
        <tr>
            <th style="width: 15%">Name</th>
            <th style="width: 15%">Type</th>
            <th style="width: 15%">Month</th>                
<!--            <th style="width: 15%">6 Months</th>
            <th style="width: 15%">Year</th>-->
            <th style="width: 15%">Individual</th>
            <th style="width: 10%">Status</th>
            <th style="width: 10%"></th>
            <th style="width: 10%"></th>
        </tr>
        <?php
        foreach ($data as $key => $value) {
            ?>
            <tr deleteId="<?php echo $value['Membership']['id']; ?>">
                <td> <?php echo $value['Membership']['name']; ?></td>
                <td> <?php echo $value['Membership']['type']; ?></td>
                    <td>
                        <?php if(!empty($value['Membership']['month_price'])){?>
                            $<?php echo $value['Membership']['month_price']; ?><br>Count
                            <?php echo $value['Membership']['month_count']; }?>
                    </td>
<!--                    <td>
                        <?php //if(!empty($value['Membership']['6months_price'])){?>
                            <?php //echo $value['Membership']['6months_price']; ?><br>Count
                            <?php //echo $value['Membership']['6months_count'];} ?>
                    </td>                -->
<!--                    <td>
                        <?php //if(!empty($value['Membership']['year_price'])){?>
                            $<?php //echo $value['Membership']['year_price']; ?><br>Count
                            <?php //echo $value['Membership']['year_count']; }?>
                    </td>-->
                    <td>
                        <?php if(!empty($value['Membership']['individual_price'])){?>
                            $<?php echo $value['Membership']['individual_price']; } ?>

                    </td>                    
                <td class="text-center">
                    <?php
                    if ($value['Membership']['active'] == 1) {
                        echo '<img src="/img/tick.png" />';
                    }else
                        echo '<img src="/img/cross.png" />';
                    ?>
                </td>                    
                <td class="text-center"><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'editMembership', $value['Membership']['id']), array('class' => 'btn btn-success')); ?></td>
                <td class="text-center"><?php echo $this->Html->link('Delete', array('controller' => 'admins', 'action' => 'deleteMembership', $value['Membership']['id']), array('class' => 'btn btn-danger'), array('Are you sure you want to delete?')); ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}else {
    ?>
    <p class='text-center'>You do not have membership</p>
    <?php
}
?>    
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