<script type="text/javascript">
function loadPiece(href,divName) {
    jQuery(divName).load(href, {}, function(){ 
        var divPaginationLinks = divName+" #pagination a"; 
        jQuery(divPaginationLinks).click(function() {      
            var thisHref = jQuery(this).attr("href"); 
            loadPiece(thisHref,divName); 
            return false; 
        }); 
    });     
}
</script>


<script type="text/javascript"> 
jQuery(document).ready(function() { 
    loadPiece("<?php echo  $this->Html->url(array('controller'=>'account','action'=>'latest',$type,$id));?>","#latest"); 
    loadPiece("<?php echo  $this->Html->url(array('controller'=>'account','action'=>'experts',$type,$id));?>","#expert_comment"); 
    loadPiece("<?php echo  $this->Html->url(array('controller'=>'account','action'=>'publications',$type,$id));?>","#research_publications"); 
    loadPiece("<?php echo  $this->Html->url(array('controller'=>'account','action'=>'past_events',$type,$id));?>","#past_events"); 
    loadPiece("<?php echo  $this->Html->url(array('controller'=>'account','action'=>'videos',$type,$id));?>","#videos"); 
     jQuery( "#tabs" ).tabs();
}); 
</script> 
<div class="row">
    <header class="page-content-level page-content-header">
    <div class="breadcrumb">
        <span class="breadcrumb-link breadcrumb-depth-0 breadcrumb-even breadcrumb-first">
            <a href="/users/account">Home</a>
        </span>
        <i class="fa fa-angle-right"></i>
        <span class="breadcrumb-link breadcrumb-depth-1 breadcrumb-odd breadcrumb-last">Subscribed <?php echo $type;?>s</span>
    </div>
    <div class="tabs"></div>
    </header>
    <section class="page-content-level column page-content-main section_index_region" id="page-content-main">
        <header class="page-content-container main-title" id="main-title">
            <h1 class="has-content-alongside">Subscribed <?php echo $type;?>s</h1>
        </header>
        <section class="page-content-container drupal-messages" id="drupal-messages"></section>
        <div id="page-pre-title">
            <div class="field field-type-image">
                <img src="http://www.chathamhouse.org/sites/files/chathamhouse/field/field_region_page_image/map-americas.png" width="700" height="400" alt="Map of the Americas"> </div>
        </div>
        <section class="page-content-container main-content" id="main-content">
            
            <div class="ds-1col node node-section-index view-mode-section_index_region clearfix">
                <div class="field field-name-field-intro">
                    <p><?php //echo $description; ?></p>
                </div>
<!--                <div class="field field-name-field-intro"><p>Chatham House research on the Americas concentrates predominantly on the changing role of the US in the world. Projects on this region include work on the future of American power, the changing role of the US in Asia, US and European perspectives on common economic challenges, the foreign policy implications of the US energy revolution and global perceptions of the US among elites and the general public.</p></div>
                    <section class="featured-listing"><article class="features featured-highlight three-listing"><div class="feature listing-item view-mode_featured_teaser" onclick="location.href = '/section_highlight/governor-scott-walker-economic-partnerships'">
                                <div class="field field-name-field-image-highlight"><img src="http://www.chathamhouse.org/sites/files/chathamhouse/styles/main_image_800x460/public/20150211Walker_0.jpg?itok=AL8mt87F" width="800" height="460" alt="Building Global Partnerships for Stronger Local Economies" title="Building Global Partnerships for Stronger Local Economies"></div><div id="node-section-highlight-featured-teaser-group-featured-link-text" class="link-text"><p class="label">Event Video</p><h2>Governor Scott Walker on Economic Partnerships</h2><div class="body-text"><p>In a wide-ranging discussion, Wisconsin Governor Scott Walker shared his approach to governance and his views on building strong economic partnerships internationally and for local communities.</p></div></div></div>
                        </article><article class="features featured-highlight three-listing"><div class="feature listing-item view-mode_featured_teaser" onclick="location.href = '/section_highlight/obamas-strategic-patience-remains-ill-defined'">
                                <div class="field field-name-field-image-highlight"><img src="http://www.chathamhouse.org/sites/files/chathamhouse/styles/main_image_800x460/public/field/field_image_main/20150209Obama.jpg?itok=7ke-ukIv" width="800" height="460" alt="President Barack Obama walks on the South Lawn of the White House on 6 February 2015. Photo by Getty Images." title="President Barack Obama walks on the South Lawn of the White House on 6 February 2015. Photo by Getty Images."></div><div id="node-section-highlight-featured-teaser-group-featured-link-text--2" class="link-text"><p class="label">Expert Comment</p><h2>Obama's 'Strategic Patience' Remains Ill-Defined</h2><div class="body-text"><p>The new US National Security Strategy defends the Obama administration’s foreign policy restraint, but struggles to identify its limits, write Adam Quinn and Jacob Parakilas.</p></div></div></div>
                        </article><article class="features featured-highlight three-listing"><div class="feature listing-item view-mode_featured_teaser" onclick="location.href = '/section_highlight/us-and-india-best-still-yet-come'">
                                <div class="field field-name-field-image-highlight"><img src="http://www.chathamhouse.org/sites/files/chathamhouse/styles/main_image_800x460/public/field/field_image_main/20150127ObamaModi.jpg?itok=dyPfBTzN" width="800" height="460" alt="Indian Prime Minister Narendra Modi and US President Barack Obama leave after speaking during the India-US Business Summit in New Delhi on 26 January 2015. Photo by Getty Images." title="Indian Prime Minister Narendra Modi and US President Barack Obama leave after speaking during the India-US Business Summit in New Delhi on 26 January 2015. Photo by Getty Images."></div><div id="node-section-highlight-featured-teaser-group-featured-link-text--3" class="link-text"><p class="label">Expert Comment</p><h2>US and India: The Best is (Still) Yet to Come</h2><div class="body-text"><p>The US-India relationship is full of potential, but until there is a sustained commitment from the countries’ leaders, it will remain largely unrealized, writes Xenia Wickett.</p></div></div></div>
                        </article>
                    </section>-->
                
                
                <!--<h2 class="label-above">Explore Americas</h2>-->
                <div class="automated-content-tabs ui-tabs ui-widget ui-widget-content ui-corner-all">
                    <div id="tabs" class="item-list">
                        <ul class="automated-content-tabs-tabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
                          <li class="ui-state-default ui-corner-top"><a href="#latest">Latest (<?php echo $latest_count ?>)</a></li>
                          <li class="ui-state-default ui-corner-top"><a href="#expert_comment">Expert Comment (<?php echo $exp_count ?>)</a></li>
                          <li class="ui-state-default ui-corner-top"><a href="#research_publications">Publications (<?php echo $pub_count; ?>) </a></li>
                          <li class="ui-state-default ui-corner-top"><a href="#past_events">Past events (<?php echo $ev_count ?>) </a></li>
                          <li class="ui-state-default ui-corner-top"><a href="#videos">VIDEO & AUDIO  (<?php echo $v_count ?>) </a></li>
                        </ul>

                        <div class="view view-section-index-auto-content-listing view-id-section_index_auto_content_listing view-display-id-default view-dom-id-e572e78fb04b7171e9a3bb044813cdb8 ui-tabs-panel ui-widget-content ui-corner-bottom" id="fragment-0" aria-labelledby="ui-id-1" role="tabpanel" aria-expanded="true" aria-hidden="false">
                            <div id="latest">

                            </div>
                            <div id="expert_comment">

                            </div>
                            <div id="research_publications">

                            </div>
                            <div id="past_events">

                            </div>
                            <div id="videos">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>



 
