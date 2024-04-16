
INSERT INTO `list_multi_select_item_groups` (`id`, `group_label`, `group-code`) VALUES
(1,	'Url Prefix',	'item-groups-url-prefixID'),
(2,	'Domain Prefixes',	'item-groups-domain-prefixID'),
(3,	'Server Types',	'item-groups-server-typesID'),
(4,	'User-Types',	'item-groups-user-typesID'),
(5,	'User-Account-Types',	'item-groups-user-account-typesID'),
(6,	'Yes | No',	'item-groups-Boolean-ModalID'),
(7,	'Hosting Types',	'item-groups-hosting-typesID'),
(8,	'Contact Types',	'item-groups-contact-typesID'),
(9,	'Types of Assets',	'item-groups-asset-typesID'),
(10,	'Page permissions',	'item-groups-page-exposureID'),
(11,	'User Types',	'item-groups-user-typeID'),
(12,	'News Item Levels',	'item-groups-news-typesID'),
(13,	'Server Hardware Types',	'item-groups-hardware-typeID');

INSERT INTO `list_multi_select_items` (`id`, `list_multi_select_item_groupsID`, `item_label`) VALUES
(34,	9,	'image'),
(35,	9,	'flash'),
(36,	10,	'Public'),
(37,	10,	'Member'),
(38,	10,	'Both'),
(39,	11,	'Member'),
(40,	11,	'Public'),
(41,	12,	'Headline'),
(42,	12,	'Article'),
(43,	12,	'Archive'),
(44,	13,	'VPS'),
(45,	13,	'Dedicated'),
(46,	13,	'Co-Location');

