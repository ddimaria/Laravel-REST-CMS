<?php namespace App\LaravelRestCms\Template;

use App\LaravelRestCms\BaseModel;
use App\LaravelRestCms\BaseTransformer;
use App\LaravelRestCms\HierarchyTransformerTrait;

class TemplateDetailTransformer extends BaseTransformer {

	use HierarchyTransformerTrait;

    /**
     * The transformer of the parent (usually itself)
     * 
     * @var string
     */
    protected $parentTransformer = self::class;

    /**
     * Transforms a TemplateDetail model
     * 
     * @param  \App\LaravelRestCms\BaseModel $templateDetail
     * @return array
     */
    public function transform(BaseModel $templateDetail)
    {
        return [
            'id' => (int) $templateDetail->id,
            'parent_id' => (int) $templateDetail->parent_id,
            'name' => $templateDetail->name,
            'description' => $templateDetail->description,
            'var' => $templateDetail->var,
            'type' => $templateDetail->type,
            'data' => $templateDetail->data,
            'sort' => (int) $templateDetail->sort,
        ];
    }
}