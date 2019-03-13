<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "settinginfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$setting_edit = new csetting_edit();
$Page =& $setting_edit;

// Page init
$setting_edit->Page_Init();

// Page main
$setting_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var setting_edit = new ew_Page("setting_edit");

// page properties
setting_edit.PageID = "edit"; // page ID
setting_edit.FormID = "fsettingedit"; // form ID
var EW_PAGE_ID = setting_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
setting_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_start_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->start_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_start_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->start_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_old_member"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->old_member->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_old_member"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->old_member->FldErrMsg()) ?>");
	elm = fobj.elements["x" + infix + "_dead_member"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->dead_member->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_dead_member"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->dead_member->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_new_member"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->new_member->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_new_member"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->new_member->FldErrMsg()) ?>");
		
		elm = fobj.elements["x" + infix + "_regis_rate"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->regis_rate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_annual_rate"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->annual_rate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_subvention_rate"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->subvention_rate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_assc_percent"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->assc_percent->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_max_subvention"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->max_subvention->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_max_subvention"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->max_subvention->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_rc_rate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->rc_rate->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_rc_rate"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->rc_rate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_min_advance_subv"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->min_advance_subv->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_min_advance_subv"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->min_advance_subv->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_max_advance_subv"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->max_advance_subv->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_max_advance_subv"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->max_advance_subv->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_max_age"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->max_age->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_chairman_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->chairman_name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_chairman_signature"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_receiver_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->receiver_name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_receiver_signature"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_logo"];
		aelm = fobj.elements["a" + infix + "_logo"];
		var chk_logo = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_logo && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->logo->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_logo"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_notice_duedate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->notice_duedate->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_notice_duedate"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->notice_duedate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_invoice_duedate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->invoice_duedate->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_invoice_duedate"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->invoice_duedate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_contact_info"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->contact_info->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_annual_fee_duedate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($setting->annual_fee_duedate->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_annual_fee_duedate"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($setting->annual_fee_duedate->FldErrMsg()) ?>");


		// Set up row object
		var row = {};
		row["index"] = infix;
		for (var j = 0; j < fobj.elements.length; j++) {
			var el = fobj.elements[j];
			var len = infix.length + 2;
			if (el.name.substr(0, len) == "x" + infix + "_") {
				var elname = "x_" + el.name.substr(len);
				if (ewLang.isObject(row[elname])) { // already exists
					if (ewLang.isArray(row[elname])) {
						row[elname][row[elname].length] = el; // add to array
					} else {
						row[elname] = [row[elname], el]; // convert to array
					}
				} else {
					row[elname] = el;
				}
			}
		}
		fobj.row = row;

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}

	// Process detail page
	var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
	if (detailpage != "") {
		return eval(detailpage+".ValidateForm(fobj)");
	}
	return true;
}

// extend page with Form_CustomValidate function
setting_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
setting_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
setting_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
setting_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="javascript" src="js/myAjaxFramework.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->
function calnew(date){
	
	getDataReturnText('gettotal.php?startdate='+date+'&type=6',displayOldMember);
	getDataReturnText('gettotal.php?startdate='+date+'&type=7',displayNewMember);
	getDataReturnText('gettotal.php?startdate='+date+'&type=8',displayDeadMember);
	//getDataReturnText('gettotal.php?type=9',displaySubvTotal);
	//getDataReturnText('gettotal.php?type=10',displayRcTotal);
	
	
}
function displayOldMember(text){
     
	document.getElementById("x_old_member").value = text;
}
function displayNewMember(text){
     
	document.getElementById("x_new_member").value = text;
}
function displayDeadMember(text){
     
	document.getElementById("x_dead_member").value = text;
}
function displaySubvTotal(text){
     
	document.getElementById("x_max_subvention").value = text;
}
function displayRcTotal(text){
     
	document.getElementById("x_rc_rate").value = text;
}


</script>
<div class="phpmaker ewTitle"><img src="images/variable55x55.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $setting->TableCaption() ?></div>
<div class="clear"></div>
<?php $setting_edit->ShowPageHeader(); ?>
<?php
$setting_edit->ShowMessage();
?>
<form name="fsettingedit" id="fsettingedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return setting_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="setting">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $setting->RowAttributes() ?>>
	  <td colspan="2" align="center" bgcolor="#333333"><strong class="white">ค่าสำหรับการคำนวณ</strong></td>
	  </tr>
	  <?php if ($setting->start_date->Visible) { // start_date ?>
	<tr id="r_start_date"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->start_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $setting->start_date->CellAttributes() ?>><span id="el_start_date">
<input type="text" name="x_start_date" id="x_start_date" value="<?php echo $setting->start_date->EditValue ?>" onchange="calnew(this.value);">
&nbsp;<img src="phpimages/calendar.png" id="cal_x_start_date" name="cal_x_start_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_start_date", // input field id
	ifFormat: "%Y-%m-%d", // date format
	button: "cal_x_start_date" // button id
});
</script>
</span><?php echo $setting->start_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($setting->old_member->Visible) { // old_member ?>
	<tr id="r_old_member"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->old_member->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $setting->old_member->CellAttributes() ?>><span id="el_old_member">
<input type="text" name="x_old_member" id="x_old_member" size="20" value="<?php echo $setting->old_member->EditValue ?>"<?php echo $setting->old_member->EditAttributes() ?>>
</span><?php echo $setting->old_member->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($setting->new_member->Visible) { // new_member ?>
	<tr id="r_new_member"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->new_member->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $setting->new_member->CellAttributes() ?>><span id="el_new_member">
<input type="text" name="x_new_member" id="x_new_member" size="20" value="<?php echo $setting->new_member->EditValue ?>"<?php echo $setting->new_member->EditAttributes() ?>>
</span><?php echo $setting->new_member->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($setting->dead_member->Visible) { // dead_member ?>
	<tr id="r_dead_member"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->dead_member->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $setting->dead_member->CellAttributes() ?>><span id="el_dead_member">
<input type="text" name="x_dead_member" id="x_dead_member" size="20" value="<?php echo $setting->dead_member->EditValue ?>"<?php echo $setting->dead_member->EditAttributes() ?>>
</span><?php echo $setting->dead_member->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($setting->subvention_rate->Visible) { // subvention_rate ?>
	<tr id="r_subvention_rate"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->subvention_rate->FldCaption() ?></td>
		<td<?php echo $setting->subvention_rate->CellAttributes() ?>><span id="el_subvention_rate">
<input type="text" name="x_subvention_rate" id="x_subvention_rate" size="20" value="<?php echo $setting->subvention_rate->EditValue ?>"<?php echo $setting->subvention_rate->EditAttributes() ?>>
</span><?php echo $setting->subvention_rate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($setting->assc_percent->Visible) { // assc_percent ?>
	<tr id="r_assc_percent"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->assc_percent->FldCaption() ?></td>
		<td<?php echo $setting->assc_percent->CellAttributes() ?>><span id="el_assc_percent">
<input type="text" name="x_assc_percent" id="x_assc_percent" size="5" value="<?php echo $setting->assc_percent->EditValue ?>"<?php echo $setting->assc_percent->EditAttributes() ?>>
</span><?php echo $setting->assc_percent->CustomMsg ?></td>
	</tr>
<?php } ?>

<?php if ($setting->max_subvention->Visible) { // max_subvention ?>
	<tr id="r_max_subvention"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->max_subvention->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $setting->max_subvention->CellAttributes() ?>><span id="el_max_subvention">
<input type="text" name="x_max_subvention" id="x_max_subvention" size="20" value="<?php echo $setting->max_subvention->EditValue ?>"<?php echo $setting->max_subvention->EditAttributes() ?>>
</span><?php echo $setting->max_subvention->CustomMsg ?> คิดจาก (จำนวนสมาชิกใหม่ + สมาชิกคงเหลือยกมา * เงินสงเคราะห์ต่อราย )</td>
	</tr>
<?php } ?>

<?php if ($setting->rc_rate->Visible) { // rc_rate ?>
	<tr id="r_rc_rate"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->rc_rate->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $setting->rc_rate->CellAttributes() ?>><span id="el_rc_rate">
<input type="text" name="x_rc_rate" id="x_rc_rate" size="20" value="<?php echo $setting->rc_rate->EditValue ?>"<?php echo $setting->rc_rate->EditAttributes() ?>>
</span><?php echo $setting->rc_rate->CustomMsg ?> คิดจาก (จำนวนสมาชิกที่เสียชีวิตในปีที่แล้ว * เงินสงเคราะห์ต่อราย )</td>
	</tr>
<?php } ?>
	  <?php if ($setting->regis_rate->Visible) { // regis_rate ?>

	<tr id="r_regis_rate"<?php echo $setting->RowAttributes() ?>>
		<td width="300" class="ewTableHeader"><?php echo $setting->regis_rate->FldCaption() ?></td>
		<td<?php echo $setting->regis_rate->CellAttributes() ?>><span id="el_regis_rate">
<input type="text" name="x_regis_rate" id="x_regis_rate" size="20" value="<?php echo $setting->regis_rate->EditValue ?>"<?php echo $setting->regis_rate->EditAttributes() ?>>
</span><?php echo $setting->regis_rate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($setting->annual_rate->Visible) { // annual_rate ?>
	<tr id="r_annual_rate"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->annual_rate->FldCaption() ?></td>
		<td<?php echo $setting->annual_rate->CellAttributes() ?>><span id="el_annual_rate">
<input type="text" name="x_annual_rate" id="x_annual_rate" size="20" value="<?php echo $setting->annual_rate->EditValue ?>"<?php echo $setting->annual_rate->EditAttributes() ?>>
</span><?php echo $setting->annual_rate->CustomMsg ?></td>
	</tr>
<?php } ?>


<?php if ($setting->min_advance_subv->Visible) { // min_advance_subv ?>
	<tr id="r_min_advance_subv"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->min_advance_subv->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $setting->min_advance_subv->CellAttributes() ?>><span id="el_min_advance_subv">
<input type="text" name="x_min_advance_subv" id="x_min_advance_subv" size="20" value="<?php echo $setting->min_advance_subv->EditValue ?>"<?php echo $setting->min_advance_subv->EditAttributes() ?>>
</span><?php echo $setting->min_advance_subv->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($setting->max_advance_subv->Visible) { // max_advance_subv ?>
	<tr id="r_max_advance_subv"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->max_advance_subv->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $setting->max_advance_subv->CellAttributes() ?>><span id="el_max_advance_subv">
<input type="text" name="x_max_advance_subv" id="x_max_advance_subv" size="20" value="<?php echo $setting->max_advance_subv->EditValue ?>"<?php echo $setting->max_advance_subv->EditAttributes() ?>>
</span><?php echo $setting->max_advance_subv->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($setting->max_age->Visible) { // max_age ?>
	<tr id="r_max_age"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->max_age->FldCaption() ?></td>
		<td<?php echo $setting->max_age->CellAttributes() ?>><span id="el_max_age">
<input type="text" name="x_max_age" id="x_max_age" size="20" value="<?php echo $setting->max_age->EditValue ?>"<?php echo $setting->max_age->EditAttributes() ?>>
</span><?php echo $setting->max_age->CustomMsg ?></td>
	</tr>
<?php } ?>

	<tr id="r_invoice_duedate"<?php echo $setting->RowAttributes() ?>>
	  <td class="ewTableHeader"><?php echo $setting->invoice_duedate->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
	  <td<?php echo $setting->invoice_duedate->CellAttributes() ?>><span id="el_invoice_duedate">
	    <input type="text" name="x_invoice_duedate" id="x_invoice_duedate" size="5" value="<?php echo $setting->invoice_duedate->EditValue ?>"<?php echo $setting->invoice_duedate->EditAttributes() ?> />
	    </span><?php echo $setting->invoice_duedate->CustomMsg ?></td>
	  </tr>
	<tr id="r_notice_duedate"<?php echo $setting->RowAttributes() ?>>
	  <td class="ewTableHeader"><?php echo $setting->notice_duedate->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $setting->notice_duedate->CellAttributes() ?>><span id="el_notice_duedate">
<input type="text" name="x_notice_duedate" id="x_notice_duedate" size="5" value="<?php echo $setting->notice_duedate->EditValue ?>"<?php echo $setting->notice_duedate->EditAttributes() ?>>
</span><?php echo $setting->notice_duedate->CustomMsg ?></td>
	  </tr>
<?php if ($setting->annual_fee_duedate->Visible) { // annual_fee_duedate ?>
	<tr id="r_annual_fee_duedate"<?php echo $setting->RowAttributes() ?>>
	  <td class="ewTableHeader"><?php echo $setting->annual_fee_duedate->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
	  <td<?php echo $setting->annual_fee_duedate->CellAttributes() ?>><span id="el_annual_fee_duedate">
  <input type="text" name="x_annual_fee_duedate" id="x_annual_fee_duedate" value="<?php echo $setting->annual_fee_duedate->EditValue ?>"<?php echo $setting->annual_fee_duedate->EditAttributes() ?>>
  &nbsp;<img src="phpimages/calendar.png" id="cal_x_annual_fee_duedate" name="cal_x_annual_fee_duedate" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
  <script type="text/javascript">
Calendar.setup({
	inputField: "x_annual_fee_duedate", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_annual_fee_duedate" // button id
});
</script>
  </span><?php echo $setting->annual_fee_duedate->CustomMsg ?></td>
	  </tr><?php } ?>
<?php if ($setting->chairman_signature->Visible) { // chairman_signature ?>
	<tr<?php echo $setting->RowAttributes() ?>>
	  <td colspan="2" align="center" bgcolor="#333333" ><strong class="white">ข้อมูลเกี่ยวกับชมรม</strong></td>
	  </tr>
      <?php if ($setting->chairman_name->Visible) { // chairman_name ?>
	<tr id="r_chairman_name"<?php echo $setting->RowAttributes() ?>>
	  <td class="ewTableHeader"><?php echo $setting->chairman_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
	  <td<?php echo $setting->chairman_name->CellAttributes() ?>><span id="el_chairman_name">
  <input type="text" name="x_chairman_name" id="x_chairman_name" size="20" maxlength="100" value="<?php echo $setting->chairman_name->EditValue ?>"<?php echo $setting->chairman_name->EditAttributes() ?>>
  </span><?php echo $setting->chairman_name->CustomMsg ?></td>
	  </tr>
      <?php } ?>
	<tr id="r_chairman_signature"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->chairman_signature->FldCaption() ?></td>
		<td<?php echo $setting->chairman_signature->CellAttributes() ?>><span id="el_chairman_signature">
<div id="old_x_chairman_signature">
<?php if ($setting->chairman_signature->LinkAttributes() <> "") { ?>
<?php if (!empty($setting->chairman_signature->Upload->DbValue)) { ?>
<img src="ewbv8.php?fn=<?php echo urlencode(ew_IncludeTrailingDelimiter($setting->chairman_signature->UploadPath, FALSE) . $setting->chairman_signature->Upload->DbValue) ?>&width=<?php echo $setting->chairman_signature->ImageWidth ?>&height=<?php echo $setting->chairman_signature->ImageHeight ?>" border=0<?php echo $setting->chairman_signature->ViewAttributes() ?>>
<?php } elseif (!in_array($setting->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($setting->chairman_signature->Upload->DbValue)) { ?>
<img src="ewbv8.php?fn=<?php echo urlencode(ew_IncludeTrailingDelimiter($setting->chairman_signature->UploadPath, FALSE) . $setting->chairman_signature->Upload->DbValue) ?>&width=<?php echo $setting->chairman_signature->ImageWidth ?>&height=<?php echo $setting->chairman_signature->ImageHeight ?>" border=0<?php echo $setting->chairman_signature->ViewAttributes() ?>>
<?php } elseif (!in_array($setting->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>

<div id="new_x_chairman_signature">
<?php if (!empty($setting->chairman_signature->Upload->DbValue)) { ?>
<label><input type="radio" name="a_chairman_signature" id="a_chairman_signature" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_chairman_signature" id="a_chairman_signature" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_chairman_signature" id="a_chairman_signature" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $setting->chairman_signature->EditAttrs["onchange"] = "this.form.a_chairman_signature[2].checked=true;" . @$setting->chairman_signature->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_chairman_signature" id="a_chairman_signature" value="3">
<?php } ?>
<input type="file" name="x_chairman_signature" id="x_chairman_signature" size="30"<?php echo $setting->chairman_signature->EditAttributes() ?>>
</div>
</span><?php echo $setting->chairman_signature->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($setting->receiver_name->Visible) { // receiver_name ?>
	<tr id="r_receiver_name"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->receiver_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $setting->receiver_name->CellAttributes() ?>><span id="el_receiver_name">
<input type="text" name="x_receiver_name" id="x_receiver_name" size="20" maxlength="100" value="<?php echo $setting->receiver_name->EditValue ?>"<?php echo $setting->receiver_name->EditAttributes() ?>>
</span><?php echo $setting->receiver_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($setting->receiver_signature->Visible) { // receiver_signature ?>
	<tr id="r_receiver_signature"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->receiver_signature->FldCaption() ?></td>
		<td<?php echo $setting->receiver_signature->CellAttributes() ?>><span id="el_receiver_signature">
<div id="old_x_receiver_signature">
<?php if ($setting->receiver_signature->LinkAttributes() <> "") { ?>
<?php if (!empty($setting->receiver_signature->Upload->DbValue)) { ?>
<img src="ewbv8.php?fn=<?php echo urlencode(ew_IncludeTrailingDelimiter($setting->receiver_signature->UploadPath, FALSE) . $setting->receiver_signature->Upload->DbValue) ?>&width=<?php echo $setting->receiver_signature->ImageWidth ?>&height=<?php echo $setting->receiver_signature->ImageHeight ?>" border=0<?php echo $setting->receiver_signature->ViewAttributes() ?>>
<?php } elseif (!in_array($setting->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($setting->receiver_signature->Upload->DbValue)) { ?>
<img src="ewbv8.php?fn=<?php echo urlencode(ew_IncludeTrailingDelimiter($setting->receiver_signature->UploadPath, FALSE) . $setting->receiver_signature->Upload->DbValue) ?>&width=<?php echo $setting->receiver_signature->ImageWidth ?>&height=<?php echo $setting->receiver_signature->ImageHeight ?>" border=0<?php echo $setting->receiver_signature->ViewAttributes() ?>>
<?php } elseif (!in_array($setting->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_receiver_signature">
<?php if (!empty($setting->receiver_signature->Upload->DbValue)) { ?>
<label><input type="radio" name="a_receiver_signature" id="a_receiver_signature" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_receiver_signature" id="a_receiver_signature" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_receiver_signature" id="a_receiver_signature" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $setting->receiver_signature->EditAttrs["onchange"] = "this.form.a_receiver_signature[2].checked=true;" . @$setting->receiver_signature->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_receiver_signature" id="a_receiver_signature" value="3">
<?php } ?>
<input type="file" name="x_receiver_signature" id="x_receiver_signature" size="30"<?php echo $setting->receiver_signature->EditAttributes() ?>>
</div>
</span><?php echo $setting->receiver_signature->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($setting->logo->Visible) { // logo ?>
	<tr id="r_logo"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->logo->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $setting->logo->CellAttributes() ?>><span id="el_logo">
<div id="old_x_logo">
<?php if ($setting->logo->LinkAttributes() <> "") { ?>
<?php if (!empty($setting->logo->Upload->DbValue)) { ?>
<img src="ewbv8.php?fn=<?php echo urlencode(ew_IncludeTrailingDelimiter($setting->logo->UploadPath, FALSE) . $setting->logo->Upload->DbValue) ?>&width=<?php echo $setting->logo->ImageWidth ?>&height=<?php echo $setting->logo->ImageHeight ?>" border=0<?php echo $setting->logo->ViewAttributes() ?>>
<?php } elseif (!in_array($setting->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($setting->logo->Upload->DbValue)) { ?>
<img src="ewbv8.php?fn=<?php echo urlencode(ew_IncludeTrailingDelimiter($setting->logo->UploadPath, FALSE) . $setting->logo->Upload->DbValue) ?>&width=<?php echo $setting->logo->ImageWidth ?>&height=<?php echo $setting->logo->ImageHeight ?>" border=0<?php echo $setting->logo->ViewAttributes() ?>>
<?php } elseif (!in_array($setting->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_logo">
<?php if (!empty($setting->logo->Upload->DbValue)) { ?>
<label><input type="radio" name="a_logo" id="a_logo" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_logo" id="a_logo" value="2" disabled="disabled"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_logo" id="a_logo" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $setting->logo->EditAttrs["onchange"] = "this.form.a_logo[2].checked=true;" . @$setting->logo->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_logo" id="a_logo" value="3">
<?php } ?>
<input type="file" name="x_logo" id="x_logo"<?php echo $setting->logo->EditAttributes() ?>>
</div>
</span><?php echo $setting->logo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($setting->contact_info->Visible) { // contact_info ?>
	<tr id="r_contact_info"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->contact_info->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $setting->contact_info->CellAttributes() ?>><span id="el_contact_info">
<textarea name="x_contact_info" id="x_contact_info" cols="35" rows="4"<?php echo $setting->contact_info->EditAttributes() ?>><?php echo $setting->contact_info->EditValue ?></textarea>
</span><?php echo $setting->contact_info->CustomMsg ?></td>
	</tr>
<?php } ?>

	<tr<?php echo $setting->RowAttributes() ?>>
	  <td colspan="2" align="center" bgcolor="#333333"><strong class="white"><a name="path" id="path"></a>ค่าสำหรับการปรับแต่งระบบ</strong></td>
<?php if ($setting->export_path->Visible) { // export_path ?>
	<tr id="r_export_path"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->export_path->FldCaption() ?></td>
		<td<?php echo $setting->export_path->CellAttributes() ?>><span id="el_export_path">
<input type="text" name="x_export_path" id="x_export_path" size="20" maxlength="100" value="<?php echo $setting->export_path->EditValue ?>"<?php echo $setting->export_path->EditAttributes() ?>>
</span><?php echo $setting->export_path->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($setting->export_date->Visible) { // export_date ?>
	<tr id="r_export_date"<?php echo $setting->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $setting->export_date->FldCaption() ?></td>
		<td<?php echo $setting->export_date->CellAttributes() ?>><span id="el_export_date">
<select id="x_export_date" name="x_export_date"<?php echo $setting->export_date->EditAttributes() ?>>
<?php
if (is_array($setting->export_date->EditValue)) {
	$arwrk = $setting->export_date->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($setting->export_date->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $setting->export_date->CustomMsg ?></td>
	</tr>
<?php } ?>

</table>
</div>
</td></tr></table>
<input type="hidden" name="x_setting_id" id="x_setting_id" value="<?php echo ew_HtmlEncode($setting->setting_id->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$setting_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$setting_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class csetting_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'setting';

	// Page object name
	var $PageObjName = 'setting_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $setting;
		if ($setting->UseTokenInUrl) $PageUrl .= "t=" . $setting->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $setting;
		if ($setting->UseTokenInUrl) {
			if ($objForm)
				return ($setting->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($setting->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csetting_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (setting)
		if (!isset($GLOBALS["setting"])) {
			$GLOBALS["setting"] = new csetting();
			$GLOBALS["Table"] =& $GLOBALS["setting"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'setting', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $setting;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->UserID_Loading();
		if ($Security->IsLoggedIn()) $Security->LoadUserID();
		$Security->UserID_Loaded();

		// Create form object
		$objForm = new cFormObj();

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

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $setting;

		// Load key from QueryString
		if (@$_GET["setting_id"] <> "")
			$setting->setting_id->setQueryStringValue($_GET["setting_id"]);
		if (@$_POST["a_edit"] <> "") {
			$setting->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$setting->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$setting->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$setting->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($setting->setting_id->CurrentValue == "")
			$this->Page_Terminate("settinglist.php"); // Invalid key, return to list
		switch ($setting->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("settinglist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$setting->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $setting->EditUrl();
					if (ew_GetPageName($sReturnUrl) == "settingview.php")
						$sReturnUrl = $setting->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$setting->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$setting->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$setting->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $setting;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
		$setting->chairman_signature->Upload->Index = $objForm->Index;
		$setting->chairman_signature->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$setting->chairman_signature->Upload->RestoreFromSession();
		} else {
			if ($setting->chairman_signature->Upload->UploadFile()) {

				// No action required
			} else {
				echo $setting->chairman_signature->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$setting->chairman_signature->Upload->SaveToSession();
			$setting->chairman_signature->CurrentValue = $setting->chairman_signature->Upload->FileName;
		}
		$setting->receiver_signature->Upload->Index = $objForm->Index;
		$setting->receiver_signature->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$setting->receiver_signature->Upload->RestoreFromSession();
		} else {
			if ($setting->receiver_signature->Upload->UploadFile()) {

				// No action required
			} else {
				echo $setting->receiver_signature->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$setting->receiver_signature->Upload->SaveToSession();
			$setting->receiver_signature->CurrentValue = $setting->receiver_signature->Upload->FileName;
		}
		$setting->logo->Upload->Index = $objForm->Index;
		$setting->logo->Upload->RestoreDbFromSession();
		if ($confirmPage) { // Post from confirm page
			$setting->logo->Upload->RestoreFromSession();
		} else {
			if ($setting->logo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $setting->logo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$setting->logo->Upload->SaveToSession();
			$setting->logo->CurrentValue = $setting->logo->Upload->FileName;
		}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $setting;
		$this->GetUploadFiles(); // Get upload files
		if (!$setting->start_date->FldIsDetailKey) {
			$setting->start_date->setFormValue($objForm->GetValue("x_start_date"));
			$setting->start_date->CurrentValue = ew_UnFormatDateTime($setting->start_date->CurrentValue, 7);
		}
		if (!$setting->old_member->FldIsDetailKey) {
			$setting->old_member->setFormValue($objForm->GetValue("x_old_member"));
		}
		if (!$setting->dead_member->FldIsDetailKey) {
			$setting->dead_member->setFormValue($objForm->GetValue("x_dead_member"));
		}
		if (!$setting->new_member->FldIsDetailKey) {
			$setting->new_member->setFormValue($objForm->GetValue("x_new_member"));
		}
		if (!$setting->regis_rate->FldIsDetailKey) {
			$setting->regis_rate->setFormValue($objForm->GetValue("x_regis_rate"));
		}
		if (!$setting->annual_rate->FldIsDetailKey) {
			$setting->annual_rate->setFormValue($objForm->GetValue("x_annual_rate"));
		}
		if (!$setting->subvention_rate->FldIsDetailKey) {
			$setting->subvention_rate->setFormValue($objForm->GetValue("x_subvention_rate"));
		}
		if (!$setting->assc_percent->FldIsDetailKey) {
			$setting->assc_percent->setFormValue($objForm->GetValue("x_assc_percent"));
		}
		if (!$setting->max_subvention->FldIsDetailKey) {
			$setting->max_subvention->setFormValue($objForm->GetValue("x_max_subvention"));
		}
		if (!$setting->rc_rate->FldIsDetailKey) {
			$setting->rc_rate->setFormValue($objForm->GetValue("x_rc_rate"));
		}
		if (!$setting->min_advance_subv->FldIsDetailKey) {
			$setting->min_advance_subv->setFormValue($objForm->GetValue("x_min_advance_subv"));
		}
		if (!$setting->max_advance_subv->FldIsDetailKey) {
			$setting->max_advance_subv->setFormValue($objForm->GetValue("x_max_advance_subv"));
		}
		if (!$setting->max_age->FldIsDetailKey) {
			$setting->max_age->setFormValue($objForm->GetValue("x_max_age"));
		}
		if (!$setting->chairman_name->FldIsDetailKey) {
			$setting->chairman_name->setFormValue($objForm->GetValue("x_chairman_name"));
		}
		if (!$setting->receiver_name->FldIsDetailKey) {
			$setting->receiver_name->setFormValue($objForm->GetValue("x_receiver_name"));
		}
		if (!$setting->notice_duedate->FldIsDetailKey) {
			$setting->notice_duedate->setFormValue($objForm->GetValue("x_notice_duedate"));
		}
		if (!$setting->invoice_duedate->FldIsDetailKey) {
			$setting->invoice_duedate->setFormValue($objForm->GetValue("x_invoice_duedate"));
		}
		if (!$setting->contact_info->FldIsDetailKey) {
			$setting->contact_info->setFormValue($objForm->GetValue("x_contact_info"));
		}
		if (!$setting->annual_fee_duedate->FldIsDetailKey) {
			$setting->annual_fee_duedate->setFormValue($objForm->GetValue("x_annual_fee_duedate"));
			$setting->annual_fee_duedate->CurrentValue = ew_UnFormatDateTime($setting->annual_fee_duedate->CurrentValue, 7);
		}
		if (!$setting->export_path->FldIsDetailKey) {
			$setting->export_path->setFormValue($objForm->GetValue("x_export_path"));
		}
		if (!$setting->export_date->FldIsDetailKey) {
			$setting->export_date->setFormValue($objForm->GetValue("x_export_date"));
		}
		if (!$setting->setting_id->FldIsDetailKey)
			$setting->setting_id->setFormValue($objForm->GetValue("x_setting_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $setting;
		$this->LoadRow();
		$setting->setting_id->CurrentValue = $setting->setting_id->FormValue;
		$setting->start_date->CurrentValue = $setting->start_date->FormValue;
		$setting->start_date->CurrentValue = ew_UnFormatDateTime($setting->start_date->CurrentValue, 7);
		$setting->old_member->CurrentValue = $setting->old_member->FormValue;
		$setting->dead_member->CurrentValue = $setting->dead_member->FormValue;
		$setting->new_member->CurrentValue = $setting->new_member->FormValue;
		
		$setting->regis_rate->CurrentValue = $setting->regis_rate->FormValue;
		$setting->annual_rate->CurrentValue = $setting->annual_rate->FormValue;
		$setting->subvention_rate->CurrentValue = $setting->subvention_rate->FormValue;
		$setting->assc_percent->CurrentValue = $setting->assc_percent->FormValue;
		$setting->max_subvention->CurrentValue = $setting->max_subvention->FormValue;
		$setting->rc_rate->CurrentValue = $setting->rc_rate->FormValue;
		$setting->min_advance_subv->CurrentValue = $setting->min_advance_subv->FormValue;
		$setting->max_advance_subv->CurrentValue = $setting->max_advance_subv->FormValue;
		$setting->max_age->CurrentValue = $setting->max_age->FormValue;
		$setting->chairman_name->CurrentValue = $setting->chairman_name->FormValue;
		$setting->receiver_name->CurrentValue = $setting->receiver_name->FormValue;
		$setting->notice_duedate->CurrentValue = $setting->notice_duedate->FormValue;
		$setting->invoice_duedate->CurrentValue = $setting->invoice_duedate->FormValue;
		$setting->contact_info->CurrentValue = $setting->contact_info->FormValue;
		$setting->annual_fee_duedate->CurrentValue = $setting->annual_fee_duedate->FormValue;
		$setting->annual_fee_duedate->CurrentValue = ew_UnFormatDateTime($setting->annual_fee_duedate->CurrentValue, 7);
		$setting->export_path->CurrentValue = $setting->export_path->FormValue;
		$setting->export_date->CurrentValue = $setting->export_date->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $setting;
		$sFilter = $setting->KeyFilter();

		// Call Row Selecting event
		$setting->Row_Selecting($sFilter);

		// Load SQL based on filter
		$setting->CurrentFilter = $sFilter;
		$sSql = $setting->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $setting;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$setting->Row_Selected($row);
		$setting->setting_id->setDbValue($rs->fields('setting_id'));
		$setting->start_date->setDbValue($rs->fields('start_date'));
		$setting->old_member->setDbValue($rs->fields('old_member'));
		$setting->dead_member->setDbValue($rs->fields('dead_member'));
		$setting->new_member->setDbValue($rs->fields('new_member'));
		
		$setting->regis_rate->setDbValue($rs->fields('regis_rate'));
		$setting->annual_rate->setDbValue($rs->fields('annual_rate'));
		$setting->subvention_rate->setDbValue($rs->fields('subvention_rate'));
		$setting->assc_percent->setDbValue($rs->fields('assc_percent'));
		$setting->max_subvention->setDbValue($rs->fields('max_subvention'));
		$setting->rc_rate->setDbValue($rs->fields('rc_rate'));
		$setting->min_advance_subv->setDbValue($rs->fields('min_advance_subv'));
		$setting->max_advance_subv->setDbValue($rs->fields('max_advance_subv'));
		$setting->quoted_advance_subv->setDbValue($rs->fields('quoted_advance_subv'));
		$setting->max_age->setDbValue($rs->fields('max_age'));
		$setting->chairman_name->setDbValue($rs->fields('chairman_name'));
		$setting->chairman_signature->Upload->DbValue = $rs->fields('chairman_signature');
		$setting->receiver_name->setDbValue($rs->fields('receiver_name'));
		$setting->receiver_signature->Upload->DbValue = $rs->fields('receiver_signature');
		$setting->logo->Upload->DbValue = $rs->fields('logo');
		$setting->notice_duedate->setDbValue($rs->fields('notice_duedate'));
		$setting->invoice_duedate->setDbValue($rs->fields('invoice_duedate'));
		$setting->contact_info->setDbValue($rs->fields('contact_info'));
		$setting->annual_fee_duedate->setDbValue($rs->fields('annual_fee_duedate'));
		$setting->export_path->setDbValue($rs->fields('export_path'));
		$setting->export_date->setDbValue($rs->fields('export_date'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $setting;

		// Initialize URLs
		// Call Row_Rendering event

		$setting->Row_Rendering();

		// Common render codes for all row types
		// setting_id
		// regis_rate
		// annual_rate
		// subvention_rate
		// assc_percent
		// max_subvention
		// rc_rate
		// min_advance_subv
		// max_advance_subv
		// quoted_advance_subv
		// max_age
		// chairman_name
		// chairman_signature
		// receiver_name
		// receiver_signature
		// logo
		// notice_duedate
		// invoice_duedate
		// contact_info
		// annual_fee_duedate
		// export_path
		// export_date

		if ($setting->RowType == EW_ROWTYPE_VIEW) { // View row

	// start_date
			$setting->start_date->ViewValue = $setting->start_date->CurrentValue;
			$setting->start_date->ViewValue = ew_FormatDateTime($setting->start_date->ViewValue, 7);
			$setting->start_date->ViewCustomAttributes = "";

			// old_member
			$setting->old_member->ViewValue = $setting->old_member->CurrentValue;
			$setting->old_member->ViewCustomAttributes = "";

	// dead_member
			$setting->dead_member->ViewValue = $setting->dead_member->CurrentValue;
			$setting->dead_member->ViewCustomAttributes = "";
			// new_member
			$setting->new_member->ViewValue = $setting->new_member->CurrentValue;
			$setting->new_member->ViewCustomAttributes = "";
			// regis_rate
			$setting->regis_rate->ViewValue = $setting->regis_rate->CurrentValue;
			$setting->regis_rate->ViewCustomAttributes = "";

			// annual_rate
			$setting->annual_rate->ViewValue = $setting->annual_rate->CurrentValue;
			$setting->annual_rate->ViewCustomAttributes = "";

			// subvention_rate
			$setting->subvention_rate->ViewValue = $setting->subvention_rate->CurrentValue;
			$setting->subvention_rate->ViewCustomAttributes = "";

			// assc_percent
			$setting->assc_percent->ViewValue = $setting->assc_percent->CurrentValue;
			$setting->assc_percent->ViewCustomAttributes = "";

			// max_subvention
			$setting->max_subvention->ViewValue = $setting->max_subvention->CurrentValue;
			$setting->max_subvention->ViewCustomAttributes = "";

			// rc_rate
			$setting->rc_rate->ViewValue = $setting->rc_rate->CurrentValue;
			$setting->rc_rate->ViewCustomAttributes = "";

			// min_advance_subv
			$setting->min_advance_subv->ViewValue = $setting->min_advance_subv->CurrentValue;
			$setting->min_advance_subv->ViewCustomAttributes = "";

			// max_advance_subv
			$setting->max_advance_subv->ViewValue = $setting->max_advance_subv->CurrentValue;
			$setting->max_advance_subv->ViewCustomAttributes = "";

			// max_age
			$setting->max_age->ViewValue = $setting->max_age->CurrentValue;
			$setting->max_age->ViewCustomAttributes = "";

			// chairman_name
			$setting->chairman_name->ViewValue = $setting->chairman_name->CurrentValue;
			$setting->chairman_name->ViewCustomAttributes = "";

			// chairman_signature
			if (!ew_Empty($setting->chairman_signature->Upload->DbValue)) {
				$setting->chairman_signature->ViewValue = $setting->chairman_signature->Upload->DbValue;
				$setting->chairman_signature->ImageWidth = 120;
				$setting->chairman_signature->ImageHeight = 0;
				$setting->chairman_signature->ImageAlt = $setting->chairman_signature->FldAlt();
			} else {
				$setting->chairman_signature->ViewValue = "";
			}
			$setting->chairman_signature->ViewCustomAttributes = "";

			// receiver_name
			$setting->receiver_name->ViewValue = $setting->receiver_name->CurrentValue;
			$setting->receiver_name->ViewCustomAttributes = "";

			// receiver_signature
			if (!ew_Empty($setting->receiver_signature->Upload->DbValue)) {
				$setting->receiver_signature->ViewValue = $setting->receiver_signature->Upload->DbValue;
				$setting->receiver_signature->ImageWidth = 120;
				$setting->receiver_signature->ImageHeight = 0;
				$setting->receiver_signature->ImageAlt = $setting->receiver_signature->FldAlt();
			} else {
				$setting->receiver_signature->ViewValue = "";
			}
			$setting->receiver_signature->ViewCustomAttributes = "";

			// logo
			if (!ew_Empty($setting->logo->Upload->DbValue)) {
				$setting->logo->ViewValue = $setting->logo->Upload->DbValue;
				$setting->logo->ImageWidth = 130;
				$setting->logo->ImageHeight = 0;
				$setting->logo->ImageAlt = $setting->logo->FldAlt();
			} else {
				$setting->logo->ViewValue = "";
			}
			$setting->logo->ViewCustomAttributes = "";

			// notice_duedate
			$setting->notice_duedate->ViewValue = $setting->notice_duedate->CurrentValue;
			$setting->notice_duedate->ViewCustomAttributes = "";

			// invoice_duedate
			$setting->invoice_duedate->ViewValue = $setting->invoice_duedate->CurrentValue;
			$setting->invoice_duedate->ViewCustomAttributes = "";

			// contact_info
			$setting->contact_info->ViewValue = $setting->contact_info->CurrentValue;
			$setting->contact_info->ViewCustomAttributes = "";

			// annual_fee_duedate
			$setting->annual_fee_duedate->ViewValue = $setting->annual_fee_duedate->CurrentValue;
			$setting->annual_fee_duedate->ViewValue = ew_FormatDateTime($setting->annual_fee_duedate->ViewValue, 7);
			$setting->annual_fee_duedate->ViewCustomAttributes = "";

// export_path
			$setting->export_path->ViewValue = $setting->export_path->CurrentValue;
			$setting->export_path->ViewCustomAttributes = "";

			// export_date
			if (strval($setting->export_date->CurrentValue) <> "") {
				switch ($setting->export_date->CurrentValue) {
					case "15":
						$setting->export_date->ViewValue = $setting->export_date->FldTagCaption(1) <> "" ? $setting->export_date->FldTagCaption(1) : $setting->export_date->CurrentValue;
						break;
					case "30":
						$setting->export_date->ViewValue = $setting->export_date->FldTagCaption(2) <> "" ? $setting->export_date->FldTagCaption(2) : $setting->export_date->CurrentValue;
						break;
					case "45":
						$setting->export_date->ViewValue = $setting->export_date->FldTagCaption(3) <> "" ? $setting->export_date->FldTagCaption(3) : $setting->export_date->CurrentValue;
						break;
					case "60":
						$setting->export_date->ViewValue = $setting->export_date->FldTagCaption(4) <> "" ? $setting->export_date->FldTagCaption(4) : $setting->export_date->CurrentValue;
						break;
					default:
						$setting->export_date->ViewValue = $setting->export_date->CurrentValue;
				}
			} else {
				$setting->export_date->ViewValue = NULL;
			}
			$setting->export_date->ViewCustomAttributes = "";
			
	// start_date
			$setting->start_date->LinkCustomAttributes = "";
			$setting->start_date->HrefValue = "";
			$setting->start_date->TooltipValue = "";

			// old_member
			$setting->old_member->LinkCustomAttributes = "";
			$setting->old_member->HrefValue = "";
			$setting->old_member->TooltipValue = "";

	// dead_member
			$setting->dead_member->LinkCustomAttributes = "";
			$setting->dead_member->HrefValue = "";
			$setting->dead_member->TooltipValue = "";
			// new_member
			$setting->new_member->LinkCustomAttributes = "";
			$setting->new_member->HrefValue = "";
			$setting->new_member->TooltipValue = "";
			// regis_rate
			$setting->regis_rate->LinkCustomAttributes = "";
			$setting->regis_rate->HrefValue = "";
			$setting->regis_rate->TooltipValue = "";

			// annual_rate
			$setting->annual_rate->LinkCustomAttributes = "";
			$setting->annual_rate->HrefValue = "";
			$setting->annual_rate->TooltipValue = "";

			// subvention_rate
			$setting->subvention_rate->LinkCustomAttributes = "";
			$setting->subvention_rate->HrefValue = "";
			$setting->subvention_rate->TooltipValue = "";

			// assc_percent
			$setting->assc_percent->LinkCustomAttributes = "";
			$setting->assc_percent->HrefValue = "";
			$setting->assc_percent->TooltipValue = "";

			// max_subvention
			$setting->max_subvention->LinkCustomAttributes = "";
			$setting->max_subvention->HrefValue = "";
			$setting->max_subvention->TooltipValue = "";

			// rc_rate
			$setting->rc_rate->LinkCustomAttributes = "";
			$setting->rc_rate->HrefValue = "";
			$setting->rc_rate->TooltipValue = "";

			// min_advance_subv
			$setting->min_advance_subv->LinkCustomAttributes = "";
			$setting->min_advance_subv->HrefValue = "";
			$setting->min_advance_subv->TooltipValue = "";

			// max_advance_subv
			$setting->max_advance_subv->LinkCustomAttributes = "";
			$setting->max_advance_subv->HrefValue = "";
			$setting->max_advance_subv->TooltipValue = "";

			// max_age
			$setting->max_age->LinkCustomAttributes = "";
			$setting->max_age->HrefValue = "";
			$setting->max_age->TooltipValue = "";

			// chairman_name
			$setting->chairman_name->LinkCustomAttributes = "";
			$setting->chairman_name->HrefValue = "";
			$setting->chairman_name->TooltipValue = "";

			// chairman_signature
			$setting->chairman_signature->LinkCustomAttributes = "";
			$setting->chairman_signature->HrefValue = "";
			$setting->chairman_signature->TooltipValue = "";

			// receiver_name
			$setting->receiver_name->LinkCustomAttributes = "";
			$setting->receiver_name->HrefValue = "";
			$setting->receiver_name->TooltipValue = "";

			// receiver_signature
			$setting->receiver_signature->LinkCustomAttributes = "";
			$setting->receiver_signature->HrefValue = "";
			$setting->receiver_signature->TooltipValue = "";

			// logo
			$setting->logo->LinkCustomAttributes = "";
			$setting->logo->HrefValue = "";
			$setting->logo->TooltipValue = "";

			// notice_duedate
			$setting->notice_duedate->LinkCustomAttributes = "";
			$setting->notice_duedate->HrefValue = "";
			$setting->notice_duedate->TooltipValue = "";

			// invoice_duedate
			$setting->invoice_duedate->LinkCustomAttributes = "";
			$setting->invoice_duedate->HrefValue = "";
			$setting->invoice_duedate->TooltipValue = "";

			// contact_info
			$setting->contact_info->LinkCustomAttributes = "";
			$setting->contact_info->HrefValue = "";
			$setting->contact_info->TooltipValue = "";

			// annual_fee_duedate
			$setting->annual_fee_duedate->LinkCustomAttributes = "";
			$setting->annual_fee_duedate->HrefValue = "";
			$setting->annual_fee_duedate->TooltipValue = "";
			// export_path
			$setting->export_path->LinkCustomAttributes = "";
			$setting->export_path->HrefValue = "";
			$setting->export_path->TooltipValue = "";

			// export_date
			$setting->export_date->LinkCustomAttributes = "";
			$setting->export_date->HrefValue = "";
			$setting->export_date->TooltipValue = "";
		} elseif ($setting->RowType == EW_ROWTYPE_EDIT) { // Edit row

	// start_date
			$setting->start_date->EditCustomAttributes = "";
			$setting->start_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($setting->start_date->CurrentValue, 7));

			// old_member
			$setting->old_member->EditCustomAttributes = "";
			$setting->old_member->EditValue = ew_HtmlEncode($setting->old_member->CurrentValue);

	// dead_member
			$setting->dead_member->EditCustomAttributes = "";
			$setting->dead_member->EditValue = ew_HtmlEncode($setting->dead_member->CurrentValue);
			// new_member
			$setting->new_member->EditCustomAttributes = "";
			$setting->new_member->EditValue = ew_HtmlEncode($setting->new_member->CurrentValue);
			// regis_rate
			$setting->regis_rate->EditCustomAttributes = "";
			$setting->regis_rate->EditValue = ew_HtmlEncode($setting->regis_rate->CurrentValue);

			// annual_rate
			$setting->annual_rate->EditCustomAttributes = "";
			$setting->annual_rate->EditValue = ew_HtmlEncode($setting->annual_rate->CurrentValue);

			// subvention_rate
			$setting->subvention_rate->EditCustomAttributes = "";
			$setting->subvention_rate->EditValue = ew_HtmlEncode($setting->subvention_rate->CurrentValue);

			// assc_percent
			$setting->assc_percent->EditCustomAttributes = "";
			$setting->assc_percent->EditValue = ew_HtmlEncode($setting->assc_percent->CurrentValue);

			// max_subvention
			$setting->max_subvention->EditCustomAttributes = "";
			$setting->max_subvention->EditValue = ew_HtmlEncode($setting->max_subvention->CurrentValue);

			// rc_rate
			$setting->rc_rate->EditCustomAttributes = "";
			$setting->rc_rate->EditValue = ew_HtmlEncode($setting->rc_rate->CurrentValue);

			// min_advance_subv
			$setting->min_advance_subv->EditCustomAttributes = "";
			$setting->min_advance_subv->EditValue = ew_HtmlEncode($setting->min_advance_subv->CurrentValue);

			// max_advance_subv
			$setting->max_advance_subv->EditCustomAttributes = "";
			$setting->max_advance_subv->EditValue = ew_HtmlEncode($setting->max_advance_subv->CurrentValue);

			// max_age
			$setting->max_age->EditCustomAttributes = "";
			$setting->max_age->EditValue = ew_HtmlEncode($setting->max_age->CurrentValue);

			// chairman_name
			$setting->chairman_name->EditCustomAttributes = "";
			$setting->chairman_name->EditValue = ew_HtmlEncode($setting->chairman_name->CurrentValue);

			// chairman_signature
			$setting->chairman_signature->EditCustomAttributes = "";
			if (!ew_Empty($setting->chairman_signature->Upload->DbValue)) {
				$setting->chairman_signature->EditValue = $setting->chairman_signature->Upload->DbValue;
				$setting->chairman_signature->ImageWidth = 120;
				$setting->chairman_signature->ImageHeight = 0;
				$setting->chairman_signature->ImageAlt = $setting->chairman_signature->FldAlt();
			} else {
				$setting->chairman_signature->EditValue = "";
			}

			// receiver_name
			$setting->receiver_name->EditCustomAttributes = "";
			$setting->receiver_name->EditValue = ew_HtmlEncode($setting->receiver_name->CurrentValue);

			// receiver_signature
			$setting->receiver_signature->EditCustomAttributes = "";
			if (!ew_Empty($setting->receiver_signature->Upload->DbValue)) {
				$setting->receiver_signature->EditValue = $setting->receiver_signature->Upload->DbValue;
				$setting->receiver_signature->ImageWidth = 120;
				$setting->receiver_signature->ImageHeight = 0;
				$setting->receiver_signature->ImageAlt = $setting->receiver_signature->FldAlt();
			} else {
				$setting->receiver_signature->EditValue = "";
			}

			// logo
			$setting->logo->EditCustomAttributes = "";
			if (!ew_Empty($setting->logo->Upload->DbValue)) {
				$setting->logo->EditValue = $setting->logo->Upload->DbValue;
				$setting->logo->ImageWidth = 130;
				$setting->logo->ImageHeight = 0;
				$setting->logo->ImageAlt = $setting->logo->FldAlt();
			} else {
				$setting->logo->EditValue = "";
			}

			// notice_duedate
			$setting->notice_duedate->EditCustomAttributes = "";
			$setting->notice_duedate->EditValue = ew_HtmlEncode($setting->notice_duedate->CurrentValue);

			// invoice_duedate
			$setting->invoice_duedate->EditCustomAttributes = "";
			$setting->invoice_duedate->EditValue = ew_HtmlEncode($setting->invoice_duedate->CurrentValue);

			// contact_info
			$setting->contact_info->EditCustomAttributes = "";
			$setting->contact_info->EditValue = ew_HtmlEncode($setting->contact_info->CurrentValue);

			// annual_fee_duedate
			$setting->annual_fee_duedate->EditCustomAttributes = "";
			$setting->annual_fee_duedate->EditValue = ew_HtmlEncode(ew_FormatDateTime($setting->annual_fee_duedate->CurrentValue, 7));
			
			
			// export_path
			$setting->export_path->EditCustomAttributes = "";
			$setting->export_path->EditValue = ew_HtmlEncode($setting->export_path->CurrentValue);

			// export_date
			$setting->export_date->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("15", $setting->export_date->FldTagCaption(1) <> "" ? $setting->export_date->FldTagCaption(1) : "15");
			$arwrk[] = array("30", $setting->export_date->FldTagCaption(2) <> "" ? $setting->export_date->FldTagCaption(2) : "30");
			$arwrk[] = array("45", $setting->export_date->FldTagCaption(3) <> "" ? $setting->export_date->FldTagCaption(3) : "45");
			$arwrk[] = array("60", $setting->export_date->FldTagCaption(4) <> "" ? $setting->export_date->FldTagCaption(4) : "60");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$setting->export_date->EditValue = $arwrk;

			// Edit refer script
	// start_date

			$setting->start_date->HrefValue = "";

			// old_member
			$setting->old_member->HrefValue = "";

// dead_member
			$setting->dead_member->HrefValue = "";
			// new_member
			$setting->new_member->HrefValue = "";
			// regis_rate

			$setting->regis_rate->HrefValue = "";

			// annual_rate
			$setting->annual_rate->HrefValue = "";

			// subvention_rate
			$setting->subvention_rate->HrefValue = "";

			// assc_percent
			$setting->assc_percent->HrefValue = "";

			// max_subvention
			$setting->max_subvention->HrefValue = "";

			// rc_rate
			$setting->rc_rate->HrefValue = "";

			// min_advance_subv
			$setting->min_advance_subv->HrefValue = "";

			// max_advance_subv
			$setting->max_advance_subv->HrefValue = "";

			// max_age
			$setting->max_age->HrefValue = "";

			// chairman_name
			$setting->chairman_name->HrefValue = "";

			// chairman_signature
			$setting->chairman_signature->HrefValue = "";

			// receiver_name
			$setting->receiver_name->HrefValue = "";

			// receiver_signature
			$setting->receiver_signature->HrefValue = "";

			// logo
			$setting->logo->HrefValue = "";

			// notice_duedate
			$setting->notice_duedate->HrefValue = "";

			// invoice_duedate
			$setting->invoice_duedate->HrefValue = "";

			// contact_info
			$setting->contact_info->HrefValue = "";

			// annual_fee_duedate
			$setting->annual_fee_duedate->HrefValue = "";
			
						// export_path
			$setting->export_path->HrefValue = "";

			// export_date
			$setting->export_date->HrefValue = "";
		}
		if ($setting->RowType == EW_ROWTYPE_ADD ||
			$setting->RowType == EW_ROWTYPE_EDIT ||
			$setting->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$setting->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($setting->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$setting->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $setting;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($setting->chairman_signature->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($setting->chairman_signature->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $setting->chairman_signature->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($setting->chairman_signature->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $setting->chairman_signature->Upload->Error));
		}
		if (!ew_CheckFileType($setting->receiver_signature->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($setting->receiver_signature->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $setting->receiver_signature->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($setting->receiver_signature->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $setting->receiver_signature->Upload->Error));
		}
		if (!ew_CheckFileType($setting->logo->Upload->FileName)) {
			ew_AddMessage($gsFormError, $Language->Phrase("WrongFileType"));
		}
		if ($setting->logo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $setting->logo->Upload->FileSize > EW_MAX_FILE_SIZE) {
			ew_AddMessage($gsFormError, str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize")));
		}
		if (in_array($setting->logo->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			ew_AddMessage($gsFormError, $Language->Phrase("PhpUploadErr" . $setting->logo->Upload->Error));
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckNumber($setting->regis_rate->FormValue)) {
			ew_AddMessage($gsFormError, $setting->regis_rate->FldErrMsg());
		}
	if (!is_null($setting->start_date->FormValue) && $setting->start_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->start_date->FldCaption());
		}
		if (!ew_CheckEuroDate($setting->start_date->FormValue)) {
			ew_AddMessage($gsFormError, $setting->start_date->FldErrMsg());
		}
		if (!is_null($setting->old_member->FormValue) && $setting->old_member->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->old_member->FldCaption());
		}
		if (!ew_CheckInteger($setting->old_member->FormValue)) {
			ew_AddMessage($gsFormError, $setting->old_member->FldErrMsg());
		}
	if (!is_null($setting->dead_member->FormValue) && $setting->dead_member->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->dead_member->FldCaption());
		}
		if (!is_null($setting->new_member->FormValue) && $setting->new_member->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->new_member->FldCaption());
		}
		if (!ew_CheckInteger($setting->new_member->FormValue)) {
			ew_AddMessage($gsFormError, $setting->new_member->FldErrMsg());
		}
		if (!ew_CheckNumber($setting->annual_rate->FormValue)) {
			ew_AddMessage($gsFormError, $setting->annual_rate->FldErrMsg());
		}
		if (!ew_CheckNumber($setting->subvention_rate->FormValue)) {
			ew_AddMessage($gsFormError, $setting->subvention_rate->FldErrMsg());
		}
		if (!ew_CheckInteger($setting->assc_percent->FormValue)) {
			ew_AddMessage($gsFormError, $setting->assc_percent->FldErrMsg());
		}
		if (!is_null($setting->max_subvention->FormValue) && $setting->max_subvention->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->max_subvention->FldCaption());
		}
		if (!ew_CheckInteger($setting->max_subvention->FormValue)) {
			ew_AddMessage($gsFormError, $setting->max_subvention->FldErrMsg());
		}
		if (!is_null($setting->rc_rate->FormValue) && $setting->rc_rate->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->rc_rate->FldCaption());
		}
		if (!ew_CheckInteger($setting->rc_rate->FormValue)) {
			ew_AddMessage($gsFormError, $setting->rc_rate->FldErrMsg());
		}
		if (!is_null($setting->min_advance_subv->FormValue) && $setting->min_advance_subv->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->min_advance_subv->FldCaption());
		}
		if (!ew_CheckInteger($setting->min_advance_subv->FormValue)) {
			ew_AddMessage($gsFormError, $setting->min_advance_subv->FldErrMsg());
		}
		if (!is_null($setting->max_advance_subv->FormValue) && $setting->max_advance_subv->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->max_advance_subv->FldCaption());
		}
		if (!ew_CheckInteger($setting->max_advance_subv->FormValue)) {
			ew_AddMessage($gsFormError, $setting->max_advance_subv->FldErrMsg());
		}
		if (!ew_CheckInteger($setting->max_age->FormValue)) {
			ew_AddMessage($gsFormError, $setting->max_age->FldErrMsg());
		}
		if (!is_null($setting->chairman_name->FormValue) && $setting->chairman_name->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->chairman_name->FldCaption());
		}
		if (!is_null($setting->receiver_name->FormValue) && $setting->receiver_name->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->receiver_name->FldCaption());
		}
		if ($setting->logo->Upload->Action == "3" && is_null($setting->logo->Upload->Value)) {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->logo->FldCaption());
		}
		if (!is_null($setting->notice_duedate->FormValue) && $setting->notice_duedate->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->notice_duedate->FldCaption());
		}
		if (!ew_CheckInteger($setting->notice_duedate->FormValue)) {
			ew_AddMessage($gsFormError, $setting->notice_duedate->FldErrMsg());
		}
		if (!is_null($setting->invoice_duedate->FormValue) && $setting->invoice_duedate->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->invoice_duedate->FldCaption());
		}
		if (!ew_CheckInteger($setting->invoice_duedate->FormValue)) {
			ew_AddMessage($gsFormError, $setting->invoice_duedate->FldErrMsg());
		}
		if (!is_null($setting->contact_info->FormValue) && $setting->contact_info->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->contact_info->FldCaption());
		}
		if (!is_null($setting->annual_fee_duedate->FormValue) && $setting->annual_fee_duedate->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->annual_fee_duedate->FldCaption());
		}
		if (!ew_CheckEuroDate($setting->annual_fee_duedate->FormValue)) {
			ew_AddMessage($gsFormError, $setting->annual_fee_duedate->FldErrMsg());
		}
		if (!is_null($setting->export_path->FormValue) && $setting->export_path->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->export_path->FldCaption());
		}
		if (!is_null($setting->export_date->FormValue) && $setting->export_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $setting->export_date->FldCaption());
		}
		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $setting;
		$sFilter = $setting->KeyFilter();
		$setting->CurrentFilter = $sFilter;
		$sSql = $setting->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

	// start_date
			$setting->start_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($setting->start_date->CurrentValue, 7), ew_CurrentDate(), $setting->start_date->ReadOnly);

			// old_member
			$setting->old_member->SetDbValueDef($rsnew, $setting->old_member->CurrentValue, 0, $setting->old_member->ReadOnly);

// dead_member
			$setting->dead_member->SetDbValueDef($rsnew, $setting->dead_member->CurrentValue, 0, $setting->dead_member->ReadOnly);
			// new_member
			$setting->new_member->SetDbValueDef($rsnew, $setting->new_member->CurrentValue, 0, $setting->new_member->ReadOnly);
			// regis_rate
			$setting->regis_rate->SetDbValueDef($rsnew, $setting->regis_rate->CurrentValue, NULL, $setting->regis_rate->ReadOnly);

			// annual_rate
			$setting->annual_rate->SetDbValueDef($rsnew, $setting->annual_rate->CurrentValue, NULL, $setting->annual_rate->ReadOnly);

			// subvention_rate
			$setting->subvention_rate->SetDbValueDef($rsnew, $setting->subvention_rate->CurrentValue, NULL, $setting->subvention_rate->ReadOnly);

			// assc_percent
			$setting->assc_percent->SetDbValueDef($rsnew, $setting->assc_percent->CurrentValue, NULL, $setting->assc_percent->ReadOnly);

			// max_subvention
			$setting->max_subvention->SetDbValueDef($rsnew, $setting->max_subvention->CurrentValue, 0, $setting->max_subvention->ReadOnly);

			// rc_rate
			$setting->rc_rate->SetDbValueDef($rsnew, $setting->rc_rate->CurrentValue, 0, $setting->rc_rate->ReadOnly);

			// min_advance_subv
			$setting->min_advance_subv->SetDbValueDef($rsnew, $setting->min_advance_subv->CurrentValue, NULL, $setting->min_advance_subv->ReadOnly);

			// max_advance_subv
			$setting->max_advance_subv->SetDbValueDef($rsnew, $setting->max_advance_subv->CurrentValue, NULL, $setting->max_advance_subv->ReadOnly);

			// max_age
			$setting->max_age->SetDbValueDef($rsnew, $setting->max_age->CurrentValue, NULL, $setting->max_age->ReadOnly);

			// chairman_name
			$setting->chairman_name->SetDbValueDef($rsnew, $setting->chairman_name->CurrentValue, NULL, $setting->chairman_name->ReadOnly);

			// chairman_signature
			if ($setting->chairman_signature->Upload->Action == "1") { // Keep
			} elseif ($setting->chairman_signature->Upload->Action == "2" || $setting->chairman_signature->Upload->Action == "3") { // Update/Remove
			$setting->chairman_signature->Upload->DbValue = $rs->fields('chairman_signature'); // Get original value
			if (is_null($setting->chairman_signature->Upload->Value)) {
				$rsnew['chairman_signature'] = NULL;
			} else {
				if ($setting->chairman_signature->Upload->FileName == $setting->chairman_signature->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['chairman_signature'] = $setting->chairman_signature->Upload->FileName;
				} else {
					$rsnew['chairman_signature'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $setting->chairman_signature->UploadPath), $setting->chairman_signature->Upload->FileName);
				}
			}
			$setting->chairman_signature->ImageWidth = 120; // Resize width
			$setting->chairman_signature->ImageHeight = 0; // Resize height
			}

			// receiver_name
			$setting->receiver_name->SetDbValueDef($rsnew, $setting->receiver_name->CurrentValue, NULL, $setting->receiver_name->ReadOnly);

			// receiver_signature
			if ($setting->receiver_signature->Upload->Action == "1") { // Keep
			} elseif ($setting->receiver_signature->Upload->Action == "2" || $setting->receiver_signature->Upload->Action == "3") { // Update/Remove
			$setting->receiver_signature->Upload->DbValue = $rs->fields('receiver_signature'); // Get original value
			if (is_null($setting->receiver_signature->Upload->Value)) {
				$rsnew['receiver_signature'] = NULL;
			} else {
				if ($setting->receiver_signature->Upload->FileName == $setting->receiver_signature->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['receiver_signature'] = $setting->receiver_signature->Upload->FileName;
				} else {
					$rsnew['receiver_signature'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $setting->receiver_signature->UploadPath), $setting->receiver_signature->Upload->FileName);
				}
			}
			$setting->receiver_signature->ImageWidth = 120; // Resize width
			$setting->receiver_signature->ImageHeight = 0; // Resize height
			}

			// logo
			if ($setting->logo->Upload->Action == "1") { // Keep
			} elseif ($setting->logo->Upload->Action == "2" || $setting->logo->Upload->Action == "3") { // Update/Remove
			$setting->logo->Upload->DbValue = $rs->fields('logo'); // Get original value
			if (is_null($setting->logo->Upload->Value)) {
				$rsnew['logo'] = NULL;
			} else {
				if ($setting->logo->Upload->FileName == $setting->logo->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['logo'] = $setting->logo->Upload->FileName;
				} else {
					$rsnew['logo'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $setting->logo->UploadPath), $setting->logo->Upload->FileName);
				}
			}
			$setting->logo->ImageWidth = 130; // Resize width
			$setting->logo->ImageHeight = 0; // Resize height
			}

			// notice_duedate
			$setting->notice_duedate->SetDbValueDef($rsnew, $setting->notice_duedate->CurrentValue, NULL, $setting->notice_duedate->ReadOnly);

			// invoice_duedate
			$setting->invoice_duedate->SetDbValueDef($rsnew, $setting->invoice_duedate->CurrentValue, NULL, $setting->invoice_duedate->ReadOnly);

			// contact_info
			$setting->contact_info->SetDbValueDef($rsnew, $setting->contact_info->CurrentValue, NULL, $setting->contact_info->ReadOnly);

			// annual_fee_duedate
			$setting->annual_fee_duedate->SetDbValueDef($rsnew, ew_UnFormatDateTime($setting->annual_fee_duedate->CurrentValue, 7), ew_CurrentDate(), $setting->annual_fee_duedate->ReadOnly);


			// export_path
			$setting->export_path->SetDbValueDef($rsnew, $setting->export_path->CurrentValue, "", $setting->export_path->ReadOnly);

			// export_date
			$setting->export_date->SetDbValueDef($rsnew, $setting->export_date->CurrentValue, 0, $setting->export_date->ReadOnly);
			
			
			// Call Row Updating event
			$bUpdateRow = $setting->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($setting->chairman_signature->Upload->Value)) {
				$setting->chairman_signature->Upload->RestoreFromSession(); // Restore original value
				$setting->chairman_signature->Upload->Resize($setting->chairman_signature->ImageWidth, $setting->chairman_signature->ImageHeight, 75);
			}
			$setting->chairman_signature->ImageWidth = 0; // Reset image width
			$setting->chairman_signature->ImageHeight = 0; // Reset image height
			if (!ew_Empty($setting->chairman_signature->Upload->Value)) {
				if ($setting->chairman_signature->Upload->FileName == $setting->chairman_signature->Upload->DbValue) { // Overwrite if same file name
					$setting->chairman_signature->Upload->SaveToFile($setting->chairman_signature->UploadPath, $rsnew['chairman_signature'], TRUE);
					$setting->chairman_signature->Upload->DbValue = ""; // No need to delete any more
				} else {
					$setting->chairman_signature->Upload->SaveToFile($setting->chairman_signature->UploadPath, $rsnew['chairman_signature'], FALSE);
				}
			}
			if ($setting->chairman_signature->Upload->Action == "2" || $setting->chairman_signature->Upload->Action == "3") { // Update/Remove
				if ($setting->chairman_signature->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, $setting->chairman_signature->UploadPath) . $setting->chairman_signature->Upload->DbValue);
			}
			if (!ew_Empty($setting->receiver_signature->Upload->Value)) {
				$setting->receiver_signature->Upload->RestoreFromSession(); // Restore original value
				$setting->receiver_signature->Upload->Resize($setting->receiver_signature->ImageWidth, $setting->receiver_signature->ImageHeight, 75);
			}
			$setting->receiver_signature->ImageWidth = 0; // Reset image width
			$setting->receiver_signature->ImageHeight = 0; // Reset image height
			if (!ew_Empty($setting->receiver_signature->Upload->Value)) {
				if ($setting->receiver_signature->Upload->FileName == $setting->receiver_signature->Upload->DbValue) { // Overwrite if same file name
					$setting->receiver_signature->Upload->SaveToFile($setting->receiver_signature->UploadPath, $rsnew['receiver_signature'], TRUE);
					$setting->receiver_signature->Upload->DbValue = ""; // No need to delete any more
				} else {
					$setting->receiver_signature->Upload->SaveToFile($setting->receiver_signature->UploadPath, $rsnew['receiver_signature'], FALSE);
				}
			}
			if ($setting->receiver_signature->Upload->Action == "2" || $setting->receiver_signature->Upload->Action == "3") { // Update/Remove
				if ($setting->receiver_signature->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, $setting->receiver_signature->UploadPath) . $setting->receiver_signature->Upload->DbValue);
			}
			if (!ew_Empty($setting->logo->Upload->Value)) {
				$setting->logo->Upload->RestoreFromSession(); // Restore original value
				$setting->logo->Upload->Resize($setting->logo->ImageWidth, $setting->logo->ImageHeight, 75);
			}
			$setting->logo->ImageWidth = 0; // Reset image width
			$setting->logo->ImageHeight = 0; // Reset image height
			if (!ew_Empty($setting->logo->Upload->Value)) {
				if ($setting->logo->Upload->FileName == $setting->logo->Upload->DbValue) { // Overwrite if same file name
					$setting->logo->Upload->SaveToFile($setting->logo->UploadPath, $rsnew['logo'], TRUE);
					$setting->logo->Upload->DbValue = ""; // No need to delete any more
				} else {
					$setting->logo->Upload->SaveToFile($setting->logo->UploadPath, $rsnew['logo'], FALSE);
				}
			}
			if ($setting->logo->Upload->Action == "2" || $setting->logo->Upload->Action == "3") { // Update/Remove
				if ($setting->logo->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, $setting->logo->UploadPath) . $setting->logo->Upload->DbValue);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($setting->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($setting->CancelMessage <> "") {
					$this->setFailureMessage($setting->CancelMessage);
					$setting->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$setting->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// chairman_signature
		$setting->chairman_signature->Upload->RemoveFromSession(); // Remove file value from Session

		// receiver_signature
		$setting->receiver_signature->Upload->RemoveFromSession(); // Remove file value from Session

		// logo
		$setting->logo->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

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
