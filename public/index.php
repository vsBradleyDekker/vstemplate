<?php include('../inc/header.php'); ?>
    <!--Stuff goes here-->

<?php 

if ($_GET['status']==1) {
    $template = 'available.php';
    $message = 'THE ROOM IS AVAILABLE';
    $icon = 'ti-check';
    $blockClass = 'available';
} 
if ($_GET['status']==2) {
    $template = 'in-progress.php';
    $message = 'Available for';
    $icon = 'ti-check';
    $blockClass = '';
    $timer = 45;
} 
if ($_GET['status']==3) {
    $template = 'in-progress.php';
    $message = 'Next meeting in';
    $icon = 'ti-check';
    $blockClass = 'orange';
    $timer = 15;
} 
if ($_GET['status']==4) {
    $template = 'next-meeting.php';
    $message = 'Meeting In Progress';
    $icon = 'ti-check';
    $blockClass = 'red';
} 

include($template);

include('../inc/footer.php'); 


?>