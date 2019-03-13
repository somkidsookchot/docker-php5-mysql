<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$cotherpay = new cotherpay();
$Page =& $cotherpay;

// Page init
$cotherpay->Page_Init();

// Page main
$cotherpay->Page_Main();
?>
<?php 

include_once "header.php";

?>
<script type="text/javascript">
var cpayalllist = new ew_Page("cpayalllist");

// page properties
cpayalllist.PageID = "edit"; // page ID
cpayalllist.FormID = "fpayall"; // form ID
var EW_PAGE_ID = cpayalllist.PageID; // for backward compatibility
// extend page with Form_CustomValidate function
cpayalllist.Form_CustomValidate =  function(fobj) { // DO NOT CHANGE THIS LINE!
	// Your custom validation code here, return false if invalid. 

	var total = 0;

		if (fobj.elements[0].value == 0) total +=1;
		if (fobj.elements[1].value == 0) total +=1;
		if (fobj.elements[2].value == 0) total +=1;
		if (fobj.elements[3].value == 0) total +=1;
		if (fobj.elements[4].value == 0) total +=1;
		//if (fobj.elements['regis_pay'].checked == false) total +=1;

	if (total == 5) return ew_OnError(this, fobj.elements["dead_id"], "โปรดระบุรายการที่เรียกเก็บ");
	
	return true;                                                                      
}  

//-->
</script>

<?php

if ($_POST["key_m"]){
	
	$memberslist = "";
	$mid = "";
	foreach ($_POST["key_m"] as $key => $value){
		
		if ($key == 0){
			$memberslist .= getName($value);
			$mid .= $value;
		}else {
			$memberslist .=", ".getName($value);
			$mid .= ", ".$value;
		}   
	}
	
}


if ($_POST["addpayment"]){
	
	
	$mid = explode(',',$_POST["mid"]);
	

	
//	$rs = ew_ExecuteScalar("UPDATE subvcalculate SET (t_code, member_code, cal_type, cal_detail, adv_num, count_member) VALUES ()");

	if ($_POST['regis_pay']){

		foreach($mid as $key => $value){
			
		$svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE cal_type = 4 AND t_code = '".getTambonCode($value)."' AND village_id = ".getVillageId($value));
		
		
		if ($svc_id > 0){
			
		$check = ew_ExecuteScalar("SELECT count(svc_id) FROM unpaylist WHERE svc_id = ".$svc_id." AND un_member_id = ".$value);

		if ($check == 0){
			
		ew_ExecuteScalar("INSERT INTO unpaylist SET svc_id  = ".$svc_id.", un_member_id = ".$value.", un_pay_type = 4");
		
		ew_ExecuteScalar("UPDATE subvcalculate SET count_member = (count_member + 1), total = (unit_rate * (count_member + 1)) WHERE cal_type = 4 AND t_code = '".getTambonCode($value)."' AND village_id = ".getVillageId($value));
				
		}
		


		} // end if svc_id
		} // end for  
		
	} //end if regis_pay


if ($_POST['dead_id']){
	
	
		foreach($mid as $key => $value){
			
		$svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE cal_type = 1 AND member_code = '".getDeadMemberCodeByDeadId($_POST['dead_id'])."' AND t_code = '".getTambonCode($value)."' AND village_id = ".getVillageId($value));
		

		if ($svc_id > 0){
			
		$check = ew_ExecuteScalar("SELECT count(svc_id) FROM unpaylist WHERE svc_id = ".$svc_id." AND un_member_id = ".$value);
		
		if ($check == 0){
			
		ew_ExecuteScalar("INSERT INTO unpaylist SET svc_id  = ".$svc_id.", un_member_id = ".$value.", un_pay_type = 1");
		
		ew_ExecuteScalar("UPDATE subvcalculate SET count_member = (count_member + 1), total = (unit_rate * (count_member + 1)) WHERE cal_type = 1 AND member_code = '".getDeadMemberCodeByDeadId($_POST['dead_id'])."' AND t_code = '".getTambonCode($value)."' AND village_id = ".getVillageId($value));
				
		}

		} // end if svc_id
		} // end for  
	

} //end if dead_id

if ($_POST['adv_num']){
	
	
		foreach($mid as $key => $value){
			
		$svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE cal_type = 2 AND adv_num = ".$_POST['adv_num']." AND t_code = '".getTambonCode($value)."' AND village_id = ".getVillageId($value));
		
		
		if ($svc_id > 0){
			
		$check = ew_ExecuteScalar("SELECT count(svc_id) FROM unpaylist WHERE svc_id = ".$svc_id." AND un_member_id = ".$value);

		if ($check == 0){
			
		ew_ExecuteScalar("INSERT INTO unpaylist SET svc_id  = ".$svc_id.", un_member_id = ".$value.", un_pay_type = 4");
		
		ew_ExecuteScalar("UPDATE subvcalculate SET count_member = (count_member + 1), total = (unit_rate * (count_member + 1)) WHERE cal_type = 2 AND adv_num = ".$_POST['adv_num']." AND t_code = '".getTambonCode($value)."' AND village_id = ".getVillageId($value));
				
		}
		
		} // end if svc_id
		} // end for  
	
} //end if adv_num


if ($_POST['annual_year']){
	
	
		foreach($mid as $key => $value){
			
		$svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE cal_type = 3 AND cal_detail = ".$_POST['annual_year']." AND t_code = '".getTambonCode($value)."' AND village_id = ".getVillageId($value));
		
		
		if ($svc_id > 0){
			
		$check = ew_ExecuteScalar("SELECT count(svc_id) FROM unpaylist WHERE svc_id = ".$svc_id." AND un_member_id = ".$value);

		if ($check == 0){
			
		ew_ExecuteScalar("INSERT INTO unpaylist SET svc_id  = ".$svc_id.", un_member_id = ".$value.", un_pay_type = 4");
		
		ew_ExecuteScalar("UPDATE subvcalculate SET count_member = (count_member + 1), total = (unit_rate * (count_member + 1)) WHERE cal_type = 3 AND cal_detail = ".$_POST['annual_year']." AND t_code = '".getTambonCode($value)."' AND village_id = ".getVillageId($value));
				
		}
		
		} // end if svc_id
		} // end for  
	
	
} // end if annual_year


if ($_POST['other_detail']){
	
	
		foreach($mid as $key => $value){
			
		$svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE cal_type = 5 AND cal_detail = ".$_POST['other_detail']." AND t_code = '".getTambonCode($value)."' AND village_id = ".getVillageId($value));
		
		
		if ($svc_id > 0){
			
		$check = ew_ExecuteScalar("SELECT count(svc_id) FROM unpaylist WHERE svc_id = ".$svc_id." AND un_member_id = ".$value);

		if ($check == 0){
			
		ew_ExecuteScalar("INSERT INTO unpaylist SET svc_id  = ".$svc_id.", un_member_id = ".$value.", un_pay_type = 4");
		
		$rs = ew_ExecuteScalar("UPDATE subvcalculate SET count_member = (count_member + 1), total = (unit_rate * (count_member + 1)) WHERE cal_type = 5 AND cal_detail = ".$_POST['other_detail']." AND t_code = '".getTambonCode($value)."' AND village_id = ".getVillageId($value));
				
		}
		
		} // end if svc_id
		} // end for  
	
	
}// end if other

header("location:subvcalculatelist.php?cmd=resetall");	

}// end if addpayment

?>
<br />
<div class="ewTitle">เพิ่มรายการเรียกเก็บเงินเฉพาะราย</div><div class="clear"></div><br />
<form name="fpayall" id="fpayall" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return cpayalllist.Form_CustomValidate(this);">
  <table width="100%" border="0" cellspacing="0" class="ewGrid">
    <tr>
      <td class="ewGridContent"><div class="ewGridMiddlePanel">

      <table width="100%" border="1" cellpadding="3" cellspacing="3" class="ewTable">
        <tr>
          <td align="left" valign="middle" class="ewTableHeader">รายชื่อสมาชิก</td>
          <td align="left"><?php echo $memberslist;?></td>
        </tr>
        <tr id="r_min_advance_subv">
            <td width="200" align="left" class="ewTableHeader">ค่าสงเคราะห์ศพ ศพที่:</td>
            <td align="left"><select name="dead_id" id="dead_id">
              <option value="0">--------------------------</option>
              <?php echo createOptionList("SELECT DISTINCT subvcalculate.member_code, members.fname, members.lname, members.dead_id FROM subvcalculate LEFT JOIN members ON (subvcalculate.member_code = members.member_code) WHERE subvcalculate.cal_type = 1",'dead_id','fname','lname')?>
            </select></td>
            </tr>
        <tr>
          <td align="left" class="ewTableHeader">ค่าสงเคราะห์ศพล่วงหน้า งวดที่:</td>
          <td align="left"><select name="adv_num" id="adv_num">
            <option value="0">-----------</option>
            <?php echo createOptionList("SELECT DISTINCT adv_num FROM subvcalculate WHERE adv_num > 0",'adv_num')?>
          </select></td>
        </tr>
        <tr>
          <td align="left" class="ewTableHeader">ค่าบำรุงประจำปี:</td>
          <td align="left"><select name="annual_year" id="annual_year">
            <option value="0">-----------</option>
            <?php echo createOptionList("SELECT DISTINCT cal_detail FROM subvcalculate WHERE cal_detail != '' AND cal_type = 3",'cal_detail')?>
          </select></td>
        </tr>
        <tr>
          <td align="left" class="ewTableHeader">ค่าสมัครสมาชิกจำนวน:</td>
          <?php $setting = getSetting();?> 
          <td align="left">
          <select name="regis_pay" id="regis_pay">
          <option value="0">--------------------------</option>
                      <?php echo createOptionList("SELECT DISTINCT unit_rate FROM subvcalculate WHERE  cal_type = 4",'unit_rate')?>
          </select>
         <!-- <input name="regis_pay" type="checkbox" id="regis_pay" value="1" /><?php echo $setting[0]['regis_rate']?> --> บาท</td>
        </tr>
        <tr>
          <td align="left" class="ewTableHeader">อื่นๆ:            </td>
          <td align="left"><select name="other_detail" id="other_detail">
            <option value="0">--------------------------</option>
            <?php echo createOptionList("SELECT DISTINCT cal_detail FROM subvcalculate WHERE cal_detail != '' AND cal_type = 5",'cal_detail')?>
          </select></td>
        </tr>
        </table> 
      </div></td>
    </tr>
  </table>
  <br />
  <input name="addpayment" type="hidden" id="addpayment" value="1" />


<a href="javascript:;history.go(-1);">
<input name="mid" type="hidden" id="mid" value="<?php echo $mid;?>" />
<?php echo $Language->Phrase("GoBack") ?></a>&nbsp;&nbsp;<input type="submit" name="btnAction" id="btnAction" value="เพิ่มรายการ"/>
</form>
<!-- Put your custom html here -->


<?php 

include_once "footer.php";
?>
<?php
$cotherpay->Page_Terminate();
?>
<?php

//
// Page class
//
class cotherpay {

	// Page ID
	var $PageID = 'cotherpay';

	// Page object name
	var $PageObjName = 'cotherpay';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}

	//
	// Page class constructor
	//
	function cotherpay() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// User table object (administrator)
		if (!isset($GLOBALS["administrator"])) $GLOBALS["administrator"] = new cadministrator;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'slipview', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $Report1;

		// Security
		$Security = new cAdvancedSecurity();

		// Uncomment codes below for security

		
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn())
			$this->Page_Terminate("login.php");
		

		// Global Page Loading event (in userfn*.php)
		Page_Loading();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language;

		//$this->setSuccessMessage("Welcome " . CurrentUserName());
		// Put your custom codes here
		
	}

}
?>

