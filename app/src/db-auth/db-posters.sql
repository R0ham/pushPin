create table pushpin.posters
(
    id         int auto_increment
        primary key,
    account_id int unsigned                            not null,
    title      varchar(100)                            not null,
    image_file varchar(32)                             not null,
    post_date  timestamp default '0000-00-00 00:00:00' not null,
    takedown   timestamp default '0000-00-00 00:00:00' not null,
    event_date timestamp                               null,
    constraint posters_image_file_uindex
        unique (image_file),
    constraint posters_accounts_account_id_fk
        foreign key (account_id) references pushpin.accounts (account_id)
);

