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
class ReviewDataHandle extends DataHandler implements DataHandlerInterface {
    // 생성자 선언
    public function ReviewDataHandle($shopNo = 0) {
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
                0 => array('UPTT_Review','UPTT_Review2', 'ISRT_Review'),
                1 => array('UPTT_Attach', 'ISRT_Attach'),
                2 => array('UPTT_ProductAccumulateCount', 'UPRT_ProductAccumulateCount'),
            );
        }
    }

    public function setQuery()  // 기본 처리 쿼리 설정
    {
        $this->arrayQuery['UPTT_Review'] = array(
            "query" => "Update tmp_pd_review tpr join (Select member_no, mapping_key From mb_member where mall_no = {shopNo}) mm on tpr.member_mapping_key = mm.mapping_key Set tpr.register_no = mm.member_no Where tpr.mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_Review2'] = array(
            "query" => "Update tmp_pd_review tpr join (Select mall_product_no, mapping_key From pd_mall_product where mall_no = {shopNo}) pmp on tpr.product_mapping_key = pmp.mapping_key Set tpr.mall_product_no = pmp.mall_product_no Where tpr.mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['ISRT_Review'] = array(
            "query" => "Insert into pd_review 
											(mall_no, partner_no, order_no, mall_product_no, mall_option_no,
												product_name, option_name, register_name, rating,
												display_status_cd, recommend_cnt, report_cnt, blind_report_cnt,
												content, member_id, provider_type, register_ymdt, register_no,
												update_ymdt, update_no, delete_yn, attach_yn, order_product_option_no,
												master_yn, mapping_key, platform_type, extra_json, best_review_yn,
												brand_name, partner_name) 
								Select mall_no, partner_no, order_no, mall_product_no, mall_option_no,
										product_name, option_name, register_name, rating,
										display_status_cd, recommend_cnt, report_cnt, blind_report_cnt,
										content, member_id, provider_type, register_ymdt, register_no,
										update_ymdt, update_no, delete_yn, attach_yn, order_product_option_no,
										master_yn, mapping_key, platform_type, extra_json, best_review_yn,
										brand_name, partner_name 
								From   tmp_pd_review 
								where  mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_Attach'] = array(
            "query" => "Update tmp_pd_attach tpa join (Select review_no, mapping_key From pd_review Where mall_no = {shopNo}) pr on tpa.review_mapping_key = pr.mapping_key Set tpa.target_no = pr.review_no where mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['ISRT_Attach'] = array(
            "query" => "Insert into pd_attach 
											(
											 target_no,
											 attach_type,
											 url
											) 
								Select target_no,
									   attach_type,
									   url 
								From   tmp_pd_attach 
								where  mall_no = {shopNo};",
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
                             review_rate = VALUES(review_rate),
                             review_total_cnt = VALUES(review_total_cnt),
                             naver_review_cnt = VALUES(naver_review_cnt);",
            "between_column" => "seq",
        );

    }
}


?>