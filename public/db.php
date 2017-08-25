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
        //header("Location: \ ");
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

    //echo date('d-m-Y', $startOfDay); 

    $nextWeek = strtotime(' + 7 days');

    //echo date('d-m-Y', $nextWeek);
  }
  