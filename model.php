<?php
	$conn = mysqli_connect('localhost', 'kmeyersf9', 'Daisy@992', 'C354_kmeyersf9');

	function isValid($username, $password){
		
		global $conn;
		
		$sql = "SELECT Username FROM Readers WHERE Username = '$username' AND Password = '$password'";
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function isUsernameValid($username){
		
		global $conn;
		
		$sql = "SELECT Username FROM Readers WHERE Username = '$username'";
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) > 0){
			return false;
		}else{
			return true;
		}
	}

    function addReader($username, $password, $email){
		
		global $conn;
		
        $sql = "INSERT INTO Readers(Username, Password, Email)
                VALUES('$username', '$password', '$email')";
        
        if(mysqli_query($conn, $sql)){
            return true;
        }
        else{
            return false;
        }
    }
	
	function addOwned($username, $title, $author, $description, $favourite){
		
		global $conn;
		
		if($favourite == 1){
			$fav = 'Y';
		}else{
			$fav = 'N';
		}
		
		$sql = "INSERT INTO Owned(Username, OwnedTitle, OwnedAuthor, OwnedDesc, Favourite, Reading)
				VALUES('$username', '$title', '$author', '$description', '$fav', 'N');";
				
		if(mysqli_query($conn, $sql)){
            return true;
        }
        else{
            return false;
        }
		
	}
	
	function addWishlist($username, $title, $author, $description, $wanted){
		
		global $conn;
        
        if($wanted == 1){
			$want = 'Y';
		}else{
			$want = 'N';
		}
		
		$sql = "INSERT INTO Wish(Username, WishTitle, WishAuthor, WishDesc, Wanted)
				VALUES('$username', '$title', '$author', '$description', '$want');";
				
		if(mysqli_query($conn, $sql)){
            return true;
        }
        else{
            return false;
        }
		
	}
	
	function searchBook($username, $term, $which){
		
		global $conn;
		
		if($which == 1){
		
			$sql = "SELECT OwnedTitle, OwnedAuthor, OwnedDesc FROM Owned WHERE Username = '$username' AND (OwnedTitle LIKE '%$term%' OR OwnedAuthor LIKE '%$term%')";
		}else{
			
			$sql = "SELECT WishTitle, WishAuthor, WishDesc FROM Wish WHERE Username = '$username' AND (WishTitle LIKE '%$term%' OR WishAuthor LIKE '%$term%')";
		}
	
		$result = mysqli_query($conn, $sql);
	
		$data = array();
		
		$i = 0;
		
		while($row = mysqli_fetch_assoc($result)){
			$data[$i++] = $row;
		}
		
		return $data;
	}
	
	function displayOwned($username){
		global $conn;
		
		$i = 0;
		$sql = "SELECT OwnedTitle, OwnedAuthor, OwnedDesc FROM Owned WHERE Username = '$username'";
		$result = mysqli_query($conn, $sql);
	
		$data = array();
		
		while($row = mysqli_fetch_assoc($result)){
			$data[$i++] = $row;
		}
		
		return $data;
	}
	
	function displayWishlist($username){
		global $conn;
		
		$i = 0;
		$sql = "SELECT WishTitle, WishAuthor, WishDesc FROM Wish WHERE Username = '$username'";
		$result = mysqli_query($conn, $sql);
	
		$data = array();
		
		while($row = mysqli_fetch_assoc($result)){
			$data[$i++] = $row;
		}
		
		return $data;
	}

    function displayCurrent($username){  
        
        global $conn;
        
		$i = 0;
		$sql = "SELECT OwnedTitle, OwnedAuthor FROM Owned WHERE Username = '$username' AND Reading = 'Y'";
		$result = mysqli_query($conn, $sql);
	
		$data = array();
		
		while($row = mysqli_fetch_assoc($result)){
			$data[$i++] = $row;
		}
		
		return $data;
        
    }
	
	function displayFavourites($username){
		
		global $conn;
		
		$i = 0;
		$sql = "SELECT OwnedTitle, OwnedAuthor FROM Owned WHERE Username = '$username' AND Favourite = 'Y'";
		$result = mysqli_query($conn, $sql);
	
		$data = array();
		
		while($row = mysqli_fetch_assoc($result)){
			$data[$i++] = $row;
		}
		
		return $data;
	}
	
	function displayWanted($username){
		global $conn;
		
		$i = 0;
		$sql = "SELECT WishTitle, WishAuthor FROM Wish WHERE Username = '$username' AND Wanted = 'Y'";
		$result = mysqli_query($conn, $sql);
	
		$data = array();
		
		while($row = mysqli_fetch_assoc($result)){
			$data[$i++] = $row;
		}
		
		return $data;
	}

    function deleteBook($username, $title, $author, $list){
        
        global $conn;
        
        if($list == 1){
            
            $sql = "DELETE FROM Owned WHERE Username = '$username' AND OwnedTitle = '$title' AND OwnedAuthor = '$author'";
            
        }else{
            
            $sql = "DELETE FROM Wish WHERE Username = '$username' AND WishTitle = '$title' AND WishAuthor = '$author'";
            
        }
        
        if(mysqli_query($conn, $sql)){
            return true;
        }
        else{
            return false;
        }    
        
    }

    function editCurrentlyReading($username, $title, $author){
        
        global $conn;
        
        $sql = "UPDATE Owned SET Reading = 'N' WHERE Username = '$username' AND Reading = 'Y'";
        
        if(mysqli_query($conn, $sql)){
            
            $sql = "UPDATE Owned SET Reading = 'Y' WHERE Username = '$username' AND OwnedTitle = '$title' AND OwnedAuthor = '$author'";
            
            if(mysqli_query($conn, $sql)){
                return true;
            }else{
                
                return false;
            }      
        }
        else{
            return false;
        } 
        
    }

    function checkPassword($username, $old){
        
        global $conn;
        
        $sql = "SELECT * FROM Readers WHERE Username = '$username' AND Password = '$old'";
        
        $result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
    }

    function changePassword($username, $new){
        
        global $conn;
        
        $sql = "UPDATE Readers SET Password = '$new' WHERE Username = '$username'";
        
        if(mysqli_query($conn, $sql)){
            return true;
        }
        else{
            return false;
        }
    }

    function deleteAccount($username){
        
        global $conn;
        
        $sql = "DELETE FROM Readers WHERE Username = '$username'";
        
        if(mysqli_query($conn, $sql)){
            return true;
        }
        else{
            return false;
        }
    }
?>