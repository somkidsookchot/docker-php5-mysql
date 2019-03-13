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
$memberinfo = NULL;

//
// Table class for memberinfo
//
class crmemberinfo {
	var $TableVar = 'memberinfo';
	var $TableName = 'memberinfo';
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
	var $member_code;
	var $fname;
	var $lname;
	var $birthdate;
	var $pay_sum_total;
	var $pay_sum_type;
	var $village_id;
	var $t_id;
	var $cal_type;
	var $cal_detail;
	var $adv_num;
	var $cal_date;
	var $count_member;
	var $all_member;
	var $unit_rate;
	var $total;
	var $cal_status;
	var $invoice_senddate;
	var $invoice_duedate;
	var $notice_senddate;
	var $notice_duedate;
	var $t_title;
	var $v_title;
	var $v_code;
	var $pay_death_begin;
	var $pay_death_end;
	var $pay_annual_year;
	var $pay_sum_date;
	var $pay_sum_detail;
	var $pay_sum_adv_num;
	var $pay_sum_note;
	var $id_code;
	var $gender;
	var $prefix;
	var $age;
	var $address;
	var $t_code;
	var $phone;
	var $bnfc1_name;
	var $bnfc1_rel;
	var $bnfc2_name;
	var $bnfc2_rel;
	var $bnfc3_name;
	var $bnfc3_rel;
	var $regis_date;
	var $effective_date;
	var $resign_date;
	var $dead_date;
	var $member_status;
	var $terminate_date;
	var $dead_id;
	var $note;
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
	function crmemberinfo() {
		global $ReportLanguage;

		// member_code
		$this->member_code = new crField('memberinfo', 'memberinfo', 'x_member_code', 'member_code', 'members.member_code', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";

		// fname
		$this->fname = new crField('memberinfo', 'memberinfo', 'x_fname', 'fname', 'members.fname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";

		// lname
		$this->lname = new crField('memberinfo', 'memberinfo', 'x_lname', 'lname', 'members.lname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";

		// birthdate
		$this->birthdate = new crField('memberinfo', 'memberinfo', 'x_birthdate', 'birthdate', 'members.birthdate', 133, EWRPT_DATATYPE_DATE, 6);
		$this->birthdate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['birthdate'] =& $this->birthdate;
		$this->birthdate->DateFilter = "";
		$this->birthdate->SqlSelect = "";
		$this->birthdate->SqlOrderBy = "";

		// pay_sum_total
		$this->pay_sum_total = new crField('memberinfo', 'memberinfo', 'x_pay_sum_total', 'pay_sum_total', 'paymentsummary.pay_sum_total', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['pay_sum_total'] =& $this->pay_sum_total;
		$this->pay_sum_total->DateFilter = "";
		$this->pay_sum_total->SqlSelect = "";
		$this->pay_sum_total->SqlOrderBy = "";

		// pay_sum_type
		$this->pay_sum_type = new crField('memberinfo', 'memberinfo', 'x_pay_sum_type', 'pay_sum_type', 'paymentsummary.pay_sum_type', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_type'] =& $this->pay_sum_type;
		$this->pay_sum_type->DateFilter = "";
		$this->pay_sum_type->SqlSelect = "";
		$this->pay_sum_type->SqlOrderBy = "";

		// village_id
		$this->village_id = new crField('memberinfo', 'memberinfo', 'x_village_id', 'village_id', 'village.village_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";

		// t_id
		$this->t_id = new crField('memberinfo', 'memberinfo', 'x_t_id', 't_id', 'tambon.t_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->t_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['t_id'] =& $this->t_id;
		$this->t_id->DateFilter = "";
		$this->t_id->SqlSelect = "";
		$this->t_id->SqlOrderBy = "";

		// cal_type
		$this->cal_type = new crField('memberinfo', 'memberinfo', 'x_cal_type', 'cal_type', 'subvcalculate.cal_type', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->cal_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['cal_type'] =& $this->cal_type;
		$this->cal_type->DateFilter = "";
		$this->cal_type->SqlSelect = "";
		$this->cal_type->SqlOrderBy = "";

		// cal_detail
		$this->cal_detail = new crField('memberinfo', 'memberinfo', 'x_cal_detail', 'cal_detail', 'subvcalculate.cal_detail', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['cal_detail'] =& $this->cal_detail;
		$this->cal_detail->DateFilter = "";
		$this->cal_detail->SqlSelect = "";
		$this->cal_detail->SqlOrderBy = "";

		// adv_num
		$this->adv_num = new crField('memberinfo', 'memberinfo', 'x_adv_num', 'adv_num', 'subvcalculate.adv_num', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->adv_num->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['adv_num'] =& $this->adv_num;
		$this->adv_num->DateFilter = "";
		$this->adv_num->SqlSelect = "";
		$this->adv_num->SqlOrderBy = "";

		// cal_date
		$this->cal_date = new crField('memberinfo', 'memberinfo', 'x_cal_date', 'cal_date', 'subvcalculate.cal_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->cal_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['cal_date'] =& $this->cal_date;
		$this->cal_date->DateFilter = "";
		$this->cal_date->SqlSelect = "";
		$this->cal_date->SqlOrderBy = "";

		// count_member
		$this->count_member = new crField('memberinfo', 'memberinfo', 'x_count_member', 'count_member', 'subvcalculate.count_member', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->count_member->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['count_member'] =& $this->count_member;
		$this->count_member->DateFilter = "";
		$this->count_member->SqlSelect = "";
		$this->count_member->SqlOrderBy = "";

		// all_member
		$this->all_member = new crField('memberinfo', 'memberinfo', 'x_all_member', 'all_member', 'subvcalculate.all_member', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->all_member->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['all_member'] =& $this->all_member;
		$this->all_member->DateFilter = "";
		$this->all_member->SqlSelect = "";
		$this->all_member->SqlOrderBy = "";

		// unit_rate
		$this->unit_rate = new crField('memberinfo', 'memberinfo', 'x_unit_rate', 'unit_rate', 'subvcalculate.unit_rate', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->unit_rate->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['unit_rate'] =& $this->unit_rate;
		$this->unit_rate->DateFilter = "";
		$this->unit_rate->SqlSelect = "";
		$this->unit_rate->SqlOrderBy = "";

		// total
		$this->total = new crField('memberinfo', 'memberinfo', 'x_total', 'total', 'subvcalculate.total', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['total'] =& $this->total;
		$this->total->DateFilter = "";
		$this->total->SqlSelect = "";
		$this->total->SqlOrderBy = "";

		// cal_status
		$this->cal_status = new crField('memberinfo', 'memberinfo', 'x_cal_status', 'cal_status', 'subvcalculate.cal_status', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['cal_status'] =& $this->cal_status;
		$this->cal_status->DateFilter = "";
		$this->cal_status->SqlSelect = "";
		$this->cal_status->SqlOrderBy = "";

		// invoice_senddate
		$this->invoice_senddate = new crField('memberinfo', 'memberinfo', 'x_invoice_senddate', 'invoice_senddate', 'subvcalculate.invoice_senddate', 133, EWRPT_DATATYPE_DATE, 6);
		$this->invoice_senddate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['invoice_senddate'] =& $this->invoice_senddate;
		$this->invoice_senddate->DateFilter = "";
		$this->invoice_senddate->SqlSelect = "";
		$this->invoice_senddate->SqlOrderBy = "";

		// invoice_duedate
		$this->invoice_duedate = new crField('memberinfo', 'memberinfo', 'x_invoice_duedate', 'invoice_duedate', 'subvcalculate.invoice_duedate', 133, EWRPT_DATATYPE_DATE, 6);
		$this->invoice_duedate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['invoice_duedate'] =& $this->invoice_duedate;
		$this->invoice_duedate->DateFilter = "";
		$this->invoice_duedate->SqlSelect = "";
		$this->invoice_duedate->SqlOrderBy = "";

		// notice_senddate
		$this->notice_senddate = new crField('memberinfo', 'memberinfo', 'x_notice_senddate', 'notice_senddate', 'subvcalculate.notice_senddate', 133, EWRPT_DATATYPE_DATE, 6);
		$this->notice_senddate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['notice_senddate'] =& $this->notice_senddate;
		$this->notice_senddate->DateFilter = "";
		$this->notice_senddate->SqlSelect = "";
		$this->notice_senddate->SqlOrderBy = "";

		// notice_duedate
		$this->notice_duedate = new crField('memberinfo', 'memberinfo', 'x_notice_duedate', 'notice_duedate', 'subvcalculate.notice_duedate', 133, EWRPT_DATATYPE_DATE, 6);
		$this->notice_duedate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['notice_duedate'] =& $this->notice_duedate;
		$this->notice_duedate->DateFilter = "";
		$this->notice_duedate->SqlSelect = "";
		$this->notice_duedate->SqlOrderBy = "";

		// t_title
		$this->t_title = new crField('memberinfo', 'memberinfo', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "";
		$this->t_title->SqlOrderBy = "";

		// v_title
		$this->v_title = new crField('memberinfo', 'memberinfo', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "";
		$this->v_title->SqlOrderBy = "";

		// v_code
		$this->v_code = new crField('memberinfo', 'memberinfo', 'x_v_code', 'v_code', 'village.v_code', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->v_code->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['v_code'] =& $this->v_code;
		$this->v_code->DateFilter = "";
		$this->v_code->SqlSelect = "";
		$this->v_code->SqlOrderBy = "";

		// pay_death_begin
		$this->pay_death_begin = new crField('memberinfo', 'memberinfo', 'x_pay_death_begin', 'pay_death_begin', 'paymentsummary.pay_death_begin', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_death_begin->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_death_begin'] =& $this->pay_death_begin;
		$this->pay_death_begin->DateFilter = "";
		$this->pay_death_begin->SqlSelect = "";
		$this->pay_death_begin->SqlOrderBy = "";

		// pay_death_end
		$this->pay_death_end = new crField('memberinfo', 'memberinfo', 'x_pay_death_end', 'pay_death_end', 'paymentsummary.pay_death_end', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_death_end->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_death_end'] =& $this->pay_death_end;
		$this->pay_death_end->DateFilter = "";
		$this->pay_death_end->SqlSelect = "";
		$this->pay_death_end->SqlOrderBy = "";

		// pay_annual_year
		$this->pay_annual_year = new crField('memberinfo', 'memberinfo', 'x_pay_annual_year', 'pay_annual_year', 'paymentsummary.pay_annual_year', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pay_annual_year'] =& $this->pay_annual_year;
		$this->pay_annual_year->DateFilter = "";
		$this->pay_annual_year->SqlSelect = "";
		$this->pay_annual_year->SqlOrderBy = "";

		// pay_sum_date
		$this->pay_sum_date = new crField('memberinfo', 'memberinfo', 'x_pay_sum_date', 'pay_sum_date', 'paymentsummary.pay_sum_date', 135, EWRPT_DATATYPE_DATE, 6);
		$this->pay_sum_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['pay_sum_date'] =& $this->pay_sum_date;
		$this->pay_sum_date->DateFilter = "";
		$this->pay_sum_date->SqlSelect = "";
		$this->pay_sum_date->SqlOrderBy = "";

		// pay_sum_detail
		$this->pay_sum_detail = new crField('memberinfo', 'memberinfo', 'x_pay_sum_detail', 'pay_sum_detail', 'paymentsummary.pay_sum_detail', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pay_sum_detail'] =& $this->pay_sum_detail;
		$this->pay_sum_detail->DateFilter = "";
		$this->pay_sum_detail->SqlSelect = "";
		$this->pay_sum_detail->SqlOrderBy = "";

		// pay_sum_adv_num
		$this->pay_sum_adv_num = new crField('memberinfo', 'memberinfo', 'x_pay_sum_adv_num', 'pay_sum_adv_num', 'paymentsummary.pay_sum_adv_num', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_adv_num->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_adv_num'] =& $this->pay_sum_adv_num;
		$this->pay_sum_adv_num->DateFilter = "";
		$this->pay_sum_adv_num->SqlSelect = "";
		$this->pay_sum_adv_num->SqlOrderBy = "";

		// pay_sum_note
		$this->pay_sum_note = new crField('memberinfo', 'memberinfo', 'x_pay_sum_note', 'pay_sum_note', 'paymentsummary.pay_sum_note', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['pay_sum_note'] =& $this->pay_sum_note;
		$this->pay_sum_note->DateFilter = "";
		$this->pay_sum_note->SqlSelect = "";
		$this->pay_sum_note->SqlOrderBy = "";

		// id_code
		$this->id_code = new crField('memberinfo', 'memberinfo', 'x_id_code', 'id_code', 'members.id_code', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['id_code'] =& $this->id_code;
		$this->id_code->DateFilter = "";
		$this->id_code->SqlSelect = "";
		$this->id_code->SqlOrderBy = "";

		// gender
		$this->gender = new crField('memberinfo', 'memberinfo', 'x_gender', 'gender', 'members.gender', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['gender'] =& $this->gender;
		$this->gender->DateFilter = "";
		$this->gender->SqlSelect = "";
		$this->gender->SqlOrderBy = "";

		// prefix
		$this->prefix = new crField('memberinfo', 'memberinfo', 'x_prefix', 'prefix', 'members.prefix', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['prefix'] =& $this->prefix;
		$this->prefix->DateFilter = "";
		$this->prefix->SqlSelect = "";
		$this->prefix->SqlOrderBy = "";

		// age
		$this->age = new crField('memberinfo', 'memberinfo', 'x_age', 'age', 'members.age', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;
		$this->age->DateFilter = "";
		$this->age->SqlSelect = "";
		$this->age->SqlOrderBy = "";

		// address
		$this->address = new crField('memberinfo', 'memberinfo', 'x_address', 'address', 'members.address', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['address'] =& $this->address;
		$this->address->DateFilter = "";
		$this->address->SqlSelect = "";
		$this->address->SqlOrderBy = "";

		// t_code
		$this->t_code = new crField('memberinfo', 'memberinfo', 'x_t_code', 't_code', 'members.t_code', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";

		// phone
		$this->phone = new crField('memberinfo', 'memberinfo', 'x_phone', 'phone', 'members.phone', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['phone'] =& $this->phone;
		$this->phone->DateFilter = "";
		$this->phone->SqlSelect = "";
		$this->phone->SqlOrderBy = "";

		// bnfc1_name
		$this->bnfc1_name = new crField('memberinfo', 'memberinfo', 'x_bnfc1_name', 'bnfc1_name', 'members.bnfc1_name', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['bnfc1_name'] =& $this->bnfc1_name;
		$this->bnfc1_name->DateFilter = "";
		$this->bnfc1_name->SqlSelect = "";
		$this->bnfc1_name->SqlOrderBy = "";

		// bnfc1_rel
		$this->bnfc1_rel = new crField('memberinfo', 'memberinfo', 'x_bnfc1_rel', 'bnfc1_rel', 'members.bnfc1_rel', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_rel'] =& $this->bnfc1_rel;
		$this->bnfc1_rel->DateFilter = "";
		$this->bnfc1_rel->SqlSelect = "";
		$this->bnfc1_rel->SqlOrderBy = "";

		// bnfc2_name
		$this->bnfc2_name = new crField('memberinfo', 'memberinfo', 'x_bnfc2_name', 'bnfc2_name', 'members.bnfc2_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_name'] =& $this->bnfc2_name;
		$this->bnfc2_name->DateFilter = "";
		$this->bnfc2_name->SqlSelect = "";
		$this->bnfc2_name->SqlOrderBy = "";

		// bnfc2_rel
		$this->bnfc2_rel = new crField('memberinfo', 'memberinfo', 'x_bnfc2_rel', 'bnfc2_rel', 'members.bnfc2_rel', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_rel'] =& $this->bnfc2_rel;
		$this->bnfc2_rel->DateFilter = "";
		$this->bnfc2_rel->SqlSelect = "";
		$this->bnfc2_rel->SqlOrderBy = "";

		// bnfc3_name
		$this->bnfc3_name = new crField('memberinfo', 'memberinfo', 'x_bnfc3_name', 'bnfc3_name', 'members.bnfc3_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_name'] =& $this->bnfc3_name;
		$this->bnfc3_name->DateFilter = "";
		$this->bnfc3_name->SqlSelect = "";
		$this->bnfc3_name->SqlOrderBy = "";

		// bnfc3_rel
		$this->bnfc3_rel = new crField('memberinfo', 'memberinfo', 'x_bnfc3_rel', 'bnfc3_rel', 'members.bnfc3_rel', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_rel'] =& $this->bnfc3_rel;
		$this->bnfc3_rel->DateFilter = "";
		$this->bnfc3_rel->SqlSelect = "";
		$this->bnfc3_rel->SqlOrderBy = "";

		// regis_date
		$this->regis_date = new crField('memberinfo', 'memberinfo', 'x_regis_date', 'regis_date', 'members.regis_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->regis_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['regis_date'] =& $this->regis_date;
		$this->regis_date->DateFilter = "";
		$this->regis_date->SqlSelect = "";
		$this->regis_date->SqlOrderBy = "";

		// effective_date
		$this->effective_date = new crField('memberinfo', 'memberinfo', 'x_effective_date', 'effective_date', 'members.effective_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->effective_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['effective_date'] =& $this->effective_date;
		$this->effective_date->DateFilter = "";
		$this->effective_date->SqlSelect = "";
		$this->effective_date->SqlOrderBy = "";

		// resign_date
		$this->resign_date = new crField('memberinfo', 'memberinfo', 'x_resign_date', 'resign_date', 'members.resign_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->resign_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['resign_date'] =& $this->resign_date;
		$this->resign_date->DateFilter = "";
		$this->resign_date->SqlSelect = "";
		$this->resign_date->SqlOrderBy = "";

		// dead_date
		$this->dead_date = new crField('memberinfo', 'memberinfo', 'x_dead_date', 'dead_date', 'members.dead_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->dead_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['dead_date'] =& $this->dead_date;
		$this->dead_date->DateFilter = "";
		$this->dead_date->SqlSelect = "";
		$this->dead_date->SqlOrderBy = "";

		// member_status
		$this->member_status = new crField('memberinfo', 'memberinfo', 'x_member_status', 'member_status', 'members.member_status', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_status'] =& $this->member_status;
		$this->member_status->DateFilter = "";
		$this->member_status->SqlSelect = "";
		$this->member_status->SqlOrderBy = "";

		// terminate_date
		$this->terminate_date = new crField('memberinfo', 'memberinfo', 'x_terminate_date', 'terminate_date', 'members.terminate_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->terminate_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['terminate_date'] =& $this->terminate_date;
		$this->terminate_date->DateFilter = "";
		$this->terminate_date->SqlSelect = "";
		$this->terminate_date->SqlOrderBy = "";

		// dead_id
		$this->dead_id = new crField('memberinfo', 'memberinfo', 'x_dead_id', 'dead_id', 'members.dead_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->dead_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['dead_id'] =& $this->dead_id;
		$this->dead_id->DateFilter = "";
		$this->dead_id->SqlSelect = "";
		$this->dead_id->SqlOrderBy = "";

		// note
		$this->note = new crField('memberinfo', 'memberinfo', 'x_note', 'note', 'members.note', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['note'] =& $this->note;
		$this->note->DateFilter = "";
		$this->note->SqlSelect = "";
		$this->note->SqlOrderBy = "";
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
		return "members Inner Join paymentsummary On members.member_code = paymentsummary.member_code Inner Join village On members.village_id = village.village_id Inner Join subvcalculate On village.village_id = subvcalculate.village_id Inner Join tambon On tambon.t_id = village.v_title";
	}

	function SqlSelect() { // Select
		return "SELECT members.member_code, members.fname, members.lname, members.birthdate, paymentsummary.pay_sum_total, paymentsummary.pay_sum_type, village.village_id, members.village_id, tambon.t_id, subvcalculate.member_code, subvcalculate.cal_type, subvcalculate.cal_detail, subvcalculate.adv_num, subvcalculate.cal_date, subvcalculate.count_member, subvcalculate.all_member, subvcalculate.unit_rate, subvcalculate.total, subvcalculate.cal_status, subvcalculate.invoice_senddate, subvcalculate.invoice_duedate, subvcalculate.notice_senddate, subvcalculate.notice_duedate, tambon.t_title, village.v_title, village.v_code, paymentsummary.pay_death_begin, paymentsummary.pay_death_end, paymentsummary.pay_annual_year, paymentsummary.pay_sum_date, paymentsummary.pay_sum_detail, paymentsummary.pay_sum_adv_num, paymentsummary.pay_sum_note, members.id_code, members.gender, members.prefix, members.age, members.address, members.t_code, members.phone, members.bnfc1_name, members.bnfc1_rel, members.bnfc2_name, members.bnfc2_rel, members.bnfc3_name, members.bnfc3_rel, members.regis_date, members.effective_date, members.resign_date, members.dead_date, members.member_status, members.terminate_date, members.dead_id, members.note FROM " . $this->SqlFrom();
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
$memberinfo_rpt = new crmemberinfo_rpt();
$Page =& $memberinfo_rpt;

// Page init
$memberinfo_rpt->Page_Init();

// Page main
$memberinfo_rpt->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($memberinfo->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php $memberinfo_rpt->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $memberinfo_rpt->ShowMessage(); ?>
<?php if ($memberinfo->Export == "" || $memberinfo->Export == "print" || $memberinfo->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($memberinfo->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($memberinfo->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($memberinfo->Export == "" || $memberinfo->Export == "print" || $memberinfo->Export == "email") { ?>
<?php } ?>
<?php echo $memberinfo->TableCaption() ?>
<?php if ($memberinfo->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $memberinfo_rpt->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $memberinfo_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
<?php } ?>
<br /><br />
<?php if ($memberinfo->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($memberinfo->Export == "" || $memberinfo->Export == "print" || $memberinfo->Export == "email") { ?>
<?php } ?>
<?php if ($memberinfo->Export == "") { ?>
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
<?php if ($memberinfo->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="memberinforpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($memberinfo_rpt->StartGrp, $memberinfo_rpt->DisplayGrps, $memberinfo_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="memberinforpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="memberinforpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="memberinforpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="memberinforpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($memberinfo_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($memberinfo_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($memberinfo_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($memberinfo_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($memberinfo_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($memberinfo_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($memberinfo_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($memberinfo_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($memberinfo_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($memberinfo_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($memberinfo->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($memberinfo->ExportAll && $memberinfo->Export <> "") {
	$memberinfo_rpt->StopGrp = $memberinfo_rpt->TotalGrps;
} else {
	$memberinfo_rpt->StopGrp = $memberinfo_rpt->StartGrp + $memberinfo_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($memberinfo_rpt->StopGrp) > intval($memberinfo_rpt->TotalGrps))
	$memberinfo_rpt->StopGrp = $memberinfo_rpt->TotalGrps;
$memberinfo_rpt->RecCount = 0;

// Get first row
if ($memberinfo_rpt->TotalGrps > 0) {
	$memberinfo_rpt->GetRow(1);
	$memberinfo_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $memberinfo_rpt->GrpCount <= $memberinfo_rpt->DisplayGrps) || $memberinfo_rpt->ShowFirstHeader) {

	// Show header
	if ($memberinfo_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->member_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->member_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->member_code) ?>',1);"><?php echo $memberinfo->member_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->member_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->member_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->fname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->fname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->fname) ?>',1);"><?php echo $memberinfo->fname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->fname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->fname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->lname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->lname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->lname) ?>',1);"><?php echo $memberinfo->lname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->lname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->lname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->birthdate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->birthdate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->birthdate) ?>',1);"><?php echo $memberinfo->birthdate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->birthdate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->birthdate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->pay_sum_total) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->pay_sum_total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->pay_sum_total) ?>',1);"><?php echo $memberinfo->pay_sum_total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->pay_sum_total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->pay_sum_total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->pay_sum_type) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->pay_sum_type->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->pay_sum_type) ?>',1);"><?php echo $memberinfo->pay_sum_type->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->pay_sum_type->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->pay_sum_type->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->village_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->village_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->village_id) ?>',1);"><?php echo $memberinfo->village_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->village_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->village_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->t_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->t_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->t_id) ?>',1);"><?php echo $memberinfo->t_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->t_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->t_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->cal_type) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->cal_type->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->cal_type) ?>',1);"><?php echo $memberinfo->cal_type->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->cal_type->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->cal_type->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->adv_num) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->adv_num->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->adv_num) ?>',1);"><?php echo $memberinfo->adv_num->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->adv_num->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->adv_num->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->cal_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->cal_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->cal_date) ?>',1);"><?php echo $memberinfo->cal_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->cal_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->cal_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->count_member) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->count_member->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->count_member) ?>',1);"><?php echo $memberinfo->count_member->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->count_member->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->count_member->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->all_member) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->all_member->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->all_member) ?>',1);"><?php echo $memberinfo->all_member->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->all_member->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->all_member->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->unit_rate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->unit_rate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->unit_rate) ?>',1);"><?php echo $memberinfo->unit_rate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->unit_rate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->unit_rate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->total) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->total) ?>',1);"><?php echo $memberinfo->total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->cal_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->cal_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->cal_status) ?>',1);"><?php echo $memberinfo->cal_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->cal_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->cal_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->invoice_senddate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->invoice_senddate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->invoice_senddate) ?>',1);"><?php echo $memberinfo->invoice_senddate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->invoice_senddate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->invoice_senddate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->invoice_duedate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->invoice_duedate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->invoice_duedate) ?>',1);"><?php echo $memberinfo->invoice_duedate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->invoice_duedate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->invoice_duedate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->notice_senddate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->notice_senddate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->notice_senddate) ?>',1);"><?php echo $memberinfo->notice_senddate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->notice_senddate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->notice_senddate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->notice_duedate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->notice_duedate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->notice_duedate) ?>',1);"><?php echo $memberinfo->notice_duedate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->notice_duedate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->notice_duedate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->t_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->t_title) ?>',1);"><?php echo $memberinfo->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->v_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->v_title) ?>',1);"><?php echo $memberinfo->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->v_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->v_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->v_code) ?>',1);"><?php echo $memberinfo->v_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->v_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->v_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->pay_death_begin) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->pay_death_begin->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->pay_death_begin) ?>',1);"><?php echo $memberinfo->pay_death_begin->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->pay_death_begin->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->pay_death_begin->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->pay_death_end) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->pay_death_end->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->pay_death_end) ?>',1);"><?php echo $memberinfo->pay_death_end->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->pay_death_end->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->pay_death_end->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->pay_annual_year) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->pay_annual_year->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->pay_annual_year) ?>',1);"><?php echo $memberinfo->pay_annual_year->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->pay_annual_year->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->pay_annual_year->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->pay_sum_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->pay_sum_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->pay_sum_date) ?>',1);"><?php echo $memberinfo->pay_sum_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->pay_sum_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->pay_sum_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->pay_sum_detail) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->pay_sum_detail->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->pay_sum_detail) ?>',1);"><?php echo $memberinfo->pay_sum_detail->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->pay_sum_detail->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->pay_sum_detail->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->pay_sum_adv_num) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->pay_sum_adv_num->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->pay_sum_adv_num) ?>',1);"><?php echo $memberinfo->pay_sum_adv_num->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->pay_sum_adv_num->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->pay_sum_adv_num->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->id_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->id_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->id_code) ?>',1);"><?php echo $memberinfo->id_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->id_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->id_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->gender) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->gender->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->gender) ?>',1);"><?php echo $memberinfo->gender->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->gender->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->gender->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->prefix) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->prefix->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->prefix) ?>',1);"><?php echo $memberinfo->prefix->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->prefix->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->prefix->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->age) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->age) ?>',1);"><?php echo $memberinfo->age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->address) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->address->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->address) ?>',1);"><?php echo $memberinfo->address->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->address->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->address->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->t_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->t_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->t_code) ?>',1);"><?php echo $memberinfo->t_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->t_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->t_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->phone) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->phone->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->phone) ?>',1);"><?php echo $memberinfo->phone->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->phone->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->phone->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->bnfc1_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->bnfc1_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->bnfc1_rel) ?>',1);"><?php echo $memberinfo->bnfc1_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->bnfc1_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->bnfc1_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->bnfc2_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->bnfc2_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->bnfc2_name) ?>',1);"><?php echo $memberinfo->bnfc2_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->bnfc2_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->bnfc2_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->bnfc2_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->bnfc2_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->bnfc2_rel) ?>',1);"><?php echo $memberinfo->bnfc2_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->bnfc2_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->bnfc2_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->bnfc3_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->bnfc3_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->bnfc3_name) ?>',1);"><?php echo $memberinfo->bnfc3_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->bnfc3_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->bnfc3_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->bnfc3_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->bnfc3_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->bnfc3_rel) ?>',1);"><?php echo $memberinfo->bnfc3_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->bnfc3_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->bnfc3_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->regis_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->regis_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->regis_date) ?>',1);"><?php echo $memberinfo->regis_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->regis_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->regis_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->effective_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->effective_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->effective_date) ?>',1);"><?php echo $memberinfo->effective_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->effective_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->effective_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->resign_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->resign_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->resign_date) ?>',1);"><?php echo $memberinfo->resign_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->resign_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->resign_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->dead_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->dead_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->dead_date) ?>',1);"><?php echo $memberinfo->dead_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->dead_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->dead_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->member_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->member_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->member_status) ?>',1);"><?php echo $memberinfo->member_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->member_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->member_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->terminate_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->terminate_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->terminate_date) ?>',1);"><?php echo $memberinfo->terminate_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->terminate_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->terminate_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($memberinfo->SortUrl($memberinfo->dead_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $memberinfo->dead_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $memberinfo->SortUrl($memberinfo->dead_id) ?>',1);"><?php echo $memberinfo->dead_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($memberinfo->dead_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($memberinfo->dead_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$memberinfo_rpt->ShowFirstHeader = FALSE;
	}
	$memberinfo_rpt->RecCount++;

		// Render detail row
		$memberinfo->ResetCSS();
		$memberinfo->RowType = EWRPT_ROWTYPE_DETAIL;
		$memberinfo_rpt->RenderRow();
?>
	<tr<?php echo $memberinfo->RowAttributes(); ?>>
		<td<?php echo $memberinfo->member_code->CellAttributes() ?>>
<div<?php echo $memberinfo->member_code->ViewAttributes(); ?>><?php echo $memberinfo->member_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->fname->CellAttributes() ?>>
<div<?php echo $memberinfo->fname->ViewAttributes(); ?>><?php echo $memberinfo->fname->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->lname->CellAttributes() ?>>
<div<?php echo $memberinfo->lname->ViewAttributes(); ?>><?php echo $memberinfo->lname->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->birthdate->CellAttributes() ?>>
<div<?php echo $memberinfo->birthdate->ViewAttributes(); ?>><?php echo $memberinfo->birthdate->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->pay_sum_total->CellAttributes() ?>>
<div<?php echo $memberinfo->pay_sum_total->ViewAttributes(); ?>><?php echo $memberinfo->pay_sum_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->pay_sum_type->CellAttributes() ?>>
<div<?php echo $memberinfo->pay_sum_type->ViewAttributes(); ?>><?php echo $memberinfo->pay_sum_type->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->village_id->CellAttributes() ?>>
<div<?php echo $memberinfo->village_id->ViewAttributes(); ?>><?php echo $memberinfo->village_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->t_id->CellAttributes() ?>>
<div<?php echo $memberinfo->t_id->ViewAttributes(); ?>><?php echo $memberinfo->t_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->cal_type->CellAttributes() ?>>
<div<?php echo $memberinfo->cal_type->ViewAttributes(); ?>><?php echo $memberinfo->cal_type->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->adv_num->CellAttributes() ?>>
<div<?php echo $memberinfo->adv_num->ViewAttributes(); ?>><?php echo $memberinfo->adv_num->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->cal_date->CellAttributes() ?>>
<div<?php echo $memberinfo->cal_date->ViewAttributes(); ?>><?php echo $memberinfo->cal_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->count_member->CellAttributes() ?>>
<div<?php echo $memberinfo->count_member->ViewAttributes(); ?>><?php echo $memberinfo->count_member->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->all_member->CellAttributes() ?>>
<div<?php echo $memberinfo->all_member->ViewAttributes(); ?>><?php echo $memberinfo->all_member->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->unit_rate->CellAttributes() ?>>
<div<?php echo $memberinfo->unit_rate->ViewAttributes(); ?>><?php echo $memberinfo->unit_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->total->CellAttributes() ?>>
<div<?php echo $memberinfo->total->ViewAttributes(); ?>><?php echo $memberinfo->total->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->cal_status->CellAttributes() ?>>
<div<?php echo $memberinfo->cal_status->ViewAttributes(); ?>><?php echo $memberinfo->cal_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->invoice_senddate->CellAttributes() ?>>
<div<?php echo $memberinfo->invoice_senddate->ViewAttributes(); ?>><?php echo $memberinfo->invoice_senddate->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->invoice_duedate->CellAttributes() ?>>
<div<?php echo $memberinfo->invoice_duedate->ViewAttributes(); ?>><?php echo $memberinfo->invoice_duedate->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->notice_senddate->CellAttributes() ?>>
<div<?php echo $memberinfo->notice_senddate->ViewAttributes(); ?>><?php echo $memberinfo->notice_senddate->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->notice_duedate->CellAttributes() ?>>
<div<?php echo $memberinfo->notice_duedate->ViewAttributes(); ?>><?php echo $memberinfo->notice_duedate->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->t_title->CellAttributes() ?>>
<div<?php echo $memberinfo->t_title->ViewAttributes(); ?>><?php echo $memberinfo->t_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->v_title->CellAttributes() ?>>
<div<?php echo $memberinfo->v_title->ViewAttributes(); ?>><?php echo $memberinfo->v_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->v_code->CellAttributes() ?>>
<div<?php echo $memberinfo->v_code->ViewAttributes(); ?>><?php echo $memberinfo->v_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->pay_death_begin->CellAttributes() ?>>
<div<?php echo $memberinfo->pay_death_begin->ViewAttributes(); ?>><?php echo $memberinfo->pay_death_begin->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->pay_death_end->CellAttributes() ?>>
<div<?php echo $memberinfo->pay_death_end->ViewAttributes(); ?>><?php echo $memberinfo->pay_death_end->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->pay_annual_year->CellAttributes() ?>>
<div<?php echo $memberinfo->pay_annual_year->ViewAttributes(); ?>><?php echo $memberinfo->pay_annual_year->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->pay_sum_date->CellAttributes() ?>>
<div<?php echo $memberinfo->pay_sum_date->ViewAttributes(); ?>><?php echo $memberinfo->pay_sum_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->pay_sum_detail->CellAttributes() ?>>
<div<?php echo $memberinfo->pay_sum_detail->ViewAttributes(); ?>><?php echo $memberinfo->pay_sum_detail->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->pay_sum_adv_num->CellAttributes() ?>>
<div<?php echo $memberinfo->pay_sum_adv_num->ViewAttributes(); ?>><?php echo $memberinfo->pay_sum_adv_num->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->id_code->CellAttributes() ?>>
<div<?php echo $memberinfo->id_code->ViewAttributes(); ?>><?php echo $memberinfo->id_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->gender->CellAttributes() ?>>
<div<?php echo $memberinfo->gender->ViewAttributes(); ?>><?php echo $memberinfo->gender->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->prefix->CellAttributes() ?>>
<div<?php echo $memberinfo->prefix->ViewAttributes(); ?>><?php echo $memberinfo->prefix->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->age->CellAttributes() ?>>
<div<?php echo $memberinfo->age->ViewAttributes(); ?>><?php echo $memberinfo->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->address->CellAttributes() ?>>
<div<?php echo $memberinfo->address->ViewAttributes(); ?>><?php echo $memberinfo->address->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->t_code->CellAttributes() ?>>
<div<?php echo $memberinfo->t_code->ViewAttributes(); ?>><?php echo $memberinfo->t_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->phone->CellAttributes() ?>>
<div<?php echo $memberinfo->phone->ViewAttributes(); ?>><?php echo $memberinfo->phone->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->bnfc1_rel->CellAttributes() ?>>
<div<?php echo $memberinfo->bnfc1_rel->ViewAttributes(); ?>><?php echo $memberinfo->bnfc1_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->bnfc2_name->CellAttributes() ?>>
<div<?php echo $memberinfo->bnfc2_name->ViewAttributes(); ?>><?php echo $memberinfo->bnfc2_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->bnfc2_rel->CellAttributes() ?>>
<div<?php echo $memberinfo->bnfc2_rel->ViewAttributes(); ?>><?php echo $memberinfo->bnfc2_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->bnfc3_name->CellAttributes() ?>>
<div<?php echo $memberinfo->bnfc3_name->ViewAttributes(); ?>><?php echo $memberinfo->bnfc3_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->bnfc3_rel->CellAttributes() ?>>
<div<?php echo $memberinfo->bnfc3_rel->ViewAttributes(); ?>><?php echo $memberinfo->bnfc3_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->regis_date->CellAttributes() ?>>
<div<?php echo $memberinfo->regis_date->ViewAttributes(); ?>><?php echo $memberinfo->regis_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->effective_date->CellAttributes() ?>>
<div<?php echo $memberinfo->effective_date->ViewAttributes(); ?>><?php echo $memberinfo->effective_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->resign_date->CellAttributes() ?>>
<div<?php echo $memberinfo->resign_date->ViewAttributes(); ?>><?php echo $memberinfo->resign_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->dead_date->CellAttributes() ?>>
<div<?php echo $memberinfo->dead_date->ViewAttributes(); ?>><?php echo $memberinfo->dead_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->member_status->CellAttributes() ?>>
<div<?php echo $memberinfo->member_status->ViewAttributes(); ?>><?php echo $memberinfo->member_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->terminate_date->CellAttributes() ?>>
<div<?php echo $memberinfo->terminate_date->ViewAttributes(); ?>><?php echo $memberinfo->terminate_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $memberinfo->dead_id->CellAttributes() ?>>
<div<?php echo $memberinfo->dead_id->ViewAttributes(); ?>><?php echo $memberinfo->dead_id->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$memberinfo_rpt->AccumulateSummary();

		// Get next record
		$memberinfo_rpt->GetRow(2);
	$memberinfo_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($memberinfo_rpt->TotalGrps > 0) { ?>
<?php if ($memberinfo->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="memberinforpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($memberinfo_rpt->StartGrp, $memberinfo_rpt->DisplayGrps, $memberinfo_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="memberinforpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="memberinforpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="memberinforpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="memberinforpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($memberinfo_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($memberinfo_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($memberinfo_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($memberinfo_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($memberinfo_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($memberinfo_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($memberinfo_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($memberinfo_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($memberinfo_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($memberinfo_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($memberinfo->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($memberinfo->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($memberinfo->Export == "" || $memberinfo->Export == "print" || $memberinfo->Export == "email") { ?>
<?php } ?>
<?php if ($memberinfo->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($memberinfo->Export == "" || $memberinfo->Export == "print" || $memberinfo->Export == "email") { ?>
<?php } ?>
<?php if ($memberinfo->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $memberinfo_rpt->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($memberinfo->Export == "") { ?>
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
$memberinfo_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crmemberinfo_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'memberinfo';

	// Page object name
	var $PageObjName = 'memberinfo_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $memberinfo;
		if ($memberinfo->UseTokenInUrl) $PageUrl .= "t=" . $memberinfo->TableVar . "&"; // Add page token
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
		global $memberinfo;
		if ($memberinfo->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($memberinfo->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($memberinfo->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crmemberinfo_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (memberinfo)
		$GLOBALS["memberinfo"] = new crmemberinfo();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'memberinfo', TRUE);

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
		global $memberinfo;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$memberinfo->Export = $_GET["export"];
	}
	$gsExport = $memberinfo->Export; // Get export parameter, used in header
	$gsExportFile = $memberinfo->TableVar; // Get export file, used in header
	if ($memberinfo->Export == "excel") {
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
		global $memberinfo;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($memberinfo->Export == "email") {
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
		global $memberinfo;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 49;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

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
		$sSql = ewrpt_BuildReportSql($memberinfo->SqlSelect(), $memberinfo->SqlWhere(), $memberinfo->SqlGroupBy(), $memberinfo->SqlHaving(), $memberinfo->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($memberinfo->ExportAll && $memberinfo->Export <> "")
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
		global $memberinfo;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$memberinfo->member_code->setDbValue($rs->fields('member_code'));
			$memberinfo->fname->setDbValue($rs->fields('fname'));
			$memberinfo->lname->setDbValue($rs->fields('lname'));
			$memberinfo->birthdate->setDbValue($rs->fields('birthdate'));
			$memberinfo->pay_sum_total->setDbValue($rs->fields('pay_sum_total'));
			$memberinfo->pay_sum_type->setDbValue($rs->fields('pay_sum_type'));
			$memberinfo->village_id->setDbValue($rs->fields('village_id'));
			$memberinfo->t_id->setDbValue($rs->fields('t_id'));
			$memberinfo->cal_type->setDbValue($rs->fields('cal_type'));
			$memberinfo->cal_detail->setDbValue($rs->fields('cal_detail'));
			$memberinfo->adv_num->setDbValue($rs->fields('adv_num'));
			$memberinfo->cal_date->setDbValue($rs->fields('cal_date'));
			$memberinfo->count_member->setDbValue($rs->fields('count_member'));
			$memberinfo->all_member->setDbValue($rs->fields('all_member'));
			$memberinfo->unit_rate->setDbValue($rs->fields('unit_rate'));
			$memberinfo->total->setDbValue($rs->fields('total'));
			$memberinfo->cal_status->setDbValue($rs->fields('cal_status'));
			$memberinfo->invoice_senddate->setDbValue($rs->fields('invoice_senddate'));
			$memberinfo->invoice_duedate->setDbValue($rs->fields('invoice_duedate'));
			$memberinfo->notice_senddate->setDbValue($rs->fields('notice_senddate'));
			$memberinfo->notice_duedate->setDbValue($rs->fields('notice_duedate'));
			$memberinfo->t_title->setDbValue($rs->fields('t_title'));
			$memberinfo->v_title->setDbValue($rs->fields('v_title'));
			$memberinfo->v_code->setDbValue($rs->fields('v_code'));
			$memberinfo->pay_death_begin->setDbValue($rs->fields('pay_death_begin'));
			$memberinfo->pay_death_end->setDbValue($rs->fields('pay_death_end'));
			$memberinfo->pay_annual_year->setDbValue($rs->fields('pay_annual_year'));
			$memberinfo->pay_sum_date->setDbValue($rs->fields('pay_sum_date'));
			$memberinfo->pay_sum_detail->setDbValue($rs->fields('pay_sum_detail'));
			$memberinfo->pay_sum_adv_num->setDbValue($rs->fields('pay_sum_adv_num'));
			$memberinfo->pay_sum_note->setDbValue($rs->fields('pay_sum_note'));
			$memberinfo->id_code->setDbValue($rs->fields('id_code'));
			$memberinfo->gender->setDbValue($rs->fields('gender'));
			$memberinfo->prefix->setDbValue($rs->fields('prefix'));
			$memberinfo->age->setDbValue($rs->fields('age'));
			$memberinfo->address->setDbValue($rs->fields('address'));
			$memberinfo->t_code->setDbValue($rs->fields('t_code'));
			$memberinfo->phone->setDbValue($rs->fields('phone'));
			$memberinfo->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
			$memberinfo->bnfc1_rel->setDbValue($rs->fields('bnfc1_rel'));
			$memberinfo->bnfc2_name->setDbValue($rs->fields('bnfc2_name'));
			$memberinfo->bnfc2_rel->setDbValue($rs->fields('bnfc2_rel'));
			$memberinfo->bnfc3_name->setDbValue($rs->fields('bnfc3_name'));
			$memberinfo->bnfc3_rel->setDbValue($rs->fields('bnfc3_rel'));
			$memberinfo->regis_date->setDbValue($rs->fields('regis_date'));
			$memberinfo->effective_date->setDbValue($rs->fields('effective_date'));
			$memberinfo->resign_date->setDbValue($rs->fields('resign_date'));
			$memberinfo->dead_date->setDbValue($rs->fields('dead_date'));
			$memberinfo->member_status->setDbValue($rs->fields('member_status'));
			$memberinfo->terminate_date->setDbValue($rs->fields('terminate_date'));
			$memberinfo->dead_id->setDbValue($rs->fields('dead_id'));
			$memberinfo->note->setDbValue($rs->fields('note'));
			$this->Val[1] = $memberinfo->member_code->CurrentValue;
			$this->Val[2] = $memberinfo->fname->CurrentValue;
			$this->Val[3] = $memberinfo->lname->CurrentValue;
			$this->Val[4] = $memberinfo->birthdate->CurrentValue;
			$this->Val[5] = $memberinfo->pay_sum_total->CurrentValue;
			$this->Val[6] = $memberinfo->pay_sum_type->CurrentValue;
			$this->Val[7] = $memberinfo->village_id->CurrentValue;
			$this->Val[8] = $memberinfo->t_id->CurrentValue;
			$this->Val[9] = $memberinfo->cal_type->CurrentValue;
			$this->Val[10] = $memberinfo->adv_num->CurrentValue;
			$this->Val[11] = $memberinfo->cal_date->CurrentValue;
			$this->Val[12] = $memberinfo->count_member->CurrentValue;
			$this->Val[13] = $memberinfo->all_member->CurrentValue;
			$this->Val[14] = $memberinfo->unit_rate->CurrentValue;
			$this->Val[15] = $memberinfo->total->CurrentValue;
			$this->Val[16] = $memberinfo->cal_status->CurrentValue;
			$this->Val[17] = $memberinfo->invoice_senddate->CurrentValue;
			$this->Val[18] = $memberinfo->invoice_duedate->CurrentValue;
			$this->Val[19] = $memberinfo->notice_senddate->CurrentValue;
			$this->Val[20] = $memberinfo->notice_duedate->CurrentValue;
			$this->Val[21] = $memberinfo->t_title->CurrentValue;
			$this->Val[22] = $memberinfo->v_title->CurrentValue;
			$this->Val[23] = $memberinfo->v_code->CurrentValue;
			$this->Val[24] = $memberinfo->pay_death_begin->CurrentValue;
			$this->Val[25] = $memberinfo->pay_death_end->CurrentValue;
			$this->Val[26] = $memberinfo->pay_annual_year->CurrentValue;
			$this->Val[27] = $memberinfo->pay_sum_date->CurrentValue;
			$this->Val[28] = $memberinfo->pay_sum_detail->CurrentValue;
			$this->Val[29] = $memberinfo->pay_sum_adv_num->CurrentValue;
			$this->Val[30] = $memberinfo->id_code->CurrentValue;
			$this->Val[31] = $memberinfo->gender->CurrentValue;
			$this->Val[32] = $memberinfo->prefix->CurrentValue;
			$this->Val[33] = $memberinfo->age->CurrentValue;
			$this->Val[34] = $memberinfo->address->CurrentValue;
			$this->Val[35] = $memberinfo->t_code->CurrentValue;
			$this->Val[36] = $memberinfo->phone->CurrentValue;
			$this->Val[37] = $memberinfo->bnfc1_rel->CurrentValue;
			$this->Val[38] = $memberinfo->bnfc2_name->CurrentValue;
			$this->Val[39] = $memberinfo->bnfc2_rel->CurrentValue;
			$this->Val[40] = $memberinfo->bnfc3_name->CurrentValue;
			$this->Val[41] = $memberinfo->bnfc3_rel->CurrentValue;
			$this->Val[42] = $memberinfo->regis_date->CurrentValue;
			$this->Val[43] = $memberinfo->effective_date->CurrentValue;
			$this->Val[44] = $memberinfo->resign_date->CurrentValue;
			$this->Val[45] = $memberinfo->dead_date->CurrentValue;
			$this->Val[46] = $memberinfo->member_status->CurrentValue;
			$this->Val[47] = $memberinfo->terminate_date->CurrentValue;
			$this->Val[48] = $memberinfo->dead_id->CurrentValue;
		} else {
			$memberinfo->member_code->setDbValue("");
			$memberinfo->fname->setDbValue("");
			$memberinfo->lname->setDbValue("");
			$memberinfo->birthdate->setDbValue("");
			$memberinfo->pay_sum_total->setDbValue("");
			$memberinfo->pay_sum_type->setDbValue("");
			$memberinfo->village_id->setDbValue("");
			$memberinfo->t_id->setDbValue("");
			$memberinfo->cal_type->setDbValue("");
			$memberinfo->cal_detail->setDbValue("");
			$memberinfo->adv_num->setDbValue("");
			$memberinfo->cal_date->setDbValue("");
			$memberinfo->count_member->setDbValue("");
			$memberinfo->all_member->setDbValue("");
			$memberinfo->unit_rate->setDbValue("");
			$memberinfo->total->setDbValue("");
			$memberinfo->cal_status->setDbValue("");
			$memberinfo->invoice_senddate->setDbValue("");
			$memberinfo->invoice_duedate->setDbValue("");
			$memberinfo->notice_senddate->setDbValue("");
			$memberinfo->notice_duedate->setDbValue("");
			$memberinfo->t_title->setDbValue("");
			$memberinfo->v_title->setDbValue("");
			$memberinfo->v_code->setDbValue("");
			$memberinfo->pay_death_begin->setDbValue("");
			$memberinfo->pay_death_end->setDbValue("");
			$memberinfo->pay_annual_year->setDbValue("");
			$memberinfo->pay_sum_date->setDbValue("");
			$memberinfo->pay_sum_detail->setDbValue("");
			$memberinfo->pay_sum_adv_num->setDbValue("");
			$memberinfo->pay_sum_note->setDbValue("");
			$memberinfo->id_code->setDbValue("");
			$memberinfo->gender->setDbValue("");
			$memberinfo->prefix->setDbValue("");
			$memberinfo->age->setDbValue("");
			$memberinfo->address->setDbValue("");
			$memberinfo->t_code->setDbValue("");
			$memberinfo->phone->setDbValue("");
			$memberinfo->bnfc1_name->setDbValue("");
			$memberinfo->bnfc1_rel->setDbValue("");
			$memberinfo->bnfc2_name->setDbValue("");
			$memberinfo->bnfc2_rel->setDbValue("");
			$memberinfo->bnfc3_name->setDbValue("");
			$memberinfo->bnfc3_rel->setDbValue("");
			$memberinfo->regis_date->setDbValue("");
			$memberinfo->effective_date->setDbValue("");
			$memberinfo->resign_date->setDbValue("");
			$memberinfo->dead_date->setDbValue("");
			$memberinfo->member_status->setDbValue("");
			$memberinfo->terminate_date->setDbValue("");
			$memberinfo->dead_id->setDbValue("");
			$memberinfo->note->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $memberinfo;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$memberinfo->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$memberinfo->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $memberinfo->getStartGroup();
			}
		} else {
			$this->StartGrp = $memberinfo->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$memberinfo->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$memberinfo->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$memberinfo->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $memberinfo;

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
		global $memberinfo;
		$this->StartGrp = 1;
		$memberinfo->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $memberinfo;
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
			$memberinfo->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$memberinfo->setStartGroup($this->StartGrp);
		} else {
			if ($memberinfo->getGroupPerPage() <> "") {
				$this->DisplayGrps = $memberinfo->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $memberinfo;
		if ($memberinfo->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($memberinfo->SqlSelectCount(), $memberinfo->SqlWhere(), $memberinfo->SqlGroupBy(), $memberinfo->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$memberinfo->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($memberinfo->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// member_code
			$memberinfo->member_code->ViewValue = $memberinfo->member_code->Summary;

			// fname
			$memberinfo->fname->ViewValue = $memberinfo->fname->Summary;

			// lname
			$memberinfo->lname->ViewValue = $memberinfo->lname->Summary;

			// birthdate
			$memberinfo->birthdate->ViewValue = $memberinfo->birthdate->Summary;
			$memberinfo->birthdate->ViewValue = ewrpt_FormatDateTime($memberinfo->birthdate->ViewValue, 6);

			// pay_sum_total
			$memberinfo->pay_sum_total->ViewValue = $memberinfo->pay_sum_total->Summary;

			// pay_sum_type
			$memberinfo->pay_sum_type->ViewValue = $memberinfo->pay_sum_type->Summary;

			// village_id
			$memberinfo->village_id->ViewValue = $memberinfo->village_id->Summary;

			// t_id
			$memberinfo->t_id->ViewValue = $memberinfo->t_id->Summary;

			// cal_type
			$memberinfo->cal_type->ViewValue = $memberinfo->cal_type->Summary;

			// adv_num
			$memberinfo->adv_num->ViewValue = $memberinfo->adv_num->Summary;

			// cal_date
			$memberinfo->cal_date->ViewValue = $memberinfo->cal_date->Summary;
			$memberinfo->cal_date->ViewValue = ewrpt_FormatDateTime($memberinfo->cal_date->ViewValue, 6);

			// count_member
			$memberinfo->count_member->ViewValue = $memberinfo->count_member->Summary;

			// all_member
			$memberinfo->all_member->ViewValue = $memberinfo->all_member->Summary;

			// unit_rate
			$memberinfo->unit_rate->ViewValue = $memberinfo->unit_rate->Summary;

			// total
			$memberinfo->total->ViewValue = $memberinfo->total->Summary;

			// cal_status
			$memberinfo->cal_status->ViewValue = $memberinfo->cal_status->Summary;

			// invoice_senddate
			$memberinfo->invoice_senddate->ViewValue = $memberinfo->invoice_senddate->Summary;
			$memberinfo->invoice_senddate->ViewValue = ewrpt_FormatDateTime($memberinfo->invoice_senddate->ViewValue, 6);

			// invoice_duedate
			$memberinfo->invoice_duedate->ViewValue = $memberinfo->invoice_duedate->Summary;
			$memberinfo->invoice_duedate->ViewValue = ewrpt_FormatDateTime($memberinfo->invoice_duedate->ViewValue, 6);

			// notice_senddate
			$memberinfo->notice_senddate->ViewValue = $memberinfo->notice_senddate->Summary;
			$memberinfo->notice_senddate->ViewValue = ewrpt_FormatDateTime($memberinfo->notice_senddate->ViewValue, 6);

			// notice_duedate
			$memberinfo->notice_duedate->ViewValue = $memberinfo->notice_duedate->Summary;
			$memberinfo->notice_duedate->ViewValue = ewrpt_FormatDateTime($memberinfo->notice_duedate->ViewValue, 6);

			// t_title
			$memberinfo->t_title->ViewValue = $memberinfo->t_title->Summary;

			// v_title
			$memberinfo->v_title->ViewValue = $memberinfo->v_title->Summary;

			// v_code
			$memberinfo->v_code->ViewValue = $memberinfo->v_code->Summary;

			// pay_death_begin
			$memberinfo->pay_death_begin->ViewValue = $memberinfo->pay_death_begin->Summary;

			// pay_death_end
			$memberinfo->pay_death_end->ViewValue = $memberinfo->pay_death_end->Summary;

			// pay_annual_year
			$memberinfo->pay_annual_year->ViewValue = $memberinfo->pay_annual_year->Summary;

			// pay_sum_date
			$memberinfo->pay_sum_date->ViewValue = $memberinfo->pay_sum_date->Summary;
			$memberinfo->pay_sum_date->ViewValue = ewrpt_FormatDateTime($memberinfo->pay_sum_date->ViewValue, 6);

			// pay_sum_detail
			$memberinfo->pay_sum_detail->ViewValue = $memberinfo->pay_sum_detail->Summary;

			// pay_sum_adv_num
			$memberinfo->pay_sum_adv_num->ViewValue = $memberinfo->pay_sum_adv_num->Summary;

			// id_code
			$memberinfo->id_code->ViewValue = $memberinfo->id_code->Summary;

			// gender
			$memberinfo->gender->ViewValue = $memberinfo->gender->Summary;

			// prefix
			$memberinfo->prefix->ViewValue = $memberinfo->prefix->Summary;

			// age
			$memberinfo->age->ViewValue = $memberinfo->age->Summary;

			// address
			$memberinfo->address->ViewValue = $memberinfo->address->Summary;

			// t_code
			$memberinfo->t_code->ViewValue = $memberinfo->t_code->Summary;

			// phone
			$memberinfo->phone->ViewValue = $memberinfo->phone->Summary;

			// bnfc1_rel
			$memberinfo->bnfc1_rel->ViewValue = $memberinfo->bnfc1_rel->Summary;

			// bnfc2_name
			$memberinfo->bnfc2_name->ViewValue = $memberinfo->bnfc2_name->Summary;

			// bnfc2_rel
			$memberinfo->bnfc2_rel->ViewValue = $memberinfo->bnfc2_rel->Summary;

			// bnfc3_name
			$memberinfo->bnfc3_name->ViewValue = $memberinfo->bnfc3_name->Summary;

			// bnfc3_rel
			$memberinfo->bnfc3_rel->ViewValue = $memberinfo->bnfc3_rel->Summary;

			// regis_date
			$memberinfo->regis_date->ViewValue = $memberinfo->regis_date->Summary;
			$memberinfo->regis_date->ViewValue = ewrpt_FormatDateTime($memberinfo->regis_date->ViewValue, 6);

			// effective_date
			$memberinfo->effective_date->ViewValue = $memberinfo->effective_date->Summary;
			$memberinfo->effective_date->ViewValue = ewrpt_FormatDateTime($memberinfo->effective_date->ViewValue, 6);

			// resign_date
			$memberinfo->resign_date->ViewValue = $memberinfo->resign_date->Summary;
			$memberinfo->resign_date->ViewValue = ewrpt_FormatDateTime($memberinfo->resign_date->ViewValue, 6);

			// dead_date
			$memberinfo->dead_date->ViewValue = $memberinfo->dead_date->Summary;
			$memberinfo->dead_date->ViewValue = ewrpt_FormatDateTime($memberinfo->dead_date->ViewValue, 6);

			// member_status
			$memberinfo->member_status->ViewValue = $memberinfo->member_status->Summary;

			// terminate_date
			$memberinfo->terminate_date->ViewValue = $memberinfo->terminate_date->Summary;
			$memberinfo->terminate_date->ViewValue = ewrpt_FormatDateTime($memberinfo->terminate_date->ViewValue, 6);

			// dead_id
			$memberinfo->dead_id->ViewValue = $memberinfo->dead_id->Summary;
		} else {

			// member_code
			$memberinfo->member_code->ViewValue = $memberinfo->member_code->CurrentValue;
			$memberinfo->member_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$memberinfo->fname->ViewValue = $memberinfo->fname->CurrentValue;
			$memberinfo->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$memberinfo->lname->ViewValue = $memberinfo->lname->CurrentValue;
			$memberinfo->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// birthdate
			$memberinfo->birthdate->ViewValue = $memberinfo->birthdate->CurrentValue;
			$memberinfo->birthdate->ViewValue = ewrpt_FormatDateTime($memberinfo->birthdate->ViewValue, 6);
			$memberinfo->birthdate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_total
			$memberinfo->pay_sum_total->ViewValue = $memberinfo->pay_sum_total->CurrentValue;
			$memberinfo->pay_sum_total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_type
			$memberinfo->pay_sum_type->ViewValue = $memberinfo->pay_sum_type->CurrentValue;
			$memberinfo->pay_sum_type->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// village_id
			$memberinfo->village_id->ViewValue = $memberinfo->village_id->CurrentValue;
			$memberinfo->village_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_id
			$memberinfo->t_id->ViewValue = $memberinfo->t_id->CurrentValue;
			$memberinfo->t_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// cal_type
			$memberinfo->cal_type->ViewValue = $memberinfo->cal_type->CurrentValue;
			$memberinfo->cal_type->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// adv_num
			$memberinfo->adv_num->ViewValue = $memberinfo->adv_num->CurrentValue;
			$memberinfo->adv_num->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// cal_date
			$memberinfo->cal_date->ViewValue = $memberinfo->cal_date->CurrentValue;
			$memberinfo->cal_date->ViewValue = ewrpt_FormatDateTime($memberinfo->cal_date->ViewValue, 6);
			$memberinfo->cal_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// count_member
			$memberinfo->count_member->ViewValue = $memberinfo->count_member->CurrentValue;
			$memberinfo->count_member->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// all_member
			$memberinfo->all_member->ViewValue = $memberinfo->all_member->CurrentValue;
			$memberinfo->all_member->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// unit_rate
			$memberinfo->unit_rate->ViewValue = $memberinfo->unit_rate->CurrentValue;
			$memberinfo->unit_rate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// total
			$memberinfo->total->ViewValue = $memberinfo->total->CurrentValue;
			$memberinfo->total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// cal_status
			$memberinfo->cal_status->ViewValue = $memberinfo->cal_status->CurrentValue;
			$memberinfo->cal_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// invoice_senddate
			$memberinfo->invoice_senddate->ViewValue = $memberinfo->invoice_senddate->CurrentValue;
			$memberinfo->invoice_senddate->ViewValue = ewrpt_FormatDateTime($memberinfo->invoice_senddate->ViewValue, 6);
			$memberinfo->invoice_senddate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// invoice_duedate
			$memberinfo->invoice_duedate->ViewValue = $memberinfo->invoice_duedate->CurrentValue;
			$memberinfo->invoice_duedate->ViewValue = ewrpt_FormatDateTime($memberinfo->invoice_duedate->ViewValue, 6);
			$memberinfo->invoice_duedate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// notice_senddate
			$memberinfo->notice_senddate->ViewValue = $memberinfo->notice_senddate->CurrentValue;
			$memberinfo->notice_senddate->ViewValue = ewrpt_FormatDateTime($memberinfo->notice_senddate->ViewValue, 6);
			$memberinfo->notice_senddate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// notice_duedate
			$memberinfo->notice_duedate->ViewValue = $memberinfo->notice_duedate->CurrentValue;
			$memberinfo->notice_duedate->ViewValue = ewrpt_FormatDateTime($memberinfo->notice_duedate->ViewValue, 6);
			$memberinfo->notice_duedate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_title
			$memberinfo->t_title->ViewValue = $memberinfo->t_title->CurrentValue;
			$memberinfo->t_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_title
			$memberinfo->v_title->ViewValue = $memberinfo->v_title->CurrentValue;
			$memberinfo->v_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_code
			$memberinfo->v_code->ViewValue = $memberinfo->v_code->CurrentValue;
			$memberinfo->v_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_death_begin
			$memberinfo->pay_death_begin->ViewValue = $memberinfo->pay_death_begin->CurrentValue;
			$memberinfo->pay_death_begin->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_death_end
			$memberinfo->pay_death_end->ViewValue = $memberinfo->pay_death_end->CurrentValue;
			$memberinfo->pay_death_end->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_annual_year
			$memberinfo->pay_annual_year->ViewValue = $memberinfo->pay_annual_year->CurrentValue;
			$memberinfo->pay_annual_year->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_date
			$memberinfo->pay_sum_date->ViewValue = $memberinfo->pay_sum_date->CurrentValue;
			$memberinfo->pay_sum_date->ViewValue = ewrpt_FormatDateTime($memberinfo->pay_sum_date->ViewValue, 6);
			$memberinfo->pay_sum_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_detail
			$memberinfo->pay_sum_detail->ViewValue = $memberinfo->pay_sum_detail->CurrentValue;
			$memberinfo->pay_sum_detail->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_adv_num
			$memberinfo->pay_sum_adv_num->ViewValue = $memberinfo->pay_sum_adv_num->CurrentValue;
			$memberinfo->pay_sum_adv_num->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// id_code
			$memberinfo->id_code->ViewValue = $memberinfo->id_code->CurrentValue;
			$memberinfo->id_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// gender
			$memberinfo->gender->ViewValue = $memberinfo->gender->CurrentValue;
			$memberinfo->gender->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// prefix
			$memberinfo->prefix->ViewValue = $memberinfo->prefix->CurrentValue;
			$memberinfo->prefix->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// age
			$memberinfo->age->ViewValue = $memberinfo->age->CurrentValue;
			$memberinfo->age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// address
			$memberinfo->address->ViewValue = $memberinfo->address->CurrentValue;
			$memberinfo->address->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_code
			$memberinfo->t_code->ViewValue = $memberinfo->t_code->CurrentValue;
			$memberinfo->t_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// phone
			$memberinfo->phone->ViewValue = $memberinfo->phone->CurrentValue;
			$memberinfo->phone->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc1_rel
			$memberinfo->bnfc1_rel->ViewValue = $memberinfo->bnfc1_rel->CurrentValue;
			$memberinfo->bnfc1_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_name
			$memberinfo->bnfc2_name->ViewValue = $memberinfo->bnfc2_name->CurrentValue;
			$memberinfo->bnfc2_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_rel
			$memberinfo->bnfc2_rel->ViewValue = $memberinfo->bnfc2_rel->CurrentValue;
			$memberinfo->bnfc2_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_name
			$memberinfo->bnfc3_name->ViewValue = $memberinfo->bnfc3_name->CurrentValue;
			$memberinfo->bnfc3_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_rel
			$memberinfo->bnfc3_rel->ViewValue = $memberinfo->bnfc3_rel->CurrentValue;
			$memberinfo->bnfc3_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// regis_date
			$memberinfo->regis_date->ViewValue = $memberinfo->regis_date->CurrentValue;
			$memberinfo->regis_date->ViewValue = ewrpt_FormatDateTime($memberinfo->regis_date->ViewValue, 6);
			$memberinfo->regis_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// effective_date
			$memberinfo->effective_date->ViewValue = $memberinfo->effective_date->CurrentValue;
			$memberinfo->effective_date->ViewValue = ewrpt_FormatDateTime($memberinfo->effective_date->ViewValue, 6);
			$memberinfo->effective_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// resign_date
			$memberinfo->resign_date->ViewValue = $memberinfo->resign_date->CurrentValue;
			$memberinfo->resign_date->ViewValue = ewrpt_FormatDateTime($memberinfo->resign_date->ViewValue, 6);
			$memberinfo->resign_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_date
			$memberinfo->dead_date->ViewValue = $memberinfo->dead_date->CurrentValue;
			$memberinfo->dead_date->ViewValue = ewrpt_FormatDateTime($memberinfo->dead_date->ViewValue, 6);
			$memberinfo->dead_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_status
			$memberinfo->member_status->ViewValue = $memberinfo->member_status->CurrentValue;
			$memberinfo->member_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// terminate_date
			$memberinfo->terminate_date->ViewValue = $memberinfo->terminate_date->CurrentValue;
			$memberinfo->terminate_date->ViewValue = ewrpt_FormatDateTime($memberinfo->terminate_date->ViewValue, 6);
			$memberinfo->terminate_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_id
			$memberinfo->dead_id->ViewValue = $memberinfo->dead_id->CurrentValue;
			$memberinfo->dead_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// member_code
		$memberinfo->member_code->HrefValue = "";

		// fname
		$memberinfo->fname->HrefValue = "";

		// lname
		$memberinfo->lname->HrefValue = "";

		// birthdate
		$memberinfo->birthdate->HrefValue = "";

		// pay_sum_total
		$memberinfo->pay_sum_total->HrefValue = "";

		// pay_sum_type
		$memberinfo->pay_sum_type->HrefValue = "";

		// village_id
		$memberinfo->village_id->HrefValue = "";

		// t_id
		$memberinfo->t_id->HrefValue = "";

		// cal_type
		$memberinfo->cal_type->HrefValue = "";

		// adv_num
		$memberinfo->adv_num->HrefValue = "";

		// cal_date
		$memberinfo->cal_date->HrefValue = "";

		// count_member
		$memberinfo->count_member->HrefValue = "";

		// all_member
		$memberinfo->all_member->HrefValue = "";

		// unit_rate
		$memberinfo->unit_rate->HrefValue = "";

		// total
		$memberinfo->total->HrefValue = "";

		// cal_status
		$memberinfo->cal_status->HrefValue = "";

		// invoice_senddate
		$memberinfo->invoice_senddate->HrefValue = "";

		// invoice_duedate
		$memberinfo->invoice_duedate->HrefValue = "";

		// notice_senddate
		$memberinfo->notice_senddate->HrefValue = "";

		// notice_duedate
		$memberinfo->notice_duedate->HrefValue = "";

		// t_title
		$memberinfo->t_title->HrefValue = "";

		// v_title
		$memberinfo->v_title->HrefValue = "";

		// v_code
		$memberinfo->v_code->HrefValue = "";

		// pay_death_begin
		$memberinfo->pay_death_begin->HrefValue = "";

		// pay_death_end
		$memberinfo->pay_death_end->HrefValue = "";

		// pay_annual_year
		$memberinfo->pay_annual_year->HrefValue = "";

		// pay_sum_date
		$memberinfo->pay_sum_date->HrefValue = "";

		// pay_sum_detail
		$memberinfo->pay_sum_detail->HrefValue = "";

		// pay_sum_adv_num
		$memberinfo->pay_sum_adv_num->HrefValue = "";

		// id_code
		$memberinfo->id_code->HrefValue = "";

		// gender
		$memberinfo->gender->HrefValue = "";

		// prefix
		$memberinfo->prefix->HrefValue = "";

		// age
		$memberinfo->age->HrefValue = "";

		// address
		$memberinfo->address->HrefValue = "";

		// t_code
		$memberinfo->t_code->HrefValue = "";

		// phone
		$memberinfo->phone->HrefValue = "";

		// bnfc1_rel
		$memberinfo->bnfc1_rel->HrefValue = "";

		// bnfc2_name
		$memberinfo->bnfc2_name->HrefValue = "";

		// bnfc2_rel
		$memberinfo->bnfc2_rel->HrefValue = "";

		// bnfc3_name
		$memberinfo->bnfc3_name->HrefValue = "";

		// bnfc3_rel
		$memberinfo->bnfc3_rel->HrefValue = "";

		// regis_date
		$memberinfo->regis_date->HrefValue = "";

		// effective_date
		$memberinfo->effective_date->HrefValue = "";

		// resign_date
		$memberinfo->resign_date->HrefValue = "";

		// dead_date
		$memberinfo->dead_date->HrefValue = "";

		// member_status
		$memberinfo->member_status->HrefValue = "";

		// terminate_date
		$memberinfo->terminate_date->HrefValue = "";

		// dead_id
		$memberinfo->dead_id->HrefValue = "";

		// Call Row_Rendered event
		$memberinfo->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $memberinfo;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $memberinfo;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$memberinfo->setOrderBy("");
				$memberinfo->setStartGroup(1);
				$memberinfo->member_code->setSort("");
				$memberinfo->fname->setSort("");
				$memberinfo->lname->setSort("");
				$memberinfo->birthdate->setSort("");
				$memberinfo->pay_sum_total->setSort("");
				$memberinfo->pay_sum_type->setSort("");
				$memberinfo->village_id->setSort("");
				$memberinfo->t_id->setSort("");
				$memberinfo->cal_type->setSort("");
				$memberinfo->adv_num->setSort("");
				$memberinfo->cal_date->setSort("");
				$memberinfo->count_member->setSort("");
				$memberinfo->all_member->setSort("");
				$memberinfo->unit_rate->setSort("");
				$memberinfo->total->setSort("");
				$memberinfo->cal_status->setSort("");
				$memberinfo->invoice_senddate->setSort("");
				$memberinfo->invoice_duedate->setSort("");
				$memberinfo->notice_senddate->setSort("");
				$memberinfo->notice_duedate->setSort("");
				$memberinfo->t_title->setSort("");
				$memberinfo->v_title->setSort("");
				$memberinfo->v_code->setSort("");
				$memberinfo->pay_death_begin->setSort("");
				$memberinfo->pay_death_end->setSort("");
				$memberinfo->pay_annual_year->setSort("");
				$memberinfo->pay_sum_date->setSort("");
				$memberinfo->pay_sum_detail->setSort("");
				$memberinfo->pay_sum_adv_num->setSort("");
				$memberinfo->id_code->setSort("");
				$memberinfo->gender->setSort("");
				$memberinfo->prefix->setSort("");
				$memberinfo->age->setSort("");
				$memberinfo->address->setSort("");
				$memberinfo->t_code->setSort("");
				$memberinfo->phone->setSort("");
				$memberinfo->bnfc1_rel->setSort("");
				$memberinfo->bnfc2_name->setSort("");
				$memberinfo->bnfc2_rel->setSort("");
				$memberinfo->bnfc3_name->setSort("");
				$memberinfo->bnfc3_rel->setSort("");
				$memberinfo->regis_date->setSort("");
				$memberinfo->effective_date->setSort("");
				$memberinfo->resign_date->setSort("");
				$memberinfo->dead_date->setSort("");
				$memberinfo->member_status->setSort("");
				$memberinfo->terminate_date->setSort("");
				$memberinfo->dead_id->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$memberinfo->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$memberinfo->CurrentOrderType = @$_GET["ordertype"];
			$memberinfo->UpdateSort($memberinfo->member_code); // member_code
			$memberinfo->UpdateSort($memberinfo->fname); // fname
			$memberinfo->UpdateSort($memberinfo->lname); // lname
			$memberinfo->UpdateSort($memberinfo->birthdate); // birthdate
			$memberinfo->UpdateSort($memberinfo->pay_sum_total); // pay_sum_total
			$memberinfo->UpdateSort($memberinfo->pay_sum_type); // pay_sum_type
			$memberinfo->UpdateSort($memberinfo->village_id); // village_id
			$memberinfo->UpdateSort($memberinfo->t_id); // t_id
			$memberinfo->UpdateSort($memberinfo->cal_type); // cal_type
			$memberinfo->UpdateSort($memberinfo->adv_num); // adv_num
			$memberinfo->UpdateSort($memberinfo->cal_date); // cal_date
			$memberinfo->UpdateSort($memberinfo->count_member); // count_member
			$memberinfo->UpdateSort($memberinfo->all_member); // all_member
			$memberinfo->UpdateSort($memberinfo->unit_rate); // unit_rate
			$memberinfo->UpdateSort($memberinfo->total); // total
			$memberinfo->UpdateSort($memberinfo->cal_status); // cal_status
			$memberinfo->UpdateSort($memberinfo->invoice_senddate); // invoice_senddate
			$memberinfo->UpdateSort($memberinfo->invoice_duedate); // invoice_duedate
			$memberinfo->UpdateSort($memberinfo->notice_senddate); // notice_senddate
			$memberinfo->UpdateSort($memberinfo->notice_duedate); // notice_duedate
			$memberinfo->UpdateSort($memberinfo->t_title); // t_title
			$memberinfo->UpdateSort($memberinfo->v_title); // v_title
			$memberinfo->UpdateSort($memberinfo->v_code); // v_code
			$memberinfo->UpdateSort($memberinfo->pay_death_begin); // pay_death_begin
			$memberinfo->UpdateSort($memberinfo->pay_death_end); // pay_death_end
			$memberinfo->UpdateSort($memberinfo->pay_annual_year); // pay_annual_year
			$memberinfo->UpdateSort($memberinfo->pay_sum_date); // pay_sum_date
			$memberinfo->UpdateSort($memberinfo->pay_sum_detail); // pay_sum_detail
			$memberinfo->UpdateSort($memberinfo->pay_sum_adv_num); // pay_sum_adv_num
			$memberinfo->UpdateSort($memberinfo->id_code); // id_code
			$memberinfo->UpdateSort($memberinfo->gender); // gender
			$memberinfo->UpdateSort($memberinfo->prefix); // prefix
			$memberinfo->UpdateSort($memberinfo->age); // age
			$memberinfo->UpdateSort($memberinfo->address); // address
			$memberinfo->UpdateSort($memberinfo->t_code); // t_code
			$memberinfo->UpdateSort($memberinfo->phone); // phone
			$memberinfo->UpdateSort($memberinfo->bnfc1_rel); // bnfc1_rel
			$memberinfo->UpdateSort($memberinfo->bnfc2_name); // bnfc2_name
			$memberinfo->UpdateSort($memberinfo->bnfc2_rel); // bnfc2_rel
			$memberinfo->UpdateSort($memberinfo->bnfc3_name); // bnfc3_name
			$memberinfo->UpdateSort($memberinfo->bnfc3_rel); // bnfc3_rel
			$memberinfo->UpdateSort($memberinfo->regis_date); // regis_date
			$memberinfo->UpdateSort($memberinfo->effective_date); // effective_date
			$memberinfo->UpdateSort($memberinfo->resign_date); // resign_date
			$memberinfo->UpdateSort($memberinfo->dead_date); // dead_date
			$memberinfo->UpdateSort($memberinfo->member_status); // member_status
			$memberinfo->UpdateSort($memberinfo->terminate_date); // terminate_date
			$memberinfo->UpdateSort($memberinfo->dead_id); // dead_id
			$sSortSql = $memberinfo->SortSql();
			$memberinfo->setOrderBy($sSortSql);
			$memberinfo->setStartGroup(1);
		}
		return $memberinfo->getOrderBy();
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
