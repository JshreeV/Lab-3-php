<?php
$nameErr = $emailErr = $ageErr = $postalErr = $countryErr = $genderErr = "";
$name = $email = $age = $postal = $country = $gender = "";

if(isset($_POST['register'])){
    $name = $_POST['fname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $postal = $_POST['post'];
    $country = $_POST['country'];

    /*$gender = $_POST['gender'];*/

    $pattern = "/[a-zA-Z]{4,8}/";
    if (empty($name)){
        $nameErr = "Name is required";
    }else {
        $name = test_input($name);
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($email)){
        $emailErr = "Email is required";
    }else {
        $email = test_input($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($age)){
        $ageErr = "Age is required";
    }
    else {
        $age = test_input($age);
        if ( $age > 99 ){
            $ageErr = "Enter valid age, age should be greater then zero and less then equal to 99";
        }
        elseif ($age <= 0){
            $ageErr = "Enter valid age, age should be greater then zero and less then equal to 99";
        }
    }

    $pattern2= "/[A-Za-z][0-9][A-Za-z][0-9][A-Za-z][0-9]/";
    if (empty($postal)){
        $postalErr = "Postal address is required";
    }elseif (!preg_match($pattern2,$postal)){
        $postalErr = "Please enter valid postal address";
    }else {
        $postal = test_input($postal);
    }

    if ($country == "COUNTRY"){
        $countryErr = "Please select country";
    } else {
        $country = test_input($country);
    }

    if (empty($gender)){
        $genderErr = "Please select gender";
    } else {
        $gender = test_input($gender);
    }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
<p><span class="error">* required field</span></p>
<form id="reg" name="reg" method="post" action="mainPage.php">
    <fieldset>
        <legend>Register form</legend>
        Firstname: <input type="text" name="fname"
                          id="fname" maxlength="10" size="15"  />
        <span class="error">* <?php echo $nameErr;?></span>
        <br /><br />
        Age: <input type="text" name="age"
                    id="age" maxlength="10" size="15"  />
        <span class="error">* <?php echo $ageErr;?></span>
        <br /><br />
        Gender: <input type="radio" value="m"  name="gender" id="genderm"/> Male
        <input type="radio" value="f" name="gender" id="genderf"/> Female
        <span class="error">* <?php /*echo $genderErr;*/?></span> <br /><br />
        Country: <select id="country" name="country" >
            <option>COUNTRY</option>
            <option value="ca" id="can">CANADA</option>
            <option value="us" id="usa">US</option>
            <option value="mn" id="mex">MEXICO</option>
        </select><span class="error">* <?php echo $countryErr;?></span><br /><br />
        E-mail: <input type="text" name="email" id = "email">
        <span class="error">* <?php echo $emailErr;?></span><br /><br />
        Postal-Code: <input type="text" name="post" id = "post">
        <span class="error">* <?php echo $postalErr;?></span><br /><br />
        <button id="register" name="register">Register</button>
    </fieldset>
</form>

</body>
</html>
