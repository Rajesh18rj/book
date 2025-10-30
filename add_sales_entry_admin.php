<?php
session_start();
include('dbconfig.php'); // This defines $db

if (isset($_POST['submit_sale'])) {
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

    $sql = "INSERT INTO sales_entry (
                order_date, order_from, isbn, book_title, author,
                quantity, payment_received, discount_amount,
                shipping_cost, net_sales, royalty, status
            ) VALUES (
                '$order_date', '$order_from', '$isbn', '$book_title', '$author',
                '$quantity', '$payment_received', '$discount_amount',
                '$shipping_cost', '$net_sales', '$royalty', '$status'
            )";

    if (mysqli_query($db, $sql)) {
        header("Location: sales_entry_admin.php?success=1");
        exit();
    } else {
        echo "Error: " . mysqli_error($db);
    }
}

$setactive11 = "active";
include("adminheader.php");
?>

<style>

    /* Even lighter variant */
    .form-control::placeholder {
        color: #acb4c2 !important;
        opacity: 50;
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
                                            <i class="fas fa-plus-circle fs-5"></i>
                                        </span>
                                        <span>Add New Sale Entry</span>
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
                                <label for="order_date" class="text-black-50 form-label fw-semibold">
                                    Order Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="order_date" id="order_date" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="order_from" class="text-black-50 form-label fw-semibold">
                                    Order Platform <span class="text-danger">*</span>
                                </label>
                                <select name="order_from" id="order_from" class="form-select" required>
                                    <option value="">Select Platform</option>
                                    <option value="FlipKart">Flipkart</option>
                                    <option value="Amazon">Amazon</option>
                                    <option value="Website">Website</option>
                                    <option value="Meesho">Meesho</option>
                                    <option value="Offline Order">Offline Order</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Book Information Section -->
                        <h5 class="mb-3 section-title-bar fw-semibold">Book Information</h5>

                        <div class="mb-3">
                            <label for="isbn" class="text-black-50 form-label fw-semibold">
                                ISBN <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="isbn" id="isbn" class="form-control" placeholder="Enter ISBN number" required>
                            <small id="isbn_message" class="form-text"></small>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="book_title" class="text-black-50 form-label fw-semibold">
                                    Book Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="book_title" id="book_title" class="form-control" placeholder="Enter book title" required>
                            </div>

                            <div class="col-md-6">
                                <label for="author" class="text-black-50 form-label fw-semibold">
                                    Author <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="author" id="author" class="form-control" placeholder="Enter author name" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Financial Information Section -->
                        <h5 class="mb-3 section-title-bar fw-semibold">Financial Details</h5>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label for="quantity" class="text-black-50 form-label fw-semibold">
                                    Quantity <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="0" required>
                            </div>

                            <div class="col-md-4">
                                <label for="payment_received" class="text-black-50 form-label fw-semibold">
                                    Payment <span class="text-danger">*</span>
                                </label>
                                <input type="number" step="0.01" name="payment_received" id="payment_received" class="form-control" placeholder="0.00" required>
                            </div>

                            <div class="col-md-4">
                                <label for="discount_amount" class="text-black-50 form-label fw-semibold">Discount</label>
                                <input type="number" step="0.01" name="discount_amount" id="discount_amount" value="0" class="form-control" placeholder="0.00">
                            </div>

                            <div class="col-md-4">
                                <label for="shipping_cost" class="text-black-50 form-label fw-semibold">Shipping</label>
                                <input type="number" step="0.01" name="shipping_cost" id="shipping_cost" value="0" class="form-control" placeholder="0.00">
                            </div>

                            <div class="col-md-4">
                                <label for="net_sales" class="text-black-50 form-label fw-semibold">Net Sales</label>
                                <input type="number" step="0.01" name="net_sales" id="net_sales" value="0" class="form-control" placeholder="0.00">
                            </div>

                            <div class="col-md-4">
                                <label for="royalty" class="text-black-50 form-label fw-semibold">Royalty</label>
                                <input type="number" step="0.01" name="royalty" id="royalty" value="0" class="form-control" placeholder="0.00">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="text-black-50 form-label fw-semibold">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <button type="button" class="btn btn-dark" onclick="window.location.href='sales_entry_admin.php'">
                                <i class="fas fa-times me-2"></i>Cancel
                            </button>
                            <button type="submit" name="submit_sale" class="btn btn-success">
                                <i class="fas fa-check me-2"></i>Add Sale
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('isbn').addEventListener('blur', function() {
        const isbn = this.value.trim();
        const msg = document.getElementById('isbn_message');
        if (isbn !== '') {
            fetch(`get_product.php?isbn=${encodeURIComponent(isbn)}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.book_title) {
                        document.getElementById('book_title').value = data.book_title;
                        document.getElementById('author').value = data.author;
                        msg.textContent = '✅ Product found!';
                        msg.className = 'form-text text-success fw-semibold';
                    } else {
                        document.getElementById('book_title').value = '';
                        document.getElementById('author').value = '';
                        msg.textContent = '❌ No product found for this ISBN';
                        msg.className = 'form-text text-danger fw-semibold';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    msg.textContent = '⚠️ Error fetching product data';
                    msg.className = 'form-text text-danger fw-semibold';
                });
        } else {
            msg.textContent = '';
        }
    });
</script>
