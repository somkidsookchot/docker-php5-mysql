<?php

// Global variable for table object
$setting = NULL;

//
// Table class for setting
//
class csetting {
	var $TableVar = 'setting';
	var $TableName = 'setting';
	var $TableType = 'TABLE';
	var $setting_id;
	var $start_date;
	var $old_member;
	var $dead_member;
	var $new_member;
	var $max_subvention;
	var $rc_rate;
	var $regis_rate;
	var $annual_rate;
	var $subvention_rate;
	var $assc_percent;
	var $min_advance_subv;
	var $max_advance_subv;
	var $quoted_advance_subv;
	var $max_age;
	var $chairman_name;
	var $chairman_signature;
	var $receiver_name;
	var $receiver_signature;
	var $logo;
	var $notice_duedate;
	var $invoice_duedate;
	var $contact_info;
	var $annual_fee_duedate;
	var $export_path;
	var $export_date;
	var $last_export;
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
	function csetting() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// setting_id
		$this->setting_id = new cField('setting', 'setting', 'x_setting_id', 'setting_id', '`setting_id`', 3, -1, FALSE, '`setting_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->setting_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['setting_id'] =& $this->setting_id;

		// start_date
		$this->start_date = new cField('setting', 'setting', 'x_start_date', 'start_date', '`start_date`', 133, 7, FALSE, '`start_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->start_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['start_date'] =& $this->start_date;

		// old_member
		$this->old_member = new cField('setting', 'setting', 'x_old_member', 'old_member', '`old_member`', 3, -1, FALSE, '`old_member`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->old_member->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['old_member'] =& $this->old_member;

		// dead_member
		$this->dead_member = new cField('setting', 'setting', 'x_dead_member', 'dead_member', '`dead_member`', 3, -1, FALSE, '`dead_member`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->dead_member->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['dead_member'] =& $this->dead_member;

		// new_member
		$this->new_member = new cField('setting', 'setting', 'x_new_member', 'new_member', '`new_member`', 3, -1, FALSE, '`new_member`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->new_member->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['new_member'] =& $this->new_member;

		// max_subvention
		$this->max_subvention = new cField('setting', 'setting', 'x_max_subvention', 'max_subvention', '`max_subvention`', 3, -1, FALSE, '`max_subvention`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->max_subvention->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['max_subvention'] =& $this->max_subvention;

		// rc_rate
		$this->rc_rate = new cField('setting', 'setting', 'x_rc_rate', 'rc_rate', '`rc_rate`', 3, -1, FALSE, '`rc_rate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->rc_rate->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rc_rate'] =& $this->rc_rate;

		// regis_rate
		$this->regis_rate = new cField('setting', 'setting', 'x_regis_rate', 'regis_rate', '`regis_rate`', 4, -1, FALSE, '`regis_rate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->regis_rate->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['regis_rate'] =& $this->regis_rate;

		// annual_rate
		$this->annual_rate = new cField('setting', 'setting', 'x_annual_rate', 'annual_rate', '`annual_rate`', 4, -1, FALSE, '`annual_rate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->annual_rate->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['annual_rate'] =& $this->annual_rate;

		// subvention_rate
		$this->subvention_rate = new cField('setting', 'setting', 'x_subvention_rate', 'subvention_rate', '`subvention_rate`', 4, -1, FALSE, '`subvention_rate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->subvention_rate->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['subvention_rate'] =& $this->subvention_rate;

		// assc_percent
		$this->assc_percent = new cField('setting', 'setting', 'x_assc_percent', 'assc_percent', '`assc_percent`', 3, -1, FALSE, '`assc_percent`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->assc_percent->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['assc_percent'] =& $this->assc_percent;

		// min_advance_subv
		$this->min_advance_subv = new cField('setting', 'setting', 'x_min_advance_subv', 'min_advance_subv', '`min_advance_subv`', 3, -1, FALSE, '`min_advance_subv`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->min_advance_subv->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['min_advance_subv'] =& $this->min_advance_subv;

		// max_advance_subv
		$this->max_advance_subv = new cField('setting', 'setting', 'x_max_advance_subv', 'max_advance_subv', '`max_advance_subv`', 3, -1, FALSE, '`max_advance_subv`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->max_advance_subv->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['max_advance_subv'] =& $this->max_advance_subv;

		// quoted_advance_subv
		$this->quoted_advance_subv = new cField('setting', 'setting', 'x_quoted_advance_subv', 'quoted_advance_subv', '`quoted_advance_subv`', 4, -1, FALSE, '`quoted_advance_subv`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->quoted_advance_subv->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['quoted_advance_subv'] =& $this->quoted_advance_subv;

		// max_age
		$this->max_age = new cField('setting', 'setting', 'x_max_age', 'max_age', '`max_age`', 3, -1, FALSE, '`max_age`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->max_age->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['max_age'] =& $this->max_age;

		// chairman_name
		$this->chairman_name = new cField('setting', 'setting', 'x_chairman_name', 'chairman_name', '`chairman_name`', 200, -1, FALSE, '`chairman_name`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['chairman_name'] =& $this->chairman_name;

		// chairman_signature
		$this->chairman_signature = new cField('setting', 'setting', 'x_chairman_signature', 'chairman_signature', '`chairman_signature`', 200, -1, TRUE, '`chairman_signature`', FALSE, FALSE, 'IMAGE');
		$this->chairman_signature->ImageResize = TRUE;
		$this->chairman_signature->ResizeQuality = 75;
		$this->chairman_signature->UploadPath = "upload";
		$this->fields['chairman_signature'] =& $this->chairman_signature;

		// receiver_name
		$this->receiver_name = new cField('setting', 'setting', 'x_receiver_name', 'receiver_name', '`receiver_name`', 200, -1, FALSE, '`receiver_name`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['receiver_name'] =& $this->receiver_name;

		// receiver_signature
		$this->receiver_signature = new cField('setting', 'setting', 'x_receiver_signature', 'receiver_signature', '`receiver_signature`', 200, -1, TRUE, '`receiver_signature`', FALSE, FALSE, 'IMAGE');
		$this->receiver_signature->ImageResize = TRUE;
		$this->receiver_signature->ResizeQuality = 75;
		$this->receiver_signature->UploadPath = "upload";
		$this->fields['receiver_signature'] =& $this->receiver_signature;

		// logo
		$this->logo = new cField('setting', 'setting', 'x_logo', 'logo', '`logo`', 200, -1, TRUE, '`logo`', FALSE, FALSE, 'IMAGE');
		$this->logo->ImageResize = TRUE;
		$this->logo->ResizeQuality = 75;
		$this->logo->UploadPath = "upload";
		$this->fields['logo'] =& $this->logo;

		// notice_duedate
		$this->notice_duedate = new cField('setting', 'setting', 'x_notice_duedate', 'notice_duedate', '`notice_duedate`', 3, -1, FALSE, '`notice_duedate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->notice_duedate->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['notice_duedate'] =& $this->notice_duedate;

		// invoice_duedate
		$this->invoice_duedate = new cField('setting', 'setting', 'x_invoice_duedate', 'invoice_duedate', '`invoice_duedate`', 3, -1, FALSE, '`invoice_duedate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->invoice_duedate->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['invoice_duedate'] =& $this->invoice_duedate;

		// contact_info
		$this->contact_info = new cField('setting', 'setting', 'x_contact_info', 'contact_info', '`contact_info`', 201, -1, FALSE, '`contact_info`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['contact_info'] =& $this->contact_info;

		// annual_fee_duedate
		$this->annual_fee_duedate = new cField('setting', 'setting', 'x_annual_fee_duedate', 'annual_fee_duedate', '`annual_fee_duedate`', 133, 7, FALSE, '`annual_fee_duedate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->annual_fee_duedate->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['annual_fee_duedate'] =& $this->annual_fee_duedate;

		// export_path
		$this->export_path = new cField('setting', 'setting', 'x_export_path', 'export_path', '`export_path`', 200, -1, FALSE, '`export_path`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['export_path'] =& $this->export_path;

		// export_date
		$this->export_date = new cField('setting', 'setting', 'x_export_date', 'export_date', '`export_date`', 3, -1, FALSE, '`export_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->export_date->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['export_date'] =& $this->export_date;

		// last_export
		$this->last_export = new cField('setting', 'setting', 'x_last_export', 'last_export', '`last_export`', 133, 7, FALSE, '`last_export`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->last_export->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['last_export'] =& $this->last_export;
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
		return "setting_Highlight";
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

	// Table level SQL
	function SqlFrom() { // From
		return "`setting`";
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
		return "INSERT INTO `setting` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `setting` SET ";
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
		$SQL = "DELETE FROM `setting` WHERE ";
		$SQL .= ew_QuotedName('setting_id') . '=' . ew_QuotedValue($rs['setting_id'], $this->setting_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`setting_id` = @setting_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->setting_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@setting_id@", ew_AdjustSql($this->setting_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "settinglist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "settinglist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("settingview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "settingadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("settingedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("settingadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("settingdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->setting_id->CurrentValue)) {
			$sUrl .= "setting_id=" . urlencode($this->setting_id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=setting" : "";
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
			$arKeys[] = @$_GET["setting_id"]; // setting_id

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
			$this->setting_id->CurrentValue = $key;
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
		$this->setting_id->setDbValue($rs->fields('setting_id'));
		$this->start_date->setDbValue($rs->fields('start_date'));
		$this->old_member->setDbValue($rs->fields('old_member'));
		$this->dead_member->setDbValue($rs->fields('dead_member'));
		$this->new_member->setDbValue($rs->fields('new_member'));
		$this->max_subvention->setDbValue($rs->fields('max_subvention'));
		$this->rc_rate->setDbValue($rs->fields('rc_rate'));
		$this->regis_rate->setDbValue($rs->fields('regis_rate'));
		$this->annual_rate->setDbValue($rs->fields('annual_rate'));
		$this->subvention_rate->setDbValue($rs->fields('subvention_rate'));
		$this->assc_percent->setDbValue($rs->fields('assc_percent'));
		$this->min_advance_subv->setDbValue($rs->fields('min_advance_subv'));
		$this->max_advance_subv->setDbValue($rs->fields('max_advance_subv'));
		$this->quoted_advance_subv->setDbValue($rs->fields('quoted_advance_subv'));
		$this->max_age->setDbValue($rs->fields('max_age'));
		$this->chairman_name->setDbValue($rs->fields('chairman_name'));
		$this->chairman_signature->Upload->DbValue = $rs->fields('chairman_signature');
		$this->receiver_name->setDbValue($rs->fields('receiver_name'));
		$this->receiver_signature->Upload->DbValue = $rs->fields('receiver_signature');
		$this->logo->Upload->DbValue = $rs->fields('logo');
		$this->notice_duedate->setDbValue($rs->fields('notice_duedate'));
		$this->invoice_duedate->setDbValue($rs->fields('invoice_duedate'));
		$this->contact_info->setDbValue($rs->fields('contact_info'));
		$this->annual_fee_duedate->setDbValue($rs->fields('annual_fee_duedate'));
		$this->export_path->setDbValue($rs->fields('export_path'));
		$this->export_date->setDbValue($rs->fields('export_date'));
		$this->last_export->setDbValue($rs->fields('last_export'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// setting_id

		$this->setting_id->CellCssStyle = "white-space: nowrap;";

		// start_date
		// old_member
		// dead_member
		// new_member
		// max_subvention

		$this->max_subvention->CellCssStyle = "white-space: nowrap;";

		// rc_rate
		$this->rc_rate->CellCssStyle = "white-space: nowrap;";

		// regis_rate
		$this->regis_rate->CellCssStyle = "white-space: nowrap;";

		// annual_rate
		$this->annual_rate->CellCssStyle = "white-space: nowrap;";

		// subvention_rate
		$this->subvention_rate->CellCssStyle = "white-space: nowrap;";

		// assc_percent
		$this->assc_percent->CellCssStyle = "white-space: nowrap;";

		// min_advance_subv
		$this->min_advance_subv->CellCssStyle = "white-space: nowrap;";

		// max_advance_subv
		$this->max_advance_subv->CellCssStyle = "white-space: nowrap;";

		// quoted_advance_subv
		$this->quoted_advance_subv->CellCssStyle = "white-space: nowrap;";

		// max_age
		$this->max_age->CellCssStyle = "white-space: nowrap;";

		// chairman_name
		$this->chairman_name->CellCssStyle = "white-space: nowrap;";

		// chairman_signature
		$this->chairman_signature->CellCssStyle = "white-space: nowrap;";

		// receiver_name
		$this->receiver_name->CellCssStyle = "white-space: nowrap;";

		// receiver_signature
		$this->receiver_signature->CellCssStyle = "white-space: nowrap;";

		// logo
		$this->logo->CellCssStyle = "white-space: nowrap;";

		// notice_duedate
		$this->notice_duedate->CellCssStyle = "white-space: nowrap;";

		// invoice_duedate
		$this->invoice_duedate->CellCssStyle = "white-space: nowrap;";

		// contact_info
		$this->contact_info->CellCssStyle = "white-space: nowrap;";

		// annual_fee_duedate
		$this->annual_fee_duedate->CellCssStyle = "white-space: nowrap;";

		// export_path
		$this->export_path->CellCssStyle = "white-space: nowrap;";

		// export_date
		$this->export_date->CellCssStyle = "white-space: nowrap;";

		// last_export
		// setting_id

		$this->setting_id->ViewValue = $this->setting_id->CurrentValue;
		$this->setting_id->ViewCustomAttributes = "";

		// start_date
		$this->start_date->ViewValue = $this->start_date->CurrentValue;
		$this->start_date->ViewValue = ew_FormatDateTime($this->start_date->ViewValue, 7);
		$this->start_date->ViewCustomAttributes = "";

		// old_member
		$this->old_member->ViewValue = $this->old_member->CurrentValue;
		$this->old_member->ViewCustomAttributes = "";

		// dead_member
		$this->dead_member->ViewValue = $this->dead_member->CurrentValue;
		$this->dead_member->ViewCustomAttributes = "";

		// new_member
		$this->new_member->ViewValue = $this->new_member->CurrentValue;
		$this->new_member->ViewCustomAttributes = "";

		// max_subvention
		$this->max_subvention->ViewValue = $this->max_subvention->CurrentValue;
		$this->max_subvention->ViewCustomAttributes = "";

		// rc_rate
		$this->rc_rate->ViewValue = $this->rc_rate->CurrentValue;
		$this->rc_rate->ViewCustomAttributes = "";

		// regis_rate
		$this->regis_rate->ViewValue = $this->regis_rate->CurrentValue;
		$this->regis_rate->ViewCustomAttributes = "";

		// annual_rate
		$this->annual_rate->ViewValue = $this->annual_rate->CurrentValue;
		$this->annual_rate->ViewCustomAttributes = "";

		// subvention_rate
		$this->subvention_rate->ViewValue = $this->subvention_rate->CurrentValue;
		$this->subvention_rate->ViewCustomAttributes = "";

		// assc_percent
		$this->assc_percent->ViewValue = $this->assc_percent->CurrentValue;
		$this->assc_percent->ViewCustomAttributes = "";

		// min_advance_subv
		$this->min_advance_subv->ViewValue = $this->min_advance_subv->CurrentValue;
		$this->min_advance_subv->ViewCustomAttributes = "";

		// max_advance_subv
		$this->max_advance_subv->ViewValue = $this->max_advance_subv->CurrentValue;
		$this->max_advance_subv->ViewCustomAttributes = "";

		// quoted_advance_subv
		$this->quoted_advance_subv->ViewValue = $this->quoted_advance_subv->CurrentValue;
		$this->quoted_advance_subv->ViewCustomAttributes = "";

		// max_age
		$this->max_age->ViewValue = $this->max_age->CurrentValue;
		$this->max_age->ViewCustomAttributes = "";

		// chairman_name
		$this->chairman_name->ViewValue = $this->chairman_name->CurrentValue;
		$this->chairman_name->ViewCustomAttributes = "";

		// chairman_signature
		if (!ew_Empty($this->chairman_signature->Upload->DbValue)) {
			$this->chairman_signature->ViewValue = $this->chairman_signature->Upload->DbValue;
			$this->chairman_signature->ImageWidth = 120;
			$this->chairman_signature->ImageHeight = 0;
			$this->chairman_signature->ImageAlt = $this->chairman_signature->FldAlt();
		} else {
			$this->chairman_signature->ViewValue = "";
		}
		$this->chairman_signature->ViewCustomAttributes = "";

		// receiver_name
		$this->receiver_name->ViewValue = $this->receiver_name->CurrentValue;
		$this->receiver_name->ViewCustomAttributes = "";

		// receiver_signature
		if (!ew_Empty($this->receiver_signature->Upload->DbValue)) {
			$this->receiver_signature->ViewValue = $this->receiver_signature->Upload->DbValue;
			$this->receiver_signature->ImageWidth = 120;
			$this->receiver_signature->ImageHeight = 0;
			$this->receiver_signature->ImageAlt = $this->receiver_signature->FldAlt();
		} else {
			$this->receiver_signature->ViewValue = "";
		}
		$this->receiver_signature->ViewCustomAttributes = "";

		// logo
		if (!ew_Empty($this->logo->Upload->DbValue)) {
			$this->logo->ViewValue = $this->logo->Upload->DbValue;
			$this->logo->ImageWidth = 130;
			$this->logo->ImageHeight = 0;
			$this->logo->ImageAlt = $this->logo->FldAlt();
		} else {
			$this->logo->ViewValue = "";
		}
		$this->logo->ViewCustomAttributes = "";

		// notice_duedate
		$this->notice_duedate->ViewValue = $this->notice_duedate->CurrentValue;
		$this->notice_duedate->ViewCustomAttributes = "";

		// invoice_duedate
		$this->invoice_duedate->ViewValue = $this->invoice_duedate->CurrentValue;
		$this->invoice_duedate->ViewCustomAttributes = "";

		// contact_info
		$this->contact_info->ViewValue = $this->contact_info->CurrentValue;
		$this->contact_info->ViewCustomAttributes = "";

		// annual_fee_duedate
		$this->annual_fee_duedate->ViewValue = $this->annual_fee_duedate->CurrentValue;
		$this->annual_fee_duedate->ViewValue = ew_FormatDateTime($this->annual_fee_duedate->ViewValue, 7);
		$this->annual_fee_duedate->ViewCustomAttributes = "";

		// export_path
		$this->export_path->ViewValue = $this->export_path->CurrentValue;
		$this->export_path->ViewCustomAttributes = "";

		// export_date
		if (strval($this->export_date->CurrentValue) <> "") {
			switch ($this->export_date->CurrentValue) {
				case "15":
					$this->export_date->ViewValue = $this->export_date->FldTagCaption(1) <> "" ? $this->export_date->FldTagCaption(1) : $this->export_date->CurrentValue;
					break;
				case "30":
					$this->export_date->ViewValue = $this->export_date->FldTagCaption(2) <> "" ? $this->export_date->FldTagCaption(2) : $this->export_date->CurrentValue;
					break;
				case "45":
					$this->export_date->ViewValue = $this->export_date->FldTagCaption(3) <> "" ? $this->export_date->FldTagCaption(3) : $this->export_date->CurrentValue;
					break;
				case "60":
					$this->export_date->ViewValue = $this->export_date->FldTagCaption(4) <> "" ? $this->export_date->FldTagCaption(4) : $this->export_date->CurrentValue;
					break;
				default:
					$this->export_date->ViewValue = $this->export_date->CurrentValue;
			}
		} else {
			$this->export_date->ViewValue = NULL;
		}
		$this->export_date->ViewCustomAttributes = "";

		// last_export
		$this->last_export->ViewValue = $this->last_export->CurrentValue;
		$this->last_export->ViewValue = ew_FormatDateTime($this->last_export->ViewValue, 7);
		$this->last_export->ViewCustomAttributes = "";

		// setting_id
		$this->setting_id->LinkCustomAttributes = "";
		$this->setting_id->HrefValue = "";
		$this->setting_id->TooltipValue = "";

		// start_date
		$this->start_date->LinkCustomAttributes = "";
		$this->start_date->HrefValue = "";
		$this->start_date->TooltipValue = "";

		// old_member
		$this->old_member->LinkCustomAttributes = "";
		$this->old_member->HrefValue = "";
		$this->old_member->TooltipValue = "";

		// dead_member
		$this->dead_member->LinkCustomAttributes = "";
		$this->dead_member->HrefValue = "";
		$this->dead_member->TooltipValue = "";

		// new_member
		$this->new_member->LinkCustomAttributes = "";
		$this->new_member->HrefValue = "";
		$this->new_member->TooltipValue = "";

		// max_subvention
		$this->max_subvention->LinkCustomAttributes = "";
		$this->max_subvention->HrefValue = "";
		$this->max_subvention->TooltipValue = "";

		// rc_rate
		$this->rc_rate->LinkCustomAttributes = "";
		$this->rc_rate->HrefValue = "";
		$this->rc_rate->TooltipValue = "";

		// regis_rate
		$this->regis_rate->LinkCustomAttributes = "";
		$this->regis_rate->HrefValue = "";
		$this->regis_rate->TooltipValue = "";

		// annual_rate
		$this->annual_rate->LinkCustomAttributes = "";
		$this->annual_rate->HrefValue = "";
		$this->annual_rate->TooltipValue = "";

		// subvention_rate
		$this->subvention_rate->LinkCustomAttributes = "";
		$this->subvention_rate->HrefValue = "";
		$this->subvention_rate->TooltipValue = "";

		// assc_percent
		$this->assc_percent->LinkCustomAttributes = "";
		$this->assc_percent->HrefValue = "";
		$this->assc_percent->TooltipValue = "";

		// min_advance_subv
		$this->min_advance_subv->LinkCustomAttributes = "";
		$this->min_advance_subv->HrefValue = "";
		$this->min_advance_subv->TooltipValue = "";

		// max_advance_subv
		$this->max_advance_subv->LinkCustomAttributes = "";
		$this->max_advance_subv->HrefValue = "";
		$this->max_advance_subv->TooltipValue = "";

		// quoted_advance_subv
		$this->quoted_advance_subv->LinkCustomAttributes = "";
		$this->quoted_advance_subv->HrefValue = "";
		$this->quoted_advance_subv->TooltipValue = "";

		// max_age
		$this->max_age->LinkCustomAttributes = "";
		$this->max_age->HrefValue = "";
		$this->max_age->TooltipValue = "";

		// chairman_name
		$this->chairman_name->LinkCustomAttributes = "";
		$this->chairman_name->HrefValue = "";
		$this->chairman_name->TooltipValue = "";

		// chairman_signature
		$this->chairman_signature->LinkCustomAttributes = "";
		$this->chairman_signature->HrefValue = "";
		$this->chairman_signature->TooltipValue = "";

		// receiver_name
		$this->receiver_name->LinkCustomAttributes = "";
		$this->receiver_name->HrefValue = "";
		$this->receiver_name->TooltipValue = "";

		// receiver_signature
		$this->receiver_signature->LinkCustomAttributes = "";
		$this->receiver_signature->HrefValue = "";
		$this->receiver_signature->TooltipValue = "";

		// logo
		$this->logo->LinkCustomAttributes = "";
		$this->logo->HrefValue = "";
		$this->logo->TooltipValue = "";

		// notice_duedate
		$this->notice_duedate->LinkCustomAttributes = "";
		$this->notice_duedate->HrefValue = "";
		$this->notice_duedate->TooltipValue = "";

		// invoice_duedate
		$this->invoice_duedate->LinkCustomAttributes = "";
		$this->invoice_duedate->HrefValue = "";
		$this->invoice_duedate->TooltipValue = "";

		// contact_info
		$this->contact_info->LinkCustomAttributes = "";
		$this->contact_info->HrefValue = "";
		$this->contact_info->TooltipValue = "";

		// annual_fee_duedate
		$this->annual_fee_duedate->LinkCustomAttributes = "";
		$this->annual_fee_duedate->HrefValue = "";
		$this->annual_fee_duedate->TooltipValue = "";

		// export_path
		$this->export_path->LinkCustomAttributes = "";
		$this->export_path->HrefValue = "";
		$this->export_path->TooltipValue = "";

		// export_date
		$this->export_date->LinkCustomAttributes = "";
		$this->export_date->HrefValue = "";
		$this->export_date->TooltipValue = "";

		// last_export
		$this->last_export->LinkCustomAttributes = "";
		$this->last_export->HrefValue = "";
		$this->last_export->TooltipValue = "";

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
					$XmlDoc->AddField('start_date', $this->start_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('old_member', $this->old_member->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('dead_member', $this->dead_member->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('new_member', $this->new_member->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('min_advance_subv', $this->min_advance_subv->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('max_advance_subv', $this->max_advance_subv->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('max_age', $this->max_age->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('chairman_name', $this->chairman_name->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('chairman_signature', $this->chairman_signature->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('receiver_name', $this->receiver_name->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('receiver_signature', $this->receiver_signature->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('logo', $this->logo->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('notice_duedate', $this->notice_duedate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('invoice_duedate', $this->invoice_duedate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('contact_info', $this->contact_info->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('annual_fee_duedate', $this->annual_fee_duedate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('export_path', $this->export_path->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('export_date', $this->export_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('last_export', $this->last_export->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('start_date', $this->start_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('old_member', $this->old_member->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('dead_member', $this->dead_member->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('new_member', $this->new_member->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('min_advance_subv', $this->min_advance_subv->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('max_advance_subv', $this->max_advance_subv->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('chairman_name', $this->chairman_name->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('chairman_signature', $this->chairman_signature->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('receiver_signature', $this->receiver_signature->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('notice_duedate', $this->notice_duedate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('invoice_duedate', $this->invoice_duedate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('annual_fee_duedate', $this->annual_fee_duedate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('export_path', $this->export_path->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('export_date', $this->export_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('last_export', $this->last_export->ExportValue($this->Export, $this->ExportOriginalValue));
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
				$Doc->ExportCaption($this->start_date);
				$Doc->ExportCaption($this->old_member);
				$Doc->ExportCaption($this->dead_member);
				$Doc->ExportCaption($this->new_member);
				$Doc->ExportCaption($this->min_advance_subv);
				$Doc->ExportCaption($this->max_advance_subv);
				$Doc->ExportCaption($this->max_age);
				$Doc->ExportCaption($this->chairman_name);
				$Doc->ExportCaption($this->chairman_signature);
				$Doc->ExportCaption($this->receiver_name);
				$Doc->ExportCaption($this->receiver_signature);
				$Doc->ExportCaption($this->logo);
				$Doc->ExportCaption($this->notice_duedate);
				$Doc->ExportCaption($this->invoice_duedate);
				$Doc->ExportCaption($this->contact_info);
				$Doc->ExportCaption($this->annual_fee_duedate);
				$Doc->ExportCaption($this->export_path);
				$Doc->ExportCaption($this->export_date);
				$Doc->ExportCaption($this->last_export);
			} else {
				$Doc->ExportCaption($this->start_date);
				$Doc->ExportCaption($this->old_member);
				$Doc->ExportCaption($this->dead_member);
				$Doc->ExportCaption($this->new_member);
				$Doc->ExportCaption($this->min_advance_subv);
				$Doc->ExportCaption($this->max_advance_subv);
				$Doc->ExportCaption($this->chairman_name);
				$Doc->ExportCaption($this->chairman_signature);
				$Doc->ExportCaption($this->receiver_signature);
				$Doc->ExportCaption($this->notice_duedate);
				$Doc->ExportCaption($this->invoice_duedate);
				$Doc->ExportCaption($this->annual_fee_duedate);
				$Doc->ExportCaption($this->export_path);
				$Doc->ExportCaption($this->export_date);
				$Doc->ExportCaption($this->last_export);
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
					$Doc->ExportField($this->start_date);
					$Doc->ExportField($this->old_member);
					$Doc->ExportField($this->dead_member);
					$Doc->ExportField($this->new_member);
					$Doc->ExportField($this->min_advance_subv);
					$Doc->ExportField($this->max_advance_subv);
					$Doc->ExportField($this->max_age);
					$Doc->ExportField($this->chairman_name);
					$Doc->ExportField($this->chairman_signature);
					$Doc->ExportField($this->receiver_name);
					$Doc->ExportField($this->receiver_signature);
					$Doc->ExportField($this->logo);
					$Doc->ExportField($this->notice_duedate);
					$Doc->ExportField($this->invoice_duedate);
					$Doc->ExportField($this->contact_info);
					$Doc->ExportField($this->annual_fee_duedate);
					$Doc->ExportField($this->export_path);
					$Doc->ExportField($this->export_date);
					$Doc->ExportField($this->last_export);
				} else {
					$Doc->ExportField($this->start_date);
					$Doc->ExportField($this->old_member);
					$Doc->ExportField($this->dead_member);
					$Doc->ExportField($this->new_member);
					$Doc->ExportField($this->min_advance_subv);
					$Doc->ExportField($this->max_advance_subv);
					$Doc->ExportField($this->chairman_name);
					$Doc->ExportField($this->chairman_signature);
					$Doc->ExportField($this->receiver_signature);
					$Doc->ExportField($this->notice_duedate);
					$Doc->ExportField($this->invoice_duedate);
					$Doc->ExportField($this->annual_fee_duedate);
					$Doc->ExportField($this->export_path);
					$Doc->ExportField($this->export_date);
					$Doc->ExportField($this->last_export);
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

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE
		$rsnew["max_subvention"] = ($rsnew["new_member"]+$rsnew["old_member"])*$rsnew["subvention_rate"];
		//$rsnew["rc_rate"] = ($rsnew["dead_member"]*$rsnew["subvention_rate"]);
		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
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
