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
class DeliveryTemplateGroupDataHandle extends DataHandler implements DataHandlerInterface {
    // 생성자 선언
    public function DeliveryTemplateGroupDataHandle($shopNo = 0) {
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
                0 => array('UPTT_DeliveryTemplateGroup', 'UPTT_DeliveryTemplateGroup2', 'ISRT_DeliveryTemplateGroup', 'UPTT_DeliveryTemplateGroup3'),
            );
        }
    }

    public function setQuery()  // 기본 처리 쿼리 설정
    {
        $this->arrayQuery['UPTT_DeliveryTemplateGroup'] = array(
            "query" => "Update tmp_od_delivery_template_group todtg 
                                     inner join tmp_comm_partner tcp on todtg.partner_mapping_key = tcp.mapping_key
                                         Set todtg.partner_no = tcp.partner_no 
                                    Where tcp.mapping_key {likeDomain};",
            "between_column" => "todtg.seq",
        );

        $this->arrayQuery['UPTT_DeliveryTemplateGroup2'] = array(
            "query" => "Update tmp_od_delivery_template_group todtg 
                                     inner join tmp_od_delivery_area_fee todaf on todtg.area_fee_mapping_key = todaf.mapping_key
                                         Set todtg.area_fee_no = todaf.area_fee_no 
                                    Where todaf.mapping_key {likeDomain};",
            "between_column" => "todtg.seq",
        );

        $this->arrayQuery['ISRT_DeliveryTemplateGroup'] = array(
            "query" => "Insert into od_delivery_template_group (
                                partner_no, group_delivery_amt_type, template_group_name, display_no,
                                default_yn, delete_yn, area_fee_no, delivery_template_type,
                                delivery_amt_in_advance_yn, mapping_key,
                                register_admin_no, register_ymdt)
							Select partner_no, group_delivery_amt_type, template_group_name, display_no,
                                    default_yn, delete_yn, area_fee_no, delivery_template_type,
                                    delivery_amt_in_advance_yn, mapping_key,
                                    register_admin_no, register_ymdt
							From tmp_od_delivery_template_group
							Where mapping_key {likeDomain};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_DeliveryTemplateGroup3'] = array(
            "query" => "Update tmp_od_delivery_template_group todtg 
                                     inner join od_delivery_template_group odafg on todtg.mapping_key = odafg.mapping_key
                                         Set todtg.delivery_template_group_no = odafg.delivery_template_group_no 
                                    Where todtg.mapping_key {likeDomain};",
            "between_column" => "todtg.seq",
        );
    }
}


?>