<?php

// Defines a variable called PROJROOT which contains an absolute
// path to the root of the project
//
// __FILE__ is a magic constant used to retrieve the absolute path to
// the current running script. It will equal the correct file, even
// when called through an include().
//
// By resolving the path to the root directory relative to the /config
// directory, we can find the absolute project path no matter what file
// the config is included from.
define('PROJROOT', realpath(dirname(__FILE__).'/..'));
define('DBHOST', 'studentdb-maria.gl.umbc.edu');

// The database name of all users on GL is just their username
define('DBNAME', 'username');
define('DBUSER', 'username');
define('DBPASS', 'password');

?>