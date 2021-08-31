<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ruangan
 *
 * @author asep
 */
class Ruangan {
    //put your code here
    private $runaganId;
    private $nama;
    private $keterangan;
    public function getRunaganId() {
        return $this->runaganId;
    }

    public function setRunaganId($runaganId) {
        $this->runaganId = $runaganId;
    }

    public function getNama() {
        return $this->nama;
    }

    public function setNama($nama) {
        $this->nama = $nama;
    }

    public function getKeterangan() {
        return $this->keterangan;
    }

    public function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }


}

?>
