<?php

require_once 'Felhasznalo.php';

class FelhasznaloiAdattar
{
    private $fajl = '../MentettAdatok/userdata.txt'; //Fájl helye és elnevezése
    private $kulcs = 'titkos_kulcs'; // Titkosítási kulcs
    private $tAlgoritmus = 'AES-128-CTR'; // Titkosítási algoritmus

    //Felhasználó keresése név alapján
    public function fNevKeres($fNev)
    {
        $felhasznalok = $this->getFelhasznalok();
        foreach ($felhasznalok as $felhasznalo) {
            if ($felhasznalo['fNev'] === $fNev) {
                return new Felhasznalo($felhasznalo['fNev'], $felhasznalo['email'], $felhasznalo['fJelszo']);
            }
        }
        return null;
    }

    //Felhasználói email keresése név alapján
    public function fEmailKeres($email)
    {
        $felhasznalok = $this->getFelhasznalok();
        foreach ($felhasznalok as $felhasznalo) {
            if ($felhasznalo['email'] === $email) {
                return new Felhasznalo($felhasznalo['fNev'], $felhasznalo['email'], $felhasznalo['fJelszo']);
            }
        }
        return null;
    }

    //Új felhasználó mentése
    public function fHozzaad(Felhasznalo $felhasznalo)
    {
        $felhasznalok = $this->getFelhasznalok();
        foreach ($felhasznalok as $letezoFelh) {
            if ($letezoFelh['fNev'] === $felhasznalo->fNev || $letezoFelh['email'] === $felhasznalo->email) {
                return false;
            }
        }

        $felhasznalok[] = ['fNev' => $felhasznalo->fNev, 'email' => $felhasznalo->email, 'fJelszo' => $felhasznalo->fJelszo];
        $this->fMentes($felhasznalok);
        return true;
    }

    //Felhasználók visszaadatása
    private function getFelhasznalok()
    {
        if (!file_exists($this->fajl)) {
            return [];
        }

        $titkositottAdat = file_get_contents($this->fajl);
        $szerializaltAdat = $this->adatDekodolas($titkositottAdat);
        return $szerializaltAdat ? unserialize($szerializaltAdat) : [];
    }

    //Felhasználók mentése fájlba titkosítva
    private function fMentes($felhasznalok)
    {
        $szerializaltAdat = serialize($felhasznalok);
        $titkositottAdat = $this->adatTitkositas($szerializaltAdat);
        file_put_contents($this->fajl, $titkositottAdat);
    }

    //Adatok titkosítása, titkosítási kulccsal és algoritmussal
    private function adatTitkositas($adat)
    {
        $ivHossz = openssl_cipher_iv_length($this->tAlgoritmus);
        $iv = openssl_random_pseudo_bytes($ivHossz);
        $titkositottAdat = openssl_encrypt($adat, $this->tAlgoritmus, $this->kulcs, 0, $iv);
        return base64_encode($iv . $titkositottAdat);
    }

    //Titkosított adatok dekódolása eredeti formátumba
    private function adatDekodolas($adat)
    {
        $adat = base64_decode($adat);
        $ivHossz = openssl_cipher_iv_length($this->tAlgoritmus);
        $iv = substr($adat, 0, $ivHossz);
        $titkositottAdat = substr($adat, $ivHossz);
        return openssl_decrypt($titkositottAdat, $this->tAlgoritmus, $this->kulcs, 0, $iv);
    }
}
