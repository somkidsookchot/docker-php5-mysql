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
$prefix_add = new cprefix_add();
$Page =& $prefix_add;

// Page init
$prefix_add->Page_Init();

// Page main
$prefix_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var prefix_add = new ew_Page("prefix_add");

// page properties
prefix_add.PageID = "add"; // page ID
prefix_add.FormID = "fprefixadd"; // form ID
var EW_PAGE_ID = prefix_add.PageID; // for backward compatibility

// extend page with ValidateForm function
prefix_add.ValidateForm = function(fobj) {
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
prefix_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
prefix_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
prefix_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
prefix_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $prefix->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $prefix->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $prefix_add->ShowPageHeader(); ?>
<?php
$prefix_add->ShowMessage();
?>
<form name="fprefixadd" id="fprefixadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return prefix_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="prefix">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$prefix_add->ShowPageFooter();
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
$prefix_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cprefix_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'prefix';

	// Page object name
	var $PageObjName = 'prefix_add';

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
	function cprefix_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $prefix;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$prefix->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$prefix->CurrentAction = "I"; // Form error, reset action
				$prefix->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["prefix_id"] != "") {
				$prefix->prefix_id->setQueryStringValue($_GET["prefix_id"]);
				$prefix->setKey("prefix_id", $prefix->prefix_id->CurrentValue); // Set up key
			} else {
				$prefix->setKey("prefix_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$prefix->CurrentAction = "C"; // Copy record
			} else {
				$prefix->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($prefix->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("prefixlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$prefix->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $prefix->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "prefixview.php")
						$sReturnUrl = $prefix->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$prefix->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$prefix->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $prefix;
		$prefix->p_title->CurrentValue = NULL;
		$prefix->p_title->OldValue = $prefix->p_title->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $prefix;
		if (!$prefix->p_title->FldIsDetailKey) {
			$prefix->p_title->setFormValue($objForm->GetValue("x_p_title"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $prefix;
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $prefix;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($prefix->getKey("prefix_id")) <> "")
			$prefix->prefix_id->CurrentValue = $prefix->getKey("prefix_id"); // prefix_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$prefix->CurrentFilter = $prefix->KeyFilter();
			$sSql = $prefix->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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

			// p_title
			$prefix->p_title->LinkCustomAttributes = "";
			$prefix->p_title->HrefValue = "";
			$prefix->p_title->TooltipValue = "";
		} elseif ($prefix->RowType == EW_ROWTYPE_ADD) { // Add row

			// p_title
			$prefix->p_title->EditCustomAttributes = "";
			$prefix->p_title->EditValue = ew_HtmlEncode($prefix->p_title->CurrentValue);

			// Edit refer script
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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $prefix;
		$rsnew = array();

		// p_title
		$prefix->p_title->SetDbValueDef($rsnew, $prefix->p_title->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $prefix->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($prefix->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($prefix->CancelMessage <> "") {
				$this->setFailureMessage($prefix->CancelMessage);
				$prefix->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$prefix->prefix_id->setDbValue($conn->Insert_ID());
			$rsnew['prefix_id'] = $prefix->prefix_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$prefix->Row_Inserted($rs, $rsnew);
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
