<div class="container add_payment">
    <h1 class="text-center">
        <?= $text_header ?> <br/>
        <?= isset($student_cin) ? '"' . $student_cin . '"' : '' ?>
    </h1>
    <?php
    if(isset($student_cin) && isset($school_year_id)):
    ?>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <a href="/payment?year=<?= $school_year_id ?>&cin=<?= $student_cin ?>" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
        </div>
    </div>
    <?php
    endif;
    ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <select id="payment_method" name="payment_method_id" class="form-control form-control-lg" required autofocus="autofocus">
                        <option value=""><?= $text_payment_method ?></option>
                        <?php
                        if(isset($payment_methods) && !empty($payment_methods)):
                            foreach($payment_methods as $method):
                            ?>
                                <option <?= $this->selectedIf('payment_method_id',$method->method_id) ?> value="<?= $method->method_id ?>">
                                    <?= ${$method->method_desc} ?>
                                </option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="reglement_status_id" class="form-control form-control-lg" required>
                        <option value=""><?= $text_status ?></option>
                        <?php
                        if(isset($reglement_status) && !empty($reglement_status)):
                            foreach($reglement_status as $status):
                            ?>
                                <option <?= $this->selectedIf('reglement_status_id',$status->reglement_status_id) ?> value="<?= $status->reglement_status_id ?>">
                                    <?= ${$status->status_label} ?>
                                </option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('deposit_amount') ?>" name="deposit_amount" type="number" class="form-control form-control-lg" required placeholder="<?= $text_deposit_amount ?>">
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('deposit_date') ?>" name="deposit_date" type="text" class="date-input form-control form-control-lg" required placeholder="<?= $text_deposit_date ?>">
                </div>
                <div class="virment_div">
                    <hr/>
                    <div class="form-group">
                        <input autocomplete="off" value="<?= $this->showValue('reference') ?>" name="reference" type="text" class="add form-control form-control-lg" placeholder="<?= $text_ref ?>">
                    </div>
                </div>
                <div class="check_div">
                    <hr/>
                    <div class="form-group">
                        <input value="<?= $this->showValue('execution_date') ?>" name="execution_date" type="text" class="add date-input form-control form-control-lg"  placeholder="<?= $text_exec_date ?>">
                    </div>
                    <div class="form-group">
                        <input autocomplete="off" value="<?= $this->showValue('bank_name') ?>" name="bank_name" type="text" class="add form-control form-control-lg" placeholder="<?= $text_bank_name ?>">
                    </div>
                    <div class="form-group">
                        <input autocomplete="off" value="<?= $this->showValue('porter_first_name') ?>" name="porter_first_name" type="text" class="add form-control form-control-lg" placeholder="<?= $text_porter_first_name ?>">
                    </div>
                    <div class="form-group">
                        <input autocomplete="off" value="<?= $this->showValue('porter_last_name') ?>" name="porter_last_name" type="text" class="add form-control form-control-lg" placeholder="<?= $text_porter_last_name ?>">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block btn-lg" value="<?= $text_add ?>">
                </div>
            </div>
        </div>
    </form>
</div>