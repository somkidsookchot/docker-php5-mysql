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
$reportallmember = NULL;

//
// Table class for reportallmember
//
class crreportallmember {
	var $TableVar = 'reportallmember';
	var $TableName = 'reportallmember';
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
	var $t_title;
	var $v_code;
	var $v_title;
	var $member_id;
	var $member_type;
	var $member_code;
	var $member_status;
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
	var $terminate_date;
	var $dead_date;
	var $note;
	var $dead_id;
	var $advance_budget;
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
	function crreportallmember() {
		global $ReportLanguage;

		// t_code
		$this->t_code = new crField('reportallmember', 'reportallmember', 'x_t_code', 't_code', '`t_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->t_code->GroupingFieldId = 2;
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "SELECT DISTINCT `t_code` FROM " . $this->SqlFrom();
		$this->t_code->SqlOrderBy = "`t_code`";
		$this->t_code->FldGroupByType = "";
		$this->t_code->FldGroupInt = "0";
		$this->t_code->FldGroupSql = "";

		// t_title
		$this->t_title = new crField('reportallmember', 'reportallmember', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->t_title->GroupingFieldId = 1;
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "SELECT DISTINCT tambon.t_title FROM " . $this->SqlFrom();
		$this->t_title->SqlOrderBy = "tambon.t_title";
		$this->t_title->FldGroupByType = "";
		$this->t_title->FldGroupInt = "0";
		$this->t_title->FldGroupSql = "";

		// v_code
		$this->v_code = new crField('reportallmember', 'reportallmember', 'x_v_code', 'v_code', 'village.v_code', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->v_code->GroupingFieldId = 3;
		$this->v_code->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['v_code'] =& $this->v_code;
		$this->v_code->DateFilter = "";
		$this->v_code->SqlSelect = "";
		$this->v_code->SqlOrderBy = "";
		$this->v_code->FldGroupByType = "";
		$this->v_code->FldGroupInt = "0";
		$this->v_code->FldGroupSql = "";

		// v_title
		$this->v_title = new crField('reportallmember', 'reportallmember', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->v_title->GroupingFieldId = 4;
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "SELECT DISTINCT village.v_title FROM " . $this->SqlFrom();
		$this->v_title->SqlOrderBy = "village.v_title";
		$this->v_title->FldGroupByType = "";
		$this->v_title->FldGroupInt = "0";
		$this->v_title->FldGroupSql = "";

		// member_id
		$this->member_id = new crField('reportallmember', 'reportallmember', 'x_member_id', 'member_id', '`member_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->member_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['member_id'] =& $this->member_id;
		$this->member_id->DateFilter = "";
		$this->member_id->SqlSelect = "";
		$this->member_id->SqlOrderBy = "";
		$this->member_id->FldGroupByType = "";
		$this->member_id->FldGroupInt = "0";
		$this->member_id->FldGroupSql = "";

		// member_type
		$this->member_type = new crField('reportallmember', 'reportallmember', 'x_member_type', 'member_type', '`member_type`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->member_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['member_type'] =& $this->member_type;
		$this->member_type->DateFilter = "";
		$this->member_type->SqlSelect = "";
		$this->member_type->SqlOrderBy = "";
		$this->member_type->FldGroupByType = "";
		$this->member_type->FldGroupInt = "0";
		$this->member_type->FldGroupSql = "";

		// member_code
		$this->member_code = new crField('reportallmember', 'reportallmember', 'x_member_code', 'member_code', '`member_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";
		$this->member_code->FldGroupByType = "";
		$this->member_code->FldGroupInt = "0";
		$this->member_code->FldGroupSql = "";

		// member_status
		$this->member_status = new crField('reportallmember', 'reportallmember', 'x_member_status', 'member_status', '`member_status`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_status'] =& $this->member_status;
		$this->member_status->DateFilter = "";
		$this->member_status->SqlSelect = "SELECT DISTINCT `member_status` FROM " . $this->SqlFrom();
		$this->member_status->SqlOrderBy = "`member_status`";
		$this->member_status->FldGroupByType = "";
		$this->member_status->FldGroupInt = "0";
		$this->member_status->FldGroupSql = "";

		// id_code
		$this->id_code = new crField('reportallmember', 'reportallmember', 'x_id_code', 'id_code', '`id_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['id_code'] =& $this->id_code;
		$this->id_code->DateFilter = "";
		$this->id_code->SqlSelect = "";
		$this->id_code->SqlOrderBy = "";
		$this->id_code->FldGroupByType = "";
		$this->id_code->FldGroupInt = "0";
		$this->id_code->FldGroupSql = "";

		// gender
		$this->gender = new crField('reportallmember', 'reportallmember', 'x_gender', 'gender', '`gender`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['gender'] =& $this->gender;
		$this->gender->DateFilter = "";
		$this->gender->SqlSelect = "";
		$this->gender->SqlOrderBy = "";
		$this->gender->FldGroupByType = "";
		$this->gender->FldGroupInt = "0";
		$this->gender->FldGroupSql = "";

		// prefix
		$this->prefix = new crField('reportallmember', 'reportallmember', 'x_prefix', 'prefix', '`prefix`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['prefix'] =& $this->prefix;
		$this->prefix->DateFilter = "";
		$this->prefix->SqlSelect = "";
		$this->prefix->SqlOrderBy = "";
		$this->prefix->FldGroupByType = "";
		$this->prefix->FldGroupInt = "0";
		$this->prefix->FldGroupSql = "";

		// fname
		$this->fname = new crField('reportallmember', 'reportallmember', 'x_fname', 'fname', '`fname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";
		$this->fname->FldGroupByType = "";
		$this->fname->FldGroupInt = "0";
		$this->fname->FldGroupSql = "";

		// lname
		$this->lname = new crField('reportallmember', 'reportallmember', 'x_lname', 'lname', '`lname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";
		$this->lname->FldGroupByType = "";
		$this->lname->FldGroupInt = "0";
		$this->lname->FldGroupSql = "";

		// birthdate
		$this->birthdate = new crField('reportallmember', 'reportallmember', 'x_birthdate', 'birthdate', '`birthdate`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->birthdate->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['birthdate'] =& $this->birthdate;
		$this->birthdate->DateFilter = "";
		$this->birthdate->SqlSelect = "";
		$this->birthdate->SqlOrderBy = "";
		$this->birthdate->FldGroupByType = "";
		$this->birthdate->FldGroupInt = "0";
		$this->birthdate->FldGroupSql = "";

		// age
		$this->age = new crField('reportallmember', 'reportallmember', 'x_age', 'age', '`age`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;
		$this->age->DateFilter = "";
		$this->age->SqlSelect = "";
		$this->age->SqlOrderBy = "";
		$this->age->FldGroupByType = "";
		$this->age->FldGroupInt = "0";
		$this->age->FldGroupSql = "";

		// email
		$this->zemail = new crField('reportallmember', 'reportallmember', 'x_zemail', 'email', '`email`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['zemail'] =& $this->zemail;
		$this->zemail->DateFilter = "";
		$this->zemail->SqlSelect = "";
		$this->zemail->SqlOrderBy = "";
		$this->zemail->FldGroupByType = "";
		$this->zemail->FldGroupInt = "0";
		$this->zemail->FldGroupSql = "";

		// phone
		$this->phone = new crField('reportallmember', 'reportallmember', 'x_phone', 'phone', '`phone`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['phone'] =& $this->phone;
		$this->phone->DateFilter = "";
		$this->phone->SqlSelect = "";
		$this->phone->SqlOrderBy = "";
		$this->phone->FldGroupByType = "";
		$this->phone->FldGroupInt = "0";
		$this->phone->FldGroupSql = "";

		// address
		$this->address = new crField('reportallmember', 'reportallmember', 'x_address', 'address', '`address`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['address'] =& $this->address;
		$this->address->DateFilter = "";
		$this->address->SqlSelect = "";
		$this->address->SqlOrderBy = "";
		$this->address->FldGroupByType = "";
		$this->address->FldGroupInt = "0";
		$this->address->FldGroupSql = "";

		// village_id
		$this->village_id = new crField('reportallmember', 'reportallmember', 'x_village_id', 'village_id', '`village_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";
		$this->village_id->FldGroupByType = "";
		$this->village_id->FldGroupInt = "0";
		$this->village_id->FldGroupSql = "";

		// suffix
		$this->suffix = new crField('reportallmember', 'reportallmember', 'x_suffix', 'suffix', '`suffix`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['suffix'] =& $this->suffix;
		$this->suffix->DateFilter = "";
		$this->suffix->SqlSelect = "";
		$this->suffix->SqlOrderBy = "";
		$this->suffix->FldGroupByType = "";
		$this->suffix->FldGroupInt = "0";
		$this->suffix->FldGroupSql = "";

		// bnfc1_name
		$this->bnfc1_name = new crField('reportallmember', 'reportallmember', 'x_bnfc1_name', 'bnfc1_name', '`bnfc1_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_name'] =& $this->bnfc1_name;
		$this->bnfc1_name->DateFilter = "";
		$this->bnfc1_name->SqlSelect = "";
		$this->bnfc1_name->SqlOrderBy = "";
		$this->bnfc1_name->FldGroupByType = "";
		$this->bnfc1_name->FldGroupInt = "0";
		$this->bnfc1_name->FldGroupSql = "";

		// bnfc1_rel
		$this->bnfc1_rel = new crField('reportallmember', 'reportallmember', 'x_bnfc1_rel', 'bnfc1_rel', '`bnfc1_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_rel'] =& $this->bnfc1_rel;
		$this->bnfc1_rel->DateFilter = "";
		$this->bnfc1_rel->SqlSelect = "";
		$this->bnfc1_rel->SqlOrderBy = "";
		$this->bnfc1_rel->FldGroupByType = "";
		$this->bnfc1_rel->FldGroupInt = "0";
		$this->bnfc1_rel->FldGroupSql = "";

		// bnfc2_name
		$this->bnfc2_name = new crField('reportallmember', 'reportallmember', 'x_bnfc2_name', 'bnfc2_name', '`bnfc2_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_name'] =& $this->bnfc2_name;
		$this->bnfc2_name->DateFilter = "";
		$this->bnfc2_name->SqlSelect = "";
		$this->bnfc2_name->SqlOrderBy = "";
		$this->bnfc2_name->FldGroupByType = "";
		$this->bnfc2_name->FldGroupInt = "0";
		$this->bnfc2_name->FldGroupSql = "";

		// bnfc2_rel
		$this->bnfc2_rel = new crField('reportallmember', 'reportallmember', 'x_bnfc2_rel', 'bnfc2_rel', '`bnfc2_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_rel'] =& $this->bnfc2_rel;
		$this->bnfc2_rel->DateFilter = "";
		$this->bnfc2_rel->SqlSelect = "";
		$this->bnfc2_rel->SqlOrderBy = "";
		$this->bnfc2_rel->FldGroupByType = "";
		$this->bnfc2_rel->FldGroupInt = "0";
		$this->bnfc2_rel->FldGroupSql = "";

		// bnfc3_name
		$this->bnfc3_name = new crField('reportallmember', 'reportallmember', 'x_bnfc3_name', 'bnfc3_name', '`bnfc3_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_name'] =& $this->bnfc3_name;
		$this->bnfc3_name->DateFilter = "";
		$this->bnfc3_name->SqlSelect = "";
		$this->bnfc3_name->SqlOrderBy = "";
		$this->bnfc3_name->FldGroupByType = "";
		$this->bnfc3_name->FldGroupInt = "0";
		$this->bnfc3_name->FldGroupSql = "";

		// bnfc3_rel
		$this->bnfc3_rel = new crField('reportallmember', 'reportallmember', 'x_bnfc3_rel', 'bnfc3_rel', '`bnfc3_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_rel'] =& $this->bnfc3_rel;
		$this->bnfc3_rel->DateFilter = "";
		$this->bnfc3_rel->SqlSelect = "";
		$this->bnfc3_rel->SqlOrderBy = "";
		$this->bnfc3_rel->FldGroupByType = "";
		$this->bnfc3_rel->FldGroupInt = "0";
		$this->bnfc3_rel->FldGroupSql = "";

		// bnfc4_name
		$this->bnfc4_name = new crField('reportallmember', 'reportallmember', 'x_bnfc4_name', 'bnfc4_name', '`bnfc4_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc4_name'] =& $this->bnfc4_name;
		$this->bnfc4_name->DateFilter = "";
		$this->bnfc4_name->SqlSelect = "";
		$this->bnfc4_name->SqlOrderBy = "";
		$this->bnfc4_name->FldGroupByType = "";
		$this->bnfc4_name->FldGroupInt = "0";
		$this->bnfc4_name->FldGroupSql = "";

		// bnfc4_rel
		$this->bnfc4_rel = new crField('reportallmember', 'reportallmember', 'x_bnfc4_rel', 'bnfc4_rel', '`bnfc4_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc4_rel'] =& $this->bnfc4_rel;
		$this->bnfc4_rel->DateFilter = "";
		$this->bnfc4_rel->SqlSelect = "";
		$this->bnfc4_rel->SqlOrderBy = "";
		$this->bnfc4_rel->FldGroupByType = "";
		$this->bnfc4_rel->FldGroupInt = "0";
		$this->bnfc4_rel->FldGroupSql = "";

		// attachment
		$this->attachment = new crField('reportallmember', 'reportallmember', 'x_attachment', 'attachment', '`attachment`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['attachment'] =& $this->attachment;
		$this->attachment->DateFilter = "";
		$this->attachment->SqlSelect = "";
		$this->attachment->SqlOrderBy = "";
		$this->attachment->FldGroupByType = "";
		$this->attachment->FldGroupInt = "0";
		$this->attachment->FldGroupSql = "";

		// regis_date
		$this->regis_date = new crField('reportallmember', 'reportallmember', 'x_regis_date', 'regis_date', '`regis_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->regis_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['regis_date'] =& $this->regis_date;
		$this->regis_date->DateFilter = "";
		$this->regis_date->SqlSelect = "SELECT DISTINCT `regis_date` FROM " . $this->SqlFrom();
		$this->regis_date->SqlOrderBy = "`regis_date`";
		$this->regis_date->FldGroupByType = "";
		$this->regis_date->FldGroupInt = "0";
		$this->regis_date->FldGroupSql = "";

		// effective_date
		$this->effective_date = new crField('reportallmember', 'reportallmember', 'x_effective_date', 'effective_date', '`effective_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->effective_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['effective_date'] =& $this->effective_date;
		$this->effective_date->DateFilter = "";
		$this->effective_date->SqlSelect = "SELECT DISTINCT `effective_date` FROM " . $this->SqlFrom();
		$this->effective_date->SqlOrderBy = "`effective_date`";
		$this->effective_date->FldGroupByType = "";
		$this->effective_date->FldGroupInt = "0";
		$this->effective_date->FldGroupSql = "";

		// resign_date
		$this->resign_date = new crField('reportallmember', 'reportallmember', 'x_resign_date', 'resign_date', '`resign_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->resign_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['resign_date'] =& $this->resign_date;
		$this->resign_date->DateFilter = "";
		$this->resign_date->SqlSelect = "SELECT DISTINCT `resign_date` FROM " . $this->SqlFrom();
		$this->resign_date->SqlOrderBy = "`resign_date`";
		$this->resign_date->FldGroupByType = "";
		$this->resign_date->FldGroupInt = "0";
		$this->resign_date->FldGroupSql = "";

		// terminate_date
		$this->terminate_date = new crField('reportallmember', 'reportallmember', 'x_terminate_date', 'terminate_date', '`terminate_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->terminate_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['terminate_date'] =& $this->terminate_date;
		$this->terminate_date->DateFilter = "";
		$this->terminate_date->SqlSelect = "SELECT DISTINCT `terminate_date` FROM " . $this->SqlFrom();
		$this->terminate_date->SqlOrderBy = "`terminate_date`";
		$this->terminate_date->FldGroupByType = "";
		$this->terminate_date->FldGroupInt = "0";
		$this->terminate_date->FldGroupSql = "";

		// dead_date
		$this->dead_date = new crField('reportallmember', 'reportallmember', 'x_dead_date', 'dead_date', '`dead_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->dead_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['dead_date'] =& $this->dead_date;
		$this->dead_date->DateFilter = "";
		$this->dead_date->SqlSelect = "SELECT DISTINCT `dead_date` FROM " . $this->SqlFrom();
		$this->dead_date->SqlOrderBy = "`dead_date`";
		$this->dead_date->FldGroupByType = "";
		$this->dead_date->FldGroupInt = "0";
		$this->dead_date->FldGroupSql = "";

		// note
		$this->note = new crField('reportallmember', 'reportallmember', 'x_note', 'note', '`note`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['note'] =& $this->note;
		$this->note->DateFilter = "";
		$this->note->SqlSelect = "";
		$this->note->SqlOrderBy = "";
		$this->note->FldGroupByType = "";
		$this->note->FldGroupInt = "0";
		$this->note->FldGroupSql = "";

		// dead_id
		$this->dead_id = new crField('reportallmember', 'reportallmember', 'x_dead_id', 'dead_id', '`dead_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->dead_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['dead_id'] =& $this->dead_id;
		$this->dead_id->DateFilter = "";
		$this->dead_id->SqlSelect = "SELECT DISTINCT `dead_id` FROM " . $this->SqlFrom();
		$this->dead_id->SqlOrderBy = "`dead_id`";
		$this->dead_id->FldGroupByType = "";
		$this->dead_id->FldGroupInt = "0";
		$this->dead_id->FldGroupSql = "";

		// advance_budget
		$this->advance_budget = new crField('reportallmember', 'reportallmember', 'x_advance_budget', 'advance_budget', '`advance_budget`', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->advance_budget->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['advance_budget'] =& $this->advance_budget;
		$this->advance_budget->DateFilter = "";
		$this->advance_budget->SqlSelect = "";
		$this->advance_budget->SqlOrderBy = "";
		$this->advance_budget->FldGroupByType = "";
		$this->advance_budget->FldGroupInt = "0";
		$this->advance_budget->FldGroupSql = "";

		// update_detail
		$this->update_detail = new crField('reportallmember', 'reportallmember', 'x_update_detail', 'update_detail', '`update_detail`', 201, EWRPT_DATATYPE_MEMO, -1);
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
		return "tambon.t_title ASC, `t_code` ASC, village.v_code ASC, village.v_title ASC";
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
$reportallmember_summary = new crreportallmember_summary();
$Page =& $reportallmember_summary;

// Page init
$reportallmember_summary->Page_Init();

// Page main
$reportallmember_summary->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($reportallmember->Export == "") { ?>
<script type="text/javascript">

// Create page object
var reportallmember_summary = new ewrpt_Page("reportallmember_summary");

// page properties
reportallmember_summary.PageID = "summary"; // page ID
reportallmember_summary.FormID = "freportallmembersummaryfilter"; // form ID
var EWRPT_PAGE_ID = reportallmember_summary.PageID;

// extend page with ValidateForm function
reportallmember_summary.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
reportallmember_summary.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EWRPT_CLIENT_VALIDATE) { ?>
reportallmember_summary.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
reportallmember_summary.ValidateRequired = false; // no JavaScript validation
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
<?php $reportallmember_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $reportallmember_summary->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php if ($reportallmember->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
<?php $jsdata = ewrpt_GetJsData($reportallmember->t_title, $reportallmember->t_title->FldType); ?>
ewrpt_CreatePopup("reportallmember_t_title", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportallmember->t_code, $reportallmember->t_code->FldType); ?>
ewrpt_CreatePopup("reportallmember_t_code", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportallmember->v_title, $reportallmember->v_title->FldType); ?>
ewrpt_CreatePopup("reportallmember_v_title", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportallmember->member_status, $reportallmember->member_status->FldType); ?>
ewrpt_CreatePopup("reportallmember_member_status", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportallmember->regis_date, $reportallmember->regis_date->FldType); ?>
ewrpt_CreatePopup("reportallmember_regis_date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportallmember->effective_date, $reportallmember->effective_date->FldType); ?>
ewrpt_CreatePopup("reportallmember_effective_date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportallmember->resign_date, $reportallmember->resign_date->FldType); ?>
ewrpt_CreatePopup("reportallmember_resign_date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportallmember->terminate_date, $reportallmember->terminate_date->FldType); ?>
ewrpt_CreatePopup("reportallmember_terminate_date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportallmember->dead_date, $reportallmember->dead_date->FldType); ?>
ewrpt_CreatePopup("reportallmember_dead_date", [<?php echo $jsdata ?>]);
<?php $jsdata = ewrpt_GetJsData($reportallmember->dead_id, $reportallmember->dead_id->FldType); ?>
ewrpt_CreatePopup("reportallmember_dead_id", [<?php echo $jsdata ?>]);
</script>
<div id="reportallmember_t_title_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportallmember_t_code_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportallmember_v_title_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportallmember_member_status_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportallmember_regis_date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportallmember_effective_date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportallmember_resign_date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportallmember_terminate_date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
<div id="reportallmember_dead_date_Popup" class="ewPopup">
<span class="phpreportmaker"></span>
</div>
 
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<div class="ewTitle"><?php if (!$_GET["export"]) { ?><img src="images/ico_all_member.png" width="40" height="40" align="absmiddle" /><?php } ?><?php echo $reportallmember->TableCaption() ?> </div>
<?php if ($reportallmember->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<?php if ($reportallmember->Export == "") { ?>
<?php
if ($reportallmember->FilterPanelOption == 2 || ($reportallmember->FilterPanelOption == 3 && $reportallmember_summary->FilterApplied) || $reportallmember_summary->Filter == "0=101") {
	$sButtonImage = "phprptimages/collapse.png";
	$sDivDisplay = "";
} else {
	$sButtonImage = "phprptimages/expand.png";
	$sDivDisplay = " style=\"display: none;\"";
}
?>
<a href="javascript:ewrpt_ToggleFilterPanel();" style="text-decoration: none;"><img id="ewrptToggleFilterImg" src="<?php echo $sButtonImage ?>" alt=""  border="0" align="absmiddle"></a><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("Filters") ?> <?php if ($reportallmember_summary->FilterApplied) { ?>&nbsp;<a href="reportallmembersmry.php?cmd=reset"><?php echo $ReportLanguage->Phrase("ResetAllFilter") ?></a><?php } ?><a href="<?php echo $reportallmember_summary->ExportExcelUrl ?>"><img src="images/bt_export_excel.png" align="absmiddle" border="0"/></a></span> 
<div id="ewrptExtFilterPanel"<?php echo $sDivDisplay ?> class="listSearch">
<!-- Search form (begin) -->
<form name="freportallmembersummaryfilter" id="freportallmembersummaryfilter" action="reportallmembersmry.php" class="ewForm" onsubmit="return reportallmember_summary.ValidateForm(this);">
<table class="ewRptExtFilter">
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportallmember->member_code->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_member_code" id="so1_member_code" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_member_code" id="sv1_member_code" size="30" maxlength="50" value="<?php echo ewrpt_HtmlEncode($reportallmember->member_code->SearchValue) ?>"<?php echo ($reportallmember_summary->ClearExtFilter == 'reportallmember_member_code') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportallmember->id_code->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_id_code" id="so1_id_code" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_id_code" id="sv1_id_code" size="30" maxlength="13" value="<?php echo ewrpt_HtmlEncode($reportallmember->id_code->SearchValue) ?>"<?php echo ($reportallmember_summary->ClearExtFilter == 'reportallmember_id_code') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportallmember->fname->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_fname" id="so1_fname" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_fname" id="sv1_fname" size="30" maxlength="45" value="<?php echo ewrpt_HtmlEncode($reportallmember->fname->SearchValue) ?>"<?php echo ($reportallmember_summary->ClearExtFilter == 'reportallmember_fname') ? " class=\"ewInputCleared\"" : "" ?>>
</span></td>
			</tr></table>			
		</td>
	</tr>
	<tr>
		<td><span class="phpreportmaker"><?php echo $reportallmember->lname->FldCaption() ?></span></td>
		<td><span class="ewRptSearchOpr"><?php echo $ReportLanguage->Phrase("LIKE"); ?><input type="hidden" name="so1_lname" id="so1_lname" value="LIKE"></span></td>
		<td>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpreportmaker">
<input type="text" name="sv1_lname" id="sv1_lname" size="30" maxlength="45" value="<?php echo ewrpt_HtmlEncode($reportallmember->lname->SearchValue) ?>"<?php echo ($reportallmember_summary->ClearExtFilter == 'reportallmember_lname') ? " class=\"ewInputCleared\"" : "" ?>>
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
<?php if ($reportallmember->ShowCurrentFilter) { ?>
<div id="ewrptFilterList">
<?php $reportallmember_summary->ShowFilterList() ?>
</div>
<?php } ?>
<div class="clear"></div><br />
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($reportallmember->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="reportallmembersmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportallmember_summary->StartGrp, $reportallmember_summary->DisplayGrps, $reportallmember_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportallmembersmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportallmembersmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportallmembersmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportallmembersmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($reportallmember_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportallmember_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportallmember_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportallmember_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportallmember_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportallmember_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportallmember_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportallmember_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportallmember_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportallmember_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportallmember->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($reportallmember->ExportAll && $reportallmember->Export <> "") {
	$reportallmember_summary->StopGrp = $reportallmember_summary->TotalGrps;
} else {
	$reportallmember_summary->StopGrp = $reportallmember_summary->StartGrp + $reportallmember_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($reportallmember_summary->StopGrp) > intval($reportallmember_summary->TotalGrps))
	$reportallmember_summary->StopGrp = $reportallmember_summary->TotalGrps;
$reportallmember_summary->RecCount = 0;

// Get first row
if ($reportallmember_summary->TotalGrps > 0) {
	$reportallmember_summary->GetGrpRow(1);
	$reportallmember_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $reportallmember_summary->GrpCount <= $reportallmember_summary->DisplayGrps) || $reportallmember_summary->ShowFirstHeader) {

	// Show header
	if ($reportallmember_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->t_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->t_title) ?>',1);"><?php echo $reportallmember->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportallmember_t_title', false, '<?php echo $reportallmember->t_title->RangeFrom; ?>', '<?php echo $reportallmember->t_title->RangeTo; ?>');return false;" name="x_t_title<?php echo $reportallmember_summary->Cnt[0][0]; ?>" id="x_t_title<?php echo $reportallmember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->t_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->t_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->t_code) ?>',1);"><?php echo $reportallmember->t_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->t_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->t_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportallmember_t_code', false, '<?php echo $reportallmember->t_code->RangeFrom; ?>', '<?php echo $reportallmember->t_code->RangeTo; ?>');return false;" name="x_t_code<?php echo $reportallmember_summary->Cnt[0][0]; ?>" id="x_t_code<?php echo $reportallmember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->v_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->v_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->v_code) ?>',1);"><?php echo $reportallmember->v_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->v_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->v_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->v_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->v_title) ?>',1);"><?php echo $reportallmember->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportallmember_v_title', false, '<?php echo $reportallmember->v_title->RangeFrom; ?>', '<?php echo $reportallmember->v_title->RangeTo; ?>');return false;" name="x_v_title<?php echo $reportallmember_summary->Cnt[0][0]; ?>" id="x_v_title<?php echo $reportallmember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->member_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->member_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->member_code) ?>',1);"><?php echo $reportallmember->member_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->member_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->member_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->member_status) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->member_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->member_status) ?>',1);"><?php echo $reportallmember->member_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->member_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->member_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportallmember_member_status', false, '<?php echo $reportallmember->member_status->RangeFrom; ?>', '<?php echo $reportallmember->member_status->RangeTo; ?>');return false;" name="x_member_status<?php echo $reportallmember_summary->Cnt[0][0]; ?>" id="x_member_status<?php echo $reportallmember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->id_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->id_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->id_code) ?>',1);"><?php echo $reportallmember->id_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->id_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->id_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->gender) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->gender->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->gender) ?>',1);"><?php echo $reportallmember->gender->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->gender->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->gender->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->prefix) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->prefix->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->prefix) ?>',1);"><?php echo $reportallmember->prefix->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->prefix->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->prefix->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->fname) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->fname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->fname) ?>',1);"><?php echo $reportallmember->fname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->fname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->fname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->lname) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->lname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->lname) ?>',1);"><?php echo $reportallmember->lname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->lname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->lname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->birthdate) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->birthdate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->birthdate) ?>',1);"><?php echo $reportallmember->birthdate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->birthdate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->birthdate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->age) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->age) ?>',1);"><?php echo $reportallmember->age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->phone) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->phone->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->phone) ?>',1);"><?php echo $reportallmember->phone->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->phone->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->phone->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->address) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->address->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->address) ?>',1);"><?php echo $reportallmember->address->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->address->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->address->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->bnfc1_name) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->bnfc1_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->bnfc1_name) ?>',1);"><?php echo $reportallmember->bnfc1_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->bnfc1_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->bnfc1_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->bnfc1_rel) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->bnfc1_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->bnfc1_rel) ?>',1);"><?php echo $reportallmember->bnfc1_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->bnfc1_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->bnfc1_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->bnfc2_name) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->bnfc2_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->bnfc2_name) ?>',1);"><?php echo $reportallmember->bnfc2_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->bnfc2_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->bnfc2_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->bnfc2_rel) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->bnfc2_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->bnfc2_rel) ?>',1);"><?php echo $reportallmember->bnfc2_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->bnfc2_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->bnfc2_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->bnfc3_name) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->bnfc3_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->bnfc3_name) ?>',1);"><?php echo $reportallmember->bnfc3_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->bnfc3_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->bnfc3_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->bnfc3_rel) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->bnfc3_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->bnfc3_rel) ?>',1);"><?php echo $reportallmember->bnfc3_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->bnfc3_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->bnfc3_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->regis_date) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->regis_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->regis_date) ?>',1);"><?php echo $reportallmember->regis_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->regis_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->regis_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportallmember_regis_date', true, '<?php echo $reportallmember->regis_date->RangeFrom; ?>', '<?php echo $reportallmember->regis_date->RangeTo; ?>');return false;" name="x_regis_date<?php echo $reportallmember_summary->Cnt[0][0]; ?>" id="x_regis_date<?php echo $reportallmember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->effective_date) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->effective_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->effective_date) ?>',1);"><?php echo $reportallmember->effective_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->effective_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->effective_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportallmember_effective_date', true, '<?php echo $reportallmember->effective_date->RangeFrom; ?>', '<?php echo $reportallmember->effective_date->RangeTo; ?>');return false;" name="x_effective_date<?php echo $reportallmember_summary->Cnt[0][0]; ?>" id="x_effective_date<?php echo $reportallmember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->resign_date) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->resign_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->resign_date) ?>',1);"><?php echo $reportallmember->resign_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->resign_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->resign_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportallmember_resign_date', true, '<?php echo $reportallmember->resign_date->RangeFrom; ?>', '<?php echo $reportallmember->resign_date->RangeTo; ?>');return false;" name="x_resign_date<?php echo $reportallmember_summary->Cnt[0][0]; ?>" id="x_resign_date<?php echo $reportallmember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->terminate_date) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->terminate_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->terminate_date) ?>',1);"><?php echo $reportallmember->terminate_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->terminate_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->terminate_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportallmember_terminate_date', true, '<?php echo $reportallmember->terminate_date->RangeFrom; ?>', '<?php echo $reportallmember->terminate_date->RangeTo; ?>');return false;" name="x_terminate_date<?php echo $reportallmember_summary->Cnt[0][0]; ?>" id="x_terminate_date<?php echo $reportallmember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->dead_date) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->dead_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->dead_date) ?>',1);"><?php echo $reportallmember->dead_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->dead_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->dead_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportallmember_dead_date', true, '<?php echo $reportallmember->dead_date->RangeFrom; ?>', '<?php echo $reportallmember->dead_date->RangeTo; ?>');return false;" name="x_dead_date<?php echo $reportallmember_summary->Cnt[0][0]; ?>" id="x_dead_date<?php echo $reportallmember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->note) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->note->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->note) ?>',1);"><?php echo $reportallmember->note->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->note->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->note->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($reportallmember->SortUrl($reportallmember->dead_id) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $reportallmember->dead_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportallmember->SortUrl($reportallmember->dead_id) ?>',1);"><?php echo $reportallmember->dead_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportallmember->dead_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportallmember->dead_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
		<td style="width: 20px;" align="right"><a href="#" onclick="ewrpt_ShowPopup(this.name, 'reportallmember_dead_id', false, '<?php echo $reportallmember->dead_id->RangeFrom; ?>', '<?php echo $reportallmember->dead_id->RangeTo; ?>');return false;" name="x_dead_id<?php echo $reportallmember_summary->Cnt[0][0]; ?>" id="x_dead_id<?php echo $reportallmember_summary->Cnt[0][0]; ?>"><img src="phprptimages/popup.gif" width="15" height="14" align="texttop" border="0" alt="<?php echo $ReportLanguage->Phrase("Filter") ?>"></a></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$reportallmember_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($reportallmember->t_title, $reportallmember->SqlFirstGroupField(), $reportallmember->t_title->GroupValue());
	if ($reportallmember_summary->Filter != "")
		$sWhere = "($reportallmember_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($reportallmember->SqlSelect(), $reportallmember->SqlWhere(), $reportallmember->SqlGroupBy(), $reportallmember->SqlHaving(), $reportallmember->SqlOrderBy(), $sWhere, $reportallmember_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$reportallmember_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$reportallmember_summary->RecCount++;

		// Render detail row
		$reportallmember->ResetCSS();
		$reportallmember->RowType = EWRPT_ROWTYPE_DETAIL;
		$reportallmember_summary->RenderRow();
?>
	<tr<?php echo $reportallmember->RowAttributes(); ?>>
		<td<?php echo $reportallmember->t_title->CellAttributes(); ?>><div<?php echo $reportallmember->t_title->ViewAttributes(); ?>><?php echo $reportallmember->t_title->GroupViewValue; ?></div></td>
		<td<?php echo $reportallmember->t_code->CellAttributes(); ?>><div<?php echo $reportallmember->t_code->ViewAttributes(); ?>><?php echo $reportallmember->t_code->GroupViewValue; ?></div></td>
		<td<?php echo $reportallmember->v_code->CellAttributes(); ?>><div<?php echo $reportallmember->v_code->ViewAttributes(); ?>><?php echo $reportallmember->v_code->GroupViewValue; ?></div></td>
		<td<?php echo $reportallmember->v_title->CellAttributes(); ?>><div<?php echo $reportallmember->v_title->ViewAttributes(); ?>><?php echo $reportallmember->v_title->GroupViewValue; ?></div></td>
		<td<?php echo $reportallmember->member_code->CellAttributes() ?>>
<div<?php echo $reportallmember->member_code->ViewAttributes(); ?>>
<?php if ($reportallmember->member_code->HrefValue <> "") { ?>
<a href="reportperson.php?member_id=<?php echo $reportallmember->member_code->HrefValue; ?>"><?php echo $reportallmember->member_code->ListViewValue(); ?></a>
<?php } else { ?>
<?php echo $reportallmember->member_code->ListViewValue(); ?>
<?php } ?>
</div>
</td>
		<td<?php echo $reportallmember->member_status->CellAttributes() ?>>
<div<?php echo $reportallmember->member_status->ViewAttributes(); ?>><?php echo $reportallmember->member_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->id_code->CellAttributes() ?>>
<div<?php echo $reportallmember->id_code->ViewAttributes(); ?>><?php echo $reportallmember->id_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->gender->CellAttributes() ?>>
<div<?php echo $reportallmember->gender->ViewAttributes(); ?>><?php echo $reportallmember->gender->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->prefix->CellAttributes() ?>>
<div<?php echo $reportallmember->prefix->ViewAttributes(); ?>><?php echo $reportallmember->prefix->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->fname->CellAttributes() ?>>
<div<?php echo $reportallmember->fname->ViewAttributes(); ?>><?php echo $reportallmember->fname->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->lname->CellAttributes() ?>>
<div<?php echo $reportallmember->lname->ViewAttributes(); ?>><?php echo $reportallmember->lname->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->birthdate->CellAttributes() ?>>
<div<?php echo $reportallmember->birthdate->ViewAttributes(); ?>><?php echo $reportallmember->birthdate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->age->CellAttributes() ?>>
<div<?php echo $reportallmember->age->ViewAttributes(); ?>><?php echo $reportallmember->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->phone->CellAttributes() ?>>
<div<?php echo $reportallmember->phone->ViewAttributes(); ?>><?php echo $reportallmember->phone->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->address->CellAttributes() ?>>
<div<?php echo $reportallmember->address->ViewAttributes(); ?>><?php echo $reportallmember->address->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->bnfc1_name->CellAttributes() ?>>
<div<?php echo $reportallmember->bnfc1_name->ViewAttributes(); ?>><?php echo $reportallmember->bnfc1_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->bnfc1_rel->CellAttributes() ?>>
<div<?php echo $reportallmember->bnfc1_rel->ViewAttributes(); ?>><?php echo $reportallmember->bnfc1_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->bnfc2_name->CellAttributes() ?>>
<div<?php echo $reportallmember->bnfc2_name->ViewAttributes(); ?>><?php echo $reportallmember->bnfc2_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->bnfc2_rel->CellAttributes() ?>>
<div<?php echo $reportallmember->bnfc2_rel->ViewAttributes(); ?>><?php echo $reportallmember->bnfc2_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->bnfc3_name->CellAttributes() ?>>
<div<?php echo $reportallmember->bnfc3_name->ViewAttributes(); ?>><?php echo $reportallmember->bnfc3_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->bnfc3_rel->CellAttributes() ?>>
<div<?php echo $reportallmember->bnfc3_rel->ViewAttributes(); ?>><?php echo $reportallmember->bnfc3_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->regis_date->CellAttributes() ?>>
<div<?php echo $reportallmember->regis_date->ViewAttributes(); ?>><?php echo $reportallmember->regis_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->effective_date->CellAttributes() ?>>
<div<?php echo $reportallmember->effective_date->ViewAttributes(); ?>><?php echo $reportallmember->effective_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->resign_date->CellAttributes() ?>>
<div<?php echo $reportallmember->resign_date->ViewAttributes(); ?>><?php echo $reportallmember->resign_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->terminate_date->CellAttributes() ?>>
<div<?php echo $reportallmember->terminate_date->ViewAttributes(); ?>><?php echo $reportallmember->terminate_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->dead_date->CellAttributes() ?>>
<div<?php echo $reportallmember->dead_date->ViewAttributes(); ?>><?php echo $reportallmember->dead_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->note->CellAttributes() ?>>
<div<?php echo $reportallmember->note->ViewAttributes(); ?>><?php echo $reportallmember->note->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportallmember->dead_id->CellAttributes() ?>>
<div<?php echo $reportallmember->dead_id->ViewAttributes(); ?>><?php echo $reportallmember->dead_id->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$reportallmember_summary->AccumulateSummary();

		// Get next record
		$reportallmember_summary->GetRow(2);

		// Show Footers
?>
<?php
		if ($reportallmember_summary->ChkLvlBreak(4)) {
			$reportallmember->ResetCSS();
			$reportallmember->RowType = EWRPT_ROWTYPE_TOTAL;
			$reportallmember->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$reportallmember->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$reportallmember->RowGroupLevel = 4;
			$reportallmember_summary->RenderRow();
?>
	<tr<?php echo $reportallmember->RowAttributes(); ?>>
		<td<?php echo $reportallmember->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportallmember->t_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportallmember->v_code->CellAttributes() ?>>&nbsp;</td>
		<td colspan="25"<?php echo $reportallmember->v_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $reportallmember->v_title->FldCaption() ?>: <?php echo $reportallmember->v_title->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($reportallmember_summary->Cnt[4][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php

			// Reset level 4 summary
			$reportallmember_summary->ResetLevelSummary(4);
		} // End check level check
?>
<?php
	} // End detail records loop
?>
<?php
			$reportallmember->ResetCSS();
			$reportallmember->RowType = EWRPT_ROWTYPE_TOTAL;
			$reportallmember->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$reportallmember->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$reportallmember->RowGroupLevel = 1;
			$reportallmember_summary->RenderRow();
?>
	<tr<?php echo $reportallmember->RowAttributes(); ?>>
		<td colspan="28"<?php echo $reportallmember->t_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $reportallmember->t_title->FldCaption() ?>: <?php echo $reportallmember->t_title->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($reportallmember_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php

			// Reset level 1 summary
			$reportallmember_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$reportallmember_summary->GetGrpRow(2);
	$reportallmember_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($reportallmember_summary->TotalGrps > 0) {
	$reportallmember->ResetCSS();
	$reportallmember->RowType = EWRPT_ROWTYPE_TOTAL;
	$reportallmember->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$reportallmember->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$reportallmember->RowAttrs["class"] = "ewRptGrandSummary";
	$reportallmember_summary->RenderRow();
?>
	<!-- tr><td colspan="28"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $reportallmember->RowAttributes(); ?>><td colspan="28"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($reportallmember_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($reportallmember_summary->TotalGrps > 0) { ?>
<?php if ($reportallmember->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="reportallmembersmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportallmember_summary->StartGrp, $reportallmember_summary->DisplayGrps, $reportallmember_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportallmembersmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportallmembersmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportallmembersmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportallmembersmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($reportallmember_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportallmember_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportallmember_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportallmember_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportallmember_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportallmember_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportallmember_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportallmember_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportallmember_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportallmember_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportallmember->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($reportallmember->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($reportallmember->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $reportallmember_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($reportallmember->Export == "") { ?>
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
$reportallmember_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crreportallmember_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'reportallmember';

	// Page object name
	var $PageObjName = 'reportallmember_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $reportallmember;
		if ($reportallmember->UseTokenInUrl) $PageUrl .= "t=" . $reportallmember->TableVar . "&"; // Add page token
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
		global $reportallmember;
		if ($reportallmember->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($reportallmember->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($reportallmember->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crreportallmember_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (reportallmember)
		$GLOBALS["reportallmember"] = new crreportallmember();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'reportallmember', TRUE);

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
		global $reportallmember;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$reportallmember->Export = $_GET["export"];
	}
	$gsExport = $reportallmember->Export; // Get export parameter, used in header
	$gsExportFile = $reportallmember->TableVar; // Get export file, used in header
	if ($reportallmember->Export == "excel") {
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
		global $reportallmember;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($reportallmember->Export == "email") {
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
		global $reportallmember;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 25;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();
		$reportallmember->t_title->SelectionList = "";
		$reportallmember->t_title->DefaultSelectionList = "";
		$reportallmember->t_title->ValueList = "";
		$reportallmember->t_code->SelectionList = "";
		$reportallmember->t_code->DefaultSelectionList = "";
		$reportallmember->t_code->ValueList = "";
		$reportallmember->v_title->SelectionList = "";
		$reportallmember->v_title->DefaultSelectionList = "";
		$reportallmember->v_title->ValueList = "";
		$reportallmember->member_status->SelectionList = "";
		$reportallmember->member_status->DefaultSelectionList = "";
		$reportallmember->member_status->ValueList = "";
		$reportallmember->regis_date->SelectionList = "";
		$reportallmember->regis_date->DefaultSelectionList = "";
		$reportallmember->regis_date->ValueList = "";
		$reportallmember->effective_date->SelectionList = "";
		$reportallmember->effective_date->DefaultSelectionList = "";
		$reportallmember->effective_date->ValueList = "";
		$reportallmember->resign_date->SelectionList = "";
		$reportallmember->resign_date->DefaultSelectionList = "";
		$reportallmember->resign_date->ValueList = "";
		$reportallmember->terminate_date->SelectionList = "";
		$reportallmember->terminate_date->DefaultSelectionList = "";
		$reportallmember->terminate_date->ValueList = "";
		$reportallmember->dead_date->SelectionList = "";
		$reportallmember->dead_date->DefaultSelectionList = "";
		$reportallmember->dead_date->ValueList = "";
		$reportallmember->dead_id->SelectionList = "";
		$reportallmember->dead_id->DefaultSelectionList = "";
		$reportallmember->dead_id->ValueList = "";

		// Load default filter values
		$this->LoadDefaultFilters();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Get dropdown values
		$this->GetExtendedFilterValues();

		// Load custom filters
		$reportallmember->CustomFilters_Load();

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
		$sGrpSort = ewrpt_UpdateSortFields($reportallmember->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($reportallmember->SqlSelectGroup(), $reportallmember->SqlWhere(), $reportallmember->SqlGroupBy(), $reportallmember->SqlHaving(), $reportallmember->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($reportallmember->ExportAll && $reportallmember->Export <> "")
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
		global $reportallmember;
		switch ($lvl) {
			case 1:
				return (is_null($reportallmember->t_title->CurrentValue) && !is_null($reportallmember->t_title->OldValue)) ||
					(!is_null($reportallmember->t_title->CurrentValue) && is_null($reportallmember->t_title->OldValue)) ||
					($reportallmember->t_title->GroupValue() <> $reportallmember->t_title->GroupOldValue());
			case 2:
				return (is_null($reportallmember->t_code->CurrentValue) && !is_null($reportallmember->t_code->OldValue)) ||
					(!is_null($reportallmember->t_code->CurrentValue) && is_null($reportallmember->t_code->OldValue)) ||
					($reportallmember->t_code->GroupValue() <> $reportallmember->t_code->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
			case 3:
				return (is_null($reportallmember->v_code->CurrentValue) && !is_null($reportallmember->v_code->OldValue)) ||
					(!is_null($reportallmember->v_code->CurrentValue) && is_null($reportallmember->v_code->OldValue)) ||
					($reportallmember->v_code->GroupValue() <> $reportallmember->v_code->GroupOldValue()) || $this->ChkLvlBreak(2); // Recurse upper level
			case 4:
				return (is_null($reportallmember->v_title->CurrentValue) && !is_null($reportallmember->v_title->OldValue)) ||
					(!is_null($reportallmember->v_title->CurrentValue) && is_null($reportallmember->v_title->OldValue)) ||
					($reportallmember->v_title->GroupValue() <> $reportallmember->v_title->GroupOldValue()) || $this->ChkLvlBreak(3); // Recurse upper level
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
		global $reportallmember;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $reportallmember;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $reportallmember;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$reportallmember->t_title->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$reportallmember->t_title->setDbValue($rsgrp->fields('t_title'));
		if ($rsgrp->EOF) {
			$reportallmember->t_title->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $reportallmember;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$reportallmember->t_code->setDbValue($rs->fields('t_code'));
			if ($opt <> 1)
				$reportallmember->t_title->setDbValue($rs->fields('t_title'));
			$reportallmember->v_code->setDbValue($rs->fields('v_code'));
			$reportallmember->v_title->setDbValue($rs->fields('v_title'));
			$reportallmember->member_id->setDbValue($rs->fields('member_id'));
			$reportallmember->member_type->setDbValue($rs->fields('member_type'));
			$reportallmember->member_code->setDbValue($rs->fields('member_code'));
			$reportallmember->member_status->setDbValue($rs->fields('member_status'));
			$reportallmember->id_code->setDbValue($rs->fields('id_code'));
			$reportallmember->gender->setDbValue($rs->fields('gender'));
			$reportallmember->prefix->setDbValue($rs->fields('prefix'));
			$reportallmember->fname->setDbValue($rs->fields('fname'));
			$reportallmember->lname->setDbValue($rs->fields('lname'));
			$reportallmember->birthdate->setDbValue($rs->fields('birthdate'));
			$reportallmember->age->setDbValue($rs->fields('age'));
			$reportallmember->zemail->setDbValue($rs->fields('email'));
			$reportallmember->phone->setDbValue($rs->fields('phone'));
			$reportallmember->address->setDbValue($rs->fields('address'));
			$reportallmember->village_id->setDbValue($rs->fields('village_id'));
			$reportallmember->suffix->setDbValue($rs->fields('suffix'));
			$reportallmember->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
			$reportallmember->bnfc1_rel->setDbValue($rs->fields('bnfc1_rel'));
			$reportallmember->bnfc2_name->setDbValue($rs->fields('bnfc2_name'));
			$reportallmember->bnfc2_rel->setDbValue($rs->fields('bnfc2_rel'));
			$reportallmember->bnfc3_name->setDbValue($rs->fields('bnfc3_name'));
			$reportallmember->bnfc3_rel->setDbValue($rs->fields('bnfc3_rel'));
			$reportallmember->bnfc4_name->setDbValue($rs->fields('bnfc4_name'));
			$reportallmember->bnfc4_rel->setDbValue($rs->fields('bnfc4_rel'));
			$reportallmember->attachment->setDbValue($rs->fields('attachment'));
			$reportallmember->regis_date->setDbValue($rs->fields('regis_date'));
			$reportallmember->effective_date->setDbValue($rs->fields('effective_date'));
			$reportallmember->resign_date->setDbValue($rs->fields('resign_date'));
			$reportallmember->terminate_date->setDbValue($rs->fields('terminate_date'));
			$reportallmember->dead_date->setDbValue($rs->fields('dead_date'));
			$reportallmember->note->setDbValue($rs->fields('note'));
			$reportallmember->dead_id->setDbValue($rs->fields('dead_id'));
			$reportallmember->advance_budget->setDbValue($rs->fields('advance_budget'));
			$reportallmember->update_detail->setDbValue($rs->fields('update_detail'));
			$this->Val[1] = $reportallmember->member_code->CurrentValue;
			$this->Val[2] = $reportallmember->member_status->CurrentValue;
			$this->Val[3] = $reportallmember->id_code->CurrentValue;
			$this->Val[4] = $reportallmember->gender->CurrentValue;
			$this->Val[5] = $reportallmember->prefix->CurrentValue;
			$this->Val[6] = $reportallmember->fname->CurrentValue;
			$this->Val[7] = $reportallmember->lname->CurrentValue;
			$this->Val[8] = $reportallmember->birthdate->CurrentValue;
			$this->Val[9] = $reportallmember->age->CurrentValue;
			$this->Val[10] = $reportallmember->phone->CurrentValue;
			$this->Val[11] = $reportallmember->address->CurrentValue;
			$this->Val[12] = $reportallmember->bnfc1_name->CurrentValue;
			$this->Val[13] = $reportallmember->bnfc1_rel->CurrentValue;
			$this->Val[14] = $reportallmember->bnfc2_name->CurrentValue;
			$this->Val[15] = $reportallmember->bnfc2_rel->CurrentValue;
			$this->Val[16] = $reportallmember->bnfc3_name->CurrentValue;
			$this->Val[17] = $reportallmember->bnfc3_rel->CurrentValue;
			$this->Val[18] = $reportallmember->regis_date->CurrentValue;
			$this->Val[19] = $reportallmember->effective_date->CurrentValue;
			$this->Val[20] = $reportallmember->resign_date->CurrentValue;
			$this->Val[21] = $reportallmember->terminate_date->CurrentValue;
			$this->Val[22] = $reportallmember->dead_date->CurrentValue;
			$this->Val[23] = $reportallmember->note->CurrentValue;
			$this->Val[24] = $reportallmember->dead_id->CurrentValue;
		} else {
			$reportallmember->t_code->setDbValue("");
			$reportallmember->t_title->setDbValue("");
			$reportallmember->v_code->setDbValue("");
			$reportallmember->v_title->setDbValue("");
			$reportallmember->member_id->setDbValue("");
			$reportallmember->member_type->setDbValue("");
			$reportallmember->member_code->setDbValue("");
			$reportallmember->member_status->setDbValue("");
			$reportallmember->id_code->setDbValue("");
			$reportallmember->gender->setDbValue("");
			$reportallmember->prefix->setDbValue("");
			$reportallmember->fname->setDbValue("");
			$reportallmember->lname->setDbValue("");
			$reportallmember->birthdate->setDbValue("");
			$reportallmember->age->setDbValue("");
			$reportallmember->zemail->setDbValue("");
			$reportallmember->phone->setDbValue("");
			$reportallmember->address->setDbValue("");
			$reportallmember->village_id->setDbValue("");
			$reportallmember->suffix->setDbValue("");
			$reportallmember->bnfc1_name->setDbValue("");
			$reportallmember->bnfc1_rel->setDbValue("");
			$reportallmember->bnfc2_name->setDbValue("");
			$reportallmember->bnfc2_rel->setDbValue("");
			$reportallmember->bnfc3_name->setDbValue("");
			$reportallmember->bnfc3_rel->setDbValue("");
			$reportallmember->bnfc4_name->setDbValue("");
			$reportallmember->bnfc4_rel->setDbValue("");
			$reportallmember->attachment->setDbValue("");
			$reportallmember->regis_date->setDbValue("");
			$reportallmember->effective_date->setDbValue("");
			$reportallmember->resign_date->setDbValue("");
			$reportallmember->terminate_date->setDbValue("");
			$reportallmember->dead_date->setDbValue("");
			$reportallmember->note->setDbValue("");
			$reportallmember->dead_id->setDbValue("");
			$reportallmember->advance_budget->setDbValue("");
			$reportallmember->update_detail->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $reportallmember;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$reportallmember->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$reportallmember->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $reportallmember->getStartGroup();
			}
		} else {
			$this->StartGrp = $reportallmember->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$reportallmember->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$reportallmember->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$reportallmember->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $reportallmember;

		// Initialize popup
		// Build distinct values for t_title

		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportallmember->t_title->SqlSelect, $reportallmember->SqlWhere(), $reportallmember->SqlGroupBy(), $reportallmember->SqlHaving(), $reportallmember->t_title->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportallmember->t_title->setDbValue($rswrk->fields[0]);
			if (is_null($reportallmember->t_title->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportallmember->t_title->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportallmember->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportallmember->t_title,$reportallmember->t_title->GroupValue());
				ewrpt_SetupDistinctValues($reportallmember->t_title->ValueList, $reportallmember->t_title->GroupValue(), $reportallmember->t_title->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportallmember->t_title->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportallmember->t_title->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for t_code
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportallmember->t_code->SqlSelect, $reportallmember->SqlWhere(), $reportallmember->SqlGroupBy(), $reportallmember->SqlHaving(), $reportallmember->t_code->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportallmember->t_code->setDbValue($rswrk->fields[0]);
			if (is_null($reportallmember->t_code->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportallmember->t_code->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportallmember->t_code->GroupViewValue = ewrpt_DisplayGroupValue($reportallmember->t_code,$reportallmember->t_code->GroupValue());
				ewrpt_SetupDistinctValues($reportallmember->t_code->ValueList, $reportallmember->t_code->GroupValue(), $reportallmember->t_code->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportallmember->t_code->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportallmember->t_code->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for v_title
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportallmember->v_title->SqlSelect, $reportallmember->SqlWhere(), $reportallmember->SqlGroupBy(), $reportallmember->SqlHaving(), $reportallmember->v_title->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportallmember->v_title->setDbValue($rswrk->fields[0]);
			if (is_null($reportallmember->v_title->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportallmember->v_title->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportallmember->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportallmember->v_title,$reportallmember->v_title->GroupValue());
				ewrpt_SetupDistinctValues($reportallmember->v_title->ValueList, $reportallmember->v_title->GroupValue(), $reportallmember->v_title->GroupViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportallmember->v_title->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportallmember->v_title->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for member_status
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportallmember->member_status->SqlSelect, $reportallmember->SqlWhere(), $reportallmember->SqlGroupBy(), $reportallmember->SqlHaving(), $reportallmember->member_status->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportallmember->member_status->setDbValue($rswrk->fields[0]);
			if (is_null($reportallmember->member_status->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportallmember->member_status->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportallmember->member_status->ViewValue = $reportallmember->member_status->CurrentValue;
				ewrpt_SetupDistinctValues($reportallmember->member_status->ValueList, $reportallmember->member_status->CurrentValue, $reportallmember->member_status->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportallmember->member_status->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportallmember->member_status->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for regis_date
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportallmember->regis_date->SqlSelect, $reportallmember->SqlWhere(), $reportallmember->SqlGroupBy(), $reportallmember->SqlHaving(), $reportallmember->regis_date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportallmember->regis_date->setDbValue($rswrk->fields[0]);
			if (is_null($reportallmember->regis_date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportallmember->regis_date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportallmember->regis_date->ViewValue = ewrpt_FormatDateTime($reportallmember->regis_date->CurrentValue, 7);
				ewrpt_SetupDistinctValues($reportallmember->regis_date->ValueList, $reportallmember->regis_date->CurrentValue, $reportallmember->regis_date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportallmember->regis_date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportallmember->regis_date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for effective_date
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportallmember->effective_date->SqlSelect, $reportallmember->SqlWhere(), $reportallmember->SqlGroupBy(), $reportallmember->SqlHaving(), $reportallmember->effective_date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportallmember->effective_date->setDbValue($rswrk->fields[0]);
			if (is_null($reportallmember->effective_date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportallmember->effective_date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportallmember->effective_date->ViewValue = ewrpt_FormatDateTime($reportallmember->effective_date->CurrentValue, 7);
				ewrpt_SetupDistinctValues($reportallmember->effective_date->ValueList, $reportallmember->effective_date->CurrentValue, $reportallmember->effective_date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportallmember->effective_date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportallmember->effective_date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for resign_date
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportallmember->resign_date->SqlSelect, $reportallmember->SqlWhere(), $reportallmember->SqlGroupBy(), $reportallmember->SqlHaving(), $reportallmember->resign_date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportallmember->resign_date->setDbValue($rswrk->fields[0]);
			if (is_null($reportallmember->resign_date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportallmember->resign_date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportallmember->resign_date->ViewValue = ewrpt_FormatDateTime($reportallmember->resign_date->CurrentValue, 7);
				ewrpt_SetupDistinctValues($reportallmember->resign_date->ValueList, $reportallmember->resign_date->CurrentValue, $reportallmember->resign_date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportallmember->resign_date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportallmember->resign_date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for terminate_date
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportallmember->terminate_date->SqlSelect, $reportallmember->SqlWhere(), $reportallmember->SqlGroupBy(), $reportallmember->SqlHaving(), $reportallmember->terminate_date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportallmember->terminate_date->setDbValue($rswrk->fields[0]);
			if (is_null($reportallmember->terminate_date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportallmember->terminate_date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportallmember->terminate_date->ViewValue = ewrpt_FormatDateTime($reportallmember->terminate_date->CurrentValue, 7);
				ewrpt_SetupDistinctValues($reportallmember->terminate_date->ValueList, $reportallmember->terminate_date->CurrentValue, $reportallmember->terminate_date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportallmember->terminate_date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportallmember->terminate_date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for dead_date
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportallmember->dead_date->SqlSelect, $reportallmember->SqlWhere(), $reportallmember->SqlGroupBy(), $reportallmember->SqlHaving(), $reportallmember->dead_date->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportallmember->dead_date->setDbValue($rswrk->fields[0]);
			if (is_null($reportallmember->dead_date->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportallmember->dead_date->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportallmember->dead_date->ViewValue = ewrpt_FormatDateTime($reportallmember->dead_date->CurrentValue, 7);
				ewrpt_SetupDistinctValues($reportallmember->dead_date->ValueList, $reportallmember->dead_date->CurrentValue, $reportallmember->dead_date->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportallmember->dead_date->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportallmember->dead_date->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

		// Build distinct values for dead_id
		$bNullValue = FALSE;
		$bEmptyValue = FALSE;
		$sSql = ewrpt_BuildReportSql($reportallmember->dead_id->SqlSelect, $reportallmember->SqlWhere(), $reportallmember->SqlGroupBy(), $reportallmember->SqlHaving(), $reportallmember->dead_id->SqlOrderBy, $this->Filter, "");
		$rswrk = $conn->Execute($sSql);
		while ($rswrk && !$rswrk->EOF) {
			$reportallmember->dead_id->setDbValue($rswrk->fields[0]);
			if (is_null($reportallmember->dead_id->CurrentValue)) {
				$bNullValue = TRUE;
			} elseif ($reportallmember->dead_id->CurrentValue == "") {
				$bEmptyValue = TRUE;
			} else {
				$reportallmember->dead_id->ViewValue = $reportallmember->dead_id->CurrentValue;
				ewrpt_SetupDistinctValues($reportallmember->dead_id->ValueList, $reportallmember->dead_id->CurrentValue, $reportallmember->dead_id->ViewValue, FALSE);
			}
			$rswrk->MoveNext();
		}
		if ($rswrk)
			$rswrk->Close();
		if ($bEmptyValue)
			ewrpt_SetupDistinctValues($reportallmember->dead_id->ValueList, EWRPT_EMPTY_VALUE, $ReportLanguage->Phrase("EmptyLabel"), FALSE);
		if ($bNullValue)
			ewrpt_SetupDistinctValues($reportallmember->dead_id->ValueList, EWRPT_NULL_VALUE, $ReportLanguage->Phrase("NullLabel"), FALSE);

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
				$this->ClearSessionSelection('t_code');
				$this->ClearSessionSelection('v_title');
				$this->ClearSessionSelection('member_status');
				$this->ClearSessionSelection('regis_date');
				$this->ClearSessionSelection('effective_date');
				$this->ClearSessionSelection('resign_date');
				$this->ClearSessionSelection('terminate_date');
				$this->ClearSessionSelection('dead_date');
				$this->ClearSessionSelection('dead_id');
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
		// Get ตำบล selected values

		if (is_array(@$_SESSION["sel_reportallmember_t_title"])) {
			$this->LoadSelectionFromSession('t_title');
		} elseif (@$_SESSION["sel_reportallmember_t_title"] == EWRPT_INIT_VALUE) { // Select all
			$reportallmember->t_title->SelectionList = "";
		}

		// Get รหัสตำบล selected values
		if (is_array(@$_SESSION["sel_reportallmember_t_code"])) {
			$this->LoadSelectionFromSession('t_code');
		} elseif (@$_SESSION["sel_reportallmember_t_code"] == EWRPT_INIT_VALUE) { // Select all
			$reportallmember->t_code->SelectionList = "";
		}

		// Get หมู่บ้าน selected values
		if (is_array(@$_SESSION["sel_reportallmember_v_title"])) {
			$this->LoadSelectionFromSession('v_title');
		} elseif (@$_SESSION["sel_reportallmember_v_title"] == EWRPT_INIT_VALUE) { // Select all
			$reportallmember->v_title->SelectionList = "";
		}

		// Get สถานะ selected values
		if (is_array(@$_SESSION["sel_reportallmember_member_status"])) {
			$this->LoadSelectionFromSession('member_status');
		} elseif (@$_SESSION["sel_reportallmember_member_status"] == EWRPT_INIT_VALUE) { // Select all
			$reportallmember->member_status->SelectionList = "";
		}

		// Get ว.ด.ป. ที่สมัคร selected values
		if (is_array(@$_SESSION["sel_reportallmember_regis_date"])) {
			$this->LoadSelectionFromSession('regis_date');
		} elseif (@$_SESSION["sel_reportallmember_regis_date"] == EWRPT_INIT_VALUE) { // Select all
			$reportallmember->regis_date->SelectionList = "";
		}

		// Get ว.ด.ป. ที่มีผล selected values
		if (is_array(@$_SESSION["sel_reportallmember_effective_date"])) {
			$this->LoadSelectionFromSession('effective_date');
		} elseif (@$_SESSION["sel_reportallmember_effective_date"] == EWRPT_INIT_VALUE) { // Select all
			$reportallmember->effective_date->SelectionList = "";
		}

		// Get ว.ด.ป. ที่ลาออก selected values
		if (is_array(@$_SESSION["sel_reportallmember_resign_date"])) {
			$this->LoadSelectionFromSession('resign_date');
		} elseif (@$_SESSION["sel_reportallmember_resign_date"] == EWRPT_INIT_VALUE) { // Select all
			$reportallmember->resign_date->SelectionList = "";
		}

		// Get ว.ด.ป. พ้นสภาพ selected values
		if (is_array(@$_SESSION["sel_reportallmember_terminate_date"])) {
			$this->LoadSelectionFromSession('terminate_date');
		} elseif (@$_SESSION["sel_reportallmember_terminate_date"] == EWRPT_INIT_VALUE) { // Select all
			$reportallmember->terminate_date->SelectionList = "";
		}

		// Get ว.ด.ป. ที่เสียชีวิต selected values
		if (is_array(@$_SESSION["sel_reportallmember_dead_date"])) {
			$this->LoadSelectionFromSession('dead_date');
		} elseif (@$_SESSION["sel_reportallmember_dead_date"] == EWRPT_INIT_VALUE) { // Select all
			$reportallmember->dead_date->SelectionList = "";
		}

		// Get ศพที่ selected values
		if (is_array(@$_SESSION["sel_reportallmember_dead_id"])) {
			$this->LoadSelectionFromSession('dead_id');
		} elseif (@$_SESSION["sel_reportallmember_dead_id"] == EWRPT_INIT_VALUE) { // Select all
			$reportallmember->dead_id->SelectionList = "";
		}
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $reportallmember;
		$this->StartGrp = 1;
		$reportallmember->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $reportallmember;
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
			$reportallmember->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$reportallmember->setStartGroup($this->StartGrp);
		} else {
			if ($reportallmember->getGroupPerPage() <> "") {
				$this->DisplayGrps = $reportallmember->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $reportallmember;
		if ($reportallmember->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($reportallmember->SqlSelectCount(), $reportallmember->SqlWhere(), $reportallmember->SqlGroupBy(), $reportallmember->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$reportallmember->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($reportallmember->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// t_title
			$reportallmember->t_title->GroupViewValue = $reportallmember->t_title->GroupOldValue();
			$reportallmember->t_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->t_title->CellAttrs["class"] = ($reportallmember->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$reportallmember->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportallmember->t_title, $reportallmember->t_title->GroupViewValue);

			// t_code
			$reportallmember->t_code->GroupViewValue = $reportallmember->t_code->GroupOldValue();
			$reportallmember->t_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->t_code->CellAttrs["class"] = ($reportallmember->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";
			$reportallmember->t_code->GroupViewValue = ewrpt_DisplayGroupValue($reportallmember->t_code, $reportallmember->t_code->GroupViewValue);

			// v_code
			$reportallmember->v_code->GroupViewValue = $reportallmember->v_code->GroupOldValue();
			$reportallmember->v_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->v_code->CellAttrs["class"] = ($reportallmember->RowGroupLevel == 3) ? "ewRptGrpSummary3" : "ewRptGrpField3";
			$reportallmember->v_code->GroupViewValue = ewrpt_DisplayGroupValue($reportallmember->v_code, $reportallmember->v_code->GroupViewValue);

			// v_title
			$reportallmember->v_title->GroupViewValue = $reportallmember->v_title->GroupOldValue();
			$reportallmember->v_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->v_title->CellAttrs["class"] = ($reportallmember->RowGroupLevel == 4) ? "ewRptGrpSummary4" : "ewRptGrpField4";
			$reportallmember->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportallmember->v_title, $reportallmember->v_title->GroupViewValue);

			// member_code
			$reportallmember->member_code->ViewValue = $reportallmember->member_code->Summary;
			$reportallmember->member_code->CellAttrs["style"] = "white-space: nowrap;";

			// member_status
			$reportallmember->member_status->ViewValue = $reportallmember->member_status->Summary;
			$reportallmember->member_status->CellAttrs["style"] = "white-space: nowrap;";

			// id_code
			$reportallmember->id_code->ViewValue = $reportallmember->id_code->Summary;
			$reportallmember->id_code->CellAttrs["style"] = "white-space: nowrap;";

			// gender
			$reportallmember->gender->ViewValue = $reportallmember->gender->Summary;
			$reportallmember->gender->CellAttrs["style"] = "white-space: nowrap;";

			// prefix
			$reportallmember->prefix->ViewValue = $reportallmember->prefix->Summary;
			$reportallmember->prefix->CellAttrs["style"] = "white-space: nowrap;";

			// fname
			$reportallmember->fname->ViewValue = $reportallmember->fname->Summary;
			$reportallmember->fname->CellAttrs["style"] = "white-space: nowrap;";

			// lname
			$reportallmember->lname->ViewValue = $reportallmember->lname->Summary;
			$reportallmember->lname->CellAttrs["style"] = "white-space: nowrap;";

			// birthdate
			$reportallmember->birthdate->ViewValue = $reportallmember->birthdate->Summary;
			$reportallmember->birthdate->ViewValue = ewrpt_FormatDateTime($reportallmember->birthdate->ViewValue, 7);
			$reportallmember->birthdate->CellAttrs["style"] = "white-space: nowrap;";

			// age
			$reportallmember->age->ViewValue = $reportallmember->age->Summary;
			$reportallmember->age->CellAttrs["style"] = "white-space: nowrap;";

			// phone
			$reportallmember->phone->ViewValue = $reportallmember->phone->Summary;
			$reportallmember->phone->CellAttrs["style"] = "white-space: nowrap;";

			// address
			$reportallmember->address->ViewValue = $reportallmember->address->Summary;
			$reportallmember->address->CellAttrs["style"] = "white-space: nowrap;";

			// bnfc1_name
			$reportallmember->bnfc1_name->ViewValue = $reportallmember->bnfc1_name->Summary;
			$reportallmember->bnfc1_name->CellAttrs["style"] = "white-space: nowrap;";

			// bnfc1_rel
			$reportallmember->bnfc1_rel->ViewValue = $reportallmember->bnfc1_rel->Summary;
			$reportallmember->bnfc1_rel->CellAttrs["style"] = "white-space: nowrap;";

			// bnfc2_name
			$reportallmember->bnfc2_name->ViewValue = $reportallmember->bnfc2_name->Summary;
			$reportallmember->bnfc2_name->CellAttrs["style"] = "white-space: nowrap;";

			// bnfc2_rel
			$reportallmember->bnfc2_rel->ViewValue = $reportallmember->bnfc2_rel->Summary;
			$reportallmember->bnfc2_rel->CellAttrs["style"] = "white-space: nowrap;";

			// bnfc3_name
			$reportallmember->bnfc3_name->ViewValue = $reportallmember->bnfc3_name->Summary;
			$reportallmember->bnfc3_name->CellAttrs["style"] = "white-space: nowrap;";

			// bnfc3_rel
			$reportallmember->bnfc3_rel->ViewValue = $reportallmember->bnfc3_rel->Summary;
			$reportallmember->bnfc3_rel->CellAttrs["style"] = "white-space: nowrap;";

			// regis_date
			$reportallmember->regis_date->ViewValue = $reportallmember->regis_date->Summary;
			$reportallmember->regis_date->ViewValue = ewrpt_FormatDateTime($reportallmember->regis_date->ViewValue, 7);
			$reportallmember->regis_date->CellAttrs["style"] = "white-space: nowrap;";

			// effective_date
			$reportallmember->effective_date->ViewValue = $reportallmember->effective_date->Summary;
			$reportallmember->effective_date->ViewValue = ewrpt_FormatDateTime($reportallmember->effective_date->ViewValue, 7);
			$reportallmember->effective_date->CellAttrs["style"] = "white-space: nowrap;";

			// resign_date
			$reportallmember->resign_date->ViewValue = $reportallmember->resign_date->Summary;
			$reportallmember->resign_date->ViewValue = ewrpt_FormatDateTime($reportallmember->resign_date->ViewValue, 7);
			$reportallmember->resign_date->CellAttrs["style"] = "white-space: nowrap;";

			// terminate_date
			$reportallmember->terminate_date->ViewValue = $reportallmember->terminate_date->Summary;
			$reportallmember->terminate_date->ViewValue = ewrpt_FormatDateTime($reportallmember->terminate_date->ViewValue, 7);
			$reportallmember->terminate_date->CellAttrs["style"] = "white-space: nowrap;";

			// dead_date
			$reportallmember->dead_date->ViewValue = $reportallmember->dead_date->Summary;
			$reportallmember->dead_date->ViewValue = ewrpt_FormatDateTime($reportallmember->dead_date->ViewValue, 7);
			$reportallmember->dead_date->CellAttrs["style"] = "white-space: nowrap;";

			// note
			$reportallmember->note->ViewValue = $reportallmember->note->Summary;
			$reportallmember->note->CellAttrs["style"] = "white-space: nowrap;";

			// dead_id
			$reportallmember->dead_id->ViewValue = $reportallmember->dead_id->Summary;
			$reportallmember->dead_id->CellAttrs["style"] = "white-space: nowrap;";
		} else {

			// t_title
			$reportallmember->t_title->GroupViewValue = $reportallmember->t_title->GroupValue();
			$reportallmember->t_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->t_title->CellAttrs["class"] = "ewRptGrpField1";
			$reportallmember->t_title->GroupViewValue = ewrpt_DisplayGroupValue($reportallmember->t_title, $reportallmember->t_title->GroupViewValue);
			if ($reportallmember->t_title->GroupValue() == $reportallmember->t_title->GroupOldValue() && !$this->ChkLvlBreak(1))
				$reportallmember->t_title->GroupViewValue = "&nbsp;";

			// t_code
			$reportallmember->t_code->GroupViewValue = $reportallmember->t_code->GroupValue();
			$reportallmember->t_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->t_code->CellAttrs["class"] = "ewRptGrpField2";
			$reportallmember->t_code->GroupViewValue = ewrpt_DisplayGroupValue($reportallmember->t_code, $reportallmember->t_code->GroupViewValue);
			if ($reportallmember->t_code->GroupValue() == $reportallmember->t_code->GroupOldValue() && !$this->ChkLvlBreak(2))
				$reportallmember->t_code->GroupViewValue = "&nbsp;";

			// v_code
			$reportallmember->v_code->GroupViewValue = $reportallmember->v_code->GroupValue();
			$reportallmember->v_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->v_code->CellAttrs["class"] = "ewRptGrpField3";
			$reportallmember->v_code->GroupViewValue = ewrpt_DisplayGroupValue($reportallmember->v_code, $reportallmember->v_code->GroupViewValue);
			if ($reportallmember->v_code->GroupValue() == $reportallmember->v_code->GroupOldValue() && !$this->ChkLvlBreak(3))
				$reportallmember->v_code->GroupViewValue = "&nbsp;";

			// v_title
			$reportallmember->v_title->GroupViewValue = $reportallmember->v_title->GroupValue();
			$reportallmember->v_title->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->v_title->CellAttrs["class"] = "ewRptGrpField4";
			$reportallmember->v_title->GroupViewValue = ewrpt_DisplayGroupValue($reportallmember->v_title, $reportallmember->v_title->GroupViewValue);
			if ($reportallmember->v_title->GroupValue() == $reportallmember->v_title->GroupOldValue() && !$this->ChkLvlBreak(4))
				$reportallmember->v_title->GroupViewValue = "&nbsp;";

			// member_code
			$reportallmember->member_code->ViewValue = $reportallmember->member_code->CurrentValue;
			$reportallmember->member_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->member_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_status
			$reportallmember->member_status->ViewValue = $reportallmember->member_status->CurrentValue;
			$reportallmember->member_status->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->member_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// id_code
			$reportallmember->id_code->ViewValue = $reportallmember->id_code->CurrentValue;
			$reportallmember->id_code->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->id_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// gender
			$reportallmember->gender->ViewValue = $reportallmember->gender->CurrentValue;
			$reportallmember->gender->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->gender->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// prefix
			$reportallmember->prefix->ViewValue = $reportallmember->prefix->CurrentValue;
			$reportallmember->prefix->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->prefix->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$reportallmember->fname->ViewValue = $reportallmember->fname->CurrentValue;
			$reportallmember->fname->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$reportallmember->lname->ViewValue = $reportallmember->lname->CurrentValue;
			$reportallmember->lname->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// birthdate
			$reportallmember->birthdate->ViewValue = $reportallmember->birthdate->CurrentValue;
			$reportallmember->birthdate->ViewValue = ewrpt_FormatDateTime($reportallmember->birthdate->ViewValue, 7);
			$reportallmember->birthdate->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->birthdate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// age
			$reportallmember->age->ViewValue = $reportallmember->age->CurrentValue;
			$reportallmember->age->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// phone
			$reportallmember->phone->ViewValue = $reportallmember->phone->CurrentValue;
			$reportallmember->phone->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->phone->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// address
			$reportallmember->address->ViewValue = $reportallmember->address->CurrentValue;
			$reportallmember->address->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->address->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc1_name
			$reportallmember->bnfc1_name->ViewValue = $reportallmember->bnfc1_name->CurrentValue;
			$reportallmember->bnfc1_name->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->bnfc1_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc1_rel
			$reportallmember->bnfc1_rel->ViewValue = $reportallmember->bnfc1_rel->CurrentValue;
			$reportallmember->bnfc1_rel->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->bnfc1_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_name
			$reportallmember->bnfc2_name->ViewValue = $reportallmember->bnfc2_name->CurrentValue;
			$reportallmember->bnfc2_name->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->bnfc2_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_rel
			$reportallmember->bnfc2_rel->ViewValue = $reportallmember->bnfc2_rel->CurrentValue;
			$reportallmember->bnfc2_rel->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->bnfc2_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_name
			$reportallmember->bnfc3_name->ViewValue = $reportallmember->bnfc3_name->CurrentValue;
			$reportallmember->bnfc3_name->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->bnfc3_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_rel
			$reportallmember->bnfc3_rel->ViewValue = $reportallmember->bnfc3_rel->CurrentValue;
			$reportallmember->bnfc3_rel->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->bnfc3_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// regis_date
			$reportallmember->regis_date->ViewValue = $reportallmember->regis_date->CurrentValue;
			$reportallmember->regis_date->ViewValue = ewrpt_FormatDateTime($reportallmember->regis_date->ViewValue, 7);
			$reportallmember->regis_date->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->regis_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// effective_date
			$reportallmember->effective_date->ViewValue = $reportallmember->effective_date->CurrentValue;
			$reportallmember->effective_date->ViewValue = ewrpt_FormatDateTime($reportallmember->effective_date->ViewValue, 7);
			$reportallmember->effective_date->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->effective_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// resign_date
			$reportallmember->resign_date->ViewValue = $reportallmember->resign_date->CurrentValue;
			$reportallmember->resign_date->ViewValue = ewrpt_FormatDateTime($reportallmember->resign_date->ViewValue, 7);
			$reportallmember->resign_date->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->resign_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// terminate_date
			$reportallmember->terminate_date->ViewValue = $reportallmember->terminate_date->CurrentValue;
			$reportallmember->terminate_date->ViewValue = ewrpt_FormatDateTime($reportallmember->terminate_date->ViewValue, 7);
			$reportallmember->terminate_date->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->terminate_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_date
			$reportallmember->dead_date->ViewValue = $reportallmember->dead_date->CurrentValue;
			$reportallmember->dead_date->ViewValue = ewrpt_FormatDateTime($reportallmember->dead_date->ViewValue, 7);
			$reportallmember->dead_date->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->dead_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// note
			$reportallmember->note->ViewValue = $reportallmember->note->CurrentValue;
			$reportallmember->note->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->note->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_id
			$reportallmember->dead_id->ViewValue = $reportallmember->dead_id->CurrentValue;
			$reportallmember->dead_id->CellAttrs["style"] = "white-space: nowrap;";
			$reportallmember->dead_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// t_title
		$reportallmember->t_title->HrefValue = "";

		// t_code
		$reportallmember->t_code->HrefValue = "";

		// v_code
		$reportallmember->v_code->HrefValue = "";

		// v_title
		$reportallmember->v_title->HrefValue = "";

		// member_code
		if ($reportallmember->member_id->CurrentValue <> "") {
			$reportallmember->member_code->HrefValue = $reportallmember->member_id->CurrentValue;
			if ($reportallmember->Export <> "") $reportallmember->member_code->HrefValue = "";
		} else {
			$reportallmember->member_code->HrefValue = "";
		}

		// member_status
		$reportallmember->member_status->HrefValue = "";

		// id_code
		$reportallmember->id_code->HrefValue = "";

		// gender
		$reportallmember->gender->HrefValue = "";

		// prefix
		$reportallmember->prefix->HrefValue = "";

		// fname
		$reportallmember->fname->HrefValue = "";

		// lname
		$reportallmember->lname->HrefValue = "";

		// birthdate
		$reportallmember->birthdate->HrefValue = "";

		// age
		$reportallmember->age->HrefValue = "";

		// phone
		$reportallmember->phone->HrefValue = "";

		// address
		$reportallmember->address->HrefValue = "";

		// bnfc1_name
		$reportallmember->bnfc1_name->HrefValue = "";

		// bnfc1_rel
		$reportallmember->bnfc1_rel->HrefValue = "";

		// bnfc2_name
		$reportallmember->bnfc2_name->HrefValue = "";

		// bnfc2_rel
		$reportallmember->bnfc2_rel->HrefValue = "";

		// bnfc3_name
		$reportallmember->bnfc3_name->HrefValue = "";

		// bnfc3_rel
		$reportallmember->bnfc3_rel->HrefValue = "";

		// regis_date
		$reportallmember->regis_date->HrefValue = "";

		// effective_date
		$reportallmember->effective_date->HrefValue = "";

		// resign_date
		$reportallmember->resign_date->HrefValue = "";

		// terminate_date
		$reportallmember->terminate_date->HrefValue = "";

		// dead_date
		$reportallmember->dead_date->HrefValue = "";

		// note
		$reportallmember->note->HrefValue = "";

		// dead_id
		$reportallmember->dead_id->HrefValue = "";

		// Call Row_Rendered event
		$reportallmember->Row_Rendered();
	}

	// Get extended filter values
	function GetExtendedFilterValues() {
		global $reportallmember;
	}

	// Return extended filter
	function GetExtendedFilter() {
		global $reportallmember;
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
			// Field member_code

			$this->SetSessionFilterValues($reportallmember->member_code->SearchValue, $reportallmember->member_code->SearchOperator, $reportallmember->member_code->SearchCondition, $reportallmember->member_code->SearchValue2, $reportallmember->member_code->SearchOperator2, 'member_code');

			// Field id_code
			$this->SetSessionFilterValues($reportallmember->id_code->SearchValue, $reportallmember->id_code->SearchOperator, $reportallmember->id_code->SearchCondition, $reportallmember->id_code->SearchValue2, $reportallmember->id_code->SearchOperator2, 'id_code');

			// Field fname
			$this->SetSessionFilterValues($reportallmember->fname->SearchValue, $reportallmember->fname->SearchOperator, $reportallmember->fname->SearchCondition, $reportallmember->fname->SearchValue2, $reportallmember->fname->SearchOperator2, 'fname');

			// Field lname
			$this->SetSessionFilterValues($reportallmember->lname->SearchValue, $reportallmember->lname->SearchOperator, $reportallmember->lname->SearchCondition, $reportallmember->lname->SearchValue2, $reportallmember->lname->SearchOperator2, 'lname');
			$bSetupFilter = TRUE;
		} else {

			// Field member_code
			if ($this->GetFilterValues($reportallmember->member_code)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field id_code
			if ($this->GetFilterValues($reportallmember->id_code)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field fname
			if ($this->GetFilterValues($reportallmember->fname)) {
				$bSetupFilter = TRUE;
				$bRestoreSession = FALSE;
			}

			// Field lname
			if ($this->GetFilterValues($reportallmember->lname)) {
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

			// Field member_code
			$this->GetSessionFilterValues($reportallmember->member_code);

			// Field id_code
			$this->GetSessionFilterValues($reportallmember->id_code);

			// Field fname
			$this->GetSessionFilterValues($reportallmember->fname);

			// Field lname
			$this->GetSessionFilterValues($reportallmember->lname);
		}

		// Call page filter validated event
		$reportallmember->Page_FilterValidated();

		// Build SQL
		// Field member_code

		$this->BuildExtendedFilter($reportallmember->member_code, $sFilter);

		// Field id_code
		$this->BuildExtendedFilter($reportallmember->id_code, $sFilter);

		// Field fname
		$this->BuildExtendedFilter($reportallmember->fname, $sFilter);

		// Field lname
		$this->BuildExtendedFilter($reportallmember->lname, $sFilter);

		// Save parms to session
		// Field member_code

		$this->SetSessionFilterValues($reportallmember->member_code->SearchValue, $reportallmember->member_code->SearchOperator, $reportallmember->member_code->SearchCondition, $reportallmember->member_code->SearchValue2, $reportallmember->member_code->SearchOperator2, 'member_code');

		// Field id_code
		$this->SetSessionFilterValues($reportallmember->id_code->SearchValue, $reportallmember->id_code->SearchOperator, $reportallmember->id_code->SearchCondition, $reportallmember->id_code->SearchValue2, $reportallmember->id_code->SearchOperator2, 'id_code');

		// Field fname
		$this->SetSessionFilterValues($reportallmember->fname->SearchValue, $reportallmember->fname->SearchOperator, $reportallmember->fname->SearchCondition, $reportallmember->fname->SearchValue2, $reportallmember->fname->SearchOperator2, 'fname');

		// Field lname
		$this->SetSessionFilterValues($reportallmember->lname->SearchValue, $reportallmember->lname->SearchOperator, $reportallmember->lname->SearchCondition, $reportallmember->lname->SearchValue2, $reportallmember->lname->SearchOperator2, 'lname');

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
		$this->GetSessionValue($fld->DropDownValue, 'sv_reportallmember_' . $parm);
	}

	// Get filter values from session
	function GetSessionFilterValues(&$fld) {
		$parm = substr($fld->FldVar, 2);
		$this->GetSessionValue($fld->SearchValue, 'sv1_reportallmember_' . $parm);
		$this->GetSessionValue($fld->SearchOperator, 'so1_reportallmember_' . $parm);
		$this->GetSessionValue($fld->SearchCondition, 'sc_reportallmember_' . $parm);
		$this->GetSessionValue($fld->SearchValue2, 'sv2_reportallmember_' . $parm);
		$this->GetSessionValue($fld->SearchOperator2, 'so2_reportallmember_' . $parm);
	}

	// Get value from session
	function GetSessionValue(&$sv, $sn) {
		if (isset($_SESSION[$sn]))
			$sv = $_SESSION[$sn];
	}

	// Set dropdown value to session
	function SetSessionDropDownValue($sv, $parm) {
		$_SESSION['sv_reportallmember_' . $parm] = $sv;
	}

	// Set filter values to session
	function SetSessionFilterValues($sv1, $so1, $sc, $sv2, $so2, $parm) {
		$_SESSION['sv1_reportallmember_' . $parm] = $sv1;
		$_SESSION['so1_reportallmember_' . $parm] = $so1;
		$_SESSION['sc_reportallmember_' . $parm] = $sc;
		$_SESSION['sv2_reportallmember_' . $parm] = $sv2;
		$_SESSION['so2_reportallmember_' . $parm] = $so2;
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
		global $ReportLanguage, $gsFormError, $reportallmember;

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
		$_SESSION["sel_reportallmember_$parm"] = "";
		$_SESSION["rf_reportallmember_$parm"] = "";
		$_SESSION["rt_reportallmember_$parm"] = "";
	}

	// Load selection from session
	function LoadSelectionFromSession($parm) {
		global $reportallmember;
		$fld =& $reportallmember->fields($parm);
		$fld->SelectionList = @$_SESSION["sel_reportallmember_$parm"];
		$fld->RangeFrom = @$_SESSION["rf_reportallmember_$parm"];
		$fld->RangeTo = @$_SESSION["rt_reportallmember_$parm"];
	}

	// Load default value for filters
	function LoadDefaultFilters() {
		global $reportallmember;

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

		// Field member_code
		$this->SetDefaultExtFilter($reportallmember->member_code, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($reportallmember->member_code);

		// Field id_code
		$this->SetDefaultExtFilter($reportallmember->id_code, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($reportallmember->id_code);

		// Field fname
		$this->SetDefaultExtFilter($reportallmember->fname, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($reportallmember->fname);

		// Field lname
		$this->SetDefaultExtFilter($reportallmember->lname, "LIKE", NULL, 'AND', "=", NULL);
		$this->ApplyDefaultExtFilter($reportallmember->lname);

		/**
		* Set up default values for popup filters
		* NOTE: if extended filter is enabled, use default values in extended filter instead
		*/

		// Field t_code
		// Setup your default values for the popup filter below, e.g.
		// $reportallmember->t_code->DefaultSelectionList = array("val1", "val2");

		$reportallmember->t_code->DefaultSelectionList = "";
		$reportallmember->t_code->SelectionList = $reportallmember->t_code->DefaultSelectionList;

		// Field t_title
		// Setup your default values for the popup filter below, e.g.
		// $reportallmember->t_title->DefaultSelectionList = array("val1", "val2");

		$reportallmember->t_title->DefaultSelectionList = "";
		$reportallmember->t_title->SelectionList = $reportallmember->t_title->DefaultSelectionList;

		// Field v_title
		// Setup your default values for the popup filter below, e.g.
		// $reportallmember->v_title->DefaultSelectionList = array("val1", "val2");

		$reportallmember->v_title->DefaultSelectionList = "";
		$reportallmember->v_title->SelectionList = $reportallmember->v_title->DefaultSelectionList;

		// Field member_status
		// Setup your default values for the popup filter below, e.g.
		// $reportallmember->member_status->DefaultSelectionList = array("val1", "val2");

		$reportallmember->member_status->DefaultSelectionList = "";
		$reportallmember->member_status->SelectionList = $reportallmember->member_status->DefaultSelectionList;

		// Field regis_date
		// Setup your default values for the popup filter below, e.g.
		// $reportallmember->regis_date->DefaultSelectionList = array("val1", "val2");

		$reportallmember->regis_date->DefaultSelectionList = "";
		$reportallmember->regis_date->SelectionList = $reportallmember->regis_date->DefaultSelectionList;

		// Field effective_date
		// Setup your default values for the popup filter below, e.g.
		// $reportallmember->effective_date->DefaultSelectionList = array("val1", "val2");

		$reportallmember->effective_date->DefaultSelectionList = "";
		$reportallmember->effective_date->SelectionList = $reportallmember->effective_date->DefaultSelectionList;

		// Field resign_date
		// Setup your default values for the popup filter below, e.g.
		// $reportallmember->resign_date->DefaultSelectionList = array("val1", "val2");

		$reportallmember->resign_date->DefaultSelectionList = "";
		$reportallmember->resign_date->SelectionList = $reportallmember->resign_date->DefaultSelectionList;

		// Field terminate_date
		// Setup your default values for the popup filter below, e.g.
		// $reportallmember->terminate_date->DefaultSelectionList = array("val1", "val2");

		$reportallmember->terminate_date->DefaultSelectionList = "";
		$reportallmember->terminate_date->SelectionList = $reportallmember->terminate_date->DefaultSelectionList;

		// Field dead_date
		// Setup your default values for the popup filter below, e.g.
		// $reportallmember->dead_date->DefaultSelectionList = array("val1", "val2");

		$reportallmember->dead_date->DefaultSelectionList = "";
		$reportallmember->dead_date->SelectionList = $reportallmember->dead_date->DefaultSelectionList;

		// Field dead_id
		// Setup your default values for the popup filter below, e.g.
		// $reportallmember->dead_id->DefaultSelectionList = array("val1", "val2");

		$reportallmember->dead_id->DefaultSelectionList = "";
		$reportallmember->dead_id->SelectionList = $reportallmember->dead_id->DefaultSelectionList;
	}

	// Check if filter applied
	function CheckFilter() {
		global $reportallmember;

		// Check t_code popup filter
		if (!ewrpt_MatchedArray($reportallmember->t_code->DefaultSelectionList, $reportallmember->t_code->SelectionList))
			return TRUE;

		// Check t_title popup filter
		if (!ewrpt_MatchedArray($reportallmember->t_title->DefaultSelectionList, $reportallmember->t_title->SelectionList))
			return TRUE;

		// Check v_title popup filter
		if (!ewrpt_MatchedArray($reportallmember->v_title->DefaultSelectionList, $reportallmember->v_title->SelectionList))
			return TRUE;

		// Check member_code text filter
		if ($this->TextFilterApplied($reportallmember->member_code))
			return TRUE;

		// Check member_status popup filter
		if (!ewrpt_MatchedArray($reportallmember->member_status->DefaultSelectionList, $reportallmember->member_status->SelectionList))
			return TRUE;

		// Check id_code text filter
		if ($this->TextFilterApplied($reportallmember->id_code))
			return TRUE;

		// Check fname text filter
		if ($this->TextFilterApplied($reportallmember->fname))
			return TRUE;

		// Check lname text filter
		if ($this->TextFilterApplied($reportallmember->lname))
			return TRUE;

		// Check regis_date popup filter
		if (!ewrpt_MatchedArray($reportallmember->regis_date->DefaultSelectionList, $reportallmember->regis_date->SelectionList))
			return TRUE;

		// Check effective_date popup filter
		if (!ewrpt_MatchedArray($reportallmember->effective_date->DefaultSelectionList, $reportallmember->effective_date->SelectionList))
			return TRUE;

		// Check resign_date popup filter
		if (!ewrpt_MatchedArray($reportallmember->resign_date->DefaultSelectionList, $reportallmember->resign_date->SelectionList))
			return TRUE;

		// Check terminate_date popup filter
		if (!ewrpt_MatchedArray($reportallmember->terminate_date->DefaultSelectionList, $reportallmember->terminate_date->SelectionList))
			return TRUE;

		// Check dead_date popup filter
		if (!ewrpt_MatchedArray($reportallmember->dead_date->DefaultSelectionList, $reportallmember->dead_date->SelectionList))
			return TRUE;

		// Check dead_id popup filter
		if (!ewrpt_MatchedArray($reportallmember->dead_id->DefaultSelectionList, $reportallmember->dead_id->SelectionList))
			return TRUE;
		return FALSE;
	}

	// Show list of filters
	function ShowFilterList() {
		global $reportallmember;
		global $ReportLanguage;

		// Initialize
		$sFilterList = "";

		// Field t_code
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportallmember->t_code->SelectionList))
			$sWrk = ewrpt_JoinArray($reportallmember->t_code->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->t_code->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field t_title
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportallmember->t_title->SelectionList))
			$sWrk = ewrpt_JoinArray($reportallmember->t_title->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->t_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field v_title
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportallmember->v_title->SelectionList))
			$sWrk = ewrpt_JoinArray($reportallmember->v_title->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->v_title->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field member_code
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($reportallmember->member_code, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->member_code->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field member_status
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportallmember->member_status->SelectionList))
			$sWrk = ewrpt_JoinArray($reportallmember->member_status->SelectionList, ", ", EWRPT_DATATYPE_STRING);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->member_status->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field id_code
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($reportallmember->id_code, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->id_code->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field fname
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($reportallmember->fname, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->fname->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field lname
		$sExtWrk = "";
		$sWrk = "";
		$this->BuildExtendedFilter($reportallmember->lname, $sExtWrk);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->lname->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field regis_date
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportallmember->regis_date->SelectionList))
			$sWrk = ewrpt_JoinArray($reportallmember->regis_date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->regis_date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field effective_date
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportallmember->effective_date->SelectionList))
			$sWrk = ewrpt_JoinArray($reportallmember->effective_date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->effective_date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field resign_date
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportallmember->resign_date->SelectionList))
			$sWrk = ewrpt_JoinArray($reportallmember->resign_date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->resign_date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field terminate_date
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportallmember->terminate_date->SelectionList))
			$sWrk = ewrpt_JoinArray($reportallmember->terminate_date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->terminate_date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field dead_date
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportallmember->dead_date->SelectionList))
			$sWrk = ewrpt_JoinArray($reportallmember->dead_date->SelectionList, ", ", EWRPT_DATATYPE_DATE);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->dead_date->FldCaption() . "<br />";
		if ($sExtWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sExtWrk<br />";
		if ($sWrk <> "")
			$sFilterList .= "&nbsp;&nbsp;$sWrk<br />";

		// Field dead_id
		$sExtWrk = "";
		$sWrk = "";
		if (is_array($reportallmember->dead_id->SelectionList))
			$sWrk = ewrpt_JoinArray($reportallmember->dead_id->SelectionList, ", ", EWRPT_DATATYPE_NUMBER);
		if ($sExtWrk <> "" || $sWrk <> "")
			$sFilterList .= $reportallmember->dead_id->FldCaption() . "<br />";
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
		global $reportallmember;
		$sWrk = "";
			if (is_array($reportallmember->t_code->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportallmember->t_code, "`t_code`", EWRPT_DATATYPE_STRING);
			}
			if (is_array($reportallmember->t_title->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportallmember->t_title, "tambon.t_title", EWRPT_DATATYPE_STRING);
			}
			if (is_array($reportallmember->v_title->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportallmember->v_title, "village.v_title", EWRPT_DATATYPE_STRING);
			}
			if (is_array($reportallmember->member_status->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportallmember->member_status, "`member_status`", EWRPT_DATATYPE_STRING);
			}
			if (is_array($reportallmember->regis_date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportallmember->regis_date, "`regis_date`", EWRPT_DATATYPE_DATE);
			}
			if (is_array($reportallmember->effective_date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportallmember->effective_date, "`effective_date`", EWRPT_DATATYPE_DATE);
			}
			if (is_array($reportallmember->resign_date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportallmember->resign_date, "`resign_date`", EWRPT_DATATYPE_DATE);
			}
			if (is_array($reportallmember->terminate_date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportallmember->terminate_date, "`terminate_date`", EWRPT_DATATYPE_DATE);
			}
			if (is_array($reportallmember->dead_date->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportallmember->dead_date, "`dead_date`", EWRPT_DATATYPE_DATE);
			}
			if (is_array($reportallmember->dead_id->SelectionList)) {
				if ($sWrk <> "") $sWrk .= " AND ";
				$sWrk .= ewrpt_FilterSQL($reportallmember->dead_id, "`dead_id`", EWRPT_DATATYPE_NUMBER);
			}
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $reportallmember;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$reportallmember->setOrderBy("");
				$reportallmember->setStartGroup(1);
				$reportallmember->t_title->setSort("");
				$reportallmember->t_code->setSort("");
				$reportallmember->v_code->setSort("");
				$reportallmember->v_title->setSort("");
				$reportallmember->member_code->setSort("");
				$reportallmember->member_status->setSort("");
				$reportallmember->id_code->setSort("");
				$reportallmember->gender->setSort("");
				$reportallmember->prefix->setSort("");
				$reportallmember->fname->setSort("");
				$reportallmember->lname->setSort("");
				$reportallmember->birthdate->setSort("");
				$reportallmember->age->setSort("");
				$reportallmember->phone->setSort("");
				$reportallmember->address->setSort("");
				$reportallmember->bnfc1_name->setSort("");
				$reportallmember->bnfc1_rel->setSort("");
				$reportallmember->bnfc2_name->setSort("");
				$reportallmember->bnfc2_rel->setSort("");
				$reportallmember->bnfc3_name->setSort("");
				$reportallmember->bnfc3_rel->setSort("");
				$reportallmember->regis_date->setSort("");
				$reportallmember->effective_date->setSort("");
				$reportallmember->resign_date->setSort("");
				$reportallmember->terminate_date->setSort("");
				$reportallmember->dead_date->setSort("");
				$reportallmember->note->setSort("");
				$reportallmember->dead_id->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$reportallmember->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$reportallmember->CurrentOrderType = @$_GET["ordertype"];
			$reportallmember->UpdateSort($reportallmember->t_title); // t_title
			$reportallmember->UpdateSort($reportallmember->t_code); // t_code
			$reportallmember->UpdateSort($reportallmember->v_code); // v_code
			$reportallmember->UpdateSort($reportallmember->v_title); // v_title
			$reportallmember->UpdateSort($reportallmember->member_code); // member_code
			$reportallmember->UpdateSort($reportallmember->member_status); // member_status
			$reportallmember->UpdateSort($reportallmember->id_code); // id_code
			$reportallmember->UpdateSort($reportallmember->gender); // gender
			$reportallmember->UpdateSort($reportallmember->prefix); // prefix
			$reportallmember->UpdateSort($reportallmember->fname); // fname
			$reportallmember->UpdateSort($reportallmember->lname); // lname
			$reportallmember->UpdateSort($reportallmember->birthdate); // birthdate
			$reportallmember->UpdateSort($reportallmember->age); // age
			$reportallmember->UpdateSort($reportallmember->phone); // phone
			$reportallmember->UpdateSort($reportallmember->address); // address
			$reportallmember->UpdateSort($reportallmember->bnfc1_name); // bnfc1_name
			$reportallmember->UpdateSort($reportallmember->bnfc1_rel); // bnfc1_rel
			$reportallmember->UpdateSort($reportallmember->bnfc2_name); // bnfc2_name
			$reportallmember->UpdateSort($reportallmember->bnfc2_rel); // bnfc2_rel
			$reportallmember->UpdateSort($reportallmember->bnfc3_name); // bnfc3_name
			$reportallmember->UpdateSort($reportallmember->bnfc3_rel); // bnfc3_rel
			$reportallmember->UpdateSort($reportallmember->regis_date); // regis_date
			$reportallmember->UpdateSort($reportallmember->effective_date); // effective_date
			$reportallmember->UpdateSort($reportallmember->resign_date); // resign_date
			$reportallmember->UpdateSort($reportallmember->terminate_date); // terminate_date
			$reportallmember->UpdateSort($reportallmember->dead_date); // dead_date
			$reportallmember->UpdateSort($reportallmember->note); // note
			$reportallmember->UpdateSort($reportallmember->dead_id); // dead_id
			$sSortSql = $reportallmember->SortSql();
			$reportallmember->setOrderBy($sSortSql);
			$reportallmember->setStartGroup(1);
		}
		return $reportallmember->getOrderBy();
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
