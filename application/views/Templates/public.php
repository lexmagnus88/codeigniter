
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>My Website</title>

     <!-- Bootstrap core CSS -->
     <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Custom styles for this template -->
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url(); ?>"><?php echo $this->brand; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
      <?php foreach($this->pages as $page) : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>pages/show/<?php echo $page->slug; ?>"><?php echo $page->title; ?></a>
        </li>
      <?php endforeach; ?>
      </ul>
      <form class="form-inline my-2 my-lg-0">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item" style="margin-right: 20px;">
          <a class="nav-link" href="<?php echo base_url(); ?>admin">Admin</a>
        </li>
        </ul>
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" id="search" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<main role="main" class="container">
    <div class="jumbotron">
        <h1><?php echo $this->banner_heading; ?></h1>
        <p class="lead"><?php echo $this->banner_text; ?></p>
        <a class="btn btn-lg btn-primary" href="<?php echo $this->banner_link; ?>" role="button">View navbar docs &raquo;</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Load Main View -->
            <?php $this->load->view($main); ?>
        </div>
    </div>
</main>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../../../assets/js/vendor/popper.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    /*$('li a').click(function(e) {
        e.preventDefault();
        $('a').removeClass('active');
        $(this).addClass('active');
    });*/

    /*$( document ).ready(function() {
      var path = "http://localhost"+window.location.pathname;

      if(path == "http://localhost/codeigniter/admin"){
        $('#dashboard').addClass('active');
      }else{
        $('#dashboard').removeClass('active');
      }
      if(path == "http://localhost/codeigniter/admin/pages"){
        $('#pages').addClass('active');
      }else{
        $('#pages').removeClass('active');
      }
      if(path == "http://localhost/codeigniter/admin/subjects"){
        $('#subjects').addClass('active');
      }else{
        $('#subjects').removeClass('active');
      }
      if(path == "http://localhost/codeigniter/admin/users"){
        $('#users').addClass('active');
      }else{
        $('#users').removeClass('active');
      }

      $('#search').on('click', function(){
        alert('Work in progress');
        alert(path+" e "+href);
      });
        
    });*/
</script>
</body>
</html>
