package com.example.usuario.ingaplicaciones;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by Usuario on 21/11/2017.
 */

public class ModificarEventoRequest extends StringRequest {
    private final static String MODIFICAR_EVENTO_REQUEST_URL="http://192.168.9.61/aplicacion%20de%20escritorio/Android/modificarEvento.php";
    private Map<String,String> params;
    public ModificarEventoRequest(int idioma,int id,String nombre,String lugar,String detalle, String horainicio, String horafin, String fecha, String aula, Response.Listener<String> listener){
        super(Method.POST, MODIFICAR_EVENTO_REQUEST_URL, listener, null);
        params = new HashMap<>();

        params.put("id",id+"");
        params.put("nombre",nombre);
        params.put("lugar",lugar);
        params.put("detalle",detalle);
        params.put("horainicio",horainicio);
        params.put("horafin",horafin);
        params.put("fecha",fecha);
        params.put("aula",aula);
        params.put("idioma",idioma+"");

    }


    public Map<String, String> getParams() {
        return params;
    }
}
