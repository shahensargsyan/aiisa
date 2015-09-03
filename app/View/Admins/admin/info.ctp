<div class="span6 margauto">  
    <div class="titleBox">
        <h3>Phone Settings</h3>
    </div>
    <table class="allContractsTbl table table-bordered table-striped">
        <thead>
            <tr>              
                <th style="width: 30%">Top Info</th>
                <th style="width: 30%">Bottom Info</th>
                <th style="width: 40%">Modified</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">
                    <?php 
                        if($data['Info']['top_info'] == true){
                            echo $this->Html->link('Deactivate',array('controller' => 'admins','action' =>'Info',0,'top_info'),array('class'=>'btn btn-success'));
                        }elseif($data['Info']['top_info'] == false){
                            echo $this->Html->link('Activate',array('controller' => 'admins','action' =>'Info',1,'top_info'),array('class'=>'btn'));
                        }
                    ?>
                </td>
                <td class="text-center">
                    <?php 
                        if($data['Info']['bottom_info'] == true){
                            echo $this->Html->link('Deactivate',array('controller' => 'admins','action' =>'Info',0,'bottom_info'),array('class'=>'btn btn-success'));
                        }elseif($data['Info']['bottom_info'] == false){
                            echo $this->Html->link('Activate',array('controller' => 'admins','action' =>'Info',1,'bottom_info'),array('class'=>'btn'));
                        }
                    ?>
                </td>
                <td class="text-center"><?php echo $data['Info']['modified'];?></td>
            </tr>
        </tbody>
    </table>
</div>