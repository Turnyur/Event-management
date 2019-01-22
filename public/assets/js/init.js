
var processFile = "assets/inc/ajax.inc.php";
var $global_sel_month=1;
 var $global_sel_year=2018;
var formErrorStatus='';
var calendarLinkStatus=false;

function custormSelect(){
    /*This part of the code Custormizes <select><option></option></select> tags*/

var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var i, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
}




var fx = {  
"initModal" : function() {                                         
		if ( $(".modal-window").length==0 ){                     
        	// Creates a div, adds a class, and appends it to the body tag                                
        	return $("<div>").addClass("modal-window").appendTo("body");                 
        }else{                     
        // Returns the modal window if one                                    
        return $(".modal-window");                 
    }             
} ,

"boxin" : function(data, modal) {                 
 // Creates an overlay for the site, adds                 
 // a class and a click event handler, then                 
 // appends it to the body element                 
 $("<div>").hide().addClass("modal-overlay").click(
 	function(event){                             
 			// Removes event                             
 			fx.boxout(event); 
 		}).appendTo("body"); 
 
                // Loads data into the modal window and                 
                // appends it to the body element                 
                modal.hide().append(data)/*.appendTo("body")*/; 

                // Fades in the modal window and overlay                 
                $(".modal-window,.modal-overlay").fadeIn("slow");
			//make Event Title input the focus

                custormSelect();


}, 

"boxout" : function(event) {                
  // If an event was triggered by the element                 
  // that called this function, prevents the                
   // default action from firing                 
   if ( event!=undefined ){                     
   		event.preventDefault();                 
   } 

                // Removes the active class from all links                 
                $("a").removeClass("active"); 

                // Fades out the modal window, then removes                 
                // it from the DOM entirely                 
                $(".modal-window") .fadeOut("slow", function() {                             
                	$(this).remove(); 
                	$('.modal-overlay').remove();                        
                } );    
            },

"getMonth":function ($target){
                    var $sel_month;
        if ($target.text()=='January') {
                        $sel_month=1;
                    }else if ($target.text()=='February') {
                        $sel_month=2;
                        
                    }else if ($target.text()=='March') {
                        $sel_month=3;
                        
                    }else if ($target.text()=='April') {
                        $sel_month=4;
                        
                    }else if ($target.text()=='May') {
                        $sel_month=5;
                        
                    }else if ($target.text()=='June') {
                        $sel_month=6;
                        
                    }else if ($target.text()=='July') {
                        $sel_month=7;
                        
                    }else if ($target.text()=='August') {

                        $sel_month=8;
                    }else if ($target.text()=='September') {

                        $sel_month=9;
                    }else if ($target.text()=='October') {

                        $sel_month=10;
                    }else if ($target.text()=='November') {

                        $sel_month=11;
                    }else if ($target.text()=='December') {

                        $sel_month=12;
                    }else{

                        $sel_month=-1;
                    }

                    return $sel_month;
},
"getYear":function ($target){
    var  sel_year=$target.text();
    return sel_year;
},
"getYearContent":function (year){
        $('ul#container').remove();

                loopend=year+18;
                wrap='<ul id="container" '+'>';
            for (var i =year;  i <loopend; i++) {
                wrap +='<li>'+i+'</li>';
                if(i%6==10){
                    wrap+='</ul><ul>';
                }
            }
            data=wrap+/*'<ul><a href="#" id="left">&laquo</a>'+'<a href="#" id="right">&raquo;</a></ul>*/'</ul>';
                modal = fx.initModal();
                fx.boxin(data, modal);
                $('.modal-window').addClass('selectCal');
                
},
 "addevent" : function(data, formData){                 
 // Converts the query string to an object                 
 var entry = fx.deserialize(formData);    
        cal = new Date(NaN), 
        event = new Date(NaN), 

        cdata = $("h2").attr("id").split('-'), 
        //cdata=[$global_sel_year,$global_sel_month];
        //alert(cdata[1]);
                // Extracts the event day, month, and year                     
                date = entry.event_start.split(' ')[0], 
                // Splits the event data into pieces                     
                edata = date.split('-'); 
                // Sets the date for the calendar date object                 
               // cal.setFullYear(cdata[0], cdata[1], 1); 
                cal.setFullYear(cdata[1], cdata[2], 1); 
                // Sets the date for the event date object                 
                event.setFullYear(edata[0], edata[1], edata[2]); 

                 // Since the date object is created using 
                  // GMT, then adjusted for the local timezone,                 
                  // adjust the offset to ensure a proper date                 
                  event.setMinutes(event.getTimezoneOffset());   

if ( cal.getFullYear()==event.getFullYear() && cal.getMonth()==event.getMonth() ){                     
    // Gets the day of the month for event  
        var fix_day=event.getDate()+1;                  
        var day = String(fix_day); 
    // Adds a leading zero to 1-digit days                     
        day = day.length==1 ? "0"+day : day; 
        $("strong:contains("+day+")").siblings('a').remove();
    // Adds the new date link                     
    $("<a>")
        .hide()
        .attr("href", "view.php?event_id="+data)
        .text(entry.event_title)                         
        .insertAfter($("strong:contains("+day+")"))                         
        .delay(1000)                         
        .fadeIn("slow"); 
             $("strong:contains("+day+")").parent().addClass('lastAction');
             function showAction(){
                $("strong:contains("+day+")").parent().removeClass('lastAction');
                //alert("Hello");
            }
             window.setTimeout(showAction,5000);          
    }   
}, 

 "deserialize" : function(str){                 
 // Breaks apart each name-value pair                 
 var data = str.split("&"), 
 // Declares variables for use in the loop                     
    pairs=[], entry={}, key, val; 
// Loops through each name-value pair                 
    for ( x in data ){                     
// Splits each pair into an array                     
    pairs = data[x].split("="); 
// The first element is the name                    
    key = pairs[0]; 
// Second element is the value                     
    val = pairs[1]; 
// Stores each value as an object property                     
    entry[key] = fx.urldecode(val);                 
}                 
return entry;             
}, 
 
"urldecode" : function(str) {                 
// Converts plus signs to spaces                
 var converted = str.replace(/\+/g, ' '); 
// Converts any encoded entities back                 
return decodeURIComponent(converted);             
},
 "removeevent" : function(){                 
 // Removes any event with the class "active"                 
 $(".active").fadeOut("slow", function(){                             
    $(this).remove();                         
    });             
}    



}; 





function closeButton(){
        	$("<a>").attr("href", "#").addClass("modal-close-btn").html("&times;").click(
        		function(event){ 
        			fx.boxout(event);                   
        		}).appendTo(modal);

}

//Entrance of jQuery into the program

$(function () {
  
    if ($('.slideshow-container').length>0) {
        /*This function is used in causing an Image slideShow*/
 var slideIndex = 1;
 showSlides(slideIndex);
setInterval(function(){
    if (slideIndex>3) {
        slideIndex=1;
    }
    showSlides(slideIndex);
    slideIndex++;

},5000);

function plusSlides(n) {
  showSlides(slideIndex += n);
}
$('.prev').on('click',function(e){
    plusSlides(-1);
});

$('.next').on('click',function(e){
    plusSlides(1);
});
function currentSlide(n) {
  showSlides(slideIndex = n);
}
$('span.dot').on('click',function(e){
    $target=$(e.target);
    if ($('span.dot').index($target)==0){
        currentSlide(1);
    }else if($('span.dot').index($target)==1){
        currentSlide(2);
    }else if($('span.dot').index($target)==2){
        currentSlide(3);
    }else{

    }
});

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}

    }

   // history.pushState({ urlState:'index.php'},'index.php','./?t=home');
        	$sel_month=$('#month').text();
        	$sel_yr=$('#year').text();
        	$sel_day="";

//Coutesy of Turnyur Siy ->
// Performs the task of making creation of Events by clicking any day of the list possible
 $('body').on('click','li:not("ul.weekdays li")',function (e){
        		e.preventDefault();
        		$target=$(e.target);
        		if ($target.is("a")) {
        			return;
        		}
        		day=$target.text().replace(/\D/g,'');
				//$testd=day;
				$sel_day=day;
				if($sel_day==""){
					$sel_day=32;
				}
                $sel_month=$('#month').text();
                $sel_yr=$('#year').text();

				$.ajax({
					data:{
						"action":"create_from_interface",
						"day":$sel_day,
						"month":$sel_month,
						"year":$sel_yr
					},
					url:processFile,
					type:"POST",
					success:function(data){
						modal=fx.initModal();

						closeButton();
						fx.boxin(data, modal);
						//console.log(data);

                     //This function prevents the submit butting in the form from sending the form data
                     //using the conventional  method of process.in.php, instead the form is sent to
                     //ajax.inc.php   
                        //fx.submitEventWithAjax();
					},
					error:function(data){

					}
				});


 });



//This part of the codes performs view.php task using jQuery ajax

$('body').on('click','li>a',function(e){
        		e.preventDefault();
        		$target=$(e.target);
        		$target.addClass('active');

        		var data=	$target.attr('href').replace(/.+?\?(.*)$/, "$1"); 

        		modal=fx.initModal();
        		closeButton();

        		$.ajax({                 
        			type: "POST",                 
        			url: processFile,
        			data: "action=event_view&" + data,                 
        			success: function(data){                                            
        				fx.boxin(data, modal);                      
        			},                 
        			error: function(msg) {                         
        				modal.append(msg);                     
        			}             }); 



 });



//This part of the code performs + Add a New Event action in index.php using jQuery ajax
$('body').on("click", 'a.admin,.admin-options form', function(e){ 
        // Prevents the form from submitting         
        e.preventDefault(); 
        // Loads the action for the processing file  
        $target=$(e.target);       
        var action = $target.attr('name')||"edit_event"; 
        // Loads the editing form and displays it 
          id=$target.siblings("input[name=event_id]").val();
          //alert(id);   
          id=(id!=undefined)?"&event_id="+id : "";   
          
        $.ajax({                 
        	type: "POST",                 
        	url: processFile,                 
        	data: "action="+action+id,                 
        	success: function(data){                         
        // Hides the form                         
        	//var form = $(data).hide(), 
                        // Make sure the modal window exists                             
                        //modal = fx.initModal();
                         modal = fx.initModal()
                         .children(":not(.modal-close-btn)")                                     
                         .remove()                                     
                         .end();  
                        //closeButton();                       
                        fx.boxin(data/*null*/, modal); 
                        var Elemfocus=document.getElementById('event_title');
                        Elemfocus.focus();           
                        //form.appendTo(modal).addClass("edit-form").fadeIn("slow");  
                        $('a.cancel').on('click',function(event){
                        	fx.boxout(event);
                        });   
                        //This function submits the user inputed data to ajax.inc.php
                        //The php file processes the data and sends it to the database
                       // fx.submitEventWithAjax();
                    },                 
                    error: function(msg){                    
                    	alert(msg);                 
                    }             
                }); 

 });














$('body').on('click','span#month',function(e){
        		$target=$(e.target);
        		var month=[
        			'January',
        			'February',
        			'March',
        			'April',
        			'May',
        			'June',
        			'July',
        			'August',
        			'September',
        			'October',
        			'November',
        			'December'
        		];
        		wrap='<ul>';
        	for (var i =0;  i <month.length; i++) {
        		wrap +='<li>'+month[i]+'</li>';
        		if(i%6==5){
        			wrap+='</ul><ul>';
        		}
        	}
        	data=wrap+'</ul>';
        		modal = fx.initModal();
        		fx.boxin(data/*null*/, modal);
        		$('.modal-window').addClass('selectCal');




        		//Call Ajax
        		$('.modal-window.selectCal').find('li').on('click', function(e){
        			$target=$(e.target);
        			$global_sel_month=fx.getMonth($target);
        		    //$global_sel_year=2018;
        			//alert($sel_month);

                    $.ajax({
                        data:{
                            "month":$global_sel_month,
                            "year":$global_sel_year,
                            "day":1,
                            "action":"change_time"
                        },
                        type:"POST",
                        url:processFile,
                        success:function (data){
                        fx.boxout();
                        //console.log(data);
                        //$('<div>Test</div>').hide().appendTo('#content').delay(1000).fadeIn("slow");
                        $('#content').empty();
                        $('#content').hide().append(data).fadeIn("slow");
                        },
                        error:function(msg){
                            alert(msg)
                        }
                    });
 //var index="http://localhost/dell/calendar/public/index.php?month="+$global_sel_month+"&year="+$global_sel_year;

						//location.assign(index);
		
        		});




});






    //This Part of the code performs commit action of the inputed data on create event modal to the database
$('body').on('click','.edit-form input[type=submit]',function(e){
    e.preventDefault();

    var formData=$(this).parents('form').serialize();
      submitVal = $(this).val(), 
 
        // Determines if the event should be removed             
        remove = false; 
        start = $(this).siblings("[name=event_start]").val(), 
        end = $(this).siblings("[name=event_end]").val(); 


      if ( $(this).attr("name")=="confirm_delete" ){             
      // Adds necessary info to the query string             
      formData += "&action=confirm_delete" + "&confirm_delete="+submitVal; 

       if ( submitVal=="Yes, Delete It" ){                 
        remove = true;             
    }           
  }


    if ( $(this).siblings("[name=action]").val()=="event_edit" ){             
        if ( !validDate(start) || !validDate(end) ){                 
            alert("Valid dates only! (YYYY-MM-DD HH:MM:SS)");   
            $(this).siblings("[name=event_start]").css('background-color','rgba(255, 0, 0,.1)');              
            return false;             
        }         
    } 
 
 


     $.ajax({                 
     type: "POST",                 
     url: processFile,                 
     data: formData,                 
     success: function(data) {      
      // If this is a deleted event, removes                     // it from the markup                     
      if ( remove===true ){                         
        fx.removeevent();                     
    }                
     // Fades out the modal window                     
     fx.boxout(); 
         // Adds the event to the calendar  
          if ( $("[name=event_id]").val().length==0 && remove===false  ){                         
            fx.addevent(data, formData);                     
        }                    
         fx.addevent(data, formData); 
    // Logs a message to the console                     
        //console.log( formData );                 
    },                 
    error: function(msg) {                     
        alert(msg);                 
    }             }); 
 
 


});








$('body').on('click','span#year',function(e){
        		$target=$(e.target);
        		var year=Number($target.text());
        		fx.getYearContent(year);


    $('body').on('click','a#left',function(e){
            e.preventDefault();
            year-=18;
            fx.getYearContent(year);

     });





    $('body').on('click','a#right',function(e){
        e.preventDefault();
        year+=18;
        fx.getYearContent(year);
    
     });

    $('.modal-window.selectCal').find('li').on('click',function(e){
                    
        			$target=$(e.target);
					$global_sel_year=fx.getYear($target);
                    var Elem=(function(){
                        return $('body').find('#month');
        }());
                    $global_sel_month=fx.getMonth(Elem);
                    $.ajax({
                        data:{
                            "month":$global_sel_month,
                            "year":$global_sel_year,
                            "day":1,
                            "action":"change_time"
                        },
                        type:"POST",
                        url:processFile,
                        success:function (data){
                        fx.boxout();
                        //alert($global_sel_year);
                        $('#content').empty();
                        $('#content').hide().append(data).fadeIn("slow");
                        },
                        error:function(msg){
                            alert(msg);
                        }
                    });
    //var index="http://localhost/dell/calendar/public/index.php?month="+$global_sel_month+"&year="+$global_sel_year;
						//location.assign(index);

    });
        


        		

 });

//This Section sanitizes and Validates User Input
$('input[type=submit]').siblings("input[name=uname]").on('blur',function(e){
    $target=$(e.target);
    if(!(validTextInput($target.val()))){
        formErrorStatus='Enter Valid Username';
        $('legend').text(formErrorStatus);
        //$target.val('');
        //$target.attr('placeholder', 'Error');
        $target.css('background-color','rgba(255, 0, 0,.1)');
    }else{
        $target.css('background-color','rgba(0, 255, 0,.1)');
    } 

});
$('input[type=submit]').siblings("input[name=pword]").on('blur',function(e){
    $target=$(e.target);
    if (!validPassword($target.val())) {
        //Error Occured!
        formErrorStatus='Enter Valid Password';
        $('legend').text(formErrorStatus);
        $target.css('background-color','rgba(255, 0, 0,.1)');
    }else{
        $target.css('background-color','rgba(0, 255, 0,.1)');
    } 
});
$('input[type=submit]').siblings("input[name=confirm_pword]").on('blur',function(e){
    var pass=$('input[name=pword]').val();
    $target=$(e.target);
    if ($target.val()!=pass || !validPassword($target.val())) {
        //Error Occured!
        formErrorStatus='Password does not match';
        $('legend').text(formErrorStatus);
        $target.css('background-color','rgba(255, 0, 0,.1)');

    }else{

       $target.css('background-color','rgba(0, 255, 0,.1)');


       
   } 
});
$('input[type=submit]').siblings("input[name=email]").on('blur',function(e){
    $target=$(e.target);
    if (!validEmail($target.val())) {
        //Error Occured!
        formErrorStatus='Enter Valid Email Address';
        $('legend').text(formErrorStatus);
        $target.css('background-color','rgba(255, 0, 0,.1)');
    }else{
        $target.css('background-color','rgba(0,255, 0,.1)');
    } 
});
$('input[name=terms]').on('change',function(){
 $('input[type=submit]').hide().fadeIn(1000);
 $('input[type=submit]')[0].disabled=!$('input[type=submit]')[0].disabled;

});

$('input[name=register_submit],input[name=login_submit]').on('click',function(e){
    for (var i = 0; i<=$('input').length-4; i++) {
        if($('input')[i].value==''){
            formErrorStatus='Field cannot be Empty';
        }
    }
    if(formErrorStatus!=''){

     $('legend').text(formErrorStatus);
     formErrorStatus='';
     return false;

 }
});

//This functions enables responsive menu links
$('.icon').on('click',function(e){
    e.preventDefault();
    var x = document.getElementById("icon-bar");
    /*if (x.className === "icon-bar") {
        x.className += " responsive";
    } else {
        x.className = "icon-bar";
    }*/
    if (x.className === "icon-bar"){
        $('#icon-bar').hide().addClass('responsive').slideDown(1000);
    }else{
        $('#icon-bar').slideUp(1000,function(){
            $('#icon-bar').css('display','block').removeClass('responsive');

        });
        
    }


    
});

/*Code Below adds responsive and animated slide down and up effect to primary menu in small devices*/

$('#container-icon-bar').on('click',function(e){
    $target=$(e.target);
    var list_of_classes=$('#container-icon-bar')[0].classList
    var checkClass=/^container-icon-bar$/.test(list_of_classes);
    if(checkClass){
        $('#container-icon-bar,div.dropdown').addClass('change');
        $('#icon-bar').hide().addClass('responsive').slideDown(1000);
    }else{
        
        $('#icon-bar').slideUp(1000,function(){
            $('#icon-bar').css('display','block').removeClass('responsive');
            $('#container-icon-bar,div.dropdown').removeClass('change');

        });
    }
    

});

function  createEvnt(){
        if($sel_day==""){
          $sel_day=32;
        }
                $sel_month=$('#month').text();
                $sel_yr=$('#year').text();

        $.ajax({
          data:{
            "action":"create_from_interface",
            "day":$sel_day,
            "month":$sel_month,
            "year":$sel_yr
          },
          url:processFile,
          type:"POST",
          success:function(data){
            modal=fx.initModal();

            closeButton();
            fx.boxin(data, modal);
            //console.log(data);

                     //This function prevents the submit butting in the form from sending the form data
                     //using the conventional  method of process.in.php, instead the form is sent to
                     //ajax.inc.php   
                        //fx.submitEventWithAjax();
          },
          error:function(data){

          }
        });
}
if ($('.dropdown').length>0) {
$('.dropdown-content a').on('click',function(e){
  e.preventDefault();
  $target=$(e.target);
if ($target.is("a:contains('Create Event')") /*&& ((window.location.pathname.match(pattern) !=null) ? true:false)*/) {
      
      createEvnt();
    }else if($target.is("a:contains('Edit Event')") || $target.is("a:contains('Delete Event')")){
      
      if (!$('#myModal').length>0) {
          $modal_bottom=$('<div id="myModal" class="modal-bottom">')
      }else{

        $modal_bottom=$('#myModal').css('display','block');
      }
     
var data='<div id="modal-bottom-content" class="modal-bottom-content">'+
         '<div class="modal-bottom-header">'+
         '<span class="close-bottom" >&times;</span>'+
         '<h2>Welcome To Event Management Center</h2>'+
         '</div>'+
         '<div class="modal-bottom-body">'+
         '<p><strong>Efficiently Manage Your Workflow With SEMS</strong></p>'+
'<p style="color:grey;">To Edit or Delete Events you previously created, simply click anywhere on the Calendar</p>'+
         '</div>'+
         /*'<div class="modal-bottom-footer">'+
         ' <h3>Modal Footer</h3>'+
         '</div>'+*/
         '</div>';

      $modal_bottom.append($(data));
      $('body').append($modal_bottom);


      $('.close-bottom, #myModal').on('click',function(e){
        //$('#modal-bottom-content').removeClass('modal-bottom-content');
           $('#myModal').fadeOut(1000);
        //$('#modal-bottom-content').addClass('slideOut');

            });
         if ($('.slideshow-container').length>0) {
            
          $('.slideshow-container').animate({
          
              }, 3000,function(){
                $('.slideshow-container').slideUp(6000,function(){
         
    });
              });
            }
       
    }else{

    }

document.querySelectorAll('a.active')[0].setAttribute('class','');
var oldClass=document.getElementById('manage').getAttribute('class');
document.getElementById('manage').setAttribute('class',oldClass+' active');
e.target.setAttribute('class', oldClass+'active');

});


}

/*Code below acts on the primary menu links*/
$( "a:contains('Calendar')" ).on('click',function(e){
  
   /* var pattern=/'index.php'/;
    var checkUrl=(window.location.pathname.match(pattern) ==null) ? true:false;*/
    if ($('.slideshow-container').length>0) {
            
          $('.slideshow-container').animate({
           height:"toggle"
  }, 600, function() {
/*    $('.slideshow-container').slideToggle(1000,function(){
        
    });*/

    // Animation complete.
  });
      }else{
        window.location.assign('index.php');
        
         setTimeout(function(){
          /*$('body').find('#content');*/
          var cal=document.getElementById('content').offsetTop;
         document.body.scrollTop=cal;
         document.documentElement.scrollTop=cal;
        },2000);
         
      }
   //alert(checkUrl);
if (calendarLinkStatus==false) {
//Make Calendar Link Active
document.querySelectorAll('a.active')[0].setAttribute('class','');
document.getElementById('calendar').setAttribute('class','active');
calendarLinkStatus=true;
}else if(calendarLinkStatus==true){
  document.querySelectorAll('a.active')[0].setAttribute('class','');
  document.getElementById('home').setAttribute('class','active');
  calendarLinkStatus=false;
}else;




});
$('#icon-bar a').on('click',function(e){
    
/*    $target=$(e.target);
    if ($target.is('a.active')) {
        return false;
    }
    $old_link=$('#icon-bar a.active');
    setTimeout(function(){
    $old_link.removeClass('active');

    },500);
    
    $target.addClass('active');*/

});


 
//Make a sticky Navigation bar
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("icon-bar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
    $('#content').css({
        "padding-top": "+240",
        "transition": "padding-top 0.6s ease"
    });
  } else {
    navbar.classList.remove("sticky");
    $('#content').css({
        "padding-top": "-240",
        "transition": "padding-top 0.6s ease"
    });
  }
}
//End of sticky Navigation bar


/*Code below is used in Navigating back to the top of the page.*/
/*window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        document.getElementById("goUpButton").style.display = "block";
    } else {
        document.getElementById("goUpButton").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    var position=document.body.scrollTop||document.documentElement.scrollTop;
    
    while(position>0){
        document.body.scrollTop = position;
        document.documentElement.scrollTop = position;
        position-=20;
    }
   
}*/
/*$('#goUpButton').on('click',function(e){
    topFunction();
});*/


$(window).scroll(function(){
        if ($(this).scrollTop() > 200) {
            $('#goUpButton').fadeIn();
        } else {
            $('#goUpButton').fadeOut();
        }
    });
    
    //Click event to scroll to top
    $('#goUpButton').click(function(){
        $('html, body').animate({scrollTop : 0},500);
        return false;
    });


//This code Zooms in a Modal Login Form
$( "a:contains('Log in')" ).on('click',function(e){
    e.preventDefault();
    $target=$(e.taget);
    $('#id01').css('display','block');
});
$( "a:contains('Register')" ).on('click',function(e){
    e.preventDefault();
    $target=$(e.taget);
    $('#id02').css('display','block');
});

$('span.close-login,button.cancelbtn').on('click',function(e){
   // $('.modal-content').removeClass('animate');
    $('.modal-content').addClass('antiAnimate');
    setTimeout(function(){
        $('#id01').css('display','none');
        $('#id02').css('display','none');
        $('.modal-content').removeClass('antiAnimate');
    },600);

});


});

