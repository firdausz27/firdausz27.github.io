<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Keluarga
 *
 * @author asep
 */
class Keluarga {
    //put your code here
    private $KeluargaId;
    private $nama;
    private $telepon;
    private $alamat;
    private $kota;
    private $propinsi;
    private $negara;
    private $hubungan;
    private $personalId;
    public function getKeluargaId() {
        return $this->KeluargaId;
    }

    public function setKeluargaId($KeluargaId) {
        $this->KeluargaId = $KeluargaId;
    }

    public function getNama() {
        return $this->nama;
    }

    public function setNama($nama) {
        $this->nama = $nama;
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

    public function getKota() {
        return $this->kota;
    }

    public function setKota($kota) {
        $this->kota = $kota;
    }

    public function getPropinsi() {
        return $this->propinsi;
    }

    public function setPropinsi(Propinsi $propinsi) {
        $this->propinsi = $propinsi;
    }

    public function getNegara() {
        return $this->negara;
    }

    public function setNegara(Negara $negara) {
        $this->negara = $negara;
    }

    public function getHubungan() {
        return $this->hubungan;
    }

    public function setHubungan($hubungan) {
        $this->hubungan = $hubungan;
    }

    public function getPersonalId() {
        return $this->personalId;
    }

    public function setPersonalId($personalId) {
        $this->personalId = $personalId;
    }


}

?>
