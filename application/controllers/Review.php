<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/My_projekti.php");

class Review extends My_projekti
{
	public function write_review()
	{
		$data['product_id'] = 1;
		$data['user_id'] = 1;
		
		if($this->input->post('submit'))
		{
			if ($this->r2pdb_model->is_valid_product_id($data['product_id']) === TRUE)
			{
				$this->r2pdb_model->add_review(
				(int) $this->input->post("user_id"),
				$data['product_id'],
				(int) $this->input->post("rating"),
				$this->input->post("review"),
				$this->input->post("pros"),
				$this->input->post("cons"));
				$this->view('review_posted', null);
			}
			else
			{
				$data['message'] = "Error: Invalid Book ID '" . $data['product_id'] . "'. got " . $this->r2pdb_model->is_valid_product_id($data['product_id']);
				$this->view('review_failed', $data);
			}
			
		}
		else
		{
			$this->view('review', $data);
		}
	}
}