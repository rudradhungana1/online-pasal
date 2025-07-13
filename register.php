<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glam Geet Styles</title>
    <!---------------  CSS  --------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" 
    integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/register.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body>
<div id="1"></div>
    <script>
        load("header.php");
        function load(url)
        {
            req = new XMLHttpRequest();
            req.open("GET", url, false);
            req.send(null);
            document.getElementById(1).innerHTML = req.responseText;
        }
    </script>
    <div class="container">
    
        <div class="form_box">
            <h8> Registration </h8>
            <form id="register" class="input_group" method="post" action="functions.php">
                    <div class="form_div">
                        <input type="email" id="email_input" name="email_input" class="form_input" placeholder=" " autocomplete="off" required>
                        <label for="email_input" class="form_label">Email</label>
                    </div>
                        <span id="email_error" class="hide danger-color error-msg">Enter Invalid Email</span>
                        <span id="email_empty" class="hide danger-color error-msg">Email Can not Be Empty</span>
                    <div class="form_div">
                        <input type="username" id="user_name_input" name="user_name_input" class="form_input" placeholder=" " autocomplete="off" required>
                        <label for="user_name_input" class="form_label">User Name</label>
                    </div>
                        <span id="user_name_error" class="hide danger-color error-msg">choose a username</span>
                        <span id="user_name_empty" class="hide danger-color error-msg">User Name Can not Be Empty</span>
               
                        <div class="form_div">
                            <input type="password" id="password_input" name="password_input" class="form_input" onkeyup="passwordvalidation(this.value)" placeholder=" " autocomplete="off" required>
                            <label for="password_input" class="form_label">Password</label>
                            <!---------------  Password Hide & Show Icon  --------------------->
                            <span class="showbtn"><i id="showbtn" class="fa-solid fa-eye"></i></ion-icon></span>
                            
                            </div>
                            <p id="message" > Your Password is <span id= "strenght"> </span> </p> 

                    
                            <span id="password_empty" class="hide danger-color error-msg">Password Can not Be Empty</span>
              
                        <div class="form_div">
                         <input type="confirm_password" id="confirm_password_input" name="confirm_password_input" class="form_input"  placeholder=" " autocomplete="off" required>
                         <label for="confirm_password_input" class="form_label">Confirm Password</label>
                         <!---------------  Password Hide & Show Icon  --------------------->
                          <span class="showbtn2"><i id="showbtn2" class="fa-solid fa-eye"></i></ion-icon></span>
                         </div>
                          <span id="confirm_password_error" class="hide danger-color error-msg">Both Password should match</span>
                            <span id="confirm_password_empty" class="hide danger-color error-msg"> Re-write password </span>
                            <!---------------  Password Validation  --------------------->
                        <div class="password_validation">
                        <ul>
                            <p> Password must have: </p>
                            <li id="lowChar">At least one lowercase chracter</li>
                            <li id="upChar">At least one uppercase chracter</li>
                            <li id="number">At least one number</li>
                            <li id="speChar">At least one special chracter</li>
                            <li id="eigChar">At least 8 chracters</li>
                        </ul>
                    </div>
                    <!---------------  End Password Validation  --------------------->
                    <div class="g-recaptcha" data-sitekey="6Lc03jwlAAAAAJ8jcy9P-82hQq4chU4aF_TfHXZK"></div>
                    <br>
                <button type="submit" id="submit_btn" class="submit_btn">Register</button>  
                <footer class="login-footer">
                    <p>Already have an account ? <a href="login.php">Login </a></p>
                </footer>            
            </form>
            <!---------------  End Register Form --------------------->
        </div>
        
    </div>
    <div class="popup" id="errorpopup">
            <i class="fa-solid fa-xmark erroricon"></i>
            <h2>Something Wrong</h2>
            <button class="ok_btn" type="button" onclick="closeerrorPopup()">OK</button>
         </div>
         
    <script src="script.js"></script> 
</body>

</html>