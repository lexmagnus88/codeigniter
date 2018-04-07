<h2 class="page-header">Users</h2>

<?php if($this->session->flashdata('success')) : ?>
    <?php echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('error')) : ?>
    <?php echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>'; ?>
<?php endif; ?>

<hr>
<h4>List of Users</h4>
<hr>
<?php if($users) : ?>

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Registered</th>
            <th>Action</th>
        </tr>
        <?php foreach($users as $user) :
        $date = strtotime($user->create_date);
        $formatted_date = date('F j, Y, g:i a', $date);
            echo "<tr>".
                "<td>".$user->id."</td>".
                "<td>".$user->first_name." ".$user->last_name."</td>".
                "<td>".$user->username."</td>".
                "<td>".$user->email."</td>".
                "<td>".$formatted_date."</td>"; ?>
                <td>
                    <?php echo anchor('admin/users/edit/'.$user->id.'', 'Edit', 'class="btn btn-primary"'); ?>
                    <?php echo anchor('admin/users/delete/'.$user->id.'', 'Delete', 'class="btn btn-danger"'); ?>
                </td>
                </tr>
        <?php endforeach; ?>
    </table>

<?php else : ?>

    <p>No Users</p>
    
<?php endif; ?>