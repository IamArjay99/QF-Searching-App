<?php 

    // This will include all the classes
    include_once '../includes/all.include.php';

    // Request Messages
    if (isset($_POST['queryRequestMessage'])) {
        $id = $_POST['queryRequestMessage']['id'];
        $name = $_POST['queryRequestMessage']['name'];
        $getRequest = $request->getRequest($id);
        if ($getRequest) {
            $output = '<div id="msg-header" 
                            class="text-left mb-0 pb-0 ml-2 pt-3" 
                            style="height: 10%; 
                                   width: 100%;">';
            $output .= "<h4>".$name."</h4>";
            $output .= '</div>';
            $output .= '<div id="msg-content" class="p-2"
                             style="height: 75%;
                                    width: 100%;
                                    overflow-y: scroll;
                                    position: relative;
                                    border: 1px solid lightgrey">';
            $output .= "<div class='w-100 d-flex flex-column my-2 pl-2' 
                             style='position: absolute; 
                             left: 0; 
                             bottom: 0;'>";
            $output .= "<h6 class='text-danger text-center'>---- Request Quarantine ----</h6>";
            $output .= "<div class='d-inline-flex'>";
            $output .= "<img src='../img/default_user.png' 
                             class='img-thumbnail rounded-pill' 
                             style='max-width: 30px; 
                                    max-height: 30px'>";
            $output .= "<div class='d-flex flex-column ml-2'>";
            foreach ($getRequest as $request) {
                $output .= "<div class='text-justify'>";
                $output .= $request['message'];
                $output .= "</div>";
            }
            $output .= "</div>";
            $output .= "</div>";
            $output .= "<div class='text-center'>";
            $output .= "<button class='btn btn-success mr-1 btn-accept'
                                data-id='".$id."'>Accept</button>";
            $output .= "<button class='btn btn-danger ml-1 btn-reject'
                                data-id='".$id."'>Reject</button>";
            $output .= "</div>";
            $output .= "</div>";
            $output .= '</div>';
            $output .= '<div class="input-msg w-100 d-inline-flex py-2" style="height: 15%;">';
            $output .= '<textarea name="input-msg" 
                                  id="input-msg" 
                                  class="form-control h-100" 
                                  style="resize: none;
                                         width: 90%;" 
                                  placeholde="Enter your message..."></textarea>';
            $output .= '<button type="submit" 
                                class="btn btn-primary" 
                                style="width: 10%;"
                                disabled>';
            $output .= '<i class="fa fa-paper-plane" aria-hidden="true"></i>';
            $output .= '</button>';
            $output .= '</div>';
            echo $output;
        } else {
            echo "failed";
        }
    }

    // Accept Messages
    if (isset($_POST['queryAcceptMessage'])) {
        $id = $_POST['queryAcceptMessage']['id'];
        $user_id = $_POST['queryAcceptMessage']['user_id'];
        $user_role = $_POST['queryAcceptMessage']['user_role'];
        $updateRequest = $request->updateRequest($id);
        if ($updateRequest) {
            $getRequest = $request->getRequest($id);
            $messages = "";
            foreach ($getRequest as $request) {
                $messages .= $request['message']."\n";
            }
            $insertNewConversation = $conversation->insertNewConversation($id, $user_id, $messages);
            if ($insertNewConversation) {
                echo "success";
            } else {
                echo "failed";
            }
        } else {
            echo "failed";
        }
    }

    // Reject Messages
    if (isset($_POST['queryRejectMessage'])) {
        $id = $_POST['queryRejectMessage']['id'];
        $user_id = $_POST['queryRejectMessage']['user_id'];
        $user_role = $_POST['queryRejectMessage']['user_role'];
        $updateRequestRejected = $request->updateRequestRejected($id);
        if ($updateRequestRejected) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
        switch ($action) {
            case "loadMessages":
                $from_id = $_REQUEST['id'];
                $name = $_REQUEST['name'];
                $to_id = $_REQUEST['user_id'];
                $user_role = $_REQUEST['user_role'];
                $loadMessagesContent = $messages->loadMessagesContent($from_id, $name, $to_id, $user_role);
                echo $loadMessagesContent;
                break;
            default:
                echo "Not load message";
                break;
        }
    }

    if (isset($_POST['querySendMessage'])) {
        $from_id = $_POST['querySendMessage']['from_id'];
        $to_id = $_POST['querySendMessage']['to_id'];
        $user_role = $_POST['querySendMessage']['user_role'];
        $message = $_POST['querySendMessage']['message'];
        $name = $_POST['querySendMessage']['name'];
        $insertMessage = $conversation->insertMessage($from_id, $to_id, $user_role, $message);
        if ($insertMessage) {
            $loadInsertMessagesContent = $messages->loadInsertMessagesContent($from_id, $name, $to_id, $user_role);
            echo $loadInsertMessagesContent;
        } else {
            echo "failed";
        }
    }

    if (isset($_POST['queryMsgContent'])) {
        $from_id = $_POST['queryMsgContent']['from_id'];
        $to_id = $_POST['queryMsgContent']['to_id'];
        $user_role = $_POST['queryMsgContent']['user_role'];
        $loadMsgContent = $messages->loadMsgContent($from_id, $to_id, $user_role);
        if ($loadMsgContent) {
            echo $loadMsgContent;
        } else {
            echo "failed";
        }
    }

    if (isset($_POST['queryPatientLoadMessage'])) {
        $from_id = $_POST['queryPatientLoadMessage']['from_id'];
        $to_id = $_POST['queryPatientLoadMessage']['to_id'];
        $role = $_POST['queryPatientLoadMessage']['role'];
        $getPatientConversation = $conversation->getPatientConversation($from_id, $role);
        if ($getPatientConversation) {
            $loadMsgContent = $messages->loadMsgContent($from_id, $to_id, $role);
            echo $loadMsgContent;
        } else {
            echo "<li style='text-align: center; color: red'>Your message is still processing</li>";
        }
    }

    if (isset($_POST['queryPatientSendMessage'])) {
        $from_id = $_POST['queryPatientSendMessage']['from_id'];
        $to_id = $_POST['queryPatientSendMessage']['to_id'];
        $role = $_POST['queryPatientSendMessage']['role'];
        $message = $_POST['queryPatientSendMessage']['message'];
        $insertMessage = $conversation->insertMessage($from_id, $to_id, $role, $message);
        if ($insertMessage) {
            $loadMsgContent = $messages->loadMsgContent($from_id, $to_id, $role);
            echo $loadMsgContent;
        } else {
            echo "failed";
        }
    }

    