<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frameworks/bootstrap-4.0/css/bootstrap-reboot.min.css'; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/frameworks/bootstrap-4.0/css/bootstrap.min.css'; ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/style.min.css'; ?>">
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-12 bg-light border border-top-0 border-right-0 border-left-0">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url() . 'dashboard/'; ?>">Dashboard</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo base_url() . 'dashboard/'; ?>">Home</a>
            </li>
          </ul>
          <ul class="nav justify-content-end">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() . 'logout/'; ?>">Sair</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</div>
