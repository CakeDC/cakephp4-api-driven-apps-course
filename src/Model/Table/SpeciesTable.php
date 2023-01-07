<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Species Model
 *
 * @property \App\Model\Table\PlanetsTable&\Cake\ORM\Association\BelongsTo $Planets
 * @property \App\Model\Table\PeopleTable&\Cake\ORM\Association\HasMany $People
 *
 * @method \App\Model\Entity\Species newEmptyEntity()
 * @method \App\Model\Entity\Species newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Species[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Species get($primaryKey, $options = [])
 * @method \App\Model\Entity\Species findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Species patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Species[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Species|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Species saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Species[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Species[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Species[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Species[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SpeciesTable extends Table
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

        $this->setTable('species');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Planets', [
            'foreignKey' => 'planet_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('People', [
            'foreignKey' => 'species_id',
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
            ->scalar('classification')
            ->maxLength('classification', 255)
            ->requirePresence('classification', 'create')
            ->notEmptyString('classification');

        $validator
            ->scalar('designation')
            ->maxLength('designation', 255)
            ->requirePresence('designation', 'create')
            ->notEmptyString('designation');

        $validator
            ->scalar('average_height')
            ->maxLength('average_height', 255)
            ->requirePresence('average_height', 'create')
            ->notEmptyString('average_height');

        $validator
            ->scalar('average_lifespan')
            ->maxLength('average_lifespan', 256)
            ->requirePresence('average_lifespan', 'create')
            ->notEmptyString('average_lifespan');

        $validator
            ->scalar('language')
            ->maxLength('language', 255)
            ->requirePresence('language', 'create')
            ->notEmptyString('language');

        $validator
            ->integer('planet_id')
            ->notEmptyString('planet_id');

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
        $rules->add($rules->existsIn('planet_id', 'Planets'), ['errorField' => 'planet_id']);

        return $rules;
    }
}
