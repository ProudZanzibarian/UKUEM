<?php
// session_start();
// require_once "./session.php";
require_once("./header.php");
require_once("./nav.php") ?>

<div class="db-info-wrap">
    <h4>My Dashboard</h4>
    <div class="row">
        <!-- Item -->
        <div class="col-xl-4 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-blue">
                    <i class="fa fa-calendar-day"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Date of Join</h4>
                    <h5>100</h5>
                </div>
            </div>
        </div>
        <!-- Item -->
        <div class="col-xl-4 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-green">
                    <i class="fas fa-dollar-sign"></i>
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
                    <h5>18,520</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    MY DETAILS
                </div>
                <div class="card-body">
                    <img src="../assets/images/default.png" alt="..." class="rounded-pill" style="width:30%;height: 30%;padding-bottom:20px;">
                    <h3>USAMA TALIB JUMA</h3>
                    <table style="margin:auto;">
                        <tr>
                            <th>Member No:</th>
                            <td>444444400</td>
                        </tr>
                        <tr>
                            <th>Birth Date:</th>
                            <td>19-7-1999</td>
                        </tr>
                        </tr>
                    </table>
                </div>
                <div>
                    <h3>Employer Name</h3>
                    <p>OFISI YA MUFTI ZANZIBAR</p>
                </div>
                <div>
                    <span style="float:left; flex-direction:row; vertical-align: middle; ">
                        <table>
                            <tr>
                                <th>
                                    <h5>
                                        <i class="fa fa-hotel"></i>
                                        Emloyer ID:
                                    </h5>
                                </th>
                                <td>
                                    <p>
                                        78787899
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </span>

                    <span style="float:right; flex-direction:row; vertical-align: middle;">
                        <table>
                            <tr>
                                <th>
                                    <h5>
                                    <i class="fa fa-map-marker"></i>                                    </h5>
                                </th>
                                <td>
                                    <p>
                                        HEAD OFFICE
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </span>
                </div>
            </div>
        </div>
        <!-- Item -->
        <div class="col-xl-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    MY PROFILE
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