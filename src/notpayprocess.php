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
$cnotpayprocess = new cnotpayprocess();
$Page =& $cnotpayprocess;

// Page init
$cnotpayprocess->Page_Init();

// Page main
$cnotpayprocess->Page_Main();

?>
<?php 

include_once "header.php";

global $conn;

$member_code = $_POST['key_m'];

foreach ($member_code as $mcode){
	
$rs = $conn->Execute("INSERT INTO paymentsummary SET t_code = '".$_POST['t_code']."' , village_id = ".$_POST['v_id'].", member_code = ".$mcode.", pay_sum_type = ".$_POST['pay_type'].", pay_death_begin = '".$_POST['pay_death']."', pay_annual_year = '".$_POST['annual_year']."', pay_sum_date = '".$_POST['pay_date']."', pay_sum_total = ".$_POST['pay_total'].", pay_sum_detail = '".$_POST['pay_detail']."', pay_sum_adv_num ='".$_POST['pay_num']."'");


switch($_POST['pay_type']){
	
	case 1: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$_POST['v_id']." AND member_code = '".getDeadMemberCodeByDeadId($_POST['pay_death'])."'");
		break;
	case 2: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$_POST['v_id']." AND adv_num = '".$_POST['pay_num']."'");
		break;
  case 3: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$_POST['v_id']." AND cal_detail = '".$_POST['annual_year']."'");
		break;
 case 4: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$_POST['v_id']." AND cal_type = 4");
		break;
 case 5: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$_POST['v_id']." AND cal_detail = '".$_POST['pay_detail']."'");
		break;
 case 6: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$_POST['v_id']." AND cal_detail = '".$_POST['pay_detail']."'");
		break;

}



updateSubvention(getMemberIdByCode($mcode),$svc_id); 


}

/*if ($_POST['pay_type'] == 1)    calculatesubvention(getDeadMemberCodeByDeadId($_POST['pay_death']),true); 
	if ($_POST['pay_type'] == 2)    calculateAdvSubv($_POST['pay_num']);   
	if ($_POST['pay_type'] == 3)    calculateAnnualfee($_POST['annual_year']);
	if ($_POST['pay_type'] == 4)    calculateRegis($_POST['v_id']);
	if ($_POST['pay_type'] == 5)    calculateOther($_POST['pay_detail'],getRateByDetail($_POST['pay_detail']));*/
	
	

 unset($_SESSION['print']);
 
 if ($rs) header("location:paymentsummarylist.php?cmd=resetall");

?>
<a href="subvcalculatelist.php?x_cal_type=<?php echo $arr[0]['cal_type']?>"><?php echo $Language->Phrase("goback") ?></a><br />

<!-- Put your custom html here -->


<?php 

include_once "footer.php";

?>

<?php
$cnotpayprocess->Page_Terminate();
?>
<?php

//
// Page class
//
class cnotpayprocess {

	// Page ID
	var $PageID = 'cnotpayprocess';

	// Page object name
	var $PageObjName = 'cnotpayprocess';

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
	function cnotpayprocess() {
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

