<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TutupKajian
 *
 * @author asep
 */
class TutupKajian {
    //put your code here
    private $idPenutupan;
    private $jadualId;
    private $tanggal;
    private $keterangan;
    public function getIdPenutupan() {
        return $this->idPenutupan;
    }

    public function setIdPenutupan($idPenutupan) {
        $this->idPenutupan = $idPenutupan;
    }

    public function getJadualId() {
        return $this->jadualId;
    }

    public function setJadualId($jadualId) {
        $this->jadualId = $jadualId;
    }

    public function getTanggal() {
        return $this->tanggal;
    }

    public function setTanggal($tanggal) {
        $this->tanggal = $tanggal;
    }

    public function getKeterangan() {
        return $this->keterangan;
    }

    public function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }


}

?>
