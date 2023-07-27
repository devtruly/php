<?php
    $tableCreateQuery = array(
        'pd_display_category' => "create table pd_display_category
            (
                display_category_no        int auto_increment comment '전시 카테고리 번호'
                    primary key,
                display_category_name      varchar(100) not null comment '전시 카테고리명',
                icon                       varchar(500) null comment 'icon URI',
                top_image_content          text         null comment '상단 이미지',
                display_order              int          not null comment '전시 순서',
                parent_display_category_no int          null comment '부모 전시 카테고리 번호',
                depth                      int(1)       not null,
                mall_no                    int          not null comment '몰 번호',
                display_yn                 char         null,
                delete_yn                  char         null,
                mapping_key                varchar(100) null,
                parent_mapping_key         varchar(100) null
            )   comment '전시카테고리' charset = utf8;
        ",

        'pd_product_mapping_key' => "create table pd_product_mapping_key
            (
                old_product_no          int                         null,
                old_product_cd          varchar(300)                null,
                old_product_name        varchar(300)                null,    
                mapping_key             varchar(100)                not null,
                mall_no                 int                         null
            )   comment '상품 매핑키 생성 정보' charset = utf8;
        ",

        'tmp_pd_display_category' => "create temporary table tmp_pd_display_category
            (
                display_category_no        int auto_increment comment '전시 카테고리 번호'
                    primary key,
                display_category_name      varchar(100) not null comment '전시 카테고리명',
                icon                       varchar(500) null comment 'icon URI',
                top_image_content          text         null comment '상단 이미지',
                display_order              int          not null comment '전시 순서',
                parent_display_category_no int          null comment '부모 전시 카테고리 번호',
                depth                      int(1)       not null,
                mall_no                    int          not null comment '몰 번호',
                display_yn                 char         null,
                delete_yn                  char         null,
                mapping_key                varchar(100) null,
                parent_mapping_key         varchar(100) null
            )   comment '전시카테고리' charset = utf8;
            
            create index tpdc_mapping1 on tmp_pd_display_category(mapping_key);
            create index tpdc_mapping2 on tmp_pd_display_category(parent_mapping_key);            
            create index tpdc_mapping3 on tmp_pd_display_category(mall_no);
        ",

        'tmp_display_category_mapping' => "create temporary table tmp_display_category_mapping(
                seq                        int auto_increment comment '일련번호' primary key,
                product_mapping_key varchar(100),
                category_mapping_key varchar(100),
                mall_no int not null
            ) charset = utf8;
            
            create index tdcm_mapping1 on tmp_display_category_mapping(product_mapping_key);
            create index tdcm_mapping2 on tmp_display_category_mapping(category_mapping_key);            
            create index tdcm_mapping3 on tmp_display_category_mapping(mall_no);
        ",

        'pd_display_brand' => "create table pd_display_brand
            (
                display_brand_no    int auto_increment
                primary key,
                brand_usage_yn      char                               null,
                brand_name_ko varchar(200),
                brand_name varchar(200),
                brand_name_type char(8),
                status_type char(8),
                brand_no            int                                null,
                mall_no             int                                not null,
                register_ymdt       datetime default CURRENT_TIMESTAMP not null,
                mapping_key         varchar(100)                       null
            ) comment '임시브랜드' charset = utf8;
        ",

        'tmp_pd_brand' => "create temporary table tmp_pd_brand
            (
                display_brand_no    int auto_increment
                primary key,
                brand_name_ko varchar(200),
                brand_name varchar(200),
                brand_name_en varchar(200),
                brand_name_type char(8),
                status_type char(8),
                mall_no             int                                not null,
                register_ymdt       datetime default CURRENT_TIMESTAMP not null,
                mapping_key         varchar(100)                       null
            ) comment '임시브랜드' charset = utf8;
            
            create index tpb_mapping1 on tmp_pd_brand(mapping_key);
            create index tpb_mapping2 on tmp_pd_brand(mall_no);
        ",

        'pd_stock' => "create table pd_stock
                (
                    stock_no                   int auto_increment comment '재고번호'
                        primary key,
                    stock_cnt                  int           null,
                    sale_cnt                   int           null,
                    update_admin_no            int default 0 null,
                    update_ymdt                datetime      null,
                    mapping_key                decimal(32)   null,
                    safety_stock_cnt           int           null,
                    safety_stock_sync_yn       char          null,
                    delivery_waiting_stock_cnt int           null,
                    wms_mapping_stock_cnt      int           null,
                    wms_yn                     char          null,
                    mapping_key2               varchar(100)  null
                ) comment '재고' charset = utf8;
        ",

        'pd_mall_product_option' => "create table pd_mall_product_option
            (
                mall_option_no       int auto_increment comment '몰상품 옵션번호'
                    primary key,
                option_mapping_key   varchar(100),
                product_mapping_key  varchar(100),
                option_no            int                                not null comment '옵션번호',
                mall_no              int                                not null,
                mall_product_no      int                                null comment '몰상품번호',
                stock_no             int                                not null comment '재고번호',
                option_type          char(8)                            not null comment '옵션형태 단독/조합/구매자작성',
                option_name          varchar(129)                       not null,
                option_value         varchar(500)                       not null comment '옵션값',
                display_order        int                                null comment '옵션 순서',
                add_price            decimal(15, 2)                     null comment '옵션가격',
                commission_rate      decimal(5, 2)                      null comment '수수료',
                sale_status_type     char(8)                            null comment '옵션 재고수량에 따른 상태/판매중, 품절',
                use_yn               char                               not null comment '사용여부',
                option_management_cd varchar(60)                        null comment '판매자 관리코드',
                register_ymdt        datetime default CURRENT_TIMESTAMP null comment '등록일',
                register_admin_no    int                                null comment '등록자 번호',
                update_ymdt          datetime                           null comment '수정일',
                update_admin_no      int                                null comment '수정자 번호',
                delete_yn            char                               null comment '삭제여부',
                sale_cnt             int                                null comment '판매수',
                sku                  varchar(100)                       null comment 'sku',
                weight               decimal(10, 3)                     null comment 'kg, g, mg, oz, lb 단위 컬럼 추가?',
                purchase_price       decimal(15, 2)                     null comment '매입가',
                master_yn            char     default 'Y'               null,
                represent_yn         char                               null,
                mapping_key          varchar(100)                       null,
                item_yn              char                               null
            ) comment '몰 상품 옵션' charset = utf8;
        ",

        'pd_mall_product_image' => "create table pd_mall_product_image
            (
                mall_image_no    int auto_increment comment '몰상품이미지번호'
                    primary key,
                mall_product_no  int          not null comment '몰상품번호',
                image_url        varchar(500) null comment '이미지URL',
                origin_image_url varchar(500) null,
                main_yn          char         not null comment '대표이미지여부',
                display_order    int          not null comment '전시순서',
                product_image_no int          null,
                image_id         varchar(100) null,
                mapping_key      varchar(100) null
            ) comment '몰 상품 이미지' charset = utf8;
        ",

        'tmp_product_image' => "create temporary table tmp_product_image
            (
                seq              int auto_increment comment '일련번호' primary key,
                mall_product_no  int          not null comment '몰상품번호',
                image_url        varchar(500) null comment '이미지URL',
                origin_image_url varchar(500) null,
                main_yn          char         not null comment '대표이미지여부',
                display_order    int          not null comment '전시순서',
                product_image_no int          null,
                image_id         varchar(100) null,
                mapping_key      varchar(100) null
            ) comment '몰 상품 이미지' charset = utf8;
            
            create index tpi_mapping1 on tmp_product_image(mapping_key);
            create index tpi_mapping2 on tmp_product_image(mall_product_no);
        ",

        'tmp_option' => "create temporary table tmp_option
                (
                    seq                  int auto_increment comment '일련번호' primary key,
                    option_mapping_key   varchar(100),
                    product_mapping_key  varchar(100),
                    option_no            int                                not null comment '옵션번호',
                    mall_no              int                                not null,
                    mall_product_no      int                                null comment '몰상품번호',
                    option_type          char(8)                            not null comment '옵션형태 단독/조합/구매자작성',
                    option_name          varchar(129)                       not null,
                    option_value         varchar(500)                       not null comment '옵션값',
                    display_order        int                                null comment '옵션 순서',
                    add_price            decimal(15, 2)                     null comment '옵션가격',
                    commission_rate      decimal(5, 2)                      null comment '수수료',
                    sale_status_type     char(8)                            null comment '옵션 재고수량에 따른 상태/판매중, 품절',
                    use_yn               char                               not null comment '사용여부',
                    option_management_cd varchar(60)                        null comment '판매자 관리코드',
                    register_ymdt        datetime default CURRENT_TIMESTAMP null comment '등록일',
                    register_admin_no    int                                null comment '등록자 번호',
                    update_ymdt          datetime                           null comment '수정일',
                    update_admin_no      int                                null comment '수정자 번호',
                    delete_yn            char                               null comment '삭제여부',
                    sale_cnt             int                                null comment '판매수',
                    sku                  varchar(100)                       null comment 'sku',
                    weight               decimal(10, 3)                     null comment 'kg, g, mg, oz, lb 단위 컬럼 추가?',
                    purchase_price       decimal(15, 2)                     null comment '매입가',
                    master_yn            char     default 'Y'               null,
                    represent_yn         char                               null,
                    item_yn              char                               null
                ) comment '몰 상품 옵션 임시테이블' charset = utf8;
                
                create index to_mapping1 on tmp_option(option_mapping_key);
                create index to_mapping2 on tmp_option(product_mapping_key);
        ",

        'tmp_pd_mall_product' => "create temporary table tmp_pd_mall_product(
                                              seq        int auto_increment comment '일련번호' primary key,
                                              product_no int NOT NULL,
                                              mall_no int not null,
                                              partner_no int (11),
                                              category_no int,
                                              product_name varchar(100),
                                              product_type char(8),
                                              class_type char(8),
                                              apply_status_type char(8),
                                              sale_status_type char(8),
                                              group_type char(8),
                                              sale_method_type char(8),
                                              payment_means_control_yn char(1),
                                              payment_means json,
                                              refundable_yn char(1),
                                              brand_no int,
                                              admin_no int,
                                              sale_period_type char(8),
                                              sale_start_ymdt datetime,
                                              sale_end_ymdt datetime,
                                              manufacture_ymdt datetime,
                                              min_buy_cnt int,
                                              max_buy_person_cnt int,
                                              max_buy_time_cnt int,
                                              max_buy_days int,
                                              max_buy_period_cnt int,
                                              sale_price decimal(15,2),
                                              immediate_discount_value decimal(15,2),
                                              immediate_discount_unit_type char(8),
                                              immediate_discount_period_yn char(1),
                                              immediate_discount_start_ymdt datetime,
                                              immediate_discount_end_ymdt datetime,
                                              comparing_price_site json ,
                                              nonmember_purchase_yn char(1),
                                              minor_purchase_yn char(1),
                                              accumulation_rate decimal(5,2),
                                              accumulation_use_yn char(1),
                                              place_origin_seq int(11),
                                              place_origin varchar(300),
                                              place_origins_yn char(1),
                                              expiration_ymdt datetime,
                                              value_added_tax_type char(8),
                                              product_management_cd varchar(45),
                                              cart_use_yn char(1),
                                              cart_off_period_yn char(1),
                                              commission_rate_type char(8),
                                              commission_rate decimal(5,1),
                                              keyword varchar(300),
                                              extra_json json,
                                              product_name_en varchar(300),
                                              hs_code varchar(300),
                                              promotion_yn char(1),
                                              coupon_yn char(1),
                                              additional_discount_yn char(1),
                                              promotion_text_yn char(1),
                                              promotion_text varchar(150),
                                              promotion_text_start_ymdt datetime,
                                              promotion_text_end_ymdt datetime,
                                              platform_display_yn char(1),
                                              platform_display_pc_yn char(1),
                                              platform_display_mobile_yn char(1),
                                              platform_display_mobile_web_yn char(1),
                                              duty_info json,
                                              content_header mediumtext,
                                              content mediumtext,
                                              content_footer mediumtext,
                                              partner_charge_amt decimal(15,2),
                                              front_display_yn char(1),
                                              url_direct_display_yn char(1),
                                              delivery_yn char(1),
                                              shipping_area_type char(8),
                                              shipping_area_partner_no int,
                                              delivery_combination_yn char(1),
                                              delivery_international_yn char(1),
                                              delivery_template_no int,
                                              delivery_customer_info text,
                                              certification_type char(8),
                                              option_use_yn char(1),
                                              add_option_image_yn char(1),
                                              register_ymdt datetime,
                                              register_admin_no int(11),
                                              update_ymdt datetime,
                                              update_admin_no int(11),
                                              brand_no_mapping_key varchar(100),
                                              mapping_key varchar(100)
        ) charset = utf8;
        
        create index tpmp_mapping2 on tmp_pd_mall_product(mapping_key);
        create index tpmp_mapping3 on tmp_pd_mall_product(brand_no_mapping_key);
        create index tpmp_mapping4 on tmp_pd_mall_product(mall_no);
        ",

        "tmp_pd_mall_product_accumulate_count" => "create temporary table tmp_pd_mall_product_accumulate_count
        (
            seq                     int auto_increment comment '일련번호' primary key,
            mall_product_no           int            not null,
            like_cnt                  int            null,
            review_rate               decimal(15, 2) null,
            review_total_cnt          int            null,
            product_inquiry_total_cnt int            null,
            naver_review_cnt          int default 0  null,
            mapping_key               varchar(100)   null
        );
        create index tpmpac_mapping1 on tmp_pd_mall_product_accumulate_count(mapping_key);
        ",

        "tmp_pd_mall_product_input" => "create temporary table tmp_pd_mall_product_input
        (
            seq                     int auto_increment comment '일련번호' primary key,
            mall_product_no       int              not null comment '몰 상품 번호',
            input_text            varchar(50)      not null comment '구매자작성형 텍스트',
            use_yn                char             not null comment '사용여부',
            delete_yn             char             not null comment '삭제 여부',
            input_matching_type   char(8)          null comment '매칭타입 (옵션별 / 상품별)',
            required_yn           char default 'Y' null,
            mapping_key           varchar(100)     null
        ) charset = utf8;
        
        create index tpmpi_mapping1 on tmp_pd_mall_product_input(mapping_key);
        ",

        "tmp_pd_mall_product_sticker_mapping" => "create temporary table tmp_pd_mall_product_sticker_mapping
        (
            mall_product_no    int      not null,
            sticker_no         int      not null,
            display_start_date datetime null,
            display_end_date   datetime null,
            mapping_key varchar(100)    null            
        ) charset = utf8;
        
        create index tpmpsm_mapping1 on tmp_pd_mall_product_sticker_mapping(mapping_key);
        ",

        'tmp_pd_review' => "create temporary table tmp_pd_review
        (
            seq                     int auto_increment comment '일련번호' primary key,
            mall_no                 int                           null comment '몰번호',
            partner_no              int                           null,
            order_no                varchar(18) charset utf8mb4   null,
            mall_product_no         int                           null comment '몰상품번호',
            mall_option_no          int                           null comment '몰옵션번호',
            product_name            varchar(100)                  null comment '상품명',
            option_name             varchar(500)                  null comment '옵션명',
            register_name           varchar(50)                   null comment '작성자명',
            rating                  decimal(4, 1)                 null comment '평점',
            display_status_cd       char(8)                       null comment '전시상태 - 전시중/블라인드',
            recommend_cnt           int                           null comment '추천수',
            report_cnt              int                           null comment '신고수',
            blind_report_cnt        varchar(45)                   null comment '블라인드 적용 신고 수 ',
            content                 varchar(1500) charset utf8mb4 null,
            member_id               varchar(100)                  null,
            provider_type           char(20)                      null,
            register_ymdt           datetime                      null comment '등록일',
            register_no             int                           null comment '등록자 번호',
            update_ymdt             datetime                      null comment '수정일',
            update_no               int                           null comment '수정자 번호',
            delete_yn               char                          null comment '삭제 여부',
            attach_yn               char                          null comment '파일 첨부 여부',
            order_product_option_no bigint                        null,
            master_yn               char         default 'Y'      null,
            mapping_key             varchar(100)                  null,
            platform_type           char(8)                       null,
            extra_json              json                          null,
            best_review_yn          char         default 'N'      null,
            brand_name              varchar(200)                  null,
            partner_name            varchar(100) default ''       not null,
            member_mapping_key      varchar(100)                  null,
            product_mapping_key     varchar(100)                  null
        ) comment '상품평' charset = utf8;
        create index tpr_mapping1 on tmp_pd_review(member_mapping_key);
        create index tpr_mapping2 on tmp_pd_review(product_mapping_key);
        create index tpr_mapping3 on tmp_pd_review(mall_no);
        ",

        'tmp_pd_attach' => "create temporary table tmp_pd_attach
        (
            seq         int auto_increment comment '일련번호' primary key,
            target_no   int          null comment '댓글번호',
            attach_type char(8)      null comment '첨부파일 타입 (상품문의/)',
            url         varchar(300) null comment 'url',
            review_mapping_key       varchar(100) null,
            mall_no     int          null comment '몰번호'
        ) comment '댓글첨부파일' charset = utf8;
        
        create index rpa_mapping1 on tmp_pd_attach(review_mapping_key);
        create index rpa_mapping2 on tmp_pd_attach(mall_no);
        ",

        'tmp_mb_member' => "create temporary table tmp_mb_member
                                (
                                    seq                          int auto_increment comment '일련번호' primary key,
                                    member_grade_no              int                               not null,
                                    password                     varchar(200)                       null,
                                    member_name                  varchar(110)                       null,
                                    mobile_no                    varchar(50)                        null,
                                    mobile_no_last_digits        varchar(50)                        null,
                                    telephone_no                 varchar(50)                        null comment '일반 전화 번호',
                                    member_status                char(8)                            null comment '회원 상태',
                                    member_type                  char(8)                            null comment '회원 유형 쇼핑몰 회원, Oauth회원(PAYCO 회원)',
                                    principal_certification_yn   char                               not null,
                                    principal_certification_ymdt datetime                           null,
                                    birthday                     varchar(50)                        null,
                                    sex                          char                               null,
                                    email                        varchar(100)                       null,
                                    zip_cd                       varchar(50)                        null,
                                    address                      varchar(500)                       null comment '도로명 주소',
                                    detail_address               varchar(500)                       null comment '도로명 상세 주소',
                                    jibun_address                varchar(500)                       null comment '지번 주소',
                                    jibun_detail_address         varchar(500)                       null comment '지번 상세 주소',
                                    nickname                     varchar(45)                        null,
                                    additional_info              json                               null comment '추가 연락처, 추가 email,  팩스번호, 결혼여부, 결혼기념일, 직업 , 직종, 관심분야, 지역, 자녀 수, 연소득',
                                    mall_no                      int                                not null,
                                    join_type                    char(8)                             null,
                                    member_id                    varchar(50)                        null,
                                    join_ymdt                    datetime                           null,
                                    blacklist_yn                 char                               not null,
                                    last_login_ymdt              datetime                           null,
                                    last_login_ip                varchar(50)                        null,
                                    accumulation_amt             int                                null,
                                    login_count                  int                                null,
                                    push_notification_agree_yn   char                               not null,
                                    push_notification_agree_ymdt datetime                           null,
                                    sms_agree_yn                 char                               not null,
                                    sms_agree_ymdt               datetime                           null,
                                    direct_mail_agree_yn         char                               not null,
                                    direct_mail_agree_ymdt       datetime                           null,
                                    admin_comment                text                               null,
                                    refund_bank                  char(3)                            null,
                                    refund_bank_account          varchar(200)                       null,
                                    refund_bank_depositor_name   varchar(50)                        null,
                                    member_ci                    varchar(100)                       null,
                                    mapping_key                  varchar(100)                       null,
                                    last_grade_update_ymdt       datetime                           null,
                                    last_password_change_ymdt    datetime                           null,
                                    country_cd                   char(2)                            null,
                                    adult_certificated_yn        char                               null,
                                    adult_certificated_ymdt      datetime                           null,
                                    country_calling_code         char(8) default '82'               null,
                                    provider_type                char(20)                           null,
                                    password_change_required_yn  char default 'N'                   null,
                                    linked_yn                    char default 'N'                   null,
                                    link_ymdt                    datetime                           null,
                                    last_update_ymdt             datetime                           null,
                                    grade_mapping_key            varchar(100)                       null,
                                    group_mapping_key            varchar(100)                       null
                                ) comment '회원 정보 임시 테이블' charset = utf8;
        
        create index tmm_mapping1 on tmp_mb_member(grade_mapping_key);
        create index tmm_mapping2 on tmp_mb_member(group_mapping_key);                        
        ",

        "mb_member_grade" => "create table mb_member_grade
            (
                member_grade_no                       int auto_increment
                    primary key,
                member_grade_name                     varchar(50)                 null,
                accumulation_rate                     decimal(5, 2)  default 0.00 null,
                member_grade_accumulation_use_yn      char           default 'N'  null,
                point_rate                            decimal(5, 2)  default 0.00 null,
                accumulation_automatic_payment_use_yn char           default 'N'  not null,
                accumulation_automatic_payment_amt    int                         null,
                accumulation_automatic_payment_type   char(8)                     null,
                member_grade_description              varchar(200)                null,
                use_yn                                char                        null,
                advance_min_order_cnt                 int                         null,
                advance_min_order_amt                 decimal(15, 2) default 0.00 null,
                grade                                 int                         null,
                mall_no                               int                         not null,
                mapping_key                           varchar(100)                null
            ) comment '회원 등급' charset = utf8;",

        "tmp_mb_member_grade" => "create temporary table tmp_mb_member_grade
            (  
                member_grade_no                       int(11)                     null,
                member_grade_name                     varchar(50)                 null,
                accumulation_rate                     decimal(5, 2)  default 0.00 null,
                member_grade_accumulation_use_yn      char           default 'N'  null,
                point_rate                            decimal(5, 2)  default 0.00 null,
                accumulation_automatic_payment_use_yn char           default 'N'  not null,
                use_yn                                char                        null,
                advance_min_order_cnt                 int                         null,
                advance_min_order_amt                 decimal(15, 2) default 0.00 null,
                grade                                 int                         null,
                mall_no                               int                         not null,
                mapping_key                           varchar(100)                null
            ) comment '회원 등급' charset = utf8;
            
        create index tmmg_mapping1 on tmp_mb_member_grade(mall_no);
        create index tmmg_mapping2 on tmp_mb_member_grade(mapping_key);
        ",

        "mb_member_group" => "create table mb_member_group
            (
                member_group_no                  int auto_increment
                    primary key,
                member_group_name                varchar(45)                null,
                accumulation_rate                decimal(5, 2) default 0.00 null,
                member_group_accumulation_use_yn char          default 'N'  null,
                point_rate                       decimal(5, 2) default 0.00 null,
                member_group_description         varchar(200)               null,
                benefit_use_yn                   char                       null,
                mall_no                          int                        not null,
                sequence                         int                        null comment '노출 순번',
                mapping_key                      varchar(100)               null
            )   comment '회원 그룹' charset = utf8;",

        "tmp_mb_member_group" => "create temporary table tmp_mb_member_group
            (
                member_group_name                varchar(45)                null,
                accumulation_rate                decimal(5, 2) default 0.00 null,
                member_group_accumulation_use_yn char          default 'N'  null,
                benefit_use_yn                   char                       null,
                mall_no                          int                        not null,
                sequence                         int                        null comment '노출 순번',
                mapping_key                      varchar(100)               null
            )   comment '회원 그룹' charset = utf8;
        
        create index tmmg2_mapping1 on tmp_mb_member_group(mall_no);
        create index tmmg2_mapping2 on tmp_mb_member_group(mapping_key);    
        ",

        "tmp_mb_member_provider" => "create temporary table tmp_mb_member_provider
            (
                seq                int auto_increment comment '일련번호' primary key,
                member_no          int              not null,
                oauth_id           varchar(100)     not null,
                provider_type      char(20)         not null,
                mall_no            int              not null,
                delete_yn          char default 'N' not null,
                register_ymdt      datetime         not null,
                mapping_key        varchar(100)     null
            ) charset = utf8;
        
        create index tmmp_mapping1 on tmp_mb_member_provider(mall_no);
        create index tmmp_mapping2 on tmp_mb_member_provider(mapping_key);
        ",

        "tmp_mb_member_no" => "create temporary table tmp_mb_member_no (
                    member_no int(11),
                    mapping_key varchar(100)
                
                );
                create index tmmn_mapping1 on tmp_mb_member_no(member_no);
                create index tmmn_mapping2 on tmp_mb_member_no(mapping_key);",

        "tmp_od_address" => "create temporary table tmp_od_address
            (
                seq                     int auto_increment comment '일련번호' primary key,
                member_no               int                        not null,
                address_name            varchar(50)                null,
                default_yn              char                       not null,
                receiver_zip_cd         varchar(20)                not null,
                receiver_address        varchar(500)               not null,
                receiver_jibun_address  varchar(500)               null,
                receiver_detail_address varchar(500)               null,
                receiver_name           varchar(50)                not null,
                receiver_contact1       varchar(50)                not null,
                receiver_contact2       varchar(50)                null,
                register_ymdt           datetime                   null,
                country_cd              char(2) default 'KR'       null,
                address_type            char(8) default 'ADTP0002' not null,
                mapping_key             varchar(100)               null,
                mall_no                 int                        null
            ) comment '배송지정보' charset = utf8;
        create index toa_mapping1 on tmp_od_address(mall_no);
        create index toa_mapping2 on tmp_od_address(mapping_key);    
        ",

        "tmp_mb_accumulation" => "create temporary table tmp_mb_accumulation
            (
                seq                             int auto_increment comment '일련번호' primary key,
                mall_no                         int                         not null,
                member_no                       int                         not null,
                accumulation_type               char(8)                     null comment '적립금 타입( 외부적립금, 쇼핑몰 적립금)',
                register_ymdt                   datetime                    null,
                expire_ymdt                     datetime                    null,
                accumulation_reason             char(8)                     null comment '적립 사유 (구매, 상품평, 이벤트, 분할)',
                accumulation_status             char(8)                     null comment '적립금 상태(사용대기, 사용가능, 사용완료, 적립취소 완료, 적립취소 일부 실패, 유효기간 만료)',
                accumulation_amt                int                         null,
                reason_detail                   varchar(500)                null,
                order_no                        varchar(18) charset utf8mb4 null,
                review_no                       int                         null,
                accumulation_rest_amt           int                         null comment '현재 적립금에 대한 잔액',
                total_available_amt             int                         null comment '현재 적립금 처리 후의 전체 잔액',
                register_admin_no               int                         null,
                mapping_key                     varchar(100)                null,
                product_display_name            varchar(150)                null,
                accumulation_payment_request_no int                         null,
                start_ymdt                      datetime                    null
            ) comment '적립금' charset = utf8;
            create index tma_mapping1 on tmp_mb_accumulation(mall_no);
            create index tma_mapping2 on tmp_mb_accumulation(mapping_key);
        ",

        "mb_member_mapping_key" => "create table mb_member_mapping_key
            (
                old_member_no           int                         null,
                old_member_id           varchar(300)                null,
                mapping_key             varchar(100)                not null,
                mall_no                 int                         null
            ) comment '회원 매핑키 생성 정보' charset = utf8;",

        "tmp_bd_board_no"       => "create temporary table tmp_bd_board_no (
										board_article_no 	int(11)  		null,
										mapping_key         varchar(100)	null
									 ) charset = utf8;
									create index tbbn_mapping1 on tmp_bd_board_no(board_article_no);
                                    create index tbbn_mapping2 on tmp_bd_board_no(mapping_key);
									 ",

        "tmp_bd_board"  => "create temporary table tmp_bd_board
                            (
                                seq                  int auto_increment comment '일련번호' primary key,
                                board_name           varchar(45)      null,
                                board_description    varchar(200)     null,
                                use_category_yn      char             null,
                                use_attach_file_yn   char default 'N' null,
                                mall_no              int              null,
                                sequence             int              null,
                                board_delete_yn      char default 'N' null,
                                use_article_image_yn char default 'N' null,
                                member_write_yn      char default 'N' null,
                                guest_write_yn       char default 'N' null,
                                secret_yn            char default 'N' null,
                                reply_yn             char default 'N' null,
                                mapping_key    varchar(100)     null
                            ) comment '게시판' charset = utf8;
                            create index tbb_mapping1 on tmp_bd_board(mall_no);
                            create index tbb_mapping2 on tmp_bd_board(mapping_key);
                            ",

        "tmp_bd_board_article" => "create temporary table tmp_bd_board_article
            (
                seq                        int auto_increment comment '일련번호' primary key,
                register_ymdt              datetime                     null,
                article_title              varchar(200) charset utf8mb4 null,
                opening_yn                 char   default 'N'           not null,
                read_count                 int    default 0             null,
                board_no                   int                          not null,
                board_category_no          int                          null,
                article_content            mediumtext charset utf8mb4   null,
                write_admin_no             int                          null,
                parent_board_article_no    int                          null,
                modify_admin_no            int                          null,
                modify_ymdt                datetime                     null,
                article_delete_yn          char   default 'N'           not null,
                searchable_article_content mediumtext charset utf8mb4   null,
                article_image_url          varchar(500)                 null,
                deep                       int(1) default 0             null,
                password                   varchar(200)                 null,
                member_no                  int                          null,
                secreted                   char   default 'N'           null,
                attach_image_urls          json                         null,
                reply_count                int    default 0             not null,
                notice_yn                  char   default 'N'           not null,
                order_fixed_ymdt           datetime                     null,
                writer_name                varchar(110)                 null,
                writer_type                char(8)                      null,
                modify_member_no           int                          null,
                editor_name                varchar(110)                 null,
                editor_type                char(8)                      null,
                board_category_mapping_key varchar(100)                 null,
                board_mapping_key          varchar(100)                 null,
                member_mapping_key         varchar(100)                 null,
                parent_mapping_key         varchar(100)                 null,
                mapping_key                varchar(100)                 null
            ) comment '게시글' charset = utf8;
        create index tbba_mapping2 on tmp_bd_board_article(mapping_key);
        create index tbba_mapping3 on tmp_bd_board_article(parent_mapping_key);
        create index tbba_mapping4 on tmp_bd_board_article(member_mapping_key);
        create index tbba_mapping5 on tmp_bd_board_article(board_mapping_key);
        create index tbba_mapping6 on tmp_bd_board_article(board_category_mapping_key);
        ",

        "tmp_bd_board_category" => "create temporary table tmp_bd_board_category
            (
                category_name                   varchar(100)    null,
                board_no                        int             not null,
                board_mapping_key               varchar(100)    null,
                mapping_key                     varchar(100)    null
            ) comment '게시판 카테고리' charset = utf8;
        create index tbbc_mapping1 on tmp_bd_board_category(board_mapping_key);
        create index tbbc_mapping2 on tmp_bd_board_category(mapping_key);
        ",

        "tmp_bd_board_attach_file" => "create temporary table tmp_bd_board_attach_file
            (
                seq                int auto_increment comment '일련번호' primary key,
                original_file_name varchar(100) null,
                register_ymdt      datetime     null,
                board_article_no   int          null,
                uploaded_file_name varchar(200) null,
                notice_no          int          null,
                mapping_key        varchar(100) null
            ) comment '게시글 첨부 파일' charset = utf8;
        create index tbbaf_mapping1 on tmp_bd_board_attach_file(mapping_key);
        ",

        "tmp_pd_inquiry" => "create temporary table tmp_pd_inquiry
            (
                seq             int auto_increment comment '일련번호' primary key,
                parent_no       int                           null comment '부모번호',
                title           varchar(100) charset utf8mb4  null,
                content         varchar(1000) charset utf8mb4 null,
                member_id       varchar(100)                  null,
                provider_type   char(20)                      null,
                mall_no         int                           null comment '몰번호',
                partner_no      int                           null,
                mall_product_no int                           null comment '상품번호',
                inquiry_cd      char(8)                       null comment '문의유형 - 상품/배송/반품/교환/환불/기타',
                product_name    varchar(100)                  null comment '상품명',
                register_name   varchar(50)                   null comment '작성자명',
                secret_yn       char                          null comment '비밀여부',
                admin_yn        char                          null comment '어드민여부',
                reply_yn        char                          null comment '답변완료여부',
                reply_ymdt      datetime                      null comment '답변완료날짜',
                delete_yn       char                          null comment '삭제여부',
                order_no        varchar(18) charset utf8mb4   null,
                register_ymdt   datetime                      null,
                register_no     int                           null,
                update_ymdt     datetime                      null,
                update_no       int                           null,
                mapping_key     varchar(100)                  null,
                parent_mapping_key     varchar(100)           null,
                member_mapping_key     varchar(100)           null,
                product_mapping_key    varchar(100)           null,
                email           varchar(100)                  null
            ) comment '상품 문의' charset = utf8;
            create index tpi2_mapping1 on tmp_pd_inquiry(mapping_key);
            create index tpi2_mapping2 on tmp_pd_inquiry(parent_mapping_key);
            create index tpi2_mapping3 on tmp_pd_inquiry(member_mapping_key);
            create index tpi2_mapping4 on tmp_pd_inquiry(product_mapping_key)
        ",

        "tmp_cs_inquiry" => "create temporary table tmp_cs_inquiry
            (
                seq                  int auto_increment comment '일련번호' primary key,
                mall_no              int                          not null,
                register_ymdt        datetime                     not null,
                member_no            int                          null,
                admin_no             int                          null,
                inquiry_status       char(8)                      not null,
                inquiry_type_no      int                          not null,
                inquiry_title        varchar(400) charset utf8mb4 null,
                inquiry_content      text charset utf8mb4         null,
                product_no           int                          null,
                order_no             varchar(18) charset utf8mb4  null,
                inquiry_delete_yn    char default 'N'             null,
                answer_sms_send_yn   char default 'N'             null,
                answer_email_send_yn char default 'N'             null,
                member_email         varchar(100)                 null,
                mapping_key          varchar(100)                 null,
                member_mapping_key   varchar(100)                 null,
                product_mapping_key  varchar(100)                 null,
                type_mapping_key     varchar(100)                 null,
                external_mapping_key varchar(50)                  null,
                admin_name           varchar(20)                  null,
                member_id            varchar(50)                  null
            ) comment '1:1 문의' charset = utf8;
           ",

        "tmp_cs_inquiry_answer" => "create temporary table tmp_cs_inquiry_answer
            (
                seq                   int auto_increment comment '일련번호' primary key,
                register_ymdt         datetime             null,
                answer_content        text charset utf8mb4 null,
                sms_mobile_no         varchar(50)          null,
                email                 varchar(100)         null,
                inquiry_no            int                  null,
                mall_no               int                  not null,
                sms_send_yn           char                 null,
                email_send_yn         char                 null,
                answer_complete_yn    char                 null,
                sms_send_success_yn   char                 null,
                email_send_success_yn char                 null,
                external_mapping_key  varchar(50)          null,
                mapping_key           varchar(100)         null
            ) comment '1:1 문의 답변' charset = utf8;
        ",

        "tmp_cs_inquiry_attach_file" => "create temporary table tmp_cs_inquiry_attach_file
            (
                seq                int auto_increment comment '일련번호' primary key,
                original_file_name varchar(200) null,
                register_ymdt      datetime     null,
                inquiry_no         int          not null,
                mall_no            int              not null,
                uploaded_file_name varchar(200) null,
                mapping_key        varchar(100) null
            ) comment '1:1 문의 첨부파일' charset = utf8;
            ",

        "tmp_cs_inquiry_type" => "create temporary table tmp_cs_inquiry_type
            (
                seq                      int auto_increment comment '일련번호' primary key,
                inquiry_type_name        varchar(45)      null,
                inquiry_type_description text             null,
                mall_no                  int              not null,
                sequence                 int              null,
                inquiry_type_delete_yn   char default 'N' null,
                inquiry_type_channel     char(8)          null,
                type_mapping_key         varchar(100)     null
            ) comment '1:1 문의 유형' charset = utf8;
            ",

        "tmp_comm_partner" => "create temporary table tmp_comm_partner
            (
                seq                               int auto_increment primary key,
                partner_no                               int           default      0,
                partner_name                             varchar(45)                null,
                business_registration_no                 varchar(30)                null,
                partner_status                           char(8)                    null,
                country_cd                               char(2) default 'KR'       null,
                company_name                             varchar(45)                null,
                register_ymdt                            datetime                   null,
                register_admin_no                        int                        null,
                seller_taxation_type                     varchar(8)                 null,
                representative_name                      varchar(30)                null,
                business_condition                       varchar(50)                null,
                business_type                            varchar(50)                null,
                represent_phone_no                       varchar(50)                null,
                fax_no                                   varchar(50)                null,
                represent_email                          varchar(100)               null,
                online_marketing_business_declaration_no varchar(50)                null,
                office_zip_cd                            varchar(50)                null,
                office_address                           varchar(500)               null,
                office_detail_address                    varchar(500)               null,
                office_jibun_address                     varchar(500)               null,
                office_jibun_detail_address              varchar(500)               null,
                office_city                              varchar(100)               null,
                office_state_or_region                   varchar(100)               null,
                delivery_international_yn                char                       null,
                sample_url                               varchar(500)               null,
                privacy_manager_name                     varchar(30)                null,
                privacy_manager_phone_no                 varchar(50)                null,
                manager_name                             varchar(30)                null,
                manager_job_duty                         varchar(50)                null,
                manager_department                       varchar(50)                null,
                manager_job_position                     varchar(50)                null,
                manager_phone_no                         varchar(50)                null,
                manager_email                            varchar(100)               null,
                trade_bank                               char(3)                    null,
                trade_bank_name                          varchar(50)                null,
                trade_bank_account                       varchar(100)               null,
                trade_bank_depositor_name                varchar(20)                null,
                swift_code                               varchar(50)                null,
                aba_routing_no                           varchar(50)                null,
                iban_code                                varchar(50)                null,
                bsb_code                                 varchar(50)                null,
                commission_bill_issue_type               char(8)                    null,
                buying_bill_possible_yn                  char    default 'N'        not null,
                permitted_ip_address                     varchar(1000)              null,
                partner_type                             char(8) default 'PTTP0001' null,
                service_no                               int                        null,
                settlement_manager_name                  varchar(50)                null,
                settlement_manager_phone_no              varchar(50)                null,
                settlement_manager_email                 varchar(100)               null,
                product_registered_yn                    char    default 'N'        not null,
                mapping_key                              varchar(100)               null
            ) comment '파트너' charset = utf8;
            create index tcp_mapping1 on tmp_comm_partner(mapping_key);
        ",

        'tmp_comm_admin' => "create temporary table tmp_comm_admin
            (
                seq                         int auto_increment primary key,
                admin_no                    int           default      0,
                admin_id                    varchar(45)                 null comment '관리자 id',
                admin_password              varchar(200)                null comment '관리자 비밀번호',
                admin_name                  varchar(20)                 null,
                admin_type                  char(8)                     null comment '일반, MD',
                admin_role                  varchar(45)                 null comment '마스터, 일반',
                admin_status                char(8)                     null comment '대기 / 활성\n',
                phone_no                    varchar(50)                 null,
                mobile_no                   varchar(50)                 null,
                email                       varchar(500)                null,
                job_position_name           varchar(45)                 null,
                job_duty_no                 int                         null,
                job_duty_name               varchar(45)                 null,
                service_no                  int                         null,
                partner_no                  int                         null,
                external_access_yn          char                        null,
                department_no               int                         null,
                department_name             varchar(45)                 null,
                register_ymdt               datetime                    null,
                register_admin_no           int                         null,
                language                    char(2)     default 'KO'    not null,
                time_zone                   varchar(20) default 'TZ001' not null,
                last_login_ymdt             datetime                    null,
                last_name                   varchar(20)                 null,
                first_name                  varchar(20)                 null,
                authority_group_update_ymdt datetime                    null,
                password_update_ymdt        datetime                    null,
                oauth_id_no                 varchar(100)                null,
                mapping_key                 varchar(100)                null,
                partner_mapping_key         varchar(100)                null
            ) comment '어드민' charset = utf8;
            create index tca_mapping1 on tmp_comm_admin(mapping_key);
            create index tca_mapping2 on tmp_comm_admin(partner_mapping_key);
        ",

        'tmp_comm_mall_partner_contract' => "create temporary table tmp_comm_mall_partner_contract
            (
                seq                             int auto_increment primary key,
                mall_no                         int              not null,
                partner_no                      int              not null,
                charge_md_no                    int              null comment '담당MD',
                contract_type                   char(8)          null,
                contract_period                 varchar(45)      null,
                contract_status                 varchar(45)      null,
                commission_rate                 decimal(5, 1)    null,
                default_commission_rate_use_yn  char default 'N' not null,
                promotion_agree_yn              char default 'Y' not null,
                register_ymdt                   datetime         null,
                start_ymdt                      datetime         null,
                register_admin_no               int              null,
                memo                            text             null,
                standing_point_contract_used_yn char default 'N' not null,
                partner_mapping_key             varchar(100)     null
            ) comment '쇼핑몰 파트너 계약관계' charset = utf8;
            create index tcmpc_mapping1 on tmp_comm_mall_partner_contract(partner_mapping_key);
        ",

        'tmp_od_delivery_area_fee' => "create temporary table tmp_od_delivery_area_fee
            (
                seq             int auto_increment primary key,
                area_fee_no     int comment '지역별 추가배송비 번호',
                area_fee_name   varchar(100) default '0'               not null,
                partner_no      int          default 0                 not null,
                register_ymdt   datetime     default CURRENT_TIMESTAMP null comment '등록일',
                country_cd      char(2)      default 'KR'              null,
                admin_no        int                                    not null,
                delete_yn       char         default 'N'               not null,
                mapping_key     varchar(100)                           null,
                partner_mapping_key          varchar(100)              null,
                update_ymdt     datetime                               null,
                update_admin_no int          default 0                 null
            ) comment '지역별 추가 배송비' charset = utf8;
            create index todaf_mapping1 on tmp_od_delivery_area_fee(mapping_key);
            create index todaf_mapping2 on tmp_od_delivery_area_fee(partner_mapping_key);
        ",

        'tmp_od_delivery_area_fee_detail' => "create temporary table tmp_od_delivery_area_fee_detail
                (
                    seq             int auto_increment primary key,
                    delivery_area_fee_detail_seq int            null,
                    area_fee_no                  int            not null comment '지역별 추가배송비 번호',
                    area_no                      int            not null comment '배송비 추가로 받고 싶은 지역',
                    extra_delivery_amt           decimal(15, 2) null comment '추가 배송비',
                    partner_no                   int            null comment '파트너번호',
                    mapping_key                  varchar(100)   null,
                    partner_mapping_key          varchar(100)   null
                ) comment '지역별 추가배송비 상세' charset = utf8;
                create index todafd_mapping1 on tmp_od_delivery_area_fee_detail(mapping_key);
                create index todafd_mapping2 on tmp_od_delivery_area_fee_detail(partner_mapping_key);
        ",

        'tmp_od_delivery_template_group' => "create temporary table tmp_od_delivery_template_group
                (
                    seq                         int auto_increment primary key,
                    delivery_template_group_no int comment '배송비템플릿 그룹번호' null,
                    partner_no                 int                                not null comment '파트너 번호',
                    group_delivery_amt_type    char(8)                            null comment '그룹 배송비조건 산출방식, (그룹 중에서 최소 배송비 선택 or 최대 배송비 선택)',
                    template_group_name        varchar(50)                        null,
                    display_no                 int                                not null,
                    default_yn                 char     default 'N'               null comment '기본 그룹 여부',
                    delete_yn                  char     default 'N'               not null,
                    area_fee_no                int                                null,
                    delivery_template_type     char(8)                            null,
                    delivery_amt_in_advance_yn char     default 'Y'               null,
                    mapping_key                varchar(100)                       null,
                    partner_mapping_key        varchar(100)                       null,
                    area_fee_mapping_key       varchar(100)                       null,
                    register_admin_no          int      default 0                 null,
                    register_ymdt              datetime default CURRENT_TIMESTAMP null,
                    update_ymdt                datetime                           null,
                    update_admin_no            int      default 0                 null
                ) comment '배송비템플릿 그룹 ' charset = utf8;
                create index todtg_mapping1 on tmp_od_delivery_template_group(mapping_key);
                create index todtg_mapping2 on tmp_od_delivery_template_group(partner_mapping_key);
                create index todtg_mapping3 on tmp_od_delivery_template_group(area_fee_mapping_key);
                ",

        'tmp_od_warehouse' => "create temporary table tmp_od_warehouse
                (
                    seq                         int auto_increment primary key,
                    warehouse_no                 int comment '출고,반품지 번호' null,
                    warehouse_name               varchar(50)                        null comment '출고,반품지 명',
                    partner_no                   int                                null comment '벤더번호',
                    default_release_warehouse_yn char     default 'N'               null,
                    default_return_warehouse_yn  char     default 'N'               null,
                    address                      varchar(500)                       null comment '주소',
                    zip_cd                       varchar(20)                        null comment '우편번호',
                    oversea_address1             varchar(500)                       null,
                    oversea_address2             varchar(500)                       null,
                    oversea_city                 varchar(50)                        null,
                    oversea_region               varchar(50)                        null,
                    detail_address               varchar(500)                       null,
                    delete_yn                    char     default 'N'               not null,
                    country_cd                   char(2)  default 'KR'              null,
                    warehouse_address_type       char(8)  default 'WHNT0001'        null,
                    mapping_key                  varchar(100)                       null,
                    partner_mapping_key          varchar(100)                       null,
                    register_admin_no            int      default 0                 null,
                    register_ymdt                datetime default CURRENT_TIMESTAMP null,
                    update_ymdt                  datetime                           null,
                    update_admin_no              int      default 0                 null,
                    contact                      varchar(50)                        null
                ) comment '출고지, 반품/교환배송지를 관리' charset = utf8;
                create index tow_mapping1 on tmp_od_warehouse(mapping_key);
                create index tow_mapping2 on tmp_od_warehouse(partner_mapping_key);
                ",

        'tmp_od_delivery_template' => "create temporary table tmp_od_delivery_template
                (
                    seq                         int auto_increment primary key,
                    delivery_template_no       int comment '배송템플릿 일련번호' null,
                    delivery_template_group_no int                                null,
                    partner_no                 int                                not null,
                    template_name              varchar(50)                        not null,
                    delivery_template_type     char(8)  default 'DETE0001'        not null,
                    release_warehouse_no       int                                not null,
                    return_warehouse_no        int                                not null,
                    default_yn                 char     default 'N'               not null,
                    delete_yn                  char     default 'N'               null,
                    mapping_key                varchar(100)                       null,
                    partner_mapping_key        varchar(100)                       null,
                    template_group_mapping_key varchar(100)                       null,
                    rel_warehouse_mapping_key  varchar(100)                       null,
                    ret_warehouse_mapping_key  varchar(100)                       null,
                    register_admin_no          int      default 0                 null,
                    register_ymdt              datetime default CURRENT_TIMESTAMP null,
                    update_ymdt                datetime                           null,
                    update_admin_no            int      default 0                 null
                ) comment '배송 템플릿' charset = utf8;
                create index todt_mapping1 on tmp_od_delivery_template(mapping_key);
                create index todt_mapping2 on tmp_od_delivery_template(partner_mapping_key);
                create index todt_mapping3 on tmp_od_delivery_template(template_group_mapping_key);
                create index todt_mapping4 on tmp_od_delivery_template(rel_warehouse_mapping_key);
                create index todt_mapping5 on tmp_od_delivery_template(ret_warehouse_mapping_key);
                ",

        'tmp_od_delivery_condition' => "create temporary table tmp_od_delivery_condition
                (
                    seq                                int auto_increment primary key,
                    delivery_template_no               int  default 0   not null comment '배송비탬플릿번호',
                    shipping_method_type               char(8)          null comment '배송서비스',
                    delivery_countries                 json             null comment 'ex : [{\"coutryCd\":\"US\", \"areaFeeNo\":1}]',
                    delivery_condition_type            char(8)          null comment '배송비 조건 타입 (ex : 고정배송비, 무게 배송비, 수량 차등 배송비, 수량 비례 배송비)',
                    delivery_amt                       decimal(15, 2)   null comment '배송비 (고정배송비, 수량비례 배송비에 해당)',
                    return_delivery_amt                decimal(15, 2)   null comment '반품배송비',
                    partner_no                         int              not null comment '파트너 번호',
                    above_delivery_amt                 decimal(15, 2)   null comment '조건배송비 값 (5000인 경우 5000원 이상 구매시 배송비 무료)',
                    per_order_cnt                      int              null comment '수량 비례 배송비 관련 값 (2이면 2개당 배송비 5,000원)',
                    register_admin_no                  int              null comment '등록어드민번호',
                    register_ymdt                      datetime         null comment '등록일시',
                    delivery_type                      char(8)          null comment '택배 구분 (소포, 화물 직접배송)',
                    delivery_company_type              char(8)          null comment '택배사 구분',
                    delete_yn                          char default 'N' not null comment '삭제 여부',
                    front_display_text                 varchar(1000)    null comment '프론트노출문구',
                    remote_area_fee_condition_check_yn char default 'N' null comment '지역별추가배송비무료조건체크여부',
                    mapping_key                        varchar(100)     null,
                    partner_mapping_key                varchar(100)     null,
                    update_ymdt                        datetime         null,
                    update_admin_no                    int  default 0   null,
                    delivery_fee_range_json            json             null
                ) comment '배송비조건 테이블' charset = utf8;
                create index todc_mapping1 on tmp_od_delivery_condition(mapping_key);
                create index todc_mapping2 on tmp_od_delivery_condition(partner_mapping_key);
                ",
    );
?>