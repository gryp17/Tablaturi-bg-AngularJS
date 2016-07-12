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

#data

insert into user values(1,'plamen', '123456', 'skate_mania@abv.bg', now(), now(), 'm', '', 'admin', 1);

insert into tab values(1, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(2, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(3, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(4, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(5, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(6, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(7, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(8, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(9, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(10, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(11, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(12, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(13, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(14, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(15, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(16, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(17, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(18, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(19, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(20, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(21, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(22, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(23, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(24, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(25, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(26, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(27, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(28, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(29, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(30, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(31, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(32, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(33, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(34, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(35, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(36, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(37, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(38, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(39, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(40, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(41, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(42, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(43, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(44, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(45, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(46, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(47, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(48, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(49, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(50, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(51, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(52, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(53, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(54, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(55, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(56, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(57, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(58, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(59, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(60, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(61, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(62, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(63, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(64, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(65, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);
insert into tab values(66, 'Guitar Pro', null, 'Linkin park', 'In the end', 1, 'intro', null, 3.5, 125, now(), now(), 1);



insert into article (title, summary, content, date) values ('Playing Guitar Boosts Brain Power, Research Finds', 'Mastering instruments results in problem-solving improvements.', 'A new study conducted at Boston Childrens Hospital has drawn an interesting conclusion, claiming that mastering a musical instrument at a young age results in brainpower improvement for life.
As Daily Mail reports, researchers found that children who underwent musical training, guitar lessons included, were better at processing and retaining information, as well as problem solving in general.
"Since executive functioning is a strong predictor of academic achievement, even more than IQ, we think our findings have strong educational implications," said head of research Nadine Gaab.
The study was conducted through functional MRI brain scans performed on a group of 15 musically trained nine to 12-year-olds and 12 untrained kids of the same age.
Similarly, two groups of 15 adults were compared, featuring professional musicians on one side and non-musicians on the other.
The groups were matched in terms of IQ and have underwent a series of cognitive tests and brain scans.', now());

insert into article (title, summary, content, date) values ('Courtney Love: Its Time To Make Amends With Dave Grohl', '"Rock stars do better when theyre dead," Courtney adds on an unrelated note.', 'Courtney Love has recently stated that the time has finally come to fully bury the hatchet with Foo Fighters frontman Dave Grohl.
During an interview at Cannes Lions 2014, the singer only briefly addressed the matter, saying, "Its time to make amends."
Love and Grohl have already significantly improved their relationship at this years Rock Hall ceremony, seemingly ending the long feud with a heartfelt hug.
During the rest of the Cannes chat, Courtney compared the rock music world to the film domain, saying that rockers score more success when they are dead.', now());

insert into article (title, summary, content, date) values ('Linkin Park Inducted Into Guitar Centers Rock Walk', 'They forever cemented their handprints alongside some of musics greats.', 'Linkin Park have become the latest act inducted into Guitar Centers Hollywood RockWalk, Loudwire reports. The band took part in a special ceremony yesterday (June 18) at the Los Angeles Guitar Center, where they forever cemented their handprints alongside some of musics greats.
"Guitar Center Sessions" host Nic Harcourt and KROQ DJ Ted Stryker each offered some kind words and impressive stats about the band before they were introduced to those in attendance. Stryker offered, "Theyre one cohesive unit.', now());



