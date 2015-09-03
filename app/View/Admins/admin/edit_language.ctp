<div class="regform span5 margauto">
    <h3 class="text-center">Edit language</h3>
    <hr class="separator">
    <?php
        echo $this->Form->create('Language',array('class' => 'form-horizontal'));
    ?>
    <div class="control-group">
            <label class="control-label">Language</label>
            <?php
            include_once APP."Vendor/languages.php";
            echo $this->Form->input(
                'lang_code', array(
                    'type' => 'select',                
                    'label' => false,
                    'options'=>$language_options,        
                    'required' => true,  
                    'id'=>'languages',
                ));
            ?>
        </div> 
        <div class="control-group">
            <label class="control-label">Code</label>
            <?php
                echo $this->Form->input('name', array('type'=>'hidden','id'=>'name'));
                echo $this->Form->input('lang_code' ,array('type'=>'text','id'=>'code','DISABLED' ,'label'=>FALSE));
            ?>
        </div>
        <div class="control-group">
            <label class="control-label"></label>
            <?php
                echo $this->Form->input('active',array('type'=>'checkbox',));
            ?>
        </div>
        <div class="control-group btnSection">  
        <label class="control-label"></label>
            <div class="controls">
                <?php
                echo $this->Form->submit(
                        'Save', array(
                    'label' => false,
                    'div' => FALSE,
                    'class' => 'btn btn-inverse'
                        )
                );
                ?>
                <?php echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'languages'), array('class' => 'btn'));?>
            </div>
        </div>
</div>
<script type="text/javascript">
    $( "#languages" ).change(function() {
        var text = $( this ).val();
        $( "#code" ).val( text );
    });
    $( "#languages" ).change(function() {
        var text = $('option:selected').text();
        $( "#name" ).val( text );
    });
</script>