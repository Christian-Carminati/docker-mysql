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


Insert($db,$host);

Read($db,$host);
Perc($db,$host);

function Insert($db,$host)
{
  $sql = "INSERT INTO Richieste (Backend) VALUES (?)";
  $stmt= $db->prepare($sql);
  $stmt->execute([$host]);
}
function Read($db,$host)
{
  $sql = "SELECT ID,Data_Richiesta FROM Richieste WHERE Backend = ?";
  $stmt= $db->prepare($sql);
  $stmt->execute([$host]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  Display($results);
}
function Perc($db,$host)
{
  $sql = "SELECT COUNT(*) FROM Richieste";
  $stmt= $db->query($sql);
  $Totcount = $stmt->fetchColumn();
  

  $sql = "SELECT COUNT(*) FROM Richieste WHERE Backend = ?"; 
  $res = $db->prepare($sql); 
  $res->execute([$host]); 
  $count = $res->fetchColumn();


  echo number_format($count/$Totcount * 100,2). "% di richieste ".$host;


}
function Display($results)
{
  ?>
  <h3>Richieste beta</h3>
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
  <br><br>
  <?php
}
?>