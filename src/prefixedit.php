<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "prefixinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$prefix_edit = new cprefix_edit();
$Page =& $prefix_edit;

// Page init
$prefix_edit->Page_Init();

// Page main
$prefix_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var prefix_edit = new ew_Page("prefix_edit");

// page properties
prefix_edit.PageID = "edit"; // page ID
prefix_edit.FormID = "fprefixedit"; // form ID
var EW_PAGE_ID = prefix_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
prefix_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_p_title"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($prefix->p_title->FldCaption()) ?>");

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
prefix_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
prefix_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
prefix_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
prefix_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $prefix->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $prefix->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $prefix_edit->ShowPageHeader(); ?>
<?php
$prefix_edit->ShowMessage();
?>
<form name="fprefixedit" id="fprefixedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return prefix_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="prefix">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($prefix->prefix_id->Visible) { // prefix_id ?>
	<tr id="r_prefix_id"<?php echo $prefix->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $prefix->prefix_id->FldCaption() ?></td>
		<td<?php echo $prefix->prefix_id->CellAttributes() ?>><span id="el_prefix_id">
<div<?php echo $prefix->prefix_id->ViewAttributes() ?>><?php echo $prefix->prefix_id->EditValue ?></div>
<input type="hidden" name="x_prefix_id" id="x_prefix_id" value="<?php echo ew_HtmlEncode($prefix->prefix_id->CurrentValue) ?>">
</span><?php echo $prefix->prefix_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($prefix->p_title->Visible) { // p_title ?>
	<tr id="r_p_title"<?php echo $prefix->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $prefix->p_title->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $prefix->p_title->CellAttributes() ?>><span id="el_p_title">
<input type="text" name="x_p_title" id="x_p_title" size="30" maxlength="10" value="<?php echo $prefix->p_title->EditValue ?>"<?php echo $prefix->p_title->EditAttributes() ?>>
</span><?php echo $prefix->p_title->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$prefix_edit->ShowPageFooter();
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
$prefix_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cprefix_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'prefix';

	// Page object name
	var $PageObjName = 'prefix_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $prefix;
		if ($prefix->UseTokenInUrl) $PageUrl .= "t=" . $prefix->TableVar . "&"; // Add page token
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
		global $objForm, $prefix;
		if ($prefix->UseTokenInUrl) {
			if ($objForm)
				return ($prefix->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($prefix->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cprefix_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (prefix)
		if (!isset($GLOBALS["prefix"])) {
			$GLOBALS["prefix"] = new cprefix();
			$GLOBALS["Table"] =& $GLOBALS["prefix"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'prefix', TRUE);

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
		global $prefix;

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
		global $objForm, $Language, $gsFormError, $prefix;

		// Load key from QueryString
		if (@$_GET["prefix_id"] <> "")
			$prefix->prefix_id->setQueryStringValue($_GET["prefix_id"]);
		if (@$_POST["a_edit"] <> "") {
			$prefix->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$prefix->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$prefix->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$prefix->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($prefix->prefix_id->CurrentValue == "")
			$this->Page_Terminate("prefixlist.php"); // Invalid key, return to list
		switch ($prefix->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("prefixlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$prefix->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $prefix->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "prefixview.php")
						$sReturnUrl = $prefix->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$prefix->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$prefix->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$prefix->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $prefix;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $prefix;
		if (!$prefix->prefix_id->FldIsDetailKey)
			$prefix->prefix_id->setFormValue($objForm->GetValue("x_prefix_id"));
		if (!$prefix->p_title->FldIsDetailKey) {
			$prefix->p_title->setFormValue($objForm->GetValue("x_p_title"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $prefix;
		$this->LoadRow();
		$prefix->prefix_id->CurrentValue = $prefix->prefix_id->FormValue;
		$prefix->p_title->CurrentValue = $prefix->p_title->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $prefix;
		$sFilter = $prefix->KeyFilter();

		// Call Row Selecting event
		$prefix->Row_Selecting($sFilter);

		// Load SQL based on filter
		$prefix->CurrentFilter = $sFilter;
		$sSql = $prefix->SQL();
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
		global $conn, $prefix;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$prefix->Row_Selected($row);
		$prefix->prefix_id->setDbValue($rs->fields('prefix_id'));
		$prefix->p_title->setDbValue($rs->fields('p_title'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $prefix;

		// Initialize URLs
		// Call Row_Rendering event

		$prefix->Row_Rendering();

		// Common render codes for all row types
		// prefix_id
		// p_title

		if ($prefix->RowType == EW_ROWTYPE_VIEW) { // View row

			// prefix_id
			$prefix->prefix_id->ViewValue = $prefix->prefix_id->CurrentValue;
			$prefix->prefix_id->ViewCustomAttributes = "";

			// p_title
			$prefix->p_title->ViewValue = $prefix->p_title->CurrentValue;
			$prefix->p_title->ViewCustomAttributes = "";

			// prefix_id
			$prefix->prefix_id->LinkCustomAttributes = "";
			$prefix->prefix_id->HrefValue = "";
			$prefix->prefix_id->TooltipValue = "";

			// p_title
			$prefix->p_title->LinkCustomAttributes = "";
			$prefix->p_title->HrefValue = "";
			$prefix->p_title->TooltipValue = "";
		} elseif ($prefix->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// prefix_id
			$prefix->prefix_id->EditCustomAttributes = "";
			$prefix->prefix_id->EditValue = $prefix->prefix_id->CurrentValue;
			$prefix->prefix_id->ViewCustomAttributes = "";

			// p_title
			$prefix->p_title->EditCustomAttributes = "";
			$prefix->p_title->EditValue = ew_HtmlEncode($prefix->p_title->CurrentValue);

			// Edit refer script
			// prefix_id

			$prefix->prefix_id->HrefValue = "";

			// p_title
			$prefix->p_title->HrefValue = "";
		}
		if ($prefix->RowType == EW_ROWTYPE_ADD ||
			$prefix->RowType == EW_ROWTYPE_EDIT ||
			$prefix->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$prefix->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($prefix->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$prefix->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $prefix;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($prefix->p_title->FormValue) && $prefix->p_title->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $prefix->p_title->FldCaption());
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
		global $conn, $Security, $Language, $prefix;
		$sFilter = $prefix->KeyFilter();
		$prefix->CurrentFilter = $sFilter;
		$sSql = $prefix->SQL();
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

			// p_title
			$prefix->p_title->SetDbValueDef($rsnew, $prefix->p_title->CurrentValue, "", $prefix->p_title->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $prefix->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($prefix->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($prefix->CancelMessage <> "") {
					$this->setFailureMessage($prefix->CancelMessage);
					$prefix->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$prefix->Row_Updated($rsold, $rsnew);
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
