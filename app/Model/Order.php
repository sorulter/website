<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';

    /**
     * Define order state
     * @var string
     */
    public $INIT = 'init';

    public $OBLIGATION = 'obligation';

    public $PROCESSING = 'processing';

    public $COMPLETE = 'complete';

    /**
     * Create new order
     * @param $price
     * @param $user_id
     * @return bool
     */
    public function order($amount, $user_id)
    {
        $this->user_id = $user_id;
        $this->order_id = ate("Ymd-His") . '-' . substr((string) microtime(), 2, 6);
        $this->state = $this->OBLIGATION;
        $this->amount = $amount;

        return $this->save();
    }

    /**
     * Get all list
     * @param $user_id
     * @return mixed
     */
    public function getUserOrders($user_id)
    {
        return Order::where('user_id', $user_id)->get();
    }

    /**
     * Change order state
     * @param $order_id
     * @param $status
     * @return bool
     */
    public function updateStatus($order_id, $status)
    {
        if (!($status == $this->INIT || $status == $this->COMPLETE
            || $status == $this->OBLIGATION || $status == $this->PROCESSING)) {
            return false;
        }

        $order = $this->getOrder($order_id);

        if (!$order) {
            return false;
        }

        $order->state = $status;
        $order->save();

        return true;
    }

    /**
     * Delete
     * @param $order_id
     * @return bool
     */
    public function deleteOrder($order_id)
    {
        $order = $this->getOrder($order_id);

        if (!$order) {
            return false;
        }

        OrderItem::where('order_id', $order->id)->delete();

        $order->delete();

        return true;
    }

}
