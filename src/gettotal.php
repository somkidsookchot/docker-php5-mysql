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
$cgettotal = new cgettotal();
$Page =& $cgettotal;

// Page init
$cgettotal->Page_Init();

// Page main
$cgettotal->Page_Main();

?>
<?php 

global $conn;


$setting = getSetting();
$village_id = $_GET["village_id"];

$date = $_GET["startdate"];

	switch($_GET["type"]){
	
	case 1: echo "<a href='subvcalculatelist.php?x_village_id=".$village_id."&x_cal_type=1' target = '_blank'>".getSubvTotalByVillage($village_id)."&nbsp;<img src='images/ico_view.png' align='absmiddle' width='15' height='15'></a>";
		break;
	case 2: echo "<a href='subvcalculatelist.php?x_village_id=".$village_id."&x_cal_type=2' target = '_blank'>".getAdvTotalByVillage($village_id)."&nbsp;<img src='images/ico_view.png' align='absmiddle' width='15' height='15'></a>";
		break;
    case 3: echo "<a href='subvcalculatelist.php?x_village_id=".$village_id."&x_cal_type=3' target = '_blank'>".getAnnualTotalByVillage($village_id)."&nbsp;<img src='images/ico_view.png' align='absmiddle' width='15' height='15'></a>";
		break;
    case 4: echo "<a href='subvcalculatelist.php?x_village_id=".$village_id."&x_cal_type=4' target = '_blank'>".getRegisTotalByVillage($village_id)."&nbsp;<img src='images/ico_view.png' align='absmiddle' width='15' height='15'></a>";
		break;
    case 5: echo "<a href='subvcalculatelist.php?x_village_id=".$village_id."&x_cal_type=5' target = '_blank'>".getOtherTotalByVillage($village_id)."&nbsp;<img src='images/ico_view.png' align='absmiddle' width='15' height='15'></a>";
		break;
    case 6: 
	$passtotal = ew_ExecuteScalar("SELECT count(member_id) FROM members WHERE regis_date < '".$date."' AND member_status = 'ปกติ'");	
	echo $passtotal;
		break;
	case 7: 

	$newmember = ew_ExecuteScalar("SELECT count(member_id) FROM members WHERE regis_date > '".$date."' AND member_status = 'ปกติ'");
	echo $newmember;
		break;
	case 8: 
	$deadmember = ew_ExecuteScalar("SELECT count(member_id) FROM members WHERE regis_date < '".$date."' AND member_status = 'เสียชีวิต'");	
	echo $deadmember;
		break;

	case 9: 
	
	$new = ew_ExecuteScalar("SELECT count(member_id) FROM members WHERE regis_date > '".$setting[0]["start_date"]."' AND member_status = 'ปกติ' AND village_id = ".$village_id." AND member_code NOT IN (select member_code from paymentsummary where pay_sum_type = 6)");
	
	$paid = ew_ExecuteScalar("SELECT sum(rc_total) FROM  expresspayment WHERE village_id  = ".$village_id);
	
	$total = $new * $setting[0]["rc_rate"];
 
	$total = $total - $paid;
	if ($total < 0) $total = 0;

	echo "<a href='subvcalculatelist.php?x_village_id=".$village_id."&x_cal_type=6' target = '_blank'>".$total."&nbsp;<img src='images/ico_view.png' align='absmiddle' width='15' height='15'></a>";
		break;
	
	}


	
	

?>


<?php
$cgettotal->Page_Terminate();
?>
<?php

//
// Page class
//
class cgettotal {

	// Page ID
	var $PageID = 'cgettotal';

	// Page object name
	var $PageObjName = 'cgettotal';

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
	function cgettotal() {
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

