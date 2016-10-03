create table tab(
    ID int AUTO_INCREMENT,
    type varchar(40),
    path varchar(200),
    band varchar(200),
    song varchar(200),
    version int,
    tab_type varchar(60),
    content mediumtext,
    rating double,
    downloads int,
    upload_date datetime,
    modified_date datetime,
    uploader_ID int,
    tunning varchar(40),
    difficulty varchar(30),
    constraint pk_tab primary key(ID),
    constraint fk_tab_user foreign key(uploader_ID) references user(ID)
)
CHARACTER SET utf8 COLLATE utf8_general_ci;


create table tab_report(
    ID int AUTO_INCREMENT,
    reported_ID int,
    reporter_ID int,
    report mediumtext,
    date datetime,
    constraint fk_reported_tab foreign key(reported_id) references tab(ID),
    constraint fk_reporter_user_tab foreign key(reporter_id) references user(ID),
    constraint pk_tab_report primary key(ID)
)
CHARACTER SET utf8 COLLATE utf8_general_ci;



create table tab_comment(
    ID int AUTO_INCREMENT,
    tab_ID int,
    author_ID int,
    content varchar(500),
    date datetime,
    constraint fk_tab_id foreign key (tab_ID) references tab(ID),
    constraint fk_tab_comment foreign key(author_ID) references user(ID),
    constraint pk_tab_comment primary key(ID)
)
CHARACTER SET utf8 COLLATE utf8_general_ci;

create table tab_rating(
    ID int AUTO_INCREMENT,
    tab_ID int,
    user_ID int,
    rating int,
    date datetime,
    constraint fk_tab_id foreign key (tab_ID) references tab(ID),
    constraint fk_tab_rater foreign key(user_ID) references user(ID),
    constraint pk_tab_rating primary key(ID)
)
CHARACTER SET utf8 COLLATE utf8_general_ci;


create table user(
    ID int AUTO_INCREMENT,
    username varchar(50),
    password varchar(50),
    email varchar(80),
    birthday datetime,
    register_date datetime,
    gender varchar(5),
    photo varchar(200),
    type varchar(20),
    activated int,
    about_me varchar(500),
    location varchar(100),
    instrument varchar(500),
    web varchar(200),
    occupation varchar(200),
    favourite_bands varchar(500),
    reputation int,
    last_active_date datetime,
    constraint pk_user primary key(ID)
)
CHARACTER SET utf8 COLLATE utf8_general_ci;


create table user_comment(
    ID int AUTO_INCREMENT,
    user_ID int,
    author_ID int,
    content varchar(500),
    date datetime,
    constraint fk_comment_user foreign key(user_ID) references user(ID),
    constraint fk_comment_author foreign key(author_ID) references user(ID),
    constraint pk_user primary key(ID)
)
CHARACTER SET utf8 COLLATE utf8_general_ci;

create table user_report(
    ID int AUTO_INCREMENT,
    reported_ID int,
    reporter_ID int,
    report mediumtext,
    date datetime,
    constraint fk_reported_user foreign key(reported_id) references user(ID),
    constraint fk_reporter_userr foreign key(reporter_id) references user(ID),
    constraint pk_user_report primary key(ID)
)
CHARACTER SET utf8 COLLATE utf8_general_ci;


create table article(
    ID int AUTO_INCREMENT,
	author_ID int,
    title varchar(250),
    summary varchar(500),
    content mediumtext,
    date datetime,
    picture varchar(500),
    views int,
	constraint fk_article_author foreign key(author_ID) references user(ID),
    constraint pk_article primary key(ID)
)
CHARACTER SET utf8 COLLATE utf8_general_ci;


create table article_comment(
    ID int AUTO_INCREMENT,
    article_ID int,
    author_ID int,
    content varchar(500),
    date datetime,
    constraint fk_article_id foreign key (article_ID) references article(ID),
    constraint fk_article_comment foreign key(author_ID) references user(ID),
    constraint pk_article_comment primary key(ID)
)
CHARACTER SET utf8 COLLATE utf8_general_ci;


create table user_favourite(
    ID int AUTO_INCREMENT,
    tab_ID int,
    user_ID int,
    date datetime,
    constraint fk_favourite_tab_id foreign key (tab_ID) references tab(ID),
    constraint fk_favourite_user_id foreign key(user_ID) references user(ID),
    constraint pk_user_favourite primary key(ID)
)
CHARACTER SET utf8 COLLATE utf8_general_ci;

create table user_activation(
	ID int AUTO_INCREMENT,
	user_ID int,
	hash varchar(200),
	date datetime,
	constraint fk_activation_user_id foreign key(user_ID) references user(ID),
	constraint pk_user_activation primary key(ID)
)
CHARACTER SET utf8 COLLATE utf8_general_ci;

create table password_reset(
	ID int AUTO_INCREMENT,
	user_ID int,
	hash varchar(200),
	date datetime,
	constraint fk_password_reset_user_id foreign key(user_ID) references user(ID),
	constraint pk_password_reset primary key(ID)
)
CHARACTER SET utf8 COLLATE utf8_general_ci;
