<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "paymentloginfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$paymentlog_add = new cpaymentlog_add();
$Page =& $paymentlog_add;

// Page init
$paymentlog_add->Page_Init();

// Page main
$paymentlog_add->Page_Main();
?>
<?php include_once "header.php";
$setting = getSetting();
?>
<script type="text/javascript">
<!--

// Create page object
var paymentlog_add = new ew_Page("paymentlog_add");

// page properties
paymentlog_add.PageID = "add"; // page ID
paymentlog_add.FormID = "fpaymentlogadd"; // form ID
var EW_PAGE_ID = paymentlog_add.PageID; // for backward compatibility

// extend page with ValidateForm function
paymentlog_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_pay_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentlog->pay_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pay_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($paymentlog->pay_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_t_code"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentlog->t_code->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_village_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentlog->village_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pay_type"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentlog->pay_type->FldCaption()) ?>");
		
	/*	elm = fobj.elements["x" + infix + "_pay_detail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentlog->pay_detail->FldCaption()) ?>"); */
		elm = fobj.elements["x" + infix + "_pay_detail"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($paymentlog->pay_detail->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_count_member"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentlog->count_member->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_count_member"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($paymentlog->count_member->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_pay_rate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentlog->pay_rate->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pay_rate"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($paymentlog->pay_rate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_sub_total"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentlog->sub_total->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_sub_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($paymentlog->sub_total->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_assc_rate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentlog->assc_rate->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_assc_rate"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($paymentlog->assc_rate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_assc_total"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentlog->assc_total->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_assc_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($paymentlog->assc_total->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_grand_total"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentlog->grand_total->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_grand_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($paymentlog->grand_total->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_pml_slipt_num"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentlog->pml_slipt_num->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pml_slipt_num"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($paymentlog->pml_slipt_num->FldErrMsg()) ?>");

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
paymentlog_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
paymentlog_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
paymentlog_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
paymentlog_add.ValidateRequired = false; // no JavaScript validation
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

function getinfo(village){
	
	if(village) {
	
		getDataReturnText('getinfo.php?village_id='+village+'&type=1',displayMemberTotal);
		
		
	}

}
function getunitrate(paytype){
	
	
	getDataReturnText('getinfo.php?paytype='+paytype+'&type=2',displayUnitRate);
	getDataReturnText('getinfo.php?paytype='+paytype+'&type=3',displayAsscRate);
	
	
}

function getsubtotal(){
	
	member = document.getElementById("x_count_member").value;
	rate = document.getElementById("x_pay_rate").value;
	document.getElementById("x_sub_total").value = (member*rate);
	
}

function getassctotal(){
	
	subtotal = document.getElementById("x_sub_total").value;
	rate = document.getElementById("x_assc_rate").value;
	
	document.getElementById("x_assc_total").value = Math.floor(((subtotal*rate)/100));
	
	
}

function getgrandtotal(){
	
	subtotal = document.getElementById("x_sub_total").value;
	assctotal = document.getElementById("x_assc_total").value;
	document.getElementById("x_grand_total").value = Math.ceil(subtotal - assctotal);
}

function displayMemberTotal(text){
     
	document.getElementById("x_count_member").value = text;
	recal();

}

function displayUnitRate(text){
     
	document.getElementById("x_pay_rate").value = text;
	recal();

}

function displayAsscRate(text){
     
	document.getElementById("x_assc_rate").value = text;
	recal();

}

function recal(){
	
	getsubtotal();
	getassctotal();
	getgrandtotal()
	
}

function fblur(obj){
	if(obj.value == '') obj.value = '0';
	else return false;
}
// Write your client script here, no need to add script tags.
//-->

</script>
<div class="phpmaker ewTitle"><img src="images/ico_paid.png" width="40" height="40" align="absmiddle" /> <?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $paymentlog->TableCaption() ?></div>
<div class="clear"></div>
<?php $paymentlog_add->ShowPageHeader(); ?>
<?php
$paymentlog_add->ShowMessage();
?>
<form name="fpaymentlogadd" id="fpaymentlogadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return paymentlog_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="paymentlog">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($paymentlog->pay_date->Visible) { // pay_date ?>
	<tr id="r_pay_date"<?php echo $paymentlog->RowAttributes() ?>>
		<td width="150" class="ewTableHeader"><?php echo $paymentlog->pay_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $paymentlog->pay_date->CellAttributes() ?>><span id="el_pay_date">
<input type="text" name="x_pay_date" id="x_pay_date" value="<?php echo date('d/m/Y')?>"<?php echo $paymentlog->pay_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_pay_date" name="cal_x_pay_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_pay_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_pay_date" // button id
});
</script>
</span><?php echo $paymentlog->pay_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->t_code->Visible) { // t_code ?>
	<tr id="r_t_code"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->t_code->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $paymentlog->t_code->CellAttributes() ?>><span id="el_t_code">
<?php $paymentlog->t_code->EditAttrs["onchange"] = "ew_UpdateOpt('x_village_id','x_t_code',true); " . @$paymentlog->t_code->EditAttrs["onchange"]; ?>
<select id="x_t_code" name="x_t_code"<?php echo $paymentlog->t_code->EditAttributes() ?>>
<?php
if (is_array($paymentlog->t_code->EditValue)) {
	$arwrk = $paymentlog->t_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentlog->t_code->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$paymentlog->t_code) ?><?php echo $arwrk[$rowcntwrk][2] ?>
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
</span><?php echo $paymentlog->t_code->CustomMsg ?> &nbsp;<?php echo $paymentlog->village_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?><span id="el_village_id">
<select id="x_village_id" name="x_village_id"<?php echo $paymentlog->village_id->EditAttributes() ?> onchange="getinfo(options[selectedIndex].value);">
<?php
if (is_array($paymentlog->village_id->EditValue)) {
	$arwrk = $paymentlog->village_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentlog->village_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$paymentlog->village_id) ?><?php echo $arwrk[$rowcntwrk][2] ?>
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
</span><?php echo $paymentlog->village_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->village_id->Visible) { // village_id ?>
	<?php } ?>
<?php if ($paymentlog->pay_type->Visible) { // pay_type ?>
	<tr id="r_pay_type"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->pay_type->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $paymentlog->pay_type->CellAttributes() ?>><span id="el_pay_type">
<select id="x_pay_type" name="x_pay_type"<?php echo $paymentlog->pay_type->EditAttributes() ?> onchange="getunitrate(options[selectedIndex].value);" style="font-size:18px; border: solid 1px #ccc;">
<?php
if (is_array($paymentlog->pay_type->EditValue)) {
	$arwrk = $paymentlog->pay_type->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($paymentlog->pay_type->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php
$sSqlWrk = "SELECT `pt_id`, `pt_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `paymenttype`";
$sWhereWrk = "";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
$sSqlWrk .= " ORDER BY `pt_order`";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_pay_type" id="s_x_pay_type" value="<?php echo $sSqlWrk; ?>">
<input type="hidden" name="lft_x_pay_type" id="lft_x_pay_type" value="">
</span><?php echo $paymentlog->pay_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->pay_detail->Visible) { // pay_detail ?>
	<tr id="r_pay_detail"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->pay_detail->FldCaption() ?></td>
		<td<?php echo $paymentlog->pay_detail->CellAttributes() ?>><span id="el_pay_detail">
<input type="text" name="x_pay_detail" id="x_pay_detail" size="5"<?php echo $paymentlog->pay_detail->EditAttributes() ?> style="font-size:20px; border: solid 1px #999;">
</span><?php echo $paymentlog->pay_detail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->count_member->Visible) { // count_member ?>
	<tr id="r_count_member"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->count_member->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $paymentlog->count_member->CellAttributes() ?>><span id="el_count_member">
<input type="text" name="x_count_member" id="x_count_member" size="10" value="0" onchange="recal();" style="font-size:22px; border: solid 1px #999;">
</span><?php echo $paymentlog->count_member->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->pay_rate->Visible) { // pay_rate ?>
	<tr id="r_pay_rate"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->pay_rate->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $paymentlog->pay_rate->CellAttributes() ?>><span id="el_pay_rate">
<input type="text" name="x_pay_rate" id="x_pay_rate" size="20" value="0" onchange="recal()" style="font-size:22px; border: solid 1px #999;" >
</span><?php echo $paymentlog->pay_rate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->sub_total->Visible) { // sub_total ?>
	<tr id="r_sub_total"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->sub_total->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $paymentlog->sub_total->CellAttributes() ?>><span id="el_sub_total">
<input type="text" name="x_sub_total" id="x_sub_total" size="20" value="0"<?php echo $paymentlog->sub_total->EditAttributes() ?> style="font-size:22px; border: solid 1px #999;">
</span><?php echo $paymentlog->sub_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->assc_rate->Visible) { // assc_rate ?>
	<tr id="r_assc_rate"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->assc_rate->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $paymentlog->assc_rate->CellAttributes() ?>><span id="el_assc_rate">
<input type="text" name="x_assc_rate" id="x_assc_rate" size="3" value="0" onchange="recal()" style="font-size:22px; border: solid 1px #999;">
</span>%<?php echo $paymentlog->assc_rate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->assc_total->Visible) { // assc_total ?>
	<tr id="r_assc_total"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->assc_total->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $paymentlog->assc_total->CellAttributes() ?>><span id="el_assc_total">
<input type="text" name="x_assc_total" id="x_assc_total" size="20" value="0"<?php echo $paymentlog->assc_total->EditAttributes() ?> style="font-size:22px; border: solid 1px #999;">
</span><?php echo $paymentlog->assc_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->grand_total->Visible) { // grand_total ?>
	<tr id="r_grand_total"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->grand_total->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $paymentlog->grand_total->CellAttributes() ?>><span id="el_grand_total">
<input type="text" name="x_grand_total" id="x_grand_total" size="20" value="0"<?php echo $paymentlog->grand_total->EditAttributes() ?> style="font-size:22px; border: solid 1px #999;">
</span><?php echo $paymentlog->grand_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->pay_note->Visible) { // pay_note ?>
	<tr id="r_pay_note"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->pay_note->FldCaption() ?></td>
		<td<?php echo $paymentlog->pay_note->CellAttributes() ?>><span id="el_pay_note">
<textarea name="x_pay_note" id="x_pay_note" cols="55" rows="4"<?php echo $paymentlog->pay_note->EditAttributes() ?>><?php echo $paymentlog->pay_note->EditValue ?></textarea>
</span><?php echo $paymentlog->pay_note->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentlog->pml_slipt_num->Visible) { // pml_slipt_num ?>
	<tr id="r_pml_slipt_num"<?php echo $paymentlog->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentlog->pml_slipt_num->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $paymentlog->pml_slipt_num->CellAttributes() ?>><span id="el_pml_slipt_num">
<input type="text" name="x_pml_slipt_num" id="x_pml_slipt_num" size="30" value="<?php echo getPayLogSliptNumber();?>"<?php echo $paymentlog->pml_slipt_num->EditAttributes() ?>>
</span><?php echo $paymentlog->pml_slipt_num->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_village_id','x_t_code',false],
['x_t_code','x_t_code',false],
['x_pay_type','x_pay_type',false]]);

//-->
</script>
<?php
$paymentlog_add->ShowPageFooter();
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
$paymentlog_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cpaymentlog_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'paymentlog';

	// Page object name
	var $PageObjName = 'paymentlog_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $paymentlog;
		if ($paymentlog->UseTokenInUrl) $PageUrl .= "t=" . $paymentlog->TableVar . "&"; // Add page token
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
		global $objForm, $paymentlog;
		if ($paymentlog->UseTokenInUrl) {
			if ($objForm)
				return ($paymentlog->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($paymentlog->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpaymentlog_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (paymentlog)
		if (!isset($GLOBALS["paymentlog"])) {
			$GLOBALS["paymentlog"] = new cpaymentlog();
			$GLOBALS["Table"] =& $GLOBALS["paymentlog"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'paymentlog', TRUE);

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
		global $paymentlog;

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $paymentlog;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$paymentlog->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$paymentlog->CurrentAction = "I"; // Form error, reset action
				$paymentlog->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["pml_id"] != "") {
				$paymentlog->pml_id->setQueryStringValue($_GET["pml_id"]);
				$paymentlog->setKey("pml_id", $paymentlog->pml_id->CurrentValue); // Set up key
			} else {
				$paymentlog->setKey("pml_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$paymentlog->CurrentAction = "C"; // Copy record
			} else {
				$paymentlog->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($paymentlog->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("paymentloglist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$paymentlog->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $paymentlog->ViewUrl();
					if (ew_GetPageName($sReturnUrl) == "paymentlogview.php")
						$sReturnUrl = $paymentlog->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$paymentlog->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$paymentlog->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$paymentlog->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $paymentlog;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $paymentlog;
		$paymentlog->pay_date->CurrentValue = NULL;
		$paymentlog->pay_date->OldValue = $paymentlog->pay_date->CurrentValue;
		$paymentlog->t_code->CurrentValue = NULL;
		$paymentlog->t_code->OldValue = $paymentlog->t_code->CurrentValue;
		$paymentlog->village_id->CurrentValue = NULL;
		$paymentlog->village_id->OldValue = $paymentlog->village_id->CurrentValue;
		$paymentlog->pay_type->CurrentValue = NULL;
		$paymentlog->pay_type->OldValue = $paymentlog->pay_type->CurrentValue;
		$paymentlog->pay_detail->CurrentValue = NULL;
		$paymentlog->pay_detail->OldValue = $paymentlog->pay_detail->CurrentValue;
		$paymentlog->count_member->CurrentValue = NULL;
		$paymentlog->count_member->OldValue = $paymentlog->count_member->CurrentValue;
		$paymentlog->pay_rate->CurrentValue = NULL;
		$paymentlog->pay_rate->OldValue = $paymentlog->pay_rate->CurrentValue;
		$paymentlog->sub_total->CurrentValue = NULL;
		$paymentlog->sub_total->OldValue = $paymentlog->sub_total->CurrentValue;
		$paymentlog->assc_rate->CurrentValue = NULL;
		$paymentlog->assc_rate->OldValue = $paymentlog->assc_rate->CurrentValue;
		$paymentlog->assc_total->CurrentValue = NULL;
		$paymentlog->assc_total->OldValue = $paymentlog->assc_total->CurrentValue;
		$paymentlog->grand_total->CurrentValue = NULL;
		$paymentlog->grand_total->OldValue = $paymentlog->grand_total->CurrentValue;
		$paymentlog->pay_note->CurrentValue = NULL;
		$paymentlog->pay_note->OldValue = $paymentlog->pay_note->CurrentValue;
		$paymentlog->pml_slipt_num->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $paymentlog;
		if (!$paymentlog->pay_date->FldIsDetailKey) {
			$paymentlog->pay_date->setFormValue($objForm->GetValue("x_pay_date"));
			$paymentlog->pay_date->CurrentValue = ew_UnFormatDateTime($paymentlog->pay_date->CurrentValue, 7);
		}
		if (!$paymentlog->t_code->FldIsDetailKey) {
			$paymentlog->t_code->setFormValue($objForm->GetValue("x_t_code"));
		}
		if (!$paymentlog->village_id->FldIsDetailKey) {
			$paymentlog->village_id->setFormValue($objForm->GetValue("x_village_id"));
		}
		if (!$paymentlog->pay_type->FldIsDetailKey) {
			$paymentlog->pay_type->setFormValue($objForm->GetValue("x_pay_type"));
		}
		if (!$paymentlog->pay_detail->FldIsDetailKey) {
			$paymentlog->pay_detail->setFormValue($objForm->GetValue("x_pay_detail"));
		}
		if (!$paymentlog->count_member->FldIsDetailKey) {
			$paymentlog->count_member->setFormValue($objForm->GetValue("x_count_member"));
		}
		if (!$paymentlog->pay_rate->FldIsDetailKey) {
			$paymentlog->pay_rate->setFormValue($objForm->GetValue("x_pay_rate"));
		}
		if (!$paymentlog->sub_total->FldIsDetailKey) {
			$paymentlog->sub_total->setFormValue($objForm->GetValue("x_sub_total"));
		}
		if (!$paymentlog->assc_rate->FldIsDetailKey) {
			$paymentlog->assc_rate->setFormValue($objForm->GetValue("x_assc_rate"));
		}
		if (!$paymentlog->assc_total->FldIsDetailKey) {
			$paymentlog->assc_total->setFormValue($objForm->GetValue("x_assc_total"));
		}
		if (!$paymentlog->grand_total->FldIsDetailKey) {
			$paymentlog->grand_total->setFormValue($objForm->GetValue("x_grand_total"));
		}
		if (!$paymentlog->pay_note->FldIsDetailKey) {
			$paymentlog->pay_note->setFormValue($objForm->GetValue("x_pay_note"));
		}
		if (!$paymentlog->pml_slipt_num->FldIsDetailKey) {
			$paymentlog->pml_slipt_num->setFormValue($objForm->GetValue("x_pml_slipt_num"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $paymentlog;
		$this->LoadOldRecord();
		$paymentlog->pay_date->CurrentValue = $paymentlog->pay_date->FormValue;
		$paymentlog->pay_date->CurrentValue = ew_UnFormatDateTime($paymentlog->pay_date->CurrentValue, 7);
		$paymentlog->t_code->CurrentValue = $paymentlog->t_code->FormValue;
		$paymentlog->village_id->CurrentValue = $paymentlog->village_id->FormValue;
		$paymentlog->pay_type->CurrentValue = $paymentlog->pay_type->FormValue;
		$paymentlog->pay_detail->CurrentValue = $paymentlog->pay_detail->FormValue;
		$paymentlog->count_member->CurrentValue = $paymentlog->count_member->FormValue;
		$paymentlog->pay_rate->CurrentValue = $paymentlog->pay_rate->FormValue;
		$paymentlog->sub_total->CurrentValue = $paymentlog->sub_total->FormValue;
		$paymentlog->assc_rate->CurrentValue = $paymentlog->assc_rate->FormValue;
		$paymentlog->assc_total->CurrentValue = $paymentlog->assc_total->FormValue;
		$paymentlog->grand_total->CurrentValue = $paymentlog->grand_total->FormValue;
		$paymentlog->pay_note->CurrentValue = $paymentlog->pay_note->FormValue;
		$paymentlog->pml_slipt_num->CurrentValue = $paymentlog->pml_slipt_num->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $paymentlog;
		$sFilter = $paymentlog->KeyFilter();

		// Call Row Selecting event
		$paymentlog->Row_Selecting($sFilter);

		// Load SQL based on filter
		$paymentlog->CurrentFilter = $sFilter;
		$sSql = $paymentlog->SQL();
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
		global $conn, $paymentlog;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$paymentlog->Row_Selected($row);
		$paymentlog->pml_id->setDbValue($rs->fields('pml_id'));
		$paymentlog->pay_date->setDbValue($rs->fields('pay_date'));
		$paymentlog->t_code->setDbValue($rs->fields('t_code'));
		$paymentlog->village_id->setDbValue($rs->fields('village_id'));
		$paymentlog->pay_type->setDbValue($rs->fields('pay_type'));
		$paymentlog->pay_detail->setDbValue($rs->fields('pay_detail'));
		$paymentlog->count_member->setDbValue($rs->fields('count_member'));
		$paymentlog->pay_rate->setDbValue($rs->fields('pay_rate'));
		$paymentlog->sub_total->setDbValue($rs->fields('sub_total'));
		$paymentlog->assc_rate->setDbValue($rs->fields('assc_rate'));
		$paymentlog->assc_total->setDbValue($rs->fields('assc_total'));
		$paymentlog->grand_total->setDbValue($rs->fields('grand_total'));
		$paymentlog->pay_note->setDbValue($rs->fields('pay_note'));
		$paymentlog->pml_slipt_num->setDbValue($rs->fields('pml_slipt_num'));
	}

	// Load old record
	function LoadOldRecord() {
		global $paymentlog;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($paymentlog->getKey("pml_id")) <> "")
			$paymentlog->pml_id->CurrentValue = $paymentlog->getKey("pml_id"); // pml_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$paymentlog->CurrentFilter = $paymentlog->KeyFilter();
			$sSql = $paymentlog->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $paymentlog;

		// Initialize URLs
		// Call Row_Rendering event

		$paymentlog->Row_Rendering();

		// Common render codes for all row types
		// pml_id
		// pay_date
		// t_code
		// village_id
		// pay_type
		// pay_detail
		// count_member
		// pay_rate
		// sub_total
		// assc_rate
		// assc_total
		// grand_total
		// pay_note
		// pml_slipt_num

		if ($paymentlog->RowType == EW_ROWTYPE_VIEW) { // View row

			// pay_date
			$paymentlog->pay_date->ViewValue = $paymentlog->pay_date->CurrentValue;
			$paymentlog->pay_date->ViewValue = ew_FormatDateTime($paymentlog->pay_date->ViewValue, 7);
			$paymentlog->pay_date->ViewCustomAttributes = "";

			// t_code
			if (strval($paymentlog->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($paymentlog->t_code->CurrentValue) . "'";
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
					$paymentlog->t_code->ViewValue = $rswrk->fields('t_code');
					$paymentlog->t_code->ViewValue .= ew_ValueSeparator(0,1,$paymentlog->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$paymentlog->t_code->ViewValue = $paymentlog->t_code->CurrentValue;
				}
			} else {
				$paymentlog->t_code->ViewValue = NULL;
			}
			$paymentlog->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($paymentlog->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($paymentlog->village_id->CurrentValue) . "";
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
					$paymentlog->village_id->ViewValue = $rswrk->fields('v_code');
					$paymentlog->village_id->ViewValue .= ew_ValueSeparator(0,1,$paymentlog->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$paymentlog->village_id->ViewValue = $paymentlog->village_id->CurrentValue;
				}
			} else {
				$paymentlog->village_id->ViewValue = NULL;
			}
			$paymentlog->village_id->ViewCustomAttributes = "";

			// pay_type
			if (strval($paymentlog->pay_type->CurrentValue) <> "") {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($paymentlog->pay_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `pt_order`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentlog->pay_type->ViewValue = $rswrk->fields('pt_title');
					$rswrk->Close();
				} else {
					$paymentlog->pay_type->ViewValue = $paymentlog->pay_type->CurrentValue;
				}
			} else {
				$paymentlog->pay_type->ViewValue = NULL;
			}
			$paymentlog->pay_type->ViewCustomAttributes = "";

			// pay_detail
			$paymentlog->pay_detail->ViewValue = $paymentlog->pay_detail->CurrentValue;
			$paymentlog->pay_detail->ViewCustomAttributes = "";

			// count_member
			$paymentlog->count_member->ViewValue = $paymentlog->count_member->CurrentValue;
			$paymentlog->count_member->ViewCustomAttributes = "";

			// pay_rate
			$paymentlog->pay_rate->ViewValue = $paymentlog->pay_rate->CurrentValue;
			$paymentlog->pay_rate->ViewCustomAttributes = "";

			// sub_total
			$paymentlog->sub_total->ViewValue = $paymentlog->sub_total->CurrentValue;
			$paymentlog->sub_total->ViewCustomAttributes = "";

			// assc_rate
			$paymentlog->assc_rate->ViewValue = $paymentlog->assc_rate->CurrentValue;
			$paymentlog->assc_rate->ViewCustomAttributes = "";

			// assc_total
			$paymentlog->assc_total->ViewValue = $paymentlog->assc_total->CurrentValue;
			$paymentlog->assc_total->ViewCustomAttributes = "";

			// grand_total
			$paymentlog->grand_total->ViewValue = $paymentlog->grand_total->CurrentValue;
			$paymentlog->grand_total->ViewCustomAttributes = "";

			// pay_note
			$paymentlog->pay_note->ViewValue = $paymentlog->pay_note->CurrentValue;
			$paymentlog->pay_note->ViewCustomAttributes = "";

			// pml_slipt_num
			$paymentlog->pml_slipt_num->ViewValue = $paymentlog->pml_slipt_num->CurrentValue;
			$paymentlog->pml_slipt_num->ViewCustomAttributes = "";

			// pay_date
			$paymentlog->pay_date->LinkCustomAttributes = "";
			$paymentlog->pay_date->HrefValue = "";
			$paymentlog->pay_date->TooltipValue = "";

			// t_code
			$paymentlog->t_code->LinkCustomAttributes = "";
			$paymentlog->t_code->HrefValue = "";
			$paymentlog->t_code->TooltipValue = "";

			// village_id
			$paymentlog->village_id->LinkCustomAttributes = "";
			$paymentlog->village_id->HrefValue = "";
			$paymentlog->village_id->TooltipValue = "";

			// pay_type
			$paymentlog->pay_type->LinkCustomAttributes = "";
			$paymentlog->pay_type->HrefValue = "";
			$paymentlog->pay_type->TooltipValue = "";

			// pay_detail
			$paymentlog->pay_detail->LinkCustomAttributes = "";
			$paymentlog->pay_detail->HrefValue = "";
			$paymentlog->pay_detail->TooltipValue = "";

			// count_member
			$paymentlog->count_member->LinkCustomAttributes = "";
			$paymentlog->count_member->HrefValue = "";
			$paymentlog->count_member->TooltipValue = "";

			// pay_rate
			$paymentlog->pay_rate->LinkCustomAttributes = "";
			$paymentlog->pay_rate->HrefValue = "";
			$paymentlog->pay_rate->TooltipValue = "";

			// sub_total
			$paymentlog->sub_total->LinkCustomAttributes = "";
			$paymentlog->sub_total->HrefValue = "";
			$paymentlog->sub_total->TooltipValue = "";

			// assc_rate
			$paymentlog->assc_rate->LinkCustomAttributes = "";
			$paymentlog->assc_rate->HrefValue = "";
			$paymentlog->assc_rate->TooltipValue = "";

			// assc_total
			$paymentlog->assc_total->LinkCustomAttributes = "";
			$paymentlog->assc_total->HrefValue = "";
			$paymentlog->assc_total->TooltipValue = "";

			// grand_total
			$paymentlog->grand_total->LinkCustomAttributes = "";
			$paymentlog->grand_total->HrefValue = "";
			$paymentlog->grand_total->TooltipValue = "";

			// pay_note
			$paymentlog->pay_note->LinkCustomAttributes = "";
			$paymentlog->pay_note->HrefValue = "";
			$paymentlog->pay_note->TooltipValue = "";

			// pml_slipt_num
			$paymentlog->pml_slipt_num->LinkCustomAttributes = "";
			$paymentlog->pml_slipt_num->HrefValue = "";
			$paymentlog->pml_slipt_num->TooltipValue = "";
		} elseif ($paymentlog->RowType == EW_ROWTYPE_ADD) { // Add row

			// pay_date
			$paymentlog->pay_date->EditCustomAttributes = "";
			$paymentlog->pay_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($paymentlog->pay_date->CurrentValue, 7));

			// t_code
			$paymentlog->t_code->EditCustomAttributes = "";
			if (trim(strval($paymentlog->t_code->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($paymentlog->t_code->CurrentValue) . "'";
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
			$paymentlog->t_code->EditValue = $arwrk;

			// village_id
			$paymentlog->village_id->EditCustomAttributes = "";
			if (trim(strval($paymentlog->village_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($paymentlog->village_id->CurrentValue) . "";
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
			$paymentlog->village_id->EditValue = $arwrk;

			// pay_type
			$paymentlog->pay_type->EditCustomAttributes = "";
			if (trim(strval($paymentlog->pay_type->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($paymentlog->pay_type->CurrentValue) . "";
			}
			$sSqlWrk = "SELECT `pt_id`, `pt_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `pt_order`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$paymentlog->pay_type->EditValue = $arwrk;

			// pay_detail
			$paymentlog->pay_detail->EditCustomAttributes = "";
			$paymentlog->pay_detail->EditValue = ew_HtmlEncode($paymentlog->pay_detail->CurrentValue);

			// count_member
			$paymentlog->count_member->EditCustomAttributes = "";
			$paymentlog->count_member->EditValue = ew_HtmlEncode($paymentlog->count_member->CurrentValue);

			// pay_rate
			$paymentlog->pay_rate->EditCustomAttributes = "";
			$paymentlog->pay_rate->EditValue = ew_HtmlEncode($paymentlog->pay_rate->CurrentValue);

			// sub_total
			$paymentlog->sub_total->EditCustomAttributes = "";
			$paymentlog->sub_total->EditValue = ew_HtmlEncode($paymentlog->sub_total->CurrentValue);

			// assc_rate
			$paymentlog->assc_rate->EditCustomAttributes = "";
			$paymentlog->assc_rate->EditValue = ew_HtmlEncode($paymentlog->assc_rate->CurrentValue);

			// assc_total
			$paymentlog->assc_total->EditCustomAttributes = "";
			$paymentlog->assc_total->EditValue = ew_HtmlEncode($paymentlog->assc_total->CurrentValue);

			// grand_total
			$paymentlog->grand_total->EditCustomAttributes = "";
			$paymentlog->grand_total->EditValue = ew_HtmlEncode($paymentlog->grand_total->CurrentValue);

			// pay_note
			$paymentlog->pay_note->EditCustomAttributes = "";
			$paymentlog->pay_note->EditValue = ew_HtmlEncode($paymentlog->pay_note->CurrentValue);

			// pml_slipt_num
			$paymentlog->pml_slipt_num->EditCustomAttributes = "";
			$paymentlog->pml_slipt_num->EditValue = ew_HtmlEncode($paymentlog->pml_slipt_num->CurrentValue);

			// Edit refer script
			// pay_date

			$paymentlog->pay_date->HrefValue = "";

			// t_code
			$paymentlog->t_code->HrefValue = "";

			// village_id
			$paymentlog->village_id->HrefValue = "";

			// pay_type
			$paymentlog->pay_type->HrefValue = "";

			// pay_detail
			$paymentlog->pay_detail->HrefValue = "";

			// count_member
			$paymentlog->count_member->HrefValue = "";

			// pay_rate
			$paymentlog->pay_rate->HrefValue = "";

			// sub_total
			$paymentlog->sub_total->HrefValue = "";

			// assc_rate
			$paymentlog->assc_rate->HrefValue = "";

			// assc_total
			$paymentlog->assc_total->HrefValue = "";

			// grand_total
			$paymentlog->grand_total->HrefValue = "";

			// pay_note
			$paymentlog->pay_note->HrefValue = "";

			// pml_slipt_num
			$paymentlog->pml_slipt_num->HrefValue = "";
		}
		if ($paymentlog->RowType == EW_ROWTYPE_ADD ||
			$paymentlog->RowType == EW_ROWTYPE_EDIT ||
			$paymentlog->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$paymentlog->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($paymentlog->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$paymentlog->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $paymentlog;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($paymentlog->pay_date->FormValue) && $paymentlog->pay_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentlog->pay_date->FldCaption());
		}
		if (!ew_CheckEuroDate($paymentlog->pay_date->FormValue)) {
			ew_AddMessage($gsFormError, $paymentlog->pay_date->FldErrMsg());
		}
		if (!is_null($paymentlog->t_code->FormValue) && $paymentlog->t_code->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentlog->t_code->FldCaption());
		}
		if (!is_null($paymentlog->village_id->FormValue) && $paymentlog->village_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentlog->village_id->FldCaption());
		}
		if (!is_null($paymentlog->pay_type->FormValue) && $paymentlog->pay_type->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentlog->pay_type->FldCaption());
		}
		if (!is_null($paymentlog->pay_detail->FormValue) && $paymentlog->pay_detail->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentlog->pay_detail->FldCaption());
		}
		if (!ew_CheckInteger($paymentlog->pay_detail->FormValue)) {
			ew_AddMessage($gsFormError, $paymentlog->pay_detail->FldErrMsg());
		}
		if (!is_null($paymentlog->count_member->FormValue) && $paymentlog->count_member->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentlog->count_member->FldCaption());
		}
		if (!ew_CheckInteger($paymentlog->count_member->FormValue)) {
			ew_AddMessage($gsFormError, $paymentlog->count_member->FldErrMsg());
		}
		if (!is_null($paymentlog->pay_rate->FormValue) && $paymentlog->pay_rate->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentlog->pay_rate->FldCaption());
		}
		if (!ew_CheckInteger($paymentlog->pay_rate->FormValue)) {
			ew_AddMessage($gsFormError, $paymentlog->pay_rate->FldErrMsg());
		}
		if (!is_null($paymentlog->sub_total->FormValue) && $paymentlog->sub_total->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentlog->sub_total->FldCaption());
		}
		if (!ew_CheckNumber($paymentlog->sub_total->FormValue)) {
			ew_AddMessage($gsFormError, $paymentlog->sub_total->FldErrMsg());
		}
		if (!is_null($paymentlog->assc_rate->FormValue) && $paymentlog->assc_rate->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentlog->assc_rate->FldCaption());
		}
		if (!ew_CheckInteger($paymentlog->assc_rate->FormValue)) {
			ew_AddMessage($gsFormError, $paymentlog->assc_rate->FldErrMsg());
		}
		if (!is_null($paymentlog->assc_total->FormValue) && $paymentlog->assc_total->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentlog->assc_total->FldCaption());
		}
		if (!ew_CheckNumber($paymentlog->assc_total->FormValue)) {
			ew_AddMessage($gsFormError, $paymentlog->assc_total->FldErrMsg());
		}
		if (!is_null($paymentlog->grand_total->FormValue) && $paymentlog->grand_total->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentlog->grand_total->FldCaption());
		}
		if (!ew_CheckNumber($paymentlog->grand_total->FormValue)) {
			ew_AddMessage($gsFormError, $paymentlog->grand_total->FldErrMsg());
		}
		if (!is_null($paymentlog->pml_slipt_num->FormValue) && $paymentlog->pml_slipt_num->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentlog->pml_slipt_num->FldCaption());
		}
		if (!ew_CheckInteger($paymentlog->pml_slipt_num->FormValue)) {
			ew_AddMessage($gsFormError, $paymentlog->pml_slipt_num->FldErrMsg());
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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $paymentlog;
		$rsnew = array();

		// pay_date
		$paymentlog->pay_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($paymentlog->pay_date->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// t_code
		$paymentlog->t_code->SetDbValueDef($rsnew, $paymentlog->t_code->CurrentValue, "", FALSE);

		// village_id
		$paymentlog->village_id->SetDbValueDef($rsnew, $paymentlog->village_id->CurrentValue, 0, FALSE);

		// pay_type
		$paymentlog->pay_type->SetDbValueDef($rsnew, $paymentlog->pay_type->CurrentValue, 0, FALSE);

		// pay_detail
		$paymentlog->pay_detail->SetDbValueDef($rsnew, $paymentlog->pay_detail->CurrentValue, "", FALSE);

		// count_member
		$paymentlog->count_member->SetDbValueDef($rsnew, $paymentlog->count_member->CurrentValue, 0, FALSE);

		// pay_rate
		$paymentlog->pay_rate->SetDbValueDef($rsnew, $paymentlog->pay_rate->CurrentValue, 0, FALSE);

		// sub_total
		$paymentlog->sub_total->SetDbValueDef($rsnew, $paymentlog->sub_total->CurrentValue, 0, FALSE);

		// assc_rate
		$paymentlog->assc_rate->SetDbValueDef($rsnew, $paymentlog->assc_rate->CurrentValue, 0, FALSE);

		// assc_total
		$paymentlog->assc_total->SetDbValueDef($rsnew, $paymentlog->assc_total->CurrentValue, 0, FALSE);

		// grand_total
		$paymentlog->grand_total->SetDbValueDef($rsnew, $paymentlog->grand_total->CurrentValue, 0, FALSE);

		// pay_note
		$paymentlog->pay_note->SetDbValueDef($rsnew, $paymentlog->pay_note->CurrentValue, NULL, FALSE);

		// pml_slipt_num
		$paymentlog->pml_slipt_num->SetDbValueDef($rsnew, $paymentlog->pml_slipt_num->CurrentValue, 0, strval($paymentlog->pml_slipt_num->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $paymentlog->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($paymentlog->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($paymentlog->CancelMessage <> "") {
				$this->setFailureMessage($paymentlog->CancelMessage);
				$paymentlog->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$paymentlog->pml_id->setDbValue($conn->Insert_ID());
			$rsnew['pml_id'] = $paymentlog->pml_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$paymentlog->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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
