var vueTeam;
var Team = function() {
    var handleValidation = function() {
        $('.js-frm-create-team,.js-frm-edit-team').validate({
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
var InviteMember = function() {
    var handleValidation = function() {
        $('.js-frm-invite-member').validate({
            messages: {                
            },
            rules: {
                'email': {
                    required: true,
                    email: true
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
var initTable = function () {
    var table = $('.datatable');

    // begin first table
    table.dataTable({

        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
        "language": {
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            },
            "emptyTable": "No record found",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "No record found",
            "infoFiltered": "(filtered1 from _MAX_ total entries)",
            "lengthMenu": "Show _MENU_",
            "search": "Search:",
            "zeroRecords": "No record found",
            "paginate": {
                "previous":"Previous",
                "next": "Next",
                "last": "Last",
                "first": "First"
            }
        },

        // Or you can use remote translation file
        //"language": {
        //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
        //},

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pageLength": 5,
        "pagingType": "full_numbers",
        "columnDefs": [
            {  // set default column settings
                'orderable': false,
                'targets': [4]
            }, 
            {
                "searchable": false,
                "targets": [4]
            },
            {
                "className": "dt-right", 
                //"targets": [2]
            }
        ],
        "order": [
            [1, "asc"]
        ], // set first column as a default sort by asc
    });

    var tableWrapper = jQuery('#sample_1_wrapper');

    table.find('.group-checkable').change(function () {
        var set = jQuery(this).attr("data-set");
        var checked = jQuery(this).is(":checked");
        jQuery(set).each(function () {
            if (checked) {
                $(this).prop("checked", true);
                $(this).parents('tr').addClass("active");
            } else {
                $(this).prop("checked", false);
                $(this).parents('tr').removeClass("active");
            }
        });
    });

    table.on('change', 'tbody tr .checkboxes', function () {
        $(this).parents('tr').toggleClass("active");
    });
};
$(document).ready(function() {
    if($('.datatable').length) {
        initTable();
    }
    Team.init();
    InviteMember.init();
    $(document).on('change', '#pagination_length', function(){
        Cookies.set('pagination_length', $(this).val());
        vueTeam.teamListData(1, vueTeam.sortby, vueTeam.sorttype, vueTeam.searchdata);
    });

    function getTeamData() {
        vueTeam = new Vue({
            el: "#teamlist",
            data: {
                teamData: [],
                teamCount: 0,
                sortKey: '',
                sortOrder: 1,
                sortby: 'id',
                sorttype: 'desc',
                searchdata: '',
                footercontent: ''
            },
            ready: function() {
                this.teamListData();
            },
            methods: {
                teamListData: function(page, sortby, sorttype, searchdata) {
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
                        ajaxCall("teams/getTeamData", data, 'POST', 'json', teamDataSuccess);
                    } else {
                        ajaxCall("teams/getTeamData?page="+page, data, 'POST', 'json', teamDataSuccess);
                    }
                },
                searchTeamData: function() {
                    var teamName = $("#team_name").val();
                    var searchdata = "&name="+ teamName;
                    if($('#team_pagination').data("twbs-pagination")){
                        $('#team_pagination').twbsPagination('destroy');
                    }
                    this.$set('searchdata', searchdata);
                    this.teamListData(1, this.sortby, this.sorttype, searchdata);
                },
                sortBy: function (key) {
                    this.sortOrder = this.sortOrder * -1;
                    this.$set('sortOrder', this.sortOrder);
                    this.$set('sortby', key);
                    this.$set('sortKey', key);
                    var stype = this.sortOrder == 1 ? 'asc':'desc';
                    this.$set('sorttype', stype);
                    this.teamListData(this.currPage, key, stype, this.searchdata);
                },
                reloadData: function() {
                    clearFormData('frmSearchData');
                    setDefaultData(vueTeam);
                    this.teamListData();
                },
                clearForm: function(formid) {
                    this.reloadData();
                }
            }
        });
    }
    //getTeamData();
    // initPaginationRecord();
    setTimeout(function(){
        $('.alert-success').slideUp();
      }, 5000);
});

function teamDataSuccess(teamData, status, xhr){
    vueTeam.$set('teamData', teamData['data']);
    vueTeam.$set('teamCount', teamData['data'].length);

    setTimeout(function(){
        if(teamData['data'].length>0 && Cookies.get('pagination_length') > 0) {
            vueTeam.$set('currPage', teamData.current_page);
            current_page = teamData.current_page;

            if(current_page == 1) {
                $('#team_pagination').off( "page" ).removeData( "twbs-pagination" ).empty();
            }

            per_page = teamData.per_page;

            startIndex = 0;
            if(current_page > 1) {
                startIndex = (current_page - 1) * parseInt(per_page);
            }
            vueTeam.$set('page_index', startIndex+1);
            setTimeout(function() {
                $('#team_pagination').twbsPagination({
                  totalPages: teamData.last_page,
                  visiblePages: 5,
                  initiateStartPageClick: false,
                  onPageClick: function (event, page) {
                    vueTeam.teamListData(page, vueTeam.sortby, vueTeam.sorttype, vueTeam.searchdata);
                  }
                });

                setPaginationRecords(startIndex+1, startIndex+parseInt(Cookies.get('pagination_length')), teamData.total);
                $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            }, 10);

        } else {
            vueTeam.$set('page_index', 1);
            setPaginationRecords(1, teamData.total, teamData.total);
            $("#pagination_length").select2({ minimumResultsForSearch: Infinity });
            if($('#team_pagination').data("twbs-pagination")){
                $('#team_pagination').twbsPagination('destroy');
            }
        }

        $('#pagination_length').val(Cookies.get('pagination_length'));
    });
}