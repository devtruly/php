<?php
$file_server_path = realpath(__FILE__);
$server_path = str_replace(basename(__FILE__), "", $file_server_path);
require_once $server_path . "CustomException.php";

// 상속하고 있는 CustomException 메시지 전달
class BetweenNullPointerException extends CustomException {

    public function __construct($message = "")
    {
        $message = ($message) ? $message : "Split information does not exist.";
        parent::__construct($message, "BetweenNullPointerException");
    }
}
?>