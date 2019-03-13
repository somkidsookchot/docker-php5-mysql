<?php include_once "administratorinfo.php" ?>
<?php

//
// Page class
//
class cexpenseslist_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'expenseslist';

	// Page object name
	var $PageObjName = 'expenseslist_grid';

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
	function cexpenseslist_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (expenseslist)
		if (!isset($GLOBALS["expenseslist"])) {
			$GLOBALS["expenseslist"] = new cexpenseslist();

//			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["expenseslist"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expenseslist', TRUE);

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
		global $expenseslist;

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
			$expenseslist->GridAddRowCount = $gridaddcnt;

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
		global $expenseslist;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $expenseslist;

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
			if ($expenseslist->Export <> "" ||
				$expenseslist->CurrentAction == "gridadd" ||
				$expenseslist->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($expenseslist->AllowAddDeleteRow) {
				if ($expenseslist->CurrentAction == "gridadd" ||
					$expenseslist->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($expenseslist->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $expenseslist->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->DbMasterFilter = $expenseslist->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $expenseslist->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($expenseslist->getMasterFilter() <> "" && $expenseslist->getCurrentMasterTable() == "expensescategory") {
			global $expensescategory;
			$rsmaster = $expensescategory->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($expenseslist->getReturnUrl()); // Return to caller
			} else {
				$expensescategory->LoadListRowValues($rsmaster);
				$expensescategory->RowType = EW_ROWTYPE_MASTER; // Master row
				$expensescategory->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$expenseslist->setSessionWhere($sFilter);
		$expenseslist->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $expenseslist;
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
			$expenseslist->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$expenseslist->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $expenseslist;
		$expenseslist->LastAction = $expenseslist->CurrentAction; // Save last action
		$expenseslist->CurrentAction = ""; // Clear action
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
		global $conn, $Language, $objForm, $gsFormError, $expenseslist;
		$bGridUpdate = TRUE;

		// Get old recordset
		$expenseslist->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $expenseslist->SQL();
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
						$expenseslist->CurrentFilter = $expenseslist->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$expenseslist->SendEmail = FALSE; // Do not send email on update success
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
			$expenseslist->EventCancelled = TRUE; // Set event cancelled
			$expenseslist->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $expenseslist;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $expenseslist->KeyFilter();
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
		global $expenseslist;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$expenseslist->exp_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($expenseslist->exp_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $expenseslist;
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
				$expenseslist->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $expenseslist->exp_id->CurrentValue;

					// Add filter for this record
					$sFilter = $expenseslist->KeyFilter();
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
			$expenseslist->CurrentFilter = $sWrkFilter;
			$sSql = $expenseslist->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$expenseslist->EventCancelled = TRUE; // Set event cancelled
			$expenseslist->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $expenseslist, $objForm;
		if ($objForm->HasValue("x_exp_cat") && $objForm->HasValue("o_exp_cat") && $expenseslist->exp_cat->CurrentValue <> $expenseslist->exp_cat->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_exp_total") && $objForm->HasValue("o_exp_total") && $expenseslist->exp_total->CurrentValue <> $expenseslist->exp_total->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_exp_date") && $objForm->HasValue("o_exp_date") && $expenseslist->exp_date->CurrentValue <> $expenseslist->exp_date->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_exp_dispencer") && $objForm->HasValue("o_exp_dispencer") && $expenseslist->exp_dispencer->CurrentValue <> $expenseslist->exp_dispencer->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_exp_slipt_num") && $objForm->HasValue("o_exp_slipt_num") && $expenseslist->exp_slipt_num->CurrentValue <> $expenseslist->exp_slipt_num->OldValue)
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
		global $objForm, $expenseslist;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $expenseslist;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$expenseslist->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$expenseslist->CurrentOrderType = @$_GET["ordertype"];
			$expenseslist->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $expenseslist;
		$sOrderBy = $expenseslist->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($expenseslist->SqlOrderBy() <> "") {
				$sOrderBy = $expenseslist->SqlOrderBy();
				$expenseslist->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $expenseslist;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$expenseslist->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$expenseslist->exp_cat->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$expenseslist->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$expenseslist->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $expenseslist;

		// "griddelete"
		if ($expenseslist->AllowAddDeleteRow) {
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
		global $Security, $Language, $expenseslist, $objForm;
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
			if ($this->RowAction == "insert" && $expenseslist->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_blankrow\" id=\"k" . $this->RowIndex . "_blankrow\" value=\"1\">";
		}

		// "delete"
		if ($expenseslist->AllowAddDeleteRow) {
			if ($expenseslist->CurrentMode == "add" || $expenseslist->CurrentMode == "copy" || $expenseslist->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, expenseslist_grid, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
			}
		}
		if ($expenseslist->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $expenseslist->exp_id->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs->fields('exp_id');
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $expenseslist;
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

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $expenseslist;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $expenseslist;
		$expenseslist->exp_cat->CurrentValue = NULL;
		$expenseslist->exp_cat->OldValue = $expenseslist->exp_cat->CurrentValue;
		$expenseslist->exp_total->CurrentValue = NULL;
		$expenseslist->exp_total->OldValue = $expenseslist->exp_total->CurrentValue;
		$expenseslist->exp_date->CurrentValue = NULL;
		$expenseslist->exp_date->OldValue = $expenseslist->exp_date->CurrentValue;
		$expenseslist->exp_dispencer->CurrentValue = NULL;
		$expenseslist->exp_dispencer->OldValue = $expenseslist->exp_dispencer->CurrentValue;
		$expenseslist->exp_slipt_num->CurrentValue = NULL;
		$expenseslist->exp_slipt_num->OldValue = $expenseslist->exp_slipt_num->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $expenseslist;
		if (!$expenseslist->exp_cat->FldIsDetailKey) {
			$expenseslist->exp_cat->setFormValue($objForm->GetValue("x_exp_cat"));
		}
		$expenseslist->exp_cat->setOldValue($objForm->GetValue("o_exp_cat"));
		if (!$expenseslist->exp_total->FldIsDetailKey) {
			$expenseslist->exp_total->setFormValue($objForm->GetValue("x_exp_total"));
		}
		$expenseslist->exp_total->setOldValue($objForm->GetValue("o_exp_total"));
		if (!$expenseslist->exp_date->FldIsDetailKey) {
			$expenseslist->exp_date->setFormValue($objForm->GetValue("x_exp_date"));
			$expenseslist->exp_date->CurrentValue = ew_UnFormatDateTime($expenseslist->exp_date->CurrentValue, 7);
		}
		$expenseslist->exp_date->setOldValue($objForm->GetValue("o_exp_date"));
		if (!$expenseslist->exp_dispencer->FldIsDetailKey) {
			$expenseslist->exp_dispencer->setFormValue($objForm->GetValue("x_exp_dispencer"));
		}
		$expenseslist->exp_dispencer->setOldValue($objForm->GetValue("o_exp_dispencer"));
		if (!$expenseslist->exp_slipt_num->FldIsDetailKey) {
			$expenseslist->exp_slipt_num->setFormValue($objForm->GetValue("x_exp_slipt_num"));
		}
		$expenseslist->exp_slipt_num->setOldValue($objForm->GetValue("o_exp_slipt_num"));
		if (!$expenseslist->exp_id->FldIsDetailKey && $expenseslist->CurrentAction <> "gridadd" && $expenseslist->CurrentAction <> "add")
			$expenseslist->exp_id->setFormValue($objForm->GetValue("x_exp_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $expenseslist;
		if ($expenseslist->CurrentAction <> "gridadd" && $expenseslist->CurrentAction <> "add")
			$expenseslist->exp_id->CurrentValue = $expenseslist->exp_id->FormValue;
		$expenseslist->exp_cat->CurrentValue = $expenseslist->exp_cat->FormValue;
		$expenseslist->exp_total->CurrentValue = $expenseslist->exp_total->FormValue;
		$expenseslist->exp_date->CurrentValue = $expenseslist->exp_date->FormValue;
		$expenseslist->exp_date->CurrentValue = ew_UnFormatDateTime($expenseslist->exp_date->CurrentValue, 7);
		$expenseslist->exp_dispencer->CurrentValue = $expenseslist->exp_dispencer->FormValue;
		$expenseslist->exp_slipt_num->CurrentValue = $expenseslist->exp_slipt_num->FormValue;
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

	// Load old record
	function LoadOldRecord() {
		global $expenseslist;

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$expenseslist->exp_id->CurrentValue = strval($arKeys[0]); // exp_id
			else
				$bValidKey = FALSE;
		} else {
			$bValidKey = FALSE;
		}

		// Load old recordset
		if ($bValidKey) {
			$expenseslist->CurrentFilter = $expenseslist->KeyFilter();
			$sSql = $expenseslist->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expenseslist;

		// Initialize URLs
		// Call Row_Rendering event

		$expenseslist->Row_Rendering();

		// Common render codes for all row types
		// exp_id

		$expenseslist->exp_id->CellCssStyle = "white-space: nowrap;";

		// exp_cat
		$expenseslist->exp_cat->CellCssStyle = "white-space: nowrap;";

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
		} elseif ($expenseslist->RowType == EW_ROWTYPE_ADD) { // Add row

			// exp_cat
			$expenseslist->exp_cat->EditCustomAttributes = "";
			if ($expenseslist->exp_cat->getSessionValue() <> "") {
				$expenseslist->exp_cat->CurrentValue = $expenseslist->exp_cat->getSessionValue();
				$expenseslist->exp_cat->OldValue = $expenseslist->exp_cat->CurrentValue;
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
			} else {
			}

			// exp_total
			$expenseslist->exp_total->EditCustomAttributes = "";
			$expenseslist->exp_total->EditValue = ew_HtmlEncode($expenseslist->exp_total->CurrentValue);

			// exp_date
			$expenseslist->exp_date->EditCustomAttributes = "";
			$expenseslist->exp_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($expenseslist->exp_date->CurrentValue, 7));

			// exp_dispencer
			$expenseslist->exp_dispencer->EditCustomAttributes = "";
			$expenseslist->exp_dispencer->EditValue = ew_HtmlEncode($expenseslist->exp_dispencer->CurrentValue);

			// exp_slipt_num
			$expenseslist->exp_slipt_num->EditCustomAttributes = "";
			$expenseslist->exp_slipt_num->EditValue = ew_HtmlEncode($expenseslist->exp_slipt_num->CurrentValue);

			// Edit refer script
			// exp_cat

			$expenseslist->exp_cat->HrefValue = "";

			// exp_total
			$expenseslist->exp_total->HrefValue = "";

			// exp_date
			$expenseslist->exp_date->HrefValue = "";

			// exp_dispencer
			$expenseslist->exp_dispencer->HrefValue = "";

			// exp_slipt_num
			$expenseslist->exp_slipt_num->HrefValue = "";
		} elseif ($expenseslist->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// exp_cat
			$expenseslist->exp_cat->EditCustomAttributes = "";
			if ($expenseslist->exp_cat->getSessionValue() <> "") {
				$expenseslist->exp_cat->CurrentValue = $expenseslist->exp_cat->getSessionValue();
				$expenseslist->exp_cat->OldValue = $expenseslist->exp_cat->CurrentValue;
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
			} else {
			}

			// exp_total
			$expenseslist->exp_total->EditCustomAttributes = "";
			$expenseslist->exp_total->EditValue = ew_HtmlEncode($expenseslist->exp_total->CurrentValue);

			// exp_date
			$expenseslist->exp_date->EditCustomAttributes = "";
			$expenseslist->exp_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($expenseslist->exp_date->CurrentValue, 7));

			// exp_dispencer
			$expenseslist->exp_dispencer->EditCustomAttributes = "";
			$expenseslist->exp_dispencer->EditValue = ew_HtmlEncode($expenseslist->exp_dispencer->CurrentValue);

			// exp_slipt_num
			$expenseslist->exp_slipt_num->EditCustomAttributes = "";
			$expenseslist->exp_slipt_num->EditValue = ew_HtmlEncode($expenseslist->exp_slipt_num->CurrentValue);

			// Edit refer script
			// exp_cat

			$expenseslist->exp_cat->HrefValue = "";

			// exp_total
			$expenseslist->exp_total->HrefValue = "";

			// exp_date
			$expenseslist->exp_date->HrefValue = "";

			// exp_dispencer
			$expenseslist->exp_dispencer->HrefValue = "";

			// exp_slipt_num
			$expenseslist->exp_slipt_num->HrefValue = "";
		}
		if ($expenseslist->RowType == EW_ROWTYPE_ADD ||
			$expenseslist->RowType == EW_ROWTYPE_EDIT ||
			$expenseslist->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$expenseslist->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($expenseslist->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expenseslist->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $expenseslist;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($expenseslist->exp_cat->FormValue) && $expenseslist->exp_cat->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expenseslist->exp_cat->FldCaption());
		}
		if (!is_null($expenseslist->exp_total->FormValue) && $expenseslist->exp_total->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expenseslist->exp_total->FldCaption());
		}
		if (!ew_CheckNumber($expenseslist->exp_total->FormValue)) {
			ew_AddMessage($gsFormError, $expenseslist->exp_total->FldErrMsg());
		}
		if (!is_null($expenseslist->exp_date->FormValue) && $expenseslist->exp_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expenseslist->exp_date->FldCaption());
		}
		if (!ew_CheckEuroDate($expenseslist->exp_date->FormValue)) {
			ew_AddMessage($gsFormError, $expenseslist->exp_date->FldErrMsg());
		}
		if (!is_null($expenseslist->exp_dispencer->FormValue) && $expenseslist->exp_dispencer->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expenseslist->exp_dispencer->FldCaption());
		}
		if (!is_null($expenseslist->exp_slipt_num->FormValue) && $expenseslist->exp_slipt_num->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expenseslist->exp_slipt_num->FldCaption());
		}
		if (!ew_CheckInteger($expenseslist->exp_slipt_num->FormValue)) {
			ew_AddMessage($gsFormError, $expenseslist->exp_slipt_num->FldErrMsg());
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
		global $conn, $Language, $Security, $expenseslist;
		$DeleteRows = TRUE;
		$sSql = $expenseslist->SQL();
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
				$DeleteRows = $expenseslist->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['exp_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($expenseslist->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($expenseslist->CancelMessage <> "") {
				$this->setFailureMessage($expenseslist->CancelMessage);
				$expenseslist->CancelMessage = "";
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
				$expenseslist->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $expenseslist;
		$sFilter = $expenseslist->KeyFilter();
		$expenseslist->CurrentFilter = $sFilter;
		$sSql = $expenseslist->SQL();
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

			// exp_cat
			$expenseslist->exp_cat->SetDbValueDef($rsnew, $expenseslist->exp_cat->CurrentValue, 0, $expenseslist->exp_cat->ReadOnly);

			// exp_total
			$expenseslist->exp_total->SetDbValueDef($rsnew, $expenseslist->exp_total->CurrentValue, 0, $expenseslist->exp_total->ReadOnly);

			// exp_date
			$expenseslist->exp_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($expenseslist->exp_date->CurrentValue, 7), ew_CurrentDate(), $expenseslist->exp_date->ReadOnly);

			// exp_dispencer
			$expenseslist->exp_dispencer->SetDbValueDef($rsnew, $expenseslist->exp_dispencer->CurrentValue, "", $expenseslist->exp_dispencer->ReadOnly);

			// exp_slipt_num
			$expenseslist->exp_slipt_num->SetDbValueDef($rsnew, $expenseslist->exp_slipt_num->CurrentValue, "", $expenseslist->exp_slipt_num->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $expenseslist->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($expenseslist->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($expenseslist->CancelMessage <> "") {
					$this->setFailureMessage($expenseslist->CancelMessage);
					$expenseslist->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$expenseslist->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $expenseslist;

		// Set up foreign key field value from Session
			if ($expenseslist->getCurrentMasterTable() == "expensescategory") {
				$expenseslist->exp_cat->CurrentValue = $expenseslist->exp_cat->getSessionValue();
			}
		$rsnew = array();

		// exp_cat
		$expenseslist->exp_cat->SetDbValueDef($rsnew, $expenseslist->exp_cat->CurrentValue, 0, FALSE);

		// exp_total
		$expenseslist->exp_total->SetDbValueDef($rsnew, $expenseslist->exp_total->CurrentValue, 0, FALSE);

		// exp_date
		$expenseslist->exp_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($expenseslist->exp_date->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// exp_dispencer
		$expenseslist->exp_dispencer->SetDbValueDef($rsnew, $expenseslist->exp_dispencer->CurrentValue, "", FALSE);

		// exp_slipt_num
		$expenseslist->exp_slipt_num->SetDbValueDef($rsnew, $expenseslist->exp_slipt_num->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $expenseslist->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($expenseslist->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($expenseslist->CancelMessage <> "") {
				$this->setFailureMessage($expenseslist->CancelMessage);
				$expenseslist->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$expenseslist->exp_id->setDbValue($conn->Insert_ID());
			$rsnew['exp_id'] = $expenseslist->exp_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$expenseslist->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $expenseslist;

		// Hide foreign keys
		$sMasterTblVar = $expenseslist->getCurrentMasterTable();
		if ($sMasterTblVar == "expensescategory") {
			$expenseslist->exp_cat->Visible = FALSE;
			if ($GLOBALS["expensescategory"]->EventCancelled) $expenseslist->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $expenseslist->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $expenseslist->getDetailFilter(); // Get detail filter
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
