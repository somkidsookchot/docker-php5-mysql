<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "permissioninfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$permission_add = new cpermission_add();
$Page =& $permission_add;

// Page init
$permission_add->Page_Init();

// Page main
$permission_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var permission_add = new ew_Page("permission_add");

// page properties
permission_add.PageID = "add"; // page ID
permission_add.FormID = "fpermissionadd"; // form ID
var EW_PAGE_ID = permission_add.PageID; // for backward compatibility

// extend page with ValidateForm function
permission_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($permission->member_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_member_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($permission->member_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_admin"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($permission->admin->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_admin"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($permission->admin->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_zupload"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($permission->zupload->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_download"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($permission->download->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_readonly"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($permission->readonly->FldErrMsg()) ?>");

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
permission_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
permission_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
permission_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
permission_add.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $permission->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $permission->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $permission_add->ShowPageHeader(); ?>
<?php
$permission_add->ShowMessage();
?>
<form name="fpermissionadd" id="fpermissionadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return permission_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="permission">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($permission->member_id->Visible) { // member_id ?>
	<tr id="r_member_id"<?php echo $permission->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $permission->member_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $permission->member_id->CellAttributes() ?>><span id="el_member_id">
<input type="text" name="x_member_id" id="x_member_id" size="30" value="<?php echo $permission->member_id->EditValue ?>"<?php echo $permission->member_id->EditAttributes() ?>>
</span><?php echo $permission->member_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($permission->admin->Visible) { // admin ?>
	<tr id="r_admin"<?php echo $permission->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $permission->admin->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $permission->admin->CellAttributes() ?>><span id="el_admin">
<input type="text" name="x_admin" id="x_admin" size="30" value="<?php echo $permission->admin->EditValue ?>"<?php echo $permission->admin->EditAttributes() ?>>
</span><?php echo $permission->admin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($permission->zupload->Visible) { // upload ?>
	<tr id="r_zupload"<?php echo $permission->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $permission->zupload->FldCaption() ?></td>
		<td<?php echo $permission->zupload->CellAttributes() ?>><span id="el_zupload">
<input type="text" name="x_zupload" id="x_zupload" size="30" value="<?php echo $permission->zupload->EditValue ?>"<?php echo $permission->zupload->EditAttributes() ?>>
</span><?php echo $permission->zupload->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($permission->download->Visible) { // download ?>
	<tr id="r_download"<?php echo $permission->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $permission->download->FldCaption() ?></td>
		<td<?php echo $permission->download->CellAttributes() ?>><span id="el_download">
<input type="text" name="x_download" id="x_download" size="30" value="<?php echo $permission->download->EditValue ?>"<?php echo $permission->download->EditAttributes() ?>>
</span><?php echo $permission->download->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($permission->readonly->Visible) { // readonly ?>
	<tr id="r_readonly"<?php echo $permission->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $permission->readonly->FldCaption() ?></td>
		<td<?php echo $permission->readonly->CellAttributes() ?>><span id="el_readonly">
<input type="text" name="x_readonly" id="x_readonly" size="30" value="<?php echo $permission->readonly->EditValue ?>"<?php echo $permission->readonly->EditAttributes() ?>>
</span><?php echo $permission->readonly->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$permission_add->ShowPageFooter();
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
$permission_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cpermission_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'permission';

	// Page object name
	var $PageObjName = 'permission_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $permission;
		if ($permission->UseTokenInUrl) $PageUrl .= "t=" . $permission->TableVar . "&"; // Add page token
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
		global $objForm, $permission;
		if ($permission->UseTokenInUrl) {
			if ($objForm)
				return ($permission->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($permission->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpermission_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (permission)
		if (!isset($GLOBALS["permission"])) {
			$GLOBALS["permission"] = new cpermission();
			$GLOBALS["Table"] =& $GLOBALS["permission"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'permission', TRUE);

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
		global $permission;

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
		global $objForm, $Language, $gsFormError, $permission;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$permission->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$permission->CurrentAction = "I"; // Form error, reset action
				$permission->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["permission_id"] != "") {
				$permission->permission_id->setQueryStringValue($_GET["permission_id"]);
				$permission->setKey("permission_id", $permission->permission_id->CurrentValue); // Set up key
			} else {
				$permission->setKey("permission_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (@$_GET["member_id"] != "") {
				$permission->member_id->setQueryStringValue($_GET["member_id"]);
				$permission->setKey("member_id", $permission->member_id->CurrentValue); // Set up key
			} else {
				$permission->setKey("member_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$permission->CurrentAction = "C"; // Copy record
			} else {
				$permission->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($permission->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("permissionlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$permission->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $permission->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "permissionview.php")
						$sReturnUrl = $permission->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$permission->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$permission->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$permission->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $permission;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $permission;
		$permission->member_id->CurrentValue = NULL;
		$permission->member_id->OldValue = $permission->member_id->CurrentValue;
		$permission->admin->CurrentValue = 0;
		$permission->zupload->CurrentValue = 0;
		$permission->download->CurrentValue = 0;
		$permission->readonly->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $permission;
		if (!$permission->member_id->FldIsDetailKey) {
			$permission->member_id->setFormValue($objForm->GetValue("x_member_id"));
		}
		if (!$permission->admin->FldIsDetailKey) {
			$permission->admin->setFormValue($objForm->GetValue("x_admin"));
		}
		if (!$permission->zupload->FldIsDetailKey) {
			$permission->zupload->setFormValue($objForm->GetValue("x_zupload"));
		}
		if (!$permission->download->FldIsDetailKey) {
			$permission->download->setFormValue($objForm->GetValue("x_download"));
		}
		if (!$permission->readonly->FldIsDetailKey) {
			$permission->readonly->setFormValue($objForm->GetValue("x_readonly"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $permission;
		$this->LoadOldRecord();
		$permission->member_id->CurrentValue = $permission->member_id->FormValue;
		$permission->admin->CurrentValue = $permission->admin->FormValue;
		$permission->zupload->CurrentValue = $permission->zupload->FormValue;
		$permission->download->CurrentValue = $permission->download->FormValue;
		$permission->readonly->CurrentValue = $permission->readonly->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $permission;
		$sFilter = $permission->KeyFilter();

		// Call Row Selecting event
		$permission->Row_Selecting($sFilter);

		// Load SQL based on filter
		$permission->CurrentFilter = $sFilter;
		$sSql = $permission->SQL();
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
		global $conn, $permission;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$permission->Row_Selected($row);
		$permission->permission_id->setDbValue($rs->fields('permission_id'));
		$permission->member_id->setDbValue($rs->fields('member_id'));
		$permission->admin->setDbValue($rs->fields('admin'));
		$permission->zupload->setDbValue($rs->fields('upload'));
		$permission->download->setDbValue($rs->fields('download'));
		$permission->readonly->setDbValue($rs->fields('readonly'));
	}

	// Load old record
	function LoadOldRecord() {
		global $permission;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($permission->getKey("permission_id")) <> "")
			$permission->permission_id->CurrentValue = $permission->getKey("permission_id"); // permission_id
		else
			$bValidKey = FALSE;
		if (strval($permission->getKey("member_id")) <> "")
			$permission->member_id->CurrentValue = $permission->getKey("member_id"); // member_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$permission->CurrentFilter = $permission->KeyFilter();
			$sSql = $permission->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $permission;

		// Initialize URLs
		// Call Row_Rendering event

		$permission->Row_Rendering();

		// Common render codes for all row types
		// permission_id
		// member_id
		// admin
		// upload
		// download
		// readonly

		if ($permission->RowType == EW_ROWTYPE_VIEW) { // View row

			// permission_id
			$permission->permission_id->ViewValue = $permission->permission_id->CurrentValue;
			$permission->permission_id->ViewCustomAttributes = "";

			// member_id
			$permission->member_id->ViewValue = $permission->member_id->CurrentValue;
			$permission->member_id->ViewCustomAttributes = "";

			// admin
			$permission->admin->ViewValue = $permission->admin->CurrentValue;
			$permission->admin->ViewCustomAttributes = "";

			// upload
			$permission->zupload->ViewValue = $permission->zupload->CurrentValue;
			$permission->zupload->ViewCustomAttributes = "";

			// download
			$permission->download->ViewValue = $permission->download->CurrentValue;
			$permission->download->ViewCustomAttributes = "";

			// readonly
			$permission->readonly->ViewValue = $permission->readonly->CurrentValue;
			$permission->readonly->ViewCustomAttributes = "";

			// member_id
			$permission->member_id->LinkCustomAttributes = "";
			$permission->member_id->HrefValue = "";
			$permission->member_id->TooltipValue = "";

			// admin
			$permission->admin->LinkCustomAttributes = "";
			$permission->admin->HrefValue = "";
			$permission->admin->TooltipValue = "";

			// upload
			$permission->zupload->LinkCustomAttributes = "";
			$permission->zupload->HrefValue = "";
			$permission->zupload->TooltipValue = "";

			// download
			$permission->download->LinkCustomAttributes = "";
			$permission->download->HrefValue = "";
			$permission->download->TooltipValue = "";

			// readonly
			$permission->readonly->LinkCustomAttributes = "";
			$permission->readonly->HrefValue = "";
			$permission->readonly->TooltipValue = "";
		} elseif ($permission->RowType == EW_ROWTYPE_ADD) { // Add row

			// member_id
			$permission->member_id->EditCustomAttributes = "";
			$permission->member_id->EditValue = ew_HtmlEncode($permission->member_id->CurrentValue);

			// admin
			$permission->admin->EditCustomAttributes = "";
			$permission->admin->EditValue = ew_HtmlEncode($permission->admin->CurrentValue);

			// upload
			$permission->zupload->EditCustomAttributes = "";
			$permission->zupload->EditValue = ew_HtmlEncode($permission->zupload->CurrentValue);

			// download
			$permission->download->EditCustomAttributes = "";
			$permission->download->EditValue = ew_HtmlEncode($permission->download->CurrentValue);

			// readonly
			$permission->readonly->EditCustomAttributes = "";
			$permission->readonly->EditValue = ew_HtmlEncode($permission->readonly->CurrentValue);

			// Edit refer script
			// member_id

			$permission->member_id->HrefValue = "";

			// admin
			$permission->admin->HrefValue = "";

			// upload
			$permission->zupload->HrefValue = "";

			// download
			$permission->download->HrefValue = "";

			// readonly
			$permission->readonly->HrefValue = "";
		}
		if ($permission->RowType == EW_ROWTYPE_ADD ||
			$permission->RowType == EW_ROWTYPE_EDIT ||
			$permission->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$permission->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($permission->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$permission->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $permission;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($permission->member_id->FormValue) && $permission->member_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $permission->member_id->FldCaption());
		}
		if (!ew_CheckInteger($permission->member_id->FormValue)) {
			ew_AddMessage($gsFormError, $permission->member_id->FldErrMsg());
		}
		if (!is_null($permission->admin->FormValue) && $permission->admin->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $permission->admin->FldCaption());
		}
		if (!ew_CheckInteger($permission->admin->FormValue)) {
			ew_AddMessage($gsFormError, $permission->admin->FldErrMsg());
		}
		if (!ew_CheckInteger($permission->zupload->FormValue)) {
			ew_AddMessage($gsFormError, $permission->zupload->FldErrMsg());
		}
		if (!ew_CheckInteger($permission->download->FormValue)) {
			ew_AddMessage($gsFormError, $permission->download->FldErrMsg());
		}
		if (!ew_CheckInteger($permission->readonly->FormValue)) {
			ew_AddMessage($gsFormError, $permission->readonly->FldErrMsg());
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
		global $conn, $Language, $Security, $permission;

		// Check if key value entered
		if ($permission->member_id->CurrentValue == "" && $permission->member_id->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}
		$rsnew = array();

		// member_id
		$permission->member_id->SetDbValueDef($rsnew, $permission->member_id->CurrentValue, 0, FALSE);

		// admin
		$permission->admin->SetDbValueDef($rsnew, $permission->admin->CurrentValue, NULL, strval($permission->admin->CurrentValue) == "");

		// upload
		$permission->zupload->SetDbValueDef($rsnew, $permission->zupload->CurrentValue, NULL, strval($permission->zupload->CurrentValue) == "");

		// download
		$permission->download->SetDbValueDef($rsnew, $permission->download->CurrentValue, NULL, strval($permission->download->CurrentValue) == "");

		// readonly
		$permission->readonly->SetDbValueDef($rsnew, $permission->readonly->CurrentValue, NULL, strval($permission->readonly->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $permission->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($permission->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($permission->CancelMessage <> "") {
				$this->setFailureMessage($permission->CancelMessage);
				$permission->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$permission->permission_id->setDbValue($conn->Insert_ID());
			$rsnew['permission_id'] = $permission->permission_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$permission->Row_Inserted($rs, $rsnew);
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
