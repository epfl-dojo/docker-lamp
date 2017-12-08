Salut !

<?php

$servername = "db";
$username = "root";
$password = "example";
$dbname = "test";

function connect_PDO () {
  global $servername,$username,$password,$dbname;
  return  new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
}

function connect_mysqli () {
  global $servername,$username,$password,$dbname;
   return new mysqli($servername, $username, $password, $dbname);
}

try {
    $pdo = connect_PDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo 'Connection failed : ' . $e->getMessage();
}

function insert_row_mysqli() {
  $sql = "INSERT into utilisateurs VALUES (?, ?)";
  $conn = connect_mysqli();
  if ($stmt = $conn->prepare($sql)) {
      $stmt->execute(["Hadi", "El moussaoui"]);
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

function insert_row_pdo($pdo, $request)
{
  try {
    $query = $pdo->prepare($request);
    $query->execute(["Hadi", "El moussaoui"]);
    echo "Inserted row successfully";
  } catch (Exception $e) {
    echo "Didn't work: $e";
  }
}

$sql = "INSERT into utilisateurs VALUES (?, ?)";
insert_row_pdo($pdo, $sql);


?>
