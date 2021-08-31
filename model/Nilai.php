<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Nilai
 *
 * @author asep
 */
class Nilai {
    //put your code here
    private $idNilai;
    private $tanggal;
    private $idJadual;
    private $idPengajar;
    private $keterangan;
    public function getIdNilai() {
        return $this->idNilai;
    }

    public function setIdNilai($idNilai) {
        $this->idNilai = $idNilai;
    }

    public function getTanggal() {
        return $this->tanggal;
    }

    public function setTanggal($tanggal) {
        $this->tanggal = $tanggal;
    }

    public function getIdJadual() {
        return $this->idJadual;
    }

    public function setIdJadual($idJadual) {
        $this->idJadual = $idJadual;
    }

    public function getIdPengajar() {
        return $this->idPengajar;
    }

    public function setIdPengajar($idPengajar) {
        $this->idPengajar = $idPengajar;
    }

    public function getKeterangan() {
        return $this->keterangan;
    }

    public function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }


}

?>
