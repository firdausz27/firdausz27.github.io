<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pekerjaan
 *
 * @author asep
 */
class Pekerjaan {
    //put your code here
    private $pekerjaanId;
    private $namaPekerjaan;
    private $kategoriPekerjaan;
    private $namaPerusahaan;
    private $telepon;
    private $alamat;
    private $personalId;
    private $keterangan;
    public function getPekerjaanId() {
        return $this->pekerjaanId;
    }

    public function setPekerjaanId($pekerjaanId) {
        $this->pekerjaanId = $pekerjaanId;
    }

    public function getNamaPekerjaan() {
        return $this->namaPekerjaan;
    }

    public function setNamaPekerjaan($namaPekerjaan) {
        $this->namaPekerjaan = $namaPekerjaan;
    }

    public function getKategoriPekerjaan() {
        return $this->kategoriPekerjaan;
    }

    public function setKategoriPekerjaan($kategoriPekerjaan) {
        $this->kategoriPekerjaan = $kategoriPekerjaan;
    }

    public function getNamaPerusahaan() {
        return $this->namaPerusahaan;
    }

    public function setNamaPerusahaan($namaPerusahaan) {
        $this->namaPerusahaan = $namaPerusahaan;
    }

    public function getTelepon() {
        return $this->telepon;
    }

    public function setTelepon($telepon) {
        $this->telepon = $telepon;
    }

    public function getAlamat() {
        return $this->alamat;
    }

    public function setAlamat($alamat) {
        $this->alamat = $alamat;
    }

    public function getPersonalId() {
        return $this->personalId;
    }

    public function setPersonalId($personalId) {
        $this->personalId = $personalId;
    }

    public function getKeterangan() {
        return $this->keterangan;
    }

    public function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }


}

?>
