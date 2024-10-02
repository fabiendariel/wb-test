<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Invoice System</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

<div class="container my-4">
    <?php if (!isset($_SESSION['user_id'])): ?>
        <h2>Register</h2>
         <form role="form" method="post" id="registerForm">
          <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" required name="email" placeholder="Email">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputUser" class="col-sm-2 col-form-label">User Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" required name="name" placeholder="Username">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" required name="password" placeholder="Password">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" required name="telephone" placeholder="Phone Number">
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
              <input type="submit" value="Register" name="submit" class="btn btn-primary"/>
            </div>
          </div>
        </form>

        <h2>Login</h2>
        <form id="loginForm">
          <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" required name="email" placeholder="Email">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" required name="password" placeholder="Password">
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
              <input type="submit" value="Login" name="submit" class="btn btn-primary"/>
            </div>
          </div>
        </form>
    <?php else: ?>
        <h2>Create Invoice</h2>
        <form id="invoiceForm">
          <div class="d-flex flex-row mb-3">
            <input class="mx-2" type="text" name="description" placeholder="Description" required>
            <input class="mx-2" type="number" name="amount" placeholder="Amount" step="0.01" required>
            <input class="mx-2" type="number" name="tax" placeholder="Tax" step="0.01" required>
            <input class="mx-2" type="number" name="total" placeholder="Total" step="0.01" required>
            <button class="btn btn-primary ml-4" type="submit">Create Invoice</button>
          </div>
        </form>
        <h2>Your Invoices</h2>
        <div id="invoiceList"></div>
    <?php endif; ?>
</div>

<script>
    $(document).ready(function() {
        /** Register form AJAX validation */
        $('#registerForm').submit(function(e) {
            e.preventDefault();
            $.post('register.php', $(this).serialize(), function(data) {
                alert(data);
                if (data === 'Success') {
                    location.reload();
                }
            });
        });
        /** Login form AJAX validation */
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
        /** Invoice form AJAX validation */
        $('#invoiceForm').submit(function(e) {
            e.preventDefault();
            $.post('create_invoice.php', $(this).serialize(), function(data) {
                alert(data);
                loadInvoices();
            });
        });
        
        /** Function to load existing invoices datas from the database */
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