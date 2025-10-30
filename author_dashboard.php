<?php
ini_set('display_errors', 0);
session_start();
include('dbconfig.php');

if(!isset($_SESSION['isbn'])){
    header("Location: login.php");
    exit;
}

$isbn = $_SESSION['isbn'];

// Get filter values
$from_date = $_GET['from_date'] ?? '';
$to_date = $_GET['to_date'] ?? '';
$platform = $_GET['platform'] ?? '';

// Get book details
$book_query = mysqli_query($db, "SELECT book_title, author FROM sales_entry WHERE isbn='$isbn' LIMIT 1");
$book_info = mysqli_fetch_assoc($book_query);

// Build WHERE clause with filters
$where = "isbn='$isbn'";
if(!empty($from_date)){
    $where .= " AND order_date >= '" . mysqli_real_escape_string($db, $from_date) . "'";
}
if(!empty($to_date)){
    $where .= " AND order_date <= '" . mysqli_real_escape_string($db, $to_date) . "'";
}
if(!empty($platform)){
    $where .= " AND order_from = '" . mysqli_real_escape_string($db, $platform) . "'";
}

$sales = mysqli_query($db, "SELECT * FROM sales_entry WHERE $where ORDER BY order_date DESC");

// Calculate totals
$total_sales = 0;
$total_royalty = 0;
$total_quantity = 0;
$sales_data = [];

while($row = mysqli_fetch_assoc($sales)){
    $sales_data[] = $row;
    $total_sales += $row['net_sales'];
    $total_royalty += $row['royalty'];
    $total_quantity += $row['quantity'];
}

// Get unique platforms for dropdown
$platforms_query = mysqli_query($db, "SELECT DISTINCT order_from FROM sales_entry WHERE isbn='$isbn' ORDER BY order_from");
$platforms = [];
while($p = mysqli_fetch_assoc($platforms_query)){
    $platforms[] = $p['order_from'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Dashboard</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-custom {
            background: #9b27b0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .stats-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-left: 4px solid #9b27b0;
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            background: rgba(155, 39, 176, 0.1);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9b27b0;
        }

        .stats-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .table-container {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .table thead th {
            background-color: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
            border: none;
            padding: 1rem;
            font-size: 0.9rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #f0f0f0;
        }

        .status-pending {
            display: inline-block;
            padding: 0.35rem 0.9rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.85rem;
            background-color: #fff4e5;
            color: #d58512;
            border: 1px solid #f5c26b;
        }

        .status-completed {
            display: inline-block;
            padding: 0.35rem 0.9rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.85rem;
            background-color: #eafaf1;
            color: #218838;
            border: 1px solid #a8e0b8;
        }

        .page-header {
            background: #9b27b0;
            color: white;
            padding: 2rem;
            border-radius: 0.75rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(155, 39, 176, 0.2);
        }

        .filter-container {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border: 1.5px solid #e0e0e0;
            border-radius: 0.5rem;
            padding: 0.6rem 0.85rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #9b27b0;
            box-shadow: 0 0 0 0.25rem rgba(155, 39, 176, 0.15);
        }

        .btn-filter {
            background: #9b27b0;
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-filter:hover {
            background: #7b1fa2;
            color: white;
        }

        .btn-reset {
            background: #6c757d;
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-reset:hover {
            background: #5a6268;
            color: white;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-custom navbar-dark mb-4">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">
            <i class="fas fa-book-reader me-2"></i>Author Dashboard
        </span>
        <a href="book-logout.php" class="btn btn-light btn-sm">
            <i class="fas fa-sign-out-alt me-2"></i>Logout
        </a>
    </div>
</nav>

<div class="container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white bg-opacity-25 rounded p-3">
                <i class="fas fa-book fs-2"></i>
            </div>
            <div>
                <h2 class="mb-1 fw-bold"><?php echo htmlspecialchars($book_info['book_title']); ?></h2>
                <p class="mb-0 opacity-75">
                    <i class="fas fa-user me-2"></i><?php echo htmlspecialchars($book_info['author']); ?>
                    <span class="ms-3"><i class="fas fa-barcode me-2"></i>ISBN: <?php echo htmlspecialchars($isbn); ?></span>
                </p>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-container">
        <h5 class="mb-3 fw-bold d-flex align-items-center gap-2">
            <i class="fas fa-filter" style="color: #9b27b0;"></i>
            Filter Sales Data
        </h5>
        <form method="GET" action="">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="from_date" class="form-label">From Date</label>
                    <input type="date" name="from_date" id="from_date" class="form-control" value="<?php echo htmlspecialchars($from_date); ?>">
                </div>
                <div class="col-md-3">
                    <label for="to_date" class="form-label">To Date</label>
                    <input type="date" name="to_date" id="to_date" class="form-control" value="<?php echo htmlspecialchars($to_date); ?>">
                </div>
                <div class="col-md-3">
                    <label for="platform" class="form-label">Platform</label>
                    <select name="platform" id="platform" class="form-select">
                        <option value="">All Platforms</option>
                        <?php foreach($platforms as $p): ?>
                            <option value="<?php echo htmlspecialchars($p); ?>" <?php echo ($platform == $p) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($p); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-filter flex-grow-1">
                            <i class="fas fa-search me-2"></i>Filter
                        </button>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-reset">
                            <i class="fas fa-redo me-2"></i>Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stats-label">Total Sales</div>
                        <div class="stats-value">₹<?php echo number_format($total_sales, 2); ?></div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-sack-dollar fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stats-label">Total Royalty</div>
                        <div class="stats-value">₹<?php echo number_format($total_royalty, 2); ?></div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-wallet fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stats-label">Books Sold</div>
                        <div class="stats-value"><?php echo $total_quantity; ?></div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-shopping-cart fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Table -->
    <div class="table-container">
        <h5 class="mb-4 fw-bold d-flex align-items-center gap-2">
            <i class="fas fa-list" style="color: #9b27b0;"></i>
            Sales History
        </h5>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Platform</th>
                    <th>Qty</th>
                    <th>Payment</th>
                    <th>Discount</th>
                    <th>Shipping</th>
                    <th>Net Sales</th>
                    <th>Royalty</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $serial = 1;
                foreach($sales_data as $row): ?>
                    <tr>
                        <td><?php echo $serial++; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row['order_date'])); ?></td>
                        <td><?php echo htmlspecialchars($row['order_from']); ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>₹<?php echo number_format($row['payment_received'], 2); ?></td>
                        <td>₹<?php echo number_format($row['discount_amount'], 2); ?></td>
                        <td>₹<?php echo number_format($row['shipping_cost'], 2); ?></td>
                        <td class="fw-bold">₹<?php echo number_format($row['net_sales'], 2); ?></td>
                        <td class="fw-bold text-success">₹<?php echo number_format($row['royalty'], 2); ?></td>
                        <td>
                            <span class="status-<?php echo strtolower($row['status']); ?>">
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
