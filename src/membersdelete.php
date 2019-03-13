<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "membersinfo.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$members_delete = new cmembers_delete();
$Page =& $members_delete;

// Page init
$members_delete->Page_Init();

// Page main
$members_delete->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var members_delete = new ew_Page("members_delete");

// page properties
members_delete.PageID = "delete"; // page ID
members_delete.FormID = "fmembersdelete"; // form ID
var EW_PAGE_ID = members_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
members_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
members_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
members_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
members_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
members_delete.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
members_delete.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php

// Load records for display
if ($members_delete->Recordset = $members_delete->LoadRecordset())
	$members_deleteTotalRecs = $members_delete->Recordset->RecordCount(); // Get record count
if ($members_deleteTotalRecs <= 0) { // No record found, exit
	if ($members_delete->Recordset)
		$members_delete->Recordset->Close();
	$members_delete->Page_Terminate("memberslist.php"); // Return to list
}
?>
<div class="phpmaker ewTitle"><img src="images/ico_delete_member.png" width="40" height="40" align="absmiddle" />&nbsp;<?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $members->TableCaption() ?></div>
<div class="clear"></div>
<?php $members_delete->ShowPageHeader(); ?>
<?php
$members_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="members">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($members_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $members->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $members->member_code->FldCaption() ?></td>
		<td valign="top"><?php echo $members->id_code->FldCaption() ?></td>
		<td valign="top"><?php echo $members->prefix->FldCaption() ?></td>
		<td valign="top"><?php echo $members->gender->FldCaption() ?></td>
		<td valign="top"><?php echo $members->fname->FldCaption() ?></td>
		<td valign="top"><?php echo $members->lname->FldCaption() ?></td>
		<td valign="top"><?php echo $members->birthdate->FldCaption() ?></td>
		<td valign="top"><?php echo $members->age->FldCaption() ?></td>
		<td valign="top"><?php echo $members->t_code->FldCaption() ?></td>
		<td valign="top"><?php echo $members->village_id->FldCaption() ?></td>
		<td valign="top"><?php echo $members->bnfc1_name->FldCaption() ?></td>
		<td valign="top"><?php echo $members->bnfc1_rel->FldCaption() ?></td>
		<td valign="top"><?php echo $members->bnfc2_name->FldCaption() ?></td>
		<td valign="top"><?php echo $members->bnfc2_rel->FldCaption() ?></td>
		<td valign="top"><?php echo $members->bnfc3_name->FldCaption() ?></td>
		<td valign="top"><?php echo $members->bnfc3_rel->FldCaption() ?></td>
		<td valign="top"><?php echo $members->regis_date->FldCaption() ?></td>
		<td valign="top"><?php echo $members->effective_date->FldCaption() ?></td>
		<td valign="top"><?php echo $members->member_status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$members_delete->RecCnt = 0;
$i = 0;
while (!$members_delete->Recordset->EOF) {
	$members_delete->RecCnt++;

	// Set row properties
	$members->ResetAttrs();
	$members->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$members_delete->LoadRowValues($members_delete->Recordset);

	// Render row
	$members_delete->RenderRow();
?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td<?php echo $members->member_code->CellAttributes() ?>>
<div<?php echo $members->member_code->ViewAttributes() ?>><?php echo $members->member_code->ListViewValue() ?></div></td>
		<td<?php echo $members->id_code->CellAttributes() ?>>
<div<?php echo $members->id_code->ViewAttributes() ?>><?php echo $members->id_code->ListViewValue() ?></div></td>
		<td<?php echo $members->prefix->CellAttributes() ?>>
<div<?php echo $members->prefix->ViewAttributes() ?>><?php echo $members->prefix->ListViewValue() ?></div></td>
		<td<?php echo $members->gender->CellAttributes() ?>>
<div<?php echo $members->gender->ViewAttributes() ?>><?php echo $members->gender->ListViewValue() ?></div></td>
		<td<?php echo $members->fname->CellAttributes() ?>>
<div<?php echo $members->fname->ViewAttributes() ?>><?php echo $members->fname->ListViewValue() ?></div></td>
		<td<?php echo $members->lname->CellAttributes() ?>>
<div<?php echo $members->lname->ViewAttributes() ?>><?php echo $members->lname->ListViewValue() ?></div></td>
		<td<?php echo $members->birthdate->CellAttributes() ?>>
<div<?php echo $members->birthdate->ViewAttributes() ?>><?php echo $members->birthdate->ListViewValue() ?></div></td>
		<td<?php echo $members->age->CellAttributes() ?>>
<div<?php echo $members->age->ViewAttributes() ?>><?php echo $members->age->ListViewValue() ?></div></td>
		<td<?php echo $members->t_code->CellAttributes() ?>>
<div<?php echo $members->t_code->ViewAttributes() ?>><?php echo $members->t_code->ListViewValue() ?></div></td>
		<td<?php echo $members->village_id->CellAttributes() ?>>
<div<?php echo $members->village_id->ViewAttributes() ?>><?php echo $members->village_id->ListViewValue() ?></div></td>
		<td<?php echo $members->bnfc1_name->CellAttributes() ?>>
<div<?php echo $members->bnfc1_name->ViewAttributes() ?>><?php echo $members->bnfc1_name->ListViewValue() ?></div></td>
		<td<?php echo $members->bnfc1_rel->CellAttributes() ?>>
<div<?php echo $members->bnfc1_rel->ViewAttributes() ?>><?php echo $members->bnfc1_rel->ListViewValue() ?></div></td>
		<td<?php echo $members->bnfc2_name->CellAttributes() ?>>
<div<?php echo $members->bnfc2_name->ViewAttributes() ?>><?php echo $members->bnfc2_name->ListViewValue() ?></div></td>
		<td<?php echo $members->bnfc2_rel->CellAttributes() ?>>
<div<?php echo $members->bnfc2_rel->ViewAttributes() ?>><?php echo $members->bnfc2_rel->ListViewValue() ?></div></td>
		<td<?php echo $members->bnfc3_name->CellAttributes() ?>>
<div<?php echo $members->bnfc3_name->ViewAttributes() ?>><?php echo $members->bnfc3_name->ListViewValue() ?></div></td>
		<td<?php echo $members->bnfc3_rel->CellAttributes() ?>>
<div<?php echo $members->bnfc3_rel->ViewAttributes() ?>><?php echo $members->bnfc3_rel->ListViewValue() ?></div></td>
		<td<?php echo $members->regis_date->CellAttributes() ?>>
<div<?php echo $members->regis_date->ViewAttributes() ?>><?php echo $members->regis_date->ListViewValue() ?></div></td>
		<td<?php echo $members->effective_date->CellAttributes() ?>>
<div<?php echo $members->effective_date->ViewAttributes() ?>><?php echo $members->effective_date->ListViewValue() ?></div></td>
		<td<?php echo $members->member_status->CellAttributes() ?>>
<div<?php echo $members->member_status->ViewAttributes() ?>><?php echo $members->member_status->ListViewValue() ?></div></td>
	</tr>
<?php
	$members_delete->Recordset->MoveNext();
}
$members_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<a href="<?php echo $members->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a>&nbsp;&nbsp;<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<?php
$members_delete->ShowPageFooter();
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
$members_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmembers_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'members';

	// Page object name
	var $PageObjName = 'members_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $members;
		if ($members->UseTokenInUrl) $PageUrl .= "t=" . $members->TableVar . "&"; // Add page token
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
		global $objForm, $members;
		if ($members->UseTokenInUrl) {
			if ($objForm)
				return ($members->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($members->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmembers_delete() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (members)
		if (!isset($GLOBALS["members"])) {
			$GLOBALS["members"] = new cmembers();
			$GLOBALS["Table"] =& $GLOBALS["members"];
		}

		// Table object (administrator)
		if (!isset($GLOBALS['administrator'])) $GLOBALS['administrator'] = new cadministrator();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'members', TRUE);

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
		global $members;

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
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $members;

		// Load key parameters
		$this->RecKeys = $members->GetRecordKeys(); // Load record keys
		$sFilter = $members->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("memberslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in members class, membersinfo.php

		$members->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$members->CurrentAction = $_POST["a_delete"];
		} else {
			$members->CurrentAction = "I"; // Display record
		}
		switch ($members->CurrentAction) {
			case "D": // Delete
				$members->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($members->getReturnUrl()); // Return to caller
				}
		}
	}

// No functions
	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $members;

		// Call Recordset Selecting event
		$members->Recordset_Selecting($members->CurrentFilter);

		// Load List page SQL
		$sSql = $members->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$members->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $members;
		$sFilter = $members->KeyFilter();

		// Call Row Selecting event
		$members->Row_Selecting($sFilter);

		// Load SQL based on filter
		$members->CurrentFilter = $sFilter;
		$sSql = $members->SQL();
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
		global $conn, $members;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row =& $rs->fields;
		$members->Row_Selected($row);
		$members->member_id->setDbValue($rs->fields('member_id'));
		$members->member_code->setDbValue($rs->fields('member_code'));
		$members->id_code->setDbValue($rs->fields('id_code'));
		$members->prefix->setDbValue($rs->fields('prefix'));
		$members->gender->setDbValue($rs->fields('gender'));
		$members->fname->setDbValue($rs->fields('fname'));
		$members->lname->setDbValue($rs->fields('lname'));
		$members->birthdate->setDbValue($rs->fields('birthdate'));
		$members->age->setDbValue($rs->fields('age'));
		$members->zemail->setDbValue($rs->fields('email'));
		$members->address->setDbValue($rs->fields('address'));
		$members->t_code->setDbValue($rs->fields('t_code'));
		$members->village_id->setDbValue($rs->fields('village_id'));
		$members->phone->setDbValue($rs->fields('phone'));
		$members->suffix->Upload->DbValue = $rs->fields('suffix');
		$members->bnfc1_name->setDbValue($rs->fields('bnfc1_name'));
		$members->bnfc1_rel->setDbValue($rs->fields('bnfc1_rel'));
		$members->bnfc2_name->setDbValue($rs->fields('bnfc2_name'));
		$members->bnfc2_rel->setDbValue($rs->fields('bnfc2_rel'));
		$members->bnfc3_name->setDbValue($rs->fields('bnfc3_name'));
		$members->bnfc3_rel->setDbValue($rs->fields('bnfc3_rel'));
		$members->bnfc4_name->setDbValue($rs->fields('bnfc4_name'));
		$members->bnfc4_rel->setDbValue($rs->fields('bnfc4_rel'));
		$members->regis_date->setDbValue($rs->fields('regis_date'));
		$members->effective_date->setDbValue($rs->fields('effective_date'));
		$members->attachment->setDbValue($rs->fields('attachment'));
		$members->member_status->setDbValue($rs->fields('member_status'));
		$members->resign_date->setDbValue($rs->fields('resign_date'));
		$members->dead_date->setDbValue($rs->fields('dead_date'));
		$members->terminate_date->setDbValue($rs->fields('terminate_date'));
		$members->advance_budget->setDbValue($rs->fields('advance_budget'));
		$members->dead_id->setDbValue($rs->fields('dead_id'));
		$members->note->setDbValue($rs->fields('note'));
		$members->update_detail->setDbValue($rs->fields('update_detail'));
		$members->member_type->setDbValue($rs->fields('member_type'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $members;

		// Initialize URLs
		// Call Row_Rendering event

		$members->Row_Rendering();

		// Common render codes for all row types
		// member_id

		$members->member_id->CellCssStyle = "white-space: nowrap;";

		// member_code
		// id_code
		// prefix
		// gender
		// fname

		$members->fname->CellCssStyle = "white-space: nowrap;";

		// lname
		$members->lname->CellCssStyle = "white-space: nowrap;";

		// birthdate
		// age
		// email

		$members->zemail->CellCssStyle = "white-space: nowrap;";

		// address
		// t_code

		$members->t_code->CellCssStyle = "white-space: nowrap;";

		// village_id
		$members->village_id->CellCssStyle = "white-space: nowrap;";

		// phone
		// suffix

		$members->suffix->CellCssStyle = "white-space: nowrap;";

		// bnfc1_name
		$members->bnfc1_name->CellCssStyle = "white-space: nowrap;";

		// bnfc1_rel
		$members->bnfc1_rel->CellCssStyle = "white-space: nowrap;";

		// bnfc2_name
		$members->bnfc2_name->CellCssStyle = "white-space: nowrap;";

		// bnfc2_rel
		$members->bnfc2_rel->CellCssStyle = "white-space: nowrap;";

		// bnfc3_name
		$members->bnfc3_name->CellCssStyle = "white-space: nowrap;";

		// bnfc3_rel
		$members->bnfc3_rel->CellCssStyle = "white-space: nowrap;";

		// bnfc4_name
		$members->bnfc4_name->CellCssStyle = "white-space: nowrap;";

		// bnfc4_rel
		$members->bnfc4_rel->CellCssStyle = "white-space: nowrap;";

		// regis_date
		// effective_date
		// attachment

		$members->attachment->CellCssStyle = "white-space: nowrap;";

		// member_status
		$members->member_status->CellCssStyle = "white-space: nowrap;";

		// resign_date
		$members->resign_date->CellCssStyle = "white-space: nowrap;";

		// dead_date
		$members->dead_date->CellCssStyle = "white-space: nowrap;";

		// terminate_date
		$members->terminate_date->CellCssStyle = "white-space: nowrap;";

		// advance_budget
		$members->advance_budget->CellCssStyle = "white-space: nowrap;";

		// dead_id
		$members->dead_id->CellCssStyle = "white-space: nowrap;";

		// note
		// update_detail

		$members->update_detail->CellCssStyle = "white-space: nowrap;";

		// member_type
		$members->member_type->CellCssStyle = "white-space: nowrap;";
		if ($members->RowType == EW_ROWTYPE_VIEW) { // View row

			// member_code
			$members->member_code->ViewValue = $members->member_code->CurrentValue;
			$members->member_code->ViewCustomAttributes = "";

			// id_code
			$members->id_code->ViewValue = $members->id_code->CurrentValue;
			$members->id_code->ViewCustomAttributes = "";

			// prefix
			if (strval($members->prefix->CurrentValue) <> "") {
				$sFilterWrk = "`p_title` = '" . ew_AdjustSql($members->prefix->CurrentValue) . "'";
			$sSqlWrk = "SELECT `p_title` FROM `prefix`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->prefix->ViewValue = $rswrk->fields('p_title');
					$rswrk->Close();
				} else {
					$members->prefix->ViewValue = $members->prefix->CurrentValue;
				}
			} else {
				$members->prefix->ViewValue = NULL;
			}
			$members->prefix->ViewCustomAttributes = "";

			// gender
			if (strval($members->gender->CurrentValue) <> "") {
				$sFilterWrk = "`g_title` = '" . ew_AdjustSql($members->gender->CurrentValue) . "'";
			$sSqlWrk = "SELECT `g_title` FROM `gender`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->gender->ViewValue = $rswrk->fields('g_title');
					$rswrk->Close();
				} else {
					$members->gender->ViewValue = $members->gender->CurrentValue;
				}
			} else {
				$members->gender->ViewValue = NULL;
			}
			$members->gender->ViewCustomAttributes = "";

			// fname
			$members->fname->ViewValue = $members->fname->CurrentValue;
			$members->fname->ViewCustomAttributes = "";

			// lname
			$members->lname->ViewValue = $members->lname->CurrentValue;
			$members->lname->ViewCustomAttributes = "";

			// birthdate
			$members->birthdate->ViewValue = $members->birthdate->CurrentValue;
			$members->birthdate->ViewValue = ew_FormatDateTime($members->birthdate->ViewValue, 7);
			$members->birthdate->ViewCustomAttributes = "";

			// age
			$members->age->ViewValue = $members->age->CurrentValue;
			$members->age->ViewCustomAttributes = "";

			// address
			$members->address->ViewValue = $members->address->CurrentValue;
			$members->address->ViewCustomAttributes = "";

			// t_code
			if (strval($members->t_code->CurrentValue) <> "") {
				$sFilterWrk = "`t_code` = '" . ew_AdjustSql($members->t_code->CurrentValue) . "'";
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
					$members->t_code->ViewValue = $rswrk->fields('t_code');
					$members->t_code->ViewValue .= ew_ValueSeparator(0,1,$members->t_code) . $rswrk->fields('t_title');
					$rswrk->Close();
				} else {
					$members->t_code->ViewValue = $members->t_code->CurrentValue;
				}
			} else {
				$members->t_code->ViewValue = NULL;
			}
			$members->t_code->ViewCustomAttributes = "";

			// village_id
			if (strval($members->village_id->CurrentValue) <> "") {
				$sFilterWrk = "`village_id` = " . ew_AdjustSql($members->village_id->CurrentValue) . "";
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
					$members->village_id->ViewValue = $rswrk->fields('v_code');
					$members->village_id->ViewValue .= ew_ValueSeparator(0,1,$members->village_id) . $rswrk->fields('v_title');
					$rswrk->Close();
				} else {
					$members->village_id->ViewValue = $members->village_id->CurrentValue;
				}
			} else {
				$members->village_id->ViewValue = NULL;
			}
			$members->village_id->ViewCustomAttributes = "";

			// phone
			$members->phone->ViewValue = $members->phone->CurrentValue;
			$members->phone->ViewCustomAttributes = "";

			// bnfc1_name
			$members->bnfc1_name->ViewValue = $members->bnfc1_name->CurrentValue;
			$members->bnfc1_name->ViewCustomAttributes = "";

			// bnfc1_rel
			$members->bnfc1_rel->ViewValue = $members->bnfc1_rel->CurrentValue;
			$members->bnfc1_rel->ViewCustomAttributes = "";

			// bnfc2_name
			$members->bnfc2_name->ViewValue = $members->bnfc2_name->CurrentValue;
			$members->bnfc2_name->ViewCustomAttributes = "";

			// bnfc2_rel
			$members->bnfc2_rel->ViewValue = $members->bnfc2_rel->CurrentValue;
			$members->bnfc2_rel->ViewCustomAttributes = "";

			// bnfc3_name
			$members->bnfc3_name->ViewValue = $members->bnfc3_name->CurrentValue;
			$members->bnfc3_name->ViewCustomAttributes = "";

			// bnfc3_rel
			$members->bnfc3_rel->ViewValue = $members->bnfc3_rel->CurrentValue;
			$members->bnfc3_rel->ViewCustomAttributes = "";

			// regis_date
			$members->regis_date->ViewValue = $members->regis_date->CurrentValue;
			$members->regis_date->ViewValue = ew_FormatDateTime($members->regis_date->ViewValue, 7);
			$members->regis_date->ViewCustomAttributes = "";

			// effective_date
			$members->effective_date->ViewValue = $members->effective_date->CurrentValue;
			$members->effective_date->ViewValue = ew_FormatDateTime($members->effective_date->ViewValue, 7);
			$members->effective_date->ViewCustomAttributes = "";

			// attachment
			$members->attachment->ViewValue = $members->attachment->CurrentValue;
			$members->attachment->ViewCustomAttributes = "";

			// member_status
			if (strval($members->member_status->CurrentValue) <> "") {
				$sFilterWrk = "`s_title` = '" . ew_AdjustSql($members->member_status->CurrentValue) . "'";
			$sSqlWrk = "SELECT `s_title` FROM `memberstatus`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$members->member_status->ViewValue = $rswrk->fields('s_title');
					$rswrk->Close();
				} else {
					$members->member_status->ViewValue = $members->member_status->CurrentValue;
				}
			} else {
				$members->member_status->ViewValue = NULL;
			}
			$members->member_status->ViewCustomAttributes = "";

			// resign_date
			$members->resign_date->ViewValue = $members->resign_date->CurrentValue;
			$members->resign_date->ViewValue = ew_FormatDateTime($members->resign_date->ViewValue, 7);
			$members->resign_date->ViewCustomAttributes = "";

			// dead_date
			$members->dead_date->ViewValue = $members->dead_date->CurrentValue;
			$members->dead_date->ViewValue = ew_FormatDateTime($members->dead_date->ViewValue, 7);
			$members->dead_date->ViewCustomAttributes = "";

			// terminate_date
			$members->terminate_date->ViewValue = $members->terminate_date->CurrentValue;
			$members->terminate_date->ViewValue = ew_FormatDateTime($members->terminate_date->ViewValue, 7);
			$members->terminate_date->ViewCustomAttributes = "";

			// member_code
			$members->member_code->LinkCustomAttributes = "";
			$members->member_code->HrefValue = "";
			$members->member_code->TooltipValue = "";

			// id_code
			$members->id_code->LinkCustomAttributes = "";
			$members->id_code->HrefValue = "";
			$members->id_code->TooltipValue = "";

			// prefix
			$members->prefix->LinkCustomAttributes = "";
			$members->prefix->HrefValue = "";
			$members->prefix->TooltipValue = "";

			// gender
			$members->gender->LinkCustomAttributes = "";
			$members->gender->HrefValue = "";
			$members->gender->TooltipValue = "";

			// fname
			$members->fname->LinkCustomAttributes = "";
			$members->fname->HrefValue = "";
			$members->fname->TooltipValue = "";

			// lname
			$members->lname->LinkCustomAttributes = "";
			$members->lname->HrefValue = "";
			$members->lname->TooltipValue = "";

			// birthdate
			$members->birthdate->LinkCustomAttributes = "";
			$members->birthdate->HrefValue = "";
			$members->birthdate->TooltipValue = "";

			// age
			$members->age->LinkCustomAttributes = "";
			$members->age->HrefValue = "";
			$members->age->TooltipValue = "";

			// t_code
			$members->t_code->LinkCustomAttributes = "";
			$members->t_code->HrefValue = "";
			$members->t_code->TooltipValue = "";

			// village_id
			$members->village_id->LinkCustomAttributes = "";
			$members->village_id->HrefValue = "";
			$members->village_id->TooltipValue = "";

			// bnfc1_name
			$members->bnfc1_name->LinkCustomAttributes = "";
			$members->bnfc1_name->HrefValue = "";
			$members->bnfc1_name->TooltipValue = "";

			// bnfc1_rel
			$members->bnfc1_rel->LinkCustomAttributes = "";
			$members->bnfc1_rel->HrefValue = "";
			$members->bnfc1_rel->TooltipValue = "";

			// bnfc2_name
			$members->bnfc2_name->LinkCustomAttributes = "";
			$members->bnfc2_name->HrefValue = "";
			$members->bnfc2_name->TooltipValue = "";

			// bnfc2_rel
			$members->bnfc2_rel->LinkCustomAttributes = "";
			$members->bnfc2_rel->HrefValue = "";
			$members->bnfc2_rel->TooltipValue = "";

			// bnfc3_name
			$members->bnfc3_name->LinkCustomAttributes = "";
			$members->bnfc3_name->HrefValue = "";
			$members->bnfc3_name->TooltipValue = "";

			// bnfc3_rel
			$members->bnfc3_rel->LinkCustomAttributes = "";
			$members->bnfc3_rel->HrefValue = "";
			$members->bnfc3_rel->TooltipValue = "";

			// regis_date
			$members->regis_date->LinkCustomAttributes = "";
			$members->regis_date->HrefValue = "";
			$members->regis_date->TooltipValue = "";

			// effective_date
			$members->effective_date->LinkCustomAttributes = "";
			$members->effective_date->HrefValue = "";
			$members->effective_date->TooltipValue = "";

			// member_status
			$members->member_status->LinkCustomAttributes = "";
			$members->member_status->HrefValue = "";
			$members->member_status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($members->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$members->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $members;
		$DeleteRows = TRUE;
		$sSql = $members->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $members->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['member_id'];
				@unlink(ew_UploadPathEx(TRUE, $members->suffix->UploadPath) . $row['suffix']);
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($members->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($members->CancelMessage <> "") {
				$this->setFailureMessage($members->CancelMessage);
				$members->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$members->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
}
?>
