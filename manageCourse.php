<?php require "templates/header.php"; ?>

<div style="padding-left: 100px;">

  <div style="width: 1000px;" >
  <form method="post" class="form">
    <label class="formtitle"> Find Courses </label>
    <br>
    <h2>Based on name, ID, credit</h2>
    <input type="text" id="cid" name="cid">
    <input class="submitbutton" type="submit" name="submit" value="View Results"  style="margin-left:40px;">
    <br>
    <br>
  </form>
  <br>
  <a href="staffhome.php" class="gobacklink">Back to main menu</a>
  <a href="create-course.php" class="gobacklink">Add course</a>
  </div>

<?php

if (isset($_POST['submit'])) {
  try  {
      
    require "session.php";
    require "common.php";

    // $connection = new PDO($dsn, $username, $password, $options);

    $cid = $_POST['cid'];
    $sql = "SELECT * FROM course
            WHERE cid like '$cid%' or cname like '%$cid%' or credits like '%$cid'";

    $statement = $connection->prepare($sql);
    $statement->bindParam(':cid', $cid, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
        
<?php  
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table class="data-table" style="display: block; overflow: scroll;height: 300px;">
      <thead>
        <tr>
          <th>Course ID</th>
          <th>Course Name</th>
          <th>Credits</th>
          <th>View Section</th>
          <th>Edit Course</th>
          <th>Delete Course</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["cid"]); ?></td>
          <td><?php echo escape($row["cname"]); ?></td>
          <td><?php echo escape($row["credits"]); ?></td>
          <td><a href='read-course-single.php?cid=<?=$row["cid"]?>'> View </a></td>
          <td><a href="update-course-single.php?cid=<?php echo escape($row["cid"]); ?>">Edit</a></td>
          
          <td><a href="delete-course.php?cid=<?php echo escape($row["cid"]); ?>">Delete</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['cid']); ?>.</blockquote>
    <?php } 
} ?> 


</div>
<script>
 
  var $table = $('data-table')
  var  $bodyCells=$table.find('tbody tr:first').children(),
  colWidth;

  colWidth= $bodyCells.map(function(){
    return $(this).width();
  }).get();

  $table.find('thead tr').children().each(function(i,v){
    $(v).width(colWidth[i]);
  });
  
</script>
<?php require "templates/footer.php"; ?>
