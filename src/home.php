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
$custompage = new ccustompage();
$Page =& $custompage;

// Page init
$custompage->Page_Init();

// Page main
$custompage->Page_Main();
?>
<?php

// Compatibility with PHP Report Maker
if (!isset($Language)) {
	include_once "ewcfg8.php";
	include_once "ewshared8.php";
	$Language = new cLanguage();
	

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo EW_PROJECT_STYLESHEET_FILENAME ?>">
<link href="css/topmenu.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="generator" content="PHPMaker v8.0.2">
<LINK REL="SHORTCUT ICON" HREF="favicon.ico">
<script type="text/javascript" src="phpjs/userfn8.js"></script>
</head>
<body class="yui-skin-sam">
<?php if (@$gsExport == "") { ?>
<div class="ewLayout">
	<!-- header (begin) --><!-- *** Note: Only licensed users are allowed to change the logo *** -->
  <div class="ewHeaderRow"><img src="phpimages/top_header.png" alt="" border="0" align="absmiddle" style="margin-top:5px;">
  <img src="images/powered.png" alt="" width="129" height="67" hspace="40" style="float:right;">
    <div style="float:right; margin-right:50px; margin-top:10px;">
<span id="tick2"></span>
<div style ="clear:both;border-bottom: dotted 0px #CCC;margin-top:5px;"></div>
</div>
  </div>
	<!-- header (end) -->

	<!-- content (begin) -->
  <table cellspacing="0" class="ewContentTable">
		<tr>	
<!--			<td class="ewMenuColumn"> -->
			<!-- left column (begin) -->
<?php //include_once "ewmenu.php" ?>
			<!-- left column (end) -->
		<!--	</td> -->
	    <td class="ewContentColumn">
			<!-- right column (begin) -->
				<p class="phpmaker ewTitle"><b><?php echo $Language->ProjectPhrase("BodyTitle") ?></b></p>
<?php } ?>

<link rel="stylesheet" type="text/css" href="css/desktop.css" />
<?php
$custompage->ShowMessage();
?>
<!-- Put your custom html here -->
<?php $ar = getSetting();
print_r($ar);
?>
<div class="sidebarreport"> 
  <div style="width:260px; padding-top:70px; margin:auto;" class="todo">
  <strong>รายการที่รอดำเนินงาน</strong> 
  <?php echo createToDo();?>
  </div>
</div>
<div id="x-desktop">
  <dl id="x-shortcuts">
    <dt id="member-win-shortcut"> <a href="memberslist.php"><img src="images/s.gif" />
      <!--<div class="count">10</div>--><div>ข้อมูลสมาชิก</div>
    </a> </dt>
    <dt id="finance-win-shortcut"> <a href="subvchargelist.php"><img src="images/s.gif" />
      <div>เงินสงเคราะห์</div>
    </a> </dt>
    <dt id="unpay-win-shortcut"> <a href="subvcalculatelist.php"><img src="images/s.gif" />
      <div>รายการค้างชำระ</div>
      </a> </dt>
    <dt id="paid-win-shortcut"> <a href="paymentloglist.php"><img src="images/s.gif" />
      <div>รายการชำระแล้ว</div>
      </a> </dt>
    <dt id="report-win-shortcut"> <a href="reportallmembersmry.php"><img src="images/s.gif" />
      <div>รายงาน</div>
    </a> </dt>
    <dt id="var-win-shortcut"> <a href="settingedit.php?setting_id=1"><img src="images/s.gif" />
      <div>ค่าคงที่</div>
    </a> </dt>
    <dt id="income-win-shortcut"> <a href="expensescategorylist.php"><img src="images/s.gif" />
      <div>บันทึกค่าใช้จ่าย</div>
    </a> </dt>
    <dt id="config-win-shortcut"> <a href="changepwd.php"><img src="images/s.gif" />
      <div>แก้ไขรหัสผ่าน</div>
      </a> </dt>
     <dt id="logout-win-shortcut"> <a href="logout.php"><img src="images/s.gif" />
      <div>ออกจากระบบ</div>
      </a> </dt>
  </dl>
</div>
<?php include_once "footer.php" ?>
<?php
$custompage->Page_Terminate();
?>
<?php

//
// Page class
//
class ccustompage {

	// Page ID
	var $PageID = 'homepage';

	// Page object name
	var $PageObjName = 'homepage';

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
	function ccustompage() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// User table object (administrator)
		if (!isset($GLOBALS["administrator"])) $GLOBALS["administrator"] = new cadministrator;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'custompage', TRUE);

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

		/*
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn())
			$this->Page_Terminate("login.php");
		*/

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
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->LoadUserLevel(); // load User Level
		if ($Security->AllowList('administrator'))
		$this->Page_Terminate("administratorlist.php"); // Exit and go to default page
		
	}

}
?>
        
