mysql -u root -p

use skillsbook;

create table users (
    user_id varchar(50) not null primary key,
    password varchar(50) not null,
    user_name varchar(50) not null
);

insert into users values('admin','1234','관리자');


create table books (
    id int auto_increment primary key,
    title varchar(255) not null,
    author varchar(255) not null,
    publisher varchar(100),
    pub_year int not null,
    price int not null,
    image varchar(100),
    status varchar(50) default 'Y'
);

create table loan (
    id int auto_increment primary key,
    user_id varchar(50) not null,
    book_id int not null,
    loan_date date not null,
    return_date date not null
);
