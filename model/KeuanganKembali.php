<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganKembali
 *
 * @author asep
 */
class KeuanganKembali {
    //put your code here
    private $kode;
    private $tanggal;
    private $idPinjam;
    private $jumlah;
    function getKode() {
        return $this->kode;
    }

    function getTanggal() {
        return $this->tanggal;
    }

    function getIdPinjam() {
        return $this->idPinjam;
    }

    function getJumlah() {
        return $this->jumlah;
    }

    function setKode($kode) {
        $this->kode = $kode;
    }

    function setTanggal($tanggal) {
        $this->tanggal = $tanggal;
    }

    function setIdPinjam($idPinjam) {
        $this->idPinjam = $idPinjam;
    }

    function setJumlah($jumlah) {
        $this->jumlah = $jumlah;
    }


}
