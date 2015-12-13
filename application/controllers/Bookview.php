<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/My_projekti.php");

class Bookview extends My_projekti
{
	public function show_product($productid = NULL)
	{
		$data['productid'] = $productid;
		$this->view_comment('bookview', $data, "product");
	}
}
