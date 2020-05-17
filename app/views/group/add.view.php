<div class="container add_group no_global_search">
    <h1 class="text-center"><?= $text_header ?></h1>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <a href="/group" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
        </div>
    </div>
    <form id="add_group_form" action="" method="post">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="form-group">
                    <input value="<?= $this->showValue('group_name') ?>" type="text" name="group_name" class="form-control form-control-lg" required placeholder="<?= $text_group_name ?>" autofocus="autofocus" autocomplete="off">
                </div>
                <div class="form-group">
                    <select id="sector_id" name="sector_id" class="form-control form-control-lg" required>
                        <option value=""><?= $text_sector ?></option>
                        <?php
                        if(isset($sectors) && !empty($sectors)):
                            foreach($sectors as $sector):
                            ?>
                                <option <?= $this->selectedIf('sector_id',$sector->sector_id) ?> value="<?= $sector->sector_id ?>"><?= $sector->sector_name ?></option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="badge badge-info mt-2 py-2 px-3"><span class="h6 font-weight-normal"><?= $text_select_sector ?></span></div>
            <table class="table specialities_table table-bordered table-striped table-responsive-sm w-100 teachers">
                <thead>
                    <tr>
                        <th><?= $text_specialities ?></th>
                        <th><?= $text_sectors ?></th>
                        <th><?= $text_controls ?></th>
                    </tr>
                </thead>
                <thead class="table_thead_specialities">
                    <tr>
                        <td><?= $text_specialities ?></td>
                        <td><?= $text_sector ?></td>
                        <td><?= $text_controls ?></td>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($sectors) && !empty($sectors)):
                    foreach ($sectors as $sector):
                    ?>
                    <tr>
                        <td><?= $sector->speciality_name ?></td>
                        <td><?= $sector->sector_name ?></td>
                        <td>
                            <button class="btn btn-info btn-sm btn_check_sector" value="<?= $sector->sector_id ?>"><i class="fas fa-hand-pointer"></i></button>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                endif;
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-8 offset-md-2">
            <button type="submit" form="add_group_form" class="btn btn-success btn-block btn-lg"><?= $text_add ?></button>
        </div>
    </div>
</div>