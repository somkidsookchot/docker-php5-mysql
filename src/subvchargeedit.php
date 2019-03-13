<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "subvchargeinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$subvcharge_edit = new csubvcharge_edit();
$Page =& $subvcharge_edit;

// Page init
$subvcharge_edit->Page_Init();

// Page main
$subvcharge_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subvcharge_edit = new ew_Page("subvcharge_edit");

// page properties
subvcharge_edit.PageID = "edit"; // page ID
subvcharge_edit.FormID = "fsubvchargeedit"; // form ID
var EW_PAGE_ID = subvcharge_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
subvcharge_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
	elm = fobj.elements["x" + infix + "_subvc_total"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subvcharge->subvc_total->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_subvc_total"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subvcharge->subvc_total->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_subvc_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subvcharge->subvc_status->FldCaption()) ?>");
		/*
		elm = fobj.elements["x" + infix + "_subvc_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subvcharge->subvc_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_subvc_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($subvcharge->subvc_date->FldErrMsg()) ?>");
     */
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
subvcharge_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subvcharge_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subvcharge_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subvcharge_edit.ValidateRequired = false; // no JavaScript validation
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
<div class="ewTitle"><img src="images/finance55x55.png" width="40" height="40" align="absmiddle" />&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subvcharge->TableCaption() ?>
&nbsp;&nbsp; </div>
<div class="clear"></div>
<?php $subvcharge_edit->ShowPageHeader(); ?>
<?php
$subvcharge_edit->ShowMessage();
?>
<form name="fsubvchargeedit" id="fsubvchargeedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return subvcharge_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="subvcharge">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid">
  <tr>
    <td class="ewGridContent"><div class="ewGridMiddlePanel">
      <table cellspacing="0" class="ewTable">
        <?php if ($subvcharge->member_code->Visible) { // member_code ?>
        <tr id="r_member_code"<?php echo $subvcharge->RowAttributes() ?>>
          <td width="200" class="ewTableHeader"><?php echo $subvcharge->member_code->FldCaption() ?></td>
          <td<?php echo $subvcharge->member_code->CellAttributes() ?>><span id="el_member_code">
            <div<?php echo $subvcharge->member_code->ViewAttributes() ?>><?php echo $subvcharge->member_code->EditValue ?></div>
            <input type="hidden" name="x_member_code" id="x_member_code" value="<?php echo ew_HtmlEncode($subvcharge->member_code->CurrentValue) ?>" />
          </span><?php echo $subvcharge->member_code->CustomMsg ?></td>
        </tr>
        <?php } ?>
        <?php if ($subvcharge->subvc_total->Visible) { // subvc_total ?>
        <tr id="r_subvc_total"<?php echo $subvcharge->RowAttributes() ?>>
          <td class="ewTableHeader"><?php echo $subvcharge->subvc_total->FldCaption() ?></td>
          <td<?php echo $subvcharge->subvc_total->CellAttributes() ?>><span id="el_subvc_total">
            <input type="text" name="x_subvc_total" id="x_subvc_total" size="30" value="<?php echo round($subvcharge->subvc_total->EditValue) ?>"<?php echo $subvcharge->subvc_total->EditAttributes() ?> />
          </span><?php echo $subvcharge->subvc_total->CustomMsg ?></td>
        </tr>
        <?php } ?>
        <?php if ($subvcharge->bnfc_total->Visible) { // bnfc_total ?>
        <tr id="r_bnfc_total"<?php echo $subvcharge->RowAttributes() ?>>
          <td class="ewTableHeader"><?php echo $subvcharge->bnfc_total->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
          <td<?php echo $subvcharge->bnfc_total->CellAttributes() ?>><span id="el_bnfc_total">
            <input type="text" name="x_bnfc_total" id="x_bnfc_total" size="30" value="<?php echo round($subvcharge->bnfc_total->EditValue) ?>"<?php echo $subvcharge->bnfc_total->EditAttributes() ?> />
          </span><?php echo $subvcharge->bnfc_total->CustomMsg ?></td>
        </tr>
        <?php } ?>
        <?php if ($subvcharge->subvc_status->Visible) { // subvc_status ?>
        <tr id="r_subvc_status"<?php echo $subvcharge->RowAttributes() ?>>
          <td class="ewTableHeader"><?php echo $subvcharge->subvc_status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
          <td<?php echo $subvcharge->subvc_status->CellAttributes() ?>><span id="el_subvc_status">
            <select id="x_subvc_status" name="x_subvc_status"<?php echo $subvcharge->subvc_status->EditAttributes() ?>>
              <?php
if (is_array($subvcharge->subvc_status->EditValue)) {
	$arwrk = $subvcharge->subvc_status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subvcharge->subvc_status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
              <option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>> <?php echo $arwrk[$rowcntwrk][1] ?> </option>
              <?php
	}
}
?>
            </select>
          </span><?php echo $subvcharge->subvc_status->CustomMsg ?></td>
        </tr>
        <?php } ?>
        <?php if ($subvcharge->subvc_date->Visible) { // subvc_date ?>
        <tr id="r_subvc_date"<?php echo $subvcharge->RowAttributes() ?>>
          <td class="ewTableHeader"><?php echo $subvcharge->subvc_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
          <td<?php echo $subvcharge->subvc_date->CellAttributes() ?>><span id="el_subvc_date">
            <input type="text" name="x_subvc_date" id="x_subvc_date" value="<?php echo $subvcharge->subvc_date->EditValue ?>"<?php echo $subvcharge->subvc_date->EditAttributes() ?> />
            &nbsp;<img src="phpimages/calendar.png" id="cal_x_subvc_date" name="cal_x_subvc_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;" />
            <script type="text/javascript">
Calendar.setup({
	inputField: "x_subvc_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_subvc_date" // button id
});
</script>
          </span><?php echo $subvcharge->subvc_date->CustomMsg ?></td>
        </tr>
        <?php } ?>
      </table>
    </div></td>
  </tr>
</table>
<input type="hidden" name="x_subvc_id" id="x_subvc_id" value="<?php echo ew_HtmlEncode($subvcharge->subvc_id->CurrentValue) ?>">
<p><a href="<?php echo $subvcharge->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a>&nbsp;
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$subvcharge_edit->ShowPageFooter();
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
$subvcharge_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class csubvcharge_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'subvcharge';

	// Page object name
	var $PageObjName = 'subvcharge_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subvcharge;
		if ($subvcharge->UseTokenInUrl) $PageUrl .= "t=" . $subvcharge->TableVar . "&"; // Add page token
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
		global $objForm, $subvcharge;
		if ($subvcharge->UseTokenInUrl) {
			if ($objForm)
				return ($subvcharge->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subvcharge->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubvcharge_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (subvcharge)
		if (!isset($GLOBALS["subvcharge"])) {
			$GLOBALS["subvcharge"] = new csubvcharge();
			$GLOBALS["Table"] =& $GLOBALS["subvcharge"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subvcharge', TRUE);

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
		global $subvcharge;

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
		global $objForm, $Language, $gsFormError, $subvcharge;

		// Load key from QueryString
		if (@$_GET["subvc_id"] <> "")
			$subvcharge->subvc_id->setQueryStringValue($_GET["subvc_id"]);
		if (@$_POST["a_edit"] <> "") {
			$subvcharge->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$subvcharge->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$subvcharge->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$subvcharge->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($subvcharge->subvc_id->CurrentValue == "")
			$this->Page_Terminate("subvchargelist.php"); // Invalid key, return to list
		switch ($subvcharge->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("subvchargelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$subvcharge->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $subvcharge->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "subvchargeview.php")
						$sReturnUrl = $subvcharge->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$subvcharge->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$subvcharge->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$subvcharge->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $subvcharge;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $subvcharge;
		if (!$subvcharge->member_code->FldIsDetailKey) {
			$subvcharge->member_code->setFormValue($objForm->GetValue("x_member_code"));
		}
		if (!$subvcharge->cant_pay_detail->FldIsDetailKey) {
			$subvcharge->cant_pay_detail->setFormValue($objForm->GetValue("x_cant_pay_detail"));
		}
		if (!$subvcharge->subvc_total->FldIsDetailKey) {
			$subvcharge->subvc_total->setFormValue($objForm->GetValue("x_subvc_total"));
		}
		if (!$subvcharge->assc_percent->FldIsDetailKey) {
			$subvcharge->assc_percent->setFormValue($objForm->GetValue("x_assc_percent"));
		}
		if (!$subvcharge->assc_total->FldIsDetailKey) {
			$subvcharge->assc_total->setFormValue($objForm->GetValue("x_assc_total"));
		}
		if (!$subvcharge->bnfc_total->FldIsDetailKey) {
			$subvcharge->bnfc_total->setFormValue($objForm->GetValue("x_bnfc_total"));
		}
		if (!$subvcharge->subvc_status->FldIsDetailKey) {
			$subvcharge->subvc_status->setFormValue($objForm->GetValue("x_subvc_status"));
		}
		if (!$subvcharge->subvc_date->FldIsDetailKey) {
			$subvcharge->subvc_date->setFormValue($objForm->GetValue("x_subvc_date"));
			$subvcharge->subvc_date->CurrentValue = ew_UnFormatDateTime($subvcharge->subvc_date->CurrentValue, 7);
		}
		if (!$subvcharge->subvc_id->FldIsDetailKey)
			$subvcharge->subvc_id->setFormValue($objForm->GetValue("x_subvc_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $subvcharge;
		$this->LoadRow();
		$subvcharge->subvc_id->CurrentValue = $subvcharge->subvc_id->FormValue;
		$subvcharge->member_code->CurrentValue = $subvcharge->member_code->FormValue;
		$subvcharge->cant_pay_detail->CurrentValue = $subvcharge->cant_pay_detail->FormValue;
		$subvcharge->subvc_total->CurrentValue = $subvcharge->subvc_total->FormValue;
		$subvcharge->assc_percent->CurrentValue = $subvcharge->assc_percent->FormValue;
		$subvcharge->assc_total->CurrentValue = $subvcharge->assc_total->FormValue;
		$subvcharge->bnfc_total->CurrentValue = $subvcharge->bnfc_total->FormValue;
		$subvcharge->subvc_status->CurrentValue = $subvcharge->subvc_status->FormValue;
		$subvcharge->subvc_date->CurrentValue = $subvcharge->subvc_date->FormValue;
		$subvcharge->subvc_date->CurrentValue = ew_UnFormatDateTime($subvcharge->subvc_date->CurrentValue, 7);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subvcharge;
		$sFilter = $subvcharge->KeyFilter();

		// Call Row Selecting event
		$subvcharge->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subvcharge->CurrentFilter = $sFilter;
		$sSql = $subvcharge->SQL();
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
		global $conn, $subvcharge;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$subvcharge->Row_Selected($row);
		$subvcharge->subvc_id->setDbValue($rs->fields('subvc_id'));
		$subvcharge->member_code->setDbValue($rs->fields('member_code'));
		$subvcharge->all_member->setDbValue($rs->fields('all_member'));
		$subvcharge->alive_count->setDbValue($rs->fields('alive_count'));
		$subvcharge->dead_count->setDbValue($rs->fields('dead_count'));
		$subvcharge->resign_count->setDbValue($rs->fields('resign_count'));
		$subvcharge->terminate_count->setDbValue($rs->fields('terminate_count'));
		$subvcharge->subv_rate->setDbValue($rs->fields('subv_rate'));
		$subvcharge->can_pay_count->setDbValue($rs->fields('can_pay_count'));
		$subvcharge->cant_pay_count->setDbValue($rs->fields('cant_pay_count'));
		$subvcharge->cant_pay_detail->setDbValue($rs->fields('cant_pay_detail'));
		$subvcharge->subvc_total->setDbValue($rs->fields('subvc_total'));
		$subvcharge->assc_percent->setDbValue($rs->fields('assc_percent'));
		$subvcharge->assc_total->setDbValue($rs->fields('assc_total'));
		$subvcharge->bnfc_total->setDbValue($rs->fields('bnfc_total'));
		$subvcharge->canculate_date->setDbValue($rs->fields('canculate_date'));
		$subvcharge->subvc_status->setDbValue($rs->fields('subvc_status'));
		$subvcharge->subvc_date->setDbValue($rs->fields('subvc_date'));
		$subvcharge->subvc_slipt_num->setDbValue($rs->fields('subvc_slipt_num'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subvcharge;

		// Initialize URLs
		// Call Row_Rendering event

		$subvcharge->Row_Rendering();

		// Common render codes for all row types
		// subvc_id
		// member_code
		// all_member
		// alive_count
		// dead_count
		// resign_count
		// terminate_count
		// subv_rate
		// can_pay_count
		// cant_pay_count
		// cant_pay_detail
		// subvc_total
		// assc_percent
		// assc_total
		// bnfc_total
		// canculate_date
		// subvc_status
		// subvc_date
		// subvc_slipt_num

		if ($subvcharge->RowType == EW_ROWTYPE_VIEW) { // View row

			// member_code
			$subvcharge->member_code->ViewValue = $subvcharge->member_code->CurrentValue;
			if (strval($subvcharge->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($subvcharge->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcharge->member_code->ViewValue = $rswrk->fields('dead_id');
					$subvcharge->member_code->ViewValue .= ew_ValueSeparator(0,1,$subvcharge->member_code) . $rswrk->fields('fname');
					$subvcharge->member_code->ViewValue .= ew_ValueSeparator(0,2,$subvcharge->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$subvcharge->member_code->ViewValue = $subvcharge->member_code->CurrentValue;
				}
			} else {
				$subvcharge->member_code->ViewValue = NULL;
			}
			$subvcharge->member_code->ViewCustomAttributes = "";

			// cant_pay_detail
			$subvcharge->cant_pay_detail->ViewValue = $subvcharge->cant_pay_detail->CurrentValue;
			$subvcharge->cant_pay_detail->ViewCustomAttributes = "";

			// subvc_total
			$subvcharge->subvc_total->ViewValue = $subvcharge->subvc_total->CurrentValue;
			$subvcharge->subvc_total->ViewCustomAttributes = "";

			// assc_percent
			$subvcharge->assc_percent->ViewValue = $subvcharge->assc_percent->CurrentValue;
			$subvcharge->assc_percent->ViewCustomAttributes = "";

			// assc_total
			$subvcharge->assc_total->ViewValue = $subvcharge->assc_total->CurrentValue;
			$subvcharge->assc_total->ViewCustomAttributes = "";

			// bnfc_total
			$subvcharge->bnfc_total->ViewValue = $subvcharge->bnfc_total->CurrentValue;
			$subvcharge->bnfc_total->ViewCustomAttributes = "";

			// subvc_status
			if (strval($subvcharge->subvc_status->CurrentValue) <> "") {
				switch ($subvcharge->subvc_status->CurrentValue) {
					case "รอจ่าย":
						$subvcharge->subvc_status->ViewValue = $subvcharge->subvc_status->FldTagCaption(1) <> "" ? $subvcharge->subvc_status->FldTagCaption(1) : $subvcharge->subvc_status->CurrentValue;
						break;
					case "จ่ายแล้ว":
						$subvcharge->subvc_status->ViewValue = $subvcharge->subvc_status->FldTagCaption(2) <> "" ? $subvcharge->subvc_status->FldTagCaption(2) : $subvcharge->subvc_status->CurrentValue;
						break;
					default:
						$subvcharge->subvc_status->ViewValue = $subvcharge->subvc_status->CurrentValue;
				}
			} else {
				$subvcharge->subvc_status->ViewValue = NULL;
			}
			$subvcharge->subvc_status->ViewCustomAttributes = "";

			// subvc_date
			$subvcharge->subvc_date->ViewValue = $subvcharge->subvc_date->CurrentValue;
			$subvcharge->subvc_date->ViewValue = ew_FormatDateTime($subvcharge->subvc_date->ViewValue, 7);
			$subvcharge->subvc_date->ViewCustomAttributes = "";

			// member_code
			$subvcharge->member_code->LinkCustomAttributes = "";
			$subvcharge->member_code->HrefValue = "";
			$subvcharge->member_code->TooltipValue = "";

			// cant_pay_detail
			$subvcharge->cant_pay_detail->LinkCustomAttributes = "";
			$subvcharge->cant_pay_detail->HrefValue = "";
			$subvcharge->cant_pay_detail->TooltipValue = "";

			// subvc_total
			$subvcharge->subvc_total->LinkCustomAttributes = "";
			$subvcharge->subvc_total->HrefValue = "";
			$subvcharge->subvc_total->TooltipValue = "";

			// assc_percent
			$subvcharge->assc_percent->LinkCustomAttributes = "";
			$subvcharge->assc_percent->HrefValue = "";
			$subvcharge->assc_percent->TooltipValue = "";

			// assc_total
			$subvcharge->assc_total->LinkCustomAttributes = "";
			$subvcharge->assc_total->HrefValue = "";
			$subvcharge->assc_total->TooltipValue = "";

			// bnfc_total
			$subvcharge->bnfc_total->LinkCustomAttributes = "";
			$subvcharge->bnfc_total->HrefValue = "";
			$subvcharge->bnfc_total->TooltipValue = "";

			// subvc_status
			$subvcharge->subvc_status->LinkCustomAttributes = "";
			$subvcharge->subvc_status->HrefValue = "";
			$subvcharge->subvc_status->TooltipValue = "";

			// subvc_date
			$subvcharge->subvc_date->LinkCustomAttributes = "";
			$subvcharge->subvc_date->HrefValue = "";
			$subvcharge->subvc_date->TooltipValue = "";
		} elseif ($subvcharge->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// member_code
			$subvcharge->member_code->EditCustomAttributes = "";
			$subvcharge->member_code->EditValue = $subvcharge->member_code->CurrentValue;
			if (strval($subvcharge->member_code->CurrentValue) <> "") {
				$sFilterWrk = "`member_code` = '" . ew_AdjustSql($subvcharge->member_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subvcharge->member_code->EditValue = $rswrk->fields('dead_id');
					$subvcharge->member_code->EditValue .= ew_ValueSeparator(0,1,$subvcharge->member_code) . $rswrk->fields('fname');
					$subvcharge->member_code->EditValue .= ew_ValueSeparator(0,2,$subvcharge->member_code) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$subvcharge->member_code->EditValue = $subvcharge->member_code->CurrentValue;
				}
			} else {
				$subvcharge->member_code->EditValue = NULL;
			}
			$subvcharge->member_code->ViewCustomAttributes = "";

			// cant_pay_detail
			// subvc_total

			$subvcharge->subvc_total->EditCustomAttributes = "";
			$subvcharge->subvc_total->EditValue = $subvcharge->subvc_total->CurrentValue;
			$subvcharge->subvc_total->ViewCustomAttributes = "";

			// assc_percent
			// assc_total
			// bnfc_total

			$subvcharge->bnfc_total->EditCustomAttributes = "";
			$subvcharge->bnfc_total->EditValue = ew_HtmlEncode($subvcharge->bnfc_total->CurrentValue);
	
			// subvc_status
	
			$subvcharge->subvc_status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("รอจ่าย", $subvcharge->subvc_status->FldTagCaption(1) <> "" ? $subvcharge->subvc_status->FldTagCaption(1) : "รอจ่าย");
			$arwrk[] = array("จ่ายแล้ว", $subvcharge->subvc_status->FldTagCaption(2) <> "" ? $subvcharge->subvc_status->FldTagCaption(2) : "จ่ายแล้ว");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$subvcharge->subvc_status->EditValue = $arwrk;

			// subvc_date
			$subvcharge->subvc_date->EditCustomAttributes = "";
			$subvcharge->subvc_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($subvcharge->subvc_date->CurrentValue, 7));

			// Edit refer script
			// member_code

			$subvcharge->member_code->HrefValue = "";

			// cant_pay_detail
			$subvcharge->cant_pay_detail->HrefValue = "";

			// subvc_total
			$subvcharge->subvc_total->HrefValue = "";

			// assc_percent
			$subvcharge->assc_percent->HrefValue = "";

			// assc_total
			$subvcharge->assc_total->HrefValue = "";

			// bnfc_total
			$subvcharge->bnfc_total->HrefValue = "";
	
			// subvc_status
			$subvcharge->subvc_status->HrefValue = "";

			// subvc_date
			$subvcharge->subvc_date->HrefValue = "";
		}
		if ($subvcharge->RowType == EW_ROWTYPE_ADD ||
			$subvcharge->RowType == EW_ROWTYPE_EDIT ||
			$subvcharge->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$subvcharge->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($subvcharge->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subvcharge->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $subvcharge;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($subvcharge->bnfc_total->FormValue) && $subvcharge->bnfc_total->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $subvcharge->bnfc_total->FldCaption());
		}
		if (!ew_CheckNumber($subvcharge->bnfc_total->FormValue)) {
			ew_AddMessage($gsFormError, $subvcharge->bnfc_total->FldErrMsg());
		}
		if (!is_null($subvcharge->subvc_status->FormValue) && $subvcharge->subvc_status->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $subvcharge->subvc_status->FldCaption());
		}
		if (!is_null($subvcharge->subvc_date->FormValue) && $subvcharge->subvc_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $subvcharge->subvc_date->FldCaption());
		}
		if (!ew_CheckEuroDate($subvcharge->subvc_date->FormValue)) {
			ew_AddMessage($gsFormError, $subvcharge->subvc_date->FldErrMsg());
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
		global $conn, $Security, $Language, $subvcharge;
		$sFilter = $subvcharge->KeyFilter();
		$subvcharge->CurrentFilter = $sFilter;
		$sSql = $subvcharge->SQL();
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

			// subvc_total
			$subvcharge->subvc_total->SetDbValueDef($rsnew, $subvcharge->subvc_total->CurrentValue, 0, $subvcharge->subvc_total->ReadOnly);
			
			// bnfc_total
			$subvcharge->bnfc_total->SetDbValueDef($rsnew, $subvcharge->bnfc_total->CurrentValue, 0, $subvcharge->bnfc_total->ReadOnly);
			// subvc_status
			$subvcharge->subvc_status->SetDbValueDef($rsnew, $subvcharge->subvc_status->CurrentValue, "", $subvcharge->subvc_status->ReadOnly);

			// subvc_date
			$subvcharge->subvc_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($subvcharge->subvc_date->CurrentValue, 7), ew_CurrentDate(), $subvcharge->subvc_date->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $subvcharge->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($subvcharge->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($subvcharge->CancelMessage <> "") {
					$this->setFailureMessage($subvcharge->CancelMessage);
					$subvcharge->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$subvcharge->Row_Updated($rsold, $rsnew);
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
