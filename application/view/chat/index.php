<div class="container">
    <h1>Chat</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <div>
            <section class="discussion">
        
                <?php 
                
                $user_id = $_SESSION['user_id']; // assuming the user ID is stored in the session
                
                $chatId = ChatModel::getChatIdFromSessionUser($user_id);
                
                foreach ($this->messages as $message) { ?>
                    
                    <td></td>
                        <?php if ($message->user_id == $user_id) { ?>
                            <div class="bubble sender first"><?= $message->texts; ?></div>

                        <?php }if ($message->user_id != $user_id){ ?>
                            <div class="bubble recipient first"><?= $message->texts; ?></div>
                            <?php
                        }
                }
                    ?>

           <!-- <a href="<?php echo Config::get('URL'); ?>profile/index">Profiles</a>-->
            </section>
            <form action="<?php echo Config::get('URL'); ?>chat/sendMessage" method="post">
                <input type="text" name="message" placeholder="Message" required />
                <input type="submit" value="Send" />
            </form>
        </div>
    </div>
</div>
