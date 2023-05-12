<?php



namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use File;

class ProductController extends Controller
{
    //
    public function index(Request $request, )
    {
    
      if ($request->has('keyword')) {
       
        $product =  Product::with('categories')->where('name', 'LIKE', '%'.$request->keyword.'%')
        ->orwhere('status', 'LIKE', '%'.$request->keyword.'%')->get();;
        
    }else{
      $product = Product::with('categories')->get();
     
    }
     
      //$categories = Category::get();
     // return $product;
     return view('product')->with(compact('product'));
    }
    public function category(Request $request, )
    {
      $Categories = Category::get();
       
       
      
      return view('category')->with(compact('Categories'));
     // return $products;
    }
    public function create()
    {
      $categories = Category::get();
      return view('create')->with(compact('categories'));
       
    }

    public function edit(Product $product)
    {
    //  $product = Product::get();
        $categories = Category::get();
        
        $oldcategorys = ProductCategory::where('product_id', $product->id)
        ->pluck('category_id')->toArray();
//return $oldcategorys;
 
 return view('edit',compact('product','categories','oldcategorys'));
    }
     
    public function store(Request $request)
    {
      $imageName = time().'.'.$request->image->extension();  
      $product = Product::create([
        'name' => $request->name,
       
       'price' => $request->price,
        'quantity' => $request->quantity,
        'status' => $request->status,
        'image' => $imageName,
    ]);

      $categoryies=$request->category;
  
    $category = Category::find([$categoryies]);
        $product->categories()->attach($category);
 //  $request->file('image')->store('public/images');
   $request->image->move(public_path('images'), $imageName);   
   
   return Redirect::to('/admin/product');
 
   
    }
   
    
   public function update(Request $request, Product $product)
    {
   
         // do something
         if($request->has('image')){
         $imageName = time().'.'.$request->image->extension();  
        $product->update([
          
          'name' => $request->name,
          'category_id' => $request->category,
         'price' => $request->price,
          'quantity' => $request->quantity,
          'status' => $request->status,
          'image' => $imageName,
          
          
        ]);
        $request->image->move(public_path('images'), $imageName);   
    }else{
      $product->update([
          
        'name' => $request->name,
        'category_id' => $request->category,
       'price' => $request->price,
        'quantity' => $request->quantity,
        'status' => $request->status,
        
        
        
      ]);
    }
       
       
       
        
       
        return Redirect::to('/admin/product');
    
     
    
     
   }
 
    public function show(Product $product)
    {
       
    
     
      File::deleteDirectory(storage_path('app/public/image/'.$product->image));
     $product->delete();
       
     return Redirect::to('/admin/product');
    
     // return $product;
    }
}
