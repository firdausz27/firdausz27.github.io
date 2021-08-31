<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganKas
 *
 * @author asep
 */
class KeuanganKas {
    //put your code here
    private $kode;
    private $namakas;
    private $jumlah;
    private $personalId;
    private $kategori;
    function getKode() {
        return $this->kode;
    }

    function getNamakas() {
        return $this->namakas;
    }

    function getJumlah() {
        return $this->jumlah;
    }

    function getPersonalId() {
        return $this->personalId;
    }

    function getKategori() {
        return $this->kategori;
    }

    function setKode($kode) {
        $this->kode = $kode;
    }

    function setNamakas($namakas) {
        $this->namakas = $namakas;
    }

    function setJumlah($jumlah) {
        $this->jumlah = $jumlah;
    }

    function setPersonalId($personalId) {
        $this->personalId = $personalId;
    }

    function setKategori($kategori) {
        $this->kategori = $kategori;
    }


}
