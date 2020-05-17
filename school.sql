-- Dumping database structure for school
CREATE DATABASE IF NOT EXISTS `school` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `school`;

-- Dumping structure for table school.app_roles
CREATE TABLE IF NOT EXISTS `app_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
INSERT INTO `app_roles` (`role_id`, `role`) VALUES(1, 'admin'),(2, 'user');

-- Dumping structure for table school.genders
CREATE TABLE IF NOT EXISTS `genders` (
  `gender_id` int(11) NOT NULL AUTO_INCREMENT,
  `gender_label` varchar(255) NOT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
INSERT INTO `genders` (`gender_id`, `gender_label`) VALUES(1, 'M'),(2, 'F');

-- Dumping structure for table school.app_users
CREATE TABLE IF NOT EXISTS `app_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_cin` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `upassword` varchar(255) NOT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subscription_date` date NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `ustatus` tinyint(1) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `user_img` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `user_cin` (`user_cin`),
  KEY `role_id` (`role_id`),
  KEY `gender_id` (`gender_id`),
  CONSTRAINT `app_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `app_roles` (`role_id`) ON DELETE CASCADE,
  CONSTRAINT `app_users_ibfk_2` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
INSERT INTO app_users VALUES(NULL,'XY00','admin',SHA1('admin'),1,'admin@gmail.com','0088993388',CURDATE(),NOW(),1,1,'admin','admin','adresse',CURDATE(),'default_user.png');

-- Dumping structure for table school.app_privileges_groups
CREATE TABLE IF NOT EXISTS `app_privileges_groups` (
  `privilege_id_group` int(11) NOT NULL AUTO_INCREMENT,
  `privilege_group` varchar(255) NOT NULL,
  PRIMARY KEY (`privilege_id_group`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
INSERT INTO `app_privileges_groups` (`privilege_id_group`, `privilege_group`) VALUES
  (1, 'text_group_users'),
  (2, 'text_group_students'),
  (3, 'text_group_payments'),
  (4, 'text_group_roles'),
  (5, 'text_group_teachers'),
  (6, 'text_group_school_years'),
  (7, 'text_group_specialities'),
  (8, 'text_group_sectors'),
  (9, 'text_group_groups');


-- Dumping structure for table school.app_privileges
CREATE TABLE IF NOT EXISTS `app_privileges` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `privilege` varchar(255) NOT NULL,
  `privilege_url` varchar(255) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`privilege_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `app_privileges_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `app_privileges_groups` (`privilege_id_group`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
INSERT INTO `app_privileges` (`privilege_id`, `privilege`, `privilege_url`, `group_id`) VALUES
  (1, 'text_show_users', '/user/default', 1),
  (2, 'text_add_user', '/user/add', 1),
  (3, 'text_show_students', '/student/default', 2),
  (4, 'text_edit_student', '/student/edit', 2),
  (5, 'text_delete_student', '/student/delete', 2),
  (6, 'text_edit_user', '/user/edit', 1),
  (7, 'text_delete_user', '/user/delete', 1),
  (8, 'text_student_info', '/student/info', 2),
  (9, 'text_show_roles', '/role/default', 4),
  (10, 'text_add_role', '/role/add', 4),
  (11, 'text_edit_role', '/role/edit', 4),
  (12, 'text_delete_role', '/role/delete', 4),
  (13, 'text_add_student', '/student/add', 2),
  (14, 'text_change_user_status', '/user/active', 1),
  (15, 'text_show_user_info', '/user/info', 1),
  (16, 'text_register_student', '/student/register', 2),
  (17, 'text_show_payments', '/payment/default', 3),
  (18, 'text_add_payment', '/payment/add', 3),
  (19, 'text_edit_payment', '/payment/edit', 3),
  (20, 'text_delete_payment', '/payment/delete', 3),
  (21, 'text_show_payment_info', '/payment/info', 3),
  (22, 'text_show_teachers', '/teacher/default', 5),
  (23, 'text_add_teacher', '/teacher/add', 5),
  (24, 'text_edit_teacher', '/teacher/edit', 5),
  (25, 'text_delete_teacher', '/teacher/delete', 5),
  (26, 'text_show_teacher_info', '/teacher/info', 5),
  (27, 'text_show_teacher_vacation', '/teacher/vacation', 5),
  (28, 'text_add_vacation', '/teacher/addvacation', 5),
  (29, 'text_edit_vacation', '/teacher/editvacation', 5),
  (30, 'text_delete_vacation', '/teacher/deletevacation', 5),
  (31, 'text_show_school_years', '/year/default', 6),
  (32, 'text_add_school_year', '/year/add', 6),
  (33, 'text_edit_school_year', '/year/edit', 6),
  (34, 'text_delete_school_year', '/year/delete', 6),
  (35, 'text_show_school_year_vacations', '/year/vacation', 6),
  (36, 'text_add_vacation', '/year/addvacation', 6),
  (37, 'text_edit_vacation', '/year/editvacation', 6),
  (38, 'text_delete_vacation', '/year/deletevacation', 6),
  (39, 'text_show_specialities', '/speciality/default', 7),
  (40, 'text_add_speciality', '/speciality/add', 7),
  (41, 'text_edit_speciality', '/speciality/edit', 7),
  (42, 'text_delete_speciality', '/speciality/delete', 7),
  (43, 'text_show_sectors', '/sector/default', 8),
  (44, 'text_add_sector', '/sector/add', 8),
  (45, 'text_edit_sector', '/sector/edit', 8),
  (46, 'text_delete_sector', '/sector/delete', 8),
  (47, 'text_show_groups', '/group/default', 9),
  (48, 'text_add_group', '/group/add', 9),
  (49, 'text_edit_group', '/group/edit', 9),
  (50, 'text_delete_group', '/group/delete', 9),
  (51, 'text_show_modules', '/sector/module', 8),
  (52, 'text_add_module', '/sector/addmodule', 8),
  (53, 'text_edit_module', '/sector/editmodule', 8),
  (54, 'text_delete_module', '/sector/deletemodule', 8),
  (55, 'text_edit_folder', '/student/editfolder', 2),
  (56, 'text_delete_folder', '/student/deletefolder', 2);

-- Dumping structure for table school.app_role_privileges
CREATE TABLE IF NOT EXISTS `app_role_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `privilege_id` (`privilege_id`),
  CONSTRAINT `app_role_privileges_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `app_roles` (`role_id`) ON DELETE CASCADE,
  CONSTRAINT `app_role_privileges_ibfk_2` FOREIGN KEY (`privilege_id`) REFERENCES `app_privileges` (`privilege_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
INSERT INTO `app_role_privileges` (`id`, `role_id`, `privilege_id`) VALUES
  (NULL, 1, 1),
  (NULL, 1, 2),
  (NULL, 1, 3),
  (NULL, 1, 4),
  (NULL, 1, 5),
  (NULL, 1, 6),
  (NULL, 1, 7),
  (NULL, 1, 8),
  (NULL, 1, 9),
  (NULL, 1, 10),
  (NULL, 1, 11),
  (NULL, 1, 12),
  (NULL, 1, 13),
  (NULL, 1, 14),
  (NULL, 1, 15),
  (NULL, 1, 16),
  (NULL, 1, 17),
  (NULL, 1, 18),
  (NULL, 1, 19),
  (NULL, 1, 20),
  (NULL, 1, 21),
  (NULL, 1, 22),
  (NULL, 1, 23),
  (NULL, 1, 24),
  (NULL, 1, 25),
  (NULL, 1, 26),
  (NULL, 1, 27),
  (NULL, 1, 28),
  (NULL, 1, 29),
  (NULL, 1, 30),
  (NULL, 1, 31),
  (NULL, 1, 32),
  (NULL, 1, 33),
  (NULL, 1, 34),
  (NULL, 1, 35),
  (NULL, 1, 36),
  (NULL, 1, 37),
  (NULL, 1, 38),
  (NULL, 1, 39),
  (NULL, 1, 40),
  (NULL, 1, 41),
  (NULL, 1, 42),
  (NULL, 1, 43),
  (NULL, 1, 44),
  (NULL, 1, 45),
  (NULL, 1, 46),
  (NULL, 1, 47),
  (NULL, 1, 48),
  (NULL, 1, 49),
  (NULL, 1, 50),
  (NULL, 1, 51),
  (NULL, 1, 52),
  (NULL, 1, 53),
  (NULL, 1, 54),
  (NULL, 1, 55),
  (NULL, 1, 56);

-- Dumping structure for table school.school_years
CREATE TABLE IF NOT EXISTS `school_years` (
  `school_year_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  PRIMARY KEY (`school_year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table school.level_studied
CREATE TABLE IF NOT EXISTS `level_studied` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_label` varchar(255) NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
INSERT INTO `level_studied` (`level_id`, `level_label`) VALUES
  (1, 'BAC'),
  (2, 'BAC+2'),
  (3, 'BAC+3'),
  (4, 'BAC+4'),
  (5, 'BAC+5');

-- Dumping structure for table school.school_origine
CREATE TABLE IF NOT EXISTS `school_origine` (
  `school_origine_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_origine_name` varchar(255) NOT NULL,
  PRIMARY KEY (`school_origine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
INSERT INTO `school_origine` (`school_origine_id`, `school_origine_name`) VALUES
  (1, 'ISTA'),
  (2, 'EST'),
  (3, 'PRIVE'),
  (4, 'ENSET'),
  (5, 'Autre');

-- Dumping structure for table school.specialities
CREATE TABLE IF NOT EXISTS `specialities` (
  `speciality_id` int(11) NOT NULL AUTO_INCREMENT,
  `speciality_name` varchar(255) NOT NULL,
  PRIMARY KEY (`speciality_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table school.sectors
CREATE TABLE IF NOT EXISTS `sectors` (
  `sector_id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_name` varchar(255) NOT NULL,
  `sector_short_name` varchar(255) DEFAULT NULL,
  `speciality_id` int(11) NOT NULL,
  PRIMARY KEY (`sector_id`),
  KEY `speciality_id` (`speciality_id`),
  CONSTRAINT `sectors_ibfk_1` FOREIGN KEY (`speciality_id`) REFERENCES `specialities` (`speciality_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table school.modules
CREATE TABLE IF NOT EXISTS `modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) NOT NULL,
  `duration` float DEFAULT NULL,
  `sector_id` int(11) NOT NULL,
  PRIMARY KEY (`module_id`),
  KEY `sector_id` (`sector_id`),
  CONSTRAINT `modules_ibfk_1` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`sector_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table school.students
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_cin` varchar(255) NOT NULL,
  `student_first_name` varchar(255) NOT NULL,
  `student_last_name` varchar(255) NOT NULL,
  `student_birthday` date NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_gender_id` int(11) NOT NULL,
  `student_phone` varchar(255) NOT NULL,
  `student_address` varchar(255) NOT NULL,
  `student_city` varchar(255) NOT NULL,
  `student_bachelore` int(11) NOT NULL,
  `registered_date` date NOT NULL,
  `school_origine_id` int(11) NOT NULL,
  `level_studied_id` int(11) NOT NULL,
  `student_img` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `student_cin` (`student_cin`),
  KEY `student_gender_id` (`student_gender_id`),
  KEY `school_origine_id` (`school_origine_id`),
  KEY `level_studied_id` (`level_studied_id`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`student_gender_id`) REFERENCES `genders` (`gender_id`) ON DELETE CASCADE,
  CONSTRAINT `students_ibfk_2` FOREIGN KEY (`school_origine_id`) REFERENCES `school_origine` (`school_origine_id`) ON DELETE CASCADE,
  CONSTRAINT `students_ibfk_3` FOREIGN KEY (`level_studied_id`) REFERENCES `level_studied` (`level_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table school.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `sector_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`),
  KEY `sector_id` (`sector_id`),
  CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`sector_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table school.folders
CREATE TABLE IF NOT EXISTS `folders` (
  `folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`folder_id`),
  KEY `group_id` (`group_id`),
  KEY `school_year_id` (`school_year_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `folders_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE,
  CONSTRAINT `folders_ibfk_2` FOREIGN KEY (`school_year_id`) REFERENCES `school_years` (`school_year_id`) ON DELETE CASCADE,
  CONSTRAINT `folders_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table school.payment_methods
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `method_id` int(11) NOT NULL AUTO_INCREMENT,
  `method_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
INSERT INTO `payment_methods` (`method_id`, `method_desc`) VALUES
  (1, 'text_cash'),
  (2, 'text_transfer'),
  (3, 'text_check');
  

-- Dumping structure for table school.payment_status
CREATE TABLE IF NOT EXISTS `payment_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_label` varchar(255) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
INSERT INTO `payment_status` (`status_id`, `status_label`) VALUES
  (1, 'Paid'),
  (2, 'Unpaid'),
  (3, 'Uncompleted');

-- Dumping structure for table school.reglement_status
CREATE TABLE IF NOT EXISTS `reglement_status` (
  `reglement_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_label` varchar(255) NOT NULL,
  PRIMARY KEY (`reglement_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
INSERT INTO `reglement_status` (`reglement_status_id`, `status_label`) VALUES
  (1, 'text_paid'),
  (2, 'text_in_payment'),
  (3, 'text_deposited'),
  (4, 'text_unpaid');

-- Dumping structure for table school.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `total_amount` double NOT NULL,
  `folder_id` int(11) NOT NULL,
  `payment_status_id` int(11) NOT NULL,
  PRIMARY KEY (`payment_id`),
  UNIQUE KEY `folder_id` (`folder_id`),
  KEY `payment_status_id` (`payment_status_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`folder_id`) ON DELETE CASCADE,
  CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`payment_status_id`) REFERENCES `payment_status` (`status_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table school.detail_payments
CREATE TABLE IF NOT EXISTS `detail_payments` (
  `detail_payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_reference` varchar(255) DEFAULT NULL,
  `received_date` date NOT NULL,
  `execution_date` date DEFAULT NULL,
  `amount_deposit` double NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `porter_first_name` varchar(255) DEFAULT NULL,
  `porter_last_name` varchar(255) DEFAULT NULL,
  `reglement_status_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  PRIMARY KEY (`detail_payment_id`),
  KEY `reglement_status_id` (`reglement_status_id`),
  KEY `payment_method_id` (`payment_method_id`),
  KEY `payment_id` (`payment_id`),
  CONSTRAINT `detail_payments_ibfk_1` FOREIGN KEY (`reglement_status_id`) REFERENCES `reglement_status` (`reglement_status_id`) ON DELETE CASCADE,
  CONSTRAINT `detail_payments_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`method_id`) ON DELETE CASCADE,
  CONSTRAINT `detail_payments_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table school.school_vacations
CREATE TABLE IF NOT EXISTS `school_vacations` (
  `school_vacation_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `school_year_id` int(11) NOT NULL,
  PRIMARY KEY (`school_vacation_id`),
  KEY `school_year_id` (`school_year_id`),
  CONSTRAINT `school_vacations_ibfk_1` FOREIGN KEY (`school_year_id`) REFERENCES `school_years` (`school_year_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table school.teachers
CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_cin` varchar(255) NOT NULL,
  `teacher_first_name` varchar(255) NOT NULL,
  `teacher_last_name` varchar(255) NOT NULL,
  `teacher_birthday` date NOT NULL,
  `teacher_email` varchar(255) NOT NULL,
  `teacher_gender_id` int(11) NOT NULL,
  `teacher_phone` varchar(255) NOT NULL,
  `teacher_address` varchar(255) NOT NULL,
  `teacher_img` varchar(500) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  PRIMARY KEY (`teacher_id`),
  UNIQUE KEY `teacher_cin` (`teacher_cin`),
  KEY `teacher_gender_id` (`teacher_gender_id`),
  CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`teacher_gender_id`) REFERENCES `genders` (`gender_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table school.teacher_vacations
CREATE TABLE IF NOT EXISTS `teacher_vacations` (
  `teacher_vacation_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_year_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` varchar(500) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`teacher_vacation_id`),
  KEY `school_year_id` (`school_year_id`),
  KEY `teacher_id` (`teacher_id`),
  CONSTRAINT `teacher_vacations_ibfk_2` FOREIGN KEY (`school_year_id`) REFERENCES `school_years` (`school_year_id`) ON DELETE CASCADE,
  CONSTRAINT `teacher_vacations_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

