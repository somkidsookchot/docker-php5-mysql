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
$allmemberbystatus = NULL;

//
// Table class for allmemberbystatus
//
class crallmemberbystatus {
	var $TableVar = 'allmemberbystatus';
	var $TableName = 'allmemberbystatus';
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
	function crallmemberbystatus() {
		global $ReportLanguage;

		// village_id
		$this->village_id = new crField('allmemberbystatus', 'allmemberbystatus', 'x_village_id', 'village_id', '`village_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->village_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['village_id'] =& $this->village_id;
		$this->village_id->DateFilter = "";
		$this->village_id->SqlSelect = "";
		$this->village_id->SqlOrderBy = "";

		// v_code
		$this->v_code = new crField('allmemberbystatus', 'allmemberbystatus', 'x_v_code', 'v_code', '`v_code`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->v_code->GroupingFieldId = 2;
		$this->v_code->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['v_code'] =& $this->v_code;
		$this->v_code->DateFilter = "";
		$this->v_code->SqlSelect = "";
		$this->v_code->SqlOrderBy = "";

		// v_title
		$this->v_title = new crField('allmemberbystatus', 'allmemberbystatus', 'x_v_title', 'v_title', '`v_title`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->v_title->GroupingFieldId = 3;
		$this->fields['v_title'] =& $this->v_title;
		$this->v_title->DateFilter = "";
		$this->v_title->SqlSelect = "";
		$this->v_title->SqlOrderBy = "";

		// t_code
		$this->t_code = new crField('allmemberbystatus', 'allmemberbystatus', 'x_t_code', 't_code', '`t_code`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['t_code'] =& $this->t_code;
		$this->t_code->DateFilter = "";
		$this->t_code->SqlSelect = "";
		$this->t_code->SqlOrderBy = "";

		// flag
		$this->flag = new crField('allmemberbystatus', 'allmemberbystatus', 'x_flag', 'flag', '`flag`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->flag->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['flag'] =& $this->flag;
		$this->flag->DateFilter = "";
		$this->flag->SqlSelect = "";
		$this->flag->SqlOrderBy = "";

		// member_id
		$this->member_id = new crField('allmemberbystatus', 'allmemberbystatus', 'x_member_id', 'member_id', '`member_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->member_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['member_id'] =& $this->member_id;
		$this->member_id->DateFilter = "";
		$this->member_id->SqlSelect = "";
		$this->member_id->SqlOrderBy = "";

		// member_status
		$this->member_status = new crField('allmemberbystatus', 'allmemberbystatus', 'x_member_status', 'member_status', 'members.member_status', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_status'] =& $this->member_status;
		$this->member_status->DateFilter = "";
		$this->member_status->SqlSelect = "";
		$this->member_status->SqlOrderBy = "";

		// t_id
		$this->t_id = new crField('allmemberbystatus', 'allmemberbystatus', 'x_t_id', 't_id', '`t_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->t_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['t_id'] =& $this->t_id;
		$this->t_id->DateFilter = "";
		$this->t_id->SqlSelect = "";
		$this->t_id->SqlOrderBy = "";

		// t_title
		$this->t_title = new crField('allmemberbystatus', 'allmemberbystatus', 'x_t_title', 't_title', '`t_title`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->t_title->GroupingFieldId = 1;
		$this->fields['t_title'] =& $this->t_title;
		$this->t_title->DateFilter = "";
		$this->t_title->SqlSelect = "";
		$this->t_title->SqlOrderBy = "";

		// t_order
		$this->t_order = new crField('allmemberbystatus', 'allmemberbystatus', 'x_t_order', 't_order', '`t_order`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->t_order->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['t_order'] =& $this->t_order;
		$this->t_order->DateFilter = "";
		$this->t_order->SqlSelect = "";
		$this->t_order->SqlOrderBy = "";

		// member_type
		$this->member_type = new crField('allmemberbystatus', 'allmemberbystatus', 'x_member_type', 'member_type', '`member_type`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->member_type->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['member_type'] =& $this->member_type;
		$this->member_type->DateFilter = "";
		$this->member_type->SqlSelect = "";
		$this->member_type->SqlOrderBy = "";

		// member_code
		$this->member_code = new crField('allmemberbystatus', 'allmemberbystatus', 'x_member_code', 'member_code', '`member_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['member_code'] =& $this->member_code;
		$this->member_code->DateFilter = "";
		$this->member_code->SqlSelect = "";
		$this->member_code->SqlOrderBy = "";

		// id_code
		$this->id_code = new crField('allmemberbystatus', 'allmemberbystatus', 'x_id_code', 'id_code', '`id_code`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['id_code'] =& $this->id_code;
		$this->id_code->DateFilter = "";
		$this->id_code->SqlSelect = "";
		$this->id_code->SqlOrderBy = "";

		// gender
		$this->gender = new crField('allmemberbystatus', 'allmemberbystatus', 'x_gender', 'gender', '`gender`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['gender'] =& $this->gender;
		$this->gender->DateFilter = "";
		$this->gender->SqlSelect = "";
		$this->gender->SqlOrderBy = "";

		// prefix
		$this->prefix = new crField('allmemberbystatus', 'allmemberbystatus', 'x_prefix', 'prefix', '`prefix`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['prefix'] =& $this->prefix;
		$this->prefix->DateFilter = "";
		$this->prefix->SqlSelect = "";
		$this->prefix->SqlOrderBy = "";

		// fname
		$this->fname = new crField('allmemberbystatus', 'allmemberbystatus', 'x_fname', 'fname', '`fname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['fname'] =& $this->fname;
		$this->fname->DateFilter = "";
		$this->fname->SqlSelect = "";
		$this->fname->SqlOrderBy = "";

		// lname
		$this->lname = new crField('allmemberbystatus', 'allmemberbystatus', 'x_lname', 'lname', '`lname`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['lname'] =& $this->lname;
		$this->lname->DateFilter = "";
		$this->lname->SqlSelect = "";
		$this->lname->SqlOrderBy = "";

		// birthdate
		$this->birthdate = new crField('allmemberbystatus', 'allmemberbystatus', 'x_birthdate', 'birthdate', '`birthdate`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->birthdate->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['birthdate'] =& $this->birthdate;
		$this->birthdate->DateFilter = "";
		$this->birthdate->SqlSelect = "";
		$this->birthdate->SqlOrderBy = "";

		// age
		$this->age = new crField('allmemberbystatus', 'allmemberbystatus', 'x_age', 'age', '`age`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->age->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['age'] =& $this->age;
		$this->age->DateFilter = "";
		$this->age->SqlSelect = "";
		$this->age->SqlOrderBy = "";

		// email
		$this->zemail = new crField('allmemberbystatus', 'allmemberbystatus', 'x_zemail', 'email', '`email`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['zemail'] =& $this->zemail;
		$this->zemail->DateFilter = "";
		$this->zemail->SqlSelect = "";
		$this->zemail->SqlOrderBy = "";

		// phone
		$this->phone = new crField('allmemberbystatus', 'allmemberbystatus', 'x_phone', 'phone', '`phone`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['phone'] =& $this->phone;
		$this->phone->DateFilter = "";
		$this->phone->SqlSelect = "";
		$this->phone->SqlOrderBy = "";

		// address
		$this->address = new crField('allmemberbystatus', 'allmemberbystatus', 'x_address', 'address', '`address`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['address'] =& $this->address;
		$this->address->DateFilter = "";
		$this->address->SqlSelect = "";
		$this->address->SqlOrderBy = "";

		// suffix
		$this->suffix = new crField('allmemberbystatus', 'allmemberbystatus', 'x_suffix', 'suffix', '`suffix`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['suffix'] =& $this->suffix;
		$this->suffix->DateFilter = "";
		$this->suffix->SqlSelect = "";
		$this->suffix->SqlOrderBy = "";

		// bnfc1_name
		$this->bnfc1_name = new crField('allmemberbystatus', 'allmemberbystatus', 'x_bnfc1_name', 'bnfc1_name', '`bnfc1_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_name'] =& $this->bnfc1_name;
		$this->bnfc1_name->DateFilter = "";
		$this->bnfc1_name->SqlSelect = "";
		$this->bnfc1_name->SqlOrderBy = "";

		// bnfc1_rel
		$this->bnfc1_rel = new crField('allmemberbystatus', 'allmemberbystatus', 'x_bnfc1_rel', 'bnfc1_rel', '`bnfc1_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc1_rel'] =& $this->bnfc1_rel;
		$this->bnfc1_rel->DateFilter = "";
		$this->bnfc1_rel->SqlSelect = "";
		$this->bnfc1_rel->SqlOrderBy = "";

		// bnfc2_name
		$this->bnfc2_name = new crField('allmemberbystatus', 'allmemberbystatus', 'x_bnfc2_name', 'bnfc2_name', '`bnfc2_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_name'] =& $this->bnfc2_name;
		$this->bnfc2_name->DateFilter = "";
		$this->bnfc2_name->SqlSelect = "";
		$this->bnfc2_name->SqlOrderBy = "";

		// bnfc2_rel
		$this->bnfc2_rel = new crField('allmemberbystatus', 'allmemberbystatus', 'x_bnfc2_rel', 'bnfc2_rel', '`bnfc2_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc2_rel'] =& $this->bnfc2_rel;
		$this->bnfc2_rel->DateFilter = "";
		$this->bnfc2_rel->SqlSelect = "";
		$this->bnfc2_rel->SqlOrderBy = "";

		// bnfc3_name
		$this->bnfc3_name = new crField('allmemberbystatus', 'allmemberbystatus', 'x_bnfc3_name', 'bnfc3_name', '`bnfc3_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_name'] =& $this->bnfc3_name;
		$this->bnfc3_name->DateFilter = "";
		$this->bnfc3_name->SqlSelect = "";
		$this->bnfc3_name->SqlOrderBy = "";

		// bnfc3_rel
		$this->bnfc3_rel = new crField('allmemberbystatus', 'allmemberbystatus', 'x_bnfc3_rel', 'bnfc3_rel', '`bnfc3_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc3_rel'] =& $this->bnfc3_rel;
		$this->bnfc3_rel->DateFilter = "";
		$this->bnfc3_rel->SqlSelect = "";
		$this->bnfc3_rel->SqlOrderBy = "";

		// bnfc4_name
		$this->bnfc4_name = new crField('allmemberbystatus', 'allmemberbystatus', 'x_bnfc4_name', 'bnfc4_name', '`bnfc4_name`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc4_name'] =& $this->bnfc4_name;
		$this->bnfc4_name->DateFilter = "";
		$this->bnfc4_name->SqlSelect = "";
		$this->bnfc4_name->SqlOrderBy = "";

		// bnfc4_rel
		$this->bnfc4_rel = new crField('allmemberbystatus', 'allmemberbystatus', 'x_bnfc4_rel', 'bnfc4_rel', '`bnfc4_rel`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['bnfc4_rel'] =& $this->bnfc4_rel;
		$this->bnfc4_rel->DateFilter = "";
		$this->bnfc4_rel->SqlSelect = "";
		$this->bnfc4_rel->SqlOrderBy = "";

		// attachment
		$this->attachment = new crField('allmemberbystatus', 'allmemberbystatus', 'x_attachment', 'attachment', '`attachment`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['attachment'] =& $this->attachment;
		$this->attachment->DateFilter = "";
		$this->attachment->SqlSelect = "";
		$this->attachment->SqlOrderBy = "";

		// regis_date
		$this->regis_date = new crField('allmemberbystatus', 'allmemberbystatus', 'x_regis_date', 'regis_date', '`regis_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->regis_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['regis_date'] =& $this->regis_date;
		$this->regis_date->DateFilter = "Day";
		$this->regis_date->SqlSelect = "";
		$this->regis_date->SqlOrderBy = "";

		// effective_date
		$this->effective_date = new crField('allmemberbystatus', 'allmemberbystatus', 'x_effective_date', 'effective_date', '`effective_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->effective_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['effective_date'] =& $this->effective_date;
		$this->effective_date->DateFilter = "";
		$this->effective_date->SqlSelect = "";
		$this->effective_date->SqlOrderBy = "";

		// resign_date
		$this->resign_date = new crField('allmemberbystatus', 'allmemberbystatus', 'x_resign_date', 'resign_date', '`resign_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->resign_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['resign_date'] =& $this->resign_date;
		$this->resign_date->DateFilter = "";
		$this->resign_date->SqlSelect = "";
		$this->resign_date->SqlOrderBy = "";

		// dead_date
		$this->dead_date = new crField('allmemberbystatus', 'allmemberbystatus', 'x_dead_date', 'dead_date', '`dead_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->dead_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['dead_date'] =& $this->dead_date;
		$this->dead_date->DateFilter = "";
		$this->dead_date->SqlSelect = "";
		$this->dead_date->SqlOrderBy = "";

		// terminate_date
		$this->terminate_date = new crField('allmemberbystatus', 'allmemberbystatus', 'x_terminate_date', 'terminate_date', '`terminate_date`', 133, EWRPT_DATATYPE_DATE, 7);
		$this->terminate_date->FldDefaultErrMsg = str_replace("%s", "-", $ReportLanguage->Phrase("IncorrectDateDMY"));
		$this->fields['terminate_date'] =& $this->terminate_date;
		$this->terminate_date->DateFilter = "";
		$this->terminate_date->SqlSelect = "";
		$this->terminate_date->SqlOrderBy = "";

		// advance_budget
		$this->advance_budget = new crField('allmemberbystatus', 'allmemberbystatus', 'x_advance_budget', 'advance_budget', '`advance_budget`', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->advance_budget->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['advance_budget'] =& $this->advance_budget;
		$this->advance_budget->DateFilter = "";
		$this->advance_budget->SqlSelect = "";
		$this->advance_budget->SqlOrderBy = "";

		// dead_id
		$this->dead_id = new crField('allmemberbystatus', 'allmemberbystatus', 'x_dead_id', 'dead_id', '`dead_id`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->dead_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['dead_id'] =& $this->dead_id;
		$this->dead_id->DateFilter = "";
		$this->dead_id->SqlSelect = "";
		$this->dead_id->SqlOrderBy = "";

		// note
		$this->note = new crField('allmemberbystatus', 'allmemberbystatus', 'x_note', 'note', '`note`', 201, EWRPT_DATATYPE_MEMO, -1);
		$this->fields['note'] =& $this->note;
		$this->note->DateFilter = "";
		$this->note->SqlSelect = "";
		$this->note->SqlOrderBy = "";

		// update_detail
		$this->update_detail = new crField('allmemberbystatus', 'allmemberbystatus', 'x_update_detail', 'update_detail', '`update_detail`', 201, EWRPT_DATATYPE_MEMO, -1);
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
	function ColumnField() { // Column field
		return "members.member_status";
	}

	function ColumnDateType() { // Column date type
		return "";
	}

	function SummaryField() { // Summary field
		return "`member_id`";
	}

	function SummaryType() { // Summary type
		return "COUNT";
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
		return "tambon Right Join village On tambon.t_code = village.t_code Right Join members On village.village_id = members.village_id";
	}

	function SqlSelect() { // Select
		return "SELECT `t_title`, `v_code`, `v_title`, <DistinctColumnFields> FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		return "";
	}

	function SqlGroupBy() { // Group By
		return "`t_title`, `v_code`, `v_title`";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "`t_title` ASC, `v_code` ASC, `v_title` ASC";
	}

	function SqlDistinctSelect() {
		return "SELECT DISTINCT members.member_status FROM tambon Right Join village On tambon.t_code = village.t_code Right Join members On village.village_id = members.village_id";
	}

	function SqlDistinctWhere() {
		return "";
	}

	function SqlDistinctOrderBy() {
		return "members.member_status ASC";
	}

	// Table Level Group SQL
	function SqlFirstGroupField() {
		return "`t_title`";
	}

	function SqlSelectGroup() {
		return "SELECT DISTINCT " . $this->SqlFirstGroupField() . " AS `t_title` FROM " . $this->SqlFrom();
	}

	function SqlOrderByGroup() {
		return "`t_title` ASC";
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
$allmemberbystatus_crosstab = new crallmemberbystatus_crosstab();
$Page =& $allmemberbystatus_crosstab;

// Page init
$allmemberbystatus_crosstab->Page_Init();

// Page main
$allmemberbystatus_crosstab->Page_Main();
?>
<?php if (@$gsExport == "") { ?>
<?php include "header.php"; ?>
<?php } ?>
<?php include "phprptinc/header.php"; ?>
<?php if ($allmemberbystatus->Export == "") { ?>
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
<?php $allmemberbystatus_crosstab->ShowPageHeader(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php $allmemberbystatus_crosstab->ShowMessage(); ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php if ($allmemberbystatus->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<!-- Table container (begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0" width="100%">
<!-- Top container (begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<div class="ewTitle"><?php if (!$_GET["export"]) { ?><img src="images/ico_all_member.png" width="40" height="40" align="absmiddle" /><?php } ?><?php echo $allmemberbystatus->TableCaption() ?></div>
<div class="clear"></div>
<?php if ($allmemberbystatus->Export == "") { ?>
<a href="<?php echo $allmemberbystatus_crosstab->ExportExcelUrl ?>"><img src="images/bt_export_excel.png" vspace="10" border="0" align="absmiddle"/></a>
<?php } ?>

<?php if ($allmemberbystatus->Export == "") { ?>
</div></td></tr>
<!-- Top container (end) -->
<tr>
	<!-- Left container (begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- left slot -->
<?php } ?>
<?php if ($allmemberbystatus->Export == "") { ?>
	</div></td>
	<!-- Left container (end) -->
	<!-- Center container (report) (begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- crosstab report starts -->
<div id="report_crosstab">
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<?php if ($allmemberbystatus->Export == "") { ?>
<div class="ewGridUpperPanel">
<form action="allmemberbystatusctb.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($allmemberbystatus_crosstab->StartGrp, $allmemberbystatus_crosstab->DisplayGrps, $allmemberbystatus_crosstab->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="allmemberbystatusctb.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="allmemberbystatusctb.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="allmemberbystatusctb.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="allmemberbystatusctb.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($allmemberbystatus_crosstab->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($allmemberbystatus_crosstab->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($allmemberbystatus->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($allmemberbystatus_crosstab->ShowFirstHeader) { // Show header ?>
	<thead>
	<!-- Table header -->
	<tr class="ewTableRow">
		<td colspan="3" style="white-space: nowrap;"><div class="phpreportmaker"><?php echo $allmemberbystatus->member_id->FldCaption() ?>&nbsp;(<?php echo $ReportLanguage->Phrase("RptCnt") ?>)&nbsp;</div></td>
		<td class="ewRptColHeader" colspan="<?php echo @$allmemberbystatus_crosstab->ColSpan; ?>" style="white-space: nowrap;">
			<?php echo $allmemberbystatus->member_status->FldCaption() ?>
		</td>
	</tr>
	<tr>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($allmemberbystatus->SortUrl($allmemberbystatus->t_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $allmemberbystatus->t_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $allmemberbystatus->SortUrl($allmemberbystatus->t_title) ?>',1);"><?php echo $allmemberbystatus->t_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($allmemberbystatus->t_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($allmemberbystatus->t_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($allmemberbystatus->SortUrl($allmemberbystatus->v_code) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $allmemberbystatus->v_code->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $allmemberbystatus->SortUrl($allmemberbystatus->v_code) ?>',1);"><?php echo $allmemberbystatus->v_code->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($allmemberbystatus->v_code->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($allmemberbystatus->v_code->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<td class="ewTableHeader">
	<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><tr>
<?php if ($allmemberbystatus->SortUrl($allmemberbystatus->v_title) == "") { ?>
		<td style="vertical-align: bottom;" style="white-space: nowrap;"><?php echo $allmemberbystatus->v_title->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $allmemberbystatus->SortUrl($allmemberbystatus->v_title) ?>',1);"><?php echo $allmemberbystatus->v_title->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($allmemberbystatus->v_title->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($allmemberbystatus->v_title->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
</td>
<!-- Dynamic columns begin -->
	<?php
	$cntval = count($allmemberbystatus_crosstab->Val);
	for ($iy = 1; $iy < $cntval; $iy++) {
		if ($allmemberbystatus_crosstab->Col[$iy]->Visible) {
			$allmemberbystatus->SummaryCurrentValue[$iy-1] = $allmemberbystatus_crosstab->Col[$iy]->Caption;
			$allmemberbystatus->SummaryViewValue[$iy-1] = $allmemberbystatus->SummaryCurrentValue[$iy-1];
	?>
		<td class="ewTableHeader" style="vertical-align: top;"><?php echo $allmemberbystatus->SummaryViewValue[$iy-1]; ?></td>
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
if ($allmemberbystatus_crosstab->TotalGrps > 0) {

// Set the last group to display if not export all
if ($allmemberbystatus->ExportAll && $allmemberbystatus->Export <> "") {
	$allmemberbystatus_crosstab->StopGrp = $allmemberbystatus_crosstab->TotalGrps;
} else {
	$allmemberbystatus_crosstab->StopGrp = $allmemberbystatus_crosstab->StartGrp + $allmemberbystatus_crosstab->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($allmemberbystatus_crosstab->StopGrp) > intval($allmemberbystatus_crosstab->TotalGrps)) {
	$allmemberbystatus_crosstab->StopGrp = $allmemberbystatus_crosstab->TotalGrps;
}

// Navigate
$allmemberbystatus_crosstab->RecCount = 0;

// Get first row
if ($allmemberbystatus_crosstab->TotalGrps > 0) {
	$allmemberbystatus_crosstab->GetGrpRow(1);
	$allmemberbystatus_crosstab->GrpCount = 1;
}
while ($rsgrp && !$rsgrp->EOF && $allmemberbystatus_crosstab->GrpCount <= $allmemberbystatus_crosstab->DisplayGrps) {

	// Build detail SQL
	$sWhere = ewrpt_DetailFilterSQL($allmemberbystatus->t_title, $allmemberbystatus->SqlFirstGroupField(), $allmemberbystatus->t_title->GroupValue());
	if ($allmemberbystatus_crosstab->Filter != "")
		$sWhere = "($allmemberbystatus_crosstab->Filter) AND ($sWhere)";
	$sSql = ewrpt_BuildReportSql($allmemberbystatus_crosstab->SqlSelectWork, $allmemberbystatus->SqlWhere(), $allmemberbystatus->SqlGroupBy(), "", $allmemberbystatus->SqlOrderBy(), $sWhere, $allmemberbystatus_crosstab->Sort);
	$rs = $conn->Execute($sSql);
	$rsdtlcnt = ($rs) ? $rs->RecordCount() : 0;
	if ($rsdtlcnt > 0)
		$allmemberbystatus_crosstab->GetRow(1);
	while ($rs && !$rs->EOF) {
		$allmemberbystatus_crosstab->RecCount++;

		// Render row
		$allmemberbystatus->ResetCSS();
		$allmemberbystatus->RowType = EWRPT_ROWTYPE_DETAIL;
		$allmemberbystatus_crosstab->RenderRow();
?>
	<!-- Data -->
	<tr<?php echo $allmemberbystatus->RowAttributes(); ?>>
		<!-- µÓºÅ -->
		<td<?php echo $allmemberbystatus->t_title->CellAttributes(); ?>><div<?php echo $allmemberbystatus->t_title->ViewAttributes(); ?>><?php echo $allmemberbystatus->t_title->GroupViewValue; ?></div></td>
		<!-- ËÁÙè·Õè -->
		<td<?php echo $allmemberbystatus->v_code->CellAttributes(); ?>><div<?php echo $allmemberbystatus->v_code->ViewAttributes(); ?>><?php echo $allmemberbystatus->v_code->GroupViewValue; ?></div></td>
		<!-- ª×èÍËÁÙèºéÒ¹ -->
		<td<?php echo $allmemberbystatus->v_title->CellAttributes(); ?>><div<?php echo $allmemberbystatus->v_title->ViewAttributes(); ?>><?php echo $allmemberbystatus->v_title->GroupViewValue; ?></div></td>
<!-- Dynamic columns begin -->
	<?php
		$cntcol = count($allmemberbystatus->SummaryViewValue);
		for ($iy = 1; $iy <= $cntcol; $iy++) {
			$bColShow = ($iy <= $allmemberbystatus_crosstab->ColCount) ? $allmemberbystatus_crosstab->Col[$iy]->Visible : TRUE;
			$sColDesc = ($iy <= $allmemberbystatus_crosstab->ColCount) ? $allmemberbystatus_crosstab->Col[$iy]->Caption : $ReportLanguage->Phrase("Summary");
			if ($bColShow) {
	?>
		<!-- <?php //echo $allmemberbystatus_crosstab->Col[$iy]->Caption; ?> -->
		<!-- <?php echo $sColDesc; ?> -->
		<td<?php echo $allmemberbystatus->SummaryCellAttributes($iy-1) ?>><div<?php echo $allmemberbystatus->SummaryViewAttributes($iy-1); ?>><?php echo $allmemberbystatus->SummaryViewValue[$iy-1]; ?></div></td>
	<?php
			}
		}
	?>
<!-- Dynamic columns end -->
	</tr>
<?php

		// Accumulate page summary
		$allmemberbystatus_crosstab->AccumulateSummary();

		// Get next record
		$allmemberbystatus_crosstab->GetRow(2);
?>
<?php
	} // End detail records loop
?>
<?php

		// Process summary level 1
		if ($allmemberbystatus_crosstab->ChkLvlBreak(1)) {
			$allmemberbystatus->ResetCSS();
			$allmemberbystatus->RowType = EWRPT_ROWTYPE_TOTAL;
			$allmemberbystatus->RowTotalType = EWRPT_ROWTOTAL_GROUP;
			$allmemberbystatus->RowTotalSubType = EWRPT_ROWTOTAL_FOOTER;
			$allmemberbystatus->RowGroupLevel = 1;
			$allmemberbystatus_crosstab->RenderRow();
?>
	<!-- Summary µÓºÅ (level 1) -->
	<tr<?php echo $allmemberbystatus->RowAttributes(); ?>>
		<td colspan="3"<?php echo $allmemberbystatus->t_title->CellAttributes() ?>><?php echo $ReportLanguage->Phrase("RptSumHead") ?> <?php echo $allmemberbystatus->t_title->FldCaption() ?>: <?php echo $allmemberbystatus->t_title->GroupViewValue; ?></td>
<!-- Dynamic columns begin -->
	<?php
	$cntcol = count($allmemberbystatus->SummaryViewValue);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$bColShow = ($iy <= $allmemberbystatus_crosstab->ColCount) ? $allmemberbystatus_crosstab->Col[$iy]->Visible : TRUE;
		$sColDesc = ($iy <= $allmemberbystatus_crosstab->ColCount) ? $allmemberbystatus_crosstab->Col[$iy]->Caption : $ReportLanguage->Phrase("Summary");
		if ($bColShow) {
	?>
		<!-- <?php //echo $allmemberbystatus_crosstab->Col[$iy]->Caption; ?> -->
		<!-- <?php echo $sColDesc; ?> -->
		<td<?php echo $allmemberbystatus->SummaryCellAttributes($iy-1) ?>><div<?php echo $allmemberbystatus->SummaryViewAttributes($iy-1); ?>><?php echo $allmemberbystatus->SummaryViewValue[$iy-1]; ?></div></td>
	<?php
		}
	}
	?>
<!-- Dynamic columns end -->
	</tr>
<?php

			// Reset level 1 summary
			$allmemberbystatus_crosstab->ResetLevelSummary(1);
		}
?>
<?php
	$allmemberbystatus_crosstab->GetGrpRow(2);
	$allmemberbystatus_crosstab->GrpCount++;
}
?>
	</tbody>
	<tfoot>
<?php
			$allmemberbystatus->ResetCSS();
			$allmemberbystatus->RowType = EWRPT_ROWTYPE_TOTAL;
			$allmemberbystatus->RowTotalType = EWRPT_ROWTOTAL_PAGE;
			$allmemberbystatus->RowAttrs["class"] = "ewRptPageSummary";
			$allmemberbystatus_crosstab->RenderRow();
?>
	<!-- Page Summary -->
	<tr<?php echo $allmemberbystatus->RowAttributes(); ?>>
	<td colspan="3"><?php echo $ReportLanguage->Phrase("RptPageTotal"); ?></td>
<!-- Dynamic columns begin -->
	<?php
	$cntcol = count($allmemberbystatus->SummaryViewValue);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$bColShow = ($iy <= $allmemberbystatus_crosstab->ColCount) ? $allmemberbystatus_crosstab->Col[$iy]->Visible : TRUE;
		$sColDesc = ($iy <= $allmemberbystatus_crosstab->ColCount) ? $allmemberbystatus_crosstab->Col[$iy]->Caption : $ReportLanguage->Phrase("Summary");
		if ($bColShow) {
	?>
		<!-- <?php //echo $allmemberbystatus_crosstab->Col[$iy]->Caption; ?> -->
		<!-- <?php echo $sColDesc; ?> -->
		<td<?php echo $allmemberbystatus->SummaryCellAttributes($iy-1) ?>><div<?php echo $allmemberbystatus->SummaryViewAttributes($iy-1); ?>><?php echo number_format($allmemberbystatus->SummaryViewValue[$iy-1]); ?></div></td>
	<?php
		}
	}
	?>
<!-- Dynamic columns end -->
	</tr>
<?php
			$allmemberbystatus->ResetCSS();
			$allmemberbystatus->RowType = EWRPT_ROWTYPE_TOTAL;
			$allmemberbystatus->RowTotalType = EWRPT_ROWTOTAL_GRAND;
			$allmemberbystatus->RowAttrs["class"] = "ewRptGrandSummary";
			$allmemberbystatus_crosstab->RenderRow();
?>
	<!-- Grand Total -->
	<tr<?php echo $allmemberbystatus->RowAttributes(); ?>>
	<td colspan="3"><?php echo $ReportLanguage->Phrase("RptGrandTotal"); ?></td>
<!-- Dynamic columns begin -->
	<?php 
	$cntcol = count($allmemberbystatus->SummaryViewValue);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$bColShow = ($iy <= $allmemberbystatus_crosstab->ColCount) ? $allmemberbystatus_crosstab->Col[$iy]->Visible : TRUE;
		$sColDesc = ($iy <= $allmemberbystatus_crosstab->ColCount) ? $allmemberbystatus_crosstab->Col[$iy]->Caption : $ReportLanguage->Phrase("Summary");
		if ($bColShow) {
	?>
		<!-- <?php //echo $allmemberbystatus_crosstab->Col[$iy]->Caption; ?> -->
		<!-- <?php echo $sColDesc; ?> -->
		<td<?php echo $allmemberbystatus->SummaryCellAttributes($iy-1) ?>><div<?php echo $allmemberbystatus->SummaryViewAttributes($iy-1); ?>><?php echo number_format($allmemberbystatus->SummaryViewValue[$iy-1]); ?></div></td>
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
<?php if ($allmemberbystatus_crosstab->TotalGrps > 0) { ?>
<?php if ($allmemberbystatus->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="allmemberbystatusctb.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($allmemberbystatus_crosstab->StartGrp, $allmemberbystatus_crosstab->DisplayGrps, $allmemberbystatus_crosstab->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="allmemberbystatusctb.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="allmemberbystatusctb.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="allmemberbystatusctb.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="allmemberbystatusctb.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($allmemberbystatus_crosstab->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($allmemberbystatus_crosstab->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("GroupsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($allmemberbystatus_crosstab->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($allmemberbystatus->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($allmemberbystatus->Export == "") { ?>
	</div><br /></td>
	<!-- Center container (report) (end) -->
	<!-- Right container (begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- right slot -->
<?php } ?>
<?php if ($allmemberbystatus->Export == "") { ?>
	</div></td>
	<!-- Right container (end) -->
</tr>
<!-- Bottom container (begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- bottom slot -->
<?php } ?>
<?php if ($allmemberbystatus->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom container (end) -->
</table>
<!-- Table container (end) -->
<?php } ?>
<?php $allmemberbystatus_crosstab->ShowPageFooter(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($allmemberbystatus->Export == "") { ?>
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
$allmemberbystatus_crosstab->Page_Terminate();
?>
<?php

//
// Page class
//
class crallmemberbystatus_crosstab {

	// Page ID
	var $PageID = 'crosstab';

	// Table name
	var $TableName = 'allmemberbystatus';

	// Page object name
	var $PageObjName = 'allmemberbystatus_crosstab';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $allmemberbystatus;
		if ($allmemberbystatus->UseTokenInUrl) $PageUrl .= "t=" . $allmemberbystatus->TableVar . "&"; // Add page token
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
		global $allmemberbystatus;
		if ($allmemberbystatus->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($allmemberbystatus->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($allmemberbystatus->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crallmemberbystatus_crosstab() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (allmemberbystatus)
		$GLOBALS["allmemberbystatus"] = new crallmemberbystatus();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'crosstab', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'allmemberbystatus', TRUE);

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
		global $allmemberbystatus;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$allmemberbystatus->Export = $_GET["export"];
	}
	$gsExport = $allmemberbystatus->Export; // Get export parameter, used in header
	$gsExportFile = $allmemberbystatus->TableVar; // Get export file, used in header
	if ($allmemberbystatus->Export == "excel") {
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
		global $allmemberbystatus;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($allmemberbystatus->Export == "email") {
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
		global $allmemberbystatus;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Get sort
		$this->Sort = $this->GetSort();

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();

		// Popup values and selections
		// Set up popup filter

		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

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

		// No filter
		$this->FilterApplied = FALSE;

		// Get total group count
		$sGrpSort = ewrpt_UpdateSortFields($allmemberbystatus->SqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
		$sSql = ewrpt_BuildReportSql($allmemberbystatus->SqlSelectGroup(), $allmemberbystatus->SqlWhere(), $allmemberbystatus->SqlGroupBy(), "", $allmemberbystatus->SqlOrderByGroup(), $this->Filter, $sGrpSort);
		$this->TotalGrps = $this->GetGrpCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($allmemberbystatus->ExportAll && $allmemberbystatus->Export <> "")
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
		global $allmemberbystatus;
		global $ReportLanguage;

		// Build SQL
		$sSql = ewrpt_BuildReportSql($allmemberbystatus->SqlDistinctSelect(), $allmemberbystatus->SqlDistinctWhere(), "", "", $allmemberbystatus->SqlDistinctOrderBy(), "", "");

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
		if (!is_array($allmemberbystatus->member_status->SelectionList)) {
			$this->ColSpan = $this->ColCount;
		} else {
			$this->ColSpan = 0;
			for ($i = 1; $i <= $this->ColCount; $i++) {
				$bSelected = FALSE;
				$cntsel = count($allmemberbystatus->member_status->SelectionList);
				for ($j = 0; $j < $cntsel; $j++) {
					if (ewrpt_CompareValue($allmemberbystatus->member_status->SelectionList[$j], $this->Col[$i]->Value, $allmemberbystatus->member_status->FldType)) {
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
			$sFld = ewrpt_CrossTabField($allmemberbystatus->SummaryType(), $allmemberbystatus->SummaryField(), $allmemberbystatus->ColumnField(), $allmemberbystatus->ColumnDateType(), $this->Col[$colcnt]->Value, "'", "C" . $colcnt);
			if ($sSqlFlds <> "")
				$sSqlFlds .= ", ";
			$sSqlFlds .= $sFld;
		}
		$this->SqlSelectWork = str_replace("<DistinctColumnFields>", $sSqlFlds, $allmemberbystatus->SqlSelect());
		$this->SqlSelectAggWork = str_replace("<DistinctColumnFields>", $sSqlFlds, $allmemberbystatus->SqlSelectAgg());

		// Update chart sql if Y Axis = Column Field
		$this->SqlChartWork = "";
		for ($i = 0; $i < $this->ColCount; $i++) {
			if ($this->Col[$i+1]->Visible) {
				$sChtFld = ewrpt_CrossTabField("SUM", $allmemberbystatus->SummaryField(), $allmemberbystatus->ColumnField(), $allmemberbystatus->ColumnDateType(), $this->Col[$i+1]->Value, "'");
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
		global $allmemberbystatus;
		if (!$rsgrp)
			return;
		if ($opt == 1) { // Get first group

	//		$rsgrp->MoveFirst(); // NOTE: no need to move position
			$allmemberbystatus->t_title->setDbValue(""); // Init first value
		} else { // Get next group
			$rsgrp->MoveNext();
		}
		if (!$rsgrp->EOF) {
			$allmemberbystatus->t_title->setDbValue($rsgrp->fields('t_title'));
		} else {
			$allmemberbystatus->t_title->setDbValue("");
		}
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $allmemberbystatus;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			if ($opt <> 1)
				$allmemberbystatus->t_title->setDbValue($rs->fields('t_title'));
			$allmemberbystatus->v_code->setDbValue($rs->fields('v_code'));
			$allmemberbystatus->v_title->setDbValue($rs->fields('v_title'));
			$cntval = count($this->Val);
			for ($ix = 1; $ix < $cntval; $ix++)
				$this->Val[$ix] = $rs->fields[$ix+3-1];
		} else {
			$allmemberbystatus->t_title->setDbValue("");
			$allmemberbystatus->v_code->setDbValue("");
			$allmemberbystatus->v_title->setDbValue("");
		}
	}

	// Check level break
	function ChkLvlBreak($lvl) {
		global $allmemberbystatus;
		switch ($lvl) {
			case 1:
				return (is_null($allmemberbystatus->t_title->CurrentValue) && !is_null($allmemberbystatus->t_title->OldValue)) ||
					(!is_null($allmemberbystatus->t_title->CurrentValue) && is_null($allmemberbystatus->t_title->OldValue)) ||
					($allmemberbystatus->t_title->GroupValue() <> $allmemberbystatus->t_title->GroupOldValue());
			case 2:
				return (is_null($allmemberbystatus->v_code->CurrentValue) && !is_null($allmemberbystatus->v_code->OldValue)) ||
					(!is_null($allmemberbystatus->v_code->CurrentValue) && is_null($allmemberbystatus->v_code->OldValue)) ||
					($allmemberbystatus->v_code->GroupValue() <> $allmemberbystatus->v_code->GroupOldValue()) || $this->ChkLvlBreak(1); // Recurse upper level
			case 3:
				return (is_null($allmemberbystatus->v_title->CurrentValue) && !is_null($allmemberbystatus->v_title->OldValue)) ||
					(!is_null($allmemberbystatus->v_title->CurrentValue) && is_null($allmemberbystatus->v_title->OldValue)) ||
					($allmemberbystatus->v_title->GroupValue() <> $allmemberbystatus->v_title->GroupOldValue()) || $this->ChkLvlBreak(2); // Recurse upper level
		}
	}

	// Accummulate summary
	function AccumulateSummary() {
		global $allmemberbystatus;
		$cntx = count($this->Smry);
		for ($ix = 1; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 0; $iy < $cnty; $iy++) {
				$valwrk = $this->Val[$ix];
				$this->Cnt[$ix][$iy]++;
				$this->Smry[$ix][$iy] = ewrpt_SummaryValue($this->Smry[$ix][$iy], $valwrk, $allmemberbystatus->SummaryType());
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
		global $allmemberbystatus;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$allmemberbystatus->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$allmemberbystatus->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $allmemberbystatus->getStartGroup();
			}
		} else {
			$this->StartGrp = $allmemberbystatus->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$allmemberbystatus->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$allmemberbystatus->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$allmemberbystatus->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $allmemberbystatus;

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
		global $allmemberbystatus;

		// Reset start position (reset command)
		$this->StartGrp = 1;
		$allmemberbystatus->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $allmemberbystatus;
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
			$allmemberbystatus->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$allmemberbystatus->setStartGroup($this->StartGrp);
		} else {
			if ($allmemberbystatus->getGroupPerPage() <> "") {
				$this->DisplayGrps = $allmemberbystatus->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $Security;
		global $allmemberbystatus;

		// Set up summary values
		$colcnt = $this->ColCount+1;
		$allmemberbystatus->SummaryCellAttrs = ewrpt_InitArray($colcnt, NULL);
		$allmemberbystatus->SummaryViewAttrs = ewrpt_InitArray($colcnt, NULL);
		$allmemberbystatus->SummaryCurrentValue = ewrpt_InitArray($colcnt, NULL);
		$allmemberbystatus->SummaryViewValue = ewrpt_InitArray($colcnt, NULL);
		$rowsmry = 0;
		$rowcnt = 0;
		if ($allmemberbystatus->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// aggregate sql
			$sSql = ewrpt_BuildReportSql($this->SqlSelectAggWork, $allmemberbystatus->SqlWhere(), $allmemberbystatus->SqlGroupByAgg(), "", "", $this->Filter, "");
			$rsagg = $conn->Execute($sSql);
			if ($rsagg && !$rsagg->EOF) $rsagg->MoveFirst();
		}
		for ($i = 1; $i <= $this->ColCount; $i++) {
			if ($this->Col[$i]->Visible) {
				if ($allmemberbystatus->RowType == EWRPT_ROWTYPE_DETAIL) { // Detail row
					$thisval = $this->Val[$i];
				} elseif ($allmemberbystatus->RowTotalType == EWRPT_ROWTOTAL_GROUP) { // Group total
					$thisval = $this->Smry[$i][$allmemberbystatus->RowGroupLevel];
				} elseif ($allmemberbystatus->RowTotalType == EWRPT_ROWTOTAL_PAGE) { // Page total
					$thisval = $this->Smry[$i][0];
				} elseif ($allmemberbystatus->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total
					$thisval = ($rsagg && !$rsagg->EOF) ? $rsagg->fields[$i+0-1] : 0;
				}
				$allmemberbystatus->SummaryCurrentValue[$i-1] = $thisval;
				$rowsmry = ewrpt_SummaryValue($rowsmry, $thisval, $allmemberbystatus->SummaryType());
			}
		}
		if ($allmemberbystatus->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total
			if ($rsagg) $rsagg->Close();
		}
		$allmemberbystatus->SummaryCurrentValue[$this->ColCount] = $rowsmry;

		// Call Row_Rendering event
		$allmemberbystatus->Row_Rendering();

		/* --------------------
		'  Render view codes
		' --------------------- */
		if ($allmemberbystatus->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// t_title
			$allmemberbystatus->t_title->GroupViewValue = $allmemberbystatus->t_title->GroupOldValue();
			$allmemberbystatus->t_title->CellAttrs["style"] = "white-space: nowrap;";
			$allmemberbystatus->t_title->CellAttrs["class"] = ($allmemberbystatus->RowGroupLevel == 1) ? "ewRptGrpSummary1" : "ewRptGrpField1";

			// v_code
			$allmemberbystatus->v_code->GroupViewValue = $allmemberbystatus->v_code->GroupOldValue();
			$allmemberbystatus->v_code->CellAttrs["style"] = "white-space: nowrap;";
			$allmemberbystatus->v_code->CellAttrs["class"] = ($allmemberbystatus->RowGroupLevel == 2) ? "ewRptGrpSummary2" : "ewRptGrpField2";

			// v_title
			$allmemberbystatus->v_title->GroupViewValue = $allmemberbystatus->v_title->GroupOldValue();
			$allmemberbystatus->v_title->CellAttrs["style"] = "white-space: nowrap;";
			$allmemberbystatus->v_title->CellAttrs["class"] = ($allmemberbystatus->RowGroupLevel == 3) ? "ewRptGrpSummary3" : "ewRptGrpField3";

			// Set up summary values
			$scvcnt = count($allmemberbystatus->SummaryCurrentValue);
			for ($i = 0; $i < $scvcnt; $i++) {
				$allmemberbystatus->SummaryViewValue[$i] = $allmemberbystatus->SummaryCurrentValue[$i];
				$allmemberbystatus->SummaryCellAttrs[$i]["style"] = "";
				$allmemberbystatus->SummaryCellAttrs[$i]["class"] = ($allmemberbystatus->RowTotalType == EWRPT_ROWTOTAL_GROUP) ? "ewRptGrpSummary" . $allmemberbystatus->RowGroupLevel : "";
			}
		} else {

			// t_title
			$allmemberbystatus->t_title->GroupViewValue = $allmemberbystatus->t_title->GroupValue();
			$allmemberbystatus->t_title->CellAttrs["style"] = "white-space: nowrap;";
			$allmemberbystatus->t_title->CellAttrs["class"] = "ewRptGrpField1";
			if ($allmemberbystatus->t_title->GroupValue() == $allmemberbystatus->t_title->GroupOldValue() && !$this->ChkLvlBreak(1))
				$allmemberbystatus->t_title->GroupViewValue = "&nbsp;";

			// v_code
			$allmemberbystatus->v_code->GroupViewValue = $allmemberbystatus->v_code->GroupValue();
			$allmemberbystatus->v_code->CellAttrs["style"] = "white-space: nowrap;";
			$allmemberbystatus->v_code->CellAttrs["class"] = "ewRptGrpField2";
			if ($allmemberbystatus->v_code->GroupValue() == $allmemberbystatus->v_code->GroupOldValue() && !$this->ChkLvlBreak(2))
				$allmemberbystatus->v_code->GroupViewValue = "&nbsp;";

			// v_title
			$allmemberbystatus->v_title->GroupViewValue = $allmemberbystatus->v_title->GroupValue();
			$allmemberbystatus->v_title->CellAttrs["style"] = "white-space: nowrap;";
			$allmemberbystatus->v_title->CellAttrs["class"] = "ewRptGrpField3";
			if ($allmemberbystatus->v_title->GroupValue() == $allmemberbystatus->v_title->GroupOldValue() && !$this->ChkLvlBreak(3))
				$allmemberbystatus->v_title->GroupViewValue = "&nbsp;";

			// Set up summary values
			$scvcnt = count($allmemberbystatus->SummaryCurrentValue);
			for ($i = 0; $i < $scvcnt; $i++) {
				$allmemberbystatus->SummaryViewValue[$i] = $allmemberbystatus->SummaryCurrentValue[$i];
				$allmemberbystatus->SummaryCellAttrs[$i]["style"] = "";
				$allmemberbystatus->SummaryCellAttrs[$i]["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
			}
		}

		// t_title
		$allmemberbystatus->t_title->HrefValue = "";

		// v_code
		$allmemberbystatus->v_code->HrefValue = "";

		// v_title
		$allmemberbystatus->v_title->HrefValue = "";

		// Call Row_Rendered event
		$allmemberbystatus->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $allmemberbystatus;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $allmemberbystatus;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$allmemberbystatus->setOrderBy("");
				$allmemberbystatus->setStartGroup(1);
				$allmemberbystatus->t_title->setSort("");
				$allmemberbystatus->v_code->setSort("");
				$allmemberbystatus->v_title->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$allmemberbystatus->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$allmemberbystatus->CurrentOrderType = @$_GET["ordertype"];
			$allmemberbystatus->UpdateSort($allmemberbystatus->t_title); // t_title
			$allmemberbystatus->UpdateSort($allmemberbystatus->v_code); // v_code
			$allmemberbystatus->UpdateSort($allmemberbystatus->v_title); // v_title
			$sSortSql = $allmemberbystatus->SortSql();
			$allmemberbystatus->setOrderBy($sSortSql);
			$allmemberbystatus->setStartGroup(1);
		}
		return $allmemberbystatus->getOrderBy();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
		global $conn;
		$ar = $conn->Execute("SELECT member_id FROM members WHERE 1");
		$arr = $ar->getArray();
		if (count($arr) == 0) header("location:memberslist.php?cmd=resetall");
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
