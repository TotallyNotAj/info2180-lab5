<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';
$results = [];

if(isset($_GET['country']) && $_GET['country'] !== ''){ // checks country parameter
    $country = $_GET['country'];
    if ($lookup === 'cities'){
      $stmt = $conn->prepare("
            SELECT cities.name AS city_name, countries.name AS country_name, cities.district, cities.population
            FROM cities
            JOIN countries ON cities.country_code = countries.code
            WHERE countries.name LIKE :country
        ");
         $stmt->execute(['country' => "%$country%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }else{
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        $stmt->execute(['country' => "%$country%"]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>

<?php if ($lookup === 'cities'): ?>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>District</th>
            <th>Population</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['city_name']); ?></td>
                <td><?= htmlspecialchars($row['district']); ?></td>
                <td><?= htmlspecialchars($row['population']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<table>
    <thead>
        <tr>
            <th>Country Name</th>
            <th>Continent</th>
            <th>Independence Year</th>
            <th>Head of State</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['continent']); ?></td>
                <td><?= htmlspecialchars($row['independence_year']); ?></td>
                <td><?= htmlspecialchars($row['head_of_state']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
