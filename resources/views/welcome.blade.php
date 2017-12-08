<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dexter vUE</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/custom.css"></link>
        <link rel="stylesheet" href="/css/main.css"></link>
        <style type="text/css">
          .xlsx-button {
            border: none !important;
            background-color: transparent !important;
          }
        </style>
    </head>
    <body>
        <!-- Email verification -->
        <div class="email-header-content">
          <span>You still need to verify your email!</span>
          <a href="" class="resend-email">Resend email to josna@gmail.com</a> or
          <a href="#update-email-address" class="update-email" data-toggle="modal">update your email address</a>
        </div>

        <!-- User navigation bar -->
        <nav class="navbar navbar-inverse user-navigation">
           <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#userNavbarCollapse" aria-expanded="false">
                 <span class="sr-only">Toggle navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 </button>
                 <a class="navbar-brand" href="teacher_view.php"></a>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="userNavbarCollapse">
                 <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                       Login as <b class="caret"></b>
                       </a>
                       <ul class="dropdown-menu">
                          <li>
                             <a href="#"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <span>Student</span></a>
                          </li>
                          <li>
                             <a href="#"><i class="fa fa-user" aria-hidden="true"></i> <span>Parent</span> </a>
                          </li>
                          <li>
                             <a href="#"><i class="fa fa-user" aria-hidden="true"></i> <span>School Leader</span></a>
                          </li>
                       </ul>
                    </li>
                    <li><a href="#" data-toggle="modal" data-target="#myTeacherModal"><img class="img-responsive" src="images/header_navigation_images/logo6.png"></a></li>
                    <li><a href="#" data-toggle="modal" data-target="#myTeacherModal">Refer a teacher</a></li>
                    <li><a href="#"><img class="img-responsive" src="images/header_navigation_images/logo7.png"/></a></li>
                    <li class="dropdown">
                       <a href="#" class="dropdown-toggle withImageAndIcon" data-toggle="dropdown" role="button">
                          <!-- <div class="profile-icon"></div> -->
                          <span>Mr.ram <b class="caret"></b></span>
                       </a>
                       <ul class="dropdown-menu">
                          <li>
                             <a href="#" data-toggle="modal" data-target="#update-email-address">Account Settings</a>
                          </li>
                          <li>
                             <a href="#" data-toggle="modal" data-target="#myTeacherModal">Refer a teacher</a>
                          </li>
                          <li>
                             <a href="/cdojo1">Logout</a>
                          </li>
                       </ul>
                    </li>
                 </ul>
              </div>
           </div>
        </nav>
        <div id="app">
            <router-view></router-view>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <script src="/js/app.js" ></script>
        <script src="/js/bootstrap.min.js" ></script>
        <script type="text/javascript" src="js/custom.js"></script>
    </body>
</html>
