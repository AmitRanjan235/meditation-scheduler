<?php

require 'db-handler.php';


if (!isset($_REQUEST['action'])) {
	$msgbox = array('code' => '0', 'msg' => 'Paramters are not set!');
    echo json_encode($msgbox);

} else {

	$action = $_REQUEST['action'];

	$dbmanager = new DBHandler();

	switch(trim($action)){

        case 'drop':
            echo $dbmanager->dropdown_data();
            break;

    	case 'save':

    		if (!isset($_REQUEST['name']) || !isset($_REQUEST['date']) || !isset($_REQUEST['time'])) {
    			$msgbox = array('code' => '0', 'msg' => 'Paramters are not set!');
    			echo json_encode($msgbox);
    			break;
    		} else {
    			echo $dbmanager->insert_data($_REQUEST['name'], $_REQUEST['date'], $_REQUEST['time']);
    		}
    		break;

    	case 'fetch':
    		echo $dbmanager->fetch_data();
    		break;

        case 'delete':
            if (!isset($_REQUEST['id'])){
                $msgbox = array('code' => '0', 'msg' => 'Paramters are not set!');
                echo json_encode($msgbox);
                break;
            } else {
                echo $dbmanager->delete_data($_REQUEST['id']);
            }
            break;

        case 'toggle':
            if (!isset($_REQUEST['id'])){
                $msgbox = array('code' => '0', 'msg' => 'Paramters are not set!');
                echo json_encode($msgbox);
                break;
            } else {
                echo $dbmanager->toggle_data($_REQUEST['id']);
            }
            break;

        case 'edit':
            if (!isset($_REQUEST['id'])){
                $msgbox = array('code' => '0', 'msg' => 'Paramters are not set!');
                echo json_encode($msgbox);
                break;
            } else {
                echo $dbmanager->edit_data($_REQUEST['id']);
            }
            break;

        case 'update':
            if (!isset($_REQUEST['id']) || !isset($_REQUEST['name']) || !isset($_REQUEST['date']) || !isset($_REQUEST['time'])) {
                $msgbox = array('code' => '0', 'msg' => 'Paramters are not set!');
                echo json_encode($msgbox);
                break;
            } else {
                echo $dbmanager->update_data($_REQUEST['id'], $_REQUEST['name'], $_REQUEST['date'], $_REQUEST['time']);
            }
            break;
        default:
            $msgbox = array('code' => '0', 'msg' => 'Invalid Parameter!');
            echo json_encode($msgbox);
            break;

    }


}
