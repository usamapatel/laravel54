var PageLimit = 10;
$(document).ready(function() {
    $(".select2-hide-search-box").select2({
        minimumResultsForSearch: Infinity
    });
    
    $(".js-select2-multiselect").select2();

    $('#temp .dropdown-menu').on({
        "click":function(e){
          e.stopPropagation();
        }
    });

    // delete functionality
    $(document).on('click', '.js-delete-button', function(e){
        var action = $(this).data('delete-url');
        var confirmationMsg = $(this).data('confirm-msg') || 'Are you sure?';
        $(".js-delete-confirmation-msg").html(confirmationMsg);
        $(".js-delete-modal-form").prop('action', action);
    });

    $(document).on('change', '.js-chk-column-management', function(e){
        if($(this).closest(".icheckbox_minimal-blue").hasClass("checked")) {
            $(this).closest(".icheckbox_minimal-blue").removeClass("checked");
        } else {
            $(this).closest(".icheckbox_minimal-blue").addClass("checked");                                                                                     
        }
    });

    $('.js-form-datetimepicker').datetimepicker({
        format: 'DD-MM-YYYY hh:mm A',
        showClose: true,
        ignoreReadonly: true
    });

    /*$('.js-form-datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        ignoreReadonly: true
    });*/

    $('.js-form-datepicker-decade').datetimepicker({
        format: 'DD-MM-YYYY',
        showClose: true,
        ignoreReadonly: true,
        viewMode: 'years',
        maxDate : 'now'
    });

    /*$('input[type="checkbox"].icheck, input[type="radio"].icheck').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });*/

    $('.js-icon-picker').iconpicker({
        hideOnSelect: true,
    });
});

function ajaxCall(url, data, method, dataType, successHandlerFunction, processDataFlag, contentTypeFlag) {
    if(typeof(processDataFlag) == 'undefined'){
      processDataFlag = true;
    }
     
    if(typeof(contentTypeFlag) == 'undefined'){
      contentTypeFlag = 'application/x-www-form-urlencoded';
    }

    $(".js-data-table .overlay").show();
    
    geturl = $.ajax({
        url: url,
        data: data,
        processData: processDataFlag,
        contentType: contentTypeFlag,
        type: method,
        dataType: dataType,
        cache: false,
        success: successHandlerFunction,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        complete: function() {
            $(".js-data-table .overlay").hide();
        }
    });
}

// define
var paginationComponent = Vue.extend({
  template: '<div class="dataTables_length pull-left pagination-length-div"><select id="pagination_length" name="pagination_length" aria-controls="pagination_length" class="form-control select2-hide-search-box input-xsmall input-inline"><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="-1">All</option></select></div><div class="dataTables_info pull-left margin-7" id="pagination_record_msg"></div>'
});

// register
Vue.component('pagination_component', paginationComponent);

function setPaginationRecords(start, records, totalcount) {
    if(records > totalcount) {
        $("#pagination_record_msg").html("Showing "+ start +" to "+ totalcount +" of "+ totalcount +" entries");
    } else {
        $("#pagination_record_msg").html("Showing "+ start +" to "+ records +" of "+ totalcount +" entries");
    }
}
function setPaginationAmount() {
    var set_pagination = '';

    if(typeof(Cookies.get('pagination_length')) == "undefined"){
        set_pagination += "&pagination_length=10";
    }
    else{
        if(Cookies.get('pagination_length') == -1){
            set_pagination += "&pagination=false";
        }
        else{
            set_pagination += "&pagination_length="+Cookies.get('pagination_length');
        }
    } 
    return set_pagination;
}

function initPaginationRecord() {
    setTimeout(function(){
        if(typeof(Cookies.get('pagination_length')) != "undefined"){
            $("#pagination_length").val(Cookies.get('pagination_length'));
        } else {
            Cookies.set('pagination_length', PageLimit);
        }
    });
}
function clearFormData(formId) {
    setTimeout(function(){
        $("#"+formId).find("input").val('');
        $("#"+formId).find("textarea").val('');

        if($("#"+formId).find(".select2-allow-clear").length) {
            $("#"+formId+" .select2-allow-clear").each(function(){
                $(this).select2("val", "");
            });
        }
    }, 20);
}
function setDefaultData(vueId) {
    vueId.currPage = 1;
    vueId.sortby = 'id';
    vueId.sorttype = 'desc';
    vueId.searchdata = '';
}


var wazirFunction = {
    timerTop: function () {
        setInterval(function () {
            var date = new Date();
            var d = new Date();

            var options = {hour12: false};
            // document.getElementById('myTime').innerHTML = date.toDateString();
            // document.getElementById('myTimeData').innerHTML = d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
        }, 1000);
    },
    widgetSetting: function () {
        $('.widget-setting a.setting').click(function () {
            $('.widget-setting a').not('.setting').toggleClass('icon-hidden icon-show');
            $('.widget-setting span.overlay').toggleClass('opn-bg');
            $(this).toggleClass("fa-cog").toggleClass("fa-times");
        });
    }
};

$(document).ready(function(){
  wazirFunction.timerTop();
  wazirFunction.widgetSetting();
});