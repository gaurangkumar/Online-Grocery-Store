<?php
session_start();
if (!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header('Location: login.php');
    exit;
}

require '../dbcon.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: orders.php');
    exit;
}
$oid = (int) $_GET['id'];

$result = $conn->query('SELECT * FROM `order_items` WHERE `oid` = '.$oid);
$total_items = $result->num_rows;

$order = $conn->query('SELECT * FROM `ord` WHERE `oid` = '.$oid)
              ->fetch_assoc();

$user = $conn->query('SELECT * FROM `user` WHERE `uid` = '.$order['uid'])
              ->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
    $title = 'All Orders | Admin';
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
            <h1 class="h3 mb-0 text-gray-800">All Order Items (<?=$total_items?>)</h1>
            <!--<a href="category-add.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            	<i class="fa fa-plus-circle"></i> Create New
            </a>-->
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
                            <h4 class="card-title">
                                Order ID: <?=$oid?><br>
                                User: <?=ucwords($user['name'])?><br>
                                Total amount: ₹ <?=$order['total']?>
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Item_ID</th>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($total_items) {
                                            while ($row = $result->fetch_assoc()) {
                                                $product = $conn->query("SELECT `name`, `pic` FROM `product` WHERE `pid` = $row[pid]")
                                                    ->fetch_assoc(); ?>
                                        <tr>
                                            <td><?=$row['item_id']?></td>
                                            <td><img src="../<?=$product['pic']?>" width="100"></td>
                                            <td><?=ucwords($product['name'])?></td>
                                            <td><?=$row['quantity']?></td>
                                            <td><?=$row['amount']?></td>
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
