<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_model extends CI_Model {
	function __construct(){
        parent::__construct();
    }

	function login($nim,$password){
		$this->db->select('*');
		$this->db->from('pengguna p');
		$this->db->where('p.nim', $nim);
		$this->db->where('p.password', $password);
		$q = $this->db->get();
		return $q;
	}

	function data_pengguna($id_pengguna){
		$this->db->select('*');
		$this->db->from('pengguna p');
		$this->db->where('p.id_pengguna',$id_pengguna);
		$q	=	$this->db->get();
		return $q;
	}

	function all_pengguna(){
		$this->db->select('*');
		$this->db->from('pengguna');
		$q 	=	$this->db->get();
		return $q;
	}

	function ketuapmw(){
		$this->db->select('*');
		$this->db->from('pengguna');
		$q	=	$this->db->get();
		return $q;
	}

	function input_mhs($data){
		$q	=	$this->db->insert('pengguna',$data);
		return $q;
	}

	function input_pengguna_sistem($data){
		$q	=	$this->db->insert('pengguna',$data);
		return $q;
	}

	function edit_pengguna_sistem($id_ps){
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->where('id_pengguna', $id_ps);
		$q = $this->db->get();
		return $q;
	}

	function update_pengguna_sistem($data,$id){
		$this->db->where('id_pengguna', $id);
		$this->db->update('pengguna', $data);
	}

	function hapus_pengguna_sistem($id){
		$this->db->where('id_pengguna',$id);
		$this->db->delete('pengguna');
	}

	function kategori_usaha(){
		$this->db->select('*');
		$this->db->from('kategori_usaha');
		$q	=	$this->db->get();
		return $q;
	}

	function input_kategori_usaha($data){
		$q	=	$this->db->insert('kategori_usaha',$data);
		return $q;
	}

	function edit_kategori_usaha($id){
		$this->db->select('*');
		$this->db->from('kategori_usaha');
		$this->db->where('id_ku', $id);
		$q = $this->db->get();
		return $q;
	}

	function update_kategori_usaha($data,$id){
		$this->db->where('id_ku', $id);
		$this->db->update('kategori_usaha', $data);
	}

	function hapus_kategori_usaha($id){
		$this->db->where('id_ku',$id);
		$this->db->delete('kategori_usaha');
	}

	function jenis_usaha(){
		$this->db->select('*');
		$this->db->from('jenis_usaha');
		$q	=	$this->db->get();
		return $q;
	}

	function input_jenis_usaha($data){
		$q	=	$this->db->insert('jenis_usaha',$data);
		return $q;
	}

	function edit_jenis_usaha($id){
		$this->db->select('*');
		$this->db->from('jenis_usaha');
		$this->db->where('id_ju', $id);
		$q = $this->db->get();
		return $q;
	}

	function update_jenis_usaha($data,$id){
		$this->db->where('id_ju', $id);
		$this->db->update('jenis_usaha', $data);
	}

	function hapus_jenis_usaha($id){
		$this->db->where('id_ju',$id);
		$this->db->delete('jenis_usaha');
	}

	function jabatan(){
		$this->db->select('*');
		$this->db->from('jabatan');
		$q	=	$this->db->get();
		return $q;
	}

	function input_jabatan($data){
		$q	=	$this->db->insert('jabatan',$data);
		return $q;
	}

	function edit_jabatan($id){
		$this->db->select('*');
		$this->db->from('jabatan');
		$this->db->where('id_jab', $id);
		$q = $this->db->get();
		return $q;
	}

	function update_jabatan($data,$id){
		$this->db->where('id_jab', $id);
		$this->db->update('jabatan', $data);
	}

	function hapus_jabatan($id){
		$this->db->where('id_jab',$id);
		$this->db->delete('jabatan');
	}


	function kriteria_saw(){
		$this->db->select('*');
		$this->db->from('kriteria_saw');
		$q	=	$this->db->get();
		return $q;
	}

	function input_kriteria_saw($data){
		$q	=	$this->db->insert('kriteria_saw',$data);
		return $q;
	}

	function edit_kriteria_saw($id){
		$this->db->select('*');
		$this->db->from('kriteria_saw');
		$this->db->where('id_kriteria_SAW', $id);
		$q = $this->db->get();
		return $q;
	}

	function update_kriteria_saw($data,$id){
		$this->db->where('id_kriteria_SAW', $id);
		$this->db->update('kriteria_saw', $data);
	}

	function hapus_kriteria_saw($id){
		$this->db->where('id_kriteria_SAW',$id);
		$this->db->delete('kriteria_saw');
	}


	function usulan(){
		$this->db->select('*');
		$this->db->from('usulan');
		$this->db->group_by('kode_usulan');
		$q	=	$this->db->get();
		return $q;
	}

	public function getAlldatausulan(){
		$this->db->select('*');
		$this->db->from('usulan');
		$this->db->order_by('kode_usulan', 'asc');
		$result = $this->db->get();
		return $result;
	}

	function input_usulan_usaha($data){
		$q	=	$this->db->insert('usulan',$data);
		return $q;
	}

	function edit_usulan_usaha($kode_usulan){
		$this->db->select('*');
		$this->db->from('usulan');
		$this->db->where('kode_usulan', $kode_usulan);
		$q = $this->db->get();
		return $q;
	}

	function update_usulan_usaha($data,$kode_usulan){
		$this->db->where('kode_usulan', $kode_usulan);
		$this->db->update('usulan', $data);
	}

	function hapus_usulan_usaha($kode_usulan){
		$this->db->where('kode_usulan',$kode_usulan);
		$this->db->delete('usulan');
	}

	function all_usulan(){
		$q 	=	$this->db->query('SELECT * FROM usulan u JOIN pengguna p ON p.nim=u.nim_ketua JOIN kategori_usaha ku ON ku.kode_kategori_usaha=u.kode_kategori_usaha');
		return $q;
	}

	function all_data_usulan(){
		$q 	=	$this->db->query('SELECT * FROM usulan u JOIN pengguna p ON p.nim=u.nim_ketua JOIN kategori_usaha ku ON ku.kode_kategori_usaha=u.kode_kategori_usaha WHERE (u.kode_usulan NOT IN (SELECT kode_usulan FROM tahap_pertama)) AND u.validasi = "1"');
		return $q;
	}

	function usulan_notvalidate(){
		$q 	=	$this->db->query('SELECT * FROM usulan u JOIN pengguna p ON p.nim=u.nim_ketua JOIN kategori_usaha ku ON ku.kode_kategori_usaha=u.kode_kategori_usaha where u.validasi="0"');
		return $q;
	}

	function usulan_validate(){
		$q 	=	$this->db->query('SELECT * FROM usulan u JOIN pengguna p ON p.nim=u.nim_ketua JOIN kategori_usaha ku ON ku.kode_kategori_usaha=u.kode_kategori_usaha where u.validasi="1"');
		return $q;
	}

	function validasi_usulan($data,$kode_usulan){
		$this->db->where('kode_usulan', $kode_usulan);
		$this->db->update('usulan', $data);
	}

	function give_nilaiusulan($kode_usulan){
		$this->db->select('*');
		$this->db->from('usulan');
		$this->db->where('kode_usulan',$kode_usulan);
		$q	=	$this->db->get();
		return $q;
	}

	public function criteria_elektre(){
		$this->db->select('*');
		$this->db->from('kriteria_elektre');
		$result = $this->db->get();
		return $result;
	}

	public function getAlldatakategori_elektre(){
		$this->db->select('*');
		$this->db->from('kategori_kriteria_elektre');
		$result = $this->db->get();
		return $result;
	}

	public function getAll_elektre(){
		$this->db->select('*');
		$this->db->from('nilai_bobot_elektre');
		$result = $this->db->get();
		return $result;
	}

	public function getevaluation_elektre() {
		$this->db->select('sum(ne.bobot) as jumlah');
		$this->db->from('evaluation_elektre e');
		$this->db->join('kategori_kriteria_elektre  ker','ker.id_kategorikrit_elektre = e.id_kategorikrit_elektre');
		$this->db->join('usulan u','u.kode_usulan = e.kode_usulan');
		$this->db->join('nilai_bobot_elektre ne','ne.id_nilaibobot_elektre = e.id_nilaibobot_elektre');
		$this->db->join('kriteria_elektre kre','kre.id_kriteria = ker.id_kriteria');
		$this->db->group_by("kre.id_kriteria");
		$this->db->order_by("e.kode_usulan");
		  	$query = $this->db->get();
			return $query;
	}

	public function getdataevaluation_elektre() {
		$this->db->select('*');
		$this->db->from('evaluation_elektre e');
		$this->db->join('kategori_kriteria_elektre  ker','ker.id_kategorikrit_elektre = e.id_kategorikrit_elektre');
		$this->db->join('usulan u','u.kode_usulan = e.kode_usulan');
		$this->db->join('nilai_bobot_elektre ne','ne.id_nilaibobot_elektre = e.id_nilaibobot_elektre');
		$this->db->join('kriteria_elektre kre','kre.id_kriteria = ker.id_kriteria');
		$this->db->order_by("e.kode_usulan");
		$this->db->order_by("ker.kategori","DESC");
		  	$query = $this->db->get();
			return $query;
	}

	public function getdataevaluation_elektrebykategori() {
		$this->db->select('*');
		$this->db->from('evaluation_elektre e');
		$this->db->join('kategori_kriteria_elektre  ker','ker.id_kategorikrit_elektre = e.id_kategorikrit_elektre');
		$this->db->join('usulan u','u.kode_usulan = e.kode_usulan');
		$this->db->join('nilai_bobot_elektre ne','ne.id_nilaibobot_elektre = e.id_nilaibobot_elektre');
		$this->db->join('kriteria_elektre kre','kre.id_kriteria = ker.id_kriteria');
		$this->db->order_by("ker.kategori","DESC");
		  	$query = $this->db->get();
			return $query;
	}

	function usulan_elektre(){
		$q 	=	$this->db->query('SELECT * FROM usulan u JOIN pengguna p ON p.nim=u.nim_ketua JOIN kategori_usaha ku ON ku.kode_kategori_usaha=u.kode_kategori_usaha');
		return $q;
	}

	function usulan_wp(){
		$q 	=	$this->db->query('SELECT * FROM usulan u JOIN pengguna p ON p.nim=u.nim_ketua JOIN kategori_usaha ku ON ku.kode_kategori_usaha=u.kode_kategori_usaha JOIN evaluation_wp k ON k.kode_usulan=u.kode_usulan GROUP BY u.kode_usulan');
		return $q;
	}

	function input_tahap1($data){
		$q	=	$this->db->insert('tahap_pertama',$data);
		return $q;
	}

	function seleksi_tahap_akhir(){
		$q 	=	$this->db->query('SELECT * FROM tahap_pertama tp JOIN pengguna p ON p.nim=tp.nim_ketua JOIN kategori_usaha ku on ku.kode_kategori_usaha=tp.kode_kategori_usaha');
		return $q;
	}

	public function subkriteria_wp(){
		$this->db->select('*');
		$this->db->from('subkriteria_wp');
		$result = $this->db->get();
		return $result;
	}

	public function getAlldatasubkategori_WP(){
		$this->db->select('*');
		$this->db->from('nilai_bobot_wp');
		$result = $this->db->get();
		return $result;
	}

	public function getevaluation_wp() {
		$this->db->select('sum(nwp.bobot_nilaiWP) as jumlah');
		$this->db->from('evaluation_wp ewp');
		$this->db->join('usulan u','u.kode_usulan=ewp.kode_usulan');
		$this->db->join('subkriteria_wp swp','swp.kode_subkriteria_WP=ewp.kode_subkriteria_WP');
		$this->db->join('nilai_bobot_wp nwp','nwp.id_nilaibobot_WP=ewp.id_nilaibobot_WP');
		$this->db->join('kriteria_wp kwp','kwp.kode_kriteria_WP=swp.kode_kriteria_WP');
		$this->db->group_by("kwp.kode_kriteria_WP");
		$this->db->order_by("u.kode_usulan");
		  	$query = $this->db->get();
			return $query;
	}

	public function getdataevaluation_wp() {
		$this->db->select('*');
		$this->db->from('evaluation_elektre e');
		$this->db->join('kategori_kriteria_elektre  ker','ker.id_kategorikrit_elektre = e.id_kategorikrit_elektre');
		$this->db->join('usulan u','u.kode_usulan = e.kode_usulan');
		$this->db->join('nilai_bobot_elektre ne','ne.id_nilaibobot_elektre = e.id_nilaibobot_elektre');
		$this->db->join('kriteria_elektre kre','kre.id_kriteria = ker.id_kriteria');
		$this->db->order_by("e.kode_usulan");
		$this->db->order_by("ker.kategori","DESC");
		  	$query = $this->db->get();
			return $query;
	}

	public function getdataevaluation_wpbykategori() {
		$this->db->select('*');
		$this->db->from('evaluation_elektre e');
		$this->db->join('kategori_kriteria_elektre  ker','ker.id_kategorikrit_elektre = e.id_kategorikrit_elektre');
		$this->db->join('usulan u','u.kode_usulan = e.kode_usulan');
		$this->db->join('nilai_bobot_elektre ne','ne.id_nilaibobot_elektre = e.id_nilaibobot_elektre');
		$this->db->join('kriteria_elektre kre','kre.id_kriteria = ker.id_kriteria');
		$this->db->order_by("ker.kategori","DESC");
		  	$query = $this->db->get();
			return $query;
	}

	public function getAlldatapengusul(){
		$this->db->select('*');
		$this->db->from('usulan');
		$this->db->order_by('kode_usulan', 'asc');
		$result = $this->db->get();
		return $result;
	}

	public function getAlldatabobotkriteria(){
		$this->db->select('*');
		$this->db->from('evaluation_wp');
		$result = $this->db->get();
		return $result;
	}

	public function getAlldatapertanyaan(){
		$this->db->select('*');
		$this->db->from('nilai_bobot_wp');
		$result = $this->db->get();
		return $result;
	}

	public function evaluation_elektre(){
		$this->db->select('*');
		$this->db->from('evaluation_elektre');
		$this->db->group_by('kode_usulan');
		$result = $this->db->get();
		return $result;
	}
//upload
	function upload_cashflow($data){
		$q	=	$this->db->insert('upload_cashflow',$data);
		return $q;
	}

	function upload_cv($data){
		$q	=	$this->db->insert('upload_cv',$data);
		return $q;
	}

	function upload_kpm($data){
		$q	=	$this->db->insert('upload_kpm',$data);
		return $q;
	}

	function upload_pernyataanpelatihan($data){
		$q	=	$this->db->insert('upload_pernyataanpelatihan',$data);
		return $q;
	}

	function detail_usulan(){
		$this->db->select('*');
		$this->db->from('usulan u');
		$this->db->join('explicit e','e.id_pengguna=p.id_pengguna');
		$this->db->where('e.id_explicit', $id);
		$q = $this->db->get();
		return $q;
	}

	function validasi_usaha(){
		$this->db->select('count(kode_usulan) as jml');
		$this->db->from('usulan');
		$this->db->where('validasi','0');
		$q = $this->db->get();
		return $q;
	}

	function cek_tahap_pertama(){
		$q 	=	$this->db->query('SELECT COUNT(kode_usulan) as jml FROM usulan u JOIN pengguna p ON p.nim=u.nim_ketua JOIN kategori_usaha ku ON ku.kode_kategori_usaha=u.kode_kategori_usaha WHERE (u.kode_usulan NOT IN (SELECT kode_usulan FROM tahap_pertama)) AND u.validasi = "1"');
		return $q;
	}

	function cek_tahap_akhir(){
		$this->db->select('count(id_tahappertama) as jml');
		$this->db->from('tahap_pertama');
		$q = $this->db->get();
		return $q;
	}

	function data_kriteria_elektre(){
		$q 	=	$this->db->query('SELECT * FROM `kategori_kriteria_elektre` kke JOIN kriteria_elektre ke ON ke.id_kriteria = kke.id_kriteria JOIN nilai_bobot_elektre nbe ON nbe.id_kriteria=kke.id_kriteria');
		return $q;
	}

	function data_kriteria_wp(){
		$q 	=	$this->db->query('SELECT * FROM `subkriteria_wp` sw JOIN kriteria_wp kw ON kw.kode_kriteria_WP=sw.kode_kriteria_WP JOIN nilai_bobot_wp nw ON nw.kode_subkriteria_WP=sw.kode_subkriteria_WP');
		return $q;
	}

	function file_cashflow(){
		$q = $this->db->query('SELECT uc.kode_usulan, uc.userfile AS file_cashflow FROM `upload_cashflow` uc JOIN usulan u ON u.kode_usulan=uc.kode_usulan');
		return $q;
	}

	function file_kpm(){
		$q = $this->db->query('SELECT uc.kode_usulan, uc.userfile AS file_kpm FROM `upload_kpm` uc JOIN usulan u ON u.kode_usulan=uc.kode_usulan');
		return $q;
	}

	function file_cv(){
		$q = $this->db->query('SELECT uc.kode_usulan, uc.userfile AS file_cv FROM `upload_cv` uc JOIN usulan u ON u.kode_usulan=uc.kode_usulan');
		return $q;
	}

	function file_pelatihan(){
		$q = $this->db->query('SELECT  uc.kode_usulan,uc.userfile AS file_pelatihan FROM `upload_pernyataanpelatihan` uc JOIN usulan u ON u.kode_usulan=uc.kode_usulan');
		return $q;
	}

}
