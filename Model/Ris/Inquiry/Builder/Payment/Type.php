<?php
/**
 * Copyright (c) 2025 KOUNT, INC.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Kount\Kount360\Model\Ris\Inquiry\Builder\Payment;

class Type
{
    /**
     * Maps fragments of payment codes to standardized codes.
     */
    private $paymentTypeMap = [
        'apple' => 'APAY',
        'credit' => 'CREDIT_CARD',
        'debit' => 'DEBIT_CARD',
        'paypal' => 'PYPL',
        'chek' => 'CHEK',
        'none' => 'NONE',
        'token' => 'TOKEN',
        'greendot' => 'GDMP',
        'google' => 'GOOG',
        'blml' => 'BLML',
        'gift' => 'GIFT',
        'bpay' => 'BPAY',
        'neteller' => 'NETELLER',
        'giropay' => 'GIROPAY',
        'elv' => 'ELV',
        'mercadopago' => 'MERCADE_PAGO',
        'sepa' => 'SEPA',
        'interac' => 'INTERAC',
        'cartebleue' => 'CARTE_BLEUE',
        'poli' => 'POLI',
        'skrill' => 'SKRILL',
        'sofort' => 'SOFORT',
        'amazon' => 'AMZN',
        'samsung' => 'SAMPAY',
        'alipay' => 'ALIPAY',
        'wechat' => 'WCPAY',
        'crypto' => 'CRYPTO',
        'klarna' => 'KLARNA',
        'afterpay' => 'AFTRPAY',
        'affirm' => 'AFFIRM',
        'splitit' => 'SPLIT',
        'facebook' => 'FBPAY',
        'sika_payment' => 'NONE',
        'companycredit' => 'CREDIT_CARD',
        'free' => 'NONE',
        'splitit_payment' => 'SPLIT',
        'authnetcim' => 'CREDIT_CARD',
        'amazon_payment_v2' => 'AMZN',
        'paytomorrow_gateway' => 'NONE',
        'payment_services_paypal_google_pay' => 'GOOG',
        'quotation_quote' => 'NONE',
        'payment_services_paypal_apple_pay' => 'APAY',
        'payment_services_paypal_smart_buttons' => 'PYPL',
        'affirm_gateway' => 'AFFIRM',
        'paypal_express' => 'PYPL',
        'net30' => 'NONE',
        'klarna_pay_over_time' => 'KLARNA',
        'stripe_payments_express' => 'CREDIT_CARD',
        'payflowpro' => 'PYPL',
        'payflow_express' => 'PYPL',
        'mayo_payment' => 'NONE',
        'fiserv' => 'CREDIT_CARD',
        'tpms_merchantaccount' => 'NONE',
        'rootways_authorizecim_option_applepay' => 'APAY',
        'checkmo' => 'CHEK',
        'braintree_cc_vault' => 'CREDIT_CARD',
        'braintree_paypal_vault' => 'PYPL',
        'braintree_paypal' => 'PYPL',
        'braintree' => 'CREDIT_CARD',
        'verifone_hosted' => 'CREDIT_CARD',
        'purchaseorder' => 'NONE',
        'rootways_chase_option' => 'CREDIT_CARD',
        'rootways_chase_option_cc_vault' => 'CREDIT_CARD'
    ];

    public function getPaymentType(string $paymentCode): string
    {
        if (empty($paymentCode)) {
            return 'NONE';
        }

        $paymentCodeLower = strtolower($paymentCode);

        foreach ($this->paymentTypeMap as $fragment => $type) {
            if (stripos($paymentCodeLower, $fragment) !== false) {
                return $type;
            }
        }

        return 'NONE';
    }
}
