<?php

namespace project;

defined('__CMS__') or die;
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/category/inc.php';

class products extends \project\extension {

    private $products_wares = array();
    private $products_category = array();
    private $products_topic = array();
    private $products_theme = array();

    public function __construct() {
        parent::__construct();
    }

    /**
     * Сохраним данные по привязанным товарам
     * @param type $products_wares
     */
    function setProducts_wares($products_wares) {
        if (is_array($products_wares)) {
            $this->products_wares = $products_wares;
        }
    }

    /**
     * Сохраним данные для обработки по категориям
     * @param type $products_category
     */
    function setProducts_category($products_category) {
        if (is_array($products_category)) {
            $this->products_category = $products_category;
        }
    }

    /**
     * Темы
     * @param type $products_theme
     */
    function setProducts_theme($products_theme) {
        if (is_array($products_theme)) {
            $this->products_theme = $products_theme;
        }
    }

    /**
     * Темы продукта
     * @param type $products_topic
     */
    function setProducts_topic($products_topic) {
        if (is_array($products_topic)) {
            $this->products_topic = $products_topic;
        }
    }

    /**
     * Список продуктов с реализацией поиска
     * @param string $searchStr
     * @return array
     */
    public function getProductsArray($active, $searchStr) {
        if (strlen($searchStr) > 0) {
            $querySelect = "SELECT * FROM `zay_product` WHERE `active`='?' and `title` like '%?%' and `is_delete`='0' order by id desc ";
            $data = $this->getSelectArray($querySelect, array($active, $searchStr));
        } else {
            if ($active == 9) {
                $querySelect = "SELECT * FROM `zay_product` WHERE `is_delete`='1' order by lastdate desc";
                $data = $this->getSelectArray($querySelect, array());
            } else {
                $querySelect = "SELECT * FROM `zay_product` WHERE `active`='?' and `is_delete`='0' order by id desc";
                $data = $this->getSelectArray($querySelect, array($active));
            }
        }

        for ($i = 0; $i < count($data); $i++) {
            //$value['images_str'];
            $image = $data[$i]['images_str']; //$this->checkImageFile($value['images_str']);
            if (strlen($image) > 0) {
                $data[$i]['images_str'] = $image;
                ;
            } else {
                $data[$i]['images_str'] = '/assets/img/no_tovar_bg.jpg';
            }
            $data[$i]['wares_info'] = $this->getProducts_waresInfo($data[$i]['id']);
        }
        return $data;
    }

    /**
     * Данные по продукту
     * @param type $id
     * @return array
     */
    public function getProductElem($id) {
        if ($id > 0) {
            $querySelect = "SELECT p.*,"
                    . "(SELECT GROUP_CONCAT(c.`category_id`) FROM `zay_product_category` c WHERE c.`product_id`=p.`id`) as category_ids, "
                    . "(SELECT GROUP_CONCAT(t.`topic_id`) FROM `zay_product_topic` t WHERE t.`product_id`=p.`id`) as topic_ids "
                    . "FROM `zay_product` p WHERE id='?' ";
            $obj_product = $this->getSelectArray($querySelect, array($id))[0];
            $obj_product['products_wares'] = $this->getProducts_wares($obj_product['id']);
            $obj_product['products_category'] = $this->getProducts_category($obj_product['id']);
            $obj_product['products_topic'] = $this->getProducts_topic($obj_product['id']);
            $obj_product['products_theme'] = $this->getProducts_theme($obj_product['id']);

            if (count($obj_product['products_category']) > 0) {
                $category = new category();
                foreach ($obj_product['products_category'] as $key => $value) {
                    $obj_product['products_category_list'][] = $category->getCategoryElem($value)[0]['title'];
                }
            }

            $obj_product['products_wares_info'] = $this->getProducts_waresInfo($obj_product['id']);
            return $obj_product;
        }
        return array();
    }

    /**
     * Получить информацию по продукту из таблицы product
     * @param type $product_id
     * @return type
     */
    public function getProductSelect($product_id) {
        $query = "select * from `zay_product` where id='?'";
        return $this->getSelectArray($query, array($product_id))[0];
    }

    /**
     * Создание изменение товара
     * 
     * @param type $id
     * @param type $title
     * @param type $descr
     * @param type $col
     * @param type $ex_code
     * @param type $articul
     * @return boolean
     */
    public function insertOrUpdateProducts($id, $title, $desc_minimal, $price, $price_promo, $desc, $sold, $images_str, $product_new, $active = 1) {
        if ($id > 0) {
            $query = "UPDATE `zay_product` "
                    . "SET `title`='?', `desc_minimal`='?', `price`='?', `price_promo`='?', `desc`='?', `sold`='?', "
                    . "`images_str`='?', `product_new`='?', `active`='?', is_delete='0', `lastdate`=(DATE_ADD(NOW(), INTERVAL {$_SESSION['HOUR']} HOUR)) "
                    . "WHERE `id`='?' ";
            if ($this->query($query, array($title, $desc_minimal, $price, $price_promo, $desc, $sold, $images_str, $product_new, $active, $id), 0)) {
                $this->insertProductWares($id, $this->products_wares);
                $this->insertProductCategory($id, $this->products_category);
                $this->insertProductTopic($id, $this->products_topic);
                $this->insertProductTheme($id, $this->products_theme);
                return true;
            }
        } else {

            $query = "INSERT INTO `zay_product` (`title`, `desc_minimal`, `price`, `price_promo`, `desc`, `sold`, `images_str`, `product_new`, `active`, `lastdate`) "
                    . "VALUES ('?','?','?','?','?','?','?','?','?', (DATE_ADD(NOW(), INTERVAL {$_SESSION['HOUR']} HOUR)) )";
            if ($this->query($query, array($title, $desc_minimal, $price, $price_promo, $desc, $sold, $images_str, $product_new, $active))) {
                $querySelect = "SELECT MAX(p.id) as id FROM `zay_product` p ";
                $id = $this->getSelectArray($querySelect)[0]['id'];
                $this->insertProductWares($id, $this->products_wares);
                $this->insertProductCategory($id, $this->products_category);
                $this->insertProductTopic($id, $this->products_topic);
                $this->insertProductTheme($id, $this->products_theme);
                return true;
            }
        }

        return false;
    }

    /**
     * Привязка категорий
     * @param type $product_id продукт ид
     * @param type $wares_ids массив категорий
     */
    public function insertProductWares($product_id, $wares_ids_array) {
        if ($product_id > 0) {
            $queryDelete = "DELETE FROM `zay_product_wares` WHERE `product_id`='?' ";
            $this->query($queryDelete, array($product_id));
            $col = count($wares_ids_array);
            if ($col > 0) {
                for ($i = 0; $i < $col; $i++) {
                    $query = "INSERT INTO `zay_product_wares`(`product_id`, `wares_id`) VALUES ('?','?') ";
                    $this->query($query, array($product_id, $wares_ids_array[$i]));
                }
            }
        }
    }

    /**
     * Привязка категорий
     * @param type $product_id продукт ид
     * @param type $category_ids массив категорий
     */
    public function insertProductCategory($product_id, $category_ids_array) {
        if ($product_id > 0) {
            $queryDelete = "DELETE FROM `zay_product_category` WHERE `product_id`='?' ";
            $this->query($queryDelete, array($product_id));
            $col = count($category_ids_array);
            if ($col > 0) {
                foreach ($category_ids_array as $value) {
                    $query = "INSERT INTO `zay_product_category`(`product_id`, `category_id`) VALUES ('?','?') ";
                    $this->query($query, array($product_id, $value), 0);
                }
            }
        }
    }

    /**
     * Привязка тем
     * @param type $product_id продукт ид
     * @param type $topic_ids массив категорий
     */
    public function insertProductTopic($product_id, $topic_ids_array) {
        if ($product_id > 0) {
            $queryDelete = "DELETE FROM `zay_product_topic` WHERE `product_id`='?' ";
            $this->query($queryDelete, array($product_id));
            $col = count($topic_ids_array);
            if ($col > 0) {
                for ($i = 0; $i < $col; $i++) {
                    $query = "INSERT INTO `zay_product_topic`(`product_id`, `topic_id`) VALUES ('?','?') ";
                    $this->query($query, array($product_id, $topic_ids_array[$i]));
                }
            }
        }
    }

    /**
     * Привязка теме продукта
     * @param type $product_id продукт ид
     * @param type $theme_ids массив категорий
     */
    public function insertProductTheme($product_id, $theme_ids_array) {
        if ($product_id > 0) {
            $queryDelete = "DELETE FROM `zay_product_theme` WHERE `product_id`='?' ";
            $this->query($queryDelete, array($product_id));
            $col = count($theme_ids_array);
            if ($col > 0) {
                for ($i = 0; $i < $col; $i++) {
                    $query = "INSERT INTO `zay_product_theme`(`product_id`, `theme_id`) VALUES ('?','?') ";
                    $this->query($query, array($product_id, $theme_ids_array[$i]));
                }
            }
        }
    }

    /**
     * Список ID связанных товаров 
     * @param type $product_id
     * @return type
     */
    function getProducts_waresInfo($product_id) {
        $querySelect = "SELECT w.* " // GROUP_CONCAT()
                . "FROM `zay_product_wares` pw "
                . "left join `zay_wares` w on w.id=pw.wares_id "
                . "WHERE pw.`product_id`='?'  ";
        return $this->getSelectArray($querySelect, array($product_id));
    }

    /**
     * Список ID связанных товаров 
     * @param type $product_id
     * @return type
     */
    function getProducts_wares($product_id) {
        $querySelect = "SELECT pw.product_id, GROUP_CONCAT(pw.wares_id) as wares_ids "
                . "FROM `zay_product_wares` pw "
                . "WHERE pw.`product_id`='?' GROUP BY pw.product_id ";
        $this->products_wares = explode(',', $this->getSelectArray($querySelect, array($product_id))[0]['wares_ids']);
        return $this->products_wares;
    }

    /**
     * Список ID связанных категорий 
     * @param type $product_id
     * @return type
     */
    function getProducts_category($product_id) {
        $querySelect = "SELECT c.product_id, GROUP_CONCAT(c.category_id) as category_ids FROM `zay_product_category` c WHERE c.`product_id`='?'  GROUP BY c.product_id ";
        $this->products_category = explode(',', $this->getSelectArray($querySelect, array($product_id))[0]['category_ids']);
        return $this->products_category;
    }

    /**
     * Список ID связанных тем 
     * @param type $product_id
     * @return type
     */
    function getProducts_topic($product_id) {
        $querySelect = "SELECT t.product_id, GROUP_CONCAT(t.topic_id) as topic_ids FROM `zay_product_topic` t WHERE t.`product_id`='?' GROUP BY t.product_id ";
        $this->products_topic = explode(',', $this->getSelectArray($querySelect, array($product_id))[0]['topic_ids']);
        return $this->products_topic;
    }

    /**
     * Список ID связанных тем 
     * @param type $product_id
     * @return type
     */
    function getProducts_theme($product_id) {
        $querySelect = "SELECT t.product_id, GROUP_CONCAT(t.theme_id) as theme_ids FROM `zay_product_theme` t WHERE t.`product_id`='?' GROUP BY t.product_id ";
        $this->products_theme = explode(',', $this->getSelectArray($querySelect, array($product_id))[0]['theme_ids']);
        return $this->products_theme;
    }

    /**
     * Смена активности
     * @param type $id
     * @param type $val
     * @return type
     */
    public function setProductsActive($id, $val) {
        if ($id > 0) {
            $querySelect = "UPDATE `zay_product` set `active`='?' WHERE `id`='?' ";
            return $this->query($querySelect, array($val, $id));
        }
        return array();
    }

    /**
     * Удаление продукта
     * 
     * @param type $id
     * @param type $dell
     * @return boolean
     */
    public function deleteProducts($id, $is_delete = 1) {
        $querySelect = "select * from zay_product where id='?'";
        $obj = $this->getSelectArray($querySelect, array($id))[0];
        // Окончательное удаление
        if ($obj['is_delete'] == '1') {
            $query = "delete from `zay_product` WHERE `id`='?' ";
            if ($this->query($query, array($id))) {
                return true;
            }
        } else {
            $query = "UPDATE `zay_product` set `is_delete`='?' WHERE `id`='?' ";
            if ($this->query($query, array($is_delete, $id))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Список продуктов с реализацией поиска
     * @param type $searchStr строка поиска
     * @param type $searchCategoryIdStr категории строка
     * @param type $searchTopicIdStr темы строка
     * @param type $ProductPromo установлено промо
     * @param type $ProductNew новый продукт
     * @return type array
     */
    public function getProductsIndex($searchStr, $searchCategoryIdStr = '', $searchTopicIdStr = '', $ProductPromo = '', $ProductNew = '', $product_theme = '') {
        $data = array();
        $queryArray = array();


        if (strlen($searchStr) > 0) {
            $queryValSearchStr = "and (`title` like '%?%' or `desc` like '%?%')";
            $queryArray[] = $searchStr;
            $queryArray[] = $searchStr;
        }

        // Разберемся с категориями
        $queryValCategory = '';
        if (strlen($searchCategoryIdStr) > 0) {
            $queryValCategory = 'and c.category_id in(?)';
            $queryArray[] = $searchCategoryIdStr;
        }

        $queryValTopic = '';
//        if (strlen($searchTopicIdStr) > 0) {
//            $queryValTopic = 'and t.topic_id in(?)';
//            $queryArray[] = $searchTopicIdStr;
//        }
        if (is_array($_SESSION['product']['filter']['check_categorys']) && count($_SESSION['product']['filter']['check_categorys']) > 0) {
            $categorys = array();
            foreach ($_SESSION['product']['filter']['check_categorys'] as $value) {
                $categorys[] = "t.topic_id='?'";
                $queryArray[] = $value;
            }
            $queryValTopic = " and (" . implode(' or ', $categorys) . ") ";
        }

        $queryValPromo = '';
        if ($ProductPromo > 0) {
            $queryValPromo = 'and p.price_promo > 0';
        }

        $queryValProductNew = '';
        if ($ProductNew > 0) {
            $queryValProductNew = 'and p.product_new > 0';
        }

        $queryValTroductTheme = '';
        if ($product_theme > 0) {
            $queryValTroductTheme = " and pth.theme_id = '?' ";
            $queryArray[] = $product_theme;
        }

        $querySelect = "SELECT p2.*, 
            (SELECT GROUP_CONCAT(pw.`wares_id`) FROM `zay_product_wares` pw WHERE `product_id`=p2.`id`) as wares_ids,
            (SELECT GROUP_CONCAT(c.`category_id`) FROM `zay_product_category` c WHERE c.`product_id`=p2.`id`) as category_ids,
            (SELECT GROUP_CONCAT(t.`topic_id`) FROM `zay_product_topic` t WHERE t.`product_id`=p2.`id`) as topic_ids,
            (SELECT GROUP_CONCAT(t.`theme_id`) FROM `zay_product_theme` t WHERE t.`product_id`=p2.`id`) as product_theme_ids
                from `zay_product` p2 
                        where p2.id in(
                            SELECT p.id
                                FROM `zay_product` p
                                left join `zay_product_category` c on c.product_id=p.id
                                left join `zay_product_topic` t on t.product_id=p.id
                                left join `zay_product_theme` pth on pth.product_id=p.id
                                where p.`active`='1' and p.`is_delete`='0'  
                                {$queryValSearchStr} 
                                {$queryValCategory} 
                                {$queryValTopic}
                                {$queryValPromo}
                                {$queryValProductNew}
                                {$queryValTroductTheme}
                            GROUP by p.id   
                        ) ORDER BY p2.product_new desc, p2.id desc
                        ";

        //echo ""; 
        //print_r($_SESSION['product']['filter']['check_categorys']);
        $data = $this->getSelectArray($querySelect, $queryArray, 0);

        return $data;
    }

    /**
     * Информация о товарах
     * @param type $waresElementsIds Список через запятую
     * @return type Array
     */
    public function getWaresInfo($waresElementsIds) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/inc.php';
        $c_wares = new wares();
        $waresIds = explode(',', $waresElementsIds);
        $data = array();
        for ($i = 0; $i < count($waresIds); $i++) {
            $data[] = $c_wares->getWaresElem($waresIds[$i]);
        }
        return $data;
    }

    /**
     * Добавить или зименить отзыв в базе
     * @param type $reviews_id идентификатор отзыва
     * @param type $product_id
     * @param type $rating
     * @param type $user_name
     * @param type $reviews_text
     * @param type $reviews_acrive
     */
    public function setProductReviews($reviews_id, $product_id, $rating, $user_name, $reviews_text, $reviews_acrive) {
        if ($reviews_id > 0) {
            $query = "UPDATE `zay_product_reviews` "
                    . "SET `product_id`='?',`rating`='?',`user_name`='?',`reviews_text`='?',`reviews_acrive`='?' "
                    . "WHERE `id`='?' ";
            return $this->query($query, array($product_id, $rating, $user_name, $reviews_text, $reviews_acrive, $reviews_id));
        } else {
            $query = "INSERT INTO `zay_product_reviews`(`product_id`, `rating`, `user_name`, `reviews_text`, `reviews_acrive`, `creat_date`) "
                    . "VALUES ('?','?','?','?', '?',(DATE_ADD(NOW(), INTERVAL {$_SESSION['HOUR']} HOUR)) )";
            return $this->query($query, array($product_id, $rating, $user_name, $reviews_text, $reviews_acrive));
        }
    }

    /**
     * Получить отзыв по продукту
     * @param type $product_id
     * @return type
     */
    public function getProductReviewsArray($product_id) {
        $querySelect = "SELECT pr.*, DATE_FORMAT(pr.creat_date, \"%d.%m.%Y\") as creat_date_format "
                . "FROM `zay_product_reviews` pr "
                . "WHERE `product_id`='?' and `reviews_acrive`>0";
        return $this->getSelectArray($querySelect, array($product_id));
    }

    /**
     * Зафиксировать продажу товаров
     * @param type $pay_id
     * @return boolean
     */
    public function setSoldAdd($pay_id) {
        $select = "SELECT * FROM `zay_pay_products` WHERE pay_id='?'";
        $objs = $this->getSelectArray($select, array($pay_id));
        if (count($objs) > 0) {
            foreach ($objs as $value) {
                if ($value['product_id'] > 0) {
                    $querySelect = "select * from `zay_product` p where id='?'";
                    $obj = $this->getProductSelect($value['product_id']);
                    if ($obj['id'] > 0) {
                        $soldCount = $obj['sold'];
                        $soldCount++;
                        $query = "UPDATE `zay_product` SET `sold`='?' WHERE `id`='?'";
                        return $this->query($query, array($soldCount, $obj['id']));
                    }
                }
            }
        }
        return false;
    }

    /**
     * Проверка ссылки на изображение (не корректно работает)
     * @param type $url
     * @return type
     */
    public function checkImageFile($url) {
        $ret = "";
        if (strlen($url) > 0) {
            $http_pos = strpos($url, 'http');
            if ($http_pos === false) {
                if (filesize(DOCUMENT_ROOT . $url) > 0) {
                    $ret = DOCUMENT_ROOT . $url;
                }
            } else {
                $ret = $url;
            }
        }
        return $ret;
    }

    /**
     * Отообразить или скрыть блок
     * @param type $wares_id Идентификатор товара
     * @param type $block_type тип блока такой как в таблице колонка
     * @param type $show 1,0
     * @return type
     */
    public function blockShow($products_id, $block_type, $show = 0) {
        $query = "UPDATE `zay_product` SET `?`='?' WHERE `id`='?' ";
        return $this->query($query, array($block_type, $show, $products_id));
    }

    /**
     * Обновление данных по блоку
     * @param type $id
     * @param type $products_id
     * @param type $block_type
     * @param type $row
     * @param type $val
     * @return type
     */
    public function blockDataEdit($id, $products_id, $block_type, $row, $val) {
        if ($id > 0) {
            $query = "UPDATE `zay_product_block_data` "
                    . "SET `products_id`='?',`block_type`='?',`row`='?',`val`='?' "
                    . "WHERE `id`='?' ";
            return $this->query($query, array($products_id, $block_type, $row, $val, $id));
        } else {
            $query = "INSERT INTO `zay_product_block_data`(`products_id`, `block_type`, `row`, `val`) "
                    . "VALUES ('?','?','?','?')";
            return $this->query($query, array($products_id, $block_type, $row, $val));
        }
    }

    /**
     * Удалить данные по блоку
     * @param type $id
     * @param type $wares_id
     * @return type
     */
    public function blockDataDelete($id) {
        $query = "DELETE FROM `zay_product_block_data` WHERE `id`='?' ";
        return $this->query($query, array($id));
    }

    /**
     * Получить данные по блоку
     * @param type $wares_id
     * @param type $block_type
     * @param type $row
     * @return type
     */
    public function blockDataArray($products_id, $block_type, $row) {
        $querySelect = "SELECT * FROM `zay_product_block_data` "
                . "WHERE `products_id`='?' and `block_type`='?' and `row`='?' "
                . "order by `val` asc";
        return $this->getSelectArray($querySelect, array($products_id, $block_type, $row));
    }

}
