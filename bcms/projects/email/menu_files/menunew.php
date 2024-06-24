<?php
	include("../Perms_Class.php");
	$p=new Permissions($AdminKey);
	$NormalServer="http://www.smsmailpro.com";
	$ShowMenu=true;
?>
<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><script type="text/javascript" src="../../jscript/p7tmscripts.js"></script>
	<div id="p7TMctrl" align="center">
		<a href="#" onClick="P7_TMall(0);return false">Expand All</a> | <a href="#" onClick="P7_TMall(1);return false">Collapse All</a>
	</div>
	<div  id="p7TMnav">
		
	<div>
		<a href='<?=$NormalServer?>/main/logged-in/index.php' target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> HOME</a>
	</div>
    <div>
		<a href='<?=$NormalServer?>/main/getcodes/index.php' target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> GET CODES</a>
	</div>
	<? if($ShowMenu){?>
	
	<div><a href="#" onClick="P7_TMenu(this);return false" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuExpand.gif' border='0'> ADMINISTRATORS</a>
				
			<?php 
				if($p->CheckCode(1)){?>
					<div>
					  <a href='<?=$NormalServer?>/main/administrators/index.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Add</a>
					</div>
					<?
					};
				if($p->CheckCode(2)){
				?>
					<div>
					  <a href='<?=$NormalServer?>/main/administrators/modify.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Modify / Delete</a>
					</div>
					<?
					};	
			?>
			<div>
			  <a href='<?=$NormalServer?>/main/administrators/password.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Change Your Password</a>
	  </div>
	</div>
	<div><a href="#" onClick="P7_TMenu(this);return false" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuExpand.gif' border='0'> CONTACTS</a>
					<?php 
				if($p->CheckCode(4)){?>
					<div>
					  <a href='<?=$NormalServer?>/main/members/index.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Add</a>
					</div>
					<?
					};
				if($p->CheckCode(5)){
				?>
					<div>
					  <a href='<?=$NormalServer?>/main/members/modify.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Modify / Delete</a>
					</div>
					<?
					};	
			?>
			<?php 
				if($p->CheckCode(4)){?>
					<div>
					  <a href='<?=$NormalServer?>/main/members/import.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Import CSV</a>
					</div>
					<?
					};
				?>
			<div><a href="#" onClick="P7_TMenu(this);return false"  style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuExpand.gif' border='0'> GROUPS</a>
				<div>
				  <a href='<?=$NormalServer?>/main/members/index-groups.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Add</a>
			  </div>
					<div>
					  <a href='<?=$NormalServer?>/main/members/modify-groups.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Modify / Delete</a>
					</div>
			
			</div>
			<div><a href="#" onClick="P7_TMenu(this);return false" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuExpand.gif' border='0'> FIELDS</a>
					<div>
					  <a href='<?=$NormalServer?>/main/doptions/index.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Add</a>
			  </div>
						<div>
						  <a href='<?=$NormalServer?>/main/doptions/modify.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Modify / Delete</a>
						</div>
				
		  </div>
	    </div>
	
		<div><a href="#" onClick="P7_TMenu(this);return false" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuExpand.gif' border='0'> TEMPLATES</a>	
			<?php if($p->CheckCode(19)){?>
			<div>
			  <a href='<?=$NormalServer;?>/main/templates/index.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Add</a>
			</div>
			<? }; ?>
			<?php if($p->CheckCode(20)){?>
			<div>
			  <a href='<?=$NormalServer;?>/main/templates/modify.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Modify / Delete</a>
			</div>
			<? }; ?>
		</div>
		<?
		//};	
	?>
	<!--
	<?php 
		if($p->CheckCode(7)){?>
		<div><a href="#" onClick="P7_TMenu(this);return false" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuExpand.gif' border='0'> SMS</a>
			<div>
				<a href='<?=$NormalServer;?>/main/send/index.php' style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Quick SMS</a>
			</div>
		</div>
		<?
		};	
	?>-->
		<div><a href="#" onClick="P7_TMenu(this);return false" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuExpand.gif' border='0'> EMAIL</a>
			<?php 
		if($p->CheckCode(10)){?>
			<div>
			  <a href='<?=$NormalServer;?>/main/email/index.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Create Message</a>
			</div>
		<? };
		if($p->CheckCode(11)){?>
			<div>
			  <a href='<?=$NormalServer;?>/main/email/modify.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Send/View Messages</a>
			</div>
			<? }; ?>
		</div>
		<div><a href="#" onClick="P7_TMenu(this);return false" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuExpand.gif' border='0'> SMS</a>
			<?php 
		if($p->CheckCode(22)){?>
			<div>
			  <a href='<?=$NormalServer;?>/main/sms/index.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Create Message</a>
			</div>
		<? };
		if($p->CheckCode(23)){?>
			<div>
			  <a href='<?=$NormalServer;?>/main/sms/modify.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Send/View Messages</a>
			</div>
			<? }; ?>
		</div>
		
		<div><a href="#" onClick="P7_TMenu(this);return false" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuExpand.gif' border='0'> WEBMAIL</a>
			<?php 
		if($p->CheckCode(13)){?>
			<div>
			  <a href='<?=$NormalServer;?>/main/webmail/index-folders.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Create Folder</a>
			</div>
		<? };
		if($p->CheckCode(14)){?>
			<div>
			  <a href='<?=$NormalServer;?>/main/webmail/modify-folders.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Modify/Delete Folders</a>
			</div>
			<? }; ?>
			<?php if($p->CheckCode(13)){?>
			<div>
			  <a href='<?=$NormalServer;?>/main/webmail/index-pop3.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Create Mailbox</a>
			</div>
			<? }; ?>
			<?php if($p->CheckCode(14)){?>
			<div>
			  <a href='<?=$NormalServer;?>/main/webmail/modify-pop3.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Modify/Delete Mailboxes</a>
			</div>
			<div>
			  <a href='<?=$NormalServer;?>/main/webmail/modify.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Inbox</a>
			</div>
			<? }; ?>
			<?php if($p->CheckCode(13)){?>
			<div>
			  <a href='<?=$NormalServer;?>/main/webmail/index.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Compose</a>
			</div>
			<? }; ?>
		</div>
		
		<div><a href="#" onClick="P7_TMenu(this);return false" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuExpand.gif' border='0'> AUTORESPONDER</a>
			<?php 
			if($p->CheckCode(16)){?>
				<div>
				  <a href='<?=$NormalServer;?>/main/autoresponder/index-streams.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Create Stream</a>
				</div>
			<? };
			if($p->CheckCode(17)){?>
				<div>
				  <a href='<?=$NormalServer;?>/main/autoresponder/modify-streams.php'  target="mainFrame" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Modify Streams</a>
				</div>
			<? }; ?>
		</div>
			
	<?php if($_SESSION['SU']){ ?>
			<div><a href="#" onClick="P7_TMenu(this);return false" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuExpand.gif' border='0'> CLIENTS</a>
					<div>
					  <a href='/main/clients/index.php' style='color: #142F4A'  target="mainFrame" onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Add</a>
					</div>
					<div>
					  <a href='/main/clients/modify.php' style='color: #142F4A'  target="mainFrame" onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Modify / Delete</a>
					</div>
			</div>
			<div>
		  <a href='/main/payments/paypal-log.php' style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" target="mainFrame" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> PAYPAL LOGS</a>
		</div>
	<? }; ?>
	<?php 
		if($p->CheckCode(8)){
			?>
			<div><a href="#" onClick="P7_TMenu(this);return false" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuExpand.gif' border='0'> REPORTS</a>
					<div>
					  <a href='/main/reports/index.php' style='color: #142F4A'  target="mainFrame" onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Logs</a>
					</div>
					<div>
					  <a href='/main/reports/modify.php' style='color: #142F4A'  target="mainFrame" onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Un-Received Emails</a>
					</div>
			</div>
			
			
			<?
		};	
	?>			
	
	<?php
		if($_SESSION['SU']){?>
	<div><a href="#" onClick="P7_TMenu(this);return false" style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuExpand.gif' border='0'> SETUP</a>
			
			<div>
			  <a href='/main/administrators/recipient-emails.php' style='color: #142F4A'  target="mainFrame" onMouseOver="this.style.color='#1D456D'" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> Recipient Emails</a>
			</div>
	</div>
	<?
	};
	?>
	
	
	
	
	
	<? };?>
		<div>
		  <a href='/main/payments/index.php' style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" target="mainFrame" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> BUY CREDITS</a>
		</div>
	
		<div>
		  <a href='/main/tutorials/index.php' style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" target="mainFrame" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> TUTORIALS</a>
		</div>
		<div>
		  <a href='/logout.php' style='color: #142F4A' onMouseOver="this.style.color='#1D456D'" target="_top" onMouseOut="this.style.color='#142F4A'"><img src='../main/Pics/menuUnexpandable.gif' border='0'> LOGOUT</a>
		</div>
	</div>	      </td>
  </tr>
</table>



