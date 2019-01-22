<?php

/**
* 
*/

class Calendar extends DB_Connect
{

	private $_useDate;
	private $_startDay;
	private $_daysInMonth;
	private $_m;
	private $_y;
	
	




	
	function __construct($dbo=NULL, $useDate=NULL)
	{
		
		parent::__construct($dbo);
        //date_default_timezone_set('Africa/Lagos');
		if ( isset($useDate) ) {             
			$this->_useDate = $useDate;        
		}else{              
			$this->_useDate = date('Y-m-d H:i:s');         
		} 
		
        /*          
        * Convert to a timestamp, then determine the month          
        * and year to use when building the calendar          
        */         
        $ts = strtotime($this->_useDate);         
        $this->_m = date('m', $ts);        
        $this->_y = date('Y', $ts); 
        
        /*          
        * Determine how many days are in the month          
        */         
        $this->_daysInMonth = cal_days_in_month(                
        	CAL_GREGORIAN,                 
        	$this->_m,                  
        	$this->_y            
        ); 

        /*         
         * Determine what weekday the month starts on         
          */         
        $ts = mktime(0, 0, 0, $this->_m, 1, $this->_y);         
        $this->_startDay = date('w', $ts);     

    } 
    



   private function _loadEventData($id=NULL){ 
    	$sql = "SELECT event_id, event_title, event_desc, event_start, event_end, user_name, event_type, event_venue
    	FROM `php-jquery_example`.`events`"; 
    	if ( !empty($id) ){            
    		$sql .= "WHERE `event_id`=:id LIMIT 1";         
    	}else{

    		$start_ts = mktime(0, 0, 0, $this->_m , 1, $this->_y);  //Get specified date in EPOC time format           
    		$end_ts = mktime(23, 59, 59, $this->_m+1, 0, $this->_y); //Get last day of the month in EPOC time format            
    		$start_date = date('Y-m-d H:i:s', $start_ts);     //return formated date e.g: 2018-01-21 11:56:03        
    		$end_date = date('Y-m-d H:i:s', $end_ts); 
            
            if(isset($_SESSION['user'])){
                $userDetails=$_SESSION['user']['name'];
                $sql .= "WHERE (`event_start` BETWEEN '$start_date' AND '$end_date' )";
                $sql.="AND `user_name`='$userDetails' ORDER BY `event_start`";
            }else{
                 $sql .= "WHERE `event_start`";
                 $sql.="BETWEEN '$start_date' AND '$end_date'                     
                    ORDER BY `event_start`";
            }
    		   

    	} 


    	try {             
    		$stmt = $this->db->prepare($sql); 

            /*             
             * Bind the parameter if an ID was passed              
             */ 

            if ( !empty($id) ){                 
            	$stmt->bindParam(":id", $id, PDO::PARAM_INT);             
            } 

            $stmt->execute();             
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);   //convert Fetched rows into an associated array     
            $stmt->closeCursor(); 

            return $results;         
        }catch ( Exception $e ){             
        	die ( $e->getMessage() );         
        }     
    } 

/*
*  _createEventObj() is used in   
*  Transformation of _loadEventData()::$results array into object 
*
*/
    private function _createEventObj() { 
    	$arr=$this->_loadEventData();
/*echo var_dump($arr);*/

    	$events = array();         
    	foreach ( $arr as $event ){             
    		$day = date('j', strtotime($event['event_start'])); 

    		try{                 
    			$events[$day][] = new Event($event);   //Most tricky part => Creating our object Model  

    			/* The above $events array maybe understood like this
			$events= array(
				$day => array(
					new Event(),
					new Event, etc
				)
			)
    			                  */

    		} catch ( Exception $e ){                
    			die ( $e->getMessage() );             
    		}         
    	}         

    	return $events;     
    	
    } 


    public function buildCalendar(){
    $eResults=$this->_createEventObj();
   // var_dump($eResults);        

    if (isset($_POST['month'])) {
       // echo $_POST['month'];
       $seltime = mktime(0, 0, 0, $_POST['month'] , $_POST['day'], $_POST['year']); 
        $this->_useDate=date('Y-m-d',$seltime);
    }
 	/*          
 	* Determine the calendar month and create an array of          
 	* weekday abbreviations to label the calendar columns          
 	*/         
 	$cal_month = date('F Y', strtotime($this->_useDate));  
    $cal_id = date('Y-m', strtotime($this->_useDate)); //returns something like 2018-02
    $cal_yr=date('Y',strtotime($this->_useDate));
    $cal_mon_yr=date('F',strtotime($this->_useDate));     
 	$weekdays = array('Sun', 'Mon', 'Tue','Wed', 'Thu', 'Fri', 'Sat'); 
 	
        /*         
        * Add a header to the calendar markup          
        */         
       // $html = "\n\t<h2 id=\"month-$cal_id\">$cal_month</h2><div id=\"wrapper\">";
        $html = "\n\t<h2 id=\"month-$cal_id\"><span id='month'>$cal_mon_yr</span> <span id='year'>$cal_yr</span></h2><div id=\"wrapper\">";         
        for ( $i=0, $labels=NULL; $i<7; $i++ ){             
        	$labels .= "\n\t\t<li>" . $weekdays[$i] . "</li>";         
        }         
        $html .= "\n\t<ul class=\"weekdays\">". $labels . "\n\t</ul>"; 

        $events = $this->_createEventObj();

         $html .= "\n\t<ul>"; // Start a new unordered list        
         $list='';
         $event_info=NULL;
         $c=1; 
         $i=1;
         $t=date('j'); 
         $m=date('m'); 
         $y=date('Y');
         for ( ;$c<=$this->_daysInMonth; ++$i){   

         	$class = $i<=$this->_startDay ? "fill" : NULL; 
            //Add .today class to <li> day found to be todays's date
         	if ( $c/*+1*/==$t && $m==$this->_m && $y==$this->_y ){                
         		$class = "today";           
         	} 
            //Add .sundays class to <li> days found to be sundays
         	if ($i%7==1) {
         		$class.=' sundays';
         	}
            //Add .saturdays class to <li> days found to be saturdays
         	if ($i%7==0) {
         		$class.=' saturdays';
         	}
         	$ls = sprintf("\n\t\t<li class=\"%s\">", $class); 
         	$le = "\n\t\t</li>";


         	if ( $i>$this->_startDay/*$this->_startDay<$i*/ && $c<=$this->_daysInMonth){ 
         		$event_info = NULL;
         		if ( isset($events[$c]) ){                     
         			foreach ( $events[$c] as $event ){   
                    //var_dump($event);                      
         				$link = '<a href="view.php?event_id=' . $event->id . '">' . $event->title. '</a>';                         
         				$event_info .= "\n\t\t\t$link";                     
         			}                 
         		} 

         		$date = sprintf("\n\t\t\t<strong>%02d</strong> ",$c); 

         		$c++;   

         	}else { 
         		$date="&nbsp;"; 
         	} 

            //End each week with </u> and start a new week using <ul>
         	$wrap = ($i!=0 && $i%7==0) ? "\n\t</ul>\n\t<ul>" : NULL; 

         	//$html .= $ls . $date . $le . $wrap; 
         	$list.=$ls . $date .$event_info. $le . $wrap; 






         }  // End of for loop



         $html.=$list;
         while ( $i%7!=1 ){     

         	$html .= "\n\t\t<li class=\"fill\">&nbsp;</li>";             
         	++$i;         
         } 

 /*          
 * Close the final unordered list          
 */         
 $html .= "\n\t</ul></div>\n\n"; 


 $admin = $this->_adminGeneralOptions(); 
 /* 
 This function was used in adding an "Add New Event"  button and "Logout" 
 button to the calendar's index.php view if the user is logged in
*/

 return $html.$admin;     


}


private function _loadEventById($id){


	if ( empty($id) ) {             

		return NULL;         

	} 

	/*          * Load the events info array          */         
	$event = $this->_loadEventData($id); 

	if ( isset($event[0]) ) {             

		return new Event($event[0]);         
	}else{             
		return NULL;         
	}   


}

public function displayEvent($id) {         
 	/*          
 	* Make sure an ID was passed          
 	*/         
 	if ( empty($id) ) { return NULL; } 

 	/*          * Make sure the ID is an integer          */        
 	$id = preg_replace('/[^0-9]/', '', $id); 

 	/*          * Load the event data from the DB          */         
 	$event = $this->_loadEventById($id); 

        //If else condition added by turnyur Siy to check for null results from database
//echo var_dump($event);
    if (!$event==null) {
        /*          * Generate strings for the date, start, and end time          */         
    $ts = strtotime($event->start);         
    $date = date('F d, Y', $ts);         
    $start = date('g:ia', $ts);         
    $end = date('g:ia', strtotime($event->end)); 
    $event_type=strtoupper($event->event_type);
    $event_venue=$event->event_venue;
         $admin = $this->_adminEntryOptions($id);  //Used in adding Edit and Delete button to view.php

    /*          * Generate and return the markup          */        
    $html= "<h2>$event->title</h2>"."\n\t<p class=\"dates\">$date, $start&mdash;$end</p>"
    . "\n\t<p class='desc'>$event->description</p><p><b>Event Type: $event_type</b></p>
    <p><b>Venue: $event_venue</b></p>$admin";   //HTML markup returned by _adminEntryOptions is appended here   
    return $html;


    }else {
        header("Location: ./");
    }
 	

 } 
 


 public function displayForm(){ 

 	/*          * Check if an ID was passed          */         
 	if ( isset($_POST['event_id']) ){             
   $id = (int) $_POST['event_id'];                 // Force integer type to sanitize data         
}else{             
	$id = NULL;        
} 
//$id=2;
/*          * Instantiate the headline/submit button text          */         
$submit = "Create New Event"; 

/*          * If an ID is passed, loads the associated event          */         
if ( !empty($id) ){             
	$event = $this->_loadEventById($id); 

	/*              * If no object is returned, return NULL              */             
	if ( !is_object($event) ) { return NULL; } 

	$submit = "Edit Event"; 

 } else{

    //Below Code was instantiated just to fix error popping up because of use of undefined variables
    //By Turnyur Siy
    $undefined_variable_fix=array('event_id'=>'',
        'event_title'=>'','event_desc'=>'',
        'event_start'=>'','event_end'=>'', 'event_type'=>'','event_venue'=>'');
    $event=new Event($undefined_variable_fix);


    
 

 }





 //echo $_SESSION[token];

        /*          * Build the markup          */     

return /*<<<FORM_MARKUP */
	"<div class='form_title'>$submit</div>". 
    "<form action='assets/inc/process.inc.php' method='post' class='edit-form'>".        
     "<fieldset> ".            
     "<legend>$submit</legend>".             
     "<label for='event_title'>Event Title</label> ".            
     "<input type='text' name='event_title' id='event_title' value='$event->title' />  ".   
    "<div class='custom-select'>".
    "<select name='eventType'>".
         "<option value='General'>Select Event</option>". 
        "<option value='birthday'>Birthday</option>". 
        "<option value='wedding' selected>Wedding</option>".
        "<option value='vacation'>Vacation</option>".
        "<option value='party'>Party</option>". 
        "<option value='workshop'>Seminar</option>".
        "<option value='orientation'>Orientation</option>".
    "</select>".  
    "</div>".
    "<label for='event_venue'>Event Venue</label> ".            
     "<input type='text' name='event_venue' id='event_venue' value='$event->event_venue' />  ".       
     "<label for='event_start'>Start Time</label> ".            
     "<input type='text' name='event_start' id='event_start' value='$event->start' />".             
     "<label for='event_end'>End Time</label> ". 
     "<input type='text' name='event_end' id='event_end' value='$event->end' />  ".           
     "<label for='event_description'>Event Description</label> ". 
     "<textarea name='event_description' id='event_description'>$event->description</textarea>".     


     "<input type='hidden' name='event_id'value='$event->id' />".            
      "<input type='hidden' name='token' value='$_SESSION[token]' /> ".            
      "<input type='hidden' name='action' value='event_edit' /> ".            
      "<input type='submit' name='event_submit' value='$submit' /> ".           
       "or <a class='cancel' href='./'>Cancel</a>".         
       "</fieldset> ".    
       "</form> "
/*FORM_MARKUP*/;     

        
   } 
 
 private function _validDate($string){
     $pattern="/^(\d{4}(-\d{2}){2} \d{2}(:\d{2}){2})$/";
     return preg_match($pattern, $string)==1? TRUE:FALSE;
 }


 public function processForm(){

 	/*          * Exit if the action isn't set properly          */         
 	if ( $_POST['action']!='event_edit' ){             
 		return "The method processForm was accessed incorrectly";         
 	} 
 
        /*          * Escape data from the form          */         
        $title = htmlentities($_POST['event_title'], ENT_QUOTES); 
        $eventType= htmlentities($_POST['eventType'], ENT_QUOTES);        
        $desc = htmlentities($_POST['event_description'], ENT_QUOTES);         
        $start = htmlentities($_POST['event_start'], ENT_QUOTES);         
        $end = htmlentities($_POST['event_end'], ENT_QUOTES); 
        $venue = htmlentities($_POST['event_venue'], ENT_QUOTES); 
 
        if (!$this->_validDate($start) || !$this->_validDate($end)) {
            return "invalid Date Format use YYYY-MM-DD HH:MM:SS";
        }


        /*          * If no event ID passed, create a new event          */         
        if ( empty($_POST['event_id']) ){            
        	$sql = "INSERT INTO `events` 
        	(`event_title`, `event_desc`, `event_start`,`event_end`,`user_name`,`event_type`, `event_venue`)  
        	VALUES(:title, :description, :start_time, :end_time, :userDetails, :eventType, :eventVenue)";         
         
 
/*          * Update the event if it's being edited          */         
}else         {             
	/*              * Cast the event ID as an integer for security              */             
	$id = (int) $_POST['event_id'];             
	$sql = "UPDATE `events` 
	SET `event_title`=:title, `event_desc`=:description,`event_start`=:start_time,`event_end`=:end_time , `user_name`=:userDetails, `event_type`=:eventType, `event_venue`=:eventVenue                    
	WHERE `event_id`=$id";         
} 
 
        /*          * Execute the create or edit query after binding the data          */         
        try{             
        	$stmt = $this->db->prepare($sql);             
        	$stmt->bindParam(":title", $title, PDO::PARAM_STR);             
        	$stmt->bindParam(":description", $desc, PDO::PARAM_STR);             
        	$stmt->bindParam(":start_time", $start, PDO::PARAM_STR);             
            $stmt->bindParam(":end_time", $end, PDO::PARAM_STR);   
            $stmt->bindParam(":userDetails", $_SESSION['user']['name'], PDO::PARAM_STR);   
            $stmt->bindParam(":eventType", $eventType, PDO::PARAM_STR);   
        	$stmt->bindParam(":eventVenue", $venue, PDO::PARAM_STR);   


        	$stmt->execute();             
        	$stmt->closeCursor();             
        	//return TRUE;
            return $this->db->lastInsertId(); 
        } catch ( Exception $e ){            
        	return $e->getMessage();         
        }     
    }

 private function _adminGeneralOptions() {         /*          * Display admin controls          */  
 	if(isset($_SESSION['user'])){
 			//Used in adding "Add a New Event" button to index.php
 		return "<div id='admin-link'><a href=\"admin.php\" class=\"admin\">+ Add a New Event</a></div>".  
//Used in Adding Logout button to index.php
 	"<form action='assets/inc/process.inc.php' method='post'>".         
 	"<div id='log_out'><input type='submit' value='Log Out' class='admin' /> ".            
 	"<input type='hidden' name='token' value='$_SESSION[token]' /> ".            
 	"<input type='hidden' name='action' value='user_logout' /></div> ".    
 	"</form>";   

 	}  else{

 		 return '<a href="login.php?action=log-in"><strong>Log in</strong></a>'. 
         ' | <a href="login.php?action=register"><strong>Register</strong></a>'; //Used in adding Log In button to index.php
 	}     
 	
} 

 private function _adminEntryOptions($id){

      if(isset($_SESSION['user'])){    
 	return /*<<<ADMIN_OPTIONS */
 	//Used in adding Edit button to view.php
    "<div class='admin-options'><form action='admin.php' method='post'>".
    "<p><input type='submit' name='edit_event' value='Edit Event' />".             
    "<input type='hidden' name='event_id' value='$id' /> </p>".     
    "</form>".

    //Used in adding delete button to view.php
     "<form action='confirmdelete.php' method='post'> <p>".
     "<input type='submit' name='delete_event' value='Delete Event' /> ".            
     "<input type='hidden' name='event_id' value='$id' />".
     "</p></form> </div><!-- end .admin-options -->";  
/* ADMIN_OPTIONS;*/     
}  else{

		 return NULL; 
	}
} 


 public function confirmDelete($id)     {         
 	/*          * Make sure an ID was passed          */         
 	if ( empty($id) ) { return NULL; } 
 
        /*          * Make sure the ID is an integer          */         
        $id = preg_replace('/[^0-9]/', '', $id); 
 
        /*          
        * If the confirmation form was submitted and the form          
        * has a valid token, check the form submission          
        */         
        if ( isset($_POST['confirm_delete']) && $_POST['token']==$_SESSION['token'] ) {             
        	/*              
        	* If the deletion is confirmed, remove the event              
        	* from the database              
        	*/             
        	if ( $_POST['confirm_delete']=="Yes, Delete It" ){                 
        		$sql = "DELETE FROM `events`                 
        		 WHERE `event_id`=:id 
        		  LIMIT 1";                 
        		  try {                     
        		  	$stmt = $this->db->prepare($sql);                     
        		  	$stmt->bindParam(":id", $id, PDO::PARAM_INT);                    
        		  	$stmt->execute();                     
        		  	$stmt->closeCursor();                     
        		  	header("Location: ./");                     
        		  	return;                 
        		  }catch ( Exception $e ){                     
        		  	return $e->getMessage();                 
        		  }            
        		} 
 
            /*              * If not confirmed, sends the user to the main view              */             
            else {                 
            	header("Location: ./");                 
            	return;             
            }         
        } 
 
        /*          * If the confirmation form hasn't been submitted, display it          */         
        $event = $this->_loadEventById($id); 
 
        /*          * If no object is returned, return to the main view          */         
        if ( !is_object($event) ) { header("Location: ./"); } 
 
        return /*<<<CONFIRM_DELETE*/ 
    "<form action='confirmdelete.php' method='post'>".
    "<h2>Are you sure you want to delete '$event->title'? </h2> ".        
    "<p>There is <strong>no undo</strong> if you continue.</p> ".        
    "<p><input type='submit' name='confirm_delete' value='Yes, Delete It' /> ".            
    "<input type='submit' name='confirm_delete'  value='No' />".             
    "<input type='hidden' name='event_id' value='$event->id' /> ".            
    "<input type='hidden' name='token' value='$_SESSION[token]' />".
    "</p><form> ";
/*CONFIRM_DELETE; */    
} 
 
 //Function created by Turnyur Siy Williams
//This function was used in making clicking on any day on index.php popup 
//a modal making creating new Events easy
 public function modifiedCreate(){
$submit = "Create Event";
    $undefined_variable_fix=array('event_id'=>'',
        'event_title'=>'','event_desc'=>'',
        'event_start'=>'','event_end'=>'','event_type'=>'', 'event_venue'=>'');
    $event=new Event($undefined_variable_fix);

/*
Process the day the user clicked on, making date insertion on start day and end day easier

*/

if ($_POST['day']!=32) {
   // echo $_POST['year'];
    //$epoc_time=strtotime($this->_useDate);
    $st=mktime(date("H"),date("i"),date("s"),$this->_m,$_POST['day'],$this->_y);
    $et=mktime(23,59,59,$this->_m,$_POST['day'],$this->_y);
    $start_day=date('Y-m-d H:s:i', $st);
    $end_day=date('Y-m-d H:s:i',$et);
}else{
    $start_day='';
    $end_day='';
}    
    return /*<<<FORM_MARKUP */
    "<div class='form_title'>$submit</div>". 
    "<form action='assets/inc/process.inc.php' method='post' class='edit-form'>".        
     "<fieldset> ".            
     "<legend>$submit</legend>".             
     "<label for='event_title'>Event Title </label> ".            
     "<input type='text' name='event_title' id='event_title' value='$event->title' />  ".    
    "<div class='custom-select'>".
    "<select name='eventType'>".
        "<option value='General'>Select Event</option>". 
        "<option value='birthday'>Birthday</option>". 
        "<option value='wedding'>Wedding</option>".
        "<option value='vacation'>Vacation</option>".
        "<option value='party'>Party</option>". 
        "<option value='workshop'>Seminar</option>".
        "<option value='orientation'>Orientation</option>".
    "</select>".  
    "</div>".
    "<label for='event_venue'>Event Venue</label> ".            
     "<input type='text' name='event_venue' id='event_venue' value='$event->event_venue' />  ".   
     "<label for='event_start'>Start Time</label> ".            
     "<input type='text' name='event_start' id='event_start' value='$start_day' />".             
     "<label for='event_end'>End Time</label> ". 
     "<input type='text' name='event_end' id='event_end' value='$end_day' />  ".           
     "<label for='event_description'>Event Description</label> ". 
     "<textarea name='event_description' id='event_description'>$event->description</textarea>".     


     "<input type='hidden' name='event_id'value='$event->id' />".            
      "<input type='hidden' name='token' value='$_SESSION[token]' /> ".            
      "<input type='hidden' name='action' value='event_edit' /> ".            
      "<input type='submit' name='event_submit' value='$submit' /> ".           
       "or <a href='./'>Cancel</a>".         
       "</fieldset> ".    
       "</form> "
/*FORM_MARKUP*/;  



 }



}

?>