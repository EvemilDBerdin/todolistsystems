<?php

class Home extends MY_Controller
{

    public function index()
    {
        self::verify();
        $data['title'] = SYSTEMTITLE;
        $this->page('home', $data);
    }

    /* form */
    public function addTodoForm()
    {
        $data['title'] = $_POST['title'];
        $data['description'] = $_POST['description'];
        $data['duedate'] = $_POST['duedate'];
        $data['status'] = 'pending';
        $data['user_id'] = $_SESSION['userdata']->id;

        try {
            insert('tbl_todo', $data);
            response(200, "success", "Todo has been successfully added.");
        } catch (Exception $error) {
            response(500, "error", $error);
        }
    }

    public function editTodoForm()
    {
        $data['set'] = $_POST['edit'];

        try {
            $data['where'] = array(
                'id' => $_POST['id']
            );
            update('tbl_todo', $data['set'], $data['where']);
            response(200, "success", "Todo has been successfully updated.");
        } catch (Exception $error) {
            response(500, "error", $error);
        }
    }

    /* button */
    public function editShowModalBtn()
    {
        try {
            $data['params'] = array(
                'where' => array(
                    'id' => $this->input->post('id')
                ),
            );
            $data['result'] = getrow('tbl_todo', $data['params'], 'row');
            json($data['result']);
        } catch (Exception $error) {
            response(500, "error", $error);
        }
    }

    public function deleteBtn()
    {
        try {
            $where = array(
                'id' => $_POST['id']
            );
            delete('tbl_todo', $where);
            response(200, "success", "Todo has been successfully deleted");
        } catch (Exception $error) {
            response(500, "error", $error);
        }
    }

    public function todostatusquery()
    {
        try {
            $options['where'] = array(
                'id' => $_POST['id'],
            );
            $result = getrow('tbl_todo', $options, 'row');
            if ($result->status == 'pending') {
                response(200, "success", "");
            } else {
                response(400, "failed", "");
            }
        } catch (Exception $error) {
            response(500, "error", $error);
        }
    }

    public function todocompletedquery()
    {
        try {
            $options['where'] = array(
                'id' => $_POST['id'],
            );
            $result = getrow('tbl_todo', $options, 'row');
            if ($result->status == 'inprogress') {
                response(200, "success", "");
            } else {
                response(400, "failed", "");
            }
        } catch (Exception $error) {
            response(500, "error", $error);
        }
    }
    public function todostatus()
    {
        try {
            $data['where'] = array(
                'id' => $_POST['id']
            );
            $data['set'] = array(
                'status' => 'inprogress'
            );
            update('tbl_todo', $data['set'], $data['where']);
            response(200, "success", "Todo In Progress");
        } catch (Exception $error) {
            response(500, "error", $error);
        }
    }
    public function todocomplete()
    {
        try {
            $data['where'] = array(
                'id' => $_POST['id']
            );
            $data['set'] = array(
                'status' => 'completed'
            );
            update('tbl_todo', $data['set'], $data['where']);
            response(200, "success", "Todo Completed");
        } catch (Exception $error) {
            response(500, "error", $error);
        }
    }
    public function tbl_todo()
    {
        self::verify();
        $limit = $this->input->post('length');
        $offset = $this->input->post('start');
        $search = $this->input->post('search');
        $order = $this->input->post('order');
        $draw = $this->input->post('draw');
        $select = "tbl_todo.title, tbl_todo.description, tbl_todo.duedate, tbl_todo.status, tbl_todo.id";
        $column_order = array(
            'tbl_todo.title',
            'tbl_todo.description',
            'tbl_todo.duedate',
            'tbl_todo.status',
            'tbl_todo.id'
        );
        $where = array(
            'tbl_todo.user_id' => $_SESSION['userdata']->id
        );
        $join = array(
            'tbl_user' => 'tbl_todo.user_id = tbl_user.id'
        );
        $list = datatables('tbl_todo', $column_order, $select, $where, $join, $limit, $offset, $search, $order);
        $new_array = array();
        foreach ($list['data'] as $key => $value) {
            $new_array[] = $value;
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $list['count_all'],
            "recordsFiltered" => $list['count'],
            "data" => $new_array,
        );
        json($output);
    }


    // public function getOverdueTasks()
    // {
    //     $currentDate = $_POST['currentDate'];
    //     $options['where'] = array(
    //         'duedate' => date('Y-m-d')
    //     );
    //     $options['where_not_in'] = array( 
    //         'col' => 'status', // Column to apply the filter
    //         'value' => ['completed', 'incomplete'] // Values to exclude
    //     );
    //     $result = getrow('tbl_todo', $options, 'row'); 
    //     json($result); 
    // }

    // public function updateTaskStatus()
    // {
    //     $taskId = $_POST['id'];
    //     $newStatus = $_POST['status'];

    //     $data['where'] = array(
    //         'id' => $taskId
    //     );
    //     $data['set'] = array(
    //         'status' => $newStatus
    //     );
    //     update('tbl_todo', $data['set'], $data['where']);
    // }

    public function logout()
    {
        if (isset($_SESSION['userdata'])) {
            session_unset();
            session_destroy();
            redirect(base_url());
        } else {
            redirect(base_url());
        }
    }

    public function verify()
    {
        (isset($_SESSION['userdata'])) ? (($_SESSION['userdata']->flag == 1) && redirect(base_url('login')))
            : redirect(base_url('login'));
    }
}
