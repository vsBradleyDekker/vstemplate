<?php
      $db = connect();
      
      if(isset($_POST['form']) && $_POST['form']=='insert') {
        $sql ="INSERT INTO `items` (`id`, `name`, `start`, `end`, `ts`) "
         ."VALUES (NULL, '". $_POST['name']."', '".$_POST['start_date']." ".$_POST['start_time']."', '".$_POST['end_date']." ".$_POST['end_time']."', CURRENT_TIMESTAMP);";
          insert($sql, $db);

        //echo $sql;
      }

      if(isset($_GET['action']) && $_GET['action']=='delete') {
        delete($_GET['id'], $db);
      }

      $results = getRows("SELECT * FROM `items`", $db);
      //print_r($results);
?>

<?php include('../inc/header.php'); ?>

<div class = 'row'>
  <div class ='columns small-12'>
      <table>
        <thead>
        <tr>
         <th>Name</th>
         <th>Start</th>
         <th>End</th>
         <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($results as $row) : ?>
        <tr>
          <td><?=$row['name'];?></td>
          <td><?=date("l jS \of F Y @ h:i:s A", strtotime($row['start']));?></td>
          <td><?=$row['end'];?></td>
          <td><a href="http://localhost/?action=delete&id=<?=$row['id'];?>">delete</a></td>
        </tr>
    <?php endforeach; ?>
  </div>
</div>

<div class = 'row'>
  <div class ='columns small-12'>
    
    <form method="post">
      <input type="hidden" name="form" value="insert"/>
      <label>Name
        <input name="name" type="text">
      </label>
      <label>Start
        <input name="start_date" type="date">
        <input name="start_time" type="time">
      </label>
      <label>end
        <input name="end_date" type="date">
        <input name="end_time" type="time">
      </label>
      <input type = "submit">
    </form>
        
  </div>
</div>

<?php include('../inc/footer.php'); ?>

<?php 

function connect() {
  $db = new mysqli('localhost', 'root', '', 'todo');
      if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
      }

  return $db;
}

function getRows($sql, $db) {
  $rows=array(); 
  
  if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

while($row = $result->fetch_assoc()){
  $rows[]= $row;
  }
  return $rows;
}

function insert($sql, $db) {
  if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
  }
  header("Location: \ ");
}

function delete($id, $db) {

  $sql = "DELETE FROM items WHERE id=".$id;
  if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
  } else {
    header("Location: \ ");
  }
}
?>
<?php
  $admin_email = "tom@theveales.com.au";
  $email = $_REQUEST['tom@theveales.com.au'];
  $subject = $_REQUEST['submit'];
  $comment = $_REQUEST['comment'];
   
   //send email
   mail($admin_email, "$subject", $comment, "From:" . $email);
   
   //Email response
   echo "email reminder sent";
   
   
   //if "email" variable is not filled out, display the form
 
 
  
    
  
  
  
?>