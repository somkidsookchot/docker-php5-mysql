<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "administratorinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$creportmemberperiod = new creportmemberperiod();
$Page =& $creportmemberperiod;

// Page init
$creportmemberperiod->Page_Init();

// Page main
$creportmemberperiod->Page_Main();
if (isset($_GET['xprint'])) $xprint = $_GET["xprint"];
?>
<?php 
if ($xprint != 1){
include_once "header.php";
}
?>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>

<script type="text/javascript">
var creportmemberperiod = new ew_Page("creportmemberperiod");

// page properties
creportmemberperiod.PageID = "edit"; // page ID
creportmemberperiod.FormID = "theform"; // form ID

var EW_PAGE_ID = creportmemberperiod.PageID; // for backward compatibility
// extend page with Form_CustomValidate function
creportmemberperiod.Form_CustomValidate =  function(fobj) { // DO NOT CHANGE THIS LINE!
	// Your custom validation code here, return false if invalid. 
 
	if (fobj.elements[0].value == 0) return ew_OnError(this, fobj.elements["startdate"], "โปรดระบุวันที่เริ่มต้น");
	if (fobj.elements[1].value == 0) return ew_OnError(this, fobj.elements["enddate"], "โปรดระบุวันที่สิ้นสุด");
	
	return true;                                                                      
}  

//-->
</script>

<?php

if ($xprint != 1){
	$_SESSION['period']= $_POST;
}

if (! $xprint) $period = 	$_POST;
else $period = $_SESSION['period'];
			//$arr = $info->GetArray();
 
?>

<?php if ($xprint == 1){?>
<font face="Cordia New" size="2">
<?php } ?>
<div class="ewTitle"><?php if ($xprint != 1) {?><img src="images/ico_all_member.png" width="40" height="40" align="absmiddle" /><?php }?>
  <?php if ($xprint == 1) {?><center>
  <font size="+3"><strong><?php }?>
  สรุปข้อมูลจำนวนสมาชิก
  <?php if ($xprint == 1) {?></strong></font>
</center>
<?php }?></div><br />


<?php if ($xprint == 1) {?><hr /><?php }?>
<?php if ($xprint != 1){?>
<form id="theform" name="theform" method="post" action="" onsubmit="return creportmemberperiod.Form_CustomValidate(this);">
<table width="100%" align="center">
  <tr>
    <td align="left"><table width="100%" align="center" cellspacing="0">
      <tr>
        <td ><table width="100%" border="0" cellpadding="1" cellspacing="1"  <?php if ($xprint == 1) {?> style="padding:5px;"<?php }?>>
          <tr id="r_min_advance_subv6">
            <td width="100" align="left"  <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>วันที่เริ่มต้น</strong></td>
            <td align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><input type="text" name="startdate" id="startdate" value="">
              &nbsp;<img src="phpimages/calendar.png" id="cal_startdate" name="cal_startdate" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
              <script type="text/javascript">
Calendar.setup({
	inputField: "startdate", // input field id
	ifFormat: "%Y-%m-%d", // date format
	button: "cal_startdate" // button id
});
</script>
            </td>
            </tr>
          <tr id="r_max_advance_subv5">
            <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>วันที่สิ้นสุด</strong></td>
            <td align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><input type="text" name="enddate" id="enddate" value="" />
              &nbsp;<img src="phpimages/calendar.png" id="cal_enddate" name="cal_enddate" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;" />
              <script type="text/javascript">
Calendar.setup({
	inputField: "enddate", // input field id
	ifFormat: "%Y-%m-%d", // date format
	button: "cal_enddate" // button id
});
</script></td>
            </tr>
          </table></td>
      </tr>
    </table>
   
      <p>
        <label>
          <input type="submit" name="show" id="show" value="แสดงข้อมูล" />
        </label>
      </p></td>
  </tr>
</table> </form>
<?php } ?>
<?php if ($period["show"] || $xprint == 1){
$start = $period["startdate"];
$end = $period["enddate"];

global $conn;  

			// $member = ew_Execute("SELECT * FROM  members WHERE village_id = ".$vid);
			$passtotal = ew_ExecuteScalar("SELECT count(member_id) FROM members WHERE regis_date < '".$start."' AND member_status = 'ปกติ'");
			

			$presenttotal = ew_ExecuteScalar("SELECT count(member_id) FROM members WHERE regis_date <= '".$end."' AND member_status = 'ปกติ'");
			$prt = $conn->Execute("SELECT * FROM members LEFT JOIN tambon on (members.t_code = tambon.t_code) LEFT JOIN village ON (members.village_id = village.village_id) WHERE regis_date >= '".$start."' AND regis_date <= '".$end."' ORDER BY tambon.t_code");
			$prtt = $prt->getArray();
			$periodtotal = count($prtt);
			
			
			$prd = $conn->Execute("SELECT * FROM members LEFT JOIN tambon on (members.t_code = tambon.t_code) LEFT JOIN village ON (members.village_id = village.village_id) WHERE regis_date >= '".$start."' AND regis_date <= '".$end."' AND member_status = 'เสียชีวิต' ORDER BY tambon.t_code" );
			$perioddead = $prd->getArray();
			$perioddeadtotal = count($perioddead);
			
			
			$prs = $conn->Execute("SELECT * FROM members LEFT JOIN tambon on (members.t_code = tambon.t_code) LEFT JOIN village ON (members.village_id = village.village_id) WHERE regis_date >= '".$start."' AND regis_date <= '".$end."' AND member_status = 'ลาออก' ORDER BY tambon.t_code");
			$prrs = $prs->getArray();
			$periodresigntotal= count($prrs);
			
			
			$prtma = $conn->Execute("SELECT * FROM members LEFT JOIN tambon on (members.t_code = tambon.t_code) LEFT JOIN village ON (members.village_id = village.village_id) WHERE regis_date >= '".$start."' AND regis_date <= '".$end."' AND member_status = 'พ้นสภาพ' ORDER BY tambon.t_code");
			$prtm = $prtma->getArray();
			$periodterminatetotal= count($prtm);

?>
<br /><?php if ($xprint != 1){?>
<a href="reportmemberperiod.php?xprint=1" target="_blank"><img src="images/ico_print_all.png" width="152" height="37" border="0" /></a>
<?php } ?><br />

<?php if ($xprint == 1) {?><center><?php } ?><strong>จำนวนสมาชิกที่เพิ่มขึ้นและลดลงระหว่าง <u><?php echo date2Thai($start)?></u> ถึง <u><?php echo date2Thai($end)?></u></strong><?php if ($xprint == 1) {?></center><?php } ?><br />
<br />
<table width="100%" align="center" cellspacing="0" class="ewGrid">
  <tr>
    <td class="ewGridContent"><table width="100%" border="0" cellpadding="1" cellspacing="2" class="ewTable">
      <tr id="r_min_advance_subv3">
        <td width="200" align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>สมาชิกคงเหลือยกมา</strong></td>
        <td align="left" bgcolor="#CCCCCC" style="border: solid 1px #999;" <?php if ($xprint == 1) {?><?php }?>><strong>จำนวน <?php echo $passtotal;?> คน</strong></td>
      </tr>
      <tr id="r_max_advance_subv2">
        <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>สมาชิกที่เพิ่มขึ้น</strong></td>
        <td align="left" bgcolor="#CCCCCC" style="border: solid 1px #999" <?php if ($xprint == 1) {?><?php }?>><strong>จำนวน <?php echo $periodtotal;?> คน</strong></td>
      </tr>
             <?php if ($periodtotal > 0){?>
      <tr>
        <td align="left"  <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>>&nbsp;</td>
        <td align="left" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><table border="0" cellpadding="0" cellspacing="0" class="ewTable">
        <tr>
            <td width="50" align="left">ลำดับที่</td>
            <td width="80" align="left">รหัสสมาชิก</td>
            <td width="180" align="left">ชื่อ-นามสกุล</td>
            <td width="250" align="left">ที่อยู่</td>
            <td width="170" align="left">วันที่สมัคร</td>
            </tr>
          <?php foreach($prtt as $key => $value){?>

          <tr>
            <td align="center"><?php echo $key + 1?></td>
            <td align="center"><?php echo $value["member_code"]?></td>
            <td><?php echo $value["prefix"]?><?php echo $value["fname"]?> <?php echo $value["lname"]?></td>
            <td><?php echo $value["address"]." หมู่ที่ ".$value["v_code"]." ".$value["v_title"]." ตำบล".$value["t_title"]?></td>
            <td><?php echo date2Thai($value["regis_date"])?></td>
            </tr>
          <?php }?>
        </table>
        
        </td>
      </tr>
     <?php } // if periodtotal > 0?>      
      <tr>
        <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>สมาชิกที่เสียชีวิต</strong></td>
        <td align="left" bgcolor="#CCCCCC" style="border: solid 1px #999" <?php if ($xprint == 1) {?><?php }?>><strong>จำนวน <?php echo $perioddeadtotal;?> คน</strong></td>
      </tr>
      <?php if ($perioddeadtotal > 0){?>
      <tr>
        <td align="left"  <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>>&nbsp;</td>
        <td align="left" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><table border="0" cellpadding="0" cellspacing="0" class="ewTable">
        <tr>
            <td width="50" align="left">ลำดับที่</td>
            <td width="80" align="left">รหัสสมาชิก</td>
            <td width="180" align="left">ชื่อ-นามสกุล</td>
            <td width="250" align="left">ที่อยู่</td>
            <td width="170" align="left">วันที่เสียชีวิต</td>
            <td align="left">สาเหตุ</td>
          </tr>
          <?php foreach($perioddead as $key => $value){?>

          <tr>
            <td align="center"><?php echo $key + 1?></td>
            <td align="center"><?php echo $value["member_code"]?></td>
            <td><?php echo $value["prefix"]?><?php echo $value["fname"]?> <?php echo $value["lname"]?></td>
            <td><?php echo $value["address"]." หมู่ที่ ".$value["v_code"]." ".$value["v_title"]." ตำบล".$value["t_title"]?></td>
            <td><?php echo date2Thai($value["dead_date"])?></td>
            <td><?php echo $value["note"]?></td>
          </tr>
          <?php }?>
        </table>
        
        </td>
      </tr>
     <?php } // if perioddeadtotal > 0?>
      <tr>
        <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>สมาชิกที่ลาออก</strong></td>
        <td align="left" bgcolor="#CCCCCC" style="border: solid 1px #999" <?php if ($xprint == 1) {?><?php }?>><strong>จำนวน <?php echo $periodresigntotal;?> คน</strong></td>
      </tr>
       <?php if ($periodresigntotal > 0){?>
      <tr>
        <td align="left"  <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>>&nbsp;</td>
        <td align="left" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><table border="0" cellpadding="0" cellspacing="0" class="ewTable">
        <tr>
            <td width="50" align="left">ลำดับที่</td>
            <td width="80" align="left">รหัสสมาชิก</td>
            <td width="180" align="left">ชื่อ-นามสกุล</td>
            <td width="250" align="left">ที่อยู่</td>
            <td width="170" align="left">วันที่ลาออก</td>
            <td align="left">สาเหตุ</td>
          </tr>
          <?php foreach($prrs as $key => $value){?>

          <tr>
            <td align="center"><?php echo $key + 1?></td>
            <td align="center"><?php echo $value["member_code"]?></td>
            <td><?php echo $value["prefix"]?><?php echo $value["fname"]?> <?php echo $value["lname"]?></td>
            <td><?php echo $value["address"]." หมู่ที่ ".$value["v_code"]." ".$value["v_title"]." ตำบล".$value["t_title"]?></td>
            <td><?php echo date2Thai($value["resign_date"])?></td>
            <td><?php echo $value["note"]?></td>
          </tr>
          <?php }?>
        </table>
        
        </td>
      </tr>
     <?php } // if periodresigntotal > 0?>
      <tr>
        <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>สมาชิกที่พ้นสภาพ</strong></td>
        <td align="left" bgcolor="#CCCCCC" style="border: solid 1px #999" <?php if ($xprint == 1) {?><?php }?>><strong>จำนวน <?php echo $periodterminatetotal;?> คน</strong></td>
      </tr>
             <?php if ($periodterminatetotal > 0){?>
      <tr>
        <td align="left"  <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>>&nbsp;</td>
        <td align="left" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><table border="0" cellpadding="0" cellspacing="0" class="ewTable">
        <tr>
            <td width="50" align="left">ลำดับที่</td>
            <td width="80" align="left">รหัสสมาชิก</td>
            <td width="180" align="left">ชื่อ-นามสกุล</td>
            <td width="250" align="left">ที่อยู่</td>
            <td width="170" align="left">วันที่พ้นสภาพ</td>
            <td align="left">สาเหตุ</td>
          </tr>
          <?php foreach($prtm as $key => $value){?>

          <tr>
            <td align="center"><?php echo $key + 1?></td>
            <td align="center"><?php echo $value["member_code"]?></td>
            <td><?php echo $value["prefix"]?><?php echo $value["fname"]?> <?php echo $value["lname"]?></td>
            <td><?php echo $value["address"]." หมู่ที่ ".$value["v_code"]." ".$value["v_title"]." ตำบล".$value["t_title"]?></td>
            <td><?php echo date2Thai($value["terminate_date"])?></td>
            <td><?php echo $value["note"]?></td>
          </tr>
          <?php }?>
        </table>
        
        </td>
      </tr>
     <?php } // if periodterminatetotal > 0?>
      <tr>
        <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>สมาชิกคงเหลือทั้งสิ้น</strong></td>
        <td align="left" bgcolor="#CCCCCC" style="border: solid 1px #999" <?php if ($xprint == 1) {?><?php }?>><strong>จำนวน <?php echo ($periodtotal - $perioddeadtotal - $periodresigntotal - $periodterminatetotal);?> คน </strong></td>
      </tr>
      <tr>
        <td align="left" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>สมาชิกคงเหลือทั้งสิ้น ณ ปัจจุบัน</strong></td>
        <td align="left" bgcolor="#CCCCCC" style="border: solid 1px #999" <?php if ($xprint == 1) {?><?php }?>><strong>จำนวน <?php echo getAliveTotal();?> คน</strong> ( <strong>เมื่อ <u><?php echo date2Thai($end)?></u></strong>)</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php }  // post show?>
<br />
<?php 

if ($xprint != 1){
include_once "footer.php";
}
if ($xprint == 1){
//addSliptNumber();	
?>
<script language="javascript">window.print();
window.close();
</script>
<?php }

?>

<?php
$creportmemberperiod->Page_Terminate();
?>
<?php

//
// Page class
//
class creportmemberperiod {

	// Page ID
	var $PageID = 'creportmemberperiod';

	// Page object name
	var $PageObjName = 'creportmemberperiod';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
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
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}

	//
	// Page class constructor
	//
	function creportmemberperiod() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// User table object (administrator)
		if (!isset($GLOBALS["administrator"])) $GLOBALS["administrator"] = new cadministrator;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'slipview', TRUE);

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
		global $Report1;

		// Security
		$Security = new cAdvancedSecurity();

		// Uncomment codes below for security

		
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn())
			$this->Page_Terminate("login.php");
		

		// Global Page Loading event (in userfn*.php)
		Page_Loading();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

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

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language;

		//$this->setSuccessMessage("Welcome " . CurrentUserName());
		// Put your custom codes here
		
	}

}
?>
