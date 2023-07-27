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
class MemberDataHandle extends DataHandler implements DataHandlerInterface {
    // 생성자 선언
    public function MemberDataHandle($shopNo = 0) {
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
                0 => array('UPTT_Member','ISRT_Member'),
                1 => array('ISRT_Accumulation'),
                2 => array('ISRT_Address'),
                3 => array('UPTT_MemberProvider', 'ISRT_MemberProvider'),
            );
        }
    }

    public function setQuery()  // 기본 처리 쿼리 설정
    {
        $this->arrayQuery['ISRT_MemberGrade'] = array(
            "query" => "Insert into mb_member_grade 
											(member_grade_name, 
											 accumulation_rate, 
											 member_grade_accumulation_use_yn, 
											 accumulation_automatic_payment_use_yn, 
											 use_yn, 
											 advance_min_order_cnt, 
											 advance_min_order_amt, 
											 grade, 
											 mall_no) 
								Select member_grade_name, 
									   accumulation_rate, 
									   member_grade_accumulation_use_yn, 
									   accumulation_automatic_payment_use_yn, 
									   use_yn, 
									   advance_min_order_cnt, 
									   advance_min_order_amt, 
									   grade, 
									   mall_no 
								From   tmp_mb_member_grade 
								Where  mall_no = {shopNo};",
        );

        $this->arrayQuery['ISRT_MemberGroup'] = array(
            "query" => "Insert into mb_member_group 
											(member_group_name, 
											 accumulation_rate, 
											 member_group_accumulation_use_yn, 
											 benefit_use_yn, 
											 mall_no, 
											 sequence) 
								Select member_group_name, 
									   accumulation_rate, 
									   member_group_accumulation_use_yn, 
									   benefit_use_yn, 
									   mall_no, 
									   sequence 
								From   tmp_mb_member_group 
								Where  mall_no = {shopNo};",
        );

        $this->arrayQuery['UPTT_MemberGrade'] = array(
            "query" => "Update tmp_mb_member_grade a join mb_member_grade b on a.member_grade_name = b.member_grade_name set a.member_grade_no = b.member_grade_no where a.mall_no = {shopNo} and b.mall_no = {shopNo};",
        );

        $this->arrayQuery['UPTT_Member'] = array(
            "query" => "Update tmp_mb_member a Set member_grade_no = (Select member_grade_no From tmp_mb_member_grade where mapping_key = a.grade_mapping_key and mall_no = {shopNo}) Where mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['ISRT_Member'] = array(
            "query" => "Insert into mb_member 
											(member_grade_no, password, member_name, mobile_no, mobile_no_last_digits,
											 telephone_no, member_status, member_type, principal_certification_yn, principal_certification_ymdt,
        									 birthday, sex, email, zip_cd, address, detail_address, jibun_address, jibun_detail_address,
        									 nickname, additional_info, mall_no, join_type, member_id, join_ymdt, blacklist_yn, last_login_ymdt,
        									 last_login_ip, accumulation_amt, login_count, push_notification_agree_yn,
        									 push_notification_agree_ymdt, sms_agree_yn, sms_agree_ymdt, direct_mail_agree_yn, 
        									 direct_mail_agree_ymdt, admin_comment, refund_bank, refund_bank_account, refund_bank_depositor_name,
        									 member_ci, mapping_key, last_grade_update_ymdt, last_password_change_ymdt, country_cd,
        									 adult_certificated_yn, adult_certificated_ymdt, country_calling_code, provider_type, 
        									 password_change_required_yn, linked_yn, link_ymdt, last_update_ymdt) 
								Select 		member_grade_no, password, member_name, mobile_no, mobile_no_last_digits,
											 telephone_no, member_status, member_type, principal_certification_yn, principal_certification_ymdt,
        									 birthday, sex, email, zip_cd, address, detail_address, jibun_address, jibun_detail_address,
        									 nickname, additional_info, mall_no, join_type, member_id, join_ymdt, blacklist_yn, last_login_ymdt,
        									 last_login_ip, accumulation_amt, login_count, push_notification_agree_yn,
        									 push_notification_agree_ymdt, sms_agree_yn, sms_agree_ymdt, direct_mail_agree_yn, 
        									 direct_mail_agree_ymdt, admin_comment, refund_bank, refund_bank_account, refund_bank_depositor_name,
        									 member_ci, mapping_key, last_grade_update_ymdt, last_password_change_ymdt, country_cd,
        									 adult_certificated_yn, adult_certificated_ymdt, country_calling_code, provider_type, 
        									 password_change_required_yn, linked_yn, link_ymdt, last_update_ymdt
								From   tmp_mb_member 
								Where  mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['ISRT_MemberMemberGroupMapping'] = array(
            "query" => "Insert Into mb_member_member_group_mapping 
										(member_no, member_group_no) 
							Select member_no, member_group_no 
							From   ((Select tmmg.mapping_key, 
										   mmg.member_group_no 
									From   tmp_mb_member_group tmmg 
										   join mb_member_group mmg 
											 on tmmg.member_group_name = mmg.member_group_name 
									Where  tmmg.mall_no = {shopNo} 
										   and mmg.mall_no = {shopNo}) a 
									 join (Select mm.member_no, 
												  tmm.group_mapping_key 
										   From   tmp_mb_member tmm 
												  join mb_member mm 
													on tmm.member_id = mm.member_id 
										   Where  tmm.mall_no = {shopNo} 
												  and mm.mall_no = {shopNo}) b 
									   on a.mapping_key = b.group_mapping_key);",
        );

        $this->arrayQuery['ISTT_MemberNo'] = array(
            "query" => "Insert Into tmp_mb_member_no Select member_no, mapping_key From mb_member Where mall_no = {shopNo};",
        );

        $this->arrayQuery['UPTT_Accumulation'] = array(
            "query" => "Update tmp_mb_accumulation tma join (Select member_no, mapping_key From tmp_mb_member_no) mm on tma.mapping_key = mm.mapping_key set tma.member_no = mm.member_no where tma.mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['ISRT_Accumulation'] = array(
            "query" => "Insert into mb_accumulation (
											mall_no, member_no, accumulation_type, register_ymdt, expire_ymdt, accumulation_reason, accumulation_status,
											accumulation_amt, reason_detail, order_no, review_no, accumulation_rest_amt, total_available_amt, register_admin_no,
											mapping_key, product_display_name, accumulation_payment_request_no, start_ymdt)
									Select  mall_no, member_no, accumulation_type, register_ymdt, expire_ymdt, accumulation_reason, accumulation_status,
											accumulation_amt, reason_detail, order_no, review_no, accumulation_rest_amt, total_available_amt, register_admin_no,
											mapping_key, product_display_name, accumulation_payment_request_no, start_ymdt
									From tmp_mb_accumulation
									Where  mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_Address'] = array(
            "query" => "Update tmp_od_address tod join (Select member_no, mapping_key From tmp_mb_member_no) mm on tod.mapping_key = mm.mapping_key Set tod.member_no = mm.member_no Where tod.mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['ISRT_Address'] = array(
            "query" => "Insert into od_address 
												(member_no,
												 address_name, 
												 default_yn, 
												 receiver_zip_cd, 
												 receiver_address,
												 receiver_jibun_address, 
												 receiver_detail_address,
												 receiver_name,
												 receiver_contact1,
												 receiver_contact2,
												 register_ymdt,
												 country_cd,
												 address_type,
												 mapping_key,
												 mall_no) 
									Select 		member_no,
												 address_name, 
												 default_yn, 
												 receiver_zip_cd, 
												 receiver_address,
												 receiver_jibun_address, 
												 receiver_detail_address,
												 receiver_name,
												 receiver_contact1,
												 receiver_contact2,
												 register_ymdt,
												 country_cd,
												 address_type,
												 mapping_key,
												 mall_no 
									From   tmp_od_address 
									Where  mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_MemberProvider'] = array(
            "query" => "Update tmp_mb_member_provider tmmp join (Select member_no, mapping_key From tmp_mb_member_no) mm on tmmp.mapping_key = mm.mapping_key Set tmmp.member_no = mm.member_no Where tmmp.mall_no = {shopNo};",
            "between_column" => "seq",
        );

        $this->arrayQuery['ISRT_MemberProvider'] = array(
            "query" => "Insert into mb_member_provider 
												(member_no,
												 oauth_id, 
												 provider_type, 
												 mall_no, 
												 delete_yn,
												 register_ymdt) 
									Select 		member_no,
												 oauth_id, 
												 provider_type, 
												 mall_no, 
												 delete_yn,
												 register_ymdt 
									From   tmp_mb_member_provider 
									Where  mall_no = {shopNo};",
            "between_column" => "seq",
        );
    }
}

//$memberDataHandle = new MemberDataHandle();
/*
$test = "Insert into mb_member_provider 
												(member_no,
												 oauth_id, 
												 provider_type, 
												 mall_no, 
												 delete_yn,
												 register_ymdt) 
									Select 		member_no,
												 oauth_id, 
												 provider_type, 
												 mall_no, 
												 delete_yn,
												 register_ymdt 
									From   tmp_mb_member_provider 
									Where  mall_no = {shopNo};";
*/
/*
$pattern = "/(where)([^\;]+);$/i";
preg_match($pattern, $test, $result);
echo preg_replace($pattern, '$1$2' . ' and ', $test);
echo '<pre>';
print_r($result);
echo '</pre>';
*/

?>