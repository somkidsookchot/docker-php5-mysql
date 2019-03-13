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
$CustomView1 = NULL;

//
// Table class for CustomView1
//
class crCustomView1 {
	var $TableVar = 'CustomView1';
	var $TableName = 'CustomView1';
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
	var $village_id;
	var $v_code;
	var $v_title;
	var $t_code;
	var $flag;
	var $member_id;
	var $member_status;
	var $t_id;
	var $t_title;
	var $t_order;
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
	function crCustomView1() {
		global $ReportLanguage;

		// village_id
		$this->village_id = new crField('CustomView1', 'CustomView1', 'x_village_id', 'village_id', '`village_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";

		// v_code
		$this->v_code = new crField('CustomView1', 'CustomView1', 'x_v_code', 'v_code', '`v_code`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->v_code->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['v_code'] =& $this->v_code;
		$this->v_code->DateFilter = "";
		$this->v_code->SqlSelect = "";
		$this->v_code->SqlOrderBy = "";

		// v_title
		$this->v_title = new crField('CustomView1', 'CustomView1', 'x_v_title', 'v_title', '`v_title`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "";
		$this->v_title->SqlOrderBy = "";

		// t_code
		$this->t_code = new crField('CustomView1', 'CustomView1', 'x_t_code', 't_code', '`t_code`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";

		// flag
		$this->flag = new crField('CustomView1', 'CustomView1', 'x_flag', 'flag', '`flag`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->flag->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['flag'] =& $this->flag;
		$this->flag->DateFilter = "";
		$this->flag->SqlSelect = "";
		$this->flag->SqlOrderBy = "";

		// member_id
		$this->member_id = new crField('CustomView1', 'CustomView1', 'x_member_id', 'member_id', '`member_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->member_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['member_id'] =& $this->member_id;
		$this->member_id->DateFilter = "";
		$this->member_id->SqlSelect = "";
		$this->member_id->SqlOrderBy = "";

		// member_status
		$this->member_status = new crField('CustomView1', 'CustomView1', 'x_member_status', 'member_status', 'members.member_status', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_status'] =& $this->member_status;
		$this->member_status->DateFilter = "";
		$this->member_status->SqlSelect = "";
		$this->member_status->SqlOrderBy = "";

		// t_id
		$this->t_id = new crField('CustomView1', 'CustomView1', 'x_t_id', 't_id', '`t_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->t_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['t_id'] =& $this->t_id;
		$this->t_id->DateFilter = "";
		$this->t_id->SqlSelect = "";
		$this->t_id->SqlOrderBy = "";

		// t_title
		$this->t_title = new crField('CustomView1', 'CustomView1', 'x_t_title', 't_title', '`t_title`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "";
		$this->t_title->SqlOrderBy = "";

		// t_order
		$this->t_order = new crField('CustomView1', 'CustomView1', 'x_t_order', 't_order', '`t_order`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->t_order->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['t_order'] =& $this->t_order;
		$this->t_order->DateFilter = "";
		$this->t_order->SqlSelect = "";
		$this->t_order->SqlOrderBy = "";

		// member_type
		$this->member_type = new crField('CustomView1', 'CustomView1', 'x_member_type', 'member_type', '`member_type`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->member_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['member_type'] =& $this->member_type;
		$this->member_type->DateFilter = "";
		$this->member_type->SqlSelect = "";
		$this->member_type->SqlOrderBy = "";

		// member_code
		$this->member_code = new crField('CustomView1', 'CustomView1', 'x_member_code', 'member_code', '`member_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";

		// id_code
		$this->id_code = new crField('CustomView1', 'CustomView1', 'x_id_code', 'id_code', '`id_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['id_code'] =& $this->id_code;
		$this->id_code->DateFilter = "";
		$this->id_code->SqlSelect = "";
		$this->id_code->SqlOrderBy = "";

		// gender
		$this->gender = new crField('CustomView1', 'CustomView1', 'x_gender', 'gender', '`gender`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['gender'] =& $this->gender;
		$this->gender->DateFilter = "";
		$this->gender->SqlSelect = "";
		$this->gender->SqlOrderBy = "";

		// prefix
		$this->prefix = new crField('CustomView1', 'CustomView1', 'x_prefix', 'prefix', '`prefix`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['prefix'] =& $this->prefix;
		$this->prefix->DateFilter = "";
		$this->prefix->SqlSelect = "";
		$this->prefix->SqlOrderBy = "";

		// fname
		$this->fname = new crField('CustomView1', 'CustomView1', 'x_fname', 'fname', '`fname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";

		// lname
		$this->lname = new crField('CustomView1', 'CustomView1', 'x_lname', 'lname', '`lname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";

		// birthdate
		$this->birthdate = new crField('CustomView1', 'CustomView1', 'x_birthdate', 'birthdate', '`birthdate`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->birthdate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['birthdate'] =& $this->birthdate;
		$this->birthdate->DateFilter = "";
		$this->birthdate->SqlSelect = "";
		$this->birthdate->SqlOrderBy = "";

		// age
		$this->age = new crField('CustomView1', 'CustomView1', 'x_age', 'age', '`age`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;
		$this->age->DateFilter = "";
		$this->age->SqlSelect = "";
		$this->age->SqlOrderBy = "";

		// email
		$this->zemail = new crField('CustomView1', 'CustomView1', 'x_zemail', 'email', '`email`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['zemail'] =& $this->zemail;
		$this->zemail->DateFilter = "";
		$this->zemail->SqlSelect = "";
		$this->zemail->SqlOrderBy = "";

		// phone
		$this->phone = new crField('CustomView1', 'CustomView1', 'x_phone', 'phone', '`phone`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['phone'] =& $this->phone;
		$this->phone->DateFilter = "";
		$this->phone->SqlSelect = "";
		$this->phone->SqlOrderBy = "";

		// address
		$this->address = new crField('CustomView1', 'CustomView1', 'x_address', 'address', '`address`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['address'] =& $this->address;
		$this->address->DateFilter = "";
		$this->address->SqlSelect = "";
		$this->address->SqlOrderBy = "";

		// suffix
		$this->suffix = new crField('CustomView1', 'CustomView1', 'x_suffix', 'suffix', '`suffix`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['suffix'] =& $this->suffix;
		$this->suffix->DateFilter = "";
		$this->suffix->SqlSelect = "";
		$this->suffix->SqlOrderBy = "";

		// bnfc1_name
		$this->bnfc1_name = new crField('CustomView1', 'CustomView1', 'x_bnfc1_name', 'bnfc1_name', '`bnfc1_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_name'] =& $this->bnfc1_name;
		$this->bnfc1_name->DateFilter = "";
		$this->bnfc1_name->SqlSelect = "";
		$this->bnfc1_name->SqlOrderBy = "";

		// bnfc1_rel
		$this->bnfc1_rel = new crField('CustomView1', 'CustomView1', 'x_bnfc1_rel', 'bnfc1_rel', '`bnfc1_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_rel'] =& $this->bnfc1_rel;
		$this->bnfc1_rel->DateFilter = "";
		$this->bnfc1_rel->SqlSelect = "";
		$this->bnfc1_rel->SqlOrderBy = "";

		// bnfc2_name
		$this->bnfc2_name = new crField('CustomView1', 'CustomView1', 'x_bnfc2_name', 'bnfc2_name', '`bnfc2_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_name'] =& $this->bnfc2_name;
		$this->bnfc2_name->DateFilter = "";
		$this->bnfc2_name->SqlSelect = "";
		$this->bnfc2_name->SqlOrderBy = "";

		// bnfc2_rel
		$this->bnfc2_rel = new crField('CustomView1', 'CustomView1', 'x_bnfc2_rel', 'bnfc2_rel', '`bnfc2_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_rel'] =& $this->bnfc2_rel;
		$this->bnfc2_rel->DateFilter = "";
		$this->bnfc2_rel->SqlSelect = "";
		$this->bnfc2_rel->SqlOrderBy = "";

		// bnfc3_name
		$this->bnfc3_name = new crField('CustomView1', 'CustomView1', 'x_bnfc3_name', 'bnfc3_name', '`bnfc3_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_name'] =& $this->bnfc3_name;
		$this->bnfc3_name->DateFilter = "";
		$this->bnfc3_name->SqlSelect = "";
		$this->bnfc3_name->SqlOrderBy = "";

		// bnfc3_rel
		$this->bnfc3_rel = new crField('CustomView1', 'CustomView1', 'x_bnfc3_rel', 'bnfc3_rel', '`bnfc3_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_rel'] =& $this->bnfc3_rel;
		$this->bnfc3_rel->DateFilter = "";
		$this->bnfc3_rel->SqlSelect = "";
		$this->bnfc3_rel->SqlOrderBy = "";

		// bnfc4_name
		$this->bnfc4_name = new crField('CustomView1', 'CustomView1', 'x_bnfc4_name', 'bnfc4_name', '`bnfc4_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc4_name'] =& $this->bnfc4_name;
		$this->bnfc4_name->DateFilter = "";
		$this->bnfc4_name->SqlSelect = "";
		$this->bnfc4_name->SqlOrderBy = "";

		// bnfc4_rel
		$this->bnfc4_rel = new crField('CustomView1', 'CustomView1', 'x_bnfc4_rel', 'bnfc4_rel', '`bnfc4_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc4_rel'] =& $this->bnfc4_rel;
		$this->bnfc4_rel->DateFilter = "";
		$this->bnfc4_rel->SqlSelect = "";
		$this->bnfc4_rel->SqlOrderBy = "";

		// attachment
		$this->attachment = new crField('CustomView1', 'CustomView1', 'x_attachment', 'attachment', '`attachment`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['attachment'] =& $this->attachment;
		$this->attachment->DateFilter = "";
		$this->attachment->SqlSelect = "";
		$this->attachment->SqlOrderBy = "";

		// regis_date
		$this->regis_date = new crField('CustomView1', 'CustomView1', 'x_regis_date', 'regis_date', '`regis_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->regis_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['regis_date'] =& $this->regis_date;
		$this->regis_date->DateFilter = "";
		$this->regis_date->SqlSelect = "";
		$this->regis_date->SqlOrderBy = "";

		// effective_date
		$this->effective_date = new crField('CustomView1', 'CustomView1', 'x_effective_date', 'effective_date', '`effective_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->effective_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['effective_date'] =& $this->effective_date;
		$this->effective_date->DateFilter = "";
		$this->effective_date->SqlSelect = "";
		$this->effective_date->SqlOrderBy = "";

		// resign_date
		$this->resign_date = new crField('CustomView1', 'CustomView1', 'x_resign_date', 'resign_date', '`resign_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->resign_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['resign_date'] =& $this->resign_date;
		$this->resign_date->DateFilter = "";
		$this->resign_date->SqlSelect = "";
		$this->resign_date->SqlOrderBy = "";

		// dead_date
		$this->dead_date = new crField('CustomView1', 'CustomView1', 'x_dead_date', 'dead_date', '`dead_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->dead_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['dead_date'] =& $this->dead_date;
		$this->dead_date->DateFilter = "";
		$this->dead_date->SqlSelect = "";
		$this->dead_date->SqlOrderBy = "";

		// terminate_date
		$this->terminate_date = new crField('CustomView1', 'CustomView1', 'x_terminate_date', 'terminate_date', '`terminate_date`', 133, EWRPT_DATATYPE_DATE, 6);
		$this->terminate_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['terminate_date'] =& $this->terminate_date;
		$this->terminate_date->DateFilter = "";
		$this->terminate_date->SqlSelect = "";
		$this->terminate_date->SqlOrderBy = "";

		// advance_budget
		$this->advance_budget = new crField('CustomView1', 'CustomView1', 'x_advance_budget', 'advance_budget', '`advance_budget`', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->advance_budget->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['advance_budget'] =& $this->advance_budget;
		$this->advance_budget->DateFilter = "";
		$this->advance_budget->SqlSelect = "";
		$this->advance_budget->SqlOrderBy = "";

		// dead_id
		$this->dead_id = new crField('CustomView1', 'CustomView1', 'x_dead_id', 'dead_id', '`dead_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->dead_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['dead_id'] =& $this->dead_id;
		$this->dead_id->DateFilter = "";
		$this->dead_id->SqlSelect = "";
		$this->dead_id->SqlOrderBy = "";

		// note
		$this->note = new crField('CustomView1', 'CustomView1', 'x_note', 'note', '`note`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['note'] =& $this->note;
		$this->note->DateFilter = "";
		$this->note->SqlSelect = "";
		$this->note->SqlOrderBy = "";

		// update_detail
		$this->update_detail = new crField('CustomView1', 'CustomView1', 'x_update_detail', 'update_detail', '`update_detail`', 201, EWRPT_DATATYPE_MEMO, -1);
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
		return "tambon Right Join village On tambon.t_code = village.t_code Right Join members On village.village_id = members.village_id";
	}

	function SqlSelect() { // Select
		return "SELECT tambon.*, village.*, members.member_status, members.* FROM " . $this->SqlFrom();
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
$CustomView1_rpt = new crCustomView1_rpt();
$Page =& $CustomView1_rpt;

// Page init
$CustomView1_rpt->Page_Init();

// Page main
$CustomView1_rpt->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($CustomView1->Export == "") { ?>
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
<?php $CustomView1_rpt->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $CustomView1_rpt->ShowMessage(); ?>
<?php if ($CustomView1->Export == "" || $CustomView1->Export == "print" || $CustomView1->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($CustomView1->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($CustomView1->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($CustomView1->Export == "" || $CustomView1->Export == "print" || $CustomView1->Export == "email") { ?>
<?php } ?>
<?php echo $CustomView1->TableCaption() ?>
<?php if ($CustomView1->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $CustomView1_rpt->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $CustomView1_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
<?php } ?>
<br /><br />
<?php if ($CustomView1->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($CustomView1->Export == "" || $CustomView1->Export == "print" || $CustomView1->Export == "email") { ?>
<?php } ?>
<?php if ($CustomView1->Export == "") { ?>
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
<?php if ($CustomView1->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="CustomView1rpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($CustomView1_rpt->StartGrp, $CustomView1_rpt->DisplayGrps, $CustomView1_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="CustomView1rpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="CustomView1rpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="CustomView1rpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="CustomView1rpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($CustomView1_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($CustomView1_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($CustomView1_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($CustomView1_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($CustomView1_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($CustomView1_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($CustomView1_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($CustomView1_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($CustomView1_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($CustomView1_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($CustomView1->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($CustomView1->ExportAll && $CustomView1->Export <> "") {
	$CustomView1_rpt->StopGrp = $CustomView1_rpt->TotalGrps;
} else {
	$CustomView1_rpt->StopGrp = $CustomView1_rpt->StartGrp + $CustomView1_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($CustomView1_rpt->StopGrp) > intval($CustomView1_rpt->TotalGrps))
	$CustomView1_rpt->StopGrp = $CustomView1_rpt->TotalGrps;
$CustomView1_rpt->RecCount = 0;

// Get first row
if ($CustomView1_rpt->TotalGrps > 0) {
	$CustomView1_rpt->GetRow(1);
	$CustomView1_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $CustomView1_rpt->GrpCount <= $CustomView1_rpt->DisplayGrps) || $CustomView1_rpt->ShowFirstHeader) {

	// Show header
	if ($CustomView1_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->village_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->village_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->village_id) ?>',1);"><?php echo $CustomView1->village_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->village_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->village_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->v_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->v_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->v_code) ?>',1);"><?php echo $CustomView1->v_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->v_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->v_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->v_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->v_title) ?>',1);"><?php echo $CustomView1->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->t_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->t_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->t_code) ?>',1);"><?php echo $CustomView1->t_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->t_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->t_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->flag) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->flag->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->flag) ?>',1);"><?php echo $CustomView1->flag->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->flag->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->flag->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->member_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->member_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->member_id) ?>',1);"><?php echo $CustomView1->member_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->member_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->member_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->member_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->member_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->member_status) ?>',1);"><?php echo $CustomView1->member_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->member_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->member_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->t_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->t_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->t_id) ?>',1);"><?php echo $CustomView1->t_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->t_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->t_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->t_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->t_title) ?>',1);"><?php echo $CustomView1->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->t_order) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->t_order->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->t_order) ?>',1);"><?php echo $CustomView1->t_order->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->t_order->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->t_order->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->member_type) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->member_type->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->member_type) ?>',1);"><?php echo $CustomView1->member_type->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->member_type->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->member_type->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->member_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->member_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->member_code) ?>',1);"><?php echo $CustomView1->member_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->member_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->member_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->id_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->id_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->id_code) ?>',1);"><?php echo $CustomView1->id_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->id_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->id_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->gender) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->gender->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->gender) ?>',1);"><?php echo $CustomView1->gender->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->gender->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->gender->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->prefix) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->prefix->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->prefix) ?>',1);"><?php echo $CustomView1->prefix->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->prefix->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->prefix->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->fname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->fname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->fname) ?>',1);"><?php echo $CustomView1->fname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->fname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->fname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->lname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->lname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->lname) ?>',1);"><?php echo $CustomView1->lname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->lname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->lname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->birthdate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->birthdate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->birthdate) ?>',1);"><?php echo $CustomView1->birthdate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->birthdate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->birthdate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->age) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->age) ?>',1);"><?php echo $CustomView1->age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->zemail) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->zemail->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->zemail) ?>',1);"><?php echo $CustomView1->zemail->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->zemail->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->zemail->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->phone) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->phone->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->phone) ?>',1);"><?php echo $CustomView1->phone->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->phone->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->phone->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->address) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->address->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->address) ?>',1);"><?php echo $CustomView1->address->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->address->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->address->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->suffix) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->suffix->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->suffix) ?>',1);"><?php echo $CustomView1->suffix->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->suffix->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->suffix->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->bnfc1_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->bnfc1_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->bnfc1_name) ?>',1);"><?php echo $CustomView1->bnfc1_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->bnfc1_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->bnfc1_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->bnfc1_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->bnfc1_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->bnfc1_rel) ?>',1);"><?php echo $CustomView1->bnfc1_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->bnfc1_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->bnfc1_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->bnfc2_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->bnfc2_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->bnfc2_name) ?>',1);"><?php echo $CustomView1->bnfc2_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->bnfc2_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->bnfc2_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->bnfc2_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->bnfc2_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->bnfc2_rel) ?>',1);"><?php echo $CustomView1->bnfc2_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->bnfc2_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->bnfc2_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->bnfc3_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->bnfc3_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->bnfc3_name) ?>',1);"><?php echo $CustomView1->bnfc3_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->bnfc3_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->bnfc3_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->bnfc3_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->bnfc3_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->bnfc3_rel) ?>',1);"><?php echo $CustomView1->bnfc3_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->bnfc3_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->bnfc3_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->bnfc4_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->bnfc4_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->bnfc4_name) ?>',1);"><?php echo $CustomView1->bnfc4_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->bnfc4_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->bnfc4_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->bnfc4_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->bnfc4_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->bnfc4_rel) ?>',1);"><?php echo $CustomView1->bnfc4_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->bnfc4_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->bnfc4_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->attachment) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->attachment->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->attachment) ?>',1);"><?php echo $CustomView1->attachment->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->attachment->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->attachment->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->regis_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->regis_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->regis_date) ?>',1);"><?php echo $CustomView1->regis_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->regis_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->regis_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->effective_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->effective_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->effective_date) ?>',1);"><?php echo $CustomView1->effective_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->effective_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->effective_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->resign_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->resign_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->resign_date) ?>',1);"><?php echo $CustomView1->resign_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->resign_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->resign_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->dead_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->dead_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->dead_date) ?>',1);"><?php echo $CustomView1->dead_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->dead_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->dead_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->terminate_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->terminate_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->terminate_date) ?>',1);"><?php echo $CustomView1->terminate_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->terminate_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->terminate_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->advance_budget) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->advance_budget->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->advance_budget) ?>',1);"><?php echo $CustomView1->advance_budget->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->advance_budget->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->advance_budget->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($CustomView1->SortUrl($CustomView1->dead_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $CustomView1->dead_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $CustomView1->SortUrl($CustomView1->dead_id) ?>',1);"><?php echo $CustomView1->dead_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($CustomView1->dead_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($CustomView1->dead_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$CustomView1_rpt->ShowFirstHeader = FALSE;
	}
	$CustomView1_rpt->RecCount++;

		// Render detail row
		$CustomView1->ResetCSS();
		$CustomView1->RowType = EWRPT_ROWTYPE_DETAIL;
		$CustomView1_rpt->RenderRow();
?>
	<tr<?php echo $CustomView1->RowAttributes(); ?>>
		<td<?php echo $CustomView1->village_id->CellAttributes() ?>>
<div<?php echo $CustomView1->village_id->ViewAttributes(); ?>><?php echo $CustomView1->village_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->v_code->CellAttributes() ?>>
<div<?php echo $CustomView1->v_code->ViewAttributes(); ?>><?php echo $CustomView1->v_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->v_title->CellAttributes() ?>>
<div<?php echo $CustomView1->v_title->ViewAttributes(); ?>><?php echo $CustomView1->v_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->t_code->CellAttributes() ?>>
<div<?php echo $CustomView1->t_code->ViewAttributes(); ?>><?php echo $CustomView1->t_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->flag->CellAttributes() ?>>
<div<?php echo $CustomView1->flag->ViewAttributes(); ?>><?php echo $CustomView1->flag->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->member_id->CellAttributes() ?>>
<div<?php echo $CustomView1->member_id->ViewAttributes(); ?>><?php echo $CustomView1->member_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->member_status->CellAttributes() ?>>
<div<?php echo $CustomView1->member_status->ViewAttributes(); ?>><?php echo $CustomView1->member_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->t_id->CellAttributes() ?>>
<div<?php echo $CustomView1->t_id->ViewAttributes(); ?>><?php echo $CustomView1->t_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->t_title->CellAttributes() ?>>
<div<?php echo $CustomView1->t_title->ViewAttributes(); ?>><?php echo $CustomView1->t_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->t_order->CellAttributes() ?>>
<div<?php echo $CustomView1->t_order->ViewAttributes(); ?>><?php echo $CustomView1->t_order->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->member_type->CellAttributes() ?>>
<div<?php echo $CustomView1->member_type->ViewAttributes(); ?>><?php echo $CustomView1->member_type->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->member_code->CellAttributes() ?>>
<div<?php echo $CustomView1->member_code->ViewAttributes(); ?>><?php echo $CustomView1->member_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->id_code->CellAttributes() ?>>
<div<?php echo $CustomView1->id_code->ViewAttributes(); ?>><?php echo $CustomView1->id_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->gender->CellAttributes() ?>>
<div<?php echo $CustomView1->gender->ViewAttributes(); ?>><?php echo $CustomView1->gender->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->prefix->CellAttributes() ?>>
<div<?php echo $CustomView1->prefix->ViewAttributes(); ?>><?php echo $CustomView1->prefix->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->fname->CellAttributes() ?>>
<div<?php echo $CustomView1->fname->ViewAttributes(); ?>><?php echo $CustomView1->fname->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->lname->CellAttributes() ?>>
<div<?php echo $CustomView1->lname->ViewAttributes(); ?>><?php echo $CustomView1->lname->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->birthdate->CellAttributes() ?>>
<div<?php echo $CustomView1->birthdate->ViewAttributes(); ?>><?php echo $CustomView1->birthdate->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->age->CellAttributes() ?>>
<div<?php echo $CustomView1->age->ViewAttributes(); ?>><?php echo $CustomView1->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->zemail->CellAttributes() ?>>
<div<?php echo $CustomView1->zemail->ViewAttributes(); ?>><?php echo $CustomView1->zemail->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->phone->CellAttributes() ?>>
<div<?php echo $CustomView1->phone->ViewAttributes(); ?>><?php echo $CustomView1->phone->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->address->CellAttributes() ?>>
<div<?php echo $CustomView1->address->ViewAttributes(); ?>><?php echo $CustomView1->address->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->suffix->CellAttributes() ?>>
<div<?php echo $CustomView1->suffix->ViewAttributes(); ?>><?php echo $CustomView1->suffix->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->bnfc1_name->CellAttributes() ?>>
<div<?php echo $CustomView1->bnfc1_name->ViewAttributes(); ?>><?php echo $CustomView1->bnfc1_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->bnfc1_rel->CellAttributes() ?>>
<div<?php echo $CustomView1->bnfc1_rel->ViewAttributes(); ?>><?php echo $CustomView1->bnfc1_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->bnfc2_name->CellAttributes() ?>>
<div<?php echo $CustomView1->bnfc2_name->ViewAttributes(); ?>><?php echo $CustomView1->bnfc2_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->bnfc2_rel->CellAttributes() ?>>
<div<?php echo $CustomView1->bnfc2_rel->ViewAttributes(); ?>><?php echo $CustomView1->bnfc2_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->bnfc3_name->CellAttributes() ?>>
<div<?php echo $CustomView1->bnfc3_name->ViewAttributes(); ?>><?php echo $CustomView1->bnfc3_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->bnfc3_rel->CellAttributes() ?>>
<div<?php echo $CustomView1->bnfc3_rel->ViewAttributes(); ?>><?php echo $CustomView1->bnfc3_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->bnfc4_name->CellAttributes() ?>>
<div<?php echo $CustomView1->bnfc4_name->ViewAttributes(); ?>><?php echo $CustomView1->bnfc4_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->bnfc4_rel->CellAttributes() ?>>
<div<?php echo $CustomView1->bnfc4_rel->ViewAttributes(); ?>><?php echo $CustomView1->bnfc4_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->attachment->CellAttributes() ?>>
<div<?php echo $CustomView1->attachment->ViewAttributes(); ?>><?php echo $CustomView1->attachment->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->regis_date->CellAttributes() ?>>
<div<?php echo $CustomView1->regis_date->ViewAttributes(); ?>><?php echo $CustomView1->regis_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->effective_date->CellAttributes() ?>>
<div<?php echo $CustomView1->effective_date->ViewAttributes(); ?>><?php echo $CustomView1->effective_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->resign_date->CellAttributes() ?>>
<div<?php echo $CustomView1->resign_date->ViewAttributes(); ?>><?php echo $CustomView1->resign_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->dead_date->CellAttributes() ?>>
<div<?php echo $CustomView1->dead_date->ViewAttributes(); ?>><?php echo $CustomView1->dead_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->terminate_date->CellAttributes() ?>>
<div<?php echo $CustomView1->terminate_date->ViewAttributes(); ?>><?php echo $CustomView1->terminate_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->advance_budget->CellAttributes() ?>>
<div<?php echo $CustomView1->advance_budget->ViewAttributes(); ?>><?php echo $CustomView1->advance_budget->ListViewValue(); ?></div>
</td>
		<td<?php echo $CustomView1->dead_id->CellAttributes() ?>>
<div<?php echo $CustomView1->dead_id->ViewAttributes(); ?>><?php echo $CustomView1->dead_id->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$CustomView1_rpt->AccumulateSummary();

		// Get next record
		$CustomView1_rpt->GetRow(2);
	$CustomView1_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($CustomView1_rpt->TotalGrps > 0) { ?>
<?php if ($CustomView1->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="CustomView1rpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($CustomView1_rpt->StartGrp, $CustomView1_rpt->DisplayGrps, $CustomView1_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="CustomView1rpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="CustomView1rpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="CustomView1rpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="CustomView1rpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($CustomView1_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($CustomView1_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($CustomView1_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($CustomView1_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($CustomView1_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($CustomView1_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($CustomView1_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($CustomView1_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($CustomView1_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($CustomView1_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($CustomView1->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($CustomView1->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($CustomView1->Export == "" || $CustomView1->Export == "print" || $CustomView1->Export == "email") { ?>
<?php } ?>
<?php if ($CustomView1->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($CustomView1->Export == "" || $CustomView1->Export == "print" || $CustomView1->Export == "email") { ?>
<?php } ?>
<?php if ($CustomView1->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $CustomView1_rpt->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($CustomView1->Export == "") { ?>
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
$CustomView1_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crCustomView1_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'CustomView1';

	// Page object name
	var $PageObjName = 'CustomView1_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $CustomView1;
		if ($CustomView1->UseTokenInUrl) $PageUrl .= "t=" . $CustomView1->TableVar . "&"; // Add page token
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
		global $CustomView1;
		if ($CustomView1->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($CustomView1->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($CustomView1->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crCustomView1_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (CustomView1)
		$GLOBALS["CustomView1"] = new crCustomView1();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'CustomView1', TRUE);

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
		global $CustomView1;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$CustomView1->Export = $_GET["export"];
	}
	$gsExport = $CustomView1->Export; // Get export parameter, used in header
	$gsExportFile = $CustomView1->TableVar; // Get export file, used in header
	if ($CustomView1->Export == "excel") {
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
		global $CustomView1;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($CustomView1->Export == "email") {
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
		global $CustomView1;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 40;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

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
		$sSql = ewrpt_BuildReportSql($CustomView1->SqlSelect(), $CustomView1->SqlWhere(), $CustomView1->SqlGroupBy(), $CustomView1->SqlHaving(), $CustomView1->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($CustomView1->ExportAll && $CustomView1->Export <> "")
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
		global $CustomView1;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$CustomView1->village_id->setDbValue($rs->fields('village_id'));
			$CustomView1->v_code->setDbValue($rs->fields('v_code'));
			$CustomView1->v_title->setDbValue($rs->fields('v_title'));
			$CustomView1->t_code->setDbValue($rs->fields('t_code'));
			$CustomView1->flag->setDbValue($rs->fields('flag'));
			$CustomView1->member_id->setDbValue($rs->fields('member_id'));
			$CustomView1->member_status->setDbValue($rs->fields('member_status'));
			$CustomView1->t_id->setDbValue($rs->fields('t_id'));
			$CustomView1->t_title->setDbValue($rs->fields('t_title'));
			$CustomView1->t_order->setDbValue($rs->fields('t_order'));
			$CustomView1->member_type->setDbValue($rs->fields('member_type'));
			$CustomView1->member_code->setDbValue($rs->fields('member_code'));
			$CustomView1->id_code->setDbValue($rs->fields('id_code'));
			$CustomView1->gender->setDbValue($rs->fields('gender'));
			$CustomView1->prefix->setDbValue($rs->fields('prefix'));
			$CustomView1->fname->setDbValue($rs->fields('fname'));
			$CustomView1->lname->setDbValue($rs->fields('lname'));
			$CustomView1->birthdate->setDbValue($rs->fields('birthdate'));
			$CustomView1->age->setDbValue($rs->fields('age'));
			$CustomView1->zemail->setDbValue($rs->fields('email'));
			$CustomView1->phone->setDbValue($rs->fields('phone'));
			$CustomView1->address->setDbValue($rs->fields('address'));
			$CustomView1->suffix->setDbValue($rs->fields('suffix'));
			$CustomView1->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
			$CustomView1->bnfc1_rel->setDbValue($rs->fields('bnfc1_rel'));
			$CustomView1->bnfc2_name->setDbValue($rs->fields('bnfc2_name'));
			$CustomView1->bnfc2_rel->setDbValue($rs->fields('bnfc2_rel'));
			$CustomView1->bnfc3_name->setDbValue($rs->fields('bnfc3_name'));
			$CustomView1->bnfc3_rel->setDbValue($rs->fields('bnfc3_rel'));
			$CustomView1->bnfc4_name->setDbValue($rs->fields('bnfc4_name'));
			$CustomView1->bnfc4_rel->setDbValue($rs->fields('bnfc4_rel'));
			$CustomView1->attachment->setDbValue($rs->fields('attachment'));
			$CustomView1->regis_date->setDbValue($rs->fields('regis_date'));
			$CustomView1->effective_date->setDbValue($rs->fields('effective_date'));
			$CustomView1->resign_date->setDbValue($rs->fields('resign_date'));
			$CustomView1->dead_date->setDbValue($rs->fields('dead_date'));
			$CustomView1->terminate_date->setDbValue($rs->fields('terminate_date'));
			$CustomView1->advance_budget->setDbValue($rs->fields('advance_budget'));
			$CustomView1->dead_id->setDbValue($rs->fields('dead_id'));
			$CustomView1->note->setDbValue($rs->fields('note'));
			$CustomView1->update_detail->setDbValue($rs->fields('update_detail'));
			$this->Val[1] = $CustomView1->village_id->CurrentValue;
			$this->Val[2] = $CustomView1->v_code->CurrentValue;
			$this->Val[3] = $CustomView1->v_title->CurrentValue;
			$this->Val[4] = $CustomView1->t_code->CurrentValue;
			$this->Val[5] = $CustomView1->flag->CurrentValue;
			$this->Val[6] = $CustomView1->member_id->CurrentValue;
			$this->Val[7] = $CustomView1->member_status->CurrentValue;
			$this->Val[8] = $CustomView1->t_id->CurrentValue;
			$this->Val[9] = $CustomView1->t_title->CurrentValue;
			$this->Val[10] = $CustomView1->t_order->CurrentValue;
			$this->Val[11] = $CustomView1->member_type->CurrentValue;
			$this->Val[12] = $CustomView1->member_code->CurrentValue;
			$this->Val[13] = $CustomView1->id_code->CurrentValue;
			$this->Val[14] = $CustomView1->gender->CurrentValue;
			$this->Val[15] = $CustomView1->prefix->CurrentValue;
			$this->Val[16] = $CustomView1->fname->CurrentValue;
			$this->Val[17] = $CustomView1->lname->CurrentValue;
			$this->Val[18] = $CustomView1->birthdate->CurrentValue;
			$this->Val[19] = $CustomView1->age->CurrentValue;
			$this->Val[20] = $CustomView1->zemail->CurrentValue;
			$this->Val[21] = $CustomView1->phone->CurrentValue;
			$this->Val[22] = $CustomView1->address->CurrentValue;
			$this->Val[23] = $CustomView1->suffix->CurrentValue;
			$this->Val[24] = $CustomView1->bnfc1_name->CurrentValue;
			$this->Val[25] = $CustomView1->bnfc1_rel->CurrentValue;
			$this->Val[26] = $CustomView1->bnfc2_name->CurrentValue;
			$this->Val[27] = $CustomView1->bnfc2_rel->CurrentValue;
			$this->Val[28] = $CustomView1->bnfc3_name->CurrentValue;
			$this->Val[29] = $CustomView1->bnfc3_rel->CurrentValue;
			$this->Val[30] = $CustomView1->bnfc4_name->CurrentValue;
			$this->Val[31] = $CustomView1->bnfc4_rel->CurrentValue;
			$this->Val[32] = $CustomView1->attachment->CurrentValue;
			$this->Val[33] = $CustomView1->regis_date->CurrentValue;
			$this->Val[34] = $CustomView1->effective_date->CurrentValue;
			$this->Val[35] = $CustomView1->resign_date->CurrentValue;
			$this->Val[36] = $CustomView1->dead_date->CurrentValue;
			$this->Val[37] = $CustomView1->terminate_date->CurrentValue;
			$this->Val[38] = $CustomView1->advance_budget->CurrentValue;
			$this->Val[39] = $CustomView1->dead_id->CurrentValue;
		} else {
			$CustomView1->village_id->setDbValue("");
			$CustomView1->v_code->setDbValue("");
			$CustomView1->v_title->setDbValue("");
			$CustomView1->t_code->setDbValue("");
			$CustomView1->flag->setDbValue("");
			$CustomView1->member_id->setDbValue("");
			$CustomView1->member_status->setDbValue("");
			$CustomView1->t_id->setDbValue("");
			$CustomView1->t_title->setDbValue("");
			$CustomView1->t_order->setDbValue("");
			$CustomView1->member_type->setDbValue("");
			$CustomView1->member_code->setDbValue("");
			$CustomView1->id_code->setDbValue("");
			$CustomView1->gender->setDbValue("");
			$CustomView1->prefix->setDbValue("");
			$CustomView1->fname->setDbValue("");
			$CustomView1->lname->setDbValue("");
			$CustomView1->birthdate->setDbValue("");
			$CustomView1->age->setDbValue("");
			$CustomView1->zemail->setDbValue("");
			$CustomView1->phone->setDbValue("");
			$CustomView1->address->setDbValue("");
			$CustomView1->suffix->setDbValue("");
			$CustomView1->bnfc1_name->setDbValue("");
			$CustomView1->bnfc1_rel->setDbValue("");
			$CustomView1->bnfc2_name->setDbValue("");
			$CustomView1->bnfc2_rel->setDbValue("");
			$CustomView1->bnfc3_name->setDbValue("");
			$CustomView1->bnfc3_rel->setDbValue("");
			$CustomView1->bnfc4_name->setDbValue("");
			$CustomView1->bnfc4_rel->setDbValue("");
			$CustomView1->attachment->setDbValue("");
			$CustomView1->regis_date->setDbValue("");
			$CustomView1->effective_date->setDbValue("");
			$CustomView1->resign_date->setDbValue("");
			$CustomView1->dead_date->setDbValue("");
			$CustomView1->terminate_date->setDbValue("");
			$CustomView1->advance_budget->setDbValue("");
			$CustomView1->dead_id->setDbValue("");
			$CustomView1->note->setDbValue("");
			$CustomView1->update_detail->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $CustomView1;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$CustomView1->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$CustomView1->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $CustomView1->getStartGroup();
			}
		} else {
			$this->StartGrp = $CustomView1->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$CustomView1->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$CustomView1->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$CustomView1->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $CustomView1;

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
		global $CustomView1;
		$this->StartGrp = 1;
		$CustomView1->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $CustomView1;
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
			$CustomView1->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$CustomView1->setStartGroup($this->StartGrp);
		} else {
			if ($CustomView1->getGroupPerPage() <> "") {
				$this->DisplayGrps = $CustomView1->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $CustomView1;
		if ($CustomView1->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($CustomView1->SqlSelectCount(), $CustomView1->SqlWhere(), $CustomView1->SqlGroupBy(), $CustomView1->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$CustomView1->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($CustomView1->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// village_id
			$CustomView1->village_id->ViewValue = $CustomView1->village_id->Summary;

			// v_code
			$CustomView1->v_code->ViewValue = $CustomView1->v_code->Summary;

			// v_title
			$CustomView1->v_title->ViewValue = $CustomView1->v_title->Summary;

			// t_code
			$CustomView1->t_code->ViewValue = $CustomView1->t_code->Summary;

			// flag
			$CustomView1->flag->ViewValue = $CustomView1->flag->Summary;

			// member_id
			$CustomView1->member_id->ViewValue = $CustomView1->member_id->Summary;

			// member_status
			$CustomView1->member_status->ViewValue = $CustomView1->member_status->Summary;

			// t_id
			$CustomView1->t_id->ViewValue = $CustomView1->t_id->Summary;

			// t_title
			$CustomView1->t_title->ViewValue = $CustomView1->t_title->Summary;

			// t_order
			$CustomView1->t_order->ViewValue = $CustomView1->t_order->Summary;

			// member_type
			$CustomView1->member_type->ViewValue = $CustomView1->member_type->Summary;

			// member_code
			$CustomView1->member_code->ViewValue = $CustomView1->member_code->Summary;

			// id_code
			$CustomView1->id_code->ViewValue = $CustomView1->id_code->Summary;

			// gender
			$CustomView1->gender->ViewValue = $CustomView1->gender->Summary;

			// prefix
			$CustomView1->prefix->ViewValue = $CustomView1->prefix->Summary;

			// fname
			$CustomView1->fname->ViewValue = $CustomView1->fname->Summary;

			// lname
			$CustomView1->lname->ViewValue = $CustomView1->lname->Summary;

			// birthdate
			$CustomView1->birthdate->ViewValue = $CustomView1->birthdate->Summary;
			$CustomView1->birthdate->ViewValue = ewrpt_FormatDateTime($CustomView1->birthdate->ViewValue, 6);

			// age
			$CustomView1->age->ViewValue = $CustomView1->age->Summary;

			// email
			$CustomView1->zemail->ViewValue = $CustomView1->zemail->Summary;

			// phone
			$CustomView1->phone->ViewValue = $CustomView1->phone->Summary;

			// address
			$CustomView1->address->ViewValue = $CustomView1->address->Summary;

			// suffix
			$CustomView1->suffix->ViewValue = $CustomView1->suffix->Summary;

			// bnfc1_name
			$CustomView1->bnfc1_name->ViewValue = $CustomView1->bnfc1_name->Summary;

			// bnfc1_rel
			$CustomView1->bnfc1_rel->ViewValue = $CustomView1->bnfc1_rel->Summary;

			// bnfc2_name
			$CustomView1->bnfc2_name->ViewValue = $CustomView1->bnfc2_name->Summary;

			// bnfc2_rel
			$CustomView1->bnfc2_rel->ViewValue = $CustomView1->bnfc2_rel->Summary;

			// bnfc3_name
			$CustomView1->bnfc3_name->ViewValue = $CustomView1->bnfc3_name->Summary;

			// bnfc3_rel
			$CustomView1->bnfc3_rel->ViewValue = $CustomView1->bnfc3_rel->Summary;

			// bnfc4_name
			$CustomView1->bnfc4_name->ViewValue = $CustomView1->bnfc4_name->Summary;

			// bnfc4_rel
			$CustomView1->bnfc4_rel->ViewValue = $CustomView1->bnfc4_rel->Summary;

			// attachment
			$CustomView1->attachment->ViewValue = $CustomView1->attachment->Summary;

			// regis_date
			$CustomView1->regis_date->ViewValue = $CustomView1->regis_date->Summary;
			$CustomView1->regis_date->ViewValue = ewrpt_FormatDateTime($CustomView1->regis_date->ViewValue, 6);

			// effective_date
			$CustomView1->effective_date->ViewValue = $CustomView1->effective_date->Summary;
			$CustomView1->effective_date->ViewValue = ewrpt_FormatDateTime($CustomView1->effective_date->ViewValue, 6);

			// resign_date
			$CustomView1->resign_date->ViewValue = $CustomView1->resign_date->Summary;
			$CustomView1->resign_date->ViewValue = ewrpt_FormatDateTime($CustomView1->resign_date->ViewValue, 6);

			// dead_date
			$CustomView1->dead_date->ViewValue = $CustomView1->dead_date->Summary;
			$CustomView1->dead_date->ViewValue = ewrpt_FormatDateTime($CustomView1->dead_date->ViewValue, 6);

			// terminate_date
			$CustomView1->terminate_date->ViewValue = $CustomView1->terminate_date->Summary;
			$CustomView1->terminate_date->ViewValue = ewrpt_FormatDateTime($CustomView1->terminate_date->ViewValue, 6);

			// advance_budget
			$CustomView1->advance_budget->ViewValue = $CustomView1->advance_budget->Summary;

			// dead_id
			$CustomView1->dead_id->ViewValue = $CustomView1->dead_id->Summary;
		} else {

			// village_id
			$CustomView1->village_id->ViewValue = $CustomView1->village_id->CurrentValue;
			$CustomView1->village_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_code
			$CustomView1->v_code->ViewValue = $CustomView1->v_code->CurrentValue;
			$CustomView1->v_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_title
			$CustomView1->v_title->ViewValue = $CustomView1->v_title->CurrentValue;
			$CustomView1->v_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_code
			$CustomView1->t_code->ViewValue = $CustomView1->t_code->CurrentValue;
			$CustomView1->t_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// flag
			$CustomView1->flag->ViewValue = $CustomView1->flag->CurrentValue;
			$CustomView1->flag->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_id
			$CustomView1->member_id->ViewValue = $CustomView1->member_id->CurrentValue;
			$CustomView1->member_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_status
			$CustomView1->member_status->ViewValue = $CustomView1->member_status->CurrentValue;
			$CustomView1->member_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_id
			$CustomView1->t_id->ViewValue = $CustomView1->t_id->CurrentValue;
			$CustomView1->t_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_title
			$CustomView1->t_title->ViewValue = $CustomView1->t_title->CurrentValue;
			$CustomView1->t_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_order
			$CustomView1->t_order->ViewValue = $CustomView1->t_order->CurrentValue;
			$CustomView1->t_order->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_type
			$CustomView1->member_type->ViewValue = $CustomView1->member_type->CurrentValue;
			$CustomView1->member_type->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_code
			$CustomView1->member_code->ViewValue = $CustomView1->member_code->CurrentValue;
			$CustomView1->member_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// id_code
			$CustomView1->id_code->ViewValue = $CustomView1->id_code->CurrentValue;
			$CustomView1->id_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// gender
			$CustomView1->gender->ViewValue = $CustomView1->gender->CurrentValue;
			$CustomView1->gender->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// prefix
			$CustomView1->prefix->ViewValue = $CustomView1->prefix->CurrentValue;
			$CustomView1->prefix->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$CustomView1->fname->ViewValue = $CustomView1->fname->CurrentValue;
			$CustomView1->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$CustomView1->lname->ViewValue = $CustomView1->lname->CurrentValue;
			$CustomView1->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// birthdate
			$CustomView1->birthdate->ViewValue = $CustomView1->birthdate->CurrentValue;
			$CustomView1->birthdate->ViewValue = ewrpt_FormatDateTime($CustomView1->birthdate->ViewValue, 6);
			$CustomView1->birthdate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// age
			$CustomView1->age->ViewValue = $CustomView1->age->CurrentValue;
			$CustomView1->age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// email
			$CustomView1->zemail->ViewValue = $CustomView1->zemail->CurrentValue;
			$CustomView1->zemail->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// phone
			$CustomView1->phone->ViewValue = $CustomView1->phone->CurrentValue;
			$CustomView1->phone->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// address
			$CustomView1->address->ViewValue = $CustomView1->address->CurrentValue;
			$CustomView1->address->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// suffix
			$CustomView1->suffix->ViewValue = $CustomView1->suffix->CurrentValue;
			$CustomView1->suffix->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc1_name
			$CustomView1->bnfc1_name->ViewValue = $CustomView1->bnfc1_name->CurrentValue;
			$CustomView1->bnfc1_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc1_rel
			$CustomView1->bnfc1_rel->ViewValue = $CustomView1->bnfc1_rel->CurrentValue;
			$CustomView1->bnfc1_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_name
			$CustomView1->bnfc2_name->ViewValue = $CustomView1->bnfc2_name->CurrentValue;
			$CustomView1->bnfc2_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_rel
			$CustomView1->bnfc2_rel->ViewValue = $CustomView1->bnfc2_rel->CurrentValue;
			$CustomView1->bnfc2_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_name
			$CustomView1->bnfc3_name->ViewValue = $CustomView1->bnfc3_name->CurrentValue;
			$CustomView1->bnfc3_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_rel
			$CustomView1->bnfc3_rel->ViewValue = $CustomView1->bnfc3_rel->CurrentValue;
			$CustomView1->bnfc3_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc4_name
			$CustomView1->bnfc4_name->ViewValue = $CustomView1->bnfc4_name->CurrentValue;
			$CustomView1->bnfc4_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc4_rel
			$CustomView1->bnfc4_rel->ViewValue = $CustomView1->bnfc4_rel->CurrentValue;
			$CustomView1->bnfc4_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// attachment
			$CustomView1->attachment->ViewValue = $CustomView1->attachment->CurrentValue;
			$CustomView1->attachment->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// regis_date
			$CustomView1->regis_date->ViewValue = $CustomView1->regis_date->CurrentValue;
			$CustomView1->regis_date->ViewValue = ewrpt_FormatDateTime($CustomView1->regis_date->ViewValue, 6);
			$CustomView1->regis_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// effective_date
			$CustomView1->effective_date->ViewValue = $CustomView1->effective_date->CurrentValue;
			$CustomView1->effective_date->ViewValue = ewrpt_FormatDateTime($CustomView1->effective_date->ViewValue, 6);
			$CustomView1->effective_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// resign_date
			$CustomView1->resign_date->ViewValue = $CustomView1->resign_date->CurrentValue;
			$CustomView1->resign_date->ViewValue = ewrpt_FormatDateTime($CustomView1->resign_date->ViewValue, 6);
			$CustomView1->resign_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_date
			$CustomView1->dead_date->ViewValue = $CustomView1->dead_date->CurrentValue;
			$CustomView1->dead_date->ViewValue = ewrpt_FormatDateTime($CustomView1->dead_date->ViewValue, 6);
			$CustomView1->dead_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// terminate_date
			$CustomView1->terminate_date->ViewValue = $CustomView1->terminate_date->CurrentValue;
			$CustomView1->terminate_date->ViewValue = ewrpt_FormatDateTime($CustomView1->terminate_date->ViewValue, 6);
			$CustomView1->terminate_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// advance_budget
			$CustomView1->advance_budget->ViewValue = $CustomView1->advance_budget->CurrentValue;
			$CustomView1->advance_budget->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_id
			$CustomView1->dead_id->ViewValue = $CustomView1->dead_id->CurrentValue;
			$CustomView1->dead_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// village_id
		$CustomView1->village_id->HrefValue = "";

		// v_code
		$CustomView1->v_code->HrefValue = "";

		// v_title
		$CustomView1->v_title->HrefValue = "";

		// t_code
		$CustomView1->t_code->HrefValue = "";

		// flag
		$CustomView1->flag->HrefValue = "";

		// member_id
		$CustomView1->member_id->HrefValue = "";

		// member_status
		$CustomView1->member_status->HrefValue = "";

		// t_id
		$CustomView1->t_id->HrefValue = "";

		// t_title
		$CustomView1->t_title->HrefValue = "";

		// t_order
		$CustomView1->t_order->HrefValue = "";

		// member_type
		$CustomView1->member_type->HrefValue = "";

		// member_code
		$CustomView1->member_code->HrefValue = "";

		// id_code
		$CustomView1->id_code->HrefValue = "";

		// gender
		$CustomView1->gender->HrefValue = "";

		// prefix
		$CustomView1->prefix->HrefValue = "";

		// fname
		$CustomView1->fname->HrefValue = "";

		// lname
		$CustomView1->lname->HrefValue = "";

		// birthdate
		$CustomView1->birthdate->HrefValue = "";

		// age
		$CustomView1->age->HrefValue = "";

		// email
		$CustomView1->zemail->HrefValue = "";

		// phone
		$CustomView1->phone->HrefValue = "";

		// address
		$CustomView1->address->HrefValue = "";

		// suffix
		$CustomView1->suffix->HrefValue = "";

		// bnfc1_name
		$CustomView1->bnfc1_name->HrefValue = "";

		// bnfc1_rel
		$CustomView1->bnfc1_rel->HrefValue = "";

		// bnfc2_name
		$CustomView1->bnfc2_name->HrefValue = "";

		// bnfc2_rel
		$CustomView1->bnfc2_rel->HrefValue = "";

		// bnfc3_name
		$CustomView1->bnfc3_name->HrefValue = "";

		// bnfc3_rel
		$CustomView1->bnfc3_rel->HrefValue = "";

		// bnfc4_name
		$CustomView1->bnfc4_name->HrefValue = "";

		// bnfc4_rel
		$CustomView1->bnfc4_rel->HrefValue = "";

		// attachment
		$CustomView1->attachment->HrefValue = "";

		// regis_date
		$CustomView1->regis_date->HrefValue = "";

		// effective_date
		$CustomView1->effective_date->HrefValue = "";

		// resign_date
		$CustomView1->resign_date->HrefValue = "";

		// dead_date
		$CustomView1->dead_date->HrefValue = "";

		// terminate_date
		$CustomView1->terminate_date->HrefValue = "";

		// advance_budget
		$CustomView1->advance_budget->HrefValue = "";

		// dead_id
		$CustomView1->dead_id->HrefValue = "";

		// Call Row_Rendered event
		$CustomView1->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $CustomView1;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $CustomView1;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$CustomView1->setOrderBy("");
				$CustomView1->setStartGroup(1);
				$CustomView1->village_id->setSort("");
				$CustomView1->v_code->setSort("");
				$CustomView1->v_title->setSort("");
				$CustomView1->t_code->setSort("");
				$CustomView1->flag->setSort("");
				$CustomView1->member_id->setSort("");
				$CustomView1->member_status->setSort("");
				$CustomView1->t_id->setSort("");
				$CustomView1->t_title->setSort("");
				$CustomView1->t_order->setSort("");
				$CustomView1->member_type->setSort("");
				$CustomView1->member_code->setSort("");
				$CustomView1->id_code->setSort("");
				$CustomView1->gender->setSort("");
				$CustomView1->prefix->setSort("");
				$CustomView1->fname->setSort("");
				$CustomView1->lname->setSort("");
				$CustomView1->birthdate->setSort("");
				$CustomView1->age->setSort("");
				$CustomView1->zemail->setSort("");
				$CustomView1->phone->setSort("");
				$CustomView1->address->setSort("");
				$CustomView1->suffix->setSort("");
				$CustomView1->bnfc1_name->setSort("");
				$CustomView1->bnfc1_rel->setSort("");
				$CustomView1->bnfc2_name->setSort("");
				$CustomView1->bnfc2_rel->setSort("");
				$CustomView1->bnfc3_name->setSort("");
				$CustomView1->bnfc3_rel->setSort("");
				$CustomView1->bnfc4_name->setSort("");
				$CustomView1->bnfc4_rel->setSort("");
				$CustomView1->attachment->setSort("");
				$CustomView1->regis_date->setSort("");
				$CustomView1->effective_date->setSort("");
				$CustomView1->resign_date->setSort("");
				$CustomView1->dead_date->setSort("");
				$CustomView1->terminate_date->setSort("");
				$CustomView1->advance_budget->setSort("");
				$CustomView1->dead_id->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$CustomView1->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$CustomView1->CurrentOrderType = @$_GET["ordertype"];
			$CustomView1->UpdateSort($CustomView1->village_id); // village_id
			$CustomView1->UpdateSort($CustomView1->v_code); // v_code
			$CustomView1->UpdateSort($CustomView1->v_title); // v_title
			$CustomView1->UpdateSort($CustomView1->t_code); // t_code
			$CustomView1->UpdateSort($CustomView1->flag); // flag
			$CustomView1->UpdateSort($CustomView1->member_id); // member_id
			$CustomView1->UpdateSort($CustomView1->member_status); // member_status
			$CustomView1->UpdateSort($CustomView1->t_id); // t_id
			$CustomView1->UpdateSort($CustomView1->t_title); // t_title
			$CustomView1->UpdateSort($CustomView1->t_order); // t_order
			$CustomView1->UpdateSort($CustomView1->member_type); // member_type
			$CustomView1->UpdateSort($CustomView1->member_code); // member_code
			$CustomView1->UpdateSort($CustomView1->id_code); // id_code
			$CustomView1->UpdateSort($CustomView1->gender); // gender
			$CustomView1->UpdateSort($CustomView1->prefix); // prefix
			$CustomView1->UpdateSort($CustomView1->fname); // fname
			$CustomView1->UpdateSort($CustomView1->lname); // lname
			$CustomView1->UpdateSort($CustomView1->birthdate); // birthdate
			$CustomView1->UpdateSort($CustomView1->age); // age
			$CustomView1->UpdateSort($CustomView1->zemail); // email
			$CustomView1->UpdateSort($CustomView1->phone); // phone
			$CustomView1->UpdateSort($CustomView1->address); // address
			$CustomView1->UpdateSort($CustomView1->suffix); // suffix
			$CustomView1->UpdateSort($CustomView1->bnfc1_name); // bnfc1_name
			$CustomView1->UpdateSort($CustomView1->bnfc1_rel); // bnfc1_rel
			$CustomView1->UpdateSort($CustomView1->bnfc2_name); // bnfc2_name
			$CustomView1->UpdateSort($CustomView1->bnfc2_rel); // bnfc2_rel
			$CustomView1->UpdateSort($CustomView1->bnfc3_name); // bnfc3_name
			$CustomView1->UpdateSort($CustomView1->bnfc3_rel); // bnfc3_rel
			$CustomView1->UpdateSort($CustomView1->bnfc4_name); // bnfc4_name
			$CustomView1->UpdateSort($CustomView1->bnfc4_rel); // bnfc4_rel
			$CustomView1->UpdateSort($CustomView1->attachment); // attachment
			$CustomView1->UpdateSort($CustomView1->regis_date); // regis_date
			$CustomView1->UpdateSort($CustomView1->effective_date); // effective_date
			$CustomView1->UpdateSort($CustomView1->resign_date); // resign_date
			$CustomView1->UpdateSort($CustomView1->dead_date); // dead_date
			$CustomView1->UpdateSort($CustomView1->terminate_date); // terminate_date
			$CustomView1->UpdateSort($CustomView1->advance_budget); // advance_budget
			$CustomView1->UpdateSort($CustomView1->dead_id); // dead_id
			$sSortSql = $CustomView1->SortSql();
			$CustomView1->setOrderBy($sSortSql);
			$CustomView1->setStartGroup(1);
		}
		return $CustomView1->getOrderBy();
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
