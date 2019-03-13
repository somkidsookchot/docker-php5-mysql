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

<?php 
if ($xprint == 1){?>
<font face="Cordia New" size="2">
<?php } ?>
<div class="ewTitle"><?php if ($xprint != 1) {?><img src="images/finance55x55.png" width="40" height="40" align="absmiddle" /><?php }?>
  <?php if ($xprint == 1) {?><center>
  <font size="+3"><strong><?php }?>
  สรุปข้อมูลรายรับรายจ่าย
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
        <td class="ewGridContent"><table width="100%" border="0" cellpadding="1" cellspacing="1" <?php if ($xprint == 1) {?> style="padding:5px;"<?php }?>>
          <tr id="r_min_advance_subv6">
            <td width="100" align="left" <?php if ($xprint == 1) {?> style="border-bottom: dashed 1px #ccc"<?php }?>><strong>วันที่เริ่มต้น</strong></td>
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

			$passadvtotal = ew_ExecuteScalar("SELECT sum(pay_sum_total) FROM paymentsummary WHERE pay_sum_date < '".$start."' AND pay_sum_type = 2");
			

			$sumtotal = ew_ExecuteScalar("SELECT sum(pay_sum_total) FROM paymentsummary WHERE pay_sum_date >= '".$start."' AND pay_sum_date <= '".$end."' AND pay_sum_type != 1");
			
			$subvtotal = ew_ExecuteScalar("SELECT sum(pay_sum_total) FROM paymentsummary WHERE pay_sum_date >= '".$start."' AND pay_sum_date <= '".$end."' AND pay_sum_type = 1");
			
			$advsubvtotal = ew_ExecuteScalar("SELECT sum(pay_sum_total) FROM paymentsummary WHERE pay_sum_date >= '".$start."' AND pay_sum_date <= '".$end."' AND pay_sum_type = 2");
			
			$annualtotal = ew_ExecuteScalar("SELECT sum(pay_sum_total) FROM paymentsummary WHERE pay_sum_date >= '".$start."' AND pay_sum_date <= '".$end."' AND pay_sum_type = 3");
			
			
			$registotal = ew_ExecuteScalar("SELECT sum(pay_sum_total) FROM paymentsummary WHERE pay_sum_date >= '".$start."' AND pay_sum_date <= '".$end."' AND pay_sum_type = 4");
			
			$othertotal = ew_ExecuteScalar("SELECT sum(pay_sum_total) FROM paymentsummary WHERE pay_sum_date >= '".$start."' AND pay_sum_date <= '".$end."' AND pay_sum_type = 5");
			

			// $member = ew_Execute("SELECT * FROM  members WHERE village_id = ".$vid);
			$subv = $conn->Execute("SELECT * FROM subvcharge LEFT JOIN members ON (members.member_code = subvcharge.member_code) WHERE subvc_status = 'จ่ายแล้ว' AND subvc_date >= '".$start."' AND subvc_date <= '".$end."' ORDER BY subvc_date");
			$arr = $subv->GetArray();
			
			$resign = $conn->Execute("SELECT * FROM refundable LEFT JOIN members ON (members.member_code = refundable.member_code) WHERE refund_status = 'จ่ายแล้ว' AND pay_date >= '".$start."' AND pay_date <= '".$end."' ORDER BY pay_date");
			$arr2 = $resign->GetArray();
			
			
			$exp = $conn->Execute("SELECT * FROM expenseslist WHERE exp_date >= '".$start."' AND exp_date <= '".$end."' ORDER BY exp_date");
			$arr3 = $exp->GetArray();
			
			
			$setting = getSetting();
			

?>
<?php if ($xprint != 1){
?>
<a href="reportpaymentperiod.php?xprint=1" target="_blank"><img src="images/button_print_report.png" width="129" height="37" border="0" align="absmiddle" /></a>
<?php } ?><br />
<div class="clear"></div><br />

<div class="ewTitle"><?php if ($xprint == 1) {?><center>
  <?php } ?>สรุปข้อมูลระหว่าง <?php echo date2Thai($start)?> ถึง <?php echo date2Thai($end)?><?php if ($xprint == 1) {?>
</center><?php } ?></div><br />
<br />
<?php if (count($arr) > 0){?><strong><u><br /> 
รายจ่ายค่าสงเคราะห์ศพ จำนวน <?php echo count($arr);?> ศพ
</u></strong>
<?php
	  if (count($arr[0]) > 0){?>
<br />
<br />
<table width="100%" align="center" cellspacing="0" class="ewGrid">
  <tr>
    <td class="ewGridContent"><table width="100%" border="0" cellpadding="1" cellspacing="2" class="ewTable">
      <tr id="r_min_advance_subv">
        <?php if ($xprint != 1){?>
        <?php } ?>
        <td width="50" align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>ลำดับที่</strong></td>
        <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>วันที่จ่าย</strong></td>
        <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>ผู้เสยชีวิต</strong></td>
        <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>จำนวนเงิน</strong></td>
        </tr>
      <?php 
			$total = 0;
			foreach($arr as $key => $value){
				$total += $value["bnfc_total"];
				?>
      <tr id="r_max_advance_subv">
        <?php if ($xprint != 1){?>
        <?php } ?>
        <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $key+1?></td>
        <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo date2Thai($value["subvc_date"])?></td>
        <td align="left" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $value["member_code"]?> ,<?php echo $value["fname"]?> <?php echo $value["lname"]?></td>
        <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo number_format($value["bnfc_total"])?></td>
        </tr>
      <?php }?>
      <tr>
        <td colspan="4" align="right" bgcolor="#CCCCCC"  <?php if ($xprint == 1) {?>style="border: solid 1px #999;"<?php }?>><strong>รวม </strong><strong><?php echo number_format($total)?></strong></td>
        </tr>
    </table></td>
  </tr>
</table>
<?php }  else {echo "<br><br>";} ?>
<?php } // end if recodrd 0?>

<?php if (count($arr2) > 0){?>
<strong><u><br />
<br /> 
จ่ายคืนค่าสงเคราะห์ล่วงหน้าคงเหลือสำหรับสมาชิกที่ลาออกจำนวน <?php echo count($arr2);?> ราย</u></strong>
<?php
	  if (count($arr2[0]) > 0){?>
<br />
<br />
<table width="100%" align="center" cellspacing="0" class="ewGrid">
  <tr>
    <td class="ewGridContent"><table width="100%" border="0" cellpadding="1" cellspacing="2" class="ewTable">
      <tr id="r_min_advance_subv">
        <?php if ($xprint != 1){?>
        <?php } ?>
        <td width="50" align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>ลำดับที่</strong></td>
        <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>วันที่จ่าย</strong></td>
        <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>สมาชิก</strong></td>
        <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>จำนวนเงิน</strong></td>
        </tr>
      <?php 
			$total2 = 0;
			foreach($arr2 as $key => $value){
				$total2 += $value["sub_total"];
				?>
      <tr id="r_max_advance_subv">
        <?php if ($xprint != 1){?>
        <?php } ?>
        <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $key+1?></td>
        <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo date2Thai($value["pay_date"])?></td>
        <td align="left" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $value["member_code"]?> ,<?php echo $value["fname"]?> <?php echo $value["lname"]?></td>
        <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo number_format($value["sub_total"])?></td>
        </tr>
      <?php }?>
      <tr>
        <td colspan="4" align="right" bgcolor="#CCCCCC"  <?php if ($xprint == 1) {?>style="border: solid 1px #999;"<?php }?>><strong>รวม </strong><strong><?php echo number_format($total2)?></strong></td>
        </tr>
    </table></td>
  </tr>
</table>
<?php }  else {echo "<br><br>";} ?>
<br />
<?php } // end record 0?>
<?php if (count($arr3) > 0){?>
<br />
<strong><u>รายจ่ายค่าอื่นๆของสมาคม จำนวน <?php echo count($arr3);?> รายการ </u></strong>
<?php
	  if (count($arr3[0]) > 0){?>
<br />
<br />
<table width="100%" align="center" cellspacing="0" class="ewGrid">
  <tr>
    <td class="ewGridContent"><table width="100%" border="0" cellpadding="1" cellspacing="2" class="ewTable">
      <tr id="r_min_advance_subv2">
        <?php if ($xprint != 1){?>
        <?php } ?>
        <td width="50" align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>ลำดับที่</strong></td>
        <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>วันที่จ่าย</strong></td>
        <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>รายละเอียด</strong></td>
        <td align="center" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><strong>จำนวนเงิน</strong></td>
      </tr>
      <?php 
			$total3 = 0;
			foreach($arr3 as $key => $value){
				$total3 += $value["exp_total"];
				?>
      <tr id="r_max_advance_subv2">
        <?php if ($xprint != 1){?>
        <?php } ?>
        <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $key+1?></td>
        <td align="center" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo date2Thai($value["exp_date"])?></td>
        <td align="left" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo $value["exp_detail"]?></td>
        <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999;"<?php }?>><?php echo number_format($value["exp_total"])?></td>
      </tr>
      <?php }?>
      <tr>
        <td colspan="4" align="right" bgcolor="#CCCCCC"  <?php if ($xprint == 1) {?>style="border: solid 1px #999;"<?php }?>><strong>รวม </strong><strong><?php echo number_format($total3)?></strong></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php }  else {echo "<br><br>";} ?>
<br />
<br />
<?php } // end record 0?>
<br />
<strong><u>สรุปยอดรวมรายรับ</u></strong><br />
<br />
<table width="100%" align="center" cellspacing="0" class="ewGrid">
  <tr>
    <td class="ewGridContent"><table width="100%" border="0" cellpadding="1" cellspacing="2" class="ewTable">
      <tr>
        <td width="314" align="right" class="ewTableHeader"  <?php if ($xprint == 1) {?>style="border: solid 1px #999"<?php }?>><strong>ค่าสงเคราะห์ล่วงหน้า</strong></td>
        <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong><?php echo number_format($advsubvtotal);?> บาท</strong></td>
      </tr>
      <tr>
        <td align="right" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>หักเข้าสมาคมร้อยละ <?php echo $setting[0]["assc_percent"];?> เป็นเงิน</strong></td>
        <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong><?php echo number_format(($advsubvtotal * $setting[0]["assc_percent"]) /100);?> บาท</strong></td>
      </tr>
      <tr>
        <td align="right" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>คงเหลือ</strong></td>
        <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong><?php 
		$asstotal = $advsubvtotal - (($advsubvtotal * $setting[0]["assc_percent"]) /100);
		echo number_format($asstotal);?> บาท</strong></td>
      </tr>
      <tr>
        <td align="right" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>ยอดรวมเงินสงเคราะห์ที่ต้องจ่าย</strong></td>
        <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong><?php echo number_format($total + $total2);?> บาท</strong></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#CCCCCC" class="ewTableHeader" style="border: solid 1px #999" <?php if ($xprint == 1) {?><?php }?>><strong>เงินสงเคราะห์ล่วงหน้าคงเหลือ</strong></td>
        <td align="right" bgcolor="#CCCCCC" style="border: solid 1px #999" <?php if ($xprint == 1) {?><?php }?>><strong><?php 
		$assst = $asstotal - ($total + $total2);
		echo number_format($assst);?> บาท</strong></td>
      </tr>
      <tr>
        <td colspan="2" align="right">&nbsp;</td>
        </tr>
      <tr>
        <td align="right" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>เงินสงเคราะห์ย้อนหลัง</strong></td>
        <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong><?php 
		$rctotal = ew_ExecuteScalar("SELECT sum(rc_total) FROM expresspayment");
		echo number_format($rctotal);?> บาท</strong></td>
      </tr>
      <tr>
        <td align="right" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>หักเข้าสมาคมร้อยละ <?php echo $setting[0]["assc_percent"];?> เป็นเงิน</strong></td>
        <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong><?php 
		$rcp  = round(($rctotal * $setting[0]["assc_percent"]) /100);
		echo number_format($rcp);?> บาท</strong></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#CCCCCC" class="ewTableHeader" style="border: solid 1px #999" <?php if ($xprint == 1) {?><?php }?>><strong>เงินสงเคราะห์ย้อนหลังคงเหลือ</strong></td>
        <td align="right" bgcolor="#CCCCCC" style="border: solid 1px #999" <?php if ($xprint == 1) {?><?php }?>><strong><?php 
		$rcst = $rctotal - $rcp;
		echo number_format($rcst);?> บาท</strong></td>
      </tr>
      <tr align="right">
        <td colspan="2"   <?php if ($xprint == 1) {?>style="border: solid 1px #999"<?php }?>>&nbsp;</td>
        </tr>
      <tr>
        <td align="right" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>เงินค่าบำรุงประจำปี</strong></td>
        <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong><?php echo number_format($annualtotal);?> บาท</strong></td>
      </tr>
      <tr>
        <td align="right" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>เงินค่าสมัครสมาชิก</strong></td>
        <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong><?php echo number_format($registotal);?> บาท</strong></td>
      </tr>
      <tr>
        <td align="right" class="ewTableHeader" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong>เงินค่าอื่นๆ</strong></td>
        <td align="right" <?php if ($xprint == 1) {?> style="border: solid 1px #999"<?php }?>><strong><?php echo number_format($othertotal);?> บาท</strong></td>
      </tr>
      <tr>
        <td colspan="2" align="right" bgcolor="#CCCCCC"   <?php if ($xprint == 1) {?>style="border: solid 1px #999"<?php }?>><strong>ยอดเงินคงเหลือรวมทั้งสิ้น&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo number_format($assst + $rcst + $registotal + $othertotal)?> บาท</strong></td>
        </tr>
    </table></td>
  </tr>
  </table>
<?php }  // post show?>

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
