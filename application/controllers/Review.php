<?php
/**
 * The review page controller.
 * @author Jose
 */

defined('BASEPATH') or exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/My_projekti.php");

/**
 * Class for handling writing reviews.
 */
class Review extends My_projekti
{
	/**
	 * Validate review and add to database or show review writing page.
	 * @param int $productid Database ID of the product the review was written/is going to be written for.
	 */
	public function write_review($productid)
	{
		// Load Community Auth variables.
		$this->is_logged_in();
		
		// User logged in?
		if($this->auth_level > 0)
		{
			// Valid product?
			if ($this->r2pdb_model->is_valid_product_id($productid) === TRUE)
			{
				$data['productid'] = $productid;

				// Found HTTP POST data?
				if($this->input->post('submit'))
				{
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
					// No POST data.
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