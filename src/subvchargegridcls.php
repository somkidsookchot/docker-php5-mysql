<?php include_once "administratorinfo.php" ?>
<?php

//
// Page class
//
class csubvcharge_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'subvcharge';

	// Page object name
	var $PageObjName = 'subvcharge_grid';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subvcharge;
		if ($subvcharge->UseTokenInUrl) $PageUrl .= "t=" . $subvcharge->TableVar . "&"; // Add page token
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
		global $objForm, $subvcharge;
		if ($subvcharge->UseTokenInUrl) {
			if ($objForm)
				return ($subvcharge->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subvcharge->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubvcharge_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subvcharge)
		if (!isset($GLOBALS["subvcharge"])) {
			$GLOBALS["subvcharge"] = new csubvcharge();

//			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["subvcharge"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subvcharge', TRUE);

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
		global $subvcharge;

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
			$subvcharge->GridAddRowCount = $gridaddcnt;

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
		global $subvcharge;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $subvcharge;

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
			if ($subvcharge->Export <> "" ||
				$subvcharge->CurrentAction == "gridadd" ||
				$subvcharge->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($subvcharge->AllowAddDeleteRow) {
				if ($subvcharge->CurrentAction == "gridadd" ||
					$subvcharge->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($subvcharge->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $subvcharge->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->DbMasterFilter = $subvcharge->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $subvcharge->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($subvcharge->getMasterFilter() <> "" && $subvcharge->getCurrentMasterTable() == "view2") {
			global $view2;
			$rsmaster = $view2->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($subvcharge->getReturnUrl()); // Return to caller
			} else {
				$view2->LoadListRowValues($rsmaster);
				$view2->RowType = EW_ROWTYPE_MASTER; // Master row
				$view2->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$subvcharge->setSessionWhere($sFilter);
		$subvcharge->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $subvcharge;
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
			$subvcharge->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$subvcharge->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $subvcharge;
		$subvcharge->LastAction = $subvcharge->CurrentAction; // Save last action
		$subvcharge->CurrentAction = ""; // Clear action
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
		global $conn, $Language, $objForm, $gsFormError, $subvcharge;
		$bGridUpdate = TRUE;

		// Get old recordset
		$subvcharge->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $subvcharge->SQL();
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
						$subvcharge->CurrentFilter = $subvcharge->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$subvcharge->SendEmail = FALSE; // Do not send email on update success
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
			$subvcharge->EventCancelled = TRUE; // Set event cancelled
			$subvcharge->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $subvcharge;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $subvcharge->KeyFilter();
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
		global $subvcharge;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$subvcharge->subvc_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($subvcharge->subvc_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $subvcharge;
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
				$subvcharge->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $subvcharge->subvc_id->CurrentValue;

					// Add filter for this record
					$sFilter = $subvcharge->KeyFilter();
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
			$subvcharge->CurrentFilter = $sWrkFilter;
			$sSql = $subvcharge->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$subvcharge->EventCancelled = TRUE; // Set event cancelled
			$subvcharge->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $subvcharge, $objForm;
		if ($objForm->HasValue("x_member_code") && $objForm->HasValue("o_member_code") && $subvcharge->member_code->CurrentValue <> $subvcharge->member_code->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_subvc_status") && $objForm->HasValue("o_subvc_status") && $subvcharge->subvc_status->CurrentValue <> $subvcharge->subvc_status->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_subvc_date") && $objForm->HasValue("o_subvc_date") && $subvcharge->subvc_date->CurrentValue <> $subvcharge->subvc_date->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_subvc_slipt_num") && $objForm->HasValue("o_subvc_slipt_num") && $subvcharge->subvc_slipt_num->CurrentValue <> $subvcharge->subvc_slipt_num->OldValue)
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
		global $objForm, $subvcharge;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $subvcharge;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$subvcharge->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$subvcharge->CurrentOrderType = @$_GET["ordertype"];
			$subvcharge->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $subvcharge;
		$sOrderBy = $subvcharge->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($subvcharge->SqlOrderBy() <> "") {
				$sOrderBy = $subvcharge->SqlOrderBy();
				$subvcharge->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $subvcharge;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$subvcharge->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$subvcharge->member_code->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$subvcharge->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$subvcharge->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $subvcharge;

		// "griddelete"
		if ($subvcharge->AllowAddDeleteRow) {
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
		global $Security, $Language, $subvcharge, $objForm;
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
			if ($this->RowAction == "insert" && $subvcharge->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_blankrow\" id=\"k" . $this->RowIndex . "_blankrow\" value=\"1\">";
		}

		// "delete"
		if ($subvcharge->AllowAddDeleteRow) {
			if ($subvcharge->CurrentMode == "add" || $subvcharge->CurrentMode == "copy" || $subvcharge->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, subvcharge_grid, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
			}
		}
		if ($subvcharge->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $subvcharge->subvc_id->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs->fields('subvc_id');
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $subvcharge;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subvcharge;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$subvcharge->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$subvcharge->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $subvcharge->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$subvcharge->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$subvcharge->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$subvcharge->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $subvcharge;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $subvcharge;
		$subvcharge->member_code->CurrentValue = NULL;
		$subvcharge->member_code->OldValue = $subvcharge->member_code->CurrentValue;
		$subvcharge->subvc_total->CurrentValue = NULL;
		$subvcharge->subvc_total->OldValue = $subvcharge->subvc_total->CurrentValue;
		$subvcharge->assc_percent->CurrentValue = NULL;
		$subvcharge->assc_percent->OldValue = $subvcharge->assc_percent->CurrentValue;
		$subvcharge->assc_total->CurrentValue = NULL;
		$subvcharge->assc_total->OldValue = $subvcharge->assc_total->CurrentValue;
		$subvcharge->bnfc_total->CurrentValue = NULL;
		$subvcharge->bnfc_total->OldValue = $subvcharge->bnfc_total->CurrentValue;
		$subvcharge->subvc_status->CurrentValue = "รอจ่าย";
		$subvcharge->subvc_status->OldValue = $subvcharge->subvc_status->CurrentValue;
		$subvcharge->subvc_date->CurrentValue = NULL;
		$subvcharge->subvc_date->OldValue = $subvcharge->subvc_date->CurrentValue;
		$subvcharge->subvc_slipt_num->CurrentValue = NULL;
		$subvcharge->subvc_slipt_num->OldValue = $subvcharge->subvc_slipt_num->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $subvcharge;
		if (!$subvcharge->member_code->FldIsDetailKey) {
			$subvcharge->member_code->setFormValue($objForm->GetValue("x_member_code"));
		}
		$subvcharge->member_code->setOldValue($objForm->GetValue("o_member_code"));
		if (!$subvcharge->subvc_total->FldIsDetailKey) {
			$subvcharge->subvc_total->setFormValue($objForm->GetValue("x_subvc_total"));
		}
		$subvcharge->subvc_total->setOldValue($objForm->GetValue("o_subvc_total"));
		if (!$subvcharge->assc_percent->FldIsDetailKey) {
			$subvcharge->assc_percent->setFormValue($objForm->GetValue("x_assc_percent"));
		}
		$subvcharge->assc_percent->setOldValue($objForm->GetValue("o_assc_percent"));
		if (!$subvcharge->assc_total->FldIsDetailKey) {
			$subvcharge->assc_total->setFormValue($objForm->GetValue("x_assc_total"));
		}
		$subvcharge->assc_total->setOldValue($objForm->GetValue("o_assc_total"));
		if (!$subvcharge->bnfc_total->FldIsDetailKey) {
			$subvcharge->bnfc_total->setFormValue($objForm->GetValue("x_bnfc_total"));
		}
		$subvcharge->bnfc_total->setOldValue($objForm->GetValue("o_bnfc_total"));
		if (!$subvcharge->subvc_status->FldIsDetailKey) {
			$subvcharge->subvc_status->setFormValue($objForm->GetValue("x_subvc_status"));
		}
		$subvcharge->subvc_status->setOldValue($objForm->GetValue("o_subvc_status"));
		if (!$subvcharge->subvc_date->FldIsDetailKey) {
			$subvcharge->subvc_date->setFormValue($objForm->GetValue("x_subvc_date"));
			$subvcharge->subvc_date->CurrentValue = ew_UnFormatDateTime($subvcharge->subvc_date->CurrentValue, 7);
		}
		$subvcharge->subvc_date->setOldValue($objForm->GetValue("o_subvc_date"));
		if (!$subvcharge->subvc_slipt_num->FldIsDetailKey) {
			$subvcharge->subvc_slipt_num->setFormValue($objForm->GetValue("x_subvc_slipt_num"));
		}
		$subvcharge->subvc_slipt_num->setOldValue($objForm->GetValue("o_subvc_slipt_num"));
		if (!$subvcharge->subvc_id->FldIsDetailKey && $subvcharge->CurrentAction <> "gridadd" && $subvcharge->CurrentAction <> "add")
			$subvcharge->subvc_id->setFormValue($objForm->GetValue("x_subvc_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $subvcharge;
		if ($subvcharge->CurrentAction <> "gridadd" && $subvcharge->CurrentAction <> "add")
			$subvcharge->subvc_id->CurrentValue = $subvcharge->subvc_id->FormValue;
		$subvcharge->member_code->CurrentValue = $subvcharge->member_code->FormValue;
		$subvcharge->subvc_total->CurrentValue = $subvcharge->subvc_total->FormValue;
		$subvcharge->assc_percent->CurrentValue = $subvcharge->assc_percent->FormValue;
		$subvcharge->assc_total->CurrentValue = $subvcharge->assc_total->FormValue;
		$subvcharge->bnfc_total->CurrentValue = $subvcharge->bnfc_total->FormValue;
		$subvcharge->subvc_status->CurrentValue = $subvcharge->subvc_status->FormValue;
		$subvcharge->subvc_date->CurrentValue = $subvcharge->subvc_date->FormValue;
		$subvcharge->subvc_date->CurrentValue = ew_UnFormatDateTime($subvcharge->subvc_date->CurrentValue, 7);
		$subvcharge->subvc_slipt_num->CurrentValue = $subvcharge->subvc_slipt_num->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subvcharge;

		// Call Recordset Selecting event
		$subvcharge->Recordset_Selecting($subvcharge->CurrentFilter);

		// Load List page SQL
		$sSql = $subvcharge->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subvcharge->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subvcharge;
		$sFilter = $subvcharge->KeyFilter();

		// Call Row Selecting event
		$subvcharge->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subvcharge->CurrentFilter = $sFilter;
		$sSql = $subvcharge->SQL();
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
		global $conn, $subvcharge;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subvcharge->Row_Selected($row);
		$subvcharge->subvc_id->setDbValue($rs->fields('subvc_id'));
		$subvcharge->member_code->setDbValue($rs->fields('member_code'));
		$subvcharge->all_member->setDbValue($rs->fields('all_member'));
		$subvcharge->alive_count->setDbValue($rs->fields('alive_count'));
		$subvcharge->dead_count->setDbValue($rs->fields('dead_count'));
		$subvcharge->resign_count->setDbValue($rs->fields('resign_count'));
		$subvcharge->terminate_count->setDbValue($rs->fields('terminate_count'));
		$subvcharge->subv_rate->setDbValue($rs->fields('subv_rate'));
		$subvcharge->can_pay_count->setDbValue($rs->fields('can_pay_count'));
		$subvcharge->cant_pay_count->setDbValue($rs->fields('cant_pay_count'));
		$subvcharge->cant_pay_detail->setDbValue($rs->fields('cant_pay_detail'));
		$subvcharge->subvc_total->setDbValue($rs->fields('subvc_total'));
		$subvcharge->assc_percent->setDbValue($rs->fields('assc_percent'));
		$subvcharge->assc_total->setDbValue($rs->fields('assc_total'));
		$subvcharge->bnfc_total->setDbValue($rs->fields('bnfc_total'));
		$subvcharge->canculate_date->setDbValue($rs->fields('canculate_date'));
		$subvcharge->subvc_status->setDbValue($rs->fields('subvc_status'));
		$subvcharge->subvc_date->setDbValue($rs->fields('subvc_date'));
		$subvcharge->subvc_slipt_num->setDbValue($rs->fields('subvc_slipt_num'));
	}

	// Load old record
	function LoadOldRecord() {
		global $subvcharge;

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$subvcharge->subvc_id->CurrentValue = strval($arKeys[0]); // subvc_id
			else
				$bValidKey = FALSE;
		} else {
			$bValidKey = FALSE;
		}

		// Load old recordset
		if ($bValidKey) {
			$subvcharge->CurrentFilter = $subvcharge->KeyFilter();
			$sSql = $subvcharge->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subvcharge;

		// Initialize URLs
		// Call Row_Rendering event

		$subvcharge->Row_Rendering();

		// Common render codes for all row types
		// subvc_id

		$subvcharge->subvc_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		$subvcharge->member_code->CellCssStyle = "white-space: nowrap;";

		// all_member
		// alive_count
		// dead_count
		// resign_count
		// terminate_count
		// subv_rate
		// can_pay_count
		// cant_pay_count
		// cant_pay_detail
		// subvc_total
		// assc_percent
		// assc_total
		// bnfc_total
		// canculate_date

		$subvcharge->canculate_date->CellCssStyle = "white-space: nowrap;";

		// subvc_status
		// subvc_date
		// subvc_slipt_num

		if ($subvcharge->RowType == EW_ROWTYPE_VIEW) { // View row

			// member_code
			$subvcharge->member_code->ViewValue = $subvcharge->member_code->CurrentValue;
			if (strval($subvcharge->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($subvcharge->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcharge->member_code->ViewValue = $rswrk->fields('dead_id');
					$subvcharge->member_code->ViewValue .= ew_ValueSeparator(0,1,$subvcharge->member_code) . $rswrk->fields('fname');
					$subvcharge->member_code->ViewValue .= ew_ValueSeparator(0,2,$subvcharge->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$subvcharge->member_code->ViewValue = $subvcharge->member_code->CurrentValue;
				}
			} else {
				$subvcharge->member_code->ViewValue = NULL;
			}
			$subvcharge->member_code->ViewCustomAttributes = "";

			// all_member
			$subvcharge->all_member->ViewValue = $subvcharge->all_member->CurrentValue;
			$subvcharge->all_member->ViewCustomAttributes = "";

			// alive_count
			$subvcharge->alive_count->ViewValue = $subvcharge->alive_count->CurrentValue;
			$subvcharge->alive_count->ViewCustomAttributes = "";

			// dead_count
			$subvcharge->dead_count->ViewValue = $subvcharge->dead_count->CurrentValue;
			$subvcharge->dead_count->ViewCustomAttributes = "";

			// resign_count
			$subvcharge->resign_count->ViewValue = $subvcharge->resign_count->CurrentValue;
			$subvcharge->resign_count->ViewCustomAttributes = "";

			// terminate_count
			$subvcharge->terminate_count->ViewValue = $subvcharge->terminate_count->CurrentValue;
			$subvcharge->terminate_count->ViewCustomAttributes = "";

			// subv_rate
			$subvcharge->subv_rate->ViewValue = $subvcharge->subv_rate->CurrentValue;
			$subvcharge->subv_rate->ViewCustomAttributes = "";

			// can_pay_count
			$subvcharge->can_pay_count->ViewValue = $subvcharge->can_pay_count->CurrentValue;
			$subvcharge->can_pay_count->ViewCustomAttributes = "";

			// cant_pay_count
			$subvcharge->cant_pay_count->ViewValue = $subvcharge->cant_pay_count->CurrentValue;
			$subvcharge->cant_pay_count->ViewCustomAttributes = "";

			// cant_pay_detail
			$subvcharge->cant_pay_detail->ViewValue = $subvcharge->cant_pay_detail->CurrentValue;
			$subvcharge->cant_pay_detail->ViewCustomAttributes = "";

			// subvc_total
			$subvcharge->subvc_total->ViewValue = $subvcharge->subvc_total->CurrentValue;
			$subvcharge->subvc_total->ViewCustomAttributes = "";

			// assc_percent
			$subvcharge->assc_percent->ViewValue = $subvcharge->assc_percent->CurrentValue;
			$subvcharge->assc_percent->ViewCustomAttributes = "";

			// assc_total
			$subvcharge->assc_total->ViewValue = $subvcharge->assc_total->CurrentValue;
			$subvcharge->assc_total->ViewCustomAttributes = "";

			// bnfc_total
			$subvcharge->bnfc_total->ViewValue = $subvcharge->bnfc_total->CurrentValue;
			$subvcharge->bnfc_total->ViewCustomAttributes = "";

			// subvc_status
			if (strval($subvcharge->subvc_status->CurrentValue) <> "") {
				switch ($subvcharge->subvc_status->CurrentValue) {
					case "รอจ่าย":
						$subvcharge->subvc_status->ViewValue = $subvcharge->subvc_status->FldTagCaption(1) <> "" ? $subvcharge->subvc_status->FldTagCaption(1) : $subvcharge->subvc_status->CurrentValue;
						break;
					case "จ่ายแล้ว":
						$subvcharge->subvc_status->ViewValue = $subvcharge->subvc_status->FldTagCaption(2) <> "" ? $subvcharge->subvc_status->FldTagCaption(2) : $subvcharge->subvc_status->CurrentValue;
						break;
					default:
						$subvcharge->subvc_status->ViewValue = $subvcharge->subvc_status->CurrentValue;
				}
			} else {
				$subvcharge->subvc_status->ViewValue = NULL;
			}
			$subvcharge->subvc_status->ViewCustomAttributes = "";

			// subvc_date
			$subvcharge->subvc_date->ViewValue = $subvcharge->subvc_date->CurrentValue;
			$subvcharge->subvc_date->ViewValue = ew_FormatDateTime($subvcharge->subvc_date->ViewValue, 7);
			$subvcharge->subvc_date->ViewCustomAttributes = "";

			// subvc_slipt_num
			$subvcharge->subvc_slipt_num->ViewValue = $subvcharge->subvc_slipt_num->CurrentValue;
			$subvcharge->subvc_slipt_num->ViewCustomAttributes = "";

			// member_code
			$subvcharge->member_code->LinkCustomAttributes = "";
			$subvcharge->member_code->HrefValue = "";
			$subvcharge->member_code->TooltipValue = "";

			// subvc_total
			$subvcharge->subvc_total->LinkCustomAttributes = "";
			$subvcharge->subvc_total->HrefValue = "";
			$subvcharge->subvc_total->TooltipValue = "";

			// assc_percent
			$subvcharge->assc_percent->LinkCustomAttributes = "";
			$subvcharge->assc_percent->HrefValue = "";
			$subvcharge->assc_percent->TooltipValue = "";

			// assc_total
			$subvcharge->assc_total->LinkCustomAttributes = "";
			$subvcharge->assc_total->HrefValue = "";
			$subvcharge->assc_total->TooltipValue = "";

			// bnfc_total
			$subvcharge->bnfc_total->LinkCustomAttributes = "";
			$subvcharge->bnfc_total->HrefValue = "";
			$subvcharge->bnfc_total->TooltipValue = "";

			// subvc_status
			$subvcharge->subvc_status->LinkCustomAttributes = "";
			$subvcharge->subvc_status->HrefValue = "";
			$subvcharge->subvc_status->TooltipValue = "";

			// subvc_date
			$subvcharge->subvc_date->LinkCustomAttributes = "";
			$subvcharge->subvc_date->HrefValue = "";
			$subvcharge->subvc_date->TooltipValue = "";

			// subvc_slipt_num
			$subvcharge->subvc_slipt_num->LinkCustomAttributes = "";
			$subvcharge->subvc_slipt_num->HrefValue = "";
			$subvcharge->subvc_slipt_num->TooltipValue = "";
		} elseif ($subvcharge->RowType == EW_ROWTYPE_ADD) { // Add row

			// member_code
			$subvcharge->member_code->EditCustomAttributes = "";
			if ($subvcharge->member_code->getSessionValue() <> "") {
				$subvcharge->member_code->CurrentValue = $subvcharge->member_code->getSessionValue();
				$subvcharge->member_code->OldValue = $subvcharge->member_code->CurrentValue;
			$subvcharge->member_code->ViewValue = $subvcharge->member_code->CurrentValue;
			if (strval($subvcharge->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($subvcharge->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcharge->member_code->ViewValue = $rswrk->fields('dead_id');
					$subvcharge->member_code->ViewValue .= ew_ValueSeparator(0,1,$subvcharge->member_code) . $rswrk->fields('fname');
					$subvcharge->member_code->ViewValue .= ew_ValueSeparator(0,2,$subvcharge->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$subvcharge->member_code->ViewValue = $subvcharge->member_code->CurrentValue;
				}
			} else {
				$subvcharge->member_code->ViewValue = NULL;
			}
			$subvcharge->member_code->ViewCustomAttributes = "";
			} else {
			$subvcharge->member_code->EditValue = ew_HtmlEncode($subvcharge->member_code->CurrentValue);
			}

			// subvc_total
			// assc_percent
			// assc_total
			// bnfc_total
			// subvc_status

			$subvcharge->subvc_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("รอจ่าย", $subvcharge->subvc_status->FldTagCaption(1) <> "" ? $subvcharge->subvc_status->FldTagCaption(1) : "รอจ่าย");
			$arwrk[] = array("จ่ายแล้ว", $subvcharge->subvc_status->FldTagCaption(2) <> "" ? $subvcharge->subvc_status->FldTagCaption(2) : "จ่ายแล้ว");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$subvcharge->subvc_status->EditValue = $arwrk;

			// subvc_date
			$subvcharge->subvc_date->EditCustomAttributes = "";
			$subvcharge->subvc_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($subvcharge->subvc_date->CurrentValue, 7));

			// subvc_slipt_num
			$subvcharge->subvc_slipt_num->EditCustomAttributes = "";
			$subvcharge->subvc_slipt_num->EditValue = ew_HtmlEncode($subvcharge->subvc_slipt_num->CurrentValue);

			// Edit refer script
			// member_code

			$subvcharge->member_code->HrefValue = "";

			// subvc_total
			$subvcharge->subvc_total->HrefValue = "";

			// assc_percent
			$subvcharge->assc_percent->HrefValue = "";

			// assc_total
			$subvcharge->assc_total->HrefValue = "";

			// bnfc_total
			$subvcharge->bnfc_total->HrefValue = "";

			// subvc_status
			$subvcharge->subvc_status->HrefValue = "";

			// subvc_date
			$subvcharge->subvc_date->HrefValue = "";

			// subvc_slipt_num
			$subvcharge->subvc_slipt_num->HrefValue = "";
		} elseif ($subvcharge->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// member_code
			$subvcharge->member_code->EditCustomAttributes = "";
			$subvcharge->member_code->EditValue = $subvcharge->member_code->CurrentValue;
			if (strval($subvcharge->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($subvcharge->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcharge->member_code->EditValue = $rswrk->fields('dead_id');
					$subvcharge->member_code->EditValue .= ew_ValueSeparator(0,1,$subvcharge->member_code) . $rswrk->fields('fname');
					$subvcharge->member_code->EditValue .= ew_ValueSeparator(0,2,$subvcharge->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$subvcharge->member_code->EditValue = $subvcharge->member_code->CurrentValue;
				}
			} else {
				$subvcharge->member_code->EditValue = NULL;
			}
			$subvcharge->member_code->ViewCustomAttributes = "";

			// subvc_total
			// assc_percent
			// assc_total
			// bnfc_total
			// subvc_status

			$subvcharge->subvc_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("รอจ่าย", $subvcharge->subvc_status->FldTagCaption(1) <> "" ? $subvcharge->subvc_status->FldTagCaption(1) : "รอจ่าย");
			$arwrk[] = array("จ่ายแล้ว", $subvcharge->subvc_status->FldTagCaption(2) <> "" ? $subvcharge->subvc_status->FldTagCaption(2) : "จ่ายแล้ว");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$subvcharge->subvc_status->EditValue = $arwrk;

			// subvc_date
			$subvcharge->subvc_date->EditCustomAttributes = "";
			$subvcharge->subvc_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($subvcharge->subvc_date->CurrentValue, 7));

			// subvc_slipt_num
			$subvcharge->subvc_slipt_num->EditCustomAttributes = "";
			$subvcharge->subvc_slipt_num->EditValue = ew_HtmlEncode($subvcharge->subvc_slipt_num->CurrentValue);

			// Edit refer script
			// member_code

			$subvcharge->member_code->HrefValue = "";

			// subvc_total
			$subvcharge->subvc_total->HrefValue = "";

			// assc_percent
			$subvcharge->assc_percent->HrefValue = "";

			// assc_total
			$subvcharge->assc_total->HrefValue = "";

			// bnfc_total
			$subvcharge->bnfc_total->HrefValue = "";

			// subvc_status
			$subvcharge->subvc_status->HrefValue = "";

			// subvc_date
			$subvcharge->subvc_date->HrefValue = "";

			// subvc_slipt_num
			$subvcharge->subvc_slipt_num->HrefValue = "";
		}
		if ($subvcharge->RowType == EW_ROWTYPE_ADD ||
			$subvcharge->RowType == EW_ROWTYPE_EDIT ||
			$subvcharge->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$subvcharge->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($subvcharge->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subvcharge->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $subvcharge;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($subvcharge->subvc_status->FormValue) && $subvcharge->subvc_status->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $subvcharge->subvc_status->FldCaption());
		}
		if (!is_null($subvcharge->subvc_date->FormValue) && $subvcharge->subvc_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $subvcharge->subvc_date->FldCaption());
		}
		if (!ew_CheckEuroDate($subvcharge->subvc_date->FormValue)) {
			ew_AddMessage($gsFormError, $subvcharge->subvc_date->FldErrMsg());
		}
		if (!is_null($subvcharge->subvc_slipt_num->FormValue) && $subvcharge->subvc_slipt_num->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $subvcharge->subvc_slipt_num->FldCaption());
		}
		if (!ew_CheckInteger($subvcharge->subvc_slipt_num->FormValue)) {
			ew_AddMessage($gsFormError, $subvcharge->subvc_slipt_num->FldErrMsg());
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
		global $conn, $Language, $Security, $subvcharge;
		$DeleteRows = TRUE;
		$sSql = $subvcharge->SQL();
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
				$DeleteRows = $subvcharge->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['subvc_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($subvcharge->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($subvcharge->CancelMessage <> "") {
				$this->setFailureMessage($subvcharge->CancelMessage);
				$subvcharge->CancelMessage = "";
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
				$subvcharge->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $subvcharge;
		$sFilter = $subvcharge->KeyFilter();
		$subvcharge->CurrentFilter = $sFilter;
		$sSql = $subvcharge->SQL();
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

			// subvc_total
			$subvcharge->subvc_total->SetDbValueDef($rsnew, getSubvTotal(), 0);
			$rsnew['subvc_total'] =& $subvcharge->subvc_total->DbValue;

			// assc_percent
			$subvcharge->assc_percent->SetDbValueDef($rsnew, getAsscPercent(), 0);
			$rsnew['assc_percent'] =& $subvcharge->assc_percent->DbValue;

			// assc_total
			$subvcharge->assc_total->SetDbValueDef($rsnew, getAsscTotal(), 0);
			$rsnew['assc_total'] =& $subvcharge->assc_total->DbValue;

			// bnfc_total
			$subvcharge->bnfc_total->SetDbValueDef($rsnew, getBnfcTotal(), 0);
			$rsnew['bnfc_total'] =& $subvcharge->bnfc_total->DbValue;

			// subvc_status
			$subvcharge->subvc_status->SetDbValueDef($rsnew, $subvcharge->subvc_status->CurrentValue, "", $subvcharge->subvc_status->ReadOnly);

			// subvc_date
			$subvcharge->subvc_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($subvcharge->subvc_date->CurrentValue, 7), ew_CurrentDate(), $subvcharge->subvc_date->ReadOnly);

			// subvc_slipt_num
			$subvcharge->subvc_slipt_num->SetDbValueDef($rsnew, $subvcharge->subvc_slipt_num->CurrentValue, 0, $subvcharge->subvc_slipt_num->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $subvcharge->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($subvcharge->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($subvcharge->CancelMessage <> "") {
					$this->setFailureMessage($subvcharge->CancelMessage);
					$subvcharge->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$subvcharge->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $subvcharge;

		// Set up foreign key field value from Session
			if ($subvcharge->getCurrentMasterTable() == "view2") {
				$subvcharge->member_code->CurrentValue = $subvcharge->member_code->getSessionValue();
			}
		$rsnew = array();

		// member_code
		$subvcharge->member_code->SetDbValueDef($rsnew, $subvcharge->member_code->CurrentValue, "", FALSE);

		// subvc_total
		$subvcharge->subvc_total->SetDbValueDef($rsnew, getSubvTotal(), 0);
		$rsnew['subvc_total'] =& $subvcharge->subvc_total->DbValue;

		// assc_percent
		$subvcharge->assc_percent->SetDbValueDef($rsnew, getAsscPercent(), 0);
		$rsnew['assc_percent'] =& $subvcharge->assc_percent->DbValue;

		// assc_total
		$subvcharge->assc_total->SetDbValueDef($rsnew, getAsscTotal(), 0);
		$rsnew['assc_total'] =& $subvcharge->assc_total->DbValue;

		// bnfc_total
		$subvcharge->bnfc_total->SetDbValueDef($rsnew, getBnfcTotal(), 0);
		$rsnew['bnfc_total'] =& $subvcharge->bnfc_total->DbValue;

		// subvc_status
		$subvcharge->subvc_status->SetDbValueDef($rsnew, $subvcharge->subvc_status->CurrentValue, "", strval($subvcharge->subvc_status->CurrentValue) == "");

		// subvc_date
		$subvcharge->subvc_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($subvcharge->subvc_date->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// subvc_slipt_num
		$subvcharge->subvc_slipt_num->SetDbValueDef($rsnew, $subvcharge->subvc_slipt_num->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $subvcharge->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($subvcharge->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($subvcharge->CancelMessage <> "") {
				$this->setFailureMessage($subvcharge->CancelMessage);
				$subvcharge->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$subvcharge->subvc_id->setDbValue($conn->Insert_ID());
			$rsnew['subvc_id'] = $subvcharge->subvc_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$subvcharge->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $subvcharge;

		// Hide foreign keys
		$sMasterTblVar = $subvcharge->getCurrentMasterTable();
		if ($sMasterTblVar == "view2") {
			$subvcharge->member_code->Visible = FALSE;
			if ($GLOBALS["view2"]->EventCancelled) $subvcharge->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $subvcharge->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $subvcharge->getDetailFilter(); // Get detail filter
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
			$opt =& $this->ListOptions->Add("subvslipt");
			$opt->Header = "ใบสำคัญรับเงิน";
			$opt->OnLeft = TRUE; // Link on left
			$opt->MoveTo(3); // Move to first column
	}                     

		// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:    
		 global $subvcharge; 
		 global $Language;
		 $this->ListOptions->Items["subvslipt"]->Body = "<a href='subvsliptview.php?subvc_id=".$subvcharge->subvc_id->CurrentValue."'>PrintSlipt</a>";
	}                                                                                                                        
}
?>
