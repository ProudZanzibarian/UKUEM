<?php
// session_start();
// require_once "./session.php";
require_once("./header.php");
require_once("./nav.php") ?>

<div class="db-info-wrap">
    <h4>Department Dashboard</h4>
    <div class="row">
        <!-- Item -->
        <div class="col-xl-4 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-blue">
                    <i class="fa fa-users"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Number Of Members</h4>
                    <h5>100</h5>
                </div>
            </div>
        </div>
        <!-- Item -->
        <div class="col-xl-4 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-green">
                    <i class="fas fa-donate"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Total Contribution </h4>
                    <h5> 5,200</h5>
                </div>
            </div>
        </div>
        <!-- Item -->
        <div class="col-xl-4 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-purple">
                    <i class="fa fa-truck-loading"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Overdue</h4>
                    <h5>-18,520</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    Available Members
                </div>
                <div class="card-body">
                <table class="table">
                <thead>
                    <tr>
                        <th> Full Name </th>
                        <th> username </th>
                        <th> Phone Number </th>
                        <th> Position </th>
                        <th> Status </th>
                        <th> Action </th>
                    </tr>
                </thead>

                <tr>

                </tr>
                <tbody id="depMember">

                </tbody>
            </table>
                </div>
            </div>
        </div>
        <!-- Item -->
        <div class="col-xl-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    Department Profile
                </div>
                <div class="card-body text-left">
                    <div class="row">
                        <div class="col">
                            <h5>Member Details</h5>
                            <h5>Member Number:</h5>
                            <p>234546667</p>
                            <h5>Employer Name:</h5>
                            <p>USAMA TALIB JUMA</p>
                            <h5>Employer Number:</h5>
                            <p>9898979</p>
                            <h5>Date of Birth:</h5>
                            <p>19-6-1909</p>
                            <h5>Date of Join:</h5>
                            <p>24-3-2020</p>
                        </div>
                        <div class="col">
                            <h5>Contribution Details</h5>
                            <h5>First Contribution Period:</h5>
                            <p>Mar 2020</p>
                            <h5>June 98 Credit:</h5>
                            <p>Aug 2020</p>
                            <h5>June 98 Balance:</h5>
                            <p>0</p>
                            <h5>Total Credits:</h5>
                            <p>18</p>
                            <h5>Total Contribution:</h5>
                            <p>TSH 7,000,459.89</p>
                        </div>
                        <div class="col">
                            <h5>Payment Details</h5>
                            <h5>Last Paid Date:</h5>
                            <p>-</p>
                            <h5>Last Paid Amount:</h5>
                            <p>-</p>
                            <h5>Claimed Credits:</h5>
                            <!-- <p></p> -->
                            <h5>Paid Credits:</h5>
                            <p>18</p>
                            <h5>Unclaimed Credits:</h5>
                            <p>18</p>
                            <h5>Unclaimed Contributions:</h5>
                            <p>TSH 7,000,459.89</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once("./footer.php") ?>