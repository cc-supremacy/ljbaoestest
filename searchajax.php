<?php 

function generateEditButton() {
    return '<button class="btn btn-info btn-sm edit-button">Edit</button>';
}

  include("connection/db.php");
  
   $name = $_POST['name'];
  
   $sql = "SELECT * FROM grades WHERE lrn LIKE '$name%'";  
   $query = mysqli_query($connection,$sql);
   $data='';
   while($row = mysqli_fetch_assoc($query))
   {
       $data .=  "<tr><td>".$row['lrn']."</td><td>".$row['subName']."</td><td>".$row['subMarks']."</td><td></td><td>".generateEditButton()."</td></tr>";
   }
    echo $data;
 ?>