$(function(){
    "use strict";

    //Datatables
    function setDataTable(tableClassName,pageLength = 10,excludeTarget = [], setSearchColumn = false, theadName = '', excludeSearchColumns = []){
        var theTable = $(tableClassName).DataTable({
            "ordering" : true,
            "info": false,
            "lengthChange": false,
            "pageLength": pageLength,
            "searchable" : true,
            "language": {
                search: "<i class='fas fa-search'></i>",
                zeroRecords: "<i class='fas fa-battery-empty'></i>"
            },
            "columnDefs": [
                { orderable: false, targets: excludeTarget },
            ]
        });
        if(setSearchColumn == true && theadName != ''){
            $(tableClassName + ' ' + theadName + ' td').each(function () {
                var title = $(this).text();
                var index = $(this).index();
                if(excludeSearchColumns.includes(index)){
                    $(this).empty();
                } else{
                    $(this).html('<input type="text" class="form-control" placeholder="' + title +'"/>');
                }
            });
            $(tableClassName + ' ' + theadName).on( 'input change', "input",function () {
                theTable
                    .column($(this).parent().index())
                    .search(this.value )
                    .draw();
            });
        }
    }

    setDataTable('table.non_registered_students',10,[0,-1],true,'.table_thead_students',[0,7]);
    setDataTable('table.registered_students',10,[0,-1,-2],true,' .table_thead_students',[0,9,10]);
    setDataTable('table.groups',3,[-1],true,'.table_thead_groups',[3]);
    setDataTable('table.student_payments',5,[-1,-2]);
    setDataTable('table.teachers_table',10,[0,-1],true,'.table_thead_teachers',[0,7]);
    setDataTable('table.users_table',10,[0,-1],true,'.table_thead_users',[0,8]);
    setDataTable('table.sectors_table',10,[-1],true,'.thead_secotrs',[3]);
    setDataTable('table.table_groups',10,[-1],true,'.table_thead_groups',[3]);
    setDataTable('table.specialities_table',3,[-1],true,'.table_thead_specialities',[2]);
    setDataTable('table.dashboard_students_one',5,[-1],true,'.table_thead_dashboard_students_one',[2]);
    setDataTable('table.dashboard_students_two',5,[-1],true,'.table_thead_dashboard_students_two',[2]);

    // -----------------------------------------------------------------
    //students
    $('.register_student').on('click','table.groups .btn_check_group',function(){
        var group_id = $(this).val();
        $('.register_student #group_id option[value="' + group_id + '"]').attr('selected','selected').siblings().removeAttr('selected');
    });

    $('.students .school_year_id_students, .dashboard #school_year, .students .radio_student_type, .teacher_vacation #school_year').on('change',function(){
        $(this).parents('form.search_form').submit();
    });

    //gropus
    $('.add_group').on('click','table.specialities_table .btn_check_sector',function(){
        var sector_id = $(this).val();
        $('.add_group #sector_id option[value="' + sector_id + '"]').attr('selected','selected').siblings().removeAttr('selected');
    });


    //confirmation
    $('.confirm').click(function(){
        return confirm('Confirmation!');
    });

    //notification
    $('.close-notification').click(function(){
        $(this).parent('div').slideUp(700,() => {
            $(this).parent('div').remove();
        });
    });
    setTimeout(function(){
        $('.notification').children('.close-notification').click();
    },4000);

    //dateInput
    $('.date-input').on('focus',function(){
        $(this).attr('type','date');
    }).on('blur',function(e){
        $(this).attr('type','text');
    });

    //select-all
    if($('.check_item:checked').length == $('.check_item').length){
        $('#select_all').prop('checked',true);
    }
    $('#select_all').click(function(){
        $('.check_item').prop('checked',$(this).prop('checked'));
    });
    $('.check_item').click(function(){
        if($(this).prop('checked') == false){
            $('#select_all').prop('checked',false);
        }
        if($('.check_item:checked').length == $('.check_item').length){
            $('#select_all').prop('checked',true);
        }
    });

    //showPassword
    $('input[type="password"]').hover(function(){
        $(this).attr('type','text');
    }, function () {
        $(this).attr('type','password');
    });

    //sidebar-submenu
    function delegateSubMenu(id){
        var vr = localStorage.getItem(id);
        if(vr == 'closed' || vr == null){
            $('#' + id).css('display','none');
            $('#' + id).addClass('submenuclosed');
        } else{
            $('#' + id).css('display','block');
            $('#' + id).removeClass('submenuclosed');
        }
    }

    delegateSubMenu('privileges_submenu');
    delegateSubMenu('ssg_submenu');

    $('#btn_log_out').click(function () {
        localStorage.setItem('ssg_submenu','closed');
        localStorage.setItem('privileges_submenu','closed');
    });

    $('.sidebar .item').click(function(e){
        var nextItem = $(this).next();
        if(nextItem.is('ul')){
            e.preventDefault();
            nextItem.toggleClass('submenuclosed');
            if(nextItem.hasClass('submenuclosed')){
                nextItem.slideUp('slow');
                localStorage.setItem(nextItem.attr('id'),'closed');
            } else{
                nextItem.slideDown('slow');
                localStorage.setItem(nextItem.attr('id'),'opened');
            }
        } else{
            $('.sidebar .item+ul').each(function(){
                localStorage.setItem($(this).attr('id'),'closed');
            });
        }
    });

    //payment
    function changeMethodByVal(xy){
        if(xy == 2 || xy == 3){
            if(xy == 3){
                $('.add_payment .check_div, .add_payment .virment_div').slideDown('slow').find('input').attr('required','required');
            } else{
                $('.add_payment .check_div').slideUp('slow').find('input').removeAttr('required');
                $('.add_payment .check_div').slideUp('slow').find('input.add').val('');
                $('.add_payment .virment_div').slideDown('slow').find('input').attr('required','required');
            }
        } else{
            $('.add_payment .virment_div, .add_payment .check_div')
                .slideUp('slow').find('input').removeAttr('required');
            $('.add_payment .virment_div, .add_payment .check_div')
                .slideUp('slow').find('input.add').val('');
        }
    }

    var xx_method = $('.add_payment #payment_method').val();
    changeMethodByVal(xx_method);

    $('.add_payment #payment_method').on('change',function(){
       var val = $(this).val();
        changeMethodByVal(val);
    });
});