<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/My_projekti.php");

class Review extends My_projekti
{
	public function write_review($productid)
	{
		if ($this->verify_min_level(1))
		{
			if ($this->r2pdb_model->is_valid_product_id($productid) === TRUE)
			{
				$data['productid'] = $productid;

				if($this->input->post('submit'))
				{
					$this->r2pdb_model->add_review(
						(int) $this->auth_user_id,
						$productid,
						(int) $this->input->post("rating"),
						$this->input->post("review"),
						$this->input->post("pros"),
						$this->input->post("cons"));
					
						$this->show_review($productid);
				}
				else
				{
					$this->view('writereview', $data);
				}
			}
			else
			{
				$data["message"] = "Invalid product ID.";
				$this->view('message', $data);
			}
		}
		else
		{
			$data["message"] = "You need to be logged in to write a review.";
			$this->view('message', $data);
		}
	}
	
	public function show_review($reviewid)
	{
		if ($this->r2pdb_model->is_valid_review_id($reviewid) === TRUE)
		{
			$data["review"] = $this->r2pdb_model->get_review_by_id_display($reviewid);
			$this->view_comment('showreview', $data, "review");
		}
		else
		{
			$data["message"] = "Invalid review ID.";
			$this->view('message', $data);
		}
	}
}