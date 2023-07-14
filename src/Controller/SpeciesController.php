<?php
declare(strict_types=1);

namespace App\Controller;

use SwaggerBake\Lib\Attribute\OpenApiPaginator;

/**
 * Species Controller
 *
 * @property \App\Model\Table\SpeciesTable $Species
 * @method \App\Model\Entity\Species[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SpeciesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     */
    #[OpenApiPaginator]
    public function index()
    {
        $this->request->allowMethod('get');
        $this->paginate = [
            'contain' => ['Planets'],
        ];
        $species = $this->paginate($this->Species);

        $this->set(compact('species'));
        $this->viewBuilder()->setOption('serialize', 'species');
    }

    /**
     * View method
     *
     * @param string|null $id Species id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     */
    public function view($id = null)
    {
        $this->request->allowMethod('get');
        $species = $this->Species->get($id, [
            'contain' => ['Planets', 'People'],
        ]);

        $this->set('species', $species);
        $this->viewBuilder()->setOption('serialize', 'species');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     * @throws \MixerApi\ExceptionRender\OpenApiExceptionSchema
     * @throws \Exception
     */
    public function add()
    {
        $this->request->allowMethod('post');
        $species = $this->Species->newEmptyEntity();
        $species = $this->Species->patchEntity($species, $this->request->getData());
        if ($this->Species->save($species)) {
            $this->set('species', $species);
            $this->viewBuilder()->setOption('serialize', 'species');

            return;
        }
        throw new \Exception("Record not created");
    }

    /**
     * Edit method
     *
     * @param string|null $id Species id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     * @throws \MixerApi\ExceptionRender\OpenApiExceptionSchema
     * @throws \Exception
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $species = $this->Species->get($id, [
            'contain' => [],
        ]);
        $species = $this->Species->patchEntity($species, $this->request->getData());
        if ($this->Species->save($species)) {
            $this->set('species', $species);
            $this->viewBuilder()->setOption('serialize', 'species');

            return;
        }
        throw new \Exception("Record not saved");
    }

    /**
     * Delete method
     *
     * @param string|null $id Species id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     * @throws \Exception
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $species = $this->Species->get($id);
        if ($this->Species->delete($species)) {
            return $this->response->withStatus(204);
        }
        throw new \Exception("Record not deleted");
    }
}
