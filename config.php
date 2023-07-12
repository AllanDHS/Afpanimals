<?php

// Définition des constantes de connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_NAME','animals');
define('DB_USER','root');
define('DB_PASS','root');


// Définition des Variables de REGEX
define('REGEX_NAME', '/^[a-zA-ZÀ-ÖØ-öø-ÿ\' -]+$/');
define('REGEX_WEIGHT', '/^[0-9]+$/');