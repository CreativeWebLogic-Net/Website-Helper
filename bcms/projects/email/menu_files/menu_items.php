<?php
	session_start();
	if(!$SecureKey){
		header("Location: ../../index.php");
	};
	include("../cast128.php");
	$e = new cast128;
	$e->setkey("kjhnsdf fdsiohjf fasdujhf asduijdsi");
	$TmpKey=split("-",$e->decrypt($SecureKey));
	$AdminKey=$TmpKey[0];
	$ClientsID=$TmpKey[1];
	$Theme=$TmpKey[2];

	require("database.php");
	$PArr=array();
	$sq2 = mysql_query("SELECT Code FROM Permissions WHERE AdministratorsID='$AdminKey'",$db);
	while ($myrow = mysql_fetch_row($sq2)) {
		$PArr[]=$myrow[0];
	};
	$NormalServer="http://sms.dalc.info";
		
?>
/* --- menu items --- */
var MENU_ITEMS0 = [
	//Home
	['HOME', 'http://sms.i4u.com.au/main/logged-in/index.php'],
	// Administrators
	['ADMINISTRATORS', null,{'bl':80}
			<?php 
				if(in_array(1,$PArr)){
					echo",['Add','$NormalServer/main/administrators/index.php']";
				};
			
				if(in_array(2,$PArr)){
					echo",['Modify / Delete','$NormalServer/main/administrators/modify.php']";
				};
			?>			
			,['Change Your Password','http://sms.i4u.com.au/main/administrators/password.php']
						
	],
	// Members
	['CONTACTS', null,{'bl':80}
			<?php 
				if(in_array(4,$PArr)){
					echo",['Add','$NormalServer/main/members/index.php']";
				};
				if(in_array(5,$PArr)){
					echo",['Modify / Delete','$NormalServer/main/members/modify.php']";
				};	
			?>
	],	
	<? if($Theme==2){ ?>
	
	['HORSES', null,{'bl':80}
			<?php 
				if(in_array(10,$PArr)){
					echo",['Add','$NormalServer/main/horses/index.php']";
				};
				if(in_array(11,$PArr)){
					echo",['Modify / Delete','$NormalServer/main/horses/modify.php']";
				};	
			?>
	],
	
	
	<? }; ?>
	
	<?php 
		if(in_array(7,$PArr)){
			echo"['SEND SMS', null,{'bl':80}
					,['Send','$NormalServer/main/send/index.php']
				],";
		};	
	?>
	// Client Changes
	<?php if($SU){ ?>
			['CLIENTS', null,{'bl':80}
					,['Add','http://sms.i4u.com.au/main/clients/index.php']
					,['Modify / Delete','http://sms.i4u.com.au/main/clients/modify.php']
			],
		
			['FAQs', null,{'bl':80}
					,['Add','http://sms.i4u.com.au/main/faqs/index.php']
					,['Modify / Delete','http://sms.i4u.com.au/main/faqs/modify.php']
			],
	<? }; ?>
	// Reports
	<?php 
		if(in_array(8,$PArr)){
			echo"['REPORTS', null,{'bl':80}
					,['View','$NormalServer/main/reports/index.php']
				],";
		};	
	?>			
		// Setup
	<?php
		if($SU){
			echo"['SETUP', null,{'bl':80},
						['Administration Colour scheme','$NormalServer/main/setup/colour-scheme.php']
						,['Recipient Emails','$NormalServer/main/administrators/recipient-emails.php']		
				],";
		};
	?>
	['CREDITS','https://secure2.i4u.com.au/~sms.i4u/main/credits/index.php?SKey=<?=urlencode($SecureKey); ?>'],
	
	['HELP & SUPPORT', null,{'bl':80}
			,['FAQs','http://sms.i4u.com.au/main/faqs/content.php']
			,['Tutorial','http://sms.i4u.com.au/main/help/tutorial.php']
			,['Contact Us','http://sms.i4u.com.au/main/help/index.php']
	],
	//Messages
	<?php if($SU){ ?>
			['MESSAGES', null,{'bl':80}
					,['Add','http://sms.i4u.com.au/main/messages/index.php']
					,['Modify / Delete','http://sms.i4u.com.au/main/messages/modify.php']
			],
	<? }; ?>
	['LOGOUT','http://sms.i4u.com.au/logout.php']
];