<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TaskBillableTotal Entity
 *
 * @property int $task_billable_total_id
 * @property int $task_total
 * @property int $task_id
 *
 * @property \App\Model\Entity\Task $task
 */
class TaskBillableTotal extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'task_total' => true,
        'task_id' => true,
        'task' => true,
    ];
}
