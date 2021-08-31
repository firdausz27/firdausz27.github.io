<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pelajaran
 *
 * @author asep
 */
class Pelajaran {
    //put your code here
    private $idPelajran;
    private $namaPelajaran;
    private $sks;
    private $kategoriPelajaran;
    public function getIdPelajran() {
        return $this->idPelajran;
    }

    public function setIdPelajran($idPelajran) {
        $this->idPelajran = $idPelajran;
    }

    public function getNamaPelajaran() {
        return $this->namaPelajaran;
    }

    public function setNamaPelajaran($namaPelajaran) {
        $this->namaPelajaran = $namaPelajaran;
    }

    public function getSks() {
        return $this->sks;
    }

    public function setSks($sks) {
        $this->sks = $sks;
    }

    public function getKategoriPelajaran() {
        return $this->kategoriPelajaran;
    }

    public function setKategoriPelajaran($kategoriPelajaran) {
        $this->kategoriPelajaran = $kategoriPelajaran;
    }


}

?>
