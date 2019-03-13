// Global user functions
// Global user functions
// Global user functions
// Global user functions
// Global user functions
// Global user functions

/*function checkall(){   
	var field = document.getElementsByName('x_member_id[]'); 

	//var chAll = document.getElementById("x_check_all[]"); 
	for (var i = 0; i < document.fpaymentsummaryadd.elements.length; i++) {
		if (document.fpaymentsummaryadd.elements[i].type == "checkbox" && document.fpaymentsummaryadd.elements[i].id == "x_check_all[]") {

			//document.fpaymentsummaryadd.elements[i].checked = true;
			var chAll = document.fpaymentsummaryadd.elements[i];
		}
	}                                 
	if(chAll.checked){                        
		for (i = 0; i < field.length; i++){
			field[i].checked = true ;                     
		}                                                       
	}else {                                      
		for (i = 0; i < field.length; i++){ 
			field[i].checked = false ;                         
		}                                         
	}                                                      
}       */           

function checkAll(){
	var field = document.getElementsByName('list[]');
	var chAll = document.getElementById('chAll');
if(chAll.checked){
	for (i = 0; i < field.length; i++){
		field[i].checked = true ;
	}
}else {

	for (i = 0; i < field.length; i++){
		field[i].checked = false ;
	}
}
}

function hidefield(ignore){
	document.getElementById('r_pay_death_begin').style.display='none';
	document.getElementById('r_pay_annual_year').style.display='none';
	document.getElementById('r_pay_sum_adv_num').style.display='none';
	//document.getElementById('r_pay_sum_total').style.display='none';
	document.getElementById('r_pay_sum_detail').style.display='none';
	if (ignore != 1) {
		document.getElementById('x_pay_death_begin').value='';
	}
	if (ignore != 3) {
		document.getElementById('x_pay_annual_year').value='';
	}
	if (ignore != 2) {
		//document.getElementById('x_pay_sum_adv_count').value='';
	}
	if (ignore != 5) {
		//document.getElementById('x_pay_sum_total').value='';
		document.getElementById('x_pay_sum_detail').value=''; 
	}

   // document.getElementById('x_pay_sum_type').value=''; 
}                                                  

 function showfield(sel){                                  
	 if (sel ==1){                                       
		hidefield(1); 
		document.getElementById('r_pay_death_begin').style.display='';      
	 }else if (sel==2){ 
		hidefield(2); 
		document.getElementById('r_pay_sum_adv_num').style.display='';  
	 }else if (sel==3){  
		 hidefield(3); 
		 document.getElementById('r_pay_annual_year').style.display=''; 
	 }else if (sel==4){                                      
		hidefield(4);        
	 }else if (sel==5){ 
		 hidefield(5); 
		// document.getElementById('r_pay_sum_total').style.display=''; 
		document.getElementById('r_pay_sum_detail').style.display=''; 
	 }else {
		  hidefield(); 
	 }
 }  

 function hidememberfield(ignore){
	document.getElementById('r_resign_date').style.display='none'; 
	document.getElementById('r_dead_date').style.display='none';
	document.getElementById('r_terminate_date').style.display='none';
	if (ignore != 'ลาออก') {
		document.getElementById('x_resign_date').value='';
	}
	if (ignore != 'เสียชีวิต') {
		document.getElementById('x_dead_date').value='';
	}
	if (ignore != 'พ้นสภาพ') {
		document.getElementById('x_terminate_date').value='';      
	}

   // document.getElementById('x_pay_sum_type').value=''; 
}  

 function showmemberfield(sel){      
	 if (sel =='ปกติ'){                                       
		hidememberfield('ปกติ'); 
		document.getElementById('r_pay_death_begin').style.display='';      
	 }else if (sel=='เสียชีวิต'){ 
		hidememberfield('เสียชีวิต'); 
		document.getElementById('r_dead_date').style.display='';  
	 }else if (sel=='ลาออก'){          
		 hidememberfield('ลาออก');           
		 document.getElementById('r_resign_date').style.display=''; 
	 }else if (sel=='พ้นสภาพ'){                                      
		hidememberfield('พ้นสภาพ');        
		 document.getElementById('r_terminate_date').style.display='';           
	 }else {
		  hidememberfield(); 
	 }
 }

 function hidecalculatefield(ignore){
	document.getElementById('r_cal_detail').style.display='none'; 
	document.getElementById('r_unit_rate').style.display='none';
	if (ignore != '5') {
		document.getElementById('x_cal_detail').value='';
		document.getElementById('x_unit_rate').value='';
	}

   // document.getElementById('x_pay_sum_type').value=''; 
}  

 function showcalculatefield(sel){      
	 if (sel =='5'){                                       
		hidecalculatefield('5'); 
		document.getElementById('r_cal_detail').style.display='';      
		document.getElementById('r_unit_rate').style.display='';
	 }else {
		  hidecalculatefield(); 
	 }
 }

function clearUpdateDetail(){
	
	document.getElementById('x_update_detail').value=''; 

}

function th_getCalendarDate()
{
   var months = new Array(13);
   months[0]  = "มกราคม";
   months[1]  = "กุมภาพันธ์";
   months[2]  = "มีนาคม";
   months[3]  = "เมษายน";
   months[4]  = "พฤษภาคม";
   months[5]  = "มิถุนายน";
   months[6]  = "กรกฎาคม";
   months[7]  = "สิงหาคม";
   months[8]  = "กันยายน";
   months[9]  = "ตุลาคม";
   months[10] = "พฤศจิกายน";
   months[11] = "ธันวาคม";
   var dayname = new Array(8);
   dayname[0]	= "อาทิตย์";
   dayname[1]	= "จันทร์";
   dayname[2]	= "อังคาร";
   dayname[3]	= "พุธ";
   dayname[4]	= "พฤหัสบดี";
   dayname[5]	= "ศุกร์";
   dayname[6]	= "เสาร์";
  
   var now         = new Date();
   var monthnumber = now.getMonth();
   var monthname   = months[monthnumber];
   var monthday    = now.getDate();
   var daynumber   = now.getDay();
   var day         = dayname[daynumber]; 
   var year        = now.getYear();
   if(year < 2000) { year = year + 1900; }
   year = year+543;
   var dateString = day + ', ' + monthday  +
                    ' ' +
                    monthname +
                    ' ' +
                    year;
   return dateString;
} // function getCalendarDate()

function getClockTime()
{
   var now    = new Date();
   var hour   = now.getHours();
   var minute = now.getMinutes();
   var second = now.getSeconds();
   var ap = "AM";
   if (hour   > 11) { ap = "PM";             }
   if (hour   > 12) { hour = hour - 12;      }
   if (hour   == 0) { hour = 12;             }
   if (hour   < 10) { hour   = "0" + hour;   }
   if (minute < 10) { minute = "0" + minute; }
   if (second < 10) { second = "0" + second; }
   var timeString = hour +
                    ':' +
                    minute +
                    ':' +
                    second +
                    " " +
                    ap;
   return timeString;
} // function getClockTime()


function show2(){
if (!document.all&&!document.getElementById)
return
thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var day=Digital.getDay()


  if(hours < 10){
    hours = " " + hours
    }
  if(minutes < 10){
    minutes = "0" + minutes
    }
  if(seconds< 10){
    seconds = "0" + seconds
    } 

var calendarDate = th_getCalendarDate();
var ctime="[&nbsp;"+hours+"&nbsp;:&nbsp;"+minutes+"&nbsp;:&nbsp;"+seconds+"&nbsp;]"
thelement.innerHTML="&nbsp;<font size=3>"+ctime+"</font>&nbsp;<br>"+calendarDate
setTimeout("show2()",1000)
}
window.onload=show2;
