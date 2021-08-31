<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pendidikan
 *
 * @author asep
 */
class Pendidikan {
    //put your code  ;
    private $educationId;
    private $levelPendidikan;
    private $tahunMulai;
    private $tahunSelesai;
    private $institusi;
    private $nilaiRata;
    private $noIjazah;
    private $negara;
    private $propinsi;
    private $kota;
    private $tglIjazah;
    private $personalId;
    public function getEducationId() {
        return $this->educationId;
    }

    public function setEducationId($educationId) {
        $this->educationId = $educationId;
    }

    public function getLevelPendidikan() {
        return $this->levelPendidikan;
    }

    public function setLevelPendidikan($levelPendidikan) {
        $this->levelPendidikan = $levelPendidikan;
    }

    public function getTahunMulai() {
        return $this->tahunMulai;
    }

    public function setTahunMulai($tahunMulai) {
        $this->tahunMulai = $tahunMulai;
    }

    public function getTahunSelesai() {
        return $this->tahunSelesai;
    }

    public function setTahunSelesai($tahunSelesai) {
        $this->tahunSelesai = $tahunSelesai;
    }

    public function getInstitusi() {
        return $this->institusi;
    }

    public function setInstitusi($institusi) {
        $this->institusi = $institusi;
    }

    public function getNilaiRata() {
        return $this->nilaiRata;
    }

    public function setNilaiRata($nilaiRata) {
        $this->nilaiRata = $nilaiRata;
    }

    public function getNoIjazah() {
        return $this->noIjazah;
    }

    public function setNoIjazah($noIjazah) {
        $this->noIjazah = $noIjazah;
    }

    public function getNegara() {
        return $this->negara;
    }

    public function setNegara($negara) {
        $this->negara = $negara;
    }

    public function getPropinsi() {
        return $this->propinsi;
    }

    public function setPropinsi($propinsi) {
        $this->propinsi = $propinsi;
    }

    public function getKota() {
        return $this->kota;
    }

    public function setKota($kota) {
        $this->kota = $kota;
    }

    public function getTglIjazah() {
        return $this->tglIjazah;
    }

    public function setTglIjazah($tglIjazah) {
        $this->tglIjazah = $tglIjazah;
    }

    public function getPersonalId() {
        return $this->personalId;
    }

    public function setPersonalId($personalId) {
        $this->personalId = $personalId;
    }


}

?>
