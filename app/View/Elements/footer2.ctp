<footer class="page-level page-footer">
    <div class="block block-block span4 topics block-block-8 ">
      <h2>Topics</h2>
      <?php if(!empty($allTopics)){ ?>
      <ul>
          <?php foreach ($allTopics as $key => $value) { ?>
              <li>
                  <a href="/research/view/topic/<?php echo $key; ?>">
                      <i class="fa fa-angle-right"></i> <?php echo $value; ?>
                  </a>
              </li>
          <?php } ?>
      </ul>
      <?php } ?>
    </div>

    <div class="block block-block span8 regions block-block-9 ">
        <div class="footer2map">
            <h2>Regions</h2>
            <?php if(!empty($allRegions)){ ?>
                <ul>
                     <?php foreach ($allRegions as $key => $value) { ?>
                    <li>
                    <a href="/research/view/topic/<?php echo $key; ?>">
                          <i class="fa fa-angle-right"></i> <?php echo $value; ?>
                      </a>
                    </li>
                     <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
</footer>