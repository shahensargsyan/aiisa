<div class="row">
    <header class="page-content-level page-content-header">
        <div class="breadcrumb">
            <span class="breadcrumb-link breadcrumb-depth-0 breadcrumb-even breadcrumb-first">
                <a href="/">Home</a>
            </span>
            <i class="fa fa-angle-right"></i>
            <span class="breadcrumb-link breadcrumb-depth-1 breadcrumb-odd"><a href="/events">Events</a></span>
            <i class="fa fa-angle-right"></i>
            <span class="breadcrumb-link breadcrumb-depth-2 breadcrumb-even breadcrumb-last"><?php echo $event['EventType']['name']; ?></span>
        </div>
    </header>
    <section class="page-content-level column page-content-main " id="page-content-main">
<!--        <header class="page-content-container main-title" id="main-title">
        </header>-->
        <section class="page-content-container drupal-messages" id="drupal-messages">
        </section>
        <section class="page-content-container main-content" id="main-content">
            <div class="ds-1col node node-event view-mode-full clearfix">
                <div class="field field-name-field-event-date">
                    <div class="date-calendardate date-calendardate-date-square">
                        <p class="date-calendardate-day"><?php echo date("d",  strtotime($event['Event']['event_date']));?></p>
                        <p class="date-calendardate-month"><?php echo date("M",  strtotime($event['Event']['event_date']));?></p>
                    </div>
                </div>
                <div class="label-reversed">
                    <p class="event-label"><?php echo $event['EventType']['name']; ?></p>
                </div>
                <h1 class="smaller-h1"><?php echo $event['Event']['title']; ?></h1>
                <div id="node-event-full-group-event-meta" class="group-event-meta event-meta">
                    <p class="event-date">
                        <time datetime="<?php echo date("d M Y",  strtotime($event['Event']['event_date']));?>">
                             <?php echo date("d M Y",  strtotime($event['Event']['event_date']));?> - 
                             <span class="date-display-start"><?php echo $event['Event']['from_time']; ?></span>
                             to <span class="date-display-end"><?php echo $event['Event']['to_time']; ?></span>
                        </time></p>
                    <span class="location"><p><?php echo $event['Event']['location']; ?></p>
                    </span>
                </div>
                <h2 class="label-above">Participants</h2>
                <div class="label-big">
                    <div class="event-speaker author">
                        <p>
                            <strong><?php echo $event['Event']['participants']; ?>,</strong> 
                            <?php echo $event['Event']['participant_job_title']; ?><br>
                            <!--<strong>Kate Nevens,</strong> Head of MENA, Saferworld<br><strong>Baraa Shiban,</strong> Yemen Project Coordinator, Reprieve UK<br><strong>Chair: Sebastian Usher,</strong> Middle East Editor, BBC World Service</p>-->
                    </div>
                </div>
                <?php if(!isset($userDb)){ ?>
                <div class="button-reversed special">
                    <a href="/users/login">Log in to register</a>
                </div>
                <?php }else{ ?>
                <div class="button-reversed special">
                    <a href="/events/register/<?php echo $event['Event']['id']; ?>">Register to event</a>
                </div>
                <?php } ?>
                <h2 class="label-above">Overview</h2>
                <p>
                    <?php echo $event['Event']['overview']; ?>
                    <br><br>
                </p>
                <div class="contact">
                    <p class="label-above label">Event contact</p>
                    <div class="ds-1col node node-contact view-mode-contact_event clearfix">
                        <h2><?php echo $event['EventType']['name']; ?> Events Team</h2>
                        <span class="email">
                            <a href="/events/contact/<?php echo $event['Event']['id']; ?>">Email</a>
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
