<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Clients Model
 *
 * @method \App\Model\Entity\Client newEmptyEntity()
 * @method \App\Model\Entity\Client newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Client[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Client get($primaryKey, $options = [])
 * @method \App\Model\Entity\Client findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Client patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Client[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Client|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ClientsTable extends Table
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

        $this->setTable('clients');
        $this->setDisplayField('client_id');
        $this->setPrimaryKey('client_id');

        /** added this line to retrieve the tables*/
        $this->hasMany('EmployeeTasks');
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
            ->integer('client_id')
            ->allowEmptyString('client_id', null, 'create');

        $validator
            ->scalar('company_name')
            ->maxLength('company_name', 30, __('Please type in a company name, limited to 30 characters'))
            ->requirePresence('company_name', 'create')
            ->notEmptyString('company_name');

//
//        $validator
//            ->scalar('conact_name')
//            ->maxLength('conact_name', 50, __('Please ensure that contact name is less than 50 characters'))
//            ->allowEmptyString('conact_name', 'create');
//
//        $validator
//            ->scalar('address_line_1')
//            ->maxLength('address_line_1', 70, __('Please ensure that address line 1 is less than 70 characters'))
//            ->allowEmptyString('address_line_1', 'create');
//
//        $validator
//            ->scalar('address_line_2')
//            ->maxLength('address_line_2', 70, __('Please ensure that address line 2 is less than 70 characters'))
//            ->allowEmptyString('address_line_2', 'create');
//
//        $validator
//            ->scalar('city')
//            ->minLength('city', 2, __('Please type in at least 2 characters'))
//            ->maxLength('city', 20, __('Please type in up to 20 characters'))
//            ->allowEmptyString('city', 'create');
//
//        $validator
//            ->scalar('state')
//            ->minLength('state', 2, __('Please ensure you type at least 2 characters'))
//
//            ->maxLength('state', 15, __('Please ensure you type up to 15 characters'))

//            ->add('state', 'custom',[
//                'rule' => function ($value, $context) {
//                    if ($value == 'VIC' || $value == 'NSW' || $value == 'NT' || $value == 'QLD' || $value == 'TAS'
//                        || $value == 'ACT' || $value == 'WA' || $value == 'SA') {
//                        return true;
//                    }
//
//                    return false;
//                },
//
//
//                'message' => 'State must be: ACT, QLD, NSW, NT, SA, TAS, WA or VIC'
////
//            ])
//
//
//            ->allowEmptyString('state','create');
//
//
//
//        $validator
//            ->integer('postcode')
//            ->add('postcode','custom',[
//                'rule' => function ($value, $context) {
//                    if ($value >=0){
//                        return true;
//                    }
//                    return false;
//                },
//                'message' => 'postcode must be a positive number'
//            ])
//            ->minLength('postcode', 4, __('Please type in at least 4 numbers'))
//            ->maxLength('postcode', 4, __('Please type in up to 4 numbers'))
//            ->allowEmptyString('postcode','create');
//
//        $validator
//            ->scalar('country')
//            ->maxLength('country', 20)
//            ->allowEmptyString('country','create');
//
//        $validator
//            ->integer('company_phone_number')
//            ->add('company_phone_number','custom',[
//                'rule' => function ($value, $context) {
//                    if ($value >=0){
//                        return true;
//                    }
//                    return false;
//                },
//                'message' => ' phone number must be a positive number'
//            ])
//            ->minLength('company_phone_number', 8, __('Please type in at least 8 digits'))
//            ->maxLength('company_phone_number', 15, __('Please ensure phone number is less than 15 digits'))
//            ->allowEmptyString('company_phone_number', 'create');
//
//        $validator
//            ->integer('contact_phone_number')
//            ->add('contact_phone_number','custom',[
//                'rule' => function ($value, $context) {
//                    if ($value >=0){
//                        return true;
//                    }
//                    return false;
//                },
//                'message' => 'phone number must be a positive number'
//            ])
//            ->minLength('contact_phone_number', 8, __('Please type in at least 8 digits'))
//            ->maxLength('contact_phone_number', 15, __('Please ensure phone number is less than 15 digits'))
//            ->allowEmptyString('contact_phone_number', 'create');
//
////            ->minLength('contact_phone_no', 8, __('Please type in at least 8 digits'))
////            ->maxLength('contact_phone_no', 12, __('Please type in an Australian phone number'))
//
////            ->requirePresence('contact_phone_no', 'create')
////            ->notEmptyString('contact_phone_no');
//
////            ->integer('phone_no')
////            ->add('phone_no', 'custom',[
////                'rule' => function ($value, $context) {
////                    if ($value >= 1) {
////                        return true;
////                    }
////
////                    return false;
////                },
////
////                'message' => 'Please check your phone number and try again'
////
////            ])
////            ->minLength('phone_no', 8, __('Please type in at least 8 digits'))
////            ->maxLength('phone_no', 12, __('Please type in an Australian phone number'))
////            ->requirePresence('contact_phone_no', 'create')
////            ->notEmptyString('contact_phone_no');
//
//        $validator
//            ->email('contact_email')
//            ->maxLength('contact_email', 100, __('Please type in less than 100 characters'))
//            ->allowEmptyString('contact_email', 'create');

        return $validator;
    }
}
