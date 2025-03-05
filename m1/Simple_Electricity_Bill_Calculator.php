<?php
$Unit_consumed = (float)(readline("Enter the units consumed: "));


// i wanted to give option for multipale currency 
// but seems i cant use switce case for string so i used if else and make it static



if (  $Unit_consumed <= 100) {
    $Amount = $Unit_consumed * 5;

} 
    elseif ( $Unit_consumed <= 200) {
        $Amount = 100 + (($Unit_consumed - 100) * 10);
}   
    else {
        // for more than 200 units used per unit cost will be 15$
        $Amount = 100 * 5 + 100 * 10 + (($Unit_consumed - 200) * 15);
}

printf ("Electricity Bill =  %.2f$  \n  " , $Amount ); 