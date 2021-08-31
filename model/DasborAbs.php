<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DasborAbs
 *
 * @author asep
 */
class DasborAbs {
    //put your code here
    private $personalId;
    private $nama;
    private $jumlah;
    
    function getPersonalId() {
        return $this->personalId;
    }

    function setPersonalId($personalId) {
        $this->personalId = $personalId;
    }

    function getNama() {
        return $this->nama;
    }

    function getJumlah() {
        return $this->jumlah;
    }

    function setNama($nama) {
        $this->nama = $nama;
    }

    function setJumlah($jumlah) {
        $this->jumlah = $jumlah;
    }


}
