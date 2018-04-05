<h2 class="page-header">Add Page</h2>
<?php echo validation_errors('<p class="alert alert-danger">'); ?>

<?php echo form_open('admin/pages/add'); ?>
    <div class="form-group">
        <strong><?php echo form_label('Page Title', 'title'); ?></strong>
        <?php
            $data = array(
                'name' => 'title',
                'id' => 'title',
                'maxlength' => '100',
                'class' => 'form-control',
                'value' => set_value('title')
            );
        ?>
        <?php echo form_input($data); ?>
    </div>

    <!-- <div class="form-group">
        <?php //echo form_label('Subject', 'subject_id'); ?>
        <?php //echo form_dropdown('subject_id', $subject_options, array('class' => 'form-control custom-select')); ?>
    </div> -->

    <strong><?php echo form_label('Subject', 'subject_id'); ?></strong>
    <select id="subject_id" name="subject_id" class="form-control">
        <?php foreach($subject_options as $key=>$subject){
            echo "<option value='".$key."'>".$subject."</option>";
        }
    echo "</select>"; ?>

    <div class="form-group">
        <strong><?php echo form_label('Body', 'body'); ?></strong>
        <?php
            $data = array(
                'name' => 'body',
                'id' => 'body',
                'class' => 'form-control',
                'value' => set_value('subject')
            );
        ?>
        <?php echo form_textarea($data); ?>
    </div>

    <div class="form-group">
        <strong><?php echo form_label('Published', 'is_published'); ?></strong>
        <!-- 1 is selected by deafult -->
        <?php echo form_radio('is_published', 1, TRUE); ?> YES
        <?php echo form_radio('is_published', 0, FALSE); ?> NO
    </div>

    <div class="form-group">
        <strong><?php echo form_label('Feature', 'is_featured'); ?></strong>
        <?php echo form_radio('is_featured', 1, FALSE); ?> YES
        <!-- 1 is selected by deafult -->
        <?php echo form_radio('is_featured', 0, TRUE); ?> NO
    </div>

    <div class="form-group">
        <strong><?php echo form_label('Add to Menu', 'in_menu'); ?></strong>
        <!-- 1 is selected by deafult -->
        <?php echo form_radio('in_menu', 1, TRUE); ?> YES
        <?php echo form_radio('in_menu', 0, FALSE); ?> NO
    </div>

    <div class="form-group">
        <strong><?php echo form_label('Order', 'order'); ?></strong>
        <input type="number" class="form-control" name="order" id="order">
    </div> 

    <hr>
    <?php echo form_submit('mysubmit', 'Add Page', array('class' => 'btn btn-primary')); ?>
<?php echo form_close(); ?>