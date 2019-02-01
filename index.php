<?php
require_once "config.php" ;


/*
$user = new Usuario("borges","8938");

$user->insert();

echo $user ;
*/

/*
$user = new Usuario();
$user->getUser(5) ;
$user->update("locoVeio" , "12345");
echo $user ;
*/


$user = new Usuario();
$user->getUser(8);
$user->delete();
echo $user ;

?>