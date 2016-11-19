-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema intranetdb
-- -----------------------------------------------------

Drop database if exists intranetdb;
CREATE SCHEMA IF NOT EXISTS `intranetdb` DEFAULT CHARACTER SET utf8 ;
USE `intranetdb`;

-- -----------------------------------------------------
-- Schema intranetdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `intranetdb` DEFAULT CHARACTER SET utf8 ;
USE `intranetdb` ;

/* Table tbl_doc_category creation */

create table if not exists tbl_doc_category (
	fldID BIGINT auto_increment not null,
    fldCategory varchar(50) not null,
    primary key (fldID));

/* Table tbl_doc_type creation*/

create table if not exists tbl_doc_type (
	fldID BIGINT auto_increment not null,
    fldType varchar(50) not null,
    primary key(fldID));

/* table tbl_privilege creation */

create table if not exists tbl_privilege (
	fldID BIGINT auto_increment not null,
    fldTitle varchar(30) not null,
    primary key (fldID));

/* table tbl_whs_type creation */

create table if not exists tbl_whs_type (
	fldID BIGINT auto_increment not null,
	fldType varchar(30) not null,
  primary key (fldID))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

/* table tbl_stakeholders  creation */

create table if not exists tbl_stakeholders (
	fldID BIGINT auto_increment not null,
    fldFirstName varchar(30) not null,
    fldLastName varchar(30) not null,
    fldImageLocation Text not null,
    fldInfo TEXT,
    primary key (fldID));

/* table tbl_sus creation */

create table if not exists tbl_sus (
	fldID BIGINT auto_increment not null,
    fldProjectName varchar(40) not null,
    primary key (fldID));

/* table tbl_doc creation */

create table if not exists tbl_doc (
	fldID BIGINT auto_increment not null,
    fldName text not null,
    fldLocation text not null,
    fldFkDocTypeId BIGINT not null,
    fldFkDocCategoryId BIGINT not null,
    primary key (fldID),
		index fldFkDocTypeIdIdx (fldFkDocTypeId),
        index fldFkDocCategoryIdIdx (fldFkDocCategoryId),
	constraint fldFkDocTypeId
		foreign key (fldFkDocTypeId)
			references intranetdb.tbl_doc_type (fldID)
		on delete no action
        on update no action,
	constraint fldFkDocCategoryId 
		foreign key (fldFkDocCategoryId)
			references intranetdb.tbl_doc_category (fldID)
		on delete no action
        on update no action);

/* table tbl_user creation */

create table if not exists tbl_user (
	fldID BIGINT auto_increment not null,
    fldFirstName varchar(30) not null,
    fldLastName varchar(30) not null,
    fldEmail varchar(60) not null,
    fldUserName varchar(45) not null,
    fldPassword text not null,
    fldPasswordSalt text not null,
    fldFkPrivilegeId BIGINT not null,
    primary key (fldID),
		index fldFkPrivilegeIdIdx (fldFkPrivilegeId),
	constraint fldFkprivilegeId
		foreign key (fldFkprivilegeId)
			references intranetdb.tbl_privilege (fldID)
		on delete no action
        on update no action);

/* table tbl_block creation */

create table if not exists tbl_block (
	fldID BIGINT auto_increment not null,
		fldLocation varchar(40) not null,
		fldPosiX1 int(11) not null,
		fldPosiY1 int(11) not null,
		fldPosiX2 int(11) not null,
		fldPosiY2 int(11) not null,
		primary key (fldID));

/* table tbl_whs creation */

create table if not exists tbl_whs (
	fldID BIGINT auto_increment not null,
		fldTitle varchar(60) not null,
    fldDate TIMESTAMP not null default NOW(),
    fldFkWhsTypeId BIGINT not null,
    fldFkBlockId BIGINT not null,
    primary key (fldID),
			index fldFkBlockIdIdx (fldFkBlockId),
			index fldFkWhsTypeIdIdx (fldFkWhsTypeId),
	constraint fldFkBlockId
		foreign key (fldFkBlockId)
			references intranetdb.tbl_block (fldID)
		on delete no action
		on update no action,
	constraint fldFkWhsTypeId
		foreign key (fldFkWhsTypeId)
			references intranetdb.tbl_whs_type (fldID)
		on delete no action
		on update no action);

/* table tbl_doc_bridge creation */

create table if not exists tbl_whs_doc_bridge (
	fldID BIGINT auto_increment not null,
	fldFkDocId BIGINT not null,
	fldFkWhsId BIGINT not null,
    primary key (fldID),
		index fldFkDocIdIdx (fldFkDocId),
        index fldFkWhsIdIdx (fldFkWhsId),
	constraint fldFkDocId
		foreign key (fldFkDocId)
			references intranetdb.tbl_doc (fldID)
		on delete no action
		on update no action,
	constraint fldFkWhsId
		foreign key (fldFkWhsId)
			references intranetdb.tbl_whs (fldID)
		on delete no action
		on update no action);

create table if not exists tbl_sus_doc_bridge (
	fldID BIGINT auto_increment not null,
	fldFKDocID BIGINT not null,
	fldFKSusID BIGINT not null,
    primary key (fldID),
		index fldFKDocIDIdx (fldFKDocID),
        index fldFkSusIDIdx (fldFKSusID),
	constraint fldFKDocIDcst
		foreign key (fldFKDocID)
			references intranetdb.tbl_doc (fldID),
	constraint fldFkSusIDcst
		foreign key (fldFKSusID)
			references intranetdb.tbl_sus (fldID)
);

create table tbl_sus_block_bridge (
	fldID BIGINT auto_increment not null,
    fldFkBlockID BIGINT not null,
    fldFKSusID BIGINT not null,
    primary key (fldID),
		index fldFkBlockIDIdx (fldFkBlockID),
        index fldFKSusIDIdx (fldFKSusID),
	constraint fldFkBlockID_cst2
		foreign key (fldFkBlockID)
			references intranetdb.tbl_block (fldID),
	constraint fldFKSusID_cst
		foreign key (fldFKSusID)
			references intranetdb.tbl_sus (fldID)
);

delimiter //

create procedure InsertUser(
	in FirstName varchar(60), 
	in LastName varchar(60), 
	in Email varchar(60), 
	in Username varchar(60), 
	in Password text, 
	in PasswordSalt text, 
	in Privilege int(11)
)
Not deterministic
modifies sql data
begin


if Privilege = 1 then
		SET @AdminCount := 0;
		select count(fldFkPrivilegeId) into @AdminCount from tbl_user where fldFkPrivilegeId = 1;
		if 2 > @AdminCount then
			insert into tbl_user (
				fldFirstName,
				fldLastName,
				fldEmail,
				fldUserName,
				fldPassword,
				fldPasswordSalt,
				fldFkPrivilegeId)
			VALUES (
				FirstName, 
				LastName, 
				Email, 
				Username, 
				Password, 
				PasswordSalt, 
				Privilege);
		end if;
elseif Privilege > 1 then
	insert into tbl_user (
		fldFirstName,
		fldLastName,
		fldEmail,
		fldUserName,
		fldPassword,
		fldPasswordSalt,
		fldFkPrivilegeId)
	VALUES (
		FirstName, 
		LastName, 
		Email, 
		Username, 
		Password, 
		PasswordSalt, 
		Privilege);
end if;
end;
//
delimiter ;