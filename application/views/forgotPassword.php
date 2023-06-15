
<!DOCTYPE html>
<html class="" style = "background: linear-gradient(to top right, #66ccff 0%, #333300 100%);">
<head>
    <meta charset="UTF-8">
    <title>WIMEA-ICT - Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="" style = "background: linear-gradient(to top right, #66ccff 0%, #333300 100%);">
<?php require_once(APPPATH . 'views/error.php'); ?>

<div class="form-box" id="login-box">
    <h3 class="head" style = "color: white; ">WIMEA-ICT Weather Data Repository</h3>
    <h4 class="head" style = "color: white; ">&copy; WIMEA-ICT WDR</h4>

    <div class="header">
        <div class="col-lg-3">
            <img src="<?php echo base_url(); ?>img/WIMEA LOGO.png" class="img-responsive">
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
            <img src="<?php echo base_url(); ?>img/new-mak.png" class="img-responsive">
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
            <img src="<?php echo base_url(); ?>img/noradlogosort_.gif" class="img-responsive">
        </div>
        <div class="clearfix"></div>
        <hr>
        Please provide your credentials to recover password

    </div>
    <form action="<?php echo base_url(); ?>index.php/UserLogin/userforgotpassword" method="post">
        <div class="body bg-gray">
            <script language="javascript">
                function allowIntegerInputOnly(inputvalue) {
                    //var invalidChars = /[^0-9]/gi
                    var integerOnly =/[^0-9\.]/gi;  // integers and decimals //
                    if(integerOnly.test(inputvalue.value)) {
                        inputvalue.value = inputvalue.value.replace(integerOnly,"");
                    }
                }

                function allowCharactersInputOnly(inputvalue) {
                    //var invalidChars = /[^0-9]/gi
                    var charsOnly =/[^A-Za-z.]/gi;  // integers and decimals // /[^0-9\.]/gi;
                    if(charsOnly.test(inputvalue.value)) {
                        inputvalue.value = inputvalue.value.replace(charsOnly,"");
                    }
                }
            </script>

            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" id="username" onkeyup="allowCharactersInputOnly(this)"  required class="form-control" required placeholder="Enter your username"/>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required class="form-control" required placeholder="Enter your email"/>
            </div>

        </div>
        <div class="footer">
            <input type="submit" class="btn bg-olive" name="reset_button" id="reset_button" value="Get new password">
            <a href="<?php echo base_url(); ?>index.php/Welcome/" class="btn btn-warning pull-right" ><i class="fa fa-times"></i> Cancel</a>
            <hr>
            <p>In Partnership</p>
            <div class="col-lg-2">
                <img src="<?php echo base_url(); ?>img/logo.fw.png" class="img-responsive">
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8">
                <img src="<?php echo base_url(); ?>img/bergen.gif" class="img-responsive">
            </div>
            <div class="clearfix"></div>
            <p><a href="<?php echo base_url(); ?>index.php/Welcome/"><i class="fa fa-long-arrow-left"></i> Go back to login</a></p>
            <div class="clearfix"></div>
        </div>
    </form>
</div>


<!-- jQuery 2.0.2
<script src="js/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>