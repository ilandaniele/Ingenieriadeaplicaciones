package com.example.usuario.ingaplicaciones;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by Usuario on 21/11/2017.
 */

public class EliminarFavoritoRequest extends StringRequest {
    private static final String FAVORITO_REQUEST_URL="http://192.168.9.61/aplicacion%20de%20escritorio/Android/eliminarFavorito.php";
    private Map<String,String> params;
    public EliminarFavoritoRequest(int id, int DNI, Response.Listener<String> listener){
        super(Method.POST, FAVORITO_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("id",id+"");
        params.put("dni", DNI+"");
    }


    public Map<String, String> getParams() {
        return params;
    }
}
