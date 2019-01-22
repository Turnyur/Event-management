
<?php

/**
* This class defines our data model.
* It was used in transforming database results gotten from our php-jquery_example
*/
class Event
{
	public $id;
	public $title;
	public $description;
	public $start;
	public $end;
	public $event_type;
	public $event_venue;



	public function __construct($event){         
		if ( is_array($event) ){             
			$this->id = $event['event_id'];             
			$this->title = $event['event_title'];             
			$this->description = $event['event_desc'];             
			$this->start = $event['event_start'];             
			$this->end = $event['event_end'];  
			$this->event_type = $event['event_type']; 
			$this->event_venue = $event['event_venue']; 
			 

		}else{             
			throw new Exception("No event data was supplied.");         
		}   





}



}


?>


















