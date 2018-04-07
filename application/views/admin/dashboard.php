<h2 class="page-header">Dashboard</h2>
<?php if($this->session->flashdata('success')) : ?>
    <?php echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>'; ?>
<?php endif; ?>

<?php if($this->session->flashdata('error')) : ?>
    <?php echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>'; ?>
<?php endif; ?>
<h4>Recent Activities</h4>
<ul class="list-group">
    <?php
    foreach($activities as $activity) : 
        $date = strtotime($activity->create_date);
        $formatted_date = date('F j, Y, g:i a', $date); ?>
        <li class="list-group-item"><strong><?php echo $activity->message; ?></strong> - <?php echo $formatted_date; ?></li>
    <?php endforeach; ?>
</ul>