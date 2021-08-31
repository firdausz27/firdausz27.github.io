<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Propinsi
 *
 * @author asep
 */
class Propinsi {
    //put your code here
    private $kode;
    private $nama;
    private $keterangan;
    function getKode() {
        return $this->kode;
    }

    function getNama() {
        return $this->nama;
    }

    function getKeterangan() {
        return $this->keterangan;
    }

    function setKode($kode) {
        $this->kode = $kode;
    }

    function setNama($nama) {
        $this->nama = $nama;
    }

    function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }


}
