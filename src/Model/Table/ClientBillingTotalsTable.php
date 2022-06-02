<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClientBillingTotals Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 *
 * @method \App\Model\Entity\ClientBillingTotal newEmptyEntity()
 * @method \App\Model\Entity\ClientBillingTotal newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ClientBillingTotal[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClientBillingTotal get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClientBillingTotal findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ClientBillingTotal patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClientBillingTotal[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClientBillingTotal|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientBillingTotal saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientBillingTotal[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClientBillingTotal[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClientBillingTotal[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ClientBillingTotal[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClientBillingTotalsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('client_billing_totals');
        $this->setDisplayField('billing_total_id');
        $this->setPrimaryKey('billing_total_id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('billing_total_id')
            ->allowEmptyString('billing_total_id', null, 'create');

        $validator
            ->integer('client_billing_total')
            ->allowEmptyString('client_billing_total');

        $validator
            ->boolean('billed_status')
            ->allowEmptyString('billed_status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['client_id'], 'Clients'), ['errorField' => 'client_id']);

        return $rules;
    }
}
