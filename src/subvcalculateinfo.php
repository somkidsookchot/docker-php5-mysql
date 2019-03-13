<?php

// Global variable for table object
$subvcalculate = NULL;

//
// Table class for subvcalculate
//
class csubvcalculate {
	var $TableVar = 'subvcalculate';
	var $TableName = 'subvcalculate';
	var $TableType = 'TABLE';
	var $svc_id;
	var $t_code;
	var $village_id;
	var $cal_type;
	var $member_code;
	var $adv_num;
	var $cal_detail;
	var $count_member;
	var $all_member;
	var $unit_rate;
	var $total;
	var $cal_date;
	var $cal_status;
	var $invoice_senddate;
	var $invoice_duedate;
	var $notice_senddate;
	var $notice_duedate;
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
	function csubvcalculate() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// svc_id
		$this->svc_id = new cField('subvcalculate', 'subvcalculate', 'x_svc_id', 'svc_id', '`svc_id`', 3, -1, FALSE, '`svc_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->svc_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['svc_id'] =& $this->svc_id;

		// t_code
		$this->t_code = new cField('subvcalculate', 'subvcalculate', 'x_t_code', 't_code', '`t_code`', 200, -1, FALSE, '`t_code`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['t_code'] =& $this->t_code;

		// village_id
		$this->village_id = new cField('subvcalculate', 'subvcalculate', 'x_village_id', 'village_id', '`village_id`', 3, -1, FALSE, '`village_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->village_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;

		// cal_type
		$this->cal_type = new cField('subvcalculate', 'subvcalculate', 'x_cal_type', 'cal_type', '`cal_type`', 3, -1, FALSE, '`cal_type`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->cal_type->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cal_type'] =& $this->cal_type;

		// member_code
		$this->member_code = new cField('subvcalculate', 'subvcalculate', 'x_member_code', 'member_code', '`member_code`', 200, -1, FALSE, '`member_code`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['member_code'] =& $this->member_code;

		// adv_num
		$this->adv_num = new cField('subvcalculate', 'subvcalculate', 'x_adv_num', 'adv_num', '`adv_num`', 3, -1, FALSE, '`adv_num`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->adv_num->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['adv_num'] =& $this->adv_num;

		// cal_detail
		$this->cal_detail = new cField('subvcalculate', 'subvcalculate', 'x_cal_detail', 'cal_detail', '`cal_detail`', 201, -1, FALSE, '`cal_detail`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['cal_detail'] =& $this->cal_detail;

		// count_member
		$this->count_member = new cField('subvcalculate', 'subvcalculate', 'x_count_member', 'count_member', '`count_member`', 3, -1, FALSE, '`count_member`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->count_member->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['count_member'] =& $this->count_member;

		// all_member
		$this->all_member = new cField('subvcalculate', 'subvcalculate', 'x_all_member', 'all_member', '`all_member`', 3, -1, FALSE, '`all_member`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->all_member->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['all_member'] =& $this->all_member;

		// unit_rate
		$this->unit_rate = new cField('subvcalculate', 'subvcalculate', 'x_unit_rate', 'unit_rate', '`unit_rate`', 4, -1, FALSE, '`unit_rate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->unit_rate->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['unit_rate'] =& $this->unit_rate;

		// total
		$this->total = new cField('subvcalculate', 'subvcalculate', 'x_total', 'total', '`total`', 4, -1, FALSE, '`total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['total'] =& $this->total;

		// cal_date
		$this->cal_date = new cField('subvcalculate', 'subvcalculate', 'x_cal_date', 'cal_date', '`cal_date`', 133, 7, FALSE, '`cal_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->cal_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['cal_date'] =& $this->cal_date;

		// cal_status
		$this->cal_status = new cField('subvcalculate', 'subvcalculate', 'x_cal_status', 'cal_status', '`cal_status`', 200, -1, FALSE, '`cal_status`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['cal_status'] =& $this->cal_status;

		// invoice_senddate
		$this->invoice_senddate = new cField('subvcalculate', 'subvcalculate', 'x_invoice_senddate', 'invoice_senddate', '`invoice_senddate`', 133, 7, FALSE, '`invoice_senddate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->invoice_senddate->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['invoice_senddate'] =& $this->invoice_senddate;

		// invoice_duedate
		$this->invoice_duedate = new cField('subvcalculate', 'subvcalculate', 'x_invoice_duedate', 'invoice_duedate', '`invoice_duedate`', 133, 7, FALSE, '`invoice_duedate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->invoice_duedate->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['invoice_duedate'] =& $this->invoice_duedate;

		// notice_senddate
		$this->notice_senddate = new cField('subvcalculate', 'subvcalculate', 'x_notice_senddate', 'notice_senddate', '`notice_senddate`', 133, 7, FALSE, '`notice_senddate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->notice_senddate->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['notice_senddate'] =& $this->notice_senddate;

		// notice_duedate
		$this->notice_duedate = new cField('subvcalculate', 'subvcalculate', 'x_notice_duedate', 'notice_duedate', '`notice_duedate`', 133, 7, FALSE, '`notice_duedate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->notice_duedate->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['notice_duedate'] =& $this->notice_duedate;
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
		return "subvcalculate_Highlight";
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
		return "`subvcalculate`";
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
		return "INSERT INTO `subvcalculate` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `subvcalculate` SET ";
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
		$SQL = "DELETE FROM `subvcalculate` WHERE ";
		$SQL .= ew_QuotedName('svc_id') . '=' . ew_QuotedValue($rs['svc_id'], $this->svc_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`svc_id` = @svc_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->svc_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@svc_id@", ew_AdjustSql($this->svc_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "subvcalculatelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "subvcalculatelist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("subvcalculateview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "subvcalculateadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("subvcalculateedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("subvcalculateadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("subvcalculatedelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->svc_id->CurrentValue)) {
			$sUrl .= "svc_id=" . urlencode($this->svc_id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=subvcalculate" : "";
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
			$arKeys[] = @$_GET["svc_id"]; // svc_id

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
			$this->svc_id->CurrentValue = $key;
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
		$this->svc_id->setDbValue($rs->fields('svc_id'));
		$this->t_code->setDbValue($rs->fields('t_code'));
		$this->village_id->setDbValue($rs->fields('village_id'));
		$this->cal_type->setDbValue($rs->fields('cal_type'));
		$this->member_code->setDbValue($rs->fields('member_code'));
		$this->adv_num->setDbValue($rs->fields('adv_num'));
		$this->cal_detail->setDbValue($rs->fields('cal_detail'));
		$this->count_member->setDbValue($rs->fields('count_member'));
		$this->all_member->setDbValue($rs->fields('all_member'));
		$this->unit_rate->setDbValue($rs->fields('unit_rate'));
		$this->total->setDbValue($rs->fields('total'));
		$this->cal_date->setDbValue($rs->fields('cal_date'));
		$this->cal_status->setDbValue($rs->fields('cal_status'));
		$this->invoice_senddate->setDbValue($rs->fields('invoice_senddate'));
		$this->invoice_duedate->setDbValue($rs->fields('invoice_duedate'));
		$this->notice_senddate->setDbValue($rs->fields('notice_senddate'));
		$this->notice_duedate->setDbValue($rs->fields('notice_duedate'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// svc_id

		$this->svc_id->CellCssStyle = "white-space: nowrap;";

		// t_code
		$this->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$this->village_id->CellCssStyle = "white-space: nowrap;";

		// cal_type
		$this->cal_type->CellCssStyle = "white-space: nowrap;";

		// member_code
		$this->member_code->CellCssStyle = "white-space: nowrap;";

		// adv_num
		$this->adv_num->CellCssStyle = "white-space: nowrap;";

		// cal_detail
		$this->cal_detail->CellCssStyle = "white-space: nowrap;";

		// count_member
		$this->count_member->CellCssStyle = "white-space: nowrap;";

		// all_member
		$this->all_member->CellCssStyle = "white-space: nowrap;";

		// unit_rate
		$this->unit_rate->CellCssStyle = "white-space: nowrap;";

		// total
		$this->total->CellCssStyle = "white-space: nowrap;";

		// cal_date
		$this->cal_date->CellCssStyle = "white-space: nowrap;";

		// cal_status
		$this->cal_status->CellCssStyle = "white-space: nowrap;";

		// invoice_senddate
		// invoice_duedate
		// notice_senddate
		// notice_duedate
		// svc_id

		$this->svc_id->ViewValue = $this->svc_id->CurrentValue;
		$this->svc_id->ViewCustomAttributes = "";

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

		// cal_type
		if (strval($this->cal_type->CurrentValue) <> "") {
			$sFilterWrk = "`pt_id` = " . ew_AdjustSql($this->cal_type->CurrentValue) . "";
		$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->cal_type->ViewValue = $rswrk->fields('pt_title');
				$rswrk->Close();
			} else {
				$this->cal_type->ViewValue = $this->cal_type->CurrentValue;
			}
		} else {
			$this->cal_type->ViewValue = NULL;
		}
		$this->cal_type->ViewCustomAttributes = "";

		// member_code
		if (strval($this->member_code->CurrentValue) <> "") {
			$sFilterWrk = "`member_code` = '" . ew_AdjustSql($this->member_code->CurrentValue) . "'";
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

		// adv_num
		$this->adv_num->ViewValue = $this->adv_num->CurrentValue;
		$this->adv_num->ViewCustomAttributes = "";

		// cal_detail
		$this->cal_detail->ViewValue = $this->cal_detail->CurrentValue;
		$this->cal_detail->ViewCustomAttributes = "";

		// count_member
		$this->count_member->ViewValue = $this->count_member->CurrentValue;
		$this->count_member->ViewCustomAttributes = "";

		// all_member
		$this->all_member->ViewValue = $this->all_member->CurrentValue;
		$this->all_member->ViewCustomAttributes = "";

		// unit_rate
		$this->unit_rate->ViewValue = $this->unit_rate->CurrentValue;
		$this->unit_rate->ViewCustomAttributes = "";

		// total
		$this->total->ViewValue = $this->total->CurrentValue;
		$this->total->ViewCustomAttributes = "";

		// cal_date
		$this->cal_date->ViewValue = $this->cal_date->CurrentValue;
		$this->cal_date->ViewValue = ew_FormatDateTime($this->cal_date->ViewValue, 7);
		$this->cal_date->ViewCustomAttributes = "";

		// cal_status
		$this->cal_status->ViewValue = $this->cal_status->CurrentValue;
		$this->cal_status->ViewCustomAttributes = "";

		// invoice_senddate
		$this->invoice_senddate->ViewValue = $this->invoice_senddate->CurrentValue;
		$this->invoice_senddate->ViewValue = ew_FormatDateTime($this->invoice_senddate->ViewValue, 7);
		$this->invoice_senddate->ViewCustomAttributes = "";

		// invoice_duedate
		$this->invoice_duedate->ViewValue = $this->invoice_duedate->CurrentValue;
		$this->invoice_duedate->ViewValue = ew_FormatDateTime($this->invoice_duedate->ViewValue, 7);
		$this->invoice_duedate->ViewCustomAttributes = "";

		// notice_senddate
		$this->notice_senddate->ViewValue = $this->notice_senddate->CurrentValue;
		$this->notice_senddate->ViewValue = ew_FormatDateTime($this->notice_senddate->ViewValue, 7);
		$this->notice_senddate->ViewCustomAttributes = "";

		// notice_duedate
		$this->notice_duedate->ViewValue = $this->notice_duedate->CurrentValue;
		$this->notice_duedate->ViewValue = ew_FormatDateTime($this->notice_duedate->ViewValue, 7);
		$this->notice_duedate->ViewCustomAttributes = "";

		// svc_id
		$this->svc_id->LinkCustomAttributes = "";
		$this->svc_id->HrefValue = "";
		$this->svc_id->TooltipValue = "";

		// t_code
		$this->t_code->LinkCustomAttributes = "";
		$this->t_code->HrefValue = "";
		$this->t_code->TooltipValue = "";

		// village_id
		$this->village_id->LinkCustomAttributes = "";
		$this->village_id->HrefValue = "";
		$this->village_id->TooltipValue = "";

		// cal_type
		$this->cal_type->LinkCustomAttributes = "";
		$this->cal_type->HrefValue = "";
		$this->cal_type->TooltipValue = "";

		// member_code
		$this->member_code->LinkCustomAttributes = "";
		$this->member_code->HrefValue = "";
		$this->member_code->TooltipValue = "";

		// adv_num
		$this->adv_num->LinkCustomAttributes = "";
		$this->adv_num->HrefValue = "";
		$this->adv_num->TooltipValue = "";

		// cal_detail
		$this->cal_detail->LinkCustomAttributes = "";
		$this->cal_detail->HrefValue = "";
		$this->cal_detail->TooltipValue = "";

		// count_member
		$this->count_member->LinkCustomAttributes = "";
		$this->count_member->HrefValue = "";
		$this->count_member->TooltipValue = "";

		// all_member
		$this->all_member->LinkCustomAttributes = "";
		$this->all_member->HrefValue = "";
		$this->all_member->TooltipValue = "";

		// unit_rate
		$this->unit_rate->LinkCustomAttributes = "";
		$this->unit_rate->HrefValue = "";
		$this->unit_rate->TooltipValue = "";

		// total
		$this->total->LinkCustomAttributes = "";
		$this->total->HrefValue = "";
		$this->total->TooltipValue = "";

		// cal_date
		$this->cal_date->LinkCustomAttributes = "";
		$this->cal_date->HrefValue = "";
		$this->cal_date->TooltipValue = "";

		// cal_status
		$this->cal_status->LinkCustomAttributes = "";
		$this->cal_status->HrefValue = "";
		$this->cal_status->TooltipValue = "";

		// invoice_senddate
		$this->invoice_senddate->LinkCustomAttributes = "";
		$this->invoice_senddate->HrefValue = "";
		$this->invoice_senddate->TooltipValue = "";

		// invoice_duedate
		$this->invoice_duedate->LinkCustomAttributes = "";
		$this->invoice_duedate->HrefValue = "";
		$this->invoice_duedate->TooltipValue = "";

		// notice_senddate
		$this->notice_senddate->LinkCustomAttributes = "";
		$this->notice_senddate->HrefValue = "";
		$this->notice_senddate->TooltipValue = "";

		// notice_duedate
		$this->notice_duedate->LinkCustomAttributes = "";
		$this->notice_duedate->HrefValue = "";
		$this->notice_duedate->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
			if (is_numeric($this->count_member->CurrentValue))
				$this->count_member->Total += $this->count_member->CurrentValue; // Accumulate total
			if (is_numeric($this->total->CurrentValue))
				$this->total->Total += $this->total->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
			$this->count_member->CurrentValue = $this->count_member->Total;
			$this->count_member->ViewValue = $this->count_member->CurrentValue;
			$this->count_member->ViewCustomAttributes = "";
			$this->count_member->HrefValue = ""; // Clear href value
			$this->total->CurrentValue = $this->total->Total;
			$this->total->ViewValue = $this->total->CurrentValue;
			$this->total->ViewCustomAttributes = "";
			$this->total->HrefValue = ""; // Clear href value
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
					$XmlDoc->AddField('t_code', $this->t_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('village_id', $this->village_id->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('cal_type', $this->cal_type->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('member_code', $this->member_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('adv_num', $this->adv_num->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('cal_detail', $this->cal_detail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('count_member', $this->count_member->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('unit_rate', $this->unit_rate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('total', $this->total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('cal_status', $this->cal_status->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('invoice_senddate', $this->invoice_senddate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('invoice_duedate', $this->invoice_duedate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('notice_senddate', $this->notice_senddate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('notice_duedate', $this->notice_duedate->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('t_code', $this->t_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('village_id', $this->village_id->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('cal_type', $this->cal_type->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('member_code', $this->member_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('adv_num', $this->adv_num->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('cal_detail', $this->cal_detail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('count_member', $this->count_member->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('unit_rate', $this->unit_rate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('total', $this->total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('cal_status', $this->cal_status->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('invoice_senddate', $this->invoice_senddate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('invoice_duedate', $this->invoice_duedate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('notice_senddate', $this->notice_senddate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('notice_duedate', $this->notice_duedate->ExportValue($this->Export, $this->ExportOriginalValue));
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
				$Doc->ExportCaption($this->t_code);
				$Doc->ExportCaption($this->village_id);
				$Doc->ExportCaption($this->cal_type);
				$Doc->ExportCaption($this->member_code);
				$Doc->ExportCaption($this->adv_num);
				$Doc->ExportCaption($this->cal_detail);
				$Doc->ExportCaption($this->count_member);
				$Doc->ExportCaption($this->unit_rate);
				$Doc->ExportCaption($this->total);
				$Doc->ExportCaption($this->cal_status);
				$Doc->ExportCaption($this->invoice_senddate);
				$Doc->ExportCaption($this->invoice_duedate);
				$Doc->ExportCaption($this->notice_senddate);
				$Doc->ExportCaption($this->notice_duedate);
			} else {
				$Doc->ExportCaption($this->t_code);
				$Doc->ExportCaption($this->village_id);
				$Doc->ExportCaption($this->cal_type);
				$Doc->ExportCaption($this->member_code);
				$Doc->ExportCaption($this->adv_num);
				$Doc->ExportCaption($this->cal_detail);
				$Doc->ExportCaption($this->count_member);
				$Doc->ExportCaption($this->unit_rate);
				$Doc->ExportCaption($this->total);
				$Doc->ExportCaption($this->cal_status);
				$Doc->ExportCaption($this->invoice_senddate);
				$Doc->ExportCaption($this->invoice_duedate);
				$Doc->ExportCaption($this->notice_senddate);
				$Doc->ExportCaption($this->notice_duedate);
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
					$Doc->ExportField($this->t_code);
					$Doc->ExportField($this->village_id);
					$Doc->ExportField($this->cal_type);
					$Doc->ExportField($this->member_code);
					$Doc->ExportField($this->adv_num);
					$Doc->ExportField($this->cal_detail);
					$Doc->ExportField($this->count_member);
					$Doc->ExportField($this->unit_rate);
					$Doc->ExportField($this->total);
					$Doc->ExportField($this->cal_status);
					$Doc->ExportField($this->invoice_senddate);
					$Doc->ExportField($this->invoice_duedate);
					$Doc->ExportField($this->notice_senddate);
					$Doc->ExportField($this->notice_duedate);
				} else {
					$Doc->ExportField($this->t_code);
					$Doc->ExportField($this->village_id);
					$Doc->ExportField($this->cal_type);
					$Doc->ExportField($this->member_code);
					$Doc->ExportField($this->adv_num);
					$Doc->ExportField($this->cal_detail);
					$Doc->ExportField($this->count_member);
					$Doc->ExportField($this->unit_rate);
					$Doc->ExportField($this->total);
					$Doc->ExportField($this->cal_status);
					$Doc->ExportField($this->invoice_senddate);
					$Doc->ExportField($this->invoice_duedate);
					$Doc->ExportField($this->notice_senddate);
					$Doc->ExportField($this->notice_duedate);
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
			$Doc->ExportAggregate($this->t_code, '');
			$Doc->ExportAggregate($this->village_id, '');
			$Doc->ExportAggregate($this->cal_type, '');
			$Doc->ExportAggregate($this->member_code, '');
			$Doc->ExportAggregate($this->adv_num, '');
			$Doc->ExportAggregate($this->cal_detail, '');
			$Doc->ExportAggregate($this->count_member, 'TOTAL');
			$Doc->ExportAggregate($this->unit_rate, '');
			$Doc->ExportAggregate($this->total, 'TOTAL');
			$Doc->ExportAggregate($this->cal_status, '');
			$Doc->ExportAggregate($this->invoice_senddate, '');
			$Doc->ExportAggregate($this->invoice_duedate, '');
			$Doc->ExportAggregate($this->notice_senddate, '');
			$Doc->ExportAggregate($this->notice_duedate, '');
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
		
		
		global $conn;
		
		$conn->Execute("DELETE FROM unpaylist WHERE svc_id = ".$rs["svc_id"]);
		

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
