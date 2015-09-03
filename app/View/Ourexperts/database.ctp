<div class="wrapper">
    <div class="row">
<!--        <header class="page-content-level page-content-header">
            <div class="breadcrumb">
                <span class="breadcrumb-link breadcrumb-depth-0 breadcrumb-even breadcrumb-first"><a href="/">Home</a></span>
                <i class="fa fa-angle-right"></i>
                <span class="breadcrumb-link breadcrumb-depth-1 breadcrumb-odd">Research</span>
                <i class="fa fa-angle-right"></i>
                <span class="breadcrumb-link breadcrumb-depth-2 breadcrumb-even breadcrumb-last">The Role of the Nation-State in Addressing Global Challenges: Japan–UK Perspectives</span>
            </div>
            <div class="tabs">
            </div>
        </header>-->
        <section class="page-content-level column page-content-main " id="page-content-main">
            <header class="page-content-container main-title" id="main-title">
                <h1><?php echo $database['Database']['title'] ?></h1>
            </header>
            <section class="page-content-container main-content" id="main-content">
                <div class="ds-1col node node-publication view-mode-publication_rp clearfix">
                    <div class="event-meta">
                        <p><i class="fa fa-file-text fa-fw fa-lg"></i>
                            <time datetime="<?php echo $database['Database']['created']; ?>"><?php echo date("d F Y",  strtotime($database['Database']['created']));?></time>
                        </p>
                    </div>
                    <div class="required-fields group-author-info-wrapper field-group-html-element">
                        <div class="contact expert-author">
                            <div class="individual expert">
<!--                                <div class="field field-name-field-person-photo">
                                    <img src="/system/databases/<?php echo $database['Expert']['photo_path']; ?>" width="100" height="100">
                                </div>-->
<!--                                <span class="group-expert-title">
                                    <div class="field field-name-title">
                                        <span class="expert-name">
                                            <a href="/ourexperts/expert/<?php echo $database['Database']['expert_id']; ?>"><?php echo $database['Expert']['first_name'].' '.$database['Expert']['last_name']; ?></a>
                                        </span>
                                    </div>
                                </span>-->
                                <!--<span class="job-title">Head, Asia Programme</span>-->
                            </div>
                        </div>
                        <!-- <div class="field field-name-field-external-author">
                            <div class="label-above">Author:&nbsp;</div>
                            <p>Dr Kiyoshi Kurokawa,&nbsp;Sir Adam Roberts,&nbsp;David Steinberg</p>
                        </div>-->
                    </div>
                    <div class="field field-name-field-intro">
                        <h2>Region: <?php  echo $database['Region']['name'];?></h2>
                        <p>
                           <?php  echo $database['Region']['description'];?>
                        </p>
                        <h2>Topic: <?php  echo $database['Topic']['name'];?></h2>
                        <p>
                           <?php  echo $database['Topic']['description'];?>
                        </p>
                    </div>
                    <div class="field field-name-field-image-main">
                        <div class="file-image">
                            <img src="/system/databases/<?php echo $database['Database']['photo_path']; ?>" width="800" height="460" alt="Photo">
                            <span class="caption"> <?php echo $database['Database']['type']; ?></span>
                        </div>
                    </div>
                    <div class="field field-name-field-body">
                        <a href="/system/databases/<?php echo $database['Database']['path']; ?>">Download Database</a>
                        
                        <?php echo $database['Database']['description']; ?>
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