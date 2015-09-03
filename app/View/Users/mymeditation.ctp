<?php echo $this->Html->script('fileuploader'); ?>
<div class="page_heading">
	<?php if( $this->Session->check('Message.flash') ): ?>
		<div class="session-msg-holder" id="profile_message">
			<div class="banner-date-cont">
				<h1 id="instruction"><?php echo $this->Session->flash(); ?></h1>
			</div>
		</div>		 
	<?php endif; ?>
	<script type="text/javascript">hideFlash('profile_message');</script>
</div>
<div class="dashbord">
    <?php echo $this->element('dashbord-menu'); ?>
    <div class="dashbord-content">
        <div class="dashbord-header zoom">
            <div class="dashbord-header-content">
                <div class="dashbord-header-content-left">
                    <div class="dashbord-title">My Meditation</div>
                    <div class="dashbord-header-right">
                        <!--<a href="#" class=""></a>-->
                        <?php echo $this->Html->link("START MEDITATION", "/meditations/index?mn={$hash}", array('class' => 'start-meditation')); ?>
                    </div>
                </div>
                <div class="user">
                    <div class="user-content">
                        <div class="profile-image">
                            <img src="<?php echo $profile_picture ?>" height="44px" width="44px">
                        </div>
                        <div class="username"><?php echo $first_name; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashbord-section-midle">
            <div class="section-left zoom">
                <div  id="updateSession">
                        <?php 
                        $totalUserSession = count($userSession);
                        if($totalUserSession<7) {	//If Sessions listing is less than '7', Display form to submit session ?>
                            <div id="msSetMeditation">
                            <h3 class="subhead subleft">Set your meditation session (HH:MM:SS)</h3>

                                <?php echo $this->Form->create('Usersmetas');?>
                                <div id="msTimeSelect">
                                    <div class="DateSelect">
                                        <div class="YearSelect">
                                            <?php echo $this->Form->input('hours',array('type'=>'select','options'=>$hours, 'label'=>false, 'id' => 'hours', 'class'=>'sel selRegister'));?>
                                        </div>
                                        <div class="YearSelect">
                                            <?php echo $this->Form->input('minutes',array('type'=>'select','options'=>$minutes,'label'=>false,'id' => 'minutes', 'class'=>'sel selRegister')); ?>
                                        </div>
                                        <div class="YearSelect">
                                            <?php echo $this->Form->input('seconds',array('type'=>'select','options'=>$seconds,'label'=>false,'id' => 'seconds', 'class'=>'sel selRegister')); ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="packet_right msButton">
                                        <?php echo $this->Js->submit( 'Save', array(
                                            'before'	=> 'return  submitSessionValidate();',
                                            //'success' 	=> 'submitSessionSuccess();',
                                            'complete'  => 'submitCompleteSession();',
                                            'async'     => false,													
                                            'update'    => '#updateSession',
                                            'id'        => 'submitSession',
                                            'class' 	=> 'green_btn',
                                            'url'       => array('controller'=>'usersmetas', 'action' => 'submitsessionNew')
                                        ));
                                        echo $this->Js->writeBuffer();
                                        ?>
                                </div>	
                                <?php echo $this->Form->end(); ?>	 
                                <div class="clearfix"></div>
                            </div>
                        <?php } ?>


                            <div id="meLastSessions">
                                <h3 class="subhead subleft">Your Preset Meditation Session (HH:MM:SS)</h3>
                                <div id="msLastTable">

                                        <!--<div class="section-head">Your Preset Meditation Session<span class="note-white" style="margin-left: 6px;">(HH:MM:SS)</span></div>-->

                                        <?php
                                        $count=1;
                                        if(!empty($totalUserSession)){
                                            // Print the User sessions
                                            $userSession = explode(',',str_replace('{','',str_replace('}','',$session_data['usermeta']['setsessions'])));
                                            $totalUserSession = count($userSession);
                                            if($totalUserSession >=1){
                                                for($i=0;$i<$totalUserSession;$i++){
                                                    $explode_session = explode(':',str_replace("'",'',$userSession[$i]));
                                                    echo $this->Form->create('Usersmetas', array('url' => array('controller' => 'usersmetas'),'id'=>'UserMetaSessionForm'.'_'.$explode_session[0]));
                                                    echo $this->Form->hidden('Usersmetas.delsession', array('value'=> $explode_session[0]));
                                                    $odd = '';
                                                    if($i%2==0){
                                                        $odd = 'odd-bg';
                                                    }
                                                    echo '  <table class="'.$odd.'"><tr>';
                                                    echo ' <td>Session '.$count.'</td>';    
                                                    if(isset($explode_session[1])&& isset($explode_session[2])&& isset($explode_session[3])){
                                                        echo ' <td>'.$explode_session[1].':'.$explode_session[2].':'.$explode_session[3].'</td>';    
                                                    }else{
                                                        echo ' <td></td>';
                                                    }

                                                    echo '<td>';
                                                    echo $this->Html->link("Edit",array('controller' => 'usersmetas', 'action' => 'editsessionNew',$explode_session[0],$explode_session[1],$explode_session[2],$explode_session[3]),array('class' => 'outline_btn')).'&nbsp;&nbsp;';
                                                    echo $this->Js->submit( 'Delete', array(
                                                            'before'	=> 'return showConfirm();',
                                                            'update'    => '#updateSession',
                                                            'complete'  =>  'completeSession();',
                                                            'id'        =>  $explode_session[0],
                                                            'class'     => 'deleteSession my_med_btn button outline_btn',
                                                            'url'       => array('controller'=>'usersmetas','action' => 'deletesessionNew'),
                                                            array('confirm' => 'Are you sure?'),
                                                    ));
                                                     echo '</td>';

                                                    $count++;

                                                    echo '</tr></table>';
                                                    echo $this->Js->writeBuffer();
                                                    echo $this->Form->end();	
                                                }
                                            }
                                        } else {
                                            echo '<div class="myMed">Please Set your Session&nbsp;<em>(You can save upto 7 sessions.)</em></div>';
                                        }
                                        ?>

                                </div>
                            </div>
                        </div>
            </div>
            <div class="section-right zoom">
                    <div id="msBellSound" class=leftControls>
                        <h3 class="subhead subleft">Bell Sound</h3>
                        <?php
                        $filepath = ($session_data['usermeta']['filepath']!='')?$session_data['usermeta']['filepath']:'ring.mp3';
                        ?>
                        <p>Your Bell Sound: <strong><?php echo $filepath;?></strong>
                        </p>
                    </div>


                    <div id="msBellSound" class=leftControls>
                        <h3 class="subhead subleft">Set new bell sound:</h3>
                        <div id="file-uploader" class="chsFileBtn upload_btn"></div>
                    </div>

                    <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var WIDTH,HEIGHT,tmpFileName;
    $(document).ready(function(){
        var uploader = new qq.FileUploader({
            element: document.getElementById("file-uploader"),
            'action': '/users/uploadbell',
            'debug': false,
            multiple: false,
            sizeLimit: 10 * 1024 * 1024, // max size   
            minSizeLimit: 0, // min size
            allowedExtensions: ['mp3'],
            onSubmit: function(id, fileName){
                //$('#load').html('<img src="/img/loading.gif" style="margin-left:109px;margin-top:-34px;position:absolute;"/>')
            },
            onProgress: function(id, fileName, responseJSON){
            },
            onComplete: function(id, fileName, responseJSON){
                if(responseJSON.success){
                    $.jGrowl("Your Bell Sound Successfully Upladed",{theme:'noteJg'});
                }else{
                    $.jGrowl("Error,please try again!",{theme:'errorJg'});
                }
            },
            onCancel: function(id, fileName){$('.qq-upload-button').removeClass('.qq-upload-button-visited')},
            messages: {
                sizeError: "Please upload images not bigger than 2MB",
                typeError: "File Not Permitted,!",
            },
            showMessage: function(message){
            }
        });
    });
</script>