<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "paymentsummaryinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "villageinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$paymentsummary_edit = new cpaymentsummary_edit();
$Page =& $paymentsummary_edit;

// Page init
$paymentsummary_edit->Page_Init();

// Page main
$paymentsummary_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var paymentsummary_edit = new ew_Page("paymentsummary_edit");

// page properties
paymentsummary_edit.PageID = "edit"; // page ID
paymentsummary_edit.FormID = "fpaymentsummaryedit"; // form ID
var EW_PAGE_ID = paymentsummary_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
paymentsummary_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_pay_sum_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($paymentsummary->pay_sum_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pay_sum_date"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($paymentsummary->pay_sum_date->FldErrMsg()) ?>");

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
paymentsummary_edit.Form_CustomValidate =  function(fobj) { // DO NOT CHANGE THIS LINE!
	// Your custom validation code here, return false if invalid. 

 var dcount = fobj.elements["x_pay_death_begin"]     ;  
 var ptype =  fobj.elements["x_pay_sum_type"]     ;   
 var tcount =   fobj.elements["x_pay_sum_detail"]     ; 
														   
	 if(ptype.value ==1 && dcount.value < 1){
		  return ew_OnError(this, fobj.elements["x_pay_death_begin"], "โปรดเลือกศพที่จะชำระ");
	 }           
		  
	 if(ptype.value ==2 && fobj.elements["x_pay_sum_adv_count"].value == ''){
		  return ew_OnError(this, fobj.elements["x_pay_sum_adv_count"], "โปรดระบุจำนวนศพ");
	 }                              
	 
	 if(ptype.value ==3 && fobj.elements["x_pay_annual_year"].value < 1){
		  return ew_OnError(this, fobj.elements["x_pay_annual_year"], "โปรดระบุปี พ.ศ. ที่จ่าย");
	 }                                         
	 
	 if(ptype.value ==5 && tcount.value < 1){
	  // if(fobj.elements["x_pay_sum_total"].value =='') return ew_OnError(this, fobj.elements["x_pay_sum_total"], "โปรดระบุจำนวนเงิน"); 
	   if(fobj.elements["x_pay_sum_detail"].value =='') return ew_OnError(this, fobj.elements["x_pay_sum_detail"], "โปรดระบุรายละเอียด");
	 }
											   
	return true;                                                                      
}                                                                                  

paymentsummary_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
paymentsummary_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
paymentsummary_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
paymentsummary_edit.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
paymentsummary_edit.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<div class="phpmaker ewTitle"><img src="images/ico_paid.png" width="40" height="40" align="absmiddle" /><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $paymentsummary->TableCaption() ?></div>
<div class="clear"></div>
<?php $paymentsummary_edit->ShowPageHeader(); ?>
<?php
$paymentsummary_edit->ShowMessage();
?>
<form name="fpaymentsummaryedit" id="fpaymentsummaryedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return paymentsummary_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="paymentsummary">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($paymentsummary->pay_sum_id->Visible) { // pay_sum_id ?>
	<tr id="r_pay_sum_id"<?php echo $paymentsummary->RowAttributes() ?>>
		<td width="170" class="ewTableHeader"><?php echo $paymentsummary->pay_sum_id->FldCaption() ?></td>
		<td<?php echo $paymentsummary->pay_sum_id->CellAttributes() ?>><span id="el_pay_sum_id">
<div<?php echo $paymentsummary->pay_sum_id->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_id->EditValue ?></div>
<input type="hidden" name="x_pay_sum_id" id="x_pay_sum_id" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_id->CurrentValue) ?>">
</span><?php echo $paymentsummary->pay_sum_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentsummary->t_code->Visible) { // t_code ?>
	<tr id="r_t_code"<?php echo $paymentsummary->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentsummary->t_code->FldCaption() ?></td>
		<td<?php echo $paymentsummary->t_code->CellAttributes() ?>><span id="el_t_code">
<div<?php echo $paymentsummary->t_code->ViewAttributes() ?>><?php echo $paymentsummary->t_code->EditValue ?></div>
<input type="hidden" name="x_t_code" id="x_t_code" value="<?php echo ew_HtmlEncode($paymentsummary->t_code->CurrentValue) ?>">
</span><?php echo $paymentsummary->t_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentsummary->village_id->Visible) { // village_id ?>
	<tr id="r_village_id"<?php echo $paymentsummary->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentsummary->village_id->FldCaption() ?></td>
		<td<?php echo $paymentsummary->village_id->CellAttributes() ?>><span id="el_village_id">
<div<?php echo $paymentsummary->village_id->ViewAttributes() ?>><?php echo $paymentsummary->village_id->EditValue ?></div>
<input type="hidden" name="x_village_id" id="x_village_id" value="<?php echo ew_HtmlEncode($paymentsummary->village_id->CurrentValue) ?>">
</span><?php echo $paymentsummary->village_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentsummary->member_code->Visible) { // member_code ?>
	<tr id="r_member_code"<?php echo $paymentsummary->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentsummary->member_code->FldCaption() ?></td>
		<td<?php echo $paymentsummary->member_code->CellAttributes() ?>><span id="el_member_code">
<div<?php echo $paymentsummary->member_code->ViewAttributes() ?>><?php echo $paymentsummary->member_code->EditValue ?></div>
<input type="hidden" name="x_member_code" id="x_member_code" value="<?php echo ew_HtmlEncode($paymentsummary->member_code->CurrentValue) ?>">
</span><?php echo $paymentsummary->member_code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentsummary->pay_sum_date->Visible) { // pay_sum_date ?>
	<tr id="r_pay_sum_date"<?php echo $paymentsummary->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentsummary->pay_sum_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $paymentsummary->pay_sum_date->CellAttributes() ?>><span id="el_pay_sum_date">
<input type="text" name="x_pay_sum_date" id="x_pay_sum_date" value="<?php echo $paymentsummary->pay_sum_date->EditValue ?>"<?php echo $paymentsummary->pay_sum_date->EditAttributes() ?>>
&nbsp;<img src="phpimages/calendar.png" id="cal_x_pay_sum_date" name="cal_x_pay_sum_date" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_pay_sum_date", // input field id
	ifFormat: "%d/%m/%Y", // date format
	button: "cal_x_pay_sum_date" // button id
});
</script>
</span><?php echo $paymentsummary->pay_sum_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentsummary->pay_sum_type->Visible) { // pay_sum_type ?>
	<tr id="r_pay_sum_type"<?php echo $paymentsummary->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentsummary->pay_sum_type->FldCaption() ?></td>
		<td<?php echo $paymentsummary->pay_sum_type->CellAttributes() ?>><span id="el_pay_sum_type">
<div<?php echo $paymentsummary->pay_sum_type->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_type->EditValue ?></div>
<input type="hidden" name="x_pay_sum_type" id="x_pay_sum_type" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_type->CurrentValue) ?>">
</span><?php echo $paymentsummary->pay_sum_type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentsummary->pay_death_begin->Visible) { // pay_death_begin ?>
	<tr id="r_pay_death_begin"<?php echo $paymentsummary->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentsummary->pay_death_begin->FldCaption() ?></td>
		<td<?php echo $paymentsummary->pay_death_begin->CellAttributes() ?>><span id="el_pay_death_begin">
<div<?php echo $paymentsummary->pay_death_begin->ViewAttributes() ?>><?php echo $paymentsummary->pay_death_begin->EditValue ?></div>
<input type="hidden" name="x_pay_death_begin" id="x_pay_death_begin" value="<?php echo ew_HtmlEncode($paymentsummary->pay_death_begin->CurrentValue) ?>">
</span><?php echo $paymentsummary->pay_death_begin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentsummary->pay_sum_adv_num->Visible) { // pay_sum_adv_num ?>
	<tr id="r_pay_sum_adv_num"<?php echo $paymentsummary->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentsummary->pay_sum_adv_num->FldCaption() ?></td>
		<td<?php echo $paymentsummary->pay_sum_adv_num->CellAttributes() ?>><span id="el_pay_sum_adv_num">
<div<?php echo $paymentsummary->pay_sum_adv_num->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_adv_num->EditValue ?></div>
<input type="hidden" name="x_pay_sum_adv_num" id="x_pay_sum_adv_num" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_adv_num->CurrentValue) ?>">
</span><?php echo $paymentsummary->pay_sum_adv_num->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentsummary->pay_annual_year->Visible) { // pay_annual_year ?>
	<tr id="r_pay_annual_year"<?php echo $paymentsummary->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentsummary->pay_annual_year->FldCaption() ?></td>
		<td<?php echo $paymentsummary->pay_annual_year->CellAttributes() ?>><span id="el_pay_annual_year">
<div<?php echo $paymentsummary->pay_annual_year->ViewAttributes() ?>><?php echo $paymentsummary->pay_annual_year->EditValue ?></div>
<input type="hidden" name="x_pay_annual_year" id="x_pay_annual_year" value="<?php echo ew_HtmlEncode($paymentsummary->pay_annual_year->CurrentValue) ?>">
</span><?php echo $paymentsummary->pay_annual_year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentsummary->pay_sum_detail->Visible) { // pay_sum_detail ?>
	<tr id="r_pay_sum_detail"<?php echo $paymentsummary->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentsummary->pay_sum_detail->FldCaption() ?></td>
		<td<?php echo $paymentsummary->pay_sum_detail->CellAttributes() ?>><span id="el_pay_sum_detail">
<div<?php echo $paymentsummary->pay_sum_detail->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_detail->EditValue ?></div>
<input type="hidden" name="x_pay_sum_detail" id="x_pay_sum_detail" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_detail->CurrentValue) ?>">
</span><?php echo $paymentsummary->pay_sum_detail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentsummary->pay_sum_total->Visible) { // pay_sum_total ?>
	<tr id="r_pay_sum_total"<?php echo $paymentsummary->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentsummary->pay_sum_total->FldCaption() ?></td>
		<td<?php echo $paymentsummary->pay_sum_total->CellAttributes() ?>><span id="el_pay_sum_total">
<div<?php echo $paymentsummary->pay_sum_total->ViewAttributes() ?>><?php echo $paymentsummary->pay_sum_total->EditValue ?></div>
<input type="hidden" name="x_pay_sum_total" id="x_pay_sum_total" value="<?php echo ew_HtmlEncode($paymentsummary->pay_sum_total->CurrentValue) ?>">
</span><?php echo $paymentsummary->pay_sum_total->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentsummary->pay_sum_note->Visible) { // pay_sum_note ?>
	<tr id="r_pay_sum_note"<?php echo $paymentsummary->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $paymentsummary->pay_sum_note->FldCaption() ?></td>
		<td<?php echo $paymentsummary->pay_sum_note->CellAttributes() ?>><span id="el_pay_sum_note">
<textarea name="x_pay_sum_note" id="x_pay_sum_note" cols="35" rows="4"<?php echo $paymentsummary->pay_sum_note->EditAttributes() ?>><?php echo $paymentsummary->pay_sum_note->EditValue ?></textarea>
</span><?php echo $paymentsummary->pay_sum_note->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($paymentsummary->flag->getSessionValue() <> "") { ?>
<input type="hidden" id="x_flag" name="x_flag" value="<?php echo ew_HtmlEncode($paymentsummary->flag->CurrentValue) ?>">
<?php } else { ?>
<input type="hidden" name="x_flag" id="x_flag" value="<?php echo ew_HtmlEncode($paymentsummary->flag->CurrentValue) ?>">
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<a href="<?php echo $paymentsummary->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a>&nbsp;
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--
ew_UpdateOpts([['x_t_code','x_t_code',false]]);

//-->
</script>
<?php
$paymentsummary_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
hidefield('<?php echo $paymentsummary->pay_sum_type->CurrentValue;?>'); 
showfield('<?php echo $paymentsummary->pay_sum_type->CurrentValue;?>'); 

//-->

</script>
<?php include_once "footer.php" ?>
<?php
$paymentsummary_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cpaymentsummary_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'paymentsummary';

	// Page object name
	var $PageObjName = 'paymentsummary_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $paymentsummary;
		if ($paymentsummary->UseTokenInUrl) $PageUrl .= "t=" . $paymentsummary->TableVar . "&"; // Add page token
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
		global $objForm, $paymentsummary;
		if ($paymentsummary->UseTokenInUrl) {
			if ($objForm)
				return ($paymentsummary->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($paymentsummary->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpaymentsummary_edit() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (paymentsummary)
		if (!isset($GLOBALS["paymentsummary"])) {
			$GLOBALS["paymentsummary"] = new cpaymentsummary();
			$GLOBALS["Table"] =& $GLOBALS["paymentsummary"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Table object (village)
		if (!isset($GLOBALS['village'])) $GLOBALS['village'] = new cvillage();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'paymentsummary', TRUE);

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
		global $paymentsummary;

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
		global $objForm, $Language, $gsFormError, $paymentsummary;

		// Load key from QueryString
		if (@$_GET["pay_sum_id"] <> "")
			$paymentsummary->pay_sum_id->setQueryStringValue($_GET["pay_sum_id"]);

		// Set up master detail parameters
		$this->SetUpMasterParms();
		if (@$_POST["a_edit"] <> "") {
			$paymentsummary->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$paymentsummary->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$paymentsummary->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$paymentsummary->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($paymentsummary->pay_sum_id->CurrentValue == "")
			$this->Page_Terminate("paymentsummarylist.php"); // Invalid key, return to list
		switch ($paymentsummary->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("paymentsummarylist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$paymentsummary->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $paymentsummary->ViewUrl();
					if (ew_GetPageName($sReturnUrl) == "paymentsummaryview.php")
						$sReturnUrl = $paymentsummary->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$paymentsummary->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$paymentsummary->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$paymentsummary->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $paymentsummary;

		// Get upload data
		$index = $objForm->Index; // Save form index
		$objForm->Index = 0;
		$confirmPage = (strval($objForm->GetValue("a_confirm")) <> "");
		$objForm->Index = $index; // Restore form index
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $paymentsummary;
		if (!$paymentsummary->pay_sum_id->FldIsDetailKey)
			$paymentsummary->pay_sum_id->setFormValue($objForm->GetValue("x_pay_sum_id"));
		if (!$paymentsummary->t_code->FldIsDetailKey) {
			$paymentsummary->t_code->setFormValue($objForm->GetValue("x_t_code"));
		}
		if (!$paymentsummary->village_id->FldIsDetailKey) {
			$paymentsummary->village_id->setFormValue($objForm->GetValue("x_village_id"));
		}
		if (!$paymentsummary->member_code->FldIsDetailKey) {
			$paymentsummary->member_code->setFormValue($objForm->GetValue("x_member_code"));
		}
		if (!$paymentsummary->pay_sum_date->FldIsDetailKey) {
			$paymentsummary->pay_sum_date->setFormValue($objForm->GetValue("x_pay_sum_date"));
			$paymentsummary->pay_sum_date->CurrentValue = ew_UnFormatDateTime($paymentsummary->pay_sum_date->CurrentValue, 7);
		}
		if (!$paymentsummary->pay_sum_type->FldIsDetailKey) {
			$paymentsummary->pay_sum_type->setFormValue($objForm->GetValue("x_pay_sum_type"));
		}
		if (!$paymentsummary->pay_death_begin->FldIsDetailKey) {
			$paymentsummary->pay_death_begin->setFormValue($objForm->GetValue("x_pay_death_begin"));
		}
		if (!$paymentsummary->pay_sum_adv_num->FldIsDetailKey) {
			$paymentsummary->pay_sum_adv_num->setFormValue($objForm->GetValue("x_pay_sum_adv_num"));
		}
		if (!$paymentsummary->pay_annual_year->FldIsDetailKey) {
			$paymentsummary->pay_annual_year->setFormValue($objForm->GetValue("x_pay_annual_year"));
		}
		if (!$paymentsummary->pay_sum_detail->FldIsDetailKey) {
			$paymentsummary->pay_sum_detail->setFormValue($objForm->GetValue("x_pay_sum_detail"));
		}
		if (!$paymentsummary->pay_sum_total->FldIsDetailKey) {
			$paymentsummary->pay_sum_total->setFormValue($objForm->GetValue("x_pay_sum_total"));
		}
		if (!$paymentsummary->pay_sum_note->FldIsDetailKey) {
			$paymentsummary->pay_sum_note->setFormValue($objForm->GetValue("x_pay_sum_note"));
		}
		if (!$paymentsummary->flag->FldIsDetailKey) {
			$paymentsummary->flag->setFormValue($objForm->GetValue("x_flag"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $paymentsummary;
		$this->LoadRow();
		$paymentsummary->pay_sum_id->CurrentValue = $paymentsummary->pay_sum_id->FormValue;
		$paymentsummary->t_code->CurrentValue = $paymentsummary->t_code->FormValue;
		$paymentsummary->village_id->CurrentValue = $paymentsummary->village_id->FormValue;
		$paymentsummary->member_code->CurrentValue = $paymentsummary->member_code->FormValue;
		$paymentsummary->pay_sum_date->CurrentValue = $paymentsummary->pay_sum_date->FormValue;
		$paymentsummary->pay_sum_date->CurrentValue = ew_UnFormatDateTime($paymentsummary->pay_sum_date->CurrentValue, 7);
		$paymentsummary->pay_sum_type->CurrentValue = $paymentsummary->pay_sum_type->FormValue;
		$paymentsummary->pay_death_begin->CurrentValue = $paymentsummary->pay_death_begin->FormValue;
		$paymentsummary->pay_sum_adv_num->CurrentValue = $paymentsummary->pay_sum_adv_num->FormValue;
		$paymentsummary->pay_annual_year->CurrentValue = $paymentsummary->pay_annual_year->FormValue;
		$paymentsummary->pay_sum_detail->CurrentValue = $paymentsummary->pay_sum_detail->FormValue;
		$paymentsummary->pay_sum_total->CurrentValue = $paymentsummary->pay_sum_total->FormValue;
		$paymentsummary->pay_sum_note->CurrentValue = $paymentsummary->pay_sum_note->FormValue;
		$paymentsummary->flag->CurrentValue = $paymentsummary->flag->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $paymentsummary;
		$sFilter = $paymentsummary->KeyFilter();

		// Call Row Selecting event
		$paymentsummary->Row_Selecting($sFilter);

		// Load SQL based on filter
		$paymentsummary->CurrentFilter = $sFilter;
		$sSql = $paymentsummary->SQL();
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
		global $conn, $paymentsummary;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$paymentsummary->Row_Selected($row);
		$paymentsummary->pay_sum_id->setDbValue($rs->fields('pay_sum_id'));
		$paymentsummary->t_code->setDbValue($rs->fields('t_code'));
		$paymentsummary->village_id->setDbValue($rs->fields('village_id'));
		$paymentsummary->member_code->setDbValue($rs->fields('member_code'));
		$paymentsummary->pay_sum_date->setDbValue($rs->fields('pay_sum_date'));
		$paymentsummary->pay_sum_type->setDbValue($rs->fields('pay_sum_type'));
		$paymentsummary->pay_death_begin->setDbValue($rs->fields('pay_death_begin'));
		$paymentsummary->pay_sum_adv_count->setDbValue($rs->fields('pay_sum_adv_count'));
		$paymentsummary->pay_sum_adv_num->setDbValue($rs->fields('pay_sum_adv_num'));
		$paymentsummary->pay_death_end->setDbValue($rs->fields('pay_death_end'));
		$paymentsummary->pay_annual_year->setDbValue($rs->fields('pay_annual_year'));
		$paymentsummary->pay_sum_detail->setDbValue($rs->fields('pay_sum_detail'));
		$paymentsummary->pay_sum_total->setDbValue($rs->fields('pay_sum_total'));
		$paymentsummary->pay_sum_note->setDbValue($rs->fields('pay_sum_note'));
		$paymentsummary->flag->setDbValue($rs->fields('flag'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $paymentsummary;

		// Initialize URLs
		// Call Row_Rendering event

		$paymentsummary->Row_Rendering();

		// Common render codes for all row types
		// pay_sum_id
		// t_code
		// village_id
		// member_code
		// pay_sum_date
		// pay_sum_type
		// pay_death_begin
		// pay_sum_adv_count
		// pay_sum_adv_num
		// pay_death_end
		// pay_annual_year
		// pay_sum_detail
		// pay_sum_total
		// pay_sum_note
		// flag

		if ($paymentsummary->RowType == EW_ROWTYPE_VIEW) { // View row

			// pay_sum_id
			$paymentsummary->pay_sum_id->ViewValue = $paymentsummary->pay_sum_id->CurrentValue;
			$paymentsummary->pay_sum_id->ViewCustomAttributes = "";

			// t_code
			if (strval($paymentsummary->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($paymentsummary->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->t_code->ViewValue = $rswrk->fields('t_code');
					$paymentsummary->t_code->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$paymentsummary->t_code->ViewValue = $paymentsummary->t_code->CurrentValue;
				}
			} else {
				$paymentsummary->t_code->ViewValue = NULL;
			}
			$paymentsummary->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($paymentsummary->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($paymentsummary->village_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `v_code`, `v_title` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->village_id->ViewValue = $rswrk->fields('v_code');
					$paymentsummary->village_id->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$paymentsummary->village_id->ViewValue = $paymentsummary->village_id->CurrentValue;
				}
			} else {
				$paymentsummary->village_id->ViewValue = NULL;
			}
			$paymentsummary->village_id->ViewCustomAttributes = "";

			// member_code
			if (strval($paymentsummary->member_code->CurrentValue) <> "") {
				$arwrk = explode(",", $paymentsummary->member_code->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`member_code` = '" . ew_AdjustSql(trim($wrk)) . "'";
				}	
			$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` != 'เสียชีวิต' ";;
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `member_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->member_code->ViewValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$paymentsummary->member_code->ViewValue .= $rswrk->fields('member_code');
						$paymentsummary->member_code->ViewValue .= ew_ValueSeparator($ari,1,$paymentsummary->member_code) . $rswrk->fields('fname');
						$paymentsummary->member_code->ViewValue .= ew_ValueSeparator($ari,2,$paymentsummary->member_code) . $rswrk->fields('lname');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $paymentsummary->member_code->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$paymentsummary->member_code->ViewValue = $paymentsummary->member_code->CurrentValue;
				}
			} else {
				$paymentsummary->member_code->ViewValue = NULL;
			}
			$paymentsummary->member_code->ViewCustomAttributes = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->ViewValue = $paymentsummary->pay_sum_date->CurrentValue;
			$paymentsummary->pay_sum_date->ViewValue = ew_FormatDateTime($paymentsummary->pay_sum_date->ViewValue, 7);
			$paymentsummary->pay_sum_date->ViewCustomAttributes = "";

			// pay_sum_type
			if (strval($paymentsummary->pay_sum_type->CurrentValue) <> "") {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($paymentsummary->pay_sum_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_type->ViewValue = $rswrk->fields('pt_title');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_type->ViewValue = $paymentsummary->pay_sum_type->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_type->ViewValue = NULL;
			}
			$paymentsummary->pay_sum_type->ViewCustomAttributes = "";

			// pay_death_begin
			if (strval($paymentsummary->pay_death_begin->CurrentValue) <> "") {
				$sFilterWrk = "`dead_id` = " . ew_AdjustSql($paymentsummary->pay_death_begin->CurrentValue) . "";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` = 'เสียชีวิต' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `dead_id` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_death_begin->ViewValue = $rswrk->fields('dead_id');
					$paymentsummary->pay_death_begin->ViewValue .= ew_ValueSeparator(0,1,$paymentsummary->pay_death_begin) . $rswrk->fields('fname');
					$paymentsummary->pay_death_begin->ViewValue .= ew_ValueSeparator(0,2,$paymentsummary->pay_death_begin) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_death_begin->ViewValue = $paymentsummary->pay_death_begin->CurrentValue;
				}
			} else {
				$paymentsummary->pay_death_begin->ViewValue = NULL;
			}
			$paymentsummary->pay_death_begin->ViewCustomAttributes = "";

			// pay_sum_adv_num
			if (strval($paymentsummary->pay_sum_adv_num->CurrentValue) <> "") {
				$sFilterWrk = "`adv_num` = " . ew_AdjustSql($paymentsummary->pay_sum_adv_num->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `adv_num` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`adv_num` != '0'";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `adv_num`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_adv_num->ViewValue = $rswrk->fields('adv_num');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_adv_num->ViewValue = $paymentsummary->pay_sum_adv_num->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_adv_num->ViewValue = NULL;
			}
			$paymentsummary->pay_sum_adv_num->ViewCustomAttributes = "";

			// pay_annual_year
			if (strval($paymentsummary->pay_annual_year->CurrentValue) <> "") {
				$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($paymentsummary->pay_annual_year->CurrentValue) . "'";
			$sSqlWrk = "SELECT DISTINCT `cal_detail` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`cal_type` = 3";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cal_detail` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_annual_year->ViewValue = $rswrk->fields('cal_detail');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_annual_year->ViewValue = $paymentsummary->pay_annual_year->CurrentValue;
				}
			} else {
				$paymentsummary->pay_annual_year->ViewValue = NULL;
			}
			$paymentsummary->pay_annual_year->ViewCustomAttributes = "";

			// pay_sum_detail
			if (strval($paymentsummary->pay_sum_detail->CurrentValue) <> "") {
				$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($paymentsummary->pay_sum_detail->CurrentValue) . "'";
			$sSqlWrk = "SELECT DISTINCT `cal_detail` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`cal_type` = 5";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_detail->ViewValue = $rswrk->fields('cal_detail');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_detail->ViewValue = $paymentsummary->pay_sum_detail->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_detail->ViewValue = NULL;
			}
			$paymentsummary->pay_sum_detail->ViewCustomAttributes = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->ViewValue = $paymentsummary->pay_sum_total->CurrentValue;
			$paymentsummary->pay_sum_total->ViewCustomAttributes = "";

			// pay_sum_note
			$paymentsummary->pay_sum_note->ViewValue = $paymentsummary->pay_sum_note->CurrentValue;
			$paymentsummary->pay_sum_note->ViewCustomAttributes = "";

			// flag
			$paymentsummary->flag->ViewValue = $paymentsummary->flag->CurrentValue;
			$paymentsummary->flag->ViewCustomAttributes = "";

			// pay_sum_id
			$paymentsummary->pay_sum_id->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_id->HrefValue = "";
			$paymentsummary->pay_sum_id->TooltipValue = "";

			// t_code
			$paymentsummary->t_code->LinkCustomAttributes = "";
			$paymentsummary->t_code->HrefValue = "";
			$paymentsummary->t_code->TooltipValue = "";

			// village_id
			$paymentsummary->village_id->LinkCustomAttributes = "";
			$paymentsummary->village_id->HrefValue = "";
			$paymentsummary->village_id->TooltipValue = "";

			// member_code
			$paymentsummary->member_code->LinkCustomAttributes = "";
			$paymentsummary->member_code->HrefValue = "";
			$paymentsummary->member_code->TooltipValue = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_date->HrefValue = "";
			$paymentsummary->pay_sum_date->TooltipValue = "";

			// pay_sum_type
			$paymentsummary->pay_sum_type->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_type->HrefValue = "";
			$paymentsummary->pay_sum_type->TooltipValue = "";

			// pay_death_begin
			$paymentsummary->pay_death_begin->LinkCustomAttributes = "";
			$paymentsummary->pay_death_begin->HrefValue = "";
			$paymentsummary->pay_death_begin->TooltipValue = "";

			// pay_sum_adv_num
			$paymentsummary->pay_sum_adv_num->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_adv_num->HrefValue = "";
			$paymentsummary->pay_sum_adv_num->TooltipValue = "";

			// pay_annual_year
			$paymentsummary->pay_annual_year->LinkCustomAttributes = "";
			$paymentsummary->pay_annual_year->HrefValue = "";
			$paymentsummary->pay_annual_year->TooltipValue = "";

			// pay_sum_detail
			$paymentsummary->pay_sum_detail->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_detail->HrefValue = "";
			$paymentsummary->pay_sum_detail->TooltipValue = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_total->HrefValue = "";
			$paymentsummary->pay_sum_total->TooltipValue = "";

			// pay_sum_note
			$paymentsummary->pay_sum_note->LinkCustomAttributes = "";
			$paymentsummary->pay_sum_note->HrefValue = "";
			$paymentsummary->pay_sum_note->TooltipValue = "";

			// flag
			$paymentsummary->flag->LinkCustomAttributes = "";
			$paymentsummary->flag->HrefValue = "";
			$paymentsummary->flag->TooltipValue = "";
		} elseif ($paymentsummary->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// pay_sum_id
			$paymentsummary->pay_sum_id->EditCustomAttributes = "";
			$paymentsummary->pay_sum_id->EditValue = $paymentsummary->pay_sum_id->CurrentValue;
			$paymentsummary->pay_sum_id->ViewCustomAttributes = "";

			// t_code
			$paymentsummary->t_code->EditCustomAttributes = "";
			if (strval($paymentsummary->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($paymentsummary->t_code->CurrentValue) . "'";
			$sSqlWrk = "SELECT `t_code`, `t_title` FROM `tambon`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `t_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->t_code->EditValue = $rswrk->fields('t_code');
					$paymentsummary->t_code->EditValue .= ew_ValueSeparator(0,1,$paymentsummary->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$paymentsummary->t_code->EditValue = $paymentsummary->t_code->CurrentValue;
				}
			} else {
				$paymentsummary->t_code->EditValue = NULL;
			}
			$paymentsummary->t_code->ViewCustomAttributes = "";

			// village_id
			$paymentsummary->village_id->EditCustomAttributes = "";
			if (strval($paymentsummary->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($paymentsummary->village_id->CurrentValue) . "";
			$sSqlWrk = "SELECT `v_code`, `v_title` FROM `village`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `v_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->village_id->EditValue = $rswrk->fields('v_code');
					$paymentsummary->village_id->EditValue .= ew_ValueSeparator(0,1,$paymentsummary->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$paymentsummary->village_id->EditValue = $paymentsummary->village_id->CurrentValue;
				}
			} else {
				$paymentsummary->village_id->EditValue = NULL;
			}
			$paymentsummary->village_id->ViewCustomAttributes = "";

			// member_code
			$paymentsummary->member_code->EditCustomAttributes = "";
			if (strval($paymentsummary->member_code->CurrentValue) <> "") {
				$arwrk = explode(",", $paymentsummary->member_code->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`member_code` = '" . ew_AdjustSql(trim($wrk)) . "'";
				}	
			$sSqlWrk = "SELECT `member_code`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` != 'เสียชีวิต' ";;
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `member_code`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->member_code->EditValue = "";
					$ari = 0;
					while (!$rswrk->EOF) {
						$paymentsummary->member_code->EditValue .= $rswrk->fields('member_code');
						$paymentsummary->member_code->EditValue .= ew_ValueSeparator($ari,1,$paymentsummary->member_code) . $rswrk->fields('fname');
						$paymentsummary->member_code->EditValue .= ew_ValueSeparator($ari,2,$paymentsummary->member_code) . $rswrk->fields('lname');
						$rswrk->MoveNext();
						if (!$rswrk->EOF) $paymentsummary->member_code->EditValue .= ew_ViewOptionSeparator($ari); // Separate Options
						$ari++;
					}
					$rswrk->Close();
				} else {
					$paymentsummary->member_code->EditValue = $paymentsummary->member_code->CurrentValue;
				}
			} else {
				$paymentsummary->member_code->EditValue = NULL;
			}
			$paymentsummary->member_code->ViewCustomAttributes = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->EditCustomAttributes = "";
			$paymentsummary->pay_sum_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($paymentsummary->pay_sum_date->CurrentValue, 7));

			// pay_sum_type
			$paymentsummary->pay_sum_type->EditCustomAttributes = 'onchange=showfield(this.options[this.selectedIndex].value);';
			if (strval($paymentsummary->pay_sum_type->CurrentValue) <> "") {
				$sFilterWrk = "`pt_id` = " . ew_AdjustSql($paymentsummary->pay_sum_type->CurrentValue) . "";
			$sSqlWrk = "SELECT `pt_title` FROM `paymenttype`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_type->EditValue = $rswrk->fields('pt_title');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_type->EditValue = $paymentsummary->pay_sum_type->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_type->EditValue = NULL;
			}
			$paymentsummary->pay_sum_type->ViewCustomAttributes = "";

			// pay_death_begin
			$paymentsummary->pay_death_begin->EditCustomAttributes = "";
			if (strval($paymentsummary->pay_death_begin->CurrentValue) <> "") {
				$sFilterWrk = "`dead_id` = " . ew_AdjustSql($paymentsummary->pay_death_begin->CurrentValue) . "";
			$sSqlWrk = "SELECT `dead_id`, `fname`, `lname` FROM `members`";
			$sWhereWrk = "";
			$lookuptblfilter = "`member_status` = 'เสียชีวิต' ";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `dead_id` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_death_begin->EditValue = $rswrk->fields('dead_id');
					$paymentsummary->pay_death_begin->EditValue .= ew_ValueSeparator(0,1,$paymentsummary->pay_death_begin) . $rswrk->fields('fname');
					$paymentsummary->pay_death_begin->EditValue .= ew_ValueSeparator(0,2,$paymentsummary->pay_death_begin) . $rswrk->fields('lname');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_death_begin->EditValue = $paymentsummary->pay_death_begin->CurrentValue;
				}
			} else {
				$paymentsummary->pay_death_begin->EditValue = NULL;
			}
			$paymentsummary->pay_death_begin->ViewCustomAttributes = "";

			// pay_sum_adv_num
			$paymentsummary->pay_sum_adv_num->EditCustomAttributes = "";
			if (strval($paymentsummary->pay_sum_adv_num->CurrentValue) <> "") {
				$sFilterWrk = "`adv_num` = " . ew_AdjustSql($paymentsummary->pay_sum_adv_num->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `adv_num` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`adv_num` != '0'";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `adv_num`";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_adv_num->EditValue = $rswrk->fields('adv_num');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_adv_num->EditValue = $paymentsummary->pay_sum_adv_num->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_adv_num->EditValue = NULL;
			}
			$paymentsummary->pay_sum_adv_num->ViewCustomAttributes = "";

			// pay_annual_year
			$paymentsummary->pay_annual_year->EditCustomAttributes = "";
			if (strval($paymentsummary->pay_annual_year->CurrentValue) <> "") {
				$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($paymentsummary->pay_annual_year->CurrentValue) . "'";
			$sSqlWrk = "SELECT DISTINCT `cal_detail` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`cal_type` = 3";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `cal_detail` Desc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_annual_year->EditValue = $rswrk->fields('cal_detail');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_annual_year->EditValue = $paymentsummary->pay_annual_year->CurrentValue;
				}
			} else {
				$paymentsummary->pay_annual_year->EditValue = NULL;
			}
			$paymentsummary->pay_annual_year->ViewCustomAttributes = "";

			// pay_sum_detail
			$paymentsummary->pay_sum_detail->EditCustomAttributes = "";
			if (strval($paymentsummary->pay_sum_detail->CurrentValue) <> "") {
				$sFilterWrk = "`cal_detail` = '" . ew_AdjustSql($paymentsummary->pay_sum_detail->CurrentValue) . "'";
			$sSqlWrk = "SELECT DISTINCT `cal_detail` FROM `subvcalculate`";
			$sWhereWrk = "";
			$lookuptblfilter = "`cal_type` = 5";
			if (strval($lookuptblfilter) <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $lookuptblfilter . ")";
			}
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$paymentsummary->pay_sum_detail->EditValue = $rswrk->fields('cal_detail');
					$rswrk->Close();
				} else {
					$paymentsummary->pay_sum_detail->EditValue = $paymentsummary->pay_sum_detail->CurrentValue;
				}
			} else {
				$paymentsummary->pay_sum_detail->EditValue = NULL;
			}
			$paymentsummary->pay_sum_detail->ViewCustomAttributes = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->EditCustomAttributes = "";
			$paymentsummary->pay_sum_total->EditValue = $paymentsummary->pay_sum_total->CurrentValue;
			$paymentsummary->pay_sum_total->ViewCustomAttributes = "";

			// pay_sum_note
			$paymentsummary->pay_sum_note->EditCustomAttributes = "";
			$paymentsummary->pay_sum_note->EditValue = ew_HtmlEncode($paymentsummary->pay_sum_note->CurrentValue);

			// flag
			$paymentsummary->flag->EditCustomAttributes = "";
			if ($paymentsummary->flag->getSessionValue() <> "") {
				$paymentsummary->flag->CurrentValue = $paymentsummary->flag->getSessionValue();
			$paymentsummary->flag->ViewValue = $paymentsummary->flag->CurrentValue;
			$paymentsummary->flag->ViewCustomAttributes = "";
			} else {
			}

			// Edit refer script
			// pay_sum_id

			$paymentsummary->pay_sum_id->HrefValue = "";

			// t_code
			$paymentsummary->t_code->HrefValue = "";

			// village_id
			$paymentsummary->village_id->HrefValue = "";

			// member_code
			$paymentsummary->member_code->HrefValue = "";

			// pay_sum_date
			$paymentsummary->pay_sum_date->HrefValue = "";

			// pay_sum_type
			$paymentsummary->pay_sum_type->HrefValue = "";

			// pay_death_begin
			$paymentsummary->pay_death_begin->HrefValue = "";

			// pay_sum_adv_num
			$paymentsummary->pay_sum_adv_num->HrefValue = "";

			// pay_annual_year
			$paymentsummary->pay_annual_year->HrefValue = "";

			// pay_sum_detail
			$paymentsummary->pay_sum_detail->HrefValue = "";

			// pay_sum_total
			$paymentsummary->pay_sum_total->HrefValue = "";

			// pay_sum_note
			$paymentsummary->pay_sum_note->HrefValue = "";

			// flag
			$paymentsummary->flag->HrefValue = "";
		}
		if ($paymentsummary->RowType == EW_ROWTYPE_ADD ||
			$paymentsummary->RowType == EW_ROWTYPE_EDIT ||
			$paymentsummary->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$paymentsummary->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($paymentsummary->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$paymentsummary->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $paymentsummary;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($paymentsummary->pay_sum_date->FormValue) && $paymentsummary->pay_sum_date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $paymentsummary->pay_sum_date->FldCaption());
		}
		if (!ew_CheckEuroDate($paymentsummary->pay_sum_date->FormValue)) {
			ew_AddMessage($gsFormError, $paymentsummary->pay_sum_date->FldErrMsg());
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
		global $conn, $Security, $Language, $paymentsummary;
		$sFilter = $paymentsummary->KeyFilter();
		$paymentsummary->CurrentFilter = $sFilter;
		$sSql = $paymentsummary->SQL();
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

			// pay_sum_date
			$paymentsummary->pay_sum_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($paymentsummary->pay_sum_date->CurrentValue, 7), NULL, $paymentsummary->pay_sum_date->ReadOnly);

			// pay_sum_note
			$paymentsummary->pay_sum_note->SetDbValueDef($rsnew, $paymentsummary->pay_sum_note->CurrentValue, NULL, $paymentsummary->pay_sum_note->ReadOnly);

			// flag
			$paymentsummary->flag->SetDbValueDef($rsnew, $paymentsummary->flag->CurrentValue, 0, $paymentsummary->flag->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $paymentsummary->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($paymentsummary->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($paymentsummary->CancelMessage <> "") {
					$this->setFailureMessage($paymentsummary->CancelMessage);
					$paymentsummary->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$paymentsummary->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		global $paymentsummary;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "village") {
				$bValidMaster = TRUE;
				if (@$_GET["village_id"] <> "") {
					$GLOBALS["village"]->village_id->setQueryStringValue($_GET["village_id"]);
					$paymentsummary->village_id->setQueryStringValue($GLOBALS["village"]->village_id->QueryStringValue);
					$paymentsummary->village_id->setSessionValue($paymentsummary->village_id->QueryStringValue);
					if (!is_numeric($GLOBALS["village"]->village_id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
				if (@$_GET["t_code"] <> "") {
					$GLOBALS["village"]->t_code->setQueryStringValue($_GET["t_code"]);
					$paymentsummary->t_code->setQueryStringValue($GLOBALS["village"]->t_code->QueryStringValue);
					$paymentsummary->t_code->setSessionValue($paymentsummary->t_code->QueryStringValue);
				} else {
					$bValidMaster = FALSE;
				}
				if (@$_GET["flag"] <> "") {
					$GLOBALS["village"]->flag->setQueryStringValue($_GET["flag"]);
					$paymentsummary->flag->setQueryStringValue($GLOBALS["village"]->flag->QueryStringValue);
					$paymentsummary->flag->setSessionValue($paymentsummary->flag->QueryStringValue);
					if (!is_numeric($GLOBALS["village"]->flag->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$paymentsummary->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$paymentsummary->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "village") {
				if ($paymentsummary->village_id->QueryStringValue == "") $paymentsummary->village_id->setSessionValue("");
				if ($paymentsummary->t_code->QueryStringValue == "") $paymentsummary->t_code->setSessionValue("");
				if ($paymentsummary->flag->QueryStringValue == "") $paymentsummary->flag->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $paymentsummary->getMasterFilter(); //  Get master filter
		$this->DbDetailFilter = $paymentsummary->getDetailFilter(); // Get detail filter
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
