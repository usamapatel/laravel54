var vueGroup;
var Group = function() {
    var handleValidation = function() {
        $('.js-frm-create-group,.js-frm-edit-group').validate({
            ignore: [],
            debug: false,
            messages: {                
            },
            rules: {
                group_name: {
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
    Group.init();
    $(document).on('change', '#pagination_length', function(){
        Cookies.set('pagination_length', $(this).val());
        vueGroup.groupListData(1, vueGroup.sortby, vueGroup.sorttype, vueGroup.searchdata);
    });

    function getGroupData() {
        vueGroup = new Vue({
            el: "#grouplist",
            data: {
                groupData: [],
                groupCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: 'id',
                sorttype: 'desc',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.groupListData();
            },
            methods: {
                groupListData: function(page, sortby, sorttype, searchdata) {
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
                        ajaxCall("getGroupData", data, 'POST', 'json', groupDataSuccess);
                    } else {
                        ajaxCall("getGroupData?page="+page, data, 'POST', 'json', groupDataSuccess);
                    }
                },
                searchGroupData: function() {
                    var name = $("#group_name").val();
                    var searchdata = "&name="+ name;
                    if($('#group_pagination').data("twbs-pagination")){
                        $('#group_pagination').twbsPagination('destroy');
                    }
                    this.$set('searchdata', searchdata);
                    this.groupListData(1, this.sortby, this.sorttype, searchdata);
                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.groupListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueGroup);
                    this.groupListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                }
            }
        });
    }
    getGroupData();
    initPaginationRecord();
    setTimeout(function(){
        $('.alert-success').slideUp();
      }, 5000);
});

function groupDataSuccess(groupData, status, xhr){
    vueGroup.$set('groupData', groupData['data']);
    vueGroup.$set('groupCount', groupData['data'].length);

    setTimeout(function(){
        if(groupData['data'].length>0 && Cookies.get('pagination_length') > 0) {
            vueGroup.$set('currPage', groupData.current_page);
            current_page = groupData.current_page;

            if(current_page == 1) {
                $('#group_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = groupData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueGroup.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#group_pagination').twbsPagination({
                  totalPages: groupData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueGroup.groupListData(page, vueGroup.sortby, vueGroup.sorttype, vueGroup.searchdata);
                  }
                });

                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), groupData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueGroup.$set('page_index', 1);
            setPaginationRecords(1, groupData.total, groupData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#group_pagination').data("twbs-pagination")){
                $('#group_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}