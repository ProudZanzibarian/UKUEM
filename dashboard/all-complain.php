<?php
session_start();
// include "./session.php";
include("./header.php");
include("./nav.php") ?>
<div class="db-info-wrap db-booking">
    <div class="dashboard-box table-opp-color-box">
        <h4 class="permit-header"></h4>
        <p class="permit-desc"></p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th> Proponent Name </th>
                        <th> Application Name </th>
                        <th> Phone Number </th>
                        <th> Date Of Application </th>
                        <th> Status </th>
                        <th> Action </th>

                    </tr>
                </thead>
                <tbody id="permits">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include("./footer.php"); ?>
<script src="./assets/js/inspector.js"></script>
