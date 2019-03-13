<?php include_once "administratorinfo.php" ?>
<?php

//
// Page class
//
class cmemberupdatelog_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'memberupdatelog';

	// Page object name
	var $PageObjName = 'memberupdatelog_grid';

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
	function cmemberupdatelog_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (memberupdatelog)
		if (!isset($GLOBALS["memberupdatelog"])) {
			$GLOBALS["memberupdatelog"] = new cmemberupdatelog();

//			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["memberupdatelog"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'memberupdatelog', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
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

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$memberupdatelog->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

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
		global $memberupdatelog;

//		$GLOBALS["Table"] =& $GLOBALS["MasterTable"];
		if ($url == "")
			return;

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $DisplayRecs = 100;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $RowCnt;
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $RestoreSearch;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $memberupdatelog;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterParms();

			// Hide all options
			if ($memberupdatelog->Export <> "" ||
				$memberupdatelog->CurrentAction == "gridadd" ||
				$memberupdatelog->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($memberupdatelog->AllowAddDeleteRow) {
				if ($memberupdatelog->CurrentAction == "gridadd" ||
					$memberupdatelog->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($memberupdatelog->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $memberupdatelog->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->DbMasterFilter = $memberupdatelog->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $memberupdatelog->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($memberupdatelog->getMasterFilter() <> "" && $memberupdatelog->getCurrentMasterTable() == "members") {
			global $members;
			$rsmaster = $members->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($memberupdatelog->getReturnUrl()); // Return to caller
			} else {
				$members->LoadListRowValues($rsmaster);
				$members->RowType = EW_ROWTYPE_MASTER; // Master row
				$members->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$memberupdatelog->setSessionWhere($sFilter);
		$memberupdatelog->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $memberupdatelog;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 100; // Non-numeric, load default
				}
			}
			$memberupdatelog->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$memberupdatelog->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $memberupdatelog;
		$memberupdatelog->LastAction = $memberupdatelog->CurrentAction; // Save last action
		$memberupdatelog->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $Language, $objForm, $gsFormError, $memberupdatelog;
		$bGridUpdate = TRUE;

		// Get old recordset
		$memberupdatelog->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $memberupdatelog->SQL();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$objForm->Index = $rowindex;
			$rowkey = strval($objForm->GetValue("k_key"));
			$rowaction = strval($objForm->GetValue("k_action"));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$bGridUpdate = $this->SetupKeyValues($rowkey); // Set up key values
				} else {
					$bGridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($bGridUpdate) {
					if ($rowaction == "delete") {
						$memberupdatelog->CurrentFilter = $memberupdatelog->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$memberupdatelog->SendEmail = FALSE; // Do not send email on update success
								$bGridUpdate = $this->EditRow(); // Update this row
							}
						} // End update
					}
				}
				if ($bGridUpdate) {
					if ($sKey <> "") $sKey .= ", ";
					$sKey .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($bGridUpdate) {

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$memberupdatelog->EventCancelled = TRUE; // Set event cancelled
			$memberupdatelog->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $memberupdatelog;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $memberupdatelog->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		global $memberupdatelog;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$memberupdatelog->mu_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($memberupdatelog->mu_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $memberupdatelog;
		$rowindex = 1;
		$bGridInsert = FALSE;

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$sKey = "";

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue("k_action"));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($objForm->GetValue("k_oldkey"));
				$this->LoadOldRecord(); // Load old recordset
			}
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$memberupdatelog->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $memberupdatelog->mu_id->CurrentValue;

					// Add filter for this record
					$sFilter = $memberupdatelog->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->ClearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($bGridInsert) {

			// Get new recordset
			$memberupdatelog->CurrentFilter = $sWrkFilter;
			$sSql = $memberupdatelog->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$memberupdatelog->EventCancelled = TRUE; // Set event cancelled
			$memberupdatelog->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $memberupdatelog, $objForm;
		if ($objForm->HasValue("x_update_detail") && $objForm->HasValue("o_update_detail") && $memberupdatelog->update_detail->CurrentValue <> $memberupdatelog->update_detail->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_update_date") && $objForm->HasValue("o_update_date") && $memberupdatelog->update_date->CurrentValue <> $memberupdatelog->update_date->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_author") && $objForm->HasValue("o_author") && $memberupdatelog->author->CurrentValue <> $memberupdatelog->author->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue("k_action"));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $memberupdatelog;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $memberupdatelog;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$memberupdatelog->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$memberupdatelog->CurrentOrderType = @$_GET["ordertype"];
			$memberupdatelog->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $memberupdatelog;
		$sOrderBy = $memberupdatelog->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($memberupdatelog->SqlOrderBy() <> "") {
				$sOrderBy = $memberupdatelog->SqlOrderBy();
				$memberupdatelog->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $memberupdatelog;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$memberupdatelog->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$memberupdatelog->member_code->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$memberupdatelog->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$memberupdatelog->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $memberupdatelog;

		// "griddelete"
		if ($memberupdatelog->AllowAddDeleteRow) {
			$item =& $this->ListOptions->Add("griddelete");
			$item->CssStyle = "white-space: nowrap;";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $memberupdatelog, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if (is_numeric($this->RowIndex)) {
			$objForm->Index = $this->RowIndex;
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_action\" id=\"k" . $this->RowIndex . "_action\" value=\"" . $this->RowAction . "\">";
			if ($objForm->HasValue("k_oldkey"))
				$this->RowOldKey = strval($objForm->GetValue("k_oldkey"));
			if ($this->RowOldKey <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_oldkey\" id=\"k" . $this->RowIndex . "_oldkey\" value=\"" . ew_HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue("k_key");
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $memberupdatelog->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_blankrow\" id=\"k" . $this->RowIndex . "_blankrow\" value=\"1\">";
		}

		// "delete"
		if ($memberupdatelog->AllowAddDeleteRow) {
			if ($memberupdatelog->CurrentMode == "add" || $memberupdatelog->CurrentMode == "copy" || $memberupdatelog->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, memberupdatelog_grid, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}
		if ($memberupdatelog->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $memberupdatelog->mu_id->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs->fields('mu_id');
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $memberupdatelog;
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

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $memberupdatelog;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $memberupdatelog;
		$memberupdatelog->update_detail->CurrentValue = NULL;
		$memberupdatelog->update_detail->OldValue = $memberupdatelog->update_detail->CurrentValue;
		$memberupdatelog->update_date->CurrentValue = NULL;
		$memberupdatelog->update_date->OldValue = $memberupdatelog->update_date->CurrentValue;
		$memberupdatelog->author->CurrentValue = NULL;
		$memberupdatelog->author->OldValue = $memberupdatelog->author->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $memberupdatelog;
		if (!$memberupdatelog->update_detail->FldIsDetailKey) {
			$memberupdatelog->update_detail->setFormValue($objForm->GetValue("x_update_detail"));
		}
		$memberupdatelog->update_detail->setOldValue($objForm->GetValue("o_update_detail"));
		if (!$memberupdatelog->update_date->FldIsDetailKey) {
			$memberupdatelog->update_date->setFormValue($objForm->GetValue("x_update_date"));
			$memberupdatelog->update_date->CurrentValue = ew_UnFormatDateTime($memberupdatelog->update_date->CurrentValue, 7);
		}
		$memberupdatelog->update_date->setOldValue($objForm->GetValue("o_update_date"));
		if (!$memberupdatelog->author->FldIsDetailKey) {
			$memberupdatelog->author->setFormValue($objForm->GetValue("x_author"));
		}
		$memberupdatelog->author->setOldValue($objForm->GetValue("o_author"));
		if (!$memberupdatelog->mu_id->FldIsDetailKey && $memberupdatelog->CurrentAction <> "gridadd" && $memberupdatelog->CurrentAction <> "add")
			$memberupdatelog->mu_id->setFormValue($objForm->GetValue("x_mu_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $memberupdatelog;
		if ($memberupdatelog->CurrentAction <> "gridadd" && $memberupdatelog->CurrentAction <> "add")
			$memberupdatelog->mu_id->CurrentValue = $memberupdatelog->mu_id->FormValue;
		$memberupdatelog->update_detail->CurrentValue = $memberupdatelog->update_detail->FormValue;
		$memberupdatelog->update_date->CurrentValue = $memberupdatelog->update_date->FormValue;
		$memberupdatelog->update_date->CurrentValue = ew_UnFormatDateTime($memberupdatelog->update_date->CurrentValue, 7);
		$memberupdatelog->author->CurrentValue = $memberupdatelog->author->FormValue;
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

	// Load old record
	function LoadOldRecord() {
		global $memberupdatelog;

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$memberupdatelog->mu_id->CurrentValue = strval($arKeys[0]); // mu_id
			else
				$bValidKey = FALSE;
		} else {
			$bValidKey = FALSE;
		}

		// Load old recordset
		if ($bValidKey) {
			$memberupdatelog->CurrentFilter = $memberupdatelog->KeyFilter();
			$sSql = $memberupdatelog->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $memberupdatelog;

		// Initialize URLs
		// Call Row_Rendering event

		$memberupdatelog->Row_Rendering();

		// Common render codes for all row types
		// mu_id

		$memberupdatelog->mu_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		$memberupdatelog->member_code->CellCssStyle = "white-space: nowrap;";

		// update_detail
		$memberupdatelog->update_detail->CellCssStyle = "white-space: nowrap;";

		// update_date
		$memberupdatelog->update_date->CellCssStyle = "white-space: nowrap;";

		// author
		$memberupdatelog->author->CellCssStyle = "white-space: nowrap;";
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
		} elseif ($memberupdatelog->RowType == EW_ROWTYPE_ADD) { // Add row

			// update_detail
			$memberupdatelog->update_detail->EditCustomAttributes = "";
			$memberupdatelog->update_detail->EditValue = ew_HtmlEncode($memberupdatelog->update_detail->CurrentValue);

			// update_date
			$memberupdatelog->update_date->EditCustomAttributes = "";
			$memberupdatelog->update_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($memberupdatelog->update_date->CurrentValue, 7));

			// author
			$memberupdatelog->author->EditCustomAttributes = "";
			$memberupdatelog->author->EditValue = ew_HtmlEncode($memberupdatelog->author->CurrentValue);

			// Edit refer script
			// update_detail

			$memberupdatelog->update_detail->HrefValue = "";

			// update_date
			$memberupdatelog->update_date->HrefValue = "";

			// author
			$memberupdatelog->author->HrefValue = "";
		} elseif ($memberupdatelog->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// update_detail
			$memberupdatelog->update_detail->EditCustomAttributes = "";
			$memberupdatelog->update_detail->EditValue = ew_HtmlEncode($memberupdatelog->update_detail->CurrentValue);

			// update_date
			$memberupdatelog->update_date->EditCustomAttributes = "";
			$memberupdatelog->update_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($memberupdatelog->update_date->CurrentValue, 7));

			// author
			$memberupdatelog->author->EditCustomAttributes = "";
			$memberupdatelog->author->EditValue = ew_HtmlEncode($memberupdatelog->author->CurrentValue);

			// Edit refer script
			// update_detail

			$memberupdatelog->update_detail->HrefValue = "";

			// update_date
			$memberupdatelog->update_date->HrefValue = "";

			// author
			$memberupdatelog->author->HrefValue = "";
		}
		if ($memberupdatelog->RowType == EW_ROWTYPE_ADD ||
			$memberupdatelog->RowType == EW_ROWTYPE_EDIT ||
			$memberupdatelog->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$memberupdatelog->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($memberupdatelog->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$memberupdatelog->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $memberupdatelog;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($memberupdatelog->update_detail->FormValue) && $memberupdatelog->update_detail->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $memberupdatelog->update_detail->FldCaption());
		}
		if (!is_null($memberupdatelog->update_date->FormValue) && $memberupdatelog->update_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $memberupdatelog->update_date->FldCaption());
		}
		if (!ew_CheckEuroDate($memberupdatelog->update_date->FormValue)) {
			ew_AddMessage($gsFormError, $memberupdatelog->update_date->FldErrMsg());
		}
		if (!is_null($memberupdatelog->author->FormValue) && $memberupdatelog->author->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $memberupdatelog->author->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $memberupdatelog;
		$DeleteRows = TRUE;
		$sSql = $memberupdatelog->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $memberupdatelog->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['mu_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($memberupdatelog->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($memberupdatelog->CancelMessage <> "") {
				$this->setFailureMessage($memberupdatelog->CancelMessage);
				$memberupdatelog->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$memberupdatelog->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $memberupdatelog;
		$sFilter = $memberupdatelog->KeyFilter();
		$memberupdatelog->CurrentFilter = $sFilter;
		$sSql = $memberupdatelog->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// update_detail
			$memberupdatelog->update_detail->SetDbValueDef($rsnew, $memberupdatelog->update_detail->CurrentValue, "", $memberupdatelog->update_detail->ReadOnly);

			// update_date
			$memberupdatelog->update_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($memberupdatelog->update_date->CurrentValue, 7), ew_CurrentDate(), $memberupdatelog->update_date->ReadOnly);

			// author
			$memberupdatelog->author->SetDbValueDef($rsnew, $memberupdatelog->author->CurrentValue, "", $memberupdatelog->author->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $memberupdatelog->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($memberupdatelog->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($memberupdatelog->CancelMessage <> "") {
					$this->setFailureMessage($memberupdatelog->CancelMessage);
					$memberupdatelog->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$memberupdatelog->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $memberupdatelog;

		// Set up foreign key field value from Session
			if ($memberupdatelog->getCurrentMasterTable() == "members") {
				$memberupdatelog->member_code->CurrentValue = $memberupdatelog->member_code->getSessionValue();
			}
		$rsnew = array();

		// update_detail
		$memberupdatelog->update_detail->SetDbValueDef($rsnew, $memberupdatelog->update_detail->CurrentValue, "", FALSE);

		// update_date
		$memberupdatelog->update_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($memberupdatelog->update_date->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// author
		$memberupdatelog->author->SetDbValueDef($rsnew, $memberupdatelog->author->CurrentValue, "", FALSE);

		// member_code
		if ($memberupdatelog->member_code->getSessionValue() <> "") {
			$rsnew['member_code'] = $memberupdatelog->member_code->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $memberupdatelog->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($memberupdatelog->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($memberupdatelog->CancelMessage <> "") {
				$this->setFailureMessage($memberupdatelog->CancelMessage);
				$memberupdatelog->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$memberupdatelog->mu_id->setDbValue($conn->Insert_ID());
			$rsnew['mu_id'] = $memberupdatelog->mu_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$memberupdatelog->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $memberupdatelog;

		// Hide foreign keys
		$sMasterTblVar = $memberupdatelog->getCurrentMasterTable();
		if ($sMasterTblVar == "members") {
			$memberupdatelog->member_code->Visible = FALSE;
			if ($GLOBALS["members"]->EventCancelled) $memberupdatelog->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $memberupdatelog->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $memberupdatelog->getDetailFilter(); // Get detail filter
	}

	// Export PDF
	function ExportPDF($html) {
		global $gsExportFile;
		include_once "dompdf060b2/dompdf_config.inc.php";
		@ini_set("memory_limit", EW_PDF_MEMORY_LIMIT);
		set_time_limit(EW_PDF_TIME_LIMIT);
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->set_paper("", "");
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt =& $this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
