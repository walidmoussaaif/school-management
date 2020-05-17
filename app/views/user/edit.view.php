<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <h1 class="text-center"><?= $text_header . '"' . $user->user_cin . '"' ?></h1>
        <div class="row py-5">
            <div class="col-md-6">
                <div class="form-group">
                    <input value="<?= $this->showValue('user_cin',$user) ?>" autofocus="autofocus" name="user_cin" type="text" class="form-control form-control-lg" placeholder="<?= $text_cin ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('username',$user) ?>" name="username" type="text" class="form-control form-control-lg" placeholder="<?= $text_username ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('first_name',$user) ?>" name="first_name" type="text" class="form-control form-control-lg" placeholder="<?= $text_first_name ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('last_name',$user) ?>" name="last_name" type="text" class="form-control form-control-lg" placeholder="<?= $text_last_name ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('upassword') ?>" name="upassword" type="password" class="form-control form-control-lg" placeholder="<?= $text_upassword ?>" autocomplete="new-password">
                </div>
                <div class="form-group">
                    <select name="gender_id" class="form-control form-control-lg" required>
                        <option value=""><?= $text_gender ?></option>
                        <?php
                        if(isset($genders) && !empty($genders)):
                            foreach ($genders as $gender):
                                ?>
                                <option <?= $this->selectedIf('gender_id',$gender->gender_id,$user) ?> value="<?= $gender->gender_id ?>"><?= $gender->gender_label ?></option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('dob',$user) ?>" name="dob" type="text" class="date-input form-control form-control-lg" placeholder="<?= $text_dob ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('email',$user) ?>" name="email" type="text" class="form-control form-control-lg" placeholder="<?= $text_email ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('phone',$user) ?>" name="phone" type="text" class="form-control form-control-lg" placeholder="<?= $text_phone ?>" autocomplete="off" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input value="<?= $this->showValue('address',$user) ?>" name="address" type="text" class="form-control form-control-lg" placeholder="<?= $text_address ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <select name="role_id" class="form-control form-control-lg" required>
                        <option value=""><?= $text_role ?></option>
                        <?php
                        if(isset($roles) && !empty($roles)):
                            foreach($roles as $role):
                                ?>
                                <option <?= $this->selectedIf('role_id',$role->role_id,$user) ?> value="<?= $role->role_id ?>"><?= $role->role ?></option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <?php if($user->user_id != $this->session->u->user_id): ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2 w-25">
                            <label class="badge badge-dark p-3"><span class="h6"><?= $text_status ?></span></label>
                        </div>
                        <div class="col-md-10  w-75 p-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input <?= $this->checkedIf('ustatus','1',$user) ?> value="1" type="radio" class="custom-control-input" id="enabled" name="ustatus">
                                <label class="custom-control-label" for="enabled"><?= $text_enabled ?></label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input <?= $this->checkedIf('ustatus','0',$user) ?> value="0" type="radio" class="custom-control-input" id="disabled" name="ustatus">
                                <label class="custom-control-label" for="disabled"><?= $text_disabled ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="/uploads/images/<?= $user->user_img ?>" width="100%" height="100%">
                        </div>
                        <div class="col-md-10 py-1">
                            <input name="user_img" type="file" accept="image/*" class="form-control form-control-lg">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="<?= $text_update ?>" class="btn btn-success btn-block btn-lg">
                </div>
                <div class="form-group">
                    <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/user' ?>" class="btn btn-warning btn-lg btn-block"><?= $text_cancel ?></a>
                </div>
            </div>
        </div>
    </form>
</div>