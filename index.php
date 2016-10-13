<?php include("assets/php/phpConfig.php"); ?>
<?php
	if($_POST[clear]) {
		session_destroy();
		$_SESSION[step] = NULL;
		}

	///get values step one
	if(isset($_POST[step1])) {
		
	///check fields are filled correctly	
	
	///format fields for db
	$titleVal = $_POST[title];
	$firstName = $_POST[firstName];
	$surname = $_POST[surname];
	$email = $_POST[email];
	$dob = $_POST[dob];
	$address = $_POST[address];
	$postcode = $_POST[postcode];
	
	///if okay
	$_SESSION[step] = 2;
	$_SESSION[postcode] = $postcode;
	
	///store to db for marketing
			
	}
	
	///get values step two
	if(isset($_POST[step2])) {
		
	///check fields are filled correctly	
	
	///format fields for db
	$bikeManufactureVal = $_POST[bikeManufacture];
	$bikeManufactureTypeVal = $_POST[bikeManufactureType];
	$marketValue = $_POST[marketValue];
	
	///if okay
	$_SESSION[step] = 3;
	$_SESSION[marketValue] = $marketValue;
	
	///store to db for marketing
			
	}
	
	///get values step three
	if(isset($_POST[step3])) {
		
	///check fields are filled correctly	
	
	///format fields for db
	$startDate = $_POST[startDate];
	$policy = $_POST[policy];
	
	///if okay
	$_SESSION[step] = 4;
	$_SESSION[policy] = $policy;
	
	///store to db for marketing
			
	}
	
	///get work out lat lng
	$url ="http://maps.googleapis.com/maps/api/geocode/xml?address=".$_SESSION[postcode]."&sensor=false";
	$mapPlot = simplexml_load_file($url);
	$lat = $mapPlot->result->geometry->location->lat;
	$long = $mapPlot->result->geometry->location->lng;	

	///get crime numbers
    $date = '2016-01';
    $get = file_get_contents("http://data.police.uk/api/crimes-street/all-crime?lat=".$lat."&lng=".$long."&date=".$date);
    $json = json_decode($get, true);
	$crimecount =  count($json);
	
	///do insuarnce equation
	$policycover = $crimecount*($_SESSION[marketValue]/20)*$_SESSION[policy];
	
	///add to database
	
	////if not errors 
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Assurance X</title>
</head>
<link rel="stylesheet" type="text/css" href="assets/css/global.css">
<body>
<form action="" method="post" enctype="multipart/form-data">
  <?php if($_SESSION[step] == 2) { ?>
  <table border="1" cellspacing="0" cellpadding="5">
    <tr>
      <th colspan="2" scope="row">Bike Details</th>
    </tr>
    <tr>
      <td>Manufacturer</td>
      <td><?php
            echo '<select  name="bikeManufacture" >';
            echo '<option  selected="selected" value="null">Select manufacturer</option>';
			foreach($bikeManufacture as $key=>$value) {
                if($key == $bikeManufactureVal){
                    echo '<option value="'.$key.'" selected="selected">'.$value.'</option>';
                    } else {
                        echo '<option value="'.$key.'">'.$value.'</option>';
                        }	
            }
            echo '</select>';
            ?></td>
    </tr>
    <tr>
      <td>Model</td>
      <td><?php
            echo '<select  name="bikeManufactureType" >';
            echo '<option  selected="selected" value="null">Select model</option>';
			foreach($bikeManufactureType[1] as $key=>$value) {
                if($key == $bikeManufactureTypeVal){
                    echo '<option value="'.$key.'" selected="selected">'.$value.'</option>';
                    } else {
                        echo '<option value="'.$key.'">'.$value.'</option>';
                        }	
            }
            echo '</select>';
            ?></td>
    </tr>
    <tr>
      <td>Market Value</td>
      <td><input name="marketValue" type="text" value="<?php echo $marketValue; ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="step2" type="submit" value="Go to step there" class="btn"/></td>
    </tr>
  </table>
  <?php } elseif($_SESSION[step] == 3) { ?>
  <table border="1" cellspacing="0" cellpadding="5">
    <tr>
      <th colspan="2" scope="row">Cover type </th>
    </tr>
    <tr>
      <td>Policy Start date </td>
      <td><input name="startDate" type="text" value="<?php echo $startDate; ?>" placeholder="yyyy-mm-dd"/></td>
    </tr>
    <tr>
      <td>Type of Cover Required </td>
      <td><label> Gold
          <input name="policy" type="radio" value="3"  <?php if($policy == 3) { echo 'checked="checked"'; }?>/>
        </label>
        <label> Silver
          <input name="policy" type="radio" value="2"  <?php if($policy == 2) { echo 'checked="checked"'; }?>/>
        </label>
        <label> Bronze
          <input name="policy" type="radio" value="1"  <?php if($policy == 1) { echo 'checked="checked"'; }?>/>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="step3" type="submit" value="Generate quote" class="btn"/></td>
    </tr>
  </table>
  <?php } elseif($_SESSION[step] == 4) { ?>
  <h1>The premium <?php echo $policycover;?>.<br /><br />Thank you</h1>
  <img src="assets/img/paypallogo.png" />
<?php } else { ?>
  <table border="1" cellspacing="0" cellpadding="5">
    <tr>
      <th colspan="2" scope="row">Users details</th>
    </tr>
    <tr>
      <td>Title</td>
      <td><?php
      echo '<select  name="title" required="required">';
            echo '<option  selected="selected" value="null">Select title</option>';
			foreach($titleStatus as $key=>$value) {
                if($key == $titleVal){
                    echo '<option value="'.$key.'" selected="selected">'.$value.'</option>';
                    } else {
                        echo '<option value="'.$key.'">'.$value.'</option>';
                        }	
            }
            echo '</select>';
            ?></td>
    </tr>
    <tr>
      <td>First Name </td>
      <td><input name="firstName" type="text" value="<?php echo $firstName; ?>" required="required"/></td>
    </tr>
    <tr>
      <td>Surname</td>
      <td><input name="surname" type="text" value="<?php echo $surname; ?>" required="required"/></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input name="email" type="text" value="<?php echo $email; ?>" required="required"/></td>
    </tr>
    <tr>
      <td>Date of Birth</td>
      <td><input name="dob" type="text" value="<?php echo $dob; ?>" required="required"/></td>
    </tr>
    <tr>
      <td>House Number/Name</td>
      <td><input name="address" type="text" value="<?php echo $address ; ?>" required="required"/></td>
    </tr>
    <tr>
      <td>Postcode</td>
      <td><input name="postcode" type="text" value="<?php echo $postcode; ?>" required="required"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="step1" type="submit" value="Go to step two" class="btn"/></td>
    </tr>
  </table>
  <?php } ?>
  <div style="margin-top:100px">
    <input name="clear" type="submit" value="start again" class="btn2"/>
  </div>
</form>
</body>
</html>