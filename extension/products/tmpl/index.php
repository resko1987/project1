<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<link rel="stylesheet" href="/extension/products/product.css<?= $_SESSION['rand'] ?>">

<div class="row">
    <div class="col-lg-12" style="background-color: #DEDEDE;height: 66px;"></div>
</div>
<div class="container" style="margin-top: -70px;">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-10 p-3">
            <div class="input-group mb-3">
                <input type="text" value="<?= $_SESSION['product']['filter']['productSearchString'] ?>" class="form-control productSearchString" placeholder="Я ищу..." aria-label="Я ищу..." aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-light " type="button"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <!-- <input type="text" name="searchProductStr" value="" class="form-control searchProductStr" placeholder="Я ищу..." /> -->
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-12">
            <?= $page->bread_get() ?>
        </div>
    </div>

    <div class="row">

        <?
        /*
         * Отображаем филтры
         */
        if (!isset($_GET['product'])) {
            include_once 'index_filter.php';
        }
        ?>



        <?
        /*
         * Список продуктов
         */
        if (!isset($_GET['product'])) {
            ?>
            <div class="col-lg-10">
                <!-- Sorted block -->    
                <div class="row mt-4 mb-4">
                    <div class="col-12">
                        <div class="row controls">
                            <!--
                            <div class="btn_category_controll border_radius3">
                                <div class="control" data-filter="all">Все</div>
                            </div>
                            -->
                            <div class="col-lg-3">
                                <button type="button" data-filter="all" class="btn_category_controll btn_category_controll_active border_radius3 mb-2">Все</button>
                            </div>
                            <?
                            //$colorArray = array(); $categoryArray
                            /*
                              <button type="button" data-filter="all">All</button>
                              <button type="button" data-filter=".category-a">Category A</button>
                              <button type="button" data-filter=".category-b">Category B</button>
                              <button type="button" data-filter=".category-c">Category C</button>
                             * <button type="button" class="control " data-filter=".category-<?= $value['id'] ?>"><?= $value['title'] ?></button>
                             * <div class="btn_category_controll border_radius3 mb-2">
                              <div class="control" data-filter=".category-<?= $value['id'] ?>"><?= $value['title'] ?></div>
                              </div>
                             */
                            foreach ($categoryArray as $value) {
                                //$colorArray[$value['id']] = randomColor();
                                ?>
                                <div class="col-lg-3">
                                    <button type="button" data-filter=".category-<?= $value['id'] ?>" class="btn_category_controll border_radius3 mb-2"><?= $value['title'] ?></button>
                                </div>
                                <?
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Sorted block end -->    




                <!-- product list -->
                <div class="row container_mix row-cols-1 row-cols-md-3" data-ref="mixitup-container">
                    <?
                    //$obj_product['products_wares'] = $this->getProducts_wares($obj_product['id']);
                    //$obj_product['products_category'] = $this->getProducts_category($obj_product['id']);
                    //$obj_product['products_topic'] = $this->getProducts_topic($obj_product['id']);
                    //$i_col = 3; // колличество отображаемых
                    //$a_col = 0; // итерация
                    for ($i = 0; $i < $productsFilterCount; $i++) {
//                        $a_col++;
//                        $iter_css = 'margin-left: 4.433%;';
//                        if($a_col == 1){
//                            $iter_css = '';
//                        }
//                        if($i_col == $a_col){
//                            $a_col = 0;
//                        }
                        // Найдем товары
                        //$waresInfo = $c_product->getWaresInfo($productsFilterArray[$i]['wares_ids']);
                        // Определим категорию
                        $title_category = '';
                        $exp_category_ids = explode(',', $productsFilterArray[$i]['category_ids']);
                        $category_count = count($exp_category_ids);
//
                        $class_category = '';
                        $color_category = '';
                        $title_category = '';
                        $category_title = '';
                        $item_category_id = '0';
                        if ($category_count > 0) {
                            for ($c = 0; $c < $category_count; $c++) {
                                for ($c2 = 0; $c2 < count($categoryArray); $c2++) {
                                    if ($categoryArray[$c2]['id'] == $exp_category_ids[$c]) {
                                        $positio_z = $c * 2.8;
                                        $position = "margin-top: {$positio_z}rem;";
                                        $bg_category = 'background-color: ' . $categoryArray[$c2]['color'] . ';';
                                        $color_category = 'color: ' . $categoryArray[$c2]['color'] . ';';
                                        $title_category .= "<span class=\"class_category_lbl opacity50\" style=\"{$bg_category}{$position}\">{$categoryArray[$c2]['title']}</span>";
                                        $class_category .= 'category-' . $categoryArray[$c2]['id'] . ' ';
                                        $category_title .= "<span class=\"class_category\" style=\"{$color_category}\">{$categoryArray[$c2]['title']}</span> ";
                                        $item_category_id = $categoryArray[$c2]['id'];
                                    }
                                }
                            }
//                            if(strlen($category_title)>0){
//                                $category_title = $category_title . ' ';
//                            }
                        }

                        // border: 1px solid #CCC;
                        // category_name=" $categoryArray[$item_category_id] " data-ref="mixitup-target"
                        // $class_category
                        $display = '';
                        if ($i > 6) {
                            $display = 'display: none;';
                        }
                        ?>
                        <div class="col mb-4 mixitup-container <?= $class_category ?>" i='<?= $i ?>' data-ref="mixitup-target" style="<?= $display ?>">
                            <div class="card p-4 item"> 
                                <div class="row h-100 d-inline-block pl-3 pr-3">
                                    <div class="col-12 h-100 d-flex flex-column product_info">
                                        <?= $title_category ?>
                                        <div class="row waresListImages">
                                            <?
                                            /*
                                             * Product Images
                                             */
                                            $image = $productsFilterArray[$i]['images_str'];//$c_product->checkImageFile($productsFilterArray[$i]['images_str']);
                                            //echo "{$productsFilterArray[$i]['images_str']} <br/>";
                                            if (strlen($image) > 0) {
                                                ?>
                                                <div class="<?= $sclass_boot ?> align-self-center text-center w-100 <?= ($ii > 0) ? $scaleN : $scale ?>">
                                                    <a href="<?= urlRequestAddLink('product=' . $productsFilterArray[$i]['id']) ?>">
                                                        <img data-src="<?= $productsFilterArray[$i]['images_str'] ?>" src="/assets/img/no_tovar_bg.jpg" class="lazyload waresImg waresListImagesStyle1" title="<?= $productsFilterArray[$i]['title'] ?>" />
                                                    </a>
                                                </div>    
                                                <?
                                            } else {
                                                ?>
                                                <div class="<?= $sclass_boot ?> align-self-center  text-center w-100 <?= ($ii > 0) ? $scaleN : $scale ?>">
                                                    <a href="<?= urlRequestAddLink('product=' . $productsFilterArray[$i]['id']) ?>">
                                                        <img data-src="/assets/img/no_tovar_bg.jpg" src="/assets/img/no_tovar_bg.jpg" class="lazyload waresListImagesStyle1" title="<?= $productsFilterArray[$i]['title'] ?>" />
                                                    </a>
                                                </div>
                                                <?
                                            }
                                            ?>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-mb-12">
                                                <? if ($productsFilterArray[$i]['price_promo'] > 0): ?>
                                                    <div style="clear: both;">
                                                        <span class="init_price_val product_info_price" style="color:#FF0000;"><?= $productsFilterArray[$i]['price_promo'] ?></span>
                                                        <span class="wares_old_price" style="margin-left: 16px;"><span class="init_price_val"><?= $productsFilterArray[$i]['price'] ?></span> <i class="fa fa-ruble"></i></span>
                                                    </div>
                                                <? else: ?>
                                                    <div style="clear: both;">
                                                        <span class="init_price_val product_info_price"><?= $productsFilterArray[$i]['price'] ?></span> <i class="fa fa-ruble"></i>
                                                    </div>
                                                <? endif; ?>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-mb-12">
                                                <div class="cart_product_title_block">
                                                    <a href="<?= urlRequestAddLink('product=' . $productsFilterArray[$i]['id']) ?>" class="product_links product_info_title">
                                                        <?= $category_title ?>&nbsp;&nbsp;<span class="cart_product_title"><?= mb_strimwidth($productsFilterArray[$i]['title'], 0, 100, "...") ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?
                                        /*
                                          <div class="row" style="display: none;">
                                          <div class="col-mb-12">
                                          <div class="rating-mini mt-3">
                                          <span class="active"></span>
                                          <span class="active"></span>
                                          <span class="active"></span>
                                          <span></span>
                                          <span></span>
                                          </div>
                                          <span class="rating_number">(2348)</span>
                                          </div>
                                          </div>
                                         */
                                        ?>
                                        <div class="row bd-highlight cart_product_button_bg">
                                            <div class="col-12">
                                                <? if ($productsFilterArray[$i]['product_new'] == '1'): ?>
                                                    <div class="float-left">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" viewBox="0 0 35 35">
                                                        <image id="new" width="35" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC8AAAAwCAYAAACBpyPiAAADwklEQVRogd2ab2hPURjHP7bf5t/YykLRJKZYRFLkz4u9JLXSWl7RRCSLtyYUySvtFZYymrzRamhT8waTFyRipjbEXghta5QM4+j8PFfH3e+ec+/P3X6/n2893XvPfc55vvfc55z7POdcFMQtExTsUnBbwWs57pTyWG3FTbxQQYsClUJa5H5Wkp+ioCOAuCcdojfu5PMVzFVQlOJesYI7DuKeaL3iFG0USfv5YTkl/dCBQuAosAcoEdV+4CXQC7wHNgOL3E39QQ9wHZgFlAMLgFK5OQScEZvfrK2EeMIgHx5raflXt6nMEHFPKm388hyvd2MEVxgLWO27yC/PMHmrfRf5pfFyiQyrfRt5PRPMzCz3pP1ZQTdt5DeMDZ/IWB9YIeATv1fBQIZnGk8GhM+o0MK8SCjYruBNlpD2yxvhl/CTX6mgO0tJ+6Vb+CbDg4XAQ2B6lvh4GHwCVuoBW59jxBG+9Zr8upAVTgKrgXtG2SCwCagBvgL3gVXA/BSySu5rvRqpN2i0pdtdI3bCYK32964QfjasIE/GxxIFI1LeaAz4dgVbHbFSrYI247rRsFFthN7DITh1JYAOoMLxpMPATznvBi4B24Avhs4337X+OuYb11OB3cBbo8zU/y7HH2JvooNTh3abBqNiWBwXIzZ0Ao8MuSuuEwc03wZNvg84H7HyC6A5JiLpQPPt88KDE2n0/hFHpnMZuChyFRgJ0OuUzCosvgvfvwZTs2VwDAUMwMXGeauCKstgrZO2tJ5XtkyOkxVUGLpDFi7NYZORVNCDOyHlz9Oob+KJHPXAfRa1skeiTObqMCiXgXfBoXsamCLnJTKvx4Ea+bD2ea/prGNONd2mSlbC/FGe322CXr3pNkFicxslfJNuo3u9NmKPzEujThB28Du+igJtu0yT3w8UpGH0oKzpBEEnESsM0WHIA59uocxahyLaLkjyjhAeeCtZ1Ub5PuO1t6URHngz0Igxc+VFCQ9svedBf6qPAdfkTXk4LB+sIqBSVr16ZUXNj1IJD3TYUA18lvpIGHEOOABsCREakNRR0JQjSYhfmnI6GcnpNPC/SMBzfunDL9VZQFwZGdYosW0u6GW2d+M2BIMxWzYwRsEWVeoKHzJIGrGfkjghQuKn8fOJBKt9F/nHmeEczr6LfHu8XCLjhrVCFm+oXXFxyz/q7otWybh0QDVJyvrFH28BNyXomhGhW3skE3slKeAkI+v6CJwC6pzLKyF63pOx3kSepmBOlE3kKORdktXb92EkZ3+c8CTVLyv6Ot5fVoBf2x3bkjyBzSEAAAAASUVORK5CYII="/>
                                                        </svg>
                                                    </div>
                                                <? endif; ?>
                                                <div class="float-right">
                                                    <a href="javascript:void(0)" class="btn btngreen cart_product_add" product_id="<?= $productsFilterArray[$i]['id'] ?>">В корзину</a>
                                                    <div class="btn-group">
                                                        <a href="/shop/cart/" class="btn btngreen align-self-center cart_product_go_card" product_id="<?= $productsFilterArray[$i]['id'] ?>" style="display: none;">Продолжить</a>
                                                        <a href="javascript:void(0)" class="btn btn-danger cart_product_remove cart_product_go_card" product_id="<?= $productsFilterArray[$i]['id'] ?>" style="display: none;" title="Удалить из корзины"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?
                        unset($waresInfo);
                    }
                    ?>
                </div>
                <hr class="product_load_next" />
            </div>
            <hr class="d-block d-md-none pb-3 pt-3 mb-3 mt-3" />

            <?
            /*
             * Карточка товара
             */
        } else {
            include_once 'index_cart.php';
        }
        ?>
    </div>

</div>



<div class="row">
    <div class="col-lg-12" style="height: 100px;"></div>
</div>
<script>
    var searchProductStr = '';
    $.fn.isInViewport = function () {
        var elementTop = 0;
        if (!!$(this).offset()) {
            elementTop = $(this).offset().top;
        }
        var elementBottom = elementTop + $(this).outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
        return elementBottom > viewportTop && elementTop < viewportBottom;
    };

    $(document).ready(function () {



        setInterval(function () {
            var filter = $(".btn_category_controll_active").attr("data-filter");
            if ($(".product_load_next").isInViewport() && filter == 'all') {
                var i = 0;
                var max = 6;
                var t = 1;
                $(".container_mix").find(".mixitup-container").each(function () {
                    i++;
                    if ($(this).is(':hidden') && max > 0) {
                        max--;
                        var e = this;
                        setTimeout(function () {
                            $(e).show(400);
                        }, (t * 300));
                        t = t + 1;
                    }
                    if (max < 0) {
                        max = 10;
                        t = 1;
                    }
                });
            } else {

            }
        }, 1000);


        $('.carousel').carousel({
            interval: 2000
        })

        $("img.lazyload").lazyload();
        /*
         * Актив\ация фильтра каталога
         * @type Element
         */
        var containerEl = document.querySelector('[data-ref~="mixitup-container"]');
        if (!!containerEl) {
            var mixer = mixitup(containerEl, {
                selectors: {
                    target: '[data-ref~="mixitup-target"]'
                }
            });
        }

        $(".btn_category_controll").click(function () {
            $(".btn_category_controll").removeClass("btn_category_controll_active");
            $(this).addClass("btn_category_controll_active");
        });
        $(".waresImg").mouseover(function () {
            $(this).css("position", "sticky");
        }).mouseout(function () {
            $(this).css("position", "static");
        });
        $(".searchProductStr").keyup(function () {
            var v = $(this).val();
            setSearchProductStr(v);
            if (v.length > 1) {

            }
        });
        /**
         * Продукты 
         * @returns {undefined}
         */
        function getProducts() {
            sendPostLigth('/jpost.php?extension=products', {"getProducts": '1', "searchStr": searchProductStr}, function (e) {
                // console.log(e['data']);
                $(".elements_products").html(e['data']);
            });
        }

        $(".productNew").change(function () {
            var checked = 0;
            if ($(this).prop('checked')) {
                checked = 1;
            }
            sendPostLigth('/jpost.php?extension=products', {"checkedProductNew": checked}, function (e) {
                document.location.reload();
            });
            //$(this).prop('checked', true);
        });
        $(".productPromo").change(function () {
            var checked = 0;
            if ($(this).prop('checked')) {
                checked = 1;
            }
            sendPostLigth('/jpost.php?extension=products', {"checkedProductPromo": checked}, function (e) {
                document.location.reload();
            });
        });
        $(".check_categorys").change(function () {
            var checked = 0;
            var val = $(this).val();
            if ($(this).prop('checked')) {
                checked = 1;
            }
            sendPostLigth('/jpost.php?extension=products', {"check_categorys": val, "checked": checked}, function (e) {
                document.location.reload();
            });
        });
        $(".productSearchString").change(function () {
            var productSearchString = $(this).val();
            sendPostLigth('/jpost.php?extension=products', {"productSearchString": productSearchString}, function (e) {
                document.location.reload();
            });
        });
        initCartProductAdd();
        initCartProductRemove();
    });
    function setSearchProductStr(v) {
        searchProductStr = v;
    }

    // Показы товаров -------------
    window.dataLayer = window.dataLayer || [];
    $(".product_info").each(function () {
        var product_info_title = $.trim($(this).find(".product_info_title").html());
        var product_info_price = $.trim($(this).find(".product_info_price").html());

        dataLayer.push({
            "ecommerce": {
                "currencyCode": "RUB",
                "impressions": [{
                        "name": product_info_title, // Например, https://prnt.sc/un3f6x 
                        "price": product_info_price, // Например, https://prnt.sc/un3hf7 
                    },
                    {
                        "name": product_info_title, // Например, https://prnt.sc/un3f6x 
                        "price": product_info_price, // Например, https://prnt.sc/un3hf7 
                        "category": "{Категория товара}",
                    }]
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Product Impressions',
            'gtm-ee-event-non-interaction': 'True',
        });
    });


</script>