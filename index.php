<?php
if (isset($_GET['action'])) {
  switch($_GET['action']) {
    case 'add':
      echo "<h2>The record was successfully added</h2>";
      break;
    case 'update':
      echo "<h2>The record was successfully updated</h2>";
      break;
    case 'delete':
      echo "<h2>The record was successfully deleted</h2>";
      break;
  }
}

  function getConnection() {
    $dbhost = "barnesbrothers.homeserver.com";
    $dbuser = "p2p";
    $dbpass = "phase6";
    $dbname = "kvccDemo";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
  }

  function getCounties() {
    $sql = "SELECT * FROM County";
    try {
      $db = getConnection();
      $stmt = $db -> query($sql);
      $People = $stmt -> fetchAll(PDO::FETCH_OBJ);
      $db = null;
      foreach ($People as $Person) {
        $result = $result . "<option value=". $Person->id .">";
        $result = $result . $Person->name;
        $result = $result . "</option>";
      }
      return $result;
    } catch(PDOException $e) {
      echo '{"error":{"text":' . $e -> getMessage() . '}}';
    }
  }

?>
<html>
<head>
</head>
<body>
<div class="demo_add">
  <h2>Add New Record</h2>
  <fieldset class = "add_record">
    <form name="demo" action="addToDatabase.php" method="post">
      <table>
        <tr>
          <td>
            <label>First Name:</label>
          </td>
          <td>
            <input type="text" name="first" id="first">
          </td>
        </tr>
        <tr>
          <td>
            <label>Last Name:</label>
          </td>
          <td>
            <input type="text" name="last" id="last">
          </td>
        </tr>
        <tr>
          <td>
            <label>County:</label>
          </td>
          <td>
            <select name="countyId">
              <?php
              echo getCounties();
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>
              <label>Sex:</label>
          </td>
          <td>
            <input type="radio" name="sex" value="1">Yes Please!<br />
            <input type="radio" name="sex" value="0">Not so much!
          </td>
        </tr>
        <tr>
          <td>
              <label>Are you crazy?</label>
          </td>
          <td>
              <input type="checkbox" name="crazy" value="1">
          </td>
        </tr>
      </table>
      <input type="submit" value="Add New">
    </form>
  </fieldset>
  <h2>Search For A Person</h2>
  <fieldset>
    <form name="search" action="searchResults.php" method="post">
      <table>
        <tr>
          <td>
            <label>First Name:</label>
          </td>
          <td>
            <input type="text" name="firstSearch" id="firstSearch">
          </td>
        </tr>
        <tr>
          <td>
            <label>Last Name:</label>
          </td>
          <td>
            <input type="text" name="lastSearch" id="lastSearch">
          </td>
        </tr>
      </table>
      <input type="submit" value="Search">
    </form>
  </fieldset>
</div>
</body>