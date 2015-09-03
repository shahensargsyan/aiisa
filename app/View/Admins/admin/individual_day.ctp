<div class="individualDays span4">
    <div class="titleBox">
        <h4>Individual contracts modification days allowed</h4>
    </div>
    <table class="allContractsTbl table table-bordered table-striped">
        <thead>
            <tr>              
                <th style="width: 80%">Day</th>
                <th style="width: 20%"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $data['IndividualDay']['day']; ?></td>
                <td class="text-center"><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'EditIndividualDay','Day'), array('class' => 'btn btn-success')); ?></td>
            </tr>
        </tbody>
    </table>
    
    <div class="titleBox">
        <h4 class="top40">Unfinished documents will be deleted</h4>
    </div>
    <table class="allContractsTbl table table-bordered table-striped">
        <thead>
            <tr>              
                <th style="width: 80%">Day</th>
                <th style="width: 20%"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $data['IndividualDay']['unfinished_document']; ?></td>
                <td class="text-center"><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'EditIndividualDay','Unfinished'), array('class' => 'btn btn-success')); ?></td>
            </tr>
        </tbody>
    </table> 

    <div class="titleBox">
        <h4 class="top40">Finished documents will be deleted</h4>
    </div>
    <table class="allContractsTbl table table-bordered table-striped">
        <thead>
            <tr>              
                <th style="width: 80%">Day</th>
                <th style="width: 20%"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $data['IndividualDay']['finished_document']; ?></td>
                <td class="text-center"><?php echo $this->Html->link('Edit', array('controller' => 'admins', 'action' => 'EditIndividualDay','Finished'), array('class' => 'btn btn-success')); ?></td>
            </tr>
        </tbody>
    </table>        
</div>
