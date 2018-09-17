package com.example.usuario.ingaplicaciones;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by Usuario on 21/11/2017.
 */

public class LoginRequest extends StringRequest {
    private final static String LOGIN_REQUEST_URL="http://192.168.9.61/aplicacion%20de%20escritorio/Android/Login.php";
    private Map<String,String> params;
    public LoginRequest(String username, String password, Response.Listener<String> listener){
        super(Method.POST, LOGIN_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("username",username);
        params.put("password",password);

    }


    public Map<String, String> getParams() {
        return params;
    }
}
