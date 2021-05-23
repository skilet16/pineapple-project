<?php

class Home extends Controller
{
  public function index() {
    $homeModel = $this->model('HomeModel');

    // Get error code
    $data["error"] = '';
    if(isset($_GET["error"])) {
      $data["error"] = $homeModel->outputError($_GET["error"]);
    }

    // Validate input from user (email and checkbox) and insert
    if(isset($_POST["email"]) && isset($_POST["terms"])) {
      $validation = $homeModel->validateInput($_POST["email"], $_POST["terms"]);
      if(empty($validation)) {
        $homeModel->addEmail($_POST["email"]);
        header("Location: /success");
      } else {
        header("Location: /?error=".$validation);
      }
    }

    $this->view('home', $data);

  }

}
