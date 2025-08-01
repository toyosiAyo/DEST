<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Country;
use App\Models\State;
use App\Models\Lga;
use App\Models\Setting;
use App\Models\PartTimeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Mail\MailingApplicant;
use App\Mail\MailingAdmin;
use Mail;
use Carbon\Carbon;



class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('authcheck');
       // $this->middleware('log')->only('index');
       // $this->middleware('subscribed')->except('store');
       //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
    }
  


    public function applicant_mail($applicant,$Subject,$Msg){
        $data = [
            'to' => [$applicant->email],
            'docs'=> [ ],
            'name' => $applicant->surname ." ". $applicant->firstname,
            'sub' => $Subject,
            'message' => $Msg,
            'app_type'=>'otp'
             ];
        Mail::to($data['to'])->send(new MailingApplicant($data));
        if (Mail::failures()) {return ['status'=>'nok'];
        }else{  return ['status'=>'ok']; }
    }
    
    
     public function applicant_mail_attachment_foundation($get_app,$Subject,$Msg){
        $data = [
            'to' => [$get_app->email],
            'docs'=> [ 
                ['path'=> public_path('FOUNDATION_ACCEPTANCE_FORM.pdf'), 'as' => "FOUNDATION_ACCEPTANCE_FORM.pdf",'mime' => 'application/pdf'], 
                ['path'=> public_path('2024_2025_FOUNDATION_FEE_FOR_NON_SCIENCE.pdf'), 'as' => "FOUNDATION_FEES.pdf",'mime' => 'application/pdf'], 
                ['path'=> public_path('2024_2025_FOUNDATION_FEE_FOR_SCIENCE.pdf'), 'as' => "FOUNDATION_FEES(SCIENCE).pdf",'mime' => 'application/pdf'], 
            ],
            'name' => $get_app->surname ." ". $get_app->firstname,
            'sub' => $Subject,
            'message' => $Msg,
            'dataset'=>$get_app,
            'app_type'=>$get_app->app_type
             ];
        Mail::to($data['to'])->send(new MailingApplicant($data));
        if (Mail::failures()) {return ['status'=>'nok'];
        }else{  return ['status'=>'ok']; }
    }

     public function applicant_mail_attachment_pt($get_app,$Subject,$Msg){
        $data = [
            'to' => [$get_app->email],
            'docs'=> [ 
                ['path'=> public_path('PART_TIME_ACCEPTANCE_FORM.pdf'), 'as' => "CONVERSION_ACCEPTANCE_FORM.pdf",'mime' => 'application/pdf'], 
                ['path'=> public_path('2022_2023_PROPOSED_CONVERSION_PROGRAMME.pdf'), 'as' => "CONVERSION_FEE_SCHEDULE_FEES.pdf",'mime' => 'application/pdf'], 
            ],
            'name' => $get_app->surname ." ". $get_app->firstname,
            'sub' => $Subject,
            'message' => $Msg,
            'dataset'=>$get_app,
            'app_type'=>$get_app->app_type
             ];
        Mail::to($data['to'])->send(new MailingApplicant($data));
        if (Mail::failures()) {return ['status'=>'nok'];
        }else{  return ['status'=>'ok']; }
    }
    

    public function admin_mail($admin,$Subject,$Msg){
        $data = [
            'to' => $admin->emails,
            'docs'=> [ ],
            'name' => '',
            'sub' => $Subject,
            'message' => $Msg
             ];
        Mail::to($data['to'])->send(new MailingAdmin($data));
        if (Mail::failures()) {return ['status'=>'nok'];
        }else{  return ['status'=>'ok']; }
    }
    


    public function college_dept_prog(Request $request){
        try {
            //return $request->params;
            $faculties=[];
            $dept=[];
            $prog=[];
            $combination=[];
            if($request->has('faculty') && !empty($request->input('faculty'))) {
                //Getting all departments for this faculty
                $dept = DB::table('departments')->select('department_id','department')
                ->where('college_id_FK',$request->faculty)->get();
                
            } 
            if($request->has('department') && !empty($request->input('department'))) {
                //Getting all programmes for this department
                $prog = DB::table('programmes')->select('programme_id','programme')
                ->where('department_id_FK',$request->department)->get();
                
            } 
            if($request->has('programme') && !empty($request->input('programme'))) {
                //Getting subject combination for this programme
                $combination = DB::table('subject_combination')->select('id','subjects')
                ->where('programme_id',$request->programme)->get();
                
            } 

           $faculties = DB::table('faculty')->select('college_id','college')->get();
           return ['faculties'=>$faculties,'dept'=>$dept,'prog'=>$prog,'combinations'=>$combination];
         //return response()->json(['status'=>'ok','msg'=>'success','faculties'=>$faculties,'dept'=>$dept,'prog'=>$prog,'combinations'=>$combination], 200);
        } catch (\Throwable $th) {
        return response()->json(['status'=>'Nok','msg'=>'Error from catch... college_dept_prog()','rsp'=>''], 401);

        }
    }
    

    public function get_faculty_name_given_id($facultyId){
        try {
            return DB::table('faculty')->where('college_id',$facultyId)->pluck('college')[0];
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','msg'=>'Failed, in get_faculty_name_given_id() catch '], 401);
        }
    }
    public function get_dept_name_given_id($deptId){
        try {
            return DB::table('departments')->where('department_id',$deptId)->pluck('department')[0];
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','msg'=>'Failed, in get_dept_name_given_id() catch '], 401);
        }
    }
    public function get_prog_name_given_id($progId){
        try {
            return DB::table('programmes')->where('programme_id',$progId)->pluck('programme')[0];
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','msg'=>'Failed, in get_prog_name_given_id() catch '], 401);
        }
    }

    public  function settings($request){
        if ($request->has('settingId') && $request->filled('settingId') ){
            $settings = Setting::where('id', $request->settingId)->first();
            return $settings;
        }
        $settings = Setting::where('status', 'active')->first();
        return $settings;
    }
    
    public  function part_time_settings($request){
        if ($request->has('settingId') && $request->filled('settingId') ){
            $settings = PartTimeSetting::where('id', $request->settingId)->first();
            return $settings;
        }
        $settings = PartTimeSetting::where('status', 'active')->first();
        return $settings;
    }

//ALTER TABLE `state` MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
// ALTER TABLE tableName MODIFY COLUMN id INT; /* First you should drop auto increment */
// ALTER TABLE tableName DROP PRIMARY KEY; /* Dop primary key */
// ALTER TABLE tableName ADD PRIMARY KEY (new_id); /* Set primary key to the new column */
// ALTER TABLE tableName MODIFY COLUMN new_id INT AUTO_INCREMENT; /*
public function auth_user($email){
 try {
    $data =  DB::table('applicants')->select('id','email',
    'surname','first_name','other_name','matric_number','status','level',
    'phone','gender','dob','religion',
    'marital_status','disability',
    'address_resident','city_resident','state_resident',
    'country_resident','state_origin','lga_origin',
    'country_origin','sponsor_name','sponsor_relationship',
    'sponsor_email','sponsor_phone','nok_name',
    'nok_relationship','nok_email','nok_phone',
    'nok_address','profile_pix','deleted_active')->where('email',$email)->first();
    return $data;
 } catch (\Throwable $th) {
    return response()->json(['status'=>'Nok','msg'=>'Error from catch... auth_user()','rsp'=>''], 401);

 }
}

public function adminUser($email){
    try {
        $data =  DB::table('admin')->select('*')->where('email',$email)->first();
        return $data;
    }
    catch (\Throwable $th) {
        return response()->json(['status'=>'Nok','msg'=>'Error from catch... adminUser()','rsp'=>''], 401);
    }
}

public function get_lga_state_country(Request $request){
        
    try {
        $country = $this->get_country();
        $states = $this->get_state();
        $lga = $this->get_lga();
        return response()->json(['status'=>'ok','msg'=>'success','country'=>$country,'states'=>$states,'lga'=>$lga],200); 
    } catch (\Throwable $th) {
        return response()->json(['status'=>'Nok','msg'=>'Error from catch... get_lga_state_country()','rsp'=>''], 401);

    }
   
}

    public function get_country(){
        $country = Country::select('id','name')->get();
        return $country;
    }
    public function get_state(){
        $states = State::select('id','name')->get();
        return $states;
    }
    public function get_lga(){
        $lga = Lga::select('id','name')->get();
        return $lga;
    }

    public function get_state_given_country(Request $request){
        
        dd($request->all());
        try {
            $states = '';
            if($request->has('countryId') && !empty($request->input('countryId'))) {
                $states = State::where('country_id', $request->countryId)->select('id','name')->get();
                
            }  $states = $this->get_state();
            return response()->json(['status'=>'ok','msg'=>'success','states'=>$states],200); 
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','msg'=>'Error from catch... get_state_given_country()','rsp'=>''], 401);

        }
       
    }

    public function get_lga_given_state(Request $request){
        
        try {
            if($request->has('state_origin') && !empty($request->input('state_origin'))) {
                $lgas = Lga::where('state_id', $request->state_origin)->select('id','name')->get();
                return $lgas;
            } 
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','msg'=>'Error from catch... get_lga_given_state()','rsp'=>''], 401);

        }
       
    }
    


    
    public function user_profile(Request $request){
        
        try {
         $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
         return view('pages.profile')->with('data', $data);
        } catch (\Throwable $th) {
         return back()->with('user_profile','user_profile');
        }
     
 }

 public function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

 public function email_msg($code){
    return 'Kindly use the OTP : '. $code. ' to activate your account    ';
 }


 public function email_msg_to_notify_teller_logging($email,$teller){
    return '<center> 
            <p>Email : '. $email. '</p>
            <p>Teller Number : '. $teller. '</p>
            </center> ';
 }

    public function load_data(){

         $state_list = array(  "Abia",
         "Adamawa",
         "Akwa Ibom",
         "Anambra",
         "Bauchi",
         "Bayelsa",
         "Benue",
         "Borno",
         "Cross River",
         "Delta",
         "Ebonyi",
         "Edo",
         "Ekiti",
         "Enugu",
         "FCT - Abuja",
         "Gombe",
         "Imo",
         "Jigawa",
         "Kaduna",
         "Kano",
         "Katsina",
         "Kebbi",
         "Kogi",
         "Kwara",
         "Lagos",
         "Nasarawa",
         "Niger",
         "Ogun",
         "Ondo",
         "Osun",
         "Oyo",
         "Plateau",
         "Rivers",
         "Sokoto",
         "Taraba",
         "Yobe",
         "Zamfara");
        $country_list = array(
            "Afghanistan",
            "Albania",
            "Algeria",
            "Andorra",
            "Angola",
            "Antigua and Barbuda",
            "Argentina",
            "Armenia",
            "Australia",
            "Austria",
            "Azerbaijan",
            "Bahamas",
            "Bahrain",
            "Bangladesh",
            "Barbados",
            "Belarus",
            "Belgium",
            "Belize",
            "Benin",
            "Bhutan",
            "Bolivia",
            "Bosnia and Herzegovina",
            "Botswana",
            "Brazil",
            "Brunei",
            "Bulgaria",
            "Burkina Faso",
            "Burundi",
            "Cambodia",
            "Cameroon",
            "Canada",
            "Cape Verde",
            "Central African Republic",
            "Chad",
            "Chile",
            "China",
            "Colombi",
            "Comoros",
            "Congo (Brazzaville)",
            "Congo",
            "Costa Rica",
            "Cote d'Ivoire",
            "Croatia",
            "Cuba",
            "Cyprus",
            "Czech Republic",
            "Denmark",
            "Djibouti",
            "Dominica",
            "Dominican Republic",
            "East Timor (Timor Timur)",
            "Ecuador",
            "Egypt",
            "El Salvador",
            "Equatorial Guinea",
            "Eritrea",
            "Estonia",
            "Ethiopia",
            "Fiji",
            "Finland",
            "France",
            "Gabon",
            "Gambia, The",
            "Georgia",
            "Germany",
            "Ghana",
            "Greece",
            "Grenada",
            "Guatemala",
            "Guinea",
            "Guinea-Bissau",
            "Guyana",
            "Haiti",
            "Honduras",
            "Hungary",
            "Iceland",
            "India",
            "Indonesia",
            "Iran",
            "Iraq",
            "Ireland",
            "Israel",
            "Italy",
            "Jamaica",
            "Japan",
            "Jordan",
            "Kazakhstan",
            "Kenya",
            "Kiribati",
            "Korea, North",
            "Korea, South",
            "Kuwait",
            "Kyrgyzstan",
            "Laos",
            "Latvia",
            "Lebanon",
            "Lesotho",
            "Liberia",
            "Libya",
            "Liechtenstein",
            "Lithuania",
            "Luxembourg",
            "Macedonia",
            "Madagascar",
            "Malawi",
            "Malaysia",
            "Maldives",
            "Mali",
            "Malta",
            "Marshall Islands",
            "Mauritania",
            "Mauritius",
            "Mexico",
            "Micronesia",
            "Moldova",
            "Monaco",
            "Mongolia",
            "Morocco",
            "Mozambique",
            "Myanmar",
            "Namibia",
            "Nauru",
            "Nepal",
            "Netherlands",
            "New Zealand",
            "Nicaragua",
            "Niger",
            "Nigeria",
            "Norway",
            "Oman",
            "Pakistan",
            "Palau",
            "Panama",
            "Papua New Guinea",
            "Paraguay",
            "Peru",
            "Philippines",
            "Poland",
            "Portugal",
            "Qatar",
            "Romania",
            "Russia",
            "Rwanda",
            "Saint Kitts and Nevis",
            "Saint Lucia",
            "Saint Vincent",
            "Samoa",
            "San Marino",
            "Sao Tome and Principe",
            "Saudi Arabia",
            "Senegal",
            "Serbia and Montenegro",
            "Seychelles",
            "Sierra Leone",
            "Singapore",
            "Slovakia",
            "Slovenia",
            "Solomon Islands",
            "Somalia",
            "South Africa",
            "Spain",
            "Sri Lanka",
            "Sudan",
            "Suriname",
            "Swaziland",
            "Sweden",
            "Switzerland",
            "Syria",
            "Taiwan",
            "Tajikistan",
            "Tanzania",
            "Thailand",
            "Togo",
            "Tonga",
            "Trinidad and Tobago",
            "Tunisia",
            "Turkey",
            "Turkmenistan",
            "Tuvalu",
            "Uganda",
            "Ukraine",
            "United Arab Emirates",
            "United Kingdom",
            "United States",
            "Uruguay",
            "Uzbekistan",
            "Vanuatu",
            "Vatican City",
            "Venezuela",
            "Vietnam",
            "Yemen",
            "Zambia",
            "Zimbabwe"
        );

        // [
        //     {
        //         "state": "Abia",
        //         "lgas": [
        //             "Aba North",
        //             "Aba South",
        //             "Arochukwu",
        //             "Bende",
        //             "Ikawuno",
        //             "Ikwuano",
        //             "Isiala-Ngwa North",
        //             "Isiala-Ngwa South",
        //             "Isuikwuato",
        //             "Umu Nneochi",
        //             "Obi Ngwa",
        //             "Obioma Ngwa",
        //             "Ohafia",
        //             "Ohaozara",
        //             "Osisioma",
        //             "Ugwunagbo",
        //             "Ukwa West",
        //             "Ukwa East",
        //             "Umuahia North",
        //             "Umuahia South"
        //         ]
        //     },
        //     {
        //         "state": "Adamawa",
        //         "lgas": [
        //             "Demsa",
        //             "Fufore",
        //             "Ganye",
        //             "Girei",
        //             "Gombi",
        //             "Guyuk",
        //             "Hong",
        //             "Jada",
        //             "Lamurde",
        //             "Madagali",
        //             "Maiha",
        //             "Mayo-Belwa",
        //             "Michika",
        //             "Mubi-North",
        //             "Mubi-South",
        //             "Numan",
        //             "Shelleng",
        //             "Song",
        //             "Toungo",
        //             "Yola North",
        //             "Yola South"
        //         ]
        //     },
        //     {
        //         "state": "Akwa Ibom",
        //         "lgas": [
        //             "Abak",
        //             "Eastern-Obolo",
        //             "Eket",
        //             "Esit-Eket",
        //             "Essien-Udim",
        //             "Etim-Ekpo",
        //             "Etinan",
        //             "Ibeno",
        //             "Ibesikpo-Asutan",
        //             "Ibiono-Ibom",
        //             "Ika",
        //             "Ikono",
        //             "Ikot-Abasi",
        //             "Ikot-Ekpene",
        //             "Ini",
        //             "Itu",
        //             "Mbo",
        //             "Mkpat-Enin",
        //             "Nsit-Atai",
        //             "Nsit-Ibom",
        //             "Nsit-Ubium",
        //             "Obot-Akara",
        //             "Okobo",
        //             "Onna",
        //             "Oron",
        //             "Oruk Anam",
        //             "Udung-Uko",
        //             "Ukanafun",
        //             "Urue-Offong/Oruko",
        //             "Uruan",
        //             "Uyo"
        //         ]
        //     },
        //     {
        //         "state": "Anambra",
        //         "lgas": [
        //             "Aguata",
        //             "Anambra East",
        //             "Anambra West",
        //             "Anaocha",
        //             "Awka North",
        //             "Awka South",
        //             "Ayamelum",
        //             "Dunukofia",
        //             "Ekwusigo",
        //             "Idemili-North",
        //             "Idemili-South",
        //             "Ihiala",
        //             "Njikoka",
        //             "Nnewi-North",
        //             "Nnewi-South",
        //             "Ogbaru",
        //             "Onitsha-North",
        //             "Onitsha-South",
        //             "Orumba-North",
        //             "Orumba-South"
        //         ]
        //     },
        //     {
        //         "state": "Bauchi",
        //         "lgas": [
        //             "Alkaleri",
        //             "Bauchi",
        //             "Bogoro",
        //             "Damban",
        //             "Darazo",
        //             "Dass",
        //             "Gamawa",
        //             "Ganjuwa",
        //             "Giade",
        //             "Itas\/Gadau",
        //             "Jama'Are",
        //             "Katagum",
        //             "Kirfi",
        //             "Misau",
        //             "Ningi",
        //             "Shira",
        //             "Tafawa-Balewa",
        //             "Toro",
        //             "Warji",
        //             "Zaki"
        //         ]
        //     },
        //     {
        //         "state": "Benue",
        //         "lgas": [
        //             "Ado",
        //             "Agatu",
        //             "Apa",
        //             "Buruku",
        //             "Gboko",
        //             "Guma",
        //             "Gwer-East",
        //             "Gwer-West",
        //             "Katsina-Ala",
        //             "Konshisha",
        //             "Kwande",
        //             "Logo",
        //             "Makurdi",
        //             "Ogbadibo",
        //             "Ohimini",
        //             "Oju",
        //             "Okpokwu",
        //             "Otukpo",
        //             "Tarka",
        //             "Ukum",
        //             "Ushongo",
        //             "Vandeikya"
        //         ]
        //     },
        //     {
        //         "state": "Borno",
        //         "lgas": [
        //             "Abadam",
        //             "Askira-Uba",
        //             "Bama",
        //             "Bayo",
        //             "Biu",
        //             "Chibok",
        //             "Damboa",
        //             "Dikwa",
        //             "Gubio",
        //             "Guzamala",
        //             "Gwoza",
        //             "Hawul",
        //             "Jere",
        //             "Kaga",
        //             "Kala\/Balge",
        //             "Konduga",
        //             "Kukawa",
        //             "Kwaya-Kusar",
        //             "Mafa",
        //             "Magumeri",
        //             "Maiduguri",
        //             "Marte",
        //             "Mobbar",
        //             "Monguno",
        //             "Ngala",
        //             "Nganzai",
        //             "Shani"
        //         ]
        //     },
        //     {
        //         "state": "Bayelsa",
        //         "lgas": [
        //             "Brass",
        //             "Ekeremor",
        //             "Kolokuma\/Opokuma",
        //             "Nembe",
        //             "Ogbia",
        //             "Sagbama",
        //             "Southern-Ijaw",
        //             "Yenagoa"
        //         ]
        //     },
        //     {
        //         "state": "Cross River",
        //         "lgas": [
        //             "Abi",
        //             "Akamkpa",
        //             "Akpabuyo",
        //             "Bakassi",
        //             "Bekwarra",
        //             "Biase",
        //             "Boki",
        //             "Calabar-Municipal",
        //             "Calabar-South",
        //             "Etung",
        //             "Ikom",
        //             "Obanliku",
        //             "Obubra",
        //             "Obudu",
        //             "Odukpani",
        //             "Ogoja",
        //             "Yakurr",
        //             "Yala"
        //         ]
        //     },
        //     {
        //         "state": "Delta",
        //         "lgas": [
        //             "Aniocha North",
        //             "Aniocha-North",
        //             "Aniocha-South",
        //             "Bomadi",
        //             "Burutu",
        //             "Ethiope-East",
        //             "Ethiope-West",
        //             "Ika-North-East",
        //             "Ika-South",
        //             "Isoko-North",
        //             "Isoko-South",
        //             "Ndokwa-East",
        //             "Ndokwa-West",
        //             "Okpe",
        //             "Oshimili-North",
        //             "Oshimili-South",
        //             "Patani",
        //             "Sapele",
        //             "Udu",
        //             "Ughelli-North",
        //             "Ughelli-South",
        //             "Ukwuani",
        //             "Uvwie",
        //             "Warri South-West",
        //             "Warri North",
        //             "Warri South"
        //         ]
        //     },
        //     {
        //         "state": "Ebonyi",
        //         "lgas": [
        //             "Abakaliki",
        //             "Afikpo-North",
        //             "Afikpo South (Edda)",
        //             "Ebonyi",
        //             "Ezza-North",
        //             "Ezza-South",
        //             "Ikwo",
        //             "Ishielu",
        //             "Ivo",
        //             "Izzi",
        //             "Ohaukwu",
        //             "Onicha"
        //         ]
        //     },
        //     {
        //         "state": "Edo",
        //         "lgas": [
        //             "Akoko Edo",
        //             "Egor",
        //             "Esan-Central",
        //             "Esan-North-East",
        //             "Esan-South-East",
        //             "Esan-West",
        //             "Etsako-Central",
        //             "Etsako-East",
        //             "Etsako-West",
        //             "Igueben",
        //             "Ikpoba-Okha",
        //             "Oredo",
        //             "Orhionmwon",
        //             "Ovia-North-East",
        //             "Ovia-South-West",
        //             "Owan East",
        //             "Owan-West",
        //             "Uhunmwonde"
        //         ]
        //     },
        //     {
        //         "state": "Ekiti",
        //         "lgas": [
        //             "Ado-Ekiti",
        //             "Efon",
        //             "Ekiti-East",
        //             "Ekiti-South-West",
        //             "Ekiti-West",
        //             "Emure",
        //             "Gbonyin",
        //             "Ido-Osi",
        //             "Ijero",
        //             "Ikere",
        //             "Ikole",
        //             "Ilejemeje",
        //             "Irepodun\/Ifelodun",
        //             "Ise-Orun",
        //             "Moba",
        //             "Oye"
        //         ]
        //     },
        //     {
        //         "state": "Enugu",
        //         "lgas": [
        //             "Aninri",
        //             "Awgu",
        //             "Enugu-East",
        //             "Enugu-North",
        //             "Enugu-South",
        //             "Ezeagu",
        //             "Igbo-Etiti",
        //             "Igbo-Eze-North",
        //             "Igbo-Eze-South",
        //             "Isi-Uzo",
        //             "Nkanu-East",
        //             "Nkanu-West",
        //             "Nsukka",
        //             "Oji-River",
        //             "Udenu",
        //             "Udi",
        //             "Uzo-Uwani"
        //         ]
        //     },
        //     {
        //         "state": "Federal Capital Territory",
        //         "lgas": [
        //             "Abuja",
        //             "Kwali",
        //             "Kuje",
        //             "Gwagwalada",
        //             "Bwari",
        //             "Abaji"
        //         ]
        //     },
        //     {
        //         "state": "Gombe",
        //         "lgas": [
        //             "Akko",
        //             "Balanga",
        //             "Billiri",
        //             "Dukku",
        //             "Funakaye",
        //             "Gombe",
        //             "Kaltungo",
        //             "Kwami",
        //             "Nafada",
        //             "Shongom",
        //             "Yamaltu\/Deba"
        //         ]
        //     },
        //     {
        //         "state": "Imo",
        //         "lgas": [
        //             "Aboh-Mbaise",
        //             "Ahiazu-Mbaise",
        //             "Ehime-Mbano",
        //             "Ezinihitte",
        //             "Ideato-North",
        //             "Ideato-South",
        //             "Ihitte\/Uboma",
        //             "Ikeduru",
        //             "Isiala-Mbano",
        //             "Isu",
        //             "Mbaitoli",
        //             "Ngor-Okpala",
        //             "Njaba",
        //             "Nkwerre",
        //             "Nwangele",
        //             "Obowo",
        //             "Oguta",
        //             "Ohaji-Egbema",
        //             "Okigwe",
        //             "Onuimo",
        //             "Orlu",
        //             "Orsu",
        //             "Oru-East",
        //             "Oru-West",
        //             "Owerri-Municipal",
        //             "Owerri-North",
        //             "Owerri-West"
        //         ]
        //     },
        //     {
        //         "state": "Jigawa",
        //         "lgas": [
        //             "Auyo",
        //             "Babura",
        //             "Biriniwa",
        //             "Birnin-Kudu",
        //             "Buji",
        //             "Dutse",
        //             "Gagarawa",
        //             "Garki",
        //             "Gumel",
        //             "Guri",
        //             "Gwaram",
        //             "Gwiwa",
        //             "Hadejia",
        //             "Jahun",
        //             "Kafin-Hausa",
        //             "Kaugama",
        //             "Kazaure",
        //             "Kiri kasama",
        //             "Maigatari",
        //             "Malam Madori",
        //             "Miga",
        //             "Ringim",
        //             "Roni",
        //             "Sule-Tankarkar",
        //             "Taura",
        //             "Yankwashi"
        //         ]
        //     },
        //     {
        //         "state": "Kebbi",
        //         "lgas": [
        //             "Aleiro",
        //             "Arewa-Dandi",
        //             "Argungu",
        //             "Augie",
        //             "Bagudo",
        //             "Birnin-Kebbi",
        //             "Bunza",
        //             "Dandi",
        //             "Fakai",
        //             "Gwandu",
        //             "Jega",
        //             "Kalgo",
        //             "Koko-Besse",
        //             "Maiyama",
        //             "Ngaski",
        //             "Sakaba",
        //             "Shanga",
        //             "Suru",
        //             "Wasagu/Danko",
        //             "Yauri",
        //             "Zuru"
        //         ]
        //     },
        //     {
        //         "state": "Kaduna",
        //         "lgas": [
        //             "Birnin-Gwari",
        //             "Chikun",
        //             "Giwa",
        //             "Igabi",
        //             "Ikara",
        //             "Jaba",
        //             "Jema'A",
        //             "Kachia",
        //             "Kaduna-North",
        //             "Kaduna-South",
        //             "Kagarko",
        //             "Kajuru",
        //             "Kaura",
        //             "Kauru",
        //             "Kubau",
        //             "Kudan",
        //             "Lere",
        //             "Makarfi",
        //             "Sabon-Gari",
        //             "Sanga",
        //             "Soba",
        //             "Zangon-Kataf",
        //             "Zaria"
        //         ]
        //     },
        //     {
        //         "state": "Kano",
        //         "lgas": [
        //             "Ajingi",
        //             "Albasu",
        //             "Bagwai",
        //             "Bebeji",
        //             "Bichi",
        //             "Bunkure",
        //             "Dala",
        //             "Dambatta",
        //             "Dawakin-Kudu",
        //             "Dawakin-Tofa",
        //             "Doguwa",
        //             "Fagge",
        //             "Gabasawa",
        //             "Garko",
        //             "Garun-Mallam",
        //             "Gaya",
        //             "Gezawa",
        //             "Gwale",
        //             "Gwarzo",
        //             "Kabo",
        //             "Kano-Municipal",
        //             "Karaye",
        //             "Kibiya",
        //             "Kiru",
        //             "Kumbotso",
        //             "Kunchi",
        //             "Kura",
        //             "Madobi",
        //             "Makoda",
        //             "Minjibir",
        //             "Nasarawa",
        //             "Rano",
        //             "Rimin-Gado",
        //             "Rogo",
        //             "Shanono",
        //             "Sumaila",
        //             "Takai",
        //             "Tarauni",
        //             "Tofa",
        //             "Tsanyawa",
        //             "Tudun-Wada",
        //             "Ungogo",
        //             "Warawa",
        //             "Wudil"
        //         ]
        //     },
        //     {
        //         "state": "Kogi",
        //         "lgas": [
        //             "Adavi",
        //             "Ajaokuta",
        //             "Ankpa",
        //             "Dekina",
        //             "Ibaji",
        //             "Idah",
        //             "Igalamela-Odolu",
        //             "Ijumu",
        //             "Kabba\/Bunu",
        //             "Kogi",
        //             "Lokoja",
        //             "Mopa-Muro",
        //             "Ofu",
        //             "Ogori\/Magongo",
        //             "Okehi",
        //             "Okene",
        //             "Olamaboro",
        //             "Omala",
        //             "Oyi",
        //             "Yagba-East",
        //             "Yagba-West"
        //         ]
        //     },
        //     {
        //         "state": "Katsina",
        //         "lgas": [
        //             "Bakori",
        //             "Batagarawa",
        //             "Batsari",
        //             "Baure",
        //             "Bindawa",
        //             "Charanchi",
        //             "Dan-Musa",
        //             "Dandume",
        //             "Danja",
        //             "Daura",
        //             "Dutsi",
        //             "Dutsin-Ma",
        //             "Faskari",
        //             "Funtua",
        //             "Ingawa",
        //             "Jibia",
        //             "Kafur",
        //             "Kaita",
        //             "Kankara",
        //             "Kankia",
        //             "Katsina",
        //             "Kurfi",
        //             "Kusada",
        //             "Mai-Adua",
        //             "Malumfashi",
        //             "Mani",
        //             "Mashi",
        //             "Matazu",
        //             "Musawa",
        //             "Rimi",
        //             "Sabuwa",
        //             "Safana",
        //             "Sandamu",
        //             "Zango"
        //         ]
        //     },
        //     {
        //         "state": "Kwara",
        //         "lgas": [
        //             "Asa",
        //             "Baruten",
        //             "Edu",
        //             "Ekiti (Araromi/Opin)",
        //             "Ilorin-East",
        //             "Ilorin-South",
        //             "Ilorin-West",
        //             "Isin",
        //             "Kaiama",
        //             "Moro",
        //             "Offa",
        //             "Oke-Ero",
        //             "Oyun",
        //             "Pategi"
        //         ]
        //     },
        //     {
        //         "state": "Lagos",
        //         "lgas": [
        //             "Agege",
        //             "Ajeromi-Ifelodun",
        //             "Alimosho",
        //             "Amuwo-Odofin",
        //             "Apapa",
        //             "Badagry",
        //             "Epe",
        //             "Eti-Osa",
        //             "Ibeju-Lekki",
        //             "Ifako-Ijaiye",
        //             "Ikeja",
        //             "Ikorodu",
        //             "Kosofe",
        //             "Lagos-Island",
        //             "Lagos-Mainland",
        //             "Mushin",
        //             "Ojo",
        //             "Oshodi-Isolo",
        //             "Shomolu",
        //             "Surulere",
        //             "Yewa-South"
        //         ]
        //     },
        //     {
        //         "state": "Nasarawa",
        //         "lgas": [
        //             "Akwanga",
        //             "Awe",
        //             "Doma",
        //             "Karu",
        //             "Keana",
        //             "Keffi",
        //             "Kokona",
        //             "Lafia",
        //             "Nasarawa",
        //             "Nasarawa-Eggon",
        //             "Obi",
        //             "Wamba",
        //             "Toto"
        //         ]
        //     },
        //     {
        //         "state": "Niger",
        //         "lgas": [
        //             "Agaie",
        //             "Agwara",
        //             "Bida",
        //             "Borgu",
        //             "Bosso",
        //             "Chanchaga",
        //             "Edati",
        //             "Gbako",
        //             "Gurara",
        //             "Katcha",
        //             "Kontagora",
        //             "Lapai",
        //             "Lavun",
        //             "Magama",
        //             "Mariga",
        //             "Mashegu",
        //             "Mokwa",
        //             "Moya",
        //             "Paikoro",
        //             "Rafi",
        //             "Rijau",
        //             "Shiroro",
        //             "Suleja",
        //             "Tafa",
        //             "Wushishi"
        //         ]
        //     },
        //     {
        //         "state": "Ogun",
        //         "lgas": [
        //             "Abeokuta-North",
        //             "Abeokuta-South",
        //             "Ado-Odo\/Ota",
        //             "Ewekoro",
        //             "Ifo",
        //             "Ijebu-East",
        //             "Ijebu-North",
        //             "Ijebu-North-East",
        //             "Ijebu-Ode",
        //             "Ikenne",
        //             "Imeko-Afon",
        //             "Ipokia",
        //             "Obafemi-Owode",
        //             "Odeda",
        //             "Odogbolu",
        //             "Ogun-Waterside",
        //             "Remo-North",
        //             "Shagamu",
        //             "Yewa North"
        //         ]
        //     },
        //     {
        //         "state": "Ondo",
        //         "lgas": [
        //             "Akoko North-East",
        //             "Akoko North-West",
        //             "Akoko South-West",
        //             "Akoko South-East",
        //             "Akure-North",
        //             "Akure-South",
        //             "Ese-Odo",
        //             "Idanre",
        //             "Ifedore",
        //             "Ilaje",
        //             "Ile-Oluji-Okeigbo",
        //             "Irele",
        //             "Odigbo",
        //             "Okitipupa",
        //             "Ondo West",
        //             "Ondo-East",
        //             "Ose",
        //             "Owo"
        //         ]
        //     },
        //     {
        //         "state": "Osun",
        //         "lgas": [
        //             "Atakumosa West",
        //             "Atakumosa East",
        //             "Ayedaade",
        //             "Ayedire",
        //             "Boluwaduro",
        //             "Boripe",
        //             "Ede South",
        //             "Ede North",
        //             "Egbedore",
        //             "Ejigbo",
        //             "Ife North",
        //             "Ife South",
        //             "Ife-Central",
        //             "Ife-East",
        //             "Ifelodun",
        //             "Ila",
        //             "Ilesa-East",
        //             "Ilesa-West",
        //             "Irepodun",
        //             "Irewole",
        //             "Isokan",
        //             "Iwo",
        //             "Obokun",
        //             "Odo-Otin",
        //             "Ola Oluwa",
        //             "Olorunda",
        //             "Oriade",
        //             "Orolu",
        //             "Osogbo"
        //         ]
        //     },
        //     {
        //         "state": "Oyo",
        //         "lgas": [
        //             "Afijio",
        //             "Akinyele",
        //             "Atiba",
        //             "Atisbo",
        //             "Egbeda",
        //             "Ibadan North",
        //             "Ibadan North-East",
        //             "Ibadan North-West",
        //             "Ibadan South-East",
        //             "Ibadan South-West",
        //             "Ibarapa-Central",
        //             "Ibarapa-East",
        //             "Ibarapa-North",
        //             "Ido",
        //             "Ifedayo",
        //             "Irepo",
        //             "Iseyin",
        //             "Itesiwaju",
        //             "Iwajowa",
        //             "Kajola",
        //             "Lagelu",
        //             "Ogo-Oluwa",
        //             "Ogbomosho-North",
        //             "Ogbomosho-South",
        //             "Olorunsogo",
        //             "Oluyole",
        //             "Ona-Ara",
        //             "Orelope",
        //             "Ori-Ire",
        //             "Oyo-West",
        //             "Oyo-East",
        //             "Saki-East",
        //             "Saki-West",
        //             "Surulere"
        //         ]
        //     },
        //     {
        //         "state": "Plateau",
        //         "lgas": [
        //             "Barkin-Ladi",
        //             "Bassa",
        //             "Bokkos",
        //             "Jos-East",
        //             "Jos-North",
        //             "Jos-South",
        //             "Kanam",
        //             "Kanke",
        //             "Langtang-North",
        //             "Langtang-South",
        //             "Mangu",
        //             "Mikang",
        //             "Pankshin",
        //             "Qua'an Pan",
        //             "Riyom",
        //             "Shendam",
        //             "Wase"
        //         ]
        //     },
        //     {
        //         "state": "Rivers",
        //         "lgas": [
        //             "Abua\/Odual",
        //             "Ahoada-East",
        //             "Ahoada-West",
        //             "Akuku Toru",
        //             "Andoni",
        //             "Asari-Toru",
        //             "Bonny",
        //             "Degema",
        //             "Eleme",
        //             "Emuoha",
        //             "Etche",
        //             "Gokana",
        //             "Ikwerre",
        //             "Khana",
        //             "Obio\/Akpor",
        //             "Ogba-Egbema-Ndoni",
        //             "Ogba\/Egbema\/Ndoni",
        //             "Ogu\/Bolo",
        //             "Okrika",
        //             "Omuma",
        //             "Opobo\/Nkoro",
        //             "Oyigbo",
        //             "Port-Harcourt",
        //             "Tai"
        //         ]
        //     },
        //     {
        //         "state": "Sokoto",
        //         "lgas": [
        //             "Binji",
        //             "Bodinga",
        //             "Dange-Shuni",
        //             "Gada",
        //             "Goronyo",
        //             "Gudu",
        //             "Gwadabawa",
        //             "Illela",
        //             "Kebbe",
        //             "Kware",
        //             "Rabah",
        //             "Sabon Birni",
        //             "Shagari",
        //             "Silame",
        //             "Sokoto-North",
        //             "Sokoto-South",
        //             "Tambuwal",
        //             "Tangaza",
        //             "Tureta",
        //             "Wamako",
        //             "Wurno",
        //             "Yabo"
        //         ]
        //     },
        //     {
        //         "state": "Taraba",
        //         "lgas": [
        //             "Ardo-Kola",
        //             "Bali",
        //             "Donga",
        //             "Gashaka",
        //             "Gassol",
        //             "Ibi",
        //             "Jalingo",
        //             "Karim-Lamido",
        //             "Kurmi",
        //             "Lau",
        //             "Sardauna",
        //             "Takum",
        //             "Ussa",
        //             "Wukari",
        //             "Yorro",
        //             "Zing"
        //         ]
        //     },
        //     {
        //         "state": "Yobe",
        //         "lgas": [
        //             "Bade",
        //             "Bursari",
        //             "Damaturu",
        //             "Fika",
        //             "Fune",
        //             "Geidam",
        //             "Gujba",
        //             "Gulani",
        //             "Jakusko",
        //             "Karasuwa",
        //             "Machina",
        //             "Nangere",
        //             "Nguru",
        //             "Potiskum",
        //             "Tarmuwa",
        //             "Yunusari",
        //             "Yusufari"
        //         ]
        //     },
        //     {
        //         "state": "Zamfara",
        //         "lgas": [
        //             "Anka",
        //             "Bakura",
        //             "Birnin Magaji/Kiyaw",
        //             "Bukkuyum",
        //             "Bungudu",
        //             "Gummi",
        //             "Gusau",
        //             "Isa",
        //             "Kaura-Namoda",
        //             "Kiyawa",
        //             "Maradun",
        //             "Maru",
        //             "Shinkafi",
        //             "Talata-Mafara",
        //             "Tsafe",
        //             "Zurmi"
        //         ]
        //     }
        // ]
            $lag_lg = array(
                    "Agege",
                    "Ajeromi-Ifelodun",
                    "Alimosho",
                    "Amuwo-Odofin",
                    "Apapa",
                    "Badagry",
                    "Epe",
                    "Eti-Osa",
                    "Ibeju-Lekki",
                    "Ifako-Ijaiye",
                    "Ikeja",
                    "Ikorodu",
                    "Kosofe",
                    "Lagos-Island",
                    "Lagos-Mainland",
                    "Mushin",
                    "Ojo",
                    "Oshodi-Isolo",
                    "Shomolu",
                    "Surulere",
                    "Yewa-South"
            );
            //country_list  state_list 128  lag_lg 25
        foreach ($lag_lg as $key => $value) {
             return "Load another Lga";
            //$model = new Country();
            //$model = new State();
            $model = new Lga();
            $model->name = $value;
            $model->state_id = 27;
            $model->save();
            if($model) echo 'success  '.$key.'  <br>';
        }
    
    }
}
