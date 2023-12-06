<?php
include("./header.php");
include("./nav.php") ?>
<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box">
                <h4> New Entry </h4>
                <p> Contribute to our organization by adding a new entry. Use this form to provide details for the contribution you'd like to make. Please fill out the required information below to proceed. </p>
                <form class="form-horizontal" id="user-registration">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>YEAR</label>
                                <select name="year" id="">
                                    <option value="">---SELECT YEAR---</option>
                                    <option value="1"> 2022 </option>
                                    <option value="2"> 2023 </option>
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Month</label>
                                <select name="month" id="">
                                    <option value="">---SELECT MONTH---</option>
                                    <option value="1"> January </option>
                                    <option value="2"> February </option>
                                    <option value="3"> March </option>
                                    <option value="4"> April </option>
                                    <option value="5"> May </option>
                                    <option value="6"> June </option>
                                    <option value="7"> July </option>
                                    <option value="8"> August </option>
                                    <option value="9"> September </option>
                                    <option value="10"> October </option>
                                    <option value="11"> November </option>
                                    <option value="12"> December </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input name="amount" id="amount" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input name="phone_number" id="phone_number" class="form-control" type="tel">
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" name="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once("./footer.php"); ?>