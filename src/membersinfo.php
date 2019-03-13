<?php

// Global variable for table object
$members = NULL;

//
// Table class for members
//
class cmembers {
	var $TableVar = 'members';
	var $TableName = 'members';
	var $TableType = 'TABLE';
	var $member_id;
	var $member_code;
	var $id_code;
	var $prefix;
	var $gender;
	var $fname;
	var $lname;
	var $birthdate;
	var $age;
	var $zemail;
	var $address;
	var $t_code;
	var $village_id;
	var $phone;
	var $suffix;
	var $bnfc1_name;
	var $bnfc1_rel;
	var $bnfc2_name;
	var $bnfc2_rel;
	var $bnfc3_name;
	var $bnfc3_rel;
	var $bnfc4_name;
	var $bnfc4_rel;
	var $regis_date;
	var $effective_date;
	var $attachment;
	var $member_status;
	var $resign_date;
	var $dead_date;
	var $terminate_date;
	var $advance_budget;
	var $dead_id;
	var $note;
	var $update_detail;
	var $member_type;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = FALSE;
	var $ExportPageBreakCount = 0; // Page break per every n record (PDF only)
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes

	// Reset attributes for table object
	function ResetAttrs() {
		$this->CssClass = "";
		$this->CssStyle = "";
    	$this->RowAttrs = array();
		foreach ($this->fields as $fld) {
			$fld->ResetAttrs();
		}
	}

	// Setup field titles
	function SetupFieldTitles() {
		foreach ($this->fields as &$fld) {
			if (strval($fld->FldTitle()) <> "") {
				$fld->EditAttrs["onmouseover"] = "ew_ShowTitle(this, '" . ew_JsEncode3($fld->FldTitle()) . "');";
				$fld->EditAttrs["onmouseout"] = "ew_HideTooltip();";
			}
		}
	}
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $LastAction; // Last action
	var $CurrentMode = ""; // Current mode
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $AllowAddDeleteRow = TRUE; // Allow add/delete row
	var $DetailAdd = TRUE; // Allow detail add
	var $DetailEdit = FALSE; // Allow detail edit
	var $GridAddRowCount = 5;

	// Check current action
	// - Add
	function IsAdd() {
		return $this->CurrentAction == "add";
	}

	// - Copy
	function IsCopy() {
		return $this->CurrentAction == "copy" || $this->CurrentAction == "C";
	}

	// - Edit
	function IsEdit() {
		return $this->CurrentAction == "edit";
	}

	// - Delete
	function IsDelete() {
		return $this->CurrentAction == "D";
	}

	// - Confirm
	function IsConfirm() {
		return $this->CurrentAction == "F";
	}

	// - Overwrite
	function IsOverwrite() {
		return $this->CurrentAction == "overwrite";
	}

	// - Cancel
	function IsCancel() {
		return $this->CurrentAction == "cancel";
	}

	// - Grid add
	function IsGridAdd() {
		return $this->CurrentAction == "gridadd";
	}

	// - Grid edit
	function IsGridEdit() {
		return $this->CurrentAction == "gridedit";
	}

	// - Insert
	function IsInsert() {
		return $this->CurrentAction == "insert" || $this->CurrentAction == "A";
	}

	// - Update
	function IsUpdate() {
		return $this->CurrentAction == "update" || $this->CurrentAction == "U";
	}

	// - Grid update
	function IsGridUpdate() {
		return $this->CurrentAction == "gridupdate";
	}

	// - Grid insert
	function IsGridInsert() {
		return $this->CurrentAction == "gridinsert";
	}

	// - Grid overwrite
	function IsGridOverwrite() {
		return $this->CurrentAction == "gridoverwrite";
	}

	// Check last action
	// - Cancelled
	function IsCanceled() {
		return $this->LastAction == "cancel" && $this->CurrentAction == "";
	}

	// - Inline inserted
	function IsInlineInserted() {
		return $this->LastAction == "insert" && $this->CurrentAction == "";
	}

	// - Inline updated
	function IsInlineUpdated() {
		return $this->LastAction == "update" && $this->CurrentAction == "";
	}

	// - Grid updated
	function IsGridUpdated() {
		return $this->LastAction == "gridupdate" && $this->CurrentAction == "";
	}

	// - Grid inserted
	function IsGridInserted() {
		return $this->LastAction == "gridinsert" && $this->CurrentAction == "";
	}

	//
	// Table class constructor
	//
	function cmembers() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// member_id
		$this->member_id = new cField('members', 'members', 'x_member_id', 'member_id', '`member_id`', 3, -1, FALSE, '`member_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->member_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['member_id'] =& $this->member_id;

		// member_code
		$this->member_code = new cField('members', 'members', 'x_member_code', 'member_code', '`member_code`', 200, -1, FALSE, '`member_code`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['member_code'] =& $this->member_code;

		// id_code
		$this->id_code = new cField('members', 'members', 'x_id_code', 'id_code', '`id_code`', 200, -1, FALSE, '`id_code`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->id_code->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_code'] =& $this->id_code;

		// prefix
		$this->prefix = new cField('members', 'members', 'x_prefix', 'prefix', '`prefix`', 200, -1, FALSE, '`prefix`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['prefix'] =& $this->prefix;

		// gender
		$this->gender = new cField('members', 'members', 'x_gender', 'gender', '`gender`', 200, -1, FALSE, '`gender`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['gender'] =& $this->gender;

		// fname
		$this->fname = new cField('members', 'members', 'x_fname', 'fname', '`fname`', 200, -1, FALSE, '`fname`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['fname'] =& $this->fname;

		// lname
		$this->lname = new cField('members', 'members', 'x_lname', 'lname', '`lname`', 200, -1, FALSE, '`lname`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['lname'] =& $this->lname;

		// birthdate
		$this->birthdate = new cField('members', 'members', 'x_birthdate', 'birthdate', '`birthdate`', 133, 7, FALSE, '`birthdate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->birthdate->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['birthdate'] =& $this->birthdate;

		// age
		$this->age = new cField('members', 'members', 'x_age', 'age', '`age`', 3, -1, FALSE, '`age`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->age->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;

		// email
		$this->zemail = new cField('members', 'members', 'x_zemail', 'email', '`email`', 200, -1, FALSE, '`email`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['email'] =& $this->zemail;

		// address
		$this->address = new cField('members', 'members', 'x_address', 'address', '`address`', 200, -1, FALSE, '`address`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['address'] =& $this->address;

		// t_code
		$this->t_code = new cField('members', 'members', 'x_t_code', 't_code', '`t_code`', 200, -1, FALSE, '`t_code`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->t_code->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['t_code'] =& $this->t_code;

		// village_id
		$this->village_id = new cField('members', 'members', 'x_village_id', 'village_id', '`village_id`', 3, -1, FALSE, '`village_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->village_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;

		// phone
		$this->phone = new cField('members', 'members', 'x_phone', 'phone', '`phone`', 200, -1, FALSE, '`phone`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['phone'] =& $this->phone;

		// suffix
		$this->suffix = new cField('members', 'members', 'x_suffix', 'suffix', '`suffix`', 200, -1, TRUE, '`suffix`', FALSE, FALSE, 'IMAGE');
		$this->suffix->UploadPath = EW_UPLOAD_DEST_PATH;
		$this->fields['suffix'] =& $this->suffix;

		// bnfc1_name
		$this->bnfc1_name = new cField('members', 'members', 'x_bnfc1_name', 'bnfc1_name', '`bnfc1_name`', 200, -1, FALSE, '`bnfc1_name`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['bnfc1_name'] =& $this->bnfc1_name;

		// bnfc1_rel
		$this->bnfc1_rel = new cField('members', 'members', 'x_bnfc1_rel', 'bnfc1_rel', '`bnfc1_rel`', 200, -1, FALSE, '`bnfc1_rel`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['bnfc1_rel'] =& $this->bnfc1_rel;

		// bnfc2_name
		$this->bnfc2_name = new cField('members', 'members', 'x_bnfc2_name', 'bnfc2_name', '`bnfc2_name`', 200, -1, FALSE, '`bnfc2_name`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['bnfc2_name'] =& $this->bnfc2_name;

		// bnfc2_rel
		$this->bnfc2_rel = new cField('members', 'members', 'x_bnfc2_rel', 'bnfc2_rel', '`bnfc2_rel`', 200, -1, FALSE, '`bnfc2_rel`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['bnfc2_rel'] =& $this->bnfc2_rel;

		// bnfc3_name
		$this->bnfc3_name = new cField('members', 'members', 'x_bnfc3_name', 'bnfc3_name', '`bnfc3_name`', 200, -1, FALSE, '`bnfc3_name`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['bnfc3_name'] =& $this->bnfc3_name;

		// bnfc3_rel
		$this->bnfc3_rel = new cField('members', 'members', 'x_bnfc3_rel', 'bnfc3_rel', '`bnfc3_rel`', 200, -1, FALSE, '`bnfc3_rel`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['bnfc3_rel'] =& $this->bnfc3_rel;

		// bnfc4_name
		$this->bnfc4_name = new cField('members', 'members', 'x_bnfc4_name', 'bnfc4_name', '`bnfc4_name`', 200, -1, FALSE, '`bnfc4_name`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['bnfc4_name'] =& $this->bnfc4_name;

		// bnfc4_rel
		$this->bnfc4_rel = new cField('members', 'members', 'x_bnfc4_rel', 'bnfc4_rel', '`bnfc4_rel`', 200, -1, FALSE, '`bnfc4_rel`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['bnfc4_rel'] =& $this->bnfc4_rel;

		// regis_date
		$this->regis_date = new cField('members', 'members', 'x_regis_date', 'regis_date', '`regis_date`', 133, 7, FALSE, '`regis_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->regis_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['regis_date'] =& $this->regis_date;

		// effective_date
		$this->effective_date = new cField('members', 'members', 'x_effective_date', 'effective_date', '`effective_date`', 133, 7, FALSE, '`effective_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->effective_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['effective_date'] =& $this->effective_date;

		// attachment
		$this->attachment = new cField('members', 'members', 'x_attachment', 'attachment', '`attachment`', 200, -1, FALSE, '`attachment`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['attachment'] =& $this->attachment;

		// member_status
		$this->member_status = new cField('members', 'members', 'x_member_status', 'member_status', '`member_status`', 200, -1, FALSE, '`member_status`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->member_status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['member_status'] =& $this->member_status;

		// resign_date
		$this->resign_date = new cField('members', 'members', 'x_resign_date', 'resign_date', '`resign_date`', 133, 7, FALSE, '`resign_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->resign_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['resign_date'] =& $this->resign_date;

		// dead_date
		$this->dead_date = new cField('members', 'members', 'x_dead_date', 'dead_date', '`dead_date`', 133, 7, FALSE, '`dead_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->dead_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['dead_date'] =& $this->dead_date;

		// terminate_date
		$this->terminate_date = new cField('members', 'members', 'x_terminate_date', 'terminate_date', '`terminate_date`', 133, 7, FALSE, '`terminate_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->terminate_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['terminate_date'] =& $this->terminate_date;

		// advance_budget
		$this->advance_budget = new cField('members', 'members', 'x_advance_budget', 'advance_budget', '`advance_budget`', 4, -1, FALSE, '`advance_budget`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->advance_budget->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['advance_budget'] =& $this->advance_budget;

		// dead_id
		$this->dead_id = new cField('members', 'members', 'x_dead_id', 'dead_id', '`dead_id`', 3, -1, FALSE, '`dead_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->dead_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['dead_id'] =& $this->dead_id;

		// note
		$this->note = new cField('members', 'members', 'x_note', 'note', '`note`', 201, -1, FALSE, '`note`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['note'] =& $this->note;

		// update_detail
		$this->update_detail = new cField('members', 'members', 'x_update_detail', 'update_detail', '`update_detail`', 201, -1, FALSE, '`update_detail`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['update_detail'] =& $this->update_detail;

		// member_type
		$this->member_type = new cField('members', 'members', 'x_member_type', 'member_type', '`member_type`', 3, -1, FALSE, '`member_type`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->member_type->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['member_type'] =& $this->member_type;
	}

	// Get field values
	function GetFieldValues($propertyname) {
		$values = array();
		foreach ($this->fields as $fldname => $fld)
			$values[$fldname] =& $fld->$propertyname;
		return $values;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "members_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Current detail table name
	function getCurrentDetailTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE];
	}

	function setCurrentDetailTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	function getDetailUrl() {

		// Detail url
		$sDetailUrl = "";
		if ($this->getCurrentDetailTable() == "memberupdatelog") {
			$sDetailUrl = $GLOBALS["memberupdatelog"]->ListUrl() . "?showmaster=" . $this->TableVar;
			$sDetailUrl .= "&member_code=" . $this->member_code->CurrentValue;
		}
		return $sDetailUrl;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`members`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `members` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `members` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `members` WHERE ";
		$SQL .= ew_QuotedName('member_id') . '=' . ew_QuotedValue($rs['member_id'], $this->member_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`member_id` = @member_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->member_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@member_id@", ew_AdjustSql($this->member_id->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "memberslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "memberslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("membersview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "membersadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("membersedit.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("membersedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("membersadd.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("membersadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("membersdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->member_id->CurrentValue)) {
			$sUrl .= "member_id=" . urlencode($this->member_id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=members" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {
			$arKeys[] = @$_GET["member_id"]; // member_id

			//return $arKeys; // do not return yet, so the values will also be checked by the following code
		}

		// check keys
		$ar = array();
		foreach ($arKeys as $key) {
			if (!is_numeric($key))
				continue;
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->member_id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->member_id->setDbValue($rs->fields('member_id'));
		$this->member_code->setDbValue($rs->fields('member_code'));
		$this->id_code->setDbValue($rs->fields('id_code'));
		$this->prefix->setDbValue($rs->fields('prefix'));
		$this->gender->setDbValue($rs->fields('gender'));
		$this->fname->setDbValue($rs->fields('fname'));
		$this->lname->setDbValue($rs->fields('lname'));
		$this->birthdate->setDbValue($rs->fields('birthdate'));
		$this->age->setDbValue($rs->fields('age'));
		$this->zemail->setDbValue($rs->fields('email'));
		$this->address->setDbValue($rs->fields('address'));
		$this->t_code->setDbValue($rs->fields('t_code'));
		$this->village_id->setDbValue($rs->fields('village_id'));
		$this->phone->setDbValue($rs->fields('phone'));
		$this->suffix->Upload->DbValue = $rs->fields('suffix');
		$this->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
		$this->bnfc1_rel->setDbValue($rs->fields('bnfc1_rel'));
		$this->bnfc2_name->setDbValue($rs->fields('bnfc2_name'));
		$this->bnfc2_rel->setDbValue($rs->fields('bnfc2_rel'));
		$this->bnfc3_name->setDbValue($rs->fields('bnfc3_name'));
		$this->bnfc3_rel->setDbValue($rs->fields('bnfc3_rel'));
		$this->bnfc4_name->setDbValue($rs->fields('bnfc4_name'));
		$this->bnfc4_rel->setDbValue($rs->fields('bnfc4_rel'));
		$this->regis_date->setDbValue($rs->fields('regis_date'));
		$this->effective_date->setDbValue($rs->fields('effective_date'));
		$this->attachment->setDbValue($rs->fields('attachment'));
		$this->member_status->setDbValue($rs->fields('member_status'));
		$this->resign_date->setDbValue($rs->fields('resign_date'));
		$this->dead_date->setDbValue($rs->fields('dead_date'));
		$this->terminate_date->setDbValue($rs->fields('terminate_date'));
		$this->advance_budget->setDbValue($rs->fields('advance_budget'));
		$this->dead_id->setDbValue($rs->fields('dead_id'));
		$this->note->setDbValue($rs->fields('note'));
		$this->update_detail->setDbValue($rs->fields('update_detail'));
		$this->member_type->setDbValue($rs->fields('member_type'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// member_id

		$this->member_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		// id_code
		// prefix
		// gender
		// fname

		$this->fname->CellCssStyle = "white-space: nowrap;";

		// lname
		$this->lname->CellCssStyle = "white-space: nowrap;";

		// birthdate
		// age
		// email

		$this->zemail->CellCssStyle = "white-space: nowrap;";

		// address
		// t_code

		$this->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$this->village_id->CellCssStyle = "white-space: nowrap;";

		// phone
		// suffix

		$this->suffix->CellCssStyle = "white-space: nowrap;";

		// bnfc1_name
		$this->bnfc1_name->CellCssStyle = "white-space: nowrap;";

		// bnfc1_rel
		$this->bnfc1_rel->CellCssStyle = "white-space: nowrap;";

		// bnfc2_name
		$this->bnfc2_name->CellCssStyle = "white-space: nowrap;";

		// bnfc2_rel
		$this->bnfc2_rel->CellCssStyle = "white-space: nowrap;";

		// bnfc3_name
		$this->bnfc3_name->CellCssStyle = "white-space: nowrap;";

		// bnfc3_rel
		$this->bnfc3_rel->CellCssStyle = "white-space: nowrap;";

		// bnfc4_name
		$this->bnfc4_name->CellCssStyle = "white-space: nowrap;";

		// bnfc4_rel
		$this->bnfc4_rel->CellCssStyle = "white-space: nowrap;";

		// regis_date
		// effective_date
		// attachment

		$this->attachment->CellCssStyle = "white-space: nowrap;";

		// member_status
		$this->member_status->CellCssStyle = "white-space: nowrap;";

		// resign_date
		$this->resign_date->CellCssStyle = "white-space: nowrap;";

		// dead_date
		$this->dead_date->CellCssStyle = "white-space: nowrap;";

		// terminate_date
		$this->terminate_date->CellCssStyle = "white-space: nowrap;";

		// advance_budget
		$this->advance_budget->CellCssStyle = "white-space: nowrap;";

		// dead_id
		$this->dead_id->CellCssStyle = "white-space: nowrap;";

		// note
		// update_detail

		$this->update_detail->CellCssStyle = "white-space: nowrap;";

		// member_type
		$this->member_type->CellCssStyle = "white-space: nowrap;";

		// member_id
		$this->member_id->ViewValue = $this->member_id->CurrentValue;
		$this->member_id->ViewCustomAttributes = "";

		// member_code
		$this->member_code->ViewValue = $this->member_code->CurrentValue;
		$this->member_code->ViewCustomAttributes = "";

		// id_code
		$this->id_code->ViewValue = $this->id_code->CurrentValue;
		$this->id_code->ViewCustomAttributes = "";

		// prefix
		if (strval($this->prefix->CurrentValue) <> "") {
			$sFilterWrk = "`p_title` = '" . ew_AdjustSql($this->prefix->CurrentValue) . "'";
		$sSqlWrk = "SELECT `p_title` FROM `prefix`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->prefix->ViewValue = $rswrk->fields('p_title');
				$rswrk->Close();
			} else {
				$this->prefix->ViewValue = $this->prefix->CurrentValue;
			}
		} else {
			$this->prefix->ViewValue = NULL;
		}
		$this->prefix->ViewCustomAttributes = "";

		// gender
		if (strval($this->gender->CurrentValue) <> "") {
			$sFilterWrk = "`g_title` = '" . ew_AdjustSql($this->gender->CurrentValue) . "'";
		$sSqlWrk = "SELECT `g_title` FROM `gender`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->gender->ViewValue = $rswrk->fields('g_title');
				$rswrk->Close();
			} else {
				$this->gender->ViewValue = $this->gender->CurrentValue;
			}
		} else {
			$this->gender->ViewValue = NULL;
		}
		$this->gender->ViewCustomAttributes = "";

		// fname
		$this->fname->ViewValue = $this->fname->CurrentValue;
		$this->fname->ViewCustomAttributes = "";

		// lname
		$this->lname->ViewValue = $this->lname->CurrentValue;
		$this->lname->ViewCustomAttributes = "";

		// birthdate
		$this->birthdate->ViewValue = $this->birthdate->CurrentValue;
		$this->birthdate->ViewValue = ew_FormatDateTime($this->birthdate->ViewValue, 7);
		$this->birthdate->ViewCustomAttributes = "";

		// age
		$this->age->ViewValue = $this->age->CurrentValue;
		$this->age->ViewCustomAttributes = "";

		// email
		$this->zemail->ViewValue = $this->zemail->CurrentValue;
		$this->zemail->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->ViewCustomAttributes = "";

		// t_code
		if (strval($this->t_code->CurrentValue) <> "") {
			$sFilterWrk = "`t_code` = '" . ew_AdjustSql($this->t_code->CurrentValue) . "'";
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
				$this->t_code->ViewValue = $rswrk->fields('t_code');
				$this->t_code->ViewValue .= ew_ValueSeparator(0,1,$this->t_code) . $rswrk->fields('t_title');
				$rswrk->Close();
			} else {
				$this->t_code->ViewValue = $this->t_code->CurrentValue;
			}
		} else {
			$this->t_code->ViewValue = NULL;
		}
		$this->t_code->ViewCustomAttributes = "";

		// village_id
		if (strval($this->village_id->CurrentValue) <> "") {
			$sFilterWrk = "`village_id` = " . ew_AdjustSql($this->village_id->CurrentValue) . "";
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
				$this->village_id->ViewValue = $rswrk->fields('v_code');
				$this->village_id->ViewValue .= ew_ValueSeparator(0,1,$this->village_id) . $rswrk->fields('v_title');
				$rswrk->Close();
			} else {
				$this->village_id->ViewValue = $this->village_id->CurrentValue;
			}
		} else {
			$this->village_id->ViewValue = NULL;
		}
		$this->village_id->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// suffix
		if (!ew_Empty($this->suffix->Upload->DbValue)) {
			$this->suffix->ViewValue = $this->suffix->Upload->DbValue;
			$this->suffix->ImageAlt = $this->suffix->FldAlt();
		} else {
			$this->suffix->ViewValue = "";
		}
		$this->suffix->ViewCustomAttributes = "";

		// bnfc1_name
		$this->bnfc1_name->ViewValue = $this->bnfc1_name->CurrentValue;
		$this->bnfc1_name->ViewCustomAttributes = "";

		// bnfc1_rel
		$this->bnfc1_rel->ViewValue = $this->bnfc1_rel->CurrentValue;
		$this->bnfc1_rel->ViewCustomAttributes = "";

		// bnfc2_name
		$this->bnfc2_name->ViewValue = $this->bnfc2_name->CurrentValue;
		$this->bnfc2_name->ViewCustomAttributes = "";

		// bnfc2_rel
		$this->bnfc2_rel->ViewValue = $this->bnfc2_rel->CurrentValue;
		$this->bnfc2_rel->ViewCustomAttributes = "";

		// bnfc3_name
		$this->bnfc3_name->ViewValue = $this->bnfc3_name->CurrentValue;
		$this->bnfc3_name->ViewCustomAttributes = "";

		// bnfc3_rel
		$this->bnfc3_rel->ViewValue = $this->bnfc3_rel->CurrentValue;
		$this->bnfc3_rel->ViewCustomAttributes = "";

		// bnfc4_name
		$this->bnfc4_name->ViewValue = $this->bnfc4_name->CurrentValue;
		$this->bnfc4_name->ViewCustomAttributes = "";

		// bnfc4_rel
		$this->bnfc4_rel->ViewValue = $this->bnfc4_rel->CurrentValue;
		$this->bnfc4_rel->ViewCustomAttributes = "";

		// regis_date
		$this->regis_date->ViewValue = $this->regis_date->CurrentValue;
		$this->regis_date->ViewValue = ew_FormatDateTime($this->regis_date->ViewValue, 7);
		$this->regis_date->ViewCustomAttributes = "";

		// effective_date
		$this->effective_date->ViewValue = $this->effective_date->CurrentValue;
		$this->effective_date->ViewValue = ew_FormatDateTime($this->effective_date->ViewValue, 7);
		$this->effective_date->ViewCustomAttributes = "";

		// attachment
		$this->attachment->ViewValue = $this->attachment->CurrentValue;
		$this->attachment->ViewCustomAttributes = "";

		// member_status
		if (strval($this->member_status->CurrentValue) <> "") {
			$sFilterWrk = "`s_title` = '" . ew_AdjustSql($this->member_status->CurrentValue) . "'";
		$sSqlWrk = "SELECT `s_title` FROM `memberstatus`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->member_status->ViewValue = $rswrk->fields('s_title');
				$rswrk->Close();
			} else {
				$this->member_status->ViewValue = $this->member_status->CurrentValue;
			}
		} else {
			$this->member_status->ViewValue = NULL;
		}
		$this->member_status->ViewCustomAttributes = "";

		// resign_date
		$this->resign_date->ViewValue = $this->resign_date->CurrentValue;
		$this->resign_date->ViewValue = ew_FormatDateTime($this->resign_date->ViewValue, 7);
		$this->resign_date->ViewCustomAttributes = "";

		// dead_date
		$this->dead_date->ViewValue = $this->dead_date->CurrentValue;
		$this->dead_date->ViewValue = ew_FormatDateTime($this->dead_date->ViewValue, 7);
		$this->dead_date->ViewCustomAttributes = "";

		// terminate_date
		$this->terminate_date->ViewValue = $this->terminate_date->CurrentValue;
		$this->terminate_date->ViewValue = ew_FormatDateTime($this->terminate_date->ViewValue, 7);
		$this->terminate_date->ViewCustomAttributes = "";

		// advance_budget
		$this->advance_budget->ViewValue = $this->advance_budget->CurrentValue;
		$this->advance_budget->ViewCustomAttributes = "";

		// dead_id
		$this->dead_id->ViewValue = $this->dead_id->CurrentValue;
		$this->dead_id->ViewCustomAttributes = "";

		// note
		$this->note->ViewValue = $this->note->CurrentValue;
		$this->note->ViewCustomAttributes = "";

		// update_detail
		$this->update_detail->ViewValue = $this->update_detail->CurrentValue;
		$this->update_detail->ViewCustomAttributes = "";

		// member_type
		$this->member_type->ViewValue = $this->member_type->CurrentValue;
		$this->member_type->ViewCustomAttributes = "";

		// member_id
		$this->member_id->LinkCustomAttributes = "";
		$this->member_id->HrefValue = "";
		$this->member_id->TooltipValue = "";

		// member_code
		$this->member_code->LinkCustomAttributes = "";
		$this->member_code->HrefValue = "";
		$this->member_code->TooltipValue = "";

		// id_code
		$this->id_code->LinkCustomAttributes = "";
		$this->id_code->HrefValue = "";
		$this->id_code->TooltipValue = "";

		// prefix
		$this->prefix->LinkCustomAttributes = "";
		$this->prefix->HrefValue = "";
		$this->prefix->TooltipValue = "";

		// gender
		$this->gender->LinkCustomAttributes = "";
		$this->gender->HrefValue = "";
		$this->gender->TooltipValue = "";

		// fname
		$this->fname->LinkCustomAttributes = "";
		$this->fname->HrefValue = "";
		$this->fname->TooltipValue = "";

		// lname
		$this->lname->LinkCustomAttributes = "";
		$this->lname->HrefValue = "";
		$this->lname->TooltipValue = "";

		// birthdate
		$this->birthdate->LinkCustomAttributes = "";
		$this->birthdate->HrefValue = "";
		$this->birthdate->TooltipValue = "";

		// age
		$this->age->LinkCustomAttributes = "";
		$this->age->HrefValue = "";
		$this->age->TooltipValue = "";

		// email
		$this->zemail->LinkCustomAttributes = "";
		$this->zemail->HrefValue = "";
		$this->zemail->TooltipValue = "";

		// address
		$this->address->LinkCustomAttributes = "";
		$this->address->HrefValue = "";
		$this->address->TooltipValue = "";

		// t_code
		$this->t_code->LinkCustomAttributes = "";
		$this->t_code->HrefValue = "";
		$this->t_code->TooltipValue = "";

		// village_id
		$this->village_id->LinkCustomAttributes = "";
		$this->village_id->HrefValue = "";
		$this->village_id->TooltipValue = "";

		// phone
		$this->phone->LinkCustomAttributes = "";
		$this->phone->HrefValue = "";
		$this->phone->TooltipValue = "";

		// suffix
		$this->suffix->LinkCustomAttributes = "";
		$this->suffix->HrefValue = "";
		$this->suffix->TooltipValue = "";

		// bnfc1_name
		$this->bnfc1_name->LinkCustomAttributes = "";
		$this->bnfc1_name->HrefValue = "";
		$this->bnfc1_name->TooltipValue = "";

		// bnfc1_rel
		$this->bnfc1_rel->LinkCustomAttributes = "";
		$this->bnfc1_rel->HrefValue = "";
		$this->bnfc1_rel->TooltipValue = "";

		// bnfc2_name
		$this->bnfc2_name->LinkCustomAttributes = "";
		$this->bnfc2_name->HrefValue = "";
		$this->bnfc2_name->TooltipValue = "";

		// bnfc2_rel
		$this->bnfc2_rel->LinkCustomAttributes = "";
		$this->bnfc2_rel->HrefValue = "";
		$this->bnfc2_rel->TooltipValue = "";

		// bnfc3_name
		$this->bnfc3_name->LinkCustomAttributes = "";
		$this->bnfc3_name->HrefValue = "";
		$this->bnfc3_name->TooltipValue = "";

		// bnfc3_rel
		$this->bnfc3_rel->LinkCustomAttributes = "";
		$this->bnfc3_rel->HrefValue = "";
		$this->bnfc3_rel->TooltipValue = "";

		// bnfc4_name
		$this->bnfc4_name->LinkCustomAttributes = "";
		$this->bnfc4_name->HrefValue = "";
		$this->bnfc4_name->TooltipValue = "";

		// bnfc4_rel
		$this->bnfc4_rel->LinkCustomAttributes = "";
		$this->bnfc4_rel->HrefValue = "";
		$this->bnfc4_rel->TooltipValue = "";

		// regis_date
		$this->regis_date->LinkCustomAttributes = "";
		$this->regis_date->HrefValue = "";
		$this->regis_date->TooltipValue = "";

		// effective_date
		$this->effective_date->LinkCustomAttributes = "";
		$this->effective_date->HrefValue = "";
		$this->effective_date->TooltipValue = "";

		// attachment
		$this->attachment->LinkCustomAttributes = "";
		$this->attachment->HrefValue = "";
		$this->attachment->TooltipValue = "";

		// member_status
		$this->member_status->LinkCustomAttributes = "";
		$this->member_status->HrefValue = "";
		$this->member_status->TooltipValue = "";

		// resign_date
		$this->resign_date->LinkCustomAttributes = "";
		$this->resign_date->HrefValue = "";
		$this->resign_date->TooltipValue = "";

		// dead_date
		$this->dead_date->LinkCustomAttributes = "";
		$this->dead_date->HrefValue = "";
		$this->dead_date->TooltipValue = "";

		// terminate_date
		$this->terminate_date->LinkCustomAttributes = "";
		$this->terminate_date->HrefValue = "";
		$this->terminate_date->TooltipValue = "";

		// advance_budget
		$this->advance_budget->LinkCustomAttributes = "";
		$this->advance_budget->HrefValue = "";
		$this->advance_budget->TooltipValue = "";

		// dead_id
		$this->dead_id->LinkCustomAttributes = "";
		$this->dead_id->HrefValue = "";
		$this->dead_id->TooltipValue = "";

		// note
		$this->note->LinkCustomAttributes = "";
		$this->note->HrefValue = "";
		$this->note->TooltipValue = "";

		// update_detail
		$this->update_detail->LinkCustomAttributes = "";
		$this->update_detail->HrefValue = "";
		$this->update_detail->TooltipValue = "";

		// member_type
		$this->member_type->LinkCustomAttributes = "";
		$this->member_type->HrefValue = "";
		$this->member_type->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Export data in Xml Format
	function ExportXmlDocument(&$XmlDoc, $HasParent, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$XmlDoc)
			return;
		if (!$HasParent)
			$XmlDoc->AddRoot($this->TableVar);

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if ($HasParent)
					$XmlDoc->AddRow($this->TableVar);
				else
					$XmlDoc->AddRow();
				if ($ExportPageType == "view") {
					$XmlDoc->AddField('member_code', $this->member_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('id_code', $this->id_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('prefix', $this->prefix->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('gender', $this->gender->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('fname', $this->fname->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('lname', $this->lname->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('birthdate', $this->birthdate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('age', $this->age->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('address', $this->address->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('t_code', $this->t_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('village_id', $this->village_id->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('phone', $this->phone->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('bnfc1_name', $this->bnfc1_name->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('bnfc1_rel', $this->bnfc1_rel->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('bnfc2_name', $this->bnfc2_name->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('bnfc2_rel', $this->bnfc2_rel->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('bnfc3_name', $this->bnfc3_name->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('bnfc3_rel', $this->bnfc3_rel->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('regis_date', $this->regis_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('effective_date', $this->effective_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('member_status', $this->member_status->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('resign_date', $this->resign_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('dead_date', $this->dead_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('terminate_date', $this->terminate_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('dead_id', $this->dead_id->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('note', $this->note->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('member_code', $this->member_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('id_code', $this->id_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('prefix', $this->prefix->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('gender', $this->gender->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('fname', $this->fname->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('lname', $this->lname->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('birthdate', $this->birthdate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('age', $this->age->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('address', $this->address->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('t_code', $this->t_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('village_id', $this->village_id->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('phone', $this->phone->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('bnfc1_name', $this->bnfc1_name->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('bnfc1_rel', $this->bnfc1_rel->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('bnfc2_name', $this->bnfc2_name->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('bnfc2_rel', $this->bnfc2_rel->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('bnfc3_name', $this->bnfc3_name->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('bnfc3_rel', $this->bnfc3_rel->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('regis_date', $this->regis_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('effective_date', $this->effective_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('attachment', $this->attachment->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('member_status', $this->member_status->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('resign_date', $this->resign_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('dead_date', $this->dead_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('terminate_date', $this->terminate_date->ExportValue($this->Export, $this->ExportOriginalValue));
				}
			}
			$Recordset->MoveNext();
		}
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;

		// Write header
		$Doc->ExportTableHeader();
		if ($Doc->Horizontal) { // Horizontal format, write header
			$Doc->BeginExportRow();
			if ($ExportPageType == "view") {
				$Doc->ExportCaption($this->member_code);
				$Doc->ExportCaption($this->id_code);
				$Doc->ExportCaption($this->prefix);
				$Doc->ExportCaption($this->gender);
				$Doc->ExportCaption($this->fname);
				$Doc->ExportCaption($this->lname);
				$Doc->ExportCaption($this->birthdate);
				$Doc->ExportCaption($this->age);
				$Doc->ExportCaption($this->address);
				$Doc->ExportCaption($this->t_code);
				$Doc->ExportCaption($this->village_id);
				$Doc->ExportCaption($this->phone);
				$Doc->ExportCaption($this->bnfc1_name);
				$Doc->ExportCaption($this->bnfc1_rel);
				$Doc->ExportCaption($this->bnfc2_name);
				$Doc->ExportCaption($this->bnfc2_rel);
				$Doc->ExportCaption($this->bnfc3_name);
				$Doc->ExportCaption($this->bnfc3_rel);
				$Doc->ExportCaption($this->regis_date);
				$Doc->ExportCaption($this->effective_date);
				$Doc->ExportCaption($this->member_status);
				$Doc->ExportCaption($this->resign_date);
				$Doc->ExportCaption($this->dead_date);
				$Doc->ExportCaption($this->terminate_date);
				$Doc->ExportCaption($this->dead_id);
				$Doc->ExportCaption($this->note);
			} else {
				$Doc->ExportCaption($this->member_code);
				$Doc->ExportCaption($this->id_code);
				$Doc->ExportCaption($this->prefix);
				$Doc->ExportCaption($this->gender);
				$Doc->ExportCaption($this->fname);
				$Doc->ExportCaption($this->lname);
				$Doc->ExportCaption($this->birthdate);
				$Doc->ExportCaption($this->age);
				$Doc->ExportCaption($this->address);
				$Doc->ExportCaption($this->t_code);
				$Doc->ExportCaption($this->village_id);
				$Doc->ExportCaption($this->phone);
				$Doc->ExportCaption($this->bnfc1_name);
				$Doc->ExportCaption($this->bnfc1_rel);
				$Doc->ExportCaption($this->bnfc2_name);
				$Doc->ExportCaption($this->bnfc2_rel);
				$Doc->ExportCaption($this->bnfc3_name);
				$Doc->ExportCaption($this->bnfc3_rel);
				$Doc->ExportCaption($this->regis_date);
				$Doc->ExportCaption($this->effective_date);
				$Doc->ExportCaption($this->attachment);
				$Doc->ExportCaption($this->member_status);
				$Doc->ExportCaption($this->resign_date);
				$Doc->ExportCaption($this->dead_date);
				$Doc->ExportCaption($this->terminate_date);
			}
			if ($this->Export == "pdf") {
				$Doc->EndExportRow(TRUE);
			} else {
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break for PDF
				if ($this->Export == "pdf" && $this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
				if ($ExportPageType == "view") {
					$Doc->ExportField($this->member_code);
					$Doc->ExportField($this->id_code);
					$Doc->ExportField($this->prefix);
					$Doc->ExportField($this->gender);
					$Doc->ExportField($this->fname);
					$Doc->ExportField($this->lname);
					$Doc->ExportField($this->birthdate);
					$Doc->ExportField($this->age);
					$Doc->ExportField($this->address);
					$Doc->ExportField($this->t_code);
					$Doc->ExportField($this->village_id);
					$Doc->ExportField($this->phone);
					$Doc->ExportField($this->bnfc1_name);
					$Doc->ExportField($this->bnfc1_rel);
					$Doc->ExportField($this->bnfc2_name);
					$Doc->ExportField($this->bnfc2_rel);
					$Doc->ExportField($this->bnfc3_name);
					$Doc->ExportField($this->bnfc3_rel);
					$Doc->ExportField($this->regis_date);
					$Doc->ExportField($this->effective_date);
					$Doc->ExportField($this->member_status);
					$Doc->ExportField($this->resign_date);
					$Doc->ExportField($this->dead_date);
					$Doc->ExportField($this->terminate_date);
					$Doc->ExportField($this->dead_id);
					$Doc->ExportField($this->note);
				} else {
					$Doc->ExportField($this->member_code);
					$Doc->ExportField($this->id_code);
					$Doc->ExportField($this->prefix);
					$Doc->ExportField($this->gender);
					$Doc->ExportField($this->fname);
					$Doc->ExportField($this->lname);
					$Doc->ExportField($this->birthdate);
					$Doc->ExportField($this->age);
					$Doc->ExportField($this->address);
					$Doc->ExportField($this->t_code);
					$Doc->ExportField($this->village_id);
					$Doc->ExportField($this->phone);
					$Doc->ExportField($this->bnfc1_name);
					$Doc->ExportField($this->bnfc1_rel);
					$Doc->ExportField($this->bnfc2_name);
					$Doc->ExportField($this->bnfc2_rel);
					$Doc->ExportField($this->bnfc3_name);
					$Doc->ExportField($this->bnfc3_rel);
					$Doc->ExportField($this->regis_date);
					$Doc->ExportField($this->effective_date);
					$Doc->ExportField($this->attachment);
					$Doc->ExportField($this->member_status);
					$Doc->ExportField($this->resign_date);
					$Doc->ExportField($this->dead_date);
					$Doc->ExportField($this->terminate_date);
				}
				$Doc->EndExportRow();
			}
			$Recordset->MoveNext();
		}
		$Doc->ExportTableFooter();
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

		    function Row_Inserting(&$rsold, &$rsnew) {  
			$setting = getSetting(); 
			$maxage = $setting[0]['max_age'];
			$age = getAge($rsnew['birthdate']); 
			if ($maxage > 0){                       
				if ($age  > $maxage) { 
					  CurrentPage()->setFailureMessage("อายุผู้สมัครต้องไม่เกิน".$maxage."  ปี");    
					  return false;                                   
				 }else {
					 $rsnew['age'] = $age; 
				 }
			}

			// To cancel, set return value to False          
			return TRUE;
		}                                  

		                // Row Inserted event  
	function Row_Inserted($rsold, &$rsnew) {
		global $conn;
		// $conn->Execute("UPDATE members SET member_code = '".date('ymd')."' WHERE member_id =".$rsnew["member_id"]); 
		 $conn->Execute("INSERT INTO memberstatuslist SET status = '".$rsnew['member_status']."',member_id =".$rsnew['member_id'].",mbs_date ='".$rsnew["regis_date"]."',mbs_detail ='-'");
		 $age = getAge($rsnew['birthdate']); 
		 $rsnew['age'] = $age;
	}                                                                                                                                   

		    // Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE
	   $age = getAge($rsnew['birthdate']); 
	   $rsnew['age'] = $age;    
	   $maxage = $setting[0]['max_age']; 
								  
		  if ($maxage > 0){  
			if ($age  > $maxage) { 
				  CurrentPage()->setFailureMessage("อายุผู้สมัครต้องไม่เกิน".$maxage."  ปี");    
				  return false;                                   
			 }else {
				 $rsnew['age'] = $age; 
			 }
		}   
		return TRUE;
	}

		                // Row Updated event    
function Row_Updated($rsold, &$rsnew) {
		global $conn;
			if ($rsnew['member_status'] == 'เสียชีวิต'){    
				$dnum = ew_ExecuteScalar("SELECT MAX(dead_id) FROM members");
				$conn->Execute("UPDATE members SET dead_id = ".($dnum+1)." WHERE member_id = ".$rsold['member_id']);
				calculatesubvention($rsold['member_id']); 

			   // calculateLowerAdvSubv();
			} else if ($rsnew['member_status'] == 'ลาออก'){       
				calculateresign  ($rsold['member_code']);
			} else if ($rsnew['member_status'] == 'พ้นสภาพ'){    
				calculateterminate($rsold['member_id']);         
			} else if ($rsnew['member_status'] == 'ปกติ'){  
				calculatenormal();            
			}  
			 updatememberlog($rsold['member_code'],$rsnew['update_detail'],ew_CurrentDate(),CurrentUserName());   
			 $rsnew['update_detail']="";
		}                                                                                                                             

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}
}
?>
