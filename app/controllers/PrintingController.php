<?php

class PrintingController extends Controller
{
  public function beforeAction()
  {
    parent::beforeAction();

    Config::setJsConfig("curPage", "printing");

    $action = $this->request->param("action");
    $actions = ["create", "delete"];
    $this->Security->requireAjax($actions);
    $this->Security->requirePost($actions);

    switch ($action) {
      case "datasubmition":
        $this->Security->config("validateForm", false);
        break;
      case "sitereviews":
        $this->Security->config("validateForm", false);
        break;
    }
  }

  public function datasubmition($id)
  {
    $this->view->render(Config::get('VIEWS_PATH') . 'printing/datasubmition.php', ["id" => $id]);
  }

  public function datanilaiansemula()
  {
    $this->view->render(Config::get('VIEWS_PATH') . 'printing/dataNilaianSemula.php');
  }

  public function dataserahannilaiansemula()
  {
    $this->view->render(Config::get('VIEWS_PATH') . 'printing/dataSerahanNilaianSemula.php');
  }

  public function calccomparison($siriNo)
  {
    $this->view->render(Config::get('VIEWS_PATH') . 'printing/calc_comparison.php', ["siriNo" => $siriNo]);
  }

  public function sitereviews($fileId)
  {
    $this->view->render(Config::get('VIEWS_PATH') . 'printing/datareviews.php', ["fileId" => $fileId]);
  }

  public function printjadualall($siriNo)
  {
    $this->view->render(Config::get('VIEWS_PATH') . 'printing/printjadualall.php', ["siriNo" => $siriNo]);
  }



  public function isAuthorized()
  {
    $action = $this->request->param("action");
    $role = Session::getUserRole();
    $resource = "printing";

    //only for admin
    Permission::allow("administrator", $resource, "*");

    //only for normal users
    Permission::allow("penilaian", $resource, "*");

    //only for normal vendor
    Permission::allow("vendor", $resource, ["datasubmition", "datareviews", "getCalculation", "datanilaiansemula", "sitereviews"]);

    return Permission::check($role, $resource, $action);
  }
}
