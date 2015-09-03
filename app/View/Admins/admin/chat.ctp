<div class="span6 margauto">  
    <div class="titleBox">
        <h3>Live Chat</h3>
    </div>
    <table class="allContractsTbl table table-bordered table-striped">
        <thead>
            <tr>              
                <th style="width: 30%">Live Chat</th>
                <th style="width: 40%">Modified</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">
                    <?php 
                        if($data['Chat']['active'] == true){
                            echo $this->Html->link('Deactivate',array('controller' => 'admins','action' =>'Chat',0),array('class'=>'btn btn-success'));
                        }elseif($data['Chat']['active'] == false){
                            echo $this->Html->link('Activate',array('controller' => 'admins','action' =>'Chat',1),array('class'=>'btn'));
                        }
                    ?>
                </td>
                <td class="text-center"><?php echo $data['Chat']['modified'];?></td>
            </tr>
        </tbody>
    </table>
</div>