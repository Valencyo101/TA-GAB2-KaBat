<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";
class Mahasiswa extends Server {
	//buat konstruktor
	public function __construct()
	{
			parent::__construct();
			// panggil model Mmobil, parameter kedua sebagai alias bersifat opsional
			$this->load->model("Mmobil","model",TRUE);
	}

	// buat function get, untuk mengambil data
	function service_get(){

		$token = $this->get("nama");

		// panggil model Mmobil, parameter kedua sebagai alias bersifat opsional
		$this->load->model("Mmobil","model",TRUE);

		// panggil function get_data yang ada pada model yang sudah diinstance dengan perintah diatas
		$hasil = $this->model->get_data((base64_encode($token)));

		// memanggil function response ketika data berhasil diambil
		$this->response(array("mahasiswa" => $hasil),200);
	}

	// buat function put, untuk mengupdate data
	function service_put(){
		//panggil model "Mmobil"
		$this->load->model("Mmobil", "model", TRUE);
		//ambil parameter data yang akan diisi
		$data = array(
			"nama" => $this->put("nama_mobil"),
			"merk" => $this->put("merk_mobil"),
			"desk" => $this->put("desk_mobil"),
			"tahun" => $this->put("tahun_mobil"),
            "kapasitas" => $this->put("kapasitas_mobil"),
            "harga" => $this->put("harga_mobil"),
            "warna" => $this->put("warna_mobil"),
            "bensin" => $this->put("bensin_mobil"),
            "plat" => $this->put("plat_no_mobil"),
            "statusSw" => $this->put("status_sewa"),
            "statusMb" => $this->put("status_mobil"),
			"token" => base64_encode($this->put("token")),
		);

		//panggil method "update data"
		$hasil = $this->model->update_data(
            $data["nama"],
            $data["merk"],
            $data["desk"],
            $data["tahun"],
            $data["kapasitas"],
            $data["harga"],
            $data["warna"],
            $data["bensin"],
            $data["plat"],
            $data["statusSw"],
            $data["statusMb"],
            $data["token"]);
		
		//jika hasil = 0
		if($hasil == 0){
			$this->response(array("status"=>"Data Mobil Berhasil Diubah"),200);
		}
		//jika hasil !0
		else{
			$this->response(array("status"=>"Data Mobil Gagal Diubah!"),200);
		}
	}

	// buat function POST, untuk mengupdate data
	function service_post(){
		//panggil model "Mmobil"
		$this->load->model("Mmobil", "model", TRUE);
		//ambil parameter data yang akan diisi
		$data = array(
			"nama" => $this->put("nama_mobil"),
			"merk" => $this->put("merk_mobil"),
			"desk" => $this->put("desk_mobil"),
			"tahun" => $this->put("tahun_mobil"),
            "kapasitas" => $this->put("kapasitas_mobil"),
            "harga" => $this->put("harga_mobil"),
            "warna" => $this->put("warna_mobil"),
            "bensin" => $this->put("bensin_mobil"),
            "plat" => $this->put("plat_no_mobil"),
            "statusSw" => $this->put("status_sewa"),
            "statusMb" => $this->put("status_mobil"),
			"token" => base64_encode($this->put("nama")),
		);
		//panggil method "save data"
		$hasil = $this->model->save_data(
            $data["nama"],
            $data["merk"],
            $data["desk"],
            $data["tahun"],
            $data["kapasitas"],
            $data["harga"],
            $data["warna"],
            $data["bensin"],
            $data["plat"],
            $data["statusSw"],
            $data["statusMb"],
            $data["token"]);
		
        //jika hasil = 0
		if($hasil == 0){
			$this->response(array("status"=>"Data mobil Berhasil Disimpan"),200);
		}
		//jika hasil !0
		else{
			$this->response(array("status"=>"Data Mobil Gagal Disimpan!"),200);
		}
	}
	
	// buat function DELETE, untuk mengupdate data
	function service_delete(){

		$this->load->model("Mmobil", "model", TRUE);

		$token = $this->delete("nama");

		$hasil = $this->model->delete_data($token);

		if($hasil == 1)
		{

			$this->response(array("status"=>"Data Mobil berhasil dihapus"),200);
		}
		else
		{
			$this->response(array("status" => "Data Mobil gagal dihapus !"), 200);
		}
	}
    
}
