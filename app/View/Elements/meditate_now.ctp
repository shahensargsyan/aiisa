<div  id="StartPopup" class="StartPopup popup_1_container zoom" style="display: none">

    <div class="popupHeader">

        <h2 class="popupH ">START MEDITATING</h2>


        <button  id="back_to_popup_first" class="cls_button"></button>

    </div>

    <p class="smTagline end-hunger">End World Hunger</p>

    <div class="sepAU"></div>

    <div id="smfeatures">
        <div class="smF">
            <div class="smIcon">
                <img src="/img/seeds.png" alt="Seeds">
            </div>

            <div class="smInfo">
                <p class="smInfoPar">For each minute you meditate we will donate 10 grains of rice through Oxfam to a starving person on your behalf.</p>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="smF">
            <div class="smIcon">
                <img src="/img/globe.png" alt="Seeds">
            </div>

            <div class="smInfo">
                <p class="smInfoPar">You can track your progress alongside other fellow meditators around the world.</p>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="smF">
            <div class="smIcon">
                <img src="/img/rice.png" alt="Seeds">
            </div>

            <div class="smInfo">
                <p class="smInfoPar">Improve your lifestyle by meditating and help to end world hunger in the process.</p>
            </div>
            <div class="clearfix"></div>

<!--            <div id="buttons">
                <a href="#" class="white_btn">LOGIN</a>
                <a href="#" class="white_btn">REGISTER</a>
            </div>

            <div class="smStartButtonWL">
                <a href="#" class="startWL">Meditate without logging in  </a>
            </div>-->
            <?php if(!$this->Session->check('userId')):?>
                    <div  id="buttons">
                            <?php echo $this->Html->link('Log In', '/login', array('class' => 'login_green'));?>
                            <?php echo $this->Html->link('Register', '/register', array('class' => 'white_btn'));?>
                    </div>
                    <div class="smStartButtonWL">
                            <div class="login_link"><a class="startWL" href="javascript:void(0);">Meditate without logging in</a></div>
                    </div>
            <?php else:?>
                    <div class="smStartButtonWL">
                            <div class="login_link"><a class="startWL" href="javascript:void(0);">Meditate Now</a></div>
                    </div>
            <?php endif;?>
        </div>
    </div>
</div>
<!--<div class="popup_1_container" style="display: none">
        <div class="login_popup">
                <div style="padding:5px 20px 20px"><div id="back_to_popup_first" class="close_button"><?php echo $this->Html->image('close.gif',array('width' => '21', 'height' => '21')) ?></div></div>
                <div class="popup_container">
                        <div class="popup_content">
                                <div class="meditation_header">
                                        <a>Meditate to End World Hunger</a>
                                        <span>For each minute you meditate we will donate 10 grains of rice through Oxfam </span>
                                </div>
                                <div class="step_wrapper">
                                        <div class="step_post">
                                                <div class="step_icon">
                                                        <?php echo $this->Html->image('seeds.png') ?>
                                                </div>
                                                <div class="step_detail">
                                                1. For every minute you mediate, 10 grains of rice will be donated to a starving person
                                                </div>
                                                <div class="clear"></div>
                                        </div>
                                        <div class="step_post">
                                                <div class="step_icon">
                                                        <?php echo $this->Html->image('bowl.png') ?>
                                                </div>
                                                <div class="step_detail">
                                                        2. As your meditation minutes accumulate you help to feed hungry people in need.
                                                </div>
                                                <div class="clear"></div>
                                        </div>
                                        <div class="step_post">
                                                <div class="step_icon">
                                                        <?php echo $this->Html->image('rice.png') ?>
                                                </div>
                                                <div class="step_detail">
                                                        3. You can track your progress. See how many Rice you directly donated and help to end world hunger.
                                                </div>
                                                <div class="clear"></div>
                                        </div>
                                </div>
                                <?php if(!$this->Session->check('userId')):?>
                                        <div class="login_register_wrapper">
                                                <?php echo $this->Html->link('Log In', '/login', array('class' => 'button login_btn'));?>
                                                <?php echo $this->Html->link('Register', '/register', array('class' => 'button register_btn'));?>
                                                <div class="clear"></div>
                                        </div>
                                        <div class="without_login">
                                                <div class="login_link"><a class="link" href="javascript:void(0);">Meditate without logging in</a></div>
                                        </div>
                                <?php else:?>
                                        <div class="without_login">
                                                <div class="login_link"><a class="link" href="javascript:void(0);">Meditate Now</a></div>
                                        </div>
                                <?php endif;?>
                        </div>
                </div>			
        </div>  
</div>-->