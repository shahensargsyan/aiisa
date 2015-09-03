<section id="page-content" class="page-level page-content">
    <div class="wrapper">
        <div class="row">
            <header class="page-content-level page-content-header">
<!--                <div class="breadcrumb">
                    <span class="breadcrumb-link breadcrumb-depth-0 breadcrumb-even breadcrumb-first">
                        <a href="/">Home</a>
                    </span>
                    <i class="fa fa-angle-right"></i>
                    <span class="breadcrumb-link breadcrumb-depth-1 breadcrumb-odd"><a href="/experts">Experts</a>
                    </span>
                    <i class="fa fa-angle-right"></i>
                    <span class="breadcrumb-link breadcrumb-depth-2 breadcrumb-even breadcrumb-last">Glada Lahn</span>
                </div>-->

                <div class="tabs"></div>
            </header>
            <section class="page-content-level column page-content-main " id="page-content-main">
                <header class="page-content-container main-title" id="main-title">
                    <h1><?php echo $expert['Expert']['first_name']." ".$expert['Expert']['last_name']; ?></h1>
                </header>
                <section class="page-content-container drupal-messages" id="drupal-messages"></section>
                <section class="page-content-container main-content" id="main-content">
                    <div class="ds-1col node node-person view-mode-full clearfix">
                        <div class="field field-name-field-job-title"><?php echo $expert['Expert']['job_title'] ?></div>
                        <div id="node-person-full-group-photo-and-contacts" class="group-photo-and-contacts field-group-div">
                            <div class="field field-name-field-person-photo">
                                <img src="/system/experts/<?php echo $expert['Expert']['photo']; ?>" width="240" height="340" alt="<?php echo $expert['Expert']['first_name']." ".$expert['Expert']['last_name']; ?>" title="<?php echo $expert['Expert']['first_name']." ".$expert['Expert']['last_name']; ?>">
                            </div>
                            <div class="expert-node-contact">
                                <div class="label-above">Contact information</div>
                                <div class="contact">
                                    <div class="ds-1col node node-contact view-mode-contact_expert clearfix">
                                        <div class="field field-name-field-contact-email"><?php echo $expert['Expert']['email'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="label-above">Summary</h2>
                        <p><?php echo $expert['Expert']['summary']; ?></p>
                        <h2 class="label-above">Expertise</h2>
                        <ul>
                            <?php
                            if(!empty($expertises)){
                                foreach ($expertises as $key => $value) {
                            ?>
                            <li><?php echo $value['Expertise']['title']; ?></li>
                            <?php  }} ?>
                        </ul>
                        <h2 class="label-above">Experience</h2>
                        <?php
                        if(!empty($experience)){?>
                            <table cellspacing="0" cellpadding="3">
                            <tbody> 
                            <?php
                            foreach ($experience as $key => $value) {
                            ?>
                                <tr>
                                    <td width="100"><?php echo $value['Experience']['from_date'].' '.$value['Experience']['to_date']; ?></td>
                                    <td><?php echo $value['Experience']['title']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                        }
                        ?>
                        <h2 class="label-above">Broadcast experience</h2>
                        <?php echo $expert['Expert']['broadcast_experience'] ?>
                        <h2 class="label-above">Languages</h2>
                        <ul>
                            <?php echo $expert['Expert']['languages'] ?>
                        </ul>
                    </div>

                    
                </section>
            </section>
        </div>
    </div>
</section>