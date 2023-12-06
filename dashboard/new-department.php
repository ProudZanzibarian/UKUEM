<?php
include("./header.php");
include("./nav.php") ?>
<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box table-opp-color-box">
                <h4>Register New Department</h4>
                <form class="form-horizontal form-class" id="user-registration">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="department_name"> Department Name </label>
                                <input type="text" id="department_name" name="department_name" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="head"> Head Of Department </label>
                                <select name="head" id="head">
                                    <option value=""> ---Select Head--- </option>
                                </select>
                            </div>
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