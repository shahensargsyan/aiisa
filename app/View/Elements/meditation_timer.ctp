<!-- CUSTOM MEDITATION TIMER -->
<div class="meditation-stop-watch timer_form_container hide zoom">

        <div class="timer_container">
                <span id="back_to_popup1" class="close_button"><?php echo $this->Html->image('close.gif',array('width' => '21', 'height' => '21')) ?></span>
                <div class="timer_text">Set custom time upto 60 Minutes</div>
                <div class="timer_text">for your Meditation Session</div>
        </div>
        <div class="timer_counter_container">
                <div id="custom_session">
                        <div id="custom-med-timer" data-timer="0" class="time_circles" style="padding-left:122px;width:300px;height:75px;"></div>
                </div>
                <?php
                echo $this->Form->create('Meditation', array('id' => 'timerform'));
                // hidden fields containing user location info
                echo $this->Form->hidden('modeTType', array('value'=>'play', 'id'=>'modeTType'));
                echo $this->Form->hidden('countryCode', array('value'=> $data['country_code'], 'id'=>'countryCode'));
                echo $this->Form->hidden('latitude', array('value'=> $data['lat'], 'id'=>'latitude'));
                echo $this->Form->hidden('longitude', array('value'=> $data['lon'], 'id'=>'longitude'));
                echo $this->Form->hidden('city', array('value'=> $data['city'], 'id'=>'city'));
                echo $this->Form->hidden('zipCode', array('value'=> $data['zip_code'], 'id'=>'zipCode'));
                echo $this->Form->hidden('regionName', array('value'=> $data['region_name'], 'id'=>'regionName'));	
                echo $this->Form->hidden('countryName', array('value'=> $data['country_name'], 'id'=>'countryName'));
                echo $this->Form->hidden('ipAddress', array('value'=> $data['ip_address'], 'id'=>'ipAddress'));
                echo $this->Form->hidden('status', array('value'=> 0, 'id'=>'status'));
                echo $this->Form->hidden('active', array('value'=> 4, 'id'=>'active'));
                echo $this->Form->hidden('sessionId', array('value'=>'', 'id'=>'sessionId1'));
                echo $this->Form->hidden('showPopup', array('value'=>$showpopup, 'id'=>'showPopup'));
                echo $this->Form->hidden('userType', array('value'=>$userType, 'id'=>'userType'));
                /******************** Notification will display if and only for BUTTONTYPE = play 
                suppose user first time click on "play" if its pause then again play 
                locationa notification pop up will not display at thnat time 
                ********************/
                echo $this->Form->hidden('buttonType', array('value'=>'play', 'id'=>'buttonType'));
                echo $this->Form->hidden('selLocation', array('value'=>'', 'id'=>'selLocation'));
                echo $this->Form->hidden('customTotalMedTime', array('value'=>'', 'id'=>'customTotalMedTime'));
                echo $this->Js->submit('Play', array(
                'before'    => 'customTimer("play");',
                'success' 	=> 'timersoundPlay();',
                'class' 	=> 'button btn btn-med-success playTimer',
                'complete'	=> 'setsessionid();',
                'id'        => 'play',
                'div'       => false

                ));

                //pause stop watch medtation
                echo $this->Js->submit('Pause', array(
                'before'    => 'customTimer("pause");',
                'class' 	=> 'button btn btn-med-success btn-danger pauseTimer',
                'id'        => 'pausew',
                'div'       => false
                ));

                ?>
        <!-- <button class="btn btn-med-success btn-danger pauseTimer" id="pausew">Pause</button>-->
                <button class="button btn btn-med-success resetTimer" id="reset" disabled="disabled">Reset</button>
                <?php
                echo $this->Js->submit('Stop', array(
                'before'    => 'customTimer("stop");',
                'class' 	=> 'button btn btn-med-success stopTimer',
                'success'   => 'completeCountdown("customtimerwatch");',
                'complete'	=> 'setsessionid();',
                'id'        => 'stop',
                'div'       => false
                ));
                echo $this->Form->hidden('mp3Sound', array('value'=>'ring_v3.mp3', 'id'=>'mp3Sound'));
                echo $this->Form->hidden('ogaSound', array('value'=>'ring_v3.ogg', 'id'=>'ogaSound'));

                echo $this->Form->end();
                echo $this->Js->writeBuffer();

           ?>
        </div>	
        <div class="clear"></div>		
</div>
<!-- end CUSTOM MEDITATION TIMER -->