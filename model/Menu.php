<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author asep
 */
class Menu {
    //put your code here
    private $menuId;
    private $parent;
    private $nama;
    private $link;
    private $terget;
    private $formId;
    private $status;
    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getMenuId() {
        return $this->menuId;
    }

    function getParent() {
        return $this->parent;
    }

    function getNama() {
        return $this->nama;
    }

    function getLink() {
        return $this->link;
    }

    function getTerget() {
        return $this->terget;
    }

    function getFormId() {
        return $this->formId;
    }

    function setMenuId($menuId) {
        $this->menuId = $menuId;
    }

    function setParent($parent) {
        $this->parent = $parent;
    }

    function setNama($nama) {
        $this->nama = $nama;
    }

    function setLink($link) {
        $this->link = $link;
    }

    function setTerget($terget) {
        $this->terget = $terget;
    }

    function setFormId($formId) {
        $this->formId = $formId;
    }


}
