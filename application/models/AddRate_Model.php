<?php 
class AddRate_Model extends CI_Model
{
	
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($table, $colIdName, $id, $data)
    {
        $this->db->where($colIdName, $id);
        $result = $this->db->update($table, $data);
        return $result;
    }

    public function getAddRate()
    {
        $this->db->select('adr.*,  sp.Supplement, ed.Edition,  mo.MediaOutlet');
        $this->db->from('AddRate as adr');
        $this->db->join('mediaoutlet as mo', 'adr.gidMediaOutlet = mo.gidMediaOutlet', 'left');
        $this->db->join('edition as ed', 'adr.gidEdition = ed.gidEdition', 'left');
        $this->db->join('supplements as sp', 'adr.gidSupplement = sp.gidSupplement', 'left');
        $this->db->limit(100); // Set the limit here
        $this->db->order_by('gidAddRate', 'DESC');
        return $this->db->get()->result_array();
    }
    public function getPublication($media){
        $this->db->select('*');
		$this->db->from('mediaoutlet');
		$this->db->where('gidMediaType', $media);
		return $this->db->get()->result_array();
    }
    public function getEdition($publication){
        $this->db->select('*');
		$this->db->from('edition');
		$this->db->where('MediaOutletId', $publication);
		return $this->db->get()->result_array();
    }
    public function getSupplement($edition){
        $this->db->select('*');
		$this->db->from('supplements');
		$this->db->where('gidEdition', $edition);
		return $this->db->get()->result_array();
    }
    public function getJournalist($publication){
        $this->db->select('*');
		$this->db->from('journalist');
		$this->db->where('gigMediaOutlet', $publication);
		return $this->db->get()->result_array();
    }
    public function getAddRateDataBySearch($media_type) {
        $this->db->select('adr.*, sp.Supplement, ed.Edition, mo.MediaOutlet');
        $this->db->from('AddRate as adr');
        $this->db->join('mediaoutlet as mo', 'adr.gidMediaOutlet = mo.gidMediaOutlet', 'left');
        $this->db->join('edition as ed', 'adr.gidEdition = ed.gidEdition', 'left');
        $this->db->join('supplements as sp', 'adr.gidSupplement = sp.gidSupplement', 'left');
        
        $this->db->where('adr.gidMediaType', $media_type);
        $this->db->order_by('gidAddRate', 'DESC');
        return $this->db->get()->result_array();
    }
    }
?>