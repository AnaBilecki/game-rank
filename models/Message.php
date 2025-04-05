<?php

session_start();

class Message
{

    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function setMessage($message, $type, $redirect = "index.php")
    {
        $_SESSION["message"] = $message;
        $_SESSION["type"] = $type;

        if ($redirect != "back") {
            header("Location: $this->url" . "/" . $redirect);
        } else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    public function getMessage()
    {
        if (!empty($_SESSION["message"])) {
            return [
                "message" => $_SESSION["message"],
                "type" => $_SESSION["type"]
            ];
        } else {
            return false;
        }
    }

    public function clearMessage()
    {
        $_SESSION["message"] = "";
        $_SESSION["type"] = "";
    }
}
