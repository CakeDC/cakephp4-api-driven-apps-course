<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use SwaggerBake\Lib\Attribute\OpenApiPaginator;

/**
 * People Controller
 *
 * @property \App\Model\Table\PeopleTable $People
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PeopleController extends AppController
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
            'contain' => ['Planets', 'Species'],
        ];
        $people = $this->paginate($this->People);

        $this->set(compact('people'));
        $this->viewBuilder()->setOption('serialize', 'people');
    }

    /**
     * View method
     *
     * @param string|null $id Person id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     */
    public function view($id = null)
    {
        $this->request->allowMethod('get');
        $person = $this->People->get($id, [
            'contain' => ['Planets', 'Species'],
        ]);

        $this->set('person', $person);
        $this->viewBuilder()->setOption('serialize', 'person');
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
        $person = $this->People->newEmptyEntity();
        $person = $this->People->patchEntity($person, $this->request->getData());
        if ($this->People->save($person)) {
            $this->set('person', $person);
            $this->viewBuilder()->setOption('serialize', 'person');

            return;
        }
        throw new \Exception("Record not created");
    }

    /**
     * Edit method
     *
     * @param string|null $id Person id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     * @throws \MixerApi\ExceptionRender\OpenApiExceptionSchema
     * @throws \Exception
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $person = $this->People->get($id, [
            'contain' => [],
        ]);
        $person = $this->People->patchEntity($person, $this->request->getData());
        if ($this->People->save($person)) {
            $this->set('person', $person);
            $this->viewBuilder()->setOption('serialize', 'person');

            return;
        }
        throw new \Exception("Record not saved");
    }

    /**
     * Delete method
     *
     * @param string|null $id Person id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     * @throws \Exception
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $person = $this->People->get($id);
        if ($this->People->delete($person)) {
            return $this->response->withStatus(204);
        }
        throw new \Exception("Record not deleted");
    }
}
