<?php
//passweod and username for basic authentication

define('USERNAME', 'admin');
const PASSWORD = '12345';

//ask user for login and password 

// i tried 2 diffrent types of input methods
// 1. readline() - for inputing username 
// 2. fgets() - for inputing password 

$_username = (string) readline("Inpute Username : " ); 
echo "Inpute Password : ";
$_password =   trim(fgets(STDIN));  



if ($_password == PASSWORD && $_username == USERNAME) {
    echo "login sucessfully \n";
} else {
    
     echo "Invalid Username or Password \n ";
}
?>


