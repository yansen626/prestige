<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 15/09/2017
 * Time: 9:59
 */

namespace App\libs;

use App\Models\Category;
use App\Models\Configuration;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use GuzzleHttp\Client;

class Zoho
{
    /**
     * Function to get Token from Zoho Inventory.
     */
    public static function getToken()
    {
        $client = new Client([
            'base_uri' => env('ZOHO_AUTH_BASE_URL')
        ]);

        $request = $client->request('POST', env('ZOHO_AUTH_BASE_URL'), [
            'form_params' => [
                'SCOPE' => 'ZohoInventory/inventoryapi',
                'EMAIL_ID' => env('ZOHO_EMAIL'),
                'PASSWORD' => env('ZOHO_PASSWORD')
            ]
        ]);


        if($request->getStatusCode() == 200){
            $collect = $request->getBody();
            //Should Split the Token
            $temp = explode("=", $collect);
            $result = explode(" ", $temp[1]);
            $configuration = Configuration::where('configuration_key', 'zoho_token')->first();
            $configuration->zoho_token = $result[0];
            $configuration->save();

            return true;
        }
        else{
            return false;
        }
    }

    //User Stuff Start
    /**
     * Function to save Contact to Zoho Inventory. in Our case it is User.
     *
     * @param User $user
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function createUser(User $user)
    {
        $client = new Client([
            'base_uri' => env('ZOHO_BASE_URL')
        ]);

        $configuration = Configuration::where('configuration_key', 'zoho_token')->first();
        $request = $client->request('POST', env('ZOHO_BASE_URL') . 'contacts?authtoken=' . $configuration->configuration_value . '&organization_id=' . env('ZOHO_ORGANIZATION_ID'), [
            'json' => [
                'contact_name'  => $user->first_name . ' ' . $user->last_name,
                'company_name'  => 'Nama-Official',
                'payment_terms' => 1,
                'currency_id'   => env('ZOHO_CURRENCY_ID'),
                'website'       => 'www.nama-official.com',
                'billing_address'   => [
                    'attention' => $user->first_name . ' ' . $user->last_name,
                    'address'   => $user->addresses[0]->description,
                    'street2'   => $user->addresses[0]->street,
                    'city'      => $user->addresses[0]->city->name,
                    'state'     => $user->addresses[0]->state,
                    'zip'       => $user->addresses[0]->postal_code,
                    'country'   => "Indonesia"
                ],
                'shipping_address'  => [
                    'attention' => $user->first_name . ' ' . $user->last_name,
                    'address'   => $user->addresses[0]->description,
                    'street2'   => $user->addresses[0]->street,
                    'city'      => $user->addresses[0]->city->name,
                    'state'     => $user->addresses[0]->state,
                    'zip'       => $user->addresses[0]->postal_code,
                    'country'   => "Indonesia"
                ],
                'contact_persons'   => [
                    'salutation'    => 'Mr',
                    'first_name'    => $user->first_name,
                    'last_name'     => $user->last_name,
                    'email'         => $user->email,
                    'phone'         => $user->phone,
                    'mobile'        => $user->phone,
                    'is_primary_contact'    => true
                ]
            ]
        ]);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            //Save Contact Id
            $userData = User::find($user->id);
            $userData->zoho_id = $collect->contact->contact_id;
            $userData->zoho_primary_contact_id = $collect->contact->primary_contact_id;
            $userData->save();

            return $collect;
        }
        else{
            return "Error!";
        }
    }

    /**
     * Function to update user Data.
     *
     * @param User $user
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function updateUser(User $user)
    {
        $client = new Client([
            'base_uri' => env('ZOHO_BASE_URL')
        ]);

        $configuration = Configuration::where('configuration_key', 'zoho_token')->first();

        $request = $client->request('POST', env('ZOHO_BASE_URL') . 'contacts/' . $user->zoho_id . '?authtoken=' . $configuration->configuration_value . '&organization_id=' . env('ZOHO_ORGANIZATION_ID'), [
            'json' => [
                'contact_name'  => $user->first_name . ' ' . $user->last_name,
                'company_name'  => 'Nama-Official',
                'payment_terms' => 1,
                'currency_id'   => env('ZOHO_CURRENCY_ID'),
                'website'       => 'www.nama-official.com',
                'billing_address'   => [
                    'attention' => $user->first_name . ' ' . $user->last_name,
                    'address'   => $user->addresses[0]->description,
                    'street2'   => $user->addresses[0]->street,
                    'city'      => $user->addresses[0]->city->name,
                    'state'     => $user->addresses[0]->state,
                    'zip'       => $user->addresses[0]->postal_code,
                    'country'   => "Indonesia"
                ],
                'shipping_address'  => [
                    'attention' => $user->first_name . ' ' . $user->last_name,
                    'address'   => $user->addresses[0]->description,
                    'street2'   => $user->addresses[0]->street,
                    'city'      => $user->addresses[0]->city->name,
                    'state'     => $user->addresses[0]->state,
                    'zip'       => $user->addresses[0]->postal_code,
                    'country'   => "Indonesia"
                ],
                'contact_persons'   => [
                    'salutation'    => 'Mr',
                    'first_name'    => $user->first_name,
                    'last_name'     => $user->last_name,
                    'email'         => $user->email,
                    'phone'         => $user->phone,
                    'mobile'        => $user->phone,
                    'is_primary_contact'    => true
                ]
            ]
        ]);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            return $collect;
        }
        else{
            return "Error!";
        }
    }
    //User Stuff Finish

    //Category Stuff Start
    //Category = Item Group
    /**
     * Function to create new Category or Item Group in Zoho.
     *
     * @param Category $category
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function createCategory(Category $category)
    {
        $client = new Client([
            'base_uri' => env('ZOHO_BASE_URL')
        ]);

        $configuration = Configuration::where('configuration_key', 'zoho_token')->first();

        $request = $client->request('POST', env('ZOHO_BASE_URL') . 'itemgroups?authtoken=' . $configuration->configuration_value . '&organization_id=' . env('ZOHO_ORGANIZATION_ID'), [
            'json' => [
                'group_name'            => $category->name,
                'unit'                  => 'pcs',
                'description'           => $category->slug,
            ]
        ]);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            //Save Zoho Category Id
            $categoryData = Category::find($category->id);
            $categoryData->zoho_item_group_id = $collect->group_id;
            $categoryData->save();

            return $collect;
        }
        else{
            return "Error!";
        }
    }

    /**
     * Function to Update the Category Product Item Groups in Zoho.
     *
     * @param Category $category
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function updateCategory(Category $category)
    {
        $client = new Client([
            'base_uri' => env('ZOHO_BASE_URL')
        ]);

        $configuration = Configuration::where('configuration_key', 'zoho_token')->first();

        $request = $client->request('POST', env('ZOHO_BASE_URL') . 'itemgroups/' . $category->zoho_item_group_id . '?authtoken=' . $configuration->configuration_value . '&organization_id=' . env('ZOHO_ORGANIZATION_ID'), [
            'json' => [
                'group_name'            => $category->name,
                'description'           => $category->slug,
            ]
        ]);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            return $collect;
        }
        else{
            return "Error!";
        }
    }
    //Category Stuff Finish

    //Product Stuff Start
    /**
     * Function to create product (item)
     *
     * @param Product $product
     * @param $zohoGroupId
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function createProduct(Product $product, $zohoGroupId)
    {
        $client = new Client([
            'base_uri' => env('ZOHO_BASE_URL')
        ]);

        $configuration = Configuration::where('configuration_key', 'zoho_token')->first();

        $request = $client->request('POST', env('ZOHO_BASE_URL') . 'items?authtoken=' . $configuration->configuration_value . '&organization_id=' . env('ZOHO_ORGANIZATION_ID'), [
            'json' => [
                'group_id'              => $zohoGroupId,
                'unit'                  => 'pcs',
                'item_type'             => 'Inventory Items',
                'description'           => $product->description,
                'attribute_name1'       => $product->colour,
                'name'                  => $product->name . ' ' . $product->colour,
                'rate'                  => $product->price,
                'initial_stock'         => 0,
                'sku'                   => $product->sku
            ]
        ]);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            //Save Contact Id
            $productData = Product::find($product->id);
            $productData->zoho_id = $collect->item->item_id;
            $productData->save();

            return $collect;
        }
        else{
            return "Error!";
        }
    }

    /**
     * Function to Update item.
     *
     * @param Product $product
     * @param $zohoGroupId
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function updateProduct(Product $product, $zohoGroupId)
    {
        $client = new Client([
            'base_uri' => env('ZOHO_BASE_URL')
        ]);

        $configuration = Configuration::where('configuration_key', 'zoho_token')->first();

        $request = $client->request('POST', env('ZOHO_BASE_URL') . 'items/'. $product->zoho_id .'?authtoken=' . $configuration->configuration_value . '&organization_id=' . env('ZOHO_ORGANIZATION_ID'), [
            'json' => [
                'group_id'              => $zohoGroupId,
                'unit'                  => 'pcs',
                'item_type'             => 'Inventory Items',
                'description'           => $product->description,
                'attribute_name1'       => $product->colour,
                'name'                  => $product->name . ' ' . $product->colour,
                'rate'                  => $product->price,
                'initial_stock'         => 0,
                'sku'                   => $product->sku
            ]
        ]);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            return $collect;
        }
        else{
            return "Error!";
        }
    }
    //Product Stuff Finish

    //Transaction Stuff Start
    //Transaction equals to Sales Order
    /**
     * Function to create Sales Order.
     *
     * @param Order $order
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function createSalesOrder(Order $order)
    {
        $client = new Client([
            'base_uri' => env('ZOHO_BASE_URL')
        ]);

        $configuration = Configuration::where('configuration_key', 'zoho_token')->first();

        //Create array for line items
        $lineItems = [];
        foreach ($order->order_products as $detail){
            $item = [
                'item_id'   => $detail->product->zoho_id,
                'quantity'  => $detail->qty,
                'rate'      => $detail->price
            ];

            $lineItems[] = $item;
        }

        $request = $client->request('POST', env('ZOHO_BASE_URL') . 'salesorders?authtoken=' . $configuration->configuration_value . '&organization_id=' . env('ZOHO_ORGANIZATION_ID'), [
            'json' => [
                'customer_id'           => $order->user->zoho_id,
                'salesorder_number'     => $order->order_number,
                'date'                  => $order->created_at,
                'line_items'            => $lineItems,
                'discount'              => $order->voucher_amount,
                'shipping_charge'       => $order->shipping_charge,
                'delivery_method'       => $order->shipping_option,
            ]
        ]);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            //Save Contact Id
            $orderData = Order::find($order->id);
            $orderData->zoho_sales_order_id = $collect->sales_order->salesorder_id;
            $orderData->save();

            return $collect;
        }
        else{
            return "Error!";
        }
    }
    //Transaction Stuff Finish

    public static function getBetween($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }
}