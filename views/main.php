<html>
<head>
  <title>Shareboard</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Shareboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNav" class="collapse navbar-collapse">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>">Home</a></li>
            <!--<li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>shares">Shares</a></li>-->
          </ul>

          <ul class="navbar-nav ms-auto">
            <?php if (isset($_SESSION['is_logged_in'])) : ?>
              <li class="welcome-nav me-3 mt-2">Welcome <?php echo $_SESSION['user_data']['name']; ?>!</li>
              <li class="nav-item"><a class="btn btn-light"  href="<?php echo ROOT_URL; ?>users/logout">Logout</a></li>
            <?php  else : ?>
              <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>users/login">Login</a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>users/register">Register</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
        <div class="row">
            <?php Messages::display(); ?>
            
            <?php require($view); ?>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
