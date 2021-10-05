<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Company;

use DB;
use Session;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use App\Http\Requests\CompanyRequest;


class CompanyController extends Controller
{

    
    

    public function company_register(CompanyRequest $request){


          $arr = [
           'comapny' => "registered", 
           'user_type' => $request->user_type,
           'comapny_type' => $request->company_type,
           'logo' => $this->setLogo($request),
           'strn_image' => $this->setSTRNImage($request),
           'ntn_image' => $this->setNTNImage($request),
           'cnic_front_image' => $this->setCNICFrontImage($request),  
           'cnic_back_image' => $this->setCNICBackImage($request), 
           'company_name' => $request->company_name, 
           'ntn'=> $request->ntn, 
           'cnic_number'=> $request->cnic_number,
           'ntn_number'=> $request->ntn_number,
           'registered_address'=> $request->registered_address,
           'delivery_address'=> $request->delivery_address,
           'landline_number' => $request->landline_number,
           'strn_number' => $request->strn_number ?? '',
           'user_id' => auth()->user()->id ?? $request->user_id,
           'created_at'=> date('Y-m-d h:i:s')
    
          ];
           
          try {
    
           $Company = Company::create($arr);
    
           Session::forget('company_id');
    
           Session::put('company_id', $Company->id);
           
           return redirect()->route('interest/add', $arr['user_id']);
    
          } catch (\Throwable $th) {
              
            $myfile = fopen("error-logs.txt", "a") or die("Unable to open file!");
            fwrite($myfile, "\n". $th->getMessage());
            fclose($myfile);

            return back();

          }
    }

    public function company_edit_submite(Request $request){

        $this->validate($request, [
           'company_type' => 'required',
           'company_name' => 'required',
           'cnic_number' => 'required',
           'ntn_number' => 'required',
           'registered_address' => 'required',
           'delivery_address' => 'required',
           'landline_number' => 'required',
        ]);

        

          $arr = [
            'comapny' => "registered", 
            'comapny_type' => $request->company_type, 
            'company_name' => $request->company_name, 
            'ntn'=> $request->ntn, 
            'cnic_number'=> $request->cnic_number,
            'ntn_number'=> $request->ntn_number,
            'registered_address'=> $request->registered_address,
            'delivery_address'=> $request->delivery_address,
            'landline_number' => $request->landline_number,
            'strn_number' => empty($request->strn_number) ? '' : $request->strn_number,
            'updated_at'=> date('Y-m-d h:i:s')
          ];

          if($request->hasfile('logo')) { 
           
               $file = $request->file('logo');
           
               $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
               $name = $fileName.'.'.$file->getClientOriginalExtension();
               $file->move(public_path('product_images'),$name);
               $arr['logo'] = $name;
            }

            try {
                //code...
                Company::whereId($request->company_id)->update($arr);
                return redirect('admin/home')->with('success', 'Company has been updated!');

            } catch (\Throwable $th) {
                //throw $th;

                    $myfile = fopen("error-logs.txt", "a") or die("Unable to open file!");
                    fwrite($myfile, "\n". $th->getMessage());
                    fclose($myfile);

                    return back();

                    // return  'Error can be found in where your application`s index.php';
            }
       

       
    }
    
    
    public function index()
    {
        if (! Gate::allows('company')) {
            return abort(401);
        }
        return view('admin.company.index');
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('comapny')) {
            return abort(401);
        }
        $roles = Role::where("name",'!=', "administrator")
        ->where("name", "Sub Admin")
        ->get()->pluck('name', 'name');

        return view('admin.inventory.create', compact('roles'));
    }

    public function store(Request $request)
    {
        
        if (! Gate::allows('comapny')) {
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
        } 

        $image_name =  implode(',',$image);

        DB::table('product')
              ->insert([
                  'name' => $request->name , 
                  'category_id' => $request->category , 
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

    public function category_add(Request $request){

        $this->validate($request, [

            'name' => 'required|unique:category', 
     
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

            'name' => 'required|unique:sku_code', 
     
         ]);


        DB::table('sku_code')
              ->insert([
                  'name' => $request->name , 
                  'created_by'=> auth()->user()->id,
                  'created_at' => date('Y-m-d h:i:s')
                   ]);

    return redirect()->back()->with('success','SKU Code Add Successfully');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('comapny')) {
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
                  'acutal_price' => $request->price, 
                  'discount_price'=> $request->discount_price, 
                  'skucode'=> $request->sku_code,
                  'discription'=> $request->discription,
                  'images'=> $image_name,
                  'created_by'=> auth()->user()->id,
                  'created_at' => date('Y-m-d h:i:s')
                   ]);

        return redirect()->url()->previous()->with('success','Product Add Successfully');



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

    public function company($id){

        $role_id = DB::table('model_has_roles')
        ->where('model_id',$id)
        ->first();



          return view('auth.company_register',compact('id','role_id'));
    }

    public function setLogo($request)
    {
        $image_name = null;

        if($request->hasfile('logo')) { 
            $file = $request->file('logo');           
            $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $image_name = $fileName.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('product_images'),$image_name);
         }
        
         return $image_name;
    } 


    public function setCNICFrontImage($request)
    {
        $image_name = null;

        if($request->hasfile('cnic_front_image')) { 
            $file = $request->file('cnic_front_image');           
            $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $image_name = $fileName.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('cnic_images'),$image_name);
         }
        
         return $image_name;
    } 

    public function setCNICBackImage($request)
    {
        $image_name = null;

        if($request->hasfile('cnic_back_image')) { 
            $file = $request->file('cnic_back_image');           
            $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $image_name = $fileName.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('cnic_images'),$image_name);
         }
        
         return $image_name;
    } 

    public function setSTRNImage($request)
    {
        $image_name = null;

        if($request->hasfile('strn_image')) { 
            $file = $request->file('strn_image');           
            $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $image_name = $fileName.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('cnic_images'),$image_name);
         }
        
         return $image_name;
    } 

    public function setNTNImage($request)
    {
        $image_name = null;

        if($request->hasfile('ntn_image')) { 
            $file = $request->file('ntn_image');           
            $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $image_name = $fileName.'.'.$file->getClientOriginalExtension();
            $file->move(public_path('cnic_images'),$image_name);
         }
        
         return $image_name;
    } 
        
}
