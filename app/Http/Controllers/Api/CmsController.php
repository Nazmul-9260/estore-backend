<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Cms\Entities\CmsMenu;
use Modules\Cms\Entities\SiteInfo;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\CustomerAddress;
use Modules\Config\Entities\Config;
use Modules\Config\Entities\Product;
use Modules\Config\Entities\ProductCategory;
use App\DTO\AddressTypeResponseDto;
use App\Models\SaleOrder;
use App\Models\SaleOrderLine;
use Exception;
use App\Http\Requests\Api\ConfirmOrderApiRequest;
use App\Http\Resources\CustomerOrderResource;
use App\Models\CustomerDetails;
use App\Models\HeroSlider;
use App\Services\MailService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Modules\Config\Entities\ProductQa;
use Modules\Config\Entities\ProductReview;
use App\Services\SliderService;
use App\Http\Resources\HeroSliderResource;
use App\Http\Resources\ProductQaResource;
use App\Http\Resources\ProductReviewResource;
use App\DTO\OrderStatusTypeResponseDto;
use App\Http\Resources\CustomerPaymentResource;
use App\Http\Resources\CustomerQaResource;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\CustomerReviewResource;
use App\Models\Customer;

class CmsController extends Controller
{
    public function getSiteInfo()
    {
        $siteInfoData = SiteInfo::where('status', 1)->first();
        if ($siteInfoData != '') {
            $data =
                [
                    'site_name' => $siteInfoData->site_name,
                    'meta_type' => $siteInfoData->meta_type,
                    'logo' => $siteInfoData->logo,
                    'favicon' => $siteInfoData->favicon,
                    'moto' => $siteInfoData->moto,
                    'site_title' => $siteInfoData->site_title,
                    'domain_name' => $siteInfoData->domain_name,
                    'email' => $siteInfoData->email,
                    'phone' => $siteInfoData->phone,
                ];
        }
        $response =
            [
                'status' => 'success',
                'data' => $data,
                'message' => 'Site Info are Fetched'
            ];

        return response()->json($response, 200);
    }

    // public function getTopMenu()
    // {
    //     $response = CmsMenu::where('position', 1)->get();
    //     return response()->json($response, 200);
    // }

    public function getTopMenu($parentId = NULL)
    {
        $tree = [];
        $response = CmsMenu::where('position', 1)->get();
        foreach ($response as $menu) {
            if ($menu->parent_id == $parentId) {
                $children = $this->getTopMenu($menu->id);
                $node = [
                    'name' => $menu->title,
                    'linkmenus' => $menu->url ?? null,
                ];
                if (!empty($children)) {
                    $node['items'] = $children;
                }
                $tree[] = $node;
            }
        }
        return $tree;
    }


    public function getFooterMenu($parentId = NULL)
    {
        $tree = [];
        $response = CmsMenu::where('position', 2)->get();
        foreach ($response as $menu) {
            if ($menu->parent_id == $parentId) {
                $children = $this->getTopMenu($menu->id);
                $node = [
                    'name' => $menu->title,
                    'linkmenus' => $menu->url ?? null,
                ];
                if (!empty($children)) {
                    $node['items'] = $children;
                }
                $tree[] = $node;
            }
        }
        return $tree;
    }

    public function getHeroSliders(SliderService $sliderService)
    {
        return HeroSliderResource::collection($sliderService->getHeroSliders());
    }

    public function getTopbarInfo()
    {
        $data = [
            "welcomeTitle" => "Welcome To Our 4IR Store !",
            "needHelpTitle" => "Need help?",
            "supportNumber" => "+88 0961 1677 984",
            "email" => "info@saffroncorporation.com.bd",
            "contactUs" => "Contact Us"
        ];

        $response =
            [
                'status' => 'success',
                'success' => true,
                'message' => 'Topbar info fetched successfully. ',
                'data' => $data
            ];

        return response()->json($response, 200);
    }

    public function getAllProducts()
    {
        $products = ProductResource::collection(Product::orderBy('id', 'desc')->get());
        $data =
            [
                'products' => $products
            ];
        $response =
            [
                'status' => 'success',
                'success' => true,
                'message' => 'Web shop products fetched successfully. ',
                'data' => $data
            ];

        return response()->json($response, 200);
    }

    public function getAllCategoriesWithSubcategoriesWithAttachedProducts()
    {
        $categories = ProductCategoryResource::collection(ProductCategory::with(['productSubCategories.products'])->get());
        $data =
            [
                'categories' => $categories
            ];
        $response =
            [
                'status' => 'success',
                'success' => true,
                'message' => 'Web shop products fetched successfully. ',
                'data' => $data
            ];

        return response()->json($response, 200);
    }

    public function getProductsFilterByTag(Request $request)
    {
        if ($request->has('tag')) {
            $tag = filter_var(strip_tags($request->query('tag')), FILTER_DEFAULT);
            if (!$tag) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invaid Tag Input.',
                    'error' => true
                ], 422);
            }

            $existingTags = DB::table('master_common_configurations')->where('type', 'product_tag')->get();
            $existingTagNames = $existingTags->map(function ($tag) {
                return $tag->name;
            });
            if (!in_array($tag, $existingTagNames->toArray())) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No Tag Found of Your Input.',
                    'error' => true
                ], 422);
            }

            $selectedTag = DB::table('master_common_configurations')->where('type', 'product_tag')
                ->where('name', $tag)->first();
            $selectedTagValue = $selectedTag->value;

            $productIdListByTag = DB::table('product_tags')->where('product_tag_id', $selectedTagValue)->pluck('product_id');

            $products = ProductResource::collection(Product::orderBy('id', 'desc')->whereIn('id', $productIdListByTag->toArray())->get());

            $data =
                [
                    'filter_by_tag' => $tag,
                    'total' => count($products),
                    'products' => $products

                ];
            $response =
                [
                    'status' => 'success',
                    'success' => true,
                    'message' => count($products) > 0 ? 'Web shop products fetched successfully by Tag ' . $tag : 'No products found of this tag.'
                ];

            if (count($products) > 0) {
                $response['data'] = $data;
            }

            return response()->json($response, 200);
        } else {
            return $this->getAllProducts();
        }
    }

    // public function confirmOrder(ConfirmOrderApiRequest $request)
    public function confirmOrder(Request $request)
    {
        // return $request->all();
        // return response()->json([
        //     'message' => 'Your sent data with user',
        //     'customer' => CustomerResource::make($request->user()->with([
        //         'customerDetails',
        //         'customerAddress'
        //     ])->first()),
        //     'data' => $request->all()
        // ], 200);
        // return $request->order_lines;

        // $customer = $request->user();
        // $customerName = $customer->customerDetails->name;
        // return $customerName;

        try {
            $confirmationMailSent = false;
            $customer = $request->user();

            $saleOrder = SaleOrder::create([
                'order_date' => date('Y:m:d'),
                'customer_id' => $customer->id,
                'order_status' => 1,
                'discount_percentage' => $request->input('discount_percentage'),
                'total_discount' => $request->input('total_discount'),
                'vat_percentage' => $request->input('vat_percentage'),
                'order_amount' => $request->input('order_amount'),
                'total_vat' => $request->input('total_vat'),
                'grand_total' => $request->input('grand_total'),
                'delivery_charge' => $request->input('delivery_charge'),
                'bill_address_id' => $request->input('bill_address_id'),
                'payment_type_id' => $request->input('payment_type_id'),
                'delivery_address_id' => $request->input('delivery_address_id'),
                'remarks' => $request->input('remarks'),
                'created_by' => $customer->id
            ]);

            $saleOrderId = $saleOrder->id;

            $orderLines = $request->input('order_lines');

            $placedSaleOrderLines = [];

            foreach ($orderLines as $orderLine) {
                $orderLineProduct = Product::where('id', $orderLine['product_id'])->first();
                $saleOrderLine = SaleOrderLine::create([
                    'order_id' => $saleOrderId,
                    'product_id' => $orderLineProduct->id,
                    'product_name' => $orderLineProduct->title,
                    'product_code' => $orderLineProduct->code,
                    'quantity' => $orderLine['quantity'],
                    'unit_price' => $orderLine['unit_price'],
                    'unit_amount' => $orderLine['quantity'] * $orderLine['unit_price'],
                    'discount_percentage' => $orderLine['discount_percentage'],
                    'is_offer_product' => $orderLine['is_offer_product'] == 'false' ? 0 : 1,
                    'is_gift_product' => $orderLine['is_gift_product'] == 'false' ? 0 : 1,
                    'created_by' => $customer->id
                ]);
                $placedSaleOrderLines[] = $saleOrderLine;
            }

            if ($saleOrder->id) {
                $customerDetails = CustomerDetails::where('customer_id', $customer->id)->first();
                $customerDetailsModified = false;

                if ($request->has(['customer_name', 'email', 'mobile_number'])) {
                    if ($customerDetails) {
                        $customerDetails->name = $request->customer_name;
                        $customerDetails->email = $request->email;
                        $customerDetails->phone = $request->mobile_number;
                        $customerDetailsModified  = true;
                    } else {
                        $customerDetails =  CustomerDetails::create([
                            'customer_id' => $customer->id,
                            'name' => $request->customer_name,
                            'email' => $request->email,
                            'phone' => $request->mobile_number,
                            'created_by' => $customer->id
                        ]);
                    }
                    if ($customerDetailsModified) {
                        $customerDetails->save();
                    }
                }
                // Logging 
                Log::info('Order No ' . $saleOrderId . ' Placed Successfully at ' . now(), [
                    'order_id' => $saleOrderId,
                    'order_amount' => $saleOrder->grand_total,
                    'customer_id' => $customer->id,
                    'customer_name' => $customer->customerDetails ? $customer->customerDetails->name : 'Name not set'
                ]);

                // Send Email Notification
                $success = MailService::sendOrderConfirmation($customer->id);
                if ($success === true) {
                    $confirmationMailSent = true;
                } else {
                    $confirmationMailSent = $success;
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Order placed successfully',
                'data' => [
                    'sale_order_details' => [
                        'order' => $saleOrder,
                        'order_lines' => $placedSaleOrderLines,
                        'mail_notification_sent' => $confirmationMailSent
                    ]
                ]
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getCustomerAddessTypes()
    {
        $customerAddressTypes = Config::where('type', 'address_type')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Customer address types fetched successfully',
            'data' => [
                'customer_address_types' => $customerAddressTypes->map(function ($addressType) {
                    $dto =  new AddressTypeResponseDto($addressType->toArray());
                    return $dto->getResource();
                })
            ]
        ]);
    }

    public function getCustomerOrders(Request $request)
    {
        $customer = $request->user();

        $customerOrders = $customer->salesOrders()->orderBy('id', 'desc')->get();

        $data = [
            'customer_orders' => CustomerOrderResource::collection($customerOrders)
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Customer Orders fetched successfully.',
            'data' => $data
        ], 200);
    }

    public function getAllProductTags()
    {
        $productTags = Config::where('type', 'product_tag')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Customer address types fetched successfully',
            'data' => [
                'product_tags' => $productTags->map(function ($tag) {
                    return $tag->name;
                })
            ]
        ]);
    }

    public function createProductQasFromCustomer(Request $request)
    {

        // $customer = auth('sanctum')->user();

        $inputs = $request->all();

        $rules = [
            'is_anonymous' => ['required', 'boolean'],
            'product_id' => ['required', 'numeric'],
            'customer_name' => ['nullable'],
            'question' => ['required', 'max:300']
        ];

        $validator =  Validator::make($inputs, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error occured.',
                'errors' => $validator->errors()
            ]);
        }

        try {

            $product = Product::where('id', $request->product_id)->first();

            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product Not Found'
                ]);
            }

            $productQa = new ProductQa();
            $productQa->product_id = $product->id;
            $productQa->product_name = $product->title;
            $productQa->product_code = $product->code;
            if (!$request->is_anonymous) {
                $productQa->customer_name = $request->customer_name;
                $customer = $request->user();
                if ($customer) {
                    $customerId = $customer->id;
                    $productQa->customer_id = $customerId;
                    $productQa->is_anonymous = 0;
                } else {
                    $productQa->is_anonymous = 1;
                }
            }
            $productQa->question = $request->question;
            $productQa->created_at = Carbon::now();
            $productQa->status = 1;
            $saved = $productQa->save();

            if ($saved) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Successfully Product Question Added',
                    'data' => [
                        'product_qa' => $productQa
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed To Add Product Question',
                    'data' => [
                        'product_qa' => $productQa
                    ]
                ]);
            }
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function getProductQasByProductId($productId)
    {
        $product =  Product::query()->where('id', $productId)->first();

        $productQas = $product->productQas;

        return response()->json([
            'status' => 'success',
            'statusCode' => 200,
            'message' => 'Product ' . $product->title . ' faqs fetched successfully',
            'data' => [
                'qas' => ProductQaResource::collection($productQas)
            ]
        ]);
    }

    public function createProductReviewFromCustomer(Request $request)
    {

        $inputs = $request->all();

        $rules = [
            'is_anonymous' => ['required', 'boolean'],
            'product_id' => ['required', 'numeric'],
            'customer_name' => ['nullable'],
            'review' => ['required', 'max:300'],
            'review_star' => ['required', 'numeric']
        ];

        $validator =  Validator::make($inputs, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error occured.',
                'errors' => $validator->errors()
            ]);
        }

        try {

            $product = Product::where('id', $request->product_id)->first();

            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product Not Found'
                ]);
            }

            $productReview = new ProductReview();
            $productReview->product_id = $product->id;
            $productReview->product_name = $product->title;
            $productReview->product_code = $product->code;
            if (!$request->is_anonymous) {
                $productReview->customer_name = $request->customer_name;
                $customer = $request->user();
                if ($customer) {
                    $customerId = $customer->id;
                    $productReview->customer_id = $customerId;
                    $productReview->is_anonymous = 0;
                } else {
                    $productReview->is_anonymous = 1;
                }
            }
            $productReview->review = $request->review;
            $productReview->review_star = $request->review_star;
            $productReview->created_at = Carbon::now();
            $productReview->status = 1;
            $saved = $productReview->save();

            if ($saved) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Successfully Product Question Added',
                    'data' => [
                        'product_qa' => $productReview
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed To Add Product Question',
                    'data' => [
                        'product_qa' => $productReview
                    ]
                ]);
            }
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function getProductReviewByProductId($productId)
    {
        $product =  Product::query()->where('id', $productId)->first();

        $productQas = $product->productReviews;

        return response()->json([
            'status' => 'success',
            'statusCode' => 200,
            'message' => 'Product ' . $product->title . ' reviews fetched successfully',
            'data' => [
                'reviews' => ProductReviewResource::collection($productQas)
            ]
        ]);
    }

    public function getOrderStatusTypes()
    {
        $orderStatusTypes = Config::where('type', 'order_status')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Customer address types fetched successfully',
            'data' => [
                'order_status_types' => $orderStatusTypes->map(function ($orderStatusType) {
                    $dto =  new OrderStatusTypeResponseDto($orderStatusType->toArray());
                    return $dto->getResource();
                })
            ]
        ]);
    }

    public function getCustomerReviews(Request $request)
    {

        $customer = $request->user();

        $customerReviews =  $customer->productReviews()->orderBy('id', 'desc')->get();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Customer reviews are fetched successfully',
            'data' => [
                'customer_reviews' => CustomerReviewResource::collection($customerReviews)
            ]
        ]);
    }

    public function getCustomerQas(Request $request)
    {

        $customer = $request->user();

        $customerQas =  $customer->productQas()->orderBy('id', 'desc')->get();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Customer reviews are fetched successfully',
            'data' => [
                'customer_reviews' => CustomerQaResource::collection($customerQas)
            ]
        ]);
    }

    public function getCustomerPayments(Request $request)
    {
        $customer = $request->user();

        $customerPayments =  $customer->payments();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => 'Customer reviews are fetched successfully',
            'data' => [
                'customer_payments' => CustomerPaymentResource::collection($customerPayments)
            ]
        ]);
    }
}
