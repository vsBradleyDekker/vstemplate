<?php
include('db.php');
include('../inc/header.php');
?>
<?php
  $to = "tom@theveales.com.au";
  $subject = "reminder";
  $txt = "you have a task coming up in 30 minutes!!";
  $headers = 'From:tom@theveales.com.au' . "\r\n" .
  'Reply-To: tom@theveales.com.au' . "\r\n" .
  'X-Mailer: PHP/' . phpversion();
  $error = "";
  $db = connect();
  
  if(isset($_POST ['form'])){
    
    $st = strtotime($_POST['start_date']." ".$_POST['start_time']);
    $et = strtotime($_POST['end_date']." ".$_POST['end_time']);
    $name = $_POST['name'];
    $maxTime = strtotime('+ 4 years');
      
    if($name == false){
      unset($_POST);
        $error = "please name your task. ";
    }
    if($st >= $et){
    
      unset($_POST);
        $error = "Your start time is past your end time. ";
      
    }
    if($st >= $maxTime){
      
        unset($_POST);
          $error = "You cannot place a task more than four years in the future. ";
        
      }
    if($st < strtotime('now')){
      unset($_POST);
      $error = "Your start time cannot be in the past. ";
    }
    /*if($et = strtotime('< 30 minutes')) {
      mail($to,$subject,$txt,$headers);
       
    } 
    */
  }

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
      </tbody>
  </div>
</div>

<?php include('../inc/footer.php'); ?>