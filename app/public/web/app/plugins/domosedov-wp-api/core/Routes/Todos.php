<?php


namespace Domosedov\WPAPI\Routes;

use Domosedov\WPAPI\Models\Todo;
use WP_REST_Server;

class Todos extends \WP_REST_Controller
{
    public function __construct()
    {
        $this->namespace = 'domosedov/v1';
        $this->rest_base = 'todos';
    }

    public function register_routes()
    {
        register_rest_route($this->namespace, "/$this->rest_base", [
            [
                'methods' => WP_REST_Server::READABLE,
                'callback' => [$this, 'get_items'],
                'permission_callback' => [$this, 'get_items_permissions_check'],
                'args' => [
                    'type' => [
                        'description' => __('Тип сообщений'),
                        'type' => 'string',
                        'default' => 'all_my',
                        'validate_callback' => [$this, 'validate_args'],
                        'required' => true
                    ],
                    'page' => [
                        'description' => __('Текущая страница.'),
                        'type' => 'integer',
                        'default' => 1,
                        'validate_callback' => [$this, 'validate_args'],
                        'required' => false
                    ],
                    'per_page' => [
                        'description' => __('Максимальное число возращаемых элементов.'),
                        'type' => 'integer',
                        'default' => 0,
                        'validate_callback' => [$this, 'validate_args'],
                        'required' => false
                    ],
                ]
            ],
            [
                'methods' => WP_REST_Server::CREATABLE,
                'callback' => [$this, 'create_item'],
                'permission_callback' => [$this, 'create_item_permissions_check'],
                'args' => [
                    'receiver_id' => [
                        'description' => __('ID получателя'),
                        'type' => 'integer',
                        'sanitize_callback' => [$this, 'sanitize_args'],
                        'validate_callback' => [$this, 'validate_args'],
                        'required' => true
                    ],
                    'title' => [
                        'description' => __('Заголовок сообщения'),
                        'type' => 'string',
                        'default' => '',
                        'sanitize_callback' => [$this, 'sanitize_args'],
                        'validate_callback' => [$this, 'validate_args'],
                        'required' => true
                    ],
                    'body' => [
                        'description' => __('Тело сообщения'),
                        'type' => 'string',
                        'default' => '',
                        'sanitize_callback' => [$this, 'sanitize_args'],
                        'validate_callback' => [$this, 'validate_args'],
                        'required' => true
                    ]
                ]
            ]

        ]);

        register_rest_route($this->namespace, "/$this->rest_base/(?P<id>[\w]+)", [
            'args' => [
                'id' => [
                    'description' => __('ID сообщения'),
                    'type' => 'integer'
                ]
            ],
            [
                'methods' => WP_REST_Server::READABLE,
                'callback' => [$this, 'get_item'],
                'permission_callback' => [$this, 'get_item_permissions_check'],
            ],
            [
                'methods' => WP_REST_Server::EDITABLE,
                'callback' => [$this, 'update_item'],
                'permission_callback' => [$this, 'update_item_permissions_check'],
            ],
            [
                'methods' => WP_REST_Server::DELETABLE,
                'callback' => [$this, 'delete_item'],
                'permission_callback' => [$this, 'delete_item_permissions_check'],
            ]
        ]);
    }

    public function sanitize_args($value, $requset, $param)
    {
    	return $value;
    }

    public function validate_args($value, $requset, $param)
    {
    	return $value;
    }

    public function get_items_permissions_check($request)
    {
        return true;
//        return parent::get_items_permissions_check($request); // TODO: Change the autogenerated stub
    }


    public function get_items($request)
    {
        $todos = Todo::getTodos();
        return rest_ensure_response($todos);
//        return parent::get_items($request); // TODO: Change the autogenerated stub
    }

    public function get_item_permissions_check($request)
    {
        return true;
//        return parent::get_item_permissions_check($request); // TODO: Change the autogenerated stub
    }

    public function get_item($request)
    {
        $id = (int) $request->get_param('id');

	    return Todo::getTodoById($id);
    }

    public function create_item_permissions_check($request)
    {
        return parent::create_item_permissions_check($request); // TODO: Change the autogenerated stub
    }

    public function create_item($request)
    {
        return parent::create_item($request); // TODO: Change the autogenerated stub
    }

    public function update_item_permissions_check($request)
    {
        return parent::update_item_permissions_check($request); // TODO: Change the autogenerated stub
    }

    public function update_item($request)
    {
        return parent::update_item($request); // TODO: Change the autogenerated stub
    }

    public function delete_item_permissions_check($request)
    {
        return parent::delete_item_permissions_check($request); // TODO: Change the autogenerated stub
    }

    public function delete_item($request)
    {
        return parent::delete_item($request); // TODO: Change the autogenerated stub
    }
}