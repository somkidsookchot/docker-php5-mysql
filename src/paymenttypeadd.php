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
$paymenttype_add = new cpaymenttype_add();
$Page =& $paymenttype_add;

// Page init
$paymenttype_add->Page_Init();

// Page main
$paymenttype_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var paymenttype_add = new ew_Page("paymenttype_add");

// page properties
paymenttype_add.PageID = "add"; // page ID
paymenttype_add.FormID = "fpaymenttypeadd"; // form ID
var EW_PAGE_ID = paymenttype_add.PageID; // for backward compatibility

// extend page with ValidateForm function
paymenttype_add.ValidateForm = function(fobj) {
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
paymenttype_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
paymenttype_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
paymenttype_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
paymenttype_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $paymenttype->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $paymenttype->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $paymenttype_add->ShowPageHeader(); ?>
<?php
$paymenttype_add->ShowMessage();
?>
<form name="fpaymenttypeadd" id="fpaymenttypeadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return paymenttype_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="paymenttype">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$paymenttype_add->ShowPageFooter();
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
$paymenttype_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cpaymenttype_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'paymenttype';

	// Page object name
	var $PageObjName = 'paymenttype_add';

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
	function cpaymenttype_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $paymenttype;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$paymenttype->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$paymenttype->CurrentAction = "I"; // Form error, reset action
				$paymenttype->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["pt_id"] != "") {
				$paymenttype->pt_id->setQueryStringValue($_GET["pt_id"]);
				$paymenttype->setKey("pt_id", $paymenttype->pt_id->CurrentValue); // Set up key
			} else {
				$paymenttype->setKey("pt_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$paymenttype->CurrentAction = "C"; // Copy record
			} else {
				$paymenttype->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($paymenttype->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("paymenttypelist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$paymenttype->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $paymenttype->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "paymenttypeview.php")
						$sReturnUrl = $paymenttype->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$paymenttype->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$paymenttype->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $paymenttype;
		$paymenttype->pt_title->CurrentValue = NULL;
		$paymenttype->pt_title->OldValue = $paymenttype->pt_title->CurrentValue;
		$paymenttype->pt_des->CurrentValue = NULL;
		$paymenttype->pt_des->OldValue = $paymenttype->pt_des->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $paymenttype;
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
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $paymenttype;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($paymenttype->getKey("pt_id")) <> "")
			$paymenttype->pt_id->CurrentValue = $paymenttype->getKey("pt_id"); // pt_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$paymenttype->CurrentFilter = $paymenttype->KeyFilter();
			$sSql = $paymenttype->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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

			// pt_title
			$paymenttype->pt_title->LinkCustomAttributes = "";
			$paymenttype->pt_title->HrefValue = "";
			$paymenttype->pt_title->TooltipValue = "";

			// pt_des
			$paymenttype->pt_des->LinkCustomAttributes = "";
			$paymenttype->pt_des->HrefValue = "";
			$paymenttype->pt_des->TooltipValue = "";
		} elseif ($paymenttype->RowType == EW_ROWTYPE_ADD) { // Add row

			// pt_title
			$paymenttype->pt_title->EditCustomAttributes = "";
			$paymenttype->pt_title->EditValue = ew_HtmlEncode($paymenttype->pt_title->CurrentValue);

			// pt_des
			$paymenttype->pt_des->EditCustomAttributes = "";
			$paymenttype->pt_des->EditValue = ew_HtmlEncode($paymenttype->pt_des->CurrentValue);

			// Edit refer script
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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $paymenttype;
		$rsnew = array();

		// pt_title
		$paymenttype->pt_title->SetDbValueDef($rsnew, $paymenttype->pt_title->CurrentValue, "", FALSE);

		// pt_des
		$paymenttype->pt_des->SetDbValueDef($rsnew, $paymenttype->pt_des->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $paymenttype->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($paymenttype->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($paymenttype->CancelMessage <> "") {
				$this->setFailureMessage($paymenttype->CancelMessage);
				$paymenttype->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$paymenttype->pt_id->setDbValue($conn->Insert_ID());
			$rsnew['pt_id'] = $paymenttype->pt_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$paymenttype->Row_Inserted($rs, $rsnew);
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
