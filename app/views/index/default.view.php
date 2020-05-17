<div class="container-fluid dashboard no_global_search">
    <h1 class="text-center"><?= $text_header ?></h1>
    <form class="search_form mt-3" method="get">
        <div class="row mt-3">
            <div class="col-md-3">
                <select id="school_year" name="year" class="form-control form-control-lg">
                    <?php
                    if(isset($years) && !empty($years)):
                        foreach ($years as $year):
                        ?>
                            <option <?= $this->selectedIfGet('year',$year->school_year_id) ?> value="<?= $year->school_year_id ?>"><?= $year->label ?></option>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
        </div>
    </form>
    <div class="row mt-2">
        <div class="col-sm-6 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block p-4">
                    <h5 class=""><?= $text_students_count ?></h5>
                    <i class="fas fa-user-graduate float-left my-2"></i>
                    <span class="float-right d-inline-block h2"><?= $students_count ?></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block p-4">
                    <h5 class=""><?= $text_registered_students ?></h5>
                    <i class="fas fa-user-graduate float-left my-2"></i>
                    <span class="float-right d-inline-block h2"><?= $registered_students_count ?></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block p-4">
                    <h5 class=""><?= $text_teachers ?></h5>
                    <i class="fas fa-chalkboard-teacher float-left my-2"></i>
                    <span class="float-right d-inline-block h2"><?= $teachers_count ?></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block p-4">
                    <h5 class=""><?= $text_users ?></h5>
                    <i class="fas fa-user float-left my-2"></i>
                    <span class="float-right d-inline-block h2"><?= $users_count ?></span>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row mt-2">
        <div class="col-md-6">
            <div class="badge badge-info mb-2 p-2"><span class="h5 font-weight-normal"><?= $text_unpaid_students ?></span></div>
            <table class="table dashboard_students dashboard_students_one table-bordered table-striped table-responsive-sm">
                <thead>
                    <tr>
                        <th><?= $text_cin ?></th>
                        <th><?= $text_full_name ?></th>
                        <th><?= $text_controls ?></th>
                    </tr>
                </thead>
                <thead class="table_thead_dashboard_students table_thead_dashboard_students_one">
                    <tr>
                        <td><?= $text_cin ?></td>
                        <td><?= $text_full_name ?></td>
                        <td><?= $text_controls ?></td>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($unpaid_students) && !empty($unpaid_students)):
                    foreach ($unpaid_students as $student):
                    ?>
                    <tr>
                        <td><?= $student->student_cin ?></td>
                        <td><?= $student->student_first_name . ' ' . $student->student_last_name ?></td>
                        <td><a href="/payment?year=<?= $school_year ?>&cin=<?= $student->student_cin ?>"><?= $text_show_details ?></a></td>
                    </tr>
                    <?php
                    endforeach;
                endif;
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <div class="badge badge-info mb-2 p-2"><span class="h5 font-weight-normal"><?= $text_uncompleted_students ?></span></div>
            <table class="table dashboard_students dashboard_students_two table-bordered table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th><?= $text_cin ?></th>
                    <th><?= $text_full_name ?></th>
                    <th><?= $text_controls ?></th>
                </tr>
                </thead>
                <thead class="table_thead_dashboard_students table_thead_dashboard_students_two">
                <tr>
                    <td><?= $text_cin ?></td>
                    <td><?= $text_full_name ?></td>
                    <td><?= $text_controls ?></td>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($uncompleted_students) && !empty($uncompleted_students)):
                    foreach ($uncompleted_students as $student):
                        ?>
                        <tr>
                            <td><?= $student->student_cin ?></td>
                            <td><?= $student->student_first_name . ' ' . $student->student_last_name ?></td>
                            <td><a href="/payment?year=<?= $school_year ?>&cin=<?= $student->student_cin ?>"><?= $text_show_details ?></a></td>
                        </tr>
                    <?php
                    endforeach;
                endif;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>