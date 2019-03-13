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
$members = NULL;

//
// Table class for members
//
class crmembers {
	var $TableVar = 'members';
	var $TableName = 'members';
	var $TableType = 'TABLE';
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
	var $member_id;
	var $member_type;
	var $member_code;
	var $id_code;
	var $gender;
	var $prefix;
	var $fname;
	var $lname;
	var $birthdate;
	var $age;
	var $zemail;
	var $phone;
	var $address;
	var $t_code;
	var $village_id;
	var $suffix;
	var $bnfc1_name;
	var $bnfc1_rel;
	var $bnfc2_name;
	var $bnfc2_rel;
	var $bnfc3_name;
	var $bnfc3_rel;
	var $bnfc4_name;
	var $bnfc4_rel;
	var $attachment;
	var $regis_date;
	var $effective_date;
	var $resign_date;
	var $dead_date;
	var $terminate_date;
	var $member_status;
	var $advance_budget;
	var $dead_id;
	var $note;
	var $update_detail;
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
	function crmembers() {
		global $ReportLanguage;

		// member_id
		$this->member_id = new crField('members', 'members', 'x_member_id', 'member_id', '`member_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->member_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['member_id'] =& $this->member_id;
		$this->member_id->DateFilter = "";
		$this->member_id->SqlSelect = "";
		$this->member_id->SqlOrderBy = "";

		// member_type
		$this->member_type = new crField('members', 'members', 'x_member_type', 'member_type', '`member_type`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->member_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['member_type'] =& $this->member_type;
		$this->member_type->DateFilter = "";
		$this->member_type->SqlSelect = "";
		$this->member_type->SqlOrderBy = "";

		// member_code
		$this->member_code = new crField('members', 'members', 'x_member_code', 'member_code', '`member_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";

		// id_code
		$this->id_code = new crField('members', 'members', 'x_id_code', 'id_code', '`id_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['id_code'] =& $this->id_code;
		$this->id_code->DateFilter = "";
		$this->id_code->SqlSelect = "";
		$this->id_code->SqlOrderBy = "";

		// gender
		$this->gender = new crField('members', 'members', 'x_gender', 'gender', '`gender`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['gender'] =& $this->gender;
		$this->gender->DateFilter = "";
		$this->gender->SqlSelect = "";
		$this->gender->SqlOrderBy = "";

		// prefix
		$this->prefix = new crField('members', 'members', 'x_prefix', 'prefix', '`prefix`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['prefix'] =& $this->prefix;
		$this->prefix->DateFilter = "";
		$this->prefix->SqlSelect = "";
		$this->prefix->SqlOrderBy = "";

		// fname
		$this->fname = new crField('members', 'members', 'x_fname', 'fname', '`fname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";

		// lname
		$this->lname = new crField('members', 'members', 'x_lname', 'lname', '`lname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";

		// birthdate
		$this->birthdate = new crField('members', 'members', 'x_birthdate', 'birthdate', '`birthdate`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->birthdate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['birthdate'] =& $this->birthdate;
		$this->birthdate->DateFilter = "";
		$this->birthdate->SqlSelect = "";
		$this->birthdate->SqlOrderBy = "";

		// age
		$this->age = new crField('members', 'members', 'x_age', 'age', '`age`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;
		$this->age->DateFilter = "";
		$this->age->SqlSelect = "";
		$this->age->SqlOrderBy = "";

		// email
		$this->zemail = new crField('members', 'members', 'x_zemail', 'email', '`email`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['zemail'] =& $this->zemail;
		$this->zemail->DateFilter = "";
		$this->zemail->SqlSelect = "";
		$this->zemail->SqlOrderBy = "";

		// phone
		$this->phone = new crField('members', 'members', 'x_phone', 'phone', '`phone`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['phone'] =& $this->phone;
		$this->phone->DateFilter = "";
		$this->phone->SqlSelect = "";
		$this->phone->SqlOrderBy = "";

		// address
		$this->address = new crField('members', 'members', 'x_address', 'address', '`address`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['address'] =& $this->address;
		$this->address->DateFilter = "";
		$this->address->SqlSelect = "";
		$this->address->SqlOrderBy = "";

		// t_code
		$this->t_code = new crField('members', 'members', 'x_t_code', 't_code', '`t_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";

		// village_id
		$this->village_id = new crField('members', 'members', 'x_village_id', 'village_id', '`village_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";

		// suffix
		$this->suffix = new crField('members', 'members', 'x_suffix', 'suffix', '`suffix`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['suffix'] =& $this->suffix;
		$this->suffix->DateFilter = "";
		$this->suffix->SqlSelect = "";
		$this->suffix->SqlOrderBy = "";

		// bnfc1_name
		$this->bnfc1_name = new crField('members', 'members', 'x_bnfc1_name', 'bnfc1_name', '`bnfc1_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_name'] =& $this->bnfc1_name;
		$this->bnfc1_name->DateFilter = "";
		$this->bnfc1_name->SqlSelect = "";
		$this->bnfc1_name->SqlOrderBy = "";

		// bnfc1_rel
		$this->bnfc1_rel = new crField('members', 'members', 'x_bnfc1_rel', 'bnfc1_rel', '`bnfc1_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_rel'] =& $this->bnfc1_rel;
		$this->bnfc1_rel->DateFilter = "";
		$this->bnfc1_rel->SqlSelect = "";
		$this->bnfc1_rel->SqlOrderBy = "";

		// bnfc2_name
		$this->bnfc2_name = new crField('members', 'members', 'x_bnfc2_name', 'bnfc2_name', '`bnfc2_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_name'] =& $this->bnfc2_name;
		$this->bnfc2_name->DateFilter = "";
		$this->bnfc2_name->SqlSelect = "";
		$this->bnfc2_name->SqlOrderBy = "";

		// bnfc2_rel
		$this->bnfc2_rel = new crField('members', 'members', 'x_bnfc2_rel', 'bnfc2_rel', '`bnfc2_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_rel'] =& $this->bnfc2_rel;
		$this->bnfc2_rel->DateFilter = "";
		$this->bnfc2_rel->SqlSelect = "";
		$this->bnfc2_rel->SqlOrderBy = "";

		// bnfc3_name
		$this->bnfc3_name = new crField('members', 'members', 'x_bnfc3_name', 'bnfc3_name', '`bnfc3_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_name'] =& $this->bnfc3_name;
		$this->bnfc3_name->DateFilter = "";
		$this->bnfc3_name->SqlSelect = "";
		$this->bnfc3_name->SqlOrderBy = "";

		// bnfc3_rel
		$this->bnfc3_rel = new crField('members', 'members', 'x_bnfc3_rel', 'bnfc3_rel', '`bnfc3_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_rel'] =& $this->bnfc3_rel;
		$this->bnfc3_rel->DateFilter = "";
		$this->bnfc3_rel->SqlSelect = "";
		$this->bnfc3_rel->SqlOrderBy = "";

		// bnfc4_name
		$this->bnfc4_name = new crField('members', 'members', 'x_bnfc4_name', 'bnfc4_name', '`bnfc4_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc4_name'] =& $this->bnfc4_name;
		$this->bnfc4_name->DateFilter = "";
		$this->bnfc4_name->SqlSelect = "";
		$this->bnfc4_name->SqlOrderBy = "";

		// bnfc4_rel
		$this->bnfc4_rel = new crField('members', 'members', 'x_bnfc4_rel', 'bnfc4_rel', '`bnfc4_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc4_rel'] =& $this->bnfc4_rel;
		$this->bnfc4_rel->DateFilter = "";
		$this->bnfc4_rel->SqlSelect = "";
		$this->bnfc4_rel->SqlOrderBy = "";

		// attachment
		$this->attachment = new crField('members', 'members', 'x_attachment', 'attachment', '`attachment`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['attachment'] =& $this->attachment;
		$this->attachment->DateFilter = "";
		$this->attachment->SqlSelect = "";
		$this->attachment->SqlOrderBy = "";

		// regis_date
		$this->regis_date = new crField('members', 'members', 'x_regis_date', 'regis_date', '`regis_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->regis_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['regis_date'] =& $this->regis_date;
		$this->regis_date->DateFilter = "";
		$this->regis_date->SqlSelect = "";
		$this->regis_date->SqlOrderBy = "";

		// effective_date
		$this->effective_date = new crField('members', 'members', 'x_effective_date', 'effective_date', '`effective_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->effective_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['effective_date'] =& $this->effective_date;
		$this->effective_date->DateFilter = "";
		$this->effective_date->SqlSelect = "";
		$this->effective_date->SqlOrderBy = "";

		// resign_date
		$this->resign_date = new crField('members', 'members', 'x_resign_date', 'resign_date', '`resign_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->resign_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['resign_date'] =& $this->resign_date;
		$this->resign_date->DateFilter = "";
		$this->resign_date->SqlSelect = "";
		$this->resign_date->SqlOrderBy = "";

		// dead_date
		$this->dead_date = new crField('members', 'members', 'x_dead_date', 'dead_date', '`dead_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->dead_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['dead_date'] =& $this->dead_date;
		$this->dead_date->DateFilter = "";
		$this->dead_date->SqlSelect = "";
		$this->dead_date->SqlOrderBy = "";

		// terminate_date
		$this->terminate_date = new crField('members', 'members', 'x_terminate_date', 'terminate_date', '`terminate_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->terminate_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['terminate_date'] =& $this->terminate_date;
		$this->terminate_date->DateFilter = "";
		$this->terminate_date->SqlSelect = "";
		$this->terminate_date->SqlOrderBy = "";

		// member_status
		$this->member_status = new crField('members', 'members', 'x_member_status', 'member_status', '`member_status`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_status'] =& $this->member_status;
		$this->member_status->DateFilter = "";
		$this->member_status->SqlSelect = "";
		$this->member_status->SqlOrderBy = "";

		// advance_budget
		$this->advance_budget = new crField('members', 'members', 'x_advance_budget', 'advance_budget', '`advance_budget`', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->advance_budget->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['advance_budget'] =& $this->advance_budget;
		$this->advance_budget->DateFilter = "";
		$this->advance_budget->SqlSelect = "";
		$this->advance_budget->SqlOrderBy = "";

		// dead_id
		$this->dead_id = new crField('members', 'members', 'x_dead_id', 'dead_id', '`dead_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->dead_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['dead_id'] =& $this->dead_id;
		$this->dead_id->DateFilter = "";
		$this->dead_id->SqlSelect = "";
		$this->dead_id->SqlOrderBy = "";

		// note
		$this->note = new crField('members', 'members', 'x_note', 'note', '`note`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['note'] =& $this->note;
		$this->note->DateFilter = "";
		$this->note->SqlSelect = "";
		$this->note->SqlOrderBy = "";

		// update_detail
		$this->update_detail = new crField('members', 'members', 'x_update_detail', 'update_detail', '`update_detail`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['update_detail'] =& $this->update_detail;
		$this->update_detail->DateFilter = "";
		$this->update_detail->SqlSelect = "";
		$this->update_detail->SqlOrderBy = "";
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
		return "`members`";
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
$members_rpt = new crmembers_rpt();
$Page =& $members_rpt;

// Page init
$members_rpt->Page_Init();

// Page main
$members_rpt->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($members->Export == "") { ?>
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
<?php $members_rpt->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $members_rpt->ShowMessage(); ?>
<?php if ($members->Export == "" || $members->Export == "print" || $members->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($members->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($members->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($members->Export == "" || $members->Export == "print" || $members->Export == "email") { ?>
<?php } ?>
<?php echo $members->TableCaption() ?>
<?php if ($members->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $members_rpt->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $members_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
<?php } ?>
<br /><br />
<?php if ($members->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($members->Export == "" || $members->Export == "print" || $members->Export == "email") { ?>
<?php } ?>
<?php if ($members->Export == "") { ?>
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
<?php if ($members->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="membersrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($members_rpt->StartGrp, $members_rpt->DisplayGrps, $members_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="membersrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="membersrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="membersrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="membersrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($members_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($members_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($members_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($members_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($members_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($members_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($members_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($members_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($members_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($members_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($members->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($members->ExportAll && $members->Export <> "") {
	$members_rpt->StopGrp = $members_rpt->TotalGrps;
} else {
	$members_rpt->StopGrp = $members_rpt->StartGrp + $members_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($members_rpt->StopGrp) > intval($members_rpt->TotalGrps))
	$members_rpt->StopGrp = $members_rpt->TotalGrps;
$members_rpt->RecCount = 0;

// Get first row
if ($members_rpt->TotalGrps > 0) {
	$members_rpt->GetRow(1);
	$members_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $members_rpt->GrpCount <= $members_rpt->DisplayGrps) || $members_rpt->ShowFirstHeader) {

	// Show header
	if ($members_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->member_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->member_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->member_id) ?>',1);"><?php echo $members->member_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->member_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->member_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->member_type) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->member_type->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->member_type) ?>',1);"><?php echo $members->member_type->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->member_type->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->member_type->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->member_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->member_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->member_code) ?>',1);"><?php echo $members->member_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->member_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->member_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->id_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->id_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->id_code) ?>',1);"><?php echo $members->id_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->id_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->id_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->gender) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->gender->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->gender) ?>',1);"><?php echo $members->gender->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->gender->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->gender->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->prefix) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->prefix->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->prefix) ?>',1);"><?php echo $members->prefix->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->prefix->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->prefix->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->fname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->fname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->fname) ?>',1);"><?php echo $members->fname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->fname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->fname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->lname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->lname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->lname) ?>',1);"><?php echo $members->lname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->lname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->lname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->birthdate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->birthdate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->birthdate) ?>',1);"><?php echo $members->birthdate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->birthdate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->birthdate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->age) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->age) ?>',1);"><?php echo $members->age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->zemail) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->zemail->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->zemail) ?>',1);"><?php echo $members->zemail->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->zemail->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->zemail->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->phone) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->phone->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->phone) ?>',1);"><?php echo $members->phone->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->phone->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->phone->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->address) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->address->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->address) ?>',1);"><?php echo $members->address->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->address->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->address->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->t_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->t_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->t_code) ?>',1);"><?php echo $members->t_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->t_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->t_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->village_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->village_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->village_id) ?>',1);"><?php echo $members->village_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->village_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->village_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->suffix) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->suffix->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->suffix) ?>',1);"><?php echo $members->suffix->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->suffix->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->suffix->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->bnfc1_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->bnfc1_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->bnfc1_name) ?>',1);"><?php echo $members->bnfc1_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->bnfc1_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc1_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->bnfc1_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->bnfc1_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->bnfc1_rel) ?>',1);"><?php echo $members->bnfc1_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->bnfc1_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc1_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->bnfc2_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->bnfc2_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->bnfc2_name) ?>',1);"><?php echo $members->bnfc2_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->bnfc2_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc2_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->bnfc2_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->bnfc2_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->bnfc2_rel) ?>',1);"><?php echo $members->bnfc2_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->bnfc2_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc2_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->bnfc3_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->bnfc3_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->bnfc3_name) ?>',1);"><?php echo $members->bnfc3_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->bnfc3_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc3_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->bnfc3_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->bnfc3_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->bnfc3_rel) ?>',1);"><?php echo $members->bnfc3_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->bnfc3_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc3_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->bnfc4_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->bnfc4_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->bnfc4_name) ?>',1);"><?php echo $members->bnfc4_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->bnfc4_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc4_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->bnfc4_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->bnfc4_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->bnfc4_rel) ?>',1);"><?php echo $members->bnfc4_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->bnfc4_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->bnfc4_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->attachment) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->attachment->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->attachment) ?>',1);"><?php echo $members->attachment->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->attachment->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->attachment->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->regis_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->regis_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->regis_date) ?>',1);"><?php echo $members->regis_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->regis_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->regis_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->effective_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->effective_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->effective_date) ?>',1);"><?php echo $members->effective_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->effective_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->effective_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->resign_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->resign_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->resign_date) ?>',1);"><?php echo $members->resign_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->resign_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->resign_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->dead_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->dead_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->dead_date) ?>',1);"><?php echo $members->dead_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->dead_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->dead_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->terminate_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->terminate_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->terminate_date) ?>',1);"><?php echo $members->terminate_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->terminate_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->terminate_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->member_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->member_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->member_status) ?>',1);"><?php echo $members->member_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->member_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->member_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->advance_budget) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->advance_budget->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->advance_budget) ?>',1);"><?php echo $members->advance_budget->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->advance_budget->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->advance_budget->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($members->SortUrl($members->dead_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $members->dead_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $members->SortUrl($members->dead_id) ?>',1);"><?php echo $members->dead_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($members->dead_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->dead_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$members_rpt->ShowFirstHeader = FALSE;
	}
	$members_rpt->RecCount++;

		// Render detail row
		$members->ResetCSS();
		$members->RowType = EWRPT_ROWTYPE_DETAIL;
		$members_rpt->RenderRow();
?>
	<tr<?php echo $members->RowAttributes(); ?>>
		<td<?php echo $members->member_id->CellAttributes() ?>>
<div<?php echo $members->member_id->ViewAttributes(); ?>><?php echo $members->member_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->member_type->CellAttributes() ?>>
<div<?php echo $members->member_type->ViewAttributes(); ?>><?php echo $members->member_type->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->member_code->CellAttributes() ?>>
<div<?php echo $members->member_code->ViewAttributes(); ?>><?php echo $members->member_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->id_code->CellAttributes() ?>>
<div<?php echo $members->id_code->ViewAttributes(); ?>><?php echo $members->id_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->gender->CellAttributes() ?>>
<div<?php echo $members->gender->ViewAttributes(); ?>><?php echo $members->gender->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->prefix->CellAttributes() ?>>
<div<?php echo $members->prefix->ViewAttributes(); ?>><?php echo $members->prefix->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->fname->CellAttributes() ?>>
<div<?php echo $members->fname->ViewAttributes(); ?>><?php echo $members->fname->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->lname->CellAttributes() ?>>
<div<?php echo $members->lname->ViewAttributes(); ?>><?php echo $members->lname->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->birthdate->CellAttributes() ?>>
<div<?php echo $members->birthdate->ViewAttributes(); ?>><?php echo $members->birthdate->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->age->CellAttributes() ?>>
<div<?php echo $members->age->ViewAttributes(); ?>><?php echo $members->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->zemail->CellAttributes() ?>>
<div<?php echo $members->zemail->ViewAttributes(); ?>><?php echo $members->zemail->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->phone->CellAttributes() ?>>
<div<?php echo $members->phone->ViewAttributes(); ?>><?php echo $members->phone->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->address->CellAttributes() ?>>
<div<?php echo $members->address->ViewAttributes(); ?>><?php echo $members->address->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->t_code->CellAttributes() ?>>
<div<?php echo $members->t_code->ViewAttributes(); ?>><?php echo $members->t_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->village_id->CellAttributes() ?>>
<div<?php echo $members->village_id->ViewAttributes(); ?>><?php echo $members->village_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->suffix->CellAttributes() ?>>
<div<?php echo $members->suffix->ViewAttributes(); ?>><?php echo $members->suffix->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->bnfc1_name->CellAttributes() ?>>
<div<?php echo $members->bnfc1_name->ViewAttributes(); ?>><?php echo $members->bnfc1_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->bnfc1_rel->CellAttributes() ?>>
<div<?php echo $members->bnfc1_rel->ViewAttributes(); ?>><?php echo $members->bnfc1_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->bnfc2_name->CellAttributes() ?>>
<div<?php echo $members->bnfc2_name->ViewAttributes(); ?>><?php echo $members->bnfc2_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->bnfc2_rel->CellAttributes() ?>>
<div<?php echo $members->bnfc2_rel->ViewAttributes(); ?>><?php echo $members->bnfc2_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->bnfc3_name->CellAttributes() ?>>
<div<?php echo $members->bnfc3_name->ViewAttributes(); ?>><?php echo $members->bnfc3_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->bnfc3_rel->CellAttributes() ?>>
<div<?php echo $members->bnfc3_rel->ViewAttributes(); ?>><?php echo $members->bnfc3_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->bnfc4_name->CellAttributes() ?>>
<div<?php echo $members->bnfc4_name->ViewAttributes(); ?>><?php echo $members->bnfc4_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->bnfc4_rel->CellAttributes() ?>>
<div<?php echo $members->bnfc4_rel->ViewAttributes(); ?>><?php echo $members->bnfc4_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->attachment->CellAttributes() ?>>
<div<?php echo $members->attachment->ViewAttributes(); ?>><?php echo $members->attachment->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->regis_date->CellAttributes() ?>>
<div<?php echo $members->regis_date->ViewAttributes(); ?>><?php echo $members->regis_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->effective_date->CellAttributes() ?>>
<div<?php echo $members->effective_date->ViewAttributes(); ?>><?php echo $members->effective_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->resign_date->CellAttributes() ?>>
<div<?php echo $members->resign_date->ViewAttributes(); ?>><?php echo $members->resign_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->dead_date->CellAttributes() ?>>
<div<?php echo $members->dead_date->ViewAttributes(); ?>><?php echo $members->dead_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->terminate_date->CellAttributes() ?>>
<div<?php echo $members->terminate_date->ViewAttributes(); ?>><?php echo $members->terminate_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->member_status->CellAttributes() ?>>
<div<?php echo $members->member_status->ViewAttributes(); ?>><?php echo $members->member_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->advance_budget->CellAttributes() ?>>
<div<?php echo $members->advance_budget->ViewAttributes(); ?>><?php echo $members->advance_budget->ListViewValue(); ?></div>
</td>
		<td<?php echo $members->dead_id->CellAttributes() ?>>
<div<?php echo $members->dead_id->ViewAttributes(); ?>><?php echo $members->dead_id->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$members_rpt->AccumulateSummary();

		// Get next record
		$members_rpt->GetRow(2);
	$members_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($members_rpt->TotalGrps > 0) { ?>
<?php if ($members->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="membersrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($members_rpt->StartGrp, $members_rpt->DisplayGrps, $members_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="membersrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="membersrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="membersrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="membersrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($members_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($members_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($members_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($members_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($members_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($members_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($members_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($members_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($members_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($members_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($members->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($members->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($members->Export == "" || $members->Export == "print" || $members->Export == "email") { ?>
<?php } ?>
<?php if ($members->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($members->Export == "" || $members->Export == "print" || $members->Export == "email") { ?>
<?php } ?>
<?php if ($members->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $members_rpt->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($members->Export == "") { ?>
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
$members_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crmembers_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'members';

	// Page object name
	var $PageObjName = 'members_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $members;
		if ($members->UseTokenInUrl) $PageUrl .= "t=" . $members->TableVar . "&"; // Add page token
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
		global $members;
		if ($members->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($members->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($members->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crmembers_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (members)
		$GLOBALS["members"] = new crmembers();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'members', TRUE);

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
		global $members;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$members->Export = $_GET["export"];
	}
	$gsExport = $members->Export; // Get export parameter, used in header
	$gsExportFile = $members->TableVar; // Get export file, used in header
	if ($members->Export == "excel") {
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
		global $members;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($members->Export == "email") {
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
		global $members;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 34;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

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
		$sSql = ewrpt_BuildReportSql($members->SqlSelect(), $members->SqlWhere(), $members->SqlGroupBy(), $members->SqlHaving(), $members->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($members->ExportAll && $members->Export <> "")
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
		global $members;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$members->member_id->setDbValue($rs->fields('member_id'));
			$members->member_type->setDbValue($rs->fields('member_type'));
			$members->member_code->setDbValue($rs->fields('member_code'));
			$members->id_code->setDbValue($rs->fields('id_code'));
			$members->gender->setDbValue($rs->fields('gender'));
			$members->prefix->setDbValue($rs->fields('prefix'));
			$members->fname->setDbValue($rs->fields('fname'));
			$members->lname->setDbValue($rs->fields('lname'));
			$members->birthdate->setDbValue($rs->fields('birthdate'));
			$members->age->setDbValue($rs->fields('age'));
			$members->zemail->setDbValue($rs->fields('email'));
			$members->phone->setDbValue($rs->fields('phone'));
			$members->address->setDbValue($rs->fields('address'));
			$members->t_code->setDbValue($rs->fields('t_code'));
			$members->village_id->setDbValue($rs->fields('village_id'));
			$members->suffix->setDbValue($rs->fields('suffix'));
			$members->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
			$members->bnfc1_rel->setDbValue($rs->fields('bnfc1_rel'));
			$members->bnfc2_name->setDbValue($rs->fields('bnfc2_name'));
			$members->bnfc2_rel->setDbValue($rs->fields('bnfc2_rel'));
			$members->bnfc3_name->setDbValue($rs->fields('bnfc3_name'));
			$members->bnfc3_rel->setDbValue($rs->fields('bnfc3_rel'));
			$members->bnfc4_name->setDbValue($rs->fields('bnfc4_name'));
			$members->bnfc4_rel->setDbValue($rs->fields('bnfc4_rel'));
			$members->attachment->setDbValue($rs->fields('attachment'));
			$members->regis_date->setDbValue($rs->fields('regis_date'));
			$members->effective_date->setDbValue($rs->fields('effective_date'));
			$members->resign_date->setDbValue($rs->fields('resign_date'));
			$members->dead_date->setDbValue($rs->fields('dead_date'));
			$members->terminate_date->setDbValue($rs->fields('terminate_date'));
			$members->member_status->setDbValue($rs->fields('member_status'));
			$members->advance_budget->setDbValue($rs->fields('advance_budget'));
			$members->dead_id->setDbValue($rs->fields('dead_id'));
			$members->note->setDbValue($rs->fields('note'));
			$members->update_detail->setDbValue($rs->fields('update_detail'));
			$this->Val[1] = $members->member_id->CurrentValue;
			$this->Val[2] = $members->member_type->CurrentValue;
			$this->Val[3] = $members->member_code->CurrentValue;
			$this->Val[4] = $members->id_code->CurrentValue;
			$this->Val[5] = $members->gender->CurrentValue;
			$this->Val[6] = $members->prefix->CurrentValue;
			$this->Val[7] = $members->fname->CurrentValue;
			$this->Val[8] = $members->lname->CurrentValue;
			$this->Val[9] = $members->birthdate->CurrentValue;
			$this->Val[10] = $members->age->CurrentValue;
			$this->Val[11] = $members->zemail->CurrentValue;
			$this->Val[12] = $members->phone->CurrentValue;
			$this->Val[13] = $members->address->CurrentValue;
			$this->Val[14] = $members->t_code->CurrentValue;
			$this->Val[15] = $members->village_id->CurrentValue;
			$this->Val[16] = $members->suffix->CurrentValue;
			$this->Val[17] = $members->bnfc1_name->CurrentValue;
			$this->Val[18] = $members->bnfc1_rel->CurrentValue;
			$this->Val[19] = $members->bnfc2_name->CurrentValue;
			$this->Val[20] = $members->bnfc2_rel->CurrentValue;
			$this->Val[21] = $members->bnfc3_name->CurrentValue;
			$this->Val[22] = $members->bnfc3_rel->CurrentValue;
			$this->Val[23] = $members->bnfc4_name->CurrentValue;
			$this->Val[24] = $members->bnfc4_rel->CurrentValue;
			$this->Val[25] = $members->attachment->CurrentValue;
			$this->Val[26] = $members->regis_date->CurrentValue;
			$this->Val[27] = $members->effective_date->CurrentValue;
			$this->Val[28] = $members->resign_date->CurrentValue;
			$this->Val[29] = $members->dead_date->CurrentValue;
			$this->Val[30] = $members->terminate_date->CurrentValue;
			$this->Val[31] = $members->member_status->CurrentValue;
			$this->Val[32] = $members->advance_budget->CurrentValue;
			$this->Val[33] = $members->dead_id->CurrentValue;
		} else {
			$members->member_id->setDbValue("");
			$members->member_type->setDbValue("");
			$members->member_code->setDbValue("");
			$members->id_code->setDbValue("");
			$members->gender->setDbValue("");
			$members->prefix->setDbValue("");
			$members->fname->setDbValue("");
			$members->lname->setDbValue("");
			$members->birthdate->setDbValue("");
			$members->age->setDbValue("");
			$members->zemail->setDbValue("");
			$members->phone->setDbValue("");
			$members->address->setDbValue("");
			$members->t_code->setDbValue("");
			$members->village_id->setDbValue("");
			$members->suffix->setDbValue("");
			$members->bnfc1_name->setDbValue("");
			$members->bnfc1_rel->setDbValue("");
			$members->bnfc2_name->setDbValue("");
			$members->bnfc2_rel->setDbValue("");
			$members->bnfc3_name->setDbValue("");
			$members->bnfc3_rel->setDbValue("");
			$members->bnfc4_name->setDbValue("");
			$members->bnfc4_rel->setDbValue("");
			$members->attachment->setDbValue("");
			$members->regis_date->setDbValue("");
			$members->effective_date->setDbValue("");
			$members->resign_date->setDbValue("");
			$members->dead_date->setDbValue("");
			$members->terminate_date->setDbValue("");
			$members->member_status->setDbValue("");
			$members->advance_budget->setDbValue("");
			$members->dead_id->setDbValue("");
			$members->note->setDbValue("");
			$members->update_detail->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $members;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$members->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$members->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $members->getStartGroup();
			}
		} else {
			$this->StartGrp = $members->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$members->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$members->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$members->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $members;

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
		global $members;
		$this->StartGrp = 1;
		$members->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $members;
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
			$members->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$members->setStartGroup($this->StartGrp);
		} else {
			if ($members->getGroupPerPage() <> "") {
				$this->DisplayGrps = $members->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $members;
		if ($members->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($members->SqlSelectCount(), $members->SqlWhere(), $members->SqlGroupBy(), $members->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$members->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($members->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// member_id
			$members->member_id->ViewValue = $members->member_id->Summary;

			// member_type
			$members->member_type->ViewValue = $members->member_type->Summary;

			// member_code
			$members->member_code->ViewValue = $members->member_code->Summary;

			// id_code
			$members->id_code->ViewValue = $members->id_code->Summary;

			// gender
			$members->gender->ViewValue = $members->gender->Summary;

			// prefix
			$members->prefix->ViewValue = $members->prefix->Summary;

			// fname
			$members->fname->ViewValue = $members->fname->Summary;

			// lname
			$members->lname->ViewValue = $members->lname->Summary;

			// birthdate
			$members->birthdate->ViewValue = $members->birthdate->Summary;
			$members->birthdate->ViewValue = ewrpt_FormatDateTime($members->birthdate->ViewValue, 6);

			// age
			$members->age->ViewValue = $members->age->Summary;

			// email
			$members->zemail->ViewValue = $members->zemail->Summary;

			// phone
			$members->phone->ViewValue = $members->phone->Summary;

			// address
			$members->address->ViewValue = $members->address->Summary;

			// t_code
			$members->t_code->ViewValue = $members->t_code->Summary;

			// village_id
			$members->village_id->ViewValue = $members->village_id->Summary;

			// suffix
			$members->suffix->ViewValue = $members->suffix->Summary;

			// bnfc1_name
			$members->bnfc1_name->ViewValue = $members->bnfc1_name->Summary;

			// bnfc1_rel
			$members->bnfc1_rel->ViewValue = $members->bnfc1_rel->Summary;

			// bnfc2_name
			$members->bnfc2_name->ViewValue = $members->bnfc2_name->Summary;

			// bnfc2_rel
			$members->bnfc2_rel->ViewValue = $members->bnfc2_rel->Summary;

			// bnfc3_name
			$members->bnfc3_name->ViewValue = $members->bnfc3_name->Summary;

			// bnfc3_rel
			$members->bnfc3_rel->ViewValue = $members->bnfc3_rel->Summary;

			// bnfc4_name
			$members->bnfc4_name->ViewValue = $members->bnfc4_name->Summary;

			// bnfc4_rel
			$members->bnfc4_rel->ViewValue = $members->bnfc4_rel->Summary;

			// attachment
			$members->attachment->ViewValue = $members->attachment->Summary;

			// regis_date
			$members->regis_date->ViewValue = $members->regis_date->Summary;
			$members->regis_date->ViewValue = ewrpt_FormatDateTime($members->regis_date->ViewValue, 6);

			// effective_date
			$members->effective_date->ViewValue = $members->effective_date->Summary;
			$members->effective_date->ViewValue = ewrpt_FormatDateTime($members->effective_date->ViewValue, 6);

			// resign_date
			$members->resign_date->ViewValue = $members->resign_date->Summary;
			$members->resign_date->ViewValue = ewrpt_FormatDateTime($members->resign_date->ViewValue, 6);

			// dead_date
			$members->dead_date->ViewValue = $members->dead_date->Summary;
			$members->dead_date->ViewValue = ewrpt_FormatDateTime($members->dead_date->ViewValue, 6);

			// terminate_date
			$members->terminate_date->ViewValue = $members->terminate_date->Summary;
			$members->terminate_date->ViewValue = ewrpt_FormatDateTime($members->terminate_date->ViewValue, 6);

			// member_status
			$members->member_status->ViewValue = $members->member_status->Summary;

			// advance_budget
			$members->advance_budget->ViewValue = $members->advance_budget->Summary;

			// dead_id
			$members->dead_id->ViewValue = $members->dead_id->Summary;
		} else {

			// member_id
			$members->member_id->ViewValue = $members->member_id->CurrentValue;
			$members->member_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_type
			$members->member_type->ViewValue = $members->member_type->CurrentValue;
			$members->member_type->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_code
			$members->member_code->ViewValue = $members->member_code->CurrentValue;
			$members->member_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// id_code
			$members->id_code->ViewValue = $members->id_code->CurrentValue;
			$members->id_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// gender
			$members->gender->ViewValue = $members->gender->CurrentValue;
			$members->gender->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// prefix
			$members->prefix->ViewValue = $members->prefix->CurrentValue;
			$members->prefix->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$members->fname->ViewValue = $members->fname->CurrentValue;
			$members->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$members->lname->ViewValue = $members->lname->CurrentValue;
			$members->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// birthdate
			$members->birthdate->ViewValue = $members->birthdate->CurrentValue;
			$members->birthdate->ViewValue = ewrpt_FormatDateTime($members->birthdate->ViewValue, 6);
			$members->birthdate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// age
			$members->age->ViewValue = $members->age->CurrentValue;
			$members->age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// email
			$members->zemail->ViewValue = $members->zemail->CurrentValue;
			$members->zemail->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// phone
			$members->phone->ViewValue = $members->phone->CurrentValue;
			$members->phone->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// address
			$members->address->ViewValue = $members->address->CurrentValue;
			$members->address->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_code
			$members->t_code->ViewValue = $members->t_code->CurrentValue;
			$members->t_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// village_id
			$members->village_id->ViewValue = $members->village_id->CurrentValue;
			$members->village_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// suffix
			$members->suffix->ViewValue = $members->suffix->CurrentValue;
			$members->suffix->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc1_name
			$members->bnfc1_name->ViewValue = $members->bnfc1_name->CurrentValue;
			$members->bnfc1_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc1_rel
			$members->bnfc1_rel->ViewValue = $members->bnfc1_rel->CurrentValue;
			$members->bnfc1_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_name
			$members->bnfc2_name->ViewValue = $members->bnfc2_name->CurrentValue;
			$members->bnfc2_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_rel
			$members->bnfc2_rel->ViewValue = $members->bnfc2_rel->CurrentValue;
			$members->bnfc2_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_name
			$members->bnfc3_name->ViewValue = $members->bnfc3_name->CurrentValue;
			$members->bnfc3_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_rel
			$members->bnfc3_rel->ViewValue = $members->bnfc3_rel->CurrentValue;
			$members->bnfc3_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc4_name
			$members->bnfc4_name->ViewValue = $members->bnfc4_name->CurrentValue;
			$members->bnfc4_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc4_rel
			$members->bnfc4_rel->ViewValue = $members->bnfc4_rel->CurrentValue;
			$members->bnfc4_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// attachment
			$members->attachment->ViewValue = $members->attachment->CurrentValue;
			$members->attachment->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// regis_date
			$members->regis_date->ViewValue = $members->regis_date->CurrentValue;
			$members->regis_date->ViewValue = ewrpt_FormatDateTime($members->regis_date->ViewValue, 6);
			$members->regis_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// effective_date
			$members->effective_date->ViewValue = $members->effective_date->CurrentValue;
			$members->effective_date->ViewValue = ewrpt_FormatDateTime($members->effective_date->ViewValue, 6);
			$members->effective_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// resign_date
			$members->resign_date->ViewValue = $members->resign_date->CurrentValue;
			$members->resign_date->ViewValue = ewrpt_FormatDateTime($members->resign_date->ViewValue, 6);
			$members->resign_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_date
			$members->dead_date->ViewValue = $members->dead_date->CurrentValue;
			$members->dead_date->ViewValue = ewrpt_FormatDateTime($members->dead_date->ViewValue, 6);
			$members->dead_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// terminate_date
			$members->terminate_date->ViewValue = $members->terminate_date->CurrentValue;
			$members->terminate_date->ViewValue = ewrpt_FormatDateTime($members->terminate_date->ViewValue, 6);
			$members->terminate_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_status
			$members->member_status->ViewValue = $members->member_status->CurrentValue;
			$members->member_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// advance_budget
			$members->advance_budget->ViewValue = $members->advance_budget->CurrentValue;
			$members->advance_budget->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_id
			$members->dead_id->ViewValue = $members->dead_id->CurrentValue;
			$members->dead_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// member_id
		$members->member_id->HrefValue = "";

		// member_type
		$members->member_type->HrefValue = "";

		// member_code
		$members->member_code->HrefValue = "";

		// id_code
		$members->id_code->HrefValue = "";

		// gender
		$members->gender->HrefValue = "";

		// prefix
		$members->prefix->HrefValue = "";

		// fname
		$members->fname->HrefValue = "";

		// lname
		$members->lname->HrefValue = "";

		// birthdate
		$members->birthdate->HrefValue = "";

		// age
		$members->age->HrefValue = "";

		// email
		$members->zemail->HrefValue = "";

		// phone
		$members->phone->HrefValue = "";

		// address
		$members->address->HrefValue = "";

		// t_code
		$members->t_code->HrefValue = "";

		// village_id
		$members->village_id->HrefValue = "";

		// suffix
		$members->suffix->HrefValue = "";

		// bnfc1_name
		$members->bnfc1_name->HrefValue = "";

		// bnfc1_rel
		$members->bnfc1_rel->HrefValue = "";

		// bnfc2_name
		$members->bnfc2_name->HrefValue = "";

		// bnfc2_rel
		$members->bnfc2_rel->HrefValue = "";

		// bnfc3_name
		$members->bnfc3_name->HrefValue = "";

		// bnfc3_rel
		$members->bnfc3_rel->HrefValue = "";

		// bnfc4_name
		$members->bnfc4_name->HrefValue = "";

		// bnfc4_rel
		$members->bnfc4_rel->HrefValue = "";

		// attachment
		$members->attachment->HrefValue = "";

		// regis_date
		$members->regis_date->HrefValue = "";

		// effective_date
		$members->effective_date->HrefValue = "";

		// resign_date
		$members->resign_date->HrefValue = "";

		// dead_date
		$members->dead_date->HrefValue = "";

		// terminate_date
		$members->terminate_date->HrefValue = "";

		// member_status
		$members->member_status->HrefValue = "";

		// advance_budget
		$members->advance_budget->HrefValue = "";

		// dead_id
		$members->dead_id->HrefValue = "";

		// Call Row_Rendered event
		$members->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $members;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $members;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$members->setOrderBy("");
				$members->setStartGroup(1);
				$members->member_id->setSort("");
				$members->member_type->setSort("");
				$members->member_code->setSort("");
				$members->id_code->setSort("");
				$members->gender->setSort("");
				$members->prefix->setSort("");
				$members->fname->setSort("");
				$members->lname->setSort("");
				$members->birthdate->setSort("");
				$members->age->setSort("");
				$members->zemail->setSort("");
				$members->phone->setSort("");
				$members->address->setSort("");
				$members->t_code->setSort("");
				$members->village_id->setSort("");
				$members->suffix->setSort("");
				$members->bnfc1_name->setSort("");
				$members->bnfc1_rel->setSort("");
				$members->bnfc2_name->setSort("");
				$members->bnfc2_rel->setSort("");
				$members->bnfc3_name->setSort("");
				$members->bnfc3_rel->setSort("");
				$members->bnfc4_name->setSort("");
				$members->bnfc4_rel->setSort("");
				$members->attachment->setSort("");
				$members->regis_date->setSort("");
				$members->effective_date->setSort("");
				$members->resign_date->setSort("");
				$members->dead_date->setSort("");
				$members->terminate_date->setSort("");
				$members->member_status->setSort("");
				$members->advance_budget->setSort("");
				$members->dead_id->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$members->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$members->CurrentOrderType = @$_GET["ordertype"];
			$members->UpdateSort($members->member_id); // member_id
			$members->UpdateSort($members->member_type); // member_type
			$members->UpdateSort($members->member_code); // member_code
			$members->UpdateSort($members->id_code); // id_code
			$members->UpdateSort($members->gender); // gender
			$members->UpdateSort($members->prefix); // prefix
			$members->UpdateSort($members->fname); // fname
			$members->UpdateSort($members->lname); // lname
			$members->UpdateSort($members->birthdate); // birthdate
			$members->UpdateSort($members->age); // age
			$members->UpdateSort($members->zemail); // email
			$members->UpdateSort($members->phone); // phone
			$members->UpdateSort($members->address); // address
			$members->UpdateSort($members->t_code); // t_code
			$members->UpdateSort($members->village_id); // village_id
			$members->UpdateSort($members->suffix); // suffix
			$members->UpdateSort($members->bnfc1_name); // bnfc1_name
			$members->UpdateSort($members->bnfc1_rel); // bnfc1_rel
			$members->UpdateSort($members->bnfc2_name); // bnfc2_name
			$members->UpdateSort($members->bnfc2_rel); // bnfc2_rel
			$members->UpdateSort($members->bnfc3_name); // bnfc3_name
			$members->UpdateSort($members->bnfc3_rel); // bnfc3_rel
			$members->UpdateSort($members->bnfc4_name); // bnfc4_name
			$members->UpdateSort($members->bnfc4_rel); // bnfc4_rel
			$members->UpdateSort($members->attachment); // attachment
			$members->UpdateSort($members->regis_date); // regis_date
			$members->UpdateSort($members->effective_date); // effective_date
			$members->UpdateSort($members->resign_date); // resign_date
			$members->UpdateSort($members->dead_date); // dead_date
			$members->UpdateSort($members->terminate_date); // terminate_date
			$members->UpdateSort($members->member_status); // member_status
			$members->UpdateSort($members->advance_budget); // advance_budget
			$members->UpdateSort($members->dead_id); // dead_id
			$sSortSql = $members->SortSql();
			$members->setOrderBy($sSortSql);
			$members->setStartGroup(1);
		}
		return $members->getOrderBy();
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
