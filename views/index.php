<?php
session_start();
error_reporting(0);

include_once('../functions/function.php');

if (!isset($_SESSION["fullname"])) {
  header("location:login");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Management</title>
  <link rel="shortcut icon" href="../views/icon.jfif" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../dist/css/styles.css">
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <style>
    .successful {
      background-color: green;
      color: white;
      font-size: 1.3em;
    }

    .error {
      background-color: red;
      color: #fff;
      font-size: 1.3em;
    }

    .plus-minus {
     
      padding: 20px;
      padding-bottom: 16px;
    }

    .fa-plus,.fa-minus { cursor: pointer;}
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class=" col-12">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-4">
              <h1 style="color: #3ab9dd;" id="heading"><b>Employee Management </b></h1>
            </div>
            <div class="col-4">
              <h5 class=''>
                <?php $firstName = explode(' ', $_SESSION["fullname"])?>
                Welcome,<?= $firstName[0]?>
               
              </h5>
            </div>
            <div class="col-4 float-right">
              <div class="btn-group float-right">
                <button type="button" class="btn btn-primary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Settings
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="change_password">Change Password</a>
                  <a class="dropdown-item" href="login?action=logout">Logout</a>
                </div>
              </div>

            </div>

          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <!-- /.card -->
              <!-- add modal opening -->
              <div class="card card-width">
                <div class="card-header">
                  <!-- <h3 class="card-title">DataTable with minimal features & hover style</h3> -->
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-modal">
                    Add Employee
                  </button>
                 
                  <div class="modal fade" id="add-modal" style="width:1400px;">
                    <div class="modal-dialog">
                      <div class="modal-content" style="width:650px;">

                        <div class="modal-header">
                          <h4 class="modal-title"> Add New Employee </h4>

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body modal-container">
                          <form id='form-body'>
                            <div class="card-body">
                              <div class="row">
                                <div class="form-group col-5">
                                  <input type="hidden" class="form-control" id="addId">

                                  <label>Full Name</label>
                                  <input type="text" class="form-control" id="fullname" placeholder="Full Name">
                                </div>
                                <div class="form-group col-5">
                                  <label>Email</label>
                                  <input type="email" class="form-control" id="email" placeholder="Email" required>
                                  <span id="wrong-email" style="display:none"></span>
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-5">
                                  <label>Phone</label>
                                  <input type="text" maxlength="13" class="form-control" id="phone" placeholder="Phone">
                                </div>
                                <div class="form-group col-5">
                                  <label>Level</label>
                                  <input type="number" class="form-control" id="level" placeholder="Level">
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-5">
                                  <label>D.O.B</label>
                                  <input type="date" class="form-control" id="dob" placeholder="D.O.B">
                                </div>
                                <div class="form-group col-5 new-one" id='fetchdepartment_2'></div>


                                <div class="plus-minus col-2 mt-3">
                                  <i class="fa fa-plus" title="Add Department" data-toggle="modal" data-target="#modal-addunitdepartment"></i>
                                  <i class=" fa fa-minus" onclick="deletecat_id()" title="Delete Selected Department" data-toggle="modal" data-target="#modal-deleteunitdepartment" style="padding-left: 10px;"></i>
                                </div>

                              </div>

                              <div class="row education-box">
                                <div class="form-group col-5">
                                  <label>Education</label>
                                  <input type="text" class="form-control" id="education" placeholder="Education">
                                </div>
                                <div class="form-group col-5">
                                  <label>Address</label>
                                  <input type="text" class="form-control" id="address" placeholder="Address">
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-5">
                                  <label>Guarantor</label>
                                  <input type="text" class="form-control" id="guarantor" placeholder="Guarantor">
                                </div>
                                <div class="form-group col-5">
                                  <label>Next of Kin</label>
                                  <input type="text" class="form-control" id="nextofkin" placeholder="Next of Kin">
                                  <p id="error-focus" style="width:200px;">All fields required, try again.</p>
                                </div>
                              </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                              <button type="button" class="btn btn-primary add" onclick="addData()">Submit</button>
                              <button type="button" class="btn float-right btn-secondary close-btn" data-dismiss="modal">Close</button>
                            </div>

                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal add -->
                </div>


                <div class="modal fade" id="modal-edit" style="width: 1400px;">
                  <div class="modal-dialog">
                    <div class="modal-content" style="width: 600px;">
                      <div class="modal-header">
                        <h4 class="modal-title">Update Employee Information</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body modal-container">
                        <form id='form-body'>
                          <div class="card-body">
                            <div class="row">
                              <div class="form-group col-6">
                                <label>Fullname</label>
                                <input type="text" class="form-control" id="editfullname" placeholder="Full Name">
                                <input type="hidden" class="form-control" id="editId" placeholder="Full name">
                              </div>
                              <div class="form-group col-6">
                                <label>Phone</label>
                                <input type="text" class="form-control" id="editphone" placeholder="phone">
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-6">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="editemail" placeholder="Email">
                              </div>
                              <div class="form-group col-6">
                                <label>Level</label>
                                <input type="number" class="form-control" id="editlevel" placeholder="Level">
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-6">
                                <label>D.O.B</label>
                                <input type="date" class="form-control" id="editdob" placeholder="D.O.B">
                              </div>
                              <div class="form-group col-6">
                                <div id="fetchdepartment"></div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-6">
                                <label>Education</label>
                                <input type="text" class="form-control" id="editeducation" placeholder="Education">
                              </div>
                              <div class="form-group col-6">
                                <label>Address</label>
                                <input type="text" class="form-control" id="editaddress" placeholder="Address">
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-6">
                                <label>Guarantor</label>
                                <input type="text" class="form-control" id="editguarantor" placeholder="Guarantor">
                              </div>
                              <div class="form-group col-6">
                                <label>Next of Kin</label>
                                <input type="text" class="form-control" id="editnextofkin" placeholder="Next of Kin">
                              </div>
                            </div>
                          </div>
                          <!-- /.card-body -->

                          <div class="card-footer">
                            <button type="button" class="btn btn-primary up-date" onclick="updateData()">Update</button>
                            <button type="button" class="btn float-right btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- /.card-header -->
                <!-- //new code -->
                <div id="displayemployee"></div>
                <!-- /.card-body -->

                <!-- ADD MORE DEPARTMENT MODAL -->
                <div id="modal-addunitdepartment" class=" modal modal-message modal-info fade" style="display: none;margin-top:310px;" aria-hidden="true">
                  <div class="modal-dialog" style="width:280px;">
                    <div class="modal-content" style="margin-left:10px;">
                      <input type="hidden" id="add_department" />
                      <div class="modal-header modal-header2">
                        <div class="modal-title">Add to Department</div>
                      </div>
                      <div class="form-group" style="margin-left:30px;">
                        <input require type="text" class="form-control mt-3" placeholder="Enter Department" style="width:90%;" id="unit_department">
                        <P id="add-more-error" style='display:none'>Field required</P>
                      </div>
                      <div class="modal-footer">
                        <div id="msg_delete_users" style="text-align:center; font-weight: bold; font-size:16px;"></div><br>
                        <button type="button" class="btn btn-success" id="adddepartment" onclick="add_new_department()" data-dismiss="modal">Add</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="adddepartment_close">Close</button>
                      </div>

                    </div>
                  </div>
                </div>

                <!-- DELETE MORE DEPARTMENT MODAL -->
                <div id="modal-deleteunitdepartment" class="modal modal-message modal-info fade" style="display: none;margin-top:310px;" aria-hidden="true">
                  <div class="modal-dialog" style="width:280px;">
                    <div class="modal-content " style="margin-left:10px;">
                      <input type="hidden" id="department_id" />
                      <div class="modal-header">
                        <div class="modal-title">Delete Department</div>
                      </div>
                      <div class="modal-body">Are you sure you want to delete these records?</div>
                      <div class="modal-footer">
                        <div id="msg_delete_department" style="text-align:center; font-weight: bold; font-size:16px;"></div><br>
                        <button type="button" class="btn btn-danger" id="deletedepartment" onclick="deletedepartment()" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="deletedepartment_close">Close</button>
                      </div>

                    </div>
                  </div>
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- ./wrapper -->
  <!-- For Dropdown -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- jQuery -->
  <!-- Bootstrap 4 -->
  <!-- DataTables  & Plugins -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="..plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example3").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <script src="../controllers/index-functions.js"></script>

  <script>
    loademployee();

    /*******Loading from display_employee.php *******/
    function loademployee() {
      $.ajax({
        type: "post",
        url: "../views/display_employee.php",
        success: function(data) {
          data = data.trim();
          $("#displayemployee").html(data);
        }

      });
    }
  </script>
</body>

</html>