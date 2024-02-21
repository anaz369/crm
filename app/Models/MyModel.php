<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Query;
use CodeIgniter\Pager\Pager;

class MyModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'demo';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
    protected $db;
    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db;
    }

    
    public function search($table, $query)
    {   $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        $this->table = $table; 
        $this->select("$table.*, tbl_users.username as username"); 
        $this->join('tbl_users', "tbl_users.id = {$table}.added_by", 'left');
        if ($role == 1) {
            $this->where($table . '.added_by', $user_id);
        }
        $res = $this->where("{$table}.status", 0)
            ->groupStart()
                ->like('customer_name', $query)
                ->orLike('mobile_number', $query)
            ->groupEnd()
            ->get()
            ->getResultArray();
    
        return $res;
    }
    

    public function search_all_responded($table, $query)
    {
            $session = session();
            $role = $session->get("user_type");
            $user_id = $session->get("user_id");
            
            $this->table = $table;
            $this->select("$table.*, tbl_users.username as username");
            $this->join('tbl_users', "tbl_users.id = $table.added_by", 'left'); 
            
            if ($role == 1) {
                $this->where("$table.added_by", $user_id);
            }
            
            $result = $this->where($table.".status", 1)
                ->groupStart()
                ->like("$table.customer_name", $query)
                ->orLike("$table.mobile_number", $query)
                ->groupEnd()
                ->get()
                ->getResultArray();

            return $result;
    }

    public function search_all_delivered($table, $query)
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        
        $this->table = $table;
        $this->select("$table.*,cls.name as support_given,tbl_users.username as username");
        $this->join('tbl_users', "tbl_users.id = $table.added_by", 'left');
        $this->join('tbl_client_support as cls', "cls.id = $table.support_giver",'left');
        $this->where("$table.status",7);
        if ($role == 1) {
            $this->groupStart(); // Begin a group for OR conditions
            $this->where("$table.added_by", $user_id);
            $this->orWhere("$table.delivered_by", $user_id);
            $this->groupEnd(); // End the OR group
        }

        if ($query !== '') {
            $this->groupStart(); // Begin a group for OR conditions
            $this->like("$table.customer_name", $query);
            $this->orLike("$table.mobile_number", $query);
            $this->groupEnd(); // End the OR group
        }

        $result = $this->get()->getResultArray(); // Execute the query and get the result
        // dd($result);
        return $result;
    }

    public function update_from_demotb($tableName, $where = '', $whereValue = '', $data)
    {
        if (!empty($where)) {
            return $this->db
                ->table($tableName)
                ->where([$where => $whereValue])
                ->where('status',3) // Add this condition
                ->set($data)
                ->update();
        }
    }

    public function update_presenter($tableName, $where = '', $whereValue = '', $data)
    {
        if (!empty($where)) {
            return $this->db
                ->table($tableName)
                ->where([$where => $whereValue])
                ->where('status',0) // Add this condition
                ->set($data)
                ->update();
        }
    }

    

    public function search_all_not_responded($table, $query)
    {    $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $this->table = $table;
        $this->select("$table.*, tbl_users.username as username");
        $this->join('tbl_users', "tbl_users.id = $table.added_by", 'left'); 
        if($role == 1){
            $this->where($table.'.added_by',$user_id);
        }
        
        return $this->where($table.'.status', 2) 
            ->groupStart()
            ->like('customer_name', $query)
            ->orLike('mobile_number', $query)
            ->groupEnd()
            ->get()
            ->getResultArray();
    }
    public function search_demoassigned($query)
    {
        $db = db_connect();

        // Subquery to get the maximum demo_date for each lead_id with status=0
        $subquery = $db->table('demo')
            ->select('lead_id, MAX(demo_date) AS max_date')
            ->where('status', 0)
            ->groupBy('lead_id')
            ->get();

        $maxDates = $subquery->getResult();

        // Create an array to store the last entries
        $lastEntries = [];

        foreach ($maxDates as $row) {
            // Retrieve the last entry for each lead_id based on the max demo_date and status=0
            $entry = $db->table('demo')
                ->join('tbl_leads', 'tbl_leads.id = demo.lead_id')
                ->select('demo.*, tbl_leads.*, tbl_users.username,presented_by_user.username as presented_by_username')
                ->join('tbl_users', 'tbl_users.id = tbl_leads.added_by') // Add this join
                 ->join('tbl_users as presented_by_user', 'presented_by_user.id = demo.presented_by', 'left')
                ->where('demo.lead_id', $row->lead_id)
                ->where('demo.status', 0)
                ->where('tbl_leads.status',3)
                ->where('demo.demo_date', $row->max_date);

            // Add search conditions to the query
            if ($query !== '') {
                $entry->groupStart(); // Begin a group for OR conditions
                $entry->like('customer_name', $query);
                $entry->orLike('mobile_number', $query);
                $entry->groupEnd(); // End the OR group
            }

            $entry = $entry->get()->getRow();

            // Add the entry to the result array
            if ($entry) {
                $lastEntries[] = $entry;
            }
        }

         $res= $lastEntries;
       return $res;
    }

    public function search_demo_completed($query)
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");

        $builder = $this->db->table('tbl_leads');
        $builder->select('tbl_leads.*, tbl_users.username as username, demo_presenter.username as demo_presenter, demo.*');
        $builder->join('demo', 'demo.lead_id = tbl_leads.id AND (demo.status = 0 OR demo.status = 3)', 'left');
        $builder->join('tbl_users', 'tbl_users.id = tbl_leads.added_by', 'left');
        $builder->join('tbl_users as demo_presenter', 'demo_presenter.id = demo.presented_by', 'left');

        $builder->where('tbl_leads.status', 4)
                ->where('tbl_leads.status !=', 8);

        if ($query !== '') {
            $builder->groupStart(); // Begin a group for OR conditions
            $builder->like('customer_name', $query);
            $builder->orLike('mobile_number', $query);
            $builder->groupEnd(); // End the OR group
        }

        if ($role == 1) {
            $builder->groupStart()
                    ->where('tbl_leads.added_by', $user_id)
                    ->orWhere('demo.presented_by', $user_id)
                    ->groupEnd();
        }

        $result = $builder->get()->getResult(); // Use get()->getResult() directly

        return $result;
    }



   

    public function getUserByEmail($email)
    {
        return $this->db->table('tbl_users')
            ->select('*')
            ->where('email', $email)
            ->get()
            ->getRowArray();
    }
    public function getUserByid($id)
    {
        return $this->db->table('tbl_users')
            ->select('*')
            ->where('id', $id)
            ->get()
            ->getRowArray();
    }
    public function select_new_leads($tableName, $select = '')
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        if($role== 1){
            $query->where($tableName.'.added_by',$user_id);
        }
        $query->where($tableName .'.status', 0);
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by','left');
        $query->select($tableName . '.id, ' . $tableName . '.email, tbl_users.username as username');
        $query->where($tableName .'.status !=', 8);
        $query->orderBy($tableName . '.id', 'DESC');
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }

    public function select_all_leads2($tableName, $select = '')
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        if($role== 1){
            $query->where($tableName.'.added_by',$user_id);
        }
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by','left');
        $query->select($tableName . '.id, ' . $tableName . '.email, tbl_users.username as username');
        $query->where($tableName .'.status !=', 8);
        $query->orderBy($tableName . '.id', 'DESC');
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }
    public function select_all_newleads2($tableName, $start, $rows_per_page, $select = '')
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        $query = $this->db->table($tableName);

        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }

        if ($role == 1) {
            $query->where($tableName . '.added_by', $user_id);
        }
        $query->where($tableName .'.status !=', 8);

        $query->where($tableName . '.status', 0)
            ->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by', 'inner')
            ->select($tableName . '.id, ' . $tableName . '.email, tbl_users.username as username')
            ->orderBy($tableName . '.id', 'DESC')
            ->limit($rows_per_page, $start);

        // echo $this->db->getLastQuery();die();   
        $results = $query->get()->getResultArray();
        //  dd($results);

        return $results;
    }

public function select_all2($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $results = $query->get()->getResultArray();

        return $results;
    }

    public function select_lost_leads($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');


        }
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by', 'left');
        $query->join('demo', 'demo.lead_id = ' . $tableName . '.id', 'left');
        $query->join('tbl_payment', 'tbl_payment.lead_id = ' . $tableName . '.id', 'left');
        $query->select(
            $tableName . '.id, ' .
            $tableName . '.email, ' .
            $tableName . '.customer_name, ' .
            $tableName . '.company_name, ' .
            $tableName . '.status, ' .
            $tableName . '.lost_date, ' .
            $tableName . '.lost_reason, ' .
            'tbl_users.username as username, ' .
            'demo.demo_date as demodate, ' .
            'demo.demo_completed_date as democompleteddate, ' .
            'COALESCE(MAX(CASE WHEN demo.status = 2 THEN demo.abort_date END), 0) as abort_date, ' .
            'tbl_payment.payment_date as paymentdate, ' .
            'COALESCE(MAX(CASE WHEN demo.status = 1 THEN demo.demo_date END), 0) as postponed_date'
        );
    
        $query->where($tableName .'.status', 9);
        $query->groupBy($tableName . '.id');
        $query->orderBy($tableName . '.id', 'DESC');  
        $results = $query->get()->getResultArray();

        // dd($results);

        return $results;
    }
    public function update_lead_status_abort($tableName, $data, $lead_id)
    {
        $leadId = $lead_id;
    
        // Check if $leadId is not empty
        if (!empty($leadId)) {
            // Update the last row in the specified table where 'id' is equal to $leadId
            // with the values provided in the $data array
            return $this->db
                ->table($tableName)
                ->where('lead_id', $leadId)
                ->orderBy('id', 'DESC') // Order by 'id' in descending order
                ->limit(1) // Limit the result to 1 row
                ->set($data)
                ->update();
        }
    
        // If $leadId is empty, return false
        return false;
    }

    public function select_all_6($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        // $query->where('status !=', 8);
        $results = $query->get()->getResultArray();

        return $results;
    }


    public function select_all($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('status !=', 8);
        $results = $query->get()->getResultArray();

        return $results;
    }

    public function select_campaign_list($tableName, $select = '*')
    {
        $query = $this->db->table($tableName);

        if ($select !== '*') {
            $query->select($select);
        }

        $query->select('campaign_id, COUNT(campaign_id) as campaign_count');
        $query->where('status !=', 8);
        $query->where('campaign_id IS NOT NULL');
        $query->groupBy('campaign_id');

        $results = $query->get()->getResultArray();

        // dd($results);
        return $results;
    }

    // public function select_campaign_deatail_list($tableName,$camp_id, $select = '')
    // {
    //     $query = $this->db->table($tableName);
    //     if ($select) {
    //         $query->select($select);
    //     } else {
    //         $query->select('*');
    //     }
    //     $query->where('status !=', 8);
    //     $query->where('status !=', 8);
    //     $results = $query->get()->getResultArray();

    //     return $results;
    // }

    public function select_campaign_deatail_list($tableName,$camp_id, $select = '')
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        $query = $this->db->table($tableName);
    
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
    
        if ($role == 1) {
            $query->where($tableName . '.added_by', $user_id);
        }
    
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by', 'left');
        $query->join('demo', 'demo.lead_id = ' . $tableName . '.id', 'left');
        $query->join('tbl_payment', 'tbl_payment.lead_id = ' . $tableName . '.id', 'left');
        $query->select(
            $tableName . '.id, ' .
            $tableName . '.email, ' .
            $tableName . '.status, ' .
            $tableName . '.lost_date, ' .
            $tableName . '.remarks, ' .
            $tableName . '.contact_remarks, ' .
            $tableName . '.delivery_remark, ' .
            'tbl_users.username as username, ' .
            'demo.demo_date as demodate, ' .
            'demo.remark as demoassigned_remark, ' .
            'demo.remark_after_demo as democompleted_remark, ' .
            'demo.demo_actual_date as democompleteddate, ' .
            'COALESCE(MAX(CASE WHEN demo.status = 2 THEN demo.abort_date END), 0) as abort_date, ' .
            'tbl_payment.payment_date as paymentdate, ' .
            'tbl_payment.payment_remarks as payment_remarks, ' .
            'COALESCE(MAX(CASE WHEN demo.status = 1 THEN demo.demo_date END), 0) as postponed_date'
        );
    
        $query->where($tableName . '.status !=', 8);
        $query->where('campaign_id',$camp_id);
        $query->groupBy($tableName . '.id');
        $query->orderBy($tableName . '.id', 'DESC');
        // $query->limit($rows_per_page, $start);
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }



    public function select_user_call_details($tableName, $added_by, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }

        $query->where('added_by', $added_by);
        $query->where('call_status', 1);
        $query->where('DATE(next_followup_date)', date('Y-m-d'));
        $results = $query->get()->getResultArray();
    
        // dd($results);
    
        return $results;
    }

    public function select_user_call_details2($tableName, $added_by, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select("$tableName.*,tbl_leads.customer_name,tbl_leads.email,tbl_leads.mobile_number");
        }
        $query->join('tbl_leads',"tbl_leads.id = $tableName.lead_id");
        $query->where("$tableName.added_by", $added_by);
        $query->where("$tableName.call_status", 1);
        $query->orderBy("DATE($tableName.next_followup_date)", date('Y-m-d'));
        $query->groupBy('lead_id');
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }
    

    public function select_call_details($tableName,$id, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('lead_id', $id);
        $query->where('call_date !=',null);
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }
    public function select_all_leadsource($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $results = $query->get()->getResultArray();

        return $results;
    }

    public function select_slots_available($tableName,$presenter, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('presented_by',$presenter);
        $query->where('status !=', 8);
        $results = $query->get()->getResultArray();

        return $results;
    }

    public function select_all_remarks($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }

    public function select_all_users($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('user_type !=', 0);
        $results = $query->get()->getResultArray();

        return $results;
    }


    public function select_all_tickets($select = '')
    {
        $query = $this->db->table('tbl_tickets as t');

        // Select the columns you need, using aggregate functions
        $query->select('MAX(t.date_time) AS date_time, MAX(t.title) AS title, MAX(t.staff) AS staff, MAX(t.priority) AS priority, MAX(t.status) AS status, t.unique_id, MAX(t.customer_id) AS customer_id');

        // Group the results by unique_id
        $query->groupBy('t.unique_id');

        $result = $query->get()->getResultArray();
        // dd($result);
        return $result;
    }


    public function close_ticket_status($uniqueId)
    {
        $this->db->table('tbl_tickets')
            ->set('status', 3)
            ->where('unique_id', $uniqueId)
            ->update();
    }
    // public function select_country_lead_join()
    // {
    //     $builder = $this->db->table('tbl_leads');
    //     $builder->groupBy('tbl_leads.country');
    //     $builder->select('*, 
    //   (SELECT COUNT(id) FROM tbl_leads WHERE tbl_countries.name = tbl_leads.country AND status!=8) AS leadcount,
    //   (SELECT COUNT(id) FROM tbl_leads WHERE tbl_countries.name = tbl_leads.country AND (status=0)AND status!=8) AS newcount,
    //   (SELECT COUNT(id) FROM tbl_leads WHERE tbl_countries.name = tbl_leads.country AND (status=1)AND status!=8) AS respondedcount,
    //   (SELECT COUNT(id) FROM tbl_leads WHERE tbl_countries.name = tbl_leads.country AND (status=2)AND status!=8) AS notrespondedcount,
    //   (SELECT COUNT(id) FROM tbl_leads WHERE tbl_countries.name = tbl_leads.country AND (status=3)AND status!=8) AS demoassignedcount,
    //   (SELECT COUNT(id) FROM tbl_leads WHERE tbl_countries.name = tbl_leads.country AND (status=4)AND status!=8) AS democompletedcount,
    //   (SELECT COUNT(id) FROM tbl_leads WHERE tbl_countries.name = tbl_leads.country AND (status=5)AND status!=8) AS demoabortedcount,
    //   (SELECT COUNT(id) FROM tbl_leads WHERE tbl_countries.name = tbl_leads.country AND (status=6 or status=7) AND status!=8) AS convertedcount', false); // Use a subquery to count leads
    //     $builder->join('tbl_countries', 'tbl_leads.country = tbl_countries.name', 'inner');
    //     // $builder->where('tbl_leads.status', 3); // You can uncomment this line if you want to filter by 'status'
    //     $query = $builder->get();
    //     // echo $this->db->getLastQuery();die();
    //     return $query->getResult();
    // }
    // 
    public function select_country_lead_join()
    {
        $builder = $this->db->table('tbl_leads');
        $builder->groupBy('tbl_leads.country');
        $builder->select('
            tbl_countries.*,
            SUM(CASE WHEN tbl_leads.status != 8 THEN 1 ELSE 0 END) AS leadcount,
            SUM(CASE WHEN tbl_leads.status = 0 AND tbl_leads.status != 8 THEN 1 ELSE 0 END) AS newcount,
            SUM(CASE WHEN tbl_leads.status = 1 AND tbl_leads.status != 8 THEN 1 ELSE 0 END) AS respondedcount,
            SUM(CASE WHEN tbl_leads.status = 2 AND tbl_leads.status != 8 THEN 1 ELSE 0 END) AS notrespondedcount,
            SUM(CASE WHEN tbl_leads.status = 3 AND tbl_leads.status != 8 THEN 1 ELSE 0 END) AS demoassignedcount,
            SUM(CASE WHEN (tbl_leads.status = 4 AND tbl_leads.status != 8 AND demo.status = 3 AND demo.presented_by != 8) THEN 1 ELSE 0 END) AS democompletedcount,
            SUM(CASE WHEN tbl_leads.status = 5 AND tbl_leads.status != 8 THEN 1 ELSE 0 END) AS demoabortedcount,
            SUM(CASE WHEN (tbl_leads.status = 6 OR tbl_leads.status = 7) AND tbl_leads.status != 8 THEN 1 ELSE 0 END) AS convertedcount
        ', false);

        $builder->join('tbl_countries', 'tbl_leads.country = tbl_countries.id', 'inner');
        $builder->join('demo', 'demo.lead_id = tbl_leads.id', 'inner');

        $query = $builder->get();

        $res = $query->getResult();
        // dd($res);
        return $res;
    }   
    


    public function getLeadsWithStatus6Or7()
    {
        return $this->db->table('tbl_leads')
            ->join('demo', 'tbl_leads.id = demo.lead_id', 'left')
            ->whereIn('tbl_leads.status', [6, 7])
            ->get()
            ->getResult();
    }



    public function delete_by_id_user($tableName, $id)
    {

        return $this->db
            ->table($tableName)
            ->where(["id" => $id])
            ->set('status', 0)
            ->update();
    }
    // public function view_all_users($tableName, $select = '')
    // {
    //     $query = $this->db->table($tableName);
    //     if ($select) {
    //         $query->select($select);
    //     } else {
    //         $query->select('*');
    //     }
    //     $query->where('user_type', 1);
    //     $query->where('status', 1);
    //     $results = $query->get()->getResultArray();

    //     return $results;
    // }
    public function select_all_delivered($tableName, $select = '')
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");

        $query = $this->db->table($tableName);

        if ($select) {
            $query->select($select);
        } else {
            $query->select($tableName . '.*, tbl_users.username as username, tbl_client_support.id as support_given'); 
        }

        if ($role == 1) {
            $query->groupStart()
                ->where($tableName . '.added_by', $user_id)
                ->orWhere($tableName . '.delivered_by', $user_id)
                ->groupEnd();
        }

        $query->where($tableName . '.status', 7)
            ->where($tableName . '.status !=', 8);

        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by');
        $query->join('tbl_client_support', 'tbl_client_support.id = ' . $tableName . '.support_giver','left');
        $query->orderBy($tableName . '.project_delivery_date', 'DESC');

        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }

    public function select_all_lead($tableName, $status)
    {
        $query = $this->db->table($tableName);

        $query->select('*');
        $query->where('status', $status);
        $results = $query->get()->getResultArray();

        return $results;
    }
    public function get_users($tableName, $user_id)
    {
        $query = $this->db->table($tableName);

        $query->select('*');
        $query->where('user_type', 1);
        $query->where('id !=', $user_id);
        $results = $query->get()->getResultArray();

        return $results;
    }

    public function count_all_demo($tableName)
    {
        return $this->db->table($tableName)->where('status !=', 2)->countAllResults();
    }



    public function select_ticket_details($tableName, $id)
    {
        $query = $this->db->table($tableName);

        $query->select('*');
        $query->where('unique_id', $id);
        $results = $query->get()->getResultArray();

        return $results;
    }


    public function select_all_openticket($tableName, $status)
    {
        $query = $this->db->table('tbl_tickets as t');
        $query->select('
            t.id,
            t.date_time,
            t.title,
            t.staff,
            t.priority,
            t.status,
            t.unique_id,
            t.customer_id,
            t.description,
            (SELECT u.username FROM tbl_users u WHERE u.id = t.customer_id) AS customer_name'
        );
        $query->where('t.status', $status);
        $query->orderBy('t.date_time', 'DESC');
        $query->groupBy('t.unique_id, t.id, t.date_time, t.title, t.staff, t.priority, t.status, t.customer_id, t.description');
        $result = $query->get()->getResultArray();
        // dd($result);
        return $result;
    }
    public function select_all_activeticket($tableName, $status, $staff)
    {

        $query = $this->db->table('tbl_tickets as t');
        $query->select('MAX(t.date_time) AS date_time, MAX(t.title) AS title, MAX(t.staff) AS staff, MAX(t.priority) AS priority, MAX(t.status) AS status, t.unique_id, MAX(t.customer_id) AS customer_id');
        $query->where('status', $status);
        $query->where('staff', $staff);
        // Group the results by unique_id
        $query->groupBy('t.unique_id');

        $result = $query->get()->getResultArray();
        return $result;
    }
    public function select_all_aborted($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('status', 5);
        $results = $query->get()->getResultArray();

        return $results;
    }
    public function view_all_leads2($tableName, $start, $rows_per_page, $select = '')
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        $query = $this->db->table($tableName);
    
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
    
        if ($role == 1) {
            $query->where($tableName . '.added_by', $user_id);
        }
    
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by', 'left');
        $query->join('demo', 'demo.lead_id = ' . $tableName . '.id', 'left');
        $query->join('tbl_payment', 'tbl_payment.lead_id = ' . $tableName . '.id', 'left');
        $query->select(
            $tableName . '.id, ' .
            $tableName . '.email, ' .
            $tableName . '.status, ' .
            $tableName . '.lost_date, ' .
            $tableName . '.remarks, ' .
            $tableName . '.contact_remarks, ' .
            $tableName . '.delivery_remark, ' .
            'tbl_users.username as username, ' .
            'demo.demo_date as demodate, ' .
            'demo.remark as demoassigned_remark, ' .
            'demo.remark_after_demo as democompleted_remark, ' .
            'demo.demo_actual_date as democompleteddate, ' .
            'COALESCE(MAX(CASE WHEN demo.status = 2 THEN demo.abort_date END), 0) as abort_date, ' .
            'tbl_payment.payment_date as paymentdate, ' .
            'tbl_payment.payment_remarks as payment_remarks, ' .
            'COALESCE(MAX(CASE WHEN demo.status = 1 THEN demo.demo_date END), 0) as postponed_date'
        );
    
        $query->where($tableName . '.status !=', 8);
        $query->groupBy($tableName . '.id');
        $query->orderBy($tableName . '.id', 'DESC');
        $query->limit($rows_per_page, $start);
    
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }
    public function search_all_viewPage($tableName,$queryTerm,$select='')
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        $query = $this->db->table($tableName);
    
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
    
        if ($role == 1) {
            $query->where($tableName . '.added_by', $user_id);
        }
    
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by', 'left');
        $query->join('demo', 'demo.lead_id = ' . $tableName . '.id', 'left');
        $query->join('tbl_payment', 'tbl_payment.lead_id = ' . $tableName . '.id', 'left');
        $query->select(
            $tableName . '.id, ' .
            $tableName . '.email, ' .
            $tableName . '.status, ' .
            $tableName . '.remarks, ' .
            $tableName . '.contact_remarks, ' .
            $tableName . '.delivery_remark, ' .
            'tbl_users.username as username, ' .
            'demo.demo_date as demodate, ' .
            'demo.demo_actual_date as democompleteddate, ' .
            'demo.remark as demoassigned_remark, ' .
            'demo.remark_after_demo as democompleted_remark, ' .
            'COALESCE(MAX(CASE WHEN demo.status = 2 THEN demo.abort_date END), 0) as abort_date, ' .
            'tbl_payment.payment_date as paymentdate, ' .
            'tbl_payment.payment_remarks as payment_remarks, ' .
            'COALESCE(MAX(CASE WHEN demo.status = 1 THEN demo.demo_date END), 0) as postponed_date'
        );

        $result = $query->groupStart()
            ->like("$tableName.customer_name", $queryTerm)
            ->orLike("$tableName.mobile_number", $queryTerm)
            ->orLike("$tableName.whatsapp_number", $queryTerm)
            ->orLike("$tableName.email", $queryTerm)
            ->groupEnd(); 
           
    
        $query->where($tableName . '.status !=', 8);
        $query->groupBy($tableName . '.id');
        // $query->orderBy($tableName . '.id', 'DESC');
    
        $results = $query->get()->getResultArray();
        //  dd($results);
        return $results;
    }
    public function select_by_leadid_demo($tableName, $id, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('lead_id', $id);
        $query->where('status', 1);
        //$query->where('status', STATUS_ACTIVE);
        $results = $query->get()->getRowArray();
        return $results;
    }
    public function select_by_paymentid($tableName, $id, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('lead_id', $id);
        //$query->where('status', 1);
        //$query->where('status', STATUS_ACTIVE);
        $query->orderBy('payment_date', 'DESC');
        $results = $query->get()->getResultArray();
        return $results;
    }
    public function join_demo_lead($id)
    {
        $builder = $this->db->table('tbl_leads');
        $builder->select('*');
        $builder->join('demo', 'tbl_leads.id = demo.lead_id', 'inner');
        $builder->where('tbl_leads.id', $id);

        $query = $builder->get();

        return $query->getResult();
    }
    public function select_all_responded($tableName, $added_by, $select = '')
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        if($role == 1){
            $query->where($tableName.'.added_by',$user_id);
        }

        $query->where($tableName.'.status', 1)
                ->where($tableName.'.status !=', 8);
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by','left');
         $query ->select($tableName . '.id, ' . $tableName . '.email, tbl_users.username as username');
        $query->orderBy($tableName . '.id', 'DESC');
      
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }
    public function search_date_wise($tableName, $start_date, $end_date, $status=[], $select="")
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        $query = $this->db->table($tableName);
    
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
    
        if ($role == 1) {
            $query->where($tableName . '.added_by', $user_id);
        }
    
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by', 'left');
        $query->join('demo', 'demo.lead_id = ' . $tableName . '.id', 'left');
        $query->join('tbl_payment', 'tbl_payment.lead_id = ' . $tableName . '.id', 'left');
        $query->select(
            $tableName . '.id, ' .
            $tableName . '.email, ' .
            $tableName . '.status, ' .
            $tableName . '.remarks, ' .
            $tableName . '.contact_remarks, ' .
            $tableName . '.delivery_remark, ' .
            'tbl_users.username as username, ' .
            'demo.demo_date as demodate, ' .
            'demo.remark as demoassigned_remark, ' .
            'demo.remark_after_demo as democompleted_remark, ' .
            'demo.demo_actual_date as democompleteddate, ' .
            'COALESCE(MAX(CASE WHEN demo.status = 2 THEN demo.abort_date END), 0) as abort_date, ' .
            'tbl_payment.payment_date as paymentdate, ' .
            'tbl_payment.payment_remarks as payment_remarks, ' .
            'COALESCE(MAX(CASE WHEN demo.status = 1 THEN demo.demo_date END), 0) as postponed_date'
        );

        $result = $query->groupStart() 
        ->where("$tableName.date >= ", $start_date)
        ->where("$tableName.date <= ", $end_date)
        ->whereIn("$tableName.status", $status)
        ->groupEnd();
           
    
        $query->where($tableName . '.status !=', 8);
        $query->groupBy($tableName . '.id');
        // $query->orderBy($tableName . '.id', 'DESC');
    
        $results = $query->get()->getResultArray();
        //  dd($results);
        return $results;
    }
    public function getFirstEntriesWithStatus3($staffUsername)
    {

        $query = $this->db->table('tbl_tickets as t');
        $query->select('MAX(t.date_time) AS date_time, MAX(t.title) AS title, MAX(t.staff) AS staff, MAX(t.priority) AS priority, MAX(t.status) AS status, t.unique_id, MAX(t.customer_id) AS customer_id, MAX(t.id) AS t_id ');
        $query->where('status', 3);
        $query->where('staff', $staffUsername);
        // Group the results by unique_id
        $query->groupBy('t.unique_id');

        $result = $query->get()->getResultArray();
        // dd($result);
        return $result;
    }


    public function select_all_demo_assigned($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        
        $query->where('status', 3);
        $results = $query->get()->getResultArray();
        // var_dump($results);dd()

        return $results;
    }
    public function select_demo_lead_join()
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");

        $builder = $this->db->table('demo');
        $builder->select('demo.*, 
                        tbl_leads.id as lead_id, 
                        tbl_leads.customer_name, 
                        tbl_leads.email,
                        tbl_leads.priority,
                        tbl_leads.mobile_number, 
                        tbl_leads.industry_type, 
                        tbl_leads.remarks, 
                        tbl_users.username as username, 
                        presented_by_user.username as presented_by_username');
        $builder->join('tbl_leads', 'demo.lead_id = tbl_leads.id', 'inner');
        $builder->join('tbl_users as presented_by_user', 'presented_by_user.id = demo.presented_by', 'left');
        $builder->where('tbl_leads.status', 3)
                ->where('tbl_leads.status !=', 8);

        if ($role == 1) {
            $builder->groupStart()
                    ->where('tbl_leads.added_by', $user_id)
                    ->orWhere('demo.presented_by', $user_id)
                    ->groupEnd();
        }

        $builder->join('tbl_users', 'tbl_users.id = tbl_leads.added_by')
                ->orderBy('demo.id', 'DESC');

        $query = $builder->get();
        $result = $query->getResult();
        // dd($result);
        return $result;
    }
    public function select_demo_lead_join1($start, $rows_per_page)
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        
        $builder = $this->db->table('demo');
        $builder->where('demo.status', 0);
        $builder->select('demo.*, tbl_leads.id as lead_id, tbl_leads.priority, tbl_leads.customer_name, tbl_leads.email, tbl_leads.company_name,  tbl_leads.mobile_number, tbl_leads.industry_type, tbl_leads.remarks, tbl_users.username as username, presented_by_user.username as presented_by_username');
        $builder->join('tbl_leads', 'demo.lead_id = tbl_leads.id', 'inner');
        
        $builder->join('tbl_users as presented_by_user', 'presented_by_user.id = demo.presented_by', 'left');
        
        $builder->where('tbl_leads.status', 3);
        if ($role == 1) {
            $builder->groupStart()
                    ->where('tbl_leads.added_by', $user_id)
                    ->orWhere('demo.presented_by', $user_id)
                    ->groupEnd();
        }

        $builder->join('tbl_users', 'tbl_users.id = tbl_leads.added_by')
                ->orderBy('demo.id', 'DESC');

        $builder->limit($rows_per_page, $start);
        $query = $builder->get();
        
        $result = $query->getResult();
       
        return $result;
    }


    public function select_demo_lead_join2($start, $rows_per_page)
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
    
        $builder = $this->db->table('demo');
        $builder->select('demo.*, tbl_leads.id as lead_id, tbl_leads.priority, presented_by_user.username as presented_by_username ,tbl_leads.customer_name, tbl_leads.email, tbl_leads.company_name, tbl_leads.mobile_number, tbl_leads.industry_type, tbl_leads.remarks, tbl_users.username as username, MAX(CASE WHEN demo.status = 0 THEN demo.language END) as demolanguage, MAX(CASE WHEN demo.status = 1 THEN demo.language END) as postponedlanguage ,MAX(CASE WHEN demo.status = 1 THEN demo.presented_by END) as postponedpresentedby, MAX(CASE WHEN demo.status = 0 THEN demo.demo_date END) as newdemo_date,
        MAX(CASE WHEN demo.status = 1 THEN demo.demo_date END) as postponed_date,
        MAX(CASE WHEN demo.status = 0 THEN demo.demo_time END) as demo_time,
        MAX(CASE WHEN demo.status = 1 THEN demo.demo_time END) as postponed_time');
    
        $builder->join('tbl_leads', 'demo.lead_id = tbl_leads.id', 'inner');
        $builder->join('tbl_users as presented_by_user', 'presented_by_user.id = demo.presented_by', 'left');

        
        $builder->where('tbl_leads.status', 3);
        if ($role == 1) {
            $builder->groupStart()
                ->where('tbl_leads.added_by', $user_id)
                ->orWhere('demo.presented_by', $user_id)
                ->groupEnd();
        }
        
        // Add GROUP BY clause to group the results by demo.id
        $builder->groupBy('tbl_leads.id');
        
        $builder->join('tbl_users', 'tbl_users.id = tbl_leads.added_by')
                ->orderBy('demo.id', 'DESC');
        
        $builder->limit($rows_per_page, $start);
        $query = $builder->get();
    
        $result = $query->getResult();
        // dd($result);
        return $result;
    }



    public function select_all_industry($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('status', 0);
        $results = $query->get()->getResultArray();

        return $results;
    }
    public function insert_to_tb($tableName, $data)
    {
        return $this->db
            ->table($tableName)
            ->insert($data);
    }

    public function update_lead_status($tableName, $where = '', $whereValue = '', $data)
    {
        if (!empty($where))

            return $this->db
                ->table($tableName)
                ->where([$where => $whereValue])
                ->set($data)
                ->update();

    }

    public function update_lead_status5($tableName, $data)
    {
        $latestId = $this->db->table($tableName)->orderBy('id', 'DESC')->limit(1)->get()->getRow()->id;
        // dd($latestId);
        if (!empty($latestId)) {
            return $this->db
                ->table($tableName)
                ->where('id', $latestId)
                ->set($data)
                ->update();
        }

        return false;
    }

    public function update_lead_status2($tableName, $where = '', $whereValue = '', $data)
    {
        if (!empty($where))

            return $this->db
                ->table($tableName)
                ->where([$where => $whereValue])
                ->where('status',0)
                ->set($data)
                ->update();

    }
    public function update_lead_status3($tableName, $where = '', $whereValue = '', $data)
    {
        if (!empty($where))

            return $this->db
                ->table($tableName)
                ->where([$where => $whereValue])
                ->where('status',0)
                ->set($data)
                ->update();

    }

    // Mymodel.php


    public function insert_to_tb_demo($table, $data)
    {
        return $this->db
            ->table($table)
            ->insert($data);

        // Optionally, you can return the last inserted ID
        // return $this->db->insert_id();
    }


    public function update_demo_status($tableName, $where = '', $whereValue = '', $data)
    {
        if (!empty($where))

            return $this->db
                ->table($tableName)
                ->where([$where => $whereValue])
                ->set($data)
                ->update();

    }
    public function select_by_id($tableName, $id, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('id', $id);
        //$query->where('status', STATUS_ACTIVE);
        $results = $query->get()->getRowArray();
        // dd($results);
        return $results;
    }

    public function select_by_id_viewmore($tableName, $id, $select = '')
    {
        $query = $this->db->table($tableName);
        
        // Specify the columns you're selecting from the main table
        if ($select) {
            $query->select($select);
        } else {
            $query->select($tableName.'.*, tbl_users.username, tbl_client_support.name as supportgiven');
        }
    
        $query->join('tbl_users', $tableName.'.added_by = tbl_users.id', 'left');
        $query->join('tbl_client_support', $tableName.'.support_giver = tbl_client_support.id', 'left');

        $query->where($tableName.'.id', $id);

        $results = $query->get()->getRowArray();

        // dd($results);
        return $results;
    }
    
    public function update_from_tb($tableName, $where = '', $whereValue = '', $data)
    {
        if (!empty($where))

            return $this->db
                ->table($tableName)
                ->where([$where => $whereValue])
                ->set($data)
                ->update();

    }
    public function delete_by_id($tableName, $id)
    {

        return $this->db
            ->table($tableName)
            ->where(["id" => $id])
            ->set('status', 8)
            ->update();
    }
    public function delete_from_demo($tableName, $id)
    {

        return $this->db
            ->table($tableName)
            ->where(["id" => $id])
            ->set('status', 8)
            ->update();
    }
    public function select_all_not_responded($tableName, $select = '')
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        if($role == 1){
            $query->where($tableName.'.added_by',$user_id);
        }
        $query->where($tableName .'.status', 2)
                ->where($tableName .'.status !=', 8);
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by','left');
        $query->select($tableName . '.id, tbl_users.username as username');
        $query->orderBy($tableName . '.id', 'DESC');
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }
    public function select_democompleted_lead_join()
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $builder = $this->db->table('tbl_leads');
        $builder->select('*');
        $builder->join('demo', ' demo.lead_id = tbl_leads.id', 'left');
        if ($role == 1) {
            $builder->groupStart()
                    ->where('tbl_leads.added_by', $user_id)
                    ->orWhere('demo.presented_by', $user_id)
                    ->groupEnd();
        }
        $builder->where('tbl_leads.status', 4)
                ->where('tbl_leads.status !=', 8);
        $builder->join('tbl_users', 'tbl_users.id = tbl_leads.added_by');
        $builder->select('tbl_leads.id, tbl_users.username as username, demo.additional_features as new_feature, demo.remark as demo_remark');
        $builder->orderBy('demo.id', 'DESC');
        $query = $builder->get();
        // echo $this->db->getLastQuery();die;
        $res= $query->getResult();
        // dd($res);
        return $res;
    }

    public function select_democompleted_lead_join1($start, $rows_per_page)
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        
        $builder = $this->db->table('tbl_leads');
        $builder->select('tbl_leads.*, tbl_users.username as username, demo_presenter.username as demo_presenter, demo.*');
        $builder->join('demo', 'demo.lead_id = tbl_leads.id AND (demo.status = 0 OR demo.status = 3)', 'left');
    
        $builder->join('tbl_users', 'tbl_users.id = tbl_leads.added_by', 'left');
    
        $builder->join('tbl_users as demo_presenter', 'demo_presenter.id = demo.presented_by', 'left');
    
        $builder->where('tbl_leads.status', 4)
                ->where('tbl_leads.status !=', 8);
    
        if ($role == 1) {
            $builder->groupStart()
                    ->where('tbl_leads.added_by', $user_id)
                    ->orWhere('demo.presented_by', $user_id)
                    ->groupEnd();
        }
    
        $builder->orderBy('demo.id', 'DESC');
        $builder->limit($rows_per_page, $start);
    
        $query = $builder->get();
        $res = $query->getResult();
        return $res;
    }
    


    public function select_payment_lead_join()
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");

        $builder = $this->db->table('tbl_leads');
        $builder->select('tbl_leads.*, tbl_payment.*, tbl_users.username as username');

        if ($role == 1) {
            $builder->groupStart()
                ->where('tbl_leads.added_by', $user_id)
                ->orWhere('tbl_payment.added_by', $user_id)
                ->groupEnd();
        }

        $builder->join('tbl_payment', 'tbl_leads.id = tbl_payment.lead_id', 'inner');
        $builder->join('tbl_users', 'tbl_users.id = tbl_leads.added_by', 'left');

        $builder->where('tbl_leads.status', 6)
                ->where('tbl_leads.status !=', 8);

        $builder->orderBy('tbl_leads.id', 'DESC');

        // Uncomment the following line for debugging
        // echo $this->db->getLastQuery();

        $query = $builder->get();
        $res = $query->getResult();
        // dd($res);
        return $res;
    }



    public function getLastEntryForEachLeadId()
    {
        $query = $this->db->table('tbl_payment');
        $query->select('lead_id, MAX(payment_date) AS last_payment_date');
        $query->groupBy('lead_id');

        $results = $query->get()->getResult();

        $lastEntries = [];

        foreach ($results as $row) {
            $lastEntryQuery = $this->db->table('tbl_payment')
                ->where('lead_id', $row->lead_id)
                ->where('payment_date', $row->last_payment_date)
                ->get();

            $lastEntry = $lastEntryQuery->getRow();

            if ($lastEntry) {
                $lastEntries[] = $lastEntry;
            }
        }

        return $lastEntries;
    }
    public function search_payment_received($query)
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        $builder = $this->db->table('tbl_leads');
        $builder->select('tbl_leads.*, tbl_payment.*, tbl_users.username'); 
        $builder->join('tbl_payment', 'tbl_leads.id = tbl_payment.lead_id', 'inner');
        $builder->join('tbl_users', 'tbl_users.id = tbl_leads.added_by', 'inner');
        $builder->where('tbl_leads.status', 6);
        $builder->where('tbl_users.status', 1);
        if ($role == 1) {
            $builder->groupStart()
                ->where('tbl_leads.added_by', $user_id)
                ->orWhere('tbl_payment.added_by', $user_id)
                ->groupEnd();
        }

        if ($query !== '') {
            $builder->groupStart(); 
            $builder->like('customer_name', $query);
            $builder->orLike('mobile_number', $query);
            $builder->groupEnd(); 
        }

        $query = $builder->get();
        return $query->getResult();
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
    public function delete_from_payment($tableName, $id)
    {

        return $this->db
            ->table($tableName)
            ->where(["lead_id" => $id])
            //->set('status', 1)
            ->delete();
    }
    public function individual_payment($id)
    {
        $builder = $this->db->table('tbl_payment');
        $builder->select('*');
        $builder->where('lead_id', $id);
        $query = $builder->get();
        return $query->getResult();
    }
    public function select_deliverd_lead_join()
    {
        $builder = $this->db->table('tbl_leads');
        $builder->select('*');
        $builder->join('tbl_payment', 'tbl_leads.id = tbl_payment.lead_id', 'inner');
        $builder->where('tbl_leads.status', 7);
        $builder->distinct('tbl_payment.lead_id'); // Add DISTINCT to select unique lead_ids
        $query = $builder->get();

        return $query->getResult();
    }

    public function search_delivered($query)
    {
        $builder = $this->db->table('tbl_leads');
        $builder->select('*');
        $builder->join('tbl_payment', 'tbl_leads.id = tbl_payment.lead_id', 'inner');
        $builder->where('tbl_leads.status', 7);

        if (!empty($query)) {
            $builder->like('customer_name', $query)
                ->orLike('mobile_number', $query);
        }

        $result = $builder->get();

        return $result->getResult();
    }


    public function search_demoaborted($query)
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        $builder = $this->db->table('tbl_leads');
        $builder->select('*');
        $builder->join('demo','tbl_leads.id = demo.lead_id', 'inner');
        $builder->join('tbl_users', 'tbl_users.id = tbl_leads.added_by');
        $builder->select('tbl_leads.id, tbl_users.username as username');
        $builder->orderBy('tbl_leads.id', 'DESC');
        $builder->where('tbl_leads.status', 5);

        if ($query !== '') {
            $builder->groupStart(); // Begin a group for OR conditions
            $builder->like('customer_name', $query);
            $builder->orLike('mobile_number', $query);
            $builder->groupEnd(); // End the OR group
        }
        if ($role == 1) {
            $builder->groupStart()
                    ->where('tbl_leads.added_by', $user_id)
                    ->orWhere('demo.presented_by', $user_id)
                    ->groupEnd();
        }

        $query = $builder->get();
        return $query->getResult();
    }


    public function select_all_leads($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        //$query->where('status', 0);
        $results = $query->get()->getResultArray();

        return $results;
    }
    public function view_all_leads($tableName, $select = '')
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }

        if($role == 1){
            $query->where($tableName.'.added_by',$user_id);
        }

        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by','left');
        $query->select($tableName . '.id, ' . $tableName . '.email, tbl_users.username as username');
        $query->where($tableName .'.status !=', 8);
        $query->orderBy($tableName . '.id', 'DESC');
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }

    public function search_daily_wise($table, $to_date, $lead_status)
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
    
        $builder = $this->db->table($table);
        $builder->select("$table.*, tbl_users.username as username,demo.abort_date, demo.demo_date as demodate, demo.demo_actual_date as democompleteddate, tbl_payment.payment_date as paymentdate");
    
        if ($role == 1) {
            $builder->where("$table.added_by", $user_id);
        }
    
        $builder->join('tbl_users', "tbl_users.id = $table.added_by", 'left');
        $builder->join('tbl_payment', 'tbl_payment.lead_id = ' . $table. '.id','left');
        $builder->join('demo', 'demo.lead_id = ' . $table . '.id AND (demo.status = 0 OR demo.status = 3)','left');
    
        $result = $builder->groupStart() 
            ->where("$table.date <= ", $to_date)
            ->whereIn("$table.status", $lead_status)
            ->groupEnd();
    
        foreach ($lead_status as $status) {
            if ($status == 0) {
                $result->orderBy("$table.date", "ASC");
            }
            elseif($status == 1)
            {
                $result->orderBy("$table.contact_date", "ASC");
            }
            elseif($status == 2)
            {
                $result->orderBy("$table.contact_date", "ASC");
            }
            elseif($status == 3)
            {
                $result->orderBy("demodate", "ASC");
            }
            elseif($status == 4)
            {
                $result->orderBy("democompleteddate", "ASC");
            }
            elseif($status == 5)
            {
                $result->orderBy("demo.abort_date", "ASC");
            }
            elseif($status == 6)
            {
                $result->orderBy("paymentdate", "ASC");
            }
            elseif($status == 7)
            {
                $result->orderBy("$table.project_delivery_date", "ASC");
            }


        }
        
        $result = $result->get()->getResultArray();
        // dd($result);
        return $result;
    }
   


    
    
    public function view_all_leads1($tableName,$start,$rows_per_page, $select = '')
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        if($role == 1){
            $query->where($tableName.'.added_by',$user_id);
        }
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by','left');
        $query->join('demo', 'demo.lead_id = ' . $tableName . '.id AND (demo.status = 0 OR demo.status = 3  OR demo.status = 2 )', 'left');
        $query->join('tbl_payment', 'tbl_payment.lead_id = ' . $tableName . '.id','left');
        $query->select($tableName . '.id, ' . $tableName . '.email,' . $tableName . '.company_name,' . $tableName . '.status, tbl_users.username as username, demo.demo_date as demodate, demo.demo_completed_date as democompleteddate, demo.abort_date as aborted_date, tbl_payment.payment_date as paymentdate');
        $query->where($tableName .'.status !=', 8);
        $query->orderBy($tableName . '.id', 'DESC');
        $query->limit($rows_per_page, $start);
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }
   
    public function view_all_leads3($tableName, $select = '')
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        $query = $this->db->table($tableName);
    
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
    
        if ($role == 1) {
            $query->where($tableName . '.added_by', $user_id);
        }
    
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by', 'left');
        $query->join('demo', 'demo.lead_id = ' . $tableName . '.id', 'left');
        $query->join('tbl_payment', 'tbl_payment.lead_id = ' . $tableName . '.id', 'left');
        $query->select(
            $tableName . '.id, ' .
            $tableName . '.email, ' .
            $tableName . '.status, ' .
            'tbl_users.username as username, ' .
            'demo.demo_date as demodate, ' .
            'demo.demo_completed_date as democompleteddate, ' .
            'COALESCE(MAX(CASE WHEN demo.status = 2 THEN demo.abort_date END), 0) as abort_date, ' .
            'tbl_payment.payment_date as paymentdate, ' .
            'COALESCE(MAX(CASE WHEN demo.status = 1 THEN demo.demo_date END), 0) as postponed_date'
        );
    
        $query->where($tableName . '.status !=', 8);
        $query->groupBy($tableName . '.id');
        $query->orderBy($tableName . '.id', 'DESC');
        
    
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }
    

    public function search_all($table, $queryTerm)
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");

        $builder = $this->db->table($table);
        $builder->select("$table.*, tbl_users.username as username,demo.abort_date, demo.demo_date as demodate, demo.demo_completed_date as democompleteddate, tbl_payment.payment_date as paymentdate");
        $builder->where($table.'.status !=',8);

        if ($role == 1) {
            $builder->where($table.'.added_by', $user_id);
        }

        $builder->join('tbl_users', "tbl_users.id = $table.added_by", 'left');
        $builder->join('tbl_payment', 'tbl_payment.lead_id = ' . $table. '.id','left');
        $builder->join('demo', 'demo.lead_id = ' . $table . '.id AND (demo.status = 0 OR demo.status = 3 OR demo.status = 2)','left');

        $result = $builder->groupStart()
            ->like("$table.customer_name", $queryTerm)
            ->orLike("$table.mobile_number", $queryTerm)
            ->orLike("$table.email", $queryTerm)
            ->groupEnd() // End the group for OR conditions
            ->get()
            ->getResultArray();
            //   dd($result);
        return $result;

    }

    public function select_by_leadid($tableName, $id, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('lead_id', $id);
        //$query->where('status', STATUS_ACTIVE);
        $results = $query->get()->getRowArray();
        return $results;
    }
    public function select_by_leadids($tableName, $id, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('id', $id);
        //$query->where('status', STATUS_ACTIVE);
        $results = $query->get()->getRowArray();
        return $results;
    }
    public function select_by_lead_id($tableName, $id, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('lead_id', $id);
        //$query->where('status', STATUS_ACTIVE);
        $results = $query->get()->getResultArray();
        return $results;
    }

    public function select_by_lead_liveUpdate($tableName, $id, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('lead_id', $id);
        $query->where('call_status',0);
        // $query->where('status', STATUS_ACTIVE);
        $results = $query->get()->getResultArray();
        return $results;
    }
    public function select_history_by_id($tableName, $id, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        // $query->where('type',1);
        $query->where('lead_id', $id);
        //$query->where('status', STATUS_ACTIVE);
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }
    public function select_by_all_leadid_demo($tableName, $id, $select = '')
    {
        // dd($id);
        // Ensure $tableName is sanitized to prevent SQL injection
        $tableName = $this->db->escapeString($tableName);

        $query = $this->db->table($tableName);

        if ($select) {
            $query->select($select);
        } else {
            $query->select("$tableName.*, demo_presenter.username as presenter");
        }
        $query->where('lead_id', $id);
        $query->whereIn($tableName.'.status', [0,3,2]);
        $query->join('tbl_users as demo_presenter', "demo_presenter.id = $tableName.presented_by");

        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }

    public function select_by_all_leadid_aborted($tableName, $id, $select = '')
    {
        // dd($id);
        // Ensure $tableName is sanitized to prevent SQL injection
        $tableName = $this->db->escapeString($tableName);

        $query = $this->db->table($tableName);

        if ($select) {
            $query->select($select);
        } else {
            $query->select("$tableName.*");
        }
        $query->where('lead_id', $id);
        $query->where($tableName.'.status',2);
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }

    public function select_by_all_leadid_demo_postponed($tableName, $id, $select = '')
    {
        // Ensure $tableName is sanitized to prevent SQL injection
        $tableName = $this->db->escapeString($tableName);
        $countQuery = "SELECT COUNT(*) as count FROM $tableName WHERE lead_id = $id";
        $count = $this->db->query($countQuery)->getRowArray()['count'];
        $query = $this->db->table($tableName);

        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }

        $query->whereIn("$tableName.status", [1, 2]);
        $query->where('lead_id', $id);

        $query->orderBy("$tableName.id", 'desc');
        $results = $query->get()->getResultArray();
        $results['count'] = $count;
        // dd($results);
        return $results;
    }




    public function getDistinctLeadsWithLatestStatusZero($tableName)
    {
        $builder = $this->db->table($tableName);
        $builder->select('demo_date, MAX(status) as latest_status');
        $builder->where('status', 0);
        $builder->groupBy('lead_id');
        $query = $builder->get();

        return $query->getResult();
    }
    public function getLastEntryForEachLeadIdWithStatusZero()
    {
        $db = db_connect();

        // Subquery to get the maximum demo_date for each lead_id with status=0
        $subquery = $db->table('demo')
            ->select('lead_id, MAX(demo_date) AS max_date')
            ->where('status', 0)
            ->groupBy('lead_id')
            ->get();

        $maxDates = $subquery->getResult();

        // Create an array to store the last entries
        $lastEntries = [];

        foreach ($maxDates as $row) {
            // Retrieve the last entry for each lead_id based on the max demo_date and status=0
            $entry = $db->table('demo')
                ->join('tbl_leads', 'tbl_leads.id = demo.lead_id')
                ->select('demo.*, tbl_leads.*')
                ->where('demo.lead_id', $row->lead_id)
                ->where('demo.status', 0)
                ->where('tbl_leads.status', 3)
                ->where('demo.demo_date', $row->max_date)
                ->get()
                ->getRow();

            // Add the entry to the result array
            if ($entry) {
                $lastEntries[] = $entry;
            }
        }

        return $lastEntries;
    }
    public function join_payment_lead()
    {
        $builder = $this->db->table('tbl_leads');
        $builder->select('*');
        $builder->join('tbl_payment', 'tbl_leads.id = tbl_payment.lead_id', 'inner');
        //$builder->where('tbl_leads.status', 5);
        $query = $builder->get();

        return $query->getResult();
    }

    public function selects_all($tableName, $added_by, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('added_by', $added_by);
        $query->where('status !=',8);
        $results = $query->get()->getResultArray();

        return $results;
    }
    public function selects_all_lead($tableName, $status, $added_by)
    {
        $query = $this->db->table($tableName);

        $query->select('*');
        $query->where('status', $status);
        $query->where('added_by', $added_by);
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }
    public function select_all_ticket($tableName)
    {
        $query = $this->db->table($tableName);

        $query->select('*');
        $query->where('status', 1);
        //$query->where('added_by', $added_by);
        $results = $query->get()->getResultArray();

        return $results;
    }
    public function selects_all_tickt($tableName, $staff)
    {
        $query = $this->db->table($tableName);

        $query->select('*');
        $query->where('status', 2);
        $query->where('staff', $staff);
        $results = $query->get()->getResultArray();

        return $results;
    }
    public function selects_all_closedtickt($tableName, $staff)
    {
        $query = $this->db->table($tableName);

        $query->select('*');
        $query->where('status', 3);
        $query->where('staff', $staff);
        $results = $query->get()->getResultArray();

        return $results;
    }
    public function view_all_users($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->where('user_type', 1);
        $query->whereIn('status', [1, 3]);
        $results = $query->get()->getResultArray();

        return $results;
    }
    public function select_payment_methods($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $results = $query->get()->getResultArray();

        return $results;
    }
    public function getMonthwiseDetails2($year)
    {

        if($year){
            $currentYear=$year;
        }else{
            $currentYear=date('Y');
        }
        

        $query = $this->db->table('tbl_leads')
        ->select('MONTH(date) as month, COUNT(*) as total_leads')
        ->where('YEAR(date)', $currentYear)
        ->whereNotIn('tbl_leads.status', [8]) 
        ->groupBy('month')
        ->getCompiledSelect();

        $query2 = $this->db->table('demo')
            ->select('MONTH(demo_date) as month, COUNT(*) as total_demo')
            ->join('tbl_leads', 'demo.lead_id = tbl_leads.id AND (demo.status = 0 OR demo.status = 3)', 'left')
            ->where('YEAR(demo_date)', $currentYear)
            ->whereIn('tbl_leads.status', [4,6, 7]) 
            ->groupBy('month')
            ->getCompiledSelect();

        $mainQuery = $this->db->table("($query) m1")
            ->select('m1.month, m1.total_leads, m2.total_demo')
            ->join("($query2) m2", 'm1.month = m2.month', 'left');

        $results = $mainQuery->get()->getResultArray();

        foreach ($results as &$result) {
            $result['converted_leads'] = $this->db->table('tbl_payment')
                ->where('MONTH(payment_date)', $result['month'])
                ->where('YEAR(payment_date)', $currentYear)
                ->countAllResults();

            // Avoid division by zero error
            $result['conversion_rate1'] = ($result['total_leads'] > 0)
                ? ($result['converted_leads'] / $result['total_leads']) * 100
                : 0;

             $result['conversion_rate2'] = ($result['total_demo'] > 0)
                ? ($result['converted_leads'] / $result['total_demo']) * 100
                : 0;    
        }

        // dd($results);

        return $results;
    }
    public function getMonthwiseDetails($year)
    {

        if($year){
            $currentYear=$year;
        }else{
            $currentYear=date('Y');
        }
        

                $query = $this->db->table('tbl_leads')
                ->select('MONTH(date) as month, COUNT(*) as total_leads')
                ->where('YEAR(date)', $currentYear)
                ->whereNotIn('tbl_leads.status', [8]) 
                ->groupBy('month')
                ->getCompiledSelect();

                // $query2 = $this->db->table('demo')
                //     ->select('MONTH(demo_date) as month, COUNT(*) as total_demo')
                //     ->join('tbl_leads', 'demo.lead_id = tbl_leads.id AND (demo.status = 3 AND demo.presented_by != 8)', 'left')
                //      ->join('demo', 'demo.lead_id = tbl_leads.id', 'inner')
                //     ->where('YEAR(demo_date)', $currentYear)
                //     ->whereIn('tbl_leads.status', [4,6, 7]) 
                //     ->groupBy('month')
                //     ->getCompiledSelect();
                $query2 = $this->db->table('demo')
                ->select('MONTH(d2.demo_date) as month, COUNT(*) as total_demo') // <-- Specify the alias for demo_date
                ->join('tbl_leads', 'demo.lead_id = tbl_leads.id AND (demo.status = 3 AND demo.presented_by != 8)', 'left')
                ->join('demo AS d2', 'd2.lead_id = tbl_leads.id', 'inner')
                ->where('YEAR(d2.demo_date)', $currentYear) // <-- Use the alias here as well
                ->whereIn('tbl_leads.status', [4, 6, 7])
                ->groupBy('month')
                ->getCompiledSelect();


        $mainQuery = $this->db->table("($query) m1")
            ->select('m1.month, m1.total_leads, m2.total_demo')
            ->join("($query2) m2", 'm1.month = m2.month', 'inner');

        $results = $mainQuery->get()->getResultArray();

        foreach ($results as &$result) {
            $result['converted_leads'] = $this->db->table('tbl_payment')
                ->where('MONTH(payment_date)', $result['month'])
                ->where('YEAR(payment_date)', $currentYear)
                ->countAllResults();

            // Avoid division by zero error
            $result['conversion_rate1'] = ($result['total_leads'] > 0)
                ? ($result['converted_leads'] / $result['total_leads']) * 100
                : 0;

             $result['conversion_rate2'] = ($result['total_demo'] > 0)
                ? ($result['converted_leads'] / $result['total_demo']) * 100
                : 0;    
        }

        // dd($results);

        return $results;
    }

    public function getTotalDemosByPresenter()
    {
        $builder = $this->db->table('demo');

        $builder->select([
            'presenter.username as presented_by',
            'presenter.id as presenter',
            'COUNT(DISTINCT demo.lead_id) as total_demos',
            'COUNT(DISTINCT CASE WHEN tbl_leads.status IN (6, 7) AND demo.status IN (3) THEN demo.lead_id END) as total_converted_leads'
        ]);

        
        $builder->whereIn('demo.status', [3]);
        $builder->groupBy('presented_by');

        $builder->join('tbl_users presenter', 'presenter.id = demo.presented_by', 'left');
        $builder->join('tbl_leads', 'tbl_leads.id = demo.lead_id', 'left');

        $query = $builder->get();
        $results = $query->getResultArray();
        foreach ($results as &$result) {

            // Avoid division by zero error
            $result['conversion_rate'] = ($result['total_demos'] > 0)
                ? ($result['total_converted_leads'] / $result['total_demos']) * 100
                : 0;
        }
        // echo $this->db->getLastQuery();die;
        // dd($results);
        return $results;
    }



    public function select_all_responded2($start, $rows_per_page, $tableName, $added_by, $select = '')
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        if($role == 1){
            $query->where($tableName.'.added_by',$user_id);
        }
        $query->where($tableName.'.status', 1)
                ->where($tableName.'.status !=', 8);
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by','left');
        $query ->select($tableName . '.id, ' . $tableName . '.email, tbl_users.username as username');
        $query->orderBy($tableName . '.id', 'DESC');
        $query->limit($rows_per_page, $start);
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }

    public function select_demoaborted_lead_join($added_by)
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $builder = $this->db->table('tbl_leads');
        $builder->select('*');
        if($role == 1){
            $builder->where('tbl_leads.added_by',$user_id);
        }
        $builder->join('demo', 'tbl_leads.id = demo.lead_id AND demo.status = 2 ', 'left');
        $builder->join('tbl_users', 'tbl_users.id = tbl_leads.added_by');
        $builder->select('tbl_users.username as username');
        $builder->orderBy('tbl_leads.id', 'DESC');
        $builder->where('tbl_leads.status', 5);
        // $builder->where('demo.status', 2);
        $builder->where('tbl_leads.added_by', $added_by);
        $query = $builder->get();
        return $query->getResult();
    }

    public function select_demoaborted_lead_join1($start, $rows_per_page, $added_by)
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $builder = $this->db->table('tbl_leads');
        $builder->select('*');
        if($role == 1){
            $builder->where('tbl_leads.added_by',$user_id);
        }
        $builder->join('demo','tbl_leads.id = demo.lead_id AND demo.status = 2', 'left');
        $builder->join('tbl_users', 'tbl_users.id = tbl_leads.added_by');
        $builder->select('tbl_leads.id, tbl_users.username as username');
        $builder->orderBy('tbl_leads.id', 'DESC');
        $builder->where('tbl_leads.status', 5);
        // $builder->where('demo.status', 2);
        // $builder->where('tbl_leads.added_by', $added_by);
        $builder->limit($rows_per_page, $start);
        $query = $builder->get();
        
        $res= $query->getResult();
        //  dd($res);
        return $res;
    }
    public function select_all_not_responded2($start, $rows_per_page, $tableName, $added, $select = '')
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        if($role == 1){
            $query->where($tableName.'.added_by',$user_id);
        }
        $query->where($tableName .'.status', 2)
                ->where($tableName .'.status !=', 8);
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by','left');
        $query->select($tableName . '.id, tbl_users.username as username');
        $query->orderBy($tableName . '.id', 'DESC');
        $query->limit($rows_per_page, $start);
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }

  

    public function count_daily_leads($tableName)
    {
        $query = $this->db->table($tableName);
        $query->where('status !=',8);
        $query->where('DATE(date)', date('Y-m-d'));
        return $query->countAllResults();
    }


    public function select_monthwise_leads($tableName, $select = '')
    {
        $query = $this->db->table($tableName);
        $query->where('status !=',8);
        $query->where('MONTH(date)', date('m'));

        return $query->countAllResults();
    }
    public function yesterday_leads($tableName)
    {
        $query = $this->db->table($tableName);
        $query->where('status !=',8);
        $query->where('date >=', date('Y-m-d', strtotime('yesterday')));
        $query->where('date <', date('Y-m-d'));
        
        return $query->countAllResults();
    }

    public function yesterday_demo($tableName)
    {
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*, demo.demo_date');
        $query->join('demo', $tableName.'.id = demo.lead_id AND (demo.status = 3)');
        $query->whereIn($tableName.'.status', [4, 6, 7]);
        $query->where('demo.presented_by !=', 8);
        $query->where('demo_date >=', date('Y-m-d', strtotime('yesterday')));
        $query->where('demo_date <', date('Y-m-d'));
        
        return $query->countAllResults();
    }

    public function yesterday_closed($tableName)
    {
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*,tbl_payment.payment_date');
        $query->join('tbl_payment',$tableName.'.id = tbl_payment.lead_id');
        $query->whereIn($tableName.'.status', [6, 7]);
        $query->where($tableName.'.status !=',8);
        $query->where('payment_date >=', date('Y-m-d', strtotime('yesterday')));
        $query->where('payment_date <', date('Y-m-d'));
        
        return $query->countAllResults();
    }

    public function lastmonth_leads($tableName)
    {
        $query = $this->db->table($tableName);
        $query->where('status !=',8);
        // Get the first day of the current month
        $firstDayOfCurrentMonth = date('Y-m-01');

        // Calculate the first day of the previous month
        $firstDayOfPreviousMonth = date('Y-m-01', strtotime('-1 month'));

        // Set the condition to include leads created between the first day of the previous month and the first day of the current month
        $query->where('date >=', $firstDayOfPreviousMonth);
        $query->where('date <', $firstDayOfCurrentMonth);
        
        return $query->countAllResults();
    }

    public function lastmonth_demo($tableName)
    {
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*,demo.demo_date');
        $query->join('demo',$tableName.'.id=demo.lead_id AND (demo.status = 3)');
        $query->whereIn($tableName.'.status', [4, 6, 7]);
        $query->where('demo.presented_by !=', 8);
        $firstDayOfCurrentMonth = date('Y-m-01');

        // Calculate the first day of the previous month
        $firstDayOfPreviousMonth = date('Y-m-01', strtotime('-1 month'));

        $query->where('demo_date >=', $firstDayOfPreviousMonth);
        $query->where('demo_date <', $firstDayOfCurrentMonth);
        
        return $query->countAllResults();
    }

    public function lastmonth_closed($tableName)
    {
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*,tbl_payment.payment_date');
        $query->join('tbl_payment',$tableName.'.id = tbl_payment.lead_id');

        $query->whereIn($tableName.'.status', [6, 7]);
        $firstDayOfCurrentMonth = date('Y-m-01');

        // Calculate the first day of the previous month
        $firstDayOfPreviousMonth = date('Y-m-01', strtotime('-1 month'));
        // Set the condition to include leads created between the first day of the previous month and the first day of the current month
        $query->where('payment_date >=', $firstDayOfPreviousMonth);
        $query->where('payment_date <', $firstDayOfCurrentMonth);
        
        return $query->countAllResults();
    }


    public function total_closed_leads($tableName){
        $query = $this->db->table($tableName);
        $query->where('status !=',8);
        $query->whereIn('status', [6, 7]);

        return $query->countAllResults();
    }

    public function count_daily_demo($tableName){
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*, demo.demo_date');
        $query->join('demo', $tableName.'.id = demo.lead_id AND (demo.status = 3)');
        $query->whereIn($tableName.'.status', [4, 6, 7]);
        $query->where('demo.presented_by !=', 8);
       

        $query->where('DATE(demo.demo_date)', date('Y-m-d'));
        return $query->countAllResults();
    }
    public function count_monthwise_demo($tableName){
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*,demo.demo_date');
        $query->join('demo',$tableName.'.id=demo.lead_id AND (demo.status = 3)');
        $query->whereIn($tableName.'.status', [4, 6, 7]);
        $query->where('demo.presented_by !=', 8);
        $query->where('MONTH(demo_date)', date('m'));
        return $query->countAllResults();
    }

    public function count_daily_closing($tableName){
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*,tbl_payment.payment_date');
        $query->join('tbl_payment',$tableName.'.id = tbl_payment.lead_id');
        $query->where('status !=',8);
        $query->whereIn('status', [6, 7]); 
        $query->where('DATE(payment_date)', date('Y-m-d'));
        return $query->countAllResults();
    }

    public function count_monthwise_closing($tableName){
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*,tbl_payment.payment_date');
        $query->join('tbl_payment',$tableName.'.id = tbl_payment.lead_id','left');
        $query->whereIn('status', [6, 7]); 
        $query->where('MONTH(payment_date)', date('m'));
        return $query->countAllResults();
    }
    // 

    public function todaylead_byId($tableName,$id)
    {
        $query = $this->db->table($tableName);
        $query->where('status !=',8);
        $query->where('added_by',$id);
        $query->where('DATE(date)', date('Y-m-d'));
        $query->where('status !=',8);
        $result= $query->countAllResults();
        return $result;
    }

    public function todaydemo_byId($tableName, $id){
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*, demo.demo_date');
        $query->join('demo', $tableName.'.id = demo.lead_id AND (demo.status = 0 OR demo.status = 3)');
        $query->where($tableName.'.added_by', $id);
        $query->whereIn($tableName.'.status', [4, 6, 7]);
        $query->where('demo.presented_by !=', 8);
        $query->where('DATE(demo.demo_date)', date('Y-m-d'));
        $result = $query->countAllResults();
        return $result;
    }

    public function todayclosed_byId($tableName,$id){
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*,tbl_payment.payment_date');
        $query->join('tbl_payment',$tableName.'.id = tbl_payment.lead_id');
        $query->where($tableName.'.added_by',$id);
        $query->where($tableName.'.status !=',8);
        $query->whereIn($tableName.'.status', [6, 7]); 
        $query->where('DATE(payment_date)', date('Y-m-d'));
        //  echo $this->db->getLastQuery();die;
        return $query->countAllResults();
    }


    public function yesterdaylead_byId($tableName,$id)
    {
        $query = $this->db->table($tableName);
        $query->where('added_by',$id);
        $query->where('status !=',8);
        $query->where('date >=', date('Y-m-d', strtotime('yesterday')));
        $query->where('date <', date('Y-m-d'));
        
        return $query->countAllResults();
    }

    public function yesterdaydemo_byId($tableName,$id)
    {
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*, demo.demo_date');
        $query->join('demo',$tableName.'.id=demo.lead_id AND (demo.status = 0 OR demo.status = 3)');
        $query->where($tableName.'.added_by',$id);
        $query->whereIn($tableName.'.status', [4, 6, 7]);
        $query->where('demo.presented_by !=', 8);
        $query->where('demo_date >=', date('Y-m-d', strtotime('yesterday')));
        $query->where('demo_date <', date('Y-m-d')); 
        $result= $query->countAllResults();
        return $result;
    }

    public function yesterdayclosed_byId($tableName,$id)
    {
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*,tbl_payment.payment_date');
        $query->join('tbl_payment',$tableName.'.id = tbl_payment.lead_id');
        $query->where($tableName.'.added_by',$id);
        $query->whereIn($tableName.'.status', [6, 7]);
        $query->where($tableName.'.status !=',8);
        $query->where('payment_date >=', date('Y-m-d', strtotime('yesterday')));
        $query->where('payment_date <', date('Y-m-d'));
        
        return $query->countAllResults();
    }


    public function monthlylead_byId($tableName,$id, $select = '')
    {
        $query = $this->db->table($tableName);
        $query->where('added_by',$id);
        $query->where('status !=',8);
        $query->where('MONTH(date)', date('m'));

        return $query->countAllResults();
    }

    public function monthlydemo_byId($tableName,$id){
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*,demo.demo_date');
        $query->join('demo',$tableName.'.id=demo.lead_id AND (demo.status = 0 OR demo.status = 3)');
        $query->where($tableName.'.added_by',$id);
        $query->whereIn($tableName.'.status', [4, 6, 7]);
        $query->where('demo.presented_by !=', 8);
        $query->where('MONTH(demo_date)', date('m'));
        return $query->countAllResults();
    }

    public function monthlyclosed_byId($tableName,$id){
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*,tbl_payment.payment_date');
        $query->join('tbl_payment',$tableName.'.id = tbl_payment.lead_id');
        $query->where($tableName.'.added_by',$id);
        $query->where($tableName.'.status !=',8);
        $query->whereIn($tableName.'.status', [6, 7]); 
        $query->where('MONTH(payment_date)', date('m'));
        return $query->countAllResults();
    }

    public function lastmonthlead_byId($tableName,$id)
    {
        $query = $this->db->table($tableName);
        $query->where('added_by',$id);
        $query->where('status !=',8);
        // Get the first day of the current month
        $firstDayOfCurrentMonth = date('Y-m-01');

        // Calculate the first day of the previous month
        $firstDayOfPreviousMonth = date('Y-m-01', strtotime('-1 month'));

        // Set the condition to include leads created between the first day of the previous month and the first day of the current month
        $query->where('date >=', $firstDayOfPreviousMonth);
        $query->where('date <', $firstDayOfCurrentMonth);
        
        return $query->countAllResults();
    }

    public function lastmonthdemo_byId($tableName,$id)
    {
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*,demo.demo_date');
        $query->join('demo',$tableName.'.id=demo.lead_id AND (demo.status = 0 OR demo.status = 3)');
        $query->where($tableName.'.added_by',$id);
        $query->whereIn($tableName.'.status', [4, 6, 7]);
        $query->where('demo.presented_by !=', 8);
        $firstDayOfCurrentMonth = date('Y-m-01');

        $firstDayOfPreviousMonth = date('Y-m-01', strtotime('-1 month'));

        $query->where('demo_date >=', $firstDayOfPreviousMonth);
        $query->where('demo_date <', $firstDayOfCurrentMonth);
        
        return $query->countAllResults();
    }

    public function lastmonthclosed_byId($tableName,$id)
    {
        $query = $this->db->table($tableName);
        $query->select($tableName.'.*,tbl_payment.payment_date');
        $query->join('tbl_payment',$tableName.'.id = tbl_payment.lead_id');
        $query->where($tableName.'.added_by',$id);
        $query->whereIn($tableName.'.status', [6, 7]);
        $query->where($tableName.'.status !=',8);
        $firstDayOfCurrentMonth = date('Y-m-01');

        // Calculate the first day of the previous month
        $firstDayOfPreviousMonth = date('Y-m-01', strtotime('-1 month'));

        // Set the condition to include leads created between the first day of the previous month and the first day of the current month
        $query->where('payment_date >=', $firstDayOfPreviousMonth);
        $query->where('payment_date <', $firstDayOfCurrentMonth);
        
        return $query->countAllResults();
    }

    public function select_today_demo_lead_join()
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
    
        $builder = $this->db->table('demo');
        $builder->select('demo.*, 
                        tbl_leads.id as lead_id, 
                        tbl_leads.customer_name, 
                        tbl_leads.email, 
                        tbl_leads.mobile_number, 
                        tbl_leads.industry_type, 
                        tbl_leads.remarks, 
                        tbl_users.username as username,
                        presented_by_user.username as presented_by_username,
                        assigned_by.username as assigned_by,
                        tbl_industry.industry_type,
                        MAX(CASE WHEN demo.status = 0 THEN demo.demo_date END) as newdemo_date,
                        MAX(CASE WHEN demo.status = 1 THEN demo.demo_date END) as postponed_date,
                        MAX(CASE WHEN demo.status = 0 THEN demo.demo_time END) as demo_time,
                        MAX(CASE WHEN demo.status = 1 THEN demo.demo_time END) as postponed_time');
        
        $builder->join('tbl_leads', 'demo.lead_id = tbl_leads.id', 'inner');
        $builder->join('tbl_industry', 'tbl_leads.industry_type = tbl_industry.id', 'left');
        $builder->join('tbl_users as assigned_by', 'assigned_by.id = demo.added_by', 'left');
        $builder->join('tbl_users as presented_by_user', 'presented_by_user.id = demo.presented_by', 'left');
        $builder->join('tbl_users', 'tbl_users.id = tbl_leads.added_by');
    
        $builder->where('tbl_leads.status', 3)
                ->whereIn('demo.status', [0, 1])
                ->where('tbl_leads.status !=', 8);
    
        if ($role == 1) {
            $builder->groupStart()
                    ->where('tbl_leads.added_by', $user_id)
                    ->orWhere('demo.presented_by', $user_id)
                    ->groupEnd();
        }
    
    
        $builder->groupBy('demo.id'); // Group by demo ID to get multiple rows
    
        $builder->orderBy('demo.id', 'DESC');
    
        $query = $builder->get();
        $result = $query->getResult();
        
        //  dd($result);
        return $result;
    }
    

    public function select_high_priorityLeads($tableName, $select = '')
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->whereIn($tableName .'.priority',[1,2]);
        if($role== 1){
            $query->where($tableName.'.added_by',$user_id);
        }
        $query->where($tableName .'.status !=', 8);
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by','left');
        $query->select($tableName . '.id, ' . $tableName . '.email, tbl_users.username as username');
        $query->orderBy($tableName . '.id', 'DESC');
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }
    public function search_date_wise_withstatus($tableName,$start_date,$end_date,$priority,$select = '')
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        // $query->whereIn($tableName .'.priority',[1,2]);
        if($role== 1){
            $query->where($tableName.'.added_by',$user_id);
        }
        $query->where($tableName .'.status !=', 8);
        $query ->where("$tableName.date >= ", $start_date)
              ->where("$tableName.date <= ", $end_date);

        $query ->whereIn($tableName .'.priority',$priority);  
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by','left');
        $query->select($tableName . '.id, ' . $tableName . '.email, tbl_users.username as username');
        $query->orderBy($tableName . '.id', 'DESC');
        $results = $query->get()->getResultArray();
        // dd($results);   
        return $results;
    }

    public function search_with_date($tableName,$start_date,$end_date, $select = '')
    {
        $session = session();
        $role=$session->get("user_type");
        $user_id=$session->get("user_id");
        $query = $this->db->table($tableName);
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
        $query->whereIn($tableName .'.priority',[1,2]);
        if($role== 1){
            $query->where($tableName.'.added_by',$user_id);
        }
        $query->where($tableName .'.status !=', 8);
        $query ->where("$tableName.date >= ", $start_date)
                ->where("$tableName.date <= ", $end_date);
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by','left');
        $query->select($tableName . '.id, ' . $tableName . '.email, tbl_users.username as username');
        $query->orderBy($tableName . '.id', 'DESC');
        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }


    public function select_offermail_sent($tableName, $select = '')
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        $query = $this->db->table($tableName);

        if ($select) {
            $query->select($select);
        } else {
            $query->select($tableName . '.*, tbl_users.username as username');
        }

        $query->where('offer_mail_status', 1);

        if ($role == 1) {
            $query->where($tableName . '.added_by', $user_id);
        }

        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by', 'left');
        $query->whereNotIn($tableName . '.status', [6, 7, 8]);
        $query->orderBy($tableName . '.id', 'DESC');

        // Debugging: dd($query->get()->getResultArray());

        $result= $query->get()->getResultArray();
        // dd($result);
        return $result;
    }

    public function select_trial_accountSent($tableName, $select = '')
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        $query = $this->db->table($tableName);

        if ($select) {
            $query->select($select);
        } else {
            $query->select($tableName . '.*, tbl_users.username as username');
        }

        $query->where('trial_account_status', 1);

        if ($role == 1) {
            $query->where($tableName . '.added_by', $user_id);
        }
        
        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by', 'left');
        $query->orderBy($tableName . '.id', 'DESC');
        $query->whereNotIn($tableName . '.status', [6, 7]);

        // Debugging: dd($query->get()->getResultArray());

        $result= $query->get()->getResultArray();
        return $result;
    }

    

    public function select_invoice_sent($tableName, $select = '')
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");
        $query = $this->db->table($tableName);

        if ($select) {
            $query->select($select);
        } else {
            $query->select($tableName . '.*, tbl_users.username as username');
        }

        $query->where('invoice_status', 1);

        if ($role == 1) {
            $query->where($tableName . '.added_by', $user_id);
        }

        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by', 'left');
        $query->whereNotIn($tableName . '.status', [6, 7, 8]);
        $query->orderBy($tableName . '.id', 'DESC');

        // Debugging: dd($query->get()->getResultArray());

        $result=$query->get()->getResultArray();
        // dd($result);
        return $result;
    }
     
    public function select_demovideo_sent($tableName, $select = '')
{
    $session = session();
    $role = $session->get("user_type");
    $user_id = $session->get("user_id");
    $query = $this->db->table($tableName);

    if ($select) {
        $query->select($select);
    } else {
        $query->select($tableName . '.*, tbl_users.username as username ,tbl_leads.customer_name as customername,,tbl_leads.company_name as company_name, tbl_leads.date as leaddate, tbl_leads.date as leaddate, tbl_leads.mobile_number as mobile_number, tbl_leads.mobile_number as mobile_number, tbl_leads.email as email, , tbl_leads.added_by as added_by');
    }

    $query->join('tbl_leads', 'tbl_leads.id = ' . $tableName . '.lead_id', 'left');
    $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by', 'left');
    if ($role == 1) {
        $query->where('tbl_leads.added_by', $user_id);
    }

    $query->where($tableName . '.presented_by', 8);
    $query->where($tableName . '.status', 3);

    $result = $query->get()->getResultArray();

    // dd($result);
    return $result;
}


    public function count_monthwise_demo2($tableName)
    {
        $query = $this->db->table($tableName);

        $query->select('COUNT(*) as total_demo');
        $query->join('tbl_leads', "$tableName.lead_id = tbl_leads.id", 'left');
        $query->whereIn('tbl_leads.status', [6, 7]);
        // $query->where("$tableName.status", 3);   
        // $query->where('MONTH(demo_date)', date('m'));

        $res = $query->get()->getRow()->total_demo;

        dd($res);
        return $res;
    }

    public function select_all_users_join($tableName, $select = '')
    {
        $query = $this->db->table($tableName . ' as b');
    
        if ($select) {
            $query->select($select);
        } else {
            $query->select('*');
        }
    
        $query->where('b.user_type !=', 0);
    
        $subquery = $this->db->table('tbl_leads c')
                        ->select('COUNT(c.customer_name)')
                        ->where('c.added_by = b.id')
                        ->where('c.status !=', 8)
                        ->getCompiledSelect();

        $subquery1 = $this->db->table('tbl_leads c')
                        ->select('COUNT(c.customer_name)')
                        ->join('demo', 'demo.lead_id = c.id AND (demo.status = 3 AND demo.presented_by != 8)', 'inner')
                        ->where('c.added_by = b.id')
                        ->whereIn('c.status', [4, 6, 7])
                        ->getCompiledSelect();

        
        $subquery3 = $this->db->table('tbl_leads c')
                        ->select('COUNT(c.customer_name)')
                        ->where('c.added_by = b.id')
                        ->whereIn('c.status', [6, 7])
                        ->getCompiledSelect();
    
        $query->select("($subquery) as totalleads", false);
        $query->select("($subquery1) as demogiven", false);
        $query->select("($subquery3) as covertedleads", false);

        $results = $query->get()->getResultArray();
        foreach ($results as &$result) {
            $totalLeads = $result['totalleads'];
            $demoGiven = $result['demogiven'];
            $convertedLeads = $result['covertedleads'];
    
            // Calculate the ratio and multiply by 100
            $result['lead_conversion_rate'] = ($totalLeads != 0) ? ($convertedLeads / $totalLeads) * 100 : 0;
            $result['demo_conversion_rate'] = ($demoGiven != 0) ? ($convertedLeads / $demoGiven) * 100 : 0;

        }
        
        return $results;
    }

    public function select_all_totalleads($tableName, $select = '')
    {
          
        $query = $this->db->table($tableName);
        $query->where('status !=', 8);
        $count = $query->countAllResults(); // Count only the rows where status = 6
        return $count;
         
    }
    public function selects_all_mylead($tableName, $added_by, $select = '')
    {
        $query = $this->db->table($tableName);
        $query->where('added_by', $added_by);
        $query->where('status !=',8);
        $count = $query->countAllResults(); // Count only the rows where status = 6
        return $count;
    }
    public function select_new_leads2($tableName, $select = '')
    {
         $query = $this->db->table($tableName);
         $query->where($tableName . '.status', 0);
         $count = $query->countAllResults(); // Count only the rows where status = 0
         return $count;
    }

    public function selects_new_leads($tableName, $added_by, $select = '')
    {
        $query = $this->db->table($tableName);
        $query->where('status', 0);
        $query->where('added_by', $added_by);
        $count = $query->countAllResults(); // Count only the rows where status = 6
        return $count;

    }
    public function select_all_respondedlead($tableName)
    {
         $query = $this->db->table($tableName);
         $query->where($tableName . '.status', 1);
         $count = $query->countAllResults(); // Count only the rows where status = 0
         return $count;
    }
    public function selects_all_lead_myRespondedlead($tableName, $added_by)
    {
        $query = $this->db->table($tableName);
        $query->where('status', 1);
        $query->where('added_by', $added_by);
        $count = $query->countAllResults(); // Count only the rows where status = 6
        return $count;

    }
    
    public function select_all_notResponded($tableName)
    {
         $query = $this->db->table($tableName);
         $query->where('status', 2);
         $count = $query->countAllResults(); // Count only the rows where status = 0
         return $count;
      
    }
    public function selects_all_lead_myNotRespondedlead($tableName, $added_by)
    {
        $query = $this->db->table($tableName);
        $query->where('status', 2);
        $query->where('added_by', $added_by);
        $count = $query->countAllResults(); // Count only the rows where status = 6
        return $count;

    }
    public function select_all_demo_assigned1($tableName)
    {
        $query = $this->db->table($tableName);
        $query->where('status', 3);
        $count = $query->countAllResults(); // Count only the rows where status = 0
        return $count;
    }

    public function select_all_demo($tableName)
    {
        $query = $this->db->table($tableName);
        $query->join('demo', 'demo.lead_id = ' . $tableName . '.id', 'left');
        $query->where('demo.presented_by !=', 8);
        $query->whereIn($tableName.'.status', [4,6,7]);
        $count = $query->countAllResults(); // Count only the rows where status = 6
        return $count;
       
    }
    public function select_demo_assigned_byId($tableName, $added_by)
    {
        $query = $this->db->table($tableName);
        $query->where('status', 3);
        $query->where('added_by', $added_by);
        $count = $query->countAllResults(); // Count only the rows where status = 6
        return $count;

    }
    public function select_demo_completed1($tableName)
    {
        $query = $this->db->table($tableName);
        $query->where('status', 4);
        $count = $query->countAllResults(); // Count only the rows where status = 0
        return $count;
    }
    public function select_demo_completed($tableName)
    {
        $query = $this->db->table($tableName);
        $query->join('tbl_leads', 'tbl_leads.id = demo.lead_id', 'left');
        $query->where('tbl_leads.status', 4);
        $query->where($tableName.'.presented_by !=', 8);
        $count = $query->countAllResults(); // Count only the rows where status = 0
        // dd($count);
        return $count;
    }
    public function selects_demo_completed($tableName, $added_by)
    { 
        $query = $this->db->table($tableName);
        $query->join('tbl_leads', 'tbl_leads.id = demo.lead_id', 'left');
        $query->where('tbl_leads.status', 4);
        $query->where($tableName.'.presented_by !=', 8);
        $query->where('tbl_leads.added_by', $added_by);
        $count = $query->countAllResults(); // Count only the rows where status = 6
        return $count;

    }

    public function select_all_lead_payment($tableName)
    {
        $query = $this->db->table($tableName);
        $query->where('status', 6);
        $count = $query->countAllResults(); // Count only the rows where status = 6
        return $count;
    }
    public function select_all_lead_total_payments($tableName,$user_id)
    {
        $query = $this->db->table($tableName);
        $query->where('added_by',$user_id);
        $query->where('status', 6);
        $count = $query->countAllResults(); // Count only the rows where status = 6
        return $count;

        
    }
    public function select_all_aborted1($tableName)
    {
        $query = $this->db->table($tableName);
        $query->where('status', 5);
        $count = $query->countAllResults(); // Count only the rows where status = 0
        return $count;
    }
    public function selects_demo_aborted($tableName, $added_by)
    {
        $query = $this->db->table($tableName);
        $query->where('status', 5);
        $query->where('added_by', $added_by);
        $count = $query->countAllResults(); // Count only the rows where status = 6
        return $count;

    }
    public function select_all_delivered2($tableName)
    {
        $query = $this->db->table($tableName);
        $query->where('status', 7);
        $count = $query->countAllResults(); // Count only the rows where status = 0
        return $count;
    }

    public function selects_all_myDeliveredlead($tableName, $added_by)
    {
        $query = $this->db->table($tableName);
        $query->where('status', 7);
        $query->where('added_by', $added_by);
        $count = $query->countAllResults(); // Count only the rows where status = 6
        return $count;

    }

    public function update_statusnew($tableName,$data){
        return $this->db
        ->table($tableName)
        ->where(['status' => 3])
        ->set($data)
        ->update();
    }

    public function select_paymentdetails($tableName, $paymntmode, $select = '')
    {
            $query = $this->db->table('tbl_payment as c'); 
            
            if ($select) {
                $query->select($select);
            } else {
                $query->select('tl.*, c.amount, c.payment_date, c.payment_mode'); // Include amount field from tbl_payment
            }

            $query->join('tbl_leads tl', 'c.lead_id = tl.id', 'left')
                ->where('c.payment_mode', $paymntmode)
                ->whereIn('tl.status', [6, 7]);

            $results = $query->get()->getResultArray();
           // For debugging purposes

            return $results;
    }

    public function select_all_accounttype($tableName, $select = '', $groupBy = '')
    {
        $query = $this->db->table($tableName . ' as b');
        
        if ($select) {
            $query->select($select);
        } else {
            $query->select('id, payment_mode, COUNT(payment_mode) as count, SUM(amount) as total_amount');
        }
    
        if ($groupBy) {
            $query->groupBy($groupBy);
        }
    
        $results = $query->get()->getResultArray();// For debugging purposes, remove this in production
        return $results;
    }


    public function phnumber_is_unique($tableName, $phnumber, $select = '')
    {
        $query = $this->db->table($tableName);
        
        if ($select) {
            $query->select($select);
        } else {
            $query->select("$tableName.*,u.username");
        }

        $query->where("$tableName.status !=", 8);
        $query->where("$tableName.mobile_number", $phnumber)
            ->orWhere("$tableName.whatsapp_number", $phnumber);
         
        $query->join('tbl_users as u',"u.id = $tableName.added_by",'left') ;   
        $results = $query->get()->getResultArray();

        // dd($results);
        // echo $this->db->getLastQuery();die;
        // $count = count($results); 
       
        return $results;
   }


   public function email_is_unique($tableName, $email, $select = '')
   {
       $query = $this->db->table($tableName);
       
       if ($select) {
           $query->select($select);
       } else {
           $query->select('*');
       }
       $query->where('status !=', 8);
       $query->where('email', $email);
         
          
       $results = $query->get()->getResultArray();
       
       $count = count($results); // Get the count of results
      
       return $count;
  }


  public function select_all_clients($tableName, $select = '')
  {
      $query = $this->db->table($tableName);
      if ($select) {
          $query->select($select);
      } else {
          $query->select('*');
      }
      $query->where('status', 0);
      $results = $query->get()->getResultArray();
      return $results;
      
  }

  public function select_all_clients_byID($tableName,$id, $select = '')
  {
      $query = $this->db->table($tableName);
      if ($select) {
          $query->select($select);
      } else {
          $query->select('*');
      }
      $query->where('status', 0);
      $query->where('id', $id);
      $results = $query->get()->getRowArray();
      return $results;
      
  }
  public function getTotalDemosAndConvertedLeads_byDate($from_date,$to_date){
    $builder = $this->db->table('demo');

    $builder->select([
        'COUNT(DISTINCT demo.lead_id) as total_demos',
        'COUNT(DISTINCT CASE WHEN tbl_leads.status IN (6, 7) AND demo.status IN (0, 3) THEN demo.lead_id END) as total_converted_leads'
    ]);

    $builder->whereIn('demo.status', [3]);

    $builder->where("demo.demo_actual_date >= ", $from_date)
             ->where("demo.demo_actual_date <= ", $to_date);

    $builder->join('tbl_users presenter', 'presenter.id = demo.presented_by', 'left');
    $builder->join('tbl_leads', 'tbl_leads.id = demo.lead_id', 'left');

    $query = $builder->get();
    $result = $query->getRowArray();

    // Calculate conversion rate for the total counts
    $total_demos = $result['total_demos'];
    $total_converted_leads = $result['total_converted_leads'];
    
    // Avoid division by zero error
    $conversion_rate = ($total_demos > 0) ? ($total_converted_leads / $total_demos) * 100 : 0;

    return [
        'total_demos' => $total_demos,
        'total_converted_leads' => $total_converted_leads,
        'conversion_rate' => $conversion_rate,
];
}


  public function select_presentd_report_datewise($from_date,$to_date){
    $builder = $this->db->table('demo');

        $builder->select([
            'presenter.username as presented_by',
            'presenter.id as presenter',
            'COUNT(DISTINCT demo.lead_id) as total_demos',
            'COUNT(DISTINCT CASE WHEN tbl_leads.status IN (6, 7) AND demo.status IN (3) THEN demo.lead_id END) as total_converted_leads'
        ]);

        $builder->whereIn('demo.status', [3]);
        $builder->groupBy('presented_by');


        $builder->join('tbl_users presenter', 'presenter.id = demo.presented_by', 'left');
        $builder->join('tbl_leads', 'tbl_leads.id = demo.lead_id', 'left');

        $builder->where("demo.demo_actual_date >= ", $from_date)
                ->where("demo.demo_actual_date <= ", $to_date);

        $query = $builder->get();
        $results = $query->getResultArray();
        
        foreach ($results as &$result) {

            $result['conversion_rate'] = ($result['total_demos'] > 0)
                ? ($result['total_converted_leads'] / $result['total_demos']) * 100
                : 0;
        }
        // echo $this->db->getLastQuery();die;
        // dd($results);
        return $results;
  }

  public function getTotalDemosAndConvertedLeads()
    {
            $builder = $this->db->table('demo');

            $builder->select([
                'COUNT(DISTINCT demo.lead_id) as total_demos',
                'COUNT(DISTINCT CASE WHEN tbl_leads.status IN (6, 7) AND demo.status IN (0, 3) THEN demo.lead_id END) as total_converted_leads'
            ]);

            $builder->whereIn('demo.status', [3]);

            $builder->join('tbl_users presenter', 'presenter.id = demo.presented_by', 'left');
            $builder->join('tbl_leads', 'tbl_leads.id = demo.lead_id', 'left');

            $query = $builder->get();
            $result = $query->getRowArray();

            // Calculate conversion rate for the total counts
            $total_demos = $result['total_demos'];
            $total_converted_leads = $result['total_converted_leads'];
            
            // Avoid division by zero error
            $conversion_rate = ($total_demos > 0) ? ($total_converted_leads / $total_demos) * 100 : 0;

            return [
                'total_demos' => $total_demos,
                'total_converted_leads' => $total_converted_leads,
                'conversion_rate' => $conversion_rate,
    ];

  
  }

  public function detailed_demowise_report($user){
    $session = session();
    $role = $session->get("user_type");
    $user_id = $session->get("user_id");
    
    $builder = $this->db->table('tbl_leads');
    $builder->select('tbl_leads.*,tbl_payment.*,tbl_leads.status as m_status,tbl_leads.project_delivery_date,tbl_users.username as username, demo_presenter.username as demo_presenter, demo.*');
    $builder->join('demo', 'demo.lead_id = tbl_leads.id AND (demo.status = 0 OR demo.status = 3)', 'left');

    $builder->join('tbl_users', 'tbl_users.id = tbl_leads.added_by', 'left');
    $builder->join('tbl_payment', 'tbl_payment.lead_id = tbl_leads.id','left');
    $builder->join('tbl_users as demo_presenter', 'demo_presenter.id = demo.presented_by', 'left');
    $builder->where('demo.presented_by',$user);
    $builder->where('demo.status', 3)
            ->where('tbl_leads.status !=', 8);

    if ($role == 1) {
        $builder->groupStart()
                ->where('tbl_leads.added_by', $user_id)
                ->orWhere('demo.presented_by', $user_id)
                ->groupEnd();
    }

    $builder->orderBy('demo.id', 'DESC');

    $query = $builder->get();
    $res = $query->getResult();
    // dd($res);
    // echo $this->db->getLastQuery();die;
    return $res;
  }


//   public function select_support_given()
//     {
//         $session = session();
//         $role = $session->get("user_type");
//         $user_id = $session->get("user_id");

//         $builder = $this->db->table('tbl_client_support');
//         $builder->select('tbl_client_support.*, COUNT(leads.id) AS lead_count');
//         $builder->join('tbl_leads as leads', 'leads.support_giver = tbl_client_support.id', 'inner');
//         $builder->where('leads.status !=', 8);

//         if ($role == 1) {
//             $builder->where('leads.added_by', $user_id);
//         }

//         $builder->groupBy('tbl_client_support.id'); // Group by support IDs to get the count per support entry

//         $query = $builder->get();
//         $result = $query->getResultArray();
//         // dd($result); // Debugging
//         return $result;
//     }

    public function select_support_given()
    {
        $query = $this->db->table('tbl_client_support');
        $query->select('*');
        
        $subquery = $this->db->table('tbl_leads');
        $subquery->select('COUNT(id) AS lead_count');
        $subquery->where('tbl_leads.support_giver = tbl_client_support.id');
        $subquery->groupBy('tbl_leads.support_giver');

        $query->select("({$subquery->getCompiledSelect()}) AS lead_count", false);
        
        $result = $query->get()->getResultArray();
        // dd($result);
        return $result;
    }


    public function select_client_list($tableName,$id,$select = '')
    {
        $session = session();
        $role = $session->get("user_type");
        $user_id = $session->get("user_id");

        $query = $this->db->table($tableName);

        if ($select) {
            $query->select($select);
        } else {
            $query->select($tableName . '.*, tbl_users.username as username,tbl_client_support.name as support_giver,tbl_client_support.mobile_number as support_giver_contact,tbl_client_support.id as support_given'); 
        }

        if ($role == 1) {
            $query->groupStart()
                ->where($tableName . '.added_by', $user_id)
                ->orWhere($tableName . '.delivered_by', $user_id)
                ->groupEnd();
        }

        $query->where($tableName . '.status', 7)
              ->where($tableName . '.support_giver=', $id);
            

        $query->join('tbl_users', 'tbl_users.id = ' . $tableName . '.added_by');
        $query->join('tbl_client_support', 'tbl_client_support.id = ' . $tableName . '.support_giver','left');
        $query->orderBy($tableName . '.project_delivery_date', 'DESC');

        $results = $query->get()->getResultArray();
        // dd($results);
        return $results;
    }
    

    // public function update_from_demotb($tableName, $where = '', $whereValue = '', $data)
    // {
    //     if (!empty($where)) {
    //         return $this->db
    //             ->table($tableName)
    //             ->where([$where => $whereValue])
    //             ->where('demo_actual_date IS NOT NULL') // Add this condition
    //             ->set($data)
    //             ->update();
    //     }
    // }




}