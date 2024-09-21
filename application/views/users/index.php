<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <a href="<?php echo site_url('users/create'); ?>" class="btn btn-primary mb-3">Create New User</a>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

       <h3>Users List</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                     <th>
                        <a href="<?= site_url('users/index?sort_by=id&sort_order=' . ($sort_order === 'asc' ? 'desc' : 'asc')) ?>">
                            ID <?= $sort_by === 'id' ? ($sort_order === 'asc' ? '▲' : '▼') : '' ?>
                        </a>
                    </th>
                    <th>
                        <a href="<?= site_url('users/index?sort_by=name&sort_order=' . ($sort_order === 'asc' ? 'desc' : 'asc')) ?>">
                            Name <?= $sort_by === 'name' ? ($sort_order === 'asc' ? '▲' : '▼') : '' ?>
                        </a>
                    </th>
                    <th>
                        <a href="<?= site_url('users/index?sort_by=email&sort_order=' . ($sort_order === 'asc' ? 'desc' : 'asc')) ?>">
                            Email <?= $sort_by === 'email' ? ($sort_order === 'asc' ? '▲' : '▼') : '' ?>
                        </a>
                    </th>
                    <th>
                        <a href="<?= site_url('users/index?sort_by=address&sort_order=' . ($sort_order === 'asc' ? 'desc' : 'asc')) ?>">
                            Address <?= $sort_by === 'address' ? ($sort_order === 'asc' ? '▲' : '▼') : '' ?>
                        </a>
                    </th>
                    <th>
                        <a href="<?= site_url('users/index?sort_by=phone&sort_order=' . ($sort_order === 'asc' ? 'desc' : 'asc')) ?>">
                            Phone <?= $sort_by === 'phone' ? ($sort_order === 'asc' ? '▲' : '▼') : '' ?>
                        </a>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['address'] ?></td>
                        <td><?= $user['phone'] ?></td>
                        <td>
                            <a href="<?= site_url('users/edit/' . $user['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                <form action="<?= site_url('users/delete/' . $user['id']); ?>" method="post" style="display:inline;" onsubmit="return confirmDelete();">
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this user?');
    }
</script>
  
        <?= $links ?>
    

    </div>
    
</body>
</html>
