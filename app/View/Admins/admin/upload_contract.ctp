<label class="pull-left">ADD CONTRACT</label>
<div class="uploadBtn pull-left">
    <div id='txt-file-uploader'></div>
</div>
<script type="text/javascript">

$(document).ready(function() {
    var action = '/fishings/uploadManulFile/'+id+'/file';
            console.log(action)
            var uploader = new qq.FileUploader({
                element: document.getElementById('txt-file-uploader'),
                'action': action,
                'debug': false,
                multiple: false,
                sizeLimit: 2 * 1024 * 1024, // max size   
                minSizeLimit: 0, // min size
                allowedExtensions: ['doc', 'docx', 'pdf'],
                onSubmit: function(id, fileName) {
                    //$('#load').html('<img src="/img/loading.gif" style="margin-left:109px;margin-top:-34px;position:absolute;"/>')
                },
                onProgress: function(id, fileName, responseJSON) {
                },
                onComplete: function(id, fileName, responseJSON) {
                    if (responseJSON.success == true) {
                        var makeTemplate =
                                '<li class="text-center img_area_' + responseJSON.photoId + '">' +
                                '<div class="control-group fileupload-new thumbnail pull-left">' +
                                '<a target="blank" href="/files/fishing/' + responseJSON.fileName + '" class="file btn" >Download File</a>' +
                                '</div>' +
                                '<a href="" class="delFile pull-left" delId="' + responseJSON.photoId + '"></a>' +
                                '</li>';
                        $('#newUploadedFiles').append(makeTemplate);
                        $('.qq-upload-list').remove();

                    } else {
                        console.log(responseJSON.message)
                        $.jGrowl(responseJSON.message, {position: 'center'});
                        $('#load').empty();
                        $('.qq-upload-list').remove();
                    }
                },
                onCancel: function(id, fileName) {
                    $('.qq-upload-button').removeClass('.qq-upload-button-visited')
                },
                messages: {
                    sizeError: "Please upload images not bigger than 2MB",
                    typeError: "File Not Permitted! It should have .doc, .docx or .pdf extensions.",
                },
                showMessage: function(message) {
                    $.jGrowl(message, {theme: 'jGrowlError'});
                }
            });
            });
            
</script>