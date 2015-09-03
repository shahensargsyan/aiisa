<div id="footer_wrapper">
    <div id="footer">
        <div id="statisctics">
            <ul id="statsTitles">
                <li>Users Online:</li>
                <li>Total Meditation sessions:</li>
                <li>Total Meditation Minutes:</li>
            </ul>
            <ul id="stats">
                <li><?php echo number_format($num_online_users); ?></li>
                <li><?php echo number_format($total_med_logged); ?></li>
                <li><?php echo number_format($total_med_session);?></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div id="separator"></div>
        <div id="oxfam">
            <div id="oLogo">
                <a href="/aboutus/learnMore"><img class ="oxfam_logo"  src="/img/oxfam_logo.png"></a>
            </div>
            <div id="info">
                <p>For each minute you meditate we will <span class="bold-text">donate 10 grains of rice</span> to a starving person through Oxfam.</p>
                <div id="footer_buttons">
                    <!--<div class="footer_button fl"><a href="javascript:void(0);" class="start_link">START MEDITATING</a></div>-->
                    <div class="footer_button "><a href="/aboutus/learnMore" class="start_link">LEARN MORE</a></div>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>
    <div class="footer"></div>
</div>