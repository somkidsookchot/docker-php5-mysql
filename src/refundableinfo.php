<?php

// Global variable for table object
$refundable = NULL;

//
// Table class for refundable
//
class crefundable {
	var $TableVar = 'refundable';
	var $TableName = 'refundable';
	var $TableType = 'TABLE';
	var $refund_id;
	var $member_code;
	var $refund_total;
	var $assc_percent;
	var $assc_total;
	var $sub_total;
	var $refund_status;
	var $pay_date;
	var $calculate_date;
	var $refund_slipt_num;
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
	function crefundable() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// refund_id
		$this->refund_id = new cField('refundable', 'refundable', 'x_refund_id', 'refund_id', '`refund_id`', 3, -1, FALSE, '`refund_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->refund_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['refund_id'] =& $this->refund_id;

		// member_code
		$this->member_code = new cField('refundable', 'refundable', 'x_member_code', 'member_code', '`member_code`', 200, -1, FALSE, '`member_code`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['member_code'] =& $this->member_code;

		// refund_total
		$this->refund_total = new cField('refundable', 'refundable', 'x_refund_total', 'refund_total', '`refund_total`', 4, -1, FALSE, '`refund_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->refund_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['refund_total'] =& $this->refund_total;

		// assc_percent
		$this->assc_percent = new cField('refundable', 'refundable', 'x_assc_percent', 'assc_percent', '`assc_percent`', 3, -1, FALSE, '`assc_percent`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->assc_percent->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['assc_percent'] =& $this->assc_percent;

		// assc_total
		$this->assc_total = new cField('refundable', 'refundable', 'x_assc_total', 'assc_total', '`assc_total`', 4, -1, FALSE, '`assc_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->assc_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['assc_total'] =& $this->assc_total;

		// sub_total
		$this->sub_total = new cField('refundable', 'refundable', 'x_sub_total', 'sub_total', '`sub_total`', 4, -1, FALSE, '`sub_total`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->sub_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['sub_total'] =& $this->sub_total;

		// refund_status
		$this->refund_status = new cField('refundable', 'refundable', 'x_refund_status', 'refund_status', '`refund_status`', 200, -1, FALSE, '`refund_status`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['refund_status'] =& $this->refund_status;

		// pay_date
		$this->pay_date = new cField('refundable', 'refundable', 'x_pay_date', 'pay_date', '`pay_date`', 133, 7, FALSE, '`pay_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->pay_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['pay_date'] =& $this->pay_date;

		// calculate_date
		$this->calculate_date = new cField('refundable', 'refundable', 'x_calculate_date', 'calculate_date', '`calculate_date`', 133, 7, FALSE, '`calculate_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->calculate_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['calculate_date'] =& $this->calculate_date;

		// refund_slipt_num
		$this->refund_slipt_num = new cField('refundable', 'refundable', 'x_refund_slipt_num', 'refund_slipt_num', '`refund_slipt_num`', 3, -1, FALSE, '`refund_slipt_num`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->refund_slipt_num->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['refund_slipt_num'] =& $this->refund_slipt_num;
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
		return "refundable_Highlight";
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
		return "`refundable`";
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
		return "INSERT INTO `refundable` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `refundable` SET ";
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
		$SQL = "DELETE FROM `refundable` WHERE ";
		$SQL .= ew_QuotedName('refund_id') . '=' . ew_QuotedValue($rs['refund_id'], $this->refund_id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`refund_id` = @refund_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->refund_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@refund_id@", ew_AdjustSql($this->refund_id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "refundablelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "refundablelist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("refundableview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "refundableadd.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("refundableedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("refundableadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("refundabledelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->refund_id->CurrentValue)) {
			$sUrl .= "refund_id=" . urlencode($this->refund_id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=refundable" : "";
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
			$arKeys[] = @$_GET["refund_id"]; // refund_id

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
			$this->refund_id->CurrentValue = $key;
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
		$this->refund_id->setDbValue($rs->fields('refund_id'));
		$this->member_code->setDbValue($rs->fields('member_code'));
		$this->refund_total->setDbValue($rs->fields('refund_total'));
		$this->assc_percent->setDbValue($rs->fields('assc_percent'));
		$this->assc_total->setDbValue($rs->fields('assc_total'));
		$this->sub_total->setDbValue($rs->fields('sub_total'));
		$this->refund_status->setDbValue($rs->fields('refund_status'));
		$this->pay_date->setDbValue($rs->fields('pay_date'));
		$this->calculate_date->setDbValue($rs->fields('calculate_date'));
		$this->refund_slipt_num->setDbValue($rs->fields('refund_slipt_num'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// refund_id

		$this->refund_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		$this->member_code->CellCssStyle = "white-space: nowrap;";

		// refund_total
		$this->refund_total->CellCssStyle = "white-space: nowrap;";

		// assc_percent
		$this->assc_percent->CellCssStyle = "white-space: nowrap;";

		// assc_total
		$this->assc_total->CellCssStyle = "white-space: nowrap;";

		// sub_total
		$this->sub_total->CellCssStyle = "white-space: nowrap;";

		// refund_status
		$this->refund_status->CellCssStyle = "white-space: nowrap;";

		// pay_date
		$this->pay_date->CellCssStyle = "white-space: nowrap;";

		// calculate_date
		$this->calculate_date->CellCssStyle = "white-space: nowrap;";

		// refund_slipt_num
		$this->refund_slipt_num->CellCssStyle = "white-space: nowrap;";

		// refund_id
		$this->refund_id->ViewValue = $this->refund_id->CurrentValue;
		$this->refund_id->ViewCustomAttributes = "";

		// member_code
		$this->member_code->ViewValue = $this->member_code->CurrentValue;
		if (strval($this->member_code->CurrentValue) <> "") {
			$sFilterWrk = "`member_code` = '" . ew_AdjustSql($this->member_code->CurrentValue) . "'";
		$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->member_code->ViewValue = $rswrk->fields('member_code');
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

		// refund_total
		$this->refund_total->ViewValue = $this->refund_total->CurrentValue;
		$this->refund_total->ViewValue = ew_FormatCurrency($this->refund_total->ViewValue, 0, -2, -2, -2);
		$this->refund_total->ViewCustomAttributes = "";

		// assc_percent
		$this->assc_percent->ViewValue = $this->assc_percent->CurrentValue;
		$this->assc_percent->ViewCustomAttributes = "";

		// assc_total
		$this->assc_total->ViewValue = $this->assc_total->CurrentValue;
		$this->assc_total->ViewValue = ew_FormatCurrency($this->assc_total->ViewValue, 0, -2, -2, -2);
		$this->assc_total->ViewCustomAttributes = "";

		// sub_total
		$this->sub_total->ViewValue = $this->sub_total->CurrentValue;
		$this->sub_total->ViewValue = ew_FormatCurrency($this->sub_total->ViewValue, 0, -2, -2, -2);
		$this->sub_total->ViewCustomAttributes = "";

		// refund_status
		if (strval($this->refund_status->CurrentValue) <> "") {
			switch ($this->refund_status->CurrentValue) {
				case "รอจ่าย":
					$this->refund_status->ViewValue = $this->refund_status->FldTagCaption(1) <> "" ? $this->refund_status->FldTagCaption(1) : $this->refund_status->CurrentValue;
					break;
				case "จ่ายแล้ว":
					$this->refund_status->ViewValue = $this->refund_status->FldTagCaption(2) <> "" ? $this->refund_status->FldTagCaption(2) : $this->refund_status->CurrentValue;
					break;
				default:
					$this->refund_status->ViewValue = $this->refund_status->CurrentValue;
			}
		} else {
			$this->refund_status->ViewValue = NULL;
		}
		$this->refund_status->ViewCustomAttributes = "";

		// pay_date
		$this->pay_date->ViewValue = $this->pay_date->CurrentValue;
		$this->pay_date->ViewValue = ew_FormatDateTime($this->pay_date->ViewValue, 7);
		$this->pay_date->ViewCustomAttributes = "";

		// calculate_date
		$this->calculate_date->ViewValue = $this->calculate_date->CurrentValue;
		$this->calculate_date->ViewValue = ew_FormatDateTime($this->calculate_date->ViewValue, 7);
		$this->calculate_date->ViewCustomAttributes = "";

		// refund_slipt_num
		$this->refund_slipt_num->ViewValue = $this->refund_slipt_num->CurrentValue;
		$this->refund_slipt_num->ViewCustomAttributes = "";

		// refund_id
		$this->refund_id->LinkCustomAttributes = "";
		$this->refund_id->HrefValue = "";
		$this->refund_id->TooltipValue = "";

		// member_code
		$this->member_code->LinkCustomAttributes = "";
		$this->member_code->HrefValue = "";
		$this->member_code->TooltipValue = "";

		// refund_total
		$this->refund_total->LinkCustomAttributes = "";
		$this->refund_total->HrefValue = "";
		$this->refund_total->TooltipValue = "";

		// assc_percent
		$this->assc_percent->LinkCustomAttributes = "";
		$this->assc_percent->HrefValue = "";
		$this->assc_percent->TooltipValue = "";

		// assc_total
		$this->assc_total->LinkCustomAttributes = "";
		$this->assc_total->HrefValue = "";
		$this->assc_total->TooltipValue = "";

		// sub_total
		$this->sub_total->LinkCustomAttributes = "";
		$this->sub_total->HrefValue = "";
		$this->sub_total->TooltipValue = "";

		// refund_status
		$this->refund_status->LinkCustomAttributes = "";
		$this->refund_status->HrefValue = "";
		$this->refund_status->TooltipValue = "";

		// pay_date
		$this->pay_date->LinkCustomAttributes = "";
		$this->pay_date->HrefValue = "";
		$this->pay_date->TooltipValue = "";

		// calculate_date
		$this->calculate_date->LinkCustomAttributes = "";
		$this->calculate_date->HrefValue = "";
		$this->calculate_date->TooltipValue = "";

		// refund_slipt_num
		$this->refund_slipt_num->LinkCustomAttributes = "";
		$this->refund_slipt_num->HrefValue = "";
		$this->refund_slipt_num->TooltipValue = "";

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
				} else {
					$XmlDoc->AddField('member_code', $this->member_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('refund_total', $this->refund_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('assc_percent', $this->assc_percent->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('assc_total', $this->assc_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('sub_total', $this->sub_total->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('refund_status', $this->refund_status->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('pay_date', $this->pay_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('refund_slipt_num', $this->refund_slipt_num->ExportValue($this->Export, $this->ExportOriginalValue));
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
			} else {
				$Doc->ExportCaption($this->member_code);
				$Doc->ExportCaption($this->refund_total);
				$Doc->ExportCaption($this->assc_percent);
				$Doc->ExportCaption($this->assc_total);
				$Doc->ExportCaption($this->sub_total);
				$Doc->ExportCaption($this->refund_status);
				$Doc->ExportCaption($this->pay_date);
				$Doc->ExportCaption($this->refund_slipt_num);
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
				} else {
					$Doc->ExportField($this->member_code);
					$Doc->ExportField($this->refund_total);
					$Doc->ExportField($this->assc_percent);
					$Doc->ExportField($this->assc_total);
					$Doc->ExportField($this->sub_total);
					$Doc->ExportField($this->refund_status);
					$Doc->ExportField($this->pay_date);
					$Doc->ExportField($this->refund_slipt_num);
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
