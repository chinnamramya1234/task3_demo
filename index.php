<?php
include 'bootstrap.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body style="background-color: #5f9ea0;">
<h1 style="text-align: center;"><b>Welcome to Management System</b></h1>
<section class="vh-100" style="margin-top: 3%;margin-bottom: 5%;">
  <div class="mask d-flex align-items-center h-100" style="text-align: center;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5" style="margin-top: -25px;color: seablue;" >Create an account</h2>

              <form action="connect.php" method="post">

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" placeholder="Username" name="username" class="form-control form-control-lg" required/>
                  <label class="form-label" for="form3Example1cg"></label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cg" placeholder="Password" name="password" class="form-control form-control-lg" style="margin-top: -25px;" required/>
                  <label class="form-label" for="form3Example4cg"></label>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" placeholder="Firstname" name="firstname"class="form-control form-control-lg" style="margin-top: -25px;" required/>
                  <label class="form-label" for="form3Example1cg"></label>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" placeholder="Lastname" name="lastname" class="form-control form-control-lg" style="margin-top: -25px;" required/>
                  <label class="form-label" for="form3Example1cg"></label>
                </div>

                <div class="form-outline mb-4">
                  <input type="email" id="form3Example3cg"  placeholder="Email" name="email" class="form-control form-control-lg" style="margin-top: -25px;" required/>
                  <label class="form-label" for="form3Example3cg"></label>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-dark" style="margin-top: -25px;" value="register">Register</button>
                </div>

                <p class="text-center text-muted mt-3 mb-0">Have already an account? <a href="login.php"
                    class="fw-bold text-body" style="margin-top: -25px;"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>