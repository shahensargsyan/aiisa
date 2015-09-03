<?php if (count($publications)>0) { ?> 
<div class="item-list">
    <ul> 
        <?php
        $first = TRUE;
        foreach ($publications as $k => $e) {?> 
            <li class="views-row views-row-1 views-row-odd <?php  echo (count($publications)==($k+1))?'views-row-last':''; echo  $first?'views-row-first':''?> ">
                <aside onclick="location.href = '/ourexperts/publication/<?php echo $e['Publication']['id']; ?>'" class="ds-1col node node-publication view-mode-block_teaser clearfix">
                    <div class="field-name-field-image-listing">
                        <img src="/system/publications/<?php echo $e['Publication']['photo']; ?>" width="300" height="200" alt="<?php echo $e['Publication']['photo_by']; ?>">
                    </div>
                    <span class="label"><?php echo $e['Topic']['name']; ?></span>
                    <h3 class="secondary-link">
                        <a href="/ourexperts/publication/<?php echo $e['Publication']['id']; ?>">
                            <?php 
                            echo  substr($e['Publication']['title'], 0,80);
                            echo (strlen($e['Publication']['title'])>80)?'...':'';
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