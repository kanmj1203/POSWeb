
 <?php 
     session_start();
         
     unset($_SESSION["id" ]);
     unset($_SESSION["name"]);
     unset($_SESSION["user_num"]);    
		 
     header("Location:login_main.php");
 ?>
 