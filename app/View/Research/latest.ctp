<?php if (count($result)>0) { ?> 
<div class="item-list">
    <ul> 
        <?php
        $first = TRUE;
        foreach ($result as $k => $value) {
         switch ($value["result"]["TYPE"]) {
            case 'comment':?>
                <li class="views-row views-row-1 views-row-odd <?php  echo (count($result)==($k+1))?'views-row-last':''; echo  $first?'views-row-first':''?> ">
                    <aside onclick="location.href = '/ourexperts/comment/<?php echo $value["result"]['id']; ?>'" class="ds-1col node node-publication view-mode-block_teaser clearfix">
                        <div class="field-name-field-image-listing">
                            <img src="/system/expertComments/<?php echo $value["result"]['photo']; ?>" width="300" height="200" alt="">
                        </div>
                        <span class="label"><?php echo $value["result"]['topic_name']; ?></span>
                        <h3 class="secondary-link">
                            <a href="/ourexperts/comment/<?php echo $value["result"]['id']; ?>">
                                <?php 
                                echo  substr($value["result"]['title'], 0,80);
                                echo (strlen($value["result"]['title'])>80)?'...':'';
                                ?>
                            </a>
                        </h3>
                    </aside>
                </li>
            <?php
                break;
            case 'publication':?>
                <li class="views-row views-row-1 views-row-odd <?php  echo (count($result)==($k+1))?'views-row-last':''; echo  $first?'views-row-first':''?> ">
                    <aside onclick="location.href = '/ourexperts/publication/<?php echo $value["result"]['id']; ?>'" class="ds-1col node node-publication view-mode-block_teaser clearfix">
                        <div class="field-name-field-image-listing">
                            <img src="/system/publications/<?php echo $value["result"]['photo']; ?>" width="300" height="200" alt="publication">
                        </div>
                        <span class="label"><?php echo $value["result"]['topic_name']; ?></span>
                        <h3 class="secondary-link">
                            <a href="/ourexperts/publication/<?php echo $value["result"]['id']; ?>">
                                <?php 
                                echo  substr($value["result"]['title'], 0,80);
                                echo (strlen($value["result"]['title'])>80)?'...':'';
                                ?>
                            </a>
                        </h3>
                    </aside>
                </li>
            <?php
                break;
            case 'event': //var_dump($value["result"]);die;?>
                <li class="views-row views-row-1 views-row-odd <?php  echo (count($result)==($k+1))?'views-row-last':''; echo  $first?'views-row-first':''?> ">
                    <aside onclick="location.href = '/events/event/<?php echo $value["result"]['id']; ?>'" class="ds-1col node node-publication view-mode-block_teaser clearfix">
                        <div class="field-name-field-image-listing">
                            <img src="/system/events/<?php echo ($value["result"]['photo'])?$e['Event']['photo']:'default_event.png'; ?>" width="300" height="200" />
                        </div>
                        <span class="label"><?php echo $value["result"]['topic_name']; ?></span>
                        <h3 class="secondary-link">
                            <a href="/events/event/<?php echo $value["result"]['id']; ?>">
                                <?php 
                                echo  substr($value["result"]['title'], 0,80);
                                echo (strlen($value["result"]['title'])>80)?'...':'';
                                ?>
                            </a>
                        </h3>
                    </aside>
                </li>
            <?php
                break;
            default:
                break;
        }
        $first = FALSE;
        }
        ?> 
    </ul>
</div>
<?php 
echo $this->element('paginate_ajax'); 
}