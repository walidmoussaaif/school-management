<style>body{background-color: #263443;}</style>
<form action="" method="post">
    <div class="container">
        <div class="login col-lg-5 pb-4">
            <div class="logo">
                <div class="col-auto">
                    <h3 class="text-center"><?= $text_header ?></h3>
                    <div class="img"></div>
                </div>
            </div>
            <div class="inputs">
                <div class="col-auto">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user fa-fw"></i></div>
                        </div>
                        <input value="<?= $this->showValue('username') ?>" name="username" type="text" class="form-control" placeholder="<?= $text_username ?>" autocomplete="off" autofocus="autofocus" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-key fa-fw"></i></div>
                        </div>
                        <input value="<?= $this->showValue('password') ?>" name="password" type="password" class="form-control" placeholder="<?= $text_password ?>" autocomplete="off" required>
                    </div>
                    <div class="input-group my-4">
                        <input type="submit" class="btn btn-primary btn-block btn-lg" value="<?= $text_login ?>">
                    </div>
                    <div class="form-group">
                        <?php
                        $messages = $this->messenger->getMessages();
                        if(!empty($messages))
                        {
                            foreach($messages as $message):
                                ?>
                                <div class="alert <?= $message[1] ?> "><i class="close-notification fas fa-times"></i> <?= $message[0] ?></div>
                            <?php
                            endforeach;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


