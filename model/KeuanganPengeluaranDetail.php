<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganPengeluaranDetail
 *
 * @author asep
 */
class KeuanganPengeluaranDetail {
    //put your code here
    private $pengeluaranId;
    private $pengeluaranDetilId;
    private $namaPengeluaran;
    private $jumlah;
    private $keterangan;
    
    function getPengeluaranId() {
        return $this->pengeluaranId;
    }

    function getPengeluaranDetilId() {
        return $this->pengeluaranDetilId;
    }

    function getNamaPengeluaran() {
        return $this->namaPengeluaran;
    }

    function getJumlah() {
        return $this->jumlah;
    }

    function getKeterangan() {
        return $this->keterangan;
    }

    function setPengeluaranId($pengeluaranId) {
        $this->pengeluaranId = $pengeluaranId;
    }

    function setPengeluaranDetilId($pengeluaranDetilId) {
        $this->pengeluaranDetilId = $pengeluaranDetilId;
    }

    function setNamaPengeluaran($namaPengeluaran) {
        $this->namaPengeluaran = $namaPengeluaran;
    }

    function setJumlah($jumlah) {
        $this->jumlah = $jumlah;
    }

    function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }


}
