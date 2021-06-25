<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     *
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model();

    /**
     * Make Model instance
     *
     * @throws \Exception
     *
     * @return Model
     */
    public function makeModel()
    {
        $baseModel = $this->app->make($this->model());

        if (!$baseModel instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->model = $baseModel;
        return $this->model;
    }

    /**
     * Paginate records for scaffold.
     *
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, $columns = ['*'])
    {
        $query = $this->allQuery();

        return $query->paginate($perPage, $columns);
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function allQuery($search = [], $skip = null, $limit = null)
    {
        $query = $this->model->newQuery();

        if (count($search)) {
            foreach($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    $query->where($key, $value);
                }
            }
        }

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }

    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->allQuery($search, $skip, $limit);

        return $query->get($columns);
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Model
     */
    public function create($input)
    {
        $baseModel = $this->model->newInstance($input);

        $baseModel->save();

        return $baseModel;
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $columns = ['*'])
    {
        $query = $this->model->newQuery();

        return $query->find($id, $columns);
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $baseModel = $query->findOrFail($id);

        $baseModel->fill($input);

        $baseModel->save();

        return $baseModel;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();

        $baseModel = $query->findOrFail($id);

        return $baseModel->delete();
    }

    /**
     * Add a basic where clause to the query.
     *
     * @param \Closure|string|array $column
     * @param mixed $operator
     * @param mixed $value
     * @param string $boolean
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|
     *  \Illuminate\Database\Eloquent\Collection|Model
     */
    public function findBy($column, $value, $operator = '=', $boolean = 'and')
    {
        $query = $this->model->newQuery();

        return $query->where($column, $operator, $value, $boolean);
    }

    /**
     * Add a basic where clause to the query.
     *
     * @param Request $request
     * @param null $relations
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|Model
     */
    public function findAllFieldsAnd(Request $request, $relations = [])
    {
        $inputs = $request->all();
        if($relations){
            $baseModel = $this->model->newQuery()->with($relations);
        }else{
            $baseModel = $this->model->newQuery();
        }
        if (in_array('dealer_id', $this->model->fillable)) {
            $baseModel->where('dealer_id', auth('api')->user()->dealer_id);
        }
        if ($request->exists('fields')) {
            $baseModel->select($this->mountFieldsToSelect($request));
        }
        foreach ($inputs as $key => $value) {
            $type = $this->model()::getFieldType($key);
            if ($type) {
                if ($type == 'string') {
                    $baseModel->where($key, 'like', '%' . $value . '%');
                } else {
                    $baseModel->where($key, $value);
                }
            }
        }

        return $this->getWherehas($baseModel, $request, $relations, 'OR');

    }

    /**
     * Busca em todos os campos da tabela pela string enviada.
     * Função utiliza OR por padrão
     *
     * @param Request $request
     * @param null $relations
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|Model
     */
    public function advancedSearch(Request $request, $relations = [])
    {
        $input = $request->get('search');

        if($relations){
            $baseModel = $this->model->newQuery()->with($relations);
        }else{
            $baseModel = $this->model->newQuery();
        }
        if ($request->exists('fields')) {

            $baseModel->select($this->mountFieldsToSelect($request));
        }
        $filtros='';
        if((trim($input) != 'Busca') && (trim($input) != '')){
            $filtros = explode(',',$input);
        }else{
            $input = '';
            foreach ($this->fieldSearchable as $colum) {
                if($input != ''){
                    $input = $request->exists($colum) ?  $input.','.$colum.'='.$request->get($colum) : $input;
                }else{
                    $input = $request->exists($colum) ? $colum.'='.$request->get($colum) : '';
                }

            }
            if($input != ''){
                $filtros = explode(',',trim($input));
            }
        }
        if($filtros != ''){
            foreach ($filtros as $reg) {
                $column = explode('=',$reg);
                $baseModel->Where(trim($column[0]),'=',trim($column[1]));
            }
        }    
        return $this->getWherehas($baseModel, $request, $relations, 'OR');
    }
    
    /**
     * Busca para autocomplete executar o select e o where de acordo com os parametros
     * Função utiliza OR por padrão
     *
     * @param Request $request
     * @param array $select
     * @param array $conditions
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|Model
     */
    public function autocompleteSearch(Request $request, array $select, array $conditions)
    {
        $baseModel = $this->model->newQuery()->select($select);
        //if (in_array('dealer_id', $this->model->fillable)) {
        //    $baseModel->where('dealer_id', auth('api')->user()->dealer_id);
        //}
        
        foreach ($conditions as $condition) {
            $baseModel->orWhere($condition, 'like', '%' . $request->get('term') . '%');
        }
        return $baseModel->limit(10);
    }
    
    /**
     * Função responsável por montar o where para tabelas relacionadas
     * de acordo com os parâmetros
     * @param Model $baseModel
     * @param Request $request
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getWherehas($baseModel, Request $request, array $relations, string $type)
    {
        if ($type == 'AND') {
            foreach ($relations as $relation) {
                if (!empty($request->get(str::snake($relation)."_id")) ||
                    !empty($request->get(str::snake($relation)."_name"))) {
                        $baseModel->whereHas($relation, function ($query) use ($request, $relation) {
                            empty($request->get(str::snake($relation)."_id")) ?: $query
                                ->where(
                                    str::plural(
                                    str::snake($relation)) . '.id',
                                    $request->get(
                                        str::snake($relation)."_id")
                                    );
                            empty($request->get(str::snake($relation)."_name")) ?: $query
                                ->where(
                                    str::plural(
                                    str::snake($relation)) . '.name',
                                    'like',
                                    '%' . $request->get(
                                        str::snake($relation)."_name") . '%'
                                    );
                        });
                    }
            }
        } else {
            foreach ($relations as $relation) {
                $baseModel->orWhereHas($relation, function ($query) use ($request) {
                    $query->Where('name', 'like', '%' . $request->get('search') . '%');
                });
            }
        }

        return $baseModel;
    }
    
    /**
     * Montar o array para sincronizar na tabela relacionada
     * montagem obrigatória para ManyToMany
     * @param array $input
     * @param string $fieldsInsert
     * @return string|array[]
     */
    public function mountValueRelation(array $input, string $fieldsInsert)
    {
        $type = '';
        foreach ($input as $value) {
            if (empty($type)) {
                $type = [$value[$fieldsInsert]];
            } else {
                array_push($type, $value[$fieldsInsert]);
            }
        }
                
        return $type;
    }
    
    /**
     * Cria a estrutura para soncronizar a tabela de ManyToMany
     * @param array $input Array de entrada do request
     * @param string $relation Nome da tabela de relação no SINGULAR
     * @return array Dados que serão sincronizados
     */
    public function createSync(array $input, string $relation)
    {
        $syncs = [];
        foreach ($input[Str::Plural($relation)] as $value) {
            $syncs[][$relation.'_id'] = $value;
        }
        return $syncs;
    }
    
    /**
     * Monta os campos passados por paramêtros para o select
     * Remove os campos que não fazem parte da Model para evitar quebra de SQL
     * @param Request $request
     * @return array
     */
    public function mountFieldsToSelect(Request $request)
    {
        
        $fields = explode(',', $request->get('fields'));
        foreach ($fields as $key => $field) {
            if (trim($field) == 'id') {
                $fields[$key] = $this->model->getTable().'.id';
            }
            if (!array_key_exists(trim($field), $this->model->getCasts())) {
                unset($fields[$key]);
            }
        }
        return array_map('trim', $fields);
    }
    
    
}
