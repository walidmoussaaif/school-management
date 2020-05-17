<div class="container">
    <h1 class="text-center"><?= $text_header ?></h1>
    <form method="post">
        <div class="row">
            <div class="col-12">
                <a href="/role" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <input value="<?= $this->showValue('role') ?>" autofocus="autofocus" name="role" type="text" class="form-control form-control-lg" placeholder="<?= $text_role ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="<?= $text_add ?>" class="btn btn-success btn-block btn-lg">
                </div>
            </div>
        </div>
        <div class="row all_privileges">
            <div class="col-12 pb-2">
                <div class="badge badge-dark p-2"><span class="h5 font-weight-normal"><?= $text_select_privileges ?></span></div>
            </div>
            <div class="col-12 pb-2">
                <div class="badge badge-light w-100 p-2 text-left">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="select_all" name="select_all" <?= (array_key_exists('select_all',isset($_POST) ? $_POST : [])) ? 'checked' : '' ?>>
                        <label class="custom-control-label h5 font-weight-normal" for="select_all"><?= $text_select_all ?></label>
                    </div>
                </div>
            </div>
            <?php
            if(isset($privileges) && !empty($privileges)):
                foreach ($privileges as $key => $privilege):
                ?>
                <div class="col-md-12 pb-4">
                    <div class="badge badge-info w-100 p-2"><span class="h4 font-weight-normal"><?= $$key ?></span></div>
                    <?php
                    foreach ($privilege as $priv):
                        $text_privilege = $priv->privilege;
                        ?>
                        <div class="badge badge-light w-100 p-2 text-left">
                            <div class="custom-control custom-checkbox">
                                <input <?= in_array($priv->privilege_id,isset($_POST['privileges']) ? $_POST['privileges'] : []) ? 'checked' : '' ?> type="checkbox" name="privileges[]" class="check_item custom-control-input" value="<?= $priv->privilege_id ?>" id="<?= $priv->privilege_id ?>">
                                <label class="custom-control-label h5 font-weight-normal" for="<?= $priv->privilege_id ?>"><?= $$text_privilege ?></label>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
                <?php
                endforeach;
            endif;
            ?>
        </div>
    </form>
</div>