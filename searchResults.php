<html>
<head>
</head>
<body>
<?php
createSearchResults();

  function createSearchResults() {
    $SearchResults = findPerson();
    $HTML = '<form id="searchResults" name="searchResults" action="editForm.php" method="post"><table><tr><td>First Name</td><td>Last Name</td><td>County</td><td>Sex</td><td>Crazy</td><td>Select</td></tr>';
    foreach ($SearchResults as $Person) {

      $CountyId = $Person['countyId'];
      $County = getCounty($CountyId)['name'];


      if ($Person['sex'] == 0) {
        $sexResult = "Um No!";
      } else {
        $sexResult = "Yes Please!";
      }

      if ($Person['crazy'] == 0) {
        $crazyResult = "No";
      } else {
        $crazyResult = "Yes";
      }

      $HTML = $HTML . "<tr><td>" . $Person['first'] . "</td>"; 
      $HTML = $HTML . "<td>" . $Person['last'] . "</td>";
      $HTML = $HTML . "<td>" . $County . "</td>";
      $HTML = $HTML . "<td>" . $sexResult . "</td>";
      $HTML = $HTML . "<td>" . $crazyResult . "</td>";
      $HTML = $HTML . '<td><input required type=radio name="record" value="' . $Person['id'] . '"></td></tr>';

    }
    $HTML = $HTML . '</table><input type="submit" name="edit" value="Edit"><input type="submit" name="delete" value="Delete"></form><form method="get" action="index.php"><button type="submit" name="return" value="Return">Return</button></form>';
    echo $HTML;
  }

  function findPerson() {
    $sql = "SELECT * FROM Person WHERE first LIKE :first AND last LIKE :last";
    $first = $_POST['firstSearch'] . "%";
    $last = $_POST['lastSearch'] . "%";
    try {
      $db = getConnection();
      $stmt = $db->prepare($sql);
      $stmt->bindParam("first", $first);
      $stmt->bindParam("last", $last);
      $stmt->execute();
      $result = $stmt->fetchAll();
      $db = null;
      return $result;
    } catch(PDOException $e) {
      echo '{"error":{"text":' . $e -> getMessage() . '}}';
    }
  }

function getCounty($id) {
    $sql = "SELECT * FROM County WHERE id = :id";
    try {
      $db = getConnection();
      $stmt = $db->prepare($sql);
      $stmt->bindParam("id", $id);
      $stmt->execute();
      $result = $stmt->fetch();
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
</body>
</html>