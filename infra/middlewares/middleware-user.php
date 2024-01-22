<?php

session_start();

if (!isset($_SESSION['id'])) {
  if (isset($_COOKIE['id']) && isset($_COOKIE['nome'])) {
    $_SESSION['id'] = $_COOKIE['id'];
    $_SESSION['nome'] = $_COOKIE['nome'];
  } else {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/tmaster/';
    header('Location: ' . $home_url);
  }
}