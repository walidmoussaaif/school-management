<div class="container">
    <h1 class="text-center"><?= $text_header ?></h1>
    <form action="" method="post" class="mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <select name="speciality_id" class="form-control form-control-lg" required autofocus="autofocus">
                        <option value=""><?= $text_select_speciality ?></option>
                        <?php
                        if(isset($specialities) && !empty($specialities)):
                            foreach($specialities as $speciality):
                                ?>
                                <option <?= $this->selectedIf('speciality_id',$speciality->speciality_id,$sector) ?> value="<?= $speciality->speciality_id ?>"><?= $speciality->speciality_name ?></option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('sector_name',$sector) ?>" type="text" name="sector_name" class="form-control form-control-lg" required autocomplete="off" placeholder="<?= $text_sector_name ?>">
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('sector_short_name',$sector) ?>" type="text" name="sector_short_name" class="form-control form-control-lg" required autocomplete="off" placeholder="<?= $text_sector_short_name ?>">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block btn-lg" value="<?= $text_update ?>">
                </div>
                <div class="form-group">
                    <a href="/sector" class="btn btn-warning btn-block btn-lg"><?= $text_cancel ?></a>
                </div>
            </div>
        </div>
    </form>
</div>