<?php

/**
 * Delete a user
 */

require "common.php";
require "session.php";

if (isset($_GET["cc"])) {
  try {
    $sch_name = $_GET["cc"];
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->query("use regcu");
    $sql = "DELETE FROM scholarship WHERE sch_name = $sch_name";

    $result = mysqli_query($db, $sql);
    if(!$result){
      echo "Error deleting";
   ;   exit();
  }

  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET["sch_name"])) {
  try {
    $sch_name = $_GET["sch_name"];
    $connection = new PDO($dsn, $username, $password, $options);
    $connection->query("use regcu");
    $sql = "SELECT * FROM scholarship WHERE sch_name = $sch_name";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}


if (isset($_GET["cc"])) {
    header('Location: managescholarship.php');
}
?>
<?php require "templates/header.php"; ?>
<div style="padding-left: 100px;">
<h2>Delete Scholarship</h2>

<table class="data-table" style="display: block; height: 100px;">
  <thead>
    <tr>
      <th>Scholarship's year</th>
      <th>Name</th>
      <th>Owner</th>
      <th>Amount</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["sch_year"]); ?></td>
      <td><?php echo escape($row["sch_name"]); ?></td>
      <td><?php echo escape($row["sch_owner"]); ?></td>
      <td><?php echo escape($row["sch_amount"]); ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<h2>Are you sure you want to permanently delete this scholarship?</h2>
<form>
  <a href="delete-scholarship.php?cc=<?php echo escape($row["sch_name"]); ?>" class="gobacklink">YES</a> <-->
  <a href="managescholarship.php" class="gobacklink">NO</a>
</form>
<br>

<a href="managescholarship.php">Back to manage scholarship</a>
</div>
<?php require "templates/footer.php"; ?>