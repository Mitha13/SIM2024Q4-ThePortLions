<?php
require_once 'agent_review.php';

class GetReviewByBuyer {
	private $review;

    public function __construct() {
        $this->review = new Review();
    }
	
	public function getBuyerReviews($username) {
        return $this->review->getBuyerReviews($username);
    }
}

class GetReviewBySeller {
	private $review;

    public function __construct() {
        $this->review = new Review();
    }
	
	public function getSellerReviews($username) {
        return $this->review->getSellerReviews($username);
    }
}

?>
