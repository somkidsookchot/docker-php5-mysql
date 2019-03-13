<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "refundableinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$refundable_edit = new crefundable_edit();
$Page =& $refundable_edit;

// Page init
$refundable_edit->Page_Init();

// Page main
$refundable_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var refundable_edit = new ew_Page("refundable_edit");

// page properties
refundable_edit.PageID = "edit"; // page ID
refundable_edit.FormID = "frefundableedit"; // form ID
var EW_PAGE_ID = refundable_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
refundable_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_refund_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($refundable->refund_status->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pay_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($refundable->pay_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pay_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($refundable->pay_date->FldErrMsg()) ?>");

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
refundable_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
refundable_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
refundable_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
refundable_edit.ValidateRequired = false; // no JavaScript validation
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
<div class="phpmaker ewTitle"><img src="images/finance55x55.png" width="55" height="55" align="absmiddle" /><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $refundable->TableCaption() ?></div>
<div class="clear"></div>
<?php $refundable_edit->ShowPageHeader(); ?>
<?php
$refundable_edit->ShowMessage();
?>
<form name="frefundableedit" id="frefundableedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return refundable_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="refundable">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($refundable->member_code->Visible) { // member_code ?>
	<tr id="r_member_code"<?php echo $refundable->RowAttributes() ?>>
		<td width="170" class="ewTableHeader"><?php echo $refundable->member_code->FldCaption() ?></td>
		<td<?php echo $refundable->member_code->CellAttributes() ?>><span id="el_member_code">
<div<?php echo $refundable->member_code->ViewAttributes() ?>><?php echo $refundable->member_code->EditValue ?></div>
<input type="hidden" name="x_member_code" id="x_member_code" value="<?php echo ew_HtmlEncode($refundable->member_code->CurrentValue) ?>">
</span><?php echo $refundable->member_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($refundable->refund_status->Visible) { // refund_status ?>
	<tr id="r_refund_status"<?php echo $refundable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $refundable->refund_status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $refundable->refund_status->CellAttributes() ?>><span id="el_refund_status">
<select id="x_refund_status" name="x_refund_status"<?php echo $refundable->refund_status->EditAttributes() ?>>
<?php
if (is_array($refundable->refund_status->EditValue)) {
	$arwrk = $refundable->refund_status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($refundable->refund_status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $refundable->refund_status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($refundable->pay_date->Visible) { // pay_date ?>
	<tr id="r_pay_date"<?php echo $refundable->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $refundable->pay_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $refundable->pay_date->CellAttributes() ?>><span id="el_pay_date">
<input type="text" name="x_pay_date" id="x_pay_date" value="<?php echo $refundable->pay_date->EditValue ?>"<?php echo $refundable->pay_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_pay_date" name="cal_x_pay_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_pay_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_pay_date" // button id
});
</script>
</span><?php echo $refundable->pay_date->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_refund_id" id="x_refund_id" value="<?php echo ew_HtmlEncode($refundable->refund_id->CurrentValue) ?>">
<p><a href="<?php echo $refundable->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$refundable_edit->ShowPageFooter();
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
$refundable_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class crefundable_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'refundable';

	// Page object name
	var $PageObjName = 'refundable_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $refundable;
		if ($refundable->UseTokenInUrl) $PageUrl .= "t=" . $refundable->TableVar . "&"; // Add page token
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
		global $objForm, $refundable;
		if ($refundable->UseTokenInUrl) {
			if ($objForm)
				return ($refundable->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($refundable->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crefundable_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (refundable)
		if (!isset($GLOBALS["refundable"])) {
			$GLOBALS["refundable"] = new crefundable();
			$GLOBALS["Table"] =& $GLOBALS["refundable"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'refundable', TRUE);

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
		global $refundable;

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
		global $objForm, $Language, $gsFormError, $refundable;

		// Load key from QueryString
		if (@$_GET["refund_id"] <> "")
			$refundable->refund_id->setQueryStringValue($_GET["refund_id"]);
		if (@$_POST["a_edit"] <> "") {
			$refundable->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$refundable->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$refundable->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$refundable->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($refundable->refund_id->CurrentValue == "")
			$this->Page_Terminate("refundablelist.php"); // Invalid key, return to list
		switch ($refundable->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("refundablelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$refundable->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $refundable->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "refundableview.php")
						$sReturnUrl = $refundable->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$refundable->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$refundable->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$refundable->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $refundable;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $refundable;
		if (!$refundable->member_code->FldIsDetailKey) {
			$refundable->member_code->setFormValue($objForm->GetValue("x_member_code"));
		}
		if (!$refundable->refund_status->FldIsDetailKey) {
			$refundable->refund_status->setFormValue($objForm->GetValue("x_refund_status"));
		}
		if (!$refundable->pay_date->FldIsDetailKey) {
			$refundable->pay_date->setFormValue($objForm->GetValue("x_pay_date"));
			$refundable->pay_date->CurrentValue = ew_UnFormatDateTime($refundable->pay_date->CurrentValue, 7);
		}
		if (!$refundable->refund_id->FldIsDetailKey)
			$refundable->refund_id->setFormValue($objForm->GetValue("x_refund_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $refundable;
		$this->LoadRow();
		$refundable->refund_id->CurrentValue = $refundable->refund_id->FormValue;
		$refundable->member_code->CurrentValue = $refundable->member_code->FormValue;
		$refundable->refund_status->CurrentValue = $refundable->refund_status->FormValue;
		$refundable->pay_date->CurrentValue = $refundable->pay_date->FormValue;
		$refundable->pay_date->CurrentValue = ew_UnFormatDateTime($refundable->pay_date->CurrentValue, 7);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $refundable;
		$sFilter = $refundable->KeyFilter();

		// Call Row Selecting event
		$refundable->Row_Selecting($sFilter);

		// Load SQL based on filter
		$refundable->CurrentFilter = $sFilter;
		$sSql = $refundable->SQL();
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
		global $conn, $refundable;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$refundable->Row_Selected($row);
		$refundable->refund_id->setDbValue($rs->fields('refund_id'));
		$refundable->member_code->setDbValue($rs->fields('member_code'));
		$refundable->refund_total->setDbValue($rs->fields('refund_total'));
		$refundable->assc_percent->setDbValue($rs->fields('assc_percent'));
		$refundable->assc_total->setDbValue($rs->fields('assc_total'));
		$refundable->sub_total->setDbValue($rs->fields('sub_total'));
		$refundable->refund_status->setDbValue($rs->fields('refund_status'));
		$refundable->pay_date->setDbValue($rs->fields('pay_date'));
		$refundable->calculate_date->setDbValue($rs->fields('calculate_date'));
		$refundable->refund_slipt_num->setDbValue($rs->fields('refund_slipt_num'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $refundable;

		// Initialize URLs
		// Call Row_Rendering event

		$refundable->Row_Rendering();

		// Common render codes for all row types
		// refund_id
		// member_code
		// refund_total
		// assc_percent
		// assc_total
		// sub_total
		// refund_status
		// pay_date
		// calculate_date
		// refund_slipt_num

		if ($refundable->RowType == EW_ROWTYPE_VIEW) { // View row

			// member_code
			$refundable->member_code->ViewValue = $refundable->member_code->CurrentValue;
			if (strval($refundable->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($refundable->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$refundable->member_code->ViewValue = $rswrk->fields('member_code');
					$refundable->member_code->ViewValue .= ew_ValueSeparator(0,1,$refundable->member_code) . $rswrk->fields('fname');
					$refundable->member_code->ViewValue .= ew_ValueSeparator(0,2,$refundable->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$refundable->member_code->ViewValue = $refundable->member_code->CurrentValue;
				}
			} else {
				$refundable->member_code->ViewValue = NULL;
			}
			$refundable->member_code->ViewCustomAttributes = "";

			// refund_total
			$refundable->refund_total->ViewValue = $refundable->refund_total->CurrentValue;
			$refundable->refund_total->ViewValue = ew_FormatCurrency($refundable->refund_total->ViewValue, 0, -2, -2, -2);
			$refundable->refund_total->ViewCustomAttributes = "";

			// assc_percent
			$refundable->assc_percent->ViewValue = $refundable->assc_percent->CurrentValue;
			$refundable->assc_percent->ViewCustomAttributes = "";

			// assc_total
			$refundable->assc_total->ViewValue = $refundable->assc_total->CurrentValue;
			$refundable->assc_total->ViewValue = ew_FormatCurrency($refundable->assc_total->ViewValue, 0, -2, -2, -2);
			$refundable->assc_total->ViewCustomAttributes = "";

			// sub_total
			$refundable->sub_total->ViewValue = $refundable->sub_total->CurrentValue;
			$refundable->sub_total->ViewValue = ew_FormatCurrency($refundable->sub_total->ViewValue, 0, -2, -2, -2);
			$refundable->sub_total->ViewCustomAttributes = "";

			// refund_status
			if (strval($refundable->refund_status->CurrentValue) <> "") {
				switch ($refundable->refund_status->CurrentValue) {
					case "รอจ่าย":
						$refundable->refund_status->ViewValue = $refundable->refund_status->FldTagCaption(1) <> "" ? $refundable->refund_status->FldTagCaption(1) : $refundable->refund_status->CurrentValue;
						break;
					case "จ่ายแล้ว":
						$refundable->refund_status->ViewValue = $refundable->refund_status->FldTagCaption(2) <> "" ? $refundable->refund_status->FldTagCaption(2) : $refundable->refund_status->CurrentValue;
						break;
					default:
						$refundable->refund_status->ViewValue = $refundable->refund_status->CurrentValue;
				}
			} else {
				$refundable->refund_status->ViewValue = NULL;
			}
			$refundable->refund_status->ViewCustomAttributes = "";

			// pay_date
			$refundable->pay_date->ViewValue = $refundable->pay_date->CurrentValue;
			$refundable->pay_date->ViewValue = ew_FormatDateTime($refundable->pay_date->ViewValue, 7);
			$refundable->pay_date->ViewCustomAttributes = "";

			// refund_slipt_num
			$refundable->refund_slipt_num->ViewValue = $refundable->refund_slipt_num->CurrentValue;
			$refundable->refund_slipt_num->ViewCustomAttributes = "";

			// member_code
			$refundable->member_code->LinkCustomAttributes = "";
			$refundable->member_code->HrefValue = "";
			$refundable->member_code->TooltipValue = "";

			// refund_status
			$refundable->refund_status->LinkCustomAttributes = "";
			$refundable->refund_status->HrefValue = "";
			$refundable->refund_status->TooltipValue = "";

			// pay_date
			$refundable->pay_date->LinkCustomAttributes = "";
			$refundable->pay_date->HrefValue = "";
			$refundable->pay_date->TooltipValue = "";
		} elseif ($refundable->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// member_code
			$refundable->member_code->EditCustomAttributes = "";
			$refundable->member_code->EditValue = $refundable->member_code->CurrentValue;
			if (strval($refundable->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($refundable->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$refundable->member_code->EditValue = $rswrk->fields('member_code');
					$refundable->member_code->EditValue .= ew_ValueSeparator(0,1,$refundable->member_code) . $rswrk->fields('fname');
					$refundable->member_code->EditValue .= ew_ValueSeparator(0,2,$refundable->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$refundable->member_code->EditValue = $refundable->member_code->CurrentValue;
				}
			} else {
				$refundable->member_code->EditValue = NULL;
			}
			$refundable->member_code->ViewCustomAttributes = "";

			// refund_status
			$refundable->refund_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("รอจ่าย", $refundable->refund_status->FldTagCaption(1) <> "" ? $refundable->refund_status->FldTagCaption(1) : "รอจ่าย");
			$arwrk[] = array("จ่ายแล้ว", $refundable->refund_status->FldTagCaption(2) <> "" ? $refundable->refund_status->FldTagCaption(2) : "จ่ายแล้ว");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$refundable->refund_status->EditValue = $arwrk;

			// pay_date
			$refundable->pay_date->EditCustomAttributes = "";
			$refundable->pay_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($refundable->pay_date->CurrentValue, 7));

			// Edit refer script
			// member_code

			$refundable->member_code->HrefValue = "";

			// refund_status
			$refundable->refund_status->HrefValue = "";

			// pay_date
			$refundable->pay_date->HrefValue = "";
		}
		if ($refundable->RowType == EW_ROWTYPE_ADD ||
			$refundable->RowType == EW_ROWTYPE_EDIT ||
			$refundable->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$refundable->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($refundable->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$refundable->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $refundable;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($refundable->refund_status->FormValue) && $refundable->refund_status->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $refundable->refund_status->FldCaption());
		}
		if (!is_null($refundable->pay_date->FormValue) && $refundable->pay_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $refundable->pay_date->FldCaption());
		}
		if (!ew_CheckEuroDate($refundable->pay_date->FormValue)) {
			ew_AddMessage($gsFormError, $refundable->pay_date->FldErrMsg());
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
		global $conn, $Security, $Language, $refundable;
		$sFilter = $refundable->KeyFilter();
		$refundable->CurrentFilter = $sFilter;
		$sSql = $refundable->SQL();
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

			// refund_status
			$refundable->refund_status->SetDbValueDef($rsnew, $refundable->refund_status->CurrentValue, "", $refundable->refund_status->ReadOnly);

			// pay_date
			$refundable->pay_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($refundable->pay_date->CurrentValue, 7), ew_CurrentDate(), $refundable->pay_date->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $refundable->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($refundable->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($refundable->CancelMessage <> "") {
					$this->setFailureMessage($refundable->CancelMessage);
					$refundable->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$refundable->Row_Updated($rsold, $rsnew);
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
