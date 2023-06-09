<?php

class ElementsController extends Controller
{
  public function beforeAction()
  {
    parent::beforeAction();

    Config::setJsConfig("curPage", "vendor");

    $action = $this->request->param("action");
    $actions = ["create", "delete"];
    $this->Security->requireAjax($actions);
    $this->Security->requirePost($actions);

    switch ($action) {
      case "referencetable":
        $this->Security->config("validateForm", false);
        break;
      case "customertable":
        $this->Security->config("validateForm", false);
        break;
      case "customeraddtable":
        $this->Security->config("validateForm", false);
        break;
      case "meetingtable":
        $this->Security->config("validateForm", false);
        break;
      case "reasontable":
        $this->Security->config("validateForm", false);
        break;
      case "streettable":
        $this->Security->config("validateForm", false);
        break;
      case "acctTable":
        $this->Security->config("validateForm", false);
        break;
      case "street":
        $this->Security->config("validateForm", false);
        break;
      case "hbangn":
        $this->Security->config("validateForm", false);
        break;
      case "getrate":
        $this->Security->config("validateForm", false);
        break;
      case "updateRate":
        $this->Security->config("validateForm", false);
        break;
      case "delete":
        $this->Security->config("form", ["fields" => ["file_id"]]);
        break;
    }
  }

  public function reference()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/vendor/reference/", Config::get("VIEWS_PATH") . "vendor/reference.php");
  }

  public function referencetable()
  {
    $draw = $this->request->data("draw");
    $row = $this->request->data("start");
    $rowperpage = $this->request->data("length");
    $column = $this->request->data("order");
    $columnIndex = $column[0]["column"];
    $columns = $this->request->data("columns");
    $columnName = $columns[$columnIndex]["data"];
    $columnSortOrder = $column[0]["dir"];
    $search = $this->request->data("search");
    $searchValue = strtoupper($search["value"]);
    $result = $this->elements->referencetable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->elements->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function customertable()
  {
    $draw = $this->request->data("draw");
    $row = $this->request->data("start");
    $rowperpage = $this->request->data("length");
    $column = $this->request->data("order");
    $columnIndex = $column[0]["column"];
    $columns = $this->request->data("columns");
    $columnName = $columns[$columnIndex]["data"];
    $columnSortOrder = $column[0]["dir"];
    $search = $this->request->data("search");
    $searchValue = strtoupper($search["value"]);
    $result = $this->elements->customertable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->elements->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function meetingtable()
  {
    $draw = $this->request->data("draw");
    $row = $this->request->data("start");
    $rowperpage = $this->request->data("length");
    $column = $this->request->data("order");
    $columnIndex = $column[0]["column"];
    $columns = $this->request->data("columns");
    $columnName = $columns[$columnIndex]["data"];
    $columnSortOrder = $column[0]["dir"];
    $search = $this->request->data("search");
    $searchValue = strtoupper($search["value"]);
    $result = $this->elements->meetingtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->elements->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function reasontable()
  {
    $draw = $this->request->data("draw");
    $row = $this->request->data("start");
    $rowperpage = $this->request->data("length");
    $column = $this->request->data("order");
    $columnIndex = $column[0]["column"];
    $columns = $this->request->data("columns");
    $columnName = $columns[$columnIndex]["data"];
    $columnSortOrder = $column[0]["dir"];
    $search = $this->request->data("search");
    $searchValue = strtoupper($search["value"]);
    $result = $this->elements->reasontable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->elements->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function streettable()
  {
    $draw = $this->request->data("draw");
    $row = $this->request->data("start");
    $rowperpage = $this->request->data("length");
    $column = $this->request->data("order");
    $columnIndex = $column[0]["column"];
    $columns = $this->request->data("columns");
    $columnName = $columns[$columnIndex]["data"];
    $columnSortOrder = $column[0]["dir"];
    $search = $this->request->data("search");
    $searchValue = strtoupper($search["value"]);
    $result = $this->elements->streettable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->elements->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function customeraddtable()
  {
    $plgid = $this->request->data("id_search");
    $result = $this->elements->customeraddtable($plgid);
    if (!$result) {
      $this->view->renderErrors($this->elements->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function acctTable()
  {
    $draw = $this->request->data("draw");
    $row = $this->request->data("start");
    $rowperpage = $this->request->data("length");
    $column = $this->request->data("order");
    $columnIndex = $column[0]["column"];
    $columns = $this->request->data("columns");
    $columnName = $columns[$columnIndex]["data"];
    $columnSortOrder = $column[0]["dir"];
    $search = $this->request->data("search");
    $searchValue = strtoupper($search["value"]);
    $area = $this->request->data("area");
    $result = $this->elements->acctTable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue, $area);
    if (!$result) {
      $this->view->renderErrors($this->elements->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function getrate()
  {
    $kwkod = $this->request->data("kwkod");
    $htkod = $this->request->data("htkod");
    $result = $this->elements->getrate($kwkod, $htkod);
    if (!$result) {
      $this->view->renderErrors($this->elements->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function updateRate()
  {
    $rate = $this->request->data("rate");
    $kwkod = $this->request->data("kwkod");
    $htkod = $this->request->data("htkod");
    $result = $this->elements->updateRate($rate, $kwkod, $htkod);
    if (!$result) {
      $this->view->renderErrors($this->elements->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function street()
  {
    $area = $this->request->data("area");
    $result = $this->elements->street($area);
    if (!$result) {
      $this->view->renderErrors($this->elements->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function hbangn()
  {
    $result = $this->elements->hbangn();
    if (!$result) {
      $this->view->renderErrors($this->elements->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function isAuthorized()
  {
    $action = $this->request->param("action");
    $role = Session::getUserRole();
    $resource = "vendor";

    //only for admin
    Permission::allow("administrator", $resource, "*");

    //only for penilaian
    Permission::allow("penilaian", $resource, "*");

    //only for normal vendor
    Permission::allow("vendor", $resource, ["reference", "street", "acctTable", "streettable", "customertable", "customeraddtable"]);

    return Permission::check($role, $resource, $action);
  }
}