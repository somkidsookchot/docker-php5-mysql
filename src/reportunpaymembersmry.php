<?php
session_start();
ob_start();
?>
<?php include "phprptinc/ewrcfg4.php"; ?>
<?php include "phprptinc/ewmysql.php"; ?>
<?php include "phprptinc/ewrfn4.php"; ?>
<?php include "phprptinc/ewrusrfn.php"; ?>
<?php

// Global variable for table object
$reportunpaymember = NULL;

//
// Table class for reportunpaymember
//
class crreportunpaymember {
	var $TableVar = 'reportunpaymember';
	var $TableName = 'reportunpaymember';
	var $TableType = 'REPORT';
	var $ShowCurrentFilter = EWRPT_SHOW_CURRENT_FILTER;
	var $FilterPanelOption = EWRPT_FILTER_PANEL_OPTION;
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type

	// Table caption
	function TableCaption() {
		global $ReportLanguage;
		return $ReportLanguage->TablePhrase($this->TableVar, "TblCaption");
	}

	// Session Group Per Page
	function getGroupPerPage() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_grpperpage"];
	}

	function setGroupPerPage($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_grpperpage"] = $v;
	}

	// Session Start Group
	function getStartGroup() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_start"];
	}

	function setStartGroup($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_start"] = $v;
	}

	// Session Order By
	function getOrderBy() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_orderby"];
	}

	function setOrderBy($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_orderby"] = $v;
	}

//	var $SelectLimit = TRUE;
	var $t_code;
	var $t_title;
	var $v_code;
	var $v_title;
	var $prefix;
	var $fname;
	var $lname;
	var $pt_title;
	var $did;
	var $dname;
	var $member_code;
	var $cal_detail;
	var $adv_num;
	var $unit_rate;
	var $cal_status;
	var $invoice_senddate;
	var $invoice_duedate;
	var $notice_senddate;
	var $notice_duedate;
	var $member_status;
	var $fields = array();
	var $Export; // Export
	var $ExportAll = TRUE;
	var $UseTokenInUrl = EWRPT_USE_TOKEN_IN_URL;
	var $RowType; // Row type
	var $RowTotalType; // Row total type
	var $RowTotalSubType; // Row total subtype
	var $RowGroupLevel; // Row group level
	var $RowAttrs = array(); // Row attributes

	// Reset CSS styles for table object
	function ResetCSS() {
    	$this->RowAttrs["style"] = "";
		$this->RowAttrs["class"] = "";
		foreach ($this->fields as $fld) {
			$fld->ResetCSS();
		}
	}

	//
	// Table class constructor
	//
	function crreportunpaymember() {
		global $ReportLanguage;

		// t_code
		$this->t_code = new crField('reportunpaymember', 'reportunpaymember', 'x_t_code', 't_code', 'tambon.t_code', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->t_code->GroupingFieldId = 2;
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";
		$this->t_code->FldGroupByType = "";
		$this->t_code->FldGroupInt = "0";
		$this->t_code->FldGroupSql = "";

		// t_title
		$this->t_title = new crField('reportunpaymember', 'reportunpaymember', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->t_title->GroupingFieldId = 1;
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "SELECT DISTINCT tambon.t_title FROM " . $this->SqlFrom();
		$this->t_title->SqlOrderBy = "tambon.t_title";
		$this->t_title->FldGroupByType = "";
		$this->t_title->FldGroupInt = "0";
		$this->t_title->FldGroupSql = "";

		// v_code
		$this->v_code = new crField('reportunpaymember', 'reportunpaymember', 'x_v_code', 'v_code', 'village.v_code', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->v_code->GroupingFieldId = 3;
		$this->v_code->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['v_code'] =& $this->v_code;
		$this->v_code->DateFilter = "";
		$this->v_code->SqlSelect = "";
		$this->v_code->SqlOrderBy = "";
		$this->v_code->FldGroupByType = "";
		$this->v_code->FldGroupInt = "0";
		$this->v_code->FldGroupSql = "";

		// v_title
		$this->v_title = new crField('reportunpaymember', 'reportunpaymember', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->v_title->GroupingFieldId = 4;
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "SELECT DISTINCT village.v_title FROM " . $this->SqlFrom();
		$this->v_title->SqlOrderBy = "village.v_title";
		$this->v_title->FldGroupByType = "";
		$this->v_title->FldGroupInt = "0";
		$this->v_title->FldGroupSql = "";

		// prefix
		$this->prefix = new crField('reportunpaymember', 'reportunpaymember', 'x_prefix', 'prefix', 'members.prefix', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['prefix'] =& $this->prefix;
		$this->prefix->DateFilter = "";
		$this->prefix->SqlSelect = "";
		$this->prefix->SqlOrderBy = "";
		$this->prefix->FldGroupByType = "";
		$this->prefix->FldGroupInt = "0";
		$this->prefix->FldGroupSql = "";

		// fname
		$this->fname = new crField('reportunpaymember', 'reportunpaymember', 'x_fname', 'fname', 'members.fname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";
		$this->fname->FldGroupByType = "";
		$this->fname->FldGroupInt = "0";
		$this->fname->FldGroupSql = "";

		// lname
		$this->lname = new crField('reportunpaymember', 'reportunpaymember', 'x_lname', 'lname', 'members.lname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";
		$this->lname->FldGroupByType = "";
		$this->lname->FldGroupInt = "0";
		$this->lname->FldGroupSql = "";

		// pt_title
		$this->pt_title = new crField('reportunpaymember', 'reportunpaymember', 'x_pt_title', 'pt_title', 'paymenttype.pt_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pt_title'] =& $this->pt_title;
		$this->pt_title->DateFilter = "";
		$this->pt_title->SqlSelect = "SELECT DISTINCT paymenttype.pt_title FROM " . $this->SqlFrom();
		$this->pt_title->SqlOrderBy = "paymenttype.pt_title";
		$this->pt_title->FldGroupByType = "";
		$this->pt_title->FldGroupInt = "0";
		$this->pt_title->FldGroupSql = "";

		// did
		$this->did = new crField('reportunpaymember', 'reportunpaymember', 'x_did', 'did', '(Select members.dead_id From members Where members.member_code = subvcalculate.member_code)', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->did->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['did'] =& $this->did;
		$this->did->DateFilter = "";
		$this->did->SqlSelect = "SELECT DISTINCT (Select members.dead_id From members Where members.member_code = subvcalculate.member_code) FROM " . $this->SqlFrom();
		$this->did->SqlOrderBy = "(Select members.dead_id From members Where members.member_code = subvcalculate.member_code)";
		$this->did->FldGroupByType = "";
		$this->did->FldGroupInt = "0";
		$this->did->FldGroupSql = "";

		// dname
		$this->dname = new crField('reportunpaymember', 'reportunpaymember', 'x_dname', 'dname', '(Select members.fname From members Where members.member_code = subvcalculate.member_code)', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['dname'] =& $this->dname;
		$this->dname->DateFilter = "";
		$this->dname->SqlSelect = "SELECT DISTINCT (Select members.fname From members Where members.member_code = subvcalculate.member_code) FROM " . $this->SqlFrom();
		$this->dname->SqlOrderBy = "(Select members.fname From members Where members.member_code = subvcalculate.member_code)";
		$this->dname->FldGroupByType = "";
		$this->dname->FldGroupInt = "0";
		$this->dname->FldGroupSql = "";

		// member_code
		$this->member_code = new crField('reportunpaymember', 'reportunpaymember', 'x_member_code', 'member_code', 'subvcalculate.member_code', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";
		$this->member_code->FldGroupByType = "";
		$this->member_code->FldGroupInt = "0";
		$this->member_code->FldGroupSql = "";

		// cal_detail
		$this->cal_detail = new crField('reportunpaymember', 'reportunpaymember', 'x_cal_detail', 'cal_detail', 'subvcalculate.cal_detail', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['cal_detail'] =& $this->cal_detail;
		$this->cal_detail->DateFilter = "";
		$this->cal_detail->SqlSelect = "";
		$this->cal_detail->SqlOrderBy = "";
		$this->cal_detail->FldGroupByType = "";
		$this->cal_detail->FldGroupInt = "0";
		$this->cal_detail->FldGroupSql = "";

		// adv_num
		$this->adv_num = new crField('reportunpaymember', 'reportunpaymember', 'x_adv_num', 'adv_num', 'subvcalculate.adv_num', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->adv_num->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['adv_num'] =& $this->adv_num;
		$this->adv_num->DateFilter = "";
		$this->adv_num->SqlSelect = "";
		$this->adv_num->SqlOrderBy = "";
		$this->adv_num->FldGroupByType = "";
		$this->adv_num->FldGroupInt = "0";
		$this->adv_num->FldGroupSql = "";

		// unit_rate
		$this->unit_rate = new crField('reportunpaymember', 'reportunpaymember', 'x_unit_rate', 'unit_rate', 'subvcalculate.unit_rate', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->unit_rate->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['unit_rate'] =& $this->unit_rate;
		$this->unit_rate->DateFilter = "";
		$this->unit_rate->SqlSelect = "";
		$this->unit_rate->SqlOrderBy = "";
		$this->unit_rate->FldGroupByType = "";
		$this->unit_rate->FldGroupInt = "0";
		$this->unit_rate->FldGroupSql = "";

		// cal_status
		$this->cal_status = new crField('reportunpaymember', 'reportunpaymember', 'x_cal_status', 'cal_status', 'subvcalculate.cal_status', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['cal_status'] =& $this->cal_status;
		$this->cal_status->DateFilter = "";
		$this->cal_status->SqlSelect = "SELECT DISTINCT subvcalculate.cal_status FROM " . $this->SqlFrom();
		$this->cal_status->SqlOrderBy = "subvcalculate.cal_status";
		$this->cal_status->FldGroupByType = "";
		$this->cal_status->FldGroupInt = "0";
		$this->cal_status->FldGroupSql = "";

		// invoice_senddate
		$this->invoice_senddate = new crField('reportunpaymember', 'reportunpaymember', 'x_invoice_senddate', 'invoice_senddate', 'subvcalculate.invoice_senddate', 133, EWRPT_DATATYPE_DATE, 7);
		$this->invoice_senddate->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['invoice_senddate'] =& $this->invoice_senddate;
		$this->invoice_senddate->DateFilter = "";
		$this->invoice_senddate->SqlSelect = "SELECT DISTINCT subvcalculate.invoice_senddate FROM " . $this->SqlFrom();
		$this->invoice_senddate->SqlOrderBy = "subvcalculate.invoice_senddate";
		$this->invoice_senddate->FldGroupByType = "";
		$this->invoice_senddate->FldGroupInt = "0";
		$this->invoice_senddate->FldGroupSql = "";

		// invoice_duedate
		$this->invoice_duedate = new crField('reportunpaymember', 'reportunpaymember', 'x_invoice_duedate', 'invoice_duedate', 'subvcalculate.invoice_duedate', 133, EWRPT_DATATYPE_DATE, 7);
		$this->invoice_duedate->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['invoice_duedate'] =& $this->invoice_duedate;
		$this->invoice_duedate->DateFilter = "";
		$this->invoice_duedate->SqlSelect = "SELECT DISTINCT subvcalculate.invoice_duedate FROM " . $this->SqlFrom();
		$this->invoice_duedate->SqlOrderBy = "subvcalculate.invoice_duedate";
		$this->invoice_duedate->FldGroupByType = "";
		$this->invoice_duedate->FldGroupInt = "0";
		$this->invoice_duedate->FldGroupSql = "";

		// notice_senddate
		$this->notice_senddate = new crField('reportunpaymember', 'reportunpaymember', 'x_notice_senddate', 'notice_senddate', 'subvcalculate.notice_senddate', 133, EWRPT_DATATYPE_DATE, 7);
		$this->notice_senddate->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['notice_senddate'] =& $this->notice_senddate;
		$this->notice_senddate->DateFilter = "";
		$this->notice_senddate->SqlSelect = "SELECT DISTINCT subvcalculate.notice_senddate FROM " . $this->SqlFrom();
		$this->notice_senddate->SqlOrderBy = "subvcalculate.notice_senddate";
		$this->notice_senddate->FldGroupByType = "";
		$this->notice_senddate->FldGroupInt = "0";
		$this->notice_senddate->FldGroupSql = "";

		// notice_duedate
		$this->notice_duedate = new crField('reportunpaymember', 'reportunpaymember', 'x_notice_duedate', 'notice_duedate', 'subvcalculate.notice_duedate', 133, EWRPT_DATATYPE_DATE, 7);
		$this->notice_duedate->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['notice_duedate'] =& $this->notice_duedate;
		$this->notice_duedate->DateFilter = "";
		$this->notice_duedate->SqlSelect = "SELECT DISTINCT subvcalculate.notice_duedate FROM " . $this->SqlFrom();
		$this->notice_duedate->SqlOrderBy = "subvcalculate.notice_duedate";
		$this->notice_duedate->FldGroupByType = "";
		$this->notice_duedate->FldGroupInt = "0";
		$this->notice_duedate->FldGroupSql = "";

		// member_status
		$this->member_status = new crField('reportunpaymember', 'reportunpaymember', 'x_member_status', 'member_status', 'members.member_status', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_status'] =& $this->member_status;
		$this->member_status->DateFilter = "";
		$this->member_status->SqlSelect = "";
		$this->member_status->SqlOrderBy = "";
		$this->member_status->FldGroupByType = "";
		$this->member_status->FldGroupInt = "0";
		$this->member_status->FldGroupSql = "";
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
		} else {
			if ($ofld->GroupingFieldId == 0) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = "";
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fld->FldExpression, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fld->FldExpression . " " . $fld->getSort();
				} else {
					if ($sDtlSortSql <> "") $sDtlSortSql .= ", ";
					$sDtlSortSql .= $fld->FldExpression . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ",";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "unpaylist Inner Join subvcalculate On unpaylist.svc_id = subvcalculate.svc_id Inner Join members On members.member_id = unpaylist.un_member_id Inner Join village On village.village_id = members.village_id Inner Join tambon On tambon.t_code = village.t_code Inner Join paymenttype On paymenttype.pt_id = unpaylist.un_pay_type";
	}

	function SqlSelect() { // Select
		return "SELECT members.prefix, members.fname, members.lname, paymenttype.pt_title, subvcalculate.unit_rate, subvcalculate.cal_status, subvcalculate.invoice_senddate, subvcalculate.invoice_duedate, subvcalculate.notice_senddate, subvcalculate.notice_duedate, village.v_title, village.v_code, tambon.t_title, tambon.t_code, subvcalculate.adv_num, subvcalculate.cal_detail, subvcalculate.member_code, members.member_status, (Select members.dead_id From members Where members.member_code = subvcalculate.member_code) As did, (Select members.fname From members Where members.member_code = subvcalculate.member_code) As dname, members.member_code FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		return "";
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "tambon.t_title ASC, tambon.t_code ASC, village.v_code ASC, village.v_title ASC";
	}

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "tambon.t_title";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " AS `t_title` FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "tambon.t_title ASC";
	}

	function SqlSelectAgg() {
		return "SELECT SUM(subvcalculate.unit_rate) AS sum_unit_rate FROM " . $this->SqlFrom();
	}

	function SqlAggPfx() {
		return "";
	}

	function SqlAggSfx() {
		return "";
	}

	function SqlSelectCount() {
		return "SELECT COUNT(*) FROM " . $this->SqlFrom();
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = "order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort();
			return ewrpt_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = "";
		foreach ($this->RowAttrs as $k => $v) {
			if (trim($v) <> "")
				$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
		}
		return $sAtt;
	}

	// Field object by fldvar
	function &fields($fldvar) {
		return $this->fields[$fldvar];
	}

	// Table level events
	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Load Custom Filters event
	function CustomFilters_Load() {

		// Enter your code here	
		// ewrpt_RegisterCustomFilter($this-><Field>, 'LastMonth', 'Last Month', 'GetLastMonthFilter'); // Date example
		// ewrpt_RegisterCustomFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // String example

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//global $MyTable;
		//$MyTable->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Chart Rendering event
	function Chart_Rendering(&$chart) {

		// var_dump($chart);
	}

	// Chart Rendered event
	function Chart_Rendered($chart, &$chartxml) {

		//var_dump($chart);
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$reportunpaymember_summary = new crreportunpaymember_summary();
$Page =& $reportunpaymember_summary;

// Page init
$reportunpaymember_summary->Page_Init();

// Page main
$reportunpaymember_summary->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($reportunpaymember->Export == "") { ?>
<script type="text/javascript">

// Create page object
var reportunpaymember_summary = new ewrpt_Page("reportunpaymember_summary");

// page properties
reportunpaymember_summary.PageID = "summary"; // page ID
reportunpaymember_summary.FormID = "freportunpaymembersummaryfilter"; // form ID
var EWRPT_PAGE_ID = reportunpaymember_summary.PageID;

// extend page with ValidateForm function
reportunpaymember_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
reportunpaymember_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
reportunpaymember_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
reportunpaymember_summary.ValidateRequired = false; // no JavaScript validation
<?php } ?>
</script>
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-1.css" title="win2k-1" />
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php $reportunpaymember_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $reportunpaymember_summary->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php if ($reportunpaymember->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($reportunpaymember->t_title, $reportunpaymember->t_title->FldType); ?>
ewrpt_CreatePopup("reportunpaymember_t_title", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportunpaymember->v_title, $reportunpaymember->v_title->FldType); ?>
ewrpt_CreatePopup("reportunpaymember_v_title", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportunpaymember->pt_title, $reportunpaymember->pt_title->FldType); ?>
ewrpt_CreatePopup("reportunpaymember_pt_title", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportunpaymember->did, $reportunpaymember->did->FldType); ?>
ewrpt_CreatePopup("reportunpaymember_did", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportunpaymember->dname, $reportunpaymember->dname->FldType); ?>
ewrpt_CreatePopup("reportunpaymember_dname", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportunpaymember->cal_status, $reportunpaymember->cal_status->FldType); ?>
ewrpt_CreatePopup("reportunpaymember_cal_status", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportunpaymember->invoice_senddate, $reportunpaymember->invoice_senddate->FldType); ?>
ewrpt_CreatePopup("reportunpaymember_invoice_senddate", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportunpaymember->invoice_duedate, $reportunpaymember->invoice_duedate->FldType); ?>
ewrpt_CreatePopup("reportunpaymember_invoice_duedate", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportunpaymember->notice_senddate, $reportunpaymember->notice_senddate->FldType); ?>
ewrpt_CreatePopup("reportunpaymember_notice_senddate", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportunpaymember->notice_duedate, $reportunpaymember->notice_duedate->FldType); ?>
ewrpt_CreatePopup("reportunpaymember_notice_duedate", [<?php echo $jsdata ?>]);
</script>
<div id="reportunpaymember_t_title_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportunpaymember_v_title_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportunpaymember_pt_title_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportunpaymember_did_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportunpaymember_dname_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportunpaymember_cal_status_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportunpaymember_invoice_senddate_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportunpaymember_invoice_duedate_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportunpaymember_notice_senddate_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportunpaymember_notice_duedate_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<div class="ewTitle"><?php if (!$_GET["export"]) { ?><img src="images/ico_unpay.png" width="40" height="40" align="absmiddle" /><?php }?><?php echo $reportunpaymember->TableCaption() ?></div>
<br />
<?php if ($reportunpaymember->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($reportunpaymember->Export == "") { ?>
<?php
if ($reportunpaymember->FilterPanelOption == 2 || ($reportunpaymember->FilterPanelOption == 3 && $reportunpaymember_summary->FilterApplied) || $reportunpaymember_summary->Filter == "0=101") {
	$sButtonImage = "phprptimages/collapse.png";
	$sDivDisplay = "";
} else {
	$sButtonImage = "phprptimages/expand.png";
	$sDivDisplay = " style=\"display: none;\"";
}
?>
<a href="javascript:ewrpt_ToggleFilterPanel();" style="text-decoration: none;"><img id="ewrptToggleFilterImg" src="<?php echo $sButtonImage ?>" alt=""  align="absbottom" border="0"></a><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("Filters") ?> <?php if ($reportunpaymember_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="reportunpaymembersmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>&nbsp;&nbsp;<a href="<?php echo $reportunpaymember_summary->ExportExcelUrl ?>"><img src="images/bt_export_excel.png" align="absmiddle" border="0"/></a></span><br /><br />
<div id="ewrptExtFilterPanel"<?php echo $sDivDisplay ?> class="listSearch">
<!-- Search form (begin) -->
<form name="freportunpaymembersummaryfilter" id="freportunpaymembersummaryfilter" action="reportunpaymembersmry.php" class="ewForm" onsubmit="return reportunpaymember_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportunpaymember->fname->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_fname" id="so1_fname" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_fname" id="sv1_fname" size="30" maxlength="45" value="<?php echo ewrpt_HtmlEncode($reportunpaymember->fname->SearchValue) ?>"<?php echo ($reportunpaymember_summary->ClearExtFilter == 'reportunpaymember_fname') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportunpaymember->lname->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_lname" id="so1_lname" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_lname" id="sv1_lname" size="30" maxlength="45" value="<?php echo ewrpt_HtmlEncode($reportunpaymember->lname->SearchValue) ?>"<?php echo ($reportunpaymember_summary->ClearExtFilter == 'reportunpaymember_lname') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportunpaymember->member_code->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_member_code" id="so1_member_code" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_member_code" id="sv1_member_code" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($reportunpaymember->member_code->SearchValue) ?>"<?php echo ($reportunpaymember_summary->ClearExtFilter == 'reportunpaymember_member_code') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
</table>
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo $ReportLanguage->Phrase("Search") ?>">&nbsp;
			<input type="Reset" name="Reset" id="Reset" value="<?php echo $ReportLanguage->Phrase("Reset") ?>">&nbsp;
		</span></td>
	</tr>
</table>
</form>
<!-- Search form (end) -->
</div>
<?php } ?>
<?php if ($reportunpaymember->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $reportunpaymember_summary->ShowFilterList() ?>
</div>
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($reportunpaymember->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="reportunpaymembersmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportunpaymember_summary->StartGrp, $reportunpaymember_summary->DisplayGrps, $reportunpaymember_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportunpaymembersmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportunpaymembersmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportunpaymembersmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportunpaymembersmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/lastdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("of") ?> <?php echo $Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Record") ?> <?php echo $Pager->FromIndex ?> <?php echo $ReportLanguage->Phrase("To") ?> <?php echo $Pager->ToIndex ?> <?php echo $ReportLanguage->Phrase("Of") ?> <?php echo $Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($reportunpaymember_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportunpaymember_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportunpaymember_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportunpaymember_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportunpaymember_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportunpaymember_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportunpaymember_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportunpaymember_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportunpaymember_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportunpaymember_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportunpaymember->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
</select>
		</span></td>
<?php } ?>
	</tr>
</table>
</form>
</div>
<?php } ?>
<!-- Report Grid (Begin) -->
<div class="ewGridMiddlePanel">
<table class="ewTable ewTableSeparate" cellspacing="0">
<?php

// Set the last group to display if not export all
if ($reportunpaymember->ExportAll && $reportunpaymember->Export <> "") {
	$reportunpaymember_summary->StopGrp = $reportunpaymember_summary->TotalGrps;
} else {
	$reportunpaymember_summary->StopGrp = $reportunpaymember_summary->StartGrp + $reportunpaymember_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($reportunpaymember_summary->StopGrp) > intval($reportunpaymember_summary->TotalGrps))
	$reportunpaymember_summary->StopGrp = $reportunpaymember_summary->TotalGrps;
$reportunpaymember_summary->RecCount = 0;

// Get first row
if ($reportunpaymember_summary->TotalGrps > 0) {
	$reportunpaymember_summary->GetGrpRow(1);
	$reportunpaymember_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $reportunpaymember_summary->GrpCount <= $reportunpaymember_summary->DisplayGrps) || $reportunpaymember_summary->ShowFirstHeader) {

	// Show header
	if ($reportunpaymember_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->t_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->t_title) ?>',1);"><?php echo $reportunpaymember->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportunpaymember_t_title', false, '<?php echo $reportunpaymember->t_title->RangeFrom; ?>', '<?php echo $reportunpaymember->t_title->RangeTo; ?>');return false;" name="x_t_title<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>" id="x_t_title<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->t_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->t_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->t_code) ?>',1);"><?php echo $reportunpaymember->t_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->t_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->t_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->v_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->v_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->v_code) ?>',1);"><?php echo $reportunpaymember->v_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->v_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->v_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->v_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->v_title) ?>',1);"><?php echo $reportunpaymember->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportunpaymember_v_title', false, '<?php echo $reportunpaymember->v_title->RangeFrom; ?>', '<?php echo $reportunpaymember->v_title->RangeTo; ?>');return false;" name="x_v_title<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>" id="x_v_title<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->prefix) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->prefix->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->prefix) ?>',1);"><?php echo $reportunpaymember->prefix->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->prefix->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->prefix->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->fname) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->fname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->fname) ?>',1);"><?php echo $reportunpaymember->fname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->fname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->fname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->lname) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->lname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->lname) ?>',1);"><?php echo $reportunpaymember->lname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->lname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->lname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->pt_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->pt_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->pt_title) ?>',1);"><?php echo $reportunpaymember->pt_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->pt_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->pt_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportunpaymember_pt_title', false, '<?php echo $reportunpaymember->pt_title->RangeFrom; ?>', '<?php echo $reportunpaymember->pt_title->RangeTo; ?>');return false;" name="x_pt_title<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>" id="x_pt_title<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->did) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->did->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->did) ?>',1);"><?php echo $reportunpaymember->did->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->did->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->did->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportunpaymember_did', false, '<?php echo $reportunpaymember->did->RangeFrom; ?>', '<?php echo $reportunpaymember->did->RangeTo; ?>');return false;" name="x_did<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>" id="x_did<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->dname) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->dname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->dname) ?>',1);"><?php echo $reportunpaymember->dname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->dname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->dname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportunpaymember_dname', false, '<?php echo $reportunpaymember->dname->RangeFrom; ?>', '<?php echo $reportunpaymember->dname->RangeTo; ?>');return false;" name="x_dname<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>" id="x_dname<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->cal_detail) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->cal_detail->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->cal_detail) ?>',1);"><?php echo $reportunpaymember->cal_detail->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->cal_detail->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->cal_detail->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->adv_num) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->adv_num->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->adv_num) ?>',1);"><?php echo $reportunpaymember->adv_num->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->adv_num->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->adv_num->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->unit_rate) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->unit_rate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->unit_rate) ?>',1);"><?php echo $reportunpaymember->unit_rate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->unit_rate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->unit_rate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->cal_status) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->cal_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->cal_status) ?>',1);"><?php echo $reportunpaymember->cal_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->cal_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->cal_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportunpaymember_cal_status', false, '<?php echo $reportunpaymember->cal_status->RangeFrom; ?>', '<?php echo $reportunpaymember->cal_status->RangeTo; ?>');return false;" name="x_cal_status<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>" id="x_cal_status<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->invoice_senddate) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->invoice_senddate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->invoice_senddate) ?>',1);"><?php echo $reportunpaymember->invoice_senddate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->invoice_senddate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->invoice_senddate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportunpaymember_invoice_senddate', true, '<?php echo $reportunpaymember->invoice_senddate->RangeFrom; ?>', '<?php echo $reportunpaymember->invoice_senddate->RangeTo; ?>');return false;" name="x_invoice_senddate<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>" id="x_invoice_senddate<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->invoice_duedate) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->invoice_duedate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->invoice_duedate) ?>',1);"><?php echo $reportunpaymember->invoice_duedate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->invoice_duedate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->invoice_duedate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportunpaymember_invoice_duedate', true, '<?php echo $reportunpaymember->invoice_duedate->RangeFrom; ?>', '<?php echo $reportunpaymember->invoice_duedate->RangeTo; ?>');return false;" name="x_invoice_duedate<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>" id="x_invoice_duedate<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->notice_senddate) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->notice_senddate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->notice_senddate) ?>',1);"><?php echo $reportunpaymember->notice_senddate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->notice_senddate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->notice_senddate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportunpaymember_notice_senddate', true, '<?php echo $reportunpaymember->notice_senddate->RangeFrom; ?>', '<?php echo $reportunpaymember->notice_senddate->RangeTo; ?>');return false;" name="x_notice_senddate<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>" id="x_notice_senddate<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->notice_duedate) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->notice_duedate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->notice_duedate) ?>',1);"><?php echo $reportunpaymember->notice_duedate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->notice_duedate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->notice_duedate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportunpaymember_notice_duedate', true, '<?php echo $reportunpaymember->notice_duedate->RangeFrom; ?>', '<?php echo $reportunpaymember->notice_duedate->RangeTo; ?>');return false;" name="x_notice_duedate<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>" id="x_notice_duedate<?php echo $reportunpaymember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportunpaymember->SortUrl($reportunpaymember->member_status) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportunpaymember->member_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportunpaymember->SortUrl($reportunpaymember->member_status) ?>',1);"><?php echo $reportunpaymember->member_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportunpaymember->member_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportunpaymember->member_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$reportunpaymember_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($reportunpaymember->t_title, $reportunpaymember->SqlFirstGroupField(), $reportunpaymember->t_title->GroupValue());
	if ($reportunpaymember_summary->Filter != "")
		$sWhere = "($reportunpaymember_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($reportunpaymember->SqlSelect(), $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), $reportunpaymember->SqlOrderBy(), $sWhere, $reportunpaymember_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$reportunpaymember_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$reportunpaymember_summary->RecCount++;

		// Render detail row
		$reportunpaymember->ResetCSS();
		$reportunpaymember->RowType = EWRPT_ROWTYPE_DETAIL;
		$reportunpaymember_summary->RenderRow();
?>
	<tr<?php echo $reportunpaymember->RowAttributes(); ?>>
		<td<?php echo $reportunpaymember->t_title->CellAttributes(); ?>><div<?php echo $reportunpaymember->t_title->ViewAttributes(); ?>><?php echo $reportunpaymember->t_title->GroupViewValue; ?></div></td>
		<td<?php echo $reportunpaymember->t_code->CellAttributes(); ?>><div<?php echo $reportunpaymember->t_code->ViewAttributes(); ?>><?php echo $reportunpaymember->t_code->GroupViewValue; ?></div></td>
		<td<?php echo $reportunpaymember->v_code->CellAttributes(); ?>><div<?php echo $reportunpaymember->v_code->ViewAttributes(); ?>><?php echo $reportunpaymember->v_code->GroupViewValue; ?></div></td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes(); ?>><div<?php echo $reportunpaymember->v_title->ViewAttributes(); ?>><?php echo $reportunpaymember->v_title->GroupViewValue; ?></div></td>
		<td<?php echo $reportunpaymember->prefix->CellAttributes() ?>>
<div<?php echo $reportunpaymember->prefix->ViewAttributes(); ?>><?php echo $reportunpaymember->prefix->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->fname->CellAttributes() ?>>
<div<?php echo $reportunpaymember->fname->ViewAttributes(); ?>><?php echo $reportunpaymember->fname->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->lname->CellAttributes() ?>>
<div<?php echo $reportunpaymember->lname->ViewAttributes(); ?>><?php echo $reportunpaymember->lname->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->pt_title->CellAttributes() ?>>
<div<?php echo $reportunpaymember->pt_title->ViewAttributes(); ?>><?php echo $reportunpaymember->pt_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->did->CellAttributes() ?>>
<div<?php echo $reportunpaymember->did->ViewAttributes(); ?>><?php echo $reportunpaymember->did->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->dname->CellAttributes() ?>>
<div<?php echo $reportunpaymember->dname->ViewAttributes(); ?>><?php echo $reportunpaymember->dname->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->cal_detail->CellAttributes() ?>>
<div<?php echo $reportunpaymember->cal_detail->ViewAttributes(); ?>><?php echo $reportunpaymember->cal_detail->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->adv_num->CellAttributes() ?>>
<div<?php echo $reportunpaymember->adv_num->ViewAttributes(); ?>><?php echo $reportunpaymember->adv_num->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->unit_rate->CellAttributes() ?>>
<div<?php echo $reportunpaymember->unit_rate->ViewAttributes(); ?>><?php echo $reportunpaymember->unit_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->cal_status->CellAttributes() ?>>
<div<?php echo $reportunpaymember->cal_status->ViewAttributes(); ?>><?php echo $reportunpaymember->cal_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->invoice_senddate->CellAttributes() ?>>
<div<?php echo $reportunpaymember->invoice_senddate->ViewAttributes(); ?>><?php echo $reportunpaymember->invoice_senddate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->invoice_duedate->CellAttributes() ?>>
<div<?php echo $reportunpaymember->invoice_duedate->ViewAttributes(); ?>><?php echo $reportunpaymember->invoice_duedate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->notice_senddate->CellAttributes() ?>>
<div<?php echo $reportunpaymember->notice_senddate->ViewAttributes(); ?>><?php echo $reportunpaymember->notice_senddate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->notice_duedate->CellAttributes() ?>>
<div<?php echo $reportunpaymember->notice_duedate->ViewAttributes(); ?>><?php echo $reportunpaymember->notice_duedate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->member_status->CellAttributes() ?>>
<div<?php echo $reportunpaymember->member_status->ViewAttributes(); ?>><?php echo $reportunpaymember->member_status->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$reportunpaymember_summary->AccumulateSummary();

		// Get next record
		$reportunpaymember_summary->GetRow(2);

		// Show Footers
?>
<?php
		if ($reportunpaymember_summary->ChkLvlBreak(4)) {
			$reportunpaymember->ResetCSS();
			$reportunpaymember->RowType = EWRPT_ROWTYPE_TOTAL;
			$reportunpaymember->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$reportunpaymember->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$reportunpaymember->RowGroupLevel = 4;
			$reportunpaymember_summary->RenderRow();
?>
	<tr<?php echo $reportunpaymember->RowAttributes(); ?>>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_code->CellAttributes() ?>>&nbsp;</td>
		<td colspan="16"<?php echo $reportunpaymember->v_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $reportunpaymember->v_title->FldCaption() ?>: <?php echo $reportunpaymember->v_title->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($reportunpaymember_summary->Cnt[4][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$reportunpaymember->ResetCSS();
			$reportunpaymember->unit_rate->Count = $reportunpaymember_summary->Cnt[4][9];
			$reportunpaymember->unit_rate->Summary = $reportunpaymember_summary->Smry[4][9]; // Load SUM
			$reportunpaymember->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$reportunpaymember_summary->RenderRow();
?>
	<tr<?php echo $reportunpaymember->RowAttributes(); ?>>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_code->CellAttributes() ?>>&nbsp;</td>
		<td colspan="1"<?php echo $reportunpaymember->v_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>
<div<?php echo $reportunpaymember->unit_rate->ViewAttributes(); ?>><?php echo $reportunpaymember->unit_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->v_title->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 4 summary
			$reportunpaymember_summary->ResetLevelSummary(4);
		} // End check level check
?>
<?php
	} // End detail records loop
?>
<?php
			$reportunpaymember->ResetCSS();
			$reportunpaymember->RowType = EWRPT_ROWTYPE_TOTAL;
			$reportunpaymember->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$reportunpaymember->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$reportunpaymember->RowGroupLevel = 1;
			$reportunpaymember_summary->RenderRow();
?>
	<tr<?php echo $reportunpaymember->RowAttributes(); ?>>
		<td colspan="19"<?php echo $reportunpaymember->t_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $reportunpaymember->t_title->FldCaption() ?>: <?php echo $reportunpaymember->t_title->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($reportunpaymember_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$reportunpaymember->ResetCSS();
			$reportunpaymember->unit_rate->Count = $reportunpaymember_summary->Cnt[1][9];
			$reportunpaymember->unit_rate->Summary = $reportunpaymember_summary->Smry[1][9]; // Load SUM
			$reportunpaymember->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$reportunpaymember_summary->RenderRow();
?>
	<tr<?php echo $reportunpaymember->RowAttributes(); ?>>
		<td colspan="4"<?php echo $reportunpaymember->t_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>
<div<?php echo $reportunpaymember->unit_rate->ViewAttributes(); ?>><?php echo $reportunpaymember->unit_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->t_title->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 1 summary
			$reportunpaymember_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$reportunpaymember_summary->GetGrpRow(2);
	$reportunpaymember_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($reportunpaymember_summary->TotalGrps > 0) {
	$reportunpaymember->ResetCSS();
	$reportunpaymember->RowType = EWRPT_ROWTYPE_TOTAL;
	$reportunpaymember->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$reportunpaymember->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$reportunpaymember->RowAttrs["class"] = "ewRptGrandSummary";
	$reportunpaymember_summary->RenderRow();
?>
	<!-- tr><td colspan="19"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $reportunpaymember->RowAttributes(); ?>><td colspan="19"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($reportunpaymember_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
	$reportunpaymember->ResetCSS();
	$reportunpaymember->unit_rate->Count = $reportunpaymember_summary->TotCount;
	$reportunpaymember->unit_rate->Summary = $reportunpaymember_summary->GrandSmry[9]; // Load SUM
	$reportunpaymember->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportunpaymember->unit_rate->CurrentValue = $reportunpaymember->unit_rate->Summary;
	$reportunpaymember->RowAttrs["class"] = "ewRptGrandSummary";
	$reportunpaymember_summary->RenderRow();
?>
	<tr<?php echo $reportunpaymember->RowAttributes(); ?>>
		<td colspan="4" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportunpaymember->prefix->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->fname->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->lname->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->pt_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->did->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->dname->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->cal_detail->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->adv_num->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->unit_rate->CellAttributes() ?>>
<div<?php echo $reportunpaymember->unit_rate->ViewAttributes(); ?>><?php echo $reportunpaymember->unit_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportunpaymember->cal_status->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->invoice_senddate->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->invoice_duedate->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->notice_senddate->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->notice_duedate->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportunpaymember->member_status->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($reportunpaymember_summary->TotalGrps > 0) { ?>
<?php if ($reportunpaymember->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="reportunpaymembersmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportunpaymember_summary->StartGrp, $reportunpaymember_summary->DisplayGrps, $reportunpaymember_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportunpaymembersmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportunpaymembersmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportunpaymembersmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportunpaymembersmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/lastdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("of") ?> <?php echo $Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Record") ?> <?php echo $Pager->FromIndex ?> <?php echo $ReportLanguage->Phrase("To") ?> <?php echo $Pager->ToIndex ?> <?php echo $ReportLanguage->Phrase("Of") ?> <?php echo $Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($reportunpaymember_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportunpaymember_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportunpaymember_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportunpaymember_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportunpaymember_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportunpaymember_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportunpaymember_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportunpaymember_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportunpaymember_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportunpaymember_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportunpaymember->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
</select>
		</span></td>
<?php } ?>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
</div>
<!-- Summary Report Ends -->
<?php if ($reportunpaymember->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($reportunpaymember->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $reportunpaymember_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($reportunpaymember->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php if (@$gsExport == "") { ?>
<?php include "footer.php"; ?>
<?php } ?>
<?php
$reportunpaymember_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crreportunpaymember_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'reportunpaymember';

	// Page object name
	var $PageObjName = 'reportunpaymember_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $reportunpaymember;
		if ($reportunpaymember->UseTokenInUrl) $PageUrl .= "t=" . $reportunpaymember->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Export URLs
	var $ExportPrintUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EWRPT_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EWRPT_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EWRPT_SESSION_MESSAGE] .= "<br />" . $v;
		} else {
			$_SESSION[EWRPT_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EWRPT_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p><span class=\"phpreportmaker\">" . $sHeader . "</span></p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p><span class=\"phpreportmaker\">" . $sFooter . "</span></p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $reportunpaymember;
		if ($reportunpaymember->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($reportunpaymember->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($reportunpaymember->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crreportunpaymember_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (reportunpaymember)
		$GLOBALS["reportunpaymember"] = new crreportunpaymember();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'reportunpaymember', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new crTimer();

		// Open connection
		$conn = ewrpt_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $ReportLanguage, $Security;
		global $reportunpaymember;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$reportunpaymember->Export = $_GET["export"];
	}
	$gsExport = $reportunpaymember->Export; // Get export parameter, used in header
	$gsExportFile = $reportunpaymember->TableVar; // Get export file, used in header
	if ($reportunpaymember->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}

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
		global $ReportLanguage;
		global $reportunpaymember;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($reportunpaymember->Export == "email") {
			$sContent = ob_get_contents();
			$this->ExportEmail($sContent);
			ob_end_clean();

			 // Close connection
			$conn->Close();
			header("Location: " . ewrpt_CurrentPage());
			exit();
		}

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EWRPT_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Initialize common variables
	// Paging variables

	var $RecCount = 0; // Record count
	var $StartGrp = 0; // Start group
	var $StopGrp = 0; // Stop group
	var $TotalGrps = 0; // Total groups
	var $GrpCount = 0; // Group count
	var $DisplayGrps = 3; // Groups per page
	var $GrpRange = 10;
	var $Sort = "";
	var $Filter = "";
	var $UserIDFilter = "";

	// Clear field for ext filter
	var $ClearExtFilter = "";
	var $FilterApplied;
	var $ShowFirstHeader;
	var $Cnt, $Col, $Val, $Smry, $Mn, $Mx, $GrandSmry, $GrandMn, $GrandMx;
	var $TotCount;

	//
	// Page main
	//
	function Page_Main() {
		global $reportunpaymember;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 16;
		$nGrps = 5;
		$this->Val = ewrpt_InitArray($nDtls, 0);
		$this->Cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandSmry = ewrpt_InitArray($nDtls, 0);
		$this->GrandMn = ewrpt_InitArray($nDtls, NULL);
		$this->GrandMx = ewrpt_InitArray($nDtls, NULL);

		// Set up if accumulation required
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, TRUE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$reportunpaymember->t_title->SelectionList = "";
		$reportunpaymember->t_title->DefaultSelectionList = "";
		$reportunpaymember->t_title->ValueList = "";
		$reportunpaymember->v_title->SelectionList = "";
		$reportunpaymember->v_title->DefaultSelectionList = "";
		$reportunpaymember->v_title->ValueList = "";
		$reportunpaymember->pt_title->SelectionList = "";
		$reportunpaymember->pt_title->DefaultSelectionList = "";
		$reportunpaymember->pt_title->ValueList = "";
		$reportunpaymember->did->SelectionList = "";
		$reportunpaymember->did->DefaultSelectionList = "";
		$reportunpaymember->did->ValueList = "";
		$reportunpaymember->dname->SelectionList = "";
		$reportunpaymember->dname->DefaultSelectionList = "";
		$reportunpaymember->dname->ValueList = "";
		$reportunpaymember->cal_status->SelectionList = "";
		$reportunpaymember->cal_status->DefaultSelectionList = "";
		$reportunpaymember->cal_status->ValueList = "";
		$reportunpaymember->invoice_senddate->SelectionList = "";
		$reportunpaymember->invoice_senddate->DefaultSelectionList = "";
		$reportunpaymember->invoice_senddate->ValueList = "";
		$reportunpaymember->invoice_duedate->SelectionList = "";
		$reportunpaymember->invoice_duedate->DefaultSelectionList = "";
		$reportunpaymember->invoice_duedate->ValueList = "";
		$reportunpaymember->notice_senddate->SelectionList = "";
		$reportunpaymember->notice_senddate->DefaultSelectionList = "";
		$reportunpaymember->notice_senddate->ValueList = "";
		$reportunpaymember->notice_duedate->SelectionList = "";
		$reportunpaymember->notice_duedate->DefaultSelectionList = "";
		$reportunpaymember->notice_duedate->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$reportunpaymember->CustomFilters_Load();

		// Build extended filter
		$sExtendedFilter = $this->GetExtendedFilter();
		if ($sExtendedFilter <> "") {
			if ($this->Filter <> "")
  				$this->Filter = "($this->Filter) AND ($sExtendedFilter)";
			else
				$this->Filter = $sExtendedFilter;
		}

		// Build popup filter
		$sPopupFilter = $this->GetPopupFilter();

		//ewrpt_SetDebugMsg("popup filter: " . $sPopupFilter);
		if ($sPopupFilter <> "") {
			if ($this->Filter <> "")
				$this->Filter = "($this->Filter) AND ($sPopupFilter)";
			else
				$this->Filter = $sPopupFilter;
		}

		// Check if filter applied
		$this->FilterApplied = $this->CheckFilter();

		// Get sort
		$this->Sort = $this->GetSort();

		// Get total group count
		$sGrpSort = ewrpt_UpdateSortFields($reportunpaymember->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($reportunpaymember->SqlSelectGroup(), $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), $reportunpaymember->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($reportunpaymember->ExportAll && $reportunpaymember->Export <> "")
		    $this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup(); 

		// Get current page groups
		$rsgrp = $this->GetGrpRs($sSql, $this->StartGrp, $this->DisplayGrps);

		// Init detail recordset
		$rs = NULL;
	}

	// Check level break
	function ChkLvlBreak($lvl) {
		global $reportunpaymember;
		switch ($lvl) {
			case 1:
				return (is_null($reportunpaymember->t_title->CurrentValue) && !is_null($reportunpaymember->t_title->OldValue)) ||
					(!is_null($reportunpaymember->t_title->CurrentValue) && is_null($reportunpaymember->t_title->OldValue)) ||
					($reportunpaymember->t_title->GroupValue() <> $reportunpaymember->t_title->GroupOldValue());
			case 2:
				return (is_null($reportunpaymember->t_code->CurrentValue) && !is_null($reportunpaymember->t_code->OldValue)) ||
					(!is_null($reportunpaymember->t_code->CurrentValue) && is_null($reportunpaymember->t_code->OldValue)) ||
					($reportunpaymember->t_code->GroupValue() <> $reportunpaymember->t_code->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
			case 3:
				return (is_null($reportunpaymember->v_code->CurrentValue) && !is_null($reportunpaymember->v_code->OldValue)) ||
					(!is_null($reportunpaymember->v_code->CurrentValue) && is_null($reportunpaymember->v_code->OldValue)) ||
					($reportunpaymember->v_code->GroupValue() <> $reportunpaymember->v_code->GroupOldValue()) || $this->ChkLvlBreak(2); // Recurse upper level
			case 4:
				return (is_null($reportunpaymember->v_title->CurrentValue) && !is_null($reportunpaymember->v_title->OldValue)) ||
					(!is_null($reportunpaymember->v_title->CurrentValue) && is_null($reportunpaymember->v_title->OldValue)) ||
					($reportunpaymember->v_title->GroupValue() <> $reportunpaymember->v_title->GroupOldValue()) || $this->ChkLvlBreak(3); // Recurse upper level
		}
	}

	// Accummulate summary
	function AccumulateSummary() {
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy]++;
				if ($this->Col[$iy]) {
					$valwrk = $this->Val[$iy];
					if (is_null($valwrk) || !is_numeric($valwrk)) {

						// skip
					} else {
						$this->Smry[$ix][$iy] += $valwrk;
						if (is_null($this->Mn[$ix][$iy])) {
							$this->Mn[$ix][$iy] = $valwrk;
							$this->Mx[$ix][$iy] = $valwrk;
						} else {
							if ($this->Mn[$ix][$iy] > $valwrk) $this->Mn[$ix][$iy] = $valwrk;
							if ($this->Mx[$ix][$iy] < $valwrk) $this->Mx[$ix][$iy] = $valwrk;
						}
					}
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = 1; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0]++;
		}
	}

	// Reset level summary
	function ResetLevelSummary($lvl) {

		// Clear summary values
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy] = 0;
				if ($this->Col[$iy]) {
					$this->Smry[$ix][$iy] = 0;
					$this->Mn[$ix][$iy] = NULL;
					$this->Mx[$ix][$iy] = NULL;
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0] = 0;
		}

		// Reset record count
		$this->RecCount = 0;
	}

	// Accummulate grand summary
	function AccumulateGrandSummary() {
		$this->Cnt[0][0]++;
		$cntgs = count($this->GrandSmry);
		for ($iy = 1; $iy < $cntgs; $iy++) {
			if ($this->Col[$iy]) {
				$valwrk = $this->Val[$iy];
				if (is_null($valwrk) || !is_numeric($valwrk)) {

					// skip
				} else {
					$this->GrandSmry[$iy] += $valwrk;
					if (is_null($this->GrandMn[$iy])) {
						$this->GrandMn[$iy] = $valwrk;
						$this->GrandMx[$iy] = $valwrk;
					} else {
						if ($this->GrandMn[$iy] > $valwrk) $this->GrandMn[$iy] = $valwrk;
						if ($this->GrandMx[$iy] < $valwrk) $this->GrandMx[$iy] = $valwrk;
					}
				}
			}
		}
	}

	// Get group count
	function GetGrpCnt($sql) {
		global $conn;
		global $reportunpaymember;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $reportunpaymember;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $reportunpaymember;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$reportunpaymember->t_title->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$reportunpaymember->t_title->setDbValue($rsgrp->fields('t_title'));
		if ($rsgrp->EOF) {
			$reportunpaymember->t_title->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $reportunpaymember;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$reportunpaymember->t_code->setDbValue($rs->fields('t_code'));
			if ($opt <> 1)
				$reportunpaymember->t_title->setDbValue($rs->fields('t_title'));
			$reportunpaymember->v_code->setDbValue($rs->fields('v_code'));
			$reportunpaymember->v_title->setDbValue($rs->fields('v_title'));
			$reportunpaymember->prefix->setDbValue($rs->fields('prefix'));
			$reportunpaymember->fname->setDbValue($rs->fields('fname'));
			$reportunpaymember->lname->setDbValue($rs->fields('lname'));
			$reportunpaymember->pt_title->setDbValue($rs->fields('pt_title'));
			$reportunpaymember->did->setDbValue($rs->fields('did'));
			$reportunpaymember->dname->setDbValue($rs->fields('dname'));
			$reportunpaymember->member_code->setDbValue($rs->fields('member_code'));
			$reportunpaymember->cal_detail->setDbValue($rs->fields('cal_detail'));
			$reportunpaymember->adv_num->setDbValue($rs->fields('adv_num'));
			$reportunpaymember->unit_rate->setDbValue($rs->fields('unit_rate'));
			$reportunpaymember->cal_status->setDbValue($rs->fields('cal_status'));
			$reportunpaymember->invoice_senddate->setDbValue($rs->fields('invoice_senddate'));
			$reportunpaymember->invoice_duedate->setDbValue($rs->fields('invoice_duedate'));
			$reportunpaymember->notice_senddate->setDbValue($rs->fields('notice_senddate'));
			$reportunpaymember->notice_duedate->setDbValue($rs->fields('notice_duedate'));
			$reportunpaymember->member_status->setDbValue($rs->fields('member_status'));
			$this->Val[1] = $reportunpaymember->prefix->CurrentValue;
			$this->Val[2] = $reportunpaymember->fname->CurrentValue;
			$this->Val[3] = $reportunpaymember->lname->CurrentValue;
			$this->Val[4] = $reportunpaymember->pt_title->CurrentValue;
			$this->Val[5] = $reportunpaymember->did->CurrentValue;
			$this->Val[6] = $reportunpaymember->dname->CurrentValue;
			$this->Val[7] = $reportunpaymember->cal_detail->CurrentValue;
			$this->Val[8] = $reportunpaymember->adv_num->CurrentValue;
			$this->Val[9] = $reportunpaymember->unit_rate->CurrentValue;
			$this->Val[10] = $reportunpaymember->cal_status->CurrentValue;
			$this->Val[11] = $reportunpaymember->invoice_senddate->CurrentValue;
			$this->Val[12] = $reportunpaymember->invoice_duedate->CurrentValue;
			$this->Val[13] = $reportunpaymember->notice_senddate->CurrentValue;
			$this->Val[14] = $reportunpaymember->notice_duedate->CurrentValue;
			$this->Val[15] = $reportunpaymember->member_status->CurrentValue;
		} else {
			$reportunpaymember->t_code->setDbValue("");
			$reportunpaymember->t_title->setDbValue("");
			$reportunpaymember->v_code->setDbValue("");
			$reportunpaymember->v_title->setDbValue("");
			$reportunpaymember->prefix->setDbValue("");
			$reportunpaymember->fname->setDbValue("");
			$reportunpaymember->lname->setDbValue("");
			$reportunpaymember->pt_title->setDbValue("");
			$reportunpaymember->did->setDbValue("");
			$reportunpaymember->dname->setDbValue("");
			$reportunpaymember->member_code->setDbValue("");
			$reportunpaymember->cal_detail->setDbValue("");
			$reportunpaymember->adv_num->setDbValue("");
			$reportunpaymember->unit_rate->setDbValue("");
			$reportunpaymember->cal_status->setDbValue("");
			$reportunpaymember->invoice_senddate->setDbValue("");
			$reportunpaymember->invoice_duedate->setDbValue("");
			$reportunpaymember->notice_senddate->setDbValue("");
			$reportunpaymember->notice_duedate->setDbValue("");
			$reportunpaymember->member_status->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $reportunpaymember;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$reportunpaymember->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$reportunpaymember->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $reportunpaymember->getStartGroup();
			}
		} else {
			$this->StartGrp = $reportunpaymember->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$reportunpaymember->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$reportunpaymember->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$reportunpaymember->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $reportunpaymember;

		// Initialize popup
		// Build distinct values for t_title

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportunpaymember->t_title->SqlSelect, $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), $reportunpaymember->t_title->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportunpaymember->t_title->setDbValue($rswrk->fields[0]);
			if (is_null($reportunpaymember->t_title->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportunpaymember->t_title->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportunpaymember->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportunpaymember->t_title,$reportunpaymember->t_title->GroupValue());
				ewrpt_SetupDistinctValues($reportunpaymember->t_title->ValueList, $reportunpaymember->t_title->GroupValue(), $reportunpaymember->t_title->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportunpaymember->t_title->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportunpaymember->t_title->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for v_title
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportunpaymember->v_title->SqlSelect, $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), $reportunpaymember->v_title->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportunpaymember->v_title->setDbValue($rswrk->fields[0]);
			if (is_null($reportunpaymember->v_title->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportunpaymember->v_title->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportunpaymember->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportunpaymember->v_title,$reportunpaymember->v_title->GroupValue());
				ewrpt_SetupDistinctValues($reportunpaymember->v_title->ValueList, $reportunpaymember->v_title->GroupValue(), $reportunpaymember->v_title->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportunpaymember->v_title->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportunpaymember->v_title->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for pt_title
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportunpaymember->pt_title->SqlSelect, $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), $reportunpaymember->pt_title->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportunpaymember->pt_title->setDbValue($rswrk->fields[0]);
			if (is_null($reportunpaymember->pt_title->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportunpaymember->pt_title->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportunpaymember->pt_title->ViewValue = $reportunpaymember->pt_title->CurrentValue;
				ewrpt_SetupDistinctValues($reportunpaymember->pt_title->ValueList, $reportunpaymember->pt_title->CurrentValue, $reportunpaymember->pt_title->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportunpaymember->pt_title->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportunpaymember->pt_title->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for did
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportunpaymember->did->SqlSelect, $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), $reportunpaymember->did->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportunpaymember->did->setDbValue($rswrk->fields[0]);
			if (is_null($reportunpaymember->did->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportunpaymember->did->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportunpaymember->did->ViewValue = $reportunpaymember->did->CurrentValue;
				ewrpt_SetupDistinctValues($reportunpaymember->did->ValueList, $reportunpaymember->did->CurrentValue, $reportunpaymember->did->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportunpaymember->did->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportunpaymember->did->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for dname
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportunpaymember->dname->SqlSelect, $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), $reportunpaymember->dname->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportunpaymember->dname->setDbValue($rswrk->fields[0]);
			if (is_null($reportunpaymember->dname->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportunpaymember->dname->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportunpaymember->dname->ViewValue = $reportunpaymember->dname->CurrentValue;
				ewrpt_SetupDistinctValues($reportunpaymember->dname->ValueList, $reportunpaymember->dname->CurrentValue, $reportunpaymember->dname->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportunpaymember->dname->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportunpaymember->dname->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for cal_status
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportunpaymember->cal_status->SqlSelect, $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), $reportunpaymember->cal_status->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportunpaymember->cal_status->setDbValue($rswrk->fields[0]);
			if (is_null($reportunpaymember->cal_status->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportunpaymember->cal_status->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportunpaymember->cal_status->ViewValue = $reportunpaymember->cal_status->CurrentValue;
				ewrpt_SetupDistinctValues($reportunpaymember->cal_status->ValueList, $reportunpaymember->cal_status->CurrentValue, $reportunpaymember->cal_status->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportunpaymember->cal_status->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportunpaymember->cal_status->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for invoice_senddate
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportunpaymember->invoice_senddate->SqlSelect, $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), $reportunpaymember->invoice_senddate->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportunpaymember->invoice_senddate->setDbValue($rswrk->fields[0]);
			if (is_null($reportunpaymember->invoice_senddate->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportunpaymember->invoice_senddate->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportunpaymember->invoice_senddate->ViewValue = ewrpt_FormatDateTime($reportunpaymember->invoice_senddate->CurrentValue, 7);
				ewrpt_SetupDistinctValues($reportunpaymember->invoice_senddate->ValueList, $reportunpaymember->invoice_senddate->CurrentValue, $reportunpaymember->invoice_senddate->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportunpaymember->invoice_senddate->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportunpaymember->invoice_senddate->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for invoice_duedate
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportunpaymember->invoice_duedate->SqlSelect, $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), $reportunpaymember->invoice_duedate->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportunpaymember->invoice_duedate->setDbValue($rswrk->fields[0]);
			if (is_null($reportunpaymember->invoice_duedate->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportunpaymember->invoice_duedate->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportunpaymember->invoice_duedate->ViewValue = ewrpt_FormatDateTime($reportunpaymember->invoice_duedate->CurrentValue, 7);
				ewrpt_SetupDistinctValues($reportunpaymember->invoice_duedate->ValueList, $reportunpaymember->invoice_duedate->CurrentValue, $reportunpaymember->invoice_duedate->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportunpaymember->invoice_duedate->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportunpaymember->invoice_duedate->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for notice_senddate
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportunpaymember->notice_senddate->SqlSelect, $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), $reportunpaymember->notice_senddate->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportunpaymember->notice_senddate->setDbValue($rswrk->fields[0]);
			if (is_null($reportunpaymember->notice_senddate->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportunpaymember->notice_senddate->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportunpaymember->notice_senddate->ViewValue = ewrpt_FormatDateTime($reportunpaymember->notice_senddate->CurrentValue, 7);
				ewrpt_SetupDistinctValues($reportunpaymember->notice_senddate->ValueList, $reportunpaymember->notice_senddate->CurrentValue, $reportunpaymember->notice_senddate->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportunpaymember->notice_senddate->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportunpaymember->notice_senddate->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for notice_duedate
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportunpaymember->notice_duedate->SqlSelect, $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), $reportunpaymember->notice_duedate->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportunpaymember->notice_duedate->setDbValue($rswrk->fields[0]);
			if (is_null($reportunpaymember->notice_duedate->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportunpaymember->notice_duedate->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportunpaymember->notice_duedate->ViewValue = ewrpt_FormatDateTime($reportunpaymember->notice_duedate->CurrentValue, 7);
				ewrpt_SetupDistinctValues($reportunpaymember->notice_duedate->ValueList, $reportunpaymember->notice_duedate->CurrentValue, $reportunpaymember->notice_duedate->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportunpaymember->notice_duedate->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportunpaymember->notice_duedate->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Process post back form
		if (ewrpt_IsHttpPost()) {
			$sName = @$_POST["popup"]; // Get popup form name
			if ($sName <> "") {
				$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
				if ($cntValues > 0) {
					$arValues = ewrpt_StripSlashes($_POST["sel_$sName"]);
					if (trim($arValues[0]) == "") // Select all
						$arValues = EWRPT_INIT_VALUE;
					if (!ewrpt_MatchedArray($arValues, $_SESSION["sel_$sName"])) {
						if ($this->HasSessionFilterValues($sName))
							$this->ClearExtFilter = $sName; // Clear extended filter for this field
					}
					$_SESSION["sel_$sName"] = $arValues;
					$_SESSION["rf_$sName"] = ewrpt_StripSlashes(@$_POST["rf_$sName"]);
					$_SESSION["rt_$sName"] = ewrpt_StripSlashes(@$_POST["rt_$sName"]);
					$this->ResetPager();
				}
			}

		// Get 'reset' command
		} elseif (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];
			if (strtolower($sCmd) == "reset") {
				$this->ClearSessionSelection('t_title');
				$this->ClearSessionSelection('v_title');
				$this->ClearSessionSelection('pt_title');
				$this->ClearSessionSelection('did');
				$this->ClearSessionSelection('dname');
				$this->ClearSessionSelection('cal_status');
				$this->ClearSessionSelection('invoice_senddate');
				$this->ClearSessionSelection('invoice_duedate');
				$this->ClearSessionSelection('notice_senddate');
				$this->ClearSessionSelection('notice_duedate');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get ตำบล selected values

		if (is_array(@$_SESSION["sel_reportunpaymember_t_title"])) {
			$this->LoadSelectionFromSession('t_title');
		} elseif (@$_SESSION["sel_reportunpaymember_t_title"] == EWRPT_INIT_VALUE) { // Select all
			$reportunpaymember->t_title->SelectionList = "";
		}

		// Get หมู่บ้าน selected values
		if (is_array(@$_SESSION["sel_reportunpaymember_v_title"])) {
			$this->LoadSelectionFromSession('v_title');
		} elseif (@$_SESSION["sel_reportunpaymember_v_title"] == EWRPT_INIT_VALUE) { // Select all
			$reportunpaymember->v_title->SelectionList = "";
		}

		// Get รายการที่ชำระ selected values
		if (is_array(@$_SESSION["sel_reportunpaymember_pt_title"])) {
			$this->LoadSelectionFromSession('pt_title');
		} elseif (@$_SESSION["sel_reportunpaymember_pt_title"] == EWRPT_INIT_VALUE) { // Select all
			$reportunpaymember->pt_title->SelectionList = "";
		}

		// Get ศพที่ selected values
		if (is_array(@$_SESSION["sel_reportunpaymember_did"])) {
			$this->LoadSelectionFromSession('did');
		} elseif (@$_SESSION["sel_reportunpaymember_did"] == EWRPT_INIT_VALUE) { // Select all
			$reportunpaymember->did->SelectionList = "";
		}

		// Get ผู้เสียชีวิต selected values
		if (is_array(@$_SESSION["sel_reportunpaymember_dname"])) {
			$this->LoadSelectionFromSession('dname');
		} elseif (@$_SESSION["sel_reportunpaymember_dname"] == EWRPT_INIT_VALUE) { // Select all
			$reportunpaymember->dname->SelectionList = "";
		}

		// Get สถานะการทวงหนี้ selected values
		if (is_array(@$_SESSION["sel_reportunpaymember_cal_status"])) {
			$this->LoadSelectionFromSession('cal_status');
		} elseif (@$_SESSION["sel_reportunpaymember_cal_status"] == EWRPT_INIT_VALUE) { // Select all
			$reportunpaymember->cal_status->SelectionList = "";
		}

		// Get ว.ด.ป.ที่ส่งใบแจ้งหนี้ selected values
		if (is_array(@$_SESSION["sel_reportunpaymember_invoice_senddate"])) {
			$this->LoadSelectionFromSession('invoice_senddate');
		} elseif (@$_SESSION["sel_reportunpaymember_invoice_senddate"] == EWRPT_INIT_VALUE) { // Select all
			$reportunpaymember->invoice_senddate->SelectionList = "";
		}

		// Get ว.ด.ป.ที่ครบกำหนด selected values
		if (is_array(@$_SESSION["sel_reportunpaymember_invoice_duedate"])) {
			$this->LoadSelectionFromSession('invoice_duedate');
		} elseif (@$_SESSION["sel_reportunpaymember_invoice_duedate"] == EWRPT_INIT_VALUE) { // Select all
			$reportunpaymember->invoice_duedate->SelectionList = "";
		}

		// Get ว.ด.ป.ที่ส่งหนังสือเตือน selected values
		if (is_array(@$_SESSION["sel_reportunpaymember_notice_senddate"])) {
			$this->LoadSelectionFromSession('notice_senddate');
		} elseif (@$_SESSION["sel_reportunpaymember_notice_senddate"] == EWRPT_INIT_VALUE) { // Select all
			$reportunpaymember->notice_senddate->SelectionList = "";
		}

		// Get ว.ด.ป.ที่ครบกำหนด selected values
		if (is_array(@$_SESSION["sel_reportunpaymember_notice_duedate"])) {
			$this->LoadSelectionFromSession('notice_duedate');
		} elseif (@$_SESSION["sel_reportunpaymember_notice_duedate"] == EWRPT_INIT_VALUE) { // Select all
			$reportunpaymember->notice_duedate->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $reportunpaymember;
		$this->StartGrp = 1;
		$reportunpaymember->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $reportunpaymember;
		$sWrk = @$_GET[EWRPT_TABLE_GROUP_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayGrps = intval($sWrk);
			} else {
				if (strtoupper($sWrk) == "ALL") { // display all groups
					$this->DisplayGrps = -1;
				} else {
					$this->DisplayGrps = 3; // Non-numeric, load default
				}
			}
			$reportunpaymember->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$reportunpaymember->setStartGroup($this->StartGrp);
		} else {
			if ($reportunpaymember->getGroupPerPage() <> "") {
				$this->DisplayGrps = $reportunpaymember->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $reportunpaymember;
		if ($reportunpaymember->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($reportunpaymember->SqlSelectCount(), $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}

			// Get total from sql directly
			$sSql = ewrpt_BuildReportSql($reportunpaymember->SqlSelectAgg(), $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), "", $this->Filter, "");
			$sSql = $reportunpaymember->SqlAggPfx() . $sSql . $reportunpaymember->SqlAggSfx();
			$rsagg = $conn->Execute($sSql);
			if ($rsagg) {
				$this->GrandSmry[9] = $rsagg->fields("sum_unit_rate");
				$rsagg->Close();
			} else {

				// Accumulate grand summary from detail records
				$sSql = ewrpt_BuildReportSql($reportunpaymember->SqlSelect(), $reportunpaymember->SqlWhere(), $reportunpaymember->SqlGroupBy(), $reportunpaymember->SqlHaving(), "", $this->Filter, "");
				$rs = $conn->Execute($sSql);
				if ($rs) {
					$this->GetRow(1);
					while (!$rs->EOF) {
						$this->AccumulateGrandSummary();
						$this->GetRow(2);
					}
					$rs->Close();
				}
			}
		}

		// Call Row_Rendering event
		$reportunpaymember->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($reportunpaymember->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// t_title
			$reportunpaymember->t_title->GroupViewValue = $reportunpaymember->t_title->GroupOldValue();
			$reportunpaymember->t_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->t_title->CellAttrs["class"] = ($reportunpaymember->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$reportunpaymember->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportunpaymember->t_title, $reportunpaymember->t_title->GroupViewValue);

			// t_code
			$reportunpaymember->t_code->GroupViewValue = $reportunpaymember->t_code->GroupOldValue();
			$reportunpaymember->t_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->t_code->CellAttrs["class"] = ($reportunpaymember->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";
			$reportunpaymember->t_code->GroupViewValue = ewrpt_DisplayGroupValue($reportunpaymember->t_code, $reportunpaymember->t_code->GroupViewValue);

			// v_code
			$reportunpaymember->v_code->GroupViewValue = $reportunpaymember->v_code->GroupOldValue();
			$reportunpaymember->v_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->v_code->CellAttrs["class"] = ($reportunpaymember->RowGroupLevel == 3) ? "ewRptGrpSummary3" : "ewRptGrpField3";
			$reportunpaymember->v_code->GroupViewValue = ewrpt_DisplayGroupValue($reportunpaymember->v_code, $reportunpaymember->v_code->GroupViewValue);

			// v_title
			$reportunpaymember->v_title->GroupViewValue = $reportunpaymember->v_title->GroupOldValue();
			$reportunpaymember->v_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->v_title->CellAttrs["class"] = ($reportunpaymember->RowGroupLevel == 4) ? "ewRptGrpSummary4" : "ewRptGrpField4";
			$reportunpaymember->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportunpaymember->v_title, $reportunpaymember->v_title->GroupViewValue);

			// prefix
			$reportunpaymember->prefix->ViewValue = $reportunpaymember->prefix->Summary;
			$reportunpaymember->prefix->CellAttrs["style"] = "white-space: nowrap;";

			// fname
			$reportunpaymember->fname->ViewValue = $reportunpaymember->fname->Summary;
			$reportunpaymember->fname->CellAttrs["style"] = "white-space: nowrap;";

			// lname
			$reportunpaymember->lname->ViewValue = $reportunpaymember->lname->Summary;
			$reportunpaymember->lname->CellAttrs["style"] = "white-space: nowrap;";

			// pt_title
			$reportunpaymember->pt_title->ViewValue = $reportunpaymember->pt_title->Summary;
			$reportunpaymember->pt_title->CellAttrs["style"] = "white-space: nowrap;";

			// did
			$reportunpaymember->did->ViewValue = $reportunpaymember->did->Summary;
			$reportunpaymember->did->CellAttrs["style"] = "white-space: nowrap;";

			// dname
			$reportunpaymember->dname->ViewValue = $reportunpaymember->dname->Summary;
			$reportunpaymember->dname->CellAttrs["style"] = "white-space: nowrap;";

			// cal_detail
			$reportunpaymember->cal_detail->ViewValue = $reportunpaymember->cal_detail->Summary;
			$reportunpaymember->cal_detail->CellAttrs["style"] = "white-space: nowrap;";

			// adv_num
			$reportunpaymember->adv_num->ViewValue = $reportunpaymember->adv_num->Summary;
			$reportunpaymember->adv_num->CellAttrs["style"] = "white-space: nowrap;";

			// unit_rate
			$reportunpaymember->unit_rate->ViewValue = $reportunpaymember->unit_rate->Summary;
			$reportunpaymember->unit_rate->ViewValue = ewrpt_FormatCurrency($reportunpaymember->unit_rate->ViewValue, 0, -2, -2, -2);
			$reportunpaymember->unit_rate->CellAttrs["style"] = "white-space: nowrap;";

			// cal_status
			$reportunpaymember->cal_status->ViewValue = $reportunpaymember->cal_status->Summary;
			$reportunpaymember->cal_status->CellAttrs["style"] = "white-space: nowrap;";

			// invoice_senddate
			$reportunpaymember->invoice_senddate->ViewValue = $reportunpaymember->invoice_senddate->Summary;
			$reportunpaymember->invoice_senddate->ViewValue = ewrpt_FormatDateTime($reportunpaymember->invoice_senddate->ViewValue, 7);
			$reportunpaymember->invoice_senddate->CellAttrs["style"] = "white-space: nowrap;";

			// invoice_duedate
			$reportunpaymember->invoice_duedate->ViewValue = $reportunpaymember->invoice_duedate->Summary;
			$reportunpaymember->invoice_duedate->ViewValue = ewrpt_FormatDateTime($reportunpaymember->invoice_duedate->ViewValue, 7);
			$reportunpaymember->invoice_duedate->CellAttrs["style"] = "white-space: nowrap;";

			// notice_senddate
			$reportunpaymember->notice_senddate->ViewValue = $reportunpaymember->notice_senddate->Summary;
			$reportunpaymember->notice_senddate->ViewValue = ewrpt_FormatDateTime($reportunpaymember->notice_senddate->ViewValue, 7);
			$reportunpaymember->notice_senddate->CellAttrs["style"] = "white-space: nowrap;";

			// notice_duedate
			$reportunpaymember->notice_duedate->ViewValue = $reportunpaymember->notice_duedate->Summary;
			$reportunpaymember->notice_duedate->ViewValue = ewrpt_FormatDateTime($reportunpaymember->notice_duedate->ViewValue, 7);
			$reportunpaymember->notice_duedate->CellAttrs["style"] = "white-space: nowrap;";

			// member_status
			$reportunpaymember->member_status->ViewValue = $reportunpaymember->member_status->Summary;
			$reportunpaymember->member_status->CellAttrs["style"] = "white-space: nowrap;";
		} else {

			// t_title
			$reportunpaymember->t_title->GroupViewValue = $reportunpaymember->t_title->GroupValue();
			$reportunpaymember->t_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->t_title->CellAttrs["class"] = "ewRptGrpField1";
			$reportunpaymember->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportunpaymember->t_title, $reportunpaymember->t_title->GroupViewValue);
			if ($reportunpaymember->t_title->GroupValue() == $reportunpaymember->t_title->GroupOldValue() && !$this->ChkLvlBreak(1))
				$reportunpaymember->t_title->GroupViewValue = "&nbsp;";

			// t_code
			$reportunpaymember->t_code->GroupViewValue = $reportunpaymember->t_code->GroupValue();
			$reportunpaymember->t_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->t_code->CellAttrs["class"] = "ewRptGrpField2";
			$reportunpaymember->t_code->GroupViewValue = ewrpt_DisplayGroupValue($reportunpaymember->t_code, $reportunpaymember->t_code->GroupViewValue);
			if ($reportunpaymember->t_code->GroupValue() == $reportunpaymember->t_code->GroupOldValue() && !$this->ChkLvlBreak(2))
				$reportunpaymember->t_code->GroupViewValue = "&nbsp;";

			// v_code
			$reportunpaymember->v_code->GroupViewValue = $reportunpaymember->v_code->GroupValue();
			$reportunpaymember->v_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->v_code->CellAttrs["class"] = "ewRptGrpField3";
			$reportunpaymember->v_code->GroupViewValue = ewrpt_DisplayGroupValue($reportunpaymember->v_code, $reportunpaymember->v_code->GroupViewValue);
			if ($reportunpaymember->v_code->GroupValue() == $reportunpaymember->v_code->GroupOldValue() && !$this->ChkLvlBreak(3))
				$reportunpaymember->v_code->GroupViewValue = "&nbsp;";

			// v_title
			$reportunpaymember->v_title->GroupViewValue = $reportunpaymember->v_title->GroupValue();
			$reportunpaymember->v_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->v_title->CellAttrs["class"] = "ewRptGrpField4";
			$reportunpaymember->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportunpaymember->v_title, $reportunpaymember->v_title->GroupViewValue);
			if ($reportunpaymember->v_title->GroupValue() == $reportunpaymember->v_title->GroupOldValue() && !$this->ChkLvlBreak(4))
				$reportunpaymember->v_title->GroupViewValue = "&nbsp;";

			// prefix
			$reportunpaymember->prefix->ViewValue = $reportunpaymember->prefix->CurrentValue;
			$reportunpaymember->prefix->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->prefix->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$reportunpaymember->fname->ViewValue = $reportunpaymember->fname->CurrentValue;
			$reportunpaymember->fname->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$reportunpaymember->lname->ViewValue = $reportunpaymember->lname->CurrentValue;
			$reportunpaymember->lname->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pt_title
			$reportunpaymember->pt_title->ViewValue = $reportunpaymember->pt_title->CurrentValue;
			$reportunpaymember->pt_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->pt_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// did
			$reportunpaymember->did->ViewValue = $reportunpaymember->did->CurrentValue;
			$reportunpaymember->did->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->did->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dname
			$reportunpaymember->dname->ViewValue = $reportunpaymember->dname->CurrentValue;
			$reportunpaymember->dname->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->dname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// cal_detail
			$reportunpaymember->cal_detail->ViewValue = $reportunpaymember->cal_detail->CurrentValue;
			$reportunpaymember->cal_detail->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->cal_detail->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// adv_num
			$reportunpaymember->adv_num->ViewValue = $reportunpaymember->adv_num->CurrentValue;
			$reportunpaymember->adv_num->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->adv_num->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// unit_rate
			$reportunpaymember->unit_rate->ViewValue = $reportunpaymember->unit_rate->CurrentValue;
			$reportunpaymember->unit_rate->ViewValue = ewrpt_FormatCurrency($reportunpaymember->unit_rate->ViewValue, 0, -2, -2, -2);
			$reportunpaymember->unit_rate->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->unit_rate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// cal_status
			$reportunpaymember->cal_status->ViewValue = $reportunpaymember->cal_status->CurrentValue;
			$reportunpaymember->cal_status->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->cal_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// invoice_senddate
			$reportunpaymember->invoice_senddate->ViewValue = $reportunpaymember->invoice_senddate->CurrentValue;
			$reportunpaymember->invoice_senddate->ViewValue = ewrpt_FormatDateTime($reportunpaymember->invoice_senddate->ViewValue, 7);
			$reportunpaymember->invoice_senddate->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->invoice_senddate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// invoice_duedate
			$reportunpaymember->invoice_duedate->ViewValue = $reportunpaymember->invoice_duedate->CurrentValue;
			$reportunpaymember->invoice_duedate->ViewValue = ewrpt_FormatDateTime($reportunpaymember->invoice_duedate->ViewValue, 7);
			$reportunpaymember->invoice_duedate->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->invoice_duedate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// notice_senddate
			$reportunpaymember->notice_senddate->ViewValue = $reportunpaymember->notice_senddate->CurrentValue;
			$reportunpaymember->notice_senddate->ViewValue = ewrpt_FormatDateTime($reportunpaymember->notice_senddate->ViewValue, 7);
			$reportunpaymember->notice_senddate->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->notice_senddate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// notice_duedate
			$reportunpaymember->notice_duedate->ViewValue = $reportunpaymember->notice_duedate->CurrentValue;
			$reportunpaymember->notice_duedate->ViewValue = ewrpt_FormatDateTime($reportunpaymember->notice_duedate->ViewValue, 7);
			$reportunpaymember->notice_duedate->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->notice_duedate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_status
			$reportunpaymember->member_status->ViewValue = $reportunpaymember->member_status->CurrentValue;
			$reportunpaymember->member_status->CellAttrs["style"] = "white-space: nowrap;";
			$reportunpaymember->member_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// t_title
		$reportunpaymember->t_title->HrefValue = "";

		// t_code
		$reportunpaymember->t_code->HrefValue = "";

		// v_code
		$reportunpaymember->v_code->HrefValue = "";

		// v_title
		$reportunpaymember->v_title->HrefValue = "";

		// prefix
		$reportunpaymember->prefix->HrefValue = "";

		// fname
		$reportunpaymember->fname->HrefValue = "";

		// lname
		$reportunpaymember->lname->HrefValue = "";

		// pt_title
		$reportunpaymember->pt_title->HrefValue = "";

		// did
		$reportunpaymember->did->HrefValue = "";

		// dname
		$reportunpaymember->dname->HrefValue = "";

		// cal_detail
		$reportunpaymember->cal_detail->HrefValue = "";

		// adv_num
		$reportunpaymember->adv_num->HrefValue = "";

		// unit_rate
		$reportunpaymember->unit_rate->HrefValue = "";

		// cal_status
		$reportunpaymember->cal_status->HrefValue = "";

		// invoice_senddate
		$reportunpaymember->invoice_senddate->HrefValue = "";

		// invoice_duedate
		$reportunpaymember->invoice_duedate->HrefValue = "";

		// notice_senddate
		$reportunpaymember->notice_senddate->HrefValue = "";

		// notice_duedate
		$reportunpaymember->notice_duedate->HrefValue = "";

		// member_status
		$reportunpaymember->member_status->HrefValue = "";

		// Call Row_Rendered event
		$reportunpaymember->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $reportunpaymember;
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $reportunpaymember;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field fname

			$this->SetSessionFilterValues($reportunpaymember->fname->SearchValue, $reportunpaymember->fname->SearchOperator, $reportunpaymember->fname->SearchCondition, $reportunpaymember->fname->SearchValue2, $reportunpaymember->fname->SearchOperator2, 'fname');

			// Field lname
			$this->SetSessionFilterValues($reportunpaymember->lname->SearchValue, $reportunpaymember->lname->SearchOperator, $reportunpaymember->lname->SearchCondition, $reportunpaymember->lname->SearchValue2, $reportunpaymember->lname->SearchOperator2, 'lname');

			// Field member_code
			$this->SetSessionFilterValues($reportunpaymember->member_code->SearchValue, $reportunpaymember->member_code->SearchOperator, $reportunpaymember->member_code->SearchCondition, $reportunpaymember->member_code->SearchValue2, $reportunpaymember->member_code->SearchOperator2, 'member_code');
			$bSetupFilter = TRUE;
		} else {

			// Field fname
			if ($this->GetFilterValues($reportunpaymember->fname)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field lname
			if ($this->GetFilterValues($reportunpaymember->lname)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field member_code
			if ($this->GetFilterValues($reportunpaymember->member_code)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}
			if (!$this->ValidateForm()) {
				$this->setMessage($gsFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {

			// Field fname
			$this->GetSessionFilterValues($reportunpaymember->fname);

			// Field lname
			$this->GetSessionFilterValues($reportunpaymember->lname);

			// Field member_code
			$this->GetSessionFilterValues($reportunpaymember->member_code);
		}

		// Call page filter validated event
		$reportunpaymember->Page_FilterValidated();

		// Build SQL
		// Field fname

		$this->BuildExtendedFilter($reportunpaymember->fname, $sFilter);

		// Field lname
		$this->BuildExtendedFilter($reportunpaymember->lname, $sFilter);

		// Field member_code
		$this->BuildExtendedFilter($reportunpaymember->member_code, $sFilter);

		// Save parms to session
		// Field fname

		$this->SetSessionFilterValues($reportunpaymember->fname->SearchValue, $reportunpaymember->fname->SearchOperator, $reportunpaymember->fname->SearchCondition, $reportunpaymember->fname->SearchValue2, $reportunpaymember->fname->SearchOperator2, 'fname');

		// Field lname
		$this->SetSessionFilterValues($reportunpaymember->lname->SearchValue, $reportunpaymember->lname->SearchOperator, $reportunpaymember->lname->SearchCondition, $reportunpaymember->lname->SearchValue2, $reportunpaymember->lname->SearchOperator2, 'lname');

		// Field member_code
		$this->SetSessionFilterValues($reportunpaymember->member_code->SearchValue, $reportunpaymember->member_code->SearchOperator, $reportunpaymember->member_code->SearchCondition, $reportunpaymember->member_code->SearchValue2, $reportunpaymember->member_code->SearchOperator2, 'member_code');

		// Setup filter
		if ($bSetupFilter) {
		}
		return $sFilter;
	}

	// Get drop down value from querystring
	function GetDropDownValue(&$sv, $parm) {
		if (ewrpt_IsHttpPost())
			return FALSE; // Skip post back
		if (isset($_GET["sv_$parm"])) {
			$sv = ewrpt_StripSlashes($_GET["sv_$parm"]);
			return TRUE;
		}
		return FALSE;
	}

	// Get filter values from querystring
	function GetFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		if (ewrpt_IsHttpPost())
			return; // Skip post back
		$got = FALSE;
		if (isset($_GET["sv1_$parm"])) {
			$fld->SearchValue = ewrpt_StripSlashes($_GET["sv1_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["so1_$parm"])) {
			$fld->SearchOperator = ewrpt_StripSlashes($_GET["so1_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["sc_$parm"])) {
			$fld->SearchCondition = ewrpt_StripSlashes($_GET["sc_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["sv2_$parm"])) {
			$fld->SearchValue2 = ewrpt_StripSlashes($_GET["sv2_$parm"]);
			$got = TRUE;
		}
		if (isset($_GET["so2_$parm"])) {
			$fld->SearchOperator2 = ewrpt_StripSlashes($_GET["so2_$parm"]);
			$got = TRUE;
		}
		return $got;
	}

	// Set default ext filter
	function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2) {
		$fld->DefaultSearchValue = $sv1; // Default ext filter value 1
		$fld->DefaultSearchValue2 = $sv2; // Default ext filter value 2 (if operator 2 is enabled)
		$fld->DefaultSearchOperator = $so1; // Default search operator 1
		$fld->DefaultSearchOperator2 = $so2; // Default search operator 2 (if operator 2 is enabled)
		$fld->DefaultSearchCondition = $sc; // Default search condition (if operator 2 is enabled)
	}

	// Apply default ext filter
	function ApplyDefaultExtFilter(&$fld) {
		$fld->SearchValue = $fld->DefaultSearchValue;
		$fld->SearchValue2 = $fld->DefaultSearchValue2;
		$fld->SearchOperator = $fld->DefaultSearchOperator;
		$fld->SearchOperator2 = $fld->DefaultSearchOperator2;
		$fld->SearchCondition = $fld->DefaultSearchCondition;
	}

	// Check if Text Filter applied
	function TextFilterApplied(&$fld) {
		return (strval($fld->SearchValue) <> strval($fld->DefaultSearchValue) ||
			strval($fld->SearchValue2) <> strval($fld->DefaultSearchValue2) ||
			(strval($fld->SearchValue) <> "" &&
				strval($fld->SearchOperator) <> strval($fld->DefaultSearchOperator)) ||
			(strval($fld->SearchValue2) <> "" &&
				strval($fld->SearchOperator2) <> strval($fld->DefaultSearchOperator2)) ||
			strval($fld->SearchCondition) <> strval($fld->DefaultSearchCondition));
	}

	// Check if Non-Text Filter applied
	function NonTextFilterApplied(&$fld) {
		if (is_array($fld->DefaultDropDownValue) && is_array($fld->DropDownValue)) {
			if (count($fld->DefaultDropDownValue) <> count($fld->DropDownValue))
				return TRUE;
			else
				return (count(array_diff($fld->DefaultDropDownValue, $fld->DropDownValue)) <> 0);
		}
		else {
			$v1 = strval($fld->DefaultDropDownValue);
			if ($v1 == EWRPT_INIT_VALUE)
				$v1 = "";
			$v2 = strval($fld->DropDownValue);
			if ($v2 == EWRPT_INIT_VALUE || $v2 == EWRPT_ALL_VALUE)
				$v2 = "";
			return ($v1 <> $v2);
		}
	}

	// Load selection from a filter clause
	function LoadSelectionFromFilter(&$fld, $filter, &$sel) {
		$sel = "";
		if ($filter <> "") {
			$sSql = ewrpt_BuildReportSql($fld->SqlSelect, "", "", "", $fld->SqlOrderBy, $filter, "");
			ewrpt_LoadArrayFromSql($sSql, $sel);
		}
	}

	// Get dropdown value from session
	function GetSessionDropDownValue(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->DropDownValue, 'sv_reportunpaymember_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_reportunpaymember_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_reportunpaymember_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_reportunpaymember_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_reportunpaymember_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_reportunpaymember_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_reportunpaymember_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_reportunpaymember_' . $parm] = $sv1;
		$_SESSION['so1_reportunpaymember_' . $parm] = $so1;
		$_SESSION['sc_reportunpaymember_' . $parm] = $sc;
		$_SESSION['sv2_reportunpaymember_' . $parm] = $sv2;
		$_SESSION['so2_reportunpaymember_' . $parm] = $so2;
	}

	// Check if has Session filter values
	function HasSessionFilterValues($parm) {
		return ((@$_SESSION['sv_' . $parm] <> "" && @$_SESSION['sv_' . $parm] <> EWRPT_INIT_VALUE) ||
			(@$_SESSION['sv1_' . $parm] <> "" && @$_SESSION['sv1_' . $parm] <> EWRPT_INIT_VALUE) ||
			(@$_SESSION['sv2_' . $parm] <> "" && @$_SESSION['sv2_' . $parm] <> EWRPT_INIT_VALUE));
	}

	// Dropdown filter exist
	function DropDownFilterExist(&$fld, $FldOpr) {
		$sWrk = "";
		$this->BuildDropDownFilter($fld, $sWrk, $FldOpr);
		return ($sWrk <> "");
	}

	// Build dropdown filter
	function BuildDropDownFilter(&$fld, &$FilterClause, $FldOpr) {
		$FldVal = $fld->DropDownValue;
		$sSql = "";
		if (is_array($FldVal)) {
			foreach ($FldVal as $val) {
				$sWrk = $this->GetDropDownfilter($fld, $val, $FldOpr);
				if ($sWrk <> "") {
					if ($sSql <> "")
						$sSql .= " OR " . $sWrk;
					else
						$sSql = $sWrk;
				}
			}
		} else {
			$sSql = $this->GetDropDownfilter($fld, $FldVal, $FldOpr);
		}
		if ($sSql <> "") {
			if ($FilterClause <> "") $FilterClause = "(" . $FilterClause . ") AND ";
			$FilterClause .= "(" . $sSql . ")";
		}
	}

	function GetDropDownfilter(&$fld, $FldVal, $FldOpr) {
		$FldName = $fld->FldName;
		$FldExpression = $fld->FldExpression;
		$FldDataType = $fld->FldDataType;
		$sWrk = "";
		if ($FldVal == EWRPT_NULL_VALUE) {
			$sWrk = $FldExpression . " IS NULL";
		} elseif ($FldVal == EWRPT_EMPTY_VALUE) {
			$sWrk = $FldExpression . " = ''";
		} else {
			if (substr($FldVal, 0, 2) == "@@") {
				$sWrk = ewrpt_getCustomFilter($fld, $FldVal);
			} else {
				if ($FldVal <> "" && $FldVal <> EWRPT_INIT_VALUE && $FldVal <> EWRPT_ALL_VALUE) {
					if ($FldDataType == EWRPT_DATATYPE_DATE && $FldOpr <> "") {
						$sWrk = $this->DateFilterString($FldOpr, $FldVal, $FldDataType);
					} else {
						$sWrk = $this->FilterString("=", $FldVal, $FldDataType);
					}
				}
				if ($sWrk <> "") $sWrk = $FldExpression . $sWrk;
			}
		}
		return $sWrk;
	}

	// Extended filter exist
	function ExtendedFilterExist(&$fld) {
		$sExtWrk = "";
		$this->BuildExtendedFilter($fld, $sExtWrk);
		return ($sExtWrk <> "");
	}

	// Build extended filter
	function BuildExtendedFilter(&$fld, &$FilterClause) {
		$FldName = $fld->FldName;
		$FldExpression = $fld->FldExpression;
		$FldDataType = $fld->FldDataType;
		$FldDateTimeFormat = $fld->FldDateTimeFormat;
		$FldVal1 = $fld->SearchValue;
		$FldOpr1 = $fld->SearchOperator;
		$FldCond = $fld->SearchCondition;
		$FldVal2 = $fld->SearchValue2;
		$FldOpr2 = $fld->SearchOperator2;
		$sWrk = "";
		$FldOpr1 = strtoupper(trim($FldOpr1));
		if ($FldOpr1 == "") $FldOpr1 = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		$wrkFldVal1 = $FldVal1;
		$wrkFldVal2 = $FldVal2;
		if ($FldDataType == EWRPT_DATATYPE_BOOLEAN) {
			if ($wrkFldVal1 <> "") $wrkFldVal1 = ($wrkFldVal1 == "1") ? EWRPT_TRUE_STRING : EWRPT_FALSE_STRING;
			if ($wrkFldVal2 <> "") $wrkFldVal2 = ($wrkFldVal2 == "1") ? EWRPT_TRUE_STRING : EWRPT_FALSE_STRING;
		} elseif ($FldDataType == EWRPT_DATATYPE_DATE) {
			if ($wrkFldVal1 <> "") $wrkFldVal1 = ewrpt_UnFormatDateTime($wrkFldVal1, $FldDateTimeFormat);
			if ($wrkFldVal2 <> "") $wrkFldVal2 = ewrpt_UnFormatDateTime($wrkFldVal2, $FldDateTimeFormat);
		}
		if ($FldOpr1 == "BETWEEN") {
			$IsValidValue = ($FldDataType <> EWRPT_DATATYPE_NUMBER ||
				($FldDataType == EWRPT_DATATYPE_NUMBER && is_numeric($wrkFldVal1) && is_numeric($wrkFldVal2)));
			if ($wrkFldVal1 <> "" && $wrkFldVal2 <> "" && $IsValidValue)
				$sWrk = $FldExpression . " BETWEEN " . ewrpt_QuotedValue($wrkFldVal1, $FldDataType) .
					" AND " . ewrpt_QuotedValue($wrkFldVal2, $FldDataType);
		} elseif ($FldOpr1 == "IS NULL" || $FldOpr1 == "IS NOT NULL") {
			$sWrk = $FldExpression . " " . $wrkFldVal1;
		} else {
			$IsValidValue = ($FldDataType <> EWRPT_DATATYPE_NUMBER ||
				($FldDataType == EWRPT_DATATYPE_NUMBER && is_numeric($wrkFldVal1)));
			if ($wrkFldVal1 <> "" && $IsValidValue && ewrpt_IsValidOpr($FldOpr1, $FldDataType))
				$sWrk = $FldExpression . $this->FilterString($FldOpr1, $wrkFldVal1, $FldDataType);
			$IsValidValue = ($FldDataType <> EWRPT_DATATYPE_NUMBER ||
				($FldDataType == EWRPT_DATATYPE_NUMBER && is_numeric($wrkFldVal2)));
			if ($wrkFldVal2 <> "" && $IsValidValue && ewrpt_IsValidOpr($FldOpr2, $FldDataType)) {
				if ($sWrk <> "")
					$sWrk .= " " . (($FldCond == "OR") ? "OR" : "AND") . " ";
				$sWrk .= $FldExpression . $this->FilterString($FldOpr2, $wrkFldVal2, $FldDataType);
			}
		}
		if ($sWrk <> "") {
			if ($FilterClause <> "") $FilterClause .= " AND ";
			$FilterClause .= "(" . $sWrk . ")";
		}
	}

	// Validate form
	function ValidateForm() {
		global $ReportLanguage, $gsFormError, $reportunpaymember;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br />" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Return filter string
	function FilterString($FldOpr, $FldVal, $FldType) {
		if ($FldOpr == "LIKE" || $FldOpr == "NOT LIKE") {
			return " " . $FldOpr . " " . ewrpt_QuotedValue("%$FldVal%", $FldType);
		} elseif ($FldOpr == "STARTS WITH") {
			return " LIKE " . ewrpt_QuotedValue("$FldVal%", $FldType);
		} else {
			return " $FldOpr " . ewrpt_QuotedValue($FldVal, $FldType);
		}
	}

	// Return date search string
	function DateFilterString($FldOpr, $FldVal, $FldType) {
		$wrkVal1 = ewrpt_DateVal($FldOpr, $FldVal, 1);
		$wrkVal2 = ewrpt_DateVal($FldOpr, $FldVal, 2);
		if ($wrkVal1 <> "" && $wrkVal2 <> "") {
			return " BETWEEN " . ewrpt_QuotedValue($wrkVal1, $FldType) . " AND " . ewrpt_QuotedValue($wrkVal2, $FldType);
		} else {
			return "";
		}
	}

	// Clear selection stored in session
	function ClearSessionSelection($parm) {
		$_SESSION["sel_reportunpaymember_$parm"] = "";
		$_SESSION["rf_reportunpaymember_$parm"] = "";
		$_SESSION["rt_reportunpaymember_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $reportunpaymember;
		$fld =& $reportunpaymember->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_reportunpaymember_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_reportunpaymember_$parm"];
		$fld->RangeTo = @$_SESSION["rt_reportunpaymember_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $reportunpaymember;

		/**
		* Set up default values for non Text filters
		*/

		/**
		* Set up default values for extended filters
		* function SetDefaultExtFilter(&$fld, $so1, $sv1, $sc, $so2, $sv2)
		* Parameters:
		* $fld - Field object
		* $so1 - Default search operator 1
		* $sv1 - Default ext filter value 1
		* $sc - Default search condition (if operator 2 is enabled)
		* $so2 - Default search operator 2 (if operator 2 is enabled)
		* $sv2 - Default ext filter value 2 (if operator 2 is enabled)
		*/

		// Field fname
		$this->SetDefaultExtFilter($reportunpaymember->fname, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($reportunpaymember->fname);

		// Field lname
		$this->SetDefaultExtFilter($reportunpaymember->lname, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($reportunpaymember->lname);

		// Field member_code
		$this->SetDefaultExtFilter($reportunpaymember->member_code, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($reportunpaymember->member_code);

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/

		// Field t_title
		// Setup your default values for the popup filter below, e.g.
		// $reportunpaymember->t_title->DefaultSelectionList = array("val1", "val2");

		$reportunpaymember->t_title->DefaultSelectionList = "";
		$reportunpaymember->t_title->SelectionList = $reportunpaymember->t_title->DefaultSelectionList;

		// Field v_title
		// Setup your default values for the popup filter below, e.g.
		// $reportunpaymember->v_title->DefaultSelectionList = array("val1", "val2");

		$reportunpaymember->v_title->DefaultSelectionList = "";
		$reportunpaymember->v_title->SelectionList = $reportunpaymember->v_title->DefaultSelectionList;

		// Field pt_title
		// Setup your default values for the popup filter below, e.g.
		// $reportunpaymember->pt_title->DefaultSelectionList = array("val1", "val2");

		$reportunpaymember->pt_title->DefaultSelectionList = "";
		$reportunpaymember->pt_title->SelectionList = $reportunpaymember->pt_title->DefaultSelectionList;

		// Field did
		// Setup your default values for the popup filter below, e.g.
		// $reportunpaymember->did->DefaultSelectionList = array("val1", "val2");

		$reportunpaymember->did->DefaultSelectionList = "";
		$reportunpaymember->did->SelectionList = $reportunpaymember->did->DefaultSelectionList;

		// Field dname
		// Setup your default values for the popup filter below, e.g.
		// $reportunpaymember->dname->DefaultSelectionList = array("val1", "val2");

		$reportunpaymember->dname->DefaultSelectionList = "";
		$reportunpaymember->dname->SelectionList = $reportunpaymember->dname->DefaultSelectionList;

		// Field cal_status
		// Setup your default values for the popup filter below, e.g.
		// $reportunpaymember->cal_status->DefaultSelectionList = array("val1", "val2");

		$reportunpaymember->cal_status->DefaultSelectionList = "";
		$reportunpaymember->cal_status->SelectionList = $reportunpaymember->cal_status->DefaultSelectionList;

		// Field invoice_senddate
		// Setup your default values for the popup filter below, e.g.
		// $reportunpaymember->invoice_senddate->DefaultSelectionList = array("val1", "val2");

		$reportunpaymember->invoice_senddate->DefaultSelectionList = "";
		$reportunpaymember->invoice_senddate->SelectionList = $reportunpaymember->invoice_senddate->DefaultSelectionList;

		// Field invoice_duedate
		// Setup your default values for the popup filter below, e.g.
		// $reportunpaymember->invoice_duedate->DefaultSelectionList = array("val1", "val2");

		$reportunpaymember->invoice_duedate->DefaultSelectionList = "";
		$reportunpaymember->invoice_duedate->SelectionList = $reportunpaymember->invoice_duedate->DefaultSelectionList;

		// Field notice_senddate
		// Setup your default values for the popup filter below, e.g.
		// $reportunpaymember->notice_senddate->DefaultSelectionList = array("val1", "val2");

		$reportunpaymember->notice_senddate->DefaultSelectionList = "";
		$reportunpaymember->notice_senddate->SelectionList = $reportunpaymember->notice_senddate->DefaultSelectionList;

		// Field notice_duedate
		// Setup your default values for the popup filter below, e.g.
		// $reportunpaymember->notice_duedate->DefaultSelectionList = array("val1", "val2");

		$reportunpaymember->notice_duedate->DefaultSelectionList = "";
		$reportunpaymember->notice_duedate->SelectionList = $reportunpaymember->notice_duedate->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $reportunpaymember;

		// Check t_title popup filter
		if (!ewrpt_MatchedArray($reportunpaymember->t_title->DefaultSelectionList, $reportunpaymember->t_title->SelectionList))
			return TRUE;

		// Check v_title popup filter
		if (!ewrpt_MatchedArray($reportunpaymember->v_title->DefaultSelectionList, $reportunpaymember->v_title->SelectionList))
			return TRUE;

		// Check fname text filter
		if ($this->TextFilterApplied($reportunpaymember->fname))
			return TRUE;

		// Check lname text filter
		if ($this->TextFilterApplied($reportunpaymember->lname))
			return TRUE;

		// Check pt_title popup filter
		if (!ewrpt_MatchedArray($reportunpaymember->pt_title->DefaultSelectionList, $reportunpaymember->pt_title->SelectionList))
			return TRUE;

		// Check did popup filter
		if (!ewrpt_MatchedArray($reportunpaymember->did->DefaultSelectionList, $reportunpaymember->did->SelectionList))
			return TRUE;

		// Check dname popup filter
		if (!ewrpt_MatchedArray($reportunpaymember->dname->DefaultSelectionList, $reportunpaymember->dname->SelectionList))
			return TRUE;

		// Check member_code text filter
		if ($this->TextFilterApplied($reportunpaymember->member_code))
			return TRUE;

		// Check cal_status popup filter
		if (!ewrpt_MatchedArray($reportunpaymember->cal_status->DefaultSelectionList, $reportunpaymember->cal_status->SelectionList))
			return TRUE;

		// Check invoice_senddate popup filter
		if (!ewrpt_MatchedArray($reportunpaymember->invoice_senddate->DefaultSelectionList, $reportunpaymember->invoice_senddate->SelectionList))
			return TRUE;

		// Check invoice_duedate popup filter
		if (!ewrpt_MatchedArray($reportunpaymember->invoice_duedate->DefaultSelectionList, $reportunpaymember->invoice_duedate->SelectionList))
			return TRUE;

		// Check notice_senddate popup filter
		if (!ewrpt_MatchedArray($reportunpaymember->notice_senddate->DefaultSelectionList, $reportunpaymember->notice_senddate->SelectionList))
			return TRUE;

		// Check notice_duedate popup filter
		if (!ewrpt_MatchedArray($reportunpaymember->notice_duedate->DefaultSelectionList, $reportunpaymember->notice_duedate->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $reportunpaymember;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field t_title
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportunpaymember->t_title->SelectionList))
			$sWrk = ewrpt_JoinArray($reportunpaymember->t_title->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportunpaymember->t_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field v_title
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportunpaymember->v_title->SelectionList))
			$sWrk = ewrpt_JoinArray($reportunpaymember->v_title->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportunpaymember->v_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field fname
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($reportunpaymember->fname, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportunpaymember->fname->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field lname
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($reportunpaymember->lname, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportunpaymember->lname->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field pt_title
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportunpaymember->pt_title->SelectionList))
			$sWrk = ewrpt_JoinArray($reportunpaymember->pt_title->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportunpaymember->pt_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field did
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportunpaymember->did->SelectionList))
			$sWrk = ewrpt_JoinArray($reportunpaymember->did->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportunpaymember->did->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field dname
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportunpaymember->dname->SelectionList))
			$sWrk = ewrpt_JoinArray($reportunpaymember->dname->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportunpaymember->dname->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field member_code
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($reportunpaymember->member_code, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportunpaymember->member_code->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field cal_status
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportunpaymember->cal_status->SelectionList))
			$sWrk = ewrpt_JoinArray($reportunpaymember->cal_status->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportunpaymember->cal_status->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field invoice_senddate
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportunpaymember->invoice_senddate->SelectionList))
			$sWrk = ewrpt_JoinArray($reportunpaymember->invoice_senddate->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportunpaymember->invoice_senddate->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field invoice_duedate
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportunpaymember->invoice_duedate->SelectionList))
			$sWrk = ewrpt_JoinArray($reportunpaymember->invoice_duedate->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportunpaymember->invoice_duedate->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field notice_senddate
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportunpaymember->notice_senddate->SelectionList))
			$sWrk = ewrpt_JoinArray($reportunpaymember->notice_senddate->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportunpaymember->notice_senddate->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field notice_duedate
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportunpaymember->notice_duedate->SelectionList))
			$sWrk = ewrpt_JoinArray($reportunpaymember->notice_duedate->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportunpaymember->notice_duedate->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Show Filters
		if ($sFilterList <> "")
			echo $ReportLanguage->Phrase("CurrentFilters") . "<br />$sFilterList";
	}

	// Return poup filter
	function GetPopupFilter() {
		global $reportunpaymember;
		$sWrk = "";
			if (is_array($reportunpaymember->t_title->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportunpaymember->t_title, "tambon.t_title", EWRPT_DATATYPE_STRING);
			}
			if (is_array($reportunpaymember->v_title->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportunpaymember->v_title, "village.v_title", EWRPT_DATATYPE_STRING);
			}
			if (is_array($reportunpaymember->pt_title->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportunpaymember->pt_title, "paymenttype.pt_title", EWRPT_DATATYPE_STRING);
			}
			if (is_array($reportunpaymember->did->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportunpaymember->did, "(Select members.dead_id From members Where members.member_code = subvcalculate.member_code)", EWRPT_DATATYPE_NUMBER);
			}
			if (is_array($reportunpaymember->dname->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportunpaymember->dname, "(Select members.fname From members Where members.member_code = subvcalculate.member_code)", EWRPT_DATATYPE_STRING);
			}
			if (is_array($reportunpaymember->cal_status->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportunpaymember->cal_status, "subvcalculate.cal_status", EWRPT_DATATYPE_STRING);
			}
			if (is_array($reportunpaymember->invoice_senddate->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportunpaymember->invoice_senddate, "subvcalculate.invoice_senddate", EWRPT_DATATYPE_DATE);
			}
			if (is_array($reportunpaymember->invoice_duedate->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportunpaymember->invoice_duedate, "subvcalculate.invoice_duedate", EWRPT_DATATYPE_DATE);
			}
			if (is_array($reportunpaymember->notice_senddate->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportunpaymember->notice_senddate, "subvcalculate.notice_senddate", EWRPT_DATATYPE_DATE);
			}
			if (is_array($reportunpaymember->notice_duedate->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportunpaymember->notice_duedate, "subvcalculate.notice_duedate", EWRPT_DATATYPE_DATE);
			}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $reportunpaymember;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$reportunpaymember->setOrderBy("");
				$reportunpaymember->setStartGroup(1);
				$reportunpaymember->t_title->setSort("");
				$reportunpaymember->t_code->setSort("");
				$reportunpaymember->v_code->setSort("");
				$reportunpaymember->v_title->setSort("");
				$reportunpaymember->prefix->setSort("");
				$reportunpaymember->fname->setSort("");
				$reportunpaymember->lname->setSort("");
				$reportunpaymember->pt_title->setSort("");
				$reportunpaymember->did->setSort("");
				$reportunpaymember->dname->setSort("");
				$reportunpaymember->cal_detail->setSort("");
				$reportunpaymember->adv_num->setSort("");
				$reportunpaymember->unit_rate->setSort("");
				$reportunpaymember->cal_status->setSort("");
				$reportunpaymember->invoice_senddate->setSort("");
				$reportunpaymember->invoice_duedate->setSort("");
				$reportunpaymember->notice_senddate->setSort("");
				$reportunpaymember->notice_duedate->setSort("");
				$reportunpaymember->member_status->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$reportunpaymember->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$reportunpaymember->CurrentOrderType = @$_GET["ordertype"];
			$reportunpaymember->UpdateSort($reportunpaymember->t_title); // t_title
			$reportunpaymember->UpdateSort($reportunpaymember->t_code); // t_code
			$reportunpaymember->UpdateSort($reportunpaymember->v_code); // v_code
			$reportunpaymember->UpdateSort($reportunpaymember->v_title); // v_title
			$reportunpaymember->UpdateSort($reportunpaymember->prefix); // prefix
			$reportunpaymember->UpdateSort($reportunpaymember->fname); // fname
			$reportunpaymember->UpdateSort($reportunpaymember->lname); // lname
			$reportunpaymember->UpdateSort($reportunpaymember->pt_title); // pt_title
			$reportunpaymember->UpdateSort($reportunpaymember->did); // did
			$reportunpaymember->UpdateSort($reportunpaymember->dname); // dname
			$reportunpaymember->UpdateSort($reportunpaymember->cal_detail); // cal_detail
			$reportunpaymember->UpdateSort($reportunpaymember->adv_num); // adv_num
			$reportunpaymember->UpdateSort($reportunpaymember->unit_rate); // unit_rate
			$reportunpaymember->UpdateSort($reportunpaymember->cal_status); // cal_status
			$reportunpaymember->UpdateSort($reportunpaymember->invoice_senddate); // invoice_senddate
			$reportunpaymember->UpdateSort($reportunpaymember->invoice_duedate); // invoice_duedate
			$reportunpaymember->UpdateSort($reportunpaymember->notice_senddate); // notice_senddate
			$reportunpaymember->UpdateSort($reportunpaymember->notice_duedate); // notice_duedate
			$reportunpaymember->UpdateSort($reportunpaymember->member_status); // member_status
			$sSortSql = $reportunpaymember->SortSql();
			$reportunpaymember->setOrderBy($sSortSql);
			$reportunpaymember->setStartGroup(1);
		}
		return $reportunpaymember->getOrderBy();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

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
}
?>
