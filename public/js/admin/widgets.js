var vueWidget;
var Widget = function() {
    var handleValidation = function() {
        $('.js-frm-create-widget,.js-frm-edit-widget').validate({
            ignore: [],
            debug: false,
            messages: {                
            },
            rules: {
                widget_type: {
                    required: true
                },
                widget_icon: {
                    required: true
                },
                widget_name: {
                    required: true
                },
                widget_title: {
                    required: true
                },
                description: {
                    required: true
                },
                widget_width: {
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
    Widget.init();
    $(document).on('change', '#pagination_length', function(){
        Cookies.set('pagination_length', $(this).val());
        vueWidget.widgetListData(1, vueWidget.sortby, vueWidget.sorttype, vueWidget.searchdata);
    });

    function getWidgetData() {
        vueWidget = new Vue({
            el: "#widgetlist",
            data: {
                widgetData: [],
                widgetCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: 'id',
                sorttype: 'desc',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.widgetListData();
            },
            methods: {
                widgetListData: function(page, sortby, sorttype, searchdata) {
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
                        ajaxCall("getWidgetData", data, 'POST', 'json', widgetDataSuccess);
                    } else {
                        ajaxCall("getWidgetData?page="+page, data, 'POST', 'json', widgetDataSuccess);
                    }
                },
                searchWidgetData: function() {
                    var name = $("#widget_name").val();
                    var searchdata = "&name="+ name;
                    if($('#widget_pagination').data("twbs-pagination")){
                        $('#widget_pagination').twbsPagination('destroy');
                    }
                    this.$set('searchdata', searchdata);
                    this.widgetListData(1, this.sortby, this.sorttype, searchdata);
                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.widgetListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueWidget);
                    this.widgetListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                }
            }
        });
    }
    getWidgetData();
    initPaginationRecord();
    setTimeout(function(){
        $('.alert-success').slideUp();
      }, 5000);
});

function widgetDataSuccess(widgetData, status, xhr){
    vueWidget.$set('widgetData', widgetData['data']);
    vueWidget.$set('widgetCount', widgetData['data'].length);

    setTimeout(function(){
        if(widgetData['data'].length>0 && Cookies.get('pagination_length') > 0) {
            vueWidget.$set('currPage', widgetData.current_page);
            current_page = widgetData.current_page;

            if(current_page == 1) {
                $('#widget_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = widgetData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueWidget.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#widget_pagination').twbsPagination({
                  totalPages: widgetData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueWidget.widgetListData(page, vueWidget.sortby, vueWidget.sorttype, vueWidget.searchdata);
                  }
                });

                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), widgetData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueWidget.$set('page_index', 1);
            setPaginationRecords(1, widgetData.total, widgetData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#widget_pagination').data("twbs-pagination")){
                $('#widget_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}