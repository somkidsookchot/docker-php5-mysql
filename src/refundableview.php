<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "refundableinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$refundable_view = new crefundable_view();
$Page =& $refundable_view;

// Page init
$refundable_view->Page_Init();

// Page main
$refundable_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($refundable->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var refundable_view = new ew_Page("refundable_view");

// page properties
refundable_view.PageID = "view"; // page ID
refundable_view.FormID = "frefundableview"; // form ID
var EW_PAGE_ID = refundable_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
refundable_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
refundable_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
refundable_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
refundable_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $refundable->TableCaption() ?>
&nbsp;&nbsp;<?php $refundable_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($refundable->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $refundable_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $refundable_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $refundable_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $refundable_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $refundable_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $refundable_view->ShowPageHeader(); ?>
<?php
$refundable_view->ShowMessage();
?>
<p>
<?php if ($refundable->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($refundable_view->Pager)) $refundable_view->Pager = new cPrevNextPager($refundable_view->StartRec, $refundable_view->DisplayRecs, $refundable_view->TotalRecs) ?>
<?php if ($refundable_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($refundable_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_view->PageUrl() ?>start=<?php echo $refundable_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($refundable_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_view->PageUrl() ?>start=<?php echo $refundable_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $refundable_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($refundable_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_view->PageUrl() ?>start=<?php echo $refundable_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($refundable_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_view->PageUrl() ?>start=<?php echo $refundable_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $refundable_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($refundable_view->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<br>
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($refundable->refund_id->Visible) { // refund_id ?>
	<tr id="r_refund_id"<?php echo $refundable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $refundable->refund_id->FldCaption() ?></td>
		<td<?php echo $refundable->refund_id->CellAttributes() ?>>
<div<?php echo $refundable->refund_id->ViewAttributes() ?>><?php echo $refundable->refund_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($refundable->member_code->Visible) { // member_code ?>
	<tr id="r_member_code"<?php echo $refundable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $refundable->member_code->FldCaption() ?></td>
		<td<?php echo $refundable->member_code->CellAttributes() ?>>
<div<?php echo $refundable->member_code->ViewAttributes() ?>><?php echo $refundable->member_code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($refundable->refund_total->Visible) { // refund_total ?>
	<tr id="r_refund_total"<?php echo $refundable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $refundable->refund_total->FldCaption() ?></td>
		<td<?php echo $refundable->refund_total->CellAttributes() ?>>
<div<?php echo $refundable->refund_total->ViewAttributes() ?>><?php echo $refundable->refund_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($refundable->assc_percent->Visible) { // assc_percent ?>
	<tr id="r_assc_percent"<?php echo $refundable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $refundable->assc_percent->FldCaption() ?></td>
		<td<?php echo $refundable->assc_percent->CellAttributes() ?>>
<div<?php echo $refundable->assc_percent->ViewAttributes() ?>><?php echo $refundable->assc_percent->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($refundable->assc_total->Visible) { // assc_total ?>
	<tr id="r_assc_total"<?php echo $refundable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $refundable->assc_total->FldCaption() ?></td>
		<td<?php echo $refundable->assc_total->CellAttributes() ?>>
<div<?php echo $refundable->assc_total->ViewAttributes() ?>><?php echo $refundable->assc_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($refundable->sub_total->Visible) { // sub_total ?>
	<tr id="r_sub_total"<?php echo $refundable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $refundable->sub_total->FldCaption() ?></td>
		<td<?php echo $refundable->sub_total->CellAttributes() ?>>
<div<?php echo $refundable->sub_total->ViewAttributes() ?>><?php echo $refundable->sub_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($refundable->refund_status->Visible) { // refund_status ?>
	<tr id="r_refund_status"<?php echo $refundable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $refundable->refund_status->FldCaption() ?></td>
		<td<?php echo $refundable->refund_status->CellAttributes() ?>>
<div<?php echo $refundable->refund_status->ViewAttributes() ?>><?php echo $refundable->refund_status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($refundable->pay_date->Visible) { // pay_date ?>
	<tr id="r_pay_date"<?php echo $refundable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $refundable->pay_date->FldCaption() ?></td>
		<td<?php echo $refundable->pay_date->CellAttributes() ?>>
<div<?php echo $refundable->pay_date->ViewAttributes() ?>><?php echo $refundable->pay_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($refundable->refund_slipt_num->Visible) { // refund_slipt_num ?>
	<tr id="r_refund_slipt_num"<?php echo $refundable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $refundable->refund_slipt_num->FldCaption() ?></td>
		<td<?php echo $refundable->refund_slipt_num->CellAttributes() ?>>
<div<?php echo $refundable->refund_slipt_num->ViewAttributes() ?>><?php echo $refundable->refund_slipt_num->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($refundable->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($refundable_view->Pager)) $refundable_view->Pager = new cPrevNextPager($refundable_view->StartRec, $refundable_view->DisplayRecs, $refundable_view->TotalRecs) ?>
<?php if ($refundable_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($refundable_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_view->PageUrl() ?>start=<?php echo $refundable_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($refundable_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_view->PageUrl() ?>start=<?php echo $refundable_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $refundable_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($refundable_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_view->PageUrl() ?>start=<?php echo $refundable_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($refundable_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $refundable_view->PageUrl() ?>start=<?php echo $refundable_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $refundable_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($refundable_view->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<p>
<?php
$refundable_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($refundable->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$refundable_view->Page_Terminate();
?>
<?php

//
// Page class
//
class crefundable_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'refundable';

	// Page object name
	var $PageObjName = 'refundable_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $refundable;
		if ($refundable->UseTokenInUrl) $PageUrl .= "t=" . $refundable->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $refundable;
		if ($refundable->UseTokenInUrl) {
			if ($objForm)
				return ($refundable->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($refundable->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crefundable_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (refundable)
		if (!isset($GLOBALS["refundable"])) {
			$GLOBALS["refundable"] = new crefundable();
			$GLOBALS["Table"] =& $GLOBALS["refundable"];
		}
		$KeyUrl = "";
		if (@$_GET["refund_id"] <> "") {
			$this->RecKey["refund_id"] = $_GET["refund_id"];
			$KeyUrl .= "&refund_id=" . urlencode($this->RecKey["refund_id"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'refundable', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->Separator = "&nbsp;&nbsp;";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $refundable;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$refundable->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$refundable->Export = $_POST["exporttype"];
		} else {
			$refundable->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $refundable->Export; // Get export parameter, used in header
		$gsExportFile = $refundable->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if (@$_GET["refund_id"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["refund_id"]);
		}
		if ($refundable->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($refundable->Export == "word") {
			header('Content-Type: application/vnd.ms-word' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Setup export options
		$this->SetupExportOptions();

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
	var $ExportOptions; // Export options
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $refundable;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["refund_id"] <> "") {
				$refundable->refund_id->setQueryStringValue($_GET["refund_id"]);
				$this->RecKey["refund_id"] = $refundable->refund_id->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$refundable->CurrentAction = "I"; // Display form
			switch ($refundable->CurrentAction) {
				case "I": // Get a record to display
					$this->StartRec = 1; // Initialize start position
					if ($this->Recordset = $this->LoadRecordset()) // Load records
						$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecs <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("refundablelist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($refundable->refund_id->CurrentValue) == strval($this->Recordset->fields('refund_id'))) {
								$refundable->setStartRecordNumber($this->StartRec); // Save record position
								$bMatchRecord = TRUE;
								break;
							} else {
								$this->StartRec++;
								$this->Recordset->MoveNext();
							}
						}
					}
					if (!$bMatchRecord) {
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "refundablelist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}

			// Export data only
			if (in_array($refundable->Export, array("html","word","excel","xml","csv","email","pdf"))) {
				$this->ExportData();
				if ($refundable->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "refundablelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$refundable->RowType = EW_ROWTYPE_VIEW;
		$refundable->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $refundable;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$refundable->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$refundable->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $refundable->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$refundable->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$refundable->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$refundable->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $refundable;

		// Call Recordset Selecting event
		$refundable->Recordset_Selecting($refundable->CurrentFilter);

		// Load List page SQL
		$sSql = $refundable->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$refundable->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $refundable;
		$sFilter = $refundable->KeyFilter();

		// Call Row Selecting event
		$refundable->Row_Selecting($sFilter);

		// Load SQL based on filter
		$refundable->CurrentFilter = $sFilter;
		$sSql = $refundable->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $refundable;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$refundable->Row_Selected($row);
		$refundable->refund_id->setDbValue($rs->fields('refund_id'));
		$refundable->member_code->setDbValue($rs->fields('member_code'));
		$refundable->refund_total->setDbValue($rs->fields('refund_total'));
		$refundable->assc_percent->setDbValue($rs->fields('assc_percent'));
		$refundable->assc_total->setDbValue($rs->fields('assc_total'));
		$refundable->sub_total->setDbValue($rs->fields('sub_total'));
		$refundable->refund_status->setDbValue($rs->fields('refund_status'));
		$refundable->pay_date->setDbValue($rs->fields('pay_date'));
		$refundable->calculate_date->setDbValue($rs->fields('calculate_date'));
		$refundable->refund_slipt_num->setDbValue($rs->fields('refund_slipt_num'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $refundable;

		// Initialize URLs
		$this->AddUrl = $refundable->AddUrl();
		$this->EditUrl = $refundable->EditUrl();
		$this->CopyUrl = $refundable->CopyUrl();
		$this->DeleteUrl = $refundable->DeleteUrl();
		$this->ListUrl = $refundable->ListUrl();

		// Call Row_Rendering event
		$refundable->Row_Rendering();

		// Common render codes for all row types
		// refund_id
		// member_code
		// refund_total
		// assc_percent
		// assc_total
		// sub_total
		// refund_status
		// pay_date
		// calculate_date
		// refund_slipt_num

		if ($refundable->RowType == EW_ROWTYPE_VIEW) { // View row

			// refund_id
			$refundable->refund_id->ViewValue = $refundable->refund_id->CurrentValue;
			$refundable->refund_id->ViewCustomAttributes = "";

			// member_code
			$refundable->member_code->ViewValue = $refundable->member_code->CurrentValue;
			if (strval($refundable->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($refundable->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$refundable->member_code->ViewValue = $rswrk->fields('member_code');
					$refundable->member_code->ViewValue .= ew_ValueSeparator(0,1,$refundable->member_code) . $rswrk->fields('fname');
					$refundable->member_code->ViewValue .= ew_ValueSeparator(0,2,$refundable->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$refundable->member_code->ViewValue = $refundable->member_code->CurrentValue;
				}
			} else {
				$refundable->member_code->ViewValue = NULL;
			}
			$refundable->member_code->ViewCustomAttributes = "";

			// refund_total
			$refundable->refund_total->ViewValue = $refundable->refund_total->CurrentValue;
			$refundable->refund_total->ViewCustomAttributes = "";

			// assc_percent
			$refundable->assc_percent->ViewValue = $refundable->assc_percent->CurrentValue;
			$refundable->assc_percent->ViewCustomAttributes = "";

			// assc_total
			$refundable->assc_total->ViewValue = $refundable->assc_total->CurrentValue;
			$refundable->assc_total->ViewCustomAttributes = "";

			// sub_total
			$refundable->sub_total->ViewValue = $refundable->sub_total->CurrentValue;
			$refundable->sub_total->ViewCustomAttributes = "";

			// refund_status
			$refundable->refund_status->ViewValue = $refundable->refund_status->CurrentValue;
			$refundable->refund_status->ViewCustomAttributes = "";

			// pay_date
			$refundable->pay_date->ViewValue = $refundable->pay_date->CurrentValue;
			$refundable->pay_date->ViewValue = ew_FormatDateTime($refundable->pay_date->ViewValue, 7);
			$refundable->pay_date->ViewCustomAttributes = "";

			// refund_slipt_num
			$refundable->refund_slipt_num->ViewValue = $refundable->refund_slipt_num->CurrentValue;
			$refundable->refund_slipt_num->ViewCustomAttributes = "";

			// refund_id
			$refundable->refund_id->LinkCustomAttributes = "";
			$refundable->refund_id->HrefValue = "";
			$refundable->refund_id->TooltipValue = "";

			// member_code
			$refundable->member_code->LinkCustomAttributes = "";
			$refundable->member_code->HrefValue = "";
			$refundable->member_code->TooltipValue = "";

			// refund_total
			$refundable->refund_total->LinkCustomAttributes = "";
			$refundable->refund_total->HrefValue = "";
			$refundable->refund_total->TooltipValue = "";

			// assc_percent
			$refundable->assc_percent->LinkCustomAttributes = "";
			$refundable->assc_percent->HrefValue = "";
			$refundable->assc_percent->TooltipValue = "";

			// assc_total
			$refundable->assc_total->LinkCustomAttributes = "";
			$refundable->assc_total->HrefValue = "";
			$refundable->assc_total->TooltipValue = "";

			// sub_total
			$refundable->sub_total->LinkCustomAttributes = "";
			$refundable->sub_total->HrefValue = "";
			$refundable->sub_total->TooltipValue = "";

			// refund_status
			$refundable->refund_status->LinkCustomAttributes = "";
			$refundable->refund_status->HrefValue = "";
			$refundable->refund_status->TooltipValue = "";

			// pay_date
			$refundable->pay_date->LinkCustomAttributes = "";
			$refundable->pay_date->HrefValue = "";
			$refundable->pay_date->TooltipValue = "";

			// refund_slipt_num
			$refundable->refund_slipt_num->LinkCustomAttributes = "";
			$refundable->refund_slipt_num->HrefValue = "";
			$refundable->refund_slipt_num->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($refundable->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$refundable->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $refundable;

		// Printer friendly
		$item =& $this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item =& $this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item =& $this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item =& $this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item =& $this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item =& $this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = FALSE;

		// Export to Pdf
		$item =& $this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item =& $this->ExportOptions->Add("email");
		$item->Body = "<a name=\"emf_refundable\" id=\"emf_refundable\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_refundable',hdr:ewLanguage.Phrase('ExportToEmail'),key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($refundable->Export <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $refundable;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $refundable->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;
		$this->SetUpStartRec(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecs < 0) {
			$this->StopRec = $this->TotalRecs;
		} else {
			$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
		}
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($refundable->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($refundable, "v");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($refundable->Export == "xml") {
			$refundable->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "view");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$refundable->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "view");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($refundable->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($refundable->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($refundable->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($refundable->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($refundable->ExportReturnUrl());
		} elseif ($refundable->Export == "pdf") {
			$this->ExportPDF($ExportDoc->Text);
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Export PDF
	function ExportPDF($html) {
		global $gsExportFile;
		include_once "dompdf060b2/dompdf_config.inc.php";
		@ini_set("memory_limit", EW_PDF_MEMORY_LIMIT);
		set_time_limit(EW_PDF_TIME_LIMIT);
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("a4", "portrait");
		$dompdf->render();
		ob_end_clean();
		ew_DeleteTmpImages();
		$dompdf->stream($gsExportFile . ".pdf", array("Attachment" => 1)); // 0 to open in browser, 1 to download

//		exit();
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

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
