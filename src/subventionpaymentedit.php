<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subventionpaymentinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subventionpayment_edit = new csubventionpayment_edit();
$Page =& $subventionpayment_edit;

// Page init
$subventionpayment_edit->Page_Init();

// Page main
$subventionpayment_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subventionpayment_edit = new ew_Page("subventionpayment_edit");

// page properties
subventionpayment_edit.PageID = "edit"; // page ID
subventionpayment_edit.FormID = "fsubventionpaymentedit"; // form ID
var EW_PAGE_ID = subventionpayment_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
subventionpayment_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_dead_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subventionpayment->dead_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_payment_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subventionpayment->payment_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_payment_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subventionpayment->payment_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_subvent_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subventionpayment->subvent_total->FldErrMsg()) ?>");

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
subventionpayment_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subventionpayment_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subventionpayment_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subventionpayment_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subventionpayment->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $subventionpayment->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $subventionpayment_edit->ShowPageHeader(); ?>
<?php
$subventionpayment_edit->ShowMessage();
?>
<form name="fsubventionpaymentedit" id="fsubventionpaymentedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return subventionpayment_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="subventionpayment">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($subventionpayment->payment_id->Visible) { // payment_id ?>
	<tr id="r_payment_id"<?php echo $subventionpayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subventionpayment->payment_id->FldCaption() ?></td>
		<td<?php echo $subventionpayment->payment_id->CellAttributes() ?>><span id="el_payment_id">
<div<?php echo $subventionpayment->payment_id->ViewAttributes() ?>><?php echo $subventionpayment->payment_id->EditValue ?></div>
<input type="hidden" name="x_payment_id" id="x_payment_id" value="<?php echo ew_HtmlEncode($subventionpayment->payment_id->CurrentValue) ?>">
</span><?php echo $subventionpayment->payment_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subventionpayment->dead_id->Visible) { // dead_id ?>
	<tr id="r_dead_id"<?php echo $subventionpayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subventionpayment->dead_id->FldCaption() ?></td>
		<td<?php echo $subventionpayment->dead_id->CellAttributes() ?>><span id="el_dead_id">
<input type="text" name="x_dead_id" id="x_dead_id" size="30" value="<?php echo $subventionpayment->dead_id->EditValue ?>"<?php echo $subventionpayment->dead_id->EditAttributes() ?>>
</span><?php echo $subventionpayment->dead_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subventionpayment->payment_date->Visible) { // payment_date ?>
	<tr id="r_payment_date"<?php echo $subventionpayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subventionpayment->payment_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subventionpayment->payment_date->CellAttributes() ?>><span id="el_payment_date">
<input type="text" name="x_payment_date" id="x_payment_date" value="<?php echo $subventionpayment->payment_date->EditValue ?>"<?php echo $subventionpayment->payment_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_payment_date" name="cal_x_payment_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_payment_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_payment_date" // button id
});
</script>
</span><?php echo $subventionpayment->payment_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subventionpayment->subvent_total->Visible) { // subvent_total ?>
	<tr id="r_subvent_total"<?php echo $subventionpayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subventionpayment->subvent_total->FldCaption() ?></td>
		<td<?php echo $subventionpayment->subvent_total->CellAttributes() ?>><span id="el_subvent_total">
<input type="text" name="x_subvent_total" id="x_subvent_total" size="30" value="<?php echo $subventionpayment->subvent_total->EditValue ?>"<?php echo $subventionpayment->subvent_total->EditAttributes() ?>>
</span><?php echo $subventionpayment->subvent_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subventionpayment->payee->Visible) { // payee ?>
	<tr id="r_payee"<?php echo $subventionpayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subventionpayment->payee->FldCaption() ?></td>
		<td<?php echo $subventionpayment->payee->CellAttributes() ?>><span id="el_payee">
<input type="text" name="x_payee" id="x_payee" size="30" maxlength="45" value="<?php echo $subventionpayment->payee->EditValue ?>"<?php echo $subventionpayment->payee->EditAttributes() ?>>
</span><?php echo $subventionpayment->payee->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subventionpayment->pay_des->Visible) { // pay_des ?>
	<tr id="r_pay_des"<?php echo $subventionpayment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subventionpayment->pay_des->FldCaption() ?></td>
		<td<?php echo $subventionpayment->pay_des->CellAttributes() ?>><span id="el_pay_des">
<textarea name="x_pay_des" id="x_pay_des" cols="35" rows="4"<?php echo $subventionpayment->pay_des->EditAttributes() ?>><?php echo $subventionpayment->pay_des->EditValue ?></textarea>
</span><?php echo $subventionpayment->pay_des->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$subventionpayment_edit->ShowPageFooter();
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
$subventionpayment_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class csubventionpayment_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'subventionpayment';

	// Page object name
	var $PageObjName = 'subventionpayment_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subventionpayment;
		if ($subventionpayment->UseTokenInUrl) $PageUrl .= "t=" . $subventionpayment->TableVar . "&"; // Add page token
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
		global $objForm, $subventionpayment;
		if ($subventionpayment->UseTokenInUrl) {
			if ($objForm)
				return ($subventionpayment->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subventionpayment->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubventionpayment_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subventionpayment)
		if (!isset($GLOBALS["subventionpayment"])) {
			$GLOBALS["subventionpayment"] = new csubventionpayment();
			$GLOBALS["Table"] =& $GLOBALS["subventionpayment"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subventionpayment', TRUE);

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
		global $subventionpayment;

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
		global $objForm, $Language, $gsFormError, $subventionpayment;

		// Load key from QueryString
		if (@$_GET["payment_id"] <> "")
			$subventionpayment->payment_id->setQueryStringValue($_GET["payment_id"]);
		if (@$_POST["a_edit"] <> "") {
			$subventionpayment->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$subventionpayment->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$subventionpayment->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$subventionpayment->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($subventionpayment->payment_id->CurrentValue == "")
			$this->Page_Terminate("subventionpaymentlist.php"); // Invalid key, return to list
		switch ($subventionpayment->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("subventionpaymentlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$subventionpayment->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $subventionpayment->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "subventionpaymentview.php")
						$sReturnUrl = $subventionpayment->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$subventionpayment->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$subventionpayment->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$subventionpayment->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $subventionpayment;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $subventionpayment;
		if (!$subventionpayment->payment_id->FldIsDetailKey)
			$subventionpayment->payment_id->setFormValue($objForm->GetValue("x_payment_id"));
		if (!$subventionpayment->dead_id->FldIsDetailKey) {
			$subventionpayment->dead_id->setFormValue($objForm->GetValue("x_dead_id"));
		}
		if (!$subventionpayment->payment_date->FldIsDetailKey) {
			$subventionpayment->payment_date->setFormValue($objForm->GetValue("x_payment_date"));
			$subventionpayment->payment_date->CurrentValue = ew_UnFormatDateTime($subventionpayment->payment_date->CurrentValue, 7);
		}
		if (!$subventionpayment->subvent_total->FldIsDetailKey) {
			$subventionpayment->subvent_total->setFormValue($objForm->GetValue("x_subvent_total"));
		}
		if (!$subventionpayment->payee->FldIsDetailKey) {
			$subventionpayment->payee->setFormValue($objForm->GetValue("x_payee"));
		}
		if (!$subventionpayment->pay_des->FldIsDetailKey) {
			$subventionpayment->pay_des->setFormValue($objForm->GetValue("x_pay_des"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $subventionpayment;
		$this->LoadRow();
		$subventionpayment->payment_id->CurrentValue = $subventionpayment->payment_id->FormValue;
		$subventionpayment->dead_id->CurrentValue = $subventionpayment->dead_id->FormValue;
		$subventionpayment->payment_date->CurrentValue = $subventionpayment->payment_date->FormValue;
		$subventionpayment->payment_date->CurrentValue = ew_UnFormatDateTime($subventionpayment->payment_date->CurrentValue, 7);
		$subventionpayment->subvent_total->CurrentValue = $subventionpayment->subvent_total->FormValue;
		$subventionpayment->payee->CurrentValue = $subventionpayment->payee->FormValue;
		$subventionpayment->pay_des->CurrentValue = $subventionpayment->pay_des->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subventionpayment;
		$sFilter = $subventionpayment->KeyFilter();

		// Call Row Selecting event
		$subventionpayment->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subventionpayment->CurrentFilter = $sFilter;
		$sSql = $subventionpayment->SQL();
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
		global $conn, $subventionpayment;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subventionpayment->Row_Selected($row);
		$subventionpayment->payment_id->setDbValue($rs->fields('payment_id'));
		$subventionpayment->dead_id->setDbValue($rs->fields('dead_id'));
		$subventionpayment->payment_date->setDbValue($rs->fields('payment_date'));
		$subventionpayment->subvent_total->setDbValue($rs->fields('subvent_total'));
		$subventionpayment->payee->setDbValue($rs->fields('payee'));
		$subventionpayment->pay_des->setDbValue($rs->fields('pay_des'));
		$subventionpayment->donate_total->setDbValue($rs->fields('donate_total'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subventionpayment;

		// Initialize URLs
		// Call Row_Rendering event

		$subventionpayment->Row_Rendering();

		// Common render codes for all row types
		// payment_id
		// dead_id
		// payment_date
		// subvent_total
		// payee
		// pay_des
		// donate_total

		if ($subventionpayment->RowType == EW_ROWTYPE_VIEW) { // View row

			// payment_id
			$subventionpayment->payment_id->ViewValue = $subventionpayment->payment_id->CurrentValue;
			$subventionpayment->payment_id->ViewCustomAttributes = "";

			// dead_id
			$subventionpayment->dead_id->ViewValue = $subventionpayment->dead_id->CurrentValue;
			$subventionpayment->dead_id->ViewCustomAttributes = "";

			// payment_date
			$subventionpayment->payment_date->ViewValue = $subventionpayment->payment_date->CurrentValue;
			$subventionpayment->payment_date->ViewValue = ew_FormatDateTime($subventionpayment->payment_date->ViewValue, 7);
			$subventionpayment->payment_date->ViewCustomAttributes = "";

			// subvent_total
			$subventionpayment->subvent_total->ViewValue = $subventionpayment->subvent_total->CurrentValue;
			$subventionpayment->subvent_total->ViewCustomAttributes = "";

			// payee
			$subventionpayment->payee->ViewValue = $subventionpayment->payee->CurrentValue;
			$subventionpayment->payee->ViewCustomAttributes = "";

			// pay_des
			$subventionpayment->pay_des->ViewValue = $subventionpayment->pay_des->CurrentValue;
			$subventionpayment->pay_des->ViewCustomAttributes = "";

			// payment_id
			$subventionpayment->payment_id->LinkCustomAttributes = "";
			$subventionpayment->payment_id->HrefValue = "";
			$subventionpayment->payment_id->TooltipValue = "";

			// dead_id
			$subventionpayment->dead_id->LinkCustomAttributes = "";
			$subventionpayment->dead_id->HrefValue = "";
			$subventionpayment->dead_id->TooltipValue = "";

			// payment_date
			$subventionpayment->payment_date->LinkCustomAttributes = "";
			$subventionpayment->payment_date->HrefValue = "";
			$subventionpayment->payment_date->TooltipValue = "";

			// subvent_total
			$subventionpayment->subvent_total->LinkCustomAttributes = "";
			$subventionpayment->subvent_total->HrefValue = "";
			$subventionpayment->subvent_total->TooltipValue = "";

			// payee
			$subventionpayment->payee->LinkCustomAttributes = "";
			$subventionpayment->payee->HrefValue = "";
			$subventionpayment->payee->TooltipValue = "";

			// pay_des
			$subventionpayment->pay_des->LinkCustomAttributes = "";
			$subventionpayment->pay_des->HrefValue = "";
			$subventionpayment->pay_des->TooltipValue = "";
		} elseif ($subventionpayment->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// payment_id
			$subventionpayment->payment_id->EditCustomAttributes = "";
			$subventionpayment->payment_id->EditValue = $subventionpayment->payment_id->CurrentValue;
			$subventionpayment->payment_id->ViewCustomAttributes = "";

			// dead_id
			$subventionpayment->dead_id->EditCustomAttributes = "";
			$subventionpayment->dead_id->EditValue = ew_HtmlEncode($subventionpayment->dead_id->CurrentValue);

			// payment_date
			$subventionpayment->payment_date->EditCustomAttributes = "";
			$subventionpayment->payment_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($subventionpayment->payment_date->CurrentValue, 7));

			// subvent_total
			$subventionpayment->subvent_total->EditCustomAttributes = "";
			$subventionpayment->subvent_total->EditValue = ew_HtmlEncode($subventionpayment->subvent_total->CurrentValue);

			// payee
			$subventionpayment->payee->EditCustomAttributes = "";
			$subventionpayment->payee->EditValue = ew_HtmlEncode($subventionpayment->payee->CurrentValue);

			// pay_des
			$subventionpayment->pay_des->EditCustomAttributes = "";
			$subventionpayment->pay_des->EditValue = ew_HtmlEncode($subventionpayment->pay_des->CurrentValue);

			// Edit refer script
			// payment_id

			$subventionpayment->payment_id->HrefValue = "";

			// dead_id
			$subventionpayment->dead_id->HrefValue = "";

			// payment_date
			$subventionpayment->payment_date->HrefValue = "";

			// subvent_total
			$subventionpayment->subvent_total->HrefValue = "";

			// payee
			$subventionpayment->payee->HrefValue = "";

			// pay_des
			$subventionpayment->pay_des->HrefValue = "";
		}
		if ($subventionpayment->RowType == EW_ROWTYPE_ADD ||
			$subventionpayment->RowType == EW_ROWTYPE_EDIT ||
			$subventionpayment->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$subventionpayment->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($subventionpayment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subventionpayment->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $subventionpayment;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($subventionpayment->dead_id->FormValue)) {
			ew_AddMessage($gsFormError, $subventionpayment->dead_id->FldErrMsg());
		}
		if (!is_null($subventionpayment->payment_date->FormValue) && $subventionpayment->payment_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $subventionpayment->payment_date->FldCaption());
		}
		if (!ew_CheckEuroDate($subventionpayment->payment_date->FormValue)) {
			ew_AddMessage($gsFormError, $subventionpayment->payment_date->FldErrMsg());
		}
		if (!ew_CheckNumber($subventionpayment->subvent_total->FormValue)) {
			ew_AddMessage($gsFormError, $subventionpayment->subvent_total->FldErrMsg());
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
		global $conn, $Security, $Language, $subventionpayment;
		$sFilter = $subventionpayment->KeyFilter();
		$subventionpayment->CurrentFilter = $sFilter;
		$sSql = $subventionpayment->SQL();
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

			// dead_id
			$subventionpayment->dead_id->SetDbValueDef($rsnew, $subventionpayment->dead_id->CurrentValue, NULL, $subventionpayment->dead_id->ReadOnly);

			// payment_date
			$subventionpayment->payment_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($subventionpayment->payment_date->CurrentValue, 7), NULL, $subventionpayment->payment_date->ReadOnly);

			// subvent_total
			$subventionpayment->subvent_total->SetDbValueDef($rsnew, $subventionpayment->subvent_total->CurrentValue, NULL, $subventionpayment->subvent_total->ReadOnly);

			// payee
			$subventionpayment->payee->SetDbValueDef($rsnew, $subventionpayment->payee->CurrentValue, NULL, $subventionpayment->payee->ReadOnly);

			// pay_des
			$subventionpayment->pay_des->SetDbValueDef($rsnew, $subventionpayment->pay_des->CurrentValue, NULL, $subventionpayment->pay_des->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $subventionpayment->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($subventionpayment->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($subventionpayment->CancelMessage <> "") {
					$this->setFailureMessage($subventionpayment->CancelMessage);
					$subventionpayment->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$subventionpayment->Row_Updated($rsold, $rsnew);
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
