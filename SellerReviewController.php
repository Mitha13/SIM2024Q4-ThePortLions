<?php
require_once 'seller_review.php';

class SellerReviewController {
    private $review;

    public function __construct() {
        $this->review = new Review();
    }

    public function saveReview($userId, $username, $agent, $comment, $rating) {
        return $this->review->save($userId, $username, $agent, $comment, $rating);
    }
}

class GetSellerReviews {
	private $review;

    public function __construct() {
        $this->review = new Review();
    }
	
	public function getSellerReviews($username) {
        return $this->review->getSellerReviews($username);
    }
}

?>
