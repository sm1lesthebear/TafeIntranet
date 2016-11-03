insert into tbl_privilege 
(fldTitle) 
values 
('Admin');
insert into tbl_privilege 
(fldTitle) 
values 
('Editor');
insert into tbl_privilege 
(fldTitle) 
values 
('Viewer');
insert into tbl_user 
(fldFirstName,fldLastName,fldEmail,fldUserName,fldPassword,fldPasswordSalt,fldFkPrivilegeId) 
values 
('Admin','User','Admin@Email.com','Admin','$2y$12$UVoj0opWrxwx91xlfplhYet3NyhfuCJY/h3NR6/ey/VwmNyTNxyRe','UVoj0opWrxwx91xlfplhYq',1);
insert into tbl_user 
(fldFirstName,fldLastName,fldEmail,fldUserName,fldPassword,fldPasswordSalt,fldFkPrivilegeId) 
values 
('Editor','User','Editor@Email.com','Editor','$2y$12$UVoj0opWrxwx91xlfplhYet3NyhfuCJY/h3NR6/ey/VwmNyTNxyRe','UVoj0opWrxwx91xlfplhYq',2);
insert into tbl_user 
(fldFirstName,fldLastName,fldEmail,fldUserName,fldPassword,fldPasswordSalt,fldFkPrivilegeId) 
values 
('Viewer','User','Viewer@Email.com','Viewer','$2y$12$UVoj0opWrxwx91xlfplhYet3NyhfuCJY/h3NR6/ey/VwmNyTNxyRe','UVoj0opWrxwx91xlfplhYq',3);
