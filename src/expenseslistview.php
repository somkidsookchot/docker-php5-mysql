<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "expenseslistinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$expenseslist_view = new cexpenseslist_view();
$Page =& $expenseslist_view;

// Page init
$expenseslist_view->Page_Init();

// Page main
$expenseslist_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($expenseslist->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var expenseslist_view = new ew_Page("expenseslist_view");

// page properties
expenseslist_view.PageID = "view"; // page ID
expenseslist_view.FormID = "fexpenseslistview"; // form ID
var EW_PAGE_ID = expenseslist_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
expenseslist_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expenseslist_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expenseslist_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expenseslist_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expenseslist->TableCaption() ?>
&nbsp;&nbsp;<?php $expenseslist_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($expenseslist->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $expenseslist_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $expenseslist_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $expenseslist_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $expenseslist_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $expenseslist_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php $expenseslist_view->ShowPageHeader(); ?>
<?php
$expenseslist_view->ShowMessage();
?>
<p>
<?php if ($expenseslist->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expenseslist_view->Pager)) $expenseslist_view->Pager = new cPrevNextPager($expenseslist_view->StartRec, $expenseslist_view->DisplayRecs, $expenseslist_view->TotalRecs) ?>
<?php if ($expenseslist_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expenseslist_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_view->PageUrl() ?>start=<?php echo $expenseslist_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expenseslist_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_view->PageUrl() ?>start=<?php echo $expenseslist_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expenseslist_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expenseslist_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_view->PageUrl() ?>start=<?php echo $expenseslist_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expenseslist_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_view->PageUrl() ?>start=<?php echo $expenseslist_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expenseslist_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($expenseslist_view->SearchWhere == "0=101") { ?>
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
<?php if ($expenseslist->exp_cat->Visible) { // exp_cat ?>
	<tr id="r_exp_cat"<?php echo $expenseslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expenseslist->exp_cat->FldCaption() ?></td>
		<td<?php echo $expenseslist->exp_cat->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_cat->ViewAttributes() ?>><?php echo $expenseslist->exp_cat->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expenseslist->exp_detail->Visible) { // exp_detail ?>
	<tr id="r_exp_detail"<?php echo $expenseslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expenseslist->exp_detail->FldCaption() ?></td>
		<td<?php echo $expenseslist->exp_detail->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_detail->ViewAttributes() ?>><?php echo $expenseslist->exp_detail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expenseslist->exp_total->Visible) { // exp_total ?>
	<tr id="r_exp_total"<?php echo $expenseslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expenseslist->exp_total->FldCaption() ?></td>
		<td<?php echo $expenseslist->exp_total->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_total->ViewAttributes() ?>><?php echo $expenseslist->exp_total->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expenseslist->exp_date->Visible) { // exp_date ?>
	<tr id="r_exp_date"<?php echo $expenseslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expenseslist->exp_date->FldCaption() ?></td>
		<td<?php echo $expenseslist->exp_date->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_date->ViewAttributes() ?>><?php echo $expenseslist->exp_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expenseslist->exp_dispencer->Visible) { // exp_dispencer ?>
	<tr id="r_exp_dispencer"<?php echo $expenseslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expenseslist->exp_dispencer->FldCaption() ?></td>
		<td<?php echo $expenseslist->exp_dispencer->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_dispencer->ViewAttributes() ?>><?php echo $expenseslist->exp_dispencer->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($expenseslist->exp_slipt_num->Visible) { // exp_slipt_num ?>
	<tr id="r_exp_slipt_num"<?php echo $expenseslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expenseslist->exp_slipt_num->FldCaption() ?></td>
		<td<?php echo $expenseslist->exp_slipt_num->CellAttributes() ?>>
<div<?php echo $expenseslist->exp_slipt_num->ViewAttributes() ?>><?php echo $expenseslist->exp_slipt_num->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($expenseslist->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($expenseslist_view->Pager)) $expenseslist_view->Pager = new cPrevNextPager($expenseslist_view->StartRec, $expenseslist_view->DisplayRecs, $expenseslist_view->TotalRecs) ?>
<?php if ($expenseslist_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($expenseslist_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_view->PageUrl() ?>start=<?php echo $expenseslist_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($expenseslist_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_view->PageUrl() ?>start=<?php echo $expenseslist_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $expenseslist_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($expenseslist_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_view->PageUrl() ?>start=<?php echo $expenseslist_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($expenseslist_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $expenseslist_view->PageUrl() ?>start=<?php echo $expenseslist_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $expenseslist_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($expenseslist_view->SearchWhere == "0=101") { ?>
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
$expenseslist_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($expenseslist->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$expenseslist_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpenseslist_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'expenseslist';

	// Page object name
	var $PageObjName = 'expenseslist_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expenseslist;
		if ($expenseslist->UseTokenInUrl) $PageUrl .= "t=" . $expenseslist->TableVar . "&"; // Add page token
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
		global $objForm, $expenseslist;
		if ($expenseslist->UseTokenInUrl) {
			if ($objForm)
				return ($expenseslist->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expenseslist->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpenseslist_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (expenseslist)
		if (!isset($GLOBALS["expenseslist"])) {
			$GLOBALS["expenseslist"] = new cexpenseslist();
			$GLOBALS["Table"] =& $GLOBALS["expenseslist"];
		}
		$KeyUrl = "";
		if (@$_GET["exp_id"] <> "") {
			$this->RecKey["exp_id"] = $_GET["exp_id"];
			$KeyUrl .= "&exp_id=" . urlencode($this->RecKey["exp_id"]);
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
			define("EW_TABLE_NAME", 'expenseslist', TRUE);

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
		global $expenseslist;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$expenseslist->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$expenseslist->Export = $_POST["exporttype"];
		} else {
			$expenseslist->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $expenseslist->Export; // Get export parameter, used in header
		$gsExportFile = $expenseslist->TableVar; // Get export file, used in header
		$Charset = (EW_CHARSET <> "") ? ";charset=" . EW_CHARSET : ""; // Charset used in header
		if (@$_GET["exp_id"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["exp_id"]);
		}
		if ($expenseslist->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel' . $Charset);
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($expenseslist->Export == "word") {
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
		global $Language, $expenseslist;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["exp_id"] <> "") {
				$expenseslist->exp_id->setQueryStringValue($_GET["exp_id"]);
				$this->RecKey["exp_id"] = $expenseslist->exp_id->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$expenseslist->CurrentAction = "I"; // Display form
			switch ($expenseslist->CurrentAction) {
				case "I": // Get a record to display
					$this->StartRec = 1; // Initialize start position
					if ($this->Recordset = $this->LoadRecordset()) // Load records
						$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecs <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("expenseslistlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($expenseslist->exp_id->CurrentValue) == strval($this->Recordset->fields('exp_id'))) {
								$expenseslist->setStartRecordNumber($this->StartRec); // Save record position
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
						$sReturnUrl = "expenseslistlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}

			// Export data only
			if (in_array($expenseslist->Export, array("html","word","excel","xml","csv","email","pdf"))) {
				$this->ExportData();
				if ($expenseslist->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "expenseslistlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$expenseslist->RowType = EW_ROWTYPE_VIEW;
		$expenseslist->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $expenseslist;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$expenseslist->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$expenseslist->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $expenseslist->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$expenseslist->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$expenseslist->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$expenseslist->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $expenseslist;

		// Call Recordset Selecting event
		$expenseslist->Recordset_Selecting($expenseslist->CurrentFilter);

		// Load List page SQL
		$sSql = $expenseslist->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$expenseslist->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expenseslist;
		$sFilter = $expenseslist->KeyFilter();

		// Call Row Selecting event
		$expenseslist->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expenseslist->CurrentFilter = $sFilter;
		$sSql = $expenseslist->SQL();
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
		global $conn, $expenseslist;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$expenseslist->Row_Selected($row);
		$expenseslist->exp_id->setDbValue($rs->fields('exp_id'));
		$expenseslist->exp_cat->setDbValue($rs->fields('exp_cat'));
		$expenseslist->exp_detail->setDbValue($rs->fields('exp_detail'));
		$expenseslist->exp_total->setDbValue($rs->fields('exp_total'));
		$expenseslist->exp_date->setDbValue($rs->fields('exp_date'));
		$expenseslist->exp_dispencer->setDbValue($rs->fields('exp_dispencer'));
		$expenseslist->exp_slipt_num->setDbValue($rs->fields('exp_slipt_num'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expenseslist;

		// Initialize URLs
		$this->AddUrl = $expenseslist->AddUrl();
		$this->EditUrl = $expenseslist->EditUrl();
		$this->CopyUrl = $expenseslist->CopyUrl();
		$this->DeleteUrl = $expenseslist->DeleteUrl();
		$this->ListUrl = $expenseslist->ListUrl();

		// Call Row_Rendering event
		$expenseslist->Row_Rendering();

		// Common render codes for all row types
		// exp_id
		// exp_cat
		// exp_detail
		// exp_total
		// exp_date
		// exp_dispencer
		// exp_slipt_num

		if ($expenseslist->RowType == EW_ROWTYPE_VIEW) { // View row

			// exp_cat
			if (strval($expenseslist->exp_cat->CurrentValue) <> "") {
				$sFilterWrk = "`exp_cat_id` = " . ew_AdjustSql($expenseslist->exp_cat->CurrentValue) . "";
			$sSqlWrk = "SELECT `exp_cat_title` FROM `expensescategory`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `exp_cat_title`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenseslist->exp_cat->ViewValue = $rswrk->fields('exp_cat_title');
					$rswrk->Close();
				} else {
					$expenseslist->exp_cat->ViewValue = $expenseslist->exp_cat->CurrentValue;
				}
			} else {
				$expenseslist->exp_cat->ViewValue = NULL;
			}
			$expenseslist->exp_cat->ViewCustomAttributes = "";

			// exp_detail
			$expenseslist->exp_detail->ViewValue = $expenseslist->exp_detail->CurrentValue;
			$expenseslist->exp_detail->ViewCustomAttributes = "";

			// exp_total
			$expenseslist->exp_total->ViewValue = $expenseslist->exp_total->CurrentValue;
			$expenseslist->exp_total->ViewCustomAttributes = "";

			// exp_date
			$expenseslist->exp_date->ViewValue = $expenseslist->exp_date->CurrentValue;
			$expenseslist->exp_date->ViewValue = ew_FormatDateTime($expenseslist->exp_date->ViewValue, 7);
			$expenseslist->exp_date->ViewCustomAttributes = "";

			// exp_dispencer
			$expenseslist->exp_dispencer->ViewValue = $expenseslist->exp_dispencer->CurrentValue;
			$expenseslist->exp_dispencer->ViewCustomAttributes = "";

			// exp_slipt_num
			$expenseslist->exp_slipt_num->ViewValue = $expenseslist->exp_slipt_num->CurrentValue;
			$expenseslist->exp_slipt_num->ViewCustomAttributes = "";

			// exp_cat
			$expenseslist->exp_cat->LinkCustomAttributes = "";
			$expenseslist->exp_cat->HrefValue = "";
			$expenseslist->exp_cat->TooltipValue = "";

			// exp_detail
			$expenseslist->exp_detail->LinkCustomAttributes = "";
			$expenseslist->exp_detail->HrefValue = "";
			$expenseslist->exp_detail->TooltipValue = "";

			// exp_total
			$expenseslist->exp_total->LinkCustomAttributes = "";
			$expenseslist->exp_total->HrefValue = "";
			$expenseslist->exp_total->TooltipValue = "";

			// exp_date
			$expenseslist->exp_date->LinkCustomAttributes = "";
			$expenseslist->exp_date->HrefValue = "";
			$expenseslist->exp_date->TooltipValue = "";

			// exp_dispencer
			$expenseslist->exp_dispencer->LinkCustomAttributes = "";
			$expenseslist->exp_dispencer->HrefValue = "";
			$expenseslist->exp_dispencer->TooltipValue = "";

			// exp_slipt_num
			$expenseslist->exp_slipt_num->LinkCustomAttributes = "";
			$expenseslist->exp_slipt_num->HrefValue = "";
			$expenseslist->exp_slipt_num->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($expenseslist->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expenseslist->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language, $expenseslist;

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
		$item->Body = "<a name=\"emf_expenseslist\" id=\"emf_expenseslist\" href=\"javascript:void(0);\" onclick=\"ew_EmailDialogShow({lnk:'emf_expenseslist',hdr:ewLanguage.Phrase('ExportToEmail'),key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false});\">" . $Language->Phrase("ExportToEmail") . "</a>";
		$item->Visible = FALSE;

		// Hide options for export/action
		if ($expenseslist->Export <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		global $expenseslist;
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $expenseslist->SelectRecordCount();
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
		if ($expenseslist->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->XmlDoc->formatOutput = TRUE; // Formatted output
		} else {
			$ExportDoc = new cExportDocument($expenseslist, "v");
		}
		$ParentTable = "";
		if ($bSelectLimit) {
			$StartRec = 1;
			$StopRec = $this->DisplayRecs;
		} else {
			$StartRec = $this->StartRec;
			$StopRec = $this->StopRec;
		}
		if ($expenseslist->Export == "xml") {
			$expenseslist->ExportXmlDocument($XmlDoc, ($ParentTable <> ""), $rs, $StartRec, $StopRec, "view");
		} else {
			$sHeader = $this->PageHeader;
			$this->Page_DataRendering($sHeader);
			$ExportDoc->Text .= $sHeader;
			$expenseslist->ExportDocument($ExportDoc, $rs, $StartRec, $StopRec, "view");
			$sFooter = $this->PageFooter;
			$this->Page_DataRendered($sFooter);
			$ExportDoc->Text .= $sFooter;
		}

		// Close recordset
		$rs->Close();

		// Export header and footer
		if ($expenseslist->Export <> "xml") {
			$ExportDoc->ExportHeaderAndFooter();
		}

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($expenseslist->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($expenseslist->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($expenseslist->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($expenseslist->ExportReturnUrl());
		} elseif ($expenseslist->Export == "pdf") {
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
