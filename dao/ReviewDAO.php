<?php

include_once("models/Review.php");
include_once("models/Message.php");
include_once("dao/UserDAO.php");

class ReviewDAO implements ReviewDAOInterface
{

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildReview($data)
    {
        $review = new Review();

        $review->id = $data["id"];
        $review->rating = $data["rating"];
        $review->review = $data["review"];
        $review->userId = $data["user_id"];
        $review->gameId = $data["game_id"];

        return $review;
    }

    public function create(Review $review)
    {
        $stmt = $this->conn->prepare("INSERT INTO review (
                rating, review, game_id, user_id
            ) VALUES (
                :rating, :review, :gameId, :userId
        )");

        $stmt->bindParam(":rating", $review->rating);
        $stmt->bindParam(":review", $review->review);
        $stmt->bindParam(":gameId", $review->gameId);
        $stmt->bindParam(":userId", $review->userId);

        $stmt->execute();

        $this->message->setMessage("Crítica adicionada com sucesso!", "success", "index.php");
    }

    public function getGamesReview($id)
    {
        $reviews = [];

        $stmt = $this->conn->prepare("SELECT * FROM review WHERE game_id = :id");

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $reviewsData = $stmt->fetchAll();

            $userDao = new UserDao($this->conn, $this->url);

            foreach ($reviewsData as $review) {
                $reviewObject = $this->buildReview($review);

                $user = $userDao->findById($reviewObject->userId);

                $reviewObject->user = $user;

                $reviews[] = $reviewObject;
            }
        }
        return $reviews;
    }

    public function hasAlreadyReviewed($gameId, $userId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM review WHERE game_id = :gameId AND user_id = :userId");

        $stmt->bindParam(":gameId", $gameId);
        $stmt->bindParam(":userId", $userId);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getRating($id) {}
}
