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
$reportvillge = NULL;

//
// Table class for reportvillge
//
class crreportvillge {
	var $TableVar = 'reportvillge';
	var $TableName = 'reportvillge';
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
	var $village_id;
	var $v_code;
	var $v_title;
	var $t_title;
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
	function crreportvillge() {
		global $ReportLanguage;

		// t_code
		$this->t_code = new crField('reportvillge', 'reportvillge', 'x_t_code', 't_code', 'tambon.t_code', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->t_code->GroupingFieldId = 1;
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";
		$this->t_code->FldGroupByType = "";
		$this->t_code->FldGroupInt = "0";
		$this->t_code->FldGroupSql = "";

		// village_id
		$this->village_id = new crField('reportvillge', 'reportvillge', 'x_village_id', 'village_id', 'village.village_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";
		$this->village_id->FldGroupByType = "";
		$this->village_id->FldGroupInt = "0";
		$this->village_id->FldGroupSql = "";

		// v_code
		$this->v_code = new crField('reportvillge', 'reportvillge', 'x_v_code', 'v_code', 'village.v_code', 3, EWRPT_DATATYPE_NUMBER, -1);
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
		$this->v_title = new crField('reportvillge', 'reportvillge', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->v_title->GroupingFieldId = 4;
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "SELECT DISTINCT village.v_title FROM " . $this->SqlFrom();
		$this->v_title->SqlOrderBy = "village.v_title";
		$this->v_title->FldGroupByType = "";
		$this->v_title->FldGroupInt = "0";
		$this->v_title->FldGroupSql = "";

		// t_title
		$this->t_title = new crField('reportvillge', 'reportvillge', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->t_title->GroupingFieldId = 2;
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "SELECT DISTINCT tambon.t_title FROM " . $this->SqlFrom();
		$this->t_title->SqlOrderBy = "tambon.t_title";
		$this->t_title->FldGroupByType = "";
		$this->t_title->FldGroupInt = "0";
		$this->t_title->FldGroupSql = "";
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
		return "tambon Inner Join village On tambon.t_code = village.t_code";
	}

	function SqlSelect() { // Select
		return "SELECT tambon.t_code, village.village_id, village.v_code, village.v_title, tambon.t_title FROM " . $this->SqlFrom();
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
		return "SELECT * FROM " . $this->SqlFrom();
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
$reportvillge_summary = new crreportvillge_summary();
$Page =& $reportvillge_summary;

// Page init
$reportvillge_summary->Page_Init();

// Page main
$reportvillge_summary->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($reportvillge->Export == "") { ?>
<script type="text/javascript">

// Create page object
var reportvillge_summary = new ewrpt_Page("reportvillge_summary");

// page properties
reportvillge_summary.PageID = "summary"; // page ID
reportvillge_summary.FormID = "freportvillgesummaryfilter"; // form ID
var EWRPT_PAGE_ID = reportvillge_summary.PageID;

// extend page with ValidateForm function
reportvillge_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
reportvillge_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
reportvillge_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
reportvillge_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $reportvillge_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $reportvillge_summary->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php if ($reportvillge->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($reportvillge->t_title, $reportvillge->t_title->FldType); ?>
ewrpt_CreatePopup("reportvillge_t_title", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportvillge->v_code, $reportvillge->v_code->FldType); ?>
ewrpt_CreatePopup("reportvillge_v_code", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportvillge->v_title, $reportvillge->v_title->FldType); ?>
ewrpt_CreatePopup("reportvillge_v_title", [<?php echo $jsdata ?>]);
</script>
<div id="reportvillge_t_title_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportvillge_v_code_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportvillge_v_title_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($reportvillge->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0" width="100%">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<div class="ewTitle"><?php if (!$_GET["export"]) { ?><img src="images/ico_village.png" width="40" height="40" align="absmiddle" /><?php } ?>
  <?php echo $reportvillge->TableCaption() ?></div>
<div class="clear"></div>
<?php if ($reportvillge->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($reportvillge->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
  <?php if ($reportvillge->Export == "") { ?>
  <?php
if ($reportvillge->FilterPanelOption == 2 || ($reportvillge->FilterPanelOption == 3 && $reportvillge_summary->FilterApplied) || $reportvillge_summary->Filter == "0=101") {
	$sButtonImage = "phprptimages/collapse.png";
	$sDivDisplay = "";
} else {
	$sButtonImage = "phprptimages/expand.png";
	$sDivDisplay = " style=\"display: none;\"";
}
?>
  <a href="javascript:ewrpt_ToggleFilterPanel();" style="text-decoration: none;"><img id="ewrptToggleFilterImg" src="<?php echo $sButtonImage ?>" alt="" align="absmiddle" border="0" /></a>&nbsp;<?php echo $ReportLanguage->Phrase("Filters") ?> 
  <?php if ($reportvillge_summary->FilterApplied) { ?>&nbsp;<a href="reportvillgesmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
  <?php } ?>&nbsp;<a href="<?php echo $reportvillge_summary->ExportExcelUrl ?>"><img src="images/bt_export_excel.png" align="absmiddle" border="0"/></a>
  <div id="ewrptExtFilterPanel"<?php echo $sDivDisplay ?> class="listSearch">
<!-- Search form (begin) -->
<form name="freportvillgesummaryfilter" id="freportvillgesummaryfilter" action="reportvillgesmry.php" class="ewForm" onsubmit="return reportvillge_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportvillge->t_title->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_t_title" id="sv_t_title"<?php echo ($reportvillge_summary->ClearExtFilter == 'reportvillge_t_title') ? " class=\"ewInputCleared\"" : "" ?> onchange="this.form.submit();">
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($reportvillge->t_title->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($reportvillge->t_title->CustomFilters) ? count($reportvillge->t_title->CustomFilters) : 0;
$cntd = is_array($reportvillge->t_title->DropDownList) ? count($reportvillge->t_title->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($reportvillge->t_title->CustomFilters[$i]->FldName == 't_title') {
?>
		<option value="<?php echo "@@" . $reportvillge->t_title->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($reportvillge->t_title->DropDownValue, "@@" . $reportvillge->t_title->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $reportvillge->t_title->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $reportvillge->t_title->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($reportvillge->t_title->DropDownValue, $reportvillge->t_title->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($reportvillge->t_title->DropDownList[$i], "", 0) ?></option>
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
<br />
<?php } ?>
<?php if ($reportvillge->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $reportvillge_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<div class="clear"></div><br />

<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($reportvillge->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="reportvillgesmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportvillge_summary->StartGrp, $reportvillge_summary->DisplayGrps, $reportvillge_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportvillgesmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportvillgesmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportvillgesmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportvillgesmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($reportvillge_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportvillge_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportvillge_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportvillge_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportvillge_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportvillge_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportvillge_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportvillge_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportvillge_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportvillge_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportvillge->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($reportvillge->ExportAll && $reportvillge->Export <> "") {
	$reportvillge_summary->StopGrp = $reportvillge_summary->TotalGrps;
} else {
	$reportvillge_summary->StopGrp = $reportvillge_summary->StartGrp + $reportvillge_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($reportvillge_summary->StopGrp) > intval($reportvillge_summary->TotalGrps))
	$reportvillge_summary->StopGrp = $reportvillge_summary->TotalGrps;
$reportvillge_summary->RecCount = 0;

// Get first row
if ($reportvillge_summary->TotalGrps > 0) {
	$reportvillge_summary->GetGrpRow(1);
	$reportvillge_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $reportvillge_summary->GrpCount <= $reportvillge_summary->DisplayGrps) || $reportvillge_summary->ShowFirstHeader) {

	// Show header
	if ($reportvillge_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportvillge->SortUrl($reportvillge->t_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportvillge->t_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportvillge->SortUrl($reportvillge->t_code) ?>',1);"><?php echo $reportvillge->t_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportvillge->t_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportvillge->t_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportvillge->SortUrl($reportvillge->t_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportvillge->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportvillge->SortUrl($reportvillge->t_title) ?>',1);"><?php echo $reportvillge->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportvillge->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportvillge->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportvillge->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportvillge_t_title', false, '<?php echo $reportvillge->t_title->RangeFrom; ?>', '<?php echo $reportvillge->t_title->RangeTo; ?>');return false;" name="x_t_title<?php echo $reportvillge_summary->Cnt[0][0]; ?>" id="x_t_title<?php echo $reportvillge_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportvillge->SortUrl($reportvillge->v_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportvillge->v_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportvillge->SortUrl($reportvillge->v_code) ?>',1);"><?php echo $reportvillge->v_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportvillge->v_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportvillge->v_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportvillge->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportvillge_v_code', false, '<?php echo $reportvillge->v_code->RangeFrom; ?>', '<?php echo $reportvillge->v_code->RangeTo; ?>');return false;" name="x_v_code<?php echo $reportvillge_summary->Cnt[0][0]; ?>" id="x_v_code<?php echo $reportvillge_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportvillge->SortUrl($reportvillge->v_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportvillge->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportvillge->SortUrl($reportvillge->v_title) ?>',1);"><?php echo $reportvillge->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportvillge->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportvillge->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportvillge->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportvillge_v_title', false, '<?php echo $reportvillge->v_title->RangeFrom; ?>', '<?php echo $reportvillge->v_title->RangeTo; ?>');return false;" name="x_v_title<?php echo $reportvillge_summary->Cnt[0][0]; ?>" id="x_v_title<?php echo $reportvillge_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportvillge->SortUrl($reportvillge->village_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportvillge->village_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportvillge->SortUrl($reportvillge->village_id) ?>',1);"><?php echo $reportvillge->village_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportvillge->village_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportvillge->village_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$reportvillge_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($reportvillge->t_code, $reportvillge->SqlFirstGroupField(), $reportvillge->t_code->GroupValue());
	if ($reportvillge_summary->Filter != "")
		$sWhere = "($reportvillge_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($reportvillge->SqlSelect(), $reportvillge->SqlWhere(), $reportvillge->SqlGroupBy(), $reportvillge->SqlHaving(), $reportvillge->SqlOrderBy(), $sWhere, $reportvillge_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$reportvillge_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$reportvillge_summary->RecCount++;

		// Render detail row
		$reportvillge->ResetCSS();
		$reportvillge->RowType = EWRPT_ROWTYPE_DETAIL;
		$reportvillge_summary->RenderRow();
?>
	<tr<?php echo $reportvillge->RowAttributes(); ?>>
		<td<?php echo $reportvillge->t_code->CellAttributes(); ?>><div<?php echo $reportvillge->t_code->ViewAttributes(); ?>><?php echo $reportvillge->t_code->GroupViewValue; ?></div></td>
		<td<?php echo $reportvillge->t_title->CellAttributes(); ?>><div<?php echo $reportvillge->t_title->ViewAttributes(); ?>><?php echo $reportvillge->t_title->GroupViewValue; ?></div></td>
		<td<?php echo $reportvillge->v_code->CellAttributes(); ?>><div<?php echo $reportvillge->v_code->ViewAttributes(); ?>><?php echo $reportvillge->v_code->GroupViewValue; ?></div></td>
		<td<?php echo $reportvillge->v_title->CellAttributes(); ?>><div<?php echo $reportvillge->v_title->ViewAttributes(); ?>><?php echo $reportvillge->v_title->GroupViewValue; ?></div></td>
		<td<?php echo $reportvillge->village_id->CellAttributes() ?>>
<div<?php echo $reportvillge->village_id->ViewAttributes(); ?>><?php echo $reportvillge->village_id->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$reportvillge_summary->AccumulateSummary();

		// Get next record
		$reportvillge_summary->GetRow(2);

		// Show Footers
?>
<?php
	} // End detail records loop
?>
<?php

	// Next group
	$reportvillge_summary->GetGrpRow(2);
	$reportvillge_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($reportvillge_summary->TotalGrps > 0) {
	$reportvillge->ResetCSS();
	$reportvillge->RowType = EWRPT_ROWTYPE_TOTAL;
	$reportvillge->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$reportvillge->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$reportvillge->RowAttrs["class"] = "ewRptGrandSummary";
	$reportvillge_summary->RenderRow();
?>
	<!-- tr><td colspan="5"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $reportvillge->RowAttributes(); ?>><td colspan="5"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($reportvillge_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($reportvillge_summary->TotalGrps > 0) { ?>
<?php if ($reportvillge->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="reportvillgesmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportvillge_summary->StartGrp, $reportvillge_summary->DisplayGrps, $reportvillge_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportvillgesmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportvillgesmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportvillgesmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportvillgesmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($reportvillge_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportvillge_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportvillge_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportvillge_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportvillge_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportvillge_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportvillge_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportvillge_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportvillge_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportvillge_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportvillge->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($reportvillge->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($reportvillge->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($reportvillge->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $reportvillge_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($reportvillge->Export == "") { ?>
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
$reportvillge_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crreportvillge_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'reportvillge';

	// Page object name
	var $PageObjName = 'reportvillge_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $reportvillge;
		if ($reportvillge->UseTokenInUrl) $PageUrl .= "t=" . $reportvillge->TableVar . "&"; // Add page token
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
		global $reportvillge;
		if ($reportvillge->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($reportvillge->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($reportvillge->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crreportvillge_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (reportvillge)
		$GLOBALS["reportvillge"] = new crreportvillge();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'reportvillge', TRUE);

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
		global $reportvillge;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$reportvillge->Export = $_GET["export"];
	}
	$gsExport = $reportvillge->Export; // Get export parameter, used in header
	$gsExportFile = $reportvillge->TableVar; // Get export file, used in header
	if ($reportvillge->Export == "excel") {
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
		global $reportvillge;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($reportvillge->Export == "email") {
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
		global $reportvillge;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 2;
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
		$this->Col = array(FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$reportvillge->t_title->SelectionList = "";
		$reportvillge->t_title->DefaultSelectionList = "";
		$reportvillge->t_title->ValueList = "";
		$reportvillge->v_code->SelectionList = "";
		$reportvillge->v_code->DefaultSelectionList = "";
		$reportvillge->v_code->ValueList = "";
		$reportvillge->v_title->SelectionList = "";
		$reportvillge->v_title->DefaultSelectionList = "";
		$reportvillge->v_title->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$reportvillge->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($reportvillge->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($reportvillge->SqlSelectGroup(), $reportvillge->SqlWhere(), $reportvillge->SqlGroupBy(), $reportvillge->SqlHaving(), $reportvillge->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($reportvillge->ExportAll && $reportvillge->Export <> "")
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
		global $reportvillge;
		switch ($lvl) {
			case 1:
				return (is_null($reportvillge->t_code->CurrentValue) && !is_null($reportvillge->t_code->OldValue)) ||
					(!is_null($reportvillge->t_code->CurrentValue) && is_null($reportvillge->t_code->OldValue)) ||
					($reportvillge->t_code->GroupValue() <> $reportvillge->t_code->GroupOldValue());
			case 2:
				return (is_null($reportvillge->t_title->CurrentValue) && !is_null($reportvillge->t_title->OldValue)) ||
					(!is_null($reportvillge->t_title->CurrentValue) && is_null($reportvillge->t_title->OldValue)) ||
					($reportvillge->t_title->GroupValue() <> $reportvillge->t_title->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
			case 3:
				return (is_null($reportvillge->v_code->CurrentValue) && !is_null($reportvillge->v_code->OldValue)) ||
					(!is_null($reportvillge->v_code->CurrentValue) && is_null($reportvillge->v_code->OldValue)) ||
					($reportvillge->v_code->GroupValue() <> $reportvillge->v_code->GroupOldValue()) || $this->ChkLvlBreak(2); // Recurse upper level
			case 4:
				return (is_null($reportvillge->v_title->CurrentValue) && !is_null($reportvillge->v_title->OldValue)) ||
					(!is_null($reportvillge->v_title->CurrentValue) && is_null($reportvillge->v_title->OldValue)) ||
					($reportvillge->v_title->GroupValue() <> $reportvillge->v_title->GroupOldValue()) || $this->ChkLvlBreak(3); // Recurse upper level
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
		global $reportvillge;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $reportvillge;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $reportvillge;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$reportvillge->t_code->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$reportvillge->t_code->setDbValue($rsgrp->fields('t_code'));
		if ($rsgrp->EOF) {
			$reportvillge->t_code->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $reportvillge;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			if ($opt <> 1)
				$reportvillge->t_code->setDbValue($rs->fields('t_code'));
			$reportvillge->village_id->setDbValue($rs->fields('village_id'));
			$reportvillge->v_code->setDbValue($rs->fields('v_code'));
			$reportvillge->v_title->setDbValue($rs->fields('v_title'));
			$reportvillge->t_title->setDbValue($rs->fields('t_title'));
			$this->Val[1] = $reportvillge->village_id->CurrentValue;
		} else {
			$reportvillge->t_code->setDbValue("");
			$reportvillge->village_id->setDbValue("");
			$reportvillge->v_code->setDbValue("");
			$reportvillge->v_title->setDbValue("");
			$reportvillge->t_title->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $reportvillge;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$reportvillge->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$reportvillge->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $reportvillge->getStartGroup();
			}
		} else {
			$this->StartGrp = $reportvillge->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$reportvillge->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$reportvillge->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$reportvillge->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $reportvillge;

		// Initialize popup
		// Build distinct values for t_title

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportvillge->t_title->SqlSelect, $reportvillge->SqlWhere(), $reportvillge->SqlGroupBy(), $reportvillge->SqlHaving(), $reportvillge->t_title->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportvillge->t_title->setDbValue($rswrk->fields[0]);
			if (is_null($reportvillge->t_title->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportvillge->t_title->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportvillge->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportvillge->t_title,$reportvillge->t_title->GroupValue());
				ewrpt_SetupDistinctValues($reportvillge->t_title->ValueList, $reportvillge->t_title->GroupValue(), $reportvillge->t_title->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportvillge->t_title->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportvillge->t_title->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for v_code
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportvillge->v_code->SqlSelect, $reportvillge->SqlWhere(), $reportvillge->SqlGroupBy(), $reportvillge->SqlHaving(), $reportvillge->v_code->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportvillge->v_code->setDbValue($rswrk->fields[0]);
			if (is_null($reportvillge->v_code->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportvillge->v_code->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportvillge->v_code->GroupViewValue = ewrpt_DisplayGroupValue($reportvillge->v_code,$reportvillge->v_code->GroupValue());
				ewrpt_SetupDistinctValues($reportvillge->v_code->ValueList, $reportvillge->v_code->GroupValue(), $reportvillge->v_code->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportvillge->v_code->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportvillge->v_code->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for v_title
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportvillge->v_title->SqlSelect, $reportvillge->SqlWhere(), $reportvillge->SqlGroupBy(), $reportvillge->SqlHaving(), $reportvillge->v_title->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportvillge->v_title->setDbValue($rswrk->fields[0]);
			if (is_null($reportvillge->v_title->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportvillge->v_title->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportvillge->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportvillge->v_title,$reportvillge->v_title->GroupValue());
				ewrpt_SetupDistinctValues($reportvillge->v_title->ValueList, $reportvillge->v_title->GroupValue(), $reportvillge->v_title->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportvillge->v_title->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportvillge->v_title->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
		// Get ชื่อตำบล selected values

		if (is_array(@$_SESSION["sel_reportvillge_t_title"])) {
			$this->LoadSelectionFromSession('t_title');
		} elseif (@$_SESSION["sel_reportvillge_t_title"] == EWRPT_INIT_VALUE) { // Select all
			$reportvillge->t_title->SelectionList = "";
		}

		// Get หมู่ที่ selected values
		if (is_array(@$_SESSION["sel_reportvillge_v_code"])) {
			$this->LoadSelectionFromSession('v_code');
		} elseif (@$_SESSION["sel_reportvillge_v_code"] == EWRPT_INIT_VALUE) { // Select all
			$reportvillge->v_code->SelectionList = "";
		}

		// Get ชื่อหมู่บ้าน selected values
		if (is_array(@$_SESSION["sel_reportvillge_v_title"])) {
			$this->LoadSelectionFromSession('v_title');
		} elseif (@$_SESSION["sel_reportvillge_v_title"] == EWRPT_INIT_VALUE) { // Select all
			$reportvillge->v_title->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $reportvillge;
		$this->StartGrp = 1;
		$reportvillge->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $reportvillge;
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
			$reportvillge->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$reportvillge->setStartGroup($this->StartGrp);
		} else {
			if ($reportvillge->getGroupPerPage() <> "") {
				$this->DisplayGrps = $reportvillge->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $reportvillge;
		if ($reportvillge->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($reportvillge->SqlSelectCount(), $reportvillge->SqlWhere(), $reportvillge->SqlGroupBy(), $reportvillge->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$reportvillge->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($reportvillge->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// t_code
			$reportvillge->t_code->GroupViewValue = $reportvillge->t_code->GroupOldValue();
			$reportvillge->t_code->CellAttrs["class"] = ($reportvillge->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$reportvillge->t_code->GroupViewValue = ewrpt_DisplayGroupValue($reportvillge->t_code, $reportvillge->t_code->GroupViewValue);

			// t_title
			$reportvillge->t_title->GroupViewValue = $reportvillge->t_title->GroupOldValue();
			$reportvillge->t_title->CellAttrs["class"] = ($reportvillge->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";
			$reportvillge->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportvillge->t_title, $reportvillge->t_title->GroupViewValue);

			// v_code
			$reportvillge->v_code->GroupViewValue = $reportvillge->v_code->GroupOldValue();
			$reportvillge->v_code->CellAttrs["class"] = ($reportvillge->RowGroupLevel == 3) ? "ewRptGrpSummary3" : "ewRptGrpField3";
			$reportvillge->v_code->GroupViewValue = ewrpt_DisplayGroupValue($reportvillge->v_code, $reportvillge->v_code->GroupViewValue);

			// v_title
			$reportvillge->v_title->GroupViewValue = $reportvillge->v_title->GroupOldValue();
			$reportvillge->v_title->CellAttrs["class"] = ($reportvillge->RowGroupLevel == 4) ? "ewRptGrpSummary4" : "ewRptGrpField4";
			$reportvillge->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportvillge->v_title, $reportvillge->v_title->GroupViewValue);

			// village_id
			$reportvillge->village_id->ViewValue = $reportvillge->village_id->Summary;
		} else {

			// t_code
			$reportvillge->t_code->GroupViewValue = $reportvillge->t_code->GroupValue();
			$reportvillge->t_code->CellAttrs["class"] = "ewRptGrpField1";
			$reportvillge->t_code->GroupViewValue = ewrpt_DisplayGroupValue($reportvillge->t_code, $reportvillge->t_code->GroupViewValue);
			if ($reportvillge->t_code->GroupValue() == $reportvillge->t_code->GroupOldValue() && !$this->ChkLvlBreak(1))
				$reportvillge->t_code->GroupViewValue = "&nbsp;";

			// t_title
			$reportvillge->t_title->GroupViewValue = $reportvillge->t_title->GroupValue();
			$reportvillge->t_title->CellAttrs["class"] = "ewRptGrpField2";
			$reportvillge->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportvillge->t_title, $reportvillge->t_title->GroupViewValue);
			if ($reportvillge->t_title->GroupValue() == $reportvillge->t_title->GroupOldValue() && !$this->ChkLvlBreak(2))
				$reportvillge->t_title->GroupViewValue = "&nbsp;";

			// v_code
			$reportvillge->v_code->GroupViewValue = $reportvillge->v_code->GroupValue();
			$reportvillge->v_code->CellAttrs["class"] = "ewRptGrpField3";
			$reportvillge->v_code->GroupViewValue = ewrpt_DisplayGroupValue($reportvillge->v_code, $reportvillge->v_code->GroupViewValue);
			if ($reportvillge->v_code->GroupValue() == $reportvillge->v_code->GroupOldValue() && !$this->ChkLvlBreak(3))
				$reportvillge->v_code->GroupViewValue = "&nbsp;";

			// v_title
			$reportvillge->v_title->GroupViewValue = $reportvillge->v_title->GroupValue();
			$reportvillge->v_title->CellAttrs["class"] = "ewRptGrpField4";
			$reportvillge->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportvillge->v_title, $reportvillge->v_title->GroupViewValue);
			if ($reportvillge->v_title->GroupValue() == $reportvillge->v_title->GroupOldValue() && !$this->ChkLvlBreak(4))
				$reportvillge->v_title->GroupViewValue = "&nbsp;";

			// village_id
			$reportvillge->village_id->ViewValue = $reportvillge->village_id->CurrentValue;
			$reportvillge->village_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// t_code
		$reportvillge->t_code->HrefValue = "";

		// t_title
		$reportvillge->t_title->HrefValue = "";

		// v_code
		$reportvillge->v_code->HrefValue = "";

		// v_title
		$reportvillge->v_title->HrefValue = "";

		// village_id
		$reportvillge->village_id->HrefValue = "";

		// Call Row_Rendered event
		$reportvillge->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $reportvillge;

		// Field t_title
		$sSelect = "SELECT DISTINCT tambon.t_title FROM " . $reportvillge->SqlFrom();
		$sOrderBy = "tambon.t_title ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $reportvillge->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$reportvillge->t_title->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $reportvillge;
		global $gsFormError;
		$sFilter = "";
		$bPostBack = ewrpt_IsHttpPost();
		$bRestoreSession = TRUE;
		$bSetupFilter = FALSE;

		// Reset extended filter if filter changed
		if ($bPostBack) {

			// Clear dropdown for field t_title
			if ($this->ClearExtFilter == 'reportvillge_t_title')
				$this->SetSessionDropDownValue(EWRPT_INIT_VALUE, 't_title');

		// Reset search command
		} elseif (@$_GET["cmd"] == "reset") {

			// Load default values
			// Field t_title

			$this->SetSessionDropDownValue($reportvillge->t_title->DropDownValue, 't_title');
			$bSetupFilter = TRUE;
		} else {

			// Field t_title
			if ($this->GetDropDownValue($reportvillge->t_title->DropDownValue, 't_title')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($reportvillge->t_title->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_reportvillge->t_title'])) {
				$bSetupFilter = TRUE;
			}
			if (!$this->ValidateForm()) {
				$this->setMessage($gsFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {

			// Field t_title
			$this->GetSessionDropDownValue($reportvillge->t_title);
		}

		// Call page filter validated event
		$reportvillge->Page_FilterValidated();

		// Build SQL
		// Field t_title

		$this->BuildDropDownFilter($reportvillge->t_title, $sFilter, "");

		// Save parms to session
		// Field t_title

		$this->SetSessionDropDownValue($reportvillge->t_title->DropDownValue, 't_title');

		// Setup filter
		if ($bSetupFilter) {

			// Field t_title
			$sWrk = "";
			$this->BuildDropDownFilter($reportvillge->t_title, $sWrk, "");
			$this->LoadSelectionFromFilter($reportvillge->t_title, $sWrk, $reportvillge->t_title->SelectionList);
			$_SESSION['sel_reportvillge_t_title'] = ($reportvillge->t_title->SelectionList == "") ? EWRPT_INIT_VALUE : $reportvillge->t_title->SelectionList;
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
		$this->GetSessionValue($fld->DropDownValue, 'sv_reportvillge_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_reportvillge_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_reportvillge_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_reportvillge_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_reportvillge_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_reportvillge_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_reportvillge_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_reportvillge_' . $parm] = $sv1;
		$_SESSION['so1_reportvillge_' . $parm] = $so1;
		$_SESSION['sc_reportvillge_' . $parm] = $sc;
		$_SESSION['sv2_reportvillge_' . $parm] = $sv2;
		$_SESSION['so2_reportvillge_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $reportvillge;

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
		$_SESSION["sel_reportvillge_$parm"] = "";
		$_SESSION["rf_reportvillge_$parm"] = "";
		$_SESSION["rt_reportvillge_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $reportvillge;
		$fld =& $reportvillge->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_reportvillge_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_reportvillge_$parm"];
		$fld->RangeTo = @$_SESSION["rt_reportvillge_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $reportvillge;

		/**
		* Set up default values for non Text filters
		*/

		// Field t_title
		$reportvillge->t_title->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$reportvillge->t_title->DropDownValue = $reportvillge->t_title->DefaultDropDownValue;
		$sWrk = "";
		$this->BuildDropDownFilter($reportvillge->t_title, $sWrk, "");
		$this->LoadSelectionFromFilter($reportvillge->t_title, $sWrk, $reportvillge->t_title->DefaultSelectionList);

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

		// Field v_code
		// Setup your default values for the popup filter below, e.g.
		// $reportvillge->v_code->DefaultSelectionList = array("val1", "val2");

		$reportvillge->v_code->DefaultSelectionList = "";
		$reportvillge->v_code->SelectionList = $reportvillge->v_code->DefaultSelectionList;

		// Field v_title
		// Setup your default values for the popup filter below, e.g.
		// $reportvillge->v_title->DefaultSelectionList = array("val1", "val2");

		$reportvillge->v_title->DefaultSelectionList = "";
		$reportvillge->v_title->SelectionList = $reportvillge->v_title->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $reportvillge;

		// Check v_code popup filter
		if (!ewrpt_MatchedArray($reportvillge->v_code->DefaultSelectionList, $reportvillge->v_code->SelectionList))
			return TRUE;

		// Check v_title popup filter
		if (!ewrpt_MatchedArray($reportvillge->v_title->DefaultSelectionList, $reportvillge->v_title->SelectionList))
			return TRUE;

		// Check t_title extended filter
		if ($this->NonTextFilterApplied($reportvillge->t_title))
			return TRUE;

		// Check t_title popup filter
		if (!ewrpt_MatchedArray($reportvillge->t_title->DefaultSelectionList, $reportvillge->t_title->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $reportvillge;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field v_code
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportvillge->v_code->SelectionList))
			$sWrk = ewrpt_JoinArray($reportvillge->v_code->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportvillge->v_code->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field v_title
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportvillge->v_title->SelectionList))
			$sWrk = ewrpt_JoinArray($reportvillge->v_title->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportvillge->v_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field t_title
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($reportvillge->t_title, $sExtWrk, "");
		if (is_array($reportvillge->t_title->SelectionList))
			$sWrk = ewrpt_JoinArray($reportvillge->t_title->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportvillge->t_title->FldCaption() . "<br />";
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
		global $reportvillge;
		$sWrk = "";
			if (is_array($reportvillge->v_code->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportvillge->v_code, "village.v_code", EWRPT_DATATYPE_NUMBER);
			}
			if (is_array($reportvillge->v_title->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportvillge->v_title, "village.v_title", EWRPT_DATATYPE_STRING);
			}
		if (!$this->DropDownFilterExist($reportvillge->t_title, "")) {
			if (is_array($reportvillge->t_title->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportvillge->t_title, "tambon.t_title", EWRPT_DATATYPE_STRING);
			}
		}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $reportvillge;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$reportvillge->setOrderBy("");
				$reportvillge->setStartGroup(1);
				$reportvillge->t_code->setSort("");
				$reportvillge->t_title->setSort("");
				$reportvillge->v_code->setSort("");
				$reportvillge->v_title->setSort("");
				$reportvillge->village_id->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$reportvillge->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$reportvillge->CurrentOrderType = @$_GET["ordertype"];
			$reportvillge->UpdateSort($reportvillge->t_code); // t_code
			$reportvillge->UpdateSort($reportvillge->t_title); // t_title
			$reportvillge->UpdateSort($reportvillge->v_code); // v_code
			$reportvillge->UpdateSort($reportvillge->v_title); // v_title
			$reportvillge->UpdateSort($reportvillge->village_id); // village_id
			$sSortSql = $reportvillge->SortSql();
			$reportvillge->setOrderBy($sSortSql);
			$reportvillge->setStartGroup(1);
		}

		// Set up default sort
		if ($reportvillge->getOrderBy() == "") {
			$reportvillge->setOrderBy("village.village_id ASC");
			$reportvillge->village_id->setSort("ASC");
		}
		return $reportvillge->getOrderBy();
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
