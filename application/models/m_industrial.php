<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_industrial extends CI_Model {

	
	public function tampil_jenis()
	{
		return $this->db->query("SELECT * from myhris.sys_user;");
	}
	
	public function sisa_cuti()
	{
		return $this->db->query("SELECT  paa.assignment_number NIK, pap.last_name NAMA,
											per_utility_functions.get_net_accrual
											(paa.assignment_id,
											61,
											81,
											1,
											to_char(sysdate,'dd-Mon-rrrr'),
											1061,
											NULL,
											NULL
											) SISA_CUTI
											FROM per_all_assignments_f paa, per_all_people_f pap
											WHERE paa.person_id = pap.person_id
											AND paa.assignment_number IN (SELECT assignment_number
											FROM per_all_assignments_f)
											and assignment_number not like 'C%'
											AND paa.effective_end_date = '31-dec-4712'
											AND pap.effective_end_date = '31-dec-4712'
											order by NIK asc;
											" );
	}
	 
}
