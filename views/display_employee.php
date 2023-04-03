<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Management</title>
  <link rel="shortcut icon" href="../views/icon.jfif" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body>
  <?php
  session_start();
  error_reporting(0);

  if (!isset($_SESSION["fullname"])) {
    header("location:login");
  }

  ?>

  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped ">
      <thead>
        <tr>
          <th>Full Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Level</th>
          <th>Birth Date</th>
          <th>Department</th>
          <th>Education</th>
          <th>Address</th>
          <th>Guarantor</th>
          <th>Next of Kin</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $server = "localhost:3305";
        $dbname = "emp_management";
        $username = "root";
        $password = "";

        // Create connection
        $conn = mysqli_connect($server, $username, $password, $dbname);
        //exit;
        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $query = " SELECT e.fullname,e.email,e.phone,e.level,e.dob,e.education,e.address,e.guarantor,e.nextofkin,e.id, (select departmentname from department where id=e.department) departmentname  FROM employee e WHERE e.loginsession = '".$_SESSION['loginsession']."'";
        $response = mysqli_query($conn, $query);

        while ($rows = mysqli_fetch_array($response)) {
          $fullname = $rows['fullname'];
          $email = $rows['email'];
          $phone = $rows['phone'];
          $level = $rows['level'];
          $dob = $rows['dob'];
          $department = $rows['departmentname'];
          $education = $rows['education'];
          $address = $rows['address'];
          $guarantor = $rows['guarantor'];
          $nextofkin = $rows['nextofkin'];
          $id = $rows['id'];
          echo "<tr>
                    <td>$fullname</td>
                    <td>$email</td>
                    <td>$phone</td>    
                    <td>$level </td>
                    <td>$dob</td>
                    <td>$department</td>
                    <td>$education</td>
                    <td>$address</td>
                    <td>$guarantor</td>
                    <td>$nextofkin</td>
                    <td>
                      <button id='editbtn'  class='btn btn-primary' onclick='editData(" . $id . ")' data-toggle='modal' data-target='#modal-edit' title='Edit'><i class='fa fa-edit'></i></button>
                      <button  class='btn btn-danger' data-toggle='modal' data-target='#delete_emp_modal' onclick='get_info_id_for_delete(" . $id . ")' title='Delete'> <i class='fas fa-times'></i></button>
                    </td>
             </tr>";
        }

        ?>
      </tbody>
    </table>

    <div class="modal fade" id="delete_emp_modal" style="width:1400px;">
      <div class="modal-dialog">
        <div class="modal-content delete-confirm" style="width:650px;">
          <div class="modal-header">
            <h4 class="modal-title"> Delete Employee </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body ">
            <input type="hidden" id="delete-item">
            <p class="">Are you sure you want to permanently delete this employee data?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-toggle='modal' onclick='deleteData()'>Yes</button>
            <button type="button" class="btn float-right btn-warning" data-dismiss="modal">No</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>

  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
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
  <script src="../dist/js/index-functions.js"></script>
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "print", "colvis"]
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

</body>

</html>