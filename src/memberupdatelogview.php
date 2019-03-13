<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "memberupdateloginfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "membersinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$memberupdatelog_view = new cmemberupdatelog_view();
$Page =& $memberupdatelog_view;

// Page init
$memberupdatelog_view->Page_Init();

// Page main
$memberupdatelog_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($memberupdatelog->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var memberupdatelog_view = new ew_Page("memberupdatelog_view");

// page properties
memberupdatelog_view.PageID = "view"; // page ID
memberupdatelog_view.FormID = "fmemberupdatelogview"; // form ID
var EW_PAGE_ID = memberupdatelog_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
memberupdatelog_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
memberupdatelog_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
memberupdatelog_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memberupdatelog_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<p class="phpmaker ewTitle"><img src="images/ico_edit_member.png" width="55" height="55" align="absmiddle" />&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?>บันทึกการแก้ไขข้อมูล
&nbsp;&nbsp;<?php $memberupdatelog_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($memberupdatelog->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $memberupdatelog_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php } ?>
</p>
<?php $memberupdatelog_view->ShowPageHeader(); ?>
<?php
$memberupdatelog_view->ShowMessage();
?>
<p>
<?php if ($memberupdatelog->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($memberupdatelog_view->Pager)) $memberupdatelog_view->Pager = new cPrevNextPager($memberupdatelog_view->StartRec, $memberupdatelog_view->DisplayRecs, $memberupdatelog_view->TotalRecs) ?>
<?php if ($memberupdatelog_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($memberupdatelog_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_view->PageUrl() ?>start=<?php echo $memberupdatelog_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($memberupdatelog_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_view->PageUrl() ?>start=<?php echo $memberupdatelog_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $memberupdatelog_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($memberupdatelog_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_view->PageUrl() ?>start=<?php echo $memberupdatelog_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($memberupdatelog_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_view->PageUrl() ?>start=<?php echo $memberupdatelog_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $memberupdatelog_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($memberupdatelog_view->SearchWhere == "0=101") { ?>
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
<?php if ($memberupdatelog->update_detail->Visible) { // update_detail ?>
	<tr id="r_update_detail"<?php echo $memberupdatelog->RowAttributes() ?>>
		<td width="170" class="ewTableHeader"><?php echo $memberupdatelog->update_detail->FldCaption() ?></td>
		<td<?php echo $memberupdatelog->update_detail->CellAttributes() ?>>
<div<?php echo $memberupdatelog->update_detail->ViewAttributes() ?>><?php echo $memberupdatelog->update_detail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($memberupdatelog->update_date->Visible) { // update_date ?>
	<tr id="r_update_date"<?php echo $memberupdatelog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memberupdatelog->update_date->FldCaption() ?></td>
		<td<?php echo $memberupdatelog->update_date->CellAttributes() ?>>
<div<?php echo $memberupdatelog->update_date->ViewAttributes() ?>><?php echo $memberupdatelog->update_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($memberupdatelog->author->Visible) { // author ?>
	<tr id="r_author"<?php echo $memberupdatelog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memberupdatelog->author->FldCaption() ?></td>
		<td<?php echo $memberupdatelog->author->CellAttributes() ?>>
<div<?php echo $memberupdatelog->author->ViewAttributes() ?>><?php echo $memberupdatelog->author->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($memberupdatelog->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($memberupdatelog_view->Pager)) $memberupdatelog_view->Pager = new cPrevNextPager($memberupdatelog_view->StartRec, $memberupdatelog_view->DisplayRecs, $memberupdatelog_view->TotalRecs) ?>
<?php if ($memberupdatelog_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($memberupdatelog_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_view->PageUrl() ?>start=<?php echo $memberupdatelog_view->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($memberupdatelog_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_view->PageUrl() ?>start=<?php echo $memberupdatelog_view->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $memberupdatelog_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($memberupdatelog_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_view->PageUrl() ?>start=<?php echo $memberupdatelog_view->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($memberupdatelog_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $memberupdatelog_view->PageUrl() ?>start=<?php echo $memberupdatelog_view->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $memberupdatelog_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($memberupdatelog_view->SearchWhere == "0=101") { ?>
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
$memberupdatelog_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($memberupdatelog->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$memberupdatelog_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cmemberupdatelog_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'memberupdatelog';

	// Page object name
	var $PageObjName = 'memberupdatelog_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $memberupdatelog;
		if ($memberupdatelog->UseTokenInUrl) $PageUrl .= "t=" . $memberupdatelog->TableVar . "&"; // Add page token
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
		global $objForm, $memberupdatelog;
		if ($memberupdatelog->UseTokenInUrl) {
			if ($objForm)
				return ($memberupdatelog->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($memberupdatelog->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmemberupdatelog_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (memberupdatelog)
		if (!isset($GLOBALS["memberupdatelog"])) {
			$GLOBALS["memberupdatelog"] = new cmemberupdatelog();
			$GLOBALS["Table"] =& $GLOBALS["memberupdatelog"];
		}
		$KeyUrl = "";
		if (@$_GET["mu_id"] <> "") {
			$this->RecKey["mu_id"] = $_GET["mu_id"];
			$KeyUrl .= "&mu_id=" . urlencode($this->RecKey["mu_id"]);
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

		// Table object (members)
		if (!isset($GLOBALS['members'])) $GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'memberupdatelog', TRUE);

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
		global $memberupdatelog;

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
		global $Language, $memberupdatelog;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["mu_id"] <> "") {
				$memberupdatelog->mu_id->setQueryStringValue($_GET["mu_id"]);
				$this->RecKey["mu_id"] = $memberupdatelog->mu_id->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$memberupdatelog->CurrentAction = "I"; // Display form
			switch ($memberupdatelog->CurrentAction) {
				case "I": // Get a record to display
					$this->StartRec = 1; // Initialize start position
					if ($this->Recordset = $this->LoadRecordset()) // Load records
						$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecs <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("memberupdateloglist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($memberupdatelog->mu_id->CurrentValue) == strval($this->Recordset->fields('mu_id'))) {
								$memberupdatelog->setStartRecordNumber($this->StartRec); // Save record position
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
						$sReturnUrl = "memberupdateloglist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}
		} else {
			$sReturnUrl = "memberupdateloglist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$memberupdatelog->RowType = EW_ROWTYPE_VIEW;
		$memberupdatelog->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $memberupdatelog;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$memberupdatelog->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$memberupdatelog->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $memberupdatelog->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$memberupdatelog->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$memberupdatelog->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$memberupdatelog->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $memberupdatelog;

		// Call Recordset Selecting event
		$memberupdatelog->Recordset_Selecting($memberupdatelog->CurrentFilter);

		// Load List page SQL
		$sSql = $memberupdatelog->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$memberupdatelog->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $memberupdatelog;
		$sFilter = $memberupdatelog->KeyFilter();

		// Call Row Selecting event
		$memberupdatelog->Row_Selecting($sFilter);

		// Load SQL based on filter
		$memberupdatelog->CurrentFilter = $sFilter;
		$sSql = $memberupdatelog->SQL();
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
		global $conn, $memberupdatelog;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$memberupdatelog->Row_Selected($row);
		$memberupdatelog->mu_id->setDbValue($rs->fields('mu_id'));
		$memberupdatelog->member_code->setDbValue($rs->fields('member_code'));
		$memberupdatelog->update_detail->setDbValue($rs->fields('update_detail'));
		$memberupdatelog->update_date->setDbValue($rs->fields('update_date'));
		$memberupdatelog->author->setDbValue($rs->fields('author'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $memberupdatelog;

		// Initialize URLs
		$this->AddUrl = $memberupdatelog->AddUrl();
		$this->EditUrl = $memberupdatelog->EditUrl();
		$this->CopyUrl = $memberupdatelog->CopyUrl();
		$this->DeleteUrl = $memberupdatelog->DeleteUrl();
		$this->ListUrl = $memberupdatelog->ListUrl();

		// Call Row_Rendering event
		$memberupdatelog->Row_Rendering();

		// Common render codes for all row types
		// mu_id
		// member_code
		// update_detail
		// update_date
		// author

		if ($memberupdatelog->RowType == EW_ROWTYPE_VIEW) { // View row

			// update_detail
			$memberupdatelog->update_detail->ViewValue = $memberupdatelog->update_detail->CurrentValue;
			$memberupdatelog->update_detail->ViewCustomAttributes = "";

			// update_date
			$memberupdatelog->update_date->ViewValue = $memberupdatelog->update_date->CurrentValue;
			$memberupdatelog->update_date->ViewValue = ew_FormatDateTime($memberupdatelog->update_date->ViewValue, 7);
			$memberupdatelog->update_date->ViewCustomAttributes = "";

			// author
			$memberupdatelog->author->ViewValue = $memberupdatelog->author->CurrentValue;
			$memberupdatelog->author->ViewCustomAttributes = "";

			// update_detail
			$memberupdatelog->update_detail->LinkCustomAttributes = "";
			$memberupdatelog->update_detail->HrefValue = "";
			$memberupdatelog->update_detail->TooltipValue = "";

			// update_date
			$memberupdatelog->update_date->LinkCustomAttributes = "";
			$memberupdatelog->update_date->HrefValue = "";
			$memberupdatelog->update_date->TooltipValue = "";

			// author
			$memberupdatelog->author->LinkCustomAttributes = "";
			$memberupdatelog->author->HrefValue = "";
			$memberupdatelog->author->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($memberupdatelog->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$memberupdatelog->Row_Rendered();
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
