<?php 
    include 'db.php'; 

    if(isset($_POST['request'])){

        $request = $_POST['request']; 

        $query = mysqli_query($conn, "SELECT * FROM events WHERE status = '$request'") or die(mysqli_error($conn)); 
        $count = mysqli_num_rows($query); 
       
?>

<table class="table pt-0" id="eventHistory">
    <?php 
        if($count){
        ?>
        <thead>
            <tr>
                <th scope="col">Event Title</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Start Date/Time</th>
                <th scope="col">End Date/Time</th>
                <th scope="col">Attachment</th>
            </tr>
            <?php 
        }else{
            echo "Sorry! no record found"; 
        }
        ?>
        </thead>

        <tbody>
             <?php 
                    while($row = mysqli_fetch_array($query)){
                        echo ' <tr>
                                 <td>'.$row['title'].'</td>
                                 <td class="nowrap">'.$row['description'].'</td>
                                         
                                  <td>'.$row['status'].'</td>
                                  <td>'.$row['start_event'].'</td>
                                  <td>'.$row['end_event'].'</td>
                                   <td> <button class="btn_1" >PDF</button> </td>
                                    </tr>';
                    }
            ?>
        </tbody>
</table>

<?php  } ?>