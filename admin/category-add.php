<?php
session_start();
if (!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header('Location: login.php');
    exit;
}
require '../dbcon.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
    $title = 'Add Category | Admin';
    require 'include/head.php';
?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
<?php
    require 'include/sidebar.php';
?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
<?php
    require 'include/topbar.php';
?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Category</h1>
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12 mb-4">
                <form action="include/save-category.php" method="post" enctype="multipart/form-data">
                    <div class="form-group m-t-40">
                        <?php
                        if (!isset($_SESSION['msg']) || $_SESSION['msg'] == '') {
                        } else {
                            ?>
				        <div class="alert alert-<?=$_SESSION['msg']['type']?> alert-dismissable">
					        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					        <?=$_SESSION['msg']['msg']?>
				        </div>
                        <?php
                            $_SESSION['msg'] = '';
                            unset($_SESSION['msg']);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="Category Name">
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Select Parent Category</label>
                        <select class="form-control" id="parent_id" name="parent_id">
                        	<?php
                            $result = $conn->query('SELECT * FROM `category`');
                            if ($result->num_rows) {
                                while ($row = $result->fetch_array()) {
                                    echo '<option value="'.$row['cid'].'">'.ucwords($row['name']).'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                    	<button class="btn btn-primary">Save Category</button>
                    </div>
                </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

<?php
    require 'include/javascript.php';
?>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
