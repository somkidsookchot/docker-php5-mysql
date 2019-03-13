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
$viewpayment = NULL;

//
// Table class for viewpayment
//
class crviewpayment {
	var $TableVar = 'viewpayment';
	var $TableName = 'viewpayment';
	var $TableType = 'CUSTOMVIEW';
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
	var $pt_title;
	var $pay_sum_id;
	var $t_code;
	var $village_id;
	var $member_code;
	var $pay_sum_type;
	var $pay_death_begin;
	var $pay_death_end;
	var $pay_annual_year;
	var $pay_sum_date;
	var $pay_sum_total;
	var $pay_sum_detail;
	var $pay_sum_adv_num;
	var $pay_sum_adv_count;
	var $pay_sum_note;
	var $flag;
	var $v_title;
	var $v_code;
	var $t_title;
	var $fname;
	var $lname;
	var $fields = array();
	var $Export; // Export
	var $ExportAll = FALSE;
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
	function crviewpayment() {
		global $ReportLanguage;

		// pt_title
		$this->pt_title = new crField('viewpayment', 'viewpayment', 'x_pt_title', 'pt_title', 'paymenttype.pt_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pt_title'] =& $this->pt_title;
		$this->pt_title->DateFilter = "";
		$this->pt_title->SqlSelect = "";
		$this->pt_title->SqlOrderBy = "";

		// pay_sum_id
		$this->pay_sum_id = new crField('viewpayment', 'viewpayment', 'x_pay_sum_id', 'pay_sum_id', '`pay_sum_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_id'] =& $this->pay_sum_id;
		$this->pay_sum_id->DateFilter = "";
		$this->pay_sum_id->SqlSelect = "";
		$this->pay_sum_id->SqlOrderBy = "";

		// t_code
		$this->t_code = new crField('viewpayment', 'viewpayment', 'x_t_code', 't_code', '`t_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";

		// village_id
		$this->village_id = new crField('viewpayment', 'viewpayment', 'x_village_id', 'village_id', '`village_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";

		// member_code
		$this->member_code = new crField('viewpayment', 'viewpayment', 'x_member_code', 'member_code', '`member_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";

		// pay_sum_type
		$this->pay_sum_type = new crField('viewpayment', 'viewpayment', 'x_pay_sum_type', 'pay_sum_type', '`pay_sum_type`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_type'] =& $this->pay_sum_type;
		$this->pay_sum_type->DateFilter = "";
		$this->pay_sum_type->SqlSelect = "";
		$this->pay_sum_type->SqlOrderBy = "";

		// pay_death_begin
		$this->pay_death_begin = new crField('viewpayment', 'viewpayment', 'x_pay_death_begin', 'pay_death_begin', '`pay_death_begin`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_death_begin->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_death_begin'] =& $this->pay_death_begin;
		$this->pay_death_begin->DateFilter = "";
		$this->pay_death_begin->SqlSelect = "";
		$this->pay_death_begin->SqlOrderBy = "";

		// pay_death_end
		$this->pay_death_end = new crField('viewpayment', 'viewpayment', 'x_pay_death_end', 'pay_death_end', '`pay_death_end`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_death_end->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_death_end'] =& $this->pay_death_end;
		$this->pay_death_end->DateFilter = "";
		$this->pay_death_end->SqlSelect = "";
		$this->pay_death_end->SqlOrderBy = "";

		// pay_annual_year
		$this->pay_annual_year = new crField('viewpayment', 'viewpayment', 'x_pay_annual_year', 'pay_annual_year', '`pay_annual_year`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pay_annual_year'] =& $this->pay_annual_year;
		$this->pay_annual_year->DateFilter = "";
		$this->pay_annual_year->SqlSelect = "";
		$this->pay_annual_year->SqlOrderBy = "";

		// pay_sum_date
		$this->pay_sum_date = new crField('viewpayment', 'viewpayment', 'x_pay_sum_date', 'pay_sum_date', '`pay_sum_date`', 135, EWRPT_DATATYPE_DATE, 6);
		$this->pay_sum_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['pay_sum_date'] =& $this->pay_sum_date;
		$this->pay_sum_date->DateFilter = "";
		$this->pay_sum_date->SqlSelect = "";
		$this->pay_sum_date->SqlOrderBy = "";

		// pay_sum_total
		$this->pay_sum_total = new crField('viewpayment', 'viewpayment', 'x_pay_sum_total', 'pay_sum_total', '`pay_sum_total`', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['pay_sum_total'] =& $this->pay_sum_total;
		$this->pay_sum_total->DateFilter = "";
		$this->pay_sum_total->SqlSelect = "";
		$this->pay_sum_total->SqlOrderBy = "";

		// pay_sum_detail
		$this->pay_sum_detail = new crField('viewpayment', 'viewpayment', 'x_pay_sum_detail', 'pay_sum_detail', '`pay_sum_detail`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pay_sum_detail'] =& $this->pay_sum_detail;
		$this->pay_sum_detail->DateFilter = "";
		$this->pay_sum_detail->SqlSelect = "";
		$this->pay_sum_detail->SqlOrderBy = "";

		// pay_sum_adv_num
		$this->pay_sum_adv_num = new crField('viewpayment', 'viewpayment', 'x_pay_sum_adv_num', 'pay_sum_adv_num', '`pay_sum_adv_num`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_adv_num->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_adv_num'] =& $this->pay_sum_adv_num;
		$this->pay_sum_adv_num->DateFilter = "";
		$this->pay_sum_adv_num->SqlSelect = "";
		$this->pay_sum_adv_num->SqlOrderBy = "";

		// pay_sum_adv_count
		$this->pay_sum_adv_count = new crField('viewpayment', 'viewpayment', 'x_pay_sum_adv_count', 'pay_sum_adv_count', '`pay_sum_adv_count`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_adv_count->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_adv_count'] =& $this->pay_sum_adv_count;
		$this->pay_sum_adv_count->DateFilter = "";
		$this->pay_sum_adv_count->SqlSelect = "";
		$this->pay_sum_adv_count->SqlOrderBy = "";

		// pay_sum_note
		$this->pay_sum_note = new crField('viewpayment', 'viewpayment', 'x_pay_sum_note', 'pay_sum_note', '`pay_sum_note`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['pay_sum_note'] =& $this->pay_sum_note;
		$this->pay_sum_note->DateFilter = "";
		$this->pay_sum_note->SqlSelect = "";
		$this->pay_sum_note->SqlOrderBy = "";

		// flag
		$this->flag = new crField('viewpayment', 'viewpayment', 'x_flag', 'flag', '`flag`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->flag->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['flag'] =& $this->flag;
		$this->flag->DateFilter = "";
		$this->flag->SqlSelect = "";
		$this->flag->SqlOrderBy = "";

		// v_title
		$this->v_title = new crField('viewpayment', 'viewpayment', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "";
		$this->v_title->SqlOrderBy = "";

		// v_code
		$this->v_code = new crField('viewpayment', 'viewpayment', 'x_v_code', 'v_code', 'village.v_code', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->v_code->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['v_code'] =& $this->v_code;
		$this->v_code->DateFilter = "";
		$this->v_code->SqlSelect = "";
		$this->v_code->SqlOrderBy = "";

		// t_title
		$this->t_title = new crField('viewpayment', 'viewpayment', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "";
		$this->t_title->SqlOrderBy = "";

		// fname
		$this->fname = new crField('viewpayment', 'viewpayment', 'x_fname', 'fname', 'members.fname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";

		// lname
		$this->lname = new crField('viewpayment', 'viewpayment', 'x_lname', 'lname', 'members.lname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";
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
		return "";
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
$viewpayment_rpt = new crviewpayment_rpt();
$Page =& $viewpayment_rpt;

// Page init
$viewpayment_rpt->Page_Init();

// Page main
$viewpayment_rpt->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($viewpayment->Export == "") { ?>
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
<?php $viewpayment_rpt->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $viewpayment_rpt->ShowMessage(); ?>
<?php if ($viewpayment->Export == "" || $viewpayment->Export == "print" || $viewpayment->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($viewpayment->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($viewpayment->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($viewpayment->Export == "" || $viewpayment->Export == "print" || $viewpayment->Export == "email") { ?>
<?php } ?>
<?php echo $viewpayment->TableCaption() ?>
<?php if ($viewpayment->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $viewpayment_rpt->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $viewpayment_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
<?php } ?>
<br /><br />
<?php if ($viewpayment->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($viewpayment->Export == "" || $viewpayment->Export == "print" || $viewpayment->Export == "email") { ?>
<?php } ?>
<?php if ($viewpayment->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($viewpayment->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="viewpaymentrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($viewpayment_rpt->StartGrp, $viewpayment_rpt->DisplayGrps, $viewpayment_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="viewpaymentrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="viewpaymentrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="viewpaymentrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="viewpaymentrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($viewpayment_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($viewpayment_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($viewpayment_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($viewpayment_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($viewpayment_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($viewpayment_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($viewpayment_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($viewpayment_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($viewpayment_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($viewpayment_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($viewpayment->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($viewpayment->ExportAll && $viewpayment->Export <> "") {
	$viewpayment_rpt->StopGrp = $viewpayment_rpt->TotalGrps;
} else {
	$viewpayment_rpt->StopGrp = $viewpayment_rpt->StartGrp + $viewpayment_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($viewpayment_rpt->StopGrp) > intval($viewpayment_rpt->TotalGrps))
	$viewpayment_rpt->StopGrp = $viewpayment_rpt->TotalGrps;
$viewpayment_rpt->RecCount = 0;

// Get first row
if ($viewpayment_rpt->TotalGrps > 0) {
	$viewpayment_rpt->GetRow(1);
	$viewpayment_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $viewpayment_rpt->GrpCount <= $viewpayment_rpt->DisplayGrps) || $viewpayment_rpt->ShowFirstHeader) {

	// Show header
	if ($viewpayment_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->pt_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->pt_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->pt_title) ?>',1);"><?php echo $viewpayment->pt_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->pt_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->pt_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->pay_sum_id) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->pay_sum_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->pay_sum_id) ?>',1);"><?php echo $viewpayment->pay_sum_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->pay_sum_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->pay_sum_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->t_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->t_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->t_code) ?>',1);"><?php echo $viewpayment->t_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->t_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->t_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->member_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->member_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->member_code) ?>',1);"><?php echo $viewpayment->member_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->member_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->member_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->pay_sum_type) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->pay_sum_type->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->pay_sum_type) ?>',1);"><?php echo $viewpayment->pay_sum_type->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->pay_sum_type->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->pay_sum_type->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->pay_death_begin) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->pay_death_begin->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->pay_death_begin) ?>',1);"><?php echo $viewpayment->pay_death_begin->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->pay_death_begin->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->pay_death_begin->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->pay_death_end) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->pay_death_end->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->pay_death_end) ?>',1);"><?php echo $viewpayment->pay_death_end->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->pay_death_end->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->pay_death_end->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->pay_annual_year) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->pay_annual_year->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->pay_annual_year) ?>',1);"><?php echo $viewpayment->pay_annual_year->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->pay_annual_year->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->pay_annual_year->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->pay_sum_date) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->pay_sum_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->pay_sum_date) ?>',1);"><?php echo $viewpayment->pay_sum_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->pay_sum_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->pay_sum_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->pay_sum_total) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->pay_sum_total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->pay_sum_total) ?>',1);"><?php echo $viewpayment->pay_sum_total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->pay_sum_total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->pay_sum_total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->pay_sum_detail) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->pay_sum_detail->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->pay_sum_detail) ?>',1);"><?php echo $viewpayment->pay_sum_detail->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->pay_sum_detail->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->pay_sum_detail->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->pay_sum_adv_num) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->pay_sum_adv_num->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->pay_sum_adv_num) ?>',1);"><?php echo $viewpayment->pay_sum_adv_num->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->pay_sum_adv_num->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->pay_sum_adv_num->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->pay_sum_adv_count) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->pay_sum_adv_count->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->pay_sum_adv_count) ?>',1);"><?php echo $viewpayment->pay_sum_adv_count->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->pay_sum_adv_count->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->pay_sum_adv_count->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->flag) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->flag->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->flag) ?>',1);"><?php echo $viewpayment->flag->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->flag->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->flag->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->v_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->v_title) ?>',1);"><?php echo $viewpayment->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->v_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->v_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->v_code) ?>',1);"><?php echo $viewpayment->v_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->v_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->v_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->t_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->t_title) ?>',1);"><?php echo $viewpayment->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->fname) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->fname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->fname) ?>',1);"><?php echo $viewpayment->fname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->fname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->fname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($viewpayment->SortUrl($viewpayment->lname) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $viewpayment->lname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpayment->SortUrl($viewpayment->lname) ?>',1);"><?php echo $viewpayment->lname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpayment->lname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpayment->lname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$viewpayment_rpt->ShowFirstHeader = FALSE;
	}
	$viewpayment_rpt->RecCount++;

		// Render detail row
		$viewpayment->ResetCSS();
		$viewpayment->RowType = EWRPT_ROWTYPE_DETAIL;
		$viewpayment_rpt->RenderRow();
?>
	<tr<?php echo $viewpayment->RowAttributes(); ?>>
		<td<?php echo $viewpayment->pt_title->CellAttributes() ?>>
<div<?php echo $viewpayment->pt_title->ViewAttributes(); ?>><?php echo $viewpayment->pt_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->pay_sum_id->CellAttributes() ?>>
<div<?php echo $viewpayment->pay_sum_id->ViewAttributes(); ?>><?php echo $viewpayment->pay_sum_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->t_code->CellAttributes() ?>>
<div<?php echo $viewpayment->t_code->ViewAttributes(); ?>><?php echo $viewpayment->t_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->member_code->CellAttributes() ?>>
<div<?php echo $viewpayment->member_code->ViewAttributes(); ?>><?php echo $viewpayment->member_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->pay_sum_type->CellAttributes() ?>>
<div<?php echo $viewpayment->pay_sum_type->ViewAttributes(); ?>><?php echo $viewpayment->pay_sum_type->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->pay_death_begin->CellAttributes() ?>>
<div<?php echo $viewpayment->pay_death_begin->ViewAttributes(); ?>><?php echo $viewpayment->pay_death_begin->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->pay_death_end->CellAttributes() ?>>
<div<?php echo $viewpayment->pay_death_end->ViewAttributes(); ?>><?php echo $viewpayment->pay_death_end->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->pay_annual_year->CellAttributes() ?>>
<div<?php echo $viewpayment->pay_annual_year->ViewAttributes(); ?>><?php echo $viewpayment->pay_annual_year->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->pay_sum_date->CellAttributes() ?>>
<div<?php echo $viewpayment->pay_sum_date->ViewAttributes(); ?>><?php echo $viewpayment->pay_sum_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->pay_sum_total->CellAttributes() ?>>
<div<?php echo $viewpayment->pay_sum_total->ViewAttributes(); ?>><?php echo $viewpayment->pay_sum_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->pay_sum_detail->CellAttributes() ?>>
<div<?php echo $viewpayment->pay_sum_detail->ViewAttributes(); ?>><?php echo $viewpayment->pay_sum_detail->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->pay_sum_adv_num->CellAttributes() ?>>
<div<?php echo $viewpayment->pay_sum_adv_num->ViewAttributes(); ?>><?php echo $viewpayment->pay_sum_adv_num->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->pay_sum_adv_count->CellAttributes() ?>>
<div<?php echo $viewpayment->pay_sum_adv_count->ViewAttributes(); ?>><?php echo $viewpayment->pay_sum_adv_count->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->flag->CellAttributes() ?>>
<div<?php echo $viewpayment->flag->ViewAttributes(); ?>><?php echo $viewpayment->flag->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->v_title->CellAttributes() ?>>
<div<?php echo $viewpayment->v_title->ViewAttributes(); ?>><?php echo $viewpayment->v_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->v_code->CellAttributes() ?>>
<div<?php echo $viewpayment->v_code->ViewAttributes(); ?>><?php echo $viewpayment->v_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->t_title->CellAttributes() ?>>
<div<?php echo $viewpayment->t_title->ViewAttributes(); ?>><?php echo $viewpayment->t_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->fname->CellAttributes() ?>>
<div<?php echo $viewpayment->fname->ViewAttributes(); ?>><?php echo $viewpayment->fname->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpayment->lname->CellAttributes() ?>>
<div<?php echo $viewpayment->lname->ViewAttributes(); ?>><?php echo $viewpayment->lname->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$viewpayment_rpt->AccumulateSummary();

		// Get next record
		$viewpayment_rpt->GetRow(2);
	$viewpayment_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($viewpayment_rpt->TotalGrps > 0) { ?>
<?php if ($viewpayment->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="viewpaymentrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($viewpayment_rpt->StartGrp, $viewpayment_rpt->DisplayGrps, $viewpayment_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="viewpaymentrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="viewpaymentrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="viewpaymentrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="viewpaymentrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($viewpayment_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($viewpayment_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($viewpayment_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($viewpayment_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($viewpayment_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($viewpayment_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($viewpayment_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($viewpayment_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($viewpayment_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($viewpayment_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($viewpayment->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($viewpayment->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($viewpayment->Export == "" || $viewpayment->Export == "print" || $viewpayment->Export == "email") { ?>
<?php } ?>
<?php if ($viewpayment->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($viewpayment->Export == "" || $viewpayment->Export == "print" || $viewpayment->Export == "email") { ?>
<?php } ?>
<?php if ($viewpayment->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $viewpayment_rpt->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($viewpayment->Export == "") { ?>
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
$viewpayment_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crviewpayment_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'viewpayment';

	// Page object name
	var $PageObjName = 'viewpayment_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $viewpayment;
		if ($viewpayment->UseTokenInUrl) $PageUrl .= "t=" . $viewpayment->TableVar . "&"; // Add page token
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
		global $viewpayment;
		if ($viewpayment->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($viewpayment->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($viewpayment->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crviewpayment_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (viewpayment)
		$GLOBALS["viewpayment"] = new crviewpayment();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'viewpayment', TRUE);

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
		global $viewpayment;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$viewpayment->Export = $_GET["export"];
	}
	$gsExport = $viewpayment->Export; // Get export parameter, used in header
	$gsExportFile = $viewpayment->TableVar; // Get export file, used in header
	if ($viewpayment->Export == "excel") {
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
		global $viewpayment;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($viewpayment->Export == "email") {
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
		global $viewpayment;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 20;
		$nGrps = 1;
		$this->Val = ewrpt_InitArray($nDtls, 0);
		$this->Cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandSmry = ewrpt_InitArray($nDtls, 0);
		$this->GrandMn = ewrpt_InitArray($nDtls, NULL);
		$this->GrandMx = ewrpt_InitArray($nDtls, NULL);

		// Set up if accumulation required
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Build popup filter
		$sPopupFilter = $this->GetPopupFilter();

		//ewrpt_SetDebugMsg("popup filter: " . $sPopupFilter);
		if ($sPopupFilter <> "") {
			if ($this->Filter <> "")
				$this->Filter = "($this->Filter) AND ($sPopupFilter)";
			else
				$this->Filter = $sPopupFilter;
		}

		// No filter
		$this->FilterApplied = FALSE;

		// Get sort
		$this->Sort = $this->GetSort();

		// Get total count
		$sSql = ewrpt_BuildReportSql($viewpayment->SqlSelect(), $viewpayment->SqlWhere(), $viewpayment->SqlGroupBy(), $viewpayment->SqlHaving(), $viewpayment->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($viewpayment->ExportAll && $viewpayment->Export <> "")
		    $this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup(); 

		// Get current page records
		$rs = $this->GetRs($sSql, $this->StartGrp, $this->DisplayGrps);
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

	// Get count
	function GetCnt($sql) {
		global $conn;
		$rscnt = $conn->Execute($sql);
		$cnt = ($rscnt) ? $rscnt->RecordCount() : 0;
		if ($rscnt) $rscnt->Close();
		return $cnt;
	}

	// Get rs
	function GetRs($sql, $start, $grps) {
		global $conn;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $viewpayment;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$viewpayment->pt_title->setDbValue($rs->fields('pt_title'));
			$viewpayment->pay_sum_id->setDbValue($rs->fields('pay_sum_id'));
			$viewpayment->t_code->setDbValue($rs->fields('t_code'));
			$viewpayment->village_id->setDbValue($rs->fields('village_id'));
			$viewpayment->member_code->setDbValue($rs->fields('member_code'));
			$viewpayment->pay_sum_type->setDbValue($rs->fields('pay_sum_type'));
			$viewpayment->pay_death_begin->setDbValue($rs->fields('pay_death_begin'));
			$viewpayment->pay_death_end->setDbValue($rs->fields('pay_death_end'));
			$viewpayment->pay_annual_year->setDbValue($rs->fields('pay_annual_year'));
			$viewpayment->pay_sum_date->setDbValue($rs->fields('pay_sum_date'));
			$viewpayment->pay_sum_total->setDbValue($rs->fields('pay_sum_total'));
			$viewpayment->pay_sum_detail->setDbValue($rs->fields('pay_sum_detail'));
			$viewpayment->pay_sum_adv_num->setDbValue($rs->fields('pay_sum_adv_num'));
			$viewpayment->pay_sum_adv_count->setDbValue($rs->fields('pay_sum_adv_count'));
			$viewpayment->pay_sum_note->setDbValue($rs->fields('pay_sum_note'));
			$viewpayment->flag->setDbValue($rs->fields('flag'));
			$viewpayment->v_title->setDbValue($rs->fields('v_title'));
			$viewpayment->v_code->setDbValue($rs->fields('v_code'));
			$viewpayment->t_title->setDbValue($rs->fields('t_title'));
			$viewpayment->fname->setDbValue($rs->fields('fname'));
			$viewpayment->lname->setDbValue($rs->fields('lname'));
			$this->Val[1] = $viewpayment->pt_title->CurrentValue;
			$this->Val[2] = $viewpayment->pay_sum_id->CurrentValue;
			$this->Val[3] = $viewpayment->t_code->CurrentValue;
			$this->Val[4] = $viewpayment->member_code->CurrentValue;
			$this->Val[5] = $viewpayment->pay_sum_type->CurrentValue;
			$this->Val[6] = $viewpayment->pay_death_begin->CurrentValue;
			$this->Val[7] = $viewpayment->pay_death_end->CurrentValue;
			$this->Val[8] = $viewpayment->pay_annual_year->CurrentValue;
			$this->Val[9] = $viewpayment->pay_sum_date->CurrentValue;
			$this->Val[10] = $viewpayment->pay_sum_total->CurrentValue;
			$this->Val[11] = $viewpayment->pay_sum_detail->CurrentValue;
			$this->Val[12] = $viewpayment->pay_sum_adv_num->CurrentValue;
			$this->Val[13] = $viewpayment->pay_sum_adv_count->CurrentValue;
			$this->Val[14] = $viewpayment->flag->CurrentValue;
			$this->Val[15] = $viewpayment->v_title->CurrentValue;
			$this->Val[16] = $viewpayment->v_code->CurrentValue;
			$this->Val[17] = $viewpayment->t_title->CurrentValue;
			$this->Val[18] = $viewpayment->fname->CurrentValue;
			$this->Val[19] = $viewpayment->lname->CurrentValue;
		} else {
			$viewpayment->pt_title->setDbValue("");
			$viewpayment->pay_sum_id->setDbValue("");
			$viewpayment->t_code->setDbValue("");
			$viewpayment->village_id->setDbValue("");
			$viewpayment->member_code->setDbValue("");
			$viewpayment->pay_sum_type->setDbValue("");
			$viewpayment->pay_death_begin->setDbValue("");
			$viewpayment->pay_death_end->setDbValue("");
			$viewpayment->pay_annual_year->setDbValue("");
			$viewpayment->pay_sum_date->setDbValue("");
			$viewpayment->pay_sum_total->setDbValue("");
			$viewpayment->pay_sum_detail->setDbValue("");
			$viewpayment->pay_sum_adv_num->setDbValue("");
			$viewpayment->pay_sum_adv_count->setDbValue("");
			$viewpayment->pay_sum_note->setDbValue("");
			$viewpayment->flag->setDbValue("");
			$viewpayment->v_title->setDbValue("");
			$viewpayment->v_code->setDbValue("");
			$viewpayment->t_title->setDbValue("");
			$viewpayment->fname->setDbValue("");
			$viewpayment->lname->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $viewpayment;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$viewpayment->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$viewpayment->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $viewpayment->getStartGroup();
			}
		} else {
			$this->StartGrp = $viewpayment->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$viewpayment->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$viewpayment->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$viewpayment->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $viewpayment;

		// Initialize popup
		// Process post back form

		if (ewrpt_IsHttpPost()) {
			$sName = @$_POST["popup"]; // Get popup form name
			if ($sName <> "") {
				$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
				if ($cntValues > 0) {
					$arValues = ewrpt_StripSlashes($_POST["sel_$sName"]);
					if (trim($arValues[0]) == "") // Select all
						$arValues = EWRPT_INIT_VALUE;
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
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $viewpayment;
		$this->StartGrp = 1;
		$viewpayment->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $viewpayment;
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
			$viewpayment->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$viewpayment->setStartGroup($this->StartGrp);
		} else {
			if ($viewpayment->getGroupPerPage() <> "") {
				$this->DisplayGrps = $viewpayment->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $viewpayment;
		if ($viewpayment->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($viewpayment->SqlSelectCount(), $viewpayment->SqlWhere(), $viewpayment->SqlGroupBy(), $viewpayment->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$viewpayment->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($viewpayment->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// pt_title
			$viewpayment->pt_title->ViewValue = $viewpayment->pt_title->Summary;
			$viewpayment->pt_title->CellAttrs["style"] = "white-space: nowrap;";

			// pay_sum_id
			$viewpayment->pay_sum_id->ViewValue = $viewpayment->pay_sum_id->Summary;
			$viewpayment->pay_sum_id->CellAttrs["style"] = "white-space: nowrap;";

			// t_code
			$viewpayment->t_code->ViewValue = $viewpayment->t_code->Summary;
			$viewpayment->t_code->CellAttrs["style"] = "white-space: nowrap;";

			// member_code
			$viewpayment->member_code->ViewValue = $viewpayment->member_code->Summary;
			$viewpayment->member_code->CellAttrs["style"] = "white-space: nowrap;";

			// pay_sum_type
			$viewpayment->pay_sum_type->ViewValue = $viewpayment->pay_sum_type->Summary;
			$viewpayment->pay_sum_type->CellAttrs["style"] = "white-space: nowrap;";

			// pay_death_begin
			$viewpayment->pay_death_begin->ViewValue = $viewpayment->pay_death_begin->Summary;
			$viewpayment->pay_death_begin->CellAttrs["style"] = "white-space: nowrap;";

			// pay_death_end
			$viewpayment->pay_death_end->ViewValue = $viewpayment->pay_death_end->Summary;
			$viewpayment->pay_death_end->CellAttrs["style"] = "white-space: nowrap;";

			// pay_annual_year
			$viewpayment->pay_annual_year->ViewValue = $viewpayment->pay_annual_year->Summary;
			$viewpayment->pay_annual_year->CellAttrs["style"] = "white-space: nowrap;";

			// pay_sum_date
			$viewpayment->pay_sum_date->ViewValue = $viewpayment->pay_sum_date->Summary;
			$viewpayment->pay_sum_date->ViewValue = ewrpt_FormatDateTime($viewpayment->pay_sum_date->ViewValue, 6);
			$viewpayment->pay_sum_date->CellAttrs["style"] = "white-space: nowrap;";

			// pay_sum_total
			$viewpayment->pay_sum_total->ViewValue = $viewpayment->pay_sum_total->Summary;
			$viewpayment->pay_sum_total->CellAttrs["style"] = "white-space: nowrap;";

			// pay_sum_detail
			$viewpayment->pay_sum_detail->ViewValue = $viewpayment->pay_sum_detail->Summary;
			$viewpayment->pay_sum_detail->CellAttrs["style"] = "white-space: nowrap;";

			// pay_sum_adv_num
			$viewpayment->pay_sum_adv_num->ViewValue = $viewpayment->pay_sum_adv_num->Summary;
			$viewpayment->pay_sum_adv_num->CellAttrs["style"] = "white-space: nowrap;";

			// pay_sum_adv_count
			$viewpayment->pay_sum_adv_count->ViewValue = $viewpayment->pay_sum_adv_count->Summary;
			$viewpayment->pay_sum_adv_count->CellAttrs["style"] = "white-space: nowrap;";

			// flag
			$viewpayment->flag->ViewValue = $viewpayment->flag->Summary;
			$viewpayment->flag->CellAttrs["style"] = "white-space: nowrap;";

			// v_title
			$viewpayment->v_title->ViewValue = $viewpayment->v_title->Summary;
			$viewpayment->v_title->CellAttrs["style"] = "white-space: nowrap;";

			// v_code
			$viewpayment->v_code->ViewValue = $viewpayment->v_code->Summary;
			$viewpayment->v_code->CellAttrs["style"] = "white-space: nowrap;";

			// t_title
			$viewpayment->t_title->ViewValue = $viewpayment->t_title->Summary;
			$viewpayment->t_title->CellAttrs["style"] = "white-space: nowrap;";

			// fname
			$viewpayment->fname->ViewValue = $viewpayment->fname->Summary;
			$viewpayment->fname->CellAttrs["style"] = "white-space: nowrap;";

			// lname
			$viewpayment->lname->ViewValue = $viewpayment->lname->Summary;
			$viewpayment->lname->CellAttrs["style"] = "white-space: nowrap;";
		} else {

			// pt_title
			$viewpayment->pt_title->ViewValue = $viewpayment->pt_title->CurrentValue;
			$viewpayment->pt_title->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->pt_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_id
			$viewpayment->pay_sum_id->ViewValue = $viewpayment->pay_sum_id->CurrentValue;
			$viewpayment->pay_sum_id->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->pay_sum_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_code
			$viewpayment->t_code->ViewValue = $viewpayment->t_code->CurrentValue;
			$viewpayment->t_code->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->t_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_code
			$viewpayment->member_code->ViewValue = $viewpayment->member_code->CurrentValue;
			$viewpayment->member_code->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->member_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_type
			$viewpayment->pay_sum_type->ViewValue = $viewpayment->pay_sum_type->CurrentValue;
			$viewpayment->pay_sum_type->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->pay_sum_type->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_death_begin
			$viewpayment->pay_death_begin->ViewValue = $viewpayment->pay_death_begin->CurrentValue;
			$viewpayment->pay_death_begin->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->pay_death_begin->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_death_end
			$viewpayment->pay_death_end->ViewValue = $viewpayment->pay_death_end->CurrentValue;
			$viewpayment->pay_death_end->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->pay_death_end->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_annual_year
			$viewpayment->pay_annual_year->ViewValue = $viewpayment->pay_annual_year->CurrentValue;
			$viewpayment->pay_annual_year->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->pay_annual_year->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_date
			$viewpayment->pay_sum_date->ViewValue = $viewpayment->pay_sum_date->CurrentValue;
			$viewpayment->pay_sum_date->ViewValue = ewrpt_FormatDateTime($viewpayment->pay_sum_date->ViewValue, 6);
			$viewpayment->pay_sum_date->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->pay_sum_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_total
			$viewpayment->pay_sum_total->ViewValue = $viewpayment->pay_sum_total->CurrentValue;
			$viewpayment->pay_sum_total->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->pay_sum_total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_detail
			$viewpayment->pay_sum_detail->ViewValue = $viewpayment->pay_sum_detail->CurrentValue;
			$viewpayment->pay_sum_detail->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->pay_sum_detail->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_adv_num
			$viewpayment->pay_sum_adv_num->ViewValue = $viewpayment->pay_sum_adv_num->CurrentValue;
			$viewpayment->pay_sum_adv_num->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->pay_sum_adv_num->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_adv_count
			$viewpayment->pay_sum_adv_count->ViewValue = $viewpayment->pay_sum_adv_count->CurrentValue;
			$viewpayment->pay_sum_adv_count->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->pay_sum_adv_count->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// flag
			$viewpayment->flag->ViewValue = $viewpayment->flag->CurrentValue;
			$viewpayment->flag->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->flag->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_title
			$viewpayment->v_title->ViewValue = $viewpayment->v_title->CurrentValue;
			$viewpayment->v_title->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->v_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_code
			$viewpayment->v_code->ViewValue = $viewpayment->v_code->CurrentValue;
			$viewpayment->v_code->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->v_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_title
			$viewpayment->t_title->ViewValue = $viewpayment->t_title->CurrentValue;
			$viewpayment->t_title->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->t_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$viewpayment->fname->ViewValue = $viewpayment->fname->CurrentValue;
			$viewpayment->fname->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$viewpayment->lname->ViewValue = $viewpayment->lname->CurrentValue;
			$viewpayment->lname->CellAttrs["style"] = "white-space: nowrap;";
			$viewpayment->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// pt_title
		$viewpayment->pt_title->HrefValue = "";

		// pay_sum_id
		$viewpayment->pay_sum_id->HrefValue = "";

		// t_code
		$viewpayment->t_code->HrefValue = "";

		// member_code
		$viewpayment->member_code->HrefValue = "";

		// pay_sum_type
		$viewpayment->pay_sum_type->HrefValue = "";

		// pay_death_begin
		$viewpayment->pay_death_begin->HrefValue = "";

		// pay_death_end
		$viewpayment->pay_death_end->HrefValue = "";

		// pay_annual_year
		$viewpayment->pay_annual_year->HrefValue = "";

		// pay_sum_date
		$viewpayment->pay_sum_date->HrefValue = "";

		// pay_sum_total
		$viewpayment->pay_sum_total->HrefValue = "";

		// pay_sum_detail
		$viewpayment->pay_sum_detail->HrefValue = "";

		// pay_sum_adv_num
		$viewpayment->pay_sum_adv_num->HrefValue = "";

		// pay_sum_adv_count
		$viewpayment->pay_sum_adv_count->HrefValue = "";

		// flag
		$viewpayment->flag->HrefValue = "";

		// v_title
		$viewpayment->v_title->HrefValue = "";

		// v_code
		$viewpayment->v_code->HrefValue = "";

		// t_title
		$viewpayment->t_title->HrefValue = "";

		// fname
		$viewpayment->fname->HrefValue = "";

		// lname
		$viewpayment->lname->HrefValue = "";

		// Call Row_Rendered event
		$viewpayment->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $viewpayment;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $viewpayment;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$viewpayment->setOrderBy("");
				$viewpayment->setStartGroup(1);
				$viewpayment->pt_title->setSort("");
				$viewpayment->pay_sum_id->setSort("");
				$viewpayment->t_code->setSort("");
				$viewpayment->member_code->setSort("");
				$viewpayment->pay_sum_type->setSort("");
				$viewpayment->pay_death_begin->setSort("");
				$viewpayment->pay_death_end->setSort("");
				$viewpayment->pay_annual_year->setSort("");
				$viewpayment->pay_sum_date->setSort("");
				$viewpayment->pay_sum_total->setSort("");
				$viewpayment->pay_sum_detail->setSort("");
				$viewpayment->pay_sum_adv_num->setSort("");
				$viewpayment->pay_sum_adv_count->setSort("");
				$viewpayment->flag->setSort("");
				$viewpayment->v_title->setSort("");
				$viewpayment->v_code->setSort("");
				$viewpayment->t_title->setSort("");
				$viewpayment->fname->setSort("");
				$viewpayment->lname->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$viewpayment->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$viewpayment->CurrentOrderType = @$_GET["ordertype"];
			$viewpayment->UpdateSort($viewpayment->pt_title); // pt_title
			$viewpayment->UpdateSort($viewpayment->pay_sum_id); // pay_sum_id
			$viewpayment->UpdateSort($viewpayment->t_code); // t_code
			$viewpayment->UpdateSort($viewpayment->member_code); // member_code
			$viewpayment->UpdateSort($viewpayment->pay_sum_type); // pay_sum_type
			$viewpayment->UpdateSort($viewpayment->pay_death_begin); // pay_death_begin
			$viewpayment->UpdateSort($viewpayment->pay_death_end); // pay_death_end
			$viewpayment->UpdateSort($viewpayment->pay_annual_year); // pay_annual_year
			$viewpayment->UpdateSort($viewpayment->pay_sum_date); // pay_sum_date
			$viewpayment->UpdateSort($viewpayment->pay_sum_total); // pay_sum_total
			$viewpayment->UpdateSort($viewpayment->pay_sum_detail); // pay_sum_detail
			$viewpayment->UpdateSort($viewpayment->pay_sum_adv_num); // pay_sum_adv_num
			$viewpayment->UpdateSort($viewpayment->pay_sum_adv_count); // pay_sum_adv_count
			$viewpayment->UpdateSort($viewpayment->flag); // flag
			$viewpayment->UpdateSort($viewpayment->v_title); // v_title
			$viewpayment->UpdateSort($viewpayment->v_code); // v_code
			$viewpayment->UpdateSort($viewpayment->t_title); // t_title
			$viewpayment->UpdateSort($viewpayment->fname); // fname
			$viewpayment->UpdateSort($viewpayment->lname); // lname
			$sSortSql = $viewpayment->SortSql();
			$viewpayment->setOrderBy($sSortSql);
			$viewpayment->setStartGroup(1);
		}
		return $viewpayment->getOrderBy();
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
