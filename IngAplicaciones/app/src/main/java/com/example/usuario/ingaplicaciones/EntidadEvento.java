package com.example.usuario.ingaplicaciones;

import org.w3c.dom.Text;

import java.io.Serializable;
import java.util.Date;

/**
 * Created by Usuario on 19/11/2017.
 */

public class EntidadEvento implements Serializable{
    private String nombre;
    private String lugar;
    private String fecha;
    private String detalle;
    private String nombre_expositor;
    private String apellido_expositor;
    private String hora_inicio;
    private String hora_fin;
    private String aula;
    private String institucion;
    private String cargo;
    private int id;

    public EntidadEvento(int id, String nombre, String lugar, String fecha, String detalle, String nombre_expositor, String apellido_expositor, String aula, String institucion, String cargo, String hora_inicio, String hora_fin){
        this.nombre = nombre;
        this.lugar = lugar;
        this.fecha = fecha;
        this.detalle = detalle;
        this.nombre_expositor = nombre_expositor;
        this.apellido_expositor = apellido_expositor;
        this.hora_inicio = hora_inicio;
        this.hora_fin = hora_fin;
        this.aula= aula;
        this.institucion=institucion;
        this.cargo=cargo;
        this.id=id;
    }

    public String getNombre(){
        return nombre;
    }
    public String getLugar(){
        return lugar;
    }
    public String getFecha(){
        return fecha;
    }
    public String getDetalle(){
        return detalle;
    }
    public String getNombre_Expositor(){
        return nombre_expositor;
    }
    public String getApellido_Expositor(){
        return apellido_expositor;
    }
    public String getHora_inicio(){
        return hora_inicio;
    }
    public String getHora_fin(){
        return hora_fin;
    }
    public String getHorario(){ return hora_inicio + " - "+hora_fin; }
    public String getInstitucion(){ return institucion; }
    public String getAula(){ return aula; }
    public String getCargo(){
        return cargo;
    }
    public int getId(){
        return id;
    }
}
