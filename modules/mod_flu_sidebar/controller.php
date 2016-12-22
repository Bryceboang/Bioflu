<?php 

require_once dirname(__FILE__) . '/model.php';

$_GET['function']();

	function province() {
		$data = getprovince();
		echo json_encode($data);
	}

	function city() {
		$data = getcity($_POST['province_id']);
		echo json_encode($data);
	}

	function barangay() {
		$data = getbarangay($_POST['city_id']);
		echo json_encode($data);
	}

	function insert(){

		if ($_POST['fullname']=='') {
			$username = 'Anonymous';
		}else{
			$username = $_POST['fullname'];
		}
		
		$email = $_POST['email'];
		$contact = $_POST['contactnumber'];
		$province_id = $_POST['province'];
		$barangay_id = $_POST['barangay'];

		$fever = $_POST['fever'];
		$cold = $_POST['cold'];
		$ache = $_POST['ache'];
		$cough = $_POST['cough'];
		$number_of_symptoms = $_POST['number_of_symptoms'];


		insertdata($username, $email, $contact,  $barangay_id, $number_of_symptoms);
	}

function insert_symptoms(){
		$symptoms_id = $_POST['symptoms_id'];
		$user_id = $_POST['user_id'];


		insertdata_symptoms($symptoms_id, $user_id);
	}

	function getsymptoms() {
		$data = get_symptoms();
		echo json_encode($data);
	}

	function checkmail() {
		$email = $_POST['email'];
		$data = check_mail($email);
		echo count($data);
	}

 ?>