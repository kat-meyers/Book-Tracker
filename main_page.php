<html>
    <head>
        <title>Read It | Main</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
	<style>
        body{
            background-color: #E3D7FF;
        }
		#header h1{
			text-align: center;
		}
        #dropdown{
            text-align: left;
        }
        #buttons{
            text-align: center;
			background-color: #7A89C2;
            padding: 20px;
        }
        #logout-btn, #profile-btn{
            border: none;
            background: none;   
        }
		table{
			background-color: #c1b5ff;
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
                    <li><button id='profile-btn' type='button' class='btn'>Profile</button></li>
                    <li><button id='logout-btn' type='button' class='btn'>Logout</button></li>
                </ul>
            </div>
        </div>
        <div class='row'>
            
        </div>
		</div>
		<div class='row'>
		<div id='buttons'>
			<button id='owned-button' type='button' class='btn-primary' data-toggle='modal' data-target='#owned-modal'>Add Owned</button>
			<button id='wish-button' type='button' class='btn-primary' data-toggle='modal' data-target='#wish-modal'>Add Wishlist</button>
			<button id='display-owned' type='button' class='btn-primary'>Display Owned</button>
			<button id='display-wish' type='button' class='btn-primary'>Display Wishlist</button>
			<button id='search-button' type='button' class='btn-primary' data-toggle='modal' data-target='#search-modal'>Search</button>
		</div>
		<div>
			<div id='content'></div>
		</div>
		</div>
		<div class='row'>
		<div id='owned-modal' class='modal fade' role='dialog'>
			<div class='modal-dialog'>
			<div id='owned-box' class='modal-content'>
				<form id='owned-form' method='post' action='controller.php'>
					<div class='modal-header'>
						<h2>Add Owned Book</h2>
					</div>
					<div class='modal-body'>
						<input type='hidden' name='page' value='MainPage'>
						<input type='hidden' name='command' value='AddOwned'>
						<label class='modal-label'>Title</label>
						<input type='text' name='owned-title'><br>
						<label class='modal-label'>Author</label>
						<input type='text' name='owned-author'><br>
						<label class='modal-label'>Desc</label>
						<input type='text' name='owned-desc'><br>
						<label class='modal-label'>Favourite</label>
						<input type='checkbox' name='owned-fav'><br>
					</div>
					<div class='modal-footer'>
						<input type='submit' value='Add'>
					</div>
				</form>
			</div>
			</div>
		</div>
		
		<div id='wish-modal' class='modal fade' role='dialog'>
			<div class='modal-dialog'>
			<div id='wish-box' class='modal-content'>
				<form id='wish-form' method='post' action='controller.php'>
					<div class='modal-header'>
						<h2>Add Wishlist Book</h2>
					</div>
					<div class='modal-body'>
						<input type='hidden' name='page' value='MainPage'>
						<input type='hidden' name='command' value='AddWish'>
						<label class='modal-label'>Title</label>
						<input type='text' name='wish-title'><br>
						<label class='modal-label'>Author</label>
						<input type='text' name='wish-author'><br>
						<label class='modal-label'>Desc</label>
						<input type='text' name='wish-desc'><br>
                        <label class='modal-label'>Most Wanted</label>
						<input type='checkbox' name='wish-wanted'><br>
					</div>
					<div class='modal-footer'>
						<input type='submit' value='Add'>
					</div>
				</form>
			</div>
			</div>
		</div>
		
		<div id='search-modal' class='modal fade' role='dialog'>
			<div class='modal-dialog'>
			<div id='search-box' class='modal-content'>
				<form id='search-form'>
					<div class='modal-header'>
						<h2>Search Book</h2>
					</div>
					<div class='modal-body'>
						<input type='hidden' name='page' value='MainPage'>
						<input type='hidden' name='command' value='Search'>
						<label class='modal-label'>Search Term</label>
						<input type='text' id='search-term'><br>
						<label class='modal-label'>Owned</label>
						<input type='radio' name='search-list' id='own' checked><br>
						<label class='modal-label'>Wishlist</label>
						<input type='radio' name='search-list' id='wish'><br>
					</div>
					<div class='modal-footer'>
						<button id='search' type='button'>Search</button>
					</div>
				</form>
			</div>
			</div>
		</div>
            
        <div id='owned-info-modal' class='modal fade' role='dialog'>
			<div class='modal-dialog'>
			<div id='owned-info-box' class='modal-content'>
				<form id='owned-info-form'>
					<div class='modal-header'>
						<h2>Book Info</h2>
                        <button id='delete-owned-book' type='button' class='btn btn-danger'>Delete Book</button>
					</div>
					<div id='book-info' class='modal-body'>
                        <h3>Title</h3>
                        <div id='book-title'>
                        
                        </div>
                        <h3>Author</h3>
                        <div id='book-author'>
                        
                        </div>
                        <h3>Description</h3>
                        <div id='book-desc'>
                        
                        </div>
					</div>
					<div class='modal-footer'>
						<button id='add-current' type='button'>Add Currently Reading</button>
                        <button id='close' type='button' data-dismiss='modal'>Close</button>
					</div>
				</form>
			</div>
			</div>
		</div>
            
        <div id='wish-info-modal' class='modal fade' role='dialog'>
			<div class='modal-dialog'>
			<div id='wish-info-box' class='modal-content'>
				<form id='wish-info-form'>
					<div class='modal-header'>
						<h2>Book Info</h2>
                        <button id='delete-wish-book' type='button' class='btn btn-danger'>Delete Book</button>
					</div>
					<div id='book-info' class='modal-body'>
                        <h3>Title</h3>
                        <div id='wish-book-title'>
                        
                        </div>
                        <h3>Author</h3>
                        <div id='wish-book-author'>
                        
                        </div>
                        <h3>Description</h3>
                        <div id='wish-book-desc'>
                        
                        </div>
					</div>
					<div class='modal-footer'>
                        <button id='close' type='button' data-dismiss='modal'>Close</button>
					</div>
				</form>
			</div>
			</div>
		</div>
		
		</div>
		</div>
        <form id='delete-owned-book-form' method='post' action='controller.php' style='display:none'>
            <input type='hidden' name='page' value='MainPage'>
            <input type='hidden' name='command' value='DeleteOwnedBook'>
            <input id='delete-owned-title' type='text' name='delete-owned-title'>
            <input id='delete-owned-author' type='text' name='delete-owned-author'>         
        </form>
        <form id='delete-wish-book-form' method='post' action='controller.php' style='display:none'>
            <input type='hidden' name='page' value='MainPage'>
            <input type='hidden' name='command' value='DeleteWishBook'>
            <input id='delete-wish-title' type='hidden' name='delete-wish-title'>
            <input id='delete-wish-author' type='hidden' name='delete-wish-author'>         
        </form>
        <form id='current-form' method='post' action='controller.php' style='display:none'>
            <input type='hidden' name='page' value='MainPage'>
            <input type='hidden' name='command' value='AddCurrent'>
            <input id='current-title' type='text' name='current-title'>
            <input id='current-author' type='text' name='current-author'>    
        </form>
		<form id='logout-form' method='post' action='controller.php' style='display:none'>
            <input type='hidden' name='page' value='MainPage'>
            <input type='hidden' name='command' value='Logout'>
        </form>
		<form id='profile-form' method='post' action='controller.php' style='display:none'>
            <input type='hidden' name='page' value='MainPage'>
            <input type='hidden' name='command' value='Profile'>
        </form>
    </body>
    <footer>
    
    </footer>
	<script>     
		$('#display-owned').click(function(){
			var url = 'controller.php';
			var query = {page: 'MainPage', command: 'DisplayOwned'};
			
			$.post(url, query, function(data){
				
				data = JSON.parse(data);
				var str = '<table class="table">';
					str += '<tr>';
					str += '<th>Title</th>'; 
					str += '<th>Author</th>'; 
					str += '<th>Desc</th>'; 
					str += '</tr>';
				for(var i = 0; i < data.length; i++){
					str += '<tr class="owned-t-row" data-toggle="modal" data-target="info-modal">';
					str += '<td>' + data[i].OwnedTitle + '</td>'; 
					str += '<td>' + data[i].OwnedAuthor + '</td>'; 
					str += '<td>' + data[i].OwnedDesc + '</td>'; 
					str += '</tr>';
				}
				str += '</table>';
				$('#content').html(str);
                
                $('table .owned-t-row').on('click', function(){
                    $('#owned-info-modal').modal('show');           
                    $('#book-title').html('<p>' + $(this).closest('tr').children()[0].textContent + '</p>');
                    $('#book-author').html('<p>' + $(this).closest('tr').children()[1].textContent + '</p>');
                    $('#book-desc').html('<p>' + $(this).closest('tr').children()[2].textContent + '</p>');
                });
                
                 $('#delete-owned-book').click(function() {
                    $('#delete-owned-title').val($('#book-title').text());
                    $('#delete-owned-author').val($('#book-author').text());
                    $('#delete-owned-book-form').submit();
		          });
                
                $('#add-current').click(function() {
                    $('#current-title').val($('#book-title').text());
                    $('#current-author').val($('#book-author').text());
                    $('#current-form').submit();
		          });
                
			});
		});
		
		$('#display-wish').click(function(){
			var url = 'controller.php';
			var query = {page: 'MainPage', command: 'DisplayWish'};
			
			$.post(url, query, function(data){
				
				data = JSON.parse(data);
				var str = '<table class="table">';
					str += '<tr>';
					str += '<th>Title</th>'; 
					str += '<th>Author</th>'; 
					str += '<th>Desc</th>'; 
					str += '</tr>';
				for(var i = 0; i < data.length; i++){
					str += '<tr class="wish-t-row" data-toggle="modal" data-target="info-modal">';
					str += '<td>' + data[i].WishTitle + '</td>'; 
					str += '<td>' + data[i].WishAuthor + '</td>'; 
					str += '<td>' + data[i].WishDesc + '</td>'; 
					str += '</tr>';
				}
				str += '</table>';
				$('#content').html(str);
                
                $('table .wish-t-row').on('click', function(){
                    $('#wish-info-modal').modal('show');           
                    $('#wish-book-title').html('<p>' + $(this).closest('tr').children()[0].textContent + '</p>');
                    $('#wish-book-author').html('<p>' + $(this).closest('tr').children()[1].textContent + '</p>');
                    $('#wish-book-desc').html('<p>' + $(this).closest('tr').children()[2].textContent + '</p>');
                });
                
                $('#delete-wish-book').click(function() {
                    $('#delete-wish-title').val($('#wish-book-title').text());
                    $('#delete-wish-author').val($('#wish-book-author').text());
                    $('#delete-wish-book-form').submit();
		          });
			});
		});
		
		$('#search').click(function(){
			
			$('#search-modal').modal('hide');
			
			var url = 'controller.php';
			
			if($('#own').is(':checked')){
				var query = {page: 'MainPage', command: 'Search', term: $('#search-term').val(), selected: 'own'};
			}else{
				var query = {page: 'MainPage', command: 'Search', term: $('#search-term').val(), selected: 'wish'};
			}
			
			$.post(url, query, function(data){
				
				data = JSON.parse(data);
				
				var str = '<table class="table">';
					str += '<tr>';
					str += '<th>Title</th>'; 
					str += '<th>Author</th>'; 
					str += '<th>Desc</th>'; 
					str += '</tr>';
				if(Array.isArray(data) && data.length){
					if('OwnedTitle' in data[0]){
						for(var i = 0; i < data.length; i++){
							str += '<tr class="owned-t-row" data-toggle="modal" data-target="info-modal">';
							str += '<td>' + data[i].OwnedTitle + '</td>'; 
							str += '<td>' + data[i].OwnedAuthor + '</td>'; 
							str += '<td>' + data[i].OwnedDesc + '</td>'; 
							str += '</tr>';
						}
					}else{
						for(var i = 0; i < data.length; i++){
							str += '<tr class="wish-t-row" data-toggle="modal" data-target="info-modal">';
							str += '<td>' + data[i].WishTitle + '</td>'; 
							str += '<td>' + data[i].WishAuthor + '</td>'; 
							str += '<td>' + data[i].WishDesc + '</td>'; 
							str += '</tr>';
						}
					}
				}
				str += '</table>';
				$('#content').html(str);
                
                $('table .owned-t-row').on('click', function(){
                    $('#owned-info-modal').modal('show');           
                    $('#book-title').html('<p>' + $(this).closest('tr').children()[0].textContent + '</p>');
                    $('#book-author').html('<p>' + $(this).closest('tr').children()[1].textContent + '</p>');
                    $('#book-desc').html('<p>' + $(this).closest('tr').children()[2].textContent + '</p>');
                });
                
                $('table .wish-t-row').on('click', function(){
                    $('#wish-info-modal').modal('show');           
                    $('#wish-book-title').html('<p>' + $(this).closest('tr').children()[0].textContent + '</p>');
                    $('#wish-book-author').html('<p>' + $(this).closest('tr').children()[1].textContent + '</p>');
                    $('#wish-book-desc').html('<p>' + $(this).closest('tr').children()[2].textContent + '</p>');
                });
                
                
                $('#delete-owned-book').click(function() {
                    $('#delete-owned-title').val($('#book-title').text());
                    $('#delete-owned-author').val($('#book-author').text());
                    $('#delete-owned-book-form').submit();
		          });
                
                $('#delete-wish-book').click(function() {
                    $('#delete-wish-title').val($('#wish-book-title').text());
                    $('#delete-wish-author').val($('#wish-book-author').text());
                    $('#delete-wish-book-form').submit();
		          });
                
                $('#add-current').click(function() {
                    $('#current-title').val($('#book-title').text());
                    $('#current-author').val($('#book-author').text());
                    $('#current-form').submit();
		          });
			
            });
		});
        
		$('#logout-btn').click(function() {
            $('#logout-form').submit();
		});
		
		$('#profile-btn').click(function(){
			$('#profile-form').submit();
		});

	</script>
</html>