<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/My_projekti.php");

class Bookview extends My_projekti
{
	public function show_product($productid = NULL)
	{
		$data['productid'] = $productid;
		$data['reviews'] = json_encode($this->r2pdb_model->get_review_infos_by_product_id_display($productid));
		$data["comment_type"] = "product";
		$this->view_review_comment('bookview', $data);
	}
}
