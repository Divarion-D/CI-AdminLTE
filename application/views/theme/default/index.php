<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('X-Powered-By: Prod-domProjects.com');
header('X-XSS-Protection: 1');
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Vary: Accept-Encoding');

$lang            =   CMS_config('lang_syte');

?>
<!doctype html>
    <html lang="<?php echo $lang; ?>">
        <head prefix="og: http://ogp.me/ns#">
        <meta charset="UTF-8">
        <title>HOME</title>
        <meta name="description" content="">
        <meta name="HandheldFriendly" content="true">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta property="og:title" content="HOME">
        <meta property="og:type" content="article">
        <meta property="og:image" content="">
        <meta property="og:url" content="">
        <meta property="og:site_name" content="domProjects">
    </head>
    <body>
        <article>
            <h1>HOME</h1>
<?php if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()): ?>
            <p><a href="<?php echo site_url('admin'); ?>">Admin</a></p>
<?php endif; ?>

<?php if ($this->ion_auth->logged_in()): ?>
            <p><a href="<?php echo site_url('auth/logout/public'); ?>">Logout</a></p>
<?php else: ?>
            <p><a href="<?php echo site_url('auth/login'); ?>">Login</a></p>
<?php endif; ?>
        </article>

        <footer>

        </footer>
    </body>
</html>