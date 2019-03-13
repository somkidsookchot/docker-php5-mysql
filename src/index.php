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
$default = new cdefault();
$Page =& $default;

// Page init
$default->Page_Init();

// Page main
$default->Page_Main();
?>
<?php include_once "header.php" ?>
<?php
$default->ShowMessage();
?>
<?php include_once "footer.php" ?>
<?php
$default->Page_Terminate();
?>
<?php

//
// Page class
//
class cdefault {

	// Page ID
	var $PageID = 'default';

	// Page object name
	var $PageObjName = 'default';

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
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}

	//
	// Page class constructor
	//
	function cdefault() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// User table object (administrator)
		if (!isset($GLOBALS["administrator"])) $GLOBALS["administrator"] = new cadministrator;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'default', TRUE);

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
		global $administrator;

		// Security
		$Security = new cAdvancedSecurity();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

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
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->LoadUserLevel(); // load User Level
		if ($Security->AllowList('administrator'))
		$this->Page_Terminate("administratorlist.php"); // Exit and go to default page
		if ($Security->AllowList('members'))
			$this->Page_Terminate("memberslist.php");
		if ($Security->AllowList('paymentsummary'))
			$this->Page_Terminate("paymentsummarylist.php");
		if ($Security->AllowList('permission'))
			$this->Page_Terminate("permissionlist.php");
		if ($Security->AllowList('setting'))
			$this->Page_Terminate("settinglist.php");
		if ($Security->AllowList('subventionpayment'))
			$this->Page_Terminate("subventionpaymentlist.php");
		if ($Security->AllowList('tambon'))
			$this->Page_Terminate("tambonlist.php");
		if ($Security->AllowList('village'))
			$this->Page_Terminate("villagelist.php");
		if ($Security->AllowList('memberstatus'))
			$this->Page_Terminate("memberstatuslist.php");
		if ($Security->AllowList('paymenttype'))
			$this->Page_Terminate("paymenttypelist.php");
		if ($Security->AllowList('gender'))
			$this->Page_Terminate("genderlist.php");
		if ($Security->AllowList('prefix'))
			$this->Page_Terminate("prefixlist.php");
		if ($Security->AllowList('expenditure'))
			$this->Page_Terminate("expenditurelist.php");
		if ($Security->AllowList('advancebudget'))
			$this->Page_Terminate("advancebudgetlist.php");
		if ($Security->AllowList('deathmember'))
			$this->Page_Terminate("deathmemberlist.php");
		if ($Security->AllowList('memberstatuslist'))
			$this->Page_Terminate("memberstatuslistlist.php");
		if ($Security->AllowList('view2'))
			$this->Page_Terminate("view2list.php");
		if ($Security->AllowList('สมาชิกที่มีชีวิต'))
			$this->Page_Terminate("E2AE21E32E0AE34E01E17E35E48E21E35E0AE35E27E34E15list.php");
		if ($Security->AllowList('สมาชิกที่ลาออก'))
			$this->Page_Terminate("E2AE21E32E0AE34E01E17E35E48E25E32E2DE2DE01list.php");
		if ($Security->AllowList('สมาชิกที่พ้นสภาพ'))
			$this->Page_Terminate("E2AE21E32E0AE34E01E17E35E48E1EE49E19E2AE20E32E1Elist.php");
		if ($Security->AllowList('view1'))
			$this->Page_Terminate("view1list.php");
		if ($Security->AllowList('Report1'))
			$this->Page_Terminate("Report1report.php");
		if ($Security->IsLoggedIn()) {
			$this->setFailureMessage($Language->Phrase("NoPermission") . "<br><br><a href=\"logout.php\">" . $Language->Phrase("BackToLogin") . "</a>");
		} else {
			$this->Page_Terminate("login.php"); // Exit and go to login page
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}
}
?>
