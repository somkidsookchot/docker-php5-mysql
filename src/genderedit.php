<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "genderinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$gender_edit = new cgender_edit();
$Page =& $gender_edit;

// Page init
$gender_edit->Page_Init();

// Page main
$gender_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var gender_edit = new ew_Page("gender_edit");

// page properties
gender_edit.PageID = "edit"; // page ID
gender_edit.FormID = "fgenderedit"; // form ID
var EW_PAGE_ID = gender_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
gender_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_g_title"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($gender->g_title->FldCaption()) ?>");

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
gender_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
gender_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
gender_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
gender_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $gender->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $gender->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $gender_edit->ShowPageHeader(); ?>
<?php
$gender_edit->ShowMessage();
?>
<form name="fgenderedit" id="fgenderedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return gender_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="gender">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($gender->gender_id->Visible) { // gender_id ?>
	<tr id="r_gender_id"<?php echo $gender->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $gender->gender_id->FldCaption() ?></td>
		<td<?php echo $gender->gender_id->CellAttributes() ?>><span id="el_gender_id">
<div<?php echo $gender->gender_id->ViewAttributes() ?>><?php echo $gender->gender_id->EditValue ?></div>
<input type="hidden" name="x_gender_id" id="x_gender_id" value="<?php echo ew_HtmlEncode($gender->gender_id->CurrentValue) ?>">
</span><?php echo $gender->gender_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($gender->g_title->Visible) { // g_title ?>
	<tr id="r_g_title"<?php echo $gender->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $gender->g_title->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $gender->g_title->CellAttributes() ?>><span id="el_g_title">
<input type="text" name="x_g_title" id="x_g_title" size="30" maxlength="5" value="<?php echo $gender->g_title->EditValue ?>"<?php echo $gender->g_title->EditAttributes() ?>>
</span><?php echo $gender->g_title->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$gender_edit->ShowPageFooter();
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
$gender_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cgender_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'gender';

	// Page object name
	var $PageObjName = 'gender_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $gender;
		if ($gender->UseTokenInUrl) $PageUrl .= "t=" . $gender->TableVar . "&"; // Add page token
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
		global $objForm, $gender;
		if ($gender->UseTokenInUrl) {
			if ($objForm)
				return ($gender->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($gender->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgender_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (gender)
		if (!isset($GLOBALS["gender"])) {
			$GLOBALS["gender"] = new cgender();
			$GLOBALS["Table"] =& $GLOBALS["gender"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'gender', TRUE);

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
		global $gender;

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
		global $objForm, $Language, $gsFormError, $gender;

		// Load key from QueryString
		if (@$_GET["gender_id"] <> "")
			$gender->gender_id->setQueryStringValue($_GET["gender_id"]);
		if (@$_POST["a_edit"] <> "") {
			$gender->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$gender->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$gender->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$gender->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($gender->gender_id->CurrentValue == "")
			$this->Page_Terminate("genderlist.php"); // Invalid key, return to list
		switch ($gender->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("genderlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$gender->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $gender->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "genderview.php")
						$sReturnUrl = $gender->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$gender->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$gender->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$gender->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $gender;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $gender;
		if (!$gender->gender_id->FldIsDetailKey)
			$gender->gender_id->setFormValue($objForm->GetValue("x_gender_id"));
		if (!$gender->g_title->FldIsDetailKey) {
			$gender->g_title->setFormValue($objForm->GetValue("x_g_title"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $gender;
		$this->LoadRow();
		$gender->gender_id->CurrentValue = $gender->gender_id->FormValue;
		$gender->g_title->CurrentValue = $gender->g_title->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $gender;
		$sFilter = $gender->KeyFilter();

		// Call Row Selecting event
		$gender->Row_Selecting($sFilter);

		// Load SQL based on filter
		$gender->CurrentFilter = $sFilter;
		$sSql = $gender->SQL();
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
		global $conn, $gender;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$gender->Row_Selected($row);
		$gender->gender_id->setDbValue($rs->fields('gender_id'));
		$gender->g_title->setDbValue($rs->fields('g_title'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $gender;

		// Initialize URLs
		// Call Row_Rendering event

		$gender->Row_Rendering();

		// Common render codes for all row types
		// gender_id
		// g_title

		if ($gender->RowType == EW_ROWTYPE_VIEW) { // View row

			// gender_id
			$gender->gender_id->ViewValue = $gender->gender_id->CurrentValue;
			$gender->gender_id->ViewCustomAttributes = "";

			// g_title
			$gender->g_title->ViewValue = $gender->g_title->CurrentValue;
			$gender->g_title->ViewCustomAttributes = "";

			// gender_id
			$gender->gender_id->LinkCustomAttributes = "";
			$gender->gender_id->HrefValue = "";
			$gender->gender_id->TooltipValue = "";

			// g_title
			$gender->g_title->LinkCustomAttributes = "";
			$gender->g_title->HrefValue = "";
			$gender->g_title->TooltipValue = "";
		} elseif ($gender->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// gender_id
			$gender->gender_id->EditCustomAttributes = "";
			$gender->gender_id->EditValue = $gender->gender_id->CurrentValue;
			$gender->gender_id->ViewCustomAttributes = "";

			// g_title
			$gender->g_title->EditCustomAttributes = "";
			$gender->g_title->EditValue = ew_HtmlEncode($gender->g_title->CurrentValue);

			// Edit refer script
			// gender_id

			$gender->gender_id->HrefValue = "";

			// g_title
			$gender->g_title->HrefValue = "";
		}
		if ($gender->RowType == EW_ROWTYPE_ADD ||
			$gender->RowType == EW_ROWTYPE_EDIT ||
			$gender->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$gender->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($gender->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$gender->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $gender;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($gender->g_title->FormValue) && $gender->g_title->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $gender->g_title->FldCaption());
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
		global $conn, $Security, $Language, $gender;
		$sFilter = $gender->KeyFilter();
		$gender->CurrentFilter = $sFilter;
		$sSql = $gender->SQL();
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

			// g_title
			$gender->g_title->SetDbValueDef($rsnew, $gender->g_title->CurrentValue, "", $gender->g_title->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $gender->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($gender->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($gender->CancelMessage <> "") {
					$this->setFailureMessage($gender->CancelMessage);
					$gender->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$gender->Row_Updated($rsold, $rsnew);
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
