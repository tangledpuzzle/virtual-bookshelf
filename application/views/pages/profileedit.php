
<link rel="stylesheet" type="text/css" href="../../../css/profileedit.css">
    <h1 class="first-content-element">Edit Profile</h1>
  	<hr>
	<div class="row">
	
      <div class="col-md-9 personal-info">
       
        <h3>Personal info</h3>
        <p>Sorry, profile editing is not yet supported.</p>
        <form class="form-horizontal" role="form"  method="POST" accept-charset="UTF-8" action="<?php echo base_url() . 'index.php/profileedit/' ?>">
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $user["FirstName"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $user["LastName"];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Screen Name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" name="ScreenName" value="<?php echo $user["ScreenName"];?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Age:</label>
            <div class="col-lg-8">
              <input class="form-control" type="number" value="<?php echo $user["Age"];?>" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Gender:</label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select id="user_gender" class="form-control">
                  
                </select>
              </div>
            </div>
          </div>
			 <div class="form-group">
            <label class="col-lg-3 control-label">Country Name:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $user["CountryName"];?>" >
            </div>
          </div>
		

    <div class="form-group">
     
		<div class="col-lg-8 col-md-offset-3" >
            <label for="comment">Bio:</label>
      <textarea class="form-control" rows="5"   id="bio" ><?php echo $user["Bio"];?></textarea>
			
    </div>

		 </div>


			
          
          <!-- <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
				<input class="btn btn-primary" name="submit" value="Save Changes" type="submit" >
            </div>
          </div> -->
        </form>
      </div>
  </div>
