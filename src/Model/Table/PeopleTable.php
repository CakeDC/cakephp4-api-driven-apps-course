<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * People Model
 *
 * @property \App\Model\Table\PlanetsTable&\Cake\ORM\Association\BelongsTo $Planets
 *
 * @method \App\Model\Entity\Person newEmptyEntity()
 * @method \App\Model\Entity\Person newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Person[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Person get($primaryKey, $options = [])
 * @method \App\Model\Entity\Person findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Person patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Person[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Person|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Person saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PeopleTable extends Table
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

        $this->setTable('people');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Planets', [
            'foreignKey' => 'planet_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Species', [
            'foreignKey' => 'species_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('birth_year')
            ->maxLength('birth_year', 255)
            ->requirePresence('birth_year', 'create')
            ->notEmptyString('birth_year');

        $validator
            ->scalar('eye_color')
            ->maxLength('eye_color', 255)
            ->requirePresence('eye_color', 'create')
            ->notEmptyString('eye_color');

        $validator
            ->scalar('hair_color')
            ->maxLength('hair_color', 255)
            ->requirePresence('hair_color', 'create')
            ->notEmptyString('hair_color');

        $validator
            ->scalar('height')
            ->maxLength('height', 255)
            ->requirePresence('height', 'create')
            ->notEmptyString('height');

        $validator
            ->scalar('mass')
            ->maxLength('mass', 255)
            ->requirePresence('mass', 'create')
            ->notEmptyString('mass');

        $validator
            ->integer('planet_id')
            ->notEmptyString('planet_id');

        $validator
            ->integer('species_id')
            ->notEmptyString('species_id');

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
        $rules->add($rules->existsIn('species_id', 'Species'), ['errorField' => 'species_id']);

        return $rules;
    }
}
