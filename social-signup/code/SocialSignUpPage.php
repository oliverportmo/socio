<?php
class SocialSignUpPage extends Page {

	private static $db = array(
		'LoggedInTitle' => 'Varchar',
		'LoggedInMenuTitle' => 'Varchar',
		'SubDomain' => 'Varchar',
		'PublicKey' => 'Varchar',
		'PrivateKey' => 'Varchar'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', new TextField('LoggedInTitle','Page name when logged in'), 'URLSegment');
		$fields->addFieldToTab('Root.Main', new TextField('LoggedInMenuTitle','Navigation label when logged in'), 'Content');

		$fields->addFieldToTab('Root', new Tab('OneAll'));
		$fields->addFieldToTab('Root.OneAll', new TextField('SubDomain','Subdomain'));
		$fields->addFieldToTab('Root.OneAll', new TextField('PublicKey','Public Key'));
		$fields->addFieldToTab('Root.OneAll', new TextField('PrivateKey','Private Key'));

		return $fields;
	}

	public function Title() {

		if(Member::currentUser()) {

			return ($this->LoggedInTitle ? $this->LoggedInTitle : $this->Title);

		} else {

			return $this->Title;
		}

	}

	public function MenuTitle() {

		if(Member::currentUser()) {

			return ($this->LoggedInMenuTitle ? $this->LoggedInMenuTitle : $this->MenuTitle);

		} else {
			return $this->Title;
		}

	}

}

class SocialSignUpPage_Controller extends Page_Controller {

	private static $allowed_actions = array (
		'connected',
		'CompletionForm'
	);

	public function init() {
		parent::init();

		Requirements::set_write_js_to_body(false);
		Requirements::customScript("

 			var oneall_js_protocol = ((\"https:\" == document.location.protocol) ? \"https\" : \"http\");
			document.write(unescape(\"%3Cscript src='\" + oneall_js_protocol + \"://".$this->SubDomain.".api.oneall.com/socialize/library.js' type='text/javascript'%3E%3C/script%3E\"));

		");
	}

	public function connected() {

		if ( ! empty ($_POST['connection_token'])) {

			//Get connection_token
			$token = $_POST['connection_token'];

			 //Your Site Settings
			$site_subdomain = $this->SubDomain;
			$site_public_key = $this->PublicKey;
			$site_private_key = $this->PrivateKey;

			//API Access domain
			$site_domain = $site_subdomain.'.api.oneall.com';

			//Connection Resource
			//http://docs.oneall.com/api/resources/connections/read-connection-details/
			$resource_uri = 'https://'.$site_domain.'/connections/'.$token .'.json';

			//Setup connection
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $resource_uri);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_USERPWD, $site_public_key . ":" . $site_private_key);
			curl_setopt($curl, CURLOPT_TIMEOUT, 15);
			curl_setopt($curl, CURLOPT_VERBOSE, 0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
			curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_FAILONERROR, 0);

			//Send request
			$result_json = curl_exec($curl);

			//Error
			if ($result_json === false) {
				//You may want to implement your custom error handling here
			    echo 'Curl error: ' . curl_error($curl). '<br />';
			    echo 'Curl info: ' . curl_getinfo($curl). '<br />';
			    curl_close($curl);
			}
			//Success
			else {
				//Close connection
				curl_close($curl);

			    //Decode
			    $json = json_decode ($result_json);

			    //Extract data
			    $data = $json->response->result->data;

			    //Check for plugin
			    if ($data->plugin->key == 'social_login') {
			    	//Operation successfull
			      	if ($data->plugin->data->status == 'success') {

			      		//The token of the user that signed in/up using his social network account
			      		$user_token = $data->user->user_token;

				        // 1] Check if we have a userID for this token in our database

				        if ($member = Member::get()->where("\"Token\" = '$user_token'")->First()) {

				        	$member->login();

				        	Controller::redirect($this->Link());

				        }

				        else {

				        	//debug::show($data);
				        	$member = new Member();
        					$member->Email =  $data->user->user_token.'@'.$_SERVER['SERVER_NAME'].'.com' ;
        					$member->Password = 'Temp123'.$data->user->user_token;
        					//$member->Username = $data->user->identity->preferredUsername;
        					//$member->Provider = $data->user->identity->provider;
        					$member->Token = $data->user->user_token;
        					$member->Complete = false;
        					$member->write();

        					if($group = DataObject::get_one('Group', "\"Code\" = 'socialmembers'")) {

        						$member->Groups()->add($group);

        					} else {

        						$group = new Group();
        						$group->Title = 'Social Members';
        						$group->Description = "Members who signed up through Social Sign Up.";
        						$group->Code = 'socialmembers';
        						$group->write();

        						$member->Groups()->add($group);
        					}

        					$identity = new SocialIdentity();
        					$identity->Provider = $data->user->identity->provider;
							$identity->Token = $data->user->identity->identity_token;
							$identity->PreferredUsername = $data->user->identity->preferredUsername;
							$identity->write();

							$member->Identities()->add($identity);

       						$member->login();

       						Controller::redirect($this->Link());

				        }
					}
				} else {



					Controller::redirect($this->Link());

				}
			}
		}

	}

	public function CompletionForm() {

		Requirements::clear('framework/thirdparty/jquery/jquery.js');
		Requirements::javascript('framework/thirdparty/jquery/jquery.js');
		Requirements::javascript('framework/thirdparty/jquery-validate/jquery.validate.min.js');
		Requirements::customScript('
				jQuery(document).ready(function() {
					jQuery("#Form_CompletionForm").validate({
						rules: {
							FirstName: "required",
							Surname: "required",
							Email: {
								required: true,
								email: true
							}
						},
						messages: {
							FirstName: "required",
							Surname: "required",
							Email: "required"
						}
					});
				});
		');

		$member = Member::currentUser();

		if (strpos($member->Email,$_SERVER['SERVER_NAME']) !== false) {

			$memberEmail = '';

		} else {

			$memberEmail = $member->Email;
		}

		$fields = new FieldList(
				LiteralField::create('Complete','Please complete your profile.'),
				TextField::create('FirstName', 'Your First Name'),
				TextField::create('Surname', 'Your Last Name'),
				EmailField::create('Email', 'Your Email address')
		);

		$action = new FieldList(
				FormAction::create("complete")->setTitle("Complete")
		);

		$required = new RequiredFields(
				array('FirstName', 'Surname', 'Email')
		);

		$form = new Form($this, "CompletionForm", $fields, $action, $required);

		return $form;
	}

	public function complete($data, Form $form) {

		$member = Member::currentUser();

		if(Member::get()->where("\"Email\" = '{$data['Email']}' AND \"ID\" != '$member->ID' ")->First()) {

			$form->addErrorMessage("Email",'Sorry, that email address already exists. Please choose another.',"bad");
			Session::set("FormInfo.Form_CompletionForm.data", $data);
			return Controller::redirectBack();

		} elseif(!$data['FirstName'] || $data['FirstName'] == "") {

			$form->addErrorMessage("FirstName",'Please enter your First Name.',"bad");
			return Controller::redirectBack();

		} elseif(!$data['Surname'] || $data['Surname'] == "") {

			$form->addErrorMessage("Surname",'Please enter your Last Name.',"bad");
			return Controller::redirectBack();

		} else {

			$member->FirstName = $data['FirstName'];
			$member->Surname = $data['Surname'];
			$member->Email = $data['Email'];
			$member->Complete = 1;

			$member->write();

			Controller::redirect($this->Link());

		}
	}



}