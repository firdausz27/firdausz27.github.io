<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TampilForm
 *
 * @author asep
 */
class TampilForm {
    //put your code here
    private $kode;
    private $url;
    private $namaForm;
    private $menu;
    private $modul;
    public function getKode() {
        return $this->kode;
    }

    public function setKode($kode) {
        $this->kode = $kode;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getNamaForm() {
        return $this->namaForm;
    }

    public function setNamaForm($namaForm) {
        $this->namaForm = $namaForm;
    }

    public function getMenu() {
        return $this->menu;
    }

    public function setMenu($menu) {
        $this->menu = $menu;
    }

    public function getModul() {
        return $this->modul;
    }

    public function setModul($modul) {
        $this->modul = $modul;
    }


}

?>
