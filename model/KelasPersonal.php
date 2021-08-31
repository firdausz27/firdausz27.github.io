<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KelasPersonal
 *
 * @author asep
 */
class KelasPersonal {
    //put your code here
    private $personalid;
    private $kelasId;
    function getPersonalid() {
        return $this->personalid;
    }

    function getKelasId() {
        return $this->kelasId;
    }

    function setPersonalid($personalid) {
        $this->personalid = $personalid;
    }

    function setKelasId($kelasId) {
        $this->kelasId = $kelasId;
    }


}
