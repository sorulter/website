<?php namespace Omnipay\Alipay;

/**
 *
 */
class SendGoodsGateway extends BaseAbstractGateway
{
    protected $serviceName = 'send_goods_confirm_by_platform';
    public function __constract()
    {
        parent::__construct();
        $this->setParameter('service', '');
    }

    public function getName()
    {
        return 'Alipay Send Goods';
    }

    public function setService($value)
    {
        $this->setParameter('service', $value);
    }
    public function setLogisticsName($value)
    {
        $this->setParameter('logistics_name', $value);
    }

    public function purchase(array $parameters = array())
    {
        $this->setService($this->serviceName);

        return $this->createRequest('\Omnipay\Alipay\Message\SendGoodsPurchaseRequest', $parameters);
    }
}
