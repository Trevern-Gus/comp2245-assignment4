<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$country = $_GET['country'] ?? '';

 if (!empty($country)) {
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        $stmt->execute(['country' => "%$country%"]);
    } else {
        $stmt = $conn->query("SELECT * FROM countries");
    }

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<table>
  <thead>
    <tr>
      <th>Country Name</th>
      <th>Continent</th>
      <th>Indepedence</th>
      <th>Head of State</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($results as $row): ?>
      <tr>
        <td><?= $row['name'];?></td>
        <td><?= $row['continent'];?></td>
        <td><?= $row['independence_year'];?></td>
        <td><?= $row['head_of_state'];?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>