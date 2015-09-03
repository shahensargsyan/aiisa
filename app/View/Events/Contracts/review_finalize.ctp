<section class="steps-area">
    <h1>Please Review Your Answers</h1>
    <?php echo $this->element('document_menu'); ?>
    
    <div class="block">
        <div class="text-block">
            <div class="textbox reviewAndFinalizeBox">
                <div class="text">
                    <span class="ico-help">?</span>
                    <h2>Finalize</h2>
                </div>
                <?php
                $connectives = array();
                    foreach($variables as $key=>$variable){
                        $i = 0; 
                        ?>
                        <div class="reviewTitle">
                        <p>
                        <?php
                            echo  $steps[$key]['name'];//step name
                        ?>
                        </p>                         
                        <!-- Button trigger modal -->
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal_<?php echo $key; ?>">
                          Edit
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal_<?php echo $key; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content editContractBox">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"></span><span class="sr-only">Close</span></button>
                              </div>
                              <div class="modal-body">
                                    <form id="example-form_<?php echo $key; ?>" action="#">
                                <?php
                                foreach($steps[$key]['data'] as $k => $value){
                                    if(isset($value['type']) && $value["form_id"]){
                                        $form_value = $variables[$key]['FormId'][$form_ids[$value["form_id"]]];
                                        if($value["connective_element_value"] != ''){
                                            $connectives[$value["connective_element"]][$value["form_id"]]['connective_element'] = $value["form_id"];
                                            $connectives[$value["connective_element"]][$value["form_id"]]['connective_element_value'] = $value["connective_element_value"];
                                        }
                                        if($value['connective_element'] != ''){
                                            echo '<div  class="hide_'.$value["connective_element"].'" id=el_'.$value["form_id"].' style="display:none">';
                                        }
                                        switch($value['type']){
                                            case 'text':
                                                  $options = array(
                                                            'type' => 'text',
                                                            'id' => $value["form_id"],
                                                            'label' => FALSE,
                                                            'class' => 'form-control',
                                                            'placeholder' => $value["placeholder"],
                                                            'required' => $value["required"],
                                                            'div' => FALSE,
                                                            'value' => $form_value
                                                        );
                                                if($value['max_length']){
                                                    $options['maxlength'] = $value['max_length'];
                                                }

                                                ?>
                                                <div clas="textbox">
                                                    <div class="field-area add">
                                                        <strong class="label"><label for="address"><?php echo $value["label"]; ?>*</label></strong>
                                                        <div class="field-holder">
                                                                <div class="help-area">
                                                                        <span rel="tooltip" title="<?php echo $value['help']?>">help</span>
                                                                </div>
                                                                <div class="field">
                                                                        <?php echo $this->Form->input(
                                                                            $form_ids[$value["form_id"]], $options
                                                                        );?>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                break;
                                            case 'textarea':

                                                ?>
                                                <div class="field-area">
                                                    <strong class="label"><label for="textarea"><?php echo $value["label"] ?></label></strong>
                                                    <div class="field-holder">    
                                                        <div class="help-area">
                                                            <span rel="tooltip" title="<?php echo $value['help']?>">help</span>
                                                        </div>
                                                        <div class="textarea">
                                                                    <?php echo $this->Form->input(
                                                                    $form_ids[$value["form_id"]], array(
                                                                        'type' => 'textarea',
                                                                        'id' => $value["form_id"],
                                                                        'label' => false,
                                                                        'class' => 'form-control',
                                                                        'placeholder' => $value["placeholder"],
                                                                        'required' => $value["required"],
                                                                        'div' => false,
                                                                        'value' => $form_value
                                                                    )
                                                            ); ?>
                                                            </div>    
                                                        </div>    
                                                </div>    
                                                <?php
                                                break;
                                            case 'select':
                                                if(isset($value["choises"])){
                                                    $options = $value["choises"];
                                                }else{
                                                    $options = array();
                                                }

                                                $selectOptions = array(
                                                    'options' => $options,
                                                    'id' => $value["form_id"],
                                                    'label' => FALSE,
                                                    'placeholder' => $value["placeholder"],
                                                    'required' => $value["required"],
                                                    'default' => $form_value
                                                );

                                                if($value["default_text"]){
                                                    $selectOptions['empty'] = $value["default_text"];
                                                }

                                                ?>
                                                    <div class="field-area none">
                                                            <strong class="label"><label for="state3"><?php echo $value["label"] ?></label></strong>
                                                            <div class="field-holder">
                                                                    <div class="help-area">
                                                                            <span>help</span>
                                                                    </div>
                                                                    <div class="field">
                                                                                <?php echo $this->Form->input(
                                                                                        $form_ids[$value["form_id"]], $selectOptions
                                                                                );?>

                                                                    </div>
                                                            </div>
                                                    </div>
                                                <?php
                                                break;
                                            case 'checkbox':
                                                ?>
                                                <div class="field-area">
                                                    <div class="field-holder">
                                                        <div class="help-area">
                                                            <span rel="tooltip" title="<?php echo $value['help']?>">help</span>
                                                        </div>
                                                        <div class="box">
                                                            <ul class="checkbox-list">
                                                                <li>
                                                                            <?php 
                                                                            $checked = FALSE;
                                                                            if($form_value == 'Yes'){
                                                                                $checked = TRUE;
                                                                            }
                                                                            echo $this->Form->checkbox(
                                                                                        $form_ids[$value["form_id"]], array(
                                                                                            'value' => $form_ids[$value["form_id"]],
                                                                                            'label' => FALSE,
                                                                                            'checked' => $checked,
                                                                                            'id' => $value["form_id"]
                                                                                        )
                                                                                );?>
                                                                </li>
                                                            </ul>
                                                        </div>  
                                                    </div>
                                                    </div>
                                                <?php

                                                break;
                                            case 'radiobatton':
                                                if(isset($value['radio'])){
                                                    $radio = $value['radio'];
                                                }else{
                                                    $radio = array();
                                                }
                                                
                                                $form_value = array_search($form_value, $radio);
                                                
                                                ?>
                                                    <div class="field-area">
                                                        <strong class="text"><?php echo $value["label"] ?></strong>
                                                        <div class="field-holder">
                                                            <div class="help-area">
                                                                <span rel="tooltip" title="<?php echo $value['help']?>">help</span>
                                                            </div>
                                                    <div class="box">

                                                                    <ul class="radio-list">
                                                                        <?php
                                                                        foreach($radio as $key1 => $val){ ?>
                                                                            <li>
                                                                                <?php 
                                                                                 echo  $this->Form->input( $form_ids[$value["form_id"]], array(
                                                                                        'type' => 'radio', 
                                                                                        'legend' => false,
                                                                                        'class' => $value["form_id"],
                                                                                        'fieldset' => false,
                                                                                        'multiple' => false,
                                                                                        'div' => false,
                                                                                        'options' => array(
                                                                                            $key1 => '',
                                                                                        ),
                                                                                        'value' => $form_value,
                                                                                        'hiddenField' => false
                                                                                    )
                                                                                );
                                                                                ?>
                                                                                <label for="option"><?php echo $val ?></label>
                                                                            </li>

                                                                       <?php }
                                                                        ?>
                                                                    </ul>  
                                                    </div>
                                                    </div>
                                                    </div>
                                                <?php
                                                break;
                                            case 'date':
                                                $options = array(
                                                            'type' => 'text',
                                                            'id' => $value["form_id"],
                                                            'label' => FALSE,
                                                            'class' => 'form-control',
                                                            'placeholder' => $value["placeholder"],
                                                            'required' => $value["required"],
                                                            'div' => FALSE,
                                                            'value' => $form_value
                                                        );
                                                if($value['max_length']){
                                                    $options['maxlength'] = $value['max_length'];
                                                }

                                                ?>
                                                <div clas="textbox">
                                                    <div class="field-area add">
                                                        <strong class="label"><label for="address"><?php echo $value["label"]; ?>*</label></strong>
                                                        <div class="field-holder">
                                                                <div class="help-area">
                                                                        <span rel="tooltip" title="<?php echo $value['help']?>">help</span>
                                                                </div>
                                                                <div class="field">
                                                                        <?php echo $this->Form->input(
                                                                            $form_ids[$value["form_id"]], $options
                                                                        );?>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            default:
                                                break;
                                        }
                                        if($value['connective_element'] != ''){
                                            echo '</div>';
                                        }
                                    }
                                }
                                //var_dump($connectives);die;
                                ?>
                                    </form>
                              </div>
                              <div class="modal-footer">
                                <!--<button type="button" class="closeBtn" data-dismiss="modal">Close</button>-->
                                <button step_id="<?php echo $key?>" type="button" class="save_changes btn">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                            <div class="clearfix"></div>
                        </div>                
                        <table class="table table-bordered ">
                        <?php 
                        foreach($variable['FormId'] as $name=>$step_data){?>
                            <tr class="<?php echo $name; ?>">
                                <td class="col-md-4"><?php echo $variable['name'][$i];//Label ?></td>
                                <td class="col-md-5"><?php echo $name.' ';//FormId key ?></td>
                                <td class="col-md-3" id="<?php echo $name; ?>"><?php echo $step_data.'<br>'; $i++;//FormId  value ?></td>
                            </tr>
                       <?php }?>
                        </table>    
                        <?php }
                ?>
                
            </div>
        </div>
        
        <div class="btn-holder stepBtns">
            <a class="btn-back disabled">Back</a>
            <a class="fialize btn-next pull-right" href="/contracts/download_pdf/<?php echo $orderId; ?>">Save and Continue</a>
        </div>
     </div>
    
</section>
<?php //var_dump($connectives);die;?>
<script type="text/javascript">
     (function($){
        jQuery('.modal span[rel="tooltip"]').tooltip({placement: 'top'});
        var connectives = $.parseJSON('<?php echo json_encode($connectives); ?>');
        var form_data = $.parseJSON('<?php echo json_encode($form); ?>');
        
        $.each(form_data,function(k,val){
            if(val.type == 'date'){
                $( "#"+k ).datepicker();
            }

        });
        $('.save_changes').click(function(){
            var step_id = $(this).attr('step_id');
            var data = $('#example-form_'+step_id).serializeArray();
            console.log(data);
            $.ajax({
                url: '/contracts/save_changes/                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       ',
                dataType: 'json',
                type: 'POST',
                
                data: {
                    data : data,
                    orderId: parseInt(<?php echo $orderId; ?>),
                    step_id: step_id
                },
                success: function(data){
                     console.log(data.params);
                    if(data.status){
                         $.each(data.params,function(k,val){
                             $('#'+k).html(val);
                             $('#myModal_'+step_id).modal('hide');
                         });
                    }
                }
            });
        });
        
        var connectives = $.parseJSON('<?php echo json_encode($connectives); ?>');
        var form_data = $.parseJSON('<?php echo json_encode($form); ?>');
        console.log(form_data)
        $.each(form_data,function(k,val){
            if(val.type == 'date'){
                $( "#"+k ).datepicker();
               
            }

        });
        $.each(connectives,function(i,connective){
            $.each(connective,function(j,val){
                $(document).on('change click','#'+i+',.'+i,function(){
                    var value;
                    switch(form_data[i].type){
                        case 'select':
                            value = $(this).val();
                        break;
                        case 'radiobatton':
                             value = $(this).val();
                        break;
                        case 'checkbox':
                            if($(this).is(':checked'))
                                value = 1;
                            else
                                value = 0;
                        break;
                    }
                    
                    var id = parseInt(val.connective_element_value);
                    if(value == id && value != ''){
                        $('#el_'+val.connective_element).css('display','block');
                    }else{
                        $('#el_'+val.connective_element).css('display','none');
                        $('#'+val.connective_element).val('');

                        var  default_text = '';
                        if(form_data[val.connective_element].default_text){
                            default_text = form_data[val.connective_element].default_text;
                        }
                        $('#'+val.connective_element).next('span').html("<span class=''>"+default_text+"</span>");
                        hideElement(val.connective_element);
                    }
                });
            });
        });
        function hideElement(x){
            var bool = true;
            do {
                bool = false;
                if(x in connectives){
                    $.each(connectives[x],function(t,child){
                        bool = true;
                        x = connectives[x];

                        $('#el_'+child.connective_element).css('display','none');
                        $('#'+child.connective_element).val('');
                        var  default_text = '';
                        if(form_data[child.connective_element].default_text){
                            default_text = form_data[child.connective_element].default_text;
                        }
                        $('#'+child.connective_element).next('span').html("<span class=''>"+default_text+"</span>");

                        if(child.connective_element in connectives){

                            if(child.connective_element in connectives){
                                hideElement(child.connective_element);
                            }
                        }
                    });
                }
            }
            while (bool);
        }
        $('.fialize').click(function(){
             var ok = confirm("Once you click FINALIZE button, your document will be created and you will not be able to modify it again in the future, but only to Print or Download it.");
             if(!ok){
                 return false;
             }else{
                $.ajax({
                    url: '/contracts/finalize_order/                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       ',
                    dataType: 'json',
                    type: 'POST',

                    data: {
                        orderId: parseInt(<?php echo $orderId; ?>),
                    },
                    success: function(data){
                        console.log(data.status);
                        if(data.status){
                            window.location.replace("<?php echo FULL_BASE_URL;?>/contracts/download_pdf/"+data.params);
                        }else{
                            alert(data.message)
                            return false;
                        }
                    }
                });
                return false;
            }
        });
    })( jQuery );
    
    
    
</script>