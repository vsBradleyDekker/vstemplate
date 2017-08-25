<?php
    include('db.php');
    date_default_timezone_set('Australia/Melbourne');
    $to = "tom@theveales.com.au";
    $subject = "reminder";
    
    $headers = 'From:tom@theveales.com.au' . "\r\n" .
    'Reply-To: tom@theveales.com.au' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    $db = connect();
    $results = getRows("SELECT * FROM `items`", $db);
    print_r($results);
           
    $emails=array();
    foreach ($results as $key=>$item) {
        $start = strtotime($item['start']);

        if($start < strtotime('+ 30 minutes') && $start > time()) {
            $emails[$key]=true;
        }

        //echo date('Y-m-d H:i:s', $start)."\n";
        //echo date('Y-m-d H:i:s')."\n";
        
    }    
       
    foreach ($emails as $key=>$email) {
        $txt = 'Your task, '.$results[$key]['name'].' is due to start in less than 30 minutes!';
        mail($to, $subject, $txt, $headers);
    }
    
?>


    /*$results = array(
    array(
        'id' => 1,
        'name' => 'Task 1',
        'start' => '2017-01-01 10:00:00',
        'start' => '2017-01-01 11:00:00',
        'ts' => '2017-01-01 10:00:00'
    ),
    array(
        'id' => 2,
        'name' => 'Task 2',
        'start' => '2017-01-01 10:00:00',
        'start' => '2017-01-01 11:00:00',
        'ts' => '2017-01-01 10:00:00'
    ),
    array(
        'id' => 3,
        'name' => 'Task 3',
        'start' => '2017-01-01 10:00:00',
        'start' => '2017-01-01 11:00:00',
        'ts' => '2017-01-01 10:00:00'
    )
    );

    

