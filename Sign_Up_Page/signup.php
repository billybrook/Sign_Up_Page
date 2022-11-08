<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign_Up_Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    
        <?php
            $full_name=$age=$gender=$email=$phone_number=$Monday_class=$Tuesday_class=$Wednesday_class=$Thursday_class=$Friday_class=$Saturday_class=$payment_method=$comments="";
            $full_nameErr=$ageErr=$genderErr=$emailErr=$phone_numberErr=$Day_classErr=$payment_methodErr=$commentsErr="";
            $full_nameCheck=$ageCheck=$genderCheck=$emailCheck=$phone_numberCheck=$payment_methodCheck=$Day_classCheck=$Confirmation="";
            $fillFormMessage="Fill in the form below to sign up for our fitness classes!";
            
            
            if($_SERVER["REQUEST_METHOD"]=="POST"){     /* COULD USE if(isset($_POST["submit"])){} Instead... checks if the button has been pressed too. have left out the data which comes from radio buttons and check boxes*/
                if(empty($_POST["full_name"])){
                    $full_nameErr="* A full name is required";
                    }
                else {
                    $full_name=test_input($_POST["full_name"]);
                    if(!preg_match("/^[a-zA-Z-' ]*$/",$full_name)){
                        $full_nameErr="*Only letters and spaces are allowed";
                    }
                    else {$full_nameCheck="Complete";}
                } 
                if(empty($_POST["age"])){
                    $ageErr="*An age input is required";
                }
                else {
                    $age=test_input($_POST["age"]);
                    if(!preg_match('/^([0-9]*)$/', $age)){
                    $ageErr="*Please only input a number here";
                    }
                    else {$ageCheck="Complete";}
                    
                }
                if(empty($_POST["email"])){
                    $emailErr="*Please provide a contact email address";
                }
                else{
                    $email=test_input($_POST["email"]);
                    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                        $emailErr="*Please only input a valid email address";
                    }
                    else {$emailCheck="Complete";}
                }    
                if(empty($_POST["phone_number"])){
                    $phone_numberErr="*Please provide a contact phone number";
                }
                else{
                    $phone_number=test_input($_POST["phone_number"]);   
                    if(!preg_match('/^([0-9]*)$/', $phone_number)){
                        $phone_numberErr="*Please provide a contact phone number";
                    }
                    else {$phone_numberCheck="Complete";}
                    
                }
            
                $comments=test_input($_POST["comments"]);  
                /* gender radio button needs to be checked*/
                if(empty($_POST["gender"])){
                    $genderErr="*Please select an option for gender";
                }
                else {$gender=$_POST["gender"];
                $genderCheck="Complete";}
                
                if(empty($_POST["payment_method"])){
                    $payment_methodErr="*Please select an option for payment";
                }
                else {$payment_method=$_POST["payment_method"];
                     $payment_methodCheck="Complete";}
                    
                     /*checkbox rule: at least one class needs to be selected...*/
                if(empty($_POST["Monday_class"])&&empty($_POST["Tuesday_class"])&&empty($_POST["Wednesday_class"])&&empty($_POST["Thursday_class"])&&empty($_POST["Friday_class"])&&empty($_POST["Saturday_class"])){
                    $Day_classErr="*Please select at least one class";}
                    else{$Day_classCheck="Complete";}
                         
                    /*the following displays a confirmation message when all the information has been input correctly*/
                    if($full_nameCheck=="Complete"&&$ageCheck=="Complete"&&$emailCheck=="Complete"&&$phone_numberCheck=="Complete"&&$genderCheck=="Complete"&&$payment_methodCheck=="Complete"&&$Day_classCheck="Complete"){
                    $Confirmation="Form Complete: Thank you for signing up to the class!";/*echo"Form Complete: Thank you for signing up to the class!";*/                                                
                    $fillFormMessage="";}
                }
             function test_input($info){               /*Ths function removes spaces,slashes from input data and converts any HTML to non-executable code */
                $info=trim($info);
                $info=stripslashes($info);
                $info=htmlspecialchars($info);
                return $info;
             }
        
            
            ?>
    <header>
        
        <h1 class="logo">THE GYM </h1>
        <nav>
        <ul class="navBar">
            <li><a href="#">About our fitness classes</a></li>
            <li><a href="#">Find us</a></li>
            <li><a href="signup.php">Sign up form</a></li> 
        </ul>
        </nav>
    </header>    
    <div class="titleContainer">
        <div class="column1">   
    <h2 class="pageTitle">Sign Up Form</h1>
    </div>
    <div class="column2">
    <span class="fillFormMessage"><?php echo"$fillFormMessage"?></span>
    </div>
    <div class="column3">
    <span class="ConfirmationMessage"><?php echo"$Confirmation"?></span>
    </div>
    
    </div>
    <div class="formContainer">
        <form class="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> <!-- still not 100% on what PHP_SELF is...-->
            <!-- why cn't I select my classes for my form labels so that I can then set them as block levl elements?? and style the form out?? -->
            <label class="formlabels1" for='full_name'>Name</label><input type="text" class="textFields1" id="full_name" name="full_name" size="40" placeholder="Please enter your full name here" value="<?php echo"$full_name"?>"><span class="error"><?php echo $full_nameErr?></span>
            <br>
            <label class="formlabels1" for="email">Contact Email</label><input type="text" class="textFields1" id="email" name="email" size="40" placeholder="Please enter your contact email here" value="<?php echo"$email"?>"><span class="error"><?php echo $emailErr?></span>
            <br>
            <label class="formlabels1" for="phone_number">Contact Phone</label><input type="text" class="textFields1" id="phone_number" name="phone_number" size="40" placeholder="Please enter your mobile number here" value="<?php echo"$phone_number"?>"><span class="error"><?php echo $phone_numberErr?></span>
            <br> 
            <label class="formlabels1" for="Age">Age</label><input type="text" class="textFields1" id="Age" name="age" size="5" placeholder="Age" value="<?php echo "$age"?>"><span class="error"><?php echo $ageErr;?></span>
            <br>
            <p class="genderQuestion">Gender</p>
        <div class="genderSelectorContainer"> 
            <div class="specificGenderRadioContainer">
            <label><input type="radio" class="genderAnswers" name="gender" value="Male" <?php if(isset($_POST["gender"])&& $_POST["gender"]=="Male"){echo "checked";}?>>Male</label><!--value specifies an initial value for the input tag-->
            </div>
            <div class="specificGenderRadioContainer">
            <label><input type="radio" class="genderAnswers" name="gender" value="Female" <?php if(isset($_POST["gender"])&& $_POST["gender"]=="Female"){echo "checked";}?>>Female</label>
            </div>
            <div class="specificGenderRadioContainer">
            <label><input type="radio" class="genderAnswers" name="gender" value="Other"<?php if(isset($_POST["gender"])&& $_POST["gender"]=="Other"){echo "checked";}?>>Other</label> <span class="error"><?php echo $genderErr;?></span>
            </div>
        </div>
            <p class="whichDayQuestion">Which days do you want to attend the classes? <span class="error"><?php echo $Day_classErr?></span></p>
        <div class="daySelectorContainer">
            <div class="specificDayContainer">
            <input type="checkbox" id="Monday_class" name="Monday_class" value="Attending" <?php if(isset($_POST["Monday_class"])){echo "checked";}?>><label for="Monday_class">Monday 19:00-20:00</label><br> <!-- should I set a default value for the checkboxs?--> 
            </div>
            <div class="specificDayContainer">
            <input type="checkbox" id="Tuesday_class" name="Tuesday_class" value="Attending" <?php if(isset($_POST["Tuesday_class"])){echo "checked";}?>><label for="Tuesday_class">Tuesday 19:00-20:00</label><br>
            </div>
            <div class="specificDayContainer">
            <input type="checkbox" id="Wednesday_class" name="Wednesday_class" value="Attending" <?php if(isset($_POST["Wednesday_class"])){echo "checked";}?>><label for="Wednesday_class">Wednesday 19:00-20:00</label><br>
            </div>
            <div class="specificDayContainer">
            <input type="checkbox" id="Thursday_class" name="Thursday_class" value="Attending" <?php if(isset($_POST["Thursday_class"])){echo "checked";}?>><label for ="Thursday_class">Thursday 19:00-20:00</label><br>
            </div>
            <div class="specificDayContainer">
            <input type="checkbox" id="Friday_class" name="Friday_class" value="Attending" <?php if(isset($_POST["Friday_class"])){echo "checked";}?>><label for="Friday_class">Friday 19:00-20:00</label><br>
            </div>
            <div class="specificDayContainer">
            <input type="checkbox" id="Saturday_class" name="Saturday_class" value="Attending" <?php if(isset($_POST["Saturday_class"])){echo "checked";}?>><label for="Saturday_class">Saturday 10:30-11:30</label> 
            </div>
        </div>
            
            <p class="paymentMethodQuestion">How would you like to pay? <span class="error"><?php echo $payment_methodErr?></span></p>
            <div class="paymentMethodContainer">
            <label><input type="radio" class="paymentAnswers" name="payment_method" value="Daily" <?php if(isset($_POST["payment_method"])&& $_POST["payment_method"]=="Daily"){echo "checked";}?>>Daily Pay</label>
            <label><input type="radio" class="paymentAnswers" name="payment_method" value="Monthly" <?php if(isset($_POST["payment_method"])&& $_POST["payment_method"]=="Monthly"){echo "checked";}?>>Monthly Pay</label> 
            </div>
            <label for='comments'>Do you have any comments or need any additional information? (If so, please leave us a message here and we'll get back to you)</label><br>
            <div class="commentsContainer">
            <textarea id="comments" name="comments"  placeholder="Comments"></textarea>
            </div>
            <div class="submitButtonContainer">
            <button class="submitbutton" id="submitbutton" type="submit" name="submit" value="submit">Submit And Get Fit!</button>
            </div>
            
            
        </form>
    </div>
    <footer>
        <div class="footerContainer">
            <p class="footerText">Coded by <a href="https://github.com/billybrook">billybrook</a>.</p>
        </div>
    </footer>
</body>
</html>