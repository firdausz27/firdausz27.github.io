<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Personal
 *
 * @author asep
 */
class Personal {
    //put your code here
    private $setNISN;
    private $setNoInduk;
    private $statusAwal;
    private $jenis;
    private $kelas;
    private $jenjang;
    private $idPersonal;
    private $nis;
    private $namaAwal;
    private $namaTengah;
    private $namaAkhir;
    private $namaPanggilan;
    private $tempatLahir;
    private $tglLahir;
    private $telepon;
    private $alamat;
    private $kota;
    private $propinsi;
    private $negara;
    private $email;
    private $tglGabung;
    private $foto;
    private $kelamin;
    private $kategoriSantri;
    private $statusPerkawinan;
    private $kegiatan;
    private $listMenu;
    private $listInstitusi;
    private $user;
    private $prov;
    private $kab;
    private $kec;
    
    function getNISN()
    {
        return $this->setNISN;
    }

    function setNISN($setNISN)
    {
        $this->setNISN = $setNISN;
    }

    function getNoInduk()
    {
        return $this->setNoInduk;
    }

    function setNoInduk($setNoInduk)
    {
        $this->setNoInduk = $setNoInduk;
    }

    function getStatusAwal()
    {
        return $this->statusAwal;
    }

    function setStatusAwal($statusAwal)
    {
        $this->statusAwal = $statusAwal;
    }

    function getJenis()
    {
        return $this->jenis;
    }

    function setJenis($jenis)
    {
        $this->jenis = $jenis;
    }

    function getKelas()
    {
        return $this->kelas;
    }

    function setKelas($kelas)
    {
        $this->kelas = $kelas;
    }

    function getJenjang()
    {
        return $this->jenjang;
    }

    function setJenjang($jenjang)
    {
        $this->jenjang = $jenjang;
    }

    function getNamaPanggilan() {
        return $this->namaPanggilan;
    }

    function setNamaPanggilan($namaPanggilan) {
        $this->namaPanggilan = $namaPanggilan;
    }

    function getStatusPerkawinan() {
        return $this->statusPerkawinan;
    }

    function getKegiatan() {
        return $this->kegiatan;
    }

    function setStatusPerkawinan($statusPerkawinan) {
        $this->statusPerkawinan = $statusPerkawinan;
    }

    function setKegiatan($kegiatan) {
        $this->kegiatan = $kegiatan;
    }

    function getUser() {
        return $this->user;
    }

    function setUser(User $user) {
        $this->user = $user;
    }

    function getListInstitusi() {
        return $this->listInstitusi;
    }

    function setListInstitusi($listInstitusi = array()) {
        $this->listInstitusi = $listInstitusi;
    }
        
    function getListMenu() {
        return $this->listMenu;
    }

    function setListMenu($listMenu = array()) {
        $this->listMenu = $listMenu;
    }
    
    public function getKategoriSantri() {
        return $this->kategoriSantri;
    }

    public function setKategoriSantri($kategoriSantri) {
        $this->kategoriSantri = $kategoriSantri;
    }

    public function getKelamin() {
        return $this->kelamin;
    }

    public function setKelamin($kelamin) {
        $this->kelamin = $kelamin;
    }

        public function getIdPersonal() {
        return $this->idPersonal;
    }

    public function setIdPersonal($idPersonal) {
        $this->idPersonal = $idPersonal;
    }

    public function getNis() {
        return $this->nis;
    }

    public function setNis($nis) {
        $this->nis = $nis;
    }

    public function getNamaAwal() {
        return $this->namaAwal;
    }

    public function setNamaAwal($namaAwal) {
        $this->namaAwal = $namaAwal;
    }

    public function getNamaTengah() {
        return $this->namaTengah;
    }

    public function setNamaTengah($namaTengah) {
        $this->namaTengah = $namaTengah;
    }

    public function getNamaAkhir() {
        return $this->namaAkhir;
    }

    public function setNamaAkhir($namaAkhir) {
        $this->namaAkhir = $namaAkhir;
    }

    public function getTempatLahir() {
        return $this->tempatLahir;
    }

    public function setTempatLahir($tempatLahir) {
        $this->tempatLahir = $tempatLahir;
    }

    public function getTglLahir() {
        return $this->tglLahir;
    }

    public function setTglLahir($tglLahir) {
        $this->tglLahir = $tglLahir;
    }

    public function getTelepon() {
        return $this->telepon;
    }

    public function setTelepon($telepon) {
        $this->telepon = $telepon;
    }

    public function getAlamat() {
        return $this->alamat;
    }

    public function setAlamat($alamat) {
        $this->alamat = $alamat;
    }

    public function getKota() {
        return $this->kota;
    }

    public function setKota($kota) {
        $this->kota = $kota;
    }

    public function getPropinsi() {
        return $this->propinsi;
    }

    public function setPropinsi($propinsi) {
        $this->propinsi = $propinsi;
    }

    public function getNegara() {
        return $this->negara;
    }

    public function setNegara($negara) {
        $this->negara = $negara;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTglGabung() {
        return $this->tglGabung;
    }

    public function setTglGabung($tglGabung) {
        $this->tglGabung = $tglGabung;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    function getProv()
    {
        return $this->prov;
    }

    function setProv($prov)
    {
        $this->prov = $prov;
    }

    function getKab()
    {
        return $this->kab;
    }

    function setKab($kab)
    {
        $this->kab = $kab;
    }

    function getKec()
    {
        return $this->kec;
    }

    function setKec($kec)
    {
        $this->kec = $kec;
    }
}

?>
