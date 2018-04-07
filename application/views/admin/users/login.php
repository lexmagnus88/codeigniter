    <form class="form-signin" id="login_form" action="login" method="POST">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h3 class="h4 mb-4 font-weight-normal">Sparkup Admin Login</h3>
        <?php echo validation_errors('<p class="alert alert-danger">'); ?>

        <?php if($this->session->flashdata('success')) : ?>
        <?php echo '<div class="alert alert-success">'.$this->session->flashdata('success').'</div>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')) : ?>
            <?php echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>'; ?>
        <?php endif; ?>

      <label for="username" class="sr-only">Username</label>
      <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>