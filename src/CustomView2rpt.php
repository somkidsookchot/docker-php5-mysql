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
$CustomView2 = NULL;

//
// Table class for CustomView2
//
class crCustomView2 {
	var $TableVar = 'CustomView2';
	var $TableName = 'CustomView2';
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
	var $t_code;
	var $v_code;
	var $v_title;
	var $t_title;
	var $village_id;
	var $cal_type;
	var $total;
	var $pt_title;
	var $cal_date;
	var $cal_status;
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
	function crCustomView2() {
		global $ReportLanguage;

		// t_code
		$this->t_code = new crField('CustomView2', 'CustomView2', 'x_t_code', 't_code', 'tambon.t_code', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";

		// v_code
		$this->v_code = new crField('CustomView2', 'CustomView2', 'x_v_code', 'v_code', 'village.v_code', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->v_code->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['v_code'] =& $this->v_code;
		$this->v_code->DateFilter = "";
		$this->v_code->SqlSelect = "";
		$this->v_code->SqlOrderBy = "";

		// v_title
		$this->v_title = new crField('CustomView2', 'CustomView2', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "";
		$this->v_title->SqlOrderBy = "";

		// t_title
		$this->t_title = new crField('CustomView2', 'CustomView2', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "";
		$this->t_title->SqlOrderBy = "";

		// village_id
		$this->village_id = new crField('CustomView2', 'CustomView2', 'x_village_id', 'village_id', 'village.village_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";

		// cal_type
		$this->cal_type = new crField('CustomView2', 'CustomView2', 'x_cal_type', 'cal_type', 'subvcalculate.cal_type', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->cal_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['cal_type'] =& $this->cal_type;
		$this->cal_type->DateFilter = "";
		$this->cal_type->SqlSelect = "";
		$this->cal_type->SqlOrderBy = "";

		// total
		$this->total = new crField('CustomView2', 'CustomView2', 'x_total', 'total', 'subvcalculate.total', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['total'] =& $this->total;
		$this->total->DateFilter = "";
		$this->total->SqlSelect = "";
		$this->total->SqlOrderBy = "";

		// pt_title
		$this->pt_title = new crField('CustomView2', 'CustomView2', 'x_pt_title', 'pt_title', 'paymenttype.pt_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pt_title'] =& $this->pt_title;
		$this->pt_title->DateFilter = "";
		$this->pt_title->SqlSelect = "";
		$this->pt_title->SqlOrderBy = "";

		// cal_date
		$this->cal_date = new crField('CustomView2', 'CustomView2', 'x_cal_date', 'cal_date', 'subvcalculate.cal_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->cal_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['cal_date'] =& $this->cal_date;
		$this->cal_date->DateFilter = "";
		$this->cal_date->SqlSelect = "";
		$this->cal_date->SqlOrderBy = "";

		// cal_status
		$this->cal_status = new crField('CustomView2', 'CustomView2', 'x_cal_status', 'cal_status', 'subvcalculate.cal_status', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['cal_status'] =& $this->cal_status;
		$this->cal_status->DateFilter = "";
		$this->cal_status->SqlSelect = "";
		$this->cal_status->SqlOrderBy = "";
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
		return "tambon Inner Join village On tambon.t_code = village.t_code Inner Join subvcalculate On village.village_id = subvcalculate.village_id Inner Join paymenttype On subvcalculate.cal_type = paymenttype.pt_id";
	}

	function SqlSelect() { // Select
		return "SELECT tambon.t_code, village.v_code, village.v_title, tambon.t_title, village.village_id, subvcalculate.cal_type, subvcalculate.total, paymenttype.pt_title, subvcalculate.cal_date, subvcalculate.cal_status FROM " . $this->SqlFrom();
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
$CustomView2_rpt = new crCustomView2_rpt();
$Page =& $CustomView2_rpt;

// Page init
$CustomView2_rpt->Page_Init();

// Page main
$CustomView2_rpt->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($CustomView2->Export == "") { ?>
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
<?php $CustomView2_rpt->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $CustomView2_rpt->ShowMessage(); ?>
<?php if ($CustomView2->Export == "" || $CustomView2->Export == "print" || $CustomView2->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($CustomView2->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($CustomView2->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($CustomView2->Export == "" || $CustomView2->Export == "print" || $CustomView2->Export == "email") { ?>
<?php } ?>
<?php echo $CustomView2->TableCaption() ?>
<?php if ($CustomView2->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $CustomView2_rpt->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $CustomView2_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
<?php } ?>
<br /><br />
<?php if ($CustomView2->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($CustomView2->Export == "" || $CustomView2->Export == "print" || $CustomView2->Export == "email") { ?>
<?php } ?>
<?php if ($CustomView2->Export == "") { ?>
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
<?php if ($CustomView2->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="CustomView2rpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($CustomView2_rpt->StartGrp, $CustomView2_rpt->DisplayGrps, $CustomView2_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="CustomView2rpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="CustomView2rpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="CustomView2rpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="CustomView2rpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($CustomView2_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($CustomView2_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($CustomView2_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($CustomView2_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($CustomView2_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($CustomView2_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($CustomView2_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($CustomView2_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($CustomView2_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($CustomView2_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($CustomView2->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($CustomView2->ExportAll && $CustomView2->Export <> "") {
	$CustomView2_rpt->StopGrp = $CustomView2_rpt->TotalGrps;
} else {
	$CustomView2_rpt->StopGrp = $CustomView2_rpt->StartGrp + $CustomView2_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($CustomView2_rpt->StopGrp) > intval($CustomView2_rpt->TotalGrps))
	$CustomView2_rpt->StopGrp = $CustomView2_rpt->TotalGrps;
$CustomView2_rpt->RecCount = 0;

// Get first row
if ($CustomView2_rpt->TotalGrps > 0) {
	$CustomView2_rpt->GetRow(1);
	$CustomView2_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $CustomView2_rpt->GrpCount <= $CustomView2_rpt->DisplayGrps) || $CustomView2_rpt->ShowFirstHeader) {

	// Show header
	if ($CustomView2_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView2->SortUrl($CustomView2->v_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView2->v_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView2->SortUrl($CustomView2->v_code) ?>',1);"><?php echo $CustomView2->v_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView2->v_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView2->v_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView2->SortUrl($CustomView2->v_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView2->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView2->SortUrl($CustomView2->v_title) ?>',1);"><?php echo $CustomView2->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView2->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView2->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView2->SortUrl($CustomView2->t_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView2->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView2->SortUrl($CustomView2->t_title) ?>',1);"><?php echo $CustomView2->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView2->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView2->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView2->SortUrl($CustomView2->village_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView2->village_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView2->SortUrl($CustomView2->village_id) ?>',1);"><?php echo $CustomView2->village_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView2->village_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView2->village_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView2->SortUrl($CustomView2->cal_type) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView2->cal_type->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView2->SortUrl($CustomView2->cal_type) ?>',1);"><?php echo $CustomView2->cal_type->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView2->cal_type->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView2->cal_type->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView2->SortUrl($CustomView2->total) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView2->total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView2->SortUrl($CustomView2->total) ?>',1);"><?php echo $CustomView2->total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView2->total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView2->total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView2->SortUrl($CustomView2->pt_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView2->pt_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView2->SortUrl($CustomView2->pt_title) ?>',1);"><?php echo $CustomView2->pt_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView2->pt_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView2->pt_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView2->SortUrl($CustomView2->cal_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView2->cal_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView2->SortUrl($CustomView2->cal_date) ?>',1);"><?php echo $CustomView2->cal_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView2->cal_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView2->cal_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView2->SortUrl($CustomView2->cal_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView2->cal_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView2->SortUrl($CustomView2->cal_status) ?>',1);"><?php echo $CustomView2->cal_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView2->cal_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView2->cal_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$CustomView2_rpt->ShowFirstHeader = FALSE;
	}
	$CustomView2_rpt->RecCount++;

		// Render detail row
		$CustomView2->ResetCSS();
		$CustomView2->RowType = EWRPT_ROWTYPE_DETAIL;
		$CustomView2_rpt->RenderRow();
?>
	<tr<?php echo $CustomView2->RowAttributes(); ?>>
		<td<?php echo $CustomView2->v_code->CellAttributes() ?>>
<div<?php echo $CustomView2->v_code->ViewAttributes(); ?>><?php echo $CustomView2->v_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView2->v_title->CellAttributes() ?>>
<div<?php echo $CustomView2->v_title->ViewAttributes(); ?>><?php echo $CustomView2->v_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView2->t_title->CellAttributes() ?>>
<div<?php echo $CustomView2->t_title->ViewAttributes(); ?>><?php echo $CustomView2->t_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView2->village_id->CellAttributes() ?>>
<div<?php echo $CustomView2->village_id->ViewAttributes(); ?>><?php echo $CustomView2->village_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView2->cal_type->CellAttributes() ?>>
<div<?php echo $CustomView2->cal_type->ViewAttributes(); ?>><?php echo $CustomView2->cal_type->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView2->total->CellAttributes() ?>>
<div<?php echo $CustomView2->total->ViewAttributes(); ?>><?php echo $CustomView2->total->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView2->pt_title->CellAttributes() ?>>
<div<?php echo $CustomView2->pt_title->ViewAttributes(); ?>><?php echo $CustomView2->pt_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView2->cal_date->CellAttributes() ?>>
<div<?php echo $CustomView2->cal_date->ViewAttributes(); ?>><?php echo $CustomView2->cal_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView2->cal_status->CellAttributes() ?>>
<div<?php echo $CustomView2->cal_status->ViewAttributes(); ?>><?php echo $CustomView2->cal_status->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$CustomView2_rpt->AccumulateSummary();

		// Get next record
		$CustomView2_rpt->GetRow(2);
	$CustomView2_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($CustomView2_rpt->TotalGrps > 0) { ?>
<?php if ($CustomView2->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="CustomView2rpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($CustomView2_rpt->StartGrp, $CustomView2_rpt->DisplayGrps, $CustomView2_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="CustomView2rpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="CustomView2rpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="CustomView2rpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="CustomView2rpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($CustomView2_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($CustomView2_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($CustomView2_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($CustomView2_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($CustomView2_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($CustomView2_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($CustomView2_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($CustomView2_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($CustomView2_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($CustomView2_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($CustomView2->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($CustomView2->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($CustomView2->Export == "" || $CustomView2->Export == "print" || $CustomView2->Export == "email") { ?>
<?php } ?>
<?php if ($CustomView2->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($CustomView2->Export == "" || $CustomView2->Export == "print" || $CustomView2->Export == "email") { ?>
<?php } ?>
<?php if ($CustomView2->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $CustomView2_rpt->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($CustomView2->Export == "") { ?>
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
$CustomView2_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crCustomView2_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'CustomView2';

	// Page object name
	var $PageObjName = 'CustomView2_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $CustomView2;
		if ($CustomView2->UseTokenInUrl) $PageUrl .= "t=" . $CustomView2->TableVar . "&"; // Add page token
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
		global $CustomView2;
		if ($CustomView2->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($CustomView2->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($CustomView2->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crCustomView2_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (CustomView2)
		$GLOBALS["CustomView2"] = new crCustomView2();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'CustomView2', TRUE);

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
		global $CustomView2;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$CustomView2->Export = $_GET["export"];
	}
	$gsExport = $CustomView2->Export; // Get export parameter, used in header
	$gsExportFile = $CustomView2->TableVar; // Get export file, used in header
	if ($CustomView2->Export == "excel") {
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
		global $CustomView2;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($CustomView2->Export == "email") {
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
		global $CustomView2;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 10;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

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
		$sSql = ewrpt_BuildReportSql($CustomView2->SqlSelect(), $CustomView2->SqlWhere(), $CustomView2->SqlGroupBy(), $CustomView2->SqlHaving(), $CustomView2->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($CustomView2->ExportAll && $CustomView2->Export <> "")
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
		global $CustomView2;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$CustomView2->t_code->setDbValue($rs->fields('t_code'));
			$CustomView2->v_code->setDbValue($rs->fields('v_code'));
			$CustomView2->v_title->setDbValue($rs->fields('v_title'));
			$CustomView2->t_title->setDbValue($rs->fields('t_title'));
			$CustomView2->village_id->setDbValue($rs->fields('village_id'));
			$CustomView2->cal_type->setDbValue($rs->fields('cal_type'));
			$CustomView2->total->setDbValue($rs->fields('total'));
			$CustomView2->pt_title->setDbValue($rs->fields('pt_title'));
			$CustomView2->cal_date->setDbValue($rs->fields('cal_date'));
			$CustomView2->cal_status->setDbValue($rs->fields('cal_status'));
			$this->Val[1] = $CustomView2->v_code->CurrentValue;
			$this->Val[2] = $CustomView2->v_title->CurrentValue;
			$this->Val[3] = $CustomView2->t_title->CurrentValue;
			$this->Val[4] = $CustomView2->village_id->CurrentValue;
			$this->Val[5] = $CustomView2->cal_type->CurrentValue;
			$this->Val[6] = $CustomView2->total->CurrentValue;
			$this->Val[7] = $CustomView2->pt_title->CurrentValue;
			$this->Val[8] = $CustomView2->cal_date->CurrentValue;
			$this->Val[9] = $CustomView2->cal_status->CurrentValue;
		} else {
			$CustomView2->t_code->setDbValue("");
			$CustomView2->v_code->setDbValue("");
			$CustomView2->v_title->setDbValue("");
			$CustomView2->t_title->setDbValue("");
			$CustomView2->village_id->setDbValue("");
			$CustomView2->cal_type->setDbValue("");
			$CustomView2->total->setDbValue("");
			$CustomView2->pt_title->setDbValue("");
			$CustomView2->cal_date->setDbValue("");
			$CustomView2->cal_status->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $CustomView2;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$CustomView2->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$CustomView2->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $CustomView2->getStartGroup();
			}
		} else {
			$this->StartGrp = $CustomView2->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$CustomView2->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$CustomView2->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$CustomView2->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $CustomView2;

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
		global $CustomView2;
		$this->StartGrp = 1;
		$CustomView2->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $CustomView2;
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
			$CustomView2->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$CustomView2->setStartGroup($this->StartGrp);
		} else {
			if ($CustomView2->getGroupPerPage() <> "") {
				$this->DisplayGrps = $CustomView2->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $CustomView2;
		if ($CustomView2->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($CustomView2->SqlSelectCount(), $CustomView2->SqlWhere(), $CustomView2->SqlGroupBy(), $CustomView2->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$CustomView2->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($CustomView2->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// v_code
			$CustomView2->v_code->ViewValue = $CustomView2->v_code->Summary;

			// v_title
			$CustomView2->v_title->ViewValue = $CustomView2->v_title->Summary;

			// t_title
			$CustomView2->t_title->ViewValue = $CustomView2->t_title->Summary;

			// village_id
			$CustomView2->village_id->ViewValue = $CustomView2->village_id->Summary;

			// cal_type
			$CustomView2->cal_type->ViewValue = $CustomView2->cal_type->Summary;

			// total
			$CustomView2->total->ViewValue = $CustomView2->total->Summary;

			// pt_title
			$CustomView2->pt_title->ViewValue = $CustomView2->pt_title->Summary;

			// cal_date
			$CustomView2->cal_date->ViewValue = $CustomView2->cal_date->Summary;
			$CustomView2->cal_date->ViewValue = ewrpt_FormatDateTime($CustomView2->cal_date->ViewValue, 6);

			// cal_status
			$CustomView2->cal_status->ViewValue = $CustomView2->cal_status->Summary;
		} else {

			// v_code
			$CustomView2->v_code->ViewValue = $CustomView2->v_code->CurrentValue;
			$CustomView2->v_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_title
			$CustomView2->v_title->ViewValue = $CustomView2->v_title->CurrentValue;
			$CustomView2->v_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_title
			$CustomView2->t_title->ViewValue = $CustomView2->t_title->CurrentValue;
			$CustomView2->t_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// village_id
			$CustomView2->village_id->ViewValue = $CustomView2->village_id->CurrentValue;
			$CustomView2->village_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// cal_type
			$CustomView2->cal_type->ViewValue = $CustomView2->cal_type->CurrentValue;
			$CustomView2->cal_type->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// total
			$CustomView2->total->ViewValue = $CustomView2->total->CurrentValue;
			$CustomView2->total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pt_title
			$CustomView2->pt_title->ViewValue = $CustomView2->pt_title->CurrentValue;
			$CustomView2->pt_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// cal_date
			$CustomView2->cal_date->ViewValue = $CustomView2->cal_date->CurrentValue;
			$CustomView2->cal_date->ViewValue = ewrpt_FormatDateTime($CustomView2->cal_date->ViewValue, 6);
			$CustomView2->cal_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// cal_status
			$CustomView2->cal_status->ViewValue = $CustomView2->cal_status->CurrentValue;
			$CustomView2->cal_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// v_code
		$CustomView2->v_code->HrefValue = "";

		// v_title
		$CustomView2->v_title->HrefValue = "";

		// t_title
		$CustomView2->t_title->HrefValue = "";

		// village_id
		$CustomView2->village_id->HrefValue = "";

		// cal_type
		$CustomView2->cal_type->HrefValue = "";

		// total
		$CustomView2->total->HrefValue = "";

		// pt_title
		$CustomView2->pt_title->HrefValue = "";

		// cal_date
		$CustomView2->cal_date->HrefValue = "";

		// cal_status
		$CustomView2->cal_status->HrefValue = "";

		// Call Row_Rendered event
		$CustomView2->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $CustomView2;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $CustomView2;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$CustomView2->setOrderBy("");
				$CustomView2->setStartGroup(1);
				$CustomView2->v_code->setSort("");
				$CustomView2->v_title->setSort("");
				$CustomView2->t_title->setSort("");
				$CustomView2->village_id->setSort("");
				$CustomView2->cal_type->setSort("");
				$CustomView2->total->setSort("");
				$CustomView2->pt_title->setSort("");
				$CustomView2->cal_date->setSort("");
				$CustomView2->cal_status->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$CustomView2->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$CustomView2->CurrentOrderType = @$_GET["ordertype"];
			$CustomView2->UpdateSort($CustomView2->v_code); // v_code
			$CustomView2->UpdateSort($CustomView2->v_title); // v_title
			$CustomView2->UpdateSort($CustomView2->t_title); // t_title
			$CustomView2->UpdateSort($CustomView2->village_id); // village_id
			$CustomView2->UpdateSort($CustomView2->cal_type); // cal_type
			$CustomView2->UpdateSort($CustomView2->total); // total
			$CustomView2->UpdateSort($CustomView2->pt_title); // pt_title
			$CustomView2->UpdateSort($CustomView2->cal_date); // cal_date
			$CustomView2->UpdateSort($CustomView2->cal_status); // cal_status
			$sSortSql = $CustomView2->SortSql();
			$CustomView2->setOrderBy($sSortSql);
			$CustomView2->setStartGroup(1);
		}
		return $CustomView2->getOrderBy();
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
