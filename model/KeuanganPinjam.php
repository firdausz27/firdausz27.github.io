<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganPinjam
 *
 * @author asep
 */
class KeuanganPinjam {
    //put your code here
    private $kode;
    private $tglPinjam;
    private $tglKembali;
    private $kas;
    private $personal;
    private $jumlah;
    private $status;
    private $pinjamDetail;
    
    function getKode() {
        return $this->kode;
    }

    function getTglPinjam() {
        return $this->tglPinjam;
    }

    function getTglKembali() {
        return $this->tglKembali;
    }

    function getKas() {
        return $this->kas;
    }

    function getPersonal() {
        return $this->personal;
    }

    function getJumlah() {
        return $this->jumlah;
    }

    function getStatus() {
        return $this->status;
    }

    function getPinjamDetail() {
        return $this->pinjamDetail;
    }

    function setKode($kode) {
        $this->kode = $kode;
    }

    function setTglPinjam($tglPinjam) {
        $this->tglPinjam = $tglPinjam;
    }

    function setTglKembali($tglKembali) {
        $this->tglKembali = $tglKembali;
    }

    function setKas($kas) {
        $this->kas = $kas;
    }

    function setPersonal(Personal $personal) {
        $this->personal = $personal;
    }

    function setJumlah($jumlah) {
        $this->jumlah = $jumlah;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setPinjamDetail(KeuanganPinajmDetail $pinjamDetail) {
        $this->pinjamDetail = $pinjamDetail;
    }


}
