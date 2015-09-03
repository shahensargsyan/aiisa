<div class="row">
<!--    <header class="page-content-level page-content-header">
        <div class="breadcrumb"><span class="breadcrumb-link breadcrumb-depth-0 breadcrumb-even breadcrumb-first"><a href="/">Home</a></span><i class="fa fa-angle-right"></i><span class="breadcrumb-link breadcrumb-depth-1 breadcrumb-odd"><a href="/search">Search</a></span><i class="fa fa-angle-right"></i><span class="breadcrumb-link breadcrumb-depth-2 breadcrumb-even"><a href="/search/site">Search results</a></span><i class="fa fa-angle-right"></i><span class="breadcrumb-link breadcrumb-depth-3 breadcrumb-odd"><a href="/search/site/asia" class="active">asia</a></span><i class="fa fa-angle-right"></i><span class="breadcrumb-link breadcrumb-depth-4 breadcrumb-even"><a href="/search/site/asia?f[0]=im_field_topics%3A77" class="active">Energy</a></span><i class="fa fa-angle-right"></i><span class="breadcrumb-link breadcrumb-depth-5 breadcrumb-odd breadcrumb-last">Americas</span></div>
        <div class="tabs">
        </div>
    </header>-->
    <section class="page-content-level column page-content-main " id="page-content-main">
        <header class="page-content-container main-title" id="main-title">
            <h1> Site</h1>
        </header>
        <section class="page-content-container drupal-messages" id="drupal-messages">
        </section>
        <section class="page-content-container main-content" id="main-content">
            <!--<form class="search-form" action="" method="post" id="search-form" accept-charset="UTF-8" >-->
                <?php
                    echo $this->Form->Create(
                        'Search', array(
                            'url' => array(
                                'controller' => 'contents',
                                'action' => 'search'
                            ),
                            'inputDefaults' => array(
                                'div' => false
                            ),
                        'class' => 'search-form',
                        'id' => "search-form",
                        'accept-charset' => "UTF-8"
                        )
                    );
                    ?>
                    <div class="container-inline form-wrapper" id="edit-basic">
                        <div>
                            <?php
                            echo $this->Form->input(
                                'term', array(
                                    'type' => 'text',
                                    'label' => FALSE,
                                    'class' => 'apachesolr-autocomplete unprocessed form-autocomplete',
                                    'placeholder' => "Search AIISA",
                                    'title' => "Enter the terms you wish to search for.",
                                    'size' => "30",
                                    'maxlength' => "255",
                                    'autocomplete' => "off"
                                )
                            );
                            ?>
                            <!--<input type="text" id="edit-keys" name="keys" value="asia" size="30" maxlength="255" autocomplete="off">-->
                        </div>
                            <?php
                                echo $this->Form->input(
                                    'Search', array(
                                        'type' => 'submit',
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'btn'
                                    ));
                            ?>
                        <!--<input type="submit" id="edit-submit" name="op" value="Search" autocomplete="off">-->
                        <!--<a href="/search/site/asia" class="clear-filters better-form-styling active">Clear</a>-->
                    </div>
            <?php echo $this->Form->end(); ?>    
            
            <div class="solr-sort clearfix">
                <div class="block block-apachesolr-search block-apachesolr-search-sort ">
                    <h2 class="title">Sort by</h2>
                    <div class="item-list">
                        <ul>
                            <li class="first">
                                <a href="" class="active">Relevance</a>
                            </li>
                            <li class="last">
                                <a href="">Latest</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="active-filters clearfix">
                <div class="block block-current-search block-current-search-standard ">
                    <div class="current-search-item current-search-item-text current-search-item-results">
                        <h3 class="">Search found 8 items</h3>
                    </div>
<!--                    <div class="current-search-item current-search-item-active current-search-item-active-items">
                        <div class="item-list">
                            <ul class=""><li class="first">asia</li>
                                <li><a href="/search/site/asia?f[0]=im_field_regions%3A29" rel="nofollow" class=""><img class="remove-filter" src="/sites/default/themes/custom/childship/images/remove-filter.png"> <span class="element-invisible"> Remove Energy filter </span></a>Energy</li>
                                <li class="last"><a href="/search/site/asia?f[0]=im_field_topics%3A77" rel="nofollow" class=""><img class="remove-filter" src="/sites/default/themes/custom/childship/images/remove-filter.png"> <span class="element-invisible"> Remove Americas filter </span></a>Americas</li>
                            </ul>
                        </div>
                    </div>-->
                </div>
            </div>
            
            <div class="facet-wrapper clearfix">
<!--                <div class="block block-facetapi block-facetapi-giiy4zr9gu0zsa0bumw1y9qiipidf1wu">
                    <h2 class="title">Content type</h2>
                    <div class="item-list">
                        <ul class="facetapi-facetapi-checkbox-links facetapi-facet-bundle facetapi-processed" id="facetapi-facet-apachesolrsolr-block-bundle">
                            <li class="leaf first"><label class="element-invisible" for="facetapi-link--6--checkbox"> Apply Event filter </label><input type="checkbox" class="facetapi-checkbox" id="facetapi-link--6--checkbox" autocomplete="off"><a href="" rel="nofollow" class="facetapi-checkbox facetapi-inactive facetapi-makeCheckbox-processed facetapi-disableClick-processed" id="facetapi-link--6">Event (2)<span class="element-invisible"> Apply Event filter </span></a></li>
                            <li class="leaf"><label class="element-invisible" for="facetapi-link--7--checkbox"> Apply Expert comment filter </label><input type="checkbox" class="facetapi-checkbox" id="facetapi-link--7--checkbox" autocomplete="off"><a href="" rel="nofollow" class="facetapi-checkbox facetapi-inactive facetapi-makeCheckbox-processed facetapi-disableClick-processed" id="facetapi-link--7">Expert comment (2)<span class="element-invisible"> Apply Expert comment filter </span></a></li>
                            <li class="leaf last"><label class="element-invisible" for="facetapi-link--8--checkbox"> Apply Publication filter </label><input type="checkbox" class="facetapi-checkbox" id="facetapi-link--8--checkbox" autocomplete="off"><a href="" rel="nofollow" class="facetapi-checkbox facetapi-inactive facetapi-makeCheckbox-processed facetapi-disableClick-processed" id="facetapi-link--8">Publication (4)<span class="element-invisible"> Apply Publication filter </span></a></li>
                        </ul>
                    </div>
                </div>-->
                <div class="block block-facetapi block-facetapi-r3lwvkz0lovbyjsmiquwpyeseofz9xtm">
                    <h2 class="title">Topics</h2>
                    <div class="item-list">
                        <ul class="facetapi-facetapi-checkbox-links facetapi-facet-im-field-topics facetapi-processed">
                            <?php foreach ($allTopics as $key => $value) { ?>
                                <li class="collapsed first last">
                                    <label class="element-invisible" for="facetapi-link--5--checkbox"> Apply <?php echo $value ?> filter </label>
                                    <input type="checkbox" class="facetapi-checkbox" id="facetapi-link--5--checkbox" autocomplete="off">
                                    <a href="" rel="nofollow" class="facetapi-checkbox facetapi-inactive facetapi-makeCheckbox-processed facetapi-disableClick-processed" id="facetapi-link--5">
                                       <?php echo $value ?><span class="element-invisible"> Apply <?php echo $value ?> filter </span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="block block-facetapi block-facetapi-mgbir0pgoyldzh3o4zjwdp5yzvog0ior">
                    <h2 class="title">Regions</h2>
                    <div class="item-list">
                        <ul class="facetapi-facetapi-checkbox-links facetapi-facet-im-field-regions facetapi-processed" id="facetapi-facet-apachesolrsolr-block-im-field-regions">
                            <?php foreach ($allRegions as $key => $value) { ?>
                            <li class="collapsed last">
                                <label class="element-invisible" for="facetapi-link--4--checkbox"> Apply <?php echo $value ?> filter </label>
                                <input type="checkbox" class="facetapi-checkbox" id="facetapi-link--4--checkbox" autocomplete="off">
                                <a href="" rel="nofollow" class="facetapi-checkbox facetapi-inactive facetapi-makeCheckbox-processed facetapi-disableClick-processed" id="facetapi-link--4">
                                    <?php echo $value ?><span class="element-invisible"> Apply <?php echo $value ?> filter </span>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
<!--                <div class="block block-facetapi block-facetapi-dekstwiulsqbttgnxs4gcewiwwxqupjm">
                    <h2 class="title">Departments</h2>
                    <div class="item-list"><ul class="facetapi-facetapi-checkbox-links facetapi-facet-im-field-projects facetapi-processed" id="facetapi-facet-apachesolrsolr-block-im-field-projects"><li class="leaf first"><label class="element-invisible" for="facetapi-link--checkbox"> Apply Asia Programme filter </label><input type="checkbox" class="facetapi-checkbox" id="facetapi-link--checkbox" autocomplete="off"><a href="/search/site/asia?f[0]=im_field_topics%3A77&amp;f[1]=im_field_regions%3A29&amp;f[2]=im_field_projects%3A135" rel="nofollow" class="facetapi-checkbox facetapi-inactive facetapi-makeCheckbox-processed facetapi-disableClick-processed" id="facetapi-link">Asia Programme (1)<span class="element-invisible"> Apply Asia Programme filter </span></a></li>
                            <li class="collapsed last"><label class="element-invisible" for="facetapi-link--2--checkbox"> Apply Energy, Environment and Resources Department filter </label><input type="checkbox" class="facetapi-checkbox" id="facetapi-link--2--checkbox" autocomplete="off"><a href="/search/site/asia?f[0]=im_field_topics%3A77&amp;f[1]=im_field_regions%3A29&amp;f[2]=im_field_projects%3A203" rel="nofollow" class="facetapi-checkbox facetapi-inactive facetapi-makeCheckbox-processed facetapi-disableClick-processed" id="facetapi-link--2">Energy, Environment and Resources Department (6)<span class="element-invisible"> Apply Energy, Environment and Resources Department filter </span></a></li>
                        </ul>
                    </div>
                </div>-->
            </div>
            <?php if(!empty($result)){ ?>
                <?php foreach ($result as $key => $value) { ?>
                    <?php
                        //var_dump($value);die;
                        switch ($value["result"]["TYPE"]) {
                            case 'comment':?>
                                <div class="ds-1col node node-blog node-promoted view-mode-search_result clearfix">
                                    <span class="label">
                                        <span class="type">Expert comment</span>
                                    </span>
                                    <div class="field field-name-title">
                                        <h2><a href="/ourexperts/comment/<?php echo $value["result"]['id']; ?>"><?php echo $value["result"]['title']; ?></a></h2>
                                    </div>
                                    <div class="field field-name-search-body">
                                        <div class="search-body field-name-field-body ds-code-summary">
                                            <p>
                                                <strong><br><?php echo strip_tags ($value["result"]['intro']); ?></strong>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="event-date">
                                        <i class="label-inline fa fa-calendar fa-fw"></i>
                                        <time datetime="<?php echo $value["result"]['date']; ?>"><?php echo date("d F Y",  strtotime($value["result"]['date']));?></time>
                                    </div>
                                    <span class="expert"><?php echo $value["result"]['first_name'].' '.$value["result"]['last_name']; ?></span>
                                </div>
                            <?php
                                break;
                            case 'publication':?>
                                <div class="ds-1col node node-publication node-promoted node-sticky view-mode-search_result clearfix">
                                    <span class="label"><?php echo $value["result"]['topic_name']; ?></span>
                                    <div class="field field-name-title">
                                        <h2><a href="/ourexperts/publication/<?php echo $value["result"]['id']; ?>"><?php echo $value["result"]['title']; ?></a></h2>
                                    </div>
                                    <div class="field field-name-search-body">
                                        <div class="search-body field-name-field-body ds-code-summary">
                                            <?php echo strip_tags ($value["result"]['intro']); ?>
                                        </div>
                                    </div>
                                    <div class="event-date">
                                        <i class="label-inline fa fa-calendar fa-fw"> </i>
                                        <time datetime="<?php echo $value["result"]['date']; ?>"><?php echo date("d F Y",  strtotime($value["result"]['date']));?></time>
                                    </div>
                                    <span class="expert" author-expert=""><?php echo $value["result"]['first_name'].' '.$value["result"]['last_name']; ?></p></span>
                                </div>
                            <?php
                                break;
                            case 'event': //var_dump($value["result"]);die;?>
                                 <div class="ds-1col node node-event view-mode-search_result clearfix">
                                     <!--<span class="label">Invitation Only</span>-->
                                     <span class="label"><?php echo $value["result"]['event_type'];?></span>
                                     <div class="field field-name-title">
                                         <h2><a href="/events/event/<?php echo $value["result"]['id'];?>"><?php echo $value["result"]['title'];?></a></h2>
                                     </div>
                                     <div class="event-date"><i class="label-inline fa fa-calendar fa-fw"></i>
                                         <time datetime="<?php echo $value["result"]['date']; ?>"><?php echo date("d F Y",  strtotime($value["result"]['date']));?></time>
                                     </div>
                                     <div class="event-participant participants">
                                         <i class="fa fa-fw fa-microphone"></i>
                                         <p><?php echo strip_tags ($value["result"]['intro']); ?></p>
                                     </div>
                                 </div>

                            <?php
                                break;
                            default:
                                break;
                        }
                    ?>
                <?php } ?>
                <?php echo $this->element('paginate'); ?>
            <?php } ?>
        </section>
    </section>
</div>