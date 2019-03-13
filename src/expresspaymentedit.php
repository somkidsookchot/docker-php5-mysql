<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "expresspaymentinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$expresspayment_edit = new cexpresspayment_edit();
$Page =& $expresspayment_edit;

// Page init
$expresspayment_edit->Page_Init();

// Page main
$expresspayment_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expresspayment_edit = new ew_Page("expresspayment_edit");

// page properties
expresspayment_edit.PageID = "edit"; // page ID
expresspayment_edit.FormID = "fexpresspaymentedit"; // form ID
var EW_PAGE_ID = expresspayment_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
expresspayment_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_t_code"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expresspayment->t_code->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_village_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expresspayment->village_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_subv_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expresspayment->subv_total->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_adv_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expresspayment->adv_total->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_rc_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expresspayment->rc_total->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_annual_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expresspayment->annual_total->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_regis_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expresspayment->regis_total->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_other_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expresspayment->other_total->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_expr_pay_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expresspayment->expr_pay_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_expr_pay_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expresspayment->expr_pay_date->FldErrMsg()) ?>");

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
expresspayment_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expresspayment_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expresspayment_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expresspayment_edit.ValidateRequired = false; // no JavaScript validation
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
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<div class="phpmaker ewTitle"><img src="images/ico_paid.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expresspayment->TableCaption() ?></div>
<div class="clear"></div>
<p class="phpmaker"><a href="<?php echo $expresspayment->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $expresspayment_edit->ShowPageHeader(); ?>
<?php
$expresspayment_edit->ShowMessage();
?>
<form name="fexpresspaymentedit" id="fexpresspaymentedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return expresspayment_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="expresspayment">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($expresspayment->t_code->Visible) { // t_code ?>
	<tr id="r_t_code"<?php echo $expresspayment->RowAttributes() ?>>
		<td width="170" class="ewTableHeader"><?php echo $expresspayment->t_code->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expresspayment->t_code->CellAttributes() ?>><span id="el_t_code">
<?php $expresspayment->t_code->EditAttrs["onchange"] = "ew_UpdateOpt('x_village_id','x_t_code',true); " . @$expresspayment->t_code->EditAttrs["onchange"]; ?>
<select id="x_t_code" name="x_t_code"<?php echo $expresspayment->t_code->EditAttributes() ?>>
<?php
if (is_array($expresspayment->t_code->EditValue)) {
	$arwrk = $expresspayment->t_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expresspayment->t_code->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$expresspayment->t_code) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php
$sSqlWrk = "SELECT `t_code`, `t_code` AS `DispFld`, `t_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tambon`";
$sWhereWrk = "";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `t_code`";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_t_code" id="s_x_t_code" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_t_code" id="lft_x_t_code" value="">
</span><?php echo $expresspayment->t_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->village_id->Visible) { // village_id ?>
	<tr id="r_village_id"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->village_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expresspayment->village_id->CellAttributes() ?>><span id="el_village_id">
<select id="x_village_id" name="x_village_id"<?php echo $expresspayment->village_id->EditAttributes() ?>>
<?php
if (is_array($expresspayment->village_id->EditValue)) {
	$arwrk = $expresspayment->village_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expresspayment->village_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$expresspayment->village_id) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php
$sSqlWrk = "SELECT `village_id`, `v_code` AS `DispFld`, `v_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `village`";
$sWhereWrk = "`t_code` IN ({filter_value})";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `v_code`";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_village_id" id="s_x_village_id" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_village_id" id="lft_x_village_id" value="3">
</span><?php echo $expresspayment->village_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->subv_total->Visible) { // subv_total ?>
	<tr id="r_subv_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->subv_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->subv_total->CellAttributes() ?>><span id="el_subv_total">
<input type="text" name="x_subv_total" id="x_subv_total" size="30" value="<?php echo $expresspayment->subv_total->EditValue ?>"<?php echo $expresspayment->subv_total->EditAttributes() ?>>
</span><?php echo $expresspayment->subv_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->subv_detail->Visible) { // subv_detail ?>
	<tr id="r_subv_detail"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->subv_detail->FldCaption() ?></td>
		<td<?php echo $expresspayment->subv_detail->CellAttributes() ?>><span id="el_subv_detail">
<input type="text" name="x_subv_detail" id="x_subv_detail" size="30" maxlength="100" value="<?php echo $expresspayment->subv_detail->EditValue ?>"<?php echo $expresspayment->subv_detail->EditAttributes() ?>>
</span><?php echo $expresspayment->subv_detail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->adv_total->Visible) { // adv_total ?>
	<tr id="r_adv_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->adv_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->adv_total->CellAttributes() ?>><span id="el_adv_total">
<input type="text" name="x_adv_total" id="x_adv_total" size="30" value="<?php echo $expresspayment->adv_total->EditValue ?>"<?php echo $expresspayment->adv_total->EditAttributes() ?>>
</span><?php echo $expresspayment->adv_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->adv_detail->Visible) { // adv_detail ?>
	<tr id="r_adv_detail"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->adv_detail->FldCaption() ?></td>
		<td<?php echo $expresspayment->adv_detail->CellAttributes() ?>><span id="el_adv_detail">
<input type="text" name="x_adv_detail" id="x_adv_detail" size="30" maxlength="100" value="<?php echo $expresspayment->adv_detail->EditValue ?>"<?php echo $expresspayment->adv_detail->EditAttributes() ?>>
</span><?php echo $expresspayment->adv_detail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->rc_total->Visible) { // rc_total ?>
	<tr id="r_rc_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->rc_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->rc_total->CellAttributes() ?>><span id="el_rc_total">
<input type="text" name="x_rc_total" id="x_rc_total" size="30" value="<?php echo $expresspayment->rc_total->EditValue ?>"<?php echo $expresspayment->rc_total->EditAttributes() ?>>
</span><?php echo $expresspayment->rc_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->rc_detail->Visible) { // rc_detail ?>
	<tr id="r_rc_detail"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->rc_detail->FldCaption() ?></td>
		<td<?php echo $expresspayment->rc_detail->CellAttributes() ?>><span id="el_rc_detail">
<input type="text" name="x_rc_detail" id="x_rc_detail" size="30" maxlength="100" value="<?php echo $expresspayment->rc_detail->EditValue ?>"<?php echo $expresspayment->rc_detail->EditAttributes() ?>>
</span><?php echo $expresspayment->rc_detail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->annual_total->Visible) { // annual_total ?>
	<tr id="r_annual_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->annual_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->annual_total->CellAttributes() ?>><span id="el_annual_total">
<input type="text" name="x_annual_total" id="x_annual_total" size="30" value="<?php echo $expresspayment->annual_total->EditValue ?>"<?php echo $expresspayment->annual_total->EditAttributes() ?>>
</span><?php echo $expresspayment->annual_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->annual_detail->Visible) { // annual_detail ?>
	<tr id="r_annual_detail"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->annual_detail->FldCaption() ?></td>
		<td<?php echo $expresspayment->annual_detail->CellAttributes() ?>><span id="el_annual_detail">
<input type="text" name="x_annual_detail" id="x_annual_detail" size="30" maxlength="100" value="<?php echo $expresspayment->annual_detail->EditValue ?>"<?php echo $expresspayment->annual_detail->EditAttributes() ?>>
</span><?php echo $expresspayment->annual_detail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->regis_total->Visible) { // regis_total ?>
	<tr id="r_regis_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->regis_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->regis_total->CellAttributes() ?>><span id="el_regis_total">
<input type="text" name="x_regis_total" id="x_regis_total" size="30" value="<?php echo $expresspayment->regis_total->EditValue ?>"<?php echo $expresspayment->regis_total->EditAttributes() ?>>
</span><?php echo $expresspayment->regis_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->regis_detail->Visible) { // regis_detail ?>
	<tr id="r_regis_detail"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->regis_detail->FldCaption() ?></td>
		<td<?php echo $expresspayment->regis_detail->CellAttributes() ?>><span id="el_regis_detail">
<input type="text" name="x_regis_detail" id="x_regis_detail" size="30" maxlength="100" value="<?php echo $expresspayment->regis_detail->EditValue ?>"<?php echo $expresspayment->regis_detail->EditAttributes() ?>>
</span><?php echo $expresspayment->regis_detail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->other_total->Visible) { // other_total ?>
	<tr id="r_other_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->other_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->other_total->CellAttributes() ?>><span id="el_other_total">
<input type="text" name="x_other_total" id="x_other_total" size="30" value="<?php echo $expresspayment->other_total->EditValue ?>"<?php echo $expresspayment->other_total->EditAttributes() ?>>
</span><?php echo $expresspayment->other_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->other_detail->Visible) { // other_detail ?>
	<tr id="r_other_detail"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->other_detail->FldCaption() ?></td>
		<td<?php echo $expresspayment->other_detail->CellAttributes() ?>><span id="el_other_detail">
<input type="text" name="x_other_detail" id="x_other_detail" size="30" maxlength="100" value="<?php echo $expresspayment->other_detail->EditValue ?>"<?php echo $expresspayment->other_detail->EditAttributes() ?>>
</span><?php echo $expresspayment->other_detail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->expr_total->Visible) { // expr_total ?>
	<tr id="r_expr_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->expr_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->expr_total->CellAttributes() ?>><span id="el_expr_total">
<div<?php echo $expresspayment->expr_total->ViewAttributes() ?>><?php echo $expresspayment->expr_total->EditValue ?></div>
<input type="hidden" name="x_expr_total" id="x_expr_total" value="<?php echo ew_HtmlEncode($expresspayment->expr_total->CurrentValue) ?>">
</span><?php echo $expresspayment->expr_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->expr_note->Visible) { // expr_note ?>
	<tr id="r_expr_note"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->expr_note->FldCaption() ?></td>
		<td<?php echo $expresspayment->expr_note->CellAttributes() ?>><span id="el_expr_note">
<textarea name="x_expr_note" id="x_expr_note" cols="35" rows="4"<?php echo $expresspayment->expr_note->EditAttributes() ?>><?php echo $expresspayment->expr_note->EditValue ?></textarea>
</span><?php echo $expresspayment->expr_note->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->expr_pay_date->Visible) { // expr_pay_date ?>
	<tr id="r_expr_pay_date"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->expr_pay_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expresspayment->expr_pay_date->CellAttributes() ?>><span id="el_expr_pay_date">
<input type="text" name="x_expr_pay_date" id="x_expr_pay_date" value="<?php echo $expresspayment->expr_pay_date->EditValue ?>"<?php echo $expresspayment->expr_pay_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_expr_pay_date" name="cal_x_expr_pay_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_expr_pay_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_expr_pay_date" // button id
});
</script>
</span><?php echo $expresspayment->expr_pay_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->expr_slipt_num->Visible) { // expr_slipt_num ?>
	<tr id="r_expr_slipt_num"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->expr_slipt_num->FldCaption() ?></td>
		<td<?php echo $expresspayment->expr_slipt_num->CellAttributes() ?>><span id="el_expr_slipt_num">
<div<?php echo $expresspayment->expr_slipt_num->ViewAttributes() ?>><?php echo $expresspayment->expr_slipt_num->EditValue ?></div>
<input type="hidden" name="x_expr_slipt_num" id="x_expr_slipt_num" value="<?php echo ew_HtmlEncode($expresspayment->expr_slipt_num->CurrentValue) ?>">
</span><?php echo $expresspayment->expr_slipt_num->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_expr_id" id="x_expr_id" value="<?php echo ew_HtmlEncode($expresspayment->expr_id->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_village_id','x_t_code',false],
['x_t_code','x_t_code',false]]);

//-->
</script>
<?php
$expresspayment_edit->ShowPageFooter();
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
$expresspayment_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpresspayment_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'expresspayment';

	// Page object name
	var $PageObjName = 'expresspayment_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expresspayment;
		if ($expresspayment->UseTokenInUrl) $PageUrl .= "t=" . $expresspayment->TableVar . "&"; // Add page token
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
		global $objForm, $expresspayment;
		if ($expresspayment->UseTokenInUrl) {
			if ($objForm)
				return ($expresspayment->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expresspayment->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpresspayment_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (expresspayment)
		if (!isset($GLOBALS["expresspayment"])) {
			$GLOBALS["expresspayment"] = new cexpresspayment();
			$GLOBALS["Table"] =& $GLOBALS["expresspayment"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expresspayment', TRUE);

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
		global $expresspayment;

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
		global $objForm, $Language, $gsFormError, $expresspayment;

		// Load key from QueryString
		if (@$_GET["expr_id"] <> "")
			$expresspayment->expr_id->setQueryStringValue($_GET["expr_id"]);
		if (@$_POST["a_edit"] <> "") {
			$expresspayment->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$expresspayment->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$expresspayment->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$expresspayment->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($expresspayment->expr_id->CurrentValue == "")
			$this->Page_Terminate("expresspaymentlist.php"); // Invalid key, return to list
		switch ($expresspayment->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("expresspaymentlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$expresspayment->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $expresspayment->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "expresspaymentview.php")
						$sReturnUrl = $expresspayment->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$expresspayment->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$expresspayment->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$expresspayment->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $expresspayment;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $expresspayment;
		if (!$expresspayment->t_code->FldIsDetailKey) {
			$expresspayment->t_code->setFormValue($objForm->GetValue("x_t_code"));
		}
		if (!$expresspayment->village_id->FldIsDetailKey) {
			$expresspayment->village_id->setFormValue($objForm->GetValue("x_village_id"));
		}
		if (!$expresspayment->subv_total->FldIsDetailKey) {
			$expresspayment->subv_total->setFormValue($objForm->GetValue("x_subv_total"));
		}
		if (!$expresspayment->subv_detail->FldIsDetailKey) {
			$expresspayment->subv_detail->setFormValue($objForm->GetValue("x_subv_detail"));
		}
		if (!$expresspayment->adv_total->FldIsDetailKey) {
			$expresspayment->adv_total->setFormValue($objForm->GetValue("x_adv_total"));
		}
		if (!$expresspayment->adv_detail->FldIsDetailKey) {
			$expresspayment->adv_detail->setFormValue($objForm->GetValue("x_adv_detail"));
		}
	if (!$expresspayment->rc_total->FldIsDetailKey) {
			$expresspayment->rc_total->setFormValue($objForm->GetValue("x_rc_total"));
		}
		if (!$expresspayment->rc_detail->FldIsDetailKey) {
			$expresspayment->rc_detail->setFormValue($objForm->GetValue("x_rc_detail"));
		}
		if (!$expresspayment->annual_total->FldIsDetailKey) {
			$expresspayment->annual_total->setFormValue($objForm->GetValue("x_annual_total"));
		}
		if (!$expresspayment->annual_detail->FldIsDetailKey) {
			$expresspayment->annual_detail->setFormValue($objForm->GetValue("x_annual_detail"));
		}
		if (!$expresspayment->regis_total->FldIsDetailKey) {
			$expresspayment->regis_total->setFormValue($objForm->GetValue("x_regis_total"));
		}
		if (!$expresspayment->regis_detail->FldIsDetailKey) {
			$expresspayment->regis_detail->setFormValue($objForm->GetValue("x_regis_detail"));
		}
		if (!$expresspayment->other_total->FldIsDetailKey) {
			$expresspayment->other_total->setFormValue($objForm->GetValue("x_other_total"));
		}
		if (!$expresspayment->other_detail->FldIsDetailKey) {
			$expresspayment->other_detail->setFormValue($objForm->GetValue("x_other_detail"));
		}
		if (!$expresspayment->expr_total->FldIsDetailKey) {
			$expresspayment->expr_total->setFormValue($objForm->GetValue("x_expr_total"));
		}
		if (!$expresspayment->expr_note->FldIsDetailKey) {
			$expresspayment->expr_note->setFormValue($objForm->GetValue("x_expr_note"));
		}
		if (!$expresspayment->expr_pay_date->FldIsDetailKey) {
			$expresspayment->expr_pay_date->setFormValue($objForm->GetValue("x_expr_pay_date"));
			$expresspayment->expr_pay_date->CurrentValue = ew_UnFormatDateTime($expresspayment->expr_pay_date->CurrentValue, 7);
		}
		if (!$expresspayment->expr_slipt_num->FldIsDetailKey) {
			$expresspayment->expr_slipt_num->setFormValue($objForm->GetValue("x_expr_slipt_num"));
		}
		if (!$expresspayment->expr_id->FldIsDetailKey)
			$expresspayment->expr_id->setFormValue($objForm->GetValue("x_expr_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $expresspayment;
		$this->LoadRow();
		$expresspayment->expr_id->CurrentValue = $expresspayment->expr_id->FormValue;
		$expresspayment->t_code->CurrentValue = $expresspayment->t_code->FormValue;
		$expresspayment->village_id->CurrentValue = $expresspayment->village_id->FormValue;
		$expresspayment->subv_total->CurrentValue = $expresspayment->subv_total->FormValue;
		$expresspayment->subv_detail->CurrentValue = $expresspayment->subv_detail->FormValue;
		$expresspayment->adv_total->CurrentValue = $expresspayment->adv_total->FormValue;
		$expresspayment->adv_detail->CurrentValue = $expresspayment->adv_detail->FormValue;
		$expresspayment->rc_total->CurrentValue = $expresspayment->rc_total->FormValue;
		$expresspayment->rc_detail->CurrentValue = $expresspayment->rc_detail->FormValue;
		$expresspayment->annual_total->CurrentValue = $expresspayment->annual_total->FormValue;
		$expresspayment->annual_detail->CurrentValue = $expresspayment->annual_detail->FormValue;
		$expresspayment->regis_total->CurrentValue = $expresspayment->regis_total->FormValue;
		$expresspayment->regis_detail->CurrentValue = $expresspayment->regis_detail->FormValue;
		$expresspayment->other_total->CurrentValue = $expresspayment->other_total->FormValue;
		$expresspayment->other_detail->CurrentValue = $expresspayment->other_detail->FormValue;
		$expresspayment->expr_total->CurrentValue = $expresspayment->expr_total->FormValue;
		$expresspayment->expr_note->CurrentValue = $expresspayment->expr_note->FormValue;
		$expresspayment->expr_pay_date->CurrentValue = $expresspayment->expr_pay_date->FormValue;
		$expresspayment->expr_pay_date->CurrentValue = ew_UnFormatDateTime($expresspayment->expr_pay_date->CurrentValue, 7);
		$expresspayment->expr_slipt_num->CurrentValue = $expresspayment->expr_slipt_num->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expresspayment;
		$sFilter = $expresspayment->KeyFilter();

		// Call Row Selecting event
		$expresspayment->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expresspayment->CurrentFilter = $sFilter;
		$sSql = $expresspayment->SQL();
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
		global $conn, $expresspayment;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$expresspayment->Row_Selected($row);
		$expresspayment->expr_id->setDbValue($rs->fields('expr_id'));
		$expresspayment->t_code->setDbValue($rs->fields('t_code'));
		$expresspayment->village_id->setDbValue($rs->fields('village_id'));
		$expresspayment->subv_total->setDbValue($rs->fields('subv_total'));
		$expresspayment->subv_detail->setDbValue($rs->fields('subv_detail'));
		$expresspayment->adv_total->setDbValue($rs->fields('adv_total'));
		$expresspayment->adv_detail->setDbValue($rs->fields('adv_detail'));
		$expresspayment->rc_total->setDbValue($rs->fields('rc_total'));
		$expresspayment->rc_detail->setDbValue($rs->fields('rc_detail'));
		$expresspayment->annual_total->setDbValue($rs->fields('annual_total'));
		$expresspayment->annual_detail->setDbValue($rs->fields('annual_detail'));
		$expresspayment->regis_total->setDbValue($rs->fields('regis_total'));
		$expresspayment->regis_detail->setDbValue($rs->fields('regis_detail'));
		$expresspayment->other_total->setDbValue($rs->fields('other_total'));
		$expresspayment->other_detail->setDbValue($rs->fields('other_detail'));
		$expresspayment->expr_total->setDbValue($rs->fields('expr_total'));
		$expresspayment->expr_note->setDbValue($rs->fields('expr_note'));
		$expresspayment->expr_pay_date->setDbValue($rs->fields('expr_pay_date'));
		$expresspayment->expr_slipt_num->setDbValue($rs->fields('expr_slipt_num'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expresspayment;

		// Initialize URLs
		// Call Row_Rendering event

		$expresspayment->Row_Rendering();

		// Common render codes for all row types
		// expr_id
		// t_code
		// village_id
		// subv_total
		// subv_detail
		// adv_total
		// adv_detail
		// rc_total
		// rc_detail
		// annual_total
		// annual_detail
		// regis_total
		// regis_detail
		// other_total
		// other_detail
		// expr_total
		// expr_note
		// expr_pay_date
		// expr_slipt_num

		if ($expresspayment->RowType == EW_ROWTYPE_VIEW) { // View row

			// t_code
			if (strval($expresspayment->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($expresspayment->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expresspayment->t_code->ViewValue = $rswrk->fields('t_code');
					$expresspayment->t_code->ViewValue .= ew_ValueSeparator(0,1,$expresspayment->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$expresspayment->t_code->ViewValue = $expresspayment->t_code->CurrentValue;
				}
			} else {
				$expresspayment->t_code->ViewValue = NULL;
			}
			$expresspayment->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($expresspayment->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($expresspayment->village_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `v_code`, `v_title` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expresspayment->village_id->ViewValue = $rswrk->fields('v_code');
					$expresspayment->village_id->ViewValue .= ew_ValueSeparator(0,1,$expresspayment->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$expresspayment->village_id->ViewValue = $expresspayment->village_id->CurrentValue;
				}
			} else {
				$expresspayment->village_id->ViewValue = NULL;
			}
			$expresspayment->village_id->ViewCustomAttributes = "";

			// subv_total
			$expresspayment->subv_total->ViewValue = $expresspayment->subv_total->CurrentValue;
			$expresspayment->subv_total->ViewValue = ew_FormatCurrency($expresspayment->subv_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->subv_total->ViewCustomAttributes = "";

			// subv_detail
			$expresspayment->subv_detail->ViewValue = $expresspayment->subv_detail->CurrentValue;
			$expresspayment->subv_detail->ViewCustomAttributes = "";

			// adv_total
			$expresspayment->adv_total->ViewValue = $expresspayment->adv_total->CurrentValue;
			$expresspayment->adv_total->ViewValue = ew_FormatCurrency($expresspayment->adv_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->adv_total->ViewCustomAttributes = "";

			// adv_detail
			$expresspayment->adv_detail->ViewValue = $expresspayment->adv_detail->CurrentValue;
			$expresspayment->adv_detail->ViewCustomAttributes = "";

// rc_total
			$expresspayment->rc_total->ViewValue = $expresspayment->rc_total->CurrentValue;
			$expresspayment->rc_total->ViewCustomAttributes = "";

			// rc_detail
			$expresspayment->rc_detail->ViewValue = $expresspayment->rc_detail->CurrentValue;
			$expresspayment->rc_detail->ViewCustomAttributes = "";

			// annual_total
			$expresspayment->annual_total->ViewValue = $expresspayment->annual_total->CurrentValue;
			$expresspayment->annual_total->ViewValue = ew_FormatCurrency($expresspayment->annual_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->annual_total->ViewCustomAttributes = "";

			// annual_detail
			$expresspayment->annual_detail->ViewValue = $expresspayment->annual_detail->CurrentValue;
			$expresspayment->annual_detail->ViewCustomAttributes = "";

			// regis_total
			$expresspayment->regis_total->ViewValue = $expresspayment->regis_total->CurrentValue;
			$expresspayment->regis_total->ViewValue = ew_FormatCurrency($expresspayment->regis_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->regis_total->ViewCustomAttributes = "";

			// regis_detail
			$expresspayment->regis_detail->ViewValue = $expresspayment->regis_detail->CurrentValue;
			$expresspayment->regis_detail->ViewCustomAttributes = "";

			// other_total
			$expresspayment->other_total->ViewValue = $expresspayment->other_total->CurrentValue;
			$expresspayment->other_total->ViewValue = ew_FormatCurrency($expresspayment->other_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->other_total->ViewCustomAttributes = "";

			// other_detail
			$expresspayment->other_detail->ViewValue = $expresspayment->other_detail->CurrentValue;
			$expresspayment->other_detail->ViewCustomAttributes = "";

			// expr_total
			$expresspayment->expr_total->ViewValue = $expresspayment->expr_total->CurrentValue;
			$expresspayment->expr_total->ViewValue = ew_FormatCurrency($expresspayment->expr_total->ViewValue, 0, -2, -2, -2);
			$expresspayment->expr_total->ViewCustomAttributes = "";

			// expr_note
			$expresspayment->expr_note->ViewValue = $expresspayment->expr_note->CurrentValue;
			$expresspayment->expr_note->ViewCustomAttributes = "";

			// expr_pay_date
			$expresspayment->expr_pay_date->ViewValue = $expresspayment->expr_pay_date->CurrentValue;
			$expresspayment->expr_pay_date->ViewValue = ew_FormatDateTime($expresspayment->expr_pay_date->ViewValue, 7);
			$expresspayment->expr_pay_date->ViewCustomAttributes = "";

			// expr_slipt_num
			$expresspayment->expr_slipt_num->ViewValue = $expresspayment->expr_slipt_num->CurrentValue;
			$expresspayment->expr_slipt_num->ViewCustomAttributes = "";

			// t_code
			$expresspayment->t_code->LinkCustomAttributes = "";
			$expresspayment->t_code->HrefValue = "";
			$expresspayment->t_code->TooltipValue = "";

			// village_id
			$expresspayment->village_id->LinkCustomAttributes = "";
			$expresspayment->village_id->HrefValue = "";
			$expresspayment->village_id->TooltipValue = "";

			// subv_total
			$expresspayment->subv_total->LinkCustomAttributes = "";
			$expresspayment->subv_total->HrefValue = "";
			$expresspayment->subv_total->TooltipValue = "";

			// subv_detail
			$expresspayment->subv_detail->LinkCustomAttributes = "";
			$expresspayment->subv_detail->HrefValue = "";
			$expresspayment->subv_detail->TooltipValue = "";

			// adv_total
			$expresspayment->adv_total->LinkCustomAttributes = "";
			$expresspayment->adv_total->HrefValue = "";
			$expresspayment->adv_total->TooltipValue = "";

			// adv_detail
			$expresspayment->adv_detail->LinkCustomAttributes = "";
			$expresspayment->adv_detail->HrefValue = "";
			$expresspayment->adv_detail->TooltipValue = "";

// rc_total
			$expresspayment->rc_total->LinkCustomAttributes = "";
			$expresspayment->rc_total->HrefValue = "";
			$expresspayment->rc_total->TooltipValue = "";

			// rc_detail
			$expresspayment->rc_detail->LinkCustomAttributes = "";
			$expresspayment->rc_detail->HrefValue = "";
			$expresspayment->rc_detail->TooltipValue = "";
			// annual_total
			$expresspayment->annual_total->LinkCustomAttributes = "";
			$expresspayment->annual_total->HrefValue = "";
			$expresspayment->annual_total->TooltipValue = "";

			// annual_detail
			$expresspayment->annual_detail->LinkCustomAttributes = "";
			$expresspayment->annual_detail->HrefValue = "";
			$expresspayment->annual_detail->TooltipValue = "";

			// regis_total
			$expresspayment->regis_total->LinkCustomAttributes = "";
			$expresspayment->regis_total->HrefValue = "";
			$expresspayment->regis_total->TooltipValue = "";

			// regis_detail
			$expresspayment->regis_detail->LinkCustomAttributes = "";
			$expresspayment->regis_detail->HrefValue = "";
			$expresspayment->regis_detail->TooltipValue = "";

			// other_total
			$expresspayment->other_total->LinkCustomAttributes = "";
			$expresspayment->other_total->HrefValue = "";
			$expresspayment->other_total->TooltipValue = "";

			// other_detail
			$expresspayment->other_detail->LinkCustomAttributes = "";
			$expresspayment->other_detail->HrefValue = "";
			$expresspayment->other_detail->TooltipValue = "";

			// expr_total
			$expresspayment->expr_total->LinkCustomAttributes = "";
			$expresspayment->expr_total->HrefValue = "";
			$expresspayment->expr_total->TooltipValue = "";

			// expr_note
			$expresspayment->expr_note->LinkCustomAttributes = "";
			$expresspayment->expr_note->HrefValue = "";
			$expresspayment->expr_note->TooltipValue = "";

			// expr_pay_date
			$expresspayment->expr_pay_date->LinkCustomAttributes = "";
			$expresspayment->expr_pay_date->HrefValue = "";
			$expresspayment->expr_pay_date->TooltipValue = "";

			// expr_slipt_num
			$expresspayment->expr_slipt_num->LinkCustomAttributes = "";
			$expresspayment->expr_slipt_num->HrefValue = "";
			$expresspayment->expr_slipt_num->TooltipValue = "";
		} elseif ($expresspayment->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// t_code
			$expresspayment->t_code->EditCustomAttributes = "";
			if (trim(strval($expresspayment->t_code->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($expresspayment->t_code->CurrentValue) . "'";
			}
			$sSqlWrk = "SELECT `t_code`, `t_code` AS `DispFld`, `t_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$expresspayment->t_code->EditValue = $arwrk;

			// village_id
			$expresspayment->village_id->EditCustomAttributes = "";
			if (trim(strval($expresspayment->village_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($expresspayment->village_id->CurrentValue) . "";
			}
			$sSqlWrk = "SELECT `village_id`, `v_code` AS `DispFld`, `v_title` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `t_code` AS `SelectFilterFld` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), "", ""));
			$expresspayment->village_id->EditValue = $arwrk;

			// subv_total
			$expresspayment->subv_total->EditCustomAttributes = "";
			$expresspayment->subv_total->EditValue = ew_HtmlEncode($expresspayment->subv_total->CurrentValue);

			// subv_detail
			$expresspayment->subv_detail->EditCustomAttributes = "";
			$expresspayment->subv_detail->EditValue = ew_HtmlEncode($expresspayment->subv_detail->CurrentValue);

			// adv_total
			$expresspayment->adv_total->EditCustomAttributes = "";
			$expresspayment->adv_total->EditValue = ew_HtmlEncode($expresspayment->adv_total->CurrentValue);

			// adv_detail
			$expresspayment->adv_detail->EditCustomAttributes = "";
			$expresspayment->adv_detail->EditValue = ew_HtmlEncode($expresspayment->adv_detail->CurrentValue);

	// rc_total
			$expresspayment->rc_total->EditCustomAttributes = "";
			$expresspayment->rc_total->EditValue = ew_HtmlEncode($expresspayment->rc_total->CurrentValue);

			// rc_detail
			$expresspayment->rc_detail->EditCustomAttributes = "";
			$expresspayment->rc_detail->EditValue = ew_HtmlEncode($expresspayment->rc_detail->CurrentValue);
			// annual_total
			$expresspayment->annual_total->EditCustomAttributes = "";
			$expresspayment->annual_total->EditValue = ew_HtmlEncode($expresspayment->annual_total->CurrentValue);

			// annual_detail
			$expresspayment->annual_detail->EditCustomAttributes = "";
			$expresspayment->annual_detail->EditValue = ew_HtmlEncode($expresspayment->annual_detail->CurrentValue);

			// regis_total
			$expresspayment->regis_total->EditCustomAttributes = "";
			$expresspayment->regis_total->EditValue = ew_HtmlEncode($expresspayment->regis_total->CurrentValue);

			// regis_detail
			$expresspayment->regis_detail->EditCustomAttributes = "";
			$expresspayment->regis_detail->EditValue = ew_HtmlEncode($expresspayment->regis_detail->CurrentValue);

			// other_total
			$expresspayment->other_total->EditCustomAttributes = "";
			$expresspayment->other_total->EditValue = ew_HtmlEncode($expresspayment->other_total->CurrentValue);

			// other_detail
			$expresspayment->other_detail->EditCustomAttributes = "";
			$expresspayment->other_detail->EditValue = ew_HtmlEncode($expresspayment->other_detail->CurrentValue);

			// expr_total
			$expresspayment->expr_total->EditCustomAttributes = "";
			$expresspayment->expr_total->EditValue = $expresspayment->expr_total->CurrentValue;
			$expresspayment->expr_total->EditValue = ew_FormatCurrency($expresspayment->expr_total->EditValue, 0, -2, -2, -2);
			$expresspayment->expr_total->ViewCustomAttributes = "";

			// expr_note
			$expresspayment->expr_note->EditCustomAttributes = "";
			$expresspayment->expr_note->EditValue = ew_HtmlEncode($expresspayment->expr_note->CurrentValue);

			// expr_pay_date
			$expresspayment->expr_pay_date->EditCustomAttributes = "";
			$expresspayment->expr_pay_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($expresspayment->expr_pay_date->CurrentValue, 7));

			// expr_slipt_num
			$expresspayment->expr_slipt_num->EditCustomAttributes = "";
			$expresspayment->expr_slipt_num->EditValue = $expresspayment->expr_slipt_num->CurrentValue;
			$expresspayment->expr_slipt_num->ViewCustomAttributes = "";

			// Edit refer script
			// t_code

			$expresspayment->t_code->HrefValue = "";

			// village_id
			$expresspayment->village_id->HrefValue = "";

			// subv_total
			$expresspayment->subv_total->HrefValue = "";

			// subv_detail
			$expresspayment->subv_detail->HrefValue = "";

			// adv_total
			$expresspayment->adv_total->HrefValue = "";

			// adv_detail
			$expresspayment->adv_detail->HrefValue = "";

// rc_total
			$expresspayment->rc_total->HrefValue = "";

			// rc_detail
			$expresspayment->rc_detail->HrefValue = "";
			// annual_total
			$expresspayment->annual_total->HrefValue = "";

			// annual_detail
			$expresspayment->annual_detail->HrefValue = "";

			// regis_total
			$expresspayment->regis_total->HrefValue = "";

			// regis_detail
			$expresspayment->regis_detail->HrefValue = "";

			// other_total
			$expresspayment->other_total->HrefValue = "";

			// other_detail
			$expresspayment->other_detail->HrefValue = "";

			// expr_total
			$expresspayment->expr_total->HrefValue = "";

			// expr_note
			$expresspayment->expr_note->HrefValue = "";

			// expr_pay_date
			$expresspayment->expr_pay_date->HrefValue = "";

			// expr_slipt_num
			$expresspayment->expr_slipt_num->HrefValue = "";
		}
		if ($expresspayment->RowType == EW_ROWTYPE_ADD ||
			$expresspayment->RowType == EW_ROWTYPE_EDIT ||
			$expresspayment->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$expresspayment->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($expresspayment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expresspayment->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $expresspayment;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($expresspayment->t_code->FormValue) && $expresspayment->t_code->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expresspayment->t_code->FldCaption());
		}
		if (!is_null($expresspayment->village_id->FormValue) && $expresspayment->village_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expresspayment->village_id->FldCaption());
		}
		if (!ew_CheckNumber($expresspayment->subv_total->FormValue)) {
			ew_AddMessage($gsFormError, $expresspayment->subv_total->FldErrMsg());
		}
		if (!ew_CheckNumber($expresspayment->adv_total->FormValue)) {
			ew_AddMessage($gsFormError, $expresspayment->adv_total->FldErrMsg());
		}

		if (!ew_CheckNumber($expresspayment->rc_total->FormValue)) {
			ew_AddMessage($gsFormError, $expresspayment->rc_total->FldErrMsg());
		}

		if (!ew_CheckNumber($expresspayment->annual_total->FormValue)) {
			ew_AddMessage($gsFormError, $expresspayment->annual_total->FldErrMsg());
		}
		if (!ew_CheckNumber($expresspayment->regis_total->FormValue)) {
			ew_AddMessage($gsFormError, $expresspayment->regis_total->FldErrMsg());
		}
		if (!ew_CheckNumber($expresspayment->other_total->FormValue)) {
			ew_AddMessage($gsFormError, $expresspayment->other_total->FldErrMsg());
		}
		if (!is_null($expresspayment->expr_pay_date->FormValue) && $expresspayment->expr_pay_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expresspayment->expr_pay_date->FldCaption());
		}
		if (!ew_CheckEuroDate($expresspayment->expr_pay_date->FormValue)) {
			ew_AddMessage($gsFormError, $expresspayment->expr_pay_date->FldErrMsg());
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
		global $conn, $Security, $Language, $expresspayment;
		$sFilter = $expresspayment->KeyFilter();
		$expresspayment->CurrentFilter = $sFilter;
		$sSql = $expresspayment->SQL();
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

			// t_code
			$expresspayment->t_code->SetDbValueDef($rsnew, $expresspayment->t_code->CurrentValue, "", $expresspayment->t_code->ReadOnly);

			// village_id
			$expresspayment->village_id->SetDbValueDef($rsnew, $expresspayment->village_id->CurrentValue, 0, $expresspayment->village_id->ReadOnly);

			// subv_total
			$expresspayment->subv_total->SetDbValueDef($rsnew, $expresspayment->subv_total->CurrentValue, 0, $expresspayment->subv_total->ReadOnly);

			// subv_detail
			$expresspayment->subv_detail->SetDbValueDef($rsnew, $expresspayment->subv_detail->CurrentValue, NULL, $expresspayment->subv_detail->ReadOnly);

			// adv_total
			$expresspayment->adv_total->SetDbValueDef($rsnew, $expresspayment->adv_total->CurrentValue, 0, $expresspayment->adv_total->ReadOnly);

			// adv_detail
			$expresspayment->adv_detail->SetDbValueDef($rsnew, $expresspayment->adv_detail->CurrentValue, NULL, $expresspayment->adv_detail->ReadOnly);

			// rc_total
			$expresspayment->rc_total->SetDbValueDef($rsnew, $expresspayment->rc_total->CurrentValue, 0, $expresspayment->rc_total->ReadOnly);

			// rc_detail
			$expresspayment->rc_detail->SetDbValueDef($rsnew, $expresspayment->rc_detail->CurrentValue, "", $expresspayment->rc_detail->ReadOnly);

			// annual_total
			$expresspayment->annual_total->SetDbValueDef($rsnew, $expresspayment->annual_total->CurrentValue, 0, $expresspayment->annual_total->ReadOnly);

			// annual_detail
			$expresspayment->annual_detail->SetDbValueDef($rsnew, $expresspayment->annual_detail->CurrentValue, NULL, $expresspayment->annual_detail->ReadOnly);

			// regis_total
			$expresspayment->regis_total->SetDbValueDef($rsnew, $expresspayment->regis_total->CurrentValue, 0, $expresspayment->regis_total->ReadOnly);

			// regis_detail
			$expresspayment->regis_detail->SetDbValueDef($rsnew, $expresspayment->regis_detail->CurrentValue, NULL, $expresspayment->regis_detail->ReadOnly);

			// other_total
			$expresspayment->other_total->SetDbValueDef($rsnew, $expresspayment->other_total->CurrentValue, 0, $expresspayment->other_total->ReadOnly);

			// other_detail
			$expresspayment->other_detail->SetDbValueDef($rsnew, $expresspayment->other_detail->CurrentValue, NULL, $expresspayment->other_detail->ReadOnly);

			// expr_note
			$expresspayment->expr_note->SetDbValueDef($rsnew, $expresspayment->expr_note->CurrentValue, NULL, $expresspayment->expr_note->ReadOnly);

			// expr_pay_date
			$expresspayment->expr_pay_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($expresspayment->expr_pay_date->CurrentValue, 7), ew_CurrentDate(), $expresspayment->expr_pay_date->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $expresspayment->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($expresspayment->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($expresspayment->CancelMessage <> "") {
					$this->setFailureMessage($expresspayment->CancelMessage);
					$expresspayment->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$expresspayment->Row_Updated($rsold, $rsnew);
		$rs->Close();
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
