<html>
    <head>
        <title>Read It | Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <style>
		#header{
			text-align: center;
            color: #0D1321;
		}
        #buttons{
            text-align: center;
            background-color: #7A89C2;
            padding: 20px;
        }
        body{
            background-color: #E3D7FF;
        }
       
    </style>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <body>
        <div id='header'>
            <h1>Read It</h1>
        </div>
		<div id='buttons'>
			<button id='login-button' type='button' class='btn-primary btn-lg' data-toggle='modal' data-target='#login-modal'>Login</button>
			<button id='signup-button' type='button' class='btn-primary btn-lg' data-toggle='modal' data-target='#signup-modal'>Signup</button>
		</div>
		<div id='login-modal' class='modal fade' role='dialog'>
			<div class='modal-dialog'>
			<div id='login-box' class='modal-content'>
				<form id='login-form' method='post' action='controller.php'>
					<div class='modal-header'>
						<h2>Login</h2>
					</div>
					<div class='modal-body'>
						<input type='hidden' name='page' value='StartPage'>
						<input type='hidden' name='command' value='Login'>
						<label class='modal-label'>Username:</label>
						<input type='text' name='username'><?php if(!empty($error_msg_username)) echo $error_msg_username; ?><br>
						<label class='modal-label'>Password:</label>
						<input type='password' name='password'><?php if(!empty($error_msg_password)) echo $error_msg_password; ?><br>
					</div>
					<div class='modal-footer'>
						<input type='submit' value='Login'>
					</div>
				</form>
			</div>
			</div>
		</div>
		<div id='signup-modal' class='modal fade' role='dialog'>
			<div class='modal-dialog'>
			<div id='signup-box' class='modal-content'>
				<form id='signup-form' method='post' action='controller.php'>
					<div class='modal-header'>
						<h2>Signup</h2>
					</div>
					<div class='modal-body'>
						<input type='hidden' name='page' value='StartPage'>
						<input type='hidden' name='command' value='Signup'>
						<label class='modal-label'>Username:</label>
						<input type='text' name='username'><?php if(!empty($error_msg_user)) echo $error_msg_user; ?><br>
						<label class='modal-label'>Password:</label>
						<input type='password' name='password'><br>
						<label class='modal-label'>Email:</label>
						<input type='text' name='email'><br>
					</div>
					<div class='modal-footer'>
						<input type='submit' value='Signup'>
					</div>
				</form>
			</div>
			</div>
		</div>
		
    </body>
    <footer>
    
    </footer>
	<script>
			<?php
				if($display == 'none'){
					;
				}else if($display == 'login'){
					echo "$('#login-button').click();";
				}else if($display == 'signup'){
					echo "$('#signup-button').click();";
				}
			?>

		
    </script>
</html>