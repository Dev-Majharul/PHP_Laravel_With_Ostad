<?php

// Number Classifier get number form user and check the number is positive, negative or zero 


//get number form scirpt 
// $numberformScript = "10 "   ; 

// if($number > 0 ){
//     echo "The number is positive";
// }
// elseif($number < 0){
//     echo "The number is negative";
// }
// else{
//     echo "The number is zero";
// }

//get the number from user aka form terminal 4

$number = (int) readline( 'Enter the number:');


if($number > 0 ){
    echo "The number is positive .\n" ;
}
elseif($number < 0){
    echo "The number is negative .\n";
}
else{
    echo "The number is zero .\n";
}

