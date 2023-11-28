<?php include("./head.php"); ?>

<body>
    <div class="content">
        <div class="form-container" id="login-form">
            <span class="form">
            <h2>Zanzibar Enviroment Permit System</h2>
                <img src="dashboard/assets/images/SMZ.png" class="img-responsive" style=" border-radius:10%; width:150px;" /><br />
                <h3>Internal-Portal</h3>
            </span>
            <form id="admin-login-form-content" style="margin-top: 20px;">
                <div class="form-group">
                    <label for="login-username">Username</label>
                    <input type="text" id="login-username" name="username" placeholder="Username" style="width: 250px;" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" placeholder="Password" style="width: 250px;" required>
                </div>
                <input type="submit" id="login" class="btn-primary btn-submit" name="submit" value="Log In" />
            </form>
        </div>
      
    </div>
    <?php include("./footer.php") ?>