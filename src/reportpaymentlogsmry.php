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
$reportpaymentlog = NULL;

//
// Table class for reportpaymentlog
//
class crreportpaymentlog {
	var $TableVar = 'reportpaymentlog';
	var $TableName = 'reportpaymentlog';
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
	var $pay_date;
	var $t_title;
	var $v_title;
	var $pt_title;
	var $pay_type;
	var $t_code;
	var $village_id;
	var $pay_detail;
	var $count_member;
	var $pay_rate;
	var $sub_total;
	var $assc_rate;
	var $assc_total;
	var $grand_total;
	var $pay_note;
	var $pml_slipt_num;
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
	function crreportpaymentlog() {
		global $ReportLanguage;

		// pay_date
		$this->pay_date = new crField('reportpaymentlog', 'reportpaymentlog', 'x_pay_date', 'pay_date', 'paymentlog.pay_date', 133, EWRPT_DATATYPE_DATE, 7);
		$this->pay_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['pay_date'] =& $this->pay_date;
		$this->pay_date->DateFilter = "";
		$this->pay_date->SqlSelect = "SELECT DISTINCT paymentlog.pay_date FROM " . $this->SqlFrom();
		$this->pay_date->SqlOrderBy = "paymentlog.pay_date";
		$this->pay_date->FldGroupByType = "";
		$this->pay_date->FldGroupInt = "0";
		$this->pay_date->FldGroupSql = "";

		// t_title
		$this->t_title = new crField('reportpaymentlog', 'reportpaymentlog', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->t_title->GroupingFieldId = 1;
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "";
		$this->t_title->SqlOrderBy = "";
		$this->t_title->FldGroupByType = "";
		$this->t_title->FldGroupInt = "0";
		$this->t_title->FldGroupSql = "";

		// v_title
		$this->v_title = new crField('reportpaymentlog', 'reportpaymentlog', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->v_title->GroupingFieldId = 2;
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "";
		$this->v_title->SqlOrderBy = "";
		$this->v_title->FldGroupByType = "";
		$this->v_title->FldGroupInt = "0";
		$this->v_title->FldGroupSql = "";

		// pt_title
		$this->pt_title = new crField('reportpaymentlog', 'reportpaymentlog', 'x_pt_title', 'pt_title', 'paymenttype.pt_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->pt_title->GroupingFieldId = 3;
		$this->fields['pt_title'] =& $this->pt_title;
		$this->pt_title->DateFilter = "";
		$this->pt_title->SqlSelect = "";
		$this->pt_title->SqlOrderBy = "";
		$this->pt_title->FldGroupByType = "";
		$this->pt_title->FldGroupInt = "0";
		$this->pt_title->FldGroupSql = "";

		// pay_type
		$this->pay_type = new crField('reportpaymentlog', 'reportpaymentlog', 'x_pay_type', 'pay_type', 'paymentlog.pay_type', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_type'] =& $this->pay_type;
		$this->pay_type->DateFilter = "";
		$this->pay_type->SqlSelect = "";
		$this->pay_type->SqlOrderBy = "";
		$this->pay_type->FldGroupByType = "";
		$this->pay_type->FldGroupInt = "0";
		$this->pay_type->FldGroupSql = "";

		// t_code
		$this->t_code = new crField('reportpaymentlog', 'reportpaymentlog', 'x_t_code', 't_code', 'paymentlog.t_code', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";
		$this->t_code->FldGroupByType = "";
		$this->t_code->FldGroupInt = "0";
		$this->t_code->FldGroupSql = "";

		// village_id
		$this->village_id = new crField('reportpaymentlog', 'reportpaymentlog', 'x_village_id', 'village_id', 'paymentlog.village_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";
		$this->village_id->FldGroupByType = "";
		$this->village_id->FldGroupInt = "0";
		$this->village_id->FldGroupSql = "";

		// pay_detail
		$this->pay_detail = new crField('reportpaymentlog', 'reportpaymentlog', 'x_pay_detail', 'pay_detail', 'paymentlog.pay_detail', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['pay_detail'] =& $this->pay_detail;
		$this->pay_detail->DateFilter = "";
		$this->pay_detail->SqlSelect = "";
		$this->pay_detail->SqlOrderBy = "";
		$this->pay_detail->FldGroupByType = "";
		$this->pay_detail->FldGroupInt = "0";
		$this->pay_detail->FldGroupSql = "";

		// count_member
		$this->count_member = new crField('reportpaymentlog', 'reportpaymentlog', 'x_count_member', 'count_member', 'paymentlog.count_member', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->count_member->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['count_member'] =& $this->count_member;
		$this->count_member->DateFilter = "";
		$this->count_member->SqlSelect = "";
		$this->count_member->SqlOrderBy = "";
		$this->count_member->FldGroupByType = "";
		$this->count_member->FldGroupInt = "0";
		$this->count_member->FldGroupSql = "";

		// pay_rate
		$this->pay_rate = new crField('reportpaymentlog', 'reportpaymentlog', 'x_pay_rate', 'pay_rate', 'paymentlog.pay_rate', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_rate->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_rate'] =& $this->pay_rate;
		$this->pay_rate->DateFilter = "";
		$this->pay_rate->SqlSelect = "";
		$this->pay_rate->SqlOrderBy = "";
		$this->pay_rate->FldGroupByType = "";
		$this->pay_rate->FldGroupInt = "0";
		$this->pay_rate->FldGroupSql = "";

		// sub_total
		$this->sub_total = new crField('reportpaymentlog', 'reportpaymentlog', 'x_sub_total', 'sub_total', 'paymentlog.sub_total', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->sub_total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['sub_total'] =& $this->sub_total;
		$this->sub_total->DateFilter = "";
		$this->sub_total->SqlSelect = "";
		$this->sub_total->SqlOrderBy = "";
		$this->sub_total->FldGroupByType = "";
		$this->sub_total->FldGroupInt = "0";
		$this->sub_total->FldGroupSql = "";

		// assc_rate
		$this->assc_rate = new crField('reportpaymentlog', 'reportpaymentlog', 'x_assc_rate', 'assc_rate', 'paymentlog.assc_rate', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->assc_rate->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['assc_rate'] =& $this->assc_rate;
		$this->assc_rate->DateFilter = "";
		$this->assc_rate->SqlSelect = "";
		$this->assc_rate->SqlOrderBy = "";
		$this->assc_rate->FldGroupByType = "";
		$this->assc_rate->FldGroupInt = "0";
		$this->assc_rate->FldGroupSql = "";

		// assc_total
		$this->assc_total = new crField('reportpaymentlog', 'reportpaymentlog', 'x_assc_total', 'assc_total', 'paymentlog.assc_total', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->assc_total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['assc_total'] =& $this->assc_total;
		$this->assc_total->DateFilter = "";
		$this->assc_total->SqlSelect = "";
		$this->assc_total->SqlOrderBy = "";
		$this->assc_total->FldGroupByType = "";
		$this->assc_total->FldGroupInt = "0";
		$this->assc_total->FldGroupSql = "";

		// grand_total
		$this->grand_total = new crField('reportpaymentlog', 'reportpaymentlog', 'x_grand_total', 'grand_total', 'paymentlog.grand_total', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->grand_total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['grand_total'] =& $this->grand_total;
		$this->grand_total->DateFilter = "";
		$this->grand_total->SqlSelect = "";
		$this->grand_total->SqlOrderBy = "";
		$this->grand_total->FldGroupByType = "";
		$this->grand_total->FldGroupInt = "0";
		$this->grand_total->FldGroupSql = "";

		// pay_note
		$this->pay_note = new crField('reportpaymentlog', 'reportpaymentlog', 'x_pay_note', 'pay_note', 'paymentlog.pay_note', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['pay_note'] =& $this->pay_note;
		$this->pay_note->DateFilter = "";
		$this->pay_note->SqlSelect = "";
		$this->pay_note->SqlOrderBy = "";
		$this->pay_note->FldGroupByType = "";
		$this->pay_note->FldGroupInt = "0";
		$this->pay_note->FldGroupSql = "";

		// pml_slipt_num
		$this->pml_slipt_num = new crField('reportpaymentlog', 'reportpaymentlog', 'x_pml_slipt_num', 'pml_slipt_num', 'paymentlog.pml_slipt_num', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pml_slipt_num->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pml_slipt_num'] =& $this->pml_slipt_num;
		$this->pml_slipt_num->DateFilter = "";
		$this->pml_slipt_num->SqlSelect = "SELECT DISTINCT paymentlog.pml_slipt_num FROM " . $this->SqlFrom();
		$this->pml_slipt_num->SqlOrderBy = "paymentlog.pml_slipt_num";
		$this->pml_slipt_num->FldGroupByType = "";
		$this->pml_slipt_num->FldGroupInt = "0";
		$this->pml_slipt_num->FldGroupSql = "";
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
		return "village Inner Join paymentlog On village.village_id = paymentlog.village_id Inner Join paymenttype On paymentlog.pay_type = paymenttype.pt_id Inner Join tambon On tambon.t_code = village.t_code";
	}

	function SqlSelect() { // Select
		return "SELECT paymentlog.pay_type, paymentlog.t_code, paymentlog.village_id, paymentlog.pay_detail, paymentlog.count_member, paymentlog.pay_rate, paymentlog.sub_total, paymentlog.assc_rate, paymentlog.assc_total, paymentlog.grand_total, paymentlog.pay_note, paymentlog.pay_date, paymentlog.pml_slipt_num, paymenttype.pt_title, tambon.t_title, village.v_title FROM " . $this->SqlFrom();
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
		return "tambon.t_title ASC, village.v_title ASC, paymenttype.pt_title ASC";
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
		return "SELECT SUM(paymentlog.count_member) AS sum_count_member, SUM(paymentlog.pay_rate) AS sum_pay_rate, SUM(paymentlog.sub_total) AS sum_sub_total, SUM(paymentlog.assc_total) AS sum_assc_total, SUM(paymentlog.grand_total) AS sum_grand_total FROM " . $this->SqlFrom();
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
$reportpaymentlog_summary = new crreportpaymentlog_summary();
$Page =& $reportpaymentlog_summary;

// Page init
$reportpaymentlog_summary->Page_Init();

// Page main
$reportpaymentlog_summary->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($reportpaymentlog->Export == "") { ?>
<script type="text/javascript">

// Create page object
var reportpaymentlog_summary = new ewrpt_Page("reportpaymentlog_summary");

// page properties
reportpaymentlog_summary.PageID = "summary"; // page ID
reportpaymentlog_summary.FormID = "freportpaymentlogsummaryfilter"; // form ID
var EWRPT_PAGE_ID = reportpaymentlog_summary.PageID;

// extend page with ValidateForm function
reportpaymentlog_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_pml_slipt_num;
	if (elm && !ewrpt_CheckInteger(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($reportpaymentlog->pml_slipt_num->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
reportpaymentlog_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
reportpaymentlog_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
reportpaymentlog_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $reportpaymentlog_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $reportpaymentlog_summary->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php if ($reportpaymentlog->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($reportpaymentlog->pay_date, $reportpaymentlog->pay_date->FldType); ?>
ewrpt_CreatePopup("reportpaymentlog_pay_date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportpaymentlog->pml_slipt_num, $reportpaymentlog->pml_slipt_num->FldType); ?>
ewrpt_CreatePopup("reportpaymentlog_pml_slipt_num", [<?php echo $jsdata ?>]);
</script>
<div id="reportpaymentlog_pay_date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportpaymentlog_pml_slipt_num_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($reportpaymentlog->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<div class="ewTitle"><?php if (!$_GET["export"]) { ?><img src="images/finance55x55.png" width="40" height="40" align="absmiddle" /><?php }?><?php echo $reportpaymentlog->TableCaption() ?></div>
<?php if ($reportpaymentlog->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($reportpaymentlog->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($reportpaymentlog->Export == "") { ?>
<?php
if ($reportpaymentlog->FilterPanelOption == 2 || ($reportpaymentlog->FilterPanelOption == 3 && $reportpaymentlog_summary->FilterApplied) || $reportpaymentlog_summary->Filter == "0=101") {
	$sButtonImage = "phprptimages/collapse.gif";
	$sDivDisplay = "";
} else {
	$sButtonImage = "phprptimages/expand.png";
	$sDivDisplay = " style=\"display: none;\"";
}
?>
<a href="javascript:ewrpt_ToggleFilterPanel();" style="text-decoration: none;"><img id="ewrptToggleFilterImg" src="<?php echo $sButtonImage ?>" alt="" align="absmiddle" border="0"></a><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("Filters") ?></span><?php if ($reportpaymentlog_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="reportpaymentlogsmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>&nbsp;<a href="<?php echo $reportpaymentlog_summary->ExportExcelUrl ?>"><img src="images/bt_export_excel.png" align="absmiddle" border="0"/></a>
<div id="ewrptExtFilterPanel" <?php echo $sDivDisplay ?> class="listSearch">
<!-- Search form (begin) -->
<form name="freportpaymentlogsummaryfilter" id="freportpaymentlogsummaryfilter" action="reportpaymentlogsmry.php" class="ewForm" onsubmit="return reportpaymentlog_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportpaymentlog->t_title->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_t_title" id="sv_t_title"<?php echo ($reportpaymentlog_summary->ClearExtFilter == 'reportpaymentlog_t_title') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($reportpaymentlog->t_title->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($reportpaymentlog->t_title->CustomFilters) ? count($reportpaymentlog->t_title->CustomFilters) : 0;
$cntd = is_array($reportpaymentlog->t_title->DropDownList) ? count($reportpaymentlog->t_title->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($reportpaymentlog->t_title->CustomFilters[$i]->FldName == 't_title') {
?>
		<option value="<?php echo "@@" . $reportpaymentlog->t_title->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($reportpaymentlog->t_title->DropDownValue, "@@" . $reportpaymentlog->t_title->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $reportpaymentlog->t_title->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $reportpaymentlog->t_title->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($reportpaymentlog->t_title->DropDownValue, $reportpaymentlog->t_title->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($reportpaymentlog->t_title->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportpaymentlog->v_title->FldCaption() ?></span></td>
	<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_v_title" id="sv_v_title"<?php echo ($reportpaymentlog_summary->ClearExtFilter == 'reportpaymentlog_v_title') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($reportpaymentlog->v_title->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($reportpaymentlog->v_title->CustomFilters) ? count($reportpaymentlog->v_title->CustomFilters) : 0;
$cntd = is_array($reportpaymentlog->v_title->DropDownList) ? count($reportpaymentlog->v_title->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($reportpaymentlog->v_title->CustomFilters[$i]->FldName == 'v_title') {
?>
		<option value="<?php echo "@@" . $reportpaymentlog->v_title->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($reportpaymentlog->v_title->DropDownValue, "@@" . $reportpaymentlog->v_title->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $reportpaymentlog->v_title->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $reportpaymentlog->v_title->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($reportpaymentlog->v_title->DropDownValue, $reportpaymentlog->v_title->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($reportpaymentlog->v_title->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportpaymentlog->pt_title->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_pt_title" id="sv_pt_title"<?php echo ($reportpaymentlog_summary->ClearExtFilter == 'reportpaymentlog_pt_title') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($reportpaymentlog->pt_title->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($reportpaymentlog->pt_title->CustomFilters) ? count($reportpaymentlog->pt_title->CustomFilters) : 0;
$cntd = is_array($reportpaymentlog->pt_title->DropDownList) ? count($reportpaymentlog->pt_title->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($reportpaymentlog->pt_title->CustomFilters[$i]->FldName == 'pt_title') {
?>
		<option value="<?php echo "@@" . $reportpaymentlog->pt_title->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($reportpaymentlog->pt_title->DropDownValue, "@@" . $reportpaymentlog->pt_title->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $reportpaymentlog->pt_title->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $reportpaymentlog->pt_title->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($reportpaymentlog->pt_title->DropDownValue, $reportpaymentlog->pt_title->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($reportpaymentlog->pt_title->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportpaymentlog->pml_slipt_num->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so1_pml_slipt_num" id="so1_pml_slipt_num" value="="></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_pml_slipt_num" id="sv1_pml_slipt_num" size="30" value="<?php echo ewrpt_HtmlEncode($reportpaymentlog->pml_slipt_num->SearchValue) ?>"<?php echo ($reportpaymentlog_summary->ClearExtFilter == 'reportpaymentlog_pml_slipt_num') ? " class=\"ewInputCleared\"" : "" ?>>
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
<br />
<?php } ?>
<?php if ($reportpaymentlog->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $reportpaymentlog_summary->ShowFilterList() ?>
</div>
<?php } ?><div class="clear"></div>
<br />

<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($reportpaymentlog->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="reportpaymentlogsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportpaymentlog_summary->StartGrp, $reportpaymentlog_summary->DisplayGrps, $reportpaymentlog_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportpaymentlogsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportpaymentlogsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportpaymentlogsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportpaymentlogsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($reportpaymentlog_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportpaymentlog_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportpaymentlog_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportpaymentlog_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportpaymentlog_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportpaymentlog_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportpaymentlog_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportpaymentlog_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportpaymentlog_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportpaymentlog_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportpaymentlog->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($reportpaymentlog->ExportAll && $reportpaymentlog->Export <> "") {
	$reportpaymentlog_summary->StopGrp = $reportpaymentlog_summary->TotalGrps;
} else {
	$reportpaymentlog_summary->StopGrp = $reportpaymentlog_summary->StartGrp + $reportpaymentlog_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($reportpaymentlog_summary->StopGrp) > intval($reportpaymentlog_summary->TotalGrps))
	$reportpaymentlog_summary->StopGrp = $reportpaymentlog_summary->TotalGrps;
$reportpaymentlog_summary->RecCount = 0;

// Get first row
if ($reportpaymentlog_summary->TotalGrps > 0) {
	$reportpaymentlog_summary->GetGrpRow(1);
	$reportpaymentlog_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $reportpaymentlog_summary->GrpCount <= $reportpaymentlog_summary->DisplayGrps) || $reportpaymentlog_summary->ShowFirstHeader) {

	// Show header
	if ($reportpaymentlog_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpaymentlog->SortUrl($reportpaymentlog->t_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpaymentlog->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpaymentlog->SortUrl($reportpaymentlog->t_title) ?>',1);"><?php echo $reportpaymentlog->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpaymentlog->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpaymentlog->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpaymentlog->SortUrl($reportpaymentlog->v_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpaymentlog->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpaymentlog->SortUrl($reportpaymentlog->v_title) ?>',1);"><?php echo $reportpaymentlog->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpaymentlog->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpaymentlog->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpaymentlog->SortUrl($reportpaymentlog->pt_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpaymentlog->pt_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpaymentlog->SortUrl($reportpaymentlog->pt_title) ?>',1);"><?php echo $reportpaymentlog->pt_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpaymentlog->pt_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpaymentlog->pt_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpaymentlog->SortUrl($reportpaymentlog->pay_date) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpaymentlog->pay_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpaymentlog->SortUrl($reportpaymentlog->pay_date) ?>',1);"><?php echo $reportpaymentlog->pay_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpaymentlog->pay_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpaymentlog->pay_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportpaymentlog->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportpaymentlog_pay_date', true, '<?php echo $reportpaymentlog->pay_date->RangeFrom; ?>', '<?php echo $reportpaymentlog->pay_date->RangeTo; ?>');return false;" name="x_pay_date<?php echo $reportpaymentlog_summary->Cnt[0][0]; ?>" id="x_pay_date<?php echo $reportpaymentlog_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>

<?php if ($reportpaymentlog->SortUrl($reportpaymentlog->pay_detail) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpaymentlog->pay_detail->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpaymentlog->SortUrl($reportpaymentlog->pay_detail) ?>',1);"><?php echo $reportpaymentlog->pay_detail->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpaymentlog->pay_detail->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpaymentlog->pay_detail->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpaymentlog->SortUrl($reportpaymentlog->count_member) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpaymentlog->count_member->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpaymentlog->SortUrl($reportpaymentlog->count_member) ?>',1);"><?php echo $reportpaymentlog->count_member->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpaymentlog->count_member->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpaymentlog->count_member->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpaymentlog->SortUrl($reportpaymentlog->pay_rate) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpaymentlog->pay_rate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpaymentlog->SortUrl($reportpaymentlog->pay_rate) ?>',1);"><?php echo $reportpaymentlog->pay_rate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpaymentlog->pay_rate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpaymentlog->pay_rate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpaymentlog->SortUrl($reportpaymentlog->sub_total) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpaymentlog->sub_total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpaymentlog->SortUrl($reportpaymentlog->sub_total) ?>',1);"><?php echo $reportpaymentlog->sub_total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpaymentlog->sub_total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpaymentlog->sub_total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpaymentlog->SortUrl($reportpaymentlog->assc_rate) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpaymentlog->assc_rate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpaymentlog->SortUrl($reportpaymentlog->assc_rate) ?>',1);"><?php echo $reportpaymentlog->assc_rate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpaymentlog->assc_rate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpaymentlog->assc_rate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpaymentlog->SortUrl($reportpaymentlog->assc_total) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpaymentlog->assc_total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpaymentlog->SortUrl($reportpaymentlog->assc_total) ?>',1);"><?php echo $reportpaymentlog->assc_total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpaymentlog->assc_total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpaymentlog->assc_total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpaymentlog->SortUrl($reportpaymentlog->grand_total) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpaymentlog->grand_total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpaymentlog->SortUrl($reportpaymentlog->grand_total) ?>',1);"><?php echo $reportpaymentlog->grand_total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpaymentlog->grand_total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpaymentlog->grand_total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpaymentlog->SortUrl($reportpaymentlog->pay_note) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpaymentlog->pay_note->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpaymentlog->SortUrl($reportpaymentlog->pay_note) ?>',1);"><?php echo $reportpaymentlog->pay_note->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpaymentlog->pay_note->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpaymentlog->pay_note->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportpaymentlog->SortUrl($reportpaymentlog->pml_slipt_num) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportpaymentlog->pml_slipt_num->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportpaymentlog->SortUrl($reportpaymentlog->pml_slipt_num) ?>',1);"><?php echo $reportpaymentlog->pml_slipt_num->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportpaymentlog->pml_slipt_num->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportpaymentlog->pml_slipt_num->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportpaymentlog->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportpaymentlog_pml_slipt_num', false, '<?php echo $reportpaymentlog->pml_slipt_num->RangeFrom; ?>', '<?php echo $reportpaymentlog->pml_slipt_num->RangeTo; ?>');return false;" name="x_pml_slipt_num<?php echo $reportpaymentlog_summary->Cnt[0][0]; ?>" id="x_pml_slipt_num<?php echo $reportpaymentlog_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$reportpaymentlog_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($reportpaymentlog->t_title, $reportpaymentlog->SqlFirstGroupField(), $reportpaymentlog->t_title->GroupValue());
	if ($reportpaymentlog_summary->Filter != "")
		$sWhere = "($reportpaymentlog_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($reportpaymentlog->SqlSelect(), $reportpaymentlog->SqlWhere(), $reportpaymentlog->SqlGroupBy(), $reportpaymentlog->SqlHaving(), $reportpaymentlog->SqlOrderBy(), $sWhere, $reportpaymentlog_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$reportpaymentlog_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$reportpaymentlog_summary->RecCount++;

		// Render detail row
		$reportpaymentlog->ResetCSS();
		$reportpaymentlog->RowType = EWRPT_ROWTYPE_DETAIL;
		$reportpaymentlog_summary->RenderRow();
?>
	<tr<?php echo $reportpaymentlog->RowAttributes(); ?>>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes(); ?>><div<?php echo $reportpaymentlog->t_title->ViewAttributes(); ?>><?php echo $reportpaymentlog->t_title->GroupViewValue; ?></div></td>
		<td<?php echo $reportpaymentlog->v_title->CellAttributes(); ?>><div<?php echo $reportpaymentlog->v_title->ViewAttributes(); ?>><?php echo $reportpaymentlog->v_title->GroupViewValue; ?></div></td>
		<td<?php echo $reportpaymentlog->pt_title->CellAttributes(); ?>><div<?php echo $reportpaymentlog->pt_title->ViewAttributes(); ?>><?php echo $reportpaymentlog->pt_title->GroupViewValue; ?></div></td>
		<td<?php echo $reportpaymentlog->pay_date->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->pay_date->ViewAttributes(); ?>><?php echo $reportpaymentlog->pay_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->pay_detail->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->pay_detail->ViewAttributes(); ?>><?php echo $reportpaymentlog->pay_detail->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->count_member->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->count_member->ViewAttributes(); ?>><?php echo $reportpaymentlog->count_member->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->pay_rate->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->pay_rate->ViewAttributes(); ?>><?php echo $reportpaymentlog->pay_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->sub_total->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->sub_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->sub_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->assc_rate->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->assc_rate->ViewAttributes(); ?>><?php echo $reportpaymentlog->assc_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->assc_total->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->assc_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->assc_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->grand_total->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->grand_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->grand_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->pay_note->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->pay_note->ViewAttributes(); ?>><?php echo $reportpaymentlog->pay_note->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->pml_slipt_num->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->pml_slipt_num->ViewAttributes(); ?>><?php echo $reportpaymentlog->pml_slipt_num->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$reportpaymentlog_summary->AccumulateSummary();

		// Get next record
		$reportpaymentlog_summary->GetRow(2);

		// Show Footers
?>
<?php
		if ($reportpaymentlog_summary->ChkLvlBreak(3)) {
			$reportpaymentlog->ResetCSS();
			$reportpaymentlog->RowType = EWRPT_ROWTYPE_TOTAL;
			$reportpaymentlog->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$reportpaymentlog->RowGroupLevel = 3;
			$reportpaymentlog_summary->RenderRow();
?>
	<tr<?php echo $reportpaymentlog->RowAttributes(); ?>>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->v_title->CellAttributes() ?>>&nbsp;</td>
		<td colspan="11"<?php echo $reportpaymentlog->pt_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $reportpaymentlog->pt_title->FldCaption() ?>: <?php echo $reportpaymentlog->pt_title->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($reportpaymentlog_summary->Cnt[3][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$reportpaymentlog->ResetCSS();
			$reportpaymentlog->count_member->Count = $reportpaymentlog_summary->Cnt[3][3];
			$reportpaymentlog->count_member->Summary = $reportpaymentlog_summary->Smry[3][3]; // Load SUM
			$reportpaymentlog->pay_rate->Count = $reportpaymentlog_summary->Cnt[3][4];
			$reportpaymentlog->pay_rate->Summary = $reportpaymentlog_summary->Smry[3][4]; // Load SUM
			$reportpaymentlog->sub_total->Count = $reportpaymentlog_summary->Cnt[3][5];
			$reportpaymentlog->sub_total->Summary = $reportpaymentlog_summary->Smry[3][5]; // Load SUM
			$reportpaymentlog->assc_total->Count = $reportpaymentlog_summary->Cnt[3][7];
			$reportpaymentlog->assc_total->Summary = $reportpaymentlog_summary->Smry[3][7]; // Load SUM
			$reportpaymentlog->grand_total->Count = $reportpaymentlog_summary->Cnt[3][8];
			$reportpaymentlog->grand_total->Summary = $reportpaymentlog_summary->Smry[3][8]; // Load SUM
			$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$reportpaymentlog_summary->RenderRow();
?>
	<tr<?php echo $reportpaymentlog->RowAttributes(); ?>>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->v_title->CellAttributes() ?>>&nbsp;</td>
		<td colspan="1"<?php echo $reportpaymentlog->pt_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportpaymentlog->pt_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->pt_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->pt_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->count_member->ViewAttributes(); ?>><?php echo $reportpaymentlog->count_member->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->pt_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->pay_rate->ViewAttributes(); ?>><?php echo $reportpaymentlog->pay_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->pt_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->sub_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->sub_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->pt_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->pt_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->assc_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->assc_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->pt_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->grand_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->grand_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->pt_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->pt_title->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 3 summary
			$reportpaymentlog_summary->ResetLevelSummary(3);
		} // End check level check
?>
<?php
		if ($reportpaymentlog_summary->ChkLvlBreak(2)) {
			$reportpaymentlog->ResetCSS();
			$reportpaymentlog->RowType = EWRPT_ROWTYPE_TOTAL;
			$reportpaymentlog->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$reportpaymentlog->RowGroupLevel = 2;
			$reportpaymentlog_summary->RenderRow();
?>
	<tr<?php echo $reportpaymentlog->RowAttributes(); ?>>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>&nbsp;</td>
		<td colspan="12"<?php echo $reportpaymentlog->v_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $reportpaymentlog->v_title->FldCaption() ?>: <?php echo $reportpaymentlog->v_title->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($reportpaymentlog_summary->Cnt[2][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$reportpaymentlog->ResetCSS();
			$reportpaymentlog->count_member->Count = $reportpaymentlog_summary->Cnt[2][3];
			$reportpaymentlog->count_member->Summary = $reportpaymentlog_summary->Smry[2][3]; // Load SUM
			$reportpaymentlog->pay_rate->Count = $reportpaymentlog_summary->Cnt[2][4];
			$reportpaymentlog->pay_rate->Summary = $reportpaymentlog_summary->Smry[2][4]; // Load SUM
			$reportpaymentlog->sub_total->Count = $reportpaymentlog_summary->Cnt[2][5];
			$reportpaymentlog->sub_total->Summary = $reportpaymentlog_summary->Smry[2][5]; // Load SUM
			$reportpaymentlog->assc_total->Count = $reportpaymentlog_summary->Cnt[2][7];
			$reportpaymentlog->assc_total->Summary = $reportpaymentlog_summary->Smry[2][7]; // Load SUM
			$reportpaymentlog->grand_total->Count = $reportpaymentlog_summary->Cnt[2][8];
			$reportpaymentlog->grand_total->Summary = $reportpaymentlog_summary->Smry[2][8]; // Load SUM
			$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$reportpaymentlog_summary->RenderRow();
?>
	<tr<?php echo $reportpaymentlog->RowAttributes(); ?>>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>&nbsp;</td>
		<td colspan="2"<?php echo $reportpaymentlog->v_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportpaymentlog->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->v_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->count_member->ViewAttributes(); ?>><?php echo $reportpaymentlog->count_member->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->v_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->pay_rate->ViewAttributes(); ?>><?php echo $reportpaymentlog->pay_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->v_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->sub_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->sub_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->v_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->assc_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->assc_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->v_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->grand_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->grand_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->v_title->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 2 summary
			$reportpaymentlog_summary->ResetLevelSummary(2);
		} // End check level check
?>
<?php
	} // End detail records loop
?>
<?php
			$reportpaymentlog->ResetCSS();
			$reportpaymentlog->RowType = EWRPT_ROWTYPE_TOTAL;
			$reportpaymentlog->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$reportpaymentlog->RowGroupLevel = 1;
			$reportpaymentlog_summary->RenderRow();
?>
	<tr<?php echo $reportpaymentlog->RowAttributes(); ?>>
		<td colspan="13"<?php echo $reportpaymentlog->t_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $reportpaymentlog->t_title->FldCaption() ?>: <?php echo $reportpaymentlog->t_title->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($reportpaymentlog_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$reportpaymentlog->ResetCSS();
			$reportpaymentlog->count_member->Count = $reportpaymentlog_summary->Cnt[1][3];
			$reportpaymentlog->count_member->Summary = $reportpaymentlog_summary->Smry[1][3]; // Load SUM
			$reportpaymentlog->pay_rate->Count = $reportpaymentlog_summary->Cnt[1][4];
			$reportpaymentlog->pay_rate->Summary = $reportpaymentlog_summary->Smry[1][4]; // Load SUM
			$reportpaymentlog->sub_total->Count = $reportpaymentlog_summary->Cnt[1][5];
			$reportpaymentlog->sub_total->Summary = $reportpaymentlog_summary->Smry[1][5]; // Load SUM
			$reportpaymentlog->assc_total->Count = $reportpaymentlog_summary->Cnt[1][7];
			$reportpaymentlog->assc_total->Summary = $reportpaymentlog_summary->Smry[1][7]; // Load SUM
			$reportpaymentlog->grand_total->Count = $reportpaymentlog_summary->Cnt[1][8];
			$reportpaymentlog->grand_total->Summary = $reportpaymentlog_summary->Smry[1][8]; // Load SUM
			$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$reportpaymentlog_summary->RenderRow();
?>
	<tr<?php echo $reportpaymentlog->RowAttributes(); ?>>
		<td colspan="3"<?php echo $reportpaymentlog->t_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->count_member->ViewAttributes(); ?>><?php echo $reportpaymentlog->count_member->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->pay_rate->ViewAttributes(); ?>><?php echo $reportpaymentlog->pay_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->sub_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->sub_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->assc_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->assc_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->grand_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->grand_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->t_title->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 1 summary
			$reportpaymentlog_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$reportpaymentlog_summary->GetGrpRow(2);
	$reportpaymentlog_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php if (intval(@$reportpaymentlog_summary->Cnt[0][10]) > 0) { ?>
<?php
	$reportpaymentlog->ResetCSS();
	$reportpaymentlog->RowType = EWRPT_ROWTYPE_TOTAL;
	$reportpaymentlog->RowTotalType = EWRPT_ROWTOTAL_PAGE;
	$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$reportpaymentlog->RowAttrs["class"] = "ewRptPageSummary";
	$reportpaymentlog_summary->RenderRow();
?>
	<tr<?php echo $reportpaymentlog->RowAttributes(); ?>><td colspan="13"><?php echo $ReportLanguage->Phrase("RptPageTotal") ?> (<?php echo ewrpt_FormatNumber($reportpaymentlog_summary->Cnt[0][10],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
	$reportpaymentlog->ResetCSS();
	$reportpaymentlog->count_member->Count = $reportpaymentlog_summary->Cnt[0][3];
	$reportpaymentlog->count_member->Summary = $reportpaymentlog_summary->Smry[0][3]; // Load SUM
	$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportpaymentlog->pay_rate->Count = $reportpaymentlog_summary->Cnt[0][4];
	$reportpaymentlog->pay_rate->Summary = $reportpaymentlog_summary->Smry[0][4]; // Load SUM
	$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportpaymentlog->sub_total->Count = $reportpaymentlog_summary->Cnt[0][5];
	$reportpaymentlog->sub_total->Summary = $reportpaymentlog_summary->Smry[0][5]; // Load SUM
	$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportpaymentlog->assc_total->Count = $reportpaymentlog_summary->Cnt[0][7];
	$reportpaymentlog->assc_total->Summary = $reportpaymentlog_summary->Smry[0][7]; // Load SUM
	$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportpaymentlog->grand_total->Count = $reportpaymentlog_summary->Cnt[0][8];
	$reportpaymentlog->grand_total->Summary = $reportpaymentlog_summary->Smry[0][8]; // Load SUM
	$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportpaymentlog->grand_total->CurrentValue = $reportpaymentlog->grand_total->Summary;
	$reportpaymentlog->RowAttrs["class"] = "ewRptPageSummary";
	$reportpaymentlog_summary->RenderRow();
?>
	<tr<?php echo $reportpaymentlog->RowAttributes(); ?>>
		<td colspan="3" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportpaymentlog->pay_date->CellAttributes() ?>>&nbsp;</td>

		<td<?php echo $reportpaymentlog->pay_detail->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->count_member->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->count_member->ViewAttributes(); ?>><?php echo $reportpaymentlog->count_member->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->pay_rate->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->pay_rate->ViewAttributes(); ?>><?php echo $reportpaymentlog->pay_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->sub_total->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->sub_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->sub_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->assc_rate->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->assc_total->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->assc_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->assc_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->grand_total->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->grand_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->grand_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->pay_note->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->pml_slipt_num->CellAttributes() ?>>&nbsp;</td>
	</tr>
	<!-- tr class="ewRptPageSummary"><td colspan="13"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
<?php } ?>
<?php
if ($reportpaymentlog_summary->TotalGrps > 0) {
	$reportpaymentlog->ResetCSS();
	$reportpaymentlog->RowType = EWRPT_ROWTYPE_TOTAL;
	$reportpaymentlog->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$reportpaymentlog->RowAttrs["class"] = "ewRptGrandSummary";
	$reportpaymentlog_summary->RenderRow();
?>
	<!-- tr><td colspan="13"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $reportpaymentlog->RowAttributes(); ?>><td colspan="13"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($reportpaymentlog_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
	$reportpaymentlog->ResetCSS();
	$reportpaymentlog->count_member->Count = $reportpaymentlog_summary->TotCount;
	$reportpaymentlog->count_member->Summary = $reportpaymentlog_summary->GrandSmry[3]; // Load SUM
	$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportpaymentlog->pay_rate->Count = $reportpaymentlog_summary->TotCount;
	$reportpaymentlog->pay_rate->Summary = $reportpaymentlog_summary->GrandSmry[4]; // Load SUM
	$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportpaymentlog->sub_total->Count = $reportpaymentlog_summary->TotCount;
	$reportpaymentlog->sub_total->Summary = $reportpaymentlog_summary->GrandSmry[5]; // Load SUM
	$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportpaymentlog->assc_total->Count = $reportpaymentlog_summary->TotCount;
	$reportpaymentlog->assc_total->Summary = $reportpaymentlog_summary->GrandSmry[7]; // Load SUM
	$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportpaymentlog->grand_total->Count = $reportpaymentlog_summary->TotCount;
	$reportpaymentlog->grand_total->Summary = $reportpaymentlog_summary->GrandSmry[8]; // Load SUM
	$reportpaymentlog->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportpaymentlog->grand_total->CurrentValue = $reportpaymentlog->grand_total->Summary;
	$reportpaymentlog->RowAttrs["class"] = "ewRptGrandSummary";
	$reportpaymentlog_summary->RenderRow();
?>
	<tr<?php echo $reportpaymentlog->RowAttributes(); ?>>
		<td colspan="3" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportpaymentlog->pay_date->CellAttributes() ?>>&nbsp;</td>

		<td<?php echo $reportpaymentlog->pay_detail->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->count_member->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->count_member->ViewAttributes(); ?>><?php echo $reportpaymentlog->count_member->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->pay_rate->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->pay_rate->ViewAttributes(); ?>><?php echo $reportpaymentlog->pay_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->sub_total->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->sub_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->sub_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->assc_rate->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->assc_total->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->assc_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->assc_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->grand_total->CellAttributes() ?>>
<div<?php echo $reportpaymentlog->grand_total->ViewAttributes(); ?>><?php echo $reportpaymentlog->grand_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportpaymentlog->pay_note->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportpaymentlog->pml_slipt_num->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($reportpaymentlog_summary->TotalGrps > 0) { ?>
<?php if ($reportpaymentlog->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="reportpaymentlogsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportpaymentlog_summary->StartGrp, $reportpaymentlog_summary->DisplayGrps, $reportpaymentlog_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportpaymentlogsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportpaymentlogsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportpaymentlogsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportpaymentlogsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($reportpaymentlog_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportpaymentlog_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportpaymentlog_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportpaymentlog_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportpaymentlog_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportpaymentlog_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportpaymentlog_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportpaymentlog_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportpaymentlog_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportpaymentlog_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportpaymentlog->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($reportpaymentlog->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($reportpaymentlog->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($reportpaymentlog->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $reportpaymentlog_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($reportpaymentlog->Export == "") { ?>
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
$reportpaymentlog_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crreportpaymentlog_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'reportpaymentlog';

	// Page object name
	var $PageObjName = 'reportpaymentlog_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $reportpaymentlog;
		if ($reportpaymentlog->UseTokenInUrl) $PageUrl .= "t=" . $reportpaymentlog->TableVar . "&"; // Add page token
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
		global $reportpaymentlog;
		if ($reportpaymentlog->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($reportpaymentlog->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($reportpaymentlog->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crreportpaymentlog_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (reportpaymentlog)
		$GLOBALS["reportpaymentlog"] = new crreportpaymentlog();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'reportpaymentlog', TRUE);

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
		global $reportpaymentlog;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$reportpaymentlog->Export = $_GET["export"];
	}
	$gsExport = $reportpaymentlog->Export; // Get export parameter, used in header
	$gsExportFile = $reportpaymentlog->TableVar; // Get export file, used in header
	if ($reportpaymentlog->Export == "excel") {
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
		global $reportpaymentlog;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($reportpaymentlog->Export == "email") {
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
		global $reportpaymentlog;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 11;
		$nGrps = 4;
		$this->Val = ewrpt_InitArray($nDtls, 0);
		$this->Cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandSmry = ewrpt_InitArray($nDtls, 0);
		$this->GrandMn = ewrpt_InitArray($nDtls, NULL);
		$this->GrandMx = ewrpt_InitArray($nDtls, NULL);

		// Set up if accumulation required
		$this->Col = array(FALSE, FALSE, FALSE, TRUE, TRUE, TRUE, FALSE, TRUE, TRUE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$reportpaymentlog->pay_date->SelectionList = "";
		$reportpaymentlog->pay_date->DefaultSelectionList = "";
		$reportpaymentlog->pay_date->ValueList = "";
		$reportpaymentlog->pml_slipt_num->SelectionList = "";
		$reportpaymentlog->pml_slipt_num->DefaultSelectionList = "";
		$reportpaymentlog->pml_slipt_num->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$reportpaymentlog->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($reportpaymentlog->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($reportpaymentlog->SqlSelectGroup(), $reportpaymentlog->SqlWhere(), $reportpaymentlog->SqlGroupBy(), $reportpaymentlog->SqlHaving(), $reportpaymentlog->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($reportpaymentlog->ExportAll && $reportpaymentlog->Export <> "")
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
		global $reportpaymentlog;
		switch ($lvl) {
			case 1:
				return (is_null($reportpaymentlog->t_title->CurrentValue) && !is_null($reportpaymentlog->t_title->OldValue)) ||
					(!is_null($reportpaymentlog->t_title->CurrentValue) && is_null($reportpaymentlog->t_title->OldValue)) ||
					($reportpaymentlog->t_title->GroupValue() <> $reportpaymentlog->t_title->GroupOldValue());
			case 2:
				return (is_null($reportpaymentlog->v_title->CurrentValue) && !is_null($reportpaymentlog->v_title->OldValue)) ||
					(!is_null($reportpaymentlog->v_title->CurrentValue) && is_null($reportpaymentlog->v_title->OldValue)) ||
					($reportpaymentlog->v_title->GroupValue() <> $reportpaymentlog->v_title->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
			case 3:
				return (is_null($reportpaymentlog->pt_title->CurrentValue) && !is_null($reportpaymentlog->pt_title->OldValue)) ||
					(!is_null($reportpaymentlog->pt_title->CurrentValue) && is_null($reportpaymentlog->pt_title->OldValue)) ||
					($reportpaymentlog->pt_title->GroupValue() <> $reportpaymentlog->pt_title->GroupOldValue()) || $this->ChkLvlBreak(2); // Recurse upper level
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
		global $reportpaymentlog;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $reportpaymentlog;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $reportpaymentlog;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$reportpaymentlog->t_title->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$reportpaymentlog->t_title->setDbValue($rsgrp->fields('t_title'));
		if ($rsgrp->EOF) {
			$reportpaymentlog->t_title->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $reportpaymentlog;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$reportpaymentlog->pay_date->setDbValue($rs->fields('pay_date'));
			if ($opt <> 1)
				$reportpaymentlog->t_title->setDbValue($rs->fields('t_title'));
			$reportpaymentlog->v_title->setDbValue($rs->fields('v_title'));
			$reportpaymentlog->pt_title->setDbValue($rs->fields('pt_title'));
			$reportpaymentlog->pay_type->setDbValue($rs->fields('pay_type'));
			$reportpaymentlog->t_code->setDbValue($rs->fields('t_code'));
			$reportpaymentlog->village_id->setDbValue($rs->fields('village_id'));
			$reportpaymentlog->pay_detail->setDbValue($rs->fields('pay_detail'));
			$reportpaymentlog->count_member->setDbValue($rs->fields('count_member'));
			$reportpaymentlog->pay_rate->setDbValue($rs->fields('pay_rate'));
			$reportpaymentlog->sub_total->setDbValue($rs->fields('sub_total'));
			$reportpaymentlog->assc_rate->setDbValue($rs->fields('assc_rate'));
			$reportpaymentlog->assc_total->setDbValue($rs->fields('assc_total'));
			$reportpaymentlog->grand_total->setDbValue($rs->fields('grand_total'));
			$reportpaymentlog->pay_note->setDbValue($rs->fields('pay_note'));
			$reportpaymentlog->pml_slipt_num->setDbValue($rs->fields('pml_slipt_num'));
			$this->Val[1] = $reportpaymentlog->pay_date->CurrentValue;
			$this->Val[2] = $reportpaymentlog->pay_detail->CurrentValue;
			$this->Val[3] = $reportpaymentlog->count_member->CurrentValue;
			$this->Val[4] = $reportpaymentlog->pay_rate->CurrentValue;
			$this->Val[5] = $reportpaymentlog->sub_total->CurrentValue;
			$this->Val[6] = $reportpaymentlog->assc_rate->CurrentValue;
			$this->Val[7] = $reportpaymentlog->assc_total->CurrentValue;
			$this->Val[8] = $reportpaymentlog->grand_total->CurrentValue;
			$this->Val[9] = $reportpaymentlog->pay_note->CurrentValue;
			$this->Val[10] = $reportpaymentlog->pml_slipt_num->CurrentValue;
			
		} else {
			$reportpaymentlog->pay_date->setDbValue("");
			$reportpaymentlog->t_title->setDbValue("");
			$reportpaymentlog->v_title->setDbValue("");
			$reportpaymentlog->pt_title->setDbValue("");
			$reportpaymentlog->pay_type->setDbValue("");
			$reportpaymentlog->t_code->setDbValue("");
			$reportpaymentlog->village_id->setDbValue("");
			$reportpaymentlog->pay_detail->setDbValue("");
			$reportpaymentlog->count_member->setDbValue("");
			$reportpaymentlog->pay_rate->setDbValue("");
			$reportpaymentlog->sub_total->setDbValue("");
			$reportpaymentlog->assc_rate->setDbValue("");
			$reportpaymentlog->assc_total->setDbValue("");
			$reportpaymentlog->grand_total->setDbValue("");
			$reportpaymentlog->pay_note->setDbValue("");
			$reportpaymentlog->pml_slipt_num->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $reportpaymentlog;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$reportpaymentlog->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$reportpaymentlog->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $reportpaymentlog->getStartGroup();
			}
		} else {
			$this->StartGrp = $reportpaymentlog->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$reportpaymentlog->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$reportpaymentlog->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$reportpaymentlog->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $reportpaymentlog;

		// Initialize popup
		// Build distinct values for pay_date

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportpaymentlog->pay_date->SqlSelect, $reportpaymentlog->SqlWhere(), $reportpaymentlog->SqlGroupBy(), $reportpaymentlog->SqlHaving(), $reportpaymentlog->pay_date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportpaymentlog->pay_date->setDbValue($rswrk->fields[0]);
			if (is_null($reportpaymentlog->pay_date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportpaymentlog->pay_date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportpaymentlog->pay_date->ViewValue = ewrpt_FormatDateTime($reportpaymentlog->pay_date->CurrentValue, 7);
				ewrpt_SetupDistinctValues($reportpaymentlog->pay_date->ValueList, $reportpaymentlog->pay_date->CurrentValue, $reportpaymentlog->pay_date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportpaymentlog->pay_date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportpaymentlog->pay_date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for pml_slipt_num
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportpaymentlog->pml_slipt_num->SqlSelect, $reportpaymentlog->SqlWhere(), $reportpaymentlog->SqlGroupBy(), $reportpaymentlog->SqlHaving(), $reportpaymentlog->pml_slipt_num->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportpaymentlog->pml_slipt_num->setDbValue($rswrk->fields[0]);
			if (is_null($reportpaymentlog->pml_slipt_num->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportpaymentlog->pml_slipt_num->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportpaymentlog->pml_slipt_num->ViewValue = $reportpaymentlog->pml_slipt_num->CurrentValue;
				ewrpt_SetupDistinctValues($reportpaymentlog->pml_slipt_num->ValueList, $reportpaymentlog->pml_slipt_num->CurrentValue, $reportpaymentlog->pml_slipt_num->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportpaymentlog->pml_slipt_num->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportpaymentlog->pml_slipt_num->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('pay_date');
				$this->ClearSessionSelection('pml_slipt_num');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get ว.ด.ป.ที่ชำระ selected values

		if (is_array(@$_SESSION["sel_reportpaymentlog_pay_date"])) {
			$this->LoadSelectionFromSession('pay_date');
		} elseif (@$_SESSION["sel_reportpaymentlog_pay_date"] == EWRPT_INIT_VALUE) { // Select all
			$reportpaymentlog->pay_date->SelectionList = "";
		}

		// Get หมายเลขใบเสร็จ selected values
		if (is_array(@$_SESSION["sel_reportpaymentlog_pml_slipt_num"])) {
			$this->LoadSelectionFromSession('pml_slipt_num');
		} elseif (@$_SESSION["sel_reportpaymentlog_pml_slipt_num"] == EWRPT_INIT_VALUE) { // Select all
			$reportpaymentlog->pml_slipt_num->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $reportpaymentlog;
		$this->StartGrp = 1;
		$reportpaymentlog->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $reportpaymentlog;
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
			$reportpaymentlog->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$reportpaymentlog->setStartGroup($this->StartGrp);
		} else {
			if ($reportpaymentlog->getGroupPerPage() <> "") {
				$this->DisplayGrps = $reportpaymentlog->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $reportpaymentlog;
		if ($reportpaymentlog->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($reportpaymentlog->SqlSelectCount(), $reportpaymentlog->SqlWhere(), $reportpaymentlog->SqlGroupBy(), $reportpaymentlog->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}

			// Get total from sql directly
			$sSql = ewrpt_BuildReportSql($reportpaymentlog->SqlSelectAgg(), $reportpaymentlog->SqlWhere(), $reportpaymentlog->SqlGroupBy(), $reportpaymentlog->SqlHaving(), "", $this->Filter, "");
			$sSql = $reportpaymentlog->SqlAggPfx() . $sSql . $reportpaymentlog->SqlAggSfx();
			$rsagg = $conn->Execute($sSql);
			if ($rsagg) {
				$this->GrandSmry[3] = $rsagg->fields("sum_count_member");
				$this->GrandSmry[4] = $rsagg->fields("sum_pay_rate");
				$this->GrandSmry[5] = $rsagg->fields("sum_sub_total");
				$this->GrandSmry[7] = $rsagg->fields("sum_assc_total");
				$this->GrandSmry[8] = $rsagg->fields("sum_grand_total");
				$rsagg->Close();
			} else {

				// Accumulate grand summary from detail records
				$sSql = ewrpt_BuildReportSql($reportpaymentlog->SqlSelect(), $reportpaymentlog->SqlWhere(), $reportpaymentlog->SqlGroupBy(), $reportpaymentlog->SqlHaving(), "", $this->Filter, "");
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
		$reportpaymentlog->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($reportpaymentlog->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// t_title
			$reportpaymentlog->t_title->GroupViewValue = $reportpaymentlog->t_title->GroupOldValue();
			$reportpaymentlog->t_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->t_title->CellAttrs["class"] = ($reportpaymentlog->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$reportpaymentlog->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportpaymentlog->t_title, $reportpaymentlog->t_title->GroupViewValue);

			// v_title
			$reportpaymentlog->v_title->GroupViewValue = $reportpaymentlog->v_title->GroupOldValue();
			$reportpaymentlog->v_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->v_title->CellAttrs["class"] = ($reportpaymentlog->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";
			$reportpaymentlog->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportpaymentlog->v_title, $reportpaymentlog->v_title->GroupViewValue);

	// pt_title
			$reportpaymentlog->pt_title->GroupViewValue = $reportpaymentlog->pt_title->GroupOldValue();
			$reportpaymentlog->pt_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->pt_title->CellAttrs["class"] = ($reportpaymentlog->RowGroupLevel == 3) ? "ewRptGrpSummary3" : "ewRptGrpField3";
			$reportpaymentlog->pt_title->GroupViewValue = ewrpt_DisplayGroupValue($reportpaymentlog->pt_title, $reportpaymentlog->pt_title->GroupViewValue);

			// pay_date
			$reportpaymentlog->pay_date->ViewValue = $reportpaymentlog->pay_date->Summary;
			$reportpaymentlog->pay_date->ViewValue = ewrpt_FormatDateTime($reportpaymentlog->pay_date->ViewValue, 7);
			$reportpaymentlog->pay_date->CellAttrs["style"] = "white-space: nowrap;";

			// pay_detail
			$reportpaymentlog->pay_detail->ViewValue = $reportpaymentlog->pay_detail->Summary;
			$reportpaymentlog->pay_detail->CellAttrs["style"] = "white-space: nowrap;";

			// count_member
			$reportpaymentlog->count_member->ViewValue = $reportpaymentlog->count_member->Summary;
			$reportpaymentlog->count_member->CellAttrs["style"] = "white-space: nowrap;";

			// pay_rate
			$reportpaymentlog->pay_rate->ViewValue = $reportpaymentlog->pay_rate->Summary;
			$reportpaymentlog->pay_rate->CellAttrs["style"] = "white-space: nowrap;";

			// sub_total
			$reportpaymentlog->sub_total->ViewValue = $reportpaymentlog->sub_total->Summary;
			$reportpaymentlog->sub_total->ViewValue = ewrpt_FormatCurrency($reportpaymentlog->sub_total->ViewValue, 0, -2, -2, -2);
			$reportpaymentlog->sub_total->CellAttrs["style"] = "white-space: nowrap;";

			// assc_rate
			$reportpaymentlog->assc_rate->ViewValue = $reportpaymentlog->assc_rate->Summary;
			$reportpaymentlog->assc_rate->CellAttrs["style"] = "white-space: nowrap;";

			// assc_total
			$reportpaymentlog->assc_total->ViewValue = $reportpaymentlog->assc_total->Summary;
			$reportpaymentlog->assc_total->ViewValue = ewrpt_FormatCurrency($reportpaymentlog->assc_total->ViewValue, 0, -2, -2, -2);
			$reportpaymentlog->assc_total->CellAttrs["style"] = "white-space: nowrap;";

			// grand_total
			$reportpaymentlog->grand_total->ViewValue = $reportpaymentlog->grand_total->Summary;
			$reportpaymentlog->grand_total->ViewValue = ewrpt_FormatCurrency($reportpaymentlog->grand_total->ViewValue, 0, -2, -2, -2);
			$reportpaymentlog->grand_total->CellAttrs["style"] = "white-space: nowrap;";

			// pay_note
			$reportpaymentlog->pay_note->ViewValue = $reportpaymentlog->pay_note->Summary;
			$reportpaymentlog->pay_note->CellAttrs["style"] = "white-space: nowrap;";

			// pml_slipt_num
			$reportpaymentlog->pml_slipt_num->ViewValue = $reportpaymentlog->pml_slipt_num->Summary;
			$reportpaymentlog->pml_slipt_num->CellAttrs["style"] = "white-space: nowrap;";
		} else {

			// t_title
			$reportpaymentlog->t_title->GroupViewValue = $reportpaymentlog->t_title->GroupValue();
			$reportpaymentlog->t_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->t_title->CellAttrs["class"] = "ewRptGrpField1";
			$reportpaymentlog->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportpaymentlog->t_title, $reportpaymentlog->t_title->GroupViewValue);
			if ($reportpaymentlog->t_title->GroupValue() == $reportpaymentlog->t_title->GroupOldValue() && !$this->ChkLvlBreak(1))
				$reportpaymentlog->t_title->GroupViewValue = "&nbsp;";

			// v_title
			$reportpaymentlog->v_title->GroupViewValue = $reportpaymentlog->v_title->GroupValue();
			$reportpaymentlog->v_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->v_title->CellAttrs["class"] = "ewRptGrpField2";
			$reportpaymentlog->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportpaymentlog->v_title, $reportpaymentlog->v_title->GroupViewValue);
			if ($reportpaymentlog->v_title->GroupValue() == $reportpaymentlog->v_title->GroupOldValue() && !$this->ChkLvlBreak(2))
				$reportpaymentlog->v_title->GroupViewValue = "&nbsp;";

	// pt_title
			$reportpaymentlog->pt_title->GroupViewValue = $reportpaymentlog->pt_title->GroupValue();
			$reportpaymentlog->pt_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->pt_title->CellAttrs["class"] = "ewRptGrpField3";
			$reportpaymentlog->pt_title->GroupViewValue = ewrpt_DisplayGroupValue($reportpaymentlog->pt_title, $reportpaymentlog->pt_title->GroupViewValue);
			if ($reportpaymentlog->pt_title->GroupValue() == $reportpaymentlog->pt_title->GroupOldValue() && !$this->ChkLvlBreak(3))
				$reportpaymentlog->pt_title->GroupViewValue = "&nbsp;";
			// pay_date
			$reportpaymentlog->pay_date->ViewValue = $reportpaymentlog->pay_date->CurrentValue;
			$reportpaymentlog->pay_date->ViewValue = ewrpt_FormatDateTime($reportpaymentlog->pay_date->ViewValue, 7);
			$reportpaymentlog->pay_date->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->pay_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

	// pay_detail
			$reportpaymentlog->pay_detail->ViewValue = $reportpaymentlog->pay_detail->CurrentValue;
			$reportpaymentlog->pay_detail->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->pay_detail->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// count_member
			$reportpaymentlog->count_member->ViewValue = $reportpaymentlog->count_member->CurrentValue;
			$reportpaymentlog->count_member->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->count_member->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_rate
			$reportpaymentlog->pay_rate->ViewValue = $reportpaymentlog->pay_rate->CurrentValue;
			$reportpaymentlog->pay_rate->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->pay_rate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// sub_total
			$reportpaymentlog->sub_total->ViewValue = $reportpaymentlog->sub_total->CurrentValue;
			$reportpaymentlog->sub_total->ViewValue = ewrpt_FormatCurrency($reportpaymentlog->sub_total->ViewValue, 0, -2, -2, -2);
			$reportpaymentlog->sub_total->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->sub_total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// assc_rate
			$reportpaymentlog->assc_rate->ViewValue = $reportpaymentlog->assc_rate->CurrentValue;
			$reportpaymentlog->assc_rate->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->assc_rate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// assc_total
			$reportpaymentlog->assc_total->ViewValue = $reportpaymentlog->assc_total->CurrentValue;
			$reportpaymentlog->assc_total->ViewValue = ewrpt_FormatCurrency($reportpaymentlog->assc_total->ViewValue, 0, -2, -2, -2);
			$reportpaymentlog->assc_total->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->assc_total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// grand_total
			$reportpaymentlog->grand_total->ViewValue = $reportpaymentlog->grand_total->CurrentValue;
			$reportpaymentlog->grand_total->ViewValue = ewrpt_FormatCurrency($reportpaymentlog->grand_total->ViewValue, 0, -2, -2, -2);
			$reportpaymentlog->grand_total->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->grand_total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_note
			$reportpaymentlog->pay_note->ViewValue = $reportpaymentlog->pay_note->CurrentValue;
			$reportpaymentlog->pay_note->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->pay_note->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pml_slipt_num
			$reportpaymentlog->pml_slipt_num->ViewValue = $reportpaymentlog->pml_slipt_num->CurrentValue;
			$reportpaymentlog->pml_slipt_num->CellAttrs["style"] = "white-space: nowrap;";
			$reportpaymentlog->pml_slipt_num->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// t_title
		$reportpaymentlog->t_title->HrefValue = "";

		// v_title
		$reportpaymentlog->v_title->HrefValue = "";

		// pay_date
		$reportpaymentlog->pay_date->HrefValue = "";

		// pt_title
		$reportpaymentlog->pt_title->HrefValue = "";

		// pay_detail
		$reportpaymentlog->pay_detail->HrefValue = "";

		// count_member
		$reportpaymentlog->count_member->HrefValue = "";

		// pay_rate
		$reportpaymentlog->pay_rate->HrefValue = "";

		// sub_total
		$reportpaymentlog->sub_total->HrefValue = "";

		// assc_rate
		$reportpaymentlog->assc_rate->HrefValue = "";

		// assc_total
		$reportpaymentlog->assc_total->HrefValue = "";

		// grand_total
		$reportpaymentlog->grand_total->HrefValue = "";

		// pay_note
		$reportpaymentlog->pay_note->HrefValue = "";

		// pml_slipt_num
		$reportpaymentlog->pml_slipt_num->HrefValue = "";

		// Call Row_Rendered event
		$reportpaymentlog->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $reportpaymentlog;

		// Field t_title
		$sSelect = "SELECT DISTINCT tambon.t_title FROM " . $reportpaymentlog->SqlFrom();
		$sOrderBy = "tambon.t_title ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $reportpaymentlog->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$reportpaymentlog->t_title->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);

		// Field v_title
		$sSelect = "SELECT DISTINCT village.v_title FROM " . $reportpaymentlog->SqlFrom();
		$sOrderBy = "village.v_title ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $reportpaymentlog->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$reportpaymentlog->v_title->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);

		// Field pt_title
		$sSelect = "SELECT DISTINCT paymenttype.pt_title FROM " . $reportpaymentlog->SqlFrom();
		$sOrderBy = "paymenttype.pt_title ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $reportpaymentlog->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$reportpaymentlog->pt_title->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $reportpaymentlog;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

			// Clear extended filter for field pml_slipt_num
			if ($this->ClearExtFilter == 'reportpaymentlog_pml_slipt_num')
				$this->SetSessionFilterValues('', '=', 'AND', '', '=', 'pml_slipt_num');

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field t_title

			$this->SetSessionDropDownValue($reportpaymentlog->t_title->DropDownValue, 't_title');

			// Field v_title
			$this->SetSessionDropDownValue($reportpaymentlog->v_title->DropDownValue, 'v_title');

			// Field pt_title
			$this->SetSessionDropDownValue($reportpaymentlog->pt_title->DropDownValue, 'pt_title');

			// Field pml_slipt_num
			$this->SetSessionFilterValues($reportpaymentlog->pml_slipt_num->SearchValue, $reportpaymentlog->pml_slipt_num->SearchOperator, $reportpaymentlog->pml_slipt_num->SearchCondition, $reportpaymentlog->pml_slipt_num->SearchValue2, $reportpaymentlog->pml_slipt_num->SearchOperator2, 'pml_slipt_num');
			$bSetupFilter = TRUE;
		} else {

			// Field t_title
			if ($this->GetDropDownValue($reportpaymentlog->t_title->DropDownValue, 't_title')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($reportpaymentlog->t_title->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_reportpaymentlog->t_title'])) {
				$bSetupFilter = TRUE;
			}

			// Field v_title
			if ($this->GetDropDownValue($reportpaymentlog->v_title->DropDownValue, 'v_title')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($reportpaymentlog->v_title->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_reportpaymentlog->v_title'])) {
				$bSetupFilter = TRUE;
			}

			// Field pt_title
			if ($this->GetDropDownValue($reportpaymentlog->pt_title->DropDownValue, 'pt_title')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($reportpaymentlog->pt_title->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_reportpaymentlog->pt_title'])) {
				$bSetupFilter = TRUE;
			}

			// Field pml_slipt_num
			if ($this->GetFilterValues($reportpaymentlog->pml_slipt_num)) {
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

			// Field t_title
			$this->GetSessionDropDownValue($reportpaymentlog->t_title);

			// Field v_title
			$this->GetSessionDropDownValue($reportpaymentlog->v_title);

			// Field pt_title
			$this->GetSessionDropDownValue($reportpaymentlog->pt_title);

			// Field pml_slipt_num
			$this->GetSessionFilterValues($reportpaymentlog->pml_slipt_num);
		}

		// Call page filter validated event
		$reportpaymentlog->Page_FilterValidated();

		// Build SQL
		// Field t_title

		$this->BuildDropDownFilter($reportpaymentlog->t_title, $sFilter, "");

		// Field v_title
		$this->BuildDropDownFilter($reportpaymentlog->v_title, $sFilter, "");

		// Field pt_title
		$this->BuildDropDownFilter($reportpaymentlog->pt_title, $sFilter, "");

		// Field pml_slipt_num
		$this->BuildExtendedFilter($reportpaymentlog->pml_slipt_num, $sFilter);

		// Save parms to session
		// Field t_title

		$this->SetSessionDropDownValue($reportpaymentlog->t_title->DropDownValue, 't_title');

		// Field v_title
		$this->SetSessionDropDownValue($reportpaymentlog->v_title->DropDownValue, 'v_title');

		// Field pt_title
		$this->SetSessionDropDownValue($reportpaymentlog->pt_title->DropDownValue, 'pt_title');

		// Field pml_slipt_num
		$this->SetSessionFilterValues($reportpaymentlog->pml_slipt_num->SearchValue, $reportpaymentlog->pml_slipt_num->SearchOperator, $reportpaymentlog->pml_slipt_num->SearchCondition, $reportpaymentlog->pml_slipt_num->SearchValue2, $reportpaymentlog->pml_slipt_num->SearchOperator2, 'pml_slipt_num');

		// Setup filter
		if ($bSetupFilter) {

			// Field pml_slipt_num
			$sWrk = "";
			$this->BuildExtendedFilter($reportpaymentlog->pml_slipt_num, $sWrk);
			$this->LoadSelectionFromFilter($reportpaymentlog->pml_slipt_num, $sWrk, $reportpaymentlog->pml_slipt_num->SelectionList);
			$_SESSION['sel_reportpaymentlog_pml_slipt_num'] = ($reportpaymentlog->pml_slipt_num->SelectionList == "") ? EWRPT_INIT_VALUE : $reportpaymentlog->pml_slipt_num->SelectionList;
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
		$this->GetSessionValue($fld->DropDownValue, 'sv_reportpaymentlog_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_reportpaymentlog_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_reportpaymentlog_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_reportpaymentlog_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_reportpaymentlog_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_reportpaymentlog_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_reportpaymentlog_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_reportpaymentlog_' . $parm] = $sv1;
		$_SESSION['so1_reportpaymentlog_' . $parm] = $so1;
		$_SESSION['sc_reportpaymentlog_' . $parm] = $sc;
		$_SESSION['sv2_reportpaymentlog_' . $parm] = $sv2;
		$_SESSION['so2_reportpaymentlog_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $reportpaymentlog;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckInteger($reportpaymentlog->pml_slipt_num->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $reportpaymentlog->pml_slipt_num->FldErrMsg();
		}

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
		$_SESSION["sel_reportpaymentlog_$parm"] = "";
		$_SESSION["rf_reportpaymentlog_$parm"] = "";
		$_SESSION["rt_reportpaymentlog_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $reportpaymentlog;
		$fld =& $reportpaymentlog->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_reportpaymentlog_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_reportpaymentlog_$parm"];
		$fld->RangeTo = @$_SESSION["rt_reportpaymentlog_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $reportpaymentlog;

		/**
		* Set up default values for non Text filters
		*/

	// Field t_title
		$reportpaymentlog->t_title->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$reportpaymentlog->t_title->DropDownValue = $reportpaymentlog->t_title->DefaultDropDownValue;

		// Field v_title
		$reportpaymentlog->v_title->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$reportpaymentlog->v_title->DropDownValue = $reportpaymentlog->v_title->DefaultDropDownValue;

		// Field pt_title
		$reportpaymentlog->pt_title->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$reportpaymentlog->pt_title->DropDownValue = $reportpaymentlog->pt_title->DefaultDropDownValue;
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



		// Field pml_slipt_num
		$this->SetDefaultExtFilter($reportpaymentlog->pml_slipt_num, "=", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($reportpaymentlog->pml_slipt_num);
		$sWrk = "";
		$this->BuildExtendedFilter($reportpaymentlog->pml_slipt_num, $sWrk);
		$this->LoadSelectionFromFilter($reportpaymentlog->pml_slipt_num, $sWrk, $reportpaymentlog->pml_slipt_num->DefaultSelectionList);
		$reportpaymentlog->pml_slipt_num->SelectionList = $reportpaymentlog->pml_slipt_num->DefaultSelectionList;

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/

		// Field pay_date
		// Setup your default values for the popup filter below, e.g.
		// $reportpaymentlog->pay_date->DefaultSelectionList = array("val1", "val2");

		$reportpaymentlog->pay_date->DefaultSelectionList = "";
		$reportpaymentlog->pay_date->SelectionList = $reportpaymentlog->pay_date->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $reportpaymentlog;

		// Check pay_date popup filter
		if (!ewrpt_MatchedArray($reportpaymentlog->pay_date->DefaultSelectionList, $reportpaymentlog->pay_date->SelectionList))
			return TRUE;

		// Check t_title extended filter
		if ($this->NonTextFilterApplied($reportpaymentlog->t_title))
			return TRUE;

		// Check v_title extended filter
		if ($this->NonTextFilterApplied($reportpaymentlog->v_title))
			return TRUE;

		// Check pt_title extended filter
		if ($this->NonTextFilterApplied($reportpaymentlog->pt_title))
			return TRUE;

		// Check pml_slipt_num text filter
		if ($this->TextFilterApplied($reportpaymentlog->pml_slipt_num))
			return TRUE;

		// Check pml_slipt_num popup filter
		if (!ewrpt_MatchedArray($reportpaymentlog->pml_slipt_num->DefaultSelectionList, $reportpaymentlog->pml_slipt_num->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $reportpaymentlog;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field pay_date
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportpaymentlog->pay_date->SelectionList))
			$sWrk = ewrpt_JoinArray($reportpaymentlog->pay_date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpaymentlog->pay_date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field t_title
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($reportpaymentlog->t_title, $sExtWrk, "");
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpaymentlog->t_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field v_title
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($reportpaymentlog->v_title, $sExtWrk, "");
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpaymentlog->v_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field pt_title
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($reportpaymentlog->pt_title, $sExtWrk, "");
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpaymentlog->pt_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field pml_slipt_num
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($reportpaymentlog->pml_slipt_num, $sExtWrk);
		if (is_array($reportpaymentlog->pml_slipt_num->SelectionList))
			$sWrk = ewrpt_JoinArray($reportpaymentlog->pml_slipt_num->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportpaymentlog->pml_slipt_num->FldCaption() . "<br />";
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
		global $reportpaymentlog;
		$sWrk = "";
			if (is_array($reportpaymentlog->pay_date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportpaymentlog->pay_date, "paymentlog.pay_date", EWRPT_DATATYPE_DATE);
			}
		if (!$this->ExtendedFilterExist($reportpaymentlog->pml_slipt_num)) {
			if (is_array($reportpaymentlog->pml_slipt_num->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportpaymentlog->pml_slipt_num, "paymentlog.pml_slipt_num", EWRPT_DATATYPE_NUMBER);
			}
		}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $reportpaymentlog;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$reportpaymentlog->setOrderBy("");
				$reportpaymentlog->setStartGroup(1);
				$reportpaymentlog->t_title->setSort("");
				$reportpaymentlog->v_title->setSort("");
				$reportpaymentlog->pt_title->setSort("");
				$reportpaymentlog->pay_date->setSort("");
				
				$reportpaymentlog->pay_detail->setSort("");
				$reportpaymentlog->count_member->setSort("");
				$reportpaymentlog->pay_rate->setSort("");
				$reportpaymentlog->sub_total->setSort("");
				$reportpaymentlog->assc_rate->setSort("");
				$reportpaymentlog->assc_total->setSort("");
				$reportpaymentlog->grand_total->setSort("");
				$reportpaymentlog->pay_note->setSort("");
				$reportpaymentlog->pml_slipt_num->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$reportpaymentlog->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$reportpaymentlog->CurrentOrderType = @$_GET["ordertype"];
			$reportpaymentlog->UpdateSort($reportpaymentlog->t_title); // t_title
			$reportpaymentlog->UpdateSort($reportpaymentlog->v_title); // v_title
			$reportpaymentlog->UpdateSort($reportpaymentlog->pt_title); // pt_title
			$reportpaymentlog->UpdateSort($reportpaymentlog->pay_date); // pay_date

			$reportpaymentlog->UpdateSort($reportpaymentlog->pay_detail); // pay_detail
			$reportpaymentlog->UpdateSort($reportpaymentlog->count_member); // count_member
			$reportpaymentlog->UpdateSort($reportpaymentlog->pay_rate); // pay_rate
			$reportpaymentlog->UpdateSort($reportpaymentlog->sub_total); // sub_total
			$reportpaymentlog->UpdateSort($reportpaymentlog->assc_rate); // assc_rate
			$reportpaymentlog->UpdateSort($reportpaymentlog->assc_total); // assc_total
			$reportpaymentlog->UpdateSort($reportpaymentlog->grand_total); // grand_total
			$reportpaymentlog->UpdateSort($reportpaymentlog->pay_note); // pay_note
			$reportpaymentlog->UpdateSort($reportpaymentlog->pml_slipt_num); // pml_slipt_num
			$sSortSql = $reportpaymentlog->SortSql();
			$reportpaymentlog->setOrderBy($sSortSql);
			$reportpaymentlog->setStartGroup(1);
		}
		return $reportpaymentlog->getOrderBy();
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
