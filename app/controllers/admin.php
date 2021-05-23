<?php

class Admin extends Controller
{
  public function index() {
    $adminModel = $this->model('AdminModel');

    // Intialize variables
    $page = 0;
    $sort = $filter = $search = '';
    $data["sort_link"] = "?sort=";
    $data["filter_link"] = "?filter=";
    $data["page_link"] = "?page=";
    $data["next_page"] = $page+1;
    $data["prev_page"] = $page;

    //Check GET parameters
    if(isset($_GET['sort'])) {
      $sort = $_GET['sort'];
    }
    if(isset($_GET['filter'])) {
      $filter = $_GET['filter'];
    }
    if(isset($_GET['search'])) {
      $search = $_GET['search'];
    }
    if(isset($_GET['page'])) {
      $page = $_GET['page'];
      $data["next_page"] = $page+1;
      if($page-1 < 0) {
        $data["prev_page"] = 0;
      } else {
        $data["prev_page"] = $page-1;
      }
    }

    //Check emails to export
    if(isset($_POST["email_export"]) && !empty($_POST["email_export"])) {
      $adminModel->exportEmail($_POST["email_export"]);
    }


    // Generate links for sorting, filtering and paging
    if(count($_GET) > 1) {
      $data["sort_link"] = $_SERVER['REQUEST_URI'] ."&sort=";
      $data["filter_link"] = $_SERVER['REQUEST_URI'] ."&filter=";
      $data["page_link"] = $_SERVER['REQUEST_URI'] ."&page=";
      if(isset($_GET["sort"])) {
        $data["sort_link"] = $adminModel->createUrl("sort");
      }
      if(isset($_GET["filter"])) {
        $data["filter_link"] = $adminModel->createUrl("filter");
      }
      if(isset($_GET["page"])) {
        $data["page_link"] =  $adminModel->createUrl("page");
      }
    }

    // Get emails and providers
    $data["emails"] = $adminModel->getEmails($page, $sort, $filter, $search);
    $data["providers"] = $adminModel->getProviders();

    $this->view('admin', $data);
  }

  public function delete($id) {
    $adminModel = $this->model('AdminModel');

    if(isset($id) && !empty($id)) {
      $adminModel->deleteEmail($id);
    }

    header("Location: /admin");

  }


}
