<div>Start customizing your form by adding a step:</div>
<input type="button" name="add step" class="btn btn-success top5" value="Add Step" id="add_step">

<div class="top10">Please select the form input name, in order to create a form field:</div>
<?php
    echo $this->Form->input(
        'form_id', array(
            'options' => $form_ids,
            //'label' => 'Form ID',
            'label' => false,
            'id' => 'form_ids',
            'empty' => "Select The form id",
            'class' => 'top5 formIdFld'
        )
    );
?>
<div class="top10">Please select:</div>
<div class="tools">    
    <div class="tool" id="title">Title</div>
    <div class="tool" id="description">Description</div>
    <div class="tool" id="separator">Separator</div>
</div>

<div class="top10">Please choose a field type:</div>
<div class="tools">
    <div class="tool" id="text">Text</div>
    <div class="tool" id="textarea">Textarea</div>
    <div class="tool" id="select">Select</div>
    <div class="tool" id="checkbox">Checkbox</div>
    <div class="tool" id="radiobatton">Radio Button</div>
    <div class="tool" id="date">Date</div>    
</div>




<div class="workarea" id="workarea" style="<?php echo ($steps)?'':'display: none;'; ?>">
    <div id="tabs">
        <ul id="steps">
            <?php 
            $connectives = array();
            $non_id = array('separator','description','title');
            foreach ($steps as $key => $step) { ?>
                <li><a href="#step_<?php echo $key; ?>_area" stepId="<?php echo $key; ?>" class="step" id="step_<?php echo $key; ?>"><?php echo $step['name']; ?></a></li>
                <?php
                
                foreach ($step["data"] as $g => $value) {
                    //var_dump($step);die;
                    if(isset($value['type'])){
                        switch ($value['type']) {
                            case 'select':
                                $connectives[$key][$value['form_id']] = $value["choises"];
                            break;
                            case 'radiobatton':
                                $connectives[$key][$value['form_id']] = $value["radio"];
                            break;
                            case 'checkbox':
                                $connectives[$key][$value['form_id']] = array(0 => 'No',1 => 'Yes');
                            break;
                        }
                    }
                }
            }?>
        </ul>
    <?php 
    $child_connective_change = array();$k = 1;
    foreach ($steps as $key => $step) { ?>
            <div class="step_area active_area" id="step_<?php echo $key; ?>_area" >
                <div class="stepHeader">
                    <div class="pull-left">
                        <label>Step Name</label>
                        <input type="text" class="step_name" step_id="<?php echo $key; ?>" value="<?php echo $step['name']; ?>">
                    </div>
                   <span delId="<?php echo $key; ?>" class="delStep btn btn-danger">Delete Step</span>
                </div>
                <div class="toggleAccordion openCloseForms">
                    <div class="open btn" step_id="<?php echo $key; ?>">Expand All</div>
                    <div class="close btn" step_id="<?php echo $key; ?>">Collapse All</div>
                </div>
                <div id="accordion_<?php echo $key; ?>">
                <?php
            $step = $step['data'];
            $i = 0;
            foreach ($step as $g => $value) {
                $form_name = '';
                if(!in_array($value['type'], $non_id)){
                    $form_name = '('.$form_ids[$value["form_id"]].')';
                }
                
                echo '<div class="forms" formId="'.$value["form_id"].'" id="form_'.$i.'">';
                $i++;
                echo '<h3 id="h3_'.$k.'" class="blockName">'.$value["type"].$form_name.'</h3><div id="div_'.$k.'">';
                //<div class="blockName">'.$value["type"].$form_name.' </div>
                echo '<div  class="element" id="area'.$k.'" ><div><div elementId="'.$k.'" class="element_content span6">';
                if(isset($value["label"])){
                    echo '<label id="label'.$k.'">'.$value["label"].'</label>';
                }
                $help = '<span class="help-area btn btn-default" id="help_'.$k.'" rel="tooltip" title="'.$value['help'].'">Help</span>';
                if(isset($value['type'])){
                    switch ($value['type']) { 
                        case 'text':

                            echo $this->Form->input(
                                $form_ids[$value["form_id"]], array(
                                    'type' => 'text',
                                    'id' => $k,
                                    'label' => FALSE,
                                    'div' => array(
                                        'class' => 'control-group'
                                    ),
                                    'placeholder' => $value["placeholder"],
                                    'required' =>  $value["required"],
                                )
                            );
                            echo $help;
                            break;
                        case 'textarea':
                            echo $this->Form->input(
                                $form_ids[$value["form_id"]], array(
                                    'type' => 'textarea',
                                    'id' => $k,
                                    'label' => FALSE,
                                    'div' => array(
                                        'class' => 'control-group'
                                    ),
                                    'placeholder' => $value["placeholder"],
                                    'required' =>  $value["required"],
                                )
                            );
                            echo $help;
                            break;
                        case 'select':
                            if(isset($value["choises"])){
                                $options = $value["choises"];
                            }else{
                                $options = array();
                            }
                            echo $this->Form->input(
                                $form_ids[$value["form_id"]], array(
                                    'options' => $options,
                                    'id' => $k,
                                    'label' => FALSE,
                                    'div' => array(
                                        'class' => 'control-group'
                                    ),
                                    'placeholder' => $value["placeholder"],
                                    'required' =>  $value["required"],
                                )
                            );
                            echo $help;
                            break;
                        case 'checkbox':
                            echo "<div = class='control-group'>";
                            echo $this->Form->checkbox(
                                    $form_ids[$value["form_id"]],
                                    array(
                                        'value' => $form_ids[$value["form_id"]],
                                        'label' => FALSE,
                                        'checked' => FALSE
                                    )
                                );
                            echo "</div>";
                            echo $help;
                            break;
                        case 'radiobatton':
                            
                            if(isset($value['radio'])){
                                $radio = $value['radio'];
                            }else{
                                $radio = array();
                            }
                            echo '<div id="radio_imouts'.$k.'">';
                            foreach($radio as $key1 => $val){
                                echo  $this->Form->input( $value["name"], array(
                                        'type' => 'radio', 
                                        'legend' => false,
                                        'class' => 'pull-left',
                                        'fieldset' => false,
                                        'multiple' => false,
                                        'options' => array(
                                            'amount'=>$val,
                                        )
                                    )
                                );
                            }
                            
                            echo '</div>';
                            echo $help;
                        break;
                        case 'date':
                            echo $this->Form->input(
                                $form_ids[$value["form_id"]], array(
                                    'type' => 'text',
                                    'id' => $k,
                                    'label' => FALSE,
                                    'div' => array(
                                        'class' => 'control-group'
                                    ),
                                    'placeholder' => $value["placeholder"],
                                    'required' =>  $value["required"],
                                )
                            );
                            echo $help;
                        default:
                        break;
                        case 'separator':
                            echo '<hr>';
                        break;
                        case 'description':
                            echo '<p  id="'.$k.'">'.strip_tags($value["description"]).'</p>';
                        break;
                        case 'title':
                            echo '<h3  id="'.$k.'">'.strip_tags($value["title"]).'</h3>';
                        break;
                        default:
                            break;
                    }
                }
                
                echo '<span class="delete btn btn-danger" delId="'.$k.'">Delete</span></div>';

                echo '<div class="element_settings span5" id="settings_'.$k.'">';
                if($value['required'] == 'true'){
                    $checked = 'checked';
                }else{
                    $checked = '';
                }
                echo '
                    <h4>Settings</h4>';
                    $help = '<div id="help_area_'.$k.'">
                        <label>help</label>
                        <input type="text" name="help" element_id="'.$k.'" class="help" placeholder="help" id="helpinput_'.$k.'" value="'.$value['help'].'">
                    </div>';
                    $label = '<div id="label_area_'.$k.'">
                        <label>label</label>
                        <input type="text" name="label" element_id="'.$k.'" class="Label" placeholder="label" id="label_'.$k.'" value="'.$value['label'].'">
                    </div>';
                    $placeholder = '<div id="placeholder_area_'.$k.'">
                        <label>placeholder</label>
                        <input type="text" name="placeholder" element_id="'.$k.'" class="placeholder" placeholder="placeholder" id="placeholder_'.$k.'" value="'.$value['placeholder'].'">
                    </div>';
                    $description = '<div id="description_area_'.$k.'">
                        <label>description</label>
                        <textarea type="text" name="description" element_id="'.$k.'" class="description" placeholder="description" id="description_'.$k.'" value="">'.$value['description'].'</textarea>
                    </div>';
                    $title = '<div id="title_area_'.$k.'">
                        <label>title</label>
                        <textarea type="text" name="title" element_id="'.$k.'" class="title" placeholder="title" id="title_'.$k.'" value="">'.$value['description'].'</textarea>
                    </div>';
                    $max_length = '<div id="max_length_area_'.$k.'">
                        <label>max length</label>
                        <input type="number" name="max_length" element_id="'.$k.'" class="max_length"  placeholder="max length" id="max_length_'.$k.'" value="'.$value['max_length'].'">
                    </div>';
                    $default_value ='<div id="default_value_area_'.$k.'">
                        <label>Default value</label>
                        <input type="text" name="default_value" element_id="'.$k.'" class="default_value" placeholder="default value" id="default_value_'.$k.'" value="'.$value['default_value'].'">
                    </div>';
                    $required = '<div id="required_area_'.$k.'">
                        <label>Required</label>
                        <input type="checkbox" name="checkbox[]" element_id="'.$k.'" class="required" id="required_'.$k.'" value="Required" '.$checked.'>
                    </div>';
                    $input_type = '<div class="left95" id="input_type_'.$k.'">
                                <select element_id="'.$k.'" class="input_type" id="input_type_'.$k.'">
                                    <option val="">Select input type</option>
                                    <option val="numeric">numeric</option>
                                    <option val="email">email</option>
                                    <option val="text">text</option>
                                </select>
                             </div>';
                    switch ($value['type']) { 
                    case 'text':
                        echo $help;
                        echo $label;
                        echo $placeholder;
                        echo $max_length;
                        echo $required;
                        echo $input_type;
                        break;
                    case 'textarea':
                        echo $help;
                        echo $label;
                        echo $placeholder;
                        echo $max_length;
                        echo $required;
                        break;
                    case 'select':
                        echo $help;
                        echo $label;
                        echo $required;
                        break;
                    case 'checkbox':
                        echo $help;
                        echo $label;
                        echo $required;
                        break;
                    case 'radiobatton':
                        echo $help;
                        echo $label;
                        echo $required;
                    break;
                    case 'date':
                        echo $help;
                        echo $label;
                        echo $placeholder;
                        echo $required;
                    case 'separator':

                    break; 
                    case 'description':
                        echo $description;
                    break;
                    case 'title':
                        echo $title;
                    break;
                    default:
                        break;
                }
                if($value['type'] == 'select'){
                    echo '<div id="select_settings_'.$k.'">
                            <div>
                                <label>default text</label>
                                <input type="text" name="default_text" element_id="'.$k.'" class="default_text "id="default_text_'.$k.'" value="default_text" value="'.$value['default_text'].'">
                            </div>
                            <div>
                                <label>choice</label>
                                <input type="text" element_id="'.$k.'" name="choice" id="choice_value_'.$k.'" value="choice">
                            </div>
                            <input type="button" element_id="'.$k.'" name="add" class="add" value="Add"  class="addBtn btn btn-success">
                            <div id="choices_'.$k.'" class="top10">';
                    if(isset($value['choises'])){
                        foreach ($value['choises'] as $c => $choice) {
                            $selected = '';
                            if((int)$value['default_value'] == $c){
                                $selected = 'checked="checked"';
                            }
                            echo '<div id="choice_'.$c.'" class="choice">'
                                    . '<div class="singleChoice">'
                                    . '<div class="choice_item">'.$choice.'</div>'
                                    . '<input '.$selected.' type="radio" element_id="'.$k.'" element_id="'.$k.'" class="for_select_default default_'.$k.'" name="default_'.$k.'" value="'.$c.'">'
                                    . '</div><div class="delChoiceBox">'
                                    . '<span class="delChoice btn btn-danger btn-small" element_id="'.$k.'" delid="'.$c.'">Delete<span>'
                                    . '</span></span></div>'
                                . '</div>';
                        }    
                    }
                    echo        '</div>
                    </div>';
                }
                if($value['type'] == 'radiobatton'){
                    echo '<div id="radio_settings_'.$k.'" class="radioSet">
                            <div class="overHidden left95">
                                <input type="text" name="value" id="radio_value_'.$k.'" value="">
                                <input type="button" element_id="'.$k.'" name="add-radio" value="Add" id="add_radio_'.$k.'"" class="btn btn-success add_radio"> 
                            </div>
                            <div class="clearfix"></div>
                            <div id="radio_inputs_'.$k.'" element_id="'.$k.'" class="allRadioInputs top20">';
                    if(isset($value['radio'])){
                        foreach ($value['radio'] as $c => $choice) {
                            //echo '<div id="radio_'.$r.'" class="radio"><div class="radio_item">'.$radio.'</div><div><span class="delRadio  btn btn-danger btn-small" delid="'.$r.'" element_id="'.$k.'">Delete<span></span></span></div></div>';
                            $selected = '';
                            if((int)$value['default_value'] == $c){
                                $selected = 'checked="checked"';
                            }
                            echo '<div id="radio_'.$c.'" class="choice">'
                                    . '<div class="singleChoice">'
                                    . '<div class="choice_item">'.$choice.'</div>'
                                    . '<input '.$selected.' element_id="'.$k.'" type="radio" class="for_radio_default default_'.$k.'" name="default_'.$k.'" value="'.$c.'">'
                                    . '</div><div class="delChoiceBox">'
                                    . '<span class="delRadio btn btn-danger btn-small" element_id="'.$k.'" delid="'.$c.'">Delete<span>'
                                    . '</span></span></div>'
                                . '</div>';
                        } 
                    }
                    echo '</div>
                        </div>';
                }
                echo '<div class="connectives connectives_'.$k.'">';
                if(!in_array($value['type'], $non_id)){
                if(isset($connectives) && !empty($connectives) && isset($connectives[$key])){
                    $connective = $connectives[$key];
                    unset($connective[$value['form_id']]);

                    $options = array();
                    foreach ($connective as $co => $con) {
                        $options[$co] = $form_ids[$co];
                    }
                    $con_options = array(
                            'empty' => 'Select connective id',
                            'options' => $options,
                            'id' => 'connective_'.$k,
                            'element_id' => $k,
                            'step_id' => $key,
                            'class' => 'connective',
                            'label' => FALSE,
                            'div' => array(
                                'class' => 'control-group'
                            )
                        );
                    if($value['connective_element'] != ''){
                        $con_options['default'] = $value['connective_element'];
                        //var_dump($value);die;
                    }
                    echo '<div class="main_connective">';
                    echo $this->Form->input(
                        $form_ids[$value["form_id"]], $con_options
                    );
                    echo '</div><div class="child_connective child_connective_'.$k.'">';
                    if($value['connective_element'] != ''){
                        $child_connective_change[$value['connective_element']] = $k;
                        switch ($elements[$value['connective_element']]['type']) {
                            case 'select':
                                $child_options = $elements[$value['connective_element']]["choises"];
                            break;
                            case 'radiobatton':
                                $child_options = $elements[$value['connective_element']]["radio"];
                            break;
                            case 'checkbox':
                                $child_options = array(0 => 'No',1 => 'Yes');
                            break;
                        }
                        $child_con_options = array(
                            'empty' => 'Select connective id',
                            'options' => $child_options,
                            'id' => 'child_connective_'.$k,
                            'element_id' => $k,
                            'step_id' => $key,
                            'class' => 'child_connective',
                            'label' => FALSE,
                            'div' => array(
                                'class' => 'control-group'
                            )
                        );
                        if($value['connective_element_value'] != ''){

                            $child_con_options['default'] = $value['connective_element_value'];
                        }
                        echo $this->Form->input(
                            $form_ids[$value["form_id"]], $child_con_options
                        );
                    }
                    echo '</div>';
                }
                }
                echo '</div></div>';
                echo '</div></div>';
                $k++;
                echo '</div>'; 
                echo '</div>'; // accordion element
            }
                ?>
            </div>
        </div>
    <?php } ?>
    </div>
</div>
<input type="button" class="mBottom40 btn btn-success top10" value="Save" id="save">


<script type="text/javascript">
   
    
    var form = {};
    <?php if($form){ ?> 
        form = $.parseJSON('<?php echo json_encode($form); ?>');
        form = $.extend({}, form);
    <?php } ?>
    var choices = {};
    var name;
    var placeholder;
    var label;
    var required;
    var currentId;
    var form_ids = $.parseJSON('<?php echo json_encode($form_ids); ?>');
    var element;
    var allSteps = $.parseJSON('<?php echo json_encode($steps); ?>');
    var stepsIds = $.parseJSON('<?php echo json_encode($stepsIds); ?>');
    var connectives = $.parseJSON('<?php echo json_encode($connectives); ?>');
    var steps = Object.keys(allSteps).length;
    var currentStep = 0;
    if(steps){
        currentStep = first(allSteps);
    }
    var settings = '';
    var accordion_options = {
        
    };
    function first(obj) {
        for (var a in obj) return parseInt(a);
    }
    
$(function(){
    $.each(allSteps,function(k,val){
        collapsible: true,
        $( "#accordion_"+k ).accordion({
                autoHeight: false,
                collapsible: true,
                active:false,
                header: "> div > h3",
        }).sortable({
           axis: "y",
           handle: "h3",
            start: function() {

            },
            stop: function() {
                var ok = save(true);
                console.log(ok)
                
                console.log(text)
           }
       });
    });
    updateFormIds();
    $('#text').click(function(){
        element = 'text';
        checkElement();
    });
    $('#textarea').click(function(){
        element = 'textarea';
        checkElement();
    });
    $('#select').click(function(){
        element = 'select';
        checkElement();
    });
    $('#checkbox').click(function(){
        element = 'checkbox';
        checkElement();
    });
    $('#radiobatton').click(function(){
        element = 'radiobatton';
        checkElement();
    });
    $('#date').click(function(){
        element = 'date';
        checkElement();
    });
    $('#separator').click(function(){
        element = 'separator';
        checkElement();
    });
    $('#description').click(function(){
        element = 'description';
        checkElement();
    });
    $('#title').click(function(){
        element = 'title';
        checkElement();
    });
    function checkElement(){
        var form_id = parseInt($('#form_ids').val());
        if(form_id){
            if(currentStep){
                addElement(element);
                updateFormIds();
            }else{
                alert('Please select step');
            }
        }else{
            alert('Please select the form input name');
        }
    }
    $(document).on('change','.connective',function(){
        var id = $(this).attr('element_id');
        var step_id = $(this).attr('step_id');
        var val = $(this).val();
        console.log(val,id);
        if(val){
            $('.child_connective_'+id).html('');
            $('.child_connective_'+id).html('<select name="" id="child_connective_'+id+'" element_id="'+id+'" step_id="" class="child_connective"></select>');
            $.each(form, function(key, value) {
                if(value != undefined && value.step == currentStep && value.form_id == val){
                    if($.inArray( value.type, ['select','radiobatton','checkbox']) !== -1){
                        switch (value.type) {
                            case 'select':
                                options =  value.choises;
                            break;
                            case 'radiobatton':
                                options =  value.radio;
                            break;
                            case 'checkbox':
                                options = ['No','Yes'];
                            break;
                        }
                    }
                }
            });
            console.log(options);
            addConnective(options,id);
            $(document).on('change','#child_connective_'+id,function(){
                var value = $(this).val();
                if(value){
                    console.log(value);
                    form[id].connective_element_value = value;
                    form[id].connective_element = val;
                }else{
                    form[id].connective_element_value = '';
                    form[id].connective_element = '';
                }
            });
        }else{
            addConnective([],id);
            form[id].connective_element_value = '';
            form[id].connective_element = '';
        }
    });
    <?php
    foreach ($child_connective_change as $key => $value) { ?>
        $(document).on('change','#child_connective_<?php echo $value; ?>',function(){
            var value = $(this).val();
            console.log(value);
            form[<?php echo $value; ?>].connective_element_value = value;
            form[<?php echo $value; ?>].connective_element = <?php echo $key; ?>;
        });
    <?php } ?>
    function addConnective(options,el){
        var newOptions = {};
        $.each(options,function(i,val){
            if(val != undefined){
                newOptions[i] = val;
            }
        });
        var $el = $("#child_connective_"+el);
        
        $el
        .find('option')
        .remove()
        .end();
        $el.empty(); // remove old options
        $el.append("<option value=''>Select Connective</option>");
        $.each(newOptions, function(key, value) {
          $el.append($("<option></option>")
             .attr("value", key).text(value));
        });
    };
    $(document).on('click','.add',function(){
        var id = $(this).attr('element_id');
        var choice = $('#choice_value_'+id).val();
        if(choice != ''){
            var choiceId = form[id].choises.length;
            form[id].choises[choiceId] = choice;
            $('#choices_'+id).append('<div id="choice_'+choiceId+'" class="choice"><div class="choice_item">'+choice+'</div><div><span class="delChoice btn btn-small btn-danger" delId="'+choiceId+'" >Delete<\span>');
            updateSelect(id);
            $('#choice_value_'+id).val('');
            setSelectSettings(id)
        }
    });
    $(document).on('click','.add_radio',function(){
        var id = $(this).attr('element_id');
        var radio_value = $('#radio_value_'+id).val();
        var radio_name = $('#radio_name_'+id).val();
            if(radio_value != ''){
                var radioId = form[id].radio.length;
                form[id].radio[radioId] = radio_value;
                var selected = '';
                $('#radio_inputs_'+id).append('<div id="radio_'+radioId+'" class="choice"><div class="singleChoice"><div class="choice_item">'+radio_value+'</div><input type="radio"  '+selected+' element_id="'+id+'" class="for_radio_default default_'+id+'" name="default_'+id+'" value="'+radioId+'"></div><div class="delChoiceBox"><span class="delRadio btn btn-danger btn-small" delId="'+radioId+'" element_id="'+id+'" >Delete<\span>');
                updateRadio(id);
                $('#radio_value_'+id).val(''); 
            }
    });
    $(document).on('click','.for_radio_default',function(){
        var id = $(this).attr('element_id');
        form[id].default_value = $(this).val();
    });
    $(document).on('click','.for_select_default',function(){
        var id = $(this).attr('element_id');
        form[id].default_value = $(this).val();
    });
    $(document).on('click','#add_step',function(){
        $('#workarea').show();
        var highest = 0;

        $.each(stepsIds, function(key, article) {
            if (parseInt(key) > highest) highest = parseInt(key) ;
            //console.log(key)
        });
        var newStep = parseInt(highest)+1;//parseInt(Object.keys(stepsIds).sort().reverse()[0])+1;
        stepsIds[newStep] = newStep;
        currentStep = newStep;
        
        steps = steps+1;
        $('.active').removeClass('active');
        $('#steps').append('<li><a href="#step_'+newStep+'_area" stepId="'+newStep+'" class="step" id="step_'+newStep+'">Step '+newStep+'</a></li>');
        $('#tabs').append('<div class="step_area" id="step_'+newStep+'_area"><div class="stepHeader"><input type="text" class="step_name" step_id="'+newStep+'" value="Step'+newStep+'"><div class="toggleAccordion"><div class="open" step_id="'+newStep+'">Open all</div><div class="close" step_id="'+newStep+'">Close all</div></div><span delId="'+newStep+'" class="delStep btn btn-danger">Delete Step</span></div><div id="accordion_'+newStep+'" class=""> </div></div>');
        $('#accordion_'+currentStep).accordion(accordion_options)
        $( "#tabs" ).tabs();
        $("div#tabs").tabs("refresh");
        updateFormIds();
    });
    $('#save').click(function(){
        save();
    });
    $('.Label').live("keyup change", function(e) {
        var id = $(this).attr('element_id');
        $('#label'+id).html($(this).val());
        form[id].label = $(this).val();
    });

    $('.placeholder').live("keyup change", function(e) {
        var id = $(this).attr('element_id');
        $('#'+id).attr('placeholder',$(this).val());
        form[id].placeholder = $(this).val();
    });
    $('.input_type').live("keyup change", function(e) {
        var id = $(this).attr('element_id');
        //$('#'+id).attr('placeholder',$(this).val());
        form[id].input_type = $(this).val();
    });
    $('.description').live("keyup change", function(e) {
        var id = $(this).attr('element_id');
        $('#'+id).html($(this).val());
        form[id].description = $(this).val();
    });
    $('.title').live("keyup change", function(e) {
        var id = $(this).attr('element_id');
        $('#'+id).html($(this).val());
        form[id].title = $(this).val();
    });
    $('.help').live("keyup change", function(e) {
        var id = $(this).attr('element_id');
        $('#help_'+id).attr('title',$(this).val());
        form[id].help = $(this).val();
    });

    $('.max_length').live("keyup change", function(e) {
        var text = $(this).val();
        var valid = /^[0-9]+$/.test($(this).val());
        if(valid){
            var id = $(this).attr('element_id');
            $('#help_'+id).val($(this).val());
            form[id].max_length = parseInt($(this).val());
        }if(text && !valid){
            $('#max_length').val('');
            alert('please write number!');
        }
    }); 
    $('.default_value').live("keyup change", function(e) {
        var id = $(this).attr('element_id');
        form[id].default_value = $(this).val();
    });
    $('.default_text').live("keyup change", function(e) {
        var id = $(this).attr('element_id');
        form[id].default_text = $(this).val();
        updateSelect(id);
    });
    $('.step_name').live("keyup change", function(e) {
        var step_id = $(this).attr('step_id');
        stepsIds[step_id] = $(this).val();
        $('#step_'+step_id).html($(this).val());
    });
    $(document).on('click','.required',function(){
        var id = $(this).attr('element_id');
        //console.log($(this).is(":checked"),id);
        if($(this).is(":checked")) {
            form[id].required = true;
        }else{
            form[id].required = false;
        }
     });
    /*$(document).on('click','.element_content',function(){
        var id = $(this).attr('elementId');
        currentId = id;
        showSettings(id);
    });*/
    $(document).on('click','.delete',function(){
        var del = confirm("Are You sure!");
        if (del == false) {
            return false;
        }
        var id = $(this).attr('delId');
        delete form[id];
        //$('#h3_'+id).remove();
        //$('#div_'+id).remove();
        var parent = $('#div_'+id);
        var head = $('#h3_'+id);
        parent.add(head).fadeOut('slow',function(){$(this).remove();});
        //$(this).remove();
        //hideSettings();
        //updateFormIds();
        return false;
    });
    $(document).on('click','.delChoice',function(){
        var del = confirm("Are You sure!");
        if (del == false) {
            return false;
        }
        var element_id = $(this).attr('element_id');
        var id = $(this).attr('delId');
        console.log(element_id,id);
        delete form[element_id].choises[id];
        $('#choice_'+id).remove();
        $(this).remove();
        updateSelect(element_id);
    });
    $(document).on('click','.delRadio',function(){
        var del = confirm("Are You sure!");
        if (del == false) {
            return false;
        }
        var element_id = $(this).attr('element_id');
        var id = $(this).attr('delId');
        delete form[element_id].radio[id]
        $('#radio_'+id).remove();
        $(this).remove();
        updateRadio(element_id);
        
    }); 
    $(document).on('click','.delStep',function(){
        var del = confirm("Are You sure!");
        if (del == false) {
            return false;
        }
        var id = $(this).attr('delId');
        $.each(form,function(k,val){
            if(val != undefined){
               if(val.step == id){
                    delete form[k];
                }
            }
        });
        delete stepsIds[id];
        currentStep = 0;
        $('#step_'+id).remove();
        $('#step_'+id+'_area').remove();
        $(this).remove();
        
    }); 
    $(document).on('click','.step',function(){
        $('#step_'+currentStep).removeClass('active');
        
        currentStep = parseInt($(this).attr('stepId'));
        $('#step_'+currentStep).addClass('active');
        $('.active_area').removeClass('active_area');
        $('#step_'+currentStep+'_area').addClass('active_area');
    });
    $( "#tabs" ).tabs();
    
    $(document).on('click','.open',function(){
        var step_id = $(this).attr('step_id');
        $('#accordion_'+step_id+' .ui-accordion-header').removeClass('ui-corner-all').addClass('ui-accordion-header-active ui-state-active ui-corner-top').attr({'aria-selected':'true','tabindex':'0'});
        $('#accordion_'+step_id+' .ui-accordion-header .ui-icon').removeClass('ui-icon-triangle-1-e').addClass('ui-icon-triangle-1-s');
        $('#accordion_'+step_id+' .ui-accordion-content').addClass('ui-accordion-content-active').attr({'aria-expanded':'true','aria-hidden':'false'}).show();
    });
    $(document).on('click','.close',function(){
        var step_id = $(this).attr('step_id');
        $('#accordion_'+step_id+' .ui-accordion-header').removeClass('ui-accordion-header-active ui-state-active ui-corner-top').addClass('ui-corner-all').attr({'aria-selected':'false','tabindex':'-1'});
        $('#accordion_'+step_id+' .ui-accordion-header .ui-icon').removeClass('ui-icon-triangle-1-s').addClass('ui-icon-triangle-1-e');
        $('#accordion_'+step_id+' .ui-accordion-content').removeClass('ui-accordion-content-active').attr({'aria-expanded':'false','aria-hidden':'true'}).hide();
    });
});

function updateSelect(el){
    var newOptions = {};
    $.each(form[el].choises,function(i,val){
        if(val != undefined){
            newOptions[i] = val;
        }
    });
    var $el = $("#"+el);
    
    $el
    .find('option')
    .remove()
    .end()
    $el.empty(); // remove old options
    $("#"+el).append("<option value=''>"+form[el].default_text+"</option>");
    $.each(newOptions, function(key, value) {
      $el.append($("<option></option>")
         .attr("value", value).text(value));
    });
};
function updateRadio(el){
    var newOptions = {};
    //var radio_name = $('#radio_name').val();
    $('#radio_imouts'+el).html('');
    $.each(form[el].radio,function(i,val){
        if(val != undefined){
            newOptions[i] = val;
            $('#radio_imouts'+el).append('<div class="singleRadio"><input type="radio" name="'+form[el].name+'" value="'+val+'"><label>'+val+'</label></div>');
        }
    });

};
function setSelectSettings(el){
    $('#choices_'+el).html('');
    if($.isArray([form[el].choises])){
        if (typeof form[el].choises !== 'undefined' && form[el].choises.length > 0) {
            $.each(form[el].choises,function(i,val){
                if(val != undefined){
                    var selected = '';
                    if(form[el].default_value == i){
                        selected = 'checked="checked"';
                    }
                    $('#choices_'+el).append('<div id="choice_'+i+'" class="choice"><div class="singleChoice"><div class="choice_item">'+val+'</div><input type="radio"  '+selected+' element_id="'+el+'" class="for_select_default default_'+el+'" name="default_'+el+'" value="'+i+'"></div><div class="delChoiceBox"><span class="delChoice btn btn-danger btn-small" delId="'+i+'" element_id="'+el+'" >Delete<\span>');
                }
            });
        }
    }
};
function setRadioSettings(el){
    $('#radio_inputs').html('');
    if($.isArray([form[el].radio])){
        if (typeof form[el].radio !== 'undefined' && form[el].radio.length > 0) {
            $.each(form[el].radio,function(i,val){
               if(val != undefined){
                   $('#radio_inputs').append('<div id="radio_'+i+'" class="radio"><div class="radio_item">'+val+'</div><div><span class="delRadio btn btn-danger btn-small" delId="'+i+'" >Delete<\span>');
               }
            });
        }
    }
};
function showSettings(id,connective){
    if(id >=0){

        settings = $('#settings_templete').html();
        var settings = settings.replace(/\#/g, id);
        $('#settings_'+id).html(settings+connective).show();
        
        console.log(id)
        $('#help_area_'+id).hide();
        $('#radio_area_'+id).hide();
        $('#placeholder_area_'+id).hide();
        $('#max_length_area_'+id).hide();
        $('#label_area_'+id).hide();
        $('#default_value_area_'+id).hide();
        $('#default_text_area_'+id).hide();
        $('#description_area_'+id).hide();
        $('#title_area_'+id).hide();
        $('#required_area_'+id).hide();
        $('#input_type_'+id).hide();
        switch(form[id].type){
            case 'text':
                $('#placeholder_area_'+id).show();
                $('#label_area_'+id).show();
                $('#max_length_area_'+id).show();
                $('#default_value_area_'+id).show();
                $('#required_area_'+id).show();
                $('#input_type_'+id).show();
                $('#help_area_'+id).show();
                break;
            case 'textarea':
                $('#placeholder_area_'+id).show();
                $('#label_area_'+id).show();
                $('#max_length_area_'+id).show();
                $('#default_value_area_'+id).show();
                $('#required_area_'+id).show();
                $('#help_area_'+id).show();
                break;
            case 'select':
                select_settings = $('#select_settings').html();
                var select_settings = select_settings.replace(/\#/g, id);
                $('#label_area_'+id).show();
                $('#settings_'+id).html($('#settings_'+id).html()+select_settings).show();
                setSelectSettings(id);
                //$('#select_settings').show();  
                $('#default_text_area_'+id).show();
                $('#required_area_'+id).show();
                $('#help_area_'+id).show();
                break;
            case 'checkbox':
                $('#label_area_'+id).show();
                $('#help_area_'+id).show();
                break;
            case 'radiobatton':
                setRadioSettings(id);
                radio_settings = $('#radio_settings').html();
                var radio_settings = radio_settings.replace(/\#/g, id);
                $('#settings_'+id).html($('#settings_'+id).html()+radio_settings).show();
                $('#radio_area_'+id).show();
                $('#radio_settings_'+id).show();
                $('#label_area_'+id).show();
                $('#required_area_'+id).show();
                $('#help_area_'+id).show();
            break;
            case 'date':
                $('#placeholder_area_'+id).show();
                $('#label_area_'+id).show();
                $('#default_value_'+id).show();
                $('#required_area_'+id).show();
                $('#help_area_'+id).show();
            break;
            case 'separator':
                
            break; 
            case 'description':
                $('#description_area_'+id).show();
            break;
            case 'title':
                $('#title_area_'+id).show();
            break;
        }
 
    }else{
        $('#label').val('');
        $('#placeholder').val('');
        $('#required').attr('checked', false);
    }
}
function  hideSettings(){
    $('#settings').hide();
}
function reset(){
    $('#label').val('');
    $('#placeholder').val('');
    $('#required').attr('checked', false);
}

function addElement(element){
    var form_id = parseInt($('#form_ids').val());
    reset();

    var keys = [];

    $.each(form, function(key, article) {
        keys.push(key);

    });
    if(keys.length > 0){   
        currentId = parseInt(Math.max.apply(Math,keys))+1;
    }else{
        currentId = 1;
    }
    //alert(currentId);
    placeholder = '';
    required = false;
    var type;
    $('#help').val('');
    var help = '';
    var element_connectives = [];
    
    var connective = '<div class="connectives connectives_'+currentId+'"><div class="main_connective">'+
        '<div class="control-group">'+
            '<select name="" id="connective_'+currentId+'" element_id="'+currentId+'" step_id="'+currentStep+'" class="connective">'+
            '<option value="">Select connective id</option>';
            $.each(form, function(key, value) {
                if(value != undefined && value.step == currentStep){
                    if($.inArray( value.type, ['select','radiobatton','checkbox']) !== -1){
                        element_connectives[value.form_id] = form_ids[value.form_id];
                        connective+= '<option value="'+value.form_id+'">'+form_ids[value.form_id]+'</option>';
                    }
                }

            });
    connective+='</select></div><div class="child_connective child_connective_'+currentId+'"></div></div><div>';
    $('#accordion_'+currentStep).accordion('destroy')
    var ii = 0;
    $.each(form,function(k,val){
        if(val.step == currentStep){
            ii++;
        }
    });
    var accordion = '<div class="forms" formId="'+form_id+'" id="form_'+ii+'">';
    switch(element){
       case 'text':
            name = 'text'+ currentId;
            label = 'Input Text';
            type = 'text';
            $('#accordion_'+currentStep).append(accordion+'<h3 id="h3_'+currentId+'" class="blockName">'+element+' ('+form_ids[form_id]+')</h3><div id="div_'+currentId+'"><div class="element" id="area'+currentId+'"><div elementId="'+currentId+'" class="element_content span6"><label id="label'+currentId+'">'+label+'</label><div class="control-group"><input type="text" name="'+name+'" id="'+currentId+'" value=""></div><span class="help-area btn btn-default" id="help_'+currentId+'" rel="tooltip" title="">Help</span><span class="delete btn btn-danger" delId="'+currentId+'">Delete<span></div><div class="element_settings span5" id="settings_'+currentId+'"></div></div></div>');
           break;
       case 'textarea':
            name = 'textarea'+ currentId;
            label = 'Textarea';
            type = 'textarea';
            $('#accordion_'+currentStep).append(accordion+'<h3 id="h3_'+currentId+'" class="blockName">'+element+' ('+form_ids[form_id]+')</h3><div id="div_'+currentId+'"><div class="element" id="area'+currentId+'"><div elementId="'+currentId+'" class="element_content span6"><label id="label'+currentId+'">'+label+'</label><div class="control-group"><textarea name="'+name+'" id="'+currentId+'" cols="30" rows="6"></textarea></div><span class="help-area  btn btn-default" id="help_'+currentId+'" rel="tooltip" title="">help</span><span class="delete btn btn-danger" delId="'+currentId+'">Delete<span></div><div class="element_settings span5" id="settings_'+currentId+'"></div></div></div>');
           break;
       case 'select':
            name = 'select'+ currentId;
            label = '';
            type = 'select';
            $('#accordion_'+currentStep).append(accordion+'<h3 id="h3_'+currentId+'" class="blockName">'+element+' ('+form_ids[form_id]+')</h3><div id="div_'+currentId+'"><div class="element" id="area'+currentId+'"><div elementId="'+currentId+'" class="element_content span6"><label id="label'+currentId+'">'+label+'</label><div class="control-group"><select name="'+name+'" id="'+currentId+'"><option value="0" selected="1">select</option></select></div><span class="help-area btn btn-default" id="help_'+currentId+'" rel="tooltip" title="">Help</span><span class="delete btn btn-danger" delId="'+currentId+'">Delete<span></div><div class="element_settings span5" id="settings_'+currentId+'"></div></div></div></div>');
            $(document).on('click',".default_"+currentId,function(){
                var value = $(this).val();
                form[currentId].default_value = value;
            });
           break;
       case 'checkbox':
            name = 'checkbox'+ currentId;
            label = '';
            type = 'checkbox';
            $('#accordion_'+currentStep).append(accordion+'<h3 id="h3_'+currentId+'" class="blockName">'+element+' ('+form_ids[form_id]+')</h3><div id="div_'+currentId+'"><div class="element" id="area'+currentId+'"><div elementId="'+currentId+'" class="element_content span6"><label id="label'+currentId+'">'+label+'</label><div class="control-group"><input type="checkbox" name="'+name+'" id="'+currentId+'" value=""></div><span class="help-area  btn btn-default" id="help_'+currentId+'" rel="tooltip" title="">Help</span><span class="delete btn btn-danger" delId="'+currentId+'">Delete<span></div><div class="element_settings span5" id="settings_'+currentId+'"></div></div></div>');
           break;
       case 'radiobatton':
            name = 'radiobatton'+ currentId;
            label = '';
            type = 'radiobatton';
            $('#accordion_'+currentStep).append(accordion+'<h3 id="h3_'+currentId+'" class="blockName">'+element+' ('+form_ids[form_id]+')</h3><div id="div_'+currentId+'"><div class="element" id="area'+currentId+'"><div elementId="'+currentId+'" class="element_content span6"><label id="label'+currentId+'">'+label+'</label><div class="control-group"><div id="radio_imouts'+currentId+'"></div></div><span class="help-area btn btn-default" id="help_'+currentId+'" rel="tooltip" title="">Help</span><span class="delete btn btn-danger" delId="'+currentId+'">Delete<span></div><div class="element_settings span5" id="settings_'+currentId+'"></div></div></div>');
           break;
        case 'date':
            name = 'date'+ currentId;
            label = 'Input date';
            type = 'date';
            $('#accordion_'+currentStep).append(accordion+'<h3 id="h3_'+currentId+'" class="blockName">'+element+' ('+form_ids[form_id]+')</h3><div id="div_'+currentId+'"><div class="element" id="area'+currentId+'"><div elementId="'+currentId+'" class="element_content span6"><label id="label'+currentId+'">'+label+'</label><div class="control-group"><input type="text" name="'+name+'" id="'+currentId+'" value=""></div ><span class="help-area btn btn-default" id="help_'+currentId+'" rel="tooltip" title="">Help</span><span class="delete btn btn-danger" delId="'+currentId+'">Delete<span></div><div class="element_settings span5" id="settings_'+currentId+'"></div></div></div>');
           break;
        case 'description':
            name = 'description'+ currentId;
            label = '';
            type = 'description';
            form_id = '';
            connective = '';
            $('#accordion_'+currentStep).append(accordion+'<h3 id="h3_'+currentId+'" class="blockName">'+element+'</h3><div id="div_'+currentId+'"><div class="element" id="area'+currentId+'"><div elementId="'+currentId+'" class="element_content span6"><div class="control-group"><p id="'+currentId+'">Please type description</p></div ><span class="delete btn btn-danger" delId="'+currentId+'">Delete<span></div><div class="element_settings span5" id="settings_'+currentId+'"></div></div></div>');
           break;
        case 'title':
            name = 'title'+ currentId;
            label = '';
            type = 'title';
            form_id = '';
            connective = '';
            $('#accordion_'+currentStep).append(accordion+'<h3 id="h3_'+currentId+'" class="blockName">'+element+'</h3><div id="div_'+currentId+'"><div class="element" id="area'+currentId+'"><div elementId="'+currentId+'" class="element_content span6"><div class="control-group"><h3 id="'+currentId+'">Please type title</h3></div ><span class="delete btn btn-danger" delId="'+currentId+'">Delete<span></div><div class="element_settings span5" id="settings_'+currentId+'"></div></div></div>');
           break;
        case 'separator':
            name = 'separator'+ currentId;
            label = '';
            type = 'separator';
            form_id = '';
            connective = '';
            $('#accordion_'+currentStep).append(accordion+'<h3 id="h3_'+currentId+'" class="blockName">'+element+'</h3><div id="div_'+currentId+'" ><div class="element" id="area'+currentId+'"><div>'+element+'</div><div elementId="'+currentId+'" class="element_content span6"><div class="control-group"><hr type="text" name="'+name+'" id="'+currentId+'"></div ><span class="delete btn btn-danger" delId="'+currentId+'">Delete<span></div></div></div>');
           break;
    }
    $('#accordion_'+currentStep).append('</div>');
//    $('#accordion_'+currentStep).accordion(accordion_options)
    
    $( "#accordion_"+currentStep ).accordion({
        autoHeight: false,
        collapsible: true,
        active:false,
        header: "> div > h3",
    }).sortable({
       axis: "y",
       handle: "h3",
       start: function() {
        
       },
       stop: function() {
            var ok = save(true);
       }
   });
    
    form[currentId] = {step:currentStep,type:type,name:name,placeholder:placeholder,label:label,required:required,help:help,form_id:form_id,choises:[],radio:[],max_length:'',default_value:'',default_text:'default_text',connective_element:'',connective_element_value:'',description:'Please type description',title:'Please type title',input_type:''}

    showSettings(currentId,connective);
    updateFormIds();
    $('#label').val(label);
}
function updateFormIds(){
    var newOptions = {};
    var usedIds = [];
    $.each(form, function(key, value) {
        console.log(value)
        if(value != undefined)
        usedIds[value.form_id] = value.form_id;
    });
    
    $.each(form_ids, function(k, val) {
        if (!usedIds.hasOwnProperty(k)) {
            newOptions[k] = val;
        }
    });
    var $el = $("#form_ids");
    $el
    .find('option')
    .remove()
    .end()
    $el.empty(); // remove old options
    $el.append('<option value="">Select The form id</option>');
    $.each(newOptions, function(key, value) {
      $el.append($("<option></option>")
         .attr("value", key).text(value));
    });
    //console.log('updated');
}
function save(param){
    $.ajax({
        url  : '/admins/save_form',
        type : 'POST',
        dataType: "json",
        data : {
            id : parseInt('<?php echo $contract['id']; ?>'),
            form:form,
            stepsIds:stepsIds
        },
        success : function(data){
            console.log(param)
            console.log(data.status)
            if(param){
                reorder();
            }
            if(data.status == true){
                alert('Successfully saved!');
            }else{
                if(data.message){
                    alert(data.message)
                }else{
                    alert('some error occured!');
                }
            }
        }
    });
}
function reorder(){
    var i = 0;
    var forms = [];
    while($("#accordion_"+currentStep+" #form_"+i).text()){
        //console.log($("#accordion_"+currentStep+" #accordion_.forms:eq("+i+")").html())
        forms[i] = $("#accordion_"+currentStep+" .forms:eq("+i+")").attr('formid');
        i++;
    }
    $.ajax({
        url  : '/admins/reorder_form',
        type : 'POST',
        dataType: "json",
        data : {
            forms : forms,
            stepId: currentStep,
            contract_id: <?php echo $contract['id'] ?>
        },
        success : function(data){
            console.log(data)
            if(data.status == true){
                //alert('Successfully reordered!');
            }else{
                if(data.response){
                    alert(data.response)
                }else{
                    alert('some error occured!');
                }
            }
        }
    });
}
</script>


<div id="settings_templete" style="display:none">
    <h4>Settings</h4>
    <div id="help_area_#">
        <label>help</label>
        <input type="text" name="help" element_id="#" class="help" placeholder="help" id="helpinput_#" value="">
    </div>
    <div id="label_area_#">
        <label>label</label>
        <input type="text" name="label" element_id="#" class="Label" placeholder="label" id="label_#" value="">
    </div>
    <div id="placeholder_area_#">
        <label>placeholder</label>
        <input type="text" name="placeholder" element_id="#" class="placeholder" placeholder="placeholder" id="placeholder_#" value="">
    </div>
    <div id="description_area_#">
        <label>description</label>
        <textarea type="text" name="description" element_id="#" class="description" placeholder="description" id="description_#">Please type description</textarea>
    </div>
    <div id="title_area_#">
        <label>title</label>
        <textarea type="text" name="title" element_id="#" class="title" placeholder="title" id="title_#">Please type title</textarea>
    </div>
    <div id="max_length_area_#">
        <label>max length</label>
        <input type="number" name="max_length" element_id="#" class="max_length" placeholder="max length" id="max_length_#" value="">
    </div>
    <div id="default_value_area_#">
        <label>Default value</label>
        <input type="text" name="default_value" element_id="#" class="default_value" placeholder="default value" id="default_value_#" value="">
    </div>
    <div id="required_area_#">
        <label>Required</label>
        <input type="checkbox" name="checkbox[]" element_id="#" class="required" id="required_#" value="Required">
    </div>
    <div id="input_type_#">
        <select element_id="#" class="input_type" id="input_type_#">
            <option val="">Select input type</option>
            <option val="numeric">numeric</option>
            <option val="email">email</option>
            <option val="text">text</option>
        </select>
    </div>
</div>

<div id="select_settings"  style="display:none">
    <div>
        <label>default text</label>
        <input type="text" name="default_text" element_id="#" class="default_text " id="default_text_#" value="default_text">
    </div>
    <div>
        <label>choice</label>
        <input type="text" element_id="#" name="choice" id="choice_value_#" value="choice">
    </div>
    <input type="button" element_id="#" name="add" class="add btn btn-success" value="Add">
    <div id="choices_#" class="top10"></div>
</div>
<div id="radio_settings" class="radioSet"  style="display:none">
    <div class="overHidden left95">
        <input type="text" name="value" id="radio_value_#" value="">
        <input type="button" element_id="#" name="add-radio" value="Add" id="add_radio_#"  class="btn btn-success add_radio"> 
    </div>
    <div class="clearfix"></div>
    <div id="radio_inputs_#" element_id="#" class="allRadioInputs top20"></div>
</div>