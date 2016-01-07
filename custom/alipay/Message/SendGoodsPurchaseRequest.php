<?php

namespace Omnipay\Alipay\Message;

class SendGoodsPurchaseRequest extends BasePurchaseRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validateData();

        $data = array(
            "service" => $this->getService(),
            "partner" => $this->getPartner(),
            "trade_no" => $this->getTradeNo(),
            "out_trade_no" => $this->getOutTradeNo(),
            "logistics_name" => $this->getLogisticsName(),
            "_input_charset" => $this->getInputCharset(),
            "create_transport_type" => $this->getCreateTransportType(),
        );

        $data = array_filter($data);
        $data['sign'] = $this->getParamsSignature($data);
        $data['sign_type'] = $this->getSignType();

        return $data;
    }

    protected function validateData()
    {
        $this->validate(
            'service',
            'partner',
            'key',
            'trade_no',
            'input_charset',
            'logistics_name'
        );
    }

    public function getLogisticsName()
    {
        return $this->getParameter('logistics_name');
    }

    public function setLogisticsName($value)
    {
        $this->setParameter('logistics_name', $value);
    }

    public function getTradeNo()
    {
        return $this->getParameter('trade_no');
    }

    public function setTradeNo($value)
    {
        $this->setParameter('trade_no', $value);
    }

    public function getCreateTransportType()
    {
        return $this->getParameter('create_transport_type');
    }

    public function setCreateTransportType($value)
    {
        $this->setParameter('create_transport_type', $value);
    }

}
