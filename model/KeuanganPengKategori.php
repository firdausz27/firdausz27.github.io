<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KategoriPelajaran
 *
 * @author asep
 */
class KeuanganPengKategori {
    //put your code her
    private $kode;
    private $namaKategori;
    private $keterangan;
    public function getKode() {
        return $this->kode;
    }

    public function setKode($kode) {
        $this->kode = $kode;
    }

    public function getNamaKategori() {
        return $this->namaKategori;
    }

    public function setNamaKategori($namaKategori) {
        $this->namaKategori = $namaKategori;
    }

    public function getKeterangan() {
        return $this->keterangan;
    }

    public function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }


}

?>
