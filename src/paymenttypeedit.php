<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "paymenttypeinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$paymenttype_edit = new cpaymenttype_edit();
$Page =& $paymenttype_edit;

// Page init
$paymenttype_edit->Page_Init();

// Page main
$paymenttype_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var paymenttype_edit = new ew_Page("paymenttype_edit");

// page properties
paymenttype_edit.PageID = "edit"; // page ID
paymenttype_edit.FormID = "fpaymenttypeedit"; // form ID
var EW_PAGE_ID = paymenttype_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
paymenttype_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_pt_title"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymenttype->pt_title->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pt_des"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymenttype->pt_des->FldCaption()) ?>");

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
paymenttype_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
paymenttype_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
paymenttype_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
paymenttype_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $paymenttype->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $paymenttype->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $paymenttype_edit->ShowPageHeader(); ?>
<?php
$paymenttype_edit->ShowMessage();
?>
<form name="fpaymenttypeedit" id="fpaymenttypeedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return paymenttype_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="paymenttype">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($paymenttype->pt_id->Visible) { // pt_id ?>
	<tr id="r_pt_id"<?php echo $paymenttype->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymenttype->pt_id->FldCaption() ?></td>
		<td<?php echo $paymenttype->pt_id->CellAttributes() ?>><span id="el_pt_id">
<div<?php echo $paymenttype->pt_id->ViewAttributes() ?>><?php echo $paymenttype->pt_id->EditValue ?></div>
<input type="hidden" name="x_pt_id" id="x_pt_id" value="<?php echo ew_HtmlEncode($paymenttype->pt_id->CurrentValue) ?>">
</span><?php echo $paymenttype->pt_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymenttype->pt_title->Visible) { // pt_title ?>
	<tr id="r_pt_title"<?php echo $paymenttype->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymenttype->pt_title->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $paymenttype->pt_title->CellAttributes() ?>><span id="el_pt_title">
<input type="text" name="x_pt_title" id="x_pt_title" size="30" maxlength="20" value="<?php echo $paymenttype->pt_title->EditValue ?>"<?php echo $paymenttype->pt_title->EditAttributes() ?>>
</span><?php echo $paymenttype->pt_title->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymenttype->pt_des->Visible) { // pt_des ?>
	<tr id="r_pt_des"<?php echo $paymenttype->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymenttype->pt_des->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $paymenttype->pt_des->CellAttributes() ?>><span id="el_pt_des">
<textarea name="x_pt_des" id="x_pt_des" cols="35" rows="4"<?php echo $paymenttype->pt_des->EditAttributes() ?>><?php echo $paymenttype->pt_des->EditValue ?></textarea>
</span><?php echo $paymenttype->pt_des->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$paymenttype_edit->ShowPageFooter();
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
$paymenttype_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cpaymenttype_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'paymenttype';

	// Page object name
	var $PageObjName = 'paymenttype_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $paymenttype;
		if ($paymenttype->UseTokenInUrl) $PageUrl .= "t=" . $paymenttype->TableVar . "&"; // Add page token
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
		global $objForm, $paymenttype;
		if ($paymenttype->UseTokenInUrl) {
			if ($objForm)
				return ($paymenttype->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($paymenttype->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpaymenttype_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (paymenttype)
		if (!isset($GLOBALS["paymenttype"])) {
			$GLOBALS["paymenttype"] = new cpaymenttype();
			$GLOBALS["Table"] =& $GLOBALS["paymenttype"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'paymenttype', TRUE);

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
		global $paymenttype;

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
		global $objForm, $Language, $gsFormError, $paymenttype;

		// Load key from QueryString
		if (@$_GET["pt_id"] <> "")
			$paymenttype->pt_id->setQueryStringValue($_GET["pt_id"]);
		if (@$_POST["a_edit"] <> "") {
			$paymenttype->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$paymenttype->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$paymenttype->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$paymenttype->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($paymenttype->pt_id->CurrentValue == "")
			$this->Page_Terminate("paymenttypelist.php"); // Invalid key, return to list
		switch ($paymenttype->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("paymenttypelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$paymenttype->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $paymenttype->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "paymenttypeview.php")
						$sReturnUrl = $paymenttype->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$paymenttype->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$paymenttype->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$paymenttype->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $paymenttype;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $paymenttype;
		if (!$paymenttype->pt_id->FldIsDetailKey)
			$paymenttype->pt_id->setFormValue($objForm->GetValue("x_pt_id"));
		if (!$paymenttype->pt_title->FldIsDetailKey) {
			$paymenttype->pt_title->setFormValue($objForm->GetValue("x_pt_title"));
		}
		if (!$paymenttype->pt_des->FldIsDetailKey) {
			$paymenttype->pt_des->setFormValue($objForm->GetValue("x_pt_des"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $paymenttype;
		$this->LoadRow();
		$paymenttype->pt_id->CurrentValue = $paymenttype->pt_id->FormValue;
		$paymenttype->pt_title->CurrentValue = $paymenttype->pt_title->FormValue;
		$paymenttype->pt_des->CurrentValue = $paymenttype->pt_des->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $paymenttype;
		$sFilter = $paymenttype->KeyFilter();

		// Call Row Selecting event
		$paymenttype->Row_Selecting($sFilter);

		// Load SQL based on filter
		$paymenttype->CurrentFilter = $sFilter;
		$sSql = $paymenttype->SQL();
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
		global $conn, $paymenttype;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$paymenttype->Row_Selected($row);
		$paymenttype->pt_id->setDbValue($rs->fields('pt_id'));
		$paymenttype->pt_title->setDbValue($rs->fields('pt_title'));
		$paymenttype->pt_des->setDbValue($rs->fields('pt_des'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $paymenttype;

		// Initialize URLs
		// Call Row_Rendering event

		$paymenttype->Row_Rendering();

		// Common render codes for all row types
		// pt_id
		// pt_title
		// pt_des

		if ($paymenttype->RowType == EW_ROWTYPE_VIEW) { // View row

			// pt_id
			$paymenttype->pt_id->ViewValue = $paymenttype->pt_id->CurrentValue;
			$paymenttype->pt_id->ViewCustomAttributes = "";

			// pt_title
			$paymenttype->pt_title->ViewValue = $paymenttype->pt_title->CurrentValue;
			$paymenttype->pt_title->ViewCustomAttributes = "";

			// pt_des
			$paymenttype->pt_des->ViewValue = $paymenttype->pt_des->CurrentValue;
			$paymenttype->pt_des->ViewCustomAttributes = "";

			// pt_id
			$paymenttype->pt_id->LinkCustomAttributes = "";
			$paymenttype->pt_id->HrefValue = "";
			$paymenttype->pt_id->TooltipValue = "";

			// pt_title
			$paymenttype->pt_title->LinkCustomAttributes = "";
			$paymenttype->pt_title->HrefValue = "";
			$paymenttype->pt_title->TooltipValue = "";

			// pt_des
			$paymenttype->pt_des->LinkCustomAttributes = "";
			$paymenttype->pt_des->HrefValue = "";
			$paymenttype->pt_des->TooltipValue = "";
		} elseif ($paymenttype->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// pt_id
			$paymenttype->pt_id->EditCustomAttributes = "";
			$paymenttype->pt_id->EditValue = $paymenttype->pt_id->CurrentValue;
			$paymenttype->pt_id->ViewCustomAttributes = "";

			// pt_title
			$paymenttype->pt_title->EditCustomAttributes = "";
			$paymenttype->pt_title->EditValue = ew_HtmlEncode($paymenttype->pt_title->CurrentValue);

			// pt_des
			$paymenttype->pt_des->EditCustomAttributes = "";
			$paymenttype->pt_des->EditValue = ew_HtmlEncode($paymenttype->pt_des->CurrentValue);

			// Edit refer script
			// pt_id

			$paymenttype->pt_id->HrefValue = "";

			// pt_title
			$paymenttype->pt_title->HrefValue = "";

			// pt_des
			$paymenttype->pt_des->HrefValue = "";
		}
		if ($paymenttype->RowType == EW_ROWTYPE_ADD ||
			$paymenttype->RowType == EW_ROWTYPE_EDIT ||
			$paymenttype->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$paymenttype->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($paymenttype->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$paymenttype->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $paymenttype;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($paymenttype->pt_title->FormValue) && $paymenttype->pt_title->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymenttype->pt_title->FldCaption());
		}
		if (!is_null($paymenttype->pt_des->FormValue) && $paymenttype->pt_des->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymenttype->pt_des->FldCaption());
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
		global $conn, $Security, $Language, $paymenttype;
		$sFilter = $paymenttype->KeyFilter();
		$paymenttype->CurrentFilter = $sFilter;
		$sSql = $paymenttype->SQL();
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

			// pt_title
			$paymenttype->pt_title->SetDbValueDef($rsnew, $paymenttype->pt_title->CurrentValue, "", $paymenttype->pt_title->ReadOnly);

			// pt_des
			$paymenttype->pt_des->SetDbValueDef($rsnew, $paymenttype->pt_des->CurrentValue, "", $paymenttype->pt_des->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $paymenttype->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($paymenttype->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($paymenttype->CancelMessage <> "") {
					$this->setFailureMessage($paymenttype->CancelMessage);
					$paymenttype->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$paymenttype->Row_Updated($rsold, $rsnew);
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
