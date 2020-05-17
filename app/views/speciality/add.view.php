<div class="container">
    <h1 class="text-center"><?= $text_header ?></h1>
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3">
            <a href="/speciality" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
        </div>
    </div>
    <form action="" method="post" class="mt-3">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <input value="<?= $this->showValue('speciality_name') ?>" name="speciality_name" type="text" class="form-control form-control-lg" placeholder="<?= $text_name ?>" required autofocus="autofocus" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="submit" value="<?= $text_add ?>" class="btn btn-success btn-block btn-lg">
                </div>
            </div>
        </div>
    </form>
</div>