<?php
$arrayDataDefaultValue = array(
    'pd_brand' => array(
        'brand_name_en'			=> '',			// 영문 브랜드명
        'brand_name_ko'			=> '',			// 한글 브랜드명
        'brand_name'			=> '',			// 브랜드명
        'brand_name_type'		=> 'BNMT0001',	// 브랜드 타입(BNMT0001 고정)
        'status_type'			=> 'BRAS0001',	//
        'mapping_key'           => '',          // 상품 브랜드 연결 코드
        'register_ymdt'			=> 'now()',			// 등록일
        'mall_no'               => '',          // 상점 번호
    ),

    'pd_display_category' => array(
        //'display_category_no'			=> '',			// 카테고리 번호
        'display_category_name'			=> '',			// 카테고리명
        'display_order'			        => '1',			// 노출 순서
       //'parent_display_category_no'	=> '',			// 상위 depth 카테고리 번호
        'depth'			                => '1',			// 뎁스
        'mall_no'                       => '',          // 상점 번호
        'display_yn'                    => '',          // 노출 여부
        'delete_yn'                     => 'n',         // 삭제 여부
        'mapping_key'                   => '',          // 상품 카테고리 연결 코드
        'parent_mapping_key'            => '',          // 상품 카테고리 연결 코드
    ),

    'pd_stock' => array(
        'stock_cnt'                  => '0',
        'sale_cnt'                   => '0',
        'update_admin_no'            => '0',
        'update_ymdt'                => 'now()',
        'mapping_key2'                => '',
        'safety_stock_cnt'           => '0',
        'safety_stock_sync_yn'       => 'N',
        'delivery_waiting_stock_cnt' => '0',
        'wms_yn'                     => 'N',
    ),

    'pd_mall_product_option' => array(
        'seq'                   => 0,
        'option_mapping_key'    => '',          // 옵션 맵핑키
        'product_mapping_key'   => '',          // 상품 맵핑키
        'option_no'			    => '',			// 옵션번호
        'mall_no'			    => '',			// 몰번호
        'mall_product_no'	    => '',			// 몰상품번호
        //'stock_no'			    => '',			// 재고번호
        'option_type'		    => 'PDOT0002',	// 옵션형태 단독/조합/구매자작성(PDOT0002:조합형|PDOT0003:기본옵션-옵션 미존재 상품)
        'option_name'		    => 'NULL',		// 옵셩명
        'option_value'		    => 'NULL',		// 옵션값
        'display_order'		    => '1',			// 옵션순서
        'add_price'			    => '0',			// 옵션가격
        'commission_rate'		=> '0',			// 수수료
        'sale_status_type'	    => 'POST0001',	// 옵션 재고수량에 따른 상태/판매중, 품절(POST0001 고정)
        'use_yn'			    => 'Y',			// 사용여부
        'option_management_cd'	=> 'NULL',	    // 판매자 관리 코드
        'register_ymdt'			=> 'now()',			// 등록일
        'register_admin_no'	    => '1',			// 등록자 번호
        'delete_yn'			    => 'N',			    // 삭제 여부
        'sale_cnt'			    => '0',			    // 판매수
        'sku'		        	=> 'NULL',			// SKU
        'weight'			    => 'NULL',			// kg, g, mg, oz, lb 단위 컬럼 추가?
        'purchase_price'	    => '0',			    // 매입가
        'master_yn'		 	    => 'Y',			    //
        'represent_yn'		    => 'NULL',			//
        'item_yn'			    => 'NULL',			//
    ),

    'pd_mall_product_image' => array(
        'seq'                         => 0,
        'mall_product_no'             => '0',       //몰상품번호
        'image_url'                   => '',        //이미지URL
        'origin_image_url'            => 'NULL' ,
        'main_yn'                     => 'N',        //대표이미지여부
        'display_order'               => '0',        //전시순서
        'product_image_no'            => '0',        //
        'image_id'                    => 'NULL',
        'mapping_key'                 => '',
    ),

    'pd_mall_product' => array(
        'seq'                       => 0,
        'product_no'			    => '',			// 상품번호(값 불필요)
        'mall_no'                   => '',          // 몰번호',
        'partner_no'                => '1',         // 공급사 번호
        'category_no'              => '1102571',   // 카테고리 번호
        'product_name'			    => '',			// 상품명(값 불필요)
        'product_type'			    => 'PDPT0001',	// 상품 타입(PDPT0001 고정)
        'class_type'			    => 'PDCT0001',	// 이벤트 상품 구분(PDCT0001 고정)
        'apply_status_type'			=> 'PDAS0006',	// 상품 심사 상태 타입(PDAS0006 고정)
        'sale_status_type'			=> 'PDSS0001',	// 판매 상태 타입(PDSS0001:판매 중|PDSS0004:판매 안함)
        'group_type'			    => 'PDGT0001',	// 배송 타입(PDGT0001 고정)
        'sale_method_type'			=> 'PDSM0001',	// 판매 방법 타입 (PDSM0001:사입|PDSM0002:위탁)
        'payment_means_control_yn'	=> 'N',			// 결제수단 제어 여부(Y|N)
        'payment_means'			    => 'NULL',		// 결제수단
// 결제 수단(PAYCO:페이코|CREDIT:신용카드|REALTIME_TRANSFER:실시간 계좌이체|DEPOSIT:무통장 입금|ESCROW_REALTIME_TRANSFER:실시간계좌이체-에스크로|ESCROW_VIRTUAL_ACCOUNT:가상계좌-에스크로) 입력형식 : ["PAYCO","CREDIT","REALTIME_TRANSFER"]
        'refundable_yn'			    => 'Y',			// 환불가능여부(Y|N)
        'brand_no'			        => 'NULL',		// 브랜드번호(값 불필요)
        'admin_no'			        => '1',			// 담당자 번호
        'sale_period_type'			=> 'PDSP0001',	// 판매기간 타입(PDSP0001:상시판매|PDSP0002:기간한정판매)
        'sale_start_ymdt'			=> 'NULL',		// 판매 시작일자(값 불필요)
        'sale_end_ymdt'			    => 'NULL',		// 판매 종료일자(값 불필요)
        'manufacture_ymdt'			=> 'NULL',		// 제조일자(값 불필요)
        'min_buy_cnt'			    => '0',			// 최소 구매수량
        'max_buy_person_cnt'		=> '0',			// 1인 최대 구매수량
        'max_buy_time_cnt'			=> '0',			// 1회 최대 구매수량
        'max_buy_days'			    => '0',			// 최대구매기간(일)
        'max_buy_period_cnt'		=> '0',			// 최대구매기간(수량)
        'sale_price'			    => '0',			// 판매가
        'immediate_discount_unit_type'		=> 'PDIU0002',	// 즉시할인 단위타입(정액할인 : PDIU0001 -> 20원 | 정률할인 : PDIU0002 -> 20%)
        'immediate_discount_value'			=> '0',			// 즉시할인 값
        'immediate_discount_period_yn'		=> 'N',			// 즉시할인 기간여부(Y|N)
        'immediate_discount_start_ymdt'		=> 'NULL',		// 즉시할인 시작일자(값 불필요)
        'immediate_discount_end_ymdt'		=> 'NULL',		// 즉시할인 종료일자(값 불필요)
        'comparing_price_site'		=> 'NULL',		// 가격비교 사이트 정보(값 불필요)
        'nonmember_purchase_yn'	    => 'N',			// 비회원 구매가능 여부(Y|N)
        'minor_purchase_yn'			=> 'Y',			// 미성년자 구매가능 여부(Y|N)
        'accumulation_rate'			=> '0',			// 적립금 %
        'accumulation_use_yn'		=> 'Y',			// 적립금 사용 가능 여부(Y|N)
        'place_origin_seq'			=> 'NULL',		// 원산지 일련번호(값 불필요)
        'place_origin'			    => 'NULL',		// 원산지(값 불필요)
        'place_origins_yn'			=> 'N',			// 원산지 다른 상품 함께 등록 여부(Y|N)
        'expiration_ymdt'			=> 'NULL',		// 유효일자(값 불필요)
        'value_added_tax_type'		=> 'PDVT0001',	// 부가세 타입(PDVT0001:과세|PDVT0002:비과세|PDVT0003:영세)
        'product_management_cd'		=> 'NULL',		// 판매자 관리코드(값 불필요)
        'cart_use_yn'			    => 'Y',			// 장바구니 사용 여부(Y|N)
        'cart_off_period_yn'		=> 'N',			// 장바구니 불가 기간 설정(Y|N)
        'commission_rate_type'		=> 'PDCM0001',	// 수수료율 타입(PDCM0001:상품수수료|PDCM0004|공급가입력)
        'commission_rate'			=> '0',			// 수수료
        'keyword'			        => 'NULL',		// 검색어(값 불필요)
        'extra_json'		        => 'NULL',		// 추가 정보 json 변환 필드
        'product_name_en'			=> 'NULL',		// 영문상품명(값 불필요)
        'hs_code'			        => 'NULL',		// HS 코드(값 불필요)
        'coupon_yn'			        => 'Y',			// 프로모션 - 쿠폰 적용 가능여부(Y|N)
        'additional_discount_yn'	=> 'Y',			// 프로모션 - 추가할인 적용 가능여부(Y|N)
        'promotion_text_yn'			=> 'N',			// 홍보문구 기간 사용 여부(Y|N)
        'promotion_text'			=> 'NULL',			// 홍보문구(값 불필요)
        'promotion_text_start_ymdt'	    => 'NULL',		// 홍보문구 노출 시작일(값 불필요)
        'promotion_text_end_ymdt'		=> 'NULL',		// 홍보문구 노출 종료일(값 불필요)
        'platform_display_yn'			=> 'Y',			// 플랫폼 노출 설정 여부(Y|N)
        'platform_display_pc_yn'		=> 'Y',			// 플랫폼 - PC 여부(Y|N)
        'platform_display_mobile_yn'	=> 'Y',			// 플랫폼 - 모바일 앱 여부(Y|N)
        'platform_display_mobile_web_yn'    => 'Y',		// 플랫폼 - 모바일 웹 여부(Y|N)
        'duty_info'			        => '{"contents": [{"제품 소재": "상품상세 참조"}, {"색상": "상품상세 참조"}, {"치수": "상품상세 참조"}, {"제조자": "상품상세 참조"}, {"제조국": "상품상세 참조"}, {"세탁방법 및 취급시 주의사항": "상품상세 참조"}, {"제조연월": "상품상세 참조"}, {"품질보증기준": "상품상세 참조"}, {"A/S 책임자와 전화번호": "상품상세 참조"}], "categoryNo": "1", "categoryName": "의류"}',		// 상품정보고시(값 불필요)
        'content_header'			=> 'NULL',		// 상품 상세 상단(값 불필요)
        'content'			        => ' ',		    // 상품 상세(값 불필요)
        'content_footer'			=> 'NULL',		// 상품 상세 하단(값 불필요)
        'partner_charge_amt'		=> '0',			// 파트너사 분담금
        'front_display_yn'			=> 'Y',			// 전시여부(Y|N)
        'url_direct_display_yn'		=> 'N',			// 프론트 미노출 여부(Y:url 로만 접근 가능:N)
        'delivery_yn'			    => 'Y',			// 배송여부(Y|N)
        'shipping_area_type'		=> 'SPAT0002',	// 배송 출발 지역 타입(SPAT0001:파트너물류센터출고|SPAT0002:쇼핑몰물류센터출고)
        'shipping_area_partner_no'	=> 'NULL',		// 배송 템플릿 파트너 번호(값 불필요)
        'delivery_combination_yn'	=> 'Y',			// 묶음배송 불가능 여부(Y|N)
        'delivery_international_yn'	=> 'N',			// 해외배송 여부(Y|N)
        'delivery_template_no'		=> 'NULL',		// 배송탬플릿번호(값 불필요)
        'delivery_customer_info'	=> 'NULL',		// 판매자특이사항/고객안내사항(값 불필요)
        'certification_type'		=> 'PDCE0002',	// 인증 유형(PDCE0001:인증대상|PDCE0002:인증대상아님|PDCE0003:상세페이지 별도 표기)
        'option_use_yn'			    => 'N',			// 옵션 사용 유무(Y|N)
        'add_option_image_yn'		=> 'N',			// 등록되어 있는 옵션 이미지 사용 유무(Y|N)
        'register_ymdt'			    => 'now()',			// 등록일자(값 불필요)
        'register_admin_no'			=> '1',			// 상품 등록자 번호(값 불필요)
        'update_ymdt'			    => 'now()',			// 수정일자(값 불필요)
        'update_admin_no'			=> '0',			// 상품 수정자 번호(값 불필요)
        'promotion_yn'			    => 'Y',			// 프로모션 적용 가능여부(Y|N)
        'brand_no_mapping_key'      => '',
        'mapping_key'               => '',
    ),

    'tmp_pd_mall_product_accumulate_count' => array(
        'seq'                     => 0,
        'mall_product_no'         => 'null',
        'like_cnt'                => 'null',
        'review_rate'             => 'null',
        'review_total_cnt'        => 'null',
        'product_inquiry_total_cnt' => 'null',
        'naver_review_cnt'          => 'null',
        'mapping_key'             => '',
    ),

    'tmp_pd_mall_product_input' => array(
        'mall_product_no'       => 0,        // 몰 상품 번호
        'input_text'            => '',       // 구매자작성형 텍스트
        'use_yn'                => 'Y',      // 사용여부
        'delete_yn'         => 'N',      // 삭제 여부
        'input_matching_type'   => 'PIMT0002',      // 매칭타입 (옵션별:PIMT0001 / 상품별:PIMT0002)
        'required_yn'           => 'Y',
        'mapping_key'           => '',
    ),

    'tmp_pd_mall_product_sticker_mapping'   => array(
        'mall_product_no'       => 0,        // 몰 상품 번호
        'sticker_no'            => 0,        // 스티커 번호
        'display_start_date'    => 'now()',
        'display_end_date'      => 'now()',
        'mapping_key'           => '',
    ),

    'pd_review' => array(
        'seq'                     => 0,
        'mall_no'                 => '0',
        'partner_no'              => '0',
        'order_no'                => 'null', // 주문번호
        'mall_product_no'         => 'null', // 상품번호
        'mall_option_no'          => 'null', // 옵션번호
        'product_name'            => 'null', // 상품명
        'option_name'             => 'null', // 옵션명
        'register_name'           => 'null', // 작성자 명
        'rating'                  => 'null', // 평점
        'display_status_cd'       => 'RDST0001', // 전시상태 - 전시중/블라인드 RDST0001 : DISPLAY, RDST0002 : BLIND, RDST0003 : DELETE
        'recommend_cnt'           => 'null', // 추천수
        'report_cnt'              => 'null', // 신고수
        'blind_report_cnt'        => 'null', // 블라인드 적용 신고 수
        'content'                 => 'null', // 상세내용,
        'member_id'               => 'null', // 작성자 ID 스냅샷 암호화
        'provider_type'           => 'null', //
        'register_ymdt'           => 'now()', // 등록일
        'register_no'             => 'null', // 등록자 번호
        'update_ymdt'             => 'null', // 수정일
        'update_no'               => 'null', // 수정자 번호
        'delete_yn'               => 'N', // 삭제 여부
        'attach_yn'               => 'N', // 첨부 여부(pd_attach 테이블)
        'order_product_option_no' => 'null', // 주문 옵션 번호
        'master_yn'               => 'Y', // 상품평 복사 가능 여부
        'mapping_key'             => 'null', // 후기 매핑키(pd_attach relation 활용)
        'platform_type'           => 'PFTP0001', // 작성 디바이스 PFTP0001 : PC, PFTP0002 : MOBILE_WEB, PFTP0003 : MOBILE_APP
        'extra_json'              => 'null', // 상품평 옵
        'best_review_yn'          => 'N',    // 베스트 후기 여부
        'brand_name'              => 'null', // 브랜드 명
        'partner_name'            => '',     // 파트너 명
        'member_mapping_key'      => 'null', // 회원 매핑키
        'product_mapping_key'     => 'null'  // 상품 매핑키
    ),

    'pd_attach' => array(
        'seq'           => 0,
        'target_no'     => '0', //'댓글번호',
        'attach_type'   => 'ATTP0001', // 첨부 게시판 코드 ATTP0001 : 상품평
        'url'           => 'null', // 첨부 파일 경로
        'review_mapping_key' => 'null', // 상품 후기 매핑키
        'mall_no'       => '0',
    ),

    'tmp_display_category_mapping' => array(
        'seq'                 => 0,
        'product_mapping_key' => '',
        'category_mapping_key' => '',
        'mall_no' => '',
    ),

    'tmp_mb_member' => array(
        'seq'                           => 0,
        'member_grade_no'	            =>	'0',
        'password'	                    =>	'null',
        'member_name'	                =>	'null',
        'mobile_no'	                    =>	'null',
        'mobile_no_last_digits'	        =>	'null',
        'telephone_no'	                =>	'null',
        'member_status'	                =>	'MBST0002',
        'member_type'	                =>	'MBTP0001',
        'principal_certification_yn'	=>	'N',
        'principal_certification_ymdt'	    =>	'null',
        'birthday'	                    =>	'null',
        'sex'	                        =>	'null',
        'email'	                        =>	'null',
        'zip_cd'	                    =>	'null',
        'address'	                    =>	'null',
        'detail_address'	            =>	'null',
        'jibun_address'	                =>	'null',
        'jibun_detail_address'	        =>	'null',
        'nickname'	                    =>	'null',
        'additional_info'	            =>	'null',
        'mall_no'	                    =>  '0',
        'join_type'	                    =>	'JITP0001',
        'member_id'	                    =>	'null',
        'join_ymdt'	                    =>	'null',
        'blacklist_yn'	                =>	'N',
        'last_login_ymdt'	            =>	'null',
        'last_login_ip'	                =>	'null',
        'accumulation_amt'	            =>	'null',
        'login_count'	                =>	'null',
        'push_notification_agree_yn'	=>	'N',
        'push_notification_agree_ymdt'	    =>	'null',
        'sms_agree_yn'      	        =>	'N',
        'sms_agree_ymdt'	            =>	'null',
        'direct_mail_agree_yn'	        =>	'N',
        'direct_mail_agree_ymdt'	    =>	'null',
        'admin_comment'	                =>	'null',
        'refund_bank'	                =>	'null',
        'refund_bank_account'	        =>	'null',
        'refund_bank_depositor_name'	=>	'null',
        'member_ci'	                    =>	'null',
        'mapping_key'	                =>	'null',
        'last_grade_update_ymdt'	    =>	'null',
        'last_password_change_ymdt'	    =>	'null',
        'country_cd'	                =>	'KR',
        'adult_certificated_yn'	        =>	'N',
        'adult_certificated_ymdt'	    =>	'null',
        'country_calling_code'	        =>	'82',
        'provider_type'	                =>	'null',
        'password_change_required_yn'	=>	'N',
        'linked_yn'	                    =>	'N',
        'link_ymdt'	                    =>	'null',
        'last_update_ymdt'	            =>	'null',
        'grade_mapping_key'             =>  'null',
        'group_mapping_key'             =>  'null',
    ),

    'tmp_mb_accumulation' => array(
        'seq'                           => 0,
        mall_no                         => '',
        member_no                       => '',
        accumulation_type               => 'null',
        register_ymdt                   => 'now()',
        expire_ymdt                     => 'null',
        accumulation_reason             => 'ACRR0001',
        accumulation_status             => 'ACST0001',
        accumulation_amt                => 'null',
        reason_detail                   => 'null',
        order_no                        => 'null',
        review_no                       => 'null',
        accumulation_rest_amt           => 'null',
        total_available_amt             => 'null',
        register_admin_no               => 'null',
        mapping_key                     => 'null',
        product_display_name            => 'null',
        accumulation_payment_request_no => 'null',
        start_ymdt                      => 'now()',
    ),

    'tmp_mb_member_grade' => array(
        'member_grade_no'                       => 0,
        'member_grade_name'                     => '',
        'accumulation_rate'                     => '0',
        'member_grade_accumulation_use_yn'      => 'N',
        'accumulation_automatic_payment_use_yn' => 'N',
        'use_yn'                                => 'Y',
        'advance_min_order_cnt'                 => '0',
        'advance_min_order_amt'                 => '0',
        'grade'                                 => '0',
        'mall_no'                               => 'null',
        'mapping_key'                           => 'null',
    ),

    'tmp_mb_member_group' => array(
        'member_group_name'                 => '',
        'accumulation_rate'                 => '0',
        'member_group_accumulation_use_yn'  => 'N',
        'benefit_use_yn'                    => 'null',
        'mall_no'                           => 'null',
        'sequence'                          => '0',
        'mapping_key'                       => 'null',
    ),

    'tmp_mb_member_provider' => array(
        'seq'                => 0,
        'member_no'          => '0',
        'oauth_id'           => '',
        'provider_type'      => 'naver',
        'mall_no'            => 'null',
        'delete_yn'          => 'N',
        'register_ymdt'      => 'now()',
        'mapping_key'        => 'null',
    ),

    'tmp_od_address' => array(
        'seq'                       =>                       0,
        'member_no'                 =>                       '0',
        'address_name'              =>                       'null',
        'default_yn'                =>                       'N',
        'receiver_zip_cd'           =>                       '',
        'receiver_address'          =>                       '',
        'receiver_jibun_address'    =>                       'null',
        'receiver_detail_address'   =>                       'null',
        'receiver_name'             =>                       '',
        'receiver_contact1'         =>                       '',
        'receiver_contact2'         =>                       'null',
        'register_ymdt'             =>                       'now()',
        'country_cd'                =>                       'KR',
        'address_type'              =>                       'ADTP0002',
        'mapping_key'               =>                       'null',
        'mall_no'                   =>                       'null',
    ),

    'mb_member_mapping_key' => array(
        'old_member_no'     => '',
        'old_member_id'     => '',
        'mapping_key'       => '',
        'mall_no'           => '',
    ),

    'pd_product_mapping_key' => array(
        'old_product_no'          => '',
        'old_product_cd'          => '',
        'old_product_name'        => '',
        'mapping_key'             => '',
        'mall_no'                 => '',
    ),

    'tmp_bd_board' => array(
        'seq'                   => 0,
        'board_name'            => '',
        'board_description'     => 'null',
        'use_category_yn'       => 'Y',
        'use_attach_file_yn'    => 'Y',
        'mall_no'               => '0',
        'sequence'              => '1',
        'board_delete_yn'       => 'N',
        'use_article_image_yn'  => 'N',
        'member_write_yn'       => 'Y',
        'guest_write_yn'        => 'N',
        'secret_yn'             => 'Y',
        'reply_yn'              => 'Y',
        'mapping_key'           => '',
    ),

    'tmp_bd_board_article' => array(
        'register_ymdt'             => '',                  // 작성일시
        'article_title'             => 'null',              // 제목
        'opening_yn'                => 'Y',                 // 노출여부
        'read_count'                => 0,                   // 조회수
        'board_no'                  => 0,                   // 게시판 일련번호
        'board_category_no'         => 'null',              // 게시글 카테고리 일련번호
        'article_content'           => 'null',              // 상세 설명
        'write_admin_no'            => 'null',                   // 작성 관리자 일련번호
        'parent_board_article_no'   => 'null',                   // 부모글 일련번호(원글인 경우 null)
        'modify_admin_no'           => 0,                   // 수정한 운영자 번호
        'modify_ymdt'               => 'null',              // 수정일시
        'article_delete_yn'         => 'N',                 // 삭제 여부
        'searchable_article_content'  => 'null',            // 검색 대상 내용(content 내용 중 html 태그를 제외한 내용
        'article_image_url'         => 'null',              // 게시글 사진 url
        'deep'                      => 0,                   // 계층
        'password'                  => 'null',              // 비밀번호
        'member_no'                 => 'null',                   // 작성자 일련번호
        'secreted'                  => 'N',                 // 비밀글 여부
        'attach_image_urls'         => 'null',              // 첨부 이미지 URL(json)
        'reply_count'               => '0',                 // 답글 수
        'notice_yn'                 => 'N',                 // 공지 여부
        'order_fixed_ymdt'          => 'null',              // 순서 고정 일시(공지로 설정한 날짜)
        'writer_name'               => 'null',              // 작성자 이름
        'writer_type'               => 'WRTY0001',          // 작성자 유형(회원: WRTY0001, 운영자: WRTY0002, 비회원: WRTY0003)
        'modify_member_no'          => 'null',              // 수정자 일련번호
        'editor_name'               => 'null',              // 수정자 이름
        'editor_type'               => 'WRTY0001',          // 수정자 유형(회원: WRTY0001, 운영자: WRTY0002, 비회원: WRTY0003)
        'board_category_mapping_key'  => 'null',
        'board_mapping_key'         => 'null',
        'member_mapping_key'        => 'null',
        'parent_mapping_key'        => 'null',
        'mapping_key'               => 'null',
    ),

    'tmp_bd_board_category'     => array(
        'category_name'             => '',                  // 카테고리 명
        'board_no'                  => 0,                   // 게시글 일련번호
        'board_mapping_key'         => 'null',
        'mapping_key'               => 'null',
    ),

    'tmp_bd_board_attach_file'     => array(
        'seq'                   => 0,
        'original_file_name'    => '',                      // 기존 파일명
        'register_ymdt'         => 'null',                  // 등록일
        'board_article_no'      => 0,                       // 작성자 번호
        'uploaded_file_name'    => 'null',                  // 서버 업로드 파일명
        'notice_no'             => 'null',                  // 미사용 필드
        'mapping_key'           => '',                      //
    ),

    'tmp_pd_inquiry'     => array(
        'seq'             => 0,
        'parent_no'       => 0,  // 부모번호
        'title'           => '',  // 제목
        'content'         => '',  // 상세설명
        'member_id'       => '',  // 작성자 ID
        'provider_type'   => 'null',  //
        'mall_no'         => '',  // mall_no
        'partner_no'      => 0,
        'mall_product_no' => '',  // 상품 일련번호
        'inquiry_cd'      => 'PITP0001', //문의유형 - PITP0001 상품/PITP0002 배송/ PITP0007 취소/ PITP0003 반품/PITP0004 교환/PITP0005 환불/PITP0006 기타
        'product_name'    => '', // 상품명
        'register_name'   => '', // 작성자명
        'secret_yn'       => 'N', // 비밀여부
        'admin_yn'        => 'N', // 어드민여부
        'reply_yn'        => 'N', // 답변완료여부
        'reply_ymdt'      => 'null', // 답변완료날짜
        'delete_yn'       => 'N', // 삭제여부
        'order_no'        => 'null', // 주문번호
        'register_ymdt'   => 'now()', // 작성일
        'register_no'     => 'null', // 작성자 일련번호
        'update_ymdt'     => 'now()', // 수정일
        'update_no'       => 'null', // 수정자 일련번호
        'mapping_key'     => '',
        'parent_mapping_key'   => '', // 부모글 일련번호
        'member_mapping_key'   => '', // 회원 매핑키
        'product_mapping_key'   => '', // 상품 매핑키
        'email'           => '',  // 이메일
    ),

    'tmp_cs_inquiry'    => array(
        'seq'                   => 0,          // 일련번호
        'mall_no'               => '',         // shopNo
        'register_ymdt'         => 'now()',    // 등록일
        'member_no'             => 0,          // 회원 일련번호
        'admin_no'              => 0,          // 관리자 일련번호
        'inquiry_status'        => 'IQST0001', // 문의 처리 상태 - IQST0001 문의 접수/ IQST0002 답변완료 / IQST0003 진행중
        'inquiry_type_no'       => 0,          // 문의 타입 번호
        'inquiry_title'         => '',         // 제목
        'inquiry_content'       => '',         // 내용
        'product_no'            => 0,          // 상품번호
        'order_no'              => '',         // 주문번호
        'inquiry_delete_yn'     => 'N',        // 삭제 여부
        'answer_sms_send_yn'    => 'N',        // SMS 전송 여부
        'answer_email_send_yn'  => 'N',        // 이메일 전송 여부
        'member_email'          => '',         // 작성자 이메일 주소
        'mapping_key'           => '',         // 매핑키
        'member_mapping_key'    => '',         // 회원 매핑키
        'product_mapping_key'   => '',         // 상품 매핑키
        'type_mapping_key'      => '',         // 유형 매핑키
        'external_mapping_key'  => '',
        'admin_name'            => '',         // 관리자 이름
        'member_id'             => '',         // 작성자 아이디
    ),

    'tmp_cs_inquiry_answer'    => array(
        'seq'                   => 0,           // 일련번호
        'register_ymdt'         => 'now()',     // 답변일
        'answer_content'        => '',          // 답변내용
        'sms_mobile_no'         => '',          // 답변자 연락처
        'email'                 => 'NULL',      // 답변자 이메일
        'inquiry_no'            => 0,           // 원글 FK
        'mall_no'               => 0,           // 상점번호
        'sms_send_yn'           => 'N',         // SMS 발송여부
        'email_send_yn'         => 'N',         // 이메일 발송여부
        'answer_complete_yn'    => 'Y',         // 답변완료 여부
        'sms_send_success_yn'   => 'N',         // SMS 발송 성공 여부
        'email_send_success_yn' => 'N',         // 이메일 발송 성공 여부
        'external_mapping_key'  => '',
        'mapping_key'           => '',          // 원글 매핑키
    ),

    'tmp_cs_inquiry_attach_file' => array(
        'seq'                   => 0,
        'original_file_name'    => 'NULL',      // 기존 파일명
        'register_ymdt'         => 'now()',     // 등록일
        'inquiry_no'            => 0,           // 원글 일련번호
        'mall_no'               => 0,           // 상점번호
        'uploaded_file_name'    => 'NULL',      // 업로드 파일명
        'mapping_key'           => '',          // 원글 매핑키
    ),

    'tmp_cs_inquiry_type' => array(
        'seq'                       => 0,       // 일련번호
        'inquiry_type_name'         => '',      // 유형명
        'inquiry_type_description'  => '',      // 유형설명
        'mall_no'                   => 0,       // 상점 번호
        'sequence'                  => 1,       // 노출 순서
        'inquiry_type_delete_yn'    => 'N',     // 삭제 여부
        'inquiry_type_channel'      => 'IQTT0001',  // 유입채널 - IQTT0001 NCP 인입, IQTT0002 네이버 인입
        'type_mapping_key'          => '',
    ),

    'tmp_comm_partner' => array(
        'seq'                                      => 0,
        'partner_name'                             => 'null',             // 파트너이름
        'business_registration_no'                 => 'null',             // 사업자 등록 번호
        'partner_status'                           => 'PTST0003',         // 파트너상태 - 등록대기 : PTST0001, 검토중 : PTST0002, 등록완료 : PTST0003
        'country_cd'                               => 'KR',               // 국가 코드
        'company_name'                             => '',                 // 파트너사명
        'register_ymdt'                            => 'now()',            // 등록일
        'register_admin_no'                        => 0,                  // 등록 관리자
        'seller_taxation_type'                     => 'SLTT0001',         // 과세형태 - SLTT0001 : 일반과세자, SLTT0002 : 간이과세자, SLTT0003 : 부가세 면세 사업자, SLTT0004 : 법인사업자, SLTT0005 : 면세법인사업자, SLTT0006 : 기타
        'representative_name'                      => '',                 // 대표자명
        'business_condition'                       => 'null',             // 업태
        'business_type'                            => 'null',             // 업종
        'represent_phone_no'                       => 'null',             // 대표전화번호
        'fax_no'                                   => 'null',             // 팩스번호
        'represent_email'                          => 'null',             // 대표자이메일
        'online_marketing_business_declaration_no' => 'null',             // 통신판매업신고번호
        'office_zip_cd'                            => 'null',             // 사업장 우편번호
        'office_address'                           => 'null',             // 사업장 주소
        'office_detail_address'                    => 'null',             // 사업장 상세주소
        'office_jibun_address'                     => 'null',             // 사업장 지번주소
        'office_jibun_detail_address'              => 'null',             // 사업장 지번 상세주소
        'office_city'                              => 'null',             // 사업장 주소 도시명
        'office_state_or_region'                   => 'null',             // 사업장 주소 '주'이름
        'delivery_international_yn'                => 'N',                // 해외배송 여부
        'sample_url'                               => 'null',             // 샘플URL
        'privacy_manager_name'                     => 'null',             // 개인정보 관리 책임자 이름
        'privacy_manager_phone_no'                 => 'null',             // 개인정보 관리 책임자 연락처
        'manager_name'                             => 'null',             // 담당자 이름
        'manager_job_duty'                         => 'null',             // 담당자 직급
        'manager_department'                       => 'null',             // 담당자 부서
        'manager_job_position'                     => 'null',             // 담당자 직책
        'manager_phone_no'                         => 'null',             // 담당자 연락처
        'manager_email'                            => 'null',             // 담당자 이메일
        'trade_bank'                               => 'null',             // 거래은행코드
        'trade_bank_name'                          => '',                 // 은행이름
        'trade_bank_account'                       => '',                 // 계좌번호
        'trade_bank_depositor_name'                => '',                 // 계좌주 이름
        /* // 해외 사용 코드
        'swift_code'                               => 'null',
        'aba_routing_no'                           => 'null',
        'iban_code'                                => 'null',
        'bsb_code'                                 => 'null',
        */
        'commission_bill_issue_type'               => 'CBIT0002',         // 수수료 계산서 발급 방식 - CBIT0001 : 자동발급, CBIT0002 : 수동발급
        'buying_bill_possible_yn'                  => 'N',                // 매입 계산서 가능여부
        'permitted_ip_address'                     => 'null',             // 허용IP 주소
        'partner_type'                             => 'PTTP0001',         // 파트너 유형 : 마이그레이션시 강제 'PTTP0001' 적용
        'service_no'                               => 0,                // 서비스 번호 : 기본 '0'
        'settlement_manager_name'                  => 'null',             // 정산 담당자 이름
        'settlement_manager_phone_no'              => 'null',             // 정산 담당자 연락처
        'settlement_manager_email'                 => 'null',             // 정산 담당자 이메일
        'product_registered_yn'                    => 'N',                // 상품 등록 여부
        'mapping_key'                              => '',                 // 매핑키
    ),

    'tmp_comm_admin' => array(
        'seq'                         => 0,                 // 일련번호
        'admin_id'                    => '',                // 관리자 아이디
        'admin_password'              => '',                // 비밀번호
        'admin_name'                  => '',                // 관리자 이름
        'admin_type'                  => 'ADTP0003',        // 관리자 타입 - ADTP0003 '파트너 관리자'
        'admin_role'                  => 'ARTP0002',        // 롤(?) - ARTP0001 : 마스터, ARTP0002 : 일반
        'admin_status'                => 'ADST0003',        // ADST0001 : 등록대기, ADST0002 : 검토중, ADST0003 : 등록완료, ADST0004 : 삭제, ADST0005 : 로그인잠김, ADST0006 : 휴면
        'phone_no'                    => 'null',            // 연락처
        'mobile_no'                   => 'null',            // 핸드폰
        'email'                       => 'null',            // 이메일
        'job_position_name'           => 'null',            // 직급
        'job_duty_no'                 => 'null',            // 부서코드
        'job_duty_name'               => 'null',            // 부서명
        'service_no'                  => 'null',                 // 서비스 일련번호
        'partner_no'                  => 'null',            // 파트너 일련번호
        'external_access_yn'          => 'N',               // 외부 접속 가능 여부
        'department_no'               => 'null',            // 부서번호
        'department_name'             => 'null',            // 부서명
        'register_ymdt'               => 'now()',           // 등록일
        'register_admin_no'           => 0,                 // 등록 관리자
        'language'                    => 'KR',              // 언어코드
        'time_zone'                   => 'KR',              // 국가코드
        'last_login_ymdt'             => 'null',            // 최종로그인일시
        'last_name'                   => 'null',            // 성
        'first_name'                  => 'null',            // 이름
        'authority_group_update_ymdt' => 'null',            //
        'password_update_ymdt'        => 'now()',           // 비밀번호 수정 일시
        //'oauth_id_no'               => 'null',            // 미사용
        'mapping_key'                 => 'null',            // 매핑키
        'partner_mapping_key'         => 'null',            // 파트너 매핑키
    ),

    'tmp_comm_mall_partner_contract' => array(
        'seq'                             => 0,                     // 임시 일련번호
        'mall_no'                         => 0,                     // 상점 번호
        'partner_no'                      => 0,                     // 파트너사 일련번호
        'charge_md_no'                    => 'null',                // 담당 관리자MD 일련번호
        'contract_type'                   => 'MPCT0002',            // 계약 형태 - MPCT0001 : 전자계약, MPCT0002 : 수기계약
        //'contract_period'               => 'null',                // 계약 기간(사용안함)
        'contract_status'                 => 'MPCS0003',            // 계약상태 - MPCS0001 : 거래대기, MPCS0002 : 검토중, MPCS0003 : 거래중
        'commission_rate'                 => 0,                     // 수수료율
        'default_commission_rate_use_yn'  => 'N',                   // 기본 수수료율 사용 여부
        'promotion_agree_yn'              => 'Y',                   // 프로모션 동의 여부
        'register_ymdt'                   => 'now()',               // 등록일
        'start_ymdt'                      => 'now()',               // 시작일시
        'register_admin_no'               => 0,                     // 등록 관리자
        'memo'                            => 'null',                // 메모
        'standing_point_contract_used_yn' => 'N',                   // 입점 계약서 사용 여부
        'partner_mapping_key'             => '',                    // 파트너사 매핑키
    ),

    'tmp_od_delivery_area_fee' => array(
        'seq'             => 0,                                     // 일련번호
        'area_fee_no'     => 0,                                     // 추가 배송비 일련번호
        'area_fee_name'   => '0',                                   // 추가배송비명
        'partner_no'      => 0,                                     // 파트너사 번호
        'register_ymdt'   => 'now()',                                 // 등록일
        'country_cd'      => 'KR',                                  // 국가 코드
        'admin_no'        => 0,                                     // 관리자 일련번호
        'delete_yn'       => 'N',                                   // 삭제 여부
        'mapping_key'     => '',                                    // 매핑키
        'partner_mapping_key'   => '',                              // 파트너사 매핑키
        'update_ymdt'     => 'null',                                // 수정일
        'update_admin_no' => 0,                                     // 업데이트 관리자
    ),

    'tmp_od_delivery_area_fee_detail' => array(
        'seq'                             => 0,     // 일련번호
        'delivery_area_fee_detail_seq'    => 0,
        'area_fee_no'                     => 0,     //지역별 추가배송비 번호
        'area_no'                         => 0,     //배송비 추가로 받고 싶은 지역
        'extra_delivery_amt'              => 0,     //추가 배송비
        'partner_no'                      => 0,     //파트너번호
        'mapping_key'                     => '',    // 지역별 추가배송비 매핑키
        'partner_mapping_key'             => '',    // 파트너사 매핑키
    ),

    'tmp_od_delivery_template_group' => array(
        'seq'                        => 0,
        'delivery_template_group_no' => 0,    //배송비템플릿 그룹번호
        'partner_no'                 => 0,    //파트너 번호
        'group_delivery_amt_type'    => 'GDAT0001',   //그룹 배송비조건 산출방식
        'template_group_name'        => '',   // 템플릿 그룹명
        'display_no'                 => 0,
        'default_yn'                 => 'N',  //기본 그룹 여부
        'delete_yn'                  => 'N',  //삭제 여부,
        'area_fee_no'                => 0,    //지역별 추가배송비 일련번호
        'delivery_template_type'     => 'DETE0001',   // 배송비 템플릿 타입
        'delivery_amt_in_advance_yn' => 'Y',  //선/착불 여부
        'mapping_key'                => '',   // 템플릿 그룹 매핑키
        'partner_mapping_key'        => '',   // 파트너사 매핑키
        'area_fee_mapping_key'       => '',   // 지역별 추가 배송비 매핑키
        'register_admin_no'          => '',   // 등록 관리자
        'register_ymdt'              => 'now()',  // 등록일
        'update_ymdt'                => 'null',   // 수정일
        'update_admin_no'            => 0,        // 수정 관리자
    ),

    'tmp_od_warehouse' => array(
        'seq'                          => 0,
        'warehouse_no'                 => 0,    // 출고,반품지 번호
        'warehouse_name'               => '',   // 출고,반품지 명
        'partner_no'                   => 0,    // 파트너 일련번호
        'default_release_warehouse_yn' => 'N',  // 대표 출고지 여부
        'default_return_warehouse_yn'  => 'N',  // 대표 반품/교환지 여부
        'address'                      => '',   // 주소
        'zip_cd'                       => '',   // 우편번호
        'oversea_address1'             => 'null',   // 해외 주소
        'oversea_address2'             => 'null',   // 해외 주소2
        'oversea_city'                 => 'null',   // 해외 주소 도시
        'oversea_region'               => 'null',   // 해외 주소 지방
        'detail_address'               => '',       // 상세 주소
        'delete_yn'                    => 'N',      // 삭제여부
        'country_cd'                   => 'KR',     // 국가코드
        'warehouse_address_type'       => 'WHNT0001', // 창고국가 구분 WHNT0001(ADDRESS, 배송지 주소 한국형 노출) | WHNT0002(SUBSTITUTION, 배송지 주소 해외형 노출)
        'mapping_key'                  => '',       // 매핑키
        'partner_mapping_key'          => '',       // 파트너사 매핑키
        'register_admin_no'            => 0,      // 등록 관리자 일련번호
        'register_ymdt'                => 'now()',  // 등록일시
        'update_ymdt'                  => 'null',
        'update_admin_no'              => 0,
        'contact'                      => 'null',
    ),

    'tmp_od_delivery_template' => array(
        'seq'                        => 0,
        'delivery_template_no'       => 0, //배송템플릿 일련번호
        'delivery_template_group_no' => 0,      // 템플릿 그룹 일련번호
        'partner_no'                 => 0,      // 파트너사 일련번호
        'template_name'              => '',     // 템플릿 명
        'delivery_template_type'     => 'DETE0001', // 배송비유형 DETE0001(SINGLE, 단일형) | DETE0002(MULTIPLE, 선택형)
        'release_warehouse_no'       => 0,      // 출고/창고지 일련번호(창고지 참조)
        'return_warehouse_no'        => 0,      // 교환/반품지 일련번호(창고지 참조)
        'default_yn'                 => 'N',    // 기본 배송비 표기 여부
        'delete_yn'                  => 'N',    // 삭제 여부
        'mapping_key'                => '',     // 템플릿 매핑키
        'partner_mapping_key'        => '',     // 파트너사 매핑키
        'template_group_mapping_key' => '',     // 템플릿그룸 매핑키
        'rel_warehouse_mapping_key'  => '',     // 출고/창고지 매핑키
        'ret_warehouse_mapping_key'  => '',     // 교환/반품지 매핑키
        'register_admin_no'          => 0,      // 등록관리자
        'register_ymdt'              => 'now()',    // 등록일
        'update_ymdt'                => 'null',     // 수정일
        'update_admin_no'            => 0,          // 수정 관리자
    ),

    'tmp_od_delivery_condition' => array(
        'seq'                                => 0,
        'delivery_template_no'               => 0,      // 배송비탬플릿번호
        'shipping_method_type'               => 'null', // 배송서비스 - 미국몰 전용
        'delivery_countries'                 => '[{"areaFeeNo": 0, "countryCd": "BE"}, {"areaFeeNo": 0, "countryCd": "FR"}, {"areaFeeNo": 0, "countryCd": "DE"}, {"areaFeeNo": 0, "countryCd": "IE"}, {"areaFeeNo": 0, "countryCd": "IT"}, {"areaFeeNo": 0, "countryCd": "LU"}, {"areaFeeNo": 0, "countryCd": "NL"}, {"areaFeeNo": 0, "countryCd": "GB"}, {"areaFeeNo": 0, "countryCd": "G2"}, {"areaFeeNo": 0, "countryCd": "G4"}, {"areaFeeNo": 0, "countryCd": "SM"}, {"areaFeeNo": 0, "countryCd": "GB"}, {"areaFeeNo": 0, "countryCd": "AX"}, {"areaFeeNo": 0, "countryCd": "AT"}, {"areaFeeNo": 0, "countryCd": "AD"}, {"areaFeeNo": 0, "countryCd": "DK"}, {"areaFeeNo": 0, "countryCd": "GL"}, {"areaFeeNo": 0, "countryCd": "GR"}, {"areaFeeNo": 0, "countryCd": "GG"}, {"areaFeeNo": 0, "countryCd": "IS"}, {"areaFeeNo": 0, "countryCd": "JE"}, {"areaFeeNo": 0, "countryCd": "LI"}, {"areaFeeNo": 0, "countryCd": "NO"}, {"areaFeeNo": 0, "countryCd": "PT"}, {"areaFeeNo": 0, "countryCd": "P2"}, {"areaFeeNo": 0, "countryCd": "ES"}, {"areaFeeNo": 0, "countryCd": "E2"}, {"areaFeeNo": 0, "countryCd": "CH"}, {"areaFeeNo": 0, "countryCd": "AU"}, {"areaFeeNo": 0, "countryCd": "GU"}, {"areaFeeNo": 0, "countryCd": "ID"}, {"areaFeeNo": 0, "countryCd": "MO"}, {"areaFeeNo": 0, "countryCd": "MY"}, {"areaFeeNo": 0, "countryCd": "NZ"}, {"areaFeeNo": 0, "countryCd": "TH"}, {"areaFeeNo": 0, "countryCd": "VD"}, {"areaFeeNo": 0, "countryCd": "BN"}, {"areaFeeNo": 0, "countryCd": "BH"}, {"areaFeeNo": 0, "countryCd": "CY"}, {"areaFeeNo": 0, "countryCd": "EG"}, {"areaFeeNo": 0, "countryCd": "IL"}, {"areaFeeNo": 0, "countryCd": "JO"}, {"areaFeeNo": 0, "countryCd": "KW"}, {"areaFeeNo": 0, "countryCd": "LB"}, {"areaFeeNo": 0, "countryCd": "SA"}, {"areaFeeNo": 0, "countryCd": "TR"}, {"areaFeeNo": 0, "countryCd": "AE"}, {"areaFeeNo": 0, "countryCd": "YD"}, {"areaFeeNo": 0, "countryCd": "JP"}, {"areaFeeNo": 0, "countryCd": "HK"}, {"areaFeeNo": 0, "countryCd": "SG"}, {"areaFeeNo": 0, "countryCd": "TW"}]',
        'delivery_condition_type'            => 'DELI0001', // 배송비 조건 타입 (ex : 고정배송비, 무게 배송비, 수량 차등 배송비, 수량 비례 배송비)
        'delivery_amt'                       => 0,      // 배송비 (고정배송비, 수량비례 배송비에 해당)
        'return_delivery_amt'                => 0,       // 반품배송비
        'partner_no'                         => 0,       // 파트너 번호
        'above_delivery_amt'                 => 0,       // 조건배송비 값 (5000인 경우 5000원 이상 구매시 배송비 무료)
        'per_order_cnt'                      => 0,       // 수량 비례 배송비 관련 값 (2이면 2개당 배송비 5,000원)
        'register_admin_no'                  => 0,       // 등록어드민번호
        'register_ymdt'                      => 'now()', // 등록일시
        'delivery_type'                      => 'DLTP0001',   // 택배 구분 (소포, 화물 직접배송)
        'delivery_company_type'              => 'null',       // 택배사 구분
        'delete_yn'                          => 'N',       // 삭제 여부
        'front_display_text'                 => '',       // 프론트노출문구
        'remote_area_fee_condition_check_yn' => 'N',      // 지역별추가배송비무료조건체크여부
        'mapping_key'                        => '',       // 매핑키
        'partner_mapping_key'                => '',       // 파트너사 매핑키
        'update_ymdt'                        => 'null',   // 수정일
        'update_admin_no'                    => 'null',   // 수정 관리자
        'delivery_fee_range_json'            => 'null',
    ),
);
