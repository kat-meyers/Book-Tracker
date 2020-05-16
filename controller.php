<?php

session_start();

if(empty($_POST['page'])){
    
	$display = 'none';
    include('start_page.php');
    exit();
}

require('model.php');

//if user is on the login page
if($_POST['page'] == 'StartPage'){
   switch($_POST['command']){
        //if user clicks the login button
        case 'Login':
			$username = $_POST['username'];
			$password = $_POST['password'];
        
			if(isValid($username, $password)){
				$_SESSION['username'] = $username;
				include('main_page.php');
			}else{
				$error_msg_username = '* Incorrect username or';
                $error_msg_password = '* Incorrect password';
				$display = 'login';
				include('start_page.php');
			}
				
            exit();
        //if user clicks the signup button
        case 'Signup':
           $username = $_POST['username'];
           $password = $_POST['password'];
           $email = $_POST['email'];
           
           if(isUsernameValid($username)){
                if(addReader($username, $password, $email)){
                    ;
                }
           }else{
                $error_msg_user = '* Username is taken';
				$display = 'signup';
           }
           include('start_page.php');
           exit();
   } 
}
//if user is on the main page
else if($_POST['page'] == 'MainPage'){
	
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	}
	
	
    switch($_POST['command']){	
        //if user clicks the add owned button they can add books to their wishlist
        case 'AddOwned':
			$title = $_POST['owned-title'];
			$author = $_POST['owned-author'];
			$description = $_POST['owned-desc'];
			
			if(isset($_POST['owned-fav'])){		
				$favourite = 1;
			}else{
				$favourite = 0;
			}
		
			if(addOwned($username, $title, $author, $description, $favourite)){
            }
            else{
                echo "Something went wrong";	
            }
			include('main_page.php');
			break;
        //if user clicks the add wish button they can add books to their owned list
		case 'AddWish':
		
			$title = $_POST['wish-title'];
			$author = $_POST['wish-author'];
			$description = $_POST['wish-desc'];
		
            if(isset($_POST['wish-wanted'])){		
				$wanted = 1;
			}else{
				$wanted = 0;
			}
            
			if(addWishlist($username, $title, $author, $description, $wanted)){
            }
            else{
                echo "Something went wrong";	
            }
			include('main_page.php');
			break;
		//if the user enters a search term and clicks search	
		case 'Search':
			
			$term = $_POST['term'];
			
			if($_POST['selected'] == 'own'){
				$which = 1;
			}else{
				$which = 0;
			}
		
			$data = searchBook($username, $term, $which);
			$str = json_encode($data);
			echo $str;
			
			break;
	    //if the user clicks the display owned button they can view the books they own
		case 'DisplayOwned':
			
			$data = displayOwned($username);
			$str = json_encode($data);
			echo $str;
			
			break;
        //if the user clicks the display wish button they can view the books on their wishlist
		case 'DisplayWish':
			
			$data = displayWishlist($username);
			$str = json_encode($data);
			echo $str;
			
			break;
        //if user clicks the delete button when viewing an owned book, it deletes the books data    
        case 'DeleteOwnedBook':
            
            $title = $_POST['delete-owned-title'];
            $author = $_POST['delete-owned-author'];
            
            if(deleteBook($username, $title, $author, 1)){
                include('main_page.php');
            }else{
                echo 'Something went wrong';
            }
            
            break;
        //if user clicks the delete button when viewing a wish book, it deletes the books data 
        case 'DeleteWishBook':
            
            $title = $_POST['delete-wish-title'];
            $author = $_POST['delete-wish-author'];

            if(deleteBook($username, $title, $author, 0)){
                include('main_page.php');
            }else{
                echo 'Something went wrong';
            }
            
            break;
        //if user clicks add currently reading they can display that book on their profile
        case 'AddCurrent':
            
            $title = $_POST['current-title'];
            $author = $_POST['current-author'];
            
            if(editCurrentlyReading($username, $title, $author)){
                include('main_page.php');
            }else{
                echo 'Something went wrong';
            }
            
            break;
		//if user clicks the log out button they are logged out	
		case 'Logout':
		
			$diplay = 'none';
            include('start_page.php');
            break;
		//if user clicks the profile button they are taken to the profile page	
		case 'Profile':
			
			include('profile.php');
			break;
	}
} 
else if($_POST['page'] == 'ProfilePage'){
	
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	}
	
    switch($_POST['command']){
        //displays book that user is currently reading    
        case 'DisplayCurrent':
            
            $data = displayCurrent($username);
			$str = json_encode($data);
			echo $str;
			
			break;
        //displays users favourite books    
		case 'DisplayFav':
		
			$data = displayFavourites($username);
			$str = json_encode($data);
			echo $str;
			
			break;
		//displays books that users most want
		case 'DisplayWant':
		
			$data = displayWanted($username);
			$str = json_encode($data);
			echo $str;
			
			break;
		//logs out user	
		case 'Logout':
		
			$diplay = 'none';
            include('start_page.php');
            break;
		//takes user back to main page	
		case 'Main':
			
			include('main_page.php');
			break;
        //allows user to change password
        case 'Password':
            
            $old = $_POST['old-password'];
            $new = $_POST['new-password'];
            
            if(checkPassword($username, $old)){
                changePassword($username, $new);
            }else{
                $error_msg_old_pass = '* Password is incorrect';
				$display = 'settings';
            }
            include('profile.php');
            
            break;
        //allows user to delete account    
        case 'Unsubscribe':
            
            $password = $_POST['delete-password'];
            
            if(checkPassword($username, $password)){
                deleteAccount($username);
				include('start_page.php'); 
            }else{
                $error_msg_delete_pass = '* Password is incorrect';
				$display = 'delete';
				include('profile.php'); 
            }
        
            break;
	}
}
?>