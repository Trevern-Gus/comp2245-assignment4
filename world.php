<?php
$host = 'localhost';
$username = 'lab5_user';     
$password = 'password123';    
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$country = $_GET['country'] ?? '';  
$country = trim($country);

$lookup = $_GET['lookup'] ?? '';  

if ($lookup === 'cities') {
   
    $stmt = $conn->prepare("
        SELECT cities.name AS city_name, cities.district, cities.population
        FROM cities
        JOIN countries ON cities.country_code = countries.code
        WHERE countries.name LIKE :country
    ");
    $stmt->execute(['country' => "%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>
            <thead>
              <tr>
                <th>City Name</th>
                <th>District</th>
                <th>Population</th>
              </tr>
            </thead>
            <tbody>";
    foreach ($results as $row) {
        echo "<tr>
                <td>{$row['city_name']}</td>
                <td>{$row['district']}</td>
                <td>{$row['population']}</td>
              </tr>";
    }
    echo "</tbody></table>";

} else {

    if (!empty($country)) {
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        $stmt->execute(['country' => "%$country%"]);
    } else {
        $stmt = $conn->query("SELECT * FROM countries");
    }
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>
            <thead>
              <tr>
                <th>Country Name</th>
                <th>Continent</th>
                <th>Independence</th>
                <th>Head of State</th>
              </tr>
            </thead>
            <tbody>";
    foreach ($results as $row) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['continent']}</td>
                <td>{$row['independence_year']}</td>
                <td>{$row['head_of_state']}</td>
              </tr>";
    }
    echo "</tbody></table>";
}
?>