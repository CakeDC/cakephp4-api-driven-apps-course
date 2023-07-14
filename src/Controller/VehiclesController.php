<?php
declare(strict_types=1);

namespace App\Controller;

use SwaggerBake\Lib\Attribute\OpenApiPaginator;

/**
 * Vehicles Controller
 *
 * @property \App\Model\Table\VehiclesTable $Vehicles
 * @method \App\Model\Entity\Vehicle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VehiclesController extends AppController
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
            'contain' => ['People'],
        ];
        $vehicles = $this->paginate($this->Vehicles);

        $this->set(compact('vehicles'));
        $this->viewBuilder()->setOption('serialize', 'vehicles');
    }

    /**
     * View method
     *
     * @param string|null $id Vehicle id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     */
    public function view($id = null)
    {
        $this->request->allowMethod('get');
        $vehicle = $this->Vehicles->get($id, [
            'contain' => ['People'],
        ]);

        $this->set('vehicle', $vehicle);
        $this->viewBuilder()->setOption('serialize', 'vehicle');
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
        $vehicle = $this->Vehicles->newEmptyEntity();
        $vehicle = $this->Vehicles->patchEntity($vehicle, $this->request->getData());
        if ($this->Vehicles->save($vehicle)) {
            $this->set('vehicle', $vehicle);
            $this->viewBuilder()->setOption('serialize', 'vehicle');

            return;
        }
        throw new \Exception("Record not created");
    }

    /**
     * Edit method
     *
     * @param string|null $id Vehicle id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     * @throws \MixerApi\ExceptionRender\OpenApiExceptionSchema
     * @throws \Exception
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $vehicle = $this->Vehicles->get($id, [
            'contain' => [],
        ]);
        $vehicle = $this->Vehicles->patchEntity($vehicle, $this->request->getData());
        if ($this->Vehicles->save($vehicle)) {
            $this->set('vehicle', $vehicle);
            $this->viewBuilder()->setOption('serialize', 'vehicle');

            return;
        }
        throw new \Exception("Record not saved");
    }

    /**
     * Delete method
     *
     * @param string|null $id Vehicle id.
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException
     * @throws \Cake\Http\Exception\MethodNotAllowedException
     * @throws \Exception
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $vehicle = $this->Vehicles->get($id);
        if ($this->Vehicles->delete($vehicle)) {
            return $this->response->withStatus(204);
        }
        throw new \Exception("Record not deleted");
    }
}
