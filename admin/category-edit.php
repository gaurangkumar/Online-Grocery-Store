<?php
session_start();
if (!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header('Location: login.php');
    exit;
}
require 'include/dbcon.php';
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: products.php');
    exit;
}
$pid = (int) $_GET['id'];
$result = $conn->query("SELECT * FROM `product` WHERE `pid` = $pid");
if (!$result->num_rows) {
    header('Location: products.php');
    exit;
}
$product = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
    $title = 'Edit Product | Admin';
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
            <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12 mb-4">
                <form action="include/update-product.php" method="post" enctype="multipart/form-data">
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
                        <label for="pid">PID</label>
                        <input class="form-control" id="pid" name="pid" type="number" placeholder="PID" value="<?=$product['pid']?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="Product Name" value="<?=$product['name']?>">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input class="form-control" id="price" name="price" type="number" placeholder="Product Price" value="<?=$product['price']?>">
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input class="form-control" id="discount" name="discount" type="number" value="0" placeholder="Product Discount" value="<?=$product['discount']?>">
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input class="form-control" id="weight" name="weight" type="text" placeholder="Product Weight" value="<?=$product['weight']?>">
                    </div>
                    <div class="form-group">
                        <label for="pic">Image</label>
                        <input class="form-control" id="pic" name="pic" type="file" placeholder="Product Image">
                    </div>
                    <div class="form-group">
                        <img src="../<?=$product['pic']?>" width="100" class="img-thumbnail" alt="<?=$product['name']?>">
                    </div>
                    <div class="form-group">
                        <label for="cid">Select Category</label>
                        <select class="form-control" id="cid" name="cid">
                        	<?php
                            $result = $conn->query('SELECT * FROM `category`');
                            if ($result->num_rows) {
                                while ($row = $result->fetch_array()) {
                                    echo '<option value="'.$row['cid'].'" '.($product['cid'] == $row['cid'] ? 'selected' : '').'>'.ucwords($row['name']).'</option>';
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
