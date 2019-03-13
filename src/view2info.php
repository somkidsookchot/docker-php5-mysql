<?php

// Global variable for table object
$view2 = NULL;

//
// Table class for view2
//
class cview2 {
	var $TableVar = 'view2';
	var $TableName = 'view2';
	var $TableType = 'VIEW';
	var $member_code;
	var $id_code;
	var $prefix;
	var $gender;
	var $fname;
	var $lname;
	var $birthdate;
	var $age;
	var $t_code;
	var $t_title;
	var $village_id;
	var $v_title;
	var $bnfc1_name;
	var $dead_date;
	var $note;
	var $dead_id;
	var $member_status;
	var $regis_date;
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
	function cview2() {
		global $Language;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row

		// member_code
		$this->member_code = new cField('view2', 'view2', 'x_member_code', 'member_code', '`member_code`', 200, -1, FALSE, '`member_code`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['member_code'] =& $this->member_code;

		// id_code
		$this->id_code = new cField('view2', 'view2', 'x_id_code', 'id_code', '`id_code`', 200, -1, FALSE, '`id_code`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->id_code->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_code'] =& $this->id_code;

		// prefix
		$this->prefix = new cField('view2', 'view2', 'x_prefix', 'prefix', '`prefix`', 200, -1, FALSE, '`prefix`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['prefix'] =& $this->prefix;

		// gender
		$this->gender = new cField('view2', 'view2', 'x_gender', 'gender', '`gender`', 200, -1, FALSE, '`gender`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['gender'] =& $this->gender;

		// fname
		$this->fname = new cField('view2', 'view2', 'x_fname', 'fname', '`fname`', 200, -1, FALSE, '`fname`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['fname'] =& $this->fname;

		// lname
		$this->lname = new cField('view2', 'view2', 'x_lname', 'lname', '`lname`', 200, -1, FALSE, '`lname`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['lname'] =& $this->lname;

		// birthdate
		$this->birthdate = new cField('view2', 'view2', 'x_birthdate', 'birthdate', '`birthdate`', 133, 6, FALSE, '`birthdate`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->birthdate->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['birthdate'] =& $this->birthdate;

		// age
		$this->age = new cField('view2', 'view2', 'x_age', 'age', '`age`', 3, -1, FALSE, '`age`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->age->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;

		// t_code
		$this->t_code = new cField('view2', 'view2', 'x_t_code', 't_code', '`t_code`', 200, -1, FALSE, '`t_code`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->t_code->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['t_code'] =& $this->t_code;

		// t_title
		$this->t_title = new cField('view2', 'view2', 'x_t_title', 't_title', '`t_title`', 200, -1, FALSE, '`t_title`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['t_title'] =& $this->t_title;

		// village_id
		$this->village_id = new cField('view2', 'view2', 'x_village_id', 'village_id', '`village_id`', 3, -1, FALSE, '`village_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->village_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;

		// v_title
		$this->v_title = new cField('view2', 'view2', 'x_v_title', 'v_title', '`v_title`', 200, -1, FALSE, '`v_title`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['v_title'] =& $this->v_title;

		// bnfc1_name
		$this->bnfc1_name = new cField('view2', 'view2', 'x_bnfc1_name', 'bnfc1_name', '`bnfc1_name`', 201, -1, FALSE, '`bnfc1_name`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['bnfc1_name'] =& $this->bnfc1_name;

		// dead_date
		$this->dead_date = new cField('view2', 'view2', 'x_dead_date', 'dead_date', '`dead_date`', 133, 7, FALSE, '`dead_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->dead_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['dead_date'] =& $this->dead_date;

		// note
		$this->note = new cField('view2', 'view2', 'x_note', 'note', '`note`', 201, -1, FALSE, '`note`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['note'] =& $this->note;

		// dead_id
		$this->dead_id = new cField('view2', 'view2', 'x_dead_id', 'dead_id', '`dead_id`', 3, -1, FALSE, '`dead_id`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->dead_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['dead_id'] =& $this->dead_id;

		// member_status
		$this->member_status = new cField('view2', 'view2', 'x_member_status', 'member_status', '`member_status`', 200, -1, FALSE, '`member_status`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->member_status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['member_status'] =& $this->member_status;

		// regis_date
		$this->regis_date = new cField('view2', 'view2', 'x_regis_date', 'regis_date', '`regis_date`', 133, 7, FALSE, '`regis_date`', FALSE, FALSE, 'FORMATTED TEXT');
		$this->regis_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateDMY"));
		$this->fields['regis_date'] =& $this->regis_date;
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
		return "view2_Highlight";
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
		if ($this->getCurrentDetailTable() == "subvcharge") {
			$sDetailUrl = $GLOBALS["subvcharge"]->ListUrl() . "?showmaster=" . $this->TableVar;
			$sDetailUrl .= "&member_code=" . $this->member_code->CurrentValue;
		}
		return $sDetailUrl;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`view2`";
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
		return "INSERT INTO `view2` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `view2` SET ";
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
		$SQL = "DELETE FROM `view2` WHERE ";
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
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
			return "view2list.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "view2list.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("view2view.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "view2add.php";

//		$sUrlParm = $this->UrlParm();
//		if ($sUrlParm <> "")
//			$AddUrl .= "?" . $sUrlParm;

		return $AddUrl;
	}

	// Edit URL
	function EditUrl($parm = "") {
		return $this->KeyUrl("view2edit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl($parm = "") {
		return $this->KeyUrl("view2add.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("view2delete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=view2" : "";
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

			//return $arKeys; // do not return yet, so the values will also be checked by the following code
		}

		// check keys
		$ar = array();
		foreach ($arKeys as $key) {
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
		$this->member_code->setDbValue($rs->fields('member_code'));
		$this->id_code->setDbValue($rs->fields('id_code'));
		$this->prefix->setDbValue($rs->fields('prefix'));
		$this->gender->setDbValue($rs->fields('gender'));
		$this->fname->setDbValue($rs->fields('fname'));
		$this->lname->setDbValue($rs->fields('lname'));
		$this->birthdate->setDbValue($rs->fields('birthdate'));
		$this->age->setDbValue($rs->fields('age'));
		$this->t_code->setDbValue($rs->fields('t_code'));
		$this->t_title->setDbValue($rs->fields('t_title'));
		$this->village_id->setDbValue($rs->fields('village_id'));
		$this->v_title->setDbValue($rs->fields('v_title'));
		$this->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
		$this->dead_date->setDbValue($rs->fields('dead_date'));
		$this->note->setDbValue($rs->fields('note'));
		$this->dead_id->setDbValue($rs->fields('dead_id'));
		$this->member_status->setDbValue($rs->fields('member_status'));
		$this->regis_date->setDbValue($rs->fields('regis_date'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
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
		// t_code

		$this->t_code->CellCssStyle = "white-space: nowrap;";

		// t_title
		// village_id

		$this->village_id->CellCssStyle = "white-space: nowrap;";

		// v_title
		// bnfc1_name

		$this->bnfc1_name->CellCssStyle = "white-space: nowrap;";

		// dead_date
		$this->dead_date->CellCssStyle = "white-space: nowrap;";

		// note
		// dead_id

		$this->dead_id->CellCssStyle = "white-space: nowrap;";

		// member_status
		$this->member_status->CellCssStyle = "white-space: nowrap;";

		// regis_date
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
		$this->birthdate->ViewValue = ew_FormatDateTime($this->birthdate->ViewValue, 6);
		$this->birthdate->ViewCustomAttributes = "";

		// age
		$this->age->ViewValue = $this->age->CurrentValue;
		$this->age->ViewCustomAttributes = "";

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

		// t_title
		$this->t_title->ViewValue = $this->t_title->CurrentValue;
		$this->t_title->ViewCustomAttributes = "";

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

		// v_title
		$this->v_title->ViewValue = $this->v_title->CurrentValue;
		$this->v_title->ViewCustomAttributes = "";

		// bnfc1_name
		$this->bnfc1_name->ViewValue = $this->bnfc1_name->CurrentValue;
		$this->bnfc1_name->ViewCustomAttributes = "";

		// dead_date
		$this->dead_date->ViewValue = $this->dead_date->CurrentValue;
		$this->dead_date->ViewValue = ew_FormatDateTime($this->dead_date->ViewValue, 7);
		$this->dead_date->ViewCustomAttributes = "";

		// note
		$this->note->ViewValue = $this->note->CurrentValue;
		$this->note->ViewCustomAttributes = "";

		// dead_id
		$this->dead_id->ViewValue = $this->dead_id->CurrentValue;
		$this->dead_id->ViewCustomAttributes = "";

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

		// regis_date
		$this->regis_date->ViewValue = $this->regis_date->CurrentValue;
		$this->regis_date->ViewValue = ew_FormatDateTime($this->regis_date->ViewValue, 7);
		$this->regis_date->ViewCustomAttributes = "";

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

		// t_code
		$this->t_code->LinkCustomAttributes = "";
		$this->t_code->HrefValue = "";
		$this->t_code->TooltipValue = "";

		// t_title
		$this->t_title->LinkCustomAttributes = "";
		$this->t_title->HrefValue = "";
		$this->t_title->TooltipValue = "";

		// village_id
		$this->village_id->LinkCustomAttributes = "";
		$this->village_id->HrefValue = "";
		$this->village_id->TooltipValue = "";

		// v_title
		$this->v_title->LinkCustomAttributes = "";
		$this->v_title->HrefValue = "";
		$this->v_title->TooltipValue = "";

		// bnfc1_name
		$this->bnfc1_name->LinkCustomAttributes = "";
		$this->bnfc1_name->HrefValue = "";
		$this->bnfc1_name->TooltipValue = "";

		// dead_date
		$this->dead_date->LinkCustomAttributes = "";
		$this->dead_date->HrefValue = "";
		$this->dead_date->TooltipValue = "";

		// note
		$this->note->LinkCustomAttributes = "";
		$this->note->HrefValue = "";
		$this->note->TooltipValue = "";

		// dead_id
		$this->dead_id->LinkCustomAttributes = "";
		$this->dead_id->HrefValue = "";
		$this->dead_id->TooltipValue = "";

		// member_status
		$this->member_status->LinkCustomAttributes = "";
		$this->member_status->HrefValue = "";
		$this->member_status->TooltipValue = "";

		// regis_date
		$this->regis_date->LinkCustomAttributes = "";
		$this->regis_date->HrefValue = "";
		$this->regis_date->TooltipValue = "";

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
					$XmlDoc->AddField('age', $this->age->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('t_code', $this->t_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('t_title', $this->t_title->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('village_id', $this->village_id->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('v_title', $this->v_title->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('member_status', $this->member_status->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('regis_date', $this->regis_date->ExportValue($this->Export, $this->ExportOriginalValue));
				} else {
					$XmlDoc->AddField('member_code', $this->member_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('id_code', $this->id_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('prefix', $this->prefix->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('gender', $this->gender->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('fname', $this->fname->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('lname', $this->lname->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('birthdate', $this->birthdate->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('age', $this->age->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('t_code', $this->t_code->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('village_id', $this->village_id->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('dead_date', $this->dead_date->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('note', $this->note->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('dead_id', $this->dead_id->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('member_status', $this->member_status->ExportValue($this->Export, $this->ExportOriginalValue));
					$XmlDoc->AddField('regis_date', $this->regis_date->ExportValue($this->Export, $this->ExportOriginalValue));
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
				$Doc->ExportCaption($this->age);
				$Doc->ExportCaption($this->t_code);
				$Doc->ExportCaption($this->t_title);
				$Doc->ExportCaption($this->village_id);
				$Doc->ExportCaption($this->v_title);
				$Doc->ExportCaption($this->member_status);
				$Doc->ExportCaption($this->regis_date);
			} else {
				$Doc->ExportCaption($this->member_code);
				$Doc->ExportCaption($this->id_code);
				$Doc->ExportCaption($this->prefix);
				$Doc->ExportCaption($this->gender);
				$Doc->ExportCaption($this->fname);
				$Doc->ExportCaption($this->lname);
				$Doc->ExportCaption($this->birthdate);
				$Doc->ExportCaption($this->age);
				$Doc->ExportCaption($this->t_code);
				$Doc->ExportCaption($this->village_id);
				$Doc->ExportCaption($this->dead_date);
				$Doc->ExportCaption($this->note);
				$Doc->ExportCaption($this->dead_id);
				$Doc->ExportCaption($this->member_status);
				$Doc->ExportCaption($this->regis_date);
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
					$Doc->ExportField($this->age);
					$Doc->ExportField($this->t_code);
					$Doc->ExportField($this->t_title);
					$Doc->ExportField($this->village_id);
					$Doc->ExportField($this->v_title);
					$Doc->ExportField($this->member_status);
					$Doc->ExportField($this->regis_date);
				} else {
					$Doc->ExportField($this->member_code);
					$Doc->ExportField($this->id_code);
					$Doc->ExportField($this->prefix);
					$Doc->ExportField($this->gender);
					$Doc->ExportField($this->fname);
					$Doc->ExportField($this->lname);
					$Doc->ExportField($this->birthdate);
					$Doc->ExportField($this->age);
					$Doc->ExportField($this->t_code);
					$Doc->ExportField($this->village_id);
					$Doc->ExportField($this->dead_date);
					$Doc->ExportField($this->note);
					$Doc->ExportField($this->dead_id);
					$Doc->ExportField($this->member_status);
					$Doc->ExportField($this->regis_date);
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
