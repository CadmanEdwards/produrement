<?php

namespace App\Http\Controllers\Admin;

use App\User;
use DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use Session;
use App\Http\Requests\Admin\UpdateUsersRequest;

class InventoryController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('inventory')) {
            return abort(401);
        }

        $users = User::whereHas("roles", function($q) {
            $q->where("name",'!=', "administrator")
            ->Where("name", "Sub Admin");
        })->get();
        return view('admin.inventory.index', compact('users'));
    }

    

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('inventory')) {
            return abort(401);
        }
        $roles = Role::where("name",'!=', "administrator")
        ->where("name", "Sub Admin")
        ->get()->pluck('name', 'name');

        return view('admin.inventory.create', compact('roles'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */

    public function export()
    {
        if (! Gate::allows('inventory')) {
            return abort(401);
        }
        $roles = Role::where("name",'!=', "administrator")
        ->where("name", "Sub Admin")
        ->get()->pluck('name', 'name');

        return view('admin.inventory.export', compact('roles'));
    }

    public function export_submit()
    {
      if(isset($_POST['products'])){

        foreach ($_POST['products'] as $key => $product_id) 
        {
          $product_data = DB::table('product')->where('id','=',$product_id)->first();
          
          DB::table('product')
          ->insert([
            'name' => $product_data->name, 
            'category_id' => $product_data->category_id, 
            'acutal_price' => $product_data->acutal_price, 
            'discount_price'=> $_POST[$product_id.'_price'], 
            'skucode'=> $product_data->skucode,
            'discription'=> $product_data->discription,
            'images'=> $product_data->images,
            'company_id'=> Session::get('company_id'),
            'exported' => "", 
            'created_by'=> $product_data->created_by,
            'created_at' => date('Y-m-d h:i:s')
          ]);

          /// updating export to 1to remove duplication export ////
          DB::table('product')
          ->where('id', $product_id )
          ->update(array('exported' => $product_data->exported.','.Session::get('company_id').','));
        }
        return redirect()->route('admin.inventory.index')->with('success','Product Data Export Successfully.');
      } else {
        return redirect()->route('admin.inventory.index')->with('danger','You did not select any item to export.');
      }
    }

    public function store(Request $request)
    {
        
        if (! Gate::allows('inventory')) {
            return abort(401);
        }

        $this->validate($request, [

            'name' => 'required', 
            'category' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'discription' => 'required',  
     
         ]);
         if($request->hasfile('image')) { 
                    foreach($request->file('image') as $file)
                    {
                        $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $name = $fileName.'.'.$file->getClientOriginalExtension();
                        $file->move(public_path('product_images'),$name);
                        $image[]= $name;
                        
                        }
                        $image_name =  implode(',',$image);
            } else{
                $image_name = null;
            }

        

        DB::table('product')
              ->insert([
                  'name' => $request->name , 
                  'category_id' => $request->category ,
                  'GST' => $request->gst , 
                  'acutal_price' => $request->price, 
                  'discount_price'=> $request->discount_price, 
                  'skucode'=> $request->sku_code,
                  'discription'=> $request->discription,
                  'images'=> $image_name,
                  'exported' => "", 
                  'company_id'=> Session::get('company_id'),
                  'created_by'=> auth()->user()->id,
                  'created_at' => date('Y-m-d h:i:s')
                   ]);

        return redirect()->route('admin.inventory.index')->with('success','Product Add Successfully');
    }

    public function category_add(Request $request){

        $this->validate($request, [

            'name' => 'required', 
     //|unique:category;
         ]);


        DB::table('category')
              ->insert([
                  'name' => $request->name , 
                  'created_by'=> auth()->user()->id,
                  'created_at' => date('Y-m-d h:i:s')
                   ]);

    return redirect()->route('admin.inventory.create')->with('success','Category Add Successfully');

    }

    public function sku_add(Request $request){
        $this->validate($request, [

            'name' => 'required', 
     
         ]);


        DB::table('sku_code')
              ->insert([
                  'name' => $request->name , 
                  'created_by'=> auth()->user()->id,
                  'created_at' => date('Y-m-d h:i:s')
                   ]);

    return redirect()->route('admin.inventory.index')->with('success','SKU Code Add Successfully');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('inventory')) {
            return abort(401);
        }
        $product = DB::table('product')
                ->where('created_by',auth()->user()->id)
                ->where('id',$id)
                ->get()
                ->first();

                

        return view('admin.inventory.edit', compact('product'));
    }

    public function inventory_edit_submit(Request $request){
        $this->validate($request, [

            'name' => 'required', 
            'category' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'discription' => 'required',  
     
         ]);
         if($request->hasfile('image')) { 
            foreach($request->file('image') as $file)
            {
                $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $name = $fileName.'.'.$file->getClientOriginalExtension();
                $file->move(public_path('product_images'),$name);
                $image[]= $name;
                
            }
            $image_name =  implode(' , ',$image);
        }else{

            $product = DB::table('product')
            ->where('id',$request->inventory_id)
            ->get()
            ->first(); 
            
            $image_name = $product->images;
        }

        DB::table('product')
              ->where('id',$request->inventory_id)
              ->update([
                  'name' => $request->name , 
                  'category_id' => $request->category ,
                  'GST' => $request->gst , 
                  'acutal_price' => $request->price, 
                  'discount_price'=> $request->discount_price, 
                  'skucode'=> $request->sku_code,
                  'discription'=> $request->discription,
                  'images'=> $image_name,
                  'created_by'=> auth()->user()->id,
                  'created_at' => date('Y-m-d h:i:s')
                   ]);

        return redirect()->route('admin.inventory.index')->with('success','Product Add Successfully');



    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, User $user)
    {
        if (! Gate::allows('inventory')) {
            return abort(401);
        }

        $user->update($request->all());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        if (! Gate::allows('inventory')) {
            return abort(401);
        }

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (! Gate::allows('inventory')) {
            return abort(401);
        }

        $user->delete();

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('inventory')) {
            return abort(401);
        }
        User::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
