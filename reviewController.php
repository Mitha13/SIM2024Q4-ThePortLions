<?php
require_once 'review.php';

class ReviewController {
    private $review;

    public function __construct() {
        $this->review = new Review();
    }

    public function saveReview($userId, $username, $carId, $comment, $rating) {
        return $this->review->save($userId, $username, $carId, $comment, $rating);
    }
}
