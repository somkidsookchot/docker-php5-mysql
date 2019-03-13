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
$viewallmember = NULL;

//
// Table class for viewallmember
//
class crviewallmember {
	var $TableVar = 'viewallmember';
	var $TableName = 'viewallmember';
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
	var $t_title;
	var $v_code;
	var $v_title;
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
	function crviewallmember() {
		global $ReportLanguage;

		// member_id
		$this->member_id = new crField('viewallmember', 'viewallmember', 'x_member_id', 'member_id', '`member_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->member_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['member_id'] =& $this->member_id;
		$this->member_id->DateFilter = "";
		$this->member_id->SqlSelect = "";
		$this->member_id->SqlOrderBy = "";

		// member_type
		$this->member_type = new crField('viewallmember', 'viewallmember', 'x_member_type', 'member_type', '`member_type`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->member_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['member_type'] =& $this->member_type;
		$this->member_type->DateFilter = "";
		$this->member_type->SqlSelect = "";
		$this->member_type->SqlOrderBy = "";

		// member_code
		$this->member_code = new crField('viewallmember', 'viewallmember', 'x_member_code', 'member_code', '`member_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";

		// id_code
		$this->id_code = new crField('viewallmember', 'viewallmember', 'x_id_code', 'id_code', '`id_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['id_code'] =& $this->id_code;
		$this->id_code->DateFilter = "";
		$this->id_code->SqlSelect = "";
		$this->id_code->SqlOrderBy = "";

		// gender
		$this->gender = new crField('viewallmember', 'viewallmember', 'x_gender', 'gender', '`gender`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['gender'] =& $this->gender;
		$this->gender->DateFilter = "";
		$this->gender->SqlSelect = "";
		$this->gender->SqlOrderBy = "";

		// prefix
		$this->prefix = new crField('viewallmember', 'viewallmember', 'x_prefix', 'prefix', '`prefix`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['prefix'] =& $this->prefix;
		$this->prefix->DateFilter = "";
		$this->prefix->SqlSelect = "";
		$this->prefix->SqlOrderBy = "";

		// fname
		$this->fname = new crField('viewallmember', 'viewallmember', 'x_fname', 'fname', '`fname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";

		// lname
		$this->lname = new crField('viewallmember', 'viewallmember', 'x_lname', 'lname', '`lname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";

		// birthdate
		$this->birthdate = new crField('viewallmember', 'viewallmember', 'x_birthdate', 'birthdate', '`birthdate`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->birthdate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['birthdate'] =& $this->birthdate;
		$this->birthdate->DateFilter = "";
		$this->birthdate->SqlSelect = "";
		$this->birthdate->SqlOrderBy = "";

		// age
		$this->age = new crField('viewallmember', 'viewallmember', 'x_age', 'age', '`age`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;
		$this->age->DateFilter = "";
		$this->age->SqlSelect = "";
		$this->age->SqlOrderBy = "";

		// email
		$this->zemail = new crField('viewallmember', 'viewallmember', 'x_zemail', 'email', '`email`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['zemail'] =& $this->zemail;
		$this->zemail->DateFilter = "";
		$this->zemail->SqlSelect = "";
		$this->zemail->SqlOrderBy = "";

		// phone
		$this->phone = new crField('viewallmember', 'viewallmember', 'x_phone', 'phone', '`phone`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['phone'] =& $this->phone;
		$this->phone->DateFilter = "";
		$this->phone->SqlSelect = "";
		$this->phone->SqlOrderBy = "";

		// address
		$this->address = new crField('viewallmember', 'viewallmember', 'x_address', 'address', '`address`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['address'] =& $this->address;
		$this->address->DateFilter = "";
		$this->address->SqlSelect = "";
		$this->address->SqlOrderBy = "";

		// t_code
		$this->t_code = new crField('viewallmember', 'viewallmember', 'x_t_code', 't_code', '`t_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";

		// village_id
		$this->village_id = new crField('viewallmember', 'viewallmember', 'x_village_id', 'village_id', '`village_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";

		// suffix
		$this->suffix = new crField('viewallmember', 'viewallmember', 'x_suffix', 'suffix', '`suffix`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['suffix'] =& $this->suffix;
		$this->suffix->DateFilter = "";
		$this->suffix->SqlSelect = "";
		$this->suffix->SqlOrderBy = "";

		// bnfc1_name
		$this->bnfc1_name = new crField('viewallmember', 'viewallmember', 'x_bnfc1_name', 'bnfc1_name', '`bnfc1_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_name'] =& $this->bnfc1_name;
		$this->bnfc1_name->DateFilter = "";
		$this->bnfc1_name->SqlSelect = "";
		$this->bnfc1_name->SqlOrderBy = "";

		// bnfc1_rel
		$this->bnfc1_rel = new crField('viewallmember', 'viewallmember', 'x_bnfc1_rel', 'bnfc1_rel', '`bnfc1_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_rel'] =& $this->bnfc1_rel;
		$this->bnfc1_rel->DateFilter = "";
		$this->bnfc1_rel->SqlSelect = "";
		$this->bnfc1_rel->SqlOrderBy = "";

		// bnfc2_name
		$this->bnfc2_name = new crField('viewallmember', 'viewallmember', 'x_bnfc2_name', 'bnfc2_name', '`bnfc2_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_name'] =& $this->bnfc2_name;
		$this->bnfc2_name->DateFilter = "";
		$this->bnfc2_name->SqlSelect = "";
		$this->bnfc2_name->SqlOrderBy = "";

		// bnfc2_rel
		$this->bnfc2_rel = new crField('viewallmember', 'viewallmember', 'x_bnfc2_rel', 'bnfc2_rel', '`bnfc2_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_rel'] =& $this->bnfc2_rel;
		$this->bnfc2_rel->DateFilter = "";
		$this->bnfc2_rel->SqlSelect = "";
		$this->bnfc2_rel->SqlOrderBy = "";

		// bnfc3_name
		$this->bnfc3_name = new crField('viewallmember', 'viewallmember', 'x_bnfc3_name', 'bnfc3_name', '`bnfc3_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_name'] =& $this->bnfc3_name;
		$this->bnfc3_name->DateFilter = "";
		$this->bnfc3_name->SqlSelect = "";
		$this->bnfc3_name->SqlOrderBy = "";

		// bnfc3_rel
		$this->bnfc3_rel = new crField('viewallmember', 'viewallmember', 'x_bnfc3_rel', 'bnfc3_rel', '`bnfc3_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_rel'] =& $this->bnfc3_rel;
		$this->bnfc3_rel->DateFilter = "";
		$this->bnfc3_rel->SqlSelect = "";
		$this->bnfc3_rel->SqlOrderBy = "";

		// bnfc4_name
		$this->bnfc4_name = new crField('viewallmember', 'viewallmember', 'x_bnfc4_name', 'bnfc4_name', '`bnfc4_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc4_name'] =& $this->bnfc4_name;
		$this->bnfc4_name->DateFilter = "";
		$this->bnfc4_name->SqlSelect = "";
		$this->bnfc4_name->SqlOrderBy = "";

		// bnfc4_rel
		$this->bnfc4_rel = new crField('viewallmember', 'viewallmember', 'x_bnfc4_rel', 'bnfc4_rel', '`bnfc4_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc4_rel'] =& $this->bnfc4_rel;
		$this->bnfc4_rel->DateFilter = "";
		$this->bnfc4_rel->SqlSelect = "";
		$this->bnfc4_rel->SqlOrderBy = "";

		// attachment
		$this->attachment = new crField('viewallmember', 'viewallmember', 'x_attachment', 'attachment', '`attachment`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['attachment'] =& $this->attachment;
		$this->attachment->DateFilter = "";
		$this->attachment->SqlSelect = "";
		$this->attachment->SqlOrderBy = "";

		// regis_date
		$this->regis_date = new crField('viewallmember', 'viewallmember', 'x_regis_date', 'regis_date', '`regis_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->regis_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['regis_date'] =& $this->regis_date;
		$this->regis_date->DateFilter = "";
		$this->regis_date->SqlSelect = "";
		$this->regis_date->SqlOrderBy = "";

		// effective_date
		$this->effective_date = new crField('viewallmember', 'viewallmember', 'x_effective_date', 'effective_date', '`effective_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->effective_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['effective_date'] =& $this->effective_date;
		$this->effective_date->DateFilter = "";
		$this->effective_date->SqlSelect = "";
		$this->effective_date->SqlOrderBy = "";

		// resign_date
		$this->resign_date = new crField('viewallmember', 'viewallmember', 'x_resign_date', 'resign_date', '`resign_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->resign_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['resign_date'] =& $this->resign_date;
		$this->resign_date->DateFilter = "";
		$this->resign_date->SqlSelect = "";
		$this->resign_date->SqlOrderBy = "";

		// dead_date
		$this->dead_date = new crField('viewallmember', 'viewallmember', 'x_dead_date', 'dead_date', '`dead_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->dead_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['dead_date'] =& $this->dead_date;
		$this->dead_date->DateFilter = "";
		$this->dead_date->SqlSelect = "";
		$this->dead_date->SqlOrderBy = "";

		// terminate_date
		$this->terminate_date = new crField('viewallmember', 'viewallmember', 'x_terminate_date', 'terminate_date', '`terminate_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->terminate_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['terminate_date'] =& $this->terminate_date;
		$this->terminate_date->DateFilter = "";
		$this->terminate_date->SqlSelect = "";
		$this->terminate_date->SqlOrderBy = "";

		// member_status
		$this->member_status = new crField('viewallmember', 'viewallmember', 'x_member_status', 'member_status', '`member_status`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_status'] =& $this->member_status;
		$this->member_status->DateFilter = "";
		$this->member_status->SqlSelect = "";
		$this->member_status->SqlOrderBy = "";

		// advance_budget
		$this->advance_budget = new crField('viewallmember', 'viewallmember', 'x_advance_budget', 'advance_budget', '`advance_budget`', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->advance_budget->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['advance_budget'] =& $this->advance_budget;
		$this->advance_budget->DateFilter = "";
		$this->advance_budget->SqlSelect = "";
		$this->advance_budget->SqlOrderBy = "";

		// dead_id
		$this->dead_id = new crField('viewallmember', 'viewallmember', 'x_dead_id', 'dead_id', '`dead_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->dead_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['dead_id'] =& $this->dead_id;
		$this->dead_id->DateFilter = "";
		$this->dead_id->SqlSelect = "";
		$this->dead_id->SqlOrderBy = "";

		// note
		$this->note = new crField('viewallmember', 'viewallmember', 'x_note', 'note', '`note`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['note'] =& $this->note;
		$this->note->DateFilter = "";
		$this->note->SqlSelect = "";
		$this->note->SqlOrderBy = "";

		// update_detail
		$this->update_detail = new crField('viewallmember', 'viewallmember', 'x_update_detail', 'update_detail', '`update_detail`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['update_detail'] =& $this->update_detail;
		$this->update_detail->DateFilter = "";
		$this->update_detail->SqlSelect = "";
		$this->update_detail->SqlOrderBy = "";

		// t_title
		$this->t_title = new crField('viewallmember', 'viewallmember', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "";
		$this->t_title->SqlOrderBy = "";

		// v_code
		$this->v_code = new crField('viewallmember', 'viewallmember', 'x_v_code', 'v_code', 'village.v_code', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->v_code->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['v_code'] =& $this->v_code;
		$this->v_code->DateFilter = "";
		$this->v_code->SqlSelect = "";
		$this->v_code->SqlOrderBy = "";

		// v_title
		$this->v_title = new crField('viewallmember', 'viewallmember', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
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
		return "members Inner Join village On village.village_id = members.village_id Inner Join tambon On tambon.t_code = village.t_code";
	}

	function SqlSelect() { // Select
		return "SELECT members.*, tambon.t_title, village.v_code, village.v_title FROM " . $this->SqlFrom();
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
$viewallmember_rpt = new crviewallmember_rpt();
$Page =& $viewallmember_rpt;

// Page init
$viewallmember_rpt->Page_Init();

// Page main
$viewallmember_rpt->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($viewallmember->Export == "") { ?>
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
<?php $viewallmember_rpt->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $viewallmember_rpt->ShowMessage(); ?>
<?php if ($viewallmember->Export == "" || $viewallmember->Export == "print" || $viewallmember->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($viewallmember->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($viewallmember->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($viewallmember->Export == "" || $viewallmember->Export == "print" || $viewallmember->Export == "email") { ?>
<?php } ?>
<?php echo $viewallmember->TableCaption() ?>
<?php if ($viewallmember->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $viewallmember_rpt->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $viewallmember_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
<?php } ?>
<br /><br />
<?php if ($viewallmember->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($viewallmember->Export == "" || $viewallmember->Export == "print" || $viewallmember->Export == "email") { ?>
<?php } ?>
<?php if ($viewallmember->Export == "") { ?>
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
<?php if ($viewallmember->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="viewallmemberrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($viewallmember_rpt->StartGrp, $viewallmember_rpt->DisplayGrps, $viewallmember_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="viewallmemberrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="viewallmemberrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="viewallmemberrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="viewallmemberrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($viewallmember_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($viewallmember_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($viewallmember_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($viewallmember_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($viewallmember_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($viewallmember_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($viewallmember_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($viewallmember_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($viewallmember_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($viewallmember_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($viewallmember->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($viewallmember->ExportAll && $viewallmember->Export <> "") {
	$viewallmember_rpt->StopGrp = $viewallmember_rpt->TotalGrps;
} else {
	$viewallmember_rpt->StopGrp = $viewallmember_rpt->StartGrp + $viewallmember_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($viewallmember_rpt->StopGrp) > intval($viewallmember_rpt->TotalGrps))
	$viewallmember_rpt->StopGrp = $viewallmember_rpt->TotalGrps;
$viewallmember_rpt->RecCount = 0;

// Get first row
if ($viewallmember_rpt->TotalGrps > 0) {
	$viewallmember_rpt->GetRow(1);
	$viewallmember_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $viewallmember_rpt->GrpCount <= $viewallmember_rpt->DisplayGrps) || $viewallmember_rpt->ShowFirstHeader) {

	// Show header
	if ($viewallmember_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->member_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->member_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->member_id) ?>',1);"><?php echo $viewallmember->member_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->member_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->member_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->member_type) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->member_type->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->member_type) ?>',1);"><?php echo $viewallmember->member_type->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->member_type->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->member_type->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->member_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->member_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->member_code) ?>',1);"><?php echo $viewallmember->member_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->member_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->member_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->id_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->id_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->id_code) ?>',1);"><?php echo $viewallmember->id_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->id_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->id_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->gender) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->gender->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->gender) ?>',1);"><?php echo $viewallmember->gender->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->gender->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->gender->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->prefix) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->prefix->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->prefix) ?>',1);"><?php echo $viewallmember->prefix->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->prefix->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->prefix->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->fname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->fname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->fname) ?>',1);"><?php echo $viewallmember->fname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->fname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->fname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->lname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->lname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->lname) ?>',1);"><?php echo $viewallmember->lname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->lname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->lname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->birthdate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->birthdate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->birthdate) ?>',1);"><?php echo $viewallmember->birthdate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->birthdate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->birthdate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->age) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->age) ?>',1);"><?php echo $viewallmember->age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->zemail) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->zemail->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->zemail) ?>',1);"><?php echo $viewallmember->zemail->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->zemail->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->zemail->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->phone) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->phone->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->phone) ?>',1);"><?php echo $viewallmember->phone->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->phone->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->phone->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->address) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->address->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->address) ?>',1);"><?php echo $viewallmember->address->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->address->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->address->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->t_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->t_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->t_code) ?>',1);"><?php echo $viewallmember->t_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->t_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->t_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->village_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->village_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->village_id) ?>',1);"><?php echo $viewallmember->village_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->village_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->village_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->suffix) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->suffix->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->suffix) ?>',1);"><?php echo $viewallmember->suffix->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->suffix->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->suffix->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->bnfc1_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->bnfc1_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->bnfc1_name) ?>',1);"><?php echo $viewallmember->bnfc1_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->bnfc1_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->bnfc1_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->bnfc1_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->bnfc1_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->bnfc1_rel) ?>',1);"><?php echo $viewallmember->bnfc1_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->bnfc1_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->bnfc1_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->bnfc2_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->bnfc2_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->bnfc2_name) ?>',1);"><?php echo $viewallmember->bnfc2_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->bnfc2_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->bnfc2_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->bnfc2_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->bnfc2_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->bnfc2_rel) ?>',1);"><?php echo $viewallmember->bnfc2_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->bnfc2_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->bnfc2_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->bnfc3_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->bnfc3_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->bnfc3_name) ?>',1);"><?php echo $viewallmember->bnfc3_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->bnfc3_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->bnfc3_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->bnfc3_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->bnfc3_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->bnfc3_rel) ?>',1);"><?php echo $viewallmember->bnfc3_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->bnfc3_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->bnfc3_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->bnfc4_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->bnfc4_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->bnfc4_name) ?>',1);"><?php echo $viewallmember->bnfc4_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->bnfc4_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->bnfc4_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->bnfc4_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->bnfc4_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->bnfc4_rel) ?>',1);"><?php echo $viewallmember->bnfc4_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->bnfc4_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->bnfc4_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->attachment) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->attachment->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->attachment) ?>',1);"><?php echo $viewallmember->attachment->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->attachment->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->attachment->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->regis_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->regis_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->regis_date) ?>',1);"><?php echo $viewallmember->regis_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->regis_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->regis_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->effective_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->effective_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->effective_date) ?>',1);"><?php echo $viewallmember->effective_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->effective_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->effective_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->resign_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->resign_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->resign_date) ?>',1);"><?php echo $viewallmember->resign_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->resign_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->resign_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->dead_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->dead_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->dead_date) ?>',1);"><?php echo $viewallmember->dead_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->dead_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->dead_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->terminate_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->terminate_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->terminate_date) ?>',1);"><?php echo $viewallmember->terminate_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->terminate_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->terminate_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->member_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->member_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->member_status) ?>',1);"><?php echo $viewallmember->member_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->member_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->member_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->advance_budget) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->advance_budget->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->advance_budget) ?>',1);"><?php echo $viewallmember->advance_budget->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->advance_budget->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->advance_budget->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->dead_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->dead_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->dead_id) ?>',1);"><?php echo $viewallmember->dead_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->dead_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->dead_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->t_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->t_title) ?>',1);"><?php echo $viewallmember->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->v_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->v_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->v_code) ?>',1);"><?php echo $viewallmember->v_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->v_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->v_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($viewallmember->SortUrl($viewallmember->v_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $viewallmember->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $viewallmember->SortUrl($viewallmember->v_title) ?>',1);"><?php echo $viewallmember->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($viewallmember->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($viewallmember->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$viewallmember_rpt->ShowFirstHeader = FALSE;
	}
	$viewallmember_rpt->RecCount++;

		// Render detail row
		$viewallmember->ResetCSS();
		$viewallmember->RowType = EWRPT_ROWTYPE_DETAIL;
		$viewallmember_rpt->RenderRow();
?>
	<tr<?php echo $viewallmember->RowAttributes(); ?>>
		<td<?php echo $viewallmember->member_id->CellAttributes() ?>>
<div<?php echo $viewallmember->member_id->ViewAttributes(); ?>><?php echo $viewallmember->member_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->member_type->CellAttributes() ?>>
<div<?php echo $viewallmember->member_type->ViewAttributes(); ?>><?php echo $viewallmember->member_type->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->member_code->CellAttributes() ?>>
<div<?php echo $viewallmember->member_code->ViewAttributes(); ?>><?php echo $viewallmember->member_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->id_code->CellAttributes() ?>>
<div<?php echo $viewallmember->id_code->ViewAttributes(); ?>><?php echo $viewallmember->id_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->gender->CellAttributes() ?>>
<div<?php echo $viewallmember->gender->ViewAttributes(); ?>><?php echo $viewallmember->gender->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->prefix->CellAttributes() ?>>
<div<?php echo $viewallmember->prefix->ViewAttributes(); ?>><?php echo $viewallmember->prefix->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->fname->CellAttributes() ?>>
<div<?php echo $viewallmember->fname->ViewAttributes(); ?>><?php echo $viewallmember->fname->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->lname->CellAttributes() ?>>
<div<?php echo $viewallmember->lname->ViewAttributes(); ?>><?php echo $viewallmember->lname->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->birthdate->CellAttributes() ?>>
<div<?php echo $viewallmember->birthdate->ViewAttributes(); ?>><?php echo $viewallmember->birthdate->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->age->CellAttributes() ?>>
<div<?php echo $viewallmember->age->ViewAttributes(); ?>><?php echo $viewallmember->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->zemail->CellAttributes() ?>>
<div<?php echo $viewallmember->zemail->ViewAttributes(); ?>><?php echo $viewallmember->zemail->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->phone->CellAttributes() ?>>
<div<?php echo $viewallmember->phone->ViewAttributes(); ?>><?php echo $viewallmember->phone->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->address->CellAttributes() ?>>
<div<?php echo $viewallmember->address->ViewAttributes(); ?>><?php echo $viewallmember->address->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->t_code->CellAttributes() ?>>
<div<?php echo $viewallmember->t_code->ViewAttributes(); ?>><?php echo $viewallmember->t_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->village_id->CellAttributes() ?>>
<div<?php echo $viewallmember->village_id->ViewAttributes(); ?>><?php echo $viewallmember->village_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->suffix->CellAttributes() ?>>
<div<?php echo $viewallmember->suffix->ViewAttributes(); ?>><?php echo $viewallmember->suffix->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->bnfc1_name->CellAttributes() ?>>
<div<?php echo $viewallmember->bnfc1_name->ViewAttributes(); ?>><?php echo $viewallmember->bnfc1_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->bnfc1_rel->CellAttributes() ?>>
<div<?php echo $viewallmember->bnfc1_rel->ViewAttributes(); ?>><?php echo $viewallmember->bnfc1_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->bnfc2_name->CellAttributes() ?>>
<div<?php echo $viewallmember->bnfc2_name->ViewAttributes(); ?>><?php echo $viewallmember->bnfc2_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->bnfc2_rel->CellAttributes() ?>>
<div<?php echo $viewallmember->bnfc2_rel->ViewAttributes(); ?>><?php echo $viewallmember->bnfc2_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->bnfc3_name->CellAttributes() ?>>
<div<?php echo $viewallmember->bnfc3_name->ViewAttributes(); ?>><?php echo $viewallmember->bnfc3_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->bnfc3_rel->CellAttributes() ?>>
<div<?php echo $viewallmember->bnfc3_rel->ViewAttributes(); ?>><?php echo $viewallmember->bnfc3_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->bnfc4_name->CellAttributes() ?>>
<div<?php echo $viewallmember->bnfc4_name->ViewAttributes(); ?>><?php echo $viewallmember->bnfc4_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->bnfc4_rel->CellAttributes() ?>>
<div<?php echo $viewallmember->bnfc4_rel->ViewAttributes(); ?>><?php echo $viewallmember->bnfc4_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->attachment->CellAttributes() ?>>
<div<?php echo $viewallmember->attachment->ViewAttributes(); ?>><?php echo $viewallmember->attachment->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->regis_date->CellAttributes() ?>>
<div<?php echo $viewallmember->regis_date->ViewAttributes(); ?>><?php echo $viewallmember->regis_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->effective_date->CellAttributes() ?>>
<div<?php echo $viewallmember->effective_date->ViewAttributes(); ?>><?php echo $viewallmember->effective_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->resign_date->CellAttributes() ?>>
<div<?php echo $viewallmember->resign_date->ViewAttributes(); ?>><?php echo $viewallmember->resign_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->dead_date->CellAttributes() ?>>
<div<?php echo $viewallmember->dead_date->ViewAttributes(); ?>><?php echo $viewallmember->dead_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->terminate_date->CellAttributes() ?>>
<div<?php echo $viewallmember->terminate_date->ViewAttributes(); ?>><?php echo $viewallmember->terminate_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->member_status->CellAttributes() ?>>
<div<?php echo $viewallmember->member_status->ViewAttributes(); ?>><?php echo $viewallmember->member_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->advance_budget->CellAttributes() ?>>
<div<?php echo $viewallmember->advance_budget->ViewAttributes(); ?>><?php echo $viewallmember->advance_budget->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->dead_id->CellAttributes() ?>>
<div<?php echo $viewallmember->dead_id->ViewAttributes(); ?>><?php echo $viewallmember->dead_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->t_title->CellAttributes() ?>>
<div<?php echo $viewallmember->t_title->ViewAttributes(); ?>><?php echo $viewallmember->t_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->v_code->CellAttributes() ?>>
<div<?php echo $viewallmember->v_code->ViewAttributes(); ?>><?php echo $viewallmember->v_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $viewallmember->v_title->CellAttributes() ?>>
<div<?php echo $viewallmember->v_title->ViewAttributes(); ?>><?php echo $viewallmember->v_title->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$viewallmember_rpt->AccumulateSummary();

		// Get next record
		$viewallmember_rpt->GetRow(2);
	$viewallmember_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($viewallmember_rpt->TotalGrps > 0) { ?>
<?php if ($viewallmember->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="viewallmemberrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($viewallmember_rpt->StartGrp, $viewallmember_rpt->DisplayGrps, $viewallmember_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="viewallmemberrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="viewallmemberrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="viewallmemberrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="viewallmemberrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($viewallmember_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($viewallmember_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($viewallmember_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($viewallmember_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($viewallmember_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($viewallmember_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($viewallmember_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($viewallmember_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($viewallmember_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($viewallmember_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($viewallmember->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($viewallmember->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($viewallmember->Export == "" || $viewallmember->Export == "print" || $viewallmember->Export == "email") { ?>
<?php } ?>
<?php if ($viewallmember->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($viewallmember->Export == "" || $viewallmember->Export == "print" || $viewallmember->Export == "email") { ?>
<?php } ?>
<?php if ($viewallmember->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $viewallmember_rpt->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($viewallmember->Export == "") { ?>
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
$viewallmember_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crviewallmember_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'viewallmember';

	// Page object name
	var $PageObjName = 'viewallmember_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $viewallmember;
		if ($viewallmember->UseTokenInUrl) $PageUrl .= "t=" . $viewallmember->TableVar . "&"; // Add page token
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
		global $viewallmember;
		if ($viewallmember->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($viewallmember->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($viewallmember->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crviewallmember_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (viewallmember)
		$GLOBALS["viewallmember"] = new crviewallmember();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'viewallmember', TRUE);

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
		global $viewallmember;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$viewallmember->Export = $_GET["export"];
	}
	$gsExport = $viewallmember->Export; // Get export parameter, used in header
	$gsExportFile = $viewallmember->TableVar; // Get export file, used in header
	if ($viewallmember->Export == "excel") {
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
		global $viewallmember;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($viewallmember->Export == "email") {
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
		global $viewallmember;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 37;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

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
		$sSql = ewrpt_BuildReportSql($viewallmember->SqlSelect(), $viewallmember->SqlWhere(), $viewallmember->SqlGroupBy(), $viewallmember->SqlHaving(), $viewallmember->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($viewallmember->ExportAll && $viewallmember->Export <> "")
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
		global $viewallmember;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$viewallmember->member_id->setDbValue($rs->fields('member_id'));
			$viewallmember->member_type->setDbValue($rs->fields('member_type'));
			$viewallmember->member_code->setDbValue($rs->fields('member_code'));
			$viewallmember->id_code->setDbValue($rs->fields('id_code'));
			$viewallmember->gender->setDbValue($rs->fields('gender'));
			$viewallmember->prefix->setDbValue($rs->fields('prefix'));
			$viewallmember->fname->setDbValue($rs->fields('fname'));
			$viewallmember->lname->setDbValue($rs->fields('lname'));
			$viewallmember->birthdate->setDbValue($rs->fields('birthdate'));
			$viewallmember->age->setDbValue($rs->fields('age'));
			$viewallmember->zemail->setDbValue($rs->fields('email'));
			$viewallmember->phone->setDbValue($rs->fields('phone'));
			$viewallmember->address->setDbValue($rs->fields('address'));
			$viewallmember->t_code->setDbValue($rs->fields('t_code'));
			$viewallmember->village_id->setDbValue($rs->fields('village_id'));
			$viewallmember->suffix->setDbValue($rs->fields('suffix'));
			$viewallmember->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
			$viewallmember->bnfc1_rel->setDbValue($rs->fields('bnfc1_rel'));
			$viewallmember->bnfc2_name->setDbValue($rs->fields('bnfc2_name'));
			$viewallmember->bnfc2_rel->setDbValue($rs->fields('bnfc2_rel'));
			$viewallmember->bnfc3_name->setDbValue($rs->fields('bnfc3_name'));
			$viewallmember->bnfc3_rel->setDbValue($rs->fields('bnfc3_rel'));
			$viewallmember->bnfc4_name->setDbValue($rs->fields('bnfc4_name'));
			$viewallmember->bnfc4_rel->setDbValue($rs->fields('bnfc4_rel'));
			$viewallmember->attachment->setDbValue($rs->fields('attachment'));
			$viewallmember->regis_date->setDbValue($rs->fields('regis_date'));
			$viewallmember->effective_date->setDbValue($rs->fields('effective_date'));
			$viewallmember->resign_date->setDbValue($rs->fields('resign_date'));
			$viewallmember->dead_date->setDbValue($rs->fields('dead_date'));
			$viewallmember->terminate_date->setDbValue($rs->fields('terminate_date'));
			$viewallmember->member_status->setDbValue($rs->fields('member_status'));
			$viewallmember->advance_budget->setDbValue($rs->fields('advance_budget'));
			$viewallmember->dead_id->setDbValue($rs->fields('dead_id'));
			$viewallmember->note->setDbValue($rs->fields('note'));
			$viewallmember->update_detail->setDbValue($rs->fields('update_detail'));
			$viewallmember->t_title->setDbValue($rs->fields('t_title'));
			$viewallmember->v_code->setDbValue($rs->fields('v_code'));
			$viewallmember->v_title->setDbValue($rs->fields('v_title'));
			$this->Val[1] = $viewallmember->member_id->CurrentValue;
			$this->Val[2] = $viewallmember->member_type->CurrentValue;
			$this->Val[3] = $viewallmember->member_code->CurrentValue;
			$this->Val[4] = $viewallmember->id_code->CurrentValue;
			$this->Val[5] = $viewallmember->gender->CurrentValue;
			$this->Val[6] = $viewallmember->prefix->CurrentValue;
			$this->Val[7] = $viewallmember->fname->CurrentValue;
			$this->Val[8] = $viewallmember->lname->CurrentValue;
			$this->Val[9] = $viewallmember->birthdate->CurrentValue;
			$this->Val[10] = $viewallmember->age->CurrentValue;
			$this->Val[11] = $viewallmember->zemail->CurrentValue;
			$this->Val[12] = $viewallmember->phone->CurrentValue;
			$this->Val[13] = $viewallmember->address->CurrentValue;
			$this->Val[14] = $viewallmember->t_code->CurrentValue;
			$this->Val[15] = $viewallmember->village_id->CurrentValue;
			$this->Val[16] = $viewallmember->suffix->CurrentValue;
			$this->Val[17] = $viewallmember->bnfc1_name->CurrentValue;
			$this->Val[18] = $viewallmember->bnfc1_rel->CurrentValue;
			$this->Val[19] = $viewallmember->bnfc2_name->CurrentValue;
			$this->Val[20] = $viewallmember->bnfc2_rel->CurrentValue;
			$this->Val[21] = $viewallmember->bnfc3_name->CurrentValue;
			$this->Val[22] = $viewallmember->bnfc3_rel->CurrentValue;
			$this->Val[23] = $viewallmember->bnfc4_name->CurrentValue;
			$this->Val[24] = $viewallmember->bnfc4_rel->CurrentValue;
			$this->Val[25] = $viewallmember->attachment->CurrentValue;
			$this->Val[26] = $viewallmember->regis_date->CurrentValue;
			$this->Val[27] = $viewallmember->effective_date->CurrentValue;
			$this->Val[28] = $viewallmember->resign_date->CurrentValue;
			$this->Val[29] = $viewallmember->dead_date->CurrentValue;
			$this->Val[30] = $viewallmember->terminate_date->CurrentValue;
			$this->Val[31] = $viewallmember->member_status->CurrentValue;
			$this->Val[32] = $viewallmember->advance_budget->CurrentValue;
			$this->Val[33] = $viewallmember->dead_id->CurrentValue;
			$this->Val[34] = $viewallmember->t_title->CurrentValue;
			$this->Val[35] = $viewallmember->v_code->CurrentValue;
			$this->Val[36] = $viewallmember->v_title->CurrentValue;
		} else {
			$viewallmember->member_id->setDbValue("");
			$viewallmember->member_type->setDbValue("");
			$viewallmember->member_code->setDbValue("");
			$viewallmember->id_code->setDbValue("");
			$viewallmember->gender->setDbValue("");
			$viewallmember->prefix->setDbValue("");
			$viewallmember->fname->setDbValue("");
			$viewallmember->lname->setDbValue("");
			$viewallmember->birthdate->setDbValue("");
			$viewallmember->age->setDbValue("");
			$viewallmember->zemail->setDbValue("");
			$viewallmember->phone->setDbValue("");
			$viewallmember->address->setDbValue("");
			$viewallmember->t_code->setDbValue("");
			$viewallmember->village_id->setDbValue("");
			$viewallmember->suffix->setDbValue("");
			$viewallmember->bnfc1_name->setDbValue("");
			$viewallmember->bnfc1_rel->setDbValue("");
			$viewallmember->bnfc2_name->setDbValue("");
			$viewallmember->bnfc2_rel->setDbValue("");
			$viewallmember->bnfc3_name->setDbValue("");
			$viewallmember->bnfc3_rel->setDbValue("");
			$viewallmember->bnfc4_name->setDbValue("");
			$viewallmember->bnfc4_rel->setDbValue("");
			$viewallmember->attachment->setDbValue("");
			$viewallmember->regis_date->setDbValue("");
			$viewallmember->effective_date->setDbValue("");
			$viewallmember->resign_date->setDbValue("");
			$viewallmember->dead_date->setDbValue("");
			$viewallmember->terminate_date->setDbValue("");
			$viewallmember->member_status->setDbValue("");
			$viewallmember->advance_budget->setDbValue("");
			$viewallmember->dead_id->setDbValue("");
			$viewallmember->note->setDbValue("");
			$viewallmember->update_detail->setDbValue("");
			$viewallmember->t_title->setDbValue("");
			$viewallmember->v_code->setDbValue("");
			$viewallmember->v_title->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $viewallmember;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$viewallmember->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$viewallmember->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $viewallmember->getStartGroup();
			}
		} else {
			$this->StartGrp = $viewallmember->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$viewallmember->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$viewallmember->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$viewallmember->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $viewallmember;

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
		global $viewallmember;
		$this->StartGrp = 1;
		$viewallmember->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $viewallmember;
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
			$viewallmember->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$viewallmember->setStartGroup($this->StartGrp);
		} else {
			if ($viewallmember->getGroupPerPage() <> "") {
				$this->DisplayGrps = $viewallmember->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $viewallmember;
		if ($viewallmember->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($viewallmember->SqlSelectCount(), $viewallmember->SqlWhere(), $viewallmember->SqlGroupBy(), $viewallmember->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$viewallmember->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($viewallmember->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// member_id
			$viewallmember->member_id->ViewValue = $viewallmember->member_id->Summary;

			// member_type
			$viewallmember->member_type->ViewValue = $viewallmember->member_type->Summary;

			// member_code
			$viewallmember->member_code->ViewValue = $viewallmember->member_code->Summary;

			// id_code
			$viewallmember->id_code->ViewValue = $viewallmember->id_code->Summary;

			// gender
			$viewallmember->gender->ViewValue = $viewallmember->gender->Summary;

			// prefix
			$viewallmember->prefix->ViewValue = $viewallmember->prefix->Summary;

			// fname
			$viewallmember->fname->ViewValue = $viewallmember->fname->Summary;

			// lname
			$viewallmember->lname->ViewValue = $viewallmember->lname->Summary;

			// birthdate
			$viewallmember->birthdate->ViewValue = $viewallmember->birthdate->Summary;
			$viewallmember->birthdate->ViewValue = ewrpt_FormatDateTime($viewallmember->birthdate->ViewValue, 6);

			// age
			$viewallmember->age->ViewValue = $viewallmember->age->Summary;

			// email
			$viewallmember->zemail->ViewValue = $viewallmember->zemail->Summary;

			// phone
			$viewallmember->phone->ViewValue = $viewallmember->phone->Summary;

			// address
			$viewallmember->address->ViewValue = $viewallmember->address->Summary;

			// t_code
			$viewallmember->t_code->ViewValue = $viewallmember->t_code->Summary;

			// village_id
			$viewallmember->village_id->ViewValue = $viewallmember->village_id->Summary;

			// suffix
			$viewallmember->suffix->ViewValue = $viewallmember->suffix->Summary;

			// bnfc1_name
			$viewallmember->bnfc1_name->ViewValue = $viewallmember->bnfc1_name->Summary;

			// bnfc1_rel
			$viewallmember->bnfc1_rel->ViewValue = $viewallmember->bnfc1_rel->Summary;

			// bnfc2_name
			$viewallmember->bnfc2_name->ViewValue = $viewallmember->bnfc2_name->Summary;

			// bnfc2_rel
			$viewallmember->bnfc2_rel->ViewValue = $viewallmember->bnfc2_rel->Summary;

			// bnfc3_name
			$viewallmember->bnfc3_name->ViewValue = $viewallmember->bnfc3_name->Summary;

			// bnfc3_rel
			$viewallmember->bnfc3_rel->ViewValue = $viewallmember->bnfc3_rel->Summary;

			// bnfc4_name
			$viewallmember->bnfc4_name->ViewValue = $viewallmember->bnfc4_name->Summary;

			// bnfc4_rel
			$viewallmember->bnfc4_rel->ViewValue = $viewallmember->bnfc4_rel->Summary;

			// attachment
			$viewallmember->attachment->ViewValue = $viewallmember->attachment->Summary;

			// regis_date
			$viewallmember->regis_date->ViewValue = $viewallmember->regis_date->Summary;
			$viewallmember->regis_date->ViewValue = ewrpt_FormatDateTime($viewallmember->regis_date->ViewValue, 6);

			// effective_date
			$viewallmember->effective_date->ViewValue = $viewallmember->effective_date->Summary;
			$viewallmember->effective_date->ViewValue = ewrpt_FormatDateTime($viewallmember->effective_date->ViewValue, 6);

			// resign_date
			$viewallmember->resign_date->ViewValue = $viewallmember->resign_date->Summary;
			$viewallmember->resign_date->ViewValue = ewrpt_FormatDateTime($viewallmember->resign_date->ViewValue, 6);

			// dead_date
			$viewallmember->dead_date->ViewValue = $viewallmember->dead_date->Summary;
			$viewallmember->dead_date->ViewValue = ewrpt_FormatDateTime($viewallmember->dead_date->ViewValue, 6);

			// terminate_date
			$viewallmember->terminate_date->ViewValue = $viewallmember->terminate_date->Summary;
			$viewallmember->terminate_date->ViewValue = ewrpt_FormatDateTime($viewallmember->terminate_date->ViewValue, 6);

			// member_status
			$viewallmember->member_status->ViewValue = $viewallmember->member_status->Summary;

			// advance_budget
			$viewallmember->advance_budget->ViewValue = $viewallmember->advance_budget->Summary;

			// dead_id
			$viewallmember->dead_id->ViewValue = $viewallmember->dead_id->Summary;

			// t_title
			$viewallmember->t_title->ViewValue = $viewallmember->t_title->Summary;

			// v_code
			$viewallmember->v_code->ViewValue = $viewallmember->v_code->Summary;

			// v_title
			$viewallmember->v_title->ViewValue = $viewallmember->v_title->Summary;
		} else {

			// member_id
			$viewallmember->member_id->ViewValue = $viewallmember->member_id->CurrentValue;
			$viewallmember->member_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_type
			$viewallmember->member_type->ViewValue = $viewallmember->member_type->CurrentValue;
			$viewallmember->member_type->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_code
			$viewallmember->member_code->ViewValue = $viewallmember->member_code->CurrentValue;
			$viewallmember->member_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// id_code
			$viewallmember->id_code->ViewValue = $viewallmember->id_code->CurrentValue;
			$viewallmember->id_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// gender
			$viewallmember->gender->ViewValue = $viewallmember->gender->CurrentValue;
			$viewallmember->gender->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// prefix
			$viewallmember->prefix->ViewValue = $viewallmember->prefix->CurrentValue;
			$viewallmember->prefix->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$viewallmember->fname->ViewValue = $viewallmember->fname->CurrentValue;
			$viewallmember->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$viewallmember->lname->ViewValue = $viewallmember->lname->CurrentValue;
			$viewallmember->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// birthdate
			$viewallmember->birthdate->ViewValue = $viewallmember->birthdate->CurrentValue;
			$viewallmember->birthdate->ViewValue = ewrpt_FormatDateTime($viewallmember->birthdate->ViewValue, 6);
			$viewallmember->birthdate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// age
			$viewallmember->age->ViewValue = $viewallmember->age->CurrentValue;
			$viewallmember->age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// email
			$viewallmember->zemail->ViewValue = $viewallmember->zemail->CurrentValue;
			$viewallmember->zemail->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// phone
			$viewallmember->phone->ViewValue = $viewallmember->phone->CurrentValue;
			$viewallmember->phone->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// address
			$viewallmember->address->ViewValue = $viewallmember->address->CurrentValue;
			$viewallmember->address->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_code
			$viewallmember->t_code->ViewValue = $viewallmember->t_code->CurrentValue;
			$viewallmember->t_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// village_id
			$viewallmember->village_id->ViewValue = $viewallmember->village_id->CurrentValue;
			$viewallmember->village_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// suffix
			$viewallmember->suffix->ViewValue = $viewallmember->suffix->CurrentValue;
			$viewallmember->suffix->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc1_name
			$viewallmember->bnfc1_name->ViewValue = $viewallmember->bnfc1_name->CurrentValue;
			$viewallmember->bnfc1_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc1_rel
			$viewallmember->bnfc1_rel->ViewValue = $viewallmember->bnfc1_rel->CurrentValue;
			$viewallmember->bnfc1_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_name
			$viewallmember->bnfc2_name->ViewValue = $viewallmember->bnfc2_name->CurrentValue;
			$viewallmember->bnfc2_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_rel
			$viewallmember->bnfc2_rel->ViewValue = $viewallmember->bnfc2_rel->CurrentValue;
			$viewallmember->bnfc2_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_name
			$viewallmember->bnfc3_name->ViewValue = $viewallmember->bnfc3_name->CurrentValue;
			$viewallmember->bnfc3_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_rel
			$viewallmember->bnfc3_rel->ViewValue = $viewallmember->bnfc3_rel->CurrentValue;
			$viewallmember->bnfc3_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc4_name
			$viewallmember->bnfc4_name->ViewValue = $viewallmember->bnfc4_name->CurrentValue;
			$viewallmember->bnfc4_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc4_rel
			$viewallmember->bnfc4_rel->ViewValue = $viewallmember->bnfc4_rel->CurrentValue;
			$viewallmember->bnfc4_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// attachment
			$viewallmember->attachment->ViewValue = $viewallmember->attachment->CurrentValue;
			$viewallmember->attachment->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// regis_date
			$viewallmember->regis_date->ViewValue = $viewallmember->regis_date->CurrentValue;
			$viewallmember->regis_date->ViewValue = ewrpt_FormatDateTime($viewallmember->regis_date->ViewValue, 6);
			$viewallmember->regis_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// effective_date
			$viewallmember->effective_date->ViewValue = $viewallmember->effective_date->CurrentValue;
			$viewallmember->effective_date->ViewValue = ewrpt_FormatDateTime($viewallmember->effective_date->ViewValue, 6);
			$viewallmember->effective_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// resign_date
			$viewallmember->resign_date->ViewValue = $viewallmember->resign_date->CurrentValue;
			$viewallmember->resign_date->ViewValue = ewrpt_FormatDateTime($viewallmember->resign_date->ViewValue, 6);
			$viewallmember->resign_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_date
			$viewallmember->dead_date->ViewValue = $viewallmember->dead_date->CurrentValue;
			$viewallmember->dead_date->ViewValue = ewrpt_FormatDateTime($viewallmember->dead_date->ViewValue, 6);
			$viewallmember->dead_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// terminate_date
			$viewallmember->terminate_date->ViewValue = $viewallmember->terminate_date->CurrentValue;
			$viewallmember->terminate_date->ViewValue = ewrpt_FormatDateTime($viewallmember->terminate_date->ViewValue, 6);
			$viewallmember->terminate_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_status
			$viewallmember->member_status->ViewValue = $viewallmember->member_status->CurrentValue;
			$viewallmember->member_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// advance_budget
			$viewallmember->advance_budget->ViewValue = $viewallmember->advance_budget->CurrentValue;
			$viewallmember->advance_budget->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_id
			$viewallmember->dead_id->ViewValue = $viewallmember->dead_id->CurrentValue;
			$viewallmember->dead_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_title
			$viewallmember->t_title->ViewValue = $viewallmember->t_title->CurrentValue;
			$viewallmember->t_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_code
			$viewallmember->v_code->ViewValue = $viewallmember->v_code->CurrentValue;
			$viewallmember->v_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_title
			$viewallmember->v_title->ViewValue = $viewallmember->v_title->CurrentValue;
			$viewallmember->v_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// member_id
		$viewallmember->member_id->HrefValue = "";

		// member_type
		$viewallmember->member_type->HrefValue = "";

		// member_code
		$viewallmember->member_code->HrefValue = "";

		// id_code
		$viewallmember->id_code->HrefValue = "";

		// gender
		$viewallmember->gender->HrefValue = "";

		// prefix
		$viewallmember->prefix->HrefValue = "";

		// fname
		$viewallmember->fname->HrefValue = "";

		// lname
		$viewallmember->lname->HrefValue = "";

		// birthdate
		$viewallmember->birthdate->HrefValue = "";

		// age
		$viewallmember->age->HrefValue = "";

		// email
		$viewallmember->zemail->HrefValue = "";

		// phone
		$viewallmember->phone->HrefValue = "";

		// address
		$viewallmember->address->HrefValue = "";

		// t_code
		$viewallmember->t_code->HrefValue = "";

		// village_id
		$viewallmember->village_id->HrefValue = "";

		// suffix
		$viewallmember->suffix->HrefValue = "";

		// bnfc1_name
		$viewallmember->bnfc1_name->HrefValue = "";

		// bnfc1_rel
		$viewallmember->bnfc1_rel->HrefValue = "";

		// bnfc2_name
		$viewallmember->bnfc2_name->HrefValue = "";

		// bnfc2_rel
		$viewallmember->bnfc2_rel->HrefValue = "";

		// bnfc3_name
		$viewallmember->bnfc3_name->HrefValue = "";

		// bnfc3_rel
		$viewallmember->bnfc3_rel->HrefValue = "";

		// bnfc4_name
		$viewallmember->bnfc4_name->HrefValue = "";

		// bnfc4_rel
		$viewallmember->bnfc4_rel->HrefValue = "";

		// attachment
		$viewallmember->attachment->HrefValue = "";

		// regis_date
		$viewallmember->regis_date->HrefValue = "";

		// effective_date
		$viewallmember->effective_date->HrefValue = "";

		// resign_date
		$viewallmember->resign_date->HrefValue = "";

		// dead_date
		$viewallmember->dead_date->HrefValue = "";

		// terminate_date
		$viewallmember->terminate_date->HrefValue = "";

		// member_status
		$viewallmember->member_status->HrefValue = "";

		// advance_budget
		$viewallmember->advance_budget->HrefValue = "";

		// dead_id
		$viewallmember->dead_id->HrefValue = "";

		// t_title
		$viewallmember->t_title->HrefValue = "";

		// v_code
		$viewallmember->v_code->HrefValue = "";

		// v_title
		$viewallmember->v_title->HrefValue = "";

		// Call Row_Rendered event
		$viewallmember->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $viewallmember;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $viewallmember;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$viewallmember->setOrderBy("");
				$viewallmember->setStartGroup(1);
				$viewallmember->member_id->setSort("");
				$viewallmember->member_type->setSort("");
				$viewallmember->member_code->setSort("");
				$viewallmember->id_code->setSort("");
				$viewallmember->gender->setSort("");
				$viewallmember->prefix->setSort("");
				$viewallmember->fname->setSort("");
				$viewallmember->lname->setSort("");
				$viewallmember->birthdate->setSort("");
				$viewallmember->age->setSort("");
				$viewallmember->zemail->setSort("");
				$viewallmember->phone->setSort("");
				$viewallmember->address->setSort("");
				$viewallmember->t_code->setSort("");
				$viewallmember->village_id->setSort("");
				$viewallmember->suffix->setSort("");
				$viewallmember->bnfc1_name->setSort("");
				$viewallmember->bnfc1_rel->setSort("");
				$viewallmember->bnfc2_name->setSort("");
				$viewallmember->bnfc2_rel->setSort("");
				$viewallmember->bnfc3_name->setSort("");
				$viewallmember->bnfc3_rel->setSort("");
				$viewallmember->bnfc4_name->setSort("");
				$viewallmember->bnfc4_rel->setSort("");
				$viewallmember->attachment->setSort("");
				$viewallmember->regis_date->setSort("");
				$viewallmember->effective_date->setSort("");
				$viewallmember->resign_date->setSort("");
				$viewallmember->dead_date->setSort("");
				$viewallmember->terminate_date->setSort("");
				$viewallmember->member_status->setSort("");
				$viewallmember->advance_budget->setSort("");
				$viewallmember->dead_id->setSort("");
				$viewallmember->t_title->setSort("");
				$viewallmember->v_code->setSort("");
				$viewallmember->v_title->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$viewallmember->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$viewallmember->CurrentOrderType = @$_GET["ordertype"];
			$viewallmember->UpdateSort($viewallmember->member_id); // member_id
			$viewallmember->UpdateSort($viewallmember->member_type); // member_type
			$viewallmember->UpdateSort($viewallmember->member_code); // member_code
			$viewallmember->UpdateSort($viewallmember->id_code); // id_code
			$viewallmember->UpdateSort($viewallmember->gender); // gender
			$viewallmember->UpdateSort($viewallmember->prefix); // prefix
			$viewallmember->UpdateSort($viewallmember->fname); // fname
			$viewallmember->UpdateSort($viewallmember->lname); // lname
			$viewallmember->UpdateSort($viewallmember->birthdate); // birthdate
			$viewallmember->UpdateSort($viewallmember->age); // age
			$viewallmember->UpdateSort($viewallmember->zemail); // email
			$viewallmember->UpdateSort($viewallmember->phone); // phone
			$viewallmember->UpdateSort($viewallmember->address); // address
			$viewallmember->UpdateSort($viewallmember->t_code); // t_code
			$viewallmember->UpdateSort($viewallmember->village_id); // village_id
			$viewallmember->UpdateSort($viewallmember->suffix); // suffix
			$viewallmember->UpdateSort($viewallmember->bnfc1_name); // bnfc1_name
			$viewallmember->UpdateSort($viewallmember->bnfc1_rel); // bnfc1_rel
			$viewallmember->UpdateSort($viewallmember->bnfc2_name); // bnfc2_name
			$viewallmember->UpdateSort($viewallmember->bnfc2_rel); // bnfc2_rel
			$viewallmember->UpdateSort($viewallmember->bnfc3_name); // bnfc3_name
			$viewallmember->UpdateSort($viewallmember->bnfc3_rel); // bnfc3_rel
			$viewallmember->UpdateSort($viewallmember->bnfc4_name); // bnfc4_name
			$viewallmember->UpdateSort($viewallmember->bnfc4_rel); // bnfc4_rel
			$viewallmember->UpdateSort($viewallmember->attachment); // attachment
			$viewallmember->UpdateSort($viewallmember->regis_date); // regis_date
			$viewallmember->UpdateSort($viewallmember->effective_date); // effective_date
			$viewallmember->UpdateSort($viewallmember->resign_date); // resign_date
			$viewallmember->UpdateSort($viewallmember->dead_date); // dead_date
			$viewallmember->UpdateSort($viewallmember->terminate_date); // terminate_date
			$viewallmember->UpdateSort($viewallmember->member_status); // member_status
			$viewallmember->UpdateSort($viewallmember->advance_budget); // advance_budget
			$viewallmember->UpdateSort($viewallmember->dead_id); // dead_id
			$viewallmember->UpdateSort($viewallmember->t_title); // t_title
			$viewallmember->UpdateSort($viewallmember->v_code); // v_code
			$viewallmember->UpdateSort($viewallmember->v_title); // v_title
			$sSortSql = $viewallmember->SortSql();
			$viewallmember->setOrderBy($sSortSql);
			$viewallmember->setStartGroup(1);
		}
		return $viewallmember->getOrderBy();
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
