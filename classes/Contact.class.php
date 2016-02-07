<?php

/**
 * User class
 */

Class Contact
{
	public $errors;

	/**
	* This function will send email to SMTP user
	* @return Contact object
	*/

	public function sendFeedback($data)
	{

		$contact = new static();

		$contact->name = trim($data['name']);
		$contact->email = trim($data['email']);
		$contact->subject = trim($data['subject']);
		$contact->body = trim($data['message']);

		if ($contact->isValid()) {

		  // Send feedback email
		  Mail::send($contact->name, $contact->email, $contact->subject, $contact->body);
		}

		return $contact;
	}


	/**
	* Validate the properties and set $this->errors if any are invalid
	*
	* @return boolean  true if valid, false otherwise
	*/

	public function isValid()
	{
		$this->errors = [];

		//
		// name
		//
		if ($this->name == '') {
		  $this->errors['name'] = 'Please enter a valid name';
		}

		//
		// email address
		//
		if (filter_var($this->email, FILTER_VALIDATE_EMAIL) === false) {
		  $this->errors['email'] = 'Please enter a valid email address';
		}

		//
		// subject
		//
		if ($this->subject == '') {
		  $this->errors['subject'] = 'Please enter a subject';
		}

		//
		// body
		//
		if ($this->body == '') {
		  $this->errors['body'] = 'Please enter a message';
		}	    

		return empty($this->errors);
	}
}