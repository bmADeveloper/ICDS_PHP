<div class="widget">
 <h2>Login/Register</h2>
 <div class="inner">
  <form action="login_data.php" method="post">
   <table align="left">
	   <tr><td></td><th>DM/ADM/DPO/CDPO</th></tr>
        <tr><td></td></tr>
        <tr>
           <td> <font size="-1" color="#333333" face="MS Serif, New York, serif"><b>
               User Name:
               </b></td>
           <td><input style="width:150px;
                            height:5px;
                            font-size:12px;
                            text-align:left;
                            color:#666;
                            border:0px solid #797979;
                            padding:10px;
                            border-radius:4px;
                            background-color:#F7F7F7"
                            type="text" name="username" placeholder="E-mail"></td>
        </tr>   
        
        
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr>
           <td> <font size="-1" color="#333333" face="MS Serif, New York, serif"><b>
                 Password:
                 </b></td>
           <td><input style="width:150px;
                            height:5px;
                            font-size:16px;
                            text-align:left;
                            color:#666;
                            border:0px solid #797979;
                            padding:10px;
                            border-radius:4px;
                            background-color:#F7F7F7"
                            type="password" name="pass" placeholder="************"></td>
        </tr> 
        
        
        
        <tr><td></td></tr>
        <tr><td></td></tr>  
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Login">
                 <input type="reset" value="Clear"></td>
        </tr>    
   </table>
   <ul>
   <li>Forgot <a href="recover.php?mode=username">username</a> or <a href="recover.php?mode=password">password</a></li>
   <li><a href="register.php">Register</a></li>
   </ul>
   
 </form>
  </div>
</div>