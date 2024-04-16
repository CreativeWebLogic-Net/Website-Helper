-- Bubble CMS MySQL Install script

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


--


-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `administratorActive` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `SU` enum('Yes','No','CWL') NOT NULL DEFAULT 'No',
  `clientsID` int(11) NOT NULL DEFAULT '1',
  `hash` varchar(111) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `name`, `email`, `username`, `password`, `administratorActive`, `SU`, `clientsID`, `hash`) VALUES
(1, 'Daniel Ruul', 'dpr@w-d.biz', 'dino', 'password', 0, 'Yes', 11, '');

-- --------------------------------------------------------

--
-- Table structure for table `administrators_domains`
--

CREATE TABLE `administrators_domains` (
  `id` int(11) NOT NULL,
  `administratorsID` int(11) NOT NULL,
  `domainsID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrators_domains`
--

INSERT INTO `administrators_domains` (`id`, `administratorsID`, `domainsID`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `assetfolders`
--

CREATE TABLE `assetfolders` (
  `id` int(11) NOT NULL,
  `ClientsID` int(11) NOT NULL DEFAULT '0',
  `Parent` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assetfolders`
--

INSERT INTO `assetfolders` (`id`, `ClientsID`, `Parent`, `Name`) VALUES
(17, 1, 0, 'images');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `AssetFoldersID` int(11) NOT NULL DEFAULT '0',
  `FileName` varchar(100) NOT NULL DEFAULT '',
  `Description` tinytext NOT NULL,
  `Type` enum('image','flash') NOT NULL DEFAULT 'image'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `Name`) VALUES
(1, 'Creative Web Logic');

-- --------------------------------------------------------

--
-- Table structure for table `content_pages`
--

CREATE TABLE `content_pages` (
  `id` int(11) NOT NULL,
  `URI` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `Title` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `MenuTitle` varchar(100) COLLATE latin1_german2_ci NOT NULL DEFAULT '',
  `languagesID` int(11) NOT NULL DEFAULT '1',
  `Changed` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `domainsID` int(11) NOT NULL,
  `templatesID` int(11) NOT NULL DEFAULT '0',
  `module_viewsID` int(11) NOT NULL DEFAULT '1',
  `Meta_Keywords` tinytext COLLATE latin1_german2_ci NOT NULL,
  `Meta_Description` tinytext COLLATE latin1_german2_ci NOT NULL,
  `Meta_Title` tinytext COLLATE latin1_german2_ci NOT NULL,
  `Exposure` enum('Public','Member','Both') COLLATE latin1_german2_ci NOT NULL DEFAULT 'Both',
  `Menu_Hide` enum('Yes','No') COLLATE latin1_german2_ci NOT NULL DEFAULT 'No',
  `HomePage` enum('Yes','No') COLLATE latin1_german2_ci NOT NULL DEFAULT 'No',
  `Sort_Order` int(5) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `content_pages`
--

INSERT INTO `content_pages` (`id`, `URI`, `Title`, `MenuTitle`, `languagesID`, `Changed`, `domainsID`, `templatesID`, `module_viewsID`, `Meta_Keywords`, `Meta_Description`, `Meta_Title`, `Exposure`, `Menu_Hide`, `HomePage`, `Sort_Order`) VALUES
(1, '/', 'Home DynDNS', 'Home', 1, '2009-05-13 05:00:00', 1, 0, 1, '', '', '', 'Public', 'No', 'Yes', 0);
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `Country_Code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `Country_Name` varchar(111) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `Country_Code`, `Country_Name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AX', 'Aland Islands'),
(3, 'AL', 'Albania'),
(4, 'DZ', 'Algeria'),
(5, 'AS', 'American Samoa'),
(6, 'AD', 'Andorra'),
(7, 'AO', 'Angola'),
(8, 'AI', 'Anguilla'),
(9, 'AQ', 'Antarctica'),
(10, 'AG', 'Antigua and Barbuda'),
(11, 'AR', 'Argentina'),
(12, 'AM', 'Armenia'),
(13, 'AW', 'Aruba'),
(14, 'AU', 'Australia'),
(15, 'AT', 'Austria'),
(16, 'AZ', 'Azerbaijan'),
(17, 'BS', 'Bahamas'),
(18, 'BH', 'Bahrain'),
(19, 'BD', 'Bangladesh'),
(20, 'BB', 'Barbados'),
(21, 'BY', 'Belarus'),
(22, 'BE', 'Belgium'),
(23, 'BZ', 'Belize'),
(24, 'BJ', 'Benin'),
(25, 'BM', 'Bermuda'),
(26, 'BT', 'Bhutan'),
(27, 'BO', 'Bolivia'),
(28, 'BA', 'Bosnia and Herzegovina'),
(29, 'BW', 'Botswana'),
(30, 'BV', 'Bouvet Island'),
(31, 'BR', 'Brazil'),
(32, 'IO', 'British Indian Ocean Territory'),
(33, 'BN', 'Brunei Darussalam'),
(34, 'BG', 'Bulgaria'),
(35, 'BF', 'Burkina Faso'),
(36, 'BI', 'Burundi'),
(37, 'KH', 'Cambodia'),
(38, 'CM', 'Cameroon'),
(39, 'CA', 'Canada'),
(40, 'CV', 'Cape Verde'),
(41, 'KY', 'Cayman Islands'),
(42, 'CF', 'Central African Republic'),
(43, 'TD', 'Chad'),
(44, 'CL', 'Chile'),
(45, 'CN', 'China'),
(46, 'CX', 'Christmas Island'),
(47, 'CC', 'Cocos (Keeling) Islands'),
(48, 'CO', 'Colombia'),
(49, 'KM', 'Comoros'),
(50, 'CG', 'Congo'),
(51, 'CD', 'Congo  The Democratic Republic of The'),
(52, 'CK', 'Cook Islands'),
(53, 'CR', 'Costa Rica'),
(54, 'CI', 'Cote D\'ivoire'),
(55, 'HR', 'Croatia'),
(56, 'CU', 'Cuba'),
(57, 'CY', 'Cyprus'),
(58, 'CZ', 'Czechia'),
(59, 'DK', 'Denmark'),
(60, 'DJ', 'Djibouti'),
(61, 'DM', 'Dominica'),
(62, 'DO', 'Dominican Republic'),
(63, 'EC', 'Ecuador'),
(64, 'EG', 'Egypt'),
(65, 'SV', 'El Salvador'),
(66, 'GQ', 'Equatorial Guinea'),
(67, 'ER', 'Eritrea'),
(68, 'EE', 'Estonia'),
(69, 'ET', 'Ethiopia'),
(70, 'FK', 'Falkland Islands (Malvinas)'),
(71, 'FO', 'Faroe Islands'),
(72, 'FJ', 'Fiji'),
(73, 'FI', 'Finland'),
(74, 'FR', 'France'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GG', 'Guernsey'),
(91, 'GN', 'Guinea'),
(92, 'GW', 'Guinea-bissau'),
(93, 'GY', 'Guyana'),
(94, 'HT', 'Haiti'),
(95, 'HM', 'Heard Island and Mcdonald Islands'),
(96, 'VA', 'Holy See (Vatican City State)'),
(97, 'HN', 'Honduras'),
(98, 'HK', 'Hong Kong'),
(99, 'HU', 'Hungary'),
(100, 'IS', 'Iceland'),
(101, 'IN', 'India'),
(102, 'ID', 'Indonesia'),
(103, 'IR', 'Iran  Islamic Republic of'),
(104, 'IQ', 'Iraq'),
(105, 'IE', 'Ireland'),
(106, 'IM', 'Isle of Man'),
(107, 'IL', 'Israel'),
(108, 'IT', 'Italy'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JE', 'Jersey'),
(112, 'JO', 'Jordan'),
(113, 'KZ', 'Kazakhstan'),
(114, 'KE', 'Kenya'),
(115, 'KI', 'Kiribati'),
(116, 'KP', 'Korea  Democratic People\'s Republic of'),
(117, 'KR', 'Korea  Republic of'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macao'),
(130, 'MK', 'Macedonia  The Former Yugoslav Republic of'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'YT', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia  Federated States of'),
(144, 'MD', 'Moldova  Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestinian Territory  Occupied'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'SH', 'Saint Helena'),
(185, 'KN', 'Saint Kitts and Nevis'),
(186, 'LC', 'Saint Lucia'),
(187, 'PM', 'Saint Pierre and Miquelon'),
(188, 'VC', 'Saint Vincent and The Grenadines'),
(189, 'WS', 'Samoa'),
(190, 'SM', 'San Marino'),
(191, 'ST', 'Sao Tome and Principe'),
(192, 'SA', 'Saudi Arabia'),
(193, 'SN', 'Senegal'),
(194, 'RS', 'Serbia'),
(195, 'SC', 'Seychelles'),
(196, 'SL', 'Sierra Leone'),
(197, 'SG', 'Singapore'),
(198, 'SK', 'Slovakia'),
(199, 'SI', 'Slovenia'),
(200, 'SB', 'Solomon Islands'),
(201, 'SO', 'Somalia'),
(202, 'ZA', 'South Africa'),
(203, 'GS', 'South Georgia and The South Sandwich Islands'),
(204, 'ES', 'Spain'),
(205, 'LK', 'Sri Lanka'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan  Province of China'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania  United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TL', 'Timor-leste'),
(218, 'TG', 'Togo'),
(219, 'TK', 'Tokelau'),
(220, 'TO', 'Tonga'),
(221, 'TT', 'Trinidad and Tobago'),
(222, 'TN', 'Tunisia'),
(223, 'TR', 'Turkey'),
(224, 'TM', 'Turkmenistan'),
(225, 'TC', 'Turks and Caicos Islands'),
(226, 'TV', 'Tuvalu'),
(227, 'UG', 'Uganda'),
(228, 'UA', 'Ukraine'),
(229, 'AE', 'United Arab Emirates'),
(230, 'GB', 'United Kingdom'),
(231, 'US', 'United States'),
(232, 'UM', 'United States Minor Outlying Islands'),
(233, 'UY', 'Uruguay'),
(234, 'UZ', 'Uzbekistan'),
(235, 'VU', 'Vanuatu'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Viet Nam'),
(238, 'VG', 'Virgin Islands  British'),
(239, 'VI', 'Virgin Islands  U.S.'),
(240, 'WF', 'Wallis and Futuna'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZM', 'Zambia'),
(244, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Analytics` mediumtext NOT NULL,
  `GSiteMapMeta` varchar(200) NOT NULL,
  `SiteTitle` varchar(50) DEFAULT NULL,
  `ClientsID` int(11) NOT NULL DEFAULT '1',
  `AEmail` varchar(50) NOT NULL DEFAULT 'danielruul78@gmail.com',
  `templatesID` int(11) NOT NULL DEFAULT '1',
  `serversID` int(11) NOT NULL,
  `mirrorID` int(11) NOT NULL DEFAULT '0',
  `Public` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `Name`, `Analytics`, `GSiteMapMeta`, `SiteTitle`, `ClientsID`, `AEmail`, `templatesID`, `serversID`, `mirrorID`, `Public`) VALUES
(1, 'localhost', '', '', 'Local Host Home', 8, 'info@creativeweblogic.net', 1, 1, 0, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `domains_modules`
--

CREATE TABLE `domains_modules` (
  `id` int(11) NOT NULL,
  `domainsID` int(11) NOT NULL,
  `modulesID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `domains_modules`
--

INSERT INTO `domains_modules` (`id`, `domainsID`, `modulesID`) VALUES
(1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `Name`) VALUES
(1, 'English'),
(0, 'French');

-- --------------------------------------------------------

--
-- Table structure for table `languages_definition`
--

CREATE TABLE `languages_definition` (
  `id` int(11) NOT NULL,
  `Code` varchar(50) NOT NULL,
  `templatesID` int(11) NOT NULL DEFAULT '1',
  `languagesID` int(11) NOT NULL DEFAULT '1',
  `Definition` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages_definition`
--

INSERT INTO `languages_definition` (`id`, `Code`, `templatesID`, `languagesID`, `Definition`) VALUES
(1, 'welcome', 1, 1, 'Welcome');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Dir` varchar(100) NOT NULL,
  `optional` enum('Yes','No') NOT NULL DEFAULT 'Yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `Name`, `Dir`, `optional`) VALUES
(1, 'Text Content', 'text', 'No'),
(2, 'Member', 'member', 'Yes'),
(3, 'News', 'news', 'Yes'),
(555, 'Contact', 'contact', 'No'),
(560, 'Banners', 'banner', 'Yes'),
(600, 'install', 'install', 'Yes'),
(800, 'Website Error Codes', 'error_codes', 'Yes'),
(4, 'SiteMap', 'site_map', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `module_views`
--

CREATE TABLE `module_views` (
  `id` int(11) NOT NULL,
  `modulesID` int(11) NOT NULL,
  `Pre_FileName` varchar(50) NOT NULL,
  `FileName` varchar(50) NOT NULL,
  `ViewName` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_views`
--

INSERT INTO `module_views` (`id`, `modulesID`, `Pre_FileName`, `FileName`, `ViewName`) VALUES
(1, 1, 'pre_display.php', 'display.php', 'Text Content'),
(21, 2, 'pre_login.php', 'login.php', 'Member Login'),
(31, 3, 'pre_display.php', 'display.php', 'Show News Detail'),
(22, 2, 'pre-register.php', 'register.php', 'Business Registration Page'),
(221, 2, '', 'biz_directory.php', 'Business Directory'),
(25, 2, '', 'member-home.php', 'Member Home'),
(222, 2, 'pre-user-details.php', 'user-details.php', 'User Details'),
(223, 2, 'pre_logout.php', 'logout.php', 'Logout'),
(224, 2, 'pre-fpass.php', 'fpass.php', 'Forgot Password'),
(211, 2, '', 'tellfriend.php', 'Tell A Friend'),
(332, 3, '', 'view-news.php', 'Member View News'),
(333, 3, '', 'modify-news.php', 'Member Modify News'),
(334, 3, '', 'add-news.php', 'Add Member News'),
(335, 3, '', 'rss.php', 'RSS Output'),
(5551, 555, 'pre-contact-form.php', 'contact-form.php', 'Contact Form'),
(601, 600, '', 'step-1.php', 'Step_1'),
(801, 800, '', '404.php', '404 Page Not Found'),
(41, 4, 'pre_display.php', 'display.php', 'display site map'),
(602, 600, 'pre_step-2.php', 'step-2.php', 'Step-2'),
(603, 600, '', 'step-3.php', 'Install Step 3'),
(604, 600, '', 'step-4.php', 'BCMS Install Step 4');

-- --------------------------------------------------------

--
-- Table structure for table `module_views_menu`
--

CREATE TABLE `module_views_menu` (
  `module_viewsID` int(11) NOT NULL,
  `Exposure` enum('Public','Member','Both') NOT NULL DEFAULT 'Public'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module_views_menu`
--

INSERT INTO `module_views_menu` (`module_viewsID`, `Exposure`) VALUES
(1, 'Public'),
(21, 'Public'),
(221, 'Public'),
(22, 'Public'),
(5551, 'Public'),
(601, 'Public'),
(602, 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `mod_business_categories`
--

CREATE TABLE `mod_business_categories` (
  `id` int(11) NOT NULL,
  `CategoryTitle` varchar(100) NOT NULL,
  `SubDomain` varchar(100) NOT NULL,
  `domainsID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mod_business_categories`
--

INSERT INTO `mod_business_categories` (`id`, `CategoryTitle`, `SubDomain`, `domainsID`) VALUES
(1, 'ABATTOIRS', 'abattoirs', 0),
(2, 'ABORIGINAL GOODS', 'aboriginal-goods', 0),
(3, 'ABRASIVE PRODUCTS', 'abrasive-products', 0),
(4, 'ACCOUNTING SOFTWARE PROGRAMS', 'accounting-software-programs', 0),
(5, 'ACETYLENE', 'acetylene', 0),
(6, 'ACIDS', 'acids', 0),
(7, 'ACOUSTIC MATERIALS', 'acoustic-materials', 0),
(8, 'ACRYLIC SUPPLIES', 'acrylic-supplies', 0),
(9, 'ACUPUNCTURE PRODUCTS', 'acupuncture-products', 0),
(10, 'ADHESIVE PRODUCTS', 'adhesive-products', 0),
(11, 'ADULT SUPPLIES & PRODUCTS', 'adult-supplies-products', 0),
(12, 'ADVERTISING MATERIALS', 'advertising-materials', 0),
(13, 'AERIALS', 'aerials', 0),
(14, 'AEROBIC WEAR', 'aerobic-wear', 0),
(15, 'AEROSOL CONTAINERS & PRODUCTS', 'aerosol-containers-products', 0),
(16, 'AEROSPACE PRODUCTS', 'aerospace-products', 0),
(17, 'AGRICULTURAL PRODUCTS & EQUIPMENT', 'agricultural-products-equipment', 0),
(18, 'AIKIDO INSTRUCTION & SUPPLIES', 'aikido-instruction-supplies', 0),
(19, 'AIR BRAKE PRODUCTS', 'air-brake-products', 0),
(20, 'AIR COMPRESSOR PRODUCTS/SERVICE', 'air-compressor-productsservice', 0),
(21, 'AIR CONDITIONING PRODUCTS', 'air-conditioning-products', 0),
(22, 'AIR DRYING EQUIPMENT - SEE', 'air-drying-equipment-see', 0),
(23, 'AIR FILTER PRODUCTS', 'air-filter-products', 0),
(24, 'AIR FRESHENER PRODUCTS', 'air-freshener-products', 0),
(25, 'AIR POLLUTION CONTROL PRODUCTS', 'air-pollution-control-products', 0),
(26, 'AIR TOOLS', 'air-tools', 0),
(27, 'AIRBRUSH PRODUCTS & SUPPLIES', 'airbrush-products-supplies', 0),
(28, 'AIRCRAFT EQUIPMENT/MAINTENANCE & PRODUCTS', 'aircraft-equipmentmaintenance-products', 0),
(29, 'AIRLESS SPRAY PAINTING PRODUCTS', 'airless-spray-painting-products', 0),
(30, 'ALBUMS - PRODUCTS & SERVICES', 'albums-products-services', 0),
(31, 'ALCOHOL', 'alcohol', 0),
(32, 'ALLERGY PRODUCTS', 'allergy-products', 0),
(33, 'ALL-TERRAIN VEHICLE SUPPLIES', 'allterrain-vehicle-supplies', 0),
(34, 'ALMOND SELLERS', 'almond-sellers', 0),
(35, 'ALOE VERA SUPPLIES', 'aloe-vera-supplies', 0),
(36, 'ALTERNATORS - MOTOR VEHICLE PRODUCTS', 'alternators-motor-vehicle-products', 0),
(37, 'ALUMINIUM GOODS & SERVICES', 'aluminium-goods-services', 0),
(38, 'AMMONIA PRODUCTS', 'ammonia-products', 0),
(39, 'AMMUNITION SUPPLIES', 'ammunition-supplies', 0),
(40, 'AMPLIFIER EQUIPMENT', 'amplifier-equipment', 0),
(41, 'AMUSEMENT PRODUCTS', 'amusement-products', 0),
(42, 'ANALYTICAL PRODUCTS', 'analytical-products', 0),
(43, 'ANCHORS & MARINE EQUIPMENT/SUPPLIES', 'anchors-marine-equipmentsupplies', 0),
(44, 'ANNEXES - GOODS & SERVICES', 'annexes-goods-services', 0),
(45, 'ANODISING SUPPLIES & SERVICES', 'anodising-supplies-services', 0),
(46, 'ANSWERING MACHINE PRODUCTS', 'answering-machine-products', 0),
(47, 'ANTENNAS - SUPPLIES & COMMUNICATION', 'antennas-supplies-communication', 0),
(48, 'ANTI-CORROSIVE SUPPLIES', 'anticorrosive-supplies', 0),
(49, 'ANTIQUARIAN BOOKS', 'antiquarian-books', 0),
(50, 'ANTIQUE SUPPLIES & REPAIRS', 'antique-supplies-repairs', 0),
(51, 'ANTISEPTIC SUPPLIES', 'antiseptic-supplies', 0),
(52, 'ANTI-SLIP FLOOR TREATMENT', 'antislip-floor-treatment', 0),
(53, 'ANTI-STATIC ELECTRICITY GOODS & SERVICES', 'antistatic-electricity-goods-services', 0),
(54, 'APPLE SELLERS', 'apple-sellers', 0),
(55, 'APRICOT SELLERS', 'apricot-sellers', 0),
(56, 'APRONS - SALES & PRODUCTS', 'aprons-sales-products', 0),
(57, 'AQUARIUM PRODUCTS', 'aquarium-products', 0),
(58, 'ARC WELDING PRODUCTS', 'arc-welding-products', 0),
(59, 'ARCH SUPPORTS - MEDICAL SUPPLIES', 'arch-supports-medical-supplies', 0),
(60, 'ARCHERY EQUIPMENT & SUPPLIES', 'archery-equipment-supplies', 0),
(61, 'ARCHWAYS - GOODS & SERVICES', 'archways-goods-services', 0),
(62, 'ARMATURES - GOODS & SERVICES', 'armatures-goods-services', 0),
(63, 'ARMOURED CAR SERVICES', 'armoured-car-services', 0),
(64, 'ARMY SURPLUS SUPPLIES', 'army-surplus-supplies', 0),
(65, 'ART GOODS & PRODUCTS', 'art-goods-products', 0),
(66, 'ARTIFICAL NAILS', 'artifical-nails', 0),
(67, 'ARTIFICIAL EYES - PROSTHETICS', 'artificial-eyes-prosthetics', 0),
(68, 'ARTIFICIAL GRASS/LAWN PRODUCTS', 'artificial-grasslawn-products', 0),
(69, 'ARTIFICIAL JEWELLERY SUPPLIES', 'artificial-jewellery-supplies', 0),
(70, 'ARTIFICIAL LIMBS - PROSTHETICS', 'artificial-limbs-prosthetics', 0),
(71, 'ARTIFICIAL PLANTS & FLOWERS', 'artificial-plants-flowers', 0),
(72, 'ARTISIT\'S GOODS & SERVICES', 'artisits-goods-services', 0),
(73, 'ARTS & CRAFT PRODUCTS', 'arts-craft-products', 0),
(74, 'ASH TRAYS', 'ash-trays', 0),
(75, 'ASIAN FOOD PRODUCTS', 'asian-food-products', 0),
(76, 'ASPHALT PRODUCTS', 'asphalt-products', 0),
(77, 'ASTHMA PRODUCTS', 'asthma-products', 0),
(78, 'ASTRONOMY SUPPLIES', 'astronomy-supplies', 0),
(79, 'ATTACHE CASES', 'attache-cases', 0),
(80, 'ATTIC LADDER PRODUCTS', 'attic-ladder-products', 0),
(81, 'AUDIO TAPES & SUPPLIES', 'audio-tapes-supplies', 0),
(82, 'AUSTRALIANA GOODS', 'australiana-goods', 0),
(83, 'AUSTRLIAN NATIVE FOOD SUPPLIES', 'austrlian-native-food-supplies', 0),
(84, 'AUTOMATION EQUIPMENT', 'automation-equipment', 0),
(85, 'AUTOMOTIVE PARTS - SECONDHAND', 'automotive-parts-secondhand', 0),
(86, 'AUTOMOTIVE PRODUCTS & SUPPLIES', 'automotive-products-supplies', 0),
(87, 'AUTOMOTIVE WRECKING YARDS', 'automotive-wrecking-yards', 0),
(88, 'AVAITION ANTIQUES & MEMORABILIA', 'avaition-antiques-memorabilia', 0),
(89, 'AVIARIES', 'aviaries', 0),
(90, 'AWARD RIBBONS - PRODUCTS', 'award-ribbons-products', 0),
(91, 'AWNINGS - BLINDS & ROLLER SHUTTER PRODUCTS', 'awnings-blinds-roller-shutter-products', 0),
(92, 'AXLES', 'axles', 0),
(93, 'BABIE\'S WEAR', 'babies-wear', 0),
(94, 'BACK HOES', 'back-hoes', 0),
(95, 'BACKGROUND MUSIC SYSTEMS', 'background-music-systems', 0),
(96, 'BADGES - GOODS & SERVICES', 'badges-goods-services', 0),
(97, 'BAGELS', 'bagels', 0),
(98, 'BAGS  - PRODUCTS & SERVICES', 'bags-products-services', 0),
(99, 'BAIT - FISHING', 'bait-fishing', 0),
(100, 'BAKERS SUPPLIES & EQUIPMENT', 'bakers-supplies-equipment', 0),
(101, 'BALANCING EQUIPMENT', 'balancing-equipment', 0),
(102, 'BALING PRESSES', 'baling-presses', 0),
(103, 'BALL BEARING PRODUCTS', 'ball-bearing-products', 0),
(104, 'BALLET/DANCING COSTUMES', 'balletdancing-costumes', 0),
(105, 'BALSA WOOD PRODUCTS', 'balsa-wood-products', 0),
(106, 'BALUSTRADING PRODUCTS & SERVICES', 'balustrading-products-services', 0),
(107, 'BAMBOO PRODUCTS', 'bamboo-products', 0),
(108, 'BANNERS', 'banners', 0),
(109, 'BAR & HOTEL EQUIPMENT', 'bar-hotel-equipment', 0),
(110, 'BAR CODE GOODS & EQUIPMENT', 'bar-code-goods-equipment', 0),
(111, 'BAR REFRIGERATORS', 'bar-refrigerators', 0),
(112, 'BARBECUE  EQUIPMENT', 'barbecue-equipment', 0),
(113, 'BARBED WIRE PRODUCTS', 'barbed-wire-products', 0),
(114, 'BAROMETERS', 'barometers', 0),
(115, 'BARRELS', 'barrels', 0),
(116, 'BARS - GOODS & SERVICES', 'bars-goods-services', 0),
(117, 'BASKETBALL EQUIPMENT', 'basketball-equipment', 0),
(118, 'BASKETS - GOODS & SERVICE', 'baskets-goods-service', 0),
(119, 'BASSINETS PRODUCTS &  ACCESSORIES', 'bassinets-products-accessories', 0),
(120, 'BATHING WEAR', 'bathing-wear', 0),
(121, 'BATHS/BATHROOM PRODUCTS & ACCESSORIES', 'bathsbathroom-products-accessories', 0),
(122, 'BATTERIES', 'batteries', 0),
(123, 'BEADS - ACCESSORIES & PRODUCTS', 'beads-accessories-products', 0),
(124, 'BEAN BAGS', 'bean-bags', 0),
(125, 'BEANS', 'beans', 0),
(126, 'BEARING METALS & BUSHINGS PRODUCTS', 'bearing-metals-bushings-products', 0),
(127, 'BEAUTY CARE EQUIPMENT & SUPPLIES', 'beauty-care-equipment-supplies', 0),
(128, 'BED & BEDDING PRODUCTS & ACCESSORIES', 'bed-bedding-products-accessories', 0),
(129, 'BEEKEEPING PRODUCTS', 'beekeeping-products', 0),
(130, 'BEEPERS', 'beepers', 0),
(131, 'BEER MAKING EQUIPMENT', 'beer-making-equipment', 0),
(132, 'BELLS & CHIMES', 'bells-chimes', 0),
(133, 'BELTS', 'belts', 0),
(134, 'BENCH TOP PRODUCTS', 'bench-top-products', 0),
(135, 'BERETS - PRODUCTS & ACCESSORIES', 'berets-products-accessories', 0),
(136, 'BEVERAGE PRODUCTS', 'beverage-products', 0),
(137, 'BICYCLES SUPPLIES', 'bicycles-supplies', 0),
(138, 'BI-FOLD DOOR PRODUCTS', 'bifold-door-products', 0),
(139, 'BILLBOARDS - PRODUCTS & SUPPLIES', 'billboards-products-supplies', 0),
(140, 'BILLIARD TABLE PRODUCTS & ACCESSORIES', 'billiard-table-products-accessories', 0),
(141, 'BINDERS - PRODUCTS', 'binders-products', 0),
(142, 'BINGO EQUIPMENT & ACCESSORIES', 'bingo-equipment-accessories', 0),
(143, 'BINOCULAR PRODUCTS', 'binocular-products', 0),
(144, 'BINS', 'bins', 0),
(145, 'BIRD PRODUCTS & ACCESSORIES', 'bird-products-accessories', 0),
(146, 'BIRTHDAY CAKES', 'birthday-cakes', 0),
(147, 'BISCUITS', 'biscuits', 0),
(148, 'BITUMEN PRODUCTS', 'bitumen-products', 0),
(149, 'BLACKBOARD GOODS & SERVICES', 'blackboard-goods-services', 0),
(150, 'BLANKETS', 'blankets', 0),
(151, 'BLASTING EQUIPMENT', 'blasting-equipment', 0),
(152, 'BLINDS - PRODUCTS & SERVICES', 'blinds-products-services', 0),
(153, 'BLOCKS - GOODS & SERVICES', 'blocks-goods-services', 0),
(154, 'BLOWERS', 'blowers', 0),
(155, 'BLUE METAL PRODUCTS', 'blue-metal-products', 0),
(156, 'BOATING - PRODUCTS & SERVICES', 'boating-products-services', 0),
(157, 'BODY & EAR PIERCING', 'body-ear-piercing', 0),
(158, 'BODY ARMOUR', 'body-armour', 0),
(159, 'BODY ART', 'body-art', 0),
(160, 'BODY BUILDER - PRODUCTS & SUPPLIES', 'body-builder-products-supplies', 0),
(161, 'BOILERS', 'boilers', 0),
(162, 'BOLLARD PRODUCTS', 'bollard-products', 0),
(163, 'BOLTS & NUTS', 'bolts-nuts', 0),
(164, 'BONSAI PRODUCTS', 'bonsai-products', 0),
(165, 'BOOKBINDING PRODUCTS', 'bookbinding-products', 0),
(166, 'BOOKS', 'books', 0),
(167, 'BOOM GATES & LIFTS', 'boom-gates-lifts', 0),
(168, 'BOOMERANG PRODUCTS', 'boomerang-products', 0),
(169, 'BOOTS', 'boots', 0),
(170, 'BOTTLE PRODUCTS', 'bottle-products', 0),
(171, 'BOUNCING CASTLES', 'bouncing-castles', 0),
(172, 'BOUYANCY PRODUCTS', 'bouyancy-products', 0),
(173, 'BOWLING EQUIPMENT & CLOTHING PRODUCTS', 'bowling-equipment-clothing-products', 0),
(174, 'BOWS - ACCESSORIES & PRODUCTS', 'bows-accessories-products', 0),
(175, 'BOX PRODUCTS', 'box-products', 0),
(176, 'BOX TRAILERS', 'box-trailers', 0),
(177, 'BOXING EQUIPMENT & SUPPLIES', 'boxing-equipment-supplies', 0),
(178, 'BOYS CLOTHING', 'boys-clothing', 0),
(179, 'BRAIDS', 'braids', 0),
(180, 'BRAKE & CLUTCH PRODUCTS', 'brake-clutch-products', 0),
(181, 'BRASS PRODUCTS & ACCESSORIES', 'brass-products-accessories', 0),
(182, 'BRAZIERS', 'braziers', 0),
(183, 'BREAD MAKING SUPPLIES', 'bread-making-supplies', 0),
(184, 'BREATHALYSER PRODUCTS', 'breathalyser-products', 0),
(185, 'BREWERY PRODUCTS & ACCESSORIES', 'brewery-products-accessories', 0),
(186, 'BRICK GOODS & SERVICES', 'brick-goods-services', 0),
(187, 'BRIDAL', 'bridal', 0),
(188, 'BRIEFCASES', 'briefcases', 0),
(189, 'BROADCASTING PRODUCTS & EQUIPMENT', 'broadcasting-products-equipment', 0),
(190, 'BROCHURES', 'brochures', 0),
(191, 'BRONZE PRODUCTS & ACCESSORIES', 'bronze-products-accessories', 0),
(192, 'BROOMS', 'brooms', 0),
(193, 'BRUSHES', 'brushes', 0),
(194, 'BUCKLES', 'buckles', 0),
(195, 'BUILDERS GOODS & SERVICES', 'builders-goods-services', 0),
(196, 'BULL BAR PRODUCTS', 'bull-bar-products', 0),
(197, 'BURGLAR ALARMS', 'burglar-alarms', 0),
(198, 'BUSES - BUILDERS & SERVICES', 'buses-builders-services', 0),
(199, 'BUSH FOODS', 'bush-foods', 0),
(200, 'BUSINESS GOODS & SERVICES', 'business-goods-services', 0),
(201, 'BUTTONS', 'buttons', 0),
(202, 'CABIN TRUNKS & ACCESSORIES', 'cabin-trunks-accessories', 0),
(203, 'CABINETS', 'cabinets', 0),
(204, 'CABLING SUPPLIES & PRODUCTS', 'cabling-supplies-products', 0),
(205, 'CAFÉ PRODUCTS & SERVICES', 'cafe-products-services', 0),
(206, 'CAKE DECORATION', 'cake-decoration', 0),
(207, 'CALCULATOR PRODUCTS', 'calculator-products', 0),
(208, 'CALIBRATION EQUIPMENT', 'calibration-equipment', 0),
(209, 'CALICO PRODUCTS', 'calico-products', 0),
(210, 'CALLIGRAPHY SUPPLIES', 'calligraphy-supplies', 0),
(211, 'CAMERAS', 'cameras', 0),
(212, 'CAMPER TRAILERS & CAMPERVANS', 'camper-trailers-campervans', 0),
(213, 'CAMPING EQUIPMENT SUPPLIES', 'camping-equipment-supplies', 0),
(214, 'CANDLES', 'candles', 0),
(215, 'CANE PRODUCTS', 'cane-products', 0),
(216, 'CANNING PRODUCTS', 'canning-products', 0),
(217, 'CANOES', 'canoes', 0),
(218, 'CANOPIE PRODUCTS', 'canopie-products', 0),
(219, 'CANVAS PRODUCTS', 'canvas-products', 0),
(220, 'CAPS AND HATS', 'caps-and-hats', 0),
(221, 'CAR SUPPLIES & ACCESSORIES', 'car-supplies-accessories', 0),
(222, 'CARAVAN SUPPLIES & ACCESSORIES', 'caravan-supplies-accessories', 0),
(223, 'CARBON PRODUCTS & SUPPLIES', 'carbon-products-supplies', 0),
(224, 'CARBURETTOR - VEHICLE SUPPLIES', 'carburettor-vehicle-supplies', 0),
(225, 'CARDBOARD SUPPLIES', 'cardboard-supplies', 0),
(226, 'CARDS', 'cards', 0),
(227, 'CARGO SUPPLIES', 'cargo-supplies', 0),
(228, 'CARPET PRODUCTS & SERVICES', 'carpet-products-services', 0),
(229, 'CARPORTS', 'carports', 0),
(230, 'CARS NEW & USED FOR SALE', 'cars-new-used-for-sale', 0),
(231, 'CARTON PRODUCTS', 'carton-products', 0),
(232, 'CARTRIDGES', 'cartridges', 0),
(233, 'CASES - PRODUCTS', 'cases-products', 0),
(234, 'CASH BAGS & BOX SUPPLIES', 'cash-bags-box-supplies', 0),
(235, 'CASH REGISTERS & ACCESSORIES', 'cash-registers-accessories', 0),
(236, 'CASINO PRODUCTS', 'casino-products', 0),
(237, 'CASKS', 'casks', 0),
(238, 'CASSETTES & ACCESSORIES', 'cassettes-accessories', 0),
(239, 'CASTORS', 'castors', 0),
(240, 'CAT PRODUCTS', 'cat-products', 0),
(241, 'CATAMARANS', 'catamarans', 0),
(242, 'CATERING EQUIPMENT & SUPPLIES', 'catering-equipment-supplies', 0),
(243, 'CATTLE PRODUCTS', 'cattle-products', 0),
(244, 'CB RADIO SUPPLIES & SERVICES', 'cb-radio-supplies-services', 0),
(245, 'CD - ROM - PRODUCTS & SERVICES', 'cd-rom-products-services', 0),
(246, 'CD ROM SUPPLIES', 'cd-rom-supplies', 0),
(247, 'CEILING SUPPLIES', 'ceiling-supplies', 0),
(248, 'CELLULAR TELEPHONE PRODUCTS', 'cellular-telephone-products', 0),
(249, 'CEMENT SUPPLIES & PRODUCTS', 'cement-supplies-products', 0),
(250, 'CERAMIC PRODUCTS', 'ceramic-products', 0),
(251, 'CHAIN EQUIPMENT', 'chain-equipment', 0),
(252, 'CHAINSAWS', 'chainsaws', 0),
(253, 'CHAIRS', 'chairs', 0),
(254, 'CHALK & CHALKBOARD PRODUCTS', 'chalk-chalkboard-products', 0),
(255, 'CHEESE SUPPLIES & PRODUCTS', 'cheese-supplies-products', 0),
(256, 'CHEMICALS', 'chemicals', 0),
(257, 'CHEMIST SUPPLIES & PRODUCTS', 'chemist-supplies-products', 0),
(258, 'CHENILLE', 'chenille', 0),
(259, 'CHICKEN & POULTRY SUPPLIES', 'chicken-poultry-supplies', 0),
(260, 'CHILDREN\'S WEAR & ACCESSORIES', 'childrens-wear-accessories', 0),
(261, 'CHIMES', 'chimes', 0),
(262, 'CHIMNEY PRODUCTS', 'chimney-products', 0),
(263, 'CHINA & GLASSWARE PRODUCTS', 'china-glassware-products', 0),
(264, 'CHLORINATORS', 'chlorinators', 0),
(265, 'CHOCOLATE SUPPLIES', 'chocolate-supplies', 0),
(266, 'CHROME PLATING', 'chrome-plating', 0),
(267, 'CHURCH & RELIGIOUS PRODUCTS', 'church-religious-products', 0),
(268, 'CIGARETTES & CIGAR PRODUCTS', 'cigarettes-cigar-products', 0),
(269, 'CINEMA\'S', 'cinemas', 0),
(270, 'CLADDING SUPPLIES', 'cladding-supplies', 0),
(271, 'CLAY SUPPLIES', 'clay-supplies', 0),
(272, 'CLEANING SUPPLIES & PRODUCTS', 'cleaning-supplies-products', 0),
(273, 'CLOCK SUPPLIES', 'clock-supplies', 0),
(274, 'CLOGS', 'clogs', 0),
(275, 'CLOTHES DRYERS & SERVICES', 'clothes-dryers-services', 0),
(276, 'CLOTHING - PRODUCTS & SUPPLIES', 'clothing-products-supplies', 0),
(277, 'CLUB SUPPLIES', 'club-supplies', 0),
(278, 'CLUTCH EQUIPMENT & PRODUCTS', 'clutch-equipment-products', 0),
(279, 'COASTERS', 'coasters', 0),
(280, 'COAT HANGERS', 'coat-hangers', 0),
(281, 'CODING EQUIPMENT & SUPPLIES', 'coding-equipment-supplies', 0),
(282, 'COFFEE PRODUCTS', 'coffee-products', 0),
(283, 'COFFINS', 'coffins', 0),
(284, 'COIN EQUIPMENT & PRODUCTS', 'coin-equipment-products', 0),
(285, 'COLLECTABLES', 'collectables', 0),
(286, 'COMMLESTONE PAVING PRODUCTS', 'commlestone-paving-products', 0),
(287, 'COMMODES - PRODUCTS & SUPPLIES', 'commodes-products-supplies', 0),
(288, 'COMPONENTS', 'components', 0),
(289, 'COMPOST EQUIPMENT', 'compost-equipment', 0),
(290, 'COMPRESSORS', 'compressors', 0),
(291, 'COMPUTER EQUIPMENT & SUPPLIES', 'computer-equipment-supplies', 0),
(292, 'CONCRETE PRODUCTS', 'concrete-products', 0),
(293, 'CONDIMENTS', 'condiments', 0),
(294, 'CONDOMS', 'condoms', 0),
(295, 'CONFECTIONERY', 'confectionery', 0),
(296, 'CONFERENCE EQUIPMENT', 'conference-equipment', 0),
(297, 'CONNECTORS', 'connectors', 0),
(298, 'CONSERVATORIES', 'conservatories', 0),
(299, 'CONTACT LENSE PRODUCTS', 'contact-lense-products', 0),
(300, 'CONTAINERS - SHIPPING', 'containers-shipping', 0),
(301, 'CONTINENTAL QUILTS', 'continental-quilts', 0),
(302, 'CONTRACTOR EQUIPMENT & SERVICES', 'contractor-equipment-services', 0),
(303, 'CONTROL EQUIPMENT', 'control-equipment', 0),
(304, 'CONVENTION EQUIPMENT & SUPPLIES', 'convention-equipment-supplies', 0),
(305, 'CONVERTERS', 'converters', 0),
(306, 'COOKERS & COOKING PRODUCTS', 'cookers-cooking-products', 0),
(307, 'COPPER PRODUCTS', 'copper-products', 0),
(308, 'COPYING PRODUCTS & SUPPLIES', 'copying-products-supplies', 0),
(309, 'CORKS & CORK PRODUCTS', 'corks-cork-products', 0),
(310, 'CORNICES', 'cornices', 0),
(311, 'CORSETS', 'corsets', 0),
(312, 'COSMETIC PRODUCTS', 'cosmetic-products', 0),
(313, 'COSTUME SUPPLIES', 'costume-supplies', 0),
(314, 'COTS', 'cots', 0),
(315, 'COTTONG PRODUCTS', 'cottong-products', 0),
(316, 'COUPLINGS', 'couplings', 0),
(317, 'COURIER PRODUCTS', 'courier-products', 0),
(318, 'COVERS - VEHICLE PRODUCTS', 'covers-vehicle-products', 0),
(319, 'CRAFT PRODUCTS & SUPPLIES', 'craft-products-supplies', 0),
(320, 'CRANES', 'cranes', 0),
(321, 'CRATES', 'crates', 0),
(322, 'CRAYONS', 'crayons', 0),
(323, 'CRICKET GEAR & PRODUCTS', 'cricket-gear-products', 0),
(324, 'CROCKERY', 'crockery', 0),
(325, 'CRUTCHES - SUPPLIES', 'crutches-supplies', 0),
(326, 'CRYSTAL SUPPLIES & PRODUCTS', 'crystal-supplies-products', 0),
(327, 'CUPBOARDS - PRODUCTS & SUPPLIES', 'cupboards-products-supplies', 0),
(328, 'CURTAIN SUPPLIES & PRODUCTS', 'curtain-supplies-products', 0),
(329, 'CUSHION SUPPLIES & PRODUCTS', 'cushion-supplies-products', 0),
(330, 'CUTLERY', 'cutlery', 0),
(331, 'CV JOINT PRODUCTS - MOTOR VEHICLE', 'cv-joint-products-motor-vehicle', 0),
(332, 'DANCING - COSTUMES & SUPPLIES', 'dancing-costumes-supplies', 0),
(333, 'DART & DART BOARDS SUPPLIES', 'dart-dart-boards-supplies', 0),
(334, 'DECAL PRODUCTS', 'decal-products', 0),
(335, 'DECORATION PRODUCTS', 'decoration-products', 0),
(336, 'DEGREASER PRODUCTS', 'degreaser-products', 0),
(337, 'DEMOLITION EQUIPMENT', 'demolition-equipment', 0),
(338, 'DENTAL SUPPLIES', 'dental-supplies', 0),
(339, 'DEODORANTS', 'deodorants', 0),
(340, 'DESIGNING PRODUCTS', 'designing-products', 0),
(341, 'DESKS & DESK ACCESSORIES', 'desks-desk-accessories', 0),
(342, 'DETERGENT SUPPLIES', 'detergent-supplies', 0),
(343, 'DIARY SUPPLIES', 'diary-supplies', 0),
(344, 'DICTATING MACHINE SUPPLIES', 'dictating-machine-supplies', 0),
(345, 'DIDGERIDOOS', 'didgeridoos', 0),
(346, 'DIESEL PRODUCTS', 'diesel-products', 0),
(347, 'DIFFERENTIAL PRODUCTS', 'differential-products', 0),
(348, 'DIGITAL CAMERAS & PRODUCTS', 'digital-cameras-products', 0),
(349, 'DINNERWARE', 'dinnerware', 0),
(350, 'DISC JOCKEYS\' SUPPLIES & EQUIPMENT', 'disc-jockeys-supplies-equipment', 0),
(351, 'DISHAWASHING MACHINES & PARTS', 'dishawashing-machines-parts', 0),
(352, 'DISKETTES', 'diskettes', 0),
(353, 'DISPLAY EQUIPMENT & SUPPLIES', 'display-equipment-supplies', 0),
(354, 'DISTILLED WATER', 'distilled-water', 0),
(355, 'DIVING - PRODUCTS & EQUIPMENT', 'diving-products-equipment', 0),
(356, 'DOGS - PRODUCTS & SUPPLIES', 'dogs-products-supplies', 0),
(357, 'DOLLS - SUPPLIES & ACCESSORIES', 'dolls-supplies-accessories', 0),
(358, 'DOORS', 'doors', 0),
(359, 'DRAFTING SUPPLIES & SERVICES', 'drafting-supplies-services', 0),
(360, 'DRAINAGE EQUIPMENT & SERVICES', 'drainage-equipment-services', 0),
(361, 'DRAWING EQUIPMENT', 'drawing-equipment', 0),
(362, 'DRESSES', 'dresses', 0),
(363, 'DRIED FLOWER PRODUCTS', 'dried-flower-products', 0),
(364, 'DRILLING PRODUCTS & EQUIPMENT', 'drilling-products-equipment', 0),
(365, 'DUST CONTROL EQUIPMENT', 'dust-control-equipment', 0),
(366, 'DUSTERS & DUST MAT PRODUCTS', 'dusters-dust-mat-products', 0),
(367, 'DVD PRODUCTS & ACCESSORIES', 'dvd-products-accessories', 0),
(368, 'DYE & DYE PRODUCTS', 'dye-dye-products', 0),
(369, 'DYNAMITE', 'dynamite', 0),
(370, 'E.F.T.P.O.S. EQUIPMENT', 'eftpos-equipment', 0),
(371, 'EAR PLUGS', 'ear-plugs', 0),
(372, 'EARTH MOVING EQUIPMENT & SUPPLIES', 'earth-moving-equipment-supplies', 0),
(373, 'ELASTIC PRODUCTS', 'elastic-products', 0),
(374, 'ELECTRIC PRODUCTS', 'electric-products', 0),
(375, 'ELECTRIC TOOLS & EQUIPMENT', 'electric-tools-equipment', 0),
(376, 'ELECTRICAL APPLIANCE PARTS & PRODUCTS', 'electrical-appliance-parts-products', 0),
(377, 'ELECTRONIC EQUIPMENT', 'electronic-equipment', 0),
(378, 'ELECTROPLATING PRODUCTS', 'electroplating-products', 0),
(379, 'ELEMENTS', 'elements', 0),
(380, 'ELEVATORS & EQUIPMENT', 'elevators-equipment', 0),
(381, 'EMBROIDERY', 'embroidery', 0),
(382, 'ENAMEL', 'enamel', 0),
(383, 'ENCYCLOPAEDIAS', 'encyclopaedias', 0),
(384, 'ENGINES', 'engines', 0),
(385, 'ENGRAVING PRODUCTS', 'engraving-products', 0),
(386, 'ENTERTAINING EQUIPMENT & SUPPLIES', 'entertaining-equipment-supplies', 0),
(387, 'ENVELOPES', 'envelopes', 0),
(388, 'ENVIROMENTAL EQUIPMENT', 'enviromental-equipment', 0),
(389, 'EPOXU', 'epoxu', 0),
(390, 'EXCAVATING', 'excavating', 0),
(391, 'EXERCISE EQUIPMENT & SUPPLIES', 'exercise-equipment-supplies', 0),
(392, 'EXHAUST FANS', 'exhaust-fans', 0),
(393, 'EXPLOSIVES', 'explosives', 0),
(394, 'EYE PRODUCTS & ACCESSORIES', 'eye-products-accessories', 0),
(395, 'EYELETS', 'eyelets', 0),
(396, 'FABRIC', 'fabric', 0),
(397, 'FACSIMILES', 'facsimiles', 0),
(398, 'FANCY DRESS COSTUMES', 'fancy-dress-costumes', 0),
(399, 'FANS', 'fans', 0),
(400, 'FARM EQUIPMENT & PRODUCTS', 'farm-equipment-products', 0),
(401, 'FASHION', 'fashion', 0),
(402, 'FASTENERS', 'fasteners', 0),
(403, 'FEATHERS PRODUCTS', 'feathers-products', 0),
(404, 'FENCING', 'fencing', 0),
(405, 'FETE SUPPLIES', 'fete-supplies', 0),
(406, 'FIBREGLASS PRODUCTS', 'fibreglass-products', 0),
(407, 'FILING CABINETS', 'filing-cabinets', 0),
(408, 'FILTERS', 'filters', 0),
(409, 'FIRE ALARMS & EQUIPMENT', 'fire-alarms-equipment', 0),
(410, 'FIREARMS', 'firearms', 0),
(411, 'FIREPLACES', 'fireplaces', 0),
(412, 'FIREWOOD', 'firewood', 0),
(413, 'FIREWORKS', 'fireworks', 0),
(414, 'FIRST AID PRODUCTS', 'first-aid-products', 0),
(415, 'FISH PONDS & TANKS', 'fish-ponds-tanks', 0),
(416, 'FISHING EQUIPMENT & PRODUCTS', 'fishing-equipment-products', 0),
(417, 'FITNESS & HEALTH EQUIPMENT', 'fitness-health-equipment', 0),
(418, 'FLAGPOLES', 'flagpoles', 0),
(419, 'FLOOR COVERING PRODUCTS', 'floor-covering-products', 0),
(420, 'FLOOR PRODUCTS', 'floor-products', 0),
(421, 'FLORAL ART & FLORIST PRODUCTS', 'floral-art-florist-products', 0),
(422, 'FLOWERS', 'flowers', 0),
(423, 'FLY WIRE', 'fly-wire', 0),
(424, 'FOAM PRODUCTS', 'foam-products', 0),
(425, 'FOIL PRODUCTS', 'foil-products', 0),
(426, 'FOOD PRODUCTS', 'food-products', 0),
(427, 'FOOTWEAR', 'footwear', 0),
(428, 'FOUNDRY SUPPLIES', 'foundry-supplies', 0),
(429, 'FOUNTAINS', 'fountains', 0),
(430, 'FOUR WHEEL DRIVES', 'four-wheel-drives', 0),
(431, 'FRAMES', 'frames', 0),
(432, 'FREEZER PRODUCTS & PARTS', 'freezer-products-parts', 0),
(433, 'FRETWORK', 'fretwork', 0),
(434, 'FRIDGE PRODUCTS', 'fridge-products', 0),
(435, 'FUEL', 'fuel', 0),
(436, 'FURNACE PRODUCTS', 'furnace-products', 0),
(437, 'FURNITURE', 'furniture', 0),
(438, 'FUSES', 'fuses', 0),
(439, 'FUTON PRODUCTS', 'futon-products', 0),
(440, 'GAMBLING EQUIPMENT', 'gambling-equipment', 0),
(441, 'GAMES', 'games', 0),
(442, 'GARAGE EQUIPMENT & SUPPLIES', 'garage-equipment-supplies', 0),
(443, 'GARBAGE PRODUCTS', 'garbage-products', 0),
(444, 'GARDEN PRODUCTS & SUPPLIES', 'garden-products-supplies', 0),
(445, 'GARMENT PRODUCTS', 'garment-products', 0),
(446, 'GAS APPLIANCES', 'gas-appliances', 0),
(447, 'GASKETS', 'gaskets', 0),
(448, 'GATES', 'gates', 0),
(449, 'GAUGES', 'gauges', 0),
(450, 'GEARBOXES', 'gearboxes', 0),
(451, 'GEM PRODUCTS', 'gem-products', 0),
(452, 'GIFT ACCESSORIES', 'gift-accessories', 0),
(453, 'GIRDLES', 'girdles', 0),
(454, 'GLASS PRODUCTS & SERVICES', 'glass-products-services', 0),
(455, 'GLOBES', 'globes', 0),
(456, 'GLOVES', 'gloves', 0),
(457, 'GLUE PRODUCTS', 'glue-products', 0),
(458, 'GO-KART PRODUCTS & SUPPLIES', 'gokart-products-supplies', 0),
(459, 'GOLD', 'gold', 0),
(460, 'GOLDING PRODUCTS & SUPPLIES', 'golding-products-supplies', 0),
(461, 'GRADING EQUIPMENT', 'grading-equipment', 0),
(462, 'GRAIN EQUIPMENT & SUPPLIES', 'grain-equipment-supplies', 0),
(463, 'GRANITE', 'granite', 0),
(464, 'GRAVEL', 'gravel', 0),
(465, 'GREASE EQUIPMENT & SUPPLIES', 'grease-equipment-supplies', 0),
(466, 'GRILLES - EQUIPMENT & SUPPLIES', 'grilles-equipment-supplies', 0),
(467, 'GROUTING PRODUCTS', 'grouting-products', 0),
(468, 'GUILLOTINES', 'guillotines', 0),
(469, 'GUNS', 'guns', 0),
(470, 'HAIR CARE SERVICES & ACCESSORIES', 'hair-care-services-accessories', 0),
(471, 'HALAL PRODUCTS', 'halal-products', 0),
(472, 'HAMMOCKS - PRODUCTS & ACCESSORIES', 'hammocks-products-accessories', 0),
(473, 'HAMPERS', 'hampers', 0),
(474, 'HANDBAGS', 'handbags', 0),
(475, 'HANDICAPPED PRODUCTS', 'handicapped-products', 0),
(476, 'HANDYMAN EQUIPMENT', 'handyman-equipment', 0),
(477, 'HARDWARE', 'hardware', 0),
(478, 'HATS', 'hats', 0),
(479, 'HEADSETS - PRODUCTS & SUPPLIES', 'headsets-products-supplies', 0),
(480, 'HEADSTONES', 'headstones', 0),
(481, 'HEALTH FOOD', 'health-food', 0),
(482, 'HEARING AIDS - PRODUCTS & SUPPLIES', 'hearing-aids-products-supplies', 0),
(483, 'HEATING', 'heating', 0),
(484, 'HEMP', 'hemp', 0),
(485, 'HERBAL PRODUCTS', 'herbal-products', 0),
(486, 'HESSIAN PRODUCTS', 'hessian-products', 0),
(487, 'HI-FI PRODUCTS & EQUIPMENT', 'hifi-products-equipment', 0),
(488, 'HINGES - PRODUCTS', 'hinges-products', 0),
(489, 'HOBBY SUPPLIES', 'hobby-supplies', 0),
(490, 'HOISTS', 'hoists', 0),
(491, 'HOLOGRAPHICS', 'holographics', 0),
(492, 'HONING', 'honing', 0),
(493, 'HORSE PRODUCTS', 'horse-products', 0),
(494, 'HOSES', 'hoses', 0),
(495, 'HOSIERY', 'hosiery', 0),
(496, 'HOSPITAL EQUIPMENT', 'hospital-equipment', 0),
(497, 'HOT TUBS - PRODUCTS & SUPPLIES', 'hot-tubs-products-supplies', 0),
(498, 'HOT WATER SYSTEMS', 'hot-water-systems', 0),
(499, 'HOTEL EQUIPMENT', 'hotel-equipment', 0),
(500, 'HYDRAULICS', 'hydraulics', 0),
(501, 'ICE', 'ice', 0),
(502, 'ICE CREAM PRODUCTS', 'ice-cream-products', 0),
(503, 'ILLUMINATED PRODUCTS & SIGNS', 'illuminated-products-signs', 0),
(504, 'INCENSE SUPPLIES', 'incense-supplies', 0),
(505, 'INCUBATOR PRODUCTS', 'incubator-products', 0),
(506, 'INDICATOR LIGHTS & SUPPLIES', 'indicator-lights-supplies', 0),
(507, 'INDUSTRIAL SUPPLIES & PRODUCTS', 'industrial-supplies-products', 0),
(508, 'INFLATABLE PRODUCTS', 'inflatable-products', 0),
(509, 'INFRA-RED PRODUCTS', 'infrared-products', 0),
(510, 'INJECTORS', 'injectors', 0),
(511, 'INKS', 'inks', 0),
(512, 'INSECT & INSECTICIDE PRODUCTS', 'insect-insecticide-products', 0),
(513, 'INSTRUMENTS', 'instruments', 0),
(514, 'INSULATION PRODUCT', 'insulation-product', 0),
(515, 'INTERCOMS', 'intercoms', 0),
(516, 'INVALID EQUIPMENT', 'invalid-equipment', 0),
(517, 'IRON', 'iron', 0),
(518, 'IRONING PRODUCTS', 'ironing-products', 0),
(519, 'IRRIGATION', 'irrigation', 0),
(520, 'JACKS', 'jacks', 0),
(521, 'JAMS', 'jams', 0),
(522, 'JARS', 'jars', 0),
(523, 'JEANS', 'jeans', 0),
(524, 'JEWELLERY', 'jewellery', 0),
(525, 'JUICING PRODUCTS', 'juicing-products', 0),
(526, 'JUKEBOXES', 'jukeboxes', 0),
(527, 'KAYAK PRODUCTS', 'kayak-products', 0),
(528, 'KEGS', 'kegs', 0),
(529, 'KENNELS', 'kennels', 0),
(530, 'KEROSENE PRODUCTS', 'kerosene-products', 0),
(531, 'KEYS - PRODUCTS & SUPPLIES', 'keys-products-supplies', 0),
(532, 'KILNS - PRODUCTS & SUPPLIES', 'kilns-products-supplies', 0),
(533, 'KINDERGARTEN EQUIPMENT', 'kindergarten-equipment', 0),
(534, 'KITCHEN APPLIANCES & SUPPLIES', 'kitchen-appliances-supplies', 0),
(535, 'KITES', 'kites', 0),
(536, 'KNITTING PRODUCTS', 'knitting-products', 0),
(537, 'KNIVES', 'knives', 0),
(538, 'LABELLING EQUIPMENT & SERVICES', 'labelling-equipment-services', 0),
(539, 'LABORATORY EQUIPMENT', 'laboratory-equipment', 0),
(540, 'LACES', 'laces', 0),
(541, 'LADDERS - PRODUCTS & SUPPLIES', 'ladders-products-supplies', 0),
(542, 'LAMINATING EQUIPMENT', 'laminating-equipment', 0),
(543, 'LAMPS & LAMPSHADES', 'lamps-lampshades', 0),
(544, 'LAPTOP COMPUTERS', 'laptop-computers', 0),
(545, 'LASERS', 'lasers', 0),
(546, 'LATEX', 'latex', 0),
(547, 'LATHES', 'lathes', 0),
(548, 'LATTICE PRODUCTS', 'lattice-products', 0),
(549, 'LAUNDRY', 'laundry', 0),
(550, 'LAVATORIES', 'lavatories', 0),
(551, 'LEADLIGHTS', 'leadlights', 0),
(552, 'LEATHER PRODUCTS', 'leather-products', 0),
(553, 'LEGAL SUPPLIES', 'legal-supplies', 0),
(554, 'LEMONS', 'lemons', 0),
(555, 'LENSES', 'lenses', 0),
(556, 'LIBRARY SUPPLIES', 'library-supplies', 0),
(557, 'LIFTING EQUIPMENT & SUPPLIES', 'lifting-equipment-supplies', 0),
(558, 'LIGHTING', 'lighting', 0),
(559, 'LIMESTONE PRODUCTS', 'limestone-products', 0),
(560, 'LINGERIE', 'lingerie', 0),
(561, 'LIQUOR', 'liquor', 0),
(562, 'LOCKS', 'locks', 0),
(563, 'LOGGING', 'logging', 0),
(564, 'LOGS', 'logs', 0),
(565, 'LOUDSPEAKERS', 'loudspeakers', 0),
(566, 'LOUNGE SUITES', 'lounge-suites', 0),
(567, 'LOUVRES', 'louvres', 0),
(568, 'LP GAS EQUIPMENT', 'lp-gas-equipment', 0),
(569, 'LP GAS PRODUCTS', 'lp-gas-products', 0),
(570, 'LUBRICATION PRODUCTS', 'lubrication-products', 0),
(571, 'MACHINERY', 'machinery', 0),
(572, 'MAGAZINES', 'magazines', 0),
(573, 'MAGICIAN\'S PRODUCTS', 'magicians-products', 0),
(574, 'MAGNETS', 'magnets', 0),
(575, 'MAIL BOXES', 'mail-boxes', 0),
(576, 'MANCHESTER', 'manchester', 0),
(577, 'MANICURISTS\' EQUIPMENT', 'manicurists-equipment', 0),
(578, 'MAPS', 'maps', 0),
(579, 'MARINE EQUIPMENT & PRODUCTS', 'marine-equipment-products', 0),
(580, 'MARQUEES', 'marquees', 0),
(581, 'MASKS', 'masks', 0),
(582, 'MASONRY PRODUCTS', 'masonry-products', 0),
(583, 'MASSAGE PRODUCTS & EQUIPMENT', 'massage-products-equipment', 0),
(584, 'MASTS', 'masts', 0),
(585, 'MATCHES', 'matches', 0),
(586, 'MATERIAL PRODUCTS', 'material-products', 0),
(587, 'MATS', 'mats', 0),
(588, 'MATTRESSES', 'mattresses', 0),
(589, 'MEASURING EQUIPMENT & SERVICES', 'measuring-equipment-services', 0),
(590, 'MEAT EQUIPMENT & PRODUCTS', 'meat-equipment-products', 0),
(591, 'MEDICAL EQUIPMENT & SUPPLIES', 'medical-equipment-supplies', 0),
(592, 'MESH PRODUCTS', 'mesh-products', 0),
(593, 'MESWEAR', 'meswear', 0),
(594, 'METAL PRODUCTS & SUPPLIES', 'metal-products-supplies', 0),
(595, 'METER EQUIPMENT', 'meter-equipment', 0),
(596, 'MICROPHONE EQUIPMENT', 'microphone-equipment', 0),
(597, 'MICROSCOPE EQUIPMENT', 'microscope-equipment', 0),
(598, 'MICROWAVE OVEN', 'microwave-oven', 0),
(599, 'MILK', 'milk', 0),
(600, 'MINERAL PRODUCTS', 'mineral-products', 0),
(601, 'MIRROR PRODUCTS', 'mirror-products', 0),
(602, 'MIXERS', 'mixers', 0),
(603, 'MODEMS', 'modems', 0),
(604, 'MOLASSES', 'molasses', 0),
(605, 'MONITORS - COMPUTER', 'monitors-computer', 0),
(606, 'MOPEDS', 'mopeds', 0),
(607, 'MOPS', 'mops', 0),
(608, 'MOSAIC PRODUCTS', 'mosaic-products', 0),
(609, 'MOTOR ACCESSORIES & SUPPLIES', 'motor-accessories-supplies', 0),
(610, 'MOTOR BIKES', 'motor-bikes', 0),
(611, 'MOTOR CARS', 'motor-cars', 0),
(612, 'MOULDINGS', 'mouldings', 0),
(613, 'MOUSE TRAPS', 'mouse-traps', 0),
(614, 'MOVIE EQUIPMENT & SUPPLIES', 'movie-equipment-supplies', 0),
(615, 'MUFFLERS', 'mufflers', 0),
(616, 'MULCHING PRODUCTS', 'mulching-products', 0),
(617, 'MUSHROOM SUPPLIES', 'mushroom-supplies', 0),
(618, 'MUSIC', 'music', 0),
(619, 'NAIL EQUIPMENT', 'nail-equipment', 0),
(620, 'NAPPY SUPPLIES & PRODUCTS', 'nappy-supplies-products', 0),
(621, 'NATUROPATH PRODUCTS & SUPPLIES', 'naturopath-products-supplies', 0),
(622, 'NECKWEAR ACCESSORIES', 'neckwear-accessories', 0),
(623, 'NEEDLES', 'needles', 0),
(624, 'NETS', 'nets', 0),
(625, 'NEW AGE PRODUCTS', 'new-age-products', 0),
(626, 'NEWSPAPERS', 'newspapers', 0),
(627, 'NICKEL PRODUCTS & SUPPLIES', 'nickel-products-supplies', 0),
(628, 'NOODLES', 'noodles', 0),
(629, 'NOTEBOOK COMPUTER SUPPLIES', 'notebook-computer-supplies', 0),
(630, 'NOZZLES', 'nozzles', 0),
(631, 'NUCLEAR PRODUCTS', 'nuclear-products', 0),
(632, 'NURSERY PRODUCTS & SUPPLIES', 'nursery-products-supplies', 0),
(633, 'NUTS', 'nuts', 0),
(634, 'NYLON PRODUCTS', 'nylon-products', 0),
(635, 'OAR EQUIPMENT', 'oar-equipment', 0),
(636, 'OFFICE EQUIPMENT & SUPPLIES', 'office-equipment-supplies', 0),
(637, 'OFFSET PLATE MAKERS', 'offset-plate-makers', 0),
(638, 'OILS', 'oils', 0),
(639, 'OLIVE PRODUCTS', 'olive-products', 0),
(640, 'OPAL PRODUCTS', 'opal-products', 0),
(641, 'OPTICAL PRODUCTS', 'optical-products', 0),
(642, 'ORANGES', 'oranges', 0),
(643, 'ORCHARD PRODUCTS', 'orchard-products', 0),
(644, 'ORCHIDS', 'orchids', 0),
(645, 'ORGANS', 'organs', 0),
(646, 'OUTDOOR PRODUCTS', 'outdoor-products', 0),
(647, 'OVEN PRODUCTS', 'oven-products', 0),
(648, 'OXIDE PRODUCTS', 'oxide-products', 0),
(649, 'OXYGEN PRODUCTS', 'oxygen-products', 0),
(650, 'PABX PRODUCTS & SUPPLIES', 'pabx-products-supplies', 0),
(651, 'PACKAGING', 'packaging', 0),
(652, 'PADLOCKS', 'padlocks', 0),
(653, 'PAINT', 'paint', 0),
(654, 'PALLETS', 'pallets', 0),
(655, 'PANEL BEATING EQUIPMENT', 'panel-beating-equipment', 0),
(656, 'PANELLING', 'panelling', 0),
(657, 'PAPER PRODUCTS', 'paper-products', 0),
(658, 'PARACHUTES', 'parachutes', 0),
(659, 'PARQUET PRODUCTS', 'parquet-products', 0),
(660, 'PARTY PRODUCTS & SUPPLIES', 'party-products-supplies', 0),
(661, 'PASTA', 'pasta', 0),
(662, 'PASTEL PRODUCTS', 'pastel-products', 0),
(663, 'PASTRY PRODUCTS', 'pastry-products', 0),
(664, 'PATCHWORK PRODUCTS', 'patchwork-products', 0),
(665, 'PATIOS', 'patios', 0),
(666, 'PATTERNS', 'patterns', 0),
(667, 'PAVING PRODUCTS', 'paving-products', 0),
(668, 'PEACHES', 'peaches', 0),
(669, 'PEANUTS', 'peanuts', 0),
(670, 'PEARL PRODUCTS', 'pearl-products', 0),
(671, 'PEARS', 'pears', 0),
(672, 'PEAS', 'peas', 0),
(673, 'PEAT PRODUCTS', 'peat-products', 0),
(674, 'PEBBLES', 'pebbles', 0),
(675, 'PEGS', 'pegs', 0),
(676, 'PELMETS', 'pelmets', 0),
(677, 'PENCILS', 'pencils', 0),
(678, 'PENS', 'pens', 0),
(679, 'PERFUME', 'perfume', 0),
(680, 'PERSPEX PRODUCTS', 'perspex-products', 0),
(681, 'PEST CONTROL PRODUCTS', 'pest-control-products', 0),
(682, 'PET CARE SUPPLIES', 'pet-care-supplies', 0),
(683, 'PETROL SUPPLIES & PRODUCTS', 'petrol-supplies-products', 0),
(684, 'PEWTER PRODUCTS', 'pewter-products', 0),
(685, 'PHARACEUTICAL SUPPLIES', 'pharaceutical-supplies', 0),
(686, 'PHONES', 'phones', 0),
(687, 'PHOTO PRODUCTS', 'photo-products', 0),
(688, 'PHOTOCOPYING PRODUCTS', 'photocopying-products', 0),
(689, 'PIANOS', 'pianos', 0),
(690, 'PICNIC PRODUCTS', 'picnic-products', 0),
(691, 'PICTURES', 'pictures', 0),
(692, 'PIES', 'pies', 0),
(693, 'PIGS', 'pigs', 0),
(694, 'PILLOWS', 'pillows', 0),
(695, 'PINS', 'pins', 0),
(696, 'PIPES', 'pipes', 0),
(697, 'PIZZA PRODUCTS & EQUIPMENT', 'pizza-products-equipment', 0),
(698, 'PLANS', 'plans', 0),
(699, 'PLANTER PRODUCTS', 'planter-products', 0),
(700, 'PLASTER PRODUCTS', 'plaster-products', 0),
(701, 'PLASTIC PRODUCTS', 'plastic-products', 0),
(702, 'PLATING EQUIPMENT', 'plating-equipment', 0),
(703, 'PLOUGH EQUIPMENT', 'plough-equipment', 0),
(704, 'PLUMBER PRODUCTS', 'plumber-products', 0),
(705, 'PLYWOOD', 'plywood', 0),
(706, 'PNEUMATIC EQUIPMENT', 'pneumatic-equipment', 0),
(707, 'POKER EQUIPMENT', 'poker-equipment', 0),
(708, 'POLES', 'poles', 0),
(709, 'POLISHING PRODUCTS', 'polishing-products', 0),
(710, 'POLYETHYLENE SUPPLIES', 'polyethylene-supplies', 0),
(711, 'POLYSTYRENE SUPPLIES', 'polystyrene-supplies', 0),
(712, 'POND SUPPLIES', 'pond-supplies', 0),
(713, 'POOLS', 'pools', 0),
(714, 'PORCELAIN SUPPLIES', 'porcelain-supplies', 0),
(715, 'POS EQUIPMENT', 'pos-equipment', 0),
(716, 'POSTERS', 'posters', 0),
(717, 'POTPOURRI SUPPLIES', 'potpourri-supplies', 0),
(718, 'POTTERY SUPPLIES', 'pottery-supplies', 0),
(719, 'POULTRY PRODUCTS', 'poultry-products', 0),
(720, 'POWDER COATING PRODUCTS', 'powder-coating-products', 0),
(721, 'POWER TOOL PRODUCTS', 'power-tool-products', 0),
(722, 'PRAMS', 'prams', 0),
(723, 'PRESERVE SUPPLIES', 'preserve-supplies', 0),
(724, 'PRINTERS', 'printers', 0),
(725, 'PRINTING', 'printing', 0),
(726, 'PROJECTORS', 'projectors', 0),
(727, 'PROPELLER PRODUCTS', 'propeller-products', 0),
(728, 'PROSPECTING', 'prospecting', 0),
(729, 'PROSTHETICS', 'prosthetics', 0),
(730, 'PROTECTIVE SUPPLIES', 'protective-supplies', 0),
(731, 'PUMPS', 'pumps', 0),
(732, 'PUPPET SUPPLIES', 'puppet-supplies', 0),
(733, 'PUTTY PRODUCTS', 'putty-products', 0),
(734, 'PVC PRODUCTS', 'pvc-products', 0),
(735, 'PVC PRODUCTS', 'pvc-products', 0),
(736, 'QUILTS', 'quilts', 0),
(737, 'RABBITS', 'rabbits', 0),
(738, 'RACING SUPPLIES', 'racing-supplies', 0),
(739, 'RACKS', 'racks', 0),
(740, 'RACQUETS', 'racquets', 0),
(741, 'RADARS', 'radars', 0),
(742, 'RADIATORS', 'radiators', 0),
(743, 'RADIO - EQUIPMENT & SUPPLIES', 'radio-equipment-supplies', 0),
(744, 'RAFTS', 'rafts', 0),
(745, 'RAGS', 'rags', 0),
(746, 'RAINWATER TANKS', 'rainwater-tanks', 0),
(747, 'RAZORS', 'razors', 0),
(748, 'RECORDING SUPPLIES', 'recording-supplies', 0),
(749, 'RECORDS', 'records', 0),
(750, 'RECYCLING SUPPLIES', 'recycling-supplies', 0),
(751, 'REELS', 'reels', 0),
(752, 'REFRIGERATION EQUIPMENT', 'refrigeration-equipment', 0),
(753, 'RELAYS', 'relays', 0),
(754, 'RELIGIOUS SUPPLIES', 'religious-supplies', 0),
(755, 'REMOTE CONTROL SUPPLIES', 'remote-control-supplies', 0),
(756, 'RESIN', 'resin', 0),
(757, 'RESPIRATOR EQUIPMENT', 'respirator-equipment', 0),
(758, 'RESTAURANT SUPPLIES', 'restaurant-supplies', 0),
(759, 'RETICULATION', 'reticulation', 0),
(760, 'RIBBONS', 'ribbons', 0),
(761, 'RICE', 'rice', 0),
(762, 'RIFLES', 'rifles', 0),
(763, 'RIGGING', 'rigging', 0),
(764, 'RINGS', 'rings', 0),
(765, 'ROAD EQUIPMENT & SUPPLIES', 'road-equipment-supplies', 0),
(766, 'ROCKS', 'rocks', 0),
(767, 'ROLLERS', 'rollers', 0),
(768, 'ROOFS', 'roofs', 0),
(769, 'ROPE', 'rope', 0),
(770, 'ROTARY PRODUCTS', 'rotary-products', 0),
(771, 'ROWING', 'rowing', 0),
(772, 'RUBBER PRODUCTS', 'rubber-products', 0),
(773, 'RUGS', 'rugs', 0),
(774, 'RUSTPROOFING SUPPLIES', 'rustproofing-supplies', 0),
(775, 'SACKS', 'sacks', 0),
(776, 'SAFETY EQUIPMENT & SUPPLIES', 'safety-equipment-supplies', 0),
(777, 'SAILS', 'sails', 0),
(778, 'SALT', 'salt', 0),
(779, 'SAND', 'sand', 0),
(780, 'SANDING SUPPLIES', 'sanding-supplies', 0),
(781, 'SAUCES', 'sauces', 0),
(782, 'SAWS', 'saws', 0),
(783, 'SCAFFOLDING EQUIPMENT', 'scaffolding-equipment', 0),
(784, 'SCALES', 'scales', 0),
(785, 'SCHOOL EQUIPMENT & SUPPLIES', 'school-equipment-supplies', 0),
(786, 'SCISSORS', 'scissors', 0),
(787, 'SCOURERS', 'scourers', 0),
(788, 'SCRAP METAL', 'scrap-metal', 0),
(789, 'SCRAPBOOKS', 'scrapbooks', 0),
(790, 'SCREEN SUPPLIES', 'screen-supplies', 0),
(791, 'SCREWS', 'screws', 0),
(792, 'SCUBA DIVING', 'scuba-diving', 0),
(793, 'SEALING', 'sealing', 0),
(794, 'SEAT BELTS', 'seat-belts', 0),
(795, 'SEATS', 'seats', 0),
(796, 'SECONDHAND PRODUCTS', 'secondhand-products', 0),
(797, 'SECURITY', 'security', 0),
(798, 'SEEDS', 'seeds', 0),
(799, 'SELF ADHESIVE PRODUCTS', 'self-adhesive-products', 0),
(800, 'SEQUIN SUPPLIES', 'sequin-supplies', 0),
(801, 'SEWAGE', 'sewage', 0),
(802, 'SEWING', 'sewing', 0),
(803, 'SHADE SUPPLIES', 'shade-supplies', 0),
(804, 'SHAMPOO', 'shampoo', 0),
(805, 'SHAVERS', 'shavers', 0),
(806, 'SHEDS', 'sheds', 0),
(807, 'SHEEP', 'sheep', 0),
(808, 'SHELLS', 'shells', 0),
(809, 'SHELVING PRODUCTS', 'shelving-products', 0),
(810, 'SHIPS', 'ships', 0),
(811, 'SHOCK ABSORBERS', 'shock-absorbers', 0),
(812, 'SHOES', 'shoes', 0),
(813, 'SHOP SUPPLIES', 'shop-supplies', 0),
(814, 'SHOVELS', 'shovels', 0),
(815, 'SHREDDERS', 'shredders', 0),
(816, 'SIGNS', 'signs', 0),
(817, 'SILICONE PRODUCTS', 'silicone-products', 0),
(818, 'SILK', 'silk', 0),
(819, 'SILVER', 'silver', 0),
(820, 'SINKS', 'sinks', 0),
(821, 'SIRENS', 'sirens', 0),
(822, 'SKATES', 'skates', 0),
(823, 'SKIPS', 'skips', 0),
(824, 'SLIDES', 'slides', 0),
(825, 'SOAPS', 'soaps', 0),
(826, 'SOFAS', 'sofas', 0),
(827, 'SOFTWARE PRODUCTS', 'software-products', 0),
(828, 'SOIL PRODUCTS', 'soil-products', 0),
(829, 'SOLVENT SUPPLIES', 'solvent-supplies', 0),
(830, 'SPA\'S', 'spas', 0),
(831, 'SPEAKERS', 'speakers', 0),
(832, 'SPIRITS', 'spirits', 0),
(833, 'SPLINTS', 'splints', 0),
(834, 'SPONGES', 'sponges', 0),
(835, 'SPORTING EQUIPMENT', 'sporting-equipment', 0),
(836, 'SPRAYING SUPPLIES', 'spraying-supplies', 0),
(837, 'SPRINKLERS', 'sprinklers', 0),
(838, 'SPROCKETS', 'sprockets', 0),
(839, 'STAGE SUPPLIES', 'stage-supplies', 0),
(840, 'STAINLESS STEEL SUPPLIES', 'stainless-steel-supplies', 0),
(841, 'STAIRCASES', 'staircases', 0),
(842, 'STAKES', 'stakes', 0),
(843, 'STAMPS', 'stamps', 0),
(844, 'STAPLES', 'staples', 0),
(845, 'STEEL PRODUCTS', 'steel-products', 0),
(846, 'STEREOS', 'stereos', 0),
(847, 'STERILISING', 'sterilising', 0),
(848, 'STICKERS', 'stickers', 0),
(849, 'STOCK SUPPLIES', 'stock-supplies', 0),
(850, 'STONE PRODUCTS', 'stone-products', 0),
(851, 'STOOLS', 'stools', 0),
(852, 'STOVES', 'stoves', 0),
(853, 'STRAWS', 'straws', 0),
(854, 'SUEDE PRODUCTS', 'suede-products', 0),
(855, 'SUN GLASSES & PROTECTION PRODUCTS', 'sun-glasses-protection-products', 0),
(856, 'SURFBOARD', 'surfboard', 0),
(857, 'SURGICAL EQUIPMENT', 'surgical-equipment', 0),
(858, 'SWIMMING POOLS', 'swimming-pools', 0),
(859, 'SWITCHBOARDS', 'switchboards', 0),
(860, 'SWORDS', 'swords', 0),
(861, 'SYNTHETIC PRODUCTS', 'synthetic-products', 0),
(862, 'T SHIRTS', 't-shirts', 0),
(863, 'TABLES', 'tables', 0),
(864, 'TALCOLM POWDER', 'talcolm-powder', 0),
(865, 'TANKS', 'tanks', 0),
(866, 'TAPE', 'tape', 0),
(867, 'TAPS', 'taps', 0),
(868, 'TARPAULIN PRODUCTS', 'tarpaulin-products', 0),
(869, 'TEA', 'tea', 0),
(870, 'TEDDY BEARS', 'teddy-bears', 0),
(871, 'TELEPHONES', 'telephones', 0),
(872, 'TELESCOPES', 'telescopes', 0),
(873, 'TELEVISIONS', 'televisions', 0),
(874, 'TENNIS EQUIPMENT', 'tennis-equipment', 0),
(875, 'TENT SUPPLIES', 'tent-supplies', 0),
(876, 'TEXTILES', 'textiles', 0),
(877, 'THREAD SUPPLIES', 'thread-supplies', 0),
(878, 'TILES', 'tiles', 0),
(879, 'TIMBER PRODUCTS', 'timber-products', 0),
(880, 'TOASTERS', 'toasters', 0),
(881, 'TOBACCO', 'tobacco', 0),
(882, 'TOILETS', 'toilets', 0),
(883, 'TOOL SUPPLIES', 'tool-supplies', 0),
(884, 'TORCHES', 'torches', 0),
(885, 'TOWBARS', 'towbars', 0),
(886, 'TOWEL SUPPLIES', 'towel-supplies', 0),
(887, 'TOYS', 'toys', 0),
(888, 'TRACTORS', 'tractors', 0),
(889, 'TRAILERS', 'trailers', 0),
(890, 'TRANSMISSIONS', 'transmissions', 0),
(891, 'TRAPS', 'traps', 0),
(892, 'TREES', 'trees', 0),
(893, 'TROLLEYS', 'trolleys', 0),
(894, 'TRUCKS', 'trucks', 0),
(895, 'TUBES', 'tubes', 0),
(896, 'TURNTABLES', 'turntables', 0),
(897, 'TYPEWRITERS', 'typewriters', 0),
(898, 'TYRES', 'tyres', 0),
(899, 'UMBRELLAS', 'umbrellas', 0),
(900, 'UPHOLSTERY SUPPLIES', 'upholstery-supplies', 0),
(901, 'VACUUM CLEANERS', 'vacuum-cleaners', 0),
(902, 'VALVES', 'valves', 0),
(903, 'VARNISH SUPPLIES', 'varnish-supplies', 0),
(904, 'VETERINARY EQUIPMENT', 'veterinary-equipment', 0),
(905, 'VIDEOS', 'videos', 0),
(906, 'VINEYARD EQUIPMENT', 'vineyard-equipment', 0),
(907, 'VINYL PRODUCTS', 'vinyl-products', 0),
(908, 'WALKING AID SUPPLIES', 'walking-aid-supplies', 0),
(909, 'WALLETS', 'wallets', 0),
(910, 'WALLPAPER', 'wallpaper', 0),
(911, 'WALLS', 'walls', 0),
(912, 'WARDROBES', 'wardrobes', 0),
(913, 'WAREHOUSE PRODUCTS', 'warehouse-products', 0),
(914, 'WASHING MACHINES', 'washing-machines', 0),
(915, 'WATCHES', 'watches', 0),
(916, 'WATER', 'water', 0),
(917, 'WAX SUPPLIES', 'wax-supplies', 0),
(918, 'WEDDING SUPPLIES', 'wedding-supplies', 0),
(919, 'WEIGHING', 'weighing', 0),
(920, 'WELDING PRODUCTS', 'welding-products', 0),
(921, 'WHEELS', 'wheels', 0),
(922, 'WINCHES', 'winches', 0),
(923, 'WINDOWS', 'windows', 0),
(924, 'WINDSCREENS', 'windscreens', 0),
(925, 'WINE', 'wine', 0),
(926, 'WIRE SUPPLIES', 'wire-supplies', 0),
(927, 'WOOD SUPPLIES & PRODUCTS', 'wood-supplies-products', 0),
(928, 'WOOL', 'wool', 0),
(929, 'WORMS', 'worms', 0),
(930, 'YACHTS', 'yachts', 0),
(931, 'ZINC PRODUCTS', 'zinc-products', 0),
(932, 'ZIPPERS', 'zippers', 0),
(933, 'ACCOMMODATION', 'accommodation', 0),
(934, 'WEB DESIGN', 'web-design', 0);


-- --------------------------------------------------------

--
-- Table structure for table `mod_news`
--

CREATE TABLE `mod_news` (
  `id` int(11) NOT NULL,
  `content_pagesID` int(11) NOT NULL,
  `content_text` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `NType` enum('Member','Public') DEFAULT 'Public',
  `usersID` int(11) NOT NULL DEFAULT '0',
  `Approved` enum('Yes','No') NOT NULL DEFAULT 'No',
  `SOrder` int(5) NOT NULL DEFAULT '0',
  `MNType` enum('Headline','Article','Archive') NOT NULL DEFAULT 'Article',
  `description` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mod_news`
--
-- --------------------------------------------------------

--
-- Table structure for table `mod_text`
--

CREATE TABLE `mod_text` (
  `id` int(11) NOT NULL,
  `content_pagesID` int(11) NOT NULL,
  `content_text` text NOT NULL,
  `sidebar_content` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mod_text`
--

INSERT INTO `mod_text` (`id`, `content_pagesID`, `content_text`, `sidebar_content`) VALUES

(1, 1, 'Under Constructon', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE `servers` (
  `id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Main_Url` varchar(100) NOT NULL,
  `ClientsID` int(11) NOT NULL,
  `ServerName` varchar(50) NOT NULL,
  `ServerAdmin` varchar(255) NOT NULL,
  `IP_Hostname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`id`, `Name`, `Main_Url`, `ClientsID`, `ServerName`, `ServerAdmin`, `IP_Hostname`) VALUES
(1, 'Localhost Home', 'localhost', 6, 'db-local.php', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `servers_databases`
--

CREATE TABLE `servers_databases` (
  `id` int(11) NOT NULL,
  `serversID` int(11) NOT NULL,
  `hostname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dbname` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `servers_databases`
--

INSERT INTO `servers_databases` (`id`, `serversID`, `hostname`, `username`, `password`, `dbname`) VALUES
(1, 1, 'localhost', 'bubblelite', 'passsword', 'bubblelite2');

-- --------------------------------------------------------

--
-- Table structure for table `siteuserclient`
--

CREATE TABLE `siteuserclient` (
  `id` int(11) NOT NULL,
  `timenow` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `guid` varchar(32) NOT NULL,
  `domainsID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siteuserclient`
--


-- --------------------------------------------------------

--
-- Table structure for table `site_variables`
--

CREATE TABLE `site_variables` (
  `id` int(11) NOT NULL,
  `siteuserclient_id` int(11) NOT NULL,
  `var_type` varchar(20) NOT NULL,
  `var_name` varchar(50) NOT NULL,
  `var_value` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_variables`
--

INSERT INTO `site_variables` (`id`, `siteuserclient_id`, `var_type`, `var_name`, `var_value`) VALUES
(1, 1, 'SERVER', 'REMOTE_ADDR', '127.0.0.1'),
(2, 1, 'SERVER', 'HTTP_HOST', 'cwl.strangled.net');

-- --------------------------------------------------------

--
-- Table structure for table `site_variables_big`
--

CREATE TABLE `site_variables_big` (
  `id` int(11) NOT NULL,
  `siteuserclient_id` int(11) NOT NULL,
  `big_var_value` blob NOT NULL,
  `var_type` varchar(20) NOT NULL,
  `var_name` varchar(50) NOT NULL,
  `var_value` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Dir` varchar(100) NOT NULL,
  `Hidden` enum('Yes','No') NOT NULL DEFAULT 'No',
  `allow_sidebar` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `Name`, `Dir`, `Hidden`, `allow_sidebar`) VALUES
(6, 'Dual Diagnosis', 'dualdiagnosis_main', 'No', 'No'),
(7, 'dark-sunflower', 'dark-sunflower', 'No', 'No'),
(8, 'bcmsl', 'bcmsl', 'No', 'No'),
(9, 'InSense', 'InSense', 'No', 'No'),
(10, 'problog-10', 'problog-10', 'No', 'No'),
(11, 'ColdBlue', 'ColdBlue', 'No', 'No'),
(12, 'Black And Green', 'LoadFoO', 'No', 'No'),
(13, 'Transparent Blue', 'transparentia', 'No', 'No'),
(14, 'Greeny', 'metamorph_greeny', 'No', 'No'),
(15, 'Translucent Fluidity', 'Translucent_Fluidity', 'No', 'No'),
(5, 'blank', 'blank', 'No', 'No'),
(16, 'GCWD HomePage', 'gcwd', 'No', 'No'),
(17, 'GCWD Sub Pages', 'gcwd-sub', 'No', 'No'),
(18, 'CWLNet HomePage', 'cwlnet', 'No', 'No'),
(19, 'CWLNet Sub Pages', 'cwlnet-sub', 'No', 'No'),
(20, 'Bubble Lite', 'bubblelite', 'No', 'No'),
(21, 'True Church', 'true_church', 'No', 'Yes'),
(22, 'XML', 'xml', 'No', 'No'),
(23, 'Install', 'install', 'No', 'No'),
(24, 'GCWD clear', 'gcwd-clear', 'No', 'No'),
(25, 'Beautiful Night', 'beautiful-night', 'No', 'No'),
(26, 'Bright Side Of Life', 'bright-side-of-life-1.0', 'No', 'No'),
(27, 'Blue', 'blue', 'No', 'No'),
(28, 'Bubble', 'bubble', 'No', 'No'),
(29, 'Business Today', 'businesstoday', 'No', 'No'),
(30, 'Chess Piece', 'chesspiece-2', 'No', 'No'),
(31, 'City Nightlife', 'city-nightlife', 'No', 'No'),
(32, 'Cool Web', 'cool-web', 'No', 'No'),
(33, 'Corporate', 'corporate', 'No', 'No'),
(34, 'Darkness', 'darkness', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `NAME` varchar(150) DEFAULT NULL,
  `address` varchar(100) DEFAULT '',
  `address2` varchar(111) NOT NULL,
  `address3` varchar(111) NOT NULL,
  `suburb` varchar(30) DEFAULT '',
  `city` varchar(111) NOT NULL,
  `state` varchar(20) DEFAULT '',
  `postcode` int(11) DEFAULT '0',
  `countryID` int(11) NOT NULL,
  `subdomain` varchar(50) DEFAULT '',
  `phone` varchar(30) DEFAULT '',
  `mobile` varchar(30) DEFAULT '',
  `fax` varchar(30) DEFAULT '',
  `email` varchar(50) DEFAULT '',
  `website` varchar(80) DEFAULT '',
  `contact_name` varchar(30) DEFAULT '',
  `PASSWORD` varchar(50) DEFAULT NULL,
  `email_notify` tinyint(4) DEFAULT '1',
  `login_counter` int(11) DEFAULT '0',
  `abn` varchar(15) DEFAULT '',
  `business_description` text,
  `mod_business_categoriesID` int(11) NOT NULL,
  `STATUS` enum('Approved','New','Rejected') NOT NULL DEFAULT 'New',
  `clientsID` int(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `churches`
--
ALTER TABLE `churches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `State` (`State`),
  ADD KEY `PostCode` (`PostCode`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_pages`
--
ALTER TABLE `content_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_views`
--
ALTER TABLE `module_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mod_business_categories`
--
ALTER TABLE `mod_business_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mod_text`
--
ALTER TABLE `mod_text`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servers_databases`
--
ALTER TABLE `servers_databases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `churches`
--
ALTER TABLE `churches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2175;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `content_pages`
--
ALTER TABLE `content_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1574;

--
-- AUTO_INCREMENT for table `module_views`
--
ALTER TABLE `module_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5553;

--
-- AUTO_INCREMENT for table `mod_business_categories`
--
ALTER TABLE `mod_business_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3738;

--
-- AUTO_INCREMENT for table `mod_text`
--
ALTER TABLE `mod_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3119;

--
-- AUTO_INCREMENT for table `servers_databases`
--
ALTER TABLE `servers_databases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;
