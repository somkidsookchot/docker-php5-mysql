<?php

// Global variable for table object
$expenseslist = NULL;

//
// Table class for expenseslist
//
class cexpenseslist {
	var $TableVar = 'expenseslist';
	var $TableName = 'expenseslist';
	var $TableType = 'TABLE';
	var $exp_id;
	var $exp_cat;
	var $exp_detail;
	var $exp_total;
	var $exp_date;
	var $exp_dispencer;
	var $exp_slipt_num;
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
	function cexpenseslist() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// exp_id
		$this->exp_id = new cField('expenseslist', 'expenseslist', 'x_exp_id', 'exp_id', '`exp_id`', 3, -1, FALSE, '`exp_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->exp_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['exp_id'] =& $this->exp_id;

		// exp_cat
		$this->exp_cat = new cField('expenseslist', 'expenseslist', 'x_exp_cat', 'exp_cat', '`exp_cat`', 3, -1, FALSE, '`exp_cat`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->exp_cat->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['exp_cat'] =& $this->exp_cat;

		// exp_detail
		$this->exp_detail = new cField('expenseslist', 'expenseslist', 'x_exp_detail', 'exp_detail', '`exp_detail`', 201, -1, FALSE, '`exp_detail`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['exp_detail'] =& $this->exp_detail;

		// exp_total
		$this->exp_total = new cField('expenseslist', 'expenseslist', 'x_exp_total', 'exp_total', '`exp_total`', 4, -1, FALSE, '`exp_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->exp_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['exp_total'] =& $this->exp_total;

		// exp_date
		$this->exp_date = new cField('expenseslist', 'expenseslist', 'x_exp_date', 'exp_date', '`exp_date`', 133, 7, FALSE, '`exp_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->exp_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['exp_date'] =& $this->exp_date;

		// exp_dispencer
		$this->exp_dispencer = new cField('expenseslist', 'expenseslist', 'x_exp_dispencer', 'exp_dispencer', '`exp_dispencer`', 200, -1, FALSE, '`exp_dispencer`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['exp_dispencer'] =& $this->exp_dispencer;

		// exp_slipt_num
		$this->exp_slipt_num = new cField('expenseslist', 'expenseslist', 'x_exp_slipt_num', 'exp_slipt_num', '`exp_slipt_num`', 200, -1, FALSE, '`exp_slipt_num`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->exp_slipt_num->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['exp_slipt_num'] =& $this->exp_slipt_num;
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
		return "expenseslist_Highlight";
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
		if ($this->getCurrentMasterTable() == "expensescategory") {
			if ($this->exp_cat->getSessionValue() <> "")
				$sMasterFilter .= "`exp_cat_id`=" . ew_QuotedValue($this->exp_cat->getSessionValue(), EW_DATATYPE_NUMBER);
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function getDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "expensescategory") {
			if ($this->exp_cat->getSessionValue() <> "")
				$sDetailFilter .= "`exp_cat`=" . ew_QuotedValue($this->exp_cat->getSessionValue(), EW_DATATYPE_NUMBER);
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_expensescategory() {
		return "`exp_cat_id`=@exp_cat_id@";
	}

	// Detail filter
	function SqlDetailFilter_expensescategory() {
		return "`exp_cat`=@exp_cat@";
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`expenseslist`";
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
		return "INSERT INTO `expenseslist` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `expenseslist` SET ";
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
		$SQL = "DELETE FROM `expenseslist` WHERE ";
		$SQL .= ew_QuotedName('exp_id') . '=' . ew_QuotedValue($rs['exp_id'], $this->exp_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`exp_id` = @exp_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->exp_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@exp_id@", ew_AdjustSql($this->exp_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "expenseslistlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "expenseslistlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("expenseslistview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "expenseslistadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("expenseslistedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("expenseslistadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("expenseslistdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->exp_id->CurrentValue)) {
			$sUrl .= "exp_id=" . urlencode($this->exp_id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=expenseslist" : "";
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
			$arKeys[] = @$_GET["exp_id"]; // exp_id

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
			$this->exp_id->CurrentValue = $key;
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
		$this->exp_id->setDbValue($rs->fields('exp_id'));
		$this->exp_cat->setDbValue($rs->fields('exp_cat'));
		$this->exp_detail->setDbValue($rs->fields('exp_detail'));
		$this->exp_total->setDbValue($rs->fields('exp_total'));
		$this->exp_date->setDbValue($rs->fields('exp_date'));
		$this->exp_dispencer->setDbValue($rs->fields('exp_dispencer'));
		$this->exp_slipt_num->setDbValue($rs->fields('exp_slipt_num'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// exp_id

		$this->exp_id->CellCssStyle = "white-space: nowrap;";

		// exp_cat
		$this->exp_cat->CellCssStyle = "white-space: nowrap;";

		// exp_detail
		// exp_total
		// exp_date
		// exp_dispencer
		// exp_slipt_num
		// exp_id

		$this->exp_id->ViewValue = $this->exp_id->CurrentValue;
		$this->exp_id->ViewCustomAttributes = "";

		// exp_cat
		if (strval($this->exp_cat->CurrentValue) <> "") {
			$sFilterWrk = "`exp_cat_id` = " . ew_AdjustSql($this->exp_cat->CurrentValue) . "";
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
				$this->exp_cat->ViewValue = $rswrk->fields('exp_cat_title');
				$rswrk->Close();
			} else {
				$this->exp_cat->ViewValue = $this->exp_cat->CurrentValue;
			}
		} else {
			$this->exp_cat->ViewValue = NULL;
		}
		$this->exp_cat->ViewCustomAttributes = "";

		// exp_detail
		$this->exp_detail->ViewValue = $this->exp_detail->CurrentValue;
		$this->exp_detail->ViewCustomAttributes = "";

		// exp_total
		$this->exp_total->ViewValue = $this->exp_total->CurrentValue;
		$this->exp_total->ViewCustomAttributes = "";

		// exp_date
		$this->exp_date->ViewValue = $this->exp_date->CurrentValue;
		$this->exp_date->ViewValue = ew_FormatDateTime($this->exp_date->ViewValue, 7);
		$this->exp_date->ViewCustomAttributes = "";

		// exp_dispencer
		$this->exp_dispencer->ViewValue = $this->exp_dispencer->CurrentValue;
		$this->exp_dispencer->ViewCustomAttributes = "";

		// exp_slipt_num
		$this->exp_slipt_num->ViewValue = $this->exp_slipt_num->CurrentValue;
		$this->exp_slipt_num->ViewCustomAttributes = "";

		// exp_id
		$this->exp_id->LinkCustomAttributes = "";
		$this->exp_id->HrefValue = "";
		$this->exp_id->TooltipValue = "";

		// exp_cat
		$this->exp_cat->LinkCustomAttributes = "";
		$this->exp_cat->HrefValue = "";
		$this->exp_cat->TooltipValue = "";

		// exp_detail
		$this->exp_detail->LinkCustomAttributes = "";
		$this->exp_detail->HrefValue = "";
		$this->exp_detail->TooltipValue = "";

		// exp_total
		$this->exp_total->LinkCustomAttributes = "";
		$this->exp_total->HrefValue = "";
		$this->exp_total->TooltipValue = "";

		// exp_date
		$this->exp_date->LinkCustomAttributes = "";
		$this->exp_date->HrefValue = "";
		$this->exp_date->TooltipValue = "";

		// exp_dispencer
		$this->exp_dispencer->LinkCustomAttributes = "";
		$this->exp_dispencer->HrefValue = "";
		$this->exp_dispencer->TooltipValue = "";

		// exp_slipt_num
		$this->exp_slipt_num->LinkCustomAttributes = "";
		$this->exp_slipt_num->HrefValue = "";
		$this->exp_slipt_num->TooltipValue = "";

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
					$XmlDoc->AddField('exp_cat', $this->exp_cat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('exp_detail', $this->exp_detail->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('exp_total', $this->exp_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('exp_date', $this->exp_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('exp_dispencer', $this->exp_dispencer->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('exp_slipt_num', $this->exp_slipt_num->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('exp_cat', $this->exp_cat->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('exp_total', $this->exp_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('exp_date', $this->exp_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('exp_dispencer', $this->exp_dispencer->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('exp_slipt_num', $this->exp_slipt_num->ExportValue($this->Export, $this->ExportOriginalValue));
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
				$Doc->ExportCaption($this->exp_cat);
				$Doc->ExportCaption($this->exp_detail);
				$Doc->ExportCaption($this->exp_total);
				$Doc->ExportCaption($this->exp_date);
				$Doc->ExportCaption($this->exp_dispencer);
				$Doc->ExportCaption($this->exp_slipt_num);
			} else {
				$Doc->ExportCaption($this->exp_cat);
				$Doc->ExportCaption($this->exp_total);
				$Doc->ExportCaption($this->exp_date);
				$Doc->ExportCaption($this->exp_dispencer);
				$Doc->ExportCaption($this->exp_slipt_num);
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
					$Doc->ExportField($this->exp_cat);
					$Doc->ExportField($this->exp_detail);
					$Doc->ExportField($this->exp_total);
					$Doc->ExportField($this->exp_date);
					$Doc->ExportField($this->exp_dispencer);
					$Doc->ExportField($this->exp_slipt_num);
				} else {
					$Doc->ExportField($this->exp_cat);
					$Doc->ExportField($this->exp_total);
					$Doc->ExportField($this->exp_date);
					$Doc->ExportField($this->exp_dispencer);
					$Doc->ExportField($this->exp_slipt_num);
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
