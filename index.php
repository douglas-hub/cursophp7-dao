<?php
require_once "config.php" ;



$result = new Usuario();

$result->getUser(5);

echo $result ;

?>