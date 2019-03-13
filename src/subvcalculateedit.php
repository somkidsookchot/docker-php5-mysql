<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subvcalculateinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subvcalculate_edit = new csubvcalculate_edit();
$Page =& $subvcalculate_edit;

// Page init
$subvcalculate_edit->Page_Init();

// Page main
$subvcalculate_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subvcalculate_edit = new ew_Page("subvcalculate_edit");

// page properties
subvcalculate_edit.PageID = "edit"; // page ID
subvcalculate_edit.FormID = "fsubvcalculateedit"; // form ID
var EW_PAGE_ID = subvcalculate_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
subvcalculate_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_adv_num"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subvcalculate->adv_num->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_adv_num"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subvcalculate->adv_num->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_cal_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subvcalculate->cal_status->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_invoice_senddate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subvcalculate->invoice_senddate->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_invoice_senddate"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subvcalculate->invoice_senddate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_invoice_duedate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subvcalculate->invoice_duedate->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_invoice_duedate"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subvcalculate->invoice_duedate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_notice_senddate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subvcalculate->notice_senddate->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_notice_senddate"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subvcalculate->notice_senddate->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_notice_duedate"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subvcalculate->notice_duedate->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_notice_duedate"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subvcalculate->notice_duedate->FldErrMsg()) ?>");

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
subvcalculate_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subvcalculate_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subvcalculate_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subvcalculate_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subvcalculate->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $subvcalculate->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $subvcalculate_edit->ShowPageHeader(); ?>
<?php
$subvcalculate_edit->ShowMessage();
?>
<form name="fsubvcalculateedit" id="fsubvcalculateedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return subvcalculate_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="subvcalculate">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($subvcalculate->t_code->Visible) { // t_code ?>
	<tr id="r_t_code"<?php echo $subvcalculate->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcalculate->t_code->FldCaption() ?></td>
		<td<?php echo $subvcalculate->t_code->CellAttributes() ?>><span id="el_t_code">
<div<?php echo $subvcalculate->t_code->ViewAttributes() ?>><?php echo $subvcalculate->t_code->EditValue ?></div>
<input type="hidden" name="x_t_code" id="x_t_code" value="<?php echo ew_HtmlEncode($subvcalculate->t_code->CurrentValue) ?>">
</span><?php echo $subvcalculate->t_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subvcalculate->village_id->Visible) { // village_id ?>
	<tr id="r_village_id"<?php echo $subvcalculate->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcalculate->village_id->FldCaption() ?></td>
		<td<?php echo $subvcalculate->village_id->CellAttributes() ?>><span id="el_village_id">
<div<?php echo $subvcalculate->village_id->ViewAttributes() ?>><?php echo $subvcalculate->village_id->EditValue ?></div>
<input type="hidden" name="x_village_id" id="x_village_id" value="<?php echo ew_HtmlEncode($subvcalculate->village_id->CurrentValue) ?>">
</span><?php echo $subvcalculate->village_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subvcalculate->cal_type->Visible) { // cal_type ?>
	<tr id="r_cal_type"<?php echo $subvcalculate->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcalculate->cal_type->FldCaption() ?></td>
		<td<?php echo $subvcalculate->cal_type->CellAttributes() ?>><span id="el_cal_type">
<div<?php echo $subvcalculate->cal_type->ViewAttributes() ?>><?php echo $subvcalculate->cal_type->EditValue ?></div>
<input type="hidden" name="x_cal_type" id="x_cal_type" value="<?php echo ew_HtmlEncode($subvcalculate->cal_type->CurrentValue) ?>">
</span><?php echo $subvcalculate->cal_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subvcalculate->member_code->Visible) { // member_code ?>
	<tr id="r_member_code"<?php echo $subvcalculate->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcalculate->member_code->FldCaption() ?></td>
		<td<?php echo $subvcalculate->member_code->CellAttributes() ?>><span id="el_member_code">
<div<?php echo $subvcalculate->member_code->ViewAttributes() ?>><?php echo $subvcalculate->member_code->EditValue ?></div>
<input type="hidden" name="x_member_code" id="x_member_code" value="<?php echo ew_HtmlEncode($subvcalculate->member_code->CurrentValue) ?>">
</span><?php echo $subvcalculate->member_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subvcalculate->adv_num->Visible) { // adv_num ?>
	<tr id="r_adv_num"<?php echo $subvcalculate->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcalculate->adv_num->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subvcalculate->adv_num->CellAttributes() ?>><span id="el_adv_num">
<input type="text" name="x_adv_num" id="x_adv_num" size="30" value="<?php echo $subvcalculate->adv_num->EditValue ?>"<?php echo $subvcalculate->adv_num->EditAttributes() ?>>
</span><?php echo $subvcalculate->adv_num->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subvcalculate->cal_detail->Visible) { // cal_detail ?>
	<tr id="r_cal_detail"<?php echo $subvcalculate->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcalculate->cal_detail->FldCaption() ?></td>
		<td<?php echo $subvcalculate->cal_detail->CellAttributes() ?>><span id="el_cal_detail">
<textarea name="x_cal_detail" id="x_cal_detail" cols="35" rows="4"<?php echo $subvcalculate->cal_detail->EditAttributes() ?>><?php echo $subvcalculate->cal_detail->EditValue ?></textarea>
</span><?php echo $subvcalculate->cal_detail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subvcalculate->unit_rate->Visible) { // unit_rate ?>
	<tr id="r_unit_rate"<?php echo $subvcalculate->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcalculate->unit_rate->FldCaption() ?></td>
		<td<?php echo $subvcalculate->unit_rate->CellAttributes() ?>><span id="el_unit_rate">
<div<?php echo $subvcalculate->unit_rate->ViewAttributes() ?>><?php echo $subvcalculate->unit_rate->EditValue ?></div>
<input type="hidden" name="x_unit_rate" id="x_unit_rate" value="<?php echo ew_HtmlEncode($subvcalculate->unit_rate->CurrentValue) ?>">
</span><?php echo $subvcalculate->unit_rate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subvcalculate->total->Visible) { // total ?>
	<tr id="r_total"<?php echo $subvcalculate->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcalculate->total->FldCaption() ?></td>
		<td<?php echo $subvcalculate->total->CellAttributes() ?>><span id="el_total">
<div<?php echo $subvcalculate->total->ViewAttributes() ?>><?php echo $subvcalculate->total->EditValue ?></div>
<input type="hidden" name="x_total" id="x_total" value="<?php echo ew_HtmlEncode($subvcalculate->total->CurrentValue) ?>">
</span><?php echo $subvcalculate->total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subvcalculate->cal_status->Visible) { // cal_status ?>
	<tr id="r_cal_status"<?php echo $subvcalculate->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcalculate->cal_status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subvcalculate->cal_status->CellAttributes() ?>><span id="el_cal_status">
<input type="text" name="x_cal_status" id="x_cal_status" size="30" maxlength="100" value="<?php echo $subvcalculate->cal_status->EditValue ?>"<?php echo $subvcalculate->cal_status->EditAttributes() ?>>
</span><?php echo $subvcalculate->cal_status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subvcalculate->invoice_senddate->Visible) { // invoice_senddate ?>
	<tr id="r_invoice_senddate"<?php echo $subvcalculate->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcalculate->invoice_senddate->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subvcalculate->invoice_senddate->CellAttributes() ?>><span id="el_invoice_senddate">
<input type="text" name="x_invoice_senddate" id="x_invoice_senddate" value="<?php echo $subvcalculate->invoice_senddate->EditValue ?>"<?php echo $subvcalculate->invoice_senddate->EditAttributes() ?>>
</span><?php echo $subvcalculate->invoice_senddate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subvcalculate->invoice_duedate->Visible) { // invoice_duedate ?>
	<tr id="r_invoice_duedate"<?php echo $subvcalculate->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcalculate->invoice_duedate->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subvcalculate->invoice_duedate->CellAttributes() ?>><span id="el_invoice_duedate">
<input type="text" name="x_invoice_duedate" id="x_invoice_duedate" value="<?php echo $subvcalculate->invoice_duedate->EditValue ?>"<?php echo $subvcalculate->invoice_duedate->EditAttributes() ?>>
</span><?php echo $subvcalculate->invoice_duedate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subvcalculate->notice_senddate->Visible) { // notice_senddate ?>
	<tr id="r_notice_senddate"<?php echo $subvcalculate->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcalculate->notice_senddate->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subvcalculate->notice_senddate->CellAttributes() ?>><span id="el_notice_senddate">
<input type="text" name="x_notice_senddate" id="x_notice_senddate" value="<?php echo $subvcalculate->notice_senddate->EditValue ?>"<?php echo $subvcalculate->notice_senddate->EditAttributes() ?>>
</span><?php echo $subvcalculate->notice_senddate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subvcalculate->notice_duedate->Visible) { // notice_duedate ?>
	<tr id="r_notice_duedate"<?php echo $subvcalculate->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $subvcalculate->notice_duedate->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subvcalculate->notice_duedate->CellAttributes() ?>><span id="el_notice_duedate">
<input type="text" name="x_notice_duedate" id="x_notice_duedate" value="<?php echo $subvcalculate->notice_duedate->EditValue ?>"<?php echo $subvcalculate->notice_duedate->EditAttributes() ?>>
</span><?php echo $subvcalculate->notice_duedate->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_svc_id" id="x_svc_id" value="<?php echo ew_HtmlEncode($subvcalculate->svc_id->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_t_code','x_t_code',false]]);

//-->
</script>
<?php
$subvcalculate_edit->ShowPageFooter();
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
$subvcalculate_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class csubvcalculate_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'subvcalculate';

	// Page object name
	var $PageObjName = 'subvcalculate_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subvcalculate;
		if ($subvcalculate->UseTokenInUrl) $PageUrl .= "t=" . $subvcalculate->TableVar . "&"; // Add page token
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
		global $objForm, $subvcalculate;
		if ($subvcalculate->UseTokenInUrl) {
			if ($objForm)
				return ($subvcalculate->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subvcalculate->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubvcalculate_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subvcalculate)
		if (!isset($GLOBALS["subvcalculate"])) {
			$GLOBALS["subvcalculate"] = new csubvcalculate();
			$GLOBALS["Table"] =& $GLOBALS["subvcalculate"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subvcalculate', TRUE);

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
		global $subvcalculate;

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
		global $objForm, $Language, $gsFormError, $subvcalculate;

		// Load key from QueryString
		if (@$_GET["svc_id"] <> "")
			$subvcalculate->svc_id->setQueryStringValue($_GET["svc_id"]);
		if (@$_POST["a_edit"] <> "") {
			$subvcalculate->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$subvcalculate->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$subvcalculate->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$subvcalculate->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($subvcalculate->svc_id->CurrentValue == "")
			$this->Page_Terminate("subvcalculatelist.php"); // Invalid key, return to list
		switch ($subvcalculate->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("subvcalculatelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$subvcalculate->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $subvcalculate->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "subvcalculateview.php")
						$sReturnUrl = $subvcalculate->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$subvcalculate->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$subvcalculate->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$subvcalculate->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $subvcalculate;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $subvcalculate;
		if (!$subvcalculate->t_code->FldIsDetailKey) {
			$subvcalculate->t_code->setFormValue($objForm->GetValue("x_t_code"));
		}
		if (!$subvcalculate->village_id->FldIsDetailKey) {
			$subvcalculate->village_id->setFormValue($objForm->GetValue("x_village_id"));
		}
		if (!$subvcalculate->cal_type->FldIsDetailKey) {
			$subvcalculate->cal_type->setFormValue($objForm->GetValue("x_cal_type"));
		}
		if (!$subvcalculate->member_code->FldIsDetailKey) {
			$subvcalculate->member_code->setFormValue($objForm->GetValue("x_member_code"));
		}
		if (!$subvcalculate->adv_num->FldIsDetailKey) {
			$subvcalculate->adv_num->setFormValue($objForm->GetValue("x_adv_num"));
		}
		if (!$subvcalculate->cal_detail->FldIsDetailKey) {
			$subvcalculate->cal_detail->setFormValue($objForm->GetValue("x_cal_detail"));
		}
		if (!$subvcalculate->unit_rate->FldIsDetailKey) {
			$subvcalculate->unit_rate->setFormValue($objForm->GetValue("x_unit_rate"));
		}
		if (!$subvcalculate->total->FldIsDetailKey) {
			$subvcalculate->total->setFormValue($objForm->GetValue("x_total"));
		}
		if (!$subvcalculate->cal_status->FldIsDetailKey) {
			$subvcalculate->cal_status->setFormValue($objForm->GetValue("x_cal_status"));
		}
		if (!$subvcalculate->invoice_senddate->FldIsDetailKey) {
			$subvcalculate->invoice_senddate->setFormValue($objForm->GetValue("x_invoice_senddate"));
			$subvcalculate->invoice_senddate->CurrentValue = ew_UnFormatDateTime($subvcalculate->invoice_senddate->CurrentValue, 7);
		}
		if (!$subvcalculate->invoice_duedate->FldIsDetailKey) {
			$subvcalculate->invoice_duedate->setFormValue($objForm->GetValue("x_invoice_duedate"));
			$subvcalculate->invoice_duedate->CurrentValue = ew_UnFormatDateTime($subvcalculate->invoice_duedate->CurrentValue, 7);
		}
		if (!$subvcalculate->notice_senddate->FldIsDetailKey) {
			$subvcalculate->notice_senddate->setFormValue($objForm->GetValue("x_notice_senddate"));
			$subvcalculate->notice_senddate->CurrentValue = ew_UnFormatDateTime($subvcalculate->notice_senddate->CurrentValue, 7);
		}
		if (!$subvcalculate->notice_duedate->FldIsDetailKey) {
			$subvcalculate->notice_duedate->setFormValue($objForm->GetValue("x_notice_duedate"));
			$subvcalculate->notice_duedate->CurrentValue = ew_UnFormatDateTime($subvcalculate->notice_duedate->CurrentValue, 7);
		}
		if (!$subvcalculate->svc_id->FldIsDetailKey)
			$subvcalculate->svc_id->setFormValue($objForm->GetValue("x_svc_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $subvcalculate;
		$this->LoadRow();
		$subvcalculate->svc_id->CurrentValue = $subvcalculate->svc_id->FormValue;
		$subvcalculate->t_code->CurrentValue = $subvcalculate->t_code->FormValue;
		$subvcalculate->village_id->CurrentValue = $subvcalculate->village_id->FormValue;
		$subvcalculate->cal_type->CurrentValue = $subvcalculate->cal_type->FormValue;
		$subvcalculate->member_code->CurrentValue = $subvcalculate->member_code->FormValue;
		$subvcalculate->adv_num->CurrentValue = $subvcalculate->adv_num->FormValue;
		$subvcalculate->cal_detail->CurrentValue = $subvcalculate->cal_detail->FormValue;
		$subvcalculate->unit_rate->CurrentValue = $subvcalculate->unit_rate->FormValue;
		$subvcalculate->total->CurrentValue = $subvcalculate->total->FormValue;
		$subvcalculate->cal_status->CurrentValue = $subvcalculate->cal_status->FormValue;
		$subvcalculate->invoice_senddate->CurrentValue = $subvcalculate->invoice_senddate->FormValue;
		$subvcalculate->invoice_senddate->CurrentValue = ew_UnFormatDateTime($subvcalculate->invoice_senddate->CurrentValue, 7);
		$subvcalculate->invoice_duedate->CurrentValue = $subvcalculate->invoice_duedate->FormValue;
		$subvcalculate->invoice_duedate->CurrentValue = ew_UnFormatDateTime($subvcalculate->invoice_duedate->CurrentValue, 7);
		$subvcalculate->notice_senddate->CurrentValue = $subvcalculate->notice_senddate->FormValue;
		$subvcalculate->notice_senddate->CurrentValue = ew_UnFormatDateTime($subvcalculate->notice_senddate->CurrentValue, 7);
		$subvcalculate->notice_duedate->CurrentValue = $subvcalculate->notice_duedate->FormValue;
		$subvcalculate->notice_duedate->CurrentValue = ew_UnFormatDateTime($subvcalculate->notice_duedate->CurrentValue, 7);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subvcalculate;
		$sFilter = $subvcalculate->KeyFilter();

		// Call Row Selecting event
		$subvcalculate->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subvcalculate->CurrentFilter = $sFilter;
		$sSql = $subvcalculate->SQL();
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
		global $conn, $subvcalculate;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subvcalculate->Row_Selected($row);
		$subvcalculate->svc_id->setDbValue($rs->fields('svc_id'));
		$subvcalculate->t_code->setDbValue($rs->fields('t_code'));
		$subvcalculate->village_id->setDbValue($rs->fields('village_id'));
		$subvcalculate->cal_type->setDbValue($rs->fields('cal_type'));
		$subvcalculate->member_code->setDbValue($rs->fields('member_code'));
		$subvcalculate->adv_num->setDbValue($rs->fields('adv_num'));
		$subvcalculate->cal_detail->setDbValue($rs->fields('cal_detail'));
		$subvcalculate->count_member->setDbValue($rs->fields('count_member'));
		$subvcalculate->all_member->setDbValue($rs->fields('all_member'));
		$subvcalculate->unit_rate->setDbValue($rs->fields('unit_rate'));
		$subvcalculate->total->setDbValue($rs->fields('total'));
		$subvcalculate->cal_date->setDbValue($rs->fields('cal_date'));
		$subvcalculate->cal_status->setDbValue($rs->fields('cal_status'));
		$subvcalculate->invoice_senddate->setDbValue($rs->fields('invoice_senddate'));
		$subvcalculate->invoice_duedate->setDbValue($rs->fields('invoice_duedate'));
		$subvcalculate->notice_senddate->setDbValue($rs->fields('notice_senddate'));
		$subvcalculate->notice_duedate->setDbValue($rs->fields('notice_duedate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subvcalculate;

		// Initialize URLs
		// Call Row_Rendering event

		$subvcalculate->Row_Rendering();

		// Common render codes for all row types
		// svc_id
		// t_code
		// village_id
		// cal_type
		// member_code
		// adv_num
		// cal_detail
		// count_member
		// all_member
		// unit_rate
		// total
		// cal_date
		// cal_status
		// invoice_senddate
		// invoice_duedate
		// notice_senddate
		// notice_duedate

		if ($subvcalculate->RowType == EW_ROWTYPE_VIEW) { // View row

			// t_code
			if (strval($subvcalculate->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($subvcalculate->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcalculate->t_code->ViewValue = $rswrk->fields('t_code');
					$subvcalculate->t_code->ViewValue .= ew_ValueSeparator(0,1,$subvcalculate->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$subvcalculate->t_code->ViewValue = $subvcalculate->t_code->CurrentValue;
				}
			} else {
				$subvcalculate->t_code->ViewValue = NULL;
			}
			$subvcalculate->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($subvcalculate->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($subvcalculate->village_id->CurrentValue) . "";
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
					$subvcalculate->village_id->ViewValue = $rswrk->fields('v_code');
					$subvcalculate->village_id->ViewValue .= ew_ValueSeparator(0,1,$subvcalculate->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$subvcalculate->village_id->ViewValue = $subvcalculate->village_id->CurrentValue;
				}
			} else {
				$subvcalculate->village_id->ViewValue = NULL;
			}
			$subvcalculate->village_id->ViewCustomAttributes = "";

			// cal_type
			if (strval($subvcalculate->cal_type->CurrentValue) <> "") {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($subvcalculate->cal_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcalculate->cal_type->ViewValue = $rswrk->fields('pt_title');
					$rswrk->Close();
				} else {
					$subvcalculate->cal_type->ViewValue = $subvcalculate->cal_type->CurrentValue;
				}
			} else {
				$subvcalculate->cal_type->ViewValue = NULL;
			}
			$subvcalculate->cal_type->ViewCustomAttributes = "";

			// member_code
			if (strval($subvcalculate->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($subvcalculate->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` = 'เสียชีวิต'";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcalculate->member_code->ViewValue = $rswrk->fields('dead_id');
					$subvcalculate->member_code->ViewValue .= ew_ValueSeparator(0,1,$subvcalculate->member_code) . $rswrk->fields('fname');
					$subvcalculate->member_code->ViewValue .= ew_ValueSeparator(0,2,$subvcalculate->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$subvcalculate->member_code->ViewValue = $subvcalculate->member_code->CurrentValue;
				}
			} else {
				$subvcalculate->member_code->ViewValue = NULL;
			}
			$subvcalculate->member_code->ViewCustomAttributes = "";

			// adv_num
			$subvcalculate->adv_num->ViewValue = $subvcalculate->adv_num->CurrentValue;
			$subvcalculate->adv_num->ViewCustomAttributes = "";

			// cal_detail
			$subvcalculate->cal_detail->ViewValue = $subvcalculate->cal_detail->CurrentValue;
			$subvcalculate->cal_detail->ViewCustomAttributes = "";

			// count_member
			$subvcalculate->count_member->ViewValue = $subvcalculate->count_member->CurrentValue;
			$subvcalculate->count_member->ViewCustomAttributes = "";

			// unit_rate
			$subvcalculate->unit_rate->ViewValue = $subvcalculate->unit_rate->CurrentValue;
			$subvcalculate->unit_rate->ViewCustomAttributes = "";

			// total
			$subvcalculate->total->ViewValue = $subvcalculate->total->CurrentValue;
			$subvcalculate->total->ViewCustomAttributes = "";

			// cal_status
			$subvcalculate->cal_status->ViewValue = $subvcalculate->cal_status->CurrentValue;
			$subvcalculate->cal_status->ViewCustomAttributes = "";

			// invoice_senddate
			$subvcalculate->invoice_senddate->ViewValue = $subvcalculate->invoice_senddate->CurrentValue;
			$subvcalculate->invoice_senddate->ViewValue = ew_FormatDateTime($subvcalculate->invoice_senddate->ViewValue, 7);
			$subvcalculate->invoice_senddate->ViewCustomAttributes = "";

			// invoice_duedate
			$subvcalculate->invoice_duedate->ViewValue = $subvcalculate->invoice_duedate->CurrentValue;
			$subvcalculate->invoice_duedate->ViewValue = ew_FormatDateTime($subvcalculate->invoice_duedate->ViewValue, 7);
			$subvcalculate->invoice_duedate->ViewCustomAttributes = "";

			// notice_senddate
			$subvcalculate->notice_senddate->ViewValue = $subvcalculate->notice_senddate->CurrentValue;
			$subvcalculate->notice_senddate->ViewValue = ew_FormatDateTime($subvcalculate->notice_senddate->ViewValue, 7);
			$subvcalculate->notice_senddate->ViewCustomAttributes = "";

			// notice_duedate
			$subvcalculate->notice_duedate->ViewValue = $subvcalculate->notice_duedate->CurrentValue;
			$subvcalculate->notice_duedate->ViewValue = ew_FormatDateTime($subvcalculate->notice_duedate->ViewValue, 7);
			$subvcalculate->notice_duedate->ViewCustomAttributes = "";

			// t_code
			$subvcalculate->t_code->LinkCustomAttributes = "";
			$subvcalculate->t_code->HrefValue = "";
			$subvcalculate->t_code->TooltipValue = "";

			// village_id
			$subvcalculate->village_id->LinkCustomAttributes = "";
			$subvcalculate->village_id->HrefValue = "";
			$subvcalculate->village_id->TooltipValue = "";

			// cal_type
			$subvcalculate->cal_type->LinkCustomAttributes = "";
			$subvcalculate->cal_type->HrefValue = "";
			$subvcalculate->cal_type->TooltipValue = "";

			// member_code
			$subvcalculate->member_code->LinkCustomAttributes = "";
			$subvcalculate->member_code->HrefValue = "";
			$subvcalculate->member_code->TooltipValue = "";

			// adv_num
			$subvcalculate->adv_num->LinkCustomAttributes = "";
			$subvcalculate->adv_num->HrefValue = "";
			$subvcalculate->adv_num->TooltipValue = "";

			// cal_detail
			$subvcalculate->cal_detail->LinkCustomAttributes = "";
			$subvcalculate->cal_detail->HrefValue = "";
			$subvcalculate->cal_detail->TooltipValue = "";

			// unit_rate
			$subvcalculate->unit_rate->LinkCustomAttributes = "";
			$subvcalculate->unit_rate->HrefValue = "";
			$subvcalculate->unit_rate->TooltipValue = "";

			// total
			$subvcalculate->total->LinkCustomAttributes = "";
			$subvcalculate->total->HrefValue = "";
			$subvcalculate->total->TooltipValue = "";

			// cal_status
			$subvcalculate->cal_status->LinkCustomAttributes = "";
			$subvcalculate->cal_status->HrefValue = "";
			$subvcalculate->cal_status->TooltipValue = "";

			// invoice_senddate
			$subvcalculate->invoice_senddate->LinkCustomAttributes = "";
			$subvcalculate->invoice_senddate->HrefValue = "";
			$subvcalculate->invoice_senddate->TooltipValue = "";

			// invoice_duedate
			$subvcalculate->invoice_duedate->LinkCustomAttributes = "";
			$subvcalculate->invoice_duedate->HrefValue = "";
			$subvcalculate->invoice_duedate->TooltipValue = "";

			// notice_senddate
			$subvcalculate->notice_senddate->LinkCustomAttributes = "";
			$subvcalculate->notice_senddate->HrefValue = "";
			$subvcalculate->notice_senddate->TooltipValue = "";

			// notice_duedate
			$subvcalculate->notice_duedate->LinkCustomAttributes = "";
			$subvcalculate->notice_duedate->HrefValue = "";
			$subvcalculate->notice_duedate->TooltipValue = "";
		} elseif ($subvcalculate->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// t_code
			$subvcalculate->t_code->EditCustomAttributes = "";
			if (strval($subvcalculate->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($subvcalculate->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcalculate->t_code->EditValue = $rswrk->fields('t_code');
					$subvcalculate->t_code->EditValue .= ew_ValueSeparator(0,1,$subvcalculate->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$subvcalculate->t_code->EditValue = $subvcalculate->t_code->CurrentValue;
				}
			} else {
				$subvcalculate->t_code->EditValue = NULL;
			}
			$subvcalculate->t_code->ViewCustomAttributes = "";

			// village_id
			$subvcalculate->village_id->EditCustomAttributes = "";
			if (strval($subvcalculate->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($subvcalculate->village_id->CurrentValue) . "";
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
					$subvcalculate->village_id->EditValue = $rswrk->fields('v_code');
					$subvcalculate->village_id->EditValue .= ew_ValueSeparator(0,1,$subvcalculate->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$subvcalculate->village_id->EditValue = $subvcalculate->village_id->CurrentValue;
				}
			} else {
				$subvcalculate->village_id->EditValue = NULL;
			}
			$subvcalculate->village_id->ViewCustomAttributes = "";

			// cal_type
			$subvcalculate->cal_type->EditCustomAttributes = 'onchange=showcalculatefield(this.options[this.selectedIndex].value);';
			if (strval($subvcalculate->cal_type->CurrentValue) <> "") {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($subvcalculate->cal_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcalculate->cal_type->EditValue = $rswrk->fields('pt_title');
					$rswrk->Close();
				} else {
					$subvcalculate->cal_type->EditValue = $subvcalculate->cal_type->CurrentValue;
				}
			} else {
				$subvcalculate->cal_type->EditValue = NULL;
			}
			$subvcalculate->cal_type->ViewCustomAttributes = "";

			// member_code
			$subvcalculate->member_code->EditCustomAttributes = "";
			if (strval($subvcalculate->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($subvcalculate->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` = 'เสียชีวิต'";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcalculate->member_code->EditValue = $rswrk->fields('dead_id');
					$subvcalculate->member_code->EditValue .= ew_ValueSeparator(0,1,$subvcalculate->member_code) . $rswrk->fields('fname');
					$subvcalculate->member_code->EditValue .= ew_ValueSeparator(0,2,$subvcalculate->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$subvcalculate->member_code->EditValue = $subvcalculate->member_code->CurrentValue;
				}
			} else {
				$subvcalculate->member_code->EditValue = NULL;
			}
			$subvcalculate->member_code->ViewCustomAttributes = "";

			// adv_num
			$subvcalculate->adv_num->EditCustomAttributes = "";
			$subvcalculate->adv_num->EditValue = ew_HtmlEncode($subvcalculate->adv_num->CurrentValue);

			// cal_detail
			$subvcalculate->cal_detail->EditCustomAttributes = "";
			$subvcalculate->cal_detail->EditValue = ew_HtmlEncode($subvcalculate->cal_detail->CurrentValue);

			// unit_rate
			$subvcalculate->unit_rate->EditCustomAttributes = "";
			$subvcalculate->unit_rate->EditValue = $subvcalculate->unit_rate->CurrentValue;
			$subvcalculate->unit_rate->ViewCustomAttributes = "";

			// total
			$subvcalculate->total->EditCustomAttributes = "";
			$subvcalculate->total->EditValue = $subvcalculate->total->CurrentValue;
			$subvcalculate->total->ViewCustomAttributes = "";

			// cal_status
			$subvcalculate->cal_status->EditCustomAttributes = "";
			$subvcalculate->cal_status->EditValue = ew_HtmlEncode($subvcalculate->cal_status->CurrentValue);

			// invoice_senddate
			$subvcalculate->invoice_senddate->EditCustomAttributes = "";
			$subvcalculate->invoice_senddate->EditValue = ew_HtmlEncode(ew_FormatDateTime($subvcalculate->invoice_senddate->CurrentValue, 7));

			// invoice_duedate
			$subvcalculate->invoice_duedate->EditCustomAttributes = "";
			$subvcalculate->invoice_duedate->EditValue = ew_HtmlEncode(ew_FormatDateTime($subvcalculate->invoice_duedate->CurrentValue, 7));

			// notice_senddate
			$subvcalculate->notice_senddate->EditCustomAttributes = "";
			$subvcalculate->notice_senddate->EditValue = ew_HtmlEncode(ew_FormatDateTime($subvcalculate->notice_senddate->CurrentValue, 7));

			// notice_duedate
			$subvcalculate->notice_duedate->EditCustomAttributes = "";
			$subvcalculate->notice_duedate->EditValue = ew_HtmlEncode(ew_FormatDateTime($subvcalculate->notice_duedate->CurrentValue, 7));

			// Edit refer script
			// t_code

			$subvcalculate->t_code->HrefValue = "";

			// village_id
			$subvcalculate->village_id->HrefValue = "";

			// cal_type
			$subvcalculate->cal_type->HrefValue = "";

			// member_code
			$subvcalculate->member_code->HrefValue = "";

			// adv_num
			$subvcalculate->adv_num->HrefValue = "";

			// cal_detail
			$subvcalculate->cal_detail->HrefValue = "";

			// unit_rate
			$subvcalculate->unit_rate->HrefValue = "";

			// total
			$subvcalculate->total->HrefValue = "";

			// cal_status
			$subvcalculate->cal_status->HrefValue = "";

			// invoice_senddate
			$subvcalculate->invoice_senddate->HrefValue = "";

			// invoice_duedate
			$subvcalculate->invoice_duedate->HrefValue = "";

			// notice_senddate
			$subvcalculate->notice_senddate->HrefValue = "";

			// notice_duedate
			$subvcalculate->notice_duedate->HrefValue = "";
		}
		if ($subvcalculate->RowType == EW_ROWTYPE_ADD ||
			$subvcalculate->RowType == EW_ROWTYPE_EDIT ||
			$subvcalculate->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$subvcalculate->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($subvcalculate->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subvcalculate->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $subvcalculate;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($subvcalculate->adv_num->FormValue) && $subvcalculate->adv_num->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $subvcalculate->adv_num->FldCaption());
		}
		if (!ew_CheckInteger($subvcalculate->adv_num->FormValue)) {
			ew_AddMessage($gsFormError, $subvcalculate->adv_num->FldErrMsg());
		}
		if (!is_null($subvcalculate->cal_status->FormValue) && $subvcalculate->cal_status->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $subvcalculate->cal_status->FldCaption());
		}
		if (!is_null($subvcalculate->invoice_senddate->FormValue) && $subvcalculate->invoice_senddate->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $subvcalculate->invoice_senddate->FldCaption());
		}
		if (!ew_CheckEuroDate($subvcalculate->invoice_senddate->FormValue)) {
			ew_AddMessage($gsFormError, $subvcalculate->invoice_senddate->FldErrMsg());
		}
		if (!is_null($subvcalculate->invoice_duedate->FormValue) && $subvcalculate->invoice_duedate->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $subvcalculate->invoice_duedate->FldCaption());
		}
		if (!ew_CheckEuroDate($subvcalculate->invoice_duedate->FormValue)) {
			ew_AddMessage($gsFormError, $subvcalculate->invoice_duedate->FldErrMsg());
		}
		if (!is_null($subvcalculate->notice_senddate->FormValue) && $subvcalculate->notice_senddate->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $subvcalculate->notice_senddate->FldCaption());
		}
		if (!ew_CheckEuroDate($subvcalculate->notice_senddate->FormValue)) {
			ew_AddMessage($gsFormError, $subvcalculate->notice_senddate->FldErrMsg());
		}
		if (!is_null($subvcalculate->notice_duedate->FormValue) && $subvcalculate->notice_duedate->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $subvcalculate->notice_duedate->FldCaption());
		}
		if (!ew_CheckEuroDate($subvcalculate->notice_duedate->FormValue)) {
			ew_AddMessage($gsFormError, $subvcalculate->notice_duedate->FldErrMsg());
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
		global $conn, $Security, $Language, $subvcalculate;
		$sFilter = $subvcalculate->KeyFilter();
		$subvcalculate->CurrentFilter = $sFilter;
		$sSql = $subvcalculate->SQL();
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

			// adv_num
			$subvcalculate->adv_num->SetDbValueDef($rsnew, $subvcalculate->adv_num->CurrentValue, 0, $subvcalculate->adv_num->ReadOnly);

			// cal_detail
			$subvcalculate->cal_detail->SetDbValueDef($rsnew, $subvcalculate->cal_detail->CurrentValue, NULL, $subvcalculate->cal_detail->ReadOnly);

			// cal_status
			$subvcalculate->cal_status->SetDbValueDef($rsnew, $subvcalculate->cal_status->CurrentValue, "", $subvcalculate->cal_status->ReadOnly);

			// invoice_senddate
			$subvcalculate->invoice_senddate->SetDbValueDef($rsnew, ew_UnFormatDateTime($subvcalculate->invoice_senddate->CurrentValue, 7), ew_CurrentDate(), $subvcalculate->invoice_senddate->ReadOnly);

			// invoice_duedate
			$subvcalculate->invoice_duedate->SetDbValueDef($rsnew, ew_UnFormatDateTime($subvcalculate->invoice_duedate->CurrentValue, 7), ew_CurrentDate(), $subvcalculate->invoice_duedate->ReadOnly);

			// notice_senddate
			$subvcalculate->notice_senddate->SetDbValueDef($rsnew, ew_UnFormatDateTime($subvcalculate->notice_senddate->CurrentValue, 7), ew_CurrentDate(), $subvcalculate->notice_senddate->ReadOnly);

			// notice_duedate
			$subvcalculate->notice_duedate->SetDbValueDef($rsnew, ew_UnFormatDateTime($subvcalculate->notice_duedate->CurrentValue, 7), ew_CurrentDate(), $subvcalculate->notice_duedate->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $subvcalculate->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($subvcalculate->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($subvcalculate->CancelMessage <> "") {
					$this->setFailureMessage($subvcalculate->CancelMessage);
					$subvcalculate->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$subvcalculate->Row_Updated($rsold, $rsnew);
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
