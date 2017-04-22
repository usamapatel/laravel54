var vueUser;
var User = function() {
    var handleValidation = function() {
        $('.js-frm-create-user,.js-frm-edit-user').validate({
            ignore: [],
            debug: false,
            messages: {  
                email:{
                    remote:'Email Already Exists',
                }              
            },
            rules: {
                name: {
                    required: true
                },
                 email: {
                    required: true,
                    remote: {
                                url: "/admin/validateEmail",
                                type: "post",
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                data: {   
                                      id: function() {
                                        return $('input[name="user_id"]').val();
                                      }
                                }  
                            }
                },
                paswword: {
                    required: true
                },
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                element.parent().append(error);
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    };
    var formInitialization = function() {
        
    };
    var formEvents = function() {
        
    };
    return {
        init: function() {
            handleValidation();
            formInitialization();
            formEvents();
        }
    }
}();
$(document).ready(function() {
    User.init();
    $(document).on('change', '#pagination_length', function(){
        Cookies.set('pagination_length', $(this).val());
        vueUser.userListData(1, vueUser.sortby, vueUser.sorttype, vueUser.searchdata);
    });

    function getUserData() {
        vueUser = new Vue({
            el: "#userlist",
            data: {
                userData: [],
                userCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: 'id',
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