<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Planets Model
 *
 * @property \App\Model\Table\PeopleTable&\Cake\ORM\Association\HasMany $People
 * @property \App\Model\Table\SpeciesTable&\Cake\ORM\Association\HasMany $Species
 *
 * @method \App\Model\Entity\Planet newEmptyEntity()
 * @method \App\Model\Entity\Planet newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Planet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Planet get($primaryKey, $options = [])
 * @method \App\Model\Entity\Planet findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Planet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Planet[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Planet|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Planet saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Planet[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Planet[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Planet[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Planet[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PlanetsTable extends Table
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

        $this->setTable('planets');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('People', [
            'propertyName' => 'residents',
            'foreignKey' => 'planet_id',
        ]);
        $this->hasMany('Species', [
            'foreignKey' => 'planet_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('climate')
            ->maxLength('climate', 255)
            ->requirePresence('climate', 'create')
            ->notEmptyString('climate');

        $validator
            ->scalar('diameter')
            ->maxLength('diameter', 255)
            ->requirePresence('diameter', 'create')
            ->notEmptyString('diameter');

        $validator
            ->scalar('orbital_period')
            ->maxLength('orbital_period', 255)
            ->requirePresence('orbital_period', 'create')
            ->notEmptyString('orbital_period');

        $validator
            ->scalar('gravity')
            ->maxLength('gravity', 255)
            ->requirePresence('gravity', 'create')
            ->notEmptyString('gravity');

        $validator
            ->scalar('terrain')
            ->maxLength('terrain', 255)
            ->requirePresence('terrain', 'create')
            ->notEmptyString('terrain');

        $validator
            ->scalar('population')
            ->maxLength('population', 255)
            ->requirePresence('population', 'create')
            ->notEmptyString('population');

        return $validator;
    }
}
