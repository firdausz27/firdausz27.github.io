<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganPemasukan
 *
 * @author asep
 */
class KeuanganPemasukan {
    //put your code here
    private $kode;
    private $tanggal;
    private $kas;
    private $kategori;
    private $pemasukanDetail;
    
    function getKode() {
        return $this->kode;
    }

    function getTanggal() {
        return $this->tanggal;
    }

    function getKas() {
        return $this->kas;
    }

    function getKategori() {
        return $this->kategori;
    }

    function setKode($kode) {
        $this->kode = $kode;
    }

    function setTanggal($tanggal) {
        $this->tanggal = $tanggal;
    }

    function setKas($kas) {
        $this->kas = $kas;
    }

    function setKategori($kategori) {
        $this->kategori = $kategori;
    }
    function getPemasukanDetail() {
        return $this->pemasukanDetail;
    }

    function setPemasukanDetail($pemasukanDetail=array()) {
        $this->pemasukanDetail = $pemasukanDetail;
    }



}
