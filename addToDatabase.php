<?php
$Person = createPersonObject();
addPerson($Person);

function createPersonObject() {
  $Person->first = $_POST['first'];
  $Person->last = $_POST['last'];
  $Person->countyId = $_POST['countyId'];
  $Person->sex = $_POST['sex'];
  if (isset($_POST['crazy'])) {
    $Person->crazy = $_POST['crazy'];
  } else {
    $Person->crazy = 0;
  }
  return $Person;
}

function addPerson($Person) {
  $sql = "INSERT INTO Person (first, last, countyId, sex, crazy) VALUES (:first, :last, :countyId, :sex, :crazy)";
  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam("first", $Person->first);
    $stmt->bindParam("last", $Person->last);
    $stmt->bindParam("countyId", $Person->countyId);
    $stmt->bindParam("sex", $Person->sex);
    $stmt->bindParam("crazy", $Person->crazy);
    $stmt->execute();
    $Person->id = $db->lastInsertId();
    $db = null;
    header('Location:index.php?action=add');
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