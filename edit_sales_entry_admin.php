<?php
session_start();
include('dbconfig.php');

// Ensure ID is provided
if (!isset($_GET['id'])) {
    echo "❌ No sale ID provided.";
    exit;
}

$id = intval($_GET['id']);

// Fetch sale record
$sale = mysqli_query($db, "SELECT * FROM sales_entry WHERE id='$id'");
if (!$sale || mysqli_num_rows($sale) == 0) {
    echo "❌ Sale record not found.";
    exit;
}

$row = mysqli_fetch_assoc($sale);

// Update logic
if (isset($_POST['update_sale'])) {
    $order_date = $_POST['order_date'];
    $order_from = $_POST['order_from'];
    $isbn = $_POST['isbn'];
    $book_title = $_POST['book_title'];
    $author = $_POST['author'];
    $quantity = $_POST['quantity'];
    $payment_received = $_POST['payment_received'];
    $discount_amount = $_POST['discount_amount'];
    $shipping_cost = $_POST['shipping_cost'];
    $net_sales = $_POST['net_sales'];
    $royalty = $_POST['royalty'];
    $status = $_POST['status'];

    $update_sql = "UPDATE sales_entry SET
        order_date='$order_date',
        order_from='$order_from',
        isbn='$isbn',
        book_title='$book_title',
        author='$author',
        quantity='$quantity',
        payment_received='$payment_received',
        discount_amount='$discount_amount',
        shipping_cost='$shipping_cost',
        net_sales='$net_sales',
        royalty='$royalty',
        status='$status'
        WHERE id='$id'";

    if (mysqli_query($db, $update_sql)) {
        header("Location: sales_entry_admin.php?updated=1");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($db);
    }
}

$setactive11 = "active";
include("adminheader.php");
?>

<style>
    /* Even lighter variant */
    .form-control::placeholder {
        color: #acb4c2 !important;
        opacity: 100;
        font-weight: normal;
    }

    /* Minimal custom styles to supplement Bootstrap */
    .form-header-custom {
        background: #9b27b0;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .form-header-custom::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .form-title-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 0.5rem;
    }

    .border-purple {
        border-color: #9b27b0 !important;
    }

    .text-purple {
        color: #9b27b0 !important;
    }

    .bg-purple {
        background-color: #9b27b0 !important;
    }

    .btn-purple {
        background-color: #9b27b0;
        border-color: #9b27b0;
        color: white;
    }

    .btn-purple:hover {
        background-color: #7b1fa2;
        border-color: #7b1fa2;
        color: white;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #9b27b0;
        box-shadow: 0 0 0 0.25rem rgba(155, 39, 176, 0.25);
    }

    .section-title-bar {
        border-left: 4px solid #9b27b0;
        padding-left: 0.75rem;
    }

    .form-label {
        color: rgba(0, 0, 0, 0.5); /* black with 50% opacity */
    }

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <!-- Card with purple border -->
            <div class="card border-purple shadow-lg rounded-3 overflow-hidden">
                <!-- Header -->
                <div class="form-header-custom p-4 position-relative">
                    <div class="position-relative" style="z-index: 1;">
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <h2 class="mb-0 fw-bold text-white">
                                    <span class="d-inline-flex align-items-center gap-3">
                                        <span class="bg-white bg-opacity-25 rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                            <i class="fas fa-edit fs-5"></i>
                                        </span>
                                        <span>Edit Sale Entry #<?php echo $row['id']; ?></span>
                                    </span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="card-body p-4">
                    <form method="POST" action="">
                        <!-- Order Information Section -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="order_date" class="form-label fw-semibold">
                                    Order Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="order_date" id="order_date" class="form-control" value="<?php echo $row['order_date']; ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label for="order_from" class="form-label fw-semibold">
                                    Order Platform <span class="text-danger">*</span>
                                </label>
                                <select name="order_from" id="order_from" class="form-select" required>
                                    <option value="">Select Platform</option>
                                    <option value="FlipKart" <?php if($row['order_from']=='FlipKart') echo 'selected'; ?>>Flipkart</option>
                                    <option value="Amazon" <?php if($row['order_from']=='Amazon') echo 'selected'; ?>>Amazon</option>
                                    <option value="Website" <?php if($row['order_from']=='Website') echo 'selected'; ?>>Website</option>
                                    <option value="Meesho" <?php if($row['order_from']=='Meesho') echo 'selected'; ?>>Meesho</option>
                                    <option value="Offline Order" <?php if($row['order_from']=='Offline Order') echo 'selected'; ?>>Offline Order</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Book Information Section -->
                        <h5 class="mb-3 section-title-bar fw-semibold">Book Information</h5>

                        <div class="mb-3">
                            <label for="isbn" class="form-label fw-semibold">
                                ISBN <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="isbn" id="isbn" class="form-control" value="<?php echo $row['isbn']; ?>" placeholder="Enter ISBN number" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="book_title" class="form-label fw-semibold">
                                    Book Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="book_title" id="book_title" class="form-control" value="<?php echo $row['book_title']; ?>" placeholder="Enter book title" required>
                            </div>

                            <div class="col-md-6">
                                <label for="author" class="form-label fw-semibold">
                                    Author <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="author" id="author" class="form-control" value="<?php echo $row['author']; ?>" placeholder="Enter author name" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Financial Information Section -->
                        <h5 class="mb-3 section-title-bar fw-semibold">Financial Details</h5>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label for="quantity" class="form-label fw-semibold">
                                    Quantity <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="quantity" id="quantity" class="form-control" value="<?php echo $row['quantity']; ?>" placeholder="0" required>
                            </div>

                            <div class="col-md-4">
                                <label for="payment_received" class="form-label fw-semibold">
                                    Payment <span class="text-danger">*</span>
                                </label>
                                <input type="number" step="0.01" name="payment_received" id="payment_received" class="form-control" value="<?php echo $row['payment_received']; ?>" placeholder="0.00" required>
                            </div>

                            <div class="col-md-4">
                                <label for="discount_amount" class="form-label fw-semibold">Discount</label>
                                <input type="number" step="0.01" name="discount_amount" id="discount_amount" class="form-control" value="<?php echo $row['discount_amount']; ?>" placeholder="0.00">
                            </div>

                            <div class="col-md-4">
                                <label for="shipping_cost" class="form-label fw-semibold">Shipping</label>
                                <input type="number" step="0.01" name="shipping_cost" id="shipping_cost" class="form-control" value="<?php echo $row['shipping_cost']; ?>" placeholder="0.00">
                            </div>

                            <div class="col-md-4">
                                <label for="net_sales" class="form-label fw-semibold">Net Sales</label>
                                <input type="number" step="0.01" name="net_sales" id="net_sales" class="form-control" value="<?php echo $row['net_sales']; ?>" placeholder="0.00">
                            </div>

                            <div class="col-md-4">
                                <label for="royalty" class="form-label fw-semibold">Royalty</label>
                                <input type="number" step="0.01" name="royalty" id="royalty" class="form-control" value="<?php echo $row['royalty']; ?>" placeholder="0.00">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pending" <?php if($row['status']=='pending') echo 'selected'; ?>>Pending</option>
                                <option value="completed" <?php if($row['status']=='completed') echo 'selected'; ?>>Completed</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <button type="button" class="btn btn-dark" onclick="window.location.href='sales_entry_admin.php'">
                                <i class="fas fa-times me-2"></i>Cancel
                            </button>
                            <button type="submit" name="update_sale" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>Update Sale
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
