<?php 

class Messages extends Database {
    public function loadMessagesContent($from_id, $name, $to_id, $user_role) {
        $conversation = new Conversation();
        if ($user_role === "admin") {
            $getConversation = $conversation->getConversation($from_id, $to_id);
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
            $output .= "<div class='w-100 d-flex flex-column' 
                             style='position: relative; 
                                    left: 0; 
                                    bottom: 0;'>";
            foreach ($getConversation as $convo) {
                if ($convo['role'] === "patient") {
                    $output .= "<div class='d-inline-flex w-100 justify-content-start h-auto'>";
                    $output .= "<img src='../img/default_user.png' 
                                class='img-thumbnail rounded-pill' 
                                style='max-width: 30px; 
                                max-height: 30px'>";
                    $output .= "<div class='d-flex flex-column w-75 ml-2'>";
                    $output .= "<div class='my-auto' style='text-align: left; word-wrap: break-word'>";
                    $output .= $convo['message'];
                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "</div>";
                } else {
                    $output .= "<div class='d-inline-flex w-100 justify-content-end h-auto'>";
                    $output .= "<div class='d-flex flex-column w-75 mr-2'>";
                    $output .= "<div class='my-auto' style='text-align: right; word-wrap: break-word'>";
                    $output .= $convo['message'];
                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "<img src='../img/default_user.png' 
                                class='img-thumbnail rounded-pill mr-2' 
                                style='max-width: 30px; 
                                       max-height: 30px;'>";
                    $output .= "</div>";
                }
            }
            $output .= "</div>";
            $output .= '</div>';
            $output .= '<div class="input-msg w-100 d-inline-flex py-2" style="height: 15%;">';
            $output .= '<textarea name="input-msg" 
                                id="input-msg-reply" 
                                class="form-control h-100" 
                                style="resize: none;
                                width: 90%;" 
                                placeholde="Enter your message..."></textarea>';
            $output .= '<button type="submit" 
                                class="btn btn-primary ml-1 text-center btn-sm" 
                                style="width: 10%;"
                                id="btn-reply"
                                data-from_id="'.$from_id.'"
                                data-to_id="'.$to_id.'">';
            $output .= '<i class="fa fa-paper-plane" aria-hidden="true"></i>';
            $output .= '</button>';
            $output .= '</div>';
            return $output;
        }
    }

    public function loadInsertMessagesContent($from_id, $name, $to_id, $user_role) {
        $conversation = new Conversation();
        if ($user_role === "admin") {
            $getConversation = $conversation->getConversation($from_id, $to_id);
            $output = "<div class='w-100 d-flex flex-column' 
                             style='position: relative; 
                                    left: 0; 
                                    bottom: 0;'>";
            foreach ($getConversation as $convo) {
                if ($convo['role'] === "patient") {
                    $output .= "<div class='d-inline-flex w-100 justify-content-start h-auto'>";
                    $output .= "<img src='../img/default_user.png' 
                                class='img-thumbnail rounded-pill' 
                                style='max-width: 30px; 
                                max-height: 30px'>";
                    $output .= "<div class='d-flex flex-column w-75 ml-2'>";
                    $output .= "<div class='my-auto' style='text-align: left; word-wrap: break-word'>";
                    $output .= $convo['message'];
                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "</div>";
                } else {
                    $output .= "<div class='d-inline-flex w-100 justify-content-end h-auto'>";
                    $output .= "<div class='d-flex flex-column w-75 mr-2'>";
                    $output .= "<div class='my-auto' style='text-align: right; word-wrap: break-word'>";
                    $output .= $convo['message'];
                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "<img src='../img/default_user.png' 
                                class='img-thumbnail rounded-pill mr-2' 
                                style='max-width: 30px; 
                                       max-height: 30px;'>";
                    $output .= "</div>";
                }
                $output .= "</div>";
            }
            return $output;
        }
    }

    public function loadMsgContent($from_id, $to_id, $user_role) {
        $conversation = new Conversation();
        if ($user_role === "admin") {
            $getConversation = $conversation->getConversation($from_id, $to_id);
            $output = "<div class='w-100 d-flex flex-column' 
                             style='position: relative; 
                                    left: 0; 
                                    bottom: 0;'>";
            foreach ($getConversation as $convo) {
                if ($convo['role'] === "patient") {
                    $output .= "<div class='d-inline-flex w-100 justify-content-start h-auto'>";
                    $output .= "<img src='../img/default_user.png' 
                                class='img-thumbnail rounded-pill' 
                                style='max-width: 30px; 
                                max-height: 30px'>";
                    $output .= "<div class='d-flex flex-column w-75 ml-2'>";
                    $output .= "<div class='my-auto' style='text-align: left; word-wrap: break-word'>";
                    $output .= $convo['message'];
                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "</div>";
                } else {
                    $output .= "<div class='d-inline-flex w-100 justify-content-end h-auto'>";
                    $output .= "<div class='d-flex flex-column w-75 mr-2'>";
                    $output .= "<div class='my-auto' style='text-align: right; word-wrap: break-word'>";
                    $output .= $convo['message'];
                    $output .= "</div>";
                    $output .= "</div>";
                    $output .= "<img src='../img/default_user.png' 
                                class='img-thumbnail rounded-pill mr-2' 
                                style='max-width: 30px; 
                                       max-height: 30px;'>";
                    $output .= "</div>";
                }
                $output .= "</div>";
            }
            return $output;
        } else {
            $getConversation = $conversation->getConversation($from_id, $to_id);
            $output = "";
            foreach ($getConversation as $convo) {
                if ($convo['role'] === "admin") {
                    $output .= "<li class='receiver'>";
                    $output .= '<i class="fa fa-user-circle-o" aria-hidden="true"></i>';
                    $output .= "<span>". $convo['message'] ."</span>";
                    $output .= "</li>";
                } else {
                    $output .= "<li class='sender'>";
                    $output .= '<i class="fa fa-user-circle-o" aria-hidden="true"></i>';
                    $output .= "<span>". $convo['message'] ."</span>";
                    $output .= "</li>";
                }
            }
            return $output;
        }
    }
}