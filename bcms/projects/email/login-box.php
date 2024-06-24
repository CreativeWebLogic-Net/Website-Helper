<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>

  <form action="index.php" method="post" enctype="multipart/form-data" name="form1" id="form3" >
    
      <table align="right" cellpadding="4" cellspacing="0" class="wizardStyle">
        <tr>
          <td><table border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><div align="center"><span class="style1"><strong>Login Here</strong></span><br />
                        <span class="RedText"><?php print $Message; ?></span> </div>
                    <table width="100%" border="0" cellpadding="0" cellspacing="1">
                      <tr >
                        <td width="43%"><strong><span class="style1">Username</span></strong></td>
                        <td width="57%"><input name="UserName" type="text" id="UserName2" /></td>
                      </tr>
                      <tr >
                        <td><span class="style1"><strong>Password</strong></span></td>
                        <td><input name="Password" type="password" id="Password" /></td>
                      </tr>
                      <tr align="right" >
                        <td colspan="2" align="center"><input name="Remember" type="checkbox" id="Remember" value="true" />
                        Remember Me</td>
                      </tr>
                      <tr align="right" >
                        <td colspan="2" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><a href="forgot-password.php">Forgot Password?</a> </td>
                            <td align="right"><input name="Submit" type="submit" class="formbuttons" id="Submit" value="Log in"/></td>
                          </tr>
                        </table>
                        </td>
                      </tr>
                  </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
    
  </form>

