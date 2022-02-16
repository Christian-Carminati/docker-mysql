<?php
$servername = "localhost";
$username = "root";
$password = "test";
$host = 'beta';
// Create connection
try {
  $db = new PDO('mysql:host=db;dbname=localhost', 'root', 'test');
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}


Insert();
Read();


function Insert()
{
  global $db;
  global $host;
  $sql = "INSERT INTO Richieste (Backend) VALUES (?)";
  $stmt= $db->prepare($sql);
  $stmt->execute([$host]);
}
function Read()
{
  global $db;
  global $host;
  $sql = "SELECT ID,Data_Richiesta FROM Richieste WHERE Backend = ?";
  $stmt= $db->prepare($sql);
  $stmt->execute([$host]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  Display($results);
}
function Display($results)
{
  ?>
  <table>
    <thead>
    <tr>
      <th>ID</th>
      <th>Data_Richiesta</th>
    </tr>
    </thead>
    <tbody>
     <?php for ($i=0; $i < count($results); $i++) { ?>
     <tr>
       <td><?php echo $results[$i][ID]; ?></td>
       <td><?php echo $results[$i][Data_Richiesta]; ?></td>
     </tr>
     <?php } ?>
   </tbody>
  </table>
  <?php
}
?>