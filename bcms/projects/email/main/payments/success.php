<?
	//include("../../../management/Mail_Class.php");
	include("../../DB_Class.php");
	
	/*$req = 'cmd=_notify-validate';

	foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
	}
	
	// post back to PayPal system to validate
	$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	$fp = fsockopen ('sandbox.paypal.com', 80, $errno, $errstr, 30);
	*/
	// assign posted variables to local variables
	$item_name = $_POST['item_name'];
	$item_number = $_POST['item_number'];
	$payment_status = $_POST['payment_status'];
	$payment_amount = $_POST['mc_gross'];
	$payment_currency = $_POST['mc_currency'];
	$txn_id = $_POST['txn_id'];
	$receiver_email = $_POST['receiver_email'];
	$payer_email = $_POST['payer_email'];
	/*
	$Body=$header . $req;
	
	if (!$fp) {
	// HTTP ERROR
	echo "error";
	} else {
	fputs ($fp, $header . $req);
	while (!feof($fp)) {
	$res = fgets ($fp, 1024);
	$Body.="=======================<br>\n".$res;
	
	if (strcmp ($res, "VERIFIED") == 0) {
	// check the payment_status is Completed
	// check that txn_id has not been previously processed
	// check that receiver_email is your Primary PayPal email
	// check that payment_amount/payment_currency are correct
	// process payment
		*/
		
		$r=new ReturnRecord();
		
		$r->rawQuery("UPDATE Payments SET Success='Yes' WHERE id='$item_number'");
		$rslt=$r->rawQuery("SELECT PaymentPlansID,MonthsPaid,ClientsID FROM Payments WHERE id='$item_number'");
		$data=mysql_fetch_array($rslt);
		$r->rawQuery("UPDATE Clients SET PaymentPlansID='$data[0]',Expiry=DATE_ADD(NOW(),INTERVAL '$data[1]'  MONTH) WHERE id='$data[2]'");
	/*
	}
	else if (strcmp ($res, "INVALID") == 0) {
	// log for manual investigation
		echo"not valid";
	}
	}
	fclose ($fp);
	}
	*/
	/*
	$EmailBody='<strong>Thank you for your purchase below is your tax reciept</strong>
	<table width="93%"  border="0" align="center" cellpadding="3" cellspacing="1" id="ProductRow">
        <tr bgcolor="#C6C6CD" >
          <td width="21%"><strong>Name</strong></td>
          <td><strong>Description</strong></td>
          <td><strong>Product Code </strong></td>
          <td><strong>Price</strong></td>
          <td><strong>Wholesale<br>
            Price</strong></td>
          <td><strong>Amount</strong></td>
          <td width="9%"><strong>Sub Total </strong></td>
        </tr>';
        
	$Count=0;
	$Total=0;
	
	$r=new ReturnRecord();
	
	$r->AddTable("OrderDetails");
	$r->AddSearchVar($item_number);
	$Insert=$r->GetRecord();
	
	$sq2=$r->rawQuery("SELECT id,Name,SDesc,Price,Delivery,Amount,ProductCode,WPrice FROM ProductOrders WHERE OrderDetailsID='$item_number' ");  
	while ($myrow = mysql_fetch_row($sq2)) {
		$Count++;
		$STotal+=$myrow[3]*$myrow[5];
		$DTotal+=$myrow[4];
		$Total+=($myrow[3]*$myrow[5])+$myrow[4];
		if($Insert['Country']==1)
			$GST+=(($myrow[3]*$myrow[5])+$myrow[4])/10;
					
        $EmailBody.="<tr bgcolor=\"".(($Count%2)==0 ? "#CECECE" : "#E5E5E5")."\" >
          <td>".$myrow[1].".<br>------------<br>
		  	<table>";
			
			
		$sq3=$r->rawQuery("SELECT Question,Value,Adjustment FROM ProductOptionValues WHERE ProductOrdersID='$myrow[0]'");  									        while ($myrow2 = mysql_fetch_row($sq3)) {
			$EmailBody.="<tr><td>$myrow2[0]</td><td>$myrow2[1]</td><td>$$myrow2[2]</td></tr>";
			$STotal+=$myrow2[2]*$myrow[5];
			$Total+=$myrow2[2]*$myrow[5];
		};
		$EmailBody.="</table>		  </td>
          <td width=\"34%\">".$myrow[2]."</td>
          <td width=\"20%\">".$myrow[6]."</td>
          <td width=\"4%\" align=\"left\">$".number_format($myrow[3],2)."</td>
          <td width=\"3%\" align=\"left\">$".number_format($myrow[7],2)."</td>
          <td width=\"9%\" align=\"left\">".$myrow[5]."</td>
          <td align=\"center\">".number_format($myrow[5]*$myrow[3],2)."</td>
        </tr>";
     };
	 $EmailBody.='<tr bgcolor="#C6C6CD"  >
          <td colspan="6" align="right">Total</td>
          <td>$'.number_format($STotal,2).'</td>
        </tr>
        <tr bgcolor="#C6C6CD"  id="GSTRow">
          <td colspan="6" align="right">Delivery Total</td>
          <td>$'.$Insert['Delivery'].'</td>
        </tr>
        <tr bgcolor="#C6C6CD"  >
          <td colspan="6" align="right">GST</td>
          <td>$'.number_format($GST,2).'</td>
        </tr>
        <tr bgcolor="#C6C6CD"  >
          <td colspan="6" align="right">Final Total</td>
          <td>$'.number_format($STotal+$Insert['Delivery']+$GST,2).'</td>
        </tr>
        <tr bgcolor="#405175"  >
          <td colspan="7"><div align="right">
          </div></td>
        </tr>
      </table>';
	
	$sq2=$r->rawQuery("SELECT Invoices FROM AdminEmails WHERE id='1'");  
	$AEmail = mysql_fetch_array($sq2);
	
	$m=new SendMail();
	$m->To(array($Insert['Name']=>$Insert['Email'],"Admin"=>$AEmail[0]));
	$m->From("Shopping Cart Admin",$AEmail[0]);
	$m->Subject("Invoice");
	$m->Template("../../emailtemplates/standard.htm");
	$m->Merge(array("maintext"=>$EmailBody,"server"=>$_SERVER['HTTP_HOST']));
	$m->Send();
	*/
	
	
	
?>