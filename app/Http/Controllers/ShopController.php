<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    
    const ITEMS_PER_PAGE = 6;
    const ORDER_BY = 'shops.name';
    const ORDER_TYPE = 'asc';
    const ORDER_CATEGORY = '';
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchData(Request $request)
    {
        $q = $request->input('search');
        $orderby = $request->input('orderby');
        $ordertype = $request->input('ordertype');
        $ordercategory = $request->input('ordercategory');
        
        
        
        //construcción de la consulta
        $shop = \DB::table('shops')->select('shops.*');

        //agregando condición a la consulta, si la hay
        if($q != '') {
            $shop = $shop->where('shops.name', 'like', '%' . $q . '%');
        }
        
        //agregando el orden a la consulta
        if($orderby && $orderby != ""){
            $shop = $shop->orderBy($ordertype ,$orderby);
        }else if($orderby != self::ORDER_BY) {
            $shop = $shop->orderBy(self::ORDER_BY, self::ORDER_TYPE);
        }
        
        
        if($ordercategory != self::ORDER_CATEGORY){
            $shop = $shop->where('shops.category', 'like', $ordercategory);
        }


        //ejecutar la consulta, usando la paginación
        $shops = $shop->paginate(self::ITEMS_PER_PAGE)->withQueryString();
        
        return response()->json([
                                    'csrf' => csrf_token(),
                                    'url' => url('/'),
                                    'user' => Auth::user(),
                                    'shops' => $shops,
                                ], 200);
        
    }
    
    
    
    public function index(Request $request)
    {
        return view('shop.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()){
            if(Auth::user()->email == 'cadibe148@gmail.com'){
                $types = [
                    'men' => 'Men',
                    'women' => 'Women',
                    'child' => 'Child',
                ];
                
                return view('shop.create', ['types' => $types]);
            }
        }
        
        return back()->withErrors(['message' => 'You can not add products']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $shop = new Shop();
            $shop->name = $request->name;
            $shop->price = $request->price;
            $shop->category = $request->type;
            $shop->description = $request->description;
            if($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
                $archivo = $request->file('thumbnail');
                $path = $archivo->getRealPath();
                $imagen = file_get_contents($path);
                $shop->thumbnail = base64_encode($imagen);
            }else{
                return back()
                    ->withInput()
                    ->withErrors(['message' => 'An unexpected error occurred whit the thumbnail']);
            }
            $shop->save();
            return redirect('/');
        }catch(\Exception $e){
            return back()
                ->withInput()
                ->withErrors(['message' => 'An unexpected error occurred while creating.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return view('shop.show', ['shop' => $shop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        if(Auth::user()){
            if(Auth::user()->email == 'cadibe148@gmail.com'){
                $types = [
                    'men' => 'Men',
                    'women' => 'Women',
                    'child' => 'Child',
                ];
                
                return view('shop.edit', ['shop' => $shop , 'types' => $types]);
            }
        }
        
        return back()->withErrors(['message' => 'You can not edit products']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        try{
            $shop->name = $request->name;
            $shop->category = $request->type;
            $shop->price = $request->price;
            $shop->description = $request->description;
            if($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
                $archivo = $request->file('thumbnail');
                $path = $archivo->getRealPath();
                $imagen = file_get_contents($path);
                $shop->thumbnail = base64_encode($imagen);
            }
            $shop->update();
            return redirect('/');
        }catch(\Exception $e){
            return back()
                ->withInput()
                ->withErrors(['message' => 'An unexpected error occurred while updating.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
         if(Auth::user()){
            if(Auth::user()->email == 'cadibe148@gmail.com'){
                try{
                    $shop->delete();
                    return redirect('/');
                }catch(\Exception $e){
                    return back()->withErrors(['message' => 'An unexpected error occurred while deleting.']);
                }
            }
        }
        
        return back()->withErrors(['message' => 'You can not delete products']);
    }
    
    
    
    
    // private function getOrder($orderArray, $order, $default) {
    //     $value = array_search($order, $orderArray);
    //     if(!$value) {
    //         return $default;
    //     }
    //     return $value;
    // }

    // private function getOrderBy($order) {
    //     return $this->getOrder($this->getOrderBys(), $order, self::ORDER_BY);
    // }

    // private function getOrderBys() {
    //     return [
    //         'shops.name'       => 'b2',
    //         'price'       => 'b3',
    //     ];
    // }

    // private function getOrderType($order) {
    //     return $this->getOrder($this->getOrderTypes(), $order, self::ORDER_TYPE);
    // }

    // private function getOrderTypes() {
    //     return [
    //         'asc'  => 't1',
    //         'desc' => 't2',
    //     ];
    // }
    
    // private function getOrderCategory($order) {
    //     return $this->getOrder($this->getOrderCategories(), $order, self::ORDER_CATEGORY);
    // }

    // private function getOrderCategories() {
    //     return [
    //         'all'  => 'c4',
    //         'men'  => 'c1',
    //         'women' => 'c2',
    //         'child' => 'c3',
    //     ];
    // }

    // private function getOrderUrls($oBy, $oType, $oCategory, $q, $route) {
    //     $urls = [];
    //     $orderBys = $this->getOrderBys();
    //     $orderTypes = $this->getOrderTypes();
    //     $orderCategories = $this->getOrderCategories();
    //     foreach($orderBys as $indexBy => $by) {
    //         foreach($orderTypes as $indexType => $type) {
    //             foreach($orderCategories as $indexCategory => $category) {
    //                 if($oBy == $indexBy && $oType == $indexType && $oCategory == $indexCategory) {
    //                     $urls[$indexBy][$indexType][$indexCategory] = url()->full() . '#';
    //                 } else {
    //                     $urls[$indexBy][$indexType][$indexCategory] = route($route, [
    //                                                             'orderby'   => $by,
    //                                                             'ordertype' => $type,
    //                                                             'ordercategory' => $category,
    //                                                             'q'         => $q]);
    //                 }
    //             }
    //         }
    //     }
    //     return $urls;
    // }
    
    // public function chart(Request $request, Shop $shops){
    //     $shop = $request->shop;
    //     $shop = \DB::select('select * from shops where id = :id', ['id' => $shop]);
    //     $shop = $shop[0];
    //     $shops->id = $shop->id;
    //     $shops->name = $shop->name;
    //     $shops->price = $shop->price;
    //     $shops->category = $shop->category;
    //     $shops->thumbnail = $shop->thumbnail;
    //     $shops->description = $shop->description;
    //     $shops->ammount = $request->ammount;
    //     $shops->idcart = 1;
    //     $shops->update();
    //     return redirect('/');
        
    // }
    
    public function viewChart(){
        return view('chart.index');
    }
    
}

    
