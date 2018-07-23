 <aside id="Just_A_Random_ID">
            <?php  
			    if(logged_in() === true)
				{
					include 'includes/widgets/loggedin.php';
				}
				else
				{
			      include 'includes/widgets/login.php';
				}
				include 'includes/widgets/visit_details.php';
				include 'includes/widgets/user_count.php';
				
			 ?>
	 
              <!--   <p align="center"><img src="logonic.png" height="110" width="200"></p>   -->
	  <p align="center"><img src="../pic/niclogo1.png" height="50" width="250"></p>
        </aside>