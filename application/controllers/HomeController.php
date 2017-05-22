<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class HomeController
 */

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;


class HomeController extends MY_Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->set_css(array(
            'style',
            'bootstrap',
            'bootstrap-theme',
            'modal',
            'admin',
  
        ));

        $this->set_js(array(
            'bootstrap',
            'sitejs',
            'siteAjax',
        ));
    }

    /**
     * method index
    **/
    public function index(){

        $this->data['page']="index";
        
        $this->getExpertList();
        

        $this->data['expert_categories'] = $this::model('ExpertCategories')->allWhere(['status'=>1]);

        $this->load->view('site/layouts/content',$this->data);
    }

    /**
     * 
     */
    public function paypal(){

        $price = $this->input->post('price');

        /**
         *
         */
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AclYILJ6EHjmh91Cdc2C3dWQEhD2uaptNOtVDlnINbKQ29o4ACNyc1P3lUxwYPKwIZNA3NPbN7cVZGho',
                'EHzBA9B364Qdz9w4F1hpw5_NSJxxMgOr00Cn4jqP60rModRDNzeY16KHJ_W7FCv4eUmBVnGTvCsluy-f'
            )
        );

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        // Set redirect urls
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl('http://localhost:800/psychics/confirm')
            ->setCancelUrl('http://localhost:800/cancel.php');
//        $redirectUrls->setReturnUrl('http://localhost:3000/process.php')
//            ->setCancelUrl('http://localhost:3000/cancel.php');

        // Set payment amount
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($price);

        // Set transaction object
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription("Payment description");

        // Create the full payment object
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($apiContext);

            // Get PayPal redirect URL and redirect user
            $approvalUrl = $payment->getApprovalLink();


            return redirect($approvalUrl);

            // REDIRECT USER TO $approvalUrl
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }


    }
    
    public function confirm(){

        /**
         *
         */
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AclYILJ6EHjmh91Cdc2C3dWQEhD2uaptNOtVDlnINbKQ29o4ACNyc1P3lUxwYPKwIZNA3NPbN7cVZGho',
                'EHzBA9B364Qdz9w4F1hpw5_NSJxxMgOr00Cn4jqP60rModRDNzeY16KHJ_W7FCv4eUmBVnGTvCsluy-f'
            )
        );

        // Get payment object by passing paymentId
        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);
        $payerId = $_GET['PayerID'];

        // Execute payment with payer id
        $execution = new \PayPal\Api\PaymentExecution();
        $execution->setPayerId($payerId);
        echo  '<pre>';

        
        try {
            // Execute payment
            
            $result = $payment->execute($execution, $apiContext);


            $this::model('UserBalances')->updateBalance($payment->transactions[0]->amount->total);

            return redirect('dashboard');

        } catch (PayPal\Exception\PayPalConnectionException $ex) {

            print_r($ex->getCode());
            echo '<hr />';
            echo $ex->getData();
            echo '<hr />';
            print_r($ex);

        } catch (Exception $ex) {
            print_r($ex);
        }


    }
}
