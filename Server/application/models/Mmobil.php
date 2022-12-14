<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Mmobil extends CI_Model {

	// buat method untuk tampil data
    function get_data($token){

        $this->db->select("
        id_mobil AS id_mbl,
        nama_mobil AS nama_mbl,
        merk_mobil AS merk_mbl,
        deskripsi_mobil AS deskripsi_mbl,
        tahun_mobil AS tahun_mbl,
        kapasitas_mobil AS kapasitas_mbl,
        harga_mobil AS harga_mbl,
        warna_mobil AS warna_mbl,
        bensin_mobil AS bensin_mbl,
        plat_no_mobil AS plat_mbl,
        status_sewa AS status_sw,
        status_mobil AS status_mbl
        ");
        $this->db->from('tb_mobil');

        // jika token terisi
        if(!empty($token))
        {
            $this->db->where("TO_BASE64 (nama_mobil) = '$token'",);
        }
        // untuk melakukan pengurutan data berdasarkan npm dengan aturan ascending,parameter dua bersifat opsional
        $this->db->order_by("nama_mobil", "DESC");

        // untuk melakukan query sql untuk mengambil data dan mengembalikan hasil
        $query = $this->db->get()->result();
        // mengembalikan data
        return $query;
    }

    //buat fungsi untuk hapus data
    function delete_data($token){
        //cek apakah nama mobil ada/tidak
        $this->db->select("nama_mobil");
        $this->db->from("tb_mobil");
        $this->db->where("nama_mobil = '$token'");
        //eksekusi query
        $query = $this->db->get()->result();
        //jika nama_mobil ditemukan
        if(count($query) == 1){
            //hapus data mobil
            $this->db->where("nama_mobil = '$token'");
            $this->db->delete("tb_mobil");
            //kirim nilai hasil = 1
            $hasil = 1;
        }
        //jika npm tidak ditemukan
        else{
            //kirim nilai hasil = 0
            $hasil = 0;
        }
        //kirim variabel hasil ke "controller" Mobil
        return $hasil;
    }

    //buat fungsi utk simpan data
    function save_data($nama_mobil,$merk_mobil,$desk,$tahun_mobil,$kapasitas_mobil,$harga_mobil,$warna_mobil,$bensin_mobil,$plat_no_mobil,$status_sewa,$status_mobil,$token){
         //cek apakah npm ada/tidak
         $this->db->select("nama_mobil");
         $this->db->from("tb_mobil");
         $this->db->where("TO_BASE64(nama_mobil) = '$token'");
         //eksekusi query
         $query = $this->db->get()->result();
         //jika nama_mobil tidak ditemukan
         if(count($query) == 0){
            //isi nilai untuk masing2 field
            $data = array(
                "nama_mobil"          => $nama_mobil,
                "merk_mobil"          => $merk_mobil,
                "desk"          => $desk,
                "tahun_mobil"         => $tahun_mobil,
                "kapasitas_mobil"     => $kapasitas_mobil, 
                "harga_mobil"         => $harga_mobil,
                "warna_mobil"         => $warna_mobil,
                "bensin_mobil"        => $bensin_mobil,
                "plat_no_mobil"          => $plat_no_mobil,
                "status_sewa"      => $status_sewa,
                "status_mobil"      => $status_mobil,
            );
            //simpan data
            $this->db->insert("tb_mobil",$data);
            $hasil = 0;
         }
         //jika nama_mobil mobil ditemukan
         else{
            $hasil = 1;
         }
         return $hasil;
    }

    //fungsi untuk ubah data
    function update_data($nama_mobil,$merk_mobil,$desk,$tahun_mobil,$kapasitas_mobil,$harga_mobil,$warna_mobil,$bensin_mobil,$plat_no_mobil,$status_sewa,$status_mobil,$token){
         //cek apakah nama_mobil mobil ada/tidak
         $this->db->select("nama_mobil");
         $this->db->from("tb_mobil");
         $this->db->where("TO_BASE64(nama_mobil) != '$token' AND nama_mobil = '$nama_mobil'");
         //eksekusi query
         $query = $this->db->get()->result();
         //jika nama_mobil mobil tidak ditemukan
         if(count($query) == 0){
            //isi nilai untuk masing2 field
            $data = array(
                "nama_mobil"          => $nama_mobil,
                "merk_mobil"          => $merk_mobil,
                "desk"          => $desk,
                "tahun_mobil"         => $tahun_mobil,
                "kapasitas_mobil"     => $kapasitas_mobil, 
                "harga_mobil"         => $harga_mobil,
                "warna_mobil"         => $warna_mobil,
                "bensin_mobil"        => $bensin_mobil,
                "plat_no_mobil"          => $plat_no_mobil,
                "status_sewa"      => $status_sewa,
                "status_mobil"      => $status_mobil,
            );

            //ubah data mahasiswa
            $this->db->where("TO_BASE64(nama_mobil) != '$token'");
            $this->db->update("tb_mobil",$data);
            //kirim nilai hasil = 0
            $hasil = 0;
         }
         //jika nama_mobil mobil ditemukan
         else{
            $hasil = 1;
         }

         return $hasil;
    }
    
}
