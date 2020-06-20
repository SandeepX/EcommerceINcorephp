<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo ADMIN_PAGE_TITLE; ?> | <?php echo (isset($page_title) && !empty($page_title)) ? $page_title : 'Admin Home'; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo ADMIN_CSS_URL; ?>bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo ADMIN_CSS_URL; ?>font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo ADMIN_CSS_URL; ?>nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo ADMIN_CSS_URL; ?>custom.min.css" rel="stylesheet">
  </head>

  <body class="<?php echo (getCurrentPage() == 'index') ? 'login' : 'nav-md' ?>">