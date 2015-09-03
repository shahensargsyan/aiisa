
		  <?php 
		  		$currentPage =$this->Paginator->current($model = null);
		  		$counter =  $currentPage;
				$counter =$counter - 1;
				$counter =($counter*9) + $currentPage;
				if(!empty($condays)){
				foreach($condays as $conday){
			 		$dates = explode(" ",$conday['Meditation']['submitdate']);?>
		  			<div id="innerDays_<?php echo $counter?>" class="innerDays">
					<div class="numberDays">
						<?php echo 'Day: '.$counter;?>
					</div>
					<div class="days">
						<?php echo $dates[0]; $counter++; ?>
					</div>
				</div>
				<?php }
				}
				  else{
					echo "0 Consecutive Days";
				     }
				?>
				<!-- For Pagination -->
				<div class="middle-midd-bottolink" style="margin-bottom:1px;text-align:center;">
					<?php
						$this->Paginator->options(array('update' => '#user_cons_days',
														'evalScripts' => true,
														'url'=> array('action' => 'condaypagination'),
														/*'before' => $this->Js->get('#paging-indicator')->effect('fadeIn', array('buffer' => false)),
														'complete' => $this->Js->get('#paging-indicator')->effect('fadeOut', array('buffer' => false)),*/
						));
						echo $this->Paginator->numbers();	
						echo $this->Js->writeBuffer();?>
				</div>
				<!--Pagination End-->
