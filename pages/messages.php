<?php 
    include '../layouts/d-layout.php';
?>

<?php startblock('another_css') ?>
<?php endblock() ?>

<?php startblock('main_content') ?>
    <main class="messages-main" id="content">
        <article>
        <?php if ($user_role !== "admin") { ?>
            <div class="messages-box">
                <div class="messages-names">
                    <ul>
                        <li>
                            <a href="#" class="patient">
                                <i class="fa fa-user-circle" aria-hidden="true"></i> <span>AD Quarantine Corp.</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="messages-conversation">
                    <div class="conversation">
                        <ul id="conversation-list"></ul>
                    </div>
                    <div class="text-button">
                        <textarea name="message" id="input-msg-patient-reply" placeholder="Type message..."></textarea>
                        <?php
                            $getPatientConversation = $conversation->getPatientConversation($user_id, $user_role);
                            if (count($getPatientConversation) > 0) {
                        ?>
                            <button type="button" id="btn-reply-patient" ><i class="fa fa-paper-plane" aria-hidden="true"></i></button>      
                        <?php } else { ?>
                            <button type="button" id="btn-reply-patient" disabled><i class="fa fa-paper-plane" aria-hidden="true"></i></button>  
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="messages-box">
                <div class="messages-names">
                    <ul>
                    <?php 
                        $getAllConversation = $conversation->getAllConversation($data['id']);
                            foreach($getAllConversation as $convo) {
                                $from_id = $convo['from_id'];
                                $getPatient = $patients->getPatient($from_id);
                                $fullname = $getPatient['fullname'];
                                $timestamp = $convo['created_at'];
                                $user_id = $data['id'];
                                $user_role = $data['role'];
                                $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                                $cmpstr = "user_id=".$from_id."&name=".$fullname;
                                $cmpstr = str_replace(" ", "%20", $cmpstr);
                                if (strpos($url, $cmpstr) !== false) {
                                    $class = "active";
                                } else {
                                    $class = "inactive";
                                }
                                $output = "<li style='border-bottom: 1px solid grey' class='".$class."'>";
                                $output .= "<a href='messages.php?user_id=".$from_id."&name=".$fullname."' style='text-decoration: none; color: white'>";
                                $output .= '<i class="fa fa-user-circle" aria-hidden="true"></i>';
                                $output .= "<span>";
                                $output .= $fullname ."<br>";
                                $output .= "<small style='font-size: .8rem'>" .date("M d, Y - h:mA" ,strtotime($timestamp)). "</small>";
                                $output .= "</span></a>";
                                $output .= "</li>";
                                echo $output;
                            }
                        ?>
                    </ul>
                </div>
                <div class="messages-conversation">
                <?php if (isset($_GET['user_id'])) { ?>
                    <div class="conversation">
                        <div class="converstaion-name">
                        <?php 
                            $getPatient = $patients->getPatient($_GET['user_id']);
                            echo "<span>".$getPatient['fullname']."</span>";
                        ?>
                        </div>
                        <ul id="conversation-list-admin">
                        <?php 
                            $getConversation = $conversation->getConversation("1", $_GET['user_id']);
                            foreach ($getConversation as $convo) {
                                $output = "";
                                if ($convo['role'] === "admin") {
                                    $output .= "<li class='sender'>";
                                    $output .= '<i class="fa fa-user-circle-o" aria-hidden="true"></i>';
                                    $output .= "<span>". $convo['message'] ."</span>";
                                    $output .= "</li>";
                                } else {
                                    $output .= "<li class='receiver'>";
                                    $output .= '<i class="fa fa-user-circle-o" aria-hidden="true"></i>';
                                    $output .= "<span>". $convo['message'] ."</span>";
                                    $output .= "</li>";
                                }
                                echo $output;
                            }
                        ?>
                        </ul>
                    </div>
                    <div class="text-button">
                        <textarea name="message" id="input-msg-admin-reply" placeholder="Type message..."></textarea>
                        <button type="button" id="btn-reply-admin" data-name="<?= $_GET['name'] ?>" data-from_id="1" data-to_id="<?= $_GET['user_id'] ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>  
                    </div>
                <?php } ?>
                </div>
            </div>
            <div class="footer">
                <?php 
                    $getAllRequest = $request->getAllRequest();
                    $countRequest = count($getAllRequest);
                ?>
                <a href="request-messages.php">Request Messages (<?= $countRequest ?>)</a>
            </div>
        <?php } ?>
        </article>
    </main>
<?php endblock() ?>

<?php startblock('another_js') ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const from_id = "<?= $user_id ?>";
            const to_id = "1";
            const role = "<?= $user_role ?>";

            const loadPatientMsg = () => {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-messages.php",
                    data: { queryPatientLoadMessage: { from_id, to_id, role } },
                    success: function (data) {
                        $("#conversation-list").html(data);
                    },
                });
            };
            
            $("#btn-reply-patient").click(function () {
                const message = $("#input-msg-patient-reply").val();
                if (message === "") {
                console.log("Empty message");
                } else {
                console.log(message);
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-messages.php",
                    data: { queryPatientSendMessage: { from_id, to_id, role, message } },
                    success: function (data) {
                        loadPatientMsg();
                        $("#input-msg-patient-reply").val("");
                        $("#input-msg-patient-reply").focus();
                        var d = $("#conversation-list");
                        d.scrollTop(d.prop("scrollHeight"));
                    },
                });
                }
            });

            setInterval(() => {
                loadPatientMsg();
            }, 1000);

            var d = $("#conversation-list-admin");
            var e = $("#conversation-list");
            d.scrollTop(d.prop("scrollHeight"));
            e.scrollTop(e.prop("scrollHeight"));

            $("#btn-reply-admin").click(function() {
                const message = $("#input-msg-admin-reply").val();
                const name = $(this).data("name");
                const from_id = $(this).data("from_id");
                const to_id = $(this).data("to_id");
                if (message !== "") {
                    sendMessage(from_id, to_id, role, message, name);
                }
            })

            const sendMessage = (from_id, to_id, user_role, message) => {
                $.ajax({
                    type: "POST",
                    url: "../ajax/process-messages.php",
                    data: { querySendMessage: { from_id, to_id, user_role, message, name } },
                    success: function (data) {
                        location.reload();
                    },
                });
            };
        });
    </script>
<?php endblock() ?>


