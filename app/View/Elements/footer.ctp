<!--Top navigation-->
<?php foreach($footers['top'] as $footer){ ?>
    <a href="<?php
    echo $this->Html->url(array(
        'controller' => 'pages',
        'action' => 'view',
        $footer['Footer']['id']
    ));
    ?>">
           <?php $footer['Footer']['name'] ?>
    </a>
<?php } ?>
<!-- footer of the page -->
<footer id="footer">
    <div class="container">
        <div class="footer-content">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <strong class="title"><?php echo __('COMPANY'); ?></strong>
                    <ul class="links">
                        <?php foreach($footers['bottom'] as $footer){ ?>
                            <li>
                                <?php if($footer['Footer']['type'] == 'static'){ ?>
                                    <a href="<?php echo $footer['Footer']['url']; ?>">
                                        <?php echo __($footer['Footer']['name']); ?>
                                    </a>                                        
                                <?php }else{ ?>
                                    <a href="/pages/<?php
                                    echo preg_replace('/\s+/', '_', strtolower($footer['Footer']['name'])) ?>">
                                           <?php echo __($footer['Footer']['name']); ?>
                                    </a>
                                <?php } ?>    
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-4">
                    <div class="box">
                        <strong class="title"><?php echo __('EMAIL SIGN UP'); ?></strong>
                        <?php
                        echo $this->Form->Create(
                                'EmailSubscription', array(
                            'url' => array(
                                'controller' => 'users',
                                'action' => 'email_signup'
                            ),
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false),
                            'class' => 'signup-form'
                                )
                        );
                        ?>
                        <fieldset>
                            <?php
                            echo $this->Form->submit();
                            ?>
                            <div class="field">
                                <?php
                                echo $this->Form->input('email', array(
                                    "class" => "form-control",
                                ));
                                ?>
                            </div>
                        </fieldset>
                        <?php echo $this->Form->end(); ?>

                        <p><?php echo __('Sign up and receive weekly news and updates about newely released legal documents.'); ?></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <div class="contact-box">
                        <strong class="title"><?php echo __('Get in touch'); ?></strong>
                        <ul>
                            <?php if($info['Info']['bottom_info'] == true){?>
                            <?php if($this->request->isMobile){ ?>
                            <li class="tel"><a href="tel:97141155889">+971 4 1155889</a></li>
                            <?php }else{ ?>
                            <li class="tel"><a>+971 4 1155889</a></li>
                            <?php }?>
                            <?php }?>
                            <li class="mail"><a href="mailto:&#104;&#101;&#108;&#112;&#064;&#099;&#111;&#110;&#116;&#114;&#097;&#099;&#116;&#115;&#046;&#112;&#119;">&#104;&#101;&#108;&#112;&#064;&#099;&#111;&#110;&#116;&#114;&#097;&#099;&#116;&#115;&#046;&#112;&#119;</a></li>
                            <?php if(isset($action)){?>
                            <li class="link"><a id="live_chat_link" href="#"><?php echo __('Live Support'); ?></a></li>
                            <?php }?>
                        </ul>
                        <div class="social-bar">
                            <strong class="text"><?php echo __('Connect'); ?></strong>
                            <?php 
                            $settings = json_decode($social_settings['Setting']['data'], true); 
                            $trust = json_decode($trust['Setting']['data'], true); 
                            ?>
                            <ul class="social-networks">
                                <li><a target="_blank" href="<?php echo $settings['linked_in']?>">linkedin</a></li>
                                <li class="googleplus"><a target="_blank" href="<?php echo $settings['google_plus']?>">googleplus</a></li>
                                <li class="facebook"><a target="_blank" href="<?php echo $settings['facebook']?>">facebook</a></li>
                                <li class="twitter"><a target="_blank" href="<?php echo $settings['twitter']?>">twitter</a></li>
                            </ul>
                            <?php
                                if(isset($trust)){?>
                            <a class="trustLogo" href="<?php echo $trust['url'];?>" target="_blank"><?php echo $this->Html->image("/system/trust/" . $trust['image_name'],array('width' => $trust['width'], 'height' => $trust['height'])) ?></a> 
                                <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span class="copyright">Copyright &copy; 2014 &nbsp;<a href="#">Contracts.pw</a>&nbsp; All rights reserved</span>
    </div>
</footer>
<script>
    $("#EmailSubscriptionHomeForm").validate({
        rules: {
            'data[EmailSubscription][email]': {
                required: true,
                email: true
            }
        },
        messages: {
            'data[EmailSubscription][email]': {
                required: '<?php echo __('Email address is required!') ?>',
                email: '<?php echo __('Please enter your email address in the correct format, such as john_123@yahoo.com!') ?>',
            }
        }
    });
</script>

<script type="text/javascript">
$('.link').bind('click touchend', function(){
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
    $.src='//v2.zopim.com/?2P3QR4XJphaPU4DPYjHg3dsUrVg5t6id';z.t=+new Date;$.
    type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');


    function openWin(){
        var myWindow = window.open("https://v2.zopim.com/widget/popout.html?key=2P3QR4XJphaPU4DPYjHg3dsUrVg5t6id","","width=500,height=500","cla");
    }
});
</script>
