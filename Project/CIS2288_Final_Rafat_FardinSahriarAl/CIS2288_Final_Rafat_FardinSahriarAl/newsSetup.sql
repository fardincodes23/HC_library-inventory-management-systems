create database news2288;
use news2288;

create table news (
    storyId INT(100) AUTO_INCREMENT,
    headline varchar(255),
    storyDetails TEXT(10000),
    primary key (storyId)
);

insert into news (headline, storyDetails) VALUES ('This Title Needs Editing!', 'This story is awesome, however, there are some things you do not know. Film at 11');
insert into news (headline, storyDetails) VALUES ('Neighbour Thinks He is All That With New Car', 'So can you believe it? She has some nerve, driving around a BRAND NEW Kia, like a BOSS. Ugh, some people.');
insert into news (headline, storyDetails) VALUES ('This PHP stuff is Magic!', 'I have seen a lot of things, but this takes the cake. PHP is a cornucopia of goodness that soothes my soul.');

