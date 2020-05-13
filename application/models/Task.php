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

    function insertNewTask($id_editor = -1, $filename = '')
    {
        $this->db->set('judul', $this->input->post('judul'));
        $this->db->set('keywords', $this->input->post('katakunci'));
        $this->db->set('authors', $this->input->post('authors'));
        $this->db->set('jumlah_hal', $this->input->post('halaman'));
        $this->db->set('filelocation', $filename);
        $this->db->set('id_editor', $id_editor);
        $this->db->set('date_created', 'NOW()', FALSE);
        $this->db->insert("task");
        return $this->db->insert_id();
    }

    function getTheTask($id_task)
    {
        $q = "SELECT t.*, u.nama FROM task t
                INNER JOIN editor e
                ON t.id_editor = e.id_editor
                INNER JOIN users u
                ON u.id_user= e.id_user
                WHERE t.id_task = $id_task;";
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

    function getAllTaskMakelaar()
    {
        $q = "SELECT sq.nama, t.*
                FROM task t
                INNER JOIN (SELECT u.nama, e.id_editor
                                FROM users u 
                                INNER JOIN editor e
                                ON u.id_user = e.id_user) sq
                ON sq.id_editor = t.id_editor
                WHERE t.sts_task >= 1;
        ";
        $res = $this->db->query($q);
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
        $q = "SELECT a.*, t.judul, t1.nama, t.jumlah_hal, t.authors FROM assignment2 a
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
        INNER JOIN (SELECT task.*, u1.nama AS nama_editor FROM task 
                    INNER JOIN editor e ON task.id_editor = e.id_editor
                    INNER JOIN users u1 ON u1.id_user = e.id_user) t
        ON a.id_task = t.id_task
        INNER JOIN 
            (SELECT u.id_user, u.nama, r.id_reviewer FROM users u 
            INNER JOIN reviewer r
            ON u.id_user = r.id_user
            where r.id_reviewer = $id_reviewer) t1
        ON a.id_reviewer = t1.id_reviewer
        WHERE a.status = $status";

        // echo $q;
        // return;

        $res = $this->db->query($q);
        return $res->result_array();
    }

    function getAssignedTaskMakelaar($status = -1)
    {
        $q = "SELECT a.*, t.*,a.date_created AS assigned_date, sq.nama AS nama_editor, sq2.nama AS nama_reviewer FROM assignment2 a
                INNER JOIN task t
                ON t.id_task = a.id_task
                INNER JOIN (SELECT u.nama, e.id_editor FROM editor e INNER JOIN users u ON e.id_user = u.id_user) sq
                ON t.id_editor = sq.id_editor
                INNER JOIN (SELECT u.nama, r.id_reviewer FROM reviewer r INNER JOIN users u ON r.id_user = u.id_user) sq2
                ON a.id_reviewer = sq2.id_reviewer
                WHERE sts_assignment >= 1
                AND status = $status";
        
        $res = $this->db->query($q);
        return $res->result_array();
    }

    function getMyAssignedTask()
    {
        $id_editor = $this->session->userdata('logged_in')['id_on_grup'];

        $q = "SELECT * FROM assignment2 a 
                INNER JOIN task t 
                ON a.id_task = t.id_task
                INNER JOIN (
                    SELECT u.nama, r.id_reviewer FROM reviewer r
                    INNER JOIN users u ON u.id_user = r.id_user
                    ) t0
                ON t0.id_reviewer = a.id_reviewer
                WHERE sts_assignment = 1 AND t.id_editor = $id_editor;";

        $res = $this->db->query($q);

        return $res->result_array();
    }

    function getMyAssignedTaskByStatus($status = -1)
    {
        $id_editor = $this->session->userdata('logged_in')['id_on_grup'];

        $q = "SELECT * FROM assignment2 a 
                INNER JOIN task t 
                ON a.id_task = t.id_task
                INNER JOIN (
                    SELECT u.nama, r.id_reviewer FROM reviewer r
                    INNER JOIN users u ON u.id_user = r.id_user
                    ) t0
                ON t0.id_reviewer = a.id_reviewer
                WHERE sts_assignment = 1 
                AND t.id_editor = $id_editor
                AND status = $status;";

        // echo $q;
        // return;

        $res = $this->db->query($q);

        return $res->result_array();
    }

    function updateThisAssignment($id_assignment = -1, $value = -1)
    {
        $id_editor = NULL;
        $id_makelaar = NULL;
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in['id_grup'] == 1) {
            //kalo editor
            $id_editor = $logged_in['id_on_grup'];
        } else if ($logged_in['id_grup'] == 3) {
            //kalo makelaar
            $id_makelaar = $logged_in['id_on_grup'];
        }

        if ($id_editor) {
            $q = "UPDATE assignment2 a 
            INNER JOIN task t
            ON a.id_task = t.id_task
            SET status = $value
            WHERE t.id_editor = $id_editor AND a.id_assignment = $id_assignment;
            ";

            $res = $this->db->query($q);

        } else if ($id_makelaar) {
            $q = "UPDATE assignment2 a 
            INNER JOIN task t
            ON a.id_task = t.id_task
            SET status = $value
            WHERE a.id_assignment = $id_assignment;
            ";

            // var_dump($q);
            
            $res = $this->db->query($q);

        }

        return;
    }
}
