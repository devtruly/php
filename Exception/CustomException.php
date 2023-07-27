<?php
// 사용자 정의 Exception 생성
// 노출할 메시지 형태 기본 셋팅
// debug 형태로 메시지를 출력할 수 있는 printStackTrace 메소드 생성
class CustomException extends Exception {

    public function __construct($message = "Unknown Exception", $exceptionType = "CustomException")
    {
        $errorMassage = "Warning : $exceptionType, $message\n";
        $errorMassage .= "at " . parent::getFile() . "(Line : " . parent::getLine() . ")\n";
        parent::__construct($errorMassage);
    }

    public function printStackTrace() {
        print "<xmp style=\"display:block;font:12pt 'Bitstream Vera Sans Mono, Courier New';background:#202020;color:#D2FFD2;padding:10px;margin:0;overflow:auto;\">";
        print_r($this::getMessage());
        print "</xmp>";
    }
}
?>