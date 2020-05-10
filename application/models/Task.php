<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Task extends CI_Model
{

    function insertNewTaskOld()
    {
        //petik 1 buat command mysql
        //petik 2 buat membedakan command sql dan command php
        $q = "INSERT INTO task (judul,keywords,authors)
            VALUES (
                '" . $this->input->post('judul') . "',
                '" . $this->input->post('katakunci') . "',
                '" . $this->input->post('authors') . "'
            )";
        $this->db->query($q);
        //return id di managemytask.php di function addingnewtask
        return $this->db->insert_id();
    }

    function insertNewTask($id_user = -1, $filename = '')
    {
        $this->db->set('judul', $this->input->post('judul'));
        $this->db->set('keywords', $this->input->post('katakunci'));
        $this->db->set('authors', $this->input->post('authors'));
        $this->db->set('jumlah_hal', $this->input->post('halaman'));
        $this->db->set('filelocation', $filename);
        $this->db->set('id_editor', $id_user);
        $this->db->set('date_created', 'NOW()', FALSE);
        $this->db->insert("task");
        return $this->db->insert_id();
    }

    function getTheTask($id_task)
    {
        $q = "SELECT * FROM task WHERE id_task=" . $id_task;
        $res = $this->db->query($q);
        //mereturn semua isi tabel dengan $id_task
        return $res->result_array();
    }

    function getAllTask($id_editor = -1)
    {
        // echo 'id editor: ' . $id_editor;
        $this->db->where('id_editor', $id_editor);
        $this->db->where('sts_task >= 1');
        $res = $this->db->get('task');
        return $res->result_array();
    }

    function assignTaskTo($id_reviewer = -1, $id_task = -1)
    {
        // add if only not exists

        $q = "INSERT INTO assignment2 (id_task, id_reviewer)
            SELECT * FROM (SELECT '$id_task' as task, '$id_reviewer' as rev) AS tmp
            WHERE NOT EXISTS (
                SELECT id_task,id_reviewer FROM assignment2
                WHERE id_task = '$id_task' AND id_reviewer = '$id_reviewer'
            ) LIMIT 1;
            ";

        // echo $q;
        // return;

        $res = $this->db->query($q);

        if (!$this->db->insert_id()) {
            $q2 = "SELECT id_assignment FROM assignment2 
            WHERE id_task = '$id_task' AND id_reviewer = '$id_reviewer';";

            $res2 = $this->db->query($q2);

            // var_dump($res2->row()->id_assignment);
            // return;

            return $res2->row()->id_assignment;
        }

        $id_assignment = $this->db->insert_id();

        return $id_assignment;
    }

    function getAssignmentByID($id_assignment = -1)
    {
        $q = "SELECT a.*, t.judul, t1.nama FROM assignment2 a
            INNER JOIN
            (SELECT u.id_user, u.nama, r.id_reviewer FROM users u 
            INNER JOIN reviewer r
            ON u.id_user = r.id_user) t1
            ON a.id_reviewer = t1.id_reviewer
            JOIN task t ON a.id_task = t.id_task
            WHERE a.id_assignment = '" . $id_assignment . "';";

        // echo $q;
        // return;

        $res = $this->db->query($q);
        return $res->result_array();
    }

    function getAssignedTask($id_reviewer = -1, $status = -1)
    {
        $q = "SELECT a.*, t.* FROM assignment2 a
        INNER JOIN task t
        ON a.id_task = t.id_task
        INNER JOIN 
            (SELECT u.id_user, u.nama, r.id_reviewer FROM users u 
            INNER JOIN reviewer r
            ON u.id_user = r.id_user
            where r.id_reviewer = $id_reviewer) t1
        ON a.id_reviewer = t1.id_reviewer
        WHERE a.status=$status";

        // echo $q;
        // return;

        $res = $this->db->query($q);
        return $res->result_array();
    }

    function getMyAssignedTask(){
        $id_editor = $this->session->userdata('logged_in')['id_on_grup'];
        
        $q = "SELECT * FROM assignment2 a 
                INNER JOIN task t 
                ON a.id_task = t.id_task
                INNER JOIN (
                    SELECT u.nama, r.id_reviewer FROM reviewer r
                    INNER JOIN users u ON u.id_user = r.id_user
                    ) t0
                ON t0.id_reviewer = a.id_reviewer
                WHERE sts_assignment = 1 AND t.id_editor = 1;";

        // echo $q;
        // return;
        
        $res = $this->db->query($q);

        return $res->result_array();

    }
}