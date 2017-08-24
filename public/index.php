<?php include("../inc/header.php");?>
<?php 
$db = connect();

if(isset($_POST['form']) && $_POST['form']=='insert'){
  $sql ="INSERT INTO `items` (`id`, `name`, `start`, `end`, `ts`) 
  " ."VALUES (NULL, '". $_POST['name']."', '".$_POST['start_date']." ".$_POST['start_time']."', '".$_POST['end_date']." ".$_POST['end_time']."', CURRENT_TIMESTAMP);";
  insert($sql, $db);
}
//print_r(results);

if(isset($_GET['action']) && $_GET['action']== 'delete'){
  delete($_GET['id'], $db);
}

if(isset($_POST['form']) && $_POST['form']=='update') {
  //echo "<pre>";print_r($_POST);exit; // to check your post data
  $id = $_POST['id'];
  $name = $_POST['name'];
  $start = $_POST['start_date']." ".$_POST['start_time'];
  $end = $_POST['end_date']." ".$_POST['end_time'];
  $query = "UPDATE items set name='$name', start='$start', end='$end' where id=$id";
  $db->query($query); //run the query   
}

if(isset($_GET['action']) && $_GET['action']=='edit') {
  $item = getDataFromTable($_GET['id'], $db);
}

$results = getRows("SELECT * FROM items", $db);

?>
      <div class="row">
        <div class="columns small-12 text-center">
            <h1> Appointment Reminder </h1>
        </div>
      </div>
      <div class="row">
        <div class="columns small-12">
        
        <div class="success callout" data-closable="slide-out-right">
          <h5>This a friendly message.</h5>
          <p>And when you're done with me, I can be closed using a Motion UI animation.</p>
            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
              <span aria-hidden="true">&times;</span>
            </button>
        </div>



      <form method="post">
      <?php if (isset($item) && ($item['id']>0)) { ?>
          <input type="hidden" name="form" value="update"/>
          <input type="hidden" name="id" value=<?=$item['id'];?>/>
        <?php } else{ ?>
          <input type="hidden" name="form" value="insert"/>
        <?php } ?>
        <label>Name
          <input type="text" name="name" value="<?=isset($item['name'])?$item['name']:'';?>"/>
        </label>
        <label>Start
          <input type="date" name="start_date" value="<?=isset($item['start'])?date('Y-m-d',strtotime($item['start'])):'';?>"/>
          <input type="time" name="start_time" value="<?=isset($item['start'])?date('H:i:s',strtotime($item['start'])):'';?>"/>
        </label>
        <label>End
        <input type="date" name="end_date" value="<?=isset($item['end'])?date('Y-m-d',strtotime($item['end'])):'';?>"/>
        <input type="time" name="end_time" value="<?=isset($item['end'])?date('H:i:s',strtotime($item['end'])):'';?>"/>
        </label>
        <input type="submit" class="button">
        <?php if (isset($item) && ($item['id']>0)) { ?>
        <a class="button" href="http://localhost"> Create New </a>
        <?php } ?>
      </form>
  </div>
</div>
<!---HTML---->
<div class="row">
   <div class="columns small-12">
      <table>
          <thead>
            <th>Name</th>
            <th>Start</th>
            <th>End</th>
            <th>Actions</th>
            <th>Edit</th>
          </thead>
          <tbody>
          <?php foreach ($results as $row) : ?>
          <tr> 
            <td><?=$row['name'];?></td>
            <td><?=date("l jS \of F Y @ h:i:s A",strtotime($row['start']));?></td>
            <td><?=date("l jS \of F Y @ h:i:s A",strtotime($row['end']));?></td>
            <td><a href="http://localhost/?action=delete&id=<?=$row['id'];?>">delete</a></td>
            <td><a href="http://localhost/?action=edit&id=<?=$row['id'];?>">edit</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      </table>
   </div>
</div>
<?php
///Functions
  function connect(){
    $db = new mysqli('localhost', 'root', '', 'testing');
    if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
    return $db;
  }
  function getRows($sql, $db){
    $rows=array();

    if(!$result = $db -> query($sql)){
      die('there was an error running the query [' . $db->error .']');
    }

    while($row = $result->fetch_assoc()){
      $rows[]= $row;
    }
    return $rows;
  } 

  function insert($sql, $db){
    if(!$result = $db->query($sql)){
      die('there was an error running the query [' . $db->error .']');
    }
    header("location: \ ");
  }

  function delete($id, $db){
    $sql = "DELETE FROM items WHERE id=".$id;
    if(!$result = $db->query($sql)){
      die('there was an error running the query [' . $db->error .']');
      
    }
    else{
      header("location: \ ");
    }
  }
  function edit($id, $db){
    if(!$result = $db->query($sql)){
      die('there was an error running the query [' . $db->error .']');
      
    }
    else{
      header("location: \ ");
    }
  }
  function getDataFromTable($id, $db){
    $sql = "SELECT * FROM items WHERE id=".$id;
    if(!$result = $db->query($sql)){
      die('there was an error running the query [' . $db->error .']');
    }
    else{
      $data=array();
      while($row = $result->fetch_assoc()){
        $data = $row;
      }
      return $data;
    }
  }
 ?>

<?php include("../inc/footer.php");?>

