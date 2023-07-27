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
class PartnerDataHandle extends DataHandler implements DataHandlerInterface {
    // 생성자 선언
    public function PartnerDataHandle($shopNo = 0) {
        parent::DataHandler();// 부모 생성자 기본 호출
        if ($shopNo) {  // 부모클래스에서 선언된 protected $shopNo 변수 셋팅
            $this::setShopNo($shopNo);
        }
    }

    public function setAfterDomain($afterDomain) {
        $this->afterDomain = $afterDomain;
    }

    public function getAfterDomain() {
        return $this->afterDomain;
    }

    public function setRoopInfo($arrayRoopTableInfo = array()) // 동시 처리를 진행 하는 릴레이션 쿼리 코드 설정
    {
        if (!empty($arrayRoopTableInfo)) {
            $this->arrayRoopTableInfo = $arrayRoopTableInfo;
        }
        else {
            $this->arrayRoopTableInfo = array(
                0 => array('ISRT_Partner', 'UPTT_Partner', 'UPRT_Partner'),
                1 => array('UPTT_MallPartner', 'ISRT_MallPartner'),
            );
        }
    }

    public function setQuery()  // 기본 처리 쿼리 설정
    {
        $this->arrayQuery['ISRT_Partner'] = array(
            "query" => "Insert into comm_partner (
                                partner_name, business_registration_no, partner_status, country_cd,
                                company_name, register_ymdt, register_admin_no, seller_taxation_type,
                                representative_name, business_condition, business_type,
                                represent_phone_no, fax_no, represent_email,
                                online_marketing_business_declaration_no, office_zip_cd,
                                office_address, office_detail_address,
                                office_jibun_address, office_jibun_detail_address,
                                office_city, office_state_or_region, delivery_international_yn,
                                sample_url, privacy_manager_name, privacy_manager_phone_no,
                                manager_name, manager_job_duty, manager_department, manager_job_position,
                                manager_phone_no, manager_email, trade_bank, trade_bank_name,
                                trade_bank_account, trade_bank_depositor_name, swift_code,
                                aba_routing_no, iban_code, bsb_code, commission_bill_issue_type,
                                buying_bill_possible_yn, permitted_ip_address, partner_type,
                                service_no, settlement_manager_name, settlement_manager_phone_no,
                                settlement_manager_email, product_registered_yn)
							Select partner_name, business_registration_no, partner_status, country_cd,
                                    company_name, register_ymdt, register_admin_no, seller_taxation_type,
                                    representative_name, business_condition, business_type,
                                    represent_phone_no, fax_no, represent_email,
                                    online_marketing_business_declaration_no, office_zip_cd,
                                    office_address, office_detail_address,
                                    office_jibun_address, office_jibun_detail_address,
                                    office_city, office_state_or_region, delivery_international_yn,
                                    sample_url, privacy_manager_name, privacy_manager_phone_no,
                                    manager_name, manager_job_duty, manager_department, manager_job_position,
                                    manager_phone_no, mapping_key, trade_bank, trade_bank_name,
                                    trade_bank_account, trade_bank_depositor_name, swift_code,
                                    aba_routing_no, iban_code, bsb_code, commission_bill_issue_type,
                                    buying_bill_possible_yn, permitted_ip_address, partner_type,
                                    service_no, settlement_manager_name, settlement_manager_phone_no,
                                    settlement_manager_email, product_registered_yn
							From tmp_comm_partner
							Where mapping_key {likeDomain};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_Partner'] = array(
            "query" => "Update tmp_comm_partner tcp 
                                 inner join comm_partner cp on tcp.mapping_key = cp.manager_email
                                     Set tcp.partner_no = cp.partner_no 
                                Where tcp.mapping_key {likeDomain};",
            "between_column" => "tcp.seq",
        );

        $this->arrayQuery['UPRT_Partner'] = array(
            "query" => "Update comm_partner cp 
                                     inner join tmp_comm_partner tcp on cp.partner_no = tcp.partner_no
                                         Set cp.manager_email = null 
                                    Where tcp.mapping_key {likeDomain};",
            "between_column" => "tcp.seq",
        );

        $this->arrayQuery['UPTT_MallPartner'] = array(
            "query" => "Update tmp_comm_mall_partner_contract tcmpc 
                                     inner join tmp_comm_partner tcp on tcmpc.partner_mapping_key = tcp.mapping_key
                                         Set tcmpc.partner_no = tcp.partner_no 
                                    Where tcp.mapping_key {likeDomain};",
            "between_column" => "tcmpc.seq",
        );

        $this->arrayQuery['ISRT_MallPartner'] = array(
            "query" => "Insert into comm_mall_partner_contract (
                                mall_no, partner_no, charge_md_no, contract_type, contract_period,
                                contract_status, commission_rate, default_commission_rate_use_yn,
                                promotion_agree_yn, register_ymdt, start_ymdt, register_admin_no,
                                memo, standing_point_contract_used_yn)
							Select mall_no, partner_no, charge_md_no, contract_type, contract_period,
                                contract_status, commission_rate, default_commission_rate_use_yn,
                                promotion_agree_yn, register_ymdt, start_ymdt, register_admin_no,
                                memo, standing_point_contract_used_yn
							From tmp_comm_mall_partner_contract
							Where mall_no = {shopNo};",
            "between_column" => "seq",
        );
    }
}


?>