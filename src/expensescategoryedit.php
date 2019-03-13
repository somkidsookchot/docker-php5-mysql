<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "expensescategoryinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "expenseslistinfo.php" ?>
<?php include_once "expenseslistgridcls.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$expensescategory_edit = new cexpensescategory_edit();
$Page =& $expensescategory_edit;

// Page init
$expensescategory_edit->Page_Init();

// Page main
$expensescategory_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expensescategory_edit = new ew_Page("expensescategory_edit");

// page properties
expensescategory_edit.PageID = "edit"; // page ID
expensescategory_edit.FormID = "fexpensescategoryedit"; // form ID
var EW_PAGE_ID = expensescategory_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
expensescategory_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_exp_cat_title"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expensescategory->exp_cat_title->FldCaption()) ?>");

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
expensescategory_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expensescategory_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expensescategory_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expensescategory_edit.ValidateRequired = false; // no JavaScript validation
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
<div class="phpmaker ewTitle"><img src="images/ico_payall.png" width="40" height="40" align="absmiddle" />&nbsp;<?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expensescategory->TableCaption() ?></div>
<div class="clear"></div>
<?php $expensescategory_edit->ShowPageHeader(); ?>
<?php
$expensescategory_edit->ShowMessage();
?>
<form name="fexpensescategoryedit" id="fexpensescategoryedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return expensescategory_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="expensescategory">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($expensescategory->exp_cat_title->Visible) { // exp_cat_title ?>
	<tr id="r_exp_cat_title"<?php echo $expensescategory->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expensescategory->exp_cat_title->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expensescategory->exp_cat_title->CellAttributes() ?>><span id="el_exp_cat_title">
<textarea name="x_exp_cat_title" id="x_exp_cat_title" cols="35" rows="4"<?php echo $expensescategory->exp_cat_title->EditAttributes() ?>><?php echo $expensescategory->exp_cat_title->EditValue ?></textarea>
</span><?php echo $expensescategory->exp_cat_title->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_exp_cat_id" id="x_exp_cat_id" value="<?php echo ew_HtmlEncode($expensescategory->exp_cat_id->CurrentValue) ?>">
<p>
<?php if ($expensescategory->getCurrentDetailTable() == "expenseslist" && $expenseslist->DetailEdit) { ?>
<br>
<?php include_once "expenseslistgrid.php" ?>
<br>
<?php } ?>
<a href="<?php echo $expensescategory->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a>&nbsp;<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$expensescategory_edit->ShowPageFooter();
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
$expensescategory_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpensescategory_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'expensescategory';

	// Page object name
	var $PageObjName = 'expensescategory_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expensescategory;
		if ($expensescategory->UseTokenInUrl) $PageUrl .= "t=" . $expensescategory->TableVar . "&"; // Add page token
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
		global $objForm, $expensescategory;
		if ($expensescategory->UseTokenInUrl) {
			if ($objForm)
				return ($expensescategory->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expensescategory->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpensescategory_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (expensescategory)
		if (!isset($GLOBALS["expensescategory"])) {
			$GLOBALS["expensescategory"] = new cexpensescategory();
			$GLOBALS["Table"] =& $GLOBALS["expensescategory"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Table object (expenseslist)
		if (!isset($GLOBALS['expenseslist'])) $GLOBALS['expenseslist'] = new cexpenseslist();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expensescategory', TRUE);

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
		global $expensescategory;

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
		global $objForm, $Language, $gsFormError, $expensescategory;

		// Load key from QueryString
		if (@$_GET["exp_cat_id"] <> "")
			$expensescategory->exp_cat_id->setQueryStringValue($_GET["exp_cat_id"]);
		if (@$_POST["a_edit"] <> "") {
			$expensescategory->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$expensescategory->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$expensescategory->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$expensescategory->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($expensescategory->exp_cat_id->CurrentValue == "")
			$this->Page_Terminate("expensescategorylist.php"); // Invalid key, return to list

		// Set up detail parameters
		$this->SetUpDetailParms();
		switch ($expensescategory->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("expensescategorylist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$expensescategory->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					if ($expensescategory->getCurrentDetailTable() <> "") // Master/detail edit
						$sReturnUrl = $expensescategory->getDetailUrl();
					else
						$sReturnUrl = $expensescategory->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "expensescategoryview.php")
						$sReturnUrl = $expensescategory->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$expensescategory->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$expensescategory->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$expensescategory->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $expensescategory;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $expensescategory;
		if (!$expensescategory->exp_cat_title->FldIsDetailKey) {
			$expensescategory->exp_cat_title->setFormValue($objForm->GetValue("x_exp_cat_title"));
		}
		if (!$expensescategory->exp_cat_id->FldIsDetailKey)
			$expensescategory->exp_cat_id->setFormValue($objForm->GetValue("x_exp_cat_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $expensescategory;
		$this->LoadRow();
		$expensescategory->exp_cat_id->CurrentValue = $expensescategory->exp_cat_id->FormValue;
		$expensescategory->exp_cat_title->CurrentValue = $expensescategory->exp_cat_title->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expensescategory;
		$sFilter = $expensescategory->KeyFilter();

		// Call Row Selecting event
		$expensescategory->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expensescategory->CurrentFilter = $sFilter;
		$sSql = $expensescategory->SQL();
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
		global $conn, $expensescategory;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$expensescategory->Row_Selected($row);
		$expensescategory->exp_cat_id->setDbValue($rs->fields('exp_cat_id'));
		$expensescategory->exp_cat_title->setDbValue($rs->fields('exp_cat_title'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expensescategory;

		// Initialize URLs
		// Call Row_Rendering event

		$expensescategory->Row_Rendering();

		// Common render codes for all row types
		// exp_cat_id
		// exp_cat_title

		if ($expensescategory->RowType == EW_ROWTYPE_VIEW) { // View row

			// exp_cat_title
			$expensescategory->exp_cat_title->ViewValue = $expensescategory->exp_cat_title->CurrentValue;
			$expensescategory->exp_cat_title->ViewCustomAttributes = "";

			// exp_cat_title
			$expensescategory->exp_cat_title->LinkCustomAttributes = "";
			$expensescategory->exp_cat_title->HrefValue = "";
			$expensescategory->exp_cat_title->TooltipValue = "";
		} elseif ($expensescategory->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// exp_cat_title
			$expensescategory->exp_cat_title->EditCustomAttributes = "";
			$expensescategory->exp_cat_title->EditValue = ew_HtmlEncode($expensescategory->exp_cat_title->CurrentValue);

			// Edit refer script
			// exp_cat_title

			$expensescategory->exp_cat_title->HrefValue = "";
		}
		if ($expensescategory->RowType == EW_ROWTYPE_ADD ||
			$expensescategory->RowType == EW_ROWTYPE_EDIT ||
			$expensescategory->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$expensescategory->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($expensescategory->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expensescategory->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $expensescategory;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($expensescategory->exp_cat_title->FormValue) && $expensescategory->exp_cat_title->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expensescategory->exp_cat_title->FldCaption());
		}

		// Validate detail grid
		if ($expensescategory->getCurrentDetailTable() == "expenseslist" && $GLOBALS["expenseslist"]->DetailEdit) {
			$expenseslist_grid = new cexpenseslist_grid(); // get detail page object
			$expenseslist_grid->ValidateGridForm();
			$expenseslist_grid = NULL;
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
		global $conn, $Security, $Language, $expensescategory;
		$sFilter = $expensescategory->KeyFilter();
			if ($expensescategory->exp_cat_title->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`exp_cat_title` = '" . ew_AdjustSql($expensescategory->exp_cat_title->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$expensescategory->CurrentFilter = $sFilterChk;
			$sSqlChk = $expensescategory->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $expensescategory->exp_cat_title->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $expensescategory->exp_cat_title->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$expensescategory->CurrentFilter = $sFilter;
		$sSql = $expensescategory->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($expensescategory->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// exp_cat_title
			$expensescategory->exp_cat_title->SetDbValueDef($rsnew, $expensescategory->exp_cat_title->CurrentValue, "", $expensescategory->exp_cat_title->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $expensescategory->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($expensescategory->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';

				// Update detail records
				if ($EditRow) {
					if ($expensescategory->getCurrentDetailTable() == "expenseslist" && $GLOBALS["expenseslist"]->DetailEdit) {
						$expenseslist_grid = new cexpenseslist_grid(); // get detail page object
						$EditRow = $expenseslist_grid->GridUpdate();
						$expenseslist_grid = NULL;
					}
				}

				// Commit/Rollback transaction
				if ($expensescategory->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($expensescategory->CancelMessage <> "") {
					$this->setFailureMessage($expensescategory->CancelMessage);
					$expensescategory->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$expensescategory->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {
		global $expensescategory;
		$bValidDetail = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$expensescategory->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $expensescategory->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			if ($sDetailTblVar == "expenseslist") {
				if (!isset($GLOBALS["expenseslist"]))
					$GLOBALS["expenseslist"] = new cexpenseslist;
				if ($GLOBALS["expenseslist"]->DetailEdit) {
					$GLOBALS["expenseslist"]->CurrentMode = "edit";
					$GLOBALS["expenseslist"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["expenseslist"]->setCurrentMasterTable($expensescategory->TableVar);
					$GLOBALS["expenseslist"]->setStartRecordNumber(1);
					$GLOBALS["expenseslist"]->exp_cat->FldIsDetailKey = TRUE;
					$GLOBALS["expenseslist"]->exp_cat->CurrentValue = $expensescategory->exp_cat_id->CurrentValue;
					$GLOBALS["expenseslist"]->exp_cat->setSessionValue($GLOBALS["expenseslist"]->exp_cat->CurrentValue);
				}
			}
		}
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
