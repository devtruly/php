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
class AreaFeeDataHandle extends DataHandler implements DataHandlerInterface {
    // 생성자 선언
    public function AreaFeeDataHandle($shopNo = 0) {
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
                0 => array('UPTT_AreaFee', 'ISRT_AreaFee', 'UPTT_AreaFee2'),
                1 => array('UPTT_AreaFeeDetail', 'ISRT_AreaFeeDetail'),
            );
        }
    }

    public function setQuery()  // 기본 처리 쿼리 설정
    {
        $this->arrayQuery['UPTT_AreaFee'] = array(
            "query" => "Update tmp_od_delivery_area_fee todaf 
                                     inner join tmp_comm_partner tcp on todaf.partner_mapping_key = tcp.mapping_key
                                         Set todaf.partner_no = tcp.partner_no 
                                    Where tcp.mapping_key {likeDomain};",
            "between_column" => "todaf.seq",
        );

        $this->arrayQuery['ISRT_AreaFee'] = array(
            "query" => "Insert into od_delivery_area_fee (
                                area_fee_name, partner_no, register_ymdt, country_cd, admin_no, delete_yn,
                                    mapping_key, update_ymdt, update_admin_no)
							Select area_fee_name, partner_no, register_ymdt, country_cd, admin_no, delete_yn,
                                    mapping_key, update_ymdt, update_admin_no
							From tmp_od_delivery_area_fee
							Where mapping_key {likeDomain};",
            "between_column" => "seq",
        );

        $this->arrayQuery['UPTT_AreaFee2'] = array(
            "query" => "Update tmp_od_delivery_area_fee todaf 
                                 inner join od_delivery_area_fee odaf on todaf.mapping_key = odaf.mapping_key
                                     Set todaf.area_fee_no = odaf.area_fee_no 
                                Where todaf.mapping_key {likeDomain};",
            "between_column" => "todaf.seq",
        );

        $this->arrayQuery['UPTT_AreaFeeDetail'] = array(
            "query" => "Update tmp_od_delivery_area_fee_detail todafd 
                                 inner join tmp_od_delivery_area_fee todaf on todafd.mapping_key = todaf.mapping_key
                                     Set todafd.area_fee_no = todaf.area_fee_no,
                                        todafd.partner_no = todaf.partner_no 
                                Where todafd.mapping_key {likeDomain};",
            "between_column" => "todafd.seq",
        );

        $this->arrayQuery['ISRT_AreaFeeDetail'] = array(
            "query" => "Insert into od_delivery_area_fee_detail (
                                area_fee_no, area_no, extra_delivery_amt, partner_no, mapping_key)
							Select area_fee_no, area_no, extra_delivery_amt, partner_no, mapping_key
							From tmp_od_delivery_area_fee_detail
							Where mapping_key {likeDomain};",
            "between_column" => "seq",
        );

    }
}


?>