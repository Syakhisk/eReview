<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reviewer extends CI_Model
{

    function getAllReviewers()
    {
        $q = "SELECT t0.id_reviewer, t1.id_user, t1.nama 
        FROM reviewer t0
        INNER JOIN users t1
        ON t0.id_user = t1.id_user
        WHERE sts_reviewer = 1";

        // echo $q;
        // return;

        $res = $this->db->query($q);
        return $res->result_array();
    }

    function getReviewersNames()
    {
        $q = "SELECT users.id_user, id_reviewer, nama
            FROM reviewer
            INNER JOIN users
            ON reviewer.id_user = users.id_user";

        $res = $this->db->query($q);
        return $res->result_array();
    }

    function getReviewerByID($id_reviewer = -1)
    {
        $q = "SELECT t0.id_reviewer, t1.id_user, t1.nama 
        FROM reviewer t0
        INNER JOIN users t1
        ON t0.id_user = t1.id_user
        WHERE sts_reviewer = 1
        AND t0.id_reviewer = $id_reviewer;";

        // echo $q;
        // return;

        $res = $this->db->query($q);

        return $res->result_array();
    }

    function acceptAssignment($id_assignment = -1, $halaman = -1)
    {
        // illegal assignment edit prevention
        $id_reviewer = $this->session->userdata('logged_in')['id_on_grup'];

        $q = "UPDATE assignment2
                SET status = 1
                WHERE id_assignment = $id_assignment
                AND id_reviewer = $id_reviewer;
                ";
        $res = $this->db->query($q);

        $q2 = "UPDATE assignment2
                SET tgl_assignment = NOW()
                WHERE id_assignment = $id_assignment
                AND id_reviewer = $id_reviewer;
                ";
        $res = $this->db->query($q2);

        $q3 = "UPDATE assignment2
                SET tgl_deadline = DATE_ADD(NOW(), INTERVAL $halaman DAY)
                WHERE id_assignment = $id_assignment
                AND id_reviewer = $id_reviewer;
                ";
        $res = $this->db->query($q3);

        return;
    }

    function updateThisAssignment($id_assignment = -1, $value = -1)
    {
        // illegal assignment edit prevention
        $id_reviewer = $this->session->userdata('logged_in')['id_on_grup'];

        $q = "UPDATE assignment2
                SET status = $value
                WHERE id_assignment = $id_assignment
                AND id_reviewer = $id_reviewer;
                ";
        $res = $this->db->query($q);

        $affected_rows = $this->db->affected_rows();

        // IF accept task THEN set deadline
        if ($value == 1) {
            $q2 = "UPDATE assignment2
                    SET tgl_assignment = NOW()
                    WHERE id_assignment = $id_assignment
                    AND id_reviewer = $id_reviewer;
                    ";
            $res = $this->db->query($q2);
        }

        // IF undo task THEN set reset deadline
        else if ($value == 0) {
            $q2 = "UPDATE assignment2
                    SET tgl_assignment = NULL
                    WHERE id_assignment = $id_assignment
                    AND id_reviewer = $id_reviewer;
                    ";
            $res = $this->db->query($q2);

            $q3 = "UPDATE assignment2
            SET tgl_deadline = NULL
            WHERE id_assignment = $id_assignment
            AND id_reviewer = $id_reviewer;
            ";
            $res = $this->db->query($q3);
        }

        if ($affected_rows < 1) {
            return -1;
        }

        return;
    }
}
