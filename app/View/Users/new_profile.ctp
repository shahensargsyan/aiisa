<?php
$data = '';
$i = 1;
foreach($monthlySession as $sess){
    $monthSession = (int) $sess['MonthlySession'.$i];
    $data.= $monthSession.',';
    $i++;	
}

?>
<script>
    $(function () {
        $(".meter > span").each(function () {
            $(this)
                    .data("origWidth", $(this).width())
                    .width(0)
                    .animate({
                        width: $(this).data("origWidth")
                    }, 1200);
        });

        $('#chart').highcharts({
            title: {
                text: '',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: ''
                },
                plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
            },
            tooltip: {
                valueSuffix: ' Hours'
            },
            legend: {
                enabled: false,
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 1
            },
            series: [{
                    name: '',
                    data: [<?php echo $data; ?>]
                }]
        });
    });
</script>

<div class="dashbord row">
    <div class="dashbord-menu">
        <div class="menu-box my-account">
            <img src="/img/dashboard/my_account.png" class="menu-icon">
            <div class="menu-text">My Account</div>
        </div>
        <div class="menu-box my-profile">
            <img src="/img/dashboard/my-profile.png">
            <div class="menu-text">My Profile</div>
        </div>
        <div class="menu-box my-meditation">
            <img src="/img/dashboard/my-meditation.png">
            <div class="menu-text">My Meditation</div>
        </div>
    </div>
    <div class="dashbord-content">
        <div class="dashbord-header">
            <div class="dashbord-header-content">
                <div class="dashbord-header-content-left">
                    <div class="dashbord-title">My Profile</div>
                    <div class="dashbord-header-right">
                        <a href="#" class="start-meditation">START MEDITATION</a>
                    </div>
                </div>
                <div class="user">
                    <div class="user-content">
                        <div class="profile-image">
                            <img src="<?php echo $profile_picture?>" height="44px" width="44px">
                        </div>
                        <div class="username"><?php echo $first_name; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashbord-section-midle">
            <div class="midle-left">
                <div class="midle-left-content">
                    <div  class="statistic-icon">
                        <img src="/img/dashboard/total-time.png">
                    </div>
                    <div>
                        <div class="total-m-time"><?php echo $total_med_time; ?></div>
                        <span class="h">h</span>
                        <span class="session-desc">Total Mediatation Time</span>
                    </div>
                </div>
                <div class="states">
                    <div class="states-inner">
                        <div  class="state-icon">
                            <img src="/img/dashboard/avarage-time.png">
                        </div>
                        <div class="state-inner">
                            <div class="state-time"><?php echo date('H',  strtotime($session_data['average'])).'h '.date('i',  strtotime($session_data['average'])).'m '.date('s',  strtotime($session_data['average'])).'s' ?></div>
                            <span class="state-desc">Average Meditation Time</span>
                        </div>
                    </div>
                </div>
                <div class="states">
                    <div class="states-inner">
                        <div  class="state-icon">
                            <img src="/img/dashboard/avarage-time.png">
                        </div>
                        <div class="state-inner">
                            <div class="state-time"><?php echo date('H',  strtotime($session_data['long_session'])).'h '.date('i',  strtotime($session_data['long_session'])).'m '.date('s',  strtotime($session_data['long_session'])).'s' ?></div>
                            <span class="state-desc">Longest Meditation Session</span>
                        </div>
                    </div>
                </div>
                <div class="states">
                    <div class="states-inner">
                        <div  class="state-icon">
                            <img src="/img/dashboard/consecutive-days.png">
                        </div>
                        <div class="state-inner">
                            <div class="state-time"><?php
                                $total = ($session_data['total']!='')?$session_data['total']:'0';
                                echo $total;
                                ?> Days</div>
                            <span class="state-desc">Consecutive Meditation Days</span>
                        </div>
                    </div>
                </div>
                <div class="states">
                    <div class="states-inner">
                        <div  class="state-icon">
                            <img src="/img/dashboard/total-meditations.png">
                        </div>
                        <div class="state-inner">
                            <div class="state-time"><?php echo $session_data['total_site_session'];?></div>
                            <span class="state-desc">Total Number of Meditation</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="midle-right">
                <div class="user-progress">
                    <div class="midle-right-l">
                        <div class="bold-text text">Congratulations!</div>
                        <div class="l2">
                            <p class="text">Your meditation efforts raised:</p>
                            <img src="/img/dashboard/seeds.png" class="small-photo">
                            <p class="text bold-text">3,092 grains of rice</p>
                        </div>
                        <div class="l2">
                            <p class="text">Enough to feed a starving person for</p>
                            <img src="/img/dashboard/days.png" class="small-photo">
                            <p class="text bold-text">3 days</p>
                        </div>
                    </div>
                    <div class="midle-right-r">
                        <div class="title2">Your curent level:</div>
                        <div class="blue-text"><?php echo $userLevel; ?></div>
                        <div class="small-text">Neaxt level:</div>
                        <div class="green-text"><?php echo $nextLevel; ?></div>
                    </div>
                </div>
                <div class="pregress">
                    <div class="meter orange nostripes">
                        <span style="width: <?php echo $percent;?>%"></span>
                    </div>
                </div>
                <div class="levels">
                    <div class="level"><?php echo $minmax_level['min']; ?> Hours</div>
                    <div class="level"><span class="bold-text"><?php echo date('G',  strtotime($remainTime)); ?> Hours</span> to the next Level</div>
                    <div class="level"><?php echo $minmax_level['max']; ?> Hours</div>
                </div>
            </div>

            <div class="content">
                <div class="content-header">
                    <div class="st-cs">Statisctics</div>
                    <div class="y-st">YEARLY STATISTICS</div>
                </div>
                <div>
                    <div id="chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>

</div>