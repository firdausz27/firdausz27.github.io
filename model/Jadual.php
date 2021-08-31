<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Jadual
 *
 * @author asep
 */
class Jadual {
    //put your code here
    private $jadualId;
    private $hari;
    private $jamMulai;
    private $jamSelesai;
    private $idRuangan;
    private $idPelajaran;
    private $PengajarId;
    private $status;
    private $pelajar;
    private $keals;
    
    public function getJadualId() {
        return $this->jadualId;
    }

    public function setJadualId($jadualId) {
        $this->jadualId = $jadualId;
    }

    public function getHari() {
        return $this->hari;
    }

    public function setHari($hari) {
        $this->hari = $hari;
    }

    public function getJamMulai() {
        return $this->jamMulai;
    }

    public function setJamMulai($jamMulai) {
        $this->jamMulai = $jamMulai;
    }

    public function getJamSelesai() {
        return $this->jamSelesai;
    }

    public function setJamSelesai($jamSelesai) {
        $this->jamSelesai = $jamSelesai;
    }

    public function getIdRuangan() {
        return $this->idRuangan;
    }

    public function setIdRuangan(Ruangan $idRuangan) {
        $this->idRuangan = $idRuangan;
    }

    public function getIdPelajaran() {
        return $this->idPelajaran;
    }

    public function setIdPelajaran(Pelajaran $idPelajaran) {
        $this->idPelajaran = $idPelajaran;
    }

    public function getPengajarId() {
        return $this->PengajarId;
    }

    public function setPengajarId($PengajarId =  array()) {
        $this->PengajarId = $PengajarId;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getPelajar() {
        return $this->pelajar;
    }

    public function setPelajar($pelajar = array()) {
        $this->pelajar = $pelajar;
    }

    function getKeals() {
        return $this->keals;
    }

    function setKeals($keals) {
        $this->keals = $keals;
    }


}

?>
