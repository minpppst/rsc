<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Json;
use johnitvn\rbacplus\models\Role;
use backend\models\Permission as Permisos;
use johnitvn\rbacplus\models\RoleSearch;

/**
 * RoleController is controller for manager role
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
//class RoleController extends \common\controllers\BaseController {
class RoleController extends Controller {
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Role model.
     * @param string $name
     * @return mixed
     */
    public function actionView($name) {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => $name,
                'content' => $this->renderPartial('view', [
                    'model' => $this->findModel($name),
                ]),
                'footer' => Html::button(Yii::t('rbac', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                Html::a(Yii::t('rbac', 'Edit'), ['update', 'name' => $name], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                        'model' => $this->findModel($name),
            ]);
        }
    }

    /**
     * Creates a new Role model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $request = Yii::$app->request;
        $model = new Role(null);
        $permisoSuperior= Permisos::ObtenerPermisosNivelUno();



        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => Yii::t('rbac', "Create new {0}", ["Role"]),
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'permisoSuperior' => $permisoSuperior,
                    ]),
                    'footer' => Html::button(Yii::t('rbac', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button(Yii::t('rbac', 'Save'), ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
//                \johnitvn\userplus\Helper::dump($model);
                return [
                    'forceReload' => 'true',
                    'title' => Yii::t('rbac', "Create new {0}", ["Role"]),
                    'content' => '<span class="text-success">' . Yii::t('rbac', "Have been create new {0} success", ["Role"]) . '</span>',
                    'footer' => Html::button(Yii::t('rbac', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a(Yii::t('rbac', 'Create More'), ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => Yii::t('rbac', "Create new {0}", ["Role"]),
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'permisoSuperior' => $permisoSuperior,
                    ]),
                    'footer' => Html::button(Yii::t('rbac', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button(Yii::t('rbac', 'Save'), ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'name' => $model->name]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                            'permisoSuperior' => $permisoSuperior,
                ]);
            }
        }
    }

    /**
     * Updates an existing Role model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param string $name
     * @return mixed
     */
    public function actionUpdate($name) {
        $request = Yii::$app->request;
        $model = $this->findModel($name);
        //datos precargados
        $permisoSuperiorDatos= Permisos::ObtenerPermisosNivelUnoUpdate($name);
        $permisoSuperior=Permisos::ObtenerPermisosNivelUno();


        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => Yii::t('rbac', "Update {0}", ['"' . $name . '" Role']),
                    'content' => $this->renderAjax('update', [
                        'model' => $this->findModel($name),
                        'permisoSuperior' => $permisoSuperior,
                        'permisoSuperiorDatos' => $permisoSuperiorDatos,
                    ]),
                    'footer' => Html::button(Yii::t('rbac', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button(Yii::t('rbac', 'Save'), ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => 'true',
                    'title' => $name,
                    'content' => $this->renderAjax('view', [
                        'model' => $this->findModel($name),
                        'permisoSuperior' => $permisoSuperior,
                        'permisoSuperiorDatos' => $permisoSuperiorDatos,
                    ]),
                    'footer' => Html::button(Yii::t('rbac', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a(Yii::t('rbac', 'Edit'), ['update', 'name' => $name], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => Yii::t('rbac', "Update {0}", ['"' . $name . '" Role']),
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'permisoSuperior' => $permisoSuperior,
                        'permisoSuperiorDatos' => $permisoSuperiorDatos,
                    ]),
                    'footer' => Html::button(Yii::t('rbac', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::button(Yii::t('rbac', 'Save'), ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'name' => $model->name]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                            'permisoSuperior' => $permisoSuperior,
                            'permisoSuperiorDatos' => $permisoSuperiorDatos,
                ]);
            }
        }
    }

    /**
     * Delete an existing Role model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $name
     * @return mixed
     */
    public function actionDelete($name) {
        $request = Yii::$app->request;
        $this->findModel($name)->delete();

        if ($request->isAjax) {
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => 'true'];
        } else {
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $name
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($name) {
        if (($model = Role::find($name)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('rbac', 'The requested page does not exist.'));
        }
    }

    /*
    *Realiza el filtro de permisos por nivel superior 
    * Mehtod Ajax
    * @return json result
    */
    public function actionFiltropermisos() 
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) 
        {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            if ($cat_id != null) 
            {
               $data = Permisos::ObtenerPermisosNivelUnoFiltro($cat_id);
                /**
                 * the getProdList function will query the database based on the
                 * cat_id and sub_cat_id and return an array like below:
                 *  [
                 *      'out'=>[
                 *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
                 *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
                 *       ],
                 *       'selected'=>'<prod-id-1>'
                 *  ]
                 */
               
               echo Json::encode(['output'=>$data, 'selected'=>$data['selected']]);
               return;
            }
        }
    }

}
