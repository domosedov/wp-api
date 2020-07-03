<?php


namespace Domosedov\WPAPI\Models;

use PDOException;
use RedBeanPHP\R;
use RedBeanPHP\RedException\SQL;
use WP_Error;

class Todo
{
    const TYPE = 'todo';
    private $todo = null;

    /**
     * Todo constructor.
     *
     * @param string $text Содержимое задачи
     * @param bool $completed Статус
     */
    public function __construct(string $text, bool $completed)
    {
        $this->todo = R::dispense(self::TYPE);
        $this->todo->text = $text;
        $this->todo->completed = $completed;
    }

    public function save()
    {
        try {
            $id = R::store($this->todo);
        } catch (SQL $e) {
            return new WP_Error('orm-error', 'Не удалось сохранить в БД');
        }
        return $id;
    }

    public static function getTodoById(int $id)
    {
        $todoBean = R::load(self::TYPE, $id);

        if (!empty($todoBean)) {
            return [
                'id' => (int) $todoBean->id,
                'text' => (string) $todoBean->text,
                'completed' => (bool) $todoBean->completed
            ];
        } else {
            return [];
        }
    }

    public static function getTodos($limit = 15, $offset = 0)
    {
        $todos = [];

        $todoBeans =  R::findAll(self::TYPE, 'LIMIT :limit OFFSET :offset', [
            ':limit' => $limit,
            ':offset' => $offset
        ]);

        if (!empty($todoBeans)) {
            foreach ($todoBeans as $todo) {
                $todos[] = [
                    'id' => (int) $todo->id,
                    'text' => (string) $todo->text,
                    'completed' => (bool) $todo->completed
                ];
            }
        }

        return $todos;
    }
}
