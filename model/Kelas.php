<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kelas
 *
 * @author asep
 */
class Kelas {
    //put your code here
    private $idKelas;
    private $namaKelas;
    private $keterangan;
    private $kelasPersonal;
    function getIdKelas() {
        return $this->idKelas;
    }

    function getNamaKelas() {
        return $this->namaKelas;
    }

    function getKeterangan() {
        return $this->keterangan;
    }

    function setIdKelas($idKelas) {
        $this->idKelas = $idKelas;
    }

    function setNamaKelas($namaKelas) {
        $this->namaKelas = $namaKelas;
    }

    function setKeterangan($keterangan) {
        $this->keterangan = $keterangan;
    }
    function getKelasPersonal() {
        return $this->kelasPersonal;
    }

    function setKelasPersonal($kelasPersonal = array()) {
        $this->kelasPersonal = $kelasPersonal;
    }




}
