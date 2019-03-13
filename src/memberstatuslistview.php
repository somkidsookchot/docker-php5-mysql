<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "memberstatuslistinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$memberstatuslist_view = new cmemberstatuslist_view();
$Page =& $memberstatuslist_view;

// Page init
$memberstatuslist_view->Page_Init();

// Page main
$memberstatuslist_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($memberstatuslist->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var memberstatuslist_view = new ew_Page("memberstatuslist_view");

// page properties
memberstatuslist_view.PageID = "view"; // page ID
memberstatuslist_view.FormID = "fmemberstatuslistview"; // form ID
var EW_PAGE_ID = memberstatuslist_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
memberstatuslist_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
memberstatuslist_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
memberstatuslist_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memberstatuslist_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $memberstatuslist->TableCaption() ?>
&nbsp;&nbsp;<?php $memberstatuslist_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($memberstatuslist->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $memberstatuslist_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $memberstatuslist_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $memberstatuslist_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $memberstatuslist_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $memberstatuslist_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</p>
<?php $memberstatuslist_view->ShowPageHeader(); ?>
<?php
$memberstatuslist_view->ShowMessage();
?>
<p>
<?php if ($memberstatuslist->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($memberstatuslist_view->Pager)) $memberstatuslist_view->Pager = new cPrevNextPager($memberstatuslist_view->StartRec, $memberstatuslist_view->DisplayRecs, $memberstatuslist_view->TotalRecs) ?>
<?php if ($memberstatuslist_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($memberstatuslist_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_view->PageUrl() ?>start=<?php echo $memberstatuslist_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($memberstatuslist_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_view->PageUrl() ?>start=<?php echo $memberstatuslist_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $memberstatuslist_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($memberstatuslist_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_view->PageUrl() ?>start=<?php echo $memberstatuslist_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($memberstatuslist_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_view->PageUrl() ?>start=<?php echo $memberstatuslist_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $memberstatuslist_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($memberstatuslist_view->SearchWhere == "0=101") { ?>
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
<?php if ($memberstatuslist->member_id->Visible) { // member_id ?>
	<tr id="r_member_id"<?php echo $memberstatuslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memberstatuslist->member_id->FldCaption() ?></td>
		<td<?php echo $memberstatuslist->member_id->CellAttributes() ?>>
<div<?php echo $memberstatuslist->member_id->ViewAttributes() ?>><?php echo $memberstatuslist->member_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($memberstatuslist->status->Visible) { // status ?>
	<tr id="r_status"<?php echo $memberstatuslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memberstatuslist->status->FldCaption() ?></td>
		<td<?php echo $memberstatuslist->status->CellAttributes() ?>>
<div<?php echo $memberstatuslist->status->ViewAttributes() ?>><?php echo $memberstatuslist->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($memberstatuslist->mbs_date->Visible) { // mbs_date ?>
	<tr id="r_mbs_date"<?php echo $memberstatuslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memberstatuslist->mbs_date->FldCaption() ?></td>
		<td<?php echo $memberstatuslist->mbs_date->CellAttributes() ?>>
<div<?php echo $memberstatuslist->mbs_date->ViewAttributes() ?>><?php echo $memberstatuslist->mbs_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($memberstatuslist->mbs_detail->Visible) { // mbs_detail ?>
	<tr id="r_mbs_detail"<?php echo $memberstatuslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memberstatuslist->mbs_detail->FldCaption() ?></td>
		<td<?php echo $memberstatuslist->mbs_detail->CellAttributes() ?>>
<div<?php echo $memberstatuslist->mbs_detail->ViewAttributes() ?>><?php echo $memberstatuslist->mbs_detail->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($memberstatuslist->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($memberstatuslist_view->Pager)) $memberstatuslist_view->Pager = new cPrevNextPager($memberstatuslist_view->StartRec, $memberstatuslist_view->DisplayRecs, $memberstatuslist_view->TotalRecs) ?>
<?php if ($memberstatuslist_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($memberstatuslist_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_view->PageUrl() ?>start=<?php echo $memberstatuslist_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($memberstatuslist_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_view->PageUrl() ?>start=<?php echo $memberstatuslist_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $memberstatuslist_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($memberstatuslist_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_view->PageUrl() ?>start=<?php echo $memberstatuslist_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($memberstatuslist_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $memberstatuslist_view->PageUrl() ?>start=<?php echo $memberstatuslist_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $memberstatuslist_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($memberstatuslist_view->SearchWhere == "0=101") { ?>
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
$memberstatuslist_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($memberstatuslist->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$memberstatuslist_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cmemberstatuslist_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'memberstatuslist';

	// Page object name
	var $PageObjName = 'memberstatuslist_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $memberstatuslist;
		if ($memberstatuslist->UseTokenInUrl) $PageUrl .= "t=" . $memberstatuslist->TableVar . "&"; // Add page token
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
		global $objForm, $memberstatuslist;
		if ($memberstatuslist->UseTokenInUrl) {
			if ($objForm)
				return ($memberstatuslist->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($memberstatuslist->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmemberstatuslist_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (memberstatuslist)
		if (!isset($GLOBALS["memberstatuslist"])) {
			$GLOBALS["memberstatuslist"] = new cmemberstatuslist();
			$GLOBALS["Table"] =& $GLOBALS["memberstatuslist"];
		}
		$KeyUrl = "";
		if (@$_GET["mbs_id"] <> "") {
			$this->RecKey["mbs_id"] = $_GET["mbs_id"];
			$KeyUrl .= "&mbs_id=" . urlencode($this->RecKey["mbs_id"]);
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
			define("EW_TABLE_NAME", 'memberstatuslist', TRUE);

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
		global $memberstatuslist;

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
			$memberstatuslist->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$memberstatuslist->Export = $_POST["exporttype"];
		} else {
			$memberstatuslist->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $memberstatuslist->Export; // Get export parameter, used in header
		$gsExportFile = $memberstatuslist->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if (@$_GET["mbs_id"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["mbs_id"]);
		}
		if ($memberstatuslist->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($memberstatuslist->Export == "word") {
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
		global $Language, $memberstatuslist;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["mbs_id"] <> "") {
				$memberstatuslist->mbs_id->setQueryStringValue($_GET["mbs_id"]);
				$this->RecKey["mbs_id"] = $memberstatuslist->mbs_id->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$memberstatuslist->CurrentAction = "I"; // Display form
			switch ($memberstatuslist->CurrentAction) {
				case "I": // Get a record to display
					$this->StartRec = 1; // Initialize start position
					if ($this->Recordset = $this->LoadRecordset()) // Load records
						$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecs <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("memberstatuslistlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($memberstatuslist->mbs_id->CurrentValue) == strval($this->Recordset->fields('mbs_id'))) {
								$memberstatuslist->setStartRecordNumber($this->StartRec); // Save record position
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
						$sReturnUrl = "memberstatuslistlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}

			// Export data only
			if (in_array($memberstatuslist->Export, array("html","word","excel","xml","csv","email","pdf"))) {
				$this->ExportData();
				if ($memberstatuslist->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "memberstatuslistlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$memberstatuslist->RowType = EW_ROWTYPE_VIEW;
		$memberstatuslist->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $memberstatuslist;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$memberstatuslist->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$memberstatuslist->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $memberstatuslist->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$memberstatuslist->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$memberstatuslist->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$memberstatuslist->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $memberstatuslist;

		// Call Recordset Selecting event
		$memberstatuslist->Recordset_Selecting($memberstatuslist->CurrentFilter);

		// Load List page SQL
		$sSql = $memberstatuslist->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$memberstatuslist->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $memberstatuslist;
		$sFilter = $memberstatuslist->KeyFilter();

		// Call Row Selecting event
		$memberstatuslist->Row_Selecting($sFilter);

		// Load SQL based on filter
		$memberstatuslist->CurrentFilter = $sFilter;
		$sSql = $memberstatuslist->SQL();
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
		global $conn, $memberstatuslist;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$memberstatuslist->Row_Selected($row);
		$memberstatuslist->mbs_id->setDbValue($rs->fields('mbs_id'));
		$memberstatuslist->member_id->setDbValue($rs->fields('member_id'));
		$memberstatuslist->status->setDbValue($rs->fields('status'));
		$memberstatuslist->mbs_date->setDbValue($rs->fields('mbs_date'));
		$memberstatuslist->mbs_detail->setDbValue($rs->fields('mbs_detail'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $memberstatuslist;

		// Initialize URLs
		$this->AddUrl = $memberstatuslist->AddUrl();
		$this->EditUrl = $memberstatuslist->EditUrl();
		$this->CopyUrl = $memberstatuslist->CopyUrl();
		$this->DeleteUrl = $memberstatuslist->DeleteUrl();
		$this->ListUrl = $memberstatuslist->ListUrl();

		// Call Row_Rendering event
		$memberstatuslist->Row_Rendering();

		// Common render codes for all row types
		// mbs_id
		// member_id
		// status
		// mbs_date
		// mbs_detail

		if ($memberstatuslist->RowType == EW_ROWTYPE_VIEW) { // View row

			// mbs_id
			$memberstatuslist->mbs_id->ViewValue = $memberstatuslist->mbs_id->CurrentValue;
			$memberstatuslist->mbs_id->ViewCustomAttributes = "";

			// member_id
			$memberstatuslist->member_id->ViewValue = $memberstatuslist->member_id->CurrentValue;
			$memberstatuslist->member_id->ViewCustomAttributes = "";

			// status
			if (strval($memberstatuslist->status->CurrentValue) <> "") {
				$sFilterWrk = "`s_title` = '" . ew_AdjustSql($memberstatuslist->status->CurrentValue) . "'";
			$sSqlWrk = "SELECT `s_title` FROM `memberstatus`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$memberstatuslist->status->ViewValue = $rswrk->fields('s_title');
					$rswrk->Close();
				} else {
					$memberstatuslist->status->ViewValue = $memberstatuslist->status->CurrentValue;
				}
			} else {
				$memberstatuslist->status->ViewValue = NULL;
			}
			$memberstatuslist->status->ViewCustomAttributes = "";

			// mbs_date
			$memberstatuslist->mbs_date->ViewValue = $memberstatuslist->mbs_date->CurrentValue;
			$memberstatuslist->mbs_date->ViewValue = ew_FormatDateTime($memberstatuslist->mbs_date->ViewValue, 7);
			$memberstatuslist->mbs_date->ViewCustomAttributes = "";

			// mbs_detail
			$memberstatuslist->mbs_detail->ViewValue = $memberstatuslist->mbs_detail->CurrentValue;
			$memberstatuslist->mbs_detail->ViewCustomAttributes = "";

			// member_id
			$memberstatuslist->member_id->LinkCustomAttributes = "";
			$memberstatuslist->member_id->HrefValue = "";
			$memberstatuslist->member_id->TooltipValue = "";

			// status
			$memberstatuslist->status->LinkCustomAttributes = "";
			$memberstatuslist->status->HrefValue = "";
			$memberstatuslist->status->TooltipValue = "";

			// mbs_date
			$memberstatuslist->mbs_date->LinkCustomAttributes = "";
			$memberstatuslist->mbs_date->HrefValue = "";
			$memberstatuslist->mbs_date->TooltipValue = "";

			// mbs_detail
			$memberstatuslist->mbs_detail->LinkCustomAttributes = "";
			$memberstatuslist->mbs_detail->HrefValue = "";
			$memberstatuslist->mbs_detail->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($memberstatuslist->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$memberstatuslist->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $memberstatuslist;

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
		$item->Body = "<a name=\"emf_memberstatuslist\" id=\"emf_memberstatuslist\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_memberstatuslist',hdr:ewLanguage.Phrase('ExportToEmail'),key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($memberstatuslist->Export <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $memberstatuslist;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $memberstatuslist->SelectRecordCount();
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
		if ($memberstatuslist->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($memberstatuslist, "v");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($memberstatuslist->Export == "xml") {
			$memberstatuslist->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "view");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$memberstatuslist->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "view");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($memberstatuslist->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($memberstatuslist->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($memberstatuslist->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($memberstatuslist->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($memberstatuslist->ExportReturnUrl());
		} elseif ($memberstatuslist->Export == "pdf") {
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
