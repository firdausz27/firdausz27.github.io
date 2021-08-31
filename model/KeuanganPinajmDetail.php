<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KeuanganPinajmDetail
 *
 * @author asep
 */
class KeuanganPinajmDetail {
    //put your code here
    private $idPinjamDtl;
    private $idPinjam;
    private $totalPinajm;
    private $sisaPinjam;
    private $kreditPinjam;
    private $tglKredit;
    private $status;
    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getIdPinjamDtl() {
        return $this->idPinjamDtl;
    }

    function getIdPinjam() {
        return $this->idPinjam;
    }

    function getTotalPinajm() {
        return $this->totalPinajm;
    }

    function getSisaPinjam() {
        return $this->sisaPinjam;
    }

    function getKreditPinjam() {
        return $this->kreditPinjam;
    }

    function getTglKredit() {
        return $this->tglKredit;
    }

    function setIdPinjamDtl($idPinjamDtl) {
        $this->idPinjamDtl = $idPinjamDtl;
    }

    function setIdPinjam($idPinjam) {
        $this->idPinjam = $idPinjam;
    }

    function setTotalPinajm($totalPinajm) {
        $this->totalPinajm = $totalPinajm;
    }

    function setSisaPinjam($sisaPinjam) {
        $this->sisaPinjam = $sisaPinjam;
    }

    function setKreditPinjam($kreditPinjam) {
        $this->kreditPinjam = $kreditPinjam;
    }

    function setTglKredit($tglKredit) {
        $this->tglKredit = $tglKredit;
    }


}
