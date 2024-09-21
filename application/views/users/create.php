<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Create User</h1>
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        
        <form method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" name="address" id="address" required></textarea>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" required>
            </div>
            <button type="submit" class="btn btn-primary" onsubmit="return addUser();">Create User</button>
            <a href="<?php echo site_url('users'); ?>" class="btn btn-secondary" >Back</a>

             <script>
            function addUser() {
             return confirm('User is added successfully!');
            }
</script>
        </form>
    </div>
</body>
</html>
