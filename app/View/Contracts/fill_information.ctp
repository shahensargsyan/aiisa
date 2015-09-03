<!--<a class="chooseTextColorBtn fancybox" href="#payment_type" id="buyButton">Buy</a>-->
<section class="steps-area">
    <h1><?php echo __($contract['name']); ?></h1>
    <?php echo $this->element('document_menu'); ?>

    <div class="block fillinInfo">
        <div class="text-block">
            <div class="textbox">
                <div class="text">
                        <span class="ico-help">?</span>
                        <h2>Fill In Information</h2>
                        
                </div>
                <form id="example-form" action="#" class="col-md-12 pad0">
                    <div>
                        <?php if($steps){?>
                        <?php $connectives = array(); ?>
                        <?php $j = 0; ?>
                        <?php foreach($steps as $key => $step){ ?>
                            <h3><?php echo __($step['name']); ?> </h3>
                            <section>
                                <div class="col-md-7 padLeft0 padRight0">
                                <?php  
                                foreach($step['data'] as $k => $value){
                                   
                                    if(isset($value['type'])){

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
                                                            'div' => FALSE
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
                                                        'div' => false
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
        //                                            'class' => 'jcf-reset-appearance',
                                                    'placeholder' => $value["placeholder"],
                                                    'required' => $value["required"],
                                                );
                                                if($value["default_value"]){
                                                    $selectOptions['default'] = $value["default_value"];
                                                }
                                                if($value["default_text"]){
                                                    $selectOptions['empty'] = $value["default_text"];
                                                }

                                                ?>
                                <div class="field-area none">
                                        <strong class="label"><label for="state3"><?php echo $value["label"] ?></label></strong>
                                        <div class="field-holder">
                                                <div class="help-area">
                                                    <span rel="tooltip" title="<?php echo $value['help']?>">help</span>
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
                                            <!--<strong class="text"></strong>-->
                                            <ul class="checkbox-list">
                                                <li>
                                                        <!--<span class="jcf-checkbox jcf-checked"><span></span>-->                                                            
                                                            <?php  echo $this->Form->checkbox(
                                                                        $form_ids[$value["form_id"]], array(
                                                                            'value' => $form_ids[$value["form_id"]],
                                                                            'label' => FALSE,
                                                                            'checked' => FALSE,
                                                                            'id' => $value["form_id"]
                                                                        )
                                                                );?>
                                                        <!--</span>-->
                                                        <!--class="jcf-label-active"--><label for="checked" ><?php echo $value["label"] ?></label>
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
                                                            'div' => FALSE
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
                                            case 'separator':
                                                echo '<hr>';
                                            break;
                                            case 'description':
                                                echo '<p  id="'.$k.'">'.strip_tags($value["description"]).'</p>';
                                            break;
                                            case 'title':
                                                echo '<h2  id="'.$k.'">'.strip_tags($value["title"]).'</h2>';
                                            break;
                                            default:
                                                break;
                                        }
                                        if($value['connective_element'] != ''){
                                            echo '</div>';
                                        }
                                    }
                                }

                                ?>
                            </div>
                            <div class="col-md-5 padRight0 questionsInFillInfo">
                                <h4>FAQ</h4>
                                <?php 
                                $k = 0;
                                if($j == 0 && count($faq_question)%count($steps)){
                                    $k = round(count($faq_question)%count($steps));
                                }
                                ?>
                                <?php for($i= $j;$i<$j+$count+$k;$i++) {?>
                                <?php if(isset($faq_question[$i])){
                                    $question =  $faq_question[$i];
                                }else{
                                    continue;
                                } ?>
                                <div>
                                    <a data-toggle="modal" data-target="#questionModal<?php echo $question['Question']['id'];?>"><?php echo strlen($question['Question']['question'])>50?substr($question['Question']['question'],0, 50).'...':$question['Question']['question']; ?></a>
                                </div>
                                <div class="modal fade questionAnswerBox" id="questionModal<?php echo $question['Question']['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><!--<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>--></button>
                                                <h4 class="modal-title" id="myModalLabel"><?php echo $question['Question']['question']; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <?php echo $question['Question']['answer'];?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } $j+=$count; ?>
                            </div>
                        </section>
                        <?php }} ?>
                    </div>
                </form>
                
                
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    (function($){
        var form_data = jQuery.parseJSON('<?php echo json_encode($json_form); ?>');
        var inFormOrLink;
        console.log(form_data);
        var form = $("#example-form");
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function(event, currentIndex, newIndex){
               
                if(currentIndex > newIndex){
                    return true;
                }
                var bool = true;
                $.each(form_data,function(k,val){console.log(currentIndex)
                    if(parseInt(val.step) == parseInt(currentIndex)){
                        if(val.required == 'true'){
                            if(val.type != 'radiobatton'){
                               if(!jQuery('#'+val.form_id).val()){
                                   bool = false;
                               }
                           }else{
                               var name = $('.'+val.form_id).attr('name');
                               var data = form.serializeArray();
                               var radio_val = jQuery.map(data, function(obj) {
                                   if(obj.name == name){
                                       console.log(obj.value)
                                        return obj.value;
                                    }
                               });
                               if(jQuery.isEmptyObject(radio_val)){
                                   bool = false;
                               }
                           }
                       }
                    }
                });
                return bool;
            },
            onFinishing: function(event, currentIndex){
                var bool = true;
                $.each(form_data,function(k,val){
                     if(parseInt(val.step) == parseInt(currentIndex)){
                        if(val.required == 'true'){
                            if(val.type != 'radiobatton'){
                                if(!jQuery('#'+val.form_id).val()){
                                    bool = false;
                                }
                            }else{
                                var name = $('.'+val.form_id).attr('name');
                                var data = form.serializeArray();
                                var radio_val = jQuery.map(data, function(obj) {
                                    if(obj.name == name){
                                        console.log(obj.value)
                                         return obj.value;
                                     }
                                });
                                if(jQuery.isEmptyObject(radio_val)){
                                    bool = false;
                                }
                            }
                        }
                     }
                });
                return bool;
            },
            onFinished: function(event, currentIndex){
                //console.log('sd')
                var data = form.serializeArray();
                $.ajax({
                    url: '/contracts/saveInformation                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       ',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        data : data,
                        id: parseInt(<?php echo $contract['id']; ?>),
                        log_id: parseInt(<?php echo $log_id; ?>),
                        orderId: parseInt(<?php echo $orderId; ?>),
                    },
                    success: function(data){
                        if(data.status){
                            inFormOrLink = false;
                             window.location.replace("<?php echo FULL_BASE_URL;?>/contracts/choose_license/"+<?php echo $contract['id']; ?>);
                        }
                    }
                });
            }
        });
        var connectives = $.parseJSON('<?php echo json_encode($connectives); ?>');
        var form_data = $.parseJSON('<?php echo json_encode($json_form); ?>');
        //console.log(form_data)
        $.each(form_data,function(k,val){
            if(val.type == 'date'){
                $( "#"+val.form_id ).datepicker();
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
      
        
        $('a').on('click', function() { inFormOrLink = true; });
        $('form').on('submit', function() { inFormOrLink = true; });

        $(window).on("beforeunload", function() { 
            return inFormOrLink ? "Do you really want to close?" : null; 
        });
    })( jQuery );
</script>
