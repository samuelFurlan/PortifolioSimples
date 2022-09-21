<?php

//const URL_BASE = "http://localhost/agenciasepiacliente";
const URL_BASE = "https://webapp277757.ip-104-237-128-25.cloudezapp.io";

const PATH_UPLOAD = __DIR__."/../themes/uploads";

const SITE = "Projeto Sepia";

const MAIL = [
    "host" => "",
    "port" => "",
    "user" => "",
    "passwd" => "",
    "from_name" => "",
    "from_email" => "",
];

const DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "clientesepia",
    "username" => "sepiacliente",
    "passwd" => "Sepia@9910",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];

function url(string $uri = null): string
{
    if ($uri) {
        return URL_BASE . "/{$uri}";
    }
    return URL_BASE;
}