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
$cexport = new cexport();
$Page =& $cexport;

// Page init
$cexport->Page_Init();

// Page main
$cexport->Page_Main();

?>
<?php 

include_once "header.php";

?>

<?php

global $conn;  

//print_r($allmember);

$setting = getSetting();
$lastbackup = $setting[0]["last_export"];

if ($_POST['export']){
	
//ENTER THE RELEVANT INFO BELOW

exportDb();

}

?>
<div class="ewTitle"><img src="images/ico_backup.png" width="40" height="40" align="absmiddle" />สำรองข้อมูล</div><div class="clear"></div><br />
<?php
echo $cexport->ShowMessage();
?>

<form name="fpayall" id="fpayall" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return cexport.Form_CustomValidate(this);">
  <table width="100%" border="0" cellspacing="0" class="ewGrid">
    <tr>
      <td class="ewGridContent"><div class="ewGridMiddlePanel">

      <table width="100%" border="1" cellpadding="3" cellspacing="3" class="ewTable">
        <tr>
          <td align="left" class="ewTableHeader">ที่เก็บข้อมูลสำรอง ณ ปัจจุบัน</td>
          <td align="left"><?php echo $setting[0]["export_path"]?> [<a href="settingedit.php?setting_id=1#path">แก้ไข</a>]</td>
        </tr>
        <tr id="r_min_advance_subv">
          <td width="200" align="left" class="ewTableHeader">ว.ด.ป.ที่สำรองข้อมูลครั้งล่าสุด</td>
          <td align="left"><?php echo ($lastbackup == '0000-00-00' ? "<i>ยังไม่มีการสำรองข้อมูล</i>" : $lastbackup)?></td>
        </tr>
        </table> 
      </div></td>
    </tr>
  </table>
  <br />
  <input type="submit" name="export" id="export" value="สำรองข้อมูล"/>
</form>
<!-- Put your custom html here -->


<?php 

include_once "footer.php";

$cexport->Page_Terminate();
?>
<?php

//
// Page class
//
class cexport {

	// Page ID
	var $PageID = 'cexport';

	// Page object name
	var $PageObjName = 'cexport';

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
	function cexport() {
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

