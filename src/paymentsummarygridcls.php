<?php include_once "administratorinfo.php" ?>
<?php

//
// Page class
//
class cpaymentsummary_grid {

	// Page ID
	var $PageID = 'grid';

	// Table name
	var $TableName = 'paymentsummary';

	// Page object name
	var $PageObjName = 'paymentsummary_grid';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $paymentsummary;
		if ($paymentsummary->UseTokenInUrl) $PageUrl .= "t=" . $paymentsummary->TableVar . "&"; // Add page token
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
		global $objForm, $paymentsummary;
		if ($paymentsummary->UseTokenInUrl) {
			if ($objForm)
				return ($paymentsummary->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($paymentsummary->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpaymentsummary_grid() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (paymentsummary)
		if (!isset($GLOBALS["paymentsummary"])) {
			$GLOBALS["paymentsummary"] = new cpaymentsummary();

//			$GLOBALS["MasterTable"] =& $GLOBALS["Table"];
			$GLOBALS["Table"] =& $GLOBALS["paymentsummary"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'paymentsummary', TRUE);

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
		global $paymentsummary;

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
			$paymentsummary->GridAddRowCount = $gridaddcnt;

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
		global $paymentsummary;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $paymentsummary;

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
			if ($paymentsummary->Export <> "" ||
				$paymentsummary->CurrentAction == "gridadd" ||
				$paymentsummary->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($paymentsummary->AllowAddDeleteRow) {
				if ($paymentsummary->CurrentAction == "gridadd" ||
					$paymentsummary->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($paymentsummary->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $paymentsummary->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 100; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->DbMasterFilter = $paymentsummary->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $paymentsummary->getDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($paymentsummary->getMasterFilter() <> "" && $paymentsummary->getCurrentMasterTable() == "village") {
			global $village;
			$rsmaster = $village->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate($paymentsummary->getReturnUrl()); // Return to caller
			} else {
				$village->LoadListRowValues($rsmaster);
				$village->RowType = EW_ROWTYPE_MASTER; // Master row
				$village->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$paymentsummary->setSessionWhere($sFilter);
		$paymentsummary->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $paymentsummary;
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
			$paymentsummary->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$paymentsummary->setStartRecordNumber($this->StartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $paymentsummary;
		$paymentsummary->LastAction = $paymentsummary->CurrentAction; // Save last action
		$paymentsummary->CurrentAction = ""; // Clear action
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
		global $conn, $Language, $objForm, $gsFormError, $paymentsummary;
		$bGridUpdate = TRUE;

		// Get old recordset
		$paymentsummary->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $paymentsummary->SQL();
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
						$paymentsummary->CurrentFilter = $paymentsummary->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$paymentsummary->SendEmail = FALSE; // Do not send email on update success
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
			$paymentsummary->EventCancelled = TRUE; // Set event cancelled
			$paymentsummary->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
		return $bGridUpdate;
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $paymentsummary;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $paymentsummary->KeyFilter();
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
		global $paymentsummary;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$paymentsummary->pay_sum_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($paymentsummary->pay_sum_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $conn, $Language, $objForm, $gsFormError, $paymentsummary;
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
				$paymentsummary->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $paymentsummary->pay_sum_id->CurrentValue;

					// Add filter for this record
					$sFilter = $paymentsummary->KeyFilter();
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
			$paymentsummary->CurrentFilter = $sWrkFilter;
			$sSql = $paymentsummary->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
			$paymentsummary->EventCancelled = TRUE; // Set event cancelled
			$paymentsummary->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $paymentsummary, $objForm;
		if ($objForm->HasValue("x_t_code") && $objForm->HasValue("o_t_code") && $paymentsummary->t_code->CurrentValue <> $paymentsummary->t_code->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_village_id") && $objForm->HasValue("o_village_id") && $paymentsummary->village_id->CurrentValue <> $paymentsummary->village_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_member_code") && $objForm->HasValue("o_member_code") && $paymentsummary->member_code->CurrentValue <> $paymentsummary->member_code->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_pay_sum_date") && $objForm->HasValue("o_pay_sum_date") && $paymentsummary->pay_sum_date->CurrentValue <> $paymentsummary->pay_sum_date->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_pay_sum_type") && $objForm->HasValue("o_pay_sum_type") && $paymentsummary->pay_sum_type->CurrentValue <> $paymentsummary->pay_sum_type->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_pay_death_begin") && $objForm->HasValue("o_pay_death_begin") && $paymentsummary->pay_death_begin->CurrentValue <> $paymentsummary->pay_death_begin->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_pay_sum_adv_num") && $objForm->HasValue("o_pay_sum_adv_num") && $paymentsummary->pay_sum_adv_num->CurrentValue <> $paymentsummary->pay_sum_adv_num->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_pay_annual_year") && $objForm->HasValue("o_pay_annual_year") && $paymentsummary->pay_annual_year->CurrentValue <> $paymentsummary->pay_annual_year->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_pay_sum_detail") && $objForm->HasValue("o_pay_sum_detail") && $paymentsummary->pay_sum_detail->CurrentValue <> $paymentsummary->pay_sum_detail->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_pay_sum_total") && $objForm->HasValue("o_pay_sum_total") && $paymentsummary->pay_sum_total->CurrentValue <> $paymentsummary->pay_sum_total->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_pay_sum_note") && $objForm->HasValue("o_pay_sum_note") && $paymentsummary->pay_sum_note->CurrentValue <> $paymentsummary->pay_sum_note->OldValue)
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
		global $objForm, $paymentsummary;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $paymentsummary;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$paymentsummary->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$paymentsummary->CurrentOrderType = @$_GET["ordertype"];
			$paymentsummary->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $paymentsummary;
		$sOrderBy = $paymentsummary->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($paymentsummary->SqlOrderBy() <> "") {
				$sOrderBy = $paymentsummary->SqlOrderBy();
				$paymentsummary->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $paymentsummary;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$paymentsummary->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$paymentsummary->village_id->setSessionValue("");
				$paymentsummary->t_code->setSessionValue("");
				$paymentsummary->flag->setSessionValue("");
			}

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$paymentsummary->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$paymentsummary->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $paymentsummary;

		// "griddelete"
		if ($paymentsummary->AllowAddDeleteRow) {
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
		global $Security, $Language, $paymentsummary, $objForm;
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
			if ($this->RowAction == "insert" && $paymentsummary->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_blankrow\" id=\"k" . $this->RowIndex . "_blankrow\" value=\"1\">";
		}

		// "delete"
		if ($paymentsummary->AllowAddDeleteRow) {
			if ($paymentsummary->CurrentMode == "add" || $paymentsummary->CurrentMode == "copy" || $paymentsummary->CurrentMode == "edit") {
				$oListOpt =& $this->ListOptions->Items["griddelete"];
				$oListOpt->Body = "<a class=\"ewGridLink\" href=\"javascript:void(0);\" onclick=\"ew_DeleteGridRow(this, paymentsummary_grid, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
			}
		}
		if ($paymentsummary->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . $paymentsummary->pay_sum_id->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs->fields('pay_sum_id');
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $paymentsummary;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $paymentsummary;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$paymentsummary->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$paymentsummary->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $paymentsummary->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$paymentsummary->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$paymentsummary->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$paymentsummary->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $paymentsummary;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $paymentsummary;
		$paymentsummary->t_code->CurrentValue = NULL;
		$paymentsummary->t_code->OldValue = $paymentsummary->t_code->CurrentValue;
		$paymentsummary->village_id->CurrentValue = NULL;
		$paymentsummary->village_id->OldValue = $paymentsummary->village_id->CurrentValue;
		$paymentsummary->member_code->CurrentValue = NULL;
		$paymentsummary->member_code->OldValue = $paymentsummary->member_code->CurrentValue;
		$paymentsummary->pay_sum_date->CurrentValue = NULL;
		$paymentsummary->pay_sum_date->OldValue = $paymentsummary->pay_sum_date->CurrentValue;
		$paymentsummary->pay_sum_type->CurrentValue = NULL;
		$paymentsummary->pay_sum_type->OldValue = $paymentsummary->pay_sum_type->CurrentValue;
		$paymentsummary->pay_death_begin->CurrentValue = NULL;
		$paymentsummary->pay_death_begin->OldValue = $paymentsummary->pay_death_begin->CurrentValue;
		$paymentsummary->pay_sum_adv_num->CurrentValue = NULL;
		$paymentsummary->pay_sum_adv_num->OldValue = $paymentsummary->pay_sum_adv_num->CurrentValue;
		$paymentsummary->pay_annual_year->CurrentValue = NULL;
		$paymentsummary->pay_annual_year->OldValue = $paymentsummary->pay_annual_year->CurrentValue;
		$paymentsummary->pay_sum_detail->CurrentValue = NULL;
		$paymentsummary->pay_sum_detail->OldValue = $paymentsummary->pay_sum_detail->CurrentValue;
		$paymentsummary->pay_sum_total->CurrentValue = NULL;
		$paymentsummary->pay_sum_total->OldValue = $paymentsummary->pay_sum_total->CurrentValue;
		$paymentsummary->pay_sum_note->CurrentValue = NULL;
		$paymentsummary->pay_sum_note->OldValue = $paymentsummary->pay_sum_note->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $paymentsummary;
		if (!$paymentsummary->t_code->FldIsDetailKey) {
			$paymentsummary->t_code->setFormValue($objForm->GetValue("x_t_code"));
		}
		$paymentsummary->t_code->setOldValue($objForm->GetValue("o_t_code"));
		if (!$paymentsummary->village_id->FldIsDetailKey) {
			$paymentsummary->village_id->setFormValue($objForm->GetValue("x_village_id"));
		}
		$paymentsummary->village_id->setOldValue($objForm->GetValue("o_village_id"));
		if (!$paymentsummary->member_code->FldIsDetailKey) {
			$paymentsummary->member_code->setFormValue($objForm->GetValue("x_member_code"));
		}
		$paymentsummary->member_code->setOldValue($objForm->GetValue("o_member_code"));
		if (!$paymentsummary->pay_sum_date->FldIsDetailKey) {
			$paymentsummary->pay_sum_date->setFormValue($objForm->GetValue("x_pay_sum_date"));
			$paymentsummary->pay_sum_date->CurrentValue = ew_UnFormatDateTime($paymentsummary->pay_sum_date->CurrentValue, 7);
		}
		$paymentsummary->pay_sum_date->setOldValue($objForm->GetValue("o_pay_sum_date"));
		if (!$paymentsummary->pay_sum_type->FldIsDetailKey) {
			$paymentsummary->pay_sum_type->setFormValue($objForm->GetValue("x_pay_sum_type"));
		}
		$paymentsummary->pay_sum_type->setOldValue($objForm->GetValue("o_pay_sum_type"));
		if (!$paymentsummary->pay_death_begin->FldIsDetailKey) {
			$paymentsummary->pay_death_begin->setFormValue($objForm->GetValue("x_pay_death_begin"));
		}
		$paymentsummary->pay_death_begin->setOldValue($objForm->GetValue("o_pay_death_begin"));
		if (!$paymentsummary->pay_sum_adv_num->FldIsDetailKey) {
			$paymentsummary->pay_sum_adv_num->setFormValue($objForm->GetValue("x_pay_sum_adv_num"));
		}
		$paymentsummary->pay_sum_adv_num->setOldValue($objForm->GetValue("o_pay_sum_adv_num"));
		if (!$paymentsummary->pay_annual_year->FldIsDetailKey) {
			$paymentsummary->pay_annual_year->setFormValue($objForm->GetValue("x_pay_annual_year"));
		}
		$paymentsummary->pay_annual_year->setOldValue($objForm->GetValue("o_pay_annual_year"));
		if (!$paymentsummary->pay_sum_detail->FldIsDetailKey) {
			$paymentsummary->pay_sum_detail->setFormValue($objForm->GetValue("x_pay_sum_detail"));
		}
		$paymentsummary->pay_sum_detail->setOldValue($objForm->GetValue("o_pay_sum_detail"));
		if (!$paymentsummary->pay_sum_total->FldIsDetailKey) {
			$paymentsummary->pay_sum_total->setFormValue($objForm->GetValue("x_pay_sum_total"));
		}
		$paymentsummary->pay_sum_total->setOldValue($objForm->GetValue("o_pay_sum_total"));
		if (!$paymentsummary->pay_sum_note->FldIsDetailKey) {
			$paymentsummary->pay_sum_note->setFormValue($objForm->GetValue("x_pay_sum_note"));
		}
		$paymentsummary->pay_sum_note->setOldValue($objForm->GetValue("o_pay_sum_note"));
		if (!$paymentsummary->pay_sum_id->FldIsDetailKey && $paymentsummary->CurrentAction <> "gridadd" && $paymentsummary->CurrentAction <> "add")
			$paymentsummary->pay_sum_id->setFormValue($objForm->GetValue("x_pay_sum_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $paymentsummary;
		if ($paymentsummary->CurrentAction <> "gridadd" && $paymentsummary->CurrentAction <> "add")
			$paymentsummary->pay_sum_id->CurrentValue = $paymentsummary->pay_sum_id->FormValue;
		$paymentsummary->t_code->CurrentValue = $paymentsummary->t_code->FormValue;
		$paymentsummary->village_id->CurrentValue = $paymentsummary->village_id->FormValue;
		$paymentsummary->member_code->CurrentValue = $paymentsummary->member_code->FormValue;
		$paymentsummary->pay_sum_date->CurrentValue = $paymentsummary->pay_sum_date->FormValue;
		$paymentsummary->pay_sum_date->CurrentValue = ew_UnFormatDateTime($paymentsummary->pay_sum_date->CurrentValue, 7);
		$paymentsummary->pay_sum_type->CurrentValue = $paymentsummary->pay_sum_type->FormValue;
		$paymentsummary->pay_death_begin->CurrentValue = $paymentsummary->pay_death_begin->FormValue;
		$paymentsummary->pay_sum_adv_num->CurrentValue = $paymentsummary->pay_sum_adv_num->FormValue;
		$paymentsummary->pay_annual_year->CurrentValue = $paymentsummary->pay_annual_year->FormValue;
		$paymentsummary->pay_sum_detail->CurrentValue = $paymentsummary->pay_sum_detail->FormValue;
		$paymentsummary->pay_sum_total->CurrentValue = $paymentsummary->pay_sum_total->FormValue;
		$paymentsummary->pay_sum_note->CurrentValue = $paymentsummary->pay_sum_note->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $paymentsummary;

		// Call Recordset Selecting event
		$paymentsummary->Recordset_Selecting($paymentsummary->CurrentFilter);

		// Load List page SQL
		$sSql = $paymentsummary->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$paymentsummary->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $paymentsummary;
		$sFilter = $paymentsummary->KeyFilter();

		// Call Row Selecting event
		$paymentsummary->Row_Selecting($sFilter);

		// Load SQL based on filter
		$paymentsummary->CurrentFilter = $sFilter;
		$sSql = $paymentsummary->SQL();
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
		global $conn, $paymentsummary;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$paymentsummary->Row_Selected($row);
		$paymentsummary->pay_sum_id->setDbValue($rs->fields('pay_sum_id'));
		$paymentsummary->t_code->setDbValue($rs->fields('t_code'));
		$paymentsummary->village_id->setDbValue($rs->fields('village_id'));
		$paymentsummary->member_code->setDbValue($rs->fields('member_code'));
		$paymentsummary->pay_sum_date->setDbValue($rs->fields('pay_sum_date'));
		$paymentsummary->pay_sum_type->setDbValue($rs->fields('pay_sum_type'));
		$paymentsummary->pay_death_begin->setDbValue($rs->fields('pay_death_begin'));
		$paymentsummary->pay_sum_adv_count->setDbValue($rs->fields('pay_sum_adv_count'));
		$paymentsummary->pay_sum_adv_num->setDbValue($rs->fields('pay_sum_adv_num'));
		$paymentsummary->pay_death_end->setDbValue($rs->fields('pay_death_end'));
		$paymentsummary->pay_annual_year->setDbValue($rs->fields('pay_annual_year'));
		$paymentsummary->pay_sum_detail->setDbValue($rs->fields('pay_sum_detail'));
		$paymentsummary->pay_sum_total->setDbValue($rs->fields('pay_sum_total'));
		$paymentsummary->pay_sum_note->setDbValue($rs->fields('pay_sum_note'));
		$paymentsummary->flag->setDbValue($rs->fields('flag'));
	}

	// Load old record
	function LoadOldRecord() {
		global $paymentsummary;

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$paymentsummary->pay_sum_id->CurrentValue = strval($arKeys[0]); // pay_sum_id
			else
				$bValidKey = FALSE;
		} else {
			$bValidKey = FALSE;
		}

		// Load old recordset
		if ($bValidKey) {
			$paymentsummary->CurrentFilter = $paymentsummary->KeyFilter();
			$sSql = $paymentsummary->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $paymentsummary;

		// Initialize URLs
		// Call Row_Rendering event

		$paymentsummary->Row_Rendering();

		// Common render codes for all row types
		// pay_sum_id
		// t_code

		$paymentsummary->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$paymentsummary->village_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		$paymentsummary->member_code->CellCssStyle = "white-space: nowrap;";

		// pay_sum_date
		// pay_sum_type

		$paymentsummary->pay_sum_type->CellCssStyle = "white-space: nowrap;";

		// pay_death_begin
		// pay_sum_adv_count

		$paymentsummary->pay_sum_adv_count->CellCssStyle = "white-space: nowrap;";

		// pay_sum_adv_num
		// pay_death_end

		$paymentsummary->pay_death_end->CellCssStyle = "white-space: nowrap;";

		// pay_annual_year
		// pay_sum_detail
		// pay_sum_total

		$paymentsummary->pay_sum_total->CellCssStyle = "white-space: nowrap;";

		// pay_sum_note
		// flag

		$paymentsummary->flag->CellCssStyle = "white-space: nowrap;";
		if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View row

			// pay_sum_id
			$paymentsummary->pay_sum_id->ViewValue = $paymentsummary->pay_sum_id->CurrentValue;
			$paymentsummary->pay_sum_id->ViewCustomAttributes = "";

			// t_code
			if (strval($paymentsummary->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($paymentsummary->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->t_code->ViewValue = $rswrk->fields('t_code');
					$paymentsummary->t_code->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$paymentsummary->t_code->ViewValue = $paymentsummary->t_code->CurrentValue;
				}
			} else {
				$paymentsummary->t_code->ViewValue = NULL;
			}
			$paymentsummary->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($paymentsummary->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($paymentsummary->village_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `v_code`, `v_title` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->village_id->ViewValue = $rswrk->fields('v_code');
					$paymentsummary->village_id->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$paymentsummary->village_id->ViewValue = $paymentsummary->village_id->CurrentValue;
				}
			} else {
				$paymentsummary->village_id->ViewValue = NULL;
			}
			$paymentsummary->village_id->ViewCustomAttributes = "";

			// member_code
			if (strval($paymentsummary->member_code->CurrentValue) <> "") {
				$arwrk = explode(",", $paymentsummary->member_code->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`member_code` = '" . ew_AdjustSql(trim($wrk)) . "'";
				}	
			$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` != 'เสียชีวิต' ";;
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `member_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->member_code->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$paymentsummary->member_code->ViewValue .= $rswrk->fields('member_code');
						$paymentsummary->member_code->ViewValue .= ew_ValueSeparator($ari,1,$paymentsummary->member_code) . $rswrk->fields('fname');
						$paymentsummary->member_code->ViewValue .= ew_ValueSeparator($ari,2,$paymentsummary->member_code) . $rswrk->fields('lname');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $paymentsummary->member_code->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$paymentsummary->member_code->ViewValue = $paymentsummary->member_code->CurrentValue;
				}
			} else {
				$paymentsummary->member_code->ViewValue = NULL;
			}
			$paymentsummary->member_code->ViewCustomAttributes = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->ViewValue = $paymentsummary->pay_sum_date->CurrentValue;
			$paymentsummary->pay_sum_date->ViewValue = ew_FormatDateTime($paymentsummary->pay_sum_date->ViewValue, 7);
			$paymentsummary->pay_sum_date->ViewCustomAttributes = "";

			// pay_sum_type
			if (strval($paymentsummary->pay_sum_type->CurrentValue) <> "") {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($paymentsummary->pay_sum_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_type->ViewValue = $rswrk->fields('pt_title');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_type->ViewValue = $paymentsummary->pay_sum_type->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_type->ViewValue = NULL;
			}
			$paymentsummary->pay_sum_type->ViewCustomAttributes = "";

			// pay_death_begin
			if (strval($paymentsummary->pay_death_begin->CurrentValue) <> "") {
				$sFilterWrk = "`dead_id` = " . ew_AdjustSql($paymentsummary->pay_death_begin->CurrentValue) . "";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` = 'เสียชีวิต' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `dead_id` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_death_begin->ViewValue = $rswrk->fields('dead_id');
					$paymentsummary->pay_death_begin->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->pay_death_begin) . $rswrk->fields('fname');
					$paymentsummary->pay_death_begin->ViewValue .= ew_ValueSeparator(0,2,$paymentsummary->pay_death_begin) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_death_begin->ViewValue = $paymentsummary->pay_death_begin->CurrentValue;
				}
			} else {
				$paymentsummary->pay_death_begin->ViewValue = NULL;
			}
			$paymentsummary->pay_death_begin->ViewCustomAttributes = "";

			// pay_sum_adv_num
			if (strval($paymentsummary->pay_sum_adv_num->CurrentValue) <> "") {
				$sFilterWrk = "`adv_num` = " . ew_AdjustSql($paymentsummary->pay_sum_adv_num->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `adv_num` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`adv_num` != '0'";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `adv_num`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_adv_num->ViewValue = $rswrk->fields('adv_num');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_adv_num->ViewValue = $paymentsummary->pay_sum_adv_num->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_adv_num->ViewValue = NULL;
			}
			$paymentsummary->pay_sum_adv_num->ViewCustomAttributes = "";

			// pay_annual_year
			if (strval($paymentsummary->pay_annual_year->CurrentValue) <> "") {
				$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($paymentsummary->pay_annual_year->CurrentValue) . "'";
			$sSqlWrk = "SELECT DISTINCT `cal_detail` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`cal_type` = 3";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cal_detail` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_annual_year->ViewValue = $rswrk->fields('cal_detail');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_annual_year->ViewValue = $paymentsummary->pay_annual_year->CurrentValue;
				}
			} else {
				$paymentsummary->pay_annual_year->ViewValue = NULL;
			}
			$paymentsummary->pay_annual_year->ViewCustomAttributes = "";

			// pay_sum_detail
			if (strval($paymentsummary->pay_sum_detail->CurrentValue) <> "") {
				$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($paymentsummary->pay_sum_detail->CurrentValue) . "'";
			$sSqlWrk = "SELECT DISTINCT `cal_detail` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`cal_type` = 5";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_detail->ViewValue = $rswrk->fields('cal_detail');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_detail->ViewValue = $paymentsummary->pay_sum_detail->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_detail->ViewValue = NULL;
			}
			$paymentsummary->pay_sum_detail->ViewCustomAttributes = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->ViewValue = $paymentsummary->pay_sum_total->CurrentValue;
			$paymentsummary->pay_sum_total->ViewCustomAttributes = "";

			// pay_sum_note
			$paymentsummary->pay_sum_note->ViewValue = $paymentsummary->pay_sum_note->CurrentValue;
			$paymentsummary->pay_sum_note->ViewCustomAttributes = "";

			// t_code
			$paymentsummary->t_code->LinkCustomAttributes = "";
			$paymentsummary->t_code->HrefValue = "";
			$paymentsummary->t_code->TooltipValue = "";

			// village_id
			$paymentsummary->village_id->LinkCustomAttributes = "";
			$paymentsummary->village_id->HrefValue = "";
			$paymentsummary->village_id->TooltipValue = "";

			// member_code
			$paymentsummary->member_code->LinkCustomAttributes = "";
			$paymentsummary->member_code->HrefValue = "";
			$paymentsummary->member_code->TooltipValue = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_date->HrefValue = "";
			$paymentsummary->pay_sum_date->TooltipValue = "";

			// pay_sum_type
			$paymentsummary->pay_sum_type->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_type->HrefValue = "";
			$paymentsummary->pay_sum_type->TooltipValue = "";

			// pay_death_begin
			$paymentsummary->pay_death_begin->LinkCustomAttributes = "";
			$paymentsummary->pay_death_begin->HrefValue = "";
			$paymentsummary->pay_death_begin->TooltipValue = "";

			// pay_sum_adv_num
			$paymentsummary->pay_sum_adv_num->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_adv_num->HrefValue = "";
			$paymentsummary->pay_sum_adv_num->TooltipValue = "";

			// pay_annual_year
			$paymentsummary->pay_annual_year->LinkCustomAttributes = "";
			$paymentsummary->pay_annual_year->HrefValue = "";
			$paymentsummary->pay_annual_year->TooltipValue = "";

			// pay_sum_detail
			$paymentsummary->pay_sum_detail->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_detail->HrefValue = "";
			$paymentsummary->pay_sum_detail->TooltipValue = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_total->HrefValue = "";
			$paymentsummary->pay_sum_total->TooltipValue = "";

			// pay_sum_note
			$paymentsummary->pay_sum_note->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_note->HrefValue = "";
			$paymentsummary->pay_sum_note->TooltipValue = "";
		} elseif ($paymentsummary->RowType == EW_ROWTYPE_ADD) { // Add row

			// t_code
			$paymentsummary->t_code->EditCustomAttributes = "";
			if ($paymentsummary->t_code->getSessionValue() <> "") {
				$paymentsummary->t_code->CurrentValue = $paymentsummary->t_code->getSessionValue();
				$paymentsummary->t_code->OldValue = $paymentsummary->t_code->CurrentValue;
			if (strval($paymentsummary->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($paymentsummary->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->t_code->ViewValue = $rswrk->fields('t_code');
					$paymentsummary->t_code->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$paymentsummary->t_code->ViewValue = $paymentsummary->t_code->CurrentValue;
				}
			} else {
				$paymentsummary->t_code->ViewValue = NULL;
			}
			$paymentsummary->t_code->ViewCustomAttributes = "";
			} else {
			}

			// village_id
			$paymentsummary->village_id->EditCustomAttributes = "";
			if ($paymentsummary->village_id->getSessionValue() <> "") {
				$paymentsummary->village_id->CurrentValue = $paymentsummary->village_id->getSessionValue();
				$paymentsummary->village_id->OldValue = $paymentsummary->village_id->CurrentValue;
			if (strval($paymentsummary->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($paymentsummary->village_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `v_code`, `v_title` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->village_id->ViewValue = $rswrk->fields('v_code');
					$paymentsummary->village_id->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$paymentsummary->village_id->ViewValue = $paymentsummary->village_id->CurrentValue;
				}
			} else {
				$paymentsummary->village_id->ViewValue = NULL;
			}
			$paymentsummary->village_id->ViewCustomAttributes = "";
			} else {
			}

			// member_code
			$paymentsummary->member_code->EditCustomAttributes = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->EditCustomAttributes = "";
			$paymentsummary->pay_sum_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($paymentsummary->pay_sum_date->CurrentValue, 7));

			// pay_sum_type
			$paymentsummary->pay_sum_type->EditCustomAttributes = 'onchange=showfield(this.options[this.selectedIndex].value);';

			// pay_death_begin
			$paymentsummary->pay_death_begin->EditCustomAttributes = "";

			// pay_sum_adv_num
			$paymentsummary->pay_sum_adv_num->EditCustomAttributes = "";

			// pay_annual_year
			$paymentsummary->pay_annual_year->EditCustomAttributes = "";

			// pay_sum_detail
			$paymentsummary->pay_sum_detail->EditCustomAttributes = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->EditCustomAttributes = "";
			$paymentsummary->pay_sum_total->EditValue = ew_HtmlEncode($paymentsummary->pay_sum_total->CurrentValue);

			// pay_sum_note
			$paymentsummary->pay_sum_note->EditCustomAttributes = "";
			$paymentsummary->pay_sum_note->EditValue = ew_HtmlEncode($paymentsummary->pay_sum_note->CurrentValue);

			// Edit refer script
			// t_code

			$paymentsummary->t_code->HrefValue = "";

			// village_id
			$paymentsummary->village_id->HrefValue = "";

			// member_code
			$paymentsummary->member_code->HrefValue = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->HrefValue = "";

			// pay_sum_type
			$paymentsummary->pay_sum_type->HrefValue = "";

			// pay_death_begin
			$paymentsummary->pay_death_begin->HrefValue = "";

			// pay_sum_adv_num
			$paymentsummary->pay_sum_adv_num->HrefValue = "";

			// pay_annual_year
			$paymentsummary->pay_annual_year->HrefValue = "";

			// pay_sum_detail
			$paymentsummary->pay_sum_detail->HrefValue = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->HrefValue = "";

			// pay_sum_note
			$paymentsummary->pay_sum_note->HrefValue = "";
		} elseif ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// t_code
			$paymentsummary->t_code->EditCustomAttributes = "";
			if (strval($paymentsummary->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($paymentsummary->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->t_code->EditValue = $rswrk->fields('t_code');
					$paymentsummary->t_code->EditValue .= ew_ValueSeparator(0,1,$paymentsummary->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$paymentsummary->t_code->EditValue = $paymentsummary->t_code->CurrentValue;
				}
			} else {
				$paymentsummary->t_code->EditValue = NULL;
			}
			$paymentsummary->t_code->ViewCustomAttributes = "";

			// village_id
			$paymentsummary->village_id->EditCustomAttributes = "";
			if (strval($paymentsummary->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($paymentsummary->village_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `v_code`, `v_title` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->village_id->EditValue = $rswrk->fields('v_code');
					$paymentsummary->village_id->EditValue .= ew_ValueSeparator(0,1,$paymentsummary->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$paymentsummary->village_id->EditValue = $paymentsummary->village_id->CurrentValue;
				}
			} else {
				$paymentsummary->village_id->EditValue = NULL;
			}
			$paymentsummary->village_id->ViewCustomAttributes = "";

			// member_code
			$paymentsummary->member_code->EditCustomAttributes = "";
			if (strval($paymentsummary->member_code->CurrentValue) <> "") {
				$arwrk = explode(",", $paymentsummary->member_code->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`member_code` = '" . ew_AdjustSql(trim($wrk)) . "'";
				}	
			$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` != 'เสียชีวิต' ";;
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `member_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->member_code->EditValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$paymentsummary->member_code->EditValue .= $rswrk->fields('member_code');
						$paymentsummary->member_code->EditValue .= ew_ValueSeparator($ari,1,$paymentsummary->member_code) . $rswrk->fields('fname');
						$paymentsummary->member_code->EditValue .= ew_ValueSeparator($ari,2,$paymentsummary->member_code) . $rswrk->fields('lname');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $paymentsummary->member_code->EditValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$paymentsummary->member_code->EditValue = $paymentsummary->member_code->CurrentValue;
				}
			} else {
				$paymentsummary->member_code->EditValue = NULL;
			}
			$paymentsummary->member_code->ViewCustomAttributes = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->EditCustomAttributes = "";
			$paymentsummary->pay_sum_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($paymentsummary->pay_sum_date->CurrentValue, 7));

			// pay_sum_type
			$paymentsummary->pay_sum_type->EditCustomAttributes = 'onchange=showfield(this.options[this.selectedIndex].value);';
			if (strval($paymentsummary->pay_sum_type->CurrentValue) <> "") {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($paymentsummary->pay_sum_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_type->EditValue = $rswrk->fields('pt_title');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_type->EditValue = $paymentsummary->pay_sum_type->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_type->EditValue = NULL;
			}
			$paymentsummary->pay_sum_type->ViewCustomAttributes = "";

			// pay_death_begin
			$paymentsummary->pay_death_begin->EditCustomAttributes = "";
			if (strval($paymentsummary->pay_death_begin->CurrentValue) <> "") {
				$sFilterWrk = "`dead_id` = " . ew_AdjustSql($paymentsummary->pay_death_begin->CurrentValue) . "";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` = 'เสียชีวิต' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `dead_id` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_death_begin->EditValue = $rswrk->fields('dead_id');
					$paymentsummary->pay_death_begin->EditValue .= ew_ValueSeparator(0,1,$paymentsummary->pay_death_begin) . $rswrk->fields('fname');
					$paymentsummary->pay_death_begin->EditValue .= ew_ValueSeparator(0,2,$paymentsummary->pay_death_begin) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_death_begin->EditValue = $paymentsummary->pay_death_begin->CurrentValue;
				}
			} else {
				$paymentsummary->pay_death_begin->EditValue = NULL;
			}
			$paymentsummary->pay_death_begin->ViewCustomAttributes = "";

			// pay_sum_adv_num
			$paymentsummary->pay_sum_adv_num->EditCustomAttributes = "";
			if (strval($paymentsummary->pay_sum_adv_num->CurrentValue) <> "") {
				$sFilterWrk = "`adv_num` = " . ew_AdjustSql($paymentsummary->pay_sum_adv_num->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `adv_num` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`adv_num` != '0'";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `adv_num`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_adv_num->EditValue = $rswrk->fields('adv_num');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_adv_num->EditValue = $paymentsummary->pay_sum_adv_num->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_adv_num->EditValue = NULL;
			}
			$paymentsummary->pay_sum_adv_num->ViewCustomAttributes = "";

			// pay_annual_year
			$paymentsummary->pay_annual_year->EditCustomAttributes = "";
			if (strval($paymentsummary->pay_annual_year->CurrentValue) <> "") {
				$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($paymentsummary->pay_annual_year->CurrentValue) . "'";
			$sSqlWrk = "SELECT DISTINCT `cal_detail` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`cal_type` = 3";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cal_detail` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_annual_year->EditValue = $rswrk->fields('cal_detail');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_annual_year->EditValue = $paymentsummary->pay_annual_year->CurrentValue;
				}
			} else {
				$paymentsummary->pay_annual_year->EditValue = NULL;
			}
			$paymentsummary->pay_annual_year->ViewCustomAttributes = "";

			// pay_sum_detail
			$paymentsummary->pay_sum_detail->EditCustomAttributes = "";
			if (strval($paymentsummary->pay_sum_detail->CurrentValue) <> "") {
				$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($paymentsummary->pay_sum_detail->CurrentValue) . "'";
			$sSqlWrk = "SELECT DISTINCT `cal_detail` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`cal_type` = 5";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_detail->EditValue = $rswrk->fields('cal_detail');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_detail->EditValue = $paymentsummary->pay_sum_detail->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_detail->EditValue = NULL;
			}
			$paymentsummary->pay_sum_detail->ViewCustomAttributes = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->EditCustomAttributes = "";
			$paymentsummary->pay_sum_total->EditValue = $paymentsummary->pay_sum_total->CurrentValue;
			$paymentsummary->pay_sum_total->ViewCustomAttributes = "";

			// pay_sum_note
			$paymentsummary->pay_sum_note->EditCustomAttributes = "";
			$paymentsummary->pay_sum_note->EditValue = ew_HtmlEncode($paymentsummary->pay_sum_note->CurrentValue);

			// Edit refer script
			// t_code

			$paymentsummary->t_code->HrefValue = "";

			// village_id
			$paymentsummary->village_id->HrefValue = "";

			// member_code
			$paymentsummary->member_code->HrefValue = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->HrefValue = "";

			// pay_sum_type
			$paymentsummary->pay_sum_type->HrefValue = "";

			// pay_death_begin
			$paymentsummary->pay_death_begin->HrefValue = "";

			// pay_sum_adv_num
			$paymentsummary->pay_sum_adv_num->HrefValue = "";

			// pay_annual_year
			$paymentsummary->pay_annual_year->HrefValue = "";

			// pay_sum_detail
			$paymentsummary->pay_sum_detail->HrefValue = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->HrefValue = "";

			// pay_sum_note
			$paymentsummary->pay_sum_note->HrefValue = "";
		}
		if ($paymentsummary->RowType == EW_ROWTYPE_ADD ||
			$paymentsummary->RowType == EW_ROWTYPE_EDIT ||
			$paymentsummary->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$paymentsummary->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($paymentsummary->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$paymentsummary->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $paymentsummary;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($paymentsummary->pay_sum_date->FormValue) && $paymentsummary->pay_sum_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentsummary->pay_sum_date->FldCaption());
		}
		if (!ew_CheckEuroDate($paymentsummary->pay_sum_date->FormValue)) {
			ew_AddMessage($gsFormError, $paymentsummary->pay_sum_date->FldErrMsg());
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
		global $conn, $Language, $Security, $paymentsummary;
		$DeleteRows = TRUE;
		$sSql = $paymentsummary->SQL();
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
				$DeleteRows = $paymentsummary->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['pay_sum_id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($paymentsummary->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($paymentsummary->CancelMessage <> "") {
				$this->setFailureMessage($paymentsummary->CancelMessage);
				$paymentsummary->CancelMessage = "";
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
				$paymentsummary->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $paymentsummary;
		$sFilter = $paymentsummary->KeyFilter();
		$paymentsummary->CurrentFilter = $sFilter;
		$sSql = $paymentsummary->SQL();
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

			// pay_sum_date
			$paymentsummary->pay_sum_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($paymentsummary->pay_sum_date->CurrentValue, 7), NULL, $paymentsummary->pay_sum_date->ReadOnly);

			// pay_sum_note
			$paymentsummary->pay_sum_note->SetDbValueDef($rsnew, $paymentsummary->pay_sum_note->CurrentValue, NULL, $paymentsummary->pay_sum_note->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $paymentsummary->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($paymentsummary->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($paymentsummary->CancelMessage <> "") {
					$this->setFailureMessage($paymentsummary->CancelMessage);
					$paymentsummary->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$paymentsummary->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $paymentsummary;

		// Set up foreign key field value from Session
			if ($paymentsummary->getCurrentMasterTable() == "village") {
				$paymentsummary->village_id->CurrentValue = $paymentsummary->village_id->getSessionValue();
				$paymentsummary->t_code->CurrentValue = $paymentsummary->t_code->getSessionValue();
				$paymentsummary->flag->CurrentValue = $paymentsummary->flag->getSessionValue();
			}
		$rsnew = array();

		// t_code
		$paymentsummary->t_code->SetDbValueDef($rsnew, $paymentsummary->t_code->CurrentValue, "", FALSE);

		// village_id
		$paymentsummary->village_id->SetDbValueDef($rsnew, $paymentsummary->village_id->CurrentValue, 0, FALSE);

		// member_code
		$paymentsummary->member_code->SetDbValueDef($rsnew, $paymentsummary->member_code->CurrentValue, NULL, FALSE);

		// pay_sum_date
		$paymentsummary->pay_sum_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($paymentsummary->pay_sum_date->CurrentValue, 7), NULL, FALSE);

		// pay_sum_type
		$paymentsummary->pay_sum_type->SetDbValueDef($rsnew, $paymentsummary->pay_sum_type->CurrentValue, NULL, FALSE);

		// pay_death_begin
		$paymentsummary->pay_death_begin->SetDbValueDef($rsnew, $paymentsummary->pay_death_begin->CurrentValue, NULL, FALSE);

		// pay_sum_adv_num
		$paymentsummary->pay_sum_adv_num->SetDbValueDef($rsnew, $paymentsummary->pay_sum_adv_num->CurrentValue, 0, FALSE);

		// pay_annual_year
		$paymentsummary->pay_annual_year->SetDbValueDef($rsnew, $paymentsummary->pay_annual_year->CurrentValue, NULL, FALSE);

		// pay_sum_detail
		$paymentsummary->pay_sum_detail->SetDbValueDef($rsnew, $paymentsummary->pay_sum_detail->CurrentValue, NULL, FALSE);

		// pay_sum_total
		$paymentsummary->pay_sum_total->SetDbValueDef($rsnew, $paymentsummary->pay_sum_total->CurrentValue, NULL, strval($paymentsummary->pay_sum_total->CurrentValue) == "");

		// pay_sum_note
		$paymentsummary->pay_sum_note->SetDbValueDef($rsnew, $paymentsummary->pay_sum_note->CurrentValue, NULL, FALSE);

		// flag
		if ($paymentsummary->flag->getSessionValue() <> "") {
			$rsnew['flag'] = $paymentsummary->flag->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $paymentsummary->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($paymentsummary->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($paymentsummary->CancelMessage <> "") {
				$this->setFailureMessage($paymentsummary->CancelMessage);
				$paymentsummary->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$paymentsummary->pay_sum_id->setDbValue($conn->Insert_ID());
			$rsnew['pay_sum_id'] = $paymentsummary->pay_sum_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$paymentsummary->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $paymentsummary;

		// Hide foreign keys
		$sMasterTblVar = $paymentsummary->getCurrentMasterTable();
		if ($sMasterTblVar == "village") {
			$paymentsummary->village_id->Visible = FALSE;
			if ($GLOBALS["village"]->EventCancelled) $paymentsummary->EventCancelled = TRUE;
			$paymentsummary->t_code->Visible = FALSE;
			if ($GLOBALS["village"]->EventCancelled) $paymentsummary->EventCancelled = TRUE;
			$paymentsummary->flag->Visible = FALSE;
			if ($GLOBALS["village"]->EventCancelled) $paymentsummary->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $paymentsummary->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $paymentsummary->getDetailFilter(); // Get detail filter
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
   // global $paymentsummary;         
   // $id = $paymentsummary->pay_sum_id->CurrentValue;  
   // $url = "paymentsummaryadd.php?flag=2";
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
  //  $opt =& $this->ListOptions->Add("new");
  //  $opt->Header = "";
  //  $opt->OnLeft = TRUE; // Link on left
  //  $opt->MoveTo(1); // Move to first column 
}                                                 

		// ListOptions Rendered event
function ListOptions_Rendered() {      

  //  global $paymentsummary;
	// Example: 
  ///  $this->ListOptions->Items["new"]->Body = "<a href='notpaylist.php?pay_sum_id=".$paymentsummary->pay_sum_id->CurrentValue.".'>ชำระทั้งหมด</a>";
}                                                                 


}
?>
