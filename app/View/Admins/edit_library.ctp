<div class="span5 ">
    <h3 class="text-center">Edit Library</h3>
    <hr class="separator">
    
    <div class="control-group">
        <label class="control-label"></label>
        <?php
            if(isset($error)){
                echo $error;
            }
        ?>
    </div>
    
    <?php
    echo $this->Form->Create(
            'Library', array(
                'inputDefaults' => array(
                    'label' => array('class' => 'control-label'),
                    'div' => array('class' => 'controls')),
                'class' => 'form-horizontal'
            )
    );
    ?>

    <div class="control-group">
        <label class="control-label">Title</label>
        <?php
        echo $this->Form->input(
                'title', array(
                    'type' => 'text',
                    'label' => FALSE,
                    'error' => false,        
                    'placeholder' => "Title"
                )
        );
        ?>
    </div>

     <div class="control-group">
        <div id="pdf-file-uploader">Upload Library</div>
        <?php
        echo $this->Form->input(
                'filename', array(
                    'type' => 'hidden',
                    'id' => 'pdf',
                )
        );
    ?>
    </div>
    <div>
        <a href="" id="file"  target="_blank"/></a>
    </div>
    
    <div class="control-group btnSection">
        <label class="control-label"></label>
        <div class="controls">
        <?php
        echo $this->Form->submit(
            'Edit', array(
                'label' => false,
                'div' => FALSE,
                'class' => 'btn btn-success'
            )
        );
        ?>
        <?php echo $this->Html->link('Cancel', array('controller' => 'admons', 'action' => 'sliders'), array('class' => 'btn'));
        ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    var WIDTH,HEIGHT,tmpFileName;
    $(document).ready(function(){
         var uploader = new qq.FileUploader({
            element: document.getElementById("pdf-file-uploader"),
            'action': '/admins/uploadPdfPhoto',
             params: {
                'folder': 'libraries',
            },
            'debug': false,
            multiple: false,
            sizeLimit: 10 * 1024 * 1024, // max size   
            minSizeLimit: 0, // min size
            allowedExtensions: ['pdf'],
            onSubmit: function(id, fileName){
                //$('#load').html('<img src="/img/loading.gif" style="margin-left:109px;margin-top:-34px;position:absolute;"/>')
            },
            onProgress: function(id, fileName, responseJSON){
            },
            onComplete: function(id, fileName, responseJSON){
                console.log(responseJSON);
                if(responseJSON.success == true){
                    $('#pdf').val(responseJSON.fileName);
                    $('#file').attr('href','/system/libraries/'+responseJSON.fileName).html('View Attached File');
                    $('.qq-upload-list').remove();
                }else{
                    $('#load').empty();
                    $('.qq-upload-list').remove();
                }
            },
            onCancel: function(id, fileName){$('.qq-upload-button').removeClass('.qq-upload-button-visited')},
            messages: {
                sizeError: "Please upload images not bigger than 2MB",
                typeError: "File Not Permitted,!",
            },
            showMessage: function(message){
                $.jGrowl(message,{theme: 'jGrowlError'});
            }
        });
        
    });
</script>