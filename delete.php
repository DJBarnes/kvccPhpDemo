<?php
deletePerson($_GET['id']);

function deletePerson($id) {
  $sql = "DELETE FROM Person WHERE id=:id";
  try {
    $db = getConnection();
    $stmt = $db -> prepare($sql);
    $stmt -> bindParam("id", $id);
    $stmt -> execute();
    $db = null;
    header('Location:index.php?action=delete');
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