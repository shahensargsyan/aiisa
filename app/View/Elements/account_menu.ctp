 <?php //encrpt url 
$mn = 'yes';
$salt = '#XYZxjzubB';

$hash = md5($salt . $mn);
$purl = explode('/',$this->here); 

?>
<div id="popup_left">
    <!--<a class="dashButton" href="#">START MEDITATION</a>-->
    <?php echo $this->Html->link("START MEDITATIING", "/meditations/index?mn={$hash}", array('class' => 'dashButton')); ?>
    <nav>
        <ul>
            <li class="<?php echo (in_array('account',$purl)?'active-tub':''); ?>"
                ><a href="/users/account">My Account</a>
            </li>
            <li class="<?php echo (in_array('profile',$purl)?'active-tub':''); ?>">
                <a href="/users/profile">My Profile</a>
            </li>
            <li class="<?php echo (in_array('mymeditation',$purl)?'active-tub':''); ?>">
                <a href="/users/mymeditation">My Meditation</a>
            </li>
<!--            <li class="<?php echo (in_array('notifications',$purl)?'active-tub':''); ?>">
                <a href="/users/notifications">Notifications</a>
            </li>-->
        </ul>
    </nav>
</div>