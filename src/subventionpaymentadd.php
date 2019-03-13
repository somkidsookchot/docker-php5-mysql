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
$subventionpayment_add = new csubventionpayment_add();
$Page =& $subventionpayment_add;

// Page init
$subventionpayment_add->Page_Init();

// Page main
$subventionpayment_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subventionpayment_add = new ew_Page("subventionpayment_add");

// page properties
subventionpayment_add.PageID = "add"; // page ID
subventionpayment_add.FormID = "fsubventionpaymentadd"; // form ID
var EW_PAGE_ID = subventionpayment_add.PageID; // for backward compatibility

// extend page with ValidateForm function
subventionpayment_add.ValidateForm = function(fobj) {
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
subventionpayment_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subventionpayment_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subventionpayment_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subventionpayment_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subventionpayment->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $subventionpayment->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $subventionpayment_add->ShowPageHeader(); ?>
<?php
$subventionpayment_add->ShowMessage();
?>
<form name="fsubventionpaymentadd" id="fsubventionpaymentadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return subventionpayment_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="subventionpayment">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$subventionpayment_add->ShowPageFooter();
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
$subventionpayment_add->Page_Terminate();
?>
<?php

//
// Page class
//
class csubventionpayment_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'subventionpayment';

	// Page object name
	var $PageObjName = 'subventionpayment_add';

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
	function csubventionpayment_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $subventionpayment;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$subventionpayment->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$subventionpayment->CurrentAction = "I"; // Form error, reset action
				$subventionpayment->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["payment_id"] != "") {
				$subventionpayment->payment_id->setQueryStringValue($_GET["payment_id"]);
				$subventionpayment->setKey("payment_id", $subventionpayment->payment_id->CurrentValue); // Set up key
			} else {
				$subventionpayment->setKey("payment_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$subventionpayment->CurrentAction = "C"; // Copy record
			} else {
				$subventionpayment->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($subventionpayment->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("subventionpaymentlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$subventionpayment->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $subventionpayment->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "subventionpaymentview.php")
						$sReturnUrl = $subventionpayment->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$subventionpayment->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$subventionpayment->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $subventionpayment;
		$subventionpayment->dead_id->CurrentValue = NULL;
		$subventionpayment->dead_id->OldValue = $subventionpayment->dead_id->CurrentValue;
		$subventionpayment->payment_date->CurrentValue = NULL;
		$subventionpayment->payment_date->OldValue = $subventionpayment->payment_date->CurrentValue;
		$subventionpayment->subvent_total->CurrentValue = NULL;
		$subventionpayment->subvent_total->OldValue = $subventionpayment->subvent_total->CurrentValue;
		$subventionpayment->payee->CurrentValue = NULL;
		$subventionpayment->payee->OldValue = $subventionpayment->payee->CurrentValue;
		$subventionpayment->pay_des->CurrentValue = NULL;
		$subventionpayment->pay_des->OldValue = $subventionpayment->pay_des->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $subventionpayment;
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
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $subventionpayment;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($subventionpayment->getKey("payment_id")) <> "")
			$subventionpayment->payment_id->CurrentValue = $subventionpayment->getKey("payment_id"); // payment_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$subventionpayment->CurrentFilter = $subventionpayment->KeyFilter();
			$sSql = $subventionpayment->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
		} elseif ($subventionpayment->RowType == EW_ROWTYPE_ADD) { // Add row

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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $subventionpayment;
		$rsnew = array();

		// dead_id
		$subventionpayment->dead_id->SetDbValueDef($rsnew, $subventionpayment->dead_id->CurrentValue, NULL, FALSE);

		// payment_date
		$subventionpayment->payment_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($subventionpayment->payment_date->CurrentValue, 7), NULL, FALSE);

		// subvent_total
		$subventionpayment->subvent_total->SetDbValueDef($rsnew, $subventionpayment->subvent_total->CurrentValue, NULL, strval($subventionpayment->subvent_total->CurrentValue) == "");

		// payee
		$subventionpayment->payee->SetDbValueDef($rsnew, $subventionpayment->payee->CurrentValue, NULL, FALSE);

		// pay_des
		$subventionpayment->pay_des->SetDbValueDef($rsnew, $subventionpayment->pay_des->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $subventionpayment->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($subventionpayment->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($subventionpayment->CancelMessage <> "") {
				$this->setFailureMessage($subventionpayment->CancelMessage);
				$subventionpayment->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$subventionpayment->payment_id->setDbValue($conn->Insert_ID());
			$rsnew['payment_id'] = $subventionpayment->payment_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$subventionpayment->Row_Inserted($rs, $rsnew);
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
