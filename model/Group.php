<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Group
 *
 * @author asep
 */
class Group {
    //put your code here
    private $kode;
    private $namaGroup;
    private $tglDibuat;
    private $dibutOleh;
    private $keterangan;
    function getKode() {
        return $this->kode;
    }

    function getNamaGroup() {
        return $this->namaGroup;
    }

    function getTglDibuat() {
        return $this->tglDibuat;
    }

    function getDibutOleh() {
        return $this->dibutOleh;
    }

    function getKeterangan() {
        return $this->keterangan;
    }

    function setKode($kode) {
        $this->kode = $kode;
    }

    function setNamaGroup($namaGroup) {
        $this->namaGroup = $namaGroup;
    }

    function setTglDibuat($tglDibuat) {
        $this->tglDibuat = $tglDibuat;
    }

    function setDibutOleh($dibutOleh) {
        $this->dibutOleh = $dibutOleh;
    }

    function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }


}
