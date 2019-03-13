<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subventionpaymentinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subventionpayment_view = new csubventionpayment_view();
$Page =& $subventionpayment_view;

// Page init
$subventionpayment_view->Page_Init();

// Page main
$subventionpayment_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($subventionpayment->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subventionpayment_view = new ew_Page("subventionpayment_view");

// page properties
subventionpayment_view.PageID = "view"; // page ID
subventionpayment_view.FormID = "fsubventionpaymentview"; // form ID
var EW_PAGE_ID = subventionpayment_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subventionpayment_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subventionpayment_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subventionpayment_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subventionpayment_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subventionpayment->TableCaption() ?>
&nbsp;&nbsp;<?php $subventionpayment_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($subventionpayment->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $subventionpayment_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subventionpayment_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subventionpayment_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subventionpayment_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subventionpayment_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $subventionpayment_view->ShowPageHeader(); ?>
<?php
$subventionpayment_view->ShowMessage();
?>
<p>
<?php if ($subventionpayment->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($subventionpayment_view->Pager)) $subventionpayment_view->Pager = new cPrevNextPager($subventionpayment_view->StartRec, $subventionpayment_view->DisplayRecs, $subventionpayment_view->TotalRecs) ?>
<?php if ($subventionpayment_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($subventionpayment_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_view->PageUrl() ?>start=<?php echo $subventionpayment_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($subventionpayment_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_view->PageUrl() ?>start=<?php echo $subventionpayment_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $subventionpayment_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($subventionpayment_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_view->PageUrl() ?>start=<?php echo $subventionpayment_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($subventionpayment_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_view->PageUrl() ?>start=<?php echo $subventionpayment_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $subventionpayment_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($subventionpayment_view->SearchWhere == "0=101") { ?>
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
<?php if ($subventionpayment->payment_id->Visible) { // payment_id ?>
	<tr id="r_payment_id"<?php echo $subventionpayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subventionpayment->payment_id->FldCaption() ?></td>
		<td<?php echo $subventionpayment->payment_id->CellAttributes() ?>>
<div<?php echo $subventionpayment->payment_id->ViewAttributes() ?>><?php echo $subventionpayment->payment_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subventionpayment->dead_id->Visible) { // dead_id ?>
	<tr id="r_dead_id"<?php echo $subventionpayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subventionpayment->dead_id->FldCaption() ?></td>
		<td<?php echo $subventionpayment->dead_id->CellAttributes() ?>>
<div<?php echo $subventionpayment->dead_id->ViewAttributes() ?>><?php echo $subventionpayment->dead_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subventionpayment->payment_date->Visible) { // payment_date ?>
	<tr id="r_payment_date"<?php echo $subventionpayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subventionpayment->payment_date->FldCaption() ?></td>
		<td<?php echo $subventionpayment->payment_date->CellAttributes() ?>>
<div<?php echo $subventionpayment->payment_date->ViewAttributes() ?>><?php echo $subventionpayment->payment_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subventionpayment->subvent_total->Visible) { // subvent_total ?>
	<tr id="r_subvent_total"<?php echo $subventionpayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subventionpayment->subvent_total->FldCaption() ?></td>
		<td<?php echo $subventionpayment->subvent_total->CellAttributes() ?>>
<div<?php echo $subventionpayment->subvent_total->ViewAttributes() ?>><?php echo $subventionpayment->subvent_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subventionpayment->payee->Visible) { // payee ?>
	<tr id="r_payee"<?php echo $subventionpayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subventionpayment->payee->FldCaption() ?></td>
		<td<?php echo $subventionpayment->payee->CellAttributes() ?>>
<div<?php echo $subventionpayment->payee->ViewAttributes() ?>><?php echo $subventionpayment->payee->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subventionpayment->pay_des->Visible) { // pay_des ?>
	<tr id="r_pay_des"<?php echo $subventionpayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subventionpayment->pay_des->FldCaption() ?></td>
		<td<?php echo $subventionpayment->pay_des->CellAttributes() ?>>
<div<?php echo $subventionpayment->pay_des->ViewAttributes() ?>><?php echo $subventionpayment->pay_des->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($subventionpayment->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($subventionpayment_view->Pager)) $subventionpayment_view->Pager = new cPrevNextPager($subventionpayment_view->StartRec, $subventionpayment_view->DisplayRecs, $subventionpayment_view->TotalRecs) ?>
<?php if ($subventionpayment_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($subventionpayment_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_view->PageUrl() ?>start=<?php echo $subventionpayment_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($subventionpayment_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_view->PageUrl() ?>start=<?php echo $subventionpayment_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $subventionpayment_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($subventionpayment_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_view->PageUrl() ?>start=<?php echo $subventionpayment_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($subventionpayment_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $subventionpayment_view->PageUrl() ?>start=<?php echo $subventionpayment_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $subventionpayment_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($subventionpayment_view->SearchWhere == "0=101") { ?>
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
$subventionpayment_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($subventionpayment->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$subventionpayment_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csubventionpayment_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'subventionpayment';

	// Page object name
	var $PageObjName = 'subventionpayment_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subventionpayment;
		if ($subventionpayment->UseTokenInUrl) $PageUrl .= "t=" . $subventionpayment->TableVar . "&"; // Add page token
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
		global $objForm, $subventionpayment;
		if ($subventionpayment->UseTokenInUrl) {
			if ($objForm)
				return ($subventionpayment->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subventionpayment->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubventionpayment_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subventionpayment)
		if (!isset($GLOBALS["subventionpayment"])) {
			$GLOBALS["subventionpayment"] = new csubventionpayment();
			$GLOBALS["Table"] =& $GLOBALS["subventionpayment"];
		}
		$KeyUrl = "";
		if (@$_GET["payment_id"] <> "") {
			$this->RecKey["payment_id"] = $_GET["payment_id"];
			$KeyUrl .= "&payment_id=" . urlencode($this->RecKey["payment_id"]);
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
			define("EW_TABLE_NAME", 'subventionpayment', TRUE);

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
		global $subventionpayment;

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
			$subventionpayment->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$subventionpayment->Export = $_POST["exporttype"];
		} else {
			$subventionpayment->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $subventionpayment->Export; // Get export parameter, used in header
		$gsExportFile = $subventionpayment->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if (@$_GET["payment_id"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["payment_id"]);
		}
		if ($subventionpayment->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($subventionpayment->Export == "word") {
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
		global $Language, $subventionpayment;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["payment_id"] <> "") {
				$subventionpayment->payment_id->setQueryStringValue($_GET["payment_id"]);
				$this->RecKey["payment_id"] = $subventionpayment->payment_id->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$subventionpayment->CurrentAction = "I"; // Display form
			switch ($subventionpayment->CurrentAction) {
				case "I": // Get a record to display
					$this->StartRec = 1; // Initialize start position
					if ($this->Recordset = $this->LoadRecordset()) // Load records
						$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecs <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("subventionpaymentlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($subventionpayment->payment_id->CurrentValue) == strval($this->Recordset->fields('payment_id'))) {
								$subventionpayment->setStartRecordNumber($this->StartRec); // Save record position
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
						$sReturnUrl = "subventionpaymentlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}

			// Export data only
			if (in_array($subventionpayment->Export, array("html","word","excel","xml","csv","email","pdf"))) {
				$this->ExportData();
				if ($subventionpayment->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "subventionpaymentlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$subventionpayment->RowType = EW_ROWTYPE_VIEW;
		$subventionpayment->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subventionpayment;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$subventionpayment->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$subventionpayment->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $subventionpayment->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$subventionpayment->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$subventionpayment->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$subventionpayment->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subventionpayment;

		// Call Recordset Selecting event
		$subventionpayment->Recordset_Selecting($subventionpayment->CurrentFilter);

		// Load List page SQL
		$sSql = $subventionpayment->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subventionpayment->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subventionpayment;
		$sFilter = $subventionpayment->KeyFilter();

		// Call Row Selecting event
		$subventionpayment->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subventionpayment->CurrentFilter = $sFilter;
		$sSql = $subventionpayment->SQL();
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
		global $conn, $subventionpayment;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subventionpayment->Row_Selected($row);
		$subventionpayment->payment_id->setDbValue($rs->fields('payment_id'));
		$subventionpayment->dead_id->setDbValue($rs->fields('dead_id'));
		$subventionpayment->payment_date->setDbValue($rs->fields('payment_date'));
		$subventionpayment->subvent_total->setDbValue($rs->fields('subvent_total'));
		$subventionpayment->payee->setDbValue($rs->fields('payee'));
		$subventionpayment->pay_des->setDbValue($rs->fields('pay_des'));
		$subventionpayment->donate_total->setDbValue($rs->fields('donate_total'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subventionpayment;

		// Initialize URLs
		$this->AddUrl = $subventionpayment->AddUrl();
		$this->EditUrl = $subventionpayment->EditUrl();
		$this->CopyUrl = $subventionpayment->CopyUrl();
		$this->DeleteUrl = $subventionpayment->DeleteUrl();
		$this->ListUrl = $subventionpayment->ListUrl();

		// Call Row_Rendering event
		$subventionpayment->Row_Rendering();

		// Common render codes for all row types
		// payment_id
		// dead_id
		// payment_date
		// subvent_total
		// payee
		// pay_des
		// donate_total

		if ($subventionpayment->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_id
			$subventionpayment->payment_id->ViewValue = $subventionpayment->payment_id->CurrentValue;
			$subventionpayment->payment_id->ViewCustomAttributes = "";

			// dead_id
			$subventionpayment->dead_id->ViewValue = $subventionpayment->dead_id->CurrentValue;
			$subventionpayment->dead_id->ViewCustomAttributes = "";

			// payment_date
			$subventionpayment->payment_date->ViewValue = $subventionpayment->payment_date->CurrentValue;
			$subventionpayment->payment_date->ViewValue = ew_FormatDateTime($subventionpayment->payment_date->ViewValue, 7);
			$subventionpayment->payment_date->ViewCustomAttributes = "";

			// subvent_total
			$subventionpayment->subvent_total->ViewValue = $subventionpayment->subvent_total->CurrentValue;
			$subventionpayment->subvent_total->ViewCustomAttributes = "";

			// payee
			$subventionpayment->payee->ViewValue = $subventionpayment->payee->CurrentValue;
			$subventionpayment->payee->ViewCustomAttributes = "";

			// pay_des
			$subventionpayment->pay_des->ViewValue = $subventionpayment->pay_des->CurrentValue;
			$subventionpayment->pay_des->ViewCustomAttributes = "";

			// payment_id
			$subventionpayment->payment_id->LinkCustomAttributes = "";
			$subventionpayment->payment_id->HrefValue = "";
			$subventionpayment->payment_id->TooltipValue = "";

			// dead_id
			$subventionpayment->dead_id->LinkCustomAttributes = "";
			$subventionpayment->dead_id->HrefValue = "";
			$subventionpayment->dead_id->TooltipValue = "";

			// payment_date
			$subventionpayment->payment_date->LinkCustomAttributes = "";
			$subventionpayment->payment_date->HrefValue = "";
			$subventionpayment->payment_date->TooltipValue = "";

			// subvent_total
			$subventionpayment->subvent_total->LinkCustomAttributes = "";
			$subventionpayment->subvent_total->HrefValue = "";
			$subventionpayment->subvent_total->TooltipValue = "";

			// payee
			$subventionpayment->payee->LinkCustomAttributes = "";
			$subventionpayment->payee->HrefValue = "";
			$subventionpayment->payee->TooltipValue = "";

			// pay_des
			$subventionpayment->pay_des->LinkCustomAttributes = "";
			$subventionpayment->pay_des->HrefValue = "";
			$subventionpayment->pay_des->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subventionpayment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subventionpayment->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $subventionpayment;

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
		$item->Body = "<a name=\"emf_subventionpayment\" id=\"emf_subventionpayment\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_subventionpayment',hdr:ewLanguage.Phrase('ExportToEmail'),key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($subventionpayment->Export <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $subventionpayment;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $subventionpayment->SelectRecordCount();
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
		if ($subventionpayment->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($subventionpayment, "v");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($subventionpayment->Export == "xml") {
			$subventionpayment->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "view");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$subventionpayment->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "view");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($subventionpayment->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($subventionpayment->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($subventionpayment->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($subventionpayment->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($subventionpayment->ExportReturnUrl());
		} elseif ($subventionpayment->Export == "pdf") {
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
