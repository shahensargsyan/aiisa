<html>
    <head>
        <link href="/css/all.css" rel="stylesheet" media="screen"/>
        <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
    </head>
    <body>
        <?php
            echo __('Your message has been sent to the administrator. We will contact you soon');
        ?>
        <div class="container">
            <div class="errorPageCont">
                <img src="/img/newImgs/404_img4.png" />
                <p class="notFoundText">Page not found</p>
                <?php if(isset($is_blocked_ip)){?>
                <p class="errorText">
                    This IP address has been blocked by the system/admin, please use this link to
                    <a href="/pages/contactUs">contact us</a>
                    if you feel it was done in error.
		</p>
                <?php }?>
            </div>
            <div style="display: none" id="content">

                    <?php echo $this->Session->flash(); ?>

                    <?php echo $this->fetch('content'); ?>
            </div>
        </div>
    </body>
</hmtl>