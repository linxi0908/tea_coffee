<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\OrderPaymentMethod;
use Illuminate\Console\Command;

class UpdateOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:update-status';
    /**
     * The console command description.
     *
     * @var string
     */

     protected $description = 'Update order status automatically';
    /**
     * Execute the console command.
     */



    public function handle()
    {
        $orders = Order::where('status', Order::STATUS_PENDING)
            ->where('created_at', '<=', now()->subHours(24))
            ->get();

        foreach ($orders as $order) {
            $order->status = Order::STATUS_SUCCESS;
            $order->save();

            $orderPaymentMethod = OrderPaymentMethod::findOrFail($order->id);
            $orderPaymentMethod->status = OrderPaymentMethod::STATUS_SUCCESS;
            $orderPaymentMethod->save();
        }

        $this->info('Order status updated for ' . count($orders) . ' orders.');
    }
}
