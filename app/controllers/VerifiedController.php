<?php

class VerifiedController extends Controller
{
  public function beforeAction()
  {
    parent::beforeAction();

    Config::setJsConfig("curPage", "veified");

    $action = $this->request->param("action");
    $actions = ["create", "delete"];
    $this->Security->requireAjax($actions);
    $this->Security->requirePost($actions);

    switch ($action) {
      case "macthingtable":
        $this->Security->config("validateForm", false);
        break;
    }
  }

  public function isAuthorized()
  {
    $action = $this->request->param("action");
    $role = Session::getUserRole();
    $resource = "verified";

    //only for admin
    Permission::allow("administrator", $resource, "*");

    //only for user
    Permission::allow("penilaian", $resource, "*");

    return Permission::check($role, $resource, $action);
  }
}