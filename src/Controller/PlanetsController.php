<?php
declare(strict_types=1);

namespace App\Controller;

use SwaggerBake\Lib\Attribute\OpenApiPaginator;

/**
 * Planets Controller
 *
 * @property \App\Model\Table\PlanetsTable $Planets
 * @method \App\Model\Entity\Planet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlanetsController extends AppController
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
        $planets = $this->paginate($this->Planets);

        $this->set(compact('planets'));
        $this->viewBuilder()->setOption('serialize', 'planets');
    }

    /**
     * View method
     *
     * @param string|null $id Planet id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     */
    public function view($id = null)
    {
        $this->request->allowMethod('get');
        $planet = $this->Planets->get($id, [
            'contain' => ['People', 'Species'],
        ]);

        $this->set('planet', $planet);
        $this->viewBuilder()->setOption('serialize', 'planet');
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
        $planet = $this->Planets->newEmptyEntity();
        $planet = $this->Planets->patchEntity($planet, $this->request->getData());
        if ($this->Planets->save($planet)) {
            $this->set('planet', $planet);
            $this->viewBuilder()->setOption('serialize', 'planet');

            return;
        }
        throw new \Exception("Record not created");
    }

    /**
     * Edit method
     *
     * @param string|null $id Planet id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     * @throws \MixerApi\ExceptionRender\OpenApiExceptionSchema
     * @throws \Exception
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $planet = $this->Planets->get($id, [
            'contain' => [],
        ]);
        $planet = $this->Planets->patchEntity($planet, $this->request->getData());
        if ($this->Planets->save($planet)) {
            $this->set('planet', $planet);
            $this->viewBuilder()->setOption('serialize', 'planet');

            return;
        }
        throw new \Exception("Record not saved");
    }

    /**
     * Delete method
     *
     * @param string|null $id Planet id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     * @throws \Exception
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $planet = $this->Planets->get($id);
        if ($this->Planets->delete($planet)) {
            return $this->response->withStatus(204);
        }
        throw new \Exception("Record not deleted");
    }
}
