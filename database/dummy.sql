-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2017 at 09:07 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dummy`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_configs`
--

CREATE TABLE `site_configs` (
  `key` varchar(255) NOT NULL,
  `value` text CHARACTER SET utf8 NOT NULL,
  `description` text NOT NULL,
  `sort` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_configs`
--

INSERT INTO `site_configs` (`key`, `value`, `description`, `sort`, `created`, `updated`) VALUES
('Module.ABC_Related', 'ABC Related', 'ABC Related', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.Contact_Information', 'Contact Information', 'Contact Information', 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.DEF_Key_Posts', 'DEF Key Posts', 'Key Posts', 20, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.DEF_Offending_Accounts', 'DEF Total Offending Account', 'DEF Total Offending Account', 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.DEF_Offending_Domains', 'DEF Offending Domains', 'DEF Offending Domains', 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.DEF_Related', 'DEF Related', 'DEF Related', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.Domains_Discovered', 'Domains Discovered', 'Domains Discovered', 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.EPI_Offending_Accounts', 'EPI Total Offending Accounts', 'EPI Total Offending Accounts', 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.EPI_Offending_Domains', 'EPI Offending Domains', 'EPI Offending Domains', 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.EPI_Related', 'EPI Related', 'EPI Related', 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.Fake_Accounts', 'Total Fake Accounts', 'Total Fake Accounts', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.Fake_Accounts_Channel', 'Total Fake Accounts Found - Channel', 'Total Fake Accounts Found - Channel', 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.Fake_Accounts_Found', 'Total Fake Accounts Found', 'Total Fake Accounts Found', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.Fake_Accounts_Reported_Shutdown', 'Total Fake Accounts Reported- Shutdown', 'Total Fake Accounts Reported- Shutdown', 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.GHI_Key_Posts', 'GHI Key Posts', 'GHI Key Posts', 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.GHI_Offending_Accounts', 'GHI Total Offending Account', 'DEF Total Offending Account', 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.GHI_Offending_Domains', 'GHI Offending Domains', 'DEF Offending Domains', 17, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.GHI_Related', 'GHI Related', 'DEF Related', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.Keyword_Monitored', 'Keyword Monitored', 'Keyword Monitored', 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.Posts_Found', 'Total Posts Found', 'Total Posts Found', 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.Reports', 'Reports', 'Reports', 18, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.Total_Names_Tracked', 'Total Names Tracked', 'Total Names Tracked', 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.Urgent_Alerts', 'Urgent Alerts', 'Urgent Alerts', 19, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Module.VVIP_Fake_Accounts', 'ما فائدته ؟', 'VVIP Fake Accounts Found', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Site.DashboardAutorefresh', '1', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Site.Email.Host', 'ssl://smtp.gmail.com', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Site.Email.Password', 'c2VjdXJlbWV0YXN5cw==', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Site.Email.Port', '465', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Site.Email.Username', 'securemetasys.test@gmail.com', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Site.FromEmail', 'info@abcd.com', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Site.FromName', 'ABCD', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Site.Logo', '2015-wallpaper_111525594_269.jpg?1504684743', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Site.Name', 'ABCD', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Site.SupportEmail', 'info@abcd.com', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Site.Timezone', 'Europe/London', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('Site.Url', 'http://google.com/abcd', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `name`) VALUES
(1, 'Africa/Abidjan'),
(2, 'Africa/Accra'),
(3, 'Africa/Addis_Ababa'),
(4, 'Africa/Algiers'),
(5, 'Africa/Asmara'),
(6, 'Africa/Bamako'),
(7, 'Africa/Bangui'),
(8, 'Africa/Banjul'),
(9, 'Africa/Bissau'),
(10, 'Africa/Blantyre'),
(11, 'Africa/Brazzaville'),
(12, 'Africa/Bujumbura'),
(13, 'Africa/Cairo'),
(14, 'Africa/Casablanca'),
(15, 'Africa/Ceuta'),
(16, 'Africa/Conakry'),
(17, 'Africa/Dakar'),
(18, 'Africa/Dar_es_Salaam'),
(19, 'Africa/Djibouti'),
(20, 'Africa/Douala'),
(21, 'Africa/El_Aaiun'),
(22, 'Africa/Freetown'),
(23, 'Africa/Gaborone'),
(24, 'Africa/Harare'),
(25, 'Africa/Johannesburg'),
(26, 'Africa/Juba'),
(27, 'Africa/Kampala'),
(28, 'Africa/Khartoum'),
(29, 'Africa/Kigali'),
(30, 'Africa/Kinshasa'),
(31, 'Africa/Lagos'),
(32, 'Africa/Libreville'),
(33, 'Africa/Lome'),
(34, 'Africa/Luanda'),
(35, 'Africa/Lubumbashi'),
(36, 'Africa/Lusaka'),
(37, 'Africa/Malabo'),
(38, 'Africa/Maputo'),
(39, 'Africa/Maseru'),
(40, 'Africa/Mbabane'),
(41, 'Africa/Mogadishu'),
(42, 'Africa/Monrovia'),
(43, 'Africa/Nairobi'),
(44, 'Africa/Ndjamena'),
(45, 'Africa/Niamey'),
(46, 'Africa/Nouakchott'),
(47, 'Africa/Ouagadougou'),
(48, 'Africa/Porto-Novo'),
(49, 'Africa/Sao_Tome'),
(50, 'Africa/Tripoli'),
(51, 'Africa/Tunis'),
(52, 'Africa/Windhoek'),
(53, 'America/Adak'),
(54, 'America/Anchorage'),
(55, 'America/Anguilla'),
(56, 'America/Antigua'),
(57, 'America/Araguaina'),
(58, 'America/Argentina/Buenos_Aires'),
(59, 'America/Argentina/Catamarca'),
(60, 'America/Argentina/Cordoba'),
(61, 'America/Argentina/Jujuy'),
(62, 'America/Argentina/La_Rioja'),
(63, 'America/Argentina/Mendoza'),
(64, 'America/Argentina/Rio_Gallegos'),
(65, 'America/Argentina/Salta'),
(66, 'America/Argentina/San_Juan'),
(67, 'America/Argentina/San_Luis'),
(68, 'America/Argentina/Tucuman'),
(69, 'America/Argentina/Ushuaia'),
(70, 'America/Aruba'),
(71, 'America/Asuncion'),
(72, 'America/Atikokan'),
(73, 'America/Bahia'),
(74, 'America/Bahia_Banderas'),
(75, 'America/Barbados'),
(76, 'America/Belem'),
(77, 'America/Belize'),
(78, 'America/Blanc-Sablon'),
(79, 'America/Boa_Vista'),
(80, 'America/Bogota'),
(81, 'America/Boise'),
(82, 'America/Cambridge_Bay'),
(83, 'America/Campo_Grande'),
(84, 'America/Cancun'),
(85, 'America/Caracas'),
(86, 'America/Cayenne'),
(87, 'America/Cayman'),
(88, 'America/Chicago'),
(89, 'America/Chihuahua'),
(90, 'America/Costa_Rica'),
(91, 'America/Creston'),
(92, 'America/Cuiaba'),
(93, 'America/Curacao'),
(94, 'America/Danmarkshavn'),
(95, 'America/Dawson'),
(96, 'America/Dawson_Creek'),
(97, 'America/Denver'),
(98, 'America/Detroit'),
(99, 'America/Dominica'),
(100, 'America/Edmonton'),
(101, 'America/Eirunepe'),
(102, 'America/El_Salvador'),
(103, 'America/Fort_Nelson'),
(104, 'America/Fortaleza'),
(105, 'America/Glace_Bay'),
(106, 'America/Godthab'),
(107, 'America/Goose_Bay'),
(108, 'America/Grand_Turk'),
(109, 'America/Grenada'),
(110, 'America/Guadeloupe'),
(111, 'America/Guatemala'),
(112, 'America/Guayaquil'),
(113, 'America/Guyana'),
(114, 'America/Halifax'),
(115, 'America/Havana'),
(116, 'America/Hermosillo'),
(117, 'America/Indiana/Indianapolis'),
(118, 'America/Indiana/Knox'),
(119, 'America/Indiana/Marengo'),
(120, 'America/Indiana/Petersburg'),
(121, 'America/Indiana/Tell_City'),
(122, 'America/Indiana/Vevay'),
(123, 'America/Indiana/Vincennes'),
(124, 'America/Indiana/Winamac'),
(125, 'America/Inuvik'),
(126, 'America/Iqaluit'),
(127, 'America/Jamaica'),
(128, 'America/Juneau'),
(129, 'America/Kentucky/Louisville'),
(130, 'America/Kentucky/Monticello'),
(131, 'America/Kralendijk'),
(132, 'America/La_Paz'),
(133, 'America/Lima'),
(134, 'America/Los_Angeles'),
(135, 'America/Lower_Princes'),
(136, 'America/Maceio'),
(137, 'America/Managua'),
(138, 'America/Manaus'),
(139, 'America/Marigot'),
(140, 'America/Martinique'),
(141, 'America/Matamoros'),
(142, 'America/Mazatlan'),
(143, 'America/Menominee'),
(144, 'America/Merida'),
(145, 'America/Metlakatla'),
(146, 'America/Mexico_City'),
(147, 'America/Miquelon'),
(148, 'America/Moncton'),
(149, 'America/Monterrey'),
(150, 'America/Montevideo'),
(151, 'America/Montserrat'),
(152, 'America/Nassau'),
(153, 'America/New_York" selected="selected'),
(154, 'America/Nipigon'),
(155, 'America/Nome'),
(156, 'America/Noronha'),
(157, 'America/North_Dakota/Beulah'),
(158, 'America/North_Dakota/Center'),
(159, 'America/North_Dakota/New_Salem'),
(160, 'America/Ojinaga'),
(161, 'America/Panama'),
(162, 'America/Pangnirtung'),
(163, 'America/Paramaribo'),
(164, 'America/Phoenix'),
(165, 'America/Port-au-Prince'),
(166, 'America/Port_of_Spain'),
(167, 'America/Porto_Velho'),
(168, 'America/Puerto_Rico'),
(169, 'America/Rainy_River'),
(170, 'America/Rankin_Inlet'),
(171, 'America/Recife'),
(172, 'America/Regina'),
(173, 'America/Resolute'),
(174, 'America/Rio_Branco'),
(175, 'America/Santarem'),
(176, 'America/Santiago'),
(177, 'America/Santo_Domingo'),
(178, 'America/Sao_Paulo'),
(179, 'America/Scoresbysund'),
(180, 'America/Sitka'),
(181, 'America/St_Barthelemy'),
(182, 'America/St_Johns'),
(183, 'America/St_Kitts'),
(184, 'America/St_Lucia'),
(185, 'America/St_Thomas'),
(186, 'America/St_Vincent'),
(187, 'America/Swift_Current'),
(188, 'America/Tegucigalpa'),
(189, 'America/Thule'),
(190, 'America/Thunder_Bay'),
(191, 'America/Tijuana'),
(192, 'America/Toronto'),
(193, 'America/Tortola'),
(194, 'America/Vancouver'),
(195, 'America/Whitehorse'),
(196, 'America/Winnipeg'),
(197, 'America/Yakutat'),
(198, 'America/Yellowknife'),
(199, 'Antarctica/Casey'),
(200, 'Antarctica/Davis'),
(201, 'Antarctica/DumontDUrville'),
(202, 'Antarctica/Macquarie'),
(203, 'Antarctica/Mawson'),
(204, 'Antarctica/McMurdo'),
(205, 'Antarctica/Palmer'),
(206, 'Antarctica/Rothera'),
(207, 'Antarctica/Syowa'),
(208, 'Antarctica/Troll'),
(209, 'Antarctica/Vostok'),
(210, 'Arctic/Longyearbyen'),
(211, 'Asia/Aden'),
(212, 'Asia/Almaty'),
(213, 'Asia/Amman'),
(214, 'Asia/Anadyr'),
(215, 'Asia/Aqtau'),
(216, 'Asia/Aqtobe'),
(217, 'Asia/Ashgabat'),
(218, 'Asia/Atyrau'),
(219, 'Asia/Baghdad'),
(220, 'Asia/Bahrain'),
(221, 'Asia/Baku'),
(222, 'Asia/Bangkok'),
(223, 'Asia/Barnaul'),
(224, 'Asia/Beirut'),
(225, 'Asia/Bishkek'),
(226, 'Asia/Brunei'),
(227, 'Asia/Chita'),
(228, 'Asia/Choibalsan'),
(229, 'Asia/Colombo'),
(230, 'Asia/Damascus'),
(231, 'Asia/Dhaka'),
(232, 'Asia/Dili'),
(233, 'Asia/Dubai'),
(234, 'Asia/Dushanbe'),
(235, 'Asia/Famagusta'),
(236, 'Asia/Gaza'),
(237, 'Asia/Hebron'),
(238, 'Asia/Ho_Chi_Minh'),
(239, 'Asia/Hong_Kong'),
(240, 'Asia/Hovd'),
(241, 'Asia/Irkutsk'),
(242, 'Asia/Jakarta'),
(243, 'Asia/Jayapura'),
(244, 'Asia/Jerusalem'),
(245, 'Asia/Kabul'),
(246, 'Asia/Kamchatka'),
(247, 'Asia/Karachi'),
(248, 'Asia/Kathmandu'),
(249, 'Asia/Khandyga'),
(250, 'Asia/Kolkata'),
(251, 'Asia/Krasnoyarsk'),
(252, 'Asia/Kuala_Lumpur'),
(253, 'Asia/Kuching'),
(254, 'Asia/Kuwait'),
(255, 'Asia/Macau'),
(256, 'Asia/Magadan'),
(257, 'Asia/Makassar'),
(258, 'Asia/Manila'),
(259, 'Asia/Muscat'),
(260, 'Asia/Nicosia'),
(261, 'Asia/Novokuznetsk'),
(262, 'Asia/Novosibirsk'),
(263, 'Asia/Omsk'),
(264, 'Asia/Oral'),
(265, 'Asia/Phnom_Penh'),
(266, 'Asia/Pontianak'),
(267, 'Asia/Pyongyang'),
(268, 'Asia/Qatar'),
(269, 'Asia/Qyzylorda'),
(270, 'Asia/Riyadh'),
(271, 'Asia/Sakhalin'),
(272, 'Asia/Samarkand'),
(273, 'Asia/Seoul'),
(274, 'Asia/Shanghai'),
(275, 'Asia/Singapore'),
(276, 'Asia/Srednekolymsk'),
(277, 'Asia/Taipei'),
(278, 'Asia/Tashkent'),
(279, 'Asia/Tbilisi'),
(280, 'Asia/Tehran'),
(281, 'Asia/Thimphu'),
(282, 'Asia/Tokyo'),
(283, 'Asia/Tomsk'),
(284, 'Asia/Ulaanbaatar'),
(285, 'Asia/Urumqi'),
(286, 'Asia/Ust-Nera'),
(287, 'Asia/Vientiane'),
(288, 'Asia/Vladivostok'),
(289, 'Asia/Yakutsk'),
(290, 'Asia/Yangon'),
(291, 'Asia/Yekaterinburg'),
(292, 'Asia/Yerevan'),
(293, 'Atlantic/Azores'),
(294, 'Atlantic/Bermuda'),
(295, 'Atlantic/Canary'),
(296, 'Atlantic/Cape_Verde'),
(297, 'Atlantic/Faroe'),
(298, 'Atlantic/Madeira'),
(299, 'Atlantic/Reykjavik'),
(300, 'Atlantic/South_Georgia'),
(301, 'Atlantic/St_Helena'),
(302, 'Atlantic/Stanley'),
(303, 'Australia/Adelaide'),
(304, 'Australia/Brisbane'),
(305, 'Australia/Broken_Hill'),
(306, 'Australia/Currie'),
(307, 'Australia/Darwin'),
(308, 'Australia/Eucla'),
(309, 'Australia/Hobart'),
(310, 'Australia/Lindeman'),
(311, 'Australia/Lord_Howe'),
(312, 'Australia/Melbourne'),
(313, 'Australia/Perth'),
(314, 'Australia/Sydney'),
(315, 'Europe/Amsterdam'),
(316, 'Europe/Andorra'),
(317, 'Europe/Astrakhan'),
(318, 'Europe/Athens'),
(319, 'Europe/Belgrade'),
(320, 'Europe/Berlin'),
(321, 'Europe/Bratislava'),
(322, 'Europe/Brussels'),
(323, 'Europe/Bucharest'),
(324, 'Europe/Budapest'),
(325, 'Europe/Busingen'),
(326, 'Europe/Chisinau'),
(327, 'Europe/Copenhagen'),
(328, 'Europe/Dublin'),
(329, 'Europe/Gibraltar'),
(330, 'Europe/Guernsey'),
(331, 'Europe/Helsinki'),
(332, 'Europe/Isle_of_Man'),
(333, 'Europe/Istanbul'),
(334, 'Europe/Jersey'),
(335, 'Europe/Kaliningrad'),
(336, 'Europe/Kiev'),
(337, 'Europe/Kirov'),
(338, 'Europe/Lisbon'),
(339, 'Europe/Ljubljana'),
(340, 'Europe/London'),
(341, 'Europe/Luxembourg'),
(342, 'Europe/Madrid'),
(343, 'Europe/Malta'),
(344, 'Europe/Mariehamn'),
(345, 'Europe/Minsk'),
(346, 'Europe/Monaco'),
(347, 'Europe/Moscow'),
(348, 'Europe/Oslo'),
(349, 'Europe/Paris'),
(350, 'Europe/Podgorica'),
(351, 'Europe/Prague'),
(352, 'Europe/Riga'),
(353, 'Europe/Rome'),
(354, 'Europe/Samara'),
(355, 'Europe/San_Marino'),
(356, 'Europe/Sarajevo'),
(357, 'Europe/Saratov'),
(358, 'Europe/Simferopol'),
(359, 'Europe/Skopje'),
(360, 'Europe/Sofia'),
(361, 'Europe/Stockholm'),
(362, 'Europe/Tallinn'),
(363, 'Europe/Tirane'),
(364, 'Europe/Ulyanovsk'),
(365, 'Europe/Uzhgorod'),
(366, 'Europe/Vaduz'),
(367, 'Europe/Vatican'),
(368, 'Europe/Vienna'),
(369, 'Europe/Vilnius'),
(370, 'Europe/Volgograd'),
(371, 'Europe/Warsaw'),
(372, 'Europe/Zagreb'),
(373, 'Europe/Zaporozhye'),
(374, 'Europe/Zurich'),
(375, 'Indian/Antananarivo'),
(376, 'Indian/Chagos'),
(377, 'Indian/Christmas'),
(378, 'Indian/Cocos'),
(379, 'Indian/Comoro'),
(380, 'Indian/Kerguelen'),
(381, 'Indian/Mahe'),
(382, 'Indian/Maldives'),
(383, 'Indian/Mauritius'),
(384, 'Indian/Mayotte'),
(385, 'Indian/Reunion'),
(386, 'Pacific/Apia'),
(387, 'Pacific/Auckland'),
(388, 'Pacific/Bougainville'),
(389, 'Pacific/Chatham'),
(390, 'Pacific/Chuuk'),
(391, 'Pacific/Easter'),
(392, 'Pacific/Efate'),
(393, 'Pacific/Enderbury'),
(394, 'Pacific/Fakaofo'),
(395, 'Pacific/Fiji'),
(396, 'Pacific/Funafuti'),
(397, 'Pacific/Galapagos'),
(398, 'Pacific/Gambier'),
(399, 'Pacific/Guadalcanal'),
(400, 'Pacific/Guam'),
(401, 'Pacific/Honolulu'),
(402, 'Pacific/Johnston'),
(403, 'Pacific/Kiritimati'),
(404, 'Pacific/Kosrae'),
(405, 'Pacific/Kwajalein'),
(406, 'Pacific/Majuro'),
(407, 'Pacific/Marquesas'),
(408, 'Pacific/Midway'),
(409, 'Pacific/Nauru'),
(410, 'Pacific/Niue'),
(411, 'Pacific/Norfolk'),
(412, 'Pacific/Noumea'),
(413, 'Pacific/Pago_Pago'),
(414, 'Pacific/Palau'),
(415, 'Pacific/Pitcairn'),
(416, 'Pacific/Pohnpei'),
(417, 'Pacific/Port_Moresby'),
(418, 'Pacific/Rarotonga'),
(419, 'Pacific/Saipan'),
(420, 'Pacific/Tahiti'),
(421, 'Pacific/Tarawa'),
(422, 'Pacific/Tongatapu'),
(423, 'Pacific/Wake'),
(424, 'Pacific/Wallis'),
(425, 'UTC');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `email_config` varchar(255) NOT NULL,
  `email_password` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'employee',
  `photo` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_no`, `password`, `email_address`, `email_config`, `email_password`, `status`, `role`, `photo`, `created`, `updated`) VALUES
(1, 'Testing', 'User', 'info@securemetasys.com', '971423001424', '453dcc12c14a599d5e6ca8350e5366debb3e9376', '', '', '', 'active', 'admin', 'canoe_water_nature_221611.jpg', '0000-00-00 00:00:00', '2017-08-31 07:23:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_configs`
--
ALTER TABLE `site_configs`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
