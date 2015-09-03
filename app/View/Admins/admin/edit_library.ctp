<?php
echo $this->Html->script('fineuploader-4.0.3.min');
echo $this->Html->script('jquery.cropzoom');
echo $this->Html->css('fineuploader-4.0.3.min');
?>
<div class="top50 span5 margauto">
        <h3 class="text-center" >Edit Library</h3>
        <hr class="separator">
        <?php
        echo $this->Form->create(
                'Librarie', array(
                    'inputDefaults' => array(
                        'label' => false,
                        'div' => false
                    ),
                'class' => 'form form-horizontal addLibForm',
                'enctype'=>"multipart/form-data"   
                )
        );
        ?>
        <div class="control-group">
            <label class="control-label" >Library Title</label>
            <div class="controls">
            <?php
            echo $this->Form->input(
                    'title', array(
                        'type' => 'text',
                        'div' => false,
                        'placeholder' => 'Library title'
                    )
            );
            ?>
        </div>
        </div>
        <div class="control-group navFieldset">
            <label class="control-label" >Active</label>
            <div class="controls top5">
            <?php
                $options=array('1'=>'<span>active</span>','0'=>'<span>inactive</span>');
                echo $this->Form->radio('active',$options,array('label' => false));
            ?>   
        </div>     
        </div>     
        <div class="control-group">
            <label class="control-label" for="exampleInputFile">Attached files</label>            
            <div class="controls">
            <div id="profPic"></div>
            <?php
            echo $this->Form->input('lib_file', array(
                "type" => "hidden",
                "value" => "",
                "id" => "attachedFile"
            ));
            ?>
        </div>
        </div>
       <div class="controls btnSection">
            <?php
                echo $this->Form->input(
                    'Save', array(
                        'type' => 'submit',
                        'label' => false, 
                        'div' => false,
                        'class' => 'btn btn-success'
                    )
                );
                echo $this->Html->link('Cancel',array('controller'=>'admins','action'=>'law_library'),array('class'=>'btn'));
              ?>
      </div>
      <?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
    var imageArray = [];
    
    (function(){
        var folder_name = "library";
        var thumbnailuploader = new qq.FineUploader({
            element: document.getElementById("profPic"),
            template: "simple-previews-template",
            request: {
                endpoint: '/image/imageUpload',
                params: {
                    path: '<?php echo APP_DIR . ',' . WEBROOT_DIR . ',' . 'system' . ',' . 'library'; ?>'
                }
            },
            // optional feature
            validation: {
                allowedExtensions: ['pdf', 'docx' ,'doc'],
                itemLimit: 2
            },
            callbacks: {
                onComplete: function(id, fileName, responseJSON){                
                    $('.newImg').remove();
                    if(responseJSON.success){
                        imageArray.push(responseJSON.file);
                        $('#attachedFile').val(imageArray.join());
//                        $('.qq-upload-success').prepend('<img src="/img/file_icons/' + responseJSON.file.split('.').pop().toLowerCase() + '.png" />');
                    }else{
                        alert('error')
                    }
                }
            }
        });
    }());   
  
</script>