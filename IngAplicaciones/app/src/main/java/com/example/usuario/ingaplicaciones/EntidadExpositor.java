package com.example.usuario.ingaplicaciones;

import java.io.Serializable;

/**
 * Created by Usuario on 19/11/2017.
 */

public class EntidadExpositor implements Serializable{
    private String nombre;
    private int DNI;
    private String apellido;
    private String institucion;
    private String cargo;
    private String biografia;

    public EntidadExpositor(int DNI, String nombre, String apellido,String institucion, String cargo, String biografia){
        this.DNI= DNI;
        this.nombre = nombre;
        this.apellido = apellido;
        this.institucion=institucion;
        this.cargo=cargo;
        this.biografia=biografia;
    }
    public int getDNI(){
        return DNI;
    }
    public String getNombre(){
        return nombre;
    }
    public String getApellido(){
        return apellido;
    }
    public String getInstitucion(){ return institucion; }
    public String getCargo(){
        return cargo;
    }
    public String getBiografia(){
        return biografia;
    }
}
