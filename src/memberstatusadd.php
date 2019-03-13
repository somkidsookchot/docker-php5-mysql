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
$memberstatus_add = new cmemberstatus_add();
$Page =& $memberstatus_add;

// Page init
$memberstatus_add->Page_Init();

// Page main
$memberstatus_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var memberstatus_add = new ew_Page("memberstatus_add");

// page properties
memberstatus_add.PageID = "add"; // page ID
memberstatus_add.FormID = "fmemberstatusadd"; // form ID
var EW_PAGE_ID = memberstatus_add.PageID; // for backward compatibility

// extend page with ValidateForm function
memberstatus_add.ValidateForm = function(fobj) {
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
memberstatus_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
memberstatus_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
memberstatus_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memberstatus_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $memberstatus->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $memberstatus->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $memberstatus_add->ShowPageHeader(); ?>
<?php
$memberstatus_add->ShowMessage();
?>
<form name="fmemberstatusadd" id="fmemberstatusadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return memberstatus_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="memberstatus">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$memberstatus_add->ShowPageFooter();
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
$memberstatus_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cmemberstatus_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'memberstatus';

	// Page object name
	var $PageObjName = 'memberstatus_add';

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
	function cmemberstatus_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $memberstatus;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$memberstatus->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$memberstatus->CurrentAction = "I"; // Form error, reset action
				$memberstatus->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["s_id"] != "") {
				$memberstatus->s_id->setQueryStringValue($_GET["s_id"]);
				$memberstatus->setKey("s_id", $memberstatus->s_id->CurrentValue); // Set up key
			} else {
				$memberstatus->setKey("s_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$memberstatus->CurrentAction = "C"; // Copy record
			} else {
				$memberstatus->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($memberstatus->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("memberstatuslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$memberstatus->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $memberstatus->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "memberstatusview.php")
						$sReturnUrl = $memberstatus->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$memberstatus->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$memberstatus->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $memberstatus;
		$memberstatus->s_title->CurrentValue = NULL;
		$memberstatus->s_title->OldValue = $memberstatus->s_title->CurrentValue;
		$memberstatus->s_des->CurrentValue = NULL;
		$memberstatus->s_des->OldValue = $memberstatus->s_des->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $memberstatus;
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
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $memberstatus;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($memberstatus->getKey("s_id")) <> "")
			$memberstatus->s_id->CurrentValue = $memberstatus->getKey("s_id"); // s_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$memberstatus->CurrentFilter = $memberstatus->KeyFilter();
			$sSql = $memberstatus->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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

			// s_title
			$memberstatus->s_title->LinkCustomAttributes = "";
			$memberstatus->s_title->HrefValue = "";
			$memberstatus->s_title->TooltipValue = "";

			// s_des
			$memberstatus->s_des->LinkCustomAttributes = "";
			$memberstatus->s_des->HrefValue = "";
			$memberstatus->s_des->TooltipValue = "";
		} elseif ($memberstatus->RowType == EW_ROWTYPE_ADD) { // Add row

			// s_title
			$memberstatus->s_title->EditCustomAttributes = "";
			$memberstatus->s_title->EditValue = ew_HtmlEncode($memberstatus->s_title->CurrentValue);

			// s_des
			$memberstatus->s_des->EditCustomAttributes = "";
			$memberstatus->s_des->EditValue = ew_HtmlEncode($memberstatus->s_des->CurrentValue);

			// Edit refer script
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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $memberstatus;
		$rsnew = array();

		// s_title
		$memberstatus->s_title->SetDbValueDef($rsnew, $memberstatus->s_title->CurrentValue, "", FALSE);

		// s_des
		$memberstatus->s_des->SetDbValueDef($rsnew, $memberstatus->s_des->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $memberstatus->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($memberstatus->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($memberstatus->CancelMessage <> "") {
				$this->setFailureMessage($memberstatus->CancelMessage);
				$memberstatus->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$memberstatus->s_id->setDbValue($conn->Insert_ID());
			$rsnew['s_id'] = $memberstatus->s_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$memberstatus->Row_Inserted($rs, $rsnew);
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
