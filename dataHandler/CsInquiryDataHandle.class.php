<?php
$file_server_path = realpath(__FILE__);
$server_path = str_replace(basename(__FILE__), "", $file_server_path);

require_once ($server_path . 'DataHandler.php');
require_once ($server_path . 'DataHandlerInterface.php');

use dataHandler\DataHandler;

/*
    {query code} pattern
    ISRT - Insert Select into Real Table
    UPRT - Update Real Table
    ISTT - Insert Select into Temporary Table
    UPTT - Update Temporary Table

    {table name} pattern : mb_member => Member, pb_product_option => ProductOption

    array key pattern : {query code}_{table name}
*/
/*
    공통 변수, 공통 메소드 사용 및 부모클래스 자동 실행 메소드를 활용하기 위한 abstract class 인 dataHandler extends 상속
    DataHandleController 클래스 내 인스턴스 변수 타입 사용 제한을 위한 DataHandlerInterface implements 상속
 */
class CsInquiryDataHandle extends DataHandler implements DataHandlerInterface {
    // 생성자 선언
    public function CsInquiryDataHandle($shopNo = 0) {
        parent::DataHandler();// 부모 생성자 기본 호출
        if ($shopNo) {  // 부모클래스에서 선언된 protected $shopNo 변수 셋팅
            $this::setShopNo($shopNo);
        }
    }

    public function setRoopInfo($arrayRoopTableInfo = array()) // 동시 처리를 진행 하는 릴레이션 쿼리 코드 설정
    {
        if (!empty($arrayRoopTableInfo)) {
            $this->arrayRoopTableInfo = $arrayRoopTableInfo;
        }
        else {
            $this->arrayRoopTableInfo = array(
                0 => array('UPTT_Inquiry','UPTT_Inquiry2', 'UPTT_Inquiry3', 'ISRT_Inquiry'),
                1 => array('UPTT_InquiryAttachFile', 'ISRT_InquiryAttachFile'),
                2 => array('UPTT_InquiryAnswer', 'ISRT_InquiryAnswer'),
            );
        }
    }

    public function setQuery()  // 기본 처리 쿼리 설정
    {
        $this->arrayQuery['ISRT_Inquirytype'] = array(
            "query" => "Insert cs_inquiry_type (
                    inquiry_type_name, inquiry_type_description, mall_no, sequence, inquiry_type_delete_yn, inquiry_type_channel) 
                Select 
                    inquiry_type_name, inquiry_type_description, mall_no, sequence, inquiry_type_delete_yn, inquiry_type_channel 
                From tmp_cs_inquiry_type 
                    Where mall_no = {shopNo};",
        );

        $this->arrayQuery['UPTT_Inquiry'] = array(
            "query" => "Update tmp_cs_inquiry tci join (Select cit.inquiry_type_no, tcit.type_mapping_key From cs_inquiry_type cit join tmp_cs_inquiry_type tcit on cit.sequence = tcit.sequence Where cit.mall_no = {shopNo}) citype on tci.type_mapping_key = citype.type_mapping_key set tci.inquiry_type_no = citype.inquiry_type_no where tci.mall_no = {shopNo};",
            "between_column" => "seq",
        );
        $this->arrayQuery['UPTT_Inquiry2'] = array(
            "query" => "Update tmp_cs_inquiry tci join (Select member_no, mapping_key From mb_member Where mall_no = {shopNo}) mm on tci.member_mapping_key = mm.mapping_key Set tci.member_no = mm.member_no Where tci.mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_Inquiry3'] = array(
            "query"  => "Update tmp_cs_inquiry tci join (Select mall_product_no, mapping_key From pd_mall_product Where mall_no = {shopNo}) pmp on tci.product_mapping_key = pmp.mapping_key Set tci.product_no = pmp.mall_product_no Where tci.mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['ISRT_Inquiry'] = array(
            "query" => "Insert cs_inquiry (
                                mall_no, register_ymdt, member_no, admin_no, inquiry_status, inquiry_type_no,
                                inquiry_title, inquiry_content, product_no, order_no, inquiry_delete_yn,
                                answer_sms_send_yn, answer_email_send_yn, member_email, mapping_key,
                                admin_name, member_id
                                ) 
                            Select 
                                mall_no, register_ymdt, member_no, admin_no, inquiry_status, inquiry_type_no,
                                inquiry_title, inquiry_content, product_no, order_no, inquiry_delete_yn,
                                answer_sms_send_yn, answer_email_send_yn, member_email, mapping_key,
                                admin_name, member_id
                            From tmp_cs_inquiry
                            Where mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_InquiryAttachFile'] = array(
            "query" => "Update tmp_cs_inquiry_attach_file tciaf join (Select inquiry_no, mapping_key From cs_inquiry Where mall_no = {shopNo}) ci on tciaf.mapping_key = ci.mapping_key Set tciaf.inquiry_no = ci.inquiry_no Where tciaf.mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['ISRT_InquiryAttachFile'] = array(
            "query" => "Insert cs_inquiry_attach_file (
										original_file_name, register_ymdt, inquiry_no, uploaded_file_name
								 	) 
								Select 
									original_file_name, register_ymdt, inquiry_no, uploaded_file_name
								From tmp_cs_inquiry_attach_file
								Where mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_InquiryAnswer'] = array(
            "query" => "Update tmp_cs_inquiry_answer tcia join (Select inquiry_no, mapping_key From cs_inquiry Where mall_no = {shopNo}) ci on tcia.mapping_key = ci.mapping_key Set tcia.inquiry_no = ci.inquiry_no Where tcia.mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['ISRT_InquiryAnswer'] = array(
            "query" => "Insert cs_inquiry_answer (
										register_ymdt, answer_content, sms_mobile_no, email, inquiry_no,
										sms_send_yn, email_send_yn, answer_complete_yn, sms_send_success_yn,
										email_send_success_yn, external_mapping_key
								 	) 
								Select 
									register_ymdt, answer_content, sms_mobile_no, email, inquiry_no,
									sms_send_yn, email_send_yn, answer_complete_yn, sms_send_success_yn,
									email_send_success_yn, external_mapping_key
								From tmp_cs_inquiry_answer
								Where mall_no = {shopNo};",
            "between_column" => "seq",
        );

    }
}


?>