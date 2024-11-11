<?php
require_once 'review.php';

class ReviewController {
    private $review;

    public function __construct() {
        $this->review = new Review();
    }

    public function saveReview($userId, $username, $agent, $carId, $comment, $rating) {
        return $this->review->save($userId, $username, $agent, $carId, $comment, $rating);
    }
}

class GetReviews {
	private $review;

    public function __construct() {
        $this->review = new Review();
    }
	
	public function getReviews($username) {
        return $this->review->getReviews($username);
    }
}

?>
