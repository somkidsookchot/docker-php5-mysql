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
$expensescategory_add = new cexpensescategory_add();
$Page =& $expensescategory_add;

// Page init
$expensescategory_add->Page_Init();

// Page main
$expensescategory_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expensescategory_add = new ew_Page("expensescategory_add");

// page properties
expensescategory_add.PageID = "add"; // page ID
expensescategory_add.FormID = "fexpensescategoryadd"; // form ID
var EW_PAGE_ID = expensescategory_add.PageID; // for backward compatibility

// extend page with ValidateForm function
expensescategory_add.ValidateForm = function(fobj) {
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
expensescategory_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expensescategory_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expensescategory_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expensescategory_add.ValidateRequired = false; // no JavaScript validation
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
<div class="phpmaker ewTitle"><img src="images/ico_payall.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expensescategory->TableCaption() ?></div>
<div class="clear"></div>
<?php $expensescategory_add->ShowPageHeader(); ?>
<?php
$expensescategory_add->ShowMessage();
?>
<form name="fexpensescategoryadd" id="fexpensescategoryadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return expensescategory_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="expensescategory">
<input type="hidden" name="a_add" id="a_add" value="A">
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
<p>
<?php if ($expensescategory->getCurrentDetailTable() == "expenseslist" && $expenseslist->DetailAdd) { ?>
<br>
<?php include_once "expenseslistgrid.php" ?>
<br>
<?php } ?>
<a href="<?php echo $expensescategory->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a>&nbsp;<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$expensescategory_add->ShowPageFooter();
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
$expensescategory_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpensescategory_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'expensescategory';

	// Page object name
	var $PageObjName = 'expensescategory_add';

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
	function cexpensescategory_add() {
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
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $expensescategory;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$expensescategory->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Set up detail parameters
			$this->SetUpDetailParms();

			// Validate form
			if (!$this->ValidateForm()) {
				$expensescategory->CurrentAction = "I"; // Form error, reset action
				$expensescategory->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["exp_cat_id"] != "") {
				$expensescategory->exp_cat_id->setQueryStringValue($_GET["exp_cat_id"]);
				$expensescategory->setKey("exp_cat_id", $expensescategory->exp_cat_id->CurrentValue); // Set up key
			} else {
				$expensescategory->setKey("exp_cat_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$expensescategory->CurrentAction = "C"; // Copy record
			} else {
				$expensescategory->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Set up detail parameters
		$this->SetUpDetailParms();

		// Perform action based on action code
		switch ($expensescategory->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("expensescategorylist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$expensescategory->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($expensescategory->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $expensescategory->getDetailUrl();
					else
						$sReturnUrl = $expensescategory->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "expensescategoryview.php")
						$sReturnUrl = $expensescategory->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$expensescategory->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$expensescategory->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
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

	// Load default values
	function LoadDefaultValues() {
		global $expensescategory;
		$expensescategory->exp_cat_title->CurrentValue = NULL;
		$expensescategory->exp_cat_title->OldValue = $expensescategory->exp_cat_title->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $expensescategory;
		if (!$expensescategory->exp_cat_title->FldIsDetailKey) {
			$expensescategory->exp_cat_title->setFormValue($objForm->GetValue("x_exp_cat_title"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $expensescategory;
		$this->LoadOldRecord();
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

	// Load old record
	function LoadOldRecord() {
		global $expensescategory;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($expensescategory->getKey("exp_cat_id")) <> "")
			$expensescategory->exp_cat_id->CurrentValue = $expensescategory->getKey("exp_cat_id"); // exp_cat_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$expensescategory->CurrentFilter = $expensescategory->KeyFilter();
			$sSql = $expensescategory->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
		} elseif ($expensescategory->RowType == EW_ROWTYPE_ADD) { // Add row

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
		if ($expensescategory->getCurrentDetailTable() == "expenseslist" && $GLOBALS["expenseslist"]->DetailAdd) {
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

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $expensescategory;
		if ($expensescategory->exp_cat_title->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(exp_cat_title = '" . ew_AdjustSql($expensescategory->exp_cat_title->CurrentValue) . "')";
			$rsChk = $expensescategory->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $expensescategory->exp_cat_title->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $expensescategory->exp_cat_title->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}

		// Begin transaction
		if ($expensescategory->getCurrentDetailTable() <> "")
			$conn->BeginTrans();
		$rsnew = array();

		// exp_cat_title
		$expensescategory->exp_cat_title->SetDbValueDef($rsnew, $expensescategory->exp_cat_title->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $expensescategory->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($expensescategory->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($expensescategory->CancelMessage <> "") {
				$this->setFailureMessage($expensescategory->CancelMessage);
				$expensescategory->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$expensescategory->exp_cat_id->setDbValue($conn->Insert_ID());
			$rsnew['exp_cat_id'] = $expensescategory->exp_cat_id->DbValue;
		}

		// Add detail records
		if ($AddRow) {
			if ($expensescategory->getCurrentDetailTable() == "expenseslist" && $GLOBALS["expenseslist"]->DetailAdd) {
				$GLOBALS["expenseslist"]->exp_cat->setSessionValue($expensescategory->exp_cat_id->CurrentValue); // Set master key
				$expenseslist_grid = new cexpenseslist_grid(); // get detail page object
				$AddRow = $expenseslist_grid->GridInsert();
				$expenseslist_grid = NULL;
			}
		}

		// Commit/Rollback transaction
		if ($expensescategory->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$expensescategory->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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
				if ($GLOBALS["expenseslist"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["expenseslist"]->CurrentMode = "copy";
					else
						$GLOBALS["expenseslist"]->CurrentMode = "add";
					$GLOBALS["expenseslist"]->CurrentAction = "gridadd";

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
