<?php
require_once "config.php" ;

$root = new Usuario();

$root->getUser(8);

echo $root  ;

?>