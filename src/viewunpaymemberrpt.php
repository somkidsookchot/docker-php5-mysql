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
$viewunpaymember = NULL;

//
// Table class for viewunpaymember
//
class crviewunpaymember {
	var $TableVar = 'viewunpaymember';
	var $TableName = 'viewunpaymember';
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
	var $prefix;
	var $fname;
	var $lname;
	var $member_code;
	var $pt_title;
	var $unit_rate;
	var $cal_status;
	var $invoice_senddate;
	var $invoice_duedate;
	var $notice_senddate;
	var $notice_duedate;
	var $v_title;
	var $v_code;
	var $t_title;
	var $t_code;
	var $adv_num;
	var $cal_detail;
	var $member_status;
	var $did;
	var $dname;
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
	function crviewunpaymember() {
		global $ReportLanguage;

		// prefix
		$this->prefix = new crField('viewunpaymember', 'viewunpaymember', 'x_prefix', 'prefix', 'members.prefix', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['prefix'] =& $this->prefix;
		$this->prefix->DateFilter = "";
		$this->prefix->SqlSelect = "";
		$this->prefix->SqlOrderBy = "";

		// fname
		$this->fname = new crField('viewunpaymember', 'viewunpaymember', 'x_fname', 'fname', 'members.fname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";

		// lname
		$this->lname = new crField('viewunpaymember', 'viewunpaymember', 'x_lname', 'lname', 'members.lname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";

		// member_code
		$this->member_code = new crField('viewunpaymember', 'viewunpaymember', 'x_member_code', 'member_code', 'subvcalculate.member_code', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";

		// pt_title
		$this->pt_title = new crField('viewunpaymember', 'viewunpaymember', 'x_pt_title', 'pt_title', 'paymenttype.pt_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pt_title'] =& $this->pt_title;
		$this->pt_title->DateFilter = "";
		$this->pt_title->SqlSelect = "";
		$this->pt_title->SqlOrderBy = "";

		// unit_rate
		$this->unit_rate = new crField('viewunpaymember', 'viewunpaymember', 'x_unit_rate', 'unit_rate', 'subvcalculate.unit_rate', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->unit_rate->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['unit_rate'] =& $this->unit_rate;
		$this->unit_rate->DateFilter = "";
		$this->unit_rate->SqlSelect = "";
		$this->unit_rate->SqlOrderBy = "";

		// cal_status
		$this->cal_status = new crField('viewunpaymember', 'viewunpaymember', 'x_cal_status', 'cal_status', 'subvcalculate.cal_status', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['cal_status'] =& $this->cal_status;
		$this->cal_status->DateFilter = "";
		$this->cal_status->SqlSelect = "";
		$this->cal_status->SqlOrderBy = "";

		// invoice_senddate
		$this->invoice_senddate = new crField('viewunpaymember', 'viewunpaymember', 'x_invoice_senddate', 'invoice_senddate', 'subvcalculate.invoice_senddate', 133, EWRPT_DATATYPE_DATE, 7);
		$this->invoice_senddate->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['invoice_senddate'] =& $this->invoice_senddate;
		$this->invoice_senddate->DateFilter = "";
		$this->invoice_senddate->SqlSelect = "";
		$this->invoice_senddate->SqlOrderBy = "";

		// invoice_duedate
		$this->invoice_duedate = new crField('viewunpaymember', 'viewunpaymember', 'x_invoice_duedate', 'invoice_duedate', 'subvcalculate.invoice_duedate', 133, EWRPT_DATATYPE_DATE, 7);
		$this->invoice_duedate->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['invoice_duedate'] =& $this->invoice_duedate;
		$this->invoice_duedate->DateFilter = "";
		$this->invoice_duedate->SqlSelect = "";
		$this->invoice_duedate->SqlOrderBy = "";

		// notice_senddate
		$this->notice_senddate = new crField('viewunpaymember', 'viewunpaymember', 'x_notice_senddate', 'notice_senddate', 'subvcalculate.notice_senddate', 133, EWRPT_DATATYPE_DATE, 7);
		$this->notice_senddate->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['notice_senddate'] =& $this->notice_senddate;
		$this->notice_senddate->DateFilter = "";
		$this->notice_senddate->SqlSelect = "";
		$this->notice_senddate->SqlOrderBy = "";

		// notice_duedate
		$this->notice_duedate = new crField('viewunpaymember', 'viewunpaymember', 'x_notice_duedate', 'notice_duedate', 'subvcalculate.notice_duedate', 133, EWRPT_DATATYPE_DATE, 7);
		$this->notice_duedate->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['notice_duedate'] =& $this->notice_duedate;
		$this->notice_duedate->DateFilter = "";
		$this->notice_duedate->SqlSelect = "";
		$this->notice_duedate->SqlOrderBy = "";

		// v_title
		$this->v_title = new crField('viewunpaymember', 'viewunpaymember', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "";
		$this->v_title->SqlOrderBy = "";

		// v_code
		$this->v_code = new crField('viewunpaymember', 'viewunpaymember', 'x_v_code', 'v_code', 'village.v_code', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->v_code->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['v_code'] =& $this->v_code;
		$this->v_code->DateFilter = "";
		$this->v_code->SqlSelect = "";
		$this->v_code->SqlOrderBy = "";

		// t_title
		$this->t_title = new crField('viewunpaymember', 'viewunpaymember', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "";
		$this->t_title->SqlOrderBy = "";

		// t_code
		$this->t_code = new crField('viewunpaymember', 'viewunpaymember', 'x_t_code', 't_code', 'tambon.t_code', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";

		// adv_num
		$this->adv_num = new crField('viewunpaymember', 'viewunpaymember', 'x_adv_num', 'adv_num', 'subvcalculate.adv_num', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->adv_num->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['adv_num'] =& $this->adv_num;
		$this->adv_num->DateFilter = "";
		$this->adv_num->SqlSelect = "";
		$this->adv_num->SqlOrderBy = "";

		// cal_detail
		$this->cal_detail = new crField('viewunpaymember', 'viewunpaymember', 'x_cal_detail', 'cal_detail', 'subvcalculate.cal_detail', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['cal_detail'] =& $this->cal_detail;
		$this->cal_detail->DateFilter = "";
		$this->cal_detail->SqlSelect = "";
		$this->cal_detail->SqlOrderBy = "";

		// member_status
		$this->member_status = new crField('viewunpaymember', 'viewunpaymember', 'x_member_status', 'member_status', 'members.member_status', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_status'] =& $this->member_status;
		$this->member_status->DateFilter = "";
		$this->member_status->SqlSelect = "";
		$this->member_status->SqlOrderBy = "";

		// did
		$this->did = new crField('viewunpaymember', 'viewunpaymember', 'x_did', 'did', '(Select members.dead_id From members Where members.member_code = subvcalculate.member_code)', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->did->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['did'] =& $this->did;
		$this->did->DateFilter = "";
		$this->did->SqlSelect = "";
		$this->did->SqlOrderBy = "";

		// dname
		$this->dname = new crField('viewunpaymember', 'viewunpaymember', 'x_dname', 'dname', '(Select members.fname From members Where members.member_code = subvcalculate.member_code)', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['dname'] =& $this->dname;
		$this->dname->DateFilter = "";
		$this->dname->SqlSelect = "";
		$this->dname->SqlOrderBy = "";
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
$viewunpaymember_rpt = new crviewunpaymember_rpt();
$Page =& $viewunpaymember_rpt;

// Page init
$viewunpaymember_rpt->Page_Init();

// Page main
$viewunpaymember_rpt->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($viewunpaymember->Export == "") { ?>
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
<?php $viewunpaymember_rpt->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $viewunpaymember_rpt->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php if ($viewunpaymember->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($viewunpaymember->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php echo $viewunpaymember->TableCaption() ?>
<?php if ($viewunpaymember->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $viewunpaymember_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
<?php } ?>
<br /><br />
<?php if ($viewunpaymember->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($viewunpaymember->Export == "") { ?>
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
<?php if ($viewunpaymember->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="viewunpaymemberrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($viewunpaymember_rpt->StartGrp, $viewunpaymember_rpt->DisplayGrps, $viewunpaymember_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="viewunpaymemberrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="viewunpaymemberrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="viewunpaymemberrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="viewunpaymemberrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($viewunpaymember_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($viewunpaymember_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($viewunpaymember_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($viewunpaymember_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($viewunpaymember_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($viewunpaymember_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($viewunpaymember_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($viewunpaymember_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($viewunpaymember_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($viewunpaymember_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($viewunpaymember->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($viewunpaymember->ExportAll && $viewunpaymember->Export <> "") {
	$viewunpaymember_rpt->StopGrp = $viewunpaymember_rpt->TotalGrps;
} else {
	$viewunpaymember_rpt->StopGrp = $viewunpaymember_rpt->StartGrp + $viewunpaymember_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($viewunpaymember_rpt->StopGrp) > intval($viewunpaymember_rpt->TotalGrps))
	$viewunpaymember_rpt->StopGrp = $viewunpaymember_rpt->TotalGrps;
$viewunpaymember_rpt->RecCount = 0;

// Get first row
if ($viewunpaymember_rpt->TotalGrps > 0) {
	$viewunpaymember_rpt->GetRow(1);
	$viewunpaymember_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $viewunpaymember_rpt->GrpCount <= $viewunpaymember_rpt->DisplayGrps) || $viewunpaymember_rpt->ShowFirstHeader) {

	// Show header
	if ($viewunpaymember_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->prefix) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->prefix->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->prefix) ?>',1);"><?php echo $viewunpaymember->prefix->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->prefix->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->prefix->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->fname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->fname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->fname) ?>',1);"><?php echo $viewunpaymember->fname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->fname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->fname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->lname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->lname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->lname) ?>',1);"><?php echo $viewunpaymember->lname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->lname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->lname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->member_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->member_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->member_code) ?>',1);"><?php echo $viewunpaymember->member_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->member_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->member_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->pt_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->pt_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->pt_title) ?>',1);"><?php echo $viewunpaymember->pt_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->pt_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->pt_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->unit_rate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->unit_rate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->unit_rate) ?>',1);"><?php echo $viewunpaymember->unit_rate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->unit_rate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->unit_rate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->cal_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->cal_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->cal_status) ?>',1);"><?php echo $viewunpaymember->cal_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->cal_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->cal_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->invoice_senddate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->invoice_senddate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->invoice_senddate) ?>',1);"><?php echo $viewunpaymember->invoice_senddate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->invoice_senddate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->invoice_senddate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->invoice_duedate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->invoice_duedate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->invoice_duedate) ?>',1);"><?php echo $viewunpaymember->invoice_duedate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->invoice_duedate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->invoice_duedate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->notice_senddate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->notice_senddate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->notice_senddate) ?>',1);"><?php echo $viewunpaymember->notice_senddate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->notice_senddate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->notice_senddate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->notice_duedate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->notice_duedate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->notice_duedate) ?>',1);"><?php echo $viewunpaymember->notice_duedate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->notice_duedate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->notice_duedate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->v_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->v_title) ?>',1);"><?php echo $viewunpaymember->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->v_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->v_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->v_code) ?>',1);"><?php echo $viewunpaymember->v_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->v_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->v_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->t_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->t_title) ?>',1);"><?php echo $viewunpaymember->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->adv_num) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->adv_num->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->adv_num) ?>',1);"><?php echo $viewunpaymember->adv_num->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->adv_num->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->adv_num->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->member_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->member_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->member_status) ?>',1);"><?php echo $viewunpaymember->member_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->member_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->member_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->did) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->did->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->did) ?>',1);"><?php echo $viewunpaymember->did->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->did->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->did->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewunpaymember->SortUrl($viewunpaymember->dname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewunpaymember->dname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewunpaymember->SortUrl($viewunpaymember->dname) ?>',1);"><?php echo $viewunpaymember->dname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewunpaymember->dname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewunpaymember->dname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$viewunpaymember_rpt->ShowFirstHeader = FALSE;
	}
	$viewunpaymember_rpt->RecCount++;

		// Render detail row
		$viewunpaymember->ResetCSS();
		$viewunpaymember->RowType = EWRPT_ROWTYPE_DETAIL;
		$viewunpaymember_rpt->RenderRow();
?>
	<tr<?php echo $viewunpaymember->RowAttributes(); ?>>
		<td<?php echo $viewunpaymember->prefix->CellAttributes() ?>>
<div<?php echo $viewunpaymember->prefix->ViewAttributes(); ?>><?php echo $viewunpaymember->prefix->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->fname->CellAttributes() ?>>
<div<?php echo $viewunpaymember->fname->ViewAttributes(); ?>><?php echo $viewunpaymember->fname->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->lname->CellAttributes() ?>>
<div<?php echo $viewunpaymember->lname->ViewAttributes(); ?>><?php echo $viewunpaymember->lname->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->member_code->CellAttributes() ?>>
<div<?php echo $viewunpaymember->member_code->ViewAttributes(); ?>><?php echo $viewunpaymember->member_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->pt_title->CellAttributes() ?>>
<div<?php echo $viewunpaymember->pt_title->ViewAttributes(); ?>><?php echo $viewunpaymember->pt_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->unit_rate->CellAttributes() ?>>
<div<?php echo $viewunpaymember->unit_rate->ViewAttributes(); ?>><?php echo $viewunpaymember->unit_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->cal_status->CellAttributes() ?>>
<div<?php echo $viewunpaymember->cal_status->ViewAttributes(); ?>><?php echo $viewunpaymember->cal_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->invoice_senddate->CellAttributes() ?>>
<div<?php echo $viewunpaymember->invoice_senddate->ViewAttributes(); ?>><?php echo $viewunpaymember->invoice_senddate->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->invoice_duedate->CellAttributes() ?>>
<div<?php echo $viewunpaymember->invoice_duedate->ViewAttributes(); ?>><?php echo $viewunpaymember->invoice_duedate->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->notice_senddate->CellAttributes() ?>>
<div<?php echo $viewunpaymember->notice_senddate->ViewAttributes(); ?>><?php echo $viewunpaymember->notice_senddate->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->notice_duedate->CellAttributes() ?>>
<div<?php echo $viewunpaymember->notice_duedate->ViewAttributes(); ?>><?php echo $viewunpaymember->notice_duedate->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->v_title->CellAttributes() ?>>
<div<?php echo $viewunpaymember->v_title->ViewAttributes(); ?>><?php echo $viewunpaymember->v_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->v_code->CellAttributes() ?>>
<div<?php echo $viewunpaymember->v_code->ViewAttributes(); ?>><?php echo $viewunpaymember->v_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->t_title->CellAttributes() ?>>
<div<?php echo $viewunpaymember->t_title->ViewAttributes(); ?>><?php echo $viewunpaymember->t_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->adv_num->CellAttributes() ?>>
<div<?php echo $viewunpaymember->adv_num->ViewAttributes(); ?>><?php echo $viewunpaymember->adv_num->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->member_status->CellAttributes() ?>>
<div<?php echo $viewunpaymember->member_status->ViewAttributes(); ?>><?php echo $viewunpaymember->member_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->did->CellAttributes() ?>>
<div<?php echo $viewunpaymember->did->ViewAttributes(); ?>><?php echo $viewunpaymember->did->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewunpaymember->dname->CellAttributes() ?>>
<div<?php echo $viewunpaymember->dname->ViewAttributes(); ?>><?php echo $viewunpaymember->dname->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$viewunpaymember_rpt->AccumulateSummary();

		// Get next record
		$viewunpaymember_rpt->GetRow(2);
	$viewunpaymember_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($viewunpaymember_rpt->TotalGrps > 0) { ?>
<?php if ($viewunpaymember->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="viewunpaymemberrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($viewunpaymember_rpt->StartGrp, $viewunpaymember_rpt->DisplayGrps, $viewunpaymember_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="viewunpaymemberrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="viewunpaymemberrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="viewunpaymemberrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="viewunpaymemberrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($viewunpaymember_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($viewunpaymember_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($viewunpaymember_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($viewunpaymember_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($viewunpaymember_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($viewunpaymember_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($viewunpaymember_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($viewunpaymember_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($viewunpaymember_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($viewunpaymember_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($viewunpaymember->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($viewunpaymember->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($viewunpaymember->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($viewunpaymember->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $viewunpaymember_rpt->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($viewunpaymember->Export == "") { ?>
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
$viewunpaymember_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crviewunpaymember_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'viewunpaymember';

	// Page object name
	var $PageObjName = 'viewunpaymember_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $viewunpaymember;
		if ($viewunpaymember->UseTokenInUrl) $PageUrl .= "t=" . $viewunpaymember->TableVar . "&"; // Add page token
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
		global $viewunpaymember;
		if ($viewunpaymember->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($viewunpaymember->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($viewunpaymember->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crviewunpaymember_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (viewunpaymember)
		$GLOBALS["viewunpaymember"] = new crviewunpaymember();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'viewunpaymember', TRUE);

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
		global $viewunpaymember;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$viewunpaymember->Export = $_GET["export"];
	}
	$gsExport = $viewunpaymember->Export; // Get export parameter, used in header
	$gsExportFile = $viewunpaymember->TableVar; // Get export file, used in header
	if ($viewunpaymember->Export == "excel") {
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
		global $viewunpaymember;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($viewunpaymember->Export == "email") {
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
		global $viewunpaymember;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 19;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

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
		$sSql = ewrpt_BuildReportSql($viewunpaymember->SqlSelect(), $viewunpaymember->SqlWhere(), $viewunpaymember->SqlGroupBy(), $viewunpaymember->SqlHaving(), $viewunpaymember->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($viewunpaymember->ExportAll && $viewunpaymember->Export <> "")
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
		global $viewunpaymember;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$viewunpaymember->prefix->setDbValue($rs->fields('prefix'));
			$viewunpaymember->fname->setDbValue($rs->fields('fname'));
			$viewunpaymember->lname->setDbValue($rs->fields('lname'));
			$viewunpaymember->member_code->setDbValue($rs->fields('member_code'));
			$viewunpaymember->pt_title->setDbValue($rs->fields('pt_title'));
			$viewunpaymember->unit_rate->setDbValue($rs->fields('unit_rate'));
			$viewunpaymember->cal_status->setDbValue($rs->fields('cal_status'));
			$viewunpaymember->invoice_senddate->setDbValue($rs->fields('invoice_senddate'));
			$viewunpaymember->invoice_duedate->setDbValue($rs->fields('invoice_duedate'));
			$viewunpaymember->notice_senddate->setDbValue($rs->fields('notice_senddate'));
			$viewunpaymember->notice_duedate->setDbValue($rs->fields('notice_duedate'));
			$viewunpaymember->v_title->setDbValue($rs->fields('v_title'));
			$viewunpaymember->v_code->setDbValue($rs->fields('v_code'));
			$viewunpaymember->t_title->setDbValue($rs->fields('t_title'));
			$viewunpaymember->t_code->setDbValue($rs->fields('t_code'));
			$viewunpaymember->adv_num->setDbValue($rs->fields('adv_num'));
			$viewunpaymember->cal_detail->setDbValue($rs->fields('cal_detail'));
			$viewunpaymember->member_status->setDbValue($rs->fields('member_status'));
			$viewunpaymember->did->setDbValue($rs->fields('did'));
			$viewunpaymember->dname->setDbValue($rs->fields('dname'));
			$this->Val[1] = $viewunpaymember->prefix->CurrentValue;
			$this->Val[2] = $viewunpaymember->fname->CurrentValue;
			$this->Val[3] = $viewunpaymember->lname->CurrentValue;
			$this->Val[4] = $viewunpaymember->member_code->CurrentValue;
			$this->Val[5] = $viewunpaymember->pt_title->CurrentValue;
			$this->Val[6] = $viewunpaymember->unit_rate->CurrentValue;
			$this->Val[7] = $viewunpaymember->cal_status->CurrentValue;
			$this->Val[8] = $viewunpaymember->invoice_senddate->CurrentValue;
			$this->Val[9] = $viewunpaymember->invoice_duedate->CurrentValue;
			$this->Val[10] = $viewunpaymember->notice_senddate->CurrentValue;
			$this->Val[11] = $viewunpaymember->notice_duedate->CurrentValue;
			$this->Val[12] = $viewunpaymember->v_title->CurrentValue;
			$this->Val[13] = $viewunpaymember->v_code->CurrentValue;
			$this->Val[14] = $viewunpaymember->t_title->CurrentValue;
			$this->Val[15] = $viewunpaymember->adv_num->CurrentValue;
			$this->Val[16] = $viewunpaymember->member_status->CurrentValue;
			$this->Val[17] = $viewunpaymember->did->CurrentValue;
			$this->Val[18] = $viewunpaymember->dname->CurrentValue;
		} else {
			$viewunpaymember->prefix->setDbValue("");
			$viewunpaymember->fname->setDbValue("");
			$viewunpaymember->lname->setDbValue("");
			$viewunpaymember->member_code->setDbValue("");
			$viewunpaymember->pt_title->setDbValue("");
			$viewunpaymember->unit_rate->setDbValue("");
			$viewunpaymember->cal_status->setDbValue("");
			$viewunpaymember->invoice_senddate->setDbValue("");
			$viewunpaymember->invoice_duedate->setDbValue("");
			$viewunpaymember->notice_senddate->setDbValue("");
			$viewunpaymember->notice_duedate->setDbValue("");
			$viewunpaymember->v_title->setDbValue("");
			$viewunpaymember->v_code->setDbValue("");
			$viewunpaymember->t_title->setDbValue("");
			$viewunpaymember->t_code->setDbValue("");
			$viewunpaymember->adv_num->setDbValue("");
			$viewunpaymember->cal_detail->setDbValue("");
			$viewunpaymember->member_status->setDbValue("");
			$viewunpaymember->did->setDbValue("");
			$viewunpaymember->dname->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $viewunpaymember;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$viewunpaymember->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$viewunpaymember->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $viewunpaymember->getStartGroup();
			}
		} else {
			$this->StartGrp = $viewunpaymember->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$viewunpaymember->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$viewunpaymember->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$viewunpaymember->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $viewunpaymember;

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
		global $viewunpaymember;
		$this->StartGrp = 1;
		$viewunpaymember->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $viewunpaymember;
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
			$viewunpaymember->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$viewunpaymember->setStartGroup($this->StartGrp);
		} else {
			if ($viewunpaymember->getGroupPerPage() <> "") {
				$this->DisplayGrps = $viewunpaymember->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $viewunpaymember;
		if ($viewunpaymember->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($viewunpaymember->SqlSelectCount(), $viewunpaymember->SqlWhere(), $viewunpaymember->SqlGroupBy(), $viewunpaymember->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$viewunpaymember->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($viewunpaymember->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// prefix
			$viewunpaymember->prefix->ViewValue = $viewunpaymember->prefix->Summary;

			// fname
			$viewunpaymember->fname->ViewValue = $viewunpaymember->fname->Summary;

			// lname
			$viewunpaymember->lname->ViewValue = $viewunpaymember->lname->Summary;

			// member_code
			$viewunpaymember->member_code->ViewValue = $viewunpaymember->member_code->Summary;

			// pt_title
			$viewunpaymember->pt_title->ViewValue = $viewunpaymember->pt_title->Summary;

			// unit_rate
			$viewunpaymember->unit_rate->ViewValue = $viewunpaymember->unit_rate->Summary;

			// cal_status
			$viewunpaymember->cal_status->ViewValue = $viewunpaymember->cal_status->Summary;

			// invoice_senddate
			$viewunpaymember->invoice_senddate->ViewValue = $viewunpaymember->invoice_senddate->Summary;
			$viewunpaymember->invoice_senddate->ViewValue = ewrpt_FormatDateTime($viewunpaymember->invoice_senddate->ViewValue, 7);

			// invoice_duedate
			$viewunpaymember->invoice_duedate->ViewValue = $viewunpaymember->invoice_duedate->Summary;
			$viewunpaymember->invoice_duedate->ViewValue = ewrpt_FormatDateTime($viewunpaymember->invoice_duedate->ViewValue, 7);

			// notice_senddate
			$viewunpaymember->notice_senddate->ViewValue = $viewunpaymember->notice_senddate->Summary;
			$viewunpaymember->notice_senddate->ViewValue = ewrpt_FormatDateTime($viewunpaymember->notice_senddate->ViewValue, 7);

			// notice_duedate
			$viewunpaymember->notice_duedate->ViewValue = $viewunpaymember->notice_duedate->Summary;
			$viewunpaymember->notice_duedate->ViewValue = ewrpt_FormatDateTime($viewunpaymember->notice_duedate->ViewValue, 7);

			// v_title
			$viewunpaymember->v_title->ViewValue = $viewunpaymember->v_title->Summary;

			// v_code
			$viewunpaymember->v_code->ViewValue = $viewunpaymember->v_code->Summary;

			// t_title
			$viewunpaymember->t_title->ViewValue = $viewunpaymember->t_title->Summary;

			// adv_num
			$viewunpaymember->adv_num->ViewValue = $viewunpaymember->adv_num->Summary;

			// member_status
			$viewunpaymember->member_status->ViewValue = $viewunpaymember->member_status->Summary;

			// did
			$viewunpaymember->did->ViewValue = $viewunpaymember->did->Summary;

			// dname
			$viewunpaymember->dname->ViewValue = $viewunpaymember->dname->Summary;
		} else {

			// prefix
			$viewunpaymember->prefix->ViewValue = $viewunpaymember->prefix->CurrentValue;
			$viewunpaymember->prefix->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$viewunpaymember->fname->ViewValue = $viewunpaymember->fname->CurrentValue;
			$viewunpaymember->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$viewunpaymember->lname->ViewValue = $viewunpaymember->lname->CurrentValue;
			$viewunpaymember->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_code
			$viewunpaymember->member_code->ViewValue = $viewunpaymember->member_code->CurrentValue;
			$viewunpaymember->member_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pt_title
			$viewunpaymember->pt_title->ViewValue = $viewunpaymember->pt_title->CurrentValue;
			$viewunpaymember->pt_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// unit_rate
			$viewunpaymember->unit_rate->ViewValue = $viewunpaymember->unit_rate->CurrentValue;
			$viewunpaymember->unit_rate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// cal_status
			$viewunpaymember->cal_status->ViewValue = $viewunpaymember->cal_status->CurrentValue;
			$viewunpaymember->cal_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// invoice_senddate
			$viewunpaymember->invoice_senddate->ViewValue = $viewunpaymember->invoice_senddate->CurrentValue;
			$viewunpaymember->invoice_senddate->ViewValue = ewrpt_FormatDateTime($viewunpaymember->invoice_senddate->ViewValue, 7);
			$viewunpaymember->invoice_senddate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// invoice_duedate
			$viewunpaymember->invoice_duedate->ViewValue = $viewunpaymember->invoice_duedate->CurrentValue;
			$viewunpaymember->invoice_duedate->ViewValue = ewrpt_FormatDateTime($viewunpaymember->invoice_duedate->ViewValue, 7);
			$viewunpaymember->invoice_duedate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// notice_senddate
			$viewunpaymember->notice_senddate->ViewValue = $viewunpaymember->notice_senddate->CurrentValue;
			$viewunpaymember->notice_senddate->ViewValue = ewrpt_FormatDateTime($viewunpaymember->notice_senddate->ViewValue, 7);
			$viewunpaymember->notice_senddate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// notice_duedate
			$viewunpaymember->notice_duedate->ViewValue = $viewunpaymember->notice_duedate->CurrentValue;
			$viewunpaymember->notice_duedate->ViewValue = ewrpt_FormatDateTime($viewunpaymember->notice_duedate->ViewValue, 7);
			$viewunpaymember->notice_duedate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_title
			$viewunpaymember->v_title->ViewValue = $viewunpaymember->v_title->CurrentValue;
			$viewunpaymember->v_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_code
			$viewunpaymember->v_code->ViewValue = $viewunpaymember->v_code->CurrentValue;
			$viewunpaymember->v_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_title
			$viewunpaymember->t_title->ViewValue = $viewunpaymember->t_title->CurrentValue;
			$viewunpaymember->t_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// adv_num
			$viewunpaymember->adv_num->ViewValue = $viewunpaymember->adv_num->CurrentValue;
			$viewunpaymember->adv_num->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_status
			$viewunpaymember->member_status->ViewValue = $viewunpaymember->member_status->CurrentValue;
			$viewunpaymember->member_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// did
			$viewunpaymember->did->ViewValue = $viewunpaymember->did->CurrentValue;
			$viewunpaymember->did->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dname
			$viewunpaymember->dname->ViewValue = $viewunpaymember->dname->CurrentValue;
			$viewunpaymember->dname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// prefix
		$viewunpaymember->prefix->HrefValue = "";

		// fname
		$viewunpaymember->fname->HrefValue = "";

		// lname
		$viewunpaymember->lname->HrefValue = "";

		// member_code
		$viewunpaymember->member_code->HrefValue = "";

		// pt_title
		$viewunpaymember->pt_title->HrefValue = "";

		// unit_rate
		$viewunpaymember->unit_rate->HrefValue = "";

		// cal_status
		$viewunpaymember->cal_status->HrefValue = "";

		// invoice_senddate
		$viewunpaymember->invoice_senddate->HrefValue = "";

		// invoice_duedate
		$viewunpaymember->invoice_duedate->HrefValue = "";

		// notice_senddate
		$viewunpaymember->notice_senddate->HrefValue = "";

		// notice_duedate
		$viewunpaymember->notice_duedate->HrefValue = "";

		// v_title
		$viewunpaymember->v_title->HrefValue = "";

		// v_code
		$viewunpaymember->v_code->HrefValue = "";

		// t_title
		$viewunpaymember->t_title->HrefValue = "";

		// adv_num
		$viewunpaymember->adv_num->HrefValue = "";

		// member_status
		$viewunpaymember->member_status->HrefValue = "";

		// did
		$viewunpaymember->did->HrefValue = "";

		// dname
		$viewunpaymember->dname->HrefValue = "";

		// Call Row_Rendered event
		$viewunpaymember->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $viewunpaymember;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $viewunpaymember;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$viewunpaymember->setOrderBy("");
				$viewunpaymember->setStartGroup(1);
				$viewunpaymember->prefix->setSort("");
				$viewunpaymember->fname->setSort("");
				$viewunpaymember->lname->setSort("");
				$viewunpaymember->member_code->setSort("");
				$viewunpaymember->pt_title->setSort("");
				$viewunpaymember->unit_rate->setSort("");
				$viewunpaymember->cal_status->setSort("");
				$viewunpaymember->invoice_senddate->setSort("");
				$viewunpaymember->invoice_duedate->setSort("");
				$viewunpaymember->notice_senddate->setSort("");
				$viewunpaymember->notice_duedate->setSort("");
				$viewunpaymember->v_title->setSort("");
				$viewunpaymember->v_code->setSort("");
				$viewunpaymember->t_title->setSort("");
				$viewunpaymember->adv_num->setSort("");
				$viewunpaymember->member_status->setSort("");
				$viewunpaymember->did->setSort("");
				$viewunpaymember->dname->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$viewunpaymember->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$viewunpaymember->CurrentOrderType = @$_GET["ordertype"];
			$viewunpaymember->UpdateSort($viewunpaymember->prefix); // prefix
			$viewunpaymember->UpdateSort($viewunpaymember->fname); // fname
			$viewunpaymember->UpdateSort($viewunpaymember->lname); // lname
			$viewunpaymember->UpdateSort($viewunpaymember->member_code); // member_code
			$viewunpaymember->UpdateSort($viewunpaymember->pt_title); // pt_title
			$viewunpaymember->UpdateSort($viewunpaymember->unit_rate); // unit_rate
			$viewunpaymember->UpdateSort($viewunpaymember->cal_status); // cal_status
			$viewunpaymember->UpdateSort($viewunpaymember->invoice_senddate); // invoice_senddate
			$viewunpaymember->UpdateSort($viewunpaymember->invoice_duedate); // invoice_duedate
			$viewunpaymember->UpdateSort($viewunpaymember->notice_senddate); // notice_senddate
			$viewunpaymember->UpdateSort($viewunpaymember->notice_duedate); // notice_duedate
			$viewunpaymember->UpdateSort($viewunpaymember->v_title); // v_title
			$viewunpaymember->UpdateSort($viewunpaymember->v_code); // v_code
			$viewunpaymember->UpdateSort($viewunpaymember->t_title); // t_title
			$viewunpaymember->UpdateSort($viewunpaymember->adv_num); // adv_num
			$viewunpaymember->UpdateSort($viewunpaymember->member_status); // member_status
			$viewunpaymember->UpdateSort($viewunpaymember->did); // did
			$viewunpaymember->UpdateSort($viewunpaymember->dname); // dname
			$sSortSql = $viewunpaymember->SortSql();
			$viewunpaymember->setOrderBy($sSortSql);
			$viewunpaymember->setStartGroup(1);
		}
		return $viewunpaymember->getOrderBy();
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
