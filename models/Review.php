<?php

class Review
{

    public $id;
    public $rating;
    public $review;
    public $userId;
    public $gameId;
    public $user;
}

interface ReviewDAOInterface
{

    public function buildReview($data);
    public function create(Review $review);
    public function getGamesReview($id);
    public function hasAlreadyReviewed($gameId, $userId);
    public function getRating($id);
}
