<?php

namespace Jmrashed\ModuleGenerator\Classes\Generators;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpNamespace;
use Jmrashed\ModuleGenerator\Helpers\Helper;


class ModelGenerator
{

    public string $message = '';
    protected $models;
    protected $module;
    protected $pathOfModel;
    protected array $withRelation = [];
    protected $modelName;


    public function __construct($module , $models)
    {
        $this->models = $models;
        $this->module = $module;
    }

    public function generate(): string
    {
        if (!key_exists('Models', $this->models)) return '';
        return $this->generateModels($this->models['Models']);
    }

    public function generateModels($models): string
    {
        foreach ($models as $model => $attribute) {
            $this->withRelation = [];
            $this->modelName = $model;
            $this->pathOfModel = module_path($this->module) . "/Entities/" . $model . '.php';

            $template = $this->generateModelTemplates($model, $attribute);
            $template = '<?php' . PHP_EOL . $template;
            $this->touchAndPutContent($template);
            $this->message .= "|-- Model " . $model . " successfully generated" . PHP_EOL;
        }

        return $this->message;
    }

    public function generateModelTemplates(string $model, array $attribute): string
    {
        $namespace = new PhpNamespace('Modules\\' . $this->module . '\Entities');
        $namespace->addUse('Illuminate\Database\Eloquent\Model');
        $class = $namespace->addClass($model);   //create your Model
        $class->setExtends(Model::class);


        //check exists Fields key in attribute array
        if (key_exists('Fields', $attribute)) {
            $namespace = $this->setfillableInModel($class, $attribute, $namespace);
        }
        //check exists Relations key in attribute array
        if (key_exists('Relations', $attribute) && !empty($attribute['Relations'])) {
            $this->addWithCommonRelations($class);
            $this->setRelationsInModel($namespace, $class, $attribute);
        }
        $class->addProperty('commonRelations' , $this->withRelation)->setProtected()->setStatic();

        return $namespace;
    }

    public function setfillableInModel($class, $attribute, $namespace)
    {

        foreach ($attribute['Fields'] as $key => $item) {
            $fillable[] = $key;
        }

        $class->addProperty('fillable', $fillable)->setProtected();
        $this->touchAndPutContent('<?php' . PHP_EOL . $namespace);
        return $namespace;
    }

    public function touchAndPutContent($template)
    {
        touch($this->pathOfModel);
        file_put_contents($this->pathOfModel, $template);
    }

    public function setRelationsInModel($namespace, ClassType $class , $attribute)
    {
        foreach ($attribute['Relations'] as $typeRelation => $relations) {
            if (!is_array($relations) && Str::camel($relations) == 'morphTo'){
                $this->morphRelation($class);
                continue;
            }
            foreach ($relations as $value) {
                /**
                 * @variable relationName Return name of relation example =>  Category
                 * @variable relationModel Return name of model for relation example =>  Blog
                 * @helper configurationRelationsName plural name of relation  example => Categories
                 */

                $relationModel = explode('::', $value)[0];
                $baseRelationName = explode('::', $value)[1];

                $relationName = strtolower(Helper::configurationRelationsName($baseRelationName, $typeRelation));
                $this->withRelation[] = $relationName;
                $namespace->addUse('Modules\\' . Str::camel($relationModel) . '\Entities\\' . $baseRelationName);
                $class->addMethod($relationName)
                    ->addBody('return $this->' . Str::camel($typeRelation) . '(' . $baseRelationName . '::class);')
                    ->setReturnType('Illuminate\Database\Eloquent\Relations\\' . $typeRelation);
            }
        }
        return $namespace;

    }

    public function __toString(): string
    {
        return $this->message;
    }

    public function addWithCommonRelations(ClassType $class)
    {
        $class->addMethod('scopeWithCommonRelations')
            ->addBody('if (isset(static::$commonRelations) && !empty(static::$commonRelations)) {')
            ->addBody("    \$query->with(static::\$commonRelations);")
            ->addBody('}')
            ->addParameter('query');
    }

    public function morphRelation($class)
    {
        $relationName = strtolower(Helper::configurationRelationsName($this->modelName, 'morphTo'));
        $this->withRelation[] = $relationName;
        $class->addMethod($relationName)
            ->addBody('return $this->morphTo();')
            ->setReturnType('Illuminate\Database\Eloquent\Relations\morphTo');
    }
}
