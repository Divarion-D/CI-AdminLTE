<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$lang                       =   CMS_config('lang_syte');
$system_short_name          =   CMS_config('system_short_name');
?>
<!doctype html>
<html lang="<?php echo $lang; ?>">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $page_title . '-' . $system_short_name; ?></title>
<?php if ($mobile === FALSE): ?>
        <!--[if IE 8]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
<?php endif; ?>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="google" content="notranslate">
        <meta name="robots" content="noindex, nofollow">
        <link rel="icon" href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAqElEQVRYR+2WYQ6AIAiF8W7cq7oXd6v5I2eYAw2nbfivYq+vtwcUgB1EPPNbRBR4Tby2qivErYRvaEnPAdyB5AAi7gCwvSUeAA4iis/TkcKl1csBHu3HQXg7KgBUegVA7UW9AJKeA6znQKULoDcDkt46bahdHtZ1Por/54B2xmuz0uwA3wFfd0Y3gDTjhzvgANMdkGb8yAyY/ro1d4H2y7R1DuAOTHfgAn2CtjCe07uwAAAAAElFTkSuQmCC">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,700italic">
        <link rel="stylesheet" href="<?php echo base_url('assets/frameworks/font-awesome/css/all.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/frameworks/adminlte/css/adminlte.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck/css/blue.css'); ?>">
<?php if ($mobile === FALSE): ?>
        <!--[if lt IE 9]>
            <script src="<?php echo base_url('assets/plugins/html5shiv/html5shiv.min.js'); ?>"></script>
            <script src="<?php echo base_url('assets/plugins/respond/respond.min.js'); ?>"></script>
        <![endif]-->
<?php endif; ?>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">

        <?php include $page_name . '.php'; ?>
        
<?php include 'footer.php'; ?>

