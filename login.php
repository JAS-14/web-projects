<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from user where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</head>
<body bgcolor="#ccffcc">

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: #ff5c33;
		border: none;
	}

	#box{
            
		background-color:#00b300;
		margin: auto;
		width: 300px;
		padding: 20px;
         left:50%;
         top:50%;
         position:absolute;
         transform: translate(-50%,-50%);
    
	}
       .center {
       margin: auto;
         width: 60%;
        border: 3px solid #73AD21;
       padding: 10px;
     }
        #myInput{
           width:100%;
          height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
	
    }
	</style>

	<div id="box" class="center">
		
		<form method="post" >
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="user_name" placeholder="Name"><br><br>
			<input type="password" placeholder="password"name="password"id="myInput"><br><br>
                    <input type="checkbox" onclick="myFunction()">Show Password<br><br>
			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>