<div class="row">
<!--    <header class="page-content-level page-content-header">
        <div class="breadcrumb"><span class="breadcrumb-link breadcrumb-depth-0 breadcrumb-even breadcrumb-first breadcrumb-last"><a href="/">Home</a></span></div>
        <div class="tabs">
        </div>
    </header>-->
    <section class="page-content-level column page-content-main " id="page-content-main">
        <header class="page-content-container main-title" id="main-title">
            <h1> Events</h1>
        </header>
        <section class="page-content-container drupal-messages" id="drupal-messages">
        </section>
        <section class="page-content-container main-content" id="main-content">
            <div class="view view-events view-id-events view-display-id-forthcoming view-events-listing view-dom-id-2c53e95d5fee8c7551bf45ede9ad6384">
                <div class="view-header">
                    <ul class="events tabs">
                        <li class="<?php echo (!$past)?'active':'' ?>"><a href="/events/index/<?php echo $id; ?>" class="<?php echo !$past?'active':'' ?>">Forthcoming Events <?php echo (!$past)?'('.$count.')':'' ?></a></li>
                        <li class="<?php echo ($past)?'active':'' ?>"><a href="/events/index/<?php echo $id?$id:'0'; ?>/past" class="<?php echo $past?'active':'' ?>">Search past events <?php echo ($past)?'('.$count.')':'' ?></a></li>
                    </ul>
                </div>

                <div class="view-filters">
                    <div class="filter-container"> <h2 class="toggle"><a href="#views-exposed-form-in-the-news-in-the-news-listing" class="show-filters">Show filters</a></h2></div>
                    <?php
                        echo $this->Form->create(
                                'Event', array(
                                    'url' => array('controller' => 'events','action' => 'index',$id,$past),
                                    'inputDefaults' => array(
                                        'label' => false
                                    ),
                                    'id' => "user-login"
                                )
                            );
                        ?>
                        <div class="views-exposed-form">
                            <div class="views-exposed-widgets clearfix">
                                <div id="edit-field-publication-type-value-wrapper" class="views-exposed-widget views-widget-filter-field_publication_type_value">
                                    <label for="edit-field-publication-type-value">
                                         Event type          
                                    </label>
                                    <div class="views-widget">
                                        <div id="edit-field-publication-type-value" class="form-radios bef-select-as-radios">
                                        <div>
                                            <input <?php echo (isset($this->request->data["date"]["event_type"]) && $this->request->data["date"]["event_type"]=="All")?'checked="checked"':''; ?> class="bef-select-as-radios" type="radio" id="edit-field-publication-type-value-all" name="date[event_type]" value="All" autocomplete="off">
                                            <label class="option" for="edit-field-publication-type-value-all">- Any - </label>
                                        </div>
                                            <?php 
                                            foreach ($eventTypes as $key => $value) { 
                                                $checked = '';
                                                if(isset($this->request->data["date"]["event_type"]) && $this->request->data["date"]["event_type"] == $key){
                                                    $checked = 'checked="checked"';
                                                } ?>
                                                <div>
                                                    <input <?php echo $checked; ?> class="bef-select-as-radios" type="radio" id="edit-field-publication-type-value-<?php echo $key; ?>"  name="date[event_type]" value="<?php echo $key; ?>"  autocomplete="off"> 
                                                    <label class="option" value="<?php echo $key; ?>" for="edit-field-publication-type-value-<?php echo $key; ?>"><?php echo $value; ?></label>
                                                </div>
                                            <?php } ?>
                                        </div> 
                                    </div>
                                </div>
                                
                                <?php echo $this->element('sort_date'); ?>
                                <?php echo $this->element('sort_topic'); ?>
                                <?php echo $this->element('sort_region'); ?>
                                
                                <div class="views-exposed-widget views-submit-button">
                                    <input type="submit" id="edit-submit-events-views-exposed-form-events-forthcoming" name="" value="Filter" autocomplete="off"><input id="views-exposed-form-events-forthcoming--tab" type="hidden" name="tab" value="" autocomplete="off">
                                </div>
                                <div class="views-exposed-widget views-reset-button">
                                    <input type="submit" id="edit-reset" name="op" value="Clear" autocomplete="off">     
                                </div>
                            </div>
                        </div>
                    </form>    
                </div>



                <div class="item-list"> 
                    <?php if(!empty($events)){ ?>
                    <ul>    
                        <?php foreach ($events as $key => $value) { ?>
                                
                        <li class="views-row views-row-1 views-row-odd views-row-first">
                            <div onclick="location.href = '/events/event/<?php echo $value['Event']['id']; ?>'" class="ds-1col node node-event view-mode-event_listing_teaser clearfix">

                                <div class="field field-name-field-event-date">
                                    <div class="date-calendardate date-calendardate-date-square">
                                        <p class="date-calendardate-day"><?php echo date("d",  strtotime($value['Event']['event_date']));?></p>
                                        <p class="date-calendardate-month"><?php echo date("M",  strtotime($value['Event']['event_date']));?></p>
                                    </div>
                                </div>
                                <div id="node-event-event-listing-teaser-group-right" class="event-text-listing">
                                    <div class="event-flags"><?php echo $value['EventType']['name']; ?></div>
                                    <div class="field field-name-title"><?php echo $value['Event']['title']; ?></div>
                                    <div class="event-date">
                                        <i class="label-inline fa fa-calendar fa-fw"> </i>
                                        <time datetime="<?php echo date("d M Y",  strtotime($value['Event']['event_date']));?>">
                                            <?php echo date("d M Y",  strtotime($value['Event']['event_date']));?> - 
                                            <span class="date-display-start"><?php echo $value['Event']['from_time']; ?></span>
                                            to <span class="date-display-end"><?php echo $value['Event']['to_time']; ?></span>
                                        </time>
                                    </div>
                                    <div class="event-location">
                                        <i class="label-inline fa fa-map-marker fa-fw"> </i><?php echo $value['Event']['location']; ?></div>
                                    <div class="event-participants">
                                        <i class="label-inline fa fa-microphone fa-fw"> </i>
                                        <strong><?php echo $value['Event']['participants']; ?></strong>, <?php echo $value['Event']['participant_job_title']; ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </div>

                <h2 class="element-invisible">Pages</h2>
                <?php echo $this->element('paginate'); ?>  
            </div>   
        </section>
    </section>
</div>