<?php
class ModelExtensionModuleEzEditProducts extends Model {
    public function setProductStatus($product_id, $status) {
        (int)$status = (int)$status ? '1' : '0';

        $this->db->query("UPDATE " . DB_PREFIX . "product SET status = '" . (int)$status . "' WHERE product_id = '" . (int)$product_id . "'");
    }

    public function setProductStatusAll($status) {
        (int)$status = (int)$status ? '1' : '0';

        $this->db->query("UPDATE " . DB_PREFIX . "product SET status = '" . (int)$status . "'");
    }

    public function removeCategoryFromProduct($category_id, $product_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$category_id . "'");
    }

    public function removeCategoryFromProductAll($category_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE category_id = '" . (int)$category_id . "'");
    }

    public function addCategory($category_id, $product_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$category_id . "'");

        $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
    }

    public function addCategoryAll($category_id) {
        $products = array();

        $products = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product")->rows;

        foreach ($products as $product) {
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product['product_id'] . "' AND category_id = '" . (int)$category_id . "'");

            $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product['product_id'] . "', category_id = '" . (int)$category_id . "'");
        }
    }

    public function addManufacturer($manufacturer_id, $product_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "product SET manufacturer_id = '" . (int)$manufacturer_id . "' WHERE product_id = '" . (int)$product_id . "'");
    }

    public function addManufacturerAll($manufacturer_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "product SET manufacturer_id = '" . (int)$manufacturer_id . "'");
    }

    public function removeManufacturer($manufacturer_id, $product_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "product SET manufacturer_id = '0' WHERE product_id = '" . (int)$product_id . "' AND manufacturer_id = '" . (int)$manufacturer_id . "'");
    }

    public function removeManufacturerAll($manufacturer_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "product SET manufacturer_id = '0' WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");
    }

    public function changePrice($product_id, $value, $type, $round, $special) {
        $price_row = $this->db->query("SELECT price FROM  " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");

        if ($price_row->row) {
            $price = $price_row->row['price'];
        } else {
            $price = false;
        }

        if ($special) {
            $special_row = $this->db->query("SELECT price FROM  " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");

            if ($special_row->row) {
                $special = (int)$special_row->row['price'];
            } else {
                $special = false;
            }
        } else {
            $special = false;
        }

        if ($type == 'add_percent') {
            if ($price) {
                $price += ($price/100)*(float)$value;
            }
            if ((int)$special) {
                (int)$special += ((int)$special/100)*(float)$value;
            }
        } else if ($type == 'deduct_percent') {
            if ($price) {
                $price -= ($price/100)*(float)$value;
            }
            if ((int)$special) {
                (int)$special -= ((int)$special/100)*(float)$value;
            }
        } else if ($type == 'add_value') {
            if ($price) {
                $price += (float)$value;
            }
            if ((int)$special) {
                (int)$special += (float)$value;
            }
        } else if ($type == 'deduct_value') {
            if ($price) {
                $price -= (float)$value;
            }
            if ((int)$special) {
                (int)$special -= (float)$value;
            }
        }

        if ($round == 'more') {
            if ($price) {
                $price = round($price, 0, PHP_ROUND_HALF_UP);
            }
            if ((int)$special) {
                (int)$special = round((int)$special, 0, PHP_ROUND_HALF_UP);
            }
        } else if ($round == 'less') {
            if ($price) {
                $price = round($price, 0, PHP_ROUND_HALF_DOWN);
            }
            if ((int)$special) {
                (int)$special = round((int)$special, 0, PHP_ROUND_HALF_DOWN);
            }
        } else if ($round == 'math') {
            if ($price) {
                $price = round($price, 0, PHP_ROUND_HALF_EVEN);
            }
            if ((int)$special) {
                (int)$special = round((int)$special, 0, PHP_ROUND_HALF_EVEN);
            }
        } else if ($round == 'math_ten') {
            if ($price) {
                $price = $price / 10;
                $price = round($price, 0, PHP_ROUND_HALF_EVEN);
                $price = $price * 10;
            }
            if ($special) {
                $special = $special / 10;
                $special = round((int)$special, 0, PHP_ROUND_HALF_EVEN);
                $special = $special * 10;
            }
        }

        if ($price) {
            $this->db->query("UPDATE " . DB_PREFIX . "product SET price = '" . $price . "' WHERE product_id = '" . (int)$product_id . "'");
        }

        if ($special) {
            $this->db->query("UPDATE " . DB_PREFIX . "product_special SET price = '" . (int)$special . "' WHERE product_id = '" . (int)$product_id . "'");
        }
    }

    public function changePriceAll($value, $type, $round, $special) {

        $products = array();

        $products = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product")->rows;

        foreach ($products as $product) {

            $price_row = $this->db->query("SELECT price FROM  " . DB_PREFIX . "product WHERE product_id = '" . (int)$product['product_id'] . "'");

            if ($price_row->row) {
                $price = $price_row->row['price'];
            } else {
                $price = false;
            }

            if ($special) {
                $special_row = $this->db->query("SELECT price FROM  " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product['product_id'] . "'");

                if ($special_row->row) {
                    $special = (int)$special_row->row['price'];
                } else {
                    $special = false;
                }
            } else {
                $special = false;
            }

            if ($type == 'add_percent') {
                if ($price) {
                    $price += ($price/100)*(float)$value;
                }
                if ((int)$special) {
                    (int)$special += ((int)$special/100)*(float)$value;
                }
            } else if ($type == 'deduct_percent') {
                if ($price) {
                    $price -= ($price/100)*(float)$value;
                }
                if ((int)$special) {
                    (int)$special -= ((int)$special/100)*(float)$value;
                }
            } else if ($type == 'add_value') {
                if ($price) {
                    $price += (float)$value;
                }
                if ((int)$special) {
                    (int)$special += (float)$value;
                }
            } else if ($type == 'deduct_value') {
                if ($price) {
                    $price -= (float)$value;
                }
                if ((int)$special) {
                    (int)$special -= (float)$value;
                }
            }

            if ($round == 'more') {
                if ($price) {
                    $price = round($price, 0, PHP_ROUND_HALF_UP);
                }
                if ((int)$special) {
                    (int)$special = round((int)$special, 0, PHP_ROUND_HALF_UP);
                }
            } else if ($round == 'less') {
                if ($price) {
                    $price = round($price, 0, PHP_ROUND_HALF_DOWN);
                }
                if ((int)$special) {
                    (int)$special = round((int)$special, 0, PHP_ROUND_HALF_DOWN);
                }
            } else if ($round == 'math') {
                if ($price) {
                    $price = round($price, 0, PHP_ROUND_HALF_EVEN);
                }
                if ((int)$special) {
                    (int)$special = round((int)$special, 0, PHP_ROUND_HALF_EVEN);
                }
            } else if ($round == 'math_ten') {
                if ($price) {
                    $price = $price / 10;
                    $price = round($price, 0, PHP_ROUND_HALF_EVEN);
                    $price = $price * 10;
                }
                if ($special) {
                    $special = $special / 10;
                    $special = round((int)$special, 0, PHP_ROUND_HALF_EVEN);
                    $special = $special * 10;
                }
            }

            if ($price) {
                $this->db->query("UPDATE " . DB_PREFIX . "product SET price = '" . $price . "' WHERE product_id = '" . (int)$product['product_id'] . "'");
            }

            if ($special) {
                $this->db->query("UPDATE " . DB_PREFIX . "product_special SET price = '" . (int)$special . "' WHERE product_id = '" . (int)$product['product_id'] . "'");
            }

        }
    }

    public function changeSpecial($product_id, $value, $type, $round, $special = true) {
        $price_row = $this->db->query("SELECT price FROM  " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "'");

        if ($price_row->row) {
            $price = $price_row->row['price'];
        } else {
            $price = false;
        }

        if ($special) {
            $special_row = $this->db->query("SELECT price FROM  " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");

            if ($special_row->row) {
                $special = (int)$special_row->row['price'];
            } else {
                $special = false;
            }
        } else {
            $special = false;
        }

        if ($type == 'add_percent') {
            if ($price) {
                $price += ($price/100)*(float)$value;
            }
            if ((int)$special) {
                (int)$special += ((int)$special/100)*(float)$value;
            }
        } else if ($type == 'deduct_percent') {
            if ($price) {
                $price -= ($price/100)*(float)$value;
            }
            if ((int)$special) {
                (int)$special -= ((int)$special/100)*(float)$value;
            }
        } else if ($type == 'add_value') {
            if ($price) {
                $price += (float)$value;
            }
            if ((int)$special) {
                (int)$special += (float)$value;
            }
        } else if ($type == 'deduct_value') {
            if ($price) {
                $price -= (float)$value;
            }
            if ((int)$special) {
                (int)$special -= (float)$value;
            }
        }

        if ($round == 'more') {
            if ($price) {
                $price = round($price, 0, PHP_ROUND_HALF_UP);
            }
            if ((int)$special) {
                (int)$special = round((int)$special, 0, PHP_ROUND_HALF_UP);
            }
        } else if ($round == 'less') {
            if ($price) {
                $price = round($price, 0, PHP_ROUND_HALF_DOWN);
            }
            if ((int)$special) {
                (int)$special = round((int)$special, 0, PHP_ROUND_HALF_DOWN);
            }
        } else if ($round == 'math') {
            if ($price) {
                $price = round($price, 0, PHP_ROUND_HALF_EVEN);
            }
            if ((int)$special) {
                (int)$special = round((int)$special, 0, PHP_ROUND_HALF_EVEN);
            }
        } else if ($round == 'math_ten') {
            if ($price) {
                $price = $price / 10;
                $price = round($price, 0, PHP_ROUND_HALF_EVEN);
                $price = $price * 10;
            }
            if ($special) {
                $special = $special / 10;
                $special = round((int)$special, 0, PHP_ROUND_HALF_EVEN);
                $special = $special * 10;
            }
        }

        if ($price) {
            //$this->db->query("UPDATE " . DB_PREFIX . "product SET price = '" . $price . "' WHERE product_id = '" . (int)$product_id . "'");
        }

        if ($special) {
            $this->db->query("UPDATE " . DB_PREFIX . "product_special SET price = '" . (int)$special . "' WHERE product_id = '" . (int)$product_id . "'");
        }
    }

    public function changeSpecialAll($value, $type, $round, $special = true) {


        $products = array();

        $products = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product")->rows;

        foreach ($products as $product) {

            $price_row = $this->db->query("SELECT price FROM  " . DB_PREFIX . "product WHERE product_id = '" . (int)$product['product_id'] . "'");

            if ($price_row->row) {
                $price = $price_row->row['price'];
            } else {
                $price = false;
            }

            if ($special) {
                $special_row = $this->db->query("SELECT price FROM  " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product['product_id'] . "'");

                if ($special_row->row) {
                    $special = (int)$special_row->row['price'];
                } else {
                    $special = false;
                }
            } else {
                $special = false;
            }

            if ($type == 'add_percent') {
                if ($price) {
                    $price += ($price/100)*(float)$value;
                }
                if ((int)$special) {
                    (int)$special += ((int)$special/100)*(float)$value;
                }
            } else if ($type == 'deduct_percent') {
                if ($price) {
                    $price -= ($price/100)*(float)$value;
                }
                if ((int)$special) {
                    (int)$special -= ((int)$special/100)*(float)$value;
                }
            } else if ($type == 'add_value') {
                if ($price) {
                    $price += (float)$value;
                }
                if ((int)$special) {
                    (int)$special += (float)$value;
                }
            } else if ($type == 'deduct_value') {
                if ($price) {
                    $price -= (float)$value;
                }
                if ((int)$special) {
                    (int)$special -= (float)$value;
                }
            }

            if ($round == 'more') {
                if ($price) {
                    $price = round($price, 0, PHP_ROUND_HALF_UP);
                }
                if ((int)$special) {
                    (int)$special = round((int)$special, 0, PHP_ROUND_HALF_UP);
                }
            } else if ($round == 'less') {
                if ($price) {
                    $price = round($price, 0, PHP_ROUND_HALF_DOWN);
                }
                if ((int)$special) {
                    (int)$special = round((int)$special, 0, PHP_ROUND_HALF_DOWN);
                }
            } else if ($round == 'math') {
                if ($price) {
                    $price = round($price, 0, PHP_ROUND_HALF_EVEN);
                }
                if ((int)$special) {
                    (int)$special = round((int)$special, 0, PHP_ROUND_HALF_EVEN);
                }
            } else if ($round == 'math_ten') {
                if ($price) {
                    $price = $price / 10;
                    $price = round($price, 0, PHP_ROUND_HALF_EVEN);
                    $price = $price * 10;
                }
                if ($special) {
                    $special = $special / 10;
                    $special = round((int)$special, 0, PHP_ROUND_HALF_EVEN);
                    $special = $special * 10;
                }
            }

            if ($price) {
                //$this->db->query("UPDATE " . DB_PREFIX . "product SET price = '" . $price . "' WHERE product_id = '" . (int)$product['product_id'] . "'");
            }

            if ($special) {
                $this->db->query("UPDATE " . DB_PREFIX . "product_special SET price = '" . (int)$special . "' WHERE product_id = '" . (int)$product['product_id'] . "'");
            }
        }
    }

}
