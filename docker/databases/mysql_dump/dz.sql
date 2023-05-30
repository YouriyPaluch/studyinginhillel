create table php_pro.url_codes
(
    id           INT         not null auto_increment,
    url          text        not null,
    url_code     varchar(10) not null,
    constraint url_codes_pk
        primary key (id)
);

create unique index url_codes_url_code_uindex
    on php_pro.url_codes (url_code);

