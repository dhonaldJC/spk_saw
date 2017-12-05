<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

class electre extends CI_Controller {
    public function  __construct() {
        parent::__construct();
        //$_idmenu = 'M0008';
        //$this->dokumen_lib->check_login();
        //$this->dokumen_lib->cek_wewenang_menu($_idmenu);
    }  
  //jumlah bobot
  //select k.id_pembeli, k.id_penjual, sum(b.bobot) as jumlah from kuesioner k join pengguna pe on pe.id_pengguna=k.id_penjual join pertanyaan p on p.id_pertanyaan=k.id_pertanyaan join bobot_penilaian b on b.id_bobot_penilaian=k.id_bobot_penilaian join kategori kk on kk.kode_kategori= p.kode_kategori group by kk.kode_kategori

  //select * from kuesioner k join pengguna pe on pe.id_pengguna=k.id_penjual join pertanyaan p on p.id_pertanyaan=k.id_pertanyaan join bobot_penilaian b on b.id_bobot_penilaian=k.id_bobot_penilaian join kategori kk on kk.kode_kategori= p.kode_kategori ORDER BY p.isi_pertanyaan DESC

  //select k.id_pembeli, k.id_penjual, kk.kode_kategori from kuesioner k join pengguna pe on pe.id_pengguna=k.id_penjual join pertanyaan p on p.id_pertanyaan=k.id_pertanyaan join bobot_penilaian b on b.id_bobot_penilaian=k.id_bobot_penilaian join kategori kk on kk.kode_kategori= p.kode_kategori ORDER BY p.isi_pertanyaan DESC

    //SELECT k.id_kuesioner, k.id_pembeli, k.id_penjual, p.isi_pertanyaan, bp.bobot FROM kuesioner k LEFT join pertanyaan p ON p.id_pertanyaan=k.id_pertanyaan JOIN bobot_penilaian bp ON bp.id_bobot_penilaian=k.id_bobot_penilaian

    //SELECT k.id_kuesioner, k.id_pembeli, k.id_penjual, p.isi_pertanyaan, bp.bobot, kk.kode_kategori FROM kuesioner k LEFT join pertanyaan p ON p.id_pertanyaan=k.id_pertanyaan JOIN bobot_penilaian bp ON bp.id_bobot_penilaian=k.id_bobot_penilaian JOIN kategori kk ON kk.kode_kategori=p.kode_kategori


  public function getkuesioner($kode,$kode2) {
  $this->db->select('sum(b.bobot) as jumlah');
  $this->db->from('kuesioner k');
  $this->db->join('pengguna pe','pe.id_pengguna=k.id_penjual');
  $this->db->join('pertanyaan p','p.id_pertanyaan=k.id_pertanyaan');
  $this->db->join('bobot_penilaian b','b.id_bobot_penilaian=k.id_bobot_penilaian');
  $this->db->join('kategori kk','kk.kode_kategori=p.kode_kategori');
  $this->db->where('k.id_pembeli',$kode);
  $this->db->where('k.id_penjual',$kode2);
  $this->db->group_by("kk.kode_kategori");
    $query = $this->db->get();
    return $query;
  }

  public function getdatakuesioner($kode,$kode2) {
  $this->db->select('*');
  $this->db->from('kuesioner k');
  $this->db->join('pengguna pe','pe.id_pengguna=k.id_penjual');
  $this->db->join('pertanyaan p','p.id_pertanyaan=k.id_pertanyaan');
  $this->db->join('bobot_penilaian b','b.id_bobot_penilaian=k.id_bobot_penilaian');
  $this->db->join('kategori kk','kk.kode_kategori=p.kode_kategori');
  $this->db->where('k.id_pembeli',$kode);
  $this->db->where('k.id_penjual',$kode2);
  $this->db->order_by("p.isi_pertanyaan","desc");
   $query = $this->db->get();
   return $query;
  }

  public function getdatakuesionerbykategori($kode,$kode2,$kode3) {
  $this->db->select('*');
  $this->db->from('kuesioner k');
  $this->db->join('pengguna pe','pe.id_pengguna=k.id_penjual');
  $this->db->join('pertanyaan p','p.id_pertanyaan=k.id_pertanyaan');
  $this->db->join('bobot_penilaian b','b.id_bobot_penilaian=k.id_bobot_penilaian');
  $this->db->join('kategori kk','kk.kode_kategori=p.kode_kategori');
  $this->db->where('k.id_pembeli',$kode);
  $this->db->where('k.id_penjual',$kode2);
  $this->db->where('kk.kode_kategori',$kode3);
  $this->db->order_by("p.isi_pertanyaan","desc");
   $query = $this->db->get();
   return $query;
  }
	
	public function hitung($kode) {
        $data['home']     = base_url().'electre';
        $data['modul'] 	  = 'electre';
        $data['title'] 	  = 'SPK Electre';
        $data['subtitle'] = 'Hasil Perhitungan Electre';
        $data["menu"] 	  = $this->dokumen_lib->build_menu();
        
        //banding jumlah pengguna yang bandingkan
        $pengguna=$this->db
                        ->join('kuesioner k','k.id_pembeli=p.id_pengguna')
                        ->where_not_in('k.id_pembeli',$kode)
                        ->where('k.id_penjual',$kode)
                        ->group_by('p.id_pengguna')
                        ->order_by('k.id_kuesioner','asc')
                        ->get('pengguna p');
        $i=0;
        $jpengguna=0;
        foreach($pengguna->result() as $row){
          $jpengguna++;
           $kue=$this->getkuesioner($row->id_pengguna,$kode);
           $i=0;
          foreach($kue->result() as $row2){
            $a[$row->id_pengguna][$i]=$row2->jumlah;
            
            $i++;
          }
          
        }
       $batas=$i;
       if($batas!=0){
            for($i=0;$i<$batas;$i++){
              $pembagi=0;
              foreach($pengguna->result() as $row){
                $pembagi=pow($a[$row->id_pengguna][$i],2)+$pembagi;
               }
                $bagi[$i]=sqrt($pembagi);  
            }

            foreach($pengguna->result() as $row){
               for($i=0;$i<$batas;$i++){
               $b[$row->id_pengguna][$i]=$a[$row->id_pengguna][$i]/$bagi[$i];
               
               }
               
            }
            
           
            foreach($pengguna->result() as $row){
              for($i=0;$i<$batas;$i++){
              $c[$row->id_pengguna][$i]=$b[$row->id_pengguna][$i]*$bobot[$i];
              
               }
               
            }
            $ss=1;
            foreach($pengguna->result() as $row){
              foreach($pengguna->result() as $row2){
                $sumc=0;
                if($row->id_pengguna!=$row2->id_pengguna){
                  for($i=0;$i<$batas;$i++){
                 // echo $c[$row->id_pengguna][$i]." X ".$c[$row2->id_pengguna][$i]."<br/>";
                    if($c[$row->id_pengguna][$i]>=$c[$row2->id_pengguna][$i]){
                      $sumc=$bobot[$i]+$sumc;
                      
                    }
                  }
                  
                  $concordance[$row->id_pengguna][$row2->id_pengguna]=$sumc;
                }else{
                  $concordance[$row->id_pengguna][$row2->id_pengguna]=0;
                }
              }
              
            }
            $sumcon=0;
            foreach($pengguna->result() as $row){
              foreach($pengguna->result() as $row2){
                $sumcon=$concordance[$row->id_pengguna][$row2->id_pengguna]+$sumcon;
              }
            }

            foreach($pengguna->result() as $row){
              foreach($pengguna->result() as $row2){
                    if($row->id_pengguna!=$row2->id_pengguna){
                      $sor=0;$dor=0;
                    for($k=0;$k<$batas;$k++){
                      if($c[$row->id_pengguna][$k]<$c[$row2->id_pengguna][$k]){
                        $iso[$sor]=abs($c[$row->id_pengguna][$k]-$c[$row2->id_pengguna][$k]);
                          $sor++;
                      }else{
                        $iso[$sor]=0;
                        $sor++;
                      }
                      $oso[$dor]=abs($c[$row->id_pengguna][$k]-$c[$row2->id_pengguna][$k]);
                          $dor++;
                    }
                  if(max($oso)==0){

                    $dis[$row->id_pengguna][$row2->id_pengguna]=0;
                    
                  }else{
                    $dis[$row->id_pengguna][$row2->id_pengguna]=max($iso)/max($oso);
                  }
                  
                  
                  }else{
                    $dis[$row->id_pengguna][$row2->id_pengguna]=0;
                  }
                  
                }
                
            }
            $sumdis=0;
            foreach($pengguna->result() as $row){
              foreach($pengguna->result() as $row2){
                $sumdis=$dis[$row->id_pengguna][$row2->id_pengguna]+$sumdis;
              }
            }
            $bagi=count($pengguna->result())*(count($pengguna->result())-1);
            $thresholdc=$sumcon/$bagi;
            $thresholdd=$sumdis/$bagi;
            

            foreach($pengguna->result() as $row){
              foreach($pengguna->result() as $row2){
                if($concordance[$row->id_pengguna][$row2->id_pengguna]>=$thresholdc){
                  $f[$row->id_pengguna][$row2->id_pengguna]=1;
                }else{
                  $f[$row->id_pengguna][$row2->id_pengguna]=0;
                }
                if($dis[$row->id_pengguna][$row2->id_pengguna]>=$thresholdd){
                  $g[$row->id_pengguna][$row2->id_pengguna]=1;
                }else{
                  $g[$row->id_pengguna][$row2->id_pengguna]=0;
                }
              }
            }

            foreach($pengguna->result() as $row){
              foreach($pengguna->result() as $row2){
                $f[$row->id_pengguna][$row2->id_pengguna];
              }
            }

            foreach($pengguna->result() as $row){
              foreach($pengguna->result() as $row2){
                $g[$row->id_pengguna][$row2->id_pengguna];
                              
                }
            }


            foreach($pengguna->result() as $row){
              foreach($pengguna->result() as $row2){
                $e[$row->id_pengguna][$row2->id_pengguna]=$f[$row->id_pengguna][$row2->id_pengguna]*$g[$row->id_pengguna][$row2->id_pengguna];
              }
            }

           

            foreach($pengguna->result() as $row){
              $totelectre[$row->id_pengguna]=0;
              foreach($pengguna->result() as $row2){
               $totelectre[$row->id_pengguna]=$e[$row->id_pengguna][$row2->id_pengguna]+$totelectre[$row->id_pengguna];  
              }
            }

            foreach($pengguna->result() as $row){
              if(max($totelectre)==$totelectre[$row->id_pengguna]){
                $elec=$row->id_pengguna;
              }
            }

            $gb = $this->db->get("kategori");
            $j  = 0;
            foreach($gb->result() as $row){
                    $bobot[$j]=$row->bobot_kategori;
                $j++;
            }
            
            foreach($gb->result() as $rgb){
             $getrata=$this->getdatakuesionerbykategori($elec,$kode,$rgb->kode_kategori);
             $i=1;
             $nilai=0;
              foreach($getrata->result() as $gr){
                $nilai=$gr->bobot+$nilai;
                $i++;
              }
              $electre['data'][] = array(
                          "nama_kategori" =>$rgb->nama_kategori,
                          "nilai"  => ($nilai/($i*5))*100
                  );
            }
            $electre['pengguna']=$jpengguna;
            $electre['status']="success";

            echo json_encode($electre);

          }else{
            $electre['status']="fail";
            echo json_encode($electre);
          }
    }

 


}

  	
?>
