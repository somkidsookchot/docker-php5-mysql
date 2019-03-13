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
$reportmemberinfo = NULL;

//
// Table class for reportmemberinfo
//
class crreportmemberinfo {
	var $TableVar = 'reportmemberinfo';
	var $TableName = 'reportmemberinfo';
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
	function crreportmemberinfo() {
		global $ReportLanguage;

		// member_code
		$this->member_code = new crField('reportmemberinfo', 'reportmemberinfo', 'x_member_code', 'member_code', 'members.member_code', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";
		$this->member_code->FldGroupByType = "";
		$this->member_code->FldGroupInt = "0";
		$this->member_code->FldGroupSql = "";

		// fname
		$this->fname = new crField('reportmemberinfo', 'reportmemberinfo', 'x_fname', 'fname', 'members.fname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";
		$this->fname->FldGroupByType = "";
		$this->fname->FldGroupInt = "0";
		$this->fname->FldGroupSql = "";

		// lname
		$this->lname = new crField('reportmemberinfo', 'reportmemberinfo', 'x_lname', 'lname', 'members.lname', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";
		$this->lname->FldGroupByType = "";
		$this->lname->FldGroupInt = "0";
		$this->lname->FldGroupSql = "";

		// birthdate
		$this->birthdate = new crField('reportmemberinfo', 'reportmemberinfo', 'x_birthdate', 'birthdate', 'members.birthdate', 133, EWRPT_DATATYPE_DATE, 6);
		$this->birthdate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['birthdate'] =& $this->birthdate;
		$this->birthdate->DateFilter = "";
		$this->birthdate->SqlSelect = "";
		$this->birthdate->SqlOrderBy = "";
		$this->birthdate->FldGroupByType = "";
		$this->birthdate->FldGroupInt = "0";
		$this->birthdate->FldGroupSql = "";

		// pay_sum_total
		$this->pay_sum_total = new crField('reportmemberinfo', 'reportmemberinfo', 'x_pay_sum_total', 'pay_sum_total', 'paymentsummary.pay_sum_total', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['pay_sum_total'] =& $this->pay_sum_total;
		$this->pay_sum_total->DateFilter = "";
		$this->pay_sum_total->SqlSelect = "";
		$this->pay_sum_total->SqlOrderBy = "";
		$this->pay_sum_total->FldGroupByType = "";
		$this->pay_sum_total->FldGroupInt = "0";
		$this->pay_sum_total->FldGroupSql = "";

		// pay_sum_type
		$this->pay_sum_type = new crField('reportmemberinfo', 'reportmemberinfo', 'x_pay_sum_type', 'pay_sum_type', 'paymentsummary.pay_sum_type', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_type->GroupingFieldId = 1;
		$this->pay_sum_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_type'] =& $this->pay_sum_type;
		$this->pay_sum_type->DateFilter = "";
		$this->pay_sum_type->SqlSelect = "";
		$this->pay_sum_type->SqlOrderBy = "";
		$this->pay_sum_type->FldGroupByType = "";
		$this->pay_sum_type->FldGroupInt = "0";
		$this->pay_sum_type->FldGroupSql = "";

		// village_id
		$this->village_id = new crField('reportmemberinfo', 'reportmemberinfo', 'x_village_id', 'village_id', 'village.village_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";
		$this->village_id->FldGroupByType = "";
		$this->village_id->FldGroupInt = "0";
		$this->village_id->FldGroupSql = "";

		// t_id
		$this->t_id = new crField('reportmemberinfo', 'reportmemberinfo', 'x_t_id', 't_id', 'tambon.t_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->t_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['t_id'] =& $this->t_id;
		$this->t_id->DateFilter = "";
		$this->t_id->SqlSelect = "";
		$this->t_id->SqlOrderBy = "";
		$this->t_id->FldGroupByType = "";
		$this->t_id->FldGroupInt = "0";
		$this->t_id->FldGroupSql = "";

		// cal_type
		$this->cal_type = new crField('reportmemberinfo', 'reportmemberinfo', 'x_cal_type', 'cal_type', 'subvcalculate.cal_type', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->cal_type->GroupingFieldId = 2;
		$this->cal_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['cal_type'] =& $this->cal_type;
		$this->cal_type->DateFilter = "";
		$this->cal_type->SqlSelect = "";
		$this->cal_type->SqlOrderBy = "";
		$this->cal_type->FldGroupByType = "";
		$this->cal_type->FldGroupInt = "0";
		$this->cal_type->FldGroupSql = "";

		// cal_detail
		$this->cal_detail = new crField('reportmemberinfo', 'reportmemberinfo', 'x_cal_detail', 'cal_detail', 'subvcalculate.cal_detail', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['cal_detail'] =& $this->cal_detail;
		$this->cal_detail->DateFilter = "";
		$this->cal_detail->SqlSelect = "";
		$this->cal_detail->SqlOrderBy = "";
		$this->cal_detail->FldGroupByType = "";
		$this->cal_detail->FldGroupInt = "0";
		$this->cal_detail->FldGroupSql = "";

		// adv_num
		$this->adv_num = new crField('reportmemberinfo', 'reportmemberinfo', 'x_adv_num', 'adv_num', 'subvcalculate.adv_num', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->adv_num->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['adv_num'] =& $this->adv_num;
		$this->adv_num->DateFilter = "";
		$this->adv_num->SqlSelect = "";
		$this->adv_num->SqlOrderBy = "";
		$this->adv_num->FldGroupByType = "";
		$this->adv_num->FldGroupInt = "0";
		$this->adv_num->FldGroupSql = "";

		// cal_date
		$this->cal_date = new crField('reportmemberinfo', 'reportmemberinfo', 'x_cal_date', 'cal_date', 'subvcalculate.cal_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->cal_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['cal_date'] =& $this->cal_date;
		$this->cal_date->DateFilter = "";
		$this->cal_date->SqlSelect = "";
		$this->cal_date->SqlOrderBy = "";
		$this->cal_date->FldGroupByType = "";
		$this->cal_date->FldGroupInt = "0";
		$this->cal_date->FldGroupSql = "";

		// count_member
		$this->count_member = new crField('reportmemberinfo', 'reportmemberinfo', 'x_count_member', 'count_member', 'subvcalculate.count_member', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->count_member->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['count_member'] =& $this->count_member;
		$this->count_member->DateFilter = "";
		$this->count_member->SqlSelect = "";
		$this->count_member->SqlOrderBy = "";
		$this->count_member->FldGroupByType = "";
		$this->count_member->FldGroupInt = "0";
		$this->count_member->FldGroupSql = "";

		// all_member
		$this->all_member = new crField('reportmemberinfo', 'reportmemberinfo', 'x_all_member', 'all_member', 'subvcalculate.all_member', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->all_member->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['all_member'] =& $this->all_member;
		$this->all_member->DateFilter = "";
		$this->all_member->SqlSelect = "";
		$this->all_member->SqlOrderBy = "";
		$this->all_member->FldGroupByType = "";
		$this->all_member->FldGroupInt = "0";
		$this->all_member->FldGroupSql = "";

		// unit_rate
		$this->unit_rate = new crField('reportmemberinfo', 'reportmemberinfo', 'x_unit_rate', 'unit_rate', 'subvcalculate.unit_rate', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->unit_rate->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['unit_rate'] =& $this->unit_rate;
		$this->unit_rate->DateFilter = "";
		$this->unit_rate->SqlSelect = "";
		$this->unit_rate->SqlOrderBy = "";
		$this->unit_rate->FldGroupByType = "";
		$this->unit_rate->FldGroupInt = "0";
		$this->unit_rate->FldGroupSql = "";

		// total
		$this->total = new crField('reportmemberinfo', 'reportmemberinfo', 'x_total', 'total', 'subvcalculate.total', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->total->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['total'] =& $this->total;
		$this->total->DateFilter = "";
		$this->total->SqlSelect = "";
		$this->total->SqlOrderBy = "";
		$this->total->FldGroupByType = "";
		$this->total->FldGroupInt = "0";
		$this->total->FldGroupSql = "";

		// cal_status
		$this->cal_status = new crField('reportmemberinfo', 'reportmemberinfo', 'x_cal_status', 'cal_status', 'subvcalculate.cal_status', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['cal_status'] =& $this->cal_status;
		$this->cal_status->DateFilter = "";
		$this->cal_status->SqlSelect = "";
		$this->cal_status->SqlOrderBy = "";
		$this->cal_status->FldGroupByType = "";
		$this->cal_status->FldGroupInt = "0";
		$this->cal_status->FldGroupSql = "";

		// invoice_senddate
		$this->invoice_senddate = new crField('reportmemberinfo', 'reportmemberinfo', 'x_invoice_senddate', 'invoice_senddate', 'subvcalculate.invoice_senddate', 133, EWRPT_DATATYPE_DATE, 6);
		$this->invoice_senddate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['invoice_senddate'] =& $this->invoice_senddate;
		$this->invoice_senddate->DateFilter = "";
		$this->invoice_senddate->SqlSelect = "";
		$this->invoice_senddate->SqlOrderBy = "";
		$this->invoice_senddate->FldGroupByType = "";
		$this->invoice_senddate->FldGroupInt = "0";
		$this->invoice_senddate->FldGroupSql = "";

		// invoice_duedate
		$this->invoice_duedate = new crField('reportmemberinfo', 'reportmemberinfo', 'x_invoice_duedate', 'invoice_duedate', 'subvcalculate.invoice_duedate', 133, EWRPT_DATATYPE_DATE, 6);
		$this->invoice_duedate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['invoice_duedate'] =& $this->invoice_duedate;
		$this->invoice_duedate->DateFilter = "";
		$this->invoice_duedate->SqlSelect = "";
		$this->invoice_duedate->SqlOrderBy = "";
		$this->invoice_duedate->FldGroupByType = "";
		$this->invoice_duedate->FldGroupInt = "0";
		$this->invoice_duedate->FldGroupSql = "";

		// notice_senddate
		$this->notice_senddate = new crField('reportmemberinfo', 'reportmemberinfo', 'x_notice_senddate', 'notice_senddate', 'subvcalculate.notice_senddate', 133, EWRPT_DATATYPE_DATE, 6);
		$this->notice_senddate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['notice_senddate'] =& $this->notice_senddate;
		$this->notice_senddate->DateFilter = "";
		$this->notice_senddate->SqlSelect = "";
		$this->notice_senddate->SqlOrderBy = "";
		$this->notice_senddate->FldGroupByType = "";
		$this->notice_senddate->FldGroupInt = "0";
		$this->notice_senddate->FldGroupSql = "";

		// notice_duedate
		$this->notice_duedate = new crField('reportmemberinfo', 'reportmemberinfo', 'x_notice_duedate', 'notice_duedate', 'subvcalculate.notice_duedate', 133, EWRPT_DATATYPE_DATE, 6);
		$this->notice_duedate->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['notice_duedate'] =& $this->notice_duedate;
		$this->notice_duedate->DateFilter = "";
		$this->notice_duedate->SqlSelect = "";
		$this->notice_duedate->SqlOrderBy = "";
		$this->notice_duedate->FldGroupByType = "";
		$this->notice_duedate->FldGroupInt = "0";
		$this->notice_duedate->FldGroupSql = "";

		// t_title
		$this->t_title = new crField('reportmemberinfo', 'reportmemberinfo', 'x_t_title', 't_title', 'tambon.t_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "";
		$this->t_title->SqlOrderBy = "";
		$this->t_title->FldGroupByType = "";
		$this->t_title->FldGroupInt = "0";
		$this->t_title->FldGroupSql = "";

		// v_title
		$this->v_title = new crField('reportmemberinfo', 'reportmemberinfo', 'x_v_title', 'v_title', 'village.v_title', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "";
		$this->v_title->SqlOrderBy = "";
		$this->v_title->FldGroupByType = "";
		$this->v_title->FldGroupInt = "0";
		$this->v_title->FldGroupSql = "";

		// v_code
		$this->v_code = new crField('reportmemberinfo', 'reportmemberinfo', 'x_v_code', 'v_code', 'village.v_code', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->v_code->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['v_code'] =& $this->v_code;
		$this->v_code->DateFilter = "";
		$this->v_code->SqlSelect = "";
		$this->v_code->SqlOrderBy = "";
		$this->v_code->FldGroupByType = "";
		$this->v_code->FldGroupInt = "0";
		$this->v_code->FldGroupSql = "";

		// pay_death_begin
		$this->pay_death_begin = new crField('reportmemberinfo', 'reportmemberinfo', 'x_pay_death_begin', 'pay_death_begin', 'paymentsummary.pay_death_begin', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_death_begin->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_death_begin'] =& $this->pay_death_begin;
		$this->pay_death_begin->DateFilter = "";
		$this->pay_death_begin->SqlSelect = "";
		$this->pay_death_begin->SqlOrderBy = "";
		$this->pay_death_begin->FldGroupByType = "";
		$this->pay_death_begin->FldGroupInt = "0";
		$this->pay_death_begin->FldGroupSql = "";

		// pay_death_end
		$this->pay_death_end = new crField('reportmemberinfo', 'reportmemberinfo', 'x_pay_death_end', 'pay_death_end', 'paymentsummary.pay_death_end', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_death_end->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_death_end'] =& $this->pay_death_end;
		$this->pay_death_end->DateFilter = "";
		$this->pay_death_end->SqlSelect = "";
		$this->pay_death_end->SqlOrderBy = "";
		$this->pay_death_end->FldGroupByType = "";
		$this->pay_death_end->FldGroupInt = "0";
		$this->pay_death_end->FldGroupSql = "";

		// pay_annual_year
		$this->pay_annual_year = new crField('reportmemberinfo', 'reportmemberinfo', 'x_pay_annual_year', 'pay_annual_year', 'paymentsummary.pay_annual_year', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pay_annual_year'] =& $this->pay_annual_year;
		$this->pay_annual_year->DateFilter = "";
		$this->pay_annual_year->SqlSelect = "";
		$this->pay_annual_year->SqlOrderBy = "";
		$this->pay_annual_year->FldGroupByType = "";
		$this->pay_annual_year->FldGroupInt = "0";
		$this->pay_annual_year->FldGroupSql = "";

		// pay_sum_date
		$this->pay_sum_date = new crField('reportmemberinfo', 'reportmemberinfo', 'x_pay_sum_date', 'pay_sum_date', 'paymentsummary.pay_sum_date', 135, EWRPT_DATATYPE_DATE, 6);
		$this->pay_sum_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['pay_sum_date'] =& $this->pay_sum_date;
		$this->pay_sum_date->DateFilter = "";
		$this->pay_sum_date->SqlSelect = "";
		$this->pay_sum_date->SqlOrderBy = "";
		$this->pay_sum_date->FldGroupByType = "";
		$this->pay_sum_date->FldGroupInt = "0";
		$this->pay_sum_date->FldGroupSql = "";

		// pay_sum_detail
		$this->pay_sum_detail = new crField('reportmemberinfo', 'reportmemberinfo', 'x_pay_sum_detail', 'pay_sum_detail', 'paymentsummary.pay_sum_detail', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['pay_sum_detail'] =& $this->pay_sum_detail;
		$this->pay_sum_detail->DateFilter = "";
		$this->pay_sum_detail->SqlSelect = "";
		$this->pay_sum_detail->SqlOrderBy = "";
		$this->pay_sum_detail->FldGroupByType = "";
		$this->pay_sum_detail->FldGroupInt = "0";
		$this->pay_sum_detail->FldGroupSql = "";

		// pay_sum_adv_num
		$this->pay_sum_adv_num = new crField('reportmemberinfo', 'reportmemberinfo', 'x_pay_sum_adv_num', 'pay_sum_adv_num', 'paymentsummary.pay_sum_adv_num', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->pay_sum_adv_num->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pay_sum_adv_num'] =& $this->pay_sum_adv_num;
		$this->pay_sum_adv_num->DateFilter = "";
		$this->pay_sum_adv_num->SqlSelect = "";
		$this->pay_sum_adv_num->SqlOrderBy = "";
		$this->pay_sum_adv_num->FldGroupByType = "";
		$this->pay_sum_adv_num->FldGroupInt = "0";
		$this->pay_sum_adv_num->FldGroupSql = "";

		// pay_sum_note
		$this->pay_sum_note = new crField('reportmemberinfo', 'reportmemberinfo', 'x_pay_sum_note', 'pay_sum_note', 'paymentsummary.pay_sum_note', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['pay_sum_note'] =& $this->pay_sum_note;
		$this->pay_sum_note->DateFilter = "";
		$this->pay_sum_note->SqlSelect = "";
		$this->pay_sum_note->SqlOrderBy = "";
		$this->pay_sum_note->FldGroupByType = "";
		$this->pay_sum_note->FldGroupInt = "0";
		$this->pay_sum_note->FldGroupSql = "";

		// id_code
		$this->id_code = new crField('reportmemberinfo', 'reportmemberinfo', 'x_id_code', 'id_code', 'members.id_code', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['id_code'] =& $this->id_code;
		$this->id_code->DateFilter = "";
		$this->id_code->SqlSelect = "";
		$this->id_code->SqlOrderBy = "";
		$this->id_code->FldGroupByType = "";
		$this->id_code->FldGroupInt = "0";
		$this->id_code->FldGroupSql = "";

		// gender
		$this->gender = new crField('reportmemberinfo', 'reportmemberinfo', 'x_gender', 'gender', 'members.gender', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['gender'] =& $this->gender;
		$this->gender->DateFilter = "";
		$this->gender->SqlSelect = "";
		$this->gender->SqlOrderBy = "";
		$this->gender->FldGroupByType = "";
		$this->gender->FldGroupInt = "0";
		$this->gender->FldGroupSql = "";

		// prefix
		$this->prefix = new crField('reportmemberinfo', 'reportmemberinfo', 'x_prefix', 'prefix', 'members.prefix', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['prefix'] =& $this->prefix;
		$this->prefix->DateFilter = "";
		$this->prefix->SqlSelect = "";
		$this->prefix->SqlOrderBy = "";
		$this->prefix->FldGroupByType = "";
		$this->prefix->FldGroupInt = "0";
		$this->prefix->FldGroupSql = "";

		// age
		$this->age = new crField('reportmemberinfo', 'reportmemberinfo', 'x_age', 'age', 'members.age', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;
		$this->age->DateFilter = "";
		$this->age->SqlSelect = "";
		$this->age->SqlOrderBy = "";
		$this->age->FldGroupByType = "";
		$this->age->FldGroupInt = "0";
		$this->age->FldGroupSql = "";

		// address
		$this->address = new crField('reportmemberinfo', 'reportmemberinfo', 'x_address', 'address', 'members.address', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['address'] =& $this->address;
		$this->address->DateFilter = "";
		$this->address->SqlSelect = "";
		$this->address->SqlOrderBy = "";
		$this->address->FldGroupByType = "";
		$this->address->FldGroupInt = "0";
		$this->address->FldGroupSql = "";

		// t_code
		$this->t_code = new crField('reportmemberinfo', 'reportmemberinfo', 'x_t_code', 't_code', 'members.t_code', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";
		$this->t_code->FldGroupByType = "";
		$this->t_code->FldGroupInt = "0";
		$this->t_code->FldGroupSql = "";

		// phone
		$this->phone = new crField('reportmemberinfo', 'reportmemberinfo', 'x_phone', 'phone', 'members.phone', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['phone'] =& $this->phone;
		$this->phone->DateFilter = "";
		$this->phone->SqlSelect = "";
		$this->phone->SqlOrderBy = "";
		$this->phone->FldGroupByType = "";
		$this->phone->FldGroupInt = "0";
		$this->phone->FldGroupSql = "";

		// bnfc1_name
		$this->bnfc1_name = new crField('reportmemberinfo', 'reportmemberinfo', 'x_bnfc1_name', 'bnfc1_name', 'members.bnfc1_name', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['bnfc1_name'] =& $this->bnfc1_name;
		$this->bnfc1_name->DateFilter = "";
		$this->bnfc1_name->SqlSelect = "";
		$this->bnfc1_name->SqlOrderBy = "";
		$this->bnfc1_name->FldGroupByType = "";
		$this->bnfc1_name->FldGroupInt = "0";
		$this->bnfc1_name->FldGroupSql = "";

		// bnfc1_rel
		$this->bnfc1_rel = new crField('reportmemberinfo', 'reportmemberinfo', 'x_bnfc1_rel', 'bnfc1_rel', 'members.bnfc1_rel', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_rel'] =& $this->bnfc1_rel;
		$this->bnfc1_rel->DateFilter = "";
		$this->bnfc1_rel->SqlSelect = "";
		$this->bnfc1_rel->SqlOrderBy = "";
		$this->bnfc1_rel->FldGroupByType = "";
		$this->bnfc1_rel->FldGroupInt = "0";
		$this->bnfc1_rel->FldGroupSql = "";

		// bnfc2_name
		$this->bnfc2_name = new crField('reportmemberinfo', 'reportmemberinfo', 'x_bnfc2_name', 'bnfc2_name', 'members.bnfc2_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_name'] =& $this->bnfc2_name;
		$this->bnfc2_name->DateFilter = "";
		$this->bnfc2_name->SqlSelect = "";
		$this->bnfc2_name->SqlOrderBy = "";
		$this->bnfc2_name->FldGroupByType = "";
		$this->bnfc2_name->FldGroupInt = "0";
		$this->bnfc2_name->FldGroupSql = "";

		// bnfc2_rel
		$this->bnfc2_rel = new crField('reportmemberinfo', 'reportmemberinfo', 'x_bnfc2_rel', 'bnfc2_rel', 'members.bnfc2_rel', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_rel'] =& $this->bnfc2_rel;
		$this->bnfc2_rel->DateFilter = "";
		$this->bnfc2_rel->SqlSelect = "";
		$this->bnfc2_rel->SqlOrderBy = "";
		$this->bnfc2_rel->FldGroupByType = "";
		$this->bnfc2_rel->FldGroupInt = "0";
		$this->bnfc2_rel->FldGroupSql = "";

		// bnfc3_name
		$this->bnfc3_name = new crField('reportmemberinfo', 'reportmemberinfo', 'x_bnfc3_name', 'bnfc3_name', 'members.bnfc3_name', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_name'] =& $this->bnfc3_name;
		$this->bnfc3_name->DateFilter = "";
		$this->bnfc3_name->SqlSelect = "";
		$this->bnfc3_name->SqlOrderBy = "";
		$this->bnfc3_name->FldGroupByType = "";
		$this->bnfc3_name->FldGroupInt = "0";
		$this->bnfc3_name->FldGroupSql = "";

		// bnfc3_rel
		$this->bnfc3_rel = new crField('reportmemberinfo', 'reportmemberinfo', 'x_bnfc3_rel', 'bnfc3_rel', 'members.bnfc3_rel', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_rel'] =& $this->bnfc3_rel;
		$this->bnfc3_rel->DateFilter = "";
		$this->bnfc3_rel->SqlSelect = "";
		$this->bnfc3_rel->SqlOrderBy = "";
		$this->bnfc3_rel->FldGroupByType = "";
		$this->bnfc3_rel->FldGroupInt = "0";
		$this->bnfc3_rel->FldGroupSql = "";

		// regis_date
		$this->regis_date = new crField('reportmemberinfo', 'reportmemberinfo', 'x_regis_date', 'regis_date', 'members.regis_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->regis_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['regis_date'] =& $this->regis_date;
		$this->regis_date->DateFilter = "";
		$this->regis_date->SqlSelect = "";
		$this->regis_date->SqlOrderBy = "";
		$this->regis_date->FldGroupByType = "";
		$this->regis_date->FldGroupInt = "0";
		$this->regis_date->FldGroupSql = "";

		// effective_date
		$this->effective_date = new crField('reportmemberinfo', 'reportmemberinfo', 'x_effective_date', 'effective_date', 'members.effective_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->effective_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['effective_date'] =& $this->effective_date;
		$this->effective_date->DateFilter = "";
		$this->effective_date->SqlSelect = "";
		$this->effective_date->SqlOrderBy = "";
		$this->effective_date->FldGroupByType = "";
		$this->effective_date->FldGroupInt = "0";
		$this->effective_date->FldGroupSql = "";

		// resign_date
		$this->resign_date = new crField('reportmemberinfo', 'reportmemberinfo', 'x_resign_date', 'resign_date', 'members.resign_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->resign_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['resign_date'] =& $this->resign_date;
		$this->resign_date->DateFilter = "";
		$this->resign_date->SqlSelect = "";
		$this->resign_date->SqlOrderBy = "";
		$this->resign_date->FldGroupByType = "";
		$this->resign_date->FldGroupInt = "0";
		$this->resign_date->FldGroupSql = "";

		// dead_date
		$this->dead_date = new crField('reportmemberinfo', 'reportmemberinfo', 'x_dead_date', 'dead_date', 'members.dead_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->dead_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['dead_date'] =& $this->dead_date;
		$this->dead_date->DateFilter = "";
		$this->dead_date->SqlSelect = "";
		$this->dead_date->SqlOrderBy = "";
		$this->dead_date->FldGroupByType = "";
		$this->dead_date->FldGroupInt = "0";
		$this->dead_date->FldGroupSql = "";

		// member_status
		$this->member_status = new crField('reportmemberinfo', 'reportmemberinfo', 'x_member_status', 'member_status', 'members.member_status', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_status'] =& $this->member_status;
		$this->member_status->DateFilter = "";
		$this->member_status->SqlSelect = "";
		$this->member_status->SqlOrderBy = "";
		$this->member_status->FldGroupByType = "";
		$this->member_status->FldGroupInt = "0";
		$this->member_status->FldGroupSql = "";

		// terminate_date
		$this->terminate_date = new crField('reportmemberinfo', 'reportmemberinfo', 'x_terminate_date', 'terminate_date', 'members.terminate_date', 133, EWRPT_DATATYPE_DATE, 6);
		$this->terminate_date->FldDefaultErrMsg = str_replace("%s", "/", $ReportLanguage->Phrase("IncorrectDateMDY"));
		$this->fields['terminate_date'] =& $this->terminate_date;
		$this->terminate_date->DateFilter = "";
		$this->terminate_date->SqlSelect = "";
		$this->terminate_date->SqlOrderBy = "";
		$this->terminate_date->FldGroupByType = "";
		$this->terminate_date->FldGroupInt = "0";
		$this->terminate_date->FldGroupSql = "";

		// dead_id
		$this->dead_id = new crField('reportmemberinfo', 'reportmemberinfo', 'x_dead_id', 'dead_id', 'members.dead_id', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->dead_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['dead_id'] =& $this->dead_id;
		$this->dead_id->DateFilter = "";
		$this->dead_id->SqlSelect = "";
		$this->dead_id->SqlOrderBy = "";
		$this->dead_id->FldGroupByType = "";
		$this->dead_id->FldGroupInt = "0";
		$this->dead_id->FldGroupSql = "";

		// note
		$this->note = new crField('reportmemberinfo', 'reportmemberinfo', 'x_note', 'note', 'members.note', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['note'] =& $this->note;
		$this->note->DateFilter = "";
		$this->note->SqlSelect = "";
		$this->note->SqlOrderBy = "";
		$this->note->FldGroupByType = "";
		$this->note->FldGroupInt = "0";
		$this->note->FldGroupSql = "";
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
		return "paymentsummary.pay_sum_type ASC, subvcalculate.cal_type ASC";
	}

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "paymentsummary.pay_sum_type";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " AS `pay_sum_type` FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "paymentsummary.pay_sum_type ASC";
	}

	function SqlSelectAgg() {
		return "SELECT SUM(paymentsummary.pay_sum_total) AS sum_pay_sum_total, SUM(subvcalculate.total) AS sum_total FROM " . $this->SqlFrom();
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
$reportmemberinfo_summary = new crreportmemberinfo_summary();
$Page =& $reportmemberinfo_summary;

// Page init
$reportmemberinfo_summary->Page_Init();

// Page main
$reportmemberinfo_summary->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($reportmemberinfo->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php $reportmemberinfo_summary->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $reportmemberinfo_summary->ShowMessage(); ?>
<?php if ($reportmemberinfo->Export == "" || $reportmemberinfo->Export == "print" || $reportmemberinfo->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($reportmemberinfo->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($reportmemberinfo->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($reportmemberinfo->Export == "" || $reportmemberinfo->Export == "print" || $reportmemberinfo->Export == "email") { ?>
<?php } ?>
<?php echo $reportmemberinfo->TableCaption() ?>
<?php if ($reportmemberinfo->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $reportmemberinfo_summary->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $reportmemberinfo_summary->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
<?php } ?>
<br /><br />
<?php if ($reportmemberinfo->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($reportmemberinfo->Export == "" || $reportmemberinfo->Export == "print" || $reportmemberinfo->Export == "email") { ?>
<?php } ?>
<?php if ($reportmemberinfo->Export == "") { ?>
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
<?php if ($reportmemberinfo->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="reportmemberinfosmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportmemberinfo_summary->StartGrp, $reportmemberinfo_summary->DisplayGrps, $reportmemberinfo_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportmemberinfosmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportmemberinfosmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportmemberinfosmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportmemberinfosmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($reportmemberinfo_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportmemberinfo_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportmemberinfo_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportmemberinfo_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportmemberinfo_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportmemberinfo_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportmemberinfo_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportmemberinfo_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportmemberinfo_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportmemberinfo_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportmemberinfo->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
if ($reportmemberinfo->ExportAll && $reportmemberinfo->Export <> "") {
	$reportmemberinfo_summary->StopGrp = $reportmemberinfo_summary->TotalGrps;
} else {
	$reportmemberinfo_summary->StopGrp = $reportmemberinfo_summary->StartGrp + $reportmemberinfo_summary->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($reportmemberinfo_summary->StopGrp) > intval($reportmemberinfo_summary->TotalGrps))
	$reportmemberinfo_summary->StopGrp = $reportmemberinfo_summary->TotalGrps;
$reportmemberinfo_summary->RecCount = 0;

// Get first row
if ($reportmemberinfo_summary->TotalGrps > 0) {
	$reportmemberinfo_summary->GetGrpRow(1);
	$reportmemberinfo_summary->GrpCount = 1;
}
while (($rsgrp && !$rsgrp->EOF && $reportmemberinfo_summary->GrpCount <= $reportmemberinfo_summary->DisplayGrps) || $reportmemberinfo_summary->ShowFirstHeader) {

	// Show header
	if ($reportmemberinfo_summary->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->pay_sum_type) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->pay_sum_type->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->pay_sum_type) ?>',1);"><?php echo $reportmemberinfo->pay_sum_type->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->pay_sum_type->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->pay_sum_type->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->cal_type) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->cal_type->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->cal_type) ?>',1);"><?php echo $reportmemberinfo->cal_type->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->cal_type->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->cal_type->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->member_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->member_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->member_code) ?>',1);"><?php echo $reportmemberinfo->member_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->member_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->member_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->fname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->fname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->fname) ?>',1);"><?php echo $reportmemberinfo->fname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->fname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->fname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->lname) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->lname->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->lname) ?>',1);"><?php echo $reportmemberinfo->lname->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->lname->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->lname->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->birthdate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->birthdate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->birthdate) ?>',1);"><?php echo $reportmemberinfo->birthdate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->birthdate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->birthdate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->pay_sum_total) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->pay_sum_total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->pay_sum_total) ?>',1);"><?php echo $reportmemberinfo->pay_sum_total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->pay_sum_total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->pay_sum_total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->cal_detail) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->cal_detail->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->cal_detail) ?>',1);"><?php echo $reportmemberinfo->cal_detail->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->cal_detail->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->cal_detail->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->adv_num) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->adv_num->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->adv_num) ?>',1);"><?php echo $reportmemberinfo->adv_num->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->adv_num->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->adv_num->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->cal_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->cal_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->cal_date) ?>',1);"><?php echo $reportmemberinfo->cal_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->cal_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->cal_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->count_member) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->count_member->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->count_member) ?>',1);"><?php echo $reportmemberinfo->count_member->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->count_member->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->count_member->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->all_member) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->all_member->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->all_member) ?>',1);"><?php echo $reportmemberinfo->all_member->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->all_member->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->all_member->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->unit_rate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->unit_rate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->unit_rate) ?>',1);"><?php echo $reportmemberinfo->unit_rate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->unit_rate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->unit_rate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->total) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->total->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->total) ?>',1);"><?php echo $reportmemberinfo->total->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->total->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->total->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->cal_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->cal_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->cal_status) ?>',1);"><?php echo $reportmemberinfo->cal_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->cal_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->cal_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->invoice_senddate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->invoice_senddate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->invoice_senddate) ?>',1);"><?php echo $reportmemberinfo->invoice_senddate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->invoice_senddate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->invoice_senddate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->invoice_duedate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->invoice_duedate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->invoice_duedate) ?>',1);"><?php echo $reportmemberinfo->invoice_duedate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->invoice_duedate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->invoice_duedate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->notice_senddate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->notice_senddate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->notice_senddate) ?>',1);"><?php echo $reportmemberinfo->notice_senddate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->notice_senddate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->notice_senddate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->notice_duedate) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->notice_duedate->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->notice_duedate) ?>',1);"><?php echo $reportmemberinfo->notice_duedate->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->notice_duedate->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->notice_duedate->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->t_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->t_title) ?>',1);"><?php echo $reportmemberinfo->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->v_title) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->v_title) ?>',1);"><?php echo $reportmemberinfo->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->pay_death_begin) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->pay_death_begin->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->pay_death_begin) ?>',1);"><?php echo $reportmemberinfo->pay_death_begin->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->pay_death_begin->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->pay_death_begin->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->pay_death_end) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->pay_death_end->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->pay_death_end) ?>',1);"><?php echo $reportmemberinfo->pay_death_end->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->pay_death_end->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->pay_death_end->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->pay_annual_year) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->pay_annual_year->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->pay_annual_year) ?>',1);"><?php echo $reportmemberinfo->pay_annual_year->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->pay_annual_year->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->pay_annual_year->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->pay_sum_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->pay_sum_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->pay_sum_date) ?>',1);"><?php echo $reportmemberinfo->pay_sum_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->pay_sum_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->pay_sum_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->pay_sum_detail) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->pay_sum_detail->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->pay_sum_detail) ?>',1);"><?php echo $reportmemberinfo->pay_sum_detail->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->pay_sum_detail->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->pay_sum_detail->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->pay_sum_adv_num) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->pay_sum_adv_num->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->pay_sum_adv_num) ?>',1);"><?php echo $reportmemberinfo->pay_sum_adv_num->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->pay_sum_adv_num->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->pay_sum_adv_num->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->pay_sum_note) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->pay_sum_note->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->pay_sum_note) ?>',1);"><?php echo $reportmemberinfo->pay_sum_note->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->pay_sum_note->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->pay_sum_note->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->id_code) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->id_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->id_code) ?>',1);"><?php echo $reportmemberinfo->id_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->id_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->id_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->gender) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->gender->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->gender) ?>',1);"><?php echo $reportmemberinfo->gender->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->gender->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->gender->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->age) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->age->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->age) ?>',1);"><?php echo $reportmemberinfo->age->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->age->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->age->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->address) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->address->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->address) ?>',1);"><?php echo $reportmemberinfo->address->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->address->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->address->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->phone) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->phone->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->phone) ?>',1);"><?php echo $reportmemberinfo->phone->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->phone->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->phone->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->bnfc1_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->bnfc1_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->bnfc1_name) ?>',1);"><?php echo $reportmemberinfo->bnfc1_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->bnfc1_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->bnfc1_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->bnfc1_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->bnfc1_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->bnfc1_rel) ?>',1);"><?php echo $reportmemberinfo->bnfc1_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->bnfc1_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->bnfc1_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->bnfc2_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->bnfc2_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->bnfc2_name) ?>',1);"><?php echo $reportmemberinfo->bnfc2_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->bnfc2_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->bnfc2_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->bnfc2_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->bnfc2_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->bnfc2_rel) ?>',1);"><?php echo $reportmemberinfo->bnfc2_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->bnfc2_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->bnfc2_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->bnfc3_name) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->bnfc3_name->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->bnfc3_name) ?>',1);"><?php echo $reportmemberinfo->bnfc3_name->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->bnfc3_name->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->bnfc3_name->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->bnfc3_rel) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->bnfc3_rel->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->bnfc3_rel) ?>',1);"><?php echo $reportmemberinfo->bnfc3_rel->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->bnfc3_rel->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->bnfc3_rel->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->regis_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->regis_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->regis_date) ?>',1);"><?php echo $reportmemberinfo->regis_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->regis_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->regis_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->effective_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->effective_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->effective_date) ?>',1);"><?php echo $reportmemberinfo->effective_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->effective_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->effective_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->resign_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->resign_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->resign_date) ?>',1);"><?php echo $reportmemberinfo->resign_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->resign_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->resign_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->dead_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->dead_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->dead_date) ?>',1);"><?php echo $reportmemberinfo->dead_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->dead_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->dead_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->member_status) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->member_status->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->member_status) ?>',1);"><?php echo $reportmemberinfo->member_status->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->member_status->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->member_status->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->terminate_date) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->terminate_date->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->terminate_date) ?>',1);"><?php echo $reportmemberinfo->terminate_date->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->terminate_date->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->terminate_date->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->dead_id) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->dead_id->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->dead_id) ?>',1);"><?php echo $reportmemberinfo->dead_id->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->dead_id->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->dead_id->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($reportmemberinfo->SortUrl($reportmemberinfo->note) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $reportmemberinfo->note->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $reportmemberinfo->SortUrl($reportmemberinfo->note) ?>',1);"><?php echo $reportmemberinfo->note->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($reportmemberinfo->note->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($reportmemberinfo->note->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$reportmemberinfo_summary->ShowFirstHeader = FALSE;
	}

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($reportmemberinfo->pay_sum_type, $reportmemberinfo->SqlFirstGroupField(), $reportmemberinfo->pay_sum_type->GroupValue());
	if ($reportmemberinfo_summary->Filter != "")
		$sWhere = "($reportmemberinfo_summary->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($reportmemberinfo->SqlSelect(), $reportmemberinfo->SqlWhere(), $reportmemberinfo->SqlGroupBy(), $reportmemberinfo->SqlHaving(), $reportmemberinfo->SqlOrderBy(), $sWhere, $reportmemberinfo_summary->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$reportmemberinfo_summary->GetRow(1);
	while ($rs && !$rs->EOF) { // Loop detail records
		$reportmemberinfo_summary->RecCount++;

		// Render detail row
		$reportmemberinfo->ResetCSS();
		$reportmemberinfo->RowType = EWRPT_ROWTYPE_DETAIL;
		$reportmemberinfo_summary->RenderRow();
?>
	<tr<?php echo $reportmemberinfo->RowAttributes(); ?>>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes(); ?>><div<?php echo $reportmemberinfo->pay_sum_type->ViewAttributes(); ?>><?php echo $reportmemberinfo->pay_sum_type->GroupViewValue; ?></div></td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes(); ?>><div<?php echo $reportmemberinfo->cal_type->ViewAttributes(); ?>><?php echo $reportmemberinfo->cal_type->GroupViewValue; ?></div></td>
		<td<?php echo $reportmemberinfo->member_code->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->member_code->ViewAttributes(); ?>><?php echo $reportmemberinfo->member_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->fname->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->fname->ViewAttributes(); ?>><?php echo $reportmemberinfo->fname->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->lname->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->lname->ViewAttributes(); ?>><?php echo $reportmemberinfo->lname->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->birthdate->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->birthdate->ViewAttributes(); ?>><?php echo $reportmemberinfo->birthdate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->pay_sum_total->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->pay_sum_total->ViewAttributes(); ?>><?php echo $reportmemberinfo->pay_sum_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->cal_detail->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->cal_detail->ViewAttributes(); ?>><?php echo $reportmemberinfo->cal_detail->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->adv_num->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->adv_num->ViewAttributes(); ?>><?php echo $reportmemberinfo->adv_num->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->cal_date->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->cal_date->ViewAttributes(); ?>><?php echo $reportmemberinfo->cal_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->count_member->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->count_member->ViewAttributes(); ?>><?php echo $reportmemberinfo->count_member->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->all_member->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->all_member->ViewAttributes(); ?>><?php echo $reportmemberinfo->all_member->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->unit_rate->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->unit_rate->ViewAttributes(); ?>><?php echo $reportmemberinfo->unit_rate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->total->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->total->ViewAttributes(); ?>><?php echo $reportmemberinfo->total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->cal_status->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->cal_status->ViewAttributes(); ?>><?php echo $reportmemberinfo->cal_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->invoice_senddate->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->invoice_senddate->ViewAttributes(); ?>><?php echo $reportmemberinfo->invoice_senddate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->invoice_duedate->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->invoice_duedate->ViewAttributes(); ?>><?php echo $reportmemberinfo->invoice_duedate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->notice_senddate->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->notice_senddate->ViewAttributes(); ?>><?php echo $reportmemberinfo->notice_senddate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->notice_duedate->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->notice_duedate->ViewAttributes(); ?>><?php echo $reportmemberinfo->notice_duedate->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->t_title->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->t_title->ViewAttributes(); ?>><?php echo $reportmemberinfo->t_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->v_title->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->v_title->ViewAttributes(); ?>><?php echo $reportmemberinfo->v_title->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->pay_death_begin->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->pay_death_begin->ViewAttributes(); ?>><?php echo $reportmemberinfo->pay_death_begin->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->pay_death_end->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->pay_death_end->ViewAttributes(); ?>><?php echo $reportmemberinfo->pay_death_end->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->pay_annual_year->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->pay_annual_year->ViewAttributes(); ?>><?php echo $reportmemberinfo->pay_annual_year->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->pay_sum_date->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->pay_sum_date->ViewAttributes(); ?>><?php echo $reportmemberinfo->pay_sum_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->pay_sum_detail->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->pay_sum_detail->ViewAttributes(); ?>><?php echo $reportmemberinfo->pay_sum_detail->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->pay_sum_adv_num->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->pay_sum_adv_num->ViewAttributes(); ?>><?php echo $reportmemberinfo->pay_sum_adv_num->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->pay_sum_note->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->pay_sum_note->ViewAttributes(); ?>><?php echo $reportmemberinfo->pay_sum_note->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->id_code->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->id_code->ViewAttributes(); ?>><?php echo $reportmemberinfo->id_code->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->gender->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->gender->ViewAttributes(); ?>><?php echo $reportmemberinfo->gender->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->age->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->age->ViewAttributes(); ?>><?php echo $reportmemberinfo->age->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->address->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->address->ViewAttributes(); ?>><?php echo $reportmemberinfo->address->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->phone->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->phone->ViewAttributes(); ?>><?php echo $reportmemberinfo->phone->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->bnfc1_name->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->bnfc1_name->ViewAttributes(); ?>><?php echo $reportmemberinfo->bnfc1_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->bnfc1_rel->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->bnfc1_rel->ViewAttributes(); ?>><?php echo $reportmemberinfo->bnfc1_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->bnfc2_name->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->bnfc2_name->ViewAttributes(); ?>><?php echo $reportmemberinfo->bnfc2_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->bnfc2_rel->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->bnfc2_rel->ViewAttributes(); ?>><?php echo $reportmemberinfo->bnfc2_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->bnfc3_name->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->bnfc3_name->ViewAttributes(); ?>><?php echo $reportmemberinfo->bnfc3_name->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->bnfc3_rel->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->bnfc3_rel->ViewAttributes(); ?>><?php echo $reportmemberinfo->bnfc3_rel->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->regis_date->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->regis_date->ViewAttributes(); ?>><?php echo $reportmemberinfo->regis_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->effective_date->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->effective_date->ViewAttributes(); ?>><?php echo $reportmemberinfo->effective_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->resign_date->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->resign_date->ViewAttributes(); ?>><?php echo $reportmemberinfo->resign_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->dead_date->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->dead_date->ViewAttributes(); ?>><?php echo $reportmemberinfo->dead_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->member_status->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->member_status->ViewAttributes(); ?>><?php echo $reportmemberinfo->member_status->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->terminate_date->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->terminate_date->ViewAttributes(); ?>><?php echo $reportmemberinfo->terminate_date->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->dead_id->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->dead_id->ViewAttributes(); ?>><?php echo $reportmemberinfo->dead_id->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->note->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->note->ViewAttributes(); ?>><?php echo $reportmemberinfo->note->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$reportmemberinfo_summary->AccumulateSummary();

		// Get next record
		$reportmemberinfo_summary->GetRow(2);

		// Show Footers
?>
<?php
		if ($reportmemberinfo_summary->ChkLvlBreak(2)) {
			$reportmemberinfo->ResetCSS();
			$reportmemberinfo->RowType = EWRPT_ROWTYPE_TOTAL;
			$reportmemberinfo->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$reportmemberinfo->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$reportmemberinfo->RowGroupLevel = 2;
			$reportmemberinfo_summary->RenderRow();
?>
	<tr<?php echo $reportmemberinfo->RowAttributes(); ?>>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td colspan="46"<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $reportmemberinfo->cal_type->FldCaption() ?>: <?php echo $reportmemberinfo->cal_type->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($reportmemberinfo_summary->Cnt[2][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$reportmemberinfo->ResetCSS();
			$reportmemberinfo->pay_sum_total->Count = $reportmemberinfo_summary->Cnt[2][5];
			$reportmemberinfo->pay_sum_total->Summary = $reportmemberinfo_summary->Smry[2][5]; // Load SUM
			$reportmemberinfo->total->Count = $reportmemberinfo_summary->Cnt[2][12];
			$reportmemberinfo->total->Summary = $reportmemberinfo_summary->Smry[2][12]; // Load SUM
			$reportmemberinfo->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$reportmemberinfo_summary->RenderRow();
?>
	<tr<?php echo $reportmemberinfo->RowAttributes(); ?>>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td colspan="1"<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->pay_sum_total->ViewAttributes(); ?>><?php echo $reportmemberinfo->pay_sum_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->total->ViewAttributes(); ?>><?php echo $reportmemberinfo->total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_type->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 2 summary
			$reportmemberinfo_summary->ResetLevelSummary(2);
		} // End check level check
?>
<?php
	} // End detail records loop
?>
<?php
			$reportmemberinfo->ResetCSS();
			$reportmemberinfo->RowType = EWRPT_ROWTYPE_TOTAL;
			$reportmemberinfo->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$reportmemberinfo->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$reportmemberinfo->RowGroupLevel = 1;
			$reportmemberinfo_summary->RenderRow();
?>
	<tr<?php echo $reportmemberinfo->RowAttributes(); ?>>
		<td colspan="47"<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $reportmemberinfo->pay_sum_type->FldCaption() ?>: <?php echo $reportmemberinfo->pay_sum_type->GroupViewValue; ?> (<?php echo ewrpt_FormatNumber($reportmemberinfo_summary->Cnt[1][0],0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
			$reportmemberinfo->ResetCSS();
			$reportmemberinfo->pay_sum_total->Count = $reportmemberinfo_summary->Cnt[1][5];
			$reportmemberinfo->pay_sum_total->Summary = $reportmemberinfo_summary->Smry[1][5]; // Load SUM
			$reportmemberinfo->total->Count = $reportmemberinfo_summary->Cnt[1][12];
			$reportmemberinfo->total->Summary = $reportmemberinfo_summary->Smry[1][12]; // Load SUM
			$reportmemberinfo->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
			$reportmemberinfo_summary->RenderRow();
?>
	<tr<?php echo $reportmemberinfo->RowAttributes(); ?>>
		<td colspan="2"<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->pay_sum_total->ViewAttributes(); ?>><?php echo $reportmemberinfo->pay_sum_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->total->ViewAttributes(); ?>><?php echo $reportmemberinfo->total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_type->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php

			// Reset level 1 summary
			$reportmemberinfo_summary->ResetLevelSummary(1);
?>
<?php

	// Next group
	$reportmemberinfo_summary->GetGrpRow(2);
	$reportmemberinfo_summary->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
<?php
if ($reportmemberinfo_summary->TotalGrps > 0) {
	$reportmemberinfo->ResetCSS();
	$reportmemberinfo->RowType = EWRPT_ROWTYPE_TOTAL;
	$reportmemberinfo->RowTotalType = EWRPT_ROWTOTAL_GRAND;
	$reportmemberinfo->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
	$reportmemberinfo->RowAttrs["class"] = "ewRptGrandSummary";
	$reportmemberinfo_summary->RenderRow();
?>
	<!-- tr><td colspan="47"><span class="phpreportmaker">&nbsp;<br /></span></td></tr -->
	<tr<?php echo $reportmemberinfo->RowAttributes(); ?>><td colspan="47"><?php echo $ReportLanguage->Phrase("RptGrandTotal") ?> (<?php echo ewrpt_FormatNumber($reportmemberinfo_summary->TotCount,0,-2,-2,-2); ?> <?php echo $ReportLanguage->Phrase("RptDtlRec") ?>)</td></tr>
<?php
	$reportmemberinfo->ResetCSS();
	$reportmemberinfo->pay_sum_total->Count = $reportmemberinfo_summary->TotCount;
	$reportmemberinfo->pay_sum_total->Summary = $reportmemberinfo_summary->GrandSmry[5]; // Load SUM
	$reportmemberinfo->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportmemberinfo->total->Count = $reportmemberinfo_summary->TotCount;
	$reportmemberinfo->total->Summary = $reportmemberinfo_summary->GrandSmry[12]; // Load SUM
	$reportmemberinfo->RowTotalSubType = EWRPT_ROWTOTAL_SUM;
	$reportmemberinfo->total->CurrentValue = $reportmemberinfo->total->Summary;
	$reportmemberinfo->RowAttrs["class"] = "ewRptGrandSummary";
	$reportmemberinfo_summary->RenderRow();
?>
	<tr<?php echo $reportmemberinfo->RowAttributes(); ?>>
		<td colspan="2" class="ewRptGrpAggregate"><?php echo $ReportLanguage->Phrase("RptSum"); ?></td>
		<td<?php echo $reportmemberinfo->member_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->fname->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->lname->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->birthdate->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_total->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->pay_sum_total->ViewAttributes(); ?>><?php echo $reportmemberinfo->pay_sum_total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->cal_detail->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->adv_num->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->cal_date->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->count_member->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->all_member->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->unit_rate->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->total->CellAttributes() ?>>
<div<?php echo $reportmemberinfo->total->ViewAttributes(); ?>><?php echo $reportmemberinfo->total->ListViewValue(); ?></div>
</td>
		<td<?php echo $reportmemberinfo->cal_status->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->invoice_senddate->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->invoice_duedate->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->notice_senddate->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->notice_duedate->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->t_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->v_title->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_death_begin->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_death_end->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_annual_year->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_date->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_detail->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_adv_num->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->pay_sum_note->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->id_code->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->gender->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->age->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->address->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->phone->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->bnfc1_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->bnfc1_rel->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->bnfc2_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->bnfc2_rel->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->bnfc3_name->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->bnfc3_rel->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->regis_date->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->effective_date->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->resign_date->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->dead_date->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->member_status->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->terminate_date->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->dead_id->CellAttributes() ?>>&nbsp;</td>
		<td<?php echo $reportmemberinfo->note->CellAttributes() ?>>&nbsp;</td>
	</tr>
<?php } ?>
	</tfoot>
</table>
</div>
<?php if ($reportmemberinfo_summary->TotalGrps > 0) { ?>
<?php if ($reportmemberinfo->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="reportmemberinfosmry.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($reportmemberinfo_summary->StartGrp, $reportmemberinfo_summary->DisplayGrps, $reportmemberinfo_summary->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="reportmemberinfosmry.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="reportmemberinfosmry.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="reportmemberinfosmry.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="reportmemberinfosmry.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($reportmemberinfo_summary->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($reportmemberinfo_summary->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($reportmemberinfo_summary->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($reportmemberinfo_summary->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($reportmemberinfo_summary->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($reportmemberinfo_summary->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($reportmemberinfo_summary->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($reportmemberinfo_summary->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($reportmemberinfo_summary->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($reportmemberinfo_summary->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($reportmemberinfo->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($reportmemberinfo->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($reportmemberinfo->Export == "" || $reportmemberinfo->Export == "print" || $reportmemberinfo->Export == "email") { ?>
<?php } ?>
<?php if ($reportmemberinfo->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($reportmemberinfo->Export == "" || $reportmemberinfo->Export == "print" || $reportmemberinfo->Export == "email") { ?>
<?php } ?>
<?php if ($reportmemberinfo->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $reportmemberinfo_summary->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($reportmemberinfo->Export == "") { ?>
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
$reportmemberinfo_summary->Page_Terminate();
?>
<?php

//
// Page class
//
class crreportmemberinfo_summary {

	// Page ID
	var $PageID = 'summary';

	// Table name
	var $TableName = 'reportmemberinfo';

	// Page object name
	var $PageObjName = 'reportmemberinfo_summary';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $reportmemberinfo;
		if ($reportmemberinfo->UseTokenInUrl) $PageUrl .= "t=" . $reportmemberinfo->TableVar . "&"; // Add page token
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
		global $reportmemberinfo;
		if ($reportmemberinfo->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($reportmemberinfo->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($reportmemberinfo->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crreportmemberinfo_summary() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (reportmemberinfo)
		$GLOBALS["reportmemberinfo"] = new crreportmemberinfo();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'summary', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'reportmemberinfo', TRUE);

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
		global $reportmemberinfo;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$reportmemberinfo->Export = $_GET["export"];
	}
	$gsExport = $reportmemberinfo->Export; // Get export parameter, used in header
	$gsExportFile = $reportmemberinfo->TableVar; // Get export file, used in header
	if ($reportmemberinfo->Export == "excel") {
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
		global $reportmemberinfo;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($reportmemberinfo->Export == "email") {
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
		global $reportmemberinfo;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 46;
		$nGrps = 3;
		$this->Val = ewrpt_InitArray($nDtls, 0);
		$this->Cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandSmry = ewrpt_InitArray($nDtls, 0);
		$this->GrandMn = ewrpt_InitArray($nDtls, NULL);
		$this->GrandMx = ewrpt_InitArray($nDtls, NULL);

		// Set up if accumulation required
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, TRUE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, TRUE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

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

		// Get total group count
		$sGrpSort = ewrpt_UpdateSortFields($reportmemberinfo->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($reportmemberinfo->SqlSelectGroup(), $reportmemberinfo->SqlWhere(), $reportmemberinfo->SqlGroupBy(), $reportmemberinfo->SqlHaving(), $reportmemberinfo->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($reportmemberinfo->ExportAll && $reportmemberinfo->Export <> "")
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
		global $reportmemberinfo;
		switch ($lvl) {
			case 1:
				return (is_null($reportmemberinfo->pay_sum_type->CurrentValue) && !is_null($reportmemberinfo->pay_sum_type->OldValue)) ||
					(!is_null($reportmemberinfo->pay_sum_type->CurrentValue) && is_null($reportmemberinfo->pay_sum_type->OldValue)) ||
					($reportmemberinfo->pay_sum_type->GroupValue() <> $reportmemberinfo->pay_sum_type->GroupOldValue());
			case 2:
				return (is_null($reportmemberinfo->cal_type->CurrentValue) && !is_null($reportmemberinfo->cal_type->OldValue)) ||
					(!is_null($reportmemberinfo->cal_type->CurrentValue) && is_null($reportmemberinfo->cal_type->OldValue)) ||
					($reportmemberinfo->cal_type->GroupValue() <> $reportmemberinfo->cal_type->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
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
		global $reportmemberinfo;
		$rsgrpcnt = $conn->Execute($sql);
		$grpcnt = ($rsgrpcnt) ? $rsgrpcnt->RecordCount() : 0;
		if ($rsgrpcnt) $rsgrpcnt->Close();
		return $grpcnt;
	}

	// Get group rs
	function GetGrpRs($sql, $start, $grps) {
		global $conn;
		global $reportmemberinfo;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get group row values
	function GetGrpRow($opt) {
		global $rsgrp;
		global $reportmemberinfo;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

			//$rsgrp->MoveFirst(); // NOTE: no need to move position
			$reportmemberinfo->pay_sum_type->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF)
			$reportmemberinfo->pay_sum_type->setDbValue($rsgrp->fields('pay_sum_type'));
		if ($rsgrp->EOF) {
			$reportmemberinfo->pay_sum_type->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $reportmemberinfo;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$reportmemberinfo->member_code->setDbValue($rs->fields('member_code'));
			$reportmemberinfo->fname->setDbValue($rs->fields('fname'));
			$reportmemberinfo->lname->setDbValue($rs->fields('lname'));
			$reportmemberinfo->birthdate->setDbValue($rs->fields('birthdate'));
			$reportmemberinfo->pay_sum_total->setDbValue($rs->fields('pay_sum_total'));
			if ($opt <> 1)
				$reportmemberinfo->pay_sum_type->setDbValue($rs->fields('pay_sum_type'));
			$reportmemberinfo->village_id->setDbValue($rs->fields('village_id'));
			$reportmemberinfo->t_id->setDbValue($rs->fields('t_id'));
			$reportmemberinfo->cal_type->setDbValue($rs->fields('cal_type'));
			$reportmemberinfo->cal_detail->setDbValue($rs->fields('cal_detail'));
			$reportmemberinfo->adv_num->setDbValue($rs->fields('adv_num'));
			$reportmemberinfo->cal_date->setDbValue($rs->fields('cal_date'));
			$reportmemberinfo->count_member->setDbValue($rs->fields('count_member'));
			$reportmemberinfo->all_member->setDbValue($rs->fields('all_member'));
			$reportmemberinfo->unit_rate->setDbValue($rs->fields('unit_rate'));
			$reportmemberinfo->total->setDbValue($rs->fields('total'));
			$reportmemberinfo->cal_status->setDbValue($rs->fields('cal_status'));
			$reportmemberinfo->invoice_senddate->setDbValue($rs->fields('invoice_senddate'));
			$reportmemberinfo->invoice_duedate->setDbValue($rs->fields('invoice_duedate'));
			$reportmemberinfo->notice_senddate->setDbValue($rs->fields('notice_senddate'));
			$reportmemberinfo->notice_duedate->setDbValue($rs->fields('notice_duedate'));
			$reportmemberinfo->t_title->setDbValue($rs->fields('t_title'));
			$reportmemberinfo->v_title->setDbValue($rs->fields('v_title'));
			$reportmemberinfo->v_code->setDbValue($rs->fields('v_code'));
			$reportmemberinfo->pay_death_begin->setDbValue($rs->fields('pay_death_begin'));
			$reportmemberinfo->pay_death_end->setDbValue($rs->fields('pay_death_end'));
			$reportmemberinfo->pay_annual_year->setDbValue($rs->fields('pay_annual_year'));
			$reportmemberinfo->pay_sum_date->setDbValue($rs->fields('pay_sum_date'));
			$reportmemberinfo->pay_sum_detail->setDbValue($rs->fields('pay_sum_detail'));
			$reportmemberinfo->pay_sum_adv_num->setDbValue($rs->fields('pay_sum_adv_num'));
			$reportmemberinfo->pay_sum_note->setDbValue($rs->fields('pay_sum_note'));
			$reportmemberinfo->id_code->setDbValue($rs->fields('id_code'));
			$reportmemberinfo->gender->setDbValue($rs->fields('gender'));
			$reportmemberinfo->prefix->setDbValue($rs->fields('prefix'));
			$reportmemberinfo->age->setDbValue($rs->fields('age'));
			$reportmemberinfo->address->setDbValue($rs->fields('address'));
			$reportmemberinfo->t_code->setDbValue($rs->fields('t_code'));
			$reportmemberinfo->phone->setDbValue($rs->fields('phone'));
			$reportmemberinfo->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
			$reportmemberinfo->bnfc1_rel->setDbValue($rs->fields('bnfc1_rel'));
			$reportmemberinfo->bnfc2_name->setDbValue($rs->fields('bnfc2_name'));
			$reportmemberinfo->bnfc2_rel->setDbValue($rs->fields('bnfc2_rel'));
			$reportmemberinfo->bnfc3_name->setDbValue($rs->fields('bnfc3_name'));
			$reportmemberinfo->bnfc3_rel->setDbValue($rs->fields('bnfc3_rel'));
			$reportmemberinfo->regis_date->setDbValue($rs->fields('regis_date'));
			$reportmemberinfo->effective_date->setDbValue($rs->fields('effective_date'));
			$reportmemberinfo->resign_date->setDbValue($rs->fields('resign_date'));
			$reportmemberinfo->dead_date->setDbValue($rs->fields('dead_date'));
			$reportmemberinfo->member_status->setDbValue($rs->fields('member_status'));
			$reportmemberinfo->terminate_date->setDbValue($rs->fields('terminate_date'));
			$reportmemberinfo->dead_id->setDbValue($rs->fields('dead_id'));
			$reportmemberinfo->note->setDbValue($rs->fields('note'));
			$this->Val[1] = $reportmemberinfo->member_code->CurrentValue;
			$this->Val[2] = $reportmemberinfo->fname->CurrentValue;
			$this->Val[3] = $reportmemberinfo->lname->CurrentValue;
			$this->Val[4] = $reportmemberinfo->birthdate->CurrentValue;
			$this->Val[5] = $reportmemberinfo->pay_sum_total->CurrentValue;
			$this->Val[6] = $reportmemberinfo->cal_detail->CurrentValue;
			$this->Val[7] = $reportmemberinfo->adv_num->CurrentValue;
			$this->Val[8] = $reportmemberinfo->cal_date->CurrentValue;
			$this->Val[9] = $reportmemberinfo->count_member->CurrentValue;
			$this->Val[10] = $reportmemberinfo->all_member->CurrentValue;
			$this->Val[11] = $reportmemberinfo->unit_rate->CurrentValue;
			$this->Val[12] = $reportmemberinfo->total->CurrentValue;
			$this->Val[13] = $reportmemberinfo->cal_status->CurrentValue;
			$this->Val[14] = $reportmemberinfo->invoice_senddate->CurrentValue;
			$this->Val[15] = $reportmemberinfo->invoice_duedate->CurrentValue;
			$this->Val[16] = $reportmemberinfo->notice_senddate->CurrentValue;
			$this->Val[17] = $reportmemberinfo->notice_duedate->CurrentValue;
			$this->Val[18] = $reportmemberinfo->t_title->CurrentValue;
			$this->Val[19] = $reportmemberinfo->v_title->CurrentValue;
			$this->Val[20] = $reportmemberinfo->pay_death_begin->CurrentValue;
			$this->Val[21] = $reportmemberinfo->pay_death_end->CurrentValue;
			$this->Val[22] = $reportmemberinfo->pay_annual_year->CurrentValue;
			$this->Val[23] = $reportmemberinfo->pay_sum_date->CurrentValue;
			$this->Val[24] = $reportmemberinfo->pay_sum_detail->CurrentValue;
			$this->Val[25] = $reportmemberinfo->pay_sum_adv_num->CurrentValue;
			$this->Val[26] = $reportmemberinfo->pay_sum_note->CurrentValue;
			$this->Val[27] = $reportmemberinfo->id_code->CurrentValue;
			$this->Val[28] = $reportmemberinfo->gender->CurrentValue;
			$this->Val[29] = $reportmemberinfo->age->CurrentValue;
			$this->Val[30] = $reportmemberinfo->address->CurrentValue;
			$this->Val[31] = $reportmemberinfo->phone->CurrentValue;
			$this->Val[32] = $reportmemberinfo->bnfc1_name->CurrentValue;
			$this->Val[33] = $reportmemberinfo->bnfc1_rel->CurrentValue;
			$this->Val[34] = $reportmemberinfo->bnfc2_name->CurrentValue;
			$this->Val[35] = $reportmemberinfo->bnfc2_rel->CurrentValue;
			$this->Val[36] = $reportmemberinfo->bnfc3_name->CurrentValue;
			$this->Val[37] = $reportmemberinfo->bnfc3_rel->CurrentValue;
			$this->Val[38] = $reportmemberinfo->regis_date->CurrentValue;
			$this->Val[39] = $reportmemberinfo->effective_date->CurrentValue;
			$this->Val[40] = $reportmemberinfo->resign_date->CurrentValue;
			$this->Val[41] = $reportmemberinfo->dead_date->CurrentValue;
			$this->Val[42] = $reportmemberinfo->member_status->CurrentValue;
			$this->Val[43] = $reportmemberinfo->terminate_date->CurrentValue;
			$this->Val[44] = $reportmemberinfo->dead_id->CurrentValue;
			$this->Val[45] = $reportmemberinfo->note->CurrentValue;
		} else {
			$reportmemberinfo->member_code->setDbValue("");
			$reportmemberinfo->fname->setDbValue("");
			$reportmemberinfo->lname->setDbValue("");
			$reportmemberinfo->birthdate->setDbValue("");
			$reportmemberinfo->pay_sum_total->setDbValue("");
			$reportmemberinfo->pay_sum_type->setDbValue("");
			$reportmemberinfo->village_id->setDbValue("");
			$reportmemberinfo->t_id->setDbValue("");
			$reportmemberinfo->cal_type->setDbValue("");
			$reportmemberinfo->cal_detail->setDbValue("");
			$reportmemberinfo->adv_num->setDbValue("");
			$reportmemberinfo->cal_date->setDbValue("");
			$reportmemberinfo->count_member->setDbValue("");
			$reportmemberinfo->all_member->setDbValue("");
			$reportmemberinfo->unit_rate->setDbValue("");
			$reportmemberinfo->total->setDbValue("");
			$reportmemberinfo->cal_status->setDbValue("");
			$reportmemberinfo->invoice_senddate->setDbValue("");
			$reportmemberinfo->invoice_duedate->setDbValue("");
			$reportmemberinfo->notice_senddate->setDbValue("");
			$reportmemberinfo->notice_duedate->setDbValue("");
			$reportmemberinfo->t_title->setDbValue("");
			$reportmemberinfo->v_title->setDbValue("");
			$reportmemberinfo->v_code->setDbValue("");
			$reportmemberinfo->pay_death_begin->setDbValue("");
			$reportmemberinfo->pay_death_end->setDbValue("");
			$reportmemberinfo->pay_annual_year->setDbValue("");
			$reportmemberinfo->pay_sum_date->setDbValue("");
			$reportmemberinfo->pay_sum_detail->setDbValue("");
			$reportmemberinfo->pay_sum_adv_num->setDbValue("");
			$reportmemberinfo->pay_sum_note->setDbValue("");
			$reportmemberinfo->id_code->setDbValue("");
			$reportmemberinfo->gender->setDbValue("");
			$reportmemberinfo->prefix->setDbValue("");
			$reportmemberinfo->age->setDbValue("");
			$reportmemberinfo->address->setDbValue("");
			$reportmemberinfo->t_code->setDbValue("");
			$reportmemberinfo->phone->setDbValue("");
			$reportmemberinfo->bnfc1_name->setDbValue("");
			$reportmemberinfo->bnfc1_rel->setDbValue("");
			$reportmemberinfo->bnfc2_name->setDbValue("");
			$reportmemberinfo->bnfc2_rel->setDbValue("");
			$reportmemberinfo->bnfc3_name->setDbValue("");
			$reportmemberinfo->bnfc3_rel->setDbValue("");
			$reportmemberinfo->regis_date->setDbValue("");
			$reportmemberinfo->effective_date->setDbValue("");
			$reportmemberinfo->resign_date->setDbValue("");
			$reportmemberinfo->dead_date->setDbValue("");
			$reportmemberinfo->member_status->setDbValue("");
			$reportmemberinfo->terminate_date->setDbValue("");
			$reportmemberinfo->dead_id->setDbValue("");
			$reportmemberinfo->note->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $reportmemberinfo;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$reportmemberinfo->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$reportmemberinfo->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $reportmemberinfo->getStartGroup();
			}
		} else {
			$this->StartGrp = $reportmemberinfo->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$reportmemberinfo->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$reportmemberinfo->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$reportmemberinfo->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $reportmemberinfo;

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
		global $reportmemberinfo;
		$this->StartGrp = 1;
		$reportmemberinfo->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $reportmemberinfo;
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
			$reportmemberinfo->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$reportmemberinfo->setStartGroup($this->StartGrp);
		} else {
			if ($reportmemberinfo->getGroupPerPage() <> "") {
				$this->DisplayGrps = $reportmemberinfo->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $reportmemberinfo;
		if ($reportmemberinfo->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($reportmemberinfo->SqlSelectCount(), $reportmemberinfo->SqlWhere(), $reportmemberinfo->SqlGroupBy(), $reportmemberinfo->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}

			// Get total from sql directly
			$sSql = ewrpt_BuildReportSql($reportmemberinfo->SqlSelectAgg(), $reportmemberinfo->SqlWhere(), $reportmemberinfo->SqlGroupBy(), $reportmemberinfo->SqlHaving(), "", $this->Filter, "");
			$sSql = $reportmemberinfo->SqlAggPfx() . $sSql . $reportmemberinfo->SqlAggSfx();
			$rsagg = $conn->Execute($sSql);
			if ($rsagg) {
				$this->GrandSmry[5] = $rsagg->fields("sum_pay_sum_total");
				$this->GrandSmry[12] = $rsagg->fields("sum_total");
				$rsagg->Close();
			} else {

				// Accumulate grand summary from detail records
				$sSql = ewrpt_BuildReportSql($reportmemberinfo->SqlSelect(), $reportmemberinfo->SqlWhere(), $reportmemberinfo->SqlGroupBy(), $reportmemberinfo->SqlHaving(), "", $this->Filter, "");
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
		$reportmemberinfo->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($reportmemberinfo->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// pay_sum_type
			$reportmemberinfo->pay_sum_type->GroupViewValue = $reportmemberinfo->pay_sum_type->GroupOldValue();
			$reportmemberinfo->pay_sum_type->CellAttrs["class"] = ($reportmemberinfo->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";
			$reportmemberinfo->pay_sum_type->GroupViewValue = ewrpt_DisplayGroupValue($reportmemberinfo->pay_sum_type, $reportmemberinfo->pay_sum_type->GroupViewValue);

			// cal_type
			$reportmemberinfo->cal_type->GroupViewValue = $reportmemberinfo->cal_type->GroupOldValue();
			$reportmemberinfo->cal_type->CellAttrs["class"] = ($reportmemberinfo->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";
			$reportmemberinfo->cal_type->GroupViewValue = ewrpt_DisplayGroupValue($reportmemberinfo->cal_type, $reportmemberinfo->cal_type->GroupViewValue);

			// member_code
			$reportmemberinfo->member_code->ViewValue = $reportmemberinfo->member_code->Summary;

			// fname
			$reportmemberinfo->fname->ViewValue = $reportmemberinfo->fname->Summary;

			// lname
			$reportmemberinfo->lname->ViewValue = $reportmemberinfo->lname->Summary;

			// birthdate
			$reportmemberinfo->birthdate->ViewValue = $reportmemberinfo->birthdate->Summary;
			$reportmemberinfo->birthdate->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->birthdate->ViewValue, 6);

			// pay_sum_total
			$reportmemberinfo->pay_sum_total->ViewValue = $reportmemberinfo->pay_sum_total->Summary;

			// cal_detail
			$reportmemberinfo->cal_detail->ViewValue = $reportmemberinfo->cal_detail->Summary;

			// adv_num
			$reportmemberinfo->adv_num->ViewValue = $reportmemberinfo->adv_num->Summary;

			// cal_date
			$reportmemberinfo->cal_date->ViewValue = $reportmemberinfo->cal_date->Summary;
			$reportmemberinfo->cal_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->cal_date->ViewValue, 6);

			// count_member
			$reportmemberinfo->count_member->ViewValue = $reportmemberinfo->count_member->Summary;

			// all_member
			$reportmemberinfo->all_member->ViewValue = $reportmemberinfo->all_member->Summary;

			// unit_rate
			$reportmemberinfo->unit_rate->ViewValue = $reportmemberinfo->unit_rate->Summary;

			// total
			$reportmemberinfo->total->ViewValue = $reportmemberinfo->total->Summary;

			// cal_status
			$reportmemberinfo->cal_status->ViewValue = $reportmemberinfo->cal_status->Summary;

			// invoice_senddate
			$reportmemberinfo->invoice_senddate->ViewValue = $reportmemberinfo->invoice_senddate->Summary;
			$reportmemberinfo->invoice_senddate->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->invoice_senddate->ViewValue, 6);

			// invoice_duedate
			$reportmemberinfo->invoice_duedate->ViewValue = $reportmemberinfo->invoice_duedate->Summary;
			$reportmemberinfo->invoice_duedate->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->invoice_duedate->ViewValue, 6);

			// notice_senddate
			$reportmemberinfo->notice_senddate->ViewValue = $reportmemberinfo->notice_senddate->Summary;
			$reportmemberinfo->notice_senddate->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->notice_senddate->ViewValue, 6);

			// notice_duedate
			$reportmemberinfo->notice_duedate->ViewValue = $reportmemberinfo->notice_duedate->Summary;
			$reportmemberinfo->notice_duedate->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->notice_duedate->ViewValue, 6);

			// t_title
			$reportmemberinfo->t_title->ViewValue = $reportmemberinfo->t_title->Summary;

			// v_title
			$reportmemberinfo->v_title->ViewValue = $reportmemberinfo->v_title->Summary;

			// pay_death_begin
			$reportmemberinfo->pay_death_begin->ViewValue = $reportmemberinfo->pay_death_begin->Summary;

			// pay_death_end
			$reportmemberinfo->pay_death_end->ViewValue = $reportmemberinfo->pay_death_end->Summary;

			// pay_annual_year
			$reportmemberinfo->pay_annual_year->ViewValue = $reportmemberinfo->pay_annual_year->Summary;

			// pay_sum_date
			$reportmemberinfo->pay_sum_date->ViewValue = $reportmemberinfo->pay_sum_date->Summary;
			$reportmemberinfo->pay_sum_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->pay_sum_date->ViewValue, 6);

			// pay_sum_detail
			$reportmemberinfo->pay_sum_detail->ViewValue = $reportmemberinfo->pay_sum_detail->Summary;

			// pay_sum_adv_num
			$reportmemberinfo->pay_sum_adv_num->ViewValue = $reportmemberinfo->pay_sum_adv_num->Summary;

			// pay_sum_note
			$reportmemberinfo->pay_sum_note->ViewValue = $reportmemberinfo->pay_sum_note->Summary;

			// id_code
			$reportmemberinfo->id_code->ViewValue = $reportmemberinfo->id_code->Summary;

			// gender
			$reportmemberinfo->gender->ViewValue = $reportmemberinfo->gender->Summary;

			// age
			$reportmemberinfo->age->ViewValue = $reportmemberinfo->age->Summary;

			// address
			$reportmemberinfo->address->ViewValue = $reportmemberinfo->address->Summary;

			// phone
			$reportmemberinfo->phone->ViewValue = $reportmemberinfo->phone->Summary;

			// bnfc1_name
			$reportmemberinfo->bnfc1_name->ViewValue = $reportmemberinfo->bnfc1_name->Summary;

			// bnfc1_rel
			$reportmemberinfo->bnfc1_rel->ViewValue = $reportmemberinfo->bnfc1_rel->Summary;

			// bnfc2_name
			$reportmemberinfo->bnfc2_name->ViewValue = $reportmemberinfo->bnfc2_name->Summary;

			// bnfc2_rel
			$reportmemberinfo->bnfc2_rel->ViewValue = $reportmemberinfo->bnfc2_rel->Summary;

			// bnfc3_name
			$reportmemberinfo->bnfc3_name->ViewValue = $reportmemberinfo->bnfc3_name->Summary;

			// bnfc3_rel
			$reportmemberinfo->bnfc3_rel->ViewValue = $reportmemberinfo->bnfc3_rel->Summary;

			// regis_date
			$reportmemberinfo->regis_date->ViewValue = $reportmemberinfo->regis_date->Summary;
			$reportmemberinfo->regis_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->regis_date->ViewValue, 6);

			// effective_date
			$reportmemberinfo->effective_date->ViewValue = $reportmemberinfo->effective_date->Summary;
			$reportmemberinfo->effective_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->effective_date->ViewValue, 6);

			// resign_date
			$reportmemberinfo->resign_date->ViewValue = $reportmemberinfo->resign_date->Summary;
			$reportmemberinfo->resign_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->resign_date->ViewValue, 6);

			// dead_date
			$reportmemberinfo->dead_date->ViewValue = $reportmemberinfo->dead_date->Summary;
			$reportmemberinfo->dead_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->dead_date->ViewValue, 6);

			// member_status
			$reportmemberinfo->member_status->ViewValue = $reportmemberinfo->member_status->Summary;

			// terminate_date
			$reportmemberinfo->terminate_date->ViewValue = $reportmemberinfo->terminate_date->Summary;
			$reportmemberinfo->terminate_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->terminate_date->ViewValue, 6);

			// dead_id
			$reportmemberinfo->dead_id->ViewValue = $reportmemberinfo->dead_id->Summary;

			// note
			$reportmemberinfo->note->ViewValue = $reportmemberinfo->note->Summary;
		} else {

			// pay_sum_type
			$reportmemberinfo->pay_sum_type->GroupViewValue = $reportmemberinfo->pay_sum_type->GroupValue();
			$reportmemberinfo->pay_sum_type->CellAttrs["class"] = "ewRptGrpField1";
			$reportmemberinfo->pay_sum_type->GroupViewValue = ewrpt_DisplayGroupValue($reportmemberinfo->pay_sum_type, $reportmemberinfo->pay_sum_type->GroupViewValue);
			if ($reportmemberinfo->pay_sum_type->GroupValue() == $reportmemberinfo->pay_sum_type->GroupOldValue() && !$this->ChkLvlBreak(1))
				$reportmemberinfo->pay_sum_type->GroupViewValue = "&nbsp;";

			// cal_type
			$reportmemberinfo->cal_type->GroupViewValue = $reportmemberinfo->cal_type->GroupValue();
			$reportmemberinfo->cal_type->CellAttrs["class"] = "ewRptGrpField2";
			$reportmemberinfo->cal_type->GroupViewValue = ewrpt_DisplayGroupValue($reportmemberinfo->cal_type, $reportmemberinfo->cal_type->GroupViewValue);
			if ($reportmemberinfo->cal_type->GroupValue() == $reportmemberinfo->cal_type->GroupOldValue() && !$this->ChkLvlBreak(2))
				$reportmemberinfo->cal_type->GroupViewValue = "&nbsp;";

			// member_code
			$reportmemberinfo->member_code->ViewValue = $reportmemberinfo->member_code->CurrentValue;
			$reportmemberinfo->member_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// fname
			$reportmemberinfo->fname->ViewValue = $reportmemberinfo->fname->CurrentValue;
			$reportmemberinfo->fname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// lname
			$reportmemberinfo->lname->ViewValue = $reportmemberinfo->lname->CurrentValue;
			$reportmemberinfo->lname->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// birthdate
			$reportmemberinfo->birthdate->ViewValue = $reportmemberinfo->birthdate->CurrentValue;
			$reportmemberinfo->birthdate->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->birthdate->ViewValue, 6);
			$reportmemberinfo->birthdate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_total
			$reportmemberinfo->pay_sum_total->ViewValue = $reportmemberinfo->pay_sum_total->CurrentValue;
			$reportmemberinfo->pay_sum_total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// cal_detail
			$reportmemberinfo->cal_detail->ViewValue = $reportmemberinfo->cal_detail->CurrentValue;
			$reportmemberinfo->cal_detail->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// adv_num
			$reportmemberinfo->adv_num->ViewValue = $reportmemberinfo->adv_num->CurrentValue;
			$reportmemberinfo->adv_num->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// cal_date
			$reportmemberinfo->cal_date->ViewValue = $reportmemberinfo->cal_date->CurrentValue;
			$reportmemberinfo->cal_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->cal_date->ViewValue, 6);
			$reportmemberinfo->cal_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// count_member
			$reportmemberinfo->count_member->ViewValue = $reportmemberinfo->count_member->CurrentValue;
			$reportmemberinfo->count_member->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// all_member
			$reportmemberinfo->all_member->ViewValue = $reportmemberinfo->all_member->CurrentValue;
			$reportmemberinfo->all_member->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// unit_rate
			$reportmemberinfo->unit_rate->ViewValue = $reportmemberinfo->unit_rate->CurrentValue;
			$reportmemberinfo->unit_rate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// total
			$reportmemberinfo->total->ViewValue = $reportmemberinfo->total->CurrentValue;
			$reportmemberinfo->total->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// cal_status
			$reportmemberinfo->cal_status->ViewValue = $reportmemberinfo->cal_status->CurrentValue;
			$reportmemberinfo->cal_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// invoice_senddate
			$reportmemberinfo->invoice_senddate->ViewValue = $reportmemberinfo->invoice_senddate->CurrentValue;
			$reportmemberinfo->invoice_senddate->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->invoice_senddate->ViewValue, 6);
			$reportmemberinfo->invoice_senddate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// invoice_duedate
			$reportmemberinfo->invoice_duedate->ViewValue = $reportmemberinfo->invoice_duedate->CurrentValue;
			$reportmemberinfo->invoice_duedate->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->invoice_duedate->ViewValue, 6);
			$reportmemberinfo->invoice_duedate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// notice_senddate
			$reportmemberinfo->notice_senddate->ViewValue = $reportmemberinfo->notice_senddate->CurrentValue;
			$reportmemberinfo->notice_senddate->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->notice_senddate->ViewValue, 6);
			$reportmemberinfo->notice_senddate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// notice_duedate
			$reportmemberinfo->notice_duedate->ViewValue = $reportmemberinfo->notice_duedate->CurrentValue;
			$reportmemberinfo->notice_duedate->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->notice_duedate->ViewValue, 6);
			$reportmemberinfo->notice_duedate->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// t_title
			$reportmemberinfo->t_title->ViewValue = $reportmemberinfo->t_title->CurrentValue;
			$reportmemberinfo->t_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// v_title
			$reportmemberinfo->v_title->ViewValue = $reportmemberinfo->v_title->CurrentValue;
			$reportmemberinfo->v_title->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_death_begin
			$reportmemberinfo->pay_death_begin->ViewValue = $reportmemberinfo->pay_death_begin->CurrentValue;
			$reportmemberinfo->pay_death_begin->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_death_end
			$reportmemberinfo->pay_death_end->ViewValue = $reportmemberinfo->pay_death_end->CurrentValue;
			$reportmemberinfo->pay_death_end->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_annual_year
			$reportmemberinfo->pay_annual_year->ViewValue = $reportmemberinfo->pay_annual_year->CurrentValue;
			$reportmemberinfo->pay_annual_year->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_date
			$reportmemberinfo->pay_sum_date->ViewValue = $reportmemberinfo->pay_sum_date->CurrentValue;
			$reportmemberinfo->pay_sum_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->pay_sum_date->ViewValue, 6);
			$reportmemberinfo->pay_sum_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_detail
			$reportmemberinfo->pay_sum_detail->ViewValue = $reportmemberinfo->pay_sum_detail->CurrentValue;
			$reportmemberinfo->pay_sum_detail->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_adv_num
			$reportmemberinfo->pay_sum_adv_num->ViewValue = $reportmemberinfo->pay_sum_adv_num->CurrentValue;
			$reportmemberinfo->pay_sum_adv_num->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// pay_sum_note
			$reportmemberinfo->pay_sum_note->ViewValue = $reportmemberinfo->pay_sum_note->CurrentValue;
			$reportmemberinfo->pay_sum_note->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// id_code
			$reportmemberinfo->id_code->ViewValue = $reportmemberinfo->id_code->CurrentValue;
			$reportmemberinfo->id_code->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// gender
			$reportmemberinfo->gender->ViewValue = $reportmemberinfo->gender->CurrentValue;
			$reportmemberinfo->gender->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// age
			$reportmemberinfo->age->ViewValue = $reportmemberinfo->age->CurrentValue;
			$reportmemberinfo->age->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// address
			$reportmemberinfo->address->ViewValue = $reportmemberinfo->address->CurrentValue;
			$reportmemberinfo->address->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// phone
			$reportmemberinfo->phone->ViewValue = $reportmemberinfo->phone->CurrentValue;
			$reportmemberinfo->phone->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc1_name
			$reportmemberinfo->bnfc1_name->ViewValue = $reportmemberinfo->bnfc1_name->CurrentValue;
			$reportmemberinfo->bnfc1_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc1_rel
			$reportmemberinfo->bnfc1_rel->ViewValue = $reportmemberinfo->bnfc1_rel->CurrentValue;
			$reportmemberinfo->bnfc1_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_name
			$reportmemberinfo->bnfc2_name->ViewValue = $reportmemberinfo->bnfc2_name->CurrentValue;
			$reportmemberinfo->bnfc2_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc2_rel
			$reportmemberinfo->bnfc2_rel->ViewValue = $reportmemberinfo->bnfc2_rel->CurrentValue;
			$reportmemberinfo->bnfc2_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_name
			$reportmemberinfo->bnfc3_name->ViewValue = $reportmemberinfo->bnfc3_name->CurrentValue;
			$reportmemberinfo->bnfc3_name->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// bnfc3_rel
			$reportmemberinfo->bnfc3_rel->ViewValue = $reportmemberinfo->bnfc3_rel->CurrentValue;
			$reportmemberinfo->bnfc3_rel->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// regis_date
			$reportmemberinfo->regis_date->ViewValue = $reportmemberinfo->regis_date->CurrentValue;
			$reportmemberinfo->regis_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->regis_date->ViewValue, 6);
			$reportmemberinfo->regis_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// effective_date
			$reportmemberinfo->effective_date->ViewValue = $reportmemberinfo->effective_date->CurrentValue;
			$reportmemberinfo->effective_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->effective_date->ViewValue, 6);
			$reportmemberinfo->effective_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// resign_date
			$reportmemberinfo->resign_date->ViewValue = $reportmemberinfo->resign_date->CurrentValue;
			$reportmemberinfo->resign_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->resign_date->ViewValue, 6);
			$reportmemberinfo->resign_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_date
			$reportmemberinfo->dead_date->ViewValue = $reportmemberinfo->dead_date->CurrentValue;
			$reportmemberinfo->dead_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->dead_date->ViewValue, 6);
			$reportmemberinfo->dead_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// member_status
			$reportmemberinfo->member_status->ViewValue = $reportmemberinfo->member_status->CurrentValue;
			$reportmemberinfo->member_status->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// terminate_date
			$reportmemberinfo->terminate_date->ViewValue = $reportmemberinfo->terminate_date->CurrentValue;
			$reportmemberinfo->terminate_date->ViewValue = ewrpt_FormatDateTime($reportmemberinfo->terminate_date->ViewValue, 6);
			$reportmemberinfo->terminate_date->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// dead_id
			$reportmemberinfo->dead_id->ViewValue = $reportmemberinfo->dead_id->CurrentValue;
			$reportmemberinfo->dead_id->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// note
			$reportmemberinfo->note->ViewValue = $reportmemberinfo->note->CurrentValue;
			$reportmemberinfo->note->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// pay_sum_type
		$reportmemberinfo->pay_sum_type->HrefValue = "";

		// cal_type
		$reportmemberinfo->cal_type->HrefValue = "";

		// member_code
		$reportmemberinfo->member_code->HrefValue = "";

		// fname
		$reportmemberinfo->fname->HrefValue = "";

		// lname
		$reportmemberinfo->lname->HrefValue = "";

		// birthdate
		$reportmemberinfo->birthdate->HrefValue = "";

		// pay_sum_total
		$reportmemberinfo->pay_sum_total->HrefValue = "";

		// cal_detail
		$reportmemberinfo->cal_detail->HrefValue = "";

		// adv_num
		$reportmemberinfo->adv_num->HrefValue = "";

		// cal_date
		$reportmemberinfo->cal_date->HrefValue = "";

		// count_member
		$reportmemberinfo->count_member->HrefValue = "";

		// all_member
		$reportmemberinfo->all_member->HrefValue = "";

		// unit_rate
		$reportmemberinfo->unit_rate->HrefValue = "";

		// total
		$reportmemberinfo->total->HrefValue = "";

		// cal_status
		$reportmemberinfo->cal_status->HrefValue = "";

		// invoice_senddate
		$reportmemberinfo->invoice_senddate->HrefValue = "";

		// invoice_duedate
		$reportmemberinfo->invoice_duedate->HrefValue = "";

		// notice_senddate
		$reportmemberinfo->notice_senddate->HrefValue = "";

		// notice_duedate
		$reportmemberinfo->notice_duedate->HrefValue = "";

		// t_title
		$reportmemberinfo->t_title->HrefValue = "";

		// v_title
		$reportmemberinfo->v_title->HrefValue = "";

		// pay_death_begin
		$reportmemberinfo->pay_death_begin->HrefValue = "";

		// pay_death_end
		$reportmemberinfo->pay_death_end->HrefValue = "";

		// pay_annual_year
		$reportmemberinfo->pay_annual_year->HrefValue = "";

		// pay_sum_date
		$reportmemberinfo->pay_sum_date->HrefValue = "";

		// pay_sum_detail
		$reportmemberinfo->pay_sum_detail->HrefValue = "";

		// pay_sum_adv_num
		$reportmemberinfo->pay_sum_adv_num->HrefValue = "";

		// pay_sum_note
		$reportmemberinfo->pay_sum_note->HrefValue = "";

		// id_code
		$reportmemberinfo->id_code->HrefValue = "";

		// gender
		$reportmemberinfo->gender->HrefValue = "";

		// age
		$reportmemberinfo->age->HrefValue = "";

		// address
		$reportmemberinfo->address->HrefValue = "";

		// phone
		$reportmemberinfo->phone->HrefValue = "";

		// bnfc1_name
		$reportmemberinfo->bnfc1_name->HrefValue = "";

		// bnfc1_rel
		$reportmemberinfo->bnfc1_rel->HrefValue = "";

		// bnfc2_name
		$reportmemberinfo->bnfc2_name->HrefValue = "";

		// bnfc2_rel
		$reportmemberinfo->bnfc2_rel->HrefValue = "";

		// bnfc3_name
		$reportmemberinfo->bnfc3_name->HrefValue = "";

		// bnfc3_rel
		$reportmemberinfo->bnfc3_rel->HrefValue = "";

		// regis_date
		$reportmemberinfo->regis_date->HrefValue = "";

		// effective_date
		$reportmemberinfo->effective_date->HrefValue = "";

		// resign_date
		$reportmemberinfo->resign_date->HrefValue = "";

		// dead_date
		$reportmemberinfo->dead_date->HrefValue = "";

		// member_status
		$reportmemberinfo->member_status->HrefValue = "";

		// terminate_date
		$reportmemberinfo->terminate_date->HrefValue = "";

		// dead_id
		$reportmemberinfo->dead_id->HrefValue = "";

		// note
		$reportmemberinfo->note->HrefValue = "";

		// Call Row_Rendered event
		$reportmemberinfo->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $reportmemberinfo;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $reportmemberinfo;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$reportmemberinfo->setOrderBy("");
				$reportmemberinfo->setStartGroup(1);
				$reportmemberinfo->pay_sum_type->setSort("");
				$reportmemberinfo->cal_type->setSort("");
				$reportmemberinfo->member_code->setSort("");
				$reportmemberinfo->fname->setSort("");
				$reportmemberinfo->lname->setSort("");
				$reportmemberinfo->birthdate->setSort("");
				$reportmemberinfo->pay_sum_total->setSort("");
				$reportmemberinfo->cal_detail->setSort("");
				$reportmemberinfo->adv_num->setSort("");
				$reportmemberinfo->cal_date->setSort("");
				$reportmemberinfo->count_member->setSort("");
				$reportmemberinfo->all_member->setSort("");
				$reportmemberinfo->unit_rate->setSort("");
				$reportmemberinfo->total->setSort("");
				$reportmemberinfo->cal_status->setSort("");
				$reportmemberinfo->invoice_senddate->setSort("");
				$reportmemberinfo->invoice_duedate->setSort("");
				$reportmemberinfo->notice_senddate->setSort("");
				$reportmemberinfo->notice_duedate->setSort("");
				$reportmemberinfo->t_title->setSort("");
				$reportmemberinfo->v_title->setSort("");
				$reportmemberinfo->pay_death_begin->setSort("");
				$reportmemberinfo->pay_death_end->setSort("");
				$reportmemberinfo->pay_annual_year->setSort("");
				$reportmemberinfo->pay_sum_date->setSort("");
				$reportmemberinfo->pay_sum_detail->setSort("");
				$reportmemberinfo->pay_sum_adv_num->setSort("");
				$reportmemberinfo->pay_sum_note->setSort("");
				$reportmemberinfo->id_code->setSort("");
				$reportmemberinfo->gender->setSort("");
				$reportmemberinfo->age->setSort("");
				$reportmemberinfo->address->setSort("");
				$reportmemberinfo->phone->setSort("");
				$reportmemberinfo->bnfc1_name->setSort("");
				$reportmemberinfo->bnfc1_rel->setSort("");
				$reportmemberinfo->bnfc2_name->setSort("");
				$reportmemberinfo->bnfc2_rel->setSort("");
				$reportmemberinfo->bnfc3_name->setSort("");
				$reportmemberinfo->bnfc3_rel->setSort("");
				$reportmemberinfo->regis_date->setSort("");
				$reportmemberinfo->effective_date->setSort("");
				$reportmemberinfo->resign_date->setSort("");
				$reportmemberinfo->dead_date->setSort("");
				$reportmemberinfo->member_status->setSort("");
				$reportmemberinfo->terminate_date->setSort("");
				$reportmemberinfo->dead_id->setSort("");
				$reportmemberinfo->note->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$reportmemberinfo->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$reportmemberinfo->CurrentOrderType = @$_GET["ordertype"];
			$reportmemberinfo->UpdateSort($reportmemberinfo->pay_sum_type); // pay_sum_type
			$reportmemberinfo->UpdateSort($reportmemberinfo->cal_type); // cal_type
			$reportmemberinfo->UpdateSort($reportmemberinfo->member_code); // member_code
			$reportmemberinfo->UpdateSort($reportmemberinfo->fname); // fname
			$reportmemberinfo->UpdateSort($reportmemberinfo->lname); // lname
			$reportmemberinfo->UpdateSort($reportmemberinfo->birthdate); // birthdate
			$reportmemberinfo->UpdateSort($reportmemberinfo->pay_sum_total); // pay_sum_total
			$reportmemberinfo->UpdateSort($reportmemberinfo->cal_detail); // cal_detail
			$reportmemberinfo->UpdateSort($reportmemberinfo->adv_num); // adv_num
			$reportmemberinfo->UpdateSort($reportmemberinfo->cal_date); // cal_date
			$reportmemberinfo->UpdateSort($reportmemberinfo->count_member); // count_member
			$reportmemberinfo->UpdateSort($reportmemberinfo->all_member); // all_member
			$reportmemberinfo->UpdateSort($reportmemberinfo->unit_rate); // unit_rate
			$reportmemberinfo->UpdateSort($reportmemberinfo->total); // total
			$reportmemberinfo->UpdateSort($reportmemberinfo->cal_status); // cal_status
			$reportmemberinfo->UpdateSort($reportmemberinfo->invoice_senddate); // invoice_senddate
			$reportmemberinfo->UpdateSort($reportmemberinfo->invoice_duedate); // invoice_duedate
			$reportmemberinfo->UpdateSort($reportmemberinfo->notice_senddate); // notice_senddate
			$reportmemberinfo->UpdateSort($reportmemberinfo->notice_duedate); // notice_duedate
			$reportmemberinfo->UpdateSort($reportmemberinfo->t_title); // t_title
			$reportmemberinfo->UpdateSort($reportmemberinfo->v_title); // v_title
			$reportmemberinfo->UpdateSort($reportmemberinfo->pay_death_begin); // pay_death_begin
			$reportmemberinfo->UpdateSort($reportmemberinfo->pay_death_end); // pay_death_end
			$reportmemberinfo->UpdateSort($reportmemberinfo->pay_annual_year); // pay_annual_year
			$reportmemberinfo->UpdateSort($reportmemberinfo->pay_sum_date); // pay_sum_date
			$reportmemberinfo->UpdateSort($reportmemberinfo->pay_sum_detail); // pay_sum_detail
			$reportmemberinfo->UpdateSort($reportmemberinfo->pay_sum_adv_num); // pay_sum_adv_num
			$reportmemberinfo->UpdateSort($reportmemberinfo->pay_sum_note); // pay_sum_note
			$reportmemberinfo->UpdateSort($reportmemberinfo->id_code); // id_code
			$reportmemberinfo->UpdateSort($reportmemberinfo->gender); // gender
			$reportmemberinfo->UpdateSort($reportmemberinfo->age); // age
			$reportmemberinfo->UpdateSort($reportmemberinfo->address); // address
			$reportmemberinfo->UpdateSort($reportmemberinfo->phone); // phone
			$reportmemberinfo->UpdateSort($reportmemberinfo->bnfc1_name); // bnfc1_name
			$reportmemberinfo->UpdateSort($reportmemberinfo->bnfc1_rel); // bnfc1_rel
			$reportmemberinfo->UpdateSort($reportmemberinfo->bnfc2_name); // bnfc2_name
			$reportmemberinfo->UpdateSort($reportmemberinfo->bnfc2_rel); // bnfc2_rel
			$reportmemberinfo->UpdateSort($reportmemberinfo->bnfc3_name); // bnfc3_name
			$reportmemberinfo->UpdateSort($reportmemberinfo->bnfc3_rel); // bnfc3_rel
			$reportmemberinfo->UpdateSort($reportmemberinfo->regis_date); // regis_date
			$reportmemberinfo->UpdateSort($reportmemberinfo->effective_date); // effective_date
			$reportmemberinfo->UpdateSort($reportmemberinfo->resign_date); // resign_date
			$reportmemberinfo->UpdateSort($reportmemberinfo->dead_date); // dead_date
			$reportmemberinfo->UpdateSort($reportmemberinfo->member_status); // member_status
			$reportmemberinfo->UpdateSort($reportmemberinfo->terminate_date); // terminate_date
			$reportmemberinfo->UpdateSort($reportmemberinfo->dead_id); // dead_id
			$reportmemberinfo->UpdateSort($reportmemberinfo->note); // note
			$sSortSql = $reportmemberinfo->SortSql();
			$reportmemberinfo->setOrderBy($sSortSql);
			$reportmemberinfo->setStartGroup(1);
		}
		return $reportmemberinfo->getOrderBy();
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
