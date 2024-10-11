<?php
require('db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="TMR E-BOSS version 2.0 developed by MIS Programmer">
    <meta name="author" content="Josh Alcantara">
    <title>Back Order Scheduling System</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datatables.min.css" rel="stylesheet">
    <link href="css/eboss.css" rel="stylesheet">
    <!-- Custom styles for sb-admin-2-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom fonts for sb-admin-2-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container-fluid row">
        <div class="col-md-3 shadowed ">
            <div class="col-md-12 row">
                <div class="col-md-6 text-center"><hr>
                    <img src="img/Vector.png" alt="" width="150"> 
                </div>
                <div class="col-md-6 text-center"><hr>
                    <p>Welcome, Name!</p>
                    <img src="img/reportlogo.png" alt="" width="150"><hr>
                    <p><?= date("M/d/Y h:sA") ?></p>
                </div>
            </div>
            <!-- Back Order Form -->
            <h6>Back Order Details</h6>
            <form action="" method="POST" class="mb-5">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control form-control-sm" id="ro_number" name="ro_number" placeholder="RO Number" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control form-control-sm" id="cs_number" name="cs_number" placeholder="CS Number" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control form-control-sm" id="customer_name" name="customer_name" placeholder="Customer Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control form-control-sm" id="model_description" name="model_description" placeholder="Model Description" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control form-control-sm" id="part_name" name="part_name" placeholder="Part Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control form-control-sm" id="part_number" name="part_number" placeholder="Part #" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control form-control-sm" id="order_number" name="order_number" placeholder="Order #" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="number" class="form-control form-control-sm" id="quantity" name="quantity" placeholder="Quantity" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control form-control-sm" id="status" name="status" placeholder="Status" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control form-control-sm" id="price" name="price" placeholder="Price" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="estimated_date_of_arrival">Estimated Date of Arrival</label>
                        <input type="date" class="form-control form-control-sm" id="estimated_date_of_arrival" name="estimated_date_of_arrival" required>
                    </div>
                </div>
                <div class="form-row float-right">
                    <button type="submit" class="btn btn-primary btn-sm">Add Back Order</button>
                </div>
            </form>

        </div>
        <div class="col-md-9">

            <!-- Back Order List -->
            <h3>Back Order List</h3>
            <table class="table table-bordered" id="backorderlist">
                <thead>
                    <tr>
                        <th>RO Number</th>
                        <th>CS Number</th>
                        <th>Customer Name</th>
                        <th>Model Description</th>
                        <th>Part Name</th>
                        <th>Part Number</th>
                        <th>Order Number</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Estimated Date of Arrival</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    

                    // Insert data into the database
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $ro_number = $_POST['ro_number'];
                        $cs_number = $_POST['cs_number'];
                        $customer_name = $_POST['customer_name'];
                        $model_description = $_POST['model_description'];
                        $part_name = $_POST['part_name'];
                        $part_number = $_POST['part_number'];
                        $order_number = $_POST['order_number'];
                        $quantity = $_POST['quantity'];
                        $status = $_POST['status'];
                        $price = $_POST['price'];
                        $estimated_date_of_arrival = $_POST['estimated_date_of_arrival'];

                        $sql = "INSERT INTO back_orders (ro_number, cs_number, customer_name, model_description, part_name, part_number, order_number, quantity, status, price, estimated_date_of_arrival) 
                        VALUES ('$ro_number', '$cs_number', '$customer_name', '$model_description', '$part_name', '$part_number', '$order_number', '$quantity', '$status', '$price', '$estimated_date_of_arrival')";

                        if ($conn->query($sql) === TRUE) {
                            echo "<script type='text/javascript'>
                                $(document).ready(function(){
                                    $('#successModal').modal('show');
                                });
                            </script>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    // Retrieve data from the database
                    $sql = "SELECT * FROM back_orders";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td>{$row['ro_number']}</td>
                            <td>{$row['cs_number']}</td>
                            <td>{$row['customer_name']}</td>
                            <td>{$row['model_description']}</td>
                            <td>{$row['part_name']}</td>
                            <td>{$row['part_number']}</td>
                            <td>{$row['order_number']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['estimated_date_of_arrival']}</td>
                          </tr>";
                        }
                    } else {
                        
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="successModalLabel">Success</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            New back order added successfully!
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>


    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/jquery-3.7.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/datatables.min.js"></script>
    <script>
        $('#backorderlist').DataTable({
            
        });
    </script>
</body>
</html>