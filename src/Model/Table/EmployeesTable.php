<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @method \App\Model\Entity\Employee newEmptyEntity()
 * @method \App\Model\Entity\Employee newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EmployeesTable extends Table
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

        $this->setTable('employees');
        $this->setDisplayField('employee_id');
        $this->setPrimaryKey('employee_id');


        $this->hasOne('EmployeeTasks', [
            'foreignKey' => 'employee_id',
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
            ->integer('employee_id')
            ->allowEmptyString('employee_id', null, 'create');

        $validator
            ->scalar('first_name')
            ->minLength('first_name', 1, __('Please type in the first name'))
            ->maxLength('first_name', 20, __('Please type in less than 20 characters'))
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 20, __('Please type in less than 20 characters'))
            ->allowEmptyString('last_name');

        $validator
            ->scalar('username')
            ->minLength('username', 2, __('Please type in at least 2 characters'))
            ->maxLength('username', 35, __('Please type in less than 35 characters'))
            ->notEmptyString('username');

        $validator
            ->scalar('password')
            ->add('password', [
                'size' => ['rule' => ['lengthBetween', 8, 254], 'message' => 'Must be between 8 and 254 characters'],])
//            ->containsNonAlphaNumeric('password', 1, __('Please make sure there is one special character'))

//            ->add('password', 'custom', [
//                'upperCaseRule' => function ($password, $context){
//
//                       $upperCase = "/[A-Z]/";          //Regex for uppercase
//
//                        if(preg_match_all($upperCase, $password, $matches)){
//                            return true;
//                        }
//                        return false;
//                },
//                'message' =>'Password requires an uppercase character',
//
//                'lowerCaseRule' => function ($password, $context){
//
//                    $lowerCase = "/[a-z]/";          //Regex for lowercase
//
//                    if(preg_match_all($lowerCase, $password, $matches)) {
//                        return true;
//                    }
//                    return false;
//                },
//                'message' =>'Password requires a lowercase character',
//
//                'numericalRule' => function ($password, $context){
//
//                    $number = "/[0-9]/";          //Regex for numbers
//
//                    if(preg_match_all($number, $password, $matches)) {
//                        return true;
//                    }
//                    return false;
//                },
//                'message' =>'Password requires a numerical character'
//
//            ])

                //////////////

//            ->add('password', 'custom', array(
//                'upperCaseRule' => function ($password, $options) {
//
//                    $upperCase = "/[A-Z]/";          //Regex for uppercase
//                    $lowerCase = "/[a-z]/";          //Regex for lowercase
//                    $number = "/[0-9]/";             //Regex for numbers
//
//                    if (!(preg_match_all($upperCase, $password, $matches))) {
//                        return false;
//                    }
//
//
//                    else if ((preg_match_all($lowerCase, $password, $matches))) {
//                        return 'Password requires a lowercase character';
//                    }
//
//
//                    else if ((preg_match_all($number, $password, $matches))) {
//                        return 'Password requires a numerical character';
//                    }
//
//                    return true;},
//
//                    'message' => 'Password requires an uppercase character',
//
//            ))

                //////////////////////


//              ->add('password', 'custom', [
//                'rule' => function ($password, $context){
//
//                    $upperCase = "/[A-Z]/";          //Regex for uppercase
//
//                    if(preg_match_all($upperCase, $password, $matches)) {
//                        return true;
//                     }
//                    return false;
//                    },
//                'message' =>'Password requires an uppercase character'
//
//            ])
//
//            ->add('password', 'custom', [
//                'rule' => function ($password, $context){
//
//                    $lowerCase = "/[a-z]/";          //Regex for lowercase
//
//                    if(preg_match_all($lowerCase, $password, $matches)) {
//                        return true;
//                     }
//                    return false;
//                    },
//                'message' =>'Password requires a lowercase character'
//
//            ])
//
            ->add('password', 'custom', [
                'rule' => function ($password, $context){

                    $number = "/[0-9]/";          //Regex for numbers

                    if(preg_match_all($number, $password, $matches)) {
                        return true;
                    }
                    return false;
                },
                'message' =>'Password requires a numerical character'


            ])

            ->notEmptyString('password');

//        Things that don't work

//            ->minLength('password', 8, __('Please type in at least 8 characters'))
//            ->maxLength('password', 254, __('Please type in less than 254 characters'))
////  Need to create stronger password criteria
//            ->allowEmptyString('password');

//                , 'hasSpecialCharacter' => ['rule' => 'validateSpecialchar', 'message' => 'Requires Special character']

//                    $uppercase = '';//define uppercase here
//                    $password = $this->data['password'];
//                    preg_match_all("/[A-Z]/", $password, $caps_match);
//                    $caps_count = count($caps_match [0]);// number of uppercase letters in password
//                    $this->validator()->getField('password')->getRule('id_rule_2')->message = 'Password cannot have less than '.$uppercase.' uppercase letters';
//                    return ($uppercase > $caps_count);

//            ->add('password',[
//                'upperCase' => function ($password, $context){
//                    preg_match_all("/[A-Z]/", $password, $caps_match);
//                    $caps_count = count($caps_match [0]);// number of uppercase letters in password
//                    if($password < $caps_count){
//                        return true;
//                    }
//                    return false;
//                },
//                'message' => 'Password requires at least 1 uppercase letter'
//            ])


//            ->regex('password', '$(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]).{8,32}$', __('Please ensure that the password has 1 uppercase and 1 lowercase character', 'create'))
//            ->regex('password', '^(?=.*[A-Z])(?=.*[\W])(?=.*[0-9])(?=.*[a-z]).{8,128}$', __('Please ensure at least 1 uppercase letter'))
//            ->add('password', 'validFormat', ['rule' => array('custom', '$S*(?=S{8,254})(?=S*[a-z])(?=S*[A-Z])(?=S*[d])(?=S*[W])S*$'),
//                'message' => 'Please ensure that the password is valid'])


        $validator
//            ->requirePresence('permission_level', 'create')
            // ->maxLength('permission_level', 8, __('Please ensure that the permission is either "employee" or "admin"'))
            ->scalar('permission_level')
            ->requirePresence('permission_level', 'create')
            // ->add('permission_level', 'custom',[
            //     'rule' => function ($value, $context) {
            //         if ($value == 'employee' || $value == 'admin') {
            //             return true;
            //         }


            //         return false;
            //     },

            //     'message' => 'Permission level must be either "employee" or "admin" and must be all lowercase'
            // ])
//
            ->notEmptyString('permission_level');


        $validator
            ->scalar('security_Question_1')
            ->minLength('security_Question_1', 10, __('Please type in at least 10 characters'))
            ->notEmptyString('security_Question_1');

        $validator
            ->scalar('security_Answer_1')
            ->minLength('security_Answer_1', 2, __('Please type in at least 2 characters'))
            ->notEmptyString('security_Answer_1');

        $validator
            ->scalar('security_Question_2')
            ->minLength('security_Question_2', 10, __('Please type in at least 10 characters'))
            ->notEmptyString('security_Question_2');

        $validator
            ->scalar('security_Answer_2')
            ->minLength('security_Answer_2', 2, __('Please type in at least 2 characters'))
            ->notEmptyString('security_Answer_2');


        return $validator;




    }




//public function buildRules(RulesChecker $rules): RulesChecker
//{
//
//    $rules->add(
//        function ($entity, $options) {
//            if (!$entity->password) {
//                return "A password must be set";
//            }
//
//            if(!preg_match('/[A-Z]/', $entity->password)){
//                return "Password must contain at least 1 upper case letter. ";
//            }
//
//            if(!preg_match('/[a-z]/', $entity->password)){
//                return "Password must contain at least 1 lower case letter. ";
//            }
//
//            if(!preg_match('/[0-9]/', $entity->password)){
//                return "Password must contain at least 1 number. ";
//            }
//
//            return true;
//        },
//        'complexPassword',
//        [
//            'errorField' => 'password',
//            'message' => 'Password does not fit the security requirements. '
//        ]
//    );
//
//    return $rules;
//}

}

