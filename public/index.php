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

      $results = getRows("SELECT * FROM `items`", $db);
      //print_r($results);

      checkTime();
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
         <th>Edit</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($results as $row) : ?>
        <tr>
          <td><?=$row['name'];?></td>
          <td><?=date("l jS \of F Y @ h:i:s A", strtotime($row['start']));?></td>
          <td><?=date("l jS \of F Y @ h:i:s A", strtotime($row['end']));?></td>
          <td><a href="http://localhost/?action=delete&id=<?=$row['id'];?>">delete</a></td>
          <td><a href="http://localhost/?action=edit&id=<?=$row['id'];?>">edit</a></td>
        </tr>
    <?php endforeach; ?>
  </div>
</div>

<div class = 'row'>
  <div class ='columns small-12'>
    
    <form method="post">
      <?php if (isset($item) && $item['id']>0) { ?>
        <input type="hidden" name="form" value="update"/>
        <input type="hidden" name="id" value="<?=$item['id'];?>"/>
      <?php } else { ?>
        <input type="hidden" name="form" value="insert"/>
      <?php } ?>
      <label>Name
        <input name="name" type="text" value="<?=isset($item['name'])?$item['name']:'';?>">
      </label>
      <label>Start
        <input name="start_date" type="date" value="<?=isset($item['start'])?date('Y-m-d',strtotime($item['start'])):'';?>">
        <input name="start_time" type="time" value="<?=isset($item['start'])?date('H:i:s',strtotime($item['start'])):'';?>">
      </label>
      <label>end
        <input name="end_date" type="date" value="<?=isset($item['end'])?date('Y-m-d',strtotime($item['end'])):'';?>">
        <input name="end_time" type="time" value="<?=isset($item['end'])?date('H:i:s',strtotime($item['end'])):'';?>">
      </label>
      <input type = "submit" class="button">
      <?php if (isset($item) && $item['id']>0) { ?>
        <a class="button" href="http://localhost">Create New</a>
      <?php } ?>
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
      }   else {
          header("Location: \ ");
      }
  }
  function edit($result, $db){
    if(!$result = $db->query($sql)){
      die('There was an error running the query [' . $db->error . ']');
  }
    else{
      header("Location: \ ");
    }
  }

  function getDataFromTable($id, $db) {
    $sql = "SELECT * FROM items WHERE id=".$id;
    if(!$result = $db->query($sql)){
      die('There was an error running the query [' . $db->error . ']');
    }   else {
      $data=array();
      while($row = $result->fetch_assoc()){
        $data= $row;
      }
      return $data;
    }
  }
    
  function checkTime() {
    $now = time();
    $now = strtotime('NOW');

    $plusOneHour = strtotime('+ 1 hour');
    $startOfDay = strtotime(date('Y-m-d'));
    echo date('d-m-Y', $startOfDay);
    $nextWeek = strtotime(' + 7 days');

    echo date('d-m-Y', $nextWeek);
  }
?>
<?php
  
 
 
  
    
  
  
  
?>