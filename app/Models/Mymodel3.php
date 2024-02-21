<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Pager\Pager;

class Mymodel3 extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_tickets';
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

    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db;
    }
    public function getTicketImages()
    {
        $builder = $this->builder();

        $builder->select('*'); // Select the columns you need
        $builder->join('tbl_ticket_images', 'tbl_tickets.id = tbl_ticket_images.ticket_id');
        // Define the join condition between the two tables

        $query = $builder->get();

        return $query->getResult();
    }
    public function getTicketImages1($id)
    {
        $builder = $this->builder();

        $builder->select('*'); 
        $builder->join('tbl_ticket_images', 'tbl_tickets.id = tbl_ticket_images.ticket_id');
        $builder->where('tbl_ticket_images.ticket_id', $id);
        $query = $builder->get();
        // echo $this->db->getLastQuery();die();
        return $query->getResult();
    }
    public function getLastEntryForEachUniqueId()
    {
        // Select the last entry for each unique_id
        $builder = $this->db->table($this->table);
        $builder->select('*')
            ->groupBy('unique_id')
            ->orderBy('id', 'DESC')
            ->groupBy('unique_id');

        // Execute the query and return the result
        return $builder->get()->getResult();
    }
    
}
