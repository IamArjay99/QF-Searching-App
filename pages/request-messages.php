<?php 
    include '../layouts/d-layout.php';
?>

<?php startblock('another_css') ?>
<?php endblock() ?>

<?php startblock('main_content') ?>
    <main class="messages-main" id="content">
        <article>
            <div class="messages-box">
                <div class="messages-names">
                    <ul>
                    <?php 
                        $getAllRequest = $request->getAllRequest();
                        foreach($getAllRequest as $req) {
                            $getPatientRequest = $patients->getPatientRequest($req['patient_id']);
                            $fullname = $getPatientRequest['fullname'];
                            $timestamp = $req['created_at'];
                            $from_id = $req['patient_id'];
                            $output = "<li style='border-bottom: 1px solid grey'>";
                            $output .= "<a href='request-messages.php?user_id=".$from_id."&name=".$fullname."' style='text-decoration: none; color: white'>";
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
                            $id = $_GET['user_id'];
                            $name = $getPatient['fullname'];
                            echo "<span>".$name."</span>";
                        ?>
                        </div>
                        <ul id="conversation-list-admin">
                        <?php 
                            $output = "";
                            $getRequest = $request->getRequest($id); 
                            if ($getRequest) {
                                $output = "<li style='text-align: center; color: red'>---- Request Quarantine ----</li>";
                                foreach ($getRequest as $request) {
                                    $output .= "<li class='receiver'>";
                                    $output .= '<i class="fa fa-user-circle-o" aria-hidden="true"></i>';
                                    $output .= "<span>". $request['message'] ."</span>";
                                    $output .= "</li>";
                                }

                                $output .= "<li style='text-align: center;'>";
                                $output .= "<button class='btn btn-success mr-1 btn-accept'
                                                    data-id='".$id."'
                                                    data-name='".$name."'
                                                    data-user_role='".$user_role."'
                                                    data-user_id='".$user_id."'>Accept</button>";
                                $output .= "<button class='btn btn-danger ml-1 btn-reject'
                                                    data-id='".$id."'
                                                    data-name='".$name."'
                                                    data-user_role='".$user_role."'
                                                    data-user_id='".$user_id."'>Reject</button>";
                                $output .= "</li>";
                            }   else {
                                $output .= "<li style='text-align: center; color: red'>Failed to load</li>";
                            }
                            echo $output;
                        ?>
                        </ul>
                    </div>
                    <div class="text-button">
                        <textarea name="message" id="input-msg-admin-reply" placeholder="Type message..." disabled></textarea>
                        <button type="button" id="btn-reply-admin" data-name="<?= $_GET['name'] ?>" data-from_id="1" data-to_id="<?= $_GET['user_id'] ?>" disabled><i class="fa fa-paper-plane" aria-hidden="true"></i></button>  
                    </div>
                <?php } ?>
                </div>
            </div>
            <div class="footer">
                <a href="messages.php">Recent Messages</a>
            </div>
        </article>
    </main>
<?php endblock() ?>

<?php startblock('another_js') ?>
    <script src="../dist/js/request-messages.js"></script>
<?php endblock() ?>


