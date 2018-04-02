<h2 class="page-header">Subjects</h2>

<?php if($this->session->flashdata('success')) : ?>
    <?php echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>'; ?>
<?php endif; ?>
<hr>
<h4>List of Subjects</h4>
<hr>
<?php if($subjects) : ?>

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date Created</th>
            <th>Action</th>
        </tr>
        <?php foreach($subjects as $subject) :
        $date = strtotime($subject->create_date);
        $formatted_date = date('F j, Y, g:i a', $date);
            echo "<tr>".
                "<td>".$subject->id."</td>".
                "<td>".$subject->name."</td>".
                "<td>".$formatted_date."</td>"; ?>
                <td>
                    <?php echo anchor('admin/subjects/edit/'.$subject->id.'', 'Edit', 'class="btn btn-primary"'); ?>
                    <?php echo anchor('admin/subjects/delete/'.$subject->id.'', 'Delete', 'class="btn btn-danger"'); ?>
                </td>
                </tr>
        <?php endforeach; ?>
    </table>

<?php else : ?>

    <p>No Subjects</p>

<?php endif; ?>