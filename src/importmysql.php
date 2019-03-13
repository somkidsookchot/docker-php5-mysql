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
$cimport = new cimport();
$Page =& $cimport;

// Page init
$cimport->Page_Init();

// Page main
$cimport->Page_Main();

?>
<?php 

include_once "header.php";

?>
<script type="text/javascript">


var cimport = new ew_Page("cimport");
function getFileExtension(fileimport)
{
 
  var ext = /^.+\.([^.]+)$/.exec(fileimport);
  return ext == null ? "" : ext[1];
}
// page properties
cimport.PageID = "edit"; // page ID
cimport.FormID = "fcimport"; // form ID
var EW_PAGE_ID = cimport.PageID; // for backward compatibility
// extend page with Form_CustomValidate function
cimport.Form_CustomValidate =  function(fobj) { // DO NOT CHANGE THIS LINE!

// Your custom validation code here, return false if invalid. 

	var fname = fobj.elements[0].value;
	if (fname == "") return ew_OnError(this, fobj.elements["fileimport"], "โปรดเลือกไฟล์ฐานข้อมูล");
	if (getFileExtension(fname) != 'db' ) return ew_OnError(this, fobj.elements["fileimport"], "ประเภทไฟล์ไม่ถูกต้อง");
	return true;                                                                      
}  

//-->
</script>
<?php

global $conn;  

//print_r($allmember);

$setting = getSetting();
$lastbackup = $setting[0]["last_export"];

if ($_POST['importdb']){
	
//ENTER THE RELEVANT INFO BELOW

importDb($_FILES['fileimport']);

}

?>
<div class="ewTitle"><img src="images/ico_import_db.png" width="40" height="40" border="0" align="absmiddle" />นำเข้าข้อมูลสำรอง</div>
<div class="clear"></div><br />
<?php
echo $cimport->ShowMessage();
?>

<form name="fcimport" id="fcimport" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return cimport.Form_CustomValidate(this);">
  <table width="100%" border="0" cellspacing="0" class="ewGrid">
    <tr>
      <td class="ewGridContent"><div class="ewGridMiddlePanel">

      <table width="100%" border="1" cellpadding="3" cellspacing="3" class="ewTable">
        <tr>
          <td width="200" align="left" class="ewTableHeader">เลือกไฟล์ฐานข้อมูล</td>
          <td align="left"><input type="file" name="fileimport" id="fileimport" /></td>
        </tr>
        </table> 
      </div></td>
    </tr>
  </table>
  <br />
  <input type="submit" name="importdb" id="importdb" value="นำเข้าข้อมูลสำรอง"/>
</form>
<!-- Put your custom html here -->


<?php 

include_once "footer.php";

$cimport->Page_Terminate();
?>
<?php

//
// Page class
//
class cimport {

	// Page ID
	var $PageID = 'cimport';

	// Page object name
	var $PageObjName = 'cimport';

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
	function cimport() {
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

