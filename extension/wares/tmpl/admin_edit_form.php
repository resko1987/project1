<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">

                <div class="card-header card-header-border-bottom">
                    <h2 class="col-lg-6">Управление товаром</h2>
                </div>

                <div class="card-body form_save_wares">

                    <div class="form-group">
                        <label for="config_title">Название</label>
                        <input type="text" class="form-control wares_title" id="wares_title" placeholder="Наименование товара" required>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="config_code">Код товара</label>
                            <input type="text" class="form-control wares_ex_code" id="wares_ex_code" placeholder="Код" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="config_code">Артикул</label>
                            <input type="text" class="form-control wares_articul" id="wares_articul" placeholder="Артикул" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="config_code">Количество</label>
                        <input type="text" class="form-control wares_col" id="wares_col" onkeyup="this.value = this.value.replace(/[^0-9+]/, '')" placeholder="Количество товара в наличии" required>
                    </div>

                    <div class="form-group">
                        <label for="wares_descr">Подробное описание</label>
                        <textarea name="wares_descr" id="wares_descr" class="form-control wares_descr" placeholder="Текст описания" style="width: 100%;height: 100px;"></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="wares_url_file">Фаил с архивом</label>
                        <input type="text" class="form-control wares_url_file" id="wares_url_file" placeholder="Фаил" required>
                    </div>

                    <div class="form-group">
                        <label for="wares_active">Материалы</label><br/>
                        <a href="/extension/wares/videos.php?wares_id=<?= $wares_id ?>" class="btn btn-info mb-2 float-right" target="_blank">Редактировать материалы на отдельной странице</a>
                        <iframe src="/extension/wares/videos.php?wares_id=<?= $wares_id ?>" class="w-100" style="height: 600px;border: 0px;" ></iframe>
                    </div>

                    <div class="form-group">
                        <label for="wares_active">Отображение</label><br/>
                        <label class="switch switch-text switch-primary form-control-label">
                            <input type="checkbox" class="switch-input form-check-input wares_active" value="1" checked="checked">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                    <?
                    importELFinder(1);
                    ?>

                    

                    <input type="hidden" name="wares_id" class="wares_id" id="wares_id" value="0" />
                    <!--<button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Закрыть</button>-->
                    <a href="./" class="btn btn-danger">Закрыть</a>
                    <button type="button" class="btn btn-primary btn_save_config">Сохранить</button>

                </div>
            </div>

            <div class="form-footer pt-4 pt-5 mt-4 border-top">

            </div>


        </div>
    </div>
</div>  
<?
importWisiwyng('wares_descr');
?>

<script>
    var wares_id = '<?= $wares_id ?>';
    $(document).ready(function () {

        $(".btn_save_config").click(function () {
            var wares_id = $(".wares_id").val();
            var wares_title = $(".wares_title").val();
            var wares_ex_code = $(".wares_ex_code").val();
            var wares_articul = $(".wares_articul").val();
            var wares_col = $(".wares_col").val();
            var wares_descr = tinymce.get('wares_descr').getContent();
            var wares_url_file = $(".wares_url_file").val();
            // tinymce.get('wares_descr').setContent("<p>Hello world!</p>")
            var wares_active = 1;
            if (!$(".form_save_wares").find(".wares_active").prop('checked')) {
                wares_active = 0;
            }
            //var wares_active = $(".form_save_wares").find(".wares_active").val();

            let images_col = $('.image_elm').length;
            var images_str = [];
            for (var i = 0; i < images_col; i++) {
                images_str.push($($('.image_elm')[i]).find(".image_obj_value").val());
            }

            sendPostLigth('/jpost.php?extension=wares',
                    {"edit_wares": wares_id,
                        "wares_title": wares_title,
                        "wares_ex_code": wares_ex_code,
                        "wares_articul": wares_articul,
                        "wares_col": wares_col,
                        "wares_descr": wares_descr,
                        "wares_url_file": wares_url_file,
                        "wares_active": wares_active,
                        "wares_images": images_str.toString()},
                    function (e) {
                        if (e['success'] == '1') {
                            //$(".form_save_wares").find('data-dismiss="modal"').click();
                            $('#form_edit_wares_modal').modal('hide');
                            getWaresArray(searchStr);
                        }
                    });
        });

        save_wares_init();

    });

    // Инициализация кнопки редактирования
    function save_wares_init() {
        if (wares_id != '') {
            //clear_form_save_wares();
            //var wares_id = wares_id;
            sendPostLigth('/jpost.php?extension=wares',
                    {"getWaresElemId": wares_id},
                    function (e) {
                        if (e['success'] == '1') {
                            $(".wares_id").val(e['data']['id']);
                            $(".wares_title").val(e['data']['title']);
                            $(".wares_ex_code").val(e['data']['ex_code']);
                            $(".wares_articul").val(e['data']['articul']);
                            $(".wares_url_file").val(e['data']['url_file']);

                            var interval = setInterval(function () {
                                if (tinymce_init == 1) {
                                    tinymce.get('wares_descr').setContent(e['data']['descr']);
                                    clearInterval(interval);
                                }
                            }, 300);

                            $(".wares_col").val(e['data']['col']);

                            if (e['data']['active'] > 0) {
                                if (!$(".wares_active").is(':checked')) {
                                    $(".wares_active").click();
                                }
                            } else {
                                $(".wares_active").removeAttr("checked");
                            }

                            

                            /* -- images -- */
                            var images = e['data']['images'].split(',');
                            for (var i = 0; i < images.length; i++) {
                                $(".images").append(get_html_images_block(images[i], i));
                            }
                            /* -- images end -- */
                            $('#form_edit_wares_modal').modal('show');
                        }
                        block_checked_init();
                    });
        } else {
            $(".btn_wares_edit").click(function () {
                clear_form_save_wares();
                var wares_id = $(this).closest("tr").attr("elm_id");
                sendPostLigth('/jpost.php?extension=wares',
                        {"getWaresElemId": wares_id},
                        function (e) {
                            if (e['success'] == '1') {
                                $(".wares_id").val(e['data']['id']);
                                $(".wares_title").val(e['data']['title']);
                                $(".wares_ex_code").val(e['data']['ex_code']);
                                $(".wares_articul").val(e['data']['articul']);
                                $(".wares_url_file").val(e['data']['url_file']);
                                tinymce.get('wares_descr').setContent(e['data']['descr']);
                                $(".wares_col").val(e['data']['col']);
                                if (e['data']['active'] > 0) {
                                    if (!$(".wares_active").is(':checked')) {
                                        $(".wares_active").click();
                                    }
                                } else {
                                    $(".wares_active").removeAttr("checked");
                                }
                                /* -- images -- */
                                var images = e['data']['images'].split(',');
                                for (var i = 0; i < images.length; i++) {
                                    $(".images").append(get_html_images_block(images[i], i));
                                }
                                /* -- images end -- */
                                $('#form_edit_wares_modal').modal('show');
                            }
                        });
            });
        }


    }

    /**
     * Действия
     */
    function wares_delete_init() {
        $(".btn_wares_delete").click(function () {
            var wares_id = $(this).closest("tr").attr("elm_id");
            sendPostLigth('/jpost.php?extension=wares',
                    {"deleteWares": wares_id},
                    function (e) {
                        getWaresArray(searchStr);
                    });
        });
    }


    function wares_switch_init() {
        $(".wares_active_switch").unbind("click").click(function () {
            var wares_id = $(this).attr("elm_id");
            var checked = 0;
            if ($(this).prop('checked')) {
                checked = 1;
            }
            sendPostLigth('/jpost.php?extension=wares',
                    {"setWaresActive": wares_id,
                        "active": checked},
                    function (e) {
                        getWaresArray(searchStr);
                    });
        });
    }

  

</script>    