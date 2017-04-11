<?php 
include('../auth_admin.php'); 
if($_SESSION['ROLE_ID']!=0){
	if($permission['couponcode']==0){
		die("You don't have permission to access please contact administrator.");
	}
}
require_once('../../app/themes/lib/system.lib.php');
$conn = PetroFDS::ConnectDB();
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<HTML>

<head>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <link rel="stylesheet" type="text/css" href="../css/layout.css" />
  <link rel="stylesheet" type="text/css" href="../css/layout-responsive.css" />
  <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" />
  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="../js/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#from" ).datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true
	});
	$( "#to" ).datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true
	});
  });
  </script>
  <?php 
  if(isset($_GET['status'])){
	if($_GET['status'] == 'new'){
  ?>  
  	<title>PetroFDS | Add Coupon Code</title>
  <?php
	}else{
  ?>
  	<title>PetroFDS | Edit Coupon Code</title>
  <?php
	}
  }
  ?>
</head>


<body>

<?php  include('../main_content/header_admin.php'); ?> 
<label>&nbsp;</label>
<?php
if(isset($_GET['success'])){
	if($_GET['success'] == '1'){
?>
<center><label>Coupon Code Added</label></center>
<?php
	}
}
?>
<?php 
if(isset($_GET['status'])){
	if($_GET['status'] == 'new'){
?>
<center><label style="font-family:Arial,Helvetica,sans-serif;font-size:25px;color:#f16445;text-align:center" >ADD NEW COUPON CODE</label></center>

  <div >
  <div class="page-region" >
  <div class="page-content content-wrapper clear-block ">
  		<form AUTOCOMPLETE="off" action="coupon_code_set.php" ACCEPT-CHARSET="UTF-8" method="post" id="save_coupon_code" name="save_coupon_code" enctype="multipart/form-data">
	<table>
		<tr>
        <td>
		<div class="form form-layout-simple clear-block">
        <table>
            <tr>
                <td>        
            <div class="form form-layout-simple clear-block">
            <fieldset class=" fieldset titled sindh" style="background-color:#9C3">
              <legend><span class="fieldset-title">COUPON CODE DETAILS <span class="form-required" title="This field is required.">*</span></span></legend>
              <div class="fieldset-content clear-block ">
                    <div class="form-item form-item-labeled" id="edit-mail-wrapper">
                <table>
                    <tr>
                        <td>
                        	<input type="hidden" name="cate_status" id="cate_status" value="new" />
                            <label>ID: </label>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">
                            <label>Code: </label> <input type="text" name="code" id="code" required class="form-text required fluid" />
                        </td>
                        <td width="30%">
                            <label>Price: </label> <input type="text" name="price" id="price" required class="form-text required fluid" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	<label>Valid From: </label> <input type="text" name="from" id="from" required class="form-text required fluid" />
                        </td>
                        <td>
                        	<label>Valid To: </label> <input type="text" name="to" id="to" required class="form-text required fluid" />
                        </td>
                        <td>
                        	<label>Status: </label> <select class="form-select" name="status" required><option value=""></option><option value="1">Active</option><option value="0">Inactive</option></select>
                        </td>
                    </tr>
                </table>
                </div>
                </div>
            </fieldset>
            </div>
                </td>
            </tr>
    
        </table>
        <table  style="border:1px solid #CCC;" width="100%" >
            <tr>

                <td align="right" style="height:40px;vertical-align:middle" colspan="2">

                <input type="submit" class="form-submit" value="Save" style="margin-right:5px;" />
                </td>
            </tr>
        </table>
        </div>
    </td>
    </tr>
    </table>
		</form>
	</div>
</div>
</div>

<?php
	}else{
		$stmt = $conn->prepare("SELECT * FROM coupon_code WHERE id = ".$_GET['id']."");

		$stmt->execute();

		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
if($rows){
	foreach($rows as $row){
?>
	<center><label style="font-family:Arial,Helvetica,sans-serif;font-size:25px;color:#f16445;text-align:center" >EDIT CATEGORY</label></center>

  <div >
  <div class="page-region" >
  <div class="page-content content-wrapper clear-block ">
  		<form AUTOCOMPLETE="off" action="coupon_code_set.php" ACCEPT-CHARSET="UTF-8" method="post" id="save_coupon_code" name="save_coupon_code" enctype="multipart/form-data" onSubmit="return validateForm()">
	<table>
		<tr>
        <td>
		<div class="form form-layout-simple clear-block">
        <table>
            <tr>
                <td>        
            <div class="form form-layout-simple clear-block">
            <fieldset class=" fieldset titled sindh" style="background-color:#9C3">
              <legend><span class="fieldset-title">CATEGORY DETAILS <span class="form-required" title="This field is required.">*</span></span></legend>
              <div class="fieldset-content clear-block ">
                    <div class="form-item form-item-labeled" id="edit-mail-wrapper">
                <table>
                    <tr>
                        <td>
                        	<input type="hidden" name="cate_status" id="cate_status" value="edit" />
                            <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>" />
                            <label>ID: <?php echo $_GET['id'] ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">
                            <label>Code: </label> <input type="text" name="code" id="code" value="<?php echo $row['code'] ?>" required class="form-text required fluid" />
                        </td>
                        <td width="30%">
                            <label>Price: </label> <input type="text" name="price" id="price" value="<?php echo $row['price'] ?>" required class="form-text required fluid" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	<label>Valid From: </label> <input type="text" name="from" id="from" value="<?php echo $row['valid_from'] ?>" required class="form-text required fluid" />
                        </td>
                        <td>
                        	<label>Valid To: </label> <input type="text" name="to" id="to" value="<?php echo $row['valid_to'] ?>" required class="form-text required fluid" />
                        </td>
                        <td>
                        	<label>Status: </label> 
                            <?php
							if($row['status'] == '1'){
							?>
                           	<select required class="form-select" name="status"><option value=""></option><option value="1" selected="selected">Active</option><option value="0">Inactive</option></select>
                            <?php
							}else{
							?>
                            <select required class="form-select" name="status"><option value=""></option><option value="1">Active</option><option value="0" selected="selected">Inactive</option></select>
                            <?php
							}
							?>
                        </td>
                    </tr>
                </table>
                </div>
                </div>
            </fieldset>
            </div>
                </td>
            </tr>
    
        </table>
        <table  style="border:1px solid #CCC;" width="100%" >
            <tr>

                <td align="right" style="height:40px;vertical-align:middle" colspan="2">

                <input type="submit" class="form-submit" value="Edit" style="margin-right:5px;" />
                </td>
            </tr>
        </table>
        </div>
    </td>
    </tr>
    </table>
		</form>
	</div>
</div>
</div>
<?php
	}
}
	}
}
?>
<?php include('../main_content/footer.php'); ?>
</body>
</html>