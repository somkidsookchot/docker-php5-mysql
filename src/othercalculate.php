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
var cotherpay = new ew_Page("cotherpay");

// page properties
cotherpay.PageID = "edit"; // page ID
cotherpay.FormID = "fcotherpay"; // form ID
var EW_PAGE_ID = cotherpay.PageID; // for backward compatibility
// extend page with Form_CustomValidate function
cotherpay.Form_CustomValidate =  function(fobj) { // DO NOT CHANGE THIS LINE!
	// Your custom validation code here, return false if invalid. 
									   

	 if(fobj.elements["detail"].value == ''){
		
		return ew_OnError(this, fobj.elements["detail"], "โปรดระบุรายการที่เรียกเก็บ");
	 } 
	 
	 if(fobj.elements["unitrate"].value == ''){
		
		return ew_OnError(this, fobj.elements["unitrate"], "โปรดระบุจำนวนเงินต่อคน");
		
	 }else if(!ew_CheckInteger(fobj.elements["unitrate"].value)){
		 
		 return ew_OnError(this, fobj.elements["unitrate"], "โปรดระบุจำนวนเงินเป็นตัวเลข");
		 
	 }
										  
											   
	return true;                                                                      
}  
//-->
</script>
<?php

if ($_POST["addother"]){
	
	if (calculateOther($_POST["detail"],$_POST["unitrate"])) 	header("location:subvcalculatelist.php?x_cal_type=5");
}

?>
<br />
<div class="ewTitle">เพิ่มรายการเรียกเก็บเงินอื่นๆ</div><div class="clear"></div><br />
<form name="fotherpay" id="fotherpay" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return cotherpay.Form_CustomValidate(this);">
  <table cellspacing="0" class="ewGrid">
    <tr>
      <td class="ewGridContent"><div class="ewGridMiddlePanel">
        <table cellspacing="0" class="ewTable">
          <tr id="r_min_advance_subv">
            <td class="ewTableHeader">รายการที่เรียกเก็บ</td>
            <td><span id="el_min_advance_subv">
              <textarea name="detail" cols="50" rows="5" id="detail"></textarea>
            </span></td>
          </tr>
          <tr id="r_max_advance_subv">
            <td class="ewTableHeader">จำนวนเงินต่อคน</td>
            <td><span id="el_max_advance_subv">
              <input type="text" name="unitrate" id="unitrate" size="30"/>
              </span></td>
          </tr>
          </table>
      </div></td>
    </tr>
  </table>
  <br />
  <input name="addother" type="hidden" id="addother" value="1" />
  <a href="javascript:history.go(-1);"><?php echo $Language->Phrase("goback") ?></a> &nbsp;<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>" />

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

