<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bubiland | </title>

    <!-- Bootstrap -->
    {{Html::style('vendors/bootstrap/dist/css/bootstrap.min.css')}}
    <!-- Font Awesome -->
    {{Html::style('vendors/font-awesome/css/font-awesome.min.css')}}
    <!-- NProgress -->
    {{Html::style('vendors/nprogress/nprogress.css')}}
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    {{Html::style('build/css/custom.min.css')}}
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
          @if(session('error'))
            <div class="alert alert-danger">
              {{session('error')}}
            </div>
          @endif
            <form action = "adminlogin" method = "post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <h1>Admin Login</h1>
              <div>
                <input type="email" name = "email" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name = "password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type = "submit" class="btn btn-default submit">Log in</button>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Bubiland</h1>
                  <p>©2016 All Rights Reserved. Bubiland! Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>