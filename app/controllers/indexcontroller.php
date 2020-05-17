<?php
    namespace APP\CONTROLLERS;
    use APP\LIBS\Helper;
    use APP\LIBS\InputFilter;
    use APP\MODELS\GroupModel;
    use APP\MODELS\SchoolYearModel;
    use APP\MODELS\StudentModel;
    use APP\MODELS\TeacherModel;
    use APP\MODELS\UserModel;

    class IndexController extends AbstractController
    {
        use InputFilter,Helper;
        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('index.default');
            $years = SchoolYearModel::getAll();
            $school_year = (isset($_GET['year']) && !empty($_GET['year'])) ? $this->filterInt($_GET['year']) : (isset($years[0]->school_year_id) ? $years[0]->school_year_id : '');
            $this->_data['years'] = $years;
            $this->_data['school_year']  = $school_year;
            $this->_data['teachers_count'] = TeacherModel::getCount();
            $this->_data['users_count'] = UserModel::getCount();
            $this->_data['students_count'] = StudentModel::getCount();
            $this->_data['registered_students_count'] = StudentModel::getRegisteredStudentsCount($school_year);
            $this->_data['unpaid_students'] = StudentModel::getStudentsByPaymentStatus($school_year,2);
            $this->_data['uncompleted_students'] = StudentModel::getStudentsByPaymentStatus($school_year,3);
            $this->_view();
        }
    }