<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <style>
      .main-table {
        width: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        margin-top: 200px;
      }
      .main-table table {
        border: 1px solid black;
        text-align: center;
      }
      .main-table table td, th {
        padding: 15px;
        border-bottom: 1px solid black;
      }
    </style>
  </head>
  <body>
    <div class="main-table">
      <div class="table-func">
          <div class="reset">
            Reset all filters
            <a href="/admin"><button>Reset all</button></a>
          </div><br>
          <div class="sort">
            Sort
            <a href="<? echo $data['sort_link'].'date' ?>"><button>Date</button></a>
            <a href="<? echo $data['sort_link'].'name' ?>"><button>Name</button></a>
          </div>
          <br>
          <div class="search">
            <form method="get">
                <label>Search</label>
                <input type="text" name="search">
                <button type="submit">Search</button>
            </form>
          </div>
          <br>
          <div class="provider">
            Providers
            <?php
              foreach ($data["providers"] as $value) {
                echo '<a href="'. $data["filter_link"].strtolower($value["provider_name"]) .'"><button>'. $value["provider_name"] .'</button></a> ';
              }

            ?>

          </div>
      </div>
      <br>
      <table>
        <tr>
          <th>ID</th>
          <th>Email</th>
          <th>Email Provider</th>
          <th>Date</th>
          <th>Delete</th>
          <th>Export CSV</th>
        </tr>
        <form method="post">
        <?php
          foreach ($data["emails"] as $value) {
            echo "<tr>
            <td>". $value["id"] ."</td>
            <td>". $value["email"] ."</td>
            <td>". $value["email_provider"] ."</td>
            <td>". $value["date"] ."</td>
            <td><a href='/admin/delete/". $value["id"] ."'>Delete</a></td>
            <td><input type='checkbox' name='email_export[]' value=". $value["id"] ."></td>
            </tr>";
          }
          ?>
      </table><br>
      <input type="submit" value="Export CSV" name="submit">
    </form><br>
      <div class="pagination">
        <a href="<? echo $data['page_link'].''.strval($data["prev_page"]) ?>"><button><<</button></a>
        <a href="<? echo $data['page_link'].''. strval($data["next_page"]) ?>"><button>>></button></a>
      </div>
  </div>
  </body>
</html>
