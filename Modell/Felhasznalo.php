<?php
session_start();

class Felhasznalo
{
    public $fNev;
    public $email;
    public $fJelszo;


    //Konstruktor beállítása és paraméterek megadása
    public function __construct($fNev, $email, $fJelszo)
    {
        $this->fNev = $fNev;
        $this->email = $email;
        $this->fJelszo = $fJelszo;
    }

    public static function EmailValidalas($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function JelszoValidalas($fJelszo)
    {
        return strlen($fJelszo) >= 6;
    }
}
