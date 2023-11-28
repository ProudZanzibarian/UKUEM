<!-- start Container Wrapper -->
<div id="container-wrapper">
    <!-- Dashboard -->
    <div id="dashboard" class="dashboard-container">
        <div class="dashboard-header sticky-header">
            <div class="content-left  logo-section pull-left">
                <h1><a href="./index.php"><img src="#" alt=""></a></h1>
            </div>
            <div class="header-content-right pull-right">

                <div class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <div class="dropdown-item profile-sec">
                            <img src="../assets/images/default.png" alt="">
                            <span>My Account </span>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </a>
                    <div class="dropdown-menu account-menu">
                        <ul>
                            <!--   <li><a href="#"><i class="fas fa-cog"></i>Settings</a></li> -->
                            <li><a href="./user_edit.php"><i class="fas fa-user-tie"></i>Profile</a></li>
                            <li><a href="#"><i class="fas fa-key"></i>Password</a></li>
                            <li> <a href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-navigation">
            <!-- Responsive Navigation Trigger -->
            <div id="dashboard-Navigation" class="slick-nav"></div>
            <div id="navigation" class="navigation-container">
                <ul id="navMenu">
                    <li ><a href="./index.php"><i class="fa fa-home"></i> Home</a></li>

                    <li ><a href="./statement.php"><i class="far fa-file"></i> My Statement</a></li>

                    <li ><a href="./contribution.php"><i class="fa fa-donate"></i> Contribution </a></li>

                    <li ><a href="./department.php"><i class="fa fa-building"></i> My Department </a></li>

                    <li ><a href="./all-departments.php"><i class="fa fa-building"></i> All Departments </a></li>

                    <li>
                        <a href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Logout</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to log out?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="sign-out-link" class="btn btn-primary" data-dismiss="modal">Logout</button>
                    </div>
                </div>
            </div>
        </div>