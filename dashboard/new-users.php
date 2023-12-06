<?php
include("./header.php");
include("./nav.php") ?>
<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box table-opp-color-box">
                <h4>Register New Member</h4>
                <form class="form-horizontal form-class" id="user-registration">
                    <!-- Basic Information -->
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

                        <!-- User Credentials -->
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

                        <!-- Contact Information -->
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

                        <!-- Employment Information -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="position">Position:</label>
                                <select name="position" id="psition">
                                    <option value="">---Select Position---</option>
                                    <option value="super.admin"> Super Admin </option>
                                    <option value="secretary">  </option>
                                </select>
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
                                <label for="department_id">Department ID:</label>
                                <select name="department_id" id="department_id">
                                    <option value="">---Select Department---</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <!-- Submit Button -->
                    <br>
                    <input type="submit" value="Register">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Content / End -->
<?php include("./footer.php"); ?>