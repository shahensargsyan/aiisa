<?php
echo $this->Html->script('fileuploader');
echo $this->Html->script('crop');
echo $this->Html->css('crop');

if($this->request->data):
    $profile_picture 	= ($user['User']['profile_picture']!='')?'../profileimg/'.$user['User']['profile_picture']:'../profileimg/guest_avatar.jpg';
    $email 				= $this->request->data['User']['email'];
    $username 			= ($user['User']['username']!='')?$user['User']['username']:'';
    $first_name 		= $this->request->data['User']['first_name'];
    //$last_name 			= $this->request->data['User']['last_name'];
    $gender 			= $this->request->data['User']['gender'];

    $location_coordinates = $this->request->data['User']['location_coordinates'];
    //$street_address 	= $this->request->data['User']['street_address'];
    $city 				= $this->request->data['User']['city'];
    $state 				= $this->request->data['User']['state'];
    //$zip_code 			= $this->request->data['User']['zip_code'];
    $country 			= $this->request->data['User']['country'];
    $date_of_birth		= $this->request->data['User']['year'].'-'.$this->request->data['User']['month'].'-'.$this->request->data['User']['day'];
else:
    $email 					= ($user['User']['email']!='') ? $user['User']['email']:'';
    $username 				= ($user['User']['username']!='')?$user['User']['username']:'';
    $first_name 			= ($user['User']['first_name']!='')?$user['User']['first_name']:'';
    //$last_name 				= ($user['User']['last_name']!='')?$user['User']['last_name']:'';
    $profile_picture 		= ($user['User']['profile_picture']!='')?'../profileimg/'.$user['User']['profile_picture']:'../profileimg/guest_avatar.jpg';
    $gender 				= ($user['User']['gender']!='')?$user['User']['gender']:'';
    $date_of_birth 			= ($user['User']['date_of_birth']!='')?$user['User']['date_of_birth']:'';
    $location_coordinates 	= ($user['User']['location_coordinates']!='')?$user['User']['location_coordinates']:'';
    //$street_address 		= ($user['User']['street_address']!='')?$user['User']['street_address']:'';
    $city 					= ($user['User']['city']!='')?$user['User']['city']:'';
    $state 					= ($user['User']['state']!='')?$user['User']['state']:'';
    //$zip_code 				= ($user['User']['zip_code']!='')?$user['User']['zip_code']:'';
        $country 				= ($user['User']['country']!='')?$user['User']['country']:'';
endif;
?>
<div id="banner">
    <div id="taglines">
        <h2 class="taglineTop">Meditate With Others Around the Globe.</h2>
        <h3 class="taglineBot">Using Our Free Meditiaton Timer</h3>
    </div>
    <div class="popup dashboardPopup" id="pp">
        <?php echo $this->element('account_menu'); ?> 

        <div id="popup_right">
            
            <div class="popupHeader">
                <h2 class="popupH">My Profile</h2>
                <div class="sepAU"></div>
                <button class="cls_button">X</button>
            </div>
            <div id="dashContent">
                <?php echo $this->Form->create('User', array('action' => 'editprofile','type' => 'file')); ?>
                    <div id="mTop">
                        <div id="pAvatar">
                            <?php echo $this->Html->image($profile_picture, array('id' => 'profile_picture','width'=>'227','height'=>'227')); ?>
                            <div class="page_container">
                                <div class="control-group">
                                   

                                    <div class="example" style="display:none">
                                        <div class="default">
                                            <div class="cropMain"></div>
                                            <div class="cropSlider"></div>
                                            <button class="white_btn mBtn">Crop and Save</button>
                                        </div>
                                    </div>
                                </div>
<!--                                <div>
                                    <img src="<?php echo $profile_picture; ?>" id="imgrounded" />
                                </div>-->
                            </div>
                            <div class="mFileButton">
                                <!--<a href="/users/changeAvatar" class="chsFileBtn outline_btn">Change Avatar</a>-->
                                    <div id="file-uploader" class="chsFileBtn outline_btn">Photo</div>
                                    <div id="cont" class="uploadedImg"></div>             
                                <?php //echo $this->Form->file('File',array('label' => false,'class' => 'chsFileBtn outline_btn', 'id' => 'uploaded_img')); ?>
                               
                            </div>
                        </div>
                        <div id="pUsernameEmail">
                            <label>Email Address:</label>
                            <!--<input type="text" class="mInput profileInput">-->
                            <?php echo $this->Form->input('email', array('value'=>$email,'class'=>'mInput profileInput','label' => false)); ?>
                            <label>Password:</label>
                            <!--<input type="text" class="mInput profileInput">-->
                            <?php echo $this->Form->input('password', array('type' => 'password','value'=>'','class'=>'mInput profileInput','label' => false)); ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="mMiddle">
                        <div class="leftControls dashControlWrapL">

                            <label>Name:</label>
                            <!--<input type="text" class="login">-->
                            <?php echo $this->Form->input('first_name', array('value'=>$first_name,'class'=>'login', 'label' => false)); ?>
                            <?php
                                    $brkDate =array();
                                    if(!empty($date_of_birth)):
                                            $brkDate  =  explode('-',$date_of_birth);
                                            $brkMonth = ($brkDate != '')?$brkDate[1]:0000;
                                            $brkDay   = ($brkDate != '')?$brkDate[2]:0000;
                                            $brkYear  = ($brkDate != '')?$brkDate[0]:0000;
                                    else:
                                            $brkMonth = '00';
                                            $brkDay   = '00';
                                            $brkYear  = '0000';
                                    endif;
//                                    echo $this->Form->input('year',array('type'=>'select','options'=>$year,'label'=>false,'style'=>'margin-left:0px;','default' => $brkYear)); 
//                                    echo $this->Form->input('month',array('type'=>'select','options'=>$month,'label'=>false,'default' => $brkMonth)); 
//                                    echo $this->Form->input('day',array('type'=>'select','options'=>$day,'label'=>false,'default' => $brkDay)); 
//                                    echo $this->Form->input('date_of_birth', array('label' => false,'maxlength' => '200', 'div' => false, 'id' => 'date_of_birth', 'type' => 'hidden','placeholder' => "GG-MM-AAAA",'value'=>$date_of_birth)); 
//                                    echo $this->Form->error('date_of_birth');
                            ?>
                            <label>Age:</label>
                            <div class="DateSelect">
                                <div class="YearSelect">
                                    <?php echo $this->Form->input('year',array('type'=>'select','options'=>$year,'label'=>false,'class'=>'sel selRegister','default' => $brkYear)); ?>
                                </div>
                                <div class="YearSelect">
                                    <?php echo $this->Form->input('month',array('type'=>'select','options'=>$month,'label'=>false,'class'=>'sel selRegister','default' => $brkMonth)); ?>
                                </div>
                                <div class="YearSelect">
                                    <?php echo $this->Form->input('day',array('type'=>'select','options'=>$day,'label'=>false,'class'=>'sel selRegister','default' => $brkDay));  ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="rightControls dashControlWrapR ">
                            <label>Gender:</label>
                            <div class="genderRadios gRadios">
                                 <div class="genderRadios">
                                    <div class="genderRadio">
                                        <!--<input type="radio" id="ownHomeYes" name="ownHome" value="Yes">-->
                                        <?php 
                                        $options = array('M' => '');
                                        $attributes = array('hiddenField' => false,'value' => "",'id' => "Male",'legend' => false, 'label' => false,'div' => FALSE);
                                        if($user['User']['gender'] == 'M'){
                                            $attributes['checked'] = 'checked';
                                        }
                                        echo $this->Form->radio('gender', $options, $attributes); 
                                        ?>
                                        <label for="MaleM"><span></span>Male</label>
                                    </div>
                                    <div class="genderRadio">
                                        <!--<input type="radio" id="ownHomeNo" name="ownHome">-->
                                        <?php
                                        $options = array('F' => '');
                                        $attributes = array('hiddenField' => false,'value' => "",'id' => "Female",'legend' => false, 'label' => false,'div' => FALSE);
                                        if($user['User']['gender'] == 'F'){
                                            $attributes['checked'] = 'checked';
                                        }
                                        echo $this->Form->radio('gender', $options, $attributes); 
                                        ?>
                                        <label for="FemaleF"><span></span>Female</label>
                                        <br>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php 
				//$options = array('M' => 'Male', 'F' => 'Female');
				//$attributes = array('legend' => false, 'value' => $gender,'id' => "ownHomeYes");
				 ?>
<!--                                <div class="genderRadio">
                                    <?php 
                                    echo $this->Form->input('gender', array(
                                            'type' => 'radio',
                                            'id' => 'ownHomeYes',
                                            'name' => 'gender',
                                            'div' => false,
                                            'label' => false,
                                            'hiddenField' => false,
                                            'options' => array('M' => 'Male'),
                                    )); ?>
                                    <input type="radio" id="ownHomeYes" name="ownHome" value="Yes">
                                    <label for="ownHomeYes"><span></span>Male</label>
                                    
                                    <input type="radio" id="ownHomeNo" name="ownHome">
                                    <label for="ownHomeNo"><span></span>Female</label>
                                    <br>
                                </div>-->
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="sepAU"></div>

                        <div id="mLocation">
                            <h3 class="subhead">Location</h3>
                            <p class="lDescription"> ( Note: 1.Zoom your location on map. 2.Right click on your locatoin for marker. 3.Drag marker to your location. )</p>
                           
                                
                            <?php if(!empty($location_coordinates)):?>
                            <script type="text/javascript"> 
                                $(document).ready(function(){
                                    function initialize2() {
                                            //var latLng = new google.maps.LatLng(33.431441,9.477537);
                                            var latLng = new google.maps.LatLng(<?php echo $location_coordinates; ?>);
                                            var map = new google.maps.Map(document.getElementById('mapCanvas'), {
                                                    zoom: 12,
                                                    center: latLng,
                                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                            });
                                            placeMarker(latLng, newmarker);
                                            google.maps.event.addListener(map, "rightclick", function(event) {
                                                    if(markers==''){
                                                            var newmarker;
                                                    } else {
                                                            var newmarker = markers;
                                                    }
                                                    placeMarker(event.latLng, newmarker);
                                            });

                                            function placeMarker(location, newmarker) {
                                                    if (newmarker) {
                                                            //if marker already was created change positon
                                                            newmarker.setPosition(location);
                                                    } else {
                                                            //create a marker
                                                            newmarker = new google.maps.Marker({
                                                                    position: location,
                                                                    map: map,
                                                                    draggable: true
                                                            });
                                                    }
                                                    markers = newmarker;
                                                    var lat2 = newmarker.position.lat();
                                                    var lng2 = newmarker.position.lng();
                                                    var latLng2 = new google.maps.LatLng(lat2,lng2);
                                                    geocodePosition(newmarker.getPosition(latLng2));

                                                    google.maps.event.addListener(newmarker, 'click', function() {});
                                                    google.maps.event.addListener(newmarker, 'dragend', function() {
                                                            geocodePosition(newmarker.getPosition());
                                                    });
                                            }
                                    }
                                    //Onload handler to fire off the app.
                                    google.maps.event.addDomListener(window, 'load', initialize2);
                                })
                            </script>
                            <?php else:?>
                            <script type="text/javascript">
                                    //Onload handler to fire off the app.
                                    google.maps.event.addDomListener(window, 'load', initialize);
                            </script>
                            <?php endif;?>
                        
                         <div  class="mapDash">
                            <div id="mapCanvas" style="height:400px; border:1px solid #333333; margin:10px 0px;"></div>
		
                            </div>
                        </div>

                        <div class="sepAU"></div>

                        <div id="mBottom">
                            <div class="leftControls dashControlWrapL">
                                <label>City:</label>
                                <?php echo $this->Form->input('city', array('value'=>$city, 'label' => false,'class'=>'login','id'=>'city')); ?>
                                <label>Location Coordinates:</label>
                                <?php echo $this->Form->input('location_coordinates', array('value'=>$location_coordinates, 'class'=>'login','label' => false,'id'=>'location_coordinates','readonly'=>'readonly')); ?>
                            </div>

                            <div class="rightControls dashControlWrapR">
                                <label>State:</label>
                               <?php echo $this->Form->input('state', array('value'=>$state, 'label' => false,'class'=>'login','id'=>'state')); ?>
                                <label>Country:</label>
                               <?php echo $this->Form->input('country', array('value'=>$country, 'label' => false,'class'=>'login','id'=>'country','readonly'=>'readonly')); ?>

                            </div>

                            <div class="clearfix"></div>
                        </div>



                        <div id="mButtons">
<!--                            <a href="#" class="white_btn mBtn">EDIT PROFILE</a>
                            <a href="#" class="outline_btn mBtn">CANCEL</a>-->
		<?php echo $this->Html->link($this->Form->input('Edit Profile', array('formnovalidate' => true,'div'=>false,'label' => false, 'type'=>'button', 'class'=>'white_btn mBtn', 'id' =>'saveProfile')),'/users/editprofile', array('escape'=>false));?>
                <?php echo $this->Form->button('Cancel',array('class'=>'outline_btn mBtn','div'=>false,'id'=>'cancel-edit-profile'));?>

                        </div>
                    </div>
                <!--</form>-->
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>



<script type="text/javascript">
    var WIDTH,HEIGHT,tmpFileName;
    $(document).ready(function(){
        var uploader = new qq.FileUploader({
            element: document.getElementById("file-uploader"),
            'action': '/users/uploadTempPhoto',
            'debug': false,
            multiple: false,
            sizeLimit: 10 * 1024 * 1024, // max size   
            minSizeLimit: 0, // min size
            allowedExtensions: ['jpg', 'jpeg', 'gif', 'png'],
            onSubmit: function(id, fileName){
                //$('#load').html('<img src="/img/loading.gif" style="margin-left:109px;margin-top:-34px;position:absolute;"/>')
            },
            onProgress: function(id, fileName, responseJSON){
            },
            onComplete: function(id, fileName, responseJSON){
                console.log(responseJSON);
                if(responseJSON.success == true){
                    WIDTH = responseJSON.width;
                    HEIGHT = responseJSON.height;
                    console.log('/temp/'+responseJSON.fileName);
                    tmpFileName = responseJSON.fileName;
                    initCrop('/temp/'+responseJSON.fileName)
                    $('.qq-upload-list').remove();
                    height = responseJSON.height
                    width = responseJSON.width
                }else{
                    console.log(responseJSON.message)
                    $.jGrowl(responseJSON.message,{position:'center'});
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
        
        $('.qq-upload-button').addClass('btn btn-small btn-default');
        var one = new CROP();
        function initCrop(fileName){
            $('#profile_picture').hide();
            $('.example').html('<div class="example"><div class="default"><div class="cropMain" style="width:227px; height:227px;"></div> <div class="cropSlider"></div> <button class="cropImage cropInCustomer chsFileBtn outline_btn">Crop and Save</button></div></div>').show();
            
            // link the .default class to the crop function
            one.init('.default');
            // load image into crop
            one.loadImg(fileName);
            // on click of button, crop the image
            $(".changeprofilephoto").show();
        }
        $('body').on("click", ".cropImage", function(e) {
            e.preventDefault();
           if (e.handled === true)
                       return false;
                   e.handled = true;
                
           // grab width and height of .crop-img for canvas
           var width = $('.crop-container').width(),  // new image width
               height = $('.crop-container').height();  // new image height
           
           $('canvas').remove();
           $('.default').after('<canvas width="'+width+'" height="'+height+'" id="canvas"/>');

           var ctx = document.getElementById('canvas').getContext('2d'),
               img = new Image,
               w = coordinates(one).w,
               h = coordinates(one).h,
               x = coordinates(one).x,
               y = coordinates(one).y;

           img.src = coordinates(one).image;
           if(h > HEIGHT || w > WIDTH){
                alert('You must zoom in to select the part of image to crop.');
                return false;
            }
            $('.example').hide();
            $('.imgrounded').toggle();
            $('.imgrounded').after('<img src="/img/loading.gif" class="loadIconSml" />');
           img.onload = function() {
               console.log(img, x, y, w, h, 0, 0, width, height)
                   // draw image
               ctx.drawImage(img, x, y, w, h-1.1, 0, 0, width, height);

               // display canvas image
                   $('canvas').addClass('output').show();
                   
                   // save the image to server
                   $.ajax({
                           type: "post",
                           dataType: "json",
                           url:'/users/uploadPhoto/',
                           data: { 
                               image: canvas.toDataURL(),
                               path:'profileimg/'
                           }
                   })
                   .done(function(responseJSON) {
                        if(responseJSON.success){
                            $('.loadIconSml').remove;
                            //$('#imgrounded').attr('src', 'profileimg/' + responseJSON.fileName);
                            $('#image').val(responseJSON.fileName);
                            //$('.imgrounded').toggle();
                           //$('#imgDeleteArea').html('<a href="" class="removeImage delImg"></a>');
                           $('.qq-upload-list').remove();
                           $('#profile_picture').attr('src', '/profileimg/' + responseJSON.fileName).show();
                       }else{
                          alert(responseJSON.message);
                           $('#load').empty();
                       }
                       $('.example').hide();
                       console.log(img.src.substr(20,36));
                       $.ajax({
                           type: "post",
                           dataType: "json",
                           url:'/users/deleteTempFile/',
                           data: { image: tmpFileName}
                       })
                       .done(function(responseJSON) {
                            if(responseJSON.success){
                                $('.userImgDiv').append('<div id="imgDeleteArea"><a class="removeImage delImg" href=""></a>');                                
                            }
                        });
                       return false;
                   });

           };
           return false;
       })
    });
</script>