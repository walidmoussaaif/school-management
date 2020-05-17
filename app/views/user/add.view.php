<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <h1 class="text-center"><?= $text_header ?></h1>
        <div class="row">
            <div class="col-12">
                <a href="/user" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input value="<?= $this->showValue('user_cin') ?>" autofocus="autofocus" name="user_cin" type="text" class="form-control form-control-lg" placeholder="<?= $text_cin ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('username') ?>" name="username" type="text" class="form-control form-control-lg" placeholder="<?= $text_username ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('first_name') ?>" name="first_name" type="text" class="form-control form-control-lg" placeholder="<?= $text_first_name ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('last_name') ?>" name="last_name" type="text" class="form-control form-control-lg" placeholder="<?= $text_last_name ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('upassword') ?>" name="upassword" type="password" class="form-control form-control-lg" placeholder="<?= $text_upassword ?>" autocomplete="new-password" required>
                </div>
                <div class="form-group">
                    <select name="gender_id" class="form-control form-control-lg" required>
                        <option value=""><?= $text_gender ?></option>
                        <?php
                        if(isset($genders) && !empty($genders)):
                            foreach ($genders as $gender):
                            ?>
                                <option <?= $this->selectedIf('gender_id',$gender->gender_id) ?> value="<?= $gender->gender_id ?>"><?= $gender->gender_label ?></option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('dob') ?>" name="dob" type="text" class="date-input form-control form-control-lg" placeholder="<?= $text_dob ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('email') ?>" name="email" type="text" class="form-control form-control-lg" placeholder="<?= $text_email ?>" autocomplete="off" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input value="<?= $this->showValue('phone') ?>" name="phone" type="text" class="form-control form-control-lg" placeholder="<?= $text_phone ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('address') ?>" name="address" type="text" class="form-control form-control-lg" placeholder="<?= $text_address ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <select name="role_id" class="form-control form-control-lg" required>
                        <option value=""><?= $text_role ?></option>
                        <?php
                            if(isset($roles) && !empty($roles)):
                                foreach($roles as $role):
                                    ?>
                                        <option <?= $this->selectedIf('role_id',$role->role_id) ?> value="<?= $role->role_id ?>"><?= $role->role ?></option>
                                    <?php
                                endforeach;
                            endif;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2 w-25">
                            <label class="badge badge-dark p-3"><span class="h6"><?= $text_status ?></span></label>
                        </div>
                        <div class="col-md-10 w-75 p-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input <?= $this->checkedIf('ustatus','1') ?> value="1" type="radio" class="custom-control-input" id="enabled" name="ustatus">
                                <label class="custom-control-label" for="enabled"><?= $text_enabled ?></label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input <?= $this->checkedIf('ustatus','0') ?> value="0" type="radio" class="custom-control-input" id="disabled" name="ustatus" <?= $_SERVER['REQUEST_METHOD'] == 'GET' ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="disabled"><?= $text_disabled ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input name="user_img" type="file" accept="image/*" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <input type="submit" value="<?= $text_add ?>" class="btn btn-success btn-block btn-lg">
                </div>
            </div>
        </div>
    </form>
</div>