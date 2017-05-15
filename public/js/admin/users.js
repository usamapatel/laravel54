var vueUser;
var User = function() {
    var form = $('#submit_user_form');
    // var editForm = $('#submit_edit_user_form');
    var error = $('.alert-danger', form);
    var success = $('.alert-success', form);

    var handleValidationAddPage = function() {
        $('.js-frm-create-user, .js-frm-edit-user').validate({
            doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            messages: {
                username: {
                    remote: 'Username already exists.'
                }
            },
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                username: {
                    required: true,
                     remote: {
                        url: "/admin/validateUsername",
                        type: "post",
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: {   
                              id: function() {
                                return $('input[name="user_id"]').val();
                              }
                        }
                    }
                },
                email: {
                    required: true,
                },
                'roles[]': {
                    required: true
                },
                created_at :{
                    required: true
                },
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                element.parent().append(error);
            },

            invalidHandler: function (event, validator) { //display error alert on form submit   
                if($('.js-frm-create-user').length > 0) {
                    success.hide();
                    error.show();
                    App.scrollTo(error, -200);    
                }  
            },
            submitHandler: function (form) {
                error.hide();
                form.submit();
            }
        });
    };

    // var handleValidationEditPage = function() {
    //     editForm.validate({
    //         doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
    //         errorElement: 'span', //default input error message container
    //         errorClass: 'help-block help-block-error', // default input error message class
    //         focusInvalid: false, // do not focus the last invalid input
    //         messages: {
    //             username: {
    //                 remote: 'Username already exists.'
    //             }
    //         },
    //         rules: {
    //             first_name: {
    //                 required: true
    //             },
    //             last_name: {
    //                 required: true
    //             },
    //             username: {
    //                 required: true,
    //                  remote: {
    //                     url: "/admin/validateUsername",
    //                     type: "post",
    //                     headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    //                     data: {   
    //                           id: function() {
    //                             return $('input[name="user_id"]').val();
    //                           }
    //                     }
    //                 }
    //             },
    //             email: {
    //                 required: true,
    //             },
    //             'roles[]': {
    //                 required: true
    //             },
    //             created_at :{
    //                 required: true
    //             },
    //         },
    //         errorPlacement: function (error, element) { // render error placement for each input type
    //             element.parent().append(error);
    //         },            
    //         submitHandler: function (form) {
    //             editForm.submit();
    //         }
    //     });
    // };

    var handleTitle = function(tab, navigation, index) {
        var total = navigation.find('li').length;
        var current = index + 1;
        // set wizard title
        $('.step-title', $('#user_form_wizard')).text('Step ' + (index + 1) + ' of ' + total);
        // set done steps
        jQuery('li', $('#user_form_wizard')).removeClass("done");
        var li_list = navigation.find('li');
        for (var i = 0; i < index; i++) {
            jQuery(li_list[i]).addClass("done");
        }

        if (current == 1) {
            $('#user_form_wizard').find('.button-previous').hide();
        } else {
            $('#user_form_wizard').find('.button-previous').show();
        }

        if (current >= total) {
            $('#user_form_wizard').find('.button-next').hide();
            $('#user_form_wizard').find('.button-submit').show();            
        } else {
            $('#user_form_wizard').find('.button-next').show();
            $('#user_form_wizard').find('.button-submit').hide();
        }
    }

    var formWizard = function() {
        // default form wizard
        $('#user_form_wizard').bootstrapWizard({
            'nextSelector': '.button-next',
            'previousSelector': '.button-previous',
            onTabClick: function (tab, navigation, index, clickedIndex) {
                return false;
                
                success.hide();
                error.hide();
                if (form.valid() == false) {
                    return false;
                }
                
                handleTitle(tab, navigation, clickedIndex);
            },
            onNext: function (tab, navigation, index) {
                success.hide();
                error.hide();

                if (form.valid() == false) {
                    return false;
                }

                handleTitle(tab, navigation, index);
            },
            onPrevious: function (tab, navigation, index) {
                success.hide();
                error.hide();

                handleTitle(tab, navigation, index);
            },
            onTabShow: function (tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                var $percent = (current / total) * 100;
                $('#user_form_wizard').find('.progress-bar').css({
                    width: $percent + '%'
                });
            }
        });
    };

    return {
        init: function() {
            handleValidationAddPage();
            formWizard();
        }
    }
}();

$(document).ready(function() {
    User.init();
    $(document).on('change', '#pagination_length', function(){
        Cookies.set('pagination_length', $(this).val());
        vueUser.userListData(1, vueUser.sortby, vueUser.sorttype, vueUser.searchdata);
    });

    $(document).on('click', '.js-continue', function(){
        $.ajax({
            url: "/admin/validateEmail",
            type: "POST",
            data: {email: $("#email").val()},
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(result){
                $(".js-tab-pane").removeClass('active');
                $("#profile_setup").addClass('active');
                $(".js-btn-back").css('display', 'inline-block');

                if(result === 'true') {
                    $(".js-btn-continue").css('display', 'none');
                    $(".js-btn-send").css('display', 'none');
                    $(".js-btn-submit").css('display', 'inline-block');
                    $(".js-send-invitation").hide();
                    $(".js-profile-details").show();
                } else {
                    $(".js-btn-continue").css('display', 'none');
                    $(".js-btn-send").css('display', 'inline-block');
                    $(".js-btn-submit").css('display', 'none');
                    $(".js-profile-details").hide();
                    $(".js-send-invitation").show();
                }
            }
        });
    });

    function getUserData() {
        vueUser = new Vue({
            el: "#userlist",
            data: {
                userData: [],
                userCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: 'users.id',
                sorttype: 'desc',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.userListData();
            },
            methods: {
                userListData: function(page, sortby, sorttype, searchdata) {
                    if(typeof(sortby) == "undefined"){
                        sortby = this.sortby;
                        sorttype = this.sorttype;
                    } else {
                        this.sortby = sortby;
                        this.sorttype = sorttype;
                    }

                    var data = "sortby="+sortby + "&sorttype=" + sorttype;

                    if(typeof(searchdata) != "undefined") {
                        data += searchdata;
                    }

                    data += setPaginationAmount();

                    if(typeof(page) == "undefined"){
                        ajaxCall("getUserData", data, 'POST', 'json', userDataSuccess);
                    } else {
                        ajaxCall("getUserData?page="+page, data, 'POST', 'json', userDataSuccess);
                    }
                },
                searchUserData: function() {
                    var name = $("#user_name").val();
                    var email = $("#user_email").val();
                    var created_at = $("#created_at").val();
                    var searchdata = "&name="+ name + "&email=" + email + "&created_at=" + created_at;
                    if($('#user_pagination').data("twbs-pagination")){
                        $('#user_pagination').twbsPagination('destroy');
                    }
                    this.$set('searchdata', searchdata);
                    this.userListData(1, this.sortby, this.sorttype, searchdata);
                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.userListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueUser);
                    this.userListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                }
            }
        });
    }
    getUserData();
    initPaginationRecord();
    setTimeout(function(){
        $('.alert-success').slideUp();
      }, 5000);
});

function userDataSuccess(userData, status, xhr){
    vueUser.$set('userData', userData['data']);
    vueUser.$set('userCount', userData['data'].length);

    setTimeout(function(){
        if(userData['data'].length>0 && Cookies.get('pagination_length') > 0) {
            vueUser.$set('currPage', userData.current_page);
            current_page = userData.current_page;

            if(current_page == 1) {
                $('#user_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = userData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueUser.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#user_pagination').twbsPagination({
                  totalPages: userData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueUser.userListData(page, vueUser.sortby, vueUser.sorttype, vueUser.searchdata);
                  }
                });
                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), userData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueUser.$set('page_index', 1);
            setPaginationRecords(1, userData.total, userData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#user_pagination').data("twbs-pagination")){
                $('#user_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}