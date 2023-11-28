$(document).ready(function () {
  // ----------------------
  //      Permits
  // ----------------------
  permit_data();
  function permit_data() {
    var permit = getQueryParam("permit");
    $(".permit-header").text(permit + " Application(s)");
    $(".permit-desc").text(
      "These are the collection of " + permit + " Application(s) applied."
    );

    if (permit === "incoming") {
      permit = "incomplete";
    } else if (permit === "not-paid") {
      permit = "pending";
    } else if (permit === "paid") {
      permit = "accepted";
    }
    console.log(permit);

    $.ajax({
      url: "../assets/APIs/apps/" + permit + ".php",
      type: "GET",
      dataType: "json",
      success: function (data) {
        if (data.length > 0) {
          display_permit(data);
        } else {
          $("#permits").html("<h5>No Application found.</h5>");
        }
      },
      error: function (xhr, status, error) {
        $("#permits").html("<p>Error fetching data.</p>");
        console.log("error", error);
      },
    });
  }
  // Approval Button
  $(document).on("click", "#approval", function (e) {
    e.preventDefault();
    $.ajax({
      url: "../assets/APIs/apps/fetch_app.php",
      type: "POST",
      data: {
        app_type: $(this).data("type"),
        app_id: $(this).data("id"),
      },
      dataType: "json",
      success: function (response) {
        if (response.success && response.data.length > 0) {
          $.each(response.data, function (index, app) {
            var app_type = app.app_name.split(" ");
            app_type = app_type[0].toLowerCase();

            let confButton = "";
            let modalBody = "";
            $(document).on("click", "#reject", function (e) {
              e.preventDefault();
              confButton = "reject-button";
              modalBody = `Are you sure you Reject ${
                (app.first_name, app.last_name)
              }'s Application ?`;
              displayModal(modalBody, confButton, app.vendor_id, app_type);
            });
            $(document).on("click", "#approve", function (e) {
              e.preventDefault();
              confButton = "approve-button";
              modalBody = `Are you sure you Approve ${
                (app.first_name, app.last_name)
              }'s Application ?`;
              displayModal(modalBody, confButton, app.vendor_id, app_type);
            });

            $("#mBody").html(
              ` <h2>APPLICATION FORM</h2>
          <h2>The Revolutionary Government of Zanzibar</h2>
          <h3>The Environmental Management Act No. 3 of 2015</h3>
          <h3>The Ban on Plastic Carry Bags Regulations, 2018</h3>
          <h4>FORM NUMBER 1: IMPORT, EXPORT, POSSESSION, TRANSPORTATION, STORAGE OR THE USE OF THE PLASTIC RAW MATERIALS FOR AGRICULTURAL, INDUSTRIAL OR WASTE MANAGEMENT PURPOSES</h4>
          <p>[Made under regulation 7 (1) (a)]</p>

          <h2>1.0 PARTICULARS OF THE APPLICANT:</h2>
          <ol>
              <li>1.1 Full Name: ${(app.first_name, app.last_name)}</li>
              <li>1.2 Address for correspondence:
                  <ul>
                      <li>Contact person:${app.contact_person_name} </li>
                      <li>Position: ${app.role_in_office} </li>
                      <li>Address: ${app.office_address} </li>
                      <li>Phone No.: ${app.role_in_office} </li>
                      <li>E-mail: ${app.person_email}</li>
                  </ul>
              </li>
          </ol>

          <h2>2.0 PURPOSE AND DETAILS OF THE APPLICATION:</h2>
          <ol>
              <li>2.1 State the Reason for import, export, possess, transport, store or use of plastic raw materials:<br>
              ${app.reason}
              </li>
              <li>2.2 Type: ${app.type_of_plastic}</li>
              <li>2.3 Amount: ${app.amount}</li>
              <li>2.4 Size: ${app.size}</li>
              <li>2.5 Expected date of arrival: ${app.date_of_arrival}</li>
              <li>2.6 Place of Storage: ${app.place_of_storage}</li>
              <li>2.7 Duration of storage: ${app.duration}</li>
              <li>2.8 Uses: ${app.uses}</li>
              <li>2.9 Duration of uses: ${app.duration_of_uses}</li>
              <li>2.10 If need to be disposed: specify the amount to be disposed: ${
                app.amount_disposed
              }</li>
              <li>2.11 Indicate the proposed date for disposal: ${
                app.disposed_date
              }</li>
          </ol>

          <h3>Declaration:</h3>
          <p>I _________________________________ declare that, the information stated here above is true to best of my knowledge.</p>
          <p>Signature of Applicant: _________________________________</p>
          <p>Date: _________________________________</p>

          <h2>FOR OFFICE USE ONLY</h2>
          <p>Comment from the Relevant Head of Section:</p>
          <p>________________________________________________________</p>
          <p>Full name: _________________________________</p>
          <p>Signature: _________________________________</p>
          <p>Date: _________________________________</p>

          <p>Decision for the Director General of the Authority:</p>
          <p style="text-align: center;">________________________________________________________</p>

          <p style="text-align: center;">Signed and sealed</p>
          <p style="text-align: center;">Name: _________________________________</p>
          

          `
            );
          });
        } else {
          $("#mBody").html(`
        
        Error Getting Data From Server.
        `);
        }

        // Function to display the modal
        function displayModal(modalBody, confButton, vendor_id, app_type) {
          $("body").append(`
          <div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content shadow">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Approval Confirmation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  ${modalBody}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" id="${confButton}" data-dismiss="modal" data-status="1" data-type="${app_type}" class="btn btn-dark">Yes</button>
                </div>
              </div>
            </div>
          </div>
          `);

          // Bind the click event to the "Yes" button
          $(document).off("click", "#" + confButton); // Remove previous bindings
          $(document).on("click", "#" + confButton, function (e) {
            e.preventDefault();
            $.ajax({
              url: "../assets/APIs/users/inspector_approval.php",
              type: "POST",
              data: {
                approval: confButton,
                app_type: app_type,
                vendor_id: vendor_id,
              },
              dataType: "json",
              success: function (response) {
                if (response.success) {
                  console.log(response.message);
                  toastr.success(response.message);
                } else {
                  console.log(response.message);
                  toastr.error(response.message);
                }
              },
              error: function (xhr, status, error) {
                console.log("Error sending data to the server:", error);
                toastr.error("Error sending data. Please try again later.");
              },
            });
          });

          // Show the modal
          $("#confirmation").modal("show");
        }

        // Example usage:
        // displayModal("Are you sure you want to approve?", "approve-button", 123, "app_type");
      },
      error: function (xhr, status, error) {
        $("#permits").html("<p>Error fetching data.</p>");
        console.log("AJAX error:", error);
      },
    });
  });

  $(document).on("submit", ".permit-form", function (e) {
    e.preventDefault();
    var type = $(this).data("type");
    var form = $("#" + type + "-form").serialize();

    $.ajax({
      url: "../assets/APIs/" + type + ".php",
      type: "POST",
      data: form,
      dataType: "json",
      success: function (response) {
        if (response && response.success) {
          console.log(response.success);
          toastr.success(response.success);
          $("#" + type + "-form")[0].reset();
        } else if (response && response.message) {
          console.log(response.message);
          toastr.error(response.message);
        } else {
          console.log("Unexpected response format:", response);
          toastr.error("An unexpected response was received from the server.");
        }
      },
      error: function (xhr, status, error) {
        console.log("Error sending data to the server:", error);
        toastr.error("Error sending package. Please try again later.");
      },
    });
  });

  $(document).on("click", "#permit", function (e) {
    e.preventDefault();
    var permit = $(this).data("filter");

    window.location.href = "./permits.php?permit=" + encodeURIComponent(permit);
  });

  function display_permit(data) {
    var tBody = $("#permits");
    $.each(data, function (index, permits) {
      if (permits.app_status_id === 4) {
        tBody.append(`
                <tr class="permit-row" id="manager${permits.app_id}" >
                  <td>
                      <span class="list-img"><img src="../assets/images/clients/default.png" alt="">
                      </span><span class="list-enq-name">${
                        (permits.first_name, permits.last_name)
                      }</span>
                  </td>
                  <td>${permits.app_name}</td>
                  <td>${permits.phone_number}</td>
                  <td>${permits.app_date}</td>
                  <td><span class="badge badge-success">"Approved"</span></td>
                </tr>
                `);
      } else if (permits.app_status_id === 2) {
        tBody.append(`
                <tr class="permit_row" id="incoming${permits.app_id}" >
                  <td>
                      <span class="list-img"><img src="../assets/images/clients/default.png" alt="">
                      </span><span class="list-enq-name">${
                        (permits.first_name, permits.last_name)
                      }</span>
                  </td>
                  <td>${permits.app_name}</td>
                  <td>${permits.phone_number}</td>
                  <td>${permits.app_date}</td>
                  <td><span class="badge badge-primary">"Pending"</span></td>
                </tr>
                `);
      } else if (permits.app_status_name === "Incomplete") {
        tBody.append(`
                <tr class="permit-row" id="incoming${permits.app_id}" >
                  <td>
                      <span class="list-img"><img src="../assets/images/clients/default.png" alt="">
                      </span><span class="list-enq-name">${
                        (permits.first_name, permits.last_name)
                      }</span>
                  </td>
                  <td>${permits.app_name}</td>
                  <td>${permits.phone_number}</td>
                  <td>${permits.app_date}</td>
                  <td><span class="badge badge-secondary">"Incomplete"</span></td>
                </tr>
                `);
      } else if (permits.app_status_name === "Rejected") {
        tBody.append(`
                <tr class="permit-row" id="incoming${permits.app_id}">
                  <td>
                      <span class="list-img"><img src="../assets/images/clients/default.png" alt="">
                      </span><span class="list-enq-name">${
                        (permits.first_name, permits.last_name)
                      }</span>
                  </td>
                  <td>${permits.app_name}</td>
                  <td>${permits.phone_number}</td>
                  <td>${permits.app_date}</td>
                  <td><span class="badge badge-danger">"Rejected"</span></td>
                </tr>
                `);
      }
    });
  }

  // ----------------------------------
  // Users / Workers
  // ----------------------------------

  var users = getQueryParam("users");
  $(".users-header").text(users + " Staff(s)");
  $(".users-desc").text(
    "These are the collection of " + users + " Staff(s) available."
  );

  $(document).on("click", "#user", function (e) {
    e.preventDefault();
    var users = $(this).data("filter");
    window.location.href = "./users.php?users=" + encodeURIComponent(users);
  });
  $(document).on("click", "#change_status", function (e) {
    e.preventDefault();

    var button = $(this);
    var user_id = button.data("id");
    var user_status = button.data("status");
    var user = button.data("user");
    console.log(user);
    $.ajax({
      url: "../assets/APIs/disable.php",
      type: "post",
      data: { user_id, user_status, user },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          toastr.success(response.message);

          var statusCell = button.closest("tr").find("#status-cell span");

          if (user_status === 2) {
            button.removeClass("badge-success").addClass("badge-danger");
            // .fadeOut(250, function () {
            // After fadeOut, change text and fadeIn
            button.text("Disable").fadeIn(250);
            // });
            statusCell.removeClass("badge-danger").addClass("badge-success");
            // .fadeOut(250, function () {
            // After fadeOut, change text and fadeIn
            button.text("Disable").fadeIn(250);

            statusCell.text("Active").fadeIn(250);
            // });
            button.data("status", 1);

            // Slide up animation
            statusCell.slideUp(250, function () {
              // After slideUp, slide down
              statusCell.slideDown(250);
            });
            button.slideUp(250, function () {
              // After slideUp, slide down
              button.slideDown(250);
            });
          } else {
            button.removeClass("badge-danger").addClass("badge-success");
            // .fadeOut(250, function () {
            // After fadeOut, change text and fadeIn
            button.text("Enable").fadeIn("slow");
            // });
            statusCell.removeClass("badge-success").addClass("badge-danger");
            // .fadeOut(250, function () {
            // After fadeOut, change text and fadeIn
            statusCell.text("Inactive").fadeIn(250);
            // });
            button.data("status", 2);

            // Slide up animation
            statusCell.slideUp(250, function () {
              // After slideUp, slide down
              statusCell.slideDown(250);
            });
            button.slideUp(250, function () {
              // After slideUp, slide down
              button.slideDown(250);
            });
          }

          // Find and update the corresponding <span> element
        } else {
          toastr.error(response.message);
        }
      },
      error: function (xhr, status, error) {
        console.log("error", error);
        toastr.error("Error:", error);
      },
    });
  });
  $(document).on("click", "#reset_password", function (e) {
    e.preventDefault();

    $.ajax({
      url: "../assets/APIs/reset.php",
      type: "Post",
      data: {
        user_id: $(this).data("id"),
        user: $(this).data("user"),
      },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          toastr.success(response.message);
        } else {
          toastr.error(response.message);
        }
      },
      error: function (xhr, status, error) {
        toastr.success("error:", error);
        console.log("error", error);
      },
    });
  });

  // Function to fetch and display department members
  function fetchAndDisplayUsers() {
    $.ajax({
      url: "../assets/APIs/users/.php",
      type: "GET",
      dataType: "json",
      success: function (data) {
        if (data.length > 0) {
          displayUsers(data);
        } else {
          $("#depMember").html("<h5>No Staff found.</h5>");
        }
      },
      error: function (xhr, status, error) {
        $("#depMember").html("<p>Error fetching data.</p>");
        console.log("error", error);
      },
    });
  }

  // Function to display department members in the table
  function displayUsers(data) {
    var tBody = $("#depMember");
    $.each(data, function (index, user) {
      var user_status_name =
        user.user_status_name === "Active" ? "danger" : "success";
      var user_action =
        user.user_status_name === "Active" ? "success" : "danger";
      var user_status_action =
        user.user_status_name === "Active" ? "Inactive" : "Enable";
      var popover_content =
        user.user_status_name === "Active" ? "Inactive" : "Enable";

      tBody.append(`
              <tr>
                  <td>
                      <span class="list-img"><img src="../assets/images/clients/default.png" alt=""></span>
                      <span class="list-enq-name">${user.first_name}, ${user.middle_name}, ${user.last_name}</span>
                  </td>
                  <td>${user.username}</td>
                  <td>${user.phone_no}</td>
                  <td>${user.position}</td>
                  <td id="status-cell"><span class="badge badge-${user_action}">${user.member_status}</span></td>
                  <td>
                      <button class="btn btn-primary badge badge-${user_status_name}" 
                      data-toggle="popover" data-placement="left" data-trigger="hover" data-content="${popover_content}" 
                          id="change_status" data-user="user" data-status="${user.user_status_id}" 
                          data-id="${user.user_id}">
                          ${user_status_action}
                      </button>
                      <button class="btn btn-primary badge badge-danger" 
                          data-toggle="popover" data-content="Reset password" id="reset_password"
                          data-placement="bottom" data-trigger="hover" data-user="user" data-id="${client.client_id}">
                          <i class="fa fa-undo"></i>
                      </button>
                  </td>
              </tr>
          `);
    });

    $('[data-toggle="popover"]').popover();
  }

  // Initial fetch and display of user data
  fetchAndDisplayUsers();

  // ----------------------------------
  // Users / Client
  // ----------------------------------

  var clients = getQueryParam("clients");
  $(".clients-header").text(clients + " Client(s)");
  $(".clients-desc").text(
    "These are the collection of " + clients + " Client(s) available."
  );

  $(document).on("click", "#client", function (e) {
    e.preventDefault();
    var clients = $(this).data("filter");
    window.location.href =
      "./client.php?clients=" + encodeURIComponent(clients);
  });

  // Function to fetch and display client data
  function fetchAndDisplayclients() {
    $.ajax({
      url: "../assets/APIs/clients/" + clients + ".php",
      type: "GET",
      dataType: "json",
      success: function (data) {
        if (data.length > 0) {
          displayclients(data);
        } else {
          $("#clients").html("<h5>No Client found.</h5>");
        }
      },
      error: function (xhr, status, error) {
        $("#clients").html("<p>Error fetching data.</p>");
        console.log("error", error);
      },
    });
  }

  // Function to display clients in the table
  function displayclients(data) {
    var tBody = $("#clients");
    $.each(data, function (index, client) {
      var client_status_name =
        client.user_status_name === "Active" ? "success" : "danger";
      var client_action =
        client.user_status_name === "Active" ? "danger" : "success";
      var client_status_action =
        client.user_status_name === "Active" ? "Disable" : "Enable";
      var popover_content =
        client.user_status_name === "Active" ? "Disable" : "Enable";

      tBody.append(`
              <tr>
                  <td>
                      <span class="list-img"><img src="../assets/images/client/default.png" alt=""></span>
                      <span class="list-enq-name">${client.first_name}, ${client.last_name}</span>
                  </td>
                  <td>${client.username}</td>
                  <td>${client.phone_number}</td>
                  <td>${client.position}</td>
                  <td id="status-cell"><span class="badge badge-${client_status_name}">${client.user_status_name}</span></td>
                  <td>
                      <button class="btn btn-primary badge badge-${client_action}" 
                      data-toggle="popover" data-placement="left" data-trigger="hover" data-content="${popover_content}" 
                          id="change_status" data-user="client" data-status="${client.user_status_id}" 
                          data-id="${client.client_id}">
                          ${client_status_action}
                      </button>
                      <button class="btn btn-primary badge badge-danger" 
                          data-toggle="popover" data-content="Reset password" id="reset_password"
                          data-placement="bottom" data-trigger="hover" data-user="client" data-id="${client.client_id}">
                          <i class="fa fa-undo"></i>
                      </button>
                  </td>
              </tr>
          `);
    });

    $('[data-toggle="popover"]').popover();
  }

  // Initial fetch and display of client data
  fetchAndDisplayclients();

  // ----------------------
  //  Login Admin Section
  // ----------------------

  $(document).on("submit", "#admin-login-form-content", function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "dashboard/assets/APIs/admin_login_script.php",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          if (response.position == "Admin") {
            console.log("Login Success");
            toastr.success("Login Success");
            $("#admin-login-form-content")[0].reset();
            window.location.replace("dashboard/super_admin/index.php");
          } else if (response.position == "Inspector") {
            console.log("Login Success");
            toastr.success("Login Success");
            $("#admin-login-form-content")[0].reset();
            window.location.replace("dashboard/inspector/index.php");
          } else if (response.position == "Manager") {
            console.log("Login Success");
            toastr.success("Login Success");
            $("#admin-login-form-content")[0].reset();
            window.location.replace("dashboard/manager/index.php");
          }
        } else {
          console.log("Login Failed " + response.message);
          toastr.error("Login failed " + response.message);
        }
      },
      error: function (xhr, status, error) {
        console.log("Error sending data to the server:", error);
        toastr.error("Error sending package. Please try again later.");
      },
    });
  });

  // ----------------------
  //      logout Section
  // ----------------------

  $(document).on("click", "#sign-out-link", function (event) {
    event.preventDefault();
    window.location.replace("../assets/APIs/logout.php");
  });

  // Iron Scraper
  $("#iron-scraper-permit-form").submit(function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "../handlers/iron-scraper.php",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $("#iron-scraper-permit-form")[0].reset();
          toastr.success("Iron-Scraper Data submitted successfully.");
        } else {
          toastr.error(
            "An error occurred while processing Iron Scraper application. Please review your information and try again later."
          );
        }
      },
      error: function (xhr, status, error) {
        console.log("An error occurred while processing Server:", error);
        toastr.error(
          "An error occurred while processing your request. Please try again later."
        );
      },
    });
  });

  // Registration
  $("#register-form-content").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: "../client/registration.php",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
          console.log(response.success);
          toastr.success("Registration Success");
        } else {
          console.log("Registration Failed:", response.message);
          toastr.error("Registration Failed");
        }
      },
      error: function (xhr, status, error) {
        console.error("Server Error:", error);
        toastr.error("Something Went Wrong, try again.");
      },
    });
  });

  // ----------------------
  //      Register Client Section
  // ----------------------
  $("#client-registration").validate({
    rules: {
      first_name: "required",
      middle_name: "required",
      last_name: "required",
      address: "required",
      email: {
        required: true,
        email: true,
      },
      phone_number: "required",
      username: "required",
      profile_photo: "required",
      "register-ids": "required",
      "register-national-id": {
        required: function () {
          return $("#register-ids").val() === "national-id";
        },
      },
      "register-zan-id": {
        required: function () {
          return $("#register-ids").val() === "zan-id";
        },
      },
      "register-passport": {
        required: function () {
          return $("#register-ids").val() === "passport";
        },
      },
      id_number: "required",
      nationality: "required",
      password: "required",
      confirm_password: {
        required: true,
        equalTo: "#password",
      },
    },
    messages: {
      confirm_password: {
        equalTo: "Passwords do not match.",
      },
    },
    submitHandler: function (form, event) {
      event.preventDefault();

      if ($("#client-registration").valid()) {
        $.ajax({
          type: "POST",
          url: "./assets/APIs/clients/registration.php",
          data: $(form).serialize(),
          success: function (response) {
            if (response.success) {
              console.log(response);
              toastr.success("Client registered successfully");
              $(this)[0].reset();
            } else {
              toastr.error("Something went wrong");
            }
          },
          error: function (xhr, status, error) {
            console.error(xhr.responseText);
            toastr.success("Error :", error);
          },
        });
      }
    },
  });

  // ----------------------
  //      Register Staff Section
  // ----------------------
  $("#user-registration").validate({
    rules: {
      first_name: "required",
      middle_name: "required",
      last_name: "required",
      address: "required",
      email: {
        required: true,
        email: true,
      },
      phone_no: "required",
      username: "required",
      pwd: "required",
      confirm_password: {
        required: true,
        equalTo: "#pwd",
      },
    },
    messages: {
      confirm_password: {
        equalTo: "Passwords do not match.",
      },
    },
    submitHandler: function (form) {
      $.ajax({
        type: "POST",
        url: "../assets/APIs/users/registration.php",
        data: $(form).serialize(),
        dataType: "json",
        success: function (response) {
          if (response.success) {
            toastr.success("User Registered successfully.");
            console.log("User Registered successfully.");
          } else {
            toastr.error("Error: " + response.error);
            console.error("Error: " + response.error);
          }
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
        },
      });
      return false;
    },
  });

  // ----------------------
  //      User-Edit
  // ----------------------

  function dataExists($element) {
    return $.trim($element.text()) !== "";
  }

  $("#row2023 td").each(function () {
    if (!dataExists($(this))) {
      $(this).addClass("no-data");
    } else {
      $(this).addClass("data");
    }
  });

  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  $("#row2022 td").each(function () {
    if (!dataExists($(this))) {
      $(this).addClass("no-data");
    } else {
      $(this).addClass("data");

      var data_id = $(this).data("id");
      console.log(data_id);

      for (let i = 0; i < months.length; i++) {
        if (i === data_id) {
          $(`#data_${i}`).append(`<h5>${months[i]}</h5>`);
        }
      }
    }
  });

  // Get the current page pathname
  var currentPath = window.location.pathname;

  var fileName = currentPath.split("/").pop();

  $("#navMenu li").removeClass("active-menu");

  $("#navMenu li").each(function () {
    var link = $(this).find("a").attr("href");
    if (fileName === link.split("/").pop()) {
      $(this).addClass("active-menu");
    }
  });
});

function getQueryParam(name) {
  var urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(name);
}
