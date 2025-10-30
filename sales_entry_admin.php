<?php
session_start();
include('dbconfig.php');


// Handle deletion
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($db, "DELETE FROM sales_entry WHERE id='$id'");
    echo "<script>alert('Sale deleted successfully!'); window.location='".$_SERVER['PHP_SELF']."';</script>";
    exit;
}

// AJAX request for live ISBN search
if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    $isbn = mysqli_real_escape_string($db, $_GET['isbn'] ?? '');
    $where = "1";
    if($isbn) $where .= " AND isbn LIKE '%$isbn%'";
    $sales = mysqli_query($db, "SELECT * FROM sales_entry WHERE $where ORDER BY id DESC");
    while($row = mysqli_fetch_assoc($sales)){

        $status = strtolower(trim($row['status'])); // normalize the case
        $class = '';

        if ($status === 'pending') {
            $class = 'status-pending';
        } elseif ($status === 'completed') {
            $class = 'status-completed';
        }
        echo "<tr>
                <td>{$row['id']}</td>
                <td>".date('d/m/Y', strtotime($row['order_date']))."</td>
                <td>{$row['order_from']}</td>
                <td>{$row['isbn']}</td>
                <td>{$row['book_title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['payment_received']}</td>
                <td>{$row['discount_amount']}</td>
                <td>{$row['shipping_cost']}</td>
                <td>{$row['net_sales']}</td>
                <td>{$row['royalty']}</td>
                <td><span class='{$class}'>{$row['status']}</span></td>
                <td class='text-center justify-content-center gap-0'>
                    <a href='edit_sales_entry_admin.php?id={$row['id']}' title='Edit' class='text-primary me-2'><i class='fas fa-edit'></i></a>
                </td>
              </tr>";
    }
    exit;
}

$setactive11 = "active";
include("adminheader.php");

// Show messages
if (isset($_GET['updated']) && $_GET['updated'] == 1) {
    echo "<div class='alert alert-success'>✅ Sale updated successfully!</div>";
}
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<div class='alert alert-success'>✅ Sale added successfully!</div>";
}
?>


<style>
    body {
        background: #f0f2f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #343a40;
    }
    .content {
        padding: 2rem 0;
    }
    .card {
        margin-top: -3rem;
        background: #ffffff;
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1.2rem rgba(189,197,209,.2);
        border: none;
    }
    .card-header {
        background: linear-gradient(90deg, #007bff 0%, #0056b3 100%);
        color: white;
        border-radius: 0.5rem 0.5rem 0 0;
        font-size: 1.3rem;
        font-weight: 600;
        padding: 1rem 1.5rem;
        box-shadow: 0 0.2rem 1rem rgba(0,0,0,0.1);
    }
    .btn-success {
        background-color: #28a745;
        border: none;
        font-weight: 600;
        box-shadow: 0 0.2rem 0.5rem rgba(40,167,69,.4);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        padding: 0.45rem 1.1rem;
        border-radius: 0.4rem;
    }
    .btn-success:hover {
        background-color: #218838;
        box-shadow: 0 0.3rem 0.8rem rgba(33,136,56,.5);
    }
    #search_isbn {
        border-radius: 0.5rem;
        border: 1.5px solid #ced4da;
        padding: 0.5rem 0.8rem;
        font-size: 1.5rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: none;
        width: 100%;
        margin-right: 25rem !important;
        margin-left: -0.10rem ;
    }
    #search_isbn:focus {
        border-color: #9b27b0;
        box-shadow: 0 0 6px rgba(0,123,255,0.3);
        outline: none;
    }
    .filter-form label {
        font-weight: 600;
        margin-right: 0.5rem;
        color: #495057;
        white-space: nowrap;
        margin-top: 0.4rem;
    }
    .filter-form input[type="date"] {
        max-width: 170px;
        padding: 0.5rem 0.8rem;
        font-size: 0.9rem;
        border: 1.6px solid #ced4da;
        border-radius: 0.45rem;
        background-color: #fff;
        color: #495057;
        transition: all 0.25s ease;
        height: 40px;
        cursor: pointer;
    }

    .filter-form input#from_date {
        margin-right: 1rem; /* or the gap size you want */
    }

    .filter-form input#to_date {
        margin-right: 1rem;
    }

    .filter-form input[type="date"]:focus {
        border-color: #9b27b0;
        box-shadow: 0 0 8px rgba(155,39,176,0.4);
        outline: none;
    }

    .filter-form input[type="date"]:hover {
        border-color: #9b27b0;
        box-shadow: 0 0 8px rgba(155,39,176,0.2);
    }
    .filter-form input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
        border-radius: 50%;
        background-color: #f3e5f5;
        padding: 4px;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .filter-form input[type="date"]::-webkit-calendar-picker-indicator:hover {
        background-color: #e1bee7;
        transform: scale(1.1);
    }
    .filter-form .btn {
        min-width: 90px;
        padding: 0.45rem 0.7rem;
        font-weight: 600;
        border-radius: 0.4rem;
        box-shadow: none;
        transition: box-shadow 0.3s ease;
    }
    .filter-form .btn-primary:hover {
        box-shadow: 0 0 10px rgba(0,123,255,0.6);
    }
    .filter-form .btn-secondary:hover {
        box-shadow: 0 0 10px rgba(108,117,125,0.6);
    }
    .table {
        border-collapse: separate;
        border-spacing: 0 0.5rem;
        background: transparent;
        font-size: 0.80rem;
        font-weight: 700;
    }
    .table thead th {
        font-size: 0.85rem !important; /* smaller font size */
        font-weight: 700 !important; ;    /* bold font weight */
        background-color: #e9ecef;
        color: #212529;
        border: none;
        padding: 0.75rem 1rem;
        text-align: center;
        border-radius: 0.4rem;
        user-select: none;
    }

    .table tbody tr {
        background: #ffffff;
        box-shadow: 0 0.3rem 0.5rem rgba(136,136,136,0.05);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
        border-radius: 0.4rem;
    }
    .table tbody tr:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
    }
    .table tbody td {
        vertical-align: middle;
        padding: 0.75rem 1rem;
        text-align: center;
        border-top: none;
        color: #959693;
    }
    .table tbody td:first-child,
    .table thead th:first-child {
        padding-left: 1.5rem;
        text-align: left;
    }
    .table tbody td:last-child {
        padding-right: 1.5rem;
    }
    /* Action icons */
    .table tbody td .fas {
        font-size: 1.2rem;
        cursor: pointer;
        transition: color 0.3s ease;
    }
    .text-warning {
        color: #ffc107 !important;
    }
    .text-warning:hover {
        color: #e0a800 !important;
    }
    .text-danger {
        color: #dc3545 !important;
    }
    .text-danger:hover {
        color: #c82333 !important;
    }
    .card-title {
        background-color: #9b27b0;
        color: white;
        padding: 0.75rem 1.25rem;
        border-radius: 0.3rem;
        font-size: 1.4rem;
        font-weight: 700;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: inline-block;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        margin-bottom: 0;
    }

    .col-md-4 #search_isbn {
        width: 100%;
        padding: 0.55rem 1rem; /* more comfortable padding */
        font-size: 1rem;
        border-radius: 0.5rem; /* rounded corners */
        border: 1.5px solid #ced4da;
        box-shadow: none;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        background-color: #fff;
        color: #495057;
    }

    .col-md-4 #search_isbn::placeholder {
        color: #adb5bd; /* lighter placeholder color */
        font-weight: 500;
    }

    .col-md-4 #search_isbn:focus {
        border-color: #9b27b0; /* accent color on focus */
        box-shadow: 0 0 8px rgba(155, 39, 176, 0.4);
        outline: none;
    }

    .search-input-wrapper input.form-control {
        padding-left: 2.5rem; /* space for icon */
        font-size: 0.9rem;    /* smaller font size */
        height: 38px;         /* slightly smaller height */
        border-radius: 0.5rem;
        border: 1.5px solid #ced4da;
        transition: border-color 0.3s ease;
    }

    .search-input-wrapper input.form-control:focus {
        border-color: #9b27b0;
        box-shadow: 0 0 6px rgba(155, 39, 176, 0.4);
        outline: none;
    }

    .search-icon {
        position: absolute;
        top: 50%;
        left: 0.99rem;
        transform: translateY(-50%);
        color: #adb5bd;
        pointer-events: none; /* icon not clickable */
        font-size: 1rem;
    }

    .btn-icon {
        font-size: 0.95rem;     /* slightly larger font */
        padding: 0.35rem 0.9rem; /* comfortable padding */
        border-radius: 0.4rem;  /* rounded corners */
    }

    /* Base style for all statuses */
    .status-pending,
    .status-completed {
        display: inline-block;
        padding: 0.30rem 0.6rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.68rem;
        text-transform: capitalize;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        letter-spacing: 0.3px;
        transition: all 0.3s ease;
    }

    /* Pending status - light orange */
    .status-pending {
        background-color: #fff4e5;
        color: #d58512;
        border: 1px solid #f5c26b;
    }

    /* Completed status - light green */
    .status-completed {
        background-color: #eafaf1;
        color: #218838;
        border: 1px solid #a8e0b8;
    }

</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Header and Add Button -->
            <div class="col-12">
                <div class="card shadow-sm rounded">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-light rounded p-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: rgba(155, 39, 176, 0.1) !important;">
                                <i class="fas fa-receipt fs-1" style="color:#9b27b0;"></i>
                            </div>
                            <div>
                                <h3 class="m-0 fw-bold" style="color:#9b27b0;">All Sales</h3>
                                <p class="text-muted mb-0 small">Manage and track all your sales entries</p>
                            </div>
                        </div>


                        <div>
                            <button class="btn btn-success btn-md btn-icon" onclick="window.location.href='add_sales_entry_admin.php?action=add'">
                                <i class="fas fa-plus me-1"></i> Add New Sale
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filters -->
                        <div class="row mb-4 align-items-center justify-content-between">
                            <!-- Search Section - Left -->
                            <div class="col-md-4 col-lg-3 mb-2 mb-md-0">
                                <div class="position-relative search-input-wrapper">
                                    <input type="text" id="search_isbn" class="form-control pl-4" placeholder="🔍︎  Search by ISBN">
                                </div>
                            </div>

                            <!-- Date Filter Section - Right -->
                            <div class="col-md-8 col-lg-9">
                                <form method="GET" class="d-flex gap-2 align-items-center justify-content-end filter-form flex-wrap">
                                    <label for="from_date">From:</label>
                                    <input id="from_date" type="date" name="from_date" class="form-control" value="<?php echo $_GET['from_date'] ?? ''; ?>">
                                    <label for="to_date">To:</label>
                                    <input id="to_date" type="date" name="to_date" class="form-control" value="<?php echo $_GET['to_date'] ?? ''; ?>">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <button type="button" class="btn btn-dark" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>'">Reset</button>
                                </form>
                            </div>
                        </div>


                        <!-- Sales Table -->
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle text-nowrap">
                                <thead>
                                <tr>
                                    <th class="th">ID</th>
                                    <th>Date</th>
                                    <th>Order From</th>
                                    <th>ISBN</th>
                                    <th>Book Title</th>
                                    <th>Author</th>
                                    <th>Quantity</th>
                                    <th>Payment</th>
                                    <th>Discount</th>
                                    <th>Shipping</th>
                                    <th>Net Sales</th>
                                    <th>Royalty</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="sales_table_body">
                                <?php
                                $where = "1";
                                if (!empty($_GET['from_date'])) $where .= " AND order_date >= '".mysqli_real_escape_string($db,$_GET['from_date'])."'";
                                if (!empty($_GET['to_date'])) $where .= " AND order_date <= '".mysqli_real_escape_string($db,$_GET['to_date'])."'";

                                $sales = mysqli_query($db, "SELECT * FROM sales_entry WHERE $where ORDER BY id DESC");
                                while($row = mysqli_fetch_assoc($sales)){

                                    $status = strtolower(trim($row['status'])); // normalize the case
                                    $class = '';

                                    if ($status === 'pending') {
                                        $class = 'status-pending';
                                    } elseif ($status === 'completed') {
                                        $class = 'status-completed';
                                    }
                                    echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>".date('d/m/Y', strtotime($row['order_date']))."</td>
                                            <td>{$row['order_from']}</td>
                                            <td>{$row['isbn']}</td>
                                            <td>{$row['book_title']}</td>
                                            <td>{$row['author']}</td>
                                            <td>{$row['quantity']}</td>
                                            <td>{$row['payment_received']}</td>
                                            <td>{$row['discount_amount']}</td>
                                            <td>{$row['shipping_cost']}</td>
                                            <td>{$row['net_sales']}</td>
                                            <td>{$row['royalty']}</td>
                                            <td><span class='{$class}'>{$row['status']}</span></td>
                                            <td class='text-center justify-content-center gap-0'>
                                                <a href='edit_sales_entry_admin.php?id={$row['id']}' title='Edit' class='text-primary me-2 mx-2'><i class='fas fa-edit'></i></a>
                                            </td>
                                        </tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const isbnInput = document.getElementById('search_isbn');
    isbnInput.addEventListener('input', function(){
        const isbn = this.value;
        fetch(`<?php echo $_SERVER['PHP_SELF']; ?>?ajax=1&isbn=${encodeURIComponent(isbn)}`)
            .then(res => res.text())
            .then(html => document.getElementById('sales_table_body').innerHTML = html);
    });
</script>
