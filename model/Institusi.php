<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Institusi
 *
 * @author asep
 */
class Institusi {
    //put your code here
    private $kode;
    private $namaInstitusi;
    private $teleon;
    private $alamat;
    private $visi;
    private $misi;
    function getAlamat() {
        return $this->alamat;
    }

    function setAlamat($alamat) {
        $this->alamat = $alamat;
    }

    function getKode() {
        return $this->kode;
    }

    function getNamaInstitusi() {
        return $this->namaInstitusi;
    }

    function getTeleon() {
        return $this->teleon;
    }

    function getVisi() {
        return $this->visi;
    }

    function getMisi() {
        return $this->misi;
    }

    function setKode($kode) {
        $this->kode = $kode;
    }

    function setNamaInstitusi($namaInstitusi) {
        $this->namaInstitusi = $namaInstitusi;
    }

    function setTeleon($teleon) {
        $this->teleon = $teleon;
    }

    function setVisi($visi) {
        $this->visi = $visi;
    }

    function setMisi($misi) {
        $this->misi = $misi;
    }


}
