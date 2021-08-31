<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganPemasukanDetail
 *
 * @author asep
 */
class KeuanganPemasukanDetail {
    //put your code here
    private $pemasukanId;
    private $personalId;
    private $jumlah;
    private $keterangan;
    function getPemasukanId() {
        return $this->pemasukanId;
    }

    function getPersonalId() {
        return $this->personalId;
    }

    function getJumlah() {
        return $this->jumlah;
    }

    function getKeterangan() {
        return $this->keterangan;
    }

    function setPemasukanId($pemasukanId) {
        $this->pemasukanId = $pemasukanId;
    }

    function setPersonalId($personalId) {
        $this->personalId = $personalId;
    }

    function setJumlah($jumlah) {
        $this->jumlah = $jumlah;
    }

    function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }


}
