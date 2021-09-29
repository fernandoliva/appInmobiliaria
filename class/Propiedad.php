<?php

namespace App;

class Propiedad {

    //BBDD
    protected static $db;
    protected static $columnasDB = [
        'id',
        'nombre',
        'precio',
        'imagen',
        'descripcion',
        'habitaciones',
        'wc',
        'parking',
        'creado',
        'vendedorId'
    ];

    //Errores / Validacion
    protected static $errores = [];

    public $id;
    public $nombre;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $parking;
    public $creado;
    public $vendedorId;

    //Definir la conexion a BBDD
    public static function setDB($database) {
        self::$db = $database;
    }

    public function __construct($args = []){
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->parking = $args['parking'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? 1;
    }

    public function guardar() {
        
        //Sanear los datos
        $atributos = $this->sanitizarDatos();

        //Insertar datos en la BBDD
        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        
        $resultado = self::$db->query($query);

        return $resultado;
        //debug($resultado);
    }

    //Identificar y unir los atributos de la BBDD
    public function atributos(){
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    public function sanitizarDatos(){
        $atributos = $this->atributos();
        $sanitizar = [];

        foreach($atributos as $key => $value){
            $sanitizar[$key] = self::$db->escape_string($value);
        }
        
        //debug($sanitizar);
        return $sanitizar;
    }

    //Subida de archivos
    public function setImagen($imagen){
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //Validacion
    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        if(!$this->nombre){ //Si el nombre está vacio
            self::$errores[] = "Nombre obligatorio";
        }

        if(!$this->precio){
            self::$errores[] = "Precio obligatorio";
        }

        if(!$this->descripcion){
            self::$errores[] = "Descripción obligatoria";
        }

        if(!$this->habitaciones){
            self::$errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$this->wc){
            self::$errores[] = "El número de baños es obligatorio";
        }

        if(!$this->parking){
            self::$errores[] = "El número de parkings es obligatorio";
        }

        if(!$this->vendedorId){
            self::$errores[] = "Elige un vendedor";
        }

        if(!$this->imagen){
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    }

    //Listar todas las propiedades

    public static function all() {
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }


    //Buscar registro por ID

    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado); //Array shift retorna el primer elemento de un array
    }

    public static function consultarSQL($query){
        $resultado = self::$db->query($query);

        $array = [];

        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        $resultado->free();

        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

        foreach($registro as $key => $value){
            if(property_exists( $objeto, $key )){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = [] ){
        foreach($args as $key => $value){
            if(property_exists( $this, $key ) && !is_null($value)){
                $this->$key = $value;
            }
        };
    }

}
