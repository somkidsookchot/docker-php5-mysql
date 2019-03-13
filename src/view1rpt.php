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
$view1 = NULL;

//
// Table class for view1
//
class crview1 {
	var $TableVar = 'view1';
	var $TableName = 'view1';
	var $TableType = 'VIEW';
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
	var $pay_sum_note;
	var $pay_sum_detail;
	var $pay_sum_total;
	var $pay_annual_year;
	var $pay_death_end;
	var $pay_sum_adv_count;
	var $pay_death_begin;
	var $pay_sum_date;
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
	var $pay_sum_type;
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
	function crview1() {
		global $ReportLanguage;

		// pay_sum_note
		$this->pay_sum_note = new crField('view1', 'view1', 'x_pay_sum_note', 'pay_sum_note', '`pay_sum_note`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['pay_sum_note'] =& $this->pay_sum_note;
		$this->pay_sum_note->DateFilter = "";
		$this->pay_sum_note->SqlSelect = "";
		$this->pay_sum_note->SqlOrderBy = "";

		// pay_sum_detail
		$this->pay_sum_detail = new crField('view1', 'view1', 'x_pay_sum_detail', 'pay_sum_detail', '`pay_sum_detail`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pay_sum_detail'] =& $this->pay_sum_detail;
		$this->pay_sum_detail->DateFilter = "";
		$this->pay_sum_detail->SqlSelect = "";
		$this->pay_sum_detail->SqlOrderBy = "";

		// pay_sum_total
		$this->pay_sum_total = new crField('view1', 'view1', 'x_pay_sum_total', 'pay_sum_total', '`pay_sum_total`', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['pay_sum_total'] =& $this->pay_sum_total;
		$this->pay_sum_total->DateFilter = "";
		$this->pay_sum_total->SqlSelect = "";
		$this->pay_sum_total->SqlOrderBy = "";

		// pay_annual_year
		$this->pay_annual_year = new crField('view1', 'view1', 'x_pay_annual_year', 'pay_annual_year', '`pay_annual_year`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pay_annual_year'] =& $this->pay_annual_year;
		$this->pay_annual_year->DateFilter = "";
		$this->pay_annual_year->SqlSelect = "";
		$this->pay_annual_year->SqlOrderBy = "";

		// pay_death_end
		$this->pay_death_end = new crField('view1', 'view1', 'x_pay_death_end', 'pay_death_end', '`pay_death_end`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_death_end->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_death_end'] =& $this->pay_death_end;
		$this->pay_death_end->DateFilter = "";
		$this->pay_death_end->SqlSelect = "";
		$this->pay_death_end->SqlOrderBy = "";

		// pay_sum_adv_count
		$this->pay_sum_adv_count = new crField('view1', 'view1', 'x_pay_sum_adv_count', 'pay_sum_adv_count', '`pay_sum_adv_count`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_adv_count->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_adv_count'] =& $this->pay_sum_adv_count;
		$this->pay_sum_adv_count->DateFilter = "";
		$this->pay_sum_adv_count->SqlSelect = "";
		$this->pay_sum_adv_count->SqlOrderBy = "";

		// pay_death_begin
		$this->pay_death_begin = new crField('view1', 'view1', 'x_pay_death_begin', 'pay_death_begin', '`pay_death_begin`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_death_begin->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_death_begin'] =& $this->pay_death_begin;
		$this->pay_death_begin->DateFilter = "";
		$this->pay_death_begin->SqlSelect = "";
		$this->pay_death_begin->SqlOrderBy = "";

		// pay_sum_date
		$this->pay_sum_date = new crField('view1', 'view1', 'x_pay_sum_date', 'pay_sum_date', '`pay_sum_date`', 135, EWRPT_DATATYPE_DATE, 6);
		$this->pay_sum_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['pay_sum_date'] =& $this->pay_sum_date;
		$this->pay_sum_date->DateFilter = "";
		$this->pay_sum_date->SqlSelect = "";
		$this->pay_sum_date->SqlOrderBy = "";

		// member_code
		$this->member_code = new crField('view1', 'view1', 'x_member_code', 'member_code', '`member_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";

		// id_code
		$this->id_code = new crField('view1', 'view1', 'x_id_code', 'id_code', '`id_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['id_code'] =& $this->id_code;
		$this->id_code->DateFilter = "";
		$this->id_code->SqlSelect = "";
		$this->id_code->SqlOrderBy = "";

		// prefix
		$this->prefix = new crField('view1', 'view1', 'x_prefix', 'prefix', '`prefix`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['prefix'] =& $this->prefix;
		$this->prefix->DateFilter = "";
		$this->prefix->SqlSelect = "";
		$this->prefix->SqlOrderBy = "";

		// gender
		$this->gender = new crField('view1', 'view1', 'x_gender', 'gender', '`gender`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['gender'] =& $this->gender;
		$this->gender->DateFilter = "";
		$this->gender->SqlSelect = "";
		$this->gender->SqlOrderBy = "";

		// fname
		$this->fname = new crField('view1', 'view1', 'x_fname', 'fname', '`fname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";

		// lname
		$this->lname = new crField('view1', 'view1', 'x_lname', 'lname', '`lname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";

		// birthdate
		$this->birthdate = new crField('view1', 'view1', 'x_birthdate', 'birthdate', '`birthdate`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->birthdate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['birthdate'] =& $this->birthdate;
		$this->birthdate->DateFilter = "";
		$this->birthdate->SqlSelect = "";
		$this->birthdate->SqlOrderBy = "";

		// age
		$this->age = new crField('view1', 'view1', 'x_age', 'age', '`age`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;
		$this->age->DateFilter = "";
		$this->age->SqlSelect = "";
		$this->age->SqlOrderBy = "";

		// t_code
		$this->t_code = new crField('view1', 'view1', 'x_t_code', 't_code', '`t_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";

		// t_title
		$this->t_title = new crField('view1', 'view1', 'x_t_title', 't_title', '`t_title`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "";
		$this->t_title->SqlOrderBy = "";

		// village_id
		$this->village_id = new crField('view1', 'view1', 'x_village_id', 'village_id', '`village_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";

		// v_title
		$this->v_title = new crField('view1', 'view1', 'x_v_title', 'v_title', '`v_title`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "";
		$this->v_title->SqlOrderBy = "";

		// bnfc1_name
		$this->bnfc1_name = new crField('view1', 'view1', 'x_bnfc1_name', 'bnfc1_name', '`bnfc1_name`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['bnfc1_name'] =& $this->bnfc1_name;
		$this->bnfc1_name->DateFilter = "";
		$this->bnfc1_name->SqlSelect = "";
		$this->bnfc1_name->SqlOrderBy = "";

		// dead_date
		$this->dead_date = new crField('view1', 'view1', 'x_dead_date', 'dead_date', '`dead_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->dead_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['dead_date'] =& $this->dead_date;
		$this->dead_date->DateFilter = "";
		$this->dead_date->SqlSelect = "";
		$this->dead_date->SqlOrderBy = "";

		// note
		$this->note = new crField('view1', 'view1', 'x_note', 'note', '`note`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['note'] =& $this->note;
		$this->note->DateFilter = "";
		$this->note->SqlSelect = "";
		$this->note->SqlOrderBy = "";

		// dead_id
		$this->dead_id = new crField('view1', 'view1', 'x_dead_id', 'dead_id', '`dead_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->dead_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['dead_id'] =& $this->dead_id;
		$this->dead_id->DateFilter = "";
		$this->dead_id->SqlSelect = "";
		$this->dead_id->SqlOrderBy = "";

		// member_status
		$this->member_status = new crField('view1', 'view1', 'x_member_status', 'member_status', '`member_status`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_status'] =& $this->member_status;
		$this->member_status->DateFilter = "";
		$this->member_status->SqlSelect = "";
		$this->member_status->SqlOrderBy = "";

		// regis_date
		$this->regis_date = new crField('view1', 'view1', 'x_regis_date', 'regis_date', '`regis_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->regis_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['regis_date'] =& $this->regis_date;
		$this->regis_date->DateFilter = "";
		$this->regis_date->SqlSelect = "";
		$this->regis_date->SqlOrderBy = "";

		// pay_sum_type
		$this->pay_sum_type = new crField('view1', 'view1', 'x_pay_sum_type', 'pay_sum_type', '`pay_sum_type`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_type'] =& $this->pay_sum_type;
		$this->pay_sum_type->DateFilter = "";
		$this->pay_sum_type->SqlSelect = "";
		$this->pay_sum_type->SqlOrderBy = "";
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
		return "`view1`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		return ;
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
$view1_rpt = new crview1_rpt();
$Page =& $view1_rpt;

// Page init
$view1_rpt->Page_Init();

// Page main
$view1_rpt->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($view1->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php $view1_rpt->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $view1_rpt->ShowMessage(); ?>
<?php if ($view1->Export == "" || $view1->Export == "print" || $view1->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($view1->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($view1->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($view1->Export == "" || $view1->Export == "print" || $view1->Export == "email") { ?>
<?php } ?>
<?php echo $view1->TableCaption() ?>
<?php if ($view1->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $view1_rpt->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $view1_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
<?php } ?>
<br /><br />
<?php if ($view1->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($view1->Export == "" || $view1->Export == "print" || $view1->Export == "email") { ?>
<?php } ?>
<?php if ($view1->Export == "") { ?>
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
<?php if ($view1->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="view1rpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($view1_rpt->StartGrp, $view1_rpt->DisplayGrps, $view1_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="view1rpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="view1rpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="view1rpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="view1rpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($view1_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($view1_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($view1_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($view1_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($view1_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($view1_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($view1_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($view1_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($view1_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($view1_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($view1->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($view1->ExportAll && $view1->Export <> "") {
	$view1_rpt->StopGrp = $view1_rpt->TotalGrps;
} else {
	$view1_rpt->StopGrp = $view1_rpt->StartGrp + $view1_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($view1_rpt->StopGrp) > intval($view1_rpt->TotalGrps))
	$view1_rpt->StopGrp = $view1_rpt->TotalGrps;
$view1_rpt->RecCount = 0;

// Get first row
if ($view1_rpt->TotalGrps > 0) {
	$view1_rpt->GetRow(1);
	$view1_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $view1_rpt->GrpCount <= $view1_rpt->DisplayGrps) || $view1_rpt->ShowFirstHeader) {

	// Show header
	if ($view1_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->pay_sum_detail) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->pay_sum_detail->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->pay_sum_detail) ?>',1);"><?php echo $view1->pay_sum_detail->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->pay_sum_detail->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->pay_sum_detail->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->pay_sum_total) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->pay_sum_total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->pay_sum_total) ?>',1);"><?php echo $view1->pay_sum_total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->pay_sum_total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->pay_sum_total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->pay_annual_year) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->pay_annual_year->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->pay_annual_year) ?>',1);"><?php echo $view1->pay_annual_year->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->pay_annual_year->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->pay_annual_year->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->pay_death_end) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->pay_death_end->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->pay_death_end) ?>',1);"><?php echo $view1->pay_death_end->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->pay_death_end->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->pay_death_end->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->pay_sum_adv_count) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->pay_sum_adv_count->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->pay_sum_adv_count) ?>',1);"><?php echo $view1->pay_sum_adv_count->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->pay_sum_adv_count->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->pay_sum_adv_count->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->pay_death_begin) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->pay_death_begin->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->pay_death_begin) ?>',1);"><?php echo $view1->pay_death_begin->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->pay_death_begin->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->pay_death_begin->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->pay_sum_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->pay_sum_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->pay_sum_date) ?>',1);"><?php echo $view1->pay_sum_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->pay_sum_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->pay_sum_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->member_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->member_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->member_code) ?>',1);"><?php echo $view1->member_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->member_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->member_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->id_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->id_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->id_code) ?>',1);"><?php echo $view1->id_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->id_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->id_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->prefix) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->prefix->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->prefix) ?>',1);"><?php echo $view1->prefix->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->prefix->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->prefix->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->gender) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->gender->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->gender) ?>',1);"><?php echo $view1->gender->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->gender->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->gender->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->fname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->fname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->fname) ?>',1);"><?php echo $view1->fname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->fname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->fname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->lname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->lname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->lname) ?>',1);"><?php echo $view1->lname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->lname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->lname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->birthdate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->birthdate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->birthdate) ?>',1);"><?php echo $view1->birthdate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->birthdate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->birthdate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->age) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->age) ?>',1);"><?php echo $view1->age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->t_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->t_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->t_code) ?>',1);"><?php echo $view1->t_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->t_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->t_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->t_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->t_title) ?>',1);"><?php echo $view1->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->village_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->village_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->village_id) ?>',1);"><?php echo $view1->village_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->village_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->village_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->v_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->v_title) ?>',1);"><?php echo $view1->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->dead_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->dead_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->dead_date) ?>',1);"><?php echo $view1->dead_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->dead_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->dead_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->dead_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->dead_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->dead_id) ?>',1);"><?php echo $view1->dead_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->dead_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->dead_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->member_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->member_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->member_status) ?>',1);"><?php echo $view1->member_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->member_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->member_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->regis_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->regis_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->regis_date) ?>',1);"><?php echo $view1->regis_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->regis_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->regis_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($view1->SortUrl($view1->pay_sum_type) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $view1->pay_sum_type->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $view1->SortUrl($view1->pay_sum_type) ?>',1);"><?php echo $view1->pay_sum_type->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($view1->pay_sum_type->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($view1->pay_sum_type->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$view1_rpt->ShowFirstHeader = FALSE;
	}
	$view1_rpt->RecCount++;

		// Render detail row
		$view1->ResetCSS();
		$view1->RowType = EWRPT_ROWTYPE_DETAIL;
		$view1_rpt->RenderRow();
?>
	<tr<?php echo $view1->RowAttributes(); ?>>
		<td<?php echo $view1->pay_sum_detail->CellAttributes() ?>>
<div<?php echo $view1->pay_sum_detail->ViewAttributes(); ?>><?php echo $view1->pay_sum_detail->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->pay_sum_total->CellAttributes() ?>>
<div<?php echo $view1->pay_sum_total->ViewAttributes(); ?>><?php echo $view1->pay_sum_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->pay_annual_year->CellAttributes() ?>>
<div<?php echo $view1->pay_annual_year->ViewAttributes(); ?>><?php echo $view1->pay_annual_year->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->pay_death_end->CellAttributes() ?>>
<div<?php echo $view1->pay_death_end->ViewAttributes(); ?>><?php echo $view1->pay_death_end->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->pay_sum_adv_count->CellAttributes() ?>>
<div<?php echo $view1->pay_sum_adv_count->ViewAttributes(); ?>><?php echo $view1->pay_sum_adv_count->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->pay_death_begin->CellAttributes() ?>>
<div<?php echo $view1->pay_death_begin->ViewAttributes(); ?>><?php echo $view1->pay_death_begin->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->pay_sum_date->CellAttributes() ?>>
<div<?php echo $view1->pay_sum_date->ViewAttributes(); ?>><?php echo $view1->pay_sum_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->member_code->CellAttributes() ?>>
<div<?php echo $view1->member_code->ViewAttributes(); ?>><?php echo $view1->member_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->id_code->CellAttributes() ?>>
<div<?php echo $view1->id_code->ViewAttributes(); ?>><?php echo $view1->id_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->prefix->CellAttributes() ?>>
<div<?php echo $view1->prefix->ViewAttributes(); ?>><?php echo $view1->prefix->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->gender->CellAttributes() ?>>
<div<?php echo $view1->gender->ViewAttributes(); ?>><?php echo $view1->gender->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->fname->CellAttributes() ?>>
<div<?php echo $view1->fname->ViewAttributes(); ?>><?php echo $view1->fname->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->lname->CellAttributes() ?>>
<div<?php echo $view1->lname->ViewAttributes(); ?>><?php echo $view1->lname->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->birthdate->CellAttributes() ?>>
<div<?php echo $view1->birthdate->ViewAttributes(); ?>><?php echo $view1->birthdate->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->age->CellAttributes() ?>>
<div<?php echo $view1->age->ViewAttributes(); ?>><?php echo $view1->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->t_code->CellAttributes() ?>>
<div<?php echo $view1->t_code->ViewAttributes(); ?>><?php echo $view1->t_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->t_title->CellAttributes() ?>>
<div<?php echo $view1->t_title->ViewAttributes(); ?>><?php echo $view1->t_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->village_id->CellAttributes() ?>>
<div<?php echo $view1->village_id->ViewAttributes(); ?>><?php echo $view1->village_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->v_title->CellAttributes() ?>>
<div<?php echo $view1->v_title->ViewAttributes(); ?>><?php echo $view1->v_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->dead_date->CellAttributes() ?>>
<div<?php echo $view1->dead_date->ViewAttributes(); ?>><?php echo $view1->dead_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->dead_id->CellAttributes() ?>>
<div<?php echo $view1->dead_id->ViewAttributes(); ?>><?php echo $view1->dead_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->member_status->CellAttributes() ?>>
<div<?php echo $view1->member_status->ViewAttributes(); ?>><?php echo $view1->member_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->regis_date->CellAttributes() ?>>
<div<?php echo $view1->regis_date->ViewAttributes(); ?>><?php echo $view1->regis_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $view1->pay_sum_type->CellAttributes() ?>>
<div<?php echo $view1->pay_sum_type->ViewAttributes(); ?>><?php echo $view1->pay_sum_type->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$view1_rpt->AccumulateSummary();

		// Get next record
		$view1_rpt->GetRow(2);
	$view1_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($view1_rpt->TotalGrps > 0) { ?>
<?php if ($view1->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="view1rpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($view1_rpt->StartGrp, $view1_rpt->DisplayGrps, $view1_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="view1rpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="view1rpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="view1rpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="view1rpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($view1_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($view1_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($view1_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($view1_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($view1_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($view1_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($view1_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($view1_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($view1_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($view1_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($view1->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($view1->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($view1->Export == "" || $view1->Export == "print" || $view1->Export == "email") { ?>
<?php } ?>
<?php if ($view1->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($view1->Export == "" || $view1->Export == "print" || $view1->Export == "email") { ?>
<?php } ?>
<?php if ($view1->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $view1_rpt->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($view1->Export == "") { ?>
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
$view1_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crview1_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'view1';

	// Page object name
	var $PageObjName = 'view1_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $view1;
		if ($view1->UseTokenInUrl) $PageUrl .= "t=" . $view1->TableVar . "&"; // Add page token
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
		global $view1;
		if ($view1->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($view1->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($view1->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crview1_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (view1)
		$GLOBALS["view1"] = new crview1();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'view1', TRUE);

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
		global $view1;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$view1->Export = $_GET["export"];
	}
	$gsExport = $view1->Export; // Get export parameter, used in header
	$gsExportFile = $view1->TableVar; // Get export file, used in header
	if ($view1->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
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
		global $view1;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($view1->Export == "email") {
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
		global $view1;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 25;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

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
		$sSql = ewrpt_BuildReportSql($view1->SqlSelect(), $view1->SqlWhere(), $view1->SqlGroupBy(), $view1->SqlHaving(), $view1->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($view1->ExportAll && $view1->Export <> "")
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
		global $view1;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$view1->pay_sum_note->setDbValue($rs->fields('pay_sum_note'));
			$view1->pay_sum_detail->setDbValue($rs->fields('pay_sum_detail'));
			$view1->pay_sum_total->setDbValue($rs->fields('pay_sum_total'));
			$view1->pay_annual_year->setDbValue($rs->fields('pay_annual_year'));
			$view1->pay_death_end->setDbValue($rs->fields('pay_death_end'));
			$view1->pay_sum_adv_count->setDbValue($rs->fields('pay_sum_adv_count'));
			$view1->pay_death_begin->setDbValue($rs->fields('pay_death_begin'));
			$view1->pay_sum_date->setDbValue($rs->fields('pay_sum_date'));
			$view1->member_code->setDbValue($rs->fields('member_code'));
			$view1->id_code->setDbValue($rs->fields('id_code'));
			$view1->prefix->setDbValue($rs->fields('prefix'));
			$view1->gender->setDbValue($rs->fields('gender'));
			$view1->fname->setDbValue($rs->fields('fname'));
			$view1->lname->setDbValue($rs->fields('lname'));
			$view1->birthdate->setDbValue($rs->fields('birthdate'));
			$view1->age->setDbValue($rs->fields('age'));
			$view1->t_code->setDbValue($rs->fields('t_code'));
			$view1->t_title->setDbValue($rs->fields('t_title'));
			$view1->village_id->setDbValue($rs->fields('village_id'));
			$view1->v_title->setDbValue($rs->fields('v_title'));
			$view1->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
			$view1->dead_date->setDbValue($rs->fields('dead_date'));
			$view1->note->setDbValue($rs->fields('note'));
			$view1->dead_id->setDbValue($rs->fields('dead_id'));
			$view1->member_status->setDbValue($rs->fields('member_status'));
			$view1->regis_date->setDbValue($rs->fields('regis_date'));
			$view1->pay_sum_type->setDbValue($rs->fields('pay_sum_type'));
			$this->Val[1] = $view1->pay_sum_detail->CurrentValue;
			$this->Val[2] = $view1->pay_sum_total->CurrentValue;
			$this->Val[3] = $view1->pay_annual_year->CurrentValue;
			$this->Val[4] = $view1->pay_death_end->CurrentValue;
			$this->Val[5] = $view1->pay_sum_adv_count->CurrentValue;
			$this->Val[6] = $view1->pay_death_begin->CurrentValue;
			$this->Val[7] = $view1->pay_sum_date->CurrentValue;
			$this->Val[8] = $view1->member_code->CurrentValue;
			$this->Val[9] = $view1->id_code->CurrentValue;
			$this->Val[10] = $view1->prefix->CurrentValue;
			$this->Val[11] = $view1->gender->CurrentValue;
			$this->Val[12] = $view1->fname->CurrentValue;
			$this->Val[13] = $view1->lname->CurrentValue;
			$this->Val[14] = $view1->birthdate->CurrentValue;
			$this->Val[15] = $view1->age->CurrentValue;
			$this->Val[16] = $view1->t_code->CurrentValue;
			$this->Val[17] = $view1->t_title->CurrentValue;
			$this->Val[18] = $view1->village_id->CurrentValue;
			$this->Val[19] = $view1->v_title->CurrentValue;
			$this->Val[20] = $view1->dead_date->CurrentValue;
			$this->Val[21] = $view1->dead_id->CurrentValue;
			$this->Val[22] = $view1->member_status->CurrentValue;
			$this->Val[23] = $view1->regis_date->CurrentValue;
			$this->Val[24] = $view1->pay_sum_type->CurrentValue;
		} else {
			$view1->pay_sum_note->setDbValue("");
			$view1->pay_sum_detail->setDbValue("");
			$view1->pay_sum_total->setDbValue("");
			$view1->pay_annual_year->setDbValue("");
			$view1->pay_death_end->setDbValue("");
			$view1->pay_sum_adv_count->setDbValue("");
			$view1->pay_death_begin->setDbValue("");
			$view1->pay_sum_date->setDbValue("");
			$view1->member_code->setDbValue("");
			$view1->id_code->setDbValue("");
			$view1->prefix->setDbValue("");
			$view1->gender->setDbValue("");
			$view1->fname->setDbValue("");
			$view1->lname->setDbValue("");
			$view1->birthdate->setDbValue("");
			$view1->age->setDbValue("");
			$view1->t_code->setDbValue("");
			$view1->t_title->setDbValue("");
			$view1->village_id->setDbValue("");
			$view1->v_title->setDbValue("");
			$view1->bnfc1_name->setDbValue("");
			$view1->dead_date->setDbValue("");
			$view1->note->setDbValue("");
			$view1->dead_id->setDbValue("");
			$view1->member_status->setDbValue("");
			$view1->regis_date->setDbValue("");
			$view1->pay_sum_type->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $view1;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$view1->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$view1->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $view1->getStartGroup();
			}
		} else {
			$this->StartGrp = $view1->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$view1->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$view1->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$view1->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $view1;

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
		global $view1;
		$this->StartGrp = 1;
		$view1->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $view1;
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
			$view1->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$view1->setStartGroup($this->StartGrp);
		} else {
			if ($view1->getGroupPerPage() <> "") {
				$this->DisplayGrps = $view1->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $view1;
		if ($view1->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($view1->SqlSelectCount(), $view1->SqlWhere(), $view1->SqlGroupBy(), $view1->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$view1->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($view1->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// pay_sum_detail
			$view1->pay_sum_detail->ViewValue = $view1->pay_sum_detail->Summary;

			// pay_sum_total
			$view1->pay_sum_total->ViewValue = $view1->pay_sum_total->Summary;

			// pay_annual_year
			$view1->pay_annual_year->ViewValue = $view1->pay_annual_year->Summary;

			// pay_death_end
			$view1->pay_death_end->ViewValue = $view1->pay_death_end->Summary;

			// pay_sum_adv_count
			$view1->pay_sum_adv_count->ViewValue = $view1->pay_sum_adv_count->Summary;

			// pay_death_begin
			$view1->pay_death_begin->ViewValue = $view1->pay_death_begin->Summary;

			// pay_sum_date
			$view1->pay_sum_date->ViewValue = $view1->pay_sum_date->Summary;
			$view1->pay_sum_date->ViewValue = ewrpt_FormatDateTime($view1->pay_sum_date->ViewValue, 6);

			// member_code
			$view1->member_code->ViewValue = $view1->member_code->Summary;

			// id_code
			$view1->id_code->ViewValue = $view1->id_code->Summary;

			// prefix
			$view1->prefix->ViewValue = $view1->prefix->Summary;

			// gender
			$view1->gender->ViewValue = $view1->gender->Summary;

			// fname
			$view1->fname->ViewValue = $view1->fname->Summary;

			// lname
			$view1->lname->ViewValue = $view1->lname->Summary;

			// birthdate
			$view1->birthdate->ViewValue = $view1->birthdate->Summary;
			$view1->birthdate->ViewValue = ewrpt_FormatDateTime($view1->birthdate->ViewValue, 6);

			// age
			$view1->age->ViewValue = $view1->age->Summary;

			// t_code
			$view1->t_code->ViewValue = $view1->t_code->Summary;

			// t_title
			$view1->t_title->ViewValue = $view1->t_title->Summary;

			// village_id
			$view1->village_id->ViewValue = $view1->village_id->Summary;

			// v_title
			$view1->v_title->ViewValue = $view1->v_title->Summary;

			// dead_date
			$view1->dead_date->ViewValue = $view1->dead_date->Summary;
			$view1->dead_date->ViewValue = ewrpt_FormatDateTime($view1->dead_date->ViewValue, 6);

			// dead_id
			$view1->dead_id->ViewValue = $view1->dead_id->Summary;

			// member_status
			$view1->member_status->ViewValue = $view1->member_status->Summary;

			// regis_date
			$view1->regis_date->ViewValue = $view1->regis_date->Summary;
			$view1->regis_date->ViewValue = ewrpt_FormatDateTime($view1->regis_date->ViewValue, 6);

			// pay_sum_type
			$view1->pay_sum_type->ViewValue = $view1->pay_sum_type->Summary;
		} else {

			// pay_sum_detail
			$view1->pay_sum_detail->ViewValue = $view1->pay_sum_detail->CurrentValue;
			$view1->pay_sum_detail->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_total
			$view1->pay_sum_total->ViewValue = $view1->pay_sum_total->CurrentValue;
			$view1->pay_sum_total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_annual_year
			$view1->pay_annual_year->ViewValue = $view1->pay_annual_year->CurrentValue;
			$view1->pay_annual_year->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_death_end
			$view1->pay_death_end->ViewValue = $view1->pay_death_end->CurrentValue;
			$view1->pay_death_end->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_adv_count
			$view1->pay_sum_adv_count->ViewValue = $view1->pay_sum_adv_count->CurrentValue;
			$view1->pay_sum_adv_count->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_death_begin
			$view1->pay_death_begin->ViewValue = $view1->pay_death_begin->CurrentValue;
			$view1->pay_death_begin->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_date
			$view1->pay_sum_date->ViewValue = $view1->pay_sum_date->CurrentValue;
			$view1->pay_sum_date->ViewValue = ewrpt_FormatDateTime($view1->pay_sum_date->ViewValue, 6);
			$view1->pay_sum_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_code
			$view1->member_code->ViewValue = $view1->member_code->CurrentValue;
			$view1->member_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// id_code
			$view1->id_code->ViewValue = $view1->id_code->CurrentValue;
			$view1->id_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// prefix
			$view1->prefix->ViewValue = $view1->prefix->CurrentValue;
			$view1->prefix->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// gender
			$view1->gender->ViewValue = $view1->gender->CurrentValue;
			$view1->gender->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$view1->fname->ViewValue = $view1->fname->CurrentValue;
			$view1->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$view1->lname->ViewValue = $view1->lname->CurrentValue;
			$view1->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// birthdate
			$view1->birthdate->ViewValue = $view1->birthdate->CurrentValue;
			$view1->birthdate->ViewValue = ewrpt_FormatDateTime($view1->birthdate->ViewValue, 6);
			$view1->birthdate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// age
			$view1->age->ViewValue = $view1->age->CurrentValue;
			$view1->age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_code
			$view1->t_code->ViewValue = $view1->t_code->CurrentValue;
			$view1->t_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_title
			$view1->t_title->ViewValue = $view1->t_title->CurrentValue;
			$view1->t_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// village_id
			$view1->village_id->ViewValue = $view1->village_id->CurrentValue;
			$view1->village_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_title
			$view1->v_title->ViewValue = $view1->v_title->CurrentValue;
			$view1->v_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_date
			$view1->dead_date->ViewValue = $view1->dead_date->CurrentValue;
			$view1->dead_date->ViewValue = ewrpt_FormatDateTime($view1->dead_date->ViewValue, 6);
			$view1->dead_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_id
			$view1->dead_id->ViewValue = $view1->dead_id->CurrentValue;
			$view1->dead_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_status
			$view1->member_status->ViewValue = $view1->member_status->CurrentValue;
			$view1->member_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// regis_date
			$view1->regis_date->ViewValue = $view1->regis_date->CurrentValue;
			$view1->regis_date->ViewValue = ewrpt_FormatDateTime($view1->regis_date->ViewValue, 6);
			$view1->regis_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_type
			$view1->pay_sum_type->ViewValue = $view1->pay_sum_type->CurrentValue;
			$view1->pay_sum_type->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// pay_sum_detail
		$view1->pay_sum_detail->HrefValue = "";

		// pay_sum_total
		$view1->pay_sum_total->HrefValue = "";

		// pay_annual_year
		$view1->pay_annual_year->HrefValue = "";

		// pay_death_end
		$view1->pay_death_end->HrefValue = "";

		// pay_sum_adv_count
		$view1->pay_sum_adv_count->HrefValue = "";

		// pay_death_begin
		$view1->pay_death_begin->HrefValue = "";

		// pay_sum_date
		$view1->pay_sum_date->HrefValue = "";

		// member_code
		$view1->member_code->HrefValue = "";

		// id_code
		$view1->id_code->HrefValue = "";

		// prefix
		$view1->prefix->HrefValue = "";

		// gender
		$view1->gender->HrefValue = "";

		// fname
		$view1->fname->HrefValue = "";

		// lname
		$view1->lname->HrefValue = "";

		// birthdate
		$view1->birthdate->HrefValue = "";

		// age
		$view1->age->HrefValue = "";

		// t_code
		$view1->t_code->HrefValue = "";

		// t_title
		$view1->t_title->HrefValue = "";

		// village_id
		$view1->village_id->HrefValue = "";

		// v_title
		$view1->v_title->HrefValue = "";

		// dead_date
		$view1->dead_date->HrefValue = "";

		// dead_id
		$view1->dead_id->HrefValue = "";

		// member_status
		$view1->member_status->HrefValue = "";

		// regis_date
		$view1->regis_date->HrefValue = "";

		// pay_sum_type
		$view1->pay_sum_type->HrefValue = "";

		// Call Row_Rendered event
		$view1->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $view1;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $view1;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$view1->setOrderBy("");
				$view1->setStartGroup(1);
				$view1->pay_sum_detail->setSort("");
				$view1->pay_sum_total->setSort("");
				$view1->pay_annual_year->setSort("");
				$view1->pay_death_end->setSort("");
				$view1->pay_sum_adv_count->setSort("");
				$view1->pay_death_begin->setSort("");
				$view1->pay_sum_date->setSort("");
				$view1->member_code->setSort("");
				$view1->id_code->setSort("");
				$view1->prefix->setSort("");
				$view1->gender->setSort("");
				$view1->fname->setSort("");
				$view1->lname->setSort("");
				$view1->birthdate->setSort("");
				$view1->age->setSort("");
				$view1->t_code->setSort("");
				$view1->t_title->setSort("");
				$view1->village_id->setSort("");
				$view1->v_title->setSort("");
				$view1->dead_date->setSort("");
				$view1->dead_id->setSort("");
				$view1->member_status->setSort("");
				$view1->regis_date->setSort("");
				$view1->pay_sum_type->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$view1->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$view1->CurrentOrderType = @$_GET["ordertype"];
			$view1->UpdateSort($view1->pay_sum_detail); // pay_sum_detail
			$view1->UpdateSort($view1->pay_sum_total); // pay_sum_total
			$view1->UpdateSort($view1->pay_annual_year); // pay_annual_year
			$view1->UpdateSort($view1->pay_death_end); // pay_death_end
			$view1->UpdateSort($view1->pay_sum_adv_count); // pay_sum_adv_count
			$view1->UpdateSort($view1->pay_death_begin); // pay_death_begin
			$view1->UpdateSort($view1->pay_sum_date); // pay_sum_date
			$view1->UpdateSort($view1->member_code); // member_code
			$view1->UpdateSort($view1->id_code); // id_code
			$view1->UpdateSort($view1->prefix); // prefix
			$view1->UpdateSort($view1->gender); // gender
			$view1->UpdateSort($view1->fname); // fname
			$view1->UpdateSort($view1->lname); // lname
			$view1->UpdateSort($view1->birthdate); // birthdate
			$view1->UpdateSort($view1->age); // age
			$view1->UpdateSort($view1->t_code); // t_code
			$view1->UpdateSort($view1->t_title); // t_title
			$view1->UpdateSort($view1->village_id); // village_id
			$view1->UpdateSort($view1->v_title); // v_title
			$view1->UpdateSort($view1->dead_date); // dead_date
			$view1->UpdateSort($view1->dead_id); // dead_id
			$view1->UpdateSort($view1->member_status); // member_status
			$view1->UpdateSort($view1->regis_date); // regis_date
			$view1->UpdateSort($view1->pay_sum_type); // pay_sum_type
			$sSortSql = $view1->SortSql();
			$view1->setOrderBy($sSortSql);
			$view1->setStartGroup(1);
		}
		return $view1->getOrderBy();
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
