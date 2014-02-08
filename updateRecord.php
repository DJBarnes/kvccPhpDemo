<?php
$Person = createPersonObject();
updatePerson($Person);

function createPersonObject() {
  $Person->id = $_POST['id'];
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

function updatePerson($Person) {
  $sql = "UPDATE Person set first = :first, last = :last, countyId = :countyId, sex = :sex, crazy = :crazy WHERE id = :id";
  try {
    $db = getConnection();
    $stmt = $db->prepare($sql);
    $stmt->bindParam("id", $Person->id);
    $stmt->bindParam("first", $Person->first);
    $stmt->bindParam("last", $Person->last);
    $stmt->bindParam("countyId", $Person->countyId);
    $stmt->bindParam("sex", $Person->sex);
    $stmt->bindParam("crazy", $Person->crazy);
    $stmt->execute();
    $db = null;
    header('Location:index.php?action=update');
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