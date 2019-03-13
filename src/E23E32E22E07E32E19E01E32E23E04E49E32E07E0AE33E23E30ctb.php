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
$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30 = NULL;

//
// Table class for รายงานการค้างชำระ
//
class crE23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30 {
	var $TableVar = 'E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30';
	var $TableName = 'รายงานการค้างชำระ';
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

	// Summary cells
	var $SummaryCellAttrs;
	var $SummaryViewAttrs;
	var $SummaryCurrentValue;
	var $SummaryViewValue;

	// Summary cell attributes
	function SummaryCellAttributes($i) {
		$sAtt = "";
		if (is_array($this->SummaryCellAttrs)) {
			if ($i >= 0 && $i < count($this->SummaryCellAttrs)) {
				$Attrs = $this->SummaryCellAttrs[$i];
				if (is_array($Attrs)) {
					foreach ($Attrs as $k => $v) {
						if (trim($v) <> "")
							$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
					}
				}
			}
		}
		return $sAtt;
	}

	// Summary view attributes
	function SummaryViewAttributes($i) {
		$sAtt = "";
		if (is_array($this->SummaryViewAttrs)) {
			if ($i >= 0 && $i < count($this->SummaryViewAttrs)) {
				$Attrs = $this->SummaryViewAttrs[$i];
				if (is_array($Attrs)) {
					foreach ($Attrs as $k => $v) {
						if (trim($v) <> "")
							$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
					}
				}
			}
		}
		return $sAtt;
	}

	//
	// Table class constructor
	//
	function crE23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30() {
		global $ReportLanguage;

		// t_code
		$this->t_code = new crField('E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30', 'รายงานการค้างชำระ', 'x_t_code', 't_code', 'tambon.t_code', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";

		// v_code
		$this->v_code = new crField('E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30', 'รายงานการค้างชำระ', 'x_v_code', 'v_code', 'village.v_code', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->v_code->GroupingFieldId = 2;
		$this->v_code->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['v_code'] =& $this->v_code;
		$this->v_code->DateFilter = "";
		$this->v_code->SqlSelect = "";
		$this->v_code->SqlOrderBy = "";

		// v_title
		$this->v_title = new crField('E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30', 'รายงานการค้างชำระ', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->v_title->GroupingFieldId = 3;
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "";
		$this->v_title->SqlOrderBy = "";

		// t_title
		$this->t_title = new crField('E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30', 'รายงานการค้างชำระ', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->t_title->GroupingFieldId = 1;
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "";
		$this->t_title->SqlOrderBy = "";

		// village_id
		$this->village_id = new crField('E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30', 'รายงานการค้างชำระ', 'x_village_id', 'village_id', 'village.village_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";

		// cal_type
		$this->cal_type = new crField('E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30', 'รายงานการค้างชำระ', 'x_cal_type', 'cal_type', 'subvcalculate.cal_type', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->cal_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['cal_type'] =& $this->cal_type;
		$this->cal_type->DateFilter = "";
		$this->cal_type->SqlSelect = "";
		$this->cal_type->SqlOrderBy = "";

		// total
		$this->total = new crField('E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30', 'รายงานการค้างชำระ', 'x_total', 'total', 'subvcalculate.total', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['total'] =& $this->total;
		$this->total->DateFilter = "";
		$this->total->SqlSelect = "";
		$this->total->SqlOrderBy = "";

		// pt_title
		$this->pt_title = new crField('E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30', 'รายงานการค้างชำระ', 'x_pt_title', 'pt_title', 'paymenttype.pt_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pt_title'] =& $this->pt_title;
		$this->pt_title->DateFilter = "";
		$this->pt_title->SqlSelect = "";
		$this->pt_title->SqlOrderBy = "";

		// cal_date
		$this->cal_date = new crField('E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30', 'รายงานการค้างชำระ', 'x_cal_date', 'cal_date', 'subvcalculate.cal_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->cal_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['cal_date'] =& $this->cal_date;
		$this->cal_date->DateFilter = "";
		$this->cal_date->SqlSelect = "";
		$this->cal_date->SqlOrderBy = "";

		// cal_status
		$this->cal_status = new crField('E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30', 'รายงานการค้างชำระ', 'x_cal_status', 'cal_status', 'subvcalculate.cal_status', 200, EWRPT_DATATYPE_STRING, -1);
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
	function ColumnField() { // Column field
		return "paymenttype.pt_title";
	}

	function ColumnDateType() { // Column date type
		return "";
	}

	function SummaryField() { // Summary field
		return "subvcalculate.total";
	}

	function SummaryType() { // Summary type
		return "SUM";
	}

	function ColumnCaptions() { // Column captions
		global $ReportLanguage;
		return "";
	}

	function ColumnNames() { // Column names
		return "";
	}

	function ColumnValues() { // Column values
		return "";
	}

	function SqlFrom() { // From
		return "tambon Inner Join village On tambon.t_code = village.t_code Inner Join subvcalculate On village.village_id = subvcalculate.village_id Inner Join paymenttype On subvcalculate.cal_type = paymenttype.pt_id";
	}

	function SqlSelect() { // Select
		return "SELECT tambon.t_title AS `t_title`, village.v_code AS `v_code`, village.v_title AS `v_title`, <DistinctColumnFields> FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		return "";
	}

	function SqlGroupBy() { // Group By
		return "tambon.t_title, village.v_code, village.v_title";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "tambon.t_title ASC, village.v_code ASC, village.v_title ASC";
	}

	function SqlDistinctSelect() {
		return "SELECT DISTINCT paymenttype.pt_title FROM tambon Inner Join village On tambon.t_code = village.t_code Inner Join subvcalculate On village.village_id = subvcalculate.village_id Inner Join paymenttype On subvcalculate.cal_type = paymenttype.pt_id";
	}

	function SqlDistinctWhere() {
		return "";
	}

	function SqlDistinctOrderBy() {
		return "paymenttype.pt_title ASC";
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
		return "SELECT <DistinctColumnFields> FROM " . $this->SqlFrom();
	}

	function SqlGroupByAgg() {
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
$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab = new crE23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab();
$Page =& $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab;

// Page init
$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Page_Init();

// Page main
$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "") { ?>
<script type="text/javascript">

// Create page object
var E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab = new ewrpt_Page("E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab");

// page properties
E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab.PageID = "crosstab"; // page ID
E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab.FormID = "fE23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30crosstabfilter"; // form ID
var EWRPT_PAGE_ID = E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab.PageID;

// extend page with ValidateForm function
E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var elm = fobj.sv1_cal_date;
	if (elm && !ewrpt_CheckUSDate(elm.value)) {
		if (!ewrpt_OnError(elm, "<?php echo ewrpt_JsEncode2($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->FldErrMsg()) ?>"))
			return false;
	}

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab.ValidateRequired = false; // no JavaScript validation
<?php } ?>
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ShowMessage(); ?>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "" || $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "print" || $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<!-- Table container (begin) -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="ewContainer">
<!-- Top container (begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "" || $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "print" || $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "email") { ?>
<?php } ?>
<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->TableCaption() ?>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->FilterApplied) { ?>
&nbsp;&nbsp;<a href="E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30ctb.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "") { ?>
</div></td></tr>
<!-- Top container (end) -->
<tr>
	<!-- Left container (begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- left slot -->
<?php } ?>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "" || $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "print" || $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "email") { ?>
<?php } ?>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "") { ?>
	</div></td>
	<!-- Left container (end) -->
	<!-- Center container (report) (begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- crosstab report starts -->
<div id="report_crosstab">
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "") { ?>
<?php
if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->FilterPanelOption == 2 || ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->FilterPanelOption == 3 && $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->FilterApplied) || $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Filter == "0=101") {
	$sButtonImage = "phprptimages/collapse.gif";
	$sDivDisplay = "";
} else {
	$sButtonImage = "phprptimages/expand.gif";
	$sDivDisplay = " style=\"display: none;\"";
}
?>
<a href="javascript:ewrpt_ToggleFilterPanel();" style="text-decoration: none;"><img id="ewrptToggleFilterImg" src="<?php echo $sButtonImage ?>" alt="" width="9" height="9" border="0"></a><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("Filters") ?></span><br /><br />
<div id="ewrptExtFilterPanel"<?php echo $sDivDisplay ?>>
<!-- Search form (begin) -->
<form name="fE23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30crosstabfilter" id="fE23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30crosstabfilter" action="E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30ctb.php" class="ewForm" onsubmit="return E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("="); ?><input type="hidden" name="so1_cal_date" id="so1_cal_date" value="="></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_cal_date" id="sv1_cal_date" value="<?php echo ewrpt_HtmlEncode($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->SearchValue) ?>"<?php echo ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ClearExtFilter == 'E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_cal_date') ? " class=\"ewInputCleared\"" : "" ?>>
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
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30ctb.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->StartGrp, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30ctb.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30ctb.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30ctb.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30ctb.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
</select>
		</span></td>
<?php } ?>
	</tr>
</table>
</form>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div class="ewGridMiddlePanel">
<table class="ewTable ewTableSeparate" cellspacing="0">
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ShowFirstHeader) { // Show header ?>
	<thead>
	<!-- Table header -->
	<tr class="ewTableRow">
		<td colspan="3" style="white-space: nowrap;"><div class="phpreportmaker"><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->total->FldCaption() ?>&nbsp;(<?php echo $ReportLanguage->Phrase("RptSum") ?>)&nbsp;</div></td>
		<td class="ewRptColHeader" colspan="<?php echo @$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ColSpan; ?>" style="white-space: nowrap;">
			<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->pt_title->FldCaption() ?>
		</td>
	</tr>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SortUrl($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SortUrl($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title) ?>',1);"><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SortUrl($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SortUrl($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code) ?>',1);"><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SortUrl($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SortUrl($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title) ?>',1);"><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<!-- Dynamic columns begin -->
	<?php
	$cntval = count($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Val);
	for ($iy = 1; $iy < $cntval; $iy++) {
		if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Col[$iy]->Visible) {
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCurrentValue[$iy-1] = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Col[$iy]->Caption;
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewValue[$iy-1] = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCurrentValue[$iy-1];
	?>
		<td class="ewTableHeader" style="vertical-align: top;"><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewValue[$iy-1]; ?></td>
	<?php
		}
	}
	?>
<!-- Dynamic columns end -->
		<td class="ewTableHeader" style="vertical-align: top;"><?php echo $ReportLanguage->Phrase("Total"); ?></td>
	</tr>
	</thead>
<?php } // End show header ?>
	<tbody>
<?php
if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->TotalGrps > 0) {

// Set the last group to display if not export all
if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->ExportAll && $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export <> "") {
	$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->StopGrp = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->TotalGrps;
} else {
	$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->StopGrp = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->StartGrp + $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->StopGrp) > intval($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->TotalGrps)) {
	$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->StopGrp = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->TotalGrps;
}

// Navigate
$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->RecCount = 0;

// Get first row
if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->TotalGrps > 0) {
	$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->GetGrpRow(1);
	$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->GrpCount = 1;
}
while ($rsgrp && !$rsgrp->EOF && $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->GrpCount <= $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps) {

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlFirstGroupField(), $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->GroupValue());
	if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Filter != "")
		$sWhere = "($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->SqlSelectWork, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlWhere(), $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlGroupBy(), "", $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlOrderBy(), $sWhere, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->GetRow(1);
	while ($rs && !$rs->EOF) {
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->RecCount++;

		// Render row
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->ResetCSS();
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowType = EWRPT_ROWTYPE_DETAIL;
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->RenderRow();
?>
	<!-- Data -->
	<tr<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowAttributes(); ?>>
		<!-- ตำบล -->
		<td<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->CellAttributes(); ?>><div<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->ViewAttributes(); ?>><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->GroupViewValue; ?></div></td>
		<!-- หมู่ที่ -->
		<td<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->CellAttributes(); ?>><div<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->ViewAttributes(); ?>><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->GroupViewValue; ?></div></td>
		<!-- บ้าน -->
		<td<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->CellAttributes(); ?>><div<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->ViewAttributes(); ?>><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->GroupViewValue; ?></div></td>
<!-- Dynamic columns begin -->
	<?php
		$cntcol = count($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewValue);
		for ($iy = 1; $iy <= $cntcol; $iy++) {
			$bColShow = ($iy <= $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ColCount) ? $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Col[$iy]->Visible : TRUE;
			$sColDesc = ($iy <= $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ColCount) ? $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Col[$iy]->Caption : $ReportLanguage->Phrase("Summary");
			if ($bColShow) {
	?>
		<!-- <?php //echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Col[$iy]->Caption; ?> -->
		<!-- <?php echo $sColDesc; ?> -->
		<td<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCellAttributes($iy-1) ?>><div<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewAttributes($iy-1); ?>><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewValue[$iy-1]; ?></div></td>
	<?php
			}
		}
	?>
<!-- Dynamic columns end -->
	</tr>
<?php

		// Accumulate page summary
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->AccumulateSummary();

		// Get next record
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->GetRow(2);
?>
<?php
	} // End detail records loop
?>
<?php

		// Process summary level 1
		if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ChkLvlBreak(1)) {
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->ResetCSS();
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowType = EWRPT_ROWTYPE_TOTAL;
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowGroupLevel = 1;
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->RenderRow();
?>
	<!-- Summary ตำบล (level 1) -->
	<tr<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowAttributes(); ?>>
		<td colspan="3"<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->FldCaption() ?>: <?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->GroupViewValue; ?></td>
<!-- Dynamic columns begin -->
	<?php
	$cntcol = count($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewValue);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$bColShow = ($iy <= $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ColCount) ? $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Col[$iy]->Visible : TRUE;
		$sColDesc = ($iy <= $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ColCount) ? $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Col[$iy]->Caption : $ReportLanguage->Phrase("Summary");
		if ($bColShow) {
	?>
		<!-- <?php //echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Col[$iy]->Caption; ?> -->
		<!-- <?php echo $sColDesc; ?> -->
		<td<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCellAttributes($iy-1) ?>><div<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewAttributes($iy-1); ?>><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewValue[$iy-1]; ?></div></td>
	<?php
		}
	}
	?>
<!-- Dynamic columns end -->
	</tr>
<?php

			// Reset level 1 summary
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ResetLevelSummary(1);
		}
?>
<?php
	$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->GetGrpRow(2);
	$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->GrpCount++;
}
?>
	</tbody>
	<tfoot>
<?php
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->ResetCSS();
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowType = EWRPT_ROWTYPE_TOTAL;
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowTotalType = EWRPT_ROWTOTAL_GRAND;
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowAttrs["class"] = "ewRptGrandSummary";
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->RenderRow();
?>
	<!-- Grand Total -->
	<tr<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowAttributes(); ?>>
	<td colspan="3"><?php echo $ReportLanguage->Phrase("RptGrandTotal"); ?></td>
<!-- Dynamic columns begin -->
	<?php 
	$cntcol = count($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewValue);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$bColShow = ($iy <= $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ColCount) ? $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Col[$iy]->Visible : TRUE;
		$sColDesc = ($iy <= $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ColCount) ? $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Col[$iy]->Caption : $ReportLanguage->Phrase("Summary");
		if ($bColShow) {
	?>
		<!-- <?php //echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Col[$iy]->Caption; ?> -->
		<!-- <?php echo $sColDesc; ?> -->
		<td<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCellAttributes($iy-1) ?>><div<?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewAttributes($iy-1); ?>><?php echo $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewValue[$iy-1]; ?></div></td>
	<?php
		}
	}
	?>
<!-- Dynamic columns end -->
	</tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->TotalGrps > 0) { ?>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30ctb.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->StartGrp, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30ctb.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30ctb.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30ctb.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30ctb.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<!-- Crosstab report ends -->
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "") { ?>
	</div><br /></td>
	<!-- Center container (report) (end) -->
	<!-- Right container (begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- right slot -->
<?php } ?>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "" || $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "print" || $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "email") { ?>
<?php } ?>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "") { ?>
	</div></td>
	<!-- Right container (end) -->
</tr>
<!-- Bottom container (begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- bottom slot -->
<?php } ?>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "" || $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "print" || $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "email") { ?>
<?php } ?>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom container (end) -->
</table>
<!-- Table container (end) -->
<?php } ?>
<?php $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "") { ?>
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
$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab->Page_Terminate();
?>
<?php

//
// Page class
//
class crE23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab {

	// Page ID
	var $PageID = 'crosstab';

	// Table name
	var $TableName = 'รายงานการค้างชำระ';

	// Page object name
	var $PageObjName = 'E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
		if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->UseTokenInUrl) $PageUrl .= "t=" . $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->TableVar . "&"; // Add page token
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
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
		if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crE23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_crosstab() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30)
		$GLOBALS["E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30"] = new crE23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'crosstab', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'รายงานการค้างชำระ', TRUE);

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
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export = $_GET["export"];
	}
	$gsExport = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export; // Get export parameter, used in header
	$gsExportFile = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->TableVar; // Get export file, used in header
	if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "excel") {
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
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export == "email") {
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
	var $Cnt, $Col, $Val, $Smry;
	var $ColCount, $ColSpan;
	var $SqlSelectWork, $SqlSelectAggWork;
	var $SqlChartWork;

	//
	// Page main
	//
	function Page_Main() {
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Get sort
		$this->Sort = $this->GetSort();

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();

		// Popup values and selections
		// Load default filter values

		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->CustomFilters_Load();

		// Build extended filter
		$sExtendedFilter = $this->GetExtendedFilter();
		if ($sExtendedFilter <> "") {
			if ($this->Filter <> "")
  				$this->Filter = "($this->Filter) AND ($sExtendedFilter)";
			else
				$this->Filter = $sExtendedFilter;
		}

		// Load columns to array
		$this->GetColumns();

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

		// Get total group count
		$sGrpSort = ewrpt_UpdateSortFields($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlSelectGroup(), $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlWhere(), $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlGroupBy(), "", $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->ExportAll && $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Export <> "")
			$this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup();

		// Get total groups
		$rsgrp = $this->GetGrpRs($sSql, $this->StartGrp, $this->DisplayGrps);

		// Init detail recordset
		$rs = NULL;
	}

	// Get column values
	function GetColumns() {
		global $conn;
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
		global $ReportLanguage;

		// Build SQL
		$sSql = ewrpt_BuildReportSql($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlDistinctSelect(), $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlDistinctWhere(), "", "", $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlDistinctOrderBy(), "", "");

		// Load recordset
		$rscol = $conn->Execute($sSql);

		// Get distinct column count
		$this->ColCount = ($rscol) ? $rscol->RecordCount() : 0;
		if ($this->ColCount == 0) {
			if ($rscol) $rscol->Close();
			echo $ReportLanguage->Phrase("NoDistinctColVals") . $sSql . "<br />";
			exit();
		}

		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of distinct values

		$nGrps = 3;
		$this->Col = ewrpt_InitArray($this->ColCount+1, NULL);
		$this->Val = ewrpt_InitArray($this->ColCount+1, NULL);
		$this->ValCnt = ewrpt_InitArray($this->ColCount+1, NULL);
		$this->Cnt = ewrpt_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->Smry = ewrpt_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SmryCnt = ewrpt_Init2DArray($this->ColCount+1, $nGrps+1, NULL);

		// Reset summary values
		$this->ResetLevelSummary(0);
		$colcnt = 0;
		while (!$rscol->EOF) {
			if (is_null($rscol->fields[0])) {
				$wrkValue = EWRPT_NULL_VALUE;
				$wrkCaption = $ReportLanguage->Phrase("NullLabel");
			} elseif ($rscol->fields[0] == "") {
				$wrkValue = EWRPT_EMPTY_VALUE;
				$wrkCaption = $ReportLanguage->Phrase("EmptyLabel");
			} else {
				$wrkValue = $rscol->fields[0];
				$wrkCaption = $rscol->fields[0];
			}
			$colcnt++;
			$this->Col[$colcnt] = new crCrosstabColumn($wrkValue, $wrkCaption, TRUE);
			$rscol->MoveNext();
		}
		$rscol->Close();

		// Get active columns
		if (!is_array($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->pt_title->SelectionList)) {
			$this->ColSpan = $this->ColCount;
		} else {
			$this->ColSpan = 0;
			for ($i = 1; $i <= $this->ColCount; $i++) {
				$bSelected = FALSE;
				$cntsel = count($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->pt_title->SelectionList);
				for ($j = 0; $j < $cntsel; $j++) {
					if (ewrpt_CompareValue($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->pt_title->SelectionList[$j], $this->Col[$i]->Value, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->pt_title->FldType)) {
						$this->ColSpan++;
						$bSelected = TRUE;
						break;
					}
				}
				$this->Col[$i]->Visible = $bSelected;
			}
		}
		$this->ColSpan++; // Add summary column

		// Update crosstab sql
		$sSqlFlds = "";
		for ($colcnt = 1; $colcnt <= $this->ColCount; $colcnt++) {
			$sFld = ewrpt_CrossTabField($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryType(), $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryField(), $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->ColumnField(), $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->ColumnDateType(), $this->Col[$colcnt]->Value, "'", "C" . $colcnt);
			if ($sSqlFlds <> "")
				$sSqlFlds .= ", ";
			$sSqlFlds .= $sFld;
		}
		$this->SqlSelectWork = str_replace("<DistinctColumnFields>", $sSqlFlds, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlSelect());
		$this->SqlSelectAggWork = str_replace("<DistinctColumnFields>", $sSqlFlds, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlSelectAgg());

		// Update chart sql if Y Axis = Column Field
		$this->SqlChartWork = "";
		for ($i = 0; $i < $this->ColCount; $i++) {
			if ($this->Col[$i+1]->Visible) {
				$sChtFld = ewrpt_CrossTabField("SUM", $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryField(), $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->ColumnField(), $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->ColumnDateType(), $this->Col[$i+1]->Value, "'");
				if ($this->SqlChartWork != "") $this->SqlChartWork .= "+";
				$this->SqlChartWork .= $sChtFld;
			}
		}
	}

	// Get group count
	function GetGrpCnt($sql) {
		global $conn;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

	//		$rsgrp->MoveFirst(); // NOTE: no need to move position
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF) {
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->setDbValue($rsgrp->fields('t_title'));
		} else {
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			if ($opt <> 1)
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->setDbValue($rs->fields('t_title'));
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->setDbValue($rs->fields('v_code'));
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->setDbValue($rs->fields('v_title'));
			$cntval = count($this->Val);
			for ($ix = 1; $ix < $cntval; $ix++)
				$this->Val[$ix] = $rs->fields[$ix+3-1];
		} else {
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->setDbValue("");
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->setDbValue("");
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->setDbValue("");
		}
	}

	// Check level break
	function ChkLvlBreak($lvl) {
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
		switch ($lvl) {
			case 1:
				return (is_null($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->CurrentValue) && !is_null($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->OldValue)) ||
					(!is_null($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->CurrentValue) && is_null($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->OldValue)) ||
					($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->GroupValue() <> $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->GroupOldValue());
			case 2:
				return (is_null($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->CurrentValue) && !is_null($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->OldValue)) ||
					(!is_null($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->CurrentValue) && is_null($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->OldValue)) ||
					($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->GroupValue() <> $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
			case 3:
				return (is_null($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->CurrentValue) && !is_null($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->OldValue)) ||
					(!is_null($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->CurrentValue) && is_null($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->OldValue)) ||
					($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->GroupValue() <> $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->GroupOldValue()) || $this->ChkLvlBreak(2); // Recurse upper level
		}
	}

	// Accummulate summary
	function AccumulateSummary() {
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
		$cntx = count($this->Smry);
		for ($ix = 1; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 0; $iy < $cnty; $iy++) {
				$valwrk = $this->Val[$ix];
				$this->Cnt[$ix][$iy]++;
				$this->Smry[$ix][$iy] = ewrpt_SummaryValue($this->Smry[$ix][$iy], $valwrk, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryType());
			}
		}
	}

	// Reset level summary
	function ResetLevelSummary($lvl) {

		// Clear summary values
		$cntx = count($this->Smry);
		for ($ix = 1; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = $lvl; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy] = 0;
				$this->Smry[$ix][$iy] = 0;
			}
		}

		// Reset record count
		$this->RecCount = 0;
	}

	// Set up starting group
	function SetUpStartGroup() {
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->getStartGroup();
			}
		} else {
			$this->StartGrp = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;

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
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
	}

	// Reset pager
	function ResetPager() {
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;

		// Reset start position (reset command)
		$this->StartGrp = 1;
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
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
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->setStartGroup($this->StartGrp);
		} else {
			if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->getGroupPerPage() <> "") {
				$this->DisplayGrps = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;

		// Set up summary values
		$colcnt = $this->ColCount+1;
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCellAttrs = ewrpt_InitArray($colcnt, NULL);
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewAttrs = ewrpt_InitArray($colcnt, NULL);
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCurrentValue = ewrpt_InitArray($colcnt, NULL);
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewValue = ewrpt_InitArray($colcnt, NULL);
		$rowsmry = 0;
		$rowcnt = 0;
		if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// aggregate sql
			$sSql = ewrpt_BuildReportSql($this->SqlSelectAggWork, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlWhere(), $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SqlGroupByAgg(), "", "", $this->Filter, "");
			$rsagg = $conn->Execute($sSql);
			if ($rsagg && !$rsagg->EOF) $rsagg->MoveFirst();
		}
		for ($i = 1; $i <= $this->ColCount; $i++) {
			if ($this->Col[$i]->Visible) {
				if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowType == EWRPT_ROWTYPE_DETAIL) { // Detail row
					$thisval = $this->Val[$i];
				} elseif ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowTotalType == EWRPT_ROWTOTAL_GROUP) { // Group total
					$thisval = $this->Smry[$i][$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowGroupLevel];
				} elseif ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowTotalType == EWRPT_ROWTOTAL_PAGE) { // Page total
					$thisval = $this->Smry[$i][0];
				} elseif ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total
					$thisval = ($rsagg && !$rsagg->EOF) ? $rsagg->fields[$i+0-1] : 0;
				}
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCurrentValue[$i-1] = $thisval;
				$rowsmry = ewrpt_SummaryValue($rowsmry, $thisval, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryType());
			}
		}
		if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total
			if ($rsagg) $rsagg->Close();
		}
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCurrentValue[$this->ColCount] = $rowsmry;

		// Call Row_Rendering event
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// t_title
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->GroupViewValue = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->GroupOldValue();
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->CellAttrs["class"] = ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";

			// v_code
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->GroupViewValue = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->GroupOldValue();
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->CellAttrs["class"] = ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";

			// v_title
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->GroupViewValue = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->GroupOldValue();
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->CellAttrs["class"] = ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowGroupLevel == 3) ? "ewRptGrpSummary3" : "ewRptGrpField3";

			// Set up summary values
			$scvcnt = count($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCurrentValue);
			for ($i = 0; $i < $scvcnt; $i++) {
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewValue[$i] = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCurrentValue[$i];
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCellAttrs[$i]["style"] = "";
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCellAttrs[$i]["class"] = ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowTotalType == EWRPT_ROWTOTAL_GROUP) ? "ewRptGrpSummary" . $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->RowGroupLevel : "";
			}
		} else {

			// t_title
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->GroupViewValue = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->GroupValue();
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->CellAttrs["class"] = "ewRptGrpField1";
			if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->GroupValue() == $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->GroupOldValue() && !$this->ChkLvlBreak(1))
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->GroupViewValue = "&nbsp;";

			// v_code
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->GroupViewValue = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->GroupValue();
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->CellAttrs["class"] = "ewRptGrpField2";
			if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->GroupValue() == $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->GroupOldValue() && !$this->ChkLvlBreak(2))
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->GroupViewValue = "&nbsp;";

			// v_title
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->GroupViewValue = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->GroupValue();
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->CellAttrs["class"] = "ewRptGrpField3";
			if ($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->GroupValue() == $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->GroupOldValue() && !$this->ChkLvlBreak(3))
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->GroupViewValue = "&nbsp;";

			// Set up summary values
			$scvcnt = count($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCurrentValue);
			for ($i = 0; $i < $scvcnt; $i++) {
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryViewValue[$i] = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCurrentValue[$i];
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCellAttrs[$i]["style"] = "";
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SummaryCellAttrs[$i]["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			}
		}

		// t_title
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->HrefValue = "";

		// v_code
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->HrefValue = "";

		// v_title
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->HrefValue = "";

		// Call Row_Rendered event
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
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
			// Field cal_date

			$this->SetSessionFilterValues($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->SearchValue, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->SearchOperator, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->SearchCondition, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->SearchValue2, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->SearchOperator2, 'cal_date');
			$bSetupFilter = TRUE;
		} else {

			// Field cal_date
			if ($this->GetFilterValues($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date)) {
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

			// Field cal_date
			$this->GetSessionFilterValues($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date);
		}

		// Call page filter validated event
		$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->Page_FilterValidated();

		// Build SQL
		// Field cal_date

		$this->BuildExtendedFilter($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date, $sFilter);

		// Save parms to session
		// Field cal_date

		$this->SetSessionFilterValues($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->SearchValue, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->SearchOperator, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->SearchCondition, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->SearchValue2, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->SearchOperator2, 'cal_date');

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
		$this->GetSessionValue($fld->DropDownValue, 'sv_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_' . $parm] = $sv1;
		$_SESSION['so1_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_' . $parm] = $so1;
		$_SESSION['sc_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_' . $parm] = $sc;
		$_SESSION['sv2_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_' . $parm] = $sv2;
		$_SESSION['so2_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EWRPT_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ewrpt_CheckUSDate($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->SearchValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br />";
			$gsFormError .= $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->FldErrMsg();
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
		$_SESSION["sel_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_$parm"] = "";
		$_SESSION["rf_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_$parm"] = "";
		$_SESSION["rt_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
		$fld =& $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_$parm"];
		$fld->RangeTo = @$_SESSION["rt_E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;

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

		// Field cal_date
		$this->SetDefaultExtFilter($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date, "=", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date);

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/
	}

	// Check if filter applied
	function CheckFilter() {
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;

		// Check cal_date text filter
		if ($this->TextFilterApplied($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field cal_date
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->cal_date->FldCaption() . "<br />";
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
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->setOrderBy("");
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->setStartGroup(1);
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title->setSort("");
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code->setSort("");
				$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->CurrentOrderType = @$_GET["ordertype"];
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->UpdateSort($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->t_title); // t_title
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->UpdateSort($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_code); // v_code
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->UpdateSort($E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->v_title); // v_title
			$sSortSql = $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->SortSql();
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->setOrderBy($sSortSql);
			$E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->setStartGroup(1);
		}
		return $E23E32E22E07E32E19E01E32E23E04E49E32E07E0AE33E23E30->getOrderBy();
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
