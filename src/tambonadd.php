<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "tamboninfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$tambon_add = new ctambon_add();
$Page =& $tambon_add;

// Page init
$tambon_add->Page_Init();

// Page main
$tambon_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tambon_add = new ew_Page("tambon_add");

// page properties
tambon_add.PageID = "add"; // page ID
tambon_add.FormID = "ftambonadd"; // form ID
var EW_PAGE_ID = tambon_add.PageID; // for backward compatibility

// extend page with ValidateForm function
tambon_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_t_order"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tambon->t_order->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_t_code"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tambon->t_code->FldCaption()) ?>");

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
tambon_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tambon_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tambon_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tambon_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tambon->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $tambon->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $tambon_add->ShowPageHeader(); ?>
<?php
$tambon_add->ShowMessage();
?>
<form name="ftambonadd" id="ftambonadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tambon_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="tambon">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tambon->t_title->Visible) { // t_title ?>
	<tr id="r_t_title"<?php echo $tambon->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tambon->t_title->FldCaption() ?></td>
		<td<?php echo $tambon->t_title->CellAttributes() ?>><span id="el_t_title">
<input type="text" name="x_t_title" id="x_t_title" size="30" maxlength="45" value="<?php echo $tambon->t_title->EditValue ?>"<?php echo $tambon->t_title->EditAttributes() ?>>
</span><?php echo $tambon->t_title->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tambon->t_order->Visible) { // t_order ?>
	<tr id="r_t_order"<?php echo $tambon->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tambon->t_order->FldCaption() ?></td>
		<td<?php echo $tambon->t_order->CellAttributes() ?>><span id="el_t_order">
<input type="text" name="x_t_order" id="x_t_order" size="30" value="<?php echo $tambon->t_order->EditValue ?>"<?php echo $tambon->t_order->EditAttributes() ?>>
</span><?php echo $tambon->t_order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tambon->t_code->Visible) { // t_code ?>
	<tr id="r_t_code"<?php echo $tambon->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $tambon->t_code->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tambon->t_code->CellAttributes() ?>><span id="el_t_code">
<textarea name="x_t_code" id="x_t_code" cols="35" rows="4"<?php echo $tambon->t_code->EditAttributes() ?>><?php echo $tambon->t_code->EditValue ?></textarea>
</span><?php echo $tambon->t_code->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$tambon_add->ShowPageFooter();
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
$tambon_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctambon_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'tambon';

	// Page object name
	var $PageObjName = 'tambon_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tambon;
		if ($tambon->UseTokenInUrl) $PageUrl .= "t=" . $tambon->TableVar . "&"; // Add page token
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
		global $objForm, $tambon;
		if ($tambon->UseTokenInUrl) {
			if ($objForm)
				return ($tambon->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tambon->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctambon_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (tambon)
		if (!isset($GLOBALS["tambon"])) {
			$GLOBALS["tambon"] = new ctambon();
			$GLOBALS["Table"] =& $GLOBALS["tambon"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tambon', TRUE);

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
		global $tambon;

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
		global $objForm, $Language, $gsFormError, $tambon;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$tambon->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tambon->CurrentAction = "I"; // Form error, reset action
				$tambon->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["t_id"] != "") {
				$tambon->t_id->setQueryStringValue($_GET["t_id"]);
				$tambon->setKey("t_id", $tambon->t_id->CurrentValue); // Set up key
			} else {
				$tambon->setKey("t_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$tambon->CurrentAction = "C"; // Copy record
			} else {
				$tambon->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($tambon->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tambonlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$tambon->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $tambon->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tambonview.php")
						$sReturnUrl = $tambon->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$tambon->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$tambon->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$tambon->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tambon;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $tambon;
		$tambon->t_title->CurrentValue = NULL;
		$tambon->t_title->OldValue = $tambon->t_title->CurrentValue;
		$tambon->t_order->CurrentValue = NULL;
		$tambon->t_order->OldValue = $tambon->t_order->CurrentValue;
		$tambon->t_code->CurrentValue = NULL;
		$tambon->t_code->OldValue = $tambon->t_code->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tambon;
		if (!$tambon->t_title->FldIsDetailKey) {
			$tambon->t_title->setFormValue($objForm->GetValue("x_t_title"));
		}
		if (!$tambon->t_order->FldIsDetailKey) {
			$tambon->t_order->setFormValue($objForm->GetValue("x_t_order"));
		}
		if (!$tambon->t_code->FldIsDetailKey) {
			$tambon->t_code->setFormValue($objForm->GetValue("x_t_code"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tambon;
		$this->LoadOldRecord();
		$tambon->t_title->CurrentValue = $tambon->t_title->FormValue;
		$tambon->t_order->CurrentValue = $tambon->t_order->FormValue;
		$tambon->t_code->CurrentValue = $tambon->t_code->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tambon;
		$sFilter = $tambon->KeyFilter();

		// Call Row Selecting event
		$tambon->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tambon->CurrentFilter = $sFilter;
		$sSql = $tambon->SQL();
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
		global $conn, $tambon;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$tambon->Row_Selected($row);
		$tambon->t_id->setDbValue($rs->fields('t_id'));
		$tambon->t_title->setDbValue($rs->fields('t_title'));
		$tambon->t_order->setDbValue($rs->fields('t_order'));
		$tambon->t_code->setDbValue($rs->fields('t_code'));
	}

	// Load old record
	function LoadOldRecord() {
		global $tambon;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($tambon->getKey("t_id")) <> "")
			$tambon->t_id->CurrentValue = $tambon->getKey("t_id"); // t_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$tambon->CurrentFilter = $tambon->KeyFilter();
			$sSql = $tambon->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tambon;

		// Initialize URLs
		// Call Row_Rendering event

		$tambon->Row_Rendering();

		// Common render codes for all row types
		// t_id
		// t_title
		// t_order
		// t_code

		if ($tambon->RowType == EW_ROWTYPE_VIEW) { // View row

			// t_id
			$tambon->t_id->ViewValue = $tambon->t_id->CurrentValue;
			$tambon->t_id->ViewCustomAttributes = "";

			// t_title
			$tambon->t_title->ViewValue = $tambon->t_title->CurrentValue;
			$tambon->t_title->ViewCustomAttributes = "";

			// t_order
			$tambon->t_order->ViewValue = $tambon->t_order->CurrentValue;
			$tambon->t_order->ViewCustomAttributes = "";

			// t_code
			$tambon->t_code->ViewValue = $tambon->t_code->CurrentValue;
			$tambon->t_code->ViewCustomAttributes = "";

			// t_title
			$tambon->t_title->LinkCustomAttributes = "";
			$tambon->t_title->HrefValue = "";
			$tambon->t_title->TooltipValue = "";

			// t_order
			$tambon->t_order->LinkCustomAttributes = "";
			$tambon->t_order->HrefValue = "";
			$tambon->t_order->TooltipValue = "";

			// t_code
			$tambon->t_code->LinkCustomAttributes = "";
			$tambon->t_code->HrefValue = "";
			$tambon->t_code->TooltipValue = "";
		} elseif ($tambon->RowType == EW_ROWTYPE_ADD) { // Add row

			// t_title
			$tambon->t_title->EditCustomAttributes = "";
			$tambon->t_title->EditValue = ew_HtmlEncode($tambon->t_title->CurrentValue);

			// t_order
			$tambon->t_order->EditCustomAttributes = "";
			$tambon->t_order->EditValue = ew_HtmlEncode($tambon->t_order->CurrentValue);

			// t_code
			$tambon->t_code->EditCustomAttributes = "";
			$tambon->t_code->EditValue = ew_HtmlEncode($tambon->t_code->CurrentValue);

			// Edit refer script
			// t_title

			$tambon->t_title->HrefValue = "";

			// t_order
			$tambon->t_order->HrefValue = "";

			// t_code
			$tambon->t_code->HrefValue = "";
		}
		if ($tambon->RowType == EW_ROWTYPE_ADD ||
			$tambon->RowType == EW_ROWTYPE_EDIT ||
			$tambon->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$tambon->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($tambon->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tambon->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tambon;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($tambon->t_order->FormValue)) {
			ew_AddMessage($gsFormError, $tambon->t_order->FldErrMsg());
		}
		if (!is_null($tambon->t_code->FormValue) && $tambon->t_code->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $tambon->t_code->FldCaption());
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
		global $conn, $Language, $Security, $tambon;
		$rsnew = array();

		// t_title
		$tambon->t_title->SetDbValueDef($rsnew, $tambon->t_title->CurrentValue, NULL, FALSE);

		// t_order
		$tambon->t_order->SetDbValueDef($rsnew, $tambon->t_order->CurrentValue, NULL, FALSE);

		// t_code
		$tambon->t_code->SetDbValueDef($rsnew, $tambon->t_code->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $tambon->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tambon->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tambon->CancelMessage <> "") {
				$this->setFailureMessage($tambon->CancelMessage);
				$tambon->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$tambon->t_id->setDbValue($conn->Insert_ID());
			$rsnew['t_id'] = $tambon->t_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$tambon->Row_Inserted($rs, $rsnew);
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
