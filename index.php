<?php include("./head.php"); ?>

<body>
    <div class="wrapper">
        <div class="login">
            <div class="profile"><i class="fa fa-camera fa-2x"></i></div>
            <form id="login-form-content">
                <div class="form-element">
                    <span><i class="fa fa-envelope"></i></span><input type="text" name="user_name" placeholder="Your Email Address" />
                </div>
                <div class="form-element">
                    <span><i class="fa fa-lock"></i></span><input type="password" name="password" placeholder=" Password" />
                </div>
                <button type="submit" class="btn-login">login</button>
            </form>
        </div>
    </div>
    
    <?php include("./footer.php") ?>