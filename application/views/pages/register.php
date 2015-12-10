<br>
<br>
<br>
<br>
<br>
<br>


    <h1 class="section" style="width:800px; margin:0 auto;">Register Account</h1>
 

    <form action="https://www.kitapyurdu.com/index.php?route=account/register" method="post" enctype="multipart/form-data" style="width:800px; margin:0 auto;" >

	<div class="grid_6 alpha" >
	    <div class="box background-light">
		<!-- DETAILS SECTION -->
		<div class="padding" >
		    <table class="form" >
			<tr>
			    <td>First Name:</td>
			    <td><input type="text" name="firstname" value="" maxlength="30"/>
				</td>
			</tr>
			<tr>
			    <td>Last Name:</td>
			    <td><input type="text" name="lastname" value="" maxlength="30"/>
				</td>
			</tr>
			
			
			<tr>
			    <td><span class="required">*</span> Password:</td>
			    <td><input type="password" name="password" value="" maxlength="12"/>
				</td>
			</tr>
			<tr>
			    <td><span class="required">*</span> Password Confirm:</td>
			    <td><input type="password" name="confirm" value="" maxlength="12"/>
				</td>
			</tr>
				
		
			<tr>
			    <td>Age:</td>
				<td><input type="number" name="quantity" min="1" max="100"></td>
			</tr>
			   
			<tr>
			    <td><span class="required">*</span>Nickname:</td>
			    <td>
				<input type="text" name="nickname" value="" maxlength="20"/>
				<a onclick="showAjaxBox('index.php?route=information/information/info&amp;information_id=7')"><b>?</b></a>			    </td>
			</tr>
			<tr>
			    <td><span class="required">*</span>Login Name:</td>
			    <td>
				<input type="text" name="loginname" value="" maxlength="20"/>
				<a onclick="showAjaxBox('index.php?route=information/information/info&amp;information_id=7')"><b>?</b></a>			    </td>
			</tr>
		    </table>

		        		    
		    <!-- BUTTONS -->
		    <div class="fl">
			<input type="button" value="Clear" class="button gray" onclick='$("span").remove(".error");
				clearForm(this.form);'/>
		    </div>
		    <div class="fr">

			                                                                                                        <!--    			<a class="facebook-button" href="https://www.facebook.com/dialog/oauth?client_id=595358527180497&redirect_uri=http%3A%2F%2Fwww.kitapyurdu.com%2Findex.php%3Froute%3Daccount%2Fregister&state=3a34a4f5d93672aa6420d53c8ae85d2b&scope=email"><i class="facebook-login-button-image"></i><span class="facebook-login-button-border"><span class="facebook-login-button-text">Login with Facebook</span></span></a>-->
					    </div>
		    <div class="fr">
			<input type="submit" value="Continue" class="button" />
		    </div>
		    <div class="clear"></div>
		</div>
	    </div>
	</div>

	