<script type="text/javascript">
    $(document).ready(function(){
        $('#typeSub').click(function(){
            var serdata = $('#TypeTypesForm').serialize();
            $.ajax({
                data: serdata,
                type: 'post',
                url: '/admins/addType/',
                dataType: 'json',
                success: function(data){
                    if(data.status){
                        $('#add').modal('hide');
                        //location.reload(300000);
                        $.jGrowl("Coupon type has been added succesfully", {position: 'center', theme: 'noteJg'});
                        setTimeout(
                        function(){
                            location.reload();
                        },
                        3000
                        );
                    }else{
                        $.jGrowl(data.response, {position: 'center'});
                    }

                }
            });
            return false;
        });

        $('.editType').click(function(){
            var catId = $(this).attr('catId');
            $.ajax({
                data: {catId: catId, type: 'open'},
                type: 'post',
                url: '/admins/editTypeAjax/',
                dataType: 'json',
                success: function(data){
                    if(data.status){
                        $('#EditTypeTitle').val(data.params.type.title);
                        $('#EditTypeId').val(catId);
                        if(data.params.type.active){
                            $('#EditTypeActive').val(1);
                        }else{
                            $('#EditTypeActive').val(0);
                        }
                        $('#edit').modal('show');
                    }else{
                        $.jGrowl("Coupon type has been added succesfully");
                    }

                }
            });
        });

        $('#editType').click(function(){
            var serdata = $('#EditTypeTypesForm').serialize();
            $.ajax({
                data: serdata,
                type: 'post',
                url: '/admins/editTypeAjax/',
                dataType: 'json',
                success: function(data){
                    if(data.status){
                        $('#edit').modal('hide');
                        location.reload();
                    }else{
                        $.jGrowl(data.response, {position: 'center'});
                    }
                }
            });
            return false;
        })
    })
</script>
<div class="clearfix admtop">
    <h3 class="pull-left">Coupon Types</h3>
    <a class="btn btn-primary pull-right" href="#add" role="button"  data-toggle="modal">Add Coupon Type</a>
</div>
<hr class="separator">

<table class="table table-bordered">

    <thead>
        <tr>
            <th>
                Title 
            </th>
            <th colspan="2">
                Actions
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(isset($type)){
            foreach($type as $type){
                ?> 
                <tr>
                    <td>
                        <?php echo $type['Type']['title']; ?>
                    </td>

                    <td>
                        <?php
                        echo $this->Html->link('Delete', array(
                            'controller' => 'admins',
                            'action' => 'deleteType',
                            $type['Type']['id']), array(
                            'class' => "btn btn-small",
                            'role' => "button",
                            'data-toggle' => "modal"
                        ));
                        ?>
                    </td>
                    <td>
                        <a class="editType btn btn-small" catId="<?php echo $type['Type']['id']; ?>">Edit</a>
                    </td>

                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
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
<div id="add" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="false">x</button>
        <h3 class="myModalLabel">My Company</h3>
    </div>
    <?php
    echo $this->Form->Create(
            'Type', array(
        'inputDefaults' => array(
            'label' => array('class' => 'control-label'),
            'div' => array('class' => 'controls'),
        //'id'=>'typeForm'
        ),
        'class' => 'form-horizontal margauto regform'
            )
    );
    ?>  
    <div class="modal-body">   
        <div class="control-group">
            <label class="control-label">Title </label>
            <?php
            echo $this->Form->input(
                    'title', array(
                'type' => 'text',
                'label' => FALSE,
                'placeholder' => "title"
                    )
            );
            ?>
        </div>
        <div class="control-group">
            <label class="control-label">Active </label>
            <?php
            echo $this->Form->input(
                    'active', array(
                'label' => FALSE,
                'options' => array(
                    1 => 'active',
                    0 => 'inactive'
                )
                    )
            );
            ?>
        </div>
        <?php
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo $this->Form->end();
        ?>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-inverse" id="typeSub">Add</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>           
    </div>
</div>
<div id="edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="false">x</button>
        <h3 class="myModalLabel">My Company</h3>
    </div>
    <?php
    echo $this->Form->Create(
            'EditType', array(
        'inputDefaults' => array(
            'label' => array('class' => 'control-label'),
            'div' => array('class' => 'controls'),
        //'id'=>'typeForm'
        ),
        'class' => 'form-horizontal margauto regform'
            )
    );
    ?>  
    <div class="modal-body">   
        <div class="control-group">
            <label class="control-label">Title </label>
            <?php
            echo $this->Form->input(
                    'title', array(
                'type' => 'text',
                'label' => FALSE,
                'placeholder' => "title"
                    )
            );
            ?>
        </div>
        <div class="control-group">
            <label class="control-label">Active </label>
            <?php
            echo $this->Form->input(
                    'active', array(
                'label' => FALSE,
                'options' => array(
                    1 => 'active',
                    0 => 'inactive'
                )
                    )
            );
            ?>
        </div>
        <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-inverse" id="editType">Edit</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>           
    </div>
</div>