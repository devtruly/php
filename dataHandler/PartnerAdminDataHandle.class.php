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
class PartnerAdminDataHandle extends DataHandler implements DataHandlerInterface {
    // 생성자 선언
    public function PartnerAdminDataHandle($shopNo = 0) {
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
                0 => array('UPTT_Admin', 'ISRT_Admin', 'UPRT_Admin'),
            );
        }
    }

    public function setQuery()  // 기본 처리 쿼리 설정
    {
        $this->arrayQuery['UPTT_Admin'] = array(
            "query" => "Update tmp_comm_admin tca
                                 inner join tmp_comm_partner tcp on tca.partner_mapping_key = tcp.mapping_key
                                    Set tca.partner_no = tcp.partner_no
                                 Where tca.mapping_key {likeDomain};",
            "between_column" => "tca.seq",
        );

        $this->arrayQuery['ISRT_Admin'] = array(
            "query" => "Insert into comm_admin (
                                admin_id, admin_password, admin_name, admin_type, admin_role, admin_status,
                                phone_no, mobile_no, email, job_position_name, job_duty_no, job_duty_name,
                                service_no, partner_no, external_access_yn, department_no, department_name,
                                register_ymdt, register_admin_no, language, time_zone, last_login_ymdt,
                                last_name, first_name, authority_group_update_ymdt, password_update_ymdt, oauth_id_no)
							Select admin_id, admin_password, admin_name, admin_type, admin_role, admin_status,
                                phone_no, mobile_no, email, job_position_name, job_duty_no, job_duty_name,
                                service_no, partner_no, external_access_yn, department_no, department_name,
                                register_ymdt, register_admin_no, language, time_zone, last_login_ymdt,
                                last_name, first_name, authority_group_update_ymdt, password_update_ymdt, mapping_key
							From tmp_comm_admin
							Where mapping_key {likeDomain};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPRT_Admin'] = array(
            "query" => "Update comm_admin ca 
                                     inner join tmp_comm_admin tca on ca.admin_no = tca.admin_no
                                         Set ca.oauth_id_no = null 
                                    Where tca.mapping_key {likeDomain};",
            "between_column" => "tca.seq",
        );

    }
}


?>