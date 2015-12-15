<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/My_projekti.php");

class Review extends My_projekti
{
	public function write_review($productid)
	{
		if($this->auth_level > 0)
		{
			if ($this->r2pdb_model->is_valid_product_id($productid) === TRUE)
			{
				$data['productid'] = $productid;
				echo "rev contrl";
				if($this->input->post('submit'))
				{
				echo "PSOTING contrl";
					$this->r2pdb_model->add_review(
						(int) $this->auth_user_id,
						$productid,
						(int) $this->input->post("rating"),
						$this->input->post("review"),
						$this->input->post("pros"),
						$this->input->post("cons"));
					
					$this->view('review_posted');
				}
				else
				{
				echo "rev show form";
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
}