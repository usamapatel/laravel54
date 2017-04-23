var vuePermission;
var Permission = function() {
    var handleValidation = function() {
        $('.js-frm-create-permission,.js-frm-edit-permission').validate({
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
    Permission.init();
    $(document).on('change', '#pagination_length', function(){
        Cookies.set('pagination_length', $(this).val());
        vuePermission.permissionListData(1, vuePermission.sortby, vuePermission.sorttype, vuePermission.searchdata);
    });

    function getPermissionData() {
        vuePermission = new Vue({
            el: "#permissionlist",
            data: {
                permissionData: [],
                permissionCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: 'id',
                sorttype: 'desc',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.permissionListData();
            },
            methods: {
                permissionListData: function(page, sortby, sorttype, searchdata) {
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
                        ajaxCall("getPermissionData", data, 'POST', 'json', permissionDataSuccess);
                    } else {
                        ajaxCall("getPermissionData?page="+page, data, 'POST', 'json', permissionDataSuccess);
                    }
                },
                searchPermissionData: function() {
                    var permissionName = $("#permission_name").val();
                    var searchdata = "&name="+ permissionName;
                    if($('#permission_pagination').data("twbs-pagination")){
                        $('#permission_pagination').twbsPagination('destroy');
                    }
                    this.$set('searchdata', searchdata);
                    this.permissionListData(1, this.sortby, this.sorttype, searchdata);
                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.permissionListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vuePermission);
                    this.permissionListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                }
            }
        });
    }
    getPermissionData();
    // initPaginationRecord();
    setTimeout(function(){
        $('.alert-success').slideUp();
      }, 5000);
});

function permissionDataSuccess(permissionData, status, xhr){
    vuePermission.$set('permissionData', permissionData['data']);
    vuePermission.$set('permissionCount', permissionData['data'].length);

    setTimeout(function(){
        if(permissionData['data'].length>0 && Cookies.get('pagination_length') > 0) {
            vuePermission.$set('currPage', permissionData.current_page);
            current_page = permissionData.current_page;

            if(current_page == 1) {
                $('#permission_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = permissionData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vuePermission.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#permission_pagination').twbsPagination({
                  totalPages: permissionData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vuePermission.permissionListData(page, vuePermission.sortby, vuePermission.sorttype, vuePermission.searchdata);
                  }
                });

                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), permissionData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vuePermission.$set('page_index', 1);
            setPaginationRecords(1, permissionData.total, permissionData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#permission_pagination').data("twbs-pagination")){
                $('#permission_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}