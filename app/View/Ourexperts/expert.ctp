<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery( "#tabs" ).tabs();
}); 
</script>
<div class="row">
    <header class="page-content-level page-content-header">
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
            <div class="block block-quicktabs block-quicktabs-expert-node-tabbed-content ">
                <div id="quicktabs-expert_node_tabbed_content" class="quicktabs-wrapper quicktabs-style-nostyle jquery-once-3-processed">
                    <div class="item-list" id="tabs">
        
                        <ul class="quicktabs-tabs quicktabs-style-nostyle">
                          <li><a href="#publications">Publications</a></li>
                          <li><a href="#expert_comment">Expert comment</a></li>
                        </ul>
                        <div id="publications">
                            <div id="quicktabs-container-expert_node_tabbed_content" class="quicktabs_main quicktabs-style-nostyle">
                                <div id="quicktabs-tabpage-expert_node_tabbed_content-0" class="quicktabs-tabpage">
                                    <div class="view view-expert-quicktabs-content view-id-expert_quicktabs_content view-display-id-block_4 view-dom-id-c2ae9f2e3e1e65a81094fcb60dc26747">
                                        <div class="views-row views-row-1 views-row-odd views-row-first views-row-last item-list-simple publications-rich-text">
                                            <?php if(!empty($publications)){ ?>
                                            <ul>
                                                <?php foreach ($publications as $key => $value) { ?>
                                                <li>
                                                    <a href="/ourexperts/publication/<?php echo $value['Publication']['id']; ?>" target="_blank">
                                                        <img src="/system/publications/<?php echo $value['Publication']['photo']; ?>" width="100" height="100" alt="PHOTO">
                                                        <?php echo $value['Publication']['title']; ?><i class="fa"></i>
                                                    </a>
                                                    &nbsp;<?php echo $value['Publication']['title']; ?>, <?php echo date("F Y",  strtotime($value['Publication']['created'])); ?>
                                                </li>
                                                <?php } ?>
                                            </ul> 
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div id="expert_comment">
                              <div id="quicktabs-container-expert_node_tabbed_content" class="quicktabs_main quicktabs-style-nostyle">
                                <div id="quicktabs-tabpage-expert_node_tabbed_content-0" class="quicktabs-tabpage">
                                    <div class="view view-expert-quicktabs-content view-id-expert_quicktabs_content view-display-id-block_4 view-dom-id-c2ae9f2e3e1e65a81094fcb60dc26747">
                                        <div class="views-row views-row-1 views-row-odd views-row-first views-row-last item-list-simple publications-rich-text">
                                            <?php if(!empty($expertComments)){ ?>
                                            <ul>
                                                <?php foreach ($expertComments as $key => $value) { ?>
                                                <li>
                                                    <a href="/ourexperts/comment/<?php echo $value['ExpertComment']['id']; ?>" target="_blank">
                                                        <img src="/system/expertComments/<?php echo $value['ExpertComment']['photo']; ?>" width="100" height="100" alt="PHOTO">
                                                        <?php echo $value['ExpertComment']['title']; ?><i class="fa"></i></a>
                                                    &nbsp;<?php echo $value['ExpertComment']['title']; ?>, <?php echo date("F Y",  strtotime($value['ExpertComment']['created'])); ?>
                                                </li>
                                                <?php } ?>
                                            </ul> 
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                      </div>
                    </div>
                </div>
        </section>
    </section>
</div>

