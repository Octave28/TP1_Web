<?php
//  $parametresSession = session_get_cookie_params(); //Pour antidater (détruire) le cookie

//  setcookie(
//      session_name(), '', time()-60*60*24*30,
//      $parametresSession["path"], $parametresSession["domain"],
//      $parametresSession["secure"], $parametresSession["httponly"]
//  );
 session_destroy();
session_start();
header("Location: index.php");
exit();
?>