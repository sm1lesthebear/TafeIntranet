insert into tbl_privilege 
(fldTitle) 
values 
('Admin'), ('Editor'), ('Viewer');
insert into tbl_user 
(fldFirstName,fldLastName,fldEmail,fldUserName,fldPassword,fldPasswordSalt,fldFkPrivilegeId) 
values 
('Admin','User','Admin@Email.com','Admin','$2y$12$UVoj0opWrxwx91xlfplhYet3NyhfuCJY/h3NR6/ey/VwmNyTNxyRe','UVoj0opWrxwx91xlfplhYq',1), ('Editor','User','Editor@Email.com','Editor','$2y$12$UVoj0opWrxwx91xlfplhYet3NyhfuCJY/h3NR6/ey/VwmNyTNxyRe','UVoj0opWrxwx91xlfplhYq',2), ('Viewer','User','Viewer@Email.com','Viewer','$2y$12$UVoj0opWrxwx91xlfplhYet3NyhfuCJY/h3NR6/ey/VwmNyTNxyRe','UVoj0opWrxwx91xlfplhYq',3);

insert into tbl_doc_category
(fldCategory)
values
("Sustainability"), ("OHS");

insert into tbl_doc_type
(fldType)
values
("None"), ("Incident"), ("Hazard"), ("Near-Miss");