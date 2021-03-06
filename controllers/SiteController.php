<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\Productos;
use app\models\Categorias;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionOfertas() {
        $query = Productos::find()->select("id, nombre, foto, descripcion")->where(["=", "oferta", "1"]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);

        return $this->render('productos',[
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionInformacion() {
        $model = new \app\models\ContactForm();
        if ($model->load(Yii::$app->request->post())
                &&
            $model->contact(Yii::$app->params["informacion"])) {
            
            Yii::$app->session->setFlash('enviadaInformacion');
            
            return $this->refresh();
        }
        
        return $this->render("informacion",[
            "model" => $model,
        ]);
    }
    
    /**
     * 
     * Prueba de envio de correo electronico. No está en el menú.
     * 
     */
    public function actionCorreo() {
        $correo = new \app\models\ContactForm();
        $correo->asunto = "Probando este rollo";
        $correo->contenido = "El contenido del correo";
        $correo->correo = "cliente@correo.es";
        $correo->nombre = "Cliente";
        $correo->contact(Yii::$app->params["informacion"]);
    }
    
    public function actionContacto() {
        $model = new \app\models\FormularioContacto();
        if ($model->load(Yii::$app->request->post()) 
                &&
            $model->contact(Yii::$app->params["contacto"])) {
            Yii::$app->session->setFlash('enviadoContacto');
            
            return $this->refresh();
        }
        
        return $this->render("contacto", [
            "model" => $model,
        ]);
    }
    
    public function actionProductos() {
        $query = Productos::find()->select("id, nombre, foto, descripcion");
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);

        return $this->render('productos',[
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionCategorias() {
        $query = Categorias::find()->select("id, nombre, foto, descripcion");
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);

        return $this->render('categorias',[
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionDetallecategoria($id) {
        $model = new Categorias();
        $model = Categorias::find()->select('categorias.*')->where(['id' => $id])->one();

        $query = Productos::find()
                 ->joinWith("relacions",false,"INNER JOIN")
                 ->where("categoria=$id");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        return $this->render("detalle_categoria",[
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);

    }
}
