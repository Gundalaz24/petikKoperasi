<?php
class Input_tran_model extends CI_Model {


        function data_anggota()
        {
                $query = $this->db->get('anggota');
                return $query->result();
                
        }
        function data_barang()
        {
                $query = $this->db->get('barang');
                return $query->result();
                
        }
        public function cari_data(){
                $keyword = $this->input->post('keyword', true);
                $this->db->like('nama_anggota', $keyword);
                $this->db->or_like('nama_barang', $keyword);
                $this->db->or_like('harga_satuan', $keyword);
                $this->db->select('*');
                $this->db->from('daftar_kebutuhan');
                $this->db->join('anggota','daftar_kebutuhan.anggota_id = anggota.id_anggota');
                $this->db->join('barang','daftar_kebutuhan.barang_id = barang.id_barang');
                $query = $this->db->get();
                return $query->result();
        }
        public function get_by_id($id)
	{
		return $this->db->get_where('daftar_kebutuhan', ['id_daftar_kebutuhan' => $id])->row_array();
	}
        public function get_anggota_by_id($data)
	{
		$sql = "select * from anggota where nama_anggota = ? ";
		return $this->db->query($sql, $data)->row();
	}
        public function get_data_by_id($data)
	{
		$sql = "select * from barang where nama_barang = ? ";
		return $this->db->query($sql, $data)->row();
	}
        public function join_data()
        {
                $this->db->select('*');
                $this->db->from('daftar_kebutuhan');
                $this->db->join('anggota','daftar_kebutuhan.anggota_id = anggota.id_anggota');
                $this->db->join('barang','daftar_kebutuhan.barang_id = barang.id_barang');
                $query = $this->db->get();
                return $query->result();
        }

        public function tambahData($data){
                $this->db->insert('daftar_kebutuhan', $data);
        }

        public function hapus_data($id)
        {
                $this->db->delete('daftar_kebutuhan', array('id_daftar_kebutuhan' => $id)); 
        }
        public function ubah_data($data)
        {
                $this->db->where('id_daftar_kebutuhan', $this->input->post('id_daftar_kebutuhan'));
                $hasil = $this->db->update('daftar_kebutuhan',$data);
                return $hasil;  
        }
}
?>