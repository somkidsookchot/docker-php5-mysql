<?php

// Global variable for table object
$paymentsummary = NULL;

//
// Table class for paymentsummary
//
class cpaymentsummary {
	var $TableVar = 'paymentsummary';
	var $TableName = 'paymentsummary';
	var $TableType = 'TABLE';
	var $pay_sum_id;
	var $t_code;
	var $village_id;
	var $member_code;
	var $pay_sum_date;
	var $pay_sum_type;
	var $pay_death_begin;
	var $pay_sum_adv_count;
	var $pay_sum_adv_num;
	var $pay_death_end;
	var $pay_annual_year;
	var $pay_sum_detail;
	var $pay_sum_total;
	var $pay_sum_note;
	var $flag;
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
	var $DetailAdd = FALSE; // Allow detail add
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
	function cpaymentsummary() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// pay_sum_id
		$this->pay_sum_id = new cField('paymentsummary', 'paymentsummary', 'x_pay_sum_id', 'pay_sum_id', '`pay_sum_id`', 3, -1, FALSE, '`pay_sum_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->pay_sum_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pay_sum_id'] =& $this->pay_sum_id;

		// t_code
		$this->t_code = new cField('paymentsummary', 'paymentsummary', 'x_t_code', 't_code', '`t_code`', 200, -1, FALSE, '`t_code`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->t_code->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['t_code'] =& $this->t_code;

		// village_id
		$this->village_id = new cField('paymentsummary', 'paymentsummary', 'x_village_id', 'village_id', '`village_id`', 3, -1, FALSE, '`village_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->village_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;

		// member_code
		$this->member_code = new cField('paymentsummary', 'paymentsummary', 'x_member_code', 'member_code', '`member_code`', 200, -1, FALSE, '`member_code`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->member_code->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['member_code'] =& $this->member_code;

		// pay_sum_date
		$this->pay_sum_date = new cField('paymentsummary', 'paymentsummary', 'x_pay_sum_date', 'pay_sum_date', '`pay_sum_date`', 135, 7, FALSE, '`pay_sum_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->pay_sum_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['pay_sum_date'] =& $this->pay_sum_date;

		// pay_sum_type
		$this->pay_sum_type = new cField('paymentsummary', 'paymentsummary', 'x_pay_sum_type', 'pay_sum_type', '`pay_sum_type`', 3, -1, FALSE, '`pay_sum_type`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->pay_sum_type->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pay_sum_type'] =& $this->pay_sum_type;

		// pay_death_begin
		$this->pay_death_begin = new cField('paymentsummary', 'paymentsummary', 'x_pay_death_begin', 'pay_death_begin', '`pay_death_begin`', 3, -1, FALSE, '`pay_death_begin`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->pay_death_begin->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pay_death_begin'] =& $this->pay_death_begin;

		// pay_sum_adv_count
		$this->pay_sum_adv_count = new cField('paymentsummary', 'paymentsummary', 'x_pay_sum_adv_count', 'pay_sum_adv_count', '`pay_sum_adv_count`', 3, -1, FALSE, '`pay_sum_adv_count`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->pay_sum_adv_count->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pay_sum_adv_count'] =& $this->pay_sum_adv_count;

		// pay_sum_adv_num
		$this->pay_sum_adv_num = new cField('paymentsummary', 'paymentsummary', 'x_pay_sum_adv_num', 'pay_sum_adv_num', '`pay_sum_adv_num`', 3, -1, FALSE, '`pay_sum_adv_num`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->pay_sum_adv_num->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pay_sum_adv_num'] =& $this->pay_sum_adv_num;

		// pay_death_end
		$this->pay_death_end = new cField('paymentsummary', 'paymentsummary', 'x_pay_death_end', 'pay_death_end', '`pay_death_end`', 3, -1, FALSE, '`pay_death_end`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->pay_death_end->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pay_death_end'] =& $this->pay_death_end;

		// pay_annual_year
		$this->pay_annual_year = new cField('paymentsummary', 'paymentsummary', 'x_pay_annual_year', 'pay_annual_year', '`pay_annual_year`', 200, -1, FALSE, '`pay_annual_year`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->pay_annual_year->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pay_annual_year'] =& $this->pay_annual_year;

		// pay_sum_detail
		$this->pay_sum_detail = new cField('paymentsummary', 'paymentsummary', 'x_pay_sum_detail', 'pay_sum_detail', '`pay_sum_detail`', 200, -1, FALSE, '`pay_sum_detail`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['pay_sum_detail'] =& $this->pay_sum_detail;

		// pay_sum_total
		$this->pay_sum_total = new cField('paymentsummary', 'paymentsummary', 'x_pay_sum_total', 'pay_sum_total', '`pay_sum_total`', 4, -1, FALSE, '`pay_sum_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->pay_sum_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['pay_sum_total'] =& $this->pay_sum_total;

		// pay_sum_note
		$this->pay_sum_note = new cField('paymentsummary', 'paymentsummary', 'x_pay_sum_note', 'pay_sum_note', '`pay_sum_note`', 201, -1, FALSE, '`pay_sum_note`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['pay_sum_note'] =& $this->pay_sum_note;

		// flag
		$this->flag = new cField('paymentsummary', 'paymentsummary', 'x_flag', 'flag', '`flag`', 3, -1, FALSE, '`flag`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->flag->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['flag'] =& $this->flag;
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
		return "paymentsummary_Highlight";
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

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function getMasterFilter() {

		// Master filter
		$sMasterFilter = "";
		if ($this->getCurrentMasterTable() == "village") {
			if ($this->village_id->getSessionValue() <> "")
				$sMasterFilter .= "`village_id`=" . ew_QuotedValue($this->village_id->getSessionValue(), EW_DATATYPE_NUMBER);
			else
				return "";
			if ($this->t_code->getSessionValue() <> "")
				$sMasterFilter .= " AND `t_code`=" . ew_QuotedValue($this->t_code->getSessionValue(), EW_DATATYPE_STRING);
			else
				return "";
			if ($this->flag->getSessionValue() <> "")
				$sMasterFilter .= " AND `flag`=" . ew_QuotedValue($this->flag->getSessionValue(), EW_DATATYPE_NUMBER);
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function getDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "village") {
			if ($this->village_id->getSessionValue() <> "")
				$sDetailFilter .= "`village_id`=" . ew_QuotedValue($this->village_id->getSessionValue(), EW_DATATYPE_NUMBER);
			else
				return "";
			if ($this->t_code->getSessionValue() <> "")
				$sDetailFilter .= " AND `t_code`=" . ew_QuotedValue($this->t_code->getSessionValue(), EW_DATATYPE_STRING);
			else
				return "";
			if ($this->flag->getSessionValue() <> "")
				$sDetailFilter .= " AND `flag`=" . ew_QuotedValue($this->flag->getSessionValue(), EW_DATATYPE_NUMBER);
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_village() {
		return "`village_id`=@village_id@ AND `t_code`='@t_code@' AND `flag`=@flag@";
	}

	// Detail filter
	function SqlDetailFilter_village() {
		return "`village_id`=@village_id@ AND `t_code`='@t_code@' AND `flag`=@flag@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`paymentsummary`";
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
		return "`pay_sum_id` DESC";
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
		return "INSERT INTO `paymentsummary` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `paymentsummary` SET ";
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
		$SQL = "DELETE FROM `paymentsummary` WHERE ";
		$SQL .= ew_QuotedName('pay_sum_id') . '=' . ew_QuotedValue($rs['pay_sum_id'], $this->pay_sum_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`pay_sum_id` = @pay_sum_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->pay_sum_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@pay_sum_id@", ew_AdjustSql($this->pay_sum_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "paymentsummarylist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "paymentsummarylist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("paymentsummaryview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "paymentsummaryadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("paymentsummaryedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("paymentsummaryadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("paymentsummarydelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->pay_sum_id->CurrentValue)) {
			$sUrl .= "pay_sum_id=" . urlencode($this->pay_sum_id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=paymentsummary" : "";
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
			$arKeys[] = @$_GET["pay_sum_id"]; // pay_sum_id

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
			$this->pay_sum_id->CurrentValue = $key;
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
		$this->pay_sum_id->setDbValue($rs->fields('pay_sum_id'));
		$this->t_code->setDbValue($rs->fields('t_code'));
		$this->village_id->setDbValue($rs->fields('village_id'));
		$this->member_code->setDbValue($rs->fields('member_code'));
		$this->pay_sum_date->setDbValue($rs->fields('pay_sum_date'));
		$this->pay_sum_type->setDbValue($rs->fields('pay_sum_type'));
		$this->pay_death_begin->setDbValue($rs->fields('pay_death_begin'));
		$this->pay_sum_adv_count->setDbValue($rs->fields('pay_sum_adv_count'));
		$this->pay_sum_adv_num->setDbValue($rs->fields('pay_sum_adv_num'));
		$this->pay_death_end->setDbValue($rs->fields('pay_death_end'));
		$this->pay_annual_year->setDbValue($rs->fields('pay_annual_year'));
		$this->pay_sum_detail->setDbValue($rs->fields('pay_sum_detail'));
		$this->pay_sum_total->setDbValue($rs->fields('pay_sum_total'));
		$this->pay_sum_note->setDbValue($rs->fields('pay_sum_note'));
		$this->flag->setDbValue($rs->fields('flag'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// pay_sum_id
		// t_code

		$this->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$this->village_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		$this->member_code->CellCssStyle = "white-space: nowrap;";

		// pay_sum_date
		// pay_sum_type

		$this->pay_sum_type->CellCssStyle = "white-space: nowrap;";

		// pay_death_begin
		// pay_sum_adv_count

		$this->pay_sum_adv_count->CellCssStyle = "white-space: nowrap;";

		// pay_sum_adv_num
		// pay_death_end

		$this->pay_death_end->CellCssStyle = "white-space: nowrap;";

		// pay_annual_year
		// pay_sum_detail
		// pay_sum_total

		$this->pay_sum_total->CellCssStyle = "white-space: nowrap;";

		// pay_sum_note
		// flag

		$this->flag->CellCssStyle = "white-space: nowrap;";

		// pay_sum_id
		$this->pay_sum_id->ViewValue = $this->pay_sum_id->CurrentValue;
		$this->pay_sum_id->ViewCustomAttributes = "";

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

		// member_code
		if (strval($this->member_code->CurrentValue) <> "") {
			$arwrk = explode(",", $this->member_code->CurrentValue);
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
				$this->member_code->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$this->member_code->ViewValue .= $rswrk->fields('member_code');
					$this->member_code->ViewValue .= ew_ValueSeparator($ari,1,$this->member_code) . $rswrk->fields('fname');
					$this->member_code->ViewValue .= ew_ValueSeparator($ari,2,$this->member_code) . $rswrk->fields('lname');
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->member_code->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->member_code->ViewValue = $this->member_code->CurrentValue;
			}
		} else {
			$this->member_code->ViewValue = NULL;
		}
		$this->member_code->ViewCustomAttributes = "";

		// pay_sum_date
		$this->pay_sum_date->ViewValue = $this->pay_sum_date->CurrentValue;
		$this->pay_sum_date->ViewValue = ew_FormatDateTime($this->pay_sum_date->ViewValue, 7);
		$this->pay_sum_date->ViewCustomAttributes = "";

		// pay_sum_type
		if (strval($this->pay_sum_type->CurrentValue) <> "") {
			$sFilterWrk = "`pt_id` = " . ew_AdjustSql($this->pay_sum_type->CurrentValue) . "";
		$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->pay_sum_type->ViewValue = $rswrk->fields('pt_title');
				$rswrk->Close();
			} else {
				$this->pay_sum_type->ViewValue = $this->pay_sum_type->CurrentValue;
			}
		} else {
			$this->pay_sum_type->ViewValue = NULL;
		}
		$this->pay_sum_type->ViewCustomAttributes = "";

		// pay_death_begin
		if (strval($this->pay_death_begin->CurrentValue) <> "") {
			$sFilterWrk = "`dead_id` = " . ew_AdjustSql($this->pay_death_begin->CurrentValue) . "";
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
				$this->pay_death_begin->ViewValue = $rswrk->fields('dead_id');
				$this->pay_death_begin->ViewValue .= ew_ValueSeparator(0,1,$this->pay_death_begin) . $rswrk->fields('fname');
				$this->pay_death_begin->ViewValue .= ew_ValueSeparator(0,2,$this->pay_death_begin) . $rswrk->fields('lname');
				$rswrk->Close();
			} else {
				$this->pay_death_begin->ViewValue = $this->pay_death_begin->CurrentValue;
			}
		} else {
			$this->pay_death_begin->ViewValue = NULL;
		}
		$this->pay_death_begin->ViewCustomAttributes = "";

		// pay_sum_adv_count
		$this->pay_sum_adv_count->ViewValue = $this->pay_sum_adv_count->CurrentValue;
		$this->pay_sum_adv_count->ViewCustomAttributes = "";

		// pay_sum_adv_num
		if (strval($this->pay_sum_adv_num->CurrentValue) <> "") {
			$sFilterWrk = "`adv_num` = " . ew_AdjustSql($this->pay_sum_adv_num->CurrentValue) . "";
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
				$this->pay_sum_adv_num->ViewValue = $rswrk->fields('adv_num');
				$rswrk->Close();
			} else {
				$this->pay_sum_adv_num->ViewValue = $this->pay_sum_adv_num->CurrentValue;
			}
		} else {
			$this->pay_sum_adv_num->ViewValue = NULL;
		}
		$this->pay_sum_adv_num->ViewCustomAttributes = "";

		// pay_death_end
		if (strval($this->pay_death_end->CurrentValue) <> "") {
			$sFilterWrk = "`dead_id` = " . ew_AdjustSql($this->pay_death_end->CurrentValue) . "";
		$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
		$sWhereWrk = "";
		$lookuptblfilter = "`member_status` = 'เสียชีวิต'";
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
				$this->pay_death_end->ViewValue = $rswrk->fields('dead_id');
				$this->pay_death_end->ViewValue .= ew_ValueSeparator(0,1,$this->pay_death_end) . $rswrk->fields('fname');
				$this->pay_death_end->ViewValue .= ew_ValueSeparator(0,2,$this->pay_death_end) . $rswrk->fields('lname');
				$rswrk->Close();
			} else {
				$this->pay_death_end->ViewValue = $this->pay_death_end->CurrentValue;
			}
		} else {
			$this->pay_death_end->ViewValue = NULL;
		}
		$this->pay_death_end->ViewCustomAttributes = "";

		// pay_annual_year
		if (strval($this->pay_annual_year->CurrentValue) <> "") {
			$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($this->pay_annual_year->CurrentValue) . "'";
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
				$this->pay_annual_year->ViewValue = $rswrk->fields('cal_detail');
				$rswrk->Close();
			} else {
				$this->pay_annual_year->ViewValue = $this->pay_annual_year->CurrentValue;
			}
		} else {
			$this->pay_annual_year->ViewValue = NULL;
		}
		$this->pay_annual_year->ViewCustomAttributes = "";

		// pay_sum_detail
		if (strval($this->pay_sum_detail->CurrentValue) <> "") {
			$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($this->pay_sum_detail->CurrentValue) . "'";
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
				$this->pay_sum_detail->ViewValue = $rswrk->fields('cal_detail');
				$rswrk->Close();
			} else {
				$this->pay_sum_detail->ViewValue = $this->pay_sum_detail->CurrentValue;
			}
		} else {
			$this->pay_sum_detail->ViewValue = NULL;
		}
		$this->pay_sum_detail->ViewCustomAttributes = "";

		// pay_sum_total
		$this->pay_sum_total->ViewValue = $this->pay_sum_total->CurrentValue;
		$this->pay_sum_total->ViewCustomAttributes = "";

		// pay_sum_note
		$this->pay_sum_note->ViewValue = $this->pay_sum_note->CurrentValue;
		$this->pay_sum_note->ViewCustomAttributes = "";

		// flag
		$this->flag->ViewValue = $this->flag->CurrentValue;
		$this->flag->ViewCustomAttributes = "";

		// pay_sum_id
		$this->pay_sum_id->LinkCustomAttributes = "";
		$this->pay_sum_id->HrefValue = "";
		$this->pay_sum_id->TooltipValue = "";

		// t_code
		$this->t_code->LinkCustomAttributes = "";
		$this->t_code->HrefValue = "";
		$this->t_code->TooltipValue = "";

		// village_id
		$this->village_id->LinkCustomAttributes = "";
		$this->village_id->HrefValue = "";
		$this->village_id->TooltipValue = "";

		// member_code
		$this->member_code->LinkCustomAttributes = "";
		$this->member_code->HrefValue = "";
		$this->member_code->TooltipValue = "";

		// pay_sum_date
		$this->pay_sum_date->LinkCustomAttributes = "";
		$this->pay_sum_date->HrefValue = "";
		$this->pay_sum_date->TooltipValue = "";

		// pay_sum_type
		$this->pay_sum_type->LinkCustomAttributes = "";
		$this->pay_sum_type->HrefValue = "";
		$this->pay_sum_type->TooltipValue = "";

		// pay_death_begin
		$this->pay_death_begin->LinkCustomAttributes = "";
		$this->pay_death_begin->HrefValue = "";
		$this->pay_death_begin->TooltipValue = "";

		// pay_sum_adv_count
		$this->pay_sum_adv_count->LinkCustomAttributes = "";
		$this->pay_sum_adv_count->HrefValue = "";
		$this->pay_sum_adv_count->TooltipValue = "";

		// pay_sum_adv_num
		$this->pay_sum_adv_num->LinkCustomAttributes = "";
		$this->pay_sum_adv_num->HrefValue = "";
		$this->pay_sum_adv_num->TooltipValue = "";

		// pay_death_end
		$this->pay_death_end->LinkCustomAttributes = "";
		$this->pay_death_end->HrefValue = "";
		$this->pay_death_end->TooltipValue = "";

		// pay_annual_year
		$this->pay_annual_year->LinkCustomAttributes = "";
		$this->pay_annual_year->HrefValue = "";
		$this->pay_annual_year->TooltipValue = "";

		// pay_sum_detail
		$this->pay_sum_detail->LinkCustomAttributes = "";
		$this->pay_sum_detail->HrefValue = "";
		$this->pay_sum_detail->TooltipValue = "";

		// pay_sum_total
		$this->pay_sum_total->LinkCustomAttributes = "";
		$this->pay_sum_total->HrefValue = "";
		$this->pay_sum_total->TooltipValue = "";

		// pay_sum_note
		$this->pay_sum_note->LinkCustomAttributes = "";
		$this->pay_sum_note->HrefValue = "";
		$this->pay_sum_note->TooltipValue = "";

		// flag
		$this->flag->LinkCustomAttributes = "";
		$this->flag->HrefValue = "";
		$this->flag->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
			if (is_numeric($this->pay_sum_total->CurrentValue))
				$this->pay_sum_total->Total += $this->pay_sum_total->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
			$this->pay_sum_total->CurrentValue = $this->pay_sum_total->Total;
			$this->pay_sum_total->ViewValue = $this->pay_sum_total->CurrentValue;
			$this->pay_sum_total->ViewCustomAttributes = "";
			$this->pay_sum_total->HrefValue = ""; // Clear href value
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
					$XmlDoc->AddField('pay_sum_id', $this->pay_sum_id->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('t_code', $this->t_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('village_id', $this->village_id->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('member_code', $this->member_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_sum_date', $this->pay_sum_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_sum_type', $this->pay_sum_type->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_death_begin', $this->pay_death_begin->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_sum_adv_num', $this->pay_sum_adv_num->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_annual_year', $this->pay_annual_year->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_sum_detail', $this->pay_sum_detail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_sum_total', $this->pay_sum_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_sum_note', $this->pay_sum_note->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('pay_sum_id', $this->pay_sum_id->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('t_code', $this->t_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('village_id', $this->village_id->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('member_code', $this->member_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_sum_date', $this->pay_sum_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_sum_type', $this->pay_sum_type->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_death_begin', $this->pay_death_begin->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_sum_adv_num', $this->pay_sum_adv_num->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_annual_year', $this->pay_annual_year->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_sum_detail', $this->pay_sum_detail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_sum_total', $this->pay_sum_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_sum_note', $this->pay_sum_note->ExportValue($this->Export, $this->ExportOriginalValue));
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
				$Doc->ExportCaption($this->pay_sum_id);
				$Doc->ExportCaption($this->t_code);
				$Doc->ExportCaption($this->village_id);
				$Doc->ExportCaption($this->member_code);
				$Doc->ExportCaption($this->pay_sum_date);
				$Doc->ExportCaption($this->pay_sum_type);
				$Doc->ExportCaption($this->pay_death_begin);
				$Doc->ExportCaption($this->pay_sum_adv_num);
				$Doc->ExportCaption($this->pay_annual_year);
				$Doc->ExportCaption($this->pay_sum_detail);
				$Doc->ExportCaption($this->pay_sum_total);
				$Doc->ExportCaption($this->pay_sum_note);
			} else {
				$Doc->ExportCaption($this->pay_sum_id);
				$Doc->ExportCaption($this->t_code);
				$Doc->ExportCaption($this->village_id);
				$Doc->ExportCaption($this->member_code);
				$Doc->ExportCaption($this->pay_sum_date);
				$Doc->ExportCaption($this->pay_sum_type);
				$Doc->ExportCaption($this->pay_death_begin);
				$Doc->ExportCaption($this->pay_sum_adv_num);
				$Doc->ExportCaption($this->pay_annual_year);
				$Doc->ExportCaption($this->pay_sum_detail);
				$Doc->ExportCaption($this->pay_sum_total);
				$Doc->ExportCaption($this->pay_sum_note);
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
				$this->AggregateListRowValues(); // Aggregate row values

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
				if ($ExportPageType == "view") {
					$Doc->ExportField($this->pay_sum_id);
					$Doc->ExportField($this->t_code);
					$Doc->ExportField($this->village_id);
					$Doc->ExportField($this->member_code);
					$Doc->ExportField($this->pay_sum_date);
					$Doc->ExportField($this->pay_sum_type);
					$Doc->ExportField($this->pay_death_begin);
					$Doc->ExportField($this->pay_sum_adv_num);
					$Doc->ExportField($this->pay_annual_year);
					$Doc->ExportField($this->pay_sum_detail);
					$Doc->ExportField($this->pay_sum_total);
					$Doc->ExportField($this->pay_sum_note);
				} else {
					$Doc->ExportField($this->pay_sum_id);
					$Doc->ExportField($this->t_code);
					$Doc->ExportField($this->village_id);
					$Doc->ExportField($this->member_code);
					$Doc->ExportField($this->pay_sum_date);
					$Doc->ExportField($this->pay_sum_type);
					$Doc->ExportField($this->pay_death_begin);
					$Doc->ExportField($this->pay_sum_adv_num);
					$Doc->ExportField($this->pay_annual_year);
					$Doc->ExportField($this->pay_sum_detail);
					$Doc->ExportField($this->pay_sum_total);
					$Doc->ExportField($this->pay_sum_note);
				}
				$Doc->EndExportRow();
			}
			$Recordset->MoveNext();
		}

		// Export aggregates (horizontal format only)
		if ($Doc->Horizontal) {
			$this->RowType = EW_ROWTYPE_AGGREGATE;
			$this->ResetAttrs();
			$this->AggregateListRow();
			$Doc->BeginExportRow(-1);
			$Doc->ExportAggregate($this->pay_sum_id, '');
			$Doc->ExportAggregate($this->t_code, '');
			$Doc->ExportAggregate($this->village_id, '');
			$Doc->ExportAggregate($this->member_code, '');
			$Doc->ExportAggregate($this->pay_sum_date, '');
			$Doc->ExportAggregate($this->pay_sum_type, '');
			$Doc->ExportAggregate($this->pay_death_begin, '');
			$Doc->ExportAggregate($this->pay_sum_adv_num, '');
			$Doc->ExportAggregate($this->pay_annual_year, '');
			$Doc->ExportAggregate($this->pay_sum_detail, '');
			$Doc->ExportAggregate($this->pay_sum_total, 'TOTAL');
			$Doc->ExportAggregate($this->pay_sum_note, '');
			$Doc->EndExportRow();
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
	//ew_AddFilter($filter, "(village_id = 23)"); // Add your own filter expression  
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
   //CurrentPage()->setMessage("----> ".$filter); 
  // ew_AddFilter($filter, "(village_id = 23)"); // Add your own filter expression  
														
}                                                

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

		// Row Inserting event
function Row_Inserting($rsold, &$rsnew) { 
	 
  global $paymentsummary;            
	  global $conn;            
	  $setting = getSetting();
	  $maxadv = $setting[0]["max_advance_subv"];  
	  $sumadvnum = getAdvNum();
	  $rs = $paymentsummary->GetFieldValues("FormValue"); // Get the form values ar array 
		switch ($rsnew["pay_sum_type"]) {
			case 1:   //ค่าสงะเคราห์ศพ
				$total = ew_ExecuteScalar("SELECT subvention_rate FROM setting WHERE 1"); 
				break;
			case 2:    //ค่าสงเคราะห์ศพล่วงหน้า
				$t = ew_ExecuteScalar("SELECT subvention_rate FROM setting WHERE 1");   
				$total = ($t * $maxadv);             
				break;                                    
			 case 3:   //  ค่าบำรุงประจำปี                
				$total = ew_ExecuteScalar("SELECT annual_rate FROM setting WHERE 1"); 
				break;                 
			 case 4:         //ค่าสมัครสมาชิก            
			   $total = ew_ExecuteScalar("SELECT regis_rate FROM setting WHERE 1"); 
				break;                              
			 case 5:           //อื่นๆ                            
			  $total = ew_ExecuteScalar("SELECT unit_rate FROM subvcalculate WHERE cal_detail = '".$rsnew['pay_sum_detail']."'");                                                 
				break;                                                
			 default:                              
				 $total = 0;                               
		}              


	 // $total = ew_ExecuteScalar("SELECT subvention_rate FROM setting WHERE 1");                                         
		$mid = explode(',',$rs["member_code"]);                
		$rsnew["member_code"] = 0;  
	   if ($rs["flag"] == 2){                  

	   //if ($_GET["flag"] == 2){  
			 $rsf2 = getMemberByVillage($rs["village_id"]);                  
		  for($i=0;$i<count($rsf2);$i++){                     

		//   $rsnew["member_id[$i]"] = $mid[$i];      
		   if($rsnew["pay_sum_type"] == 1){
				if ($total > getAdvanceBudget($rsf2[$i]['member_code'])){
					CurrentPage()->setFailureMessage(getNameById($rsf2[$i]['member_id'])."  มียอดเงินสงเคราะห์ล่วงหน้าคงเหลือไม่พอจ่าย   ");
					 return FALSE;                                                                                               
				} else if(subventionPaid($rsf2[$i]['member_id'], $rsnew["pay_death_begin"])){     
				   CurrentPage()->setFailureMessage(getNameById($rsf2[$i]['member_id'])."ได้ ชำระรายการนี้แล้ว  ");  
				   return FALSE;                                                    
				}                                                                                          
		   } // end if pay_sum_type = 2    
		   else if($rsnew["pay_sum_type"] == 2){
				  $dup  = ew_ExecuteScalar("SELECT pay_sum_id FROM paymentsummary WHERE member_code = '".$rsf2[$i]['member_code']."' AND pay_sum_adv_num = '".$rsnew['pay_sum_adv_num']."'"); 
				  if ($dup > 0)  {                                                                                                                                           
				   CurrentPage()->setFailureMessage(getNameById($rsf2[$i]['member_code'])."ได้ ชำระรายการนี้แล้ว  ");  
				   return FALSE;                              
				  }                                                                                       
		   } // end if pay_sum_type = 2                     
		   else if ($rsnew["pay_sum_type"] == 3){
				  $dup  = ew_ExecuteScalar("SELECT pay_sum_id FROM paymentsummary WHERE member_code = '".$rsf2[$i]['member_code']."' AND pay_annual_year = '".$rsnew['pay_annual_year']."'"); 
				  if ($dup > 0)  {
				   CurrentPage()->setFailureMessage(getNameById($rsf2[$i]['member_code'])."ได้ ชำระรายการนี้แล้ว  ");  
				   return FALSE;                              
				  }                                          
		   }  // end if pay_sum_type = 3  
		   else if ($rsnew["pay_sum_type"] == 4){
				  $dup  = ew_ExecuteScalar("SELECT pay_sum_id FROM paymentsummary WHERE member_code = '".$rsf2[$i]['member_code']."'"); 
				  if ($dup > 0)  {                                                            
				   CurrentPage()->setFailureMessage(getNameById($rsf2[$i]['member_code'])."ได้  ชำระรายการนี้แล้ว  ");  
				   return FALSE;                                   
				  }       
		   }  // end if pay_sum_type = 4   
		   else if ($rsnew["pay_sum_type"] == 5){
				  $dup  = ew_ExecuteScalar("SELECT pay_sum_id FROM paymentsummary WHERE member_code = '".$rsf2[$i]['member_code']."' AND pay_sum_detail = '".$rsnew['pay_sum_detail']."'"); 
				  
				  if ($dup > 0)  {                                                            
				   CurrentPage()->setFailureMessage(getNameById($rsf2[$i]['member_code'])."ได้  ชำระรายการนี้แล้ว  ");  
				   return FALSE;                                   
				  }       
		   }  // end if pay_sum_type = 5

				  //  echo "INSERT INTO paymentsummary SET t_code = '".$rsf2[$i]["t_code"]."', village_id = ".$rsf2[$i]["village_id"].", member_code = '".$rsf2[$i]["member_code"]."', pay_sum_type = ".$rsnew["pay_sum_type"].", pay_death_begin = '".$rsnew["pay_death_begin"]."', pay_annual_year = '".$rsnew["pay_annual_year"]."',pay_sum_date = '".$rsnew["pay_sum_date"]."', pay_sum_total = ".$total.", pay_sum_adv_count = '".$rsnew["pay_sum_adv_count"]."', pay_sum_detail = '".$rsnew["pay_sum_detail"]."',pay_sum_note = '".$rsnew["pay_sum_note"]."'<br>";
				   $sInsertSql = "INSERT INTO paymentsummary SET t_code = '".$rsf2[$i]["t_code"]."', village_id = ".$rsf2[$i]["village_id"].", member_code = '".$rsf2[$i]["member_code"]."', pay_sum_type = ".$rsnew["pay_sum_type"].", pay_death_begin = '".$rsnew["pay_death_begin"]."', pay_annual_year = '".$rsnew["pay_annual_year"]."',pay_sum_date = '".$rsnew["pay_sum_date"]."', pay_sum_total = ".$total.", pay_sum_adv_num = '".$rsnew["pay_sum_adv_num"]."', pay_sum_detail = '".$rsnew["pay_sum_detail"]."',pay_sum_note = '".$rsnew["pay_sum_note"]."'";
				   $conn->Execute($sInsertSql);
				   
				   
	switch($rsnew["pay_sum_type"]){
	
	case 1: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$rsf2[$i]["village_id"]." AND member_code = '".getDeadMemberCodeByDeadId($rsnew["pay_death_begin"])."'");
		break;
	case 2: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$rsf2[$i]["village_id"]." AND adv_num = '".$rsnew["pay_sum_adv_num"]."'");
		break;
  case 3: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$rsf2[$i]["village_id"]." AND cal_detail = '".$rsnew["pay_annual_year"]."'");
		break;
 case 4: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$rsf2[$i]["village_id"]." AND cal_detail = '".$rsnew["pay_sum_detail"]."'");
		break;
 case 5: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$rsf2[$i]["village_id"]." AND cal_detail = '".$rsnew["pay_sum_detail"]."'");
		break;

}
				 
				   
				   updateSubvention(getMemberIdByCode($rsf2[$i]["member_code"]),$svc_id);                                                                                                                         
		}  // end for 
	   }else { // end if flag 2                                        
		for($i=0;$i<count($mid);$i++){                                                             

		//   $rsnew["member_id[$i]"] = $mid[$i]; 
		   if($rsnew["pay_sum_type"] == 1){
				if ($total > getAdvanceBudget($mid[$i])){
					CurrentPage()->setFailureMessage(getNameById($mid[$i])." มียอดเงินสงเคราะห์ล่วงหน้าคงเหลือไม่พอจ่าย  ");
					 return FALSE;                                                                                               
				} else if(subventionPaid($mid[$i], $rsnew["pay_death_begin"])){     
				   CurrentPage()->setFailureMessage(getNameById($mid[$i])." ได้ชำระรายการนี้แล้ว  ");  
				   return FALSE;                                          
				}                                                                                          
		   } // end if pay_sum_type = 1    
		   else if($rsnew["pay_sum_type"] == 2){
				  $dup  = ew_ExecuteScalar("SELECT pay_sum_id FROM paymentsummary WHERE member_code = '".$mid[$i]."' AND pay_sum_adv_num = '".$rsnew['pay_sum_adv_num']."'"); 
				  if ($dup > 0)  {                                                                                                                                           
				   CurrentPage()->setFailureMessage(getNameById($mid[$i])."ได้ ชำระรายการนี้แล้ว  ");  
				   return FALSE;                              
				  }                                                                                       
		   } // end if pay_sum_type = 2  
		   else if ($rsnew["pay_sum_type"] == 3){         
				  $dup  = ew_ExecuteScalar("SELECT pay_sum_id FROM paymentsummary WHERE member_code = '".$mid[$i]."' AND pay_annual_year = '".$rsnew['pay_annual_year']."'"); 
				  if ($dup > 0)  {                       
				   CurrentPage()->setFailureMessage(getNameById($mid[$i])."ได้  ชำระรายการนี้แล้ว  ");  
				   return FALSE;
				  }                                                                           
		   }  // end if pay_sum_type = 3     
		   else if ($rsnew["pay_sum_type"] == 4){
				  $dup  = ew_ExecuteScalar("SELECT pay_sum_id FROM paymentsummary WHERE member_code = '".$mid[$i]."'"); 
				  if ($dup > 0)  {                       
				   CurrentPage()->setFailureMessage(getNameById($mid[$i])."ได้  ชำระรายการนี้แล้ว  ");  
				   return FALSE;
				  }       
		   }  // end if pay_sum_type = 4     
		   else if ($rsnew["pay_sum_type"] == 5){
				  $dup  = ew_ExecuteScalar("SELECT pay_sum_id FROM paymentsummary WHERE member_code = '".$mid[$i]."' AND pay_sum_detail = '".$rsnew['pay_sum_detail']."'"); 
				  if ($dup > 0)  {                                                            
				   CurrentPage()->setFailureMessage(getNameById($mid[$i])."ได้  ชำระรายการนี้แล้ว  ");  
				   return FALSE;                                   
				  }       
		   }  // end if pay_sum_type = 5


				   $sInsertSql = "INSERT INTO paymentsummary SET t_code = '".$rsnew["t_code"]."', village_id = ".$rsnew["village_id"].", member_code = '".$mid[$i]."', pay_sum_type = ".$rsnew["pay_sum_type"].", pay_death_begin = '".$rsnew["pay_death_begin"]."', pay_annual_year = '".$rsnew["pay_annual_year"]."',pay_sum_date = '".$rsnew["pay_sum_date"]."', pay_sum_total = ".$total.", pay_sum_adv_num = '".$rsnew["pay_sum_adv_num"]."', pay_sum_detail = '".$rsnew["pay_sum_detail"]."',pay_sum_note = '".$rsnew["pay_sum_note"]."'";
				   $conn->Execute($sInsertSql);   
				   
				   
	switch($rsnew["pay_sum_type"]){
	
	case 1: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$rsnew["village_id"]." AND member_code = '".getDeadMemberCodeByDeadId($rsnew["pay_death_begin"])."'");
		break;
	case 2: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$rsnew["village_id"]." AND adv_num = '".$rsnew["pay_sum_adv_num"]."'");
		break;
  case 3: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$rsnew["village_id"]." AND cal_detail = '".$rsnew["pay_annual_year"]."'");
		break;
 case 4: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$rsnew["village_id"]." AND cal_type = 4");
		break;
 case 5: $svc_id = ew_ExecuteScalar("SELECT svc_id FROM subvcalculate WHERE village_id = ".$rsnew["village_id"]." AND cal_detail = '".$rsnew["pay_sum_detail"]."'");
		break;

}				   
				   	updateSubvention(getMemberIdByCode($mid[$i]),$svc_id); 
				   
		}  // end for    
		} // end else flag 2     
		
		
	
		
		
		return TRUE;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
}                                                          
																																																																				 
																		   

		// Row Inserted event
function Row_Inserted($rsold, &$rsnew) {
 global $conn;  
	   $sInsertSql = "DELETE FROM paymentsummary WHERE member_code = 0";
		$conn->Execute($sInsertSql);     
// Delete record
// NOTE: Modify your SQL here, replace the table name and condition
	
 
	//if ($rsnew['pay_sum_type'] == 1)    calculatesubvention2(getDeadMemberCodeByDeadId($rsnew['pay_death_begin']),true); 
	//if ($rsnew['pay_sum_type'] == 2)    calculateAdvSubv($rsnew['pay_sum_adv_num']);   
	//if ($rsnew['pay_sum_type'] == 3)    calculateAnnualfee($rsnew['pay_sum_detail']);
	//if ($rsnew['pay_sum_type'] == 4)    calculateRegis($rsnew['village_id']);
	//if ($rsnew['pay_sum_type'] == 5)    calculateOther($rsnew['pay_sum_detail'],getRateByDetail($rsnew['pay_sum_detail']));
  
					
	return TRUE;         
}                                                                     

		     // Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE             
	/*  global $conn;            

		switch ($rsnew["pay_sum_type"]) {
			case 1:   //ค่าสงะเคราห์ศพ
				$total = ew_ExecuteScalar("SELECT subvention_rate FROM setting WHERE 1"); 
				break;
			case 2:    //ค่าสงเคราะห์ศพล่วงหน้า
				$t = ew_ExecuteScalar("SELECT subvention_rate FROM setting WHERE 1");   
				$total = ($t * $rsnew["pay_sum_adv_count"]);   
				break;                                    
			 case 3:   //  ค่าบำรุงประจำปี                
				$total = ew_ExecuteScalar("SELECT annual_rate FROM setting WHERE 1"); 
				break;                 
			 case 4:         //ค่าสมัครสมาชิก            
			   $total = ew_ExecuteScalar("SELECT regis_rate FROM setting WHERE 1"); 
				break;                              
			 case 5:           //อื่นๆ                            
				$total = $rsnew["pay_sum_total"];                                                   
				break;                                                
			 default:                              
				 $total = 0;                               
		}                                     

			$rsnew["pay_sum_total"] = $total;

			$sInsertSql = "UPDATE paymentsummary SET pay_sum_type = ".$rsnew["pay_sum_type"].", pay_death_begin = '".$rsnew["pay_death_begin"]."', member_code = '".$rsold["member_code"]."', pay_annual_year = '".$rsnew["pay_annual_year"]."',pay_sum_date = '".$rsnew["pay_sum_date"]."', pay_sum_adv_count = '".$rsnew["pay_sum_adv_count"]."', pay_sum_detail = '".$rsnew["pay_sum_detail"]."',pay_sum_note = '".$rsnew["pay_sum_note"]."' WHERE pay_sum_id = '".$rsold["pay_sum_id"]."'";
				   $conn->Execute($sInsertSql);   
			
		  */
		return TRUE;
	}           

		// Row Updated event
function Row_Updated($rsold, &$rsnew) {
	//echo "Row Updated";   
   // calculateAdvSubv($rsold['pay_sum_adv_num']);
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
   // calculateAdvSubv($rsnew['pay_sum_adv_num']);
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
	//var_dump($this->village_id); 
}                                                

}
?>
