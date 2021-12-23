//insert.php
<?php
include('db.php');
if(isset($_POST["title"]))
{
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $sql = "INSERT INTO events(title, start_event, end_event,description) VALUES ('$title','$start','$end','$description')"; 
    $conn->query($sql); 
}
?>