<?php

namespace App\Controllers;

use App\Models\MyModel;
use App\Models\MyModel2;
use App\Models\Mymodel3;
// use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\Pager\Pager;
use function PHPSTORM_META\elementType;

class Home extends BaseController
{
    public function __construct()
    {
        $db = db_connect();
        //$this->Hrmodel = new hrModel($db);
        $this->Mymodel = new Mymodel($db);
        $this->Mymodel2 = new MyModel2($db);
        $this->Mymodel3 = new Mymodel3($db);
        $this->session = \Config\Services::session();

    }
    public function index()
    {

        return view('login');
    }
    public function search()
    {
        if ($this->request->getMethod() == 'post') {
            $key = $this->request->getPost('search_value');
            $search['result'] = $this->Mymodel->search('tbl_leads', $key);
            return redirect()->route('newlead', $search);

        }

        return redirect()->route('newlead');
    }

    public function dashboard()
    {
        if ($this->session->get('logged_in')){
            $added_by=session('user_id');
            $data['demo_assigned_only'] = $this->Mymodel->select_all_demo_assigned1('tbl_leads');
            $data['today_demo_assigned'] = $this->Mymodel->select_today_demo_lead_join();
            $data['todaylead_byId'] = $this->Mymodel->todaylead_byId('tbl_leads',$added_by);
            $data['todaydemo_byId'] = $this->Mymodel->todaydemo_byId('tbl_leads',$added_by);
            $data['todayclosed_byId'] = $this->Mymodel->todayclosed_byId('tbl_leads',$added_by);

            $data['yesterdaylead_byId'] = $this->Mymodel->yesterdaylead_byId('tbl_leads',$added_by);
            $data['yesterdaydemo_byId'] = $this->Mymodel->yesterdaydemo_byId('tbl_leads',$added_by);
            $data['yesterdayclosed_byId'] = $this->Mymodel->yesterdayclosed_byId('tbl_leads',$added_by);


            $data['monthlylead_byId'] = $this->Mymodel->monthlylead_byId('tbl_leads',$added_by);
            $data['monthlydemo_byId'] = $this->Mymodel->monthlydemo_byId('tbl_leads',$added_by);
            $data['monthlyclosed_byId'] = $this->Mymodel->monthlyclosed_byId('tbl_leads',$added_by);

            $data['lastmonthlead_byId'] = $this->Mymodel->lastmonthlead_byId('tbl_leads',$added_by);
            $data['lastmonthdemo_byId'] = $this->Mymodel->lastmonthdemo_byId('tbl_leads',$added_by);
            $data['lastmonthclosed_byId'] = $this->Mymodel->lastmonthclosed_byId('tbl_leads',$added_by);


            $data['yesterday_demo'] = $this->Mymodel->yesterday_demo('tbl_leads');
            $data['yesterday_closed'] = $this->Mymodel->yesterday_closed('tbl_leads');
            $data['lastmonth_demo'] = $this->Mymodel->lastmonth_demo('tbl_leads');
            $data['lastmonth_closed'] = $this->Mymodel->lastmonth_closed('tbl_leads');

            $data['lastmonth_leads'] = $this->Mymodel->lastmonth_leads('tbl_leads');
            $data['yesterday_leads'] = $this->Mymodel->yesterday_leads('tbl_leads');
            $data['total_closed'] = $this->Mymodel->total_closed_leads('tbl_leads');
            $data['monthwise_leads'] = $this->Mymodel->select_monthwise_leads('tbl_leads');
            $data['monthwise_closing'] = $this->Mymodel->count_monthwise_closing('tbl_leads');
            $data['daily_closing'] = $this->Mymodel->count_daily_closing('tbl_leads');
            $data['monthwise_demo'] = $this->Mymodel->count_monthwise_demo('tbl_leads');
            $data['daily_leads'] = $this->Mymodel->count_daily_leads('tbl_leads');
            $data['daily_demo'] = $this->Mymodel->count_daily_demo('tbl_leads');
            $data['newlead'] = $this->Mymodel->select_new_leads2('tbl_leads');
            $data['alls'] = $this->Mymodel->select_all_totalleads('tbl_leads');
            $data['payment'] = $this->Mymodel->select_all_lead_payment('tbl_leads');
            $data['delivereds'] = $this->Mymodel->select_all_delivered2('tbl_leads');
            $data['demo_assigneds'] = $this->Mymodel->select_all_demo('tbl_leads');
            $data['respondeds'] = $this->Mymodel->select_all_respondedlead('tbl_leads');
            $data['not_respondeds'] = $this->Mymodel->select_all_notResponded('tbl_leads');
            $data['demo_completed_only'] = $this->Mymodel->select_demo_completed('demo  ');
            $data['demo_aborteds'] = $this->Mymodel->select_all_aborted1('tbl_leads');
            $data['newleads'] = $this->Mymodel->selects_new_leads('tbl_leads',$added_by);
            $data['all'] = $this->Mymodel->selects_all_mylead('tbl_leads',$added_by);
            $data['payments'] = $this->Mymodel->select_all_lead_total_payments('tbl_leads',$added_by);           
             $data['delivered'] = $this->Mymodel->selects_all_myDeliveredlead('tbl_leads',$added_by);
            $data['demo_assigned'] = $this->Mymodel->select_demo_assigned_byId('tbl_leads',$added_by);
            $data['responded'] = $this->Mymodel->selects_all_lead_myRespondedlead('tbl_leads',$added_by);
            $data['not_responded'] = $this->Mymodel->selects_all_lead_myNotRespondedlead('tbl_leads',$added_by);
            $data['demo_completed'] = $this->Mymodel->selects_demo_completed('demo',$added_by);
            $data['demo_aborted'] = $this->Mymodel->selects_demo_aborted('tbl_leads',$added_by);
            $data['all_ticket']=$this->Mymodel->select_all_ticket('tbl_tickets');
            $data['active_tickets'] = $this->Mymodel->selects_all_tickt('tbl_tickets', $added_by);
            $data['closed_tickets'] = $this->Mymodel->selects_all_closedtickt('tbl_tickets', $added_by);

            $data['call_details']=$this->Mymodel->select_user_call_details('tbl_remark',$added_by);
            // dd($data);
            return view('dashboard', $data);
        } else {
            return redirect()->to('/');
        }
    }
    public function create_user()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {

            $user_type = $this->session->get('user_type');
            if ($user_type == 0) {
                if ($this->request->getMethod() == 'post') {
                    $session = session();
                    $rules = [
                        'email' => 'required|valid_email',
                        'password' => 'required'
                    ];

                    if (!$this->validate($rules)) {

                        $session->setFlashdata('msg', 'Invalid credentials.');
                        return view('create_user', ['validation' => $this->validator]);
                    }

                    $password = $this->request->getPost('password');
                    $newpassword = password_hash($password, PASSWORD_DEFAULT);
                    $ins_data = [
                        'email' => $this->request->getPost('email'),
                        'password' => $newpassword,
                        'designation' => $this->request->getPost('designation'),
                        'username' => $this->request->getPost('username'),
                        'user_type' => 1
                    ];
                    $this->Mymodel->insert_to_tb('tbl_users', $ins_data);
                    $session->setFlashdata('success', 'successful');
                    return view('create_user', ['user_type' => $user_type]);



                } else {
                    return view('create_user', ['user_type' => $user_type]);
                }
            } else {
                return redirect()->to('dashboard');
            }

        } else {
            return redirect()->to('/');
        }
    }
    public function list_users()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            // $lead_id = $this->request->getPost('leadId');
            if (isset($_GET['search'])) {
                $key = $this->request->getGet('search');
                $data['allusers'] = $this->Mymodel->search_all('tbl_users', $key);
                if (empty($data['allusers'])) {
                    $data['error'] = "No Records Found";
                }
                return view('list_user', $data);

            }
            $data['allusers'] = $this->Mymodel->view_all_users('tbl_users');
            if ($this->request->getMethod() == 'post') {
                $ins_data = [
                    'id' => $this->request->getPost('id'),
                    'name' => $this->request->getPost('username'),
                    'designation' => $this->request->getPost('designation'),
                    'email' => $this->request->getPost('email'),
                ];
                $this->Mymodel->insert_to_tb('tbl_users', $ins_data);
                return view('list_user', $data);
            } else {
                return view('list_user', $data);
            }
        } else {
            return redirect()->to('/');
        }
    }
    public function list_user()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            // $lead_id = $this->request->getPost('leadId');
            if (isset($_GET['search'])) {
                $key = $this->request->getGet('search');
                $data['allusers'] = $this->Mymodel->search_all('tbl_users', $key);
                if (empty($data['allusers'])) {
                    $data['error'] = "No Records Found";
                }
                return view('list_user', $data);

            }
            $data['allusers'] = $this->Mymodel->view_all_users('tbl_users');
            if ($this->request->getMethod() == 'post') {
                $ins_data = [
                    'id' => $this->request->getPost('id'),
                    'name' => $this->request->getPost('username'),
                    'designation' => $this->request->getPost('designation'),
                    'email' => $this->request->getPost('email'),
                ];
                $this->Mymodel->insert_to_tb('tbl_users', $ins_data);
                return view('list_user', $data);
            } else {
                return view('list_user', $data);
            }
        } else {
            return redirect()->to('/');
        }
    }

    // public function create_lead()
    // {
    //     $session = session(); 

    //     if ($this->session->get('logged_in') && $this->session->get('web')) {
    //         $data['industries'] = $this->Mymodel->select_all_industry('tbl_industry');
    //         $data['countries'] = $this->Mymodel->select_all('tbl_countries');
    //         $data['states'] = $this->Mymodel->select_all2('tbl_states');
    //         $data['resellers'] = $this->Mymodel->select_all_remarks('tbl_reseller');

    //         if ($this->request->getMethod() == 'post') {
    //             // Define the basic rules
    //             $rules = [
    //                 'customer_name' => 'required',
    //                 'mobile_number' => 'required|is_unique[tbl_leads.mobile_number]',
    //                 'country' => 'required',
    //             ];

    //             if ($this->request->getPost('email')) { 
    //                 $rules['email'] = 'is_unique[tbl_leads.email]';
    //             }

    //             $errors = [
    //                 'mobile_number' => [
    //                     'is_unique' => 'Mobile number already exists.',
    //                 ],
    //                 'email' => [
    //                     'is_unique' => 'Email already exists.',
    //                 ],
    //             ];
             

    //             if ($this->validate($rules, $errors)) {
    //                 $ins_data = [
    //                     'customer_name' => $this->request->getPost('customer_name'),
    //                     'mobile_number' => $this->request->getPost('mobile_number'),
    //                     'whatsapp_number' => $this->request->getPost('whatsapp_number'),
    //                     'email' => $this->request->getPost('email'),
    //                     'company_name' => $this->request->getPost('company_name'),
    //                     'industry_type' => $this->request->getPost('industry_type'),
    //                     'country' => $this->request->getPost('country'),
    //                     'lead_source' => $this->request->getPost('lead_source'),
    //                     'referred_by' => $this->request->getPost('referred_by'),
    //                     'origincountry' => $this->request->getPost('origincountry'),
    //                     'state' => $this->request->getPost('state'),
    //                     'Reseller' => $this->request->getPost('reseller'),
    //                     'remarks' => $this->request->getPost('remarks'),
    //                     'added_by' => session('user_id'),
    //                     'date' => $this->request->getPost('date'),
    //                     'address'=>$this->request->getPost('address'),
    //                 ];

    //                 $this->Mymodel->insert_to_tb('tbl_leads', $ins_data);
    //                 $session->setFlashdata('success', 'Lead successfully saved.');
    //                 return redirect()->to('createlead'); // Redirect to the same page to clear the form
    //             } else {
    //                 // Validation failed, pass the validation errors to the view
    //                 $data['validation'] = $this->validator;
    //             }
    //         }

    //         return view('create_lead', $data);
    //     } else {
    //         return redirect()->to('/');
    //     }
    // }

    public function create_lead()
    {
        $session = session(); 

        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $data['industries'] = $this->Mymodel->select_all_industry('tbl_industry');
            $data['countries'] = $this->Mymodel->select_all('tbl_countries');
            $data['leadsource'] = $this->Mymodel->select_all_leadsource('tbl_lead_source');
            $data['states'] = $this->Mymodel->select_all2('tbl_states');
            $data['resellers'] = $this->Mymodel->select_all_remarks('tbl_reseller');


            if ($this->request->getMethod() == 'post') {
                // Define the basic rules
                $rules = [
                    'customer_name' => 'required',
                    'mobile_number' => 'required',
                    'country' => 'required',
                ];
                
                $mobnumber=$this->request->getPost('mobile_number');
                $result= $this->Mymodel->phnumber_is_unique('tbl_leads', $mobnumber);

                $res_count=count($result);
                // dd($result[0]['username']);
                // dd($res_count);
                
                if($result && ($res_count != 0 )){
                    $user = $result[0]['username'];
                    // dd($user);
                    $this->session->setFlashdata('error',"Mobile Number is Already Exist ( Added by $user )");
                   return redirect()->to('createlead');
                }

                $watsupnumber=$this->request->getPost('whatsapp_number');

                $result2= $this->Mymodel->phnumber_is_unique('tbl_leads', $watsupnumber);
                $res_count2=count($result2);

                if($res_count2 != 0){
                    $user = $result2[0]['username'];
                    $this->session->setFlashdata('errorwatsupno',"Watsup Number is Already Exist ( Added by $user )");
                   return redirect()->to('createlead');
                }

                $email=$this->request->getPost('email');
                if(!empty($email)){
                    $email= $this->Mymodel->email_is_unique('tbl_leads', $email);
                    // dd($email);
                    if($email != 0){
                        $this->session->setFlashdata('erroremail','Provided email  is Already Exist');
                    return redirect()->to('createlead');
                    }
                } 

                // if ($this->request->getPost('email')) { 
                //     $rules['email'] = 'is_unique[tbl_leads.email]';
                // }

                // $errors = [
                //     'mobile_number' => [
                //         'is_unique' => 'Mobile number already exists.',
                //     ],
                //     'email' => [
                //         'is_unique' => 'Email already exists.',
                //     ],
                // ];
             

                if ($this->validate($rules)) {
                    $ins_data = [
                        'customer_name' => $this->request->getPost('customer_name'),
                        'mobile_number' => $this->request->getPost('mobile_number'),
                        'whatsapp_number' => $this->request->getPost('whatsapp_number'),
                        'email' => $this->request->getPost('email'),
                        'company_name' => $this->request->getPost('company_name'),
                        'industry_type' => $this->request->getPost('industry_type'),
                        'country' => $this->request->getPost('country'),
                        'lead_source' => $this->request->getPost('lead_source'),
                        'referred_by' => $this->request->getPost('referred_by'),
                        'origincountry' => $this->request->getPost('origincountry'),
                        'state' => $this->request->getPost('state'),
                        'Reseller' => $this->request->getPost('reseller'),
                        'remarks' => $this->request->getPost('remarks'),
                        'added_by' => session('user_id'),
                        'date' => $this->request->getPost('date'),
                        'address'=>$this->request->getPost('address'),
                        'campaign_id'=>$this->request->getPost('campaign_id')
                    ];
                     
                    $this->Mymodel->insert_to_tb('tbl_leads', $ins_data);
                    $session->setFlashdata('success', 'Lead successfully saved.');
                    return redirect()->to('createlead'); // Redirect to the same page to clear the form
                } else {
                    // Validation failed, pass the validation errors to the view
                    $data['validation'] = $this->validator;
                }
            }

            return view('create_lead', $data);
        } else {
            return redirect()->to('/');
        }
    }


    public function addreseller()
    {
        if ($this->request->getMethod() == 'post') {
            $ins_data = [
                'reseller' => $this->request->getPost('reseller'),
                'country' => $this->request->getPost('resellercountry'),
                'phone' => $this->request->getPost('resellerphone'),

            ];
            $this->Mymodel->insert_to_tb('tbl_reseller', $ins_data);
        }
        return redirect()->to('createlead');
    }
    public function new_lead()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {

            $lead_id = $this->request->getPost('leadId');

            if ($this->request->getMethod() == 'post') {

             $status=$this->request->getPost('status');
                $ins_data = [
                    'contact_date' => $this->request->getPost('date'),
                    'status' => $this->request->getPost('status'),
                    'contact_remarks' => $this->request->getPost('remarks'),
                ];
               
                
                $this->Mymodel->update_lead_status('tbl_leads', 'id', $lead_id, $ins_data);
                
                return redirect()->route('newlead'); // Fix the route name
            }

            if (isset($_GET['search'])) {
                $key = $this->request->getGet('search');
                $data['search'] = 1;
                $data['new_leads'] = $this->Mymodel->search('tbl_leads', $key);
                if (empty($data['new_leads'])) { // Correct variable name here
                    $data['error'] = "No Records Found";
                }

                // dd($data);
                return view('newlead', $data);
            } else {
                $start = 0;
                $rows_per_page = 100;
                $all_leads = $this->Mymodel->select_new_leads('tbl_leads');
                $totalItems = count($all_leads);
                $totalPages = ceil($totalItems / $rows_per_page);

                $currentPage = $this->request->getVar('page-nr');
                if (isset($currentPage)) {
                    $c_page = $this->request->getGet('page-nr') - 1;
                    $start = $c_page * $rows_per_page;
                }

                $new_leads = $this->Mymodel->select_all_newleads2('tbl_leads', $start, $rows_per_page);

                $data = [
                    'new_leads' => $new_leads,
                    'totalPages' => $totalPages,
                    'page' => $currentPage,
                    'itemsPerPage' => $rows_per_page,
                ];
                // dd($data);
                return view('newlead', $data);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function responded_lead()
    {
        $user_id = session('user_id');
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $lead_id = $this->request->getPost('leadId');
            $added_by = session('user_id');
            $data['responded_leads'] = $this->Mymodel->select_all_responded('tbl_leads', $added_by);
            $data['users'] = $this->Mymodel->view_all_users('tbl_users');
            if ($this->request->getMethod() == 'post') {
                $ins_data = [
                    'lead_id' => $this->request->getPost('leadId'),
                    'demo_date' => $this->request->getPost('date'),
                    'demo_time' => $this->request->getPost('time'),
                    'language' => $this->request->getPost('language'),
                    'remark' => $this->request->getPost('remarks'),
                    'presented_by' => $this->request->getPost('demo_giver'),
                    'added_by'=>$user_id,
                    // 'status' => 3
                ];
                $status_data = [
                    'status' => 3
                ];
                
                $this->Mymodel->insert_to_tb('demo', $ins_data);
                $this->Mymodel->update_lead_status('tbl_leads', 'id', $lead_id, $status_data);
                return redirect()->route('respondedlead');
            }
            if (isset($_GET['search'])) {

                $key = $this->request->getGet('search');
                $data['responded_leads'] = $this->Mymodel->search_all_responded('tbl_leads', $key);
                $data['search'] = 1;
                if (empty($data['responded_leads'])) {
                    $data['error'] = "No Records Found";
                }
                return view('responded_leads', $data);

            } else {
                $start = 0;
                $rows_per_page = 100;
                $user_id = session('user_id');
                $all_respondedLeads = $this->Mymodel->select_all_responded('tbl_leads', $user_id);
                $totalItems = count($all_respondedLeads);
                $totalPages = ceil($totalItems / $rows_per_page);

                $currentPage = $this->request->getVar('page-nr');
                if (isset($currentPage)) {
                    $c_page = $this->request->getGet('page-nr') - 1;
                    $start = $c_page * $rows_per_page;
                }

                $respondedLeads = $this->Mymodel->select_all_responded2($start, $rows_per_page, 'tbl_leads', $added_by);
                $users = $this->Mymodel->view_all_users('tbl_users');
                $data = [
                    'responded_leads' => $respondedLeads,
                    'totalPages' => $totalPages,
                    'users' => $users,
                    'page' => $currentPage,
                    'itemsPerPage' => $rows_per_page
                ];
                return view('responded_leads', $data);

            }
        } else {
            return redirect()->to('/');
        }


    }
    public function not_responded_lead()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $data['not_responded_leads'] = $this->Mymodel->select_all_not_responded('tbl_leads');
            $lead_id = $this->request->getPost('leadId');
            if (isset($_GET['search'])) {
                $key = $this->request->getGet('search');
                $data['not_responded_leads'] = $this->Mymodel->search_all_not_responded('tbl_leads', $key);
                $data['search'] = 1;
                if (empty($data['not_responded_leads'])) {
                    $data['error'] = "No Records Found";
                }
                return view('not_responded_leads', $data);

            }
            if ($this->request->getMethod() == 'post') {
                $status= $this->request->getPost('status');
                $ins_data = [
                    'contact_date' => $this->request->getPost('date'),
                    'status' => $this->request->getPost('status'),
                    'contact_remarks' => $this->request->getPost('remarks'),
                ];

                $lead_id=$this->request->getPost('leadId');
                // dd($ins_data);


                // $status_data = [
                //     'status' => 3
                // ];
                //$this->Mymodel->insert_to_tb('tbl_leads', $ins_data);
                $this->Mymodel->update_lead_status('tbl_leads', 'id', $lead_id, $ins_data);
            

                return redirect()->route('respondedlead');
            } else {
                $start = 0;
                $rows_per_page = 100;
                $all_NotrespondedLeads = $this->Mymodel->select_all_not_responded('tbl_leads');
                $totalItems = count($all_NotrespondedLeads);
                $totalPages = ceil($totalItems / $rows_per_page);

                $currentPage = $this->request->getVar('page-nr');
                if (isset($currentPage)) {
                    $c_page = $this->request->getGet('page-nr') - 1;
                    $start = $c_page * $rows_per_page;
                }
                $added = session('user_id');
                $notrespondedLeads = $this->Mymodel->select_all_not_responded2($start, $rows_per_page, 'tbl_leads', $added);
                $data = [
                    'not_responded_leads' => $notrespondedLeads,
                    'totalPages' => $totalPages,
                    'page' => $currentPage,
                    'itemsPerPage' => $rows_per_page
                ];
                // dd($data);
                return view('not_responded_leads', $data);
            }
        } else {
            return redirect()->to('/');
        }
    }
    public function delete_not_responded_lead($id = 0)
    {

        $this->Mymodel->delete_by_id('tbl_leads', $id);
        // echo $id;
        return redirect()->route('notrespondedlead');


    }

    public function timeslot()
    {
        return view('timeslot');

    }
    public function noslot()
    {
        $presenter=$this->request->getPost('presenter');
        $slots = $this->Mymodel->select_slots_available('demo',$presenter);
        echo json_encode($slots);

    }
    public function demo_assigned()
    {
        $data['users'] = $this->Mymodel->view_all_users('tbl_users');
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $data['demo_assigned'] = $this->Mymodel->getLastEntryForEachLeadIdWithStatusZero();
            $data['demo_lead_join'] = $this->Mymodel->select_demo_lead_join();
            $data['industry'] = $this->Mymodel->select_all_industry('tbl_industry');
            
            $lead_id = $this->request->getPost('leadId');
            $status = $this->request->getPost('status');
            if (isset($_GET['search'])) {
                $key = $this->request->getGet('search');
                $data['demo_assigned'] = $this->Mymodel->search_demoassigned($key);
                $data['search'] = 1;
                if (empty($data['demo_assigned'])) {
                    $data['error'] = "No Records Found";
                }
               
                // dd($data);
                return view('demo_assigned',$data);
            }
            if ($this->request->getMethod() == 'post') {
                $user_id = session('user_id');
                $lead_id= $this->request->getPost('leadId');
                date_default_timezone_set('Asia/Kolkata');
               $completedTime= date('H:i:s');
               $time = date("g:i A", strtotime($completedTime));
                // dd($lead_id);
                if ($status == 1){
                    $ins_data4 = [
                        'demo_actual_date' => $this->request->getPost('demo_date'),
                        'demo_actual_time' => $this->request->getPost('demo_time'),
                        'presented_by' => $this->request->getPost('presented_by'),
                        'remark_after_demo' => $this->request->getPost('remarks'),
                        'additional_features' => $this->request->getPost('additional_features'),
                        'demo_completed_date' =>date('Y-m-d'),
                        'status'=>3
                    ];

                    $this->Mymodel->update_lead_status2('demo','lead_id',$lead_id, $ins_data4);

                    $invoice=$this->request->getPost('invoice_sent');
                    $offer=$this->request->getPost('offersent');
                    $trail_account=$this->request->getPost('trial_account');

                   
                    $status_data = [
                        'status' => 4,
                        'invoice_sent_date'=>$this->request->getPost('invoice_date'),
                        'invoice_number'=>$this->request->getPost('invoice_number'),
                        'offer_sent_date'=>$this->request->getPost('offer_date')

                    ];

                    if ($invoice) {
                        $status_data['invoice_status'] = 1;
                    }if($offer){
                        $status_data['offer_mail_status'] = 1;
                    }if($trail_account){
                        $status_data['trial_account_status']=1;
                        $status_data['trial_sent_date']=$this->request->getPost('trial_sent_date');
                        $status_data['trial_expiry_date']=$this->request->getPost('expiry_date');
                        $status_data['trial_account_username']=$this->request->getPost('account_username');
                    }
                } elseif ($status == 2) {
                    // $ins_data3 = [
                    //     'lead_id'=>$lead_id,
                    //     'demo_date' => $this->request->getPost('new_date'),
                    //     'demo_time' => $this->request->getPost('new_time'),
                    //     'language' => $this->request->getPost('language'),
                    // ];

                    $ins_data2 = [
                        'lead_id'=>$lead_id,
                        'demo_date' => $this->request->getPost('new_date'),
                        'demo_time' => $this->request->getPost('new_time'),
                        'remark' => $this->request->getPost('postponed_remarks'),
                        'language' => $this->request->getPost('language'),
                        'presented_by' => $this->request->getPost('demo_giver'),
                        'added_by' =>  $user_id,
                        'status' => 1,
                    ];
                    // dd($ins_data);
                    $status_data = [
                        'status' => 3,

                    ];
                    // $presented_by = $this->request->getPost('demo_giver');
                    // $this->Mymodel->update_lead_status3('demo','lead_id',$lead_id, $ins_data3);
                    $this->Mymodel->insert_to_tb('demo', $ins_data2);

                    // if($presented_by){
                    //    $ins_data1= [ 
                    //     'presented_by' =>$presented_by 
                    //     ];

                    //     $this->Mymodel->update_presenter('demo','lead_id',$lead_id, $ins_data1); 
                    // }


                } elseif ($status == 3) {
                    $ins_data = [
                        'abort_reason' => $this->request->getPost('aborted_reason'),
                        'abort_date' => $this->request->getPost('aborted_date'),
                        'status' => 2
                    ];
                    $status_data = [
                        'status' => 5,

                    ];
                }
                // dd($status_data);
                // dd($ins_data)

                if($status != 1 && $status != 2){
                    $this->Mymodel->update_lead_status5('demo',$ins_data);
                }
                $this->Mymodel->update_demo_status('tbl_leads', 'id', $lead_id, $status_data);

                return redirect()->route('demo-assigned');
            } else {
                $start = 0;
                $rows_per_page = 100;
                $demo_assigned = $this->Mymodel->select_demo_lead_join();
                $totalItems = count($demo_assigned);
                $totalPages = ceil($totalItems / $rows_per_page);

                $demo_lead_join = $this->Mymodel->select_demo_lead_join();
                $industry = $this->Mymodel->select_all_industry('tbl_industry');
                $currentPage = $this->request->getVar('page-nr');
                if (isset($currentPage)) {
                    $c_page = $this->request->getGet('page-nr') - 1;
                    $start = $c_page * $rows_per_page;
                }

                $demo_assigned1 = $this->Mymodel->select_demo_lead_join2($start, $rows_per_page);

                $data = [
                    'demo_assigned' => $demo_assigned1,
                    'totalPages' => $totalPages,
                    'page' => $currentPage,
                    'itemsPerPage' => $rows_per_page,
                    'industry' => $industry,
                    'demo_lead_join' => $demo_lead_join


                ];

                $data['users'] = $this->Mymodel->view_all_users('tbl_users');
                
                return view('demo_assigned', $data);
            }
        } else {
            return redirect()->to('/');
        }

    }
    public function delete_demo_assigned($id = 0)
    {

        $this->Mymodel->delete_from_demo('tbl_leads', $id);
        // echo $id;
        return redirect()->route('demo-assigned');


    }
    public function demo_assigned_edit()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {

            $data['demo_assigned'] = $this->Mymodel->getLastEntryForEachLeadIdWithStatusZero();
            $data['demo_lead_join'] = $this->Mymodel->select_demo_lead_join();
            //   $data['industry'] = $this->Mymodel->select_all_industry('tbl_industry');



            if ($this->request->getMethod() == 'post') {
                $id = $this->request->getPost('leadid');
                $time = $this->request->getPost('demo_time');
                $time = date("g:i A", strtotime($time));
                

                $ins_data = [
                    'demo_date' => $this->request->getPost('demo_date'),
                    'demo_time' => $time,
                    'language' => $this->request->getPost('language'),
                    'remark' => $this->request->getPost('remark'),
                    'presented_by'=>$this->request->getPost('demo_giver'),
                ];
                $this->Mymodel->update_from_tb('demo', 'lead_id', $id, $ins_data);

                return redirect()->route('demo-assigned');


            } else {

                $data['demo_assigned'] = $this->Mymodel->select_by_id('demo', $id);
                return view('demo_assigned', $data);

            }
        } else {
            return redirect()->to('/');
        }
    }
    public function demo_completed()
    {
        $session=session();
        $user_id=$session->get("user_id");

        $data['users'] = $this->Mymodel->view_all_users('tbl_users');
        $data['payment_methods'] = $this->Mymodel->select_payment_methods('payment_methods');
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $lead_id = $this->request->getPost('leadId');
            
            if (isset($_GET['search'])) {
                $key = $this->request->getGet('search');
                $data['democomplete_lead_join'] = $this->Mymodel->search_demo_completed($key);
                $data['search'] = 1;
                if (empty($data['democomplete_lead_join'])) {
                    $data['error'] = "No Records Found";
                }
                return view('demo_completed', $data);

            }
            if ($this->request->getMethod() == 'post') {
                // dd($lead_id);
                $ins_data = [
                    'lead_id' => $this->request->getPost('leadId'),
                    'payment_date' => $this->request->getPost('date'),
                    'payment_mode' => $this->request->getPost('mode'),
                    'payment_status' => $this->request->getPost('payment_status'),
                    'payment_remarks' => $this->request->getPost('remarks'),
                    'amount' => $this->request->getPost('amount'),
                    'added_by'=>$user_id

                ];
                
                $status_data = [
                    'status' => 6,
                       
                ];
                //$this->Mymodel->insert_to_tb('tbl_leads', $ins_data);
                $this->Mymodel->update_from_tb('tbl_leads', 'id', $lead_id, $status_data);
                $this->Mymodel->insert_to_tb('tbl_payment', $ins_data);
                return redirect()->route('demo-completed');
            } else {
                $data['democomplete_lead_join'] = $this->Mymodel->select_democompleted_lead_join();
                $start = 0;
                $rows_per_page = 100;
                $democomplete_lead_join = $this->Mymodel->select_democompleted_lead_join();
                $totalItems = count($democomplete_lead_join);
                $totalPages = ceil($totalItems / $rows_per_page);

                $currentPage = $this->request->getVar('page-nr');
                if (isset($currentPage)) {
                    $c_page = $this->request->getGet('page-nr') - 1;
                    $start = $c_page * $rows_per_page;
                }

                $democomplete_lead_join1 = $this->Mymodel->select_democompleted_lead_join1($start, $rows_per_page);

                $data = [
                    'democomplete_lead_join' => $democomplete_lead_join1,
                    'totalPages' => $totalPages,
                    'page' => $currentPage,
                    'itemsPerPage' => $rows_per_page,


                ];
                
                // dd($data);
                $data['payment_methods'] = $this->Mymodel->select_payment_methods('payment_methods');
                $data['users'] = $this->Mymodel->view_all_users('tbl_users');
                return view('demo_completed', $data);
            }
        } else {
            return redirect()->to('/');
        }


    }

    public function country_report()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {

            $data['country_lead_joins'] = $this->Mymodel->select_country_lead_join();
            // dd($data);
            return view('country_report', $data);
        } else {
            return redirect()->to('/');
        }

    }
    public function month_report()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $year=$this->request->getGet('year');
            $data['country_lead_joins'] = $this->Mymodel->select_country_lead_join();
            $data['monthwiseleads'] = $this->Mymodel->getMonthwiseDetails($year);
            if($year){
                $data['year']=$year;
                // dd($data);
            }
            
            return view('month_report', $data);
        } else {
            return redirect()->to('/');
        }
    }
    public function presented_report()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $start_date = $this->request->getGet('from');
            $end_date = $this->request->getGet('to');
            if($start_date && $end_date){
                $allleads = $this->Mymodel->select_presentd_report_datewise($start_date, $end_date);
                
                $data=[
                    'from_date' =>$start_date,
                    'to_date' =>$end_date,
                    'democount' => $allleads
                ]; 
             
                if (empty($allleads)) {
                    $data['error'] = "No Records Found";
                }
                $data['totalcount'] = $this->Mymodel->getTotalDemosAndConvertedLeads_byDate($start_date, $end_date);
                // dd($data);
                return view('presented_report', $data);
            }
            else
            {

            $data['democount'] = $this->Mymodel->getTotalDemosByPresenter();
            $data['totalcount'] = $this->Mymodel->getTotalDemosAndConvertedLeads();
            // dd($data) ;
            return view('presented_report', $data);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function demo_completed_edit()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {

            $data['democomplete_lead_join'] = $this->Mymodel->select_democompleted_lead_join();


            if ($this->request->getMethod() == 'post') {
                $id = $this->request->getPost('leadid');
               
                $invoice=$this->request->getPost('invoice_sent');
                $offer=$this->request->getPost('offersent');
                $ins_data = [
                    'demo_actual_date' => $this->request->getPost('demo_actual_date'),
                    'demo_actual_time' => $this->request->getPost('demo_actual_time'),
                    'presented_by' => $this->request->getPost('presented_by'),
                   'additional_features'=>$this->request->getPost('additional_features'),
                   'remark_after_demo'=>$this->request->getPost('editremark')
                ];
                // dd($ins_data);
                $up_data=[
                    'invoice_sent_date'=>$this->request->getPost('invoice_date'),
                    'invoice_number'=>$this->request->getPost('invoice_number'),
                    'offer_sent_date'=>$this->request->getPost('offer_date')
                ];

                $trail_account=$this->request->getPost('trial_account');

                if ($invoice) {
                    $up_data['invoice_status'] = 1;
                }if($offer){
                    $up_data['offer_mail_status'] = 1;
                }if($trail_account){
                    $up_data['trial_account_status']=1;
                    $up_data['trial_sent_date']=$this->request->getPost('trial_sent_date');
                    $up_data['trial_expiry_date']=$this->request->getPost('expiry_date');
                    $up_data['trial_account_username']=$this->request->getPost('account_username');
                }
                $this->Mymodel->update_from_tb('tbl_leads', 'id', $id, $up_data);
                $this->Mymodel->update_from_demotb('demo', 'lead_id', $id, $ins_data);

                return redirect()->route('demo-completed');


            }
        } else {
            return redirect()->to('/');
        }
    }
    public function delete_democompleted($id = 0)
    {
        // dd($id);

        $this->Mymodel->delete_from_demo('tbl_leads', $id);
        // echo $id;
        return redirect()->route('demo-completed');


    }
    public function update_lead()
    {
        return view('update_lead_form');
    }

    public function edit_lead($url='',$id=0)
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            // $data['newleads'] = $this->Mymodel->select_new_leads('tbl_leads');
            // $data['leadsource'] = $this->Mymodel->select_all_leadsource('tbl_lead_source');
            $data['countries'] = $this->Mymodel->select_all('tbl_countries');
            $data['states'] = $this->Mymodel->select_all('tbl_states');
            $data['resellers'] = $this->Mymodel->select_all('tbl_reseller');
            if ($this->request->getMethod() == 'post') {

                $ins_data = [
                    'customer_name' => $this->request->getPost('customer_name'),
                    'mobile_number' => $this->request->getPost('mobile_number'),
                    'whatsapp_number' => $this->request->getPost('whatsapp_number'),
                    'email' => $this->request->getPost('email'),
                    'company_name' => $this->request->getPost('company_name'),
                    'industry_type' => $this->request->getPost('industry_type'),
                    'country' => $this->request->getPost('country'),
                    'lead_source' => $this->request->getPost('lead_source'),
                    'referred_by' => $this->request->getPost('referred_by'),
                    'remarks' => $this->request->getPost('remarks'),
                    'origincountry' => $this->request->getPost('origincountry'),
                    'state' => $this->request->getPost('state'),
                    'Reseller' => $this->request->getPost('reseller'),
                    'date'=>$this->request->getPost('date'),
                    'address'=>$this->request->getPost('address'),
                    'campaign_id'=>$this->request->getPost('campaign_id')

                ];
               
                $lead_id=$this->request->getPost('lead_id');
                
                $this->Mymodel->update_from_tb('tbl_leads','id',$lead_id,$ins_data);
                $route=$this->request->getPost('url');
                // dd($route);
                return redirect($route);

            } else {
                $data['leadsource'] = $this->Mymodel->select_all_leadsource('tbl_lead_source');
                $data['newleads'] = $this->Mymodel->select_by_id('tbl_leads', $id);
                $data['industries'] = $this->Mymodel->select_all_industry('tbl_industry');
                // dd($data);
                $data['url']=$url;
                return view('edit_lead', $data);

            }
        } else {
            return redirect()->to('/');
        }
    }
    public function delete_newleads($id = 0)
    {

        $this->Mymodel->delete_by_id('tbl_leads', $id);
        // echo $id;
        return redirect()->route('newlead');


    }
    public function delete_responded($id = 0)
    {

        $this->Mymodel->delete_by_id('tbl_leads', $id);
        // echo $id;
        return redirect()->route('respondedlead');


    }
    public function demo_aborted()
    {
        $user_id = session('user_id');
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            //$data['aborted'] = $this->Mymodel->select_all_aborted('demo');
            if (isset($_GET['search'])) {
                $key = $this->request->getGet('search');
                $data['users'] = $this->Mymodel->get_users('tbl_users',$user_id);
                $data['abortedjoin'] = $this->Mymodel->search_demoaborted($key);
                $data['search']=1;
                if (empty($data['abortedjoin'])) {
                    $data['error'] = "No Records Found";
                }
                return view('demo_aborted', $data);

            }
            if($this->request->getMethod()=='post'){
                $id=$this->request->getPost('leadId');
                $status=$this->request->getPost('status');
                // dd($status);
                $up_data=[
                    'status'=>3,
                ];

                    $demo_data=[
                        'lead_id' => $id,
                        'demo_date' => $this->request->getPost('date'),
                        'demo_time' => $this->request->getPost('time'),
                        'language' => $this->request->getPost('language'),
                        'remark' => $this->request->getPost('remarks'),
                        'presented_by' => $this->request->getPost('demo_giver'),
                        'added_by'=>$user_id,
                        'status'=>1
                       
                    ];
                $this->Mymodel->update_from_tb('tbl_leads', 'id', $id, $up_data);
                $this->Mymodel->insert_to_tb('demo',$demo_data);
                return redirect()->to('demo-assigned');
            }
            $added_by = session('user_id');
            $data['abortedjoin'] = $this->Mymodel->select_demoaborted_lead_join($added_by);
            $start = 0;
            $rows_per_page = 100;

            $demo_aborted = $this->Mymodel->select_demoaborted_lead_join($added_by);
            $totalItems = count($demo_aborted);
            $totalPages = ceil($totalItems / $rows_per_page);

            $currentPage = $this->request->getVar('page-nr');
            if (isset($currentPage)) {
                $c_page = $this->request->getGet('page-nr') - 1;
                $start = $c_page * $rows_per_page;
            }

            $added_by = session('user_id');
            $demo_assigned1 = $this->Mymodel->select_demoaborted_lead_join1($start, $rows_per_page, $added_by);

            $data = [
                'abortedjoin' => $demo_assigned1,
                'totalPages' => $totalPages,
                'page' => $currentPage,
                'itemsPerPage' => $rows_per_page,


            ];
            $data['users'] = $this->Mymodel->view_all_users('tbl_users');
            return view('demo_aborted', $data);
        } else {
            return redirect()->to('/');
        }
    }
    public function delete_demo_aborted($id = 0)
    {
        $status = [
            'status' => 8
        ];
        $this->Mymodel->update_lead_status('tbl_leads', 'id', $id, $status);
        // echo $id;
        return redirect()->route('demo-aborted');


    }
    public function payment_received()
    {
        $session = session();
        $user_id=$session->get("user_id");
        if ($this->session->get('logged_in') && $this->session->get('web')) {

            $data['payment'] = $this->Mymodel->select_payment_lead_join();
            $data['last'] = $this->Mymodel->getLastEntryForEachLeadId();
            $data['clients'] = $this->Mymodel->select_all_clients('tbl_client_support');
            $data['users'] = $this->Mymodel->select_all_users('tbl_users');
            $data['payment_methods'] = $this->Mymodel->select_payment_methods('payment_methods');
            $lead_id = $this->request->getPost('leadId');
            if (isset($_GET['search'])) {
                $key = $this->request->getGet('search');
                $data['payment'] = $this->Mymodel->search_payment_received($key);
                if (empty($data['payment'])) {
                    $data['error'] = "No Records Found";
                }
                return view('payment_received', $data);

            }
            if ($this->request->getMethod() == 'post') {
                $ins_data = [

                    //'payment_date' => $this->request->getPost('date'),
                    'payment_mode' => $this->request->getPost('mode'),
                    'payment_status' => $this->request->getPost('payment_status'),
                    //'payment_remarks' => $this->request->getPost('payment_remark'),
                    'amount' => $this->request->getPost('amount'),
                    'status' => 7,
                    'project_delivery_date' => $this->request->getPost('delivery_date'),
                    'delivery_remark' => $this->request->getPost('delivery_remark'),
                    'delivered_by' =>$user_id,
                    'email_sent_by' => $this->request->getPost('email_sent_by'),
                    'support_giver' => $this->request->getPost('client_support'),
                ];

                //$this->Mymodel->insert_to_tb('tbl_leads', $ins_data);
                $this->Mymodel->update_from_tb('tbl_leads', 'id', $lead_id, $ins_data);
                return redirect()->route('payment-received');
            } else {
                return view('payment_received', $data);
            }
        } else {
            return redirect()->to('/');
        }
    }
    public function delete_payment_received($id = 0)
    {
        $status = [
            'status' => 8
        ];
        $this->Mymodel->update_lead_status('tbl_leads', 'id', $id, $status);
        // echo $id;
        return redirect()->route('payment-received');


    }
    public function individual_payment()
    {
        $id = $this->request->getGet('id');
        $i_payment = $this->Mymodel->individual_payment($id);
        $methods=$this->Mymodel->select_payment_methods('payment_methods');

        // Create an associative array with your data
        $response = [
            'id' => $id,
            'i_payment' => $i_payment,
            'payment_methods'=>$methods
        ];
        echo json_encode($response);
    }
    public function remarks()
    {
        $id = $this->request->getGet('id');
        $remarks = $this->Mymodel->select_by_leadids('tbl_leads', $id, );

        // Create an associative array with your data
        $response = [
            'id' => $id,
            'remarks' => $remarks,
        ];
        echo json_encode($response);
    }
    public function addpayment()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            if ($this->request->getMethod() == 'post') {
                $ins_data = [
                    'lead_id' => $this->request->getPost('leadid'),
                    'payment_date' => $this->request->getPost('date'),
                    'payment_mode' => $this->request->getPost('mode'),
                    'payment_status' => $this->request->getPost('payment_status'),
                    'payment_remarks' => $this->request->getPost('remarks'),
                    'amount' => $this->request->getPost('ipamount')

                ];

                //$this->Mymodel->insert_to_tb('tbl_leads', $ins_data);

                $this->Mymodel->insert_to_tb('tbl_payment', $ins_data);
                return redirect()->route('payment-received');
            }
        } else {
            return redirect()->to('/');
        }


    }
    public function editpayment()
    {
        if ($this->request->getMethod() == 'post') {
            $lead_id = $this->request->getPost('leadid');

            $payment_mode = $this->request->getPost('mode');
            $payment_date = $this->request->getPost('date');
            $payment_status = $this->request->getPost('payment_status');
            $amount = $this->request->getPost('amount');
            $this->Mymodel->delete_from_payment('tbl_payment', $lead_id);
            for ($i = 0; $i < count($payment_mode); $i++) {
                $ins_data = [
                    'payment_mode' => $payment_mode[$i],
                    'payment_date' => $payment_date[$i],
                    'payment_status' => $payment_status[$i],
                    'lead_id' => $lead_id,
                    'amount' => $amount[$i],
                ];
                $this->Mymodel->insert_to_tb('tbl_payment', $ins_data);
                // Insert the data into the database

            }

        }
        return redirect()->route('payment-received');
    }
    public function delete_delivery_received($id = 0)
    {
        $status = [
            'status' => 8
        ];
        $this->Mymodel->update_lead_status('tbl_leads', 'id', $id, $status);
        // echo $id;
        return redirect()->route('delivered-leads');


    }
    public function delivered_leads()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            if (isset($_GET['search'])) {
                $key = $this->request->getGet('search');
                $data['delivered'] = $this->Mymodel->search_all_delivered('tbl_leads', $key);
                if (empty($data['delivered'])) {
                    $data['error'] = "No Records Found";
                }
                $data['support'] = $this->Mymodel->select_all_clients('tbl_client_support');
                return view('delivered_leads', $data);
            }
            $data['support'] = $this->Mymodel->select_all_clients('tbl_client_support');
            $data['delivered'] = $this->Mymodel->select_all_delivered('tbl_leads');
            // dd($data);
            return view('delivered_leads', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function deliveredleads_edit()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $data['delivered'] = $this->Mymodel->select_all_delivered('tbl_leads');
            $id = $this->request->getPost('leadid');
            if ($this->request->getMethod() == 'post') {
                $ins_data = [
                    'customer_name' => $this->request->getPost('customer_name'),
                    'project_delivery_date' => $this->request->getPost('project_delivery_date'),
                    'support_giver' => $this->request->getPost('support_given'),
                    'delivery_remark' => $this->request->getPost('delivery_remark'),

                ];
                $this->Mymodel->update_from_tb('tbl_leads', 'id', $id, $ins_data);
                return redirect()->route('delivered-leads');
            } else {
                $data['support'] = $this->Mymodel->select_all_clients('tbl_client_support');
                $data['delivered'] = $this->Mymodel->select_by_id('tbl_leads', $id);
                return view('delivered_leads', $data);

            }
        } else {
            return redirect()->to('/');
        }
    }
    // public function viewall_leads()
    // {
    //     if ($this->session->get('logged_in') && $this->session->get('web')) {
    //         $lead_id = $this->request->getPost('leadId');
    //         if (isset($_GET['search'])) {
    //             $key = $this->request->getGet('search');
    //             $start_date=$this->request->getGet('from');
    //             $end_date=$this->request->getGet('to');

    //             if ($key) {
    //                 $data['allleads'] = $this->Mymodel->search_all('tbl_leads', $key);
    //             } elseif ($start_date && $end_date) {
    //                 $data['allleads'] = $this->Mymodel->search_date_wise('tbl_leads', $start_date, $end_date);
    //             }

    //             $data['search']=1;
    //             if (empty($data['allleads'])) {
    //                 $data['error'] = "No Records Found";
    //             }
    //             return view('date-filter', $data);

    //         } else {
    //             if ($this->request->getMethod() == 'post') {
    //                 $l_id=$this->request->getPost('leadId');
    //                 // dd($l_id);
    //                 $start=0;
    //                 $rows_per_page=100;
    //                 $all_leads = $this->Mymodel->view_all_leads('tbl_leads');
    //                 $totalItems = count($all_leads);
    //                 $totalPages = ceil($totalItems / $rows_per_page);

    //                 $currentPage=$this->request->getVar('page-nr');
    //                 if(isset($currentPage)){
    //                     $c_page= $this->request->getGet('page-nr') - 1;
    //                     $start=$c_page * $rows_per_page;
    //                 }

    //                 $all_leads = $this->Mymodel->view_all_leads1('tbl_leads',$start,$rows_per_page);
    //                 $ins_data = [
    //                     'lead_id' => $this->request->getPost('leadId'),
    //                     'remark' => $this->request->getPost('remark'),
    //                     'date' => date('Y-m-d H:i:s')
    //                 ];
    //                 $this->Mymodel->insert_to_tb('tbl_remark', $ins_data);
    //                 $data=[
    //                     'allleads'=>$all_leads,
    //                     'totalPages'=>$totalPages,
    //                     'page'=>$currentPage,
    //                     'itemsPerPage'=>$rows_per_page,
                        

    //                 ];
    //                 return view('date-filter', $data);
    //             } else {
    //                  $start=0;
    //                 $rows_per_page=100;
    //                 $all_leads = $this->Mymodel->view_all_leads('tbl_leads');
    //                 $totalItems = count($all_leads);
    //                 $totalPages = ceil($totalItems / $rows_per_page);

    //                 $currentPage=$this->request->getVar('page-nr');
    //                 if(isset($currentPage)){
    //                     $c_page= $this->request->getGet('page-nr') - 1;
    //                     $start=$c_page * $rows_per_page;
    //                 }

    //                 $all_leads = $this->Mymodel->view_all_leads1('tbl_leads',$start,$rows_per_page);

    //                 $data=[
    //                     'allleads'=>$all_leads,
    //                     'totalPages'=>$totalPages,
    //                     'page'=>$currentPage,
    //                     'itemsPerPage'=>$rows_per_page,
                        

    //                 ];
    //                 // dd($data);
    //                 return view('date-filter', $data);
    //             }
    //         }
    //     } else {
    //         return redirect()->to('/');
    //     }
    // }
    public function viewall_leads()
    {
        $session = session();
        $user_id=$session->get("user_id");
        $data['users'] = $this->Mymodel->get_users('tbl_users',$user_id);

        if ($this->session->get('logged_in') && $this->session->get('web')){
            $lead_id = $this->request->getPost('leadId');
            if (isset($_GET['search'])) {
                $key = $this->request->getGet('search');
                $start_date = $this->request->getGet('from');
                $end_date = $this->request->getGet('to');
                $lead_status = $this->request->getGet('lead_status');

                // $lead_status = (',', $this->request->getGet('lead_status'));
                $newArray = [];

                if (isset($lead_status)){
                foreach ($lead_status as $string){
                    $explodedArray = explode(',', $string);
                    $newArray[] = $explodedArray;
                }
                    $lead_status=$newArray[0];
                }
                
                // dd($lead_status);
                if ($key) {
                    $data['allleads'] = $this->Mymodel->search_all_viewPage('tbl_leads', $key);
                    // dd($data);
                } elseif ($start_date && $end_date) {
                    $allleads = $this->Mymodel->search_date_wise('tbl_leads', $start_date, $end_date, $lead_status);
                }
                if($start_date && $end_date){
                $data=[
                    'from_date' =>$start_date,
                    'to_date' =>$end_date,
                    'allleads' => $allleads
                ]; 
                }
                $data['search'] = 1;
                if (empty($data['allleads'])) {
                    $data['error'] = "No Records Found";
                }
                $data['users'] = $this->Mymodel->get_users('tbl_users',$user_id);
                return view('date-filter', $data);
            } else {
                if ($this->request->getMethod() == 'post') {
                    $l_id = $this->request->getPost('leadId');
                    $start = 0;
                    $rows_per_page = 100;
                    $all_leads = $this->Mymodel->view_all_leads('tbl_leads');
                    $totalItems = count($all_leads);
                    $totalPages = ceil($totalItems / $rows_per_page);

                    $currentPage = $this->request->getVar('page-nr');
                    if (isset($currentPage)) {
                        $c_page = $this->request->getGet('page-nr') - 1;
                        $start = $c_page * $rows_per_page;
                    }

                    $all_leads = $this->Mymodel->view_all_leads2('tbl_leads', $start, $rows_per_page);
                    $ins_data = [
                        'lead_id' => $this->request->getPost('leadId'),
                        'remark' => $this->request->getPost('remark'),
                        'date' => date('Y-m-d H:i:s')
                    ];

                    $this->Mymodel->insert_to_tb('tbl_remark', $ins_data);
                    return redirect()->back();
                    // $data = [
                    //     'allleads' => $all_leads,
                    //     'totalPages' => $totalPages,
                    //     'page' => $currentPage,
                    //     'itemsPerPage' => $rows_per_page,
                    // ];
                    
                    // $data['users'] = $this->Mymodel->get_users('tbl_users',$user_id);
                    // return view('date-filter', $data);
                } else {
                    $start = 0;
                    $rows_per_page = 100;
                    $all_leads = $this->Mymodel->view_all_leads('tbl_leads');
                    $totalItems = count($all_leads);
                    $totalPages = ceil($totalItems / $rows_per_page);

                    $currentPage = $this->request->getVar('page-nr');
                    if (isset($currentPage)) {
                        $c_page = $this->request->getGet('page-nr') - 1;
                        $start = $c_page * $rows_per_page;
                    }

                    $all_leads = $this->Mymodel->view_all_leads2('tbl_leads', $start, $rows_per_page);

                    $data = [
                        'allleads' => $all_leads,
                        'totalPages' => $totalPages,
                        'page' => $currentPage,
                        'itemsPerPage' => $rows_per_page,
                    ];

                    $data['users'] = $this->Mymodel->get_users('tbl_users',$user_id);
                    // dd($data);
                    return view('date-filter', $data);
                }
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function lead_transfer()
    {    
        $lead_id = $this->request->getPost('leadId');
        $user_id = session('user_id');
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $added_by = session('user_id');
            
            if ($this->request->getMethod() == 'post') {
                $ins_data = [
                    'added_by' => $this->request->getPost('user_id'),
                    'previously_added_by' => $user_id,
                    
                ];  
                $this->Mymodel->update_lead_status('tbl_leads', 'id', $lead_id, $ins_data);

                $ins_data1 = [
                    'lead_id' => $lead_id,
                    'transfer_from' => $user_id,
                    'transfer_to' => $this->request->getPost('user_id'),
                    'status' => 0,

                    
                ]; 
                
                $this->Mymodel->insert_to_tb('tbl_leadtransfer', $ins_data1);




                return redirect()->route('viewall-leads');
            }
          
        } else {
            return redirect()->to('/');
        }

    }

    public function edit_newlead($id = 0)
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            // $data['newleads'] = $this->Mymodel->select_new_leads('tbl_leads');
            $data['countries'] = $this->Mymodel->select_all('tbl_countries');
            $data['states'] = $this->Mymodel->select_all('tbl_states');
            $data['leadsource'] = $this->Mymodel->select_all_leadsource('tbl_lead_source');
            $data['resellers'] = $this->Mymodel->select_all('tbl_reseller');
            if ($this->request->getMethod() == 'post') {

                $ins_data = [
                    'customer_name' => $this->request->getPost('customer_name'),
                    'mobile_number' => $this->request->getPost('mobile_number'),
                    'whatsapp_number' => $this->request->getPost('whatsapp_number'),
                    'email' => $this->request->getPost('email'),
                    'company_name' => $this->request->getPost('company_name'),
                    'industry_type' => $this->request->getPost('industry_type'),
                    'country' => $this->request->getPost('country'),
                    'lead_source' => $this->request->getPost('lead_source'),
                    'referred_by' => $this->request->getPost('referred_by'),
                    'remarks' => $this->request->getPost('remarks'),
                    'origincountry' => $this->request->getPost('origincountry'),
                    'state' => $this->request->getPost('state'),
                    'Reseller' => $this->request->getPost('reseller'),
                    'date'=>$this->request->getPost('date'),
                    'address'=>$this->request->getPost('address'),

                ];
                $this->Mymodel->update_from_tb('tbl_leads', 'id', $id, $ins_data);

                return redirect()->route('newlead');

            } else {
                $data['leadsource'] = $this->Mymodel->select_all_leadsource('tbl_lead_source');
                $data['newleads'] = $this->Mymodel->select_by_id('tbl_leads', $id);
                $data['industries'] = $this->Mymodel->select_all_industry('tbl_industry');
                // dd($data);
                return view('edit_lead', $data);

            }
        } else {
            return redirect()->to('/');
        }
    }

    public function viewDaily_leads()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $lead_id = $this->request->getPost('leadId');
            
           
            if (isset($_GET['to'])) {
                // $start_date=$this->request->getGet('from');
                $to_date=$this->request->getGet('to');
                $lead_status = $this->request->getGet('lead_status');
                $newArray = [];

                foreach ($lead_status as $string) {
                    $explodedArray = explode(',', $string);
                    $newArray[] = $explodedArray;
                }

                 $lead_status=$newArray[0]; 
                 $data['allleads'] = $this->Mymodel->search_daily_wise('tbl_leads', $to_date , $lead_status );

                if (empty($data['allleads'])) {
                    $data['error'] = "No Records Found";
                }
                return view('daily_plan', $data);

            } else {
                if ($this->request->getMethod() == 'post') {
                    $l_id=$this->request->getPost('leadId');
                    // dd($l_id);
                    $start=0;
                    $rows_per_page=100;
                    $all_leads = $this->Mymodel->view_all_leads('tbl_leads');
                    $totalItems = count($all_leads);
                    $totalPages = ceil($totalItems / $rows_per_page);

                    $currentPage=$this->request->getVar('page-nr');
                    if(isset($currentPage)){
                        $c_page= $this->request->getGet('page-nr') - 1;
                        $start=$c_page * $rows_per_page;
                    }

                    $all_leads = $this->Mymodel->view_all_leads1('tbl_leads',$start,$rows_per_page);
                    $ins_data = [
                        'lead_id' => $this->request->getPost('leadId'),
                        'remark' => $this->request->getPost('remark'),
                        'date' => date('Y-m-d H:i:s')
                    ];
                    $this->Mymodel->insert_to_tb('tbl_remark', $ins_data);
                    $data=[
                        'allleads'=>$all_leads,
                        'totalPages'=>$totalPages,
                        'page'=>$currentPage,
                        'itemsPerPage'=>$rows_per_page,
                        

                    ];
                    return view('daily_plan', $data);
                } else {
                     $start=0;
                    $rows_per_page=100;
                    $all_leads = $this->Mymodel->view_all_leads('tbl_leads');
                    $totalItems = count($all_leads);
                    $totalPages = ceil($totalItems / $rows_per_page);

                    $currentPage=$this->request->getVar('page-nr');
                    if(isset($currentPage)){
                        $c_page= $this->request->getGet('page-nr') - 1;
                        $start=$c_page * $rows_per_page;
                    }
                    
                    $data=[
                        'allleads'=>null,
                        'totalPages'=>$totalPages,
                        'page'=>$currentPage,
                        'itemsPerPage'=>$rows_per_page,
                        

                    ];
                    // dd($data);
                    return view('daily_plan', $data);
                }
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function delete_all_lead($id = 0)
    {

        $this->Mymodel->delete_by_id('tbl_leads', $id);
        // echo $id;
        return redirect()->route('viewall-leads');
    }


    public function view_more($id = 0)
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $data['leads'] = $this->Mymodel->select_by_id_viewmore('tbl_leads', $id);
            $data['remark'] = $this->Mymodel->select_by_lead_liveUpdate('tbl_remark', $id);
            $data['history'] = $this->Mymodel->select_history_by_id('demo', $id);
            $data['industries'] = $this->Mymodel->select_all_leads('tbl_industry');
            $data['leadid'] = $this->Mymodel->select_by_leadid_demo('demo', $id);
            $data['payments'] = $this->Mymodel->select_by_paymentid('tbl_payment', $id);
            $data['demos'] = $this->Mymodel->select_by_all_leadid_demo('demo', $id);
            $data['aborteds'] = $this->Mymodel->select_by_all_leadid_aborted('demo', $id);
            $data['postponed'] = $this->Mymodel->select_by_all_leadid_demo_postponed('demo', $id);
            $data['countries'] = $this->Mymodel->select_all('tbl_countries');

            $data['call_details']=$this->Mymodel->select_call_details('tbl_remark',$id);  
            // dd($data);
            return view('view_more', $data);
        } else {
            return redirect()->to('/');
        }
    }
    public function report()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $user_type = $this->session->get('user_type');
            if ($user_type == 0) {

                $data['country_lead_joins'] = $this->Mymodel->select_country_lead_join();
                $data['monthwiseleads'] = $this->Mymodel->getMonthwiseDetails();
                $data['presenter'] = $this->Mymodel->getLeadsWithStatus6Or7();
                $data['democount'] = $this->Mymodel->getTotalDemosByPresenter();
                $data['convert'] = $this->Mymodel2->getPaymentAndDemoData();
                return view('report', $data);
            } else {
                return redirect()->to('dashboard');
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function login()
    {
        helper(['form']);
        $session = session();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required'
            ];

            if (!$this->validate($rules)) {

                $session->setFlashdata('msg', 'Invalid credentials.');
                return view('/', ['validation' => $this->validator]);
            } else {
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');
                $user = $this->Mymodel->getUserByEmail($email);
                if (!$user) {
                    $session->setFlashdata('msg', 'Invalid credentials.');
                    return redirect()->to('/');
                } else {
                    if (password_verify($password, $user['password']) && $user['status'] == 1) {
                        $sess = [
                            'logged_in' => true,
                            'web'=>'ethiccrm',
                            'user_id' => $user['id'],
                            'user_type' => $user['user_type'],
                            'username' => $user['username']
                        ];
                        $this->session->set($sess);
                        $user_type = session('user_type');
                        if ($user_type == 2) {
                            return redirect()->to('ticket');
                        } else {

                            return redirect()->to('dashboard');
                        }
                    } else {
                        $session->setFlashdata('msg', 'Invalid Credentials');
                        return redirect()->to('/');
                    }
                }
            }

        } else {
            return view('login');
        }

    }
    public function edit_user($id = 0)
    {
        if ($this->session->get('logged_in') && $this->session->get('ethiccrm')){
            $data['users'] = $this->Mymodel->select_new_leads('tbl_users');
            if ($this->request->getMethod() == 'post') {

                $password = $this->request->getPost('password');
                $resetpassword = password_hash($password, PASSWORD_DEFAULT);
                $ins_data = [
                    'username' => $this->request->getPost('username'),
                    'designation' => $this->request->getPost('designation'),
                    'email' => $this->request->getPost('email'),
                    'password' => $resetpassword,
                    'user_type' => 1
                ];
                $this->Mymodel->update_from_tb('tbl_users', 'id', $id, $ins_data);

                return redirect()->route('dashboard');

            } else {

                $data['users'] = $this->Mymodel->select_by_id('tbl_users', $id);

                return view('edit_user', $data);

            }
        } else {
            return redirect()->to('/');
        }
    }
    public function delete_list_user($id = 0)
    {

        $this->Mymodel->delete_by_id_user('tbl_users', $id);
        // echo $id;
        return redirect()->route('listuser');


    }
    public function responded_edit()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $user_id = session('user_id');
            $data['responded_leads'] = $this->Mymodel->select_all_responded('tbl_leads', $user_id);
            if ($this->request->getMethod() == 'post') {
                $id = $this->request->getPost('leadid');

                $ins_data = [
                    'customer_name' => $this->request->getPost('customer_name'),
                    'contact_date' => $this->request->getPost('contact_date'),
                    'contact_remarks' => $this->request->getPost('remarks'),

                ];
                $this->Mymodel->update_from_tb('tbl_leads', 'id', $id, $ins_data);

                return redirect()->route('respondedlead');


            } else {

                $data['responded_leads'] = $this->Mymodel->select_by_id('tbl_leads', $id);
                return view('responded_leads', $data);

            }
        } else {
            return redirect()->to('/');
        }
    }
    public function not_responded_edit()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {


            $data['not_responded_leads'] = $this->Mymodel->select_all_not_responded('tbl_leads');
            if ($this->request->getMethod() == 'post') {
                $id = $this->request->getPost('leadid');

                $ins_data = [
                    'customer_name' => $this->request->getPost('customer_name'),
                    'contact_date' => $this->request->getPost('contact_date'),
                    'remarks' => $this->request->getPost('remarks'),

                ];
                $this->Mymodel->update_from_tb('tbl_leads', 'id', $id, $ins_data);

                return redirect()->route('notrespondedlead');


            } else {

                $data['not_responded_leads'] = $this->Mymodel->select_by_id('tbl_leads', $id);
                return view('not_responded_leads', $data);

            }
        } else {
            return redirect()->to('/');
        }
    }
    public function logout()
    {

        $this->session->destroy();
        return redirect()->to('/');

    }
    public function addindustry()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {


            if ($this->request->getMethod() == 'post') {
                $ins_data = [
                    'industry_type' => $this->request->getPost('industry_type'),
                ];
                $this->Mymodel->insert_to_tb('tbl_industry', $ins_data);
            }
            return redirect()->route('createlead');

        }
    }
    public function addleadsourceform()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {


            if ($this->request->getMethod() == 'post') {
                $ins_data = [
                    '' => $this->request->getPost('industry_type'),
                ];
                $this->Mymodel->insert_to_tb('tbl_industry', $ins_data);
            }
            return redirect()->route('createlead');

        }
    }

    public function ticket()
    {
        if ($this->request->getMethod() == 'post') {

            $files = $this->request->getFiles();
            $i_description = $this->request->getPost('image_description');
            // $filePaths = [];
            // foreach ($files['image'] as $file) {
            //     $newName = $file->getRandomName();
            //     $file->move(ROOTPATH . 'assets/img/tickets', $newName);
            //     $filePaths[] = 'assets/img/tickets/' . $newName;
            // }
            $prefix = "TN";
            // $letters = strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2)); // Generate two random uppercase letters
            $numbers = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT); // Generate a random 4-digit number with leading zeros

            $ticketID = $prefix . $numbers;
            // $filePathsStr = implode(',', $filePaths);
            $ins_data = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'customer_id' => session('user_id'),
                // 'file_path' => $filePathsStr,
                'priority' => $this->request->getPost('priority'),
                'status' => 1,
                'unique_id' => $ticketID
            ];
            if ($this->Mymodel->insert_to_tb('tbl_tickets', $ins_data)) {
                $insertedID = $this->Mymodel->insertID();
                $i = 0;
                foreach ($files['image'] as $file) {
                    $newName = $file->getRandomName();
                    $file->move(ROOTPATH . 'assets/img/tickets', $newName);
                    $filePaths = 'assets/img/tickets/' . $newName;

                    $ins_data = [
                        'image' => $filePaths,
                        'description' => $i_description[$i],
                        'ticket_id' => $insertedID
                    ];

                    $this->Mymodel->insert_to_tb('tbl_ticket_images', $ins_data);
                    $i++;
                }

                session()->setFlashdata('success', 'Ticket has been raised successfully.');
            } else {
                session()->setFlashdata('fail', 'Sorry there was an error.');
            }
            return redirect()->route('ticket');
        } else {
            return view('ticket_rise');
        }
    }
    public function new_ticket($id = 0)
    {

        if ($this->request->getMethod() == 'post') {
            $ticket_id = $this->request->getPost('id');
            $up = [
                'staff' => session('username'),
                'status' => 2
            ];
            $this->Mymodel->update_lead_status('tbl_tickets', 'id', $ticket_id, $up);
            return redirect()->route('active-tickets');
        } else {
            $data['tickets'] = $this->Mymodel->select_all_openticket('tbl_tickets', 1);
            // dd($data);
            return view('new_tickets', $data);
        }
    }

    public function new_ticket1($id = 0)
    {
        $ids = $this->request->getPost('id');
        $data['tickets'] = $this->Mymodel->select_all_openticket('tbl_tickets', 1);
        $data['ticket_images'] = $this->Mymodel3->getTicketImages1($ids);

        if ($this->request->getMethod() == 'post') {
            $id = $this->request->getPost('id');
            $data['id'] = $id;
            return $this->response->setJSON(['data' => $data]);

        } else {
            $data['tickets'] = $this->Mymodel->select_all_openticket('tbl_tickets', 1);
            $data['ticket_images'] = $this->Mymodel3->getTicketImages1($ids);
            // dd($data);
            return view('new_tickets', $data);
        }
    }
    public function list_ticket()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {

            $data['tickts'] = $this->Mymodel->select_all_tickets();
            $data['all_tickets'] = $this->Mymodel->select_all('tbl_tickets');
            $data['last_tickts'] = $this->Mymodel3->getLastEntryForEachUniqueId();
            $data['users'] = $this->Mymodel->select_all('tbl_users');

            return view('list_ticket', $data);
        } else {
            return redirect()->to('/');
        }
    }
    public function view_tickets($id = 0)
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $data['tickets'] = $this->Mymodel->select_by_id('tbl_tickets', $id);

            return view('view_tickets', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function active_ticket()
    {
        $staff = session('username');
        $data['tickts'] = $this->Mymodel->select_all_tickets();
        $data['all_tickets'] = $this->Mymodel->select_all('tbl_tickets');
        $data['last_tickts'] = $this->Mymodel3->getLastEntryForEachUniqueId();
        $data['users'] = $this->Mymodel->select_all('tbl_users');
        $data['active_tickets'] = $this->Mymodel->select_all_activeticket('tbl_tickets', 2, $staff);
        $data['customers'] = $this->Mymodel->select_all('tbl_users');
        return view('active_tickets', $data);
    }

    public function ticket_followup($id, $Cid)
    {
        $data['ticket_details'] = $this->Mymodel->select_ticket_details('tbl_tickets', $id);

        // Check if the ticket exists
        if (empty($data['ticket_details'])) {
            // Handle the case where the ticket doesn't exist
            return redirect()->to('some_error_page'); // Redirect to an error page or handle accordingly
        }

        $data['ticket_images'] = $this->Mymodel3->getTicketImages($id);
        $data['customer'] = $this->Mymodel->select_all('tbl_users');

        if ($this->request->getMethod() == 'post') {
            $files = $this->request->getFiles();
            $i_description = $this->request->getPost('image_description');

            $ins_data = [
                'description' => $this->request->getPost('description'),
                'customer_id' => session('user_id'),
                'status' => 2,
                'unique_id' => $this->request->getPost('unique'),
                'staff' => session('username'),
            ];

            $this->Mymodel->insert_to_tb('tbl_tickets', $ins_data);
            $insertedID = $this->Mymodel->insertID();

            if (!empty($files['image'])) {
                $i = 0;
                foreach ($files['image'] as $file) {
                    // Check if a file has been uploaded
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move(ROOTPATH . 'assets/img/tickets', $newName);
                        $filePaths = 'assets/img/tickets/' . $newName;

                        $ins_data = [
                            'image' => $filePaths,
                            'description' => $i_description[$i],
                            'ticket_id' => $insertedID
                        ];
                        $this->Mymodel->insert_to_tb('tbl_ticket_images', $ins_data);
                        $i++;
                    }
                }
            }

            return redirect()->to('ticket_followup/' . $id . '/' . $Cid);
        } else {
            return view('ticket_followup', $data);
        }
    }



    public function ticket_details($id, $Cid)
    {
        $data['ticket_details'] = $this->Mymodel->select_ticket_details('tbl_tickets', $id);
        $data['ticket_images'] = $this->Mymodel3->getTicketImages();
        $data['customer'] = $this->Mymodel->select_all('tbl_users');

        // dd($data);
        return view('ticket-details', $data);
    }


    public function closed_tickets()
    {

        $session = session();
        $username = $session->get('username');

        if ($this->request->getMethod() == 'post') {
            $uniqueId = $this->request->getPost('unique_id');
            $data['closed_by'] = $username;
            $data['closed_date'] = date('Y-m-d');
            $data['status'] = 3;
            $this->Mymodel->update_from_tb('tbl_tickets', 'unique_id', $uniqueId, $data);
            return redirect()->to('active-tickets');
        } else {
            $data['closed'] = $this->Mymodel->getFirstEntriesWithStatus3(session('username'));
            $data['customer'] = $this->Mymodel->select_all('tbl_users');

            // dd($data);
            return view('closed_tickets', $data);
        }

    }
    public function change_customerPassword()
    {
        $session = session();
        $id = $session->get('user_id');

        if ($this->request->getMethod() == 'post') {
            $currentPassword = $this->request->getVar('current_password');
            $newPassword = $this->request->getVar('new_pass');
            $user = $this->Mymodel->select_by_id('tbl_users', $id);
            if (password_verify($currentPassword, $user['password'])) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $up_data = [
                    'password' => $hashedPassword
                ];
                $this->Mymodel->update_from_tb('tbl_users', 'id', $id, $up_data);
                $session->setFlashdata('success', 'Password changed successfully.');
                return redirect()->back();
            } else {
                $session->setFlashdata('msg', 'Invalid credentials.');
                return redirect()->to('/change-cuspass');
            }
        } else {
            return view('pass-change');
        }
    }
    public function block_user()
    {
        $userId = $this->request->getPost('userId');
        $user = $this->Mymodel->select_by_id('tbl_users', $userId);

        if ($user && $user['status'] == 1) {
            $newStatus = 3;
        } else {
            $newStatus = 1;
        }

        $data = [
            'status' => $newStatus,
        ];

        $this->Mymodel->update_from_tb('tbl_users', 'id', $userId, $data);

        return json_encode(array('id' => $userId, 'newStatus' => $newStatus));
    }
    public function change_password($id = 0)
    {
        $session = session();
        $data['id'] = $id;

        if ($this->request->getMethod() == 'post') {
            $newPassword = $this->request->getVar('new_pass');

            $userId = $session->get('user_id');
            $user = $this->Mymodel->select_by_id('tbl_users', $userId);

            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $up_data = [
                'password' => $hashedPassword
            ];
            $this->Mymodel->update_from_tb('tbl_users', 'id', $id, $up_data);
            $session->setFlashdata('success', 'Password changed successfully.');
            return redirect()->back();
        } else {
            return view('pass-change', $data);
        }
    }

    public function priority(){
        $id=$this->request->getPost('leadId');
        // dd($id);
        $up_data=[
            'priority'=>$this->request->getPost('priority'),
        ];
        // dd($id);
        $this->Mymodel->update_from_tb('tbl_leads','id',$id,$up_data);
        return redirect()->back();
    }

    // public function priority_leads(){
    //      $start_date = $this->request->getGet('from');
    //      $end_date = $this->request->getGet('to');
    //      $lead_priority = $this->request->getGet('priority');
        
    //      $newArray = [];
    //      if (isset($lead_priority)){
    //         foreach ($lead_priority as $string) {
    //             $explodedArray = explode(',', $string);
    //             $newArray[] = $explodedArray;
    //         }
    //             $lead_priority=$newArray[0];
    //         }
            
    //         // dd($lead_status);
    //         if ($start_date && $end_date) {
    //             dd($lead_priority);
    //             $data['priority_leads'] = $this->Mymodel->search_with_date('tbl_leads',$start_date, $end_date,);
    //             // dd($data);
    //         } elseif ($start_date && $end_date && $lead_priority) {
    //             dd($lead_priority);
    //             $data['priority_leads'] = $this->Mymodel->search_date_wise_withstatus('tbl_leads', $start_date, $end_date, $lead_priority);
    //             // dd($data['priority_leads']);
    //         }

           
        
    //     $data['priority_leads'] = $this->Mymodel->select_high_priorityLeads('tbl_leads');
        
    //     return view('priority-leads',$data);
    // }
    public function priority_leads()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
        $start_date = $this->request->getGet('from');
        $end_date = $this->request->getGet('to');
        $lead_priority = $this->request->getGet('priority');

        if (isset($lead_priority)) {
            $newArray = [];
            foreach ($lead_priority as $string) {
                $explodedArray = explode(',', $string);
                $newArray[] = $explodedArray;
            }

            $lead_priority = $newArray[0];
        }

        if ($start_date && $end_date && $lead_priority) {
            // dd($lead_priority); // Check if you need this debug dump
            $data['priority_leads'] = $this->Mymodel->search_date_wise_withstatus('tbl_leads', $start_date, $end_date, $lead_priority);
        } else {
            // This block will execute if neither of the above conditions is met
            $data['priority_leads'] = $this->Mymodel->select_high_priorityLeads('tbl_leads');
        }
        if($start_date && $end_date){
            $data=[
                'from_date' =>$start_date,
                'to_date' =>$end_date,
                'priority_leads' =>$data['priority_leads']
            ]; 
        }
        if (empty($data['priority_leads'])) {
            $data['error'] = "No Records Found";
        }

            return view('priority-leads', $data);

        } else {
            return redirect()->to('/');
        }
    }


    public function invoice_sent(){
        if ($this->session->get('logged_in') && $this->session->get('web')) {
        $data['invoice_sent']=$this->Mymodel->select_invoice_sent('tbl_leads');
        if($this->request->getMethod()== 'post'){
            return 'success';
        }

        return view('invoice-sent',$data);

        } else {
            return redirect()->to('/');
        }
    }

    public function offermail_sent(){
        if ($this->session->get('logged_in') && $this->session->get('web')) {

        $data['offer_mailsent']=$this->Mymodel->select_offermail_sent('tbl_leads');
        if($this->request->getMethod()== 'post'){
            return 'success';
        }

        return view('offermail-sent',$data);
        } else {
            return redirect()->to('/');
        }
    }
    public function trial_account_sent(){
        if ($this->session->get('logged_in') && $this->session->get('web')) {
        $data['trial_accounts']=$this->Mymodel->select_trial_accountSent('tbl_leads');
        if($this->request->getMethod()== 'post'){
            return 'success';
        }

        return view('trial_account_sent',$data);
        } else {
            return redirect()->to('/');
        }
    }

    public function demo_video_sent(){
        
        $data['demo_video_sent']=$this->Mymodel->select_demovideo_sent('demo');
        if($this->request->getMethod()== 'post'){
            return 'success';
        }

        return view('demo_video_sent',$data);

    }

    public function lost_leads(){
        if ($this->session->get('logged_in') && $this->session->get('web')) {

        $data['lost_leads']=$this->Mymodel->select_lost_leads('tbl_leads');
        // dd( $data['lost_leads']);
        if($this->request->getMethod()== 'post'){
            return 'success';
        }

        return view('lost_leads',$data);

        } else {
                return redirect()->to('/');
         }
    }

    

    public function userwise_report()
        {
            if ($this->session->get('logged_in') && $this->session->get('web')) {
                $data['users'] = $this->Mymodel->select_all_users_join('tbl_users');
                return view('userwise_report', $data);
                
            } else {
                return redirect()->to('/');
            }
     }

     public function update_status(){
        $data=['status' => 0];
        $this->Mymodel->update_statusnew('demo',$data);
        return 'success';
     }

     public function payment_report()
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $data['payment_modes'] = $this->Mymodel->select_all_accounttype('tbl_payment', 'id, payment_mode, COUNT(payment_mode) as count, SUM(amount) as total_amount', 'payment_mode');
            return view('payment_report', $data);
        } else {
            return redirect()->to('/');
        }
    }
    public function view_paymentdetails($stringParam)
    {
       $mode=$stringParam;
        
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $data['paymnt_details'] = $this->Mymodel->select_paymentdetails('payment_methods' ,$stringParam);
            $data['mode']=$mode;
            // dd($data);
            return view('payment_report_view',$data);
        } else {
            return redirect()->to('/');
        }
    }

    public function change_passwordnew($id = 0)
    {
        if ($this->session->get('logged_in') && $this->session->get('web')) {

                $session = session();
                $id = $session->get('user_id');

                if ($this->request->getMethod() == 'post') {
                    $currentPassword = $this->request->getVar('current_password');
                    $newPassword = $this->request->getVar('new_pass');
                    $user = $this->Mymodel->select_by_id('tbl_users', $id);
                    if (password_verify($currentPassword, $user['password'])) {
                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        $up_data = [
                            'password' => $hashedPassword
                        ];
                        $this->Mymodel->update_from_tb('tbl_users', 'id', $id, $up_data);
                        $session->setFlashdata('success', 'Password changed successfully.');
                        return redirect()->back();
                    } else {
                          $session->setFlashdata('msg', 'Invalid credentials.');
                          return view('change-password');
                    }
                } else {
                    return view('change-password');
                }
                
            
        } else {
            return redirect()->to('/');
        }
        

    }


    
        public function export_report()
        {
            $session = session();
            $user_id = $session->get('user_id');
    
            if ($this->session->get('logged_in') && $this->session->get('web')) {
    
                $all_leads = $this->Mymodel->view_all_leads3('tbl_leads');
    
                $data = [
                    'allleads' => $all_leads,
                ];
    
                $data['users'] = $this->Mymodel->get_users('tbl_users', $user_id);
    
                // Load the view
                echo view('process', $data);
    
                // Check if the export button is clicked
                if ($this->request->getPost('export')) {
                    // Generate Excel export logic here
    
                    $output = '';
    
                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename=report.xls');
                    echo $output;
                }
    
            } else {
                return redirect()->to('/');
            }
        }


        public function lead_abort()
        {
            if ($this->session->get('logged_in') && $this->session->get('web')) {
        
                $lead_id = $this->request->getPost('leadId');
        
                if ($this->request->getMethod() == 'post') {
                   
        
                    $status_data = [
                        'lost_reason' => $this->request->getPost('losted_reason'),
                        'lost_date' => $this->request->getPost('lostdate'),
                        'status' => 9,
                    ];
        
                    $this->Mymodel->update_demo_status('tbl_leads', 'id', $lead_id, $status_data);
                }
        
                return redirect()->route('viewall-leads'); // Fix the route name
            } else {
                return redirect()->to('/');
            }
        }

        public function detail_demowise_report($id){
            $data['report'] = $this->Mymodel->detailed_demowise_report($id);
               return view('demo_detail_report',$data);
        }

        public function exportToCsv()
        {
            // Disable output buffering
            while (ob_get_level()) {
                ob_end_clean();
            }
        
            // Fetch your data from the database or any source
            $data = $this->Mymodel->select_all_6('tbl_users');
        
            // Set headers for CSV download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="exported_data.csv"');
            
            // Open a file handle for output
            $output = fopen('php://output', 'w');
        
            // Output CSV headers
            if (!empty($data)) {
                // Use the keys of the first row as headers
                fputcsv($output, array_keys($data[0]));
            }
        
            // Output data rows
            foreach ($data as $row) {
                // Output values of each row
                fputcsv($output, $row);
            }
        
            // Close the file handle
            fclose($output);
            
            // Stop further execution
            exit;
        }

        public function client_callUpdate(){
            $session = session();
            $user_id = $session->get('user_id');

            $date=$this->request->getPost('curr_date');
            $start_time=$this->request->getPost('start_time');
            $end_time=$this->request->getPost('end_time');
            $call_remarks=$this->request->getPost('remarks');
            $next_follow_date=$this->request->getPost('followp_date');

            $date = $date ?? date('Y-m-d');
            $start_time = $start_time ?? null;
            $end_time = $end_time ?? null;
            $call_remarks = $call_remarks ?? null;
            $next_follow_date = $next_follow_date ?? null;

            // dd($call_remarks);
            $lead_id=$this->request->getPost('leadId');
            $data=[
                'lead_id'=>$lead_id,
                'call_date' =>$date,
                'call_start_time'=>$start_time,
                'call_end_time'=>$end_time,
                'call_remarks'=>$call_remarks,
                'next_followup_date'=>$next_follow_date,
                'added_by'=>$user_id,
                'call_status'=>1,
            ];

            $this->Mymodel->insert_to_tb('tbl_remark',$data);
            
            return redirect()->back();
        }

        public function call_details(){
            $session = session();
            $user_id = $session->get('user_id');
            $data['call_details']=$this->Mymodel->select_user_call_details2('tbl_remark',$user_id);
            // dd($data);
            return view('call_details',$data);
        }
        


        public function support_team()
        {
            if ($this->session->get('logged_in') && $this->session->get('web')) {
                $user_type = $this->session->get('user_type');

                    $data['support_details'] = $this->Mymodel->select_support_given();  
                                
                    return view('support-team', $data);
            
            } else {
                return redirect()->to('/');
            }
        }

        public function select_client_list($id)
       {
        if ($this->session->get('logged_in') && $this->session->get('web')) {

            // $encoded_name = base64_decode(urldecode($name));
            // dd($encoded_name);
            // $data['giver_name']=$encoded_name;
            $data['support_more'] = $this->Mymodel->select_all_clients_byID('tbl_client_support',$id);
            $data['support'] = $this->Mymodel->select_all_clients('tbl_client_support');
            $data['supportgiven'] = $this->Mymodel->select_client_list('tbl_leads',$id);
            // dd($data);
            return view('support-more', $data);

            
        } else {
            return redirect()->to('/');
        }
      }

      public function campaign_list(){
        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $data['campaign_list'] = $this->Mymodel->select_campaign_list('tbl_leads');
            return view('campaign-list', $data);

        } else {
            return redirect()->to('/');
        }  
      }

      public function campaign_detail_list($camp_id){
        $session = session();
        $user_id = $session->get('user_id');

        if ($this->session->get('logged_in') && $this->session->get('web')) {
            $data['users'] = $this->Mymodel->get_users('tbl_users',$user_id);   
            $data['campaign_detail_list'] = $this->Mymodel->select_campaign_deatail_list('tbl_leads',$camp_id);
            return view('campaign-details', $data);

        } else {
            return redirect()->to('/');
        }  
      }




        


    






     

}