<?php
include('./base.php');
require('./crudOpertaions.php');
$email=$_POST['email'];
$pattern="/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
$pass_pattern = '/^[a-z_]{8}$/';
$password = $_POST['password'];
$errors = [];
$user_data = [];
$file_tmp =$_FILES['file']['tmp_name'];
$file_name =$_FILES['file']['name'];
$file_type=$_FILES['file']['type'];
$data=[];

/* if(preg_match($pattern,$email)){
    header("Location:./LoginForm.php");
}else{
    $errors['email'] = 'please enter valid email';
} */
$user_data['email'] = $email;
$user_data['name'] =$_POST['name'];
if(!preg_match($pattern,$email)){
    setcookie("errorEmail", "please enter valid email", time()+3600, "/","", 0);
    $errors['email'] = 'please enter valid email';
} 
if($file_type == 'image/jpg' || $file_type == 'image/jpeg' || $file_type == 'image/png' || $file_type == 'image/gif'){
    $user_data['image']=$file_name;
    move_uploaded_file($file_tmp,'../LabThree/images/'.$file_name);
}else{
    $errors['img'] = 'please enter valid image';
    setcookie("errorImg", "please enter valid email", time()+3600, "/","", 0);
}
if(preg_match($pass_pattern,$password)){
    $user_data['password'] = $password;
}else{
    $errors['password'] = 'password should conatin only 8 characters in lower case';
}
if(count($errors)==0){
    $name=$_POST['name'];
    $room=$_POST['Room'];
    $image=$_FILES['file']['name'];
    $password=md5($_POST['password']);
insert_user($name,$email,$image,$password,$room);
header("Location:./users.php");
}
else{
    $errors = json_encode($errors);
    $user_data = json_encode($user_data);
    if (! empty($user_data)){
    $url= "errors={$errors}&user_data={$user_data}";
    }else{
        $url= "errors={$errors}";
    }
    header("Location:./RegisterForm.php?".$url);
}
function save_data($user_data, $filename) {
    $fileobj = fopen($filename, "a");
    $res = fwrite($fileobj, $user_data);
    fclose($fileobj);
    return $res;
} 
?>
