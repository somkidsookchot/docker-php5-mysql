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
$reportpayment = NULL;

//
// Table class for reportpayment
//
class crreportpayment {
	var $TableVar = 'reportpayment';
	var $TableName = 'reportpayment';
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
	var $pay_sum_id;
	var $village_id;
	var $member_code;
	var $fname;
	var $lname;
	var $pt_title;
	var $pay_sum_type;
	var $pay_death_begin;
	var $pay_death_end;
	var $pay_annual_year;
	var $pay_sum_adv_num;
	var $pay_sum_adv_count;
	var $pay_sum_detail;
	var $pay_sum_total;
	var $pay_sum_note;
	var $flag;
	var $pay_sum_date;
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
	function crreportpayment() {
		global $ReportLanguage;

		// t_code
		$this->t_code = new crField('reportpayment', 'reportpayment', 'x_t_code', 't_code', '`t_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->t_code->GroupingFieldId = 2;
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";
		$this->t_code->FldGroupByType = "";
		$this->t_code->FldGroupInt = "0";
		$this->t_code->FldGroupSql = "";

		// t_title
		$this->t_title = new crField('reportpayment', 'reportpayment', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->t_title->GroupingFieldId = 1;
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "SELECT DISTINCT tambon.t_title FROM " . $this->SqlFrom();
		$this->t_title->SqlOrderBy = "tambon.t_title";
		$this->t_title->FldGroupByType = "";
		$this->t_title->FldGroupInt = "0";
		$this->t_title->FldGroupSql = "";

		// v_code
		$this->v_code = new crField('reportpayment', 'reportpayment', 'x_v_code', 'v_code', 'village.v_code', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->v_code->GroupingFieldId = 3;
		$this->v_code->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['v_code'] =& $this->v_code;
		$this->v_code->DateFilter = "";
		$this->v_code->SqlSelect = "SELECT DISTINCT village.v_code FROM " . $this->SqlFrom();
		$this->v_code->SqlOrderBy = "village.v_code";
		$this->v_code->FldGroupByType = "";
		$this->v_code->FldGroupInt = "0";
		$this->v_code->FldGroupSql = "";

		// v_title
		$this->v_title = new crField('reportpayment', 'reportpayment', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->v_title->GroupingFieldId = 4;
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "SELECT DISTINCT village.v_title FROM " . $this->SqlFrom();
		$this->v_title->SqlOrderBy = "village.v_title";
		$this->v_title->FldGroupByType = "";
		$this->v_title->FldGroupInt = "0";
		$this->v_title->FldGroupSql = "";

		// pay_sum_id
		$this->pay_sum_id = new crField('reportpayment', 'reportpayment', 'x_pay_sum_id', 'pay_sum_id', '`pay_sum_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_id'] =& $this->pay_sum_id;
		$this->pay_sum_id->DateFilter = "";
		$this->pay_sum_id->SqlSelect = "";
		$this->pay_sum_id->SqlOrderBy = "";
		$this->pay_sum_id->FldGroupByType = "";
		$this->pay_sum_id->FldGroupInt = "0";
		$this->pay_sum_id->FldGroupSql = "";

		// village_id
		$this->village_id = new crField('reportpayment', 'reportpayment', 'x_village_id', 'village_id', '`village_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";
		$this->village_id->FldGroupByType = "";
		$this->village_id->FldGroupInt = "0";
		$this->village_id->FldGroupSql = "";

		// member_code
		$this->member_code = new crField('reportpayment', 'reportpayment', 'x_member_code', 'member_code', '`member_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";
		$this->member_code->FldGroupByType = "";
		$this->member_code->FldGroupInt = "0";
		$this->member_code->FldGroupSql = "";

		// fname
		$this->fname = new crField('reportpayment', 'reportpayment', 'x_fname', 'fname', 'members.fname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";
		$this->fname->FldGroupByType = "";
		$this->fname->FldGroupInt = "0";
		$this->fname->FldGroupSql = "";

		// lname
		$this->lname = new crField('reportpayment', 'reportpayment', 'x_lname', 'lname', 'members.lname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";
		$this->lname->FldGroupByType = "";
		$this->lname->FldGroupInt = "0";
		$this->lname->FldGroupSql = "";

		// pt_title
		$this->pt_title = new crField('reportpayment', 'reportpayment', 'x_pt_title', 'pt_title', 'paymenttype.pt_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pt_title'] =& $this->pt_title;
		$this->pt_title->DateFilter = "";
		$this->pt_title->SqlSelect = "";
		$this->pt_title->SqlOrderBy = "";
		$this->pt_title->FldGroupByType = "";
		$this->pt_title->FldGroupInt = "0";
		$this->pt_title->FldGroupSql = "";

		// pay_sum_type
		$this->pay_sum_type = new crField('reportpayment', 'reportpayment', 'x_pay_sum_type', 'pay_sum_type', '`pay_sum_type`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_type'] =& $this->pay_sum_type;
		$this->pay_sum_type->DateFilter = "";
		$this->pay_sum_type->SqlSelect = "";
		$this->pay_sum_type->SqlOrderBy = "";
		$this->pay_sum_type->FldGroupByType = "";
		$this->pay_sum_type->FldGroupInt = "0";
		$this->pay_sum_type->FldGroupSql = "";

		// pay_death_begin
		$this->pay_death_begin = new crField('reportpayment', 'reportpayment', 'x_pay_death_begin', 'pay_death_begin', '`pay_death_begin`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_death_begin->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_death_begin'] =& $this->pay_death_begin;
		$this->pay_death_begin->DateFilter = "";
		$this->pay_death_begin->SqlSelect = "SELECT DISTINCT `pay_death_begin` FROM " . $this->SqlFrom();
		$this->pay_death_begin->SqlOrderBy = "`pay_death_begin`";
		$this->pay_death_begin->FldGroupByType = "";
		$this->pay_death_begin->FldGroupInt = "0";
		$this->pay_death_begin->FldGroupSql = "";

		// pay_death_end
		$this->pay_death_end = new crField('reportpayment', 'reportpayment', 'x_pay_death_end', 'pay_death_end', '`pay_death_end`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_death_end->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_death_end'] =& $this->pay_death_end;
		$this->pay_death_end->DateFilter = "";
		$this->pay_death_end->SqlSelect = "SELECT DISTINCT `pay_death_end` FROM " . $this->SqlFrom();
		$this->pay_death_end->SqlOrderBy = "`pay_death_end`";
		$this->pay_death_end->FldGroupByType = "";
		$this->pay_death_end->FldGroupInt = "0";
		$this->pay_death_end->FldGroupSql = "";

		// pay_annual_year
		$this->pay_annual_year = new crField('reportpayment', 'reportpayment', 'x_pay_annual_year', 'pay_annual_year', '`pay_annual_year`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pay_annual_year'] =& $this->pay_annual_year;
		$this->pay_annual_year->DateFilter = "";
		$this->pay_annual_year->SqlSelect = "SELECT DISTINCT `pay_annual_year` FROM " . $this->SqlFrom();
		$this->pay_annual_year->SqlOrderBy = "`pay_annual_year`";
		$this->pay_annual_year->FldGroupByType = "";
		$this->pay_annual_year->FldGroupInt = "0";
		$this->pay_annual_year->FldGroupSql = "";

		// pay_sum_adv_num
		$this->pay_sum_adv_num = new crField('reportpayment', 'reportpayment', 'x_pay_sum_adv_num', 'pay_sum_adv_num', '`pay_sum_adv_num`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_adv_num->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_adv_num'] =& $this->pay_sum_adv_num;
		$this->pay_sum_adv_num->DateFilter = "";
		$this->pay_sum_adv_num->SqlSelect = "SELECT DISTINCT `pay_sum_adv_num` FROM " . $this->SqlFrom();
		$this->pay_sum_adv_num->SqlOrderBy = "`pay_sum_adv_num`";
		$this->pay_sum_adv_num->FldGroupByType = "";
		$this->pay_sum_adv_num->FldGroupInt = "0";
		$this->pay_sum_adv_num->FldGroupSql = "";

		// pay_sum_adv_count
		$this->pay_sum_adv_count = new crField('reportpayment', 'reportpayment', 'x_pay_sum_adv_count', 'pay_sum_adv_count', '`pay_sum_adv_count`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_adv_count->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_adv_count'] =& $this->pay_sum_adv_count;
		$this->pay_sum_adv_count->DateFilter = "";
		$this->pay_sum_adv_count->SqlSelect = "";
		$this->pay_sum_adv_count->SqlOrderBy = "";
		$this->pay_sum_adv_count->FldGroupByType = "";
		$this->pay_sum_adv_count->FldGroupInt = "0";
		$this->pay_sum_adv_count->FldGroupSql = "";

		// pay_sum_detail
		$this->pay_sum_detail = new crField('reportpayment', 'reportpayment', 'x_pay_sum_detail', 'pay_sum_detail', '`pay_sum_detail`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pay_sum_detail'] =& $this->pay_sum_detail;
		$this->pay_sum_detail->DateFilter = "";
		$this->pay_sum_detail->SqlSelect = "";
		$this->pay_sum_detail->SqlOrderBy = "";
		$this->pay_sum_detail->FldGroupByType = "";
		$this->pay_sum_detail->FldGroupInt = "0";
		$this->pay_sum_detail->FldGroupSql = "";

		// pay_sum_total
		$this->pay_sum_total = new crField('reportpayment', 'reportpayment', 'x_pay_sum_total', 'pay_sum_total', '`pay_sum_total`', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['pay_sum_total'] =& $this->pay_sum_total;
		$this->pay_sum_total->DateFilter = "";
		$this->pay_sum_total->SqlSelect = "";
		$this->pay_sum_total->SqlOrderBy = "";
		$this->pay_sum_total->FldGroupByType = "";
		$this->pay_sum_total->FldGroupInt = "0";
		$this->pay_sum_total->FldGroupSql = "";

		// pay_sum_note
		$this->pay_sum_note = new crField('reportpayment', 'reportpayment', 'x_pay_sum_note', 'pay_sum_note', '`pay_sum_note`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['pay_sum_note'] =& $this->pay_sum_note;
		$this->pay_sum_note->DateFilter = "";
		$this->pay_sum_note->SqlSelect = "";
		$this->pay_sum_note->SqlOrderBy = "";
		$this->pay_sum_note->FldGroupByType = "";
		$this->pay_sum_note->FldGroupInt = "0";
		$this->pay_sum_note->FldGroupSql = "";

		// flag
		$this->flag = new crField('reportpayment', 'reportpayment', 'x_flag', 'flag', '`flag`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->flag->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['flag'] =& $this->flag;
		$this->flag->DateFilter = "";
		$this->flag->SqlSelect = "";
		$this->flag->SqlOrderBy = "";
		$this->flag->FldGroupByType = "";
		$this->flag->FldGroupInt = "0";
		$this->flag->FldGroupSql = "";

		// pay_sum_date
		$this->pay_sum_date = new crField('reportpayment', 'reportpayment', 'x_pay_sum_date', 'pay_sum_date', '`pay_sum_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->pay_sum_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['pay_sum_date'] =& $this->pay_sum_date;
		$this->pay_sum_date->DateFilter = "";
		$this->pay_sum_date->SqlSelect = "SELECT DISTINCT `pay_sum_date` FROM " . $this->SqlFrom();
		$this->pay_sum_date->SqlOrderBy = "`pay_sum_date`";
		$this->pay_sum_date->FldGroupByType = "";
		$this->pay_sum_date->FldGroupInt = "0";
		$this->pay_sum_date->FldGroupSql = "";
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
		return "tambon Inner Join village On tambon.t_code = village.t_code Inner Join members On village.village_id = members.village_id Inner Join paymentsummary On members.member_code = paymentsummary.member_code Inner Join paymenttype On paymenttype.pt_id = paymentsummary.pay_sum_type";
	}

	function SqlSelect() { // Select
		return "SELECT paymentsummary.*, paymenttype.pt_title, village.v_title, village.v_code, tambon.t_title, members.fname, members.lname FROM " . $this->SqlFrom();
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
		return "tambon.t_title ASC, `t_code` ASC, village.v_code ASC, village.v_title ASC";
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
		return "SELECT SUM(`pay_sum_total`) AS sum_pay_sum_total FROM " . $this->SqlFrom();
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
$reportpayment_summary = new crreportpayment_summary();
$Page =& $reportpayment_summary;

// Page init
$reportpayment_summary->Page_Init();

// Page main
$reportpayment_summary->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($reportpayment->Export == "") { ?>
<script type="text/javascript">

// Create page object
var reportpayment_summary = new ewrpt_Page("reportpayment_summary");

// page properties
reportpayment_summary.PageID = "summary"; // page ID
reportpayment_summary.FormID = "freportpaymentsummaryfilter"; // form ID
var EWRPT_PAGE_ID = reportpayment_summary.PageID;

// extend page with ValidateForm function
reportpayment_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
reportpayment_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
reportpayment_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
reportpayment_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $reportpayment_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $reportpayment_summary->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php if ($reportpayment->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($reportpayment->t_title, $reportpayment->t_title->FldType); ?>
ewrpt_CreatePopup("reportpayment_t_title", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportpayment->v_code, $reportpayment->v_code->FldType); ?>
ewrpt_CreatePopup("reportpayment_v_code", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportpayment->v_title, $reportpayment->v_title->FldType); ?>
ewrpt_CreatePopup("reportpayment_v_title", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportpayment->pay_death_begin, $reportpayment->pay_death_begin->FldType); ?>
ewrpt_CreatePopup("reportpayment_pay_death_begin", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportpayment->pay_annual_year, $reportpayment->pay_annual_year->FldType); ?>
ewrpt_CreatePopup("reportpayment_pay_annual_year", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportpayment->pay_sum_adv_num, $reportpayment->pay_sum_adv_num->FldType); ?>
ewrpt_CreatePopup("reportpayment_pay_sum_adv_num", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportpayment->pay_sum_date, $reportpayment->pay_sum_date->FldType); ?>
ewrpt_CreatePopup("reportpayment_pay_sum_date", [<?php echo $jsdata ?>]);
</script>
<div id="reportpayment_t_title_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportpayment_v_code_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportpayment_v_title_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportpayment_pay_death_begin_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportpayment_pay_annual_year_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportpayment_pay_sum_adv_num_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportpayment_pay_sum_date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($reportpayment->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<div class="ewTitle"><?php if (!$_GET["export"]) { ?><img src="images/finance55x55.png" width="40" height="40" align="absmiddle" /><?php }?><?php echo $reportpayment->TableCaption() ?></div>
<br /><br />
<?php if ($reportpayment->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($reportpayment->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($reportpayment->Export == "") { ?>
<?php
if ($reportpayment->FilterPanelOption == 2 || ($reportpayment->FilterPanelOption == 3 && $reportpayment_summary->FilterApplied) || $reportpayment_summary->Filter == "0=101") {
	$sButtonImage = "phprptimages/collapse.png";
	$sDivDisplay = "";
} else {
	$sButtonImage = "phprptimages/expand.png";
	$sDivDisplay = " style=\"display: none;\"";
}
?>
<a href="javascript:ewrpt_ToggleFilterPanel();" style="text-decoration: none;"><img id="ewrptToggleFilterImg" src="<?php echo $sButtonImage ?>" alt=""  border="0" align="absbottom"></a><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("Filters") ?>  <?php if ($reportpayment_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="reportpaymentsmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>&nbsp;&nbsp;<a href="<?php echo $reportpayment_summary->ExportExcelUrl ?>"><img src="images/bt_export_excel.png" align="absmiddle" border="0"/></a></span><br />
<div id="ewrptExtFilterPanel"<?php echo $sDivDisplay ?> class="listSearch">
<!-- Search form (begin) -->
<form name="freportpaymentsummaryfilter" id="freportpaymentsummaryfilter" action="reportpaymentsmry.php" class="ewForm" onsubmit="return reportpayment_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportpayment->pt_title->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_pt_title" id="sv_pt_title"<?php echo ($reportpayment_summary->ClearExtFilter == 'reportpayment_pt_title') ? " class=\"ewInputCleared\"" : "" ?> onchange="this.form.submit();">
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($reportpayment->pt_title->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($reportpayment->pt_title->CustomFilters) ? count($reportpayment->pt_title->CustomFilters) : 0;
$cntd = is_array($reportpayment->pt_title->DropDownList) ? count($reportpayment->pt_title->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($reportpayment->pt_title->CustomFilters[$i]->FldName == 'pt_title') {
?>
		<option value="<?php echo "@@" . $reportpayment->pt_title->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($reportpayment->pt_title->DropDownValue, "@@" . $reportpayment->pt_title->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $reportpayment->pt_title->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $reportpayment->pt_title->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($reportpayment->pt_title->DropDownValue, $reportpayment->pt_title->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($reportpayment->pt_title->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
</table>
</form>
<!-- Search form (end) -->
</div>
<?php } ?>
<?php if ($reportpayment->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $reportpayment_summary->ShowFilterList() ?>
</div>
<?php } ?>
<div class="clear"></div></<br /><br />

<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($reportpayment->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="reportpaymentsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportpayment_summary->StartGrp, $reportpayment_summary->DisplayGrps, $reportpayment_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportpaymentsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportpaymentsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportpaymentsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportpaymentsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($reportpayment_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportpayment_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportpayment_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportpayment_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportpayment_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportpayment_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportpayment_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportpayment_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportpayment_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportpayment_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportpayment->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($reportpayment->ExportAll && $reportpayment->Export <> "") {
	$reportpayment_summary->StopGrp = $reportpayment_summary->TotalGrps;
} else {
	$reportpayment_summary->StopGrp = $reportpayment_summary->StartGrp + $reportpayment_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($reportpayment_summary->StopGrp) > intval($reportpayment_summary->TotalGrps))
	$reportpayment_summary->StopGrp = $reportpayment_summary->TotalGrps;
$reportpayment_summary->RecCount = 0;

// Get first row
if ($reportpayment_summary->TotalGrps > 0) {
	$reportpayment_summary->GetGrpRow(1);
	$reportpayment_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $reportpayment_summary->GrpCount <= $reportpayment_summary->DisplayGrps) || $reportpayment_summary->ShowFirstHeader) {

	// Show header
	if ($reportpayment_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->t_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->t_title) ?>',1);"><?php echo $reportpayment->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportpayment->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportpayment_t_title', false, '<?php echo $reportpayment->t_title->RangeFrom; ?>', '<?php echo $reportpayment->t_title->RangeTo; ?>');return false;" name="x_t_title<?php echo $reportpayment_summary->Cnt[0][0]; ?>" id="x_t_title<?php echo $reportpayment_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->t_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->t_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->t_code) ?>',1);"><?php echo $reportpayment->t_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->t_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->t_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->v_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->v_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->v_code) ?>',1);"><?php echo $reportpayment->v_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->v_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->v_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportpayment->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportpayment_v_code', false, '<?php echo $reportpayment->v_code->RangeFrom; ?>', '<?php echo $reportpayment->v_code->RangeTo; ?>');return false;" name="x_v_code<?php echo $reportpayment_summary->Cnt[0][0]; ?>" id="x_v_code<?php echo $reportpayment_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->v_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->v_title) ?>',1);"><?php echo $reportpayment->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportpayment->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportpayment_v_title', false, '<?php echo $reportpayment->v_title->RangeFrom; ?>', '<?php echo $reportpayment->v_title->RangeTo; ?>');return false;" name="x_v_title<?php echo $reportpayment_summary->Cnt[0][0]; ?>" id="x_v_title<?php echo $reportpayment_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->pay_sum_id) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->pay_sum_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->pay_sum_id) ?>',1);"><?php echo $reportpayment->pay_sum_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->pay_sum_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->pay_sum_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->member_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->member_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->member_code) ?>',1);"><?php echo $reportpayment->member_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->member_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->member_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->fname) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->fname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->fname) ?>',1);"><?php echo $reportpayment->fname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->fname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->fname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->lname) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->lname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->lname) ?>',1);"><?php echo $reportpayment->lname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->lname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->lname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->pt_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->pt_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->pt_title) ?>',1);"><?php echo $reportpayment->pt_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->pt_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->pt_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->pay_death_begin) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->pay_death_begin->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->pay_death_begin) ?>',1);"><?php echo $reportpayment->pay_death_begin->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->pay_death_begin->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->pay_death_begin->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportpayment->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportpayment_pay_death_begin', false, '<?php echo $reportpayment->pay_death_begin->RangeFrom; ?>', '<?php echo $reportpayment->pay_death_begin->RangeTo; ?>');return false;" name="x_pay_death_begin<?php echo $reportpayment_summary->Cnt[0][0]; ?>" id="x_pay_death_begin<?php echo $reportpayment_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->pay_annual_year) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->pay_annual_year->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->pay_annual_year) ?>',1);"><?php echo $reportpayment->pay_annual_year->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->pay_annual_year->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->pay_annual_year->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportpayment->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportpayment_pay_annual_year', false, '<?php echo $reportpayment->pay_annual_year->RangeFrom; ?>', '<?php echo $reportpayment->pay_annual_year->RangeTo; ?>');return false;" name="x_pay_annual_year<?php echo $reportpayment_summary->Cnt[0][0]; ?>" id="x_pay_annual_year<?php echo $reportpayment_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->pay_sum_adv_num) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->pay_sum_adv_num->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->pay_sum_adv_num) ?>',1);"><?php echo $reportpayment->pay_sum_adv_num->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->pay_sum_adv_num->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->pay_sum_adv_num->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportpayment->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportpayment_pay_sum_adv_num', false, '<?php echo $reportpayment->pay_sum_adv_num->RangeFrom; ?>', '<?php echo $reportpayment->pay_sum_adv_num->RangeTo; ?>');return false;" name="x_pay_sum_adv_num<?php echo $reportpayment_summary->Cnt[0][0]; ?>" id="x_pay_sum_adv_num<?php echo $reportpayment_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->pay_sum_detail) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->pay_sum_detail->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->pay_sum_detail) ?>',1);"><?php echo $reportpayment->pay_sum_detail->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->pay_sum_detail->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->pay_sum_detail->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->pay_sum_total) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->pay_sum_total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->pay_sum_total) ?>',1);"><?php echo $reportpayment->pay_sum_total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->pay_sum_total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->pay_sum_total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->pay_sum_note) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->pay_sum_note->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->pay_sum_note) ?>',1);"><?php echo $reportpayment->pay_sum_note->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->pay_sum_note->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->pay_sum_note->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpayment->SortUrl($reportpayment->pay_sum_date) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpayment->pay_sum_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpayment->SortUrl($reportpayment->pay_sum_date) ?>',1);"><?php echo $reportpayment->pay_sum_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpayment->pay_sum_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpayment->pay_sum_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportpayment->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportpayment_pay_sum_date', true, '<?php echo $reportpayment->pay_sum_date->RangeFrom; ?>', '<?php echo $reportpayment->pay_sum_date->RangeTo; ?>');return false;" name="x_pay_sum_date<?php echo $reportpayment_summary->Cnt[0][0]; ?>" id="x_pay_sum_date<?php echo $reportpayment_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$reportpayment_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($reportpayment->t_title, $reportpayment->SqlFirstGroupField(), $reportpayment->t_title->GroupValue());
	if ($reportpayment_summary->Filter != "")
		$sWhere = "($reportpayment_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($reportpayment->SqlSelect(), $reportpayment->SqlWhere(), $reportpayment->SqlGroupBy(), $reportpayment->SqlHaving(), $reportpayment->SqlOrderBy(), $sWhere, $reportpayment_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$reportpayment_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$reportpayment_summary->RecCount++;

		// Render detail row
		$reportpayment->ResetCSS();
		$reportpayment->RowType = EWRPT_ROWTYPE_DETAIL;
		$reportpayment_summary->RenderRow();
?>
	<tr<?php echo $reportpayment->RowAttributes(); ?>>
		<td<?php echo $reportpayment->t_title->CellAttributes(); ?>><div<?php echo $reportpayment->t_title->ViewAttributes(); ?>><?php echo $reportpayment->t_title->GroupViewValue; ?></div></td>
		<td<?php echo $reportpayment->t_code->CellAttributes(); ?>><div<?php echo $reportpayment->t_code->ViewAttributes(); ?>><?php echo $reportpayment->t_code->GroupViewValue; ?></div></td>
		<td<?php echo $reportpayment->v_code->CellAttributes(); ?>><div<?php echo $reportpayment->v_code->ViewAttributes(); ?>><?php echo $reportpayment->v_code->GroupViewValue; ?></div></td>
		<td<?php echo $reportpayment->v_title->CellAttributes(); ?>><div<?php echo $reportpayment->v_title->ViewAttributes(); ?>><?php echo $reportpayment->v_title->GroupViewValue; ?></div></td>
		<td<?php echo $reportpayment->pay_sum_id->CellAttributes() ?>>
<div<?php echo $reportpayment->pay_sum_id->ViewAttributes(); ?>><?php echo $reportpayment->pay_sum_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->member_code->CellAttributes() ?>>
<div<?php echo $reportpayment->member_code->ViewAttributes(); ?>><?php echo $reportpayment->member_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->fname->CellAttributes() ?>>
<div<?php echo $reportpayment->fname->ViewAttributes(); ?>><?php echo $reportpayment->fname->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->lname->CellAttributes() ?>>
<div<?php echo $reportpayment->lname->ViewAttributes(); ?>><?php echo $reportpayment->lname->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->pt_title->CellAttributes() ?>>
<div<?php echo $reportpayment->pt_title->ViewAttributes(); ?>><?php echo $reportpayment->pt_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->pay_death_begin->CellAttributes() ?>>
<div<?php echo $reportpayment->pay_death_begin->ViewAttributes(); ?>><?php echo $reportpayment->pay_death_begin->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->pay_annual_year->CellAttributes() ?>>
<div<?php echo $reportpayment->pay_annual_year->ViewAttributes(); ?>><?php echo $reportpayment->pay_annual_year->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->pay_sum_adv_num->CellAttributes() ?>>
<div<?php echo $reportpayment->pay_sum_adv_num->ViewAttributes(); ?>><?php echo $reportpayment->pay_sum_adv_num->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->pay_sum_detail->CellAttributes() ?>>
<div<?php echo $reportpayment->pay_sum_detail->ViewAttributes(); ?>><?php echo $reportpayment->pay_sum_detail->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->pay_sum_total->CellAttributes() ?>>
<div<?php echo $reportpayment->pay_sum_total->ViewAttributes(); ?>><?php echo $reportpayment->pay_sum_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->pay_sum_note->CellAttributes() ?>>
<div<?php echo $reportpayment->pay_sum_note->ViewAttributes(); ?>><?php echo $reportpayment->pay_sum_note->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->pay_sum_date->CellAttributes() ?>>
<div<?php echo $reportpayment->pay_sum_date->ViewAttributes(); ?>><?php echo $reportpayment->pay_sum_date->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$reportpayment_summary->AccumulateSummary();

		// Get next record
		$reportpayment_summary->GetRow(2);

		// Show Footers
?>
<?php
		if ($reportpayment_summary->ChkLvlBreak(4)) {
			$reportpayment->ResetCSS();
			$reportpayment->RowType = EWRPT_ROWTYPE_TOTAL;
			$reportpayment->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$reportpayment->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$reportpayment->RowGroupLevel = 4;
			$reportpayment_summary->RenderRow();
?>
	<tr<?php echo $reportpayment->RowAttributes(); ?>>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->t_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->v_code->CellAttributes() ?>>&nbsp;</td>
		<td colspan="13"<?php echo $reportpayment->v_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $reportpayment->v_title->FldCaption() ?>: <?php echo $reportpayment->v_title->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($reportpayment_summary->Cnt[4][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$reportpayment->ResetCSS();
			$reportpayment->pay_sum_total->Count = $reportpayment_summary->Cnt[4][10];
			$reportpayment->pay_sum_total->Summary = $reportpayment_summary->Smry[4][10]; // Load SUM
			$reportpayment->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$reportpayment_summary->RenderRow();
?>
	<tr<?php echo $reportpayment->RowAttributes(); ?>>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->t_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->v_code->CellAttributes() ?>>&nbsp;</td>
		<td colspan="1"<?php echo $reportpayment->v_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportpayment->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->v_title->CellAttributes() ?>>
<div<?php echo $reportpayment->pay_sum_total->ViewAttributes(); ?>><?php echo $reportpayment->pay_sum_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->v_title->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 4 summary
			$reportpayment_summary->ResetLevelSummary(4);
		} // End check level check
?>
<?php
	} // End detail records loop
?>
<?php
			$reportpayment->ResetCSS();
			$reportpayment->RowType = EWRPT_ROWTYPE_TOTAL;
			$reportpayment->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$reportpayment->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$reportpayment->RowGroupLevel = 1;
			$reportpayment_summary->RenderRow();
?>
	<tr<?php echo $reportpayment->RowAttributes(); ?>>
		<td colspan="16"<?php echo $reportpayment->t_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $reportpayment->t_title->FldCaption() ?>: <?php echo $reportpayment->t_title->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($reportpayment_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$reportpayment->ResetCSS();
			$reportpayment->pay_sum_total->Count = $reportpayment_summary->Cnt[1][10];
			$reportpayment->pay_sum_total->Summary = $reportpayment_summary->Smry[1][10]; // Load SUM
			$reportpayment->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$reportpayment_summary->RenderRow();
?>
	<tr<?php echo $reportpayment->RowAttributes(); ?>>
		<td colspan="4"<?php echo $reportpayment->t_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>
<div<?php echo $reportpayment->pay_sum_total->ViewAttributes(); ?>><?php echo $reportpayment->pay_sum_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->t_title->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 1 summary
			$reportpayment_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$reportpayment_summary->GetGrpRow(2);
	$reportpayment_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($reportpayment_summary->TotalGrps > 0) {
	$reportpayment->ResetCSS();
	$reportpayment->RowType = EWRPT_ROWTYPE_TOTAL;
	$reportpayment->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$reportpayment->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$reportpayment->RowAttrs["class"] = "ewRptGrandSummary";
	$reportpayment_summary->RenderRow();
?>
	<!-- tr><td colspan="16"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $reportpayment->RowAttributes(); ?>><td colspan="16"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($reportpayment_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
	$reportpayment->ResetCSS();
	$reportpayment->pay_sum_total->Count = $reportpayment_summary->TotCount;
	$reportpayment->pay_sum_total->Summary = $reportpayment_summary->GrandSmry[10]; // Load SUM
	$reportpayment->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportpayment->pay_sum_total->CurrentValue = $reportpayment->pay_sum_total->Summary;
	$reportpayment->RowAttrs["class"] = "ewRptGrandSummary";
	$reportpayment_summary->RenderRow();
?>
	<tr<?php echo $reportpayment->RowAttributes(); ?>>
		<td colspan="4" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportpayment->pay_sum_id->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->member_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->fname->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->lname->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->pt_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->pay_death_begin->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->pay_annual_year->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->pay_sum_adv_num->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->pay_sum_detail->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->pay_sum_total->CellAttributes() ?>>
<div<?php echo $reportpayment->pay_sum_total->ViewAttributes(); ?>><?php echo $reportpayment->pay_sum_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpayment->pay_sum_note->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpayment->pay_sum_date->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($reportpayment_summary->TotalGrps > 0) { ?>
<?php if ($reportpayment->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="reportpaymentsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportpayment_summary->StartGrp, $reportpayment_summary->DisplayGrps, $reportpayment_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportpaymentsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportpaymentsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportpaymentsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportpaymentsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($reportpayment_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportpayment_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportpayment_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportpayment_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportpayment_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportpayment_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportpayment_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportpayment_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportpayment_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportpayment_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportpayment->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($reportpayment->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($reportpayment->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($reportpayment->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $reportpayment_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($reportpayment->Export == "") { ?>
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
$reportpayment_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crreportpayment_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'reportpayment';

	// Page object name
	var $PageObjName = 'reportpayment_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $reportpayment;
		if ($reportpayment->UseTokenInUrl) $PageUrl .= "t=" . $reportpayment->TableVar . "&"; // Add page token
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
		global $reportpayment;
		if ($reportpayment->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($reportpayment->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($reportpayment->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crreportpayment_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (reportpayment)
		$GLOBALS["reportpayment"] = new crreportpayment();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'reportpayment', TRUE);

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
		global $reportpayment;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$reportpayment->Export = $_GET["export"];
	}
	$gsExport = $reportpayment->Export; // Get export parameter, used in header
	$gsExportFile = $reportpayment->TableVar; // Get export file, used in header
	if ($reportpayment->Export == "excel") {
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
		global $reportpayment;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($reportpayment->Export == "email") {
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
		global $reportpayment;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 13;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, TRUE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$reportpayment->t_title->SelectionList = "";
		$reportpayment->t_title->DefaultSelectionList = "";
		$reportpayment->t_title->ValueList = "";
		$reportpayment->v_code->SelectionList = "";
		$reportpayment->v_code->DefaultSelectionList = "";
		$reportpayment->v_code->ValueList = "";
		$reportpayment->v_title->SelectionList = "";
		$reportpayment->v_title->DefaultSelectionList = "";
		$reportpayment->v_title->ValueList = "";
		$reportpayment->pay_death_begin->SelectionList = "";
		$reportpayment->pay_death_begin->DefaultSelectionList = "";
		$reportpayment->pay_death_begin->ValueList = "";
		$reportpayment->pay_annual_year->SelectionList = "";
		$reportpayment->pay_annual_year->DefaultSelectionList = "";
		$reportpayment->pay_annual_year->ValueList = "";
		$reportpayment->pay_sum_adv_num->SelectionList = "";
		$reportpayment->pay_sum_adv_num->DefaultSelectionList = "";
		$reportpayment->pay_sum_adv_num->ValueList = "";
		$reportpayment->pay_sum_date->SelectionList = "";
		$reportpayment->pay_sum_date->DefaultSelectionList = "";
		$reportpayment->pay_sum_date->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$reportpayment->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($reportpayment->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($reportpayment->SqlSelectGroup(), $reportpayment->SqlWhere(), $reportpayment->SqlGroupBy(), $reportpayment->SqlHaving(), $reportpayment->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($reportpayment->ExportAll && $reportpayment->Export <> "")
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
		global $reportpayment;
		switch ($lvl) {
			case 1:
				return (is_null($reportpayment->t_title->CurrentValue) && !is_null($reportpayment->t_title->OldValue)) ||
					(!is_null($reportpayment->t_title->CurrentValue) && is_null($reportpayment->t_title->OldValue)) ||
					($reportpayment->t_title->GroupValue() <> $reportpayment->t_title->GroupOldValue());
			case 2:
				return (is_null($reportpayment->t_code->CurrentValue) && !is_null($reportpayment->t_code->OldValue)) ||
					(!is_null($reportpayment->t_code->CurrentValue) && is_null($reportpayment->t_code->OldValue)) ||
					($reportpayment->t_code->GroupValue() <> $reportpayment->t_code->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
			case 3:
				return (is_null($reportpayment->v_code->CurrentValue) && !is_null($reportpayment->v_code->OldValue)) ||
					(!is_null($reportpayment->v_code->CurrentValue) && is_null($reportpayment->v_code->OldValue)) ||
					($reportpayment->v_code->GroupValue() <> $reportpayment->v_code->GroupOldValue()) || $this->ChkLvlBreak(2); // Recurse upper level
			case 4:
				return (is_null($reportpayment->v_title->CurrentValue) && !is_null($reportpayment->v_title->OldValue)) ||
					(!is_null($reportpayment->v_title->CurrentValue) && is_null($reportpayment->v_title->OldValue)) ||
					($reportpayment->v_title->GroupValue() <> $reportpayment->v_title->GroupOldValue()) || $this->ChkLvlBreak(3); // Recurse upper level
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
		global $reportpayment;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $reportpayment;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $reportpayment;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$reportpayment->t_title->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$reportpayment->t_title->setDbValue($rsgrp->fields('t_title'));
		if ($rsgrp->EOF) {
			$reportpayment->t_title->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $reportpayment;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$reportpayment->t_code->setDbValue($rs->fields('t_code'));
			if ($opt <> 1)
				$reportpayment->t_title->setDbValue($rs->fields('t_title'));
			$reportpayment->v_code->setDbValue($rs->fields('v_code'));
			$reportpayment->v_title->setDbValue($rs->fields('v_title'));
			$reportpayment->pay_sum_id->setDbValue($rs->fields('pay_sum_id'));
			$reportpayment->village_id->setDbValue($rs->fields('village_id'));
			$reportpayment->member_code->setDbValue($rs->fields('member_code'));
			$reportpayment->fname->setDbValue($rs->fields('fname'));
			$reportpayment->lname->setDbValue($rs->fields('lname'));
			$reportpayment->pt_title->setDbValue($rs->fields('pt_title'));
			$reportpayment->pay_sum_type->setDbValue($rs->fields('pay_sum_type'));
			$reportpayment->pay_death_begin->setDbValue($rs->fields('pay_death_begin'));
			$reportpayment->pay_death_end->setDbValue($rs->fields('pay_death_end'));
			$reportpayment->pay_annual_year->setDbValue($rs->fields('pay_annual_year'));
			$reportpayment->pay_sum_adv_num->setDbValue($rs->fields('pay_sum_adv_num'));
			$reportpayment->pay_sum_adv_count->setDbValue($rs->fields('pay_sum_adv_count'));
			$reportpayment->pay_sum_detail->setDbValue($rs->fields('pay_sum_detail'));
			$reportpayment->pay_sum_total->setDbValue($rs->fields('pay_sum_total'));
			$reportpayment->pay_sum_note->setDbValue($rs->fields('pay_sum_note'));
			$reportpayment->flag->setDbValue($rs->fields('flag'));
			$reportpayment->pay_sum_date->setDbValue($rs->fields('pay_sum_date'));
			$this->Val[1] = $reportpayment->pay_sum_id->CurrentValue;
			$this->Val[2] = $reportpayment->member_code->CurrentValue;
			$this->Val[3] = $reportpayment->fname->CurrentValue;
			$this->Val[4] = $reportpayment->lname->CurrentValue;
			$this->Val[5] = $reportpayment->pt_title->CurrentValue;
			$this->Val[6] = $reportpayment->pay_death_begin->CurrentValue;
			$this->Val[7] = $reportpayment->pay_annual_year->CurrentValue;
			$this->Val[8] = $reportpayment->pay_sum_adv_num->CurrentValue;
			$this->Val[9] = $reportpayment->pay_sum_detail->CurrentValue;
			$this->Val[10] = $reportpayment->pay_sum_total->CurrentValue;
			$this->Val[11] = $reportpayment->pay_sum_note->CurrentValue;
			$this->Val[12] = $reportpayment->pay_sum_date->CurrentValue;
		} else {
			$reportpayment->t_code->setDbValue("");
			$reportpayment->t_title->setDbValue("");
			$reportpayment->v_code->setDbValue("");
			$reportpayment->v_title->setDbValue("");
			$reportpayment->pay_sum_id->setDbValue("");
			$reportpayment->village_id->setDbValue("");
			$reportpayment->member_code->setDbValue("");
			$reportpayment->fname->setDbValue("");
			$reportpayment->lname->setDbValue("");
			$reportpayment->pt_title->setDbValue("");
			$reportpayment->pay_sum_type->setDbValue("");
			$reportpayment->pay_death_begin->setDbValue("");
			$reportpayment->pay_death_end->setDbValue("");
			$reportpayment->pay_annual_year->setDbValue("");
			$reportpayment->pay_sum_adv_num->setDbValue("");
			$reportpayment->pay_sum_adv_count->setDbValue("");
			$reportpayment->pay_sum_detail->setDbValue("");
			$reportpayment->pay_sum_total->setDbValue("");
			$reportpayment->pay_sum_note->setDbValue("");
			$reportpayment->flag->setDbValue("");
			$reportpayment->pay_sum_date->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $reportpayment;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$reportpayment->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$reportpayment->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $reportpayment->getStartGroup();
			}
		} else {
			$this->StartGrp = $reportpayment->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$reportpayment->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$reportpayment->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$reportpayment->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $reportpayment;

		// Initialize popup
		// Build distinct values for t_title

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportpayment->t_title->SqlSelect, $reportpayment->SqlWhere(), $reportpayment->SqlGroupBy(), $reportpayment->SqlHaving(), $reportpayment->t_title->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportpayment->t_title->setDbValue($rswrk->fields[0]);
			if (is_null($reportpayment->t_title->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportpayment->t_title->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportpayment->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportpayment->t_title,$reportpayment->t_title->GroupValue());
				ewrpt_SetupDistinctValues($reportpayment->t_title->ValueList, $reportpayment->t_title->GroupValue(), $reportpayment->t_title->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportpayment->t_title->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportpayment->t_title->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for v_code
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportpayment->v_code->SqlSelect, $reportpayment->SqlWhere(), $reportpayment->SqlGroupBy(), $reportpayment->SqlHaving(), $reportpayment->v_code->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportpayment->v_code->setDbValue($rswrk->fields[0]);
			if (is_null($reportpayment->v_code->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportpayment->v_code->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportpayment->v_code->GroupViewValue = ewrpt_DisplayGroupValue($reportpayment->v_code,$reportpayment->v_code->GroupValue());
				ewrpt_SetupDistinctValues($reportpayment->v_code->ValueList, $reportpayment->v_code->GroupValue(), $reportpayment->v_code->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportpayment->v_code->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportpayment->v_code->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for v_title
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportpayment->v_title->SqlSelect, $reportpayment->SqlWhere(), $reportpayment->SqlGroupBy(), $reportpayment->SqlHaving(), $reportpayment->v_title->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportpayment->v_title->setDbValue($rswrk->fields[0]);
			if (is_null($reportpayment->v_title->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportpayment->v_title->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportpayment->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportpayment->v_title,$reportpayment->v_title->GroupValue());
				ewrpt_SetupDistinctValues($reportpayment->v_title->ValueList, $reportpayment->v_title->GroupValue(), $reportpayment->v_title->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportpayment->v_title->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportpayment->v_title->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for pay_death_begin
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportpayment->pay_death_begin->SqlSelect, $reportpayment->SqlWhere(), $reportpayment->SqlGroupBy(), $reportpayment->SqlHaving(), $reportpayment->pay_death_begin->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportpayment->pay_death_begin->setDbValue($rswrk->fields[0]);
			if (is_null($reportpayment->pay_death_begin->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportpayment->pay_death_begin->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportpayment->pay_death_begin->ViewValue = $reportpayment->pay_death_begin->CurrentValue;
				ewrpt_SetupDistinctValues($reportpayment->pay_death_begin->ValueList, $reportpayment->pay_death_begin->CurrentValue, $reportpayment->pay_death_begin->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportpayment->pay_death_begin->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportpayment->pay_death_begin->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for pay_annual_year
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportpayment->pay_annual_year->SqlSelect, $reportpayment->SqlWhere(), $reportpayment->SqlGroupBy(), $reportpayment->SqlHaving(), $reportpayment->pay_annual_year->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportpayment->pay_annual_year->setDbValue($rswrk->fields[0]);
			if (is_null($reportpayment->pay_annual_year->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportpayment->pay_annual_year->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportpayment->pay_annual_year->ViewValue = $reportpayment->pay_annual_year->CurrentValue;
				ewrpt_SetupDistinctValues($reportpayment->pay_annual_year->ValueList, $reportpayment->pay_annual_year->CurrentValue, $reportpayment->pay_annual_year->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportpayment->pay_annual_year->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportpayment->pay_annual_year->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for pay_sum_adv_num
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportpayment->pay_sum_adv_num->SqlSelect, $reportpayment->SqlWhere(), $reportpayment->SqlGroupBy(), $reportpayment->SqlHaving(), $reportpayment->pay_sum_adv_num->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportpayment->pay_sum_adv_num->setDbValue($rswrk->fields[0]);
			if (is_null($reportpayment->pay_sum_adv_num->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportpayment->pay_sum_adv_num->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportpayment->pay_sum_adv_num->ViewValue = $reportpayment->pay_sum_adv_num->CurrentValue;
				ewrpt_SetupDistinctValues($reportpayment->pay_sum_adv_num->ValueList, $reportpayment->pay_sum_adv_num->CurrentValue, $reportpayment->pay_sum_adv_num->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportpayment->pay_sum_adv_num->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportpayment->pay_sum_adv_num->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for pay_sum_date
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportpayment->pay_sum_date->SqlSelect, $reportpayment->SqlWhere(), $reportpayment->SqlGroupBy(), $reportpayment->SqlHaving(), $reportpayment->pay_sum_date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportpayment->pay_sum_date->setDbValue($rswrk->fields[0]);
			if (is_null($reportpayment->pay_sum_date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportpayment->pay_sum_date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportpayment->pay_sum_date->ViewValue = ewrpt_FormatDateTime($reportpayment->pay_sum_date->CurrentValue, 7);
				ewrpt_SetupDistinctValues($reportpayment->pay_sum_date->ValueList, $reportpayment->pay_sum_date->CurrentValue, $reportpayment->pay_sum_date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportpayment->pay_sum_date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportpayment->pay_sum_date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('v_code');
				$this->ClearSessionSelection('v_title');
				$this->ClearSessionSelection('pay_death_begin');
				$this->ClearSessionSelection('pay_annual_year');
				$this->ClearSessionSelection('pay_sum_adv_num');
				$this->ClearSessionSelection('pay_sum_date');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get µÓºÅ selected values

		if (is_array(@$_SESSION["sel_reportpayment_t_title"])) {
			$this->LoadSelectionFromSession('t_title');
		} elseif (@$_SESSION["sel_reportpayment_t_title"] == EWRPT_INIT_VALUE) { // Select all
			$reportpayment->t_title->SelectionList = "";
		}

		// Get ËÁÙè·Õè selected values
		if (is_array(@$_SESSION["sel_reportpayment_v_code"])) {
			$this->LoadSelectionFromSession('v_code');
		} elseif (@$_SESSION["sel_reportpayment_v_code"] == EWRPT_INIT_VALUE) { // Select all
			$reportpayment->v_code->SelectionList = "";
		}

		// Get ËÁÙèºéÒ¹ selected values
		if (is_array(@$_SESSION["sel_reportpayment_v_title"])) {
			$this->LoadSelectionFromSession('v_title');
		} elseif (@$_SESSION["sel_reportpayment_v_title"] == EWRPT_INIT_VALUE) { // Select all
			$reportpayment->v_title->SelectionList = "";
		}

		// Get È¾·Õè selected values
		if (is_array(@$_SESSION["sel_reportpayment_pay_death_begin"])) {
			$this->LoadSelectionFromSession('pay_death_begin');
		} elseif (@$_SESSION["sel_reportpayment_pay_death_begin"] == EWRPT_INIT_VALUE) { // Select all
			$reportpayment->pay_death_begin->SelectionList = "";
		}

		// Get »Õ ¾.È. selected values
		if (is_array(@$_SESSION["sel_reportpayment_pay_annual_year"])) {
			$this->LoadSelectionFromSession('pay_annual_year');
		} elseif (@$_SESSION["sel_reportpayment_pay_annual_year"] == EWRPT_INIT_VALUE) { // Select all
			$reportpayment->pay_annual_year->SelectionList = "";
		}

		// Get §Ç´·Õè selected values
		if (is_array(@$_SESSION["sel_reportpayment_pay_sum_adv_num"])) {
			$this->LoadSelectionFromSession('pay_sum_adv_num');
		} elseif (@$_SESSION["sel_reportpayment_pay_sum_adv_num"] == EWRPT_INIT_VALUE) { // Select all
			$reportpayment->pay_sum_adv_num->SelectionList = "";
		}

		// Get pay sum date selected values
		if (is_array(@$_SESSION["sel_reportpayment_pay_sum_date"])) {
			$this->LoadSelectionFromSession('pay_sum_date');
		} elseif (@$_SESSION["sel_reportpayment_pay_sum_date"] == EWRPT_INIT_VALUE) { // Select all
			$reportpayment->pay_sum_date->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $reportpayment;
		$this->StartGrp = 1;
		$reportpayment->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $reportpayment;
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
			$reportpayment->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$reportpayment->setStartGroup($this->StartGrp);
		} else {
			if ($reportpayment->getGroupPerPage() <> "") {
				$this->DisplayGrps = $reportpayment->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $reportpayment;
		if ($reportpayment->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($reportpayment->SqlSelectCount(), $reportpayment->SqlWhere(), $reportpayment->SqlGroupBy(), $reportpayment->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}

			// Get total from sql directly
			$sSql = ewrpt_BuildReportSql($reportpayment->SqlSelectAgg(), $reportpayment->SqlWhere(), $reportpayment->SqlGroupBy(), $reportpayment->SqlHaving(), "", $this->Filter, "");
			$sSql = $reportpayment->SqlAggPfx() . $sSql . $reportpayment->SqlAggSfx();
			$rsagg = $conn->Execute($sSql);
			if ($rsagg) {
				$this->GrandSmry[10] = $rsagg->fields("sum_pay_sum_total");
				$rsagg->Close();
			} else {

				// Accumulate grand summary from detail records
				$sSql = ewrpt_BuildReportSql($reportpayment->SqlSelect(), $reportpayment->SqlWhere(), $reportpayment->SqlGroupBy(), $reportpayment->SqlHaving(), "", $this->Filter, "");
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
		$reportpayment->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($reportpayment->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// t_title
			$reportpayment->t_title->GroupViewValue = $reportpayment->t_title->GroupOldValue();
			$reportpayment->t_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->t_title->CellAttrs["class"] = ($reportpayment->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$reportpayment->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportpayment->t_title, $reportpayment->t_title->GroupViewValue);

			// t_code
			$reportpayment->t_code->GroupViewValue = $reportpayment->t_code->GroupOldValue();
			$reportpayment->t_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->t_code->CellAttrs["class"] = ($reportpayment->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";
			$reportpayment->t_code->GroupViewValue = ewrpt_DisplayGroupValue($reportpayment->t_code, $reportpayment->t_code->GroupViewValue);

			// v_code
			$reportpayment->v_code->GroupViewValue = $reportpayment->v_code->GroupOldValue();
			$reportpayment->v_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->v_code->CellAttrs["class"] = ($reportpayment->RowGroupLevel == 3) ? "ewRptGrpSummary3" : "ewRptGrpField3";
			$reportpayment->v_code->GroupViewValue = ewrpt_DisplayGroupValue($reportpayment->v_code, $reportpayment->v_code->GroupViewValue);

			// v_title
			$reportpayment->v_title->GroupViewValue = $reportpayment->v_title->GroupOldValue();
			$reportpayment->v_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->v_title->CellAttrs["class"] = ($reportpayment->RowGroupLevel == 4) ? "ewRptGrpSummary4" : "ewRptGrpField4";
			$reportpayment->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportpayment->v_title, $reportpayment->v_title->GroupViewValue);

			// pay_sum_id
			$reportpayment->pay_sum_id->ViewValue = $reportpayment->pay_sum_id->Summary;
			$reportpayment->pay_sum_id->CellAttrs["style"] = "white-space: nowrap;";

			// member_code
			$reportpayment->member_code->ViewValue = $reportpayment->member_code->Summary;
			$reportpayment->member_code->CellAttrs["style"] = "white-space: nowrap;";

			// fname
			$reportpayment->fname->ViewValue = $reportpayment->fname->Summary;
			$reportpayment->fname->CellAttrs["style"] = "white-space: nowrap;";

			// lname
			$reportpayment->lname->ViewValue = $reportpayment->lname->Summary;
			$reportpayment->lname->CellAttrs["style"] = "white-space: nowrap;";

			// pt_title
			$reportpayment->pt_title->ViewValue = $reportpayment->pt_title->Summary;
			$reportpayment->pt_title->CellAttrs["style"] = "white-space: nowrap;";

			// pay_death_begin
			$reportpayment->pay_death_begin->ViewValue = $reportpayment->pay_death_begin->Summary;
			$reportpayment->pay_death_begin->CellAttrs["style"] = "white-space: nowrap;";

			// pay_annual_year
			$reportpayment->pay_annual_year->ViewValue = $reportpayment->pay_annual_year->Summary;
			$reportpayment->pay_annual_year->CellAttrs["style"] = "white-space: nowrap;";

			// pay_sum_adv_num
			$reportpayment->pay_sum_adv_num->ViewValue = $reportpayment->pay_sum_adv_num->Summary;
			$reportpayment->pay_sum_adv_num->CellAttrs["style"] = "white-space: nowrap;";

			// pay_sum_detail
			$reportpayment->pay_sum_detail->ViewValue = $reportpayment->pay_sum_detail->Summary;
			$reportpayment->pay_sum_detail->CellAttrs["style"] = "white-space: nowrap;";

			// pay_sum_total
			$reportpayment->pay_sum_total->ViewValue = $reportpayment->pay_sum_total->Summary;
			$reportpayment->pay_sum_total->ViewValue = ewrpt_FormatCurrency($reportpayment->pay_sum_total->ViewValue, 0, 0, -1, -1);
			$reportpayment->pay_sum_total->CellAttrs["style"] = "white-space: nowrap;";

			// pay_sum_note
			$reportpayment->pay_sum_note->ViewValue = $reportpayment->pay_sum_note->Summary;
			$reportpayment->pay_sum_note->CellAttrs["style"] = "white-space: nowrap;";

			// pay_sum_date
			$reportpayment->pay_sum_date->ViewValue = $reportpayment->pay_sum_date->Summary;
			$reportpayment->pay_sum_date->ViewValue = ewrpt_FormatDateTime($reportpayment->pay_sum_date->ViewValue, 7);
			$reportpayment->pay_sum_date->CellAttrs["style"] = "white-space: nowrap;";
		} else {

			// t_title
			$reportpayment->t_title->GroupViewValue = $reportpayment->t_title->GroupValue();
			$reportpayment->t_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->t_title->CellAttrs["class"] = "ewRptGrpField1";
			$reportpayment->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportpayment->t_title, $reportpayment->t_title->GroupViewValue);
			if ($reportpayment->t_title->GroupValue() == $reportpayment->t_title->GroupOldValue() && !$this->ChkLvlBreak(1))
				$reportpayment->t_title->GroupViewValue = "&nbsp;";

			// t_code
			$reportpayment->t_code->GroupViewValue = $reportpayment->t_code->GroupValue();
			$reportpayment->t_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->t_code->CellAttrs["class"] = "ewRptGrpField2";
			$reportpayment->t_code->GroupViewValue = ewrpt_DisplayGroupValue($reportpayment->t_code, $reportpayment->t_code->GroupViewValue);
			if ($reportpayment->t_code->GroupValue() == $reportpayment->t_code->GroupOldValue() && !$this->ChkLvlBreak(2))
				$reportpayment->t_code->GroupViewValue = "&nbsp;";

			// v_code
			$reportpayment->v_code->GroupViewValue = $reportpayment->v_code->GroupValue();
			$reportpayment->v_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->v_code->CellAttrs["class"] = "ewRptGrpField3";
			$reportpayment->v_code->GroupViewValue = ewrpt_DisplayGroupValue($reportpayment->v_code, $reportpayment->v_code->GroupViewValue);
			if ($reportpayment->v_code->GroupValue() == $reportpayment->v_code->GroupOldValue() && !$this->ChkLvlBreak(3))
				$reportpayment->v_code->GroupViewValue = "&nbsp;";

			// v_title
			$reportpayment->v_title->GroupViewValue = $reportpayment->v_title->GroupValue();
			$reportpayment->v_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->v_title->CellAttrs["class"] = "ewRptGrpField4";
			$reportpayment->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportpayment->v_title, $reportpayment->v_title->GroupViewValue);
			if ($reportpayment->v_title->GroupValue() == $reportpayment->v_title->GroupOldValue() && !$this->ChkLvlBreak(4))
				$reportpayment->v_title->GroupViewValue = "&nbsp;";

			// pay_sum_id
			$reportpayment->pay_sum_id->ViewValue = $reportpayment->pay_sum_id->CurrentValue;
			$reportpayment->pay_sum_id->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->pay_sum_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_code
			$reportpayment->member_code->ViewValue = $reportpayment->member_code->CurrentValue;
			$reportpayment->member_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->member_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$reportpayment->fname->ViewValue = $reportpayment->fname->CurrentValue;
			$reportpayment->fname->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$reportpayment->lname->ViewValue = $reportpayment->lname->CurrentValue;
			$reportpayment->lname->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pt_title
			$reportpayment->pt_title->ViewValue = $reportpayment->pt_title->CurrentValue;
			$reportpayment->pt_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->pt_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_death_begin
			$reportpayment->pay_death_begin->ViewValue = $reportpayment->pay_death_begin->CurrentValue;
			$reportpayment->pay_death_begin->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->pay_death_begin->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_annual_year
			$reportpayment->pay_annual_year->ViewValue = $reportpayment->pay_annual_year->CurrentValue;
			$reportpayment->pay_annual_year->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->pay_annual_year->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_adv_num
			$reportpayment->pay_sum_adv_num->ViewValue = $reportpayment->pay_sum_adv_num->CurrentValue;
			$reportpayment->pay_sum_adv_num->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->pay_sum_adv_num->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_detail
			$reportpayment->pay_sum_detail->ViewValue = $reportpayment->pay_sum_detail->CurrentValue;
			$reportpayment->pay_sum_detail->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->pay_sum_detail->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_total
			$reportpayment->pay_sum_total->ViewValue = $reportpayment->pay_sum_total->CurrentValue;
			$reportpayment->pay_sum_total->ViewValue = ewrpt_FormatCurrency($reportpayment->pay_sum_total->ViewValue, 0, 0, -1, -1);
			$reportpayment->pay_sum_total->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->pay_sum_total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_note
			$reportpayment->pay_sum_note->ViewValue = $reportpayment->pay_sum_note->CurrentValue;
			$reportpayment->pay_sum_note->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->pay_sum_note->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_date
			$reportpayment->pay_sum_date->ViewValue = $reportpayment->pay_sum_date->CurrentValue;
			$reportpayment->pay_sum_date->ViewValue = ewrpt_FormatDateTime($reportpayment->pay_sum_date->ViewValue, 7);
			$reportpayment->pay_sum_date->CellAttrs["style"] = "white-space: nowrap;";
			$reportpayment->pay_sum_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// t_title
		$reportpayment->t_title->HrefValue = "";

		// t_code
		$reportpayment->t_code->HrefValue = "";

		// v_code
		$reportpayment->v_code->HrefValue = "";

		// v_title
		$reportpayment->v_title->HrefValue = "";

		// pay_sum_id
		$reportpayment->pay_sum_id->HrefValue = "";

		// member_code
		$reportpayment->member_code->HrefValue = "";

		// fname
		$reportpayment->fname->HrefValue = "";

		// lname
		$reportpayment->lname->HrefValue = "";

		// pt_title
		$reportpayment->pt_title->HrefValue = "";

		// pay_death_begin
		$reportpayment->pay_death_begin->HrefValue = "";

		// pay_annual_year
		$reportpayment->pay_annual_year->HrefValue = "";

		// pay_sum_adv_num
		$reportpayment->pay_sum_adv_num->HrefValue = "";

		// pay_sum_detail
		$reportpayment->pay_sum_detail->HrefValue = "";

		// pay_sum_total
		$reportpayment->pay_sum_total->HrefValue = "";

		// pay_sum_note
		$reportpayment->pay_sum_note->HrefValue = "";

		// pay_sum_date
		$reportpayment->pay_sum_date->HrefValue = "";

		// Call Row_Rendered event
		$reportpayment->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $reportpayment;

		// Field pt_title
		$sSelect = "SELECT DISTINCT paymenttype.pt_title FROM " . $reportpayment->SqlFrom();
		$sOrderBy = "paymenttype.pt_title ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $reportpayment->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$reportpayment->pt_title->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $reportpayment;
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
			// Field pt_title

			$this->SetSessionDropDownValue($reportpayment->pt_title->DropDownValue, 'pt_title');
			$bSetupFilter = TRUE;
		} else {

			// Field pt_title
			if ($this->GetDropDownValue($reportpayment->pt_title->DropDownValue, 'pt_title')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($reportpayment->pt_title->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_reportpayment->pt_title'])) {
				$bSetupFilter = TRUE;
			}
			if (!$this->ValidateForm()) {
				$this->setMessage($gsFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {

			// Field pt_title
			$this->GetSessionDropDownValue($reportpayment->pt_title);
		}

		// Call page filter validated event
		$reportpayment->Page_FilterValidated();

		// Build SQL
		// Field pt_title

		$this->BuildDropDownFilter($reportpayment->pt_title, $sFilter, "");

		// Save parms to session
		// Field pt_title

		$this->SetSessionDropDownValue($reportpayment->pt_title->DropDownValue, 'pt_title');

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
		$this->GetSessionValue($fld->DropDownValue, 'sv_reportpayment_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_reportpayment_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_reportpayment_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_reportpayment_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_reportpayment_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_reportpayment_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_reportpayment_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_reportpayment_' . $parm] = $sv1;
		$_SESSION['so1_reportpayment_' . $parm] = $so1;
		$_SESSION['sc_reportpayment_' . $parm] = $sc;
		$_SESSION['sv2_reportpayment_' . $parm] = $sv2;
		$_SESSION['so2_reportpayment_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $reportpayment;

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
		$_SESSION["sel_reportpayment_$parm"] = "";
		$_SESSION["rf_reportpayment_$parm"] = "";
		$_SESSION["rt_reportpayment_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $reportpayment;
		$fld =& $reportpayment->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_reportpayment_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_reportpayment_$parm"];
		$fld->RangeTo = @$_SESSION["rt_reportpayment_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $reportpayment;

		/**
		* Set up default values for non Text filters
		*/

		// Field pt_title
		$reportpayment->pt_title->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$reportpayment->pt_title->DropDownValue = $reportpayment->pt_title->DefaultDropDownValue;

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

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/

		// Field t_title
		// Setup your default values for the popup filter below, e.g.
		// $reportpayment->t_title->DefaultSelectionList = array("val1", "val2");

		$reportpayment->t_title->DefaultSelectionList = "";
		$reportpayment->t_title->SelectionList = $reportpayment->t_title->DefaultSelectionList;

		// Field v_code
		// Setup your default values for the popup filter below, e.g.
		// $reportpayment->v_code->DefaultSelectionList = array("val1", "val2");

		$reportpayment->v_code->DefaultSelectionList = "";
		$reportpayment->v_code->SelectionList = $reportpayment->v_code->DefaultSelectionList;

		// Field v_title
		// Setup your default values for the popup filter below, e.g.
		// $reportpayment->v_title->DefaultSelectionList = array("val1", "val2");

		$reportpayment->v_title->DefaultSelectionList = "";
		$reportpayment->v_title->SelectionList = $reportpayment->v_title->DefaultSelectionList;

		// Field pay_death_begin
		// Setup your default values for the popup filter below, e.g.
		// $reportpayment->pay_death_begin->DefaultSelectionList = array("val1", "val2");

		$reportpayment->pay_death_begin->DefaultSelectionList = "";
		$reportpayment->pay_death_begin->SelectionList = $reportpayment->pay_death_begin->DefaultSelectionList;

		// Field pay_death_end
		// Setup your default values for the popup filter below, e.g.
		// $reportpayment->pay_death_end->DefaultSelectionList = array("val1", "val2");

		$reportpayment->pay_death_end->DefaultSelectionList = "";
		$reportpayment->pay_death_end->SelectionList = $reportpayment->pay_death_end->DefaultSelectionList;

		// Field pay_annual_year
		// Setup your default values for the popup filter below, e.g.
		// $reportpayment->pay_annual_year->DefaultSelectionList = array("val1", "val2");

		$reportpayment->pay_annual_year->DefaultSelectionList = "";
		$reportpayment->pay_annual_year->SelectionList = $reportpayment->pay_annual_year->DefaultSelectionList;

		// Field pay_sum_adv_num
		// Setup your default values for the popup filter below, e.g.
		// $reportpayment->pay_sum_adv_num->DefaultSelectionList = array("val1", "val2");

		$reportpayment->pay_sum_adv_num->DefaultSelectionList = "";
		$reportpayment->pay_sum_adv_num->SelectionList = $reportpayment->pay_sum_adv_num->DefaultSelectionList;

		// Field pay_sum_date
		// Setup your default values for the popup filter below, e.g.
		// $reportpayment->pay_sum_date->DefaultSelectionList = array("val1", "val2");

		$reportpayment->pay_sum_date->DefaultSelectionList = "";
		$reportpayment->pay_sum_date->SelectionList = $reportpayment->pay_sum_date->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $reportpayment;

		// Check t_title popup filter
		if (!ewrpt_MatchedArray($reportpayment->t_title->DefaultSelectionList, $reportpayment->t_title->SelectionList))
			return TRUE;

		// Check v_code popup filter
		if (!ewrpt_MatchedArray($reportpayment->v_code->DefaultSelectionList, $reportpayment->v_code->SelectionList))
			return TRUE;

		// Check v_title popup filter
		if (!ewrpt_MatchedArray($reportpayment->v_title->DefaultSelectionList, $reportpayment->v_title->SelectionList))
			return TRUE;

		// Check pt_title extended filter
		if ($this->NonTextFilterApplied($reportpayment->pt_title))
			return TRUE;

		// Check pay_death_begin popup filter
		if (!ewrpt_MatchedArray($reportpayment->pay_death_begin->DefaultSelectionList, $reportpayment->pay_death_begin->SelectionList))
			return TRUE;

		// Check pay_death_end popup filter
		if (!ewrpt_MatchedArray($reportpayment->pay_death_end->DefaultSelectionList, $reportpayment->pay_death_end->SelectionList))
			return TRUE;

		// Check pay_annual_year popup filter
		if (!ewrpt_MatchedArray($reportpayment->pay_annual_year->DefaultSelectionList, $reportpayment->pay_annual_year->SelectionList))
			return TRUE;

		// Check pay_sum_adv_num popup filter
		if (!ewrpt_MatchedArray($reportpayment->pay_sum_adv_num->DefaultSelectionList, $reportpayment->pay_sum_adv_num->SelectionList))
			return TRUE;

		// Check pay_sum_date popup filter
		if (!ewrpt_MatchedArray($reportpayment->pay_sum_date->DefaultSelectionList, $reportpayment->pay_sum_date->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $reportpayment;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field t_title
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportpayment->t_title->SelectionList))
			$sWrk = ewrpt_JoinArray($reportpayment->t_title->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpayment->t_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field v_code
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportpayment->v_code->SelectionList))
			$sWrk = ewrpt_JoinArray($reportpayment->v_code->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpayment->v_code->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field v_title
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportpayment->v_title->SelectionList))
			$sWrk = ewrpt_JoinArray($reportpayment->v_title->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpayment->v_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field pt_title
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($reportpayment->pt_title, $sExtWrk, "");
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpayment->pt_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field pay_death_begin
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportpayment->pay_death_begin->SelectionList))
			$sWrk = ewrpt_JoinArray($reportpayment->pay_death_begin->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpayment->pay_death_begin->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field pay_death_end
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportpayment->pay_death_end->SelectionList))
			$sWrk = ewrpt_JoinArray($reportpayment->pay_death_end->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpayment->pay_death_end->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field pay_annual_year
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportpayment->pay_annual_year->SelectionList))
			$sWrk = ewrpt_JoinArray($reportpayment->pay_annual_year->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpayment->pay_annual_year->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field pay_sum_adv_num
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportpayment->pay_sum_adv_num->SelectionList))
			$sWrk = ewrpt_JoinArray($reportpayment->pay_sum_adv_num->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpayment->pay_sum_adv_num->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field pay_sum_date
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportpayment->pay_sum_date->SelectionList))
			$sWrk = ewrpt_JoinArray($reportpayment->pay_sum_date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpayment->pay_sum_date->FldCaption() . "<br />";
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
		global $reportpayment;
		$sWrk = "";
			if (is_array($reportpayment->t_title->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportpayment->t_title, "tambon.t_title", EWRPT_DATATYPE_STRING);
			}
			if (is_array($reportpayment->v_code->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportpayment->v_code, "village.v_code", EWRPT_DATATYPE_NUMBER);
			}
			if (is_array($reportpayment->v_title->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportpayment->v_title, "village.v_title", EWRPT_DATATYPE_STRING);
			}
			if (is_array($reportpayment->pay_death_begin->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportpayment->pay_death_begin, "`pay_death_begin`", EWRPT_DATATYPE_NUMBER);
			}
			if (is_array($reportpayment->pay_death_end->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportpayment->pay_death_end, "`pay_death_end`", EWRPT_DATATYPE_NUMBER);
			}
			if (is_array($reportpayment->pay_annual_year->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportpayment->pay_annual_year, "`pay_annual_year`", EWRPT_DATATYPE_STRING);
			}
			if (is_array($reportpayment->pay_sum_adv_num->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportpayment->pay_sum_adv_num, "`pay_sum_adv_num`", EWRPT_DATATYPE_NUMBER);
			}
			if (is_array($reportpayment->pay_sum_date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportpayment->pay_sum_date, "`pay_sum_date`", EWRPT_DATATYPE_DATE);
			}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $reportpayment;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$reportpayment->setOrderBy("");
				$reportpayment->setStartGroup(1);
				$reportpayment->t_title->setSort("");
				$reportpayment->t_code->setSort("");
				$reportpayment->v_code->setSort("");
				$reportpayment->v_title->setSort("");
				$reportpayment->pay_sum_id->setSort("");
				$reportpayment->member_code->setSort("");
				$reportpayment->fname->setSort("");
				$reportpayment->lname->setSort("");
				$reportpayment->pt_title->setSort("");
				$reportpayment->pay_death_begin->setSort("");
				$reportpayment->pay_annual_year->setSort("");
				$reportpayment->pay_sum_adv_num->setSort("");
				$reportpayment->pay_sum_detail->setSort("");
				$reportpayment->pay_sum_total->setSort("");
				$reportpayment->pay_sum_note->setSort("");
				$reportpayment->pay_sum_date->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$reportpayment->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$reportpayment->CurrentOrderType = @$_GET["ordertype"];
			$reportpayment->UpdateSort($reportpayment->t_title); // t_title
			$reportpayment->UpdateSort($reportpayment->t_code); // t_code
			$reportpayment->UpdateSort($reportpayment->v_code); // v_code
			$reportpayment->UpdateSort($reportpayment->v_title); // v_title
			$reportpayment->UpdateSort($reportpayment->pay_sum_id); // pay_sum_id
			$reportpayment->UpdateSort($reportpayment->member_code); // member_code
			$reportpayment->UpdateSort($reportpayment->fname); // fname
			$reportpayment->UpdateSort($reportpayment->lname); // lname
			$reportpayment->UpdateSort($reportpayment->pt_title); // pt_title
			$reportpayment->UpdateSort($reportpayment->pay_death_begin); // pay_death_begin
			$reportpayment->UpdateSort($reportpayment->pay_annual_year); // pay_annual_year
			$reportpayment->UpdateSort($reportpayment->pay_sum_adv_num); // pay_sum_adv_num
			$reportpayment->UpdateSort($reportpayment->pay_sum_detail); // pay_sum_detail
			$reportpayment->UpdateSort($reportpayment->pay_sum_total); // pay_sum_total
			$reportpayment->UpdateSort($reportpayment->pay_sum_note); // pay_sum_note
			$reportpayment->UpdateSort($reportpayment->pay_sum_date); // pay_sum_date
			$sSortSql = $reportpayment->SortSql();
			$reportpayment->setOrderBy($sSortSql);
			$reportpayment->setStartGroup(1);
		}
		return $reportpayment->getOrderBy();
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
