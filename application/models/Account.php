<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Model
{

    function insertNewUser()
    {
        //record baru di tabel user

        //petik 1 buat command mysql
        //petik 2 buat membedakan command sql dan command php
        $q = "INSERT INTO users (nama, username, pwd, email, foto_user)
            VALUES (
                '" . $this->input->post('nama')     . "',
                '" . $this->input->post('username') . "',
                '" . md5($this->input->post('sandi')) . "',
                '" . $this->input->post('email')    . "',
                '" . $this->upload->data('file_name')    . "'
            )";
        echo $q;
        $this->db->query($q);

        //return id di managemytask.php di function addingnewtask
        $id_user = $this->db->insert_id();

        //record baru di reviewer/editor
        $roles = $this->input->post('roles');

        foreach ($roles as $item) {
            $peran = $item;
            if ($peran == '1') {
                //editor     
                //petik 1 buat command mysql
                //petik 2 buat membedakan command sql dan command php
                $q2 = "INSERT INTO editor (id_user, date_updated) VALUES (" . $id_user . ", now())";

                $this->db->query($q2);

                $q3 = "INSERT INTO member (id_user, id_grup, date_updated) VALUES (" . $id_user . ", " . $peran . ",  now())";
                $this->db->query($q3);
            } else if ($peran == '2') {
                //reviewer
                $q2 = "INSERT INTO reviewer (id_user, date_updated) VALUES (" . $id_user . ", now())";
                $this->db->query($q2);

                $q3 = "INSERT INTO member (id_user, id_grup, date_updated) VALUES (" . $id_user . ", " . $peran . ",  now())";
                $this->db->query($q3);
            } else {
                //makelaar
                $q2 = "INSERT INTO makelaar (id_user, date_updated) VALUES (" . $id_user . ", now())";
                $this->db->query($q2);

                $q3 = "INSERT INTO member (id_user, id_grup, date_updated) VALUES (" . $id_user . ", " . $peran . ",  now())";
                $this->db->query($q3);
            }
        }
        return $id_user;
    }

    function getIDUser()
    {
        $q = "SELECT t1.*, t3.id_grup, t3.nama_grup FROM (SELECT * FROM users t0
                            WHERE t0.username = '" . $this->input->post('username') . "'
                            AND t0.pwd = MD5('" . $this->input->post('sandi') . "')
                            AND t0.sts_user = 1) t1
                        INNER JOIN member t2 ON t1.id_user=t2.id_user AND t2.sts_member = 1
                        INNER JOIN grup t3 ON t2.id_grup=t3.id_grup AND t3.sts_grup = 1";
        $res = $this->db->query($q);
        $users = $res->result_array();

        if (count($users) > 0) {
            // echo 'dhuar';
            // var_dump($users);
            return $users;
        } else {
            // echo 'dhuar';
            return [];
        }
    }

    function getIDOnGroup($id_user = -1, $id_grup = -1)
    {
        //id editor, reviewer, makelaar
        if ($id_grup == 1) {
            $q = "SELECT e.id_editor FROM member m 
                INNER JOIN editor e
                ON m.id_user
                WHERE m.id_user = $id_user;";
            $res = $this->db->query($q);
            return $res->row()->id_editor;

        } else if ($id_grup == 2) {
            $q = "SELECT r.id_reviewer FROM member m 
                INNER JOIN reviewer r
                ON m.id_user
                WHERE m.id_user = $id_user;";
            $res = $this->db->query($q);
            return $res->row()->id_reviewer;
            
        } else if ($id_grup == 3) {
            $q = "SELECT mak.id_makelaar FROM member m 
                INNER JOIN makelaar mak
                ON m.id_user
                WHERE m.id_user = $id_user;";
            $res = $this->db->query($q);
            return $res->row()->id_makelaar;
        }
        return -1;
    }

    function getPeranUser($id_user)
    {
        $q =  "SELECT * FROM member WHERE 
        id_user= " . $id_user . "";

        $res = $this->db->query($q);
        $peran = $res->result_array();
        return $peran[0]['id_grup'];
    }

    function getRoles($id_user = -1)
    {
        $q = "SELECT t1.*, t2.nama_grup  FROM (SELECT t0.* FROM member  t0 
                                    WHERE  t0.sts_member=1 AND t0.id_user=" .  $id_user . ") t1
                    INNER JOIN grup t2 ON t1.id_grup=t2.id_grup AND t2.sts_grup=1";
        $res = $this->db->query($q);
        return $res->result_array();
    }

    function getUser($id_user = -1)
    {
        $q = "SELECT t1.*, t3.id_grup, t3.nama_grup FROM ( SELECT * FROM users  t0
                                    WHERE t0.id_user='" .  $id_user . "'
                                         AND t0.sts_user=1) t1  
                                    INNER JOIN member t2 ON t1.id_user=t2.id_user AND t2.sts_member=1
                                    INNER JOIN grup t3 ON t2.id_grup=t3.id_grup AND t3.sts_grup=1";

        $res = $this->db->query($q);
        return  $res->result_array();
    }

    function setUser($id_user = -1)
    {
        $q = "  UPDATE users 
                SET 
                    nama = '" . $this->input->post('nama') . "',
                    username = '" . $this->input->post('username') . "',
                    email = '" . $this->input->post('email') . "',
                    foto_user = '" . $this->upload->data('file_name') . "'
                WHERE
                    id_user = " . $id_user . "
            ";

        $res = $this->db->query($q);
        return $res;
    }
}
