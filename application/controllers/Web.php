<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web extends CI_Controller {
	function __construct(){
		parent:: __construct();
		$this->load->model(array('Web_model','crud'));
		$this->load->library(array('form_validation','session','pagination'));
		$this->load->helper(array('form', 'url','date'));
	}

	public function index(){
		$data['login']			=	$this->session->userdata('login',TRUE);
		if($data['login']==FALSE) redirect(base_url('web/login'));

			$data['title']			=	"Home Page | Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Home";
			$data['page']			=	"Home Page";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['content']		=	'home';
			$this->load->view('template',$data);
	}

	public function login(){
		$this->load->view('login');
	}

	function proses_login(){
		$nim			= trim(strip_tags($this->input->post('nim')));
		$password		= md5($this->input->post('password'));
		$hasil 			= $this->Web_model->login($nim,$password);
		if ($hasil->num_rows() == 1) {
			foreach ($hasil->result_array() as $data) {
				$session_id			=	$data['id_pengguna'];
				$session_nim		=	$data['nim'];
				$session_nama		=	$data['nama'];
			}
			$sess_user = array(
								'id_pengguna'=>$session_id,
								'nim'=>$session_nim,
								'nama'=>$session_nama,
							);
			$this->session->set_userdata($sess_user,TRUE);
			$this->session->set_userdata('login',TRUE);
			redirect(base_url('web'),'refresh');
		}
		else {
			echo "<script> alert('nim atau password yang anda masukkan salah');</script>";
			redirect(base_url('web'),'refresh');
		}
	}

	function logout(){
		$this->session->unset_userdata('login');
		redirect(base_url('web'), 'refresh');
	}

	function submit_register(){
		$data 									=		array();
		$data['nim']						= 	$this->input->post('nim');
		$data['nama']						= 	$this->input->post('name');
		$data['jenis_kelamin']	= 	$this->input->post('jenis_kelamin');
		$data['tanggal_lahir']	= 	$this->input->post('tanggal_lahir');
		$data['jabatan']				= 	$this->input->post('jabatan');
		$data['password']				=		md5($this->input->post('password'));

		$this->form_validation->set_rules('nim','nim','required');
		$this->form_validation->set_rules('name','nama','required');
		$this->form_validation->set_rules('jenis_kelamin','jenis kelamin','required');
		$this->form_validation->set_rules('tanggal_lahir','tanggal lahir','required');
		$this->form_validation->set_rules('jabatan','jabatan','required');

		if($this->form_validation->run() == FALSE){
			$this->registrasi();
		}
		else{
			$this->Web_model->input_mhs($data);
			echo "<script> alert('Data anda telah disimpan dalam sistem. Anda dapat login menggunakan nim dan password yg telah anda isi pada form Registrasi Calon PMW');</script>";
			redirect(base_url('web'), 'refresh');
		}
	}

    public function register(){
    	$data['jabatan']		=	$this->Web_model->jabatan();
		$this->load->view('register',$data);
	}

	function submit_pengguna_sistem(){
		$data 									=		array();
		$data['nim']						= 	$this->input->post('nim');
		$data['nama']						= 	$this->input->post('name');
		$data['jabatan']				= 	$this->input->post('jabatan');
		$data['password']				=		md5($this->input->post('password'));
		$data['hak_akses']			= 	$this->input->post('hak_akses');

		$this->form_validation->set_rules('nim','No Induk Pegawai','required');
		$this->form_validation->set_rules('name','Nama Pegawai','required');
		$this->form_validation->set_rules('jabatan','jabatan','required');
		$this->form_validation->set_rules('hak_akses','Hak Akses','required');
		if($this->form_validation->run() == FALSE){
			$this->pengguna_sistem();
		}
		else{
			$this->Web_model->input_pengguna_sistem($data);
			echo "<script> alert('Pengguna Sistem Telah Ditambahkan');</script>";
			redirect(base_url('web/pengguna_sistem'), 'refresh');
		}
	}

	function hapus_pengguna_sistem(){
		$kode_pengguna_sistem			= $this->uri->segment(3);
		$this->Web_model->hapus_pengguna_sistem($kode_pengguna_sistem);
		echo "<script> alert('Data Pengguna Sistem Berhasil didelete.');</script>";
		redirect(base_url('web/pengguna_sistem'), 'refresh');
	}

	public function edit_pengguna_sistem(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Kategori Usaha";
			$data['page']				=	"Edit Data Pengguna Sistem";
			$id_ps							=	$this->uri->segment(3);
			$id_pengguna				= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['edit_user']	= 	$this->Web_model->edit_pengguna_sistem($id_ps);
			$data['jabatan']		=		$this->Web_model->jabatan();
			$data['content']		= 	'edit_pengguna_sistem';
			$this->load->view('template',$data);
	}

	function update_pengguna_sistem(){
		$data 							= array();
		$id									= $this->uri->segment(3);
		$data['nim']				= 	$this->input->post('nim');
		$data['nama']				= 	$this->input->post('name');
		$data['jabatan']		= 	$this->input->post('jabatan');
		$data['password']		=		md5($this->input->post('password'));
		$data['hak_akses']	= 	$this->input->post('hak_akses');

		$this->form_validation->set_rules('nim','No Induk Pegawai','required');
		$this->form_validation->set_rules('name','Nama Pegawai','required');
		$this->form_validation->set_rules('jabatan','jabatan','required');
		$this->form_validation->set_rules('hak_akses','Hak Akses','required');
		if($this->form_validation->run() == FALSE){
			$this->edit_pengguna_sistem();
		}
		else{
			$this->Web_model->update_pengguna_sistem($data,$id);
			echo "<script> alert('Pengguna Sistem Berhasil diupdate.');</script>";
			redirect(base_url('web/pengguna_sistem'), 'refresh');
		}
    }

	function submit_kategori_usaha(){
		$data 							= array();
		$data['kode_kategori_usaha']	= $this->input->post('kode_kategori_usaha');
		$data['nama_kategori_usaha']	= $this->input->post('nama_kategori_usaha');

		$this->form_validation->set_rules('kode_kategori_usaha','Kode Kategori Usaha','required');
		$this->form_validation->set_rules('nama_kategori_usaha','Nama Kategori Usaha','required');

		if($this->form_validation->run() == FALSE){
			$this->view_kategori_usaha();
		}
		else{
			$this->Web_model->input_kategori_usaha($data);
			echo "<script> alert('Kateori Usaha Berhasil disimpan.');</script>";
			redirect(base_url('web/view_kategori_usaha'), 'refresh');
		}
    }

	public function view_kategori_usaha(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Kategori Usaha";
			$data['page']			=	"Data Kategori Usaha";
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['kategori_usaha']	=	$this->Web_model->kategori_usaha();
			$data['content']		= 	'view_kategori_usaha';
			$this->load->view('template',$data);
	}

	function hapus_kategori_usaha(){
		$kode_kategori_usaha			= $this->uri->segment(3);
		$this->Web_model->hapus_kategori_usaha($kode_kategori_usaha);
		echo "<script> alert('Data Kategori Usaha Berhasil didelete.');</script>";
		redirect(base_url('web/view_kategori_usaha'), 'refresh');
	}

	public function edit_kategori_usaha(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Kategori Usaha";
			$data['page']			=	"Edit Data Kategori Usaha";
			$id_ku					=	$this->uri->segment(3);
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['edit_ku']	 	= 	$this->Web_model->edit_kategori_usaha($id_ku);
			$data['content']		= 	'edit_kategori_usaha';
			$this->load->view('template',$data);
	}

	function update_kategori_usaha(){
		$data 							= array();
		$id								= $this->input->post('id_ku');
		$data['kode_kategori_usaha']	= $this->input->post('kode_kategori_usaha');
		$data['nama_kategori_usaha']	= $this->input->post('nama_kategori_usaha');

		$this->form_validation->set_rules('kode_kategori_usaha','Kode Mata Kuliah','required');
		$this->form_validation->set_rules('nama_kategori_usaha','Nama Mata Kuliah','required');
		if($this->form_validation->run() == FALSE){
			$this->edit_kategori_usaha();
		}
		else{
			$this->Web_model->update_kategori_usaha($data,$id);
			echo "<script> alert('Kategori Usaha Berhasil diupdate.');</script>";
			redirect(base_url('web/view_kategori_usaha'), 'refresh');
		}
    }

    function submit_jenis_usaha(){
		$data 							= array();
		$data['kode_jenis_usaha']	= $this->input->post('kode_jenis_usaha');
		$data['nama_jenis_usaha']	= $this->input->post('nama_jenis_usaha');

		$this->form_validation->set_rules('kode_jenis_usaha','Kode Jenis Usaha','required');
		$this->form_validation->set_rules('nama_jenis_usaha','Nama Jenis Usaha','required');

		if($this->form_validation->run() == FALSE){
			$this->view_jenis_usaha();
		}
		else{
			$this->Web_model->input_jenis_usaha($data);
			echo "<script> alert('Jenis Usaha Berhasil disimpan.');</script>";
			redirect(base_url('web/view_jenis_usaha'), 'refresh');
		}
    }

	public function view_jenis_usaha(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Jenis Usaha";
			$data['page']			=	"Data Jenis Usaha";
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['jenis_usaha']	=	$this->Web_model->jenis_usaha();
			$data['content']		= 	'view_jenis_usaha';
			$this->load->view('template',$data);
	}

	function hapus_jenis_usaha(){
		$id			= $this->uri->segment(3);
		$this->Web_model->hapus_jenis_usaha($id);
		echo "<script> alert('Data Jenis Usaha Berhasil didelete.');</script>";
		redirect(base_url('web/view_jenis_usaha'), 'refresh');
	}

	public function edit_jenis_usaha(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Jenis Usaha";
			$data['page']			=	"Edit Data Jenis Usaha";
			$id						=	$this->uri->segment(3);
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['edit_ju']	 	= 	$this->Web_model->edit_jenis_usaha($id);
			$data['content']		= 	'edit_jenis_usaha';
			$this->load->view('template',$data);
	}

	function update_jenis_usaha(){
		$data 						= array();
		$id							= $this->input->post('id_ju');
		$data['kode_jenis_usaha']	= $this->input->post('kode_jenis_usaha');
		$data['nama_jenis_usaha']	= $this->input->post('nama_jenis_usaha');

		$this->form_validation->set_rules('kode_jenis_usaha','Kode Jenis Usaha','required');
		$this->form_validation->set_rules('nama_jenis_usaha','Nama Jenis Usaha','required');
		if($this->form_validation->run() == FALSE){
			$this->edit_jenis_usaha();
		}
		else{
			$this->Web_model->update_jenis_usaha($data,$id);
			echo "<script> alert('Jenis Usaha Berhasil diupdate.');</script>";
			redirect(base_url('web/view_jenis_usaha'), 'refresh');
		}
    }

    function submit_jabatan(){
		$data 							= array();
		$data['kode_jabatan']	= $this->input->post('kode_jabatan');
		$data['nama_jabatan']	= $this->input->post('nama_jabatan');

		$this->form_validation->set_rules('kode_jabatan','Kode jabatan','required');
		$this->form_validation->set_rules('nama_jabatan','Nama jabatan','required');

		if($this->form_validation->run() == FALSE){
			$this->view_jabatan();
		}
		else{
			$this->Web_model->input_jabatan($data);
			echo "<script> alert('jabatan Berhasil disimpan.');</script>";
			redirect(base_url('web/view_jabatan'), 'refresh');
		}
    }

	public function view_jabatan(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"jabatan";
			$data['page']			=	"Data jabatan";
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['jabatan']		=	$this->Web_model->jabatan();
			$data['content']		= 	'view_jabatan';
			$this->load->view('template',$data);
	}

	function hapus_jabatan(){
		$id							= $this->uri->segment(3);
		$this->Web_model->hapus_jabatan($id);
		echo "<script> alert('Data jabatan Berhasil didelete.');</script>";
		redirect(base_url('web/view_jabatan'), 'refresh');
	}

	public function edit_jabatan(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"jabatan";
			$data['page']			=	"Edit Data jabatan";
			$id						=	$this->uri->segment(3);
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['edit_jab']		=	$this->Web_model->edit_jabatan($id);
			$data['content']		=	'edit_jabatan';
			$this->load->view('template',$data);
	}

	function update_jabatan(){
		$data 						=	array();
		$id							=	$this->input->post('id_jab');
		$data['kode_jabatan']		=	$this->input->post('kode_jabatan');
		$data['nama_jabatan']		=	$this->input->post('nama_jabatan');

		$this->form_validation->set_rules('kode_jabatan','Kode jabatan','required');
		$this->form_validation->set_rules('nama_jabatan','Nama jabatan','required');
		if($this->form_validation->run() == FALSE){
			$this->edit_jabatan();
		}
		else{
			$this->Web_model->update_jabatan($data,$id);
			echo "<script> alert('jabatan Berhasil diupdate.');</script>";
			redirect(base_url('web/view_jabatan'), 'refresh');
		}
    }

    public function pengguna_sistem(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Home";
			$data['page']			=	"View All Pengguna Sistem";
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['all_pengguna']	=	$this->Web_model->all_pengguna();
			$data['jabatan']		=	$this->Web_model->jabatan();
			$data['content']		= 	'pengguna_sistem';
			$this->load->view('template',$data);
	}

	public function kriteria_seleksi_pertama(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Penilaian Usaha";
			$data['page']			=	"List Usulan Usulan Usaha PMW Universitas Sriwijaya";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['kriteria_first']	=	$this->Web_model->data_kriteria_elektre();
			$data['content']		=	'kriteria_seleksi_pertama';
			$this->load->view('template',$data);
	}

	public function kriteria_seleksi_akhir(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Penilaian Usaha";
			$data['page']			=	"List Usulan Usulan Usaha PMW Universitas Sriwijaya";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['kriteria_final']	=	$this->Web_model->data_kriteria_wp();
			$data['indikator']		=	$this->Web_model->bobot_indikator_penilaian();
			$data['content']		=	'kriteria_seleksi_akhir';
			$this->load->view('template',$data);
	}

    function submit_kriteria_saw(){
		$data 						= array();
		$data['kode_kriteria_SAW']	= $this->input->post('kode_kriteria_SAW');
		$data['kriteria_SAW']		= $this->input->post('kriteria_SAW');
		$data['bobot_kriteria_SAW']	= $this->input->post('bobot_kriteria_SAW');

		$this->form_validation->set_rules('kode_kriteria_SAW','Kode kriteria_saw','required');
		$this->form_validation->set_rules('kriteria_SAW','Nama kriteria_saw','required');
		$this->form_validation->set_rules('bobot_kriteria_SAW','Bobot kriteria_saw','required');

		if($this->form_validation->run() == FALSE){
			$this->view_kriteria_saw();
		}
		else{
			$this->Web_model->input_kriteria_saw($data);
			echo "<script> alert('Kriteria SAW Berhasil disimpan.');</script>";
			redirect(base_url('web/view_kriteria_saw'), 'refresh');
		}
    }

	public function view_kriteria_saw(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"kriteria_saw";
			$data['page']			=	"Data kriteria_saw";
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['kriteria_saw']	=	$this->Web_model->kriteria_saw();
			$data['content']		= 	'view_kriteria_saw';
			$this->load->view('template',$data);
	}

	function hapus_kriteria_saw(){
		$id							= $this->uri->segment(3);
		$this->Web_model->hapus_kriteria_saw($id);
		echo "<script> alert('Data kriteria_saw Berhasil didelete.');</script>";
		redirect(base_url('web/view_kriteria_saw'), 'refresh');
	}

	public function edit_kriteria_saw(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"kriteria_saw";
			$data['page']			=	"Edit Data kriteria_saw";
			$id						=	$this->uri->segment(3);
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['edit_saw']		=	$this->Web_model->edit_kriteria_saw($id);
			$data['content']		=	'edit_kriteria_saw';
			$this->load->view('template',$data);
	}

	function update_kriteria_saw(){
		$data 						=	array();
		$id							=	$this->input->post('id_kriteria_SAW');
		$data['kode_kriteria_SAW']	= 	$this->input->post('kode_kriteria_SAW');
		$data['kriteria_SAW']		= 	$this->input->post('kriteria_SAW');
		$data['bobot_kriteria_SAW']	= 	$this->input->post('bobot_kriteria_SAW');

		$this->form_validation->set_rules('kode_kriteria_SAW','Kode kriteria_saw','required');
		$this->form_validation->set_rules('kriteria_SAW','Nama kriteria_saw','required');
		$this->form_validation->set_rules('bobot_kriteria_SAW','Bobot kriteria_saw','required');
		if($this->form_validation->run() == FALSE){
			$this->edit_kriteria_saw();
		}
		else{
			$this->Web_model->update_kriteria_saw($data,$id);
			echo "<script> alert('kriteria_saw Berhasil diupdate.');</script>";
			redirect(base_url('web/view_kriteria_saw'), 'refresh');
		}
    }
}