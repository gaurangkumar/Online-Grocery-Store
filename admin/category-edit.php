<?php
session_start();
if (!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header('Location: login.php');
    exit;
}
require '../dbcon.php';
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: category.php');
    exit;
}
$cid = (int) $_GET['id'];
$result = $conn->query("SELECT * FROM `category` WHERE `cid` = $cid");
if (!$result->num_rows) {
    header('Location: category.php');
    exit;
}
$category = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
    $title = 'Edit Category | Admin';
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
            <h1 class="h3 mb-0 text-gray-800">Edit Category </h1>
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12 mb-4">
                <form action="include/update-category .php" method="post">
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
                        <label for="pid">CID</label>
                        <input class="form-control" id="cid" name="cid" type="number" placeholder="CID" value="<?=$category['cid']?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="Category Name" value="<?=$category['name']?>">
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Select Parent Category</label>
                        <select class="form-control" id="parent_id" name="parent_id">
                        	<?php
                            $result = $conn->query('SELECT * FROM `category` WHERE `cid` != '.$cid);
                            if ($result->num_rows) {
                                while ($row = $result->fetch_array()) {
                                    echo '<option value="'.$row['cid'].'" '.($category['cid'] == $row['cid'] ? 'selected' : '').'>'.ucwords($row['name']).'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                    	<button class="btn btn-primary">Update Product</button>
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

<?php
    require 'include/javascript.php';
?>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
