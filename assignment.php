 

<?php
 
include 'main/init.php';
protect_page();
include 'includes/overall/header.php' ; 
?>
<br><br><br><br>
<h1><p align="center">Assignment Details</p></h1>
<br>  
 
 
  
 <form action="" method="post">
   <table align="center">
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr>
           <td>Centre Code*:</td>
           <td><input type="text" name="sup_name" placeholder="Centre Code"></td>
        </tr>   
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr>
           <td>Date*:</td>
           <td><input style="width:169px;" type="date" name="visit_date" placeholder="Visit Date"></td>
        </tr> 
        <tr><td></td></tr>
        <tr><td></td></tr> 
         <tr>
           <td>Sup name*:</td>
           <td><input type="text" name="visit_loc" placeholder="Supervisor Name"></td>
        </tr> 
        <tr><td></td></tr>
        <tr><td></td></tr>  
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Update"></td>
         </tr>
   </table>
   
 </form>



 
<?php include 'includes/overall/footer.php'  ?>    