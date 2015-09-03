<section class="page-content-container page-footer-bottom">
    <div class="block block-block span12 block-block-13 ">
        <div class="footer-image">
            <div class="footer-logo">The Armenian Institute of International and Security Affairs—AIISA—is  an independent research institute based in Yerevan, pursuing the goal of promoting independent foreign and domestic policy analysis for Armenia anchored in the shared values of human rights, political freedom, and free market.</div>
            <div class="footer-statement padded">
                <p style="margin-bottom:0;">The Armenian Institute of International and Security Affairs—AIISA—is  an independent research institute based in Yerevan, pursuing the goal of promoting independent foreign and domestic policy analysis for Armenia anchored in the shared values of human rights, political freedom, and free market.</p>
                <br>
                <ul>
                    <?php if(!empty($footers['bottom'])){ ?>
                        <?php foreach($footers['bottom'] as $footer){ ?>
                            <li>
                                <a href="/pages/<?php
                                echo preg_replace('/\s+/', '_', strtolower($footer['Footer']['name'])) ?>">
                                       <?php echo __($footer['Footer']['name']); ?>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul><br>
                <ul class="navigation-quinary">
                
                	<li class="odd">
                        <a title=" AIISA Databases " href="#">
                         AIISA Databases 
                        </a>
                    </li>

                  <li class="even">
                    <a title="SAIISA Conflict Charts  " href="#">
                      AIISA Conflict Charts  
                    </a>
                  </li>


                  <li class="odd">
                    <a title="AIISA Security Risk Assessment " href="#">
                     AIISA Security Risk Assessment 
                    </a>
                  </li>
                  
                  <li class="even">
                    <a title=" AIISA Databases " href="#">
                     Improving Security Policy Debates
                    </a>
                  </li>
                  <br>
                  <li style="padding:0px !important;"><span style="margin-top: 8px;">© AIISA 2015 All Rights Reserved &nbsp; &nbsp; Created by <a href="http://suitmedia.ru" target="_blank" style="float:right; margin-left:10px;"> Suit Media</a></span></li>

                  </ul>

                </div>
            </div>
    </div>

</section>