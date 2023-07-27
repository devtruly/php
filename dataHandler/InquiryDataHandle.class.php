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
class InquiryDataHandle extends DataHandler implements DataHandlerInterface {
    // 생성자 선언
    public function InquiryDataHandle($shopNo = 0) {
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
                0 => array('UPTT_Inquiry', 'UPTT_Inquiry2', 'UPTT_Inquiry3'),
                1 => array('ISRT_Inquiry'),
                2 => array('UPTT_Inquiry4', 'UPTT_Inquiry5'),
                3 => array('UPTT_ProductAccumulateCount', 'UPRT_ProductAccumulateCount'),
            );
        }
    }

    public function setQuery()  // 기본 처리 쿼리 설정
    {
        $this->arrayQuery['UPTT_Inquiry'] = array(
            "query" => "Update tmp_pd_inquiry tpi join (Select member_no, mapping_key From mb_member Where mall_no = {shopNo}) mm on tpi.member_mapping_key = mm.mapping_key Set tpi.register_no = mm.member_no Where tpi.mall_no = {shopNo}",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_Inquiry2'] = array(
            "query" => "Update tmp_pd_inquiry tpi join (Select mall_product_no, mapping_key From pd_mall_product Where mall_no = {shopNo}) pmp on tpi.product_mapping_key = pmp.mapping_key Set tpi.mall_product_no = pmp.mall_product_no, tpi.partner_no = pmp.partner_no Where tpi.mall_no = {shopNo}",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_Inquiry3'] = array(
            "query" => "Update tmp_pd_inquiry Set admin_yn = 'Y' Where member_mapping_key = 'admin' and mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['ISRT_Inquiry'] = array(
            "query" => "Insert into pd_inquiry 
								(parent_no, title, content, member_id, provider_type, mall_no, partner_no,
								 mall_product_no, inquiry_cd, product_name, register_name, secret_yn,
								 admin_yn, reply_yn, reply_ymdt, delete_yn, order_no, register_ymdt,
								 register_no, update_ymdt, update_no, mapping_key, email)
							Select parent_no, title, content, member_id, provider_type, mall_no, partner_no,
								 mall_product_no, inquiry_cd, product_name, register_name, secret_yn,
								 admin_yn, reply_yn, reply_ymdt, delete_yn, order_no, register_ymdt,
								 register_no, update_ymdt, update_no, mapping_key, email
							From tmp_pd_inquiry
							Where mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_Inquiry4'] = array(
            "query" => "Update tmp_pd_inquiry tpi join pd_inquiry pi on tpi.parent_mapping_key = pi.mapping_key Set pi.reply_yn = 'Y', pi.reply_ymdt = tpi.register_ymdt, tpi.parent_no = pi.inquiry_no Where tpi.parent_mapping_key is not null and tpi.mall_no = {shopNo} and pi.mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_Inquiry5'] = array(
            "query" => "Update tmp_pd_inquiry tpi join pd_inquiry pi on tpi.mapping_key = pi.mapping_key Set pi.parent_no = tpi.parent_no Where tpi.parent_mapping_key is not null and pi.mall_no = {shopNo} and tpi.mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_ProductAccumulateCount'] = array(
            "query" => "Update tmp_pd_mall_product_accumulate_count tpmpac join pd_mall_product pmp on tpmpac.mapping_key = pmp.mapping_key Set tpmpac.mall_product_no = pmp.mall_product_no where mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPRT_ProductAccumulateCount'] = array(
            "query" => "insert into pd_mall_product_accumulate_count
                        (mall_product_no, like_cnt, review_rate, review_total_cnt,
                         product_inquiry_total_cnt, naver_review_cnt)
                         select
                             tpmpac.mall_product_no, 0, tpmpac.review_rate, tpmpac.review_total_cnt,
                             tpmpac.product_inquiry_total_cnt, tpmpac.naver_review_cnt
                        from
                            pd_mall_product_accumulate_count pmpac join tmp_pd_mall_product_accumulate_count tpmpac join pd_mall_product pmp on pmp.mall_product_no = tpmpac.mall_product_no and pmpac.mall_product_no = tpmpac.mall_product_no
                        where pmp.mall_no = {shopNo} and {between}
                        on duplicate key update
                             product_inquiry_total_cnt = VALUES(product_inquiry_total_cnt);",
            "between_column" => "seq",
        );
    }
}


?>