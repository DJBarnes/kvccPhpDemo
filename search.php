<?php
echo print_r(findPerson());

  function findPerson() {
    $sql = "SELECT * FROM Person WHERE first LIKE :first AND last LIKE :first";
    try {
      $db = getConnection();
      $stmt = $db->prepare($sql);
      $stmt->bindParam("first", "%" . $_POST['firstSearch'] . "%");
      $stmt->bindParam("last", "%" . $_POST['lastSearch'] . "%");
      echo print_r($stmt);
      $result = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      return $result;
    } catch(PDOException $e) {
      echo '{"error":{"text":' . $e -> getMessage() . '}}';
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
?>