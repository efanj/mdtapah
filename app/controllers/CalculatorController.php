<?php

class CalculatorController extends Controller
{
  public function beforeAction()
  {
    parent::beforeAction();

    Config::setJsConfig("curPage", "calculator");

    $action = $this->request->param("action");
    $actions = ["create", "delete"];
    $this->Security->requireAjax($actions);
    $this->Security->requirePost($actions);

    switch ($action) {
      case "costSubmit":
        $this->Security->config("validateForm", false);
        break;
      case "vendorcostSubmit":
        $this->Security->config("validateForm", false);
        break;
      case "costEdit":
        $this->Security->config("validateForm", false);
        break;
      case "rentSubmit":
        $this->Security->config("validateForm", false);
        break;
      case "vendorRentSubmit":
        $this->Security->config("validateForm", false);
        break;
      case "getCalculation":
        $this->Security->config("validateForm", false);
        break;
      case "delete":
        $this->Security->config("form", ["fields" => ["file_id"]]);
        break;
    }
  }

  public function viewcalcland($siriNo)
  {
    Config::setJsConfig("curPage", "account");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/viewcalcland/", Config::get("VIEWS_PATH") . "calculator/viewcalcland.php", ["siriNo" => $siriNo]);
  }

  public function viewcalcbuilding($siriNo)
  {
    Config::setJsConfig("curPage", "account");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/viewcalcbuilding/", Config::get("VIEWS_PATH") . "calculator/viewcalcbuilding.php", ["siriNo" => $siriNo]);
  }

  public function calcland($siriNo)
  {
    Config::setJsConfig("curPage", "calculator");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/calcland/", Config::get("VIEWS_PATH") . "calculator/calcland.php", ["siriNo" => $siriNo]);
  }

  public function calcbuilding($siriNo)
  {
    Config::setJsConfig("curPage", "calculator");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/calcbuilding/", Config::get("VIEWS_PATH") . "calculator/calcbuilding.php", ["siriNo" => $siriNo]);
  }

  public function calclandvendor($siriNo)
  {
    Config::setJsConfig("curPage", "calculator");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/calclandvendor/", Config::get("VIEWS_PATH") . "calculator/calclandvendor.php", ["siriNo" => $siriNo]);
  }

  public function createRentCalc($siriNo)
  {
    Config::setJsConfig("curPage", "calculator");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/calcbuildingvendor/", Config::get("VIEWS_PATH") . "calculator/calcbuildingvendor.php", ["siriNo" => $siriNo]);
  }

  public function costSubmit()
  {
    $siriNo = $this->request->data("siri_no");
    $akaun = $this->request->data("akaun");
    $comparison = $this->request->data("comparison");
    $breadth_land = $this->request->data("breadth_land");
    $price_land = $this->request->data("price_land");
    $section_one = $this->request->data("section_one");
    $section_two = $this->request->data("section_two");
    $discount = $this->request->data("discount");
    $rental = $this->request->data("rental");
    $even = $this->request->data("even");
    $yearly = $this->request->data("yearly");
    $rate = $this->request->data("rate");
    $tax = $this->request->data("tax");

    $result = $this->calculator->costSubmit(Session::getUserId(), Session::getUserWorkerId(), $siriNo, $akaun, $comparison, $breadth_land, $price_land, $section_one, $section_two, $discount, $rental, $even, $yearly, $rate, $tax);

    if (!$result) {
      $this->view->renderErrors($this->calculator->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function vendorcostSubmit()
  {
    $akaun = $this->request->data("akaun");
    $breadth_land = $this->request->data("breadth_land");
    $price_land = $this->request->data("price_land");
    $total_land = $this->request->data("total_land");
    $adjust_land = $this->request->data("adjust_land");
    $ttl_land = $this->request->data("ttl_land");
    $section = $this->request->data("section");
    $overall = $this->request->data("overall");
    $capital = $this->request->data("capital");
    $round = $this->request->data("round");
    $yearly = $this->request->data("yearly");
    $rate = $this->request->data("rate");
    $tax = $this->request->data("tax");

    $result = $this->calculator->vendorcostSubmit(Session::getUserId(), Session::getUserWorkerId(), $akaun, $breadth_land, $price_land, $total_land, $adjust_land, $ttl_land, $section, $overall, $capital, $round, $yearly, $rate, $tax);

    if (!$result) {
      $this->view->renderErrors($this->calculator->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function costEdit()
  {
    $siriNo = $this->request->data("siri_no");
    $akaun = $this->request->data("akaun");
    $id_land = $this->request->data("id_land");
    $breadth_land = $this->request->data("breadth_land");
    $price_land = $this->request->data("price_land");
    $total_land = $this->request->data("total_land");
    $adjust_land = $this->request->data("adjust_land");
    $ttl_land = $this->request->data("ttl_land");
    $section = $this->request->data("section");
    $overall = $this->request->data("overall");
    $capital = $this->request->data("capital");
    $round = $this->request->data("round");
    $yearly = $this->request->data("yearly");
    $rate = $this->request->data("rate");
    $tax = $this->request->data("tax");

    $result = $this->calculator->costEdit(Session::getUserId(), Session::getUserWorkerId(), $siriNo, $akaun, $id_land, $breadth_land, $price_land, $total_land, $adjust_land, $ttl_land, $section, $overall, $capital, $round, $yearly, $rate, $tax);

    if (!$result) {
      $this->view->renderErrors($this->calculator->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function rentSubmit()
  {
    $siriNo = $this->request->data("siri_no");
    $acctNo = $this->request->data("akaun");
    $comparison = $this->request->data("comparison");
    $breadth_land = $this->request->data("breadth_land");
    $price_land = $this->request->data("price_land");
    $current = $this->request->data("current");
    $discount = $this->request->data("discount");
    $even = $this->request->data("even");
    $yearly = $this->request->data("yearly");
    $rate = $this->request->data("rate");
    $tax = $this->request->data("tax");

    $result = $this->calculator->rentSubmit(Session::getUserId(), Session::getUserWorkerId(), $siriNo, $acctNo, $comparison, $breadth_land, $price_land, $current, $discount, $even, $yearly, $rate, $tax);

    if (!$result) {
      $this->view->renderErrors($this->calculator->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function vendorRentSubmit()
  {
    $acctNo = $this->request->data("akaun");
    $compare = $this->request->data("compare");
    $breadth_land = $this->request->data("breadth_land");
    $price_land = $this->request->data("price_land");
    $total_land = $this->request->data("total_land");

    $main = $this->request->data("main");
    $out = $this->request->data("out");

    $rental = $this->request->data("rental");
    $corner = $this->request->data("corner");
    $round = $this->request->data("round");
    $yearly = $this->request->data("yearly");
    $rate = $this->request->data("rate");
    $tax = $this->request->data("tax");

    $result = $this->calculator->vendorRentSubmit(Session::getUserId(), Session::getUserWorkerId(), $acctNo, $compare, $breadth_land, $price_land, $total_land, $main, $out, $rental, $corner, $round, $yearly, $rate, $tax);

    if (!$result) {
      $this->view->renderErrors($this->calculator->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function getCalculation()
  {
    $siriNo = $this->request->data("siri");
    $form = $this->request->data("form");

    $result = $this->calculator->getCalculation(Session::getUserId(), Session::getUserWorkerId(), $siriNo, $form);

    if (!$result) {
      $this->view->renderErrors($this->calculator->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function isAuthorized()
  {
    $action = $this->request->param("action");
    $role = Session::getUserRole();
    $resource = "calculator";

    //only for admin
    Permission::allow("administrator", $resource, "*");

    //only for normal users
    Permission::allow("user", $resource, "*");

    //only for normal vendor
    Permission::allow("vendor", $resource, ["buildingSubmit", "landSubmit", "getCalculation"]);

    return Permission::check($role, $resource, $action);
  }
}
