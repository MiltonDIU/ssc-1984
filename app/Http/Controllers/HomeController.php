<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\District;
use App\Models\School;
use App\Models\SchoolsTow;
use App\Models\Upazila;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function readCsbForm()
    {
        return view('csb-form');
    }

   public function readCsb(Request $request)
   {

       $file = $request->file('csb');
       $filename = $file->getClientOriginalName();
       $path = 'upload/results';
       $file->move($path, $filename);
       $file = $path.'/'.$filename;
       $customerArr = $this->csvToArray($file);
      //dd($customerArr['valid'][14614]);

       for ($i = 0; $i < count($customerArr['valid']); $i++) {
           School::create($customerArr['valid'][$i]);
       }
       for ($i = 0; $i < count($customerArr['invalid']); $i++) {
           SchoolsTow::create($customerArr['invalid'][$i]);
       }
       return view('csb-form')->with('message','Schools file has been  successfully Uploaded!');
   }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;
        $header = null;
        $data = array();
        $valid = array();
        $invalid = array();
        $primary = array();

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 20000, $delimiter)) !== false) {

                if (!$header)
                    $header = $row;
                else{
//                    if ( strstr( $row[7], 'PRIMARY' ) ) {
//                        $primary[] = array_combine($header, $row);
//                    } else {

                    $district = District:: where('name', 'LIKE', '%'.$row[0].'%')->first();
                    if ($district){
                        $upazila = Upazila:: where('name', 'LIKE', '%'.$row[1].'%')->where('district_id',$district->id)->first();
                        if ($upazila) {
                            $find = School::where('name', $row[3])->first();
                            if ($find == null){
                                $schools = [
                                    'division_id'=> $district->division->id,
                                    'district_id'=> $district->id,
                                    'upazila_id'=> $upazila->id,
                                    'eiin'=> $row[2],
                                    'name'=> $row[3],
                                    'slug'=> Str::slug($row[3]),
                                    'address'=> $row[4],
                                    'post_office'=> $row[5],
                                    'mobile'=> $row[6],
                                    'management'=> $row[7],
                                    'mpo'=> $row[8],
                                ];
                                array_push($valid,$schools);
                            }
                        }else{
                            $find = SchoolsTow::where('name',$row[3])->first();
                            if ($find == null){
                                $schools = [
                                    'division_id'=> $district->division->id,
                                    'district'=> $district->id,
                                    'upazila'=> $row[1],
                                    'eiin'=> $row[2],
                                    'name'=> $row[3],
                                    'slug'=> Str::slug($row[3]),
                                    'address'=> $row[4],
                                    'post_office'=> $row[5],
                                    'mobile'=> $row[6],
                                    'management'=> $row[7],
                                    'mpo'=> $row[8],
                                ];
                                array_push($invalid,$schools);
                            }
                        }
                    }else{
                        $find = SchoolsTow::where('name',$row[3])->first();
                        if ($find == null){
                            $schools = [
                                'district'=> $row[0],
                                'upazila'=> $row[1],
                                'eiin'=> $row[2],
                                'name'=> $row[3],
                                'slug'=> Str::slug($row[3]),
                                'address'=> $row[4],
                                'post_office'=> $row[5],
                                'mobile'=> $row[6],
                                'management'=> $row[7],
                                'mpo'=> $row[8],
                            ];
                            array_push($invalid,$schools);
                        }
                    }

//                    }

                }
            }
            fclose($handle);
        }
        $data['valid']=$valid;
        $data['invalid']=$invalid;
        $data['primary']=$primary;
        return $data;
    }





//    function csvToArray($filename = '', $delimiter = ',')
//    {
//        if (!file_exists($filename) || !is_readable($filename))
//            return false;
//        $header = null;
//        $data = array();
//        $data2 = array();
//        $result = array();
//        $name="";
//        $i=0;
//        if (($handle = fopen($filename, 'r')) !== false) {
//            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
//                if (!$header)
//                    $header = $row;
//                else{
//                    $upazila = Upazila:: where('name', 'LIKE', '%'.$row[1].'%')->first();
////                    $district = District:: where('name', 'LIKE', '%'.$row[0].'%')->first();
//
//
//                    if ($upazila != null){
//                        $data[] = array_combine($header, $row);
//                    }else{
//                        $data2[] = array_combine($header, $row);
//                    }
//
//                }
//            }
//            fclose($handle);
//        }
//
////
////        foreach ($data2 as $element) {
////            $result[$element['DISTRICT']][] = $element;
////        }
////        echo $i;
////dd($result);
//       // return $data;
//    }


}
