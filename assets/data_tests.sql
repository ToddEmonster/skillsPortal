-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 27, 2021 at 11:24 PM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `skills_portal`
--

--
-- Dumping data for table `user`
--

-- USERS -- 
--
-- Truncate table before insert `user`
--
TRUNCATE TABLE `user`;
--
-- Dumping data for table `user`
--
INSERT INTO `user` (`id`, `profile_id`, `email`, `roles`, `password`, `firstname`, `lastname`) VALUES
(1, NULL, 'crepe@yahoo.fr', '[\"ROLE_TECH\", \"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$FlyD1AgH1L421mt4dPUTkQ$YF4SvQRa0wg8ql0Pfs/FII/yYNAoD9+eLoJiIopa0h4', 'Georgette', 'Crêpe'),
(2, NULL, 'newbie@googl.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$oPWzn9aM3UENuhCzpN5tBA$aUjx+7J38HKzYf9tpX4k2RVVuF92lIGSfQEuZZCe3ww', 'Newbie', 'Newbieman'),
(3, NULL, 'admin@admin.fr', '[\"ROLE_ADMIN\", \"ROLE_STRUCT\", \"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$kdaTpl47g6qSk7maaC43SQ$erzpRmm54765twRdDbahAsFU7bpG1wl5OKWRKFGFzn4', 'Jade', 'Ministre'),
(4, NULL, 'pacome@hercial.fr', '[\"ROLE_STRUCT\", \"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$LXjkjPhhnl8jFmq8NKYZHQ$sgAGtYfKkevwWFYS2IURkglhN5gJB1clpMyijBMJDH4', 'Pacôme', 'Hercial'),
(5, NULL, 'chaise@teck.ch', '[\"ROLE_ADMIN\", \"ROLE_TECH\", \"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$IDEhKF6hMYd5wrRHZjV98w$4E8Fkg3vJMCPQgvsk3/3+15tLevHEljFgZzK0kr1AfE', 'Sylvestre', 'Sanchez');


-- PROFILES --
--
-- Truncate table before insert `profile`
--
TRUNCATE TABLE `profile`;
--
-- Dumping data for table `profile`
--
INSERT INTO `profile` (`id`, `user_id`, `first_name`, `last_name`, `job_title`, `email`, `tel`, `creation_date`, `last_edit_date`, `address`, `postal_code`, `city`, `apside_birthday`, `is_collaborator`) VALUES
(1, 1, 'Georgette', 'Crêpe', 'Développeuse web', 'crepe@yahoo.fr', '0123456789', '2021-06-28 01:28:23', '2021-06-28 01:28:23', NULL, NULL, NULL, NULL, 1),
(2, 2, 'Candide', 'Hatt', 'Développeur backend', 'newbie@googl.com', '0100002345', '2021-06-28 01:28:23', '2021-06-28 01:28:23', NULL, NULL, NULL, NULL, 0),
(3, 4, 'Sylvestre', 'Sanchez', 'Data analyst', 'chaise@teck.ch', '0100002345', '2021-06-28 01:32:23', '2021-06-28 01:34:00', NULL, NULL, NULL, NULL, 1);


-- COMPANIES --
--
-- Truncate table before insert `company`
--
TRUNCATE TABLE `company`;
--
-- Dumping data for table `company`
--
INSERT INTO `company` (`id`, `name`, `sector`, `address`, `tel`, `website`) VALUES
(1, 'Apside', 'ESN', NULL, NULL, NULL),
(2, 'Geovelo', 'ESN', NULL, NULL, NULL),
(3, 'Makina Corpus', 'Cartographie', NULL, NULL, NULL),
(4, 'Sopra Steria', 'ESN', NULL, NULL, NULL),
(5, 'Crêperie Lorient', 'Restauration', NULL, NULL, NULL);


-- EXPERIENCES --
--
-- Truncate table before insert `experience`
--

TRUNCATE TABLE `experience`;
--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `profile_id`, `job_title`, `start_date`, `end_date`, `description`, `company_id`) VALUES
(1, 1, 'Développeuse fullstack ', '2016-02-02', '2018-02-01', 'Mise en place d\'un site web vitrine de la plus grande enseigne de crêpe de Bretagne', 5),
(2, 1, 'Développeuse Web Senior', '2018-03-01', NULL, 'Lead tech de l\'équipe web interne d\'Apside', 1),
(3, 2, 'Développeur backend apprenti', '2017-05-01', '2018-05-01', 'Apprentissage et gestion du backend, de l\'API et de la base de données de l\'entreprise', 2),
(4, 2, 'Développeur backend Junior', '2018-06-01', '2020-12-18', 'Diverses missions internes de maintenance et optimisation de la base de données', 4),
(5, 3, 'Développeur backend ', '2012-02-04', '2013-05-28', 'Diverses missions backend dans de nombreuses technologies.', 4),
(6, 3, 'Data analyst Junior', '2013-06-01', '2015-06-30', 'Analyse de données cartographiques Open Source', 3),
(7, 3, 'Data analyst Senior', '2015-09-01', NULL, 'Lead tech de la Data team Apside', 1);


-- CATEGORIES --
--
-- Truncate table before insert `category`
--

TRUNCATE TABLE `category`;
--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `label`) VALUES
(1, 'Backend'),
(2, 'Frontend'),
(3, 'Data'),
(4, 'Design'),
(5, 'Web'),
(6, 'Framework'),
(7, 'Language'),
(8, 'Library'),
(9, 'GIS'),
(10, 'CMS'),
(11, 'Network'),
(12, 'Environment'),
(13, 'Mobile'),
(14, 'IoT'),
(15, 'IA'),
(16, 'Machine Learning'),
(17, 'Cybersecurity'),
(19, 'Web');

-- SKILLS --
--
-- Truncate table before insert `skill`
--

TRUNCATE TABLE `skill`;
--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `label`) VALUES
(1, 'Python'),
(2, 'Angular'),
(3, 'React'),
(4, 'Javascript'),
(5, 'HTML'),
(6, 'CSS'),
(7, 'PHP'),
(8, 'Symfony'),
(9, 'Laravel'),
(10, 'Flask'),
(11, 'Django'),
(12, 'pandas'),
(13, 'ArcGIS'),
(14, 'QGIS'),
(15, 'OpenStreetMap'),
(16, 'R'),
(17, 'Java'),
(18, 'Go'),
(19, 'C++'),
(20, 'C#'),
(21, 'React Native'),
(22, 'Android'),
(23, 'iOS'),
(24, 'UNIX'),
(25, 'MySQL'),
(26, 'PostgresQL'),
(27, 'MariaDB'),
(28, 'UML'),
(29, 'WordPress'),
(30, 'Eclipse');


-- SKILL_PROFILE --

TRUNCATE TABLE `skills_of_profile`;
--
-- Dumping data for table `skills_of_profile`
--

-- Georgette --
INSERT INTO `skills_of_profile` (`id`, `profile_id`, `skill_id`, `level`, `affinity`) VALUES
(1, 1, 5, 5, 2),
(2, 1, 6, 5, 2),
(3, 1, 4, 5, 5),
(4, 1, 3, 4, 4),
(5, 1, 2, 4, 3),
(6, 1, 2, 4, 3),
(7, 1, 24, 3, 2);

-- Candide --
INSERT INTO `skills_of_profile` (`id`, `profile_id`, `skill_id`, `level`, `affinity`) VALUES
(1, 1, 5, 5, 2),
(2, 1, 6, 5, 2),
(3, 1, 4, 5, 5),
(4, 1, 3, 4, 4),
(5, 1, 2, 4, 3),
(6, 1, 2, 4, 3),
(7, 1, 24, 3, 2),
(8, 2, 7, 3, 2),
(9, 2, 8, 4, 4),
(10, 2, 1, 3, 5),
(11, 2, 11, 4, 5),
(12, 2, 17, 4, 3),
(13, 2, 25, 3, 2),
(14, 2, 30, 5, 3);

-- Sylvestre --
INSERT INTO `skills_of_profile` (`id`, `profile_id`, `skill_id`, `level`, `affinity`) VALUES
(1, 1, 5, 5, 2),
(2, 1, 6, 5, 2),
(3, 1, 4, 5, 5),
(4, 1, 3, 4, 4),
(5, 1, 2, 4, 3),
(6, 1, 2, 4, 3),
(7, 1, 24, 3, 2),
(8, 2, 7, 3, 2),
(9, 2, 8, 4, 4),
(10, 2, 1, 3, 5),
(11, 2, 11, 4, 5),
(12, 2, 17, 4, 3),
(13, 2, 25, 3, 2),
(14, 2, 30, 5, 3),
(15, 3, 16, 2, 1),
(16, 3, 1, 5, 5),
(17, 3, 13, 3, 3),
(18, 3, 11, 3, 2),
(19, 3, 25, 5, 4),
(20, 3, 26, 5, 4),
(21, 3, 27, 4, 3),
(22, 3, 28, 5, 5);

-- CATEGORY_SKILL --
--
-- Truncate table before insert `category_skill`
--

TRUNCATE TABLE `category_skill`;
--
-- Dumping data for table `category_skill`
--

INSERT INTO `category_skill` (`category_id`, `skill_id`) VALUES
(1, 1),
(1, 2),
(1, 7),
(1, 8),
(1, 9),
(1, 11),
(1, 17),
(1, 19),
(1, 20),
(1, 30),
(3, 1),
(3, 12),
(3, 15),
(3, 16),
(3, 25),
(3, 26),
(3, 27),
(4, 6),
(5, 4),
(5, 5),
(5, 6),
(6, 2),
(6, 3),
(6, 8),
(6, 10),
(6, 11),
(6, 30),
(7, 1),
(7, 4),
(7, 5),
(7, 6),
(7, 7),
(7, 16),
(7, 17),
(7, 18),
(7, 19),
(7, 20),
(7, 28),
(8, 3),
(9, 13),
(9, 14),
(9, 15),
(10, 29),
(12, 22),
(12, 23),
(12, 24);



-- EXPERIENCE_COMPANY --




