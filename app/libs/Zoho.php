<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 15/09/2017
 * Time: 9:59
 */

namespace App\libs;

use App\Models\Product;
use App\Models\User;
use GuzzleHttp\Client;

class Zoho
{
    const EMAIL_ID = 'randf77@gmail.com';
    const PASSWORD = 'Rebecca@2007';
    const BASE_URL = 'https://inventory.zoho.com/api/v1';
    const AUTH_BASE_URL = 'https://accounts.zoho.com/apiauthtoken/nb/create';
    public static $token = '';
    public static $organizationId = '';
    public static $currencyId = '';

    /**
     * Function to get Token from Zoho Inventory.
    */
    public static function getToken()
    {
        $client = new Client([
            'base_uri' => Zoho::AUTH_BASE_URL
        ]);

        $request = $client->request('POST', zoho::AUTH_BASE_URL, [
            'form_params' => [
                'SCOPE' => 'ZohoInventory/inventoryapi',
                'EMAIL_ID' => Zoho::EMAIL_ID,
                'PASSWORD' => Zoho::PASSWORD
            ]
        ]);

        if($request->getStatusCode() == 200){
            $collect = $request->getBody();
            //Should Split the Token
            $result = zoho::getBetween($collect, "AUTHTOKEN=", " RESULT=TRUE");
            Zoho::$token = $result;

            return $result . "<br/>" . $collect;
        }
        else{
            return "Login Error!";
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
            'base_uri' => Zoho::BASE_URL
        ]);

        $request = $client->request('POST', self::BASE_URL . 'contacts?authtoken=' . Zoho::$token . '&organization_id=' . Zoho::$organizationId, [
            'json' => [
                'contact_name'  => $user->first_name . ' ' . $user->last_name,
                'company_name'  => 'Nama-Official',
                'payment_terms' => 1,
                'currency_id'   => Zoho::$currencyId,
                'website'       => 'www.nama-official.com',
                'billing_address'   => [
                    'attention' => $user->first_name . ' ' . $user->last_name,
                    'address'   => $user->addresses[0]->description,
                    'street2'   => $user->addresses[0]->street,
                    'city'      => $user->addresses[0]->city->name,
                    'state'     => $user->addresses[0]->state,
                    'zip'       => $user->addresses[0]->postal_code,
                    'country'   => "ID"
                ],
                'shipping_address'  => [
                    'attention' => $user->first_name . ' ' . $user->last_name,
                    'address'   => $user->addresses[0]->description,
                    'street2'   => $user->addresses[0]->street,
                    'city'      => $user->addresses[0]->city->name,
                    'state'     => $user->addresses[0]->state,
                    'zip'       => $user->addresses[0]->postal_code,
                    'country'   => "ID"
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
            'base_uri' => Zoho::BASE_URL
        ]);

        $request = $client->request('POST', self::BASE_URL . 'contacts/' . $user->zoho_id . '?authtoken=' . Zoho::$token . '&organization_id=' . Zoho::$organizationId, [
            'json' => [
                'contact_name'  => $user->first_name . ' ' . $user->last_name,
                'company_name'  => 'Nama-Official',
                'payment_terms' => 1,
                'currency_id'   => Zoho::$currencyId,
                'website'       => 'www.nama-official.com',
                'billing_address'   => [
                    'attention' => $user->first_name . ' ' . $user->last_name,
                    'address'   => $user->addresses[0]->description,
                    'street2'   => $user->addresses[0]->street,
                    'city'      => $user->addresses[0]->city->name,
                    'state'     => $user->addresses[0]->state,
                    'zip'       => $user->addresses[0]->postal_code,
                    'country'   => "ID"
                ],
                'shipping_address'  => [
                    'attention' => $user->first_name . ' ' . $user->last_name,
                    'address'   => $user->addresses[0]->description,
                    'street2'   => $user->addresses[0]->street,
                    'city'      => $user->addresses[0]->city->name,
                    'state'     => $user->addresses[0]->state,
                    'zip'       => $user->addresses[0]->postal_code,
                    'country'   => "ID"
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

    //Product Stuff Start
    /**
     * Function to create product (item)
     *
     * @param Product $product
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function createProduct(Product $product)
    {
        $client = new Client([
            'base_uri' => Zoho::BASE_URL
        ]);

        $request = $client->request('POST', zoho::BASE_URL . 'items?authtoken=' . Zoho::$token . '&organization_id=' . Zoho::$organizationId, [
            'json' => [
                'group_id'              => 021,
                'group_name'            => 'asdf',
                'unit'                  => 'qty',
                'item_type'             => 'inventory',
                'product_type'          => 'goods',
                'is_taxable'            => true,
                'tax_id'                => 123,
                'description'           => $product->description,
                'purchase_account_id'   => 1234,
                'inventory_account_id'  => 123,
                'attribute_name1'       => $product->colour,
                'name'                  => $product->name,
                'rate'                  => 1,
                'purchase_rate'         => 1,
                'reorder_level'         => 5,
                'initial_stock'         => 0,
                'initial_stock_rate'    => 0,
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
     * @return mixed|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function updateProduct(Product $product)
    {
        $client = new Client([
            'base_uri' => Zoho::BASE_URL
        ]);

        $request = $client->request('POST', zoho::BASE_URL . 'items/'. $product->zoho_id .'?authtoken=' . Zoho::$token . '&organization_id=' . Zoho::$organizationId, [
            'json' => [
                'group_id'              => 021,
                'group_name'            => 'asdf',
                'unit'                  => 'qty',
                'item_type'             => 'inventory',
                'product_type'          => 'goods',
                'is_taxable'            => true,
                'tax_id'                => 123,
                'description'           => $product->description,
                'purchase_account_id'   => 1234,
                'inventory_account_id'  => 123,
                'attribute_name1'       => $product->colour,
                'name'                  => $product->name,
                'rate'                  => 1,
                'purchase_rate'         => 1,
                'reorder_level'         => 5,
                'initial_stock'         => 0,
                'initial_stock_rate'    => 0,
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

    public static function getBetween($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }
}