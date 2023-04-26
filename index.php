<?php  

	$conn = mysqli_connect('localhost','root','','homedb');
	$error = "";

	if(isset($_POST['addd']))
	{
		if(empty($_POST['username']) || empty($_POST['password'] ) || empty($_POST['email']) )
	{
		echo  "لا يمكن ترك اي من الحقول فارغةً ..";
	}

	
	else{
		if(strlen($_POST['username']) <= 4)
		{
			$error = "اسم المستخدم اقل من اربع احرف<br>";
		}
		if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['username'])) 
		{
			$error.= "لا يمكن ان يحتوي اسم المستخدم على ارقام او رموز<br>";
		}

		if(is_numeric($_POST['username'][0]))
		{
			$error.="يجب ان يبدأ اسم المستخدم بحرف<br>";
		}

		if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
		{
			$error.="يرجى إدخال ايميل صحيح<br>";
		}
			
		if(strlen($_POST['password']) <=8)
		{
			$error.="كلمة السر يجب ان تكون  8 ارقام او احرف او رموز";
		}

		if(empty($error))
		{
			$username = mysqli_escape_string($conn,$_POST['username']);
			$email = mysqli_escape_string($conn,$_POST['email']);
			$password =password_hash($_POST['password'],PASSWORD_BCRYPT);
			$pass = mysqli_escape_string($conn,$password);

			$insert = "insert into tblhome(username,password,email) values('$username','$pass','$email')";

			$res = mysqli_query($conn,$insert);

			if($res)
			{
				echo "تم التسجيل بنجاح";
			}
		}
		
			
		}

		echo $error;
	}
	



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>موقع تجريبييي</title>
	<style type="text/css">
		
		.home{
			width: 40%;
			height: 80%;
			box-shadow: 2px 2px 13px silver;
		}

		 .home h2{
			margin-top: 20px;
			padding-top: 40px;
		}
		button{
			margin-bottom: 20px;
			
			background-color: #297BBF;
			padding: 18px;
			font-weight: bold;
			border-radius: 10px ;
			border-color: black;
			color: white;
			font-family: cursive;
			cursor: pointer;
			font-size: 16px;


		}
		button:hover{
			background-color: #F2F7A7;
			color: black;
		}
		button:active{
			background-color: green;
			color: #FFD3F7;
		}

		.div2{
			
			background-color: red;
			padding: 100px;
			border-color: black;
			border-radius: 40px;

		}

		input{
			width: 100%;
			padding: 15px;
			background-color: #EDFCD2;
			border-color: black;
			border-radius: 10px;
			text-align: center;
			font-weight: bold;
			font-size: 15px;
		}

		p{
			color: white;
			font-size: 25px;
			font-weight: bold;
			text-decoration: none;
		}

	</style>
</head>
<body>

	<center>
	<div class="home">
		
				<form method="post">
			<center>

			<div class="div2">
				<h2>موقع تجريبي </h2>

				<input type="text" name="username" placeholder="username"><br><br>
				<input type="text" name="password" placeholder="password"><br><br>
				<input type="text" name="email" placeholder="email"><br><br>
				<button name="addd">أضف إلى قاعدة البيانات</button>
				</center>
			</div>
			
		</form>




	</div>

	<p><b><i>Mohammad Jassim Shimal albindawi</i></b></p>
	</center>




</body>
</html>