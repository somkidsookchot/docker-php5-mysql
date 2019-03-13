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
$reportadvsubv = NULL;

//
// Table class for reportadvsubv
//
class crreportadvsubv {
	var $TableVar = 'reportadvsubv';
	var $TableName = 'reportadvsubv';
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
	var $v_title;
	var $v_code;
	var $t_title;
	var $member_code;
	var $fname;
	var $lname;
	var $balance;
	var $t_code;
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
	function crreportadvsubv() {
		global $ReportLanguage;

		// v_title
		$this->v_title = new crField('reportadvsubv', 'reportadvsubv', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->v_title->GroupingFieldId = 4;
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "SELECT DISTINCT village.v_title FROM " . $this->SqlFrom();
		$this->v_title->SqlOrderBy = "village.v_title";
		$this->v_title->FldGroupByType = "";
		$this->v_title->FldGroupInt = "0";
		$this->v_title->FldGroupSql = "";

		// v_code
		$this->v_code = new crField('reportadvsubv', 'reportadvsubv', 'x_v_code', 'v_code', 'village.v_code', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->v_code->GroupingFieldId = 3;
		$this->v_code->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['v_code'] =& $this->v_code;
		$this->v_code->DateFilter = "";
		$this->v_code->SqlSelect = "SELECT DISTINCT village.v_code FROM " . $this->SqlFrom();
		$this->v_code->SqlOrderBy = "village.v_code";
		$this->v_code->FldGroupByType = "";
		$this->v_code->FldGroupInt = "0";
		$this->v_code->FldGroupSql = "";

		// t_title
		$this->t_title = new crField('reportadvsubv', 'reportadvsubv', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->t_title->GroupingFieldId = 2;
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "SELECT DISTINCT tambon.t_title FROM " . $this->SqlFrom();
		$this->t_title->SqlOrderBy = "tambon.t_title";
		$this->t_title->FldGroupByType = "";
		$this->t_title->FldGroupInt = "0";
		$this->t_title->FldGroupSql = "";

		// member_code
		$this->member_code = new crField('reportadvsubv', 'reportadvsubv', 'x_member_code', 'member_code', 'members.member_code', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";
		$this->member_code->FldGroupByType = "";
		$this->member_code->FldGroupInt = "0";
		$this->member_code->FldGroupSql = "";

		// fname
		$this->fname = new crField('reportadvsubv', 'reportadvsubv', 'x_fname', 'fname', 'members.fname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";
		$this->fname->FldGroupByType = "";
		$this->fname->FldGroupInt = "0";
		$this->fname->FldGroupSql = "";

		// lname
		$this->lname = new crField('reportadvsubv', 'reportadvsubv', 'x_lname', 'lname', 'members.lname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";
		$this->lname->FldGroupByType = "";
		$this->lname->FldGroupInt = "0";
		$this->lname->FldGroupSql = "";

		// balance
		$this->balance = new crField('reportadvsubv', 'reportadvsubv', 'x_balance', 'balance', '((Select Sum(paymentsummary.pay_sum_total) From paymentsummary Where paymentsummary.member_code = members.member_code And paymentsummary.pay_sum_type = 2 Group By paymentsummary.pay_sum_type) - (Select IfNull((Select Sum(paymentsummary.pay_sum_total) From paymentsummary Where paymentsummary.member_code = members.member_code And paymentsummary.pay_sum_type = 1 Group By paymentsummary.pay_sum_type), 0)))', 5, EWRPT_DATATYPE_NUMBER, -1);
		$this->balance->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['balance'] =& $this->balance;
		$this->balance->DateFilter = "";
		$this->balance->SqlSelect = "";
		$this->balance->SqlOrderBy = "";
		$this->balance->FldGroupByType = "";
		$this->balance->FldGroupInt = "0";
		$this->balance->FldGroupSql = "";

		// t_code
		$this->t_code = new crField('reportadvsubv', 'reportadvsubv', 'x_t_code', 't_code', 'tambon.t_code', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->t_code->GroupingFieldId = 1;
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";
		$this->t_code->FldGroupByType = "";
		$this->t_code->FldGroupInt = "0";
		$this->t_code->FldGroupSql = "";

		// member_status
		$this->member_status = new crField('reportadvsubv', 'reportadvsubv', 'x_member_status', 'member_status', 'members.member_status', 200, EWRPT_DATATYPE_STRING, -1);
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
		return "tambon Inner Join village On tambon.t_code = village.t_code Inner Join members On village.village_id = members.village_id";
	}

	function SqlSelect() { // Select
		return "SELECT village.v_title, village.v_code, tambon.t_title, members.fname, members.lname, ((Select Sum(paymentsummary.pay_sum_total) From paymentsummary Where paymentsummary.member_code = members.member_code And paymentsummary.pay_sum_type = 2 Group By paymentsummary.pay_sum_type) - (Select IFNULL((Select Sum(paymentsummary.pay_sum_total) From paymentsummary Where paymentsummary.member_code = members.member_code And paymentsummary.pay_sum_type = 1 Group By paymentsummary.pay_sum_type),0))) As balance, tambon.t_code, members.member_code, members.member_status FROM " . $this->SqlFrom();
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
		return "tambon.t_code ASC, tambon.t_title ASC, village.v_code ASC, village.v_title ASC";
	}

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "tambon.t_code";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " AS `t_code` FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "tambon.t_code ASC";
	}

	function SqlSelectAgg() {
		return "SELECT SUM(((Select Sum(paymentsummary.pay_sum_total) From paymentsummary Where paymentsummary.member_code = members.member_code And paymentsummary.pay_sum_type = 2 Group By paymentsummary.pay_sum_type) - (Select IfNull((Select Sum(paymentsummary.pay_sum_total) From paymentsummary Where paymentsummary.member_code = members.member_code And paymentsummary.pay_sum_type = 1 Group By paymentsummary.pay_sum_type), 0)))) AS sum_balance FROM " . $this->SqlFrom();
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
$reportadvsubv_summary = new crreportadvsubv_summary();
$Page =& $reportadvsubv_summary;

// Page init
$reportadvsubv_summary->Page_Init();

// Page main
$reportadvsubv_summary->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($reportadvsubv->Export == "") { ?>
<script type="text/javascript">

// Create page object
var reportadvsubv_summary = new ewrpt_Page("reportadvsubv_summary");

// page properties
reportadvsubv_summary.PageID = "summary"; // page ID
reportadvsubv_summary.FormID = "freportadvsubvsummaryfilter"; // form ID
var EWRPT_PAGE_ID = reportadvsubv_summary.PageID;

// extend page with ValidateForm function
reportadvsubv_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
reportadvsubv_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
reportadvsubv_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
reportadvsubv_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $reportadvsubv_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $reportadvsubv_summary->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php if ($reportadvsubv->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($reportadvsubv->t_title, $reportadvsubv->t_title->FldType); ?>
ewrpt_CreatePopup("reportadvsubv_t_title", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportadvsubv->v_code, $reportadvsubv->v_code->FldType); ?>
ewrpt_CreatePopup("reportadvsubv_v_code", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportadvsubv->v_title, $reportadvsubv->v_title->FldType); ?>
ewrpt_CreatePopup("reportadvsubv_v_title", [<?php echo $jsdata ?>]);
</script>
<div id="reportadvsubv_t_title_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportadvsubv_v_code_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportadvsubv_v_title_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($reportadvsubv->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0" width="100%">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<div class="ewTitle"><?php if (!$_GET["export"]) { ?><img src="images/finance55x55.png" width="55" height="55" align="absmiddle" /><?php } ?><?php echo $reportadvsubv->TableCaption() ?></div>
<?php if ($reportadvsubv->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($reportadvsubv->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($reportadvsubv->Export == "") { ?>
<?php
if ($reportadvsubv->FilterPanelOption == 2 || ($reportadvsubv->FilterPanelOption == 3 && $reportadvsubv_summary->FilterApplied) || $reportadvsubv_summary->Filter == "0=101") {
	$sButtonImage = "phprptimages/collapse.png";
	$sDivDisplay = "";
} else {
	$sButtonImage = "phprptimages/expand.png";
	$sDivDisplay = " style=\"display: none;\"";
}
?>
<a href="javascript:ewrpt_ToggleFilterPanel();" style="text-decoration: none;"><img id="ewrptToggleFilterImg" src="<?php echo $sButtonImage ?>" alt=""  align="absmiddle" border="0"></a><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("Filters") ?> 
<?php if ($reportadvsubv_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="reportadvsubvsmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?> <a href="<?php echo $reportadvsubv_summary->ExportExcelUrl ?>"><img src="images/bt_export_excel.png" align="absmiddle" border="0"/></a></span><br />
<div id="ewrptExtFilterPanel"<?php echo $sDivDisplay ?>  class="listSearch">
<!-- Search form (begin) -->
<form name="freportadvsubvsummaryfilter" id="freportadvsubvsummaryfilter" action="reportadvsubvsmry.php" class="ewForm" onsubmit="return reportadvsubv_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportadvsubv->fname->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_fname" id="so1_fname" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_fname" id="sv1_fname" size="30" maxlength="45" value="<?php echo ewrpt_HtmlEncode($reportadvsubv->fname->SearchValue) ?>"<?php echo ($reportadvsubv_summary->ClearExtFilter == 'reportadvsubv_fname') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportadvsubv->lname->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_lname" id="so1_lname" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_lname" id="sv1_lname" size="30" maxlength="45" value="<?php echo ewrpt_HtmlEncode($reportadvsubv->lname->SearchValue) ?>"<?php echo ($reportadvsubv_summary->ClearExtFilter == 'reportadvsubv_lname') ? " class=\"ewInputCleared\"" : "" ?>>
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
<?php if ($reportadvsubv->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $reportadvsubv_summary->ShowFilterList() ?>
</div>

<?php } ?>
<div class="clear"></div><br />

<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($reportadvsubv->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="reportadvsubvsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportadvsubv_summary->StartGrp, $reportadvsubv_summary->DisplayGrps, $reportadvsubv_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportadvsubvsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportadvsubvsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportadvsubvsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportadvsubvsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($reportadvsubv_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportadvsubv_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportadvsubv_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportadvsubv_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportadvsubv_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportadvsubv_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportadvsubv_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportadvsubv_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportadvsubv_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportadvsubv_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportadvsubv->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($reportadvsubv->ExportAll && $reportadvsubv->Export <> "") {
	$reportadvsubv_summary->StopGrp = $reportadvsubv_summary->TotalGrps;
} else {
	$reportadvsubv_summary->StopGrp = $reportadvsubv_summary->StartGrp + $reportadvsubv_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($reportadvsubv_summary->StopGrp) > intval($reportadvsubv_summary->TotalGrps))
	$reportadvsubv_summary->StopGrp = $reportadvsubv_summary->TotalGrps;
$reportadvsubv_summary->RecCount = 0;

// Get first row
if ($reportadvsubv_summary->TotalGrps > 0) {
	$reportadvsubv_summary->GetGrpRow(1);
	$reportadvsubv_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $reportadvsubv_summary->GrpCount <= $reportadvsubv_summary->DisplayGrps) || $reportadvsubv_summary->ShowFirstHeader) {

	// Show header
	if ($reportadvsubv_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportadvsubv->SortUrl($reportadvsubv->t_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportadvsubv->t_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportadvsubv->SortUrl($reportadvsubv->t_code) ?>',1);"><?php echo $reportadvsubv->t_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportadvsubv->t_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportadvsubv->t_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportadvsubv->SortUrl($reportadvsubv->t_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportadvsubv->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportadvsubv->SortUrl($reportadvsubv->t_title) ?>',1);"><?php echo $reportadvsubv->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportadvsubv->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportadvsubv->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportadvsubv->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportadvsubv_t_title', false, '<?php echo $reportadvsubv->t_title->RangeFrom; ?>', '<?php echo $reportadvsubv->t_title->RangeTo; ?>');return false;" name="x_t_title<?php echo $reportadvsubv_summary->Cnt[0][0]; ?>" id="x_t_title<?php echo $reportadvsubv_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportadvsubv->SortUrl($reportadvsubv->v_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportadvsubv->v_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportadvsubv->SortUrl($reportadvsubv->v_code) ?>',1);"><?php echo $reportadvsubv->v_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportadvsubv->v_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportadvsubv->v_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportadvsubv->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportadvsubv_v_code', false, '<?php echo $reportadvsubv->v_code->RangeFrom; ?>', '<?php echo $reportadvsubv->v_code->RangeTo; ?>');return false;" name="x_v_code<?php echo $reportadvsubv_summary->Cnt[0][0]; ?>" id="x_v_code<?php echo $reportadvsubv_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportadvsubv->SortUrl($reportadvsubv->v_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportadvsubv->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportadvsubv->SortUrl($reportadvsubv->v_title) ?>',1);"><?php echo $reportadvsubv->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportadvsubv->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportadvsubv->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportadvsubv->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportadvsubv_v_title', false, '<?php echo $reportadvsubv->v_title->RangeFrom; ?>', '<?php echo $reportadvsubv->v_title->RangeTo; ?>');return false;" name="x_v_title<?php echo $reportadvsubv_summary->Cnt[0][0]; ?>" id="x_v_title<?php echo $reportadvsubv_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportadvsubv->SortUrl($reportadvsubv->member_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportadvsubv->member_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportadvsubv->SortUrl($reportadvsubv->member_code) ?>',1);"><?php echo $reportadvsubv->member_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportadvsubv->member_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportadvsubv->member_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportadvsubv->SortUrl($reportadvsubv->fname) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportadvsubv->fname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportadvsubv->SortUrl($reportadvsubv->fname) ?>',1);"><?php echo $reportadvsubv->fname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportadvsubv->fname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportadvsubv->fname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportadvsubv->SortUrl($reportadvsubv->lname) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportadvsubv->lname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportadvsubv->SortUrl($reportadvsubv->lname) ?>',1);"><?php echo $reportadvsubv->lname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportadvsubv->lname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportadvsubv->lname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportadvsubv->SortUrl($reportadvsubv->balance) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportadvsubv->balance->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportadvsubv->SortUrl($reportadvsubv->balance) ?>',1);"><?php echo $reportadvsubv->balance->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportadvsubv->balance->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportadvsubv->balance->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportadvsubv->SortUrl($reportadvsubv->member_status) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportadvsubv->member_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportadvsubv->SortUrl($reportadvsubv->member_status) ?>',1);"><?php echo $reportadvsubv->member_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportadvsubv->member_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportadvsubv->member_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$reportadvsubv_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($reportadvsubv->t_code, $reportadvsubv->SqlFirstGroupField(), $reportadvsubv->t_code->GroupValue());
	if ($reportadvsubv_summary->Filter != "")
		$sWhere = "($reportadvsubv_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($reportadvsubv->SqlSelect(), $reportadvsubv->SqlWhere(), $reportadvsubv->SqlGroupBy(), $reportadvsubv->SqlHaving(), $reportadvsubv->SqlOrderBy(), $sWhere, $reportadvsubv_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$reportadvsubv_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$reportadvsubv_summary->RecCount++;

		// Render detail row
		$reportadvsubv->ResetCSS();
		$reportadvsubv->RowType = EWRPT_ROWTYPE_DETAIL;
		$reportadvsubv_summary->RenderRow();
?>
	<tr<?php echo $reportadvsubv->RowAttributes(); ?>>
		<td<?php echo $reportadvsubv->t_code->CellAttributes(); ?>><div<?php echo $reportadvsubv->t_code->ViewAttributes(); ?>><?php echo $reportadvsubv->t_code->GroupViewValue; ?></div></td>
		<td<?php echo $reportadvsubv->t_title->CellAttributes(); ?>><div<?php echo $reportadvsubv->t_title->ViewAttributes(); ?>><?php echo $reportadvsubv->t_title->GroupViewValue; ?></div></td>
		<td<?php echo $reportadvsubv->v_code->CellAttributes(); ?>><div<?php echo $reportadvsubv->v_code->ViewAttributes(); ?>><?php echo $reportadvsubv->v_code->GroupViewValue; ?></div></td>
		<td<?php echo $reportadvsubv->v_title->CellAttributes(); ?>><div<?php echo $reportadvsubv->v_title->ViewAttributes(); ?>><?php echo $reportadvsubv->v_title->GroupViewValue; ?></div></td>
		<td<?php echo $reportadvsubv->member_code->CellAttributes() ?>>
<div<?php echo $reportadvsubv->member_code->ViewAttributes(); ?>><?php echo $reportadvsubv->member_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportadvsubv->fname->CellAttributes() ?>>
<div<?php echo $reportadvsubv->fname->ViewAttributes(); ?>><?php echo $reportadvsubv->fname->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportadvsubv->lname->CellAttributes() ?>>
<div<?php echo $reportadvsubv->lname->ViewAttributes(); ?>><?php echo $reportadvsubv->lname->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportadvsubv->balance->CellAttributes() ?>>
<div<?php echo $reportadvsubv->balance->ViewAttributes(); ?>><?php echo $reportadvsubv->balance->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportadvsubv->member_status->CellAttributes() ?>>
<div<?php echo $reportadvsubv->member_status->ViewAttributes(); ?>><?php echo $reportadvsubv->member_status->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$reportadvsubv_summary->AccumulateSummary();

		// Get next record
		$reportadvsubv_summary->GetRow(2);

		// Show Footers
?>
<?php
		if ($reportadvsubv_summary->ChkLvlBreak(4)) {
			$reportadvsubv->ResetCSS();
			$reportadvsubv->RowType = EWRPT_ROWTYPE_TOTAL;
			$reportadvsubv->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$reportadvsubv->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$reportadvsubv->RowGroupLevel = 4;
			$reportadvsubv_summary->RenderRow();
?>
	<tr<?php echo $reportadvsubv->RowAttributes(); ?>>
		<td<?php echo $reportadvsubv->t_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportadvsubv->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportadvsubv->v_code->CellAttributes() ?>>&nbsp;</td>
		<td colspan="6"<?php echo $reportadvsubv->v_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $reportadvsubv->v_title->FldCaption() ?>: <?php echo $reportadvsubv->v_title->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($reportadvsubv_summary->Cnt[4][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$reportadvsubv->ResetCSS();
			$reportadvsubv->balance->Count = $reportadvsubv_summary->Cnt[4][4];
			$reportadvsubv->balance->Summary = $reportadvsubv_summary->Smry[4][4]; // Load SUM
			$reportadvsubv->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$reportadvsubv_summary->RenderRow();
?>
	<tr<?php echo $reportadvsubv->RowAttributes(); ?>>
		<td<?php echo $reportadvsubv->t_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportadvsubv->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportadvsubv->v_code->CellAttributes() ?>>&nbsp;</td>
		<td colspan="1"<?php echo $reportadvsubv->v_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportadvsubv->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportadvsubv->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportadvsubv->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportadvsubv->v_title->CellAttributes() ?>>
<div<?php echo $reportadvsubv->balance->ViewAttributes(); ?>><?php echo $reportadvsubv->balance->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportadvsubv->v_title->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 4 summary
			$reportadvsubv_summary->ResetLevelSummary(4);
		} // End check level check
?>
<?php
		if ($reportadvsubv_summary->ChkLvlBreak(2)) {
			$reportadvsubv->ResetCSS();
			$reportadvsubv->RowType = EWRPT_ROWTYPE_TOTAL;
			$reportadvsubv->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$reportadvsubv->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$reportadvsubv->RowGroupLevel = 2;
			$reportadvsubv_summary->RenderRow();
?>
	<tr<?php echo $reportadvsubv->RowAttributes(); ?>>
		<td<?php echo $reportadvsubv->t_code->CellAttributes() ?>>&nbsp;</td>
		<td colspan="8"<?php echo $reportadvsubv->t_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $reportadvsubv->t_title->FldCaption() ?>: <?php echo $reportadvsubv->t_title->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($reportadvsubv_summary->Cnt[2][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$reportadvsubv->ResetCSS();
			$reportadvsubv->balance->Count = $reportadvsubv_summary->Cnt[2][4];
			$reportadvsubv->balance->Summary = $reportadvsubv_summary->Smry[2][4]; // Load SUM
			$reportadvsubv->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$reportadvsubv_summary->RenderRow();
?>
	<tr<?php echo $reportadvsubv->RowAttributes(); ?>>
		<td<?php echo $reportadvsubv->t_code->CellAttributes() ?>>&nbsp;</td>
		<td colspan="3"<?php echo $reportadvsubv->t_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportadvsubv->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportadvsubv->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportadvsubv->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportadvsubv->t_title->CellAttributes() ?>>
<div<?php echo $reportadvsubv->balance->ViewAttributes(); ?>><?php echo $reportadvsubv->balance->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportadvsubv->t_title->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 2 summary
			$reportadvsubv_summary->ResetLevelSummary(2);
		} // End check level check
?>
<?php
	} // End detail records loop
?>
<?php

	// Next group
	$reportadvsubv_summary->GetGrpRow(2);
	$reportadvsubv_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($reportadvsubv_summary->TotalGrps > 0) {
	$reportadvsubv->ResetCSS();
	$reportadvsubv->RowType = EWRPT_ROWTYPE_TOTAL;
	$reportadvsubv->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$reportadvsubv->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$reportadvsubv->RowAttrs["class"] = "ewRptGrandSummary";
	$reportadvsubv_summary->RenderRow();
?>
	<!-- tr><td colspan="9"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $reportadvsubv->RowAttributes(); ?>><td colspan="9"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($reportadvsubv_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
	$reportadvsubv->ResetCSS();
	$reportadvsubv->balance->Count = $reportadvsubv_summary->TotCount;
	$reportadvsubv->balance->Summary = $reportadvsubv_summary->GrandSmry[4]; // Load SUM
	$reportadvsubv->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportadvsubv->balance->CurrentValue = $reportadvsubv->balance->Summary;
	$reportadvsubv->RowAttrs["class"] = "ewRptGrandSummary";
	$reportadvsubv_summary->RenderRow();
?>
	<tr<?php echo $reportadvsubv->RowAttributes(); ?>>
		<td colspan="4" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportadvsubv->member_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportadvsubv->fname->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportadvsubv->lname->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportadvsubv->balance->CellAttributes() ?>>
<div<?php echo $reportadvsubv->balance->ViewAttributes(); ?>><?php echo $reportadvsubv->balance->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportadvsubv->member_status->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($reportadvsubv_summary->TotalGrps > 0) { ?>
<?php if ($reportadvsubv->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="reportadvsubvsmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportadvsubv_summary->StartGrp, $reportadvsubv_summary->DisplayGrps, $reportadvsubv_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportadvsubvsmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportadvsubvsmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportadvsubvsmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportadvsubvsmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($reportadvsubv_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportadvsubv_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportadvsubv_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportadvsubv_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportadvsubv_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportadvsubv_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportadvsubv_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportadvsubv_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportadvsubv_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportadvsubv_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportadvsubv->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($reportadvsubv->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($reportadvsubv->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($reportadvsubv->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $reportadvsubv_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($reportadvsubv->Export == "") { ?>
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
$reportadvsubv_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crreportadvsubv_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'reportadvsubv';

	// Page object name
	var $PageObjName = 'reportadvsubv_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $reportadvsubv;
		if ($reportadvsubv->UseTokenInUrl) $PageUrl .= "t=" . $reportadvsubv->TableVar . "&"; // Add page token
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
		global $reportadvsubv;
		if ($reportadvsubv->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($reportadvsubv->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($reportadvsubv->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crreportadvsubv_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (reportadvsubv)
		$GLOBALS["reportadvsubv"] = new crreportadvsubv();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'reportadvsubv', TRUE);

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
		global $reportadvsubv;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$reportadvsubv->Export = $_GET["export"];
	}
	$gsExport = $reportadvsubv->Export; // Get export parameter, used in header
	$gsExportFile = $reportadvsubv->TableVar; // Get export file, used in header
	if ($reportadvsubv->Export == "excel") {
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
		global $reportadvsubv;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($reportadvsubv->Export == "email") {
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
		global $reportadvsubv;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 6;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, TRUE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$reportadvsubv->t_title->SelectionList = "";
		$reportadvsubv->t_title->DefaultSelectionList = "";
		$reportadvsubv->t_title->ValueList = "";
		$reportadvsubv->v_code->SelectionList = "";
		$reportadvsubv->v_code->DefaultSelectionList = "";
		$reportadvsubv->v_code->ValueList = "";
		$reportadvsubv->v_title->SelectionList = "";
		$reportadvsubv->v_title->DefaultSelectionList = "";
		$reportadvsubv->v_title->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$reportadvsubv->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($reportadvsubv->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($reportadvsubv->SqlSelectGroup(), $reportadvsubv->SqlWhere(), $reportadvsubv->SqlGroupBy(), $reportadvsubv->SqlHaving(), $reportadvsubv->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($reportadvsubv->ExportAll && $reportadvsubv->Export <> "")
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
		global $reportadvsubv;
		switch ($lvl) {
			case 1:
				return (is_null($reportadvsubv->t_code->CurrentValue) && !is_null($reportadvsubv->t_code->OldValue)) ||
					(!is_null($reportadvsubv->t_code->CurrentValue) && is_null($reportadvsubv->t_code->OldValue)) ||
					($reportadvsubv->t_code->GroupValue() <> $reportadvsubv->t_code->GroupOldValue());
			case 2:
				return (is_null($reportadvsubv->t_title->CurrentValue) && !is_null($reportadvsubv->t_title->OldValue)) ||
					(!is_null($reportadvsubv->t_title->CurrentValue) && is_null($reportadvsubv->t_title->OldValue)) ||
					($reportadvsubv->t_title->GroupValue() <> $reportadvsubv->t_title->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
			case 3:
				return (is_null($reportadvsubv->v_code->CurrentValue) && !is_null($reportadvsubv->v_code->OldValue)) ||
					(!is_null($reportadvsubv->v_code->CurrentValue) && is_null($reportadvsubv->v_code->OldValue)) ||
					($reportadvsubv->v_code->GroupValue() <> $reportadvsubv->v_code->GroupOldValue()) || $this->ChkLvlBreak(2); // Recurse upper level
			case 4:
				return (is_null($reportadvsubv->v_title->CurrentValue) && !is_null($reportadvsubv->v_title->OldValue)) ||
					(!is_null($reportadvsubv->v_title->CurrentValue) && is_null($reportadvsubv->v_title->OldValue)) ||
					($reportadvsubv->v_title->GroupValue() <> $reportadvsubv->v_title->GroupOldValue()) || $this->ChkLvlBreak(3); // Recurse upper level
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
		global $reportadvsubv;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $reportadvsubv;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $reportadvsubv;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$reportadvsubv->t_code->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$reportadvsubv->t_code->setDbValue($rsgrp->fields('t_code'));
		if ($rsgrp->EOF) {
			$reportadvsubv->t_code->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $reportadvsubv;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$reportadvsubv->v_title->setDbValue($rs->fields('v_title'));
			$reportadvsubv->v_code->setDbValue($rs->fields('v_code'));
			$reportadvsubv->t_title->setDbValue($rs->fields('t_title'));
			$reportadvsubv->member_code->setDbValue($rs->fields('member_code'));
			$reportadvsubv->fname->setDbValue($rs->fields('fname'));
			$reportadvsubv->lname->setDbValue($rs->fields('lname'));
			$reportadvsubv->balance->setDbValue($rs->fields('balance'));
			if ($opt <> 1)
				$reportadvsubv->t_code->setDbValue($rs->fields('t_code'));
			$reportadvsubv->member_status->setDbValue($rs->fields('member_status'));
			$this->Val[1] = $reportadvsubv->member_code->CurrentValue;
			$this->Val[2] = $reportadvsubv->fname->CurrentValue;
			$this->Val[3] = $reportadvsubv->lname->CurrentValue;
			$this->Val[4] = $reportadvsubv->balance->CurrentValue;
			$this->Val[5] = $reportadvsubv->member_status->CurrentValue;
		} else {
			$reportadvsubv->v_title->setDbValue("");
			$reportadvsubv->v_code->setDbValue("");
			$reportadvsubv->t_title->setDbValue("");
			$reportadvsubv->member_code->setDbValue("");
			$reportadvsubv->fname->setDbValue("");
			$reportadvsubv->lname->setDbValue("");
			$reportadvsubv->balance->setDbValue("");
			$reportadvsubv->t_code->setDbValue("");
			$reportadvsubv->member_status->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $reportadvsubv;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$reportadvsubv->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$reportadvsubv->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $reportadvsubv->getStartGroup();
			}
		} else {
			$this->StartGrp = $reportadvsubv->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$reportadvsubv->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$reportadvsubv->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$reportadvsubv->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $reportadvsubv;

		// Initialize popup
		// Build distinct values for t_title

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportadvsubv->t_title->SqlSelect, $reportadvsubv->SqlWhere(), $reportadvsubv->SqlGroupBy(), $reportadvsubv->SqlHaving(), $reportadvsubv->t_title->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportadvsubv->t_title->setDbValue($rswrk->fields[0]);
			if (is_null($reportadvsubv->t_title->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportadvsubv->t_title->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportadvsubv->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportadvsubv->t_title,$reportadvsubv->t_title->GroupValue());
				ewrpt_SetupDistinctValues($reportadvsubv->t_title->ValueList, $reportadvsubv->t_title->GroupValue(), $reportadvsubv->t_title->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportadvsubv->t_title->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportadvsubv->t_title->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for v_code
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportadvsubv->v_code->SqlSelect, $reportadvsubv->SqlWhere(), $reportadvsubv->SqlGroupBy(), $reportadvsubv->SqlHaving(), $reportadvsubv->v_code->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportadvsubv->v_code->setDbValue($rswrk->fields[0]);
			if (is_null($reportadvsubv->v_code->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportadvsubv->v_code->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportadvsubv->v_code->GroupViewValue = ewrpt_DisplayGroupValue($reportadvsubv->v_code,$reportadvsubv->v_code->GroupValue());
				ewrpt_SetupDistinctValues($reportadvsubv->v_code->ValueList, $reportadvsubv->v_code->GroupValue(), $reportadvsubv->v_code->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportadvsubv->v_code->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportadvsubv->v_code->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for v_title
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportadvsubv->v_title->SqlSelect, $reportadvsubv->SqlWhere(), $reportadvsubv->SqlGroupBy(), $reportadvsubv->SqlHaving(), $reportadvsubv->v_title->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportadvsubv->v_title->setDbValue($rswrk->fields[0]);
			if (is_null($reportadvsubv->v_title->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportadvsubv->v_title->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportadvsubv->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportadvsubv->v_title,$reportadvsubv->v_title->GroupValue());
				ewrpt_SetupDistinctValues($reportadvsubv->v_title->ValueList, $reportadvsubv->v_title->GroupValue(), $reportadvsubv->v_title->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportadvsubv->v_title->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportadvsubv->v_title->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get ตำบล selected values

		if (is_array(@$_SESSION["sel_reportadvsubv_t_title"])) {
			$this->LoadSelectionFromSession('t_title');
		} elseif (@$_SESSION["sel_reportadvsubv_t_title"] == EWRPT_INIT_VALUE) { // Select all
			$reportadvsubv->t_title->SelectionList = "";
		}

		// Get หมู่ที่ selected values
		if (is_array(@$_SESSION["sel_reportadvsubv_v_code"])) {
			$this->LoadSelectionFromSession('v_code');
		} elseif (@$_SESSION["sel_reportadvsubv_v_code"] == EWRPT_INIT_VALUE) { // Select all
			$reportadvsubv->v_code->SelectionList = "";
		}

		// Get หมู่บ้าน selected values
		if (is_array(@$_SESSION["sel_reportadvsubv_v_title"])) {
			$this->LoadSelectionFromSession('v_title');
		} elseif (@$_SESSION["sel_reportadvsubv_v_title"] == EWRPT_INIT_VALUE) { // Select all
			$reportadvsubv->v_title->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $reportadvsubv;
		$this->StartGrp = 1;
		$reportadvsubv->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $reportadvsubv;
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
			$reportadvsubv->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$reportadvsubv->setStartGroup($this->StartGrp);
		} else {
			if ($reportadvsubv->getGroupPerPage() <> "") {
				$this->DisplayGrps = $reportadvsubv->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $reportadvsubv;
		if ($reportadvsubv->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($reportadvsubv->SqlSelectCount(), $reportadvsubv->SqlWhere(), $reportadvsubv->SqlGroupBy(), $reportadvsubv->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}

			// Get total from sql directly
			$sSql = ewrpt_BuildReportSql($reportadvsubv->SqlSelectAgg(), $reportadvsubv->SqlWhere(), $reportadvsubv->SqlGroupBy(), $reportadvsubv->SqlHaving(), "", $this->Filter, "");
			$sSql = $reportadvsubv->SqlAggPfx() . $sSql . $reportadvsubv->SqlAggSfx();
			$rsagg = $conn->Execute($sSql);
			if ($rsagg) {
				$this->GrandSmry[4] = $rsagg->fields("sum_balance");
				$rsagg->Close();
			} else {

				// Accumulate grand summary from detail records
				$sSql = ewrpt_BuildReportSql($reportadvsubv->SqlSelect(), $reportadvsubv->SqlWhere(), $reportadvsubv->SqlGroupBy(), $reportadvsubv->SqlHaving(), "", $this->Filter, "");
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
		$reportadvsubv->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($reportadvsubv->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// t_code
			$reportadvsubv->t_code->GroupViewValue = $reportadvsubv->t_code->GroupOldValue();
			$reportadvsubv->t_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportadvsubv->t_code->CellAttrs["class"] = ($reportadvsubv->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$reportadvsubv->t_code->GroupViewValue = ewrpt_DisplayGroupValue($reportadvsubv->t_code, $reportadvsubv->t_code->GroupViewValue);

			// t_title
			$reportadvsubv->t_title->GroupViewValue = $reportadvsubv->t_title->GroupOldValue();
			$reportadvsubv->t_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportadvsubv->t_title->CellAttrs["class"] = ($reportadvsubv->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";
			$reportadvsubv->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportadvsubv->t_title, $reportadvsubv->t_title->GroupViewValue);

			// v_code
			$reportadvsubv->v_code->GroupViewValue = $reportadvsubv->v_code->GroupOldValue();
			$reportadvsubv->v_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportadvsubv->v_code->CellAttrs["class"] = ($reportadvsubv->RowGroupLevel == 3) ? "ewRptGrpSummary3" : "ewRptGrpField3";
			$reportadvsubv->v_code->GroupViewValue = ewrpt_DisplayGroupValue($reportadvsubv->v_code, $reportadvsubv->v_code->GroupViewValue);

			// v_title
			$reportadvsubv->v_title->GroupViewValue = $reportadvsubv->v_title->GroupOldValue();
			$reportadvsubv->v_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportadvsubv->v_title->CellAttrs["class"] = ($reportadvsubv->RowGroupLevel == 4) ? "ewRptGrpSummary4" : "ewRptGrpField4";
			$reportadvsubv->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportadvsubv->v_title, $reportadvsubv->v_title->GroupViewValue);

			// member_code
			$reportadvsubv->member_code->ViewValue = $reportadvsubv->member_code->Summary;
			$reportadvsubv->member_code->CellAttrs["style"] = "white-space: nowrap;";

			// fname
			$reportadvsubv->fname->ViewValue = $reportadvsubv->fname->Summary;
			$reportadvsubv->fname->CellAttrs["style"] = "white-space: nowrap;";

			// lname
			$reportadvsubv->lname->ViewValue = $reportadvsubv->lname->Summary;
			$reportadvsubv->lname->CellAttrs["style"] = "white-space: nowrap;";

			// balance
			$reportadvsubv->balance->ViewValue = $reportadvsubv->balance->Summary;
			$reportadvsubv->balance->ViewValue = ewrpt_FormatCurrency($reportadvsubv->balance->ViewValue, 0, -2, -2, -2);
			$reportadvsubv->balance->CellAttrs["style"] = "white-space: nowrap;";

			// member_status
			$reportadvsubv->member_status->ViewValue = $reportadvsubv->member_status->Summary;
			$reportadvsubv->member_status->CellAttrs["style"] = "white-space: nowrap;";
		} else {

			// t_code
			$reportadvsubv->t_code->GroupViewValue = $reportadvsubv->t_code->GroupValue();
			$reportadvsubv->t_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportadvsubv->t_code->CellAttrs["class"] = "ewRptGrpField1";
			$reportadvsubv->t_code->GroupViewValue = ewrpt_DisplayGroupValue($reportadvsubv->t_code, $reportadvsubv->t_code->GroupViewValue);
			if ($reportadvsubv->t_code->GroupValue() == $reportadvsubv->t_code->GroupOldValue() && !$this->ChkLvlBreak(1))
				$reportadvsubv->t_code->GroupViewValue = "&nbsp;";

			// t_title
			$reportadvsubv->t_title->GroupViewValue = $reportadvsubv->t_title->GroupValue();
			$reportadvsubv->t_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportadvsubv->t_title->CellAttrs["class"] = "ewRptGrpField2";
			$reportadvsubv->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportadvsubv->t_title, $reportadvsubv->t_title->GroupViewValue);
			if ($reportadvsubv->t_title->GroupValue() == $reportadvsubv->t_title->GroupOldValue() && !$this->ChkLvlBreak(2))
				$reportadvsubv->t_title->GroupViewValue = "&nbsp;";

			// v_code
			$reportadvsubv->v_code->GroupViewValue = $reportadvsubv->v_code->GroupValue();
			$reportadvsubv->v_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportadvsubv->v_code->CellAttrs["class"] = "ewRptGrpField3";
			$reportadvsubv->v_code->GroupViewValue = ewrpt_DisplayGroupValue($reportadvsubv->v_code, $reportadvsubv->v_code->GroupViewValue);
			if ($reportadvsubv->v_code->GroupValue() == $reportadvsubv->v_code->GroupOldValue() && !$this->ChkLvlBreak(3))
				$reportadvsubv->v_code->GroupViewValue = "&nbsp;";

			// v_title
			$reportadvsubv->v_title->GroupViewValue = $reportadvsubv->v_title->GroupValue();
			$reportadvsubv->v_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportadvsubv->v_title->CellAttrs["class"] = "ewRptGrpField4";
			$reportadvsubv->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportadvsubv->v_title, $reportadvsubv->v_title->GroupViewValue);
			if ($reportadvsubv->v_title->GroupValue() == $reportadvsubv->v_title->GroupOldValue() && !$this->ChkLvlBreak(4))
				$reportadvsubv->v_title->GroupViewValue = "&nbsp;";

			// member_code
			$reportadvsubv->member_code->ViewValue = $reportadvsubv->member_code->CurrentValue;
			$reportadvsubv->member_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportadvsubv->member_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$reportadvsubv->fname->ViewValue = $reportadvsubv->fname->CurrentValue;
			$reportadvsubv->fname->CellAttrs["style"] = "white-space: nowrap;";
			$reportadvsubv->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$reportadvsubv->lname->ViewValue = $reportadvsubv->lname->CurrentValue;
			$reportadvsubv->lname->CellAttrs["style"] = "white-space: nowrap;";
			$reportadvsubv->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// balance
			$reportadvsubv->balance->ViewValue = $reportadvsubv->balance->CurrentValue;
			$reportadvsubv->balance->ViewValue = ewrpt_FormatCurrency($reportadvsubv->balance->ViewValue, 0, -2, -2, -2);
			$reportadvsubv->balance->CellAttrs["style"] = "white-space: nowrap;";
			$reportadvsubv->balance->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_status
			$reportadvsubv->member_status->ViewValue = $reportadvsubv->member_status->CurrentValue;
			$reportadvsubv->member_status->CellAttrs["style"] = "white-space: nowrap;";
			$reportadvsubv->member_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// t_code
		$reportadvsubv->t_code->HrefValue = "";

		// t_title
		$reportadvsubv->t_title->HrefValue = "";

		// v_code
		$reportadvsubv->v_code->HrefValue = "";

		// v_title
		$reportadvsubv->v_title->HrefValue = "";

		// member_code
		$reportadvsubv->member_code->HrefValue = "";

		// fname
		$reportadvsubv->fname->HrefValue = "";

		// lname
		$reportadvsubv->lname->HrefValue = "";

		// balance
		$reportadvsubv->balance->HrefValue = "";

		// member_status
		$reportadvsubv->member_status->HrefValue = "";

		// Call Row_Rendered event
		$reportadvsubv->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $reportadvsubv;
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $reportadvsubv;
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

			$this->SetSessionFilterValues($reportadvsubv->fname->SearchValue, $reportadvsubv->fname->SearchOperator, $reportadvsubv->fname->SearchCondition, $reportadvsubv->fname->SearchValue2, $reportadvsubv->fname->SearchOperator2, 'fname');

			// Field lname
			$this->SetSessionFilterValues($reportadvsubv->lname->SearchValue, $reportadvsubv->lname->SearchOperator, $reportadvsubv->lname->SearchCondition, $reportadvsubv->lname->SearchValue2, $reportadvsubv->lname->SearchOperator2, 'lname');
			$bSetupFilter = TRUE;
		} else {

			// Field fname
			if ($this->GetFilterValues($reportadvsubv->fname)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field lname
			if ($this->GetFilterValues($reportadvsubv->lname)) {
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
			$this->GetSessionFilterValues($reportadvsubv->fname);

			// Field lname
			$this->GetSessionFilterValues($reportadvsubv->lname);
		}

		// Call page filter validated event
		$reportadvsubv->Page_FilterValidated();

		// Build SQL
		// Field fname

		$this->BuildExtendedFilter($reportadvsubv->fname, $sFilter);

		// Field lname
		$this->BuildExtendedFilter($reportadvsubv->lname, $sFilter);

		// Save parms to session
		// Field fname

		$this->SetSessionFilterValues($reportadvsubv->fname->SearchValue, $reportadvsubv->fname->SearchOperator, $reportadvsubv->fname->SearchCondition, $reportadvsubv->fname->SearchValue2, $reportadvsubv->fname->SearchOperator2, 'fname');

		// Field lname
		$this->SetSessionFilterValues($reportadvsubv->lname->SearchValue, $reportadvsubv->lname->SearchOperator, $reportadvsubv->lname->SearchCondition, $reportadvsubv->lname->SearchValue2, $reportadvsubv->lname->SearchOperator2, 'lname');

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
		$this->GetSessionValue($fld->DropDownValue, 'sv_reportadvsubv_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_reportadvsubv_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_reportadvsubv_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_reportadvsubv_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_reportadvsubv_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_reportadvsubv_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_reportadvsubv_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_reportadvsubv_' . $parm] = $sv1;
		$_SESSION['so1_reportadvsubv_' . $parm] = $so1;
		$_SESSION['sc_reportadvsubv_' . $parm] = $sc;
		$_SESSION['sv2_reportadvsubv_' . $parm] = $sv2;
		$_SESSION['so2_reportadvsubv_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $reportadvsubv;

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
		$_SESSION["sel_reportadvsubv_$parm"] = "";
		$_SESSION["rf_reportadvsubv_$parm"] = "";
		$_SESSION["rt_reportadvsubv_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $reportadvsubv;
		$fld =& $reportadvsubv->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_reportadvsubv_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_reportadvsubv_$parm"];
		$fld->RangeTo = @$_SESSION["rt_reportadvsubv_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $reportadvsubv;

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
		$this->SetDefaultExtFilter($reportadvsubv->fname, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($reportadvsubv->fname);

		// Field lname
		$this->SetDefaultExtFilter($reportadvsubv->lname, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($reportadvsubv->lname);

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/

		// Field v_title
		// Setup your default values for the popup filter below, e.g.
		// $reportadvsubv->v_title->DefaultSelectionList = array("val1", "val2");

		$reportadvsubv->v_title->DefaultSelectionList = "";
		$reportadvsubv->v_title->SelectionList = $reportadvsubv->v_title->DefaultSelectionList;

		// Field v_code
		// Setup your default values for the popup filter below, e.g.
		// $reportadvsubv->v_code->DefaultSelectionList = array("val1", "val2");

		$reportadvsubv->v_code->DefaultSelectionList = "";
		$reportadvsubv->v_code->SelectionList = $reportadvsubv->v_code->DefaultSelectionList;

		// Field t_title
		// Setup your default values for the popup filter below, e.g.
		// $reportadvsubv->t_title->DefaultSelectionList = array("val1", "val2");

		$reportadvsubv->t_title->DefaultSelectionList = "";
		$reportadvsubv->t_title->SelectionList = $reportadvsubv->t_title->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $reportadvsubv;

		// Check v_title popup filter
		if (!ewrpt_MatchedArray($reportadvsubv->v_title->DefaultSelectionList, $reportadvsubv->v_title->SelectionList))
			return TRUE;

		// Check v_code popup filter
		if (!ewrpt_MatchedArray($reportadvsubv->v_code->DefaultSelectionList, $reportadvsubv->v_code->SelectionList))
			return TRUE;

		// Check t_title popup filter
		if (!ewrpt_MatchedArray($reportadvsubv->t_title->DefaultSelectionList, $reportadvsubv->t_title->SelectionList))
			return TRUE;

		// Check fname text filter
		if ($this->TextFilterApplied($reportadvsubv->fname))
			return TRUE;

		// Check lname text filter
		if ($this->TextFilterApplied($reportadvsubv->lname))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $reportadvsubv;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field v_title
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportadvsubv->v_title->SelectionList))
			$sWrk = ewrpt_JoinArray($reportadvsubv->v_title->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportadvsubv->v_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field v_code
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportadvsubv->v_code->SelectionList))
			$sWrk = ewrpt_JoinArray($reportadvsubv->v_code->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportadvsubv->v_code->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field t_title
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportadvsubv->t_title->SelectionList))
			$sWrk = ewrpt_JoinArray($reportadvsubv->t_title->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportadvsubv->t_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field fname
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($reportadvsubv->fname, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportadvsubv->fname->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field lname
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($reportadvsubv->lname, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportadvsubv->lname->FldCaption() . "<br />";
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
		global $reportadvsubv;
		$sWrk = "";
			if (is_array($reportadvsubv->v_title->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportadvsubv->v_title, "village.v_title", EWRPT_DATATYPE_STRING);
			}
			if (is_array($reportadvsubv->v_code->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportadvsubv->v_code, "village.v_code", EWRPT_DATATYPE_NUMBER);
			}
			if (is_array($reportadvsubv->t_title->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportadvsubv->t_title, "tambon.t_title", EWRPT_DATATYPE_STRING);
			}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $reportadvsubv;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$reportadvsubv->setOrderBy("");
				$reportadvsubv->setStartGroup(1);
				$reportadvsubv->t_code->setSort("");
				$reportadvsubv->t_title->setSort("");
				$reportadvsubv->v_code->setSort("");
				$reportadvsubv->v_title->setSort("");
				$reportadvsubv->member_code->setSort("");
				$reportadvsubv->fname->setSort("");
				$reportadvsubv->lname->setSort("");
				$reportadvsubv->balance->setSort("");
				$reportadvsubv->member_status->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$reportadvsubv->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$reportadvsubv->CurrentOrderType = @$_GET["ordertype"];
			$reportadvsubv->UpdateSort($reportadvsubv->t_code); // t_code
			$reportadvsubv->UpdateSort($reportadvsubv->t_title); // t_title
			$reportadvsubv->UpdateSort($reportadvsubv->v_code); // v_code
			$reportadvsubv->UpdateSort($reportadvsubv->v_title); // v_title
			$reportadvsubv->UpdateSort($reportadvsubv->member_code); // member_code
			$reportadvsubv->UpdateSort($reportadvsubv->fname); // fname
			$reportadvsubv->UpdateSort($reportadvsubv->lname); // lname
			$reportadvsubv->UpdateSort($reportadvsubv->balance); // balance
			$reportadvsubv->UpdateSort($reportadvsubv->member_status); // member_status
			$sSortSql = $reportadvsubv->SortSql();
			$reportadvsubv->setOrderBy($sSortSql);
			$reportadvsubv->setStartGroup(1);
		}
		return $reportadvsubv->getOrderBy();
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
