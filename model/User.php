<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author asep
 */
class User {
    //put your code here
    private $userId;
    private $username;
    private $password;
    private $level;
    private $pertanyaan;
    private $jawaban;
    private $personalId;
    private $personal;
    
    function getPersonal() {
        return $this->personal;
    }

    // function setPersonal(Personal $personal) {
    function setPersonal($personal) {
        $this->personal = $personal;
    }

    public function getPersonalId() {
        return $this->personalId;
    }

    public function setPersonalId($personalId) {
        $this->personalId = $personalId;
    }

        public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getLevel() {
        return $this->level;
    }

    public function setLevel($level) {
        $this->level = $level;
    }

    public function getPertanyaan() {
        return $this->pertanyaan;
    }

    public function setPertanyaan($pertanyaan) {
        $this->pertanyaan = $pertanyaan;
    }

    public function getJawaban() {
        return $this->jawaban;
    }

    public function setJawaban($jawaban) {
        $this->jawaban = $jawaban;
    }


}
