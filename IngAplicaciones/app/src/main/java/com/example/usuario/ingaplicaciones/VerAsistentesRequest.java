package com.example.usuario.ingaplicaciones;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by Usuario on 21/11/2017.
 */

public class VerAsistentesRequest extends StringRequest {
    private final static String VERASISTENTES_REQUEST_URL="http://192.168.9.61/aplicacion%20de%20escritorio/Android/verAsistentes.php";
    private Map<String,String> params;
    public VerAsistentesRequest(int id, Response.Listener<String> listener){
        super(Method.POST, VERASISTENTES_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("id",id+"");
    }


    public Map<String, String> getParams() {
        return params;
    }
}
