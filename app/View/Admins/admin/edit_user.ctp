<div class="span5 margauto">
    <h3 class="text-center">Edit Profile</h3>
    <hr class="separator">

    <?php if (isset($error)) { ?>
        <div class="libErrorBox">
            <?php
            echo $error;
            ?>
        </div>  
        <?php
    }
    ?>

    <?php
    echo $this->Form->create(
            'User', array(
        'inputDefaults' => array(
            'label' => false,
            'div' => false
        ),
        'class' => 'form-horizontal',
        'enctype' => "multipart/form-data"
            )
    );
    ?>
    <div class="control-group">
        <label class="control-label" >First name</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'first_name', array(
                'type' => 'text',
                'error' => false,
                    )
            );
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" >Last name</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'last_name', array(
                'type' => 'text',
                'error' => false,
                'div' => false,
                    )
            );
            ?>            
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputEmail"><?php echo __('Email'); ?></label>   
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'email', array(
                'type' => 'text',
                'id' => "inputEmail",
                'error' => false,
                'div' => false,
            ));
            ?>
        </div>
    </div>

    <div class="control-group"> 
        <label class="control-label"><?php echo __('Address'); ?></label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'address', array(
                'type' => 'text',
                'div' => false,
                'error' => false,        
                'label' => false,
                    )
            );
            ?> 
        </div>
    </div>
    <div class="control-group"> 
        <label class="control-label"><?php echo __('City'); ?></label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'city', array(
                'type' => 'text',
                'div' => false,
                'error' => false,        
                'label' => false
                    )
            );
            ?> 
        </div>
    </div>
    <div class="control-group"> 
        <label class="control-label"><?php echo __('State'); ?></label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'state', array(
                'type' => 'text',
                'error' => false,        
                'div' => false,
//                'class' => 'form-control',
                    )
            );
            ?> 
        </div>
    </div>         
    <div class="control-group">
        <label class="control-label"><?php echo __('Country'); ?></label>        
        <div class="controls">
            <?php
            $countries = array(
                            'Afghanistan' => 'Afghanistan', 'Albania' => 'Albania', 'Algeria' => 'Algeria',
                            'American Samoa' => 'American Samoa', 'Andorra' => 'Andorra',
                            'Angola' => 'Angola', 'Anguilla' => 'Anguilla',
                            'Antarctica' => 'Antarctica', 'Antigua and Barbuda' => 'Antigua and Barbuda',
                            'Argentina' => 'Argentina', 'Armenia' => 'Armenia',
                            'Aruba' => 'Aruba', 'Australia' => 'Australia',
                            'Austria' => 'Austria', 'Bahamas' => 'Bahamas',
                            'Bahrain' => 'Bahrain', 'Bangladesh' => 'Bangladesh',
                            'Barbados' => 'Barbados', 'Belarus' => 'Belarus',
                            'Belgium' => 'Belgium', 'Belize' => 'Belize',
                            'Benin' => 'Benin', 'Bermuda' => 'Bermuda',
                            'Bhutan' => 'Bhutan', 'Bolivia' => 'Bolivia',
                            'Bosnia and Herzegovina' => 'Bosnia and Herzegovina', 'Botswana' => 'Botswana',
                            'Bouvet Island' => 'Bouvet Island', 'Brazil' => 'Brazil',
                            'British Indian Ocean Territory' => 'British Indian Ocean Territory', 'Brunei Darussalam' => 'Brunei Darussalam',
                            'Bulgaria' => 'Bulgaria', 'Burkina Faso' => 'Burkina Faso',
                            'Burundi' => 'Burundi', 'Cambodia' => 'Cambodia',
                            'Cameroon' => 'Cameroon', 'Canada' => 'Canada',
                            'Cape Verde' => 'Cape Verde', 'Cayman Islands' => 'Cayman Islands',
                            'Central African Republic' => 'Central African Republic', 'Chad' => 'Chad',
                            'Chile' => 'Chile', 'China' => 'China',
                            'Christmas Island' => 'Christmas Island', 'Cocos (Keeling) Islands' => 'Cocos (Keeling) Islands',
                            'Colombia' => 'Colombia', 'Comoros' => 'Comoros',
                            'Congo' => 'Congo', 'Congo, The Democratic Republic of The' => 'Congo, The Democratic Republic of The',
                            'Cook Islands' => 'Cook Islands', 'Costa Rica' => 'Costa Rica',
                            'Cote Divoire' => 'Cote Divoire', 'Croatia' => 'Croatia',
                            'Cuba' => 'Cuba', 'Cyprus' => 'Cyprus',
                            'Czech Republic' => 'Czech Republic', 'Denmark' => 'Denmark',
                            'Djibouti' => 'Djibouti', 'Dominica' => 'Dominica',
                            'Dominican Republic' => 'Dominican Republic', 'Ecuador' => 'Ecuador',
                            'Egypt' => 'Egypt', 'El Salvador' => 'El Salvador',
                            'Equatorial Guinea' => 'Equatorial Guinea', 'Eritrea' => 'Eritrea',
                            'Estonia' => 'Estonia', 'Ethiopia' => 'Ethiopia',
                            'Falkland Islands (Malvinas)' => 'Falkland Islands (Malvinas)', 'Faroe Islands' => 'Faroe Islands',
                            'Fiji' => 'Fiji', 'Finland' => 'Finland',
                            'France' => 'France', 'French Guiana' => 'French Guiana',
                            'French Polynesia' => 'French Polynesia', 'French Southern Territories' => 'French Southern Territories',
                            'Gabon' => 'Gabon', 'Gambia' => 'Gambia',
                            'Georgia' => 'Georgia', 'Germany' => 'Germany',
                            'Ghana' => 'Ghana', 'Gibraltar' => 'Gibraltar',
                            'Greece' => 'Greece', 'Greenland' => 'Greenland',
                            'Grenada' => 'Grenada', 'Guadeloupe' => 'Guadeloupe',
                            'Guam' => 'Guam', 'Guatemala' => 'Guatemala',
                            'Guinea' => 'Guinea', 'Guinea-bissau' => 'Guinea-bissau',
                            'Guyana' => 'Guyana', 'Haiti' => 'Haiti',
                            'Heard Island and Mcdonald Islands' => 'Heard Island and Mcdonald Islands', 'Holy See (Vatican City State)' => 'Holy See (Vatican City State)',
                            'Honduras' => 'Honduras', 'Hong Kong' => 'Hong Kong',
                            'Hungary' => 'Hungary', 'Iceland' => 'Iceland',
                            'India' => 'India', 'Indonesia' => 'Indonesia',
                            'Iran, Islamic Republic of' => 'Iran, Islamic Republic of', 'Iraq' => 'Iraq',
                            'Ireland' => 'Ireland', 'Israel' => 'Israel',
                            'Italy' => 'Italy', 'Jamaica' => 'Jamaica',
                            'Japan' => 'Japan', 'Jordan' => 'Jordan',
                            'Kazakhstan' => 'Kazakhstan', 'Kenya' => 'Kenya',
                            'Kiribati' => 'Kiribati', 'Korea, Democratic Peoples Republic of' => 'Korea, Democratic Peoples Republic of',
                            'Korea, Republic of' => 'Korea, Republic of', 'Kuwait' => 'Kuwait',
                            'Kyrgyzstan' => 'Kyrgyzstan', 'Lao Peoples Democratic Republic' => 'Lao Peoples Democratic Republic',
                            'Latvia' => 'Latvia', 'Lebanon' => 'Lebanon',
                            'Lesotho' => 'Lesotho', 'Liberia' => 'Liberia',
                            'Libyan Arab Jamahiriya' => 'Libyan Arab Jamahiriya', 'Liechtenstein' => 'Liechtenstein',
                            'Lithuania' => 'Lithuania', 'Luxembourg' => 'Luxembourg',
                            'Macao' => 'Macao', 'Macedonia, The Former Yugoslav Republic of' => 'Macedonia, The Former Yugoslav Republic of',
                            'Madagascar' => 'Madagascar', 'Malawi' => 'Malawi',
                            'Malaysia' => 'Malaysia', 'Maldives' => 'Maldives',
                            'Mali' => 'Mali', 'Malta' => 'Malta',
                            'Marshall Islands' => 'Marshall Islands', 'Martinique' => 'Martinique',
                            'Mauritania' => 'Mauritania', 'Mauritius' => 'Mauritius',
                            'Mayotte' => 'Mayotte', 'Mexico' => 'Mexico',
                            'Micronesia, Federated States of' => 'Micronesia, Federated States of', 'Moldova, Republic of' => 'Moldova, Republic of',
                            'Monaco' => 'Monaco', 'Mongolia' => 'Mongolia',
                            'Montserrat' => 'Montserrat', 'Morocco' => 'Morocco',
                            'Mozambique' => 'Mozambique', 'Myanmar' => 'Myanmar',
                            'Namibia' => 'Namibia', 'Nauru' => 'Nauru',
                            'Nepal' => 'Nepal', 'Netherlands' => 'Netherlands',
                            'Netherlands Antilles' => 'Netherlands Antilles', 'New Caledonia' => 'New Caledonia',
                            'New Zealand' => 'New Zealand', 'Nicaragua' => 'Nicaragua',
                            'Niger' => 'Niger', 'Nigeria' => 'Nigeria',
                            'Niue' => 'Niue', 'Norfolk Island' => 'Norfolk Island',
                            'Northern Mariana Islands' => 'Northern Mariana Islands', 'Norway' => 'Norway',
                            'Oman' => 'Oman', 'Pakistan' => 'Pakistan',
                            'Palau' => 'Palau', 'Palestinian Territory, Occupied' => 'Palestinian Territory, Occupied',
                            'Panama' => 'Panama', 'Papua New Guinea' => 'Papua New Guinea', 'Paraguay' => 'Paraguay',
                            'Peru' => 'Peru', 'Philippines' => 'Philippines',
                            'Pitcairn' => 'Pitcairn', 'Poland' => 'Poland',
                            'Portugal' => 'Portugal', 'Puerto Rico' => 'Puerto Rico',
                            'Qatar' => 'Qatar', 'Reunion' => 'Reunion',
                            'Romania' => 'Romania', 'Russian Federation' => 'Russian Federation',
                            'Rwanda' => 'Rwanda', 'Saint Helena' => 'Saint Helena', 'Saint Kitts and Nevis' => 'Saint Kitts and Nevis',
                            'Saint Lucia' => 'Saint Lucia', 'Saint Pierre and Miquelon' => 'Saint Pierre and Miquelon',
                            'Saint Vincent and The Grenadines' => 'Saint Vincent and The Grenadines', 'Samoa' => 'Samoa',
                            'San Marino' => 'San Marino', 'Sao Tome and Principe' => 'Sao Tome and Principe',
                            'Saudi Arabia' => 'Saudi Arabia', 'Senegal' => 'Senegal',
                            'Serbia and Montenegro' => 'Serbia and Montenegro', 'Seychelles' => 'Seychelles',
                            'Sierra Leone' => 'Sierra Leone', 'Singapore' => 'Singapore',
                            'Slovakia' => 'Slovakia', 'Slovenia' => 'Slovenia',
                            'Solomon Islands' => 'Solomon Islands', 'Somalia' => 'Somalia',
                            'South Africa' => 'South Africa', 'South Georgia and The South Sandwich Islands' => 'South Georgia and The South Sandwich Islands',
                            'Spain' => 'Spain', 'Sri Lanka' => 'Sri Lanka',
                            'Sudan' => 'Sudan', 'Suriname' => 'Suriname',
                            'Svalbard and Jan Mayen' => 'Svalbard and Jan Mayen', 'Swaziland' => 'Swaziland',
                            'Syrian Arab Republic' => 'Syrian Arab Republic', 'Taiwan, Province of China' => 'Taiwan, Province of China',
                            'Tajikistan' => 'Tajikistan', 'Tanzania, United Republic of' => 'Tanzania, United Republic of',
                            'Thailand' => 'Thailand', 'Timor-leste' => 'Timor-leste',
                            'Togo' => 'Togo', 'Trinidad and Tobago' => 'Trinidad and Tobago',
                            'Tunisia' => 'Tunisia', 'Turkmenistan' => 'Turkmenistan',
                            'Tuvalu' => 'Tuvalu', 'Uganda' => 'Uganda',
                            'Ukraine' => 'Ukraine', 'United Arab Emirates' => 'United Arab Emirates',
                            'United Kingdom' => 'United Kingdom', 'United States' => 'United States',
                            'United States Minor Outlying Islands' => 'United States Minor Outlying Islands', 'Uruguay' => 'Uruguay',
                            'Uzbekistan' => 'Uzbekistan', 'Vanuatu' => 'Vanuatu', 'Venezuela' => 'Venezuela',
                            'Viet Nam' => 'Viet Nam', 'Virgin Islands, British' => 'Virgin Islands, British',
                            'Virgin Islands, U.S.' => 'Virgin Islands, U.S.', 'Wallis and Futuna' => 'Wallis and Futuna',
                            'Western Sahara' => 'Western Sahara', 'Yemen' => 'Yemen',
                            'Zambia' => 'Zambia', 'Zimbabwe' => 'Zimbabwe',
                        );
            echo $this->Form->input(
                    'country', array(
                'options' => $countries,
                'div' => false,
                'error' => false,        
                'class' => 'form-control'
                    )
            );
            ?> 
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"><?php echo __('Phone Number'); ?></label>     
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'phone_number', array(
                'type' => 'text',
                'div' => false,
                'error' => false,        
                'class' => 'form-control'
                    )
            );
            ?> 
        </div>
    </div>
    <div class="control-group"> 
        <label class="control-label"><?php echo __('Zip/Postal'); ?></label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'postal', array(
                'type' => 'text',
                'div' => false,
                'error' => false,        
                'label' => false
                    )
            );
            ?> 
        </div>     
    </div>
    <div class="control-group">
        <label class="control-label"><?php echo __('Company Name'); ?></label>
        <div class="controls">
            <?php
                echo $this->Form->input(
                        'company', array(
                    'type' => 'text',
                    'div' => false,
                    'label' => false,
                    'class' => 'form-control'
                        )
                );
            ?> 
        </div>
    </div>     
    <div class="control-group mtop20">
        <label class="control-label" for="inputPassword">Password</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'new_password', array(
                'type' => 'password',
                'error' => false,
                'id' => "inputPassword",
                'div' => false,
                    )
            );
            ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" >Confirm password</label>
        <div class="controls">
            <?php
            echo $this->Form->input(
                    'confirm_password', array(
                'type' => 'password',
                'error' => false,
                'div' => false,
                    )
            );
            ?>
        </div>        
    </div>
    <?php if ('User.active' == 1) { ?>
        <div class="control-group mtop20">
            <label class="control-label">Active</label>
            <div class='controls'>
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
        </div>
    <?php } else if ('User.active' == 0) { ?>
        <div class="control-group mtop20">
            <label class="control-label">Active</label>
            <div class='controls'>
                <?php
                echo $this->Form->input(
                        'active', array(
                    'label' => FALSE,
                    'options' => array(
                        0 => 'inactive',
                        1 => 'active'
                    )
                        )
                );
                ?>
            </div>
        </div>
    <?php } ?>
    <div class="control-group btnSection">  
        <label class="control-label"></label>
        <div class="controls">
            <?php
            echo $this->Form->submit(
                    'Save', array(
                'label' => false,
                'class' => 'btn btn-success',
                'div' => false
                    )
            );

            echo $this->Html->link('Cancel', array('controller' => 'admins', 'action' => 'users'), array('class' => 'btn'));
            ?>
        </div> 
    </div>    
    <?php echo $this->Form->end(); ?>
</div>
<?php echo $this->Html->css('jquery-ui-1.8.23.custom'); ?>
<?php echo $this->Html->script('jquery-ui-1.8.23.custom.min'); ?>
<?php echo $this->Html->script('jquery.cropzoom'); ?>
<?php echo $this->Html->script('fileuploader'); ?>
<script>
    $(document).ready(function(){
        //        $('#userImage').val('noImage.png');
        var count = 0;
        var img;
        var alt;
        var check;
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader'),
            action: '<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'uploadUsersPic')); ?>',
            multiple: false,
            sizeLimit: 15728640, // max size  2097152    //15mb
            minSizeLimit: 1024, // min size
            allowedExtensions: ['jpg', 'jpeg'], //'png',
            onSubmit: function(id, fileName){
                $('#load').html('<img src="/img/loading.gif" style="margin-left:109px;margin-top:-34px;position:absolute;"/>');
                $('.qq-upload-list').remove();
            },
            onProgress: function(id, fileName, responseJSON){
                $('#load').html('<img src="/img/loading.gif" style="margin-left:109px;margin-top:-34px;position:absolute;"/>');
                //$('.qq-upload-list').remove();
                $('#imageLoading').show();
            },
            onComplete: function(id, fileName, responseJSON){
                count = count + 1;
                $('#imageLoading').hide();
                if(responseJSON.success == true){
                    $('#cont').html('<div id="img' + count + '"></div>');
                    //$('#load').html('<img src="/img/correct.png" style="margin-left:109px;margin-top:-32px;position:absolute;"/>');
                    //$('#img'+count).html(' <div id="crop_container'+count+'"></div><div id="crop'+count+'" class="cropSave">Crop And Save</div><input type="hidden" name="pic[picture'+count+']" value="'+responseJSON.fileName+'" />');
                    $('#img' + count).html('<div class="forCropArea"><div class="forCropPlugin" id="crop_container' + count + '"></div></br><div id="crop' + count + '" class="upbtn cropSave">Crop And Save</div><input type="hidden" name="pic[picture' + count + ']" value="' + responseJSON.fileName + '" /></div>');
                    // $('.hiddenCount').val(count);
                    check = 0;
                    //////////////////////////////////crop///////////////////////////////////////////
                    var height = responseJSON.size[1];
                    var width = responseJSON.size[0];
                    //                    var start_zoom = 80;
                    //                    if(height > 1000){
                    //                        start_zoom = 10;
                    //                    }

                    var cropzoom = $('#crop_container' + count + '').cropzoom({
                        width: 600,
                        height: 600,
                        bgColor: '#CCC',
                        enableRotation: true,
                        enableZoom: true,
                        zoomSteps: 10,
                        rotationSteps: 10,
                        setSizeLimit: 15728640, //15mb
                        selector: {
                            x: 0,
                            y: 0,
                            w: 600,
                            h: 600,
                            aspectRatio: false,
                            centered: true,
                            borderColor: 'yellow',
                            borderColorHover: 'red',
                            bgInfoLayer: '#FFF',
                            infoFontSize: 10,
                            infoFontColor: 'blue',
                            showPositionsOnDrag: false,
                            showDimetionsOnDrag: false,
                            maxWidth: 600,
                            maxHeight: 600,
                            startWithOverlay: true,
                            hideOverlayOnDragAndResize: true,
                            onSelectorDrag: null,
                            onSelectorDragStop: null,
                            onSelectorResize: null,
                            onSelectorResizeStop: null
                        },
                        image: {
                            source: "/system/users/" + responseJSON.fileName,
                            width:600,
                            height: (600*height)/width,
                            centered: true,
                            minZoom: 1,
                            maxZoom: 250,
                            startZoom: 100,
                            x: 0,
                            y: 0,
                            useStartZoomAsMinZoom: false,
                            snapToContainer: false
                        },
                        cache: false
                    });
                    img = responseJSON.fileName;
                    $('#crop_container' + count + '_selector').remove();

                    $('#crop' + count + '').click(function(){
                        alt = $('#alt').val();
                        cropzoom.send('<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'resizeCrop')); ?>/user' + responseJSON.fileName + '', 'POST', {}, function(rta){
                            picture(count, 'user' + responseJSON.fileName, alt);
                            $('#userImage').val('user' + responseJSON.fileName);
                            parent.$('#defaultBackground').attr("src", '/system/users/user' + responseJSON.fileName);
                        });
                        return false;
                    });

                    /////////////////////////////// end crop/////////////////////////////////////////////

                    $('#blah' + count).attr('src', '/system/users/' + responseJSON.fileName);
                    $('#ManualEntryManualFile').val(responseJSON.fileName);
                    $('.qq-upload-list').remove();
                    if($('#2').length !== 0 && $('#3').length !== 0){
                        $('#file-uploader3').removeClass('hid');
                    }
                }else{
                    $('.qq-upload-list').remove();
                    alert('Please upload images, with  JPG or JPEG extensions and max size of less than 15MB!');
                    $('#load').empty();
                }
            },
            onCancel: function(id, fileName){
                $('.qq-upload-button').removeClass('.qq-upload-button-visited')
            },
            /*messages: {
             // error messages, see qq.FileUploaderBasic for content            
             },*/
            showMessage: function(message){
                alert(message);
            }
        });
        $('.qq-upload-drop-area').remove();
    });
    function picture(count, img, alt){ ///////////////////<img width="672" height="480" src="/system/users/' + img + '" alt=""/>
        $('#cont').html('<div class="cropedDesc"><input type="hidden" name="pic" value="' + img + '" /><input type="hidden" name="default" value="' + count + '"></div>');
    }
</script>
<style>   
    .forCropPlugin
    {
        -webkit-transform: scale(0.38);
        -moz-transform: scale(0.38);
        -o-transform: scale(0.38);
        transform: scale(0.38);       
    }
</style>