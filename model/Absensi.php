<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Absensi
 *
 * @author asep
 */
class Absensi {
    //put your code here
    private $idAbsen;
    private $tanggal;
    private $jdualId;
    private $pengajarId;
    private $keterangan;
    private $AbsensiPersonal;
    public function getIdAbsen() {
        return $this->idAbsen;
    }

    public function setIdAbsen($idAbsen) {
        $this->idAbsen = $idAbsen;
    }

    public function getTanggal() {
        return $this->tanggal;
    }

    public function setTanggal($tanggal) {
        $this->tanggal = $tanggal;
    }

    public function getJdualId() {
        return $this->jdualId;
    }

    public function setJdualId($jdualId) {
        $this->jdualId = $jdualId;
    }

    public function getPengajarId() {
        return $this->pengajarId;
    }

    public function setPengajarId($pengajarId) {
        $this->pengajarId = $pengajarId;
    }

    public function getKeterangan() {
        return $this->keterangan;
    }

    public function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }

    public function getAbsensiPersonal() {
        return $this->AbsensiPersonal;
    }

    public function setAbsensiPersonal($AbsensiPersonal =  array()) {
        $this->AbsensiPersonal = $AbsensiPersonal;
    }


}

?>
