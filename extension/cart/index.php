<?php
/*
 * Страница index
 */


defined('__CMS__') or die;

include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once 'inc.php';

$c_cart = new \project\cart();
$p_user = new \project\user();


$form_show = 0;
if (isset($_GET['ya_payment_true'])) {
    $form_show = 1;
    ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-12">
                <h3>Проверить платеж</h3>
            </div>
            <div class="col-lg-12 pay_result form_result pt-5 pb-5 font-size-20">

            </div>
            <div class="col-lg-12">
                <a href="javascript:void(0)" class="btn btn-primary pay_check">Проверить подтверждение платежа</a>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(".pay_check").click(function () {
                $(".form_result").html("");
                sendPostLigth('/check_pay.php', {"check_pay": 'ya'}, function (e) {
                    //console.log(e);
                    $(".form_result").html(e['success_text']);
                    if (e['success'] == '1') {
                        $(".pay_check").html("Перейти в личный кабинет");
                        $(".pay_check").attr("href", "/office/");
                    }
                });
            });
            sendPostLigth('/check_pay.php', {"check_pay": 'ya'}, function (e) {
                $(".form_result").html(e['success_text']);
            });

            window.dataLayer = window.dataLayer || [];
            for (var i = 0; i < cart_itms.length; i++) {
                var isPromo = 0;
                var product_price = 0;
                if (cart_itms[i]['price_promo'].length > 0 && Number(cart_itms[i]['price_promo']) > 0) {
                    isPromo = 1;
                }
                if (isPromo == 1) {
                    product_price = cart_itms[i]['price_promo'];
                } else {
                    product_price = cart_itms[i]['price'];
                }
                var product_info_title = $.trim(cart_itms[i]['title']);
                var product_info_price = product_price;
                //console.log("product_info_title: " + product_info_title + ' - ' + product_info_price);
                dataLayer.push({
                    'ecommerce': {
                        'currencyCode': 'UAH',
                        'coupon': none, // Должен подтягиваться код купона при успешной реализации 
                        'checkout': {
                            'actionField': {'step': 1},
                            'products': [{
                                    "name": product_info_title, // например, https://prnt.sc/un4kvj 
                                    "price": product_info_price, // например, https://prnt.sc/un4kvj 
                                    "quantity": 1 // Количество, например, https://prnt.sc/un4kvj 
                                },
                                {
                                    "name": product_info_title,
                                    "price": product_info_price,
                                    "quantity": 1
                                }]
                        }
                    },
                    'event': 'gtm-ee-event',
                    'gtm-ee-event-category': 'Enhanced Ecommerce',
                    'gtm-ee-event-action': 'Checkout Step 1',
                    'gtm-ee-event-non-interaction': 'False',
                });
            }
        });
    </script>
    <?
}

if (isset($_GET['in_payment_true'])) {
    $form_show = 1;
    ?>

    <div class="container mb-5">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card text-center mt-5 mb-5">
                    <!--
                    <div class="card-header">
                        
                    </div>
                    -->
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-12 mb-5 mt-3">
                                        <h2>Платеж принят</h2>
                                    </div>
                                    <div class="col-lg-12">
                                        <a href="/office/" class="btn btn-primary">Перейти в личный кабинет</a>
                                    </div>

                                </div>
                            </div>
                        </div> 
                    </div> 
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
    <?
}

if ($form_show == 0) {

    /**
     * Подготови данные для PayPal
     */
    $url_ref = $config->getConfigParam('pay_site_url_ref');
    $url_ref = "{$url_ref}/shop/cart/?pay_payment_true=1";

    $paypal_email = $config->getConfigParam('paypal_email');

    $price_total = 0;
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart']['itms']) > 0) {
        $title = "";
        foreach ($_SESSION['cart']['itms'] as $key => $value) {
            $email = $value['user_email'];
            $title .= $value['pay_descr'] . " : ";
            if ($value['price_promo'] > 0) {
                $price = $value['price_promo'];
            } else {
                $price = $value['price'];
            }
            $price_total += $price;
        }
    }

    /**
     * Заглушка для админов покупка за 1 рубль
     */
    if ($p_user->isEditor()) {
        $price_total = 1;
    }


    // Если авторезированный
    if (strlen($p_user->isClientEmail()) > 0) {
        $email = $p_user->isClientEmail();
    }

    include 'tmpl/index.php';
} else {
    if (count($_SESSION['cart']['itms']) > 0) {
        $_SESSION['cart']['cart_itms'] = $_SESSION['cart']['itms'];
    }
    /*
     * Отметим что купили продукт
     */
    ?>
    <script>
        window.dataLayer = window.dataLayer || [];
    <?
    foreach ($_SESSION['cart']['cart_itms'] as $key => $value) {

        $isPromo = 0;
        if ($value['price_promo'] > 0) {
            $isPromo = 1;
        }
        if ($isPromo == 1) {
            $product_price = $value['price_promo'];
        } else {
            $product_price = $value['price'];
        }
        $product_info_title = $value['title'];
        $product_info_price = $product_price;
//echo "T: {$product_info_title} p: {$product_info_price}<br/>\n";
        ?>
            dataLayer.push({
                'ecommerce': {
                    'currencyCode': 'RUB',
                    'purchase': {
                        'actionField': {
                            'id': "<?= $_SESSION['cart']['pay_id'] ?>",
                            'revenue': "<?= $_SESSION['cart']['total'] ?>",
                        },
                        'products': [{
                                "name": "<?= $product_info_title ?>",
                                "price": "<?= $product_info_price ?>",
                                "quantity": 1,
                            },
                            {
                                "name": "<?= $product_info_title ?>",
                                "price": "<?= $product_info_price ?>",
                                "quantity": 1,
                            }]
                    }
                },
                'event': 'gtm-ee-event',
                'gtm-ee-event-category': 'Enhanced Ecommerce',
                'gtm-ee-event-action': 'Purchase',
                'gtm-ee-event-non-interaction': 'False',
            });
        <?
    }
    ?>
    </script>
    <?
}

