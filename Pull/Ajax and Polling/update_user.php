<?php
include('./base.php');
$errors = [];
$user_data = [];

if(isset($_GET['errors'])){
    $errors = json_decode($_GET["errors"], true);
}
if(isset($_GET['user_data'])){
    $user_data = json_decode($_GET["user_data"], true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }
        .card-registration .select-arrow {
            top: 13px;
        }
    </style>
</head>
<body>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

             <form class="mx-1 mx-md-4" action='./updated.php'  method="post" enctype="multipart/form-data">
<div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Your ID</label>
<input type="text" id="form3Example1c" class="form-control" name="id" value="<?php echo isset($user_data['id']) ? $user_data['id'] : '' ?>" readonly />
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Your Name</label>
                      <input type="text" id="form3Example1c" class="form-control" name="name" value="<?php echo isset($user_data['name']) ? $user_data['name'] : '' ?>" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c">Your Email</label>
                        <input type="text" id="form3Example3c" class="form-control" name="email" value="<?php echo isset($user_data['email']) ? $user_data['email'] : '' ?>" />
                         <p class="text-danger">
                                        <?php
                                        echo $errors['email'] ? $errors['email'] : " ";
                                        ?>
                                    </p>
                    </div>
                  </div>
                    <label for="sountry">Room No</label>
                            <div class="col-md-12 mb-4">
                                <select class="select btn btn-secondary dropdown-toggle" name="Room">
                                    <option value="Application1">Application 1</option>
                                    <option value="Application2">Application 2</option>
                                    <option value="cloud">cloud</option>
                                </select>
                            </div>
                            <div class="d-flex flex-row align-items-center mb-4">
                                 <div data-mdb-input-init class="form-outline flex-fill mb-0">
                              <label for="formFileLg" class="form-label">Upload file</label>
                              <input class="form-control form-control-lg" id="formFileLg" type="file" name="file"
                              value="<?php echo isset($user_data['image']) ? $user_data['image'] : '' ?>" >
                               <p class="text-danger">
                                        <?php
                                        echo $errors['img'] ? $errors['img'] : " ";
                                        ?>
                                    </p>
                          </div>
                    </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example4c">Password</label>
                      <input type="password" id="form3Example4c" class="form-control" name="password"
                      value="<?php echo isset($user_data['password']) ? $user_data['password'] : '' ?>" />
                       <p class="text-danger">
                                        <?php
                                        echo $errors['password'] ? $errors['password'] : " ";
                                        ?>
                                    </p>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type='submit' data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-lg mx-5">Submit</button>
                    <button type="reset" data-mdb-button-init data-mdb-ripple-init class="btn btn-warning btn-lg">Reset</button>

                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
