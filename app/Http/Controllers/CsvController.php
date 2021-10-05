<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PhpParser\Node\Expr\Print_;
use PhpParser\Node\Stmt\Echo_;
use Session;
class CsvController extends Controller
{
    //
    

        public function index(){
          return view('csv');
        }
      
        public function uploadFile(Request $request){
      
          if ($request->input('submit') != null ){
      
            $file = $request->file('file');
      
            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
      
            // Valid File Extensions
            $valid_extension = array("csv");
      
            // 2MB in Bytes
            $maxFileSize = 2097152; 
      
            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)){
      
              // Check file size
              if($fileSize <= $maxFileSize){
      
                // File upload location
                $location = 'uploads';
      
                // Upload file
                $file->move($location,$filename);
      
                // Import CSV to Database
                $filepath = public_path($location."/".$filename);
      
                // Reading file
                $file = fopen($filepath,"r");
      
                $importData_arr = array();
                $i = 0;
      
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                   $num = count($filedata );
                   
                   // Skip first row (Remove below comment if you want to skip the first row)
                   if($i == 0){
                      $i++;
                      continue; 
                   }
                   for ($c=0; $c < $num; $c++) {
                      $importData_arr[$i][] = $filedata [$c];
                   }
                   $i++;
                }
                fclose($file);

                // Insert to MySQL database
                foreach($importData_arr as $importData){

                  $get_category = DB::table('category')
                    ->where('name',$importData[0])
                    ->where('created_by',auth()->user()->id)
                    ->first();

                    if(empty($get_category)){
                      DB::table('category')
                       ->insert(array(
                        "name"=>$importData[0],
                        "created_by"=> auth()->user()->id,
                        "created_at"=>date('Y-m-d h:i:s')
                       ));

                       $category = DB::table('category')
                       ->orderBy('id', 'DESC')
                       ->first();
                       $category_id = $category->id; 

                    }else{
                      $category_id=  $get_category->id;
                    }

                    $get_sku = DB::table('sku_code')
                    ->where('name',$importData[4])
                    ->where('created_by',auth()->user()->id)
                    ->first();

                    if(empty($get_sku)){
                      DB::table('sku_code')
                       ->insert(array(
                        "name"=>$importData[4],
                        "created_by"=> auth()->user()->id,
                        "created_at"=>date('Y-m-d h:i:s')
                       ));

                       $sku = DB::table('sku_code')
                       ->orderBy('id', 'DESC')
                       ->first();
                       $sku_id = $sku->id; 

                    }else{
                      $sku_id=  $get_sku->id;
                    }

                    
                  $insertData = array(
                      "category_id"=>$category_id,
                     "company_id"=>Session::get('company_id'),
                     "name"=>$importData[1],
                     "discount_price"=>$importData[2],
                     "acutal_price"=>$importData[3],
                     "skucode"=>$sku_id,
                     "discription"=>$importData[5],
                     'exported' => "", 
                     "created_by"=>auth()->user()->id,
                     "created_at"=>date('Y-m-d h:i:s')
                    );
                  
                     DB::table('product')->insert($insertData);
                 
                }
      
                return redirect()->route('admin.inventory.index')->with('success','Import Successful');
              }else{
                return redirect()->route('admin.inventory.index')->with('error','File too large. File must be less than 2MB.');
              }
      
            }else{
               return redirect()->route('admin.inventory.index')->with('error','Invalid File Extension');
            }
      
          }
        }
      }
