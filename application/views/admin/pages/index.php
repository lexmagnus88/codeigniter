<h2 class="page-header">Pages</h2>

<?php if($this->session->flashdata('success')) : ?>
    <?php echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('error')) : ?>
    <?php echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>'; ?>
<?php endif; ?>

<hr>
<h4>List of Pages</h4>
<hr>
<?php if($pages) : ?>

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Published</th>
            <th>Title</th>
            <th>Author</th>
            <th>Date Created</th>
            <th>Action</th>
        </tr>
        <?php foreach($pages as $page) :

        if($page->is_published) :
            $publish_icon = 'fas fa-check';
        else :
            $publish_icon = 'fas fa-times';
        endif;

        $date = strtotime($page->create_date);
        $formatted_date = date('F j, Y, g:i a', $date);
            echo "<tr>".
                "<td>".$page->id."</td>".
                "<td><i class='".$publish_icon."'></i></td>".
                "<td>".$page->title."</td>".
                "<td>".$page->title."</td>".
                "<td>".$formatted_date."</td>"; ?>
                <td>
                    <?php echo anchor('admin/pages/edit/'.$page->id.'', 'Edit', 'class="btn btn-primary"'); ?>
                    <?php echo anchor('admin/pages/delete/'.$page->id.'', 'Delete', 'class="btn btn-danger"'); ?>
                </td>
                </tr>
        <?php endforeach; ?>
    </table>

<?php else : ?>

    <p>No Pages</p>

<?php endif; ?>