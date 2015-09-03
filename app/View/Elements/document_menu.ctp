<?php
$here = substr($this->here, 0,27);

$url = explode('/',$this->here);

$controller = $url[1];
$action = $url[2];
$fill_information = '';
$choose_license = '';
$review_finalize = '';
$pay = '';
$download_pdf = '';
switch ($action) {
    case 'fill_information':

        break;
    case 'choose_license':
        $fill_information = 'completed';

        break;
    case 'pay_contract':
        $fill_information = 'completed';
        $choose_license = 'completed';

        break;
    case 'review_finalize':
        $fill_information = 'completed';
        $choose_license = 'completed';
        $pay = 'completed';
        break;
    case 'download_pdf':
        $fill_information = 'completed';
        $choose_license = 'completed';
        $pay = 'completed';
        $review_finalize = 'completed';
        $download_pdf = '';
        break;

    default:
        break;
}
?>
<ul class="steps">
    <li class="completed">
        <a class="same same-height-left" href="#" style="height: 47px;"><span class="arrow">arrow</span><span>1.</span>Select Document</a>
    </li>
    <li  class="<?php echo $fill_information; ?> <?php echo $this->Html->url(array('controller' => $controller , 'action' => $action)) == $this->Html->url(array('controller' => 'contracts' , 'action' => 'fill_information'))?'current':''?>">
        <a class="same" href="#" style="height: 47px;"><span class="arrow">arrow</span><span>2.</span>Fill-in Information</a>
    </li>
    <li  class="<?php echo $choose_license; ?>  <?php echo $this->Html->url(array('controller' => $controller , 'action' => $action)) == $this->Html->url(array('controller' => 'contracts' , 'action' => 'choose_license'))?'current':''?>">
        <a class="same" href="#" style="height: 47px;"><span class="arrow">arrow</span><span>3.</span>Choose License</a>
    </li>
    <li  class="<?php echo $choose_license; ?>  <?php echo $this->Html->url(array('controller' => $controller , 'action' => $action)) == $this->Html->url(array('controller' => 'contracts' , 'action' => 'pay_contract'))?'current':''?>">
        <a class="same" href="#" style="height: 47px;"><span class="arrow">arrow</span><span>4.</span>Make Payment</a>
    </li>
    <li  class="<?php echo $review_finalize; ?>  <?php echo $this->Html->url(array('controller' => $controller , 'action' => $action)) == $this->Html->url(array('controller' => 'contracts' , 'action' => 'review_finalize'))?'current':''?>">
        <a class="same" href="#" style="height: 47px;"><span class="arrow">arrow</span><span>5.</span>Finalize</a>
    </li>
    <li class="last <?php echo $download_pdf; ?>  <?php echo $this->Html->url(array('controller' => $controller , 'action' => $action)) == $this->Html->url(array('controller' => 'contracts' , 'action' => 'download_pdf'))?'current':''?>">
        <a class="same same-height-right" href="#" style="height: 47px;"><span>6.</span>Download/Print.</a>
    </li>
</ul>
