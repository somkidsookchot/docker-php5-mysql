<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "expenseslistinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "expensescategoryinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$expenseslist_edit = new cexpenseslist_edit();
$Page =& $expenseslist_edit;

// Page init
$expenseslist_edit->Page_Init();

// Page main
$expenseslist_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var expenseslist_edit = new ew_Page("expenseslist_edit");

// page properties
expenseslist_edit.PageID = "edit"; // page ID
expenseslist_edit.FormID = "fexpenseslistedit"; // form ID
var EW_PAGE_ID = expenseslist_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
expenseslist_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_exp_cat"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenseslist->exp_cat->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_exp_detail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenseslist->exp_detail->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_exp_total"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenseslist->exp_total->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_exp_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenseslist->exp_total->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_exp_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenseslist->exp_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_exp_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenseslist->exp_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_exp_dispencer"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenseslist->exp_dispencer->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_exp_slipt_num"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($expenseslist->exp_slipt_num->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_exp_slipt_num"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($expenseslist->exp_slipt_num->FldErrMsg()) ?>");

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
expenseslist_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
expenseslist_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
expenseslist_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
expenseslist_edit.ValidateRequired = false; // no JavaScript validation
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
<div class="phpmaker ewTitle"><img src="images/finance55x55.png" width="40" height="40" align="absmiddle" />&nbsp;<?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $expenseslist->TableCaption() ?></div>
<div class="clear"></div>

<?php $expenseslist_edit->ShowPageHeader(); ?>
<?php
$expenseslist_edit->ShowMessage();
?>
<form name="fexpenseslistedit" id="fexpenseslistedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return expenseslist_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="expenseslist">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($expenseslist->exp_cat->Visible) { // exp_cat ?>
	<tr id="r_exp_cat"<?php echo $expenseslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expenseslist->exp_cat->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expenseslist->exp_cat->CellAttributes() ?>><span id="el_exp_cat">
<?php if ($expenseslist->exp_cat->getSessionValue() <> "") { ?>
<div<?php echo $expenseslist->exp_cat->ViewAttributes() ?>><?php echo $expenseslist->exp_cat->ViewValue ?></div>
<input type="hidden" id="x_exp_cat" name="x_exp_cat" value="<?php echo ew_HtmlEncode($expenseslist->exp_cat->CurrentValue) ?>">
<?php } else { ?>
<select id="x_exp_cat" name="x_exp_cat"<?php echo $expenseslist->exp_cat->EditAttributes() ?>>
<?php
if (is_array($expenseslist->exp_cat->EditValue)) {
	$arwrk = $expenseslist->exp_cat->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($expenseslist->exp_cat->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span><?php echo $expenseslist->exp_cat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenseslist->exp_detail->Visible) { // exp_detail ?>
	<tr id="r_exp_detail"<?php echo $expenseslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expenseslist->exp_detail->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expenseslist->exp_detail->CellAttributes() ?>><span id="el_exp_detail">
<textarea name="x_exp_detail" id="x_exp_detail" cols="35" rows="4"<?php echo $expenseslist->exp_detail->EditAttributes() ?>><?php echo $expenseslist->exp_detail->EditValue ?></textarea>
</span><?php echo $expenseslist->exp_detail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenseslist->exp_total->Visible) { // exp_total ?>
	<tr id="r_exp_total"<?php echo $expenseslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expenseslist->exp_total->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expenseslist->exp_total->CellAttributes() ?>><span id="el_exp_total">
<input type="text" name="x_exp_total" id="x_exp_total" size="30" value="<?php echo $expenseslist->exp_total->EditValue ?>"<?php echo $expenseslist->exp_total->EditAttributes() ?>>
</span><?php echo $expenseslist->exp_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenseslist->exp_date->Visible) { // exp_date ?>
	<tr id="r_exp_date"<?php echo $expenseslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expenseslist->exp_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expenseslist->exp_date->CellAttributes() ?>><span id="el_exp_date">
<input type="text" name="x_exp_date" id="x_exp_date" value="<?php echo $expenseslist->exp_date->EditValue ?>"<?php echo $expenseslist->exp_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_exp_date" name="cal_x_exp_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_exp_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_exp_date" // button id
});
</script>
</span><?php echo $expenseslist->exp_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenseslist->exp_dispencer->Visible) { // exp_dispencer ?>
	<tr id="r_exp_dispencer"<?php echo $expenseslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expenseslist->exp_dispencer->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expenseslist->exp_dispencer->CellAttributes() ?>><span id="el_exp_dispencer">
<input type="text" name="x_exp_dispencer" id="x_exp_dispencer" size="30" maxlength="100" value="<?php echo $expenseslist->exp_dispencer->EditValue ?>"<?php echo $expenseslist->exp_dispencer->EditAttributes() ?>>
</span><?php echo $expenseslist->exp_dispencer->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($expenseslist->exp_slipt_num->Visible) { // exp_slipt_num ?>
	<tr id="r_exp_slipt_num"<?php echo $expenseslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $expenseslist->exp_slipt_num->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $expenseslist->exp_slipt_num->CellAttributes() ?>><span id="el_exp_slipt_num">
<input type="text" name="x_exp_slipt_num" id="x_exp_slipt_num" size="30" maxlength="50" value="<?php echo $expenseslist->exp_slipt_num->EditValue ?>"<?php echo $expenseslist->exp_slipt_num->EditAttributes() ?>>
</span><?php echo $expenseslist->exp_slipt_num->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_exp_id" id="x_exp_id" value="<?php echo ew_HtmlEncode($expenseslist->exp_id->CurrentValue) ?>">
<p>
<a href="<?php echo $expenseslist->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$expenseslist_edit->ShowPageFooter();
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
$expenseslist_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cexpenseslist_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'expenseslist';

	// Page object name
	var $PageObjName = 'expenseslist_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $expenseslist;
		if ($expenseslist->UseTokenInUrl) $PageUrl .= "t=" . $expenseslist->TableVar . "&"; // Add page token
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
		global $objForm, $expenseslist;
		if ($expenseslist->UseTokenInUrl) {
			if ($objForm)
				return ($expenseslist->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($expenseslist->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cexpenseslist_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (expenseslist)
		if (!isset($GLOBALS["expenseslist"])) {
			$GLOBALS["expenseslist"] = new cexpenseslist();
			$GLOBALS["Table"] =& $GLOBALS["expenseslist"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Table object (expensescategory)
		if (!isset($GLOBALS['expensescategory'])) $GLOBALS['expensescategory'] = new cexpensescategory();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'expenseslist', TRUE);

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
		global $expenseslist;

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
		global $objForm, $Language, $gsFormError, $expenseslist;

		// Load key from QueryString
		if (@$_GET["exp_id"] <> "")
			$expenseslist->exp_id->setQueryStringValue($_GET["exp_id"]);

		// Set up master detail parameters
		$this->SetUpMasterParms();
		if (@$_POST["a_edit"] <> "") {
			$expenseslist->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$expenseslist->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$expenseslist->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$expenseslist->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($expenseslist->exp_id->CurrentValue == "")
			$this->Page_Terminate("expenseslistlist.php"); // Invalid key, return to list
		switch ($expenseslist->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("expenseslistlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$expenseslist->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $expenseslist->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "expenseslistview.php")
						$sReturnUrl = $expenseslist->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$expenseslist->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$expenseslist->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$expenseslist->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $expenseslist;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $expenseslist;
		if (!$expenseslist->exp_cat->FldIsDetailKey) {
			$expenseslist->exp_cat->setFormValue($objForm->GetValue("x_exp_cat"));
		}
		if (!$expenseslist->exp_detail->FldIsDetailKey) {
			$expenseslist->exp_detail->setFormValue($objForm->GetValue("x_exp_detail"));
		}
		if (!$expenseslist->exp_total->FldIsDetailKey) {
			$expenseslist->exp_total->setFormValue($objForm->GetValue("x_exp_total"));
		}
		if (!$expenseslist->exp_date->FldIsDetailKey) {
			$expenseslist->exp_date->setFormValue($objForm->GetValue("x_exp_date"));
			$expenseslist->exp_date->CurrentValue = ew_UnFormatDateTime($expenseslist->exp_date->CurrentValue, 7);
		}
		if (!$expenseslist->exp_dispencer->FldIsDetailKey) {
			$expenseslist->exp_dispencer->setFormValue($objForm->GetValue("x_exp_dispencer"));
		}
		if (!$expenseslist->exp_slipt_num->FldIsDetailKey) {
			$expenseslist->exp_slipt_num->setFormValue($objForm->GetValue("x_exp_slipt_num"));
		}
		if (!$expenseslist->exp_id->FldIsDetailKey)
			$expenseslist->exp_id->setFormValue($objForm->GetValue("x_exp_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $expenseslist;
		$this->LoadRow();
		$expenseslist->exp_id->CurrentValue = $expenseslist->exp_id->FormValue;
		$expenseslist->exp_cat->CurrentValue = $expenseslist->exp_cat->FormValue;
		$expenseslist->exp_detail->CurrentValue = $expenseslist->exp_detail->FormValue;
		$expenseslist->exp_total->CurrentValue = $expenseslist->exp_total->FormValue;
		$expenseslist->exp_date->CurrentValue = $expenseslist->exp_date->FormValue;
		$expenseslist->exp_date->CurrentValue = ew_UnFormatDateTime($expenseslist->exp_date->CurrentValue, 7);
		$expenseslist->exp_dispencer->CurrentValue = $expenseslist->exp_dispencer->FormValue;
		$expenseslist->exp_slipt_num->CurrentValue = $expenseslist->exp_slipt_num->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $expenseslist;
		$sFilter = $expenseslist->KeyFilter();

		// Call Row Selecting event
		$expenseslist->Row_Selecting($sFilter);

		// Load SQL based on filter
		$expenseslist->CurrentFilter = $sFilter;
		$sSql = $expenseslist->SQL();
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
		global $conn, $expenseslist;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$expenseslist->Row_Selected($row);
		$expenseslist->exp_id->setDbValue($rs->fields('exp_id'));
		$expenseslist->exp_cat->setDbValue($rs->fields('exp_cat'));
		$expenseslist->exp_detail->setDbValue($rs->fields('exp_detail'));
		$expenseslist->exp_total->setDbValue($rs->fields('exp_total'));
		$expenseslist->exp_date->setDbValue($rs->fields('exp_date'));
		$expenseslist->exp_dispencer->setDbValue($rs->fields('exp_dispencer'));
		$expenseslist->exp_slipt_num->setDbValue($rs->fields('exp_slipt_num'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $expenseslist;

		// Initialize URLs
		// Call Row_Rendering event

		$expenseslist->Row_Rendering();

		// Common render codes for all row types
		// exp_id
		// exp_cat
		// exp_detail
		// exp_total
		// exp_date
		// exp_dispencer
		// exp_slipt_num

		if ($expenseslist->RowType == EW_ROWTYPE_VIEW) { // View row

			// exp_cat
			if (strval($expenseslist->exp_cat->CurrentValue) <> "") {
				$sFilterWrk = "`exp_cat_id` = " . ew_AdjustSql($expenseslist->exp_cat->CurrentValue) . "";
			$sSqlWrk = "SELECT `exp_cat_title` FROM `expensescategory`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `exp_cat_title`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenseslist->exp_cat->ViewValue = $rswrk->fields('exp_cat_title');
					$rswrk->Close();
				} else {
					$expenseslist->exp_cat->ViewValue = $expenseslist->exp_cat->CurrentValue;
				}
			} else {
				$expenseslist->exp_cat->ViewValue = NULL;
			}
			$expenseslist->exp_cat->ViewCustomAttributes = "";

			// exp_detail
			$expenseslist->exp_detail->ViewValue = $expenseslist->exp_detail->CurrentValue;
			$expenseslist->exp_detail->ViewCustomAttributes = "";

			// exp_total
			$expenseslist->exp_total->ViewValue = $expenseslist->exp_total->CurrentValue;
			$expenseslist->exp_total->ViewCustomAttributes = "";

			// exp_date
			$expenseslist->exp_date->ViewValue = $expenseslist->exp_date->CurrentValue;
			$expenseslist->exp_date->ViewValue = ew_FormatDateTime($expenseslist->exp_date->ViewValue, 7);
			$expenseslist->exp_date->ViewCustomAttributes = "";

			// exp_dispencer
			$expenseslist->exp_dispencer->ViewValue = $expenseslist->exp_dispencer->CurrentValue;
			$expenseslist->exp_dispencer->ViewCustomAttributes = "";

			// exp_slipt_num
			$expenseslist->exp_slipt_num->ViewValue = $expenseslist->exp_slipt_num->CurrentValue;
			$expenseslist->exp_slipt_num->ViewCustomAttributes = "";

			// exp_cat
			$expenseslist->exp_cat->LinkCustomAttributes = "";
			$expenseslist->exp_cat->HrefValue = "";
			$expenseslist->exp_cat->TooltipValue = "";

			// exp_detail
			$expenseslist->exp_detail->LinkCustomAttributes = "";
			$expenseslist->exp_detail->HrefValue = "";
			$expenseslist->exp_detail->TooltipValue = "";

			// exp_total
			$expenseslist->exp_total->LinkCustomAttributes = "";
			$expenseslist->exp_total->HrefValue = "";
			$expenseslist->exp_total->TooltipValue = "";

			// exp_date
			$expenseslist->exp_date->LinkCustomAttributes = "";
			$expenseslist->exp_date->HrefValue = "";
			$expenseslist->exp_date->TooltipValue = "";

			// exp_dispencer
			$expenseslist->exp_dispencer->LinkCustomAttributes = "";
			$expenseslist->exp_dispencer->HrefValue = "";
			$expenseslist->exp_dispencer->TooltipValue = "";

			// exp_slipt_num
			$expenseslist->exp_slipt_num->LinkCustomAttributes = "";
			$expenseslist->exp_slipt_num->HrefValue = "";
			$expenseslist->exp_slipt_num->TooltipValue = "";
		} elseif ($expenseslist->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// exp_cat
			$expenseslist->exp_cat->EditCustomAttributes = "";
			if ($expenseslist->exp_cat->getSessionValue() <> "") {
				$expenseslist->exp_cat->CurrentValue = $expenseslist->exp_cat->getSessionValue();
			if (strval($expenseslist->exp_cat->CurrentValue) <> "") {
				$sFilterWrk = "`exp_cat_id` = " . ew_AdjustSql($expenseslist->exp_cat->CurrentValue) . "";
			$sSqlWrk = "SELECT `exp_cat_title` FROM `expensescategory`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `exp_cat_title`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$expenseslist->exp_cat->ViewValue = $rswrk->fields('exp_cat_title');
					$rswrk->Close();
				} else {
					$expenseslist->exp_cat->ViewValue = $expenseslist->exp_cat->CurrentValue;
				}
			} else {
				$expenseslist->exp_cat->ViewValue = NULL;
			}
			$expenseslist->exp_cat->ViewCustomAttributes = "";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `exp_cat_id`, `exp_cat_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `expensescategory`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `exp_cat_title`";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$expenseslist->exp_cat->EditValue = $arwrk;
			}

			// exp_detail
			$expenseslist->exp_detail->EditCustomAttributes = "";
			$expenseslist->exp_detail->EditValue = ew_HtmlEncode($expenseslist->exp_detail->CurrentValue);

			// exp_total
			$expenseslist->exp_total->EditCustomAttributes = "";
			$expenseslist->exp_total->EditValue = ew_HtmlEncode($expenseslist->exp_total->CurrentValue);

			// exp_date
			$expenseslist->exp_date->EditCustomAttributes = "";
			$expenseslist->exp_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($expenseslist->exp_date->CurrentValue, 7));

			// exp_dispencer
			$expenseslist->exp_dispencer->EditCustomAttributes = "";
			$expenseslist->exp_dispencer->EditValue = ew_HtmlEncode($expenseslist->exp_dispencer->CurrentValue);

			// exp_slipt_num
			$expenseslist->exp_slipt_num->EditCustomAttributes = "";
			$expenseslist->exp_slipt_num->EditValue = ew_HtmlEncode($expenseslist->exp_slipt_num->CurrentValue);

			// Edit refer script
			// exp_cat

			$expenseslist->exp_cat->HrefValue = "";

			// exp_detail
			$expenseslist->exp_detail->HrefValue = "";

			// exp_total
			$expenseslist->exp_total->HrefValue = "";

			// exp_date
			$expenseslist->exp_date->HrefValue = "";

			// exp_dispencer
			$expenseslist->exp_dispencer->HrefValue = "";

			// exp_slipt_num
			$expenseslist->exp_slipt_num->HrefValue = "";
		}
		if ($expenseslist->RowType == EW_ROWTYPE_ADD ||
			$expenseslist->RowType == EW_ROWTYPE_EDIT ||
			$expenseslist->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$expenseslist->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($expenseslist->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$expenseslist->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $expenseslist;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($expenseslist->exp_cat->FormValue) && $expenseslist->exp_cat->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expenseslist->exp_cat->FldCaption());
		}
		if (!is_null($expenseslist->exp_detail->FormValue) && $expenseslist->exp_detail->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expenseslist->exp_detail->FldCaption());
		}
		if (!is_null($expenseslist->exp_total->FormValue) && $expenseslist->exp_total->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expenseslist->exp_total->FldCaption());
		}
		if (!ew_CheckNumber($expenseslist->exp_total->FormValue)) {
			ew_AddMessage($gsFormError, $expenseslist->exp_total->FldErrMsg());
		}
		if (!is_null($expenseslist->exp_date->FormValue) && $expenseslist->exp_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expenseslist->exp_date->FldCaption());
		}
		if (!ew_CheckEuroDate($expenseslist->exp_date->FormValue)) {
			ew_AddMessage($gsFormError, $expenseslist->exp_date->FldErrMsg());
		}
		if (!is_null($expenseslist->exp_dispencer->FormValue) && $expenseslist->exp_dispencer->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expenseslist->exp_dispencer->FldCaption());
		}
		if (!is_null($expenseslist->exp_slipt_num->FormValue) && $expenseslist->exp_slipt_num->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $expenseslist->exp_slipt_num->FldCaption());
		}
		if (!ew_CheckInteger($expenseslist->exp_slipt_num->FormValue)) {
			ew_AddMessage($gsFormError, $expenseslist->exp_slipt_num->FldErrMsg());
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
		global $conn, $Security, $Language, $expenseslist;
		$sFilter = $expenseslist->KeyFilter();
		$expenseslist->CurrentFilter = $sFilter;
		$sSql = $expenseslist->SQL();
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

			// exp_cat
			$expenseslist->exp_cat->SetDbValueDef($rsnew, $expenseslist->exp_cat->CurrentValue, 0, $expenseslist->exp_cat->ReadOnly);

			// exp_detail
			$expenseslist->exp_detail->SetDbValueDef($rsnew, $expenseslist->exp_detail->CurrentValue, "", $expenseslist->exp_detail->ReadOnly);

			// exp_total
			$expenseslist->exp_total->SetDbValueDef($rsnew, $expenseslist->exp_total->CurrentValue, 0, $expenseslist->exp_total->ReadOnly);

			// exp_date
			$expenseslist->exp_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($expenseslist->exp_date->CurrentValue, 7), ew_CurrentDate(), $expenseslist->exp_date->ReadOnly);

			// exp_dispencer
			$expenseslist->exp_dispencer->SetDbValueDef($rsnew, $expenseslist->exp_dispencer->CurrentValue, "", $expenseslist->exp_dispencer->ReadOnly);

			// exp_slipt_num
			$expenseslist->exp_slipt_num->SetDbValueDef($rsnew, $expenseslist->exp_slipt_num->CurrentValue, "", $expenseslist->exp_slipt_num->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $expenseslist->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($expenseslist->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($expenseslist->CancelMessage <> "") {
					$this->setFailureMessage($expenseslist->CancelMessage);
					$expenseslist->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$expenseslist->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $expenseslist;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "expensescategory") {
				$bValidMaster = TRUE;
				if (@$_GET["exp_cat_id"] <> "") {
					$GLOBALS["expensescategory"]->exp_cat_id->setQueryStringValue($_GET["exp_cat_id"]);
					$expenseslist->exp_cat->setQueryStringValue($GLOBALS["expensescategory"]->exp_cat_id->QueryStringValue);
					$expenseslist->exp_cat->setSessionValue($expenseslist->exp_cat->QueryStringValue);
					if (!is_numeric($GLOBALS["expensescategory"]->exp_cat_id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$expenseslist->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$expenseslist->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "expensescategory") {
				if ($expenseslist->exp_cat->QueryStringValue == "") $expenseslist->exp_cat->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $expenseslist->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $expenseslist->getDetailFilter(); // Get detail filter
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
