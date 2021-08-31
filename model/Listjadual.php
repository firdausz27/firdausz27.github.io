<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Listjadual
 *
 * @author asep
 */
class Listjadual {
    //put your code here
    private $hari;
    private $pelajaran;
    private $jammulai;
    private $jamSelesai;
    function getJammulai() {
        return $this->jammulai;
    }

    function getJamSelesai() {
        return $this->jamSelesai;
    }

    function setJammulai($jammulai) {
        $this->jammulai = $jammulai;
    }

    function setJamSelesai($jamSelesai) {
        $this->jamSelesai = $jamSelesai;
    }

        function getHari() {
        return $this->hari;
    }

    function getPelajaran() {
        return $this->pelajaran;
    }

    function setHari($hari) {
        $this->hari = $hari;
    }

    function setPelajaran($pelajaran) {
        $this->pelajaran = $pelajaran;
    }


}
