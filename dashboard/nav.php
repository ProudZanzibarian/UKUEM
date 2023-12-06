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
                            <li><a href="#" data-toggle="modal" data-target="#changePasswordModal"><i class="fas fa-key"></i>Password</a></li>
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
                    <li><a href="./index.php"><i class="fa fa-home"></i> Home</a></li>

                    <li><a href="./statement.php"><i class="far fa-file"></i> My Statement</a></li>

                    <li><a href="./contribution.php"><i class="fa fa-donate"></i> Contribution </a></li>

                    <?php
                    if ($_SESSION["position"] == "head") {
                        echo `<li><a href="./department.php"><i class="fa fa-building"></i> My Department </a></li>`;
                    }
                    ?>
                    <?php
                    if ($_SESSION["position"] == "super_admin" || $_SESSION["position"] == "Secratary") {
                        echo `<li><a href="./all-departments.php"><i class="fa fa-building"></i> All Departments </a></li>`;
                    }
                    ?>


                    <?php
                    if ($_SESSION["position"] == "super_admin" || $_SESSION["position"] == "Secretary") {
                        echo `<li>
                        <a><i class="fas fa-plus"></i></i> Registration </a>
                        <ul>
                            <li><a href="./new-users.php"> Member </a></li>

                            <li><a href="./new-department.php"> Department </a></li>
                        </ul>
                        </a>
                    </li>`;
                    }
                    ?>
                    <?php
                    if ($_SESSION["position"] == "super_admin" || $_SESSION["position"] == "Secretary") {
                        echo `                    
                    <li>
                        <a><i class="fas fa-hotel"></i></i> View Members </a>
                        <ul>
                            <li><a href="#" id="members" data-filter="all">All</a></li>
                            <li><a href="#" id="members" data-filter="active">Active</a></li>
                            <li><a href="#" id="members" data-filter="inactive">Inactive</a></li>
                        </ul>
                        </a>
                    </li>`;
                    }
                    ?>

                    <li>
                        <a href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt"></i> Logout <?php echo $_SESSION['user_name'] . "Oyaaa"; ?>
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
                        <a href="../assets/APIs/logout.php"><button type="button" class="btn btn-primary" data-dismiss="modal">Logout</button></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="change-password-form">
                            <div class="form-group">
                                <label for="currentPassword">Current Password</label>
                                <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                            </div>
                            <div class="form-group">
                                <label for="rePassword">Re-write Password</label>
                                <input type="password" class="form-control" id="rePassword" name="rePassword" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="change-password-btn" class="btn btn-primary zameco_button">Change Password</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- <form class="form-horizontal form-class" id="user-registration">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="member_id">Member ID:</label>
                        <input type="text" id="member_id" name="member_id" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="middle_name">Middle Name:</label>
                        <input type="text" id="middle_name" name="middle_name">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="user_name">Username:</label>
                        <input type="text" id="user_name" name="user_name" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input type="tel" id="phone_number" name="phone_number" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="position">Position:</label>
                        <input type="text" id="position" name="position" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="date_of_joining">Date of Joining:</label>
                        <input type="date" id="date_of_joining" name="date_of_joining" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="position_in_ukeum">Position in Ukeum:</label>
                        <input type="text" id="position_in_ukeum" name="position_in_ukeum">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="occupation">Occupation:</label>
                        <input type="text" id="occupation" name="occupation">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="department_id">Department ID:</label>
                        <input type="text" id="department_id" name="department_id">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="employer">Employer:</label>
                        <input type="text" id="employer" name="employer">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="qualification">Qualification:</label>
                        <input type="text" id="qualification" name="qualification">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="specialization">Specialization:</label>
                        <input type="text" id="specialization" name="specialization">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="image_field">Image Field:</label>
                        <input type="file" id="image_field" name="image_field">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="institution">Institution:</label>
                        <input type="text" id="institution" name="institution">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="national_id_type">National ID Type:</label>
                        <select id="national_id_type" name="national_id_type">
                            <option value="">--Select--</option>
                            <option value="National-id">National ID</option>
                            <option value="Zan-id">Zan ID</option>
                            <option value="Passport">Passport</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="national_id">National ID:</label>
                        <input type="text" id="national_id" name="national_id">
                    </div>
                </div>

            </div>
            <br>
            <input type="submit" value="Register">
        </form> -->