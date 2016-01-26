<?php 

namespace App\Http\Controllers\Api\V1;

use App\LaravelRestCms\ApiInterface;
use \Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

abstract class ApiController extends ApiGuardController implements ApiInterface
{
    /**
     * Laraponse object, which abstracts Fractal
     * 
     * @var \EllipseSynergie\ApiResponse\Laravel\Response
     */
    public $response;
    
    /**
     * The string name of the Eloquent Model
     * 
     * @var string
     */
    protected $modelName;
    
    /**
     * The Eloquent Model
     * 
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    
    /**
     * The string name of the Transformer class
     * 
     * @var string
     */
    protected $transformerName;
    
    /**
     * The name of the collection that is returned in the JSON response
     * 
     * @var string
     */
    protected $collectionName;
    
    /**
     * The Fractal Manager
     * 
     * @var \League\Fractal\Manager
     */
    public $manager;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->response = \Response::api();
        
        if (!empty($this->modelName)) {
            $this->model = new $this->modelName;
        }

        // if no collection name provided, use the model's table name
        if (empty($this->collectionName)) {
            $this->collectionName = $this->model->getTable();
        }
        
        // parse includes
        if (\Input::get('include') != '') {
            $this->manager = new \League\Fractal\Manager;
            $this->manager->parseIncludes(explode(',', \Input::get('include')));
        }

        parent::__construct();
    }

    /**
     * Creates an item
     *
     * @param \Illuminate\Http\Request $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $data = null)
    {   
        $data = $data ?: \Input::json();
        $json = $data->all();
        $json = $this->addAttribution($json);

        try {
            $this->model->validate($json);
            $item = $this->model->create($json);
            return $this->showByObject($item);
        
        } catch (ValidationException $e) {
            return $this->response->setStatusCode(422)->withError($e->errors()->all(), 'GEN-UNPROCESSABLE-ENTITY');
        } catch (MassAssignmentException $e) {
            return $this->response->setStatusCode(422)->withError("Cannot mass assign " . $e->getMessage(), 'GEN-UNPROCESSABLE-ENTITY');
        } catch (\Exception $e) {
            return $this->response->setStatusCode(422)->withError($e->getMessage(), 'GEN-UNPROCESSABLE-ENTITY');
        }
    }

    /**
     * Adds created_by and updated_by to the array if the model supports it
     *
     * @param array $data
     * @return array $data
     */
    protected function addAttribution(array $data)
    {   
        if ($this->model->attirbution) {
            $data['created_by'] = $this->apiKey->user_id;
            $data['updated_by'] = $this->apiKey->user_id;
        }

        return $data;
    }

    /**
     * Returns a single item
     * 
     * @param  mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {        
        try {
            
            if (is_array($id)) {
                return $this->response->withItem($this->model->where($id)->firstOrFail(), new $this->transformerName);
            } else {
                return $this->response->withItem($this->model->findOrFail($id), new $this->transformerName);
            }            
        
        } catch (ModelNotFoundException $e) {

            return $this->respondNotFound();
        }
    }

    /**
     * Returns a single item
     * 
     * @param  \Illuminate\Database\Eloquent\Model $object
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByObject($object)
    {        
        try {
            return $this->response->withItem($object, new $this->transformerName);
        
        } catch (ModelNotFoundException $e) {

            return $this->respondNotFound();
        }
    }

    /**
     * Returns a paginated collection
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function collection()
    {
        $limit = \Input::get('limit') ?: 10;
        $model = $this->model;
        
        if (\Request::has('order')) {
            list($orderCol, $orderBy) = explode('|', \Input::get('order'));
            $model = $model->orderBy($orderCol, $orderBy);
        }

        return $this->response->withPaginator($model->paginate($limit), new $this->transformerName, $this->collectionName);
    }

    /**
     * Handles 404 errors
     * 
     * @param  string $msg
     * @return \Illuminate\Http\JsonResponse
     */
    public static function respondNotFound($msg = 'Not found!')
    {
        return \Response::json([
            'error' => [
                'message' => $msg,
                'status_code' => 404
            ]
        ], 404);
    }
}