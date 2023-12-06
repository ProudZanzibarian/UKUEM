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

    function display_departments(data, total_members) {
      var tBody = $("#departments");
      $.each(data, function (index, department) {
        $("#department_id").append(
          $("<option>", {
            value: department.department_id,
            text: department.department_name,
          })
        );
        tBody.append(`
                  <tr class="permit-row" id="${department.department_id}" >
                  <td>${department.department_id}</td>
                    <td>
                        </span><span class="list-enq-name">${department.department_name}</span>
                    </td>
                    <td>${department.head}</td>
                    <td>${department.member_count}</td>
                    <td><span class="badge badge-success" >Report</span></td>
                  </tr>
                  `);
      });
    }
    function display_members(data) {
      var mBody = $("#member_body");
      $.each(data, function (index, member) {
        $("#head").append(
          $("<option>", {
            value: member.id,
            text: member.first_name + " " + member.last_name,
          })
        );
        mBody.append(`
                  <tr class="permit-row" id="${member.id}" >
                    <td>
                        <span class="list-img"><img src="../assets/images/clients/default.png" alt="">
                        </span><span class="list-enq-name">${
                          member.first_name +
                          " " +
                          member.middle_name +
                          " " +
                          member.last_name
                        }</span>
                    </td>
                    <td>${member.user_name}</td>
                    <td>${member.phone_number}</td>
                    <td>${member.position}</td>
                    <td>${member.member_status}</td>
                    <td><span class="badge badge-success">Report</span></td>
                  </tr>
                  `);
      });
    }

    $.getJSON("../assets/APIs/apps/fetch_app.php", function (response) {
      if (response.success) {
        var departments = response.departments;
        var members = response.members;
        console.log(response.memberCounts);

        if (departments.length > 0 || members.length > 0) {
          if (members.length > 0) {
            console.log("members Hello");
            display_members(members);
            $("#number_members").html(`<h5>${members.length}</h5>`);
          } else {
            $("#member_body").html("<h5>No Member found.</h5>");
          }

          if (departments.length > 0) {
            display_departments(departments, members.length);
            $("#total_departments").html(`<h5>${departments.length}</h5>`);
          } else {
            $("#departments").html("<h5>No Department found.</h5>");
          }
        }
      }
    }).fail(function (xhr, status, error) {
      $("#members").html("<p>Error fetching data.</p>");
      $("#total_members").html("<p>Error fetching data.</p>");
      console.error("Ajax error:", error);
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

  // ----------------------------------
  // Users / Workers
  // ----------------------------------

  var members = getQueryParam("members");
  $(".members-header").text(members + " Member(s)");
  $(".members-desc").text(
    "These are the collection of " + members + " Member(s) available."
  );

  $(document).on("click", "#user", function (e) {
    e.preventDefault();
    var members = $(this).data("filter");
    window.location.href =
      "./members.php?members=" + encodeURIComponent(members);
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
  // function fetchAndDisplayUsers() {
  //   $.ajax({
  //     url: "../assets/APIs/users/.php",
  //     type: "GET",
  //     dataType: "json",
  //     success: function (data) {
  //       if (data.length > 0) {
  //         displayUsers(data);
  //       } else {
  //         $("#depMember").html("<h5>No Staff found.</h5>");
  //       }
  //     },
  //     error: function (xhr, status, error) {
  //       $("#depMember").html("<p>Error fetching data.</p>");
  //       console.log("error", error);
  //     },
  //   });
  // }

  // Function to display department members in the table
  // function displayUsers(data) {
  //   var tBody = $("#depMembers");
  //   $.each(data, function (index, user) {
  //     var user_status_name =
  //       user.user_status_name === "Active" ? "danger" : "success";
  //     var user_action =
  //       user.user_status_name === "Active" ? "success" : "danger";
  //     var user_status_action =
  //       user.user_status_name === "Active" ? "Inactive" : "Enable";
  //     var popover_content =
  //       user.user_status_name === "Active" ? "Inactive" : "Enable";

  //     tBody.append(`
  //             <tr>
  //                 <td>
  //                     <span class="list-img"><img src="../assets/images/clients/default.png" alt=""></span>
  //                     <span class="list-enq-name">${user.first_name}, ${user.middle_name}, ${user.last_name}</span>
  //                 </td>
  //                 <td>${user.username}</td>
  //                 <td>${user.phone_no}</td>
  //                 <td>${user.position}</td>
  //                 <td id="status-cell"><span class="badge badge-${user_action}">${user.member_status}</span></td>
  //                 <td>
  //                     <button class="btn btn-primary badge badge-${user_status_name}"
  //                     data-toggle="popover" data-placement="left" data-trigger="hover" data-content="${popover_content}"
  //                         id="change_status" data-user="user" data-status="${user.user_status_id}"
  //                         data-id="${user.user_id}">
  //                         ${user_status_action}
  //                     </button>
  //                     <button class="btn btn-primary badge badge-danger"
  //                         data-toggle="popover" data-content="Reset password" id="reset_password"
  //                         data-placement="bottom" data-trigger="hover" data-user="user" data-id="${client.client_id}">
  //                         <i class="fa fa-undo"></i>
  //                     </button>
  //                 </td>
  //             </tr>
  //         `);
  //   });

  //   $('[data-toggle="popover"]').popover();
  // }

  // Initial fetch and display of user data
  // fetchAndDisplayUsers();

  // ----------------------------------
  // Users / Client
  // ----------------------------------

  var member = getQueryParam("members");
  $(".member-header").text(member + " Member(s)");
  $(".member-desc").text(
    "These are the collection of " + member + " Member(s) available."
  );

  $(document).on("click", "#members", function (e) {
    e.preventDefault();
    var member = $(this).data("filter");
    window.location.href =
      "./members.php?members=" + encodeURIComponent(member);
  });

  // Function to fetch and display client data
  function fetchAndDisplayMembers() {
    var member = getQueryParam("members");
    $.getJSON({
      url: "../assets/APIs/users/" + member + ".php",
      success: function (data) {
        if (data.length > 0) {
          display_members(data);
        } else {
          $("#depMembers").html("<h5>No Member found.</h5>");
        }
      },
      error: function (xhr, status, error) {
        $("#depMembers").html("<p>Error fetching data.</p>");
        console.log("error", error);
      },
    });
  }

  // Function to display clients in the table
  function display_members(data) {
    var tBody = $("#depMembers");
    $.each(data, function (index, members) {
      var members_status_name =
        members.member_status_name === "Active" ? "success" : "danger";
      var members_action =
        members.member_status_name === "Active" ? "danger" : "success";
      var members_status_action =
        members.member_status_name === "Active" ? "Inactive" : "Enable";
      var popover_content =
        members.member_status_name === "Active" ? "Inactive" : "Enable";

      tBody.append(`
              <tr>
                  <td>
                      <span class="list-img"><img src="../assets/images/members/default.png" alt=""></span>
                      <span class="list-enq-name">${
                        members.first_name +
                        " " +
                        member.middle_name +
                        " " +
                        members.last_name
                      }</span>
                  </td>
                  <td>${members.username}</td>
                  <td>${members.phone_number}</td>
                  <td>${members.position}</td>
                  <td id="status-cell"><span class="badge badge-${members_status_name}">${members.user_status_name}</span></td>
                  <td>
                      <button class="btn btn-primary badge badge-${members_action}" 
                      data-toggle="popover" data-placement="left" data-trigger="hover" data-content="${popover_content}" 
                          id="change_status" data-user="members" data-status="${
                            members.user_status_id
                          }" 
                          data-id="${members.members_id}">
                          ${members_status_action}
                      </button>
                      <button class="btn btn-primary badge badge-danger" 
                          data-toggle="popover" data-content="Reset password" id="reset_password"
                          data-placement="bottom" data-trigger="hover" data-user="members" data-id="${
                            client.client_id
                          }">
                          <i class="fa fa-undo"></i>
                      </button>
                  </td>
              </tr>
          `);
    });

    $('[data-toggle="popover"]').popover();
  }

  // Initial fetch and display of client data
  fetchAndDisplayMembers();

  // ----------------------
  //  Login Section
  // ----------------------

  $(document).on("submit", "#login-form-content", function (e) {
    e.preventDefault();

    var formData = $(this).serialize();
console.log(formData);
    $.ajax({
      type: "POST",
      url: "../assets/APIs/login.php",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          console.log("Login Success");
          toastr.success("Login Success");
          $("#login-form-content")[0].reset();
          window.location.replace("dashboard/index.php");
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
      $.ajax({
    type: "POST",
    url: "../assets/APIs/logout.php",
    error: function (xhr, status, error) {
      console.error("Ajax error:", error);
    },
  });
  });

  // ----------------------
  //      Register Staff Section
  // ----------------------
  $.validator.addMethod(
    "dateBeforeCurrent",
    function (value, element) {
      // Parse the date values
      var currentDate = new Date();
      var selectedDate = new Date(value);

      // Compare the dates
      return selectedDate < currentDate;
    },
    "Please select a date before the current date."
  );
  $("#user-registration").validate({
    rules: {
      member_id: "required",
      first_name: "required",
      middle_name: "required",
      last_name: "required",
      user_name: "required",
      password: "required",
      email: {
        required: true,
        email: true,
      },
      phone_number: "required",
      position: "required",
      date_of_joining: {
        required: true,
        dateBeforeCurrent: true,
      },
      position_in_ukeum: "required",
      department_id: "required",
    },
    messages: {
      department_id: "Please select a department.",
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
            $(this)[0].reset();
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
