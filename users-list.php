<?php
require_once 'config.php';
if ($_SESSION['status']==1) {
$result = mysqli_query($link, "SELECT users.id as id, email, name, surname, registration_date,
 active, banned, statuses.status as status FROM users 
 LEFT JOIN statuses ON statuses.id = users.status_id") or die (mysqli_error($link));
if (mysqli_num_rows($result) == 0) {
    echo 'There are no registered users yet';
} else {
    for ($users = []; $row = mysqli_fetch_assoc($result); $users[] = $row) ;
}
mysqli_free_result($result);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update-user'])) {
        $update_user = true;
    }
    else if (isset($_POST['delete-user'])) {
        $delete_id = $_POST['delete-user'];
        $result = mysqli_query($link, "SELECT status_id as status FROM users WHERE id='$delete_id'");
        $user_status = mysqli_fetch_assoc($result)['status'];
        if ($user_status != 1) {
            mysqli_query($link, "DELETE FROM users WHERE id='$delete_id' AND status_id!=1")
            or die (mysqli_error($link));
            $_SESSION['success_message'] = 'User with id: <b>' . $delete_id . ' 
</b>was successfully deleted<br>
 <a class="btn btn-link" href="/?page=profile">Go back to profile</a>';
            header('Location:/?page=success');
        }
        else {
            $_SESSION['error_message'] = 'User with id: <b>' . $delete_id . ' 
</b>was not deleted. Attention: you may not delete Admin.<br>
 In order to delete Admin you should change status to user first.';
            header('Location:/?page=error');
        }
    }
    else {
        $_SESSION['error_message'] = 'Something is going wrong. We found you to send us a request, but there 
are no parameters for this request (delete or update user)';
        header('Location:/?page=error');
    }
}

?>
<h4 class="text-primary text-center">List of registered users<span class="text-danger small">
        (only for admins accessable)
    </span></h4>
<table class="table table-striped table-hover text-center">
    <thead class="thead-dark">
    <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Reg_date</th>
        <th>Active</th>
        <th>Banned</th>
        <th>Status</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['surname']; ?></td>
            <td><?php echo $user['registration_date']; ?></td>
            <td><?php echo $user['active']; ?></td>
            <td><?php echo $user['banned']; ?></td>
            <td><?php echo $user['status']; ?></td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="update-user" value="<?php echo $user['id'] ?>">
                    <button type="submit" class="btn btn-secondary">update</button>
                </form>
            </td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="delete-user" value="<?php echo $user['id'] ?>">
                    <button type="submit" class="btn btn-secondary">delete</button>
                </form>
            </td>
        </tr>
    <?php if (isset($update_user) && $update_user==true) ?>
            <tr>
                <form action="update-user.php" method="post">
                    <td></td>
                    <td colspan="2">
                        <input value="<?php echo $user['name'];?>" type="text" name="name" placeholder="name"  class="form-control">
                    </td>
                    <td colspan="3">
                        <input value="<?php echo $user['surname'];?>" type="text" name="surname" placeholder="surname"  class="form-control">
                    </td>
                    <td>
                        <input value="<?php echo $user['banned'];?>" type="text" name="banned" placeholder="1/0"  class="form-control">
                    </td>
                    <td colspan="2">
                        <input  value="<?php echo $user['status'];?>" type="text" name="status" placeholder="admin/user"  class="form-control">
                    </td>
                    <td>
                        <input type="submit" class="btn btn-primary">
                    </td>
              </form>
            </tr>
            <?php  endforeach; ?>
    </tbody>
</table>

<?php }
else {
    header('Location: /');
}

?>


