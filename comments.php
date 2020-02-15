<?php

if (!isset($_REQUEST['hn'])){
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

require_once('./model/Comments.php');

switch ($_REQUEST['hn']) {

	case 'post':

		$err = array();

		if (
			!isset($_POST['name']) || 
			!isset($_POST['email']) || 
			!isset($_POST['text'])
		){
			$err[] = 'Missing fields';
		}

		$name = trim($_POST['name']);
		$email = trim($_POST['email']);
		$text = trim($_POST['text']);

		if ($name == '') {
			$err[] = 'Name is required';
		}
		if ($email == '') {
			$err[] = 'Email is required';
		}
		if ($text == '') {
			$err[] = 'Text is required';
		}
	
		if (count($err) > 0) {
			if (count($err) == 1){
				$err_str = '&err[]=' . $err[0];
			} else {
				$err_str = implode('&err[]=', $err);
			}
			$err_str = '?err[]=' . substr($err_str, 0);
			header('Location:  index.php' . $err_str);
		}


		$comments = new Comments();
		if ($comments->insertComments($name, $email, $text)) {
			header('Location: ' . $_SERVER['HTTP_REFERER'] . '?succ[]=Comment is posted.');
		} else {
			header('Location: ' . $_SERVER['HTTP_REFERER'] . '?err[]=Something is wrong, try again');
		}
		break;

		case 'approved':

			$id = array_keys($_POST);
			$comments = new Comments();
			if ($comments->checkIfApproved($id[1])) {
				$approve_comm = $comments->approveComments($id[1]);
				if ($approve_comm) {
					header('Location: admin.php?succ[]=Comment is approved.');
				}
			} else{
				header('Location: admin.php?err[]=Comment is already approved');
			}

		break;
	default:
		# code...
		break;
}