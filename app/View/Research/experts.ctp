<?php if (count($expertComments)>0) { ?> 
<div class="item-list">
    <ul> 
        <?php
        $first = TRUE;
        foreach ($expertComments as $k => $e) {?> 
            <li class="views-row views-row-1 views-row-odd <?php  echo (count($expertComments)==($k+1))?'views-row-last':''; echo  $first?'views-row-first':''?> ">
                <aside onclick="location.href = '/ourexperts/comment/<?php echo $e['ExpertComment']['id']; ?>'" class="ds-1col node node-publication view-mode-block_teaser clearfix">
                    <div class="field-name-field-image-listing">
                        <img src="/system/expertComments/<?php echo $e['ExpertComment']['photo']; ?>" width="300" height="200" alt="<?php echo $e['ExpertComment']['photo_title']; ?>">
                    </div>
                    <span class="label"><?php echo $e['Topic']['name']; ?></span>
                    <h3 class="secondary-link">
                        <a href="/ourexperts/comment/<?php echo $e['ExpertComment']['id']; ?>">
                            <?php 
                            echo  substr($e['ExpertComment']['title'], 0,80);
                            echo (strlen($e['ExpertComment']['title'])>80)?'...':'';
                            ?>
                        </a>
                    </h3>
                </aside>
            </li>
            

        <?php 
         $first = FALSE;
        } ?> 
    </ul>
</div>
<?php 
echo $this->element('paginate_ajax'); 
}