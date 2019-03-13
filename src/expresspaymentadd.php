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
$expresspayment_add = new cexpresspayment_add();
$Page =& $expresspayment_add;

// Page init
$expresspayment_add->Page_Init();

// Page main
$expresspayment_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expresspayment_add = new ew_Page("expresspayment_add");

// page properties
expresspayment_add.PageID = "add"; // page ID
expresspayment_add.FormID = "fexpresspaymentadd"; // form ID
var EW_PAGE_ID = expresspayment_add.PageID; // for backward compatibility

// extend page with ValidateForm function
expresspayment_add.ValidateForm = function(fobj) {
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
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expresspayment->rc_total->FldCaption()) ?>");
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
expresspayment_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expresspayment_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expresspayment_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expresspayment_add.ValidateRequired = false; // no JavaScript validation
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
function getTotal(village){
	
	if(village) {
	
		getDataReturnText('gettotal.php?village_id='+village+'&type=1',displaySubvTotal);
		getDataReturnText('gettotal.php?village_id='+village+'&type=2',displayAdvTotal);
		getDataReturnText('gettotal.php?village_id='+village+'&type=3',displayAnnualTotal);
		getDataReturnText('gettotal.php?village_id='+village+'&type=4',displayRegisTotal);
		getDataReturnText('gettotal.php?village_id='+village+'&type=5',displayOtherTotal);
		getDataReturnText('gettotal.php?village_id='+village+'&type=9',displayRcTotal);
		
		
	}

}
function displaySubvTotal(text){
     
	document.getElementById("subvtotal").innerHTML = text;
}
function displayAdvTotal(text){
     
	document.getElementById("advtotal").innerHTML = text;
}
function displayAnnualTotal(text){
     
	document.getElementById("annualtotal").innerHTML = text;
}
function displayRegisTotal(text){
     
	document.getElementById("registotal").innerHTML = text;
}
function displayOtherTotal(text){
     
	document.getElementById("othertotal").innerHTML = text;
}
function displayRcTotal(text){
     
	document.getElementById("rctotal").innerHTML = text;
}
function fblur(obj){
	if(obj.value == '') obj.value = '0';
	else return false;
}
// Write your client script here, no need to add script tags.
//-->

</script>
<div class="phpmaker ewTitle"><img src="images/ico_paid.png" width="40" height="40" align="absmiddle" /> <?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expresspayment->TableCaption() ?>
</a></div>
<div class="clear"></div><br />

<?php $expresspayment_add->ShowPageHeader(); ?>
<?php
$expresspayment_add->ShowMessage();
?>
<form name="fexpresspaymentadd" id="fexpresspaymentadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return expresspayment_add.ValidateForm(this);">

<input type="hidden" name="t" id="t" value="expresspayment">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($expresspayment->t_code->Visible) { // t_code ?>
	<tr id="r_t_code"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->t_code->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
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
  <select id="x_village_id" name="x_village_id" onchange="getTotal(options[selectedIndex].value)">
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
	<tr<?php echo $expresspayment->RowAttributes() ?>>
	  <td class="ewTableHeader">&nbsp;</td>
	  <td<?php echo $expresspayment->subv_total->CellAttributes() ?>><table>
	    <tr class="ewTable"<?php echo $expresspayment->RowAttributes() ?>>
	      <td width="120" align="center"<?php echo $expresspayment->subv_total->CellAttributes() ?>>ยอดค้างชำระสุทธิ</td>
	      <td width="180" align="center"<?php echo $expresspayment->subv_total->CellAttributes() ?>>จำนวนเงินที่ชำระ</td>
	      <td width="300" align="center"<?php echo $expresspayment->subv_total->CellAttributes() ?>>รายละเอียด/หมายเหตุ</td>
	      </tr>
	    </table></td>
	  </tr>
	<tr id="r_subv_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->subv_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->subv_total->CellAttributes() ?>><table>
		  <tr class="ewTable" id="r_subv_total2"<?php echo $expresspayment->RowAttributes() ?>>
		    <td width="120" align="right"<?php echo $expresspayment->subv_total->CellAttributes() ?>><span id="subvtotal">0</span></td>
		    <td width="180" align="center"<?php echo $expresspayment->subv_total->CellAttributes() ?>><span id="el_subv_total">
		      <input type="text" name="x_subv_total" id="x_subv_total" size="20" value="<?php echo $expresspayment->subv_total->EditValue ?>" onclick="this.value=''" onblur="javascript:;fblur(this)"/>
		      </span><?php echo $expresspayment->subv_total->CustomMsg ?></td>
		    <td width="300" align="center"<?php echo $expresspayment->subv_total->CellAttributes() ?>><span id="el_subv_detail">
		      <input type="text" name="x_subv_detail" id="x_subv_detail" size="40" maxlength="100" value="<?php echo $expresspayment->subv_detail->EditValue ?>"<?php echo $expresspayment->subv_detail->EditAttributes() ?> />
		      </span><?php echo $expresspayment->subv_detail->CustomMsg ?> </td>
		    </tr>
		  </table></td>
		</tr>
<?php } ?>
<?php if ($expresspayment->subv_detail->Visible) { // subv_detail ?>
	<tr id="r_subv_detail"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->adv_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->subv_detail->CellAttributes() ?>><table>
		  <tr class="ewTable" id="r_subv_detail3"<?php echo $expresspayment->RowAttributes() ?>>
		    <td width="120" align="right"<?php echo $expresspayment->subv_detail->CellAttributes() ?>><span id="advtotal">0</span></td>
		    <td width="180" align="center"<?php echo $expresspayment->subv_detail->CellAttributes() ?>><span id="el_adv_total">
		      <input type="text" name="x_adv_total" id="x_adv_total" size="20" value="<?php echo $expresspayment->adv_total->EditValue ?>" onclick="this.value=''" onblur="javascript:;fblur(this)"/>
		      </span><?php echo $expresspayment->adv_total->CustomMsg ?></td>
		    <td width="300" align="center"<?php echo $expresspayment->subv_detail->CellAttributes() ?>><span id="el_adv_detail">
		      <input type="text" name="x_adv_detail" id="x_adv_detail" size="40" maxlength="100" value="<?php echo $expresspayment->adv_detail->EditValue ?>"<?php echo $expresspayment->adv_detail->EditAttributes() ?> />
		      </span><?php echo $expresspayment->adv_detail->CustomMsg ?></td>
		    </tr>
		  </table></td>
		</tr>
<?php } ?>
<?php if ($expresspayment->rc_total->Visible) { // rc_total ?>
	<tr id="r_rc_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->rc_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->rc_total->CellAttributes() ?>><table>
		  <tr>
    <td width="120" align="right"><span id="rctotal">0</span></td>
    <td width="180" align="center">
      <input type="text" name="x_rc_total" id="x_rc_total" size="20" value="<?php echo $expresspayment->rc_total->EditValue ?>" onclick="this.value=''" onblur="javascript:;fblur(this)"/>
    <?php echo $expresspayment->rc_total->CustomMsg ?></td>
		    <td width="300" align="center"><span id="el_rc_detail">
<input type="text" name="x_rc_detail" id="x_rc_detail" size="40" maxlength="100" value="<?php echo $expresspayment->rc_detail->EditValue ?>"<?php echo $expresspayment->rc_detail->EditAttributes() ?>>
</span><?php echo $expresspayment->rc_detail->CustomMsg ?></td>
  </tr>
</table></td>
	</tr>
<?php } ?>
<?php if ($expresspayment->rc_detail->Visible) { // rc_detail ?>
	<?php } ?>
<?php if ($expresspayment->adv_total->Visible) { // adv_total ?>
	<tr id="r_adv_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->annual_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->adv_total->CellAttributes() ?>><table>
		  <tr class="ewTable" id="r_adv_total3"<?php echo $expresspayment->RowAttributes() ?>>
		    <td width="120" align="right"<?php echo $expresspayment->adv_total->CellAttributes() ?>><span id="annualtotal">0</span></td>
		    <td width="180" align="center"<?php echo $expresspayment->adv_total->CellAttributes() ?>><span id="el_annual_total2">
		      <input type="text" name="x_annual_total" id="x_annual_total" size="20" value="<?php echo $expresspayment->annual_total->EditValue ?>" onclick="this.value=''" onblur="javascript:;fblur(this)" />
		      </span><?php echo $expresspayment->annual_total->CustomMsg ?></td>
		    <td width="300" align="center"<?php echo $expresspayment->adv_total->CellAttributes() ?>><span id="el_annual_detail2">
		      <input type="text" name="x_annual_detail" id="x_annual_detail" size="40" maxlength="100" value="<?php echo $expresspayment->annual_detail->EditValue ?>"<?php echo $expresspayment->annual_detail->EditAttributes() ?> />
		      </span><?php echo $expresspayment->annual_detail->CustomMsg ?></td>
		    </tr>
		  </table></td>
		</tr>
<?php } ?>
<?php if ($expresspayment->adv_detail->Visible) { // adv_detail ?>
	<?php } ?>
<?php if ($expresspayment->annual_total->Visible) { // annual_total ?>
	<?php } ?>
<?php if ($expresspayment->annual_detail->Visible) { // annual_detail ?>
	<?php } ?>
<?php if ($expresspayment->regis_total->Visible) { // regis_total ?>
	<tr id="r_regis_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->regis_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->regis_total->CellAttributes() ?>><table>
		  <tr class="ewTable" id="r_regis_total3"<?php echo $expresspayment->RowAttributes() ?>>
		    <td width="120" align="right"<?php echo $expresspayment->regis_total->CellAttributes() ?>><span id="registotal">0</span></td>
		    <td width="180" align="center"<?php echo $expresspayment->regis_total->CellAttributes() ?>><span id="el_regis_total2">
		      <input type="text" name="x_regis_total" id="x_regis_total" size="20" value="<?php echo $expresspayment->regis_total->EditValue ?>" onclick="this.value=''" onblur="javascript:;fblur(this)" />
		      </span><?php echo $expresspayment->regis_total->CustomMsg ?></td>
		    <td width="300" align="center"<?php echo $expresspayment->regis_total->CellAttributes() ?>><span id="el_regis_detail2">
		      <input type="text" name="x_regis_detail" id="x_regis_detail" size="40" maxlength="100" value="<?php echo $expresspayment->regis_detail->EditValue ?>"<?php echo $expresspayment->regis_detail->EditAttributes() ?> />
		      </span><?php echo $expresspayment->regis_detail->CustomMsg ?></td>
		    </tr>
		  </table></td>
		</tr>
<?php } ?>
<?php if ($expresspayment->regis_detail->Visible) { // regis_detail ?>
	<?php } ?>
<?php if ($expresspayment->other_total->Visible) { // other_total ?>
	<tr id="r_other_total"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->other_total->FldCaption() ?></td>
		<td<?php echo $expresspayment->other_total->CellAttributes() ?>><table>
		  <tr class="ewTable" id="r_other_total3"<?php echo $expresspayment->RowAttributes() ?>>
		    <td width="120" align="right"<?php echo $expresspayment->other_total->CellAttributes() ?>><span id="othertotal">0</span></td>
		    <td width="180" align="center"<?php echo $expresspayment->other_total->CellAttributes() ?>><span id="el_other_total2">
		      <input type="text" name="x_other_total" id="x_other_total" size="20" value="<?php echo $expresspayment->other_total->EditValue ?>" onclick="this.value=''" onblur="javascript:;fblur(this)" />
		      </span><?php echo $expresspayment->other_total->CustomMsg ?></td>
		    <td width="300" align="center"<?php echo $expresspayment->other_total->CellAttributes() ?>><span id="el_other_detail2">
		      <input type="text" name="x_other_detail" id="x_other_detail" size="40" maxlength="100" value="<?php echo $expresspayment->other_detail->EditValue ?>"<?php echo $expresspayment->other_detail->EditAttributes() ?> />
		      </span><?php echo $expresspayment->other_detail->CustomMsg ?></td>
		    </tr>
		  </table></td>
		</tr>
<?php } ?>
<?php if ($expresspayment->other_detail->Visible) { // other_detail ?>
	<?php } ?>
<?php if ($expresspayment->expr_note->Visible) { // expr_note ?>
	<tr id="r_expr_note"<?php echo $expresspayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expresspayment->expr_note->FldCaption() ?></td>
		<td<?php echo $expresspayment->expr_note->CellAttributes() ?>><span id="el_expr_note">
  <textarea name="x_expr_note" id="x_expr_note" cols="95" rows="4"<?php echo $expresspayment->expr_note->EditAttributes() ?>><?php echo $expresspayment->expr_note->EditValue ?></textarea>
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
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_village_id','x_t_code',false],
['x_t_code','x_t_code',false]]);

//-->
</script>
<?php
$expresspayment_add->ShowPageFooter();
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
$expresspayment_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpresspayment_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'expresspayment';

	// Page object name
	var $PageObjName = 'expresspayment_add';

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
	function cexpresspayment_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $expresspayment;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$expresspayment->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$expresspayment->CurrentAction = "I"; // Form error, reset action
				$expresspayment->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["expr_id"] != "") {
				$expresspayment->expr_id->setQueryStringValue($_GET["expr_id"]);
				$expresspayment->setKey("expr_id", $expresspayment->expr_id->CurrentValue); // Set up key
			} else {
				$expresspayment->setKey("expr_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$expresspayment->CurrentAction = "C"; // Copy record
			} else {
				$expresspayment->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($expresspayment->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("expresspaymentlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$expresspayment->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $expresspayment->ViewUrl();
					if (ew_GetPageName($sReturnUrl) == "expresspaymentview.php")
						$sReturnUrl = $expresspayment->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$expresspayment->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$expresspayment->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $expresspayment;
		$expresspayment->t_code->CurrentValue = NULL;
		$expresspayment->t_code->OldValue = $expresspayment->t_code->CurrentValue;
		$expresspayment->village_id->CurrentValue = NULL;
		$expresspayment->village_id->OldValue = $expresspayment->village_id->CurrentValue;
		$expresspayment->subv_total->CurrentValue = 0;
		$expresspayment->subv_detail->CurrentValue = NULL;
		$expresspayment->subv_detail->OldValue = $expresspayment->subv_detail->CurrentValue;
		$expresspayment->adv_total->CurrentValue = 0;
		$expresspayment->adv_detail->CurrentValue = NULL;
		$expresspayment->adv_detail->OldValue = $expresspayment->adv_detail->CurrentValue;
$expresspayment->rc_total->CurrentValue = 0;
		$expresspayment->rc_detail->CurrentValue = NULL;
		$expresspayment->rc_detail->OldValue = $expresspayment->rc_detail->CurrentValue;
		$expresspayment->annual_total->CurrentValue = 0;
		$expresspayment->annual_detail->CurrentValue = NULL;
		$expresspayment->annual_detail->OldValue = $expresspayment->annual_detail->CurrentValue;
		$expresspayment->regis_total->CurrentValue = 0;
		$expresspayment->regis_detail->CurrentValue = NULL;
		$expresspayment->regis_detail->OldValue = $expresspayment->regis_detail->CurrentValue;
		$expresspayment->other_total->CurrentValue = 0;
		$expresspayment->other_detail->CurrentValue = NULL;
		$expresspayment->other_detail->OldValue = $expresspayment->other_detail->CurrentValue;
		$expresspayment->expr_note->CurrentValue = NULL;
		$expresspayment->expr_note->OldValue = $expresspayment->expr_note->CurrentValue;
		$expresspayment->expr_pay_date->CurrentValue = NULL;
		$expresspayment->expr_pay_date->OldValue = $expresspayment->expr_pay_date->CurrentValue;
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
		if (!$expresspayment->expr_note->FldIsDetailKey) {
			$expresspayment->expr_note->setFormValue($objForm->GetValue("x_expr_note"));
		}
		if (!$expresspayment->expr_pay_date->FldIsDetailKey) {
			$expresspayment->expr_pay_date->setFormValue($objForm->GetValue("x_expr_pay_date"));
			$expresspayment->expr_pay_date->CurrentValue = ew_UnFormatDateTime($expresspayment->expr_pay_date->CurrentValue, 7);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $expresspayment;
		$this->LoadOldRecord();
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
		$expresspayment->expr_note->CurrentValue = $expresspayment->expr_note->FormValue;
		$expresspayment->expr_pay_date->CurrentValue = $expresspayment->expr_pay_date->FormValue;
		$expresspayment->expr_pay_date->CurrentValue = ew_UnFormatDateTime($expresspayment->expr_pay_date->CurrentValue, 7);
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

	// Load old record
	function LoadOldRecord() {
		global $expresspayment;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($expresspayment->getKey("expr_id")) <> "")
			$expresspayment->expr_id->CurrentValue = $expresspayment->getKey("expr_id"); // expr_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$expresspayment->CurrentFilter = $expresspayment->KeyFilter();
			$sSql = $expresspayment->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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

			// expr_note
			$expresspayment->expr_note->ViewValue = $expresspayment->expr_note->CurrentValue;
			$expresspayment->expr_note->ViewCustomAttributes = "";

			// expr_pay_date
			$expresspayment->expr_pay_date->ViewValue = $expresspayment->expr_pay_date->CurrentValue;
			$expresspayment->expr_pay_date->ViewValue = ew_FormatDateTime($expresspayment->expr_pay_date->ViewValue, 7);
			$expresspayment->expr_pay_date->ViewCustomAttributes = "";

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

			// expr_note
			$expresspayment->expr_note->LinkCustomAttributes = "";
			$expresspayment->expr_note->HrefValue = "";
			$expresspayment->expr_note->TooltipValue = "";

			// expr_pay_date
			$expresspayment->expr_pay_date->LinkCustomAttributes = "";
			$expresspayment->expr_pay_date->HrefValue = "";
			$expresspayment->expr_pay_date->TooltipValue = "";
		} elseif ($expresspayment->RowType == EW_ROWTYPE_ADD) { // Add row

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

			// expr_note
			$expresspayment->expr_note->EditCustomAttributes = "";
			$expresspayment->expr_note->EditValue = ew_HtmlEncode($expresspayment->expr_note->CurrentValue);

			// expr_pay_date
			$expresspayment->expr_pay_date->EditCustomAttributes = "";
			$expresspayment->expr_pay_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($expresspayment->expr_pay_date->CurrentValue, 7));

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

			// expr_note
			$expresspayment->expr_note->HrefValue = "";

			// expr_pay_date
			$expresspayment->expr_pay_date->HrefValue = "";
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
		if (!is_null($expresspayment->rc_total->FormValue) && $expresspayment->rc_total->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expresspayment->rc_total->FldCaption());
		}
		if (!ew_CheckNumber($expresspayment->rc_total->FormValue)) {
			ew_AddMessage($gsFormError, $expresspayment->rc_total->FldErrMsg());
		}
		if (!is_null($expresspayment->rc_detail->FormValue) && $expresspayment->rc_detail->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expresspayment->rc_detail->FldCaption());
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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $expresspayment;
		$rsnew = array();

		// t_code
		$expresspayment->t_code->SetDbValueDef($rsnew, $expresspayment->t_code->CurrentValue, "", FALSE);

		// village_id
		$expresspayment->village_id->SetDbValueDef($rsnew, $expresspayment->village_id->CurrentValue, 0, FALSE);

		// subv_total
		$expresspayment->subv_total->SetDbValueDef($rsnew, $expresspayment->subv_total->CurrentValue, 0, strval($expresspayment->subv_total->CurrentValue) == "");

		// subv_detail
		$expresspayment->subv_detail->SetDbValueDef($rsnew, $expresspayment->subv_detail->CurrentValue, NULL, FALSE);

		// adv_total
		$expresspayment->adv_total->SetDbValueDef($rsnew, $expresspayment->adv_total->CurrentValue, 0, strval($expresspayment->adv_total->CurrentValue) == "");

		// adv_detail
		$expresspayment->adv_detail->SetDbValueDef($rsnew, $expresspayment->adv_detail->CurrentValue, NULL, FALSE);
	// rc_total
		$expresspayment->rc_total->SetDbValueDef($rsnew, $expresspayment->rc_total->CurrentValue, 0, strval($expresspayment->rc_total->CurrentValue) == "");

		// rc_detail
		$expresspayment->rc_detail->SetDbValueDef($rsnew, $expresspayment->rc_detail->CurrentValue, "", FALSE);

		// annual_total
		$expresspayment->annual_total->SetDbValueDef($rsnew, $expresspayment->annual_total->CurrentValue, 0, strval($expresspayment->annual_total->CurrentValue) == "");

		// annual_detail
		$expresspayment->annual_detail->SetDbValueDef($rsnew, $expresspayment->annual_detail->CurrentValue, NULL, FALSE);

		// regis_total
		$expresspayment->regis_total->SetDbValueDef($rsnew, $expresspayment->regis_total->CurrentValue, 0, strval($expresspayment->regis_total->CurrentValue) == "");

		// regis_detail
		$expresspayment->regis_detail->SetDbValueDef($rsnew, $expresspayment->regis_detail->CurrentValue, NULL, FALSE);

		// other_total
		$expresspayment->other_total->SetDbValueDef($rsnew, $expresspayment->other_total->CurrentValue, 0, strval($expresspayment->other_total->CurrentValue) == "");

		// other_detail
		$expresspayment->other_detail->SetDbValueDef($rsnew, $expresspayment->other_detail->CurrentValue, NULL, FALSE);

		// expr_note
		$expresspayment->expr_note->SetDbValueDef($rsnew, $expresspayment->expr_note->CurrentValue, NULL, FALSE);

		// expr_pay_date
		$expresspayment->expr_pay_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($expresspayment->expr_pay_date->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $expresspayment->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($expresspayment->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($expresspayment->CancelMessage <> "") {
				$this->setFailureMessage($expresspayment->CancelMessage);
				$expresspayment->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$expresspayment->expr_id->setDbValue($conn->Insert_ID());
			$rsnew['expr_id'] = $expresspayment->expr_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$expresspayment->Row_Inserted($rs, $rsnew);
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
