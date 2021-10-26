<?php
defined('SITE_LOADED') OR exit('Access denied');
?>
<html lang="es">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/assets/css/styles.css">        
        <title><?php echo $this->title ?></title>
        <meta charset="UTF-8">
        
        <!-- Main CSS -->
        <link rel="stylesheet" type="text/css" href="assets/css/styles.css" />

    </head>
    <body>
<?php
//HEADER
include('sections/header.php');
//END HEADER

require_once ($this->view . '.php');

//FOOTER
include('sections/footer.php');
//END FOOTER
?>
    </body>
</html>


