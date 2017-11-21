<?php 
//separa as barras da url para selecionar controlador e action
$uri = $_SERVER['REQUEST_URI'];
$uri_dashs = explode('/', $uri);
//seta o controlador e action default
$controller = 'HomeController';
$action = 'indexAction';

if(count($uri_dashs[1]) > 1){ // seta o controlador caso tenha na url
    $controller = ucfirst($uri_dashs[1]) . "Controller";
}
if(count($uri_dashs) > 2){ // seta a action caso tenha na url
    $action = $uri_dashs[2] . "Action";
}
$controller = new $controller(); //chama o controlador


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Teste OSTEC | <?php echo $controller->page_title; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    </head>
    <body>
        <?php
            require_once('view/includes/header.php'); // inclui o html do header
            $controller->$action(); // chama a action para mostrar a página
            require_once('view/includes/footer.php'); // inclui o html do footer
         ?>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    </body>
</html>