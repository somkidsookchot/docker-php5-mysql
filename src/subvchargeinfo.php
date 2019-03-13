<?php

// Global variable for table object
$subvcharge = NULL;

//
// Table class for subvcharge
//
class csubvcharge {
	var $TableVar = 'subvcharge';
	var $TableName = 'subvcharge';
	var $TableType = 'TABLE';
	var $subvc_id;
	var $member_code;
	var $all_member;
	var $alive_count;
	var $dead_count;
	var $resign_count;
	var $terminate_count;
	var $subv_rate;
	var $can_pay_count;
	var $cant_pay_count;
	var $cant_pay_detail;
	var $subvc_total;
	var $assc_percent;
	var $assc_total;
	var $bnfc_total;
	var $canculate_date;
	var $subvc_status;
	var $subvc_date;
	var $subvc_slipt_num;
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
	function csubvcharge() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// subvc_id
		$this->subvc_id = new cField('subvcharge', 'subvcharge', 'x_subvc_id', 'subvc_id', '`subvc_id`', 3, -1, FALSE, '`subvc_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->subvc_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['subvc_id'] =& $this->subvc_id;

		// member_code
		$this->member_code = new cField('subvcharge', 'subvcharge', 'x_member_code', 'member_code', '`member_code`', 200, -1, FALSE, '`member_code`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->member_code->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['member_code'] =& $this->member_code;

		// all_member
		$this->all_member = new cField('subvcharge', 'subvcharge', 'x_all_member', 'all_member', '`all_member`', 3, -1, FALSE, '`all_member`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->all_member->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['all_member'] =& $this->all_member;

		// alive_count
		$this->alive_count = new cField('subvcharge', 'subvcharge', 'x_alive_count', 'alive_count', '`alive_count`', 3, -1, FALSE, '`alive_count`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->alive_count->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['alive_count'] =& $this->alive_count;

		// dead_count
		$this->dead_count = new cField('subvcharge', 'subvcharge', 'x_dead_count', 'dead_count', '`dead_count`', 3, -1, FALSE, '`dead_count`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->dead_count->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['dead_count'] =& $this->dead_count;

		// resign_count
		$this->resign_count = new cField('subvcharge', 'subvcharge', 'x_resign_count', 'resign_count', '`resign_count`', 3, -1, FALSE, '`resign_count`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->resign_count->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['resign_count'] =& $this->resign_count;

		// terminate_count
		$this->terminate_count = new cField('subvcharge', 'subvcharge', 'x_terminate_count', 'terminate_count', '`terminate_count`', 3, -1, FALSE, '`terminate_count`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->terminate_count->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['terminate_count'] =& $this->terminate_count;

		// subv_rate
		$this->subv_rate = new cField('subvcharge', 'subvcharge', 'x_subv_rate', 'subv_rate', '`subv_rate`', 4, -1, FALSE, '`subv_rate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->subv_rate->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['subv_rate'] =& $this->subv_rate;

		// can_pay_count
		$this->can_pay_count = new cField('subvcharge', 'subvcharge', 'x_can_pay_count', 'can_pay_count', '`can_pay_count`', 3, -1, FALSE, '`can_pay_count`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->can_pay_count->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['can_pay_count'] =& $this->can_pay_count;

		// cant_pay_count
		$this->cant_pay_count = new cField('subvcharge', 'subvcharge', 'x_cant_pay_count', 'cant_pay_count', '`cant_pay_count`', 3, -1, FALSE, '`cant_pay_count`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->cant_pay_count->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cant_pay_count'] =& $this->cant_pay_count;

		// cant_pay_detail
		$this->cant_pay_detail = new cField('subvcharge', 'subvcharge', 'x_cant_pay_detail', 'cant_pay_detail', '`cant_pay_detail`', 201, -1, FALSE, '`cant_pay_detail`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['cant_pay_detail'] =& $this->cant_pay_detail;

		// subvc_total
		$this->subvc_total = new cField('subvcharge', 'subvcharge', 'x_subvc_total', 'subvc_total', '`subvc_total`', 4, -1, FALSE, '`subvc_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->subvc_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['subvc_total'] =& $this->subvc_total;

		// assc_percent
		$this->assc_percent = new cField('subvcharge', 'subvcharge', 'x_assc_percent', 'assc_percent', '`assc_percent`', 3, -1, FALSE, '`assc_percent`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->assc_percent->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['assc_percent'] =& $this->assc_percent;

		// assc_total
		$this->assc_total = new cField('subvcharge', 'subvcharge', 'x_assc_total', 'assc_total', '`assc_total`', 4, -1, FALSE, '`assc_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->assc_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['assc_total'] =& $this->assc_total;

		// bnfc_total
		$this->bnfc_total = new cField('subvcharge', 'subvcharge', 'x_bnfc_total', 'bnfc_total', '`bnfc_total`', 4, -1, FALSE, '`bnfc_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->bnfc_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['bnfc_total'] =& $this->bnfc_total;

		// canculate_date
		$this->canculate_date = new cField('subvcharge', 'subvcharge', 'x_canculate_date', 'canculate_date', '`canculate_date`', 133, 7, FALSE, '`canculate_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->canculate_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['canculate_date'] =& $this->canculate_date;

		// subvc_status
		$this->subvc_status = new cField('subvcharge', 'subvcharge', 'x_subvc_status', 'subvc_status', '`subvc_status`', 200, -1, FALSE, '`subvc_status`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['subvc_status'] =& $this->subvc_status;

		// subvc_date
		$this->subvc_date = new cField('subvcharge', 'subvcharge', 'x_subvc_date', 'subvc_date', '`subvc_date`', 133, 7, FALSE, '`subvc_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->subvc_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['subvc_date'] =& $this->subvc_date;

		// subvc_slipt_num
		$this->subvc_slipt_num = new cField('subvcharge', 'subvcharge', 'x_subvc_slipt_num', 'subvc_slipt_num', '`subvc_slipt_num`', 3, -1, FALSE, '`subvc_slipt_num`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->subvc_slipt_num->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['subvc_slipt_num'] =& $this->subvc_slipt_num;
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
		return "subvcharge_Highlight";
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
		return "`subvcharge`";
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
		return "INSERT INTO `subvcharge` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `subvcharge` SET ";
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
		$SQL = "DELETE FROM `subvcharge` WHERE ";
		$SQL .= ew_QuotedName('subvc_id') . '=' . ew_QuotedValue($rs['subvc_id'], $this->subvc_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`subvc_id` = @subvc_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->subvc_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@subvc_id@", ew_AdjustSql($this->subvc_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "subvchargelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "subvchargelist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("subvchargeview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "subvchargeadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("subvchargeedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("subvchargeadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("subvchargedelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->subvc_id->CurrentValue)) {
			$sUrl .= "subvc_id=" . urlencode($this->subvc_id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=subvcharge" : "";
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
			$arKeys[] = @$_GET["subvc_id"]; // subvc_id

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
			$this->subvc_id->CurrentValue = $key;
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
		$this->subvc_id->setDbValue($rs->fields('subvc_id'));
		$this->member_code->setDbValue($rs->fields('member_code'));
		$this->all_member->setDbValue($rs->fields('all_member'));
		$this->alive_count->setDbValue($rs->fields('alive_count'));
		$this->dead_count->setDbValue($rs->fields('dead_count'));
		$this->resign_count->setDbValue($rs->fields('resign_count'));
		$this->terminate_count->setDbValue($rs->fields('terminate_count'));
		$this->subv_rate->setDbValue($rs->fields('subv_rate'));
		$this->can_pay_count->setDbValue($rs->fields('can_pay_count'));
		$this->cant_pay_count->setDbValue($rs->fields('cant_pay_count'));
		$this->cant_pay_detail->setDbValue($rs->fields('cant_pay_detail'));
		$this->subvc_total->setDbValue($rs->fields('subvc_total'));
		$this->assc_percent->setDbValue($rs->fields('assc_percent'));
		$this->assc_total->setDbValue($rs->fields('assc_total'));
		$this->bnfc_total->setDbValue($rs->fields('bnfc_total'));
		$this->canculate_date->setDbValue($rs->fields('canculate_date'));
		$this->subvc_status->setDbValue($rs->fields('subvc_status'));
		$this->subvc_date->setDbValue($rs->fields('subvc_date'));
		$this->subvc_slipt_num->setDbValue($rs->fields('subvc_slipt_num'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// subvc_id

		$this->subvc_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		$this->member_code->CellCssStyle = "white-space: nowrap;";

		// all_member
		$this->all_member->CellCssStyle = "white-space: nowrap;";

		// alive_count
		$this->alive_count->CellCssStyle = "white-space: nowrap;";

		// dead_count
		$this->dead_count->CellCssStyle = "white-space: nowrap;";

		// resign_count
		$this->resign_count->CellCssStyle = "white-space: nowrap;";

		// terminate_count
		$this->terminate_count->CellCssStyle = "white-space: nowrap;";

		// subv_rate
		$this->subv_rate->CellCssStyle = "white-space: nowrap;";

		// can_pay_count
		$this->can_pay_count->CellCssStyle = "white-space: nowrap;";

		// cant_pay_count
		$this->cant_pay_count->CellCssStyle = "white-space: nowrap;";

		// cant_pay_detail
		$this->cant_pay_detail->CellCssStyle = "white-space: nowrap;";

		// subvc_total
		$this->subvc_total->CellCssStyle = "white-space: nowrap;";

		// assc_percent
		$this->assc_percent->CellCssStyle = "white-space: nowrap;";

		// assc_total
		$this->assc_total->CellCssStyle = "white-space: nowrap;";

		// bnfc_total
		$this->bnfc_total->CellCssStyle = "white-space: nowrap;";

		// canculate_date
		$this->canculate_date->CellCssStyle = "white-space: nowrap;";

		// subvc_status
		$this->subvc_status->CellCssStyle = "white-space: nowrap;";

		// subvc_date
		$this->subvc_date->CellCssStyle = "white-space: nowrap;";

		// subvc_slipt_num
		$this->subvc_slipt_num->CellCssStyle = "white-space: nowrap;";

		// subvc_id
		$this->subvc_id->ViewValue = $this->subvc_id->CurrentValue;
		$this->subvc_id->ViewCustomAttributes = "";

		// member_code
		$this->member_code->ViewValue = $this->member_code->CurrentValue;
		if (strval($this->member_code->CurrentValue) <> "") {
			$sFilterWrk = "`member_code` = '" . ew_AdjustSql($this->member_code->CurrentValue) . "'";
		$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->member_code->ViewValue = $rswrk->fields('dead_id');
				$this->member_code->ViewValue .= ew_ValueSeparator(0,1,$this->member_code) . $rswrk->fields('fname');
				$this->member_code->ViewValue .= ew_ValueSeparator(0,2,$this->member_code) . $rswrk->fields('lname');
				$rswrk->Close();
			} else {
				$this->member_code->ViewValue = $this->member_code->CurrentValue;
			}
		} else {
			$this->member_code->ViewValue = NULL;
		}
		$this->member_code->ViewCustomAttributes = "";

		// all_member
		$this->all_member->ViewValue = $this->all_member->CurrentValue;
		$this->all_member->ViewCustomAttributes = "";

		// alive_count
		$this->alive_count->ViewValue = $this->alive_count->CurrentValue;
		$this->alive_count->ViewCustomAttributes = "";

		// dead_count
		$this->dead_count->ViewValue = $this->dead_count->CurrentValue;
		$this->dead_count->ViewCustomAttributes = "";

		// resign_count
		$this->resign_count->ViewValue = $this->resign_count->CurrentValue;
		$this->resign_count->ViewCustomAttributes = "";

		// terminate_count
		$this->terminate_count->ViewValue = $this->terminate_count->CurrentValue;
		$this->terminate_count->ViewCustomAttributes = "";

		// subv_rate
		$this->subv_rate->ViewValue = $this->subv_rate->CurrentValue;
		$this->subv_rate->ViewCustomAttributes = "";

		// can_pay_count
		$this->can_pay_count->ViewValue = $this->can_pay_count->CurrentValue;
		$this->can_pay_count->ViewCustomAttributes = "";

		// cant_pay_count
		$this->cant_pay_count->ViewValue = $this->cant_pay_count->CurrentValue;
		$this->cant_pay_count->ViewCustomAttributes = "";

		// cant_pay_detail
		$this->cant_pay_detail->ViewValue = $this->cant_pay_detail->CurrentValue;
		$this->cant_pay_detail->ViewCustomAttributes = "";

		// subvc_total
		$this->subvc_total->ViewValue = $this->subvc_total->CurrentValue;
		$this->subvc_total->ViewCustomAttributes = "";

		// assc_percent
		$this->assc_percent->ViewValue = $this->assc_percent->CurrentValue;
		$this->assc_percent->ViewCustomAttributes = "";

		// assc_total
		$this->assc_total->ViewValue = $this->assc_total->CurrentValue;
		$this->assc_total->ViewCustomAttributes = "";

		// bnfc_total
		$this->bnfc_total->ViewValue = $this->bnfc_total->CurrentValue;
		$this->bnfc_total->ViewCustomAttributes = "";

		// canculate_date
		$this->canculate_date->ViewValue = $this->canculate_date->CurrentValue;
		$this->canculate_date->ViewValue = ew_FormatDateTime($this->canculate_date->ViewValue, 7);
		$this->canculate_date->ViewCustomAttributes = "";

		// subvc_status
		if (strval($this->subvc_status->CurrentValue) <> "") {
			switch ($this->subvc_status->CurrentValue) {
				case "รอจ่าย":
					$this->subvc_status->ViewValue = $this->subvc_status->FldTagCaption(1) <> "" ? $this->subvc_status->FldTagCaption(1) : $this->subvc_status->CurrentValue;
					break;
				case "จ่ายแล้ว":
					$this->subvc_status->ViewValue = $this->subvc_status->FldTagCaption(2) <> "" ? $this->subvc_status->FldTagCaption(2) : $this->subvc_status->CurrentValue;
					break;
				default:
					$this->subvc_status->ViewValue = $this->subvc_status->CurrentValue;
			}
		} else {
			$this->subvc_status->ViewValue = NULL;
		}
		$this->subvc_status->ViewCustomAttributes = "";

		// subvc_date
		$this->subvc_date->ViewValue = $this->subvc_date->CurrentValue;
		$this->subvc_date->ViewValue = ew_FormatDateTime($this->subvc_date->ViewValue, 7);
		$this->subvc_date->ViewCustomAttributes = "";

		// subvc_slipt_num
		$this->subvc_slipt_num->ViewValue = $this->subvc_slipt_num->CurrentValue;
		$this->subvc_slipt_num->ViewCustomAttributes = "";

		// subvc_id
		$this->subvc_id->LinkCustomAttributes = "";
		$this->subvc_id->HrefValue = "";
		$this->subvc_id->TooltipValue = "";

		// member_code
		$this->member_code->LinkCustomAttributes = "";
		$this->member_code->HrefValue = "";
		$this->member_code->TooltipValue = "";

		// all_member
		$this->all_member->LinkCustomAttributes = "";
		$this->all_member->HrefValue = "";
		$this->all_member->TooltipValue = "";

		// alive_count
		$this->alive_count->LinkCustomAttributes = "";
		$this->alive_count->HrefValue = "";
		$this->alive_count->TooltipValue = "";

		// dead_count
		$this->dead_count->LinkCustomAttributes = "";
		$this->dead_count->HrefValue = "";
		$this->dead_count->TooltipValue = "";

		// resign_count
		$this->resign_count->LinkCustomAttributes = "";
		$this->resign_count->HrefValue = "";
		$this->resign_count->TooltipValue = "";

		// terminate_count
		$this->terminate_count->LinkCustomAttributes = "";
		$this->terminate_count->HrefValue = "";
		$this->terminate_count->TooltipValue = "";

		// subv_rate
		$this->subv_rate->LinkCustomAttributes = "";
		$this->subv_rate->HrefValue = "";
		$this->subv_rate->TooltipValue = "";

		// can_pay_count
		$this->can_pay_count->LinkCustomAttributes = "";
		$this->can_pay_count->HrefValue = "";
		$this->can_pay_count->TooltipValue = "";

		// cant_pay_count
		$this->cant_pay_count->LinkCustomAttributes = "";
		$this->cant_pay_count->HrefValue = "";
		$this->cant_pay_count->TooltipValue = "";

		// cant_pay_detail
		$this->cant_pay_detail->LinkCustomAttributes = "";
		$this->cant_pay_detail->HrefValue = "";
		$this->cant_pay_detail->TooltipValue = "";

		// subvc_total
		$this->subvc_total->LinkCustomAttributes = "";
		$this->subvc_total->HrefValue = "";
		$this->subvc_total->TooltipValue = "";

		// assc_percent
		$this->assc_percent->LinkCustomAttributes = "";
		$this->assc_percent->HrefValue = "";
		$this->assc_percent->TooltipValue = "";

		// assc_total
		$this->assc_total->LinkCustomAttributes = "";
		$this->assc_total->HrefValue = "";
		$this->assc_total->TooltipValue = "";

		// bnfc_total
		$this->bnfc_total->LinkCustomAttributes = "";
		$this->bnfc_total->HrefValue = "";
		$this->bnfc_total->TooltipValue = "";

		// canculate_date
		$this->canculate_date->LinkCustomAttributes = "";
		$this->canculate_date->HrefValue = "";
		$this->canculate_date->TooltipValue = "";

		// subvc_status
		$this->subvc_status->LinkCustomAttributes = "";
		$this->subvc_status->HrefValue = "";
		$this->subvc_status->TooltipValue = "";

		// subvc_date
		$this->subvc_date->LinkCustomAttributes = "";
		$this->subvc_date->HrefValue = "";
		$this->subvc_date->TooltipValue = "";

		// subvc_slipt_num
		$this->subvc_slipt_num->LinkCustomAttributes = "";
		$this->subvc_slipt_num->HrefValue = "";
		$this->subvc_slipt_num->TooltipValue = "";

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
					$XmlDoc->AddField('all_member', $this->all_member->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('alive_count', $this->alive_count->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('dead_count', $this->dead_count->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('resign_count', $this->resign_count->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('terminate_count', $this->terminate_count->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('subv_rate', $this->subv_rate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('can_pay_count', $this->can_pay_count->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('cant_pay_count', $this->cant_pay_count->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('cant_pay_detail', $this->cant_pay_detail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('subvc_total', $this->subvc_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('assc_percent', $this->assc_percent->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('assc_total', $this->assc_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('bnfc_total', $this->bnfc_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('subvc_status', $this->subvc_status->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('subvc_date', $this->subvc_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('subvc_slipt_num', $this->subvc_slipt_num->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
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
				$Doc->ExportCaption($this->all_member);
				$Doc->ExportCaption($this->alive_count);
				$Doc->ExportCaption($this->dead_count);
				$Doc->ExportCaption($this->resign_count);
				$Doc->ExportCaption($this->terminate_count);
				$Doc->ExportCaption($this->subv_rate);
				$Doc->ExportCaption($this->can_pay_count);
				$Doc->ExportCaption($this->cant_pay_count);
				$Doc->ExportCaption($this->cant_pay_detail);
				$Doc->ExportCaption($this->subvc_total);
				$Doc->ExportCaption($this->assc_percent);
				$Doc->ExportCaption($this->assc_total);
				$Doc->ExportCaption($this->bnfc_total);
				$Doc->ExportCaption($this->subvc_status);
				$Doc->ExportCaption($this->subvc_date);
				$Doc->ExportCaption($this->subvc_slipt_num);
			} else {
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
					$Doc->ExportField($this->all_member);
					$Doc->ExportField($this->alive_count);
					$Doc->ExportField($this->dead_count);
					$Doc->ExportField($this->resign_count);
					$Doc->ExportField($this->terminate_count);
					$Doc->ExportField($this->subv_rate);
					$Doc->ExportField($this->can_pay_count);
					$Doc->ExportField($this->cant_pay_count);
					$Doc->ExportField($this->cant_pay_detail);
					$Doc->ExportField($this->subvc_total);
					$Doc->ExportField($this->assc_percent);
					$Doc->ExportField($this->assc_total);
					$Doc->ExportField($this->bnfc_total);
					$Doc->ExportField($this->subvc_status);
					$Doc->ExportField($this->subvc_date);
					$Doc->ExportField($this->subvc_slipt_num);
				} else {
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
		//calculatesubvention(getMemberIdByCode($rsold['member_code'])); 
		$rsnew['assc_total'] = getAsscTotalByBnfcTotal($rsnew["bnfc_total"]); 



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
