<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Booking | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="images/favicon.png" type="image/x-icon">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="http://aset.fiftytwogroup.com/assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="http://aset.fiftytwogroup.com/assets/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="http://aset.fiftytwogroup.com/assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="http://aset.fiftytwogroup.com/assets/plugins/iCheck/square/blue.css">


</head>
<body class="hold-transition login-page" style="background-image: url('http://aset.fiftytwogroup.com//theme/images/slider-2.jpg')">
<div class="login-box">
  <div>
   <p></p>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"> <img width="200px;" src="http://aset.fiftytwogroup.com/theme/images/logo.png"></p>
    <center><h3><b>LOG IN BOOKING PEMERIKSAAN</b></h3></center></br>
    <form action="http://aset.fiftytwogroup.com/admin/login/auth" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
            <!-- <label>
              <input type="checkbox"> Remember Me
            </label> -->
    </br>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
          <a href="index.php"><b> Kembali </b></a>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
       

    <!-- /.social-auth-links -->
    <hr/>
    <p><center>Copyright 2020 Developed by Geysler Schwarzenegger <br/> All Right Reserved</center></p>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="http://aset.fiftytwogroup.com/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="http://aset.fiftytwogroup.com/assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="http://aset.fiftytwogroup.com/assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>