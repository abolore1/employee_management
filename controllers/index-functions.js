function validateEmail(email) {
  let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function showAlert(message, className) {
  let div = document.createElement("div");

  div.className = `alert ${className}`;
  div.appendChild(document.createTextNode(message));
  const container = document.querySelector(".modal-container");
  const form = document.getElementById("form-body");
  container.insertBefore(div, form); //what and where

  setTimeout(function () {
    document.querySelector(".alert").remove();
  }, 3000);
}
$("#error-focus").hide();
/********* Adding Employee's Data ************/
function addData() {
  
  let fullname = $("#fullname").val();
  let phone = $("#phone").val();
  let email = $("#email").val();
  let level = $("#level").val();
  let dob = $("#dob").val();
  let department = $("#department").val();
  let education = $("#education").val();
  let address = $("#address").val();
  let guarantor = $("#guarantor").val();
  let nextofkin = $("#nextofkin").val();
  let data = {
    "fullname": fullname,
    "phone": phone,
    " email": email,
    "level": level,
    " dob": dob,
    " department": department,
    "education": education,
    " address": address,
    "guarantor": guarantor,
    "nextofkin": nextofkin,
    "action": "add",
  };

  if (fullname === "" || phone === "" || email === "" || level === "" || dob === "" || department === "" || education === "" || address === "" || guarantor === "" || nextofkin === "") {

    showAlert("All fields are required.", "error");
    if (screen.width <= 250) {
      $("#error-focus").css({'color':'red',
                             'font-size':'16px'
                            }).show().fadeOut(6000)

    }

  } else {
    if (!validateEmail(email)) {
      $('#wrong-email').html('Wrong email format').css({ 'display': 'block', 'color': 'red' }).fadeOut(3000);
      return false
    }
    $.ajax({
      url: "../models/index-process.php",
      type: "post",
      data: data,
      success: function (res) {
        if (res == "success") {
          showAlert("Employee successfully added!", "successful");
          setTimeout(function () {
            self.location = "../views/index";
          }, 3000)
        } else {
          showAlert("Something went wrong", "error");
        }
      },
      beforeSend: function () {
        $(".add").html("Adding...");
      },
    });
  }
}
/********* Editing Employee's Data ************/
function editData(id) {
  let data = {
    id: id,
    action: "edit",
  };

  $.ajax({
    url: "../models/index-process.php",
    type: "post",
    data: data,
    async: false,
    success: function (res) {
      let data = res.split("||");
      let date = new Date(data[4]);
      let currentDate = date.toISOString().slice(0, 10);

      $("#editfullname").val(data[0]);
      $("#editphone").val(data[1]);
      $("#editemail").val(data[2]);
      $("#editlevel").val(data[3]);
      $("#editdob").val(currentDate);

      deptselect = $.ajax({
        url: "../views/getdepartment.php",
        // departmentid from database in getdepartment.php
        data: "departmentid=" + data[5],
        async: false,
      }).responseText;

      $("#fetchdepartment").html(deptselect);
      $("#editeducation").val(data[6]);
      $("#editaddress").val(data[7]);
      $("#editguarantor").val(data[8]);
      $("#editnextofkin").val(data[9]);
      $("#editId").val(id);

      //let data = JSON.parse(res);
    },
  });
}

/********* Updating Employee's Data ************/
function updateData() {
  let fullname = $("#editfullname").val();
  let phone = $("#editphone").val();
  let email = $("#editemail").val();
  let level = $("#editlevel").val();
  let dob = $("#editdob").val();
  let department = $("#editdepartment").val();
  let education = $("#editeducation").val();
  let address = $("#editaddress").val();
  let guarantor = $("#editguarantor").val();
  let nextofkin = $("#editnextofkin").val();
  let id = $("#editId").val();

  let data = {
    "fullname": fullname,
    "phone": phone,
    "email": email,
    "level": level,
    "dob": dob,
    "department": department,
    "education": education,
    "address": address,
    "guarantor": guarantor,
    "nextofkin": nextofkin,
    "id": id,
    "action": "update",
  };

  $.ajax({
    url: "../models/index-process.php",
    type: "post",
    data: data,
    success: function (res) {
      if (res == "success") {
        // showAlert("Employee Updated Successfully!", "successful");
        self.location = "../views/index";
      } else {
        alert(res);
      }
    },
    beforeSend: function () {
      $(".up-date").html("Updating...");
    },
  });
}

/********* Getting ID of Employee's to Delete ************/
function get_info_id_for_delete(id) {
  $("#delete-item").val(id);
}
/********* Delete Employee's Data ************/
function deleteData() {
  let deleteitem = $("#delete-item").val();

  $.ajax({
    url: "../models/index-process.php",
    type: "post",
    data: {
      id: deleteitem,
      action: "delete",
    },
    success: function (res) {
      if (res == "success") {
        self.location = "../views/index";
      } else {
        alert(res);
      }
    },
  });
}

/********* calling this function to fetch Department from Select options after Adding new Departemnt ************/
departmentcat();

/*******  This return Department after adding from the Select option ******/
function departmentcat() {
  $.ajax({
    type: "POST",
    url: "../views/new_department.php",
    success: function (data) {
      data = data.trim();
      $("#fetchdepartment_2").html(data);
    }
  });
}


/*******  Adding new Department on the Select options with the + plus button *******/
function add_new_department() {
  let department = $('#unit_department').val();

  let data = {
    "department": department,
    "action": "add-new-department"
  };

  $.ajax({
    type: "POST",
    url: "../models/index-process.php",
    data: data,
    success: function (data) {
      data = data.trim();
      $('#unit_department').val('');
      departmentcat();
    }
  });

}
/********* Grabbing the id of Department to be Deleted from the Selected options *********/
function deletecat_id() {
  var id = $("#department").val();
  $("#department_id").val(id);
}
/********* Deleting Department from the Selected options with the - plus button *********/
function deletedepartment() {
  $("#department_id").val($("#department").val());
  let hidden_id = $("#department_id").val();
  let data = {
    "id": hidden_id
  };

  $.ajax({
    type: "POST",
    url: "../views/delete_new_department.php",
    data: data,
    success: function (res) {
      res = res.trim();

      if (res == 'success') {
        $("#deletedepartment").html("Yes");
        $("#deletedepartment").attr("disabled", false);

        $("#modal-deleteunitdepartment").click();
        departmentcat();

      } else {
        $("#deletedepartment").html("Yes");
      }
    },
    beforeSend: function () {
      $("#deletedepartment").html("Deleting Department...");
      $("#deletedepartment").attr('disabled', true);
    }
  });
}

/********To hide ADD button by default *********/
function hide_n_show() {
  $('#adddepartment').hide();
  let add_dept_input = document.getElementById('unit_department');

  add_dept_input.addEventListener('input', () => {
    /******** To hide ADD button without input value ********/
    if ($('#unit_department').val() === '') {
      $('#adddepartment').hide();
    } else {
      $('#adddepartment').show();
    }
  });
}
hide_n_show();


