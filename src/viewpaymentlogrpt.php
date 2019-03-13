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
$viewpaymentlog = NULL;

//
// Table class for viewpaymentlog
//
class crviewpaymentlog {
	var $TableVar = 'viewpaymentlog';
	var $TableName = 'viewpaymentlog';
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
	var $pay_date;
	var $pml_slipt_num;
	var $pt_title;
	var $t_title;
	var $v_title;
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
	function crviewpaymentlog() {
		global $ReportLanguage;

		// pay_type
		$this->pay_type = new crField('viewpaymentlog', 'viewpaymentlog', 'x_pay_type', 'pay_type', 'paymentlog.pay_type', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_type'] =& $this->pay_type;
		$this->pay_type->DateFilter = "";
		$this->pay_type->SqlSelect = "";
		$this->pay_type->SqlOrderBy = "";

		// t_code
		$this->t_code = new crField('viewpaymentlog', 'viewpaymentlog', 'x_t_code', 't_code', 'paymentlog.t_code', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";

		// village_id
		$this->village_id = new crField('viewpaymentlog', 'viewpaymentlog', 'x_village_id', 'village_id', 'paymentlog.village_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";

		// pay_detail
		$this->pay_detail = new crField('viewpaymentlog', 'viewpaymentlog', 'x_pay_detail', 'pay_detail', 'paymentlog.pay_detail', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['pay_detail'] =& $this->pay_detail;
		$this->pay_detail->DateFilter = "";
		$this->pay_detail->SqlSelect = "";
		$this->pay_detail->SqlOrderBy = "";

		// count_member
		$this->count_member = new crField('viewpaymentlog', 'viewpaymentlog', 'x_count_member', 'count_member', 'paymentlog.count_member', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->count_member->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['count_member'] =& $this->count_member;
		$this->count_member->DateFilter = "";
		$this->count_member->SqlSelect = "";
		$this->count_member->SqlOrderBy = "";

		// pay_rate
		$this->pay_rate = new crField('viewpaymentlog', 'viewpaymentlog', 'x_pay_rate', 'pay_rate', 'paymentlog.pay_rate', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_rate->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_rate'] =& $this->pay_rate;
		$this->pay_rate->DateFilter = "";
		$this->pay_rate->SqlSelect = "";
		$this->pay_rate->SqlOrderBy = "";

		// sub_total
		$this->sub_total = new crField('viewpaymentlog', 'viewpaymentlog', 'x_sub_total', 'sub_total', 'paymentlog.sub_total', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->sub_total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['sub_total'] =& $this->sub_total;
		$this->sub_total->DateFilter = "";
		$this->sub_total->SqlSelect = "";
		$this->sub_total->SqlOrderBy = "";

		// assc_rate
		$this->assc_rate = new crField('viewpaymentlog', 'viewpaymentlog', 'x_assc_rate', 'assc_rate', 'paymentlog.assc_rate', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->assc_rate->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['assc_rate'] =& $this->assc_rate;
		$this->assc_rate->DateFilter = "";
		$this->assc_rate->SqlSelect = "";
		$this->assc_rate->SqlOrderBy = "";

		// assc_total
		$this->assc_total = new crField('viewpaymentlog', 'viewpaymentlog', 'x_assc_total', 'assc_total', 'paymentlog.assc_total', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->assc_total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['assc_total'] =& $this->assc_total;
		$this->assc_total->DateFilter = "";
		$this->assc_total->SqlSelect = "";
		$this->assc_total->SqlOrderBy = "";

		// grand_total
		$this->grand_total = new crField('viewpaymentlog', 'viewpaymentlog', 'x_grand_total', 'grand_total', 'paymentlog.grand_total', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->grand_total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['grand_total'] =& $this->grand_total;
		$this->grand_total->DateFilter = "";
		$this->grand_total->SqlSelect = "";
		$this->grand_total->SqlOrderBy = "";

		// pay_note
		$this->pay_note = new crField('viewpaymentlog', 'viewpaymentlog', 'x_pay_note', 'pay_note', 'paymentlog.pay_note', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['pay_note'] =& $this->pay_note;
		$this->pay_note->DateFilter = "";
		$this->pay_note->SqlSelect = "";
		$this->pay_note->SqlOrderBy = "";

		// pay_date
		$this->pay_date = new crField('viewpaymentlog', 'viewpaymentlog', 'x_pay_date', 'pay_date', 'paymentlog.pay_date', 133, EWRPT_DATATYPE_DATE, 7);
		$this->pay_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['pay_date'] =& $this->pay_date;
		$this->pay_date->DateFilter = "";
		$this->pay_date->SqlSelect = "";
		$this->pay_date->SqlOrderBy = "";

		// pml_slipt_num
		$this->pml_slipt_num = new crField('viewpaymentlog', 'viewpaymentlog', 'x_pml_slipt_num', 'pml_slipt_num', 'paymentlog.pml_slipt_num', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pml_slipt_num->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pml_slipt_num'] =& $this->pml_slipt_num;
		$this->pml_slipt_num->DateFilter = "";
		$this->pml_slipt_num->SqlSelect = "";
		$this->pml_slipt_num->SqlOrderBy = "";

		// pt_title
		$this->pt_title = new crField('viewpaymentlog', 'viewpaymentlog', 'x_pt_title', 'pt_title', 'paymenttype.pt_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pt_title'] =& $this->pt_title;
		$this->pt_title->DateFilter = "";
		$this->pt_title->SqlSelect = "";
		$this->pt_title->SqlOrderBy = "";

		// t_title
		$this->t_title = new crField('viewpaymentlog', 'viewpaymentlog', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "";
		$this->t_title->SqlOrderBy = "";

		// v_title
		$this->v_title = new crField('viewpaymentlog', 'viewpaymentlog', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "";
		$this->v_title->SqlOrderBy = "";
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
$viewpaymentlog_rpt = new crviewpaymentlog_rpt();
$Page =& $viewpaymentlog_rpt;

// Page init
$viewpaymentlog_rpt->Page_Init();

// Page main
$viewpaymentlog_rpt->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($viewpaymentlog->Export == "") { ?>
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
<?php $viewpaymentlog_rpt->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $viewpaymentlog_rpt->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php if ($viewpaymentlog->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($viewpaymentlog->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php echo $viewpaymentlog->TableCaption() ?>
<?php if ($viewpaymentlog->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $viewpaymentlog_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
<?php } ?>
<br /><br />
<?php if ($viewpaymentlog->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($viewpaymentlog->Export == "") { ?>
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
<?php if ($viewpaymentlog->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="viewpaymentlogrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($viewpaymentlog_rpt->StartGrp, $viewpaymentlog_rpt->DisplayGrps, $viewpaymentlog_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="viewpaymentlogrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="viewpaymentlogrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="viewpaymentlogrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="viewpaymentlogrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($viewpaymentlog_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($viewpaymentlog_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($viewpaymentlog_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($viewpaymentlog_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($viewpaymentlog_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($viewpaymentlog_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($viewpaymentlog_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($viewpaymentlog_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($viewpaymentlog_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($viewpaymentlog_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($viewpaymentlog->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($viewpaymentlog->ExportAll && $viewpaymentlog->Export <> "") {
	$viewpaymentlog_rpt->StopGrp = $viewpaymentlog_rpt->TotalGrps;
} else {
	$viewpaymentlog_rpt->StopGrp = $viewpaymentlog_rpt->StartGrp + $viewpaymentlog_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($viewpaymentlog_rpt->StopGrp) > intval($viewpaymentlog_rpt->TotalGrps))
	$viewpaymentlog_rpt->StopGrp = $viewpaymentlog_rpt->TotalGrps;
$viewpaymentlog_rpt->RecCount = 0;

// Get first row
if ($viewpaymentlog_rpt->TotalGrps > 0) {
	$viewpaymentlog_rpt->GetRow(1);
	$viewpaymentlog_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $viewpaymentlog_rpt->GrpCount <= $viewpaymentlog_rpt->DisplayGrps) || $viewpaymentlog_rpt->ShowFirstHeader) {

	// Show header
	if ($viewpaymentlog_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->pay_type) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->pay_type->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->pay_type) ?>',1);"><?php echo $viewpaymentlog->pay_type->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->pay_type->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->pay_type->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->t_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->t_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->t_code) ?>',1);"><?php echo $viewpaymentlog->t_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->t_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->t_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->village_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->village_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->village_id) ?>',1);"><?php echo $viewpaymentlog->village_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->village_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->village_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->count_member) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->count_member->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->count_member) ?>',1);"><?php echo $viewpaymentlog->count_member->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->count_member->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->count_member->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->pay_rate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->pay_rate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->pay_rate) ?>',1);"><?php echo $viewpaymentlog->pay_rate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->pay_rate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->pay_rate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->sub_total) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->sub_total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->sub_total) ?>',1);"><?php echo $viewpaymentlog->sub_total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->sub_total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->sub_total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->assc_rate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->assc_rate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->assc_rate) ?>',1);"><?php echo $viewpaymentlog->assc_rate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->assc_rate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->assc_rate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->assc_total) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->assc_total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->assc_total) ?>',1);"><?php echo $viewpaymentlog->assc_total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->assc_total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->assc_total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->grand_total) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->grand_total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->grand_total) ?>',1);"><?php echo $viewpaymentlog->grand_total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->grand_total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->grand_total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->pay_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->pay_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->pay_date) ?>',1);"><?php echo $viewpaymentlog->pay_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->pay_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->pay_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->pml_slipt_num) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->pml_slipt_num->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->pml_slipt_num) ?>',1);"><?php echo $viewpaymentlog->pml_slipt_num->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->pml_slipt_num->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->pml_slipt_num->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->pt_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->pt_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->pt_title) ?>',1);"><?php echo $viewpaymentlog->pt_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->pt_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->pt_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->t_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->t_title) ?>',1);"><?php echo $viewpaymentlog->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewpaymentlog->SortUrl($viewpaymentlog->v_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewpaymentlog->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewpaymentlog->SortUrl($viewpaymentlog->v_title) ?>',1);"><?php echo $viewpaymentlog->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewpaymentlog->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewpaymentlog->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$viewpaymentlog_rpt->ShowFirstHeader = FALSE;
	}
	$viewpaymentlog_rpt->RecCount++;

		// Render detail row
		$viewpaymentlog->ResetCSS();
		$viewpaymentlog->RowType = EWRPT_ROWTYPE_DETAIL;
		$viewpaymentlog_rpt->RenderRow();
?>
	<tr<?php echo $viewpaymentlog->RowAttributes(); ?>>
		<td<?php echo $viewpaymentlog->pay_type->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->pay_type->ViewAttributes(); ?>><?php echo $viewpaymentlog->pay_type->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpaymentlog->t_code->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->t_code->ViewAttributes(); ?>><?php echo $viewpaymentlog->t_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpaymentlog->village_id->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->village_id->ViewAttributes(); ?>><?php echo $viewpaymentlog->village_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpaymentlog->count_member->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->count_member->ViewAttributes(); ?>><?php echo $viewpaymentlog->count_member->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpaymentlog->pay_rate->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->pay_rate->ViewAttributes(); ?>><?php echo $viewpaymentlog->pay_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpaymentlog->sub_total->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->sub_total->ViewAttributes(); ?>><?php echo $viewpaymentlog->sub_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpaymentlog->assc_rate->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->assc_rate->ViewAttributes(); ?>><?php echo $viewpaymentlog->assc_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpaymentlog->assc_total->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->assc_total->ViewAttributes(); ?>><?php echo $viewpaymentlog->assc_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpaymentlog->grand_total->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->grand_total->ViewAttributes(); ?>><?php echo $viewpaymentlog->grand_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpaymentlog->pay_date->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->pay_date->ViewAttributes(); ?>><?php echo $viewpaymentlog->pay_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpaymentlog->pml_slipt_num->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->pml_slipt_num->ViewAttributes(); ?>><?php echo $viewpaymentlog->pml_slipt_num->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpaymentlog->pt_title->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->pt_title->ViewAttributes(); ?>><?php echo $viewpaymentlog->pt_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpaymentlog->t_title->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->t_title->ViewAttributes(); ?>><?php echo $viewpaymentlog->t_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewpaymentlog->v_title->CellAttributes() ?>>
<div<?php echo $viewpaymentlog->v_title->ViewAttributes(); ?>><?php echo $viewpaymentlog->v_title->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$viewpaymentlog_rpt->AccumulateSummary();

		// Get next record
		$viewpaymentlog_rpt->GetRow(2);
	$viewpaymentlog_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($viewpaymentlog_rpt->TotalGrps > 0) { ?>
<?php if ($viewpaymentlog->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="viewpaymentlogrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($viewpaymentlog_rpt->StartGrp, $viewpaymentlog_rpt->DisplayGrps, $viewpaymentlog_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="viewpaymentlogrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="viewpaymentlogrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="viewpaymentlogrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="viewpaymentlogrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($viewpaymentlog_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($viewpaymentlog_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($viewpaymentlog_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($viewpaymentlog_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($viewpaymentlog_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($viewpaymentlog_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($viewpaymentlog_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($viewpaymentlog_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($viewpaymentlog_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($viewpaymentlog_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($viewpaymentlog->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($viewpaymentlog->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($viewpaymentlog->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($viewpaymentlog->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $viewpaymentlog_rpt->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($viewpaymentlog->Export == "") { ?>
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
$viewpaymentlog_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crviewpaymentlog_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'viewpaymentlog';

	// Page object name
	var $PageObjName = 'viewpaymentlog_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $viewpaymentlog;
		if ($viewpaymentlog->UseTokenInUrl) $PageUrl .= "t=" . $viewpaymentlog->TableVar . "&"; // Add page token
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
		global $viewpaymentlog;
		if ($viewpaymentlog->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($viewpaymentlog->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($viewpaymentlog->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crviewpaymentlog_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (viewpaymentlog)
		$GLOBALS["viewpaymentlog"] = new crviewpaymentlog();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'viewpaymentlog', TRUE);

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
		global $viewpaymentlog;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$viewpaymentlog->Export = $_GET["export"];
	}
	$gsExport = $viewpaymentlog->Export; // Get export parameter, used in header
	$gsExportFile = $viewpaymentlog->TableVar; // Get export file, used in header
	if ($viewpaymentlog->Export == "excel") {
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
		global $viewpaymentlog;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($viewpaymentlog->Export == "email") {
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
		global $viewpaymentlog;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 15;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

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
		$sSql = ewrpt_BuildReportSql($viewpaymentlog->SqlSelect(), $viewpaymentlog->SqlWhere(), $viewpaymentlog->SqlGroupBy(), $viewpaymentlog->SqlHaving(), $viewpaymentlog->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($viewpaymentlog->ExportAll && $viewpaymentlog->Export <> "")
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
		global $viewpaymentlog;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$viewpaymentlog->pay_type->setDbValue($rs->fields('pay_type'));
			$viewpaymentlog->t_code->setDbValue($rs->fields('t_code'));
			$viewpaymentlog->village_id->setDbValue($rs->fields('village_id'));
			$viewpaymentlog->pay_detail->setDbValue($rs->fields('pay_detail'));
			$viewpaymentlog->count_member->setDbValue($rs->fields('count_member'));
			$viewpaymentlog->pay_rate->setDbValue($rs->fields('pay_rate'));
			$viewpaymentlog->sub_total->setDbValue($rs->fields('sub_total'));
			$viewpaymentlog->assc_rate->setDbValue($rs->fields('assc_rate'));
			$viewpaymentlog->assc_total->setDbValue($rs->fields('assc_total'));
			$viewpaymentlog->grand_total->setDbValue($rs->fields('grand_total'));
			$viewpaymentlog->pay_note->setDbValue($rs->fields('pay_note'));
			$viewpaymentlog->pay_date->setDbValue($rs->fields('pay_date'));
			$viewpaymentlog->pml_slipt_num->setDbValue($rs->fields('pml_slipt_num'));
			$viewpaymentlog->pt_title->setDbValue($rs->fields('pt_title'));
			$viewpaymentlog->t_title->setDbValue($rs->fields('t_title'));
			$viewpaymentlog->v_title->setDbValue($rs->fields('v_title'));
			$this->Val[1] = $viewpaymentlog->pay_type->CurrentValue;
			$this->Val[2] = $viewpaymentlog->t_code->CurrentValue;
			$this->Val[3] = $viewpaymentlog->village_id->CurrentValue;
			$this->Val[4] = $viewpaymentlog->count_member->CurrentValue;
			$this->Val[5] = $viewpaymentlog->pay_rate->CurrentValue;
			$this->Val[6] = $viewpaymentlog->sub_total->CurrentValue;
			$this->Val[7] = $viewpaymentlog->assc_rate->CurrentValue;
			$this->Val[8] = $viewpaymentlog->assc_total->CurrentValue;
			$this->Val[9] = $viewpaymentlog->grand_total->CurrentValue;
			$this->Val[10] = $viewpaymentlog->pay_date->CurrentValue;
			$this->Val[11] = $viewpaymentlog->pml_slipt_num->CurrentValue;
			$this->Val[12] = $viewpaymentlog->pt_title->CurrentValue;
			$this->Val[13] = $viewpaymentlog->t_title->CurrentValue;
			$this->Val[14] = $viewpaymentlog->v_title->CurrentValue;
		} else {
			$viewpaymentlog->pay_type->setDbValue("");
			$viewpaymentlog->t_code->setDbValue("");
			$viewpaymentlog->village_id->setDbValue("");
			$viewpaymentlog->pay_detail->setDbValue("");
			$viewpaymentlog->count_member->setDbValue("");
			$viewpaymentlog->pay_rate->setDbValue("");
			$viewpaymentlog->sub_total->setDbValue("");
			$viewpaymentlog->assc_rate->setDbValue("");
			$viewpaymentlog->assc_total->setDbValue("");
			$viewpaymentlog->grand_total->setDbValue("");
			$viewpaymentlog->pay_note->setDbValue("");
			$viewpaymentlog->pay_date->setDbValue("");
			$viewpaymentlog->pml_slipt_num->setDbValue("");
			$viewpaymentlog->pt_title->setDbValue("");
			$viewpaymentlog->t_title->setDbValue("");
			$viewpaymentlog->v_title->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $viewpaymentlog;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$viewpaymentlog->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$viewpaymentlog->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $viewpaymentlog->getStartGroup();
			}
		} else {
			$this->StartGrp = $viewpaymentlog->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$viewpaymentlog->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$viewpaymentlog->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$viewpaymentlog->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $viewpaymentlog;

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
		global $viewpaymentlog;
		$this->StartGrp = 1;
		$viewpaymentlog->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $viewpaymentlog;
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
			$viewpaymentlog->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$viewpaymentlog->setStartGroup($this->StartGrp);
		} else {
			if ($viewpaymentlog->getGroupPerPage() <> "") {
				$this->DisplayGrps = $viewpaymentlog->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $viewpaymentlog;
		if ($viewpaymentlog->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($viewpaymentlog->SqlSelectCount(), $viewpaymentlog->SqlWhere(), $viewpaymentlog->SqlGroupBy(), $viewpaymentlog->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$viewpaymentlog->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($viewpaymentlog->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// pay_type
			$viewpaymentlog->pay_type->ViewValue = $viewpaymentlog->pay_type->Summary;

			// t_code
			$viewpaymentlog->t_code->ViewValue = $viewpaymentlog->t_code->Summary;

			// village_id
			$viewpaymentlog->village_id->ViewValue = $viewpaymentlog->village_id->Summary;

			// count_member
			$viewpaymentlog->count_member->ViewValue = $viewpaymentlog->count_member->Summary;

			// pay_rate
			$viewpaymentlog->pay_rate->ViewValue = $viewpaymentlog->pay_rate->Summary;

			// sub_total
			$viewpaymentlog->sub_total->ViewValue = $viewpaymentlog->sub_total->Summary;

			// assc_rate
			$viewpaymentlog->assc_rate->ViewValue = $viewpaymentlog->assc_rate->Summary;

			// assc_total
			$viewpaymentlog->assc_total->ViewValue = $viewpaymentlog->assc_total->Summary;

			// grand_total
			$viewpaymentlog->grand_total->ViewValue = $viewpaymentlog->grand_total->Summary;

			// pay_date
			$viewpaymentlog->pay_date->ViewValue = $viewpaymentlog->pay_date->Summary;
			$viewpaymentlog->pay_date->ViewValue = ewrpt_FormatDateTime($viewpaymentlog->pay_date->ViewValue, 7);

			// pml_slipt_num
			$viewpaymentlog->pml_slipt_num->ViewValue = $viewpaymentlog->pml_slipt_num->Summary;

			// pt_title
			$viewpaymentlog->pt_title->ViewValue = $viewpaymentlog->pt_title->Summary;

			// t_title
			$viewpaymentlog->t_title->ViewValue = $viewpaymentlog->t_title->Summary;

			// v_title
			$viewpaymentlog->v_title->ViewValue = $viewpaymentlog->v_title->Summary;
		} else {

			// pay_type
			$viewpaymentlog->pay_type->ViewValue = $viewpaymentlog->pay_type->CurrentValue;
			$viewpaymentlog->pay_type->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_code
			$viewpaymentlog->t_code->ViewValue = $viewpaymentlog->t_code->CurrentValue;
			$viewpaymentlog->t_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// village_id
			$viewpaymentlog->village_id->ViewValue = $viewpaymentlog->village_id->CurrentValue;
			$viewpaymentlog->village_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// count_member
			$viewpaymentlog->count_member->ViewValue = $viewpaymentlog->count_member->CurrentValue;
			$viewpaymentlog->count_member->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_rate
			$viewpaymentlog->pay_rate->ViewValue = $viewpaymentlog->pay_rate->CurrentValue;
			$viewpaymentlog->pay_rate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// sub_total
			$viewpaymentlog->sub_total->ViewValue = $viewpaymentlog->sub_total->CurrentValue;
			$viewpaymentlog->sub_total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// assc_rate
			$viewpaymentlog->assc_rate->ViewValue = $viewpaymentlog->assc_rate->CurrentValue;
			$viewpaymentlog->assc_rate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// assc_total
			$viewpaymentlog->assc_total->ViewValue = $viewpaymentlog->assc_total->CurrentValue;
			$viewpaymentlog->assc_total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// grand_total
			$viewpaymentlog->grand_total->ViewValue = $viewpaymentlog->grand_total->CurrentValue;
			$viewpaymentlog->grand_total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_date
			$viewpaymentlog->pay_date->ViewValue = $viewpaymentlog->pay_date->CurrentValue;
			$viewpaymentlog->pay_date->ViewValue = ewrpt_FormatDateTime($viewpaymentlog->pay_date->ViewValue, 7);
			$viewpaymentlog->pay_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pml_slipt_num
			$viewpaymentlog->pml_slipt_num->ViewValue = $viewpaymentlog->pml_slipt_num->CurrentValue;
			$viewpaymentlog->pml_slipt_num->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pt_title
			$viewpaymentlog->pt_title->ViewValue = $viewpaymentlog->pt_title->CurrentValue;
			$viewpaymentlog->pt_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_title
			$viewpaymentlog->t_title->ViewValue = $viewpaymentlog->t_title->CurrentValue;
			$viewpaymentlog->t_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_title
			$viewpaymentlog->v_title->ViewValue = $viewpaymentlog->v_title->CurrentValue;
			$viewpaymentlog->v_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// pay_type
		$viewpaymentlog->pay_type->HrefValue = "";

		// t_code
		$viewpaymentlog->t_code->HrefValue = "";

		// village_id
		$viewpaymentlog->village_id->HrefValue = "";

		// count_member
		$viewpaymentlog->count_member->HrefValue = "";

		// pay_rate
		$viewpaymentlog->pay_rate->HrefValue = "";

		// sub_total
		$viewpaymentlog->sub_total->HrefValue = "";

		// assc_rate
		$viewpaymentlog->assc_rate->HrefValue = "";

		// assc_total
		$viewpaymentlog->assc_total->HrefValue = "";

		// grand_total
		$viewpaymentlog->grand_total->HrefValue = "";

		// pay_date
		$viewpaymentlog->pay_date->HrefValue = "";

		// pml_slipt_num
		$viewpaymentlog->pml_slipt_num->HrefValue = "";

		// pt_title
		$viewpaymentlog->pt_title->HrefValue = "";

		// t_title
		$viewpaymentlog->t_title->HrefValue = "";

		// v_title
		$viewpaymentlog->v_title->HrefValue = "";

		// Call Row_Rendered event
		$viewpaymentlog->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $viewpaymentlog;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $viewpaymentlog;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$viewpaymentlog->setOrderBy("");
				$viewpaymentlog->setStartGroup(1);
				$viewpaymentlog->pay_type->setSort("");
				$viewpaymentlog->t_code->setSort("");
				$viewpaymentlog->village_id->setSort("");
				$viewpaymentlog->count_member->setSort("");
				$viewpaymentlog->pay_rate->setSort("");
				$viewpaymentlog->sub_total->setSort("");
				$viewpaymentlog->assc_rate->setSort("");
				$viewpaymentlog->assc_total->setSort("");
				$viewpaymentlog->grand_total->setSort("");
				$viewpaymentlog->pay_date->setSort("");
				$viewpaymentlog->pml_slipt_num->setSort("");
				$viewpaymentlog->pt_title->setSort("");
				$viewpaymentlog->t_title->setSort("");
				$viewpaymentlog->v_title->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$viewpaymentlog->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$viewpaymentlog->CurrentOrderType = @$_GET["ordertype"];
			$viewpaymentlog->UpdateSort($viewpaymentlog->pay_type); // pay_type
			$viewpaymentlog->UpdateSort($viewpaymentlog->t_code); // t_code
			$viewpaymentlog->UpdateSort($viewpaymentlog->village_id); // village_id
			$viewpaymentlog->UpdateSort($viewpaymentlog->count_member); // count_member
			$viewpaymentlog->UpdateSort($viewpaymentlog->pay_rate); // pay_rate
			$viewpaymentlog->UpdateSort($viewpaymentlog->sub_total); // sub_total
			$viewpaymentlog->UpdateSort($viewpaymentlog->assc_rate); // assc_rate
			$viewpaymentlog->UpdateSort($viewpaymentlog->assc_total); // assc_total
			$viewpaymentlog->UpdateSort($viewpaymentlog->grand_total); // grand_total
			$viewpaymentlog->UpdateSort($viewpaymentlog->pay_date); // pay_date
			$viewpaymentlog->UpdateSort($viewpaymentlog->pml_slipt_num); // pml_slipt_num
			$viewpaymentlog->UpdateSort($viewpaymentlog->pt_title); // pt_title
			$viewpaymentlog->UpdateSort($viewpaymentlog->t_title); // t_title
			$viewpaymentlog->UpdateSort($viewpaymentlog->v_title); // v_title
			$sSortSql = $viewpaymentlog->SortSql();
			$viewpaymentlog->setOrderBy($sSortSql);
			$viewpaymentlog->setStartGroup(1);
		}
		return $viewpaymentlog->getOrderBy();
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
