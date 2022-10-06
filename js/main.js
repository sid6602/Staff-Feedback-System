(function($) {
    'use strict';

    $(document).ready(function() {

        $('.verifyEmail .emailVerification').click(function(e) {
            let email = new RegExp('[a-z0-9]{3,}@mitaoe.ac.in$');
            if (email.test($('.verifyEmail #floatingEmail').val())) {
                $(document).ready(function() {
                    $.ajax({
                        type: 'post',
                        url: 'backend.php',
                        data: { 'request': 'student_form', 'email': $('.verifyEmail #floatingEmail').val() },
                        success: function(response) {
                            if (response[0] == '0') {
                                $('.verifyEmail').addClass('d-none')
                                response = response.slice(1)
                                $('.errorPage').html(response);
                            } else {
                                $('.verifyEmail').addClass('d-none')
                                $('#feedback').removeClass('d-none');
                                $('.feedback .student-info').html(response);
                            }
                        }
                    })
                })
            } else {
                return
            }
            e.preventDefault()
        })
    })

    // $('.student-details .stud_info_btn').click(function(e) {
    //     e.preventDefault()
    //     let branch = document.getElementById('branch');
    //     let value = branch.options[branch.selectedIndex].value;
    //     if (value == '0') {
    //         alert('Please select your branch');
    //         branch.focus();
    //         console.log(branch, value)
    //         return;
    //     }

    //     let division = document.getElementById('division');
    //     let div = division.options[division.selectedIndex].value;
    //     if (div == '0') {
    //         alert('Please select your division');
    //         division.focus();
    //         console.log(division, div)
    //         return
    //     }

    //     // To keep track of current visible form
    //     let formCounter = 1;

    //     $.ajax({
    //         datatype: 'json',
    //         type: 'post',
    //         url: 'backend.php',
    //         data: $('#student-details').serialize(),
    //         success: function(response) {
    //             if (!response) {
    //                 alert('error')
    //             } else {
    //                 console.log(response)
    //                 let data = response.split('/,');
    //                 $('.student-info').addClass('d-none')
    //                 $('.feedback .feedback-forms').removeClass('d-none');
    //                 $('.feedback .feedback-forms').html(data[0]);

    //                 for (let j = 2; j <= data[1]; j++) {
    //                     $('#ratingForm' + j).addClass('d-none');
    //                 }
    //             }
    //         }
    //     })





    // });

})(jQuery);