package com.example.usuario.ingaplicaciones;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by Usuario on 21/11/2017.
 */

public class AgregarTokenRequest extends StringRequest {
    private final static String TOKEN_REQUEST_URL="http://192.168.9.61/aplicacion%20de%20escritorio/Android/agregarToken.php";
    private Map<String,String> params;
    public AgregarTokenRequest(String token, Response.Listener<String> listener){
        super(Method.POST, TOKEN_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("token",token);

    }


    public Map<String, String> getParams() {
        return params;
    }
}
