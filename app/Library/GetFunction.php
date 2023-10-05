<?php
namespace App\Library;
use App\Mail\DefaultMail;
use App\Models\Address;
use App\Models\AttributeMap;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductReturnStatus;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\SubadminVendor;
use App\Models\Warehouse;
use App\User;
use Auth;
use DB;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class GetFunction{

    public function getPaypalConfig(){
        $option = new \App\Models\Option;
        $payment = $option->getPaymentMethodDetails('paypal');
        $mode = 'sandbox';
        if($payment && $payment['paypal']['paypal_sandbox_status'] == config('constant.status.in_active')){
            $mode = 'live';
        }
        return array('paypal_client_id' => $payment['paypal']['paypal_client_id'], 'paypal_secret_id' => $payment['paypal']['paypal_secret_id'], 'settings' => array('mode' => $mode, 'http.ConnectionTimeOut' => 30, 'log.LogEnabled' => true, 'log.FileName' => storage_path() . '/logs/paypal.log', 'log.LogLevel' => 'FINE'));
    }

	public static function getRoleLayout(){
		if(Auth::user()->hasRole('ADMIN')){
            $data['layouts']    = 'layouts.admin.app';
            $data['guard']      = 'admin';
        }
        elseif(Auth::user()->hasRole('VENDOR')){
            $data['layouts']    = 'layouts.vendor.app';
            $data['guard']      = 'vendor';
        }elseif(Auth::user()->hasRole('SUB_ADMIN')){
            $data['layouts']    = 'layouts.admin.app';
            $data['guard']      = 'admin';
        }
        else{
            abort(401);
        }
        return $data;
	}

    public static function getAttributeValuesById($id){
        $attributes = AttributeMap::where('attribute_id',$id)->select(['id','attribute_id','attribute_name','attribute_slug'])->get();
        return $attributes;
    }

    public static function getVariationPriceRange($id){

        $query = ProductVariant::where('product_id',$id);

        if($query->count()>1){
            $data = $query->select(DB::raw('max(price) as max_price, min(price) as min_price'))->groupBy('product_id')->first();
            if($data->min_price==$data->max_price){
                return config('constant.defaultCurrency').number_format($data->min_price,2);
            }
            return config('constant.defaultCurrency').number_format($data->min_price,2).' - '.number_format($data->max_price,2);

        }
        $data = $query->first();

        if($data && isset($data->price) && !empty($data->price)){
            return config('constant.defaultCurrency').number_format($data->price,2);
        }
        
        return config('constant.defaultCurrency').'00.00';
    }

    public static function getVariationQuantity($id){

        $record = ProductVariant::where('product_id',$id)->get();

        $str = '';
        if($record->count()){
            foreach($record as $row){
                $quantity = (!empty($row->stock_quantity))?$row->stock_quantity:"0";
                $str.= '<span class="badge badge-warning">'.$quantity.'</span><br>';
            }
        }
        if(empty($str)){
            return '<span class="badge badge-warning">0</span>';
        }
        
        return $str;
    }

    public static function getVariationAvailability($id){

        $record = ProductVariant::where('product_id',$id)->get();
        $str = '';
        if($record->count()){
            foreach($record as $row){
                if($row->stock_availability==config('constant.stockAvailability.in_stock')){
                    $str.='<span class="badge badge-info">'.ucwords(str_replace("_", " ", $row->stock_availability)).'</span><br>';
                }
                else{
                    $str.='<span class="badge badge-danger">'.ucwords(str_replace("_", " ", $row->stock_availability)).'</span><br>';
                }
                
            }
        }
        if(empty($str)){
            return '<span class="badge badge-danger">Out of Stock</span>';
        }
        return $str;
    }

    public static function uploadImage($request,$file_name,$path,$edit_file_name=''){
        if(config('constant.appEnv')=='dev'){
            if(!File::exists(public_path($path))) File::makeDirectory(public_path($path), 0777,true);

            $file = $request->file($file_name);
            $ext = '.'.$file->getClientOriginalExtension();
            if(empty($edit_file_name)){
                $edit_file_name = str_replace($ext, time() . $ext, $file->getClientOriginalName());
            }
            if($file->move(public_path($path),$edit_file_name)){
                return $path.'/'.$edit_file_name;
            }
        }else{
            //$url = $request->file($file_name)->store($path,'s3');    
            $url = Storage::putFile($path, $request->file($file_name), 'public');
            return $url;
        }
        return NULL;
    }
    
    public static function createOrder($order_items,$user_id,$payment_method,$sold_by){
        DB::beginTransaction();
        $_this  =  new self;
        try {
            
            $addresses['shipping_address'] = optional(Address::where(['user_id'=>$user_id,'id'=>$order_items->information['customer']['id']])->with(['countryName:id,name,iso2','stateName:id,name,iso2','cityName:id,name'])->first())->toArray();
            $addresses['billing_address']  = optional(Address::where(['user_id'=>$user_id,'address_type'=>'billing'])->with(['countryName:id,name','stateName:id,name','cityName:id,name'])->first())->toArray();
            $order = new Order;
            $order_number = generateOrderNumber($order,'order_number','OD');
            $order->user_id = $user_id;
            $order->order_number = $order_number;
            $order->order_date   = date("Y-m-d");
            $order->order_note   = $order_items->notes;
            $order->order_total  = $order_items->totalPrice;
            $order->shipping_method  = $order_items->shippingTitle??'Shipping';
            $order->shipping_method_id  = $order_items->shippingId ?? '';
            $order->shipping_price  = $order_items->shippingPrice;
            $order->coupon_code  = $order_items->appliedCouponCode;
            $order->order_discount  = $order_items->appliedCouponPrice;
            $order->payment_method  = $payment_method;
            $order->payment_status  = "Pending";
            $order->address  = serialize($addresses);
            $order->country = $addresses['shipping_address']['country']??NULL;
            $order->city = $addresses['shipping_address']['city']??NULL;
            $order->save();
            $result = $_this->createOrderItem($order_items,$order->id,$user_id,$sold_by);
            if($result['status']==false){
                throw new \Exception($result['msg']);
            }
            DB::commit();
            return array_merge($result,['order_number'=>$order_number]);
        } catch (\Exception $e) {
            DB::rollback();
            return ['status'=>false,'msg'=>$e->getMessage()];
        }
    }

    public function createOrderItem($order_items,$order_id,$user_id,$sold_by){
        try {
            if($order_items->items){
                $order_status = \App\Models\OrderStatus::where('slug',config('constant.orderStatus.processing'))->first();
                foreach($order_items->items as $item){
                    $product = \App\Models\Product::where('id',$item['product_id'])->first();
                    $best_seller_product = \App\Models\BestSellerProduct::where('product_id',$item['product_id'])->first();
                    if(!$best_seller_product){
                        $best_seller_product = new \App\Models\BestSellerProduct;
                        $best_seller_product->total = 1;
                        $best_seller_product->product_id = $item['product_id'];
                    }else{
                        $best_seller_product->total = $best_seller_product->total+1;
                    }

                    
                    $best_seller_product->save();

                    // if($product){
                    //     $product_qty = ($product->stock_quantity-1);
                    //     if($product_qty<=0){
                    //         $product->stock_availability = config('constant.stockAvailability.out_of_stock');
                    //         $product_qty = 0;
                    //     }
                    //     $product->stock_quantity = $product_qty;
                    //     $product->save();
                    // }
                    $order_item = new OrderProduct;
                    $fedex_reference_id = generateOrderNumber($order_item,'fedex_reference_id','REF');
                    $order_item->fedex_reference_id = $fedex_reference_id;
                    $order_item->order_id = $order_id;
                    $order_item->user_id = $user_id;
                    $order_item->sold_by = $sold_by; 
                    $order_item->product_id = $item['product_id'];
                    $order_item->vendor_id = $product->vendor_id;
                    $order_item->product_variant_id = (!empty($item['product_variant_id']))?$item['product_variant_id']:NULL;
                    $order_item->regular_price = $item['regular_price'];
                    $order_item->price = $item['price'];
                    $order_item->quantity = $item['qty'];
                    $order_item->shipping_price = $item['shippingPrice'];
                    $order_item->shipping_json = $item['shippingJson'];
                    $order_item->json = serialize(['name'=>$item['name'],'image'=>$item['image']]);
                    if(isset($item['couponId']))
                    {
                      $order_item->coupon_id =  $item['couponId']; 
                      $order_item->discount_price =  $item['appliedCouponPrice']; 
                    }

                    $order_item->order_status_id = $order_status->id??2;
                    $order_item->save();
                }
                return ['status'=>true];
            }else{
                throw new \Exception('Order Item not found!');
            }
        } catch (\Exception $e) {
            return ['status'=>false,'msg'=>$e->getMessage()];
        }
    }

    public static function parentCategory(){
        $cat_IDS = Product::where(['status'=>config('constant.status.active')])->distinct('category_id')->pluck('category_id');
        $categories = \App\Models\Category::where('status',config('constant.status.active'))->whereIn('id',$cat_IDS)->orderBy('name','asc')->get();
        return $categories;
    }

    public static function deleteImage($image_path){
        if(config('constant.appEnv')=='dev'){
            if (!empty($image_path) && File::exists(public_path($image_path))) {
                @unlink(public_path($image_path));
            }
        }else{
            if(!empty($image_path)){
                Storage::disk('s3')->delete($image_path);
            }
        }
        return NULL;

        //dd(Storage::disk('s3')->delete('uploads/GsFStcKiimOuh6zuW3PTnWI5GcernpeaL0ViYxQR.jpg'));
        // $res = $request->file('image')->store('uploads','s3');
        // dd($res);        
    }

    public static function isAdmin($user){
        $isAdmin = false;
        if($user->hasRole(config('constant.userRole.admin'))){
            $isAdmin = true;
        }
        return $isAdmin;
    }

    public static function isSubAdmin($user){
        $isSubAdmin = false;
        if($user->hasRole(config('constant.userRole.sub_admin'))){
            $isSubAdmin = true;
        }
        return $isSubAdmin;
    }


    public static function assignedSubAdmins($user_id){
        
        $subadmin_IDs =  SubadminVendor::where('subadmin_id',$user_id)->pluck('vendor_id')->toArray();
          
        $vendor_query =  User::where('sales_rep',$user_id)->pluck('id')->toArray();
        
        $final_IDS = array_unique(array_merge($subadmin_IDs,$vendor_query));

        return $final_IDS;
    }

    public static function isAdminOrSubAdmin($user){
        $isAdminOrSubAdmin = false;
        if($user->hasAnyRole([config('constant.userRole.admin'),config('constant.userRole.sub_admin')])){
            $isAdminOrSubAdmin = true;
        }

        return $isAdminOrSubAdmin;
    }

    public static function isVendor($user){
        $isVendor = false;
        if($user->hasRole(config('constant.userRole.vendor'))){
            $isVendor = true;
        }

        return $isVendor;
    }

    public static function isCustomer($user){
        $isCustomer = false;
        if($user->hasRole(config('constant.userRole.customer'))){
            $isCustomer = true;
        }

        return $isCustomer;
    }

    public static function checkEnv(){
        if(App::environment(['local', 'staging','development'])){
            return true;
        }
        return false;
    }

    public static function cartCount(){
        $session_id = \Session::getId();
        if(Auth::id())
        {
            $carts = \App\Models\TempData::where(['type'=>'cart','user_id'=>Auth::id()])->first();
        }
        else
        {
           $carts = \App\Models\TempData::where(['type'=>'cart','session_id'=>$session_id])->first(); 
        }
        
        $oldCart = ($carts && !empty($carts->name)) ? unserialize($carts->name) :  NULL;
        $cart = new \App\Library\Cart($oldCart);
        return count($cart->items)??0;
        // return $cart->totalItem??0;
    }


    public static function cartCountApi($user){
        $carts = \App\Models\TempData::where(['type'=>'cart','user_id'=>$user])->first();
        
        $oldCart = ($carts && !empty($carts->name)) ? unserialize($carts->name) :  NULL;
        $cart = new \App\Library\Cart($oldCart);
        return count($cart->items)??0;
        // return $cart->totalItem??0;
    }

    public static function addVariationProduct($product, $request){
        $variations = json_decode($request->attributes_data_products);
        $variations_count = 0;
        $attributes_count = 0;
        if(count($variations)>0){
            foreach($variations as $variation){
                $variations_count++;
                $product_variant = new ProductVariant;
                $product_variant->product_name = $variation->variation_name;
                $product_variant->product_slug = generateSlug($variation->variation_name,$product_variant,'product_slug');
                $product_variant->product_sku = generateSku($product_variant,'product_sku');
                $product_variant->product_id  = $product->id;
                $product_variant->created_by  = $product->created_by;
                
                $product_variant->regular_price = $variation->regular_price??'0.00';
                $product_variant->sale_price = (!empty($variation->sale_price)) ? $variation->sale_price : NULL;
                $product_variant->price = (!empty($variation->sale_price)) ? $variation->sale_price : $variation->regular_price;
                $product_variant->stock_quantity = (!empty($variation->stock_quantity)) ? $variation->stock_quantity : NULL;
                $product_variant->stock_availability = (!empty($variation->stock_availability)) ? $variation->stock_availability : NULL;


                $product_variant->product_weight   = $variation->product_weight;
                $product_variant->product_length   = $variation->product_length;
                $product_variant->product_width    = $variation->product_width;
                $product_variant->product_height   = $variation->product_height;

                $product_variant->product_weight_unit   = $variation->product_weight_unit;
                $product_variant->product_length_unit   = $variation->product_length_unit;
                $product_variant->product_width_unit    = $variation->product_width_unit;
                $product_variant->product_height_unit   = $variation->product_height_unit;

                $product_variant->package_type_id       = $variation->package_type_variation;
                
                $product_variant->updated_by  = $product->created_by;
                $product_variant->status  = config('constant.status.active');
                $product->on_sale   = $variation->on_sale??0;
                $product_variant->save();
                if(count($variation->attributes_data)>0){
                    $attributes_count++;
                    foreach($variation->attributes_data as $attr){
                        $map = new \App\Models\ProductAttributeMap;
                        $map->product_variant_id = $product_variant->id;
                        $map->attribute_map_id = $attr->id;                       
                        $map->save();
                    }
                }

                if(count($variation->images)>0){
                    foreach($variation->images as $img){
                        $image = new \App\Models\Image;
                        $image->url = $img;
                        $product_variant->images()->save($image);
                    }
                }
                
            }
        }
        if($variations_count==0){
            throw new \Exception('Please add variation product');
        }else if($attributes_count==0){
            throw new \Exception('Please for variation product select attribute');
        }else if($variations_count==$attributes_count){
            return true;
        }else{
            throw new \Exception('Somthing went wrong');
        }
    }

    public static function subAdminProductIds($sub_admin_id,$type=''){
        $vendors_ids = \App\Models\SubadminVendor::where('subadmin_id',$sub_admin_id)->pluck('vendor_id');
        if($type=='vendors'){
            return $vendors_ids;
        }
        if($vendors_ids->count()){
            $products_ids = \App\Models\Product::whereIn('vendor_id',$vendors_ids)->pluck('id');
            return $products_ids;
        }
        return [];
    }

    public static function vendorProductIds($vendor_id){
        $products_ids = \App\Models\Product::where('vendor_id',$vendor_id)->pluck('id');
        return $products_ids;
    }

    public static function addProductToCart($item,$user_id){
        $product = \App\Models\Product::where('id',$item['product_id'])->first();
        $variation_array_data = [];
        $variation_id = '';
        $cart = \App\Models\UserDetail::where('user_id',$user_id)->first();
        if(!$cart){
            $cart = new \App\Models\UserDetail;
            $cart->user_id = $user_id;
        }

        if(!$product){
            return ['status'=>false,'msg'=>'Product not found in our system','product'=>$item['name']];
        }else if(empty($product->price)){
            return ['status'=>false,'msg'=>'This product is now out of stock','product'=>$item['name']];
        }else if(empty($product->stock_quantity)){
            return ['status'=>false,'msg'=>'This product is now out of stock','product'=>$item['name']];
        }

        $oldCart = (isset($cart->cart_items) && !empty($cart->cart_items)) ? unserialize($cart->cart_items) : NULL;
        $cart_data    = new \App\Library\Cart($oldCart);
        $index = $product->id;
        $qty = 0;
        if(isset($item['qty']) && $item['qty']>0){
            $qty = $item['qty'] - 1;
        }
        $cart_data->addToCartSimple($product,$index,$qty);
        $cart->cart_items = serialize($cart_data);
        $cart->save();
        return ['status'=>true,'msg'=>'Product added to cart','product'=>$item['name']];
    }

    public static function sendDefaultMail($data){
        $data['from_email'] = config('constant.defaultEmail');
        $data['view']       = $data['view']??'common.default-mail';
        try {
            Mail::to($data['mail_to'])->send(new DefaultMail( $data ));
        } catch (\Swift_TransportException $e) {
            return $e->getMessage();
        }
    }

    public static function uniqueCode($table,$field){
        $code = mt_rand(1000,9999);
        do{
            $code = mt_rand(1000,9999);
        }while(DB::table($table)->where($field,$code)->first());
        
        return $code;
    }

    public static function updateShippingAndBillingAddress($user,$data){
        try {
            
            DB::beginTransaction();
            $customer_information = Address::where(['user_id'=>$user->id,'address_type'=>'information'])->first();
            $msg = 'Customer information updated successfully';
            if(!$customer_information){
                $customer_information = new Address;
                $customer_information->user_id = $user->id;
                $customer_information->address_type = 'information';
                $customer_information->shipping_address_type = $data->shipping_address_type ?? 'commercial';
                $msg = 'Customer information created successfully';
            }
            $customer_information->first_name = $data->first_name;
            $customer_information->middle_name = $data->middle_name??NULL;
            $customer_information->last_name = $data->last_name;
            $customer_information->company_name = $data->company_name??NULL;
            $customer_information->mobile = $data->phone_number;
            $customer_information->address = $data->mailing_address_line_1;
            $customer_information->address_line_2 = $data->address_line_2;
            $customer_information->city = $data->city;
            $customer_information->state = $data->state;
            $customer_information->country = $data->country;
            $customer_information->zip_code = $data->zip_code;
            if(!empty($data->about_us)){
                $customer_information->hear_about_us = $data->about_us;
            }
            $customer_information->email = $data->email_address;
            $customer_information->default_address = $data->billig_checkbox??0;
            $customer_information->save();

            if(empty($user->first_name)){
                $user->first_name = $data->first_name;
                $user->name = $data->first_name.' '.$data->last_name;
            }

            if(empty($user->last_name)){
                $user->last_name = $data->last_name;
            }
            if(empty($user->phone)){
                $user->phone = $data->phone_number;
            }

            if(empty($user->address)){
                $user->address = $data->mailing_address_line_1;
            }
            if(empty($user->city)){
                $user->city = $data->city;
            }else{
                if(!empty($user->city) && is_string($user->city)){
                    if(is_numeric($data->city)){
                        $user->city = $data->city;
                    }
                }
            }
            if(empty($user->state)){
                $user->state = $data->state;
            }else{
                if(!empty($user->state) && is_string($user->state)){
                    if(is_numeric($data->state)){
                        $user->state = $data->state;
                    }
                }
            }

            if(empty($user->country)){
                $user->country = $data->country;
            }else{
                if(!empty($user->country) && is_string($user->country)){
                    if(is_numeric($data->country)){
                        $user->country = $data->country;
                    }
                }
            }
            if(empty($user->zip_code)){
                $user->zip_code = $data->zip_code;
            }

            $user->save();

            $customer_billing = Address::where(['user_id'=>$user->id,'address_type'=>'billing'])->first();

            if(!$customer_billing){
                $customer_billing = new Address;
                $customer_billing->user_id = $user->id;
                $customer_billing->address_type = 'billing';
            }
            if(!empty($data->billig_checkbox)){
                $customer_billing->first_name = $data->first_name;
                $customer_billing->middle_name = $data->middle_name??NULL;
                $customer_billing->last_name = $data->last_name;
                $customer_billing->company_name = $data->company_name??NULL;
                $customer_billing->mobile = $data->phone_number;
                $customer_billing->address = $data->mailing_address_line_1;
                $customer_billing->address_line_2 = $data->address_line_2;
                $customer_billing->city = $data->city;
                $customer_billing->state = $data->state;
                $customer_billing->country = $data->country;
                $customer_billing->zip_code = $data->zip_code;
                $customer_billing->email = $data->email_address;
                
                $customer_billing->save();
            }else{
                $customer_billing->first_name = $data->billing_first_name;
                $customer_billing->middle_name = $data->billing_middle_name;
                $customer_billing->last_name = $data->billing_last_name;
                $customer_billing->company_name = $data->billing_company_name??NULL;
                $customer_billing->address = $data->billing_mailing_address_line_1;
                $customer_billing->address_line_2 = $data->billing_address_line_2;
                $customer_billing->city = $data->billing_city;
                $customer_billing->state = $data->billing_state;
                $customer_billing->country = $data->billing_country;
                $customer_billing->zip_code = $data->billing_zip_code;
                $customer_billing->email = $data->billing_email_address;
                $customer_billing->mobile = $data->billing_phone_number;
                $customer_billing->save();
            }
            
            DB::commit();
            return ['status'=>true,'msg'=>$msg, 'customer' => $customer_information];
        } catch (\Exception $e) {
            DB::rollback();
            return ['status'=>false,'msg'=>$e->getMessage()];
        }
    }

    public static function getCustomerAddress($user_id){
        $addresses['customer'] = optional(Address::where(['user_id'=>$user_id,'address_type'=>'information'])->with(['countryName:id,name','stateName:id,name','cityName:id,name'])->first())->toArray();
        if(!empty($addresses['customer'])){
            $addresses['customer']['billig_checkbox'] = $addresses['customer']['default_address'];
            $addresses['customer']['mailing_address_line_1'] = $addresses['customer']['address'];
            $addresses['customer']['phone_number'] = $addresses['customer']['mobile'];
            $addresses['customer']['email_address'] = $addresses['customer']['email'];
        } 
        
        $addresses['billing']  = optional(Address::where(['user_id'=>$user_id,'address_type'=>'billing'])->with(['countryName:id,name','stateName:id,name','cityName:id,name'])->first())->toArray();
        if(!empty($addresses['billing'])){
            $addresses['billing']['billing_first_name'] = $addresses['billing']['first_name'];
            $addresses['billing']['billing_last_name'] = $addresses['billing']['last_name'];
            $addresses['billing']['billing_middle_name'] = $addresses['billing']['middle_name'];
            $addresses['billing']['billing_mailing_address_line_1'] = $addresses['billing']['address'];
            $addresses['billing']['billing_address_line_2'] = $addresses['billing']['address_line_2'];
            $addresses['billing']['billing_zip_code'] = $addresses['billing']['zip_code'];
            $addresses['billing']['billing_phone_number'] = $addresses['billing']['mobile'];
            $addresses['billing']['billing_email_address'] = $addresses['billing']['email'];
            $addresses['billing']['billing_country'] = $addresses['billing']['country'];
            $addresses['billing']['billing_city'] = $addresses['billing']['city'];
            $addresses['billing']['billing_state'] = $addresses['billing']['state'];
        }
        return $addresses;
    }

    public static function getCountry($country_id){
        $cntry = ['id'=>0,'name'=>''];
        if(empty($country_id)){
            return $cntry;
        }else if(is_numeric($country_id)){
            $country = \App\Models\Country::where(['id'=>$country_id,'status'=>config('constant.status.active')])->select('id','name')->first();
        }else{
            $country = \App\Models\Country::where(['name'=>$country_id,'status'=>config('constant.status.active')])->select('id','name')->first();
        }
        
        
        if(!empty($country)){
            return ['id'=>$country->id,'name'=>$country->name];
        }

        return $cntry;
    }

    public static function getState($state_id){
        $record = ['id'=>0,'name'=>''];
        if(empty($state_id)){
            return $record;
        }else if(is_numeric($state_id)){
            $state = \App\Models\State::where(['id'=>$state_id,'status'=>config('constant.status.active')])->select('id','name')->first();
        }else{
            $state = \App\Models\State::where(['name'=>$state_id,'status'=>config('constant.status.active')])->select('id','name')->first();
        }
        
        
        if(!empty($state)){
            return ['id'=>$state->id,'name'=>$state->name];
        }

        return $record;
    }

    public static function getCity($city_id){
        $record = ['id'=>0,'name'=>''];
        if(empty($city_id)){
            return $record;
        }else if(is_numeric($country_id)){
            $city = \App\Models\State::where(['id'=>$city_id,'status'=>config('constant.status.active')])->select('id','name')->first();
        }else{
            $city = \App\Models\State::where(['name'=>$city_id])->select('id','name')->first();
        }
        
        
        if(!empty($city)){
            return ['id'=>$city->id,'name'=>$city->name];
        }

        return $record;
    }

    public static function getBestSellingProductId($limit,$vendor_id){
        if(empty($vendor_id)){
            $query = \App\Models\BestSellerProduct::query();
            if(!empty($limit)){
                $query->limit($limit);
            }
            $query->orderBy('total','desc');
            $products_ids = $query->pluck('product_id');
            return $products_ids;
        }else{
            $query = \App\Models\BestSellerProduct::query();
            if(is_array($vendor_id)){
                $query->whereIn('products.vendor_id',$vendor_id);
            }else{
                $query->where('products.vendor_id',$vendor_id);
            }
            
            $query->where('products.status',config('constant.status.active'));
            $query->join('products','best_seller_products.product_id','=','products.id');
            if(!empty($limit)){
                $query->limit($limit);
            }
            $query->orderBy('best_seller_products.total','desc');
            $data = $query->pluck('best_seller_products.product_id');
            return $data;
        }
    }

    public static function getUnits(){
        $data = [];
        $record = \App\Models\Option::where('name','_units')->first();
        if($record){
            $data = (!empty($record->data))?unserialize($record->data):[];
            
            $data = collect($data)->filter(function($value,$key){
                if(isset($value['status']) && $value['status']==config('constant.status.active')){
                    return $value;
                }
                
            });
                        
        }
        return $data;
    }


    public static function getNotifications(){
        $record = [];
        $assigned_vendor = \App\Models\SubadminVendor::distinct('vendor_id')->pluck('vendor_id');
        
        $record = \App\User::where('role_id',3)->whereNotIn('id',$assigned_vendor)->whereNull('sales_rep')->take(10)->orderBy('id','desc')->get();
        return $record;
    }


    public static function getPackageTypes(){
        $record = \App\Models\PackageType::where('status',1)->get();
        return $record;
    }


    public static function getHomeMessage(){
        $record = \App\Models\Message::where('type','home')->first();
        return $record;
    }

    /*
    * here generate create and generate label return order
    * $request is array
    **/
    public static function createReturnOrder($order_id){
        try {
            $order = OrderProduct::findOrFail($order_id);
            $orderReturn = OrderProductReturnStatus::where('order_product_id', $order_id)->first();
            if(!empty($orderReturn->create_waybill_status) && !empty($orderReturn->generate_waybill_status)){
                return true;
            }
            // $war_obj = Warehouse::find(2);
            $war_obj = User::with('countryName','stateName','cityName')->where('id',$order->vendor_id)->first();
            $sno = '';
            $waybill_array = GetFunction::generateWayBillRequest($order, $war_obj, $sno);
            $js_data = stripslashes(json_encode($waybill_array));
            if (empty($orderReturn->create_waybill_status)) {
                OrderProductReturnStatus::where('order_product_id', $order_id)->update(['create_waybill_request' => $js_data]);
                $url = 'https://api.logixplatform.com/webservice/v2/CreateWaybill?secureKey=FEB6799223514F2184C33D28CBC51415';
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS =>  $js_data,
                    CURLOPT_HTTPHEADER => array(
                        "AccessKey: logixerp",
                        "Content-Type: application/json"
                    ),
                ));
                $create_response = curl_exec($curl);
                curl_close($curl);
                $create_data = json_decode($create_response);
                if ($create_data->messageType == 'Error') {
                    OrderProductReturnStatus::where('order_product_id', $order_id)->update(['create_waybill_response' => $create_response]);
                    return false;
                }

                OrderProductReturnStatus::where('order_product_id', $order_id)->update(['create_waybill_status' => $create_response]);
            } else {
                $create_data = json_decode($orderReturn->create_waybill_status);
            }

            $shiping = json_decode($order->shipping_json);

            # Generate carrierWaybill...
            $url = 'https://api.logixplatform.com/webservice/v2/GenerateCarrierWaybill?secureKey=FEB6799223514F2184C33D28CBC51415';
            $g_arr = [
                'waybillNumber' => $create_data->waybillNumber,
                'carrierCode' => $shiping->carrierCode,
                'aggregator' => '',
                'carrierProduct' => $shiping->serviceCode,
            ];
            
            if (empty($orderReturn->generate_waybill_status)) {
                OrderProductReturnStatus::where('order_product_id', $order_id)->update(['generate_waybill_request' => json_encode($g_arr)]);
                $g_client = new Client(['headers'=>['AccessKey'=>Config('constants.AccessKey')]]);
                $rg = $g_client->post($url,['form_params' => $g_arr]);
                $g_response = $rg->getBody()->getContents();
                $json = json_decode($g_response);
                if ($json->messageType == 'Error') {
                    OrderProductReturnStatus::where('order_product_id', $order_id)->update(['generate_waybill_response' => $g_response]);
                    return false;
                }

                OrderProductReturnStatus::where('order_product_id', $order_id)->update(['generate_waybill_status' => $g_response]);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /*
    * $request_arr is array
    **/
    public static function generateWayBillRequest($order_item, $war_obj, $sno){
        $ship = json_decode($order_item->shipping_json);
        $qty = $no_of_pkg = $wt = $ln = $ht = $wh = 0;
        $qty += $order_item->quantity ?? 1;        
        if($order_item->product_variant_id!=NULL) {
            $product_query = ProductVariant::with('package_type')->where('id',$order_item->product_variant_id)->first();

            $wt += $product_query->product_weight ?? 1;
            $ln += $product_query->product_length ?? 10;
            $ht += $product_query->product_height ?? 8;
            $wh += $product_query->product_width ?? 3; 
        } else {
           $product_query = Product::with('package_type')->where('id',$order_item->product_id)->first();
           $wt += $product_query->product_weight ?? 1;
           $ln += $product_query->product_length ?? 10;
           $ht += $product_query->product_height ?? 8;
           $wh += $product_query->product_width ?? 3;
        }

        // $wt += $order_item->product->product_weight ?? 1;
        // $ln += $order_item->product->product_length ?? 10;
        // $ht += $order_item->product->product_height ?? 8;
        // $wh += $order_item->product->product_width ?? 3;

        $package_json_string_array = array();                
        $data = array(
            'barCode'                 => '',
            'packageCount'            =>  1,
            'length'                  => $ln,
            'width'                   => $wh,
            'height'                  => $ht,
            'weight'                  => $wt,
            'chargedWeight'           => $wt,
            'itemCount'               => $qty,
            'selectedPackageTypeCode' =>  $product_query->package_type->code ?? 'BOX',
        );

        array_push($package_json_string_array, $data);
        $no_of_pkg = $qty;
        
        $country_data = $war_obj->countryName;
        $state_data = $war_obj->stateName;
        
        $sq_no = 'DNC-'.rand(0,9999).'-'.$order_item->id.'-'.date('Ymd');

        $order_main = Order::where('id',$order_item->order_id)->first();
        
        $waybill_array = array(
            "waybillRequestData" => array(
                "consigneeGeoLocation" => "",
                "FromOU" => '',
                "DeliveryDate" => date('Y-m-d'),
                "WaybillNumber" => $sq_no,
                "CustomerCode" => '1234',
                "CustomerName" => $order_main->address['shipping_address']['first_name'].' '.$order_main->address['shipping_address']['last_name'],
                "CustomerEmail" => $order_main->address['shipping_address']['email'],
                "CustomerPhone" => $order_main->address['shipping_address']['mobile'],
                "CustomerAddress" => $order_main->address['shipping_address']['address'].' '.$order_main->address['shipping_address']['address_line_2'],
                "CustomerCity" => $order_main->address['shipping_address']['city_name']['name'],
                "CustomerCountry" => $order_main->address['shipping_address']['country_name']['iso2'],
                "CustomerState" => $order_main->address['shipping_address']['state_name']['iso2'],
                "CustomerPincode" => $order_main->address['shipping_address']['zip_code'],
                "ConsigneeCode" => '00000',
                "ConsigneeName" => $war_obj->name,
                "ConsigneeEmail" => $war_obj->email,
                "ConsigneePhone" => $war_obj->phone,
                "ConsigneeAddress" => $war_obj->address,
                "ConsigneeCountry" => $country_data->iso2,
                "ConsigneeState" => $state_data->iso2,
                "ConsigneeCity" => $war_obj->cityName->name,
                "ConsigneePincode" => $war_obj->zip_code,
                "ConsigneeWhat3Words" => "",
                "CreateWaybillWithoutStock" => "true",
                "StartLocation" => "",
                "EndLocation" => "",
                "ClientCode" => '1234',
                "NumberOfPackages" => 1,
                "ActualWeight" => 1,
                "ChargedWeight" => 1,
                "CargoValue" => $order_item->price,
                "ReferenceNumber" => $order_item->order_id,
                "InvoiceNumber" => $order_item->order_id,
                "PaymentMode" => "TBB",
                "ServiceCode" => $ship->serviceCode,
                "WeightUnitType" => "POUND",                
                "Description" => "Dnc Vendor return order",
                "COD" => "",
                "stockIn" => true,
                "CODPaymentMode" => "CASH",
                "DutyPaidBy" => "Receiver",
                "WaybillPrintDesign" => "",
                "StickerPrintDesign" => "",
                "skipCityStateValidation" => "true",
                "Currency" => "CAD",
                "packageDetails" => array(
                    'packageJsonString' => $package_json_string_array
                )
            )
        );

        return $waybill_array;
    }
    
}
