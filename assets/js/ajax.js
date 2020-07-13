/* 
 * Отправка данных из формы
 */
var ajax_load = '<div class="ajax_load col-md-12 mb-4"><center><img src="/assets/img/ajax_load_2.svg" style="width: 40px;" /></center></div>';
(function ($) {
    $.fn.sendPost = function (func) {
        
        var make = function () {
            // реализация работы метода с отдельным элементом страницы
            var obj = this;
            $(this).submit(function (e) {
                $('.form_result').hide(200);
                $('.form_result').after(ajax_load);
                
                var objid = $(obj)[0]['id'];
                //console.log("sendPost1 " + objid);
                e.preventDefault();

                // переменная, которая будет содержать данные серилизации
                var $data;
                // в зависимости от того какую нажали кнопку, выполняем
                // серилизацию тем или иным способом
                //if ($(this).attr('data-method') == 'serialize') {
                $data = $(obj).serialize();
                //} else {
                //    $data = $(this).parent('form').serializeArray();
                //}
                // для отправки данных будем использовать технологию ajax
                //   url - адрес скрипта, с помощью которого будем обрабатывать форму на сервере
                //   type - метод отправки запроса (POST)
                //   data - данные, которые необходимо передать серверу
                //   success - функция, которая будет вызвана, когда ответ прийдёт с сервера
                $.ajax({
                    url: $(obj).attr('action'),
                    type: 'post',
                    dataType: 'json',
                    data: $data,
                    success: function (result) {
                        /*
                         * Обработка ответа от сервера
                         */
                        $(".ajax_load").remove();
                        $('.form_result').html("");
                        var metod = 0;
                        if (result['success'] == 1) {
                            $('.form_result').removeClass("alert-danger");
                            $('.form_result').addClass("alert").addClass("alert-success");
                            $('.form_result').append(result['success_text']);
                            metod = 1;
                        }
                        if (result['success'] == 0) {
                            if (result['errors'].length > 0) {
                                $('.form_result').removeClass("alert-success");
                                $('.form_result').addClass("alert").addClass("alert-danger");
                                for (var i = 0; i < result['errors'].length; i++) {
                                    $(obj).find(".form_result").append("<div>" + result['errors'][i] + "</div>\n");
                                }
                            }
                            metod = 2;
                        }
                        // Непредвиденная ошибка, если result['success'] не передали
                        if (metod == 0) {
                            if (!!result['errors'] && result['errors'].length > 0) {
                                $('.form_result').removeClass("alert-success");
                                $('.form_result').addClass("alert").addClass("alert-danger");
                                for (var i = 0; i < result['errors'].length; i++) {
                                    $(obj).find(".form_result_error").append("Error system №101 !");
                                }
                            }
                        }
                        $('.form_result').show(200);
                        // Выполнить втроенную функцию
                        func(result);
                        // Выполнить переадресацию
                        if (!!result['action'] && result['action'].length > 0) {
                            var action_time = 3;
                            if (!!result['action_time'] && Number(result['action_time']) > 0) {
                                action_time = Number(result['action_time']);
                            }
                            setTimeout(function () {
                                window.location.href = result['action'];
                            }, (action_time * 1000));

                        }

                        // Добавить кнопку закрыть
                        //$('.form_result').append('<button type="button" class="close"'
                        //        + ' data-dismiss="alert" aria-label="Close">'
                        //        + '<span aria-hidden="true">×</span></button>');

                        // Скроем ответы серез 20 сек.
                        setTimeout(function () {
                            $('.form_result').hide();
                        }, 20000);
                    }
                });
            });
        };

        return this.each(make);

    };
})(jQuery);
