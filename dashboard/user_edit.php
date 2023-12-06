<?php
include("./header.php");
include("./nav.php") ?>
<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box table-opp-color-box">
                <h4> My Profile </h4>
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

                        <!-- Occupation Information -->
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

                        <!-- Other Fields -->
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

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Content / End -->
<?php include("./footer.php"); ?>