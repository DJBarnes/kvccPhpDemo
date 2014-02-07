<?php
$Person = findPerson();
  function getConnection() {
    $dbhost = "barnesbrothers.homeserver.com";
    $dbuser = "p2p";
    $dbpass = "phase6";
    $dbname = "kvccDemo";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
  }

  function getCounties($Person) {
    $sql = "SELECT * FROM County";
    try {
      $db = getConnection();
      $stmt = $db -> query($sql);
      $Counties = $stmt -> fetchAll(PDO::FETCH_OBJ);
      $db = null;
      foreach ($Counties as $County) {
        if ($County->id == $Person->countyId) {
          $result = $result . '<option value='. $County->id .' selected="selected">';
        } else {
          $result = $result . '<option value='. $County->id .'>';
        }
        $result = $result . $County->name;
        $result = $result . "</option>";
      }
      return $result;
    } catch(PDOException $e) {
      echo '{"error":{"text":' . $e -> getMessage() . '}}';
    }
  }

  function findPerson() {
    $id = $_POST['record'];
    $sql = "SELECT * FROM Person WHERE id = :id";
    try {
      $db = getConnection();
      $stmt = $db->prepare($sql);
      $stmt->bindParam("id", $id);
      $stmt->execute();
      $result = $stmt->fetchObject();
      $db = null;
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
  <h2>Edit A Record</h2>
  <fieldset class = "add_record">
    <form name="demo" action="updateRecord.php" method="post">
      <input type="hidden" name="id" value="<?php echo $Person->id;?>">
      <table>
        <tr>
          <td>
            <label>First Name:</label>
          </td>
          <td>
            <input type="text" name="first" id="first" value="<?php echo $Person->first;?>">
          </td>
        </tr>
        <tr>
          <td>
            <label>Last Name:</label>
          </td>
          <td>
            <input type="text" name="last" id="last" value="<?php echo $Person->last;?>">
          </td>
        </tr>
        <tr>
          <td>
            <label>County:</label>
          </td>
          <td>
            <select name="countyId">
              <?php
              echo getCounties($Person);
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>
              <label>Sex:</label>
          </td>
          <td>
            <?php
            if ($Person->sex == 1) {
              echo '<input type="radio" name="sex" value="1" checked="checked">Yes Please!<br /><input type="radio" name="sex" value="0">Not so much!';
            } else {
              echo '<input type="radio" name="sex" value="1">Yes Please!<br /><input type="radio" name="sex" value="0" checked="checked">Not so much!';
            }
            ?>
          </td>
        </tr>
        <tr>
          <td>
              <label>Are you crazy?</label>
          </td>
          <td>
            <?php
            if ($Person->crazy == 0) {
              echo '<input type="checkbox" name="crazy" value="1">';
            } else {
              echo '<input type="checkbox" name="crazy" value="1" checked>';             
            }
            ?>
          </td>
        </tr>
      </table>
      <input type="submit" value="Update">
    </form>
  </fieldset>
</body>