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
$Report1 = NULL;

//
// Table class for Report1
//
class crReport1 {
	var $TableVar = 'Report1';
	var $TableName = 'Report1';
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
	function crReport1() {
		global $ReportLanguage;

		// member_id
		$this->member_id = new crField('Report1', 'Report1', 'x_member_id', 'member_id', '`member_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->member_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['member_id'] =& $this->member_id;
		$this->member_id->DateFilter = "";
		$this->member_id->SqlSelect = "";
		$this->member_id->SqlOrderBy = "";
		$this->member_id->FldGroupByType = "";
		$this->member_id->FldGroupInt = "0";
		$this->member_id->FldGroupSql = "";

		// member_type
		$this->member_type = new crField('Report1', 'Report1', 'x_member_type', 'member_type', '`member_type`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->member_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['member_type'] =& $this->member_type;
		$this->member_type->DateFilter = "";
		$this->member_type->SqlSelect = "";
		$this->member_type->SqlOrderBy = "";
		$this->member_type->FldGroupByType = "";
		$this->member_type->FldGroupInt = "0";
		$this->member_type->FldGroupSql = "";

		// member_code
		$this->member_code = new crField('Report1', 'Report1', 'x_member_code', 'member_code', '`member_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";
		$this->member_code->FldGroupByType = "";
		$this->member_code->FldGroupInt = "0";
		$this->member_code->FldGroupSql = "";

		// id_code
		$this->id_code = new crField('Report1', 'Report1', 'x_id_code', 'id_code', '`id_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['id_code'] =& $this->id_code;
		$this->id_code->DateFilter = "";
		$this->id_code->SqlSelect = "";
		$this->id_code->SqlOrderBy = "";
		$this->id_code->FldGroupByType = "";
		$this->id_code->FldGroupInt = "0";
		$this->id_code->FldGroupSql = "";

		// gender
		$this->gender = new crField('Report1', 'Report1', 'x_gender', 'gender', '`gender`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['gender'] =& $this->gender;
		$this->gender->DateFilter = "";
		$this->gender->SqlSelect = "";
		$this->gender->SqlOrderBy = "";
		$this->gender->FldGroupByType = "";
		$this->gender->FldGroupInt = "0";
		$this->gender->FldGroupSql = "";

		// prefix
		$this->prefix = new crField('Report1', 'Report1', 'x_prefix', 'prefix', '`prefix`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['prefix'] =& $this->prefix;
		$this->prefix->DateFilter = "";
		$this->prefix->SqlSelect = "";
		$this->prefix->SqlOrderBy = "";
		$this->prefix->FldGroupByType = "";
		$this->prefix->FldGroupInt = "0";
		$this->prefix->FldGroupSql = "";

		// fname
		$this->fname = new crField('Report1', 'Report1', 'x_fname', 'fname', '`fname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";
		$this->fname->FldGroupByType = "";
		$this->fname->FldGroupInt = "0";
		$this->fname->FldGroupSql = "";

		// lname
		$this->lname = new crField('Report1', 'Report1', 'x_lname', 'lname', '`lname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";
		$this->lname->FldGroupByType = "";
		$this->lname->FldGroupInt = "0";
		$this->lname->FldGroupSql = "";

		// birthdate
		$this->birthdate = new crField('Report1', 'Report1', 'x_birthdate', 'birthdate', '`birthdate`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->birthdate->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['birthdate'] =& $this->birthdate;
		$this->birthdate->DateFilter = "";
		$this->birthdate->SqlSelect = "";
		$this->birthdate->SqlOrderBy = "";
		$this->birthdate->FldGroupByType = "";
		$this->birthdate->FldGroupInt = "0";
		$this->birthdate->FldGroupSql = "";

		// age
		$this->age = new crField('Report1', 'Report1', 'x_age', 'age', '`age`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;
		$this->age->DateFilter = "";
		$this->age->SqlSelect = "";
		$this->age->SqlOrderBy = "";
		$this->age->FldGroupByType = "";
		$this->age->FldGroupInt = "0";
		$this->age->FldGroupSql = "";

		// email
		$this->zemail = new crField('Report1', 'Report1', 'x_zemail', 'email', '`email`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['zemail'] =& $this->zemail;
		$this->zemail->DateFilter = "";
		$this->zemail->SqlSelect = "";
		$this->zemail->SqlOrderBy = "";
		$this->zemail->FldGroupByType = "";
		$this->zemail->FldGroupInt = "0";
		$this->zemail->FldGroupSql = "";

		// phone
		$this->phone = new crField('Report1', 'Report1', 'x_phone', 'phone', '`phone`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['phone'] =& $this->phone;
		$this->phone->DateFilter = "";
		$this->phone->SqlSelect = "";
		$this->phone->SqlOrderBy = "";
		$this->phone->FldGroupByType = "";
		$this->phone->FldGroupInt = "0";
		$this->phone->FldGroupSql = "";

		// address
		$this->address = new crField('Report1', 'Report1', 'x_address', 'address', '`address`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['address'] =& $this->address;
		$this->address->DateFilter = "";
		$this->address->SqlSelect = "";
		$this->address->SqlOrderBy = "";
		$this->address->FldGroupByType = "";
		$this->address->FldGroupInt = "0";
		$this->address->FldGroupSql = "";

		// t_code
		$this->t_code = new crField('Report1', 'Report1', 'x_t_code', 't_code', '`t_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";
		$this->t_code->FldGroupByType = "";
		$this->t_code->FldGroupInt = "0";
		$this->t_code->FldGroupSql = "";

		// village_id
		$this->village_id = new crField('Report1', 'Report1', 'x_village_id', 'village_id', '`village_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";
		$this->village_id->FldGroupByType = "";
		$this->village_id->FldGroupInt = "0";
		$this->village_id->FldGroupSql = "";

		// suffix
		$this->suffix = new crField('Report1', 'Report1', 'x_suffix', 'suffix', '`suffix`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['suffix'] =& $this->suffix;
		$this->suffix->DateFilter = "";
		$this->suffix->SqlSelect = "";
		$this->suffix->SqlOrderBy = "";
		$this->suffix->FldGroupByType = "";
		$this->suffix->FldGroupInt = "0";
		$this->suffix->FldGroupSql = "";

		// bnfc1_name
		$this->bnfc1_name = new crField('Report1', 'Report1', 'x_bnfc1_name', 'bnfc1_name', '`bnfc1_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_name'] =& $this->bnfc1_name;
		$this->bnfc1_name->DateFilter = "";
		$this->bnfc1_name->SqlSelect = "";
		$this->bnfc1_name->SqlOrderBy = "";
		$this->bnfc1_name->FldGroupByType = "";
		$this->bnfc1_name->FldGroupInt = "0";
		$this->bnfc1_name->FldGroupSql = "";

		// bnfc1_rel
		$this->bnfc1_rel = new crField('Report1', 'Report1', 'x_bnfc1_rel', 'bnfc1_rel', '`bnfc1_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_rel'] =& $this->bnfc1_rel;
		$this->bnfc1_rel->DateFilter = "";
		$this->bnfc1_rel->SqlSelect = "";
		$this->bnfc1_rel->SqlOrderBy = "";
		$this->bnfc1_rel->FldGroupByType = "";
		$this->bnfc1_rel->FldGroupInt = "0";
		$this->bnfc1_rel->FldGroupSql = "";

		// bnfc2_name
		$this->bnfc2_name = new crField('Report1', 'Report1', 'x_bnfc2_name', 'bnfc2_name', '`bnfc2_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_name'] =& $this->bnfc2_name;
		$this->bnfc2_name->DateFilter = "";
		$this->bnfc2_name->SqlSelect = "";
		$this->bnfc2_name->SqlOrderBy = "";
		$this->bnfc2_name->FldGroupByType = "";
		$this->bnfc2_name->FldGroupInt = "0";
		$this->bnfc2_name->FldGroupSql = "";

		// bnfc2_rel
		$this->bnfc2_rel = new crField('Report1', 'Report1', 'x_bnfc2_rel', 'bnfc2_rel', '`bnfc2_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_rel'] =& $this->bnfc2_rel;
		$this->bnfc2_rel->DateFilter = "";
		$this->bnfc2_rel->SqlSelect = "";
		$this->bnfc2_rel->SqlOrderBy = "";
		$this->bnfc2_rel->FldGroupByType = "";
		$this->bnfc2_rel->FldGroupInt = "0";
		$this->bnfc2_rel->FldGroupSql = "";

		// bnfc3_name
		$this->bnfc3_name = new crField('Report1', 'Report1', 'x_bnfc3_name', 'bnfc3_name', '`bnfc3_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_name'] =& $this->bnfc3_name;
		$this->bnfc3_name->DateFilter = "";
		$this->bnfc3_name->SqlSelect = "";
		$this->bnfc3_name->SqlOrderBy = "";
		$this->bnfc3_name->FldGroupByType = "";
		$this->bnfc3_name->FldGroupInt = "0";
		$this->bnfc3_name->FldGroupSql = "";

		// bnfc3_rel
		$this->bnfc3_rel = new crField('Report1', 'Report1', 'x_bnfc3_rel', 'bnfc3_rel', '`bnfc3_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_rel'] =& $this->bnfc3_rel;
		$this->bnfc3_rel->DateFilter = "";
		$this->bnfc3_rel->SqlSelect = "";
		$this->bnfc3_rel->SqlOrderBy = "";
		$this->bnfc3_rel->FldGroupByType = "";
		$this->bnfc3_rel->FldGroupInt = "0";
		$this->bnfc3_rel->FldGroupSql = "";

		// bnfc4_name
		$this->bnfc4_name = new crField('Report1', 'Report1', 'x_bnfc4_name', 'bnfc4_name', '`bnfc4_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc4_name'] =& $this->bnfc4_name;
		$this->bnfc4_name->DateFilter = "";
		$this->bnfc4_name->SqlSelect = "";
		$this->bnfc4_name->SqlOrderBy = "";
		$this->bnfc4_name->FldGroupByType = "";
		$this->bnfc4_name->FldGroupInt = "0";
		$this->bnfc4_name->FldGroupSql = "";

		// bnfc4_rel
		$this->bnfc4_rel = new crField('Report1', 'Report1', 'x_bnfc4_rel', 'bnfc4_rel', '`bnfc4_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc4_rel'] =& $this->bnfc4_rel;
		$this->bnfc4_rel->DateFilter = "";
		$this->bnfc4_rel->SqlSelect = "";
		$this->bnfc4_rel->SqlOrderBy = "";
		$this->bnfc4_rel->FldGroupByType = "";
		$this->bnfc4_rel->FldGroupInt = "0";
		$this->bnfc4_rel->FldGroupSql = "";

		// attachment
		$this->attachment = new crField('Report1', 'Report1', 'x_attachment', 'attachment', '`attachment`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['attachment'] =& $this->attachment;
		$this->attachment->DateFilter = "";
		$this->attachment->SqlSelect = "";
		$this->attachment->SqlOrderBy = "";
		$this->attachment->FldGroupByType = "";
		$this->attachment->FldGroupInt = "0";
		$this->attachment->FldGroupSql = "";

		// regis_date
		$this->regis_date = new crField('Report1', 'Report1', 'x_regis_date', 'regis_date', '`regis_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->regis_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['regis_date'] =& $this->regis_date;
		$this->regis_date->DateFilter = "Year";
		$this->regis_date->SqlSelect = "SELECT DISTINCT `regis_date` FROM " . $this->SqlFrom();
		$this->regis_date->SqlOrderBy = "`regis_date`";
		$this->regis_date->FldGroupByType = "";
		$this->regis_date->FldGroupInt = "0";
		$this->regis_date->FldGroupSql = "";

		// effective_date
		$this->effective_date = new crField('Report1', 'Report1', 'x_effective_date', 'effective_date', '`effective_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->effective_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['effective_date'] =& $this->effective_date;
		$this->effective_date->DateFilter = "Month";
		$this->effective_date->SqlSelect = "SELECT DISTINCT `effective_date` FROM " . $this->SqlFrom();
		$this->effective_date->SqlOrderBy = "`effective_date`";
		$this->effective_date->FldGroupByType = "";
		$this->effective_date->FldGroupInt = "0";
		$this->effective_date->FldGroupSql = "";
		$this->effective_date->AdvancedFilters = array(); // Popup filter for effective_date
		$this->effective_date->AdvancedFilters[0][0] = "@@1";
		$this->effective_date->AdvancedFilters[0][1] = $ReportLanguage->Phrase("Yesterday");
		$this->effective_date->AdvancedFilters[0][2] = ewrpt_IsYesterday(); // Return sql part
		$this->effective_date->AdvancedFilters[1][0] = "@@2";
		$this->effective_date->AdvancedFilters[1][1] = $ReportLanguage->Phrase("Today");
		$this->effective_date->AdvancedFilters[1][2] = ewrpt_IsToday(); // Return sql part
		$this->effective_date->AdvancedFilters[2][0] = "@@3";
		$this->effective_date->AdvancedFilters[2][1] = $ReportLanguage->Phrase("Tomorrow");
		$this->effective_date->AdvancedFilters[2][2] = ewrpt_IsTomorrow(); // Return sql part

		// resign_date
		$this->resign_date = new crField('Report1', 'Report1', 'x_resign_date', 'resign_date', '`resign_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->resign_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['resign_date'] =& $this->resign_date;
		$this->resign_date->DateFilter = "Day";
		$this->resign_date->SqlSelect = "SELECT DISTINCT `resign_date` FROM " . $this->SqlFrom();
		$this->resign_date->SqlOrderBy = "`resign_date`";
		$this->resign_date->FldGroupByType = "";
		$this->resign_date->FldGroupInt = "0";
		$this->resign_date->FldGroupSql = "";
		$this->resign_date->AdvancedFilters = array(); // Popup filter for resign_date
		$this->resign_date->AdvancedFilters[0][0] = "@@1";
		$this->resign_date->AdvancedFilters[0][1] = $ReportLanguage->Phrase("Last30Days");
		$this->resign_date->AdvancedFilters[0][2] = ewrpt_IsLast30Days(); // Return sql part
		$this->resign_date->AdvancedFilters[1][0] = "@@2";
		$this->resign_date->AdvancedFilters[1][1] = $ReportLanguage->Phrase("Last14Days");
		$this->resign_date->AdvancedFilters[1][2] = ewrpt_IsLast14Days(); // Return sql part
		$this->resign_date->AdvancedFilters[2][0] = "@@3";
		$this->resign_date->AdvancedFilters[2][1] = $ReportLanguage->Phrase("Last7Days");
		$this->resign_date->AdvancedFilters[2][2] = ewrpt_IsLast7Days(); // Return sql part
		$this->resign_date->AdvancedFilters[3][0] = "@@4";
		$this->resign_date->AdvancedFilters[3][1] = $ReportLanguage->Phrase("Next7Days");
		$this->resign_date->AdvancedFilters[3][2] = ewrpt_IsNext7Days(); // Return sql part
		$this->resign_date->AdvancedFilters[4][0] = "@@5";
		$this->resign_date->AdvancedFilters[4][1] = $ReportLanguage->Phrase("Next14Days");
		$this->resign_date->AdvancedFilters[4][2] = ewrpt_IsNext14Days(); // Return sql part
		$this->resign_date->AdvancedFilters[5][0] = "@@6";
		$this->resign_date->AdvancedFilters[5][1] = $ReportLanguage->Phrase("Next30Days");
		$this->resign_date->AdvancedFilters[5][2] = ewrpt_IsNext30Days(); // Return sql part

		// dead_date
		$this->dead_date = new crField('Report1', 'Report1', 'x_dead_date', 'dead_date', '`dead_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->dead_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['dead_date'] =& $this->dead_date;
		$this->dead_date->DateFilter = "Quarter";
		$this->dead_date->SqlSelect = "SELECT DISTINCT `dead_date` FROM " . $this->SqlFrom();
		$this->dead_date->SqlOrderBy = "`dead_date`";
		$this->dead_date->FldGroupByType = "";
		$this->dead_date->FldGroupInt = "0";
		$this->dead_date->FldGroupSql = "";
		$this->dead_date->AdvancedFilters = array(); // Popup filter for dead_date
		$this->dead_date->AdvancedFilters[0][0] = "@@1";
		$this->dead_date->AdvancedFilters[0][1] = $ReportLanguage->Phrase("LastMonth");
		$this->dead_date->AdvancedFilters[0][2] = ewrpt_IsLastMonth(); // Return sql part
		$this->dead_date->AdvancedFilters[1][0] = "@@2";
		$this->dead_date->AdvancedFilters[1][1] = $ReportLanguage->Phrase("ThisMonth");
		$this->dead_date->AdvancedFilters[1][2] = ewrpt_IsThisMonth(); // Return sql part
		$this->dead_date->AdvancedFilters[2][0] = "@@3";
		$this->dead_date->AdvancedFilters[2][1] = $ReportLanguage->Phrase("NextMonth");
		$this->dead_date->AdvancedFilters[2][2] = ewrpt_IsNextMonth(); // Return sql part

		// terminate_date
		$this->terminate_date = new crField('Report1', 'Report1', 'x_terminate_date', 'terminate_date', '`terminate_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->terminate_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['terminate_date'] =& $this->terminate_date;
		$this->terminate_date->DateFilter = "";
		$this->terminate_date->SqlSelect = "SELECT DISTINCT `terminate_date` FROM " . $this->SqlFrom();
		$this->terminate_date->SqlOrderBy = "`terminate_date`";
		$this->terminate_date->FldGroupByType = "";
		$this->terminate_date->FldGroupInt = "0";
		$this->terminate_date->FldGroupSql = "";
		$this->terminate_date->AdvancedFilters = array(); // Popup filter for terminate_date
		$this->terminate_date->AdvancedFilters[0][0] = "@@1";
		$this->terminate_date->AdvancedFilters[0][1] = $ReportLanguage->Phrase("LastTwoWeeks");
		$this->terminate_date->AdvancedFilters[0][2] = ewrpt_IsLast2Weeks(); // Return sql part
		$this->terminate_date->AdvancedFilters[1][0] = "@@2";
		$this->terminate_date->AdvancedFilters[1][1] = $ReportLanguage->Phrase("LastWeek");
		$this->terminate_date->AdvancedFilters[1][2] = ewrpt_IsLastWeek(); // Return sql part
		$this->terminate_date->AdvancedFilters[2][0] = "@@3";
		$this->terminate_date->AdvancedFilters[2][1] = $ReportLanguage->Phrase("ThisWeek");
		$this->terminate_date->AdvancedFilters[2][2] = ewrpt_IsThisWeek(); // Return sql part
		$this->terminate_date->AdvancedFilters[3][0] = "@@4";
		$this->terminate_date->AdvancedFilters[3][1] = $ReportLanguage->Phrase("NextWeek");
		$this->terminate_date->AdvancedFilters[3][2] = ewrpt_IsNextWeek(); // Return sql part
		$this->terminate_date->AdvancedFilters[4][0] = "@@5";
		$this->terminate_date->AdvancedFilters[4][1] = $ReportLanguage->Phrase("NextTwoWeeks");
		$this->terminate_date->AdvancedFilters[4][2] = ewrpt_IsNext2Weeks(); // Return sql part

		// member_status
		$this->member_status = new crField('Report1', 'Report1', 'x_member_status', 'member_status', '`member_status`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_status'] =& $this->member_status;
		$this->member_status->DateFilter = "";
		$this->member_status->SqlSelect = "SELECT DISTINCT `member_status` FROM " . $this->SqlFrom();
		$this->member_status->SqlOrderBy = "`member_status`";
		$this->member_status->FldGroupByType = "";
		$this->member_status->FldGroupInt = "0";
		$this->member_status->FldGroupSql = "";

		// advance_budget
		$this->advance_budget = new crField('Report1', 'Report1', 'x_advance_budget', 'advance_budget', '`advance_budget`', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->advance_budget->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['advance_budget'] =& $this->advance_budget;
		$this->advance_budget->DateFilter = "";
		$this->advance_budget->SqlSelect = "";
		$this->advance_budget->SqlOrderBy = "";
		$this->advance_budget->FldGroupByType = "";
		$this->advance_budget->FldGroupInt = "0";
		$this->advance_budget->FldGroupSql = "";

		// dead_id
		$this->dead_id = new crField('Report1', 'Report1', 'x_dead_id', 'dead_id', '`dead_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->dead_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['dead_id'] =& $this->dead_id;
		$this->dead_id->DateFilter = "";
		$this->dead_id->SqlSelect = "";
		$this->dead_id->SqlOrderBy = "";
		$this->dead_id->FldGroupByType = "";
		$this->dead_id->FldGroupInt = "0";
		$this->dead_id->FldGroupSql = "";

		// note
		$this->note = new crField('Report1', 'Report1', 'x_note', 'note', '`note`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['note'] =& $this->note;
		$this->note->DateFilter = "";
		$this->note->SqlSelect = "";
		$this->note->SqlOrderBy = "";
		$this->note->FldGroupByType = "";
		$this->note->FldGroupInt = "0";
		$this->note->FldGroupSql = "";

		// update_detail
		$this->update_detail = new crField('Report1', 'Report1', 'x_update_detail', 'update_detail', '`update_detail`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['update_detail'] =& $this->update_detail;
		$this->update_detail->DateFilter = "";
		$this->update_detail->SqlSelect = "";
		$this->update_detail->SqlOrderBy = "";
		$this->update_detail->FldGroupByType = "";
		$this->update_detail->FldGroupInt = "0";
		$this->update_detail->FldGroupSql = "";
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

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "";
	}

	function SqlSelectAgg() {
		return "SELECT SUM(`member_id`) AS sum_member_id FROM " . $this->SqlFrom();
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
$Report1_summary = new crReport1_summary();
$Page =& $Report1_summary;

// Page init
$Report1_summary->Page_Init();

// Page main
$Report1_summary->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($Report1->Export == "") { ?>
<script type="text/javascript">

// Create page object
var Report1_summary = new ewrpt_Page("Report1_summary");

// page properties
Report1_summary.PageID = "summary"; // page ID
Report1_summary.FormID = "fReport1summaryfilter"; // form ID
var EWRPT_PAGE_ID = Report1_summary.PageID;

// extend page with ValidateForm function
Report1_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
Report1_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
Report1_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
Report1_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $Report1_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $Report1_summary->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php if ($Report1->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($Report1->regis_date, $Report1->regis_date->FldType); ?>
ewrpt_CreatePopup("Report1_regis_date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Report1->effective_date, $Report1->effective_date->FldType); ?>
ewrpt_CreatePopup("Report1_effective_date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Report1->resign_date, $Report1->resign_date->FldType); ?>
ewrpt_CreatePopup("Report1_resign_date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Report1->dead_date, $Report1->dead_date->FldType); ?>
ewrpt_CreatePopup("Report1_dead_date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Report1->terminate_date, $Report1->terminate_date->FldType); ?>
ewrpt_CreatePopup("Report1_terminate_date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($Report1->member_status, $Report1->member_status->FldType); ?>
ewrpt_CreatePopup("Report1_member_status", [<?php echo $jsdata ?>]);
</script>
<div id="Report1_regis_date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Report1_effective_date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Report1_resign_date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Report1_dead_date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Report1_terminate_date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="Report1_member_status_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<?php } ?>
<?php if ($Report1->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php echo $Report1->TableCaption() ?>
<?php if ($Report1->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $Report1_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
<?php if ($Report1_summary->FilterApplied) { ?>
&nbsp;&nbsp;<a href="Report1smry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a>
<?php } ?>
<?php } ?>
<br /><br />
<?php if ($Report1->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($Report1->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($Report1->Export == "") { ?>
<?php
if ($Report1->FilterPanelOption == 2 || ($Report1->FilterPanelOption == 3 && $Report1_summary->FilterApplied) || $Report1_summary->Filter == "0=101") {
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
<form name="fReport1summaryfilter" id="fReport1summaryfilter" action="Report1smry.php" class="ewForm" onsubmit="return Report1_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $Report1->t_code->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_t_code" id="sv_t_code"<?php echo ($Report1_summary->ClearExtFilter == 'Report1_t_code') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Report1->t_code->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($Report1->t_code->CustomFilters) ? count($Report1->t_code->CustomFilters) : 0;
$cntd = is_array($Report1->t_code->DropDownList) ? count($Report1->t_code->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Report1->t_code->CustomFilters[$i]->FldName == 't_code') {
?>
		<option value="<?php echo "@@" . $Report1->t_code->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Report1->t_code->DropDownValue, "@@" . $Report1->t_code->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Report1->t_code->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Report1->t_code->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Report1->t_code->DropDownValue, $Report1->t_code->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Report1->t_code->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $Report1->dead_id->FldCaption() ?></span></td>
		<td></td>
		<td colspan="4"><span class="ewRptSearchOpr">
		<select name="sv_dead_id" id="sv_dead_id"<?php echo ($Report1_summary->ClearExtFilter == 'Report1_dead_id') ? " class=\"ewInputCleared\"" : "" ?>>
		<option value="<?php echo EWRPT_ALL_VALUE; ?>"<?php if (ewrpt_MatchedFilterValue($Report1->dead_id->DropDownValue, EWRPT_ALL_VALUE)) echo " selected=\"selected\""; ?>><?php echo $ReportLanguage->Phrase("PleaseSelect"); ?></option>
<?php

// Popup filter
$cntf = is_array($Report1->dead_id->CustomFilters) ? count($Report1->dead_id->CustomFilters) : 0;
$cntd = is_array($Report1->dead_id->DropDownList) ? count($Report1->dead_id->DropDownList) : 0;
$totcnt = $cntf + $cntd;
$wrkcnt = 0;
	for ($i = 0; $i < $cntf; $i++) {
		if ($Report1->dead_id->CustomFilters[$i]->FldName == 'dead_id') {
?>
		<option value="<?php echo "@@" . $Report1->dead_id->CustomFilters[$i]->FilterName ?>"<?php if (ewrpt_MatchedFilterValue($Report1->dead_id->DropDownValue, "@@" . $Report1->dead_id->CustomFilters[$i]->FilterName)) echo " selected=\"selected\"" ?>><?php echo $Report1->dead_id->CustomFilters[$i]->DisplayName ?></option>
<?php
		}
		$wrkcnt += 1;
	}

//}
	for ($i = 0; $i < $cntd; $i++) {
?>
		<option value="<?php echo $Report1->dead_id->DropDownList[$i] ?>"<?php if (ewrpt_MatchedFilterValue($Report1->dead_id->DropDownValue, $Report1->dead_id->DropDownList[$i])) echo " selected=\"selected\"" ?>><?php echo ewrpt_DropDownDisplayValue($Report1->dead_id->DropDownList[$i], "", 0) ?></option>
<?php
		$wrkcnt += 1;
	}

//}
?>
		</select>
		</span></td>
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
<?php if ($Report1->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $Report1_summary->ShowFilterList() ?>
</div>
<br />
<?php } ?>
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($Report1->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="Report1smry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Report1_summary->StartGrp, $Report1_summary->DisplayGrps, $Report1_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Report1smry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Report1smry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Report1smry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Report1smry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Report1_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Report1_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Report1_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Report1_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Report1_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Report1_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Report1_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Report1_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Report1_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Report1_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Report1->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($Report1->ExportAll && $Report1->Export <> "") {
	$Report1_summary->StopGrp = $Report1_summary->TotalGrps;
} else {
	$Report1_summary->StopGrp = $Report1_summary->StartGrp + $Report1_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($Report1_summary->StopGrp) > intval($Report1_summary->TotalGrps))
	$Report1_summary->StopGrp = $Report1_summary->TotalGrps;
$Report1_summary->RecCount = 0;

// Get first row
if ($Report1_summary->TotalGrps > 0) {
	$Report1_summary->GetRow(1);
	$Report1_summary->GrpCount = 1;
}
while (($rs && !$rs->EOF && $Report1_summary->GrpCount <= $Report1_summary->DisplayGrps) || $Report1_summary->ShowFirstHeader) {

	// Show header
	if ($Report1_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
		<td style="vertical-align: bottom;" class="ewTableHeader">&nbsp;</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->member_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->member_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->member_id) ?>',1);"><?php echo $Report1->member_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->member_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->member_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->member_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->member_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->member_code) ?>',1);"><?php echo $Report1->member_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->member_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->member_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->id_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->id_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->id_code) ?>',1);"><?php echo $Report1->id_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->id_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->id_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->gender) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->gender->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->gender) ?>',1);"><?php echo $Report1->gender->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->gender->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->gender->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->prefix) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->prefix->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->prefix) ?>',1);"><?php echo $Report1->prefix->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->prefix->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->prefix->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->fname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->fname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->fname) ?>',1);"><?php echo $Report1->fname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->fname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->fname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->lname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->lname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->lname) ?>',1);"><?php echo $Report1->lname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->lname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->lname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->birthdate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->birthdate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->birthdate) ?>',1);"><?php echo $Report1->birthdate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->birthdate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->birthdate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->age) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->age) ?>',1);"><?php echo $Report1->age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->phone) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->phone->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->phone) ?>',1);"><?php echo $Report1->phone->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->phone->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->phone->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->address) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->address->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->address) ?>',1);"><?php echo $Report1->address->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->address->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->address->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->t_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->t_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->t_code) ?>',1);"><?php echo $Report1->t_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->t_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->t_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->bnfc1_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->bnfc1_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->bnfc1_name) ?>',1);"><?php echo $Report1->bnfc1_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->bnfc1_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->bnfc1_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->bnfc1_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->bnfc1_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->bnfc1_rel) ?>',1);"><?php echo $Report1->bnfc1_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->bnfc1_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->bnfc1_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->bnfc2_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->bnfc2_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->bnfc2_name) ?>',1);"><?php echo $Report1->bnfc2_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->bnfc2_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->bnfc2_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->bnfc2_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->bnfc2_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->bnfc2_rel) ?>',1);"><?php echo $Report1->bnfc2_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->bnfc2_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->bnfc2_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->bnfc3_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->bnfc3_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->bnfc3_name) ?>',1);"><?php echo $Report1->bnfc3_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->bnfc3_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->bnfc3_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->bnfc3_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->bnfc3_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->bnfc3_rel) ?>',1);"><?php echo $Report1->bnfc3_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->bnfc3_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->bnfc3_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->regis_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->regis_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->regis_date) ?>',1);"><?php echo $Report1->regis_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->regis_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->regis_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Report1->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Report1_regis_date', true, '<?php echo $Report1->regis_date->RangeFrom; ?>', '<?php echo $Report1->regis_date->RangeTo; ?>');return false;" name="x_regis_date<?php echo $Report1_summary->Cnt[0][0]; ?>" id="x_regis_date<?php echo $Report1_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->effective_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->effective_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->effective_date) ?>',1);"><?php echo $Report1->effective_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->effective_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->effective_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Report1->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Report1_effective_date', false, '<?php echo $Report1->effective_date->RangeFrom; ?>', '<?php echo $Report1->effective_date->RangeTo; ?>');return false;" name="x_effective_date<?php echo $Report1_summary->Cnt[0][0]; ?>" id="x_effective_date<?php echo $Report1_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->resign_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->resign_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->resign_date) ?>',1);"><?php echo $Report1->resign_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->resign_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->resign_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Report1->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Report1_resign_date', false, '<?php echo $Report1->resign_date->RangeFrom; ?>', '<?php echo $Report1->resign_date->RangeTo; ?>');return false;" name="x_resign_date<?php echo $Report1_summary->Cnt[0][0]; ?>" id="x_resign_date<?php echo $Report1_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->dead_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->dead_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->dead_date) ?>',1);"><?php echo $Report1->dead_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->dead_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->dead_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Report1->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Report1_dead_date', false, '<?php echo $Report1->dead_date->RangeFrom; ?>', '<?php echo $Report1->dead_date->RangeTo; ?>');return false;" name="x_dead_date<?php echo $Report1_summary->Cnt[0][0]; ?>" id="x_dead_date<?php echo $Report1_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->terminate_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->terminate_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->terminate_date) ?>',1);"><?php echo $Report1->terminate_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->terminate_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->terminate_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Report1->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Report1_terminate_date', false, '<?php echo $Report1->terminate_date->RangeFrom; ?>', '<?php echo $Report1->terminate_date->RangeTo; ?>');return false;" name="x_terminate_date<?php echo $Report1_summary->Cnt[0][0]; ?>" id="x_terminate_date<?php echo $Report1_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->member_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->member_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->member_status) ?>',1);"><?php echo $Report1->member_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->member_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->member_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($Report1->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'Report1_member_status', false, '<?php echo $Report1->member_status->RangeFrom; ?>', '<?php echo $Report1->member_status->RangeTo; ?>');return false;" name="x_member_status<?php echo $Report1_summary->Cnt[0][0]; ?>" id="x_member_status<?php echo $Report1_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->dead_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->dead_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->dead_id) ?>',1);"><?php echo $Report1->dead_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->dead_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->dead_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($Report1->SortUrl($Report1->note) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $Report1->note->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $Report1->SortUrl($Report1->note) ?>',1);"><?php echo $Report1->note->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($Report1->note->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($Report1->note->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$Report1_summary->ShowFirstHeader = FALSE;
	}
	$Report1_summary->RecCount++;

		// Render detail row
		$Report1->ResetCSS();
		$Report1->RowType = EWRPT_ROWTYPE_DETAIL;
		$Report1_summary->RenderRow();
?>
	<tr<?php echo $Report1->RowAttributes(); ?>>
		<td>&nbsp;</td>
		<td<?php echo $Report1->member_id->CellAttributes() ?>>
<div<?php echo $Report1->member_id->ViewAttributes(); ?>><?php echo $Report1->member_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->member_code->CellAttributes() ?>>
<div<?php echo $Report1->member_code->ViewAttributes(); ?>><?php echo $Report1->member_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->id_code->CellAttributes() ?>>
<div<?php echo $Report1->id_code->ViewAttributes(); ?>><?php echo $Report1->id_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->gender->CellAttributes() ?>>
<div<?php echo $Report1->gender->ViewAttributes(); ?>><?php echo $Report1->gender->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->prefix->CellAttributes() ?>>
<div<?php echo $Report1->prefix->ViewAttributes(); ?>><?php echo $Report1->prefix->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->fname->CellAttributes() ?>>
<div<?php echo $Report1->fname->ViewAttributes(); ?>><?php echo $Report1->fname->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->lname->CellAttributes() ?>>
<div<?php echo $Report1->lname->ViewAttributes(); ?>><?php echo $Report1->lname->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->birthdate->CellAttributes() ?>>
<div<?php echo $Report1->birthdate->ViewAttributes(); ?>><?php echo $Report1->birthdate->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->age->CellAttributes() ?>>
<div<?php echo $Report1->age->ViewAttributes(); ?>><?php echo $Report1->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->phone->CellAttributes() ?>>
<div<?php echo $Report1->phone->ViewAttributes(); ?>><?php echo $Report1->phone->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->address->CellAttributes() ?>>
<div<?php echo $Report1->address->ViewAttributes(); ?>><?php echo $Report1->address->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->t_code->CellAttributes() ?>>
<div<?php echo $Report1->t_code->ViewAttributes(); ?>><?php echo $Report1->t_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->bnfc1_name->CellAttributes() ?>>
<div<?php echo $Report1->bnfc1_name->ViewAttributes(); ?>><?php echo $Report1->bnfc1_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->bnfc1_rel->CellAttributes() ?>>
<div<?php echo $Report1->bnfc1_rel->ViewAttributes(); ?>><?php echo $Report1->bnfc1_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->bnfc2_name->CellAttributes() ?>>
<div<?php echo $Report1->bnfc2_name->ViewAttributes(); ?>><?php echo $Report1->bnfc2_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->bnfc2_rel->CellAttributes() ?>>
<div<?php echo $Report1->bnfc2_rel->ViewAttributes(); ?>><?php echo $Report1->bnfc2_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->bnfc3_name->CellAttributes() ?>>
<div<?php echo $Report1->bnfc3_name->ViewAttributes(); ?>><?php echo $Report1->bnfc3_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->bnfc3_rel->CellAttributes() ?>>
<div<?php echo $Report1->bnfc3_rel->ViewAttributes(); ?>><?php echo $Report1->bnfc3_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->regis_date->CellAttributes() ?>>
<div<?php echo $Report1->regis_date->ViewAttributes(); ?>><?php echo $Report1->regis_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->effective_date->CellAttributes() ?>>
<div<?php echo $Report1->effective_date->ViewAttributes(); ?>><?php echo $Report1->effective_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->resign_date->CellAttributes() ?>>
<div<?php echo $Report1->resign_date->ViewAttributes(); ?>><?php echo $Report1->resign_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->dead_date->CellAttributes() ?>>
<div<?php echo $Report1->dead_date->ViewAttributes(); ?>><?php echo $Report1->dead_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->terminate_date->CellAttributes() ?>>
<div<?php echo $Report1->terminate_date->ViewAttributes(); ?>><?php echo $Report1->terminate_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->member_status->CellAttributes() ?>>
<div<?php echo $Report1->member_status->ViewAttributes(); ?>><?php echo $Report1->member_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->dead_id->CellAttributes() ?>>
<div<?php echo $Report1->dead_id->ViewAttributes(); ?>><?php echo $Report1->dead_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->note->CellAttributes() ?>>
<div<?php echo $Report1->note->ViewAttributes(); ?>><?php echo $Report1->note->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$Report1_summary->AccumulateSummary();

		// Get next record
		$Report1_summary->GetRow(2);
	$Report1_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($Report1_summary->TotalGrps > 0) {
	$Report1->ResetCSS();
	$Report1->RowType = EWRPT_ROWTYPE_TOTAL;
	$Report1->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$Report1->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$Report1->RowAttrs["class"] = "ewRptGrandSummary";
	$Report1_summary->RenderRow();
?>
	<!-- tr><td colspan="27"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $Report1->RowAttributes(); ?>><td colspan="27"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($Report1_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
	$Report1->ResetCSS();
	$Report1->member_id->Count = $Report1_summary->TotCount;
	$Report1->member_id->Summary = $Report1_summary->GrandSmry[1]; // Load SUM
	$Report1->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$Report1->member_id->CurrentValue = $Report1->member_id->Summary;
	$Report1->RowAttrs["class"] = "ewRptGrandSummary";
	$Report1_summary->RenderRow();
?>
	<tr<?php echo $Report1->RowAttributes(); ?>>
		<td colspan="1" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $Report1->member_id->CellAttributes() ?>>
<div<?php echo $Report1->member_id->ViewAttributes(); ?>><?php echo $Report1->member_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $Report1->member_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->id_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->gender->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->prefix->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->fname->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->lname->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->birthdate->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->age->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->phone->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->address->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->t_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->bnfc1_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->bnfc1_rel->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->bnfc2_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->bnfc2_rel->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->bnfc3_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->bnfc3_rel->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->regis_date->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->effective_date->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->resign_date->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->dead_date->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->terminate_date->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->member_status->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->dead_id->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $Report1->note->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($Report1_summary->TotalGrps > 0) { ?>
<?php if ($Report1->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="Report1smry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($Report1_summary->StartGrp, $Report1_summary->DisplayGrps, $Report1_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="Report1smry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="Report1smry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="Report1smry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="Report1smry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($Report1_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($Report1_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($Report1_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($Report1_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($Report1_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($Report1_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($Report1_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($Report1_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($Report1_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($Report1_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($Report1->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($Report1->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($Report1->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($Report1->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $Report1_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($Report1->Export == "") { ?>
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
$Report1_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crReport1_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'Report1';

	// Page object name
	var $PageObjName = 'Report1_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $Report1;
		if ($Report1->UseTokenInUrl) $PageUrl .= "t=" . $Report1->TableVar . "&"; // Add page token
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
		global $Report1;
		if ($Report1->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($Report1->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($Report1->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crReport1_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (Report1)
		$GLOBALS["Report1"] = new crReport1();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'Report1', TRUE);

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
		global $Report1;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$Report1->Export = $_GET["export"];
	}
	$gsExport = $Report1->Export; // Get export parameter, used in header
	$gsExportFile = $Report1->TableVar; // Get export file, used in header
	if ($Report1->Export == "excel") {
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
		global $Report1;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($Report1->Export == "email") {
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
		global $Report1;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 27;
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
		$this->Col = array(FALSE, TRUE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$Report1->regis_date->SelectionList = "";
		$Report1->regis_date->DefaultSelectionList = "";
		$Report1->regis_date->ValueList = "";
		$Report1->effective_date->SelectionList = "";
		$Report1->effective_date->DefaultSelectionList = "";
		$Report1->effective_date->ValueList = "";
		$Report1->resign_date->SelectionList = "";
		$Report1->resign_date->DefaultSelectionList = "";
		$Report1->resign_date->ValueList = "";
		$Report1->dead_date->SelectionList = "";
		$Report1->dead_date->DefaultSelectionList = "";
		$Report1->dead_date->ValueList = "";
		$Report1->terminate_date->SelectionList = "";
		$Report1->terminate_date->DefaultSelectionList = "";
		$Report1->terminate_date->ValueList = "";
		$Report1->member_status->SelectionList = "";
		$Report1->member_status->DefaultSelectionList = "";
		$Report1->member_status->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$Report1->CustomFilters_Load();

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

		// Get total count
		$sSql = ewrpt_BuildReportSql($Report1->SqlSelect(), $Report1->SqlWhere(), $Report1->SqlGroupBy(), $Report1->SqlHaving(), $Report1->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($Report1->ExportAll && $Report1->Export <> "")
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
		global $Report1;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$Report1->member_id->setDbValue($rs->fields('member_id'));
			$Report1->member_type->setDbValue($rs->fields('member_type'));
			$Report1->member_code->setDbValue($rs->fields('member_code'));
			$Report1->id_code->setDbValue($rs->fields('id_code'));
			$Report1->gender->setDbValue($rs->fields('gender'));
			$Report1->prefix->setDbValue($rs->fields('prefix'));
			$Report1->fname->setDbValue($rs->fields('fname'));
			$Report1->lname->setDbValue($rs->fields('lname'));
			$Report1->birthdate->setDbValue($rs->fields('birthdate'));
			$Report1->age->setDbValue($rs->fields('age'));
			$Report1->zemail->setDbValue($rs->fields('email'));
			$Report1->phone->setDbValue($rs->fields('phone'));
			$Report1->address->setDbValue($rs->fields('address'));
			$Report1->t_code->setDbValue($rs->fields('t_code'));
			$Report1->village_id->setDbValue($rs->fields('village_id'));
			$Report1->suffix->setDbValue($rs->fields('suffix'));
			$Report1->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
			$Report1->bnfc1_rel->setDbValue($rs->fields('bnfc1_rel'));
			$Report1->bnfc2_name->setDbValue($rs->fields('bnfc2_name'));
			$Report1->bnfc2_rel->setDbValue($rs->fields('bnfc2_rel'));
			$Report1->bnfc3_name->setDbValue($rs->fields('bnfc3_name'));
			$Report1->bnfc3_rel->setDbValue($rs->fields('bnfc3_rel'));
			$Report1->bnfc4_name->setDbValue($rs->fields('bnfc4_name'));
			$Report1->bnfc4_rel->setDbValue($rs->fields('bnfc4_rel'));
			$Report1->attachment->setDbValue($rs->fields('attachment'));
			$Report1->regis_date->setDbValue($rs->fields('regis_date'));
			$Report1->effective_date->setDbValue($rs->fields('effective_date'));
			$Report1->resign_date->setDbValue($rs->fields('resign_date'));
			$Report1->dead_date->setDbValue($rs->fields('dead_date'));
			$Report1->terminate_date->setDbValue($rs->fields('terminate_date'));
			$Report1->member_status->setDbValue($rs->fields('member_status'));
			$Report1->advance_budget->setDbValue($rs->fields('advance_budget'));
			$Report1->dead_id->setDbValue($rs->fields('dead_id'));
			$Report1->note->setDbValue($rs->fields('note'));
			$Report1->update_detail->setDbValue($rs->fields('update_detail'));
			$this->Val[1] = $Report1->member_id->CurrentValue;
			$this->Val[2] = $Report1->member_code->CurrentValue;
			$this->Val[3] = $Report1->id_code->CurrentValue;
			$this->Val[4] = $Report1->gender->CurrentValue;
			$this->Val[5] = $Report1->prefix->CurrentValue;
			$this->Val[6] = $Report1->fname->CurrentValue;
			$this->Val[7] = $Report1->lname->CurrentValue;
			$this->Val[8] = $Report1->birthdate->CurrentValue;
			$this->Val[9] = $Report1->age->CurrentValue;
			$this->Val[10] = $Report1->phone->CurrentValue;
			$this->Val[11] = $Report1->address->CurrentValue;
			$this->Val[12] = $Report1->t_code->CurrentValue;
			$this->Val[13] = $Report1->bnfc1_name->CurrentValue;
			$this->Val[14] = $Report1->bnfc1_rel->CurrentValue;
			$this->Val[15] = $Report1->bnfc2_name->CurrentValue;
			$this->Val[16] = $Report1->bnfc2_rel->CurrentValue;
			$this->Val[17] = $Report1->bnfc3_name->CurrentValue;
			$this->Val[18] = $Report1->bnfc3_rel->CurrentValue;
			$this->Val[19] = $Report1->regis_date->CurrentValue;
			$this->Val[20] = $Report1->effective_date->CurrentValue;
			$this->Val[21] = $Report1->resign_date->CurrentValue;
			$this->Val[22] = $Report1->dead_date->CurrentValue;
			$this->Val[23] = $Report1->terminate_date->CurrentValue;
			$this->Val[24] = $Report1->member_status->CurrentValue;
			$this->Val[25] = $Report1->dead_id->CurrentValue;
			$this->Val[26] = $Report1->note->CurrentValue;
		} else {
			$Report1->member_id->setDbValue("");
			$Report1->member_type->setDbValue("");
			$Report1->member_code->setDbValue("");
			$Report1->id_code->setDbValue("");
			$Report1->gender->setDbValue("");
			$Report1->prefix->setDbValue("");
			$Report1->fname->setDbValue("");
			$Report1->lname->setDbValue("");
			$Report1->birthdate->setDbValue("");
			$Report1->age->setDbValue("");
			$Report1->zemail->setDbValue("");
			$Report1->phone->setDbValue("");
			$Report1->address->setDbValue("");
			$Report1->t_code->setDbValue("");
			$Report1->village_id->setDbValue("");
			$Report1->suffix->setDbValue("");
			$Report1->bnfc1_name->setDbValue("");
			$Report1->bnfc1_rel->setDbValue("");
			$Report1->bnfc2_name->setDbValue("");
			$Report1->bnfc2_rel->setDbValue("");
			$Report1->bnfc3_name->setDbValue("");
			$Report1->bnfc3_rel->setDbValue("");
			$Report1->bnfc4_name->setDbValue("");
			$Report1->bnfc4_rel->setDbValue("");
			$Report1->attachment->setDbValue("");
			$Report1->regis_date->setDbValue("");
			$Report1->effective_date->setDbValue("");
			$Report1->resign_date->setDbValue("");
			$Report1->dead_date->setDbValue("");
			$Report1->terminate_date->setDbValue("");
			$Report1->member_status->setDbValue("");
			$Report1->advance_budget->setDbValue("");
			$Report1->dead_id->setDbValue("");
			$Report1->note->setDbValue("");
			$Report1->update_detail->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $Report1;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$Report1->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$Report1->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $Report1->getStartGroup();
			}
		} else {
			$this->StartGrp = $Report1->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$Report1->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$Report1->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$Report1->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $Report1;

		// Initialize popup
		// Build distinct values for regis_date

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Report1->regis_date->SqlSelect, $Report1->SqlWhere(), $Report1->SqlGroupBy(), $Report1->SqlHaving(), $Report1->regis_date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Report1->regis_date->setDbValue($rswrk->fields[0]);
			if (is_null($Report1->regis_date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Report1->regis_date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Report1->regis_date->ViewValue = ewrpt_FormatDateTime($Report1->regis_date->CurrentValue, 7);
				ewrpt_SetupDistinctValues($Report1->regis_date->ValueList, $Report1->regis_date->CurrentValue, $Report1->regis_date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Report1->regis_date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Report1->regis_date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for effective_date
		ewrpt_SetupDistinctValuesFromFilter($Report1->effective_date->ValueList, $Report1->effective_date->AdvancedFilters); // Set up popup filter
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Report1->effective_date->SqlSelect, $Report1->SqlWhere(), $Report1->SqlGroupBy(), $Report1->SqlHaving(), $Report1->effective_date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Report1->effective_date->setDbValue($rswrk->fields[0]);
			if (is_null($Report1->effective_date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Report1->effective_date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Report1->effective_date->ViewValue = ewrpt_FormatDateTime($Report1->effective_date->CurrentValue, 7);
				ewrpt_SetupDistinctValues($Report1->effective_date->ValueList, $Report1->effective_date->CurrentValue, $Report1->effective_date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Report1->effective_date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Report1->effective_date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for resign_date
		ewrpt_SetupDistinctValuesFromFilter($Report1->resign_date->ValueList, $Report1->resign_date->AdvancedFilters); // Set up popup filter
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Report1->resign_date->SqlSelect, $Report1->SqlWhere(), $Report1->SqlGroupBy(), $Report1->SqlHaving(), $Report1->resign_date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Report1->resign_date->setDbValue($rswrk->fields[0]);
			if (is_null($Report1->resign_date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Report1->resign_date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Report1->resign_date->ViewValue = ewrpt_FormatDateTime($Report1->resign_date->CurrentValue, 7);
				ewrpt_SetupDistinctValues($Report1->resign_date->ValueList, $Report1->resign_date->CurrentValue, $Report1->resign_date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Report1->resign_date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Report1->resign_date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for dead_date
		ewrpt_SetupDistinctValuesFromFilter($Report1->dead_date->ValueList, $Report1->dead_date->AdvancedFilters); // Set up popup filter
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Report1->dead_date->SqlSelect, $Report1->SqlWhere(), $Report1->SqlGroupBy(), $Report1->SqlHaving(), $Report1->dead_date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Report1->dead_date->setDbValue($rswrk->fields[0]);
			if (is_null($Report1->dead_date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Report1->dead_date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Report1->dead_date->ViewValue = ewrpt_FormatDateTime($Report1->dead_date->CurrentValue, 7);
				ewrpt_SetupDistinctValues($Report1->dead_date->ValueList, $Report1->dead_date->CurrentValue, $Report1->dead_date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Report1->dead_date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Report1->dead_date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for terminate_date
		ewrpt_SetupDistinctValuesFromFilter($Report1->terminate_date->ValueList, $Report1->terminate_date->AdvancedFilters); // Set up popup filter
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Report1->terminate_date->SqlSelect, $Report1->SqlWhere(), $Report1->SqlGroupBy(), $Report1->SqlHaving(), $Report1->terminate_date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Report1->terminate_date->setDbValue($rswrk->fields[0]);
			if (is_null($Report1->terminate_date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Report1->terminate_date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Report1->terminate_date->ViewValue = ewrpt_FormatDateTime($Report1->terminate_date->CurrentValue, 7);
				ewrpt_SetupDistinctValues($Report1->terminate_date->ValueList, $Report1->terminate_date->CurrentValue, $Report1->terminate_date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Report1->terminate_date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Report1->terminate_date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for member_status
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($Report1->member_status->SqlSelect, $Report1->SqlWhere(), $Report1->SqlGroupBy(), $Report1->SqlHaving(), $Report1->member_status->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$Report1->member_status->setDbValue($rswrk->fields[0]);
			if (is_null($Report1->member_status->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($Report1->member_status->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$Report1->member_status->ViewValue = $Report1->member_status->CurrentValue;
				ewrpt_SetupDistinctValues($Report1->member_status->ValueList, $Report1->member_status->CurrentValue, $Report1->member_status->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($Report1->member_status->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($Report1->member_status->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('regis_date');
				$this->ClearSessionSelection('effective_date');
				$this->ClearSessionSelection('resign_date');
				$this->ClearSessionSelection('dead_date');
				$this->ClearSessionSelection('terminate_date');
				$this->ClearSessionSelection('member_status');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get ว.ด.ป.ที่สมัคร selected values

		if (is_array(@$_SESSION["sel_Report1_regis_date"])) {
			$this->LoadSelectionFromSession('regis_date');
		} elseif (@$_SESSION["sel_Report1_regis_date"] == EWRPT_INIT_VALUE) { // Select all
			$Report1->regis_date->SelectionList = "";
		}

		// Get ว.ด.ป.ที่มีผล selected values
		if (is_array(@$_SESSION["sel_Report1_effective_date"])) {
			$this->LoadSelectionFromSession('effective_date');
		} elseif (@$_SESSION["sel_Report1_effective_date"] == EWRPT_INIT_VALUE) { // Select all
			$Report1->effective_date->SelectionList = "";
		}

		// Get ว.ด.ป. ที่ลาออก selected values
		if (is_array(@$_SESSION["sel_Report1_resign_date"])) {
			$this->LoadSelectionFromSession('resign_date');
		} elseif (@$_SESSION["sel_Report1_resign_date"] == EWRPT_INIT_VALUE) { // Select all
			$Report1->resign_date->SelectionList = "";
		}

		// Get ว.ด.ป. ที่เสียชีวิต selected values
		if (is_array(@$_SESSION["sel_Report1_dead_date"])) {
			$this->LoadSelectionFromSession('dead_date');
		} elseif (@$_SESSION["sel_Report1_dead_date"] == EWRPT_INIT_VALUE) { // Select all
			$Report1->dead_date->SelectionList = "";
		}

		// Get ว.ด.ป. ที่พ้นสภาพ selected values
		if (is_array(@$_SESSION["sel_Report1_terminate_date"])) {
			$this->LoadSelectionFromSession('terminate_date');
		} elseif (@$_SESSION["sel_Report1_terminate_date"] == EWRPT_INIT_VALUE) { // Select all
			$Report1->terminate_date->SelectionList = "";
		}

		// Get สถานะ selected values
		if (is_array(@$_SESSION["sel_Report1_member_status"])) {
			$this->LoadSelectionFromSession('member_status');
		} elseif (@$_SESSION["sel_Report1_member_status"] == EWRPT_INIT_VALUE) { // Select all
			$Report1->member_status->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $Report1;
		$this->StartGrp = 1;
		$Report1->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $Report1;
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
			$Report1->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$Report1->setStartGroup($this->StartGrp);
		} else {
			if ($Report1->getGroupPerPage() <> "") {
				$this->DisplayGrps = $Report1->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $Report1;
		if ($Report1->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($Report1->SqlSelectCount(), $Report1->SqlWhere(), $Report1->SqlGroupBy(), $Report1->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}

			// Get total from sql directly
			$sSql = ewrpt_BuildReportSql($Report1->SqlSelectAgg(), $Report1->SqlWhere(), $Report1->SqlGroupBy(), $Report1->SqlHaving(), "", $this->Filter, "");
			$sSql = $Report1->SqlAggPfx() . $sSql . $Report1->SqlAggSfx();
			$rsagg = $conn->Execute($sSql);
			if ($rsagg) {
				$this->GrandSmry[1] = $rsagg->fields("sum_member_id");
				$rsagg->Close();
			} else {

				// Accumulate grand summary from detail records
				$sSql = ewrpt_BuildReportSql($Report1->SqlSelect(), $Report1->SqlWhere(), $Report1->SqlGroupBy(), $Report1->SqlHaving(), "", $this->Filter, "");
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
		$Report1->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($Report1->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// member_id
			$Report1->member_id->ViewValue = $Report1->member_id->Summary;

			// member_code
			$Report1->member_code->ViewValue = $Report1->member_code->Summary;

			// id_code
			$Report1->id_code->ViewValue = $Report1->id_code->Summary;

			// gender
			$Report1->gender->ViewValue = $Report1->gender->Summary;

			// prefix
			$Report1->prefix->ViewValue = $Report1->prefix->Summary;

			// fname
			$Report1->fname->ViewValue = $Report1->fname->Summary;

			// lname
			$Report1->lname->ViewValue = $Report1->lname->Summary;

			// birthdate
			$Report1->birthdate->ViewValue = $Report1->birthdate->Summary;
			$Report1->birthdate->ViewValue = ewrpt_FormatDateTime($Report1->birthdate->ViewValue, 7);

			// age
			$Report1->age->ViewValue = $Report1->age->Summary;

			// phone
			$Report1->phone->ViewValue = $Report1->phone->Summary;

			// address
			$Report1->address->ViewValue = $Report1->address->Summary;

			// t_code
			$Report1->t_code->ViewValue = $Report1->t_code->Summary;

			// bnfc1_name
			$Report1->bnfc1_name->ViewValue = $Report1->bnfc1_name->Summary;

			// bnfc1_rel
			$Report1->bnfc1_rel->ViewValue = $Report1->bnfc1_rel->Summary;

			// bnfc2_name
			$Report1->bnfc2_name->ViewValue = $Report1->bnfc2_name->Summary;

			// bnfc2_rel
			$Report1->bnfc2_rel->ViewValue = $Report1->bnfc2_rel->Summary;

			// bnfc3_name
			$Report1->bnfc3_name->ViewValue = $Report1->bnfc3_name->Summary;

			// bnfc3_rel
			$Report1->bnfc3_rel->ViewValue = $Report1->bnfc3_rel->Summary;

			// regis_date
			$Report1->regis_date->ViewValue = $Report1->regis_date->Summary;
			$Report1->regis_date->ViewValue = ewrpt_FormatDateTime($Report1->regis_date->ViewValue, 7);

			// effective_date
			$Report1->effective_date->ViewValue = $Report1->effective_date->Summary;
			$Report1->effective_date->ViewValue = ewrpt_FormatDateTime($Report1->effective_date->ViewValue, 7);

			// resign_date
			$Report1->resign_date->ViewValue = $Report1->resign_date->Summary;
			$Report1->resign_date->ViewValue = ewrpt_FormatDateTime($Report1->resign_date->ViewValue, 7);

			// dead_date
			$Report1->dead_date->ViewValue = $Report1->dead_date->Summary;
			$Report1->dead_date->ViewValue = ewrpt_FormatDateTime($Report1->dead_date->ViewValue, 7);

			// terminate_date
			$Report1->terminate_date->ViewValue = $Report1->terminate_date->Summary;
			$Report1->terminate_date->ViewValue = ewrpt_FormatDateTime($Report1->terminate_date->ViewValue, 7);

			// member_status
			$Report1->member_status->ViewValue = $Report1->member_status->Summary;

			// dead_id
			$Report1->dead_id->ViewValue = $Report1->dead_id->Summary;

			// note
			$Report1->note->ViewValue = $Report1->note->Summary;
		} else {

			// member_id
			$Report1->member_id->ViewValue = $Report1->member_id->CurrentValue;
			$Report1->member_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_code
			$Report1->member_code->ViewValue = $Report1->member_code->CurrentValue;
			$Report1->member_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// id_code
			$Report1->id_code->ViewValue = $Report1->id_code->CurrentValue;
			$Report1->id_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// gender
			$Report1->gender->ViewValue = $Report1->gender->CurrentValue;
			$Report1->gender->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// prefix
			$Report1->prefix->ViewValue = $Report1->prefix->CurrentValue;
			$Report1->prefix->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$Report1->fname->ViewValue = $Report1->fname->CurrentValue;
			$Report1->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$Report1->lname->ViewValue = $Report1->lname->CurrentValue;
			$Report1->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// birthdate
			$Report1->birthdate->ViewValue = $Report1->birthdate->CurrentValue;
			$Report1->birthdate->ViewValue = ewrpt_FormatDateTime($Report1->birthdate->ViewValue, 7);
			$Report1->birthdate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// age
			$Report1->age->ViewValue = $Report1->age->CurrentValue;
			$Report1->age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// phone
			$Report1->phone->ViewValue = $Report1->phone->CurrentValue;
			$Report1->phone->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// address
			$Report1->address->ViewValue = $Report1->address->CurrentValue;
			$Report1->address->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_code
			$Report1->t_code->ViewValue = $Report1->t_code->CurrentValue;
			$Report1->t_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc1_name
			$Report1->bnfc1_name->ViewValue = $Report1->bnfc1_name->CurrentValue;
			$Report1->bnfc1_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc1_rel
			$Report1->bnfc1_rel->ViewValue = $Report1->bnfc1_rel->CurrentValue;
			$Report1->bnfc1_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_name
			$Report1->bnfc2_name->ViewValue = $Report1->bnfc2_name->CurrentValue;
			$Report1->bnfc2_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_rel
			$Report1->bnfc2_rel->ViewValue = $Report1->bnfc2_rel->CurrentValue;
			$Report1->bnfc2_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_name
			$Report1->bnfc3_name->ViewValue = $Report1->bnfc3_name->CurrentValue;
			$Report1->bnfc3_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_rel
			$Report1->bnfc3_rel->ViewValue = $Report1->bnfc3_rel->CurrentValue;
			$Report1->bnfc3_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// regis_date
			$Report1->regis_date->ViewValue = $Report1->regis_date->CurrentValue;
			$Report1->regis_date->ViewValue = ewrpt_FormatDateTime($Report1->regis_date->ViewValue, 7);
			$Report1->regis_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// effective_date
			$Report1->effective_date->ViewValue = $Report1->effective_date->CurrentValue;
			$Report1->effective_date->ViewValue = ewrpt_FormatDateTime($Report1->effective_date->ViewValue, 7);
			$Report1->effective_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// resign_date
			$Report1->resign_date->ViewValue = $Report1->resign_date->CurrentValue;
			$Report1->resign_date->ViewValue = ewrpt_FormatDateTime($Report1->resign_date->ViewValue, 7);
			$Report1->resign_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_date
			$Report1->dead_date->ViewValue = $Report1->dead_date->CurrentValue;
			$Report1->dead_date->ViewValue = ewrpt_FormatDateTime($Report1->dead_date->ViewValue, 7);
			$Report1->dead_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// terminate_date
			$Report1->terminate_date->ViewValue = $Report1->terminate_date->CurrentValue;
			$Report1->terminate_date->ViewValue = ewrpt_FormatDateTime($Report1->terminate_date->ViewValue, 7);
			$Report1->terminate_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_status
			$Report1->member_status->ViewValue = $Report1->member_status->CurrentValue;
			$Report1->member_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_id
			$Report1->dead_id->ViewValue = $Report1->dead_id->CurrentValue;
			$Report1->dead_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// note
			$Report1->note->ViewValue = $Report1->note->CurrentValue;
			$Report1->note->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// member_id
		$Report1->member_id->HrefValue = "";

		// member_code
		$Report1->member_code->HrefValue = "";

		// id_code
		$Report1->id_code->HrefValue = "";

		// gender
		$Report1->gender->HrefValue = "";

		// prefix
		$Report1->prefix->HrefValue = "";

		// fname
		$Report1->fname->HrefValue = "";

		// lname
		$Report1->lname->HrefValue = "";

		// birthdate
		$Report1->birthdate->HrefValue = "";

		// age
		$Report1->age->HrefValue = "";

		// phone
		$Report1->phone->HrefValue = "";

		// address
		$Report1->address->HrefValue = "";

		// t_code
		$Report1->t_code->HrefValue = "";

		// bnfc1_name
		$Report1->bnfc1_name->HrefValue = "";

		// bnfc1_rel
		$Report1->bnfc1_rel->HrefValue = "";

		// bnfc2_name
		$Report1->bnfc2_name->HrefValue = "";

		// bnfc2_rel
		$Report1->bnfc2_rel->HrefValue = "";

		// bnfc3_name
		$Report1->bnfc3_name->HrefValue = "";

		// bnfc3_rel
		$Report1->bnfc3_rel->HrefValue = "";

		// regis_date
		$Report1->regis_date->HrefValue = "";

		// effective_date
		$Report1->effective_date->HrefValue = "";

		// resign_date
		$Report1->resign_date->HrefValue = "";

		// dead_date
		$Report1->dead_date->HrefValue = "";

		// terminate_date
		$Report1->terminate_date->HrefValue = "";

		// member_status
		$Report1->member_status->HrefValue = "";

		// dead_id
		$Report1->dead_id->HrefValue = "";

		// note
		$Report1->note->HrefValue = "";

		// Call Row_Rendered event
		$Report1->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $Report1;

		// Field t_code
		$sSelect = "SELECT DISTINCT `t_code` FROM " . $Report1->SqlFrom();
		$sOrderBy = "`t_code` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Report1->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Report1->t_code->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);

		// Field dead_id
		$sSelect = "SELECT DISTINCT `dead_id` FROM " . $Report1->SqlFrom();
		$sOrderBy = "`dead_id` ASC";
		$wrkSql = ewrpt_BuildReportSql($sSelect, $Report1->SqlWhere(), "", "", $sOrderBy, $this->UserIDFilter, "");
		$Report1->dead_id->DropDownList = ewrpt_GetDistinctValues("", $wrkSql);
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $Report1;
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
			// Field t_code

			$this->SetSessionDropDownValue($Report1->t_code->DropDownValue, 't_code');

			// Field dead_id
			$this->SetSessionDropDownValue($Report1->dead_id->DropDownValue, 'dead_id');
			$bSetupFilter = TRUE;
		} else {

			// Field t_code
			if ($this->GetDropDownValue($Report1->t_code->DropDownValue, 't_code')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Report1->t_code->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Report1->t_code'])) {
				$bSetupFilter = TRUE;
			}

			// Field dead_id
			if ($this->GetDropDownValue($Report1->dead_id->DropDownValue, 'dead_id')) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			} elseif ($Report1->dead_id->DropDownValue <> EWRPT_INIT_VALUE && !isset($_SESSION['sv_Report1->dead_id'])) {
				$bSetupFilter = TRUE;
			}
			if (!$this->ValidateForm()) {
				$this->setMessage($gsFormError);
				return $sFilter;
			}
		}

		// Restore session
		if ($bRestoreSession) {

			// Field t_code
			$this->GetSessionDropDownValue($Report1->t_code);

			// Field dead_id
			$this->GetSessionDropDownValue($Report1->dead_id);
		}

		// Call page filter validated event
		$Report1->Page_FilterValidated();

		// Build SQL
		// Field t_code

		$this->BuildDropDownFilter($Report1->t_code, $sFilter, "");

		// Field dead_id
		$this->BuildDropDownFilter($Report1->dead_id, $sFilter, "");

		// Save parms to session
		// Field t_code

		$this->SetSessionDropDownValue($Report1->t_code->DropDownValue, 't_code');

		// Field dead_id
		$this->SetSessionDropDownValue($Report1->dead_id->DropDownValue, 'dead_id');

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
		$this->GetSessionValue($fld->DropDownValue, 'sv_Report1_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_Report1_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_Report1_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_Report1_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_Report1_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_Report1_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_Report1_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_Report1_' . $parm] = $sv1;
		$_SESSION['so1_Report1_' . $parm] = $so1;
		$_SESSION['sc_Report1_' . $parm] = $sc;
		$_SESSION['sv2_Report1_' . $parm] = $sv2;
		$_SESSION['so2_Report1_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $Report1;

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
		$_SESSION["sel_Report1_$parm"] = "";
		$_SESSION["rf_Report1_$parm"] = "";
		$_SESSION["rt_Report1_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $Report1;
		$fld =& $Report1->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_Report1_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_Report1_$parm"];
		$fld->RangeTo = @$_SESSION["rt_Report1_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $Report1;

		/**
		* Set up default values for non Text filters
		*/

		// Field t_code
		$Report1->t_code->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Report1->t_code->DropDownValue = $Report1->t_code->DefaultDropDownValue;

		// Field dead_id
		$Report1->dead_id->DefaultDropDownValue = EWRPT_INIT_VALUE;
		$Report1->dead_id->DropDownValue = $Report1->dead_id->DefaultDropDownValue;

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

		// Field regis_date
		// Setup your default values for the popup filter below, e.g.
		// $Report1->regis_date->DefaultSelectionList = array("val1", "val2");

		$Report1->regis_date->DefaultSelectionList = "";
		$Report1->regis_date->SelectionList = $Report1->regis_date->DefaultSelectionList;

		// Field effective_date
		// Setup your default values for the popup filter below, e.g.
		// $Report1->effective_date->DefaultSelectionList = array("val1", "val2");

		$Report1->effective_date->DefaultSelectionList = "";
		$Report1->effective_date->SelectionList = $Report1->effective_date->DefaultSelectionList;

		// Field resign_date
		// Setup your default values for the popup filter below, e.g.
		// $Report1->resign_date->DefaultSelectionList = array("val1", "val2");

		$Report1->resign_date->DefaultSelectionList = "";
		$Report1->resign_date->SelectionList = $Report1->resign_date->DefaultSelectionList;

		// Field dead_date
		// Setup your default values for the popup filter below, e.g.
		// $Report1->dead_date->DefaultSelectionList = array("val1", "val2");

		$Report1->dead_date->DefaultSelectionList = "";
		$Report1->dead_date->SelectionList = $Report1->dead_date->DefaultSelectionList;

		// Field terminate_date
		// Setup your default values for the popup filter below, e.g.
		// $Report1->terminate_date->DefaultSelectionList = array("val1", "val2");

		$Report1->terminate_date->DefaultSelectionList = "";
		$Report1->terminate_date->SelectionList = $Report1->terminate_date->DefaultSelectionList;

		// Field member_status
		// Setup your default values for the popup filter below, e.g.
		// $Report1->member_status->DefaultSelectionList = array("val1", "val2");

		$Report1->member_status->DefaultSelectionList = "";
		$Report1->member_status->SelectionList = $Report1->member_status->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $Report1;

		// Check t_code extended filter
		if ($this->NonTextFilterApplied($Report1->t_code))
			return TRUE;

		// Check regis_date popup filter
		if (!ewrpt_MatchedArray($Report1->regis_date->DefaultSelectionList, $Report1->regis_date->SelectionList))
			return TRUE;

		// Check effective_date popup filter
		if (!ewrpt_MatchedArray($Report1->effective_date->DefaultSelectionList, $Report1->effective_date->SelectionList))
			return TRUE;

		// Check resign_date popup filter
		if (!ewrpt_MatchedArray($Report1->resign_date->DefaultSelectionList, $Report1->resign_date->SelectionList))
			return TRUE;

		// Check dead_date popup filter
		if (!ewrpt_MatchedArray($Report1->dead_date->DefaultSelectionList, $Report1->dead_date->SelectionList))
			return TRUE;

		// Check terminate_date popup filter
		if (!ewrpt_MatchedArray($Report1->terminate_date->DefaultSelectionList, $Report1->terminate_date->SelectionList))
			return TRUE;

		// Check member_status popup filter
		if (!ewrpt_MatchedArray($Report1->member_status->DefaultSelectionList, $Report1->member_status->SelectionList))
			return TRUE;

		// Check dead_id extended filter
		if ($this->NonTextFilterApplied($Report1->dead_id))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $Report1;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field t_code
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Report1->t_code, $sExtWrk, "");
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Report1->t_code->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field regis_date
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Report1->regis_date->SelectionList))
			$sWrk = ewrpt_JoinArray($Report1->regis_date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Report1->regis_date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field effective_date
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Report1->effective_date->SelectionList))
			$sWrk = ewrpt_JoinArray($Report1->effective_date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Report1->effective_date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field resign_date
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Report1->resign_date->SelectionList))
			$sWrk = ewrpt_JoinArray($Report1->resign_date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Report1->resign_date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field dead_date
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Report1->dead_date->SelectionList))
			$sWrk = ewrpt_JoinArray($Report1->dead_date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Report1->dead_date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field terminate_date
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Report1->terminate_date->SelectionList))
			$sWrk = ewrpt_JoinArray($Report1->terminate_date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Report1->terminate_date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field member_status
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($Report1->member_status->SelectionList))
			$sWrk = ewrpt_JoinArray($Report1->member_status->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Report1->member_status->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field dead_id
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildDropDownFilter($Report1->dead_id, $sExtWrk, "");
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $Report1->dead_id->FldCaption() . "<br />";
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
		global $Report1;
		$sWrk = "";
			if (is_array($Report1->regis_date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Report1->regis_date, "`regis_date`", EWRPT_DATATYPE_DATE);
			}
			if (is_array($Report1->effective_date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Report1->effective_date, "`effective_date`", EWRPT_DATATYPE_DATE);
			}
			if (is_array($Report1->resign_date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Report1->resign_date, "`resign_date`", EWRPT_DATATYPE_DATE);
			}
			if (is_array($Report1->dead_date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Report1->dead_date, "`dead_date`", EWRPT_DATATYPE_DATE);
			}
			if (is_array($Report1->terminate_date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Report1->terminate_date, "`terminate_date`", EWRPT_DATATYPE_DATE);
			}
			if (is_array($Report1->member_status->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($Report1->member_status, "`member_status`", EWRPT_DATATYPE_STRING);
			}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $Report1;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$Report1->setOrderBy("");
				$Report1->setStartGroup(1);
				$Report1->member_id->setSort("");
				$Report1->member_code->setSort("");
				$Report1->id_code->setSort("");
				$Report1->gender->setSort("");
				$Report1->prefix->setSort("");
				$Report1->fname->setSort("");
				$Report1->lname->setSort("");
				$Report1->birthdate->setSort("");
				$Report1->age->setSort("");
				$Report1->phone->setSort("");
				$Report1->address->setSort("");
				$Report1->t_code->setSort("");
				$Report1->bnfc1_name->setSort("");
				$Report1->bnfc1_rel->setSort("");
				$Report1->bnfc2_name->setSort("");
				$Report1->bnfc2_rel->setSort("");
				$Report1->bnfc3_name->setSort("");
				$Report1->bnfc3_rel->setSort("");
				$Report1->regis_date->setSort("");
				$Report1->effective_date->setSort("");
				$Report1->resign_date->setSort("");
				$Report1->dead_date->setSort("");
				$Report1->terminate_date->setSort("");
				$Report1->member_status->setSort("");
				$Report1->dead_id->setSort("");
				$Report1->note->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$Report1->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$Report1->CurrentOrderType = @$_GET["ordertype"];
			$Report1->UpdateSort($Report1->member_id); // member_id
			$Report1->UpdateSort($Report1->member_code); // member_code
			$Report1->UpdateSort($Report1->id_code); // id_code
			$Report1->UpdateSort($Report1->gender); // gender
			$Report1->UpdateSort($Report1->prefix); // prefix
			$Report1->UpdateSort($Report1->fname); // fname
			$Report1->UpdateSort($Report1->lname); // lname
			$Report1->UpdateSort($Report1->birthdate); // birthdate
			$Report1->UpdateSort($Report1->age); // age
			$Report1->UpdateSort($Report1->phone); // phone
			$Report1->UpdateSort($Report1->address); // address
			$Report1->UpdateSort($Report1->t_code); // t_code
			$Report1->UpdateSort($Report1->bnfc1_name); // bnfc1_name
			$Report1->UpdateSort($Report1->bnfc1_rel); // bnfc1_rel
			$Report1->UpdateSort($Report1->bnfc2_name); // bnfc2_name
			$Report1->UpdateSort($Report1->bnfc2_rel); // bnfc2_rel
			$Report1->UpdateSort($Report1->bnfc3_name); // bnfc3_name
			$Report1->UpdateSort($Report1->bnfc3_rel); // bnfc3_rel
			$Report1->UpdateSort($Report1->regis_date); // regis_date
			$Report1->UpdateSort($Report1->effective_date); // effective_date
			$Report1->UpdateSort($Report1->resign_date); // resign_date
			$Report1->UpdateSort($Report1->dead_date); // dead_date
			$Report1->UpdateSort($Report1->terminate_date); // terminate_date
			$Report1->UpdateSort($Report1->member_status); // member_status
			$Report1->UpdateSort($Report1->dead_id); // dead_id
			$Report1->UpdateSort($Report1->note); // note
			$sSortSql = $Report1->SortSql();
			$Report1->setOrderBy($sSortSql);
			$Report1->setStartGroup(1);
		}

		// Set up default sort
		if ($Report1->getOrderBy() == "") {
			$Report1->setOrderBy("`member_code` ASC");
			$Report1->member_code->setSort("ASC");
		}
		return $Report1->getOrderBy();
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
