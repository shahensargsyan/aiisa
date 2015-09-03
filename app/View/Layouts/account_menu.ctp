 <?php //encrpt url 
$mn = 'yes';
$salt = '#XYZxjzubB';

$hash = md5($salt . $mn);
?>
<div id="popup_left">
    <!--<a class="dashButton" href="#">START MEDITATION</a>-->
    <?php echo $this->Html->link("START MEDITATION", "/meditations/home?mn={$hash}", array('class' => 'dashButton')); ?>
    <nav>
        <ul>
            <li><a href="/users/account">My Account</a>
            </li>
            <li><a href="/users/profile">My Profile</a>
            </li>
            <li><a href="/users/mymeditation">My Meditation</a>
            </li>
            <li><a href="/users/notifications">Notifications</a>
            </li>
        </ul>
    </nav>
</div>