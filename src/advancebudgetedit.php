<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "advancebudgetinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$advancebudget_edit = new cadvancebudget_edit();
$Page =& $advancebudget_edit;

// Page init
$advancebudget_edit->Page_Init();

// Page main
$advancebudget_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var advancebudget_edit = new ew_Page("advancebudget_edit");

// page properties
advancebudget_edit.PageID = "edit"; // page ID
advancebudget_edit.FormID = "fadvancebudgetedit"; // form ID
var EW_PAGE_ID = advancebudget_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
advancebudget_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_member_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($advancebudget->member_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_member_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($advancebudget->member_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_death_count"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($advancebudget->death_count->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_death_count"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($advancebudget->death_count->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_adv_total"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($advancebudget->adv_total->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_adv_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($advancebudget->adv_total->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_adb_detail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($advancebudget->adb_detail->FldCaption()) ?>");

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
advancebudget_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
advancebudget_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
advancebudget_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
advancebudget_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $advancebudget->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $advancebudget->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $advancebudget_edit->ShowPageHeader(); ?>
<?php
$advancebudget_edit->ShowMessage();
?>
<form name="fadvancebudgetedit" id="fadvancebudgetedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return advancebudget_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="advancebudget">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($advancebudget->adv_id->Visible) { // adv_id ?>
	<tr id="r_adv_id"<?php echo $advancebudget->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $advancebudget->adv_id->FldCaption() ?></td>
		<td<?php echo $advancebudget->adv_id->CellAttributes() ?>><span id="el_adv_id">
<div<?php echo $advancebudget->adv_id->ViewAttributes() ?>><?php echo $advancebudget->adv_id->EditValue ?></div>
<input type="hidden" name="x_adv_id" id="x_adv_id" value="<?php echo ew_HtmlEncode($advancebudget->adv_id->CurrentValue) ?>">
</span><?php echo $advancebudget->adv_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($advancebudget->member_id->Visible) { // member_id ?>
	<tr id="r_member_id"<?php echo $advancebudget->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $advancebudget->member_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $advancebudget->member_id->CellAttributes() ?>><span id="el_member_id">
<input type="text" name="x_member_id" id="x_member_id" size="30" value="<?php echo $advancebudget->member_id->EditValue ?>"<?php echo $advancebudget->member_id->EditAttributes() ?>>
</span><?php echo $advancebudget->member_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($advancebudget->death_count->Visible) { // death_count ?>
	<tr id="r_death_count"<?php echo $advancebudget->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $advancebudget->death_count->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $advancebudget->death_count->CellAttributes() ?>><span id="el_death_count">
<input type="text" name="x_death_count" id="x_death_count" size="30" value="<?php echo $advancebudget->death_count->EditValue ?>"<?php echo $advancebudget->death_count->EditAttributes() ?>>
</span><?php echo $advancebudget->death_count->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($advancebudget->adv_total->Visible) { // adv_total ?>
	<tr id="r_adv_total"<?php echo $advancebudget->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $advancebudget->adv_total->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $advancebudget->adv_total->CellAttributes() ?>><span id="el_adv_total">
<input type="text" name="x_adv_total" id="x_adv_total" size="30" value="<?php echo $advancebudget->adv_total->EditValue ?>"<?php echo $advancebudget->adv_total->EditAttributes() ?>>
</span><?php echo $advancebudget->adv_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($advancebudget->adb_detail->Visible) { // adb_detail ?>
	<tr id="r_adb_detail"<?php echo $advancebudget->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $advancebudget->adb_detail->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $advancebudget->adb_detail->CellAttributes() ?>><span id="el_adb_detail">
<textarea name="x_adb_detail" id="x_adb_detail" cols="35" rows="4"<?php echo $advancebudget->adb_detail->EditAttributes() ?>><?php echo $advancebudget->adb_detail->EditValue ?></textarea>
</span><?php echo $advancebudget->adb_detail->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$advancebudget_edit->ShowPageFooter();
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
$advancebudget_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cadvancebudget_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'advancebudget';

	// Page object name
	var $PageObjName = 'advancebudget_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $advancebudget;
		if ($advancebudget->UseTokenInUrl) $PageUrl .= "t=" . $advancebudget->TableVar . "&"; // Add page token
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
		global $objForm, $advancebudget;
		if ($advancebudget->UseTokenInUrl) {
			if ($objForm)
				return ($advancebudget->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($advancebudget->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cadvancebudget_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (advancebudget)
		if (!isset($GLOBALS["advancebudget"])) {
			$GLOBALS["advancebudget"] = new cadvancebudget();
			$GLOBALS["Table"] =& $GLOBALS["advancebudget"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'advancebudget', TRUE);

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
		global $advancebudget;

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
		global $objForm, $Language, $gsFormError, $advancebudget;

		// Load key from QueryString
		if (@$_GET["adv_id"] <> "")
			$advancebudget->adv_id->setQueryStringValue($_GET["adv_id"]);
		if (@$_POST["a_edit"] <> "") {
			$advancebudget->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$advancebudget->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$advancebudget->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$advancebudget->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($advancebudget->adv_id->CurrentValue == "")
			$this->Page_Terminate("advancebudgetlist.php"); // Invalid key, return to list
		switch ($advancebudget->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("advancebudgetlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$advancebudget->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $advancebudget->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "advancebudgetview.php")
						$sReturnUrl = $advancebudget->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$advancebudget->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$advancebudget->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$advancebudget->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $advancebudget;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $advancebudget;
		if (!$advancebudget->adv_id->FldIsDetailKey)
			$advancebudget->adv_id->setFormValue($objForm->GetValue("x_adv_id"));
		if (!$advancebudget->member_id->FldIsDetailKey) {
			$advancebudget->member_id->setFormValue($objForm->GetValue("x_member_id"));
		}
		if (!$advancebudget->death_count->FldIsDetailKey) {
			$advancebudget->death_count->setFormValue($objForm->GetValue("x_death_count"));
		}
		if (!$advancebudget->adv_total->FldIsDetailKey) {
			$advancebudget->adv_total->setFormValue($objForm->GetValue("x_adv_total"));
		}
		if (!$advancebudget->adb_detail->FldIsDetailKey) {
			$advancebudget->adb_detail->setFormValue($objForm->GetValue("x_adb_detail"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $advancebudget;
		$this->LoadRow();
		$advancebudget->adv_id->CurrentValue = $advancebudget->adv_id->FormValue;
		$advancebudget->member_id->CurrentValue = $advancebudget->member_id->FormValue;
		$advancebudget->death_count->CurrentValue = $advancebudget->death_count->FormValue;
		$advancebudget->adv_total->CurrentValue = $advancebudget->adv_total->FormValue;
		$advancebudget->adb_detail->CurrentValue = $advancebudget->adb_detail->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $advancebudget;
		$sFilter = $advancebudget->KeyFilter();

		// Call Row Selecting event
		$advancebudget->Row_Selecting($sFilter);

		// Load SQL based on filter
		$advancebudget->CurrentFilter = $sFilter;
		$sSql = $advancebudget->SQL();
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
		global $conn, $advancebudget;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$advancebudget->Row_Selected($row);
		$advancebudget->adv_id->setDbValue($rs->fields('adv_id'));
		$advancebudget->member_id->setDbValue($rs->fields('member_id'));
		$advancebudget->death_count->setDbValue($rs->fields('death_count'));
		$advancebudget->adv_total->setDbValue($rs->fields('adv_total'));
		$advancebudget->adb_detail->setDbValue($rs->fields('adb_detail'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $advancebudget;

		// Initialize URLs
		// Call Row_Rendering event

		$advancebudget->Row_Rendering();

		// Common render codes for all row types
		// adv_id
		// member_id
		// death_count
		// adv_total
		// adb_detail

		if ($advancebudget->RowType == EW_ROWTYPE_VIEW) { // View row

			// adv_id
			$advancebudget->adv_id->ViewValue = $advancebudget->adv_id->CurrentValue;
			$advancebudget->adv_id->ViewCustomAttributes = "";

			// member_id
			$advancebudget->member_id->ViewValue = $advancebudget->member_id->CurrentValue;
			$advancebudget->member_id->ViewCustomAttributes = "";

			// death_count
			$advancebudget->death_count->ViewValue = $advancebudget->death_count->CurrentValue;
			$advancebudget->death_count->ViewCustomAttributes = "";

			// adv_total
			$advancebudget->adv_total->ViewValue = $advancebudget->adv_total->CurrentValue;
			$advancebudget->adv_total->ViewCustomAttributes = "";

			// adb_detail
			$advancebudget->adb_detail->ViewValue = $advancebudget->adb_detail->CurrentValue;
			$advancebudget->adb_detail->ViewCustomAttributes = "";

			// adv_id
			$advancebudget->adv_id->LinkCustomAttributes = "";
			$advancebudget->adv_id->HrefValue = "";
			$advancebudget->adv_id->TooltipValue = "";

			// member_id
			$advancebudget->member_id->LinkCustomAttributes = "";
			$advancebudget->member_id->HrefValue = "";
			$advancebudget->member_id->TooltipValue = "";

			// death_count
			$advancebudget->death_count->LinkCustomAttributes = "";
			$advancebudget->death_count->HrefValue = "";
			$advancebudget->death_count->TooltipValue = "";

			// adv_total
			$advancebudget->adv_total->LinkCustomAttributes = "";
			$advancebudget->adv_total->HrefValue = "";
			$advancebudget->adv_total->TooltipValue = "";

			// adb_detail
			$advancebudget->adb_detail->LinkCustomAttributes = "";
			$advancebudget->adb_detail->HrefValue = "";
			$advancebudget->adb_detail->TooltipValue = "";
		} elseif ($advancebudget->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// adv_id
			$advancebudget->adv_id->EditCustomAttributes = "";
			$advancebudget->adv_id->EditValue = $advancebudget->adv_id->CurrentValue;
			$advancebudget->adv_id->ViewCustomAttributes = "";

			// member_id
			$advancebudget->member_id->EditCustomAttributes = "";
			$advancebudget->member_id->EditValue = ew_HtmlEncode($advancebudget->member_id->CurrentValue);

			// death_count
			$advancebudget->death_count->EditCustomAttributes = "";
			$advancebudget->death_count->EditValue = ew_HtmlEncode($advancebudget->death_count->CurrentValue);

			// adv_total
			$advancebudget->adv_total->EditCustomAttributes = "";
			$advancebudget->adv_total->EditValue = ew_HtmlEncode($advancebudget->adv_total->CurrentValue);

			// adb_detail
			$advancebudget->adb_detail->EditCustomAttributes = "";
			$advancebudget->adb_detail->EditValue = ew_HtmlEncode($advancebudget->adb_detail->CurrentValue);

			// Edit refer script
			// adv_id

			$advancebudget->adv_id->HrefValue = "";

			// member_id
			$advancebudget->member_id->HrefValue = "";

			// death_count
			$advancebudget->death_count->HrefValue = "";

			// adv_total
			$advancebudget->adv_total->HrefValue = "";

			// adb_detail
			$advancebudget->adb_detail->HrefValue = "";
		}
		if ($advancebudget->RowType == EW_ROWTYPE_ADD ||
			$advancebudget->RowType == EW_ROWTYPE_EDIT ||
			$advancebudget->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$advancebudget->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($advancebudget->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$advancebudget->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $advancebudget;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($advancebudget->member_id->FormValue) && $advancebudget->member_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $advancebudget->member_id->FldCaption());
		}
		if (!ew_CheckInteger($advancebudget->member_id->FormValue)) {
			ew_AddMessage($gsFormError, $advancebudget->member_id->FldErrMsg());
		}
		if (!is_null($advancebudget->death_count->FormValue) && $advancebudget->death_count->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $advancebudget->death_count->FldCaption());
		}
		if (!ew_CheckInteger($advancebudget->death_count->FormValue)) {
			ew_AddMessage($gsFormError, $advancebudget->death_count->FldErrMsg());
		}
		if (!is_null($advancebudget->adv_total->FormValue) && $advancebudget->adv_total->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $advancebudget->adv_total->FldCaption());
		}
		if (!ew_CheckNumber($advancebudget->adv_total->FormValue)) {
			ew_AddMessage($gsFormError, $advancebudget->adv_total->FldErrMsg());
		}
		if (!is_null($advancebudget->adb_detail->FormValue) && $advancebudget->adb_detail->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $advancebudget->adb_detail->FldCaption());
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
		global $conn, $Security, $Language, $advancebudget;
		$sFilter = $advancebudget->KeyFilter();
		$advancebudget->CurrentFilter = $sFilter;
		$sSql = $advancebudget->SQL();
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

			// member_id
			$advancebudget->member_id->SetDbValueDef($rsnew, $advancebudget->member_id->CurrentValue, 0, $advancebudget->member_id->ReadOnly);

			// death_count
			$advancebudget->death_count->SetDbValueDef($rsnew, $advancebudget->death_count->CurrentValue, 0, $advancebudget->death_count->ReadOnly);

			// adv_total
			$advancebudget->adv_total->SetDbValueDef($rsnew, $advancebudget->adv_total->CurrentValue, 0, $advancebudget->adv_total->ReadOnly);

			// adb_detail
			$advancebudget->adb_detail->SetDbValueDef($rsnew, $advancebudget->adb_detail->CurrentValue, "", $advancebudget->adb_detail->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $advancebudget->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($advancebudget->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($advancebudget->CancelMessage <> "") {
					$this->setFailureMessage($advancebudget->CancelMessage);
					$advancebudget->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$advancebudget->Row_Updated($rsold, $rsnew);
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
