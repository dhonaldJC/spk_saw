<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Web_model extends CI_Model {
	function __construct(){
        parent::__construct();
        $this->load->dbforge();
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

	function karyawan(){
		$q 	=	$this->db->query('SELECT * FROM `pengguna` WHERE hak_akses = "3"');
		return $q;
	}

	public function getkriteria(){
        $query = $this->db->get('kriteria_saw');
        if($query->num_rows() > 0){
            foreach ( $query->result() as $row) {
                $kriterias[] = $row;
            }
            return $kriterias;
        }
    }

    private function getDatasubkriteria(){
        $data = array(
            'kode_kriteria_SAW' => $this->kode_kriteria_SAW,
            'subKriteria' => $this->subKriteria,
            'value' => $this->value
        );
        return $data;
    }

    public function getByIdsubkriteria(){
        $this->db->where('kode_kriteria_SAW', $this->kode_kriteria_SAW);
        $query = $this->db->get('subkriteria');

        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $subkriteria[] = $row;
            }
            return $subkriteria;
        }
    }

    private function getDataNilai(){
        $data = array(
            'nim' => $this->nim,
            'kode_kriteria_SAW' => $this->kode_kriteria_SAW,
            'nilai' => $this->nilai
        );
        return $data;
    }

	public function insert_nilai(){
        $status = $this->db->insert('nilai', $this->getDataNilai());
        return $status;
    }

    public function getAllkaryawan(){
        $karyawan = array();
        $query = $this->db->get('pengguna');
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $karyawan[] = $row;
            }
        }
        return $karyawan;
    }

	public function getNilaiKaryawan(){
        $query = $this->db->query(
            'select u.nim, u.name, k.kode_kriteria_SAW, k.kriteria_SAW ,n.nilai from pengguna u, nilai n, kriteria_SAW k where u.nim = n.nim AND k.kode_kriteria_SAW = n.kode_kriteria_SAW'
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }
            return $nilai;
        }
    }

    public function createTable($field)
    {
        $fields = array(
            'nim VARCHAR(120) not null'
        );


        foreach ($field as $item => $value) {
            $fields[] = $value->kriteria_SAW.' DECIMAL(13,2) not null ';
        }

        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('saw');
    }

    public function deleteTable(){
        $this->dbforge->drop_table('saw');
    }

	public function insert_saw($data){
        $status = $this->db->insert('saw', $data);
        return $status;
    }

    public function getAllSAW()
    {
        $query = $this->db->get('saw');
        if($query->num_rows() > 0){
            foreach ( $query->result() as $row) {
                $saw[] = $row;
            }
            return $saw;
        }
    }

    public function dropTableSAW(){
        $this->dbforge->drop_table('saw',TRUE);
    }
}
