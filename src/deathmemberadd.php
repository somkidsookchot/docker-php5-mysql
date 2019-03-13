<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "deathmemberinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$deathmember_add = new cdeathmember_add();
$Page =& $deathmember_add;

// Page init
$deathmember_add->Page_Init();

// Page main
$deathmember_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var deathmember_add = new ew_Page("deathmember_add");

// page properties
deathmember_add.PageID = "add"; // page ID
deathmember_add.FormID = "fdeathmemberadd"; // form ID
var EW_PAGE_ID = deathmember_add.PageID; // for backward compatibility

// extend page with ValidateForm function
deathmember_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($deathmember->member_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_member_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($deathmember->member_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_dead_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($deathmember->dead_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_dead_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($deathmember->dead_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_dead_detail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($deathmember->dead_detail->FldCaption()) ?>");

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
deathmember_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
deathmember_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
deathmember_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
deathmember_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $deathmember->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $deathmember->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $deathmember_add->ShowPageHeader(); ?>
<?php
$deathmember_add->ShowMessage();
?>
<form name="fdeathmemberadd" id="fdeathmemberadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return deathmember_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="deathmember">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($deathmember->member_id->Visible) { // member_id ?>
	<tr id="r_member_id"<?php echo $deathmember->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $deathmember->member_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $deathmember->member_id->CellAttributes() ?>><span id="el_member_id">
<input type="text" name="x_member_id" id="x_member_id" size="30" value="<?php echo $deathmember->member_id->EditValue ?>"<?php echo $deathmember->member_id->EditAttributes() ?>>
</span><?php echo $deathmember->member_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($deathmember->dead_date->Visible) { // dead_date ?>
	<tr id="r_dead_date"<?php echo $deathmember->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $deathmember->dead_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $deathmember->dead_date->CellAttributes() ?>><span id="el_dead_date">
<input type="text" name="x_dead_date" id="x_dead_date" value="<?php echo $deathmember->dead_date->EditValue ?>"<?php echo $deathmember->dead_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_dead_date" name="cal_x_dead_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_dead_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_dead_date" // button id
});
</script>
</span><?php echo $deathmember->dead_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($deathmember->dead_detail->Visible) { // dead_detail ?>
	<tr id="r_dead_detail"<?php echo $deathmember->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $deathmember->dead_detail->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $deathmember->dead_detail->CellAttributes() ?>><span id="el_dead_detail">
<textarea name="x_dead_detail" id="x_dead_detail" cols="35" rows="4"<?php echo $deathmember->dead_detail->EditAttributes() ?>><?php echo $deathmember->dead_detail->EditValue ?></textarea>
</span><?php echo $deathmember->dead_detail->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$deathmember_add->ShowPageFooter();
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
$deathmember_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cdeathmember_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'deathmember';

	// Page object name
	var $PageObjName = 'deathmember_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $deathmember;
		if ($deathmember->UseTokenInUrl) $PageUrl .= "t=" . $deathmember->TableVar . "&"; // Add page token
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
		global $objForm, $deathmember;
		if ($deathmember->UseTokenInUrl) {
			if ($objForm)
				return ($deathmember->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($deathmember->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cdeathmember_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (deathmember)
		if (!isset($GLOBALS["deathmember"])) {
			$GLOBALS["deathmember"] = new cdeathmember();
			$GLOBALS["Table"] =& $GLOBALS["deathmember"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'deathmember', TRUE);

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
		global $deathmember;

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
		global $objForm, $Language, $gsFormError, $deathmember;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$deathmember->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$deathmember->CurrentAction = "I"; // Form error, reset action
				$deathmember->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["death_id"] != "") {
				$deathmember->death_id->setQueryStringValue($_GET["death_id"]);
				$deathmember->setKey("death_id", $deathmember->death_id->CurrentValue); // Set up key
			} else {
				$deathmember->setKey("death_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$deathmember->CurrentAction = "C"; // Copy record
			} else {
				$deathmember->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($deathmember->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("deathmemberlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$deathmember->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $deathmember->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "deathmemberview.php")
						$sReturnUrl = $deathmember->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$deathmember->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$deathmember->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$deathmember->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $deathmember;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load default values
	function LoadDefaultValues() {
		global $deathmember;
		$deathmember->member_id->CurrentValue = NULL;
		$deathmember->member_id->OldValue = $deathmember->member_id->CurrentValue;
		$deathmember->dead_date->CurrentValue = NULL;
		$deathmember->dead_date->OldValue = $deathmember->dead_date->CurrentValue;
		$deathmember->dead_detail->CurrentValue = NULL;
		$deathmember->dead_detail->OldValue = $deathmember->dead_detail->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $deathmember;
		if (!$deathmember->member_id->FldIsDetailKey) {
			$deathmember->member_id->setFormValue($objForm->GetValue("x_member_id"));
		}
		if (!$deathmember->dead_date->FldIsDetailKey) {
			$deathmember->dead_date->setFormValue($objForm->GetValue("x_dead_date"));
			$deathmember->dead_date->CurrentValue = ew_UnFormatDateTime($deathmember->dead_date->CurrentValue, 7);
		}
		if (!$deathmember->dead_detail->FldIsDetailKey) {
			$deathmember->dead_detail->setFormValue($objForm->GetValue("x_dead_detail"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $deathmember;
		$this->LoadOldRecord();
		$deathmember->member_id->CurrentValue = $deathmember->member_id->FormValue;
		$deathmember->dead_date->CurrentValue = $deathmember->dead_date->FormValue;
		$deathmember->dead_date->CurrentValue = ew_UnFormatDateTime($deathmember->dead_date->CurrentValue, 7);
		$deathmember->dead_detail->CurrentValue = $deathmember->dead_detail->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $deathmember;
		$sFilter = $deathmember->KeyFilter();

		// Call Row Selecting event
		$deathmember->Row_Selecting($sFilter);

		// Load SQL based on filter
		$deathmember->CurrentFilter = $sFilter;
		$sSql = $deathmember->SQL();
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
		global $conn, $deathmember;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$deathmember->Row_Selected($row);
		$deathmember->death_id->setDbValue($rs->fields('death_id'));
		$deathmember->member_id->setDbValue($rs->fields('member_id'));
		$deathmember->dead_date->setDbValue($rs->fields('dead_date'));
		$deathmember->dead_detail->setDbValue($rs->fields('dead_detail'));
	}

	// Load old record
	function LoadOldRecord() {
		global $deathmember;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($deathmember->getKey("death_id")) <> "")
			$deathmember->death_id->CurrentValue = $deathmember->getKey("death_id"); // death_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$deathmember->CurrentFilter = $deathmember->KeyFilter();
			$sSql = $deathmember->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $deathmember;

		// Initialize URLs
		// Call Row_Rendering event

		$deathmember->Row_Rendering();

		// Common render codes for all row types
		// death_id
		// member_id
		// dead_date
		// dead_detail

		if ($deathmember->RowType == EW_ROWTYPE_VIEW) { // View row

			// death_id
			$deathmember->death_id->ViewValue = $deathmember->death_id->CurrentValue;
			$deathmember->death_id->ViewCustomAttributes = "";

			// member_id
			$deathmember->member_id->ViewValue = $deathmember->member_id->CurrentValue;
			$deathmember->member_id->ViewCustomAttributes = "";

			// dead_date
			$deathmember->dead_date->ViewValue = $deathmember->dead_date->CurrentValue;
			$deathmember->dead_date->ViewValue = ew_FormatDateTime($deathmember->dead_date->ViewValue, 7);
			$deathmember->dead_date->ViewCustomAttributes = "";

			// dead_detail
			$deathmember->dead_detail->ViewValue = $deathmember->dead_detail->CurrentValue;
			$deathmember->dead_detail->ViewCustomAttributes = "";

			// member_id
			$deathmember->member_id->LinkCustomAttributes = "";
			$deathmember->member_id->HrefValue = "";
			$deathmember->member_id->TooltipValue = "";

			// dead_date
			$deathmember->dead_date->LinkCustomAttributes = "";
			$deathmember->dead_date->HrefValue = "";
			$deathmember->dead_date->TooltipValue = "";

			// dead_detail
			$deathmember->dead_detail->LinkCustomAttributes = "";
			$deathmember->dead_detail->HrefValue = "";
			$deathmember->dead_detail->TooltipValue = "";
		} elseif ($deathmember->RowType == EW_ROWTYPE_ADD) { // Add row

			// member_id
			$deathmember->member_id->EditCustomAttributes = "";
			$deathmember->member_id->EditValue = ew_HtmlEncode($deathmember->member_id->CurrentValue);

			// dead_date
			$deathmember->dead_date->EditCustomAttributes = "";
			$deathmember->dead_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($deathmember->dead_date->CurrentValue, 7));

			// dead_detail
			$deathmember->dead_detail->EditCustomAttributes = "";
			$deathmember->dead_detail->EditValue = ew_HtmlEncode($deathmember->dead_detail->CurrentValue);

			// Edit refer script
			// member_id

			$deathmember->member_id->HrefValue = "";

			// dead_date
			$deathmember->dead_date->HrefValue = "";

			// dead_detail
			$deathmember->dead_detail->HrefValue = "";
		}
		if ($deathmember->RowType == EW_ROWTYPE_ADD ||
			$deathmember->RowType == EW_ROWTYPE_EDIT ||
			$deathmember->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$deathmember->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($deathmember->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$deathmember->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $deathmember;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($deathmember->member_id->FormValue) && $deathmember->member_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $deathmember->member_id->FldCaption());
		}
		if (!ew_CheckInteger($deathmember->member_id->FormValue)) {
			ew_AddMessage($gsFormError, $deathmember->member_id->FldErrMsg());
		}
		if (!is_null($deathmember->dead_date->FormValue) && $deathmember->dead_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $deathmember->dead_date->FldCaption());
		}
		if (!ew_CheckEuroDate($deathmember->dead_date->FormValue)) {
			ew_AddMessage($gsFormError, $deathmember->dead_date->FldErrMsg());
		}
		if (!is_null($deathmember->dead_detail->FormValue) && $deathmember->dead_detail->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $deathmember->dead_detail->FldCaption());
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
		global $conn, $Language, $Security, $deathmember;
		if ($deathmember->member_id->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(member_id = " . ew_AdjustSql($deathmember->member_id->CurrentValue) . ")";
			$rsChk = $deathmember->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $deathmember->member_id->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $deathmember->member_id->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// member_id
		$deathmember->member_id->SetDbValueDef($rsnew, $deathmember->member_id->CurrentValue, 0, FALSE);

		// dead_date
		$deathmember->dead_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($deathmember->dead_date->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// dead_detail
		$deathmember->dead_detail->SetDbValueDef($rsnew, $deathmember->dead_detail->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $deathmember->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($deathmember->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($deathmember->CancelMessage <> "") {
				$this->setFailureMessage($deathmember->CancelMessage);
				$deathmember->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
			$deathmember->death_id->setDbValue($conn->Insert_ID());
			$rsnew['death_id'] = $deathmember->death_id->DbValue;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$deathmember->Row_Inserted($rs, $rsnew);
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
