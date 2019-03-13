<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "memberstatusinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$memberstatus_edit = new cmemberstatus_edit();
$Page =& $memberstatus_edit;

// Page init
$memberstatus_edit->Page_Init();

// Page main
$memberstatus_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var memberstatus_edit = new ew_Page("memberstatus_edit");

// page properties
memberstatus_edit.PageID = "edit"; // page ID
memberstatus_edit.FormID = "fmemberstatusedit"; // form ID
var EW_PAGE_ID = memberstatus_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
memberstatus_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_s_title"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($memberstatus->s_title->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_s_des"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($memberstatus->s_des->FldCaption()) ?>");

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
memberstatus_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
memberstatus_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
memberstatus_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memberstatus_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $memberstatus->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $memberstatus->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $memberstatus_edit->ShowPageHeader(); ?>
<?php
$memberstatus_edit->ShowMessage();
?>
<form name="fmemberstatusedit" id="fmemberstatusedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return memberstatus_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="memberstatus">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($memberstatus->s_id->Visible) { // s_id ?>
	<tr id="r_s_id"<?php echo $memberstatus->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memberstatus->s_id->FldCaption() ?></td>
		<td<?php echo $memberstatus->s_id->CellAttributes() ?>><span id="el_s_id">
<div<?php echo $memberstatus->s_id->ViewAttributes() ?>><?php echo $memberstatus->s_id->EditValue ?></div>
<input type="hidden" name="x_s_id" id="x_s_id" value="<?php echo ew_HtmlEncode($memberstatus->s_id->CurrentValue) ?>">
</span><?php echo $memberstatus->s_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($memberstatus->s_title->Visible) { // s_title ?>
	<tr id="r_s_title"<?php echo $memberstatus->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memberstatus->s_title->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $memberstatus->s_title->CellAttributes() ?>><span id="el_s_title">
<input type="text" name="x_s_title" id="x_s_title" size="30" maxlength="20" value="<?php echo $memberstatus->s_title->EditValue ?>"<?php echo $memberstatus->s_title->EditAttributes() ?>>
</span><?php echo $memberstatus->s_title->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($memberstatus->s_des->Visible) { // s_des ?>
	<tr id="r_s_des"<?php echo $memberstatus->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memberstatus->s_des->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $memberstatus->s_des->CellAttributes() ?>><span id="el_s_des">
<input type="text" name="x_s_des" id="x_s_des" value="<?php echo $memberstatus->s_des->EditValue ?>"<?php echo $memberstatus->s_des->EditAttributes() ?>>
</span><?php echo $memberstatus->s_des->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$memberstatus_edit->ShowPageFooter();
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
$memberstatus_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cmemberstatus_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'memberstatus';

	// Page object name
	var $PageObjName = 'memberstatus_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $memberstatus;
		if ($memberstatus->UseTokenInUrl) $PageUrl .= "t=" . $memberstatus->TableVar . "&"; // Add page token
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
		global $objForm, $memberstatus;
		if ($memberstatus->UseTokenInUrl) {
			if ($objForm)
				return ($memberstatus->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($memberstatus->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmemberstatus_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (memberstatus)
		if (!isset($GLOBALS["memberstatus"])) {
			$GLOBALS["memberstatus"] = new cmemberstatus();
			$GLOBALS["Table"] =& $GLOBALS["memberstatus"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'memberstatus', TRUE);

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
		global $memberstatus;

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
		global $objForm, $Language, $gsFormError, $memberstatus;

		// Load key from QueryString
		if (@$_GET["s_id"] <> "")
			$memberstatus->s_id->setQueryStringValue($_GET["s_id"]);
		if (@$_POST["a_edit"] <> "") {
			$memberstatus->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$memberstatus->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$memberstatus->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$memberstatus->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($memberstatus->s_id->CurrentValue == "")
			$this->Page_Terminate("memberstatuslist.php"); // Invalid key, return to list
		switch ($memberstatus->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("memberstatuslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$memberstatus->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $memberstatus->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "memberstatusview.php")
						$sReturnUrl = $memberstatus->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$memberstatus->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$memberstatus->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$memberstatus->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $memberstatus;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $memberstatus;
		if (!$memberstatus->s_id->FldIsDetailKey)
			$memberstatus->s_id->setFormValue($objForm->GetValue("x_s_id"));
		if (!$memberstatus->s_title->FldIsDetailKey) {
			$memberstatus->s_title->setFormValue($objForm->GetValue("x_s_title"));
		}
		if (!$memberstatus->s_des->FldIsDetailKey) {
			$memberstatus->s_des->setFormValue($objForm->GetValue("x_s_des"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $memberstatus;
		$this->LoadRow();
		$memberstatus->s_id->CurrentValue = $memberstatus->s_id->FormValue;
		$memberstatus->s_title->CurrentValue = $memberstatus->s_title->FormValue;
		$memberstatus->s_des->CurrentValue = $memberstatus->s_des->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $memberstatus;
		$sFilter = $memberstatus->KeyFilter();

		// Call Row Selecting event
		$memberstatus->Row_Selecting($sFilter);

		// Load SQL based on filter
		$memberstatus->CurrentFilter = $sFilter;
		$sSql = $memberstatus->SQL();
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
		global $conn, $memberstatus;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$memberstatus->Row_Selected($row);
		$memberstatus->s_id->setDbValue($rs->fields('s_id'));
		$memberstatus->s_title->setDbValue($rs->fields('s_title'));
		$memberstatus->s_des->setDbValue($rs->fields('s_des'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $memberstatus;

		// Initialize URLs
		// Call Row_Rendering event

		$memberstatus->Row_Rendering();

		// Common render codes for all row types
		// s_id
		// s_title
		// s_des

		if ($memberstatus->RowType == EW_ROWTYPE_VIEW) { // View row

			// s_id
			$memberstatus->s_id->ViewValue = $memberstatus->s_id->CurrentValue;
			$memberstatus->s_id->ViewCustomAttributes = "";

			// s_title
			$memberstatus->s_title->ViewValue = $memberstatus->s_title->CurrentValue;
			$memberstatus->s_title->ViewCustomAttributes = "";

			// s_des
			$memberstatus->s_des->ViewValue = $memberstatus->s_des->CurrentValue;
			$memberstatus->s_des->ViewCustomAttributes = "";

			// s_id
			$memberstatus->s_id->LinkCustomAttributes = "";
			$memberstatus->s_id->HrefValue = "";
			$memberstatus->s_id->TooltipValue = "";

			// s_title
			$memberstatus->s_title->LinkCustomAttributes = "";
			$memberstatus->s_title->HrefValue = "";
			$memberstatus->s_title->TooltipValue = "";

			// s_des
			$memberstatus->s_des->LinkCustomAttributes = "";
			$memberstatus->s_des->HrefValue = "";
			$memberstatus->s_des->TooltipValue = "";
		} elseif ($memberstatus->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// s_id
			$memberstatus->s_id->EditCustomAttributes = "";
			$memberstatus->s_id->EditValue = $memberstatus->s_id->CurrentValue;
			$memberstatus->s_id->ViewCustomAttributes = "";

			// s_title
			$memberstatus->s_title->EditCustomAttributes = "";
			$memberstatus->s_title->EditValue = ew_HtmlEncode($memberstatus->s_title->CurrentValue);

			// s_des
			$memberstatus->s_des->EditCustomAttributes = "";
			$memberstatus->s_des->EditValue = ew_HtmlEncode($memberstatus->s_des->CurrentValue);

			// Edit refer script
			// s_id

			$memberstatus->s_id->HrefValue = "";

			// s_title
			$memberstatus->s_title->HrefValue = "";

			// s_des
			$memberstatus->s_des->HrefValue = "";
		}
		if ($memberstatus->RowType == EW_ROWTYPE_ADD ||
			$memberstatus->RowType == EW_ROWTYPE_EDIT ||
			$memberstatus->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$memberstatus->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($memberstatus->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$memberstatus->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $memberstatus;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($memberstatus->s_title->FormValue) && $memberstatus->s_title->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $memberstatus->s_title->FldCaption());
		}
		if (!is_null($memberstatus->s_des->FormValue) && $memberstatus->s_des->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $memberstatus->s_des->FldCaption());
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
		global $conn, $Security, $Language, $memberstatus;
		$sFilter = $memberstatus->KeyFilter();
		$memberstatus->CurrentFilter = $sFilter;
		$sSql = $memberstatus->SQL();
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

			// s_title
			$memberstatus->s_title->SetDbValueDef($rsnew, $memberstatus->s_title->CurrentValue, "", $memberstatus->s_title->ReadOnly);

			// s_des
			$memberstatus->s_des->SetDbValueDef($rsnew, $memberstatus->s_des->CurrentValue, "", $memberstatus->s_des->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $memberstatus->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($memberstatus->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($memberstatus->CancelMessage <> "") {
					$this->setFailureMessage($memberstatus->CancelMessage);
					$memberstatus->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$memberstatus->Row_Updated($rsold, $rsnew);
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
