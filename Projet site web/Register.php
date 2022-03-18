<?php session_start(); ?>
<?php
    include 'include/database.php';
    global $db;
?> <!-- Inclure le fichier database.php-->

<link href ="css/Register.css" rel="stylesheet"> <!-- Inclure le fichier Incription.css -->
<link href ="css/Main.css" rel="stylesheet">
<link href ="bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css" rel="stylesheet">
<?php  include 'include/Header.php'; ?>  

<div id="main">
    <div class="center"> <!-- Création d'une div pour mieux gérer le formulaire en css -->
    <h1>Register</h1><br/>

<form method="post">
    
    <div class="form-floating"> 
    <input type="text" class="form-control" name="signin" id="signin" placeholder="Your login" autofocus required><br/>
    <label for="signin">Login</label>
    </div>
    
    <div class="form-floating"> 
    <input type="email" class="form-control" name="email" id="email" placeholder="Your e-mail" required><br/>
    <label for="email">E-mail</label>
    </div>
    
    <div class="form-floating"> 
    <input type="password" class="form-control" name="password" id="password" placeholder="Your password" required><br/>
    <label for="password">Password</label>
    </div>
    
    <div class="form-floating"> 
    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm your password" required><br/>
    <label for="cpassword">Confirm your password</label>
    </div>
    <td>
        <input type="radio" name="category"  class="demo1" id="demo1-a" value="1" checked>
        <label for="demo1-a">Tournament Manager</label>
        <input type="radio" name="category" class="demo1" id="demo1-b" value="0" >
        <label for="demo1-b">Player</label>
    </td><br/><br/>
    
    <input type="submit" class="btn btn-primary" id="formsend" name="formsend" value="Submit" onclick="PasswordVerify();">

</form>
        <?php 
    include 'include/Registration.php';
?> <!-- Inclure le fichier Registration.php-->
        
    </div>

</div>

<?php  include 'include/Footer.php';


/*
<form class="row g-3 needs-validation" method="post" novalidate>
  <div class="col-md-4 position-relative">
    <label for="signin" class="form-label">Your login</label>
    <input type="text" class="form-control" name="signin" id="signin"  autofocus required>
    <div class="valid-tooltip">
      Looks good!
    </div>
  </div>
  <div class="col-md-4 position-relative">
    <label for="validationTooltip02" class="form-label">Last name</label>
    <input type="text" class="form-control" id="validationTooltip02" value="Otto" required>
    <div class="valid-tooltip">
      Looks good!
    </div>
  </div>
  <div class="col-md-4 position-relative">
    <label for="validationTooltipUsername" class="form-label">Username</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
      <input type="text" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" required>
      <div class="invalid-tooltip">
        Please choose a unique and valid username.
      </div>
    </div>
  </div>
  <div class="col-md-6 position-relative">
    <label for="validationTooltip03" class="form-label">City</label>
    <input type="text" class="form-control" id="validationTooltip03" required>
    <div class="invalid-tooltip">
      Please provide a valid city.
    </div>
  </div>
  <div class="col-md-3 position-relative">
    <label for="validationTooltip04" class="form-label">State</label>
    <select class="form-select" id="validationTooltip04" required>
      <option selected disabled value="">Choose...</option>
      <option>...</option>
    </select>
    <div class="invalid-tooltip">
      Please select a valid state.
    </div>
  </div>
  <div class="col-md-3 position-relative">
    <label for="validationTooltip05" class="form-label">Zip</label>
    <input type="text" class="form-control" id="validationTooltip05" required>
    <div class="invalid-tooltip">
      Please provide a valid zip.
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Submit form</button>
  </div>
</form>*/
?>

