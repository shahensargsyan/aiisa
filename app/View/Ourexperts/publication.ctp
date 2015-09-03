<div class="wrapper">
    <div class="row">
        <section class="page-content-level column page-content-main " id="page-content-main">
            <header class="page-content-container main-title" id="main-title">
                <h1><?php echo $publication['Publication']['title'] ?></h1>
            </header>
            <section class="page-content-container main-content" id="main-content">
                <div class="ds-1col node node-publication view-mode-publication_rp clearfix">
                    <div class="event-meta">
                        <p><i class="fa fa-file-text fa-fw fa-lg"></i>
                            <time datetime="<?php echo $publication['Publication']['date']; ?>"><?php echo date("d F Y",  strtotime($publication['Publication']['date']));?></time>
                        </p>
                    </div>
                    <div class="required-fields group-author-info-wrapper field-group-html-element">
                        <div class="contact expert-author">
                            <div class="individual expert">
                                <div class="field field-name-field-person-photo">
                                    <img src="/system/experts/<?php echo $publication['Expert']['photo']; ?>" width="100" height="100" alt="<?php echo $publication['Publication']['photo_by'];?>">
                                </div>
                                <span class="job-title">
                                    <div class="field field-name-title">
                                        <span class="expert-name">
                                            Author: <a href="/ourexperts/expert/<?php echo $publication['Publication']['expert_id']; ?>"><?php echo $publication['Expert']['first_name'].' '.$publication['Expert']['last_name']; ?></a>
                                        </span>
                                    </div>
                                </span><br>
                                <?php if($publication['Publication']['pdf']){ ?>
                                
                                    <a href="/system/publications/<?php echo $publication['Publication']['pdf']; ?>" class="pdf_download_btn"><span class="pdf_title">PDF Version</span><img src="../../img/pdf_download.ico"></a>
                                <?php }?>
                                <span class="job-title">Topic: <a href="#"><?php echo $publication['Topic']['name']; ?></a></span><br>
                                    <?php if(!empty($regions)){?>
                                    <span class="job-title">Regions: 
                                    <?php foreach ($regions as $key => $value) { ?>
                                        <a href="/research/view/region/<?php echo $value['Region']['id']; ?>"><?php echo $value['Region']['name']; ?></a> ,
                                        <?php }?>
                                    </span><br>
                                    <?php } ?>
                                <span class="job-title">Type: <a href="/research/view/topic/<?php echo $publication['Type']['id']; ?>"><?php echo $publication['Type']['name']; ?></a></span>
                                <span class="job-title">Program: <?php echo $publication['Program']['name']; ?></span>
                                <span class="job-title">Project: <a href="/research/view/project/<?php echo $publication['Project']['id']; ?>"><?php echo $publication['Project']['name']; ?></a></span>
                                
                            </div>
                        </div>
                    </div>
                    <div class="field field-name-field-intro bloquotes">
                        <p>
                           <?php echo $publication['Publication']['intro_text'];?>
                        </p>
                    </div>
                    <div class="field field-name-field-image-main">
                        <div class="file-image">
                            <img src="/system/publications/<?php echo $publication['Publication']['photo']; ?>" width="800" height="460" alt="<?php echo $publication['Publication']['photo_by']; ?>" title="<?php echo $publication['Publication']['photo_by']; ?>">
                            <span class="caption">Photo: <?php echo $publication['Publication']['photo_by']; ?></span>
                        </div>
                    </div>
                    <div class="field field-name-field-body">
                        <?php echo $publication['Publication']['content']; ?>
                    </div>
<!--                    <div class="field field-name-field-document">
                        <a class="file-link-wrapper" href="http://www.chathamhouse.org/sites/files/chathamhouse/field/field_document/20150317UKJapanConferenceReport.pdf" title="20150317UKJapanConferenceReport.pdf">
                            <div class="file file-document">
                                <div class="field-name-field-media-description">
                                    Conference Report: The Role of the Nation-State in Addressing Global Challenges: Japan–UK Perspectives
                                </div>
                                <div class="file-details">
                                    <span class="filetype">pdf</span> | <span class="filesize">385.36 KB</span>
                                </div>
                            </div>
                        </a>
                    </div>-->
                </div>
            </section>
        </section>
    </div>
</div>