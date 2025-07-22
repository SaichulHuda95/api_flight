<?php
require_once 'flight/Flight.php';
require_once 'function.php';

// Load semua routes dari modules/*
foreach (glob("modules/*/*.php") as $file) {
    require_once $file;
}

Flight::start();
