<?php
// Uising if else Basic Rules for temperature conversion are:
/*
    Here c = Celsius, f = Fahrenheit, k = Kelvin
     C/5 = (F-32)/9 = K-273/5
     K = C + 273.15
        K = (F + 459.67) * 5/9

     F = C * 9/5 + 32
        F = (C * 9/5) + 32
        F = (K * 9/5) - 459.67
    c = (f-32) * 5/9
    c = k - 273.15

*/  


// without defining any constants simple temperature converter from Fahrenheit to Celsius and vice versa


echo "enter the unit of temperature (F/C/K): ";
$given_unit = (strtoupper(trim(readline())));
// here i used strtoupper to convet the input to upercase incase someone enter the input in lowercase  and use trim to remove any unnecessary soace 
$temperature =  (float)( trim(readline("Enter the temperature: ")));


echo "enter the unite u want to convert to (F/C/K): ";

$unit = strtoupper(trim(readline()));

if ($unit == 'F') {
    switch ($given_unit) {
        case 'C':
            $converted_temp = ($temperature * 9/5) + 32;
            break;
        case 'K':
            $converted_temp = ($temperature * 9/5) - 459.67;
            break;
        default:
            $converted_temp = $temperature;

    }
    
    $unit_name = ' Farhenheit';
    
} elseif ($unit == 'C') {


        switch ($given_unit){
            case "F":
                $converted_temp = ($temperature - 32) * 5/9;
                break;
            case "K":
                $converted_temp = $temperature - 273.15;
                break;  
            default:
                $converted_temp = $temperature;
        }
    
    $unit_name = ' Celsius';
}
    elseif ($unit == 'K') {
        switch ($given_unit) {
            case 'F':
                $converted_temp = ($temperature + 459.67) * 5/9;
                break;
            case 'C':
                $converted_temp= $temperature + 273.15;
                break;
            default:
                $converted_temp = $temperature;
        }

    $unit_name = ' Kelvin';
 }

    else {
    echo "Invalid input\n";
    //here exit is used to stop the wehn the input is invalid  like there as u can see i use a print after this if else functio so if the input is invalid the program will stop and print the invalid input
    exit();

}

// here i use printf to print the output and used 2f to print the output upto 2 decimal places and used %s to print the string like the unit name  
printf ("Temperature in %s  = %.2f \n",$unit_name,  $converted_temp);