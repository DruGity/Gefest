<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
include X_PATH.'/application/third_party/PHPExcel.php';

class Shop extends CI_Controller {
	public function __construct() {
		parent::__construct();
	    $this->load->helper(array('form', 'url'));
		$this->load->model('Model_products', 'products');
		$this->load->model('Model_users', 'users');
		$this->load->model('Model_shop', 'shop');
		$this->load->model('Model_categories','mcats');
		$langs = getOptionArray('languages');
		$current_lang = (userdata('language')) ? userdata('language') : trim($langs[0]);

		$old_url = (userdata('last_url')) ? userdata('last_url') : '';
		//var_dump($old_url);die();
		if (stripos($_SERVER['REQUEST_URI'], '/my_cart/') !== false) {
			set_userdata('last_url', userdata('last_url'));
		} else {
			set_userdata('last_url', $_SERVER['REQUEST_URI']);
		}
		isLogin();
	}

	public function payment(){


        $article = false;
        $order = false;
        $price = post('price');
        if(isset($_GET['product_id'])) $_POST['product_id'] = $_GET['product_id'];
        if(isset($_GET['order_id'])) $_POST['order_id'] = $_GET['order_id'];


        if(post('product_id') != false)
            $article = $this->products->getProductById(post('product_id'));
        else
            $article = modules_getLastProduct();

        $orderId = post('order_id');
        if(!$orderId) {
            $order = createOrder($article, $price);
            $orderId = $order['id'];
            set_userdata('order_id', $orderId);
        } else $order = getOrder($orderId);
        $title = getLine('Выбор способа оплаты');
        $template = 'users/payment.tpl.php';

        if(isset($order['price']))
            $price = $order['price'];

        //var_dump($order);
        $payment = post('payment');
        if(isset($_GET['action']) && $_GET['action'] == 'payed'){   // проверка платежа
	        if($_GET['type'] == 'interkassa' && isset($_POST['ik_pm_no'])){
                $order = $this->shop->getOrderById($_POST['ik_pm_no']);
                if($order){
                    $ik_inv_st = post('ik_inv_st');

                    updateItem($order['id'], 'orders', array('status' => $ik_inv_st));
                    $template = 'payments/status.php';
                    if($ik_inv_st == 'success'){        // Платёж успешно произведён
                        $product = $this->products->getProductById($order['product_id']);
                        if($product){
                            $money = $product['money'] + $order['price'];
                            updateItem($product['id'],'products',array('money' => $money));
                        }
                    }
                }
	        }

	    }
        else if($payment){
            editOrder($orderId,array('payment'=>$payment));

            if(!$order && userdata('order_id') !== false){
                $order = getOrder(userdata('order_id'));
            }

            $title = getLine("Оплатить");
            if($payment == 'liqpay'){
                include('application/libraries/LLiqpay.php');
                $public_key = getOption('liqpay_public_key');
                $private_key = getOption('liqpay_private_key');
      //          var_dump($public_key); var_dump($private_key);die();
                $liqpay = new LiqPay($public_key, $private_key);
//                $res = $liqpay->api("request", array(
//                    'action'         => 'pay',
//                    'version'        => '3',
//                    'phone'          => '380950000001',
//                    'amount'         => $order['price'],
//                    'currency'       => 'USD',
//                    'description'    => $order['description'],
//                    'order_id'       => $order['id'],
//                    'card'           => '4731195301524634',
//                    'card_exp_month' => '03',
//                    'card_exp_year'  => '22',
//                    'card_cvv'       => '111'
//                ));
                $html = $liqpay->cnb_form(array(
                    'version' => '3',
                    'amount' => $order['price'],
                    'currency' => 'USD',     //Можно менять  'EUR','UAH','USD','RUB','RUR'
                    'description' => $order['description'],  //Или изменить на $desc
                    'order_id' => $order['id']
                ));
                $data['liqpay'] = $html;
                $template = 'payments/Liqpay.php';
            } elseif ($payment == 'interkassa'){
                $template = 'payments/interkassa.php';
            }
        }
        $data['price'] = $price;
        $data['order_id'] = $orderId;
        $data['order'] = $order;
        $data['article'] = $article;
        $data['title'] = $title;
        $data['h1'] = $title;
        $data['keywords'] = "";
        $data['description'] = "";
        $data['robots'] = getLine('noindex, nofollow');
        $this->load->view($template, $data);
    }

	public function set_currency($currency) {
		set_userdata('currency', $currency);
		$back = '/';
		if (userdata('last_url') !== false)
			$back = userdata('last_url');
		redirect($back);
	}

	public function my_cart() {
		$my_cart = $this->getMyCart();
		$count = count($my_cart);

		if (isset($_POST['resumm'])) {
			for ($i = 0; $i < $count; $i++) {
				$mc = $my_cart[$i];
				$products = $this->products->getProductById($mc['product_id']);
				$razmer = unserialize($products['razmer']);
				$rcount = count($razmer);
				for ($i2 = 0; $i2 < $rcount; $i2++) {
					if (isset($_POST['kolvo_' . $razmer[$i2] . '_' . $mc['product_id']])) {
						$my_cart[$i]['kolvo_' . $razmer[$i2]] = $_POST['kolvo_' . $razmer[$i2] . '_' . $mc['product_id']];
					}
				}
			}
			$this->setMyCart($my_cart);
		}
		//var_dump($my_cart);
		if (userdata('login') !== false) {
			$user = $this->users->getUserByLogin(userdata('login'));
		}
		// ОФОРМЛЕНИЕ
		if (isset($_POST['action']) && $_POST['action'] == 'order') {
			if (getOption('registered_users_when_ordering')) {
				if (!$user) {
					$user = $this->users->getUserByEmail($_POST['email']);
					if ($user) {
						echo "Пользователь уже существует";
					} else {
						$dbins = array(
							'email' => $_POST['email'],
							'login' => $_POST['email'],
							'name' => $_POST['name'],
							'tel' => $_POST['tel'],
							'country' => $_POST['country'],
							'city' => $_POST['city'],
							'adress' => $_POST['adress'],
							'pass' => md5($_POST['pass']),
							'type' => 'client',
							'active' => 1,
							'reg_date' => date("Y-m-d"),
							'reg_ip' => $_SERVER['REMOTE_ADDR'],
							'activation' => 1,
							'mailer' => 1
						);
						$this->db->insert('users', $dbins);
					}
				} else {
					if ($user['email'] != $_POST['email'] || $user['name'] != $_POST['name'] || $user['tel'] != $_POST['tel'] || $user['adress'] != $_POST['adress']) {
						$dbins = array(
							'email' => $_POST['email'],
							'name' => $_POST['name'],
							'tel' => $_POST['tel'],
							'country' => $_POST['country'],
							'city' => $_POST['city'],
							'adress' => $_POST['adress']
						);
						$this->db->where('id', $user['id']);
						$this->db->limit(1);
						$this->db->update('users', $dbins);
					}
				}
				$user = $this->users->getUserByEmail($_POST['email']);
			} else {
				$user = array(
					'email' => $_POST['email'],
					'name' => $_POST['name'],
					'tel' => $_POST['tel'],
					/*'country' => $_POST['country'],
					'city' => $_POST['city'],*/
					'adress' => $_POST['adress']
				);
			}

			if ($user) {

				$summa = 0;

				for ($i = 0; $i < $count; $i++) {
					$products = $this->products->getProductById($my_cart[$i]['product_id']);
					if ($products) {
						$res = $products['price'] * $my_cart[$i]['kolvo'];
						$summa = $summa + $res;
					}
				}
				$unix = time();
				$adress = $user['city'].', '.$user['adress'] . '<br />Тел: ' . $user['tel'];
				$dbins = array(
					'date' => date("Y-m-d"),
					'time' => date("H:i"),
					'unix' => $unix,
					'products' => serialize($my_cart),
					'adress' => $adress,
					'payment' => ($_POST['payment']) ? $_POST['payment'] : 'NULL',
					'delivery' => ($_POST['delivery']) ? $_POST['delivery'] : 'NULL',
					'summa' => $summa,
					'comment' => ($_POST['comment']) ? $_POST['comment'] : 'NULL'
				);
				if (isset($user['id']))
					$dbins['user_id'] = $user['id'];

				$this->db->insert('orders', $dbins);

				$this->db->where('unix', $unix);
				if (isset($user['id']))
					$this->db->where('user_id', $user['id']);
				else {
					$this->db->where('adress', $adress);
				}
				$this->db->limit(1);
				$this->db->order_by('id', 'DESC');
				$order = $this->db->get('orders')->result_array();
				if ($order) {
					$order = $order[0];

					$message = 'ID: ' . $order['id'] . '<br />
					Дата: ' . $order['date'] . ' ' . $order['time'] . '<br />
					Товары: <br />';
					ob_start();
					?>
					<table class = "products" border = "1">
					<tr>
						<th>Товар</th>
						<th>Кол-во</th>
					</tr>
					<?php
					$my_cart = unserialize($order['products']);
					for ($j = 0; $j < count($my_cart); $j++) {
						$mc = $my_cart[$j];
						$product = $this->products->getProductById($mc['product_id']);
						$product['name'] = getLangText($product['name']);
						?>
						<tr>
							<td>
								<a href = "http://'<?= $_SERVER['SERVER_NAME'] . getFullUrl($product) ?>" target = "_blank"><?= $product['name'] ?></a><br/>
								<?= ($mc['filters']) ? filtersToString($mc['filters']) : '' ?>

							</td>
							<td align = "center"><p><?= $mc['kolvo'] ?></p></td>
						</tr>
					<?php
					}

					$message .= ob_get_clean() . '</table><br />'
						. 'Общая стоимость: ' . $order['summa'] . '<br />'
						. 'Адрес: ' . $order['adress'] . '<br />';
					if ($order['payment'] != 'NULL')
						$message .= 'Оплата: ' . $order['payment'] . '<br />';
					if ($order['delivery'] != 'NULL')
						$message .= 'Доставка: ' . $order['delivery'] . '<br />';
					if ($order['comment'] != 'NULL')
						$message .= 'Комментарий: ' . nl2br($order['comment']) . '<br />';
					$this->load->helper('mail_helper');
					$to = $this->model_options->getOption('admin_email');
					mail_send($to, "НОВЫЙ ЗАКАЗ: " . $order['id'], $message);

					if ($_POST['payment'])
						if ($_POST['payment'] == 'Приват24') {
							redirect('/payment/privat24/' . $order['id'] . '/');
						} elseif ($_POST['payment'] == 'Кредитная карта') {
							redirect('/payment/liqpay/' . $order['id'] . '/');
						}
					redirect('/my_cart/sended/');
					//$this->load->view('products/sended.tpl.php', $data);
				} else {
					$data['err'] = 'Ошибка оформления заказа! Попробуйте ещё раз.';
				}
			}
		}
		//

		$user = false;
		if (userdata('login') !== false) {
			$user = $this->users->getUserByLogin(userdata('login'));
		}

		$data['user'] = $user;
		$data['my_cart'] = $my_cart;
		$data['title'] = "Моя корзина" . getOption('global_title');
		$data['keywords'] = "";
		$data['description'] = "";
		$data['robots'] = 'noindex, nofollow';
		$data['bottom_banners'] = $this->model_banners->getByType('bottom', 1);
		$this->load->view('products/my_cart.tpl.php', $data);
	}

	public function del_products($hash) {
		if ($hash != -1) {
			$my_cart = $this->getMyCart();
			$count = count($my_cart);
			$newarr = array();
			$my_cart_count = 0;
			for ($i = 0; $i < $count; $i++) {
				if ($my_cart[$i]['hash'] != $hash) {
					array_push($newarr, $my_cart[$i]);
					$my_cart_count += $my_cart[$i]['kolvo'];
				}
			}
			$my_cart = $newarr;
			$this->setMyCart($my_cart);
			set_userdata('my_cart_count', $my_cart_count);
		}

		$user = false;
		if (userdata('login') !== false) {
			$user = $this->users->getUserByLogin(userdata('login'));
		}
		redirect('/my_cart/');
		/*
				$data['user'] = $user;
				$data['my_cart'] = $my_cart;
				$data['title'] = $this->lang->line('products_title_my_cart') . getOption('global_title');
				$data['keywords'] = "";
				$data['description'] = "";
				$data['robots'] = 'noindex, nofollow';
				$data['bottom_banners'] = $this->model_banners->getByType('bottom', 1);
				$this->load->view('products/my_cart.tpl.php', $data);
		  */
	}

	 public function index()
        {
                $this->load->view('upload_form', array('error' => ' ' ));
        }

	public function order() {
		$user = false;
		if (userdata('login') !== false) {
			$user = $this->users->getUserByLogin(userdata('login'));
		}

		var_dump($_POST);
		die();

		if (isset($_POST['name'])) {
			if ($user) {

			} else {

			}
		}

		$my_cart = $this->getMyCart();

		$data['my_cart'] = $my_cart;
		$data['title'] = $this->lang->line('products_title_ordering') . $this->model_options->getOption('global_title');
		$data['keywords'] = "";
		$data['description'] = "";
		$data['robots'] = 'noindex, nofollow';
		$this->load->view('products/order.tpl.php', $data);
	}

	function set_brand($id) {
		set_userdata('f_brand_id', $id);
		$back = userdata('last_url');
		redirect($back);
	}

	function unset_brand() {
		unset_userdata('f_brand_id');
		$back = userdata('last_url');
		redirect($back);
	}

	function set_filter() {
		if (isset($_POST['type'])) {
			if ($_POST['type'] == 'max_price') {
				$_POST['max_price'] = str_replace(' UAH', '', $_POST['max_price']);
				set_userdata('f_price_max', $_POST['max_price']);
				$back = userdata('last_url');
				redirect($back);
			}
		}
	}

	function add_to_cart($method = 'reload') {
		if (($_POST['product_id'] = validate($_POST['product_id'], 'number')) === false
			|| !$this->model_products->checkProductById($_POST['product_id'])
		) {
			$result['done'] = false;
			$result['msg'] = 'Товар не найден';
			echo json_encode($result);
			exit();
		}
		if (($_POST['kolvo'] = validate($_POST['kolvo'], 'number')) === false) {
			$result['done'] = false;
			$result['msg'] = 'Не правильно указано количество товара';
			echo json_encode($result);
			exit();
		}

		$my_cart_count = (userdata('my_cart_count')) ? userdata('my_cart_count') : 0;
		$my_cart = $this->getMyCart();

		$post_data = $_POST;
		$post_data = parseFilters($post_data, true, true, array('id'), array('id'));
		$is_new = true;
		//var_dump($post_data);
		//die();
		for ($i = 0; $i < count($my_cart); $i++) {
			if ($my_cart[$i]['product_id'] == $post_data['product_id']) {
				if (!(cmpFilterValues($my_cart[$i]['filters'], $post_data['filters'])))
					continue;
				$my_cart[$i]['kolvo'] += $post_data['kolvo'];
				$is_new = false;
				$my_cart_count += $post_data['kolvo'];
			}
		}
		if ($is_new) {
			array_push($my_cart, array(
					'product_id' => $post_data['product_id'],
					'kolvo' => $post_data['kolvo'],
					'filters' => $post_data['filters'])
			);
			$my_cart[count($my_cart) - 1]['hash'] = substr(md5(serialize($my_cart[count($my_cart) - 1])), 0, 10);
			$my_cart_count += $post_data['kolvo'];
		}

		set_userdata('my_cart_count', $my_cart_count);

		$this->setMyCart($my_cart);

		if ($method == 'no_reload') {
			$result['done'] = true;
			$result['msg'] = userdata('my_cart_count');
			echo json_encode($result);
			exit();
		} elseif (isset($_POST['back'])) {
			if (isset($result['done']) && !$result['done'])
				set_userdata('msg', $result['msg']);
			redirect($_POST['back']); //$this->load->view('new.tpl.php', $data);
		}
	}

	public function sended() {
		unset_userdata('my_cart');
		unset_userdata('my_cart_count');
		$data['title'] = 'Заказ успешно оформлен!' . $this->model_options->getOption('global_title');
		$data['keywords'] = "";
		$data['description'] = "";
		$data['robots'] = 'noindex, nofollow';
		$data['bottom_banners'] = $this->model_banners->getByType('bottom', 1);
		$this->load->view('products/sended.tpl.php', $data);
	}

	function privat_payed($order_id) {
		if (isset($_POST['payment']) && isset($_POST['signature'])) {
			$privat24_merchant_pass = $this->model_options->getOption('privat24_merchant_pass');

			$payment = $_POST['payment'];
			$signature = $_POST['signature'];

			$checkSignature = sha1(md5($payment . $privat24_merchant_pass));

			if ($signature == $checkSignature) {

				// Ответ от настоящего сервера
				// Далее парсим $payment
				parse_str($payment, $data);

				if ($data['state'] == 'ok' || $data['state'] == 'test') {
					$dbins = array(
						'status' => 'payed',
						'pay_answer' => serialize($data)
					);
					$this->db->where('id', $data['order']);
					$this->db->limit(1);
					$this->db->update('orders', $dbins);

					unset_userdata('my_cart');

					$data['order'] = $this->shop->getOrderById($order_id);
					$data['title'] = $this->lang->line('products_title_payment_success') . $this->model_options->getOption('global_title');
					$data['keywords'] = "";
					$data['description'] = "";
					$data['robots'] = 'noindex, nofollow';
					$this->load->view('products/payed.tpl.php', $data);
				} else {
					$data['order'] = $this->products->getOrderById($order_id);
					$data['title'] = $this->lang->line('products_title_payment_failed') . $this->model_options->getOption('global_title');
					$data['keywords'] = "";
					$data['description'] = "";
					$data['robots'] = 'noindex, nofollow';
					$this->load->view('products/not_payed.tpl.php', $data);
				}
			} else {
				// Фальшивый ответ
				echo "Уважаемые хакеры, идите лесом. С уважением, администрация.";
			}
		} else {
			$order = $this->shop->getOrderById($order_id);
			$data['order'] = $order;
			if ($order['status'] == 'payed') {
				$data['title'] = $this->lang->line('products_title_payment_success') . $this->model_options->getOption('global_title');
				$data['keywords'] = "";
				$data['description'] = "";
				$data['robots'] = 'noindex, nofollow';
				$this->load->view('products/payed.tpl.php', $data);
			} else {
				$data['title'] = $this->lang->line('products_title_payment_failed') . $this->model_options->getOption('global_title');
				$data['keywords'] = "";
				$data['description'] = "";
				$data['robots'] = 'noindex, nofollow';
				$this->load->view('products/not_payed.tpl.php', $data);
			}
		}
	}

	function privat($order_id) {
		unset_userdata('my_cart');
		unset_userdata('my_cart_count');
		$data['order'] = $this->shop->getOrderById($order_id);
		$data['title'] = $this->lang->line('products_title_payment_p24') . $this->model_options->getOption('global_title');
		$data['keywords'] = "";
		$data['description'] = "";
		$data['robots'] = 'noindex, nofollow';
		$this->load->view('products/privat.tpl.php', $data);
	}

	function liqpay_payed($order_id) {

		if (isset($_POST['operation_xml']) && isset($_POST['signature'])) {
			
			
			$liqpay_merchant_pass = $this->model_options->getOption('liqpay_merchant_pass');

			$payment = base64_decode($_POST['operation_xml']);
			$signature = $_POST['signature'];

			$checkSignature = base64_encode(sha1($liqpay_merchant_pass . $payment . $liqpay_merchant_pass, 1));
			
			

			if ($signature == $checkSignature) {
				
				$res = simplexml_load_string($payment);

				$dbins = array(
				'date'	=> date("Y-m-d"),
				'time'	=> date("H:i:s"),
				'text'	=> 'Оплата заказа: '.$order_id.'<br />'.$res->status
						   );
			$this->db->insert('logs', $dbins);
			
				$data = array(
					'amount' => (string)$res->amount,
					'currency' => (string)$res->currency,
					'description' => (string)$res->description,
					'goods_id' => (string)$res->goods_id,
					'merchant_id' => (string)$res->merchant_id,
					'order_id' => (string)$res->order_id,
					'pay_way' => (string)$res->pay_way,
					'pays_count' => (string)$res->pays_count,
					'sender_phone' => (string)$res->sender_phone,
					'status' => (string)$res->status,
					'transaction_id' => (string)$res->transaction_id,
					'version' => (string)$res->version
				);

				if ($data['status'] == 'success' || $data['status'] == 'wait_accept') {
					$dbins = array(
						'status' => $data['status'],
						'pay_answer' => serialize($data)
					);
					$this->db->where('id', $data['order_id']);
					$this->db->limit(1);
					$this->db->update('orders', $dbins);

					unset_userdata('my_cart');

					$data['order'] = $this->shop->getOrderById($order_id);
					$data['title'] = $this->lang->line('products_title_payment_success') . $this->model_options->getOption('global_title');
					$data['keywords'] = "";
					$data['description'] = "";
					$data['robots'] = 'noindex, nofollow';
					if ($data['status'] == 'success')
						$this->load->view('products/payed.tpl.php', $data);
					if ($data['status'] == 'wait_accept')
						$this->load->view('products/liqpay_wait_accept.tpl.php', $data);
				} else {
					$data['order'] = $this->shop->getOrderById($order_id);
					$data['title'] = $this->lang->line('products_title_payment_failed') . $this->model_options->getOption('global_title');
					$data['keywords'] = "";
					$data['description'] = "";
					$data['robots'] = 'noindex, nofollow';
					$this->load->view('products/not_payed.tpl.php', $data);
				}
			} else {

				// Фальшивый ответ
				echo "Уважаемые хакеры, идите лесом. С уважением, администрация.";
			}
		} else {
			$order = $this->shop->getOrderById($order_id);
			$data['order'] = $order;
			if ($order['status'] == 'payed') {
				$data['title'] = $this->lang->line('products_title_payment_success') . $this->model_options->getOption('global_title');
				$data['keywords'] = "";
				$data['description'] = "";
				$data['robots'] = 'noindex, nofollow';
				$this->load->view('products/payed.tpl.php', $data);
			}
			if ($order['status'] == 'wait_accept') {
				$data['title'] = $this->lang->line('products_title_payment_success') . $this->model_options->getOption('global_title');
				$data['keywords'] = "";
				$data['description'] = "";
				$data['robots'] = 'noindex, nofollow';
				$this->load->view('products/liqpay_wait_accept.tpl.php', $data);
			}
			else {
				$data['title'] = $this->lang->line('products_title_payment_failed') . $this->model_options->getOption('global_title');
				$data['keywords'] = "";
				$data['description'] = "";
				$data['robots'] = 'noindex, nofollow';
				$this->load->view('products/not_payed.tpl.php', $data);
			}
		}
	}

	function liqpay($order_id) {
		unset_userdata('my_cart');
		$data['order'] = $this->shop->getOrderById($order_id);
		$data['title'] = $this->lang->line('products_title_payment_credit_cart') . $this->model_options->getOption('global_title');
		$data['keywords'] = "";
		$data['description'] = "";
		$data['robots'] = 'noindex, nofollow';
		$this->load->view('products/liqpay.tpl.php', $data);
	}

	function getMyCart() {
		$my_cart = array();
		if (userdata('my_cart') !== false) {
			$my_cart = @unserialize(userdata('my_cart'));
			if ($my_cart === false)
				$my_cart = userdata('my_cart');
		}
		return $my_cart;
	}

	function setMyCart($myCart) {
		//if(getOption('serialize_my_cart'))
		$myCart = serialize($myCart);
		set_userdata('my_cart', $myCart);
	}

	function exportCat()
{

    $objPHPExcel = new PHPExcel();

    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Название');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Описание');
    $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Url');
    $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Позиция');
    $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Родитель');
    $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Шаблон');
    $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Фото раздела');
    $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Краткое описание');
    $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Title');
    $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Keywords');
    $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Description');
    $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Seo текст');
    $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Шаблон контента');
    $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Удаление');



    $categories = $this->mcats->getAllCategories();

    $count = count($categories);
    $counter = 1;

    for($i = 0; $i < $count; $i++)
    {
        $counter++;
        $p = $categories[$i];

        $objPHPExcel->getActiveSheet()->setCellValue('A'.$counter, $p['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('B'.$counter, $p['name']);
        $objPHPExcel->getActiveSheet()->setCellValue('C'.$counter, $p['subname']);
        $objPHPExcel->getActiveSheet()->setCellValue('D'.$counter, $p['url']);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.$counter, $p['num']);
        $objPHPExcel->getActiveSheet()->setCellValue('F'.$counter, $p['parent']);
        $objPHPExcel->getActiveSheet()->setCellValue('G'.$counter, $p['template']);
        $objPHPExcel->getActiveSheet()->setCellValue('H'.$counter, $p['image']);
        $objPHPExcel->getActiveSheet()->setCellValue('I'.$counter, $p['short_content']);
        $objPHPExcel->getActiveSheet()->setCellValue('J'.$counter, $p['title']);
        $objPHPExcel->getActiveSheet()->setCellValue('K'.$counter, $p['keywords']);
        $objPHPExcel->getActiveSheet()->setCellValue('L'.$counter, $p['description']);
        $objPHPExcel->getActiveSheet()->setCellValue('M'.$counter, $p['seo']);
        $objPHPExcel->getActiveSheet()->setCellValue('N'.$counter, $p['content_template']);
        $objPHPExcel->getActiveSheet()->setCellValue('O'.$counter, "");


    }
    //die();
    $objPHPExcel->getActiveSheet()->setTitle('Category_Export'.date("Y-m-d_H-i"));

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename=' . 'Export_Category_'.date("Y-m-d_H-i").'.csv');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');

}

public function do_upload()
{
    $config['upload_path']          = X_PATH.'/upload/csv';
    $config['allowed_types']        = 'csv|xlsx';

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('userfile'))
    {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
    }
    else
    {
            echo "Ваш файл успешно импортирован!";
    }
}

function importCat()
{

    //var_dump(X_PATH);die();
        if (isset($_FILES['userfile'])){

        if ($_FILES['userfile']['name'] != '') {
					   $imagearr = $this->do_upload();
					   $tmpfname = X_PATH.'/upload/csv/'.$_FILES['userfile']['name'];
        //var_dump($_FILES['userfile']['name']);
				    //var_dump($imagearr['file_name']);die();
        //$tmpfname = $file;
        //$tmpfname = X_PATH."/upload/csv/Export_Category_2017-10-06_13-18.csv";

		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		$excelObj = $excelReader->load($tmpfname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
		 }

		echo "<table>";
		$old = 0;
        $new = 0;
        $del = 0;
		for ($row = 2; $row <= $lastRow; $row++) {
			 //echo "<tr><td>";
			  $id = $worksheet->getCell('A'.$row)->getValue();
			 //echo "</td><td>";
			  $name = $worksheet->getCell('B'.$row)->getValue();
			 //echo "</td><td>";
			  $subname = $worksheet->getCell('C'.$row)->getValue();
			 //echo "</td><td>";
			  $url = $worksheet->getCell('D'.$row)->getValue();
			 //echo "</td><td>";
			  $num = $worksheet->getCell('E'.$row)->getValue();
			 //echo "</td><td>";
			  $parent = $worksheet->getCell('F'.$row)->getValue();
			 //echo "</td><td>";
			  $template = $worksheet->getCell('G'.$row)->getValue();
			 //echo "</td><td>";
			  $image = $worksheet->getCell('H'.$row)->getValue();
			 //echo "</td><td>";
			  $short_content = $worksheet->getCell('I'.$row)->getValue();
			 //echo "</td><td>";
			  $title = $worksheet->getCell('J'.$row)->getValue();
			 //echo "</td><td>";
			  $keywords = $worksheet->getCell('K'.$row)->getValue();
			 //echo "</td><td>";
			  $description = $worksheet->getCell('L'.$row)->getValue();
			 //echo "</td><td>";
			  $seo = $worksheet->getCell('M'.$row)->getValue();
			 //echo "</td><td>";
			  $content_template = $worksheet->getCell('N'.$row)->getValue();
			 //echo "</td><tr>";
			 $delete = $worksheet->getCell('O'.$row)->getValue();
                 //echo "</td><tr>";

                $this->load->helper('translit_helper');

			 $data = array(
			      'id' => $id,
			      'name' => $name,
                   'subname' => $subname,
                   'url' => $url,
                   'num' => $num,
                   'parent' => $parent,
                   'template' => $template,
                   'image' => $image,
                   'short_content' => $short_content,
                   'title' => $title,
                   'keywords' => $keywords,
                   'description' => $description,
                   'seo' => $seo,
                   'content_template' => $content_template,
			 );
                    if($data['url'] == '')
                      {
                          $data['url']	= translitRuToEn($name);
                      }

              if($name != '' && $id != '')
                {
                     $is_new = true;
                     if($id != '')
                     {
                          $category = $this->mcats->getCategoryById($id);
                          if($category) $is_new = false;
                     }

                     if(!$is_new)
                     {
                          $this->db->where('id', $id);
                          $this->db->limit(1);
                          $this->db->update('categories', $data);
                          $old++;

                     }
                     else
                     {
                          $data['num'] = $this->mcats->getNewNum();
                          $this->db->insert('categories', $data);
                          $new++;
                     }
                }

                if ($delete == "да" || $delete == "Да" )
                 {
                     $this->db->limit(1);
                     $this->db->delete('categories', array('id' => $id));
                     $del++;
                 }

		}

		echo "</table>";

		 echo '<p class="msg">Импорт успешно завершён!<br />Изменено позиций: '.$old.'<br />Добавлено позиций: '.$new.'<br />Удалено позиций: '.$del.'</p>';
}
		 $data['title']  = "Импорт CSV";
		  $this->load->view('/testImport.tpl.php',$data);

}

function importCat1()
{

		  $data['msg'] = '';

			   //var_dump(unserialize('a:4:{i:0;s:9:"2013-12/1";i:1;s:9:"2014-01/1";i:2;s:9:"2014-01/2";i:3;s:9:"2014-02/2";} '));

			   if (isset($_FILES['userfile'])) {					// проверка, выбран ли файл
				    if ($_FILES['userfile']['name'] != '') {
					   $imagearr = $this->upload_csv();
					   $file = '/upload/csv/'.$imagearr['file_name'];
				    }
				    if(file_exists($_SERVER['DOCUMENT_ROOT'].$file))
				    {

						      if(($handle = fopen($_SERVER['DOCUMENT_ROOT'].$file, "r")) !== FALSE) {
							       $headers = fgetcsv($handle, 0, ';', '"');

							       $old = 0;
							       $new = 0;
							       //var_dump($headers);die();
							       $k = 0;
							       while(($data = fgetcsv($handle, 0, ';', '"')) !== FALSE) {

								       $num = count($data);
								       $id = trim($data[0]);

									$parr = array();
									$id = iconv('CP1251','UTF-8',$data[0]);
									$name = iconv('CP1251','UTF-8',$data[1]);
									$subname = iconv('CP1251','UTF-8',$data[2]);
									$url = iconv('CP1251','UTF-8',$data[3]);
									$num = iconv('CP1251','UTF-8',$data[4]);
									$parent = iconv('CP1251','UTF-8',$data[5]);
									$active = iconv('CP1251','UTF-8',$data[6]);
									$title = iconv('CP1251','UTF-8',$data[7]);
									$keywords = iconv('CP1251','UTF-8',$data[8]);
									$description = iconv('CP1251','UTF-8',$data[9]);
									$robots = iconv('CP1251','UTF-8',$data[10]);
									$image = iconv('CP1251','UTF-8',$data[16]);

									//$youtube = str_replace('http://youtu.be/','',$youtube);
									//$images = iconv('CP1251','UTF-8',$data[14]);

									if(strpos($image,'http://') !== false)
									{
										 $string = file_get_contents($image);
										 if($string)
										 {
											 $ipos = strrpos($image,'/');
											 $iname = substr($image,$ipos+1);
											 if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/upload/shop/'.date("Y-m-d").'/'))
											 {
											  mkdir($_SERVER['DOCUMENT_ROOT'].'/upload/shop/'.date("Y-m-d").'/');
											 }
											 file_put_contents($_SERVER['DOCUMENT_ROOT'].'/upload/shop/'.date("Y-m-d").'/'.$iname, $string);
											 $image = '/upload/shop/'.date("Y-m-d").'/'.$iname;

										 }
									}


									/*$rarr = explode('|', $razmer);

									if(is_array($rarr)) $razmer = serialize($rarr);*/

									/*$brand_id = 0;
									if($brand_name != '')
									{
										 $brand = $this->brands->getBrand($brand_name);
										 if($brand) $brand_id = $brand['id'];
										 else
										 {
											  $this->load->helper('translit_helper');
											  $dbins = array(
												   'name'	=> $brand_name,
												   'title'	=> $brand_name,
												   'keywords'	=> $brand_name,
												   'description'	=> $brand_name,
												   'url'		=> translitRuToEn($brand_name),
												   'num'		=> $this->brands->getNewNum()
											  );
											  $this->db->insert('brands', $dbins);

											  $brand = $this->brands->getBrand($brand_name);
											  if($brand) $brand_id = $brand['id'];
										 }
									}*/

								       // echo $bron.'<HR>';

								       $name = trim($name);

									$keywords = $name.', купить '.$name;
								       $description = 'У Нас Вы можете купить '.$name;

									$dbins = array(
										 'id'		=> $id,
										 'name'		=> $name,
										 'subname'	=> $subname,
										 'url'	=> $url,
										 'image'		=> $image,
										 'num'	=> $num,
										 'parent'	=> $parent,
										 'active'	=> $active,
										 'robots'		=> $robots,
										 'title'		=> $name,
										 'keywords'	=> $keywords,
										 'description'	=> $description

									);

									if($name != '' && $id != '')
									{
										 $is_new = true;
										 if($id != '')
										 {
											  $shop = $this->mshop->getProductById($id);
											  if($shop) $is_new = false;
										 }

										 if(!$is_new)
										 {
											  $this->db->where('id', $id);
											  $this->db->limit(1);
											  $this->db->update('shop', $dbins);
											  $old++;
										 }
										 else
										 {
											  $dbins['num'] = $this->mshop->getNewNum();
											  $this->load->helper('translit_helper');
											  $dbins['url']	= translitRuToEn($name);

											  $this->db->insert('shop', $dbins);
											  //var_dump("add");die();
											  $new++;
										 }
									}
							       }
							       fclose($handle);
							       $data['msg'] = '<p class="msg">Импорт успешно завершён!<br />Изменено позиций: '.$old.'<br />Добавлено позиций: '.$new.'</p>';
						       }
						       else
						       {
							       die("Ошибка чтения подгруженного файла!");
						       }
					 //////////////////////////////
					 /*
						      $f = fopen($_SERVER['DOCUMENT_ROOT'].$file, "rt") or die("Ошибка чтения подгруженного файла!");
						      $namearr = array();
						      for ($i=0; $data=fgetcsv($f,1000,";"); $i++) {
							       $num = count($data);
							       if($i == 0)
							       {
									for ($c=0; $c<$num; $c++)
									{
										 array_push($namearr, iconv('CP1251','UTF-8',$data[$c]));
									}
							       }
							       else
							       {
									$id = trim($data[0]);
									$parr = array();

									$category_id = iconv('CP1251','UTF-8',$data[1]);
									$brand = iconv('CP1251','UTF-8',$data[2]);
									$name = iconv('CP1251','UTF-8',$data[3]);
									$articul = iconv('CP1251','UTF-8',$data[4]);
									$price = iconv('CP1251','UTF-8',$data[5]);
									$image = iconv('CP1251','UTF-8',$data[6]);
									$youtube = iconv('CP1251','UTF-8',$data[7]);
									$short_content = iconv('CP1251','UTF-8',$data[8]);
									$content = iconv('CP1251','UTF-8',$data[9]);
									$tab2 = iconv('CP1251','UTF-8',$data[10]);
									$tab3 = iconv('CP1251','UTF-8',$data[11]);
									$tab4 = iconv('CP1251','UTF-8',$data[12]);


									$brand_id = 0;
									if($brand != '')
									{
										 $brand = $this->brands->getBrand($brand);
										 if($brand) $brand_id = $brand['id'];
									}

								       // echo $bron.'<HR>';

									$dbins = array(
										 'category_id'		=> $category_id,
										 'brand_id'		=> $brand_id,
										 'name'		=> $name,
										 'articul'	=> $articul,
										 'image'		=> $image,
										 'content'	=> $content,
										 'tab2'		=> $tab2,
										 'tab3'		=> $tab3,
										 'tab4'		=> $tab4,
										 'price'		=> $price
									);

									if($id != '')
									{
										 $this->db->where('id', $id);
										 $this->db->limit(1);
										 $this->db->update('shop', $dbins);
									}
									else
									{
										 $this->db->insert('shop', $dbins);
										 var_dump("add");die();
									}

									//var_dump($data);
									//echo '<hr>';
							       }
						      }
						      */

				    }
			   }



		  $data['title']  = "Импорт CSV";
		  $this->load->view('/testImport.tpl.php',$data);

	 }

	 function upload_csv($file = 'userfile')
     {
		  // Проверка наличия папки текущей даты. Если нет, то создать
		  if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/upload/csv/'))
		  {
		      mkdir($_SERVER['DOCUMENT_ROOT'].'/upload/csv/', 0777);
		  }

		  //////
		  // Функция загрузки
		  $config['upload_path'] 	= 'upload/csv/';
		  $config['overwrite']  	= true;
		  $config['allowed_types']  	= 'xlsx|csv';

		  $this->load->library('upload', $config);

		  if ( ! $this->upload->do_upload($file))
		  {
			  echo $this->upload->display_errors();
			  die();
		  }
		  else
		  {
			   $ret = $this->upload->data();
			   return $ret;
		  }
	 }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */