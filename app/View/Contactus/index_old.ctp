
<div id="banner">
    <div id="taglines">
        <h2 class="taglineTop">Meditate With Others Around the Globe.</h2>
        <h3 class="taglineBot">Using Our Free Meditiaton Timer</h3>
    </div>

    <div class="popup uboutUsPopup">

        <div class="popupHeader">

            <h2 class="popupH">Contact Us</h2>
            <div class="sepAU"></div>

            <button class="cls_button">X</button>

            <p class="contactHeader">We love to hear from our community. If you have thoughts, opinions or questions please do not hesitate to contact us.</p>

            <form action="">
                <div class="leftControls">
                    <label class='lbContact'>Name:</label>
                    <input type="text" class="login">
                </div>

                <div class="rightControls">
                    <label class='lbContact'>Email Address:</label>
                    <input type="text" class="login">
                </div>

                <div class="clearfix"></div>

                <div class="contactControls">
                    <label class='lbContact'>Name:</label>
                    <textarea placeholder="Enter Profile Message..." class="mInput ta contactTa"></textarea>
                </div>

                <div class="sendButton">
                    <button class="contactButton">SEND</button>

                </div>

            </form>






        </div>
    </div>
</div>
<div class="user_heading_container">
		<div class="middle-midd-boxinner">
			<div class="user_heading">Contact Us</div>
		</div>
	</div>
	<div class="user-partition-solid-line-horizontal">&nbsp;</div>	
	<div class="user_main_container" style="padding:0px !important;width:100% !important;">
	<div class="leftContent">
	<div class="mission">
		"We love to hear from our community.<br />
		If you have thoughts, opinions or questions please do not hesitate to contact us.<br />
		If you have a complaint, please do not contact us! Only joking! We would love to hear from you also, that's how we improve."
	</div>
	</div>
	<div class="hidden" id="baseurl"><?php echo Router::url('/', true); ?></div>
		<div id="submit_form" class="contactForm" style="float:left !important;">
			<?php echo $this->Form->create('Contactus');?>
			<div class="packet_combo">
				<div class="packet_left">
					<div class="field_label">Name</div>
					<div class="field">		
						<?php echo $this->Form->input('name',array('label' => false,'required'=>'required','class'=>'input_text','id' =>'name','placeholder'=>'Name'));?>
					</div>
				</div>
				<div class="packet_right">
					<div class="field_label">Email</div>
					<div class="field">		
						<?php echo $this->Form->input('email',array('label' => false,'required'=>'required','class'=>'input_text','id' =>'email','placeholder'=>'Email'));?>
					</div>
				</div>	
			</div>

			<div class="packet_combo">
				<div class="field_label">Query</div>
				<div class="field">		
					<?php echo $this->Form->textarea('question',array('label' => false,'required'=>'required','class'=>'contactInput','style'=>"height: 129px;",'id' => 'comment','placeholder'=>'Query'));?>
				</div>
			</div>
			
			<div class="submitContact" style = 'float:left;width:48% !important;margin-top: 14px;'>
			<?php echo $this->Form->submit('Send',array('label' => false,'id'=> 'contactUs','class'=>'button'));
				  echo $this->Form->end();?>
		</div>
	</div>
	<div class="clear"></div>
</div>
