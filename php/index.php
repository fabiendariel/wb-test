<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Invoice System</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div id="content">
    <?php if (!isset($_SESSION['user_id'])): ?>
        <h2>Register</h2>
        <form id="registerForm">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="telephone" placeholder="Telephone" required>
            <button type="submit">Register</button>
        </form>

        <h2>Login</h2>
        <form id="loginForm">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    <?php else: ?>
        <h2>Create Invoice</h2>
        <form id="invoiceForm">
            <input type="text" name="description" placeholder="Description" required>
            <input type="number" name="amount" placeholder="Amount" step="0.01" required>
            <input type="number" name="tax" placeholder="Tax" step="0.01" required>
            <input type="number" name="total" placeholder="Total" step="0.01" required>
            <button type="submit">Create Invoice</button>
        </form>
        <h2>Your Invoices</h2>
        <div id="invoiceList"></div>
    <?php endif; ?>
</div>

<script>
    $(document).ready(function() {
        $('#registerForm').submit(function(e) {
            e.preventDefault();
            $.post('register.php', $(this).serialize(), function(data) {
                alert(data);
                if (data === 'Success') {
                    location.reload();
                }
            });
        });

        $('#loginForm').submit(function(e) {
            e.preventDefault();
            $.post('login.php', $(this).serialize(), function(data) {
                if (data.startsWith('Invalid')) {
                    alert(data);
                } else {
                    location.reload();
                }
            });
        });

        $('#invoiceForm').submit(function(e) {
            e.preventDefault();
            $.post('create_invoice.php', $(this).serialize(), function(data) {
                alert(data);
                loadInvoices();
            });
        });

        function loadInvoices() {
            $.get('get_invoices.php', function(data) {
                $('#invoiceList').html(data);
            });
        }

        loadInvoices();
    });
</script>

</body>
</html>