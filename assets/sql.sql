/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     1.5.2018 13:30:32                            */
/*==============================================================*/


drop table if exists userrights;

drop table if exists rights;

drop table if exists users;



/*==============================================================*/
/* Table: users                                                 */
/*==============================================================*/
create table users
(
   id                   SERIAL,
   email                varchar(255) not null,
   name                 varchar(255),
   surname              varchar(255),
   password             varchar(255) not null,
   image                varchar(255),
   primary key (id),
   unique (email)
) ENGINE=InnoDB CHARACTER SET utf8
;


/*==============================================================*/
/* Table: rights                                                */
/*==============================================================*/
create table rights
(
   id             SERIAL,
   name           varchar(255),
   constraint unique_rights unique (name),
   primary key (id)
) ENGINE=InnoDB CHARACTER SET utf8
;


/*==============================================================*/
/* Table: userRights                                                */
/*==============================================================*/
create table userrights
(
   userId             BIGINT UNSIGNED not null,
   rightId            BIGINT UNSIGNED not null,
   primary key (userId, rightId),
   constraint FK_commonRights_usr foreign key (userId)
   references users (id) on DELETE CASCADE ,
   constraint FK_commonRights_rig foreign key (rightId)
   references rights (id) ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8
;



INSERT INTO `rights` (`id`, `name`) VALUES
  (1, 'admin');
INSERT INTO `users`(`email`, `password`) VALUES ("admin@admin.cz", "$2y$10$4iP5iusxv7MAYDaB92moYuZdhEK.51V4j9mv7pSQbJnjP5NBG4BMa");
INSERT INTO `userrights`(`userId`, `rightId`) VALUES (1,1);