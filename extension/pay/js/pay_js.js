var pay_num = 1;
var pay_list_col = 0;
var pay_list_col_true = 1;
var search_pay_user_str = '';
$(document).ready(function () {
    init_pay_data_list();
    init_get_next_page();
    init_search_pay_user();
});

/**
 * Список платежей
 * @returns {undefined}
 */
function init_pay_data_list() {
    // pay_datas_page
    sendPostLigth('/jpost.php?extension=pay', {"pay_data_page": pay_num, "search_pay_user_str": search_pay_user_str}, function (e) {
        $(".pay_data tbody").html("");

        for (var i = 0; i < e['data'].length; i++) {
            var user_title = '';
            var user_descr = '';
            var pay_result_id = '';
            if (e['data'][i]['email'].length > 0) {
                user_title = e['data'][i]['email'];

                if (e['data'][i]['phone'].length > 0) {
                    user_title = e['data'][i]['email'] + '<br/>' + e['data'][i]['phone'];
                }
                user_descr = e['data'][i]['first_name'] + ' ' + e['data'][i]['last_name'];


                if (e['data'][i]['pay_key'].length > 0) {
                    pay_result_id = e['data'][i]['pay_key'];
                }
                if (e['data'][i]['pay_interkassa_id'].length > 0) {
                    pay_result_id = e['data'][i]['pay_interkassa_id'];
                }

                var pay_status = e['data'][i]['pay_status'];
                var border_class = '';
                if (e['data'][i]['pay_status'] === 'succeeded') {
                    pay_status = 'выполнено';
                    border_class = 'table-success';
                }
                if (e['data'][i]['pay_status'] === 'canceled') {
                    pay_status = 'отмененная';
                    border_class = 'table-danger';
                }
                if (e['data'][i]['pay_status'] === 'pending') {
                    pay_status = 'Незавершенная';
                    border_class = 'table-danger';
                }
                
                
                var processed = '<a href="javascript:void(0)" objid="' + e['data'][i]['id'] + '" class="btn btn-danger btn-pill btn_set_processed btn-sm text-nowrap">не просмотрено</a>';
                if (e['data'][i]['processed'] == '1') {
                    processed = '<a href="javascript:void(0)" objid="' + e['data'][i]['id'] + '" class="btn btn-success btn-pill btn_set_processed btn-sm text-nowrap">обработано</a>';
                }

                $(".pay_data tbody").append('<tr class="' + border_class + '" objid="' + e['data'][i]['id'] + '" title="' + user_descr + '"> \
                                    <td class="text-center">' + e['data'][i]['id'] + '</td> \
                                    <td>' + user_title + '</td> \
                                    <td class="text-center">' + e['data'][i]['pay_type_title'] + '</td> \
                                    <td class="text-center font-weight-bold">' + e['data'][i]['pay_sum'] + '</td> \
                                    <td class="text-center">' + e['data'][i]['pay_date'] + '</td> \
                                    <td class="text-center">' + pay_status + '</td> \
                                    <td class="text-center">' + pay_result_id + '</td> \
                                    <td class="text-center">' + processed + '</td> \
                                    </tr>');
            }
        }
        if (pay_list_col_true === 1 && pay_list_col == e['data'].length) {
            $(".get_next_page").hide();
        } else {
            $(".get_next_page").show();
            pay_list_col = e['data'].length;
        }
        init_btn_set_processed();
        pay_list_col_true = 1;
    });
}

/**
 * отметить что просмотрено
 * @returns {undefined}
 */
function init_btn_set_processed() {
    $(".btn_set_processed").unbind("click").click(function () {
        pay_list_col_true = 0;
        var objid = $(this).attr("objid");
        sendPostLigth('/jpost.php?extension=pay', {"set_processed": objid}, function (e) {
            init_pay_data_list();
            init_not_processed_col();
        });
    });
}

/**
 * Кнопка отобразить следующие данные
 * @returns {undefined} 
 */
function init_get_next_page() {
    $(".get_next_page").unbind("click").click(function () {
        pay_num = pay_num + 1;
        init_pay_data_list();
    });
}

function init_search_pay_user() {
    $(".search_pay_user").change(function () {
        pay_list_col_true = 0;
        search_pay_user_str = $(this).val();
        pay_num = 1;
        init_pay_data_list();
    });
}