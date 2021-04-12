<?php

include "dma/Writer.php";
include "dma/AuthWriter.php";
include "dma/ConfWriter.php";

$conf_path = "./dma.conf";
$auth_path = "./auth.conf";

$conf = new Dma\ConfWriter;
$conf->setFilepath($conf_path);
$conf->setConfig([
    "smarthost" => "smtp.gmail.com",
    "port" => 587,
    "securetransfer" => true,
    "starttls" => true,
    "opportunistic_tls" => true,
    "authpath" => $auth_path
]);
$conf->write();

$conf = new Dma\AuthWriter;
$conf->setFilepath($auth_path);
$conf->setConfig([
    "host" => "smtp.gmail.com",
    "username" => "user@gmail.com",
    "password" => "secret_password"
]);
$conf->write();