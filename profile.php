<html>
    <head>
        <title>Read It | <?php echo $username ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
	<style>
        body{
            background-color: #E3D7FF;
        }
        #header h1, h3, #username{
			text-align: center;
		}
        #buttons{
            text-align: center;
			background-color: #7A89C2;
            padding: 20px;
        }
		table, #current{
			background-color: #c1b5ff;
		}
        tr, th{
            text-align: center;
        }
    </style>   
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <body>
        <div class='container'>
        <div class='row'>
        <div id='header'>
            <h1>Read It</h1>
			<div id='dropdown' class='dropdown'>
                <button id='profile-nav-btn' class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'><?php echo $username ?></button>
                <ul class='dropdown-menu'>
                    <li><button id='main-btn' type='button' class='btn'>Main</button></li>
                    <li><button id='logout-btn' type='button' class='btn'>Logout</button></li>
                </ul>
            </div>
        </div>
        </div>
        <div class='row'>
		<div id='buttons'>
			<button id='settings-button' type='button' class='btn-primary' data-toggle='modal' data-target='#settings-modal'>Settings</button>
		</div>
		<div id='username' class='row'>
			<h2><?php echo $username ?></h2>
		</div>
        </div>
		<div class='row'>
			<h3>Currently Reading</h3>
			<div id='current'>
            
            </div>
		</div>
		<div class='row'>
		</div>
        <div class='row'>
			<div class='col-sm-4'>
				<h3>Favourites</h3>
			</div>
			
            <div id='favourite' class='col-sm-8'>
            
            </div>		
        </div>
		<div class='row'>
			<div class='col-sm-4'>
				<h3>Most Wanted</h3>
			</div>
			<div id='wanted' class='col-sm-8'>
            
            </div>
		</div>
        </div>
		<form id='logout-form' method='post' action='controller.php' style='display:none'>
            <input type='hidden' name='page' value='ProfilePage'>
            <input type='hidden' name='command' value='Logout'>
        </form>
		<form id='main-form' method='post' action='controller.php' style='display:none'>
            <input type='hidden' name='page' value='ProfilePage'>
            <input type='hidden' name='command' value='Main'>
        </form>
		<div id='settings-modal' class='modal fade' role='dialog'>
			<div class='modal-dialog'>
			<div id='settings-box' class='modal-content'>
                <div class='modal-header'>
				    <h2>Settings</h2>
				</div>
				<form id='password-form' method='post' action='controller.php'>
					<div class='modal-body'>
                        <h2>Change Password</h2>
						<input type='hidden' name='page' value='ProfilePage'>
						<input type='hidden' name='command' value='Password'>
						<label class='modal-label'>Old Password:</label>
						<input type='password' name='old-password'><?php if(!empty($error_msg_old_pass)) echo $error_msg_old_pass; ?><br>
						<label class='modal-label'>New Password:</label>
						<input type='password' name='new-password'><br>
                        <input type='submit' value='Submit'>
					</div>
				</form>
                <div class='modal-body'>
                    <button id='delete-button' type='button' class='btn btn-danger' data-toggle='modal' data-target='#unsubscribe-modal'>Delete Account</button>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
				</div>
                
        <div id='unsubscribe-modal' class='modal fade' role='dialog'>
			 <div class='modal-dialog'>
			 <div id='unsubscribe-box' class='modal-content'>
                <div class='modal-header'>
                    <h2>Delete Account?</h2>
				</div>
                <form id='unsubscribe-form' method='post' action='controller.php'>
                    <div class='modal-body'>
                        <h2>Enter password</h2>
                        <input type='hidden' name='page' value='ProfilePage'>
                        <input type='hidden' name='command' value='Unsubscribe'>
                        <input type='password' name='delete-password'><?php if(!empty($error_msg_delete_pass)) echo $error_msg_delete_pass; ?>
                        <input type='submit' value='Delete Account'>
                    </div>
                </form>
                </div>
                </div>
                </div>
			</div>
			</div>
		</div>
    </body>
    <script>
        $(window).on('load', function(){
            var url = 'controller.php';
			var query = {page: 'ProfilePage', command: 'DisplayFav'};
			
			$.post(url, query, function(data){
				
				data = JSON.parse(data);
				var str = '<table class="table">';
					str += '<tr>';
					str += '<th>Title</th>'; 
					str += '<th>Author</th>'; 
					str += '</tr>';
				for(var i = 0; i < data.length; i++){
					str += '<tr>';
					str += '<td>' + data[i].OwnedTitle + '</td>'; 
					str += '<td>' + data[i].OwnedAuthor + '</td>'; 
					str += '</tr>';
				}
				str += '</table>';
				$('#favourite').html(str);
			});
            
            var url = 'controller.php';
			var query = {page: 'ProfilePage', command: 'DisplayWant'};
			
			$.post(url, query, function(data){
				
				data = JSON.parse(data);
				var str = '<table class="table">';
					str += '<tr>';
					str += '<th>Title</th>'; 
					str += '<th>Author</th>'; 
					str += '</tr>';
				for(var i = 0; i < data.length; i++){
					str += '<tr>';
					str += '<td>' + data[i].WishTitle + '</td>'; 
					str += '<td>' + data[i].WishAuthor + '</td>'; 
					str += '</tr>';
				}
				str += '</table>';
				$('#wanted').html(str);
			});
            
            var url = 'controller.php';
			var query = {page: 'ProfilePage', command: 'DisplayCurrent'};
			
			$.post(url, query, function(data){
                
				data = JSON.parse(data);
                
                var str = '<table class="table">';
                    str += '<tr>';
					str += '<td>' + data[0].OwnedTitle + '</td>'; 
					str += '</tr>';
                    str += '<tr>';
					str += '<td>' + data[0].OwnedAuthor + '</td>'; 
					str += '</tr>';

				$('#current').html(str);
			});
            
        });
		
		$('#logout-btn').click(function() {
            $('#logout-form').submit();
		});
		
		$('#main-btn').click(function(){
			$('#main-form').submit();
		});
        
        <?php
			if(isset($display)){
				if($display == 'none'){
					;
				}else if($display == 'settings'){
					echo "$('#settings-button').click();";
                }else if($display == 'delete'){
                    echo "$('#settings-button').click();";
                    echo "$('#delete-button').click();";
                }
			}
        ?>
    </script>
</html>