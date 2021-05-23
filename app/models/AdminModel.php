<?php

class AdminModel {
  private $dbConnect;

  public function __construct() {
    $this->dbConnect = new Database;
  }

  public function getEmails($page = 0, $sort = '', $filter = '', $search = '') {
    //Initialize variables
    $filterQuery = $searchQuery = $whereQuery = $andQuery = '';
    $sortQuery ="ORDER BY date_time";

    // Sorting email query
    if(!empty($sort)) {
      if($sort == 'name') {
        $sortQuery = "ORDER BY email";
      }
    }

    // Filtering email query
    if(!empty($filter)) {
      $providerID = $this->dbConnect->query("SELECT id FROM email_providers WHERE provider_name = ?", ucfirst($filter))->fetchArray()["id"];
      if(!empty($providerID)) {
        $filterQuery = "email_provider = ".strval($providerID);
      }
    }

    // Searching email query
    if(!empty($search)) {
      $searchQuery = "email LIKE '%".$search."%'";
    }

    // Get page query
    if(is_int(intval($page)) ) {
      $pageQuery = "LIMIT ".strval(10*$page).", 10";
    } else {
      $pageQuery = "LIMIT 0, 10";
    }

    // Addition queries
    if(!empty($search) || !empty($filter)) {
      $whereQuery = "WHERE";
      if(!empty($search) && !empty($filter)) {
        $andQuery = "AND";
      }
    }

    $emails = $this->dbConnect->query("SELECT * FROM emails $whereQuery $filterQuery $andQuery $searchQuery $sortQuery $pageQuery")->fetchAll();

    $data = array();
    if(!empty($emails)) {
      foreach($emails as $key => $var) {
        $provider = $this->dbConnect->query("SELECT provider_name FROM email_providers WHERE id = ?", $emails[$key]["email_provider"])->fetchArray()['provider_name'];

        array_push($data, array(
          "id" => $emails[$key]["id"],
          "email" => $emails[$key]["email"],
          "email_provider" => $provider,
          "date" => $emails[$key]["date_time"]
        ));
      }
    }
    return $data;
  }

  public function getProviders() {
    $providers = $this->dbConnect->query("SELECT provider_name FROM email_providers")->fetchAll();
    return $providers;
  }

  public function deleteEmail($id) {
    $provider = $this->dbConnect->query("SELECT email_provider FROM emails WHERE id = ? ", $id)->fetchArray()["email_provider"];
    $this->dbConnect->query("DELETE FROM emails WHERE id = ?", $id);

    // Delete provider if there no any emails left with it
    $providerEmails = $this->dbConnect->query("SELECT id FROM emails WHERE email_provider = ?", $provider)->numRows();
    if($providerEmails < 1) {
      $this->dbConnect->query("DELETE FROM email_providers WHERE id = ?", $provider);
    }

  }

  public function exportEmail($idArr) {
    $data = array();
    foreach($idArr as $value){
      $email = $this->dbConnect->query("SELECT * FROM emails WHERE id = ?", $value)->fetchArray();
      $email_provider = $this->dbConnect->query("SELECT provider_name FROM email_providers WHERE id = ?", $email["email_provider"])->fetchArray()["provider_name"];
      array_push($data, array(
        "id" => $email["id"],
        "email" => $email["email"],
        "email_provider" => $email_provider,
        "date" => $email["date_time"]
      ));
    }

    $this->exportCSV($data, "emails");
    die();
  }

  public function exportCSV($array, $filename) {
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="'. $filename .'.csv"');
    ob_start();
    $buffer = fopen("php://output", 'w');
    // Input the name keys of each element or array
    fputcsv($buffer, array_keys(reset($array)));
    // Put the content of an array in each field
    foreach ($array as $field) {
       fputcsv($buffer, $field);
    }

    fclose($buffer);

    echo ob_get_clean();
    die();
  }

  public function createUrl($param) {
    $link = $_SERVER['REQUEST_URI'];
    parse_str($link, $arrayParams);
    foreach($arrayParams as $key => $value) {
      $strPos = strpos($key, $param);
      if($strPos !== false) {
        $link = str_replace("&".$key."=".$value, "", $link);
        $link = str_replace($key."=".$value."&", "?", $link);
        $link = str_replace($key."=".$value."", "?", $link);
      }
    }

    if($link[-1] == "?") {
      $link = $link.$param."=";
    } else {
      $link = $link."&". $param ."=";
    }

    return $link;
  }


}
