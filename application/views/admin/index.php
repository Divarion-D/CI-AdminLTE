<?php
defined('BASEPATH') or exit('No direct script access allowed');

$lang                       =   CMS_config('lang_syte');
$system_short_name          =   CMS_config('system_short_name');
?>
<!doctype html>
<html lang="<?php echo $lang; ?>">

<head>
        <meta charset="UTF-8">
        <title><?php echo $page_title . '-' . $system_short_name; ?></title>
        <?php if ($mobile === FALSE) : ?>
                <!--[if IE 8]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
        <?php else : ?>
                <meta name="HandheldFriendly" content="true">
        <?php endif; ?>
        <?php if ($mobile == TRUE && $mobile_ie == TRUE) : ?>
                <meta http-equiv="cleartype" content="on">
        <?php endif; ?>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="google" content="notranslate">
        <meta name="robots" content="noindex, nofollow">
        <?php if ($mobile == TRUE && $ios == TRUE) : ?>
                <meta name="apple-mobile-web-app-capable" content="yes">
                <meta name="apple-mobile-web-app-status-bar-style" content="black">
                <meta name="apple-mobile-web-app-title" content="<?php echo $page_title; ?>">
        <?php endif; ?>
        <?php if ($mobile == TRUE && $android == TRUE) : ?>
                <meta name="mobile-web-app-capable" content="yes">
        <?php endif; ?>
        <link rel="icon" href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAqElEQVRYR+2WYQ6AIAiF8W7cq7oXd6v5I2eYAw2nbfivYq+vtwcUgB1EPPNbRBR4Tby2qivErYRvaEnPAdyB5AAi7gCwvSUeAA4iis/TkcKl1csBHu3HQXg7KgBUegVA7UW9AJKeA6znQKULoDcDkt46bahdHtZ1Por/54B2xmuz0uwA3wFfd0Y3gDTjhzvgANMdkGb8yAyY/ro1d4H2y7R1DuAOTHfgAn2CtjCe07uwAAAAAElFTkSuQmCC">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frameworks/font-awesome/css/all.min.css'); ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frameworks/ionicons/css/ionicons.min.css'); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frameworks/adminlte/css/adminlte.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/frameworks/adminlte/css/skins/skin-blue.min.css'); ?>">

        <?php if ($this->router->fetch_class() == 'groups' && ($this->router->fetch_method() == 'create' or $this->router->fetch_method() == 'edit')) : ?>
                <link rel="stylesheet" href="<?php echo base_url('assets/plugins/colorpickersliders/colorpickersliders.min.css'); ?>">
        <?php endif; ?>
        <link rel="stylesheet" href="<?php echo base_url('assets/frameworks/domprojects/css/dp.min.css'); ?>">
        <?php if ($mobile === FALSE) : ?>
                <!--[if lt IE 9]>
            <script src="<?php echo base_url('assets/plugins/html5shiv/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url('assets/plugins/respond/respond.min.js'); ?>"></script>
        <![endif]-->
        <?php endif; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
                <div class="preloader flex-column justify-content-center align-items-center">
                        <img class="animation__shake" src="/upload/Logo.png" alt="AdminLTELogo" height="60" width="60">
                </div>

                <?php include 'main_header.php'; ?>
                <?php include 'main_sidebar.php'; ?>

                <?php include $page_name . '.php'; ?>
                <?php include 'footer.php'; ?>