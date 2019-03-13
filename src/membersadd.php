<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "membersinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "memberupdateloginfo.php" ?>
<?php include_once "memberupdateloggridcls.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$members_add = new cmembers_add();
$Page =& $members_add;

// Page init
$members_add->Page_Init();

// Page main
$members_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var members_add = new ew_Page("members_add");

// page properties
members_add.PageID = "add"; // page ID
members_add.FormID = "fmembersadd"; // form ID
var EW_PAGE_ID = members_add.PageID; // for backward compatibility

// extend page with ValidateForm function
members_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_member_code"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->member_code->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_code"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->id_code->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_code"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->id_code->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_prefix"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->prefix->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_gender"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->gender->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_fname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->fname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_lname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->lname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_birthdate"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->birthdate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_address"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->address->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_t_code"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->t_code->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_village_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->village_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_bnfc1_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->bnfc1_name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_bnfc1_rel"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->bnfc1_rel->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_regis_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->regis_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_regis_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->regis_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_effective_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($members->effective_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_effective_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->effective_date->FldErrMsg()) ?>");
	}

	// Process detail page
	var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
	if (detailpage != "") {
		return eval(detailpage+".ValidateForm(fobj)");
	}
	return true;
}
members_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
members_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
members_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
members_add.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
members_add.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<div class="ewTitle"><img src="images/ico_add_member.png" alt="" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $members->TableCaption() ?></div><div class="clear"></div>
<?php $members_add->ShowPageHeader(); ?>
<?php
$members_add->ShowMessage();
?>
<form name="fmembersadd" id="fmembersadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return members_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="members">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($members->member_code->Visible) { // member_code ?>
	<tr id="r_member_code"<?php echo $members->RowAttributes() ?>>
		<td width="170" class="ewTableHeader"><?php echo $members->member_code->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $members->member_code->CellAttributes() ?>><span id="el_member_code">
<input type="text" name="x_member_code" id="x_member_code" size="30" maxlength="50" value="<?php echo $members->member_code->EditValue ?>"<?php echo $members->member_code->EditAttributes() ?>>
</span><?php echo $members->member_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->id_code->Visible) { // id_code ?>
	<tr id="r_id_code"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->id_code->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $members->id_code->CellAttributes() ?>><span id="el_id_code">
<input type="text" name="x_id_code" id="x_id_code" size="13" maxlength="13" value="<?php echo $members->id_code->EditValue ?>"<?php echo $members->id_code->EditAttributes() ?>>
</span><?php echo $members->id_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->prefix->Visible) { // prefix ?>
	<tr id="r_prefix"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->prefix->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $members->prefix->CellAttributes() ?>><span id="el_prefix">
<select id="x_prefix" name="x_prefix"<?php echo $members->prefix->EditAttributes() ?>>
<?php
if (is_array($members->prefix->EditValue)) {
	$arwrk = $members->prefix->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->prefix->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $members->prefix->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->gender->Visible) { // gender ?>
	<tr id="r_gender"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->gender->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $members->gender->CellAttributes() ?>><span id="el_gender">
<select id="x_gender" name="x_gender"<?php echo $members->gender->EditAttributes() ?>>
<?php
if (is_array($members->gender->EditValue)) {
	$arwrk = $members->gender->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->gender->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $members->gender->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->fname->Visible) { // fname ?>
	<tr id="r_fname"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->fname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $members->fname->CellAttributes() ?>><span id="el_fname">
<input type="text" name="x_fname" id="x_fname" size="30" maxlength="45" value="<?php echo $members->fname->EditValue ?>"<?php echo $members->fname->EditAttributes() ?>>
</span><?php echo $members->fname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->lname->Visible) { // lname ?>
	<tr id="r_lname"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->lname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $members->lname->CellAttributes() ?>><span id="el_lname">
<input type="text" name="x_lname" id="x_lname" size="30" maxlength="45" value="<?php echo $members->lname->EditValue ?>"<?php echo $members->lname->EditAttributes() ?>>
</span><?php echo $members->lname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->birthdate->Visible) { // birthdate ?>
	<tr id="r_birthdate"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->birthdate->FldCaption() ?></td>
		<td<?php echo $members->birthdate->CellAttributes() ?>><span id="el_birthdate">
<input type="text" name="x_birthdate" id="x_birthdate" value="<?php echo $members->birthdate->EditValue ?>"<?php echo $members->birthdate->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_birthdate" name="cal_x_birthdate" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_birthdate", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_birthdate" // button id
});
</script>
</span><?php echo $members->birthdate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->address->Visible) { // address ?>
	<tr id="r_address"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->address->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $members->address->CellAttributes() ?>><span id="el_address">
<input type="text" name="x_address" id="x_address" value="<?php echo $members->address->EditValue ?>"<?php echo $members->address->EditAttributes() ?>>
</span><?php echo $members->address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->t_code->Visible) { // t_code ?>
	<tr id="r_t_code"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->t_code->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $members->t_code->CellAttributes() ?>><span id="el_t_code">
<?php $members->t_code->EditAttrs["onchange"] = "ew_UpdateOpt('x_village_id','x_t_code',true); " . @$members->t_code->EditAttrs["onchange"]; ?>
<select id="x_t_code" name="x_t_code"<?php echo $members->t_code->EditAttributes() ?>>
<?php
if (is_array($members->t_code->EditValue)) {
	$arwrk = $members->t_code->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->t_code->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$members->t_code) ?><?php echo $arwrk[$rowcntwrk][2] ?>
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
</span><?php echo $members->t_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->village_id->Visible) { // village_id ?>
	<tr id="r_village_id"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->village_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $members->village_id->CellAttributes() ?>><span id="el_village_id">
<select id="x_village_id" name="x_village_id"<?php echo $members->village_id->EditAttributes() ?>>
<?php
if (is_array($members->village_id->EditValue)) {
	$arwrk = $members->village_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($members->village_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk,1,$members->village_id) ?><?php echo $arwrk[$rowcntwrk][2] ?>
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
</span><?php echo $members->village_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->phone->Visible) { // phone ?>
	<tr id="r_phone"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->phone->FldCaption() ?></td>
		<td<?php echo $members->phone->CellAttributes() ?>><span id="el_phone">
<input type="text" name="x_phone" id="x_phone" size="30" maxlength="45" value="<?php echo $members->phone->EditValue ?>"<?php echo $members->phone->EditAttributes() ?>>
</span><?php echo $members->phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->bnfc1_name->Visible) { // bnfc1_name ?>
	<tr id="r_bnfc1_name"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->bnfc1_name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $members->bnfc1_name->CellAttributes() ?>><span id="el_bnfc1_name">
<input type="text" name="x_bnfc1_name" id="x_bnfc1_name" size="30" maxlength="45" value="<?php echo $members->bnfc1_name->EditValue ?>"<?php echo $members->bnfc1_name->EditAttributes() ?>>
</span><?php echo $members->bnfc1_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->bnfc1_rel->Visible) { // bnfc1_rel ?>
	<tr id="r_bnfc1_rel"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->bnfc1_rel->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $members->bnfc1_rel->CellAttributes() ?>><span id="el_bnfc1_rel">
<input type="text" name="x_bnfc1_rel" id="x_bnfc1_rel" size="30" maxlength="45" value="<?php echo $members->bnfc1_rel->EditValue ?>"<?php echo $members->bnfc1_rel->EditAttributes() ?>>
</span><?php echo $members->bnfc1_rel->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->bnfc2_name->Visible) { // bnfc2_name ?>
	<tr id="r_bnfc2_name"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->bnfc2_name->FldCaption() ?></td>
		<td<?php echo $members->bnfc2_name->CellAttributes() ?>><span id="el_bnfc2_name">
<input type="text" name="x_bnfc2_name" id="x_bnfc2_name" size="30" maxlength="45" value="<?php echo $members->bnfc2_name->EditValue ?>"<?php echo $members->bnfc2_name->EditAttributes() ?>>
</span><?php echo $members->bnfc2_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->bnfc2_rel->Visible) { // bnfc2_rel ?>
	<tr id="r_bnfc2_rel"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->bnfc2_rel->FldCaption() ?></td>
		<td<?php echo $members->bnfc2_rel->CellAttributes() ?>><span id="el_bnfc2_rel">
<input type="text" name="x_bnfc2_rel" id="x_bnfc2_rel" size="30" maxlength="45" value="<?php echo $members->bnfc2_rel->EditValue ?>"<?php echo $members->bnfc2_rel->EditAttributes() ?>>
</span><?php echo $members->bnfc2_rel->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->bnfc3_name->Visible) { // bnfc3_name ?>
	<tr id="r_bnfc3_name"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->bnfc3_name->FldCaption() ?></td>
		<td<?php echo $members->bnfc3_name->CellAttributes() ?>><span id="el_bnfc3_name">
<input type="text" name="x_bnfc3_name" id="x_bnfc3_name" size="30" maxlength="45" value="<?php echo $members->bnfc3_name->EditValue ?>"<?php echo $members->bnfc3_name->EditAttributes() ?>>
</span><?php echo $members->bnfc3_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->bnfc3_rel->Visible) { // bnfc3_rel ?>
	<tr id="r_bnfc3_rel"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->bnfc3_rel->FldCaption() ?></td>
		<td<?php echo $members->bnfc3_rel->CellAttributes() ?>><span id="el_bnfc3_rel">
<input type="text" name="x_bnfc3_rel" id="x_bnfc3_rel" size="30" maxlength="45" value="<?php echo $members->bnfc3_rel->EditValue ?>"<?php echo $members->bnfc3_rel->EditAttributes() ?>>
</span><?php echo $members->bnfc3_rel->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->regis_date->Visible) { // regis_date ?>
	<tr id="r_regis_date"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->regis_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $members->regis_date->CellAttributes() ?>><span id="el_regis_date">
<input type="text" name="x_regis_date" id="x_regis_date" value="<?php echo $members->regis_date->EditValue ?>"<?php echo $members->regis_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_regis_date" name="cal_x_regis_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_regis_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_regis_date" // button id
});
</script>
</span><?php echo $members->regis_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->effective_date->Visible) { // effective_date ?>
	<tr id="r_effective_date"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->effective_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $members->effective_date->CellAttributes() ?>><span id="el_effective_date">
<input type="text" name="x_effective_date" id="x_effective_date" value="<?php echo $members->effective_date->EditValue ?>"<?php echo $members->effective_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_effective_date" name="cal_x_effective_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_effective_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_effective_date" // button id
});
</script>
</span><?php echo $members->effective_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->attachment->Visible) { // attachment ?>
	<tr id="r_attachment"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->attachment->FldCaption() ?></td>
		<td<?php echo $members->attachment->CellAttributes() ?>><span id="el_attachment">
<input type="text" name="x_attachment" id="x_attachment" size="30" maxlength="10" value="<?php echo $members->attachment->EditValue ?>"<?php echo $members->attachment->EditAttributes() ?>>
</span><?php echo $members->attachment->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->note->Visible) { // note ?>
	<tr id="r_note"<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->note->FldCaption() ?></td>
		<td<?php echo $members->note->CellAttributes() ?>><span id="el_note">
<textarea name="x_note" id="x_note" cols="35" rows="4"<?php echo $members->note->EditAttributes() ?>><?php echo $members->note->EditValue ?></textarea>
</span><?php echo $members->note->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($members->getCurrentDetailTable() == "memberupdatelog" && $memberupdatelog->DetailAdd) { ?>
<br>
<?php include_once "memberupdateloggrid.php" ?>
<br>
<?php } ?>
<a href="<?php echo $members->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a>&nbsp;&nbsp;<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_village_id','x_t_code',false],
['x_t_code','x_t_code',false]]);

//-->
</script>
<?php
$members_add->ShowPageFooter();
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
$members_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cmembers_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'members';

	// Page object name
	var $PageObjName = 'members_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $members;
		if ($members->UseTokenInUrl) $PageUrl .= "t=" . $members->TableVar . "&"; // Add page token
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
		global $objForm, $members;
		if ($members->UseTokenInUrl) {
			if ($objForm)
				return ($members->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($members->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmembers_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (members)
		if (!isset($GLOBALS["members"])) {
			$GLOBALS["members"] = new cmembers();
			$GLOBALS["Table"] =& $GLOBALS["members"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Table object (memberupdatelog)
		if (!isset($GLOBALS['memberupdatelog'])) $GLOBALS['memberupdatelog'] = new cmemberupdatelog();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'members', TRUE);

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
		global $members;

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
		global $objForm, $Language, $gsFormError, $members;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$members->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$members->CurrentAction = "I"; // Form error, reset action
				$members->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["member_id"] != "") {
				$members->member_id->setQueryStringValue($_GET["member_id"]);
				$members->setKey("member_id", $members->member_id->CurrentValue); // Set up key
			} else {
				$members->setKey("member_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$members->CurrentAction = "C"; // Copy record
			} else {
				$members->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Set up detail parameters
		$this->SetUpDetailParms();

		// Perform action based on action code
		switch ($members->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("memberslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$members->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $members->ViewUrl();
					if (ew_GetPageName($sReturnUrl) == "membersview.php")
						$sReturnUrl = $members->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$members->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$members->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$members->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $members;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $members;
		$members->member_code->CurrentValue = NULL;
		$members->member_code->OldValue = $members->member_code->CurrentValue;
		$members->id_code->CurrentValue = NULL;
		$members->id_code->OldValue = $members->id_code->CurrentValue;
		$members->prefix->CurrentValue = NULL;
		$members->prefix->OldValue = $members->prefix->CurrentValue;
		$members->gender->CurrentValue = NULL;
		$members->gender->OldValue = $members->gender->CurrentValue;
		$members->fname->CurrentValue = NULL;
		$members->fname->OldValue = $members->fname->CurrentValue;
		$members->lname->CurrentValue = NULL;
		$members->lname->OldValue = $members->lname->CurrentValue;
		$members->birthdate->CurrentValue = NULL;
		$members->birthdate->OldValue = $members->birthdate->CurrentValue;
		$members->address->CurrentValue = NULL;
		$members->address->OldValue = $members->address->CurrentValue;
		$members->t_code->CurrentValue = NULL;
		$members->t_code->OldValue = $members->t_code->CurrentValue;
		$members->village_id->CurrentValue = NULL;
		$members->village_id->OldValue = $members->village_id->CurrentValue;
		$members->phone->CurrentValue = NULL;
		$members->phone->OldValue = $members->phone->CurrentValue;
		$members->bnfc1_name->CurrentValue = NULL;
		$members->bnfc1_name->OldValue = $members->bnfc1_name->CurrentValue;
		$members->bnfc1_rel->CurrentValue = NULL;
		$members->bnfc1_rel->OldValue = $members->bnfc1_rel->CurrentValue;
		$members->bnfc2_name->CurrentValue = NULL;
		$members->bnfc2_name->OldValue = $members->bnfc2_name->CurrentValue;
		$members->bnfc2_rel->CurrentValue = NULL;
		$members->bnfc2_rel->OldValue = $members->bnfc2_rel->CurrentValue;
		$members->bnfc3_name->CurrentValue = NULL;
		$members->bnfc3_name->OldValue = $members->bnfc3_name->CurrentValue;
		$members->bnfc3_rel->CurrentValue = NULL;
		$members->bnfc3_rel->OldValue = $members->bnfc3_rel->CurrentValue;
		$members->regis_date->CurrentValue = NULL;
		$members->regis_date->OldValue = $members->regis_date->CurrentValue;
		$members->effective_date->CurrentValue = NULL;
		$members->effective_date->OldValue = $members->effective_date->CurrentValue;
		$members->attachment->CurrentValue = NULL;
		$members->attachment->OldValue = $members->attachment->CurrentValue;
		$members->note->CurrentValue = NULL;
		$members->note->OldValue = $members->note->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $members;
		if (!$members->member_code->FldIsDetailKey) {
			$members->member_code->setFormValue($objForm->GetValue("x_member_code"));
		}
		if (!$members->id_code->FldIsDetailKey) {
			$members->id_code->setFormValue($objForm->GetValue("x_id_code"));
		}
		if (!$members->prefix->FldIsDetailKey) {
			$members->prefix->setFormValue($objForm->GetValue("x_prefix"));
		}
		if (!$members->gender->FldIsDetailKey) {
			$members->gender->setFormValue($objForm->GetValue("x_gender"));
		}
		if (!$members->fname->FldIsDetailKey) {
			$members->fname->setFormValue($objForm->GetValue("x_fname"));
		}
		if (!$members->lname->FldIsDetailKey) {
			$members->lname->setFormValue($objForm->GetValue("x_lname"));
		}
		if (!$members->birthdate->FldIsDetailKey) {
			$members->birthdate->setFormValue($objForm->GetValue("x_birthdate"));
			$members->birthdate->CurrentValue = ew_UnFormatDateTime($members->birthdate->CurrentValue, 7);
		}
		if (!$members->address->FldIsDetailKey) {
			$members->address->setFormValue($objForm->GetValue("x_address"));
		}
		if (!$members->t_code->FldIsDetailKey) {
			$members->t_code->setFormValue($objForm->GetValue("x_t_code"));
		}
		if (!$members->village_id->FldIsDetailKey) {
			$members->village_id->setFormValue($objForm->GetValue("x_village_id"));
		}
		if (!$members->phone->FldIsDetailKey) {
			$members->phone->setFormValue($objForm->GetValue("x_phone"));
		}
		if (!$members->bnfc1_name->FldIsDetailKey) {
			$members->bnfc1_name->setFormValue($objForm->GetValue("x_bnfc1_name"));
		}
		if (!$members->bnfc1_rel->FldIsDetailKey) {
			$members->bnfc1_rel->setFormValue($objForm->GetValue("x_bnfc1_rel"));
		}
		if (!$members->bnfc2_name->FldIsDetailKey) {
			$members->bnfc2_name->setFormValue($objForm->GetValue("x_bnfc2_name"));
		}
		if (!$members->bnfc2_rel->FldIsDetailKey) {
			$members->bnfc2_rel->setFormValue($objForm->GetValue("x_bnfc2_rel"));
		}
		if (!$members->bnfc3_name->FldIsDetailKey) {
			$members->bnfc3_name->setFormValue($objForm->GetValue("x_bnfc3_name"));
		}
		if (!$members->bnfc3_rel->FldIsDetailKey) {
			$members->bnfc3_rel->setFormValue($objForm->GetValue("x_bnfc3_rel"));
		}
		if (!$members->regis_date->FldIsDetailKey) {
			$members->regis_date->setFormValue($objForm->GetValue("x_regis_date"));
			$members->regis_date->CurrentValue = ew_UnFormatDateTime($members->regis_date->CurrentValue, 7);
		}
		if (!$members->effective_date->FldIsDetailKey) {
			$members->effective_date->setFormValue($objForm->GetValue("x_effective_date"));
			$members->effective_date->CurrentValue = ew_UnFormatDateTime($members->effective_date->CurrentValue, 7);
		}
		if (!$members->attachment->FldIsDetailKey) {
			$members->attachment->setFormValue($objForm->GetValue("x_attachment"));
		}
		if (!$members->note->FldIsDetailKey) {
			$members->note->setFormValue($objForm->GetValue("x_note"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $members;
		$this->LoadOldRecord();
		$members->member_code->CurrentValue = $members->member_code->FormValue;
		$members->id_code->CurrentValue = $members->id_code->FormValue;
		$members->prefix->CurrentValue = $members->prefix->FormValue;
		$members->gender->CurrentValue = $members->gender->FormValue;
		$members->fname->CurrentValue = $members->fname->FormValue;
		$members->lname->CurrentValue = $members->lname->FormValue;
		$members->birthdate->CurrentValue = $members->birthdate->FormValue;
		$members->birthdate->CurrentValue = ew_UnFormatDateTime($members->birthdate->CurrentValue, 7);
		$members->address->CurrentValue = $members->address->FormValue;
		$members->t_code->CurrentValue = $members->t_code->FormValue;
		$members->village_id->CurrentValue = $members->village_id->FormValue;
		$members->phone->CurrentValue = $members->phone->FormValue;
		$members->bnfc1_name->CurrentValue = $members->bnfc1_name->FormValue;
		$members->bnfc1_rel->CurrentValue = $members->bnfc1_rel->FormValue;
		$members->bnfc2_name->CurrentValue = $members->bnfc2_name->FormValue;
		$members->bnfc2_rel->CurrentValue = $members->bnfc2_rel->FormValue;
		$members->bnfc3_name->CurrentValue = $members->bnfc3_name->FormValue;
		$members->bnfc3_rel->CurrentValue = $members->bnfc3_rel->FormValue;
		$members->regis_date->CurrentValue = $members->regis_date->FormValue;
		$members->regis_date->CurrentValue = ew_UnFormatDateTime($members->regis_date->CurrentValue, 7);
		$members->effective_date->CurrentValue = $members->effective_date->FormValue;
		$members->effective_date->CurrentValue = ew_UnFormatDateTime($members->effective_date->CurrentValue, 7);
		$members->attachment->CurrentValue = $members->attachment->FormValue;
		$members->note->CurrentValue = $members->note->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $members;
		$sFilter = $members->KeyFilter();

		// Call Row Selecting event
		$members->Row_Selecting($sFilter);

		// Load SQL based on filter
		$members->CurrentFilter = $sFilter;
		$sSql = $members->SQL();
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
		global $conn, $members;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$members->Row_Selected($row);
		$members->member_id->setDbValue($rs->fields('member_id'));
		$members->member_code->setDbValue($rs->fields('member_code'));
		$members->id_code->setDbValue($rs->fields('id_code'));
		$members->prefix->setDbValue($rs->fields('prefix'));
		$members->gender->setDbValue($rs->fields('gender'));
		$members->fname->setDbValue($rs->fields('fname'));
		$members->lname->setDbValue($rs->fields('lname'));
		$members->birthdate->setDbValue($rs->fields('birthdate'));
		$members->age->setDbValue($rs->fields('age'));
		$members->zemail->setDbValue($rs->fields('email'));
		$members->address->setDbValue($rs->fields('address'));
		$members->t_code->setDbValue($rs->fields('t_code'));
		$members->village_id->setDbValue($rs->fields('village_id'));
		$members->phone->setDbValue($rs->fields('phone'));
		$members->suffix->Upload->DbValue = $rs->fields('suffix');
		$members->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
		$members->bnfc1_rel->setDbValue($rs->fields('bnfc1_rel'));
		$members->bnfc2_name->setDbValue($rs->fields('bnfc2_name'));
		$members->bnfc2_rel->setDbValue($rs->fields('bnfc2_rel'));
		$members->bnfc3_name->setDbValue($rs->fields('bnfc3_name'));
		$members->bnfc3_rel->setDbValue($rs->fields('bnfc3_rel'));
		$members->bnfc4_name->setDbValue($rs->fields('bnfc4_name'));
		$members->bnfc4_rel->setDbValue($rs->fields('bnfc4_rel'));
		$members->regis_date->setDbValue($rs->fields('regis_date'));
		$members->effective_date->setDbValue($rs->fields('effective_date'));
		$members->attachment->setDbValue($rs->fields('attachment'));
		$members->member_status->setDbValue($rs->fields('member_status'));
		$members->resign_date->setDbValue($rs->fields('resign_date'));
		$members->dead_date->setDbValue($rs->fields('dead_date'));
		$members->terminate_date->setDbValue($rs->fields('terminate_date'));
		$members->advance_budget->setDbValue($rs->fields('advance_budget'));
		$members->dead_id->setDbValue($rs->fields('dead_id'));
		$members->note->setDbValue($rs->fields('note'));
		$members->update_detail->setDbValue($rs->fields('update_detail'));
		$members->member_type->setDbValue($rs->fields('member_type'));
	}

	// Load old record
	function LoadOldRecord() {
		global $members;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($members->getKey("member_id")) <> "")
			$members->member_id->CurrentValue = $members->getKey("member_id"); // member_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$members->CurrentFilter = $members->KeyFilter();
			$sSql = $members->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $members;

		// Initialize URLs
		// Call Row_Rendering event

		$members->Row_Rendering();

		// Common render codes for all row types
		// member_id
		// member_code
		// id_code
		// prefix
		// gender
		// fname
		// lname
		// birthdate
		// age
		// email
		// address
		// t_code
		// village_id
		// phone
		// suffix
		// bnfc1_name
		// bnfc1_rel
		// bnfc2_name
		// bnfc2_rel
		// bnfc3_name
		// bnfc3_rel
		// bnfc4_name
		// bnfc4_rel
		// regis_date
		// effective_date
		// attachment
		// member_status
		// resign_date
		// dead_date
		// terminate_date
		// advance_budget
		// dead_id
		// note
		// update_detail
		// member_type

		if ($members->RowType == EW_ROWTYPE_VIEW) { // View row

			// member_code
			$members->member_code->ViewValue = $members->member_code->CurrentValue;
			$members->member_code->ViewCustomAttributes = "";

			// id_code
			$members->id_code->ViewValue = $members->id_code->CurrentValue;
			$members->id_code->ViewCustomAttributes = "";

			// prefix
			if (strval($members->prefix->CurrentValue) <> "") {
				$sFilterWrk = "`p_title` = '" . ew_AdjustSql($members->prefix->CurrentValue) . "'";
			$sSqlWrk = "SELECT `p_title` FROM `prefix`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->prefix->ViewValue = $rswrk->fields('p_title');
					$rswrk->Close();
				} else {
					$members->prefix->ViewValue = $members->prefix->CurrentValue;
				}
			} else {
				$members->prefix->ViewValue = NULL;
			}
			$members->prefix->ViewCustomAttributes = "";

			// gender
			if (strval($members->gender->CurrentValue) <> "") {
				$sFilterWrk = "`g_title` = '" . ew_AdjustSql($members->gender->CurrentValue) . "'";
			$sSqlWrk = "SELECT `g_title` FROM `gender`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->gender->ViewValue = $rswrk->fields('g_title');
					$rswrk->Close();
				} else {
					$members->gender->ViewValue = $members->gender->CurrentValue;
				}
			} else {
				$members->gender->ViewValue = NULL;
			}
			$members->gender->ViewCustomAttributes = "";

			// fname
			$members->fname->ViewValue = $members->fname->CurrentValue;
			$members->fname->ViewCustomAttributes = "";

			// lname
			$members->lname->ViewValue = $members->lname->CurrentValue;
			$members->lname->ViewCustomAttributes = "";

			// birthdate
			$members->birthdate->ViewValue = $members->birthdate->CurrentValue;
			$members->birthdate->ViewValue = ew_FormatDateTime($members->birthdate->ViewValue, 7);
			$members->birthdate->ViewCustomAttributes = "";

			// age
			$members->age->ViewValue = $members->age->CurrentValue;
			$members->age->ViewCustomAttributes = "";

			// address
			$members->address->ViewValue = $members->address->CurrentValue;
			$members->address->ViewCustomAttributes = "";

			// t_code
			if (strval($members->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($members->t_code->CurrentValue) . "'";
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
					$members->t_code->ViewValue = $rswrk->fields('t_code');
					$members->t_code->ViewValue .= ew_ValueSeparator(0,1,$members->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$members->t_code->ViewValue = $members->t_code->CurrentValue;
				}
			} else {
				$members->t_code->ViewValue = NULL;
			}
			$members->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($members->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($members->village_id->CurrentValue) . "";
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
					$members->village_id->ViewValue = $rswrk->fields('v_code');
					$members->village_id->ViewValue .= ew_ValueSeparator(0,1,$members->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$members->village_id->ViewValue = $members->village_id->CurrentValue;
				}
			} else {
				$members->village_id->ViewValue = NULL;
			}
			$members->village_id->ViewCustomAttributes = "";

			// phone
			$members->phone->ViewValue = $members->phone->CurrentValue;
			$members->phone->ViewCustomAttributes = "";

			// bnfc1_name
			$members->bnfc1_name->ViewValue = $members->bnfc1_name->CurrentValue;
			$members->bnfc1_name->ViewCustomAttributes = "";

			// bnfc1_rel
			$members->bnfc1_rel->ViewValue = $members->bnfc1_rel->CurrentValue;
			$members->bnfc1_rel->ViewCustomAttributes = "";

			// bnfc2_name
			$members->bnfc2_name->ViewValue = $members->bnfc2_name->CurrentValue;
			$members->bnfc2_name->ViewCustomAttributes = "";

			// bnfc2_rel
			$members->bnfc2_rel->ViewValue = $members->bnfc2_rel->CurrentValue;
			$members->bnfc2_rel->ViewCustomAttributes = "";

			// bnfc3_name
			$members->bnfc3_name->ViewValue = $members->bnfc3_name->CurrentValue;
			$members->bnfc3_name->ViewCustomAttributes = "";

			// bnfc3_rel
			$members->bnfc3_rel->ViewValue = $members->bnfc3_rel->CurrentValue;
			$members->bnfc3_rel->ViewCustomAttributes = "";

			// regis_date
			$members->regis_date->ViewValue = $members->regis_date->CurrentValue;
			$members->regis_date->ViewValue = ew_FormatDateTime($members->regis_date->ViewValue, 7);
			$members->regis_date->ViewCustomAttributes = "";

			// effective_date
			$members->effective_date->ViewValue = $members->effective_date->CurrentValue;
			$members->effective_date->ViewValue = ew_FormatDateTime($members->effective_date->ViewValue, 7);
			$members->effective_date->ViewCustomAttributes = "";

			// attachment
			$members->attachment->ViewValue = $members->attachment->CurrentValue;
			$members->attachment->ViewCustomAttributes = "";

			// member_status
			if (strval($members->member_status->CurrentValue) <> "") {
				$sFilterWrk = "`s_title` = '" . ew_AdjustSql($members->member_status->CurrentValue) . "'";
			$sSqlWrk = "SELECT `s_title` FROM `memberstatus`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->member_status->ViewValue = $rswrk->fields('s_title');
					$rswrk->Close();
				} else {
					$members->member_status->ViewValue = $members->member_status->CurrentValue;
				}
			} else {
				$members->member_status->ViewValue = NULL;
			}
			$members->member_status->ViewCustomAttributes = "";

			// resign_date
			$members->resign_date->ViewValue = $members->resign_date->CurrentValue;
			$members->resign_date->ViewValue = ew_FormatDateTime($members->resign_date->ViewValue, 7);
			$members->resign_date->ViewCustomAttributes = "";

			// dead_date
			$members->dead_date->ViewValue = $members->dead_date->CurrentValue;
			$members->dead_date->ViewValue = ew_FormatDateTime($members->dead_date->ViewValue, 7);
			$members->dead_date->ViewCustomAttributes = "";

			// terminate_date
			$members->terminate_date->ViewValue = $members->terminate_date->CurrentValue;
			$members->terminate_date->ViewValue = ew_FormatDateTime($members->terminate_date->ViewValue, 7);
			$members->terminate_date->ViewCustomAttributes = "";

			// note
			$members->note->ViewValue = $members->note->CurrentValue;
			$members->note->ViewCustomAttributes = "";

			// member_code
			$members->member_code->LinkCustomAttributes = "";
			$members->member_code->HrefValue = "";
			$members->member_code->TooltipValue = "";

			// id_code
			$members->id_code->LinkCustomAttributes = "";
			$members->id_code->HrefValue = "";
			$members->id_code->TooltipValue = "";

			// prefix
			$members->prefix->LinkCustomAttributes = "";
			$members->prefix->HrefValue = "";
			$members->prefix->TooltipValue = "";

			// gender
			$members->gender->LinkCustomAttributes = "";
			$members->gender->HrefValue = "";
			$members->gender->TooltipValue = "";

			// fname
			$members->fname->LinkCustomAttributes = "";
			$members->fname->HrefValue = "";
			$members->fname->TooltipValue = "";

			// lname
			$members->lname->LinkCustomAttributes = "";
			$members->lname->HrefValue = "";
			$members->lname->TooltipValue = "";

			// birthdate
			$members->birthdate->LinkCustomAttributes = "";
			$members->birthdate->HrefValue = "";
			$members->birthdate->TooltipValue = "";

			// address
			$members->address->LinkCustomAttributes = "";
			$members->address->HrefValue = "";
			$members->address->TooltipValue = "";

			// t_code
			$members->t_code->LinkCustomAttributes = "";
			$members->t_code->HrefValue = "";
			$members->t_code->TooltipValue = "";

			// village_id
			$members->village_id->LinkCustomAttributes = "";
			$members->village_id->HrefValue = "";
			$members->village_id->TooltipValue = "";

			// phone
			$members->phone->LinkCustomAttributes = "";
			$members->phone->HrefValue = "";
			$members->phone->TooltipValue = "";

			// bnfc1_name
			$members->bnfc1_name->LinkCustomAttributes = "";
			$members->bnfc1_name->HrefValue = "";
			$members->bnfc1_name->TooltipValue = "";

			// bnfc1_rel
			$members->bnfc1_rel->LinkCustomAttributes = "";
			$members->bnfc1_rel->HrefValue = "";
			$members->bnfc1_rel->TooltipValue = "";

			// bnfc2_name
			$members->bnfc2_name->LinkCustomAttributes = "";
			$members->bnfc2_name->HrefValue = "";
			$members->bnfc2_name->TooltipValue = "";

			// bnfc2_rel
			$members->bnfc2_rel->LinkCustomAttributes = "";
			$members->bnfc2_rel->HrefValue = "";
			$members->bnfc2_rel->TooltipValue = "";

			// bnfc3_name
			$members->bnfc3_name->LinkCustomAttributes = "";
			$members->bnfc3_name->HrefValue = "";
			$members->bnfc3_name->TooltipValue = "";

			// bnfc3_rel
			$members->bnfc3_rel->LinkCustomAttributes = "";
			$members->bnfc3_rel->HrefValue = "";
			$members->bnfc3_rel->TooltipValue = "";

			// regis_date
			$members->regis_date->LinkCustomAttributes = "";
			$members->regis_date->HrefValue = "";
			$members->regis_date->TooltipValue = "";

			// effective_date
			$members->effective_date->LinkCustomAttributes = "";
			$members->effective_date->HrefValue = "";
			$members->effective_date->TooltipValue = "";

			// attachment
			$members->attachment->LinkCustomAttributes = "";
			$members->attachment->HrefValue = "";
			$members->attachment->TooltipValue = "";

			// note
			$members->note->LinkCustomAttributes = "";
			$members->note->HrefValue = "";
			$members->note->TooltipValue = "";
		} elseif ($members->RowType == EW_ROWTYPE_ADD) { // Add row

			// member_code
			$members->member_code->EditCustomAttributes = "";
			$members->member_code->EditValue = ew_HtmlEncode($members->member_code->CurrentValue);

			// id_code
			$members->id_code->EditCustomAttributes = "";
			$members->id_code->EditValue = ew_HtmlEncode($members->id_code->CurrentValue);

			// prefix
			$members->prefix->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `p_title`, `p_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `prefix`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$members->prefix->EditValue = $arwrk;

			// gender
			$members->gender->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `g_title`, `g_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `gender`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$members->gender->EditValue = $arwrk;

			// fname
			$members->fname->EditCustomAttributes = "";
			$members->fname->EditValue = ew_HtmlEncode($members->fname->CurrentValue);

			// lname
			$members->lname->EditCustomAttributes = "";
			$members->lname->EditValue = ew_HtmlEncode($members->lname->CurrentValue);

			// birthdate
			$members->birthdate->EditCustomAttributes = "";
			$members->birthdate->EditValue = ew_HtmlEncode(ew_FormatDateTime($members->birthdate->CurrentValue, 7));

			// address
			$members->address->EditCustomAttributes = "";
			$members->address->EditValue = ew_HtmlEncode($members->address->CurrentValue);

			// t_code
			$members->t_code->EditCustomAttributes = "";
			if (trim(strval($members->t_code->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($members->t_code->CurrentValue) . "'";
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
			$members->t_code->EditValue = $arwrk;

			// village_id
			$members->village_id->EditCustomAttributes = "";
			if (trim(strval($members->village_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($members->village_id->CurrentValue) . "";
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
			$members->village_id->EditValue = $arwrk;

			// phone
			$members->phone->EditCustomAttributes = "";
			$members->phone->EditValue = ew_HtmlEncode($members->phone->CurrentValue);

			// bnfc1_name
			$members->bnfc1_name->EditCustomAttributes = "";
			$members->bnfc1_name->EditValue = ew_HtmlEncode($members->bnfc1_name->CurrentValue);

			// bnfc1_rel
			$members->bnfc1_rel->EditCustomAttributes = "";
			$members->bnfc1_rel->EditValue = ew_HtmlEncode($members->bnfc1_rel->CurrentValue);

			// bnfc2_name
			$members->bnfc2_name->EditCustomAttributes = "";
			$members->bnfc2_name->EditValue = ew_HtmlEncode($members->bnfc2_name->CurrentValue);

			// bnfc2_rel
			$members->bnfc2_rel->EditCustomAttributes = "";
			$members->bnfc2_rel->EditValue = ew_HtmlEncode($members->bnfc2_rel->CurrentValue);

			// bnfc3_name
			$members->bnfc3_name->EditCustomAttributes = "";
			$members->bnfc3_name->EditValue = ew_HtmlEncode($members->bnfc3_name->CurrentValue);

			// bnfc3_rel
			$members->bnfc3_rel->EditCustomAttributes = "";
			$members->bnfc3_rel->EditValue = ew_HtmlEncode($members->bnfc3_rel->CurrentValue);

			// regis_date
			$members->regis_date->EditCustomAttributes = "";
			$members->regis_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($members->regis_date->CurrentValue, 7));

			// effective_date
			$members->effective_date->EditCustomAttributes = "";
			$members->effective_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($members->effective_date->CurrentValue, 7));

			// attachment
			$members->attachment->EditCustomAttributes = "";
			$members->attachment->EditValue = ew_HtmlEncode($members->attachment->CurrentValue);

			// note
			$members->note->EditCustomAttributes = "";
			$members->note->EditValue = ew_HtmlEncode($members->note->CurrentValue);

			// Edit refer script
			// member_code

			$members->member_code->HrefValue = "";

			// id_code
			$members->id_code->HrefValue = "";

			// prefix
			$members->prefix->HrefValue = "";

			// gender
			$members->gender->HrefValue = "";

			// fname
			$members->fname->HrefValue = "";

			// lname
			$members->lname->HrefValue = "";

			// birthdate
			$members->birthdate->HrefValue = "";

			// address
			$members->address->HrefValue = "";

			// t_code
			$members->t_code->HrefValue = "";

			// village_id
			$members->village_id->HrefValue = "";

			// phone
			$members->phone->HrefValue = "";

			// bnfc1_name
			$members->bnfc1_name->HrefValue = "";

			// bnfc1_rel
			$members->bnfc1_rel->HrefValue = "";

			// bnfc2_name
			$members->bnfc2_name->HrefValue = "";

			// bnfc2_rel
			$members->bnfc2_rel->HrefValue = "";

			// bnfc3_name
			$members->bnfc3_name->HrefValue = "";

			// bnfc3_rel
			$members->bnfc3_rel->HrefValue = "";

			// regis_date
			$members->regis_date->HrefValue = "";

			// effective_date
			$members->effective_date->HrefValue = "";

			// attachment
			$members->attachment->HrefValue = "";

			// note
			$members->note->HrefValue = "";
		}
		if ($members->RowType == EW_ROWTYPE_ADD ||
			$members->RowType == EW_ROWTYPE_EDIT ||
			$members->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$members->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($members->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$members->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $members;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($members->member_code->FormValue) && $members->member_code->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->member_code->FldCaption());
		}
		if (!is_null($members->id_code->FormValue) && $members->id_code->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->id_code->FldCaption());
		}
		if (!ew_CheckInteger($members->id_code->FormValue)) {
			ew_AddMessage($gsFormError, $members->id_code->FldErrMsg());
		}
		if (!is_null($members->prefix->FormValue) && $members->prefix->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->prefix->FldCaption());
		}
		if (!is_null($members->gender->FormValue) && $members->gender->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->gender->FldCaption());
		}
		if (!is_null($members->fname->FormValue) && $members->fname->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->fname->FldCaption());
		}
		if (!is_null($members->lname->FormValue) && $members->lname->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->lname->FldCaption());
		}
		if (!ew_CheckEuroDate($members->birthdate->FormValue)) {
			ew_AddMessage($gsFormError, $members->birthdate->FldErrMsg());
		}
		if (!is_null($members->address->FormValue) && $members->address->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->address->FldCaption());
		}
		if (!is_null($members->t_code->FormValue) && $members->t_code->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->t_code->FldCaption());
		}
		if (!is_null($members->village_id->FormValue) && $members->village_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->village_id->FldCaption());
		}
		if (!is_null($members->bnfc1_name->FormValue) && $members->bnfc1_name->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->bnfc1_name->FldCaption());
		}
		if (!is_null($members->bnfc1_rel->FormValue) && $members->bnfc1_rel->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->bnfc1_rel->FldCaption());
		}
		if (!is_null($members->regis_date->FormValue) && $members->regis_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->regis_date->FldCaption());
		}
		if (!ew_CheckEuroDate($members->regis_date->FormValue)) {
			ew_AddMessage($gsFormError, $members->regis_date->FldErrMsg());
		}
		if (!is_null($members->effective_date->FormValue) && $members->effective_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $members->effective_date->FldCaption());
		}
		if (!ew_CheckEuroDate($members->effective_date->FormValue)) {
			ew_AddMessage($gsFormError, $members->effective_date->FldErrMsg());
		}

		// Validate detail grid
		if ($members->getCurrentDetailTable() == "memberupdatelog" && $GLOBALS["memberupdatelog"]->DetailAdd) {
			$memberupdatelog_grid = new cmemberupdatelog_grid(); // get detail page object
			$memberupdatelog_grid->ValidateGridForm();
			$memberupdatelog_grid = NULL;
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
		global $conn, $Language, $Security, $members;
		if ($members->member_code->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(member_code = '" . ew_AdjustSql($members->member_code->CurrentValue) . "')";
			$rsChk = $members->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $members->member_code->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $members->member_code->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		
	/*	if ($members->id_code->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(id_code = '" . ew_AdjustSql($members->id_code->CurrentValue) . "')";
			$rsChk = $members->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $members->id_code->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $members->id_code->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		} */

		// Begin transaction
		if ($members->getCurrentDetailTable() <> "")
			$conn->BeginTrans();
		$rsnew = array();

		// member_code
		$members->member_code->SetDbValueDef($rsnew, $members->member_code->CurrentValue, "", FALSE);

		// id_code
		$members->id_code->SetDbValueDef($rsnew, $members->id_code->CurrentValue, "", FALSE);

		// prefix
		$members->prefix->SetDbValueDef($rsnew, $members->prefix->CurrentValue, "", FALSE);

		// gender
		$members->gender->SetDbValueDef($rsnew, $members->gender->CurrentValue, "", FALSE);

		// fname
		$members->fname->SetDbValueDef($rsnew, $members->fname->CurrentValue, "", FALSE);

		// lname
		$members->lname->SetDbValueDef($rsnew, $members->lname->CurrentValue, "", FALSE);

		// birthdate
		$members->birthdate->SetDbValueDef($rsnew, ew_UnFormatDateTime($members->birthdate->CurrentValue, 7), NULL, FALSE);

		// address
		$members->address->SetDbValueDef($rsnew, $members->address->CurrentValue, NULL, FALSE);

		// t_code
		$members->t_code->SetDbValueDef($rsnew, $members->t_code->CurrentValue, "", FALSE);

		// village_id
		$members->village_id->SetDbValueDef($rsnew, $members->village_id->CurrentValue, 0, FALSE);

		// phone
		$members->phone->SetDbValueDef($rsnew, $members->phone->CurrentValue, NULL, FALSE);

		// bnfc1_name
		$members->bnfc1_name->SetDbValueDef($rsnew, $members->bnfc1_name->CurrentValue, NULL, FALSE);

		// bnfc1_rel
		$members->bnfc1_rel->SetDbValueDef($rsnew, $members->bnfc1_rel->CurrentValue, NULL, FALSE);

		// bnfc2_name
		$members->bnfc2_name->SetDbValueDef($rsnew, $members->bnfc2_name->CurrentValue, NULL, FALSE);

		// bnfc2_rel
		$members->bnfc2_rel->SetDbValueDef($rsnew, $members->bnfc2_rel->CurrentValue, NULL, FALSE);

		// bnfc3_name
		$members->bnfc3_name->SetDbValueDef($rsnew, $members->bnfc3_name->CurrentValue, NULL, FALSE);

		// bnfc3_rel
		$members->bnfc3_rel->SetDbValueDef($rsnew, $members->bnfc3_rel->CurrentValue, NULL, FALSE);

		// regis_date
		$members->regis_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($members->regis_date->CurrentValue, 7), NULL, FALSE);

		// effective_date
		$members->effective_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($members->effective_date->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// attachment
		$members->attachment->SetDbValueDef($rsnew, $members->attachment->CurrentValue, NULL, FALSE);

		// note
		$members->note->SetDbValueDef($rsnew, $members->note->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $members->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($members->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($members->CancelMessage <> "") {
				$this->setFailureMessage($members->CancelMessage);
				$members->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$members->member_id->setDbValue($conn->Insert_ID());
			$rsnew['member_id'] = $members->member_id->DbValue;
		}

		// Add detail records
		if ($AddRow) {
			if ($members->getCurrentDetailTable() == "memberupdatelog" && $GLOBALS["memberupdatelog"]->DetailAdd) {
				$GLOBALS["memberupdatelog"]->member_code->setSessionValue($members->member_code->CurrentValue); // Set master key
				$memberupdatelog_grid = new cmemberupdatelog_grid(); // get detail page object
				$AddRow = $memberupdatelog_grid->GridInsert();
				$memberupdatelog_grid = NULL;
			}
		}

		// Commit/Rollback transaction
		if ($members->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$members->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {
		global $members;
		$bValidDetail = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$members->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $members->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			if ($sDetailTblVar == "memberupdatelog") {
				if (!isset($GLOBALS["memberupdatelog"]))
					$GLOBALS["memberupdatelog"] = new cmemberupdatelog;
				if ($GLOBALS["memberupdatelog"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["memberupdatelog"]->CurrentMode = "copy";
					else
						$GLOBALS["memberupdatelog"]->CurrentMode = "add";
					$GLOBALS["memberupdatelog"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["memberupdatelog"]->setCurrentMasterTable($members->TableVar);
					$GLOBALS["memberupdatelog"]->setStartRecordNumber(1);
					$GLOBALS["memberupdatelog"]->member_code->FldIsDetailKey = TRUE;
					$GLOBALS["memberupdatelog"]->member_code->CurrentValue = $members->member_code->CurrentValue;
					$GLOBALS["memberupdatelog"]->member_code->setSessionValue($GLOBALS["memberupdatelog"]->member_code->CurrentValue);
				}
			}
		}
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
