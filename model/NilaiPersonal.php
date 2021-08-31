<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NilaiPersonal
 *
 * @author asep
 */
class NilaiPersonal {
    //put your code here
    private $idSiswa;
    private $idNilai;
    private $kesopanan;
    private $kerajinan;
    private $disiplin;
    private $nilaiKajian;
    private $nilaiHuruf;
    private $keterangan;
    public function getIdSiswa() {
        return $this->idSiswa;
    }

    public function setIdSiswa($idSiswa) {
        $this->idSiswa = $idSiswa;
    }

    public function getIdNilai() {
        return $this->idNilai;
    }

    public function setIdNilai($idNilai) {
        $this->idNilai = $idNilai;
    }

    public function getKesopanan() {
        return $this->kesopanan;
    }

    public function setKesopanan($kesopanan) {
        $this->kesopanan = $kesopanan;
    }

    public function getKerajinan() {
        return $this->kerajinan;
    }

    public function setKerajinan($kerajinan) {
        $this->kerajinan = $kerajinan;
    }

    public function getDisiplin() {
        return $this->disiplin;
    }

    public function setDisiplin($disiplin) {
        $this->disiplin = $disiplin;
    }

    public function getNilaiKajian() {
        return $this->nilaiKajian;
    }

    public function setNilaiKajian($nilaiKajian) {
        $this->nilaiKajian = $nilaiKajian;
    }

    public function getNilaiHuruf() {
        return $this->nilaiHuruf;
    }

    public function setNilaiHuruf($nilaiHuruf) {
        $this->nilaiHuruf = $nilaiHuruf;
    }

    public function getKeterangan() {
        return $this->keterangan;
    }

    public function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }


}

?>
