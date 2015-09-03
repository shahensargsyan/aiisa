<div id="banner">
    <?php
    echo $this->Html->css('home.css');
    $userData = $this->Session->check('userId');
    ?>	
    <script type="text/javascript">
        $(document).ready(function () {
            $('.demo1').TrackpadScrollEmulator();
            $('.demo2').TrackpadScrollEmulator();
<?php if ($start) { ?>
                $('.mainButton').click();
<?php } ?>
        });

    </script>

    <?php
//check if shared meditation is numric or not .pop up should be appear for numeric value
//echo"<pre>";print_r($_REQUEST);
    if (!empty($_REQUEST['mn'])) {
        $mn = $_GET['mn'];
        if ($mn == '11328618a16d4e24b3fabe30587c4714') {
            //show timer
            ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    $(".popup_0_container").fadeOut("slow", function () {
                        //$(".blank_wrapper1").attr("id","popup");
                        $(".popup_2_container").fadeIn("slow");
                        //$(".popup_0_container").fadeOut("slow");	
                    });

                });
            </script>
        <?php
        } else {
            //nothing here
        }
    }
    if (!empty($_REQUEST['new'])) {
        $mn = $_GET['new'];
        if ($mn == 'yes') {
            ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('.newtomeditat').trigger('click');
                });
            </script>
        <?php
        } else {
            //nothing here
        }
    }



    if (is_numeric($fbshareMinutes)) {
        $value = $fbshareMinutes;
    } else {
        $value = " ";
    }
    ?>

    <div id="fbshareMins" style="display:none;"><?php echo $value; ?></div>						
    <?php echo $this->element('timer'); ?> 
    <!-- TIMER CLOSE -->


    <!--    <div class="popup_0_container">
                    <a  href="javascript:void(0);">
                    <div class="start_popup">
                            <div class="start_link">START</div>
                    </div>
                    </a>
            </div>-->
    <!--    <div id="map">
            <img src="/img/map.png" />
        </div>-->
    <div class="" id="popupContainer">
        <div id=""  class="popup_0_container ">
            <?php echo $this->element('top'); ?> 
            <div id=""  class="buttonborder">
                <div id="buttonborder">
                    <a href="javascript:void(0);" class="mainButton start_link">START MEDITATING</a>
                </div>
                <div class="newtomeditat">New to Meditation?</div>
            </div>
            <div class="box">
                <button id="back_to_popup" class="cls_button"></button>
                <p  class="min-title">Learn to Meditate in 7 Days</p>
                <div class="form-bg">
                    <img src="/img/free.png" class="free"/>
                    <div class="popup-header">
                        <div>SIGN UP NOW</div>
                    </div>
                    
                    <div class="sign-up-form">
                        <?php echo $this->Form->create('Mailchimp', array('url' => array('controller' => 'meditations','action' => 'subscribe'))); ?>	
                        <?php echo $this->Form->input('fname', array('placeholder' => "Name:",'label' => false, 'class' => 'minput', 'div' => false)); ?>
                        <?php echo $this->Form->input('email', array('placeholder' => "Email:",'label' => false, 'class' => 'minput', 'div' => false)); ?>
                        <?php echo $this->Form->submit('SIGN ME UP', array('formnovalidate' => true, 'div' => false, 'class' => 'submit-signup')); ?>
                        <div class="box-info">In our free online course you'll become a competent meditator with our easy-to-follow video guides</div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!--        <div id="map">
                    <img src="img/map.png" />
                </div>-->
        <!--------- POP_UP-1 ------------->
        <?php echo $this->element('location'); ?> 
        <?php echo $this->element('meditate_now'); ?> 
        <!--------- END @ POP_UP-1 ------->
        <!---------- POP_UP-2 ------------>
        <?php echo $this->element('meditation_session'); ?> 
        <!--------- END @ POP_UP-2 ------->
        <!----------BANNER_DATE_HOLDER --->
        <?php echo $this->element('feedback'); ?> 
        <?php //echo $this->element('meditation_timer'); ?><!--design isn't created yet, wil be shown when it will be ready -->

        <div class="popup_3_container" style="display:none;">

            <?php echo $this->element('time_frame'); ?> 
        </div>
        <?php
        foreach ($show_default_loc_array as $key => $locat) {
            $ll = explode(',', $locat['latLong']);
            /* foreach($show_default_loc_array as $k => $lo){
              $l = explode(',',$lo['latLong']);
              if($l[0] == $ll[0] && $l[1] == $ll[1] && $l[0] != '0' && $l[1] != '0' && $key != $k){
              $show_default_loc_array[$k]["latLong"] = '0,0';
              }
              } */
            foreach ($result_loc_array as $loc) {
                if ((int) $ll[0] == (int) $loc['latitude'] && $ll[0] != 0 && (int) $ll[1] == (int) $loc['longitude']) {
                    $show_default_loc_array[$key]["latLong"] = '0,0';
                }
            }
        }
        ?>
        <!-- location notification -->
        <div class="map" id="map_container">
            <div id="map1" style="width:100%; height: 500px;"></div>
            <script type="text/javascript">


                var x = 0, y = 0;
                jQuery(function () {
                    markers = [
<?php
//FOR LAST 10 MEDITATING USER 
foreach ($show_default_loc_array as $locat) {
    $ll = explode(',', $locat['latLong']);
    $blue['latitude'] = $ll[0];
    $blue['longitude'] = $ll[1];
    //$locat['latLong'] = (string)((float)$ll[0]).','. (string)((float)($ll[1]+10));
    $latLong = $locat['latLong'];
    $cities = $locat['city'];
    ?>
    {latLng: [<?php echo $latLong; ?>], name: '<?php echo $cities; ?>'},
    <?php
}

//SHOW WHO DOING MEDITATING
foreach ($result_loc_array as $locat) {
    $lats = $locat['latitude'];
    $longs = $locat['longitude'];
    $cities = $locat['city'];
    //$remote_addr = $locat['remote_addr'];
    ?>
    {latLng: [<?php echo $lats; ?>,<?php echo $longs; ?>], name: '<?php echo $cities; ?>'},
    <?php
}
?>
                    ];
    var color = '#<?php echo $color; ?>';
    //var isOk  = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(color);
    var isOk  = /^#[0-9A-F]{6}$/i.test(color)
    console.log(color,isOk)
    if(isOk){
        mapColor = color;
    }else{
        mapColor = '#DBE8A5';
    }
    
                    var palette = [mapColor];//57767E//85B6DE#68B9DEC1D895  old #86A54A
                    generateColors = function () {
                        // alert("hi");
                        var colors = {}, key;
                        for (key in map1.regions) {
                            colors[key] = palette[Math.floor(Math.random() * palette.length)];
                        }
                        return colors;
                    }, map1;
                    var markers = markers
                    ,
                            values3 = {
                            // 0: 'current',
<?php
for ($i = 0; $i <= 50; $i++) {
    echo "{$i}" . ':' . '"medfinish"' . ',';
}
for ($i = 50; $i <= $total_count; $i++) {
    echo "{$i}" . ':' . '"mednow"' . ',';
}
?>

                            };
                    $('image').on("mousemove", function (event) {
                        x = event.clientX;
                        y = event.clientY;
                        $('.jvectormap-tip').css({
                            left:  event.clientX,
                            top:   event.clientY
                         });
                         console.log(x,y)
                    });
                    
                    var map1 = new jvm.Map({
                        map: 'world_mill_en',
                        container: $('#map1'),
                        markers: markers,
                        series: {
                            markers: [{
                                    attribute: 'image',
                                    scale: {
                                        mednow: '/img/dots/green/0.png',
                                        medfinish: '/img/dots/blue/0.png',
                                        current: 'img/dots/green/0.png'
                                    },
                                    values: values3,
                                    /*legend: {
                                     horizontal: true,
                                     cssClass: 'jvectormap-legend-icons',
                                     title: 'Business type'
                                     }*/
                                }],
                            regions: [{
                                    attribute: 'fill'
                                }]

                        },
                        onRegionOver: function (e, code) {
                            return false;
                        },
                        onRegionOut: function (e, code) {
                            // return to normal cursor
                            document.body.style.cursor = 'default';
                        },
                        onMarkerOver: function (e, code) {
                            //$('.jvectormap-tip').css("left", x-500+'px').css('top', y-500+'px').css('position','absolute');;
                        },
                        onMarkerTipShow: function (e, code) {
                            //return false;
                        },
                        onMarkerLabelShow: function (event, label, code) {
                            console.log(label)


                        },
                        scaleColors: ['#C8EEFF', '#0071A4'],
                        normalizeFunction: 'polynomial',
                        hoverOpacity: 0.7,
                        hoverColor: false,
                        backgroundColor: false,
                        zoom: true,
                        zoomOnScroll: false,
                        focusOn: {x: 0.6,
                            y: 0.5,
                            scale: 1
                        },
                        regionStyle: {
                            hover: {
                                fill: '#D5E4B8',
                                "fill-opacity": 1
                            }
                        },
                    });
                    map1.series.regions[0].setValues(generateColors());

                    var i = 0;
                    var j = 0;
                    var src;

                    setTimeout(function () {
                        $('.jvectormap-marker').each(function (k, v) {
                            if (v.href.animVal == '/img/dots/green/0.png') {
                                v.classList.add("green");
                            } else {
                                v.classList.add("blue");
                            }
                        });
                    }, 2000);

                    setInterval(function () {

                        if ($('.green').length) {
                            if ($('.green').attr('href').indexOf("0") >= 0) {
                                $('.green').attr('href', $('.green').attr('href').replace('0', '1'));
                            } else {
                                $('.green').attr('width', "35px");
                                $('.green').attr('href', $('.green').attr('href').replace(i, i + 1));
                                i++;
                                if (i > 16) {
                                    src = $('.green').attr('href').replace(i, 1);
                                    $('.green').attr('href', src);
                                    i = 1;
                                }
                            }
                        }
                        if ($('.blue').length) {
                            if ($('.blue').attr('href').indexOf("0") >= 0) {
                                $('.blue').attr('href', $('.blue').attr('href').replace('0', '1'));
                            } else {
                                $('.blue').attr('width', "35px");
                                $('.blue').attr('href', $('.blue').attr('href').replace(j, j + 1));
                                j++;
                                if (j > 16) {
                                    src = $('.blue').attr('href').replace(j, 1);
                                    $('.blue').attr('href', src);
                                    j = 1;
                                }
                            }
                        }
                    }, 80);

                });
            </script>

        </div>
        <div id="popup_1" class="blank_wrapper1 popup_1">

            <div class="lightModalOverlay">&nbsp;</div>
        </div>
    </div>
</div>
<!--------- END @ BANNER_DATE_HOLDER ------->

<script>!function (d, s, id) {
         var js, fjs = d.getElementsByTagName(s)[0];
         if (!d.getElementById(id)) {
             js = d.createElement(s);
             js.id = id;
             js.src = "https://platform.twitter.com/widgets.js";
             fjs.parentNode.insertBefore(js, fjs);
         }
     }(document, "script", "twitter-wjs");</script>

