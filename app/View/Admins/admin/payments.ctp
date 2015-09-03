<div class="span10 margauto">
    <div class="titleBox">
        <h3>Payments</h3>
    </div>
    <table class="table table-bordered table-striped span10 margauto allContractsTbl">
        <thead>
            <tr>              
                <th style="width: 35%">Name</th>
                <th style="width: 15%">Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $value) {
                ?>
                <tr>
                    <td><?php echo $value['Setting']['name']; ?></td>
                    <td class="text-center"><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'editSetting', $value['Setting']['name']), array('class' => 'btn btn-success')); ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>