<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <?php $info = $this->controller->informations->getSubmitionInfo($siriNo); ?>
      <?php $calc = $this->controller->informations->getCalculationInfo($siriNo); ?>
      <?php print_r(sizeof($calc)); ?>
      <?php print_r($info); ?>
    </div>
  </div>