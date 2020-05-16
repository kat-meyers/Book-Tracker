<?php

session_start();

if(empty($_POST['page'])){
    
	$display = 'none';
    include('start_page.php');
    exit();
}

require('model.php');

if($_POST['page'] == 'StartPage'){
   switch($_POST['command']){
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
else if($_POST['page'] == 'MainPage'){
	
	if(isset($_SESSION['username'])){
		$username = $_SESSION['username'];
	}
	
	
    switch($_POST['command']){	
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
	
		case 'DisplayOwned':
			
			$data = displayOwned($username);
			$str = json_encode($data);
			echo $str;
			
			break;
			
		case 'DisplayWish':
			
			$data = displayWishlist($username);
			$str = json_encode($data);
			echo $str;
			
			break;
            
        case 'DeleteOwnedBook':
            
            $title = $_POST['delete-owned-title'];
            $author = $_POST['delete-owned-author'];
            
            if(deleteBook($username, $title, $author, 1)){
                include('main_page.php');
            }else{
                echo 'Something went wrong';
            }
            
            break;
            
        case 'DeleteWishBook':
            
            $title = $_POST['delete-wish-title'];
            $author = $_POST['delete-wish-author'];

            if(deleteBook($username, $title, $author, 0)){
                include('main_page.php');
            }else{
                echo 'Something went wrong';
            }
            
            break;
            
        case 'AddCurrent':
            
            $title = $_POST['current-title'];
            $author = $_POST['current-author'];
            
            if(editCurrentlyReading($username, $title, $author)){
                include('main_page.php');
            }else{
                echo 'Something went wrong';
            }
            
            break;
			
		case 'Logout':
		
			$diplay = 'none';
            include('start_page.php');
            break;
			
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
            
        case 'DisplayCurrent':
            
            $data = displayCurrent($username);
			$str = json_encode($data);
			echo $str;
			
			break;
            
		case 'DisplayFav':
		
			$data = displayFavourites($username);
			$str = json_encode($data);
			echo $str;
			
			break;
		
		case 'DisplayWant':
		
			$data = displayWanted($username);
			$str = json_encode($data);
			echo $str;
			
			break;
			
		case 'Logout':
		
			$diplay = 'none';
            include('start_page.php');
            break;
			
		case 'Main':
			
			include('main_page.php');
			break;
        
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