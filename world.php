<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

if(isset($_GET['country']) && $_GET['country'] !== ''){ // checks country parameter
    $country = $_GET['country'];
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country"); // check if what was entered in the country parameter is similar to any in the sql database
    $stmt->execute(['country' => "%$country%"]); // executes country statement
}else{
    $stmt = $conn->query("SELECT * FROM countries"); // if empty, lists all countries
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
