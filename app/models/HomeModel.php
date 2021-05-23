<?php

class HomeModel {
  private $dbConnect;

  public function __construct() {
    $this->dbConnect = new Database;
  }

  public function outputError($errorCode) {
    switch($errorCode) {
      case 100:
        return "Email address is required";
      case 101:
        return "Please provide a valid e-mail address";
      case 102:
        return "We are not accepting Please provide a valid e-mail address";
      case 103:
        return "You must accept the terms and conditions";
    }
  }

  public function validateInput($email, $checkbox) {
    if(empty($email)) {
      return 100;
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return 101;
    } else if(substr($email, -3) == ".co") {
      return 102;
    } else if($checkbox != true) {
      return 103;
    }
  }

  public function addEmail($email) {
    $providerName = ucfirst(explode(".", explode("@", $email)[1])[0]);
    $date = date("Y-m-d");
    $email = strtolower($email);

    // Check if provider exists in email_provider if not then insert
    $providerId = $this->dbConnect->query("SELECT id FROM email_providers WHERE provider_name = ?", $providerName)->fetchArray();
    if(empty($providerId)) {
      $this->dbConnect->query("INSERT INTO email_providers (provider_name) VALUES (?)", $providerName);
      $providerId = $this->dbConnect->query("SELECT id FROM email_providers WHERE provider_name = ?", $providerName)->fetchArray();
    }

    // Check if the email exist and if not then insert
    $emailCheck = $this->dbConnect->query("SELECT id FROM emails WHERE email = ?", $email)->fetchArray();
    if(empty($emailCheck)) {
      $this->dbConnect->query("INSERT INTO emails (email, email_provider, date_time) VALUES (?, ?, ?)", $email, $providerId, $date);
    }
  }


}
