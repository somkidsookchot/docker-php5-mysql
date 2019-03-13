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
$gender_add = new cgender_add();
$Page =& $gender_add;

// Page init
$gender_add->Page_Init();

// Page main
$gender_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var gender_add = new ew_Page("gender_add");

// page properties
gender_add.PageID = "add"; // page ID
gender_add.FormID = "fgenderadd"; // form ID
var EW_PAGE_ID = gender_add.PageID; // for backward compatibility

// extend page with ValidateForm function
gender_add.ValidateForm = function(fobj) {
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
gender_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
gender_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
gender_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
gender_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $gender->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $gender->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $gender_add->ShowPageHeader(); ?>
<?php
$gender_add->ShowMessage();
?>
<form name="fgenderadd" id="fgenderadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return gender_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="gender">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$gender_add->ShowPageFooter();
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
$gender_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cgender_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'gender';

	// Page object name
	var $PageObjName = 'gender_add';

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
	function cgender_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gender;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$gender->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$gender->CurrentAction = "I"; // Form error, reset action
				$gender->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["gender_id"] != "") {
				$gender->gender_id->setQueryStringValue($_GET["gender_id"]);
				$gender->setKey("gender_id", $gender->gender_id->CurrentValue); // Set up key
			} else {
				$gender->setKey("gender_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$gender->CurrentAction = "C"; // Copy record
			} else {
				$gender->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($gender->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("genderlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$gender->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $gender->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "genderview.php")
						$sReturnUrl = $gender->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$gender->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$gender->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $gender;
		$gender->g_title->CurrentValue = NULL;
		$gender->g_title->OldValue = $gender->g_title->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $gender;
		if (!$gender->g_title->FldIsDetailKey) {
			$gender->g_title->setFormValue($objForm->GetValue("x_g_title"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $gender;
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $gender;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($gender->getKey("gender_id")) <> "")
			$gender->gender_id->CurrentValue = $gender->getKey("gender_id"); // gender_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$gender->CurrentFilter = $gender->KeyFilter();
			$sSql = $gender->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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

			// g_title
			$gender->g_title->LinkCustomAttributes = "";
			$gender->g_title->HrefValue = "";
			$gender->g_title->TooltipValue = "";
		} elseif ($gender->RowType == EW_ROWTYPE_ADD) { // Add row

			// g_title
			$gender->g_title->EditCustomAttributes = "";
			$gender->g_title->EditValue = ew_HtmlEncode($gender->g_title->CurrentValue);

			// Edit refer script
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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $gender;
		$rsnew = array();

		// g_title
		$gender->g_title->SetDbValueDef($rsnew, $gender->g_title->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $gender->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($gender->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($gender->CancelMessage <> "") {
				$this->setFailureMessage($gender->CancelMessage);
				$gender->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$gender->gender_id->setDbValue($conn->Insert_ID());
			$rsnew['gender_id'] = $gender->gender_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$gender->Row_Inserted($rs, $rsnew);
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
