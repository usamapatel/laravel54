var vueRole;
var Role = function() {
    var handleValidation = function() {
        $('.js-frm-create-role,.js-frm-edit-role').validate({
            ignore: [],
            debug: false,
            messages: {                
            },
            rules: {
                name: {
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
    Role.init();
    $(document).on('change', '#pagination_length', function(){
        Cookies.set('pagination_length', $(this).val());
        vueRole.roleListData(1, vueRole.sortby, vueRole.sorttype, vueRole.searchdata);
    });

    function getRoleData() {
        vueRole = new Vue({
            el: "#rolelist",
            data: {
                roleData: [],
                roleCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: 'id',
                sorttype: 'desc',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.roleListData();
            },
            methods: {
                roleListData: function(page, sortby, sorttype, searchdata) {
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
                        ajaxCall("getRoleData", data, 'POST', 'json', roleDataSuccess);
                    } else {
                        ajaxCall("getRoleData?page="+page, data, 'POST', 'json', roleDataSuccess);
                    }
                },
                searchRoleData: function() {
                    var name = $("#role_name").val();
                    var searchdata = "&name="+ name;
                    if($('#role_pagination').data("twbs-pagination")){
                        $('#role_pagination').twbsPagination('destroy');
                    }
                    this.$set('searchdata', searchdata);
                    this.roleListData(1, this.sortby, this.sorttype, searchdata);
                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.roleListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueRole);
                    this.roleListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                }
            }
        });
    }
    getRoleData();
    initPaginationRecord();
    setTimeout(function(){
        $('.alert-success').slideUp();
      }, 5000);
});

function roleDataSuccess(roleData, status, xhr){
    vueRole.$set('roleData', roleData['data']);
    vueRole.$set('roleCount', roleData['data'].length);

    setTimeout(function(){
        if(roleData['data'].length>0 && Cookies.get('pagination_length') > 0) {
            vueRole.$set('currPage', roleData.current_page);
            current_page = roleData.current_page;

            if(current_page == 1) {
                $('#role_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = roleData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueRole.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#role_pagination').twbsPagination({
                  totalPages: roleData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueRole.roleListData(page, vueRole.sortby, vueRole.sorttype, vueRole.searchdata);
                  }
                });

                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), roleData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueRole.$set('page_index', 1);
            setPaginationRecords(1, roleData.total, roleData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#role_pagination').data("twbs-pagination")){
                $('#role_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}