var vueModule;
var Module = function() {
    var handleValidation = function() {
        $('.js-frm-create-module,.js-frm-edit-module').validate({
            ignore: [],
            debug: false,
            messages: {                
            },
            rules: {
                name: {
                    required: true
                },
                description: {
                    required: true
                },
                url: {
                    required: true
                },
                order: {
                    required: true,
                    digits: true
                },
                icon: {
                    required: true
                },
                type: {
                    required: true
                }
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
        if($('.js-frm-create-module').length) {
            $(document).on('change', '#parent_id, #module_name, #module_type', function(event) {
                generateModuleUrl();
            });
            $(document).on('switchChange.bootstrapSwitch', '#is_publicly_visible, #module_type', function(event){
                generateModuleUrl();
            });
        }
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
    Module.init();
    $(document).on('change', '#pagination_length', function(){
        Cookies.set('pagination_length', $(this).val());
        vueModule.moduleListData(1, vueModule.sortby, vueModule.sorttype, vueModule.searchdata);
    });

    function getModuleData() {
        vueModule = new Vue({
            el: "#modulelist",
            data: {
                moduleData: [],
                moduleCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: 'id',
                sorttype: 'desc',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.moduleListData();
            },
            methods: {
                moduleListData: function(page, sortby, sorttype, searchdata) {
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
                        ajaxCall("getModuleData", data, 'POST', 'json', moduleDataSuccess);
                    } else {
                        ajaxCall("getModuleData?page="+page, data, 'POST', 'json', moduleDataSuccess);
                    }
                },
                searchModuleData: function() {
                    var name = $("#module_name").val();
                    var searchdata = "&name="+ name;
                    if($('#module_pagination').data("twbs-pagination")){
                        $('#module_pagination').twbsPagination('destroy');
                    }
                    this.$set('searchdata', searchdata);
                    this.moduleListData(1, this.sortby, this.sorttype, searchdata);
                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.moduleListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueModule);
                    this.moduleListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                }
            }
        });
    }
    getModuleData();
    initPaginationRecord();
    setTimeout(function(){
        $('.alert-success').slideUp();
      }, 5000);
});

function moduleDataSuccess(moduleData, status, xhr){
    vueModule.$set('moduleData', moduleData['data']);
    vueModule.$set('moduleCount', moduleData['data'].length);

    setTimeout(function(){
        if(moduleData['data'].length>0 && Cookies.get('pagination_length') > 0) {
            vueModule.$set('currPage', moduleData.current_page);
            current_page = moduleData.current_page;

            if(current_page == 1) {
                $('#module_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = moduleData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueModule.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#module_pagination').twbsPagination({
                  totalPages: moduleData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueModule.moduleListData(page, vueModule.sortby, vueModule.sorttype, vueModule.searchdata);
                  }
                });

                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), moduleData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueModule.$set('page_index', 1);
            setPaginationRecords(1, moduleData.total, moduleData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#module_pagination').data("twbs-pagination")){
                $('#module_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}

function generateModuleUrl() {
    var data = "parent_id=" + $('#parent_id').val() + "&module_name=" + $('#module_name').val() + "&module_type=" + $('#module_type').val();
    data += $('#is_publicly_visible').bootstrapSwitch('state') ? "&is_publicly_visible=1" : "&is_publicly_visible=0";
    ajaxCall("/admin/generateModuleUrl", data, 'POST', 'json', generateModuleUrlResponse);
}

function generateModuleUrlResponse(response, status, xhr) {
    $("#module_url").val(response.moduleUrl);
}