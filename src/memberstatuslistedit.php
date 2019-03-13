<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "memberstatuslistinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$memberstatuslist_edit = new cmemberstatuslist_edit();
$Page =& $memberstatuslist_edit;

// Page init
$memberstatuslist_edit->Page_Init();

// Page main
$memberstatuslist_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var memberstatuslist_edit = new ew_Page("memberstatuslist_edit");

// page properties
memberstatuslist_edit.PageID = "edit"; // page ID
memberstatuslist_edit.FormID = "fmemberstatuslistedit"; // form ID
var EW_PAGE_ID = memberstatuslist_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
memberstatuslist_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($memberstatuslist->status->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_mbs_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($memberstatuslist->mbs_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_mbs_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($memberstatuslist->mbs_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_mbs_detail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($memberstatuslist->mbs_detail->FldCaption()) ?>");

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
memberstatuslist_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
memberstatuslist_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
memberstatuslist_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
memberstatuslist_edit.ValidateRequired = false; // no JavaScript validation
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
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $memberstatuslist->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $memberstatuslist->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php $memberstatuslist_edit->ShowPageHeader(); ?>
<?php
$memberstatuslist_edit->ShowMessage();
?>
<form name="fmemberstatuslistedit" id="fmemberstatuslistedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return memberstatuslist_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="memberstatuslist">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($memberstatuslist->member_id->Visible) { // member_id ?>
	<tr id="r_member_id"<?php echo $memberstatuslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memberstatuslist->member_id->FldCaption() ?></td>
		<td<?php echo $memberstatuslist->member_id->CellAttributes() ?>><span id="el_member_id">
<div<?php echo $memberstatuslist->member_id->ViewAttributes() ?>><?php echo $memberstatuslist->member_id->EditValue ?></div>
<input type="hidden" name="x_member_id" id="x_member_id" value="<?php echo ew_HtmlEncode($memberstatuslist->member_id->CurrentValue) ?>">
</span><?php echo $memberstatuslist->member_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($memberstatuslist->status->Visible) { // status ?>
	<tr id="r_status"<?php echo $memberstatuslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memberstatuslist->status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $memberstatuslist->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" value="{value}"<?php echo $memberstatuslist->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" data-repeatcolumn="5" class="ewItemList">
<?php
$arwrk = $memberstatuslist->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($memberstatuslist->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $memberstatuslist->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $memberstatuslist->status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($memberstatuslist->mbs_date->Visible) { // mbs_date ?>
	<tr id="r_mbs_date"<?php echo $memberstatuslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memberstatuslist->mbs_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $memberstatuslist->mbs_date->CellAttributes() ?>><span id="el_mbs_date">
<input type="text" name="x_mbs_date" id="x_mbs_date" value="<?php echo $memberstatuslist->mbs_date->EditValue ?>"<?php echo $memberstatuslist->mbs_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_mbs_date" name="cal_x_mbs_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_mbs_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_mbs_date" // button id
});
</script>
</span><?php echo $memberstatuslist->mbs_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($memberstatuslist->mbs_detail->Visible) { // mbs_detail ?>
	<tr id="r_mbs_detail"<?php echo $memberstatuslist->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $memberstatuslist->mbs_detail->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $memberstatuslist->mbs_detail->CellAttributes() ?>><span id="el_mbs_detail">
<textarea name="x_mbs_detail" id="x_mbs_detail" cols="35" rows="4"<?php echo $memberstatuslist->mbs_detail->EditAttributes() ?>><?php echo $memberstatuslist->mbs_detail->EditValue ?></textarea>
</span><?php echo $memberstatuslist->mbs_detail->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<input type="hidden" name="x_mbs_id" id="x_mbs_id" value="<?php echo ew_HtmlEncode($memberstatuslist->mbs_id->CurrentValue) ?>">
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$memberstatuslist_edit->ShowPageFooter();
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
$memberstatuslist_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cmemberstatuslist_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'memberstatuslist';

	// Page object name
	var $PageObjName = 'memberstatuslist_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $memberstatuslist;
		if ($memberstatuslist->UseTokenInUrl) $PageUrl .= "t=" . $memberstatuslist->TableVar . "&"; // Add page token
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
		global $objForm, $memberstatuslist;
		if ($memberstatuslist->UseTokenInUrl) {
			if ($objForm)
				return ($memberstatuslist->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($memberstatuslist->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmemberstatuslist_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (memberstatuslist)
		if (!isset($GLOBALS["memberstatuslist"])) {
			$GLOBALS["memberstatuslist"] = new cmemberstatuslist();
			$GLOBALS["Table"] =& $GLOBALS["memberstatuslist"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'memberstatuslist', TRUE);

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
		global $memberstatuslist;

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
		global $objForm, $Language, $gsFormError, $memberstatuslist;

		// Load key from QueryString
		if (@$_GET["mbs_id"] <> "")
			$memberstatuslist->mbs_id->setQueryStringValue($_GET["mbs_id"]);
		if (@$_POST["a_edit"] <> "") {
			$memberstatuslist->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$memberstatuslist->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$memberstatuslist->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$memberstatuslist->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($memberstatuslist->mbs_id->CurrentValue == "")
			$this->Page_Terminate("memberstatuslistlist.php"); // Invalid key, return to list
		switch ($memberstatuslist->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("memberstatuslistlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$memberstatuslist->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $memberstatuslist->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "memberstatuslistview.php")
						$sReturnUrl = $memberstatuslist->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$memberstatuslist->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$memberstatuslist->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$memberstatuslist->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $memberstatuslist;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $memberstatuslist;
		if (!$memberstatuslist->member_id->FldIsDetailKey) {
			$memberstatuslist->member_id->setFormValue($objForm->GetValue("x_member_id"));
		}
		if (!$memberstatuslist->status->FldIsDetailKey) {
			$memberstatuslist->status->setFormValue($objForm->GetValue("x_status"));
		}
		if (!$memberstatuslist->mbs_date->FldIsDetailKey) {
			$memberstatuslist->mbs_date->setFormValue($objForm->GetValue("x_mbs_date"));
			$memberstatuslist->mbs_date->CurrentValue = ew_UnFormatDateTime($memberstatuslist->mbs_date->CurrentValue, 7);
		}
		if (!$memberstatuslist->mbs_detail->FldIsDetailKey) {
			$memberstatuslist->mbs_detail->setFormValue($objForm->GetValue("x_mbs_detail"));
		}
		if (!$memberstatuslist->mbs_id->FldIsDetailKey)
			$memberstatuslist->mbs_id->setFormValue($objForm->GetValue("x_mbs_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $memberstatuslist;
		$this->LoadRow();
		$memberstatuslist->mbs_id->CurrentValue = $memberstatuslist->mbs_id->FormValue;
		$memberstatuslist->member_id->CurrentValue = $memberstatuslist->member_id->FormValue;
		$memberstatuslist->status->CurrentValue = $memberstatuslist->status->FormValue;
		$memberstatuslist->mbs_date->CurrentValue = $memberstatuslist->mbs_date->FormValue;
		$memberstatuslist->mbs_date->CurrentValue = ew_UnFormatDateTime($memberstatuslist->mbs_date->CurrentValue, 7);
		$memberstatuslist->mbs_detail->CurrentValue = $memberstatuslist->mbs_detail->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $memberstatuslist;
		$sFilter = $memberstatuslist->KeyFilter();

		// Call Row Selecting event
		$memberstatuslist->Row_Selecting($sFilter);

		// Load SQL based on filter
		$memberstatuslist->CurrentFilter = $sFilter;
		$sSql = $memberstatuslist->SQL();
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
		global $conn, $memberstatuslist;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$memberstatuslist->Row_Selected($row);
		$memberstatuslist->mbs_id->setDbValue($rs->fields('mbs_id'));
		$memberstatuslist->member_id->setDbValue($rs->fields('member_id'));
		$memberstatuslist->status->setDbValue($rs->fields('status'));
		$memberstatuslist->mbs_date->setDbValue($rs->fields('mbs_date'));
		$memberstatuslist->mbs_detail->setDbValue($rs->fields('mbs_detail'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $memberstatuslist;

		// Initialize URLs
		// Call Row_Rendering event

		$memberstatuslist->Row_Rendering();

		// Common render codes for all row types
		// mbs_id
		// member_id
		// status
		// mbs_date
		// mbs_detail

		if ($memberstatuslist->RowType == EW_ROWTYPE_VIEW) { // View row

			// mbs_id
			$memberstatuslist->mbs_id->ViewValue = $memberstatuslist->mbs_id->CurrentValue;
			$memberstatuslist->mbs_id->ViewCustomAttributes = "";

			// member_id
			$memberstatuslist->member_id->ViewValue = $memberstatuslist->member_id->CurrentValue;
			$memberstatuslist->member_id->ViewCustomAttributes = "";

			// status
			if (strval($memberstatuslist->status->CurrentValue) <> "") {
				$sFilterWrk = "`s_title` = '" . ew_AdjustSql($memberstatuslist->status->CurrentValue) . "'";
			$sSqlWrk = "SELECT `s_title` FROM `memberstatus`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$memberstatuslist->status->ViewValue = $rswrk->fields('s_title');
					$rswrk->Close();
				} else {
					$memberstatuslist->status->ViewValue = $memberstatuslist->status->CurrentValue;
				}
			} else {
				$memberstatuslist->status->ViewValue = NULL;
			}
			$memberstatuslist->status->ViewCustomAttributes = "";

			// mbs_date
			$memberstatuslist->mbs_date->ViewValue = $memberstatuslist->mbs_date->CurrentValue;
			$memberstatuslist->mbs_date->ViewValue = ew_FormatDateTime($memberstatuslist->mbs_date->ViewValue, 7);
			$memberstatuslist->mbs_date->ViewCustomAttributes = "";

			// mbs_detail
			$memberstatuslist->mbs_detail->ViewValue = $memberstatuslist->mbs_detail->CurrentValue;
			$memberstatuslist->mbs_detail->ViewCustomAttributes = "";

			// member_id
			$memberstatuslist->member_id->LinkCustomAttributes = "";
			$memberstatuslist->member_id->HrefValue = "";
			$memberstatuslist->member_id->TooltipValue = "";

			// status
			$memberstatuslist->status->LinkCustomAttributes = "";
			$memberstatuslist->status->HrefValue = "";
			$memberstatuslist->status->TooltipValue = "";

			// mbs_date
			$memberstatuslist->mbs_date->LinkCustomAttributes = "";
			$memberstatuslist->mbs_date->HrefValue = "";
			$memberstatuslist->mbs_date->TooltipValue = "";

			// mbs_detail
			$memberstatuslist->mbs_detail->LinkCustomAttributes = "";
			$memberstatuslist->mbs_detail->HrefValue = "";
			$memberstatuslist->mbs_detail->TooltipValue = "";
		} elseif ($memberstatuslist->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// member_id
			$memberstatuslist->member_id->EditCustomAttributes = "";
			$memberstatuslist->member_id->EditValue = $memberstatuslist->member_id->CurrentValue;
			$memberstatuslist->member_id->ViewCustomAttributes = "";

			// status
			$memberstatuslist->status->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `s_title`, `s_title` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld` FROM `memberstatus`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$memberstatuslist->status->EditValue = $arwrk;

			// mbs_date
			$memberstatuslist->mbs_date->EditCustomAttributes = "";
			$memberstatuslist->mbs_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($memberstatuslist->mbs_date->CurrentValue, 7));

			// mbs_detail
			$memberstatuslist->mbs_detail->EditCustomAttributes = "";
			$memberstatuslist->mbs_detail->EditValue = ew_HtmlEncode($memberstatuslist->mbs_detail->CurrentValue);

			// Edit refer script
			// member_id

			$memberstatuslist->member_id->HrefValue = "";

			// status
			$memberstatuslist->status->HrefValue = "";

			// mbs_date
			$memberstatuslist->mbs_date->HrefValue = "";

			// mbs_detail
			$memberstatuslist->mbs_detail->HrefValue = "";
		}
		if ($memberstatuslist->RowType == EW_ROWTYPE_ADD ||
			$memberstatuslist->RowType == EW_ROWTYPE_EDIT ||
			$memberstatuslist->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$memberstatuslist->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($memberstatuslist->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$memberstatuslist->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $memberstatuslist;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($memberstatuslist->status->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $memberstatuslist->status->FldCaption());
		}
		if (!is_null($memberstatuslist->mbs_date->FormValue) && $memberstatuslist->mbs_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $memberstatuslist->mbs_date->FldCaption());
		}
		if (!ew_CheckEuroDate($memberstatuslist->mbs_date->FormValue)) {
			ew_AddMessage($gsFormError, $memberstatuslist->mbs_date->FldErrMsg());
		}
		if (!is_null($memberstatuslist->mbs_detail->FormValue) && $memberstatuslist->mbs_detail->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $memberstatuslist->mbs_detail->FldCaption());
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
		global $conn, $Security, $Language, $memberstatuslist;
		$sFilter = $memberstatuslist->KeyFilter();
			if ($memberstatuslist->member_id->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`member_id` = " . ew_AdjustSql($memberstatuslist->member_id->CurrentValue) . ")";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$memberstatuslist->CurrentFilter = $sFilterChk;
			$sSqlChk = $memberstatuslist->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $memberstatuslist->member_id->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $memberstatuslist->member_id->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$memberstatuslist->CurrentFilter = $sFilter;
		$sSql = $memberstatuslist->SQL();
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

			// status
			$memberstatuslist->status->SetDbValueDef($rsnew, $memberstatuslist->status->CurrentValue, "", $memberstatuslist->status->ReadOnly);

			// mbs_date
			$memberstatuslist->mbs_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($memberstatuslist->mbs_date->CurrentValue, 7), ew_CurrentDate(), $memberstatuslist->mbs_date->ReadOnly);

			// mbs_detail
			$memberstatuslist->mbs_detail->SetDbValueDef($rsnew, $memberstatuslist->mbs_detail->CurrentValue, "", $memberstatuslist->mbs_detail->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $memberstatuslist->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($memberstatuslist->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($memberstatuslist->CancelMessage <> "") {
					$this->setFailureMessage($memberstatuslist->CancelMessage);
					$memberstatuslist->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$memberstatuslist->Row_Updated($rsold, $rsnew);
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
