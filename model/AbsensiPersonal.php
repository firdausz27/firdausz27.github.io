<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbsensiPersonal
 *
 * @author asep
 */
class AbsensiPersonal {
    //put your code here
    private $idAbsensi;
    private $idSiswa;
    private $status;
    private $keterangan;
    public function getIdAbsensi() {
        return $this->idAbsensi;
    }

    public function setIdAbsensi($idAbsensi) {
        $this->idAbsensi = $idAbsensi;
    }

    public function getIdSiswa() {
        return $this->idSiswa;
    }

    public function setIdSiswa($idSiswa) {
        $this->idSiswa = $idSiswa;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getKeterangan() {
        return $this->keterangan;
    }

    public function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }


}

?>
