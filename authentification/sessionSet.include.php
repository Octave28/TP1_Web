<?php

define("DUREE_SESSION",time()+60*60);//Utilisée pour le cookie et timestamp.
                
ini_set("session.cookie_lifetime", DUREE_SESSION); // Durée de la session en secondes
ini_set("session.use_cookies", 1);
ini_set("session.use_only_cookies" , 1);
ini_set("session.use_strict_mode", 1);
ini_set("session.cookie_httponly", 1);
ini_set("session.cookie_secure", 1);//Pour docker local. Mettre à 1 en production sur techninfo420.
ini_set("session.cookie_samesite" , "Strict");
ini_set("session.cache_limiter" , "nocache");
ini_set("session.hash_function" , "sha512");

session_name("ouvert"); //C'est la session pour l'authentification