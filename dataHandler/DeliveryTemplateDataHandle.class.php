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
class DeliveryTemplateDataHandle extends DataHandler implements DataHandlerInterface {
    // 생성자 선언
    public function DeliveryTemplateDataHandle($shopNo = 0) {
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
                0 => array('UPTT_DeliveryTemplate', 'UPTT_DeliveryTemplate2', 'UPTT_DeliveryTemplate3', 'UPTT_DeliveryTemplate4', 'ISRT_DeliveryTemplate', 'UPTT_DeliveryTemplate5'),
                1 => array('UPTT_DeliverCondition', 'UPTT_DeliverCondition2', 'ISRT_DeliverCondition'),
            );
        }
    }

    public function setQuery()  // 기본 처리 쿼리 설정
    {
        $this->arrayQuery['UPTT_DeliveryTemplate'] = array(
            "query" => "Update tmp_od_delivery_template todt 
                                     inner join tmp_comm_partner tcp on todt.partner_mapping_key = tcp.mapping_key
                                         Set todt.partner_no = tcp.partner_no 
                                    Where tcp.mapping_key {likeDomain};",
            "between_column" => "todt.seq",
        );

        $this->arrayQuery['UPTT_DeliveryTemplate2'] = array(
            "query" => "Update tmp_od_delivery_template todt 
                                     inner join tmp_od_delivery_template_group todtg on todt.template_group_mapping_key = todtg.mapping_key
                                         Set todt.delivery_template_group_no = todtg.delivery_template_group_no 
                                    Where todt.mapping_key {likeDomain};",
            "between_column" => "todt.seq",
        );

        $this->arrayQuery['UPTT_DeliveryTemplate3'] = array(
            "query" => "Update tmp_od_delivery_template todt 
                                     inner join tmp_od_warehouse tow on todt.rel_warehouse_mapping_key = tow.mapping_key
                                         Set todt.release_warehouse_no = tow.warehouse_no 
                                    Where todt.mapping_key {likeDomain};",
            "between_column" => "todt.seq",
        );

        $this->arrayQuery['UPTT_DeliveryTemplate4'] = array(
            "query" => "Update tmp_od_delivery_template todt 
                                     inner join tmp_od_warehouse tow on todt.ret_warehouse_mapping_key = tow.mapping_key
                                         Set todt.return_warehouse_no = tow.warehouse_no 
                                    Where todt.mapping_key {likeDomain};",
            "between_column" => "todt.seq",
        );

        $this->arrayQuery['ISRT_DeliveryTemplate'] = array(
            "query" => "Insert into od_delivery_template (
                                delivery_template_group_no, partner_no, template_name, delivery_template_type,
                                release_warehouse_no, return_warehouse_no, default_yn, delete_yn, mapping_key,
                                register_admin_no, register_ymdt, update_ymdt, update_admin_no)
							Select delivery_template_group_no, partner_no, template_name, delivery_template_type,
                                    release_warehouse_no, return_warehouse_no, default_yn, delete_yn, mapping_key,
                                    register_admin_no, register_ymdt, update_ymdt, update_admin_no
							From tmp_od_delivery_template
							Where mapping_key {likeDomain};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_DeliveryTemplate5'] = array(
            "query" => "Update tmp_od_delivery_template todt 
                                     inner join od_delivery_template odt on todt.mapping_key = odt.mapping_key
                                         Set todt.delivery_template_no = odt.delivery_template_no 
                                    Where todt.mapping_key {likeDomain};",
            "between_column" => "todt.seq",
        );

        $this->arrayQuery['UPTT_DeliverCondition'] = array(
            "query" => "Update tmp_od_delivery_condition todc 
                                     inner join tmp_od_delivery_template todt on todc.mapping_key = todt.mapping_key
                                         Set todc.delivery_template_no = todt.delivery_template_no 
                                    Where todc.mapping_key {likeDomain};",
            "between_column" => "todc.seq",
        );

        $this->arrayQuery['UPTT_DeliverCondition2'] = array(
            "query" => "Update tmp_od_delivery_condition todc 
                                     inner join tmp_comm_partner tcp on todc.partner_mapping_key = tcp.mapping_key
                                         Set todc.partner_no = tcp.partner_no 
                                    Where tcp.mapping_key {likeDomain};",
            "between_column" => "todc.seq",
        );

        $this->arrayQuery['ISRT_DeliverCondition'] = array(
            "query" => "Insert into od_delivery_condition (
                                delivery_template_no, shipping_method_type, delivery_countries, delivery_condition_type,
                                    delivery_amt, return_delivery_amt, partner_no, above_delivery_amt, per_order_cnt,
                                    register_admin_no, register_ymdt, delivery_type, delivery_company_type, delete_yn,
                                    front_display_text, remote_area_fee_condition_check_yn, mapping_key, update_ymdt,
                                    update_admin_no, delivery_fee_range_json)
							Select delivery_template_no, shipping_method_type, delivery_countries, delivery_condition_type,
                                    delivery_amt, return_delivery_amt, partner_no, above_delivery_amt, per_order_cnt,
                                    register_admin_no, register_ymdt, delivery_type, delivery_company_type, delete_yn,
                                    front_display_text, remote_area_fee_condition_check_yn, mapping_key, update_ymdt,
                                    update_admin_no, delivery_fee_range_json
							From tmp_od_delivery_condition
							Where mapping_key {likeDomain};",
            "between_column" => "seq",
        );
    }
}


?>