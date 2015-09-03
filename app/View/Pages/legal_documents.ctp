<script src="/js/jquery.mCustomScrollbar.js"></script>
<link type="text/css" rel="stylesheet" href="/css/jquery.mCustomScrollbar.css"/>
<script>
    (function($) {
        $(window).load(function() {
            $(".scrollCont").mCustomScrollbar();
        });
    })(jQuery);
</script>


   
    <?php
    echo $this->Form->create(array('class' => 'searchForm col-md-4 padLeft0'));
    echo $this->Form->input('search', array(
        'label' => false,
        'placeholder' => 'Search...'
    ));
    echo $this->Form->submit('', array('div' => false));
    echo $this->Form->end();
    ?>        
    <div class="row">
        <?php foreach ($data as $category) { ?>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="box">
                    <header><?php echo __($category['Category']['name']); ?></header>
                    <div class="scrollCont">
                    <ul>
                        <?php
                        $contract_name = explode(',', $category[0]['name']);
                        $contract_id = explode(',', $category[0]['id']);
                        $i = 0;
                        while (isset($contract_name[$i])) {?>
                            <li>
                                <a href="/<?php echo preg_replace('/\s+/', '_', strtolower($contract_name[$i])); ?>"> <?php echo __($contract_name[$i]) ?>
                                </a>
                            </li>
                            <?php $i++;
                        } ?>
                    </ul>
                    </div>
                </div>
            </div>
<?php } ?>
    </div>



