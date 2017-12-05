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
			$data['edit_fak']		=	$this->Web_model->edit_jabatan($id);
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

	public function timeline_usaha(){
		$data['login']			=	$this->session->userdata('login',TRUE);
		if($data['login']==FALSE) redirect(base_url('web/login'));

			$data['title']			=	"Home Page | Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Home";
			$data['page']			=	"Timeline Usulan Usaha";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['validate']		=	$this->Web_model->usulan();
			$data['tahap_1']		=	$this->Web_model->evaluation_elektre();
			$data['hasil_1']		=	$this->Web_model->usulan();
			$data['tahap_last']		=	$this->Web_model->usulan();
			$data['hasil_last']		=	$this->Web_model->usulan();
			$data['content']		=	'timeline_usulan';
			$this->load->view('template',$data);
	}

	public function validasi_usulan_usaha(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Penilaian Usaha";
			$data['page']			=	"List Usulan Usulan Usaha PMW Universitas Sriwijaya";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['adata_usulan']	=	$this->Web_model->usulan_notvalidate();
			$data['content']		=	'validasi_usulan_usaha';
			$this->load->view('template',$data);
	}

	public function doc_usulan_usaha(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Penilaian Usaha";
			$data['page']			=	"List Usulan Usulan Usaha PMW Universitas Sriwijaya";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['all_usulan']		=	$this->Web_model->all_usulan();
			$data['cashflow']		=	$this->Web_model->file_cashflow();
			$data['kpm']			=	$this->Web_model->file_kpm();
			$data['cv']				=	$this->Web_model->file_cv();
			$data['pelatihan']		=	$this->Web_model->file_pelatihan();
			$data['content']		=	'doc_usulan_usaha';
			$this->load->view('template',$data);
	}

	public function view_doc_reviewer(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Penilaian Usaha";
			$data['page']			=	"List Usulan Usulan Usaha PMW Universitas Sriwijaya";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['all_usulan']		=	$this->Web_model->all_usulan();
			$data['cashflow']		=	$this->Web_model->file_cashflow();
			$data['kpm']			=	$this->Web_model->file_kpm();
			$data['cv']				=	$this->Web_model->file_cv();
			$data['pelatihan']		=	$this->Web_model->file_pelatihan();
			$data['content']		=	'view_doc_reviewer';
			$this->load->view('template',$data);
	}

		public function view_doc_evaluator(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Penilaian Usaha";
			$data['page']			=	"List Usulan Usulan Usaha PMW Universitas Sriwijaya";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['all_usulan']		=	$this->Web_model->all_usulan();
			$data['cashflow']		=	$this->Web_model->file_cashflow();
			$data['kpm']			=	$this->Web_model->file_kpm();
			$data['cv']				=	$this->Web_model->file_cv();
			$data['pelatihan']		=	$this->Web_model->file_pelatihan();
			$data['content']		=	'view_doc_evaluator';
			$this->load->view('template',$data);
	}

	public function usulan_usaha_tervalidasi(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Penilaian Usaha";
			$data['page']			=	"List Usulan Usulan Usaha PMW Universitas Sriwijaya";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['usulan_valid']	=	$this->Web_model->usulan_validate();
			$data['content']		=	'usulan_usaha_tervalidasi';
			$this->load->view('template',$data);
	}

	function validasi_usulan(){
		$kode_usulan				= 	$this->uri->segment(3);
		$nim 						= 	$this->uri->segment(4);
		$data['validasi']			= 	"1";
		$this->Web_model->validasi_usulan($data,$kode_usulan);
		redirect(base_url('web/'), 'refresh');
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
			$data['content']		=	'kriteria_seleksi_akhir';
			$this->load->view('template',$data);
	}

	public function set_periode_input(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']					=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']					=	"Time Period";
			$data['page']						=	"Setting Time Period";
			$id_pengguna						=	$this->session->userdata('id_pengguna');
			$data['pengguna']				=	$this->Web_model->data_pengguna($id_pengguna);
			$data['kriteria_final']	=	$this->Web_model->data_kriteria_wp();
			$data['content']				=	'set_periode_input';
			$this->load->view('template',$data);
	}




























	public function form_upload_usulan(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']				=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']				=	"Form Usulan Usaha";
			$data['page']					=	"Form Usulan Usaha PMW Universitas Sriwijaya";
			$id_pengguna					=	$this->session->userdata('id_pengguna');
			$data['pengguna']			=	$this->Web_model->data_pengguna($id_pengguna);
			$data['kategori_usaha']		=	$this->Web_model->kategori_usaha();
			$data['jenis_usaha']		=	$this->Web_model->jenis_usaha();
			$data['jabatan']			=	$this->Web_model->jabatan();
			$data['usulan']				=	$this->Web_model->usulan();
			$data['ketuapmw']			=	$this->Web_model->ketuapmw();
			$data['content']			=	'form_upload_usulan';
			$this->load->view('template',$data);
	}

	public function form_usulan_usaha(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']				=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']				=	"Form Usulan Usaha";
			$data['page']				=	"Form Usulan Usaha PMW Universitas Sriwijaya";
			$id_pengguna				=	$this->session->userdata('id_pengguna');
			$data['pengguna']			=	$this->Web_model->data_pengguna($id_pengguna);
			$data['kategori_usaha']		=	$this->Web_model->kategori_usaha();
			$data['jenis_usaha']		=	$this->Web_model->jenis_usaha();
			$data['jabatan']			=	$this->Web_model->jabatan();
			$data['usulan']				=	$this->Web_model->usulan();
			$data['ketuapmw']			=	$this->Web_model->ketuapmw();
			$data['content']			=	'form_usulan_usaha';
			$this->load->view('template',$data);
	}

	function submit_usulan_usaha(){
		$config['upload_path'] 			= 	'./uploads/proposal_usulan';
		$config['allowed_types'] 		= 	'doc|docx|xls|xlsx|ppt|pptx|pdf';
		$config['max_size']				= 	'900000000000000000000000000000000000';
		$config['remove_spaces']  		= 	FALSE;
		$this->load->library('upload', $config);
		if(empty($_FILES['userfile']['name'])){
			$data 								=	array();
			$data['nama_usaha']					=	$this->input->post('nama_usaha');
			$data['kode_kategori_usaha']		=	$this->input->post('kode_kategori_usaha');
			$data['dosen_pembimbing']			=	$this->input->post('dosen_pembimbing');
			$data['tipe_mhs']					=	$this->input->post('tipe_mhs');
			$data['nim_ketua']					=	$this->input->post('nim_ketua');
			$data['nama_anggota1']				=	$this->input->post('nama_anggota1');
			$data['nim_anggota1']				=	$this->input->post('nim_anggota1');
			$data['fak_anggota1']				=	$this->input->post('fak_anggota1');
			$data['nama_anggota2']				=	$this->input->post('nama_anggota2');
			$data['nim_anggota2']				=	$this->input->post('nim_anggota2');
			$data['fak_anggota2']				=	$this->input->post('fak_anggota2');
			$data['nama_anggota3']				=	$this->input->post('nama_anggota3');
			$data['nim_anggota3']				=	$this->input->post('nim_anggota3');
			$data['fak_anggota3']				=	$this->input->post('fak_anggota3');
			$data['nama_anggota4']				=	$this->input->post('nama_anggota4');
			$data['nim_anggota4']				=	$this->input->post('nim_anggota4');
			$data['fak_anggota4']				=	$this->input->post('fak_anggota4');
			$data['email_usulan']				=	$this->input->post('email_usulan');
			$data['jenis_usaha']				=	$this->input->post('jenis_usaha');
			$data['jml_dana_diusulkan']			=	$this->input->post('jml_dana_diusulkan');

			$this->form_validation->set_rules('nama_usaha','nama usaha','required');
			$this->form_validation->set_rules('kode_kategori_usaha','kategori usaha','required');
			$this->form_validation->set_rules('dosen_pembimbing','dosen pembimbing','required');
			$this->form_validation->set_rules('tipe_mhs','Mahasiswa Pengusul','required');
			$this->form_validation->set_rules('email_usulan','Email Usulan','required');
			$this->form_validation->set_rules('jenis_usaha','Jenis Usaha','required');
			$this->form_validation->set_rules('jml_dana_diusulkan','jumlah dana usaha yang diusulkan','required');

			$all_usulanPMW						= $this->Web_model->usulan();

				foreach ($all_usulanPMW->result_array() as $key) {
					if ($key['nim_ketua'] == $data['nim_ketua']) {
						echo "<script> alert('Maaf Usulan anda tidak dapat kami proses dikarenakan NIM ketua pada usulan anda pernah mendaftarkan usulan pada sistem ini.');</script>";
						redirect(base_url('web/'), 'refresh');
					}
				}

			if($this->form_validation->run() == FALSE){
					$this->form_usulan_usaha();
				}
				else{
					$this->Web_model->input_usulan_usaha($data);
					echo "<script> alert('Data Usulan Usaha anda Berhasil disimpan dan akan kami proses.');</script>";
					redirect(base_url('web/form_upload_usulan'), 'refresh');
				}
		}
		else{
			if(!$this->upload->do_upload()){
				echo $config['upload_path'];
				echo $this->upload->display_errors();
			}
			else {
				$data 								=	array();
				$data['nama_usaha']					=	$this->input->post('nama_usaha');
				$data['kode_kategori_usaha']		=	$this->input->post('kode_kategori_usaha');
				$data['dosen_pembimbing']			=	$this->input->post('dosen_pembimbing');
				$data['tipe_mhs']					=	$this->input->post('tipe_mhs');
				$data['nim_ketua']					=	$this->input->post('nim_ketua');
				$data['nama_anggota1']				=	$this->input->post('nama_anggota1');
				$data['nim_anggota1']				=	$this->input->post('nim_anggota1');
				$data['fak_anggota1']				=	$this->input->post('fak_anggota1');
				$data['nama_anggota2']				=	$this->input->post('nama_anggota2');
				$data['nim_anggota2']				=	$this->input->post('nim_anggota2');
				$data['fak_anggota2']				=	$this->input->post('fak_anggota2');
				$data['nama_anggota3']				=	$this->input->post('nama_anggota3');
				$data['nim_anggota3']				=	$this->input->post('nim_anggota3');
				$data['fak_anggota3']				=	$this->input->post('fak_anggota3');
				$data['nama_anggota4']				=	$this->input->post('nama_anggota4');
				$data['nim_anggota4']				=	$this->input->post('nim_anggota4');
				$data['fak_anggota4']				=	$this->input->post('fak_anggota4');
				$data['email_usulan']				=	$this->input->post('email_usulan');
				$data['jenis_usaha']				=	$this->input->post('jenis_usaha');
				$data['jml_dana_diusulkan']			=	$this->input->post('jml_dana_diusulkan');
				$data['userfile']					= 	$_FILES['userfile']['name'];

				$this->form_validation->set_rules('nama_usaha','nama usaha','required');
				$this->form_validation->set_rules('kode_kategori_usaha','kategori usaha','required');
				$this->form_validation->set_rules('dosen_pembimbing','dosen pembimbing','required');
				$this->form_validation->set_rules('tipe_mhs','Mahasiswa Pengusul','required');
				$this->form_validation->set_rules('email_usulan','Email Usulan','required');
				$this->form_validation->set_rules('jenis_usaha','Jenis Usaha','required');
				$this->form_validation->set_rules('jml_dana_diusulkan','jumlah dana usaha yang diusulkan','required');


				$all_usulanPMW						= $this->Web_model->usulan();

				foreach ($all_usulanPMW->result_array() as $key) {
					if ($key['nim_ketua'] == $data['nim_ketua']) {
						echo "<script> alert('Maaf Usulan anda tidak dapat kami proses dikarenakan NIM ketua pada usulan anda pernah mendaftarkan usulan pada sistem ini.');</script>";
						redirect(base_url('web/'), 'refresh');
					}
				}

				if($this->form_validation->run() == FALSE){
					$this->form_usulan_usaha();
				}
				else{
					$this->Web_model->input_usulan_usaha($data);
					echo "<script> alert('Data Usulan Usaha anda Berhasil disimpan dan akan kami proses.');</script>";
					redirect(base_url('web/form_upload_usulan'), 'refresh');
				}
			}
		}
    }

//uploading file
	function uploading_cashflow(){
		$config['upload_path'] 			= 	'./uploads/cashflow';
		$config['allowed_types'] 		= 	'doc|docx|xls|xlsx|ppt|pptx|pdf';
		$config['max_size']				= 	'900000000000000000000000000000000000';
		$config['remove_spaces']  		= 	FALSE;
		$this->load->library('upload', $config);
		if(empty($_FILES['userfile']['name'])){
			$data 						=	array();
			$data['kode_usulan']		= 	$this->input->post('kode_usulan');

				$this->Web_model->upload_cashflow($data);
				echo "<script> alert('Upload File Cashflow Usulan Usaha anda Berhasil disimpan dan akan kami proses.');</script>";
				redirect(base_url('web/form_usulan_usaha'), 'refresh');
		}
		else{
			if(!$this->upload->do_upload()){
				echo $config['upload_path'];
				echo $this->upload->display_errors();
			}
			else {
				$data 						=	array();
				$data['kode_usulan']		= 	$this->input->post('kode_usulan');
				$data['userfile']			= 	$_FILES['userfile']['name'];
					$this->Web_model->upload_cashflow($data);
					echo "<script> alert('Upload File Cashflow  Usulan Usaha anda Berhasil disimpan dan akan kami proses.');</script>";
					redirect(base_url('web/form_usulan_usaha'), 'refresh');
			}
		}
    }

    function uploading_kpm(){
		$config['upload_path'] 			= 	'./uploads/kpm';
		$config['allowed_types'] 		= 	'doc|docx|xls|xlsx|ppt|pptx|pdf';
		$config['max_size']				= 	'900000000000000000000000000000000000';
		$config['remove_spaces']  		= 	FALSE;
		$this->load->library('upload', $config);
		if(empty($_FILES['userfile']['name'])){
			$data 						=	array();
			$data['kode_usulan']		= 	$this->input->post('kode_usulan');

				$this->Web_model->upload_kpm($data);
				echo "<script> alert('Upload KPM anggota Usulan Usaha anda Berhasil disimpan dan akan kami proses.');</script>";
				redirect(base_url('web/form_usulan_usaha'), 'refresh');
		}
		else{
			if(!$this->upload->do_upload()){
				echo $config['upload_path'];
				echo $this->upload->display_errors();
			}
			else {
				$data 						=	array();
				$data['kode_usulan']		= 	$this->input->post('kode_usulan');
				$data['userfile']			= 	$_FILES['userfile']['name'];
					$this->Web_model->upload_kpm($data);
					echo "<script> alert('Upload KPM anggota Usulan Usaha anda Berhasil disimpan dan akan kami proses.');</script>";
					redirect(base_url('web/form_usulan_usaha'), 'refresh');
			}
		}
    }

    function uploading_cv(){
		$config['upload_path'] 			= 	'./uploads/curiculum_vitae';
		$config['allowed_types'] 		= 	'doc|docx|xls|xlsx|ppt|pptx|pdf';
		$config['max_size']				= 	'900000000000000000000000000000000000';
		$config['remove_spaces']  		= 	FALSE;
		$this->load->library('upload', $config);
		if(empty($_FILES['userfile']['name'])){
			$data 						=	array();
			$data['kode_usulan']		= 	$this->input->post('kode_usulan');

				$this->Web_model->upload_cv($data);
				echo "<script> alert('Upload Data CV anggota Usulan Usaha anda Berhasil disimpan dan akan kami proses.');</script>";
				redirect(base_url('web/form_usulan_usaha'), 'refresh');
		}
		else{
			if(!$this->upload->do_upload()){
				echo $config['upload_path'];
				echo $this->upload->display_errors();
			}
			else {
				$data 						=	array();
				$data['kode_usulan']		= 	$this->input->post('kode_usulan');
				$data['userfile']			= 	$_FILES['userfile']['name'];
					$this->Web_model->upload_cv($data);
					echo "<script> alert('Upload Data CV anggota Usulan Usaha anda Berhasil disimpan dan akan kami proses.');</script>";
					redirect(base_url('web/form_usulan_usaha'), 'refresh');
			}
		}
    }

    function uploading_pernyataanpelatihan(){
		$config['upload_path'] 			= 	'./uploads/pernyataan_pelatihan';
		$config['allowed_types'] 		= 	'doc|docx|xls|xlsx|ppt|pptx|pdf';
		$config['max_size']				= 	'900000000000000000000000000000000000';
		$config['remove_spaces']  		= 	FALSE;
		$this->load->library('upload', $config);
		if(empty($_FILES['userfile']['name'])){
			$data 						=	array();
			$data['kode_usulan']		= 	$this->input->post('kode_usulan');

				$this->Web_model->upload_pernyataanpelatihan($data);
				echo "<script> alert('Upload Data Pernyataan Pelatihan Usulan Usaha anda Berhasil disimpan dan akan kami proses.');</script>";
				redirect(base_url('web/form_usulan_usaha'), 'refresh');
		}
		else{
			if(!$this->upload->do_upload()){
				echo $config['upload_path'];
				echo $this->upload->display_errors();
			}
			else {
				$data 						=	array();
				$data['kode_usulan']		= 	$this->input->post('kode_usulan');
				$data['userfile']			= 	$_FILES['userfile']['name'];
					$this->Web_model->upload_pernyataanpelatihan($data);
					echo "<script> alert('Upload Data Pernyataan Pelatihan Usulan Usaha anda Berhasil disimpan dan akan kami proses.');</script>";
					redirect(base_url('web/form_usulan_usaha'), 'refresh');
			}
		}
    }

    //Controller Reviewer (Penilai jabatan)
	public function list_usulan_usaha(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Penilaian Usaha";
			$data['page']			=	"List Usulan Usulan Usaha PMW Universitas Sriwijaya";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['adata_usulan']	=	$this->Web_model->all_data_usulan();
			$data['all_usulan']		=	$this->Web_model->all_usulan();
			$data['content']		=	'list_usulan_usaha';
			$this->load->view('template',$data);
	}

	public function form_penilaian_usaha(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Penilaian Usaha";
			$data['page']			=	"Penilaian Usulan Usaha PMW Universitas Sriwijaya";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$kode_usulan			=	$this->uri->segment(3);
			$data['na_usulan']		=	$this->Web_model->give_nilaiusulan($kode_usulan);
			$data['label']			=	$this->Web_model->criteria_elektre();
			$data['kategori']		=	$this->Web_model->getAlldatakategori_elektre();
			$data['content']		=	'form_penilaian_usaha';
			$this->load->view('template',$data);
	}

	function penilaian_elektre(){
		if(isset($_POST["submit"])){
			$data['kode_usulan']			= 	$this->input->post('kode_usulan');
			$data['kelayakan_biaya']		= 	$this->input->post('kelayakan_biaya');
			$data['kreatifitas']			= 	$this->input->post('kreatifitas');
			$data['kebutuhan_masyarakat']	= 	$this->input->post('kebutuhan_masyarakat');
			if(!empty($_POST["format"])){
                    $format     =   $_POST["format"];
                    $count      =   count($format);
                }
                if (!empty($_POST["potensi"])) {
                    $potensi    =   $_POST["potensi"];
                    $countp     =   count($potensi);
                }

					// rule pembobotan nilai kriteria format usaha
	                if (!empty($count)) {
	                  	if ($count >= "6" ) {
	                    	$n_format = 4;
	                  	}elseif ($count == "5") {
	                    	$n_format = 3;
	                  	}elseif ($count == "4") {
	                    	$n_format = 2;
	                  	}elseif ($count <= "3") {
	                    	$n_format = 1;
	                  	}
					}

	                // rule pembobotan nilai kriteria potensi usaha
	                if (!empty($countp)) {
	                  	if ($countp >= "4" ) {
	                    	$n_potensi = 4;
	                  	}elseif ($countp == "3") {
	                    	$n_potensi = 3;
	                  	}elseif ($countp == "2") {
	                    	$n_potensi = 2;
	                  	}elseif ($countp == "1") {
							$n_potensi = 1;
	                  	}
					}
			$data['format_usulan']		=	$n_format;
			$data['potensi_profit']		=	$n_potensi;
				$this->Web_model->penilaian_elektre($data);
				echo "<script> alert('Data Penilaian Berhasil');</script>";
				redirect(base_url('web/list_usulan_usaha'), 'refresh');
		}
	}

	public function getpenilaian(){
		$kode_usulan 				=	$this->input->post('kode_usulan');
		$datakategorielektre		=	$this->Web_model->getAlldatakategori_elektre();

		foreach($datakategorielektre->result() as $row){
			$kategori 				=	$this->input->post('kategori'.$row->id_kategorikrit_elektre.'');

			if(isset($kategori)){
			$this->form_validation->set_rules('kategori'.$row->id_kategorikrit_elektre.'', 'kategori elektre tidak boleh kosong ', 'trim|required');
				if($this->form_validation->run() == TRUE){
					$dataeveluation_elektre = array(
					'kode_usulan' => $kode_usulan,
					'id_kategorikrit_elektre' => $kategori
					);
					$dataeveluation_elektre = $this->crud->insert("evaluation_elektre",$dataeveluation_elektre);
				}
			}
		}
		$kategoriselect1      = $this->input->post('kelayakan_biaya');
	    $dataeveluation_elektre = array(
	      'kode_usulan' => $kode_usulan,
	      'id_kategorikrit_elektre' => $kategoriselect1
	      );
	      $dataeveluation_elektre = $this->crud->insert("evaluation_elektre",$dataeveluation_elektre);

	    $kategoriselect2      = $this->input->post('kreatifitas');
	    $dataeveluation_elektre = array(
	      'kode_usulan' => $kode_usulan,
	      'id_kategorikrit_elektre' => $kategoriselect2
	      );
	      $dataeveluation_elektre = $this->crud->insert("evaluation_elektre",$dataeveluation_elektre);

	    $kategoriselect3      = $this->input->post('kebutuhan_masyarakat');
	    $dataeveluation_elektre = array(
	      'kode_usulan' => $kode_usulan,
	      'id_kategorikrit_elektre' => $kategoriselect3
	      );
	      $dataeveluation_elektre = $this->crud->insert("evaluation_elektre",$dataeveluation_elektre);
				echo "<script> alert('Data Penilaian Berhasil');</script>";
				redirect(base_url('web/list_usulan_usaha'), 'refresh');

	}

	public function recom_electre(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']						=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']						=	"Penilaian Usaha";
			$data['page']						=	"List Usaha yang Lolos Tahap 1 (Seleksi Administrasi)";
			$id_pengguna						=	$this->session->userdata('id_pengguna');
			$data['pengguna']					=	$this->Web_model->data_pengguna($id_pengguna);
			$data['get_eval']					=	$this->Web_model->getevaluation_elektre();
			$data['getdata_eval']				=	$this->Web_model->getdataevaluation_elektre();
			$data['getdata_evalbykategori']		=	$this->Web_model->getdataevaluation_elektrebykategori();
			$data['usulan_elektre']				=	$this->Web_model->usulan_elektre();
			$data['content']					=	'recom_electre';
			$this->load->view('template',$data);
	}

	function submit_tahap_pertama(){
		$data 							= array();
		$data['kode_usulan']			= $this->input->post('kode_usulan');
		$data['nama_usaha']				= $this->input->post('nama_usaha');
		$data['kode_kategori_usaha']	= $this->input->post('kode_kategori_usaha');
		$data['nim_ketua']				= $this->input->post('nim_ketua');
		$data['dosen_pembimbing']		= $this->input->post('dosen_pembimbing');

		$tahap_electre					= $this->Web_model->seleksi_tahap_akhir();
		if ($tahap_electre->num_rows() == 0) {
			$this->Web_model->input_tahap1($data);
			echo "<script> alert('Tahap Seleksi Pertama Berhasil disimpan.');</script>";
			redirect(base_url('web/view_tahap_akhir'), 'refresh');
		} else {
			echo "<script> alert('Tahap Seleksi Pertama Telah ada didalam database.');</script>";
			redirect(base_url('web/recom_electre'), 'refresh');
		  }
    }

    public function view_tahap_akhir(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Penilaian Usaha";
			$data['page']			=	"List Usulan Usulan Usaha PMW Universitas Sriwijaya";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$data['tahap_akhir']	=	$this->Web_model->seleksi_tahap_akhir();
			$data['all_usulan']		=	$this->Web_model->all_usulan();
			$data['cashflow']		=	$this->Web_model->file_cashflow();
			$data['kpm']			=	$this->Web_model->file_kpm();
			$data['cv']				=	$this->Web_model->file_cv();
			$data['content']		=	'view_tahap_akhir';
			$this->load->view('template',$data);
	}

	public function recom_wp(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']						=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']						=	"Penilaian Usaha";
			$data['page']						=	"List Usaha yang Lolos Tahap 1 (Seleksi Administrasi)";
			$id_pengguna						=	$this->session->userdata('id_pengguna');
			$data['pengguna']					=	$this->Web_model->data_pengguna($id_pengguna);
			$data['get_eval']					=	$this->Web_model->getevaluation_wp();
			$data['usulan_wp']					=	$this->Web_model->usulan_wp();
			$data['content']					=	'recom_wp';
			$this->load->view('template',$data);
	}

	public function form_penilaian_tahapakhir(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Penilaian Usaha";
			$data['page']			=	"Penilaian Usulan Usaha PMW Universitas Sriwijaya";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);
			$kode_usulan			=	$this->uri->segment(3);
			$data['na_usulan']		=	$this->Web_model->give_nilaiusulan($kode_usulan);
			$data['label']			=	$this->Web_model->subkriteria_wp();
			$data['subkategori']	=	$this->Web_model->getAlldatasubkategori_WP();
			$data['content']		=	'form_penilaian_tahapakhir';
			$this->load->view('template',$data);
	}

	public function getpenilaian_WP(){
		$kode_usulan 				=	$this->input->post('kode_usulan');
		$datasubkategori_wp			=	$this->Web_model->getAlldatasubkategori_WP();

		foreach($datasubkategori_wp->result() as $row){
			$subkategori 				=	$this->input->post('subkategori'.$row->id_nilaibobot_WP.'');
			$kode_subkategori			=	$this->input->post('kode_sub'.$row->kode_subkriteria_WP.'');

			if(isset($subkategori)){
			$this->form_validation->set_rules('subkategori'.$row->id_nilaibobot_WP.'', 'subkategori elektre tidak boleh kosong ', 'trim|required');
				if($this->form_validation->run() == TRUE){
					$dataeveluation_wp = array(
					'kode_usulan' => $kode_usulan,
					'kode_subkriteria_WP' => $kode_subkategori,
					'id_nilaibobot_WP' => $subkategori
					);
				}
			}
		}
		if (isset($dataeveluation_wp)) {
			$dataeveluation_wp = $this->crud->insert("evaluation_wp",$dataeveluation_wp);
			echo "<script> alert('Data Penilaian Tahap Akhir Berhasil');</script>";
			redirect(base_url('web/view_tahap_akhir'), 'refresh');
		}
		else {
			echo "<script> alert('Anda Harus mengisi data penilaian usaha tahap akhir terlebih dahulu');</script>";
			redirect(base_url('web/view_tahap_akhir'), 'refresh');
		}
	}

	//Notifikasi
	public function cek_validasi_usaha(){
		$valid_usaha			= 	$this->Web_model->validasi_usaha();
		foreach($valid_usaha->result_array() as $j){
			if($j['jml']	!=	0){
				echo $tacit		= 	$j['jml'];
			}
		}
	}

	public function cek_penilaian_pertama(){
		$cek_pertama			= 	$this->Web_model->cek_tahap_pertama();
		foreach($cek_pertama->result_array() as $j){
			if($j['jml']	!=	0){
				echo $tacit		= 	$j['jml'];
			}
		}
	}

	public function cek_penilaian_akhir(){
		$cek_akhir			= 	$this->Web_model->cek_tahap_akhir();
		foreach($cek_akhir->result_array() as $j){
			if($j['jml']	!=	0){
				echo $tacit		= 	$j['jml'];
			}
		}
	}
}