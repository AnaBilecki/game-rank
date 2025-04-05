<?php

include_once("templates/header.php");

if ($userData) {
    $userDao->destroyToken();
}
