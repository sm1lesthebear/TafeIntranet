insert into tbl_privilege 
(fldTitle) 
values 
('Admin'), 
('Editor'), 
('Viewer');

insert into tbl_user 
(fldFirstName,fldLastName,fldEmail,fldUserName,fldPassword,fldPasswordSalt,fldFkPrivilegeId) 
values 
('Admin','User','Admin@Email.com','Admin','$2y$12$UVoj0opWrxwx91xlfplhYet3NyhfuCJY/h3NR6/ey/VwmNyTNxyRe','UVoj0opWrxwx91xlfplhYq',1), 
('Editor','User','Editor@Email.com','Editor','$2y$12$UVoj0opWrxwx91xlfplhYet3NyhfuCJY/h3NR6/ey/VwmNyTNxyRe','UVoj0opWrxwx91xlfplhYq',2), 
('Viewer','User','Viewer@Email.com','Viewer','$2y$12$UVoj0opWrxwx91xlfplhYet3NyhfuCJY/h3NR6/ey/VwmNyTNxyRe','UVoj0opWrxwx91xlfplhYq',3);

insert into tbl_doc_category
(fldCategory)
values
("Sustainability: Policy"),
("Sustainability: Other");

insert into tbl_doc_type
(fldType)
values
("None"), 
("Incident"), 
("Hazard"), 
("Near-Miss");

insert into tbl_block 
(fldLocation, fldPosiX1, fldPosiY1, fldPosiX2, fldPosiY2) 
values 
("A Block", 500, 690, 570, 755),
("B Block", 595, 640, 750, 710),
("C Block", 650, 1030, 500, 1145),
("D Block", 820, 1230, 620, 1150),
("F Block", 633, 776, 519, 981),
("G Block", 665, 970, 770, 1030),
("H Block", 770, 970, 665, 910),
("J Block", 770, 910, 665, 855),
("K Block", 665, 770, 770, 855),
("L Block", 760, 625, 595, 460),
("M Block", 530, 620, 440, 685),
("N Block", 395, 310, 545, 380),
("O Block", 860, 890, 795, 790),
("P Block", 860, 995, 795, 885);

insert into tbl_whs_type
(fldType)
values
("Injury"),
("Hazard"), 
("Near-Miss"),
("Other");

insert into tbl_sus
(fldProjectName)
values
("Project-1"),
("Project-2"),
("Project-3"),
("Project-4"),
("Project-5"),
("Project-6"),
("Project-7"),
("Project-8"),
("Project-9");

insert into tbl_sus_block_bridge
(fldFkBlockID, fldFKSusID)
values
("1", "2"),
("2", "1"),
("3", "8"),
("4", "6"),
("5", "12"),
("6", "4"),
("7", "10"),
("8", "7"),
("9", "11");

insert into tbl_whs
(fldTitle, fldFkWhsTypeId, fldFkBlockId)
values
("Unironic Memes","2","11"),
("The flying Spaghett monster","3","7"),
("Autism Attack","4","4"),
("Kanes Hair","2","6"),
("What umm ok is that enough *giggle*","3","1"),
("hmm *glances* what whaat *exhale* chocolates","1","12"),
("duh, duh, duh, duh","1","5"),
("The comments on Pornhub video","4","7"),
("If i could stick my penor in ur vaginor","3","8"),
("Milo Yianopolos","2","4");
