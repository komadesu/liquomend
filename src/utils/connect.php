<?php
require '../../../secret.php';
$dbconn = pg_connect("host=localhost dbname=$SQL_DB user=$SQL_USER password=$SQL_PASS")
  or die('Could not connect: ' . pg_last_error());
