<?php

// Global variable for table object
$expresspayment = NULL;

//
// Table class for expresspayment
//
class cexpresspayment {
	var $TableVar = 'expresspayment';
	var $TableName = 'expresspayment';
	var $TableType = 'TABLE';
	var $expr_id;
	var $t_code;
	var $village_id;
	var $subv_total;
	var $subv_detail;
	var $adv_total;
	var $adv_detail;
	var $rc_total;
	var $rc_detail;
	var $annual_total;
	var $annual_detail;
	var $regis_total;
	var $regis_detail;
	var $other_total;
	var $other_detail;
	var $expr_total;
	var $expr_note;
	var $expr_pay_date;
	var $expr_slipt_num;
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
	function cexpresspayment() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// expr_id
		$this->expr_id = new cField('expresspayment', 'expresspayment', 'x_expr_id', 'expr_id', '`expr_id`', 3, -1, FALSE, '`expr_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->expr_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['expr_id'] =& $this->expr_id;

		// t_code
		$this->t_code = new cField('expresspayment', 'expresspayment', 'x_t_code', 't_code', '`t_code`', 200, -1, FALSE, '`t_code`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['t_code'] =& $this->t_code;

		// village_id
		$this->village_id = new cField('expresspayment', 'expresspayment', 'x_village_id', 'village_id', '`village_id`', 3, -1, FALSE, '`village_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->village_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;

		// subv_total
		$this->subv_total = new cField('expresspayment', 'expresspayment', 'x_subv_total', 'subv_total', '`subv_total`', 4, -1, FALSE, '`subv_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->subv_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['subv_total'] =& $this->subv_total;

		// subv_detail
		$this->subv_detail = new cField('expresspayment', 'expresspayment', 'x_subv_detail', 'subv_detail', '`subv_detail`', 200, -1, FALSE, '`subv_detail`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['subv_detail'] =& $this->subv_detail;

		// adv_total
		$this->adv_total = new cField('expresspayment', 'expresspayment', 'x_adv_total', 'adv_total', '`adv_total`', 4, -1, FALSE, '`adv_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->adv_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['adv_total'] =& $this->adv_total;

		// adv_detail
		$this->adv_detail = new cField('expresspayment', 'expresspayment', 'x_adv_detail', 'adv_detail', '`adv_detail`', 200, -1, FALSE, '`adv_detail`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['adv_detail'] =& $this->adv_detail;

	// rc_total
		$this->rc_total = new cField('expresspayment', 'expresspayment', 'x_rc_total', 'rc_total', '`rc_total`', 4, -1, FALSE, '`rc_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->rc_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['rc_total'] =& $this->rc_total;

		// rc_detail
		$this->rc_detail = new cField('expresspayment', 'expresspayment', 'x_rc_detail', 'rc_detail', '`rc_detail`', 200, -1, FALSE, '`rc_detail`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['rc_detail'] =& $this->rc_detail;
		// annual_total
		$this->annual_total = new cField('expresspayment', 'expresspayment', 'x_annual_total', 'annual_total', '`annual_total`', 4, -1, FALSE, '`annual_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->annual_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['annual_total'] =& $this->annual_total;

		// annual_detail
		$this->annual_detail = new cField('expresspayment', 'expresspayment', 'x_annual_detail', 'annual_detail', '`annual_detail`', 200, -1, FALSE, '`annual_detail`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['annual_detail'] =& $this->annual_detail;

		// regis_total
		$this->regis_total = new cField('expresspayment', 'expresspayment', 'x_regis_total', 'regis_total', '`regis_total`', 4, -1, FALSE, '`regis_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->regis_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['regis_total'] =& $this->regis_total;

		// regis_detail
		$this->regis_detail = new cField('expresspayment', 'expresspayment', 'x_regis_detail', 'regis_detail', '`regis_detail`', 200, -1, FALSE, '`regis_detail`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['regis_detail'] =& $this->regis_detail;

		// other_total
		$this->other_total = new cField('expresspayment', 'expresspayment', 'x_other_total', 'other_total', '`other_total`', 4, -1, FALSE, '`other_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->other_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['other_total'] =& $this->other_total;

		// other_detail
		$this->other_detail = new cField('expresspayment', 'expresspayment', 'x_other_detail', 'other_detail', '`other_detail`', 200, -1, FALSE, '`other_detail`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['other_detail'] =& $this->other_detail;

		// expr_total
		$this->expr_total = new cField('expresspayment', 'expresspayment', 'x_expr_total', 'expr_total', '`expr_total`', 4, -1, FALSE, '`expr_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->expr_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['expr_total'] =& $this->expr_total;

		// expr_note
		$this->expr_note = new cField('expresspayment', 'expresspayment', 'x_expr_note', 'expr_note', '`expr_note`', 201, -1, FALSE, '`expr_note`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['expr_note'] =& $this->expr_note;

		// expr_pay_date
		$this->expr_pay_date = new cField('expresspayment', 'expresspayment', 'x_expr_pay_date', 'expr_pay_date', '`expr_pay_date`', 133, 7, FALSE, '`expr_pay_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->expr_pay_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['expr_pay_date'] =& $this->expr_pay_date;

		// expr_slipt_num
		$this->expr_slipt_num = new cField('expresspayment', 'expresspayment', 'x_expr_slipt_num', 'expr_slipt_num', '`expr_slipt_num`', 3, -1, FALSE, '`expr_slipt_num`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->expr_slipt_num->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['expr_slipt_num'] =& $this->expr_slipt_num;
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
		return "expresspayment_Highlight";
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
		return "`expresspayment`";
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
		return "INSERT INTO `expresspayment` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `expresspayment` SET ";
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
		$SQL = "DELETE FROM `expresspayment` WHERE ";
		$SQL .= ew_QuotedName('expr_id') . '=' . ew_QuotedValue($rs['expr_id'], $this->expr_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`expr_id` = @expr_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->expr_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@expr_id@", ew_AdjustSql($this->expr_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "expresspaymentlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "expresspaymentlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("expresspaymentview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "expresspaymentadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("expresspaymentedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("expresspaymentadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("expresspaymentdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->expr_id->CurrentValue)) {
			$sUrl .= "expr_id=" . urlencode($this->expr_id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=expresspayment" : "";
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
			$arKeys[] = @$_GET["expr_id"]; // expr_id

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
			$this->expr_id->CurrentValue = $key;
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
		$this->expr_id->setDbValue($rs->fields('expr_id'));
		$this->t_code->setDbValue($rs->fields('t_code'));
		$this->village_id->setDbValue($rs->fields('village_id'));
		$this->subv_total->setDbValue($rs->fields('subv_total'));
		$this->subv_detail->setDbValue($rs->fields('subv_detail'));
		$this->adv_total->setDbValue($rs->fields('adv_total'));
		$this->adv_detail->setDbValue($rs->fields('adv_detail'));
		$this->rc_total->setDbValue($rs->fields('rc_total'));
		$this->rc_detail->setDbValue($rs->fields('rc_detail'));
		$this->annual_total->setDbValue($rs->fields('annual_total'));
		$this->annual_detail->setDbValue($rs->fields('annual_detail'));
		$this->regis_total->setDbValue($rs->fields('regis_total'));
		$this->regis_detail->setDbValue($rs->fields('regis_detail'));
		$this->other_total->setDbValue($rs->fields('other_total'));
		$this->other_detail->setDbValue($rs->fields('other_detail'));
		$this->expr_total->setDbValue($rs->fields('expr_total'));
		$this->expr_note->setDbValue($rs->fields('expr_note'));
		$this->expr_pay_date->setDbValue($rs->fields('expr_pay_date'));
		$this->expr_slipt_num->setDbValue($rs->fields('expr_slipt_num'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// expr_id

		$this->expr_id->CellCssStyle = "white-space: nowrap;";

		// t_code
		$this->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$this->village_id->CellCssStyle = "white-space: nowrap;";

		// subv_total
		$this->subv_total->CellCssStyle = "white-space: nowrap;";

		// subv_detail
		$this->subv_detail->CellCssStyle = "white-space: nowrap;";

		// adv_total
		$this->adv_total->CellCssStyle = "white-space: nowrap;";

		// adv_detail
		$this->adv_detail->CellCssStyle = "white-space: nowrap;";

		// rc_total
		$this->rc_total->CellCssStyle = "white-space: nowrap;";

		// rc_detail
		$this->rc_detail->CellCssStyle = "white-space: nowrap;";
		// annual_total
		$this->annual_total->CellCssStyle = "white-space: nowrap;";

		// annual_detail
		$this->annual_detail->CellCssStyle = "white-space: nowrap;";

		// regis_total
		$this->regis_total->CellCssStyle = "white-space: nowrap;";

		// regis_detail
		$this->regis_detail->CellCssStyle = "white-space: nowrap;";

		// other_total
		$this->other_total->CellCssStyle = "white-space: nowrap;";

		// other_detail
		$this->other_detail->CellCssStyle = "white-space: nowrap;";

		// expr_total
		$this->expr_total->CellCssStyle = "white-space: nowrap;";

		// expr_note
		$this->expr_note->CellCssStyle = "white-space: nowrap;";

		// expr_pay_date
		$this->expr_pay_date->CellCssStyle = "white-space: nowrap;";

		// expr_slipt_num
		$this->expr_slipt_num->CellCssStyle = "white-space: nowrap;";

		// expr_id
		$this->expr_id->ViewValue = $this->expr_id->CurrentValue;
		$this->expr_id->ViewCustomAttributes = "";

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

		// subv_total
		$this->subv_total->ViewValue = $this->subv_total->CurrentValue;
		$this->subv_total->ViewValue = ew_FormatCurrency($this->subv_total->ViewValue, 0, -2, -2, -2);
		$this->subv_total->ViewCustomAttributes = "";

		// subv_detail
		$this->subv_detail->ViewValue = $this->subv_detail->CurrentValue;
		$this->subv_detail->ViewCustomAttributes = "";

		// adv_total
		$this->adv_total->ViewValue = $this->adv_total->CurrentValue;
		$this->adv_total->ViewValue = ew_FormatCurrency($this->adv_total->ViewValue, 0, -2, -2, -2);
		$this->adv_total->ViewCustomAttributes = "";

		// adv_detail
		$this->adv_detail->ViewValue = $this->adv_detail->CurrentValue;
		$this->adv_detail->ViewCustomAttributes = "";

		// rc_total
		$this->rc_total->ViewValue = $this->rc_total->CurrentValue;
		$this->rc_total->ViewCustomAttributes = "";

		// rc_detail
		$this->rc_detail->ViewValue = $this->rc_detail->CurrentValue;
		$this->rc_detail->ViewCustomAttributes = "";
		// annual_total
		$this->annual_total->ViewValue = $this->annual_total->CurrentValue;
		$this->annual_total->ViewValue = ew_FormatCurrency($this->annual_total->ViewValue, 0, -2, -2, -2);
		$this->annual_total->ViewCustomAttributes = "";

		// annual_detail
		$this->annual_detail->ViewValue = $this->annual_detail->CurrentValue;
		$this->annual_detail->ViewCustomAttributes = "";

		// regis_total
		$this->regis_total->ViewValue = $this->regis_total->CurrentValue;
		$this->regis_total->ViewValue = ew_FormatCurrency($this->regis_total->ViewValue, 0, -2, -2, -2);
		$this->regis_total->ViewCustomAttributes = "";

		// regis_detail
		$this->regis_detail->ViewValue = $this->regis_detail->CurrentValue;
		$this->regis_detail->ViewCustomAttributes = "";

		// other_total
		$this->other_total->ViewValue = $this->other_total->CurrentValue;
		$this->other_total->ViewValue = ew_FormatCurrency($this->other_total->ViewValue, 0, -2, -2, -2);
		$this->other_total->ViewCustomAttributes = "";

		// other_detail
		$this->other_detail->ViewValue = $this->other_detail->CurrentValue;
		$this->other_detail->ViewCustomAttributes = "";

		// expr_total
		$this->expr_total->ViewValue = $this->expr_total->CurrentValue;
		$this->expr_total->ViewValue = ew_FormatCurrency($this->expr_total->ViewValue, 0, -2, -2, -2);
		$this->expr_total->ViewCustomAttributes = "";

		// expr_note
		$this->expr_note->ViewValue = $this->expr_note->CurrentValue;
		$this->expr_note->ViewCustomAttributes = "";

		// expr_pay_date
		$this->expr_pay_date->ViewValue = $this->expr_pay_date->CurrentValue;
		$this->expr_pay_date->ViewValue = ew_FormatDateTime($this->expr_pay_date->ViewValue, 7);
		$this->expr_pay_date->ViewCustomAttributes = "";

		// expr_slipt_num
		$this->expr_slipt_num->ViewValue = $this->expr_slipt_num->CurrentValue;
		$this->expr_slipt_num->ViewCustomAttributes = "";

		// expr_id
		$this->expr_id->LinkCustomAttributes = "";
		$this->expr_id->HrefValue = "";
		$this->expr_id->TooltipValue = "";

		// t_code
		$this->t_code->LinkCustomAttributes = "";
		$this->t_code->HrefValue = "";
		$this->t_code->TooltipValue = "";

		// village_id
		$this->village_id->LinkCustomAttributes = "";
		$this->village_id->HrefValue = "";
		$this->village_id->TooltipValue = "";

		// subv_total
		$this->subv_total->LinkCustomAttributes = "";
		$this->subv_total->HrefValue = "";
		$this->subv_total->TooltipValue = "";

		// subv_detail
		$this->subv_detail->LinkCustomAttributes = "";
		$this->subv_detail->HrefValue = "";
		$this->subv_detail->TooltipValue = "";

		// adv_total
		$this->adv_total->LinkCustomAttributes = "";
		$this->adv_total->HrefValue = "";
		$this->adv_total->TooltipValue = "";

		// adv_detail
		$this->adv_detail->LinkCustomAttributes = "";
		$this->adv_detail->HrefValue = "";
		$this->adv_detail->TooltipValue = "";

		// rc_total
		$this->rc_total->LinkCustomAttributes = "";
		$this->rc_total->HrefValue = "";
		$this->rc_total->TooltipValue = "";

		// rc_detail
		$this->rc_detail->LinkCustomAttributes = "";
		$this->rc_detail->HrefValue = "";
		$this->rc_detail->TooltipValue = "";
		// annual_total
		$this->annual_total->LinkCustomAttributes = "";
		$this->annual_total->HrefValue = "";
		$this->annual_total->TooltipValue = "";

		// annual_detail
		$this->annual_detail->LinkCustomAttributes = "";
		$this->annual_detail->HrefValue = "";
		$this->annual_detail->TooltipValue = "";

		// regis_total
		$this->regis_total->LinkCustomAttributes = "";
		$this->regis_total->HrefValue = "";
		$this->regis_total->TooltipValue = "";

		// regis_detail
		$this->regis_detail->LinkCustomAttributes = "";
		$this->regis_detail->HrefValue = "";
		$this->regis_detail->TooltipValue = "";

		// other_total
		$this->other_total->LinkCustomAttributes = "";
		$this->other_total->HrefValue = "";
		$this->other_total->TooltipValue = "";

		// other_detail
		$this->other_detail->LinkCustomAttributes = "";
		$this->other_detail->HrefValue = "";
		$this->other_detail->TooltipValue = "";

		// expr_total
		$this->expr_total->LinkCustomAttributes = "";
		$this->expr_total->HrefValue = "";
		$this->expr_total->TooltipValue = "";

		// expr_note
		$this->expr_note->LinkCustomAttributes = "";
		$this->expr_note->HrefValue = "";
		$this->expr_note->TooltipValue = "";

		// expr_pay_date
		$this->expr_pay_date->LinkCustomAttributes = "";
		$this->expr_pay_date->HrefValue = "";
		$this->expr_pay_date->TooltipValue = "";

		// expr_slipt_num
		$this->expr_slipt_num->LinkCustomAttributes = "";
		$this->expr_slipt_num->HrefValue = "";
		$this->expr_slipt_num->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
			if (is_numeric($this->subv_total->CurrentValue))
				$this->subv_total->Total += $this->subv_total->CurrentValue; // Accumulate total
			if (is_numeric($this->adv_total->CurrentValue))
				$this->adv_total->Total += $this->adv_total->CurrentValue; // Accumulate total
			if (is_numeric($this->rc_total->CurrentValue))
				$this->rc_total->Total += $this->rc_total->CurrentValue; // Accumulate total
			if (is_numeric($this->annual_total->CurrentValue))
				$this->annual_total->Total += $this->annual_total->CurrentValue; // Accumulate total
			if (is_numeric($this->regis_total->CurrentValue))
				$this->regis_total->Total += $this->regis_total->CurrentValue; // Accumulate total
			if (is_numeric($this->other_total->CurrentValue))
				$this->other_total->Total += $this->other_total->CurrentValue; // Accumulate total
			if (is_numeric($this->expr_total->CurrentValue))
				$this->expr_total->Total += $this->expr_total->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
			$this->subv_total->CurrentValue = $this->subv_total->Total;
			$this->subv_total->ViewValue = $this->subv_total->CurrentValue;
			$this->subv_total->ViewValue = ew_FormatCurrency($this->subv_total->ViewValue, 0, -2, -2, -2);
			$this->subv_total->ViewCustomAttributes = "";
			$this->subv_total->HrefValue = ""; // Clear href value
			$this->adv_total->CurrentValue = $this->adv_total->Total;
			$this->adv_total->ViewValue = $this->adv_total->CurrentValue;
			$this->adv_total->ViewValue = ew_FormatCurrency($this->adv_total->ViewValue, 0, -2, -2, -2);
			$this->adv_total->ViewCustomAttributes = "";
			$this->adv_total->HrefValue = ""; // Clear href value
			$this->rc_total->CurrentValue = $this->rc_total->Total;
			$this->rc_total->ViewValue = $this->rc_total->CurrentValue;
			$this->rc_total->ViewCustomAttributes = "";
			$this->rc_total->HrefValue = ""; // Clear href value
			$this->annual_total->CurrentValue = $this->annual_total->Total;
			$this->annual_total->ViewValue = $this->annual_total->CurrentValue;
			$this->annual_total->ViewValue = ew_FormatCurrency($this->annual_total->ViewValue, 0, -2, -2, -2);
			$this->annual_total->ViewCustomAttributes = "";
			$this->annual_total->HrefValue = ""; // Clear href value
			$this->regis_total->CurrentValue = $this->regis_total->Total;
			$this->regis_total->ViewValue = $this->regis_total->CurrentValue;
			$this->regis_total->ViewValue = ew_FormatCurrency($this->regis_total->ViewValue, 0, -2, -2, -2);
			$this->regis_total->ViewCustomAttributes = "";
			$this->regis_total->HrefValue = ""; // Clear href value
			$this->other_total->CurrentValue = $this->other_total->Total;
			$this->other_total->ViewValue = $this->other_total->CurrentValue;
			$this->other_total->ViewValue = ew_FormatCurrency($this->other_total->ViewValue, 0, -2, -2, -2);
			$this->other_total->ViewCustomAttributes = "";
			$this->other_total->HrefValue = ""; // Clear href value
			$this->expr_total->CurrentValue = $this->expr_total->Total;
			$this->expr_total->ViewValue = $this->expr_total->CurrentValue;
			$this->expr_total->ViewValue = ew_FormatCurrency($this->expr_total->ViewValue, 0, -2, -2, -2);
			$this->expr_total->ViewCustomAttributes = "";
			$this->expr_total->HrefValue = ""; // Clear href value
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
					$XmlDoc->AddField('subv_total', $this->subv_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('subv_detail', $this->subv_detail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('adv_total', $this->adv_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('adv_detail', $this->adv_detail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('rc_total', $this->rc_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('rc_detail', $this->rc_detail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('annual_total', $this->annual_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('annual_detail', $this->annual_detail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('regis_total', $this->regis_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('regis_detail', $this->regis_detail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('other_total', $this->other_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('other_detail', $this->other_detail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('expr_total', $this->expr_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('expr_note', $this->expr_note->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('expr_pay_date', $this->expr_pay_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('expr_slipt_num', $this->expr_slipt_num->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('rc_total', $this->rc_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('rc_detail', $this->rc_detail->ExportValue($this->Export, $this->ExportOriginalValue));
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
				$Doc->ExportCaption($this->subv_total);
				$Doc->ExportCaption($this->subv_detail);
				$Doc->ExportCaption($this->adv_total);
				$Doc->ExportCaption($this->adv_detail);
				$Doc->ExportCaption($this->rc_total);
				$Doc->ExportCaption($this->rc_detail);
				$Doc->ExportCaption($this->annual_total);
				$Doc->ExportCaption($this->annual_detail);
				$Doc->ExportCaption($this->regis_total);
				$Doc->ExportCaption($this->regis_detail);
				$Doc->ExportCaption($this->other_total);
				$Doc->ExportCaption($this->other_detail);
				$Doc->ExportCaption($this->expr_total);
				$Doc->ExportCaption($this->expr_note);
				$Doc->ExportCaption($this->expr_pay_date);
				$Doc->ExportCaption($this->expr_slipt_num);
			} else {
				$Doc->ExportCaption($this->rc_total);
				$Doc->ExportCaption($this->rc_detail);
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
					$Doc->ExportField($this->subv_total);
					$Doc->ExportField($this->subv_detail);
					$Doc->ExportField($this->adv_total);
					$Doc->ExportField($this->adv_detail);
					$Doc->ExportField($this->rc_total);
					$Doc->ExportField($this->rc_detail);
					$Doc->ExportField($this->annual_total);
					$Doc->ExportField($this->annual_detail);
					$Doc->ExportField($this->regis_total);
					$Doc->ExportField($this->regis_detail);
					$Doc->ExportField($this->other_total);
					$Doc->ExportField($this->other_detail);
					$Doc->ExportField($this->expr_total);
					$Doc->ExportField($this->expr_note);
					$Doc->ExportField($this->expr_pay_date);
					$Doc->ExportField($this->expr_slipt_num);
				} else {
					$Doc->ExportField($this->rc_total);
					$Doc->ExportField($this->rc_detail);
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
			$Doc->ExportAggregate($this->rc_total, 'TOTAL');
			$Doc->ExportAggregate($this->rc_detail, '');
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
		$rsnew["expr_total"] = $rsnew["subv_total"]+$rsnew["adv_total"]+$rsnew["annual_total"]+$rsnew["regis_total"]+$rsnew["other_total"] ;
		$rsnew["expr_slipt_num"] = getExprSliptNum()+1;
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

			$rsnew["expr_total"] = $rsnew["subv_total"]+$rsnew["adv_total"]+$rsnew["annual_total"]+$rsnew["regis_total"]+$rsnew["other_total"] ;
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
