
<div id="banner">
    <div id="taglines">
        <h2 class="taglineTop">Meditate With Others Around the Globe.</h2>
        <h3 class="taglineBot">Using Our Free Meditiaton Timer</h3>
    </div>

    <div class="popup uboutUsPopup">

        <div class="popupHeader contact-page">

            <h2 class="popupH">Contact Us</h2>
            <div class="sepAU"></div>

            <a href="/" class="cls_button">X</a>

            <p class="contactHeader">We always love to hear from our community. Please share with us any thoughts, suggestions or queries that you may have.</p>
            <?php echo $this->Form->create('Contactus',array('class' => 'contact'));?>
            <!--<form action="" class="contact">-->
                <div class="leftControls">
                    <label class='lbContact'>Name:</label>
                    <?php echo $this->Form->input('name',array('label' => false,'required'=>'required','class'=>'login','id' =>'name'));?>
                    <!--<input type="text" class="login">-->
                </div>

                <div class="rightControls">
                    <label class='lbContact'>Email Address:</label>
                    <?php echo $this->Form->input('email',array('label' => false,'required'=>'required','class'=>'login','id' =>'email'));?>
                    <!--<input type="text" class="login">-->
                </div>

                <div class="clearfix"></div>

                <div class="contactControls">
                    <label class='lbContact'>Query:</label>
                    <?php echo $this->Form->textarea('question',array('placeholder' => "Enter Profile Message...",'label' => false,'required'=>'required','class'=>'mInput ta contactTa','id' => 'comment'));?>
                    <!--<textarea placeholder="Enter Profile Message..." class="mInput ta contactTa"></textarea>-->
                </div>

                <div class="sendButton">
                    <?php echo $this->Form->submit('SEND',array('label' => false,'id'=> 'contactUs','class'=>'contactButton'));?>
				  
                    <!--<button class="contactButton">SEND</button>-->

                </div>
                <?php echo $this->Form->end();?>
            <!--</form>-->
        </div>
    </div>
</div>

<!--<div class="user_heading_container">
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
</div>-->
