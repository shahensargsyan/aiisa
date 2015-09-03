<div id="timer_frame" class="timer_form_container StartPopup zoom">
<div id="jquery_jplayer_1" class="jp-jplayer"></div>
    <div class="popupHeader">
        <h2 class="popupH timerH">Sit up straight, focus your attention on your breath, you have arrived</h2>
        <button id="back_to_popup1"  class="cls_button"></button>
    </div>
    <div class="sepAU"></div>
    
    
    <div class="timer_counter_container">
        <div class="sepAU"></div>
        <div class="stTimer">
            <div id="countdown" class="timeLeft">00:00</div>
        </div>
        <div class="sepAU"></div>
            <!--<div id="countdown" class="timer-clock">00:00</div>-->
            <?php
                    echo $this->Form->create('Meditation', array('style' => 'margin-top:5px;', 'id' => 'example2form'));
                    // hidden fields containing user location info
                    echo $this->Form->hidden('countryCode', array('value'=> $data['country_code'], 'id'=>'countryCode'));
                    echo $this->Form->hidden('latitude', array('value'=> $data['lat'], 'id'=>'latitude'));
                    echo $this->Form->hidden('longitude', array('value'=> $data['lon'], 'id'=>'longitude'));
                    echo $this->Form->hidden('city', array('value'=> $data['city'], 'id'=>'city'));
                    echo $this->Form->hidden('zipCode', array('value'=> $data['zip_code'], 'id'=>'zipCode'));
                    echo $this->Form->hidden('regionName', array('value'=> $data['region_name'], 'id'=>'regionName'));	
                    echo $this->Form->hidden('countryName', array('value'=> $data['country_name'], 'id'=>'countryName'));
                    echo $this->Form->hidden('ipAddress', array('value'=> $data['ip_address'], 'id'=>'ipAddress'));
                    echo $this->Form->hidden('showPopup', array('value'=>$showpopup, 'id'=>'showPopup'));
                    echo $this->Form->hidden('status', array('value'=> $data['status'], 'id'=>'status'));
                    echo $this->Form->hidden('userType', array('value'=>$userType, 'id'=>'userType'));
                    echo $this->Form->hidden('modeType', array('value'=>'play', 'id'=>'modeType'));
                    echo $this->Form->hidden('settimeLoc', array('value'=>'', 'id'=>'settimeLoc'));
               //echo $this->Form->hidden('setTimethroughmail', array('value'=> $setTime, 'id'=>'setTimethroughmail'));
                    echo '<div id="smButtons">';
                    echo $this->Js->submit( 'Start', array(
                    'before'	=> 'play();addOnlineUser();soundPlay();resume();',
                    'update'    => '#map_container',
                    'complete'	=> 'setsessionid();',	
                    'success' 	=> '',
                    'id'		=> 'start',
                    'class' 	=> 'login_green',
                    'url'       => array('action' => 'updateDuo')
                    ));
                    echo $this->Js->submit( 'Pause', array(
                    'before'	=> 'pause();deleteOnlineUser();',
                    'update'    => '#map_container',
                    'complete'	=> 'setsessionid();',	
                    'success' 	=> 'pause_indicator_fadeOut();',
                    'id'		=> 'pause',
                    'class' 	=> 'white_btn stop-button',
                    'style'		=> 'display:none;',
                    'url'       => array('action' => 'updateDuo')
                    ));
                    echo '</div>';
                    echo $this->Js->submit( 'Stop', array(
                    'before'	=> 'deleteOnlineUser();',
                    'update'    => '#map_container',
                    'complete'	=> 'setsessionid();',	
                    'success' 	=> 'pause_indicator_fadeOut();',
                    'id'		=> 'stopid',
                    'class' 	=> 'button white_btn smtButton',
                    'style'		=> 'display:none;',
                    'url'       => array('action' => 'updateDuo')
                    ));
                echo '</div>';
            if($this->Session->check('userId')):
                    if(!empty($userMeta)):
                            $bell = ($userMeta['Usersmeta']['filepath']!='')?$userMeta['Usersmeta']['filepath']:'ring_v3.mp3';
                            echo $this->Form->hidden('mp3Sound', array('value'=> $bell, 'id'=>'mp3Sound'));
                            echo $this->Form->hidden('ogaSound', array('value'=>'ring_v3.ogg', 'id'=>'ogaSound'));
                    else:
                            echo $this->Form->hidden('mp3Sound', array('value'=> 'ring_v3.mp3', 'id'=>'mp3Sound'));
                            echo $this->Form->hidden('ogaSound', array('value'=>'ring_v3.ogg', 'id'=>'ogaSound'));
                    endif;
            else:
                    echo $this->Form->hidden('mp3Sound', array('value'=>'ring_v3.mp3', 'id'=>'mp3Sound'));
                    echo $this->Form->hidden('ogaSound', array('value'=>'ring_v3.ogg', 'id'=>'ogaSound'));
            endif;
                    echo $this->Form->hidden('mode', array('value'=>'pause', 'id'=>'mode'));

                    echo $this->Form->hidden('setSeconds', array('value'=>'0', 'id'=>'setSeconds'));
                    echo $this->Form->hidden('Hours', array('value'=>'0', 'id'=>'hours'));
                    echo $this->Form->hidden('Minutes', array('value'=>'0', 'id'=>'minutes'));
                    echo $this->Form->hidden('Seconds', array('value'=>'0', 'id'=>'seconds'));
                    echo $this->Form->hidden('sessionId', array('value'=>'', 'id'=>'sessionId'));
                    echo $this->Form->end();
                    echo $this->Js->writeBuffer();									
            ?>
            </div><!-- timer_counter_container-->
    <div class="clear"></div>
</div><!-- timer frame -->