<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Mmobil extends CI_Model {

	// buat method untuk tampil data
    function get_data($token){

        $this->db->select("
        id_mobil AS id_mbl,
        nama AS nama_mbl,
        merk AS merk_mbl,
        desk AS desk_mbl,
        tahun AS tahun_mbl,
        kapasitas AS kapasitas_mbl,
        harga AS harga_mbl,
        warna AS warna_mbl,
        bensin AS bensin_mbl,
        plat AS plat_mbl,
        statusSw AS statusSw_mbl,
        statusMb AS statusMb_mbl
        ");
        $this->db->from('tb_mobil');

        // jika token terisi
        if(!empty($token))
        {
            $this->db->where("TO_BASE64 (nama) = '$token'",);
        }
        // untuk melakukan pengurutan data berdasarkan npm dengan aturan ascending,parameter dua bersifat opsional
        $this->db->order_by("nama", "DESC");

        // untuk melakukan query sql untuk mengambil data dan mengembalikan hasil
        $query = $this->db->get()->result();
        // mengembalikan data
        return $query;
    }

    //buat fungsi untuk hapus data
    function delete_data($token){
        //cek apakah npm ada/tidak
        $this->db->select("nama");
        $this->db->from("tb_mobil");
        $this->db->where("nama = '$token'");
        //eksekusi query
        $query = $this->db->get()->result();
        //jika nama ditemukan
        if(count($query) == 1){
            //hapus data mobil
            $this->db->where("nama = '$token'");
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
    function save_data($nama,$merk,$desk,$tahun,$kapasitas,$harga,$warna,$bensin,$plat,$statusSW,$statusMb,$token){
         //cek apakah npm ada/tidak
         $this->db->select("nama");
         $this->db->from("tb_mobil");
         $this->db->where("TO_BASE64(nama) = '$token'");
         //eksekusi query
         $query = $this->db->get()->result();
         //jika nama tidak ditemukan
         if(count($query) == 0){
            //isi nilai untuk masing2 field
            $data = array(
                "nama"          => $nama,
                "merk"          => $merk,
                "desk"          => $desk,
                "tahun"         => $tahun,
                "kapasitas"     => $kapasitas, 
                "harga"         => $harga,
                "warna"         => $warna,
                "bensin"        => $bensin,
                "plat"          => $plat,
                "statusSw"      => $statusSW,
                "statusMb"      => $statusMb,
            );
            //simpan data
            $this->db->insert("tb_mobil",$data);
            $hasil = 0;
         }
         //jika nama mobil ditemukan
         else{
            $hasil = 1;
         }
         return $hasil;
    }

    //fungsi untuk ubah data
    function update_data($nama,$merk,$desk,$tahun,$kapasitas,$harga,$warna,$bensin,$plat,$statusSW,$statusMb,$token){
         //cek apakah nama mobil ada/tidak
         $this->db->select("nama");
         $this->db->from("tb_mobil");
         $this->db->where("TO_BASE64(nama) != '$token' AND nama = '$nama'");
         //eksekusi query
         $query = $this->db->get()->result();
         //jika nama mobil tidak ditemukan
         if(count($query) == 0){
            //isi nilai untuk masing2 field
            $data = array(
                "nama"          => $nama,
                "merk"          => $merk,
                "desk"          => $desk,
                "tahun"         => $tahun,
                "kapasitas"     => $kapasitas, 
                "harga"         => $harga,
                "warna"         => $warna,
                "bensin"        => $bensin,
                "plat"          => $plat,
                "statusSw"      => $statusSW,
                "statusMb"      => $statusMb,
            );

            //ubah data mahasiswa
            $this->db->where("TO_BASE64(nama) != '$token'");
            $this->db->update("tb_mobil",$data);
            //kirim nilai hasil = 0
            $hasil = 0;
         }
         //jika nama mobil ditemukan
         else{
            $hasil = 1;
         }

         return $hasil;
    }
    
}
