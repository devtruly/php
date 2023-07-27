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
class WarehouseDataHandle extends DataHandler implements DataHandlerInterface {
    // 생성자 선언
    public function WarehouseDataHandle($shopNo = 0) {
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
                0 => array('UPTT_Warehouse', 'ISRT_Warehouse', 'UPTT_Warehouse2'),
            );
        }
    }

    public function setQuery()  // 기본 처리 쿼리 설정
    {
        $this->arrayQuery['UPTT_Warehouse'] = array(
            "query" => "Update tmp_od_warehouse tow 
                                     inner join tmp_comm_partner tcp on tow.partner_mapping_key = tcp.mapping_key
                                         Set tow.partner_no = tcp.partner_no 
                                    Where tcp.mapping_key {likeDomain};",
            "between_column" => "tow.seq",
        );

        $this->arrayQuery['ISRT_Warehouse'] = array(
            "query" => "Insert into od_warehouse (
                                warehouse_name, partner_no, default_release_warehouse_yn, default_return_warehouse_yn,
                                address, zip_cd, oversea_address1, oversea_address2, oversea_city, oversea_region,
                                detail_address, delete_yn, country_cd, warehouse_address_type, mapping_key,
                                register_admin_no, register_ymdt, update_ymdt, update_admin_no, contact)
							Select warehouse_name, partner_no, default_release_warehouse_yn, default_return_warehouse_yn,
                                    address, zip_cd, oversea_address1, oversea_address2, oversea_city, oversea_region,
                                    detail_address, delete_yn, country_cd, warehouse_address_type, mapping_key,
                                    register_admin_no, register_ymdt, update_ymdt, update_admin_no, contact
							From tmp_od_warehouse
							Where mapping_key {likeDomain};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_Warehouse2'] = array(
            "query" => "Update tmp_od_warehouse tow 
                                     inner join od_warehouse ow on tow.mapping_key = ow.mapping_key
                                         Set tow.warehouse_no = ow.warehouse_no 
                                    Where tow.mapping_key {likeDomain};",
            "between_column" => "tow.seq",
        );
    }
}


?>