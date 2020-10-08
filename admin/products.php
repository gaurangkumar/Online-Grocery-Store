<?php
session_start();
if (!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header('Location: login.php');
    exit;
}
require '../dbcon.php';

$result = $conn->query('SELECT * FROM `product` ORDER BY `pid` DESC');
$total_product = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
    $title = 'All Products | Admin';
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
            <h1 class="h3 mb-0 text-gray-800">All Products (<?=$total_product?>)</h1>
            <a href="product-add.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            	<i class="fa fa-plus-circle"></i> Create New
            </a>
          </div>

          <!-- Content Row -->
            <div class="row">
                <!-- column -->
                <div class="col-12">
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
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"> </h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Pid</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Weight</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($total_product) {
                                            while ($row = $result->fetch_assoc()) {
                                                $result1 = $conn->query("SELECT `name` FROM `category` WHERE `cid` = $row[cid]");
                                                $category = $result1->fetch_assoc(); ?>
                                        <tr>
                                            <td><?=$row['pid']?></td>
                                            <td><?=$row['name']?></td>
                                            <td><?=$row['price']?></td>
                                            <td><?=$row['discount']?></td>
                                            <td><?=$row['weight']?></td>
                                            <td><img src="../<?=$row['pic']?>" width="100"></td>
                                            <td><?=$category['name']?></td>
                                            <td class="text-nowrap">
                                                <a href="product-edit.php?id=<?=$row['pid']?>" class="btn btn-outline-info">
                                                	<i class="fa fa-close text-info"></i> Edit
                                                </a>
                                                <a href="include/product-delete.php?id=<?=$row['pid']?>" class="btn btn-outline-danger">
                                                	<i class="fa fa-close text-danger"></i> Remove
                                                </a>
                                            </td>
                                        </tr>
										<?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- column -->
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
