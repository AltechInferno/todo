<?php 
    include 'db.php'; 

    function tasks_status($status){
        global $conn; 
        $completed_query = mysqli_query($conn, "SELECT * FROM events WHERE status='$status'") or die(mysqli_error($conn)); 
        $total_query = mysqli_num_rows($completed_query); 
        return $total_query; 
    }


        if(isset($_POST['value'],$_POST['rowid'])){
            $value = $_POST['value']; 
            $rowid = $_POST['rowid']; 

            $updateStatus = mysqli_query($conn, "UPDATE events SET status='$value' WHERE id='$rowid'") or die(mysqli_error($conn)); 
            
            if($updateStatus){
                header("location: success.php");
            }else{
                header("location: error.php"); 
            }

        }
?>