<?php
session_start();
require_once '../Modell/Felhasznalo.php';
require_once '../Modell/FelhasznaloiAdattar.php';
require_once 'FelhasznaloController.php';

//Inicializálás és példányosítás
$controller = new FelhasznaloController();
$atiranyitasiHely = '../View/index.php';
$esemeny = $_REQUEST['action'] ?? '';

// Beolvasás ha POST kérés érkezik
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fNev = $_POST['fNev'] ?? '';
    $fJelszo = $_POST['fJelszo'] ?? '';
    $email = $_POST['email'] ?? '';
}


//Események kezelése
switch ($esemeny) {
    case 'login':
        if ($controller->bejelentkezes($fNev, $fJelszo)) {
            $_SESSION['fNev'] = $fNev;
            $atiranyitasiHely = '../View/welcome.php';
        }
        break;
    case 'register':
        if ($controller->regisztralas($fNev, $email, $fJelszo)) {
            $atiranyitasiHely = '../View/index.php';
        }
        break;
    case 'logout':
        $controller->kijelentkezes();
        $atiranyitasiHely = '../View/index.php';
        break;
    default:
        break;
}

header("Location: $atiranyitasiHely");
exit();
