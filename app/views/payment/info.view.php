<div class="container">
    <h1 class="text-center"><?= $text_header ?></h1>
    <div class="row">
        <?php if(isset($previous_url) && $previous_url != ''):
        ?>
        <div class="col-md-12">
            <a href="<?= $previous_url ?>" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
        </div>
        <?php
        endif;
        ?>
    </div>
    <div class="row payment_info_section">
        <div class="col-md-12 py-3">
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_amount ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-info p-3 w-100 text-left"><?= $detail_payment->amount_deposit ?> MAD</div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_date ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $detail_payment->received_date ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_method ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left">
                            <?= ($detail_payment->payment_method_id  == 1) ? $text_cash : (($detail_payment->payment_method_id == 2)  ? $text_transfer : $text_check) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_status ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left">
                            <?php
                            $text;
                            $color;
                            if($detail_payment->reglement_status_id == 1){
                                $text = $text_paid ; $color = 'text-success';
                            } elseif($detail_payment->reglement_status_id == 2){
                                $text = $text_in_payment; $color = 'text-info';
                            } elseif($detail_payment->reglement_status_id == 3){
                                $text = $text_deposited; $color = 'text-warning';
                            } else{
                                $text = $text_unpaid; $color = 'text-danger';
                            }
                            ?>
                            <i class="fas fa-square fa-fw <?= $color ?>"></i>
                            <?= $text ?>
                        </div>
                    </div>
                </div>
            </div>
            <!----------------transfer-data -->
            <?php if($detail_payment->payment_method_id == 2 || $detail_payment->payment_method_id == 3): ?>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_reference ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $detail_payment->payment_reference ?></div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <!----------------check-data -->
            <?php if($detail_payment->payment_method_id == 3): ?>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_execute_date ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $detail_payment->execution_date ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_porter_name ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $detail_payment->porter_first_name . ' ' . $detail_payment->porter_last_name  ?></div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>