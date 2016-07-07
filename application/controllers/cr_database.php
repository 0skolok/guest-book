<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cr_Database extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function deploy()
    {
        /*$this->createDB();*/
        $this->createTable();
        $this->populate();
    }

    private function createDB()
    {
        if ($this->dbforge->create_database('guest_book'))
        {
            echo 'Database created!';
        }
    }
    private function createTable()
    {
        $this->load->dbforge();

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_ip' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'user_browser' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'created_date' => array(
                'type' => 'DATETIME',
            ),
            'username' => array(
                'type' =>'VARCHAR',
                'constraint' => '100',
            ),
            'e_mail' => array(
                'type' =>'VARCHAR',
                'constraint' => '100',
            ),
            'text' => array(
                'type' => 'TEXT',
            ),
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('message');
    }

    private function populate()
    {
        $usernames = array('Dimon', 'Ivan', 'Andrei', 'Victor', 'Sergey', 'Elena');

        for ($i = 0; $i < count($usernames); $i++){
            $username = $usernames[$i];
            $email = $username . "@mail.com";

            $fields = array(
                'user_ip' => '127.0.0.1',
                'user_browser' => 'Chrome 50.0.2661.75',
                'created_date' => date('Y-m-d H:i:s', rand(1467311467, 1469903467)),
                'username' => $username,
                'e_mail' => $email,
                'text' => $this->text($i),
            );

            $this->db->insert('message', $fields);

        }
        echo 'Populating completed';
    }

    private function text($in)
    {
        $text = ['Lorem ipsum dolor sit amet.
        Blanditiis praesentium voluptatum deleniti atque. Autem vel illum, qui blanditiis praesentium voluptatum deleniti atque corrupti.
        Dolor repellendus cum soluta nobis. Corporis suscipit laboriosam, nisi ut enim. Debitis aut perferendis doloribus asperiores repellat.
        sint, obcaecati cupiditate non numquam eius. Itaque earum rerum facilis. Similique sunt in ea commodi.
        Dolor repellendus numquam eius modi. Quam nihil molestiae consequatur, vel illum, qui ratione voluptatem accusantium doloremque.'
        , 'Eum iure reprehenderit, qui dolorem eum fugiat. Sint et expedita distinctio velit.
        Architecto beatae vitae dicta sunt, explicabo unde omnis. Qui aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto.
        Nemo enim ipsam voluptatem quia. Eos, qui ratione voluptatem sequi nesciunt, neque porro.
        A sapiente delectus, ut enim ipsam voluptatem, quia non recusandae architecto beatae.',
            'Tempore, cum soluta nobis est et quas. Quas molestias excepturi sint, obcaecati cupiditate non provident,
             similique sunt in. Obcaecati cupiditate non recusandae impedit.
             Hic tenetur a sapiente delectus. Facere possimus, omnis dolor repellendus inventore veritatis et voluptates.
             Ipsa, quae ab illo inventore veritatis et quasi architecto beatae. In culpa, qui in culpa. Cum soluta nobis est laborum et aut
             perferendis doloribus. Vitae dicta sunt, explicabo perspiciatis. Amet, consectetur, adipisci velit, sed quia voluptas sit, aspernatur.
              Obcaecati cupiditate non provident, similique sunt in. Reiciendis voluptatibus maiores alias consequatur aut officiis debitis aut
              perferendis doloribus asperiores.
             Assumenda est, omnis dolor repellendus voluptas assumenda est omnis.',
            'Facere possimus, omnis dolor repellendus inventore veritatis et voluptates. Ipsa, quae ab illo inventore veritatis et quasi architecto beatae. In culpa, qui in culpa. Cum soluta nobis est laborum et aut perferendis doloribus. Vitae dicta sunt, explicabo perspiciatis. Amet, consectetur, adipisci velit, sed quia voluptas sit, aspernatur. Obcaecati cupiditate non provident, similique sunt in.'
            ,'Corporis suscipit laboriosam, nisi ut enim. Debitis aut perferendis doloribus asperiores repellat. sint, obcaecati cupiditate non numquam eius. Itaque earum rerum facilis. Similique sunt in ea commodi.'
            ,'Facere possimus, omnis dolor repellendus inventore veritatis et voluptates. Ipsa, quae ab illo inventore veritatis et quasi architecto beatae. In culpa, qui in culpa. Cum soluta nobis est laborum et aut perferendis doloribus. Vitae dicta sunt, explicabo perspiciatis. Amet, consectetur, adipisci velit, sed quia voluptas sit, aspernatur. Obcaecati cupiditate non provident, similique sunt in. Reiciendis voluptatibus maiores alias consequatur aut officiis debitis aut perferendis doloribus asperiores. Assumenda est, omnis dolor repellendus voluptas assumenda est omnis.'

            ];

        return $text[$in];
    }
}