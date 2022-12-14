<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";
class Mobil extends Server {
	//buat konstruktor
	public function __construct()
	{
			parent::__construct();
			// panggil model Mmobil, parameter kedua sebagai alias bersifat opsional
			$this->load->model("Mmobil","model",TRUE);
	}

	// buat function get, untuk mengambil data
	function service_get(){

		$token = $this->get("nama_mobil");

		// panggil model Mmobil, parameter kedua sebagai alias bersifat opsional
		$this->load->model("Mmobil","model",TRUE);

		// panggil function get_data yang ada pada model yang sudah diinstance dengan perintah diatas
		$hasil = $this->model->get_data((base64_encode($token)));

		// memanggil function response ketika data berhasil diambil
		$this->response(array("mobil" => $hasil),200);
	}

	// buat function put, untuk mengupdate data
	function service_put(){
		//panggil model "Mmobil"
		$this->load->model("Mmobil", "model", TRUE);
		//ambil parameter data yang akan diisi
		$data = array(
			"nama_mobil" => $this->put("nama_mbl"),
			"merk_mobil" => $this->put("merk_mbl"),
			"deskripsi_mobil" => $this->put("deskripsi_mbl"),
			"tahun_mobil" => $this->put("tahun_mbl"),
            "kapasitas_mobil" => $this->put("kapasitas_mbl"),
            "harga_mobil" => $this->put("harga_mbl"),
            "warna_mobil" => $this->put("warna_mbl"),
            "bensin_mobil" => $this->put("bensin_mbl"),
            "plat_no_mobil" => $this->put("plat_mbl"),
            "status_sewa" => $this->put("status_sw"),
            "status_mobil" => $this->put("status_mbl"),
			"token" => base64_encode($this->put("token")),
		);

		//panggil method "update data"
		$hasil = $this->model->update_data(
            $data["nama_mobil"],
            $data["merk_mobil"],
            $data["deskripsi_mobil"],
            $data["tahun_mobil"],
            $data["kapasitas_mobil"],
            $data["harga_mobil"],
            $data["warna_mobil"],
            $data["bensin_mobil"],
            $data["plat_no_mobil"],
            $data["status_sewa"],
            $data["status_mobil"],
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
			"nama_mobil" => $this->put("nama_mbl"),
			"merk_mobil" => $this->put("merk_mbl"),
			"deskripsi_mobil" => $this->put("deskripsi_mbl"),
			"tahun_mobil" => $this->put("tahun_mbl"),
            "kapasitas_mobil" => $this->put("kapasitas_mbl"),
            "harga_mobil" => $this->put("harga_mbl"),
            "warna_mobil" => $this->put("warna_mbl"),
            "bensin_mobil" => $this->put("bensin_mbl"),
            "plat_no_mobil" => $this->put("plat_mbl"),
            "status_sewa" => $this->put("status_sw"),
            "status_mobil" => $this->put("status_mbl"),
			"token" => base64_encode($this->put("nama_mobil")),
		);
		//panggil method "save data"
		$hasil = $this->model->save_data(
            $data["nama_mobil"],
            $data["merk_mobil"],
            $data["deskripsi_mobil"],
            $data["tahun_mobil"],
            $data["kapasitas_mobil"],
            $data["harga_mobil"],
            $data["warna_mobil"],
            $data["bensin_mobil"],
            $data["plat_no_mobil"],
            $data["status_sewa"],
            $data["status_mobil"],
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

		$token = $this->delete("nama_mobil");

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
