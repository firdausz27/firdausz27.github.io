<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Hari
 *
 * @author asep
 */
class Hari {
    //put your code here
    private $senin;
    private $selasa;
    private $rabu;
    private $kamis;
    private $jumat;
    private $sabtu;
    private $minggu;
    function getSenin() {
        return $this->senin;
    }

    function getSelasa() {
        return $this->selasa;
    }

    function getRabu() {
        return $this->rabu;
    }

    function getKamis() {
        return $this->kamis;
    }

    function getJumat() {
        return $this->jumat;
    }

    function getSabtu() {
        return $this->sabtu;
    }

    function getMinggu() {
        return $this->minggu;
    }

    function setSenin(Listjadual $senin) {
        $this->senin = $senin;
    }

    function setSelasa( Listjadual $selasa) {
        $this->selasa = $selasa;
    }

    function setRabu(Listjadual $rabu) {
        $this->rabu = $rabu;
    }

    function setKamis(Listjadual $kamis) {
        $this->kamis = $kamis;
    }

    function setJumat(Listjadual $jumat) {
        $this->jumat = $jumat;
    }

    function setSabtu(Listjadual $sabtu) {
        $this->sabtu = $sabtu;
    }

    function setMinggu(Listjadual $minggu) {
        $this->minggu = $minggu;
    }


}
