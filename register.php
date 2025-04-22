<?php

include 'views/header.php';
?>
<form id="loginform" action="models/register_user.php" method="POST">
    <label for="uname">Username</label>
    <?php
    if(isset($_GET['uname_error'])){
        if($_GET['uname_error']==1){
            echo "<span class='error_msg'>Invalid Username</span>";    
        }
      }
    ?>
        <input type="text" name="uname" id="uname" placeholder="Username" required>
    <label for="email">Email</label>
    <?php
    if(isset($_GET['email_error'])){
        if($_GET['email_error']==1){
            echo "<span class='error_msg'>Invalid Email</span>";    
        }
      }
    ?>
        <input type="text" name="email" id="email" placeholder="Email" required>
    <label for="firstname">First name</label>
    
        <input type="text" name="fname" id="fname" placeholder="First name" required>
    <label for="lastname">Last name</label>
        <input type="text" name="lname" id="lname" placeholder="Last name" required>
    <div id="cbgender">
            <label for="gender">Gender</label>
            <select name="gender" id="gender">
                <option value="male">Male</option>
                <option value="male">Female</option>
            </select>
        </div>
     <label for="bdate">Birthdate</label>
         <input type="date" name="bdate" id="bdate"required>
    <label for="pass">Password</label>
    <?php
    if(isset($_GET['pass_error'])){
        if($_GET['pass_error']==1){
            echo "<span class='error_msg'>Invalid Password</span>";    
        }
      }
    ?>
        <input type="password" name="pass" id="pass" placeholder="Password" required>
    <label for="conpass">Confirm Password</label>
        <input type="conpass" name="conpass" id="conpass" placeholder="confirm password" required>
    <input type="checkbox" name="signedin" id="signedin" value="signedin">
    <label for="signedin">Agree:<a href="">End user License</a></label>
    <input type="submit" value="login">

    
</form>
<?php
include 'views/footer.php';
?>
