<?php

require_once '../Modell/Felhasznalo.php';
require_once '../Modell/FelhasznaloiAdattar.php';

class FelhasznaloController
{
    private $fAdattar;

    //Konstruktor beállítása
    public function __construct()
    {
        session_start();
        $this->fAdattar = new FelhasznaloiAdattar();
    }

    //Regisztrálás és validáció
    public function regisztralas($fNev, $email, $fJelszo)
    {
        if ($this->fAdattar->fNevKeres($fNev) || $this->fAdattar->fEmailKeres($email)) {
            $_SESSION['message'] = "A felhasználónév vagy az email cím már foglalt.";
            $_SESSION['message_type'] = "false";
            return false;
        }

        if (!Felhasznalo::JelszoValidalas($fJelszo)) {
            $_SESSION['message'] = "A jelszó túl rövid. Legalább 6 karakter hosszúnak kell lennie.";
            $_SESSION['message_type'] = "false";
            return false;
        }

        $felhasznalo = new Felhasznalo($fNev, $email, $fJelszo);
        if ($this->fAdattar->fHozzaad($felhasznalo)) {
            $_SESSION['message'] = "Sikeres regisztráció!";
            $_SESSION['message_type'] = "true";
            return true;
        } else {
            $_SESSION['message'] = "Nem sikerült a felhasználó létrehozása.";
            $_SESSION['message_type'] = "false";
            return false;
        }
    }

    //Bejelentkezes és validáció
    public function bejelentkezes($fNev, $fJelszo)
    {
        $felhasznalo = $this->fAdattar->fNevKeres($fNev);
        if ($felhasznalo === null) {
            $_SESSION['message'] = "Nem található ilyen felhasználó.";
            $_SESSION['message_type'] = "false";
            return false;
        }

        if ($fJelszo === $felhasznalo->fJelszo) {
            $_SESSION['message'] = "Sikeres bejelentkezés! Üdvözlünk, " . "<b>" . $felhasznalo->fNev . "</b>";
            $_SESSION['message_type'] = "true";

            return true;
        } else {
            $_SESSION['message'] = "Hibás jelszó.";
            $_SESSION['message_type'] = "false";
            return false;
        }
    }

    //Kijelentkezes üzenettel
    public function kijelentkezes()
    {
        $_SESSION['message'] = "Sikeresen kijelentkeztél!";
        $_SESSION['message_type'] = "true";
    }
}
