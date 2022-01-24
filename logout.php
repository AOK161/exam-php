<?php
require 'functions/bdd-function.php';
require 'functions/coach-function.php';
checkAuthentification();
session_destroy();
header("Location: index.php");
?>;