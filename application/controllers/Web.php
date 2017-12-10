<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web extends CI_Controller {
	function __construct(){
		parent:: __construct();
		$this->load->model(array('Web_model'));
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
				$session_nama		=	$data['name'];
			}
			$sess_user = array(
								'id_pengguna'=>$session_id,
								'nim'=>$session_nim,
								'name'=>$session_nama,
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

	function submit_pengguna_sistem(){
		$data 						=	array();
		$data['nim']				= 	$this->input->post('nim');
		$data['name']				= 	$this->input->post('name');
		$data['jabatan']			= 	$this->input->post('jabatan');
		$data['password']			=	md5($this->input->post('password'));
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
			$data['page']			=	"Edit Data Pengguna Sistem";
			$id_ps					=	$this->uri->segment(3);
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['edit_user']		= 	$this->Web_model->edit_pengguna_sistem($id_ps);
			$data['jabatan']		=		$this->Web_model->jabatan();
			$data['content']		= 	'edit_pengguna_sistem';
			$this->load->view('template',$data);
	}

	function update_pengguna_sistem(){
		$data 					= 	array();
		$id						= 	$this->uri->segment(3);
		$data['nim']			= 	$this->input->post('nim');
		$data['name']			= 	$this->input->post('name');
		$data['jabatan']		= 	$this->input->post('jabatan');
		$data['password']		=	md5($this->input->post('password'));
		$data['hak_akses']		= 	$this->input->post('hak_akses');

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

    function submit_jabatan(){
		$data 					= array();
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
    function submit_penilaian_karyawan(){
    	if (count($_POST)) {
	    	$nim 	= $this->input->post('nim');
	    	$nilai 	= $this->input->post('nilai');

	    	foreach ($nilai as $item => $value) {
	    		$this->Web_model->nim = $nim;
				$this->Web_model->kode_kriteria_SAW = $item;
				$this->Web_model->nilai = $value;
				if ($this->Web_model->insert_nilai()) {
					$success = true;
				}
				if ($success == true) {
					$this->session->set_flashdata('message', 'Berhasil menambah data :)');
						redirect('web/penilaian_karyawan');
					} else {
						echo 'gagal';
					}
	    	}
    	}
    }

	public function penilaian_karyawan(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Penilaian";
			$data['page']			=	"Data Penilaian Karyawan";
			$id_pengguna			= 	$this->session->userdata('id_pengguna');
			$data['pengguna']		= 	$this->Web_model->data_pengguna($id_pengguna);
			$data['kriteria_saw']	=	$this->getDataInsert();
			$data['karyawan']		=	$this->Web_model->karyawan();
			$data['content']		= 	'penilaian_karyawan';
			$this->load->view('template',$data);
	}

	private function getDataInsert()
    {
        $dataView = array();
        $kriteria = $this->Web_model->getkriteria();
        foreach ($kriteria as $item) {
            $this->Web_model->kode_kriteria_SAW = $item->kode_kriteria_SAW;
            $dataView[$item->kode_kriteria_SAW] = array(
                'nama' => $item->kriteria_SAW,
                'data' => $this->Web_model->getByIdsubkriteria()
            );
        }
        return $dataView;
    }

    public function ranking(){
		$data['login']			= $this->session->userdata('login', true);
		if($data['login']==false) redirect(base_url('web/login'));

			$data['title']			=	"Sistem Pendukung Keputusan Intensif Karyawan";
			$data['board']			=	"Ranking";
			$data['page']			=	"Calculate The Rank of Employee";
			$id_pengguna			=	$this->session->userdata('id_pengguna');
			$data['pengguna']		=	$this->Web_model->data_pengguna($id_pengguna);

			$karyawan = $this->Web_model->getAllkaryawan();

		/**
         * Menghapus table SAW jika ada
         */
        $this->Web_model->dropTableSAW();

        /**
         * $kriteria data dari table kriteria
         */
        $kriteria = $this->Web_model->getkriteria();

        /**
         * membuat table SAW berdasarkan data dari table kriteria
         * menginputkan semua data nilai
         */
        $this->Web_model->createTable($kriteria);

        /**
         * Ambil data dari table SAW untuk perhitungan awal
         */
        $table1 = $this->initialTableSAW($karyawan);
        $this->page->setData('table1', $table1);



			$data['content']		=	'ranking';
			$this->load->view('template',$data);
	}

	private function initialTableSAW($karyawan){
        $nilai = $this->Web_model->getNilaiKaryawan();

        $dataInput = array();
        $no = 0;
        foreach ($karyawan as $item => $itemKaryawan) {
            foreach ($nilai as $index => $itemNilai) {
                if ($itemKaryawan->nim == $itemNilai->nim) {
                    $dataInput[$no]['nim'] = $itemKaryawan->nim;
                    $dataInput[$no][$itemNilai->kriteria_SAW] = $itemNilai->nilai;
                }
            }
            $no++;
        }

        foreach ($dataInput as $data => $item){
            $this->Web_model->insert_saw($item);
        }
        return $this->Web_model->getAllSAW();
    }
}